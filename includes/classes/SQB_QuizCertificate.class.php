<?php
class SQB_QuizCertificate {
	
	var $id;
	var $name;
	var $admin_name;
	var $logo_img;
	var $template;
	var $template_html;
	var $options;
	var $status;
	var $signature_img;
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
	
	function getAdminName() {
		return $this->admin_name;
	}
	
	function setAdminName($o) {
		$this->admin_name = $o;
	}

	function getLogoImg() {
		return $this->logo_img;
	}
	
	function setLogoImg($o) {
		$this->logo_img = $o;
	}

	function getSignatureImg() {
		return $this->signature_img;
	}
	
	function setSignatureImg($o) {
		$this->signature_img = $o;
	}

	function getTemplate() {
		return $this->template;
	}
	
	function setTemplate($o) {
		$this->template = $o;
	}

	function getTemplateHtml() {
		return $this->template_html;
	}
	
	function setTemplateHtml($o) {
		$this->template_html = $o;
	}

	function getOptions() {
		return $this->options;
	}
	
	function setOptions($o) {
		$this->options = $o;
	}

	function getStatus() {
		return $this->status;
	}
	
	function setStatus($o) {
		$this->status = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	public function create() {
		try {
			global $wpdb, $sqb_quiz_certificate;
			$tableName = $wpdb->prefix . $sqb_quiz_certificate;
			$data = array(
				'name'=> $this->getName(), 		 
				'admin_name'=> $this->getAdminName(), 		 
				'logo_img'=> $this->getLogoImg(), 		 
				'signature_img'=> $this->getSignatureImg(), 		 
				'template'=> $this->getTemplate(), 		 
				'template_html'=> $this->getTemplateHtml(), 		 
				'options'=> $this->getOptions(), 		 
				'status'=> $this->getStatus(), 		 
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
			global $wpdb, $sqb_quiz_certificate;
			$tableName = $wpdb->prefix . $sqb_quiz_certificate;
			$data = array(
				'name'=> $this->getName(), 		 
				'admin_name'=> $this->getAdminName(), 		 
				'logo_img'=> $this->getLogoImg(), 	
				'signature_img'=> $this->getSignatureImg(), 		 
				'template'=> $this->getTemplate(), 		 
				'template_html'=> $this->getTemplateHtml(), 		 
				'options'=> $this->getOptions(), 		 
				'status'=> $this->getStatus(), 		 
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
			global $wpdb, $sqb_quiz_certificate;
			$tableName = $wpdb->prefix . $sqb_quiz_certificate;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = array();
			if(isset($rows) && isset($rows[0])){ 	 
				$row = $rows[0];
				$sqbData = new SQB_QuizCertificate();
				$sqbData->setId($row['id']);		 
				$sqbData->setName($row['name']);		 
				$sqbData->setAdminName($row['admin_name']);		 
				$sqbData->setLogoImg($row['logo_img']);		 
				$sqbData->setSignatureImg($row['signature_img']);		 
				$sqbData->setTemplate($row['template']);		 
				$sqbData->setTemplateHtml($row['template_html']);		 
				$sqbData->setOptions($row['options']);		 
				$sqbData->setStatus($row['status']);		 
				$sqbData->setDate($row['date']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function load() {
		try {
			global $wpdb, $sqb_quiz_certificate;
			$tableName = $wpdb->prefix . $sqb_quiz_certificate;

			$sql = "SELECT * FROM " . $tableName . " " ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){							 
					$sqbData = new SQB_QuizCertificate();
					$sqbData->setId($row['id']);		 
					$sqbData->setName($row['name']);		 
					$sqbData->setAdminName($row['admin_name']);		 
					$sqbData->setLogoImg($row['logo_img']);		
					$sqbData->setSignatureImg($row['signature_img']);	 
					$sqbData->setTemplate($row['template']);		 
					$sqbData->setTemplateHtml($row['template_html']);		 
					$sqbData->setOptions($row['options']);		 
					$sqbData->setStatus($row['status']);		 
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
			global $wpdb, $sqb_quiz_certificate;
			$tableName = $wpdb->prefix . $sqb_quiz_certificate;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
?>
