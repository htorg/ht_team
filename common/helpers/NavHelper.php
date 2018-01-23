<?php
namespace common\helpers;

use common\models\CmsNav;
use common\helpers\DataHelper;
use yii\helpers\Url;
use common\models\CmsCategory;
use backend;
use common\models\CmsProductCategory;
use common\models\CmsPage;
use common\models\CmsCaseCategory;
use yii\base\Object;
use common\models\CmsAlbum;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/2/10
 * Time: 10:38
 */
class NavHelper
{
 static public function getNavsHtml($navs,$navTypeNames)
    {
        $html = '';
        foreach ($navs as $n)
        {
            if ($n['type'] == CmsNav::TYPE_CATEGORY_SUB)
            {
                $categorys = CmsCategory::find()->where(['parent_id'=>$n['ext_id'],'status'=>CmsCategory::STATUS_ACTIVE])->orderBy('sort_val asc')->all();
                $html .= '<li class="nav-li sub-category" type="'.$n['type'].'" rel="'.$n['id'].'" name="'.$n['name'].'" ext_id="'.$n['ext_id'].'" url="'.$n['ext_content'].'">';                    
                $navTypeName = DataHelper::getValue($navTypeNames, $n['type']);
                foreach ($categorys as $c)
                {
                    $html .= '<a href="javascript:;"><span class="name">'.$c->name.'</span><span class="text-gray">-'.$navTypeName.'</span></a>';
                }
                $html .= '</li>';
            }
            elseif ($n['type'] == CmsNav::TYPE_PRODUCT_CATEGORY)
            {
                $categorys = CmsProductCategory::find()->where(['site_id'=>$n['site_id'],'lang_id'=>$n['lang_id'],'parent_id'=>$n['ext_id'],'status'=>CmsProductCategory::STATUS_ACTIVE])->orderBy('sort_val asc')->all();
                $html .= '<li class="nav-li sub-category" type="'.$n['type'].'" rel="'.$n['id'].'" name="'.$n['name'].'" ext_id="'.$n['ext_id'].'" url="'.$n['ext_content'].'">';
                $navTypeName = DataHelper::getValue($navTypeNames, $n['type']);
                foreach ($categorys as $c)
                {
                    $html .= '<a href="javascript:;"><span class="name">'.$c->name.'</span><span class="text-gray">-'.$navTypeName.'</span></a>';
                }
                $html .= '</li>';
            }
            else 
            {
                $html .= '<li class="nav-li" type="'.$n['type'].'" rel="'.$n['id'].'" name="'.$n['name'].'" ext_id="'.$n['ext_id'].'" url="'.$n['ext_content'].'">';
                $html .= '<a href="javascript:;"><div class="click-layout">&nbsp;</div><span class="name">'.$n['name'].'</span><span class="text-gray">-'.DataHelper::getValue($navTypeNames, $n['type']).'</span><i class="up-down-icon pull-right fa fa-chevron-down"></i></a>';
                $html .= '<div class="box box-solid nav-sub-list">';
                $html .= '<ul class="nav nav-stacked">';
                
                if (isset($n['sub']))
                {
                    $html .= self::getNavsHtml($n['sub'], $navTypeNames);
                }
                
                $html .= '</ul>';
                $html .= '</div>';
                $html .= '</li>';
            }
        }
        return $html;
    }
    static public function getNavsHtmlHt($navs,$navTypeNames)
    {
    	$html = '';
    	foreach ($navs as $key=> $n)
    	{
    			$html .= '<li class="nav_list_item" type="'.$n['type'].'" rel="'.$n['id'].'" name="'.$n['name'].'" ext_id="'.$n['ext_id'].'" url="'.$n['ext_content'].'">';
    			$html .='<div class="ht_rowBox"><i class="ico_more glyphicon glyphicon-triangle-right glyphicon-triangle-bottom"></i>';
    			$html .='<div class="ht_row"><div class="nav_colItem col-md-4 "><input class="row_nav_name" type="text" value="'.$n['name'].'" autocomplete="no" placeholder=""/></div><div class="nav_colItem col-md-3"><span class="nav_attr">'.DataHelper::getValue(DataHelper::getNavTypeNames(), $n['type']).'</span></div>';
    			$html .='<div class="nav_colItem col-md-5">';
    			if($n['type']!=7001){
    				if($n['type']==3001){
    					$html .='<input class="defined_link" type="3001" value="'.$n['ext_content'].'">';
    				}else{
    					$html .='<button id="create-cate" class="btn btn-primary create_subNav_btn">添加子级</button>';
    				}
    			} 					
    			$html.='<a  class=" ht_button ht_row_right glyphicon glyphicon-remove removeBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-up upBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-down downBtn"></a></div></div>';   
    			 if (isset($n['sub']))
    			{
    				$html .=self::getSubHtml($n['sub'], $navTypeNames) ;
    			}   
    			/* $html .= '</ul>';*/
    			$html.='</div>';
    			$html .= '</li>';
    	
    	}
    	return $html;
    	 
    }
    static public function getSubHtml($subNav,$navTypeNames,$level=''){
    	$html='';   	
    	foreach ($subNav as $sub){   
    		$sub_class1=empty($level)?'subNavItem':'subNavItem_thr';
    		$sub_class2=empty($level)?'more_sub_content':'subNavItem';
	    	$html .='<div class=" '.$sub_class2." ".$sub_class1.'" type="'.$sub['type'].'" rel="'.$sub['id'].'" name="'.$sub['name'].'" ext_id="'.$sub['ext_id'].'" url="'.$sub['ext_content'].'"><div class="ht_row ht_sub"><div class="nav_colItem col-md-4 subNavItem_name">';
			$html .='<img class="ico_subNav" src="../img/img_column.gif"><input class="row_nav_name" type="text" value="'.$sub['name'].'" autocomplete="no" placeholder=""/></div>';
			$html .='<div class="nav_colItem col-md-3"><span class="nav_attr">'.DataHelper::getValue(DataHelper::getNavTypeNames(), $sub['type']).'</span></div>';
			$html .='<div class="nav_colItem col-md-5">';
			if(empty($level)&&$sub['type']!=3001){
				$html.='<button id="create-cate" class="btn btn-primary create_subNav_btn">添加子级</button>';
				
			}
			if ($sub['type']==3001){
				$html.='<input class="defined_link" type="3001" value="'.$sub['ext_content'].'">';
			}
			$html .='<a  class=" ht_button ht_row_right glyphicon glyphicon-remove removeBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-up upBtn"></a><a  class=" ht_button ht_row_right glyphicon glyphicon-arrow-down downBtn"></a></div></div>';
     		if(isset($sub['sub'])){
    			$html .= self::getSubHtml($sub['sub'], $navTypeNames,1);
    		} 
    		$html .='</div>';
    	}
    	return $html;
    }
    static public function getNavs($site_id,$lang_id,$parent_id=0)
    {
        $navs = CmsNav::find()->with('categroy')->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'parent_id'=>$parent_id])->andWhere('type!='.CmsNav::TYPE_PREDEFINED_LINK)->orderBy('sort_val asc')->asArray()->all();
        $count = count($navs);
        for ($i=0;$i<$count;$i++)
        {
            if (CmsNav::find()->with('categroy')->where(['site_id'=>$site_id,'lang_id'=>$lang_id,'parent_id'=>$navs[$i]['id']])->count()>0)
            {
                $navs[$i]['sub'] = self::getNavs($site_id,$lang_id,$navs[$i]['id']);
            }
        }
    
        return $navs;
    }
    
    static public function deleteNavs($deleteNavIds)
    {
        foreach ($deleteNavIds as $id)
        {
            self::deleteSubNavs($id);
        }
    }
    
    static public function deleteSubNavs($id)
    {
    	$model=CmsNav::findOne($id);
    	if($model->ext_id>0){
    		$cate=DataHelper::getModel($model->type, $model->ext_id, false);
    		$cate->delete();
    	}
        CmsNav::deleteAll('id=:id',[':id'=>$id]);
        if (CmsNav::find()->where(['parent_id'=>$id])->count() > 0)
        {
            $navs = CmsNav::find()->select(['id'])->where(['parent_id'=>$id])->all();
            foreach ($navs as $n)
            {
                self::deleteSubNavs($n['id']);
            }
        }
    }

    static public function saveNavs($navs)
    {   	
        $count = count($navs);
        for ($i=0;$i<$count;$i++)
        {
            if (empty($navs[$i]['rel']) || strpos($navs[$i]['rel'], 'new'))
            {
                $model = new CmsNav();
                $model->site_id = backend\helpers\SiteHelper::getSiteId();
                $model->lang_id = backend\helpers\SiteHelper::getLangId();
            }
            else
            {
                $model = CmsNav::findOne($navs[$i]['rel']);
            }
            
            if (is_object($model))
            {
                $model->name = $navs[$i]['name'];
                $model->type = $navs[$i]['type'];
                $model->ext_id = $navs[$i]['ext_id'];
                if (isset($navs[$i]['parent_id']))
                {
                    $model->parent_id = $navs[$i]['parent_id'];
                }
                else
                {
                    $model->parent_id = 0;
                }
                if (isset($navs[$i]['url']))
                {
                    $model->ext_content = $navs[$i]['url'];
                }
                else
                {
                    $model->ext_content = '';
                }
                $model->sort_val = $i;
            } 
			//生成相对应模块
			$ext_model=DataHelper::getModelById($model->type, $model->ext_id, $model->name, $model->site_id, $model->lang_id, $model->parent_id);
			if (is_object($ext_model)){
				$model->ext_id=$ext_model->attributes['id'];
			}
            if ($model->save())
            {
            	$id=$model->attributes['id'];
            	if(is_object($ext_model)&&property_exists($ext_model,'nav')){
            		$ext_model->nav_id=$id;
            		$ext_model->save();
            	}
            	if (isset($navs[$i]['sub']) && is_array($navs[$i]['sub']))
            	{
            		$subCount = count($navs[$i]['sub']);
            		for ($j=0;$j<$subCount;$j++)
            		{
            			$navs[$i]['sub'][$j]['parent_id'] = $model->id;
            		}
            		self::saveNavs($navs[$i]['sub']);
            	}
            }
            else
            {
            	print_r($model->errors);
            	exit();
            }
        }
    }
    
    static public function getCacheNavs($site_id,$lang_id)
    {
        $navs = CacheHelper::getCache('navs_'.$site_id.'_'.$lang_id);
        if (empty($navs))
        {
            $navs = NavHelper::getNavs($site_id,$lang_id);
            CacheHelper::setCache('navs_'.$site_id.'_'.$lang_id,$navs);
        }
        return $navs;
    }

	 static public function getNavUrl($nav){    	
	    		switch ($nav['type'])
	    		{
	    			case CmsNav::TYPE_HOMEPAGE:
	    				return Url::to(['site/index']);
	    				break;
	    			case CmsNav::TYPE_PAGE_ABOUT:
	    				return Url::to(['site/about']);
	    				break;	
	    			case CmsNav::TYPE_PRODUCT_CATEGORY:
	    				return Url::to(['site/products','cid'=>$nav['ext_id']]);
	    		}
	        
	        return '';
	}

    
    static public function isCustomPage( $type ){
        if( $type == 400 ){
            return true;
        }

        return false;
    }
    
}
