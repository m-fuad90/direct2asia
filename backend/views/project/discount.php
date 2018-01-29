<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = 'Discount';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$dis = [

	'Yes' => 'Yes',
	'No' => 'No'
];
?>
<div class="project-create">

    <h1><?= Html::encode($this->title) ?></h1>

	<div class="project-form">

	    <?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'in_percen')->dropDownList(
	        $dis, 
	    [
	        'class' => 'form-control',
	        'id'=> 'in-percen-id',

	    ])->label('In Percentage ?') ?>


	    <?= $form->field($model, 'discount') ?>

	    <div class="form-group">
	        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
	    </div>

	    <?php ActiveForm::end(); ?>

	</div>
</div>
