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
        'css/default.css',
        'css/style.css',
    ];
    public $js = [
        'js/jquery.min.js',
        'js/jquery.bxslider.js',
        'js/bxDefault.js',
        'js/myJS.js',
        'js/chose.js',
        'js/frame.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
