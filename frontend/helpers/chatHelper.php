<?php
namespace frontend\helpers;
class ChatHelper {
	const  token="xKo6Btfe8JgDXoJBIQCZurx2o3-713-fY9I2o6NYC8RfT8yeu4Y0moxbjTKIzhMlEOSXj-i-yixGnX7Ykr8BMXF7RCCPSkdAphNaiAOXqOSYEbO4_xUufFb7fKeXbVrVMEJcAAASKP";
	const  data='{ 
		 "button":[ 
		  {  
		   "type":"click", 
		   "name":"今日推荐", 
		   "key":"TODAY_RECOMMEND"
		  }, 		  
		  { 
		   "name":"领券中心", 
		   "sub_button":[ 
		   {  
		    "type":"view", 
		    "name":"今日秒杀", 
		    "url":"http://o.gohoc.com/site/list.html"
		   }, 
		   { 
		    "type":"view", 
		    "name":"新品上架", 
		    "url":"http://o.gohoc.com/site/list.html?rel=2"
		   }, 
			{ 
		    "type":"view", 
		    "name":"热门商品", 
		    "url":"http://o.gohoc.com/site/list.html?rel=1"
		   },
		   { 
		    "type":"click", 
		    "name":"赞一下我们", 
		    "key":"GOOD"
		   }]
		  },
		  { 
		   "type":"click", 
		   "name":"帮助中心", 
		   "key":"GOHOC_HELP"
		  }] 
		}';
	static public function getAccessToken(){
		$query_data=\Yii::$app->params['weixin'];
		$url = "https://api.weixin.qq.com/cgi-bin/token?".http_build_query($query_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);
		$jsoninfo = json_decode($output, true);
		return $jsoninfo["access_token"];
	}
	static public function createMenu(){
			$ch = curl_init();
			$access_token=self::getAccessToken();
			curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, self::data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$tmpInfo = curl_exec($ch);
			if (curl_errno($ch)) {
				return curl_error($ch);
			}		
			curl_close($ch);
			return $tmpInfo;		
	}	
}