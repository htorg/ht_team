<?php
namespace frontend\widgets\FrameBox;

use frontend\models\SetPasswordForm;
use frontend\models\SignupForm;
use yii\base\Widget;
class Register extends Widget{
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $model =  New SignupForm();
        return $this->render('register',['model'=>$model]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}