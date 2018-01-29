<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'template/bower_components/font-awesome/css/font-awesome.min.css',
        'template/bower_components/Ionicons/css/ionicons.min.css',
        'template/bower_components/jvectormap/jquery-jvectormap.css',
        'template/bower_components/bootstrap-daterangepicker/daterangepicker.css',
        'template/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        'template/dist/css/AdminLTE.min.css',
        'template/dist/css/skins/_all-skins.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic',
        'template/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css'
    ];
    public $js = [

        'template/bower_components/bootstrap/dist/js/bootstrap.min.js',
        'template/bower_components/fastclick/lib/fastclick.js',
        'template/dist/js/adminlte.min.js',
        'template/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js',
        'template/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
        'template/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
        'template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js',
        'template/bower_components/Chart.js/Chart.js',
        'template/dist/js/pages/dashboard2.js',
        'template/bower_components/bootstrap-daterangepicker/daterangepicker.js',
        'template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        'template/dist/js/demo.js',
        'template/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js'
        
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
