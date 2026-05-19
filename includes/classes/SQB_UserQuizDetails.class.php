<?php 

class SQB_UserQuizDetails {	
	public $id;
	public $user_id;
	public $quiz_id;
	public $question_id;
	public $answer_given;
	public $correct_answer;
	public $correct_ans_id;
	public $answer_text;
	public $date;
	public $points_scored;
	public $total_points;
	public $answer_tag_ids;
	public $other_field;
	public $unique_id;
	
	function getId() {
		return $this->id;
	}
	
	function setId($o) {
		$this->id = $o;
	}
	
	function getUserId() {
		return $this->user_id;
	}
	
	function setUserId($o) {
		$this->user_id = $o;
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
    
    function getAnswerGiven() {
		return $this->answer_given;
	}
	
	function setAnswerGiven($o) {
		$this->answer_given = $o;
	}
    function getCorrectAnswer() {
		return $this->correct_answer;
	}
	
	function setCorrectAnswer($o) {
		$this->correct_answer = $o;
	}
    function getCorrectAnswerId() {
		return $this->correct_ans_id;
	}
	
	function setCorrectAnswerId($o) {
		$this->correct_ans_id = $o;
	}
    function getAnswerText() {
		return $this->answer_text;
	}
	
	function setAnswerText($o) {
		$this->answer_text = $o;
	} 
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}	
	function getPointsScored() {
		return $this->points_scored;
	}
	
	function setPointsScored($o) {
		$this->points_scored = $o;
	}
	
	function getTotalPoints() {
		return $this->total_points;
	}
	
	function setTotalPoints($o) {
		$this->total_points = $o;
	}

	function getAnswerTagIds() {
		return $this->answer_tag_ids;
	}
	
	function setAnswerTagIds($o) {
		$this->answer_tag_ids = $o;
	}

	function getOtherField() {
		return $this->other_field;
	}
	
	function setOtherField($o) {
		$this->other_field = $o;
	}
    
    function getUniqueId() {
		return $this->unique_id;
	}
	function setUniqueId($o) {
		$this->unique_id = $o;
	}

    public function create(){
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$data = array(
				'user_id'=> $this->getUserId(),
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_given'=> $this->getAnswerGiven(),
				'correct_answer'=> $this->getCorrectAnswer(),				 		 		 
				'correct_ans_id'=> $this->getCorrectAnswerId(),				 		 		 
				'answer_text'=> $this->getAnswerText(),				 		 		 
				'total_points'=> $this->getTotalPoints(),				 		 		 
				'answer_tag_ids'=> $this->getAnswerTagIds(),
				'other_field'=> $this->getOtherField(),
				'points_scored'=> $this->getPointsScored(),				 		 		 
				'date'=> $this->getDate(),	
				'unique_id'=> $this->getUniqueId(),			 
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
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$data = array(
				'user_id'=> $this->getUserId(),
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answer_given'=> $this->getAnswerGiven(),
				'correct_answer'=> $this->getCorrectAnswer(),
				'correct_ans_id'=> $this->getCorrectAnswerId(),	
				'answer_text'=> $this->getAnswerText(),	
				'total_points'=> $this->getTotalPoints(),	
				'answer_tag_ids'=> $this->getAnswerTagIds(),	
				'other_field'=> $this->getOtherField(),		 		 		 
				'points_scored'=> $this->getPointsScored(),						 		 		 
				'date'=> $this->getDate(),	
				'unique_id'=> $this->getUniqueId(),			 
			);
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByUserIdAndQuizIdMinAndMaxDate($user_id = 0, $quiz_id = 0,$date_max = '',$date_min = '') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
						
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  AND `quiz_id` ='".$quiz_id."'  AND `date` >= '".$date_min."' AND `date` <= '".$date_max."' " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);  	
					$sqbDataObj->setAnswerText($row['answer_text']);  	
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);	
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;									
				}
				
			} 		
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByUserIdAndQuizIdDate($user_id = 0, $quiz_id = 0,$date= '') {

		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  AND `quiz_id` ='".$quiz_id."'  AND `date` = '".$date."' " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
 
	public static function loadByUserIdAndQuizId($user_id, $quiz_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByUserId($user_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}


	public static function loadByQuizIdStartDateEndDate($quiz_id, $start_date = '',$end_date = '' ) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;

			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  

			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  quiz_id = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  quiz_id = '.$quiz_id;
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

			$sql = "SELECT * FROM " . $tableName .$custom_filter ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
									
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdStartDateEndDateAndScore($quiz_id, $start_date = '',$end_date = '', $score = '', $type='' ) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;

			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  

			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  quiz_id = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  quiz_id = '.$quiz_id;
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

			if($score != ""){
				
					$where_set = true;
					if($type == 'assessment'){
						$custom_filter .= " and points_scored = '".$score."'  GROUP By user_id, points_scored";
					}else{
						$custom_filter .= " and points_scored > '".$score."'  GROUP By user_id, points_scored";
					}
				
			} 

			$sql = "SELECT * FROM " . $tableName .$custom_filter ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteByUserId($user_id = 0) {
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$wpdb->delete($tableName, array( 'user_id' => $user_id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function delete($id = 0) {
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadUserDeatilsByUserIdAndQuizId($user_id, $quiz_id) {
		 
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  AND `quiz_id` ='".$quiz_id."' order by id desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataObj = false;
			 
			if(isset($rows[0])){				 				
				$row = $rows[0];
				$sqbDataObj = new SQB_UserQuizDetails();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setUserId($row['user_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setQuestionId($row['question_id']);
				$sqbDataObj->setAnswerGiven($row['answer_given']);  
				$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
				$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
				$sqbDataObj->setAnswerText($row['answer_text']);   
				$sqbDataObj->setDate($row['date']);		
				$sqbDataObj->setPointsScored($row['points_scored']);		
				$sqbDataObj->setTotalPoints($row['total_points']);	
				$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
				$sqbDataObj->setOtherField($row['other_field']);					 			 	
			}
			return $sqbDataObj;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	
	public static function loadByQuizIdQuestionIdAnswerIdStartDateEndDate($quiz_id = 0, $question_id = 0,$answer_id = 0, $start_date = '',$end_date = '' ) {
		 
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			
			
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  quiz_id = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  quiz_id = '.$quiz_id;
				}
			}	

			if($question_id != '' || $question_id != 0){
				if($where_set){
					$custom_filter .= ' and  question_id = '.$question_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  question_id = '.$question_id;
				}
			}	

			if($answer_id != '' || $answer_id != 0){
				if($where_set){
					$custom_filter .= " and  answer_given LIKE '%".$answer_id."%'";
				}else{
					$where_set = true;
					$custom_filter .= " where  answer_given = '%".$answer_id."%'";
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
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);	
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdTagsIdStartDateEndDate($quiz_id = 0, $tags = '', $start_date = '',$end_date = '' ) {
		try {
			global $wpdb, $sqb_users_quiz_details, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$tagstable = $wpdb->prefix . $sqb_tags;
			$outcometable = $wpdb->prefix . 'sqb_quiz_outcome';
			$manageleadstable = $wpdb->prefix . 'sqb_manage_leads';
			
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if($quiz_id != '' || $quiz_id != 0){
				if($where_set){
					$custom_filter .= ' and  quiz_id = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  quiz_id = '.$quiz_id;
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
			
			$search_tags = '';
			if($tags != ""){
					$where_set = true;
					$search_tags .= " where name LIKE '%".$tags."%'";;
			}
			
			$tags_sql = "SELECT * FROM " . $tagstable .$search_tags;
			$tags_rows = $wpdb->get_results($tags_sql, ARRAY_A);

			$outcome_sql = "SELECT id FROM " . $outcometable ." WHERE tag LIKE '%".$tags."%'";
			$outcome_rows = $wpdb->get_results($outcome_sql, ARRAY_A);

			if(!empty($outcome_rows)){
				$outcome_ids = array();
				foreach($outcome_rows as $outcome_row){
					$outcome_ids[] = $outcome_row['id'];
				}
				$outcome_ids = implode(',',$outcome_ids);

				$manage_leads_sql = "SELECT date FROM " . $manageleadstable ." WHERE outcome IN (".$outcome_ids.")";
				$manage_data = $wpdb->get_results($manage_leads_sql, ARRAY_A);

				if(!empty($manage_data)){
					$date_ids = array();
						foreach($manage_data as $manage_date){
						$date_ids[] = "'".$manage_date['date'];
					}
				}
			}


			
			


			$tags_id = array();
			if(isset($tags_rows)){	
			 foreach($tags_rows as $tags){
				$tags_id[] = $tags['id'];
			 }
			}
			$tags_id = array_unique($tags_id);

			//$sql = "SELECT * FROM " . $tableName .$custom_filter. " AND (answer_tag_ids IN (". implode(',',$tags_id).")  OR date IN (". implode(',',$date_ids).") ) ";
			$sql = "SELECT * FROM " . $tableName .$custom_filter. " AND (answer_tag_ids IN (". implode(',',$tags_id).")) ";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = null;
			if(isset($rows) && count($tags_id)){				 				
				foreach($rows as $row){
					$is_found= false;
					$tag_not_found_flag= false;
					foreach($tags_id as $id){
						//if (str_contains($row['answer_tag_ids'], $id.',')) {
						if (in_array($id,explode(',',$row['answer_tag_ids']))) {
							$is_found = true;
							break;
						} else {
							$tag_not_found_flag = true;
						}
					}
					if(!$is_found){
						continue;
					}

					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setQuestionId($row['question_id']);
					$sqbDataObj->setAnswerGiven($row['answer_given']);  
					$sqbDataObj->setCorrectAnswer($row['correct_answer']); 
					$sqbDataObj->setCorrectAnswerId($row['correct_ans_id']);
					$sqbDataObj->setAnswerText($row['answer_text']);   
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setPointsScored($row['points_scored']);		
					$sqbDataObj->setTotalPoints($row['total_points']);	
					$sqbDataObj->setAnswerTagIds($row['answer_tag_ids']);	
					$sqbDataObj->setOtherField($row['other_field']);	
					$sqbData[] = $sqbDataObj;
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}	
} 
