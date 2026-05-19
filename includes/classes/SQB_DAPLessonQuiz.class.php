<?php 

class SQB_DAPLessonQuiz {
	
	public $id;
	public $quiz_id;
	public $lesson_id;
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
		
	
	
	function getLessonId() {
		return $this->lesson_id;
	}
	function setLessonId($o) {
		$this->lesson_id = $o;
	}
	
	
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
  
	public function create(){
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$data = array(
				
				'quiz_id'=> $this->getQuizId(),
				
				'lesson_id'=> $this->getLessonId(),
				'date'=> $this->getDate()	 
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
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				
				'lesson_id'=> $this->getLessonId(),
				'date'=> $this->getDate(),			  		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByQuizIdLessonId($quiz_id = 0,$lesson_id = 0) {
		 
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `lesson_id` = '".$lesson_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
					
				$sqbData = new SQB_DAPLessonQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				
				$sqbData->setLessonId($row['lesson_id']);
				$sqbData->setDate($row['date']);						
			}
			
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdCourseId($quiz_id = 0,$lesson_id = 0) {
		 
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."' and `lesson_id` = '".$lesson_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
					
				$sqbData = new SQB_DAPLessonQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				
				$sqbData->setLessonId($row['lesson_id']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		 
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){ 	 
				foreach($rows as $row){	
					$sqbData = new SQB_DAPLessonQuiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					
					$sqbData->setLessonId($row['lesson_id']);
					$sqbData->setDate($row['date']);						
					$sqbDataArray[] = $sqbData;						
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByLessonId($lesson_id = 0) {
		$sqbdataArray = array();
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `lesson_id` = '".$lesson_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
				$sqbData = new SQB_DAPLessonQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				
				$sqbData->setLessonId($row['lesson_id']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}

		return $sqbdataarray;
	}
	
	public static function loadQuizByLessonId($lesson_id) {
		$sqbdataArray = array();
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `lesson_id` = '".$lesson_id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
 
			if(isset($rows)){ 	 
				foreach($rows as $row){	
					$sqbData = new SQB_DAPLessonQuiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					
					$sqbData->setLessonId($row['lesson_id']);
					$sqbData->setDate($row['date']);					
					$sqbDataArray[] = $sqbData;					
				}
			}
			 
		}catch (Exception $e) {
			throw $e;
		}
 
		return @$sqbDataArray;
	}
	
	public static function loadByQuizIdLessonIdSingleData($quiz_id = 0,$lesson_id = 0) {
		$sqbdataArray = array();
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` = '".$quiz_id."' and `lesson_id` = '".$lesson_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
				$sqbData = new SQB_DAPLessonQuiz();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				
				$sqbData->setLessonId($row['lesson_id']);
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}

		return $sqbdataarray;
	}
	
	public static function deleteQuizByLessonId($lesson_id) {
		$sqbdataArray = array();
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "delete from  " . $tableName . " WHERE `lesson_id` = '".$lesson_id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
 
			 
		}catch (Exception $e) {
			throw $e;
		}
 
		return 'deleted';
	}
	
	public static function deleteByQuizId($quiz_id) {
		$sqbdataArray = array();
		try {
			global $wpdb, $sqb_dap_lesson_quiz;
			$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
			$sql = "delete from  " . $tableName . " WHERE `quiz_id` = '".$quiz_id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
 
			 
		}catch (Exception $e) {
			throw $e;
		}
 
		return 'deleted';
	}
	
		
	public static function loadByUniqueQuizIdByDistinctKey() { 
		$dap_dbh = Dap_Connection::getConnection(); 
		$sqbdataarray = array();

		//Load product details from database
		global $wpdb, $sqb_dap_lesson_quiz;
		$tableName = $wpdb->prefix . $sqb_dap_lesson_quiz;
		$sql = "select DISTINCT quiz_id from  " . $tableName; 
		$rows = $wpdb->get_results($sql, ARRAY_A);
		if(isset($rows)){ 	 
			foreach($rows as $row){	
				$sqbdata = new SQB_DAPLessonQuiz();					
				$sqbdata->setQuizId( stripslashes($row["quiz_id"]) ); 
				$sqbdataarray[] = $sqbdata;
			}
		}
 
		return $sqbdataarray;
	} 
}	
