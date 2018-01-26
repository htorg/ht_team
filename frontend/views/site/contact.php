<?php


use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\helpers\DataHelper;
$bundle=AppAsset::register($this);
?>
<div class="main_df">
    <!--banner_wrap-->
    <?php if (is_object($model)){?>
        <?= \frontend\widgets\Banner::widget(['banner'=>$model->banner,'banner_title'=>$model->banner_title,'banner_subtitle'=>$model->banner_subtitle]) ?>
    <?php }?>

    <!--crumbs_wrap-->
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df" href="<?= Url::to(['site/index'])?>">走进天安</a> > <a class="btn_df">联系我们</a></p></div>

    <div class="subContent_df contact_wrap">
        <div class="subContent_con  contact_content">
            <p class="contact_title">联系方式</p>
            <div class="contact_ways_box clearfix">
                <dl class="contact_way_item">
                    <dt class="logo_df"><img src="img/tel-phone.png"></dt>
                    <dd class="way_describe">
                        <p>电话：<?= $model->phone?></p>
                    </dd>
                </dl>
                <dl class="contact_way_item">
                    <dt class="logo_df"><img src="img/email.png"></dt>
                    <dd class="way_describe">
                        <p>邮箱：<?= $model->email?></p>
                    </dd>
                </dl>
                <dl class="contact_way_item">
                    <dt class="logo_df"><img src="img/position.png"></dt>
                    <dd class="way_describe">
                        <p>地址：<?= $model->address?></p>
                    </dd>
                </dl>
            </div>

            <p class="map_case"><img src="<?= empty($model->map_img)?$bundle->baseUrl.'/img/conpany_map.jpg':DataHelper::getImgSrc($model->map_img)?>"></p>
        </div>

        <!--scan_wrap-->
        <div class="scan_wrap">
            <p class="scan_title">扫一扫关注我们</p>
            <div class="scan_con clearfix">
                <dl class="QR_item">
                    <dt class="case_df"><img src="<?= empty($model->wxopenid)?$bundle->baseUrl.'/img/QR_wechat.jpg':DataHelper::getImgSrc($model->wxopenid)?>" alt=""></dt>
                    <dd class="des_df">
                        <p>微信二维码</p>
                        <p>重庆天安数码城</p>
                    </dd>
                </dl>
                <dl class="QR_item">
                    <dt class="case_df"><img src="<?= empty($model->weibo)?$bundle->baseUrl.'/img/QR_weibo.jpg':DataHelper::getImgSrc($model->weibo)?>" alt=""></dt>
                    <dd class="des_df">
                        <p>微博二维码</p>
                        <p>重庆天安数码城云谷</p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
setNav('about');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
