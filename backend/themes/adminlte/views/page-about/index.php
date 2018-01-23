<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsPageAboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Page Abouts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
	<div class="col-md-12">
		<div class="box style_box1">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->title ?></h3>
            </div>
            <div class="box-body ">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'tableOptions' => ['class' => 'table table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'lang_id',
            //'site_id',
            'company_name',
        	[
        		'label'=>'导航名称',
        		'attribute'=>'nav_id',
        		'value' => function($data) use ($nav){
                           	foreach ($nav as $val) {
                           		if($val->ext_id==$data->id){
                           			return $val->name;
                           		}else{
                           			return Yii::t('app', 'Undefined');
                           		}
                           	}
                        },
        	],
            // 'company_slogan',
            // 'company_keywords',
            // 'company_idea',
            // 'company_wish',
            // 'company_culture',
            // 'banner',
            // 'top_banner_name',
            // 'top_banner_desc',
            // 'homepage_name',
            // 'more_btn_name',
            // 'homepage_left_pic',
            // 'status',
            // 'created_at',
            // 'updated_at',
            // 'nav_id',

             [
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{user-update} {user-delete}',
                            'buttons'=>[
                                'user-update' => function ($url, $model, $key) {
                                  return Html::button(Yii::t('yii', 'Update'), ['class'=>'btn btn-success','onclick'=>'window.location.href="'.Url::toRoute(['page-about/update','id'=>$model->id]).'";']);
                                },
                                'user-delete' => function ($url, $model, $key) {
                                  return Html::button(Yii::t('yii', 'Delete'), ['class'=>'btn btn-danger','onclick'=>'if (confirm("'.Yii::t('yii', 'Are you sure you want to delete this item?').'")){window.location.href="'.Url::toRoute(['page-about/delete','id'=>$model->id]).'";}']);
                                },
                            ]
                        ],
        ],
    ]); ?>
                    </div>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>