<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\ServicesInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-info-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
    $pluginOptions = [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
    ];
    if (!$model->isNewRecord && !empty($model->banner)) {
        $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->banner;
        $pluginOptions['initialPreviewAsData'] = true;
    }
    ?>
    <?= $form->field($model, 'upload_banner')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
        'pluginOptions' => $pluginOptions
    ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB')?>

    <?= $form->field($model, 'banner_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'banner_subtitle')->textInput(['maxlength' => true]) ?>

    <?php
    $pluginOptions = [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
    ];
    if (!$model->isNewRecord && !empty($model->settled_image)) {
        $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->settled_image;
        $pluginOptions['initialPreviewAsData'] = true;
    }
    ?>
    <?= $form->field($model, 'upload_settled_image')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
        'pluginOptions' => $pluginOptions
    ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB')?>

    <?= $form->field($model, 'settled_summary')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //定制菜单
            'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',

                ],
            ]
        ]])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Specific content.')); ?>
    <?= $form->field($model, 'settled_desc')->widget('kucha\ueditor\UEditor',[
        'clientOptions' => [
            //编辑区域大小
            'initialFrameHeight' => '200',
            //定制菜单
            'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',

                ],
            ]
        ]])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Specific content.')); ?>

    <?= $form->field($model, 'platform_config1')->textInput(['maxlength' => true])->hint('标题与描述用 # 隔开') ?>

    <?= $form->field($model, 'platform_config2')->textInput(['maxlength' => true])->hint('标题与描述用 # 隔开') ?>

    <?= $form->field($model, 'platform_config3')->textInput(['maxlength' => true])->hint('标题与描述用 # 隔开') ?>

    <?php
    $pluginOptions = [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
    ];
    if (!$model->isNewRecord && !empty($model->platform_image)) {
        $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->platform_image;
        $pluginOptions['initialPreviewAsData'] = true;
    }
    ?>
    <?= $form->field($model, 'upload_platform_image')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
        'pluginOptions' => $pluginOptions
    ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB')?>

    <?php
    $pluginOptions = [
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
        'maxFileCount' => 5
    ];
    if (!$model->isNewRecord && !empty($srcs)) {
        $pluginOptions['initialPreview'] = $srcs['srcs'];

        // 需要展示的图片设置，比如图片的宽度等
        $pluginOptions['initialPreviewConfig'] = ['width' => '120px'];
        // 是否展示预览图
        $pluginOptions['initialPreviewAsData'] = true;

    }
    ?>
    <?= $form->field($model, 'upload_banners[]')->widget(FileInput::classname(), ['options' => ['multiple'=>true, 'accept' => 'image/jpg,image/jpeg,image/png'],
        'pluginOptions' => $pluginOptions
    ])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
