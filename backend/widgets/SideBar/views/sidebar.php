<?php
use yii\helpers\Url;
use common\helpers\ThemeHelper;
use common\models\CmsPageContact;
?>
<ul class="sidebar-menu">
    <li class="header"><?php echo \Yii::t('app', 'Today is').' '.date('Y-m-d');?></li>
    <li class="side-search-item" rel="category" class="treeview">
        <a href="#"><i class="fa fa-file-text"></i> <span>栏目列表</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <?php if (!empty($category_type)){foreach ($category_type as $key=>$val){?>
            <li><a href="<?php echo Url::toRoute(['category/index','type'=>$key])?>"><span ><?= $val ?></span></a></li>
            <?php }}?>
        </ul>
    </li>
    <li class="side-search-item" rel="article"><a href="<?php echo Url::toRoute(['article/index'])?>"><i class="fa fa-file-text"></i> <span>文章列表</span></a></li>
    <li class="side-search-item" rel="friendlink"><a href="<?php echo Url::toRoute(['friend-link/index'])?>"><i class="fa fa-file-text"></i> <span>入驻企业</span></a></li>
    <li class="side-search-item" rel="about" class="treeview">
        <a href="#"><i class="fa fa-file-text"></i> <span>走进天安</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo Url::toRoute(['cms-page-about/index'])?>"><span >公司简介</span></a></li>
            <li><a href="<?php echo Url::toRoute(['cms-listed-company/index'])?>"><span >上市公司</span></a></li>
            <li><a href="<?php echo Url::toRoute(['cms-page-contact/index'])?>"><span >联系方式</span></a></li>
            <li><a href="<?php echo Url::toRoute(['cms-company-honor/index'])?>"><span >资质荣誉</span></a></li>
        </ul>
    </li>
    <li class="side-search-item" rel="product"><a href="<?php echo Url::toRoute(['cms-product/index'])?>"><i class="fa fa-file-text"></i> <span>产品信息</span></a></li>
    <li class="side-search-item" rel="settled" class="treeview">
        <a href="#"><i class="fa fa-file-text"></i> <span>运营服务</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo Url::toRoute(['cms-page-contact/index','type'=>CmsPageContact::TYPE_PROPERTY])?>"><span >联系物业</span></a></li>
            <li><a href="<?php echo Url::toRoute(['services-info/index'])?>"><span >服务信息</span></a></li>
            <li><a href="<?php echo Url::toRoute(['upload-files/index'])?>"><span >文件管理</span></a></li>
        </ul>
    </li>
    <li class="side-search-item" rel="homepage" class="treeview">
        <a href="#"><i class="fa fa-file-text"></i> <span>首页配置项</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="<?php echo Url::toRoute(['homepage-config/index'])?>"><span >首页信息</span></a></li>
            <li><a href="<?php echo Url::toRoute(['cms-banner-pic/index'])?>"><span >轮播图 </span></a></li>
        </ul>
    </li>
</ul>