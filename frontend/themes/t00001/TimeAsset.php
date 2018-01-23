<?php

namespace frontend\themes\t00001;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class TimeAsset extends AssetBundle
{
    const THEME_CODE = 't00001';
    public $sourcePath = '@app/themes/t00001/dist';
    public $css = [

    ];
    public $js = [
    	'js/bootstrap.min.js?code=t00001',	
    	'js/bootstrap-datetimepicker.js?code=t00001',
        'js/bootstrap-datetimepicker.zh-CN.js?code=t00001',
    ];
    public $depends = [
    		'yii\web\YiiAsset',
    		'yii\bootstrap\BootstrapAsset',
    ];
    public static function addScript($view, $jsfile) {
    	$view->registerJsFile($jsfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
    
    public static function addCss($view, $cssfile) {
    	$view->registerCssFile($cssfile, [AppAsset::className(), 'depends' => 'backend\assets\AppAsset']);
    }
}
