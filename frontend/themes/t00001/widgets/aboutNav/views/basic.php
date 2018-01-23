<?php
use common\helpers\SiteHelper;
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: teavoid
 * Date: 17/7/1
 * Time: 19:49
 */
	
?>
		<div class="sub_banner">
            <div class="describe_contain">
                <p class="title_df"><?= isset($about['top_banner_name'])?$about['top_banner_name']:'关于我们' ?></p>
                <p class="sub_title_df"><?= isset($about['top_banner_desc'])?$about['top_banner_desc']:'打造健康平台 助力慈善事业' ?></p>
            </div>
        </div>

        <!--about_tab_bar-->
        <div class="about_tab_bar">
            <p class="about_tab_contain">
                <em class="about_tab_item <?php if ($type==0){ echo 'about_tab_on';}?>"><a class="txt_df " href="<?= Url::to(['site/about']) ?>">公司简介</a></em>
                <em class="about_tab_item <?php if ($type==1){ echo 'about_tab_on';}?>"><a class="txt_df"  href="<?= Url::to(['site/about-funture','type'=>1]) ?>">医点未来</a></em>
                <em class="about_tab_item <?php if ($type==2){ echo 'about_tab_on';}?>"><a class="txt_df" href="<?= Url::to(['site/about-organ','type'=>2]) ?>">组织架构</a></em>
                <em class="about_tab_item <?php if ($type==3){ echo 'about_tab_on';}?>"><a class="txt_df" href="<?= Url::to(['site/about-partner','type'=>3]) ?>">合作伙伴</a></em>
            </p>
        </div>