<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use common\helpers\NavHelper;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\models\CmsCategory;
use common\models\CmsProductCategory;
use common\models\CmsShareBtn;
use common\helpers\UtilHelper;
use common\widgets\KefuBox\KefuBox;
use yii\base\Widget;
use common\helpers\ThemeHelper;

$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="author" content="深圳市光合科技有限公司">  
    <meta http-equiv = "X-UA-Compatible" content = "chrome=1" />
    <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1, user-scalable=no" />
    <meta name= "format-detection" content= "telephone=no" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title).' - '.$this->context->mainDatas['cmsSite']['name'] ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <?= $content?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
