<?php 
// doc link https://apidocs.klaviyo.com/reference/api-overview

class klaviyoSQB{ 
	
	 private $api_key;
     private $api_url = 'https://a.klaviyo.com/api/v2/';
   
     
     /**
     * Set api token 
     * @param      $api_key
     */
     public function __construct($api_key){
        $this->api_key = $api_key;
     }
     
     public function getLists(){
		
		$mehtod_url = $this->api_url.'lists?api_key='.$this->api_key;
		
		$lists_info =  $this->call($mehtod_url,'GET');
		
		$lists_data = null;
		if(is_array($lists_info) && count($lists_info)){
			$lists_data = $lists_info;
		}
		return $lists_data;
     }
     
     
     public function register($email = '', $name = '', $params = '', $customFields = ''){
		 
		 $params = explode ( ":", $params );	
		 
		 $list_id = '';
		 if(isset($params[2])){
			$list_id = $params[2];
		  }
		 
		 if(isset($params[3]) && $params[3] != ''){
				$tag =  $params[3]; 
		 }
		
		 
		 $params = json_encode(array('profiles'=>array(					
										'email' => $email)
								));
				
		 $mehtod_url = $this->api_url.'list/'.$list_id.'/members?api_key='.$this->api_key;
		
		 //echo $mehtod_url;
		return $this->call($mehtod_url,'POST',$params);
     }
     
     
     private function call($url = null, $http_method = 'GET', $params = ''){
		
		 try {
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_URL, $url);
			
			if($http_method == 'POST'){
				curl_setopt($curl, CURLOPT_POST, true);
			}
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

			$headers = array(
			   "Accept: application/json",
			   "Authorization: Bearer ".$this->api_key,
			);
			if($http_method == 'POST'){
			$headers = array(
				   "Accept: application/json",
				   "Authorization: Bearer ".$this->api_key,
				   "Content-Type: application/json",
				);
			}
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			
			if($http_method == 'POST'){
				curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
			}
			
			

			$response = curl_exec($curl);
			$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			curl_close($curl);
			if($httpCode == "200"){
				return json_decode($response,true);
			}
			return null;
			
			
		 }catch (PDOException $e) {
			
			return null;
			
		} catch (Exception $e) {
			
			return null;
		}
	 }
}
