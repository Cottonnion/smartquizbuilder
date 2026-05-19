<?php 

class SQB_ManageLeads {
	public $id;
	public $user_id;
	public $quiz_id;
	public $clicked;
	public $how_many_answered;
	public $completed;
	public $opted_in;
	public $gdpr_opted_in;
	public $shown_outcome;
	public $outcome;
	public $clicked_on_cta;
	public $total_attempts;
	public $source;
	public $course_id;
	public $lesson_id;
	public $time_spent;
	public $date;
	public $category_details;
	public $category_total_details;
	public $user_name;
	public $user_source;
	public $unique_id;
	public $certificate_id;
	
	function getId() {
		return $this->id;
	}
	
	function setId($o) {
		$this->id = $o;
	}
	
	function getUserId() {
		return $this->user_id;
	}
	
	function setUserId($o) {
		$this->user_id = $o;
	}
	function getQuizId() {
		return $this->quiz_id;
	}
	
	function setQuizId($o) {
		$this->quiz_id = $o;
	}

    function getClicked() {
		return $this->clicked;
	}
	
	function setClicked($o) {
		$this->clicked = $o;
	}
    
    function getHowManyAnswered() {
		return $this->how_many_answered;
	}
	
	function setHowManyAnswered($o) {
		$this->how_many_answered = $o;
	}
     
     
    function getCompleted() {
		return $this->completed;
	}
	
	function setCompleted($o) {
		$this->completed = $o;
	}
	
	function getOptedIn() {
		return $this->opted_in;
	}
	
	function setOptedIn($o) {
		$this->opted_in = $o;
	}

	function getGDPROptedIn() {
		return $this->gdpr_opted_in;
	}
	
	function setGDPROptedIn($o) {
		$this->gdpr_opted_in = $o;
	}
	
	function getShownOutcome() {
		return $this->shown_outcome;
	}
	
	function setShownOutcome($o) {
		$this->shown_outcome = $o;
	}
	function getOutcome() {
		return $this->outcome;
	}
	
	function setOutcome($o) {
		$this->outcome = $o;
	}
	
	function getClickedOnCta() {
		return $this->clicked_on_cta;
	}
	
	function setClickedOnCta($o) {
		$this->clicked_on_cta = $o;
	}
	
	function getTotalAttempts() {
		return $this->total_attempts;
	}
	
	function setTotalAttempts($o) {
		$this->total_attempts = $o;
	}
	function getSource() {
		return $this->source;
	}
	
	function setSource($o) {
		$this->source = $o;
	}
	
	function getCourseId() {
		return $this->course_id;
	}
	
	function setCourseId($o) {
		$this->course_id = $o;
	}
	
	function getLessonId() {
		return $this->lesson_id;
	}
	
	function setLessonId($o) {
		$this->lesson_id = $o;
	}
	
	function getTimeSpent() {
		return $this->time_spent;
	}
	
	function setTimeSpent($o) {
		$this->time_spent = $o;
	}
	
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
    
    function getCategoryDetails() {
		return $this->category_details;
	}
	
	function setCategoryDetails($o) {
		$this->category_details = $o;
	}

	function getCategoryTotalDetails() {
		return $this->category_total_details;
	}
	
	function setCategoryTotalDetails($o) {
		$this->category_total_details = $o;
	}

    function getUsername() {
		return $this->user_name;
	}
	
	function setUsername($o) {
		$this->user_name = $o;
	}
	function getUserSource() {
		return $this->user_source;
	}
	function setUserSource($o) {
		$this->user_source = $o;
	}

	function getUniqueId() {
		return $this->unique_id;
	}
	function setUniqueId($o) {
		$this->unique_id = $o;
	}

	function setCertificateId($o) {
		$this->certificate_id = $o;
	}

	function getCertificateId() {
		return $this->certificate_id;
	}
    
    public function create(){
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$data = array(
				'user_id'=> $this->getUserId(),
				'quiz_id'=> $this->getQuizId(),
				'clicked'=> $this->getClicked(),
				'how_many_answered'=> $this->getHowManyAnswered(),
				'completed'=> $this->getCompleted(),
				'opted_in'=> $this->getOptedIn(),
				'gdpr_opted_in'=> $this->getGDPROptedIn(),
				'shown_outcome'=> $this->getShownOutcome(),
				'outcome'=> $this->getOutcome(),
				'clicked_on_cta'=> $this->getClickedOnCta(),			 		 
				'total_attempts'=> $this->getTotalAttempts(),
				'source'=> $this->getSource(),				 		 
				'course_id'=> $this->getCourseId(),				 		 
				'lesson_id'=> $this->getLessonId(),				 		 
				'time_spent'=> $this->getTimeSpent(),				 		 
				'date'=> $this->getDate(),			
				'category_details'=> $this->getCategoryDetails(),		 
				'category_total_details'=> $this->getCategoryTotalDetails(),		 
				'user_name'=> $this->getUsername(),	
				'user_source'=> $this->getUserSource(),		 
				'unique_id'=> $this->getUniqueId(),	
				'certificate_id'=> $this->getCertificateId(),	 
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
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$data = array(
				'user_id'=> $this->getUserId(),
				'quiz_id'=> $this->getQuizId(),
				'clicked'=> $this->getClicked(),
				'how_many_answered'=> $this->getHowManyAnswered(),
				'completed'=> $this->getCompleted(),
				'opted_in'=> $this->getOptedIn(),
				'gdpr_opted_in'=> $this->getGDPROptedIn(),
				'shown_outcome'=> $this->getShownOutcome(),
				'outcome'=> $this->getOutcome(),
				'clicked_on_cta'=> $this->getClickedOnCta(),		
				'total_attempts'=> $this->getTotalAttempts(),	
				'source'=> $this->getSource(),
				'course_id'=> $this->getCourseId(),				 		 
				'lesson_id'=> $this->getLessonId(),
				'time_spent'=> $this->getTimeSpent(),				
				'date'=> $this->getDate(),		
				'category_details'=> $this->getCategoryDetails(),	
				'user_name'=> $this->getUsername(),
				'user_source'=> $this->getUserSource(),
				'unique_id'=> $this->getUniqueId(),	
				'certificate_id'=> $this->getCertificateId(),		 		 
			);
			
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadById($id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
				  
				$sqbData = new SQB_ManageLeads();
				$sqbData->setId($row['id']);
				$sqbData->setUserId($row['user_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setUserId($row['user_id']);
				$sqbData->setClicked($row['clicked']);
				$sqbData->setHowManyAnswered($row['how_many_answered']);  
				$sqbData->setCompleted($row['completed']); 
				$sqbData->setOptedIn($row['opted_in']); 
				$sqbData->setGDPROptedIn($row['gdpr_opted_in']); 
				$sqbData->setShownOutcome($row['shown_outcome']); 
				$sqbData->setOutcome($row['outcome']); 
				$sqbData->setClickedOnCta($row['clicked_on_cta']); 			 
				$sqbData->setTotalAttempts($row['total_attempts']); 	
				$sqbData->setSource($row['source']); 				 
				$sqbData->setCourseId($row['course_id']); 				 
				$sqbData->setLessonId($row['lesson_id']); 				 
				$sqbData->setTimeSpent($row['time_spent']);  				 
				$sqbData->setDate($row['date']);	
				$sqbData->setUsername($row['user_name']);	
				$sqbData->setUserSource($row['user_source']);	
				$sqbData->setCertificateId($row['certificate_id']);	
				//$sqbData->setCategoryDetails($row['category_details']);						
				 		 
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function groupByUserId() {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE 1 GROUP BY user_id order by date DESC" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);	
					$sqbDataObj->setCertificateId($row['certificate_id']);		
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function groupByUserIdAndOffset($offset, $limit) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE 1 GROUP BY user_id order by date DESC LIMIT $limit OFFSET $offset" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);	
					$sqbDataObj->setCertificateId($row['certificate_id']);		
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function groupByUserIdAndOffsetCount($offset, $limit) {
	    try {
	        global $wpdb, $sqb_manage_leads;
	        $tableName = $wpdb->prefix . $sqb_manage_leads;
	        $sql = "SELECT COUNT(DISTINCT user_id) AS total_records FROM $tableName ";
	        $totalRecords = $wpdb->get_var($sql);

	        return $totalRecords;
	    } catch (Exception $e) {
	        throw $e;
	    }
	}


	public static function loadByUserIdGroupByQuizIdUserId($user_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM  " . $tableName . " WHERE `user_id` = ".$user_id." GROUP By user_id, quiz_id";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);		
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByAnswertagIds($userid, $quizid) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_users_quiz_details;
			$tableName = $wpdb->prefix . $sqb_users_quiz_details;
			$sql = "SELECT GROUP_CONCAT(answer_tag_ids) as answer_tag_ids FROM " . $tableName . " WHERE `user_id` = '".$userid."' GROUP BY '".$userid."','".$quizid."'";
			$rows = $wpdb->get_row($sql, ARRAY_A);
			
			
			return $rows;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByOutcometagIds($userid, $quizid) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT GROUP_CONCAT(outcome) as outcome FROM " . $tableName . " WHERE `user_id` = '".$userid."' GROUP BY '".$userid."','".$quizid."'";
			$rows = $wpdb->get_row($sql, ARRAY_A);
			
			
			return $rows;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadBySource($source) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `source` = '".$source."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				  
				$sqbDataobj = new SQB_ManageLeads();
				$sqbDataobj->setId($row['id']);
				$sqbDataobj->setUserId($row['user_id']);
				$sqbDataobj->setQuizId($row['quiz_id']);
				$sqbDataobj->setUserId($row['opted_in']);
				$sqbDataobj->setClicked($row['clicked']);
				$sqbDataobj->setHowManyAnswered($row['how_many_answered']);  
				$sqbDataobj->setCompleted($row['completed']); 
				$sqbDataobj->setOptedIn($row['opted_in']); 
				$sqbDataobj->setGDPROptedIn($row['gdpr_opted_in']); 
				$sqbDataobj->setShownOutcome($row['shown_outcome']); 
				$sqbDataobj->setOutcome($row['outcome']); 
				$sqbDataobj->setClickedOnCta($row['clicked_on_cta']); 			 
				$sqbDataobj->setTotalAttempts($row['total_attempts']); 	
				$sqbDataobj->setSource($row['source']); 				 
				$sqbDataobj->setCourseId($row['course_id']); 				 
				$sqbDataobj->setLessonId($row['lesson_id']); 
				$sqbDataObj->setTimeSpent($row['time_spent']);  				
				$sqbDataobj->setDate($row['date']);	
				$sqbDataObj->setUsername($row['user_name']);	
				$sqbDataObj->setUserSource($row['user_source']);	
				//$sqbDataobj->setCategoryDetails($row['category_details']);	
				$sqbData[] = $sqbDataobj;				
				 		 
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
 
	public static function loadByIP($quiz_id,$ip) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads.' WHERE quiz_id = "'.$quiz_id.'" AND unique_id = "'.$ip.'" ';
			$sql = "SELECT * FROM " . $tableName ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']);   			 
					$sqbDataObj->setSource($row['source']);   
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);	
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByUniqueUserID() {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads.'  group by user_id  order by id ASC';
			$sql = "SELECT * FROM " . $tableName ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']);   			 
					$sqbDataObj->setSource($row['source']);   
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);	
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function load() {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);		
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByUserIdAndDateAndSource($user_id = 0,$date = '',$source = '') { 
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$source_sql = '';
			if($source != ''){
				$source_sql = " AND source = '".$source."'";
			}
			
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  and `date` ='".$date."' ".$source_sql." order by date desc" ;
			
			
			
			$row = $wpdb->get_row($sql, ARRAY_A);
				
			if(isset($row)){
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);  
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setCategoryDetails($row['category_details']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);		
					$sqbData = $sqbDataObj;
									
				
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByUserIdAndDate($user_id = 0,$date = '') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."'  and `date` ='".$date."' order by date desc" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
				
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);   
					$sqbDataObj->setTimeSpent($row['time_spent']);  
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);			
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData = $sqbDataObj;
									
				
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByUserId($user_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']); 
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUserSource($row['user_source']);	
					$sqbDataObj->setCategoryDetails($row['category_details']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function loadByUserIdAndBySource($user_id,$source) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' and `source`='".$source."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);  
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByUserIdAndQuizId($quiz_id,$user_id) {

		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` = '".$quiz_id."' AND `user_id` ='".$user_id."'  order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);  
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	
	}
	public static function loadByUserIdAndQuizAndBySource($quiz_id,$user_id,$source) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` = '".$quiz_id."' AND `user_id` ='".$user_id."' and `source`='".$source."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);  
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByCourseId($course_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `course_id` ='".$course_id."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);   	
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByCourseIdAndBySource($course_id ,$source) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `course_id` ='".$course_id."' and `source` = '".$source."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);  
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByQuizId($quiz_id = 0){
		$sqbData = null;
		if($quiz_id == 0){
			return 	$sqbData;
		}
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' order by id desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);   
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function getPeviourDate($user_id = 0 , $quiz_id = 0, $date = 0){
		$sqbData = null;
		if($quiz_id == 0){
			return 	$sqbData;
		}
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql = "SELECT * FROM " . $tableName . " WHERE  `user_id` ='".$user_id."' AND `quiz_id` ='".$quiz_id."' AND `date` < '".$date."'   order by id desc limit 1" ;
			
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
								
					
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);		
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData = $sqbDataObj;
									
				
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function getByQuizidAndStartDateAndEndDate($quiz_id = 0, $start_date = '',  $end_date = ''){
		$sqbData = null;
		
		try {
			
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads; 
			
			$sql_where  = '';
			$where_status = false;
			
			if($quiz_id != 0){
				$sql_where .= "  `quiz_id` ='".$quiz_id."'";
				$where_status = true;
			}
			
			
			if($start_date != ''){
				if($where_status){
					
					$sql_where .= " AND `date` >= '".$start_date."'";
				}else{
					
					$sql_where .= "  `date` >= '".$start_date."'";
				}
				$where_status = true;
			}
			
			if($end_date != ''){
				if($where_status){
					
					$sql_where .= " AND `date` <= '".$end_date."'";
				}else{
					
					$sql_where .= "  `date` <= '".$end_date."'";
				}
				$where_status = true;
			}
			
			if($sql_where != ''){
				$sql_where = " WHERE ".$sql_where;
			}
			
			
			//$sql = "SELECT * FROM " . $tableName .$sql_where. " group by user_id  order by id ASC";   
			 $sql = "SELECT * FROM " . $tableName .$sql_where. " order by id desc";   
			  // echo $sql;die;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
								
					foreach($rows as $row){
						$sqbDataObj = new SQB_ManageLeads();
						$sqbDataObj->setId($row['id']);
						$sqbDataObj->setUserId($row['user_id']);
						$sqbDataObj->setQuizId($row['quiz_id']);
						$sqbDataObj->setClicked($row['clicked']);
						$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
						$sqbDataObj->setCompleted($row['completed']); 
						$sqbDataObj->setOptedIn($row['opted_in']); 
						$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
						$sqbDataObj->setShownOutcome($row['shown_outcome']); 
						$sqbDataObj->setOutcome($row['outcome']); 
						$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
						$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
						$sqbDataObj->setSource($row['source']); 
						$sqbDataObj->setCourseId($row['course_id']); 				 
						$sqbDataObj->setLessonId($row['lesson_id']);   
						$sqbDataObj->setTimeSpent($row['time_spent']);  						
						$sqbDataObj->setDate($row['date']);		
						$sqbDataObj->setUsername($row['user_name']);
						$sqbDataObj->setUserSource($row['user_source']);
						$sqbDataObj->setCertificateId($row['certificate_id']);
						//$sqbDataobj->setCategoryDetails($row['category_details']);	
						$sqbData[] = $sqbDataObj;
					}
									
				
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByQuizType($quiz_type = ''){
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads, $sqb_quiz;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sqb_quizTable = $wpdb->prefix . $sqb_quiz;
			$sql = "SELECT * FROM " . $tableName . " as ml , ".$sqb_quizTable." as sq WHERE sq.id = ml.quiz_id  AND sq.quiz_type ='".$quiz_type."' order by sq.id desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 		
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);	
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function deleteByUserId($user_id = 0) {
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$wpdb->delete($tableName, array( 'user_id' => $user_id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteByUserIdCourseIdAndSource($user_id = 0, $course_id = 0, $source = '') {
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$wpdb->delete($tableName, array( 'user_id' => $user_id, 'course_id'=>$course_id,'source'=>$source) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	
	public static function loadByQuizIdAndUserId($quiz_id, $user_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' And  `quiz_id` ='".$quiz_id."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);
					$sqbDataObj->setCertificateId($row['certificate_id']);
					$sqbDataObj->setCategoryDetails($row['category_details']);
					$sqbDataObj->setCategoryTotalDetails($row['category_total_details']);
					
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdAndUserIdDate($quiz_id, $user_id, $date) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' and `quiz_id` ='".$quiz_id."'  and `date` ='".$date."' order by date desc" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
				
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']); 
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']);   
					$sqbDataObj->setTimeSpent($row['time_spent']);  
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);			
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData = $sqbDataObj;
									
				
				
			
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdAndUserIdAndCourseIdAndLessonIdOfSCP($quiz_id, $user_id,  $course_id,  $lesson_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' And  `quiz_id` ='".$quiz_id."' And  `course_id` ='".$course_id."' And  `lesson_id` ='".$lesson_id."' AND source = 'SCP' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);

		
			
			if(!empty($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id,  $course_id,  $lesson_id) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' And  `quiz_id` ='".$quiz_id."' And  `course_id` ='".$course_id."' And  `lesson_id` ='".$lesson_id."' order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(!empty($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	
	public static function loadByUserCourseLessonSource($user_id, $course_id , $lesson_id, $source) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `course_id` = '".$course_id."'  AND `lesson_id` = '".$lesson_id."' AND `source` = '".$source."' order by date desc LIMIT 1" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
		
			$sqbDataObj = false;
			if(isset($rows)){
				$row = $rows[0];
				$sqbDataObj = new SQB_ManageLeads();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setUserId($row['user_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setClicked($row['clicked']);
				$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
				$sqbDataObj->setCompleted($row['completed']); 
				$sqbDataObj->setOptedIn($row['opted_in']); 
				$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
				$sqbDataObj->setShownOutcome($row['shown_outcome']); 
				$sqbDataObj->setOutcome($row['outcome']); 
				$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
				$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
				$sqbDataObj->setSource($row['source']);  
				$sqbDataObj->setCourseId($row['course_id']); 				 
				$sqbDataObj->setLessonId($row['lesson_id']);  
				$sqbDataObj->setTimeSpent($row['time_spent']);  				
				$sqbDataObj->setDate($row['date']);	
				$sqbDataObj->setUsername($row['user_name']);	
				$sqbDataObj->setUserSource($row['user_source']);
				//$sqbDataobj->setCategoryDetails($row['category_details']);	
				
			}
			return $sqbDataObj;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByUserIdAndCourseId($user_id = 0, $course_id = 0) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `course_id` = '".$course_id."'  order by date desc LIMIT 1" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
		
			$sqbDataObj = false;
			if(!empty($rows)){
				$row = $rows[0];
				$sqbDataObj = new SQB_ManageLeads();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setUserId($row['user_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setClicked($row['clicked']);
				$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
				$sqbDataObj->setCompleted($row['completed']); 
				$sqbDataObj->setOptedIn($row['opted_in']); 
				$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
				$sqbDataObj->setShownOutcome($row['shown_outcome']); 
				$sqbDataObj->setOutcome($row['outcome']); 
				$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
				$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
				$sqbDataObj->setSource($row['source']);  
				$sqbDataObj->setCourseId($row['course_id']); 				 
				$sqbDataObj->setLessonId($row['lesson_id']);  
				$sqbDataObj->setTimeSpent($row['time_spent']);  				
				$sqbDataObj->setDate($row['date']);		
				$sqbDataObj->setUsername($row['user_name']);
				$sqbDataObj->setUserSource($row['user_source']);
				//$sqbDataobj->setCategoryDetails($row['category_details']);	
				
			}
			return $sqbDataObj;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByUserIdAndCourseIdAndBySource($user_id = 0, $course_id = 0,$source = '') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `course_id` = '".$course_id."' and `source`='".$source."'  order by date desc LIMIT 1" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
		
			$sqbDataObj = false;
			if(isset($rows)){
				$row = $rows[0];
				$sqbDataObj = new SQB_ManageLeads();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setUserId($row['user_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setClicked($row['clicked']);
				$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
				$sqbDataObj->setCompleted($row['completed']); 
				$sqbDataObj->setOptedIn($row['opted_in']); 
				$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
				$sqbDataObj->setShownOutcome($row['shown_outcome']); 
				$sqbDataObj->setOutcome($row['outcome']); 
				$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
				$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
				$sqbDataObj->setSource($row['source']);  
				$sqbDataObj->setCourseId($row['course_id']); 				 
				$sqbDataObj->setLessonId($row['lesson_id']); 
				$sqbDataObj->setTimeSpent($row['time_spent']);  					
				$sqbDataObj->setDate($row['date']);	
				$sqbDataObj->setUsername($row['user_name']);
				$sqbDataObj->setUserSource($row['user_source']);
				//$sqbDataobj->setCategoryDetails($row['category_details']);	
				$sqbData[]	= $sqbDataObj;
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function loadByUserIdAndCourseIdAndBySourceWithoutLimit($user_id = 0, $course_id = 0,$source='') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			$sql = "SELECT * FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `course_id` = '".$course_id."' and `source`='".$source."'  order by date desc" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
		
			$sqbDataObj = false;
			if(isset($rows)){
				foreach($rows as $row){
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[]	= $sqbDataObj;
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function getRetakeCount($user_id = 0 , $quiz_id = 0, $date = 0){
		$sqbData = null;
		if($quiz_id == 0){
			return 	$sqbData;
		}
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql = "SELECT total_attempts as retake_count FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `quiz_id` ='".$quiz_id."' AND `date`='".$date."' ORDER BY `id` DESC LIMIT 0,1";
			$row = $wpdb->get_row($sql, ARRAY_A);
			if(isset($row)){
					$sqbData = $row['retake_count'];
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	public static function getTimeSpentData($user_id = 0 , $quiz_id = 0, $date = 0){
		$sqbData = null;
		if($quiz_id == 0){
			return 	$sqbData;
		}
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql = "SELECT time_spent as time_spent FROM " . $tableName . " WHERE `user_id` ='".$user_id."' AND `quiz_id` ='".$quiz_id."' AND `date`='".$date."' ORDER BY `id` DESC LIMIT 0,1";
			$row = $wpdb->get_row($sql, ARRAY_A);
			if(isset($row)){
					$sqbData = $row['time_spent'];
			}  
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByQuizIdOutcomeIdStartDateEndDateAcceptUserids($quiz_id = 0, $outcome_id = 0,$start_date = '',  $end_date = '',$user_ids = array()) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql_where  = '';
			$where_status = false;
			
			if($quiz_id != 0){
				$sql_where .= "  `quiz_id` ='".$quiz_id."'";
				$where_status = true;
			}
			
			if($outcome_id != 0){
				if($where_status){
					$sql_where .= " AND `outcome` ='".$outcome_id."'";
				}else{
					$sql_where .= " `outcome` ='".$outcome_id."'";
				}
			}
			
			if($start_date != ''){
				if($where_status){
					$sql_where .= " AND `date` >= '".$start_date."'";
				}else{
					$sql_where .= "  `date` >= '".$start_date."'";
				}
				$where_status = true;
			}
			
			/*if($end_date != ''){
				if($where_status){
					$sql_where .= " AND `date` <= '".$end_date."'";
				}else{
					$sql_where .= "  `date` <= '".$end_date."'";
				}
				$where_status = true;
			}*/
			
			
			if(count($user_ids) > 0){
			$user_ids = implode(',',$user_ids);
			$sql_where .= " And user_id NOT IN ($user_ids)";
			$where_status = true;
			} else {
			$sql_where .= "";
			$where_status = true;
			}
			
			if($sql_where != ''){
				$sql_where = " WHERE ".$sql_where;
			}
			  
			$sql = "SELECT * FROM " . $tableName .$sql_where. " order by id desc";   
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setId($row['id']);
					$sqbDataObj->setUserId($row['user_id']);
					$sqbDataObj->setQuizId($row['quiz_id']);
					$sqbDataObj->setClicked($row['clicked']);
					$sqbDataObj->setHowManyAnswered($row['how_many_answered']);  
					$sqbDataObj->setCompleted($row['completed']); 
					$sqbDataObj->setOptedIn($row['opted_in']); 
					$sqbDataObj->setGDPROptedIn($row['gdpr_opted_in']);
					$sqbDataObj->setShownOutcome($row['shown_outcome']); 
					$sqbDataObj->setOutcome($row['outcome']); 
					$sqbDataObj->setClickedOnCta($row['clicked_on_cta']); 			 
					$sqbDataObj->setTotalAttempts($row['total_attempts']); 	
					$sqbDataObj->setSource($row['source']);  
					$sqbDataObj->setCourseId($row['course_id']); 				 
					$sqbDataObj->setLessonId($row['lesson_id']); 
					$sqbDataObj->setTimeSpent($row['time_spent']);  					
					$sqbDataObj->setDate($row['date']);	
					$sqbDataObj->setUsername($row['user_name']);	
					$sqbDataObj->setUserSource($row['user_source']);
					//$sqbDataobj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;
									
				}
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdStartDateEndDateAcceptUserids($quiz_id = 0, $start_date = '',  $end_date = '',$user_ids = array()) {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql_where  = '';
			$where_status = false;
			
			if($quiz_id != 0){
				$sql_where .= "  `quiz_id` ='".$quiz_id."'";
				$where_status = true;
			}
			
			if($start_date != ''){
				if($where_status){
					$sql_where .= " AND `date` >= '".$start_date."'";
				}else{
					$sql_where .= "  `date` >= '".$start_date."'";
				}
				$where_status = true;
			}
			
			
			if(count($user_ids) > 0){
			$user_ids = implode(',',$user_ids);
			$sql_where .= " And user_id NOT IN ($user_ids)";
			$where_status = true;
			} else {
			$sql_where .= "";
			$where_status = true;
			}
			
			if($sql_where != ''){
				$sql_where = " WHERE ".$sql_where;
			}
			  
			$sql = "SELECT DISTINCT user_id FROM " . $tableName .$sql_where. " order by id desc";   
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setUserId($row['user_id']);	
					$sqbData[] = $sqbDataObj;				
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByLeaderboard($quiz_id, $options, $start_date = '',  $end_date = '') {
	
		global $wpdb, $sqb_manage_leads;
		$sqb_user_details = $wpdb->prefix .'sqb_users_quiz_details';
		$tableName = $wpdb->prefix . $sqb_manage_leads;
		

		$retake = !empty($options['retake_quiz']) ? $options['retake_quiz'] : 'N';
		$orderby = !empty($options['order_by']) ? $options['order_by'] : 'highest_score';
		$userData = !empty($options['exclude_users']) ? $options['exclude_users'] : '';
		$showType = !empty($options['show_type']) ? $options['show_type'] : '';

		if($showType == 'all'){
			$start_date = '0000-00-00 00:00:00';
			$end_date = '0000-00-00 00:00:00';
		}

		if($orderby == 'highest_score'){
			$orderbySQL = 'ORDER BY points DESC,date ASC';
		}else if($orderby == 'highest_score_least_time'){
			$orderbySQL = 'ORDER BY points DESC,time_spent ASC';
		}else if($orderby == 'first_submission'){
			$orderbySQL = 'ORDER BY date ASC';
		}else if($orderby == 'last_submission'){
			$orderbySQL = 'ORDER BY date DESC';
		}

		$limit = !empty($options['limit']) ? $options['limit'] : '10';

		$sql_where  = '';
		$where_status = false;
		
		
		$sql_where .= "AND m.quiz_id IN(".$quiz_id.")";
		$where_status = true;
		
		
		if($start_date != '' && ($start_date != '0000-00-00 00:00:00')){
			if($where_status){
				$sql_where .= " AND m.date >= '".$start_date."'";
			}else{
				$sql_where .= "  m.date >= '".$start_date."'";
			}
			$where_status = true;
		}

		if($end_date != '' && ($end_date != '0000-00-00 00:00:00')){
			if($where_status){
				$sql_where .= " AND m.date <= '".$end_date."'";
			}else{
				$sql_where .= "  m.date <= '".$end_date."'";
			}
			$where_status = true;
		}

		if(!empty($userData)){
			
			if(!empty($userData['WP'])){
				$user_ids = implode(',',$userData['WP']);
				$sql_where_[] = "(m.user_id NOT IN ($user_ids) AND m.user_source = 'WP')";
			}else{
				$sql_where_[] = "(m.source = 'WP' OR m.user_source = 'WP')";
			}

			if(!empty($userData['SQB'])){
				$user_ids = implode(',',$userData['SQB']);
				$sql_where_[] = "(m.user_id NOT IN ($user_ids) AND m.user_source = 'SQB')";
			}else{
				$sql_where_[] = "(m.user_source = 'SQB')";
			}

			if(!empty($userData['DAP'])){
				$user_ids = implode(',',$userData['DAP']);
				$sql_where_[] = "(m.user_id NOT IN ($user_ids) AND m.source = 'DAP')";
			}else{
				$sql_where_[] = "(m.source = 'DAP')";
			}

			if(!empty($sql_where_)){
				$sql_where .= ' AND ('.implode(' OR ',$sql_where_).')';
			}
			
			$where_status = true;
		} else {
			$sql_where .= "";
			$where_status = true;
		}
		
		if($sql_where != ''){
			$sql_where = " WHERE 1 = 1 ".$sql_where;
		}

		if($retake == 'Y'){
			$sql = "SELECT GROUP_CONCAT(DISTINCT  m.date) as mdate FROM " . $tableName ." AS m,".$sqb_user_details." AS u".$sql_where. " GROUP BY m.user_id, m.quiz_id";
			
			$rows = $wpdb->get_results($sql);
			$dates = array();
			//foreach ($rows as $key => $row) {
				foreach ($rows as $key => $v) {
					$t = explode(',',$v->mdate);
					$dates = array_merge($dates,$t);
				}
			//}

			
			$dates = array_unique($dates);
			$dates = "'".implode("','",$dates)."'";
			
			/*$sql = "SELECT m.*,max(SUM((SELECT points_scored FROM zsm_sqb_users_quiz_details AS u WHERE u.date = m.date ORDER By  LIMIT 1))) as points, SUM((SELECT total_points FROM zsm_sqb_users_quiz_details AS u WHERE u.date = m.date LIMIT 1)) as total_points FROM " . $tableName ." AS m ".$sql_where. " GROUP BY m.user_id $orderbySQL LIMIT 0,$limit";*/

			if($orderby == 'highest_score_least_time'){
				$sql = "SELECT * FROM $tableName AS m,$sqb_user_details AS t WHERE points_scored = (SELECT MAX(points_scored) FROM $sqb_user_details as t1 WHERE t.date IN(".$dates.") AND t.quiz_id = t1.quiz_id AND t.user_id = t1.user_id ORDER BY points_scored DESC) AND time_spent  = (SELECT MIN(time_spent) FROM $tableName as t1 WHERE t.date IN(".$dates.") AND t.quiz_id = t1.quiz_id AND t.user_id = t1.user_id ORDER BY time_spent  ASC) AND t.date = m.date GROUP BY t.user_id, t.quiz_id";
			}else{
				//$sql = "SELECT * FROM $sqb_user_details AS t WHERE points_scored = (SELECT MAX(points_scored) FROM $sqb_user_details as t1 WHERE t.date IN(".$dates.") AND t.quiz_id = t1.quiz_id AND t.user_id = t1.user_id ORDER BY points_scored DESC) GROUP BY user_id, quiz_id";

				$sql = "SELECT t.*
				FROM ".$sqb_user_details." AS t
				JOIN (
					SELECT quiz_id, user_id, MAX(points_scored) AS max_score
					FROM ".$sqb_user_details."
					WHERE date IN (
						".$dates."
					)
					GROUP BY quiz_id, user_id
				) AS t1 ON t.quiz_id = t1.quiz_id AND t.user_id = t1.user_id AND t.points_scored = t1.max_score
				 GROUP BY user_id, quiz_id ORDER BY t.points_scored DESC";
			}
			$rows = $wpdb->get_results($sql);

			$ids = array();
			foreach ($rows as $key => $value) {
				$ids[] = $value->id;
			}

			$sql = "SELECT * FROM $sqb_user_details WHERE id IN(".implode(',',$ids).")";
			$rows = $wpdb->get_results($sql);

			$dates = array();
			foreach ($rows as $key => $value) {
				$dates[] = "'".$value->date."'";
			}

			if($orderby == 'highest_score_least_time'){
				$orderbySQL = 'ORDER BY points DESC,total_time_spent ASC';
			}

			$sql1 = "SELECT m.*,SUM((SELECT points_scored FROM $sqb_user_details AS u WHERE u.date = m.date LIMIT 1)) AS points, SUM((SELECT total_points FROM $sqb_user_details AS u WHERE u.date = m.date LIMIT 1)) AS total_points, SUM(time_spent) AS total_time_spent FROM " . $tableName ." AS m  WHERE date IN(".implode(',',$dates).") GROUP BY m.user_id $orderbySQL LIMIT 0,$limit";

			$rows = $wpdb->get_results($sql1);

		}else{

			if($orderby == 'last_submission'){
				$sql = "SELECT MAX(date) AS date FROM " . $tableName ." AS m ".$sql_where. " GROUP BY m.user_id,m.quiz_id $orderbySQL";
				$orderbySQL = 'ORDER BY max(date) DESC';
			}else if($orderby == 'first_submission'){
				$sql = "SELECT MIN(date) AS date FROM " . $tableName ." AS m ".$sql_where. " GROUP BY m.user_id,m.quiz_id $orderbySQL";
				$orderbySQL = 'ORDER BY MIN(date) ASC';
			}else{
				$sql = "SELECT date FROM " . $tableName ." AS m ".$sql_where. " GROUP BY m.user_id,m.quiz_id ORDER BY date ASC";
			}

			//echo $sql;exit;

			$rows = $wpdb->get_results($sql);

			if(empty($rows))
				return array();

			$dates = array();
			foreach ($rows as $key => $value) {
				$dates[] = "'".$value->date."'";
			}


			$sql1 = "SELECT m.*,SUM((SELECT points_scored FROM $sqb_user_details AS u WHERE u.date = m.date LIMIT 1)) AS points, SUM((SELECT total_points FROM $sqb_user_details AS u WHERE u.date = m.date LIMIT 1)) AS total_points FROM " . $tableName ." AS m  WHERE date IN(".implode(',',$dates).") GROUP BY m.user_id $orderbySQL  LIMIT 0,$limit";

			$rows = $wpdb->get_results($sql1);
		}

		return $rows;
	}

	public static function loadByQuizIdStartDateEndDate($quiz_id = 0, $start_date = '',  $end_date = '') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_manage_leads;
			$tableName = $wpdb->prefix . $sqb_manage_leads;
			
			$sql_where  = '';
			$where_status = false;
			
			if($quiz_id != 0){
				$sql_where .= "  `quiz_id` ='".$quiz_id."'";
				$where_status = true;
			}
			
			if($start_date != ''){
				if($where_status){
					$sql_where .= " AND `date` >= '".$start_date."'";
				}else{
					$sql_where .= "  `date` >= '".$start_date."'";
				}
				$where_status = true;
			}
			
			if($sql_where != ''){
				$sql_where = " WHERE ".$sql_where;
			}
			  
			$sql = "SELECT DISTINCT user_id, category_details FROM " . $tableName .$sql_where. " order by id desc";   
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 				
					//$row = $rows[0];
					$sqbDataObj = new SQB_ManageLeads();
					$sqbDataObj->setUserId($row['user_id']);	
					$sqbDataObj->setCategoryDetails($row['category_details']);	
					$sqbData[] = $sqbDataObj;				
				}
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	
}
