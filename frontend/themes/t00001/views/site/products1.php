<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <!--banner_wrap-->
        <div class="banner_wrap" style=" background-image:url(<?php if (!empty($model->image_main)){ echo SiteHelper::getImgSrc($model->image_main);}else{
        	echo $bundle->baseUrl.'/img/LB2.png';
        }?>);  height:960px;">
            <!--banner_content-->
            <div class="LB2_banner_content noneSelect tag_left">
                <p class="title_df">大家好
                    我是小萝卜~
                </p>
                <p class="subTitle_df"><?php if (!empty($model->description[0])){echo $model->description[0];}else{ echo '红点大奖设计师操刀|最强语音技术加持';}?></p>
                <p class="btn_bar"><button class="btn_df LB02_look_movie" type="button" onclick="window.location.href='<?= $model->src ?>'">观看影片</button> </p>
            </div>
        </div>

        <!--interval_wrap-->
        <div class="interval_wrap">
            <div class="interval_contain tag_left">
            <?php if (!empty($model->description[1] )){ ?>
            	<p class="interval_title"><?= $model->description[1] ?></p>           
           <?php  }else{?>
                  <p class="interval_title">专业性、有趣性、实用性融合与一身，让机器人成为家庭的一份子</p>
                  <p class="interval_title">依托强大的云计算与智能语音交互技术，小萝卜将成为家庭全能小萌宠！</p>
            <?php }?>
            </div>
        </div>

        <!--wrap_thr-->
        <div class="wrap_thr clearfix tag_right ">
        <?php if (!empty($products)){foreach ($products as $key=>$val){if ($key<3){?>       
            <dl class="wrap_thr_item<?= $key+1 ?> ">
                <dt>
                    <img src="<?= SiteHelper::getImgSrc($val['product_cover']) ?>" alt=""/>
                    <!--mask-->
                    <img class="mask_img" src="<?= SiteHelper::getImgSrc($val['product_mask'])?>" alt=""/>
                </dt>
                <dd>
                    <p class="wrap_thr_txt"><?= $val['product_name'] ?></p>
                </dd>
            </dl>
		<?php }}}else{?>
         <dl class="wrap_thr_item1 ">
                <dt>
                    <img src="<?= $bundle->baseUrl?>/img/thr1.jpg" alt=""/>
                    <!--mask-->
                    <img class="mask_img" src="<?= $bundle->baseUrl?>/img/thr_mask1.png " alt=""/>
                </dt>
                <dd>
                    <p class="wrap_thr_txt">智力游戏</p>
                </dd>
            </dl>

            <dl class="wrap_thr_item2 ">
                <dt>
                    <img src="<?= $bundle->baseUrl?>/img/thr2.jpg" alt=""/>
                    <!--mask-->
                    <img class="mask_img" src="<?= $bundle->baseUrl?>/img/thr_mask2.png " alt=""/>
                </dt>
                <dd>
                    <p class="wrap_thr_txt">家庭陪伴</p>
                </dd>
            </dl>

            <dl class="wrap_thr_item3 ">
                <dt>
                    <img src="<?= $bundle->baseUrl?>/img/thr3.jpg" alt=""/>
                    <!--mask-->
                    <img class="mask_img" src="<?= $bundle->baseUrl?>/img/thr_mask3.png " alt=""/>
                </dt>
                <dd>
                    <p class="wrap_thr_txt">情景教育</p>
                </dd>
            </dl>
		<?php }?>
            <!--triangle_img-->
            <i class="triangle_img"></i>
		</div>
        <!--interval_wrap-->
        <div class="interval_wrap ">
            <div class="interval_contain tag_left">
                <p class="interval_title">丰富的内容资源，涵括教育、娱乐、音乐、新闻...想听就听</p>
            </div>
        </div>

        <!--source_wrap-->
        <div class="source_wrap tag_right" style="background-image:url(<?= $bundle->baseUrl?>/img/bg_source.jpg)">

            <ul class="source_list clearfix">
                <li>
                    <i class="case_df"><img class="source_item_img lazy" data-original="<?= $bundle->baseUrl?>/img/source1.png" alt=""/></i>
                    <span class="source_item_txt"><em class="counts_df">800</em>+经典儿歌</span>
                </li>
                <li>
                    <i class="case_df"><img class="source_item_img lazy" data-original="<?= $bundle->baseUrl?>/img/source2.png" alt=""/></i>
                    <span class="source_item_txt"><em class="counts_df">1000</em>+益智百科</span>
                </li>
                <li>
                    <i class="case_df"><img class="source_item_img lazy" data-original="<?= $bundle->baseUrl?>/img/source3.png" alt=""/></i>
                    <span class="source_item_txt"><em class="counts_df">800</em>+小时英语资源</span>
                </li>
                <li>
                    <i class="case_df"><img class="source_item_img lazy" data-original="<?= $bundle->baseUrl?>/img/source4.png" alt=""/></i>
                    <span class="source_item_txt"><em class="counts_df">800</em>+国学精品</span>
                </li>
                <li>
                    <i class="case_df"><img class="source_item_img lazy" data-original="<?= $bundle->baseUrl?>/img/source5.png" alt=""/></i>
                    <span class="source_item_txt"><em class="counts_df">1000</em>+趣味故事</span>
                </li>
            </ul>


            <div class="source_des_contain">
                <p class="txt_df">
			        小萝卜拥有丰富的有声资源
			        涵盖音乐、国学、娱乐、科普等多种内容，仍在持续丰富中
			        与宝宝在声音中共同成长
			    </p>
            </div>
            <!--triangle_img-->
            <i class="triangle_img"></i>
        </div>

        <!--interval_wrap-->
        <div class="interval_wrap ">
            <div class="interval_contain tag_left">
                <p class="interval_title">快乐童年，让游戏激发孩子的成长潜能与探索欲~</p>
            </div>
        </div>
        <div class="expansion_wrap tag_right">
            <div class="expansion_contain">           	
                <!--三个与下面按钮对应-->
                <ul class="funSlider ">
                <?php if (!empty($products[0]['skus'][0])){?>
                	<li class="">
                        <dl class="item_df slide">
                            <dt class="case_df">
                            	<img src="<?= SiteHelper::getImgSrc($products[0]['skus'][0]['pic']) ?>">
                            </dt>
                            <dd class="des_df">
                                <p class="dex_title"><?= $products[0]['skus'][0]['name'] ?></p>
                                <p class="dex_txt"><?= $products[0]['skus'][0]['value'] ?></p>
                                <p class="ico_bar">
                                <?php if (!empty($products[0]['skus'][0]['info'])){ $infos=explode('#', $products[0]['skus'][0]['info']);?>
                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/logic.png)"></i><span class="ico_txt"><?= $infos[0] ?></span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/space.png)"></i><span class="ico_txt"><?= $infos[1] ?></span>
                                <?php }?>
                                </p>
                            </dd>
                        </dl>
                    </li>
                <?php }else{?>
	                 <li class="">
	                        <dl class="item_df slide">
	                            <dt class="case_df">
	                            	<img src="">
	                            </dt>
	                            <dd class="des_df">
	                                <p class="dex_title">益智推箱子</p>
	                                <p class="dex_txt">配合丰富的游戏套件，小萝卜通过经典的推箱子游戏
	                                    开发孩子的逻辑思维、空间思维能力</p>
	                                <p class="ico_bar">
	                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/logic.png)"></i><span class="ico_txt">逻辑思维</span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/space.png)"></i><span class="ico_txt">空间想象</span>
	                                </p>
	                            </dd>
	                        </dl>
	                    </li>
                 <?php }?>  
                    <?php if (!empty($products[0]['skus'][1])){?>
                	<li class="">
                        <dl class="item_df slide">
                            <dt class="case_df">
                            	<img src="<?= SiteHelper::getImgSrc($products[0]['skus'][1]['pic']) ?>">
                            </dt>
                            <dd class="des_df">
                                <p class="dex_title"><?= $products[0]['skus'][1]['name'] ?></p>
                                <p class="dex_txt"><?= $products[0]['skus'][1]['value'] ?></p>
                                <p class="ico_bar">
                                  <?php if (!empty($products[0]['skus'][1]['info'])){ $infos=explode('#', $products[0]['skus'][1]['info']);?>
                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/logic.png)"></i><span class="ico_txt"><?= $infos[0] ?></span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/space.png)"></i><span class="ico_txt"><?= $infos[1] ?></span>
                                <?php }?>
                                </p>
                            </dd>
                        </dl>
                    </li>
                <?php }else{?>						
                    <li class="">
                        <dl class="item_df slide">
                            <dt class="case_df"></dt>
                            <dd class="des_df">
                                <p class="dex_title">机智问答</p>
                                <p class="dex_txt">古诗对句、谜语问答、脑经急转弯，开动脑经的机智问答
                                    小萝卜拥有庞大的问题题库，有效提高孩子的记忆力与学习能力</p>
                                <p class="ico_bar">
                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/study.png)"></i><span class="ico_txt">学习能力</span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/memory.png)"></i><span class="ico_txt">记忆力</span>
                                </p>
                            </dd>
                        </dl>
                    </li>
				<?php }?>
				 <?php if (!empty($products[0]['skus'][2])){?>
                	<li class="">
                        <dl class="item_df slide">
                            <dt class="case_df">
                            	<img src="<?= SiteHelper::getImgSrc($products[0]['skus'][2]['pic']) ?>">
                            </dt>
                            <dd class="des_df">
                                <p class="dex_title"><?= $products[0]['skus'][2]['name'] ?></p>
                                <p class="dex_txt"><?= $products[0]['skus'][2]['value'] ?></p>
                                <p class="ico_bar">
                                   <?php if (!empty($products[0]['skus'][2]['info'])){ $infos=explode('#', $products[0]['skus'][2]['info']);?>
                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/logic.png)"></i><span class="ico_txt"><?= $infos[0] ?></span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/space.png)"></i><span class="ico_txt"><?= $infos[1] ?></span>
                                <?php }?>
                                </p>
                            </dd>
                        </dl>
                    </li>
                <?php }else{?>
                    <li class="">
                        <dl class="item_df slide">
                            <dt class="case_df"></dt>
                            <dd class="des_df">
                                <p class="dex_title">编程闯迷宫</p>
                                <p class="dex_txt">通过APP来操控小萝卜编程闯迷宫
                                    有效训练提示孩子的记忆力、观察能力</p>
                                <p class="ico_bar">
                                    <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/observe.png)"></i><span class="ico_txt">观察能力</span> <i class="ico_df " style="background:url(<?= $bundle->baseUrl ?>/img/memory.png)"></i><span class="ico_txt">记忆力</span>
                                </p>
                            </dd>
                        </dl>
                    </li>
                   <?php }?> 
                 </ul>
                <p class="funSlider_btn_bar">
                    <button class="funSlider_btn btn_1" type="button" ><?= empty( $products[0]['skus'][2]['name'])?'益智推箱子':$products[0]['skus'][0]['name'];?></button>
                    <button class="funSlider_btn btn_2" type="button" ><?= empty( $products[0]['skus'][2]['name'])?'机智问答':$products[0]['skus'][1]['name'];?></button>
                    <button class="funSlider_btn btn_3" type="button" ><?= empty( $products[0]['skus'][2]['name'])?'编程闯迷宫':$products[0]['skus'][2]['name'];?></button>
                    <a class="funSlider_btn btn_df btn_4" >更多</a>
                </p>
            </div>
        </div>

        <!--interval_wrap-->
        <div class="interval_wrap ">
            <div class="interval_contain tag_left">
                <p class="interval_title">视频通话，实时提醒，让家人间的连接更紧密</p>
            </div>
        </div>

        <!--funVideo-->
        <div class="funVideo clearfix ">
        	<?php if (!empty($products[1]['skus'][0])){?>
            <div class="funVideo_lt">
                <div class="describe_contain">
                    <p class="title_df "><?= $products[1]['skus'][0]['name']  ?></p>
                    <?php if (!empty(explode('#', $products[1]['skus'][0]['value']))){foreach (explode('#', $products[1]['skus'][0]['value']) as $k0){ ?>
                    <p class="row_df"><?= $k0 ?></p>
                    <?php }}?>
                </div>
            </div>
            <?php }else{?>
            <div class="funVideo_lt">
                <div class="describe_contain">
                    <p class="title_df ">实时视频通话</p>
                    <p class="row_df">思恋成线，缩短千万里</p>
                    <p class="row_df">即使在忙碌的工作中，也能够随时看到宝宝</p>
                    <p class="row_df">任何时间任何地点，打开APP即可与宝宝相连</p>
                </div>
            </div>
            <?php }?>
            <?php if (!empty($products[1]['skus'][1])){?>
             <div class="funVideo_rt">
            	<div class="describe_contain">
                    <p class="title_df "><?= $products[1]['skus'][1]['name']  ?></p>
                    <?php if (!empty(explode('#', $products[1]['skus'][1]['value']))){foreach (explode('#', $products[1]['skus'][1]['value']) as $k1){ ?>
                    <p class="row_df"><?= $k1 ?></p>
                    <?php }}?>
                </div>
            </div>
            <?php }else{?>
            <div class="funVideo_rt">
                <div class="describe_contain">
                    <p class="title_df">生活提醒</p>
                    <p class="row_df">妈妈的话，实时伴耳边</p>
                    <p class="row_df">将叮咛的话告诉小萝卜</p>
                    <p class="row_df">它会帮你向宝宝转达~</p>
                </div>
            </div>
            <?php }?>
        </div>

        <!--interval_wrap-->
        <div class="interval_wrap ">
            <div class="interval_contain tag_left">
                <p class="interval_title">多种场景随意切换，打造桌面万能小萌宠</p>
            </div>
        </div>

        <!--thr_model_wrap-->
        <div class="thr_model_wrap tag_right"  >
            <ul class="thr_model clearfix">
            <?php if (!empty($products[2]['skus'][0])){?>
                <li class="item_df">
                        <dl class="item_contain1">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model1.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df"><?= $products[2]['skus'][0]['name']  ?></p>
                      <?php if (!empty(explode('#', $products[2]['skus'][0]['value']))){foreach (explode('#', $products[2]['skus'][0]['value']) as $v0){ ?>                                
                                <p class="txt_df"><?= $v0 ?></p>
                        <?php }}?>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= SiteHelper::getImgSrc($products[2]['skus'][0]['pic']) ?>" alt=""/>

                </li>
            <?php }else{?>  
            	<li class="item_df">
                        <dl class="item_contain1">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model1.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df">户外</p>
                                <p class="txt_df">小萝卜机器人可是一个运动小健将哦</p>
                                <p class="txt_df">快带宝贝一起外面玩吧</p>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= $bundle->baseUrl ?>/img/model1_up.png" alt=""/>

                </li>  
			<?php }?>
			<?php if (!empty($products[2]['skus'][1])){?>
               <li class="item_df">
                        <dl class="item_contain2">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model2.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df"><?= $products[2]['skus'][1]['name']  ?></p>
                                <?php if (!empty(explode('#', $products[2]['skus'][1]['value']))){foreach (explode('#', $products[2]['skus'][1]['value']) as $v1){ ?>                                
                                <p class="txt_df"><?= $v1 ?></p>
                        		<?php }}?>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= SiteHelper::getImgSrc($products[2]['skus'][1]['pic']) ?>" alt=""/>
                </li>
            <?php }else{?> 
                 <li class="item_df">
                        <dl class="item_contain2">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model2.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df">家庭</p>
                                <p class="txt_df">陪伴宝宝成长的守护星</p>
                                <p class="txt_df">博学多才的小老师</p>
                                <p class="txt_df">让小萝卜与宝宝一起成长</p>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= $bundle->baseUrl ?>/img/model2_up.png" alt=""/>
                </li>
			<?php }?>
			<?php if (!empty($products[2]['skus'][2])){?>
               <li class="item_df">
                        <dl class="item_contain3">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model3.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df"><?= $products[2]['skus'][2]['name']  ?></p>
                                <?php if (!empty(explode('#', $products[2]['skus'][2]['value']))){foreach (explode('#', $products[2]['skus'][2]['value']) as $v2){ ?>                                
                                <p class="txt_df"><?= $v2 ?></p>
                        		<?php }}?>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= SiteHelper::getImgSrc($products[2]['skus'][2]['pic']) ?>" alt=""/>
                </li>
            <?php }else{?>
                <li class="item_df">
                        <dl class="item_contain3">
                            <dt class="ico_df "><img class="thr_model_ico" src="<?= $bundle->baseUrl ?>/img/model3.png"/></dt>
                            <dd class="describe_df">
                                <p class="title_df">办公</p>
                                <p class="txt_df">办公桌上的全能小秘书</p>
                                <p class="txt_df">播报新闻，实时提醒，播放音乐</p>
                                <p class="txt_df">小萝卜助你一臂之力</p>
                            </dd>
                        </dl>
                        <img class="thr_model_up" src="<?= $bundle->baseUrl ?>/img/model3_up.png" alt=""/>
                </li>
             <?php }?>   
            </ul>
        </div>

        <!--interval_wrap-->
        <div class="interval_wrap ">
            <div class="interval_contain tag_left">
                <p class="interval_title">双模态交互，让家人操作更舒适</p>
            </div>
        </div>

        <div class="interaction_wrap tag_up " style="background-image:url(<?= $bundle->baseUrl ?>/img/interaction.jpg)">
            <?php if (!empty($products[3]['skus'][0])){?>
           <div class="lt_df">
                <div class="interaction_contain">               
                    <p class="title_df"><?= $products[3]['skus'][0]['name']?></p>
                    <?php if (!empty(explode('#', $products[3]['skus'][0]['value']))){foreach (explode('#', $products[3]['skus'][0]['value']) as $s0){ ?>                                
                           <p class="txt_df"><?= $s0 ?></p>
                     <?php }}?>
                </div>
            </div>
            <?php }else{?>
            <div class="lt_df">
                <div class="interaction_contain">               
                    <p class="title_df">APP控制</p>
                    <p class="txt_df">专为小萝卜定制的专用APP</p>
                    <p class="txt_df">精简易懂，一键操作，简单便捷</p>
                </div>
            </div>
			<?php }?>
			<?php if (!empty($products[3]['skus'][1])){?>
           <div class="rt_df">
                <div class="interaction_contain">               
                    <p class="title_df"><?= $products[3]['skus'][1]['name']?></p>
                    <?php if (!empty(explode('#', $products[3]['skus'][1]['value']))){foreach (explode('#', $products[3]['skus'][1]['value']) as $s1){ ?>                                
                                <p class="txt_df"><?= $s1 ?></p>
                     <?php }}?>
                </div>
            </div>
            <?php }else{?>
            <div class="rt_df">
                <div class="interaction_contain">
                    <p class="title_df">语言识别</p>
                    <p class="txt_df">采用业内领先的语音识别技术</p>
                    <p class="txt_df">在日常家庭及办公环境下唤醒率95%</p>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
<?php $this->beginBlock('test') ?>  
setNavActive('<?php echo $model->id?>');
$(document).ready(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn",
            threshold : 180
        });
    });
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
