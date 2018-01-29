<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
$script = <<< JS
$(document).ready(function(){

    $('.checkout-g').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


}); 
JS;
$this->registerJs($script);
$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to signup:</p>

          <div class="row">

            <div class="col-md-7 col-sm-7">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>


            <div class="col-md-5 col-sm-5 pull-right">
              <div class="form-info">
                <h2><em>Returning</em> Customer</h2>
                <p>I am a returning customer.</p>

                <?= Html::a('Login',FALSE, ['value'=>Url::to([
                    'login',
                
                    ]),
                    'class' => 'btn btn-default checkout-g',
                    'style'=>'cursor:pointer;',

                ]) ?>


              </div>
            </div>




          </div>
    </div>
</div>

