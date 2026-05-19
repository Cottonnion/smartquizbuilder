<?php 

class SQB_QuizVideoCaption {

	public $id;
	public $video_url;
	public $video_caption;

	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}

	function getVideoURL() {
		return $this->video_url;
	}
	function setVideoURL($o) {
		$this->video_url = $o;
	}

	function getVideoCaption() {
		return $this->video_caption;
	}
	function setVideoCaption($o) {
		$this->video_caption = $o;
	}
	 	 	
	public function create(){
		try {
			global $wpdb, $sqb_quiz_video_captions;
			$tableName = $wpdb->prefix . $sqb_quiz_video_captions;
			$data = array(
				'video_url'=> $this->getVideoURL(),
				'video_caption'=> $this->getVideoCaption(),
			);
			$wpdb->insert($tableName, $data);
			//echo $wpdb->last_query;
			$id = $wpdb->insert_id; 
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function update(){
		try {
			global $wpdb, $sqb_quiz_video_captions;
			$tableName = $wpdb->prefix . $sqb_quiz_video_captions;
			$data = array(
				'id'=> $this->getId(),
				'video_url'=> $this->getVideoURL(),
				'video_caption'=> $this->getVideoCaption(),			  		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByURL($video_url) {
	 	$sqbData = null;
		try {
			global $wpdb, $sqb_quiz_video_captions;
			$tableName = $wpdb->prefix . $sqb_quiz_video_captions;
			$sql = "SELECT * FROM " . $tableName . " WHERE `video_url` ='".$video_url."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){				 				
				$sqbData = new SQB_QuizVideoCaption();
				$sqbData->setId($row['id']);
				$sqbData->setVideoURL($row['video_url']);
				$sqbData->setVideoCaption($row['video_caption']);				
			} 
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}	 
}	
