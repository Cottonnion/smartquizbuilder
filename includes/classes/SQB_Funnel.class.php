<?php 

class SQB_Funnel {
	
	public $id;
	public $funnel_name;
	public $funnel_data;
	public $quiz_id;
	public $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getFunnelName() {
		return $this->funnel_name;
	}
	function setFunnelName($o) {
		$this->funnel_name = $o;
	}
	
	function getFunnelData() {
		return $this->funnel_data;
	}
	function setFunnelData($o) {
		$this->funnel_data = $o;
	}
	
	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}
	
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	
	public function create(){
		try {
			global $wpdb, $sqb_quiz_funnel;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel;
			$data = array(
				'funnel_name'=> $this->getFunnelName(),
				'funnel_data'=> $this->getFunnelData(),
				'quiz_id'=> $this->getQuizId(),
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
			global $wpdb, $sqb_quiz_funnel;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel;
			$data = array(
				'funnel_name'=> $this->getFunnelName(),
				'funnel_data'=> $this->getFunnelData(),
				'quiz_id'=> $this->getQuizId(),
				'date'=> $this->getDate(),
			);
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByQuizId($quiz_id) {
		 $sqbData = false;
		try {
			global $wpdb, $sqb_quiz_funnel;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
		
			if(isset($row)){
				
				$sqbData = new SQB_Funnel();
				$sqbData->setId($row['id']);
				$sqbData->setFunnelName($row['funnel_name']);
				$sqbData->setFunnelData($row['funnel_data']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setDate($row['date']);
				
				
			}
		return $sqbData;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
}	
