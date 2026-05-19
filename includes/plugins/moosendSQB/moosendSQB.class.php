<?php 

class moosendSQB{
	
	 private $api_key;
     private $api_url = 'https://api.moosend.com/v3/';
     private $api_list_url = 'https://api.sendfox.com/lists';
     
     /**
     * Set api token 
     * @param      $api_key
     */
     public function __construct($api_key){
        $this->api_key = $api_key;
     }
     
     public function getLists(){
		 
		$mehtod_url = $this->api_url.'lists.json?apikey='.$this->api_key.'&WithStatistics=true&ShortBy=CreatedOn&SortMethod=ASC';
		$lists_data =  $this->call($mehtod_url,'GET','');
		
		if(isset($lists_data['Context']) && isset($lists_data['Context']['MailingLists'])){
			$lists_data = $lists_data['Context']['MailingLists'];
		}else{
			$lists_data = null;
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
		
		 
		 $params = json_encode(array(					
					'email' => $email,
					'name' => $name,
				));
				
		 $mehtod_url = $this->api_url.'subscribers/'.$list_id.'/subscribe.json?apikey='.$this->api_key;
		
		 
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
