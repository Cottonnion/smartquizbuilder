<?php 

// doc link https://developers.vbout.com/docs#emailmarketing_addcontact


class vboutSQB{
	
	 private $api_key;
     private $api_url = 'https://api.vbout.com/1/emailmarketing/';
    
     
     /**
     * Set api token 
     * @param      $api_key
     */
     public function __construct($api_key){
        $this->api_key = $api_key;
     }
     
     public function getLists(){
		 $params = array(
				'key' => $this->api_key,
				'rand' => time(),
				'limit' => 100
		 );
			
		$mehtod_url = $this->api_url.'getlists.json?'.http_build_query($params);
		
		$lists_info =  $this->call($mehtod_url,'GET','');

		$lists_data = null;
		
		if(isset($lists_info['response']['data']['lists']['items']) && count($lists_info['response']['data']['lists']['items'])){
			$lists_data = $lists_info['response']['data']['lists']['items'];
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
		
		$params = array(
			   'key' => $this->api_key,
			   'listid' => $list_id,
			   'email' => $email,
			   'status' => 'active',
		);		
		
		$mehtod_url = $this->api_url.'addcontact.json?'.http_build_query($params);			
		$contact = $this->call($mehtod_url,'GET',$params);
		
		if(!empty($tag)){
			$newparams = array(
			   'key' => $this->api_key,
			   'listid' => $list_id,
			   'email' => $email,
			   'tagname' => $tag,
			);	
			$url = $this->api_url.'addtag.json?'.http_build_query($newparams);
			$tag = $this->call($url,'POST',$newparams);
		}

		return $contact;
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

