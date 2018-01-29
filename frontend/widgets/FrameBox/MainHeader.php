<?php
namespace frontend\widgets\FrameBox;

use yii\base\Widget;
class MainHeader extends Widget{
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $pic='';
	    if (!\Yii::$app->user->isGuest){
	        $pic = \Yii::$app->user->getIdentity()->avatar;
        }
		return $this->render('main-header',['pic'=>$pic]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}