<?php
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/7/1
 * Time: 22:36
 */

namespace common\core\logic;


use Yii;

class PageLogicLoader extends LogicLoader
{
    protected function loadLogic() {
        $currentThemeCode = $this->theme;
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;
        $className = "frontend\\themes\\" . $currentThemeCode . "\\logic\\" . ucfirst($controller) . ucfirst($action) . "Logic";

        return $this->loadClassByPath($className);
    }
}