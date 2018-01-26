<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\CmsCompanyHonor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-company-honor-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
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
    ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>

    <?= $form->field($model, 'banner_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'banner_subtitle')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'honor_country')->textarea(['rows' => 10]) ?>
    <?= $form->field($model, 'honor_provice')->textarea(['rows' => 10]) ?>

    <?= $form->field($model, 'link_country')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'link_provice')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
