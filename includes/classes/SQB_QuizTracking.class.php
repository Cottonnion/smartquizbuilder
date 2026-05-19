<?php 

class SQB_QuizTracking {
	
	public $id;
	public $quiz_id;
	public $event_name;
	public $custom_action_name;
	public $custom_action_id;
	public $tag;
	public $value;
	public $track_type;
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
	
	function getEventName() {
		return $this->event_name;
	}
	function setEventName($o) {
		$this->event_name = $o;
	}
	
	function getCustomActionName() {
		return $this->custom_action_name;
	}
	function setCustomActionName($o) {
		$this->custom_action_name = $o;
	}
	
	function getCustomActionId() {
		return $this->custom_action_id;
	}
	function setCustomActionId($o) {
		$this->custom_action_id = $o;
	}
	
	function getTag() {
		return $this->tag;
	}
	function setTag($o) {
		$this->tag = $o;
	}
	
	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value = $o;
	}
	
	function getTrackType() {
		return $this->track_type;
	}
	function setTrackType($o) {
		$this->track_type = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}

	function setStatus($o){
		$this->status = $o;
	}
	
	function getStatus(){
		return $this->status;
	}

	public function create(){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix .$sqb_quiz_tracking;
			
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'event_name'=> $this->getEventName(),
				'custom_action_name'=> $this->getCustomActionName(),
				'custom_action_id'=> $this->getCustomActionId(),
				'tag'=> $this->getTag(),				
				'value'=> $this->getValue(),
				'track_type'=> $this->getTrackType(),
				'status' => $this->getStatus()
			);
			
			$wpdb->insert($tableName, $data);
		//	echo $wpdb->last_query;die;
			$id = $wpdb->insert_id;
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public function update(){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'event_name'=> $this->getEventName(),
				'custom_action_name'=> $this->getCustomActionName(),
				'custom_action_id'=> $this->getCustomActionId(),
				'tag'=> $this->getTag(),				
				'value'=> $this->getValue(),
				'track_type'=> $this->getTrackType(),
				'status' => $this->getStatus()
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}

	public function delete(){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			$wpdb->delete( $tableName, array( 'id' => $this->getId() ) );
			
			return '';
		}catch (Exception $e) {
			throw $e;
		}	
	}

	public function deleteByQuizId($quizId) {
	    try {
	        global $wpdb, $sqb_quiz_tracking;
	        $tableName = $wpdb->prefix . $sqb_quiz_tracking;
	        
	        // Use the $wpdb->delete function to delete all rows matching the quiz_id
	        $wpdb->delete($tableName, array('quiz_id' => $quizId));
	        
	        return true; // Return true if the operation succeeds
	    } catch (Exception $e) {
	        // Rethrow the exception for the caller to handle
	        throw $e;
	    }
	}
	
	public static function loadByQuizIdEventAndTrackType($quiz_id, $event_name, $track_type,$question_id = 0, $answer_id = 0,$outcome_id = 0){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `event_name` ='".$event_name."' AND `track_type` = '".$track_type."' " ;
			
			
			
			if($answer_id != 0 && $question_id != 0 ){
				$sql .= " AND `custom_action_name` ='answer' AND `custom_action_id` ='".$answer_id."' ";	
			}else if($question_id != 0 ){
				$sql .= " AND `custom_action_name` ='question' AND `custom_action_id` ='".$question_id."' ";
			}else if($outcome_id != 0 ){
				$sql .= " AND `custom_action_name` ='outcome' AND `custom_action_id` ='".$outcome_id."' ";	
			}
			
			
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = false;
			
			if(isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizTracking();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setEventName($row['event_name']);
				$sqbData->setCustomActionName($row['custom_action_name']);
				$sqbData->setCustomActionId($row['custom_action_id']);
				$sqbData->setTag($row['tag']);
				$sqbData->setValue($row['value']);
				$sqbData->setTrackType($row['track_type']);
				$sqbData->setStatus($row['status']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}		
	}
	
	public static function loadById($id){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'";
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = false;
			
			if(isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizTracking();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setEventName($row['event_name']);
				$sqbData->setCustomActionName($row['custom_action_name']);
				$sqbData->setCustomActionId($row['custom_action_id']);
				$sqbData->setTag($row['tag']);
				$sqbData->setValue($row['value']);
				$sqbData->setTrackType($row['track_type']);
				$sqbData->setStatus($row['status']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}		
	}
	
	public static function loadByQuizId($quiz_id, $track_type){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `track_type` = '".$track_type."'";
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = false;
			
			if(isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizTracking();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setEventName($row['event_name']);
				$sqbData->setCustomActionName($row['custom_action_name']);
				$sqbData->setCustomActionId($row['custom_action_id']);
				$sqbData->setTag($row['tag']);
				$sqbData->setValue($row['value']);
				$sqbData->setTrackType($row['track_type']);
				$sqbData->setStatus($row['status']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}		
	}
	
	public static function loadByOutcomeType($quiz_id){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `custom_action_name` = 'outcome'";
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = false;
			
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_QuizTracking();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setEventName($row['event_name']);
					$sqbData->setCustomActionName($row['custom_action_name']);
					$sqbData->setCustomActionId($row['custom_action_id']);
					$sqbData->setTag($row['tag']);
					$sqbData->setValue($row['value']);
					$sqbData->setTrackType($row['track_type']);
					$sqbData->setStatus($row['status']);
					$sqbArray[] = $sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}		
	}

	public static function loadByCustomJSType($quiz_id,$status = ''){
		try {
			global $wpdb, $sqb_quiz_tracking;
			$tableName = $wpdb->prefix . $sqb_quiz_tracking;
			
			if(!empty($status)){
				$status_where = " AND status = '".$status."'";
			}else{
				$status_where = '';
			}
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `track_type` = 'cjs'".$status_where;
		
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			$sqbData = false;
			
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_QuizTracking();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setEventName($row['event_name']);
					$sqbData->setCustomActionName($row['custom_action_name']);
					$sqbData->setCustomActionId($row['custom_action_id']);
					$sqbData->setTag($row['tag']);
					$sqbData->setValue($row['value']);
					$sqbData->setTrackType($row['track_type']);
					$sqbData->setStatus($row['status']);
					$sqbArray[] = $sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}		
	}

			
}
