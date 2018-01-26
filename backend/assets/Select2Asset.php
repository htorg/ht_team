<?php

namespace backend\assets;

use yii\web\AssetBundle;
/**
 * Main frontend application asset bundle.
 */
class Select2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'select2\select2.min.css',
    ];
    public $js = [
        'select2\select2.min.js',
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}
