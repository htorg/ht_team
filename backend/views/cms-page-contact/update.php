<?php

use yii\helpers\Html;
use common\models\CmsPageContact;

/* @var $this yii\web\View */
/* @var $model common\models\CmsPageContact */

$this->title = Yii::t('app', 'Update Page Contact');
?>
    <div class="row">
        <div class="col-md-8">
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
<?php if ($model->type==CmsPageContact::TYPE_COMPANY){?>
    setSideBarActive('about');
<?php }else{?>
    setSideBarActive('settled');
<?php }?>
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>