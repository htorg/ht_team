<?php
namespace common\logics\basic;
use common\logics\core\Logic;
use common\helpers\ThemeHelper;
use common\helpers\DataHelper;
use common\models\CmsArticle;
use common\logics\core\CacheLogic;
use yii\caching\Cache;
use yii\base\Object;
use yii\data\Pagination;
use common\models\CmsCategory;
use common\models\CmsPage;
use common\models\CmsPageAbout;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteAboutLogic extends Logic {
    public function getDataList() {
        return ['about'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getAbout($params) {
    	$data=CacheLogic::get('about');
    	if(!$data){
    			$params['status']=10;
    			$id=\Yii::$app->request->get('id',false);
    			if($id==false){
    				exit('参数错误');
    			}
    			$params['id']=$id;
		    	$data=CmsPageAbout::find()->with(['teams','events'])->where($params)->asArray()->one();
	    		CacheLogic::set('about', $data);
	    	}
    		return $data;
    	}    	

}