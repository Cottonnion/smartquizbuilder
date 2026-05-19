<?php 

class SQB_QuizAnswers {
	public $id;
	public $question_id;
	public $answer;
	public $answer_title;
	public $correct_answer;
	public $answer_points;
	public $incorrect_answer_info;
	public $correct_answer_info;
	public $answer_order;
	public $date;
	public $matrix_values;
	public $recommendation_html;
	public $tag_ids;
	public $extra_options;

	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
		
	function getQuestionId() {
		return $this->question_id;
	}
	function setQuestionId($o) {
		$this->question_id	 = $o;
	}
	
	function getAnswer() {
		return $this->answer;
	}
	function setAnswer($o) {
		$this->answer	 = $o;
	}
	
	function getAnswerTitle() {
		return $this->answer_title;
	}
	function setAnswerTitle($o) {
		$this->answer_title = $o;
	}
	
	function getCorrectAnswer() {
		return $this->correct_answer;
	}
	function setCorrectAnswer($o) {
		$this->correct_answer	 = $o;
	}
	
	function getAnswerPoints() {
		return $this->answer_points;
	}
	function setAnswerPoints($o) {
		$this->answer_points	 = $o;
	}
	function getIncorrectAnswerInfo() {
		return $this->incorrect_answer_info;
	}
	function setIncorrectAnswerInfo($o) {
		$this->incorrect_answer_info	 = $o;
	}
	function getCorrectAnswerInfo() {
		return $this->correct_answer_info;
	}
	function setCorrectAnswerInfo($o) {
		$this->correct_answer_info	 = $o;
	}
	
	function getAnswerOrder() {
		return $this->answer_order;
	}
	function setAnswerOrder($o) {
		$this->answer_order	 = $o;
	}
	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	function getMatrixValues(){
		return $this->matrix_values;
	}
	function setMatrixValues($o) {
		$this->matrix_values = $o;
	}
	
	function getRecommendationHtml(){
		return $this->recommendation_html;
	}
	function setRecommendationHtml($o) {
		$this->recommendation_html = $o;
	}
 
	function getTagIds(){
		return $this->tag_ids;
	}
	function setTagIds($o) {
		$this->tag_ids = $o;
	}
	function getExtraOptions(){
		return $this->extra_options;
	}
	function setExtraOptions($o) {
		$this->extra_options = $o;
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$data = array(
				'question_id'=> $this->getQuestionId(),
				'answer'=> $this->getAnswer(),
				'answer_title'=> $this->getAnswerTitle(),
				'correct_answer'=> $this->getCorrectAnswer(),
				'answer_points'=> $this->getAnswerPoints(),
				'incorrect_answer_info'=> $this->getIncorrectAnswerInfo(),
				'correct_answer_info'=> $this->getCorrectAnswerInfo(),
				'answer_order'=> $this->getAnswerOrder(),			 		 
				'date'=> $this->getDate(),
				'matrix_values'=> $this->getMatrixValues(),				 
				'recommendation_html'=> $this->getRecommendationHtml(),				 
				'tag_ids'=> $this->getTagIds(),				 
				'extra_options'=> $this->getExtraOptions(),		
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
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$data = array(
				'question_id'=> $this->getQuestionId(),
				'answer'=> $this->getAnswer(),
				'answer_title'=> $this->getAnswerTitle(),
				'correct_answer'=> $this->getCorrectAnswer(),
				'answer_points'=> $this->getAnswerPoints(),
				'incorrect_answer_info'=> $this->getIncorrectAnswerInfo(),
				'correct_answer_info'=> $this->getCorrectAnswerInfo(),
				'answer_order'=> $this->getAnswerOrder(),			 		 
				'date'=> $this->getDate(),
				'matrix_values'=> $this->getMatrixValues(),	
				'recommendation_html'=> $this->getRecommendationHtml(),					 		 
				'tag_ids'=> $this->getTagIds(),		
				'extra_options'=> $this->getExtraOptions(),					 		 
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
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizAnswers();
				$sqbData->setId($row['id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswer($row['answer']);
				$sqbData->setAnswerTitle($row['answer_title']);
				$sqbData->setCorrectAnswer($row['correct_answer']);  
				$sqbData->setAnswerPoints($row['answer_points']); 
				$sqbData->setIncorrectAnswerInfo($row['incorrect_answer_info']); 
				$sqbData->setCorrectAnswerInfo($row['correct_answer_info']); 
				$sqbData->setAnswerOrder($row['answer_order']); 			 
				$sqbData->setDate($row['date']);
				$sqbData->setMatrixValues($row['matrix_values']);								
				$sqbData->setRecommendationHtml($row['recommendation_html']);							
				$sqbData->setTagIds($row['tag_ids']);	
				$sqbData->setExtraOptions($row['extra_options']);

				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByIdAndQuestionId($id= 0, $question_id =0) {
		 
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$question_id."' AND `id` = '".$id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizAnswers();
				$sqbData->setId($row['id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswer($row['answer']);
				$sqbData->setAnswerTitle($row['answer_title']);
				$sqbData->setCorrectAnswer($row['correct_answer']);  
				$sqbData->setAnswerPoints($row['answer_points']); 
				$sqbData->setIncorrectAnswerInfo($row['incorrect_answer_info']); 
				$sqbData->setCorrectAnswerInfo($row['correct_answer_info']); 
				$sqbData->setAnswerOrder($row['answer_order']); 			 
				$sqbData->setDate($row['date']);
				$sqbData->setMatrixValues($row['matrix_values']);								
				$sqbData->setRecommendationHtml($row['recommendation_html']);							
				$sqbData->setTagIds($row['tag_ids']);	
				$sqbData->setExtraOptions($row['extra_options']);

				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuestionId($question_id) {
		$sqbDataArray= array();
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$question_id."' order by `answer_order` asc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){
				 				
				foreach($rows as $row) { 	
					$sqbData = new SQB_QuizAnswers();
					$sqbData->setId($row['id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswer($row['answer']);
					$sqbData->setAnswerTitle($row['answer_title']);
					$sqbData->setCorrectAnswer($row['correct_answer']);  
					$sqbData->setAnswerPoints($row['answer_points']); 
					$sqbData->setIncorrectAnswerInfo($row['incorrect_answer_info']); 
					$sqbData->setCorrectAnswerInfo($row['correct_answer_info']);  		 		 
					$sqbData->setAnswerOrder($row['answer_order']); 			 
					$sqbData->setDate($row['date']);
					$sqbData->setMatrixValues($row['matrix_values']);	
					$sqbData->setRecommendationHtml($row['recommendation_html']);					
					$sqbData->setTagIds($row['tag_ids']);	
					$sqbData->setExtraOptions($row['extra_options']);

					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByQuestionIdAndAnswerId($question_id = 0,$answer_id = 0) {
		$sqbDataArray= null;
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$question_id."' AND `id` = '".$answer_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = false;
			if(isset($row)){
					$sqbData = new SQB_QuizAnswers();
					$sqbData->setId($row['id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswer($row['answer']);
					$sqbData->setAnswerTitle($row['answer_title']);
					$sqbData->setCorrectAnswer($row['correct_answer']);  
					$sqbData->setAnswerPoints($row['answer_points']); 
					$sqbData->setIncorrectAnswerInfo($row['incorrect_answer_info']); 
					$sqbData->setCorrectAnswerInfo($row['correct_answer_info']);  		 		 
					$sqbData->setAnswerOrder($row['answer_order']); 			 
					$sqbData->setDate($row['date']);
					$sqbData->setMatrixValues($row['matrix_values']);	
					$sqbData->setRecommendationHtml($row['recommendation_html']);					
					$sqbData->setTagIds($row['tag_ids']);	
					$sqbData->setExtraOptions($row['extra_options']);
					$sqbDataArray[] = $sqbData; 
				
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$wpdb->delete($tableName, array( 'id' => $id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function DeleteByQuestionId($question_id = 0) {
		try {
			global $wpdb, $sqb_quiz_answers;
			$tableName = $wpdb->prefix . $sqb_quiz_answers;
			$wpdb->delete($tableName, array( 'question_id' => $question_id ) );
		    return @$id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	

	
}	
