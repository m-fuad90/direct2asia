<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "paypal".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $paymentID
 * @property mixed $payerID
 * @property mixed $paymentToken
 * @property mixed $project
 * @property mixed $date_time
 * @property mixed $date
 * @property mixed $transactionID
 */
class Paypal extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['direct2asia', 'paypal'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'paymentID',
            'payerID',
            'paymentToken',
            'project',
            'date_time',
            'date',
            'transactionID',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['paymentID', 'payerID', 'paymentToken', 'project', 'date_time', 'date', 'transactionID'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'paymentID' => 'Payment ID',
            'payerID' => 'Payer ID',
            'paymentToken' => 'Payment Token',
            'project' => 'Project',
            'date_time' => 'Date Time',
            'date' => 'Date',
            'transactionID' => 'Transaction ID',
        ];
    }
}
