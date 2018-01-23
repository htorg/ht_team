<?php

use yii\helpers\Url;
use common\helpers\SiteHelper;
use common\models\CmsNav;
use common\helpers\UtilHelper;
$bundle = frontend\themes\t00001\OtherAsset::register($this);
?>
<div class="main_df">
        <!--downLoad_banner_wrap-->
        <div class="downLoad_banner_wrap ">
        	<?php if (!empty($model->image_node)){?>
            <img src="<?= SiteHelper::getImgSrc($model->image_node) ?>" alt=""/>
            <?php }else{?>
             <img src="<?= $bundle->baseUrl ?>/img/d_LB02.jpg" alt=""/>
            <?php }?>
        </div>
</div>
<?php $this->beginBlock('test') ?>  
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
