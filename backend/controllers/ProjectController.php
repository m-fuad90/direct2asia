<?php

namespace backend\controllers;

use Yii;
use common\models\Project;
use common\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Rfq;
use common\models\Direct2asia;
use yii\helpers\Url;
use common\models\Notification;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
                        'actions' => ['update','lead','validity','remark','tax','shipping','discount','currency','archive'],
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => (string)$model->_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    public function actionLead($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('lead', [
            'model' => $model,
        ]);
    }

    public function actionValidity($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('validity', [
            'model' => $model,
        ]);
    }
    public function actionRemark($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('remark', [
            'model' => $model,
        ]);
    }
    public function actionTax($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('tax', [
            'model' => $model,
        ]);
    }
    public function actionShipping($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('shipping', [
            'model' => $model,
        ]);
    }
    public function actionDiscount($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['/rfq/quote', 'id' => (string)$model->_id]);
        }

        return $this->renderAjax('discount', [
            'model' => $model,
        ]);
    }
    public function actionCurrency()
    {

        $model = Project::find()
        ->where(['_id'=>$_POST['project']])
        ->one();

        $model->currency = $_POST['val'];
        $model->save();

    }
    public function actionArchive($project,$total)
    {


        $d2a = Url::to('@d2a');

        $direct2asia = Direct2asia::find()->one();

        $model = Project::find()
        ->where(['_id'=>(string)$project])
        ->one();

    
        $models = Rfq::find()->where(['_id'=>(string)$model->rfq])->one();

        $model->total = $total;
        $model->status = 'Quoted';

        $models->status = 'Quoted';

        $noti = Notification::find()
        ->where(['project'=>(string)$models->_id])
        ->one();

        $noti->status = 'Quoted';



        $model->save() && $models->save() && $noti->save();
		
		
				        $notification = new Notification();
        $notification->date = date('Y-m-d');
        $notification->date_time = date('Y-m-d H:i:s');
        $notification->message = 'Your Request Has Been Quoted';
        $notification->from_who = 'admin';
        $notification->to_who = $model->email;
        $notification->read_unread = 1;
        $notification->status = 'Quoted';
        $notification->project = (string)$model->_id;
        $notification->path = '/site/notification';
        $notification->module = 'quoted';

        $notification->save();
		
        $url = $d2a.'/site/notification?id='.(string)$model->_id.'&module=quoted';

        $from =  Yii::$app->params['adminEmail'];
        $to = $model->email;

        $messages[] = Yii::$app->mailer->compose("quotation",[
                'logo' => Yii::getAlias('@webroot/'.$model->path.'/'.$model->file),
                'model' => $model,
                'direct2asia' => $direct2asia,
                'url' => $url,


            ])
            ->setFrom($from)
            ->setTo($to)
            ->setSubject('Quotation Quoted')
            ->send();
		

		
		

        Yii::$app->session->setFlash('quoted', 'Quotation : QT '.$model->quotation_no.' Has Been Submit To Customer');

        return $this->redirect(['/rfq/index']); 


    }



    /**
     * Deletes an existing Project model.
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
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
