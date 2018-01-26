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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">产品信息</a> > <a class="btn_df">住宅</a></p></div>

    <!--industry_digital-->
    <div class="industry_digital industry_wrap">
        <div class="industry_con">
            <p class="industry_title"><?= empty($model->main_title)?'天安·珑园':$model->main_title;  ?></p>
            <div class="smc_box clearfix">
                <?php if (!is_object($model->pics)){?>
                <i class="big_case case_df"><img src="img/smc_7.jpg" alt=""></i>
                <i class="sm_case1 case_df"><img src="img/smc_8.jpg" alt=""></i>
                <i class="sm_case2 case_df"><img src="img/smc_9.jpg" alt=""></i>
                <?php }else{?>
                    <i class="big_case case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img1)?>" alt=""></i>
                    <i class="sm_case1 case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img2)?>" alt=""></i>
                    <i class="sm_case2 case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img3)?>" alt=""></i>
                <?php }?>
            </div>
        </div>
    </div>

    <!--info_house-->
    <div class="info_house">
        <img src="<?= empty($model->pics->sub_banner)?$bundle->baseUrl.'img/house.jpg':DataHelper::getImgSrc($model->pics->sub_banner)?>"/>
        <div class="info_house_con">
            <div class="contain_txt">
                <?php if (empty($model->product_detail)){?>
                    <p>目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                <?php }else{?>
                    <p><?= $model->product_detail ?></p>
                <?php }?>
            </div>
            <ul class="house_list clearfix">
                <?php if (empty($model->pics->show_pics)){?>
                    <li><a class="house_item"><img src="img/house1.jpg"/></a><p class="house_txt ht_nowrap">商圈旁</p></li>
                    <li><a class="house_item"><img src="img/house2.jpg"/></a><p class="house_txt ht_nowrap">公园里</p></li>
                    <li><a class="house_item"><img src="img/house3.jpg"/></a><p class="house_txt ht_nowrap">长江畔</p></li>
                    <li><a class="house_item"><img src="img/house4.jpg"/></a><p class="house_txt ht_nowrap">太平层</p></li>
                <?php }else{ foreach ($model->pics->show_pics as $pic){?>
                    <li><a class="house_item"><img src="<?= DataHelper::getImgSrc($pic->src)?>"/></a><p class="house_txt ht_nowrap"><?= $pic->name?></p></li>
                <?php }}?>
            </ul>
        </div>
    </div>

    <div class="house_bar"><p class="title_df ht_nowrap"><?= empty($model->second_title)?'现房实景·献给懂生活的人':$model->second_title;  ?></p></div>
</div>
<?php $this->beginBlock('test') ?>
setNav('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
