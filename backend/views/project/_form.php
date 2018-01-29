<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'quantity') ?>

    <?= $form->field($model, 'specification')->textArea(['rows'=>6,'class'=>'form-control']); ?>

    <?= $form->field($model, 'description')->textArea(['rows'=>6,'class'=>'form-control']); ?>

    <?= $form->field($model, 'price_unit') ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
