<?php 
class SQB_AutoresponderSettings{
	
	var $id;
	var $name;
	var $key_name;
	var $value;
	var $date;
	
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	/*function getAId() {
		return $this->a_id;
	}
	function setAId($o) {
		$this->a_id = $o;
	}
	*/
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}
	
	function getKeyName() {
		return $this->key_name;
	}
	function setKeyName($o) {
		$this->key_name = $o;
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
	
	public function create(){
		try {
			global $wpdb, $sqb_autoresponder_settings;
			$tableName = $wpdb->prefix . $sqb_autoresponder_settings;
			$data = array(
				'name'=> $this->getName(),
				//'a_id'=> $this->getAId(),
				'key_name'=> $this->getKeyName(),
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
	
	public function update(){
		try {
			global $wpdb, $sqb_autoresponder_settings;
			$tableName = $wpdb->prefix . $sqb_autoresponder_settings;
			$data = array(
				'value'=> $this->getValue(),
				'date'=> $this->getDate(),
			);
			
			$wpdb->update($tableName,$data,array('name'=>$this->getName(), 'key_name'=>$this->getKeyName()),null,null);
			return $lastid = @$id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadAutoresponderByNameAndKey($name , $key){
		try {
			global $wpdb, $sqb_autoresponder_settings;
			$tableName = $wpdb->prefix . $sqb_autoresponder_settings;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$name."' AND `key_name` = '".$key."'"  ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$allautoresponder = array();
			
			if(isset($rows[0])){
				$row = $rows[0];
				$autoresponder = new SQB_AutoresponderSettings();
				$autoresponder->setId($row['id']);
				$autoresponder->setName($row['name']);
				//$autoresponder->setAId($row['a_id']);
				$autoresponder->setKeyName($row['key_name']);
				$autoresponder->setValue($row['value']);
				$autoresponder->setDate($row['date']);
				return 	$autoresponder;
			}
			return false;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function loadAutoresponderByName($name){
		try {
			global $wpdb, $sqb_autoresponder_settings;
			$tableName = $wpdb->prefix .  $sqb_autoresponder_settings;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$name."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$allautoresponder = array();
			if(isset($rows[0])){
				foreach($rows as $row){
					$autoresponder = new SQB_AutoresponderSettings();
					$autoresponder->setId($row['id']);
					$autoresponder->setName($row['name']);
					//$autoresponder->setAId($row['a_id']);
					$autoresponder->setKeyName($row['key_name']);
					$autoresponder->setValue($row['value']);
					$autoresponder->setDate($row['date']);
					$allautoresponder[] = $autoresponder;
				}
				return 	$allautoresponder;
			}
			return false;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
}
