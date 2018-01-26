<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsCompanyHonorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Company Honors');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo Yii::t('app', 'Cms Company Honors');?></h3>
            </div>
            <div class="box-body ">
                <p>
                    <?= Html::a(Yii::t('app', 'create Company Honor'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        [
                            'attribute'=>'type',
                            'value'=>function($data){
                                return \common\models\CmsCompanyHonor::getHonorType($data->type);
                            }
                        ],
                        //'honor:ntext',
                        'link',
                        [
                            'attribute' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'filterOptions'=>['class'=>'width80'],
                            'filterInputOptions' => ['class' => 'form-control ','disabled'=>true]
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
setSideBarActive('about');
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
