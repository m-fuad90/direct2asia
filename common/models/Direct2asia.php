<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "direct2asia".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $company
 * @property mixed $company_no
 * @property mixed $address
 * @property mixed $telephone_no
 * @property mixed $fax_no
 * @property mixed $email
 * @property mixed $tax_no
 */
class Direct2asia extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['direct2asia', 'direct2asia'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'company',
            'company_no',
            'address',
            'telephone_no',
            'fax_no',
            'email',
            'tax_no',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company', 'company_no', 'address', 'telephone_no', 'fax_no', 'email', 'tax_no'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'company' => 'Company',
            'company_no' => 'Company No',
            'address' => 'Address',
            'telephone_no' => 'Telephone No',
            'fax_no' => 'Fax No',
            'email' => 'Email',
            'tax_no' => 'Tax No',
        ];
    }
}
