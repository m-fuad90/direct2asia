<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAssetLogin extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'template/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'template/bower_components/font-awesome/css/font-awesome.min.css',
        'template/bower_components/Ionicons/css/ionicons.min.css',
        'template/dist/css/AdminLTE.min.css',
        'template/dist/css/skins/_all-skins.min.css',
        'template/plugins/iCheck/square/blue.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic'
    ];
    public $js = [
        
        'template/bower_components/bootstrap/dist/js/bootstrap.min.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
