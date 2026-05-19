<?php 

class SQB_GDPR{
	
	public $id;
	public $country_name;
	public $country_code;
	public $status;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getCountryName() {
		return $this->country_name;
	}
	function setCountryName($o) {
		$this->country_name = $o;
	}
	
	function getCountryCode() {
		return $this->country_code;
	}
	function setCountryCode($o) {
		$this->country_code = $o;
	}
	
	function getStatus() {
		return $this->status;
	}
	
	function setStatus($o) {
		$this->status = $o;
	}
	
   
   public function create(){
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$data = array(
				'country_name'=> $this->getCountryName(),
				'country_code'=> $this->getCountryCode(),
				'status'=> $this->getStatus(),
			); 
			echo '<pre>';print_r($data);
			$wpdb->insert($tableName, $data);
			$id = $wpdb->insert_id;
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function update(){
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$data = array(
				'country_name'=> $this->getCountryName(),
				'country_code'=> $this->getCountryCode(),
				'status'=> $this->getStatus()
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}

	public static function updateByCountyCode($country_code,$status){
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$data = array(
				'status'=> $status
			);
			// print_r($data);die();
			$wpdb->update($tableName,$data,array('country_code'=>$country_code),null,null);
			
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_GDPR();
				$sqbData->setId($row['id']);
				$sqbData->setCountryName($row['country_name']);
				$sqbData->setCountryCode($row['country_code']);
				$sqbData->setStatus($row['status']);
				
				
				$sqbData->setDate($row['date']);
					 	
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByCountryCode($id) {
		 
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$sql = "SELECT * FROM " . $tableName . " WHERE `country_code` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_GDPR();
				$sqbData->setId($row['id']);
				$sqbData->setCountryName($row['country_name']);
				$sqbData->setCountryCode($row['country_code']);
				$sqbData->setStatus($row['status']);
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function load() {
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$sql = "SELECT * FROM " . $tableName." ORDER BY id desc";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
						$sqbData = new SQB_GDPR();
						$sqbData->setId($row['id']);
						$sqbData->setCountryName($row['country_name']);
						$sqbData->setCountryCode($row['country_code']);
						$sqbData->setStatus($row['status']);
						$sqbArray[] = $sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}     
	
	
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_gdpr;
			$tableName = $wpdb->prefix . $sqb_gdpr;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
} 
	
	
	

