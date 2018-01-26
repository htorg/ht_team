<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
	public $css = [
        'viewer/viewer.min.css'
    ];
    public $js = [
        'viewer/viewer.min.js',
    	'js/view.js'	
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];
}
