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
        'css/site.css',
    	'css/adminlte.css',
		'css/ionicons.min.css'	,
		'css/font-awesome.min.css',
		'css/fileinput.min.css',
		'css/skins/skin-green-light.min.css',
        'css/my_style.css',
    ];
    public $js = [    	
    	//'js/bootstrap.min.js',
    	'js/app.min.js',
    	'js/main.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    public static function addScript($view, $jsfile) {
        $view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
    
    public static function addCss($view, $cssfile) {
        $view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
