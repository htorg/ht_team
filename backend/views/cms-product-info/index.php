<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsProductInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Product Infos');
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo Yii::t('app', 'Cms Product Infos');?></h3>
            </div>
            <div class="box-body ">
                <p>
                    <?= Html::a(Yii::t('app', 'Create Product Infos'), ['create','product_id'=>$searchModel->product_id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Back to Product'), ['cms-product/index'], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        //'product_id',
                        //'main_image',
                        'main_name',
                        //'main_description:ntext',
                        //'address',
                        //'property_area',
                        //'available_area',
                        //'property_properties',
                        //'price',
                        //'node_image',
                        'node_name',
                        //'node_description:ntext',
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
setSideBarActive('product');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
