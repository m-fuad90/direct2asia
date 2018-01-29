<?php

namespace frontend\controllers;

use Yii;
use common\models\Rfq;
use common\models\RfqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;
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
                        'actions' => ['index','quotation'],
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

        $user = User::find()
        ->where(['_id'=>Yii::$app->user->identity->id])
        ->one();


        $list = Rfq::find()->where(
            [
                'email' => $user->email,
                'status' => 'Request'
            ])->all();

        return $this->render('index', [
            'list' => $list,
        ]);
    }


    public function actionQuotation()
    {

        $user = User::find()
        ->where(['_id'=>Yii::$app->user->identity->id])
        ->one();


        $list = Rfq::find()->where(
            [
                'email' => $user->email,
                'status' => 'Quoted'
            ])->all();

        return $this->render('quotation', [
            'list' => $list,
        ]);
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
}
