<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for collection "notification".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $date
 * @property mixed $date_time
 * @property mixed $message
 * @property mixed $from_who
 * @property mixed $to_who
 * @property mixed $path
 */
class Notification extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['direct2asia', 'notification'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'date',
            'date_time',
            'message',
            'from_who',
            'to_who',
            'read_unread',
            'status',
            'project',
            'path',
            'module'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'date_time', 'message', 'from_who', 'to_who','read_unread','project','path','module','status'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'date' => 'Date',
            'date_time' => 'Date Time',
            'message' => 'Message',
            'from_who' => 'From Who',
            'to_who' => 'To Who',
            'read_unread' => 'Read Unread',
            'project' => 'Project',
            'path' => 'Path',
            'module' => 'module',
            'status' => 'Status',
        ];
    }

    public static function notifyAdmin()
    {

        $data = Notification::find()
        ->where(['to_who'=>'admin','read_unread'=>1])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

    public static function notifyAdminInProgressQt()
    {

        $data = Notification::find()
        ->where(['to_who'=>'admin','status'=>'In Processing Quotation'])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }
    
    public static function notifyCustomer()
    {

        $user = User::find()->where(['_id'=>Yii::$app->user->identity->id])->one();

        $data = Notification::find()
        ->where(['to_who'=>$user->email,'read_unread'=>1])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

/*

    public static function notifyAdmin()
    {

        $data = Notification::find()
        ->where(['to_who'=>'admin','read_unread'=>1])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

    public static function notifyAdminInProgressQt()
    {

        $data = Notification::find()
        ->where(['to_who'=>'admin','status'=>'In Progress Quotation'])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

    public static function notifyAdminInProgressOrder()
    {

        $data = Notification::find()
        ->where(['to_who'=>'admin','status'=>'In Progress Order'])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }




    public static function notifyCustomer()
    {

        $user = User::find()->where(['_id'=>Yii::$app->user->identity->id])->one();

        $data = Notification::find()
        ->where(['to_who'=>$user->email,'read_unread'=>1])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

    public static function notifyCustomerNeedToConfirm()
    {

        $user = User::find()->where(['_id'=>Yii::$app->user->identity->id])->one();

        $data = Notification::find()
        ->where(['to_who'=>$user->email,'status'=>'Need To Confirm'])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }
*/



}
