<?php 

class SQB_Outcome {
 
 	public $id;
	public $quiz_id;
	public $outcome_name;
	public $outcome_html;
	public $point;
	public $point_range;
	public $correct_ans_num;
	public $correct_ans_range;
	public $outcome_screen;
	public $redirect;
	public $tag;
	public $enable_background_image;
	public $pdf_html;
	public $game_animation_html;
	public $customizer_options;
	public $date;
	public $pdf_id;
	 	

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
	function getOutcomeName() {
		return $this->outcome_name;
	}
	function setOutcomeName($o) {
		$this->outcome_name	 = $o;
	}
	function getOutcomeHtml() {
		return $this->outcome_html;
	}
	function setOutcomeHtml($o) {
		$this->outcome_html	 = $o;
	} 	
	function getPoint() {
		return $this->point;
	}
	function setPoint($o) {
		$this->point	 = $o;
	} 	
	function getPointRange() {
		return $this->point_range;
	}
	function setPointRange($o) {
		$this->point_range	 = $o;
	} 	
	function getCorrectAnsNum() {
		return $this->correct_ans_num;
	}
	function setCorrectAnsNum($o) {
		$this->correct_ans_num	 = $o;
	} 	
	function getCorrectAnsRange() {
		return $this->correct_ans_range;
	}
	function setCorrectAnsRange($o) {
		$this->correct_ans_range	 = $o;
	} 	
	function getOutcomeScreen() {
		return $this->outcome_screen;
	}
	function setOutcomeScreen($o) {
		$this->outcome_screen	 = $o;
	} 
		
	function getRedirect() {
		return $this->redirect;
	}
	function setRedirect($o) {
		$this->redirect	 = $o;
	} 	
		
	function getTag() {
		return $this->tag;
	}
	function setTag($o) {
		$this->tag = $o;
	} 	
	
	function getEnableBackgroundImage() {
		return $this->enable_background_image;
	}
	function setEnableBackgroundImage($o) {
		$this->enable_background_image = $o;
	}

	function getPDFHtml() {
		return $this->pdf_html;
	}
	function setPDFHtml($o) {
		$this->pdf_html = $o;
	}

	function getGameAnimationHtml() {
		return $this->game_animation_html;
	}
	function setGameAnimationHtml($o) {
		$this->game_animation_html = $o;
	}

	function getCustomizerOptions() {
		return $this->customizer_options;
	}
	function setCustomizerOptions($o) {
		$this->customizer_options = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	function getPDFId() {
		return $this->pdf_id;
	}

	function setPDFId($o) {
		$this->pdf_id = $o;
	}
	public function updateGameAnimationHtml(){
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'game_animation_html'=> $this->getGameAnimationHtml(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			//echo $wpdb->last_query;die;
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			//logToFile("tableName = ".$tableName, LOG_DEBUG_DAP);
						
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'outcome_name'=> $this->getOutcomeName(),
				'outcome_html'=> $this->getOutcomeHtml(),
				'point'=> $this->getPoint(),
				'point_range'=> $this->getPointRange(),
				'correct_ans_num'=> $this->getCorrectAnsNum(),
				'correct_ans_range'=> $this->getCorrectAnsRange(),
				'redirect'=> $this->getRedirect(),
				'outcome_screen'=> $this->getOutcomeScreen(),
				'tag'=> $this->getTag(),
				'enable_background_image'=> $this->getEnableBackgroundImage(),
				'pdf_html'=> $this->getPDFHtml(),
				'customizer_options'=> $this->getCustomizerOptions(),
				'pdf_id'=> $this->getPDFId(),
				'date'=> $this->getDate(),			 
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
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'outcome_name'=> $this->getOutcomeName(),
				'outcome_html'=> $this->getOutcomeHtml(),
				'point'=> $this->getPoint(),
				'point_range'=> $this->getPointRange(),
				'correct_ans_num'=> $this->getCorrectAnsNum(),
				'correct_ans_range'=> $this->getCorrectAnsRange(),	
				'outcome_screen'=> $this->getOutcomeScreen(),
				'redirect'=> $this->getRedirect(),	 
				'tag'=> $this->getTag(),
				'enable_background_image'=> $this->getEnableBackgroundImage(),
				'pdf_html'=> $this->getPDFHtml(),
				'customizer_options'=> $this->getCustomizerOptions(),
				'pdf_id'=> $this->getPDFId(),
			);

			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		$sqbData = false; 
		 
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows) && isset($rows[0])){					 				
				$row = $rows[0];
				$sqbData = new SQB_Outcome();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setOutcomeName($row['outcome_name']);
				$sqbData->setOutcomeHtml($row['outcome_html']);	 
				$sqbData->setPoint($row['point']);	 
				$sqbData->setPointRange($row['point_range']);	 
				$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
				$sqbData->setCorrectAnsRange($row['correct_ans_range']);	 
				$sqbData->setOutcomeScreen($row['outcome_screen']);	 
				$sqbData->setRedirect($row['redirect']);	 
				$sqbData->setTag($row['tag']);	 
				$sqbData->setEnableBackgroundImage($row['enable_background_image']);	 
				$sqbData->setPDFHtml($row['pdf_html']);	 
				$sqbData->setCustomizerOptions($row['customizer_options']);	 
				$sqbData->setDate($row['date']);	
				$sqbData->setGameAnimationHtml($row['game_animation_html']);
				$sqbData->setPDFId($row['pdf_id']);
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_Outcome();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setOutcomeName($row['outcome_name']);
					$sqbData->setOutcomeHtml($row['outcome_html']);	 
					$sqbData->setPoint($row['point']);	 
					$sqbData->setPointRange($row['point_range']);	 
					$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
					$sqbData->setCorrectAnsRange($row['correct_ans_range']);
					$sqbData->setOutcomeScreen($row['outcome_screen']);	 	
					$sqbData->setRedirect($row['redirect']); 
					$sqbData->setTag($row['tag']);	 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);	
					$sqbData->setPDFHtml($row['pdf_html']);	  
					$sqbData->setCustomizerOptions($row['customizer_options']);	
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbData->setPDFId($row['pdf_id']);
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
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_Outcome();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setOutcomeName($row['outcome_name']);
					$sqbData->setOutcomeHtml($row['outcome_html']);	 
					$sqbData->setPoint($row['point']);	 
					$sqbData->setPointRange($row['point_range']);	 
					$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
					$sqbData->setCorrectAnsRange($row['correct_ans_range']);
					$sqbData->setOutcomeScreen($row['outcome_screen']);	 	
					$sqbData->setRedirect($row['redirect']); 
					$sqbData->setTag($row['tag']);	 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);	
					$sqbData->setPDFHtml($row['pdf_html']);	  
					$sqbData->setCustomizerOptions($row['customizer_options']);	
					$sqbData->setDate($row['date']);		
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbData->setPDFId($row['pdf_id']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
	}
	
	public static function loadByQuizIdAndOutcomeId($quiz_id, $outcomeId) {
		 
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `id`='".$outcomeId."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){			
				$row = $rows[0];	 				
				$sqbData = new SQB_Outcome();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setOutcomeName($row['outcome_name']);
				$sqbData->setOutcomeHtml($row['outcome_html']);	 
				$sqbData->setPoint($row['point']);	 
				$sqbData->setPointRange($row['point_range']);	 
				$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
				$sqbData->setCorrectAnsRange($row['correct_ans_range']);
				$sqbData->setOutcomeScreen($row['outcome_screen']);	 	
				$sqbData->setRedirect($row['redirect']); 
				$sqbData->setTag($row['tag']);	 
				$sqbData->setEnableBackgroundImage($row['enable_background_image']);	
				$sqbData->setPDFHtml($row['pdf_html']);	  
				$sqbData->setCustomizerOptions($row['customizer_options']);	
				$sqbData->setDate($row['date']);
				$sqbData->setGameAnimationHtml($row['game_animation_html']);
				$sqbData->setPDFId($row['pdf_id']);

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function delete($id) {
		try {

			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
		
			$wpdb->delete( $tableName, array('id'=>$id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	
	public static function DeleteByQuizId($quiz_id) {
		try {

			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
		
			$wpdb->delete( $tableName, array('quiz_id'=>$quiz_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}

	public static function loadtags($quiz_id) {
		try {

			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			
			$sql = "SELECT distinct tag FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){
				foreach($rows as $row) { 
					if($row['tag'] != ''){
					$sqbData = new SQB_Outcome();
					$sqbData->setTag($row['tag']);	
					}
				}
			}
			return $sqbData;
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}

	public static function loadByQuizIdAndLimit($quiz_id = 0,$offset = 0, $no_of_row = 0) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' LIMIT ".$offset.", ".$no_of_row ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_Outcome();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setOutcomeName($row['outcome_name']);
					$sqbData->setOutcomeHtml($row['outcome_html']);	 
					$sqbData->setPoint($row['point']);	 
					$sqbData->setPointRange($row['point_range']);	 
					$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
					$sqbData->setCorrectAnsRange($row['correct_ans_range']);
					$sqbData->setOutcomeScreen($row['outcome_screen']);	 	
					$sqbData->setRedirect($row['redirect']); 
					$sqbData->setTag($row['tag']);	 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);	
					$sqbData->setPDFHtml($row['pdf_html']);	  
					$sqbData->setCustomizerOptions($row['customizer_options']);	
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbData->setPDFId($row['pdf_id']);
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function getOutcomeCountByQuizId($quiz_id) {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_outcome;
			$tableName = $wpdb->prefix . $sqb_quiz_outcome;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
					$sqbData = new SQB_Outcome();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setOutcomeName($row['outcome_name']);
					$sqbData->setOutcomeHtml($row['outcome_html']);	 
					$sqbData->setPoint($row['point']);	 
					$sqbData->setPointRange($row['point_range']);	 
					$sqbData->setCorrectAnsNum($row['correct_ans_num']);	 
					$sqbData->setCorrectAnsRange($row['correct_ans_range']);
					$sqbData->setOutcomeScreen($row['outcome_screen']);	 	
					$sqbData->setRedirect($row['redirect']); 
					$sqbData->setTag($row['tag']);	 
					$sqbData->setEnableBackgroundImage($row['enable_background_image']);	
					$sqbData->setPDFHtml($row['pdf_html']);	  
					$sqbData->setCustomizerOptions($row['customizer_options']);	
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbData->setPDFId($row['pdf_id']);
					$sqbDataArray[] = $sqbData;				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
