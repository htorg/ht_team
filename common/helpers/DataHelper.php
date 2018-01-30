<?php
namespace common\helpers;

use yii\helpers\ArrayHelper;
use common\models\CmsCategory;
use yii\base\Object;
Class DataHelper{

	static public function getCategoryMap($model='')
	{
		if(empty($model)){
			$model=new CmsCategory();
		}
		$categoryMap = ArrayHelper::map($model::find()->all(), 'id', 'name');
		return $categoryMap;
	}
	static public function deleteCache()
	{
		CacheHelper::deleteCache('topCategorys');
		CacheHelper::deleteCache('categoryOptions');
	}
	static public function getCategoryOptions($hasTop=FALSE,$model='')
	{
		if(empty($model)){
			$model=new CmsCategory();
		}
		\Yii::$app->cache->flush();
		$categoryOptions = CacheHelper::getCache('categoryOptions');
		if (empty($categoryOptions))
		{
			if(!$hasTop){
				$categoryOptions = self::getSubCategorys([],0,0,3,false,$model);
			}else{
				$categoryOptions = self::getSubCategorys([],0,0,3,true,$model);
			}			
			CacheHelper::setCache('categoryOptions',$categoryOptions);
		}
		return $categoryOptions;
	}
	static public function getSubCategorys($options = [], $pid = 0, $level = 0,$maxlevel=0,$hasTop=FALSE,$model)
	{
		$level++;
	
		if (!empty($maxlevel))
		{
			if ($level >= $maxlevel)
			{
				return $options;
			}
		}
	
		$categorys =$model::find()->where('parent_id=:pid',[':pid'=>$pid])->all();
		if (count($categorys) > 0)
		{
			foreach ($categorys as $c)
			{
				if(!$hasTop){
					$options[$c->id] = self::getLevelLine($level).' '.$c->name;
				}
				$options = self::getSubCategorys($options, $c->id, $level, $maxlevel,false,$model);
			}
		}
	
		return $options;
	}
	static public function getLevelLine($level)
	{
		$s = '';
		for ($i=1;$i<=$level;$i++)
		{
			$s .= '--';
		}
	
		return $s;
	}
	static public function get_order_sn()
	{
		/* 选择一个随机的方案 */
		$yCode = array('A','B','C','D','E','F','G','H','I','J','L','M','N');
		$order_sn = $yCode[intval(date('Y'))-2011]. strtoupper(dechex(date('m'))). date('d'). substr(time(),-5). substr(microtime(),2,5). sprintf('%02d', rand(0,99)).rand(1000,9999);
		$count=IntegralRecord::find()->Where(['serial_number'=>$order_sn])->count();
		if($count>0){
			self::get_order_sn();
		}
		return $order_sn;
	}
	static public function getImgSrc($pic){
            return \Yii::getAlias('@upload').$pic;
    }
    static public function getUserAvatar($pic){
	    if (empty($pic)){
	        return \Yii::getAlias('@web').'/img/ico_user.png';
        }
        return \Yii::getAlias('@web').$pic;
    }
}