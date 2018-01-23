<?php
namespace common\logics\core;
use Yii;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/6/9
 * Time: 21:18
 */
class CacheLogic {
    //缓存未命中时，统一返回false
    static  public function get($key) {
        $realKey  = self::getRealKey($key);
        $cache = Yii::$app->cache;
        return $cache->get($realKey);
    }

    static public function set($key, $data, $time = 0) {
        $realKey  = self::getRealKey($key);
        $cache = Yii::$app->cache;
        $cache->set($realKey, $data, $time);
    }

    static public function del($key) {
        $realKey  = self::getRealKey($key);
        $cache = Yii::$app->cache;
        $cache->delete($realKey);
    }

    static public function getRealKey($key)
    {
        $controller = Yii::$app->controller->id;
        $action = Yii::$app->controller->action->id;

        return lcfirst($controller) . "_" . lcfirst($action) . "_" . $key;
    }
}