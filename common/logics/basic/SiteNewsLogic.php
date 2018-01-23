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

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteNewsLogic extends Logic {
    public function getDataList() {
        return ['news'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getNews($params) {
    	$data=CacheLogic::get('news');
    	if(!$data){
    			$params['status']=10;
		    	$id = \Yii::$app->request->get('id', false);
		        if( $id===false ){
		            exit('缺少必要的参数');
		        }
		        $data['news'] = CmsArticle::findOne(['id' => $id, 'status' => 10]);
		        if( !is_object($data['news']) ){
		            exit('新闻不存在');
		        }
		
		        $data['news']->view_count++;
		        $data['news']->save();
		        $data['category'] = CmsCategory::findOne($data['news']->category_id);
		        $data['categoryList'] =CmsCategory::find()->where($params)->andWhere(['type'=>CmsCategory::CATE_NEWS])->asArray()->all();		        
		        $preNewsId = CmsArticle::find()->where(['<', 'id', $id])->andWhere($params)->max('id');
		        $sufNewsId = CmsArticle::find()->where(['>', 'id', $id])->andWhere($params)->min('id');
		
		        $preNews = [];
		        $sufNews = [];
		        if( !empty($preNewsId) ){
		            $data['preNews'] = CmsArticle::findOne($preNewsId);
		        }
		        if( !empty($sufNewsId) ){
		            $data['sufNews']= CmsArticle::findOne($sufNewsId);
		        }  	
		        $params['id']=$id;
		        $data['recommendList']= DataHelper::getRecommend(10, $params);
	    		CacheLogic::set('news', $data);
	    	}
    		return $data;
    	}    	

}