<?php
namespace backend\components;

use common\helpers\ThemeHelper;
use Yii;
use backend\helpers\SiteHelper;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/2/6
 * Time: 16:39
 */

class Controller extends \yii\web\Controller {
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            date_default_timezone_set('Asia/Shanghai');
            header('Content-Type: text/html; charset=utf-8');
			if(Yii::$app->user->isGuest){;
				// 没有登录,登录,登录后,返回
			    Yii::$app->user->setReturnUrl(Yii::$app->request->getUrl());  // 设置返回的url,登录后原路返回
			    Yii::$app->user->loginRequired();
			    Yii::$app->end();
			};
			return true;
        } else {
            return false;
        }
    }
}