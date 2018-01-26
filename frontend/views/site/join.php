<?php

/* @var $this yii\web\View */
use common\helpers\DataHelper;
use yii\helpers\Url;
use frontend\widgets\NewLinkPager;

$bundle=\frontend\assets\AppAsset::register($this);
var_dump($bundle->baseUrl);
?>
<div class="main_df">
    <!--banner_wrap-->
    <div class="banner_wrap">
        <img class="b_img" src="<?= $bundle->baseUrl?>/img/banner_enter.jpg" alt="">
        <div class="banner_des">
            <p class="title_df ht_nowrap">入驻企业</p>
            <p class="subTitle_df ht_nowrap"></p>
        </div>
    </div>

    <!--crumbs_wrap-->
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">运营服务</a> > <a class="btn_df">物业服务</a></p></div>

    <div class="enter_wrap">
        <div class="enter_contain">
            <div  class="title_bx">
                <p class="title_df">入驻企业</p>
                <p class="sub_title_df">各大合伙伙伴展示</p>
            </div>

            <ul class="enter_company_logo_list clearfix">
                <?php if (!empty($list)){foreach ($list as $val){?>
                <li class="item_df"><a class="enter_company_logo_case" href="<?= $val['site_url']?>"><img src="<?=  DataHelper::getImgSrc($val['logo'])?>"></a></li>
                <?php }}?>
            </ul>
            <div class="page_wrap">
                <?= NewLinkPager::widget(['pagination' => $pagination]) ?>
            </div>
        </div>

    </div>



</div>