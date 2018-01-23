<?php

namespace common\helpers;

use common\models\CmsNav;
use common\models\User;
use common\models\GhSite;
use common\models\CmsSite;
use common\models\CmsShareBtn;
use common\models\CmsPage;
use common\models\CmsCategory;
use common\models\CmsArticle;
use common\models\CmsIndexConfig;
use yii\helpers\Url;
use yii\base\Object;
use common\models\CmsAlbum;
use common\models\CmsCaseCategory;
use common\models\CmsProductCategory;
use common\models\CmsService;
use common\models\CmsPageAbout;
use common\models\CmsPageContact;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 16/9/26
 * Time: 22:23
 */
class DataHelper {
    static public function getValue($data,$key)
    {
        if (isset($data[$key]))
        {
            return $data[$key];
        }
        else
        {
            return '未定义';
        }
    }
    
    static public function getNavTypeNames()
    {
        return [
            CmsNav::TYPE_HOMEPAGE => \Yii::t('app', 'Homepage'),
            CmsNav::TYPE_CATEGORY => \Yii::t('app', 'Article'),
            CmsNav::TYPE_PAGE => \Yii::t('app', 'Single page'),
            CmsNav::TYPE_PAGE_ABOUT => \Yii::t('app', 'About us'),
            CmsNav::TYPE_PAGE_CONTACT => \Yii::t('app', 'Contact us'),
            CmsNav::TYPE_CUSTOMER_LINK => \Yii::t('app', 'Customer link'),
            CmsNav::TYPE_FRIEND_LINK=>\Yii::t('app', 'Friendlinks'),
            CmsNav::TYPE_CASE => \Yii::t('app', 'Cms Cases'),
            CmsNav::TYPE_ALBUM => \Yii::t('app', 'Album List'),
            CmsNav::TYPE_PRODUCT => \Yii::t('app', 'Product List'),
            CmsNav::TYPE_PRODUCT_CATEGORY => \Yii::t('app', 'Cms Product Category'),
        	//CmsNav::TYPE_SERVICE=>\Yii::t('app', 'Cms Services'),
        	//CmsNav::TYPE_UPLOAD=>\Yii::t('app', 'Upload File'),
        	//CmsNav::TYPE_JOININFO=>\Yii::t('app', 'Join Info')
        ];
    }
    
    static public function getGeneralStatus()
    {
        return [
            User::STATUS_ACTIVE=>\Yii::t('app', 'Active'),
            User::STATUS_DELETED=>\Yii::t('app', 'Deleted'),
        ];
    }
    static public function getProductType(){
    	return ['LB01','LB02'];
    }
    static public function getPageType()
    {
    	return [
    			CmsPage::TYPE_ABOUT=>'公司文化',
    			CmsPage::TYPE_CHANGE=>'萝卜介绍',
    	];
    }
    static public function getPageParent(){
    	return [
    			0=>\Yii::t('app', 'About us'),
    			1=>\Yii::t('app', 'contact us'),
    			2=>\Yii::t('app', 'Other')   			
    	];
    }
    static public function getCateType()
    {
    	return [
    			CmsCategory::CATE_LOGIN=>\Yii::t('app', 'login'),
    			CmsCategory::CATE_JOIN=>\Yii::t('app', 'Join'),
    			CmsCategory::CATE_NEWS=>\Yii::t('app', 'news'),
    			CmsCategory::CATE_QUESTION=>\Yii::t('app', 'question'),
    			CmsCategory::CATE_SYSTEM=>\Yii::t('app', 'system'),
    			CmsCategory::CATE_FREECATE=>\Yii::t('app', 'freecate'),
                CmsCategory::CATE_BRAND=>\Yii::t('app', 'brand'),
    	];
    }
    static public function getYesOrNo()
    {
        return [
            0=>\Yii::t('app', 'No'),
            1=>\Yii::t('app', 'Yes'),
        ];
    }
    static  public function getFriendType($type){
    	switch ($type){
    		case 1:
    			return \Yii::t('app', 'Domestic');
    			break;
    		case 2:
    			return \Yii::t('app', 'Foreign');
    			break;
    		default:return \Yii::t('app', 'Domestic');	
    	}
    }
    static public function getBannerPosNames($pos,$posMap)
    {
        $pos = explode(',', substr($pos, 1, -1));
        $posStr = '';
        foreach ($pos as $p)
        {
            if (isset($posMap[$p]))
                $posStr .= $posMap[$p].', ';
        }
        if (!empty($posStr))
        {
            $posStr = substr($posStr, 0, -2);
        }
        return $posStr;
    }
    
    static public function getBannerPosMap()
    {
        return [
            'homepage'=>\Yii::t('app', 'Homepage'),
        	'news'=>'新闻列表',
        	'homefooter'=>'底部轮播',
        	'homepro'=>'首页产品'	
        ];
    }
    
    static public function getTopBannerPosMap()
    {
        $features = ThemeHelper::getFeatures();
        $posMap = [];
        if (in_array(ThemeHelper::$THEME_FEATURE_ALBUM, $features)){
            $posMap['album'] = \Yii::t('app', 'Album');
        }
        if (in_array(ThemeHelper::$THEME_FEATURE_CASE, $features)){
            $posMap['case'] = \Yii::t('app', 'Case');
        }
        
        return $posMap;
    }
    
    static public function getShareBtnTypes()
    {
        return [
            CmsShareBtn::TYPE_LINK=>\Yii::t('app', 'Link'),
            CmsShareBtn::TYPE_QRCODE=>\Yii::t('app', 'Qrcode'),
        ];
    }
    
    static public function getRecommend($lenght,$where){
    	$category = CmsCategory::find()->where($where)->andWhere(['type'=>'news'])->one();
    	//var_dump($category);die();
    	$articles = [];
    	$sub_categorys = [];
    	if (is_object($category))
    	{
    		//新闻资讯
    		$articles =CmsArticle::find()->where($where)->andWhere(['category_id'=>$category->id,'recommend'=>1])->orderBy('sort_val asc')->asArray()->all();
    		$sub_categorys = CmsCategory::find()->with(['indexArticles'])->where($where)->andWhere(['parent_id'=>$category->id])->all();
    		foreach ($sub_categorys as $sub_category){
    			foreach (CmsArticle::find()->where($where)->andWhere(['category_id'=>$sub_category['id'],'recommend'=>1])->orderBy('sort_val asc')->asArray()->all() as $val){
    				array_push($articles,$val);
    			}
    		}
    	}
    	if(count($articles)>$lenght){
    		return array_slice($articles,0,$lenght-1);
    	}
    	return $articles;
    }

    //获取最新文章
    static public function getNewArtical($lenght,$where,$type='news'){
     	$category = CmsCategory::find()->where($where)->andWhere(['type'=>'news','parent_id'=>0])->one();
        $articles = [];
        $sub_categorys = [];
        if (is_object($category))
        {
            //新闻资讯
            $articles = CmsArticle::find()->where($where)->andWhere(['category_id'=>$category->id])->orderBy('created_at desc')->asArray()->all();
            $sub_categorys = CmsCategory::find()->with(['indexArticles'])->where($where)->andWhere(['parent_id'=>$category->id])->all(); 
            foreach ($sub_categorys as $sub_category){
    			foreach (CmsArticle::find()->where($where)->andWhere(['category_id'=>$sub_category['id']])->orderBy('created_at desc')->asArray()->all() as $val){
    				array_push($articles,$val);
    			}
            }
        }
        if(count($articles)>$lenght){
        	return array_slice($articles,0,$lenght-1);
        }
        return $articles;
    }
    static public function getCateArticle($cate_id,$where,$lenght=12){
    	$category = CmsCategory::find()->where($where)->andWhere(['id'=>$cate_id])->one();
    	$articles = [];
    	$sub_categorys = [];
    	if (is_object($category))
    	{
    		//新闻资讯
    		$articles = CmsArticle::find()->where($where)->andWhere(['category_id'=>$category->id])->orderBy('created_at desc')->asArray()->all();
    		$sub_categorys = CmsCategory::find()->with(['indexArticles'])->where($where)->andWhere(['parent_id'=>$category->id])->all();
    		foreach ($sub_categorys as $sub_category){
    			foreach (CmsArticle::find()->where($where)->andWhere(['category_id'=>$sub_category['id']])->orderBy('created_at desc')->asArray()->all() as $val){
    				array_push($articles,$val);
    			}
    		}
    	}
    	if(count($articles)>$lenght){
    		return array_slice($articles,0,$lenght-1);
    	}
    	return $articles;
    }
    
    //后台获取配置信息    
    static public function getFeatureInfos($site_id,$lang_id){   	
    	$features=ThemeHelper::getFeatures('home_features');
    	//获取配置项
    	$config_info=ThemeHelper::getConfigType();
    	//获取每一个feature对应的配置项
    	$configs=[];
    	foreach ($features as $val){
    		foreach ($config_info as $key=>$info){
    			if(in_array($val, $info['feature'])){
    				//$info['value']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val])->asArray()->one();
    				$info['model']=CmsIndexConfig::find()->where(['config_id'=>$info['id'],'feature'=>$val,'site_id'=>$site_id,'lang_id'=>$lang_id])->one();
    				$configs[$val][$key]=$info;
    			}
    		}
    	}
    	return $configs;
    }
   //后台管理获取url
   static public function getManagerUrl($type,$id,$nav_id){
   		switch ($type){
   			case CmsNav::TYPE_CATEGORY:
   				return Url::to(['category/update','id'=>$id,'type'=>true]);
   				break; 
   			case CmsNav::TYPE_CATEGORY_SUB:
   				return Url::to(['category/update','id'=>$id]);
   				break;
   			case CmsNav::TYPE_ALBUM:
   				return Url::to(['cms-album-config/update','id'=>$nav_id,'type'=>true]);
   			break;
   			case CmsNav::TYPE_CASE:
   				return Url::to(['case-category/update','id'=>$id,'type'=>true]);
   				break;
   			case CmsNav::TYPE_PAGE_ABOUT:
   				return Url::to(['page-about/index']);
   				break;
   			case CmsNav::TYPE_PAGE_CONTACT:
   				return Url::to(['page-contact/index']);
   				break;
   			case CmsNav::TYPE_PAGE:
   				return Url::to(['page/update','id'=>$id,'type'=>true]);
   				break;
   			case CmsNav::TYPE_PRODUCT:
   				return Url::to(['cms-product-config/update']);
   				break;
   			case CmsNav::TYPE_SERVICE:
   				return Url::to(['cms-service-config/update']);
   				break;	
   			default:return Url::to(['cms-index-config/index']);	
   		}
   }
	static public function getModel($type,$id,$name){
		$model='';
		switch ($type){
			case CmsNav::TYPE_CATEGORY:
				if(!empty($id)){
					$model=CmsCategory::findOne($id);
					if($name==false){
						return $model;
					}
				}else{;
				$model=new CmsCategory();
				$model->created_at=time();
				}
				$model->type='news';
				$model->description=$name;
				break;
			case CmsNav::TYPE_ALBUM:
				if(!empty($id)){
					$model=CmsAlbum::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsAlbum();
					$model->created_at=time();
				}	
				
				break;
			case CmsNav::TYPE_CASE:
				if(!empty($id)){
					$model=CmsCaseCategory::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsCaseCategory();
					$model->created_at=time();
				}
				$model->description=$name;
				break;
			case CmsNav::TYPE_PAGE:
				if(!empty($id)){
					$model=CmsPage::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsPage();
					$model->created_at=time();
				}
				$model->content=$name;
				break;
			case CmsNav::TYPE_PAGE_ABOUT:
				if(!empty($id)){
					$model=CmsPageAbout::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsPageAbout();
					$model->created_at=time();
				}
				$model->company_name=$name;
				$model->company_desc=$name;
			break;
			case CmsNav::TYPE_PAGE_CONTACT:
				if(!empty($id)){
					$model=CmsPageContact::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsPageContact();
					$model->created_at=time();
				}
				$model->phone='13800138000';
				$model->address='请输入';
				$model->site_url='请输入';
				break;
			case CmsNav::TYPE_PRODUCT_CATEGORY:
				if(!empty($id)){
					$model=CmsProductCategory::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsProductCategory();
					$model->created_at=time();
					$model->description=$name;
				}
				break;
			case CmsNav::TYPE_SERVICE:
				if(!empty($id)){
					$model=CmsService::findOne($id);
					if($name==false){
						return $model;
					}
				}else{
					$model=new CmsService();
					$model->created_at=time();
				}
				$model->description=$name;
				$model->cover=$name;
			default:return '';
				break;
		}
		return $model;
	}
   static public function getModelById($type,$id,$name,$siteId,$langId,$parentId){
   		$model=self::getModel($type, $id,$name);
   		$arr=[CmsNav::TYPE_PAGE_ABOUT,CmsNav::TYPE_ALBUM,CmsNav::TYPE_PAGE_CONTACT];
   		if(is_object($model)){  			
   			if(!in_array($type, $arr)){
	   			if($parentId==0){
	   				$model->parent_id=0;
	   			}else{
	   				$parent_model=CmsNav::find()->where(['id'=>$parentId])->one();
	   				$model->parent_id=$parent_model->ext_id;
	   			}
   			}
   			
   			$model->site_id=$siteId;
   			$model->lang_id=$langId;   			
   			if($type!=CmsNav::TYPE_PAGE_ABOUT){
   				$model->name=$name;
   				$model->sort_val=10;
   			}
   			$model->status=10;
   			$model->updated_at=time();
   			if($model->save()){
   				
   				 return $model;
   			}else {
   				return $model->getErrors();
   				return false;
   			}
   		}else{
   			return false;
   		}
   }
}