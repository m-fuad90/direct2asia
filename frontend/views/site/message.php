    <?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

$this->title = 'Message';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row service-box margin-bottom-40">

    <div class="col-md-12 col-sm-12">

        <h2><?= Html::encode($this->title) ?></h2>


            <div class="panel panel-default">

                <div class="panel-heading">Ref : QT <?= $model->quotation_no?></div>

                <div class="panel-body">

                    <?php if (empty($message_all)) { ?>


                    <?php } else { ?>

                        <?php foreach ($message_all as $key_all => $value_all) { ?>


                            <?php if ($value_all['from_who'] == $model->email) { ?>

                                <!-- BEGIN TESTIMONIALS -->
                                <div class="col-md-7 testimonials-v1 margin-bottom-40">          

                                      <div class="item">
                                        <blockquote>
                                            <p><?= $value_all['messages'] ?>
                                                
                                            </p>


                                        </blockquote>
                                            <span style="font-size: 12px;color: #000;" class="pull-right">
                                                <?= $value_all['date_create'] ?>
                                                    
                                            </span>
                                        <div class="carousel-info">
                                          <img class="pull-left" src="<?php echo Yii::$app->request->baseUrl; ?>/theme/assets/pages/img/people/personal.png" alt="">
                                          <div class="pull-left">
                                            <span class="testimonials-name"><?= $value_all['from_who'] ?></span>
                                          </div>
                                        </div>
                                      </div>
                                </div>

                                <!-- END TESTIMONIALS --> 


                            <?php } ?>


                            <?php if ($value_all['from_who'] == 'cs@direct2asia.com') { ?>

                                <!-- BEGIN TESTIMONIALS -->
                                <div class="col-md-7 testimonials-v2 pull-right">          

                                      <div class="item">
                                        <blockquote><p><?= $value_all['messages'] ?></p></blockquote>
                                            <span style="font-size: 12px;color: #000;" class="pull-left">
                                                <?= $value_all['date_create'] ?>
                                                    
                                            </span>



                                        <div class="carousel-info pull-right">
                                          <img class="pull-right" src="<?php echo Yii::$app->request->baseUrl; ?>/theme/assets/pages/img/people/admin.png" alt="">
                                          <div class="pull-left">
                                            <span class="testimonials-name"><?= $value_all['from_who'] ?></span>
                                          </div>
                                        </div>
                                      </div>

                                </div>
                                <!-- END TESTIMONIALS --> 


                            <?php } ?>





                        <?php } ?>

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

