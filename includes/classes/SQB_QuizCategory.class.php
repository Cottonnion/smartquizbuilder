<?php 

class SQB_QuizCategory {
 	
 	public $id;
 	public $name;
 	public $description;
 	public $status;
 	public $date;
 	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}		
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name	 = $o;
	}
	function getDescription() {
		return $this->description;
	}
	function setDescription($o) {
		$this->description	 = $o;
	}
	
	function getStatus() {
		return $this->status;
	}
	function setStatus($o) {
		$this->status	 = $o;
	}
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create(){
		try {
			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;

			$data = array(
				'id'=> $this->getId(),
				'name'=> $this->getName(),			 
				'description'=> $this->getDescription(),			 
				'status'=> $this->getStatus(),			 
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
			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;
			$data = array(
				'id'=> $this->getId(),
				'name'=> $this->getName(),			 
				'description'=> $this->getDescription(),			 
				'status'=> $this->getStatus(),			 
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
			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){				 				
				$sqbData = new SQB_QuizCategory();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);	 
				$sqbData->setDescription($row['description']);	 
				$sqbData->setStatus($row['status']);	 
				$sqbData->setDate($row['date']);				
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		$sqbDataArray = null;
		try {
			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_QuizCategory();
					$sqbData->setId($row['id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setDescription($row['description']);	 
					$sqbData->setStatus($row['status']);	 
					$sqbData->setDate($row['date']);	
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
	}
	
	public static function loadAllName() {
		$sqbDataArray = null;
		try {
			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbDataArray[$row['id']] = $row['name']; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
	}

	public static function Delete($id) {
		try {

			global $wpdb, $sqb_quiz_category;
			$tableName = $wpdb->prefix . $sqb_quiz_category;
			$wpdb->delete( $tableName, array('id'=>$id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	static function getConnectQuizDetails(){
		
		$sqbDataArray = null;
		try {
			global $wpdb, $sqb_quiz_category, $sqb_quiz_question_bank, $sqb_quiz,$sqb_quiz_questions;
			$tableName1 = $wpdb->prefix . $sqb_quiz_category;
			$tableName2 = $wpdb->prefix . $sqb_quiz_question_bank;
			$tableName3 = $wpdb->prefix . $sqb_quiz_questions;
			$tableName4 = $wpdb->prefix . $sqb_quiz;
			
			$sql = "select t1.id as cat_id, t4.quiz_name as quiz_name, t4.id as quiz_id from ".$tableName1." as t1 INNER join ".$tableName2."  as t2 INNER join ".$tableName3." as t3 INNER join ".$tableName4." as t4  where t1.id=t2.category_id and t3.question_id = t2.id and t4.id=t3.quiz_id";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbDataArray[$row['cat_id']]['cat_id'] = $row['cat_id']; 
					$sqbDataArray[$row['cat_id']]['quiz_name'] = $row['quiz_name']; 
					$sqbDataArray[$row['cat_id']]['quiz_id'] = $row['quiz_id']; 
					
					
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
		

	}
	
}	
