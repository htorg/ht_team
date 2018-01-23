<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = Yii::t('app', 'Update Cms Service Config');
?>

<div class="row">
    <div class="col-md-8">
    <div class="box style_box1">
            <p class="turnBtn_box_title">服务范围</p>
            <ul class="turnBtn_list clearfix">
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-service-config/update'])?>" class="btn turnBtn_item turnBtn_item_on"><i class="turnBtn_ico">1.</i>服务范围配置</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-service/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">2.</i>服务范围列表</a></li>          
            </ul>
        </div>
    	<div class="box box-success">
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
setSideBarActive('service');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>