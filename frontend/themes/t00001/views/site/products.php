<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <!--banner_wrap-->
        <div class="banner_wrap" style=" background-image:url(<?= SiteHelper::getImgSrc($model->image_main) ?>);  height:920px;" >
            <!--banner_content-->
            <div class="banner_content tag_left">
                <p class="title_df">小萝卜伙伴机器人</p>
                <p class="subTitle_df">陪伴成长·见证快乐</p>
                <p class="btn_bar"><button class="btn_df btn_look_movie" type="button" onclick="window.location.href='<?= $model->src ?>'">观看影片</button> </p>
            </div>

            <p class="banner_describe "><?= $model->description[0] ?></p>
        </div>

        <!--p_bar-->
        <p class="p_bar ">一个童年 · 一个机器人</p>

        <!--wrap_function-->
        <div class="wrap_function tag_up">
            <div class="title_contain tag_down">
                <p class="title_df"><?= $model->description[1] ?></p>
            </div>			
            <ul class="function_list clearfix tag_right">
            <?php if (!empty($products)){foreach ($products as $key=>$val){?>
                            <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn<?= $key+1 ?>.png" /><span class="btn_txt"><?= $val['product_name'] ?></span></a></li>            
			<?php }}else{?>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn1.png" /><span class="btn_txt">陪玩耍</span></a></li>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn2.png" /><span class="btn_txt">陪学习</span></a></li>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn3.png" /><span class="btn_txt">陪聊天</span></a></li>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn4.png" /><span class="btn_txt">智慧成长</span></a></li>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn5.png" /><span class="btn_txt">记忆成长</span></a></li>
                <li><a class="btn_df"><img class="btn_ico" src="<?= $bundle->baseUrl ?>/img/funBtn6.png" /><span class="btn_txt">感情成长</span></a></li>
           <?php }?>
            </ul>

        </div>

        <!--func_fst-->
        <?php if (!empty($products[0])){?>
        <div class="func_fst tag_up" <?php if (!empty($products[0]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[0]['product_cover']).')"' ;}?>>
            <p class="chd_talk tag_left2">小萝卜，跳个舞</p>
            <p class="robot_talk tag_right2">好的~主人</p>

            <!--des_contain-->
            <div class="des_contain tag_left">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[0]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[0]['product_content'] ?>
                </div>

                <ul class="pws_list">
                	<?php if (isset($products[0]['desclist'][0])){?>
                	<li class="pws_list_run"><?= $products[0]['desclist'][0] ?></li>
                	<?php }?>
                    <?php if (isset($products[0]['desclist'][1])){?>
                	<li class="pws_list_bw"><?= $products[0]['desclist'][1] ?></li>
                	<?php }?>
                	<?php if (isset($products[0]['desclist'][2])){?>
                	<li class="pws_list_dance"><?= $products[0]['desclist'][2] ?></li>
                	<?php }?>
                </ul>
            </div>
        </div>
        <?php }else{?>
        <div class="func_fst tag_up">
            <p class="chd_talk tag_left2">小萝卜，跳个舞</p>
            <p class="robot_talk tag_right2">好的~主人</p>

            <!--des_contain-->
            <div class="des_contain tag_left">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>陪玩耍</p>

                <div class="des_contain_wd">
                    <p class="row_df">小萝卜伙伴机器人的动作有8个自由度，灵活智能。</p>
                    <p class="row_df">可以像赛车一样奔跑，可以翩翩起舞，甚至可以跳小苹果。</p>
                </div>

                <ul class="pws_list">
                    <li class="pws_list_run">赛跑</li>
                    <li class="pws_list_bw">编舞</li>
                    <li  class="pws_list_dance">舞蹈</li>
                </ul>
            </div>
        </div>
		<?php }?>
        <!--func_sed-->
        <?php if (!empty($products[1])){?>
        <div class="func_sed tag_up"<?php if (!empty($products[1]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[1]['product_cover']).')"' ;}?>>
            <!--des_contain-->
            <div class="des_contain tag_right">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[1]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[1]['product_content'] ?>
                </div>

                <ul class="pws_list">
                	<?php if (isset($products[1]['desclist'][0])){?>
                	<li class="pStudy_list_zj"><?= $products[1]['desclist'][0] ?></li>
                	<?php }?>
                    <?php if (isset($products[1]['desclist'][1])){?>
                	<li class="pStudy_list_en"><?= $products[1]['desclist'][1] ?></li>
                	<?php }?>
                	<?php if (isset($products[1]['desclist'][2])){?>
                	<li class="pStudy_list_cn"><?= $products[1]['desclist'][2] ?></li>
                	<?php }?>
                </ul>
            </div>
        </div>
        <?php }else{?>
        <div class="func_sed tag_up">
            <!--des_contain-->
            <div class="des_contain tag_right">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>陪学习</p>

                <div class="des_contain_wd">
                    <p class="row_df">小萝卜伙伴机器人实现多维度的早教方式，</p>
                    <p class="row_df">提供进阶式学习内容，满足不同年龄段小孩的启蒙教育</p>
                </div>

                <ul class="pStudy_list">
                    <li class="pStudy_list_zj">早教</li>
                    <li class="pStudy_list_en">英语</li>
                    <li  class="pStudy_list_cn">国学</li>
                </ul>
            </div>
        </div>
        <?php }?>

        <!--func_thr-->
        <?php if (!empty($products[2])){?>
        <div class="func_thr tag_up" <?php if (!empty($products[2]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[2]['product_cover']).')"' ;}?>>>
            <p class="chd_talk tag_left2">小萝卜，你会做什么？</p>
            <p class="robot_talk tag_right2">我上天入地无所不能~</p>

            <!--des_contain-->
            <div class="des_contain tag_left">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[2]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[2]['product_content'] ?>
                </div>

                <ul class="pws_list">
                	<?php if (isset($products[2]['desclist'][0])){?>
                	<li class="pChat_list_news"><?= $products[2]['desclist'][0] ?></li>
                	<?php }?>
                    <?php if (isset($products[2]['desclist'][1])){?>
                	<li class="pChat_list_live"><?= $products[2]['desclist'][1] ?></li>
                	<?php }?>
                	<?php if (isset($products[2]['desclist'][2])){?>
                	<li class="pChat_list_bk"><?= $products[2]['desclist'][2] ?></li>
                	<?php }?>
                </ul>
            </div>
        </div>
		<?php }else{?>
		<div class="func_thr tag_up">
            <p class="chd_talk tag_left2">小萝卜，你会做什么？</p>
            <p class="robot_talk tag_right2">我上天入地无所不能~</p>

            <!--des_contain-->
            <div class="des_contain tag_left">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>陪聊天</p>

                <div class="des_contain_wd">
                    <p class="row_df">小萝卜伙伴机器人具备准确的语音识别，语义理解能力，</p>
                    <p class="row_df"> 可以和小朋友进行流畅的自然语言交互。内置的儿童常用</p>
                    <p class="row_df">英语词库，即使英语也难不倒他。</p>
                </div>

                <ul class="pChat_list">
                    <li class="pChat_list_news">新闻</li>
                    <li class="pChat_list_live">生活</li>
                    <li  class="pChat_list_bk">百科</li>
                </ul>
            </div>
        </div>
		<?php }?>
        <!--func_fur-->
        <?php if (!empty($products[3])){?>
        <div class="func_fur tag_up"<?php if (!empty($products[3]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[3]['product_cover']).')"' ;}?>>>

            <!--des_contain-->
            <div class="des_contain tag_right">
                 <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[3]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[3]['product_content'] ?>
                </div>

                <ul class="pws_list">
                	<?php if (isset($products[3]['desclist'][0])){?>
                	<li class="growUp_list_function"><?= $products[3]['desclist'][0] ?></li>
                	<?php }?>
                    <?php if (isset($products[3]['desclist'][1])){?>
                	<li class="growUp_list_source"><?= $products[3]['desclist'][1] ?></li>
                	<?php }?>
                	<?php if (isset($products[3]['desclist'][2])){?>
                	<li class="growUp_list_content"><?= $products[3]['desclist'][2] ?></li>
                	<?php }?>
                </ul>
            </div>
        </div>
		<?php }else{?>
		 <div class="func_fur tag_up">

            <!--des_contain-->
            <div class="des_contain tag_right">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>智慧成长</p>

                <div class="des_contain_wd">
                    <p class="row_df">通过云平台，持续更新小萝卜伙伴机器人的服务内容，</p>
                    <p class="row_df">可以学习的更多，可以玩得更好~</p>
                </div>

                <ul class="growUp_list">
                    <li class="growUp_list_function">功能</li>
                    <li class="growUp_list_source">资源</li>
                    <li  class="growUp_list_content">内容</li>
                </ul>
            </div>
        </div>
		<?php }?>
        <!--func_fiv-->
        <?php if (!empty($products[4])){?>
        <div class="func_fiv tag_up" <?php if (!empty($products[4]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[4]['product_cover']).')"' ;}?>>>
            <!--des_contain-->
            <div class="des_contain tag_left">
                 <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[4]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[4]['product_content'] ?>
                </div>

                <ul class="pws_list">
                	<?php if (isset($products[4]['desclist'][0])){?>
                	<li class="memoryGrow_list_record"><?= $products[4]['desclist'][0] ?></li>
                	<?php }?>
                    <?php if (isset($products[4]['desclist'][1])){?>
                	<li class="pws_list_jz"><?= $products[4]['desclist'][1] ?></li>
                	<?php }?>
                	<?php if (isset($products[4]['desclist'][2])){?>
                	<li class="pws_list_companion"><?= $products[4]['desclist'][2] ?></li>
                	<?php }?>
                </ul>
            </div>
        </div>
		<?php }else{?>
		<div class="func_fiv tag_up">
            <!--des_contain-->
            <div class="des_contain tag_left">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>记忆成长</p>

                <div class="des_contain_wd">
                    <p class="row_df">小萝卜伙伴机器人可以记录小孩的语言资料，图像资料，</p>
                    <p class="row_df">视频资料，是童年的记录着，成长等等见证者。</p>
                </div>

                <ul class="memoryGrow_list">
                    <li class="memoryGrow_list_record">记录</li>
                    <li class="pws_list_jz">见证</li>
                    <li  class="pws_list_companion">陪伴</li>
                </ul>
            </div>
        </div>
		<?php }?>
        <!--func_six-->
        <?php if (!empty($products[5])){?>
        <div class="func_six tag_up" <?php if (!empty($products[5]['product_cover'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($products[5]['product_cover']).')"' ;}?>>>

            <!--des_contain-->
            <div class="des_contain tag_right">
                 <p class="des_contain_title"><i class="des_contain_titleIco"></i><?= $products[5]['product_name'] ?></p>

                <div class="des_contain_wd">
                    <?= $products[5]['product_content'] ?>
                </div>				
                <div class="des_contain_wd">
                <?php if (!empty($products[5]['desclist'])){foreach ($products[5]['desclist'] as $val){?>
                    <p class="row_df"><?= $val ?></p>
                <?php }}?>
                </div>
            </div>
        </div>
        <?php }else{?>
        <div class="func_six tag_up">

            <!--des_contain-->
            <div class="des_contain tag_right">
                <p class="des_contain_title"><i class="des_contain_titleIco"></i>感情成长</p>

                <div class="des_contain_wd">
                    <p class="row_df">小萝卜伙伴机器人可以了解分析宝贝的行为习惯，逐渐生产</p>
                    <p class="row_df">应激性的反馈，培养出自己的人格。成为宝宝的知心朋友</p>
                </div>

            </div>
        </div>
        <?php }?>
    </div>
<?php $this->beginBlock('test') ?>  
setNavActive('<?php echo $model->id?>');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
