<?php

class activecampaignSQB {

	function activecampaign() // constructor
	{
	}

	//======== USER REGISTRATION ========
	function register($email, $name, $params, $customFields)
	{
		$action="addcontact";

		if (FALSE === extension_loaded('curl')) {
			return "cURL is not available";
		}
		
		try {
			// format - activecampaign:account.api-us1.com:dda9d8jlkld8hjd8ksjhfd0shs6jm8273:1:10|11|12|13|14|15
			$data = explode(":",$params);  
			
			$api_url='https:'.$data[2];
			
			$api_key=$data[3];
			
			$list_id=$data[4];
			
			if(isset($data[5])){
				$tagId=$data[5];
			}	
			 
			// 10|11|12|13|14|15 
			/*if(isset($data[4]))
				$addressinfo = explode("|",$data[4]);
			*/
			//address1
			$address1FieldId='';
			//address2
			$address2FieldId='';
			//city
			$cityFieldId='';
			//state
			$stateFieldId='';
			//zip
			$zipFieldId='';
			//country
			$countryFieldId='';
				
			/*if(isset($data[5]))
				$tagId=$data[5];*/
				
		
		/*	if(isset($data[6]))
				$formId=$data[6];
				
			if(isset($data[7])){
				$listtoaddtag = $data[7];
			}
			
			if(isset($data[8])){
				$sendpassword = $data[8];
			}*/
			$tags=array();
			
			if($tagId!="") {
				$tags[]=$tagId;	
			}
			
			
			$api_params = array(
		  // the API Key can be found on the "Your Settings" page under the "API" tab.
			  // replace this with your API Key
			  'api_key'      => $api_key,
			  // this is the action that adds a contact
			  'api_action'   => 'contact_sync',
			  // define the type of output you wish to get back
			  // possible values:
			  // - 'xml'  :      you have to write your own XML parser
			  // - 'json' :      data is returned in JSON format and can be decoded with
			  //                 json_decode() function (included in PHP since 5.2.0)
			  // - 'serialize' : data is returned in a serialized format and can be decoded with
			  //                 a native unserialize() function
			  'api_output'   => 'serialize'
			);

			/*if(isset($data[3]))
				$list_id=$data[3];*/

				

			
			// here we define the data we are posting in order to perform an update
			$post = array(
				'email'                     => trim($email),
				'first_name'                => trim($name),
				//'ip4'                    => '127.0.0.1',
				// any custom fields
				//'field[345,0]'           => 'field value', // where 345 is the field ID
				//'field[%PERS_1%,0]'      => 'field value', // using the personalization tag instead (make sure to encode the key)
			
				// assign to lists:
				'status['.$list_id.']'              => 1, // 1: active, 2: unsubscribed (REPLACE '123' WITH ACTUAL LIST ID, IE: status[5] = 1)
				//'form'          => 1001, // Subscription Form ID, to inherit those redirection settings
				//'noresponders[123]'      => 1, // uncomment to set "do not send any future responders"
				//'sdate[123]'             => '2009-12-07 06:00:00', // Subscribe date for particular list - leave out to use current date/time
				// use the folowing only if status=1
				'instantresponders['.$list_id.']' => 1 // set to 0 to if you don't want to sent instant autoresponders
				//'lastmessage[123]'       => 1, // uncomment to set "send the last broadcast campaign"
			
				//'p[]'                    => 345, // some additional lists?
				//'status[345]'            => 1, // some additional lists?
			);
			
			
			if(!empty($formId)) {
				$post['form'] = trim($formId);
			}
			if($address1FieldId!="")
				$post['field['.$address1FieldId.']'] = trim($address1);
				
			if($address2FieldId!="")	
				$post['field['.$address2FieldId.']'] = trim($address2);
			
			if($cityFieldId!="")
				$post['field['.$cityFieldId.']'] = trim($city);
			
			if($stateFieldId!="")
				$post['field['.$stateFieldId.']'] = trim($state);
			
			if($zipFieldId!="")
				$post['field['.$zipFieldId.']'] = trim($zip);
			
			if($countryFieldId!="")
				$post['field['.$countryFieldId.']'] = trim($country);

			$post['p['.$list_id.']'] = $list_id;

			if(!empty($customFields)){
				foreach($customFields as $key => $value){
					$post[$key] = $value;
				}
			}
				
			
			
			if(count($tags) > 0){
				$tagsStr = "";
				$tagsStr = implode(", ", $tags);
				$post['tags'] = $tagsStr;
			}
			
			// This section takes the input fields and converts them to the proper format
			$query = "";
			foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
			$query = rtrim($query, '& ');
	  
			// This section takes the input data and converts it to the proper format
			$data = "";
			foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
			$data = rtrim($data, '& ');
		
			// clean up the url
			$api_url = rtrim($api_url, '/ ');
			
			// This sample code uses the CURL library for php to establish a connection,
			// submit your request, and show (print out) the response.
			if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');
	
			// If JSON is used, check if json_decode is present (PHP 5.2.0+)
			if ( $api_params['api_output'] == 'json' && !function_exists('json_decode') ) {
				return;
			}
	
			// define a final API request - GET
			$api = $api_url . '/admin/api.php?' . $query;
	
			$request = curl_init($api); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
			//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
	
			$response = (string)curl_exec($request); // execute curl post and store results in $response
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close($request); // close curl object
			
			if ( !$response ) {
				return;
			}
			$result = unserialize($response);
					
			
		
			if($tagId != ""){
				try{
					
					$api_params = array(
						'api_key'      => $api_key,
						'api_action'   => 'contact_tag_add',
						'api_output'   => 'serialize'
					);
					
					$post = array(
						'email'  => trim($email),
					);
					
					$tags = explode(',',$tagId);
					for($i=0;$i<count($tags);$i++){
						$post['tags['.$i.']'] = $tags[$i];
					}
					
					$query = "";
					foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
					$query = rtrim($query, '& ');
					
					// This section takes the input data and converts it to the proper format
					$data = "";
					foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
					$data = rtrim($data, '& ');
					
					// clean up the url
					$api_url = rtrim($api_url, '/ ');
					
					
					// define a final API request - GET
					$api = $api_url . '/admin/api.php?' . $query;
					
					$request = curl_init($api); // initiate curl object
					curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
					curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
					//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
					curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

					$response = (string)curl_exec($request); // execute curl fetch and store results in $response
					
					curl_close($request); // close curl object
					
					if ( !$response ) {
						return;
					}
					
					$result = unserialize($response);
					
				
					if($result['result_code'] == 0){ /* means that add to tagid failed because contact is not created yet so create user and use the listid that we had asked for in add tag*/
						if(isset($listtoaddtag) && $listtoaddtag != ""){
							
							$api_params = array(
								'api_key'      => $api_key,
								'api_action'   => 'contact_sync',
								'api_output'   => 'serialize'
							);
							
							$post = array(
								'email'  => trim($email),
								'status['.$list_id.']'  => 1
							);
							
							
							$tags = explode(',',$tagId);
							for($i=0;$i<count($tags);$i++){
								$post['tags['.$i.']'] = $tags[$i];
							}
							$post['p['.$listtoaddtag.']'] = $listtoaddtag;
							
							$query = "";
							foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
							$query = rtrim($query, '& ');
							
							// This section takes the input data and converts it to the proper format
							$data = "";

							foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
							$data = rtrim($data, '& ');
							
							// clean up the url
							$api_url = rtrim($api_url, '/ ');

							// define a final API request - GET
							$api = $api_url . '/admin/api.php?' . $query;
							
							$request = curl_init($api); 
							curl_setopt($request, CURLOPT_HEADER, 0); 
							curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
							curl_setopt($request, CURLOPT_POSTFIELDS, $data); 
							curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

							$response = (string)curl_exec($request); 
							
							curl_close($request); 
							if ( !$response ) {
								return;
							}
							$result = unserialize($response);	
					
						}else{
						}
					}
					
					
				}
				catch (PDOException $e) {
					$action = "addtag";
					return "user details can't be retrieved";
				} catch (Exception $e) {
					$action = "addtag";
					return "user details can't be retrieved";
				}

			}
		
	
	
			// This line takes the response and breaks it into an array using:
			// JSON decoder
			//$result = json_decode($response);
			// unserializer
			$result = unserialize($response);
			
		} catch (PDOException $e) {
			return "user details can't be retrieved";
		} catch (Exception $e) {
			return "user details can't be retrieved";
		}
		
	
	} // function register($userId, $productId, $params)


	function unregister($email, $name, $params)
	{
		$action="removecontact";
		try {
			
			// format - activecampaign:http://account.api-us1.com:dda9d8jlkld8hjd8ksjhfd0shs6jm8273:1
			$data = explode(":",$params);  
			
			$api_url=$data[1];
			$api_key=$data[2];
			$list_id=$data[3];
			$tagId=$data[5];	
			
			//get contact id (search ac by email)
			$api_params = array(
				'api_key'      => $api_key,
				'api_action'   => 'contact_view_email',
				'api_output'   => 'serialize',
				'email'        => trim($email)
			);
	
			// This section takes the input fields and converts them to the proper format
			$query = "";
			foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
			$query = rtrim($query, '& ');
			
			// clean up the url
			$api_url = rtrim($api_url, '/ ');
			
			// This sample code uses the CURL library for php to establish a connection,
			// submit your request, and show (print out) the response.
			if ( !function_exists('curl_init') ) {
				return;
			}
			// define a final API request - GET
			$api = $api_url . '/admin/api.php?' . $query;
			
			$request = curl_init($api); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
			
			$response = (string)curl_exec($request); // execute curl fetch and store results in $response
			
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close($request); // close curl object
			
			if ( !$response ) {
				return;
			}
			
			// This line takes the response and breaks it into an array using:
			// JSON decoder
			//$result = json_decode($response);
			// unserializer
			
			$result = unserialize($response);
			
			
			if($result['result_code'] == 'FAILED') {
				return;
			}
			
			$id=$result["id"];
	
			$api_params = array(
			  // the API Key can be found on the "Your Settings" page under the "API" tab.
				  // replace this with your API Key
				'api_key'      => $api_key,
				// this is the action that adds a contact
				'api_action'   => 'contact_sync',
				'api_output'   => 'serialize'
			);
			
			$post = array(
				'email'                     => trim($email),
				'status['.$list_id.']'              => 2, // 1: active, 2: unsubscribed (REPLACE '123' WITH ACTUAL LIST ID, IE: status[5] = 1)
				'p[]' => $list_id
			);
	  
			
			
			// This section takes the input fields and converts them to the proper format
			$query = "";
			foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
			$query = rtrim($query, '& ');
			
			// This section takes the input data and converts it to the proper format
			$data = "";
			foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
			$data = rtrim($data, '& ');
			
			// clean up the url
			$api_url = rtrim($api_url, '/ ');
			
			
			// define a final API request - GET
			$api = $api_url . '/admin/api.php?' . $query;
			
			$request = curl_init($api); // initiate curl object
			curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
			curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
			curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
			//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
			curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

			$response = (string)curl_exec($request); // execute curl fetch and store results in $response
			
			// additional options may be required depending upon your server configuration
			// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close($request); // close curl object
			
			if ( !$response ) {
				return;
			}
			
			$result = unserialize($response);
			
		
		} catch (PDOException $e) {
			return "user details can't be retrieved";
		} catch (Exception $e) {
			return "user details can't be retrieved";
		}
	
		if($tagId != ""){
			try{
			
				$api_params = array(
					'api_key'      => $api_key,
					'api_action'   => 'contact_tag_remove',
					'api_output'   => 'serialize'
				);
				
				$post = array(
					'email'  => trim($email),
				);
				
				$tags = explode(',',$tagId);
				for($i=0;$i<count($tags);$i++){
					$post['tags['.$i.']'] = $tags[$i];
				}
				
				$query = "";
				foreach( $api_params as $key => $value ) $query .= $key . '=' . urlencode($value) . '&';
				$query = rtrim($query, '& ');
				
				// This section takes the input data and converts it to the proper format
				$data = "";
				foreach( $post as $key => $value ) $data .= $key . '=' . urlencode($value) . '&';
				$data = rtrim($data, '& ');
				
				// clean up the url
				$api_url = rtrim($api_url, '/ ');
				
				
				// define a final API request - GET
				$api = $api_url . '/admin/api.php?' . $query;
				
				$request = curl_init($api); // initiate curl object
				curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
				curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
				curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
				//curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
				curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

				$response = (string)curl_exec($request); // execute curl fetch and store results in $response
				
				curl_close($request); // close curl object
				
				if ( !$response ) {
					return;
				}
				
				$result = unserialize($response);
				
			}
			catch (PDOException $e) {
				$action = "removetag";
				return "user details can't be retrieved";
			} catch (Exception $e) {
				$action = "removetag";
				return "user details can't be retrieved";
			}

		}
		
	} // function unregister($userId, $productId, $params)

} // class activecampaign
?>
