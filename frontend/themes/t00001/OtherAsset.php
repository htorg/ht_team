<?php

namespace frontend\themes\t00001;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class OtherAsset extends AssetBundle
{
    const THEME_CODE = 't00001';
    public $sourcePath = '@app/themes/t00001/dist';
    public $css = [
    	'css/default.css?code=t00001',
        'css/jquery.bxslider.css?code=t00001',
        'css/bx_style.css?code=t00001',
        'css/effect.css?code=t00001',
        'css/style.css?code=t00001',
    ];
    public $js = [
    	'js/effect.js?code=t00001',
    	'js/jquery.lazyload.min.js?code=t00001',
        'js/myJS.js?code=t00001',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
