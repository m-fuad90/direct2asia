<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->_id;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'remark',
            'shipping',
            'discount',
            'type_tax',
            'tax',
        ],
    ]) ?>

</div>
