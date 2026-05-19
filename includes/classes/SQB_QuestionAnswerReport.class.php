<?php 

class SQB_QuestionAnswerReport {
	 
	public $id;
	public $quiz_id;
	public $question_id;
	public $answer_id;
	public $outcome_id;
	public $visited;
	public $answered;
	public $date;
	public $other_field;

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
		$this->question_id = $o;
	}   
	function getAnswerId() {
		return $this->answer_id;
	}	
	function setAnswerId($o) {
		$this->answer_id = $o;
	}   
	function getOutcomeId() {
		return $this->outcome_id;
	}	
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	}   
			
	function getVisited() {
		return $this->visited;
	}
	function setVisited($o) {
		$this->visited	 = $o;
	}
	function getAnswered() {
		return $this->answered;
	}
	function setAnswered($o) {
		$this->answered	 = $o;
	}
 
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date	 = $o;
	}

	function getOtherField() {
		return $this->other_field;
	}
	function setOtherField($o) {
		$this->other_field	 = $o;
	}
	
	 
  
	public function create(){
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			$data = array(				 
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_id'=> $this->getAnswerId(),
				'outcome_id'=> $this->getOutcomeId(),				 		 		 
				'visited'=> $this->getVisited(),				 		 		 
				'answered'=> $this->getAnswered(),				 		 		 
				'date'=> $this->getDate(),			
				'other_field'=> $this->getOtherField(),			
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
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_id'=> $this->getAnswerId(),
				'outcome_id'=> $this->getOutcomeId(),				 		 		 
				'visited'=> $this->getVisited(),				 		 		 
				'answered'=> $this->getAnswered(),				 		 		 
				'date'=> $this->getDate(),
				'other_field'=> $this->getOtherField(),	 		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()));
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByQuizIdAndStartDateAndEndDate($quiz_id = 0,$start_date = '',$end_date = '' ) {
		 
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			
			
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  `quiz_id` = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `quiz_id` = '.$quiz_id;
				}
			}	  
			
			if($end_date != ""){
				if($where_set){
					$custom_filter .= " and date <= '".$end_date."'";
				}else{
					$where_set = true;
					$custom_filter .= " where date <= '".$end_date."'";
				}
				
				
				
			} 
			
			$sql = "SELECT * FROM " . $tableName .$custom_filter  ;

			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = null;
			if(isset($rows)){				 				
				foreach($rows as $row){
					$sqbDataObj = new SQB_QuestionAnswerReport();
					$sqbDataObj->setId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']); 		
					$sqbDataObj->setAnswerId($row['answer_id']); 
					$sqbDataObj->setOutcomeId($row['outcome_id']); 
					$sqbDataObj->setVisited($row['visited']); 
					$sqbDataObj->setAnswered($row['answered']); 
					$sqbDataObj->setDate($row['date']); 
					$sqbDataObj->setOtherField($row['other_field']); 
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdQuestionId_AnswerIdStartDateEndDate($quiz_id = 0, $question_id = 0,$answer_id = 0, $start_date = '',$end_date = '' ) {
		 
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			
			
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  `quiz_id` = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `quiz_id` = '.$quiz_id;
				}
			}	

			if($question_id != '' || $question_id != 0){
				if($where_set){
					$custom_filter .= ' and  `question_id` = '.$question_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `question_id` = '.$question_id;
				}
			}	

			if($answer_id != '' || $answer_id != 0){
				if($where_set){
					$custom_filter .= ' and  `answer_id` = '.$answer_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `answer_id` = '.$answer_id;
				}
			}	  
			
			if($end_date != ""){
				if($where_set){
					$custom_filter .= " and date <= '".$end_date."'";
				}else{
					$where_set = true;
					$custom_filter .= " where date <= '".$end_date."'";
				}
				
				
				
			} 
			
			$sql = "SELECT * FROM " . $tableName .$custom_filter;

			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = null;
			if(isset($rows)){				 				
				foreach($rows as $row){
					$sqbDataObj = new SQB_QuestionAnswerReport();
					$sqbDataObj->setId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']); 		
					$sqbDataObj->setAnswerId($row['answer_id']); 
					$sqbDataObj->setOutcomeId($row['outcome_id']); 
					$sqbDataObj->setVisited($row['visited']); 
					$sqbDataObj->setAnswered($row['answered']); 
					$sqbDataObj->setDate($row['date']); 
					$sqbDataObj->setOtherField($row['other_field']); 
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			$sql = "SELECT * FROM " . $tableName . " WHERE id = '".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){				 				
				$row = $rows[0];
				$sqbData = new SQB_QuestionAnswerReport();
				$sqbData->setId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']); 		
				$sqbData->setAnswerId($row['answer_id']); 
				$sqbData->setOutcomeId($row['outcome_id']); 
				$sqbData->setVisited($row['visited']); 
				$sqbData->setAnswered($row['answered']); 
				$sqbData->setDate($row['date']); 
				$sqbData->setOtherField($row['other_field']); 

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function load() {
		 
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			$sql = "SELECT * FROM " . $tableName . " ORDER BY id desc " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){				 				
				$row = $rows[0];
				$sqbData = new sqb_question_answer_report();
				$sqbData->setId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']); 		
				$sqbData->setAnswerId($row['answer_id']); 
				$sqbData->setOutcomeId($row['outcome_id']); 
				$sqbData->setVisited($row['visited']); 
				$sqbData->setAnswered($row['answered']); 
				$sqbData->setDate($row['date']); 
				$sqbDataObj->setOtherField($row['other_field']); 

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	 
	 
	public static function getRatingQuestionReportByDate($q_id = 0,$start_date = '',$end_date = '' ) {
		 
		try {
			global $wpdb, $sqb_question_answer_report;
			$tableName = $wpdb->prefix . $sqb_question_answer_report;
			
			
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if($q_id != '' || $q_id != 0){
				if($where_set){
					$custom_filter .= ' and  `question_id` = '.$q_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `question_id` = '.$q_id;
				}
			}	  
			
			if($end_date != ""){
				if($where_set){
					$custom_filter .= " and date <= '".$end_date." 23:59:59'";
				}else{
					$where_set = true;
					$custom_filter .= " where date <= '".$end_date." 23:59:59'";
				}
				
				
				
			} 
			if($where_set){
					$custom_filter .= " and answer_id <> 0 ";
				}else{
					$where_set = true;
					$custom_filter .= " where answer_id <> 0";
				}
			
			
			$custom_filter .= ' group by answer_id order by total desc';
			
			$sql = "select count(*) as total, answer_id, date FROM  " . $tableName .$custom_filter;
			
						 
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				return $rows;
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	
}	
