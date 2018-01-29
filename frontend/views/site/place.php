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

$baseUrl = Url::to('@paypal');
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

 
        <?php } else { ?>

        <div id="paypal-button-container" class="pull-right"></div>



        <?php } ?>




    </div>

</div>

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
      <script>
        paypal.Button.render({

            env: 'production',
            //env: 'sandbox',

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create
            client: {
                //sandbox:    'AaClFWfUpTbAUct7_St5dRPNgl4x_J0jMQU5XU70KkPitCffxFAhZ_NgXtM40EDY__6fkdz5S2CjZRLq',
                production:  'AdR0126xOc6UlLuQQCVZphLOZ5uUCa7SY04kTkhD5eKLQK3WWzglK2FMkOM0-fEXnwRroC3wc0ZzR5Vm',

            },

          style: {
              label: 'paypal',
              size:  'medium',    // small | medium | large | responsive
              shape: 'rect',     // pill | rect
              color: 'gold',     // gold | blue | silver | black
              tagline: false    
          },


            // Show the buyer a 'Pay Now' button in the checkout flow
            commit: true,

            // payment() is called when the button is clicked
            payment: function(data, actions) {


                
                // Make a call to the REST api to create the payment
                return actions.payment.create({
                    payment: {
                        transactions: [
                            {
                                amount: { 
                                  total: '<?php echo round($sub_total - $after_dis + $minTax + $ship,2); ?>', 
                                  currency: '<?php echo $model->currency;?>',
                                  details:  {
                                      subtotal: '<?php echo $sub_total; ?>',
                                      discount: '<?php echo $after_dis; ?>',
                                      tax: '<?php echo $minTax; ?>',
                                      handling_fee: '<?php echo $ship; ?>'
                          
                
                                    }

                                },
                                item_list: {
                                  items: [
                                      {
                                        quantity: '<?= $quantity ?>',
                                        name: '<?= empty($model->item) ? '' : $model->item; ?>',
                                        price: '<?= $unit_price = $model->price_unit ?>',
                                        currency: '<?= $model->currency ?>',
                                        description: '<?= $model->description ?>',
                                        tax: '<?= $model->tax ?>'

                                      }
                                  ]
                                }
                            }
                        ]
                    }
                });
            },



            // onAuthorize() is called when the buyer approves the payment
            onAuthorize: function(data, actions) {

                // Make a call to the REST api to execute the payment // get
                return actions.payment.execute().then(function(paymentDetails) {

                  var total_final = JSON.stringify(paymentDetails.transactions[0].amount.total).replace(/\"/g, "");
                  var handling_fee = JSON.stringify(paymentDetails.transactions[0].amount.details.handling_fee).replace(/\"/g, "");
                  var transacId = JSON.stringify(paymentDetails.transactions[0].related_resources[0].sale.id).replace(/\"/g, "");

                  window.location = "<?php echo $baseUrl; ?>/transaction?transacId="+transacId+"&total_final="+total_final+"&handling_fee="+handling_fee+"&paymentID="+data.paymentID+"&payerID="+data.payerID+"&paymentToken="+data.paymentToken+"&project=<?php echo (string)$model->_id; ?>";


               
                  

                });


            }


        }, '#paypal-button-container');

    </script>


