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
use common\models\CmsAlbum;
use common\helpers\NavHelper;
use common\models\CmsTopBanner;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteAlbumLogic extends Logic {
    public function getDataList() {
        return ['album'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getAlbum($params) {
    	$data=CacheLogic::get('album');
    	if(!$data){
    			$params['status']=10;
    			$aid = \Yii::$app->request->get('aid',false);
    			if($aid==false){
    				exit('参数错误');
    			}
    			$params['id']=$aid;
		        $data['album'] = CmsAlbum::find()->with(['pics'])->where($params)->one();
		        unset($params['id']);
		        $params['pos'] = 'album';
		        $data['topBanner'] = CmsTopBanner::find()->where($params)->one();
	    		CacheLogic::set('album', $data);
	    	}
    		return $data;
    	}  

}