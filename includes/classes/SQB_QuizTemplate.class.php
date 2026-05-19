<?php 

class SQB_QuizTemplate {
	
	public $quiz_first_name_template;
	public $id;
	public $start_template;
	public $quiz_id;
	public $quiz_start_template_html;
	public $quiz_result_template_html;
	public $quiz_question_answer_template_html;
	public $quiz_optin_template_html;
	public $start_image;
	public $result_template;
	public $optin_template;
	public $quiz_analyzing_result_template;
	public $ques_template;
	public $common_style;
	public $customizer_html;

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
		$this->quiz_id	 = $o;
	}
	
	function getQuizStartTemplateHtml() {
		return $this->quiz_start_template_html;
	}
	function setQuizStartTemplateHtml($o) {
		$this->quiz_start_template_html	 = $o;
	}

	function getQuizResultTemplateHtml() {
		return $this->quiz_result_template_html;
	}
	function setQuizResultTemplateHtml($o) {
		$this->quiz_result_template_html	 = $o;
	}
	
	function getQuizQuestionAnswerTemplateHtml() {
		return $this->quiz_question_answer_template_html;
	}
	function setQuizQuestionAnswerTemplateHtml($o) {
		$this->quiz_question_answer_template_html	 = $o;
	}
	function getOptinTemplateHtml() {
		return $this->quiz_optin_template_html;
	}
	function setOptinTemplateHtml($o) {
		$this->quiz_optin_template_html	 = $o;
	}
	function getQuesTemplate() {
		return $this->ques_template;
	}
	function setQuesTemplate($o) {
		$this->ques_template	 = $o;
	}
	function getResultTemplate() {
		return $this->result_template;
	}
	function setResultTemplate($o) {
		$this->result_template	 = $o;
	}
	function getStartTemplate() {
		return $this->start_template;
	}
	function setStartTemplate($o) {
		$this->start_template	 = $o;
	}

	function getStartImage() {
		return $this->start_image;
	}
	function setStartImage($o) {
		$this->start_image = $o;
	}

	function getOptinTemplate() {
		return $this->optin_template;
	}
	function setOptinTemplate($o) {
		$this->optin_template	 = $o;
	}
		 	
	function getFirstNameTemplate() {
		return $this->quiz_first_name_template;
	}
	function setFirstNameTemplate($o) {
		$this->quiz_first_name_template	 = $o;
	}

	function getAnalyzingResultTemp() {
		return $this->quiz_analyzing_result_template;
	}
	function setAnalyzingResultTemp($o) {
		$this->quiz_analyzing_result_template = $o;
	}
	
	function getCommonStyle() {
		return $this->common_style;
	}
	function setCommonStyle($o) {
		$this->common_style	 = $o;
	}	 

	function getCustomizerHtml() {
		return $this->customizer_html;
	}

	function setCustomizerHtml($o) {
		$this->customizer_html	 = $o;
	}		
  
	public function create(){
		try {
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'quiz_start_template_html'=> $this->getQuizStartTemplateHtml(),
				'quiz_result_template_html'=> $this->getQuizResultTemplateHtml(),
				'quiz_question_answer_template_html'=> $this->getQuizQuestionAnswerTemplateHtml(),
				'quiz_optin_template_html'=> $this->getOptinTemplateHtml(),
				'start_template'=> $this->getStartTemplate(),
				'start_image'=> $this->getStartImage(),
				'result_template'=> $this->getResultTemplate(),
				'optin_template'=> $this->getOptinTemplate(),		 
				'quiz_first_name_template'=> $this->getFirstNameTemplate(),		 
				'quiz_analyzing_result_template'=> $this->getAnalyzingResultTemp(),		 
				'ques_template'=> $this->getQuesTemplate(),					 	 
				'common_style'=> $this->getCommonStyle(),					 	 
				'customizer_html'=> $this->getCustomizerHtml(),
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
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'quiz_start_template_html'=> $this->getQuizStartTemplateHtml(),
				'quiz_result_template_html'=> $this->getQuizResultTemplateHtml(),
				'quiz_question_answer_template_html'=> $this->getQuizQuestionAnswerTemplateHtml(),
				'quiz_optin_template_html'=> $this->getOptinTemplateHtml(),
				'start_template'=> $this->getStartTemplate(),
				'start_image'=> $this->getStartImage(),
				'result_template'=> $this->getResultTemplate(),
				'optin_template'=> $this->getOptinTemplate(),	
				'quiz_first_name_template'=> $this->getFirstNameTemplate(),		 	 
				'quiz_analyzing_result_template'=> $this->getAnalyzingResultTemp(),		 	 
				'ques_template'=> $this->getQuesTemplate(),	
				'common_style'=> $this->getCommonStyle(),	
				'customizer_html'=> $this->getCustomizerHtml(),		 		 
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
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$data = array(
				'quiz_first_name_template'=> $this->getFirstNameTemplate(),		 	 
				'quiz_analyzing_result_template'=> $this->getAnalyzingResultTemp(),		 	 
			);
			$wpdb->update($tableName,$data,array('quiz_id'=>$this->getQuizId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) && isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizTemplate();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuizStartTemplateHtml($row['quiz_start_template_html']);
				$sqbData->setQuizResultTemplateHtml($row['quiz_result_template_html']);
				$sqbData->setQuizQuestionAnswerTemplateHtml($row['quiz_question_answer_template_html']);
				$sqbData->setOptinTemplateHtml($row['quiz_optin_template_html']);
				$sqbData->setStartTemplate($row['start_template']);
				$sqbData->setStartImage($row['start_image']);
				$sqbData->setResultTemplate($row['result_template']); 		
				$sqbData->setOptinTemplate($row['optin_template']); 
				$sqbData->setFirstNameTemplate($row['quiz_first_name_template']); 
				$sqbData->setAnalyzingResultTemp($row['quiz_analyzing_result_template']); 
				$sqbData->setQuesTemplate($row['ques_template']); 
				$sqbData->setCommonStyle($row['common_style']); 
				$sqbData->setCustomizerHtml($row['customizer_html']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function checkByQuizIdHas($quiz_id) {
		 
		try {
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = false;
			 if(isset($row)){				
				$sqbData = new SQB_QuizTemplate();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuizStartTemplateHtml($row['quiz_start_template_html']);
				$sqbData->setQuizResultTemplateHtml($row['quiz_result_template_html']);
				$sqbData->setQuizQuestionAnswerTemplateHtml($row['quiz_question_answer_template_html']);
				$sqbData->setOptinTemplateHtml($row['quiz_optin_template_html']);
				$sqbData->setStartTemplate($row['start_template']);
				$sqbData->setStartImage($row['start_image']);
				$sqbData->setResultTemplate($row['result_template']); 			 
				$sqbData->setOptinTemplate($row['optin_template']); 
				$sqbData->setFirstNameTemplate($row['quiz_first_name_template']); 
				$sqbData->setAnalyzingResultTemp($row['quiz_analyzing_result_template']); 
				$sqbData->setQuesTemplate($row['ques_template']);
				$sqbData->setCommonStyle($row['common_style']);
				$sqbData->setCustomizerHtml($row['customizer_html']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			 if(isset($rows) && isset($rows[0])){				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizTemplate();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuizStartTemplateHtml($row['quiz_start_template_html']);
				$sqbData->setQuizResultTemplateHtml($row['quiz_result_template_html']);
				$sqbData->setQuizQuestionAnswerTemplateHtml($row['quiz_question_answer_template_html']);
				$sqbData->setOptinTemplateHtml($row['quiz_optin_template_html']);
				$sqbData->setStartTemplate($row['start_template']);
				$sqbData->setStartImage($row['start_image']);
				$sqbData->setResultTemplate($row['result_template']); 			 
				$sqbData->setOptinTemplate($row['optin_template']); 
				$sqbData->setFirstNameTemplate($row['quiz_first_name_template']); 
				$sqbData->setAnalyzingResultTemp($row['quiz_analyzing_result_template']); 
				$sqbData->setQuesTemplate($row['ques_template']);
				$sqbData->setCommonStyle($row['common_style']);
				$sqbData->setCustomizerHtml($row['customizer_html']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function DeleteByQuizId($quiz_id) {
		try {

			global $wpdb, $sqb_quiz_template;
			$tableName = $wpdb->prefix . $sqb_quiz_template;
		
			$wpdb->delete( $tableName, array('quiz_id'=>$quiz_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	

	
}	
