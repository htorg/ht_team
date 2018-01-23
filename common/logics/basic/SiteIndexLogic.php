<?php
namespace common\logics\basic;
use common\logics\core\Logic;
use common\helpers\ThemeHelper;
use common\models\CmsBanner;
use common\models\CmsService;
use common\models\CmsCase;
use common\models\CmsCaseCategory;
use common\helpers\DataHelper;
use common\models\CmsCategory;
use common\models\CmsArticle;
use common\models\CmsPageAbout;
use common\logics\core\CacheLogic;
use yii\caching\Cache;
use common\models\CmsIndexConfig;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:54
 */
class SiteIndexLogic extends Logic {
	public $home_configs;
	
	public function __construct($params,$themeId){
		$this->home_configs=CacheLogic::get('config');
		if(!$this->home_configs){
	    	$features=ThemeHelper::getFeaturesById($themeId);
	        $config_info=ThemeHelper::getConfigType();
	        $configs=[];
	        foreach ($features as $val){
	        	foreach ($config_info as $key=>$info){
	        		if(in_array($val, $info['feature'])){
	        			//$info['value']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val])->asArray()->one();
	        			$info['model']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val,'site_id'=>$params['site_id'],'lang_id'=>$params['lang_id']])->one();
	        			$configs[$val][$info['code']]=$info['model']['value'];	
	        		}
	        	}
	        }
	        $this->home_configs=$configs;
	        CacheLogic::set('config', $configs);
		}
	}
	
    public function getDataList() {
        return ['config','banners','services','case','articles', 'about'];
    }
    
    public function action()
    {
        echo "K";
    }
    
	public function getConfig(){
		return $this->home_configs;
	}
	
	public function getBanners($params){
		$data=CacheLogic::get('banners');
		if(!$data){
			$params['status']=10;
			if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_BANNER])){
				$data['banners_config']=$this->home_configs[ThemeHelper::$THEME_FEATURE_BANNER];
			}
			$banners = CmsBanner::find()->with('images')->where($params)->andWhere(['like','pos',',homepage,'])->orderBy('sort_val asc')->asArray()->all();
			if(count($banners)==1){
				$banners=$banners[0];
			}
			$data['banners']=$banners;
			CacheLogic::set('banners', $data);
		}
		return $data;
	}
	
	public function getServices($params){
		$data=CacheLogic::get('services');
		if(!$data){
			$params['status']=10;
			$query=CmsService::find()->where($params);
			if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_SERVICE])){
				$data['services_config']=$this->home_configs[ThemeHelper::$THEME_FEATURE_SERVICE];
				if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_SERVICE]['homepage_count'])){
					$query->limit($this->home_configs[ThemeHelper::$THEME_FEATURE_SERVICE]['homepage_count']);
				}
			}
			$data['services']=$query->orderBy('sort_val asc')->asArray()->all();
			CacheLogic::set('services', $data);
		}
		return $data;
	} 
	
	public function getCase($params){
		$data=CacheLogic::get('cases');
		if(!$data){
			$params['status']=10;
			$query=CmsCase::find()->where($params);
			if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_CASE])){
				$data['cases_config']=$this->home_configs[ThemeHelper::$THEME_FEATURE_CASE];
				if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_CASE]['homepage_count'])){
					$query->limit($this->home_configs[ThemeHelper::$THEME_FEATURE_CASE]['homepage_count']);
				}
			}
			$data['cases']=$query->asArray()->all();
			$data['cases_cate']=CmsCaseCategory::find()->where($params)->asArray()->all();
			CacheLogic::set('cases', $data);
		}
		return $data;
	}
	
    public function getArticles($params) {
    	$data=CacheLogic::get('articles');
    	if(!$data){
	    	$params['status']=10;
	    	if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE])){
	    		$data['articles_config']=$this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE];
	    	}
	    	if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_cate'])){
	    		if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_count'])){
	    			$data['articles']=DataHelper::getCateArticle($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_cate'], $params,$this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_count']);
	    		}else{
	    			$data['articles']=DataHelper::getCateArticle($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_cate'], $params);
	    		}
	    	}else{
	    		$query=CmsCategory::find()->where($params)->andWhere(['type'=>'news'])->andwhere('parent_id>0');
	    		$cate_id=\Yii::$app->request->get('cid','');
	    		if(!empty($cate_id)){
	    			$query->andwhere(['category_id'=>$cid]);
	    		}
	    		$categorys = $query->asArray()->all();
	    		$articles = [];
	    		if(!empty($categorys)){
	    			foreach ($categorys as $category){
	    				$article=CmsArticle::find()->where($params)->andWhere(['category_id'=>$category['id']])->asArray()->all();
	    				foreach ($article as $val){
	    					array_push($articles,$val);
	    				}
	    			}
	    		}
	    		if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_count'])){
	    			if(count($articles)>$configs[$feature]['homepage_count']){
	    				$articles= array_slice($articles,0,$this->home_configs[ThemeHelper::$THEME_FEATURE_ARTICLE]['homepage_count']-1);
	    			}
	    		}
	    		$data['articles_categorys']=$categorys;
	    		$data['articles']=$articles;
	    		CacheLogic::set('articles', $data);
	    	}
    	}
    	return $data;
    }

    public function getAbout($params) {
    	$data=CacheLogic::get('about');
    	if(!$data){
	    	if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_PAGE_ABOUT])){
	    		$data['about_config']=$this->home_configs[ThemeHelper::$THEME_FEATURE_PAGE_ABOUT];
	    	}
	    	if(isset($this->home_configs[ThemeHelper::$THEME_FEATURE_PAGE_ABOUT]['homepage_count'])){
	    		$about = CmsPageAbout::find()->with(['teams'])->where($params)->limit($this->home_configs[ThemeHelper::$THEME_FEATURE_PAGE_ABOUT]['homepage_count'])->asArray()->one();
	    	}else{
	    		$about = CmsPageAbout::find()->with(['teams'])->where($params)->asArray()->one();
	    	}
	    	$data['about']=$about;
	    	CacheLogic::set('about', $data);
    	}
    	return $data;
    }

}