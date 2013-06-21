<?php
/*
Oauth 2.0 permission to be implemented.

https://instagram.com/oauth/authorize/?client_id=f1a857b290fc43ec962d238642a41538&redirect_uri=http://www.isotopic.com.br&response_type=token

...redirects to:

http://www.isotopic.com.br/#access_token=659895.f1a857b.e31423dab3684deb809f0511ce4fa892

CLIENT ID	f1a857b290fc43ec962d238642a41538
CLIENT SECRET	b38841eec1ea47d99fd048ab3977032f
*/


if (!function_exists('curl_init')) {
  throw new Exception('This class needs the CURL PHP extension.');
}
if (!function_exists('json_decode')) {
  throw new Exception('This class needs the JSON PHP extension.');
}

class Instagram{

	private $key = "";
	private $secret = "";
	private $token = "";
	
	function __construct($key, $secret) {  

		$this->key = $key;            
		$this->secret = $secret;  
		//$this->token = $this->getToken($key, $secret);

	}

	private function getToken($_key, $_secret){
		//To be implemented
	}


	public function getRecentTag($base_tag=''){
		$arrayout = array();
		//Tag default para busca
	    $tag = ($base_tag=='' ? "coding" : $base_tag);
	    //set the url to use
	    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$this->key;
		//curls
	    $ch = curl_init();

	    $headers = array();
	    $headers[] = 'Content-type: application/json';
	    $headers[] = 'X-HTTP-Method-Override: GET';
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, in_array($_SERVER['HTTP_HOST'], array("localhost","127.0.0.1")) ? false : true);
	    curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)');
	    $response = curl_exec($ch);
		//echo curl_error($ch);


	    if($response === false || curl_error($ch)) {
	        curl_close($ch);
	        return false;
	    } else {
	        curl_close($ch);
	       //Testa erro no retorno json
			$response_decoded = json_decode($response, true);
			if (isset($response_decoded["error_type"])){
				return false;
			}else{
				return $response_decoded;
			}
	    }
	}





}

?>