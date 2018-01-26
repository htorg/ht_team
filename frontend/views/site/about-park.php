<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use common\helpers\DataHelper;
use yii\helpers\Url;
$bundle=\frontend\assets\AppAsset::register($this);
?>
<div class="main_df">
    <!--banner_wrap-->
    <?php if (is_object($model)){?>
        <?= \frontend\widgets\Banner::widget(['banner'=>$model->banner,'banner_title'=>$model->banner_title,'banner_subtitle'=>$model->banner_subtitle]) ?>
    <?php }?>
    <!--crumbs_wrap-->
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df" href="">走进天安</a> > <a class="btn_df">园区概况</a></p></div>

    <div class="garden_bar">
        <ul class="garden_con clearfix">
            <?php if (empty($model->articles)){?>
            <li>
                <a class="item_df">
                    <img class="item_img" src="img/garden1.jpg" alt="">
                    <span class="item_txt">重庆天安数码城</span>
                </a>
            </li>
            <li>
                <a class="item_df">
                    <img class="item_img" src="img/garden2.jpg" alt="">
                    <span class="item_txt">V-PIN新媒体创客中心</span>
                </a>
            </li>
            <li>
                <a class="item_df">
                    <img class="item_img" src="img/garden3.jpg" alt="">
                    <span class="item_txt">创业邦DEMO SPACE</span>
                </a>
            </li>

            <li>
                <a class="item_df">
                    <img class="item_img" src="img/garden4.jpg" alt="">
                    <span class="item_txt">重庆亚马逊AWS联合孵化器</span>
                </a>
            </li>
            <?php }else{foreach ($model->articles as $article){?>
                <li>
                    <a class="item_df">
                        <img class="item_img" src="<?= DataHelper::getImgSrc($article->image_node)?>" alt="">
                        <span class="item_txt"><?= $article->name?></span>
                    </a>
                </li>
            <?php }} ?>
        </ul>
    </div>

    <div class="garden_content">
        <ul class="garden_ctt">
            <?php if (empty($model->articles)){?>
            <!--左右区分-->
            <!--left_item-->
            <li  class="left_item ">
                <img class="img_df" src="img/garden_c1.png" alt="">
                <div class="des_df">
                    <p class="title_df">重庆天安数码城</p>
                    <div class="ht_tt">
                        <!--text_con-->
                        <div class="text_con">
                            <p>该项目由天安数码城（集团）有限公司（香港天安中国投资有限公司和深业泰然股份有限公司合资成立，专业从事城市产业综合体开发和运营）于2011年开工建设，该项目规划集科技产业大厦、区域总部基地、优质商务配套和滨江高尚物业于一体，拟建成创新科技产业、战略新兴产业、低碳环保产业及高端现代服务业聚集的西南首席城市产业综合体。该项目占地面积537亩，规划建筑120万平方米，投资约50亿元，其中产业园项目规划建筑80万平方米。该项目全部建成并达产后预计年产值可达200亿元，年税收10亿元。截至目前，该项目完成投资近20亿元，产业园一期（含总部区）23.7万平方米物业已经建成投用，二期8万平方米物业也已启动建设。目前，产业园一期（含总部区）注册企业215家，主要为信息服务、生物医疗、节能环保、现代服务类企业，其中信息服务77家、生物医药21家、节能环保18家、其余99家，从业人员近4000人。</p>
                            <p>此外，大渡口区于今年6月纳入全市总部贸易、转口贸易第一批支持范围，已选定天安数码城一期5号楼（约2.7万平方米）作为开展总部贸易和转口贸易的集聚地，入驻楼宇的企业可享受到市区两级专项优惠政策。重庆自贸试验区获准设立后，市政府审定的重庆自贸试验区范围中有“建桥天安商务区”板块，占地面积2.95平方公里，初步确定为“重庆主城南部核心区开放创新型服务贸易聚集区”，将聚焦发展服务贸易和电子商务业态，重点培育节能环保、生物医药、文化创意等新兴产业，并积极引进相应的研发中心、销售中心和结算中心等项目布局。</p>
                        </div>
                        <p class="text_mask"></p>
                    </div>
                </div>
            </li>
            <!--right_item-->
            <li class="right_item">
                <img class="img_df" src="img/garden_c2.png" alt="">
                <div class="des_df">
                    <p class="title_df">V-PIN新媒体创客中心</p>
                    <div class="ht_tt">

                        <div class="text_con">
                            <p>该机构是重庆首个互联网新媒体孵化基地，被大渡口区政府评为“十佳创新创业企业”，办公面积2200余平方米，可容纳20余个创客团队、150人办公。</p>
                            <p style="height:25px;"></p>
                            <p>该机构主要为入驻的创业团队提供创业空间、创业资源、管理配套、人力资源、资金及技术支持，以培育、孵化和推送微信公众号等方式，促进创业团队互联网成果商品化、产业化，致力把孵化的微信公众号打造成为精品城市生活微杂志，每天推送反映重庆“故事”的原创图文，以新媒体的视角还原城市生活，引领城市潮流，增加网上点击量，达到“吸粉”效果，吸引商业投融资。</p>
                            <p style="height:25px;"></p>
                            <p>目前，累计签约入驻团队23个，培育注册公司10个，孵化“求婚总动员”、“重庆”、“吃喝玩乐在重庆”等微信公众号13个，拥有“粉丝”超过700万，其中“二加一Live”（原创精品微纪录片）微信公众号自2015年12月上线以来，获得了100万融资，已推出70多期，平均每期阅读播放量4.5万。</p>
                        </div>
                        <p class="text_mask"></p>
                    </div>
                </div>
            </li>
            <!--left_item-->
            <li class="left_item ">
                <img class="img_df" src="img/garden_c3.png" alt="">
                <div class="des_df">
                    <p class="title_df">创业邦DEMO SPACE</p>
                    <div class="ht_tt">

                        <div class="text_con">
                            <p>该机构位于天安T+SPACE众创空间，由大渡口区政府与爱奇清科（北京）信息科技有限公司共同打造，办公面积约1000平方米，可容纳11个创业团队办公。</p>
                            <p style="height:25px;"></p>
                            <p>该机构主要聚集孵化信息技术创业团队，为创业者提供孵化培训、推广宣传、投资融资、产品演示等服务，既帮助入驻企业成长，又实现自身经济效益</p>
                            <p style="height:25px;"></p>
                            <p>目前，累计签约孵化“途尔旅游”、“挖藕科技”等创业团队25家，培育注册企业10家。累计开展投融资培训、创业公开课、项目对接会等活动23场，为21家入驻团队提供成长训练营、微信宣传、微博推广等服务29次。</p>
                            <p style="height:25px;"></p>
                            <p>该机构成功孵化的云停智连科技有限公司被大渡口区政府授予“十佳创新创业企业”称号，获得了100万风险投资，核心产品“车位飞”获得10个发明专利、实用新型及著作权，已经实际运营车场5个，签约车位近2000个。</p>
                        </div>
                        <p class="text_mask"></p>
                    </div>
                </div>
            </li>
            <!--right_item-->
            <li class="right_item">
                <img class="img_df" src="img/garden_c4.png" alt="">
                <div class="des_df">
                    <p class="title_df">重庆亚马逊AWS联合孵化器</p>
                    <div class="ht_tt">

                        <div class="text_con">
                            <p>项目选址重庆天安数码城总部基地5号楼，是亚马逊中国地区第三个孵化器，项目建筑总面积约4300平方米，将整合亚马逊云服务平台资源和亚马逊云服务的风险投资合作伙伴资源，包括亚马逊云服务、技术培训及技术支持和认证、业务咨询指导、市场推广及品牌建设等，为创新创业企业提供云技术、市场、融资等全方面的孵化服务，帮助创新创业企业的快速发展和成功。</p>
                            <p style="height:25px;"></p>
                            <p>项目自2015年4月运营以来，累计举办企业交流会、专场路演、投融资对接、技术培训等活动40场，服务对接创新创业企业300余家，筛选43家入驻孵化园（实际在场地办公17家，场地外孵化21家，已淘汰5家），转化注册企业38家。</p>
                            <p style="height:25px;"></p>
                            <p>其中，5家明星企业获得投融资，融资金额达3311万元人民币；为38家申请了亚马逊AWS云服务，获得亚马逊AWS价值300万元云计算使用额度和180万元的技术支持；多个孵化企业在全国青年创业创新大赛先后入围决赛并获得奖项</p>
                        </div>
                        <p class="text_mask"></p>
                    </div>
                </div>
            </li>
            <?php }else{foreach ($model->articles as $key=>$article){
                if ($key%2==0){ ?>
                    <!--left_item-->
                    <li  class="left_item ">
                        <img class="img_df" src="<?= DataHelper::getImgSrc($article->image_main)?>" alt="">
                        <div class="des_df">
                            <p class="title_df"><?= $article->name?></p>
                            <div class="ht_tt">
                                <!--text_con-->
                                <div class="text_con">
                                    <?= $article->content?>
                                </div>
                                <p class="text_mask"></p>
                            </div>
                        </div>
                    </li>
                <?php }else{?>
                    <!--right_item-->
                    <li class="right_item">
                        <img class="img_df" src="<?= DataHelper::getImgSrc($article->image_main)?>" alt="">
                        <div class="des_df">
                            <p class="title_df"><?= $article->name?></p>
                            <div class="ht_tt">
                                <div class="text_con">
                                    <?= $article->content?>
                                </div>
                                <p class="text_mask"></p>
                            </div>
                        </div>
                    </li>
            <?php }}} ?>
        </ul>
    </div>
</div>
<?php $this->beginBlock('test') ?>
    setNav('about');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>