<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<!--center-menu-->
<div class="center_header">
    <div class="header_1444 clearfix">
        <i class="brand">BRAND</i>
        <div class="center_nav">
            <ul class="nav_bx ">
                <li class="nav_item nav_on">我的信息</li>
                <li class="nav_item">登录安全</li>
                <li class="nav_item">我的地址</li>
                <li class="nav_item">我的订单</li>
            </ul>
            <ul class="nav_bx ">
                <?php if (Yii::$app->user->isGuest){?>
                    <li class="nav_item login-btn">登录</li>
                    <li class="nav_item register-btn">注册</li>
                <?php }else{?>
                <li class="nav_item"><a class="user_case" href="<?= Url::to(['auth/center'])?>"><img src="<?= \common\helpers\DataHelper::getUserAvatar($pic)?>"></a></li>
                <li class="nav_item"><a href="<?= Url::to(['auth/logout'])?>">退出登录</a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>