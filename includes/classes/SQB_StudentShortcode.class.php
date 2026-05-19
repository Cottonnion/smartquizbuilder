<?php 

class SQB_StudentShortcode{
	
	public $id;
	public $quiz_ids;
	public $show_course_details;
	public $html;
	public $customzier;
	public $result_btn_text;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	
	function getQuizIds() {
		return $this->quiz_ids;
	}
	function setQuizIds($o) {
		$this->quiz_ids = $o;
	}
	
	function getShowCourseDetails() {
		return $this->show_course_details;
	}
	function setShowCourseDetails($o) {
		$this->show_course_details = $o;
	}
	
	function getHtml() {
		return $this->html;
	}
	
	function setHtml($o) {
		$this->html = $o;
	}
	
	function getCustomzier() {
		return $this->customzier;
	}
	
	function setCustomzier($o) {
		$this->customzier = $o;
	}
	
	function getResultBtnText() {
		return $this->result_btn_text;
	}
	
	function setResultBtnText($o) {
		$this->result_btn_text = $o;
	}
	
	
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
   
   public function create(){
		try {
			global $wpdb, $sqb_student_shortcode;
			$tableName = $wpdb->prefix . $sqb_student_shortcode;
			$data = array(
				'quiz_ids'=> $this->getQuizIds(),
				'show_course_details'=> $this->getShowCourseDetails(),
				'html'=> $this->getHtml(),
				'customzier'=> $this->getCustomzier(),
				'result_btn_text'=> $this->getResultBtnText(),
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
			global $wpdb, $sqb_student_shortcode;
			$tableName = $wpdb->prefix . $sqb_student_shortcode;
			$data = array(
				'quiz_ids'=> $this->getQuizIds(),
				'show_course_details'=> $this->getShowCourseDetails(),
				'html'=> $this->getHtml(),
				'customzier'=> $this->getCustomzier(),
				'result_btn_text'=> $this->getResultBtnText(),
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
			global $wpdb, $sqb_student_shortcode;
			$tableName = $wpdb->prefix . $sqb_student_shortcode;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_StudentShortcode();
				$sqbData->setId($row['id']);
				$sqbData->setQuizIds($row['quiz_ids']);
				$sqbData->setShowCourseDetails($row['show_course_details']);
				$sqbData->setHtml($row['html']);
				$sqbData->setCustomzier($row['customzier']);
				$sqbData->setResultBtnText($row['result_btn_text']);
				
				
				$sqbData->setDate($row['date']);
					 	
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function load() {
		try {
			global $wpdb, $sqb_student_shortcode;
			$tableName = $wpdb->prefix . $sqb_student_shortcode;
			$sql = "SELECT * FROM " . $tableName." ORDER BY id desc";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
						$sqbData = new SQB_StudentShortcode();
						$sqbData->setId($row['id']);
						$sqbData->setQuizIds($row['quiz_ids']);
						$sqbData->setShowCourseDetails($row['show_course_details']);
						$sqbData->setHtml($row['html']);
						$sqbData->setCustomzier($row['customzier']);
						$sqbData->setResultBtnText($row['result_btn_text']);
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
			global $wpdb, $sqb_student_shortcode;
			$tableName = $wpdb->prefix . $sqb_student_shortcode;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
} 
	
	
	

