<?php 
class SQB_QuizAutoresponder{
	
	var $id;
	var $quiz_id;
	var $name;
	var $action_type;
	var $action_data;
	var $action_id;
	var $action;
	var $date;
	var $outcome_id;
	
	
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
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}
	
	function getAction() {
		return $this->action;
	}
	function setAction($o) {
		$this->action = $o;
	}
	
	
	
	function getActionType() {
		return $this->action_type;
	}
	function setActionType($o) {
		$this->action_type = $o;
	}
	
	function getActionData() {
		return $this->action_data;
	}
	function setActionData($o) {
		$this->action_data = $o;
	}
	
	
	function getActionId() {
		return $this->action_id;     
	}
	function setActionId($o) {
		$this->action_id = $o;
	}

	function getOutcomeId() {
		return $this->outcome_id;     
	}
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	}
	
	
	function getDate() {
		return $this->date;     
	}
	function setDate($o) {
		$this->date = $o;
	}

    public function create(){
		try {
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$data = array(
				'name'=> $this->getName(),
				'quiz_id'=> $this->getQuizId(),
				'action'=> $this->getAction(),
				'action_type'=> $this->getActionType(),
				'action_id'=> $this->getActionId(),
				'outcome_id'=> $this->getOutcomeId(),
				'action_data'=> $this->getActionData(),
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
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$data = array(
				'name'=> $this->getName(),
				'quiz_id'=> $this->getQuizId(),
				'action'=> $this->getAction(),
				'action_type'=> $this->getActionType(),
				'action_id'=> $this->getActionId(),
				'outcome_id'=> $this->getOutcomeId(),
				'action_data'=> $this->getActionData(),
				'date'=> $this->getDate(),
			);
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			return $lastid = @$id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByQuizId($quiz_id = 0){
		
		try {
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData_Array = null;
			if(isset($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_QuizAutoresponder();
					$sqbData->setId($row['id']);
					$sqbData->setName($row['name']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setAction($row['action']);
					$sqbData->setActionType($row['action_type']);
					$sqbData->setActionId($row['action_id']);
					
					$sqbData->setActionData($row['action_data']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setDate($row['date']);
					$sqbData_Array[] =  $sqbData;
				}
			}
			return $sqbData_Array;
		}catch (Exception $e) {
			throw $e;
		}
		
		
		
			
	}
	
	
	
	public static function loadByQuizIdAndAutoresponderName($quiz_id = 0,$autoresponder_name = ''){
		
		try {
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `name` = '".$autoresponder_name."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData_Array = null;
			if(isset($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_QuizAutoresponder();
					$sqbData->setId($row['id']);
					$sqbData->setName($row['name']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setAction($row['action']);
					$sqbData->setActionType($row['action_type']);
					$sqbData->setActionId($row['action_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setActionData($row['action_data']);
					$sqbData->setDate($row['date']);
					$sqbData_Array[] =  $sqbData;
				}
			}
			return $sqbData_Array;
		}catch (Exception $e) {
			throw $e;
		}
		
		
		
			
	}
	
	
	
	public static function loadByQuizIdAndNameAndActionAndActionTypeAndActionIdAndOutcomeId($quiz_id = 0,$name = '',$action = '',$action_type = '',$action_id = '',$outcome_id = ''){
		
		try {
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `name` = '".$name."' and `action` = '".$action."' and `action_type` = '".$action_type."' and `outcome_id` = '".$outcome_id."'  and     `action_id` = '".$action_id."'";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
			
					$sqbData = new SQB_QuizAutoresponder();
					$sqbData->setId($row['id']);
					$sqbData->setName($row['name']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setAction($row['action']);
					$sqbData->setActionType($row['action_type']);
					$sqbData->setActionId($row['action_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setActionData($row['action_data']);
					$sqbData->setDate($row['date']);
					 
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz_autoresponder;
			$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
			$wpdb->delete($tableName, array( 'id' => $id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function DeleteByQuizId($quiz_id = 0) {
		try {
		global $wpdb, $sqb_quiz_autoresponder;
		$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
		$wpdb->delete($tableName, array( 'quiz_id' => $quiz_id ) );
		   return @$id;
		}catch (Exception $e) {
		throw $e;
		}
	}

	public static function deleteByQuizIdAndName($quiz_id = 0, $name='') {
		try {
		global $wpdb, $sqb_quiz_autoresponder;
		$tableName = $wpdb->prefix . $sqb_quiz_autoresponder;
		$wpdb->delete($tableName, array( 'quiz_id' => $quiz_id, 'name' => $name ) );
		   return @$id;
		}catch (Exception $e) {
		throw $e;
		}
	}
	
	
}	
