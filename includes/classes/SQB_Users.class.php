<?php 

class SQB_Users {
	
	public $id;
	public $quiz_id;
	public $user_id;
	public $platform;
	public $total_ques;
	public $correct_answer;
	public $incorrect_answer;
	public $answer_points;
	public $percentage;
	public $date;
	
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
		
	function getUserId() {
		return $this->user_id;
	}
	function setUserId($o) {
		$this->user_id	 = $o;
	}
	
	function getPlatform() {
		return $this->platform;
	}
	function setPlatform($o) {
		$this->platform	 = $o;
	}
	
	function getTotalQues() {
		return $this->total_ques;
	}
	function setTotalQues($o) {
		$this->total_ques	 = $o;
	}
	function getCorrectAnswer() {
		return $this->correct_answer;
	}
	function setCorrectAnswer($o) {
		$this->correct_answer	 = $o;
	}
	function getInCorrectAnswer() {
		return $this->incorrect_answer;
	}
	function setInCorrectAnswer($o) {
		$this->incorrect_answer	 = $o;
	}
	
	function getAnswerPoints() {
		return $this->answer_points;
	}
	function setAnswerPoints($o) {
		$this->answer_points	 = $o;
	}
	function getPercentage() {
		return $this->percentage;
	}
	function setPercentage($o) {
		$this->percentage	 = $o;
	}
	 	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
 
	public function create(){
		try {
			global $wpdb, $sqb_users;
			$tableName = $wpdb->prefix . $sqb_users;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'user_id'=> $this->getUserId(),
				'platform'=> $this->getPlatform(),
				'total_ques'=> $this->getTotalQues(),
				'correct_answer'=> $this->getCorrectAnswer(),
				'incorrect_answer'=> $this->getInCorrectAnswer(),
				'answer_points'=> $this->getAnswerPoints(),
				'percentage'=> $this->getPercentage(),	 		 
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
			global $wpdb, $sqb_users;
			$tableName = $wpdb->prefix . $sqb_users;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'user_id'=> $this->getUserId(),
				'platform'=> $this->getPlatform(),
				'total_ques'=> $this->getTotalQues(),
				'correct_answer'=> $this->getCorrectAnswer(),
				'incorrect_answer'=> $this->getInCorrectAnswer(),
				'answer_points'=> $this->getAnswerPoints(),
				'percentage'=> $this->getPercentage(),	 		 
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
			global $wpdb, $sqb_users;
			$tableName = $wpdb->prefix . $sqb_users;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){ 	 
					
				$row = $rows[0];
				$sqbData = new SQB_Users();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setUserId($row['user_id']);
				$sqbData->setPlatform($row['platform']);
				$sqbData->setTotalQues($row['total_ques']);  
				$sqbData->setCorrectAnswer($row['correct_answer']);  
				$sqbData->setInCorrectAnswer($row['incorrect_answer']);  
				$sqbData->setAnswerPoints($row['answer_points']); 
				$sqbData->setPercentage($row['percentage']);  			 
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteByUserId($user_id = 0) {
		try {
			global $wpdb, $sqb_users;
			$tableName = $wpdb->prefix . $sqb_users;
			$wpdb->delete($tableName, array( 'user_id' => $user_id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	 
}	
