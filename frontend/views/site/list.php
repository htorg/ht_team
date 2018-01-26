<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\helpers\DataHelper;
use frontend\widgets\NewLinkPager;
$bundle=AppAsset::register($this);
var_dump($bundle->baseUrl);
?>
<div class="main_df">
    <!--banner_wrap-->
    <?php if (is_object($model)){?>
        <?= \frontend\widgets\Banner::widget(['banner'=>$model->banner,'banner_title'=>$model->banner_title,'banner_subtitle'=>$model->banner_subtitle]) ?>
    <?php }?>

    <!--crumbs_wrap-->
    <div class="crumbs_wrap classily_wrap">
        <div class="crumbs_contain">
            <p class="crumbs_bar">
                <a class="btn_df">运营服务</a> > <a class="btn_df">全部新闻</a>
            </p>
            <p class="news_tab_bar">
                <!--news_tab_on-->
                <a class="news_tab btn_df <?php if (!isset($_GET['id'])){ echo 'news_tab_on';} ?>" href="<?= Url::to(['site/list'])?>">全部新闻<em class="line_df"></em></a>
                <?php if (!empty($category_list)){foreach ($category_list as $cate){?>
                <a class="news_tab btn_df <?php if(isset($_GET['id'])&&$_GET['id']==$cate['id']){echo 'news_tab_on';}?>" href="<?= Url::to(['site/list','id'=>$cate['id']])?>"><?= $cate['name']?><em class="line_df"></em></a>
                <?php }}?>
            </p>
        </div>

    </div>

    <div class="news_wrap">
        <div class="news_con clearfix">
            <!--lt_con-->
            <div class="lt_con">
                <ul class="home-news-list  clearfix ho_news_box">
                    <?php if (!empty($list)){foreach ($list as $val){?>
                    <li class="home-news-row">
                        <a class="row-case home-news-bg" href="<?= Url::to(['site/new','id'=>$val['id']])?>">
                            <div class="row-time"><p class="row-time-dayM"><?= Date('m-d',$val['updated_at']) ?></p><p class="row-time-year"><?= Date('Y',$val['updated_at']) ?></p></div>
                            <p class="home-news-line"></p>
                            <p class="row-title"><?= $val['name'] ?></p>
                            <p class="row-describe"><?= $val['summary'] ?></p>
                        </a>
                    </li>
                    <?php }}?>
                </ul>
                <div class="page_wrap">
                    <?= NewLinkPager::widget(['pagination' => $pagination]) ?>
                </div>
            </div>
            <!--rt_con-->
            <div class="rt_con">
                <div class="news_about">
                    <p class="title_df">相关新闻</p>
                    <?php if (!empty($recommon_list)){?>
                    <a href="<?= Url::to(['site/new','id'=>$recommon_list[0]->id])?>">
                        <dl class="news_recommend">
                            <dt><img src="<?= DataHelper::getImgSrc($recommon_list[0]->image_main)?>" alt=""></dt>
                            <dd>
                                <p class="rd_title"><?= $recommon_list[0]->name ?></p>
                                <p class="rl_date"><?= Date('Y-m-d',$recommon_list[0]->updated_at) ?></p>
                            </dd>
                        </dl>
                    </a>
                    <?php }?>
                    <ul class="aside_news_list">
                        <?php foreach ($recommon_list as $key=>$re){if ($key>0){?>
                        <li><a class="aside_item ht_nowrap" href="<?= Url::to(['site/new','id'=>$re->id])?>">【<?= $re['category']->name?>】 <?= $re->name?></a></li>
                        <?php }}?>
                    </ul>
                </div>

                <!--con_rt-->
                <div class="con_rt ho_enterprises ">
                    <div class="advertise_slider">
                        <div class="slide">
                            <img src="img/advertise1.jpg">
                            <a class="btn_look btn_df" href="<?= Url::to(['site/settled'])?>">查看详情</a>
                        </div>
                        <div class="slide">
                            <img src="img/advertise2.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $this->beginBlock('test') ?>
    setNav('news');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>