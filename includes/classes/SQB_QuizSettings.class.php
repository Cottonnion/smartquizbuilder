<?php 
class SQB_QuizSettings{
	
	var $id;
	var $key;
	var $value;
	var $last_updated;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getKey() {
		return $this->key;
	}
	function setKey($o) {
		$this->key = $o;
	}
	
	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value = $o;
	}
	
	function getLastUpdated() {
		return $this->last_updated;
	}
	function setLastUpdated($o) {
		$this->last_updated = $o;
	}
    
    /*
     * insert message in database
     */ 
    public function create() {
		
		$output  = array();  
		
		try {			
			global $wpdb, $sqb_quiz_settings;
			$tableName = $wpdb->prefix . $sqb_quiz_settings;
			
			$data = array(
				'key'=> $this->getKey(),
				'value'=> $this->getValue(),
				'last_updated'=> $this->getLastUpdated(),
			);
			$wpdb->insert($tableName, $data);
	
			if($wpdb->last_error){
					
				$output['error'] =  $wpdb->last_error;
					
			}else{
					
				$output["success"]   = "Successfully insert.";
				$output["insert_id"] = $wpdb->insert_id;
			
			}		
			
			
		}catch (Exception $e) {
			
			$output['error'] = $e->getMessage();
		}
		
		return  $output;
	}
	
	/*
	 * update message in database
	 */ 
	public function update() {
		
		try {				
				global $wpdb, $sqb_quiz_settings;
				$tableName = $wpdb->prefix . $sqb_quiz_settings;
				
				$sql = "SELECT * FROM " . $tableName . " where `key` ='" . $this->getKey()."'";
				$rows = $wpdb->get_row($sql, ARRAY_A);	
				
				if(isset($rows) && isset($rows['key'])){
										
					//update
					$data = array(
						'key'=> $this->getKey(),
						'value'=> $this->getValue(),
						'last_updated'=> $this->getLastUpdated(),
					);
					
					$wpdb->update($tableName,$data,array('key'=>$this->getKey()),null,null);
					
					$output  = array();  
				
					if($wpdb->last_error){
						
						$output['error'] = $wpdb->last_error;						
					
					}else{
						
						$output['success'] = "Successfully update.";
					
					}
					
				}else{
					
					//insert
					return $this->create();
				}
		}catch (Exception $e) {
			$output['error'] = $e->getMessage();	
		}
		return $output;
	}
	
	/*
	 * load all messages
	*/ 
	public function load() {
		
		try {			
			
			global $wpdb, $sqb_quiz_settings;
			$tableName = $wpdb->prefix . $sqb_quiz_settings;
			
			
			
			
			$sql = "SELECT * FROM " . $tableName;
		    $rows = $wpdb->get_results($sql, ARRAY_A);
		    return $rows;
			
		}catch (Exception $e) {
			
		}
		
	}
	
	/*
	 * load all messages
	*/ 
	public static function loadByKey($key) {
		
		try {			
			
			global $wpdb, $sqb_quiz_settings;
			$tableName = $wpdb->prefix . $sqb_quiz_settings;
			$sql = "SELECT * FROM " . $tableName . " where `key` ='".$key."'";
		    $rows = $wpdb->get_row($sql, ARRAY_A);
		    if(isset($rows) && isset($rows['key'])){
				return $rows['value'];
			}
		    return '';
			
		}catch (Exception $e) {
			
		}
		
	}

	public static function deleteByKey($key) {
		
		try {			
			global $wpdb, $sqb_quiz_settings;
			$tableName = $wpdb->prefix . $sqb_quiz_settings;
		    $wpdb->delete($tableName, array('key'=>$key));
			return '';
		}catch (Exception $e) {
			
		}
		
	}
	
	public static function checkKeyExist($key = '') {
		
		try {			
			
			global $wpdb, $sqb_quiz_settings;
			$tableName = $wpdb->prefix . $sqb_quiz_settings;
			$sql = "SELECT * FROM " . $tableName . " where `key` ='".$key."'";
		    $rows = $wpdb->get_row($sql, ARRAY_A);
		    if(isset($rows) && isset($rows['key'])){
				return $rows;
			}
		    return null;
			
		}catch (Exception $e) {
			
		}
		
	}
	
}	
	
