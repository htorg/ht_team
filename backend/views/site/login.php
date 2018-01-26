<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
use yii\helpers\Url;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
$bundle=AppAsset::register($this);
?>
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo Yii::t('app', 'Login')?></p>

	<?php $form = ActiveForm::begin(['id' => 'login-form',
	    'fieldConfig'=>[
	        'template'=> "<div class=\"form-group has-feedback\">{input}{hint}</div>\n{error}",
	    ]
	]); ?>
		<?= $form->field($model, 'username')->textInput(['class'=>'form-control login-input','placeholder'=>Yii::t('app', 'Please fill username')]); ?>

		<?= $form->field($model, 'password')->textInput(['class'=>'form-control login-input','placeholder'=>Yii::t('app', 'Please fill password'),'onfocus'=>"this.type='password'"]); ?>

		
		<?= $form->field($model, 'rememberMe')->checkbox()->label('记住密码') ?>
		
		<div class="row">
            <div class="col-xs-12">
            	<?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'login-btn', 'name' => 'login-button']) ?>
            </div>
		</div>

	<?php ActiveForm::end(); ?>



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->