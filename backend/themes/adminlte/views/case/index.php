<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Cms Cases');
?>

<div class="row">
    <div class="col-md-12">
    <div class="box style_box1">
            <p class="turnBtn_box_title">案例/产品</p>
            <ul class="turnBtn_list clearfix">
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['case-category/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">1.</i>产品案例列表</a></li>
				<li class="turnBtn_li"><a href="<?php echo Url::toRoute(['case/index'])?>" class="btn turnBtn_item turnBtn_item_on"><i class="turnBtn_ico">2.</i>产品案例信息</a></li>
            </ul>
        </div>
    	<div class="box style_box1">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo Yii::t('app', 'Cms Cases');?></h3>
                </div>
                <div class="box-body ">
                	<p>
                        <?= Html::a(Yii::t('app', 'Create Cms Case'), ['create'], ['class' => 'btn btn-primary']) ?>
                    </p>
                	
                	<?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                	    'tableOptions' => ['class' => 'table table-hover'],
                        'columns' => [
                            'id',
                            [
                                'attribute'=>'image_main',
                                'value' => function($data){
                                    return '<img src="'.\Yii::getAlias('@web').$data->image_main.'" class="thumbnail" width="100" />';
                                },
                                'format'=>'html',
                                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
                            ],
                            [
                                'attribute'=>'category_id',
                                'value' => function($data) use ($categoryMap){
                                    return isset($categoryMap[$data->category_id])?$categoryMap[$data->category_id]:Yii::t('app', 'Undefined');
                                },
                                'filter' => $categoryOptions
                            ],
                            'name',
                            // 'summary',
                            // 'content:ntext',
                            // 'meta_keywords',
                            // 'meta_description',
                            // 'image_main',
                            // 'image_node',
                            [
                                'attribute'=>'status',
                                'value' => function($data) use ($statusMap){
                                    return isset($statusMap[$data->status])?$statusMap[$data->status]:Yii::t('app', 'Undefined');
                                },
                                'filter' => $statusMap
                            ],
                            [
                                'attribute' => 'sort_val',
                                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
                            ],
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                                'filterInputOptions' => ['class' => 'form-control','disabled'=>true]
                            ],
                            // 'updated_at',
                
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{user-update} {user-delete}',
                                'buttons'=>[
                                    'user-update' => function ($url, $model, $key) {
                                      return Html::button(Yii::t('yii', 'Update'), ['class'=>'btn btn-success','onclick'=>'window.location.href="'.Url::toRoute(['case/update','id'=>$model->id]).'";']);
                                    },
                                    'user-delete' => function ($url, $model, $key) {
                                      return Html::button(Yii::t('yii', 'Delete'), ['class'=>'btn btn-danger','onclick'=>'if (confirm("'.Yii::t('yii', 'Are you sure you want to delete this item?').'")){window.location.href="'.Url::toRoute(['case/delete','id'=>$model->id]).'";}']);
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
setSideBarActive('case');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>