<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\widgets\Menu;
use common\models\Notification;
use common\models\Message;

$notifyAdmin = Notification::notifyAdmin();
$notifyAdminInProgressQt = Notification::notifyAdminInProgressQt();
$msgAdmin = Message::msgAdmin();

AppAsset::register($this);
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
<body class="hold-transition skin-red fixed sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo Yii::$app->request->baseUrl; ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D2</b>A</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Direct2</b>Asia</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <?php echo count($msgAdmin) == 0 ? '' : '<span class="label label-success">'.count($msgAdmin).'</span>' ?>

            </a>
            <?php if (empty($msgAdmin)) { ?>
                                                    
            <?php } else { ?>



            <ul class="dropdown-menu">
              <li class="header">You have <?= count($msgAdmin) == 0 ? '' : count($msgAdmin) ?> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <?php foreach ($msgAdmin as $key_msg => $value_msg) { ?>
                  <li><!-- start message -->


                          <?= Html::a(
                            '<div class="pull-left">
                           <img src="'.Yii::$app->request->baseUrl.'/adminlte/dist/img/personal.png" class="img-circle" alt="User Image"></div><h4>'.$value_msg['from_who'].'<small><i class="fa fa-clock-o"></i></small></h4><p>'.$value_msg['messages'].'</p>',
                          [
                            '/site/message',
                            'id' => (string)$value_msg['_id'],

                          ], 
                          ['class' => '']) ?>




                  </li>
                  <?php } ?>



                </ul>
              </li>
  
            </ul>

            <?php } ?>


          </li>


          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="/" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <?php echo count($notifyAdmin) == 0 ? '' : '<span class="label label-default">'.count($notifyAdmin).'</span>' ?>
              
            </a>

            <?php if (empty($notifyAdmin)) { ?>
                                                    
            <?php } else { ?>
              <ul class="dropdown-menu">
                  <li class="header">You have <?= count($notifyAdmin) == 0 ? '' : count($notifyAdmin) ?> notifications</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                      <ul class="menu">
                        <?php foreach ($notifyAdmin as $key => $value) { ?>
                        <li>



                            <?= Html::a(
                              '<div class="pull-left"><i class="fa fa-file"></i></div><br><p>'.$value['message'].'</p><small class="pull-right"><i class="fa fa-clock-o"></i> '.$value['date_time'].'</small>',
                            [
                              $value['path'],
                              'id' => (string)$value['_id'],
                              'module' => $value['module']
                            ], 
                            ['class' => '']) ?>



                        </li>
                         <?php } ?>
                      </ul>
                  </li>

              </ul>


            <?php } ?>


          </li>


          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="disabled">
              <span class="hidden-xs"><?= Yii::$app->user->identity->email; ?></span>
            </a>

          </li>
          <li>
            <?= Html::a('<i class="fa fa-sign-out"></i> Logout', ['/site/logout'],['class'=>'','title'=>'Logout','data-method'=>'POST']) ?>

          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->


      <!-- sidebar menu: : style can be found in sidebar.less -->

                    <?php
                    echo Menu::widget([
                        'items' => [
                            [
                                'label' => 'MAIN NAVIGATION',
                                'options'=>['class'=>'header'],
                            ],
                            [
                                'label' => 'DASHBOARD', 
                                'url' => ['site/index'],
                                'template'=> '<a href="{url}"><i class="fa fa-circle-o text-default"></i>{label}</a>',
                            ],
                            [
                                'label' => 'RFQ', 
                                'url' => ['/rfq/index'],
                                'template'=> count($notifyAdminInProgressQt) == 0 ? '<a href="{url}"><i class="fa fa-circle-o text-default"></i>{label}</a>' : '<a href="{url}"><i class="fa fa-circle-o text-default"></i>{label}<span class="pull-right-container"><span class="label label-primary pull-right" data-toggle="tooltip" data-original-title="Pending Quote">'.count($notifyAdminInProgressQt).'</span></span></a>',
                            ],
                            [
                                'label' => 'QUOTATION', 
                                'url' => ['rfq/quotation'],
                                'template'=> '<a href="{url}"><i class="fa fa-circle-o text-default"></i>{label}</a>',
                            ],
                            [
                                'label' => 'OTHERS',
                                'options'=>['class'=>'header'],
                            ],
                            [
                                'label' => 'CUSTOMER', 
                                'url' => ['user/index'],
                                'template'=> '<a href="{url}"><i class="fa fa-circle-o text-aqua"></i>{label}</a>',
                            ],


                        ],
                        'options' => [
                            'class' => 'sidebar-menu',
                            'data-widget' => 'tree',

                        ],
                        //'itemOptions'=> ['class' => 'dropdown dropdown-fw dropdown-fw-disabled'],
                        'activateParents'=>true,
                        'encodeLabels' => false,

                    ]);
                    ?>


    </section>
    <!-- /.sidebar -->
  </aside>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>

  </div>
  <!-- /.content-wrapper -->
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://lesoscm.com/" target="_BLANK">LESO Supplier Chain Management System</a>.</strong>
  </footer>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->




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
