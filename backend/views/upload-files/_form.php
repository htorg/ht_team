<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
$bundle=\backend\assets\AppAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\UploadFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="upload-files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php
    $pluginOptions = [
        'previewFileType'=>'application',
        'allowedPreviewTypes'=>false,
        'showPreview' => true,
        'showCaption' => true,
        'showRemove' => false,
        'showUpload' => false,
    ];
    if (!$model->isNewRecord && !empty($model->src)) {
        $pluginOptions['initialPreview'] = $bundle->baseUrl.'/img/file.png';
        $pluginOptions['initialPreviewAsData'] = true;
    }
    ?>
    <?= $form->field($model, 'upload_file')->widget(FileInput::classname(), ['options' => ['multiple'=>true],
        'pluginOptions' => $pluginOptions
    ])?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
