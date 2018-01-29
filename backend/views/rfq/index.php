<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RFQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content-header">
  <h1>
    <?= Html::encode($this->title) ?>
    <small>List Of RFQ</small>
  </h1>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">

                <?php if(Yii::$app->session->hasFlash('quoted')) { ?>
                      <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('quoted'); ?>
                      </div>

                <?php } ?>


            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>


                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Catalog No</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Create At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; foreach ($list as $key => $value) { $i++;

                                $project = Project::find()->where(['rfq'=>(string)$value['_id']])->one();




                                ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $value['catalog_no']; ?></td>
                                    <td><?= $value['email']; ?></td>
                                    <td><?= $value['phone_number']; ?></td>
                                    <td><?= $value['status']; ?></td>
                                    <td><?= $value['create_at']; ?></td>
                                    <td>
                                        <?php if ($value['status'] == 'Processing') { ?>

                                            <?= Html::a('Continue', ['quote', 'id' => (string)$project->_id], ['class' => 'btn btn-primary']) ?>
                                            

                                        <?php } else { ?>

                                            <?= Html::a('Quote', ['generate', 'id' => (string)$value['_id']], ['class' => 'btn btn-primary']) ?>

                                        <?php } ?>
                                        
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</section>
