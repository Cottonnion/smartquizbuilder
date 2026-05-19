<?php
class SQB_EmailTemplate {
	
	var $id;
	var $quiz_id;
	var $type;
	var $template_data;

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
	
	function getType() {
		return $this->type;
	}
	
	function setType($o) {
		$this->type = $o;
	}
	
	function getTemplateData() {
		return $this->template_data;
	}
	
	function setTemplateData($o) {
		$this->template_data = $o;
	}
	
	
	
	public function create() {
		try {
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$data = array(
				'quiz_id'=> $this->getQuizId(), 		 
				'type'=> $this->getType(), 		 
				'template_data'=> $this->getTemplateData(),	 
			);

			$wpdb->insert($tableName, $data);
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function update() {
		try {
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$data = array(
				'quiz_id'=> $this->getQuizId(), 		 
				'type'=> $this->getType(), 		 
				'template_data'=> $this->getTemplateData(),	 
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
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_EmailTemplate();
				$sqbData->setQuizId($row['quiz_id']);		 
				$sqbData->setType($row['type']); 		 
				$sqbData->setTemplateData($row['template_data']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdAndType($id, $type) {
	    global $wpdb, $sqb_email_template;

	    // Initialize an empty variable to hold the result.
	    $sqbData = null;
	    
	    try {
	        // Secure SQL query using wpdb::prepare() to prevent SQL injection.
	        $tableName = $wpdb->prefix . $sqb_email_template;
	        $sql = $wpdb->prepare(
	            "SELECT * FROM $tableName WHERE `quiz_id` = %d AND `type` = %s",
	            $id,
	            $type
	        );

	        // Execute the query and fetch the results.
	        $rows = $wpdb->get_results($sql, ARRAY_A);

	        // Check if rows are returned and process the first result.
	        if (!empty($rows)) {
	            $row = $rows[0];

	            // Create and populate the SQB_EmailTemplate object with data from the database.
	            $sqbData = new SQB_EmailTemplate();
	            $sqbData->setId($row['id']);
	            $sqbData->setQuizId($row['quiz_id']);
	            $sqbData->setType($row['type']);
	            $sqbData->setTemplateData($row['template_data']);
	        }

	    } catch (Exception $e) {
	        // Log the error or handle it appropriately.
	        error_log($e->getMessage());
	        throw $e;  // Rethrow the exception after logging it.
	    }

	    // Return the SQB_EmailTemplate object or null if not found.
	    return $sqbData;
	}

	public static function loadByName($name) {
		try {
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$name."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
				
				$sqbData = new SQB_EmailTemplate();
				$sqbData->setQuizId($row['quiz_id']);		 
				$sqbData->setType($row['type']); 		 
				$sqbData->setTemplateData($row['template_data']);					
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		try {
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_EmailTemplate();
					$sqbData->setQuizId($row['quiz_id']);		 
				$sqbData->setType($row['type']); 		 
				$sqbData->setTemplateData($row['template_data']);	
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_email_template;
			$tableName = $wpdb->prefix . $sqb_email_template;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
?>
