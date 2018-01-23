<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
use frontend\themes\t00001\AppAsset;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <!--about_banner_wrap-->
        <?php if (!empty($about)){?>
        <div class="about_banner_wrap" style="background-image:url(<?= SiteHelper::getImgSrc($about['banner']) ?>)">
        <a name="aaa" id="aaa" style="visibility: hidden;" >aaa</a>
            <div class="about_banner_contain">
                <i class="contain_case tag_down"><img src="<?= SiteHelper::getImgSrc($about['homepage_left_pic']) ?>" alt=""/></i>
                <i class="contain_line_case tag_right"><img src="<?= $bundle->baseUrl ?>/img/about_line.png" alt=""></i>
                <div class="contain_content tag_up ">
                    <?= $about['company_desc'] ?>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="about_banner_wrap" style="background-image:url(<?= $bundle->baseUrl ?>/img/banenr_about.jpg)">
            <div class="about_banner_contain">
                <i class="contain_case tag_down"><img src="<?= $bundle->baseUrl ?>/img/about_logo.png" alt=""/></i>
                <i class="contain_line_case tag_right"><img src="<?= $bundle->baseUrl ?>/img/about_line.png" alt=""></i>
                <div class="contain_content tag_up ">
                    <p>萝卜科技是一家以人工智能应用为核心的科技创新公司</p>
                    <p>我们致力于将互联网、儿童教育、智能机器人三者深度结合，为小孩打造一个超级伙伴机器人。</p>
                    <p>通过机器人与小孩的深度互动，逐步塑造机器人的人格化，真正实现机器人与小孩子共同成长。</p>
                    <p>用科技改善生活，让小孩不再孤单！</p>
                </div>
            </div>
        </div>
        <?php }?>
        
        <!--about_robot_wrap-->
        <?php if (!empty($change_list[0])){?>
        <div class="about_robot_wrap tag_right" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot1.jpg)">
            <p class="wrap_title"><?= $change_list[0]['name'] ?></p>
            <p class="wrap_title_line"></p>
            <img class="wrap_img" src="<?= SiteHelper::getImgSrc($change_list[0]['cover']) ?>" alt="">
            <div class="wrap_content">
                <?= $change_list[0]['content'] ?>
            </div>
        </div>
        <?php }else{?>
        <div class="about_robot_wrap tag_right" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot1.jpg)">
            <p class="wrap_title">关于“萝卜”</p>
            <p class="wrap_title_line"></p>
            <img class="wrap_img" src="<?= $bundle->baseUrl ?>/img/robot_img1.png" alt="">
            <div class="wrap_content">
                <p class="row_txt">“萝卜”一词取自ROBOT的中文谐音，</p>
                <p class="row_txt">代表企业定位与人工智能和机器人的发展方向。</p>
            </div>
        </div>
		<?php }?>
        <!--about_robot2_wrap-->
        <?php if (!empty($change_list[1])){?>
        <div class="about_robot2_wrap tag_left" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot2.jpg)">
            <img class="wrap_img" src="<?= SiteHelper::getImgSrc($change_list[1]['cover']) ?>" alt="">
            <div class="wrap_content">
                <?= $change_list[1]['content'] ?>
            </div>
        </div>
        <?php }else{?>
        <div class="about_robot2_wrap tag_left" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot2.jpg)">
            <img class="wrap_img" src="<?= $bundle->baseUrl ?>/img/robot_img2.png" alt="">
            <div class="wrap_content">
                <p class="row_txt">从“luobo”中提炼出的“LB”又寓意着“Love Baby”,</p>
                <p class="row_txt">寓意我们所有产品的开发都以儿童的成长和幸福为准则。</p>
            </div>
        </div>
		<?php }?>       
        <!--about_robot3_wrap-->
        <?php if (!empty($change_list[2])){?>
        <div class="about_robot3_wrap tag_up" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot3.jpg)">
            <img class="wrap_img" src="<?= SiteHelper::getImgSrc($change_list[2]['cover']) ?>" alt="">
            <div class="wrap_content">
               <?= $change_list[2]['content'] ?>
            </div>
        </div>
        <?php }else{?>
        <div class="about_robot3_wrap tag_up" style="background-image:url(<?= $bundle->baseUrl ?>/img/about_robot3.jpg)">
            <img class="wrap_img" src="<?= $bundle->baseUrl ?>/img/robot_img3.png" alt="">
            <div class="wrap_content">
                <p class="row_txt">同时，取名“萝卜”，表明我们要做的是能够满足普通家庭</p>
                <p class="row_txt">需求的大众化智能机器人产品，而不做昂贵的试验品。</p>
            </div>
        </div>
        <?php }?>

        <!--about_culture_wrap-->
        <div class="about_culture_wrap tag_up" style="background-image:url(<?= $bundle->baseUrl ?>/img/bg_culture.jpg)">
               <a name="bbb" id="bbb" style="visibility: hidden;" >bbb</a>
            <p class="wrap_title">我们的文化</p>
            <div class="about_culture_contain">
                <!--item_df-->
                <?php if (!empty($about_list)){foreach ($about_list as $key=>$val){?>
                 <div class="item_df">
                    <p class="item_title"><span class="num_df"><?= $key+1 ?></span><?= $val['name'] ?></p>
                    <ul class="item_content">
                        <?= $val['content'] ?>
                    </ul>
                </div>
                <?php }}else{?>
                <div class="item_df">
                    <p class="item_title"><span class="num_df">1</span>责任</p>
                    <ul class="item_content">
                        <li class="item_txt">我们推崇责任心</li>
                        <li class="item_txt">我们坚信，衡量一个人是否优秀，</li>
                        <li class="item_txt">最根本尺度只有一个，</li>
                        <li class="item_txt">那就是是否有责任心。</li>
                    </ul>
                </div>

                <!--item_df-->
                <div class="item_df">
                    <p class="item_title"><span class="num_df">2</span>尊重</p>
                    <ul class="item_content">
                        <li class="item_txt">我们要去互相尊重。</li>
                        <li class="item_txt">任何职位上的从属、</li>
                        <li class="item_txt">内部良性的竞争、不同立场的辩论，</li>
                        <li class="item_txt">均必须基于互动尊重的基本原则。</li>
                    </ul>
                </div>

                <!--item_df-->
                <div class="item_df">
                    <p class="item_title"><span class="num_df">3</span>专注</p>
                    <ul class="item_content">
                        <li class="item_txt">我们专注与客户需求。</li>
                        <li class="item_txt">这是企业存在的唯一价值。</li>
                    </ul>
                </div>
                <?php }?>
            </div>
        </div>

    </div>

<?php $this->beginBlock('test') ?>  
setNavActive('<?php echo CmsNav::TYPE_PAGE_ABOUT?>');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
