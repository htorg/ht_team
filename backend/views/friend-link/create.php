<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FriendLink */

$this->title = Yii::t('app', 'Create Friend Link');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Friend Links'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
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
setSideBarActive('friendlink');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>