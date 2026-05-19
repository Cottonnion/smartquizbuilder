<?php 

class SQB_OutComeMapping {
	
	public $id;
	public $quiz_id;
	public $question_id;
	public $answer_id;
	public $outcome_id;
	public $outcome_range;
	public $matrix_mapping;

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
	
	function getQuestionId() {
		return $this->question_id;
	}
	function setQuestionId($o) {
		$this->question_id	 = $o;
	}
	
	function getAnswerId() {
		return $this->answer_id;
	}
	function setAnswerId($o) {
		$this->answer_id	 = $o;
	}
	
	function getOutcomeId() {
		return $this->outcome_id;
	}
	function setOutcomeId($o) {
		$this->outcome_id	 = $o;
	}
	
	function getOutcomeRange() {
		return $this->outcome_range;
	}
	function setOutcomeRange($o) {
		$this->outcome_range	 = $o;
	}

	function getMatrixMapping() {
		return $this->matrix_mapping;
	}
	function setMatrixMapping($o) {
		$this->matrix_mapping	 = $o;
	}
	
	
	public function create(){
		try {
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_id'=> $this->getAnswerId(),
				'outcome_id'=> $this->getOutcomeId(),
				'outcome_range'=> $this->getOutcomeRange(),
				'matrix_mapping'=> $this->getMatrixMapping(),
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
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_id'=> $this->getAnswerId(),
				'outcome_id'=> $this->getOutcomeId(),
				'outcome_range'=> $this->getOutcomeRange(),
				'matrix_mapping'=> $this->getMatrixMapping(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	
	public static function loadByQuizIdQuestionIdAnsId($quiz_id = 0,$question_id = 0,$answer_id = 0) {
		
		
		try {
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `question_id` ='".$question_id."' AND `answer_id` ='".$answer_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				
				$sqbData = new SQB_OutComeMapping();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswerId($row['answer_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setOutcomeRange($row['outcome_range']);
				$sqbData->setMatrixMapping($row['matrix_mapping']);
			}
			 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	 
	public static function loadByQuizId($quiz_id) {
		$sqbDataArray= array();
		try {
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){
				 				
				foreach($rows as $row) { 	
					$sqbData = new SQB_OutComeMapping();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswerId($row['answer_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setOutcomeRange($row['outcome_range']);						
					$sqbData->setMatrixMapping($row['matrix_mapping']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	 
	
	
	public static function loadById($id = 0) {
		
		
		try {
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'";
			$rows = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				
				$sqbData = new SQB_OutComeMapping();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswerId($row['answer_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setOutcomeRange($row['outcome_range']);
				$sqbData->setMatrixMapping($row['matrix_mapping']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
			$wpdb->delete($tableName, array( 'id' => $id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function DeleteByQuizId($quiz_id = 0) {
		try {

			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
		
			$wpdb->delete( $tableName, array('quiz_id'=>$quiz_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	
	public static function DeleteByQuestionId($question_id = 0) {
		try {

			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
		
			$wpdb->delete( $tableName, array('question_id'=>$question_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	
	public static function DeleteByAnswerId($answer_id = 0) {  
		try {

			global $wpdb, $sqb_outcome_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_mapping;
		
			$wpdb->delete( $tableName, array('answer_id'=>$answer_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	
	
}	
