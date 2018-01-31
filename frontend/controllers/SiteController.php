<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Rfq;
use common\models\User;
use common\models\Project;
use common\models\Notification;
use common\models\Paypal;
use yii\helpers\Url;
use common\models\Message;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','notification'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionNotification($id,$module)
    {

      

        $notify = Notification::find()
        ->where(['project' => (string)$id])
        ->one();

        if ($module == 'quoted') {

            $notify->read_unread = 0;
            $notify->status = 'View';

            $notify->save();

            return $this->redirect(['compile','project' => base64_encode($notify->project),'customer'=> base64_encode($notify->to_who)]);

        }

   
    }

	public function actionIndex()
    {
		return $this->render('index');
		
	}

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionRfq()
    {
        $model = new Rfq();

        if ($model->load(Yii::$app->request->post())) {

            $model->create_at = date('Y-m-d H:i:s');
            $model->status = 'Request';
            $model->save();
            
            $notification = new Notification();
            $notification->date = date('Y-m-d');
            $notification->date_time = date('Y-m-d H:i:s');
            $notification->message = $model->email.' Has Request A Quotation';
            $notification->from_who = $model->email;
            $notification->to_who = 'admin';
            $notification->read_unread = 1;
            $notification->status = '';
            $notification->project = (string)$model->_id;
            $notification->path = '/site/notification';
            $notification->module = 'rfq';

            $notification->save();


            $from =  Yii::$app->params['supportEmail'];
            $to = Yii::$app->params['adminEmail'];

            $subject = $model->email. 'Has Request A Quotation';


            $text = '<b>Details </b><br><br>';
            $text .= 'Date Request : '.$model->create_at.'<br><br>';
            $text .= 'Email : '.$model->email.'<br>';
            $text .= 'Contact No : '.$model->phone_number.'<br>';
            $text .= 'Remark : '.$model->remark.'<br>';

            $admin = Url::to('@admin');

            $url = $admin.'/site/notification?id='.(string)$notification->_id.'&module=rfq';

            $text .= 'Click This URL To Quoted : '.$url;

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();

            Yii::$app->session->setFlash('submit', 'Your quotation request has been forwarded to our customer service team. We will send you a quotation soon.Thank you!');


            return $this->redirect(['site/index']);
        }



    }


    public function actionCheckoutGuest($project,$customer)
    {
        $modelCheck = Project::find()
        ->where(['_id'=> (string)base64_decode($project),'email' => (string)base64_decode($customer)])
        ->one();

        $userCheck = User::find()
        ->where(['email' => $modelCheck->email])
        ->one();

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginStaff()) {

            if ($_POST['LoginForm']['username'] == $userCheck->username) {
                
                return $this->redirect(
                [
                    'order',
                    'project'=> $project,
                    'customer'=> $customer,

                ]);

            } else {

                return $this->goBack();
            }



        } else {
            return $this->renderAjax('checkout-guest', [
                'model' => $model,
                'project' => $project,
                'customer' => $customer


            ]);
        }
    }

    public function actionRegisterGuest($project,$customer)
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {

                   if ($user->email == (string)base64_decode($customer)) {
                        
                        return $this->redirect(
                        [
                            'order',
                            'project'=> $project,
                            'customer'=> $customer,

                        ]);

                    } else {

                        return $this->goHome();
                    }
                    
                }
            }
        }

        return $this->renderAjax('register-guest', [
            'model' => $model,
            'project' => $project,
            'customer' => $customer


        ]);
    }





    public function actionCompile($project,$customer)
    {

        return $this->redirect(['order','project' => $project,'customer' =>$customer]);

    }

    public function actionOrder($project,$customer)
    {
        $model = Project::find()
        ->where(['_id'=>(string)base64_decode($project)])
        ->one();

        return $this->render('order',[
            'model' => $model,
            'project' => $project,
            'customer' => $customer
        ]);

    }

    public function actionPlace($project,$customer)
    {
        $model = Project::find()
        ->where(['_id'=>(string)base64_decode($project)])
        ->one();

        return $this->render('place',[
            'model' => $model,
            'project' => $project,
            'customer' => $customer
        ]);

    }

    public function actionTransaction($paymentID,$payerID,$paymentToken,$project,$transacId,$total_final,$handling_fee)
    {

        $paypal = new Paypal();

        $paypal->paymentID = $paymentID;
        $paypal->payerID = $payerID;
        $paypal->paymentToken = $paymentToken;
        $paypal->transactionID = $transacId;
        $paypal->project = $project;
        $paypal->date = date('Y-m-d');
        $paypal->date_time = date('Y-m-d H:i:s');

        $model = Project::find()
        ->where(['_id'=> (string)$project])
        ->one();

        $model->status = 'Payment Success';
        $model->shipping_status = 'Processing';

        $paypal->save() && $model->save();

        return $this->redirect(['view','project'=>(string)$project]);

    }


    public function actionView($project)
    {

        $model = Project::find()
        ->where(['_id'=> (string)$project])
        ->one();

        $paypal = Paypal::find()
        ->where(['project'=> (string)$project])
        ->one();



        return $this->render('view',[
            'model' => $model,
            'paypal' => $paypal,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginStaff()) {
            return $this->goBack();
        } else {
            return $this->renderAjax('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLoginWrong()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginStaff()) {

            return $this->goBack();
        } else {
            return $this->render('login-wrong', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->renderAjax('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
	
	
	
    public function actionNotify($id)
    {

        $models = Message::find()
        ->where(['_id' => (string)$id])
        ->one();

        $models->read_unread = 1;

        $models->save();

        return $this->redirect(['message','project' => base64_encode((string)$models->project),'customer'=>base64_encode($models->to_who)]);

    }	
	
	
	
	    public function actionMessage($project,$customer)
    {
        $pro = base64_decode($project);
        $email = base64_decode($customer);

        $newProject_id = new \MongoDB\BSON\ObjectID($pro);

        $message = new Message();
        $model = Project::find()
        ->where(['_id'=>(string)$pro])
        ->one();



        $message_all = Message::find()->where(
            [
                'project' => $newProject_id,
            ])
        ->orderBy([
            '_id'=>SORT_DESC,
        ])

        ->all();

        $user = User::find()->where(['email' => $email])->one();

        if ($message->load(Yii::$app->request->post()) ) {

            $message->date_create = date('Y-m-d H:i:s');
            $message->project = $newProject_id;
            $message->from_who = $model->email;
            $message->to_who = 'cs@direct2asia.com';
            $message->read_unread = 0;
            $message->save();

            $admin = Url::to('@admin');

            $from =  $user->email;
            $to = Yii::$app->params['adminEmail'];

            $subject = $user->email.' Send Message For Quotation : '.$model->quotation_no;

            $text = $_POST['Message']['messages'].'<br>'.'View Message : '.$admin.'/site/message?id='.(string)$message->_id;

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();
            


            return $this->redirect(['message','project'=>base64_encode($newProject_id),'customer'=>base64_encode($model->email)]);



        } else {

            return $this->render('message',[
                'model' => $model,
                'message' => $message,
                'message_all' => $message_all,

            ]);



        }


    }
	
	
	
}
