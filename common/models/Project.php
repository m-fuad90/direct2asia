<?php

namespace common\models;

use Yii;

/**
 * This is the model class for collection "project".
 *
 * @property \MongoDB\BSON\ObjectID|string $_id
 * @property mixed $rfq
 * @property mixed $quotation_no
 * @property mixed $date_quotation
 * @property mixed $date_time_quotation
 */
class Project extends \yii\mongodb\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function collectionName()
    {
        return ['direct2asia', 'project'];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return [
            '_id',
            'rfq',
            'quotation_no',
            'date_quotation',
            'date_time_quotation',
            'status',
            'email',
            'contact',
            'item',
            'currency',
            'quantity',
            'specification',
            'description',
            'price_unit',
            'shipping_charge_per_item',
            'discount_per_item',
            'remark_per_item',
            'shipping',
            'discount',
            'type_tax',
            'tax',
            'remark',
            'validity',
            'lead_time',
            'total',
            'in_percen',
            'sub_total',
            'file',
            'path',
            'ext',
            'date_upload'


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rfq', 'quotation_no', 'date_quotation', 'date_time_quotation','status','email','contact','item','currency','quantity','specification','description','price_unit','shipping_charge_per_item','discount_per_item','remark_per_item','shipping','discount','tax','type_tax','remark','validity','lead_time','total','in_percen','sub_total','file','path','ext','date_upload'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => 'ID',
            'rfq' => 'Rfq',
            'quotation_no' => 'Quotation No',
            'date_quotation' => 'Date Quotation',
            'date_time_quotation' => 'Date Time Quotation',
        ];
    }
}
