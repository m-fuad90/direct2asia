<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            '_id',
            'rfq',
            'quotation_no',
            'date_quotation',
            'date_time_quotation',
            //'status',
            //'email',
            //'contact',
            //'item',
            //'currency',
            //'quantity',
            //'specification',
            //'description',
            //'price_unit',
            //'shipping_charge_per_item',
            //'discount_per_item',
            //'remark',
            //'shipping',
            //'discount',
            //'type_tax',
            //'tax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
