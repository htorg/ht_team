<?php
namespace common\logics\core;
use Yii;
use common\logics\basic\SiteLogic;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 21:26
 * 数据的获取、缓存等相关的逻辑，以页面为单位
 * 所以对于每个页面，都存在对应的Logic类
 * 有些页面是主题独有的，或者被主题扩展了的，那么就会在主题相关的目录中存在对应的Logic类，这是就会只调用主题Logic类的逻辑
 * 只有不存在主题Logic的时候，才会去logics\basic中查找对应的Logic类
 */
class CoreLogic {
    private $logic;
	private $siteLogic;
	public $params;
	public $themeId;
    public function __construct($params,$themeId,$themeCode)
    {
    	$this->params=$params;
    	$this->themeId=$themeId;
    	header("Content-type: text/html; charset=utf-8");
        $this->logic = CoreLogic::loadThemeClass($themeId,$themeCode);
        if ($this->logic == false) {
            $this->logic = CoreLogic::loadBasicClass($themeId);
        }
        $this->siteLogic=self::loadSiteLogic($themeCode)?self::loadSiteLogic($themeCode):self::loadBasicSiteLogic();
    }

    public function getSiteData()
    {
		$siteData=$this->siteLogic->getData($this->params);		
    }

    public function getPageData($params)
    {
        $pageData = [];
        $dataList = $this->logic->{'getDataList'}();
        foreach ($dataList as $dataName)
        {
            $method = 'get' . ucfirst($dataName);
            $pageData[$dataName] = $this->logic->$method($this->params);
        }

        //echo json_encode($pageData);
        return $pageData;
    }

    public function action()
    {
        $this->logic->{'action'}();
    }

    private function loadBasicClass($themeId) {
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if( strpos($action, '-')){
        	$action=str_replace('-','', $action);
        }
        $className = "common\\logics\\basic\\"  . ucfirst($controller) . ucfirst($action) . "Logic";
        return $this->loadClassByPath($className,$themeId);
    }

    private function loadThemeClass($themeId,$themeCode) {
        $currentThemeCode = $themeCode;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        if( strpos($action, '-')){
        	$action=str_replace('-','', $action);
        }
        $className = "frontend\\themes\\" . $currentThemeCode . "\\logics\\" . ucfirst($controller) . ucfirst($action) . "Logic";
        return $this->loadClassByPath($className,$themeId);
    }
    private function loadSiteLogic($themeCode){
    	$currentThemeCode = $themeCode;
    	$className = "frontend\\themes\\" . $currentThemeCode . "\\logics\\SiteLogic";
    	return $this->loadClassByPath($className);
    }
    private function loadBasicSiteLogic(){
    	$className = $className = "common\\logics\\basic\\SiteLogic";
    	return $this->loadClassByPath($className);
    }

    private function loadClassByPath($className,$themeId='') {
        if (class_exists($className)) {
            $c = new $className($this->params,$themeId);
            return $c;
        }

        return false;
    }
}