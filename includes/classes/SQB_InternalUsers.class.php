<?php 

class SQB_InternalUsers {
	
	public $id;
	public $email;
	public $first_name;
	public $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getEmail() {
		return $this->email;
	}
	function setEmail($o) {
		$this->email = $o;
	}
	
	function getFirstName() {
		return $this->first_name;
	}
	function setFirstName($o) {
		$this->first_name = $o;
	}
	 	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create(){
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$data = array(
				'first_name'=> $this->getFirstName(), 		 
				'email'=> $this->getEmail(), 		 
				'date'=> $this->getDate(),			 
			);
			$wpdb->insert($tableName, $data);
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public function update(){
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$data = array(
				'first_name'=> $this->getFirstName(), 		 
				'email'=> $this->getEmail(), 	  		 
				'date'=> $this->getDate(),				  		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_InternalUsers();
				$sqbData->setId($row['id']);
				$sqbData->setFirstName($row['first_name']);
				$sqbData->setEmail($row['email']);
				$sqbData->setDate($row['date']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByIdNew($id) {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
				$sqbData = new SQB_InternalUsers();
				$sqbData->setId($row['id']);
				$sqbData->setFirstName($row['first_name']);
				$sqbData->setEmail($row['email']);
				$sqbData->setDate($row['date']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_InternalUsers();
					$sqbData->setId($row['id']);
					$sqbData->setFirstName($row['first_name']);
					$sqbData->setEmail($row['email']);
					$sqbData->setDate($row['date']);
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadWithUserIdIndex() {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_InternalUsers();
					$sqbData->setId($row['id']);
					$sqbData->setFirstName($row['first_name']);
					$sqbData->setEmail($row['email']);
					$sqbData->setDate($row['date']);
					$sqbArray[$row['id']] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByEmail($email) {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " WHERE `email` ='".$email."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows) &&  isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_InternalUsers();
				$sqbData->setId($row['id']);
				$sqbData->setFirstName($row['first_name']);
				$sqbData->setEmail($row['email']);
				$sqbData->setDate($row['date']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByEmailNew($email) {
		 
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$sql = "SELECT * FROM " . $tableName . " WHERE `email` ='".$email."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_InternalUsers();
				$sqbData->setId($row['id']);
				$sqbData->setFirstName($row['first_name']);
				$sqbData->setEmail($row['email']);
				$sqbData->setDate($row['date']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_internal_users;
			$tableName = $wpdb->prefix . $sqb_internal_users;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
