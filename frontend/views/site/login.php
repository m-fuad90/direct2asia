<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$script = <<< JS
$(document).ready(function(){

    $('.register-g').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


}); 
JS;
$this->registerJs($script);
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12 col-sm-12">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to login:</p>

          <div class="row">

            <div class="col-md-6 col-sm-6">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-md-5 col-sm-5 pull-right">
              <div class="form-info">
                <h2><em>New</em> Customer</h2>
                <p>It's free and always will be.</p>

                <?= Html::a('Registration',FALSE, ['value'=>Url::to([
                    'signup',
                    ]),
                    'class' => 'btn btn-default register-g',
                    'style'=>'cursor:pointer;',

                ]) ?>


              </div>
            </div>


          </div>
    </div>
</div>