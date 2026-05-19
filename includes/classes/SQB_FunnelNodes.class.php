<?php 

class SQB_FunnelNodes {
	
	public $node_id;
	public $funnel_id;
	public $level;
	public $ques_id;
	public $parent_node_id;
	public $parent_ans;
	public $date;
	
	function getNodeId() {
		return $this->node_id;
	}
	function setNodeId($o) {
		$this->node_id	 = $o;
	}
	
	function getFunnelId() {
		return $this->funnel_id;
	}
	function setFunnelId($o) {
		$this->funnel_id = $o;
	}
	
	function getLevel() {
		return $this->level;
	}
	function setLevel($o) {
		$this->level = $o;
	}
	
	function getQuesId() {
		return $this->ques_id;
	}
	function setQuesId($o) {
		$this->ques_id = $o;
	}
	
	function getParentNodeId() {
		return $this->parent_node_id;
	}
	function setParentNodeId($o) {
		$this->parent_node_id = $o;
	}
	
	function getParentAns() {
		return $this->parent_ans;
	}
	function setParentAns($o) {
		$this->parent_ans = $o;
	}
	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	
	public function create(){
		try {
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$data = array(
				'funnel_id'=> $this->getFunnelId(),
				'level'=> $this->getLevel(),
				'ques_id'=> $this->getQuesId(),
				'parent_node_id'=> $this->getParentNodeId(),
				'parent_ans'=> $this->getParentAns(),
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
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$data = array(
				'funnel_id'=> $this->getFunnelId(),
				'level'=> $this->getLevel(),
				'ques_id'=> $this->getQuesId(),
				'parent_node_id'=> $this->getParentNodeId(),
				'parent_ans'=> $this->getParentAns(),
				'date'=> $this->getDate(),
			);
			
			$wpdb->update($tableName,$data,array('node_id'=>$this->getNodeId()),null,null);
			
			$id = $this->getNodeId();
			return $lastid = $id;
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadByFunnelId($funnel_id = 0) {
		 $sqbDataArray = array();
		try {
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$sql = "SELECT * FROM " . $tableName . " WHERE `funnel_id` = '".$funnel_id."'";
			
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows)){
				foreach($rows as $row){
					$sqbData = new SQB_FunnelNodes();
					$sqbData->setNodeId($row['node_id']);
					$sqbData->setFunnelId($row['funnel_id']);
					$sqbData->setLevel($row['level']);
					$sqbData->setQuesId($row['ques_id']);
					$sqbData->setParentNodeId($row['parent_node_id']);
					$sqbData->setParentAns($row['parent_ans']);
					$sqbData->setDate($row['date']);
					$sqbDataArray[] = $sqbData;
				}
			}
			
		return $sqbDataArray;	
		
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function DeleteById($id = 0) {
		try {
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$wpdb->delete($tableName, array( 'node_id' => $id ) );
		    return $id;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	public static function loadByFunnelIdAndAndQuestionId($funnel_id = 0,$ques_id = 0 ) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$sql = "SELECT * FROM " . $tableName . " WHERE `funnel_id` ='".$funnel_id."' AND `ques_id` = '".$ques_id."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
		
			if(isset($row)){
				$sqbData = new SQB_FunnelNodes();
				$sqbData->setNodeId($row['node_id']);
				$sqbData->setFunnelId($row['funnel_id']);
				$sqbData->setLevel($row['level']);
				$sqbData->setQuesId($row['ques_id']);
				$sqbData->setParentNodeId($row['parent_node_id']);
				$sqbData->setParentAns($row['parent_ans']);
				$sqbData->setDate($row['date']);
			}
			
		return $sqbData;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
	
	public static function loadByFunnelIdAndAndQuestionIdAndParentAnsId($funnel_id = 0,$ques_id = 0,$parent_ans = 0 ) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_quiz_funnel_nodes;
			$tableName = $wpdb->prefix . $sqb_quiz_funnel_nodes;
			$sql = "SELECT * FROM " . $tableName . " WHERE `funnel_id` ='".$funnel_id."' AND `ques_id` = '".$ques_id."' AND `parent_ans` = '".$parent_ans."'" ;
			$row = $wpdb->get_row($sql, ARRAY_A);
		
			if(isset($row)){
				$sqbData = new SQB_FunnelNodes();
				$sqbData->setNodeId($row['node_id']);
				$sqbData->setFunnelId($row['funnel_id']);
				$sqbData->setLevel($row['level']);
				$sqbData->setQuesId($row['ques_id']);
				$sqbData->setParentNodeId($row['parent_node_id']);
				$sqbData->setParentAns($row['parent_ans']);
				$sqbData->setDate($row['date']);
			}
			
		return $sqbData;	
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	
}	
