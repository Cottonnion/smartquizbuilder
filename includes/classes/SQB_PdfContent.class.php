<?php 

class SQB_PdfContent{
	
	public $id;
	public $name;
	public $content;
	public $other_options;
	public $date;
	
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
		return $this->content;
	}
	function setContent($o) {
		$this->content = $o;
	}
	
	function getOtherOptions() {
		return $this->other_options;
	}
	function setOtherOptions($o) {
		$this->other_options = $o;
	}
	

	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
   
   public function create(){
		try {
			global $wpdb, $sqb_pdf_content;
			$tableName = $wpdb->prefix . $sqb_pdf_content;
			$data = array(
				'name'=> $this->getName(),
				'content'=> $this->getContent(),
				'other_options'=> $this->getOtherOptions(),
				'date'=> $this->getDate()
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
			global $wpdb, $sqb_pdf_content;
			$tableName = $wpdb->prefix . $sqb_pdf_content;
			$data = array(
				'name'=> $this->getName(),
				'content'=> $this->getContent(),
				'other_options'=> $this->getOtherOptions(),
				'date'=> $this->getDate()
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
			global $wpdb, $sqb_pdf_content;
			$tableName = $wpdb->prefix . $sqb_pdf_content;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_PdfContent();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);
				$sqbData->setContent($row['content']);
				$sqbData->setOtherOptions($row['other_options']);
				$sqbData->setDate($row['date']);
					 	
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function load() {
		try {
			global $wpdb, $sqb_pdf_content;
			$tableName = $wpdb->prefix . $sqb_pdf_content;
			$sql = "SELECT * FROM " . $tableName." ORDER BY id desc";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
						$sqbData = new SQB_PdfContent();
						$sqbData->setId($row['id']);
						$sqbData->setName($row['name']);
						$sqbData->setContent($row['content']);
						$sqbData->setOtherOptions($row['other_options']);
						$sqbData->setDate($row['date']);
						$sqbArray[] = 	$sqbData;
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}     
	
	
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_pdf_content;
			$tableName = $wpdb->prefix . $sqb_pdf_content;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
} 
	
	
	

