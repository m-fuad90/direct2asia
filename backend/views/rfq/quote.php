<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Rfq */

$this->title = $model->catalog_no;
$this->params['breadcrumbs'][] = ['label' => 'RFQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$qt_title = 'QUOTATION';
$currency = [
  'USD'=>'USD',
  'MYR'=>'MYR',

];

$script = <<< JS
$(document).ready(function(){

    $('.edit').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editValidity').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editLead').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.editRemark').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.tax').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.shipping').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });
    $('.discount').click(function(){
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $('#currency').on('change', function() {
        var val = this.value;
        var project = $(this).find(':selected').data('id');

        $.ajax({
            type: 'POST',
            url: '/project/currency',
            data: 'val='+val+'&project='+project,
            success: function(data) {
                location.reload();
   

            }

        })

    });

    $('.fileUp').click(function(){
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
<section class="content-header">
  <h1>
    <?= Html::encode($this->title) ?>
  </h1>

</section> 
<style type="text/css">
  

body {
  background: rgb(255, 255, 255); 
}
page {
  background: white;
  display: block;
  margin: 0 auto;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
}
page[size="A4"] {  
  width: 21cm;
  height: auto; 
  padding: 5mm;
}
page[size="A4"][layout="portrait"] {
  width: 29.7cm;
  height: 21cm;  
}
page[size="A3"] {
  width: 29.7cm;
  height: 42cm;
}
page[size="A3"][layout="portrait"] {
  width: 42cm;
  height: 29.7cm;  
}
page[size="A5"] {
  width: 14.8cm;
  height: 21cm;
}
page[size="A5"][layout="portrait"] {
  width: 21cm;
  height: 14.8cm;  
}
@media print {
  body, page {
    margin: 0;
    box-shadow: 0;
  }
}
 @page {
  size: auto;
  margin: 0;
       }

tr.border_bottom td {
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);


}

@media print {
  #printPageButton {
    display: none;
  }
}

.print {
  margin-top: 20px;
  text-align: right;
  

}

.btn-print {
    padding: 10;
    color: #ffffff;
    font-size: 14px;
    cursor: pointer;
    background-color: #1e88e5;
}
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <body >
                <page size="A4">

                    <div>
                        <span style="font-size: 30px;font-weight: bold;"><?= $direct2asia->company; ?></span>
                        <span style="font-size: 11px;">Co.No. : <?= $direct2asia->company_no; ?></span>
                        <span class="pull-right">

                            <select class="form-control currency" id="currency">
                                <?php foreach ($currency as $key_currency => $value_currency) { ?>

                                  <option data-id="<?= $models->_id ?>" value="<?= $value_currency ?>" <?php echo ($value_currency == $models->currency) ? ' selected="selected"' : '';?> ><?= $value_currency ?></option>



                                <?php } ?>

      
                            </select>
     


                        </span>


                        <br>
                        <span style="font-size: 15px;">
                          <?= $direct2asia->address; ?>
         
                        </span>
                        <br>
                        <span style="font-size: 15px;">
                          <span style="font-size: 15px;font-weight: bold;">TEL : </span> <?= $direct2asia->telephone_no; ?>
                          &nbsp;
                          <span style="font-size: 15px;font-weight: bold;">EMAIL : </span> <?= $direct2asia->email; ?>

                        </span>

                    </div>
                    <p></p>
                    <br>
                    <div>
                        <h2 style="font-size: 22px;font-weight: bold;text-align: center;"><?php echo $qt_title; ?></h2>
                    </div>
                    <hr style="   border: 0;
                        height: 0;
                        border-top: 1px solid rgba(0, 0, 0, 0.1);
                        border-bottom: 1px solid rgba(255, 255, 255, 0.3);
                        ">


                    <div>
                      <table border="0" width="100%">
                          <tr>
                              <td style="width: 70px;vertical-align: top;"><span style="font-size: 15px;">To</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 430px;">
                             
                                <span style="font-size: 15px;">
                                
                                   <?=  $models->email ?>
                                
                                </span>

                                                    
                              </td>
                              <td style="width: 80px;vertical-align: top;"><span style="font-size: 15px;">No.</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="width: 130px;vertical-align: top;">
                                  
                                <span style="font-size: 15px;font-weight: bold;">QT <?= $models->quotation_no ?></span>
                                
                              </td>
                          </tr>




                          <tr >
                              <td style="width: 70px;vertical-align: top;" rowspan="3"></td>
                              <td style="width: 5px;vertical-align: top;" rowspan="3"></td>
                              <td style="width: 430px;" rowspan="3" valign="top">

                                <span style="font-size: 15px;">

                                  <b>Contact No</b> : <?= empty($models->contact) ? '' : $models->contact; ?>

                                </span>


                              </td>
                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Date</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;"><span style="font-size: 15px;"><?= $models->date_quotation; ?></span></td>

                          </tr>

                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Validity</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;">
                                <span style="font-size: 15px;">
                                


                                  <?php if (empty($models->validity)) { ?>


                                        <?= Html::a('Validity',FALSE, ['value'=>Url::to(['/project/validity','id'=>(string)$models->_id]),'class' => 'editValidity','id'=>'editValidity','style'=>'cursor:pointer;',]) ?>

                                    
                                  <?php } else { ?>


                                        <?= Html::a($models->validity,FALSE, ['value'=>Url::to(['/project/validity','id'=>(string)$models->_id]),'class' => 'editValidity','id'=>'editValidity','style'=>'cursor:pointer;',]) ?>



                                  <?php } ?>

                                </span>
                              </td>
                          </tr>
                          <tr>

                              <td style="vertical-align: top;width: 80px;"><span style="font-size: 15px;">Lead Time</span></td>
                              <td style="width: 5px;vertical-align: top;"><span style="font-size: 15px;">:</span></td>
                              <td style="vertical-align: top;width: 130px;">

                              <span style="font-size: 15px;">

                                  <?php if (empty($models->lead_time)) { ?>


                                    <?= Html::a('Lead Time',FALSE, ['value'=>Url::to(['/project/lead','id'=>(string)$models->_id]),'class' => 'editLead','id'=>'editLead','style'=>'cursor:pointer;',]) ?>

                                    
                                  <?php } else { ?>


                                        <?= Html::a($models->lead_time,FALSE, ['value'=>Url::to(['/project/lead','id'=>(string)$models->_id]),'class' => 'editLead','id'=>'editLead','style'=>'cursor:pointer;',]) ?>

                                  <?php } ?>
                                    
                              </span>
           
                              </td>
                          </tr>

                      </table>
                    </div>
                    <p></p>
                    <br>

                <?php if(Yii::$app->session->hasFlash('upload')) { ?>
                  <section class="content-header">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          
                           <?php echo  Yii::$app->session->getFlash('upload'); ?>
                      </div>
                  </section>
                <?php } ?>
                <?php if(Yii::$app->session->hasFlash('sizetype')) { ?>
                  <section class="content-header">
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          
                           <?php echo  Yii::$app->session->getFlash('sizetype'); ?>
                      </div>
                  </section>
                <?php } ?>
                <?php if(Yii::$app->session->hasFlash('deleteFile')) { ?>
                  <section class="content-header">
                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          
                           <?php echo  Yii::$app->session->getFlash('deleteFile'); ?>
                      </div>
                  </section>
                <?php } ?>


                    <div>

          


                      <table width="100%" border="0" >
                          <tr>
                              <td style="padding: 10px;background-color: #dedede;"><span style="font-size: 15px;font-weight: bold;">NO</span></td>
                              <td style="padding: 10px;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">ITEM</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">QTY</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">U / PRICE (<?= $models->currency?>)</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">TOTAL (<?= $models->currency?>)</span></td>
                              <td style="padding: 10px;text-align: right;background-color: #dedede;""><span style="font-size: 15px;font-weight: bold;">ACTION</span></td>
                          </tr>
                          <tr >
                              <td style="padding: 10px;width: 5px;" valign="top">
                                    <?php echo '1'; ?>
                              </td>
                              <td style="padding: 10px;width: 150px;">

                                  <dl>
                                      <dt>Image : </dt>
                                      <dd>
                                        <?= Html::a('Upload',FALSE, ['value'=>Url::to([
                                        'rfq/upload',
                                        'project'=> (string)$models->_id,
                                        ]),
                                        'class' => 'fileUp',
                                        'style'=>'cursor:pointer;',

                                        ]) ?>
                                        |

                                        <?= Html::a('Remove', ['rfq/remove', 'project' => (string)$models->_id], ['class' => '','data' => [
                                                    'confirm' => 'Are you sure you want to delete this File?',
                                                    'method' => 'post',
                                                ],]) ?>

                                        <br>
										<?php if (empty($models->path)) { ?>
										
																	 
										<?php } else { ?>
																	 
										<img class="img-responsive" src="<?php echo Yii::$app->request->baseUrl.'/'.$models->path.'/'.$models->file;?>" alt="Photo">
																	 
																	 
										<?php } ?>
                                        

                                      </dd>
                                      <dt>Catalog No : </dt>
                                      <dd>

                                        <?= empty($models->item) ? '' : $models->item; ?>
                                      </dd>
                                      <dt>Description : </dt>
                                      <dd>
                                        <?= empty($models->description) ? '' : $models->description; ?>
                                      </dd>
                                      <dt>Specification : </dt>
                                      <dd>
                                        <?= empty($models->specification) ? '' : $models->specification; ?>
                                      </dd>
                                  </dl>

                              </td>
                              <td style="padding: 10px;width: 5px;text-align: right;">
                                <?= $quantity = $models->quantity; ?>
                              </td>
                              <td style="padding: 10px;width: 200px;text-align: right;">
                                <?php $unit_price = $models->price_unit; ?>
                                <?php echo number_format((float)$unit_price,2,'.',','); ?>
                              </td>
                              <td style="padding: 10px;width: 200px;text-align: right;">
                                <?php $total = $quantity * $unit_price; ?>
                                <?php echo number_format((float)$total,2,'.',','); ?>
                              </td>
                              <td style="padding: 10px;width: 200px;text-align: right;">

                                  <?= Html::a('Edit',FALSE, ['value'=>Url::to(['/project/update','id'=>(string)$models->_id]),'class' => 'btn btn-primary edit','id'=>'edit','style'=>'cursor:pointer;',]) ?>

                                
                              </td>
                            </tr>
                            <tr class="border_bottom">
                                <td></td>
                                <td style="padding: 10px;" colspan="5">

                                      <dl>
                                          <dt>Remark :</dt>
                                          <dd><?= empty($models->remark_per_item) ? '' : $models->remark_per_item; ?></dd>
                                      </dl>
                                </td>
                   
                            </tr>

                      </table>

                    </div>
                    <br>
                    <div>
                        <table width="100%" border="0">
                            <tr>
                              <td colspan="5" class="text-left">
                                <span style="font-size: 15px;" >

                                  Remark : 

                                  <?php if (empty($models->remark)) { ?>


                                      <?= Html::a('{Remark}',FALSE, ['value'=>Url::to(['/project/remark','id'=>(string)$models->_id]),'class' => 'editRemark','id'=>'editRemark','style'=>'cursor:pointer;',]) ?>
                                    
                                  <?php } else { ?>

                                      <?= Html::a($models->remark,FALSE, ['value'=>Url::to(['/project/remark','id'=>(string)$models->_id]),'class' => 'editRemark','id'=>'editRemark','style'=>'cursor:pointer;',]) ?>

                                  <?php } ?>


                                      
                                </span>
                              </td>
               
                            </tr>
                            <tr>
                              <td colspan="4" class="text-left"><span style="font-size: 15px;font-weight: bold;">Sub-Total</span></td>
                              <td class="text-right">
                                  <span style="font-size: 15px;">

                                    <?php $sub_total = $total; ?>
                                    <?php echo number_format((float)$sub_total,2,'.',','); ?>
                                    
                                      
                                  </span>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-left">
                                <span style="font-size: 15px;font-weight: bold;">
                                  Discount 
                                  <?php if (empty($models->in_percen)) { ?>
                                    
                                    <?= Html::a('?',FALSE, ['value'=>Url::to(['/project/discount','id'=>(string)$models->_id]),'class' => 'discount','id'=>'discount','style'=>'cursor:pointer;',]) ?>

                                  <?php } elseif ($models->in_percen == 'Yes') { ?>

                                    <?= Html::a('('.$models->discount.' %)',FALSE, ['value'=>Url::to(['/project/discount','id'=>(string)$models->_id]),'class' => 'discount','id'=>'discount','style'=>'cursor:pointer;',]) ?>
                                    
                                  <?php } else { ?>

                                    <?= Html::a('('.$models->discount.')',FALSE, ['value'=>Url::to(['/project/discount','id'=>(string)$models->_id]),'class' => 'discount','id'=>'discount','style'=>'cursor:pointer;',]) ?>

                
                                  <?php } ?>
                                </span>
                              </td>
                              <td class="text-right">
                                  <span style="font-size: 15px;">

                                  <?php if (empty($models->in_percen)) { ?>

                                      <?php $after_dis = $discount; ?>

                                      <?= number_format((float)$after_dis,2,'.',','); ?>
                                    
                                  <?php } elseif ($models->in_percen == 'Yes') { ?>


                                      <?php $dis =  $models->discount / 100; ?>

                                      <?php $after_dis = $sub_total * $dis; ?>

                                      <?php echo number_format((float)$after_dis,2,'.',','); ?>



                                    
                                  <?php } else { ?>

                                      <?php $dis =  $models->discount; ?>

                                      <?php $after_dis = $dis; ?>

                                      <?php echo number_format((float)$after_dis,2,'.',','); ?>

                
                                  <?php } ?>


                                    
                                      
                                  </span>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-left">
                                <span style="font-size: 15px;font-weight: bold;">


                                  <?php if (empty($models->shipping)) { ?>

                                      <?= Html::a('Shipping Charge',FALSE, ['value'=>Url::to(['/project/shipping','id'=>(string)$models->_id]),'class' => 'shipping','id'=>'shipping','style'=>'cursor:pointer;',]) ?>
                                    
                                  <?php } else { ?>

                                      <?= Html::a('Shipping Charge',FALSE, ['value'=>Url::to(['/project/shipping','id'=>(string)$models->_id]),'class' => 'shipping','id'=>'shipping','style'=>'cursor:pointer;',]) ?>

                                  <?php } ?>

                                  </span>
                              </td>
                              <td class="text-right">
                                  <span style="font-size: 15px;">

                                    <?php if (empty($models->shipping)) { ?>

                                      <?php $ship = $shipping; ?>

                                      <?php echo number_format((float)$shipping,2,'.',','); ?>

                                    <?php } else { ?>

                                      <?php $ship = $models->shipping; ?>
                                      <?php echo number_format((float)$ship,2,'.',','); ?>

                                    <?php } ?>


                                  </span>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-left">
                                <span style="font-size: 15px;font-weight: bold;">


                                  <?php if (empty($models->type_tax)) { ?>


                                      <?= Html::a('Tax',FALSE, ['value'=>Url::to(['/project/tax','id'=>(string)$models->_id]),'class' => 'tax','id'=>'tax','style'=>'cursor:pointer;',]) ?>
                                    
                                  <?php } else { ?>

                                      <?= Html::a($models->type_tax.' '.$models->tax.' %',FALSE, ['value'=>Url::to(['/project/tax','id'=>(string)$models->_id]),'class' => 'tax','id'=>'tax','style'=>'cursor:pointer;',]) ?>

                                  <?php } ?>

                                  </span>
                              </td>
                              <td class="text-right">
                                  <span style="font-size: 15px;">

                                    <?php if (empty($models->type_tax)) { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } else { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>
                                      <?php $minTax = $sumTax * ($models->tax / 100); ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } ?>


                                    
                                      
                                  </span>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="4" class="text-left"><span style="font-size: 20px;font-weight: bold;">TOTAL</span></td>
                              <td class="text-right">
                                <span style="font-size: 20px;" class="">
                                  <b>


                                    <?php $total = $sumTax + $minTax; ?>

                                    <?php echo number_format((float)$total,2,'.',','); ?>

        

                                  </b>
                                
                                </span>
                              </td>
                            </tr>



                        </table>

                    </div>
                    <div class="print">
                        
                          <?= Html::a('QUOTE', 
                            [
                            'project/archive', 
                            'project' => (string)$models->_id,
                            'total' => (string)$total,

                            ], 
                            [
                                'class' => 'btn btn-primary',
    
                            ]) ?>



                    </div>


                </page>
            </body>



        </div>
    </div>
</section>




