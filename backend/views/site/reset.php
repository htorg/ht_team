<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\CmsPageContact */

$this->title = Yii::t('app', 'Update User');
?>
<div class="row">
    <div class="col-md-6">
    	<div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="box-body ">
                	<div class="user-form">

                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','id'=>'reset-form']]); ?>

                        <?= $form->field($model, 'username')->textInput(['maxlength' => true, 'style'=>'width:50%;'])->hint(Yii::t('app', 'Required').', '.Yii::t('app', 'Please fill username')) ?>

                        <?= $form->field($model, 'newpwd1')->textInput(['style'=>'width:50%;','onfocus'=>"this.type='password'"])->hint(Yii::t('app', 'Please fill password'))->label('新密码'); ?>

                        <?= $form->field($model, 'newpwd2')->textInput(['style'=>'width:50%;','onfocus'=>"this.type='password'"])->hint(Yii::t('app', 'Please fill password'))->label('确认密码'); ?>
                    <?php ActiveForm::end(); ?>
                        <div class="form-group">
                            <?= Html::button(Yii::t('app', 'Save'), ['class' => 'btn btn-success','id'=>'register']) ?>
                        </div>
                </div>
                </div>
                <!-- /.box-body -->
              </div>
    </div>
</div>
<?php $this->beginBlock('test') ?>
setSideBarActive('user');
$('#register').click(function(){
        if($('#user-newpwd1').val()!=$('#user-newpwd2').val()){
            alert('两次输入的密码不一致');
            return false;
        }
        console.log($('#user-newpwd2').val());
        $.post(
        '<?php echo \yii\helpers\Url::toRoute(['site/reset'])?>',
        {
            password:$('#user-newpwd2').val()
        },
        function (data){
            if(data.c==0){
                location.href="<?= \yii\helpers\Url::to(['site/logout'])?>"
            }
                console.log(data);
                alert(data.msg);
        },
        'json'
        );
    })
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>