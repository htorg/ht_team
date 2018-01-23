<?php
namespace common\helpers;
use common\models\CmsConfigType;
use phpDocumentor\Reflection\Type;
use common\models\CmsIndexConfig;
use backend\helpers\SiteHelper;
use common\taoShare\TopClient;
use common\taoShare\WirelessShareTpwdCreateRequest;
use common\taoShare\GenPwdIsvParamDto;
// +----------------------------------------------------------------------
// | JuhePHP [ NO ZUO NO DIE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2010-2015 http://juhe.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: Juhedata <info@juhe.cn-->
// +----------------------------------------------------------------------

//----------------------------------
// 汇率调用示例代码 － 聚合数据
// 在线接口文档：http://www.juhe.cn/docs/80
//----------------------------------
class ExchangeHelper{
	const TYPE_INCOME_THREE=3;
	const TYPE_INCOME_SIX=6;
	const TYPE_INCOME_TWELVE=12;
	const TYPE_INCOME_TWENTY_FOUR=24;
	const TYPE_INCOME_THIRTY_SIX=36;
	
	/**
	 * 请求接口返回内容
	 * @param  string $url [请求的URL地址]
	 * @param  string $params [请求的参数]
	 * @param  int $ipost [是否采用POST形式]
	 * @return  string
	 */
	static private function juhecurl($url,$params=false,$ispost=0){
		$httpInfo = array();
		$ch = curl_init();
	
		curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
		curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
		curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		if( $ispost )
		{
			curl_setopt( $ch , CURLOPT_POST , true );
			curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
			curl_setopt( $ch , CURLOPT_URL , $url );
		}
		else
		{
			if($params){
				curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
			}else{
				curl_setopt( $ch , CURLOPT_URL , $url);
			}
		}
		$response = curl_exec( $ch );
		if ($response === FALSE) {
			//echo "cURL Error: " . curl_error($ch);
			return false;
		}
		$httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
		$httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
		curl_close( $ch );
		return $response;
	}
		
	//************1.常用汇率查询************
	static public function getExchange(){
		$url = "http://op.juhe.cn/onebox/exchange/query";
		$params = array(
				"key" => \Yii::$app->params['appkey'],
		);
		$paramstring = http_build_query($params);
		$content = self::juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//**************************************************
	

	//************2.货币列表************
	static public function getExchangeList(){
		$url = "http://op.juhe.cn/onebox/exchange/list";
		$params = array(
				"key" => \Yii::$app->params['appkey'],
		);
		$paramstring = http_build_query($params);
		$content = self::juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//**************************************************
	
			
	//************3.实时汇率查询换算************
	static public function getExchangeCurrency(){
		$url = "http://op.juhe.cn/onebox/exchange/currency";
		$params = array(
				"from" => "",//转换汇率前的货币代码
				"to" => "",//转换汇率成的货币代码
				"key" => \Yii::$app->params['appkey'],
		);
		$paramstring = http_build_query($params);
		$content = self::juhecurl($url,$paramstring);
		$result = json_decode($content,true);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	
	//**********4.淘客领券数据查询***************
	static public function getTaokeInfo(){
		$config_id=CmsConfigType::find()->select('id')->where(['feature'=>'10002','code'=>'appkey'])->asArray()->one();
		$appkey=CmsIndexConfig::find()->select('value')->where(['config_id'=>$config_id])->limit(1)->asArray()->one();
		$url='http://api.dataoke.com/index.php';
		$params=array(
				'r'=>'goodsLink/www',
				'type'=>'www_quan',
				'appkey'=>$appkey['value'],
				'v'=>2
		);
		$content = self::juhecurl($url,http_build_query($params));
		$result = json_decode($content,true);
		if($result){
			return $result;
		}else{
			return false;
		}
	}
	//**********5.淘口令生成*******************
	static public function getTaoShare($logo,$url,$text,$user_id){
		$c = new TopClient();
		$c->appkey = '23814172';
		$c->secretKey = 'fbb306e390e280eefa3e523d4fa3acf1';
		$req = new WirelessShareTpwdCreateRequest();
		$tpwd_param = new GenPwdIsvParamDto();
		$tpwd_param->ext="{\"xx\":\"xx\"}";
		$tpwd_param->logo=$logo;
		$tpwd_param->url=$url;
		$tpwd_param->text=$text;
		$tpwd_param->user_id=$user_id;
		$req->setTpwdParam(json_encode($tpwd_param));
		$resp = $c->execute($req);
		return $resp;
	}
	
	//*********6.模板11收益表*******************
	static public function getIncome($type=1,$time,$money_range){
		if($type==1){
			$incomes=\Yii::$app->params['income_Military'];
			foreach ($incomes as $key=>$income_info){
				if($key==$money_range){
					switch ($time){
						case self::TYPE_INCOME_THREE:
							return $income_info[self::TYPE_INCOME_THREE]/12*self::TYPE_INCOME_THREE;
						case self::TYPE_INCOME_SIX:
							return $income_info[self::TYPE_INCOME_SIX]/12*self::TYPE_INCOME_THREE;
						case self::TYPE_INCOME_TWELVE:
							return $income_info[self::TYPE_INCOME_TWELVE];
						case self::TYPE_INCOME_TWENTY_FOUR:
							return $income_info[self::TYPE_INCOME_TWENTY_FOUR];
						case self::TYPE_INCOME_THIRTY_SIX:
							return ($income_info[self::TYPE_INCOME_THIRTY_SIX]+0.03);
						default:return '';
					}
				}	
			}
		}else if($type=2){
			$incomes=\Yii::$app->params['income_Bonds'];
			if(isset($incomes[$money_range])){
				return $incomes[$money_range];
			}else{
				return false;
			}				
		}
	}
	
	
}