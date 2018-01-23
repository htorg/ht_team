<?php
use yii\helpers\Url;
use common\helpers\ThemeHelper;
?>
<ul class="sidebar-menu bg_color">
    <li class="header bg_color ft_color"><?php echo \Yii::t('app', 'Today is').' '.date('Y-m-d');?></li>
    <!-- Optionally, you can add icons to the links -->



    <li class="side-search-item " rel="dashboard"><a class="bg_color ft_color" href="<?php echo Url::toRoute(['site/index'])?>"><i class="fa fa-dashboard"></i> <span><?php echo Yii::t('app', 'Dashboard');?></span></a></li>



    <li class="side-search-item bg_color" rel="config"><a class="bg_color ft_color" href="<?php echo Url::toRoute(['nav/manager'])?>">
            <i class="fa fa-crop"></i> <span>配置项</span></a></li>

    <li class="side-search-item bg_color" rel="config"><a class="bg_color ft_color" href="<?php echo Url::toRoute(['nav/manager-page'])?>">
            <i class="fa fa-folder"></i> <span>管理</span></a></li>
    <?php if (in_array(ThemeHelper::$THEME_FEATURE_NAV, $features)){?>



        <!--                <li class="side-search-item bg_color" rel="nav"><a class="bg_color ft_color" href="--><?php //echo Url::toRoute(['nav/index'])?><!--"><i class="fa fa-map-signs"></i> <span>--><?php //echo Yii::t('app', 'Nav management');?><!--</span></a></li>-->
        <!--                --><?php //}?>
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_CATEGORY, $features)){?>
        <!---->
        <!---->
        <!---->
        <!--                <li class="side-search-item bg_color" rel="category"><a  class="bg_color ft_color" href="--><?php //echo Url::toRoute(['category/index'])?><!--"><i class="fa fa-list"></i> <span>--><?php //echo Yii::t('app', 'Category management');?><!--</span></a></li>-->
        <!--                --><?php //}?>
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_ARTICLE, $features)){?>
        <!---->
        <!---->
        <!---->
        <!--                <li class="side-search-item" rel="article"><a class="bg_color ft_color" href="--><?php //echo Url::toRoute(['article/index'])?><!--"><i class="fa fa-file-text-o"></i> <span>--><?php //echo Yii::t('app', 'Article management');?><!--</span></a></li>-->
        <!--                --><?php //}?>
        <!---->
        <!---->
        <!---->
        <!--                <li class="side-search-item treeview" rel="page" >-->
        <!--                    <a class="bg_color ft_color" href="#"><i class="fa fa-files-o"></i> <span>--><?php //echo Yii::t('app', 'Page management');?><!--</span>-->
        <!--                        <span class="pull-right-container">-->
        <!--                          <i class="fa fa-angle-left pull-right"></i>-->
        <!--                        </span>-->
        <!--                    </a>-->
        <!--                    <ul class="treeview-menu bg_color " >-->
        <!--                    --><?php //if($_SESSION['cms.theme_id']!=9){?>
        <!--                    	--><?php //if (in_array(ThemeHelper::$THEME_FEATURE_PAGE_CONTACT, $features)){?>
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['page-contact/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Contact us');?><!--</span></a></li>-->
        <!--                        --><?php //}?>
        <!--                    --><?php //}?>
        <!--                        --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_PAGE_ABOUT, $features)){?>
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['page-about/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'About us');?><!--</span></a></li>-->
        <!--                        --><?php //}?>
        <!---->
        <!--                		--><?php //if (in_array(ThemeHelper::$THEME_FEATURE_PAGE, $features)){?>
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['page/index'])?><!--"><i class="fa fa-plus-square"></i><span>--><?php //echo Yii::t('app', 'Customer page');?><!--</span></a></li>-->
        <!--                		--><?php //}?>
        <!--                    </ul>-->
        <!--                </li>-->
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_BANNER, $features)){?>
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!--                    <li class="side-search-item" rel="banner"><a class="bg_color ft_color" href="--><?php //echo Url::toRoute(['banner/index'])?><!--"><i class="fa fa-film"></i> <span>--><?php //echo Yii::t('app', 'Banner management');?><!--</span></a></li>-->
        <!--				--><?php //}?>
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_CASE, $features)){?>
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!--									<li class="side-search-item treeview" rel="case" >-->
        <!--                    <a class="bg_color ft_color" href="#"><i class="fa fa-folder"></i> <span>--><?php //echo Yii::t('app', 'Case management');?><!--</span>-->
        <!--                        <span class="pull-right-container">-->
        <!--                          <i class="fa fa-angle-left pull-right"></i>-->
        <!--                        </span>-->
        <!--                    </a>-->
        <!--                    <ul class="treeview-menu bg_color">-->
        <!--                        <li><a  class="ft_color" href="--><?php //echo Url::toRoute(['case/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Cases');?><!--</span></a></li>-->
        <!--                        <li><a   class="ft_color" href="--><?php //echo Url::toRoute(['case-category/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Case Categories');?><!--</span></a></li>-->
        <!--                        <li><a  class="ft_color" href="--><?php //echo Url::toRoute(['cms-case-config/update'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Case Config');?><!--</span></a></li>-->
        <!--                    </ul>-->
        <!--                </li>-->
        <!--                --><?php //}?>
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_ALBUM, $features)){?>
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!--                <li class="side-search-item treeview" rel="album" >-->
        <!--                    <a class="bg_color ft_color" href="#"><i class="fa fa-image"></i> <span>--><?php //echo Yii::t('app', 'Cms Albums');?><!--</span>-->
        <!--                        <span class="pull-right-container">-->
        <!--                          <i class="fa fa-angle-left pull-right"></i>-->
        <!--                        </span>-->
        <!--                    </a>-->
        <!--                    <ul class="treeview-menu bg_color">-->
        <!--                        <li><a class="ft_color"  href="--><?php //echo Url::toRoute(['cms-album/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Album List');?><!--</span></a></li>-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-album-config/update'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Album Config');?><!--</span></a></li>-->
        <!--                    </ul>-->
        <!--                </li>-->
        <!--				--><?php //}?>
        <!---->
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_FRIENDLINK, $features)){?>
        <!--                <li class="side-search-item" rel="friendlink"> <a class="bg_color ft_color" href="--><?php //echo Url::toRoute(['friend-link/index'])?><!--"><i class="fa fa-linkedin"></i> <span>--><?php //echo Yii::t('app', 'Friend Link management');?><!--</span></a></li>-->
        <!--                --><?php //}?>
        <!---->
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_UPLOADFILE, $features)){?>
        <!--                <li class="side-search-item" rel="uploadfile"><a class="bg_color ft_color" href="--><?php //echo Url::toRoute(['cms-uploadfile/index'])?><!--"><i class="fa fa-linkedin"></i> <span>--><?php //echo Yii::t('app', 'Upload File');?><!--</span></a></li>-->
        <!--                --><?php //}?>
        <!---->
        <!--                --><?php //if (in_array(ThemeHelper::$THEME_FEATURE_SERVICE, $features)){?>
        <!--                <li class="side-search-item treeview" rel="service" >-->
        <!--                    <a class="bg_color ft_color" href="#"><i class="fa fa-headphones"></i> <span>--><?php //echo Yii::t('app', 'Cms Services');?><!--</span>-->
        <!--                        <span class="pull-right-container">-->
        <!--                          <i class="fa fa-angle-left pull-right"></i>-->
        <!--                        </span>-->
        <!--                    </a>-->
        <!--                    <ul class="treeview-menu bg_color">-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-service/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Services');?><!--</span></a></li>-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-service-config/update'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Service Config');?><!--</span></a></li>-->
        <!--                    </ul>-->
        <!--                </li>-->
        <!--				--><?php //}?>
        <!--				--><?php //if (in_array(ThemeHelper::$THEME_FEATURE_PRODUCT, $features)){?>
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!---->
        <!--                <li class="side-search-item treeview" rel="product" >-->
        <!--                    <a class="bg_color ft_color" href="#"><i class="fa fa-object-group"></i> <span>--><?php //echo Yii::t('app', 'Product management');?><!--</span>-->
        <!--                        <span class="pull-right-container">-->
        <!--                          <i class="fa fa-angle-left pull-right"></i>-->
        <!--                        </span>-->
        <!--                    </a>-->
        <!--                    <ul class="treeview-menu bg_color">-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-product-config/update'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Product Config');?><!--</span></a></li>-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-product-category/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Product Category');?><!--</span></a></li>-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-product-info/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Product Info');?><!--</span></a></li>-->
        <!--                        <li><a class="ft_color" href="--><?php //echo Url::toRoute(['cms-product-inquiry/index'])?><!--"><i class="fa fa-file-o"></i><span>--><?php //echo Yii::t('app', 'Cms Product Inquiry');?><!--</span></a></li>-->
        <!--                    </ul>-->
        <!--                </li>-->
    <?php }?>
    <li  class="side-search-item treeview"  rel="settings" >
        <a class="bg_color ft_color" href="#"><i class="fa fa-gears"></i> <span><?php echo Yii::t('app', 'Web settings');?></span>
            <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
        </a>
        <ul class="treeview-menu bg_color">
            <li><a class="ft_color" href="<?php echo Url::toRoute(['cms-site/index'])?>"><i class="fa fa-gear"></i><span><?php echo Yii::t('app', 'System settings');?></span></a></li>
            <li><a class="ft_color" href="<?php echo Url::toRoute(['cms-site-lang/index'])?>"><i class="fa fa-gear"></i><span><?php echo Yii::t('app', 'Lang settings');?></span></a></li>
            <li><a class="ft_color" href="<?php echo Url::toRoute(['cms-theme/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'My themes');?></span></a></li>
            <li><a class="ft_color" href="<?php echo Url::toRoute(['cms-share-btn/index'])?>"><i class="fa fa-gear"></i><span><?php echo Yii::t('app', 'Cms Share Btns');?></span></a></li>
        </ul>
    </li>
    <?php /*if(Yii::$app->user->identity->username=='admin1'){*/ if(0==1){ ?>

        <li class="ht_li_line" style="margin:30px 0  10px;height:1px;background:#000"></li>

        <li  class="side-search-item treeview" rel="gh_settings" >
            <a class="bg_color ft_color" href="#"><i class="fa fa-gears"></i> <span><?php echo Yii::t('app', 'Gh settings');?></span>
                <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
            </a>
            <ul class="treeview-menu bg_color">
                <li><a class="ft_color"  href="<?php echo Url::toRoute(['gh-theme-category/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'Theme category');?></span></a></li>
                <li><a class="ft_color" href="<?php echo Url::toRoute(['cms-config-type/index'])?>"><i class="fa fa-gear"></i><span><?php echo Yii::t('app', 'Cms Config settings');?></span></a></li>
                <li><a class="ft_color" href="<?php echo Url::toRoute(['gh-theme/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'Theme management');?></span></a></li>
                <li><a class="ft_color" href="<?php echo Url::toRoute(['gh-config-lang/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'Gh Config Langs');?></span></a></li>
                <li><a class="ft_color" href="<?php echo Url::toRoute(['gh-plan/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'Gh Plans');?></span></a></li>
                <li><a class="ft_color" href="<?php echo Url::toRoute(['gh-plan-order/index'])?>"><i class="fa fa-language"></i><span><?php echo Yii::t('app', 'Gh Plan Orders');?></span></a></li>
            </ul>
        </li>
    <?php }?>
</ul>