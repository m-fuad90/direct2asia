<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\LookupValidity;

$validity = ArrayHelper::map(LookupValidity::find()->asArray()->all(), 'validity', 'validity');
?>


<?php $form = ActiveForm::begin(); ?>



	<?= $form->field($model, 'validity')->dropDownList(
        $validity, 
    [
        'prompt' => '-Choose Validity-',
        'class' => 'form-control',
        'id'=> 'validity-id',

    ])->label('Validity') ?>
	 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air']) ?>
    </div>
 
<?php ActiveForm::end(); ?>