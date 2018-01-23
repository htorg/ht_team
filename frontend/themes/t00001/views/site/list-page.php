<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
use frontend\themes\t00001\AppAsset;
use common\widgets\NewLinkPager1;
use yii\base\Widget;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <!--banner_wrap-->
        <div class="news_banner_slider" >
        <?php if (!empty($banners['images'])){foreach ($banners['images'] as $image){?>
         	<a class="slide" href="<?= $image['link'] ?>"><img src="<?= SiteHelper::getImgSrc($image['image']) ?>" alt=""/></a>
        <?php }}else{ ?>        
            <a class="slide"><img src="<?= $bundle->baseUrl ?>/img/news_banner.jpg" alt=""/></a>
            <a class="slide"><img src="<?= $bundle->baseUrl ?>/img/news_banner.jpg"  alt=""/></a>
            <a class="slide"><img src="<?= $bundle->baseUrl ?>/img/news_banner.jpg"  alt=""/></a>
        <?php }?>
        </div>
        <div class="news_content">
            <!--news_wrap-->
            <div class="news_wrap">

                <p class="title_df">
                    <span class="title_en">NEWS</span>
                    <span class="title_cn"><i class="cr_df">萝卜</i>动态</span>
                </p>

                <!--news_contain-->
                <div class="news_contain">
                    <!--tab-->
                    <ul class="news_tab clearfix">
                    	<?php if (!empty($datalist)){foreach ($datalist as $val){ if (!empty($val['dateline'])){?>
                        <li><a class="tab_item btn_df noneSelect <?php if (isset($_GET['time'])&&$_GET['time']==$val['dateline']){ echo "tab_on";} ?>" href="<?= Url::to(['site/list','time'=>$val['dateline']]) ?>"><?= $val['dateline'] ?></a></li>
                        <?php }}}?>
                    </ul>

                    <!--news_list-->
                    <ul class="news_list">
                    	<?php if (!empty($list)){foreach ($list as $v){?>
                        <li class="news_row tag_up">
                            <a class="news_item" href="<?= Url::to(['site/news','id' => $v['id']]) ?>">
                                <img class="news_img lazy" data-original="<?= SiteHelper::getImgSrc($v['image_main']) ?>" alt=""/>
                                <div class="item_des">
                                    <p class="item_title"><?= $v['name'] ?></p>
                                    <p class="item_time"><?= date('Y-m-d',$v['updated_at']) ?></p>
                                    <p class="item_txt"><?= $v['summary'] ?>
                                    </p>
                                </div>
                            </a>
                        </li>
                        <?php }}?>
                    </ul>

                    <?= NewLinkPager1::widget(['pagination'=>$pagination])?>
                </div>
            </div>
        </div>
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
