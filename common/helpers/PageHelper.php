<?php
namespace common\helpers;

use common\models\CmsNav;
use common\helpers\DataHelper;
use yii\helpers\Url;
use common\models\CmsCategory;
use backend;
use common\models\CmsProductCategory;
use common\models\CmsPage;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/2/10
 * Time: 10:38
 */
class PageHelper
{    
static public function getPageUrl($page){
    	$id=isset(\Yii::$app->session['serial_id'])?\Yii::$app->session['serial_id']:'';
    	if($id){
    		switch ($page['type'])
    		{
    			case CmsPage::TYPE_ABOUT:
    				return Url::to(['site/single-page','sname'=>$id,'id'=>$page['id']]);
    				break;   			
    			case CmsPage::TYPE_CHANGE:
    				return Url::to(['site/single-page1','sname'=>$id,'id'=>$page['id']]);
    				break;
    			case CmsPage::TYPE_EXAMPLE:
    				return Url::to(['site/single-page2','sname'=>$id,'id'=>$page['id']]);
    				break;
    			case CmsPage::TYPE_NEWS:
    				return Url::to(['site/single-page3','sname'=>$id,'id'=>$page['id']]);
    				break;
    			default: return Url::to(['site/single-page1','sname'=>$id,'id'=>$page['id']]);
    				
    		}
    	}else{
    		switch ($page['type'])
    		{
    			case CmsPage::TYPE_ABOUT:
    				return Url::to(['site/single-page','id'=>$page['id']]);
    				break;
    			case CmsPage::TYPE_CHANGE:
    				return Url::to(['site/single-page1','id'=>$page['id']]);
    				break;
    			case CmsPage::TYPE_EXAMPLE:
    				return Url::to(['site/single-page2','id'=>$page['id']]);
    				break;
    			case CmsPage::TYPE_NEWS:
    				return Url::to(['site/single-page3','id'=>$page['id']]);
    				break;
    			default: return Url::to(['site/single-page1','id'=>$page['id']]);
    		}
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
