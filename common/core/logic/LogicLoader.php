<?php
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/7/1
 * Time: 21:43
 */

namespace common\core\logic;


use Yii;

abstract class LogicLoader
{
    protected $logic;
    protected $theme;
    public function __construct($theme)
    {
        $this->theme = $theme;
        $this->logic = $this->loadLogic();
    }

    public function action($data) {
        if (!is_object($this->logic)) {
            return $data;
        }		
        return $this->logic->{'action'}($data);
    }

    abstract protected function loadLogic();


    protected function loadClassByPath($className) {
        if (class_exists($className)) {
            $c = new $className;
            return $c;
        }

        return false;
    }
}