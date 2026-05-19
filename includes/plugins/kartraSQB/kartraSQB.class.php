<?php

class kartraSQB {
	/*function sendinblue() // constructor
	{
	}*/

	function register($email, $name, $params ,$customFields = '', $double_optin=''){
		 
		$params = explode ( ":", $params );	
		try {
			
			$listId = $params[2];
			
			$api_id = $params[4];
			$api_key = $params[1];
			$api_password = $params[5];

			$api_params = array(
				'app_id' => $api_id,
				'api_key' => $api_key,
				'api_password' => $api_password,
				'lead' => array(
					'first_name' => $name,
					'email' => $email,
				)
				/*'actions' => array(
	                '0' => array(
	                    'cmd' => 'subscribe_lead_to_list',
        				'list_name' => $listId
	                )
	                '1' => array(
	                       'cmd' => 'assign_tag',
	                       'tag_name' => 'My customer'
	                )
	            )*/
				//'fields' => $fields
		  	);


			// Create new Lead
			$ch = curl_init();
			
			$create_lead = $api_params;
			$create_lead['actions'][] =  array(
	            'cmd' => 'create_lead'
			);
			if(isset($params[3]) && $params[3] != ''){
				$tag = $params[3];

				$tasg = explode(',',$tag);
				if(!empty($tasg)){
					foreach($tasg as $tg){
						$create_lead['actions'][] =  array(
							'cmd' => 'assign_tag',
							'tag_name' => $tg
						);
					}
				}
			}

			
			curl_setopt($ch, CURLOPT_URL, "https://app.kartra.com/api");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($create_lead));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$result = curl_exec($ch);

			/*if(isset($params[3]) && $params[3] != ''){
				$api_params['attributes']['TAGS'] = $params[3];
			}*/
			
			//$api_params = json_encode($api_params);
			
            /*
             * add user to contact list 
            */
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, "https://app.kartra.com/api");
			curl_setopt($ch, CURLOPT_POST, 1);

			$list_lead = $api_params;
			$list_lead['actions'] = array(
					'0' => array(
	                    'cmd' => 'subscribe_lead_to_list',
        				'list_name' => $listId
	                )
				);

			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($list_lead));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$result = curl_exec($ch);

			if (curl_errno($ch)) {
			    echo 'Error:' . curl_error($ch);
			}else{
				 // if user already exist
				$result =  json_decode($result,true);
			}
			curl_close ($ch);
			
		}catch (PDOException $e) {
			
			return "user details can't be retrieved";
			
		} catch (Exception $e) {
			
			return "user sendinblue can't be retrieved";
		}
	}


	function unregister($email, $name, $params ,$customFields = ''){
		
	}
}
