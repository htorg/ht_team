<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<i class="user_basic"><img class="case_portrait" src="<?= \common\helpers\DataHelper::getUserAvatar($pic)?>"><span class="userName"><?= $username?></span></i>