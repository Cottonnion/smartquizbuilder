<?php 


class SQB_QuizForm {

	public $id;
	public $quiz_id;
	public $name;
	public $form_id;
	public $value;
	public $required;
	public $type;
	public $placeholder;
	
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



	function getFormId() {
		return $this->form_id;
	}
	function setFormId($o) {
		$this->form_id = $o;
	}



	function getValue() {
		return $this->value;
	}
	function setValue($o) {
		$this->value = $o;
	}



	function getRequired() {
		return $this->required;
	}
	function setRequired($o) {
		$this->required = $o;
	}

	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}

	function getPlaceholder() {
		return $this->placeholder;
	}
	function setPlaceholder($o) {
		$this->placeholder = $o;
	}

	public function create(){
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'name'=> $this->getName(),
				'form_id'=> $this->getFormId(),
				'value'=> $this->getValue(),
				'required'=> $this->getRequired(),
				'type'=> $this->getType(),
				'placeholder'=> $this->getPlaceholder(),
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
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'name'=> $this->getName(),
				'form_id'=> $this->getFormId(),
				'value'=> $this->getValue(),
				'required'=> $this->getRequired(),
				'type'=> $this->getType(),
				'placeholder'=> $this->getPlaceholder(),
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
		
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizId($id) {
		 
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizForm();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setName($row['name']);
				$sqbData->setFormId($row['form_id']);
				$sqbData->setValue($row['value']);
				$sqbData->setRequired($row['required']);
				$sqbData->setType($row['type']);
				$sqbData->setPlaceholder($row['placeholder']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizIdAndName($id, $name) {
		 
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."' AND `name` ='".$name."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizForm();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setName($row['name']);
				$sqbData->setFormId($row['form_id']);
				$sqbData->setValue($row['value']);
				$sqbData->setRequired($row['required']);
				$sqbData->setType($row['type']);
				$sqbData->setPlaceholder($row['placeholder']);
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadArrByQuizId($id) {
		 
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$row = false;
			if(isset($rows) && isset($rows[0])){
				 				
				$row = $rows[0];
							 	
			}
			return $rows;
		}catch (Exception $e) {
			throw $e;
		}
	}
 
	public static function loadValueByQuizIdAndName($quizid, $name) {
		 
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quizid."' AND name='".$name."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);			
			$sqbData = array();
			if(isset($rows) &&  isset($rows[0])){
				$row = $rows[0];
				$sqbData = new SQB_QuizForm();				
				$sqbData->setName($row['name']);		
				$sqbData->setValue($row['value']);			
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	
	public static function load() {
		  
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$sql = "SELECT * FROM " . $tableName." ORDER BY id desc";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
				
					
					$sqbData = new SQB_Quiz();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setName($row['name']);
					$sqbData->setFormId($row['form_id']);
					$sqbData->setValue($row['value']);
					$sqbData->setRequired($row['required']);
					$sqbData->setType($row['type']);
					$sqbData->setPlaceholder($row['placeholder']);
					$sqbArray[] = 	$sqbData;
				}

			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}     

	

	public static function DeleteByQuizId($id = 0) {
		try {
			global $wpdb, $sqb_quiz_form;
			$tableName = $wpdb->prefix . $sqb_quiz_form;
			$wpdb->delete($tableName, array( 'quiz_id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
    
    
    
}
