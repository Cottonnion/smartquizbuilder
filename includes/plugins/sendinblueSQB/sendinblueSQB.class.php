<?php

class sendinblueSQB {
	/*function sendinblue() // constructor
	{
	}*/

	function register($email, $name, $params ,$customFields = '', $double_optin=''){
		 
		$params = explode ( ":", $params );	
		try {
			
			$listId = (int)$params[2];
			
			//added for double_optin
			$double_optin_val='';
			$double_optin_temp='';
			$double_optin_url='';
			if( $double_optin !=''){				 
				$double_optin_arr = explode("||", $double_optin);
				$double_optin_val = $double_optin_arr[0];
				$double_optin_url = $double_optin_arr[1];
				$double_optin_temp = (int)$double_optin_arr[2];				
			}
		 
			if($double_optin_val =="Y"){
				if($double_optin_temp == '' || $double_optin_temp ==0){
					$double_optin_temp =1;
				}
				if($double_optin_url == '' ){
					$double_optin_url= get_site_url();
				}
				
				$api_params = array(
					'email' => $email,
					'attributes' => [
					'FNAME' => $name,
					'LNAME' => '',
					],
					'includeListIds' => [
						$listId
					],
					//'templateId' => 1,
					'templateId' => $double_optin_temp,
					//'redirectionUrl' => 'https://memberdemo.com'
					'redirectionUrl' => $double_optin_url

				); 
				
			}else{
				
				$api_params = array(
					'email' => $email,
					'attributes' => [
					'FIRSTNAME' => $name,
					'LASTNAME' => '',
					],
					'listIds' => [
						$listId
					]

				);
			}

			if(isset($params[3]) && $params[3] != ''){
				$api_params['attributes']['TAGS'] = $params[3];
			}
			
			$api_params = json_encode($api_params);
			


			$api_key = $params[1];

            /*
             * create attibute of tab for contact list 
            */
            
            $attribute_name = 'TAGS';
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/contacts/attributes/normal/".$attribute_name);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode(array('type'=>'text')));
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Api-Key: ".$api_key;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);  
            curl_close ($ch);
            
            
            /*
             * add user to contact list 
            */
			$ch = curl_init();
			
			//added for double_optin
			if($double_optin_val =="Y"){				 
				curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/contacts/doubleOptinConfirmation");
			}else{
				curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/contacts");
			}
					
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$api_params);
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Api-Key: ".$api_key;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);


			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}else{
				 // if user already exist
				$result =  json_decode($result,true);
			
			   if(isset($result['message']) && ($result['message'] == 'Contact already exist')) {
					$ch = curl_init();
					$api_params = array('emails' => array($email));
					$api_params = json_encode($api_params);
					curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/contacts/lists/".$listId."/contacts/add");
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$api_params);
					curl_setopt($ch, CURLOPT_POST, 1);

					$headers = array();
					$headers[] = "Api-Key: ".$api_key;
					$headers[] = "Accept: application/json";
					$headers[] = "Content-Type: application/json";
					curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
					$result = curl_exec($ch);
				}

			}
			curl_close ($ch);
			
		}catch (PDOException $e) {
			
			return "user details can't be retrieved";
			
		} catch (Exception $e) {
			
			return "user sendinblue can't be retrieved";
		}
	}


	function unregister($email, $name, $params ,$customFields = ''){
		//unlinkListIds
		$dapver=floatval(DAP_VERSION);
		if($dapver<4.7) {
			logToFile("sendinblue.class.php: REMOVE NOT SUPPORTED", LOG_DEBUG_DAP);	
			return;
		}

		$action="removecontact";
		try {
			$dapuser = Dap_User::loadUserById($userId);
			if(isset($dapuser)){
				$email = $dapuser->getEmail();
			}
			else{
				return;
			}
			$params = explode ( ":", $params );	
			$api_key = $params[1];

			$listId = (int)$params[2];

			$email = urlencode($email);

			$api_params = array(
				'unlinkListIds' => [
			      $listId
			    ]    
			);

			if(isset($params[3]) && $params[3] != ''){
				$api_params['attributes']['TAGS'] = '';
			}
			

			$api_params = json_encode($api_params);

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "https://api.sendinblue.com/v3/contacts/".$email);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST , "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS,$api_params);
			curl_setopt($ch, CURLOPT_POST, 1);

			$headers = array();
			$headers[] = "Api-Key: ".$api_key;
			$headers[] = "Content-Type: application/json";
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			$result = curl_exec($ch);

			
			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);

			
		}catch (PDOException $e) {
			logToFile("sendinblue.class.php: $action(): user details can't be retrieved ".$e->getMessage(), LOG_INFO_DAP);
			return "user details can't be retrieved";
		} catch (Exception $e) {
			logToFile("sendinblue.class.php: $action(): user details can't be retrieved ".$e->getMessage(), LOG_INFO_DAP);
			return "user sendinblue can't be retrieved";
		}
	}
}
