<?php
namespace common\models;

use Yii;

/**
 * This is the model class for collection "lead-time".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $lead_time
 * @property mixed $enter_by
 * @property mixed $update_by
 * @property mixed $date_create
 * @property mixed $date_update
 */
class LookupLeadTime extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['direct2asia', 'lookup-lead-time'];

    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'lead_time',
            'enter_by',
            'update_by',
            'date_create',
            'date_update',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lead_time', 'enter_by', 'update_by', 'date_create', 'date_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'lead_time' => 'Lead Time',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
}
