<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\UploadFilesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Upload Files');
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo Yii::t('app', 'Upload Files');?></h3>
            </div>
            <div class="box-body ">
                <p>
                    <?= Html::a(Yii::t('app', 'Create Upload Files'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'file_type',
            'src',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true],
                'filterOptions'=>['class'=>'width80']
            ],
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php $this->beginBlock('test') ?>
setSideBarActive('settled');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
