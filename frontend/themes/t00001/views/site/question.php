<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
use frontend\themes\t00001\AppAsset;
$bundle = frontend\themes\t00001\AppAsset::register($this);
?>
<div class="main_df">
        <!--banner_wrap-->
        <div class="service_banner" <?php if (!empty($question['image_main'])){ echo  'style="background-image:url('.SiteHelper::getImgSrc($question['image_main']).')"' ;}?>>
            <div class="service_banner_contain">
                <p class="title_df"><?= !empty($question['name'])?$question['name']:'' ?></p>
                <p class="subTitle_df"><?= !empty($question['description'])?$question['description']:'' ?></p>
            </div>
        </div>
		
        <div class="service_content">
            <p class="service_tab">
            	<?php if (!empty($question['indexArticles'])){foreach ($question['indexArticles'] as $key=>$val){?>
                <button class="btn_df <?php if (isset($_GET['id'])&&($_GET['id']==$val['id'])){ echo "btn-color".$key;} ?>"><?= $val['name'] ?></button>
                <?php }}?>
            </p>
			
            <!--afterSale_describe-->
            <?php if (!empty($question['indexArticles'])){foreach ($question['indexArticles'] as $v){?>
            <div class=" tab_service_des" <?php if (isset($_GET['id'])&&($_GET['id']==$v['id'])){ echo "style='display:block'";}else{ echo "style='display:none'";} ?>">
                <?= $v['content'] ?>
            </div>
            <?php }}?>
        </div>
    </div>

<?php $this->beginBlock('test') ?>  
<!-- $('.service_tab').find('.btn_df').click(function(){
	var tab_index=$(this).index();
	$('.service_tab').find('.btn_df').attr('class','btn_df');
	$('this').addClass('btn-color'+tab_index);
	$('.tab_service_des').eq(tab_index).show().siblings('.tab_service_des').hide();
}) -->
setNavActive('<?php echo CmsNav::TYPE_HOMEPAGE?>');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
