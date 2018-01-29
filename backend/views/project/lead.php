<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use common\models\LookupLeadTime;


$lead = ArrayHelper::map(LookupLeadTime::find()->asArray()->all(), 'lead_time', 'lead_time');
?>


<?php $form = ActiveForm::begin(); ?>


	<?= $form->field($model, 'lead_time')->dropDownList(
        $lead, 
    [
        'prompt' => '-Choose Lead Time-',
        'class' => 'form-control',
        'id'=> 'lead_time-id',

    ])->label('Lead Time') ?>
	 

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary m-btn--air', 'name' => 'login-button']) ?>
    </div>
 
<?php ActiveForm::end(); ?>