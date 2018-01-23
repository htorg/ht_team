<?php
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/7/1
 * Time: 22:36
 */

namespace common\core\logic;


use Yii;

class WidgetLogicLoader extends LogicLoader
{
    protected $widgetName;
    public function __construct($theme, $widgetName)
    {
        $this->widgetName = $widgetName;
        parent::__construct($theme);
    }

    protected function loadLogic() {
        $currentThemeCode = $this->theme;
      	$className = "frontend\\themes\\" . $currentThemeCode . "\\widgets\\" . $this->widgetName . "\\". ucfirst($this->widgetName)."WidgetLogic";
        return $this->loadClassByPath($className);
    }
}