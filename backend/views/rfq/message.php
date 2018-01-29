<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Message';
$this->params['breadcrumbs'][] = $this->title;


?>
    <section class="content-header">
      <h1>
        <?= Html::encode($this->title) ?>
      </h1>

    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <div class="box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Quotation : QT <?= $model->quotation_no ?></h3>

                    </div>

                    <div class="box-body">



                        <?php if (empty($message_all)) { ?>


                        <?php } else { ?>

                            <div class="direct-chat-messages">
                            <?php foreach ($message_all as $key_all => $value_all) { ?>


                                <?php if ($value_all['from_who'] == 'cs@direct2asia.com') { ?>


                                        <!-- Message. Default to the left -->
                                        <div class="direct-chat-msg">
                                          <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"><?= $value_all['from_who'] ?></span>
                                            <span class="direct-chat-timestamp pull-right"><?= $value_all['date_create'] ?></span>
                                          </div>
                                          <!-- /.direct-chat-info -->
                                          <img class="direct-chat-img" src="<?php echo Yii::$app->request->baseUrl; ?>/adminlte/dist/img/admin.png" alt="Message User Image"><!-- /.direct-chat-img -->
                                          <div class="direct-chat-text">
                                           <?= $value_all['messages'] ?>
                                          </div>
                                          <!-- /.direct-chat-text -->
                                        </div>
                                        <!-- /.direct-chat-msg -->

                                <?php } ?>

                                <?php if ($value_all['from_who'] == $model->email) { ?>

                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                      <div class="direct-chat-info clearfix">
                                        <span class="direct-chat-name pull-right"><?= $value_all['from_who'] ?></span>
                                        <span class="direct-chat-timestamp pull-left"><?= $value_all['date_create'] ?></span>
                                      </div>
                                      <!-- /.direct-chat-info -->
                                      <img class="direct-chat-img" src="<?php echo Yii::$app->request->baseUrl; ?>/adminlte/dist/img/personal.png" alt="Message User Image"><!-- /.direct-chat-img -->
                                      <div class="direct-chat-text">
                                        <?= $value_all['messages'] ?>
                                      </div>
                                      <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->


                                <?php } ?>





                            <?php } ?>
                            </div>

                        <?php } ?>


                    </div>


                </div>


            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-md-10 col-sm-10">

                <?= $form->field($message, 'messages')->textArea(['rows'=>6,'class'=>'form-control'])->label(false); ?>
                
            </div>
            <div class="col-md-2 col-sm-2">

                <?= Html::submitButton($message->isNewRecord ? 'SEND' : 'SEND', ['class' => $message->isNewRecord ? 'btn btn-primary btn-lg' : 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </section>
