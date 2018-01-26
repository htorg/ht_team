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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">产品信息</a> > <a class="btn_df">总部楼</a></p></div>

    <!--industry_digital-->
    <div class="industry_digital industry_wrap">
        <div class="industry_con">
            <p class="industry_title"><?= empty($model->main_title)?'重庆主城核心区域 百万方低密产业公园':$model->main_title;  ?></p>
            <div class="ind_garden clearfix">
                <p class="ind_item1"><i class="ind_ico"></i><em class="ind_txt ht_nowrap"><?= empty($model->pics->info_title1)?'构筑最具价值企业生态圈':$model->info_title1;  ?></em></p>
                <p class="ind_item2"><i class="ind_ico"></i><em class="ind_txt ht_nowrap"><?= empty($model->pics->info_title2)?'构筑最具价值企业生态圈':$model->info_title2;  ?></em></p>
                <p class="ind_item3">
                    <em class="ind_title">了解我们：</em>
                    <i class="ind_des">
                        <?php if (empty($model->pics->info_title3)){?>
                        <span class="ind_tCon">构筑最具价值企业生态圈</span>
                        <span class="ind_tCon">T+SPACE众创基地 + 3个主题孵化器 + 4大产业集群</span>
                        <span class="ind_tCon">获得3项国家级、7项省级资质评定（截止2016年12月31日）</span>
                        <?php }else{ $titles=explode("\r\n",$model->pics->info_title3);foreach ($titles as $title){?>
                            <span class="ind_tCon"><?= $title ?></span>
                        <?php }}?>
                    </i>
                </p>
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
                        <p class="title_df">中港强强合资，26年产业园开发运营专家</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>天安数码城集团，为中港合资企业，是中国领先的创新企业生态圈的开发及运营商</li>
                            <li class="bc_row"><i class="ico_df"></i>拥有26年产业园区开发运营经验，起步深圳，布局全国10座城市，打造15座天安数码城</li>
                            <li class="bc_row"><i class="ico_df"></i>迄今入驻企业达到12000家，全区总产值约3000亿，创造税收约270亿</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img1.jpg"></i>
                        <p class="title_df">科学组团规划，恢弘建筑集群</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>总部楼基地位于重庆天安数码城东侧，包含9栋独栋商务别墅与2栋附加楼总占地面
                                积为35415㎡，建筑计容面积为38587.33㎡</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img.jpg"></i>
                        <p class="title_df">五大独家优势，领衔重庆企业首选战略高地</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>区位优势：雄踞大渡口商圈枢纽，配套成熟完善，并以强大影响能级，辐射重庆全城</li>
                            <li class="bc_row"><i class="ico_df"></i>使用优势：超大实得面积，独享两部电梯，可通天然气，便于企业设立餐厅及休息室</li>
                            <li class="bc_row"><i class="ico_df"></i>交通优势：有轨道2号线和多路公交车，距内环入口仅1公里，交通方便快捷</li>
                            <li class="bc_row"><i class="ico_df"></i>车位优势：地上、地下车位数量充足，可最大程度满足使用需求</li>
                            <li class="bc_row"><i class="ico_df"></i>政策优势：多方面享受政府支持优惠政策</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img1.jpg"></i>
                        <p class="title_df">独墅企业王国，礼献引领时代的企业家</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>天安数码城独栋商别墅，聚焦总部型企业，开启集群化商务平台，营造高端企业圈层</li>
                            <li class="bc_row"><i class="ico_df"></i>作为企业专属的独立天地，在彰显企业形象的背后，是领导者独到的智慧与远见</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img.jpg"></i>
                        <p class="title_df">享御江山视野，内外结合的独栋生态美学</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>最大限度尊重自然，依山就势，将原生地形运用到极致，保证各栋建筑均有江景视野</li>
                            <li class="bc_row"><i class="ico_df"></i>利用地形高差，将公共空间、景观平台与独栋室内空间紧密结合为一体</li>
                            <li class="bc_row"><i class="ico_df"></i>营造多维度立体生态景观体系，让您的企业在更轻松的环境，产生更轻松的成功</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img1.jpg"></i>
                        <p class="title_df">大匠建筑工法，以品质彰显独特气质</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>在外观设计上，用极具时代感的流畅线条与几何图形，描绘充满未来美感的立面造型</li>
                            <li class="bc_row"><i class="ico_df"></i>玻璃幕墙与浅灰色干挂石材的质地相辅相成，高端大气而不失沉稳厚重</li>
                            <li class="bc_row"><i class="ico_df"></i>当代企业的自信与风范，镌刻进每一处细节之中，处处彰显独一无二的气质与尊崇</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="tiaAan_cyBer_park park_box">
                <div class="box_content">
                    <div class="bc_ctn">
                        <i class="bc_case"><img src="img/bc_img.jpg"></i>
                        <p class="title_df">完善成熟服务  高配企业平台</p>
                        <ul class="bc_list">
                            <li class="bc_row"><i class="ico_df"></i>专享科技/人才/金融/创业/上市5大政府政策保障，以及节能环保/创新创业/跨境电商/生物医疗4大产业专项扶持细则</li>
                            <li class="bc_row"><i class="ico_df"></i>园区已进驻13家政府/金融/服务机构，并引入创投咖啡、特色餐饮等，极尽满足企业的多元</li>
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