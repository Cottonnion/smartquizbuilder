<?php 

class SQB_FormQuiz {
	
	var $id;
	var $quiz_id;
	var $display_type;
	var $page_ids;
	var $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}

	function getDisplayType() {
		return $this->display_type;
	}
	function setDisplayType($o) {
		$this->display_type = $o;
	}

	function getPageIds() {
		return $this->page_ids;
	}
	function setPageIds($o) {
		$this->page_ids = $o;
	}
	 	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'display_type'=> $this->getDisplayType(),	 		 
				'page_ids'=> $this->getPageIds(),	 		 
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
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'display_type'=> $this->getDisplayType(),	 		 
				'page_ids'=> $this->getPageIds(),	 		 
				'date'=> $this->getDate(),	
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadalldata($id) {
		 
		try {

			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` !='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_FormQuiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setDisplayType($row['display_type']);
					$sqbData->setPageIds($row['page_ids']);
					$sqbData->setDate($row['date']);
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_FormQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDisplayType($row['display_type']);
				$sqbData->setPageIds($row['page_ids']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_FormQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDisplayType($row['display_type']);
				$sqbData->setPageIds($row['page_ids']);
				$sqbData->setDate($row['date']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadQuizIdByPageId($pageId) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_form_quiz;
			$tableName = $wpdb->prefix . $sqb_form_quiz;
			//$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."'" ;
			$sql = "SELECT quiz_id FROM  " . $tableName . " WHERE  CONCAT(',', page_ids, ',') like '%,".$pageId.",%'" ; 
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_FormQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDisplayType($row['display_type']);
				$sqbData->setPageIds($row['page_ids']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
