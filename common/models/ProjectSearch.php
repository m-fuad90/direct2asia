<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `common\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'rfq', 'quotation_no', 'date_quotation', 'date_time_quotation', 'status', 'email', 'contact', 'item', 'currency', 'quantity', 'specification', 'description', 'price_unit', 'shipping_charge_per_item', 'discount_per_item', 'remark', 'shipping', 'discount', 'type_tax', 'tax'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Project::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['like', '_id', $this->_id])
            ->andFilterWhere(['like', 'rfq', $this->rfq])
            ->andFilterWhere(['like', 'quotation_no', $this->quotation_no])
            ->andFilterWhere(['like', 'date_quotation', $this->date_quotation])
            ->andFilterWhere(['like', 'date_time_quotation', $this->date_time_quotation])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'contact', $this->contact])
            ->andFilterWhere(['like', 'item', $this->item])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'quantity', $this->quantity])
            ->andFilterWhere(['like', 'specification', $this->specification])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'price_unit', $this->price_unit])
            ->andFilterWhere(['like', 'shipping_charge_per_item', $this->shipping_charge_per_item])
            ->andFilterWhere(['like', 'discount_per_item', $this->discount_per_item])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'shipping', $this->shipping])
            ->andFilterWhere(['like', 'discount', $this->discount])
            ->andFilterWhere(['like', 'type_tax', $this->type_tax])
            ->andFilterWhere(['like', 'tax', $this->tax]);

        return $dataProvider;
    }
}
