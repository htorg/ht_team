<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsPageContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Page Contacts');
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo Yii::t('app', 'Cms Page Contacts');?></h3>
                </div>
                <div class="box-body ">
                    <p>
                        <?= Html::a(Yii::t('app', 'Create Page Contact'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'phone',
                        'telephone',
                        'longitude',
                        'latitude',
                        //'address',
                        //'map_img',
                        //'email:email',
                        //'qq',
                        //'zipcode',
                        //'wxopenid',
                        //'weibo',
                        //'banner',
                        //'banner_title',
                        //'banner_subtitle',
                        //'created_at',
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