<?php
namespace backend\widgets\SideBar;

use common\models\CmsCategory;
use yii\base\Widget;
use backend\helpers\SiteHelper;
use yii\web\NotAcceptableHttpException;
use common\helpers\ThemeHelper;
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/2/21
 * Time: 13:56
 */

class SideBar extends Widget
{
    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $category_type=CmsCategory::getCategoryType();
        return $this->render('sidebar',['category_type'=>$category_type]);
    }
}