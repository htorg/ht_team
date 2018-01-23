<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Update Cms Case Config');
?>

<div class="row">
    <div class="col-md-8">
    <div class="box style_box1">
            <p class="turnBtn_box_title">案例/产品</p>
            <ul class="turnBtn_list clearfix">
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-case-config/update'])?>" class="btn turnBtn_item turnBtn_item_on"><i class="turnBtn_ico">1.</i>产品案例配置</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['case-category/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">2.</i>产品案例列表</a></li>
				<li class="turnBtn_li"><a href="<?php echo Url::toRoute(['case/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">3.</i>产品案例信息</a></li>
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
setSideBarActive('case');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>