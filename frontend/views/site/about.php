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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df" href="<?= Url::to(['site/index'])?>">走进天安</a> > <a class="btn_df">公司简介</a></p></div>

    <!--digital_mall-->
    <div class="digital_mall item_wrap">
        <div class="wrap_contain">
            <p class="title_df"><?= empty($model->company_name)?'重庆天安数码城':$model->company_name; ?></p>

            <div class="company_intro">
                <p class="intro_title">公司简介</p>
                <div class="intro_txt">
                    <?php if (empty($model->company_desc)){?>
                    <p>该项目由天安数码城（集团）有限公司（香港天安中国投资有限公司和深业泰然股份有限公司合资成立，专业从事城市产业综合体开发和运营）于2011年开工建设，该项目规划集科技产业大厦、区域总部基地、优质商务配套和滨江高尚物业于一体，拟建成创新科技产业、战略新兴产业、低碳环保产业及高端现代服务业聚集的西南首席城市产业综合体。该项目占地面积537亩，规划建筑120万平方米，投资约50亿元，其中产业园项目规划建筑80万平方米。</p>
                    <p>目前，园区正重点打造“1+3+4””创新企业生态体系，实现注册企业350家(19家外资)，正式入驻企业超230家，其中5家行业隐形冠军、4家拟上市企业、6家上市公司西部总部。产业发展主要以信息服务、生物医疗、节能环保、跨境电商及现代服务业为主，其中战略新兴产业占比超过70%，从业人员近5000人。</p>
                    <p>此外，园区先后获得“全国青年创业示范园区”、“国家级众创空间”“、“国家环保产业发展重庆基地”、“重庆精准医疗生物产业园”““、”重庆市总部贸易、转口贸易第一批支持范围”等资质荣誉。</p>
                    <?php }else{ echo $model->company_desc;}?>
                </div>
            </div>
        </div>
    </div>

    <!--shareholder-->
    <div class="shareholder item_wrap">
        <div class="wrap_contain">
            <p class="title_df"><?= empty($model->shareholder_title)?'股东-中港合资强强联合':$model->shareholder_title;  ?></p>
            <i class="imgCase"><img src="<?= empty($model->shareholder_detail)?$bundle->baseUrl.'/img/share_holder.png':DataHelper::getImgSrc($model->shareholder_detail)?>"/></i>
        </div>
    </div>

    <!--strategic_wrap-->
    <div class="strategic_wrap">
        <img src="<?= empty($model->Strategic_detail)?$bundle->baseUrl.'/img/strategic.jpg':DataHelper::getImgSrc($model->Strategic_detail)?>"/>
        <p class="title_df"><?= empty($model->Strategic_title)?'全国战略布局':$model->Strategic_title;  ?></p>
    </div>

    <!--SiliconValley-->
    <div class="SiliconValley item_wrap">
        <div class="wrap_contain">
            <p class="title_df"><?= empty($model->info_main_title)?'股东-中国硅谷-成长型企业的上市摇篮':$model->info_main_title;  ?></p>
            <p class="sub_title_df"> <?= empty($model->info_subtitle)?'被称为中国成长型企业的最佳合作伙伴':$model->info_subtitle;  ?></p>
            <!--thr_block-->
            <div class="thr_block clearfix">
                <dl class="item_df">
                    <!--item_1-->
                    <dt class="item_1 item_case"></dt>
                    <dd class="item_des"><?= empty($model->info_desc1)?'超过10000家成长型企业已成为天安数码城的客户':$model->info_desc1;  ?></dd>
                </dl>

                <!--item_2-->
                <dl class="item_df">
                    <dt class="item_2 item_case"></dt>
                    <dd class="item_des"><?= empty($model->info_desc2)?'孵化上市企业近67家拟上市企业达50余家':$model->info_desc2;  ?></dd>
                </dl>

                <!--item_3-->
                <dl class="item_df">
                    <dt class="item_3 item_case"></dt>
                    <dd class="item_des"> <?= empty($model->info_desc3)?'享受创新生态环境带来的便捷服务':$model->info_desc3;  ?></dd>
                </dl>
            </div>

            <!--company_table_wrap-->
            <div class="company_table_wrap">
                <table class="company_table">
                    <colgroup>
                        <col class="col_1">
                        <col class="col_2">
                        <col class="col_3">
                        <col class="col_4">
                    </colgroup>

                    <thead>
                    <tr>
                        <th>上市公司</th>
                        <th>上市地点</th>
                        <th>股票代码</th>
                        <th>行业地位</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($model->company)){foreach($model->company as $val){?>
                        <tr>
                            <td><?= $val->company_name ?></td>
                            <td><?= $val->listing_place ?></td>
                            <td><?= $val->stock_code ?></td>
                            <td><?= $val->rank_field ?></td>
                        </tr>
                    <?php }}?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
    setNav('about');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>