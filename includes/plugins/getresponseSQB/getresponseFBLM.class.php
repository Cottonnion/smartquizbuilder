<?php

class getresponseFBLM {

   function getresponse() // constructor
   {
   }

   //======== USER REGISTRATION / UPDATE / DELETE ========
	// Add if user not there,  else update 
	function register($email,$name,$params)
	{
		logToFile("getresponse.class.php: register()", LOG_INFO_DAP);
			
		$email = trim($email);
		$username = trim($email);
		$firstname = trim($name);

		$data = explode(":",$params);
		
		logToFile("getresponse.class.php: register(): phone =" . $phone, LOG_INFO_DAP);
		
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email)) {
			logToFile("getresponse.class.php: register(): invalid email", LOG_INFO_DAP);
			return "Email address is invalid"; 
		}
		
		// format:  getresponse:<your API key>:<API username>:1:0
		
		require_once 'jsonRPCClient.php';
		
		# your API key
		# available at http://www.getresponse.com/my_api_key.html
		$api_key = $data[1];
		logToFile("getresponse.class.php: register(): api_key =" . $api_key, LOG_INFO_DAP);
		
		# API 2.x URL
		$api_url = 'http://api2.getresponse.com';
		
		# initialize JSON-RPC client
		$client = new jsonRPCClient($api_url);
		$compaign_name = $data[2];
		logToFile("getresponse.class.php: register(): compaign_name =" . $compaign_name, LOG_INFO_DAP);
		
		$result = NULL;
		
		# get CAMPAIGN_ID of the campaign
		
		try {
			 $result = $client->get_campaigns(
				  $api_key,
				  array (
						# find by name literally
						'name' => array ( 'EQUALS' => $compaign_name )
				  )
			 );
			 
			 logToFile("getresponse.class.php: register(): result returned", LOG_INFO_DAP);
					 
		}
		catch (Exception $e) {	
			 # check for communication and response errors
			 # implement handling if needed
			 logToFile("getresponse.class.php: register(): get_campaigns ERROR =" . $e->getMessage(), LOG_INFO_DAP);
			 return ($e->getMessage());
		}
		
		# uncomment this line to preview data structure
		# print_r($result);
		
		# since there can be only one campaign of this name
		# first key is the CAMPAIGN_ID you need
		$CAMPAIGN_ID = array_pop(array_keys($result));
		logToFile("getresponse.class.php: register(): get_campaigns CAMPAIGN_ID =" . $CAMPAIGN_ID, LOG_INFO_DAP);
		
		
		
		
		logToFile("getresponse.class.php: register():  sourceProductId=".$sourceProductId, LOG_INFO_DAP);
		

		# add contact to 'sample_marketing' campaign
		try {

		
		if($CAMPAIGN_ID != "") {
			logToFile("getresponse.class.php: register():  sourceCompaignId=$CAMPAIGN_ID, contactId=$email", LOG_INFO_DAP);

			  $result = $client->add_contact(
			  $api_key,
			  array (
					'campaign'   => $CAMPAIGN_ID,
					'name' => $firstname,
					'email' => $email,
					'cycle_day' => '0',
					)
			   );
			print_r($result);
		 }
		 else {
			 logToFile("getresponse.class.php: register(): Campaign does not exist so return", LOG_INFO_DAP);
			return;
		 }
		
		
		 
		} catch (Exception $e) {
		   # check for communication and response errors
		   # implement handling if needed
		   logToFile("getresponse.class.php: register(): add_contact ERROR =" . $e->getMessage(), LOG_INFO_DAP);
		}
		
		logToFile("getresponse.class.php: add_contact complete", LOG_INFO_DAP);
		
		return 0;
	}
			
	
	 //======== USER REGISTRATION / UPDATE / DELETE ========
	// Add if user not there,  else update 
	function unregister($userId, $productId, $params, $sourceProductId="",$added=false)
	{
		logToFile("getresponse.class.php: unregister(): $userId, $productId, $params, $sourceProductId", LOG_INFO_DAP);
			
		$dapuser = Dap_User::loadUserById($userId);
		$email = trim($dapuser->getEmail());
		$username = trim($dapuser->getUser_name());
		$firstname = trim($dapuser->getFirst_name());
		$lastname = trim($dapuser->getLast_name());
		$phone = trim($dapuser->getPhone());
		$removeContact=false;
		logToFile("getresponse.class.php: sourceProductId=".$sourceProductId, LOG_INFO_DAP);
		
		
		if($sourceProductId != "") {
			$product = Dap_Product::loadProduct($sourceProductId);		
			
			//check if product exists
			if(!isset($product)) {
				logToFile("(getresponse.class.php Source productId=" . $sourceProductId . " does not exist");
				return "source product Id missing";
			}
			
			$subscribeList = trim($product->getSubscribeTo());
			$sourceData = explode(":",$subscribeList);
			
			if(isset($sourceData)) {
				$sourceCompaignId=$sourceData[2]; //compaign id of the source
				// Added by Veena - Retrieve Custom Fields for the user - 11/19/11
				logToFile("getresponse.class.php: sourceCompaignId(): $sourceCompaignId", LOG_DEBUG_DAP);
				
				$contactId=$this->getContactId($userId);
			}
		}
		else {
			//check if user is losing access ot all products in dap, if yes, do delete account in GR	
			$contactId=$this->getContactId($userId);
			logToFile("getresponse.class.php: getContactId returned=".$contactId, LOG_DEBUG_DAP);
			if($contactId != "" ){
				logToFile("getresponse.class.php: get all products that user has", LOG_DEBUG_DAP);
				$userProduct = Dap_UsersProducts::loadProducts($userId);
				if(isset($userProduct) && count($userProduct)>1) {
					logToFile("getresponse.class.php: user has products", LOG_DEBUG_DAP);
					$count=0;
					foreach ($userProducts as $userProduct) {
						//logToFile("getresponse.class.php: user has products", LOG_DEBUG_DAP);
						$count++;
						$prodId = $userProduct->getProduct_id();
						logToFile("getresponse.class.php: product=".$prodId, LOG_DEBUG_DAP);
					}
					
					if($count<=1){
						logToFile("getresponse.class.php: set remove contact to true because user is losing access to all products", LOG_DEBUG_DAP);
						$removeContact=true;
					}
				}
				else {
					logToFile("getresponse.class.php: user has NO products", LOG_DEBUG_DAP);
					$removeContact=true;	
				}
			}
		}
		
		$data = explode(":",$params);
		
		logToFile("getresponse.class.php: unregister(): phone =" . $phone, LOG_INFO_DAP);
		
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*$/i", $email)) {
			logToFile("getresponse.class.php: unregister(): invalid email", LOG_INFO_DAP);
			return "Email address is invalid"; 
		}
		
		// format:  getresponse:<your API key>:<API username>:1:0
		
		require_once 'jsonRPCClient.php';
		
		# your API key
		# available at http://www.getresponse.com/my_api_key.html
		$api_key = $data[1];
		logToFile("getresponse.class.php: unregister(): api_key =" . $api_key, LOG_INFO_DAP);
		
		# API 2.x URL
		$api_url = 'http://api2.getresponse.com';
		
		# initialize JSON-RPC client
		$client = new jsonRPCClient($api_url);
		$compaign_name = $data[2];
		logToFile("getresponse.class.php: unregister(): compaign_name =" . $compaign_name, LOG_INFO_DAP);
		
		$result = NULL;
		
		# get CAMPAIGN_ID of the campaign
		
		try {
			 $result = $client->get_campaigns(
				  $api_key,
				  array (
						# find by name literally
						'name' => array ( 'EQUALS' => $compaign_name )
				  )
			 );
			 
			 logToFile("getresponse.class.php: unregister(): result returned", LOG_INFO_DAP);
					 
		}
		catch (Exception $e) {	
			 # check for communication and response errors
			 # implement handling if needed
			 logToFile("getresponse.class.php: unregister(): get_campaigns ERROR =" . $e->getMessage(), LOG_INFO_DAP);
			 return ($e->getMessage());
		}
		
		# uncomment this line to preview data structure
		# print_r($result);
		
		# since there can be only one campaign of this name
		# first key is the CAMPAIGN_ID you need
		$CAMPAIGN_ID = array_pop(array_keys($result));
		logToFile("getresponse.class.php: unregister(): get_campaigns CAMPAIGN_ID =" . $CAMPAIGN_ID, LOG_INFO_DAP);
		# add contact to 'sample_marketing' campaign
		try {
		
		if( ($removeContact) && ($added==false) ) {
			logToFile("getresponse.class.php: unregister(): delete_contact	", LOG_INFO_DAP);	
			try {
			$result = $client->delete_contact(
			  $api_key,
			  array (
					'contact' => $contactId
					)
			   );
			}
			catch (Exception $e) {	
			 # check for communication and response errors
			 # implement handling if needed
			 logToFile("getresponse.class.php: unregister(): delete_contact failed..ignore", LOG_INFO_DAP);
			 
			}
		
			$this->updateContactId($userId);
			logToFile("getresponse.class.php: unregister(): contact deleted from GR", LOG_INFO_DAP);	
			return 0;
		}
		
		$customs = array();
		if($phone!="")
          $customs[]= array('name' => 'phone','content' => $phone);
		
		if($lastname!="")
          $customs[]= array('name' => 'lastname','content' => $lastname);
		
		
		$customsfound = count($customs);
		logToFile("getresponse.class.php: unregister(): customsfound =" . $customsfound, LOG_INFO_DAP);
		
		// get the compaignId from compaignname for the product/compaign to which you want to move the user
		if( ($sourceCompaignId != "") && ($contactId != "") ) {
		   
			try {
				 $result = $client->get_campaigns(
					  $api_key,
					  array (
							# find by name literally
							'name' => array ( 'EQUALS' => $sourceCompaignId )
					  )
				 );
				 
				 logToFile("getresponse.class.php: unregister(): result returned", LOG_INFO_DAP);
						 
			}
			catch (Exception $e) {	
				 # check for communication and response errors
				 # implement handling if needed
				 logToFile("getresponse.class.php: unregister(): get_campaigns ERROR =" . $e->getMessage(), LOG_INFO_DAP);
				 return ($e->getMessage());
			}
		   
		   $CAMPAIGN_ID = array_pop(array_keys($result));
		   logToFile("getresponse.class.php: unregister(): get_campaigns NEW CAMPAIGN_ID =" . $CAMPAIGN_ID, LOG_INFO_DAP);
		}
		   
		if($customsfound > 0) {
			logToFile("getresponse.class.php: unregister(): customsfound = yes, sourceCompaignId=$sourceCompaignId, contactId=$contactId" . $customsfound, LOG_INFO_DAP);
			
			if( ($sourceCompaignId != "") && ($contactId != "") ) {
			 // move contact to a different compaign
			 logToFile("getresponse.class.php: unregister(): customsfound = yes, ,move  $contactId to $CAMPAIGN_ID", LOG_INFO_DAP);
			
			  $result = $client->move_contact(
			  $api_key,
			  array (
					'contact' => $contactId,
					'campaign' => $CAMPAIGN_ID
					)
			   );
			}
			else {
			  $result = $client->add_contact(
			  $api_key,
			  array (
					'campaign' => $CAMPAIGN_ID,
					'name' => $firstname,
					'email' => $email,
					'cycle_day' => '0',
					'customs' => $customs
					)
			   );
			}
		 }
		 else {
			 logToFile("getresponse.class.php: unregister(): customsfound = no, sourceCompaignId=$sourceCompaignId, contactId=$contactId" . $customsfound, LOG_INFO_DAP);
			
			
			if( ($sourceCompaignId != "") && ($contactId != "") ) {
				
				
			 // move contact to a different compaign
			  logToFile("getresponse.class.php: unregister(): customsfound = no, ,move  $contactId to $CAMPAIGN_ID", LOG_INFO_DAP);
			  $result = $client->move_contact(
			  $api_key,
			  array (
					'contact' => $contactId,
					'campaign' => $CAMPAIGN_ID
					)
			   );
			}
			else {
				
			   $result = $client->add_contact(
				$api_key,
				array (
					  'campaign' => $CAMPAIGN_ID,
					  'name' => $firstname,
					  'email' => $email,
					  'cycle_day' => '0'
					  )
				   
				 );
			}
		 }
		 
		}
		
		catch (Exception $e) {
		   # check for communication and response errors
		   # implement handling if needed
		   logToFile("getresponse.class.php: unregister(): add_contact ERROR =" . $e->getMessage(), LOG_INFO_DAP);
		   return($e->getMessage());
		}
		
		logToFile("getresponse.class.php: add_contact complete", LOG_INFO_DAP);
		
		return 0;
	}
		
	
	function getContactId($userId) {
		$customFld = Dap_CustomFields::loadCustomfieldsByName("contact_id");
		logToFile("getresponse.class.php: getContactId(): called contact_id", LOG_DEBUG_DAP);
		if ($customFld) {
			$id = $customFld->getId();
			logToFile("getresponse.class.php: getContactId(): id=" . $id, LOG_DEBUG_DAP);
			$cfv = Dap_UserCustomFields::loadUserCustomFieldsByCustomFieldId($id, $userId );
		
			$value = "";
			if ($cfv) {
			  foreach ($cfv as $val) {
				$name=$customFld->getName();
				$value= $val['custom_value'];
				$contactId=$value;
				logToFile("getresponse.class.php:getContactId(): contactId from custom field(): contactId=$contactId");			  			
			  }
			}
		}
		
		return $contactId;
	}
	
	function updateContactId($userId) {
		$customFld = Dap_CustomFields::loadCustomfieldsByName("contact_id");
		logToFile("getresponse.class.php: updateContactId(): called contact_id", LOG_DEBUG_DAP);
		if ($customFld) {
			$id = $customFld->getId();
			logToFile("getresponse.class.php: updateContactId():: id=" . $id, LOG_DEBUG_DAP);
			
			$usercustom = new Dap_UserCustomFields();
		
			logToFile("getresponse.class.php: updateContactId():: userId=" . $userId, LOG_DEBUG_DAP);
			logToFile("getresponse.class.php: updateContactId():: contact_id=" . $post['contact_id'], LOG_DEBUG_DAP);
			logToFile("getresponse.class.php: updateContactId():: id=" . $id, LOG_DEBUG_DAP);
			
			$usercustom->setUser_id($userId);
			$usercustom->setCustom_value("");
			$usercustom->setCustom_id($id);
			
			$cf = Dap_UserCustomFields::loadUserCustomFieldsByCustomFieldId($id, $userId);
			if ($cf) {
				logToFile("getresponse.class.php: updateContactId():: call update to update value to empty string", LOG_DEBUG_DAP);
				$usercustom->update();
			}
			
		}
	  
	}
	
} 
?>
