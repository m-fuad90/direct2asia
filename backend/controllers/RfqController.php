<?php
namespace backend\controllers;

use Yii;
use common\models\Rfq;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Direct2asia;
use common\models\Project;
use backend\models\UploadForm;
use common\models\Images;
use yii\web\UploadedFile;
use common\models\Message;
use yii\helpers\Url;
/**
 * RfqController implements the CRUD actions for Rfq model.
 */
class RfqController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','quote','generate','upload','remove','quotation','message'],
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
     * Lists all Rfq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $list = Rfq::find()
            ->andWhere(['or',
               ['status'=>'Request'],
               ['status'=>'Processing']
           ])
        ->all();

        return $this->render('index', [
            'list' => $list,
        ]);
    }

    public function actionQuotation()
    {
        $list = Rfq::find()
        ->where(['status' => 'Quoted'])
        ->all();

        return $this->render('quotation', [
            'list' => $list,
        ]);
    }



    public function actionUpload($project)
    {
        $model = new UploadForm();
        $date_today = date('Ymd');

        $models = Project::find()
        ->where(['_id'=>(string)$project])
        ->one();


        if (Yii::$app->request->isPost) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file) {   

                if ($model->validate()) {

                    if (!file_exists(Yii::getAlias('@webroot/uploads/'.$date_today.'/'.$models->email))) {
                    mkdir(Yii::getAlias('@webroot/uploads/'.$date_today.'/'.$models->email), 0777, true);
                        }

                        $model->file->saveAs(Yii::getAlias('@webroot/uploads/'.$date_today.'/'.$models->email).'/'.$model->file->baseName . '.' . $model->file->extension);

                        $models->file = $model->file->baseName . '.' . $model->file->extension;
                        $models->path = 'uploads/'.$date_today.'/'.$models->email.'/';
                        $models->ext = $model->file->extension;
                        $models->date_upload = date('Y-m-d');
                        $models->save();

                        Yii::$app->session->setFlash('upload', 'File Successful Upload');

                        return $this->redirect(['rfq/quote','id'=>(string)$project]);


                } else {

                        Yii::$app->session->setFlash('sizetype', 'File Unsuccessful To Upload . Please Check File Format & File Size . Limit 1.5MB');
                        return $this->redirect(['rfq/quote','id'=>(string)$project]);




                }


            }


        }
        return $this->renderAjax('upload', ['model' => $model]);
    }

    public function actionRemove($project)
    {

        $model = Project::find()
        ->where(['_id'=>(string)$project])
        ->one();

        $path = Yii::getAlias('@webroot/'.$model->path.'/'.$model->file);
        unlink($path);

        $model->file = '';
        $model->path = '';
        $model->ext = '';
        $model->date_upload = '';

        $model->save();

        Yii::$app->session->setFlash('deleteFile', 'File Successful Deleted');

        return $this->redirect(['rfq/quote','id'=>(string)$project]);

    }


    public function actionGenerate($id)
    {
        $model = $this->findModel($id);

        $check = Project::find()->all();

        if (empty($check)) {

            $modelsData = new Project();
            $modelsData->quotation_no = 1000;
            $modelsData->date_quotation = date('Y-m-d');
            $modelsData->date_time_quotation = date('Y-m-d H:i:s');
            $modelsData->status = 'Processing';
            $modelsData->rfq = $id;
            $modelsData->email = $model->email;
            $modelsData->contact = $model->phone_number;
            $modelsData->item = $model->catalog_no;
            $modelsData->quantity = 1;
            $modelsData->specification = '';
            $modelsData->description = '';
            $modelsData->price_unit = 0.00;
            $modelsData->shipping_charge_per_item = 0.00;
            $modelsData->shipping = 0.00;
            $modelsData->currency = 'MYR';
            $modelsData->discount_per_item = 0.00;
            $modelsData->in_percen = '';
            $modelsData->discount = 0.00;
            $modelsData->remark_per_item = $model->remark;
            $modelsData->type_tax = 'GST';
            $modelsData->tax = 6;
            $modelsData->remark = '';
            $modelsData->validity = '';
            $modelsData->lead_time = '';
            $modelsData->sub_total = 0.00;
            $modelsData->total = 0.00;


            
            $model->status = 'Processing';
            $modelsData->save() && $model->save();

        } else {

            $checkExist = Project::find()->where(['rfq'=>$id])->one();

            if (empty($checkExist)) {

                $modelsDataCheck = Project::find()
                ->orderBy([
                   'quotation_no'=>SORT_DESC,
                ])
                ->limit(1)
                ->one();

                $modelsDataNext = new Project();
                $modelsDataNext->quotation_no = $modelsDataCheck->quotation_no+1;
                $modelsDataNext->date_quotation = date('Y-m-d');
                $modelsDataNext->date_time_quotation = date('Y-m-d H:i:s');
                $modelsDataNext->status = 'Processing';
                $modelsDataNext->rfq = $id;
                $modelsDataNext->email = $model->email;
                $modelsDataNext->contact = $model->phone_number;
                $modelsDataNext->item = $model->catalog_no;
                $modelsDataNext->quantity = 1;
                $modelsDataNext->specification = '';
                $modelsDataNext->description = '';
                $modelsDataNext->price_unit = 0.00;
                $modelsDataNext->shipping_charge_per_item = 0.00;
                $modelsDataNext->shipping = 0.00;
                $modelsDataNext->currency = 'MYR';
                $modelsDataNext->discount_per_item = 0.00;
                $modelsDataNext->in_percen = '';
                $modelsDataNext->discount = 0.00;
                $modelsDataNext->remark_per_item = $model->remark;
                $modelsDataNext->type_tax = 'GST';
                $modelsDataNext->tax = 6;
                $modelsDataNext->remark = '';
                $modelsDataNext->validity = '';
                $modelsDataNext->lead_time = '';
                $modelsDataNext->sub_total = 0.00;
                $modelsDataNext->total = 0.00;

                $model->status = 'Processing';
                $modelsDataNext->save() && $model->save();

                
            }


        }

        $models = Project::find()
        ->where(['status' => 'Processing','rfq'=>$id])
        ->one();


        return $this->redirect(['quote', 'id' => (string)$models->_id]);



    }



    public function actionQuote($id)
    {
        $direct2asia = Direct2asia::find()->one();

        $models = Project::find()
        ->where(['status' => 'Processing','_id'=>$id])
        ->one();


        $model = Rfq::find()->where(['_id'=>(string)$models->rfq])->one();

        //$model = $this->findModel($id);

        return $this->render('quote', [
            'model' => $model,
            'direct2asia' => $direct2asia,
            'models' => $models,
        ]);
    }

    /**
     * Creates a new Rfq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rfq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Rfq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Rfq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rfq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Rfq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rfq::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
	
	public function actionMessage($project)
    {

		$newProject_id = new \MongoDB\BSON\ObjectID($project);

        $message = new Message();
        $model = Project::find()
        ->where(['_id'=>(string)$newProject_id])
        ->one();
        $message_all = Message::find()
        ->where(
            [
                'project' => $model->_id,
            ])
        ->orderBy([
            '_id'=>SORT_DESC,
        ])
        ->all();
		


        if ($message->load(Yii::$app->request->post()) ) {

            $message->date_create = date('Y-m-d H:i:s');
            $message->project = $newProject_id;
            $message->from_who = 'cs@direct2asia.com';
            $message->to_who = $model->email;
            $message->read_unread = 0;
            $message->save();


            $d2a = Url::to('@d2a');

            $from =  Yii::$app->params['adminEmail'];
            $to = $model->email;

            $subject = $from.' Reply Your Message For Quotation : '.$model->quotation_no;

            $text = $_POST['Message']['messages'].'<br>'.'View Message : '.$d2a.'/site/notify?id='.(string)$message->_id;

            Yii::$app->mailer->compose()
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject)
                ->setHtmlBody($text)
                ->send();


            return $this->redirect(['/rfq/message','project'=>(string)$project]);

        } else {

            return $this->render('message',[
                'model' => $model,
                'message' => $message,
                'message_all' => $message_all,

            ]);

        }



    }
	
	
	
}
