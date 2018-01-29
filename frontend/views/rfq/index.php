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


<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Catalog No</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Status</th>
            <th>Create At</th>
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

            </tr>
        <?php } ?>
    </tbody>
</table>