<?php

use yii\helpers\Url;

$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
    <p>个人中心</p>
</div>

<?php $this->beginBlock('test') ?>
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
