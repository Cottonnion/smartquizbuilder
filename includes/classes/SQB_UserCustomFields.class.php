<?php
class SQB_UserCustomFields {
	
	var $id;
	var $quiz_id;
	var $user_id;
	var $manage_lead_id;
	var $name;
	var $value;
	var $date;

	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getUserId() {
		return $this->user_id;
	}
	function setUserId($o) {
		$this->user_id = $o;
	}
	
	function getManageLeadId() {
		return $this->manage_lead_id;
	}
	function setManageLeadId($o) {
		$this->manage_lead_id = $o;
	}
	
	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}
	
	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create() {
		try {
			global $wpdb, $sqb_user_custom_fields;
			$tableName = $wpdb->prefix . $sqb_user_custom_fields;
			$data = array( 		 
				'user_id'=> $this->getUserId(), 		 
				'quiz_id'=> $this->getQuizId(),			 			 
				'manage_lead_id'=> $this->getManageLeadId(),			 		 
				'name'=> $this->getName(),			 			 
				'value'=> $this->getValue(),			  
				'date'=> $this->getDate(),
			);
			$wpdb->insert($tableName, $data);
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function update() {
		try {
			global $wpdb, $sqb_user_custom_fields;
			$tableName = $wpdb->prefix . $sqb_user_custom_fields;
			$data = array( 		 
				'user_id'=> $this->getUserId(), 		 
				'quiz_id'=> $this->getQuizId(),			 			 
				'manage_lead_id'=> $this->getManageLeadId(),			 		 
				'name'=> $this->getName(),			 			 
				'value'=> $this->getValue(),			  
				'date'=> $this->getDate(),		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($keyId) {
		try {
			global $wpdb, $sqb_user_custom_fields;
			$tableName = $wpdb->prefix . $sqb_user_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_UserCustomFields();
				$sqbData->setId($row['id']);
				$sqbData->setUserId($row['user_id']); 		 
				$sqbData->setQuizId($row['quiz_id']);			 			 
				$sqbData->setManageLeadId($row['manage_lead_id']);			 			 
				$sqbData->setName($row['name']);			 			 
				$sqbData->setValue($row['value']);	 			  
				$sqbData->setDate($row['date']);							
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByUserIdQuizIdManageLeadsId($user_id=0,$quiz_id='',$manage_leads_id='') {
		try {
			global $wpdb, $sqb_user_custom_fields;
			$tableName = $wpdb->prefix . $sqb_user_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `quiz_id` = '".$quiz_id."' AND `manage_lead_id` = '".$manage_leads_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_UserCustomFields();
					$sqbData->setId($row['id']);		 
					$sqbData->setUserId($row['user_id']); 		 
					$sqbData->setQuizId($row['quiz_id']);			 			 
					$sqbData->setManageLeadId($row['manage_lead_id']);			 			 
					$sqbData->setName($row['name']);			 			 
					$sqbData->setValue($row['value']);	 			  
					$sqbData->setDate($row['date']);
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		try {
			global $wpdb, $sqb_user_custom_fields;
			$tableName = $wpdb->prefix . $sqb_user_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_UserCustomFields();
					$sqbData->setId($row['id']);		 
					$sqbData->setUserId($row['user_id']); 		 
					$sqbData->setQuizId($row['quiz_id']);			 			 
					$sqbData->setManageLeadId($row['manage_lead_id']);			 			 
					$sqbData->setName($row['name']);			 			 
					$sqbData->setValue($row['value']);	 			  
					$sqbData->setDate($row['date']);
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
?>
