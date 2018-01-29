<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$discount = 0;
$shipping = 0;
$sumTax = 0;
$minTax = 0;
?>


<!-- BODY -->
<table class="body-wrap">
	<tr>
		<td class="container" bgcolor="#FFFFFF">

			<div class="content">
			<table border="0">
				<tr>
					<td colspan="6">
						<h3><b><?= $direct2asia->company; ?></b> <small>Co.No. : <?= $direct2asia->company_no; ?></small></h3>
					</td>  
                    <td class="right" align="center"><p><?= $model->currency ?></p></td>
				</tr>
                <tr>
                    <td colspan="7">
                        <p><?= $direct2asia->address; ?><br>
                        <b>TEL : </b> <?= $direct2asia->telephone_no; ?>   <b>EMAIL : </b> <?= $direct2asia->email; ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        
                    </td>
                </tr>
                <tr>
                    <td colspan="7" align="center"><h5><b>QUOTATION</b></h5></td>
                </tr>
                <tr>
                    <td colspan="7">
                        <hr class="hr-one">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td><p>To</p></td>
                    <td><p>:</p></td>
                    <td><p><?= $model->email ?></p></td>
                    <td>
                        
                    </td>
                    <td><p>No.</p></td>
                    <td><p>:</p></td>
                    <td><p><b>QT <?= $model->quotation_no ?></b></p></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td><p><b>Contact No : </b> <?= $model->contact; ?></p></td>
                    <td>
                        
                    </td>
                    <td><p>Date</p></td>
                    <td><p>:</p></td>
                    <td><p><?= $model->date_quotation; ?></p></td>
                </tr>
                <?php if (empty($model->validity)) { ?>

                <?php } else { ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td><p>Validity</p></td>
                    <td><p>:</p></td>
                    <td><p><?= $model->validity; ?></p></td>
                </tr>
                <?php } ?>
                <?php if (empty($model->lead_time)) { ?>

                <?php } else { ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td><p>Lead Time</p></td>
                    <td><p>:</p></td>
                    <td><p><?= $model->lead_time; ?></p></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="7">
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <table border="0" class="social" style="width: 100%;">
                            <thead>
                                <tr>
                                    <td align="center"><p><b>NO</b></p></td>
                                    <td><p><b>ITEM</b></p></th>
                                    <td align="right"><p><b>QTY</b></p></td>
                                    <td align="right"><p><b>U / PRICE (<?= $model->currency ?>)</b></p></td>
                                    <td align="right"><p><b>TOTAL (<?= $model->currency ?>)</b></p></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td align="center"><p>1</p></td>
                                    <td style="width: 50%;">
                                        <dl>
                                            <dt>
                                                <p><b>Catalog No : </b></p>
                                            </dt>
                                            <dd>
                                                <p><?= $model->item ?></p>


                                                    <img src="<?= $message->embed($logo); ?>" width="100px" height="100px">
                                                   
                                  
                          

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
                                    <td align="right">
                                        <p><?= $quantity= $model->quantity ?></p>
                                    </td>
                                    <td align="right">
                                        <p><?= $unit_price = $model->price_unit ?></p>
                                    </td>
                                    <td align="right">
                                        <p>
                                            <?php $total = $quantity * $unit_price; ?>
                                            <?= number_format((float)$total,2,'.',','); ?>
                                                
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="7">
                        <hr class="hr-one">
                        <br>
                    </td>
                </tr>
                <?php if (empty($model->remark)) { ?>

                <?php } else { ?>
                <tr>
                    <td><p>Remark</p></td>
                    <td><p>:</p></td>
                    <td colspan="5"><p><?= $model->remark ?></p></td>
                </tr>
                <?php } ?>

                <tr>
                    <td><p><b>Sub-Total</b></p></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align="right">
                        <p>
                            <?php $sub_total = $total; ?>
                            <?= number_format((float)$sub_total,2,'.',','); ?>
                        </p>
                    </td>
                </tr>
                <?php if (empty($model->in_percen)) { ?>

                <?php $after_dis = $discount; ?>

                <?php } else { ?>

                <tr>
                    <td><p>
                            <b>Discount  
                                <?php if (empty($model->in_percen)) { ?>
                                    

                                <?php } elseif ($model->in_percen == 'Yes') { ?>

                                    (<?= $model->discount.' %';?>)
                                    
                                <?php } else { ?>

                                    (<?= $model->discount ?>)

                                <?php } ?>


                            </b>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right">
                        <p>
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
                        </p>
                    </td>
                </tr>


                <?php } ?>



                <?php if (empty($model->shipping)) { ?>

                <?php $ship = $shipping; ?>


                <?php } else { ?>

                <tr>
                    <td><p><b>Shipping Charge</b></p></td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right">
                        <p>
                            <?php if (empty($model->shipping)) { ?>

                              <?php $ship = $shipping; ?>

                              <?php echo number_format((float)$shipping,2,'.',','); ?>

                            <?php } else { ?>

                              <?php $ship = $model->shipping; ?>
                              <?php echo number_format((float)$ship,2,'.',','); ?>

                            <?php } ?>
                        </p>
                    </td>
                </tr>

                <?php } ?>

                <?php if (empty($model->type_tax) || empty($model->tax)) { ?>

                <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>


                <?php } else { ?>

                <tr>
                    <td>
                        <p>
                            <b>
                                  <?php if (empty($model->type_tax)) { ?>

                                    
                                  <?php } else { ?>

                                      <?= $model->type_tax.' '.$model->tax.' %' ;?>
                                  <?php } ?>
                            </b>
                        </p>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right"><p>
                                    <?php if (empty($model->type_tax)) { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } else { ?>

                                      <?php $sumTax = ($sub_total - $after_dis) + $ship;  ?>
                                      <?php $minTax = $sumTax * ($model->tax / 100); ?>

                                      <?php echo number_format((float)$minTax,2,'.',','); ?>


                                    <?php } ?>
                    </p></td>
                </tr>

                <?php } ?>
                <tr>
                    <td><p><b>Total</b></p></td>
                    <td></td>
                    <td></td>
                    <td>
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td align="right"><p>
                    <?php $total = $sumTax + $minTax; ?>

                    <?php echo number_format((float)$total,2,'.',','); ?>                
                    </p></td>
                </tr>
			</table>
			</div><!-- /content -->

            <a href="<?php echo $url ?>" class="btn">ORDER NOW </a>

								
		</td>

	</tr>
</table><!-- /BODY -->

