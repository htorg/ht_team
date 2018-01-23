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
use common\models\CmsCaseConfig;
use common\models\CmsCaseCategory;
use common\models\CmsCase;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteExampledetailLogic extends Logic {
    public function getDataList() {
        return ['example'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getExample($params) {
    	$data=CacheLogic::get('example_detail');
    	if(!$data){   	
    			$params['status']=10;
    			$id = \Yii::$app->request->get('id', false);
		        if( $id===false ){
		            exit('缺少必要的参数');
		        }
		
		        $data['model'] = CmsCase::findOne(['id' => $id, 'status' => 10]);
		        if( !is_object($data['model']) ){
		            exit('案例不存在');
		        }
		        $preId = CmsCase::find()->where(['<', 'id', $id])->andWhere($params)->max('id');
		        $nextId = CmsCase::find()->where(['>', 'id', $id])->andWhere($params)->min('id');
		
		        $preModel = [];
		        $nextModel = [];
		        if( !empty($preId) ){
		            $data['preModel'] = CmsCase::findOne($preId);
		        }
		        if( !empty($nextId) ){
		              $data['nextModel'] = CmsCase::findOne($nextId);
		        }
		        CacheLogic::set('example_detail', $data);
	    	}
    		return $data;
    	}

}