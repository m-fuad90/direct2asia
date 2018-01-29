<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Direct2Asia';

$script = <<< JS
$(document).ready(function(){

    $("ul#menu li a").click(function (e) {
        e.preventDefault();
        $("#iframe").attr("src",$(this).attr("href"));
    });



}); 
JS;
$this->registerJs($script);

?>

<div class="row service-box margin-bottom-40">

    <div class="body-content">



                  <?php if(Yii::$app->session->hasFlash('submit')) { ?>
                      <div class="alert alert-success alert-dismissible">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                           <?php echo  Yii::$app->session->getFlash('submit'); ?>
                      </div>


                  <?php } ?>
        

        <ul id="menu" class="menu">
            <li>
                <a id="fisher" href="https://www.fishersci.com/us/en/home.html">FISHER</a>
            </li>
            <li>
                <a id="behr" href="http://www.behr-labor.de/">BEHR-LABOR</a>
            </li>
            <li>
                <a id="wisher" href="http://www.witeg.de/">WITEG</a>
            </li>
            <li>
                <a id="ika" href="https://www.ika.com/my">IKA</a>
            </li>
        </ul>
        <br>

        <iframe src="https://www.fishersci.com/us/en/home.html" class="iframe" id="iframe"></iframe>

    </div>

</div>




