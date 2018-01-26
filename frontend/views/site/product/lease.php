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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">产品信息</a> > <a class="btn_df">产业楼</a></p></div>

    <div class="rent_wrap">
        <div class="rent_con ">
            <!--rent_item_lt-->
            <?php if (empty($model->infos)){?>
            <div class="rent_item_lt clearfix">
                <i class="rent_case_lt">
                    <img src="img/rent_lt.jpg" alt=""/>

                    <em class="des_case">
                        <span class="case_title">xxx办公楼</span>
                        <b class="mask_case">
                            <span class="hs_intro">物业类型：<i></i>商铺</span>
                            <span class="hs_intro">物业面积：120,000平方米</span>
                            <span class="hs_intro">可用面积：72,000平方米-120,000平方米</span>
                            <span class="hs_intro">物业性质：出租物业</span>
                            <span class="hs_intro">价格：面议</span>
                        </b>
                    </em>
                </i>
                <div class="rent_detail">
                    <p class="title_df">办公楼特色</p>
                    <div class="describe_df ">
                        <p>重庆天安数码城商铺项目总体量30万方，含8栋超高层、高层以及临江别墅的滨江豪宅，容积率2.5，绿化率达31%。项目位于大渡口九宫庙思源公园内，背依百万方高新产业园，面朝长江，更可鸟瞰整个重钢板块，江景视野非常开阔。
                            目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                    </div>
                </div>
                <i class="rent_case_bt"><img src="img/rent_bt.jpg" alt="" /></i>
            </div>

            <!--rent_item_rt-->
            <div class="rent_item_rt  clearfix">
                <i class="rent_case_lt">
                    <img src="img/rent_2.jpg" alt=""/>
                    <em class="des_case">
                        <span class="case_title">服务式办公楼特色</span>
                        <b class="mask_case">
                            <span style="line-height:1.5;">目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</span>
                        </b>
                    </em>
                </i>
                <div class="rent_detail">
                    <p class="title_df">服务式办公楼特色</p>
                    <div class="describe_df ">
                        <p>重庆天安数码城商铺项目总体量30万方，含8栋超高层、高层以及临江别墅的滨江豪宅，容积率2.5，绿化率达31%。项目位于大渡口九宫庙思源公园内，背依百万方高新产业园，面朝长江，更可鸟瞰整个重钢板块，江景视野非常开阔。
                            目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                    </div>
                </div>
                <i class="rent_case_bt"><img src="img/rent_bt2.jpg" alt="" /></i>
            </div>

            <!--rent_item_lt-->
            <div class="rent_item_lt clearfix">
                <i class="rent_case_lt">
                    <img src="img/rent3.jpg" alt=""/>
                    <em class="des_case">
                        <span class="case_title">联合办公空间特色</span>
                        <b class="mask_case">
                            <span style="line-height:1.5;">目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</span>
                        </b>
                    </em>
                </i>
                <div class="rent_detail">
                    <p class="title_df">联合办公空间特色</p>
                    <div class="describe_df ">
                        <p>重庆天安数码城商铺项目总体量30万方，含8栋超高层、高层以及临江别墅的滨江豪宅，容积率2.5，绿化率达31%。项目位于大渡口九宫庙思源公园内，背依百万方高新产业园，面朝长江，更可鸟瞰整个重钢板块，江景视野非常开阔。
                            目前已建成天安·珑园一期4栋41层的超高层和1栋私人会所，住宅都是一梯一户的（1、2、8号楼：三梯三户。 7号楼：2梯2户），面积区间：建筑面积149—417㎡舒适大平层。目前仅剩20席套内约178-188㎡朗阔三房/奢华四房。</p>
                    </div>
                </div>
                <i class="rent_case_bt"><img src="img/rent_bt3.jpg" alt="" /></i>
            </div>
            <?php }else{?>
                <div class="rent_item_lt clearfix">
                    <i class="rent_case_lt">
                        <img src="<?= DataHelper::getImgSrc($model->infos[0]->node_image)?>" alt=""/>
                        <em class="des_case">
                            <span class="case_title"><?= $model->infos[0]->node_name ?></span>
                            <b class="mask_case">
                                <span class="hs_intro">物业类型：<i></i>商铺</span>
                                <span class="hs_intro">物业面积：<?= $model->infos[0]->property_area ?></span>
                                <span class="hs_intro">可用面积：<?= $model->infos[0]->available_area ?></span>
                                <span class="hs_intro">物业性质：<?= $model->infos[0]->property_properties ?></span>
                                <span class="hs_intro">价格：<?= $model->infos[0]->price ?></span>
                            </b>
                        </em>
                    </i>
                    <div class="rent_detail">
                        <p class="title_df"><?= $model->infos[0]->main_name ?></p>
                        <div class="describe_df ">
                            <?= $model->infos[0]->	main_description ?>
                        </div>
                    </div>
                    <i class="rent_case_bt"><img src="<?= DataHelper::getImgSrc($model->infos[0]->main_image)?>" alt="" /></i>
                </div>
                <?php foreach ($model->infos as $key=>$val){if ($key>0){if ($key%2==1){?>
                    <!--rent_item_rt-->
                    <div class="rent_item_rt  clearfix">
                        <i class="rent_case_lt">
                            <img src="<?= DataHelper::getImgSrc($val->node_image)?>" alt=""/>
                            <em class="des_case">
                                <span class="case_title"><?= $val->node_name ?></span>
                                <b class="mask_case">
                                    <span style="line-height:1.5;"><?= $val->node_description?></span>
                                </b>
                            </em>
                        </i>
                        <div class="rent_detail">
                            <p class="title_df"><?= $val->main_name ?></p>
                            <div class="describe_df ">
                                <?= $val->main_description?>
                            </div>
                        </div>
                        <i class="rent_case_bt"><img src="<?= DataHelper::getImgSrc($val->main_image)?>" alt="" /></i>
                    </div>
                    <?php }else{?>
                    <!--rent_item_lt-->
                    <div class="rent_item_lt clearfix">
                        <i class="rent_case_lt">
                            <img src="<?= DataHelper::getImgSrc($val->node_image)?>" alt=""/>
                            <em class="des_case">
                                <span class="case_title"><?= $val->node_name ?></span>
                                <b class="mask_case">
                                    <span style="line-height:1.5;"><?= $val->node_description?></span>
                                </b>
                            </em>
                        </i>
                        <div class="rent_detail">
                            <p class="title_df"><?= $val->main_name ?></p>
                            <div class="describe_df ">
                                <?= $val->main_description?>
                            </div>
                        </div>
                        <i class="rent_case_bt"><img src="<?= DataHelper::getImgSrc($val->main_image)?>" alt="" /></i>
                    </div>
            <?php }}}}?>

        </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
setNav('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
