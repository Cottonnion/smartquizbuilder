<?php 

class SQB_AdvancedCategoryRule {
	
	var $id;
	var $category_id;
	var $quiz_id;
	var $start_range;
	var $end_range;
	var $category_description;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getcategoryId() {
		return $this->category_id;
	}
	function setcategoryId($o) {
		$this->category_id = $o;
	}

	function getquizId() {
		return $this->quiz_id;
	}
	function setquizId($o) {
		$this->quiz_id = $o;
	}

	function setStartRange($o) {
		$this->start_range = $o;
	}
	function getStartRange() {
		return $this->start_range;
	}

	function setEndRange($o) {
		$this->end_range = $o;
	}
	function getEndRange() {
		return $this->end_range;
	}

	function setCategoryDescription($o) {
		$this->category_description = $o;
	}
	function getCategoryDescription() {
		return $this->category_description;
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_advanced_category_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$data = array(				
				'quiz_id'=> $this->getQuizId(),
				'category_id'=> $this->getcategoryId(),
				'start_range'=> $this->getStartRange(),
				'end_range'=> $this->getEndRange(),
				'category_description'=> $this->getCategoryDescription(),
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
			global $wpdb, $sqb_advanced_category_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'category_id'=> $this->getcategoryId(),
				'start_range'=> $this->getStartRange(),
				'end_range'=> $this->getEndRange(),
				'category_description'=> $this->getCategoryDescription(),
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
			global $wpdb, $sqb_advanced_category_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_AdvancedCategoryRule();
				$sqbData->setId($row['id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setStartRange($row['start_range']);
				$sqbData->setEndRange($row['end_range']);
				$sqbData->setCategoryDescription($row['category_description']);

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($quiz_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_category_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedCategoryRule();
					$sqbData->setId($row['id']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setStartRange($row['start_range']);
					$sqbData->setEndRange($row['end_range']);
					$sqbData->setCategoryDescription($row['category_description']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByCategoryId($category_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_category_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedCategoryRule();
					$sqbData->setId($row['id']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setStartRange($row['start_range']);
					$sqbData->setEndRange($row['end_range']);
					$sqbData->setCategoryDescription($row['category_description']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByCategoryidAndQuizId($category_id,$quiz_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_category_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedCategoryRule();
				$sqbData->setId($row['id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setStartRange($row['start_range']);
				$sqbData->setEndRange($row['end_range']);
				$sqbData->setCategoryDescription($row['category_description']);					
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function isRangeExists($category_id,$quiz_id,$start_range,$end_range) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_category_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' AND `quiz_id` ='".$quiz_id."' AND ((`start_range` BETWEEN ".$start_range." AND ".$end_range.") OR (end_range BETWEEN ".$start_range." AND ".$end_range."))" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedCategoryRule();
				$sqbData->setId($row['id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setStartRange($row['start_range']);
				$sqbData->setEndRange($row['end_range']);
				$sqbData->setCategoryDescription($row['category_description']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_advanced_category_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_category_rule	;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
}	
