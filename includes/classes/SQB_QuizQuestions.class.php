<?php 

class SQB_QuizQuestions {
	public $id;
	public $quiz_id;
	public $question_id;
	public $question_order;
	public $question_ads_html;
	public $show_ads;

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

	function getQuestionOrder() {
		return $this->question_order;
	}
	function setQuestionOrder($o) {
		$this->question_order = $o;
	}

	function getQuestionAdsHtml() {
		return $this->question_ads_html;
	}
	function setQuestionAdsHtml($o) {
		$this->question_ads_html = $o;
	}

	function getShowAds() {
		return $this->show_ads;
	}
	function setShowAds($o) {
		$this->show_ads = $o;
	}
  
	public function create(){
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),	
				'question_order'=> $this->getQuestionOrder(),
				'question_ads_html'=> $this->getQuestionAdsHtml(),
				'show_ads'=> $this->getShowAds(),
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
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'question_order'=> $this->getQuestionOrder(),
				'question_ads_html'=> $this->getQuestionAdsHtml(),
				'show_ads'=> $this->getShowAds(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function updateQuestionOrder(){
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions	;
			$data = array(
				'question_order'=> $this->getQuestionOrder(),
			);
			$wpdb->update($tableName,$data,array('quiz_id'=>$this->getQuizId(), 'question_id'=>$this->getQuestionId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizQuestions();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setQuestionOrder($row['question_order']);
				$sqbData->setQuestionAdsHtml($row['question_ads_html']);
				$sqbData->setShowAds($row['show_ads']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function getQuestionsCountByQuizId($quiz_id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$tableName1 = $wpdb->prefix . $sqb_quiz_question_bank;
			$sql = "select q.question_id, qb.id, q.question_order, q.quiz_id  from " . $tableName . " q, " . $tableName1 . " qb WHERE q.question_id = qb.id AND  `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($quiz_id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);
					$sqbData->setQuestionAdsHtml($row['question_ads_html']);
					$sqbData->setShowAds($row['show_ads']);
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdAndOrder($quiz_id = 0) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY `question_order` ASC" ;

			//echo '<pre>';print_r($sql);
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);		
					$sqbData->setQuestionAdsHtml($row['question_ads_html']);		
					$sqbData->setShowAds($row['show_ads']);	
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdOrderByQuestion($quiz_id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY `question_order` ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);
					$sqbData->setQuestionAdsHtml($row['question_ads_html']);
					$sqbData->setShowAds($row['show_ads']);
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdAndLimit($quiz_id = 0,$offset = 0, $no_of_row = 0) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$tableName1 = $wpdb->prefix . $sqb_quiz_question_bank;
			$sql = "select q.id,q.quiz_id,q.question_id,q.question_order, qb.id from " . $tableName . " q, " . $tableName1 . " qb WHERE q.question_id = qb.id AND `quiz_id` ='".$quiz_id."' ORDER BY `question_order` ASC LIMIT ".$offset.", ".$no_of_row ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);			
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByQuizIdAndQuestionId($quiz_id = 0,$question_id = 0) {
		$sqbDataArray = null;
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `question_id` = '".$question_id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);		
					$sqbData->setQuestionAdsHtml($row['question_ads_html']);	
					$sqbData->setShowAds($row['show_ads']);		
					$sqbDataArray = $sqbData; 				
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function DeleteByQuestionId($question_id = 0) {
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$wpdb->delete($tableName, array( 'question_id' => $question_id ) );
		    return @$id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByQuestionId($question_id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$question_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
 
					$sqbData = new SQB_QuizQuestions();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setQuestionOrder($row['question_order']);			
					$sqbData->setQuestionAdsHtml($row['question_ads_html']);	
					$sqbData->setShowAds($row['show_ads']);	
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function DeleteByQuizIdAndQuestionId($quiz_id = 0,$question_id = 0) {
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$wpdb->delete($tableName, array( 'quiz_id' => $quiz_id, 'question_id' => $question_id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}


	public static function loadByQuestionIdNotArray($id) {
		 
		try {
			global $wpdb, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_questions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizQuestions();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setQuestionOrder($row['question_order']);
				$sqbData->setQuestionAdsHtml($row['question_ads_html']);
				$sqbData->setShowAds($row['show_ads']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
