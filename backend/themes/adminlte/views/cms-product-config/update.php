<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Update Cms Product Config');
?>

<div class="row">
    <div class="col-md-12">
    <div class="box style_box1">
            <p class="turnBtn_box_title">编辑商品</p>
            <ul class="turnBtn_list clearfix">
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-config/update'])?>" class="btn turnBtn_item turnBtn_item_on"><i class="turnBtn_ico">1.</i>商品配置</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-category/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">2.</i>商品分类</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-info/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">3.</i>商品信息</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-inquiry/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">4.</i>商品询单</a></li>
            </ul>
        </div>
    	<div class="box style_box1">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="box-body ">
                	<?= $this->render('_form', [
                        'model' => $model,
                    ]) ?>
                </div>
                <!-- /.box-body -->
              </div>
    </div>
</div>

<?php $this->beginBlock('test') ?>  
setSideBarActive('product');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>