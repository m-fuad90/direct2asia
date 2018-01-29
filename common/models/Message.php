<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "message".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $messages
 * @property mixed $from_who
 * @property mixed $to_who
 * @property mixed $project
 * @property mixed $date_create
 */
class Message extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['direct2asia', 'message'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'messages',
            'from_who',
            'to_who',
            'project',
            'date_create',
            'read_unread',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['messages', 'from_who', 'to_who', 'project', 'date_create','read_unread'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'messages' => 'Messages',
            'from_who' => 'From Who',
            'to_who' => 'To Who',
            'project' => 'Project',
            'date_create' => 'Date Create',
            'read_unread' => 'read unread',
        ];
    }

    public static function msgAdmin()
    {

        $data = Message::find()
        ->where(['to_who'=>'cs@direct2asia.com','read_unread'=>0])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

    public static function msgBuyer()
    {
        $user = User::find()->where(['_id'=>Yii::$app->user->identity->id])->one();

        $data = Message::find()
        ->where(['to_who'=>$user->email,'read_unread'=>0])
        ->orderBy([
           '_id'=>SORT_DESC,
        ])
        ->all();
        
        return $data;

    }

}
