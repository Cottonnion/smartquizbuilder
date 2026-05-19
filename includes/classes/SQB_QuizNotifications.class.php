<?php 

class SQB_QuizNotifications {
	public $id;
	public $from_email;
	public $subject;
	public $body;
	public $type;
	public $send_email;
	public $quiz_type;
	public $answer_format;
	public $date;
	public $from_name;
	public $quiz_id;
	public $outcome_id;
	public $quiz_settings;
	public $send_copy;
	public $email_ids;
	public $copy_email_subject;
	public $admin_from_email;
	public $admin_subject;
	public $admin_body;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getFromEmail() {
		return $this->from_email;
	}
	function setFromEmail($o) {
		$this->from_email = $o;
	}

	function getSubject() {
		return $this->subject;
	}
	function setSubject($o) {
		$this->subject = $o;
	}

	function getBody() {
		return $this->body;
	}
	function setBody($o) {
		$this->body = $o;
	}

	function getType() {
		return $this->type;
	}
	function setType($o) {
		$this->type = $o;
	}

	function getSendEmail() {
		return $this->send_email;
	}
	function setSendEmail($o) {
		$this->send_email = $o;
	}

	function getQuizType() {
		return $this->quiz_type;
	}
	function setQuizType($o) {
		$this->quiz_type = $o;
	}

	function getAnswerFormat() {
		return $this->answer_format;
	}
	function setAnswerFormat($o) {
		$this->answer_format = $o;
	}

	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	
	function getFromName() {
		return $this->from_name;
	}
	function setFromName($o) {
		$this->from_name = $o;
	}

	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}

	function getOutcomeId() {
		return $this->outcome_id;
	}
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	}

	function getQuizSettings() {
		return $this->quiz_settings;
	}
	function setQuizSettings($o) {
		$this->quiz_settings = $o;
	}


	function getSendCopy() {
		return $this->send_copy;
	}
	function setSendCopy($o) {
		$this->send_copy = $o;
	}


	function getEmailIds() {
		return $this->email_ids;
	}
	function setEmailIds($o) {
		$this->email_ids = $o;
	}


	function getCopyEmailSubject() {
		return $this->copy_email_subject;
	}
	function setCopyEmailSubject($o) {
		$this->copy_email_subject = $o;
	}

	function getAdminFromEmail() {
		return $this->admin_from_email;
	}
	function setAdminFromEmail($o) {
		$this->admin_from_email = $o;
	}

	function getAdminSubject() {
		return $this->admin_subject;
	}
	function setAdminSubject($o) {
		$this->admin_subject = $o;
	}

	function getAdminBody() {
		return $this->admin_body;
	}
	function setAdminBody($o) {
		$this->admin_body = $o;
	}


	public function create(){
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$data = array(
				'from_email'=> $this->getFromEmail(),
				'subject'=> $this->getSubject(),
				'body'=> $this->getBody(),
				'type'=> $this->getType(),
				'send_email'=> $this->getSendEmail(),
				'quiz_type'=> $this->getQuizType(),
				'answer_format'=> $this->getAnswerFormat(),
				'date'=> $this->getDate(),			 
				'from_name'=> $this->getFromName(),			 
				'quiz_id'=> $this->getQuizId(),			 
				'outcome_id'=> $this->getOutcomeId(),			 
				'quiz_settings'=> $this->getQuizSettings(),
				'send_copy'=> $this->getSendCopy(),
				'email_ids'=> $this->getEmailIds(),
				'copy_email_subject'=> $this->getCopyEmailSubject(),
				'admin_from_email'=> $this->getAdminFromEmail(),
				'admin_subject'=> $this->getAdminSubject(),
				'admin_body'=> $this->getAdminBody(),
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
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$data = array(
				'from_email'=> $this->getFromEmail(),
				'subject'=> $this->getSubject(),
				'body'=> $this->getBody(),
				'type'=> $this->getType(),
				'send_email'=> $this->getSendEmail(),
				'quiz_type'=> $this->getQuizType(),
				'answer_format'=> $this->getAnswerFormat(),
				'date'=> $this->getDate(),	
				'from_name'=> $this->getFromName(),		
				'quiz_id'=> $this->getQuizId(),			 
				'outcome_id'=> $this->getOutcomeId(),			 
				'quiz_settings'=> $this->getQuizSettings(),	
				'send_copy'=> $this->getSendCopy(),	
				'email_ids'=> $this->getEmailIds(),
				'copy_email_subject'=> $this->getCopyEmailSubject(),	
				'admin_from_email'=> $this->getAdminFromEmail(),
				'admin_subject'=> $this->getAdminSubject(),
				'admin_body'=> $this->getAdminBody(),					 		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}


	public static function load() {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);	
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}


	public static function loadByTypeAndQuizType($type,$quiz_type) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `type` ='".$type."' AND `quiz_type` ='".$quiz_type."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByType($type) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `type` ='admin_email'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = null;
			if(isset($rows) && isset($rows[0])){				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setSendEmail($row['send_email']);				 
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);	
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);	
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizidAndQuizType($quizid,$quiztype) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quizid."' AND `quiz_type` ='".$quiztype."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);	
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);					
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizId($quizid) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quizid."'";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData_Array = null;
			if(isset($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_QuizNotifications();
					$sqbData->setId($row['id']);
					$sqbData->setFromEmail($row['from_email']);
					$sqbData->setSubject($row['subject']);
					$sqbData->setBody($row['body']);
					$sqbData->setType($row['type']);
					$sqbData->setSendEmail($row['send_email']);
					$sqbData->setQuizType($row['quiz_type']);
					$sqbData->setAnswerFormat($row['answer_format']);
					$sqbData->setDate($row['date']);	
					$sqbData->setFromName($row['from_name']);
					$sqbData->setQuizId($row['quiz_id']);	
					$sqbData->setOutcomeId($row['outcome_id']);	
					$sqbData->setQuizSettings($row['quiz_settings']);	
					$sqbData->setSendCopy($row['send_copy']);
					$sqbData->setEmailIds($row['email_ids']);
					$sqbData->setCopyEmailSubject($row['copy_email_subject']);					
					$sqbData->setAdminFromEmail($row['admin_from_email']);
					$sqbData->setAdminSubject($row['admin_subject']);
					$sqbData->setAdminBody($row['admin_body']);
					$sqbData_Array[] =  $sqbData;
				}
			}
			return $sqbData_Array;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizidAndQuizTypeQuizSettings($quizid,$quiztype,$quiz_settings) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quizid."' AND `quiz_type` ='".$quiztype."' AND `quiz_settings` ='".$quiz_settings."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);	
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);					
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByTypeAndQuizId($type,$quiz_id) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `type` ='".$type."' AND `quiz_id` ='".$quiz_id."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);						
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByTypeAndOutcomeId($type,$outcome_id) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `type` ='".$type."' AND `outcome_id` ='".$outcome_id."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);						
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByOutcomeId($outcome_id) {
		 
		try {
			global $wpdb, $sqb_quiz_notifications;
			$tableName = $wpdb->prefix . $sqb_quiz_notifications;
			$sql = "SELECT * FROM " . $tableName . " WHERE `outcome_id` ='".$outcome_id."'";

			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows[0])){
				 				
				$row = $rows[0];
				$sqbData = new SQB_QuizNotifications();
				$sqbData->setId($row['id']);
				$sqbData->setFromEmail($row['from_email']);
				$sqbData->setSubject($row['subject']);
				$sqbData->setBody($row['body']);
				$sqbData->setType($row['type']);
				$sqbData->setSendEmail($row['send_email']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setAnswerFormat($row['answer_format']);
				$sqbData->setDate($row['date']);	
				$sqbData->setFromName($row['from_name']);
				$sqbData->setQuizId($row['quiz_id']);	
				$sqbData->setOutcomeId($row['outcome_id']);	
				$sqbData->setQuizSettings($row['quiz_settings']);						
				$sqbData->setSendCopy($row['send_copy']);
				$sqbData->setEmailIds($row['email_ids']);
				$sqbData->setCopyEmailSubject($row['copy_email_subject']);
				$sqbData->setAdminFromEmail($row['admin_from_email']);
				$sqbData->setAdminSubject($row['admin_subject']);
				$sqbData->setAdminBody($row['admin_body']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
