<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, '_id') ?>

    <?= $form->field($model, 'rfq') ?>

    <?= $form->field($model, 'quotation_no') ?>

    <?= $form->field($model, 'date_quotation') ?>

    <?= $form->field($model, 'date_time_quotation') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'contact') ?>

    <?php // echo $form->field($model, 'item') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'quantity') ?>

    <?php // echo $form->field($model, 'specification') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'price_unit') ?>

    <?php // echo $form->field($model, 'shipping_charge_per_item') ?>

    <?php // echo $form->field($model, 'discount_per_item') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'shipping') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'type_tax') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
