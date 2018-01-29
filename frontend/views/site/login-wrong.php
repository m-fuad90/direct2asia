<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="row">
    <div class="col-md-12 col-sm-12">

                  <?php if(Yii::$app->session->hasFlash('wrong')) { ?>
                      <div class="alert alert-danger alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('wrong'); ?>
                      </div>
                  <?php } ?>
        
        <h1><?= Html::encode($this->title) ?></h1>
        <p>Please fill out the following fields to login:</p>







                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
     

    </div>
</div>