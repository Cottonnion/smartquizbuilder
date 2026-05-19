<?php 

class SQB_MemberHome {
 
	public $id;
	public $name;
	public $options;
	public $customizer_html;
	public $customizer_options;
	public $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}		
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}

	function getOptions() {
		return $this->options;
	}
	function setOptions($o) {
		$this->options = $o;
	}	
	
	function getCustomizerHtml() {
		return $this->customizer_html;
	}
	function setCustomizerHtml($o) {
		$this->customizer_html = $o;
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
 
	public function create(){
		try {
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			//logToFile("tableName = ".$tableName, LOG_DEBUG_DAP);
						
			$data = array(
				'name'=> $this->getName(),
				'options'=> $this->getOptions(),
				'customizer_html'=> $this->getCustomizerHtml(),		
				'customizer_options'=> $this->getCustomizerOptions(),		
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
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$data = array(
				'name'=> $this->getName(),
				'options'=> $this->getOptions(),
				'customizer_html'=> $this->getCustomizerHtml(),		
				'customizer_options'=> $this->getCustomizerOptions(),		
				'date'=> $this->getDate(),		
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			//echo $wpdb->last_query;die;
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		$sqbData = false; 
		 
		try {
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows) && isset($rows[0])){					 				
				$row = $rows[0];
				$sqbData = new SQB_MemberHome();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);
				$sqbData->setOptions($row['options']);	 
				$sqbData->setCustomizerHtml($row['customizer_html']);	 
				$sqbData->setCustomizerOptions($row['customizer_options']);	 
				$sqbData->setDate($row['date']);	 		
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_MemberHome();
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
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
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
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_MemberHome();
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
					$sqbData->setDate($row['date']);		
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
	}
	
	

	public static function delete($id) {
		try {

			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
		
			$wpdb->delete( $tableName, array('id'=>$id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
	
	public static function DeleteByQuizId($quiz_id) {
		try {

			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
		
			$wpdb->delete( $tableName, array('quiz_id'=>$quiz_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}

	public static function loadtags($quiz_id) {
		try {

			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			
			$sql = "SELECT distinct tag FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows)){
				foreach($rows as $row) { 
					if($row['tag'] != ''){
					$sqbData = new SQB_MemberHome();
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
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' LIMIT ".$offset.", ".$no_of_row ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_MemberHome();
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
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
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
			global $wpdb, $sqb_member_home;
			$tableName = $wpdb->prefix . $sqb_member_home;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			  				
					$sqbData = new SQB_MemberHome();
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
					$sqbData->setDate($row['date']);
					$sqbData->setGameAnimationHtml($row['game_animation_html']);
					$sqbDataArray[] = $sqbData;				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
