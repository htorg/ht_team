<?php
namespace common\logics\basic;
use common\models\CmsNav;
use common\models\CmsPageContact;
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 20:58
 * 它的主要功能是读取当前页面业务数据之外的站点全局数据，比如Header和Footer中所需要的数据，比如在所有页面都有的联系人浮窗的数据。
 * 它决定了SiteData中包含有哪些子项目。
 */
class SiteLogic {
    public function getData($params) {
        $siteData = ['navs' => self::getNavs($params), 'contact' => self::getContactDialogData($params)];
        return $siteData;
    }
    private  function getSiteInfos($params){
    	
    }
    
    private  function getNavs($params){
    	$nav=CmsNav::find()->where($params)->asArray()->all();
    	return $nav;
    }
    
    private function getFooterData($params) {
		return '';
    }

    private function getContactDialogData($params) {
		$contact=CmsPageContact::find()->where($params)->asArray()->all();
		return $contact;
    }
}