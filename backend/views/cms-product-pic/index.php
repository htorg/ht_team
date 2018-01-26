<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsProductPicSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Product Pics');
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo Yii::t('app', 'Cms Product Pics');?></h3>
            </div>
            <div class="box-body ">
                <p>
                    <?= Html::a(Yii::t('app', 'Create Product Pics'), ['create','product_id'=>$searchModel->product_id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a(Yii::t('app', 'Back to Product'), ['cms-product/index'], ['class' => 'btn btn-success']) ?>

                </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'product_id',
            [
                'attribute'=>'sub_banner',
                'value' => function($data){
                    return '<img src="'.\Yii::getAlias('@web').$data->sub_banner.'" class="thumbnail" width="100" />';
                },
                'format'=>'html',
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
            ],
            //'info_title1',
            [
                'attribute'=>'info_img1',
                'value' => function($data){
                    return '<img src="'.\Yii::getAlias('@web').$data->info_img1.'" class="thumbnail" width="100" />';
                },
                'format'=>'html',
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
            ],
            [
                'attribute'=>'info_img2',
                'value' => function($data){
                    return '<img src="'.\Yii::getAlias('@web').$data->info_img2.'" class="thumbnail" width="100" />';
                },
                'format'=>'html',
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
            ],
            [
                'attribute'=>'info_img3',
                'value' => function($data){
                    return '<img src="'.\Yii::getAlias('@web').$data->info_img3.'" class="thumbnail" width="100" />';
                },
                'format'=>'html',
                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
            ],
            //'info_img2',
            //'info_title2',
            //'info_img3',
            //'info_title3',
            //'show_pics:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>

<?php $this->beginBlock('test') ?>
setSideBarActive('products');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
