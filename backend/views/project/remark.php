<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = 'Remark';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="project-form">

	    <?php $form = ActiveForm::begin(); ?>

	    <?= $form->field($model, 'remark')->textArea(['rows'=>6,'class'=>'form-control']); ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
