<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use common\helpers\DataHelper;
use frontend\widgets\NewLinkPager;
$bundle=AppAsset::register($this);
?>
<div class="main_df">
    <!--banner_wrap-->
    <div class="banner_wrap">
        <img class="b_img" src="img/process.jpg" alt="">
        <div class="banner_des">
            <p class="title_df ht_nowrap"></p>
            <p class="subTitle_df ht_nowrap"></p>
        </div>
    </div>

    <!--crumbs_wrap-->
    <div class="crumbs_wrap">
        <p class="crumbs_bar">
            <a class="btn_df">运营服务</a> > <a class="btn_df">全部新闻</a>
        </p>
    </div>

    <div class="news_wrap">
        <div class="news_con clearfix">
            <!--lt_con-->
            <div class="lt_con">
                <!--news-article-box-->
                <div class="news-article-box">
                    <div class="news-article-header">
                        <p class="news-title"><?= $news->name ?></p>
                        <p class="news-title-time"><span class="list-counts">时间：<?= date('Y-m-d',$news->updated_at)?></span>  <span>阅读量：<?= $news->view_count ?></span></p>
                    </div>

                    <div class="text_box ">
                     <?= $news->content ?>
                    </div>
                    <?php if (is_object($sufNews)){?>
                    <dl class="detail_recommend" onclick="window.location.href='<?= Url::to(['site/new','id'=>$sufNews->id])?>'">
                        <dt><img src="<?= DataHelper::getImgSrc($sufNews->image_main)?>" alt=""></dt>
                        <dd >
                            <p class="dr_title"><?= $sufNews->summary?></p>
                            <p class="dr_date"><?= date('Y-m-d',$sufNews->updated_at)?></p>
                        </dd>

                    </dl>
                    <?php }?>
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