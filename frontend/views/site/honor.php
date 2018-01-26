<?php

/* @var $this yii\web\View */

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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df" href="<?= Url::to(['site/index'])?>">走进天安</a> > <a class="btn_df">资质荣誉</a></p></div>

    <div class="honor_wrap">
        <div class="honor_con ">
            <p class="con_title"><span class="cr1"><?= count($model->honor_country)?></span>项国家级、<span class="cr1"><?= count($model->honor_provice)?></span>项省级资质评定</p>
            <!--national_level-->
            <div class="national_level honor_item clearfix">
                <img class="img_df" src="img/honor_national.jpg" alt=""/>
                <i style="display: inline-block ;width:0;height:100%; ;vertical-align: middle"></i>
                <i class="des_df">
                    <span class="des_title"><em class="title_1">国家级</em><em class="title_interval"></em><em class="title_2">national level</em></span>
                    <span class="honor_list">
                        <?php if (!empty($model->honor_country)){foreach ($model->honor_country as $county){?>
                            <em class="li_df"><?= $county ?></em>
                            <?php }}?>
                        </span>
                    <a class="btn_df btn_look" href="<?= $model->link_country?>">查看新闻</a>
                </i>
            </div>

            <div class="provincial_level honor_item">
                <img class="img_df" src="img/provincial.jpg" alt=""/>
                <i class="des_df">
                    <span class="des_title"><em class="title_1">省级</em><em class="title_interval"></em><em class="title_2">provincial level</em></span>
                    <span class="honor_list">
                            <?php if (!empty($model->honor_provice)){foreach ($model->honor_provice as $provice){?>
                                <em class="li_df"><?= $provice ?></em>
                            <?php }}?>
                        </span>
                        </span>
                    <a class="btn_df btn_look" href="<?= $model->link_provice?>">查看新闻</a>
                </i>
            </div>
        </div>
    </div>

</div>
<?php $this->beginBlock('test') ?>
    setNav('about');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>