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

    <!--industry_digital-->
    <div class="industry_digital industry_wrap">
        <div class="industry_con">
            <p class="industry_title"><?= empty($model->main_title)?'重庆天安数码城二期':$model->main_title;  ?></p>
            <div class="smc_box clearfix">
                <?php if (!is_object($model->pics)){?>
                    <i class="big_case case_df"><img src="img/smc_1.jpg" alt=""></i>
                    <i class="sm_case1 case_df"><img src="img/smc_2.jpg" alt=""></i>
                    <i class="sm_case2 case_df"><img src="img/smc_13.jpg" alt=""></i>
                <?php }else{?>
                    <i class="big_case case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img1)?>" alt=""></i>
                    <i class="sm_case1 case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img2)?>" alt=""></i>
                    <i class="sm_case2 case_df"><img src="<?= DataHelper::getImgSrc($model->pics->info_img3)?>" alt=""></i>
                <?php }?>
            </div>
        </div>
    </div>

    <!--industry_company-->
    <div class="industry_company industry_wrap">
        <div class="industry_con">

            <p class="industry_title"><?= empty($model->second_title)?'企业专属总部基地   生态独栋办公别墅':$model->second_title;  ?></p>
            <?php if (empty($model->infos)){?>
            <div class="tiaAan_cyBer_park park_box">
                <p class="box_title ">
                    <img class="ico_df" src="img/ico_title.png"/>
                    <span class="txt_df ht_nowrap">TIANAN CYBER PARK</span>
                </p>

                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img.jpg"></i>
                        <p class="title_df">立体交通网络  急速联动全城</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>产品二期与轻轨2号线天堂堡站无缝衔接</li>
                            <li class="bc_row"><i class="ico_df"></i>园区内外与周边路网有机结合，仅距内环入口1公路</li>
                            <li class="bc_row"><i class="ico_df"></i>急速连接江北机场、重庆北站、各大城市商圈</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img1.jpg"></i>
                        <p class="title_df">LOFT商务空间   完善成熟服务   高配企业平台</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>产品二期分为6.6米层高、3.7米层高两种产品，其中6.6米层高一套可享两层使用面积</li>
                            <li class="bc_row"><i class="ico_df"></i>提供自装分体空调机位，可供企业自主选择，既保证工作环境的舒适性，又帮助企业灵活控制运营成本</li>
                            <li class="bc_row"><i class="ico_df"></i>园区已进驻13家政府/金融/服务机构，并引入创客咖啡、特色餐饮，极尽满足企业的多元化需求</li>
                            <li class="bc_row"><i class="ico_df"></i>拥有500人豪华会议中心，是您的企业进行商业洽谈、重要会议的上佳选择</li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }else{foreach ($model->infos as $info){?>
                <div class="tiaAan_cyBer_park park_box">
                    <div class="box_content">
                        <div class="bc_ctn">
                            <i class="bc_case"><img src="<?= DataHelper::getImgSrc($info->node_image)?>"></i>
                            <p class="title_df"><?= $info->node_name ?></p>
                            <ul class="bc_list">
                                <?php if (!empty($info->node_description)){foreach ($info->node_description as $desc){?>
                                <li class="bc_row"><i class="ico_df"></i><?= $desc ?></li>
                                <?php }}?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php }}?>
        </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
setNav('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
