<?php 

class SQB_Social_Share {
	
	public $id;
	public $quiz_id;
	public $title;
	public $fb_description;
	public $tw_description;
	public $html;
	public $share_link;
	public $show_social_share;
	public $image;
	public $date;

	function getId() {
		return $this->id;
	}
	function setId($o) {
		$this->id = $o;
	}
	
	
	function getQuizId() {
		return $this->quiz_id;
	}
	
	function setQuizId($o) {
		$this->quiz_id = $o;
	}
	
	
	function getTitle() {
		return $this->title;
	}
	
	function setTitle($o) {
		$this->title = $o;
	}
	
	function getFbDescription() {
		return $this->fb_description;
	}
	
	function setFbDescription($o) {
		$this->fb_description = $o;
	}
	
	function getTwDescription() {
		return $this->tw_description;
	}
	
	function setTwDescription($o) {
		$this->tw_description = $o;
	}
	
	
	function getHtml() {
		return $this->html;
	}
	
	function setHtml($o) {
		$this->html = $o;
	}
	
	function getShareLink() {
		return $this->share_link;
	}
	
	function setShareLink($o) {
		$this->share_link = $o;
	}
	
	
	function getShowSocialShare() {
		return $this->show_social_share;
	}
	
	function setShowSocialShare($o) {
		$this->show_social_share = $o;
	}

	function getImage() {
		return $this->image;
	}
	
	function setImage($o) {
		$this->image = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	
	function setDate($o) {
		$this->date = $o;
	}
	
	
	
	public function create(){
		
		try {
			global $wpdb, $sqb_social_share;
			$tableName = $wpdb->prefix . $sqb_social_share;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'title'=> $this->getTitle(),
				'fb_description'=> $this->getFbDescription(),
				'tw_description'=> $this->getTwDescription(),
				'html'=> $this->getHtml(),
				'show_social_share'=> $this->getShowSocialShare(),
				'share_link'=> $this->getShareLink(),
				'image'=> $this->getImage(),
				'date'=> $this->getDate(),
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
			global $wpdb, $sqb_social_share;
			$tableName = $wpdb->prefix . $sqb_social_share;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'title'=> $this->getTitle(),
				'fb_description'=> $this->getFbDescription(),
				'tw_description'=> $this->getTwDescription(),
				'html'=> $this->getHtml(),
				'show_social_share'=> $this->getShowSocialShare(),
				'share_link'=> $this->getShareLink(),
				'image'=> $this->getImage(),
				'date'=> $this->getDate(),
				
		);
		$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
		$id = $this->getId();
		return $lastid = $id;
		return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}		
	
	
	public static function loadByQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_social_share;
			$tableName = $wpdb->prefix . $sqb_social_share;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				 				 
				$sqbData = new SQB_Social_Share();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setTitle($row['title']);
				$sqbData->setFbDescription($row['fb_description']);
				$sqbData->setTwDescription($row['tw_description']);
				$sqbData->setHtml($row['html']);
				$sqbData->setShowSocialShare($row['show_social_share']);
				$sqbData->setShareLink($row['share_link']);
				$sqbData->setImage($row['image']);
				$sqbData->setDate($row['date']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	
	public static function loadActiveAndQuizId($quiz_id) {
		 
		try {
			global $wpdb, $sqb_social_share;
			$tableName = $wpdb->prefix . $sqb_social_share;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' and `show_social_share` = 1 ";
			$row = $wpdb->get_row($sql, ARRAY_A);
			$sqbData = null;
			if(isset($row)){
				 				 
				$sqbData = new SQB_Social_Share();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setTitle($row['title']);
				$sqbData->setFbDescription($row['fb_description']);
				$sqbData->setTwDescription($row['tw_description']);
				$sqbData->setHtml($row['html']);
				$sqbData->setShowSocialShare($row['show_social_share']);
				$sqbData->setShareLink($row['share_link']);
				$sqbData->setImage($row['image']);
				$sqbData->setDate($row['date']);
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	} 
	
	
}	
