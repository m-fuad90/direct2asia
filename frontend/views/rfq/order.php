<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\models\Project;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order';
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
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($list as $key => $value) { $i++;


            ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $value['item']; ?></td>
                <td><?= $value['email']; ?></td>
                <td><?= $value['contact']; ?></td>
                <td><?= $value['status']; ?></td>
                <td>
                    <?= Html::a('Detail', ['/site/view', 'project' => (string)$value['_id']], ['class' => 'btn btn-primary']) ?>
                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>