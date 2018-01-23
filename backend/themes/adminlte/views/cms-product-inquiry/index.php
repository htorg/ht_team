<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Cms Product Inquiries');
?>

<div class="row">
    <div class="col-md-12">
    <div class="box style_box1">
            <p class="turnBtn_box_title">编辑商品</p>
            <ul class="turnBtn_list clearfix">
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-config/update'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">1.</i>商品配置</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-category/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">2.</i>商品分类</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-info/index'])?>" class="btn turnBtn_item "><i class="turnBtn_ico">3.</i>商品信息</a></li>
                <li class="turnBtn_li"><a href="<?php echo Url::toRoute(['cms-product-inquiry/index'])?>" class="btn turnBtn_item turnBtn_item_on"><i class="turnBtn_ico">4.</i>商品询单</a></li>
            </ul>
        </div>
    	<div class="box style_box1">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo Yii::t('app', 'Cms Product Inquiries');?></h3>
                </div>
                <div class="box-body ">
                	<?= GridView::widget([
                        'dataProvider' => $dataProvider,
                	    'tableOptions' => ['class' => 'table table-hover'],
                        'columns' => [
                            'id',
                            [
                                'attribute'=>'product_id',
                                'value' => function($data){
                                    return is_object($data->product)?$data->product->product_name:Yii::t('app', 'Undefined');
                                },
                            ],
                            'inquiry_detail',
                            [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:Y-m-d H:i:s'],
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template'=>'{sku} {user-update} {user-delete}',
                                'buttons'=>[
                                    'user-delete' => function ($url, $model, $key) {
                                      return Html::button(Yii::t('yii', 'Delete'), ['class'=>'btn btn-danger','onclick'=>'if (confirm("'.Yii::t('yii', 'Are you sure you want to delete this item?').'")){window.location.href="'.Url::toRoute(['cms-product-inquiry/delete','id'=>$model->id]).'";}']);
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