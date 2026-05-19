<?php 

class SQB_Reports {
	public $id;
	public $page_id;
	public $quiz_id;
	public $visits;
	public $clicks;
	public $completed;
	public $opted_in;
	public $reached_outcome;
	public $clicked_on_outcome_CTA;
	public $external_url;
	public $ip_address;
	public $date;

	function getId() {
		return $this->id;
	}
	
	function setId($o) {
		$this->id = $o;
	}
	
	function getPageId() {
		return $this->page_id;
	}
	
	function setPageId($o) {
		$this->page_id = $o;
	}
	
	function getQuizId() {
		return $this->quiz_id;
	}
	
	function setQuizId($o) {
		$this->quiz_id = $o;
	}
	
	function getVisits() {
		return $this->visits;
	}
	
	function setVisits($o) {
		$this->visits = $o;
	}
	
	function setClicks($o) {
		$this->clicks = $o;
	}
	
	function getClicks() {
		return $this->clicks;
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
	
	
	function getReachedOutcome() {
		return $this->reached_outcome;
	}
	
	function setReachedOutcome($o) {
		$this->reached_outcome = $o;
	}
	
	
	function getClickedOnOutcomeCTA() {
		return $this->clicked_on_outcome_CTA;
	}
	
	function setClickedOnOutcomeCTA($o) {
		$this->clicked_on_outcome_CTA = $o;
	}

	function setExternalURL($o) {
		$this->external_url = $o;
	}

	function getExternalURL() {
		return $this->external_url;
	}
	
	function getIpAddress() {
		return $this->ip_address;
	}
	
	function setIpAddress($o) {
		$this->ip_address = $o;
	}
	
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
	
	 public function create(){
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$data = array(
				'page_id'=> $this->getPageId(),
				'quiz_id'=> $this->getQuizId(),
				'visits'=> $this->getVisits(),
				'clicks'=> $this->getClicks(), 
				'completed'=> $this->getCompleted(),
				'opted_in'=> $this->getOptedIn(),
				'reached_outcome'=> $this->getReachedOutcome(),
				'clicked_on_outcome_CTA'=> $this->getClickedOnOutcomeCTA(),			 		 
				'ip_address'=> $this->getIpAddress(),			 		 
				'date'=> $this->getDate(),			 
				'external_url'=> $this->getExternalURL(),			 
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
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$data = array(
				'page_id'=> $this->getPageId(),
				'quiz_id'=> $this->getQuizId(),
				'visits'=> $this->getVisits(),
				'clicks'=> $this->getClicks(),
				'completed'=> $this->getCompleted(),
				'opted_in'=> $this->getOptedIn(),
				'reached_outcome'=> $this->getReachedOutcome(),
				'clicked_on_outcome_CTA'=> $this->getClickedOnOutcomeCTA(),			 		 
				'ip_address'=> $this->getIpAddress(),			 		 
				'date'=> $this->getDate(),	
				'external_url'=> $this->getExternalURL()		 
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
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			
			if(isset($row)){
				$sqbData = new SQB_Reports();
				$sqbData->setId($row['id']);
				$sqbData->setPageId($row['page_id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setVisits($row['visits']);  
				$sqbData->setClicks($row['clicks']);  
				
				$sqbData->setCompleted($row['completed']); 
			
				$sqbData->setOptedIn($row['opted_in']); 
				$sqbData->setReachedOutcome($row['reached_outcome']); 
				
				$sqbData->setClickedOnOutcomeCTA($row['clicked_on_outcome_CTA']); 
				$sqbData->setIpAddress($row['ip_address']); 			 
				$sqbData->setDate($row['date']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function load() {
		$sqbData = null;
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$sql = "SELECT * FROM " . $tableName;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 		
				$sqbDataObj = new SQB_Reports();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setPageId($row['page_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setVisits($row['visits']);  
				$sqbDataObj->setClicks($row['clicks']);  
				$sqbDataObj->setCompleted($row['completed']); 
				$sqbDataObj->setOptedIn($row['opted_in']); 
				$sqbDataObj->setReachedOutcome($row['reached_outcome']); 
				$sqbDataObj->setClickedOnOutcomeCTA($row['clicked_on_outcome_CTA']); 
				$sqbDataObj->setIpAddress($row['ip_address']); 			 
				$sqbDataObj->setDate($row['date']);
				$sqbData[] = $sqbDataObj;
			}						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function getOneData() {
		$sqbData = null;
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$sql = "SELECT * FROM " . $tableName ." ORDER BY date ASC LIMIT 1";
			$row = $wpdb->get_row($sql, ARRAY_A);
			if(isset($row)){
				$sqbDataObj = new SQB_Reports();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setPageId($row['page_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setVisits($row['visits']);  
				$sqbDataObj->setClicks($row['clicks']);  
				$sqbDataObj->setCompleted($row['completed']); 
				$sqbDataObj->setOptedIn($row['opted_in']); 
				$sqbDataObj->setReachedOutcome($row['reached_outcome']); 
				$sqbDataObj->setClickedOnOutcomeCTA($row['clicked_on_outcome_CTA']); 
				$sqbDataObj->setIpAddress($row['ip_address']); 			 
				$sqbDataObj->setDate($row['date']);
				$sqbData[] = $sqbDataObj;
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function loadByDateAndQuizId($start_date = '',$quiz_id = 0,$end_date = '') {
		$sqbData = null;
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$where_set = false;
			$custom_filter = '';
			if($start_date != ""){
				$where_set = true;
				$custom_filter .= " where date >= '".$start_date."'";
			}  
			
			$quiz_id_sql = '';
			if(!empty($quiz_id)){
				if($where_set){
					$custom_filter .= ' and  `quiz_id` = '.$quiz_id;
				}else{
					$where_set = true;
					$custom_filter .= ' where  `quiz_id` = '.$quiz_id;
				}
			}	  
			
			if($end_date != ""){
				if($where_set){
					$custom_filter .= " and date <= '".$end_date."'";
				}else{
					$where_set = true;
					$custom_filter .= " where date <= '".$end_date."'";
				}
				
				
				
			}  
			
			
			
			//$sql = "SELECT * FROM " . $tableName ." where `date` >= '".$start_date."' ".$quiz_id_sql;
			//$sql = "SELECT YEAR(t1.date) as ty, MONTH(t1.date) as tm, DAY(t1.date) as td, t1.* FROM " . $tableName ." as t1 ".$custom_filter; 

			
			$sql = "SELECT SUM(visits) as visits_total,SUM(clicks) as clicks_total, SUM(completed) as completed_total, COUNT(DISTINCT ip_address) as ip_address_total, SUM(IF(opted_in = 'Y',1,0)) as opted_in_total, SUM(IF(reached_outcome = 'Y',1,0)) as reached_outcome_total, SUM(IF(clicked_on_outcome_CTA = 'Y',1,0)) as clicked_on_outcome_CTA_total , YEAR(t1.date) as ty, MONTH(t1.date) as tm, DAY(t1.date) as td, t1.* FROM " . $tableName ." as t1  ".$custom_filter ." GROUP BY page_id, external_url";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			
			if(isset($rows)){
				foreach($rows as $row){ 		
				$sqbDataObj = new SQB_Reports();
				$sqbDataObj->setId($row['id']);
				$sqbDataObj->setPageId($row['page_id']);
				$sqbDataObj->setQuizId($row['quiz_id']);
				$sqbDataObj->setVisits($row['visits_total']);  
				$sqbDataObj->setClicks($row['clicks_total']);  
				$sqbDataObj->setCompleted($row['completed_total']); 
				$sqbDataObj->setOptedIn($row['opted_in_total']); 
				$sqbDataObj->setReachedOutcome($row['reached_outcome_total']); 
				$sqbDataObj->setClickedOnOutcomeCTA($row['clicked_on_outcome_CTA_total']); 
				$sqbDataObj->setIpAddress($row['ip_address_total']); 			 
				$sqbDataObj->setDate($row['date']);
				//$sqbDataObj->setMonth($row['tm']);
				//$sqbDataObj->setDay($row['td']);
				//$sqbDataObj->setYear($row['ty']);
				$sqbData[] = $row;
			}						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	public static function delete(){
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;	
			
			$wpdb->query('TRUNCATE TABLE '.$tableName);
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function deleteByQuizId($quiz_id = 0){
		try {
			global $wpdb, $sqb_reports;
			$tableName = $wpdb->prefix . $sqb_reports;
			$wpdb->delete($tableName, array( 'quiz_id' => $quiz_id ) );
			return $quiz_id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
}	
