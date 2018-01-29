<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'Order';

$script = <<< JS
$(document).ready(function(){

    $('.checkout-g').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });


}); 
JS;
$this->registerJs($script);
$discount = 0;
$shipping = 0;
$sumTax = 0;
$minTax = 0;
?>

<div class="row service-box margin-bottom-40">

    <div class="body-content">


        <table class="table table-bordered" border="0">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>UNIT / PRICE (<?= empty($model->currency) ? '' : $model->currency; ?>)</th>
                    <th></th>
                    <th>TOTAL (<?= empty($model->currency) ? '' : $model->currency; ?>)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td style="width:60%;">
                        <dl>
                            <dt>Catalog No : </dt>
                            <dd>
                                <?= empty($model->item) ? '' : $model->item; ?>
                            </dd>
                            <?php if (empty($model->description)) { ?>

                            <?php } else { ?>
                            <dt>
                                <p><b>Description : </b></p>
                            </dt>
                            <dd>
                                <p><?= $model->description ?></p>
                            </dd>
                            <?php }  ?>
                            <?php if (empty($model->specification)) { ?>

                            <?php } else { ?>
                            <dt>
                                <p><b>Specification : </b></p>
                            </dt>
                            <dd>
                                <p><?= $model->specification ?></p>
                            </dd>
                            <?php }  ?>

                        </dl>

                    </td>
                    <td>
                        <?= $quantity= $model->quantity ?>
                    </td>
                    <td>
                        <?= $unit_price = $model->price_unit ?>
                    </td>
                    <td></td>
                    <td>
                        <?php $total = $quantity * $unit_price; ?>
                        <?= number_format((float)$total,2,'.',','); ?>
                    </td>


                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>
                        <b>Sub-Total</b>
                    </td>
                    <td>:</td>
                    <td>
                        <?php $sub_total = $total; ?>
                        <?= number_format((float)$sub_total,2,'.',','); ?>
                    </td>
                </tr>

                <?php if (empty($model->in_percen)) { ?>

                <?php $after_dis = $discount; ?>

                <?php } else { ?>


                <tr>
                    <td colspan="3"></td>
                    <td>
                            <b>Discount  
                                <?php if (empty($model->in_percen)) { ?>
                                    

                                <?php } elseif ($model->in_percen == 'Yes') { ?>

                                    (<?= $model->discount.' %';?>)
                                    
                                <?php } else { ?>

                                    (<?= $model->discount ?>)

                                <?php } ?>


                            </b>
                    </td>
                    <td>:</td>
                    <td>
                                  <?php if (empty($model->in_percen)) { ?>

                                      <?php $after_dis = $discount; ?>

                                      <?= number_format((float)$after_dis,2,'.',','); ?>
                                    
                                  <?php } elseif ($model->in_percen == 'Yes') { ?>


                                      <?php $dis =  $model->discount / 100; ?>

                                      <?php $after_dis = $sub_total * $dis; ?>

                                      <?php echo number_format((float)$after_dis,2,'.',','); ?>



                                    
                                  <?php } else { ?>

                                      <?php $dis =  $model->discount; ?>

                                      <?php $after_dis = $dis; ?>

                                      <?php echo number_format((float)$after_dis,2,'.',','); ?>

                
                                  <?php } ?>
                    </td>
                </tr>

                <?php } ?>

                <?php if (empty($model->shipping)) { ?>

                <?php $ship = $shipping; ?>


                <?php } else { ?>

                <tr>
                    <td colspan="3"></td>
                    <td>
                        <b>Shipping Charge</b>
                    </td>
                    <td>:</td>
                    <td>
                            <?php if (empty($model->shipping)) { ?>

                              <?php $ship = $shipping; ?>

                              <?php echo number_format((float)$shipping,2,'.',','); ?>

                            <?php } else { ?>

                              <?php $ship = $model->shipping; ?>
                              <?php echo number_format((float)$ship,2,'.',','); ?>

                            <?php } ?>
                    </td>
                </tr>

                <?php } ?>

                <?php if (empty($model->type_tax) || empty($model->tax)) { ?>

                <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>


                <?php } else { ?>


                <tr>
                    <td colspan="3"></td>
                    <td>
                        <b>
                                  <?php if (empty($model->type_tax)) { ?>

                                    
                                  <?php } else { ?>

                                      <?= $model->type_tax.' '.$model->tax.' %' ;?>
                                  <?php } ?>

                        </b>
                    </td>
                    <td>:</td>
                    <td>
                                    <?php if (empty($model->type_tax)) { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } else { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>
                                      <?php $minTax = $sumTax * ($model->tax / 100); ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } ?>
                    </td>
                </tr>

                <?php } ?>

                <tr>
                    <td colspan="3"></td>
                    <td>
                        <b>
                            TOTAL
                        </b>
                    </td>
                    <td>:</td>
                    <td>
                    <?php $total = $sumTax + $minTax; ?>

                    <?php echo number_format((float)$total,2,'.',','); ?>       
                    </td>
                </tr>


            </tbody>
        </table>

        <?php if (Yii::$app->user->isGuest == 'Guest') { ?>

            <?= Html::a('CHECKOUT',FALSE, ['value'=>Url::to([
                'checkout-guest',
                'project' => $project,
                'customer' => $customer
                ]),
                'class' => 'btn btn-primary pull-right checkout-g',
                'style'=>'cursor:pointer;',

            ]) ?>

 
        <?php } else { ?>

            <?= Html::a('CHECKOUT', [
                'place', 
                'project' => $project,
                'customer' => $customer
                ], ['class' => 'btn btn-primary pull-right']) ?>

        <?php } ?>




    </div>

</div>




