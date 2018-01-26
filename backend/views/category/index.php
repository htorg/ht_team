<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
	<div class="col-md-12">
		<div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo Yii::t('app', 'Category list');?></h3>
            </div>
            <div class="box-body ">
            	<p>
                    <?= Html::a(Yii::t('app', 'Create Category'), ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
                </p>
            	
              <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-hover'],
                'columns' => [
                    [
                        'attribute'=>'parent_id',
                        'value' => function($data) use ($categoryMap){
                            return isset($categoryMap[$data->parent_id])?$categoryMap[$data->parent_id]:Yii::t('app', 'Top category');
                        },
                        'filter' => $categoryOptions,
                        'filterOptions'=>['class'=>'width80']
                    ],
                     [
                        		'attribute'=>'name',	
                        		'filterOptions'=>['class'=>'width100']
                    ],
                    [
                        'attribute'=>'status',
                        'value' => function($data) use ($statusMap){
                            return isset($statusMap[$data->status])?$statusMap[$data->status]:Yii::t('app', 'Undefined');
                        },
                        'filter' => $statusMap,
                        'filterOptions'=>['class'=>'width80']
                    ],
                    [
                        'attribute' => 'sort_val',
                        'filterInputOptions' => ['class' => 'form-control','disabled'=>true],
                    		'filterOptions'=>['class'=>'width20']
                    ],
                    [
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:Y-m-d H:i:s'],
                        'filterInputOptions' => ['class' => 'form-control','disabled'=>true],
                    		'filterOptions'=>['class'=>'width80']
                    ],
                    [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{user-update} {user-delete}',
                            'buttons'=>[
                                'user-update' => function ($url, $model, $key) {
                                  return Html::button(Yii::t('yii', 'Update'), ['class'=>'btn btn-other btn-success','onclick'=>'window.location.href="'.Url::toRoute(['category/update','id'=>$model->id]).'";']);
                                },
                                'user-delete' => function ($url, $model, $key) {
                                  return Html::button(Yii::t('yii', 'Delete'), ['class'=>'btn btn-other btn-danger','onclick'=>'if (confirm("'.Yii::t('yii', 'Are you sure you want to delete this item?').'")){window.location.href="'.Url::toRoute(['category/delete','id'=>$model->id]).'";}']);
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
setSideBarActive('category');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>