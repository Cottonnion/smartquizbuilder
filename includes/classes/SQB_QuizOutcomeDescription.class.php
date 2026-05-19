<?php 

class SQB_QuizOutcomeDescription {
	
	var $id;
	var $outcome_id;
	var $quiz_id;
	var $description;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getOutcomeId() {
		return $this->outcome_id;
	}
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	}

	function getquizId() {
		return $this->quiz_id;
	}
	function setquizId($o) {
		$this->quiz_id = $o;
	}

	function setDescription($o) {
		$this->description = $o;
	}
	function getDescription() {
		return $this->description;
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_quiz_outcome_description	;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description;
			$data = array(				
				'quiz_id'=> $this->getQuizId(),
				'outcome_id'=> $this->getOutcomeId(),
				'quiz_id'=> $this->getQuizId(),
				'description'=> $this->getDescription(),
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
			global $wpdb, $sqb_quiz_outcome_description;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'outcome_id'=> $this->getOutcomeId(),
				'quiz_id'=> $this->getQuizId(),
				'description'=> $this->getDescription(),
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
			global $wpdb, $sqb_quiz_outcome_description	;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_QuizOutcomeDescription();
				$sqbData->setId($row['id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDescription($row['description']);

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($quiz_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_quiz_outcome_description;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_QuizOutcomeDescription();
					$sqbData->setId($row['id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setDescription($row['description']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByOutcomeId($outcome_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_quiz_outcome_description;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `outcome_id` ='".$outcome_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_QuizOutcomeDescription();
					$sqbData->setId($row['id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setDescription($row['description']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByOutcomeidAndQuizId($outcome_id,$quiz_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_quiz_outcome_description	;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `outcome_id` ='".$outcome_id."' AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_QuizOutcomeDescription();
				$sqbData->setId($row['id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDescription($row['description']);					
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz_outcome_description	;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome_description	;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
}	
