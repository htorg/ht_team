<?php
namespace common\logics\basic;
use common\logics\core\Logic;
use common\helpers\ThemeHelper;
use common\helpers\DataHelper;
use common\models\CmsCategory;
use common\models\CmsArticle;
use common\logics\core\CacheLogic;
use yii\caching\Cache;
use yii\base\Object;
use yii\data\Pagination;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteListLogic extends Logic {
    public function getDataList() {
        return ['articles'];
    }
    
    public function action()
    {
        echo "K";
    }

    public function getArticles($params) {
    	$data=CacheLogic::get('articles');
    	if(!$data){
	    	$params['status']=10;
	    	$page=\Yii::$app->request->get('page',1);
	        $data['categoryList'] =CmsCategory::find()->where($params)->andWhere(['type'=>CmsCategory::CATE_NEWS])->asArray()->all();
	        $cid=\Yii::$app->request->get('cid',false);
	        if($cid==false){
	        	$cid=CmsCategory::find()->where(['parent_id'=>0,'type'=>CmsCategory::CATE_NEWS])->one()->id;
	        }
	        $category = CmsCategory::findOne(intval($cid, 10));
	        if (!is_object($category))
	        {
	             exit('栏目不存在');
	        }
	        if ($category->parent_id>0){
	        	$params['category_id'] = $category->id;
	        }
	        $pageSize = 6;
	        $query= CmsArticle::find()->where($params); 
	        if($category->parent_id==0){
	        	$query = CmsArticle::find()->joinWith([
	        			'category' => function($query) {
	        				$cid=\Yii::$app->request->get('cid',false);
	        				if($cid==false){
	        					$cid=CmsCategory::find()->where(['parent_id'=>0,'type'=>CmsCategory::CATE_NEWS])->one()->id;
	        				}
	        				$category_id=CmsCategory::findOne(intval($cid, 10));
			        $query->andWhere(['parent_id'=>$category_id]);
			    },
			]);
	        }
	        $count = $query->count();
	        $data['list']=$query->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();
	        $data['pagination'] = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
	    		CacheLogic::set('articles', $data);
	    	}
    		return $data;
    	}

}