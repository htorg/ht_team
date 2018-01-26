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
    <div class="crumbs_wrap"><p class="crumbs_bar"><a class="btn_df">运营服务</a> > <a class="btn_df">入驻流程</a></p></div>

    <!--join_notice-->
    <div class="join_notice process_wrap">
        <div class="join_notice_con">
            <p class="con_title">入伙办理须知</p>
            <dl class="ctn clearfix">
                <dt class="ctn_case"><img src="<?= empty($model->map_img)?$bundle->baseUrl.'/img/join_notice.jpg':DataHelper::getImgSrc($model->map_img)?>" alt=""></dt>
                <dd class="ctn_des">
                    <?php if (empty($model->settled_summary)){?>
                    <p class="ctn_title">尊敬的云谷一期各业主：</p>
                    <div class="ctn_detail">
                        <p>您好！恭喜您成为重庆天安数码城·云谷的业主/用户！天安物业重庆分公司全体同仁怀着无比喜悦的心情，迎接您及您的企业正式进驻重庆天安数码城。我们坚信，这将是我们携手并肩走向成功、迈向卓越的开始！</p>
                    </div>
                    <?php }else{ echo $model->settled_summary;}?>
                </dd>
            </dl>
        </div>
    </div>

    <!--do_guide-->
    <div class="do_guide process_wrap">
        <div class="do_guide_con">
            <p class="con_title">办理指南</p>
            <div class="con_notice">
                <p class="box_title ">
                    <img class="ico_df" src="img/ico_title.png"/>
                    <span class="tab_bar ht_nowrap">
                            <a class="tab_df tab_on btn_df noneSelect">入伙办理须知<em class="line_df"></em></a><a class="tab_df btn_df noneSelect">相关资料下载<em class="line_df"></em></a>
                        </span>
                </p>
                <!--notice_box-->
                <div class="notice_box ">
                    <?php if (empty($model->settled_desc)){?>
                    <p class="title_df">一、入伙手续办理须知</p>
                    <p>为了方便业主办理入伙手续，现将办理入伙手续时所需携带的资料、办理程序及相关注意事项知会如下：
                        1如果您是个人置业，办理入伙时，请携带以下资料：
                        a.入伙通知书（原件）1份；
                        b.《房屋销售合同》原件及复印件1份；
                        c.业主身份证原件1份及复印件2份；
                        d.已填妥的《顾客信息登记表》；
                        e.银行存折（用于缴付管理服务费）原件1份及复印件2份。</p>
                    <p>
                    </p>

                    <p class="title_df">2如果您是公司置业，办理入伙时，请携带以下资料：</p>
                    <p>a.入伙通知书（原件）1份；
                        b.《房屋销售合同》原件及复印件1份；
                        c.公司《营业执照》、《组织机构代码证》原件及复印件（加盖鲜章）3份；
                        d.公司法人代表身份证原件1份及复印件（加盖鲜章）3份；
                        e.公司公章及法人章；
                        f.已填妥的《顾客信息登记表》；
                        g.银行开户帐号（用于缴付管理服务费）。</p>
                    <p>
                    </p>

                    <p class="title_df">3如果您委托他人代办入伙手续，请准备以下资料，交您的授权委托人代办相关手续：</p>
                    <p>a.入伙通知书（原件）1份；
                        b.《房屋销售合同》原件及复印件1份；
                        c.业主授权委托书原件1份；公司业主须备本企业法人代表证明书及法人代表授权委托书原件各1份；
                        d.业主授权委托人身份证原件及复印件1份；
                        e.业主身份证原件1份及复印件2份；
                        f.公司业主须备企业《营业执照》原件及复印件1份；
                        g.已填妥的《顾客信息登记表》；
                        h.银行存折（用于缴付管理服务费）原件1份及复印件2份。</p>
                    <p>
                    </p>

                    <p class="title_df">4入伙办理程序</p>
                    <p>a.验证：请您交验《入伙通知书》、《购房合同》、《顾客信息登记表》、《营业执照》、业主身份证原件以及入伙相关资料；
                        b.签约：办理入伙时，需要签订《临时管理规约》、《服务宝典》、《用水委托合同》等；
                        c.收费：预收三个月管理服务费，并办理委托银行托收协议手续（主要托收费用为管理费、水费及有偿服务费等）；电费为提前预缴，入伙手续办理时需按30元/平方米缴纳。
                        d.验楼：业主领取《物业交楼验收表》，由园区运营中心工作人员引导办理房屋验收手续，并抄写单元水、电表底读；房屋需要修缮的，填写《房屋返修申请表》，由园区运营中心联系重庆数码城公司和承建单位进行修缮；
                        e.钥匙移交：由园区运营服务中心客服人员向您办理钥匙移交手续；</p>
                    <?php }else{ echo $model->settled_desc;}?>
                </div>

                <!--down_box-->
                <div class="down_box">
                    <ul>
                        <?php if (!empty($files)){foreach ($files as $file){ ?>
                        <li><p class="row_df"><span class="txt_df ht_nowrap"><?= $file->name ?></span><a class="btn_df btn_down noneSelect" href="<?= DataHelper::getImgSrc($file->src)?>">立即下载</a></p></li>
                        <?php }}?>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>
<?php $this->beginBlock('test') ?>
    setNav('operate');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>