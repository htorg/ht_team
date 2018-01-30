<?php
namespace frontend\widgets\FrameBox;

use yii\base\Widget;
class AuthBar extends Widget{
	public function init()
	{
		parent::init();
	
		$this->registerAsset();
	}
	public function run(){
	    $pic = '';
	    $username= '';
	    if (!\Yii::$app->user->isGuest){
	        $username = \Yii::$app->user->getIdentity()->nickname;
	        $pic = \Yii::$app->user->getIdentity()->avatar;
        }
		return $this->render('auth-bar',['pic'=>$pic,'username'=>$username]);
	}
	public function registerAsset() {
		$view = $this->getView();
	}
}