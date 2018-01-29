<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "rfq".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $catalog_no
 * @property mixed $phone_number
 * @property mixed $email
 * @property mixed $create_at
 */
class Rfq extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['direct2asia', 'rfq'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'catalog_no',
            'phone_number',
            'email',
            'create_at',
            'status',
            'remark'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['catalog_no', 'phone_number', 'email', 'create_at','remark'], 'safe'],
            ['phone_number', 'required', 'message' => 'Please Put Phone No.'],
            ['catalog_no', 'required', 'message' => 'Please Put Catalog No.'],
            ['email', 'required', 'message' => 'Please Fill In Your Email.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'catalog_no' => 'Catalog No',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'create_at' => 'Create At',
            'remark' => 'Remark'
        ];
    }
	
	
	    public static function getQuote()
    {
        $model = new Rfq();

        return $model;
    }
    
	
}
