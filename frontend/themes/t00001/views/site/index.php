<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
use frontend\themes\t00001\AppAsset;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
		<!-- home_banner_slider-->
        <div class="home_banner_slider news_banner_slider" >
        <?php if(!empty($banners['homepage']['images'])){foreach ($banners['homepage']['images'] as $image){?>
            <a class="slide" href="<?= $image['link'] ?>"><img src="<?= SiteHelper::getImgSrc($image['image'])?>" alt=""/></a>
         <?php }} ?>    
        </div>
		<div class="ho_theme_wrap">
            <img class="theme_logo tag_fade" src="<?= $bundle->baseUrl ?>/img/ho_logo.png" alt=""/>
            <p class="theme_title tag_up">让每个家因爱相连，以机器人相连</p>
        </div>

        <!--ho_pro_wrap-->
        <div class="ho_pro_wrap">
        	<?php if (isset($pro_pics['images'][0])){?>
        	 <a class="pro_item item_lt tag_left" href="<?= $pro_pics['images'][0]['link'] ?>">
                <img src="<?= SiteHelper::getImgSrc($pro_pics['images'][0]['image']) ?>" alt="" />
                <span class="ho_pro_txt ho_pro_left"><?= $pro_pics['images'][0]['summary'] ?></span>
            </a>
        	<?php }else{?>
            <a class="pro_item item_lt tag_left" href="#">
                <img src="<?= $bundle->baseUrl ?>/img/pro1.jpg" alt="" />
            </a>
            <?php }?>
            <?php if (isset($pro_pics['images'][1])){?>
        	 <a class="pro_item item_lt tag_right" href="<?= $pro_pics['images'][1]['link'] ?>">
                <img src="<?= SiteHelper::getImgSrc($pro_pics['images'][1]['image']) ?>" alt="" />
                <span class="ho_pro_txt ho_pro_right"><?= $pro_pics['images'][1]['summary'] ?></span>
            </a>
        	<?php }else{?>
            <a class="pro_item item_lt tag_right" href="#">
                <img src="<?= $bundle->baseUrl ?>/img/pro1.jpg" alt="" />
            </a>
            <?php }?>
        </div>

        <!--ho_subBanner_wrap-->
        <div class="ho_subBanner_wrap" style="background-image:url(<?= $bundle->baseUrl ?>/img/sub_intro.jpg)">
            <div class="wrap_title_case ">
                <p class="wrap_title tag_down">小萝卜机器人</p>
                <p class="wrap_subTitle tag_down2">让人工智能走进每个家庭</p>
            </div>
        </div>

        <ul class="effect_slide_bar ">
            <li class="effect_item">
                <!--primary_img 默认-->
                <img class="primary_img lazy"  data-original="<?= $bundle->baseUrl ?>/img/thr_primary.jpg" alt=""/>
                <img class="effect_img lazy"  data-original="<?= $bundle->baseUrl ?>/img/thr_slide1.jpg"  alt=""/>
            </li>
            <li class="effect_item">
                <img class="primary_img lazy"  data-original="<?= $bundle->baseUrl ?>/img/thr_primary2.jpg" alt=""/>
                <img class="effect_img lazy" data-original="<?= $bundle->baseUrl ?>/img/thr_slide2.jpg" alt=""/>
            </li>
            <li class="effect_item">
                <img class="primary_img lazy"  data-original="<?= $bundle->baseUrl ?>/img/thr_primary3.jpg" alt=""/>
                <img class="effect_img lazy" data-original="<?= $bundle->baseUrl ?>/img/thr_slide3.jpg" alt=""/>
            </li>
        </ul>
    </div>

<?php $this->beginBlock('test') ?> 
 $(document).ready(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn",
            threshold : 180
        });
    });
setNavActive('<?php echo CmsNav::TYPE_HOMEPAGE?>');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
