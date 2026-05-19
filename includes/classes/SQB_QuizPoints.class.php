<?php 

class SQB_QuizPoints {
	
	public $id;
	public $give_points;
	public $quiz_id;
	public $points;
	public $pass_criteria;
	public $pass_percent;
	public $retake_pass_rule;
	public $display_message;
	public $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getGivePoints() {
		return $this->give_points;
	}
	function setGivePoints($o) {
		$this->give_points = $o;
	}
	
	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}
		
	function getPoints() {
		return $this->points;
	}
	function setPoints($o) {
		$this->points	 = $o;
	}
	
	function getPassCriteria() {
		return $this->pass_criteria;
	}
	function setPassCriteria($o) {
		$this->pass_criteria	 = $o;
	}
	
	function getPassPercent() {
		return $this->pass_percent;
	}
	function setPassPercent($o) {
		$this->pass_percent	 = $o;
	}
	
	function getRetakePassRule() {
		return $this->retake_pass_rule;
	}
	function setRetakePassRule($o) {
		$this->retake_pass_rule	 = $o;
	}
	 function getDisplayMessage() {
		return $this->display_message;
	}
	function setDisplayMessage($o) {
		$this->display_message = $o;
	}	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
 
	public function create(){
		try {
			global $wpdb, $sqb_quiz_points;
			$tableName = $wpdb->prefix . $sqb_quiz_points;
			$data = array(
				'give_points'=> $this->getGivePoints(),
				'quiz_id'=> $this->getQuizId(),
				'points'=> $this->getPoints(),
				'pass_criteria'=> $this->getPassCriteria(),
				'pass_percent'=> $this->getPassPercent(),
				'retake_pass_rule'=> $this->getRetakePassRule(), 		 
				'display_message'=> $this->getDisplayMessage(), 		 
				'date'=> $this->getDate(),			 
			);
			
			$wpdb->insert($tableName, $data);
			//echo $wpdb->last_query;
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public function update(){
		try {
			global $wpdb, $sqb_quiz_points;
			$tableName = $wpdb->prefix . $sqb_quiz_points;
			$data = array(
				'give_points'=> $this->getGivePoints(),
				'quiz_id'=> $this->getQuizId(),
				'points'=> $this->getPoints(),
				'pass_criteria'=> $this->getPassCriteria(),
				'pass_percent'=> $this->getPassPercent(),
				'retake_pass_rule'=> $this->getRetakePassRule(),	 
				'display_message'=> $this->getDisplayMessage(),	 
				'date'=> $this->getDate(),			  		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function updateByQuizId(){
		try {
			global $wpdb, $sqb_quiz_points;
			$tableName = $wpdb->prefix . $sqb_quiz_points;
			$data = array(
				'give_points'=> $this->getGivePoints(),
				'points'=> $this->getPoints(),
				'pass_criteria'=> $this->getPassCriteria(),
				'pass_percent'=> $this->getPassPercent(),
				'retake_pass_rule'=> $this->getRetakePassRule(),	 
				'display_message'=> $this->getDisplayMessage(),	 
				'date'=> $this->getDate(),			  		 
			);
			$wpdb->update($tableName,$data,array('quiz_id'=>$this->getQuizId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByQuizId($id) {
		 
		try {
			global $wpdb, $sqb_quiz_points;
			$tableName = $wpdb->prefix . $sqb_quiz_points;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
					
				$sqbData = new SQB_QuizPoints();
				$sqbData->setId($row['id']);
				$sqbData->setGivePoints($row['give_points']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setPoints($row['points']);
				$sqbData->setPassCriteria($row['pass_criteria']);
				$sqbData->setPassPercent($row['pass_percent']);
				$sqbData->setRetakePassRule($row['retake_pass_rule']);
				$sqbData->setDisplayMessage($row['display_message']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	 
}	
