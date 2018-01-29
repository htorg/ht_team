<?php
namespace frontend\widgets\FrameBox;

use frontend\models\SetPasswordForm;
use yii\base\Widget;
class Reset extends Widget{
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $model =  New SetPasswordForm();
        return $this->render('reset',['model'=>$model]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}