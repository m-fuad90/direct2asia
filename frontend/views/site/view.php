<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Details';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row service-box margin-bottom-40">

    <div class="col-md-12 col-sm-12">

        <div class="panel panel-default">

            <div class="panel-heading">Order Summary
                <span class="pull-right">Place On : <?= $paypal->date ?></span></div>

                <div class="panel-body">


                    <div class="col-md-12 col-sm-12 blog-posts">

                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                              <!-- BEGIN CAROUSEL -->            
                              <div class="front-carousel">
                                <div class="carousel slide" id="myCarousel">
                                  <!-- Carousel items -->
                                  <div class="carousel-inner">
                                    <div class="item active">
                                        <?php $logo =  Yii::getAlias('@admin/'.$model->path.'/'.$model->file); ?>

                                        <img src="<?= $logo ?>" width="100px" height="100px">

                                    </div>
                                  </div>

                                </div>                
                              </div>
                              <!-- END CAROUSEL -->             
                            </div>
                            <div class="col-md-8 col-sm-8">
                              <h3><a href="#"><?= $model->item; ?></a></h3>
                              <ul class="blog-info">
                                <li>
                                    <?= $model->status; ?>
                                </li>

                              </ul>
                              <b>Specification : </b>
                              <p><?= $model->specification; ?></p>
                              <b>Description : </b>
                              <p><?= $model->description; ?></p>
                            </div>
                          </div>



                          <br>

                        <div class="row service-box margin-bottom-40">
                        <?php if ($model->shipping_status == 'Processing') { ?>

                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle-o blue"></i></em>
                                  <span>Processing</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle grey"></i></em>
                                  <span>Shipped</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle grey"></i></em>
                                  <span>Delivered</span>
                                </div>
                              </div>


                        <?php } elseif ($model->shipping_status == 'Shipped') { ?>

                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Processing</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle-o blue"></i></em>
                                  <span>Shipped</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle grey"></i></em>
                                  <span>Delivered</span>
                                </div>
                              </div>

                        <?php } elseif ($model->shipping_status == 'Delivered') { ?>

                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Processing</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Shipped</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-circle-o blue"></i></em>
                                  <span>Delivered</span>
                                </div>
                              </div>


                        <?php } elseif ($model->shipping_status == 'Item Received') { ?>

                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Processing</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Shipped</span>
                                </div>
                              </div>
                              <div class="col-md-4 col-sm-4">
                                <div class="service-box-heading">
                                  <em><i class="fa fa-check green"></i></em>
                                  <span>Delivered</span>
                                </div>
                              </div>


                        <?php } ?>
                        </div>






                    </div>







                </div>

            </div>

        </div>

    </div>


</div>