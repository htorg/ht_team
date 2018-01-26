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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">产品信息</a> > <a class="btn_df">商铺</a></p></div>

    <div class="shop_wrap">
        <div class="shop_con">
            <?php if (empty($model->infos)){?>
            <!--shop_item-->
            <div class="shop_item">
                <div class="shop_case">
                    <img src="img/shop1.jpg">
                    <div class="shop_describe">
                        <i class="title_case">
                            <span class="title_df">重庆天安数码城</span>
                            <span class="subTitle_df">重庆市大渡口区金桥路9号</span>
                        </i>
                        <i class="case_content">
                            <span class="type_df case_txt">物业类型：商铺</span>
                            <span class="area_df case_txt">物业面积：120,000平方米</span>
                            <span class="use_area case_txt">可用面积：72,000平方米-120,000平方米</span>
                            <span class="property_df case_txt">物业性质：出租物业</span>
                            <span class="price_df case_txt">价格：面议</span>
                        </i>
                    </div>
                </div>
                <div class="shop_details">
                    <p>重庆天安数码城商铺项目总体量30万方，含8栋超高层、高层以及临江别墅的滨江豪宅，容积率2.5，绿化率达31%。项目位于大渡口九宫庙思源公园内，背依百万方高新产业园，面朝长江，更可鸟瞰整个重钢板块，江景视野非常开阔。</p>
                    <p>目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                    <p>重庆天安数码城大社区内有10万方的商业配套，运动休闲设施、幼儿园教育配套和高端私人会所，满足您对生活的高品位需求。从珑园步行10分钟就可达到大渡口商业步行街，出则繁华，入则静谧</p>
                </div>
            </div>

            <div class="shop_item">
                <div class="shop_case">
                    <img src="img/shop2.jpg">
                    <div class="shop_describe">
                        <i class="title_case">
                            <span class="title_df">重庆天安数码城</span>
                            <span class="subTitle_df">重庆市大渡口区金桥路9号</span>
                        </i>
                        <i class="case_content">
                            <span class="type_df case_txt">物业类型：商铺</span>
                            <span class="area_df case_txt">物业面积：120,000平方米</span>
                            <span class="use_area case_txt">可用面积：72,000平方米-120,000平方米</span>
                            <span class="property_df case_txt">物业性质：出租物业</span>
                            <span class="price_df case_txt">价格：面议</span>
                        </i>
                    </div>
                </div>
                <div class="shop_details">
                    <p>重庆天安数码城商铺项目总体量30万方，含8栋超高层、高层以及临江别墅的滨江豪宅，容积率2.5，绿化率达31%。项目位于大渡口九宫庙思源公园内，背依百万方高新产业园，面朝长江，更可鸟瞰整个重钢板块，江景视野非常开阔。</p>
                    <p>目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                    <p>重庆天安数码城大社区内有10万方的商业配套，运动休闲设施、幼儿园教育配套和高端私人会所，满足您对生活的高品位需求。从珑园步行10分钟就可达到大渡口商业步行街，出则繁华，入则静谧</p>
                </div>
            </div>
            <?php }else{foreach ($model->infos as $info){?>
                <div class="shop_item">
                    <div class="shop_case">
                        <img src="<?= DataHelper::getImgSrc($info->main_image)?>">
                        <div class="shop_describe">
                            <i class="title_case">
                                <span class="title_df"><?= $info->main_name ?></span>
                                <span class="subTitle_df"><?= $info->address ?></span>
                            </i>
                            <i class="case_content">
                                <span class="type_df case_txt">物业类型：商铺</span>
                                <span class="area_df case_txt">物业面积：<?= $info->property_area ?></span>
                                <span class="use_area case_txt">可用面积：<?= $info->available_area ?></span>
                                <span class="property_df case_txt">物业性质：<?= $info->property_properties ?></span>
                                <span class="price_df case_txt">价格：<?= $info->price ?></span>
                            </i>
                        </div>
                    </div>
                    <div class="shop_details">
                        <?= $info->main_description?>
                    </div>
                </div>
            <?php }}?>
            <div class="bar_btn"> <a class="btn_df btn_more" href="<?= Url::to(['site/contact'])?>">联系我们</a></div>
        </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
setNav('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
