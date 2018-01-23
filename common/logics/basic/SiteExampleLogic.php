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
class SiteExampleLogic extends Logic {
    public function getDataList() {
        return ['example'];
    }
    
    public function action()
    {
        echo "K";
    }
    
    public function getExample($params) {
    	$data=CacheLogic::get('example');
    	if(!$data){   			
    			$cid = \Yii::$app->request->get('cid', false);
    			$type=	\Yii::$app->request->get('type', false);
    			if($cid==false){
    				if($type==false){
    					exit('参数错误');
    				}else{
    					$cid=CmsCaseCategory::find()->one()->id;
    				}  				
    			}
    			$category=CmsCaseCategory::find()->where(['id'=>$cid])->one();
    			$page = \Yii::$app->request->get('page', 1);
		        //案例分类
		        if($category->parent_id==0){
		        	$data['top_cid']=$cid;
		        }else{
		        	$data['top_cid']=$category->parent_id;
		        }
		        $data['caseConfig'] = CmsCaseConfig::find()->where($params)->one();
		        $use_case_category = is_object( $data['caseConfig']) ?  $data['caseConfig']->use_category:0;
		        $params['status']=10;
		        if ($use_case_category == 1)
		        {
		            $data['cts'] = CmsCaseCategory::find()->where($params)->andWhere(['parent_id' =>$data['top_cid']])->asArray()->all();
		            if(empty($data['cts'])){
		            	return $data;
		            }
		            $params['category_id'] = $cid;
		        }    		        
		        $page = ($tmp=intval($page))==0? 1:$tmp;
		        $query= CmsCase::find()->where($params);
		        if($category->parent_id==0){
		        	$query = CmsCase::find()->joinWith([
		        			'category' => function($query) {
		        				$category_id=CmsCaseCategory::findOne(intval($_GET['cid'], 10));
		        				$query->andWhere(['parent_id'=>$category_id->id]);
		        			},
		        			]);
		        }
		        $pageSize=8;
		        $count = $query->count();
		        $data['pagination'] = new Pagination(['totalCount' => $count, 'defaultPageSize' => $pageSize]);
		        $data['cases']=$query->offset(($page-1)*$pageSize)->limit($pageSize)->asArray()->all();
		        CacheLogic::set('example', $data);
	    	}
    		return $data;
    	}

}