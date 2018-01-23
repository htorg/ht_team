<?php
namespace frontend\themes\t00001\widgets\aboutNav;
use yii\base\Widget;
use common\models\CmsProductInfo;
use common\models\CmsPageAbout;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/7/1
 * Time: 19:48
 */
class AboutNavWidget extends Widget {
	public $siteId;
	public $langId;
    public function init()
    {
        parent::init();
    }

    public function run()
    {
    	$type=\Yii::$app->request->get('type',0);
        $about = CmsPageAbout::find()->select(['banner','top_banner_name','top_banner_desc'])->where(['site_id'=>$this->siteId,'lang_id'=>$this->langId,'status'=>10])->asArray()->all(); 
        return $this->render('basic',['about'=>$about,'type'=>$type]);
    }
}