<?php 

class SQB_LeaderboardPage{
	
	public $id;
	public $quiz_type;
	public $quiz_ids;
	public $name;
	public $max_records;
	public $retake_overwrites;
	public $show_type;
	public $start_date;
	public $end_date;
	public $no_data_text;
	public $template;
	public $leaderboard_order;
	public $customizer_html;
	public $customizer_values;
	public $date;
	
	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	function getQuizType() {
		return $this->quiz_type;
	}
	function setQuizType($o) {
		$this->quiz_type = $o;
	}

	function getQuizIds() {
		return $this->quiz_ids;
	}
	function setQuizIds($o) {
		$this->quiz_ids = $o;
	}
	
	function getName() {
		return $this->name;
	}
	function setName($o) {
		$this->name = $o;
	}

	function getMaxRecords() {
		return $this->max_records;
	}
	function setMaxRecords($o) {
		$this->max_records = $o;
	}

	function getRetakeOverwrites() {
		return $this->retake_overwrites;
	}
	function setRetakeOverwrites($o) {
		$this->retake_overwrites = $o;
	}

	function getShowType() {
		return $this->show_type;
	}
	function setShowType($o) {
		$this->show_type = $o;
	}

	function getStartDate() {
		return $this->start_date;
	}
	function setStartDate($o) {
		$this->start_date = $o;
	}

	function getEndDate() {
		return $this->end_date;
	}
	function setEndDate($o) {
		$this->end_date = $o;
	}

	function getNoDataText() {
		return $this->no_data_text;
	}
	function setNoDataText($o) {
		$this->no_data_text = $o;
	}

	function getTemplate() {
		return $this->template;
	}
	function setTemplate($o) {
		$this->template = $o;
	}

	function getLeaderboardOrder() {
		return $this->leaderboard_order;
	}
	function setLeaderboardOrder($o) {
		$this->leaderboard_order = $o;
	}

	function getCustomizerHtml() {
		return $this->customizer_html;
	}
	function setCustomizerHtml($o) {
		$this->customizer_html = $o;
	}

	function getCustomizerValues() {
		return $this->customizer_values;
	}
	function setCustomizerValues($o) {
		$this->customizer_values = $o;
	}

	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
   
   public function create(){
		try {
			global $wpdb, $sqb_leaderboard;
			$tableName = $wpdb->prefix . $sqb_leaderboard;
			$data = array(
				'quiz_type'=> $this->getQuizType(),
				'quiz_ids'=> $this->getQuizIds(),
				'name'=> $this->getName(),
				'max_records'=> $this->getMaxRecords(),
				'retake_overwrites'=> $this->getRetakeOverwrites(),
				'show_type'=> $this->getShowType(),
				'start_date'=> $this->getStartDate(),
				'end_date'=> $this->getEndDate(),
				'no_data_text'=> $this->getNoDataText(),
				'template'=> $this->getTemplate(),
				'leaderboard_order'=> $this->getLeaderboardOrder(),
				'customizer_html'=> $this->getCustomizerHtml(),
				'customizer_values'=> $this->getCustomizerValues(),
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
			global $wpdb, $sqb_leaderboard;
			$tableName = $wpdb->prefix . $sqb_leaderboard;
			$data = array(
				'quiz_type'=> $this->getQuizType(),
				'quiz_ids'=> $this->getQuizIds(),
				'name'=> $this->getName(),
				'max_records'=> $this->getMaxRecords(),
				'retake_overwrites'=> $this->getRetakeOverwrites(),
				'show_type'=> $this->getShowType(),
				'start_date'=> $this->getStartDate(),
				'end_date'=> $this->getEndDate(),
				'no_data_text'=> $this->getNoDataText(),
				'template'=> $this->getTemplate(),
				'leaderboard_order'=> $this->getLeaderboardOrder(),
				'customizer_html'=> $this->getCustomizerHtml(),
				'customizer_values'=> $this->getCustomizerValues(),
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
			
			global $wpdb, $sqb_leaderboard;
			$tableName = $wpdb->prefix . $sqb_leaderboard;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				$sqbData = new SQB_LeaderboardPage();
				$sqbData->setId($row['id']);
				$sqbData->setQuizType($row['quiz_type']);
				$sqbData->setQuizIds($row['quiz_ids']);
				$sqbData->setName($row['name']);
				$sqbData->setMaxRecords($row['max_records']);
				$sqbData->setRetakeOverwrites($row['retake_overwrites']);
				$sqbData->setShowType($row['show_type']);
				$sqbData->setStartDate($row['start_date']);
				$sqbData->setEndDate($row['end_date']);
				$sqbData->setNoDataText($row['no_data_text']);
				$sqbData->setTemplate($row['template']);
				$sqbData->setLeaderboardOrder($row['leaderboard_order']);
				$sqbData->setCustomizerHtml($row['customizer_html']);
				$sqbData->setCustomizerValues($row['customizer_values']);
				$sqbData->setDate($row['date']);
					 	
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
	public static function load() {
		try {
			global $wpdb, $sqb_leaderboard;
			$tableName = $wpdb->prefix . $sqb_leaderboard;
			$sql = "SELECT * FROM " . $tableName." ORDER BY id desc";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){				
						$sqbData = new SQB_LeaderboardPage();
						$sqbData->setId($row['id']);
						$sqbData->setQuizType($row['quiz_type']);
						$sqbData->setQuizIds($row['quiz_ids']);
						$sqbData->setName($row['name']);
						$sqbData->setMaxRecords($row['max_records']);
						$sqbData->setRetakeOverwrites($row['retake_overwrites']);
						$sqbData->setShowType($row['show_type']);
						$sqbData->setStartDate($row['start_date']);
						$sqbData->setEndDate($row['end_date']);
						$sqbData->setNoDataText($row['no_data_text']);
						$sqbData->setTemplate($row['template']);
						$sqbData->setLeaderboardOrder($row['leaderboard_order']);
						$sqbData->setCustomizerHtml($row['customizer_html']);
						$sqbData->setCustomizerValues($row['customizer_values']);
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
			global $wpdb, $sqb_leaderboard;
			$tableName = $wpdb->prefix . $sqb_leaderboard;
			$wpdb->delete($tableName, array( 'id' => $id ) );
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
} 
	
	
	

