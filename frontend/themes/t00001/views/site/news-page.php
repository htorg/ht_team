<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <div class="news_des_banner">
            <div class="des_content">
                <p class="banner_title">新闻中心</p>
                <p class="banner_subTitle">最新最热的业内新闻</p>
            </div>
        </div>

        <p class="page_control_bar noneSelect">
       			 <?php if( !empty($preNews) ){ ?>
                <span class="pre_page control_case ht_nowrap"><a class="btn_df" href="<?= Url::to(['site/news','id' => $preNews['id'] ]) ?>">上一篇：<?= $preNews['name'] ?></a></span>
                <?php } ?>
                <?php if( !empty($sufNews) ){ ?>
                <span class="next_page control_case ht_nowrap"><a class="btn_df" href="<?= Url::to(['site/news','id' => $sufNews['id']]) ?>" >下一篇：<?= $sufNews['name'] ?></a></span>
                <?php } ?>
        </p>

        <div class="news_des_content">
            <p class="title_df"><?= $news['name'] ?></p>
            <p class="subTitle_df"><?= date('Y-m-d', $news['created_at']) ?></p>

            <div class="text_box">
               		  <?= $news['content'] ?>
            </div>
        </div>

        <p class="page_control_bar noneSelect">
            	<?php if( !empty($preNews) ){ ?>
                <span class="pre_page control_case ht_nowrap"><a class="btn_df" href="<?= Url::to(['site/news','id' => $preNews['id'] ]) ?>">上一篇：<?= $preNews['name'] ?></a></span>
                <?php } ?>
                <?php if( !empty($sufNews) ){ ?>
                <span class="next_page control_case ht_nowrap"><a class="btn_df" href="<?= Url::to(['site/news','id' => $sufNews['id']]) ?>" >下一篇：<?= $sufNews['name'] ?></a></span>
                <?php } ?>
        </p>

    </div>
<?php $this->beginBlock('test') ?>  
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
