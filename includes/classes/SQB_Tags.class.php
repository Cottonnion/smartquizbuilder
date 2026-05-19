<?php
class SQB_Tags {
	
	var $id;
	var $name;
	var $date;
	var $tag_content;

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
	
	function getContent() {
		return $this->tag_content	;
	}
	
	function setContent($o) {
		$this->tag_content	 = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create() {
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$data = array(
				'name'=> $this->getName(), 		 
				'tag_content'=> $this->getContent(), 		 
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
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$data = array(
				'name'=> $this->getName(), 		 
				'tag_content'=> $this->getContent(),		 
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
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows) && isset($rows[0])){ 	 
				$row = $rows[0];
				$sqbData = new SQB_Tags();
				$sqbData->setId($row['id']);		 
				$sqbData->setName($row['name']);		 
				$sqbData->setContent($row['tag_content']);		 
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByName($name) {
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$sql = "SELECT * FROM " . $tableName . " WHERE `name` ='".$name."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows) && count($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_Tags();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);
				$sqbData->setContent($row['tag_content']);			 
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_Tags();
					$sqbData->setId($row['id']);		 
					$sqbData->setName($row['name']);
					$sqbData->setContent($row['tag_content']);			 
					$sqbData->setDate($row['date']);
					$sqbArray[] = 	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByIdIndex() {
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_Tags();
					$sqbData->setId($row['id']);		 
					$sqbData->setName($row['name']);		 
					$sqbData->setDate($row['date']);
					$sqbData->setContent($row['tag_content']);	
					$sqbArray[$row['id']] =	$sqbData;						
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadTagContentWithTagids($tag_ids){
		try {
			global $wpdb, $sqb_tags;
			$tableName = $wpdb->prefix . $sqb_tags;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` = '".$tag_ids."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_Tags();
				$sqbData->setId($row['id']);		 
				$sqbData->setName($row['name']);		 
				$sqbData->setContent($row['tag_content']);		 
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadTagContentWithTagNames($tagname){
	    try {
	        global $wpdb, $sqb_tags;
	        $tableName = $wpdb->prefix . $sqb_tags;
	        $sql = $wpdb->prepare("SELECT * FROM {$tableName} WHERE `name` = %s", $tagname);
	        $rows = $wpdb->get_results($sql, ARRAY_A);

	        $sqbData = null;

	        if (!empty($rows)) {
	            $row = $rows[0];
	            $sqbData = new SQB_Tags();
	            $sqbData->setId($row['id']);
	            $sqbData->setName($row['name']);
	            $sqbData->setContent($row['tag_content']);
	            $sqbData->setDate($row['date']);
	        }

	        return $sqbData;
	    } catch (Exception $e) {
	        throw $e;
	    }
	}
}
?>
