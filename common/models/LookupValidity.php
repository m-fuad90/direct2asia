<?php
namespace common\models;

use Yii;

/**
 * This is the model class for collection "lookup-validity".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $validity
 * @property mixed $enter_by
 * @property mixed $update_by
 * @property mixed $date_create
 * @property mixed $date_update
 */
class LookupValidity extends \yii\mongodb\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function collectionName()
    {
        return ['direct2asia', 'lookup-validity'];
    }

    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            '_id',
            'validity',
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
            [['validity', 'enter_by', 'update_by', 'date_create', 'date_update'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'validity' => 'Validity',
            'enter_by' => 'Enter By',
            'update_by' => 'Update By',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
}
