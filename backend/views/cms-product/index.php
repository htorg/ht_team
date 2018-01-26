<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Products');
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo Yii::t('app', 'Cms Products');?></h3>
            </div>
            <div class="box-body ">
                <p>
                    <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute'=>'type',
                'value'=>function($data){
                    return \common\models\CmsProduct::getProductType($data->type);
                }
            ],
            //'banner',
            //'banner_title',
            //'banner_subtitle',
            'main_title',
            'second_title',
            //'product_detail:ntext',
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true],
                'filterOptions'=>['class'=>'width80']
            ],
            //'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{info} {pic} {update} {delete}',
                'buttons'=>[
                    'info'=> function ($url, $model, $key) {
                        return Html::button(Yii::t('app', 'Cms Product info'), ['class'=>'btn btn-info','onclick'=>'window.location.href="'.Url::toRoute(['cms-product-info/index','product_id'=>$model->id]).'";']);
                    },
                    'pic' => function ($url, $model, $key) {
                        return Html::button(Yii::t('app', 'Cms Product pics'), ['class'=>'btn btn-info','onclick'=>'window.location.href="'.Url::toRoute(['cms-product-pic/index','product_id'=>$model->id]).'";']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::button(Yii::t('yii', 'Update'), ['class'=>'btn btn-success','onclick'=>'window.location.href="'.Url::toRoute(['cms-product/update','id'=>$model->id]).'";']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::button(Yii::t('yii', 'Delete'), ['class'=>'btn btn-danger','onclick'=>'if (confirm("'.Yii::t('yii', 'Are you sure you want to delete this item?').'")){window.location.href="'.Url::toRoute(['cms-product/delete','id'=>$model->id]).'";}']);
                    },
                ]
            ],
        ],
    ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php $this->beginBlock('test') ?>
setSideBarActive('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
