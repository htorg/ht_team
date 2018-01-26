<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\CmsPageAbout */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-about-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="form-tab tab-1">
        <div class="row">
            <div class="col-md-6 padding-1">
                <?= $form->field($model, 'banner_title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'banner_subtitle')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'info_main_title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'info_subtitle')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6 pull-right padding-1">

                <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'shareholder_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'Strategic_title')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 padding-1">
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

                <?php
                $pluginOptions = [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ];
                if (!$model->isNewRecord && !empty($model->Strategic_detail)) {
                    $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->Strategic_detail;
                    $pluginOptions['initialPreviewAsData'] = true;
                }
                ?>
                <?= $form->field($model, 'upload_strategic')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
                    'pluginOptions' => $pluginOptions
                ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>

                <?php
                $pluginOptions = [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ];
                if (!$model->isNewRecord && !empty($model->shareholder_detail)) {
                    $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->shareholder_detail;
                    $pluginOptions['initialPreviewAsData'] = true;
                }
                ?>
                <?= $form->field($model, 'upload_shareholder')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
                    'pluginOptions' => $pluginOptions
                ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>
                <?= $form->field($model, 'info_desc1')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'info_desc2')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'info_desc3')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'company_desc')->widget('kucha\ueditor\UEditor')->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Specific content.')); ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
