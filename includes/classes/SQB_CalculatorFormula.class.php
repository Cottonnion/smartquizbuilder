<?php 

class SQB_CalculatorFormula {
	
	var $id;
	var $name;
	var $quiz_id;
	var $html;
	var $customizer_data;
	var $date;
	var $number_range;
	var $outcome_id;
	var $formula_values;
	
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

	function getQuizId() {
		return $this->quiz_id;
	}
	function setQuizId($o) {
		$this->quiz_id = $o;
	}

	function getHtml() {
		return $this->html;
	}
	function setHtml($o) {
		$this->html = $o;
	}

	function getCustomzierData() {
		return $this->customizer_data;
	}
	function setCustomzierData($o) {
		$this->customizer_data = $o;
	}
	 	 	
	function getDate() {
		return $this->date;
	}
	function setDate($o) {
		$this->date = $o;
	}
	
	function getNumberRange() {
		return $this->number_range;
	}
	function setNumberRange($o) {
		$this->number_range = $o;
	}

	function getOutcomeId() {
		return $this->outcome_id;
	}
	function setOutcomeId($o) {
		$this->outcome_id = $o;
	}

	function getFormulaValues() {
		return $this->formula_values;
	}
	function setFormulaValues($o) {
		$this->formula_values = $o;
	}
 
	public function create(){
		try {
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$data = array(
				'name'=> $this->getName(),
				'quiz_id'=> $this->getQuizId(),
				'html'=> $this->getHtml(),	 		 
				'customizer_data'=> $this->getCustomzierData(),	 		 
				'date'=> $this->getDate(),			 
				'number_range'=> $this->getNumberRange(),			 
				'outcome_id'=> $this->getOutcomeId(),			 
				'formula_values'=> $this->getFormulaValues(),
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
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$data = array(
				'name'=> $this->getName(),
				'quiz_id'=> $this->getQuizId(),
				'html'=> $this->getHtml(),	
				'customizer_data'=> $this->getCustomzierData(),	  		 
				'date'=> $this->getDate(),				  		 		 
				'number_range'=> $this->getNumberRange(),			 
				'outcome_id'=> $this->getOutcomeId(),
				'formula_values'=> $this->getFormulaValues(),	
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
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			if(isset($rows) &&  isset($rows[0])){				
				$row = $rows[0];
				$sqbData = new SQB_CalculatorFormula();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setHtml($row['html']);
				$sqbData->setCustomzierData($row['customizer_data']);
				$sqbData->setDate($row['date']);						
				$sqbData->setNumberRange($row['number_range']);						
				$sqbData->setOutcomeId($row['outcome_id']);						
				$sqbData->setFormulaValues($row['formula_values']);						
				
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function loadByQuizId($id) {
		 $sqbData = null;
		try {
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$sql = "SELECT * FROM " . $tableName . " WHERE `quiz_id` ='".$id."' ORDER BY id ASC";
			$rows = $wpdb->get_results($sql, ARRAY_A);
			$sqbData = false;
			$sqbArray = array();
			if(isset($rows) && is_array($rows)){
				 foreach($rows as $row){
					//$row = $rows[0];
					$sqbData = new SQB_CalculatorFormula();
					$sqbData->setId($row['id']);
					$sqbData->setName($row['name']);
					$sqbData->setQuizId($row['quiz_id']);
					$sqbData->setHtml($row['html']);
					$sqbData->setCustomzierData($row['customizer_data']);
					$sqbData->setDate($row['date']);							
					$sqbData->setNumberRange($row['number_range']);						
					$sqbData->setOutcomeId($row['outcome_id']);	
					$sqbData->setFormulaValues($row['formula_values']);
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
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$sql = "SELECT * FROM " . $tableName . " WHERE `id` ='".$id."' AND `quiz_id` ='".$quiz_id."'" ;
			$rows = $wpdb->get_results($sql, ARRAY_A);
			if(isset($rows) && !empty($rows)){ 	 
				$row = $rows[0];
				$sqbData = new SQB_CalculatorFormula();
				$sqbData->setId($row['id']);
				$sqbData->setName($row['name']);
				$sqbData->setQuizId($row['quiz_id']);
				$sqbData->setHtml($row['html']);
				$sqbData->setCustomzierData($row['customizer_data']);
				$sqbData->setDate($row['date']);												
				$sqbData->setNumberRange($row['number_range']);						
				$sqbData->setOutcomeId($row['outcome_id']);		
				$sqbData->setFormulaValues($row['formula_values']);	
			}
			return $sqbData;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
	public static function deleteById($id = 0) {
		try {
			global $wpdb, $sqb_calculator_formula;
			$tableName = $wpdb->prefix . $sqb_calculator_formula;
			$wpdb->delete($tableName, array('id'=>$id));
			return $id;
		}catch (Exception $e) {
			throw $e;
		}
	}
	
}	
