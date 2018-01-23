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
use common\models\CmsPageContact;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteContactLogic extends Logic {
    public function getDataList() {
        return ['contact'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getContact($params) {
    	$data=CacheLogic::get('Contact');
    	if(!$data){
    			$params['status']=10;
    			$id=\Yii::$app->request->get('id',false);
    			if($id==false){
    				exit('参数错误');
    			}
    			$params['id']=$id;
		    	$data['info']=CmsPageContact::find()->where($params)->asArray()->one();;
	    		CacheLogic::set('Contact', $data);
	    	}

    		return $data;
    	}    	

}