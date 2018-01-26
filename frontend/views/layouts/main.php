<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$bundle=\frontend\assets\OtherAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name= "format-detection" content= "telephone=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1, user-scalable=no" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= \frontend\widgets\FrameBox\Login::widget(['url'=>$bundle->baseUrl]);?>

<?= \frontend\widgets\FrameBox\Register::widget(['url'=>$bundle->baseUrl]);?>

<?php $this->endBody() ?>
</body>
</html>
<script>

</script>
<?php $this->endPage() ?>
