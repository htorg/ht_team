<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
$bundle=\frontend\assets\AppAsset::register($this);
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
    <style>
        .help-block{
            font-size: 14px;
            color: red;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="center-frame">
    <div class="flex-frame">
        <div class="center_header">
            <div class="header_1444 clearfix">
                <i class="brand">BRAND</i>
                <div class="center_nav">
                    <ul class="nav_bx ">
                        <li class="nav_item" data-id="center"><span>我的信息</span></li>
                        <li class="nav_item" data-id="login"><span>登录安全</span></li>
                        <li class="nav_item" data-id="address"><span>我的地址</span></li>
                        <li class="nav_item" data-id="trade"><span>我的订单</span></li>
                    </ul>

                    <i class="user_case"><img src="img/ico_user.png"></i>
                </div>
            </div>
        </div>
        <div class="center_con">
            <div class="con_1444">
                <p class="crumb_row"><a class="crumb_df btn_df">个人中心</a> > <a class="crumb_df btn_df">我的信息</a></p>
                <div class="center_content clearfix">
                    <div class="ct_lt">
                        <i class="user_basic"><img class="case_portrait" src="img/portrait.jpg"><span class="userName">小萝卜</span></i>
                        <ul class="sideNav">
                            <li class="item_df nav_on" data-id="center"><span >我的信息</span></li>
                            <li class="item_df" data-id="login"><span >登陆安全</span></li>
                            <li class="item_df" data-id="address"><span >我的地址</span></li>
                            <li class="item_df" data-id="trade"><span >我的订单</span></li>
                        </ul>
                    </div>
                    <div class="ct_rt">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<script>
    $(function(){
        $(".con_1444").on("click", "li", function(){
            var sId = $(this).data("id"); //获取data-id的值
            window.location.hash = sId; //设置锚点
            loadInner(sId);
        });
        $(".center_nav").on("click", "li", function(){
            var sId = $(this).data("id"); //获取data-id的值
            window.location.hash = sId; //设置锚点
            loadInner(sId);
        });
        function loadInner(sId){
            var sId = window.location.hash;
            var pathn, i;
            switch(sId){
                case "#center": pathn = "<?= Url::to(['auth/info'])?>"; i = 0; break;
                case "#login": pathn = "<?= Url::to(['auth/login-sec'])?>"; i = 1; break;
                case "#address": pathn = "<?= Url::to(['auth/address'])?>"; i = 2; break;
                case "#trade": pathn = "<?= Url::to(['auth/trade'])?>"; i = 3; break;
                default: pathn = "<?= Url::to(['auth/info'])?>"; i = 0; break;
            }
            console.log(pathn);
            $(".ct_rt").load(pathn); //加载相对应的内容
            $(".con_1444 li").eq(i).addClass("nav_on").siblings().removeClass("nav_on"); //当前列表高亮
            $(".center_nav li").eq(i).addClass("nav_on").siblings().removeClass("nav_on"); //当前列表高亮
        }
        var sId = window.location.hash;
        loadInner(sId);
    });
</script>
<?php $this->endPage() ?>
