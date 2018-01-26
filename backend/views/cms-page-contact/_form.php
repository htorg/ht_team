<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use backend\assets\MapAsset;
/* @var $this yii\web\View */
/* @var $model common\models\CmsPageContact */
/* @var $form yii\widgets\ActiveForm */
MapAsset::register($this);
?>

<div class="cms-page-contact-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="form-tab tab-1">
        <div class="row">
            <div class="col-md-12 padding-1">
                <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'meta_description')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 padding-1">
                <?php
                $pluginOptions = [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ];
                if (!$model->isNewRecord && !empty($model->wxopenid)) {
                    $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->wxopenid;
                    $pluginOptions['initialPreviewAsData'] = true;
                }
                ?>
                <?= $form->field($model, 'upload_weixin')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
                    'pluginOptions' => $pluginOptions
                ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>

                <?php
                $pluginOptions = [
                    'showPreview' => true,
                    'showCaption' => true,
                    'showRemove' => false,
                    'showUpload' => false,
                ];
                if (!$model->isNewRecord && !empty($model->qq)) {
                    $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->qq;
                    $pluginOptions['initialPreviewAsData'] = true;
                }
                ?>
                <?= $form->field($model, 'upload_weibo')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
                    'pluginOptions' => $pluginOptions
                ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>
                <?= $form->field($model, 'banner_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'weibo')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Your company\'s qq.')) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Your company\'s email.')) ?>
                <?= $form->field($model, 'zipcode')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Your company\'s Zipcode.')) ?>

            </div>
            <div class="col-md-6 pull-right padding-1">
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
                if (!$model->isNewRecord && !empty($model->map_img)) {
                    $pluginOptions['initialPreview'] = \Yii::getAlias('@web').$model->map_img;
                    $pluginOptions['initialPreviewAsData'] = true;
                }
                ?>
                <?= $form->field($model, 'upload_map')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png'],
                    'pluginOptions' => $pluginOptions
                ])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>
                <?= $form->field($model, 'banner_subtitle')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Your company\'s link phone.')) ?>
                <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->hint(Yii::t('app', 'Your company\'s link telephone.')) ?>
                <div class="form-group">
                    <label class="control-label"><?php echo Yii::t('app', 'Address');?></label>
                    <div class="input-group" id="id_address_input">
                        <input type="text" id="cmspagecontact-address" class="form-control" name="CmsPageContact[address]" readonly="" value="<?php echo $model->address?>">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span>
                    </div>
                    <div class="help-block"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 padding-1">
                    <?= $form->field($model, 'contact_desc')->widget('kucha\ueditor\UEditor',[
                        'clientOptions' => [
                            //编辑区域大小
                            'initialFrameHeight' => '200',
                            //定制菜单
                            'toolbars' => [
                                [
                                    'fullscreen', 'source', 'undo', 'redo', '|',
                                    'fontsize',
                                ],
                            ]
                        ]])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Specific content.')); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->beginBlock('test') ?>
var p = $("#id_address_input").AMapPositionPicker({
<?php if (!empty($model->longitude) && !empty($model->latitude) && !empty($model->address)) {?>
    value:{longitude:<?php echo $model->longitude?>, latitude:<?php echo $model->latitude?>, address:'<?php echo $model->address?>'},
<?php }?>
fields: [
{
selector: '#id_lnglat',
name: 'lnglat',
formatter: '{longitude},{latitude}'
}
]
});
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
