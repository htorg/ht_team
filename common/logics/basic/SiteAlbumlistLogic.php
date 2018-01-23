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
use common\models\CmsNav;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteAlbumlistLogic extends Logic {
    public function getDataList() {
        return ['albums'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getAlbums($params) {
    	$data=CacheLogic::get('Albumlist');
    	if(!$data){
    			$params['status']=10;
    			$id=\Yii::$app->request->get('id',false);
    			if($id==false){
    				exit('参数错误');
    			}
    			$params['nav_id']=$id;
    			$page = \Yii::$app->request->get('page', 1);
		        $pageSize = 24;
		        $count = CmsAlbum::find()->where($params)->count();
		        $data['pagination'] = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
		    
		        $page = ($tmp=intval($page))==0? 1:$tmp;
		        $data['albums'] = CmsAlbum::find()->where($params)->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();		        
		        $where['pos'] = 'album';
		        $data['topBanner'] = CmsTopBanner::find()->where($where)->one();
		        $data['nav_id']=CmsNav::findOne($id)->ext_id;
	    		CacheLogic::set('Albumlist', $data);
	    	}
    		return $data;
    	}  

}