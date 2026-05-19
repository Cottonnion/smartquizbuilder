<?php 

class SQB_AdvancedRule {
	
	var $id;
	var $quiz_id;
	var $question_id;
	var $answers_id;
	var $outcome_id;
	var $category_id;
	var $category_total;
	var $enabled_advanced;
	var $skip_optin;
	var $formula_id;
	var $formula_priority;
	var $date;
	var $skip_quiz;
	var $start_range;
	var $end_range;
	var $conditions;
	
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
  
	function getQuestionId() {
		return $this->question_id;
	}
	function setQuestionId($o) {
		$this->question_id = $o;
	}
  
	function getAnswersId() {
		return $this->answers_id;
	}
	function setAnswersId($o) {
		$this->answers_id = $o;
	}  
	 	
	function getOutcomeId() {
		return $this->outcome_id;
	}
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	} 

	function getCategoryTotal() {
		return $this->category_total;
	}
	function setCategoryTotal($o) {
		$this->category_total = $o;
	} 

	function getCategoryId() {
		return $this->category_id;
	}
	function setCategoryId($o) {
		$this->category_id = $o;
	}

	function getFormulaId() {
		return $this->formula_id;
	}
	function setFormulaId($o) {
		$this->formula_id = $o;
	}

	function getFormulaPriority() {
		return $this->formula_priority;
	}
	function setFormulaPriority($o) {
		$this->formula_priority = $o;
	}

	function getEnabledAdvanced() {
		return $this->enabled_advanced;
	}
	function setEnabledAdvanced($o) {
		$this->enabled_advanced = $o;
	} 
		
	function getSkipOptin() {
		return $this->skip_optin;
	}
	function setSkipOptin($o) {
		$this->skip_optin = $o;
	}
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	function getSkipQuiz() {
		return $this->skip_quiz;
	}
	function setSkipQuiz($o) {
		$this->skip_quiz = $o;
	}

	function setStartRange($o) {
		$this->start_range = $o;
	}
	function getStartRange() {
		return $this->start_range;
	}

	function setEndRange($o) {
		$this->end_range = $o;
	}
	function getEndRange() {
		return $this->end_range;
	}

	function setConditions($o){
		$this->conditions = $o;
	}
 
	function getConditions() {
		return $this->conditions;
	}

	public function create(){
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$data = array(				
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answers_id'=> $this->getAnswersId(),	 
				'outcome_id'=> $this->getOutcomeId(),	 
				'category_id'=> $this->getCategoryId(),	 
				'category_total'=> $this->getCategoryTotal(),	 
				'enabled_advanced'=> $this->getEnabledAdvanced(),	 
				'formula_id'=> $this->getFormulaId(),	 
				'formula_priority'=> $this->getFormulaPriority(),	 
				'skip_optin'=> $this->getSkipOptin(),	 
				'skip_quiz'=> $this->getSkipQuiz(),	 
				'date'=> $this->getDate(),			 
				'start_range'=> $this->getStartRange(),			 
				'end_range'=> $this->getEndRange(),			 
				'conditions'=> $this->getConditions(),			 
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
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$data = array(
				'quiz_id'=> $this->getQuizId(),
				'question_id'=> $this->getQuestionId(),
				'answers_id'=> $this->getAnswersId(),	 
				'outcome_id'=> $this->getOutcomeId(),	
				'category_total'=> $this->getCategoryTotal(),	
				'category_id'=> $this->getCategoryId(),	
				'enabled_advanced'=> $this->getEnabledAdvanced(),	
				'formula_id'=> $this->getFormulaId(),	 
				'formula_priority'=> $this->getFormulaPriority(),	 
				'skip_optin'=> $this->getSkipOptin(),  
				'skip_quiz'=> $this->getSkipQuiz(),  
				'date'=> $this->getDate(),
				'start_range'=> $this->getStartRange(),			 
				'end_range'=> $this->getEndRange(),		
				'conditions'=> $this->getConditions(),						  		 
			);
			$wpdb->update($tableName,$data,array('id'=>$this->getId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public function updateAdvanceRule(){
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$data = array(
				'enabled_advanced'=> $this->getEnabledAdvanced(),
			);
			$wpdb->update($tableName,$data,array('quiz_id'=>$this->getQuizId()),null,null);
			
			$id = $this->getId();
			return $lastid = $id;
		}catch (Exception $e) {
			throw $e;
		}	
	}
	
	public static function loadById($id) {
		 
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);
				$sqbData->setStartRange($row['start_range']);
				$sqbData->setEndRange($row['end_range']);
				$sqbData->setConditions($row['conditions']);
				

			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($quiz_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedRule();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswersId($row['answers_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setCategoryTotal($row['category_total']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setEnabledAdvanced($row['enabled_advanced']);
					$sqbData->setFormulaId($row['formula_id']);
					$sqbData->setFormulaPriority($row['formula_priority']);
					$sqbData->setSkipOptin($row['skip_optin']);
					$sqbData->setSkipQuiz($row['skip_quiz']);
					$sqbData->setDate($row['date']);	
					$sqbData->setStartRange($row['start_range']);
					$sqbData->setEndRange($row['end_range']);
					$sqbData->setConditions($row['conditions']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizIdNew($quiz_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
 
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' ORDER BY formula_priority DESC, id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedRule();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswersId($row['answers_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setCategoryTotal($row['category_total']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setEnabledAdvanced($row['enabled_advanced']);
					$sqbData->setFormulaId($row['formula_id']);
					$sqbData->setFormulaPriority($row['formula_priority']);
					$sqbData->setSkipOptin($row['skip_optin']);
					$sqbData->setSkipQuiz($row['skip_quiz']);
					$sqbData->setDate($row['date']);	
					$sqbData->setStartRange($row['start_range']);
					$sqbData->setEndRange($row['end_range']);
					$sqbData->setConditions($row['conditions']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByFormulaId($formula_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `formula_id` ='".$formula_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedRule();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswersId($row['answers_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setCategoryTotal($row['category_total']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setEnabledAdvanced($row['enabled_advanced']);
					$sqbData->setFormulaId($row['formula_id']);
					$sqbData->setFormulaPriority($row['formula_priority']);
					$sqbData->setSkipOptin($row['skip_optin']);
					$sqbData->setSkipQuiz($row['skip_quiz']);
					$sqbData->setDate($row['date']);	
					$sqbData->setConditions($row['conditions']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizIdAndFormulaId($quiz_id,$id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."' AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);		
				$sqbData->setConditions($row['conditions']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQIdAndOIdAndQuizId($question_id,$outcome_id,$quiz_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `question_id` ='".$question_id."' AND `quiz_id` ='".$quiz_id."' AND `outcome_id` ='".$outcome_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);		
				$sqbData->setConditions($row['conditions']);				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByCategoryidOutcomeidAndQuizId($category_id,$outcome_id,$quiz_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' AND `quiz_id` ='".$quiz_id."' AND `outcome_id` ='".$outcome_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);
				$sqbData->setConditions($row['conditions']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function loadByCategoryidAndQuizId($category_id,$quiz_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);
				$sqbData->setConditions($row['conditions']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public static function isRangeExists($category_id,$quiz_id,$start_range,$end_range) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `category_id` ='".$category_id."' AND `quiz_id` ='".$quiz_id."' AND ((`start_range` BETWEEN ".$start_range." AND ".$end_range.") OR (end_range BETWEEN ".$start_range." AND ".$end_range."))" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setQuestionId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);	
				$sqbData->setConditions($row['conditions']);					
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQIdAndOId($question_id,$outcome_id) {
		 $sqbData = array();
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `outcome_id` ='".$outcome_id."' AND `question_id` ='".$question_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_AdvancedRule();
				$sqbData->setId($row['id']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setAnswersId($row['question_id']);
				$sqbData->setAnswersId($row['answers_id']);
				$sqbData->setOutcomeId($row['outcome_id']);
				$sqbData->setCategoryId($row['category_id']);
				$sqbData->setCategoryTotal($row['category_total']);
				$sqbData->setEnabledAdvanced($row['enabled_advanced']);
				$sqbData->setFormulaId($row['formula_id']);
				$sqbData->setFormulaPriority($row['formula_priority']);
				$sqbData->setSkipOptin($row['skip_optin']);
				$sqbData->setSkipQuiz($row['skip_quiz']);
				$sqbData->setDate($row['date']);
				$sqbData->setConditions($row['conditions']);						
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	public static function loadByQuizIdAndQuesId($quiz_id, $question_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `question_id` ='".$question_id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedRule();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswersId($row['answers_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setCategoryTotal($row['category_total']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setEnabledAdvanced($row['enabled_advanced']);
					$sqbData->setFormulaId($row['formula_id']);
					$sqbData->setFormulaPriority($row['formula_priority']);
					$sqbData->setSkipOptin($row['skip_optin']);
					$sqbData->setSkipQuiz($row['skip_quiz']);
					$sqbData->setDate($row['date']);
					$sqbData->setConditions($row['conditions']);	
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}


	public static function loadByQuizIdAndQuesAnsId($quiz_id, $question_id, $answers_id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_advanced_rule;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$quiz_id."' AND `question_id` ='".$question_id."' AND FIND_IN_SET('".$answers_id."',answers_id) ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_AdvancedRule();
					$sqbData->setId($row['id']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setQuestionId($row['question_id']);
					$sqbData->setAnswersId($row['answers_id']);
					$sqbData->setOutcomeId($row['outcome_id']);
					$sqbData->setCategoryTotal($row['category_total']);
					$sqbData->setCategoryId($row['category_id']);
					$sqbData->setEnabledAdvanced($row['enabled_advanced']);
					$sqbData->setFormulaId($row['formula_id']);
					$sqbData->setFormulaPriority($row['formula_priority']);
					$sqbData->setSkipOptin($row['skip_optin']);
					$sqbData->setSkipQuiz($row['skip_quiz']);
					$sqbData->setDate($row['date']);	
					$sqbData->setConditions($row['conditions']);
					$sqbArray[] = $sqbData;					
				}
			}
			return $sqbArray;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_advanced_rule	;
			$tableName = $wpdb->prefix . $sqb_advanced_rule	;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	
	
}	
