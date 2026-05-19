<?php 

class SQB_OutcomeRankMapping {
		
	public $id;
	public $quiz_id;
	public $rank_number;
	public $custom_field_name;

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
	
	function getRankNumber() {
		return $this->rank_number;
	}
	function setRankNumber($o) {
		$this->rank_number = $o;
	}
	
	function getCustomFieldName() {
		return $this->custom_field_name;
	}
	function setCustomFieldName($o) {
		$this->custom_field_name = $o;
	}
    
    
    public function create(){
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'rank_number'=> $this->getRankNumber(),
				'custom_field_name'=> $this->getCustomFieldName()
			);
			
			$wpdb->insert($tableName, $data);
			//echo $wpdb->last_query;
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
    
    public function update(){
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'rank_number'=> $this->getRankNumber(),
				'custom_field_name'=> $this->getCustomFieldName()
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByQuizId($quiz_id = 0) {
		 
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArr = array();
			if(isset($rows)){ 	 
				foreach($rows as $row) { 			
					$sqbData = new SQB_OutcomeRankMapping();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setRankNumber($row['rank_number']);
					$sqbData->setCustomFieldName($row['custom_field_name']);

					$sqbDataArr[] = $sqbData;
				}
				return $sqbDataArr;
			}
			return false;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdAndOrderByRank($quiz_id = 0) {
		 
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY rank_number asc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArr = array();
			if(isset($rows)){ 	 
				foreach($rows as $row) { 			
					$sqbData = new SQB_OutcomeRankMapping();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setRankNumber($row['rank_number']);
					$sqbData->setCustomFieldName($row['custom_field_name']);

					$sqbDataArr[] = $sqbData;
				}
				return $sqbDataArr;
			}
			return false;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByQuizIdAndRankNo($quiz_id = 0,$rank_number = 0) {
		 
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `rank_number`= '".$rank_number."' " ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
						
					$sqbData = new SQB_OutcomeRankMapping();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setRankNumber($row['rank_number']);
					$sqbData->setCustomFieldName($row['custom_field_name']);

			}
			return $sqbData;
			
		}catch (Exception $e) {
			throw $e;
		}
	}
	
    
    
    public static function delete($id = 0) {
		try {
			global $wpdb, $sqb_outcome_rank_mapping;
			$tableName = $wpdb->prefix . $sqb_outcome_rank_mapping;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
    
}
