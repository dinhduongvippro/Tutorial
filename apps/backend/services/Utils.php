<?php
namespace Modules\Backend\Services;

class Utils{

	public static function getJson($url) {
		$curl = curl_init ();
		curl_setopt_array ( $curl, array (
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT => 15,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		$json = curl_exec ( $curl );
		curl_close ( $curl );
		return json_decode ( $json, true );
	}
	public static function getJsonPost($url, $data_post) {
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_post);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec ($ch);
	    $response = json_decode($response,true);
	    curl_close ($ch);
	    return $response;
		
	}
	public static function randomToken($n){
		$string = implode(range('A','Z')).implode(range('a','z')).implode(range(0,9));
		for ($i = 0; $i < $n; $i++) {
			$randomKey = mt_rand(0, strlen($string)-1);
			$token .= $string[$randomKey];
		}
		return $token."!";
	}
	public static function status($status) {
		$result = '';
		switch ($status){
			case 1: $result = "ACTIVE";break;
			case 2: $result = "INACTIVE";break;
			case 3: $result = "DELETED";break;
			case 4: $result = "LOCKED";break;
			case 5: $result = "TRIAL";break;
		}
		return $result;
	}
	public static function status_action_location($status) {
		$result = '';
		switch ($status){
			case 1: $result = "LIVE";break;
			case 2: $result = "SANDBOX";break;
		}
		return $result;
	}
	public static function isValidURL($url)
	{
		return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*
        (:[0-9]+)?(/.*)?$|i', $url);
	}
}