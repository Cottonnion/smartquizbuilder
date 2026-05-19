<?php

/**
 * Mailerlite API v2 client library
 *
 */
class mailerliteSQB  
{

    private $api_key;
    private $api_url = 'https://api.mailerlite.com/api/v2';
    private $timeout = 8;
    public $http_status;

    /**
     * X-Domain header value if empty header will be not provided
     * @var string|null
     */
    private $enterprise_domain = null;

    /**
     * X-APP-ID header value if empty header will be not provided
     * @var string|null
     */
    private $app_id = null;

    /**
     * Set api key and optionally API endpoint
     * @param      $api_key
     * @param null $api_url
     */
    public function __construct($api_key, $api_url = null)
    {
        $this->api_key = $api_key;

        if (!empty($api_url)) {
            $this->api_url = $api_url;   
        }
    }

    /**
     * We can modify internal settings
     * @param $key
     * @param $value
     */
    function __set($key, $value)
    {
        $this->{$key} = $value;
    }

    public function getFields()
    {
        return $this->call('fields');
    }
    
     public function addFields($field_title = '')
    {
		$params =  array('title' => $field_title);
		return $this->call('fields','POST',$params);
        
    }
    
     public function addsubscribers($params , $group_id = 0)
    {
		$mehtod_url_key = 'groups/'.$group_id.'/subscribers';
		return $this->call($mehtod_url_key,'POST',$params);
        
    }
    
    
    
    
    public function getGroupList()
    {
        return $this->call('groups');
    }

   
    /**
     * Curl run request
     *
     * @param null $api_method
     * @param string $http_method
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    private function call($api_method = null, $http_method = 'GET', $params = array())
    {
        if (empty($api_method)) {
            return (object)array(
                'httpStatus' => '400',
                'code' => '1010',
                'codeDescription' => 'Error in external resources',
                'message' => 'Invalid api method'
            );
        }
        
        $url = $this->api_url . '/' . $api_method;
		$curl = curl_init();
		$api_key = $this->api_key;
		
		
		$curl_array = array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $http_method,
		  CURLOPT_HTTPHEADER => array(
			"content-type: application/json",
			"x-mailerlite-apikey: $api_key"
		  ),
		);
		if(is_array($params) && count($params)){
			$json = json_encode($params);
			$curl_array = array(
			  CURLOPT_URL => $url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => $http_method,
			  CURLOPT_POSTFIELDS => $json,
			  CURLOPT_HTTPHEADER => array(
				"content-type: application/json",
				"x-mailerlite-apikey: $api_key"
			  ),
			);
		}
		curl_setopt_array($curl, $curl_array);

		$response = curl_exec($curl);
		$err = curl_error($curl);
		$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);
		
		if($httpCode == "200"){
		   return json_decode($response);
		}else{
			
		}   	
    }

   
    
    function register($email, $name, $params ,$customFields = ''){
		
		
		$params = explode ( ":", $params );	
		try {
			
			$group_id = $params[2];
			$send_params  = array();
			$send_params["name"] = $name;
			$send_params["email"] = $email;
			$tag  = '';
			$quiz_field_title_create = 'quiz-tag';
			$quiz_field_key_create = null;
			
			if(isset($params[3]) && $params[3] != ''){
				$tag =  $params[3]; 
				$fields_list = $this->getFields();
				if(is_array($fields_list) && count($fields_list)){
					foreach($fields_list as $field_info){
						$field_id = $field_info->id;
						$field_title = $field_info->title;
						$field_key = $field_info->key;
						if($field_title == $quiz_field_title_create){
							$quiz_field_key_create = $field_key;
						}
					}
				}
				if(!isset($quiz_field_key_create)){
					$field_add = $this->addFields($quiz_field_title_create);
					$quiz_field_key_create = 'quiz_tag';
				}
				
			}
			
			if(isset($quiz_field_key_create)){
				$send_params["fields"] =  array($quiz_field_key_create=>$tag);
			}
			
			$accounts_info = $this->addsubscribers($send_params,$group_id);

			
			
		}catch (PDOException $e) {

			
			
			return "user details can't be retrieved";
			
		} catch (Exception $e) {
			
			
			return "user sendinblue can't be retrieved";
		}
	}


}
