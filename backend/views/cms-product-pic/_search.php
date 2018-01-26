<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\searchs\CmsProductPicSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-product-pic-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'sub_banner') ?>

    <?= $form->field($model, 'info_img1') ?>

    <?= $form->field($model, 'info_title1') ?>

    <?php // echo $form->field($model, 'info_img2') ?>

    <?php // echo $form->field($model, 'info_title2') ?>

    <?php // echo $form->field($model, 'info_img3') ?>

    <?php // echo $form->field($model, 'info_title3') ?>

    <?php // echo $form->field($model, 'show_pics') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
