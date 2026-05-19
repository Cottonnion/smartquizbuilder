<?php
class SQB_EmailChecker{

	public $id;
	public $limit_reached_date;
	
	function getId() {
		return $this->id;
	}
	
	function setId($o) {
		$this->id = $o;
	}	
	
	function getLimitReachedDate() {
		return $this->limit_reached_date;
	}
	
	function setLimitReachedDate($o) {
		$this->limit_reached_date = $o;
	}	
	
	public function create(){
		try { 
			global $wpdb, $sqb_emailchecker;
			$tableName = $wpdb->prefix . $sqb_emailchecker;
			$data = array(
				'limit_reached_date'=> $this->getLimitReachedDate(),
			);
			$wpdb->insert($tableName, $data);
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {			 
			echo $e->getMessage();
		}	
	}
	 
	
	public function update(){
		try {
		 	global $wpdb, $sqb_emailchecker;
			$tableName = $wpdb->prefix . $sqb_emailchecker;
			$data = array(
				'limit_reached_date'=> $this->getLimitReachedDate(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			echo $e->getMessage();
		}	
	}
	
	
	public static function load() {
		try {

			global $wpdb, $sqb_emailchecker;
			$tableName = $wpdb->prefix . $sqb_emailchecker;
			$sql = "SELECT * FROM " . $tableName ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$email_check = 'false';
			
			if(isset($rows[0])){
				$row = $rows[0];
				$email_check = new SQB_EmailChecker();
				$email_check->setId($row['id']);
				$email_check->setLimitReachedDate($row['limit_reached_date']);
			}
			return $email_check;	 
			
		}catch (Exception $e) {	 
			echo $e->getMessage();
		}
	}

	
}
