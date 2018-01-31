<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use common\models\Rfq;
use common\models\Message;
use common\models\Notification;

$model = Rfq::getQuote();
$notifyCustomer = Notification::notifyCustomer();

$msgBuyer = Message::msgBuyer();

AppAsset::register($this);


$script = <<< JS
$(document).ready(function(){

    $('.login').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.register').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
	
	$(".rightinfo").click(function (e) {
        $("#rightinfo").hide();
        $(".rightform").show();

    });

    $(".close-rightform").click(function (e) {
        $("#rightinfo").show();
        $(".rightform").hide();
    });

	
	
}); 
JS;
$this->registerJs($script);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="corporate">
<?php $this->beginBody() ?>

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">

                </div>
                <!-- END TOP BAR LEFT PART -->
                <?php if (Yii::$app->user->isGuest == 'Guest') { ?>

                  <!-- BEGIN TOP BAR MENU -->
                  <div class="col-md-6 col-sm-6 additional-nav">
                      <ul class="list-unstyled list-inline pull-right">
                          <li>

                            <?= Html::a('Log In',FALSE, ['value'=>Url::to(['/site/login',]),'class' => 'login','id'=>'login','style'=>'cursor:pointer;',]) ?>

                          </li>
                          <li>
                            <?= Html::a('Registration',FALSE, ['value'=>Url::to(['/site/signup',]),'class' => 'register','id'=>'register','style'=>'cursor:pointer;',]) ?>

                          </li>
                      </ul>
                  </div>
                  <!-- END TOP BAR MENU -->
                <?php } else { ?>
                  <!-- BEGIN TOP BAR MENU -->
                  <div class="col-md-6 col-sm-6 additional-nav">
                      <ul class="list-unstyled list-inline pull-right">
                          <li>
                            <?= Html::a('RFQ', ['/rfq/index'], ['class' => '']) ?>
                          </li>
                          <li>
                            <?= Html::a('Quotation', ['/rfq/quotation'], ['class' => '']) ?>
                          </li>
                          <li>
                            <?= Html::a('Order', ['/rfq/order'], ['class' => '']) ?>
                          </li>

						              <li>

                          <?php if (count($notifyCustomer) == 0) { ?>

                              <i class="fa fa-bell" style="color: #000;"></i>

                          <?php } else { ?>


                              <?= Html::a('<i class="fa fa-bell"></i><span class="badge">'.count($notifyCustomer).'</span>', ['/fisher/project/order'], ['class' => 'dropdown-toggle','data-toggle'=>'dropdown']) ?>

                                <ul class="dropdown-menu">
                                    <li>
                                    <?php foreach ($notifyCustomer as $key => $value) { ?>

                                        <?= Html::a($value['message'], 
                                          [
                                            $value['path'], 
                                            'id' => (string)$value['project'],
                                            'module' => $value['module']
                                          ], ['class' => '']) ?>

                                    <?php } ?>
                                    </li>


                                </ul>


                          <?php } ?>


                            
                        </li>
						              <li>
                            <?php if (count($msgBuyer) == 0) { ?>




                                <i class="fa fa-envelope" style="color: #000;"></i>

                            <?php } else { ?>


                                <?= Html::a('<i class="fa fa-envelope"></i><span class="badge">'.count($msgBuyer).'</span>', ['#'], ['class' => 'dropdown-toggle','data-toggle'=>'dropdown']) ?>

                                  <ul class="dropdown-menu">
                                      <li>
                                      <?php foreach ($msgBuyer as $key_msg => $value_msg) { ?>

                                          <?= Html::a('New Message : ' .$value_msg['messages'], 
                                            [
                                              '/site/notify', 
                                              'id' => (string)$value_msg['_id'],
          
                                            ], ['class' => '']) ?>

                                      <?php } ?>
                                      </li>


                                  </ul>


                            <?php } ?>
                        </li>
						  
                          <li>
                            <?= Html::a(Yii::$app->user->identity->username, ['/site/account'], ['class' => '']) ?>
                            <?= Html::a('[ Logout ]', ['/site/logout'], ['data-method'=>'POST','class' => '']) ?>
                          </li>

                      </ul>
                  </div>
                  <!-- END TOP BAR MENU -->
                <?php } ?>

            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->



    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">

        <?php $imgs = Yii::$app->request->baseUrl.'/theme/assets/corporate/img/logos/d2a.png';  ?>

        <?php $showimg =  Html::img($imgs);?>

        <?= Html::a($showimg, ['site/index'], ['class' => 'site-logo']) ?>




        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>





      </div>
    </div>
    <!-- Header END -->

    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-40">

    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">

        <!-- BEGIN STEPS -->
        <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step1">
              <h2>Step 1 :</h2>
              <p>Request Quotation</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step2">
              <h2>Step 2 :</h2>
              <p>Make An Order</p>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 front-step-col">
            <div class="front-step front-step3">
              <h2>Step 3 : </h2>
              <p>Proceed Payment</p>
            </div>
          </div>
        </div>
        <!-- END STEPS -->


		  
		          <div class="rightinfo" id="rightinfo">

            <a class="" href="#" style="text-decoration: none;color: #000000;">Get A Quote</a>

        </div>

        <div class="rightform " style="display: none;">

            <h4>Get A Quote <button type="button" class="close close-rightform" data-dismiss="alert" aria-hidden="true">×</button></h4>
            
            <br>
            <div class="row">
                <div class="col-md-12">
                    <?php $form = ActiveForm::begin(['action' => 'site/rfq']); ?>

                    <?= $form->field($model, 'catalog_no') ?>

                    <?= $form->field($model, 'phone_number') ?>

                    <?= $form->field($model, 'email')->textInput(['value'=>Yii::$app->user->isGuest == 'Guest' ? '' : Yii::$app->user->identity->email]) ?>

                    <?= $form->field($model, 'remark')->textArea(['rows'=>6,'class'=>'form-control']); ?>


                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

		  
		  
		  

        <?= $content ?>




      </div>
    </div>

    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
          <div class="col-md-4 col-sm-6 pre-footer-col">

          </div>
          <!-- END BOTTOM ABOUT BLOCK -->

        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

    <!-- BEGIN FOOTER -->
    <div class="footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN COPYRIGHT -->
          <div class="col-md-4 col-sm-4 padding-top-10">
            2018 © direct2asia.com
          </div>
          <!-- END COPYRIGHT -->
          <!-- BEGIN PAYMENTS -->
          <div class="col-md-4 col-sm-4">

          </div>
          <!-- END PAYMENTS -->
          <!-- BEGIN POWERED -->
          <div class="col-md-4 col-sm-4 text-right">

          </div>
          <!-- END POWERED -->
        </div>
      </div>
    </div>
    <!-- END FOOTER -->

<?php $this->endBody() ?>
</body>
</html>
<?php 
Modal::begin([
            'header' => 'Direct2Asia',
            'id'     => 'model',
            'size'   => 'model-lg',
    ]);
    
    echo "<div id='modelContent'></div>";
    
    Modal::end();
?>
<?php $this->endPage() ?>
