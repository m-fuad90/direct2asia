<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/site.css',
      'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all',
      'theme/assets/plugins/font-awesome/css/font-awesome.min.css',
      'theme/assets/plugins/bootstrap/css/bootstrap.min.css',
      'theme/assets/pages/css/animate.css',
      'theme/assets/plugins/fancybox/source/jquery.fancybox.css',
      'theme/assets/plugins/owl.carousel/assets/owl.carousel.css',
      'theme/assets/pages/css/components.css',
      'theme/assets/pages/css/slider.css',
      'theme/assets/corporate/css/style.css',
      'theme/assets/corporate/css/style-responsive.css',
      'theme/assets/corporate/css/themes/red.css',
      'theme/assets/corporate/css/custom.css',
    ];
    public $js = [

        'theme/assets/plugins/jquery-migrate.min.js',
        'theme/assets/plugins/bootstrap/js/bootstrap.min.js',      
        'theme/assets/corporate/scripts/back-to-top.js',
        'theme/assets/plugins/fancybox/source/jquery.fancybox.pack.js',
        'theme/assets/plugins/owl.carousel/owl.carousel.min.js',
        'theme/assets/corporate/scripts/layout.js',
        'theme/assets/pages/scripts/bs-carousel.js',
        'js/js.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
