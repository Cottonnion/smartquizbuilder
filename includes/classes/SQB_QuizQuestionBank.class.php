<?php 

class SQB_QuizQuestionBank {
	
	public $id;
	public $question;
	public $question_title;
	public $question_type;
	public $question_image;
	public $question_order;
	public $date;
	public $ans_with_img;
	public $multiple_correct_ans;
	public $ans_layout;
	public $show_correct_incorrect_ans;
	public $temp_customizer;
	public $allow_skip_ques;
	public $question_file_upload_settings;
	public $next_button_html;
	public $skip_button_html;
	public $enable_background_image;
	public $skip_mapping;
	public $matrix_label_text;
	public $matrix_html;
	public $category_id;
	public $matrix_column_width;
	public $ans_image_setting;
	public $question_setting;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
		
	function getQuestion() {
		return $this->question;
	}
	function setQuestion($o) {
		$this->question	 = $o;
	}
		
	function getQuestionTitle() {
		return $this->question_title;
	}
	function setQuestionTitle($o) {
		$this->question_title	 = $o;
	}
	
	function getQuestionType() {
		return $this->question_type;
	}
	function setQuestionType($o) {
		$this->question_type	 = $o;
	}
	function getQuestionImage() {
		return $this->question_image;
	}
	function setQuestionImage($o) {
		$this->question_image	 = $o;
	}
 	
	function getQuestionOrder() {
		return $this->question_order;
	}
	function setQuestionOrder($o) {
		$this->question_order	 = $o;
	}
	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	
	function getAnsWithImg() {
		return $this->ans_with_img;
	}
	
	function setAnsWithImg($o) {
		$this->ans_with_img = $o;
	}
	
	function getMultipleCorrectAns() {
		return $this->multiple_correct_ans;
	}
	
	function setMultipleCorrectAns($o) {
		$this->multiple_correct_ans = $o;
	}
	
	function getAnsLayout() {
		return $this->ans_layout;
	}
	
	function setAnsLayout($o) {
		$this->ans_layout = $o;
	}
	
	
	
	function getShowCorrectIncorrectAns() {
		return $this->show_correct_incorrect_ans;
	}
	
	function setShowCorrectIncorrectAns($o) {
		$this->show_correct_incorrect_ans = $o;
	}
	
	
	
	function getTempCustomizer() {
		return $this->temp_customizer;
	}
	
	function setTempCustomizer($o) {
		$this->temp_customizer = $o;
	}
	

	function getAllowSkipQues() {
		return $this->allow_skip_ques;
	}
	
	function setAllowSkipQues($o) {
		$this->allow_skip_ques = $o;
	}
	
	function getFileUploadSettings() {
		return $this->question_file_upload_settings;
	}
	
	function setFileUploadSettings($o) {
		$this->question_file_upload_settings = $o;
	}
	
	function getQuestionsNextButtonHtml() {
		return $this->next_button_html;
	}
	
	function setQuestionsNextButtonHtml($o) {
		$this->next_button_html = $o;
	}
	
	function getQuestionsSkipButtonHtml() {
		return $this->skip_button_html;
	}
	
	function setQuestionsSkipButtonHtml($o) {
		$this->skip_button_html = $o;
	}
	
	function getEnableBackgroundImage() {	
		return $this->enable_background_image;
	}
	
	function setEnableBackgroundImage($o) {
		$this->enable_background_image = $o;
	}
	
	function getSkipMapping() {	
		return $this->skip_mapping;
	}
	
	function setSkipMapping($o) {
		$this->skip_mapping = $o;
	}
	
	function getMatrixLabelText() {
		return $this->matrix_label_text;
	}
	
	function setMatrixLabelText($o) {
		$this->matrix_label_text = $o;
	}
	
	function getMatrixHtml() {
		return $this->matrix_html;
	}
	
	function setMatrixHtml($o) {
		$this->matrix_html = $o;
	}
    
    function getCategoryId() {	
		return $this->category_id;
	}
	
	function setCategoryId($o) {
		$this->category_id = $o;
	}

	function getMatrixColumnWidth() {	
		return $this->matrix_column_width;
	}
	
	function setMatrixColumnWidth($o) {
		$this->matrix_column_width = $o;
	}
    
    function getAnsImgSetting() {
		return $this->ans_image_setting;
	}
	
	function setAnsImgSetting($o) {
		$this->ans_image_setting = $o;
	}
	
	function getQuestionSetting() {
		return $this->question_setting;
	}
	
	function setQuestionSetting($o) {
		$this->question_setting = $o;
	}
	
	public function create(){
		try {
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			//logToFile("tableName = ".$tableName, LOG_DEBUG_DAP);
						
			$data = array(
				'question'=> $this->getQuestion(),
				'question_type'=> $this->getQuestionType(),
				'question_title'=> $this->getQuestionTitle(),
				'question_image'=> $this->getQuestionImage(),
				'question_order'=> $this->getQuestionOrder(),
				'ans_with_img'=> $this->getAnsWithImg(),
				'multiple_correct_ans'=> $this->getMultipleCorrectAns(),
				'ans_layout'=> $this->getAnsLayout(),
				'show_correct_incorrect_ans'=> $this->getShowCorrectIncorrectAns(),
				'temp_customizer'=> $this->getTempCustomizer(),
				'allow_skip_ques'=> $this->getAllowSkipQues(),
				'question_file_upload_settings'=> $this->getFileUploadSettings(),
				'next_button_html'=> $this->getQuestionsNextButtonHtml(),
				'skip_button_html'=> $this->getQuestionsSkipButtonHtml(),
				'enable_background_image'=> $this->getEnableBackgroundImage(),
				'skip_mapping'=> $this->getSkipMapping(),
				'date'=> $this->getDate(),
				'matrix_label_text'=> $this->getMatrixLabelText(),			 
				'matrix_html'=> $this->getMatrixHtml(),		
				'category_id'=> $this->getCategoryId(),	 
				'matrix_column_width'=> $this->getMatrixColumnWidth(),	 
				'ans_image_setting'=> $this->getAnsImgSetting(),	 
				'question_setting'=> $this->getQuestionSetting(),	 
			);
			
			$wpdb->insert($tableName, $data);
			
			//echo $wpdb->last_query;die;
			//logToFile("insert_id = ".$wpdb->insert_id, LOG_DEBUG_DAP);
			$id = $wpdb->insert_id;
			return $lastid = $id;
		}catch (Exception $e) {
			return 'error';
			throw $e;
		}	
	}
	
	
	public function update(){
		try {
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$data = array(
				'question'=> $this->getQuestion(),
				'question_type'=> $this->getQuestionType(),
				'question_title'=> $this->getQuestionTitle(),
				'question_image'=> $this->getQuestionImage(),
				'question_order'=> $this->getQuestionOrder(),
				'ans_with_img'=> $this->getAnsWithImg(),
				'multiple_correct_ans'=> $this->getMultipleCorrectAns(),
				'ans_layout'=> $this->getAnsLayout(),
				'show_correct_incorrect_ans'=> $this->getShowCorrectIncorrectAns(),
				'temp_customizer'=> $this->getTempCustomizer(),
				'allow_skip_ques'=> $this->getAllowSkipQues(),
				'question_file_upload_settings'=> $this->getFileUploadSettings(),
				'next_button_html'=> $this->getQuestionsNextButtonHtml(),
				'skip_button_html'=> $this->getQuestionsSkipButtonHtml(),
				'enable_background_image'=> $this->getEnableBackgroundImage(),
				'skip_mapping'=> $this->getSkipMapping(),
				'date'=> $this->getDate(),
				'matrix_label_text'=> $this->getMatrixLabelText(), 	
				'matrix_html'=> $this->getMatrixHtml(),		
				'category_id'=> $this->getCategoryId(), 	
				'matrix_column_width'=> $this->getMatrixColumnWidth(),	 	 
				'ans_image_setting'=> $this->getAnsImgSetting(),
				'question_setting'=> $this->getQuestionSetting(),		 	 
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
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'  order by `question_order` asc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizQuestionBank();
				$sqbData->setId($row['id']);
				$sqbData->setQuestion($row['question']);
				$sqbData->setQuestionTitle($row['question_title']);
				$sqbData->setQuestionType($row['question_type']);
				$sqbData->setQuestionImage($row['question_image']); 			 
				$sqbData->setQuestionOrder($row['question_order']); 
				$sqbData->setAnsWithImg($row['ans_with_img']); 
				$sqbData->setMultipleCorrectAns($row['multiple_correct_ans']); 
				$sqbData->setAnsLayout($row['ans_layout']); 
				$sqbData->setShowCorrectIncorrectAns($row['show_correct_incorrect_ans']); 
				
				$sqbData->setTempCustomizer($row['temp_customizer']); 
				$sqbData->setAllowSkipQues($row['allow_skip_ques']); 
				$sqbData->setFileUploadSettings($row['question_file_upload_settings']);  
				$sqbData->setQuestionsNextButtonHtml($row['next_button_html']); 
				$sqbData->setQuestionsSkipButtonHtml($row['skip_button_html']); 
				$sqbData->setEnableBackgroundImage($row['enable_background_image']); 
				$sqbData->setSkipMapping($row['skip_mapping']); 
				$sqbData->setDate($row['date']);
				$sqbData->setMatrixLabelText($row['matrix_label_text']);	
				$sqbData->setMatrixHtml($row['matrix_html']);	
				$sqbData->setCategoryId($row['category_id']);						
				$sqbData->setMatrixColumnWidth($row['matrix_column_width']);
				$sqbData->setAnsImgSetting($row['ans_image_setting']);
				$sqbData->setQuestionSetting($row['question_setting']);
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizId($id) {
		try {
			global $wpdb, $sqb_quiz_question_bank, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$tableName2 = $wpdb->prefix . $sqb_quiz_questions;
			
			$sql = "SELECT * FROM " . $tableName2 . " WHERE `quiz_id` ='".$id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sql2 = "SELECT `question_order` FROM " . $tableName . " WHERE `id` IN (SELECT `question_id` FROM " . $tableName2 . " WHERE `quiz_id` ='".$id."')  order by `question_order` desc LIMIT 1" ;
			$rows2 = $wpdb->get_row($sql2, ARRAY_A);
			$sqbData = null;
			if(isset($rows2)){ 				
				$row = $rows2;
				$sqbData = new SQB_QuizQuestionBank();
				@$sqbData->setId($row['id']);		 
				$sqbData->setQuestionOrder($row['question_order']); 					
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function getLatestQuestionOrder($id) {

		global $wpdb, $sqb_quiz_question_bank, $sqb_quiz_questions;
		$tableName = $wpdb->prefix . $sqb_quiz_questions;
		$sql = 'SELECT `question_order` FROM '.$tableName.' WHERE `quiz_id` ='.$id.' order by `question_order` desc LIMIT 1';
		$result = $wpdb->get_var($sql);
		
		if(!empty($result)){
			return $result;
		}else{
			return 0;
		}
		
	}

	public static function loadAllByQuizId($id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_question_bank, $sqb_quiz_questions;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$tableName2 = $wpdb->prefix . $sqb_quiz_questions;
			
			$sql = "SELECT * FROM " . $tableName2 . " WHERE `quiz_id` ='".$id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sql2 = "SELECT * FROM " . $tableName . " WHERE `id` IN (SELECT `question_id` FROM " . $tableName2 . " WHERE `quiz_id` ='".$id."')  group by `category_id`" ;

			$rows2 = $wpdb->get_results($sql2, ARRAY_A);
			$sqbData = null;
			if(isset($rows)){
				foreach($rows2 as $row) { 			 
					$sqbData = new SQB_QuizQuestionBank();
					$sqbData->setId($row['id']);
					$sqbData->setQuestion($row['question']);
					$sqbData->setQuestionType($row['question_type']);
					$sqbData->setQuestionTitle($row['question_title']);
					$sqbData->setQuestionImage($row['question_image']); 			 
					$sqbData->setQuestionOrder($row['question_order']); 
					$sqbData->setAnsWithImg($row['ans_with_img']); 
					$sqbData->setMultipleCorrectAns($row['multiple_correct_ans']); 
					$sqbData->setAnsLayout($row['ans_layout']); 			 
					$sqbData->setDate($row['date']);	
					$sqbData->setShowCorrectIncorrectAns($row['show_correct_incorrect_ans']); 
					$sqbData->setTempCustomizer($row['temp_customizer']); 
					$sqbData->setAllowSkipQues($row['allow_skip_ques']);
					$sqbData->setFileUploadSettings($row['question_file_upload_settings']);  
					$sqbData->setQuestionsNextButtonHtml($row['next_button_html']); 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']); 
					$sqbData->setSkipMapping($row['skip_mapping']);
					$sqbData->setMatrixLabelText($row['matrix_label_text']);	
					$sqbData->setMatrixHtml($row['matrix_html']);	
					$sqbData->setCategoryId($row['category_id']);	
					$sqbData->setMatrixColumnWidth($row['matrix_column_width']);
					$sqbData->setAnsImgSetting($row['ans_image_setting']);
					$sqbData->setQuestionSetting($row['question_setting']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}


	public static function loadAllQuestions() {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$sql = "SELECT * FROM " . $tableName ."" ;			 
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_QuizQuestionBank();
					$sqbData->setId($row['id']);
					$sqbData->setQuestion($row['question']);
					$sqbData->setQuestionType($row['question_type']);
					$sqbData->setQuestionTitle($row['question_title']);
					$sqbData->setQuestionImage($row['question_image']); 			 
					$sqbData->setQuestionOrder($row['question_order']); 
					$sqbData->setAnsWithImg($row['ans_with_img']); 
					$sqbData->setMultipleCorrectAns($row['multiple_correct_ans']); 
					$sqbData->setAnsLayout($row['ans_layout']); 			 
					$sqbData->setDate($row['date']);	
					$sqbData->setShowCorrectIncorrectAns($row['show_correct_incorrect_ans']); 
					$sqbData->setTempCustomizer($row['temp_customizer']); 
					$sqbData->setAllowSkipQues($row['allow_skip_ques']);
					$sqbData->setFileUploadSettings($row['question_file_upload_settings']);  
					$sqbData->setQuestionsNextButtonHtml($row['next_button_html']); 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']); 
					$sqbData->setSkipMapping($row['skip_mapping']);
					$sqbData->setMatrixLabelText($row['matrix_label_text']);	
					$sqbData->setMatrixHtml($row['matrix_html']);	
					$sqbData->setCategoryId($row['category_id']);	
					$sqbData->setMatrixColumnWidth($row['matrix_column_width']);
					$sqbData->setAnsImgSetting($row['ans_image_setting']);
					$sqbData->setQuestionSetting($row['question_setting']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}	
	} 
	public static function load() {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quizid` ='".$quizid."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_QuizQuestionBank();
					$sqbData->setId($row['id']);
					$sqbData->setQuestion($row['question']);
					$sqbData->setQuestionType($row['question_type']);
					$sqbData->setQuestionTitle($row['question_title']);
					$sqbData->setQuestionImage($row['question_image']); 			 
					$sqbData->setQuestionOrder($row['question_order']); 
					$sqbData->setAnsWithImg($row['ans_with_img']); 
					$sqbData->setMultipleCorrectAns($row['multiple_correct_ans']); 
					$sqbData->setAnsLayout($row['ans_layout']); 			 
					$sqbData->setDate($row['date']);	
					$sqbData->setShowCorrectIncorrectAns($row['show_correct_incorrect_ans']); 
					$sqbData->setTempCustomizer($row['temp_customizer']); 
					$sqbData->setAllowSkipQues($row['allow_skip_ques']);
					$sqbData->setFileUploadSettings($row['question_file_upload_settings']);  
					$sqbData->setQuestionsNextButtonHtml($row['next_button_html']); 
					$sqbData->setQuestionsSkipButtonHtml($row['skip_button_html']); 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']); 
					$sqbData->setSkipMapping($row['skip_mapping']);
					$sqbData->setMatrixLabelText($row['matrix_label_text']);	
					$sqbData->setMatrixHtml($row['matrix_html']);	
					$sqbData->setCategoryId($row['category_id']);	
					$sqbData->setMatrixColumnWidth($row['matrix_column_width']);
					$sqbData->setAnsImgSetting($row['ans_image_setting']);
					$sqbData->setQuestionSetting($row['question_setting']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz_question_bank;
			$tableName = $wpdb->prefix . $sqb_quiz_question_bank;
			$wpdb->delete($tableName, array( 'id' => $id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
}	
