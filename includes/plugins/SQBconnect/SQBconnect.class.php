<?php

class SQBconnect {
	// constructor
	function __construct() {
	}
	
	// ======== USER REGISTRATION / UPDATE / DELETE ========
	function register($email,$name,$params,$fields_array = array()) {
		
		$this->storeAddress ($email,$name,$params ,$fields_array);
	}
	
	function storeAddress($email,$name,$params,$fields_array = array()) {
		//Get the user details from DAP by using $userId
		
		
		/*echo "<pre>";
		print_r($fields_array);
		echo "</pre>";*/


		$email = trim ( $email);
		$firstname = trim ( $name);
		
		$data = explode(":", $params);
		
		//exploding the variable and create an array.
		if( (isset($data[1])) && (isset($data[2]))){
			$url = $data[1] . "://" .$data[2];
		}
		else {
			return "SQBconnect.class.php: missing destination URL";
		}
		
		
		//create an array of customfields to use during curl call.
		$fields = array (
				'first_name' => $firstname,
				'email' =>$email
		);
		
		if(is_user_logged_in()){
			$current_user = wp_get_current_user();
			$fields['wp_user_id'] = $current_user->ID;
			$fields['wp_username'] = $current_user->user_login;
			$fields['wp_lastname'] = $current_user->user_lastname;
		}

		

		if(is_array($fields_array) && count($fields_array)){
			$quizData = $fields_array['quizData'];
			$questions_details = $fields_array['sqb_question_answer_array_new'];
			$all_answer_tags_name_array = array();
			if(isset($fields_array['all_answer_tags_name_array'])){
				$all_answer_tags_name_array = $fields_array['all_answer_tags_name_array'];
			}
			$formula_details = array();
			if(isset($fields_array['formula_details'])){
				$formula_details = $fields_array['formula_details'];
			}
			$fields['quiz_id'] = $quizData->getId();
			$fields['quiz_name'] = $quizData->getQuizName();
			$fields['quiz_type'] = $quizData->getQuizType();
			$fields['quiz_desc'] = $quizData->getQuizDesc();
			$fields['questions_details'] = $questions_details;
			
			
			if($fields_array['outcomeDetails']){
				$outcomeDetails = $fields_array['outcomeDetails'];
				
				if($outcomeDetails != false){
					$fields['outcome_name'] = $outcomeDetails->getOutcomeName();
				}
			}
			
			if($quizData->getQuizType() == 'scoring'){
				$fields['total_points'] = $fields_array['total_points'];
			}
			$sqb_custom_fields_array = $fields_array['sqb_custom_fields_array'];



			if(is_array($sqb_custom_fields_array) && count($sqb_custom_fields_array)){
				foreach($sqb_custom_fields_array as $sqb_custom_field){

					if(!empty($sqb_custom_field['selected_value'])){

						$fields[strtolower($sqb_custom_field['field_name'])] =  $sqb_custom_field['selected_value'];
					}
				}
			}
		}

		  
		$outcome_tag = '';
		if(isset($data[4]) && ($data[4] != '')){ /*pass quiz id and name to zapier*/
			$fields['outcome_tag'] = $data[4];	
			$all_answer_tags_name_array[] = $data[4];
			
		}
		
		if(!empty($fields_array['category_high_rank'])){
			$fields['category_high_rank'] = $fields_array['category_high_rank'];
		}

		if(!empty($fields_array['category_low_rank'])){
			$fields['category_low_rank'] = $fields_array['category_low_rank'];
		}

		if(!empty($fields_array['category_name_high_rank'])){
			$fields['category_name_high_rank'] = $fields_array['category_name_high_rank'];
		}

		if(!empty($fields_array['category_name_low_rank'])){
			$fields['category_name_low_rank'] = $fields_array['category_name_low_rank'];
		}
		
		
		if(isset($data[5]) && isset($data[6])){ /*pass quiz id and name to zapier*/
			$fields['quiz_id'] = $data[5];	
			$fields['quiz_name'] = $data[6];	
		}
		
		
		$fields['all_tags_name'] = implode(',', $all_answer_tags_name_array);  
		$fields['all_tags'] = $all_answer_tags_name_array;  
		$fields['formula_details'] = $formula_details;
		

		if(strpos($url,'docs.google.com')){
			if(class_exists('SQBSG_Authenticator')){
				$obj = new SQBSG_Authenticator();
				$url_explode = explode('/', $url);
				$sheet_id = $url_explode[5];
				$sheet_column = $obj->readSpreadsheet($sheet_id);
				$i=1;
				foreach($fields['questions_details'] as $field)
			    {
			    	foreach($field as $key => $value){
				        $fields[$key.$i] = $value;
			    	}
			        $i++;
			    }
			    unset($fields['quiz_id']);
			    unset($fields['questions_details']);
			    unset($fields['all_tags']);
			    unset($fields['formula_details']);
				
				if(!empty($sheet_column[0])){
					$cells = $sheet_column[0];
					$request = array();
					foreach ($cells as $key => $value) {
						if(!empty($fields[$value])){
							$request[0][] = $fields[$value];
						}else{
							$request[0][] = '';
						}
					}
				}

				if(!empty($request[0])){
					$obj->writeSpreadsheet($sheet_id,$request);
				}
			}
			return;
		}

		
		$apiparams = array (
					
					'action' => "REGISTRATON",					
					'fields' => $fields
		);
		
		
		foreach ( $apiparams as $f => $v ) {
			  @$postfields[] = @$f . '=' . @$v;
		}
		
		$postfields = $apiparams;
		
		//This loop is for the curl call, this foreach loop will runs as many as the elements are present in the array $categories...	
		$curl = curl_init ( $url );
		if ($curl) {
			curl_setopt ( $curl, CURLOPT_USERAGENT, 'SQBconnect' );
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
			return "SQBconnect.class.php: missing destination URL";
		}
		
		$curl = curl_init ( $url );
		if ($curl) {
			curl_setopt ( $curl, CURLOPT_USERAGENT, 'SQB-CONNECT' );
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
