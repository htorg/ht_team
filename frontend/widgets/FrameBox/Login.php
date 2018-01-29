<?php
namespace frontend\widgets\FrameBox;

use frontend\models\LoginForm;
use yii\base\Widget;
class Login extends Widget{
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $model =  New LoginForm();
		return $this->render('login',['model'=>$model]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}