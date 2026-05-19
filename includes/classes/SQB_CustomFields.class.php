<?php
class SQB_CustomFields {
	
	var $id;
	var $name;
	var $label;
	var $description;
	var $showonlytoadmin;
	var $allowDelete;
	var $required;
	var $field_type;
	var $field_value;
	var $selected_country;
	var $date;

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
	
	function getLabel() {
		return $this->label;
	}
	
	function setLabel($o) {
		$this->label = $o;
	}
	
	function getDescription() {
		return $this->description;
	}
	
	function setDescription($o) {
		$this->description = $o;
	}
	
	function getShowonlytoadmin() {
		return $this->showonlytoadmin;
	}
	
	function setShowonlytoadmin($o) {
		$this->showonlytoadmin = $o;
	}
	
	function getAllowDelete() {
		return $this->allowDelete;
	}
	
	function setAllowDelete($o) {
		$this->allowDelete = $o;
	}
	
	function getRequired() {
		return $this->required;
	}
	
	function setRequired($o) {
		$this->required = $o;
	}
	
	function getFieldType() {
		return $this->field_type;
	}
	function setFieldType($o) {
		$this->field_type = $o;
	}	
	
	function getFieldValue() {
		return $this->field_value;
	}
	function setFieldValue($o) {
		$this->field_value = $o;
	}

	function getSelectedCountry() {
		return $this->selected_country;
	}
	function setSelectedCountry($o) {
		$this->selected_country = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create() {
		try {
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$data = array(
				'name'=> $this->getName(), 		 
				'label'=> $this->getLabel(), 		 
				'description'=> $this->getDescription(),			 			 
				'field_type'=> $this->getFieldType(),			 
				'field_value'=> $this->getFieldValue(),
				'selected_country'=> $this->getSelectedCountry(),
				'required'=> $this->getRequired(),			  
				'date'=> $this->getDate(),			 
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
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$data = array(
				'name'=> $this->getName(), 		 
				'label'=> $this->getLabel(), 		 
				'description'=> $this->getDescription(),			 			 
				'field_type'=> $this->getFieldType(),			 
				'field_value'=> $this->getFieldValue(),	
				'selected_country'=> $this->getSelectedCountry(),		 
				'showonlytoadmin'=> $this->getShowonlytoadmin(),			 
				'allow_delete'=> $this->getAllowDelete(),			 
				'required'=> $this->getRequired(),			  
				'date'=> $this->getDate(),			 
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
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_CustomFields();
				$sqbData->setName($row['name']);		 
				$sqbData->setLabel($row['label']); 		 
				$sqbData->setDescription($row['description']);		 			 
				$sqbData->setFieldType($row['field_type']);			 
				$sqbData->setFieldValue($row['field_value']);			 
				$sqbData->setSelectedCountry($row['selected_country']);			 
				$sqbData->setShowonlytoadmin($row['showonlytoadmin']);			 		 
				$sqbData->setRequired($row['required']);			  
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByName($name) {
		try {
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$name."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){ 	 
				
				$sqbData = new SQB_CustomFields();
				$sqbData->setName($row['name']);		 
				$sqbData->setLabel($row['label']); 		 
				$sqbData->setDescription($row['description']);		 			 
				$sqbData->setFieldType($row['field_type']);			 
				$sqbData->setFieldValue($row['field_value']);
				$sqbData->setSelectedCountry($row['selected_country']);			 
				$sqbData->setShowonlytoadmin($row['showonlytoadmin']);			 		 
				$sqbData->setRequired($row['required']);			  
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		try {
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_CustomFields();
					$sqbData->setId($row['id']);		 
					$sqbData->setName($row['name']);		 
					$sqbData->setLabel($row['label']); 		 
					$sqbData->setDescription($row['description']);		 			 
					$sqbData->setFieldType($row['field_type']);			 
					$sqbData->setFieldValue($row['field_value']);
					$sqbData->setSelectedCountry($row['selected_country']);			 
					$sqbData->setShowonlytoadmin($row['showonlytoadmin']);			 
					$sqbData->setAllowDelete($row['allow_delete']);			 
					$sqbData->setRequired($row['required']);			  
					$sqbData->setDate($row['date']);
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
			global $wpdb, $sqb_custom_fields;
			$tableName = $wpdb->prefix . $sqb_custom_fields;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
?>
