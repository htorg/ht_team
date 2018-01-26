<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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
<div class="flex-frame">
    <!--header_df-->
    <div class="header_df">
        <div class="header_wrap">
            <a class="logo_case" href="<?= Url::to(['site/index'])?>"></a>
            <ul class="nav_list clearfix  ">
                <li class="nav_hover" >
                    <div class="nav_item " rel="about">
                        <!--nav_item_on 为选中-->
                        <a class="nav_item_next" href="<?= Url::to(['site/about'])?>">走进天安</a>
                        <div class="subNav_Bar" >
                            <p class="subBar_case">
                                <a class="subBar_item" href="<?= Url::to(['site/about'])?>">公司简介</a>
                                <a class="subBar_item" href="<?= Url::to(['site/about-park'])?>">园区概况</a>
                                <a class="subBar_item" href="<?= Url::to(['site/contact'])?>">联系方式</a>
                                <a class="subBar_item" href="<?= Url::to(['site/honor'])?>">资质荣誉</a>
                            </p>
                        </div>
                        <!--line_df-->
                        <em class="effect_line line_df"></em>
                    </div>
                </li>
                <li class="nav_hover" >
                    <div class="nav_item " rel="news">
                       <a class="nav_item_next" href="<?= Url::to(['site/list'])?>">新闻中心</a>
                        <div class="subNav_Bar" >
                            <?php if (!empty($this->context->category_list)){
                            foreach ($this->context->category_list as $cate){
                            ?>
                            <p class="subBar_case"><a class="subBar_item" href="<?= Url::to(['site/list','id'=>$cate['id']])?>"><?= $cate['name'] ?></a></p>
                            <?php }} ?>
                        </div>
                        <!--line_df-->
                        <em class="effect_line line_df"></em>
                    </div>
                </li>
                <li class="nav_hover">
                    <div class="nav_item " rel="product">
                        <a class="nav_item_next" href="<?= Url::to(['site/product']) ?>">产品信息</a>
                        <div class="subNav_Bar" >
                            <p class="subBar_case">
                                <?php if (!empty($this->context->products)){
                                foreach ($this->context->products as $product){
                                ?>
                                <a class="subBar_item" href="<?= Url::to(['site/product','id'=>$product['id']])?>"><?= \common\models\CmsProduct::getProductType($product['type']) ?></a>
                                <?php }} ?>
                            </p>
                        </div>
                        <!--line_df-->
                        <em class="effect_line line_df"></em>
                    </div>
                </li>
                <li class="nav_hover">
                    <div class="nav_item " rel="operate">
                        <a class="nav_item_next" href="<?= Url::to(['site/settled'])?>">运营服务</a>
                        <div class="subNav_Bar" >
                            <p class="subBar_case">
                                <a class="subBar_item" href="<?= Url::to(['site/settled'])?>">入驻流程</a>
                                <a class="subBar_item" href="<?= Url::to(['site/operate'])?>">物业服务</a>
                            </p>
                        </div>
                        <!--line_df-->
                        <em class="effect_line line_df"></em>
                    </div>
                </li>
            </ul>

            <!--mobile-->
            <i  id="menu_btn"></i>
            <div class="mb_nav_page">
                <ul class="subNav_list ">
                    <li>
                        <div class="item_df " rel="about">
                            <p class="item_title">走进天安</p>
                            <p class="ph_subNav_subBar">
                                <a class="ph_subBar_item" href="<?= Url::to(['site/about'])?>">公司简介</a>
                                <a class="ph_subBar_item" href="<?= Url::to(['site/about-park'])?>">园区概况</a>
                                <a class="ph_subBar_item" href="<?= Url::to(['site/contact'])?>">联系方式</a>
                                <a class="ph_subBar_item" href="<?= Url::to(['site/honor'])?>">资质荣誉</a>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="item_df " rel="news">
                            <p class="item_title">新闻中心</p>
                            <p class="ph_subNav_subBar">
                                <?php if (!empty($this->context->category_list)){
                                foreach ($this->context->category_list as $cate){
                                ?>
                                <a class="ph_subBar_item" href="<?= Url::to(['site/list','id'=>$cate['id']])?>"><?= $cate['name'] ?></a>
                                <?php }} ?>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="item_df" rel="product">
                            <p class="item_title">产品信息</p>
                            <p class="ph_subNav_subBar">
                                <?php if (!empty($this->context->products)){
                                    foreach ($this->context->products as $product){
                                        ?>
                                        <a class="ph_subBar_item" href="<?= Url::to(['site/product','id'=>$product['id']])?>"><?= \common\models\CmsProduct::getProductType($product['type']) ?></a>
                                    <?php }} ?>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="item_df" rel="operate">
                            <p class="item_title">运营服务</p>
                            <div class="ph_subNav_subBar">
                                <a class="ph_subBar_item" href="<?= Url::to(['site/settled'])?>">入驻流程</a>
                                <a class="ph_subBar_item" href="<?= Url::to(['site/operate'])?>">物业服务</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <?= $content ?>
    <div class="footer_df">
        <div class="ft_wrap">
            <ul class="ft_nav clearfix">
                <li><a class="item_df"  href="<?= Url::to(['site/about'])?>">公司简介</a></li>
                <li><a class="item_df" href="<?= Url::to(['site/contact'])?>">联系我们</a></li>
                <li><a class="item_df" href="<?= Url::to(['site/list'])?>">新闻中心</a></li>
                <li><a class="item_df" href="<?= Url::to(['site/operate'])?>">物业服务</a></li>
            </ul>
            <p class="copy_row"><?= empty($this->context->record->copyright)?'':$this->context->record->copyright ;?></p>
            <p class="copy_row"><?= empty($this->context->record->record)?'':$this->context->record->record ;?>  天安数码城（集团）有限公司  <?= empty($this->context->contact->address)?'重庆市XX区XX大道西段XX号XX幢':$this->context->contact->address ;?>  <?= empty($this->context->contact->phone)?'023-123456788':$this->context->contact->phone ;?></p>

            <!--ft_contact_others-->
            <div class="ft_contact_others clearfix">
                <dl class="others_item" >
                    <dt class="ico_df ico_weibo" >
                    </dt>
                    <dd class="txt_df">微博</dd>
                </dl>
                <dl class="others_item">
                    <dt class="ico_df ico_wechat">
                        <img src="<?= empty($this->context->contact->wxopenid)?'':\common\helpers\DataHelper::getImgSrc($this->context->contact->wxopenid)?>" alt=""/>
                    </dt>
                    <dd class="txt_df">微信</dd>
                </dl>
                <dl class="others_item">
                    <dt class="ico_df ico_qq">
                        <img src="<?= empty($this->context->contact->wxopenid)?'':\common\helpers\DataHelper::getImgSrc($this->context->contact->wxopenid)?>" alt=""/>
                    </dt>
                    <dd class="txt_df">QQ</dd>
                </dl>
            </div>
        </div>

    </div>
    <div class="mask_layout"></div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
