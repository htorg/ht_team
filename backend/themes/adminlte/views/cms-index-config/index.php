<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helpers\ThemeHelper;
use common\models\CmsConfigType;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use common\models\CmsIndexConfig;
use common\helpers\SiteHelper;
use common\helpers\DataHelper;
$bundle =  backend\themes\adminlte\AppAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel common\models\searchs\CmsIndexConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cms Index Configs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cms-index-config-index">
<div class="cms-index-config-index ht_box">
	<div class='index-config'>
        <p class="ht_title_bar row-df"><label>首页配置项</label></p>
		<ul class='ht_content_box'>						
			<?php foreach ($configs as $key=>$config){?>
			<?php $form = ActiveForm::begin(['action' => ['cms-index-config/create'],'options' => ['enctype' => 'multipart/form-data']]); ?>
			<li class='ht_content_row row-df'><?= ThemeHelper::getFeatureNames($key) ?><i class="choice-image"></i></li>
			<div class='config-info'>
			<?php foreach ($config as $val){?>					
				<?php switch ($val['type']){				
					case CmsConfigType::CONFIG_RADIO :?>								
					<p  class='info-block row-df'> <label><?= $val['name'] ?>：</label>
					<input type="hidden" name="config_id" value="<?= $val['id'] ?>">
						<input type="hidden" name="feature" value="<?= $key ?>">
					<input onchange="setHomeConfig(this,'<?= Url::to(['cms-index-config/create'])?>')" rel=<?= $key  ?>
						<?php if(isset($val['model']->value)&&$val['model']->value==0) echo 'checked=checked' ?>
					  type='radio' config=<?= $val['id'] ?> name=<?= $key.$val['id'] ?> value='0'>启用区域
					<input onchange="setHomeConfig(this,'<?= Url::to(['cms-index-config/create'])?>')" rel=<?= $key  ?>  
						<?php if(isset($val['model']->value)&&$val['model']->value==1) echo 'checked=checked' ?>
					type='radio' config=<?= $val['id'] ?> name=<?= $key.$val['id'] ?> value='1'>隐藏区域</p>
					
					<?php break; case CmsConfigType::CONFIG_INPUT:?>					
					<p class='info-block row-df'> <label><?= $val['name'] ?>：</label><input type="hidden" name="config_id" value="<?= $val['id'] ?>">
						<input type="hidden" name="feature" value="<?= $key ?>">
					<input style="height:30px"onblur="setHomeConfig(this,'<?= Url::to(['cms-index-config/create'])?>')" rel=<?= $key  ?> 
					type='text' config=<?= $val['id'] ?> name=<?= $key.$val['id'] ?>  value="<?php if(isset($val['model']->value)) echo $val['model']->value ?>"></p>						
					
					
					<?php break;case CmsConfigType::CONFGI_IMAGE:?>					
					<p class="info-block row-df" style="border-bottom: none"><label><?= $val['name'] ?>:</label><i class="logo_case"><img style="width: 50px;heigt:50px" src="<?php  if(isset($val['model']->value)) echo SiteHelper::getImgSrc($val['model']->value) ?>"></i></p>
					<div class='row-df image_deal'>
						<input type="hidden" name="config_id" value="<?= $val['id'] ?>">
						<input type="hidden" name="feature" value="<?= $key ?>">
						<?= $form->field($model, 'image')->widget(FileInput::classname(), ['options' => ['accept' => 'image/jpg,image/jpeg,image/png']
	                   ,'name'=>$key])->hint(Yii::t('app', 'File type: ').'jpg\png,'.Yii::t('app', 'File max size: ').' 2MB');?>
                    </div >                                     
                    <?php break;case CmsConfigType::CONFIG_SELECT :?>
                    	<div class="info-block row-df" style="border-bottom: none;height:55px;"><label style="float:left"><?= $val['name'] ?>:</label>
                    	<?php $model->value=$val['model']['value'] ?>
                    	<?= $form->field($model, 'value')->dropDownList($categoryOptions,['prompt'=>Yii::t('app', 'Please select'),
                    			'style'=>'width:20%;'])->label(false) ?>
                    	<input type="hidden" name="config_id" value="<?= $val['id'] ?>">
						<input type="hidden" name="feature" value="<?= $key ?>">
						</div>                                     
				<?php }}?>
			<div class="form-group">      				    				
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
			</div>
			<?php ActiveForm::end(); ?>
			</div>	
			
			<?php }?>
			
		</ul>
	</div>	
</div>
<?php $this->beginBlock('test') ?>  
setSideBarActive('config');
<?php $this->endBlock() ?>  
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>