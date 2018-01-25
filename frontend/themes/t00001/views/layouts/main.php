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
//var_dump($this->context->mainDatas);
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
    <style>
    	.radio{margin:0 !important;float:left;width:50px}
        @font-face {font-family: "iconfont";
            src: url('<?= \Yii::getAlias('@web')?>/font/iconfont.eot'); /* IE9*/
            src: url('<?= \Yii::getAlias('@web')?>/font/iconfont.eot#iefix') format('embedded-opentype'), /* IE6-IE8 */
            url('<?= \Yii::getAlias('@web')?>/font/iconfont.woff') format('woff'), /* chrome, firefox */
            url('<?= \Yii::getAlias('@web')?>/font/iconfont.ttf') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
            url('<?= \Yii::getAlias('@web')?>/font/iconfont.svg#iconfont') format('svg'); /* iOS 4.1- */
        }

        .iconfont {
            font-family:"iconfont" !important;
            font-size:30px;
            font-style:normal;
            -webkit-font-smoothing: antialiased;
            -webkit-text-stroke-width: 0.2px;
            -moz-osx-font-smoothing: grayscale;
        }
    </style>
</head>
<body>
<?php $this->beginBody() ?>
<div class="flex-frame">
    <!--header_df-->
    <div class="header_df">
        <img class="logo" src="<?= SiteHelper::getImgSrc($this->context->mainDatas['cmsSite']['logo']) ?>" onclick="window.location.href='<?= Url::to(['site/index']) ?>'" />
        <ul class="nav_list">
        	<?php if (!empty($this->context->mainDatas['navs'])){
        		foreach($this->context->mainDatas['navs'] as $key => $nav){
        	?>
	        	<?php if ($nav['type']!=CmsNav::TYPE_HOMEPAGE){?>
		            <li class="nav_li"><i class="nav_item" rel="<?= $nav['ext_id'] ?>" ><?= $nav['name'] ?></i>
		            	
		            	 <ul class="subNav_list">
		                    <li><a class="subNav_item" href="<?= NavHelper::getNavUrl($nav); ?>">产品介绍</a></li>
		                    <li><a class="subNav_item" href="<?= Url::to(['site/upload','id'=>$nav['ext_id']]) ?>">APP下载</a></li>
		                </ul>	                
		            </li>
		            <?php }else{ ?>
		                <li class="nav_li"><i class="nav_item" rel="<?= $nav['type'] ?>" onclick="window.location.href='<?= Url::to(['site/index']) ?>'" ><?= $nav['name'] ?></i></li>	
		            <?php }?>           
             <?php }}?> 
             <li class="nav_li"><i class="nav_item" id="about-nav" rel="<?php echo CmsNav::TYPE_PAGE_ABOUT?>">关于我们</i>
             	<ul class="subNav_list">
                    <li><a class="subNav_item" href="<?= Url::to(['site/about']); ?>">关于我们</a></li>
                    <li><a class="subNav_item" href="<?= Url::to(['site/list']); ?>">企业新闻</a></li>
                </ul>
             </li>

             <li class="nav_li"><a class="nav_item" href="https://www.jd.com/">购买</a></li>
            <li class="nav_li" style="padding-top:35px;">
                <a href="<?= Url::to(['site/login'])?>" style="color: #2c2d2e;font-size: 18px;font-weight: 600;">登录</a>
                <span >||</span>
                <a href="https://www.jd.com/" style="color: #2c2d2e;font-size: 18px;font-weight: 600;">注册</a>
            </li>
        </ul>
    </div>
    
    <?= $content ?>	



    <!--footer_df-->
    <div class="footer_df">
        <div class="ft_news_wrap">
            <p class="title_df">最新动态</p>
            <ul class="ft_news_slider">
	            <?php if (!empty($this->context->mainDatas['news-banner'])){
	        		foreach($this->context->mainDatas['news-banner']['images'] as $key => $val){
	        	?>
                <li class="slide"><a class="img_case" href="<?= $val['link'] ?>"><img src="<?= SiteHelper::getImgSrc($val['image']) ?>"  alt="" title="<?= $val['summary']?>" /></a></li>
                <?php }}?> 
            </ul>
        </div>

        <!--ft_bt_contain-->
        <div class="ft_bt_contain">
            <p class="ft_topLine"></p>
            <div class="ft_wrap clearfix">
                <ul class="ft_navList ">
                    <li class="ft_li">
                        <p class="ft_navLabel">服务支持</p>
                        <ul class="ft_subNavList">
                        	<?php if (!empty($this->context->mainDatas['articles'])){foreach ($this->context->mainDatas['articles'] as $val){?>
                           	<li><a class="ft_nav" href="<?= Url::to(['site/question','id'=>$val['id']]) ?>"><?= $val['name'] ?></a></li>
                           <?php }}?>
                        </ul>
                    </li>

                    <li class="ft_li">
                        <p class="ft_navLabel">现在购买</p>
                        <ul class="ft_subNavList">
                            <li><a class="ft_nav" href="https://item.jd.com/14738538679.html">京东商城</a></li>
                            <li><a class="ft_nav" href="https://detail.tmall.com/item.htm?spm=a220m.1000858.1000725.1.2e0b0eeazDnnoX&id=549603629595&skuId=3507482807989&areaId=440300&user_id=3021871343&cat_id=2&is_b=1&rn=fcb64e6172e859b8a11ecb1df61b3499">天猫旗舰</a></li>
                        </ul>
                    </li>

                    <li class="ft_li">
                        <p class="ft_navLabel">关于我们</p>
                        <ul class="ft_subNavList">
                            <li><a class="ft_nav" href="<?= Url::to(['site/about']); ?>#aaa">公司介绍</a></li>
                            <li><a class="ft_nav" href="<?= Url::to(['site/about']); ?>#bbb">公司文化</a></li>
                        </ul>
                    </li>
                    <li class="ft_li">
                        <p class="ft_navLabel">关注小萝卜</p>
                        <ul class="ft_subNavList">
                            <li><a class="ft_nav" href="<?= Url::to(['site/list']); ?>">最新近况</a></li>
                            <li><a class="ft_nav">微信公众号</a></li>
                        </ul>
                    </li>

                </ul>

                <div class="ft_info">
                    <i class="ft_logo"></i>
                    <p class="txt_df"><?= $this->context->mainDatas['cmsSite']['name'] ?></p>
                    <p class="txt_df">客服热线：<?= $this->context->mainDatas['contact']['telephone'] ?></p>
                    <p class="txt_df">网络邮箱：<?= $this->context->mainDatas['contact']['email'] ?></p>
                </div>

            </div>
            <p class="ft_Copyright">Copyright &copy 2015 luobotec.com All Rights Reserved 版权所有.萝卜科技 京ICP备14027893号-1</p>

        </div>
    </div>
</div>
<div class="masking" style="width: 100%;height: 100%;background-color: #000000;opacity: 0.3;position:fixed;top: 0;left: 0;"></div>
<!--<div class="login-box" style="width:440px;height:335px;background-color: #fff;border:2px solid #ffbb3c;border-radius: 12px;top: 50%;position:fixed;left: 50%;margin-top:-168px ;margin-left:-220px;">-->
<!--    <div class="login-title" style="text-align:center;padding-top: 30px">-->
<!--        <img class="login-logo" style="width:154px;" src="--><?//= SiteHelper::getImgSrc($this->context->mainDatas['cmsSite']['logo']) ?><!--">-->
<!--        <i class="iconfont" style="position:absolute;right: 10px;top: 15px">&#xe625;</i>-->
<!--    </div>-->
<!--    <div class="login-form">-->
<!--        -->
<!--    </div>-->
<!--</div>-->

<!--frame_signIn-->
<div class="frame_signIn  frame_bx " style="display:none;">
    <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
    <img class="logo_df" src="../themes/t00001/dist/img/frame_logo.png">
    <form class="frame_form">
        <div class="input_bx">
            <i class="ico_account"></i>
            <input class="writeIn" type="text" placeholder="用户名">
        </div>
        <div class="input_bx">
            <i class="ico_password"></i>
            <input class="writeIn" type="password" placeholder="登录密码">
        </div>
        <p class="btn_row">
            <a class="btn_df" href="#">立即注册</a>|<a class="btn_df" href="#">忘记密码</a>
        </p>

        <a class="btn_df frame_btn noneSelect">登录</a>
    </form>
</div>

<!--frame_register_message-->
<div class="frame_register_message  frame_bx " >
    <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
    <img class="logo_df" src="../themes/t00001/dist/img/frame_logo.png">
    <form class="frame_form">
        <div class="input_bx">
            <i class="ico_number"></i>
            <input class="writeIn" type="text" placeholder="手机号">
        </div>

        <div class="verify_code">
            <div class="input_bx">
                <i class="ico_code"></i>
                <input class="writeIn" type="text" placeholder="验证码">
            </div>
            <button class="getVerify_btn btn_df" type="button" >获取短信验证码</button>
        </div>

        <div class="check_bx">
            <input id="sigIn_protocol" type="checkbox" >
            <label class="sigIn_protocol_label noneSelect " for="sigIn_protocol"></label>
            <span class="words_df noneSelect">我已阅读并同意<a class="btn_df">《新物种用户注册协议》<a></a></span>
        </div>

        <a class="btn_df frame_btn noneSelect">注册</a>
    </form>
</div>


<!--frame_register_account-->
<div class="frame_register_account  frame_bx " style="display:none;">
    <i class="iconfont delete_df btn_df noneSelect">&#xe625;</i>
    <img class="logo_df" src="../themes/t00001/dist/img/frame_logo.png">
    <form class="frame_form">
        <div class="input_bx">
            <i class="ico_account"></i>
            <input class="writeIn" type="text" placeholder="昵称">
        </div>

        <div class="input_bx">
            <i class="ico_password"></i>
            <input class="writeIn" type="password" placeholder="设置密码">
        </div>

        <div class="input_bx again_input">
            <i class="ico_password"></i>
            <input class="writeIn" type="password" placeholder="确认密码">
        </div>
        <a class="btn_df frame_btn noneSelect">完成</a>
    </form>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
