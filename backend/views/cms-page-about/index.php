<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsPageAboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Page Abouts');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo Yii::t('app', 'Cms Page Abouts');?></h3>
                </div>
                <div class="box-body ">
                    <p>
                        <?= Html::a(Yii::t('app', 'Create Page About'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'banner',
                            'banner_title',
                            'banner_subtitle',
                            'company_name',
                            //'company_desc:ntext',
                            //'shareholder_title',
                            //'shareholder_detail',
                            //'Strategic_title',
                            //'Strategic_detail',
                            //'info_main_title',
                            //'info_subtitle',
                            //'info_desc1',
                            //'info_desc2',
                            //'info_desc3',
                            //'shareholder_info_title',
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