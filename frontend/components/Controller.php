<?php
namespace frontend\components;

use common\helpers\ThemeHelper;
use common\models\CmsCategory;
use common\models\CmsPageContact;
use common\models\CmsProduct;
use common\models\HomepageConfig;
use Yii;
use backend\helpers\SiteHelper;
use yii\helpers\Url;


class Controller extends \yii\web\Controller {
    public $products;
    public $category_list;
    public $record;
    public $contact;
    public function beforeAction($action)
    {
        date_default_timezone_set('Asia/Shanghai');
        header('Content-Type: text/html; charset=utf-8');
        return true;
      /*  if (parent::beforeAction($action)) {
            $this->products=CmsProduct::find()->select(['id','type'])->distinct()->asArray()->all();
            $this->category_list=CmsCategory::find()->where(['type'=>CmsCategory::TYPE_NEWS])->all();
            $this->record=HomepageConfig::find()->one();
            $this->contact=CmsPageContact::find()->where(['type'=>CmsPageContact::TYPE_COMPANY])->one();
            $this->getView()->title='天安数码城';
            //var_dump($this->contact->address);die();
            return true;
        } else {
            return false;
        }*/
    }
}