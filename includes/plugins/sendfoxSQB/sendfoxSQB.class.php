<?php
class sendfoxSQB{
	
	 private $api_token;
     private $api_url = 'https://api.sendfox.com/';
     private $api_list_url = 'https://api.sendfox.com/lists';
     
     /**
     * Set api token 
     * @param      $api_token
     */
     public function __construct($api_token){
        $this->api_token = $api_token;
     }
     
     public function getLists(){
		$mehtod_url = $this->api_list_url;
	    $lists_data = null;
		$lists =  $this->call($mehtod_url,'GET');
		if(isset($lists) && is_object($lists) && isset($lists->next_page_url)){
				$this->api_list_url =  $lists->next_page_url;
				$lists_data = $this->getList($lists->data);
				
		}else if(isset($lists)){
			
			 $lists_data = $lists->data;
		}
		return $lists_data;
     }
     
     public function getList($lists_data_old){
		$mehtod_url = $this->api_list_url;
		$lists =  $this->call($mehtod_url,'GET');
		
		if(isset($lists) && is_object($lists) && isset($lists->next_page_url)){
				$this->api_list_url =  $lists->next_page_url;
				$lists_data_old = array_merge($lists_data_old,$lists->data);
				$lists_data = $this->getList($lists_data_old);
				
				
		}else if(isset($lists)){
			
			 $lists_data = $lists->data;
			  $lists_data = array_merge($lists_data_old,$lists_data);
		}
	
		return $lists_data;
     }
     
     public function register($email = '', $name = '', $params = '', $customFields = ''){
		 
		 $params = explode ( ":", $params );	
		 
		 $list_id = $params[2];
		 
		 if(isset($params[3]) && $params[3] != ''){
				$tag =  $params[3]; 
		 }
		 
		 $params = json_encode(array(					
					'email' => $email,
					'first_name' => $name,
					'last_name' => '',
					'lists' => array($list_id)
				));

		 $mehtod_url = $this->api_url.'contacts';
		 
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
			   "Authorization: Bearer ".$this->api_token,
			);
			if($http_method == 'POST'){
			$headers = array(
				   "Accept: application/json",
				   "Authorization: Bearer ".$this->api_token,
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
				return json_decode($response);
			}
			return null;
			
			
		 }catch (PDOException $e) {
			
			return null;
			
		} catch (Exception $e) {
			
			return null;
		}
	 }
}
	
