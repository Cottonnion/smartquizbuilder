<?php 


function SQBGetStudentShortcode($id){
	
	return '[SQBUserShortcode id='.$id.'][/SQBUserShortcode]';
}


add_action('wp_ajax_sqb_update_user_shortcode_course_details_status_by_id', 'SQBUpdateUserShortcodeCourseDetailsStatusById');
add_action('wp_ajax_nopriv_sqb_update_user_shortcode_course_details_status_by_id', 'SQBUpdateUserShortcodeCourseDetailsStatusById');


function SQBUpdateUserShortcodeCourseDetailsStatusById(){
	$output= array();
	if(isset($_POST)){ 	
		$id = $_POST['id'];
		$course_details_status = $_POST['course_details_status'];
		$output['success'] = 'update';
		$std_obj = SQB_StudentShortcode::loadById($id);
		if(isset($std_obj)){
			$std_obj->setShowCourseDetails($course_details_status);
			$std_obj->update();
		}else{
			$output['not_found'] = $id;
		}
		
		$output['id'] = $id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_delete_user_shortcode_by_id', 'SQBDeleteUserShortcodeById');
add_action('wp_ajax_nopriv_sqb_delete_user_shortcode_by_id', 'SQBDeleteUserShortcodeById');


function SQBDeleteUserShortcodeById(){
	$output= array();
	if(isset($_POST)){ 	
		$id = $_POST['id'];
		$output['success'] = 'Deleted';
		SQB_StudentShortcode::DeleteById($id);
		$output['id'] = $id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}	



add_action('wp_ajax_sqb_save_student_shortcode', 'SQBSaveStudentShortcodeAjax');
add_action('wp_ajax_nopriv_sqb_save_student_shortcode', 'SQBSaveStudentShortcodeAjax');

function SQBSaveStudentShortcodeAjax(){
	
	if(isset($_POST['quiz_ids'])){
		$quiz_ids = $_POST['quiz_ids'];
		$quiz_ids = implode(',',$quiz_ids);
		$course_details_show = $_POST['course_details_show'];
		$html = urldecode($_POST['html']);
		$customzier = $_POST['customzier'];
		$edit_id = $_POST['edit_id'];
		$result_btn_text = urldecode($_POST['result_btn_text']);
		
		$new_Obj = new SQB_StudentShortcode();
		$new_Obj->setQuizIds($quiz_ids);
		$new_Obj->setShowCourseDetails($course_details_show);
		$new_Obj->setHtml($html);
		$new_Obj->setCustomzier($customzier);
		
		$new_Obj->setResultBtnText($result_btn_text);
		
		$new_Obj->setDate(date('y-m-d H:i:s'));
		
		$edit_exist = SQB_StudentShortcode::loadById($edit_id);
		if(isset($edit_exist)){
			$new_Obj->setId($edit_exist->getId());
			$new_Obj-> update();
			$edit_id = $edit_exist->getId();
			$output['action'] = 'uddate';
		}else{
			$edit_id = $new_Obj->create();
			$output['action'] = 'create';	
		}
		$output['success'] = 'Saved';	
		$output['edit_id'] = $edit_id;	
		$output['shotcode'] = SQBGetStudentShortcode($edit_id);	
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
	
}


add_action('wp_ajax_sqblicense_save_wcp', 'sqblicense_save_wcp');

function sqblicense_save_wcp(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	$key = sanitize_text_field($_REQUEST['key']);
	update_option( 'wcp_licenseKey', $key );
}



add_action('wp_ajax_sqb_send_top_outcomes_delete', 'SQBSendTopOutcomesDeleteAjax');

function SQBSendTopOutcomesDeleteAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	if(isset($_POST['id'])){
		$id = $_POST['id'];
		SQB_OutcomeRankMapping::delete($id);
		$output['success'] = 'deleted';	
		$output['id'] = $id;	
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}	

add_action('wp_ajax_sqb_send_top_outcomes_save', 'SQBSendTopOutcomesSaveAjax');

function SQBSendTopOutcomesSaveAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$custom_field_name = $_POST['custom_field_name'];
		$rank_no = $_POST['rank_no'];
		$objnew = new SQB_OutcomeRankMapping();
		$objnew->setQuizId($quiz_id);
		$objnew->setRankNumber($rank_no);
		$objnew->setCustomFieldName($custom_field_name);
		
		$objExist = SQB_OutcomeRankMapping::loadByQuizIdAndRankNo($quiz_id,$rank_no);
		if(isset($objExist)){
			$output['tb_action'] = 'update';
			$objnew->setId($objExist->getId());
			$objnew->update();
			$output['tb_id'] = $objExist->getId();
		}else{
			$output['tb_id'] = $objnew->create();
			$output['tb_action'] = 'create';
		}
		$output['success'] = 'save';	
		
		$table_html = '<table class="table table-striped"> 
						  <thead>
							<tr>
							  <th scope="col">Rank</th>
							  <th scope="col">Custom Field</th>
							  <th scope="col">Action</th>
							</tr>
						  </thead>   
					<tbody>';
					$table_tr = '';
					
		$autoresponder_name = 'ACTIVECAMPAIGN';
		$activeCompaignobj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
		$customFields_array = array();
		if(isset($activeCompaignobj['url']) && isset($activeCompaignobj['key']) ){
			$customFields  = SQBgetActiveCampaignCustomFields($activeCompaignobj['url'] , $activeCompaignobj['key']);
			$customFields = json_decode($customFields, true);
			
			if(isset($customFields['fields'])){
				$customFields = $customFields['fields'];
				foreach ($customFields as $fields) {
					if($fields['type'] == 'text'){
						//echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$fields['id'].'">'.$fields['title'].'</a>';
						$customFields_array[$fields['id']] = $fields['title'];
					}
				}
			}
			
		}			
		$loadobj = SQB_OutcomeRankMapping::loadByQuizIdAndOrderByRank($quiz_id);	
		if(count($loadobj)){
			foreach($loadobj as $loadobj_single){
				$row_id = $loadobj_single->getId();
				$rank_no = $loadobj_single->getRankNumber();
				$custom_field_id = $loadobj_single->getCustomFieldName();
				
				if(isset($customFields_array[$custom_field_id])){
					$custom_field_id = $customFields_array[$custom_field_id];
				}
				
				$table_tr .= '<tr class="tr_send_top_outcome_'.$row_id.'"> <td>'.$rank_no.'</td> <td>'.$custom_field_id.'</td> <td><a hef="javascript:void(0)" onclick="sqb_send_top_outcomes_delete('.$loadobj_single->getId().')"> <i class="fa fa-trash-o" aria-hidden="true"></i></a></td> </tr>';
			}
		}		
					
		$table_html .= $table_tr.' </tbody>
						</table>';
		
		 $output['table_html'] = $table_html;
		 $output['loadobj'] = $loadobj;
		
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}	
 
add_action('wp_ajax_sqb_delete_submission_by_id', 'sqbDeleteSubmissionByIdAjax');
function sqbDeleteSubmissionByIdAjax($form_data = ''){

	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}

	global $wpdb;

	if($form_data !="" && is_array($form_data)){
	
		$_POST = $form_data;
	}
	if(isset($_POST['sub_id'])){
		$sub_id  = $_POST['sub_id'];

		$sqb_users_quiz_details = $wpdb->prefix .'sqb_users_quiz_details';
		$wpdb->delete( $sqb_users_quiz_details, array('id' => $sub_id ) );

		$output['success'] = 'deleted';	
		$output['sub_id'] = $sub_id;	
	}else{
		$output['error'] = 'Something Went Wrong';
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_delete_quiz_by_id', 'sqbDeleteQuizByIdAjax');
add_action('wp_ajax_nopriv_sqb_delete_quiz_by_id', 'sqbDeleteQuizByIdAjax');

function sqbDeleteQuizByIdAjax($form_data = ''){
	
	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}

	if($form_data !="" && is_array($form_data)){
	
		$_POST = $form_data;
	}
	
	if(isset($_POST['quiz_id'])){
		$quiz_id  = $_POST['quiz_id'];
		$quiz_obj = SQB_Quiz::loadById($quiz_id);
		if($quiz_obj){
			
			// Get questions ids 
			$questiones_array_data = SQB_QuizQuestions::loadByQuizId($quiz_id);
			if(count($questiones_array_data)){
				foreach($questiones_array_data as $question_data){
						$question_id = $question_data->getQuestionId();
						$questiones_data = SQB_QuizQuestions::loadByQuestionId($question_id);
						if(count($questiones_data) > 1) {
						} else {
						// question deleted in question table
						SQB_QuizQuestions::DeleteByQuestionId($question_id);
						// question deleted in question_bank table
						SQB_QuizQuestionBank::DeleteById($question_id);
						// answer deleted in quiz answer table
						SQB_QuizAnswers::DeleteByQuestionId($question_id);
						}
				}
			} 
			
			// SQB_Quiz::DeleteById($quiz_id);
			
			
			//outcome delete 
			SQB_Outcome::DeleteByQuizId($quiz_id);
			
			// deleted in quiz template table 
			SQB_QuizTemplate::DeleteByQuizId($quiz_id);
			
			// delete in coutcome mapping table
			SQB_QuizAutoresponder::DeleteByQuizId($quiz_id);
			
			
			SQB_OutComeMapping::DeleteByQuizId($quiz_id);
			// Delete quilz 
			SQB_Quiz::DeleteById($quiz_id);	
			SQB_DAPLessonQuiz::deleteByQuizId($quiz_id);
				      
			SQB_GlobalTheme::DeleteByQuizId($quiz_id);	      
			$output['success'] = 'deleted';	
			$output['quiz_id'] = $quiz_id;	
		}
		
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	if($form_data !="" && is_array($form_data)){
		return $output;
	}
	echo json_encode($output);die;
}



add_action('wp_ajax_sqb_quiz_answer_delete_single', 'sqbQuizAnswerDeleteSingleAjax');
add_action('wp_ajax_nopriv_sqb_quiz_answer_delete_single', 'sqbQuizAnswerDeleteSingleAjax');


function sqbQuizAnswerDeleteSingleAjax(){

	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}

	if(isset($_POST['answer_id'])){
		$answer_id  = $_POST['answer_id'];

		SQB_QuizAnswers::DeleteById($answer_id);
		SQB_OutComeMapping::DeleteByAnswerId($answer_id);
		$output['success'] = 'deleted';	
		$output['answer_id'] = $answer_id;	
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}



add_action('wp_ajax_sqb_quiz_question_delete_single', 'sqbQuizQuestionDeleteSingleAjax');
add_action('wp_ajax_nopriv_sqb_quiz_question_delete_single', 'sqbQuizQuestionDeleteSingleAjax');


function sqbQuizQuestionDeleteSingleAjax(){

	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}

	if(isset($_POST['quiz_id']) && isset($_POST['question_id'])){
		$question_id  = $_POST['question_id'];
		$quiz_id  = $_POST['quiz_id'];

		if(is_numeric($question_id)){
	 		$question_exists = SQB_QuizQuestions::loadByQuestionId($question_id);
		}

		if(isset($question_exists)){
			$count = count($question_exists);

			if($count > 1){
				SQB_QuizQuestions::DeleteByQuizIdAndQuestionId($quiz_id, $question_id);
			}else{
				SQB_QuizQuestions::DeleteByQuestionId($question_id);
				SQB_QuizQuestionBank::DeleteById($question_id);
				SQB_QuizAnswers::DeleteByQuestionId($question_id);
				SQB_OutComeMapping::DeleteByQuestionId($question_id);
			}	
		}

		$output['success'] = 'deleted';	
		$output['question_id'] = $question_id;	
		$output['quiz_id'] = $quiz_id;	
		$output['quiz_id'] = $quiz_id;	
		$output['reload_page'] = 'N';	
		global $sqb_add_question_pagination_limit;
		$questionsArray = SQB_QuizQuestions::loadByQuizId($quiz_id);
		if(is_array($questionsArray) && count($questionsArray)){
			if(count($questionsArray) >= $sqb_add_question_pagination_limit){
				$output['reload_page'] = 'Y';	
			}
		}
		
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}


function SqbSocialShareLoadDataByQuizIdAjax(){
	
	if(isset($_POST['quiz_id'])){
		
		$quiz_id = $_POST['quiz_id'];
		
		$alreadyHas = SQB_Social_Share::loadByQuizId($quiz_id);
		if(isset($alreadyHas)){
			
			$output['quiz_id'] = $alreadyHas->getQuizId();
			$output['share_text'] = $alreadyHas->getTitle();
			$output['fb_share_details'] = $alreadyHas->getFbDescription();
			$output['tw_share_details'] = $alreadyHas->getTwDescription();
			$output['customize_social_share_wrapper_html'] = $alreadyHas->getHtml();
			$output['share_url'] = $alreadyHas->getShareLink();
			$output['share_image_value'] = $alreadyHas->getImage();
			$output['show_social_share'] = $alreadyHas->getShowSocialShare();
			$output['success']  = 'data found';
			
		}else{
			
			$quiz_obj = SQB_Quiz::loadById($quiz_id);
			if($quiz_obj){
				
				
				$quiz_type = $quiz_obj->getQuizType(); 
				$output['share_text'] =       $quiz_obj->getQuizName();
				if($quiz_type == 'scoring'){
					$share_title = 'I got a score of %%YOURSCORE%% out of %%TOTALSCORE%% - %%QUIZTITLE%%.';
				}else if( $quiz_type == 'assessment')  {
					$share_title = 'I got %%CORRECTANSWERS%% correct answers out of %%TOTALQUESTIONS%% - %%QUIZTITLE%%.';
				}else{
					$share_title = 'I got %%OUTCOMETITLE%% - %%QUIZTITLE%%.';
				}
				$template_obj = SQB_QuizTemplate::checkByQuizIdHas($quiz_id);
				if($template_obj){
					$output['start_template'] =   urldecode(stripslashes($template_obj->getQuizStartTemplateHtml()));
					
				}
				
				
				$output['fb_share_details'] = $share_title;
				$output['tw_share_details'] = $share_title;
				$output['success']  = 'data found';
				$output['not_have_data']  = 'data found';
				
			}else{
			
			$output['error'] = "No data found";
			}
		}
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
	
}


function sqbRemoveHttp($url) {
   $disallowed = array('http://', 'https://');
   foreach($disallowed as $d) {
      if(strpos($url, $d) === 0) {
         return str_replace($d, '', $url);
      }
   }
   return $url;
}


function SqbSaveSocialShareAjax(){
	
	
	if(isset($_POST['quiz_id'])){
		
		$output['date'] = $_POST;
		$quiz_id = $_POST['quiz_id'];
		$show_social_share_btn = $_POST['show_social_share_btn'];
		$share_text = $_POST['share_text'];
		$fb_share_details = urldecode($_POST['fb_share_details']);
		$tw_share_details = urldecode($_POST['tw_share_details']);
		$share_image_value = $_POST['share_image_value'];
		$share_url = sqbRemoveHttp($_POST['share_url']);
		$html = urldecode($_POST['html']);
		$social_share_fb_api_key = $_POST['social_share_fb_api_key'];
		$current_date = date('m-d-Y');
		
		$name = 'facebook';
		$key = 'fb_api_key';
		$value = $social_share_fb_api_key;
		$insertObj = new SQB_AutoresponderSettings();
		$insertObj->setName($name);
		$insertObj->setKeyName($key);
		$insertObj->setValue($value);
		$insertObj->setDate($current_date);
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		if($obj){
			$id = $insertObj->update();
		}else{
			$id =  $insertObj->create();
		}
		
		$socialShareObj = new SQB_Social_Share();
		$socialShareObj->setQuizId($quiz_id);
		$socialShareObj->setTitle($share_text);
		$socialShareObj->setFbDescription($fb_share_details);
		$socialShareObj->setTwDescription($tw_share_details);
		$socialShareObj->setHtml($html);
		$socialShareObj->setShowSocialShare($show_social_share_btn);
		$socialShareObj->setShareLink($share_url);
		$socialShareObj->setImage($share_image_value);
		$socialShareObj->setDate($current_date);
		
		$alreadyHas = SQB_Social_Share::loadByQuizId($quiz_id);
		if(isset($alreadyHas)){
			$socialShareObj->setId($alreadyHas->getId());
			$last_id = $socialShareObj->update();
			$output['data_action'] = "create ";
			
		}else{
			$last_id = $socialShareObj->create();
			$output['data_action'] = "update ";
		}
		
		$output['last_id'] = $last_id;
		
		$output['success'] = "save ";
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
	
}


function sqbRefreshAllQuestions($id){


			$output_result['reload_fresh'] = "reload_fresh";
			
			$obj_exist = SQB_Funnel::loadByQuizId($id);
			if(($obj_exist)){
				$quizIdData = SQB_Quiz::loadById($id);
				if($quizIdData){
					$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
				}
				
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				$max_question = false;
				if(count($funnelQuestionObj) > 6){
						$max_question = true;
						$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
				}
				$output_result['total_quesitons'] = count($funnelQuestionObj);
				
				
				// append new question 
				$pos_x = 0;
				$drawflowArr1['drawflow']['Home']['data'] = array();
			
				$drawflowArr = json_decode(stripslashes($obj_exist->getFunnelData()));
				if($drawflowArr == ''){
					$drawflowArr = json_decode($obj_exist->getFunnelData());
				}
					
				
				$funnel_old_question_ids = array();
				$funnel_delete_question_ids = array();
				$funnel_new_question_ids = array();
				$funeel_answer_delete_ids = array();
				if(is_object($drawflowArr)){
					$funnel_data  = $drawflowArr->drawflow->Home->data;	
					  
					
					//  Get all questions ids 
					$funnel_all_question_ids = array();
					$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
					if(is_array($funnelQuestionObj)){
						foreach($funnelQuestionObj as $funnelQuestionObj_key => $funnelQuestionObj_value){
							$funnel_all_question_ids[] = 		$funnelQuestionObj_value->getQuestionId();
						}	
					}
					
					
					// Get all old questions ids 
					foreach($funnel_data as $key=>$funnel_data_single_row){
						$funnel_old_question_ids[] =  $key;
					}
					
					$funnel_delete_question_ids = array_diff($funnel_old_question_ids,$funnel_all_question_ids);
					$funnel_new_question_ids =  array_diff($funnel_all_question_ids,$funnel_old_question_ids);
					
					
					
					foreach($funnel_data as $key=>$funnel_data_single_row){
						//$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
						
						
						if(count($funnel_delete_question_ids)){
							if(in_array($key,$funnel_delete_question_ids)){
								if(isset($drawflowArr1['drawflow']['Home']['data'][$key])){
									unset($drawflowArr1['drawflow']['Home']['data'][$key]);
								}
							}else{
							
								if(count((array)$funnel_data_single_row->outputs)){
									// delete outputs node id if question is deleted
									
									foreach($funnel_data_single_row->outputs as  $outputs_key=>$funnel_data_single_row_outputs){
										
										foreach($funnel_data_single_row_outputs->connections as $output_key=>$funnel_data_single_row_output){
											if($output_key == 0){
												continue;
											}
											$question_id = $funnel_data_single_row_output->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->outputs->$outputs_key->connections[$output_key]);
												//break;
												
											}  
										}
										
										$funnel_data_single_row_outputs->connections = array_values($funnel_data_single_row_outputs->connections);
									}
									// delete inputs node id if question is deleted
									foreach($funnel_data_single_row->inputs as $inputs_key=>$funnel_data_single_row_inputs){
										foreach($funnel_data_single_row_inputs->connections as $input_key=>$funnel_data_single_row_input){
											$question_id = $funnel_data_single_row_input->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->inputs->$inputs_key->connections[$input_key]);
												//break;    
											}
										}
										
										$funnel_data_single_row_inputs->connections = array_values($funnel_data_single_row_inputs->connections);
										
									}
									
								}
								
							}
						
							  
						
						}else{ // if loop closed for funnel_delete_question_ids
							
						}
						
						$funnel_data_single_row->html = SQBGetFunnelQuestionAnswerHtml($key);
						
						$answer_ids = array();
						$funeel_answer_ids = array();
					
						$answerData = SQB_QuizAnswers::loadByQuestionId($key);
						if($answerData != false){
							foreach($answerData as $ans){
								$answer_ids[$ans->getId()] = $ans->getId();
							}
						}  
						
						if(count((array)$funnel_data_single_row->outputs)){
							foreach($funnel_data_single_row->outputs as  $outputs_key=>$funnel_data_single_row_outputs){
								
								foreach($funnel_data_single_row_outputs->connections as $output_key=>$funnel_data_single_row_output){
									if($output_key == 0){
										
										$funnel_answer_id = $funnel_data_single_row_output->node;
										$node_output_text = $funnel_data_single_row_output->output;
										$node_output_text = str_replace("input","output",$outputs_key);
										// Answer node is delete
										if(!in_array($funnel_answer_id,$answer_ids)	){  
											//unset($funnel_data_single_row->outputs->$outputs_key);
											$funeel_answer_delete_ids[$key][] =  $node_output_text;
											
										}
										
										$funeel_answer_ids[$funnel_answer_id] =  $funnel_answer_id;
												
									}
								}
							}
							
							//  new answer added in node 
							$funnel_add_new_answer_ids = array_diff($answer_ids,$funeel_answer_ids);
							$output_result['funnel_add_new_answer_ids'] = $funnel_add_new_answer_ids; 
							
							
							if(count($funnel_add_new_answer_ids)){
							
								$last_outputs_key_no = count($funeel_answer_ids);
								foreach($funnel_add_new_answer_ids as $funnel_add_new_answer_id){
										$last_outputs_key_no++;
							            $hh = 'output_'.$last_outputs_key_no;
										$funnel_data_single_row->outputs->$hh = array ('connections' => array ( 0 =>  array ( 'node' => $funnel_add_new_answer_id, 'output' => 'input_1', ), ), );
									
								} 
							}
							
							
						}
						
						
						
						$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
						
						//print_r($funnel_data_single_row);
						if( $pos_x < $funnel_data_single_row->pos_x){
							$pos_x    = $funnel_data_single_row->pos_x;
						}
							
						
					}// closed for each loop 
					
					// delete answer form node 
					
					$output_result['funeel_answer_delete_ids'] = $funeel_answer_delete_ids; 
					if(count($funeel_answer_delete_ids)){
						$drawflowArr_new_var = array();
						foreach($drawflowArr1['drawflow']['Home']['data'] as $key=>$funnel_data_single_row){
							if(count((array)$funnel_data_single_row->inputs)){
								foreach($funnel_data_single_row->inputs as $inputs_key=>$funnel_data_single_row_inputs){
									foreach($funnel_data_single_row_inputs->connections as $input_key=>$funnel_data_single_row_input){
											$question_id = $funnel_data_single_row_input->node;
											$node_input =  $funnel_data_single_row_input->input;
											$delelte_key = $question_id.'__'.$node_input;
											if(isset($funeel_answer_delete_ids[$delelte_key]) && ($funeel_answer_delete_ids[$delelte_key] == $delelte_key)){
												//echo "node_input: ".$node_input;die;
												//unset($funnel_data_single_row->inputs->$inputs_key->connections[$input_key]);
													//break;    
											}
									}
									$funnel_data_single_row_inputs->connections = array_values($funnel_data_single_row_inputs->connections);
									
											
								}
							}
							$drawflowArr_new_var[$key] = $funnel_data_single_row;
						}
						
						
						
						
						$drawflowArr1['drawflow']['Home']['data'] = 	$drawflowArr_new_var;
							//print_r($drawflowArr1['drawflow']['Home']['data']);  
						
						
					}
					
					
					
				} // if is_object condition closed
				
				
				
				
				
			
				
				
				// delete funnel notes if questions is deleted;
				
				if(count($funnel_delete_question_ids)){
					foreach($funnel_delete_question_ids as $funnel_delete_question_id){
						if(isset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id])){
							unset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id]);
						}
					}
					$output_result['funnel_delete_question_ids'] = implode(',',$funnel_delete_question_ids);
					$message = "Please Note: We notice that you have deleted some of questions.It will not display in funnel. ";
					$output_result['message'] = $message;
				}
				
				
				
				// if new question has,then append new question 
				if(count($funnel_new_question_ids)){
					$output_result['funnel_new_question_ids'] = implode(',',$funnel_new_question_ids);
					
					if(count($funnel_delete_question_ids)){
						$message = " We notice that you have added new questions.It will display in funnel.  ";
						$output_result['message'] = $output_result['message'].$message;
					}else{
						$message = "Please Note: We notice that you have added new questions.It will display in funnel. ";
						$output_result['message'] = $message;
					}
					
					foreach($funnel_new_question_ids as $funnel_new_question_id){
						$quesId = $funnel_new_question_id;
						$quesData = SQB_QuizQuestionBank::loadById($quesId);
						$answerData = SQB_QuizAnswers::loadByQuestionId($quesId);
						$quiz_question_answer_template_html = '';
						$tempAnsArr = array();
						$nextInput = array();
						if($quesData != false ){	
							$multiple_answers =  $quesData->getMultipleCorrectAns();

							$multiClass = '';
							if($multiple_answers == 'Y'){
								$multiClass = 'multiple_correct_ans';
							}	
							  $pos_y = 50;
							   $i = 1;
							   $j = 2;	
							   $b = 1;				
							   $quiz_question_answer_template_html .= '<div class="funnel_question_title '.$multiClass.'"  data-question-id="'.$quesData->getId().'"><span title="Q'.($quesData->getQuestionOrder()+1).':&nbsp;'.$quesData->getQuestionTitle().'">'.stripslashes($quesData->getQuestionTitle())."</span></div>";

								$nextInput['input_'.$b]['connections'] = array();
								if($answerData != false){
									$quiz_question_answer_template_html .= '<div class="funnel_answer_wrapper">';
									foreach($answerData as $ans){
										$ans_id = $ans->getId();	
										
										$quiz_question_answer_template_html .= '<div class="funnel_answer_title" data-answer-id="'.$ans->getId().'"><span  title="'.$ans->getAnswerTitle().'">'.stripslashes($ans->getAnswerTitle())."</span></div>";
										$tempAnsArr['output_'.$i] =    array ('connections' => array ( 0 =>  array ( 'node' => $ans_id, 'output' => 'input_1', ), ), );
										
										$i++;
										$j++;
									}	
									$quiz_question_answer_template_html .= '</div>';
								}
							
							if($max_question){
								$pos_x = $pos_x + 200;		
							}else{	
								$pos_x = $pos_x + 300;		
							}	
								
							$drawflowArr1['drawflow']['Home']['data'][$quesId]  = array ( 'id' => $quesId,'name' => 'qatemplate', 'data' =>  array (),'class' => 'qatemplate', 'html' => $quiz_question_answer_template_html, 'typenode' => false, 'inputs' => $nextInput,  'outputs' => $tempAnsArr, 'pos_x' =>$pos_x , 'pos_y' =>$pos_y );
							
							
							
						}
						
					}// foreach loop closed 
					
					
				}
				
				$output_result['success'] = 'no error';
				$output_result['drawflowArr'] = $drawflowArr1;
				//print_r($output_result);die;
			   
				return json_encode($output_result['drawflowArr']);
			
			}
		

}

add_action('wp_ajax_sqbGetDataForQuiz', 'sqbGetDataForQuiz');
add_action('wp_ajax_nopriv_sqbGetDataForQuiz', 'sqbGetDataForQuiz');



function sqbGetDataForQuiz(){  

	$id = $_REQUEST['id'];
	$error_msg = '';
	
	$output_result = array();
	if($id != '' && $id != 0){
		
		if(!isset($_POST['reload_fresh']) && !isset($_POST['reset_connections'])){
			$obj_exist = SQB_Funnel::loadByQuizId($id);
			if($obj_exist){
				$quizIdData = SQB_Quiz::loadById($id);
				if($quizIdData){
					$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
				}
				
				$drawflowArr = json_decode(stripslashes($obj_exist->getFunnelData()));
				
				if($drawflowArr == ''){
						$drawflowArr = json_decode($obj_exist->getFunnelData());
				}
				
				$output_result['success'] = 'no error';
				$output_result['drawflowArr'] = $drawflowArr;
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				$max_question = false;
				if(count($funnelQuestionObj) > 6){
						$max_question = true;
						$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
				}
				$output_result['total_quesitons'] = count($funnelQuestionObj);  
				$output_result['old_data'] = "get old data";
				
			
				echo json_encode($output_result) ;
				die;
			}
		}
		
		if(isset($_POST['reload_fresh'])){
			$output_result['reload_fresh'] = "reload_fresh";
			
			$obj_exist = SQB_Funnel::loadByQuizId($id);
			if(($obj_exist)){
				$quizIdData = SQB_Quiz::loadById($id);
				if($quizIdData){
					$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
				}
				
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				$max_question = false;
				if(count($funnelQuestionObj) > 6){
						$max_question = true;
						$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
				}
				$output_result['total_quesitons'] = count($funnelQuestionObj);
				
				
				// append new question 
				$pos_x = 0;
				$drawflowArr1['drawflow']['Home']['data'] = array();
			
				$drawflowArr = json_decode(stripslashes($obj_exist->getFunnelData()));
				if($drawflowArr == ''){
					$drawflowArr = json_decode($obj_exist->getFunnelData());
				}
					
				
				$funnel_old_question_ids = array();
				$funnel_delete_question_ids = array();
				$funnel_new_question_ids = array();
				$funeel_answer_delete_ids = array();
				if(is_object($drawflowArr)){
					$funnel_data  = $drawflowArr->drawflow->Home->data;	
					  
					
					//  Get all questions ids 
					$funnel_all_question_ids = array();
					$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
					if(is_array($funnelQuestionObj)){
						foreach($funnelQuestionObj as $funnelQuestionObj_key => $funnelQuestionObj_value){
							$funnel_all_question_ids[] = 		$funnelQuestionObj_value->getQuestionId();
						}	
					}
					
					
					// Get all old questions ids 
					foreach($funnel_data as $key=>$funnel_data_single_row){
						$funnel_old_question_ids[] =  $key;
					}
					
					$funnel_delete_question_ids = array_diff($funnel_old_question_ids,$funnel_all_question_ids);
					$funnel_new_question_ids =  array_diff($funnel_all_question_ids,$funnel_old_question_ids);
					
					
					
					foreach($funnel_data as $key=>$funnel_data_single_row){
						//$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
						
						
						if(count($funnel_delete_question_ids)){
							if(in_array($key,$funnel_delete_question_ids)){
								if(isset($drawflowArr1['drawflow']['Home']['data'][$key])){
									unset($drawflowArr1['drawflow']['Home']['data'][$key]);
								}
							}else{
							
								if(count((array)$funnel_data_single_row->outputs)){
									// delete outputs node id if question is deleted
									
									foreach($funnel_data_single_row->outputs as  $outputs_key=>$funnel_data_single_row_outputs){
										
										foreach($funnel_data_single_row_outputs->connections as $output_key=>$funnel_data_single_row_output){
											if($output_key == 0){
												continue;
											}
											$question_id = $funnel_data_single_row_output->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->outputs->$outputs_key->connections[$output_key]);
												//break;
												
											}  
										}
										
										$funnel_data_single_row_outputs->connections = array_values($funnel_data_single_row_outputs->connections);
									}
									// delete inputs node id if question is deleted
									foreach($funnel_data_single_row->inputs as $inputs_key=>$funnel_data_single_row_inputs){
										foreach($funnel_data_single_row_inputs->connections as $input_key=>$funnel_data_single_row_input){
											$question_id = $funnel_data_single_row_input->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->inputs->$inputs_key->connections[$input_key]);
												//break;    
											}
										}
										
										$funnel_data_single_row_inputs->connections = array_values($funnel_data_single_row_inputs->connections);
										
									}
									
								}
								
							}
						
							  
						
						}else{ // if loop closed for funnel_delete_question_ids
							
						}
						
						$funnel_data_single_row->html = SQBGetFunnelQuestionAnswerHtml($key);
						
						$answer_ids = array();
						$funeel_answer_ids = array();
					
						$answerData = SQB_QuizAnswers::loadByQuestionId($key);
						if($answerData != false){
							foreach($answerData as $ans){
								$answer_ids[$ans->getId()] = $ans->getId();
							}
						}  
						
						if(count((array)$funnel_data_single_row->outputs)){
							foreach($funnel_data_single_row->outputs as  $outputs_key=>$funnel_data_single_row_outputs){
								
								foreach($funnel_data_single_row_outputs->connections as $output_key=>$funnel_data_single_row_output){
									if($output_key == 0){
										
										$funnel_answer_id = $funnel_data_single_row_output->node;
										$node_output_text = $funnel_data_single_row_output->output;
										$node_output_text = str_replace("input","output",$outputs_key);
										// Answer node is delete
										if(!in_array($funnel_answer_id,$answer_ids)	){  
											//unset($funnel_data_single_row->outputs->$outputs_key);
											$funeel_answer_delete_ids[$key][] =  $node_output_text;
											
										}
										
										$funeel_answer_ids[$funnel_answer_id] =  $funnel_answer_id;
												
									}
								}
							}
							
							//  new answer added in node 
							$funnel_add_new_answer_ids = array_diff($answer_ids,$funeel_answer_ids);
							$output_result['funnel_add_new_answer_ids'] = $funnel_add_new_answer_ids; 
							
							
							if(count($funnel_add_new_answer_ids)){
							
								$last_outputs_key_no = count($funeel_answer_ids);
								foreach($funnel_add_new_answer_ids as $funnel_add_new_answer_id){
										$last_outputs_key_no++;
							            $hh = 'output_'.$last_outputs_key_no;
										$funnel_data_single_row->outputs->$hh = array ('connections' => array ( 0 =>  array ( 'node' => $funnel_add_new_answer_id, 'output' => 'input_1', ), ), );
									
								} 
							}
							
							
						}
						
						
						
						$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
						
						//print_r($funnel_data_single_row);
						if( $pos_x < $funnel_data_single_row->pos_x){
							$pos_x    = $funnel_data_single_row->pos_x;
						}
							
						
					}// closed for each loop 
					
					// delete answer form node 
					
					$output_result['funeel_answer_delete_ids'] = $funeel_answer_delete_ids; 
					if(count($funeel_answer_delete_ids)){
						$drawflowArr_new_var = array();
						foreach($drawflowArr1['drawflow']['Home']['data'] as $key=>$funnel_data_single_row){
							if(count((array)$funnel_data_single_row->inputs)){
								foreach($funnel_data_single_row->inputs as $inputs_key=>$funnel_data_single_row_inputs){
									foreach($funnel_data_single_row_inputs->connections as $input_key=>$funnel_data_single_row_input){
											$question_id = $funnel_data_single_row_input->node;
											$node_input =  $funnel_data_single_row_input->input;
											$delelte_key = $question_id.'__'.$node_input;
											if(isset($funeel_answer_delete_ids[$delelte_key]) && ($funeel_answer_delete_ids[$delelte_key] == $delelte_key)){
												//echo "node_input: ".$node_input;die;
												//unset($funnel_data_single_row->inputs->$inputs_key->connections[$input_key]);
													//break;    
											}
									}
									$funnel_data_single_row_inputs->connections = array_values($funnel_data_single_row_inputs->connections);
									
											
								}
							}
							$drawflowArr_new_var[$key] = $funnel_data_single_row;
						}
						
						
						
						
						$drawflowArr1['drawflow']['Home']['data'] = 	$drawflowArr_new_var;
							//print_r($drawflowArr1['drawflow']['Home']['data']);  
						
						
					}
					
					
					
				} // if is_object condition closed
				
				
				
				
				
			
				
				
				// delete funnel notes if questions is deleted;
				
				if(count($funnel_delete_question_ids)){
					foreach($funnel_delete_question_ids as $funnel_delete_question_id){
						if(isset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id])){
							unset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id]);
						}
					}
					$output_result['funnel_delete_question_ids'] = implode(',',$funnel_delete_question_ids);
					$message = "Please Note: We notice that you have deleted some of questions.It will not display in funnel. ";
					$output_result['message'] = $message;
				}
				
				
				
				// if new question has,then append new question 
				if(count($funnel_new_question_ids)){
					$output_result['funnel_new_question_ids'] = implode(',',$funnel_new_question_ids);
					
					if(count($funnel_delete_question_ids)){
						$message = " We notice that you have added new questions.It will display in funnel.  ";
						$output_result['message'] = $output_result['message'].$message;
					}else{
						$message = "Please Note: We notice that you have added new questions.It will display in funnel. ";
						$output_result['message'] = $message;
					}
					
					foreach($funnel_new_question_ids as $funnel_new_question_id){
						$quesId = $funnel_new_question_id;
						$quesData = SQB_QuizQuestionBank::loadById($quesId);
						$answerData = SQB_QuizAnswers::loadByQuestionId($quesId);
						$quiz_question_answer_template_html = '';
						$tempAnsArr = array();
						$nextInput = array();
						if($quesData != false ){	
							$multiple_answers =  $quesData->getMultipleCorrectAns();

							$multiClass = '';
							if($multiple_answers == 'Y'){
								$multiClass = 'multiple_correct_ans';
							}	
							  $pos_y = 50;
							   $i = 1;
							   $j = 2;	
							   $b = 1;				
							   $quiz_question_answer_template_html .= '<div class="funnel_question_title '.$multiClass.'"  data-question-id="'.$quesData->getId().'"><span title="Q'.($quesData->getQuestionOrder()+1).':&nbsp;'.$quesData->getQuestionTitle().'">'.stripslashes($quesData->getQuestionTitle())."</span></div>";

								$nextInput['input_'.$b]['connections'] = array();
								if($answerData != false){
									$quiz_question_answer_template_html .= '<div class="funnel_answer_wrapper">';
									foreach($answerData as $ans){
										$ans_id = $ans->getId();	
										
										$quiz_question_answer_template_html .= '<div class="funnel_answer_title" data-answer-id="'.$ans->getId().'"><span  title="'.$ans->getAnswerTitle().'">'.stripslashes($ans->getAnswerTitle())."</span></div>";
										$tempAnsArr['output_'.$i] =    array ('connections' => array ( 0 =>  array ( 'node' => $ans_id, 'output' => 'input_1', ), ), );
										
										$i++;
										$j++;
									}	
									$quiz_question_answer_template_html .= '</div>';
								}
							
							if($max_question){
								$pos_x = $pos_x + 200;		
							}else{	
								$pos_x = $pos_x + 300;		
							}	
								
							$drawflowArr1['drawflow']['Home']['data'][$quesId]  = array ( 'id' => $quesId,'name' => 'qatemplate', 'data' =>  array (),'class' => 'qatemplate', 'html' => $quiz_question_answer_template_html, 'typenode' => false, 'inputs' => $nextInput,  'outputs' => $tempAnsArr, 'pos_x' =>$pos_x , 'pos_y' =>$pos_y );
							
							
							
						}
						
					}// foreach loop closed 
					
					
				}
				
				$output_result['success'] = 'no error';
				$output_result['drawflowArr'] = $drawflowArr1;
				//print_r($output_result);die;
			   
				echo json_encode($output_result) ;
				die;	
			}
		}
		
		
		
		
		$drawflowArr = array(
			  'drawflow' => 
				  array (
					'Home' => 
						array (
							'data' => 
								array(),
						),
					),
		);
		
	//	print_r($drawflowArr);
		$quizData = SQB_Quiz::load();
		$quizIdData = SQB_Quiz::loadById($id);
		$quizTemplateData = SQB_QuizTemplate::loadByQuizId($id);
		
		if($quizIdData != false && $quizTemplateData != false){
			
			$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
			$max_question = false;
			if(count($funnelQuestionObj) > 6){
					$max_question = true;
					$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
			}
			$output_result['total_quesitons'] = count($funnelQuestionObj);
			
			
			$quizId = 	$quizIdData->getId();
			$showStartScreen = 	$quizIdData->getShowStartScreen();
			$showOptinScreen = $quizIdData->getShowOptinScreen();
			$showResultScreen = $quizIdData->getShowResultScreen();
			$quesAnsTemp1 = $quizTemplateData->getQuizQuestionAnswerTemplateHtml();
			$resultTemplate = $quizTemplateData->getQuizResultTemplateHtml();
			$startTemplate = $quizTemplateData->getQuizStartTemplateHtml();
			$optinTemplate = $quizTemplateData->getOptinTemplateHtml();
			$resultTemplateNum = $quizTemplateData->getResultTemplate();
			$optinTemplateNum = $quizTemplateData->getOptinTemplate();
			
			$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
			
			$zoominout="";
			
		    //$quesAnsTemp = $zoominout.$quesAnsTemp1;
		    $quesAnsTemp = $zoominout;

			
            $questions_order_array = array();
            
			$quizQuesData = SQB_QuizQuestions::loadByQuizId($quizId);
			
			if(count($quizQuesData)){
				
				 
				   $question_count = 0;
				   $quesitons_html = '';
				   $questions_order_array = array();
				   foreach($quizQuesData as $questionObj){
					   $question_id  = $questionObj->getQuestionId();
					   $question_data = SQB_QuizQuestionBank::loadById($question_id);
					   
					   if($question_data){
						  $question_order =  $question_data->getQuestionOrder();
						 
						  if(isset($questions_order_array[$question_order])){
								$question_order = count($questions_order_array) + 1;
						    }
						    $questions_order_array[$question_order] = $question_data; 
					   }
				   }
				ksort($questions_order_array);
			
			
			
			$pos_x = 0;
			$pos_y = 50;
			$quesCount = count($quizQuesData);
			if(count($questions_order_array)){
				$k = 1;
				$a = 1;
				$c = 1;
				$kk = 0;
				foreach($questions_order_array as $quesData){
					$i = 1;
					$j = 2;
					$b = 1;
					
					$quesId = $quesData->getId();
					

					$quesData = SQB_QuizQuestionBank::loadById($quesId);
					$answerData = SQB_QuizAnswers::loadByQuestionId($quesId);
					
					$html = '';
					$tempAnsArr = array();
					$nextInput = array();
					
					/*if($k == 1){
						$currentInput['input_'.$i] = array ( 'connections' =>  array ( 0 =>  array ( 'node' => $k, 'input' => 'output_'.$k,),),);	
					}*/
										

					if($quesData != false ){
						$multiple_answers =  $quesData->getMultipleCorrectAns();

						$multiClass = '';
						if($multiple_answers == 'Y'){
							$multiClass = 'multiple_correct_ans';
						}

						
						//$html .= $quesData->getQuestion();
						$html .= '<div class="funnel_question_title '.$multiClass.'" data-question-id="'.$quesData->getId().'" ><span title="Q'.($quesData->getQuestionOrder()+1).':&nbsp;'.$quesData->getQuestionTitle().'">'.$quesData->getQuestionTitle()."</span></div>";
						
						$nextInput['input_'.$b]['connections'] = array();
						if($answerData != false){
							$html .= '<div class="funnel_answer_wrapper">';
							foreach($answerData as $ans){
								$ans_id = $ans->getId();	
								//$html .= $ans->getAnswer();	
								$html .= '<div class="funnel_answer_title" ><span  title="'.$ans->getAnswerTitle().'">'.$ans->getAnswerTitle()."</span></div>";
								$tempAnsArr['output_'.$i] =    array ('connections' => array ( 0 =>  array ( 'node' => $ans_id, 'output' => 'input_1', ), ), );
								//array_push($nextInput['input_'.$b]['connections'],  array ( 'node' => $a, 'input' => 'output_'.$i,));		
								//array_push($nextInput['input_'.$b]['connections'],  array ( 'node' => $a, 'input' => 'output_'.$i,));		
								$i++;
								$j++;
							}
							$html .= '</div>';	
							//$b++;
							//print_r($tempAnsArr);die;
						}
						
					}
					if($html != ''){
						$html = stripslashes($html);
						//$html = str_replace("%%QUESTIONANSWERS%%" , $html, $quesAnsTemp);
						$quiz_question_answer_template_html = trim($html);
						$quiz_question_answer_template_html = str_replace("\n", '', $quiz_question_answer_template_html);
						$quiz_question_answer_template_html = nl2br($quiz_question_answer_template_html);
						$quiz_question_answer_template_html = preg_replace('!\s+!', ' ', $quiz_question_answer_template_html);
						
						
						
						
						//$pos_y = $pos_y + 50;
						if($quesCount >= $k){
							if($kk == 0){
								$currentInput = array(); 
								$pos_x = 10; 
							}
							//$drawflowArr['drawflow']['Home']['data'][$k] = array();
							$drawflowArr['drawflow']['Home']['data'][$quesId] = array ( 'id' => $quesId,'name' => 'qatemplate', 'data' =>  array (),'class' => 'multiple', 'html' => $quiz_question_answer_template_html, 'typenode' => false, 'inputs' => $currentInput,  'outputs' => $tempAnsArr, 'pos_x' =>$pos_x , 'pos_y' =>$pos_y );
						//	array_push($drawflowArr['drawflow']['Home']['data'][$k],  )	;
						
							if($kk == 0){
								
								$pos_x = 0; 
							}
						
							$kk++;
						}
						
						if($max_question){
							$pos_x = $pos_x + 200;   
						}else{     
							$pos_x = $pos_x + 300;
						}
						
						$currentInput = $nextInput;
						$k++;
						$a++;
					}
					
					
				}	
				//print_r($drawflowArr);die;
				//die;
			}
		}
			
			$output_result['success'] = 'no error';
			$output_result['drawflowArr'] = $drawflowArr;
			//echo $drawflowArr = json_encode($drawflowArr) ;
			
			
			
			
			echo json_encode($output_result) ;
			die;
		}
	}else{
		$error_msg = 'Something Went Wrong';	
		$output_result['error'] = $error_msg;
		echo json_encode($error_msg);die;
	}	
	 
	
}

function SQBGetFunnelQuestionAnswerHtml($quesId = 0){

	$quesData = SQB_QuizQuestionBank::loadById($quesId);
	$answerData = SQB_QuizAnswers::loadByQuestionId($quesId);
	$html = '';
	
	
	if($quesData != false ){
		$multiple_answers =  $quesData->getMultipleCorrectAns();
        
        if($quesData->getQuestionType() != 'multi'){
			$multiple_answers = 'N';
		}  
        
		$multiClass = '';
		if($multiple_answers == 'Y'){
			$multiClass = 'multiple_correct_ans';
		}
		$html .= '<div class="funnel_question_title '.$multiClass.'" data-question-id="'.$quesData->getId().'" ><span title="Q'.($quesData->getQuestionOrder()+1).':&nbsp;'.$quesData->getQuestionTitle().'">'.$quesData->getQuestionTitle()."</span></div>";
		if($answerData != false){
			$html .= '<div class="funnel_answer_wrapper">';
			foreach($answerData as $ans){
				$ans_id = $ans->getId();	
				$html .= '<div class="funnel_answer_title" data-answer-id="'.$ans->getId().'"><span  title="'.$ans->getAnswerTitle().'">'.$ans->getAnswerTitle()."</span></div>";
			}
			$html .= '</div>';	
		}
		if($html != ''){
			$html = stripslashes($html);
			//$html = str_replace("%%QUESTIONANSWERS%%" , $html, $quesAnsTemp);
			$html = trim($html);
			$html = str_replace("\n", '', $html);
			$html = nl2br($html);
			$html = preg_replace('!\s+!', ' ', $html);
		}
	}
	
	return $html;	
		
}
    

function sqbGetLoaderHtml(){
	
	/*$html = '<div class="sqb_loading_wrapper" style="display: none;">';
	$html .= '<div id="sqb_loadingoverlay"></div>';
	$html .= '<div id="sqb_loader_icon">';
	$html .= '<div class="lds-css ng-scope"><div style="width:100%;height:100%" class="sqb_lds-dual-ring"><div></div></div></div>';
	$html .= '</div>';
	$html .= '</div>';
	
	return $html;*/

	$html = '<div class="sqb_loading_wrapper" style="display: none;"><div class="sqb-loader-wrapper sqb-active">
    <div class="sqb-loader"><span></span><span></span><span></span><span></span></div></div></div>';

	return $html;
	
}

add_action('wp_ajax_sqb_save_zapier_url', 'SQBSaveZapierUrlAjax');

function SQBSaveZapierUrlAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	$zapier_url = esc_url_raw($_POST['zapier_url']);
	$quiz_id = $_POST['quiz_id'];
	$autoresponder_name = 'zapier';
	
	$obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quiz_id,$autoresponder_name);
	
	    $sqbData = new SQB_QuizAutoresponder();
		
		$sqbData->setName('zapier');
		$sqbData->setQuizId($quiz_id);
		$sqbData->setAction('add');
		$sqbData->setActionType('url');
		$sqbData->setDate(date('Y-m-d'));
		
		$sqbData->setActionData($zapier_url);
		$sqbData->setOutcomeId(0);
	
	if($obj_exists){
		$sqbData->setId($obj_exists[0]->getId());
		$sqbData->update();
		$output['data_action'] = 'update';
		$output['id'] = $obj_exists[0]->getId();
	}else{
		$output['id'] = $sqbData->create();
		
		$output['data_action'] = 'create';
	}
	
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_googlespreadsheet_url', 'SQBSavegooglespreadsheetUrlAjax');

function SQBSavegooglespreadsheetUrlAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	$googlespreadsheet_url = esc_url_raw($_POST['googlespreadsheet_url']);
	$quiz_id = $_POST['quiz_id'];
	$autoresponder_name = 'googlespreadsheet';
	
	$obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quiz_id,$autoresponder_name);
	
	    $sqbData = new SQB_QuizAutoresponder();
		
		$sqbData->setName('googlespreadsheet');
		$sqbData->setQuizId($quiz_id);
		$sqbData->setAction('add');
		$sqbData->setActionType('url');
		$sqbData->setDate(date('Y-m-d'));
		$sqbData->setOutcomeId(0);
		$sqbData->setActionData($googlespreadsheet_url);
	
	if($obj_exists){
		$sqbData->setId($obj_exists[0]->getId());
		$sqbData->update();
		$output['data_action'] = 'update';
		$output['id'] = $obj_exists[0]->getId();
	}else{
		$output['id'] = $sqbData->create();
		
		$output['data_action'] = 'create';
	}
	
	echo json_encode($output);
	die;
}



add_action('wp_ajax_sqb_save_webhook_url', 'SQBSaveWebhookUrlAjax');

function SQBSaveWebhookUrlAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	
	$webhook_url = $_POST['webhook_url'];
	$quiz_id = $_POST['quiz_id'];
	$secret_key = $_POST['secret_key'];
	$type = $_POST['type'];



	$autoresponder_name = 'webhook';
	$date = date('Y-m-d h:i:s');

	if($type == 'delete'){
		SQB_QuizAutoresponder::deleteByQuizIdAndName($quiz_id, $autoresponder_name);
	}

	$name = 'WEBHOOK';
	$key = 'secret_key';

	$settingsExists = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name, $key);

	$settingsObj = new SQB_AutoresponderSettings();

	$settingsObj->setName($name);
	$settingsObj->setKeyName($key);
	$settingsObj->setValue($secret_key);
	$settingsObj->setDate($date);

	if($settingsExists == false){
		$settingsObj->create();
	}else{
		$settingsObj->setId($settingsExists->getId());
		$settingsObj->update();
	}
	
	$obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quiz_id,$autoresponder_name);
	
	    $sqbData = new SQB_QuizAutoresponder();
		
		$sqbData->setName('webhook');
		$sqbData->setQuizId($quiz_id);
		$sqbData->setAction('add');
		$sqbData->setActionType('url');
		$sqbData->setDate(date('Y-m-d'));
		$sqbData->setOutcomeId(0);
		$sqbData->setActionData($webhook_url);
	
	if($obj_exists){
		$sqbData->setId($obj_exists[0]->getId());
		$sqbData->update();
		$output['data_action'] = 'update';
		$output['id'] = $obj_exists[0]->getId();
	}else{
		$output['id'] = $sqbData->create();
		
		$output['data_action'] = 'create';
	}
	
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_save_dap_external_plateform', 'SQBSaveDapExternalPlateformAjax');
add_action('wp_ajax_nopriv_sqb_save_dap_external_plateform', 'SQBSaveDapExternalPlateformAjax');

function SQBSaveDapExternalPlateformAjax(){
	
	$product_id = !empty($_POST['product_id']) ? $_POST['product_id'] : '';
	$quiz_id = $_POST['quiz_id'];
	$autoresponder_name = 'dap';
	$type = $_POST['type'];
	
	if($type == 'delete'){
		SQB_QuizAutoresponder::deleteByQuizIdAndName($quiz_id, $autoresponder_name);
		die;
	}
	
	   $obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quiz_id,$autoresponder_name);
	
	    $sqbData = new SQB_QuizAutoresponder();
		
		$sqbData->setName('dap');
		$sqbData->setQuizId($quiz_id);
		$sqbData->setAction('add');
		$sqbData->setActionType('product');		
		$sqbData->setActionData($product_id);
		$sqbData->setDate(date('Y-m-d'));
		$sqbData->setOutcomeId(0);
	if(isset($obj_exists)){
		$sqbData->setId($obj_exists[0]->getId());
		$sqbData->update();
		$output['data_action'] = 'update';
		$output['id'] = $obj_exists[0]->getId();
	}else{
		$output['id'] = $sqbData->create();
		$output['data_action'] = 'create';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_scp_external_plateform', 'SQBSaveScpExternalPlateformAjax');
add_action('wp_ajax_nopriv_sqb_save_scp_external_plateform', 'SQBSaveScpExternalPlateformAjax');

function SQBSaveScpExternalPlateformAjax(){
    $product_id = !empty($_POST['product_id']) ? $_POST['product_id'] : '';
    $quiz_id = $_POST['quiz_id'];
    $autoresponder_name = 'scp';
    $type = $_POST['type'];

    if ($type == 'delete') {
        SQB_QuizAutoresponder::deleteByQuizIdAndName($quiz_id, $autoresponder_name);
        die;
    }

    // Delete existing records first (if any)
    $existing = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quiz_id, $autoresponder_name);
    if (!empty($existing)) {
        SQB_QuizAutoresponder::deleteByQuizIdAndName($quiz_id, $autoresponder_name);
    }

    // Create a new entry
    $sqbData = new SQB_QuizAutoresponder();
    $sqbData->setName($autoresponder_name);
    $sqbData->setQuizId($quiz_id);
    $sqbData->setAction('add');
    $sqbData->setActionType('product');
    $sqbData->setActionData($product_id);
    $sqbData->setDate(date('Y-m-d'));
    $sqbData->setOutcomeId(0);

    $output['id'] = $sqbData->create();
    $output['data_action'] = 'create';

    echo json_encode($output);
    die;
}




add_action('wp_ajax_sqb_qutomation_save', 'SQBSaveAutomationAjax');


function SQBgetActiveCampaignLists($url , $key){

	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}

	$url = $url;
	$api_key = $key;
	
	$params = array(
		'api_key'      => $api_key,
		'api_action'   => 'list_list',
		'api_output'   => 'serialize',
		'ids'          => 'all',
	);

	$query = "";
	foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
	$query = rtrim($query, '& ');
	
	$url = rtrim($url, '/ ');

	if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

	if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
		die('JSON not supported. (introduced in PHP 5.2.0)');
	}

	$api = $url . '/admin/api.php?' . $query;

	$request = curl_init($api); 
	curl_setopt($request, CURLOPT_HEADER, 0); 
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
	$response = (string)curl_exec($request);

	curl_close($request); 

	if ( !$response ) {
		return;
	}
	else{
		$result = unserialize($response);
		/* Unsetting extra data from array so that only list of lists is returned */
		unset($result['result_code']);
		unset($result['result_message']);
		unset($result['result_output']);
	}
	return $result;
}

function SQBgetMailchimpLists($key){
	$api_key = $key;
	
	
	$list = array();
	$dataCenter = substr($api_key,strpos($api_key,'-')+1);
    $url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists?count=500';

	$ch = curl_init($url);
    curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                                                                                              
    $result = curl_exec($ch);
    $result1 = json_decode($result);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
   
    if($httpCode == "200"){
		$lists = $result1->lists;
		$i = 0;
		
		foreach($lists as $key){
		   $list[$i]['id'] = $key->id;
		   $list[$i]['name'] = $key->name;
		   $i++;
		}
	}
	else{
	}
	
	return $list;
	
}



function SQBgetConvertkitSequence($key , $secret){
	$api_key = $key;
	$api_secret = $secret;
	
	$url = "https://api.convertkit.com/v3/sequences?api_key=".$api_key;
	$curl = curl_init ( $url );
	curl_setopt ( $curl, CURLOPT_USERAGENT, 'STWR-CONVERTKIT' );
	curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
	curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	$response = curl_exec ( $curl ); 
	if(!$response){
	}
	else{
		$str = strpos($response,'{');
		$res_string = substr($response,$str);
		$result = json_decode($res_string);
		$courses = $result->courses;
		$count = 0;
		if(is_array($courses)){
			$count = count($courses);
		}
		
		$course = array();
		for($i=0;$i<$count;$i++){
			$course[$i]['id'] = $courses[$i]->id;
			$course[$i]['name'] = $courses[$i]->name;
		}
		return $course;
	}
}



function SQBgetConvertkitForms($key , $secret){
	$api_key = $key;
	$api_secret = $secret;
	
	$url = "https://api.convertkit.com/v3/forms?api_key=".$api_key;
	$curl = curl_init ( $url );
	curl_setopt ( $curl, CURLOPT_USERAGENT, 'STWR-CONVERTKIT' );
	curl_setopt ( $curl, CURLOPT_HEADER, TRUE );
	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
	curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
	curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
	$response = curl_exec ( $curl ); 
	if(!$response){
	}
	else{
		$str = strpos($response,'{'); 
		$res_string = substr($response,$str);
		$result = json_decode($res_string);
		$forms = $result->forms;
		$count = 0;
		if(is_array($forms)){
			$count = count($forms);
		}
		$form = array();
		for($i=0;$i<$count;$i++){
			$form[$i]['id'] = $forms[$i]->id;
			$form[$i]['name'] = $forms[$i]->name;
		}
		return $form;
	}
}



function SQBgetAweberLists($consumerKey ,$consumerSecret ,$accessKey, $accessSecret){
	
	require_once(plugin_dir_path(__FILE__) . '../plugins/aweberSQB/aweber_api/aweber_api.php');
	
	try{
		$aweber = new AWeberAPI($consumerKey, $consumerSecret);
		
		$account = $aweber->getAccount($accessKey, $accessSecret);
		
		$aweber_user = $aweber->loadFromUrl('https://api.aweber.com/1.0/accounts');
		$id = $aweber_user->data['entries'][0]['id'];
		$lists = $aweber->loadFromUrl('https://api.aweber.com/1.0/accounts/'.$id.'/lists');
		
		$list_data = $lists->data['entries'];
		$count = count($list_data);
		$listt = array();
		for($i=0;$i<$count;$i++){
			$listt[$i]['id'] = $list_data[$i]['id'];
			$listt[$i]['name'] = $list_data[$i]['name'];
		}
		
		if(isset($lists->data['next_collection_link'])){
			$listt = SQBgetAweberListsMore($listt,$aweber,$lists);
		}
		
		return $listt;
	}
	catch(Exception $e){
		return array();
	}
}

function SQBgetAweberV2Lists($client_id,$client_secret,$aweber_refresh_secret){
	
	require_once(WP_PLUGIN_DIR.'/smartquizbuilder/includes/plugins/aweberSQB/aweber_api/aweber_sqb.php');

	try{
		$aweber = new AWeberSQBCustom($client_id, $client_secret, '');
		$aweber->setRefreshToken($aweber_refresh_secret);
		$token = $aweber->refreshToken();

		$aweber = new AWeberSQBCustom($client_id, $client_secret, '');
		$aweber->setToken($token);
		$account = $aweber->getAccountDetails();
		

		$accountID = $account['entries'][0]['id'];
		
		$lists = $aweber->getLists($accountID);
	
		$list_data = $lists['entries'];
		$count = count($list_data);
		$listt = array();
		for($i=0;$i<$count;$i++){
			$listt[$i]['id'] = $list_data[$i]['id'];
			$listt[$i]['name'] = $list_data[$i]['name'];
		}
		
		/*if(isset($lists->data['next_collection_link'])){
			$listt = SQBgetAweberListsMore($listt,$aweber,$lists);
		}*/
		
		return $listt;
	}
	catch(Exception $e){
		return array();
	}
}


function SQBgetAweberListsMore($old_list,$aweber,$lists){
	
	if(isset($lists->data['next_collection_link'])){
			
			$lists = $aweber->loadFromUrl($lists->data['next_collection_link']);
			$list_data = $lists->data['entries'];
			
			$count = count($list_data);
			$k = count($old_list)-1;
			for($i=0;$i<$count;$i++){
				$k++;
				$old_list[$k]['id'] = $list_data[$i]['id'];
				$old_list[$k]['name'] = $list_data[$i]['name'];
				
			}
			if(isset($lists->data['next_collection_link'])){
				$lists_data = SQBgetAweberListsMore($old_list,$aweber,$lists);
			}
		}	
		
	return $old_list;
	
}



add_action('wp_ajax_sqb_delete_automation_action_by_id', 'SQBDeleteeAutomationActionByIdAjax');
add_action('wp_ajax_nopriv__sqb_delete_automation_action_by_id', 'SQBDeleteeAutomationActionByIdAjax');

function SQBDeleteeAutomationActionByIdAjax(){
	
	if(isset($_POST['id'])){
		 $id = $_POST['id'];
		 SQB_QuizAutoresponder::DeleteById($id);
		 $output['success']   = 'deleted';
		 $output['delete_id']   = $id;
		 
	}else{
		$output['error']   = 'Something Wrong!';
	}
	
	
	echo json_encode($output);
	die;
}



add_action('wp_ajax_sqb_save_automation_action', 'SQBSaveAutomationActionAjax');
add_action('wp_ajax_nopriv_sqb_save_automation_action', 'SQBSaveAutomationActionAjax');


function SQBSaveAutomationActionAjax(){
	
	$output = array();
	
	
	if(isset($_POST['data_info'])){
		
		$data_info = $_POST['data_info'];
		$quiz_id = $_POST['quiz_id'];
		
		$autoresponder_name = $data_info['autoresponder_name'];
		$output['data'] = $_POST;
		
		
		$obj = new SQB_QuizAutoresponder();
	
		if($autoresponder_name  == 'activecampaign'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setAction($data_info['sqb_auto_action']);
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setActionType($data_info['sqb_auto_type']);
			$obj->setActionId($data_info['sqb_select_list']);   
			//$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['automation_tags_name'];
			$sqb_action_data = $data_info['sqb_select_list'];
			$obj->setActionData($sqb_action_data);
			
			
		}else if($autoresponder_name  == 'aweber'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setAction($data_info['sqb_auto_action']);
			$obj->setActionType($data_info['sqb_auto_type']);
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			//$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['automation_tags_name'];
			$sqb_action_data = $data_info['sqb_select_list'];
			$obj->setActionData($sqb_action_data);
			
		}else if($autoresponder_name  == 'mailchimp'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setAction($data_info['sqb_auto_action']);
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setActionType($data_info['sqb_auto_type']);
			
			$obj->setActionId($data_info['sqb_select_list']);   
			//$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['automation_tags_name'].'||'.$data_info['send_password'];
			$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['send_password'];
			
			$obj->setActionData($sqb_action_data);
			
		}else if($autoresponder_name  == 'kartra'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setActionType($data_info['sqb_auto_type']);
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setActionId($data_info['sqb_select_list']);   
			//$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['automation_tags_name'].'||'.$data_info['send_password'];
			$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['send_password'];
			

			$kartra_data = explode(":",$data_info['sqb_auto_action']);
			
			$kartra_action_type = '';
			$kartra_action = '';
			if(isset($kartra_data[0])){
				$kartra_action = $kartra_data[0];
				if($kartra_action == 'A'){
					$kartra_action = 'add';
				}else 	if($kartra_action == 'R'){
					$kartra_action = 'remove';
				}
				
			}
			
			if(isset($kartra_data[1])){
				$kartra_action_type = $kartra_data[1];
			}

			$obj->setAction($kartra_action);
			$obj->setActionType($kartra_action_type);  

			$obj->setActionData($data_info['sqb_select_list']);
			
		}else if($autoresponder_name  == 'convertkit'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setAction($data_info['sqb_auto_action']);
			$obj->setActionType($data_info['sqb_auto_type']);
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
			$obj->setActionId($data_info['sqb_select_list']);   
			//$sqb_action_data = $data_info['sqb_select_list'].'||'.$data_info['automation_tags_name'];
			$sqb_action_data = $data_info['sqb_select_list'];
			$obj->setActionData($sqb_action_data);
			
			
			
		}else if($autoresponder_name  == 'drip'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$obj->setAction($data_info['add_to_id_drip']);  
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$drip_data = explode(":",$data_info['add_to_id_drip']);
			
			$drip_action_type = '';
			$drip_action = '';
			if(isset($drip_data[0])){
				$drip_action = $drip_data[0];
				if($drip_action == 'A'){
					$drip_action = 'add';
				}else 	if($drip_action == 'R'){
					$drip_action = 'remove';
				}
				
			}
			
			if(isset($drip_data[1])){
				$drip_action_type = $drip_data[1];
				
				
			}

			$obj->setAction($drip_action);  
			
			$obj->setActionType($data_info['add_to_value_drip']);  
			 
			$obj->setActionType($drip_action_type);   
			
			$obj->setActionId($data_info['add_to_value_drip']);   
			
			
			
			//$obj->setActionData($data_info['add_to_value_drip'].'||'.$data_info['automation_tags_name'].'||'.$data_info['automation_tags']);
			$obj->setActionData($data_info['add_to_value_drip']);
			
		}else if($autoresponder_name  == 'sendinblue'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$sendinblue_data = explode(":",$data_info['sqb_auto_action']);
			
			$sendinblue_action_type = '';
			$sendinblue_action = '';
			if(isset($sendinblue_data[0])){
				$sendinblue_action = $sendinblue_data[0];
				if($sendinblue_action == 'A'){
					$sendinblue_action = 'add';
				}else 	if($sendinblue_action == 'R'){
					$sendinblue_action = 'remove';
				}
				
			}
			
			if(isset($sendinblue_data[1])){
				$sendinblue_action_type = $sendinblue_data[1];
				
				
			}

			$obj->setAction($sendinblue_action);  
			
			 
			$obj->setActionType($sendinblue_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
		
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'getresponse'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$getresponse_data = explode(":",$data_info['sqb_auto_action']);
			
			$getresponse_action_type = '';
			$getresponse_action = '';
			if(isset($getresponse_data[0])){
				$getresponse_action = $getresponse_data[0];
				if($getresponse_action == 'A'){
					$getresponse_action = 'add';
				}else 	if($getresponse_action == 'R'){
					$getresponse_action = 'remove';
				}
				
			}
			
			if(isset($getresponse_data[1])){
				$getresponse_action_type = $getresponse_data[1];
				
				
			}

			$obj->setAction($getresponse_action);  
			
			 
			$obj->setActionType($getresponse_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
		
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'mailerlite'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$mailerlite_data = explode(":",$data_info['sqb_auto_action']);
			
			$mailerlite_action_type = '';
			$mailerlite_action = '';
			if(isset($mailerlite_data[0])){
				$mailerlite_action = $mailerlite_data[0];
				if($mailerlite_action == 'A'){
					$mailerlite_action = 'add';
				}else 	if($mailerlite_action == 'R'){
					$mailerlite_action = 'remove';
				}
				
			}
			
			if(isset($mailerlite_data[1])){
				$mailerlite_action_type = $mailerlite_data[1];
				
				
			}

			$obj->setAction($mailerlite_action);  
			
			 
			$obj->setActionType($mailerlite_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
			
		
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'fluentcrm'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$fluentcrm_data = explode(":",$data_info['sqb_auto_action']);
			
			$fluentcrm_action_type = '';
			$fluentcrm_action = '';
			if(isset($fluentcrm_data[0])){
				$fluentcrm_action = $fluentcrm_data[0];
				if($fluentcrm_action == 'A'){
					$fluentcrm_action = 'add';
				}else 	if($fluentcrm_action == 'R'){
					$fluentcrm_action = 'remove';
				}
				
			}
			
			if(isset($fluentcrm_data[1])){
				$fluentcrm_action_type = $fluentcrm_data[1];
				
				
			}

			$obj->setAction($fluentcrm_action);  
			
			 
			$obj->setActionType($fluentcrm_action_type);   
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'mailpoet'){ 
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$mailpoet_data = explode(":",$data_info['sqb_auto_action']);
			
			$mailpoet_action_type = '';
			$mailpoet_action = '';
			if(isset($mailpoet_data[0])){
				$mailpoet_action = $mailpoet_data[0];
				if($mailpoet_action == 'A'){
					$mailpoet_action = 'add';
				}else 	if($mailpoet_action == 'R'){
					$mailpoet_action = 'remove';
				}
				
			}
			
			if(isset($mailpoet_data[1])){
				$mailpoet_action_type = $mailpoet_data[1];
				
				
			}

			$obj->setAction($mailpoet_action);  
			
			 
			$obj->setActionType($mailpoet_action_type);   
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'sendfox'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$sendfox_data = explode(":",$data_info['sqb_auto_action']);
			
			$sendfox_action_type = '';
			$sendfox_action = '';
			if(isset($sendfox_data[0])){
				$sendfox_action = $sendfox_data[0];
				if($sendfox_action == 'A'){
					$sendfox_action = 'add';
				}else 	if($sendfox_action == 'R'){
					$sendfox_action = 'remove';
				}
				
			}
			
			if(isset($sendfox_data[1])){
				$sendfox_action_type = $sendfox_data[1];
				
				
			}

			$obj->setAction($sendfox_action);  
			
			 
			$obj->setActionType($sendfox_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
		
			$obj->setActionData($data_info['sqb_select_list']);
		}else if($autoresponder_name  == 'moosend'){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$moosend_data = explode(":",$data_info['sqb_auto_action']);
			
			$moosend_action_type = '';
			$moosend_action = '';
			if(isset($moosend_data[0])){
				$moosend_action = $moosend_data[0];
				if($moosend_action == 'A'){
					$moosend_action = 'add';
				}else 	if($moosend_action == 'R'){
					$moosend_action = 'remove';
				}
				
			}
			
			if(isset($moosend_data[1])){
				$moosend_action_type = $moosend_data[1];
				
				
			}

			$obj->setAction($moosend_action);  
			
			 
			$obj->setActionType($moosend_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
		
			$obj->setActionData($data_info['sqb_select_list']);
			
		}else if(($autoresponder_name  == 'vbout') || ($autoresponder_name  == 'klaviyo') || ($autoresponder_name  == 'acumbamail') || ($autoresponder_name  == 'hubspot')){
			$obj->setQuizId($quiz_id);
			$obj->setName($autoresponder_name);
			$common_data = explode(":",$data_info['sqb_auto_action']);
			
			$common_action_type = '';
			$common_action = '';
			if(isset($common_data[0])){
				$common_action = $common_data[0];
				if($common_action == 'A'){
					$common_action = 'add';
				}else 	if($common_action == 'R'){
					$common_action = 'remove';
				}
				
			}
			
			if(isset($common_data[1])){
				$common_action_type = $common_data[1];
				
				
			}

			$obj->setAction($common_action);  
			
			 
			$obj->setActionType($common_action_type);   
			
			$obj->setActionId($data_info['sqb_select_list']);   
			
			$obj->setOutcomeId($data_info['outcome_val'] ?? '');
			
		
			$obj->setActionData($data_info['sqb_select_list']);
		}
		$obj->setDate(date('Y-m-d'));
		
		
		$autoresponder_exists = SQB_QuizAutoresponder::loadByQuizIdAndNameAndActionAndActionTypeAndActionIdAndOutcomeId($obj->getQuizId(),$obj->getName(),$obj->getAction(),$obj->getActionType(),$obj->getActionId(),$obj->getOutcomeId());
		
		$sqb_select_list_text = !empty($_POST['sqb_select_list_text']) ? $_POST['sqb_select_list_text'] : '';
		
		if(isset($autoresponder_exists)){  
			$id = $obj->setId($autoresponder_exists->getId());
			$id = $obj->update();
			$output['data_action']   = 'update';
			
			$output['table_body_tr_data']  = $sqb_select_list_text;
			$output['table_body_tr_class'] ='table_tr_id_'.$autoresponder_exists->getId();
		}else{
			$id = $obj->create();
			$output['data_action']   = 'cteate';
			
			$table_body_tr_class = '  table_tr_id_'.$id;
			$table_body_tr = '<tr class="'.$table_body_tr_class.'">';
			$table_body_tr .= '<td>'.ucwords($obj->getAction()).'</td>';
			$table_body_tr .= '<td>'.ucwords($obj->getActionType()).'</td>';
			$table_body_tr .= '<td class="automation_action_data">'.$sqb_select_list_text.'</td>';
			$table_body_tr .= '<td class"text-center"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$id.')"></i></td>';
			$table_body_tr .= '</tr>';
			$output['table_body_tr']   = $table_body_tr;
			
			
		}
		
		
		
		$output['success']   = 'Save';
		$output['id']   = $id;
		$output['autoresponder_name']   = $autoresponder_name;
		
		
	}else{
		$output['error']   = 'Something Wrong!';
	}
	
	
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_autoresponder_test_google_sheet', 'SQBAutoresponderTestGoogleSheetAjax');
add_action('wp_ajax_nopriv_sqb_autoresponder_test_google_sheet', 'SQBAutoresponderTestGoogleSheetAjax');

function SQBAutoresponderTestGoogleSheetAjax(){
	$url = $_REQUEST['sqbgooglesheet'];
	$fields = $_REQUEST['fields'];
	$fields = explode(",",stripslashes(str_replace('"','',$fields)));
	if(class_exists('SQBSG_Authenticator')){
		$url_explode = explode('/', $url);
		$sheet_id = $url_explode[5];
		$obj = new SQBSG_Authenticator();
		$data = $obj->connectionStatus($sheet_id);

		if($data['type'] == "success"){
			$read_spreadsheet = $obj->readSpreadsheet($sheet_id);
			if(!empty($read_spreadsheet) && !empty($read_spreadsheet[0])){
				$data = $read_spreadsheet[0];
				if(in_array('first_name', $data) && in_array('email', $data) && in_array('quiz_name', $data)){
					$output['success'] = "Fields Already Added";
				}else{
					$output['error'] = "Required Fields";
				}
			}else{
				$output['error'] = "No Header Rows";
			}
		}else{
			$output['error'] = "Connection Failed";
		}

		/*
     	$obj = new SQBSG_Authenticator();
     	$data = array($fields);		  
     	$sheet_id = $url_explode[5];
     	$obj->writeSpreadsheet($sheet_id,$data,true);*/
     	//$output['success'] = "Gogole Sheet Tested Successfully";
     	echo json_encode($output);
		die;
	}		
}



add_action('wp_ajax_sqb_autoresponder_test_zapier', 'SQBAutoresponderTestZapierAjax');
add_action('wp_ajax_nopriv_sqb_autoresponder_test_zapier', 'SQBAutoresponderTestZapierAjax');

function SQBAutoresponderTestZapierAjax(){
	$url = $_REQUEST['zapier_url'];
	
	$email = get_option('admin_email');
	
    if($email == ''){
		$email = "test@".$_SERVER['SERVER_NAME'];
    }
	
	
	/*$fields = array (
		'last_name' => '',
		'address1' => '',
		'address2' => '',
		'city' => '',
		'state' => '',
		'zip' => '',
		'country' => '',
		'phone' => ''
	);
	
	 $apiparams = array (
		'first_name' => '',
		'last_name' => '',
		'email' => $email,
		'password' => '', 
		'action' => "REGISTRATON",
		'fields' => $fields,
		'tags' => ''
	);
   */
    $questions_details = array();
	
    
    $fields['first_name'] =  'Joy Test';
    $fields['email'] 	  =  $email;
    $fields['quiz_id']    =  '59';
    $fields['quiz_name']  =  'Demo quiz';
    $fields['quiz_type']  =  'personality';
    


	
	$quiz_id = $_REQUEST['quiz_id'];
	$quizDetails =  SQB_Quiz::loadById($quiz_id);
	
	if($quizDetails != false){
		$quiz_name = stripslashes($quizDetails->getQuizName());			
		$quiz_type = $quizDetails->getQuizType();
		$getQuizDesc = $quizDetails->getQuizDesc();	
		$questiones_array_data = SQB_QuizQuestions::loadByQuizId($quiz_id);
		
		
		$fields['quiz_id']    =  $quiz_id;
		$fields['quiz_name']  =  $quiz_name;
		$fields['quiz_type']  =  $quiz_type;
		
		if(is_array($questiones_array_data) && count($questiones_array_data)){
			foreach($questiones_array_data as $question_data){
				 $question_id = $question_data->getQuestionId();
				  $questionObj = SQB_QuizQuestionBank::loadById($question_id);			
				  if($questionObj){
					$question_title = $questionObj->getQuestionTitle();
					$questions_details[] = array('question_title'=>$question_title,'selected_answer' => 'A1','correct_answer'=>'Y','points_scored'=>2, 'answer_tags'=>'tag2');
				  }
				
			}	
		}	
	}


	
	
	if(count($questions_details) == 0){
			
		$questions_details[] = array('question_title'=>'Q1','selected_answer' => 'A1','correct_answer'=>'Y','points_scored'=>2, 'answer_tags'=>'tag1');
		$questions_details[] = array('question_title'=>'Q2','selected_answer' => 'A2','correct_answer'=>'N','points_scored'=>4, 'answer_tags'=>'tag2');
	}
	$fields['questions_details']  =  $questions_details;
	if($quiz_type == 'scoring'){
			$fields['points_scored']  =  0;
			$fields['total_points']  =  0;
	}	
	$fields['outcome_name']  =  'outcome name';
	$fields['outcome_tag']  =  'outcome tag';
	$fields['all_tags']  =  array('tag1','tag2','tag3');
	$fields['all_tags_name']  =  implode(',',array('tag1','tag2','tag3'));

	$fields['category_high_rank']  =  array('80%','60%','20%');
	$fields['category_low_rank']  =  array('20%','60%','80%');

	$fields['category_name_high_rank']  =  array('category1','category2','category3');
	$fields['category_name_low_rank']  =  array('category3','category2','category1');
	
	if($quiz_type == 'calculator'){
		$formula_object = SQB_CalculatorFormula::loadByQuizId($quiz_id);
		if(is_array($formula_object) && count($formula_object)){
			$count=1;
			$formula_details = array();
			foreach($formula_object as $formula_object_data){
				$formula_id = $formula_object_data->getId();
				$formula_html = $formula_object_data->getHtml();
				$orignal_formula_html = $formula_object_data->getHtml();
				$formula_details[] = array('formula'=>$orignal_formula_html,'value'=>'Formula Result'.$count.'');
			$count++;
			}
		}
		$fields['formula_details']  =  $formula_details;
	}
	
	$custom_fields = SQB_CustomFields::load();
	if(is_array($custom_fields) && count($custom_fields)){
		foreach($custom_fields as $custom_field){
			if($custom_field->getFieldType() == 'phone_number'){
				$fields['custom_'.strtolower($custom_field->getName()).'_country_code'] = !empty($custom_field->getSelectedCountry()) ? $custom_field->getSelectedCountry() : '';
			}
			$fields[strtolower($custom_field->getName())] =  '';
		}
	}
	
 	$apiparams = array('action'=>'REGISTRATON','fields'=> $fields );
	
	
	 
	$output = array();
	try{
		$curl = curl_init ( $url );
		if ($curl) {
			curl_setopt ( $curl, CURLOPT_USERAGENT, 'stwrconnect' );
			curl_setopt ( $curl, CURLOPT_HEADER, FALSE );
			curl_setopt ( $curl, CURLOPT_POST, TRUE );
			curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
			curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, TRUE );
			curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, TRUE );
			curl_setopt ( $curl, CURLOPT_CONNECTTIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 );
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, http_build_query ( $apiparams ) );
			$response = curl_exec ( $curl );
			if (curl_errno ( $curl ) > 0) {
				$output['error'] =  "Sorry, could not connect. Please check your Zapier URL";
			} else {
				
				$data['autoresponder'] = 'STWRCONNECT';
				$data['zap_url'] = $url;
				
				$output['success'] = "Zap Tested Successfully";
				$output['data'] = $data;
				$output['fields'] = $fields;
				//$output['save_return'] = stwr_save_autoresponder_data($data);;
			}
			curl_close ( $curl );
		}
	} /* try*/
	catch(Exception $e){
	}
	
	
	echo json_encode($output);
	die;

}

 

function sqb_get_autoresponder_data_edit_mode($autoresponder = ''){ /*this will return lists, sequence, products etc based on autoresponder selected*/
	
	$url = "";
	$key = "";
	$lists = "";
	$output = array();
	if($autoresponder != 'DAP'){
		$autoresponderData = SQB_AutoresponderSettings::loadAutoresponderByName($autoresponder);
	}
	
	if(isset($autoresponderData[0]) || $autoresponder == 'DAP'){
		
		if($autoresponder == 'ZAPIER'){
			
			//$output = array('url'=>$url , 'key'=>$key , 'lists' => $lists,'auto_html_select'=>$auto_html_select);
			
		}else if($autoresponder == 'DRIP'){
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'client_id'){
					$client_id = $data->getValue();
				}else if($data->getKeyName() == 'api_token'){
					$api_token = $data->getValue();
				}
			}
			$auto_html_select = '';
			$lists_sort_by_id = array();
			if($api_token != '' && $client_id != ''){
				if(!empty($lists)){
					$lists = SQBgetDripCampaignLists($api_token , $client_id);
					foreach($lists as $new_list){
						$lists_sort_by_id[$new_list->id] =  $new_list->name;
						
					}
					foreach($lists as $auto_list){
						$auto_html_select .="<option  value='".$auto_list->id."'>".$auto_list->name."</option>";
					}
				}
		        $auto_html_select = "<select id='sqb_select_list' class='form-control col-sm-3'><option value=''>Select Campaign</option>".$auto_html_select."</select>";
			}
			
			$output = array('url'=>$url , 'key'=>$key , 'lists' => $lists,'auto_html_select'=>$auto_html_select,'client_id'=>$client_id,'api_token'=>$api_token,'lists_sort_by_id'=>$lists_sort_by_id);
		
			
		}else if($autoresponder == 'ACTIVECAMPAIGN'){
		
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_url'){
					$url = $data->getValue();
				}else if($data->getKeyName() == 'api_key'){
					$key = $data->getValue();
				}
			}
			$auto_html_select = '';
			if($url != '' && $key != ''){
				 
				$lists = SQBgetActiveCampaignLists($url , $key);
				$lists_sort_by_id = array();
				if(is_array($lists)){
					foreach($lists as $new_list){
						$lists_sort_by_id[$new_list['id']] =  $new_list['name']; 
						
					}
				}
				
				$customFields  = SQBgetActiveCampaignCustomFields($url , $key);
				if (!empty($customFields)) {
					$customFields = json_decode($customFields, true);
				}
			    $customFields_array = array();
			    $customFields_array_select = '';
				if(isset($customFields['fields'])){
					$customFields = $customFields['fields'];
					foreach ($customFields as $fields) {
						if($fields['type'] == 'text'){
							$customFields_array_select .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$fields['id'].'">'.$fields['title'].'</a>';
							$customFields_array[$fields['id']] = $fields['title'];
						}
					}
				}
				
				
				if(is_array($lists) && count($lists)){
					foreach($lists as $auto_list){
						$auto_html_select .="<option  value='".$auto_list['id']."'>".$auto_list['name']."</option>";
					}
				}
		        $auto_html_select = "<select id='sqb_select_list' class='form-control'><option value=''>Select List</option>".$auto_html_select."</select>";
			}
			
			$output = array('url'=>$url , 'key'=>$key , 'lists' => $lists,'auto_html_select'=>$auto_html_select,'lists_sort_by_id'=>$lists_sort_by_id,'customFields_array_select'=>$customFields_array_select,'customFields_array'=>$customFields_array);
			
		}else if($autoresponder == 'MAILCHIMP'){
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$key = $data->getValue();
				}
			}
			$lists_sort_by_id = array();
			$auto_html_select = '';
				if($key != ''){
					$lists = SQBgetMailchimpLists($key);
					
					foreach($lists as $new_list){
						
						$lists_sort_by_id[$new_list['id']] =  $new_list['name'];
					
					}
					
					if(count($lists)){
						foreach($lists as $auto_list){
							$auto_html_select .="<option  value='".$auto_list['id']."'>".$auto_list['name']."</option>";
						}
					}
					$auto_html_select = "<select id='sqb_select_list' class='form-control'><option value=''>Select List</option>".$auto_html_select."</select>";
					
					
				}
			   $output = array('key'=>$key , 'lists' => $lists,'auto_html_select'=>$auto_html_select,'lists_sort_by_id'=>$lists_sort_by_id);
			
		}else if($autoresponder == 'CONVERTKIT'){
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$key = $data->getValue();
				}else if($data->getKeyName() == 'api_secret'){
					$secret = $data->getValue();
				}
			}
			$auto_html_sequence_select = "";
			$auto_html_forms_select = "";
			$lists_sort_by_id_form = array();
			$lists_sort_by_id_sequences = array();
			$lists_sort_by_id = array();
				if($key != ''){
					$sequence = SQBgetConvertkitSequence($key , $secret);
					
					foreach($sequence as $new_list){
						
						$lists_sort_by_id_sequences[$new_list['id']] =  $new_list['name'];
					
					}
					if(count($sequence)){
						foreach($sequence as $auto_list){
							$auto_html_sequence_select .="<option  value='".$auto_list['id']."'>".$auto_list['name']."</option>";
						} 
					}
					$auto_html_sequence_select = "<select id='sqb_select_sequence' class='form-control'><option value=''>Select Sequence</option>".$auto_html_sequence_select."</select>";
					
					$forms = SQBgetConvertkitForms($key , $secret);
					
					foreach($forms as $new_list){
						
						$lists_sort_by_id_form[$new_list['id']] =  $new_list['name'];
					
					}
					
					if(count($forms)){
						foreach($forms as $auto_list){
							$auto_html_forms_select .="<option  value='".$auto_list['id']."'>".$auto_list['name']."</option>";
						} 
					}
					$auto_html_forms_select = "<select id='sqb_select_form' class='form-control'><option value=''>Select Form</option>".$auto_html_forms_select."</select>";
					
				}
				
					$output = array('key'=>$key , 'secret'=>$secret , 'forms' => $forms , 'sequence' => $sequence,"auto_html_forms_select"=>$auto_html_forms_select,"auto_html_sequence_select"=>$auto_html_sequence_select,'lists_sort_by_id'=>$lists_sort_by_id,'lists_sort_by_id_sequences'=>$lists_sort_by_id_sequences,'lists_sort_by_id_form'=>$lists_sort_by_id_form);
				
		}else if($autoresponder == 'DAP'){
			$ProductsList = '';
			if(class_exists(Dap_Product)){
				$ProductsList = Dap_Product::loadProducts("","A");
			}
		   $output =  array('productsList' => $ProductsList);
			
			
		}else if($autoresponder == 'AWEBER'){
			
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'aweber_consumer_key'){
					$aweber_consumer_key = $data->getValue();
				}else if($data->getKeyName() == 'aweber_consumer_secret'){
					$aweber_consumer_secret = $data->getValue();
				}else if($data->getKeyName() == 'aweber_request_token'){
					$aweber_request_token = $data->getValue();
				}else if($data->getKeyName() == 'aweber_token_secret'){
					$aweber_token_secret = $data->getValue();
				}
			}
			$lists = '';
			$auto_html_select = '';
			$lists_sort_by_id = array();
			if($aweber_consumer_key != '' && $aweber_consumer_secret != '' && $aweber_request_token != '' && $aweber_token_secret != ''){
				
				$lists = SQBgetAweberLists($aweber_consumer_key , $aweber_consumer_secret,$aweber_request_token, $aweber_token_secret );
				
				
				foreach($lists as $new_list){
					$lists_sort_by_id[$new_list['id']] =  $new_list['name'];
					
				}
				
				if(!empty($lists)){
					foreach($lists as $auto_list){
						$auto_html_select .="<option  value='".$auto_list['id']."'>".$auto_list['name']."</option>";
					}
				}
				$auto_html_select = "<select id='sqb_select_list' class='form-control'><option value=''>Select List</option>".$auto_html_select."</select>";
			}
			$key = $aweber_consumer_key.'|'.$aweber_consumer_secret.'|'.$aweber_request_token.'|'.$aweber_token_secret;
			$output =  array('key'=>$key , 'lists'=>$lists,"auto_html_select"=>$auto_html_select,'lists_sort_by_id'=>$lists_sort_by_id);
			
		}else if($autoresponder == 'SENDINBLUE'){
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$sendInBlueList = SQBgetSendInBlueList($api_key);
			if($sendInBlueList != ''){
				$sendInBlueList = json_decode($sendInBlueList);
				
				if (isset($sendInBlueList->lists)) {
					$sendInBlueList = $sendInBlueList->lists;
				} else {
		        $sendInBlueList = [];
		    	}

				
			}
			$select_list = '<select class="automation_select1 add_to_value_sendinblue" id="add_to_value1" >';
			$select_list .= '<option value="">Select List</option>';
			if(!empty($sendInBlueList)){
				foreach($sendInBlueList AS $key) { 
					$select_list .=  '<option value="'.$key->id.'">'.$key->name.'</option>';
					$lists_sort_by_id[$key->id] =  $key->name;
				} 	
			}
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);

		}else if($autoresponder == 'KARTRA'){
			$api_id = '';
			$api_key = '';
			$api_password = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_id'){
					$api_id = $data->getValue();
				}elseif ($data->getKeyName() == 'api_key') {
					$api_key = $data->getValue();
				}elseif ($data->getKeyName() == 'api_password') {
					$api_password = $data->getValue();
				}
			}
			$kartraList = SQBgetKartraList($api_id, $api_key, $api_password);
			


			if($kartraList != ''){
				$kartraList = json_decode($kartraList);

				$kartraList = $kartraList->account_lists;
				
				
			}
			$select_list = '<select class="automation_select1 add_to_value_kartra" id="add_to_value1" >';
			$select_list .= '<option value="">Select List</option>';
			foreach($kartraList AS $name) { 
				$select_list .=  '<option value="'.$name.'">'.$name.'</option>';
				$lists_sort_by_id[$name] =  $name;
			} 	
			$select_list .= '</select>';
			
			$output =  array('api_id'=>$api_id, 'api_key'=>$api_key, 'api_password'=>$api_password , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);

		}else if($autoresponder == 'GETRESPONSE'){
		
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$select_list = '<select class="automation_select1 add_to_value_getresponse" id="add_to_value1" >';
			$select_list .= '<option value="">Select Campaign</option>';
			
			$campaigns_list = SQBgetGETRESPONSEList($api_key);

			if(is_object($campaigns_list) && !empty($campaigns_list)){
				foreach($campaigns_list as $campaign_info){
					$campaign_name = $campaign_info->name; 
					$campaign_id = $campaign_info->campaignId; 
					$select_list .=  '<option value="'.$campaign_id.'">'.$campaign_name.'</option>';
					$lists_sort_by_id[$campaign_id] =  $campaign_name;
				}
			} 
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);
		
	  }else if($autoresponder == 'MAILERLITE'){
		
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$select_list = '<select class="automation_select1 add_to_value_mailerlite" id="add_to_value1" >';
			$select_list .= '<option value="">Select Group</option>';
			
			$group_list = SQBgetMailerliteGroupList($api_key);
			
			if(is_array($group_list) && count($group_list)){
				foreach($group_list as $group_info){
					$group_id = $group_info->id;
					$group_name = $group_info->name;
					$select_list .=  '<option value="'.$group_id.'">'.$group_name.'</option>';
					$lists_sort_by_id[$group_id] =  $group_name;
				}
			} 
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);
		
	  }else if($autoresponder == 'FLUENTCRM'){
		
			
		
	  }else if($autoresponder == 'SENDFOX'){
		
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$select_list = '<select class="automation_select1 add_to_value_sendfox" id="add_to_value1" >';
			$select_list .= '<option value="">Select List</option>';
			
			$lists = SQBgetSendfoxList($api_key);
			
			
			if(is_array($lists) && count($lists)){
				foreach($lists as $list_info){
					$list_id = $list_info->id;
					$list_name = $list_info->name;
					$select_list .=  '<option value="'.$list_id.'">'.$list_name.'</option>';
					$lists_sort_by_id[$list_id] =  $list_name;
				}
			} 
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);
		
	  }else if($autoresponder == 'MOOSEND'){
		
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$select_list = '<select class="automation_select1 add_to_value_moosend" id="add_to_value1" >';
			$select_list .= '<option value="">Select List</option>';
			
			$lists = SQBgetMoosendList($api_key);
			
			if(is_array($lists) && count($lists)){
				foreach($lists as $list_info){
					$list_id = $list_info['ID'];
					$list_name = $list_info['Name'];
					$select_list .=  '<option value="'.$list_id.'">'.$list_name.'</option>';
					$lists_sort_by_id[$list_id] =  $list_name;
				}
			} 
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);
		
	  }else if(($autoresponder == 'VBOUT') || ($autoresponder == 'KLAVIYO') || ($autoresponder == 'ACUMBAMAIL') || ($autoresponder == 'HUBSPOT')){
		    $autoresponder_small_letter = strtolower($autoresponder);
			$api_key = '';
			$lists_sort_by_id = array();
			foreach($autoresponderData as $data){
				if($data->getKeyName() == 'api_key'){
					$api_key = $data->getValue();
				}
			}
			$select_list = '<select class="automation_select1 add_to_value_'.$autoresponder_small_letter.'" id="add_to_value1" >';
			$select_list .= '<option value="">Select List</option>';
			
			$lists = SQBgetCommonList($api_key, $autoresponder_small_letter);
			
			if(is_array($lists) && count($lists)){
				foreach($lists as $list_info){
					$list_id  = '0';
					if(isset($list_info['ID'])){
						$list_id = $list_info['ID'];
						
					}else if(isset($list_info['id'])){
						$list_id = $list_info['id'];
					}else if(isset($list_info['list_id'])){
						$list_id = $list_info['list_id'];
					}
					
					
					$list_name = '';
					if(isset($list_info['Name'])){
						$list_name = $list_info['Name'];
						
					}else if(isset($list_info['name'])){
						$list_name = $list_info['name'];
					}else if(isset($list_info['list_name'])){
						$list_name = $list_info['list_name'];
					}
					
					$select_list .=  '<option value="'.$list_id.'">'.$list_name.'</option>';
					$lists_sort_by_id[$list_id] =  $list_name;
				}
			} 
			$select_list .= '</select>';
			
			$output =  array('api_key'=>$api_key , 'lists'=>$select_list,'lists_sort_by_id'=>$lists_sort_by_id);
		
	}
		
	}
	return 	$output;
}


function SQBgetMailerliteGroupList($api_key = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}

	require_once plugin_dir_path(__FILE__) . '../plugins/mailerliteSQB/mailerliteSQB.class.php';
  
	$get_reponse_obj  = new mailerliteSQB($api_key);
	$campaigns_list = $get_reponse_obj->getGroupList();
	
	return $campaigns_list;

}

function SQBgetSendfoxList($api_key = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}

	require_once plugin_dir_path(__FILE__) . '../plugins/sendfoxSQB/sendfoxSQB.class.php';
  
	$get_reponse_obj  = new sendfoxSQB($api_key);
	$list = $get_reponse_obj->getLists();
	
	return $list;

}

function SQBgetMoosendList($api_key = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}

	require_once plugin_dir_path(__FILE__) . '../plugins/moosendSQB/moosendSQB.class.php';
  
	$get_reponse_obj  = new moosendSQB($api_key);
	$list = $get_reponse_obj->getLists();
	
	return $list;

}

function SQBgetHubspotList($api_key = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}

	require_once plugin_dir_path(__FILE__) . '../plugins/hubspot/hubspotSQB.class.php';
  
	$get_reponse_obj  = new hubspotSQB($api_key);
	$list = $get_reponse_obj->getLists();
	
	return $list;

}

function SQBgetCommonList($api_key = '', $autoresponder_small_letter = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}
	

	require_once plugin_dir_path(__FILE__) . '../plugins/'.$autoresponder_small_letter.'SQB/'.$autoresponder_small_letter.'SQB.class.php';
    $autoresponder_class = $autoresponder_small_letter.'SQB';
	$get_reponse_obj  = new $autoresponder_class($api_key);
	$list = $get_reponse_obj->getLists();
	
	return $list;

}

function SQBgetGETRESPONSEList($api_key = ''){
	if($api_key == ''){
			$response = '';
			return $response;
	}

	require_once plugin_dir_path(__FILE__) . '../plugins/getresponseSQB/getresponseSQB.class.php';
  
	$get_reponse_obj  = new getresponseSQB($api_key);
	$campaigns_list = $get_reponse_obj->getCampaigns();
	
	
	return $campaigns_list;

}

function SQBgetSendInBlueList($api_key = ''){
	
		if($api_key == ''){
			$response = '';
			return $response;
		}
		$curl = curl_init();

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://api.sendinblue.com/v3/contacts/lists?limit=50&offset=0&sort=desc",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Api-Key: ".$api_key
				],
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		 //"cURL Error #:" . $err;
		} else {
			return $response;
		}
	
}

function SQBgetKartraList($api_id='', $api_key = '', $api_password=''){
	
		if($api_id == '' || $api_key == '' || $api_password == ''){
			$response = '';
			return $response;
		}
		$curl = curl_init();

		$array = http_build_query(
        array(
            'app_id' => $api_id,
            'api_key' => $api_key,
            'api_password' => $api_password,
            'actions' => array(
                '0' => array(
                       'cmd' => 'retrieve_account_lists',
                )
            )
        )
    );

		curl_setopt_array($curl, [
			CURLOPT_URL => "https://app.kartra.com/api",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $array,
			/*CURLOPT_HTTPHEADER => [
				"Accept: application/json",
				"Api-Key: ".$api_key
				],*/
		]);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		 //"cURL Error #:" . $err;
		} else {
			return $response;
		}
	
}


//get lists from drip
function SQBgetDripCampaignLists($api_token = '',$client_id = ''){
	
	$token = $api_token;
	$accountId = $client_id;
	if(!empty($token) && !empty($accountId)){
		//$token = $token->getApi_key();
		//$accountId = $accountId->getApi_key();
	
		if($token != "" && $accountId != ""){
			$url = "https://api.getdrip.com/v2/" . $accountId . "/campaigns/";
			$curl = curl_init ( $url );
			curl_setopt($curl, CURLOPT_FRESH_CONNECT, true);
			curl_setopt($curl, CURLOPT_FORBID_REUSE, true);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30 );
			curl_setopt($curl, CURLOPT_TIMEOUT, 30 );
			curl_setopt($curl, CURLOPT_USERPWD, "$token:");
			curl_setopt($curl, CURLOPT_USERAGENT, 'DAP-DRIP' );	
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
			
			curl_setopt($curl, CURLOPT_HEADER, TRUE);

			curl_setopt($curl, CURLOPT_URL,$url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Accept:application/json, text/javascript, */*; q=0.01',
				'Content-Type: application/vnd.api+json',
			));

			$response = curl_exec ( $curl );
		 
			curl_close ( $curl );
			if ( !$response ) {
				
				return;
			}else{
				
				$str = strpos($response,'{');
				$res_string = substr($response,$str);
			
				$result = json_decode($res_string);
				/* Unsetting extra data from array so that only list of lists is returned */
				/* unset($result['result_code']);
				unset($result['result_message']);			unset($result['result_output']); */
				if(!empty($result)){
					$campaigns = $result->campaigns;
				}else{
					$campaigns = array();
				}
				return $campaigns;
			}
			
		}
	}
}


/* Save automation key */
function SQBSaveAutomationAjax(){
	if(!current_user_can('administrator')) { wp_send_json_error('Unauthorized', 403); die; }
	if(isset($_POST)){
		$autoresponder = strtoupper($_POST['autoresponder_name']); 
		
        $date_current = date('Y-m-d H:i:s');
        
       if($autoresponder == 'ACTIVECAMPAIGN'){
		   $data['api_key'] = $_POST['api_key'];
		   $data['api_url'] = $_POST['api_url'];
		   foreach($data as $key => $value){
			
			$settings = new SQB_AutoresponderSettings();
			
			$settings->setName($autoresponder);
			$settings->setKeyName($key);
			$settings->setValue($value);
			$settings->setDate($date_current);
			
			$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
			if($savedSettings == false){
				$settings->create();
			}else{
				$settings->update();
			}
			
		}
			
	   }else if($autoresponder == 'ZAPIER'){
		     $data['zapier_url'] = $_POST['zapier_url'];
		     foreach($data as $key => $value){
			
				$settings = new SQB_AutoresponderSettings();
			
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				$settings->setValue($value);
				$settings->setDate($date_current);
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
			}  
	   }else if($autoresponder == 'DRIP'){
		   
		    $data['client_id'] = $_POST['client_id'];
		    $data['api_token'] = $_POST['api_token'];
		    foreach($data as $key => $value){
			
			$settings = new SQB_AutoresponderSettings();
			
			$settings->setName($autoresponder);
			$settings->setKeyName($key);
			$settings->setValue($value);
			$settings->setDate($date_current);
			$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
			if($savedSettings == false){
				$settings->create();
			}else{
				$settings->update();
			}
		}
		    
		    
		   
	   }else if($autoresponder == 'MAILCHIMP'){
			$data['api_key'] = $_POST['api_key'];
			
			foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				

			}
			
			
			
		}else if($autoresponder == 'CONVERTKIT'){
			$data['api_key'] = $_REQUEST['api_key'];
			$data['api_secret'] = $_REQUEST['api_secret'];
			
			foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}
	}else if($autoresponder == 'KARTRA'){

			$data['api_id'] = $_REQUEST['api_id'];
			$data['api_key'] = $_REQUEST['api_key'];
			$data['api_password'] = $_REQUEST['api_password'];
			
			foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}	
	}else if($autoresponder == 'AWEBER'){
		
		require_once(plugin_dir_path(__FILE__) . '../plugins/aweberSQB/aweber_api/aweber_api.php');
		
		$dataNew['api_keys'] = $_REQUEST['api_keys'];
		$code = addslashes($dataNew['api_keys']);
		try{
			$credentials = AWeberAPI::getDataFromAweberID($code);
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		
		$dataNew = explode('|' , $dataNew['api_keys']);
		$data['aweber_consumer_key'] = $credentials[0];
		$data['aweber_consumer_secret'] = $credentials[1];
		$data['aweber_request_token'] = $credentials[2];
		$data['aweber_token_secret'] = $credentials[3];
		
		foreach($data as $key => $value){
			
			$settings = new SQB_AutoresponderSettings();
			
			$settings->setName($autoresponder);
			$settings->setKeyName($key);
			
			$settings->setValue($value);
			$settings->setDate($date_current);
			
			$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
			if($savedSettings == false){
				$settings->create();
			}else{
				$settings->update();
			}
		}
	
	}else if($autoresponder == 'SENDINBLUE'){
		
		$data['api_key'] = $_REQUEST['api_key'];
		
		foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}
		
	}else if($autoresponder == 'GETRESPONSE'){
		
		$data['api_key'] = $_REQUEST['api_key'];
		
		foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}
	}else if($autoresponder == 'MAILERLITE'){
		
		$data['api_key'] = $_REQUEST['api_key'];
		
		foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}
	}else if($autoresponder == 'SENDFOX'){
		
		$data['api_key'] = $_REQUEST['api_key'];
		
		foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}					
	}else if(($autoresponder == 'MOOSEND') || ( $autoresponder == 'VBOUT') || ( $autoresponder == 'KLAVIYO') || ( $autoresponder == 'ACUMBAMAIL') || ( $autoresponder == 'HUBSPOT')){
		
		$data['api_key'] = $_REQUEST['api_key'];
		
		foreach($data as $key => $value){
				
				$settings = new SQB_AutoresponderSettings();
				
				$settings->setName($autoresponder);
				$settings->setKeyName($key);
				
				$settings->setValue($value);
				$settings->setDate($date_current);
				
				$savedSettings = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder , $key);
				if($savedSettings == false){
					$settings->create();
				}else{
					$settings->update();
				}
				
			}					
	}else{
		$output['error'] = 'not save';
	}
	
	$data = sqb_get_autoresponder_data_edit_mode($autoresponder);
	$output['success'] = 'save';
	$output['data'] = $data;
	$output['autoresponder_name'] = $autoresponder;
	
	}else{
		$output['error'] = 'not save';
	}
	
	echo json_encode($output);
	die;
	
}


function sqbAddMoreQuestions1(){
	
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/startscreen_img.jpg';
	
	$html  = '
			<div class="question_div_outer" id="%%CURRENTDATETIMEMAINDIV%%">
				<div class="quiz-content-card question-type-card">
					<!--label  class="quiz_label">Question  type</label>
					<div class="dropdown dropdown-custom-style">
						<button class="dropdown-toggle" type="button" data-toggle="dropdown">Select Type
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><a href="#" value="multi" >Multiple Choice</a></li>
							
						</ul>
					</div-->
					<!--div class="multi-correct-option">
						<div class="checkbox-custom-style">
							<input type="checkbox" name="multiple_correct_ans" class="custom-checkbox-input">
							<span class="custom--checkbox"></span>
						</div>
						<label>Multiple Correct Answers</label>
					</div-->
						<!--select name="ques_type"  class="ques_type_cls">
							<option value="0">Select Type</option>
							<option value="single">Single</option>
							<option value="multi">Multiple Choice </option>
							<option value="text">text</option>
							<option value="fill_in_blank">Fill In Blank</option>
						</select-->
				</div>
				<input type="hidden" name="question_temp_name" value="standard">
				<input type="hidden" name="question_temp_no" value="template1">
				<div class="question_div_inner"  style=" position: relative;">
					
								
					<div class="Quiz-Template quiz_comon_template sqb_question_enable_drag_drop ">
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title"><div>Enter Your Question Here </div></div>

						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image" id="%%CURRENTDATETIMEIMAAOUTER%%">
							<span class="sqb_backend_show sqb_remove_section" data-id="%%CURRENTDATETIMEIMAAOUTER%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
							<img class="sqb_img_draggable  %%CURRENTDATETIMEIMG%%" src="'.$img_url.'">
							<span data-class="%%CURRENTDATETIMEIMG%%" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
						</div>

						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor">
							<div>Enter any additional information about the quiz</div>
						</div>
                        
                        <div class="ans_layout_div">
                        	<div class="answer-view-options">
                        		<label>Choose layout:</label>
								<div class="sqb_ans_layout_standard selected-op ans_layout_typw"><i class="fa fa-bars" aria-hidden="true"></i></div>
								<div class="sqb_ans_layout_mulitple ans_layout_typw"><i class="fa fa-th-large" aria-hidden="true"></i></div>
							</div>
							<div class="sqb_ans_add_image">
								<div class="checkbox-custom-style">
									<input type="checkbox"  class="custom-checkbox-input" name="sqb_ans_with_img_checkbox">
									<span class="custom--checkbox"></span>
								</div> 
								<label>Answer With Image</label>

								<div class="dropdown-link-style dropdown">
									<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="#"> Show Multiple Correct Answers</a>
										<a class="dropdown-item">Delete Question</a>
									</div>
								</div>
							</div>
						</div>
                        
                        
						<div class="question_add_answer_outer_div sqb_question_drag_drop_item">
						</div>
						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn">Add Answer</div>
							<div class="assessment_outcome_connect_btn" >Connect To Outcome</div>
						</div>
						<div class="assessment_outcome_connect" style="display:none">
						 
						</div> 
						  
						
					</div>

					
					<div class="QA-advance-option">
						<h5>Your Correct/Incorrect Answer Alert Message</h5>
						<div class="quiz-content-card">
							<label for="" class="quiz_label">Message to be display correct answer </label>
							<div class="quiz_right-content">
								<div class="sqb_correct_ans sqb_tiny_mce_editor"><div>correct answer</div></div>
							</div>
						</div>
						<div class="quiz-content-card">
							<label for="" class="quiz_label">Message to be display incorrect answer</label>
							<div class="quiz_right-content">
								<div class="sqb_incorrect_ans sqb_tiny_mce_editor"><div>Incorrect answer</div></div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
				';
				
	return $html;
	
	
}

//add_action('wp_ajax_sqb_outcometemp', 'sqb_outcometemp');
//add_action('wp_ajax_nopriv_sqb_outcometemp', 'sqb_outcometemp');

/* Save Outcome  */
function sqb_outcometemp_rename(){
	$output="";
	 
	if(isset($_POST)){			 
		$id = $_POST['id'];
		$outcome_action = $_POST['outcome_action'];
		$redirect = $_POST['outcome_redirect'];
		$outcome_screen = $_POST['outcome_screen'];
		$outcomeObj = new SQB_Outcome();			
		
		if($outcome_action == "redirectsave"){
			 
			$quiz_outcome_obj = SQB_Outcome::loadById($id); 
			if(isset($quiz_outcome_obj)){
				$outcomeObj->setId($quiz_outcome_obj->getId());	
				$outcomeObj->setQuizId($quiz_outcome_obj->getQuizId());	
				$outcomeObj->setOutcomeName($quiz_outcome_obj->getOutcomeName());	
				$outcomeObj->setOutcomeHtml($quiz_outcome_obj->getOutcomeHtml());	
				$outcomeObj->setPoint($quiz_outcome_obj->getPoint());	
				$outcomeObj->setPointRange($quiz_outcome_obj->getPointRange());	
				$outcomeObj->setCorrectAnsNum($quiz_outcome_obj->getCorrectAnsNum());	
				$outcomeObj->setCorrectAnsRange($quiz_outcome_obj->getCorrectAnsRange());	
				$outcomeObj->setRedirect($redirect);	
				$outcomeObj->setOutcomeScreen($outcome_screen);	
				$outcomeObj->setDate(date('Y_m_d'));
				$id = $outcomeObj->update();
				$output = $id;		
			}	
			
		}else{
			
			
			$quiz_id = $_POST['quiz_id'];
			$outcome_name = $_POST['outcome_name'];
			$outcome_html = $_POST['outcome_html'];
			$point = $_POST['number_val'];
			$range_val = $_POST['range_val'];
			$range_val1 = $_POST['range_val1'];
			$point_range = $range_val."-".$range_val1;
	 
			$outcomeObj->setQuizId($quiz_id);
			$outcomeObj->setOutcomeName($outcome_name);		
			$outcomeObj->setOutcomeHtml($outcome_html);
			$outcomeObj->setPoint($point);	 
			$outcomeObj->setPointRange($point_range);	 
			$outcomeObj->setCorrectAnsNum($point);	 
			$outcomeObj->setCorrectAnsRange($point_range);	
			$outcomeObj->setRedirect("");		
			$outcomeObj->setOutcomeScreen("");	
			$outcomeObj->setDate(date('Y_m_d'));
			
			if($id !=""){
				 
				$outcomeObj->setId($id);	
				$id = $outcomeObj->update();
			}else{
				 
				$id = $outcomeObj->create();
			}
			$output = $id;		 
	
		}	
	}else{
		$output = "";
	}			
		
	echo json_encode($output);
	die;
}







add_action('wp_ajax_sqb_user_question_answer_reset_by_id', 'SQBUserQuestionAnswerResetById');

add_action('wp_ajax_nopriv_sqb_user_question_answer_reset_by_id', 'SQBUserQuestionAnswerResetById');


function SQBUserQuestionAnswerResetById(){
	if(isset($_POST)){	
		
		$user_id = $_POST['user_id'];
		$quiz_id = $_POST['quiz_id'];
		$date = $_POST['date'];
		$quiz_type = $_POST['quiz_type'];
		
		$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
		if(isset($sqbloadquestionsobj)){ 
			foreach($sqbloadquestionsobj as $quet_id => $questions) {
				  
				
				$delete_id = $questions->getId();
				$output['deleted_ids'][] = $delete_id;
				SQB_UserQuizDetails::delete($delete_id);
			}
		}
		
		
		$output['success'] = "Deleted";
		
		
		
	}else{
		
		$output['error'] = "Something Wrong!";
		
	}
	
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_load_userdetails', 'sqb_load_userdetails');
add_action('wp_ajax_nopriv_sqb_load_userdetails', 'sqb_load_userdetails');

//manage leads load user details
function sqb_load_userdetails(){
	$output="No Data Found";	 
	if(isset($_POST)){	 
		$user_id = $_POST['user_id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$quizid = $_POST['quiz_id'];
		$date = $_POST['date'];
		$row_id = $_POST['row_id'];
		$source = $_POST['source'];
		$course_id = $_POST['course_id'];
		$quiz_array = "";
		$questiondata = "";
		$htmldata = "";
		$outcome_name="";	
		$outcome_tag="No tag assigned";	
		$ques_ans_data="";	
		$userdata="";
		$manage_leads_id = "";				 
		$quizObjArray = SQB_ManageLeads::loadByUserIdAndDateAndSource($user_id,$date,$source);	  
		$delete_btn_records_html =  '';
		$course_details =  '';
		if(isset($quizObjArray)){
			//foreach($quizObjArray as $quizObjArray1){
			$quizObjArray1 =  $quizObjArray;
				$category_details_html = '';
				if($quizid =="all"){
					$quiz_id = $quizObjArray1->getQuizId();
				} else{
					$quiz_id = $quizid;
				}
				$shown_outcome = $quizObjArray1->getShownOutcome();				
				$outcome = $quizObjArray1->getOutcome();		
				$gdpr_req = $quizObjArray1->getGDPROptedIn();	
				$manage_leads_id = $quizObjArray1->getId();
				$user_id = $quizObjArray1->getUserId();
				
				if($gdpr_req == 'Y'){
					$gdpr_value = 'Accepted';
				}else{
					$gdpr_value = 'Declined';
				}

				$quizObj = SQB_Quiz::loadById($quiz_id);	
				 
				$outcomeObj = SQB_Outcome::loadById($outcome);				 
				if(isset($outcomeObj) && !empty($outcomeObj)){
					$outcome_name = stripslashes($outcomeObj->getOutcomeName());
					$outcome_tag = $outcomeObj->getTag();
				} 
				if(isset($quizObj)){
					$quiz_name = $quizObj->getQuizName();
					$quiz_type = $quizObj->getQuizType();	
					$user_login_source = $quizObjArray1->getSource();
					$category_details =  $quizObjArray1->getCategoryDetails();				
					
					if($category_details != ''){
						$category_details = json_decode($category_details,true);
						if(is_array($category_details)){
							$category_details_html = SQBCategoryResultDetailsHtml($category_details, 'in_popup', $quiz_type);
						}						
					}
					
					$timer_enable_display ="display:none";
					$timer_customizer = $quizObj->getTimerCustomizer();
					if($timer_customizer != ''){						 
						$timer_customizer_array = explode('||',$timer_customizer); 
						if(isset($timer_customizer_array[0])){
							$timer_enable = $timer_customizer_array[0];
							if($timer_enable =="Y"){
								$timer_enable_display ="display:block";
							}
						}						
					}	


					$speed_timer_customizer = $quizObj->getAllOtherOptions();
					if($speed_timer_customizer && $speed_timer_customizer != 'NULL'){
						$speed_timer_customizer = maybe_unserialize($speed_timer_customizer);
						if(!empty($speed_timer_customizer)){

							if(array_key_exists('speed_timer_enable', $speed_timer_customizer)){
								if(!empty($speed_timer_customizer['speed_timer_enable'])){
									$speed_timer_enable = $speed_timer_customizer['speed_timer_enable'];
									if($speed_timer_enable == 'Y'){
										$timer_enable_display ="display:block";
									}
			   				}	
							}

						}
					}
					$allow_retake_display ="display:none";
					$allow_retake_option =  $quizObj->getAllowRetake();
					if($allow_retake_option == "Y"){
						$allow_retake_display ="display:block";
					}
					
					$gdpr_display ="display:none";
					$ip = $_SERVER['REMOTE_ADDR'];
					$gdprcountry = sqbGetGDPRStatus($ip); 
					if($gdprcountry == "1"){
						if($gdpr_req == 'Y' || $gdpr_req == 'N'){
							$gdpr_display ="display:block";
						}
					}
				
				 
				
				if($user_login_source == 'DAP'){
					if(class_exists('Dap_SQBQuizCourseLessons')){
						//$course_id =  $quizObjArray1->getCourseId(); 
						$lesson_id =  $quizObjArray1->getLessonId();
						$dap_c_name = '';
						$dap_cdata = Dap_Product::loadProduct($course_id);
						if(isset($dap_cdata) ){ 
							$dap_c_name = $dap_cdata->getName();
						}
							
						$unit = Dap_Product::displayFileResourcesWithCourseIdLessonId($course_id, $lesson_id);	
						
						$lesson_name = '';	
							
						if(is_array($unit) && count($unit)){	
							if($unit['name'] ==""){
								$lesson_name = $unit['url'];
							}else{
								$lesson_name = $unit['name'];
							}
						}
						
						if($dap_c_name !== '' ){
							$course_details = '<div class="Side_Popup_card dap_sqb_course_id_'.$course_id.'">
												<label >Course Name  </label>
												<p class="user_email1">'.$dap_c_name.'</p>
											</div>'; 
						}					
											
						if($lesson_name !== '' ){					
							$course_details .=	'<div class="Side_Popup_card dap_sqb_lesson_id_'.$lesson_id.'">
												<label >Lesson Name  </label>
												<p class="user_email1">'.$lesson_name.'</p>
											</div>' ;
						}
									
					}
				}
					
					$total_htlm = getQuestionsTotalInfoByQuizIdByDate($user_id, $quiz_id ,$date,$quiz_type);
					$retake_count = getQuizRetakeCountByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type);
					$time = getQuizTimeSpentByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type);				
					$minutes = floor($time / 60);
					$time -= $minutes * 60;
					$seconds = floor($time);
					$time -= $seconds;
					$time_spent = $minutes.'m '.$seconds.'s'; 

					$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
					// echo '<pre>';print_r($sqbloadquestionsobj);
					$tag_id = array();
					if(isset($sqbloadquestionsobj)){ 
						foreach($sqbloadquestionsobj as $quet_id => $questions) {
							$tag_ids = $questions->getAnswerTagIds();
							$tag_ids_explode = explode(',',$tag_ids);
							foreach($tag_ids_explode as $tags){
								$tag_id[] = $tags;
							}
						}
					}

					$unique_tag_ids = array_unique($tag_id);
					$tag_name = array();
					foreach($unique_tag_ids as $tag_id){
						if($tag_id == ''){
							continue; 
						}
						$tagdataobj =  SQB_Tags::loadById($tag_id);	  
						
						if(!empty($tagdataobj)){
								$tag_name[] = $tagdataobj->getName();  
							}				
					}
					if($tag_name){
						$all_tag = implode(', ',$tag_name);
					}else{
						$all_tag = "No tags";
					}

					if($outcome_tag && $outcome_tag != 'NULL'){
						$outcome_tag = $outcome_tag;
					}else{
						$outcome_tag = "No tags";
					}

					$htmldata = ' <div class="Side_Popup_card">
						<h4 class="full_wid small_heading">Quiz Details </h4>
						<label>Quiz Name: </label>
						<p>'.$quiz_name.'</p>
					</div>
					<div class="Side_Popup_card">
						<label>Quiz Type: </label>
						<p class="capitalize_text">'.$quiz_type.'</p>
					</div>
					<div class="Side_Popup_card">
						<label>Date: </label>
						<p class="capitalize_text">'.sqb_get_date($date).'</p>
					</div>
					<div class="Side_Popup_card"  style="'.$allow_retake_display.'">
						<label>Retake Count: </label>
						<p class="capitalize_text">'.$retake_count.'</p>
					</div>
					<div class="Side_Popup_card" style="'.$timer_enable_display.'">
						<label>Time Spent: </label>
						<p class="capitalize_text">'.$time_spent.' </p>
					</div>
					<div class="Side_Popup_card" style="'.$gdpr_display.'">
						<label>GDPR Terms: </label>
						<p class="capitalize_text">'.$gdpr_value.' </p>
					</div>
					</div><div class="Side_Popup_card_outer"> 
					<div class="Side_Popup_card">
						<h4 class="full_wid small_heading">Quiz Result </h4> 
						<label>Outcome: </label> 
						<p>'.$outcome_name.'</p>
						'.$total_htlm.'
					</div>
					</div>
					<div class="Side_Popup_card_outer">
					<div class="Side_Popup_card">
						<h4 class="full_wid small_heading">Assigned Tags</h4>
						<label>Outcome Tags: </label>
						<p>'.$outcome_tag.'</p>
					</div>
					<div class="Side_Popup_card">
						<label>Answer Tags: </label>
						<p>'.$all_tag.'</p>
					</div>

					</div>'.$category_details_html;	
				
					$ques_ans_data =  getQuestionsByQuizIdByDate($user_id, $quiz_id,$date, $quiz_type, $name);
					if($ques_ans_data ==""){
						$ques_ans_data ="No Data Found";	
					}else{
						
						if(isset($_POST['row_id']))	{
							$delete_btn_records_html= '<a href="javascript:void(0)" class="sqb_user_question_answer_reset_by_id" data-row-id="'.$row_id.'" data-user-id="'.$user_id.'"  data-quiz-id="'.$quiz_id.'"  data-date="'.$date.'" data-quiz-type="'.$quiz_type.'">Delete Record</a>';
						}
					}
					$questiondata = ' 
							<div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
							 <h4 class="small_heading">Question Answer Details  </h4>							 
								'.$ques_ans_data.'
							</div></div>
						 ';			
					
				}
				
			//}
			$user_custom_fields_data = SQB_UserCustomFields::loadByUserIdQuizIdManageLeadsId($user_id,$quiz_id,$manage_leads_id);
			$custom_user_data = '';
			if(isset($user_custom_fields_data) && !empty($user_custom_fields_data)) {
				$custom_user_data = '<div class="Side_Popup_card_outer">'; 
				
				$i=1;
				
				foreach($user_custom_fields_data as $user_custom_fields){
					
					$fields_name = explode('_',$user_custom_fields->getName());
					$custom_field = $fields_name[1];
					$field_name_obj = SQB_CustomFields::loadByName($custom_field);
					
					$custom_fields_label = '';
					if(isset($field_name_obj)){
					 $custom_fields_label = $field_name_obj->getLabel();
					}
					
					$heading_user_custom_fields_data  = '';
					if($i == 1){
					$heading_user_custom_fields_data = '<h4 class="full_wid small_heading">User Custom fields data </h4> ';
					}
					
					$custom_user_data .= '<div class="Side_Popup_card">
							'.$heading_user_custom_fields_data.'
							<label>'.$custom_fields_label.'&nbsp;</label><p>'.$user_custom_fields->getValue().'</p>
						</div>';
					$i++;
				}
				$custom_user_data.='</div>'; 
			} 
		} 
		
		 
		$userdata = '<div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
				<h4 class="full_wid small_heading">User Details </h4>
				<label>Name:</label>
				<p class="user_name1">'.$name.'</p>
		</div>
		<div class="Side_Popup_card">
				<label >Email:</label>
				<p class="user_email1">'.$email.$delete_btn_records_html.'</p>
		</div>
		'.$course_details.'
		</div>
		'.$custom_user_data.'
		<div class="Side_Popup_card_outer"> 
		<!--div class="Side_Popup_card">
		<label style="margin-top: 10px;">Select a Quiz </label>
		<div class="dropdown dropdown-custom-style dropdown-overflow">
			<button class="dropdown-toggle" type="button" id="share_select_quiz" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="'.@$qid.'">'.$quiz_name.'</button>
			<div class="dropdown-menu share_select_quiz_list" aria-labelledby="SelectQuizNo">
			</div>
		</div>	
		
		</div-->';
		 
		$output = $userdata.$htmldata.$questiondata;
 
	}
	$output = stripslashes($output);
	$output = str_replace('contenteditable="true"','contenteditable="false"',$output); 
	echo json_encode($output);
	die;
}


function getQuestionsTotalInfoByQuizIdByDate($user_id, $quiz_id ,$date,$quiz_type, $quiz_is_frontend = false){
	

	if($quiz_is_frontend == true){

		$sqbQuizData = SQB_Quiz::loadById($quiz_id);
		if(!empty($sqbQuizData)){
			$QuizShowCorrectAnswer = $sqbQuizData->getQuizShowCorrectAnswer();
		}else{
			$QuizShowCorrectAnswer = '';
		}

		$txt_sqb_name = sqbGetValidSettingsByKey('sqb_name');
		if(isset($txt_sqb_name) && $txt_sqb_name != ''){
			
		}else{
			$txt_sqb_name = 'Name';
		}

		$txt_sqb_email = sqbGetValidSettingsByKey('sqb_email');
		if(isset($txt_sqb_email) && $txt_sqb_email != ''){
			
		}else{
			$txt_sqb_email = 'Email';
		}

		$txt_user_email = sqbGetValidSettingsByKey('user_email');
		if(isset($txt_user_email) && $txt_user_email != ''){
			
		}else{
			$txt_user_email = 'User Answer';
		}

		$txt_student_correct_answer = sqbGetValidSettingsByKey('student_correct_answer');
		if(isset($txt_student_correct_answer) && $txt_student_correct_answer != ''){
			
		}else{
			$txt_student_correct_answer = 'Correct Answer';
		}

		$txt_points_scored = sqbGetValidSettingsByKey('points_scored');
		if(isset($txt_points_scored) && $txt_points_scored != ''){
			
		}else{
			$txt_points_scored = 'Points Scored';
		}

		$txt_file_name = sqbGetValidSettingsByKey('file_name');
		if(isset($txt_file_name) && $txt_file_name != ''){
			
		}else{
			$txt_file_name = 'File Name';
		}

		$txt_student_incorrect = sqbGetValidSettingsByKey('student_incorrect');
		if(isset($txt_student_incorrect) && $txt_student_incorrect != ''){
			
		}else{
			$txt_student_incorrect = 'Incorrect';
		}

		$txt_click_to_download = sqbGetValidSettingsByKey('click_to_download');
		if(isset($txt_click_to_download) && $txt_click_to_download != ''){
			
		}else{
			$txt_click_to_download = 'Click to download';
		}

		$txt_file_upload_successfully = sqbGetValidSettingsByKey('file_upload_successfully');
		if(isset($txt_file_upload_successfully) && $txt_file_upload_successfully != ''){
			
		}else{
			$txt_file_upload_successfully = 'File Uploaded Successfully';
		}

		$txt_answer_no_longer = sqbGetValidSettingsByKey('answer_no_longer');
		if(isset($txt_answer_no_longer) && $txt_answer_no_longer != ''){
			
		}else{
			$txt_answer_no_longer = 'This answer is no longer present in the quiz';
		}

		$txt_sqb_weight = sqbGetValidSettingsByKey('sqb_weight');
		if(isset($txt_sqb_weight) && $txt_sqb_weight != ''){
			
		}else{
			$txt_sqb_weight = 'Weight';
		}

		$txt_sqb_height = sqbGetValidSettingsByKey('sqb_height');
		if(isset($txt_sqb_height) && $txt_sqb_height != ''){
			
		}else{
			$txt_sqb_height = 'Height';
		}

		$txt_user_answer = sqbGetValidSettingsByKey('user_answer');
		if(isset($txt_user_answer) && $txt_user_answer != ''){
			
		}else{
			$txt_user_answer = 'Height';
		}

		$student_score = sqbGetValidSettingsByKey('student_score');
		if(isset($student_score) && $student_score != ''){
			
		}else{
			$student_score = 'Score';
		}

		$sqb_total_points = sqbGetValidSettingsByKey('sqb_total_points');
		if(isset($sqb_total_points) && $sqb_total_points != ''){
			
		}else{
			$sqb_total_points = 'Total Points';
		}

	}else{
		$txt_sqb_name = 'Name';
		$txt_sqb_email = 'Email';
		$txt_user_email = 'User Answer';
		$txt_student_correct_answer = 'Correct Answer';
		$txt_points_scored = 'Points Scored';
		$txt_file_name = 'File Name';
		$txt_student_incorrect = 'Incorrect';
		$txt_click_to_download = 'Click to download';
		$txt_file_upload_successfully = 'File Uploaded Successfully';
		$txt_answer_no_longer = 'This answer is no longer present in the quiz';
		$txt_sqb_weight = 'Weight';
		$txt_sqb_height = 'Height';
		$txt_user_answer = 'User Answer';
		$student_score = 'Score';
		$sqb_total_points = 'Total Points';
	}

	$mangeLeadOjb = SQB_ManageLeads::getPeviourDate($user_id, $quiz_id, $date);
	$max_date = $date;
	if(isset($mangeLeadOjb)){
		$min_date = $mangeLeadOjb->getDate();
		
	}else{
		$dt = new DateTime($date);
		$min_date = $dt->format('Y-m-d 0:0:0');		
	}
	
	$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
	
	$total_number_questions = 0;
	$total_points =  0;
	$points_scored =  0;
	$correct_answer_no =  0;
	$html  = '';
	if(isset($sqbloadquestionsobj)){ 
		$total_number_questions = count($sqbloadquestionsobj);
		
		$show_matix_values = false;
		$matrix_answers = array();
		
		foreach($sqbloadquestionsobj as $quet_id => $questions) {
			//if($quiz_type == 'scoring'){
				$total_points  =   $questions->getTotalPoints();
				$points_scored =   $questions->getPointsScored();
				$answer_given =   $questions->getAnswerGiven();
				$question_ids = 	$questions->getQuestionId();
				$added_values = true;
				$question_data = SQB_QuizQuestionBank::loadById($question_ids);
				if($question_data){
				  $matrix_html =  $question_data->getMatrixHtml();
				  if(strpos($matrix_html, 'show_value_matrix_box') !== false) {
					} else {
					$added_values = false;
					}
				}
				if($added_values){
					if (strpos($answer_given, '|') !== false) {
						$show_matix_values = true;
						$matrix_answers[] = $answer_given;
					}
				}
			//}
			
			/* if($quiz_type == 'assessment'){
				 $answer_given =  $questions->getAnswerGiven();
				  $answersdataobj =  SQB_QuizAnswers::loadById($answer_given);	 
				  if($answersdataobj){
					$correct_answer = $answersdataobj->getCorrectAnswer();  
					if($correct_answer == 'true'){
						$correct_answer_no++;				 
					}
				 }		
			} */
			
		}
		
		if ($quiz_is_frontend) {
			$show_matix_values = false;
		}
		if($quiz_type == 'scoring' ){
			
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$student_score.'&nbsp;</label><p>'.$points_scored.' / '.$total_points.'</p>';
			
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$txt_points_scored.'&nbsp;</label><p>'.$points_scored.'</p>';
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$sqb_total_points.'&nbsp;</label><p>'.$total_points.'</p>';
			
		}else if($quiz_type == 'assessment'){
			
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$student_score.'&nbsp;</label><p>'.$points_scored.' / '.$total_points.'</p>';
			
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$txt_points_scored.'&nbsp;</label><p>'.$points_scored.'</p>';
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>'.$sqb_total_points.'&nbsp;</label><p>'.$total_points.'</p>';
			
			/*$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>Score </label><p>'.$points_scored.' / '.$total_number_questions.'</p>';
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>Total Correct Answers  </label><p>'.$correct_answer_no.'</p>';
			$html .= '<h4 class="full_wid small_heading"></h4>';
			$html .= '<label>Total Number of Questions Answered  </label><p>'.$total_number_questions.'</p>';
			*/
		}
		if($show_matix_values){
			
		$matrix_answers_str = implode(',',$matrix_answers);
		$matrix_answers_arr = explode(',',$matrix_answers_str);
		$answer_arr = array();
	/*	foreach($matrix_answers_arr as $key => $val){
			$arrs = explode('|',$val);
			$id = $arrs[0];
			$given_answer_key = $arrs[1];
			$answersdataobj =  SQB_QuizAnswers::loadById($id);
			if(!empty($answersdataobj)){
				$matrix_values = $answersdataobj->getMatrixValues();
				$matrix_values_arr = explode(',',$matrix_values);
				$matrix_values_item = $matrix_values_arr[$given_answer_key];
				$matrix_values_item_value = explode('|',$matrix_values_item);
				$answer_arr[] = (int) $matrix_values_item_value[1];
			}
			
		}
		$sum_matrix_value = array_sum($answer_arr);
		$total_matrix = count($answer_arr);
		$average_of_matrix = round($sum_matrix_value/$total_matrix,2);*/


		foreach($matrix_answers_arr as $key => $val) {
		    $arrs = explode('|', $val);
		    
		    // Check if array has required elements
		    if (count($arrs) < 2) {
		        continue;
		    }
		    
		    $id = $arrs[0];
		    $given_answer_key = $arrs[1];
		    
		    $answersdataobj = SQB_QuizAnswers::loadById($id);
		    if (!empty($answersdataobj)) {
		        $matrix_values = $answersdataobj->getMatrixValues();
		        $matrix_values_arr = explode(',', $matrix_values);
		        
		        // Check if given_answer_key exists in array
		        if (isset($matrix_values_arr[$given_answer_key])) {
		            $matrix_values_item = $matrix_values_arr[$given_answer_key];
		            $matrix_values_item_value = explode('|', $matrix_values_item);
		            
		            // Check if array has the value we need
		            if (isset($matrix_values_item_value[1])) {
		                $answer_arr[] = (int) $matrix_values_item_value[1];
		            }
		        }
		    }
		}

		$sum_matrix_value = array_sum($answer_arr);
		$total_matrix = count($answer_arr);

		// Check for division by zero
		if ($total_matrix > 0) {
		    $average_of_matrix = round($sum_matrix_value / $total_matrix, 2);
		} else {
		    $average_of_matrix = 0; // or any other default value you prefer
		}

		$html .= '<h4 class="full_wid small_heading"></h4>';
		$html .= '<label>Average Matrix Value: <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="max-width:400px;">Add up the total value for the selected matrix options and divide by total number of answers to derive the average. Display on the final outcome screen.</div></div></label><p> &nbsp;'.$average_of_matrix.'</p>';
		$html .= '<h4 class="full_wid small_heading"></h4>';
		$html .= '<label>Total Matrix Value: <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="max-width:400px;">Add up the total value for the selected matrix options and display on the final outcome screen.</div></div></label><p>&nbsp; '.$sum_matrix_value.'</p>';
		
		}
	}
	return $html;
}	

function getQuestionsByQuizIdByDate($user_id, $quiz_id ,$date,$quiz_type,$name){

	$quiz_is_frontend = false;
	if (isset($_REQUEST['is_frontend']) && $_REQUEST['is_frontend'] == true) {
		$quiz_is_frontend = true;
	}

	if (isset($_REQUEST['is_frontend'])) {
		$txt_sqb_question_cust = sqbGetValidSettingsByKey('sqb_question_cust');
		if(isset($txt_sqb_question_cust) && $txt_sqb_question_cust != ''){
			
		}else{
			$txt_sqb_question_cust = 'Question';
		}

		$txt_sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');
		if(isset($txt_sqb_answer_cust) && $txt_sqb_answer_cust != ''){
			
		}else{
			$txt_sqb_answer_cust = 'Answer';
		}
	}else{
		$txt_sqb_question_cust = 'Question';
		$txt_sqb_answer_cust = 'Answer';
	}
	

	$question_data="";
	$resdata ="";
	$finalhtml ="";
	$mangeLeadOjb = SQB_ManageLeads::getPeviourDate($user_id, $quiz_id, $date);
	$max_date = $date;
	if(isset($mangeLeadOjb)){
		$min_date = $mangeLeadOjb->getDate();
		
	}else{
		$dt = new DateTime($date);
		$min_date = $dt->format('Y-m-d 0:0:0');		
	}
	
	//$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdMinAndMaxDate($user_id, $quiz_id,$max_date,$min_date);
	$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
	$sqbQuizData = SQB_Quiz::loadById($user_id, $quiz_id);
	 
	$randval = rand(1,100);	
	
	if(isset($sqbloadquestionsobj)){ 
		$i =1;
		foreach($sqbloadquestionsobj as $quet_id => $questions) {
			//echo "<pre>"; print_r($questions);
			$question_id = $questions->getQuestionId();
			$answer_given = $questions->getAnswerGiven();
			$other_field = $questions->getOtherField();
			$tag_ids = $questions->getAnswerTagIds();
			
			if($answer_given == 0){
				continue ;
			}
			$correct_answer = $questions->getCorrectAnswerId();			 	
			$answer_text = $questions->getAnswerText();			 	
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;			
		 
			if($sqbquestionobj){	
				 			 
				$question = $sqbquestionobj->getQuestionTitle(); 
				$question_type = $sqbquestionobj->getQuestionType(); 
				if($name == 'NULL'){
					$name = "";
				}
				$question = str_replace("%%FIRST%%",$name, $question);
				$question_text = '<div class="ques_contain" id="ques_'.$question_id.'"><b>'.$txt_sqb_question_cust.' '.$i.':</b><label>'.stripslashes($question).'</label></div>';	
				
				$answer_data = getAnswersByQuestionId($question_id, $answer_given,$quiz_type, $answer_text,$question_type,$tag_ids,$other_field,$name,$quiz_id);				 
						
				$finalhtml .='
					<div class="card res_data_cont" id="card_res'.$i.'"> 
						<div class="card-header" id="resheadingOne'.$i.'">
							<a class="" data-toggle="collapse" data-target="#rescollapseOne'.$i.'" aria-expanded="true" aria-controls="rescollapseOne">'.$question_text.'</a>
						</div>
						<div id="rescollapseOne'.$i.'" class="sqb_answer_data sqb_'.$question_type.' sqb_res_collapse collapse show" aria-labelledby="resheadingOne'.$i.'" data-parent="#RES-accordion" style="">
							<div class="card-body">	'.$answer_data.'
							</div>
						</div>			
					</div>	';
							 
			}
			$i++;
		}	
	}
	
  	return $finalhtml;
}


function getQuestionsByQuizId($user_id, $quiz_id){
	$question_data="";
	$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizId($user_id, $quiz_id);
	$sqbQuizData = SQB_Quiz::loadById($user_id, $quiz_id);
	if($sqbQuizData != false){
		$quiz_type = $sqbQuizData->getQuizType();		
	}
	$randval = rand(1,100);	
	
	if(isset($sqbloadquestionsobj)){ 
		$i =1;
		foreach($sqbloadquestionsobj as $quet_id => $questions) {
			$question_id = $questions->getQuestionId();
			$answer_given = $questions->getAnswerGiven();
			$correct_answer = $questions->getCorrectAnswer();			 	
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;			
			
			if(isset($sqbquestionobj)){					 
				$question = $sqbquestionobj->getQuestionTitle(); 

				$question = str_replace("%%FIRST%%",$name, $question);
				$question_text = '<div class="ques_contain"><b>Question '.$i.':</b><label>'.$question.'</label></div>';						
				if($quiz_type != 'assessment'){
					$addclass = " active-item ";
					$ansdata1 = getAnswersById($answer_given, " active-item ");		
					if($ansdata1 == ''){
						$ansdata = '<div class="ans_text1 ">This answer is no longer present in the quiz</div>';
					}else{					 
						$ansdata = '<div class="ans_text1 "> <b>User Answer: </b>'.$ansdata1.'</div>';
					}
				}else if($answer_given == $correct_answer){
					$addclass = " active-item ";
					$ansdata1 = getAnswersById($answer_given, " active-item ");		
					if($ansdata1 == ''){
						$ansdata = '<div class="ans_text1 ">This answer is no longer present in the quiz</div>';
						$resdata = '';
					}else{				 
						$ansdata = '<div class="ans_text1 "><b>Correct Answer: </b>'.$ansdata1.'</div>';
						$resdata = '<div class="result_text"><b>Result: </b><div class="result_inn"> Correct Answer</div></div>';
					}
				}else{
					$addclass = "";
					$ansdata1 = getAnswersById($answer_given , " ");
					$ansdata2 = getAnswersById($correct_answer, " active-item ");	
					//$ansdata = "<b>User's Answer:</b>".$ansdata1."<b>Correct Answer:</b>".$ansdata2;
					if($ansdata1 == '' && $ansdata2 == ''){
						$ansdata = '<div class="ans_text1 ">This answer is no longer present in the quiz</div>';
						$resdata = '';
					}else{
						$ansdata = '<div class="ans_text1 "> <b>User Answer: </b>'.$ansdata1.'</div><div class="ans_text1 "> <b>Correct Answer:</b>'.$ansdata2.'</div>';
						$resdata = '<div class="result_text"><b>Result: </b> <div class="result_inn">Incorrect Answer </div></div>';
					}
				}
				
				$answer_data  = '<div class="export-option-list">'.$ansdata.'</div>';				
				 
				$finalhtml .='
					<div class="card res_data_cont" id="card_res'.$i.'"> 
						<div class="card-header" id="resheadingOne'.$i.'">
							<a class="" data-toggle="collapse" data-target="#rescollapseOne'.$i.'" aria-expanded="true" aria-controls="rescollapseOne">'.$question_text.'</a>
						</div>
						<div id="rescollapseOne'.$i.'" class="sqb_res_collapse collapse show" aria-labelledby="resheadingOne'.$i.'" data-parent="#RES-accordion" style="">
							<div class="card-body">	'.$answer_data.$resdata.'
							</div>
						</div>			
					</div>	';
							 
			}
			$i++;
		}	
	}
	
  	return $finalhtml;
}

function getAnswersByQuestionId($id, $answer_given, $quiz_type, $answer_text, $question_type, $tag_ids, $other_field,$quiz_id = 0){

 	$QuizShowCorrectAnswer = '';
	if (isset($_REQUEST['is_frontend'])) {

		$sqbQuizData = SQB_Quiz::loadById($quiz_id);
		if(!empty($sqbQuizData)){
			$QuizShowCorrectAnswer = $sqbQuizData->getQuizShowCorrectAnswer();
		}else{
			$QuizShowCorrectAnswer = '';
		}

		$txt_sqb_name = sqbGetValidSettingsByKey('sqb_name');
		if(isset($txt_sqb_name) && $txt_sqb_name != ''){
			
		}else{
			$txt_sqb_name = 'Name';
		}

		$txt_sqb_email = sqbGetValidSettingsByKey('sqb_email');
		if(isset($txt_sqb_email) && $txt_sqb_email != ''){
			
		}else{
			$txt_sqb_email = 'Email';
		}

		$txt_user_email = sqbGetValidSettingsByKey('user_email');
		if(isset($txt_user_email) && $txt_user_email != ''){
			
		}else{
			$txt_user_email = 'User Answer';
		}

		$txt_student_correct_answer = sqbGetValidSettingsByKey('student_correct_answer');
		if(isset($txt_student_correct_answer) && $txt_student_correct_answer != ''){
			
		}else{
			$txt_student_correct_answer = 'Correct Answer';
		}

		$txt_points_scored = sqbGetValidSettingsByKey('points_scored');
		if(isset($txt_points_scored) && $txt_points_scored != ''){
			
		}else{
			$txt_points_scored = 'Points Scored';
		}

		$txt_file_name = sqbGetValidSettingsByKey('file_name');
		if(isset($txt_file_name) && $txt_file_name != ''){
			
		}else{
			$txt_file_name = 'File Name';
		}

		$txt_student_incorrect = sqbGetValidSettingsByKey('student_incorrect');
		if(isset($txt_student_incorrect) && $txt_student_incorrect != ''){
			
		}else{
			$txt_student_incorrect = 'Incorrect';
		}

		$txt_click_to_download = sqbGetValidSettingsByKey('click_to_download');
		if(isset($txt_click_to_download) && $txt_click_to_download != ''){
			
		}else{
			$txt_click_to_download = 'Click to download';
		}

		$txt_file_upload_successfully = sqbGetValidSettingsByKey('file_upload_successfully');
		if(isset($txt_file_upload_successfully) && $txt_file_upload_successfully != ''){
			
		}else{
			$txt_file_upload_successfully = 'File Uploaded Successfully';
		}

		$txt_answer_no_longer = sqbGetValidSettingsByKey('answer_no_longer');
		if(isset($txt_answer_no_longer) && $txt_answer_no_longer != ''){
			
		}else{
			$txt_answer_no_longer = 'This answer is no longer present in the quiz';
		}

		$txt_sqb_weight = sqbGetValidSettingsByKey('sqb_weight');
		if(isset($txt_sqb_weight) && $txt_sqb_weight != ''){
			
		}else{
			$txt_sqb_weight = 'Weight';
		}

		$txt_sqb_height = sqbGetValidSettingsByKey('sqb_height');
		if(isset($txt_sqb_height) && $txt_sqb_height != ''){
			
		}else{
			$txt_sqb_height = 'Height';
		}

		$txt_user_answer = sqbGetValidSettingsByKey('user_answer');
		if(isset($txt_user_answer) && $txt_user_answer != ''){
			
		}else{
			$txt_user_answer = 'Height';
		}

		$sqb_result = sqbGetValidSettingsByKey('sqb_result');
		if(isset($sqb_result) && $sqb_result != ''){
			
		}else{
			$sqb_result = 'Result';
		}

	}else{
		$txt_sqb_name = 'Name';
		$txt_sqb_email = 'Email';
		$txt_user_email = 'User Answer';
		$txt_student_correct_answer = 'Correct Answer';
		$txt_points_scored = 'Points Scored';
		$txt_file_name = 'File Name';
		$txt_student_incorrect = 'Incorrect';
		$txt_click_to_download = 'Click to download';
		$txt_file_upload_successfully = 'File Uploaded Successfully';
		$txt_answer_no_longer = 'This answer is no longer present in the quiz';
		$txt_sqb_weight = 'Weight';
		$txt_sqb_height = 'Height';
		$txt_user_answer = 'User Answer';
		$sqb_result = 'Result';
	}

	

	$answer_data=""	;		
	$resdata=""	;	
	$correct_answer_id= 0;	
	$question_id = $id;

	$tag_ids = explode(',',$tag_ids);
	$tag_name = array();
	foreach($tag_ids as $tag_id){
		if($tag_id == ''){
			continue; 
		}
		$tagdataobj =  SQB_Tags::loadById($tag_id);	  
		
		if(!empty($tagdataobj)){
				$tag_name[] = $tagdataobj->getName();  
			}				
	}
	$all_tag = implode(', ',$tag_name);

	if($quiz_type == 'assessment' || $quiz_type == 'scoring'){
		
		$answer_given_ids = explode(',',$answer_given);
		$correct_answer_has = true;
		
		$correct_answer_ids = array();
		
		$answersdataobj =  SQB_QuizAnswers::loadByQuestionId($id);	 
		
		if(isset($answersdataobj)){
			foreach($answersdataobj as $answerdataobj) {
				$correct_answer = $answerdataobj->getCorrectAnswer();  
				if($correct_answer == 'true'){
					$correct_answer_ids[] = $answerdataobj->getId();				 
				}
			}			
		}		
		
		$correct_answer_ids = implode(',',$correct_answer_ids);
		
		
		foreach($answer_given_ids as $answer_given_new){
			if($answer_given_new == ''){
				continue; 
			}
			$answersdataobj =  SQB_QuizAnswers::loadById($answer_given_new);	  
			
			if($answersdataobj){
				
					$correct_answer = $answersdataobj->getCorrectAnswer();  
					if($correct_answer == 'true'){
						$correct_answer_id = $answersdataobj->getId();		
						 
					}else{
						$correct_answer_has = false;		
					}
				}			
				
			
		}	 
		if($question_type == 'matrix'){
			$correct_answer_has = false;
		}
							
		if($correct_answer_has){
			$addclass = " active-item ";
			//$ansdata1 = getAnswersById($answer_given, " active-item ");	
			
			$ansdata1 = getAnswersById($answer_given , " ");
			$ansdata2 = getAnswersById($correct_answer_ids, " active-item ");	
			if($ansdata1 == '' && $ansdata2 == ''){
				$ansdata = '<div class="ans_text1 ">'.$txt_answer_no_longer.'</div>';
				$resdata = '';
			}else{
			 	if($other_field){
					$other_field_data = '<p class="manage-lead-other-field">'.$other_field.'</p>';
				}else{
					$other_field_data = '';
				} 
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$ansdata1.$other_field_data.'</div><div class="ans_text1 "><b>'.$txt_student_correct_answer.':&nbsp;</b>'.$ansdata2.'</div>';
				$resdata = '<div class="result_text"><b>'.$sqb_result.': </b><div class="result_inn" style="font-weight:bold;color:#62c47d !important"> '.$txt_student_correct_answer.' </div></div>'; 
			}
			if($quiz_type == 'scoring'){
				
				  $answer_given_array = explode(',',$answer_given);
			 
					$answer_points = 0;	 
					foreach($answer_given_array as $answer_given_new){	
						if($answer_given_new == ''){
							continue; 
						}
					  $answersdataobj =  SQB_QuizAnswers::loadById($answer_given_new);
					
					  if($answersdataobj){
							$answer_points += $answersdataobj->getAnswerPoints();  
					  }
					}
				if($ansdata1 == '' && $ansdata2 == ''){
					$resdata .= '';
				}else{	
					$resdata .= '<br><div class="result_text"><b>'.$txt_points_scored.': </b><div class="result_inn"> '.$answer_points.' </div></div>'; 
				}
			}
			
			
		}else{
			$addclass = "";
			$ansdata1 = getAnswersById($answer_given , " ",$question_type,$question_id);
			$ansdata2 = getAnswersById($correct_answer_ids, " active-item ",$question_type,$question_id);	
		
			if($question_type == 'text'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'email'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'date'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'slider'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'phone_number'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'numerical_text'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'matching_text'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($question_type == 'file_upload'){
				$filepathinfo = pathinfo($answer_text);
				$filename = $filepathinfo['filename'].'.'.$filepathinfo['extension'];
				$ansdata = '<div class="ans_text1 ">File Uploaded Successfully</div>
				<div class="ans_text1 "><b>File Name:&nbsp;</b>'.$filename.'</div>
				<div class="ans_text1 "><a class="at-download-image" download href="'.$answer_text.'">Click to download</a></div>';
			
			}else if($question_type == 'matrix'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$ansdata1.'</div>';
				$resdata = '';
			}else if($question_type == 'dropdown'){
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$answer_text.'</div>';
			}else if($ansdata1 == '' && $ansdata2 == ''){
				$ansdata = '<div class="ans_text1 ">This answer is no longer present in the quiz</div>';
				$resdata = '';
			}else{
				if($other_field){
					$other_field_data = '<p class="manage-lead-other-field">'.$other_field.'</p>';
				}else{
					$other_field_data = '';
				} 
				$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$ansdata1.$other_field_data.'</div><div class="ans_text1 "> <b>'.$txt_student_correct_answer.':&nbsp;</b>'.$ansdata2.'</div>';

				if($QuizShowCorrectAnswer == 'Y'){
					$resdata = '<div class="result_text"><b>Result2: </b> <div class="result_inn" style="font-weight:bold;color:#f74169 !important">'.$txt_student_correct_answer.'  </div></div>';
				}
			}
			
			if($quiz_type == 'scoring'){
				
				  $answer_given_array = explode(',',$answer_given);
			 
					$answer_points = 0;	 
					foreach($answer_given_array as $answer_given_new){	
						if($answer_given_new == ''){
							continue; 
						}
					  $answersdataobj =  SQB_QuizAnswers::loadById($answer_given_new);
					
					  if($answersdataobj){
							$answer_points += $answersdataobj->getAnswerPoints();  
					  }
					}
				if($ansdata1 == '' && $ansdata2 == ''){
					$resdata .= '';
				}else{
					$resdata .= '<br><div class="result_text"><b>'.$txt_points_scored.': </b><div class="result_inn"> '.$answer_points.' </div></div>';
				}	
				 
			}
		}
	}else if($quiz_type == 'survey'){
		$addclass = " active-item ";		
		$ansdata1 = getAnswersById($answer_given, " active-item ",$question_type,$question_id);		
		if($question_type == 'text'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'email'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'date'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'slider'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'numerical_text'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'phone_number'){
				$ansdata1 = $answer_text;	
		}else if($question_type == 'matching_text'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'fill_in_blank'){
				$ansdata1 = $answer_text;
		}else if($question_type == 'file_upload'){
			$filepathinfo = pathinfo($answer_text);
			$filename = $filepathinfo['filename'].'.'.$filepathinfo['extension'];
			$ansdata1 = '<div class="ans_text1 ">'.$txt_file_upload_successfully.'</div>
			<div class="ans_text1 "><b>File Name:&nbsp;</b>'.$filename.'</div>
			<div class="ans_text1 "><a class="at-download-image" download href="'.$answer_text.'">'.$txt_click_to_download.'</a></div>';
			
		}else if($question_type == 'matrix'){
			$ansdata1 = $ansdata1;
		}else if($question_type == 'dropdown'){
			$ansdata1 = $answer_text;
		}else if($ansdata1 == ''){
			$ansdata1 = '<div class="ans_text1 ">'.$txt_answer_no_longer.'</div>';
		}		

		if($other_field){
			$other_field_data = '<p class="manage-lead-other-field">'.$other_field.'</p>';
		}else{
			$other_field_data = '';
		} 
		$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$ansdata1.$other_field_data.'</div>';
		$resdata ="";
	}else{
		$addclass = " active-item ";
		$ansdata1 = getAnswersById($answer_given, " active-item ", $question_type,$question_id);	
		if($question_type == 'text'){
			$ansdata1 = $answer_text;	
		}else if($question_type == 'email'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'name'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'date'){
			$ansdata1 = $answer_text;	
		}else if($question_type == 'slider'){
			$ansdata1 = $answer_text;	
		}else if($question_type == 'phone_number'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'numerical_text'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'matching_text'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'file_upload'){
			$filepathinfo = pathinfo($answer_text);
			$filename = $filepathinfo['filename'].'.'.$filepathinfo['extension'];
			$ansdata1 = '<div class="ans_text1 ">'.$txt_file_upload_successfully.'</div>
			<div class="ans_text1 "><b>File Name:&nbsp;</b>'.$filename.'</div>
			<div class="ans_text1 "><a class="at-download-image" download href="'.$answer_text.'">'.$txt_click_to_download.'</a></div>';
		}else if($question_type == 'matrix'){
			$ansdata1 = $ansdata1;
		}else if($question_type == 'dropdown'){
			$ansdata1 = $answer_text;
		}else if($question_type == 'weight_and_height'){
			$explode_ans = explode(',', $answer_text);
			if($explode_ans[1] > 12){
				$ans_divide = $explode_ans[1] / 12;
				$ans_divide = round($ans_divide,1);
			}else{
				$ans_divide = $explode_ans[1];
			}
			$ansdata1 = '<div class="ans_text1">'.$txt_sqb_weight.': '.$explode_ans[0].' <br> '.$txt_sqb_height.': '.$ans_divide.' </div>';
		}else if($ansdata1 == ''){
			$ansdata1 = '<div class="ans_text1">'.$txt_answer_no_longer.'</div>';
		}			
		if($other_field){
			$other_field_data = '<p class="manage-lead-other-field">'.$other_field.'</p>';
		}else{
			$other_field_data = '';
		} 
		$ansdata = '<div class="ans_text1 "> <b>'.$txt_user_answer.':&nbsp;</b>'.$ansdata1.$other_field_data.'</div>';
		$resdata ="";
	}
	
	if($all_tag){
		if(isset($_REQUEST['is_frontend'])){
			$show_tag = '';
		}else{
			$show_tag = '<div class="ans_text1"><b>Answer Tags:&nbsp;</b> <p>'.$all_tag.'</p></div>';
		}
	}else{
		$show_tag = '';
	}
	$answer_data  = '<div class="export-option-list">'.stripslashes($ansdata).' '.$show_tag.'</div>';	
	
	return $answer_data.$resdata;
}

function getAnswersById($id, $addclass, $question_type='',$question_id=''){

	if (isset($_REQUEST['is_frontend'])) {
	
		$txt_sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');
		if(isset($txt_sqb_answer_cust) && $txt_sqb_answer_cust != ''){
			
		}else{
			$txt_sqb_answer_cust = 'Answer';
		}
	}else{
		$txt_sqb_answer_cust = 'Answer';
	}

	$ans_data="";
	if($id != 0){
		
		$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;	
		$matrix_label_text_arr = '';		
		if($sqbquestionobj){	 			 
			$matrix_label_text = $sqbquestionobj->getMatrixLabelText();
			$matrix_label_text_arr = explode(',',$matrix_label_text);
		} else {
			$matrix_label_text_arr = '';
		}
		
		$answer_given_array = explode(',',$id);
		//$answer_given_array_key = explode('|',$answer_given_array);
		$ansdata1 = '';	
		$i = 1;
		
		
		foreach($answer_given_array as $id){
			if($id == ''){
				continue; 
			}
			$answer_given_array_key = explode('|',$answer_given_array[$i-1]);	
			$answersdataobj =  SQB_QuizAnswers::loadById($id);	  
			
			//$ans_data =  'No Title';
			if(isset($answersdataobj) && $answersdataobj != false){		 	
				$answer = $answersdataobj->getAnswerTitle();			 		
				if($question_type == 'matrix' && $answersdataobj->getMatrixValues() != ''){
					$matrix_values = $answersdataobj->getMatrixValues();
					$matrix_values_arr = explode(',',$matrix_values);
					$matrix_values_item = $matrix_values_arr[$answer_given_array_key[1]];
					$matrix_values_item_value = explode('|',$matrix_values_item);
					
					$matrix_label_text = explode('|',$matrix_label_text_arr[$matrix_values_item_value[0]]);
					$final_matrix_label_text = urldecode(strip_tags($matrix_label_text[1]));
					$final_matrix_label_text = str_replace('contenteditable="true"','contenteditable="false"',$final_matrix_label_text); 
					
					$ans_data .=  '<div class="sqb_matrix_reports"><br><hr class="d-block mt-3 mb-3"><b>'.$txt_sqb_answer_cust.':</b> &nbsp;'.strip_tags($answer);
					$ans_data .=  '<br><span class="sqb_matrix_user_selection">User Selection</span>';
					$ans_data .=  '<b>Option:</b> &nbsp; '.stripslashes(strip_tags($final_matrix_label_text));
					$ans_data .=  '<br><b>Value Assigned:</b> &nbsp;'.$matrix_values_item_value[1].'</div>';
					$i++;
					
				} else {
					if(count($answer_given_array) > 1){
						$ans_data .=  '<br>'.$i++.')&nbsp;'.$answer;
					}else{
						$ans_data =  $answer;
					}
				}				
			}
		}//foreach loop closed	
		
	}
	
	return $ans_data;
}

add_action('wp_ajax_sqbGetLessons', 'sqbGetLessons');
 /***  get units  ********/
function sqbGetLessons(){
 
	$_REQUEST = stripslashes_deep( $_REQUEST ); 
	$courseid = $_REQUEST['courseid']; 
	
	$lldocroot = defined( 'SITEROOT' ) ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
	if ( file_exists( $lldocroot . "/dap/dap-config.php" ) )
	include_once ($lldocroot . "/dap/dap-config.php");
	$units = Dap_Product::displayFileResourcesWithCourseId($courseid);	 	 
	
	$output = array();
	$html = '';
	if ( isset( $units ) ) {	 
		foreach ( $units as $unit ) {
			if($unit['name'] ==""){
				$uname = $unit['url'];
			}else{
				$uname = $unit['name'];
			}
			
			$html .='<li>
									<span class="checkbox-custom-style">
									<input type="checkbox"  value="'.$unit['id'].'"  class="mutliSelect all_productslist custom-checkbox-input">
									<span class="custom--checkbox"></span>
								</span>
							
							'.$uname.'</li>';
	    }
	    //$html ='<option value="0">Select</option>'.$html;  
	}  
	
    $output["html"] =  $html;
	echo json_encode($output);
	die; 
}
 

add_action('wp_ajax_sqb_save_dap_integration', 'sqb_save_dap_integration');
 /***  get units  ********/
function sqb_save_dap_integration(){
 
	$_REQUEST = stripslashes_deep( $_REQUEST ); 
	$id = $_REQUEST['id']; 
	$course_id = $_REQUEST['course_id']; 
	$resource_id = $_REQUEST['resource_id']; 
	$quiz_id = $_REQUEST['quiz_id']; 
	$blocking = $_REQUEST['blocking']; 
	$blocking_rule = $_REQUEST['blocking_rule']; 
	$blocking_rule_value = $_REQUEST['blocking_rule_value']; 
	$show_markascomplate = $_REQUEST['show_markascomplate']; 	 
	
	$lldocroot = defined( 'SITEROOT' ) ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
	if ( file_exists( $lldocroot . "/dap/dap-config.php" ) )
	include_once ($lldocroot . "/dap/dap-config.php");
		
	$obj_exists = Dap_CourseLessonQuiz::loadById($id);	
	$sqbData = new Dap_CourseLessonQuiz();	
 
	$sqbData->setCourseId($course_id); 
	$sqbData->setResourceId($resource_id);
	$sqbData->setQuizId($quiz_id);
	$sqbData->setBlocking($blocking);
	$sqbData->setBlockingRule($blocking_rule);
	$sqbData->setBlockingRuleValue($blocking_rule_value);
	$sqbData->setShowMarkAsComplate($show_markascomplate);
	if($obj_exists){
		$sqbData->setId($obj_exists->getId());
		$sqbData->update();
		$output['data_action'] = 'update';
		$output['id'] = $obj_exists->getId();
	}else{
		$output['id'] = $sqbData->create();
		$output['data_action'] = 'create';
	}
	echo json_encode($output);
	die;
}
  
  
/********fb tracking functions start***************/  


function  sqbFbTrackData($quiz_id , $question_id, $answer_id , $event_name, $track_type, $outcome_id = 0){
	$name = 'facebook';
	$key = 'fb_tracking_id';
	$fbAppIdDetails = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
	
	
	if($fbAppIdDetails == false){ 
		/*fb app id is not set, so return */
		return;	
	}
	
	$quizTrackData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id , $event_name, $track_type, $question_id, $answer_id,$outcome_id);
	
	if(isset($quizTrackData) && $quizTrackData != false){ /***tracking is enabled****/
		$fbAppId = $fbAppIdDetails->getValue();
		$event_name = $quizTrackData->getEventName();
		$tag = $quizTrackData->getTag();
		$value = $quizTrackData->getValue();
		$action_name = $quizTrackData->getCustomActionName();
		$status = $quizTrackData->getStatus();
		$event_name_new = str_replace(' ', '_', $event_name);
		$tag_array = array();
		if(($quiz_id != 0) && ($quiz_id != '')){
			$tag_array['quiz_id']=  $quiz_id;
			$quiz_obj = SQB_Quiz::loadById($quiz_id);
			if($quiz_obj){
				$quiz_name = $quiz_obj->getQuizName();
				$tag_array['quiz_name'] = $quiz_name;
				if(($question_id != 0) && ($question_id != '')){
					$question_obj =  SQB_QuizQuestionBank::loadById($question_id);
					if($question_obj){
						$question_title = $question_obj->getQuestionTitle();
						$tag_array['question_title'] = $question_title;
					}
				}
				
				if(($answer_id != 0) && ($answer_id != '')){
					$answer_obj =  SQB_QuizAnswers::loadById($answer_id);
					if($answer_obj){
						$answer_title = $answer_obj->getAnswerTitle();
						$tag_array['answer_title'] = $answer_title;
					}
				}
				if(($outcome_id != 0) && ($outcome_id != '')){ 
					$outcome_obj =  SQB_Outcome::loadById($outcome_id);
					if($outcome_obj){
						$outcome_name = $outcome_obj->getOutcomeName();
						$tag_array['outcome_name'] = $outcome_name;
					}
				}
				
				
				
			}
			
		}
		
		$tags['tag']=  $tag;
		$tags = json_encode(array_values($tag_array));
		
		return array('fbAppId' => $fbAppId , 'event_name' => $event_name, 'tag' => $tag, 'value' => $value, 'action_name' => $action_name, 'event_name_new' => $event_name_new,'tags'=>$tags,'status' => $status);
				 
	}else{
		//tracking for this event is not set, return by doing nothing	
		return;
	}
}
/********fb tracking functions end***************/  
 



/*
 * save settings  in database
*/ 

function sqbSetValidSettings($key = '',$value = '' ){
	
	if($key != '' && $value != ''){  
		
		$obj  = new  SQB_QuizSettings();
		$obj->setKey($key);
		$obj->setValue($value);
		$obj->setLastUpdated(date('Y-m-d H:m:s'));
		
		return $obj->update();
	}	
	
}

function sqbGetValidSettingsByKey($key){
	
	 return SQB_QuizSettings::loadByKey($key);
	
}

function sqbDeleteValidSettingsByKey($key){
	
	 return SQB_QuizSettings::deleteByKey($key);
	
}


 


function sqb_check_dap_exists(){
	
	$lldocroot = defined( 'SITEROOT' ) ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
	if ( file_exists( $lldocroot . "/dap/dap-config.php" ) ){
		include_once ($lldocroot . "/dap/dap-config.php");
		return true;
	}
	return false;
}


function SQBgetActiveCampaignCustomFields($url , $key){
	$url = $url;
	$api_key = $key;
	
	$params = array(
		'api_key'      => $api_key,
		
	);

	$query = "";
	foreach( $params as $key => $value ) $query .= urlencode($key) . '=' . urlencode($value) . '&';
	$query = rtrim($query, '& ');
	
	$url = rtrim($url, '/ ');

	if ( !function_exists('curl_init') ) die('CURL not supported. (introduced in PHP 4.0.2)');

	if ( isset($params['api_output'])) {
		if ( $params['api_output'] == 'json' && !function_exists('json_decode') ) {
			die('JSON not supported. (introduced in PHP 5.2.0)');
		}
	}

	$api = $url . '/api/3/fields?' . $query;

	$request = curl_init($api); 
	curl_setopt($request, CURLOPT_HEADER, 0); 
	curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);
	$response = (string)curl_exec($request);
	
	curl_close($request); 

	if ( !$response ) {
		return;
	}
	else{

		//$result = unserialize($response);

		/* Unsetting extra data from array so that only list of lists is returned */
		//unset($result['result_code']);
		//unset($result['result_message']);
		//unset($result['result_output']);
	}
	return $response;
}

function getQuizRetakeCountByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type){
	$mangeLeadOjb = SQB_ManageLeads::getRetakeCount($user_id, $quiz_id, $date);
	return $mangeLeadOjb;
}
function getQuizTimeSpentByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type){
	$mangeLeadOjb = SQB_ManageLeads::getTimeSpentData($user_id, $quiz_id, $date);
	return $mangeLeadOjb;
}


function getGDPRLists(){
	global $wpdb;
	$sqb_table_gdpr = SQB_GDPR::load();
	return $sqb_table_gdpr;
}

function SQBCategoryResultDetailsPerHtml($category_result_list_array, $action_type = '', $quiz_type = '', $eachcat_ids=array()){

	$cat_html = '';
	$total_text = 'Total: ';
	
	if($quiz_type == 'scoring'){
		$total_text = sqbGetValidSettingsByKey('category_scoring_text1');
		if(!isset($total_text) || ($total_text == '')){
			$total_text = 'Total Score: ';
		}
	} else if($quiz_type == 'assessment'){
		$total_text = sqbGetValidSettingsByKey('category_assessment_text1');
		if(!isset($total_text) || ($total_text == '')){
			$total_text = 'Total Correct Answers: ';
		}
	}

	// Check if 'eachcat_ids' is set and is an array

		// Generate the HTML
		if(is_array($category_result_list_array)){
			foreach($category_result_list_array as $cat_id => $cat_val){
				$cat_obj = SQB_QuizCategory::loadById($cat_id);
				if(isset($cat_obj)){
					$cat_name = $cat_obj->getName();
					$cat_score = $cat_val;
					$cat_total = (int)$eachcat_ids[$cat_id];
					$cat_percentage = ($cat_total > 0) ? round(($cat_score / $cat_total) * 100, 2) : 0;

					if($action_type == 'in_popup'){
						$cat_html .= '<div class="cat-details-row"><label><b>'.$cat_name.'</b> : </label><span>'.$cat_percentage.'%  ('.$cat_score.'/'.$cat_total.')</span></div>';
					} else {
						$cat_html .= '<p style="margin:0"><b>'.$cat_name.'</b>: '.$cat_percentage.'%  ('.$cat_score.'/'.$cat_total.')</p>';
					}
				}
			}
		}

		if(array_sum($eachcat_ids) > 0){
			$total_percentage = 100; // Since it's the total, it's always 100%
			if($action_type == 'in_popup'){
				$cat_html = '<div class="cat-details-row cat-details-total"><label><b>'.$total_text.'</b></label><span>'.$total_percentage.'% ('.$cat_total.'/'.$cat_total.')</span></div>'.$cat_html;
			} else {	
				$cat_html = '<p style="margin:0; border-bottom: 1px dashed #000; padding-bottom: 5px;"><strong>'.$total_text.'</strong>: '.$total_percentage.'% ('.$cat_total.'/'.$cat_total.')</p>'.$cat_html;
			}
		} else {
			$cat_html = '';
		}
	

	if(($cat_html != '') && ($action_type == 'in_popup')){
		$cat_html = '
			<div class="Side_Popup_card_outer"> 
				<div class="Side_Popup_card">
					<h4 class="full_wid small_heading">Quiz Category Result </h4> 
					<div class="sqb_category_details">
						'.$cat_html.'
					</div>
				</div>
			</div>';	
	}

	return $cat_html;
}


 
function SQBCategoryResultDetailsHtml($category_result_list_array, $action_type = '', $quiz_type = ''){

	$cat_total = 0;
	$cat_html = '';
	$total_text = 'Total: ';
	if($quiz_type == 'scoring'){
		$total_text = sqbGetValidSettingsByKey('category_scoring_text1');
		if(!isset($total_text) || ($total_text == '')){
			$total_text = 'Total Score: ';
		}

	}else if($quiz_type == 'assessment'){
		$total_text = sqbGetValidSettingsByKey('category_assessment_text1');
		if(!isset($total_text) || ($total_text == '')){
			$total_text = 'Total Correct Answers: ';
		}
	}
	if(is_array($category_result_list_array)){
			foreach($category_result_list_array as $cat_id=>$cat_val){
				$cat_obj = SQB_QuizCategory::loadById($cat_id);
				if(isset($cat_obj)){
					$cat_obj->getName();
					$cat_total = $cat_total + (int)$cat_val;
					if($action_type == 'in_popup'){
						$cat_html .= '<div class="cat-details-row"><label>'.$cat_obj->getName().': </label><span>'.$cat_val.'</span></div>';
						
					
					}else{
						$cat_html .= '<p style="margin:0">'.$cat_obj->getName().': '.$cat_val.'</p> ';
					}
				}
			} 
			if($cat_total > 0){
				if($action_type == 'in_popup'){
					$cat_html = '<div class="cat-details-row cat-details-total"><label>'.$total_text.'</label><span>'.$cat_total.'</span></div>'.$cat_html;
					
				}else{	
					$cat_html = '<p style="  margin: 0 0 5px 0;    border-bottom: 1px dashed #000;    width: 180px;    padding-bottom: 5px;"><strong>'.$total_text.'</strong>: '.$cat_total.'</p>'.$cat_html;				}
			}else{
				$cat_html = '';
			}
		}
		if(($cat_html != '') && ($action_type == 'in_popup')){
				$cat_html = '
							<div class="Side_Popup_card_outer"> 
							<div class="Side_Popup_card">
								<h4 class="full_wid small_heading">Quiz Category Result </h4> 
								<div class="sqb_category_details">
								'.$cat_html.'
								</div>
							</div>
							</div>';	
					}
	 return $cat_html;
}


function SQBQuestionsPaginationHtml($quiz_id = 0, $selected_page_id = 0, $add_new_question_fe_call = 'N' , $clone_existing_question_call_var = 'N', $last_page_selected = 'N'){
	
	global $sqb_add_question_pagination_limit;
	$html = '';
	if($quiz_id == 0){
		return $html; 
	}
	$get_count = 0;
	$questionsArray = array();
	$questionsArray = SQB_QuizQuestions::getQuestionsCountByQuizId($quiz_id);
	if(is_array($questionsArray) && count($questionsArray)){
		$questionsArray_count = count($questionsArray); 
		$get_count =  $questionsArray_count/$sqb_add_question_pagination_limit; 
		if(is_float($get_count)){
			$get_count = (int)$get_count+1;
		}else{
			$get_count = $get_count;
			 if($add_new_question_fe_call == 'Y'){
				$get_count = $get_count+1;
				
			}
			if($clone_existing_question_call_var == 'Y'){
				$get_count = $get_count+1;
			}
		}
	}
    if($add_new_question_fe_call == 'Y'){
				
		$selected_page_id = $selected_page_id+1;
	}
	
	if( $last_page_selected == 'Y'){
		$selected_page_id = $get_count;
	}
	
	if(is_array($questionsArray) && count($questionsArray)){
		$html  = '<span class="select-question-dropdown">Select Question</span>';
		$html .= '<select class="selected-question" style="min-width:80px;">';
					for($x = 1; $x <= $get_count; $x++){
						$start_ind = 1;
						$end_ind = $sqb_add_question_pagination_limit;
						if($x != 1){
						   $start_ind = (($x-1)*$sqb_add_question_pagination_limit)+1;
						   $end_ind = $x*$sqb_add_question_pagination_limit;
						}
						$selected_page = '';
						if($selected_page_id == $x){
							$selected_page = 'selected';
						}
						$html .= '<option '.$selected_page.' data-page-selected_page_id="'.$selected_page_id.'" data-page="'.$x.'" value="'.$x.'">'.$start_ind.'-'.$end_ind.'</option>';
					} 
											
		$html .= '</select>';
							 
	}
	return $html;
}

function SQBQuestionsPaginationArray($quiz_id = 0, $selected_page_id = 0, $add_new_question_fe_call = 'N' , $clone_existing_question_call_var = 'N', $last_page_selected = 'N'){
	
	global $sqb_add_question_pagination_limit;
	$html = '';
	if($quiz_id == 0){
		return $html; 
	}
	$get_count = 0;
	$questionsArray = array();
	$questionsArray = SQB_QuizQuestions::loadByQuizId($quiz_id);
	if(is_array($questionsArray) && count($questionsArray)){
		$questionsArray_count = count($questionsArray); 
		$get_count =  $questionsArray_count/$sqb_add_question_pagination_limit; 
		if(is_float($get_count)){
			$get_count = (int)$get_count+1;
		}else{
			$get_count = $get_count;
			 if($add_new_question_fe_call == 'Y'){
				$get_count = $get_count+1;
				
			}
			if($clone_existing_question_call_var == 'Y'){
				$get_count = $get_count+1;
			}
			
			if( $last_page_selected == 'Y'){
				$get_count = $get_count+1;
			}
		}
	}
    if($add_new_question_fe_call == 'Y'){
				
		$selected_page_id = $selected_page_id+1;
	}
	
	if( $last_page_selected == 'Y'){
		$selected_page_id = $get_count;
	}
	
	if(is_array($questionsArray) && count($questionsArray)){
		$html  = '<span class="select-question-dropdown">Select Question </span>';
		$html .= '<select class="selected-question" style="min-width:80px;">';
					for($x = 1; $x <= $get_count; $x++){
						$start_ind = 1;
						$end_ind = $sqb_add_question_pagination_limit;
						if($x != 1){
						   $start_ind = (($x-1)*$sqb_add_question_pagination_limit)+1;
						   $end_ind = $x*$sqb_add_question_pagination_limit;
						}
						$selected_page = '';
						if($selected_page_id == $x){
							$selected_page = 'selected';
						}
						$html .= '<option '.$selected_page.' data-page-selected_page_id="'.$selected_page_id.'" data-page="'.$x.'" value="'.$x.'">'.$start_ind.'-'.$end_ind.'</option>';
					} 
											
		$html .= '</select>';
							 
	}
	return $output= array('html'=>$html,'selected_page_id'=>$selected_page_id);
}


function SQBOutcomePaginationArray($quiz_id = 0, $oc_selected_page_id = 0, $add_new_outcome_fe_call = 'N' , $clone_existing_question_call_var = 'N', $oc_last_page_selected = 'N'){
	
	global $sqb_add_outcome_pagination_limit;
	$html = '';
	if($quiz_id == 0){
		return $html; 
	}
	$get_count = 0;
	$outcomeArray = array();
	$outcomeArray = SQB_Outcome::loadByQuizId($quiz_id);
	if(is_array($outcomeArray) && count($outcomeArray)){
		$outcomeArray_count = count($outcomeArray); 
		$get_count =  $outcomeArray_count/$sqb_add_outcome_pagination_limit; 
		if(is_float($get_count)){
			$get_count = (int)$get_count+1;
		}else{
			$get_count = $get_count;
			 if($add_new_outcome_fe_call == 'Y'){
				$get_count = $get_count+1;
				
			}
			if($clone_existing_question_call_var == 'Y'){
				$get_count = $get_count+1;
			}
			
			if( $oc_last_page_selected == 'Y'){
				$get_count = $get_count+1;
			}
		}
	}
    if($add_new_outcome_fe_call == 'Y'){
				
		$oc_selected_page_id = $oc_selected_page_id+1;
	}
	
	if( $oc_last_page_selected == 'Y'){
		$oc_selected_page_id = $get_count;
	}
	
	if(is_array($outcomeArray) && count($outcomeArray)){
		$html  = '<span class="select-outcome-dropdown"><b>Select</b> </span>';
		$html .= '<select class="selected-outcome" style="min-width:100px;">';
					for($x = 1; $x <= $get_count; $x++){
						$start_ind = 1;
						$end_ind = $sqb_add_outcome_pagination_limit;
						if($x != 1){
						   $start_ind = (($x-1)*$sqb_add_outcome_pagination_limit)+1;
						   $end_ind = $x*$sqb_add_outcome_pagination_limit;
						}
						$selected_page = '';
						if($oc_selected_page_id == $x){
							$selected_page = 'selected';
						}
						$html .= '<option '.$selected_page.' data-page-oc_selected_page_id="'.$oc_selected_page_id.'" data-page="'.$x.'" value="'.$x.'">'.$start_ind.'-'.$end_ind.'</option>';
					} 
											
		$html .= '</select>';
							 
	}
	return $output= array('html'=>$html,'oc_selected_page_id'=>$oc_selected_page_id);
}


function SQBGetTagsNameByIds($answer_tag_ids = ''){
	
	$answer_tags_text_array = array();
	if($answer_tag_ids != ''){
		$tags_array = SQB_Tags::loadByIdIndex();
		if(is_array($tags_array) && count($tags_array)){
			$answer_tags_arr = explode(',', $answer_tag_ids);
			if(is_array($answer_tags_arr) && count($answer_tags_arr)){
				foreach($answer_tags_arr as $answer_id){
					if(isset($tags_array[$answer_id])){
						$answer_tags_text_array[] = $tags_array[$answer_id]->getName();
					}
				}
			}
		}
	}
	return $answer_tags_text_array;
	
}  

function SQBGetTagsContentByShortcode($answer_tags_ids,$results,$tag_name){


    
    $cleanedArray = [];

    if(!empty($answer_tags_ids)){

        foreach ($answer_tags_ids as $value) {
           
            $explode = explode(',',$value);
            if(!empty($explode)){
                foreach($explode as $ex){
                    if(!empty($ex) && $ex != 'NULL'){
                        $cleanedArray[] = $ex;
                    }
                }
            }
            
        }
    }

    if(!empty($cleanedArray)) {
        // Convert all values to integers
        $answer_tags_ids = array_unique($cleanedArray);
    }
    
	foreach($answer_tags_ids as $answer_tag_id){
		$tags_array = SQB_Tags::loadById($answer_tag_id);
		if(!empty($tags_array)){
			$tags_html = stripslashes($tags_array->getContent());
			$results = str_replace('[showtaggcontent id="'.$answer_tag_id.'"]',$tags_html,$results);
		}
	}

	if($tag_name != ''){
		$tags_obj = SQB_Tags::loadTagContentWithTagNames($tag_name);
		if(!empty($tags_obj)){
			$tags_html = stripslashes($tags_obj->getContent());
			$results = str_replace('[showtaggcontent id="'.$tags_obj->getId().'"]',$tags_html,$results);
		}
	}

	$results = preg_replace('/\[showtaggcontent.*?\]/', '', $results);

	return $results;
}

function SQBGetTagsContentByIds($answer_tag_array = array(),$tag_name=''){
	$tags_html = '';



	foreach($answer_tag_array as $answer_tag_id){
		$tags_array = SQB_Tags::loadById($answer_tag_id);
		if(!empty($tags_array)){
		$tags_html .= stripslashes($tags_array->getContent());
		}
	}
	if($tag_name != ''){
		$tags_obj = SQB_Tags::loadTagContentWithTagNames($tag_name);
		if(!empty($tags_obj)){
		$tags_html .= stripslashes($tags_obj->getContent());
		}
	}
	return $tags_html;
}  

function SQBGetOutcomeTagsName($outcome_id){
	$outcome_object = SQB_Outcome::loadById($outcome_id);
	if(!empty($outcome_object)){
		$tag_name = $outcome_object->getTag();
	}else{
		$tag_name = '';
	}
	return $tag_name;
}

function sqb_get_date($date,$format = 'Y-m-d H:i:s'){
	return get_date_from_gmt( $date, $format );
}

function sqb_get_date_fl($date,$format = 'Y-m-d H:i:s'){
	return !empty($date) ? get_gmt_from_date( $date, $format ) : '';
}

function sqb_get_array_value($array,$key,$default = ''){

	if(isset($array[$key])){
		return $array[$key];
	}

	return $default;
}

function sqb_get_questions_with_cat_mapping($quiz_id) {
    global $wpdb;
    
    // SQL query to get the question title, question ID, and category ID for a specific quiz_id
    $results = $wpdb->get_results(
	    $wpdb->prepare(
	        "
	        SELECT 
	            q.question_id, 
	            qb.question_title, 
	            qb.category_id 
	        FROM 
	            {$wpdb->prefix}sqb_quiz_questions q
	        INNER JOIN 
	            {$wpdb->prefix}sqb_quiz_question_bank qb
	        ON 
	            q.question_id = qb.id
	        WHERE 
	            q.quiz_id = %d
	        ",
	        $quiz_id
	    )
	);

    // Initialize an empty array to store the result by category
    $category_data = array();

    // Loop through the results and organize questions by category_id
    if (!empty($results)) {
        foreach ($results as $row) {
            // Handle cases where category_id is empty or 0
            $category_id = !empty($row->category_id) ? $row->category_id : 0;

            // Ensure the category_id exists in the array before adding questions
            if (!isset($category_data[$category_id])) {
                $category_data[$category_id] = array(
                    'category_id' => $category_id,
                    'questions' => array()
                );
            }

            // Add the question to the respective category's questions array
            $category_data[$category_id]['questions'][] = array(
                'question_title' => $row->question_title,
                'question_id'    => $row->question_id,
            );
        }
    }

    return $category_data;
}
