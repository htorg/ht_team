<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\helpers\DataHelper;
use yii\helpers\Url;
?>
<div class="main_df">
    <!--banner_wrap-->
    <?php if (is_object($model)){?>
        <?= \frontend\widgets\Banner::widget(['banner'=>$model->banner,'banner_title'=>$model->banner_title,'banner_subtitle'=>$model->banner_subtitle]) ?>
    <?php }?>

    <div class="contact_bar_wrap">
        <div class="contact_bar_con clearfix">
            <dl class="item_df">
                <dt class="item_ico" style="background-image:url(/img/ico_phone.png)"></dt>
                <dd class="item_describe">
                    <p class="des_title"><?= $model->telephone?></p>
                    <p class="des_txt">天安数码城丨重庆    物业客户服务热线</p>
                </dd>
            </dl>

            <dl class="item_df">
                <dt class="item_ico" style="background-image:url(/img/ico_tel.png)"></dt>
                <dd class="item_describe">
                    <p class="des_title"><?= $model->phone?></p>
                    <p class="des_txt">天安数码城丨重庆    物业客户服务热线</p>
                </dd>
            </dl>

            <dl class="item_df">
                <dt class="item_ico" style="background-image:url(/img/ico_wechat.png)"></dt>
                <dd class="item_describe">
                    <p class="des_title">天安数码城官方微信</p>
                    <!--<p class="des_txt"></p>-->
                </dd>
            </dl>
        </div>
    </div>

    <!--crumbs_wrap-->
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">运营服务</a> > <a class="btn_df">物业服务</a></p></div>

    <div class="sv_about_wrap">
        <div class="about_con">
            <p class="title_df">关于天安数码城</p>
            <div class="about_detail clearfix">
                <i class="detail_img"><img src="<?= empty($model->map_img)?$bundle->baseUrl.'/img/about1.jpg':DataHelper::getImgSrc($model->map_img)?>" alt=""/></i>
                <div class="detail_txt">
                    <?php if (empty($model->contact_desc)){?>
                    <p>作为天安数码城集团核心成员企业，深圳天安智慧园区运营有限公司（原名深圳天安物业管理有限公司）成立于1994年，由天安中国投资有限公司（HK0028）与深业泰然（集团）股份有限公司合资组建，是一家以科技产业园区运营管理为核心业务的首批物业管理一级资质企业集团。公司肩负“运营智慧园区，成就客户卓越”的企业使命，倡导“简单、阳光、专业、创新”的企业文化，致力于成为“中国智慧园区运营服务领先者”。</p>
                    <p>公司总部位于深圳，管理服务足迹覆盖到深圳、广州、东莞、佛山、上海、天津、重庆、常州、江阴、青岛、苏州、昆山等区域性中心城市和经济发展热点地区，管理项目涵盖到城市产业园区、高档写字楼、工业园区、商业物业、高尚住宅等各类综合性物业，管理面积超过1200万平方米，已陆续为超过10000家创新成长型企业提供一流的园区运营服务。 　　近年来，在物业行业转型升级的大变革下，天安实施战略转型，潜心打造“智慧园区管理应用系统”和“智慧园区运营服务体系”两大核心专长，聚焦客户需求，整合政商资源，引入新技术，跨界新业态，创新商业模式，提升服务层次，实现从粗放型传统服务业向集约型现代服务业的转变，意在通过独特的智慧园区运营服务模式创建引领行业变革。</p>
                    <p>伴随着新兴产业的崛起，天安正尝试于“物流园区”、“养老社区”等新兴服务运营领域进行探索与实践，进一步打开企业成长新空间，以创新探索、独树一帜的专业风范持续领跑业界。       </p>
                    <p>2011年10月，天安运营将自己的足迹踏上山城重庆这片热土，为重庆天安数码城的所有企业、商家和客户，提供专业性、一体化、增值型的管理、运营与服务。雄关漫道真如铁，而今迈步从头越。天安运营重庆分公司将以三大质量管理体系为基础，以市优大厦考评标准为起点，全力打造“5A级智能产业园区”和“5星级服务运营体系”，想客户所想、想客户未想，努力让每一位天安数码城业主感受到无与伦比的归属感、自豪感和尊崇感……</p>
                    <?php }else{ echo $model->contact_desc;}?>
                </div>

            </div>
        </div>
    </div>

    <!--sv_system_wrap-->
    <div class="sv_system_wrap">
        <div class="system_con">
            <p class="title_df">三大服务体系十大服务平台</p>
            <p class="subTitle_df">给你500强的服务配置</p>
            <ul class="system_list clearfix">
                <li class="system_item">
                    <p class="title_df"><?= empty($infos->platform_config1[0])?'高成长企业服务体系':$infos->platform_config1[0]; ?></p>
                    <p class="txt_df"><?= empty($infos->platform_config1[1])?'针对成长型企业，配置金融、政策、技术、人力、信息等各种服务平台，助理成长型企业的腾飞。':$infos->platform_config1[1]; ?></p>
                    <i class="ht_opacity"></i>
                </li>
                <li class="system_item">
                    <p class="title_df"><?= empty($infos->platform_config2[0])?'城市化配套服务体系':$infos->platform_config2[0]; ?></p>
                    <p class="txt_df"><?= empty($infos->platform_config2[1])?'完善的配套服务突显城市产业综合体的资源优势，打造办公与生活一体化的全新体验模式，加速园区物业高速升值。':$infos->platform_config2[1]; ?></p>
                    <i class="ht_opacity"></i>
                </li>
                <li class="system_item">
                    <p class="title_df"><?= empty($infos->platform_config3[0])?'数字化园区服务体系':$infos->platform_config3[0]; ?></p>
                    <p class="txt_df"><?= empty($infos->platform_config3[1])?'打造“数字化园区”，以一流的IT配套服务领先业界，数字化智能平台将其他平台的功能全部并联融合，实现一站式服务网络解决体系，方便快捷，契合时代发展脉搏。':$infos->platform_config3[1]; ?></p>
                    <i class="ht_opacity"></i>
                </li>
            </ul>

            <div class="contain_pt">
                <div class="box_pt clearfix">
                    <i class="pt_img"><img  src="<?= empty($infos->platform_image)?$bundle->baseUrl.'/img/pt.jpg':DataHelper::getImgSrc($infos->platform_image)?>" alt=""></i>
                    <div class="pt_rt">
                        <p class="pt_title">十大服务平台</p>
                        <div class="pt_text">
                            <p><i class="pt_item">投资融资服务平台</i> / <i class="pt_item"> 科技研发服务平台</i> / <i class="pt_item">企业交流平台</i></p>
                            <p><i class="pt_item">数字化智能平台</i> / <i class="pt_item">人力资源平台</i> / <i class="pt_item">政策优惠平台</i></p>
                            <p><i class="pt_item">物业经营平台</i> / <i class="pt_item">企业管家平台</i> / <i class="pt_item">公共配套平台</i> / <i class="pt_item">商业配套平台</i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--sv_slider_wrap-->
    <!--轮播待完善-->
<?php if (!empty($infos->banner_files) ){?>
    <div class="sv_slider_wrap">
        <div class="big_slider_case">
            <ul class="big_slider">
              <?php foreach ($infos->banner_files as $banner){?>
                <li class="slider"><img class="sv_img" src="<?= DataHelper::getImgSrc($banner->src)?>" alt=""></li>
              <?php }?>
            </ul>
        </div>


        <div class="sv_slider_case">
            <div class="sv_slider_contain">
                <ul class="sv_slider">
                 <?php foreach ($infos->banner_files as $banner){?>
                    <li class="slide"><a class="img_case"><img src="<?= DataHelper::getImgSrc($banner->src)?>" /></a></li>
                 <?php }?>
                </ul>
                <p class="sv_control"><i class="sv_pre btn_control"></i><a class="sv_next btn_control"></a></p>
            </div>
        </div>

    </div>
    <?php }?>

    <div class="sv_matter_wrap">
        <div class="matter_con">
            <p class="title_df">物业服务事项</p>
            <p class="subTitle_df"><?= empty($articles->description)?'我们为业主提供优质的服务和家的待遇，让您宾至如归。':$articles->description ?></p>
            <ul class="matter_list clearfix">
                <?php if (empty($articles->articles)){?>
                <li>
                    <dl class="matter_item">
                        <dt class="ico_df" style="background-image:url(/img/matter1.png)"></dt>
                        <dd class="txt_df">
                            <p class="txt_title">云谷一期业主入伙手续办理流程</p>
                            <div class="txt_sub">
                                入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续
                            </div>
                            <p class="ht_opacity"></p>
                        </dd>
                        <dd class="btn_bar">
                            <a class="btn_df btn_more">了解更多</a>
                        </dd>
                    </dl>
                </li>

                <li>
                    <dl class="matter_item">
                        <dt class="ico_df" style="background-image:url(/img/matter2.png)"></dt>
                        <dd class="txt_df">
                            <p class="txt_title">业主（用户）搬家须知</p>
                            <div class="txt_sub">
                                入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续
                            </div>
                            <p class="ht_opacity"></p>
                        </dd>
                        <dd class="btn_bar">
                            <a class="btn_df btn_more">了解更多</a>
                        </dd>
                    </dl>
                </li>

                <li>
                    <dl class="matter_item">
                        <dt class="ico_df" style="background-image:url(/img/matter4.png)"></dt>
                        <dd class="txt_df">
                            <p class="txt_title">物业出租须知</p>
                            <div class="txt_sub">
                                入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续
                            </div>
                            <p class="ht_opacity"></p>
                        </dd>
                        <dd class="btn_bar">
                            <a class="btn_df btn_more">了解更多</a>
                        </dd>
                    </dl>
                </li>

                <li>
                    <dl class="matter_item">
                        <dt class="ico_df" style="background-image:url(/img/matter4.png)"></dt>
                        <dd class="txt_df">
                            <p class="txt_title">业主装修手续办理流程</p>
                            <div class="txt_sub">
                                入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续办理流程演示文字入伙手续
                            </div>
                            <p class="ht_opacity"></p>
                        </dd>
                        <dd class="btn_bar">
                            <a class="btn_df btn_more">了解更多</a>
                        </dd>
                    </dl>
                </li>
                <?php }else{foreach ($articles->articles as $val){?>
                    <li>
                        <dl class="matter_item">
                            <dt class="ico_df" style="background-image:url(<?= DataHelper::getImgSrc($val->image_main)?>)"></dt>
                            <dd class="txt_df">
                                <p class="txt_title"><?= $val->name ?></p>
                                <div class="txt_sub">
                                    <?= $val['content'] ?>
                                </div>
                                <p class="ht_opacity"></p>
                            </dd>
                            <dd class="btn_bar">
                                <a class="btn_df btn_more" href="<?= Url::to(['site/new','id'=>$val->id])?>">了解更多</a>
                            </dd>
                        </dl>
                    </li>
                <?php }}?>
            </ul>
        </div>
    </div>


</div>
<?php $this->beginBlock('test') ?>
    setNav('operate');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>