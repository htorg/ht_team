<?php
namespace frontend\widgets\FrameBox;

use frontend\models\LoginForm;
use yii\base\Widget;
class Login extends Widget{
    public $url;
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $model =  New LoginForm();
		return $this->render('login',['model'=>$model,'url'=>$this->url]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}