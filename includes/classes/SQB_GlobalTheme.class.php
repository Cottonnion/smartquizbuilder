<?php 

class SQB_GlobalTheme {
	public $id;
	public $quiz_id;
	public $name;
	public $value;
	public $status;
	public $date;
	public $type;
	public $custom_values;
	public $outer_style_status;

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
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name	 = $o;
	}
	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value	 = $o;
	}
	function getStatus() {
		return $this->status;
	}
	function setStatus($o) {
		$this->status	 = $o;
	}
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}
	
	function getCustomValues() {
		return $this->custom_values;
	}
	function setCustomValues($o) {
		$this->custom_values = $o;
	}
	
	function getOuterStyleStatus(){
		return $this->outer_style_status;
	}
	function setOuterStyleStatus($o) {
		$this->outer_style_status = $o;
	}
	
	
	public function create(){
		
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			
			$sql = "SELECT id FROM " . $tableName . " WHERE `quiz_id` ='".$this->getQuizId()."' and `name` ='".$this->getName()."' AND type = '".$this->getType()."'" ;
			$exit_id = $wpdb->get_var($sql);

			if(empty($exit_id)){
				$data = array(
					'quiz_id'=> $this->getQuizId(),
					'name'=> $this->getName(),
					'value'=> $this->getValue(),
					'status'=> $this->getStatus(),
					'date'=> $this->getDate(),
					'type'=> $this->getType(),
					'custom_values'=> $this->getCustomValues(),
					'outer_style_status'=> $this->getOuterStyleStatus(),
				);
				
				$wpdb->insert($tableName, $data); 
				$id = $wpdb->insert_id;
				return $lastid = $id;
			}else{
				$data = array(
					'quiz_id'=> $this->getQuizId(),
					'name'=> $this->getName(),
					'value'=> $this->getValue(),
					'status'=> $this->getStatus(),
					'type'=> $this->getType(),			 
					'custom_values'=> $this->getCustomValues(),	
					'outer_style_status'=> $this->getOuterStyleStatus(),		
				);
				$wpdb->update($tableName,$data,array('id'=> $exit_id),null,null);
				$id = $exit_id;
				return $lastid = $id;
			}
			
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public function update(){
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'name'=> $this->getName(),
				'value'=> $this->getValue(),
				'status'=> $this->getStatus(),
				'type'=> $this->getType(),			 
				'custom_values'=> $this->getCustomValues(),	
				'outer_style_status'=> $this->getOuterStyleStatus(),		
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
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows)){				 				
				$row = $rows[0];
				$sqbData = new SQB_GlobalTheme();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);	 
				$sqbData->setName($row['name']);	 
				$sqbData->setValue($row['value']);	 
				$sqbData->setStatus($row['status']);	 
				$sqbData->setDate($row['date']);
				$sqbData->setType($row['type']);
				$sqbData->setCustomValues($row['custom_values']);
				$sqbData->setOuterStyleStatus($row['outer_style_status']);
				
									
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbDataArray = array();
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_GlobalTheme();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setValue($row['value']);	 
					$sqbData->setStatus($row['status']);
					$sqbData->setDate($row['date']);
					$sqbData->setType($row['type']);
					$sqbData->setCustomValues($row['custom_values']);
					$sqbData->setOuterStyleStatus($row['outer_style_status']);
					
					$sqbDataArray[] = $sqbData; 				
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdAndName($quiz_id = 0, $name = '') {
		 
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `name` ='".$name."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			
			if(isset($row)){				 				
				
					$sqbData = new SQB_GlobalTheme();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setValue($row['value']);	 
					$sqbData->setStatus($row['status']);
					$sqbData->setDate($row['date']);
					$sqbData->setType($row['type']);
					$sqbData->setCustomValues($row['custom_values']);
					$sqbData->setOuterStyleStatus($row['outer_style_status']);
					$data = $sqbData; 				
				
			}
			
			return $data;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdAndType($quiz_id = 0, $type = '') {
		 
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `type` ='".$type."' GROUP BY name, quiz_id" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$data = null;
			
			if(isset($rows)){				 				
				foreach($rows as $row) {
					$sqbData = new SQB_GlobalTheme();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setValue($row['value']);	 
					$sqbData->setStatus($row['status']);
					$sqbData->setDate($row['date']);
					$sqbData->setType($row['type']);
					$sqbData->setCustomValues($row['custom_values']);
					$sqbData->setOuterStyleStatus($row['outer_style_status']);
					$data[] = $sqbData; 
				}				
				
			}
			
			return $data;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByQuizIdAndNameAndType($quiz_id = 0, $name = '', $type = '') {
		 
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `name` ='".$name."' and `type` ='".$type."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$data = null;
			
			if(isset($row)){				 				
				
					$sqbData = new SQB_GlobalTheme();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setValue($row['value']);	 
					$sqbData->setStatus($row['status']);
					$sqbData->setDate($row['date']);
					$sqbData->setType($row['type']);
					$sqbData->setCustomValues($row['custom_values']);
					$sqbData->setOuterStyleStatus($row['outer_style_status']);
					$data = $sqbData; 				
				
			}
			
			return $data;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		$sqbDataArray = array();
		try {
			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row) { 			 
					$sqbData = new SQB_GlobalTheme();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);	 
					$sqbData->setValue($row['value']);	 
					$sqbData->setStatus($row['status']);
					$sqbData->setDate($row['date']);	
					$sqbData->setType($row['type']);
					$sqbData->setCustomValues($row['custom_values']);
					$sqbData->setOuterStyleStatus($row['outer_style_status']);	
					$sqbDataArray[] = $sqbData; 
				}
			}
			return $sqbDataArray;
		}catch (Exception $e) {
			throw $e;
		}
		
	}

	public static function DeleteByQuizId($quiz_id) {
		try {

			global $wpdb, $sqb_global_theme;
			$tableName = $wpdb->prefix . $sqb_global_theme;
		
			$wpdb->delete( $tableName, array('quiz_id'=>$quiz_id) );	
			return "deleted";
 
		}catch (Exception $e) {			
			echo $e->getMessage();
		}
	}
	
}	
