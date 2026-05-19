<?php 

function sqbwp_serialize_shortcode( $atts, $content = null ) {

	$content = maybe_unserialize($content);

	if(is_array($content)){
		$serialized_data = esc_sql(serialize( $content ));
	}else{
		$serialized_data = $content;
	}
    return $serialized_data;
}
add_shortcode( 'sqbwp_serialize', 'sqbwp_serialize_shortcode' );

add_action('wp_ajax_sqb_refresh_fields_manager', 'SQBRefreshCustomFieldsManager');
add_action('wp_ajax_nopriv_refresh_fields_manager', 'SQBRefreshCustomFieldsManager');

function SQBRefreshCustomFieldsManager(){
	$quiz_id = $_POST['quiz_id'];

	ob_start();

	?>
	
	<?php												
	$custom_fields_obj = SQB_CustomFields::load();
	if(isset($custom_fields_obj) && !empty($custom_fields_obj)) {
		$i = 1;
		foreach($custom_fields_obj as $custom_fields){
			
			$custom_fields_id = $custom_fields->id;
			$custom_fields_name = $custom_fields->name;
			$custom_fields_label = $custom_fields->label;
			$custom_fields_description = $custom_fields->description;
			$custom_fields_field_type = $custom_fields->field_type;
			$custom_fields_field_value = $custom_fields->field_value;
			$custom_fields_showonlytoadmin = $custom_fields->showonlytoadmin;
			$custom_fields_required = $custom_fields->required; ?>
			<div class="inner_template_style_box">
				<div class="d-flex justify-content-between align-items-center">
					<h4><?php echo $custom_fields_label; ?></h4>
					<div class="quiz_right-content">
						<div class="square-switch_onoff">
							<input class="checkbox sqb_enable_disable_custom_fields" name="<?php echo $custom_fields_id; ?>" type="checkbox" id="custom_fields_<?php echo $custom_fields_id; ?>" value="<?php echo $custom_fields_field_value; ?>" data-id="<?php echo strtolower($custom_fields_name); ?>" data-type="<?php echo $custom_fields_field_type; ?>" data-label-type="<?php echo $custom_fields_label; ?>" data-custom-fieldsid ="<?php echo $custom_fields_id; ?>" data-manage-id="<?php echo $custom_fields_id; ?>" data-required="<?php echo $custom_fields_required; ?>">
							<label for="custom_fields_<?php echo $custom_fields_id; ?>"></label>
						</div>
					</div>
				</div>
			</div>
			
	<?php
		$i++;
		}
	}
	?>
<?php
	$output['content'] = ob_get_clean();
	$output['status'] = 'ok';
	echo json_encode($output);	
	die;  
}

add_action('wp_ajax_sqb_quiz_answer_delete_by_question_id', 'SQBQuizAnswerDeleteByQuestionIdAjax');
add_action('wp_ajax_nopriv_sqb_quiz_answer_delete_by_question_id', 'SQBQuizAnswerDeleteByQuestionIdAjax');
add_action('wp_ajax_SqbGetQuizOptionFormAjax', 'SqbGetQuizOptionFormAjax');
add_action('wp_ajax_nopriv_SqbGetQuizOptionFormAjax', 'SqbGetQuizOptionFormAjax');


function SqbGetQuizOptionFormAjax(){
	$quiz_id = $_POST['quiz_id'];	 
	$sqbquizdata = SQB_QuizForm::loadByQuizIdAndName($quiz_id, 'third_party_from_enabled');
 
 	if(isset($sqbquizdata) && $sqbquizdata !=false){
  		
		$sqbquizdata->setId($sqbquizdata->getId());
		$sqbquizdata->setType($sqbquizdata->getType());
		$sqbquizdata->setRequired($sqbquizdata->getRequired());
		$sqbquizdata->setPlaceholder($sqbquizdata->getPlaceholder());		 
		$sqbquizdata->setFormId($sqbquizdata->getFormId());
		$sqbquizdata->setQuizId($quiz_id);
		$sqbquizdata->setName('third_party_from_enabled');
		$sqbquizdata->setValue('N');	 
		$sqbquizdata->update();
 	} 
 
	$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/template1/template1.php"); 	
	$file = file_get_contents($file); 
	$output = $file;		 
	
	echo json_encode($output);	die;  
}

add_action('wp_ajax_sqb_load_dap_products', 'sqb_load_dap_products');


function sqb_load_dap_products(){
	$html = "";
	if(class_exists('Dap_Product')) {
		$dap_products_list =  Dap_Product::loadProducts("","A");
		if(is_array($dap_products_list)){
			
			$dap_obj_exists_product_id = '';
			if(isset($dap_obj_exists)){
				$dap_obj_exists_product_id = $dap_obj_exists[0]->getActionData();
			}
			$html = '<option value="">Select Product</option>';
			foreach($dap_products_list as $dap_product_list){
				$dap_obj_exists_selected = '';
				if($dap_obj_exists_product_id == $dap_product_list->getId()){
					$dap_obj_exists_selected = 'selected';
				}
				$html .= "<option ".$dap_obj_exists_selected." value='".$dap_product_list->getId()."'>".$dap_product_list->getName()."</option>";
				
			}
		}
	}
	echo json_encode($html);die;  
}

add_action('wp_ajax_sqb_load_scp_products', 'sqb_load_scp_products');
function sqb_load_scp_products(){
	$html = "";
	if(function_exists('scp_generate_certificate')){
	    $courses = get_posts([
	        'post_type'      => array('scp-courses', 'scp-products'),
	        'post_status'    => 'publish',
	        'posts_per_page' => -1,
	    ]);

	    foreach ($courses as $course) {
	        $html .= "<option value='".$course->ID."'>".$course->post_title."</option>";
	    }
	}
	echo json_encode($html);die;  
}

function SQBQuizAnswerDeleteByQuestionIdAjax(){
	
	if(isset($_POST['question_id'])){
		
		$question_id = $_POST['question_id'];
		SQB_QuizAnswers::DeleteByQuestionId($question_id);
		SQB_OutComeMapping::DeleteByQuestionId($question_id);
		$output['success'] = "Deleted";
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
	
}

add_action('wp_ajax_sqb_load_dap_blocking_quiz', 'SQBLoadDapBlockingQuizAjax');
add_action('wp_ajax_nopriv_sqb_load_dap_blocking_quiz', 'SQBLoadDapBlockingQuizAjax');

function SQBLoadDapBlockingQuizAjax(){	
	if(isset($_POST['quiz_id'])){
		
		$quiz_id = $_POST['quiz_id'];
		$course_id = $_POST['course_id'];
		
		if (!class_exists('Dap_SQBQuizCourseLessons')) {
		  $data_exists = Dap_SQBQuizCourseLessons::loadByQuizIdCourseId($quiz_id,$course_id);		  
		  if(count($data_exists)){
			  $data_exists= $data_exists[0];
			  $output['dap_data'] = $data_exists;	
			  $quiz_exists_obj =  SQB_Quiz::loadById($quiz_id);
			  
			  if($quiz_exists_obj){
					  $output['quiz_data'] = $quiz_exists_obj;	
					  
					  $lesson_ids = $data_exists->getLessonIds();
					  $lesson_ids = explode(',',$lesson_ids);
					  $course_id = $data_exists->getCourseId();
					  
					  $units = Dap_Product::displayFileResourcesWithCourseId($data_exists->getCourseId());	 	 
	  
					  
					  $html = '';
					  if ( isset( $units ) ) {	 
						  foreach ( $units as $unit ) {
							  if($unit['name'] ==""){
								  $uname = $unit['url'];
							  }else{
								  $uname = $unit['name'];
							  }
							  
							  $var_checked = '';
							  if(in_array($unit['id'],$lesson_ids)){
								  $var_checked = "checked='checked'";
							  }
							  $html .='<li><span class="checkbox-custom-style"><input type="checkbox"   value="'.$unit['id'].'" '.$var_checked.' class="mutliSelect all_productslist custom-checkbox-input"><span class="custom--checkbox"></span></span>'.$uname.'</li>';
						  }
						  //$html ='<option value="0">Select</option>'.$html;  
					  }  
					  
					  $output["lession_html"] =  $html;
					  //$output["course_id"] =  $course_id;
					  
					  $output["quiz_data"]['quiz_status'] =  $quiz_exists_obj->getStatus();
					  $output["quiz_data"]['quiz_display_option'] =  $quiz_exists_obj->getSqbInsertQuiz();
					  $output["quiz_data"]['blocking_quiz'] =  $quiz_exists_obj->getQuizBlocking();
					  $output["quiz_data"]['sqb_quiz_show_start_screen'] =  $quiz_exists_obj->getShowStartScreen();
					  $output["quiz_data"]['sqb_quiz_allow_retake'] =  $quiz_exists_obj->getAllowRetake();
					  
					  $output["quiz_data"]['sqb_quiz_max_attempts_limit'] =  $quiz_exists_obj->getTotalAttempts();
					  $output["quiz_data"]['unlock_criteria'] =  $quiz_exists_obj->getPassCriteria();
					  
					  $output["quiz_data"]['sqb_passing_criteria'] =  $quiz_exists_obj->getQuizPassmark();
					  $output["quiz_data"]['quiz_type'] =  $quiz_exists_obj->getQuizType();
					  
			  } //if($quiz_exists_obj){
			  
		  } //if(count($data_exists)){
		  else {
			  $output['success'] = 'no data foud';	
		  }
		} // if class exists
		$output['success'] = 'load';		
	} //if(isset($_POST['quiz_id'])){
	else {		
		$output['error'] = 'Something Went Wrong';	
	}	 
	
	echo json_encode($output);die;
	
}

add_action('wp_ajax_sqb_save_dap_blocking_quiz', 'SQBSaveDapBlockingQuizAjax');
add_action('wp_ajax_nopriv_sqb_save_dap_blocking_quiz', 'SQBSaveDapBlockingQuizAjax');


function SQBGetNameOfRootFolder(){
	
		$folder_name_all = explode("/",__DIR__);
		$folder_name_wp = explode("wp-content",__DIR__);
		if($folder_name_wp[0]){
			$folder_name_all = explode("/",$folder_name_wp[0]);
			
			$folder_name_root_key = array_search("public_html",$folder_name_all);
			if(isset($folder_name_all[$folder_name_root_key+1])){
				$block_folder_name = $folder_name_all[$folder_name_root_key+1];
				if($block_folder_name == ''){
					$block_folder_name = "root";
				}
			}else{
				
				$block_folder_name = "root";
			}
		}
		
    return $block_folder_name;	

}

function SQBSaveDapBlockingQuizAjax(){
	$output['dapversionerr'] = '';
	if(isset($_POST['data'])){
		$quiz_id = $_POST['data']['quiz_id'];
		$course_id = $_POST['data']['course_id'];
		$lesson_ids = $_POST['data']['lesson_ids'];
		if(class_exists('SQB_DAPLessonQuiz')){
			$sqbdata_obj = new SQB_DAPLessonQuiz();
			$sqbdata_obj->setQuizId(stripslashes($quiz_id));
			$sqbdata_obj->setLessonId($lesson_ids);
			$sqbdata_obj->setDate( date('Y-m-d H:i:s'));
			
			//$data_exists = Dap_SQBQuizCourseLessons::loadByQuizIdCourseId($quiz_id,$course_id);
			$data_exists = SQB_DAPLessonQuiz::loadByLessonId($lesson_ids);
			if(!empty($data_exists)){
				$table_action = 'update';	
				$output['table_action'] = $table_action;	
				$sqbdata_obj->setId($data_exists->getId());
				$output['id'] = $data_exists->getId();
				$sqbdata_obj->update();
			}else{
				$table_action = 'create';	
				$output['id'] = $sqbdata_obj->create();
				$output['table_action'] = $table_action;	
			}
			
			// update quiz data 
			$quiz_exists_obj =  SQB_Quiz::loadById($quiz_id);
			if($quiz_exists_obj){
				
				$quiz_new_obj = new SQB_Quiz();
				$quiz_type = $quiz_exists_obj->getQuizType();
				$quiz_data_post =  $_POST['quiz_data'];
				
				if(isset($quiz_data_post['quiz_status'])){
					$quiz_exists_obj->setStatus($quiz_data_post['quiz_status']);
				}
				
				if($table_action == 'create'){
					$quiz_exists_obj->setStatus('Y');
				}
				
				if(isset($quiz_data_post['quiz_display_option'])){
					$quiz_exists_obj->setSqbInsertQuiz($quiz_data_post['quiz_display_option']);
				}
				
				if(isset($quiz_data_post['blocking_quiz'])){
					$quiz_exists_obj->setQuizBlocking($quiz_data_post['blocking_quiz']);
				}
				
				/*if(isset($quiz_data_post['sqb_quiz_show_correct_ans'])){
					$quiz_exists_obj->setQuizShowCorrectAnswer($quiz_data_post['sqb_quiz_show_correct_ans']);
				}*/
				
				
				
				if(isset($quiz_data_post['sqb_quiz_allow_retake'])){
							$quiz_exists_obj->setAllowRetake($quiz_data_post['sqb_quiz_allow_retake']);
				}
				
				
				if(isset($quiz_data_post['sqb_quiz_many_attempts']) && isset($quiz_data_post['sqb_quiz_max_attempts_limit'])){
					
					$quiz_attempts_allowed = $quiz_exists_obj->setQuizAttemptsAllowed($quiz_data_post['sqb_quiz_many_attempts']);
					if($quiz_data_post['sqb_quiz_many_attempts'] == 'limited'){
						$quiz_exists_obj->setTotalAttempts($quiz_data_post['sqb_quiz_max_attempts_limit']);
					}
				}
				
				
				
				if(isset($quiz_data_post['sqb_quiz_show_start_screen'])){
					$quiz_exists_obj->setShowStartScreen($quiz_data_post['sqb_quiz_show_start_screen']);
				}
				
				
				
				
				if(($quiz_type== 'assessment' || $quiz_type== 'scoring') && isset($quiz_data_post['blocking_quiz']) && ($quiz_data_post['blocking_quiz'] == 'Y')){
					
					if(isset($quiz_data_post['unlock_criteria'])){
						$quiz_exists_obj->setPassCriteria($quiz_data_post['unlock_criteria']);
					}
					
					if(isset($quiz_data_post['sqb_passing_criteria'])){
						$quiz_exists_obj->setQuizPassmark($quiz_data_post['sqb_passing_criteria']);
					}
					
				}
				
				if(isset($quiz_data_post['sqb_quiz_show_result_screen'])){
						$quiz_exists_obj->setDisplayCorrectAnsOnPage($quiz_data_post['sqb_quiz_show_result_screen']);
						
						if(($quiz_data_post['sqb_quiz_show_result_screen'] == 'yes' ) && isset($quiz_data_post['sqb_quiz_show_correct_incorrect_ans']) && ($quiz_data_post['sqb_quiz_show_correct_incorrect_ans'] == 'Y' )){
							
							if($quiz_exists_obj->getDisplayAnswerOptions() == 'each_page'){
								$quiz_exists_obj->setDisplayAnswerOptions('both');
							}
							
						}
				}
				
				if(isset($quiz_data_post['quiz_pagination'])){
						$quiz_exists_obj->setQuizPagination($quiz_data_post['quiz_pagination']);					
						 
				}
				$output['quiz_data_post'] = $quiz_data_post;
				$output['quiz_update_id'] = $quiz_exists_obj->update();
				$output[' quiz_exists_obj'] = $quiz_new_obj;
				
			}
			$output['success'] = 'saved';	
		}else{
			$output['dapversionerr'] = 'You need to be on DAP v8.6.x or above to use this integration.';	
		}
		
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_quiz_update_status_by_id', 'SQBQuizUpdateStatusById');
add_action('wp_ajax_nopriv_sqb_quiz_update_status_by_id', 'SQBQuizUpdateStatusById');


function SQBQuizUpdateStatusById(){
	$output= array();
	if(isset($_POST)){ 	
		$quiz_id = $_POST['quiz_id'];
		$quiz_status = $_POST['quiz_status'];
		$output['success'] = 'update';
		$quiz_obj = SQB_Quiz::loadById($quiz_id);
		if($quiz_obj){
			$quiz_obj->setStatus($quiz_status);
			$quiz_obj->update();
		}else{
			$output['quiz_not_found'] = $quiz_id;
		}
		
		$output['quiz_id'] = $quiz_id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_dap_quiz_bloking_by_id', 'SQBDapQuizBlokingById');
add_action('wp_ajax_nopriv_sqb_dap_quiz_bloking_by_id', 'SQBDapQuizBlokingById');


function SQBDapQuizBlokingById(){
	$output= array();
	if(isset($_POST)){ 	
		$id = $_POST['id'];
		$output['success'] = 'Deleted';
		Dap_SQBQuizCourseLessons::deleteById($id);
		$output['id'] = $id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}	

 
add_action('wp_ajax_sqb_save_fb_api_key', 'SqbSaveFbApiKeyAjax');
add_action('wp_ajax_nopriv_sqb_save_fb_api_key', 'SqbSaveFbApiKeyAjax');


function SqbSaveFbApiKeyAjax(){
	
	if(isset($_POST['fb_api_key'])){
		
		$current_date = date('Y-m-d H:m:s');
		$name = 'facebook';
		$key = 'fb_api_key';
		$value = $_POST['fb_api_key'];
		$insertObj = new SQB_AutoresponderSettings();
		$insertObj->setName($name);
		$insertObj->setKeyName($key);
		$insertObj->setValue($value);
		$insertObj->setDate($current_date);
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		if($obj){
			$id = $insertObj->update();
			$output['table_action'] = 'update';
		}else{
			$id =  $insertObj->create();
			$output['table_action'] = 'create';
		}
		
		$output['id'] = $id;	
		$output['success'] = 'saved ';	
		
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_save_quick_email_verification_api_settings', 'SqbSaveQuickEmailVerificationSettingsAjax');
add_action('wp_ajax_nopriv_sqb_save_quick_email_verification_api_settings', 'SqbSaveQuickEmailVerificationSettingsAjax');


function SqbSaveQuickEmailVerificationSettingsAjax(){
	
	$output = array();
	if(isset($_POST['qev_api_key']) && isset($_POST['qev_timeout'])){
		$details = array();
		$quick_email_verification = 'quick_email_verification';
		$quick_email_verification_api_key = 'quick_email_verification_api_key';
		$qev_api_key = $_POST['qev_api_key'];
		$details[] = array('name' => $quick_email_verification, 'key'=>$quick_email_verification_api_key, 'value'=> $qev_api_key);
		
		$email_verification_timeout = 'email_verification_timeout';
		$email_verification_timeout_value = 'email_verification_timeout_value';
		$qev_timeout = $_POST['qev_timeout'];
		$details[] = array('name' => $email_verification_timeout, 'key'=>$email_verification_timeout_value, 'value'=> $qev_timeout);
	
		save_quick_email_verification_details($details);

		$reoon_api_key = isset($_POST['reoon_api_key']) ? $_POST['reoon_api_key'] : '';
		$email_verify_platform = isset($_POST['email_verification_platform']) ? $_POST['email_verification_platform'] : 'quickemail';
		

		update_option('reoon_api_key', $reoon_api_key);
		update_option('email_verify_platform', $email_verify_platform);


	} else {
		$output['error'] = 'Something Went Wrong';	
	}	
	echo json_encode($output);die;
}

function save_quick_email_verification_details($details){
		$output = array();
		foreach($details as $key => $value){
		$current_date = date('Y-m-d H:m:s');
		$insertObj = new SQB_AutoresponderSettings();
		$insertObj->setName($value['name']);
		$insertObj->setKeyName($value['key']);
		$insertObj->setValue($value['value']);
		$insertObj->setDate($current_date);
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($value['name'] , $value['key']);
		if($obj){
			$id = $insertObj->update();
			$output['table_action'] = 'update';
		}else{
			$id =  $insertObj->create();
			$output['table_action'] = 'create';
		}
		$output[] = array('id' => $id, 'success' => 'saved'); 	
		}
		return $output;	
}

add_action('wp_ajax_sqb_load_question_answer_report', 'SqbLoadQuestionAnswerReportAjax');
add_action('wp_ajax_nopriv_sqb_load_question_answer_report', 'SqbLoadQuestionAnswerReportAjax');

function SqbLoadQuestionAnswerReport($qar_quiz_id = 0,$start_date = '',$end_date = '' ){
	
	
	       $qar_html_outter = '';
	       $qar_output_array = array();
	       $qar_output_matrix_array = array();
			if($qar_quiz_id != '' && $qar_quiz_id != 0 ){	
				
				$qarObj = SQB_QuestionAnswerReport::loadByQuizIdAndStartDateAndEndDate($qar_quiz_id,$start_date,$end_date);
				if(isset($qarObj)){
					foreach($qarObj as $qarObjSingle){
						$qar_answer_id = $qarObjSingle->getAnswerId();
						$qar_question_id = $qarObjSingle->getQuestionId();
						if($qar_question_id == 0 || $qar_question_id == ''){
							continue;
						}
						
						$inner_array = array();
						$qar_answer_ids = explode(',',$qar_answer_id);
						
						/********count for matrix start***********/
						$qar_question_type = '';
						$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
						if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
						$matrix_label_text = $repques_quiz_obj->getMatrixLabelText();
						$matrix_label_text_values = explode(',',$matrix_label_text);
						}
						
						if($qar_question_type == 'matrix'){
							
							foreach($qar_answer_ids as $qar_answer_id){
								if($qar_answer_id == ''){
									continue;
								}
								$matrix_response_id = explode('|',$qar_answer_id);
								$qar_answer_id = !empty($matrix_response_id[0]) ? $matrix_response_id[0] : '';
								$option_index = !empty($matrix_response_id[1]) ? $matrix_response_id[1] : '';
								
								foreach($matrix_label_text_values as $matrix_label_text_value){
									$matrix_label = explode('|',$matrix_label_text_value);
									$matrix_index = $matrix_label[0];
									if($matrix_index == $option_index){
										if(isset($qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]) && array_key_exists('visited',$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index])){
											$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] = $qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] +1;
										} else {
											$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] = 1; 
										}
									}
								}
							}
							
						}/********count for matrix end***********/
						
						
						
						foreach($qar_answer_ids as $qar_answer_id){
							if($qar_answer_id == ''){
								continue;
							}
							if(isset($qar_output_array[$qar_question_id][$qar_answer_id]) &&  array_key_exists('visited',$qar_output_array[$qar_question_id][$qar_answer_id])){
								$qar_output_array[$qar_question_id][$qar_answer_id]['visited'] = $qar_output_array[$qar_question_id][$qar_answer_id]['visited'] +1;
							}else{  
								$qar_output_array[$qar_question_id][$qar_answer_id]['visited'] = 1;
							}
							
							if($qar_question_type == 'matrix'){
							break;
							}
						}
						
					}// foreach loop closed
				}
			}
			
			
			
			$questioin_no = 0;
			$i = 1;
			$questionsObj = SQB_QuizQuestions::loadByQuizId($qar_quiz_id);
			
	 		 //added for fix the question order
			$question_data_list_count = '';
			$answer_edit_text_class = '';	
			$questions_order_array = array();		
			if(count($questionsObj)){			   
			   $question_count = 0;			   
			   $questions_order_array = array();
			   $questionsObj_count = count($questionsObj); 
			   foreach($questionsObj as $questionObj){
				   $question_id  = $questionObj->getQuestionId();
				   $question_data = SQB_QuizQuestionBank::loadById($question_id);
				   
				   if($question_data){
					  $question_order =  $question_data->getQuestionOrder();					  
					  if(isset($questions_order_array[$question_order])){
							$question_order = count($questions_order_array) + 1;
						}
						if(isset($questions_order_array[$question_order])){
							$questions_order_array[$questionsObj_count++] = $question_data; 
						}else{
							$questions_order_array[$question_order] = $question_data; 
						}
				   }
			   }     
			   ksort($questions_order_array);			   
		   }
		   if(is_array($questions_order_array) && count($questions_order_array)){			   
			foreach($questions_order_array as $key=>$sqbQuesiton_Obj){				 
				if($sqbQuesiton_Obj){
					$qar_question_id   = $sqbQuesiton_Obj->getId();
				 
					$qar_total_visited = 0;
					$qar_total_answer_picked = 0;
					$qar_html_inner = '';
					$questioin_no++;			
					$qar_answer_no = 0;
					$qar_table_tr = '';
					
					$qar_question_type = '';
					$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
					if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
					}

					if(isset($qar_output_array[$qar_question_id])){
						$qar_output_array_single_values = $qar_output_array[$qar_question_id];
						foreach($qar_output_array_single_values as $qar_answer_id => $qar_output_array_single_value){
							if($qar_answer_id == 0){
								$qar_total_visited = $qar_total_visited + $qar_output_array_single_value['visited'];
								continue;
							}
							$qar_total_answer_picked = $qar_total_answer_picked + $qar_output_array_single_value['visited'];
						}// for each loop closed 
					}// if loop closed 
				
				 //$qar_answer_obj = SQB_QuizAnswers::loadById($id);
				 $qar_answer_obj = SQB_QuizAnswers::loadByQuestionId($qar_question_id);
				 $qar_answer_html = '';
			 	 $create_bar_chart = '';	

				 $matrix_answer_html = '';
				 if($qar_answer_obj){

				 	$backgroundColor = ["#959ef2", "#ff83a9", "#25d5f2", "#ffc750", "#2ec551", "#a484ff", "#ffa5c1","#CFEAEA ", "#c9e3d5", "#e7dadd", "#dde9eb", "#ecfac7", "#facba9", "#dfdbd3", "#f1fdc1","#cacdca", "#b2b4b2", "#969896", "#afb6af", "#ffff00"];
				 	$count = 0;
				 	$pecentage_array = array();
				 	$percentage_color_array = array();
				 	$answer_num_array = array();
				 	$answer_default_data_array = array();
				 	$answer_default_color_data_array = array();
				 	
				 	$not_show_chart = true;
					$question_type_rating = false;
					$anser_array_with_name = array();
					
					$qar_question_type = '';
					$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
					if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
					}
					
					if($qar_question_type == 'ranking_choices'){
						$question_type_rating = true;
						$not_show_chart = false;
					}
					
					
					foreach($qar_answer_obj as $qar_answer_obj_values){
						$qar_answer_no++;
						$qar_answer_id_new =  $qar_answer_obj_values->getId();
						//$qar_answer_html =  $qar_answer_obj_values->getAnswer();
						$qar_answer_html =  $qar_answer_obj_values->getAnswerTitle();
					
						$qar_answer_html = stripslashes($qar_answer_html);
						$anser_array_with_name[$qar_answer_id_new] = $qar_answer_html;
						/*$qar_answer_html = str_replace('sqb_tiny_mce_editor','sqb_tiny_mce_editor_rename',$qar_answer_html); 
						$qar_answer_html = str_replace('style','style_rename',$qar_answer_html); 
						$qar_answer_html = str_replace('contenteditable="true"','contenteditable="false"',$qar_answer_html); 
						
						$qar_answer_html = str_replace("contenteditable='true'","contenteditable='false'",$qar_answer_html); */
					
					
						//$qar_output_array_single_value['visited']
						$qar_ans_visited = 0;
						if(isset($qar_output_array[$qar_question_id][$qar_answer_id_new])){
							$qar_ans_visited = $qar_output_array[$qar_question_id][$qar_answer_id_new]['visited'];
						}
						
						$matrix_label_text = '';
						$qar_question_type = '';
						$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
						if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
						$matrix_label_text = $repques_quiz_obj->getMatrixLabelText();
						$matrix_label_text_values = explode(',',$matrix_label_text);
						}
					
						if($qar_question_type == 'matrix') {
								$matrix_table_data = '';
								$iteration = 1;
								foreach($matrix_label_text_values as $matrix_label_text_value){
									$matrix_label = explode('|',$matrix_label_text_value);
									$matrix_index = $matrix_label[0];
									$qar_matrix_ans_visited = 0;
									if(isset($qar_output_matrix_array[$qar_question_id][$qar_answer_id_new][$matrix_index])){
									$qar_matrix_ans_visited = $qar_output_matrix_array[$qar_question_id][$qar_answer_id_new][$matrix_index]['visited'];
									}
									
									if($qar_matrix_ans_visited == 0){
										$percentage = 0;
									}else{
										$percentage = $qar_matrix_ans_visited/$qar_total_answer_picked*100;
										$percentage = round($percentage);
									}
									
									$pecentage_array[] = $percentage;
									$answer_num_array[] = 'A'.$qar_answer_no;
									$percentage_color_array[] = $backgroundColor[$iteration];
									$answer_default_data_array[] = '100';
									$answer_default_color_data_array[] = '#eeeff0';
									
									$ans_progress_bar_html = '<div class="progress-bar-outer">
																<label>'.$percentage.'%</label>
																<div class="sqb-progress-report">
																	<div class="sqb-progress-bar" style="width:'.$percentage.'%; background:'.$backgroundColor[$iteration].'"> </div>
																</div>
															</div>';
									
									$matrix_table_data .= '<tr>
												<!--<td class=" text-center">'.$iteration.'</td>-->
												<td class=" ">'.urldecode($matrix_label[1]).'</td>
												<td class="percentage">
													'.$ans_progress_bar_html.'
												</td>
												<td class=" text-center">'.$qar_matrix_ans_visited.'</td>
											</tr>';
											$iteration++;
											$count++;
								}
														
								$matrix_answer_html .= '<div class="card">
								<div class="card-header" id="heading'.$qar_answer_id_new.'">
									<h2 class="mb-0">'.$qar_answer_no.': '.$qar_answer_html.'</h2>
									<div class="QA-accordion-header-right">
										<button class="QA-accordion-action collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$qar_answer_id_new.'" aria-expanded="false" aria-controls="collapse'.$qar_answer_id_new.'"><i class="fa fa-angle-up" aria-hidden="false"></i></button>
									</div>
								</div>
								
								<div id="collapse'.$qar_answer_id_new.'" class="collapse" aria-labelledby="heading'.$qar_answer_id_new.'" data-parent="#matrix-accordion-'.$qar_question_id.'">
								  <div class="card-body">
								  
								  <div class="table-responsive Quiz-QA-Table">
										<table class="table table-fixed">
											<thead>
												<tr>
													<!--<th scope="col" class=" text-center">#</th>-->
													<th scope="col" class="">Selected Option</th>
													<th scope="col" class=" text-center">Value</th>
													<th scope="col" class=" text-center">This Option was Picked</th>
												</tr>
											</thead>
											<tbody>
											'.$matrix_table_data.'
											</tbody>
										</table>
								   </div>
								   
								  </div>
								</div>
							  </div>';
								$qar_table_tr .= '';
						} else {
							
							if($qar_ans_visited == 0 || $qar_total_visited == 0){
								$percentage = 0;
							}else{
								$percentage = $qar_ans_visited/$qar_total_answer_picked*100;
								$percentage = round($percentage);
							}
							$pecentage_array[] = $percentage;
							$answer_num_array[] = 'A'.$qar_answer_no;
							$percentage_color_array[] = $backgroundColor[$count];
							$answer_default_data_array[] = '100';
							$answer_default_color_data_array[] = '#eeeff0';
							
							$ans_progress_bar_html = '<div class="progress-bar-outer">
														<label>'.$percentage.'%</label>
														<div class="sqb-progress-report">
															<div class="sqb-progress-bar" style="width:'.$percentage.'%; background:'.$backgroundColor[$count].'"> </div>
														</div>
													</div>';
							if($question_type_rating){
								$ans_progress_bar_html = '';
								$qar_ans_visited = '';
							}
							$qar_table_tr .= '<tr>
												<td class=" text-center">A'.$qar_answer_no.'</td>
												<td class="ttttt">'.$qar_answer_html.'</td>
												<td class="percentage">
													'.$ans_progress_bar_html.'
												</td>';

							$qar_table_tr .= '<td class=" text-center">'.$qar_ans_visited.'</td>
												</tr>';
						}					
						$count++;
					}// for each loop closed 
					$qar_table_tr_rating = '';
					if($question_type_rating){
					$ranting_data = SQB_QuestionAnswerReport::getRatingQuestionReportByDate($qar_question_id, $start_date,$end_date);
							
							if(isset($ranting_data) && count($ranting_data)){
								$rating_total_rows = 0;
								foreach($ranting_data as $ranting_single){
									$rating_total_rows = $rating_total_rows + $ranting_single['total'];
								}
								$rating_backgroundColor_color = 0;
								$rating_row_key  = 0;
								foreach($ranting_data as  $ranting_single){
									$rating_backgroundColor_color++;
									$rating_row_key++;
									if(!isset($backgroundColor[$rating_backgroundColor_color])){
										$rating_backgroundColor_color = 0;
									}
										$rating_total_row = (int)$ranting_single['total'];
										$rating_answer_given_row = $ranting_single['answer_id'];
										$rating_answer_given_row_array = explode(',',$rating_answer_given_row);
										$rating_ansers_html = '';
										foreach($rating_answer_given_row_array as $ans_id ){
											
											if(isset($anser_array_with_name[$ans_id])){
												$rating_ansers_html .= $anser_array_with_name[$ans_id].'<br>';
												
											}
											
										}

										if($rating_total_row == 0){
											$rating_total_row = 1;
										}
										
										$rating_total_row_perc = round(100*$rating_total_row/$rating_total_rows);
										
										

										$qar_table_tr_rating .= '<tr>
														<td class=" text-center">'.$rating_row_key.'</td>
														<td class="">'.$rating_ansers_html.'</td>
														<td class="percentage">
															<div class="progress-bar-outer">
																<label>'.$rating_total_row_perc.'%</label>
																<div class="sqb-progress-report">
																	<div class="sqb-progress-bar" style="width:'.$rating_total_row_perc.'%; background:'.$backgroundColor[$rating_backgroundColor_color].'"> </div>
																</div>
															</div>
														</td>';

													$qar_table_tr_rating .= '<td class=" text-center"></td>
														</tr>';
										}
									
									
								$qar_table_rating_html	= '<table class="table table-fixed question_table_rating_class">
								<thead>
									<tr>
										<th scope="col" class=" text-center">#</th>
										<th scope="col" class="">Most Popular Choices</th>
										<th scope="col" class="">Value</th>
										<th scope="col" class=" text-center"></th>
									</tr>
								</thead>
								<tbody>'.$qar_table_tr_rating.'</tbody></table>';	
								}
						 }
				}

				$qar_question_obj = SQB_QuizQuestionBank::loadById($qar_question_id);
				$qar_question_html = '';
				$qar_question_type = '';
				if($qar_question_obj){
					/*$qar_question_html = stripslashes($qar_question_obj->getQuestion());
					$qar_question_html = str_replace('sqb_tiny_mce_editor','sqb_tiny_mce_editor_rename',$qar_question_html); 
					$qar_question_html = str_replace('style','style_rename',$qar_question_html); 
					$qar_question_html = str_replace('contenteditable="true"','contenteditable="false"',$qar_question_html); */
					$qar_question_html = stripslashes($qar_question_obj->getQuestionTitle());
					$qar_question_type = $qar_question_obj->getQuestionType();
				}


				$qar_html_outter  .= '<div class="card">
							<div class="card-header" id="QA-accordion-One">
								<h2>Question '.$i.' : '.$qar_question_html.'</h2>
								<div class="QA-accordion-header-right">
									<div class="QA-accordion-h-info-block">
										<span><i class="fa fa-eye" aria-hidden="true"></i>Viewed</span>
										<h4>'.$qar_total_visited.'</h4>
									</div>
									<div class="QA-accordion-h-info-block">
										<span><i class="fa fa-check-square" aria-hidden="true"></i>Answered</span>
										<h4>'.$qar_total_answer_picked.'</h4>
									</div>
									<button class="QA-accordion-action collapsed" type="button" data-toggle="collapse" data-target="#qar_QA-collapseOne_'.$questioin_no.'" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-up" aria-hidden="false"></i></button>
								</div>
							</div>';
					if($pecentage_array){
						$count_percentage_bar = !empty($pecentage_array) ? count($pecentage_array) : 0;

				 	if($count_percentage_bar < 3){
						$width = '300px';
						$height = '200px';
					}elseif($count_percentage_bar >=3 && $count_percentage_bar <  6){
						$width = '400px';
						$height = '220px';
					}elseif($count_percentage_bar >=6 && $count_percentage_bar <  9){
						$width = '500px';
						$height = '220px';
					}elseif($count_percentage_bar >=9 && $count_percentage_bar <  12){
						$width = '600px';
						$height = '220px';
					}elseif($count_percentage_bar >=12 && $count_percentage_bar <  15){
						$width = '800px';
						$height = '220px';
					}elseif($count_percentage_bar >=15 && $count_percentage_bar <  20){
						$width = '1000px';
						$height = '250px';
					}else{
						$width = '1000px';
						$height = '250px';
					}
					 
					$pecentage_array = json_encode($pecentage_array);
					$answer_num_array = json_encode($answer_num_array);
					$percentage_color_array = json_encode($percentage_color_array);
					$answer_default_data_array = json_encode($answer_default_data_array);
					$answer_default_color_data_array = json_encode($answer_default_color_data_array);

					if($qar_question_obj->question_type == 'single' || $qar_question_obj->question_type == 'multi' || $qar_question_obj->question_type == 'yes_no' || $qar_question_obj->question_type == 'yes_no'){
					//ranking_choices
                   
					$create_bar_chart .= '<div class="create-custom-chart"><div class="custom-chart-outer" style="max-width:'.$width.'; height:'.$height.'"><canvas id="myChart'.$questioin_no.'"></canvas></div></div>';

					$create_bar_chart .= '<script>var ctx = document.getElementById("myChart'.$questioin_no.'").getContext("2d");
						var myChart = new Chart(ctx, {
						type: "bar",

						data: {
						labels: '.$answer_num_array.',
						datasets: [{
							fill: true,	
						  label: "Answers",
						  data: '.$pecentage_array.',
						  backgroundColor: '.$percentage_color_array.',
						},{
						  label: "Answers",
						  data: '.$answer_default_data_array.',
						  backgroundColor: '.$answer_default_color_data_array.',
							}],
						},

						options: {
							        legend: {
							        display: false
							    },

							    responsive: true, 
								maintainAspectRatio: true,
							    hover: {mode: null},
							    plugins: {
							      	datalabels: {
							        	color: "#eeeff0",
							        	display: function(context) {
							          		return context.dataset.data[context.dataIndex];
							        	},
								        font: {
								          weight: "bold"
								        },
								        formatter: function(value, context) {
								          return Math.round(value) + "%";
								        }
							      	}
						      	},
							    tooltips: {
							      callbacks: {
							        label: function(tooltipItem, data) {
										return data["datasets"][0]["data"][tooltipItem["index"]] + "%";
							        }
							      }
							    },
								scales: {
							      xAxes: [{
							      	stacked: true,
							          gridLines: {
							            display: false,
							          },
							          barThickness: 40,
							          maxBarThickness: 52,
							        }],
							      yAxes: [{
							      	stacked: true,
							      	 gridLines: {
							            display: false,
							          },
							        	ticks: {
							                min: 0,
								            max: 100,
								            stepSize: 20,
						            		callback: function(value){return value+ "%"}
							            },
							        }],
							    },
							}
						})</script>';					 
					}else{
						$create_bar_chart = '';
					}
					}
					
					
					$question_table_head_text1 = 'Answer Text';			
					$question_table_head_text2 = 'Value';			
					$question_table_head_text3 = 'This Answer was Picked';	

					if($question_type_rating){
						$question_table_head_text1  = 'Original Answers';
						$question_table_head_text2 = '';			
						$question_table_head_text3 = '';	
					}

				$qar_html_outter  .= '<div id="qar_QA-collapseOne_'.$questioin_no.'" class="collapse" aria-labelledby="headingOne" data-parent="#QA-accordion">
					<div class="card-body">
						<!-- Fixed header table-->';
				if($qar_question_type == 'matrix'){
				$qar_html_outter  .= '<div class="accordion inner-accordion" id="matrix-accordion-'.$qar_question_id.'">'.$matrix_answer_html.'</div>';	
				} else {		
				$qar_html_outter  .= '<div class="table-responsive Quiz-QA-Table">'.$create_bar_chart.'
							<table class="table table-fixed">
								<thead>
									<tr>
										<th scope="col" class=" text-center">#</th>
										
										<th scope="col" class="">'.$question_table_head_text1.'</th>
										<th scope="col" class="">'.$question_table_head_text2.'</th>
										<th scope="col" class=" text-center">'.$question_table_head_text3.'</th>
									</tr>
								</thead>
								<tbody>'.@$qar_table_tr.'</tbody></table>'.@$qar_table_rating_html;	
				$qar_html_outter  .= '</div>';
				}
				$qar_html_outter  .= '</div>';
				$qar_html_outter  .= '</div>';
				
				$qar_html_outter  .= '</div>';
				$i++;
				
				}
			}
			}
			
			if($qar_html_outter == ''){
				$qar_html_outter = '<div class="alert alert-danger" role="alert">Sorry, no data found</div>';
			}
			
			$quiz_id = !empty($_REQUEST['quiz_id']) ? $_REQUEST['quiz_id'] : '';
			if(!empty($quiz_id)){

				$qarObj = SQB_QuestionAnswerReport::loadByQuizIdAndStartDateAndEndDate($qar_quiz_id,$start_date,$end_date);


				$ques_title = ' ';
				if(!empty($qarObj)){
					$qar_question_id = $qarObj[0]->getQuestionId();
					$qar_question_obj = SQB_QuizQuestionBank::loadById($qar_question_id);
					if(!empty($qar_question_obj)){
						$ques_title = stripslashes($qar_question_obj->getQuestionTitle());
					}

				}

				$quiz_obj = SQB_Quiz::loadById($quiz_id);
				
				if($quiz_obj->getQuizType() == 'poll'){
					$qar_html_outter = '';

					$question_table_head_text1 = 'Answer';			
					$question_table_head_text2 = 'Votes';			
					

					$poll_result = get_poll_results($quiz_id);

					$total = array_reduce($poll_result, function($carry, $item) {
					    $carry += $item['cnt'];
					    return $carry;
					});


					if ($total == '') {
						$qar_html_outter = '<div class="alert alert-danger" role="alert">Sorry, no data found</div>';
					}else{

					$qar_html_outter .=  '
					<div class="accordion question_answer_report_wrapper poll-results-wrapper admintester" id="QA-accordion">
					<div class="card-poll">';


					$qar_html_outter .= '<div class="card-header no-accord" id="QA-accordion-One">
								<h2>'.$ques_title.'</h2>
								
								</div>
							</div>';

					$qar_html_outter  .= '<div id="qar_QA-collapseOne_1" class="collapse show" aria-labelledby="headingOne" data-parent="#QA-accordion">
					<div class="card-body">
						<!-- Fixed header table-->';

						$qar_table_tr = '';
						foreach($poll_result as $key => $poll){

							$percentage = ($total > 0) ? round((100*$poll['cnt']) / $total,2) : 0;
							$ans_progress_bar_html = '<div class="progress-bar-outer">
																<label>'.$percentage.'% / '.$poll['cnt'].' Votes</label>
																<div class="sqb-progress-report">
																	<div class="sqb-progress-bar" style="width:'.$percentage.'%; background:'.$backgroundColor[$key].'"> </div>
																</div>
															</div>';

							$qar_table_tr .= '<tr>
												
												<td class="poll-result-td">'.stripslashes($poll['answer_title']).'</td>
												<td class="percentage poll-result-td">
													'.$ans_progress_bar_html.'
												</td>';

							$qar_table_tr .= '</tr>';

						}

						$total_row = '<div class="total"><span>Total Votes</span> : <span>'.$total.'</span></div>';

						$qar_html_outter  .= '<div class="table-responsive Quiz-QA-Table poll-chart-bar">
							<table class="table table-fixed">
								<thead>
									<tr>
										<th scope="col" class="poll-result-td">'.$question_table_head_text1.'</th>
										<th scope="col" class="poll-result-td">'.$question_table_head_text2.'</th>
									</tr>
								</thead>
								<tbody>'.$qar_table_tr.'</tbody></table>';	

					$qar_html_outter  .= '<div class="poll-total-count">'.$total_row.'</div>';
					$qar_html_outter  .= '<div class="chart-history-poll-wrapper">';
					$qar_html_outter  .= '<div class="card-body poll-chart-pie">';
					

					$label = array();
					$data = array();
					foreach ($poll_result as $key => $value) {
						$label[] = stripslashes($value['answer_title']);
						if ($value['cnt'] != 0) {
							$data[] = $value['cnt'];
						}
						
						//$per = ($total > 0) ? round((100*$value['cnt']) / $total,2) : '0';
						//$data[] = $per.'%';
					}	


					$create_bar_chart = '<div class="create-custom-chart"><div class="custom-chart-outer"><canvas id="myChart1"></canvas></div></div>';

					$create_bar_chart .= '<script>

					var ctx = document.getElementById("myChart1").getContext("2d");
						var myChart = new Chart(ctx, {
						type: "pie",
						data: {
							labels: '.json_encode($label).',
							datasets: [{
							  label: "Answers",
							  data: '.json_encode($data).',
							  backgroundColor: '.$percentage_color_array.',
							}],
						},

						options: {
							        legend: {
								        display: false
								    },

							    responsive: true, 
								maintainAspectRatio: true,


								plugins: {
							        datalabels: {
							            formatter: (value, ctx) => {
							                let sum = 0;
							                let dataArr = ctx.chart.data.datasets[0].data;
							                dataArr.map(data => {
							                    sum += data;
							                });
							                let percentage = (value*100 / sum).toFixed(2)+"%";
							                return percentage;
							            },
							            color: "#fff",
							        }
							    }
							}
						})</script>';					 
					

					$qar_html_outter .= $create_bar_chart;

					$qar_html_outter  .= '</div>';

					//$qar_html_outter  .= '<div class="card-body">';
					global $wpdb;	
					$tableName1 = $wpdb->prefix .'sqb_users_quiz_details';

					$sql = "SELECT id,date,answer_given AS cnt,answer_text FROM ".$tableName1." WHERE quiz_id = ".$quiz_id." LIMIT 100";
					$submissions = $wpdb->get_results($sql, ARRAY_A);


					//$qar_html_outter  .= '</div>';
					$qar_table_tr = '';

					foreach ($submissions as $key => $submission) {
						$qar_table_tr .= '<tr>
												
												<td class="submission-vote">'.stripslashes($submission['answer_text']).'</td>
												<td class="submission-time">'.($submission['date']).'</td>
												<td class="submission-action">
													<a class="ManageQuiz-action-btn item-delete-btn" title="Delete Quiz" href="javascript:void(0)" onclick="sqbDeleteSubmission('.$submission['id'].')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
												</td>';

							$qar_table_tr .= '</tr>';
					}

					$qar_html_outter  .= '<div class="table-responsive Quiz-QA-Table poll-chart-submission">
						<h3>Submissions	Report</h3>
							<div class="table-history-wrapper">
							<table class="table table-fixed">
								<thead>
									<tr>
										<th scope="col" class="submission-vote">Vote</th>
										<th scope="col" class="submission-time">Submission Time</th>
										<th scope="col" class="submission-action"></th>
									</tr>
								</thead>
								<tbody>'.$qar_table_tr.'</tbody></table></div>';	

					$qar_html_outter  .= '</div>';
					$qar_html_outter  .= '</div>';
					$qar_html_outter  .= '</div>';
					
					$qar_html_outter  .= '</div>';

					

					$qar_html_outter  .= '</div>';
					
					$qar_html_outter  .= '</div>';

				}


				}
			}


			return $qar_html_outter;
	
}

function SqbLoadQuestionAnswerReportAjax(){
	
		if(isset($_POST['quiz_id'])){
			
			
			$quiz_id = $_POST['quiz_id'];
			$sqb_qanr_start_date = $_POST['sqb_qanr_start_date'];
			$sqb_qanr_end_date = $_POST['sqb_qanr_end_date'];
			if($sqb_qanr_start_date != ''){
				$start_date = date("Y-m-d", strtotime($sqb_qanr_start_date));
			}
			if($sqb_qanr_end_date != ''){
				
				$end_date = date("Y-m-d", strtotime($sqb_qanr_end_date));
			}

			

			$html = SqbLoadQuestionAnswerReport($quiz_id,sqb_get_date_fl($start_date,'Y-m-d'), sqb_get_date_fl($end_date,'Y-m-d'));
			$output['success'] = 'Saved';	
			$output['html'] = $html;	
			if( $html == ''){
				$output['no_records_fond'] = '<div class="alert alert-danger" role="alert">Sorry, no data found</div>';	
			}
			
			
			
		}else{
			$output['error'] = 'Something Went Wrong';	
		}	
	
	echo json_encode($output);die;
	
}

function SqbGetAllowedMimes($allowedTypesOfFileHidden){
	$allowedMimes = array();
	$allowedImage = false;
	$allowedDoc = false;
	$allowedAudio = false;
	$allowedVideo = false;

	if(is_array($allowedTypesOfFileHidden)){
		foreach($allowedTypesOfFileHidden as $type){
			switch ($type) {
				case "png":
					$key = $type;	
					$mimeType = 'image/'.$type;	
					$allowedImage = true;
					break;
				case "jpg":
					$key = 'jpg|jpeg|jpe';	
					$type = 'jpeg';
					$allowedImage = true;
					break;
				case "gif":
					$key = $type;	
					$mimeType = 'image/'.$type;	
					$allowedImage = true;
					break;
				case "doc":
					$key = $type;	
					$mimeType = 'image/msword';	
					$allowedDoc = true;
					break;
				case "xls":
					$key = $type;	
					$mimeType = 'application/excel';	
					$allowedDoc = true;
					break;
				case "ppt":
					$key = $type;	
					$mimeType = 'application/mspowerpoint';	
					$allowedDoc = true;
					break;	
				case "pdf":
					$key = $type;	
					$mimeType = 'application/'.$type;	
					$allowedDoc = true;
					break;	
				case "mpg":
					$key = $type;	
					$mimeType = 'video/mpeg';	
					$allowedVideo = true;
					break;
				case "mov":
					$key = $type;
					$mimeType = 'video/quicktime';	
					$allowedVideo = true;
					break;	
				case "wmv":
					$key = $type;	
					$mimeType = 'video/x-ms-wmv';	
					$allowedVideo = true;
					break;	
				case "wav":
					$key = $type;	
					$mimeType = 'audio/wav';	
					$allowedAudio = true;
					break;
				case "mp3":
					$key = $type;	
					$mimeType = 'audio/mpeg';	
					$allowedAudio = true;
					break;	
				case "mp4":
					$key = $type;	
					$mimeType = 'video/mp4';	
					$allowedVideo = true;
					break;	
				default:
					$key = '';
					$mimeType = '';
			}
			$allowedMimes[$key] = $mimeType;
		}
		return array('allowedMimes' => $allowedMimes , 'allowedVideo' => $allowedVideo, 'allowedAudio' => $allowedAudio, 'allowedDoc' => $allowedDoc, 'allowedImage' => $allowedImage);
	}
}

function SqbCheckFileAllowedWp($file, $base_path, $allowedMimes, $fileNameArr, $fileUrlArr, $filePathArr, $file_upload_settings, $max_file_upload_size){
	$error = '';
	$success = false;
			$allowed_file_upload_types = "Sorry, this file extension is not supported.";
			$file_upload_max_size = "Sorry this file exceeds the allowed file size limit.";
			
			$fileInfo = wp_check_filetype(basename($file['name']));
			
			if (!empty($fileInfo['ext'])) {
				if (!empty($fileInfo['type'])) {
					$fileType = SqbGetFileType($file, $fileInfo['ext']);
					/*if($fileType == 'image'){
						if (!@getimagesize($file['tmp_name'])){
							return false;	
						}
					}else{*/
					
					if($fileType != ''){
						$uploadInfo = wp_handle_upload($file, array(
							'test_form' => false,
							'mimes'     => $allowedMimes,
						));	
						
						if(isset($uploadInfo) && isset($uploadInfo['error']) && $uploadInfo['error'] != ''){
							$error = $allowed_file_upload_types;
							
						}else{
							
							$success = true;	
							$fileNameArr[] = $file['name'];
							$fileUrlArr[] = $uploadInfo['url'];
						}
					}else{
						$error = $allowed_file_upload_types;	
					}	
				}else{
					$error = $allowed_file_upload_types;
				}
				// This file is valid
			} else {
				// Invalid file
				$error = $allowed_file_upload_types;
			}
		$result = array('error' => $error, 'success' => $success, 'fileNameArr' => $fileNameArr, 'fileUrlArr' => $fileUrlArr, 'filePathArr' =>$filePathArr );
	return $result;
}

function SqbGetFileType($file, $ext){	
	if (function_exists('finfo_open')) {
		$finfo = finfo_open(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension
		$mime = finfo_file($finfo, $file['tmp_name']);
	}
	
    if(isset($mime)) {

		$mimeArr = explode('/', $mime);
		if(is_array($mimeArr) && isset($mimeArr[1])){
			if($ext == 'jpg'){
				$ext = 'jpeg';	
			}
			/*if($ext != $mimeArr[1]){
				return null;	
			}*/	
		}
		
		
		
		if (strstr($mime, 'image/')) {
			return 'image';
		} else if (strstr($mime, 'video/')) {
			return 'video';
		} else if (strstr($mime, 'audio/')) {
			return 'audio';
		} else if (strstr($mime, 'application/')) {
			return 'application';
		} /*else if (strstr($mime, 'text/')) {
			return 'application';
		}*/ else {
			return null;
		}
    }
}



add_action('wp_ajax_sqb_save_question_file_upload', 'SqbSaveQuestionFileUploadAjax');  
add_action('wp_ajax_nopriv_sqb_save_question_file_upload', 'SqbSaveQuestionFileUploadAjax');  
function SqbSaveQuestionFileUploadAjax(){
	
	$output['message'] = 'success';
	$sqbquestionobj =  SQB_QuizQuestionBank::loadById($_POST['question_id']);
	
	if($sqbquestionobj){
		
		$file_upload_setting = $sqbquestionobj->getFileUploadSettings();
		$settings_value = array_filter(explode(",",str_replace("|",",", $file_upload_setting)));
		$max_file_upload_size = array_pop($settings_value);
		$file_upload_settings = implode(",",$settings_value);
		$max_file_upload = $max_file_upload_size*1000000;
		
		$allowedMimesData = SqbGetAllowedMimes($file_upload_settings);
		if(isset($allowedMimesData)){
			$allowedMimes = $allowedMimesData['allowedMimes'];	
			$allowedImage = $allowedMimesData['allowedImage'];
			$allowedDoc = $allowedMimesData['allowedDoc'];	
			$allowedAudio = $allowedMimesData['allowedAudio'];	
			$allowedVideo = $allowedMimesData['allowedVideo'];	
		}
		
		$fileNameArr = array();
		$fileUrlArr = array();
		$filePathArr = array();
		$error = '';
		$base_path = '';
		//first check if file type is allowed by wp 
		$file = !empty($_FILES['file']) ? $_FILES['file'] : '';
		$result = SqbCheckFileAllowedWp($file, $base_path, @$allowedMimes, $fileNameArr, $fileUrlArr, $filePathArr, $file_upload_settings,$max_file_upload_size);
		
		if(is_array($result)){
					$fileStatus = false;
					$error = $result['error'];
					if($error == ''){
						$fileStatus = true;
						$fileNameArr = $result['fileNameArr'];
						$fileUrlArr = $result['fileUrlArr'];
						$filePathArr = $result['filePathArr'];
					}else{
						/*$allowedTypesOfFileHidden = array_filter($allowedTypesOfFileHidden);
						$strallowedTypesOfFileHidden = implode(', ' , $allowedTypesOfFileHidden);
						$error = str_replace( '%%ALLOWED_FILES%%',$strallowedTypesOfFileHidden, $error);*/ 
						//break;	
					}
				}
				
		$output = array('fileStatus' => $fileStatus, 'error' => $error, 'fileNameArr' => $fileNameArr, 'fileUrlArr' => $fileUrlArr, 'filePathArr' => $filePathArr);
		echo stripslashes(json_encode($output));
		die;
	}
}

add_action('wp_ajax_sqb_save_question_answer_report', 'SqbSaveQuestionAnswerReportAjax');  
add_action('wp_ajax_nopriv_sqb_save_question_answer_report', 'SqbSaveQuestionAnswerReportAjax');

function SqbSaveQuestionAnswerReportAjax(){
	
	if(isset($_POST['quiz_id']) && isset($_POST['question_id']) && isset($_POST['answer_id'])){
		
		$quiz_id = $_POST['quiz_id'];
		$question_id = $_POST['question_id'];
		$answer_id = $_POST['answer_id'];
		$outcome_id = $_POST['outcome_id'];
		$other_field = !empty($_POST['other_field']) ? $_POST['other_field'] : '';
		$today_date = date('Y-m-d');
		$answered ='_';
		$visit  = 1;

		$obj = new SQB_QuestionAnswerReport();
		$obj->setQuizId($quiz_id);
		$obj->setQuestionId($question_id);
		$obj->setAnswerId($answer_id);
		$obj->setVisited($visit);
		$obj->setAnswered($answered);
		$obj->setOutcomeId($outcome_id);
		$obj->setOtherField($other_field);
		$obj->setDate($today_date);

		if(!empty($_REQUEST['report_id'])){
			$curr_report = SQB_QuestionAnswerReport::loadById($_REQUEST['report_id']);
			$obj->setId($_REQUEST['report_id']);
			$last_id = $obj->update();
			//$last_id = $curr_report->getId();
		}else{
			$last_id = $obj->create();
		}
		
				
		
		$output['success'] = 'Saved';	
		$output['last_id'] = $last_id;	
		
		if($answer_id > 0){
			$event_name = 'Answered';
			$event_name = 'Track Custom';  
			$returndata = sqbFbTrackData($quiz_id , $question_id, $answer_id , $event_name, 'fb');
			$output['returndata'] = $returndata;
		}else{
			$event_name = 'View Question';
			$event_name = 'Track Custom';
			$returndata = sqbFbTrackData($quiz_id , $question_id, 0 , $event_name, 'fb');
			$output['returndata'] = $returndata;
		}
		
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	//ob_clean();
	echo json_encode($output);die;
	
}




add_action('wp_ajax_sqb_social_share_load_data_by_quiz_id', 'SqbSocialShareLoadDataByQuizIdAjax');
add_action('wp_ajax_nopriv_sqb_social_share_load_data_by_quiz_id', 'SqbSocialShareLoadDataByQuizIdAjax');

function SqbSocialShareLoadDataByQuizIdAjax_rename(){
	
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
				if($quiz_type == 'scoring'){
					$share_title = 'I got a score of %%YOURSCORE%% out of %%TOTALSCORE%% - %%QUIZTITLE%%.';
				}else if( $quiz_type == 'assessment')  {
					$share_title = 'I got %%CORRECTANSWERS%% correct answers out of %%TOTALQUESTIONS%% - %%QUIZTITLE%%.';
				}else{
					$share_title = 'I got %%OUTCOMETITLE%% - %%QUIZTITLE%%.';
				}
				$template_obj = SQB_QuizTemplate::checkByQuizIdHas($quiz_id);
				if($template_obj){
					$output['start_template'] =   $template_obj->getQuizStartTemplateHtml();
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


add_action('wp_ajax_sqb_save_social_share', 'SqbSaveSocialShareAjax');
add_action('wp_ajax_nopriv_sqb_save_social_share', 'SqbSaveSocialShareAjax');

function SqbSaveSocialShareAjax_rename(){
	
	
	if(isset($_POST['quiz_id'])){
		
		$output['date'] = $_POST;
		$quiz_id = $_POST['quiz_id'];
		$show_social_share_btn = $_POST['show_social_share_btn'];
		$share_text = $_POST['share_text'];
		$fb_share_details = urldecode($_POST['fb_share_details']);
		$tw_share_details = urldecode($_POST['tw_share_details']);
		$share_image_value = $_POST['share_image_value'];
		$share_url = $_POST['share_url'];
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

/**funnel save functions start*/

add_action('wp_ajax_sqb_save_funnel_quiz_data', 'sqbSaveFunnelQuizData');
add_action('wp_ajax_nopriv_sqb_save_funnel_quiz_data', 'sqbSaveFunnelQuizData');


add_action('wp_ajax_sqb_load_reports_data', 'sqbLoadReportsData');
add_action('wp_ajax_nopriv_sqb_load_reports_data', 'sqbLoadReportsData');

function sqbLoadReportsData(){
	
	if($_POST['operationName'] == 'sqb_get_reports_details'){
		
		$post_quiz_id = $_POST['quiz_id'];
		$group_by = $_POST['group_by'];
		
		if(!isset($_POST['quiz_id']) || $post_quiz_id == 'all_quiz' ){
			$post_quiz_id = '';
		}
		
		
		if($_POST['statsType'] == 'today'){
			$start_date = date('Y-m-d'); 
			$end_date = date('Y-m-d');
			$groupData = 'day';
		}else if($_POST['statsType'] == 'yesterday'){
			$end_date = $start_date = date('Y-m-d', strtotime("-1 day")); 
			//$end_date = date('Y-m-d');
			$groupData = 'day';
		}else if($_POST['statsType'] == 'last_month'){
			$previous_month = strtotime("first day of previous month");
			$last_day_month = strtotime("last day of previous month");
			
			$month = date('m' , $previous_month);
			$year = date('Y' , $previous_month);
			$start_date = date('Y-m-d' , $previous_month);
			$end_date = date('Y-m-d' , $last_day_month);
			
			$groupData = 'day';
		}else if($_POST['statsType'] == 'last_seven_days'){
			$end_date = date('Y-m-d');
			$start_date = date('Y-m-d', strtotime("-6 day"));
			$groupData = 'day';
		}else if($_POST['statsType'] == 'last_week'){
			$previous_week = strtotime("last sunday -6 days");
			$start_date = date('Y-m-d' , $previous_week);
			$end_date = strtotime(date("Y-m-d",$previous_week)." +6 days");
			$end_date = date('Y-m-d', $end_date);
			$groupData = 'day';
		}else if($_POST['statsType'] == 'last_three_month'){
			$months = array();
			for ($i = 3; $i >= 1; $i--) 
			{
			   $months[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
			}
			
			
			if(isset($months)){
				$start_date = $months[0];	
				$end_date = strtotime("last day of previous month");
				$end_date = date('Y-m-d' , $end_date);
			}
			$groupData = $_POST['groupType'];
		}else if($_POST['statsType'] == 'last_six_month'){
			$months = array();
			for ($i = 6; $i >= 1; $i--) 
			{
			   $months[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
			}
			
			
			if(isset($months)){
				$start_date = $months[0];	
				$end_date = strtotime("last day of previous month");
				$end_date = date('Y-m-d' , $end_date);
			}
			$groupData = $_POST['groupType'];
		}else if($_POST['statsType'] == 'last_year'){
			$months = array();
			for ($i = 12; $i >= 1; $i--) 
			{
			   $months[] = date("Y-m-d", strtotime( date( 'Y-m-01' )." -$i months"));
			}
			
			
			if(isset($months)){
				$start_date = $months[0];	
				$last_year = date("Y",strtotime("-1 year")); 
				
				$end_date = $last_year.'-12-31';
			}
			$groupData = $_POST['groupType'];
		}else if($_POST['statsType'] == 'all_time'){
			$start_date = ''; 	
			$end_date = '';
			$groupData = 'year';
			$graphCheck = 'yes';
		}else if($_POST['statsType'] == 'custom_range'){
			$start_date = $_POST['reports_start_date']; 	
			$end_date = $_POST['reports_end_date'];
			
			$diff = strtotime($end_date)-strtotime($start_date);
			$days = abs(round($diff / 86400));
			
			if($days < 30){
				 $_POST['groupType'] = $groupData = 'day';	
			}else if($days > 30 && $days <= 365){
				 $_POST['groupType'] = $groupData = 'month';	
			}else if($days > 365){
				 $_POST['groupType'] = $groupData = 'year';		
			}	
			
			
			$start_date = date("Y-m-d", strtotime($start_date));
			$end_date = date("Y-m-d", strtotime($end_date));
			$output['end_date'] = $end_date;	
		}
		
		
		$total_visit = 0;
		$total_click = 0;
		$total_completed = 0;
		$total_opted_in = 0;
		$total_reached_outcome = 0;
		$total_clicked_on_outcome_CTA = 0;
		$table_tr = '';
		 
		$reportsArray = SQB_Reports::loadByDateAndQuizId(sqb_get_date_fl($start_date,'Y-m-d'), $post_quiz_id, sqb_get_date_fl($end_date));
		
		
		$data_group_by_ipaddress_array = array();
		$data_output_array = array();
		if(is_array($reportsArray) && count($reportsArray) > 0 ){
		foreach($reportsArray as $reportArray){
				$ty = $reportArray['ty']; 
				$tm = $reportArray['tm'];
				$page_id = $reportArray['page_id'];
				$quiz_id = $reportArray['quiz_id'];
				$date = $reportArray['date'];
				
				if($group_by == 'month'){
					$data_array_key = $ty.'_'.$tm.'_'.$page_id.'_'.$quiz_id;
					
				}else if($group_by == 'day'){
					
					$data_array_key = $date.'_'.$page_id.'_'.$quiz_id;
					
				}else if($group_by == 'year'){
					
					$data_array_key = $ty.'_'.$page_id.'_'.$quiz_id;
					
				}else if($group_by == 'all'){
					
					$data_array_key = $page_id.'_'.$quiz_id;
				}
				
				
				
				$data_output_array[$data_array_key]['quiz_id'] = $reportArray['quiz_id'];
				$data_output_array[$data_array_key]['page_id'] = $reportArray['page_id'];
				$data_output_array[$data_array_key]['external_url'] = $reportArray['external_url'];
				$data_output_array[$data_array_key]['visits_total'] = isset($data_output_array[$data_array_key]['visits_total']) ? $data_output_array[$data_array_key]['visits_total'] : 0;
				$data_output_array[$data_array_key]['visits_total'] +=  $reportArray['visits_total'];
				$data_output_array[$data_array_key]['ip_address_total'] = $reportArray['ip_address_total'];
				$data_output_array[$data_array_key]['clicks_total'] = $reportArray['clicks_total'];
				$data_output_array[$data_array_key]['completed_total'] = $reportArray['completed_total'];

				$data_output_array[$data_array_key]['opted_in_total'] = isset($data_output_array[$data_array_key]['opted_in_total']) ? $data_output_array[$data_array_key]['opted_in_total'] : 0;

				$data_output_array[$data_array_key]['opted_in_total'] += $reportArray['opted_in_total'];
				$data_output_array[$data_array_key]['reached_outcome_total'] = $reportArray['reached_outcome_total'];
				$data_output_array[$data_array_key]['clicked_on_outcome_CTA_total'] = $reportArray['clicked_on_outcome_CTA_total'];
				
			
		
		}// foreach loop closed
	}
		
	    $table_html = '';
		
		if($group_by == 'all'){
			foreach($data_output_array as $key =>$data_output_array_values){
				
				$date = '';
				if(isset($data_output_array_values['date'])){
					$date = $data_output_array_values['date'];
				}
				
				$quiz_name = '';
				if(isset($data_output_array_values['quiz_name'])){
					$quiz_name = $data_output_array_values['quiz_name'];
				}
				
				$page_id = '';
				if(isset($data_output_array_values['page_id'])){
					$page_id = $data_output_array_values['page_id'];
				}
				
				$unique_visits = 0;
				if(isset($data_output_array_values['ip_address_total'])){
					$unique_visits = $data_output_array_values['ip_address_total'];
				}
				
				$visits = '';
				if(isset($data_output_array_values['visits_total'])){
					$visits = $data_output_array_values['visits_total'];
				}
				
				$clicks = '';
				if(isset($data_output_array_values['clicks_total'])){
					$clicks = $data_output_array_values['clicks_total'];
				}
				
				$completed = '';
				if(isset($data_output_array_values['completed_total'])){
					$completed = $data_output_array_values['completed_total'];
				}
				
				$opted_in = '';
				if(isset($data_output_array_values['opted_in_total'])){
					$opted_in = $data_output_array_values['opted_in_total'];
				}
				
				$reached_outcome = '';
				if(isset($data_output_array_values['reached_outcome_total'])){
					$reached_outcome = $data_output_array_values['reached_outcome_total'];
				}
				
				$clicked_on_outcome_CTA = '';
				if(isset($data_output_array_values['clicked_on_outcome_CTA_total'])){
						$clicked_on_outcome_CTA = $data_output_array_values['clicked_on_outcome_CTA_total'];
				}
				
				$page_id = '';
				if(isset($data_output_array_values['page_id'])){
						$page_id =  $data_output_array_values['page_id'];
				}
				
				$quiz_id = '';
				if(isset($data_output_array_values['quiz_id'])){
						$quiz_id =  $data_output_array_values['quiz_id'];
				}
				
				
				$quiz_name = '';
				$quiz_obj = SQB_Quiz::loadById($quiz_id);
				if($quiz_obj){
					$quiz_name = $quiz_obj->getQuizName();
				}	
				
				
				
				$pagee_slug = $slug = get_post_field( 'post_name', $page_id );
				
				if(!empty($page_id)){
					$page_url = get_page_link($page_id);
				}else{
					$page_url = '';
				}
			
				$qar_page_link = '<a href="'.admin_url('admin.php?page=sqb_question_answer_report').'&quiz_id='.$quiz_id.'" target="_blank"  class="" style="color: #212529;">'.$quiz_name.'</a>';								   
				$table_tr .='<tr>' ;
				if(!empty($data_output_array_values['external_url']) && $post_quiz_id == ''){
					$table_tr .='<td class="text-left" >Embed</td>';
				}else{
					$table_tr .='<td class="text-left" ><a href="'.$page_url.'" title="'.$page_url.'">/'.$pagee_slug.'</a></td>';
				}
				$table_tr .='<td class="text-left" ><div class="d-flex justify-content-between">'.$qar_page_link.'</div></td>';
				$table_tr .='<td>'. $visits.'</td>';
				$table_tr .='<td>'. $unique_visits.'</td>';
				$table_tr .='<td>'. $clicks.'</td>';
				$table_tr .='<td>'. $completed.'</td>';
				$table_tr .='<td>'. $opted_in.'</td>';
				$table_tr .='<td>'. $reached_outcome.'</td>';
				$table_tr .='<td>'. $clicked_on_outcome_CTA.'</td>';
				$table_tr .='</tr>' ;
				
				// total visit override 
				$total_visit = (int)$total_visit + (int)$visits;
				$total_click = (int)$total_click + (int)$clicks;
				$total_completed = (int)$total_completed + (int)$completed;
				$total_opted_in = (int)$total_opted_in + (int)$opted_in;
			
				$total_reached_outcome = (int)$total_reached_outcome + (int)$reached_outcome;
					
				$total_clicked_on_outcome_CTA = (int)$total_clicked_on_outcome_CTA + (int)$clicked_on_outcome_CTA;
				
					
				
			}// for each loop closed
			$table_html .= '<table class="table table-bordered mb-0" style="text-align: center;">
					<thead>
						<tr>
							
							<th class="text-left">Page URL</th>
							<th class="text-left" style="width: 340px;">Name</th>
							<th>Visits</th>
							<th>Unique Visits</th>
							<th>Clicks</th>
							<th>Completed</th>
							<th>Opted-In</th>
							<th style="white-space: nowrap;">Reached Outcome</th>
							<th>Outcome CTA</th>
							
						</tr>
					</thead>
					<tbody id="overall_totals_table_outer">';
						
						if($table_tr == ''){
						$table_tr = '<div class="alert alert-danger" role="alert">Sorry, no data found</div>';
						}
						
						
					$table_html .= $table_tr.'</tbody>';
				$table_html .= '</table>';
			
			
			
			
			$output['table_html'] = $table_html;
			
			$output['group_action'] = 'all';		
		}else{
			
			$data_output_array_new = array();
			foreach($data_output_array as $key =>$data_output_array_values){
				
				$quiz_id =  $data_output_array_values['quiz_id'];
				$data_output_array_new[$quiz_id][] = $data_output_array_values;
			}
		 
			$output['data_output_array_new'] = $data_output_array_new;	
		   
			foreach($data_output_array_new as $key =>$data_output_array_new_values){
				$table_tr = '';
				foreach($data_output_array_new_values as $key =>$data_output_array_new_value){
					
					
					$date = '';
					if(isset($data_output_array_new_value['date'])){
							$date = $data_output_array_new_value['date'];
					}
					$quiz_name = '';
					if(isset($data_output_array_new_value['quiz_name'])){
							$quiz_name = $data_output_array_new_value['quiz_name'];
					}
					$page_id = '';
					if(isset($data_output_array_new_value['page_id'])){
							$page_id = $data_output_array_new_value['page_id'];
					}
					
					$unique_visits = '';
					if(isset($data_output_array_new_value['unique_visits_total'])){
							$unique_visits = count($data_output_array_new_value['unique_visits_total']);
					}
					
					$visits = '';
					if(isset($data_output_array_new_value['visits_total'])){
							$visits = $data_output_array_new_value['visits_total'];
					}
					
					$clicks = '';
					if(isset($data_output_array_new_value['clicks_total'])){
						$clicks = $data_output_array_new_value['clicks_total'];
					}
					
					$completed = '';
					if(isset($data_output_array_new_value['completed_total'])){
						$completed = $data_output_array_new_value['completed_total'];
					}
					
					$opted_in = '';
					if(isset($data_output_array_new_value['opted_in_total'])){
						$opted_in = $data_output_array_new_value['opted_in_total'];
					}
					
					$reached_outcome = '';
					if(isset($data_output_array_new_value['reached_outcome_total'])){
						$reached_outcome = $data_output_array_new_value['reached_outcome_total'];
					}
					
					$clicked_on_outcome_CTA = '';
					if(isset($data_output_array_new_value['clicked_on_outcome_CTA_total'])){
						$clicked_on_outcome_CTA = $data_output_array_new_value['clicked_on_outcome_CTA_total'];
					}
					
					$page_id = '';
					if(isset($data_output_array_new_value['page_id'])){
						$page_id =  $data_output_array_new_value['page_id'];
					}
					
					$quiz_id = '';
					if(isset($data_output_array_new_value['quiz_id'])){
						$quiz_id =  $data_output_array_new_value['quiz_id'];
					}
					
					
					$quiz_name = '';
					$quiz_obj = SQB_Quiz::loadById($quiz_id);
					if($quiz_obj){
						$quiz_name = $quiz_obj->getQuizName();
					}	
					
					
					
					$pagee_slug = $slug = get_post_field( 'post_name', $page_id );

					if(!empty($page_id)){
						$page_url = get_page_link($page_id);
					}else{
						$page_url = '';
					}
				
					
					$table_tr .='<tr>' ;
					$table_tr .='<td class="text-left" ><a href="'.$page_url.'" title="'.$page_url.'">/'.$pagee_slug.'</a></td>';
					$table_tr .='<td>'. $visits.'</td>';
					$table_tr .='<td>'. $unique_visits.'</td>';
					$table_tr .='<td>'. $clicks.'</td>';
					$table_tr .='<td>'. $completed.'</td>';
					$table_tr .='<td>'. $opted_in.'</td>';
					$table_tr .='<td>'. $reached_outcome.'</td>';
					$table_tr .='<td>'. $clicked_on_outcome_CTA.'</td>';
					$table_tr .='</tr>' ;
					
					// total visit override 
					$total_visit = (int)$total_visit + (int)$visits;
					$total_click = (int)$total_click + (int)$clicks;
					$total_completed = (int)$total_completed + (int)$completed;
					$total_opted_in = (int)$total_opted_in + (int)$opted_in;
					$total_reached_outcome = (int)$total_reached_outcome + (int)$reached_outcome;
					$total_clicked_on_outcome_CTA = (int)$total_clicked_on_outcome_CTA + (int)$clicked_on_outcome_CTA;
					
					
				}// for each loop closed 
				$qar_page_link = '<a href="'.admin_url('admin.php?page=sqb_question_answer_report').'&quiz_id='.$quiz_id.'" target="_blank"  class="view_details_qar btn sqb_transprent_btn">Click View Details</a>';								   
				$table_html .= '<h5 class="quiz--sub-title">Quiz Name: '.stripslashes($quiz_name).$qar_page_link.'</h5><table class="table table-bordered mb-0" style="text-align: center;">
					<thead>
						<tr>
							
							<th class="text-left">Page URL</th>
							
							<th># Visits</th>
							<th># Unique Visits</th>
							<th># Clicks</th>
							<th>Completed</th>
							<th>Opted-In</th>
							<th style="width: 170px;">Reached Outcome</th>
							<th>Outcome CTA</th>
							
						</tr>
					</thead>
					<tbody id="overall_totals_table_outer">';
						
					$table_html .= $table_tr.'</tbody>';
				$table_html .= '</table>';
				
				
			}// for each loop closed 
			
			if($table_html == ''){
				$table_html = '<div class="alert alert-danger" role="alert">Sorry, no data found</div>';
			}
			
			$output['table_html'] = $table_html;
			$output['group_action'] = 'not_all';		
		}
		
		$output['success'] = 'success';	
		$output['data_output_array'] = $data_output_array;	
		$output['start_date'] = $start_date;	
		$output['post_quiz_id'] = $post_quiz_id;	
		$output['table_tr'] = $table_tr;	
		$output['total_visit'] = $total_visit;	
		$output['total_click'] = $total_click;	
		$output['total_completed'] = $total_completed;	
		$output['total_opted_in'] = $total_opted_in;	
		$output['total_reached_outcome'] = $total_reached_outcome;	
		$output['total_clicked_on_outcome_CTA'] = $total_clicked_on_outcome_CTA;	
		$output['start_date'] = $start_date;	
		$output['reportsArray'] = $reportsArray;	
		
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
	
	
	
}

add_action('wp_ajax_sqb_empty_stats_table', 'sqb_empty_stats_table');
add_action('wp_ajax_nopriv_sqb_empty_stats_table', 'sqb_empty_stats_table');

function sqb_empty_stats_table(){
	$quiz_id = $_POST['quiz_id'];
	if($quiz_id == 'all_quiz'){
		SQB_Reports::delete();
	} else {
		SQB_Reports::deleteByQuizId($quiz_id);
	}
	echo json_encode($output);die;
}


function SqbGetAllTimeReportsAndEndDate(){
		$totalReportsDataDateObj = SQB_Reports::getOneData();
		if(isset($totalReportsDataDateObj)){
			$totalReportsDataDate = $totalReportsDataDateObj->getDate();
		}
		
		$fianlStartDate = $start_date = $totalReportsDataDate;
		
		$dateTime = new DateTime($start_date);
		
		$start_date = $dateTime->format('Y-m-d');
		
		$startdate = strtotime($start_date);
		$enddate = strtotime(date('Y-m-d'));
		$diff = $enddate - $startdate;
		$days = $diff / 86400;
		
		$days = round($days);
		$group_by = '';
		if($days < 30 ){
			$group_by = 'day';	
		}else if($days > 30 && $days < 365){
			$group_by = 'month';			
		}else if($days > 365){
			$group_by = 'year';			
		}
		$order = 'ASC';	
		
		$start_date = $fianlStartDate;
		$end_date = date('Y-m-d');	
		
		return array('start_date'=> $start_date , 'end_date' => $end_date,'group_by'=>$group_by);
	}



function sqbSaveFunnelQuizData($form_data = ''){
	
	if($form_data !="" && is_array($form_data)){
	
		$_POST = $form_data;
	}
	
	if(isset($_POST['data_export']) && isset($_POST['quiz_id'])){
		$data_export = $_POST['data_export']; 
		$data_export_array = ''; 
		if(isset($_POST['data_export_array'])){
			$data_export_array = $_POST['data_export_array']; 
		}
		
		$dateTime = date('Y-m-d h:i:s');
		
		
		$quiz_id = $_POST['quiz_id'];	
			
		$output['quiz_id'] = $_POST['quiz_id'];	
		$output['success'] = 'Save successfully';
		
		
		$obj = new SQB_Funnel();
		$obj->setFunnelData($data_export);
		$obj->setQuizId($quiz_id);
		$obj->setDate($dateTime);
		
		$obj_exists = SQB_Funnel::loadByQuizId($quiz_id);	
		
		if($obj_exists){
			
			$obj->setId($obj_exists->getId());
			$funnel_id = $obj->update();
			$output['database_action'] = 'update';
		}else{
			$funnel_id = $obj->create();
			$output['database_action'] = 'create';
		}
		
		$quizObj = SQB_Quiz::loadById($quiz_id);
		if($quizObj){
			$new_quiz_obj = new SQB_Quiz();
			if(isset($_POST['funnel_enable_branching'])){
				$funnel_enable_branching = $_POST['funnel_enable_branching'];
				$new_quiz_obj->setEnableBranching($funnel_enable_branching);
				$new_quiz_obj->setId($quiz_id);
				$new_quiz_obj->updateBranchingStatus();
				$output['funnel_enable_branching'] = $funnel_enable_branching;	
			}	
		}
		
		$output['success'] = 'Save Successfully';	
		$output['funnel_id'] = $funnel_id;	
		
		
		$funnel_parent_node = 0;
		//insert values for funnel node 
		if(0 && is_array($data_export_array) && isset($data_export_array['drawflow'])){
			
			if(isset($data_export_array['drawflow']['Home']['data'])){
				$funnel_array_data_list = $data_export_array['drawflow']['Home']['data'];
				$funnel_ids_array = array();
				$outputs_arraay = array();
				$funnel_level = 0;
				foreach($funnel_array_data_list as $funnel_array_data){
						
						
					    $ques_id = $funnel_array_data['id'];
					   
					   
					    if(isset($funnel_array_data['outputs'])){
							$outputs = $funnel_array_data['outputs'];
						
							foreach($outputs as $output_array){
								
								if(isset($output_array['connections']) && (count($output_array['connections']) == 2)){
									
									$parent_ans = 0;
									$funnel_node_obj  = new SQB_FunnelNodes();
									$funnel_node_obj->setFunnelId($funnel_id);
									$funnel_node_obj->setQuesId($ques_id);
									$funnel_node_obj->setParentNodeId($funnel_parent_node);
									$funnel_node_obj->setLevel($funnel_level);
									$funnel_node_obj->setParentAns($parent_ans);
									$funnel_node_obj->setDate($dateTime);
									$node_exists  = SQB_FunnelNodes::loadByFunnelIdAndAndQuestionIdAndParentAnsId($funnel_id,$ques_id,$parent_ans);
									if(isset($node_exists)){
										$funnel_node_obj->setNodeId($node_exists->getNodeId());
										$funnel_node_obj->setLevel($node_exists->getLevel());
										$funnel_node_id = $funnel_node_obj->update();
										$funnel_level = $node_exists->getLevel() + 1;
									}else{
										
										$node_exists = SQB_FunnelNodes::loadByFunnelIdAndAndQuestionId($funnel_id,$ques_id);
										if(isset($node_exists)){
											$funnel_level = $node_exists->getLevel() + 1;
										}else{
											$funnel_node_id =  $funnel_node_obj->create();
											$funnel_level = 1;
										}
										
									}
									$funnel_ids_array[] = $funnel_node_id;
									$outputs_arraay[] =  $node_exists;
									
									$parent_ans = $output_array['connections'][0]['node'];
									$next_question_id = $output_array['connections'][1]['node'];
									
									$funnel_node_obj  = new SQB_FunnelNodes();
									$funnel_node_obj->setFunnelId($funnel_id);
									$funnel_node_obj->setLevel($funnel_level);
									$funnel_node_obj->setQuesId($next_question_id);
									$funnel_node_obj->setParentNodeId($funnel_node_id);
									$funnel_node_obj->setParentAns($parent_ans);
										$funnel_node_obj->setDate($dateTime);
									$node_exists  = SQB_FunnelNodes::loadByFunnelIdAndAndQuestionIdAndParentAnsId($funnel_id,$next_question_id,$parent_ans);
									
									if(isset($node_exists)){
										$funnel_node_obj->setNodeId($node_exists->getNodeId());
										$funnel_node_obj->setLevel($node_exists->getLevel());
										$funnel_node_id = $funnel_node_obj->update();
									}else{
										$funnel_node_id =  $funnel_node_obj->create();
									}
									$funnel_ids_array[] = $funnel_node_id;
								}
							}
							  
							
							
						}
				}// for loop closed
				
				$load_all_rows = SQB_FunnelNodes::loadByFunnelId($funnel_id);
				$old_list_rows = array();
				foreach($load_all_rows as $load_all_row){
					$old_list_rows[] = $load_all_row->getNodeId();
				}
				// delete rows 
				$delete_array_list = array_diff($old_list_rows,$funnel_ids_array);
				foreach($delete_array_list as $delete_id){
					SQB_FunnelNodes::DeleteById($delete_id);
					$output['delete_id'][]  = $delete_id;
				}
				
				
				$output['funnel_ids_array'] = $funnel_ids_array;
				$output['outputs_arraay'] = $outputs_arraay;
				$output['old_list_rows'] = $old_list_rows;
				$output['funnel_id'] = $funnel_id;
				
			}
		}
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	if($form_data !="" && is_array($form_data)){
		return $output;
	}
	
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_save_funnel_name', 'sqb_save_funnel_name');
add_action('wp_ajax_nopriv_sqb_save_funnel_name', 'sqb_save_funnel_name');

function sqb_save_funnel_name(){
	$name =  $_POST['name'];
	
	$funnelDetails = new SQB_Funnel();
	
	$funnelDetails->setFunnelName($name);
	
	$id = $funnelDetails->create();
	
	$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/template1/template1.php");			
	$csspath =  plugin_dir_url(__FILE__)."../templates/start/template1/template1.css";			
	$file = file_get_contents($file);
	$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 
	$output = $cssfile.$file;		 
	
	echo json_encode(array('msg' => 'success' , 'id' => $id , 'output' => $output));	die;
}

add_action('wp_ajax_sqb_save_funnel_questions', 'sqb_save_funnel_questions');
add_action('wp_ajax_nopriv_sqb_save_funnel_questions', 'sqb_save_funnel_questions');

function sqb_save_funnel_questions(){
	$questionTitle =  $_POST['questionTitle'];

	$dateTime = date('Y-m-d h:i:s');
	$questionBank = new SQB_QuizQuestionBank();
	
	$questionBank->setQuestion($questionTitle);
	$questionBank->setQuestionType('single');
	$questionBank->setQuestionOrder('1');
	$questionBank->setQuestionImage('');
	$questionBank->setDate($dateTime);
	
	$id = $questionBank->create();
	
	if($id != '' && $id != 0){
		
		$funnelId =  $_POST['funnelId'];
		$level =  $_POST['level'];
		$parentNodeId =  $_POST['parentNodeId'];
		$parentAnswerId =  $_POST['parentAnswerId'];
		
		$funnelNodes = new SQB_FunnelNodes();
		
		$funnelNodes->setFunnelId($funnelId);
		$funnelNodes->setLevel($level);
		$funnelNodes->setQuesId($id);
		$funnelNodes->setParentNodeId($parentNodeId);
		$funnelNodes->setParentAns($parentAnswerId);
		$funnelNodes->setDate($dateTime);
		
		$nodeId = $funnelNodes->create();	
	}
	
	echo json_encode(array('id' => $id , 'nodeId' => $nodeId));die;
 
}

add_action('wp_ajax_sqb_save_funnel_answers', 'sqb_save_funnel_answers');
add_action('wp_ajax_nopriv_sqb_save_funnel_answers', 'sqb_save_funnel_answers');

function sqb_save_funnel_answers(){
	$answers =  $_POST['answers'];

	$dateTime = date('Y-m-d h:i:s');
	$answersObj = new SQB_QuizAnswers();
	
	$answersObj->setAnswer($answers);
	$answersObj->setQuestionId('single');
	$answersObj->setCorrectAnswer('NA');
	$answersObj->setAnswerPoints('0');
	$answersObj->setAnswerHint('0');
	$answersObj->setAnswerInfo('0');
	$answersObj->setAnswerOrder('0');
	$answersObj->setDate($dateTime);
	
	$id = $answersObj->create();
	echo json_encode(array('id' => $id));die;
 
}

add_action('wp_ajax_sqb_save_funnel_templates', 'sqb_save_funnel_templates');
add_action('wp_ajax_nopriv_sqb_save_funnel_templates', 'sqb_save_funnel_templates');

function sqb_save_funnel_templates(){
	$answers =  $_POST['answers'];

	$dateTime = date('Y-m-d h:i:s');
	$answersObj = new SQB_QuizAnswers();
	
	$answersObj->setAnswer($answers);
	$answersObj->setQuestionId('single');
	$answersObj->setCorrectAnswer('NA');
	$answersObj->setAnswerPoints('0');
	$answersObj->setAnswerHint('0');
	$answersObj->setAnswerInfo('0');
	$answersObj->setAnswerOrder('0');
	$answersObj->setDate($dateTime);
	
	$id = $answersObj->create();
	echo json_encode(array('id' => $id));die;
 
}


/**funnel save functions end*/


add_action('wp_ajax_sqb_save_quiz', 'SQBSaveQuizAjax');
add_action('wp_ajax_nopriv_sqb_save_quiz', 'SQBSaveQuizAjax');

/* Save Quiz  */
function SQBSaveQuizAjax($form_data = '',$oneTime = 0){
    
    global $is_come_from_activate_hook;

   	/*if(!empty($is_come_from_activate_hook) && ($form_data['createType'] != "csvimport")) {
	   if ( !current_user_can( 'manage_options' ) ) {
	        return json_encode(array('error' => 'Not allowed to access'));die;  
		}
		check_admin_referer('sqbsavequiz', 'security');
	}*/
    $send_by_browser = true;
    if($form_data !="" && is_array($form_data)){
		$_POST['form_data'] = $form_data;
	  	$send_by_browser = false;
	}
	
	if(isset($_POST['form_data'])){
		
			$data = $_POST['form_data'];
			$date = date('Y-m-d H:i:s');
			$outcome_id=0;
			
			if(isset($data['createType']) && $data['createType'] == 'csvimport'){
				  $send_by_browser = true;
			}
			
			if(isset($data['actionType']) && $data['actionType'] == 'save_quiz'){
			
				$quiz_name = urldecode($data['quiz_name']);
				$quiz_desc = urldecode($data['quiz_desc']);
				$quiz_type = $data['quiz_type'];
				$quiz_display = $data['quiz_display'];
				$quiz_move_question = $data['quiz_move_question'];
				$grade_quiz = $data['grade_quiz'];
				$question_display = $data['question_display'];
				$number_of_question = $data['number_of_question'];
				$quiz_pagination = $data['quiz_pagination'];
				$question_per_page = $data['question_per_page'];
				$result_display_option = $data['result_display_option'];
				$show_start_screen = $data['show_start_screen'];
				$autosubmit_optin = !empty($data['autosubmit_optin']) ? $data['autosubmit_optin'] : 'N';
				$show_result_screen = $data['show_result_screen'];
				$show_opt_screen = $data['show_opt_screen'];
				$show_share_screen = $data['show_share_screen'];
				$popup_type = !empty($data['popup_type']) ? $data['popup_type'] : '';
				$form_url_ids = !empty($data['form_url_ids']) ? $data['form_url_ids'] : '';
				$category_option = $data['category_option'];
				$poll_settings = !empty($data['poll_settings']) ? $data['poll_settings'] : '';
				$all_other_options = !empty($data['all_other_options']) ? $data['all_other_options'] : '';
				$all_background_color = !empty($data['all_background_color']) ? $data['all_background_color'] : '';


				


				$opt_screen_position = '';
				if(isset($data['opt_screen_position'])){
					$opt_screen_position = $data['opt_screen_position'];
				}
				$user_added_platform='';
				if(isset($data['user_added_platform'])){
					$user_added_platform = $data['user_added_platform'];
				}
				$quiz_timer='';
				if(isset($data['quiz_timer'])){
					$quiz_timer = $data['quiz_timer'];
				}

				$show_firstname_outcome='Y';
				if(isset($data['show_firstname_outcome'])){
					$show_firstname_outcome = $data['show_firstname_outcome'];
				}
				$quiz_timer_limit='';
				if(isset($data['quiz_timer_limit'])){
					$quiz_timer_limit = $data['quiz_timer_limit'];
				}
				
				if(is_array($user_added_platform)){
					$user_added_platform = implode(",",$user_added_platform);
				}
				$add_user_in_your_email_platform='';
				if(isset($data['add_user_in_your_email_platform'])){		
					$add_user_in_your_email_platform = $data['add_user_in_your_email_platform'];
					if(is_array($add_user_in_your_email_platform)){
						$add_user_in_your_email_platform = implode(",",$add_user_in_your_email_platform);
					}
				}
				
				$template_display_sequence = $data['template_display_sequence'];
				if(is_array($template_display_sequence)){
					$template_display_sequence = implode(",",$template_display_sequence);
				}		
				
				$progress_bar='';
				if(isset($data['progress_bar'])){
					$progress_bar = $data['progress_bar'];
				}
				$quiz_passmark='';
				if(isset($data['quiz_passmark'])){
					$quiz_passmark = $data['quiz_passmark'];
				}
				$quiz_attempts_allowed='';
				if(isset($data['quiz_attempts_allowed'])){
					$quiz_attempts_allowed = $data['quiz_attempts_allowed'];
				}
				$show_correct_ans='';
				if(isset($data['show_correct_ans'])){
					$show_correct_ans = $data['show_correct_ans'];
				}
				$show_correct_ans_option='';
				if(isset($data['show_correct_ans_option'])){
					$show_correct_ans_option = $data['show_correct_ans_option'];
				}
				$questions_random='';
				if(isset($data['questions_random'])){
					$questions_random = $data['questions_random'];
				}
				 
				$time_based_input = !empty($data['time_based_input']) ? $data['time_based_input'] : '0';
			 	
				$show_for_notloggedin_user = $data['show_for_notloggedin_user'];
				$answers_random = $data['answers_random'];
				$move_question = $data['move_question'];
				$outcome_type='';
				if(isset($data['outcome_type'])){
					$outcome_type = $data['outcome_type'];
				}
				$outcome_based='';
				if(isset($data['outcome_based'])){
					$outcome_based = $data['outcome_based'];
				}
				$display_correctans_on_page='';
				if(isset($data['display_correctans_on_page'])){
					$display_correctans_on_page = $data['display_correctans_on_page'];
				}
				 
				$outcome_page = $data['outcome_page'];
				$display_score_on_page = $data['display_score_on_page'];
				
				$outcome_display_charts='';
				if(isset($data['outcome_display_charts'])){
					$outcome_display_charts = $data['outcome_display_charts'];
				} 
				
				$display_quesans_on_outcome = $data['display_quesans_on_outcome'];
				$outcome_redirect_url = $data['outcome_redirect_url'];
				$user_opt_in_redirect = $data['user_opt_in_redirect'];
				$user_opt_in_redirect_url='';
				if(isset($data['user_opt_in_redirect_url'])){
					$user_opt_in_redirect_url = $data['user_opt_in_redirect_url'];
				}				
				$enable_branching = $data['enable_branching'];
				$display_correctans_options = $data['display_correctans_options'];
				$show_next_button = $data['show_next_button'];
				$show_back_btn_option = $data['show_back_btn_option'];
				$select_quiz_bank = $data['select_quiz_bank'];
				$quiz_ans_tags = $data['quiz_ans_tags'];
				$limit_questions_displayed = $data['limit_questions_displayed'];
				$limit_input = $data['limit_input'];
				$already_take_the_quiz = $data['already_take_the_quiz'];
				$total_attempts ='0';
				if(isset($data['total_attempts'])){
					$total_attempts = $data['total_attempts'];
				}
				$template = $data['template'];
				$startshowHide_video = $data['startshowHide_video'];
				$video_url = $data['video_url'];
				$quiz_display_url = $data['quiz_display_url'];
				$url_select_popup = !empty($data['url_select_popup']) ? $data['url_select_popup'] : '';
				
				$quiz_display_in_url = !empty($data['quiz_display_in_url']) ? $data['quiz_display_in_url'] : '';
				$quiz_popup_time_delay = $data['quiz_time_delay'];
				$quiz_popup_frequency='';
				if(isset($data['quiz_popup_frequency'])){
					$quiz_popup_frequency = $data['quiz_popup_frequency'];
				} 
				$quiz_popup_position = $data['quiz_popup_position'];
				$quick_email_verification = $data['quick_email_verification'];
				$quiz_slider_animation = $data['quiz_slider_animation'];				 
				$quiz_slider_animation_option='';
				if(isset($data['quiz_slider_animation_option'])){
					$quiz_slider_animation_option = $data['quiz_slider_animation_option'];
				} 
				$transparent_background_settings = '';	
				if(isset($data['transparent_background_settings'])){
					if($data['template_no'] == 'template9'){
						$transparent_background_settings = maybe_serialize($data['transparent_background_settings']);
					}else{
						$transparent_background_settings = $data['transparent_background_settings'];
					}
				} 
				$customizer_styles = $data['customizer_styles'];	
				$enable_background_image = $data['enable_background_image'];
					
				$question_bank_all_data = $select_quiz_bank.'||'.$limit_questions_displayed.'||'.$limit_input;
				
				$customizer_style_setting = '';
				if(isset($data['customizer_style_setting'])){
				$customizer_style_setting = maybe_serialize($data['customizer_style_setting']);
				}
				
				$quiz_category = 'N';
				if(isset($data['quiz_category'])){
					$quiz_category = $data['quiz_category'];
				}	
				

				$id='';
				if(isset($data['id'])){
					$id = $data['id'];
				}
				 	
				//Set variable of class file
				$sqbData = SQB_Quiz::loadById($id);
				if($sqbData && ($id != '') && ($id != 0)){
					
				}else{
					
					$sqbData = new SQB_Quiz();	
					$sqbData->setQuizBlocking('N');	 
					$sqbData->setShowStartScreen($show_start_screen);	
					$sqbData->setQuizAttemptsAllowed($quiz_attempts_allowed);	
					
				}
				
				$pre_built_details = '';
				$pre_built = 'N';
				if(isset($data['pre_built_details'])){
					$pre_built_details = $data['pre_built_details'];
				}
				if(isset($data['pre_built'])){
					$pre_built = $data['pre_built'];
				}
				$weighted_score = 'N';
				if(isset($data['weighted_score'])){
					$weighted_score = $data['weighted_score'];
				}
				
				$quiz_allow_pdf_download_outcome_screen = 'N';
				if(isset($data['quiz_allow_pdf_download_outcome_screen'])){
					$quiz_allow_pdf_download_outcome_screen = $data['quiz_allow_pdf_download_outcome_screen'];
				}

				$game_animation = 'N';
				if(isset($data['game_animation'])){
					$game_animation = $data['game_animation'];
				}
				$sqbData->setGameAnimation($game_animation);

				$game_animation_option  = array();
				$game_animation_template = 'template1';
				if(!empty($data['game_animation_template'])){
					$game_animation_option['template'] = $data['game_animation_template'];
				}
				
				if(!empty($data['game_animation_custom_template'])){
					$game_animation_option['custom_template'] = $data['game_animation_custom_template'];
				}

				if(!empty($data['game_animation_background_color'])){
					$game_animation_option['background_color'] = $data['game_animation_background_color'];
				}

				if(!empty($data['game_animation_audio_url'])){
					$game_animation_option['audio_url'] = $data['game_animation_audio_url'];
				}

				if(!empty($data['game_animation_timer'])){
					$game_animation_option['timer'] = $data['game_animation_timer'];
				}

				if(!empty($data['game_animation_text'])){
					$game_animation_option['text'] = $data['game_animation_text'];
				}

				$game_animation_option['outcome_message'] = 'N';
				if(isset($data['different_message_outcome'])){
					$game_animation_option['outcome_message'] = $data['different_message_outcome'];
				}

				$sqbData->setGameAnimationsOptions(maybe_serialize($game_animation_option));
				

				$sqbData->setWeightedScore($weighted_score);
				$sqbData->setShowDownloadButton($quiz_allow_pdf_download_outcome_screen);
				
				$sqbData->setPreBuilt($pre_built);
				$sqbData->setPreBuiltDetails($pre_built_details);
				
				$sqbData->setQuizName($quiz_name);
				$sqbData->setQuizDesc($quiz_desc);
				$sqbData->setQuizType($quiz_type);
				$sqbData->setQuizDisplay($quiz_display);
				$sqbData->setMoveQuestion($quiz_move_question);				
				$sqbData->setGradeQuiz($grade_quiz);
				$sqbData->setQuestionDisplay($question_display);	
				$sqbData->setNumberOfQuestion($number_of_question);	
				$sqbData->setQuizPagination($quiz_pagination);
				$sqbData->setQuestionPerPage($question_per_page);
				$sqbData->setResultDisplayOption($result_display_option);
				$sqbData->setShowStartScreen($show_start_screen);	
				$sqbData->setShowResultScreen($show_result_screen);	
				$sqbData->setShowOptinScreen($show_opt_screen);
				$sqbData->setShowShareScreen($show_share_screen);
				$sqbData->setOptinScreenPosition($opt_screen_position);		
				$sqbData->setUserAddedMyEmailPlatform($user_added_platform);	
				$sqbData->setUserAddedPlatform($add_user_in_your_email_platform);	
				$sqbData->setTemplateDisplaySequence($template_display_sequence);		 
				$sqbData->setOutcomeType($outcome_type);
				$sqbData->setOutcomeScreen_Display($outcome_based);
				$sqbData->setOutcomePage($outcome_page);
				$sqbData->setDisplayScoreOnPage($display_score_on_page);
				if(($quiz_type == 'assessment') || ($quiz_type == 'scoring') || ($id == '') || ($id == 0)){
					$sqbData->setDisplayCorrectAnsOnPage($display_correctans_on_page);
					$sqbData->setDisplayAnswerOptions($display_correctans_options);	
				}
				$sqbData->setDisplayQuesansOnOutcome($display_quesans_on_outcome);
				$sqbData->setOutcomeRedirectUrl($outcome_redirect_url);				
				$sqbData->setUserOptinRedirect($user_opt_in_redirect);				
				$sqbData->setUserOptinRedirectUrl($user_opt_in_redirect_url);				
				$sqbData->setEnableBranching($enable_branching);				
				$sqbData->setOutcomeScreenChartsSettings($outcome_display_charts);	
				$sqbData->setShowNextButton($show_next_button);	
				$sqbData->setShowBackButton($show_back_btn_option);				
				$sqbData->setQuestionBankOption($question_bank_all_data);				
				$sqbData->setAlreadyTakeTheQuiz($already_take_the_quiz);				
				$sqbData->setAnsTags($quiz_ans_tags);				
				$sqbData->setTotalAttempts($total_attempts);				
				$sqbData->setDate($date);	
				
				$sqbData->setProgressBar($progress_bar);	
				$sqbData->setQuizShowCorrectAnswer($show_correct_ans);	  							
				$sqbData->setTemplate($template);	  
				$sqbData->setShowVideo($startshowHide_video);	  
				$sqbData->setVideoURL(stripslashes($video_url));	  
				
				if($url_select_popup == 'Y'){
					$sqbData->setQuizDisplayUrls($quiz_display_url);
				}
				
				$sqbData->setQuizDisplayInUrls($quiz_display_in_url);
				
				$sqbData->setQuizPopupTimeDelay($quiz_popup_time_delay);
				$sqbData->setQuizPopupFrequency($quiz_popup_frequency);
				$sqbData->setQuizPopupPosition($quiz_popup_position);
				$sqbData->setEmailVerification($quick_email_verification);
				$sqbData->setQuizSliderAnimation($quiz_slider_animation);	
				$sqbData->setQuizSliderAnimationOption($quiz_slider_animation_option);
				$sqbData->setTransparentBackgroundSettings($transparent_background_settings);	
				$sqbData->setCustomizerStyles($customizer_styles);	
				$sqbData->setCategory($quiz_category);
				$sqbData->setCategoryOption($category_option);
				$sqbData->setCustomizerStyleSetting($customizer_style_setting);
				$sqbData->setExitPopupValue($time_based_input);
				$sqbData->setPollSettings(serialize($poll_settings));
				$sqbData->setAllOtherOptions(serialize($all_other_options));

				$sqbData->setAutoSubmitOptin($autosubmit_optin);

				if($autosubmit_optin == 'Y'){
					$sqbData->setQuizShowAnalyzingResult('Y');
				}

				$quiz_recommendation_enable = 'N';
				if($data['quiz_recommendation_enable']){
					$quiz_recommendation_enable = $data['quiz_recommendation_enable'];
				}
				$sqbData->setAnsRecommendation($quiz_recommendation_enable);

				$quiz_ads_enable = 'N';
				if($data['quiz_ads_enable']){
					$quiz_ads_enable = $data['quiz_ads_enable'];
				}
				$sqbData->setQnsAds($quiz_ads_enable);
				
				$quiz_recommendation_next_button_html = '';
				if(isset($data['quiz_recommendation_next_button_html'])){
				$quiz_recommendation_next_button_html = urldecode($data['quiz_recommendation_next_button_html']);
				}
				$sqbData->setRecommendedNextButton($quiz_recommendation_next_button_html);	


				$quiz_ads_next_button_html = '';
				if(isset($data['quiz_ads_next_button_html'])){
				$quiz_ads_next_button_html = urldecode($data['quiz_ads_next_button_html']);
				}
				$sqbData->setAdsNextButton('');	
				$sqbData->setAdsNextButton($quiz_ads_next_button_html);	

				$quiz_outcome_pdf_button_html = '';
				if(isset($data['quiz_outcome_pdf_button_html'])){
				$quiz_outcome_pdf_button_html = urldecode($data['quiz_outcome_pdf_button_html']);
				}
				$sqbData->setDownloadPDFButtonHtml($quiz_outcome_pdf_button_html);	
				
				if(isset($data['sqb_quiz_allow_retake'])){
					$sqbData->setAllowRetake($data['sqb_quiz_allow_retake']);
				}
				
				if(isset($data['sqb_quiz_many_attempts']) && isset($data['sqb_quiz_max_attempts_limit'])){
					$sqbData->setQuizAttemptsAllowed($data['sqb_quiz_many_attempts']);
					if($data['sqb_quiz_many_attempts'] == 'Limited'){
					$sqbData->setTotalAttempts($data['sqb_quiz_max_attempts_limit']);
					}
				}
				$sqbData->setEnableBackgroundImage($enable_background_image);	
				
				$global_setting_style_status = @$data['global_setting_style_status'];
				$sqbData->setSettingLevel($global_setting_style_status);
				
				
				//quiz timer variable
				if(isset($data['quiz_timmer_array'])){
					
					$quiz_timmer_array = $data['quiz_timmer_array'];
					
					$timer_enable = 'N';
					if(isset($quiz_timmer_array['timer_enable'])){
						$timer_enable = $quiz_timmer_array['timer_enable'];
					}
					
					$quiz_timer_hours = '0';
					if(isset($quiz_timmer_array['quiz_timer_hours'])){
						$quiz_timer_hours = $quiz_timmer_array['quiz_timer_hours'];
					}
					
					$quiz_timer_mint = '0';
					if(isset($quiz_timmer_array['quiz_timer_mint'])){
						$quiz_timer_mint = $quiz_timmer_array['quiz_timer_mint'];
					}
					
					$quiz_timer_sec = '0';
					if(isset($quiz_timmer_array['quiz_timer_sec'])){
						$quiz_timer_sec = $quiz_timmer_array['quiz_timer_sec'];
					}
					
					$quiz_timer_html = '';
					if(isset($quiz_timmer_array['quiz_timer_html'])){
						$quiz_timer_html = urldecode($quiz_timmer_array['quiz_timer_html']);
					}
					
					$quiz_timer_spent_html = '';
					if(isset($quiz_timmer_array['quiz_timer_spent_html'])){
						$quiz_timer_spent_html = urldecode($quiz_timmer_array['quiz_timer_spent_html']);
					}
					
					$quiz_timer_elapses_option = '';
					if(isset($quiz_timmer_array['quiz_timer_elapses_option'])){
						$quiz_timer_elapses_option = $quiz_timmer_array['quiz_timer_elapses_option'];
					}
					
					$quiz_timer_display_in_screen = '';
					if(isset($quiz_timmer_array['quiz_timer_display_in_screen'])){
						$quiz_timer_display_in_screen = $quiz_timmer_array['quiz_timer_display_in_screen'];
					}
					
					$quiz_timer_expired_msg = '';
					if(isset($quiz_timmer_array['quiz_timer_expired_msg'])){
						$quiz_timer_expired_msg = urldecode($quiz_timmer_array['quiz_timer_expired_msg']);
					}
					
					$quiz_timer_hour_html = '';
					if(isset($quiz_timmer_array['quiz_timer_hour_html'])){
						$quiz_timer_hour_html = urldecode($quiz_timmer_array['quiz_timer_hour_html']);
					}
					
					$quiz_timer_mint_html = '';
					if(isset($quiz_timmer_array['quiz_timer_mint_html'])){
						$quiz_timer_mint_html = urldecode($quiz_timmer_array['quiz_timer_mint_html']);
					}
					
					$quiz_timer_sec_html = '';
					if(isset($quiz_timmer_array['quiz_timer_sec_html'])){
						$quiz_timer_sec_html = urldecode($quiz_timmer_array['quiz_timer_sec_html']);
					}
					
					$timer_customizer = $timer_enable.'||'.$quiz_timer_hours.'||'.$quiz_timer_mint.'||'.$quiz_timer_sec.'||'.$quiz_timer_elapses_option.'||'.$quiz_timer_display_in_screen; 
					$quiz_timer_html = $quiz_timer_html.'||||'.$quiz_timer_spent_html.'||||'.$quiz_timer_hour_html.'||||'.$quiz_timer_mint_html.'||||'.$quiz_timer_sec_html;
					
					$sqbData->setTimerHtml('');
					$sqbData->setTimerHtml($quiz_timer_html);
					$sqbData->setTimerExpiredMsg($quiz_timer_expired_msg);
					$sqbData->setTimerCustomizer('');					
					$sqbData->setTimerCustomizer($timer_customizer);					
				}		

				$page_id_exist = '';
				if($quiz_type == 'form'){
					/*if($form_url_ids){
						$current_page_ids = explode(',',$form_url_ids); 
						$loadallpageids = SQB_FormQuiz::loadalldata($id);
						$allids = [];
						foreach($loadallpageids as $loadallpageid){
							$page_ids = $loadallpageid->getPageIds();
							if($page_ids){
								$page_ids = explode(',',$page_ids); 
								foreach($page_ids as $page_id){
									$allids[] = $page_id;
								}
							}
						}
					$page_id_exist = array_intersect($current_page_ids, $allids);
					}

					if(!empty($page_id_exist)){
						$output['page_id_exist'] = $page_id_exist;
						$all_title = [];
						foreach($page_id_exist as $page_id){
							$all_title[] = '<li><strong>Page Title: </strong>'.get_the_title($page_id).'</li>';
						}
						$output['page_title'] = $all_title;
						$new_page_ids = array_diff($current_page_ids, $allids);
						if(!empty($new_page_ids)){
							$n_page_ids = implode(',', $new_page_ids);
							$popup = new SQB_FormQuiz();	
							$popup->setQuizId($id);	 
							$popup->setDisplayType($popup_type);	
							$popup->setPageIds($n_page_ids);							
							$popup->setDate($date);	
							$form_quiz_exits_obj = SQB_FormQuiz::loadByQuizId($id); 
							if($form_quiz_exits_obj){
								$popup->setId($form_quiz_exits_obj->getId());						
								$popup_id = $popup->update();
							}else{
								$popup_id = $popup->create();
							}	
						}
					}else{
						$popup = new SQB_FormQuiz();	
						$popup->setQuizId($id);	 
						$popup->setDisplayType($popup_type);	
						$popup->setPageIds($form_url_ids);							
						$popup->setDate($date);	
						$form_quiz_exits_obj = SQB_FormQuiz::loadByQuizId($id); 
						if($form_quiz_exits_obj){
							$popup->setId($form_quiz_exits_obj->getId());						
							$popup_id = $popup->update();
						}else{
							$popup_id = $popup->create();
						}					
					}*/
				}
				
				if($id != '' && $id != 0){			
					$sqbData->setId($id);
					$row = SQB_Quiz::loadArrById($id);
					$sqbData->setQuizShowFirstNameTemp($row['show_firstname_template']);	  				
					$last_id = $sqbData->update();
					$output['save_action'] = 'update';
					
				}else{	
					// set values if create action is call
						
					$sqbData->setQuizPassmark($quiz_passmark);
					$sqbData->setQuizTimer($quiz_timer);
					$sqbData->setShowFirstnameOutcome($show_firstname_outcome);
					$sqbData->setQuizTimerLimit($quiz_timer_limit);
					
					$sqbData->setShowForNotLoggedInUser($show_for_notloggedin_user);	
					
					$sqbData->setCorrectAnswerPage($show_correct_ans_option);	
					$sqbData->setQuestionsRandom('N');	
					$sqbData->setAnswersRandom('N');	
					$sqbData->setQuizScore('0');	
					$sqbData->setQuizPercentage('N');	
					$sqbData->setGlobalStyle('Y');	
					$last_id = $sqbData->create();   
					$output['save_action'] = 'create';
					
				} 
				
				if( $last_id == 0 ||  $last_id == ''){

					if (!is_plugin_active( 'smartquizbuilder/smartquizbuilder.php' ) ) {
							
						global $wpdb,$is_come_from_activate_hook;
						if(strpos($wpdb->last_error, 'Unknown column') !== false && $is_come_from_activate_hook){
							$is_come_from_activate_hook = false;
							updateSQB();
							sqb_upgrade_older_fix();
							SQBPreBuiltThemeInstall();
							return;
						}
					}else{
						global $wpdb;
						if( strpos($wpdb->last_error, 'Unknown column') !== false  ){
							updateSQB();
							sqb_upgrade_older_fix();
							if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && $oneTime == 0){
								SQBSaveQuizAjax('',1);
							}
							return;
						}
					}

					$output['error'] = 'Unexpected Error.';
					echo json_encode($output);
					die;
				}else{
					global $wpdb;
					if( strpos($wpdb->last_error, 'Unknown column') !== false  ){
						
						updateSQB();
						sqb_upgrade_older_fix();
						if ( is_admin() && defined( 'DOING_AJAX' ) && DOING_AJAX && $oneTime == 0){
							SQBSaveQuizAjax('',1);
						}
						return;
					}
				}
				$quiz_id = $last_id;
				
				// quiz template html save and update stuff
				$start_temp_html = urldecode($data['start_temp_html']);
				$img_url = plugins_url()."/smartquizbuilder/includes/images/start_image1.jpg";	
				$start_temp_html = str_replace("%%IMGURL%%" , $img_url ,$start_temp_html);

				$data['start_lead_customizer_styles'] = !empty($data['start_lead_customizer_styles']) ? $data['start_lead_customizer_styles'] : '';
				$start_lead_customizer_styles = maybe_serialize($data['start_lead_customizer_styles']);

				$start_image = urldecode($data['start_image']);
				$show_analyzing_result_temp='';
				if(isset($data['show_analyzing_result_temp'])){
					$show_analyzing_result_temp = $data['show_analyzing_result_temp'];
					$show_analyzing_result_temp = urldecode($show_analyzing_result_temp);	
				}	 	
				$result_temp_html = urldecode($data['result_temp_html']);
				$optin_temp_html = urldecode($data['optin_temp_html']);
				$question_temp_html = urldecode($data['question_temp_html']);	


				$start_template_no = !empty($data['start_template_no']) ? $data['start_template_no'] : '';
				$result_template_no = $data['result_template_no'];
				$optin_template_no = $data['optin_template_no'];
				$template_no = $data['template_no'];		
				$common_style = @$data['common_style'];		
				
				
				$quiz_template = new SQB_QuizTemplate();
				$quiz_template->setQuizId($quiz_id);
				$quiz_template->setQuizStartTemplateHtml($start_temp_html);
				$quiz_template->setQuizResultTemplateHtml($result_temp_html);
				$quiz_template->setQuizQuestionAnswerTemplateHtml($question_temp_html);
				$quiz_template->setOptinTemplateHtml($optin_temp_html);
				$quiz_template->setStartTemplate($start_template_no);
				$quiz_template->setStartImage($start_image);
				$quiz_template->setResultTemplate($result_template_no);
				$quiz_template->setOptinTemplate($optin_template_no);
				$quiz_template->setQuesTemplate($template_no);
				$quiz_template->setCommonStyle($common_style);
				$quiz_template->setAnalyzingResultTemp($show_analyzing_result_temp);
				$quiz_template->setCustomizerHtml($start_lead_customizer_styles);
				   
				$quiz_temp_exits_obj = SQB_QuizTemplate::checkByQuizIdHas($quiz_id); 
				
				  
				if($quiz_temp_exits_obj){
					$quiz_template->setId($quiz_temp_exits_obj->getId());
					$quiz_template->setFirstNameTemplate($quiz_temp_exits_obj->getFirstNameTemplate());
					$quiz_template->setAnalyzingResultTemp($quiz_temp_exits_obj->getAnalyzingResultTemp());
					$quiz_template_id = $quiz_template->update();
				}else{
					$quiz_template_id = $quiz_template->create();
				}


				$output['last_id'] = $last_id;
				$output['quiz_id'] = $quiz_id;
				$output['success'] = "Saved successfully.";		

				$output['shortcode'] = '[SmartQuizBuilder id='.$quiz_id.'][/SmartQuizBuilder]';	  	
				$output['quiz_name'] = $quiz_name;
				$output['quiz_desc'] = $quiz_desc;
				$output['quiz_type'] = $quiz_type;
				$output['embedCode'] = '<span><strong>Want to publish this quiz on a different site?:</strong></span><br>
								   	<a class="ManageQuiz-action-btn item-embed-btn" title="Embed Code" href="javascript:void(0)" onclick="sqbEmbedCodeQuiz('.$quiz_id.')"><i class="fa fa-code"></i> Click here for Embed Code</a>';

				$output['quiz_add_branching_link'] = admin_url('admin.php?page=sqb_add_funnel').'&id='.$quiz_id;
				
				$all_mobile_view_layout = '';
				if(isset($data['all_mobile_view_layout'])){
					$all_mobile_view_layout = $data['all_mobile_view_layout'];
				}
				
				$temp_global_theme_enable = 'N';
				$outer_style_status = 'Y';
				if(isset($data['outer_style_status'])){
					$outer_style_status = $data['outer_style_status'];
				}
				
				if(isset($data['temp_global_theme_enable'])){
					if(isset($data['sqb_set_global_theme_style_values']) && is_array($data['sqb_set_global_theme_style_values'])){
						if(is_array($all_mobile_view_layout)){
							$all_mobile_view_layout = array_merge($all_mobile_view_layout,$data['sqb_set_global_theme_style_values'] );
						}else{
							$all_mobile_view_layout = $data['sqb_set_global_theme_style_values'];
						}
					}
				}
				
				if(is_array($all_mobile_view_layout)){
					foreach($all_mobile_view_layout as $m_key=>$m_value){
						
						$screen_name = $m_value['screen_name'];
						$custom_values = $m_value['custom_values'];
						
						$strm_type = $m_value['type'];
						if(is_array($custom_values)){
							$custom_values = implode(',',$custom_values);
						}
						
						$mobile_css_style = urldecode($m_value['mobile_css_style']);
						$screen_status = $m_value['screen_status'];
						$new_obj_theme_data = new SQB_GlobalTheme();
						$new_obj_theme_data->setQuizId($quiz_id);
						$new_obj_theme_data->setName($screen_name);
						$new_obj_theme_data->setValue($mobile_css_style);
						$new_obj_theme_data->setStatus($screen_status);
						$new_obj_theme_data->setDate($date);
						$new_obj_theme_data->setType($strm_type);
						$new_obj_theme_data->setCustomValues($custom_values);
						$new_obj_theme_data->setOuterStyleStatus($outer_style_status);
						
						$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
						if(isset($theme_data_has)){
							
							$new_obj_theme_data->setId($theme_data_has->getId());
							$new_obj_theme_data->update();
						}else{
							$new_obj_theme_data->create();
						}
						
					}
				}	


			// Check if Global Style enabled
			if(isset($_REQUEST['form_data']['sqb_gl_style_settings'])){
				$global_style_settings_post = json_encode($_REQUEST['form_data']['sqb_gl_style_settings']);
			}else{
				$global_style_settings_post = '';
			}
			
			$strm_type = isset($strm_type) ? $strm_type : '';
			$sqb_gl_style_settings = SQB_GlobalTheme::loadByQuizIdAndNameAndType(0,'sqb_gl_style_settings',$strm_type);

			if(!empty($sqb_gl_style_settings)){
				
				$sqb_gl_style_settings->setValue($global_style_settings_post);
				$sqb_gl_style_settings->create();
			}else{
				$new_obj_theme_data = new SQB_GlobalTheme();
				$new_obj_theme_data->setQuizId(0);
				$new_obj_theme_data->setName('sqb_gl_style_settings');
				$new_obj_theme_data->setStatus('Y');
				$new_obj_theme_data->setDate($date);
				$new_obj_theme_data->setType('global');
				$new_obj_theme_data->setCustomValues('');
				$new_obj_theme_data->setOuterStyleStatus('Y');
				$new_obj_theme_data->setValue($global_style_settings_post);
				$new_obj_theme_data->create();

			}
			
			if(!empty($all_background_color)){

				$screen_name = 'settings_background_color';
				$strm_type = 'settings';
				$date = date('Y-m-d H:i:s');

				$new_obj_theme_data = new SQB_GlobalTheme();
				$new_obj_theme_data->setQuizId($quiz_id);
				$new_obj_theme_data->setName($screen_name);
				$new_obj_theme_data->setStatus('Y');
				$new_obj_theme_data->setDate($date);
				$new_obj_theme_data->setType($strm_type);
				$new_obj_theme_data->setCustomValues('');
				$new_obj_theme_data->setOuterStyleStatus('Y');
				
				$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,'settings');

				if(isset($theme_data_has)){
					$existing_all_background_color = $theme_data_has->getValue();
					$existing_all_background_color_se = "";
					if(!empty($existing_all_background_color)){
						$existing_all_background_color_un = unserialize($existing_all_background_color);
						if(!empty($existing_all_background_color_un) && is_array($existing_all_background_color_un)){
							$after_replace_data = array_replace($existing_all_background_color_un, $all_background_color);
							$existing_all_background_color_se = maybe_serialize($after_replace_data);
						}
					}else{
						$existing_all_background_color_se = maybe_serialize($all_background_color);
					}

					$new_obj_theme_data->setValue($existing_all_background_color_se);
					$new_obj_theme_data->setId($theme_data_has->getId());
					$new_obj_theme_data->update();
				}else{
					$all_background_color_se = maybe_serialize($all_background_color);
					$new_obj_theme_data->setValue($all_background_color_se);
					$new_obj_theme_data->create();
				}
			}
		}else if (isset($data['actionType']) && $data['actionType'] == 'save_ques') {
			# code...
			// quiz question and answer save and update suff

		   $quiz_id = $data['id'];
		   $new_questions_ids_array = array();
		   $new_answers_ids_array = array();
		   $new_outcomes_ids_array = array();
		   $question_bank_ids_array = array();
		   $question_ans_bank_ids_array = array();
		   $question_ans_bank_ids_array2 = array();
		   $outcome_mapping_id_array = array();
		   $outcome_mapping_id_array2 = array();
		   $old_list_of_answers_ids = array();
		   $questions_data = $data['questions_data'];
						 
		    if(is_array($questions_data) && count($questions_data)){
				
				$old_list_of_answers_ids = array();
			   $questions_order_var = 0;
			   foreach($questions_data as $question_data){
					$data['chatgpt'] = isset($data['chatgpt']) ? $data['chatgpt'] : '';
			   		if($send_by_browser || $data['chatgpt'] == 'chatgpt'){ 
						$question_info = urldecode($question_data['question_data']);
					}else{ 
						$question_info = urldecode(base64_decode($question_data['question_data']));
					}
					
					$question_wrapper_id ='';
					if (isset($question_data['question_wrapper_id'])) {
						 $question_wrapper_id = $question_data['question_wrapper_id'];
					}
					 $question_id ='';
					if (isset($question_data['question_id'])) {
						 $question_id = $question_data['question_id'];
					}
					
					 $quiz_category_id ='';
					if (isset($question_data['quiz_category_id'])) {
						 $quiz_category_id = $question_data['quiz_category_id'];
					}
				  
				   $order = $question_data['order'];
				   $order = (int)$order;
				   
				   $question_type = $question_data['question_type'];
				   $question_title = $question_data['question_title'];
				   $show_correct_inccorect_ans_checkbox = $question_data['show_correct_inccorect_ans_checkbox'];
				   $ans_with_img = $question_data['ans_with_img'];
				   $ans_img_setting =  !empty($question_data['ans_img_setting']) ? maybe_serialize($question_data['ans_img_setting']) : '';
				   $question_setting = !empty($question_data['question_setting']) ? maybe_serialize($question_data['question_setting']) : '';

				   

				   $multiple_correct_ans = $question_data['multiple_correct_ans'];
				   $ans_layout = $question_data['ans_layout'];
				   $temp_customizer = $question_data['temp_customizer'];
				   $question_file_upload_settings='';
				   if(isset($question_data['question_file_upload_settings'])){
					   $question_file_upload_settings = $question_data['question_file_upload_settings'];
				   }
				   
				   $allow_skip_ques = $question_data['allow_skip_ques'];
				   $question_next_button_html = urldecode($question_data['question_next_button_html']);
				   
				   $question_skip_button_html = '';
				   if(isset($question_data['question_skip_button_html'])){
				       $question_skip_button_html = urldecode($question_data['question_skip_button_html']);
				   }
			   	
		   			$matrix_column_width = '';
				  	if(isset($question_data['matrix_column_width'])){
				       $matrix_column_width = $question_data['matrix_column_width'];
				   	}

					$enable_question_background_image = $question_data['enable_question_background_image'];
					$skip_outcome_mapping = $question_data['skip_outcome_mapping'];

					$quiz_question_bank_obj = new SQB_QuizQuestionBank();
					$quiz_question_bank_obj->setQuestion($question_info);
					$quiz_question_bank_obj->setQuestionType($question_type);
					$quiz_question_bank_obj->setQuestionTitle($question_title);
					$quiz_question_bank_obj->setShowCorrectIncorrectAns($show_correct_inccorect_ans_checkbox);
					$quiz_question_bank_obj->setQuestionImage('image');
					$quiz_question_bank_obj->setQuestionOrder($order);

					$quiz_question_bank_obj->setAnsWithImg($ans_with_img); 
					$quiz_question_bank_obj->setAnsImgSetting($ans_img_setting); 
					$quiz_question_bank_obj->setQuestionSetting($question_setting); 
					
					$quiz_question_bank_obj->setMultipleCorrectAns($multiple_correct_ans); 
					$quiz_question_bank_obj->setAnsLayout($ans_layout); 
					$quiz_question_bank_obj->setTempCustomizer($temp_customizer); 
					$quiz_question_bank_obj->setFileUploadSettings($question_file_upload_settings);
					$quiz_question_bank_obj->setAllowSkipQues($allow_skip_ques);  
					$quiz_question_bank_obj->setQuestionsNextButtonHtml($question_next_button_html); 
					$quiz_question_bank_obj->setQuestionsSkipButtonHtml($question_skip_button_html); 
					$quiz_question_bank_obj->setEnableBackgroundImage($enable_question_background_image); 
					$quiz_question_bank_obj->setSkipMapping($skip_outcome_mapping); 
					$quiz_question_bank_obj->setCategoryId($quiz_category_id); 
					$quiz_question_bank_obj->setMatrixLabelText('');
					$quiz_question_bank_obj->setMatrixHtml('');
				   
				   if($question_type == 'matrix'){
							
				   		

						if(isset($question_data['matrix_labels_text']) && count($question_data['matrix_labels_text'])){
							$matrix_labels_text_array = array();
							
								foreach($question_data['matrix_labels_text'] as $matrix_label_text){
									$m_index = $matrix_label_text['index'];
									//$m_matrix_label_text = urldecode($matrix_label_text['matrix_label_text']);
									$m_matrix_label_text = $matrix_label_text['matrix_label_text'];
									$matrix_labels_text_array[] =  $m_index.'|'.$m_matrix_label_text;
								}
								$quiz_question_bank_obj->setMatrixLabelText(implode(',',$matrix_labels_text_array));
						}
						$matrix_html = urldecode($question_data['matrix_html']);
						$quiz_question_bank_obj->setMatrixHtml($matrix_html);
						$quiz_question_bank_obj->setMatrixColumnWidth($matrix_column_width);
					}	
					
				   $quiz_question_bank_obj->setDate($date);
				 	unset($question_exists);
				 	if(is_numeric($question_id)){
				 		$question_exists = SQB_QuizQuestions::loadByQuizIdAndQuestionId($quiz_id,$question_id);
					}
				   	if(isset($question_exists)){
					   $quiz_question_bank_obj->setId($question_id);
					   $quiz_question_id = $quiz_question_bank_obj->update();
					   $question_exists->setQuestionOrder($order);
					   $question_exists->update();
					   $output['update_question'] = "update";
				  	}else{	
						$output['create_question'] = "create";
					   $quiz_question_id = $quiz_question_bank_obj->create();
					   if($quiz_question_id == 'error' || $quiz_question_id == ''){
					   		$output['error'] = 'Sorry there was an issue with save';
					   	}
					   	$sqbQuizQuesObj = new SQB_QuizQuestions();
					   	$sqbQuizQuesObj->setQuizId($quiz_id);
					    
					   	if($quiz_question_id > 0){
					   	$sqbQuizQuesObj->setQuestionId($quiz_question_id);
					   	$sqbQuizQuesObj->setQuestionOrder($order);
					   	$sqbQuizQuesObj->create();
						}
				   	}
				   
				   if($quiz_question_id > 0){
				   $new_questions_ids_array[]   = $quiz_question_id;
				   
				   $question_bank_ids_array[$question_wrapper_id] = $quiz_question_id;
				    
					$answerObj = SQB_QuizAnswers::loadByQuestionId($quiz_question_id);
					if($answerObj){
					   foreach($answerObj as $answerObj_value){
							$old_list_of_answers_ids[] =  $answerObj_value->getId();
						}
					}  
				   // save and update answer 
				   $answers_array = $question_data['answer_array'];
				   $extra_options = array();
				   if(is_array($answers_array) && count($answers_array)){
					   $answers_order_var = 0;   
					   foreach( $answers_array as $answer_array){
						if($question_type == 'numerical_text'){
							$extra_options['numeric_correct_answer'] = $answer_array['numeric_correct_answer'];
						}else if($question_type == 'matching_text'){
							$matching_text['matching_text'] = $answer_array['matching_text'];
						}else if($question_type == 'email'){
							$extra_options['email_options'] = $answer_array['extra_options'];
						}else if($question_type == 'phone_number'){
							$extra_options['phone_options'] = $answer_array['extra_options'];
						}else if($question_type == 'weight_and_height'){
							$extra_options['hw_options'] = $answer_array['extra_options'];
						}

						$quiz_ans_obj = new SQB_QuizAnswers();
						$quiz_ans_obj->setQuestionId($quiz_question_id);
						if($send_by_browser){
							$quiz_ans_obj->setAnswer(urldecode($answer_array['ans']));
						}else{
							$quiz_ans_obj->setAnswer($answer_array['ans']);
						}
						/*if($question_type == 'numerical_text'){
						$quiz_ans_obj->setAnswerTitle('');
						} else {*/
						$quiz_ans_obj->setAnswerTitle($answer_array['answer_title']);
						/*}*/
						$correctans = '';
						if(array_key_exists('correct_ans', $answer_array)){
							$correctans = $answer_array['correct_ans'];
						}
						$quiz_ans_obj->setCorrectAnswer($correctans);
						$quiz_ans_obj->setAnswerPoints($answer_array['ans_point']);
						$quiz_ans_obj->setIncorrectAnswerInfo($answer_array['ans_hint']);
						$quiz_ans_obj->setCorrectAnswerInfo($answer_array['ans_info']);
						if (isset($answer_array['recommendation_html'])) {
							$quiz_ans_obj->setRecommendationHtml(urldecode($answer_array['recommendation_html']));						
						}else{
							$quiz_ans_obj->setRecommendationHtml('');	
						}
						$quiz_ans_obj->setAnswerOrder($answers_order_var++);
						$quiz_ans_obj->setDate($date); 
						$quiz_ans_obj->setMatrixValues('');
						if($question_type == 'matching_text'){
							$quiz_ans_obj->setExtraOptions(maybe_serialize($matching_text));
						}else if($question_type == 'numerical_text' || $question_type == 'email' ||  $question_type == 'phone_number' ||  $question_type == 'weight_and_height' || $question_type == 'name'){
							$quiz_ans_obj->setExtraOptions(maybe_serialize($extra_options));
						}
						
						if($question_type == 'matrix'){
							if(isset($answer_array['matrix_values']) && count($answer_array['matrix_values'])){
								$matrix_values_array = array();
								foreach($answer_array['matrix_values'] as $matrix_value){
									$m_index = $matrix_value['index'];
									$m_answer_value = $matrix_value['answer_value'];
									$matrix_values_array[] =  $m_index.'|'.$m_answer_value;
								}
								$quiz_ans_obj->setMatrixValues(implode(',',$matrix_values_array));
							}
						}
						
						if($question_type == 'email' || $question_type == 'phone_number' || $question_type == 'weight_and_height' || $question_type == 'name'){
							$quiz_ans_obj->setExtraOptions(maybe_serialize($extra_options));
						}

						 $answer_id ='';
						if (isset($answer_array['answer_id'])) {
							 $answer_id = $answer_array['answer_id'];
						}
						  
						 
						$answer_exists = SQB_QuizAnswers::loadByQuestionIdAndAnswerId($quiz_question_id,$answer_id);
						if(isset($answer_exists)){
							$quiz_ans_obj->setId($answer_id);
							$quiz_ans_obj->setTagIds($answer_exists[0]->getTagIds());
							$quiz_ans_id = $quiz_ans_obj->update();
						}else{
							$quiz_ans_id = $quiz_ans_obj->create();
							
							if(is_numeric($answer_id)){
								$output['answer_ids_numeric'][$answer_id][] = $answer_id;
								$answer_exists_new = SQB_QuizAnswers::loadByQuestionIdAndAnswerId($quiz_question_id,$quiz_ans_id);
								if(isset($answer_exists_new)){
									$quiz_ans_obj_new = SQB_QuizAnswers::loadById($quiz_ans_id);
									if($quiz_ans_obj_new){
										$quiz_ans_obj_new->setAnswer(str_replace('data-id="'.$answer_id.'"','data-id="'.$quiz_ans_id.'"',urldecode($answer_array['ans'])));
										$output['answer_ids_numeric'][$answer_id][] = 'udpate';
										$quiz_ans_obj_new->update();
									}
								}
							}
							
						}
						
						$answer_wrapper_id = 0;
						if (isset($answer_array['answer_wrapper_id'])) {
							if($answer_array['answer_wrapper_id'] != ''){
								$answer_wrapper_id = $answer_array['answer_wrapper_id'];
							}
						}
						 
						$question_ans_bank_ids_array[$quiz_question_id][$answer_wrapper_id] = $quiz_ans_id;
						$question_ans_bank_ids_array2[$quiz_question_id][] = $quiz_ans_id;
						
						$new_answers_ids_array[]  = $quiz_ans_id;
						$answer_wrapper_id_arr[] =  $answer_wrapper_id;
						
						}// foreach close 

						
						$delete_answers_array_list = array_diff($old_list_of_answers_ids,$new_answers_ids_array);
						foreach($delete_answers_array_list as $delete_id){
									SQB_QuizAnswers::DeleteById($delete_id);
									$output['delete_answers_ids'][]  = $delete_id;
						}
					}
					
					
					// save and upate outcome 
					$outcome_results_checkbox = '';
					 if(isset($question_data['outcome_results_checkbox'])){
						 $outcome_results_checkbox = $question_data['outcome_results_checkbox'];
					 }

				    if(is_array($outcome_results_checkbox) && count($outcome_results_checkbox)){
						$i = 0;
						foreach( $outcome_results_checkbox as $outcome_result_checkbox){
							
							
							$outcome_answer_index_id = (!empty($outcome_result_checkbox['outcome_answer_index_id'])) ? $outcome_result_checkbox['outcome_answer_index_id'] : '0';
							$outcome_answer_id = (!empty($outcome_result_checkbox['outcome_answer_id'])) ? $outcome_result_checkbox['outcome_answer_id'] : '';
							$outcome_mapping_id = (!empty($outcome_result_checkbox['outcome_mapping_id'])) ? $outcome_result_checkbox['outcome_mapping_id'] : '';
							$coutcome_selected_id = (!empty($outcome_result_checkbox['coutcome_selected_id'])) ? $outcome_result_checkbox['coutcome_selected_id'] : array();
							
							
							//sqb_outcome_mapping outcome_results_checkbox
							$coutcomeMappingObj = new SQB_OutComeMapping();
							$coutcomeMappingObj->setQuizId($quiz_id);
							$coutcomeMappingObj->setQuestionId($quiz_question_id);
							
						
							$output['coutcome_selected_id'][] = $outcome_result_checkbox;
						
						
							$coutcome_wrapper_id = $outcome_result_checkbox['outcome_wrapper_id'];
							
							$coutcomeMappingObj->setOutcomeId(implode(',',$coutcome_selected_id));  
							
		                    $outcome_obj_has  =  SQB_OutComeMapping::loadById($outcome_mapping_id);	
		                    
		                    $ouctome_update = true;
		                    if(isset($outcome_obj_has)){
								$output['coutcome_mapping_action'][] = ' udpate_by_outcome_mapping_id call';
								$coutcomeMappingObj->setId($outcome_obj_has->getId());
								$coutcomeMappingObj->setAnswerId($outcome_obj_has->getAnswerId());
								$outfill_mapping_id = $coutcomeMappingObj->update();
								$quiz_ans_id = $outcome_obj_has->getAnswerId();
								$ouctome_update = false;
								$output['coutcome_action'][] = array('id' =>$outfill_mapping_id,'udpate_by_outcome_mapping_id)' =>$outcome_mapping_id);
							}		
							
							if($ouctome_update){
								 $outcome_obj_has  =  SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quiz_id,$quiz_question_id,$outcome_answer_id); 
								 $output['coutcome_mapping_action'][] = ' udpate_by_answer_id call';
								 if(isset($outcome_obj_has)){
									$coutcomeMappingObj->setId($outcome_obj_has->getId());
									$coutcomeMappingObj->setAnswerId($outcome_obj_has->getAnswerId());
									$outfill_mapping_id = $coutcomeMappingObj->update();
									$quiz_ans_id = $outcome_obj_has->getAnswerId();
									$ouctome_update = false;
									$output['coutcome_action'][] = array('id' =>$outfill_mapping_id,'udpate_by_answer_id)' =>$quiz_ans_id);
								}		
								 
							}	
						if($ouctome_update){
							$output['coutcome_mapping_action'][] = ' udpate_by_answer_id call';
							$outcome_answer_index_id = @$outcome_answer_index_id - 1;
							if(isset($question_ans_bank_ids_array2[$quiz_question_id][$outcome_answer_index_id])){
								$quiz_ans_id = $question_ans_bank_ids_array2[$quiz_question_id][$outcome_answer_index_id];
								$coutcomeMappingObj->setAnswerId($quiz_ans_id);
								$outfill_mapping_id = $coutcomeMappingObj->create();
								$output['coutcome_action'][] = array('id' =>$outfill_mapping_id,'create_by_answer_index_id' =>$outcome_answer_index_id);
							}
						}
						   
						
						$new_outcomes_ids_array[] = $outfill_mapping_id;
						
						$outcome_mapping_id_array[$quiz_question_id][$quiz_ans_id][$coutcome_wrapper_id] = $outfill_mapping_id;
						$outcome_mapping_id_array2['outcome_id'][$quiz_question_id][$quiz_ans_id][] = $outcome_id;
					 }// foreach close 
				  }
					
				}///	
					
					
			  }
		   }

		    //Get all question ids 
		   $get_all_questions_list = SQB_QuizQuestions::loadByQuizId($quiz_id);
		   $old_list_of_question_ids = array();
		   $old_list_of_answers_ids = array();
		   foreach($get_all_questions_list as $single_question_data){
			   
			   $old_list_of_question_ids[] = $single_question_data->getQuestionId(); 
			   
			   $answerObj = SQB_QuizAnswers::loadByQuestionId($single_question_data->getQuestionId());
			   if($answerObj){
				   foreach($answerObj as $answerObj_value){
					//	$old_list_of_answers_ids[] =  $answerObj_value->getId();
					}
			   }
			   
			   
		   }  
		   /*$delete_question_array_list = array_diff($old_list_of_question_ids,$new_questions_ids_array);
		   foreach($delete_question_array_list as $delete_id){
						SQB_QuizQuestions::DeleteByQuestionId($delete_id);
						SQB_QuizQuestionBank::DeleteById($delete_id);
						$output['delete_questoind_ids'][]  = $delete_id;
			}*/
			
			
			/*$delete_answers_array_list = array_diff($old_list_of_answers_ids,$new_answers_ids_array);
			foreach($delete_answers_array_list as $delete_id){
						SQB_QuizAnswers::DeleteById($delete_id);
						$output['delete_answers_ids'][]  = $delete_id;
			}*/
		     
		    // delete outcome ids 
		   /* $get_all_outcomes_list = SQB_OutComeMapping::loadByQuizId($quiz_id);
		    $old_list_of_outcomes_ids = array();
		    if(count($get_all_outcomes_list)){
				foreach($get_all_outcomes_list as $single_outcome_data){
			   
					$old_list_of_outcomes_ids[] = $single_outcome_data->getId(); 
				} 
			 }
		     $delete_outcomes_array_list = array_diff($old_list_of_outcomes_ids,$new_outcomes_ids_array);
			 foreach($delete_outcomes_array_list as $delete_id){
						SQB_OutComeMapping::DeleteById($delete_id);
						$output['delete_outcomes_ids'][]  = $delete_id;
			  }*/
		    
		    if(!isset($old_list_of_outcomes_ids)){
				$old_list_of_outcomes_ids='';
			}
			if(!isset($quiz_template_id)){
				$quiz_template_id='';
			}
		   
		    
			$output['old_list_of_outcomes_ids'] = $old_list_of_outcomes_ids;
			$output['new_outcomes_ids_array'] = $new_outcomes_ids_array;
			
			$output['quiz_template_id'] = $quiz_template_id;		
			$output['question_bank_ids_array'] = $question_bank_ids_array;		
			$output['question_ans_bank_ids_array'] = $question_ans_bank_ids_array;	  	   
			$output['outcome_mapping_id_array'] = $outcome_mapping_id_array;	  	   
			   
			$output['outcome_mapping_id_array2'] = $outcome_mapping_id_array2;	  	   
			
			
			$output['old_list_of_question_ids'] = $old_list_of_question_ids;
			$output['new_questions_ids_array'] = $new_questions_ids_array;
			$output['old_list_of_answers_ids'] = $old_list_of_answers_ids;
			$output['new_answers_ids_array'] = $new_answers_ids_array;
			

		}	
      
      	
	}else{
		$output['error'] = 'something wrong.';
	}  
	
	if($form_data !="" && is_array($form_data)){
		return $output;
	}	
		
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_question', 'sqb_save_question');
add_action('wp_ajax_nopriv_sqb_save_question', 'sqb_save_question');


/* Save Question  */
function sqb_save_question(){
	 
	if(isset($_POST['form_data'])){		
		$data = $_POST['form_data'];
		$ques_type = $data['ques_type'];
		$ques_text = $data['ques_text'];
		$ques_image = $data['ques_image'];
		$question_order = $data['question_order'];
		//$question_title = $data['question_title'];
		//answerdata
		$points_cls = $data['points_cls'];
		$correct_cls = $data['correct_cls'];
		$ans_text = $data['ans_text'];
		$answer_hint = $data['answer_hint'];
		$answer_info = $data['answer_info']; 		 
		$answer_order = 1;
		$question_order = 1;
		$ans_order = 1; 
		$id = $data['id'];
		$id = 0;
		$date = date('Y-m-d H:i:s');		
		//Set variable of class file
		$sqbData = new SQB_QuizQuestionBank();
		$sqbData1 = new SQB_QuizAnswers();		
		$sqbData->setQuestionType($ques_type);
		$sqbData->setQuestion($ques_text);
		$sqbData->setQuestionImage($ques_image);		
		$sqbData->setQuestionOrder($question_order);
		//$sqbData->setQuestionTitle($question_title);
		$sqbData->setDate($date);
		
		if($id != '' || $id != 0){			
			$sqbData->setId($id);
			$last_id = $sqbData->update();			
		}else{				 				
			$last_id = $sqbData->create();			
			 
		}
		
		$output['last_id'] = $last_id;
		$output['success'] = "Saved successfully.";		
		
	}else{
		$output['error'] = 'something wrong.';
	}	
	
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_answer', 'sqb_save_answer');
add_action('wp_ajax_nopriv_sqb_save_answer', 'sqb_save_answer');

/* Save Answers  */
function sqb_save_answer(){
	 
	if(isset($_POST['form_data'])){		
		$data = $_POST['form_data'];
 
		//answerdata
		$question_id = $data['question_id'];
		$points_cls = $data['points_cls'];
		$correct_cls = $data['correct_cls'];
		$ans_text = $data['ans_text'];
		$answer_hint = $data['answer_hint'];
		$answer_info = $data['answer_info'];
		//$answer_title = $data['answer_title'];
 		 
		$answer_order = 1;
 		$id = $data['id'];
		$id = 0;
		$date = date('Y-m-d H:i:s');
		$question_id = 2;
		//Set variable of class file
		$sqbData1 = new SQB_QuizAnswers();	 
		
		$sqbData1->setAnswerInfo($answer_info);
		$sqbData1->setAnswerHint($answer_hint);
		$sqbData1->setAnswer($ans_text);						 
		$sqbData1->setAnswerPoints($points_cls);						 
		$sqbData1->setCorrectAnswer($correct_cls);						 
		$sqbData1->setAnswerOrder($answer_order);					 
		//$sqbData1->setAnswerTitle($answer_title);					 
		$sqbData1->setDate($date);							
 		 
		if($id != '' || $id != 0){			
			$sqbData->setId($id);
			$last_id = $sqbData->update();
			$sqbData1->setQuestionId($question_id);
			$last_id1 = $sqbData1->update();
		}else{	
			 
 			$sqbData1->setQuestionId($question_id);
			$last_id1 = $sqbData1->create();
		}
		
		$output['last_id'] = $last_id;
		$output['success'] = "Saved successfully.";		
		
	}else{
		$output['error'] = 'something wrong.';
	}	
	
	echo json_encode($output);
	die;
}


/*Save date data*/

function sqb_save_custom_field_date_data(){
	 
	if(isset($_POST['optin_month_names']) && isset($_POST['optin_day_names'])){		
		$optin_month_names = $_POST['optin_month_names'];
		$optin_day_names = $_POST['optin_day_names'];
		$date = date('Y-m-d H:i:s');
		$custom_field_data = $optin_month_names.'|'.$optin_day_names;
		
		$sqbData = new SQB_QuizSettings();	 
		$sqbData->setKey('custom_date_field_data');
		$sqbData->setLastUpdated($date);	
 		
 		$load_data = SQB_QuizSettings::checkKeyExist('custom_date_field_data');
		if(isset($load_data)){	
			sqbSetValidSettings('custom_date_field_data', $custom_field_data);		
		}else{	
 			$sqbData->setValue($custom_field_data);
			$last_id = $sqbData->create();
		}
		$output['success'] = "Saved successfully.";				
	}else{
		$output['error'] = 'something wrong.';
	}	
	
	echo json_encode($output);
	die;
}
add_action('wp_ajax_sqb_save_custom_field_date_data', 'sqb_save_custom_field_date_data');
add_action('wp_ajax_nopriv_sqb_save_custom_field_date_data', 'sqb_save_custom_field_date_data');

function sqbloaddatedata(){
	$load_data = SQB_QuizSettings::checkKeyExist('custom_date_field_data');
	if(isset($load_data)){	
		$output['date_data'] = sqbGetValidSettingsByKey('custom_date_field_data');;				
	}else{	
		$output['date_data'] = 'January,February,March,April,May,June,July,August,September,October,November,December|Su,Mo,Tu,We,Th,Fr,Sa';	
	}	
	echo json_encode($output);
	die;
}
add_action('wp_ajax_sqbloaddatedata', 'sqbloaddatedata');
add_action('wp_ajax_nopriv_sqbloaddatedata', 'sqbloaddatedata');

/* Save Quiz */


add_action('wp_ajax_SqbQuizFormAjax', 'SqbQuizFormAjax');
add_action('wp_ajax_nopriv_SqbQuizFormAjax', 'SqbQuizFormAjax');

function SqbQuizFormAjax(){
	
	if(isset($_POST['form_data'])){
		
		$form_data = $_POST['form_data'];
		$field_name = $form_data['field_name'];
		$field_id = $form_data['field_id'];
		$field_type = $form_data['field_type'];
		$field_value = $form_data['field_value'];
		$field_required = $form_data['field_required'];
		$field_placeholder = $form_data['field_placeholder'];
		$quiz_id = $_POST['quiz_id'];
		$optin_name = $_POST['optin_name'];
		$optin_email = $_POST['optin_email'];
		$form_action = !empty($_POST['form_action']) ? $_POST['form_action'] : '';		
		$third_party_from_enabled = $_POST['third_party_from_enabled'];
		$add_form_script_code = urldecode($_POST['add_form_script_code']);
		$add_form_style_code = urldecode($_POST['add_form_style_code']);
 
		$sqbquizdata = SQB_QuizForm::loadByQuizId($quiz_id);
 
	 	if(isset($sqbquizdata) && $sqbquizdata !=false){			 
	 	 
	 		SQB_QuizForm::DeleteByQuizId($quiz_id);
	 		foreach ($field_name as $key => $value) {
 
				$id = $field_id[$key];
				$field_name = $value;
				$type = $field_type[$key];
				$nvalue = $field_value[$key];
				$placeholder = $field_placeholder[$key];
				$required = $field_required[$key];
				$saveData = new SQB_QuizForm();

				$saveData->setQuizId($quiz_id);
				$saveData->setName($field_name);
				$saveData->setFormId($id);
				$saveData->setValue($nvalue);
				$saveData->setType($type);
				$saveData->setRequired($required);
				$saveData->setPlaceholder($placeholder);

				$saveData->create();
			}	
			$saveData->setQuizId($quiz_id);
			$saveData->setName('html');
			$saveData->setValue(stripslashes($_POST['html']));
			$saveData->create();
			
			$saveData->setQuizId($quiz_id);
			$saveData->setName('script');
			$saveData->setValue($add_form_script_code);
			$saveData->create();
			
			$saveData->setQuizId($quiz_id);
			$saveData->setName('style');
			$saveData->setValue($add_form_style_code);
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('optin_name');
			$saveData->setValue($optin_name);
			$saveData->setType('select');
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('optin_email');
			$saveData->setValue($optin_email);
			$saveData->setType('select');
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('third_party_from_enabled');
			$saveData->setType('hidden');
			$saveData->setValue($third_party_from_enabled);
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('form_action');
			$saveData->setValue($form_action);
			$saveData->setType('hidden');
			$saveData->create();
		}else{
			foreach ($field_name as $key => $value) {
				$id = $field_id[$key];
				$field_name = $value;
				$type = $field_type[$key];
				$nvalue = $field_value[$key];
				$placeholder = $field_placeholder[$key];
				$required = $field_required[$key];
				$saveData = new SQB_QuizForm();

				$saveData->setQuizId($quiz_id);
				$saveData->setName($field_name);
				$saveData->setFormId($id);
				$saveData->setValue($nvalue);
				$saveData->setType($type);
				$saveData->setRequired($required);
				$saveData->setPlaceholder($placeholder);

				$saveData->create();
			}	
			$saveData->setQuizId($quiz_id);
			$saveData->setName('html');
			$saveData->setValue(stripslashes($_POST['html']));
			$saveData->create();
			$saveData->setQuizId($quiz_id);
			$saveData->setName('script');
			$saveData->setValue($add_form_script_code);
			$saveData->create();
			
			$saveData->setQuizId($quiz_id);
			$saveData->setName('style');
			$saveData->setValue($add_form_style_code);
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('optin_name');
			$saveData->setValue($optin_name);
			$saveData->setType('select');
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('optin_email');
			$saveData->setValue($optin_email);
			$saveData->setType('select');
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('third_party_from_enabled');
			$saveData->setType('hidden');
			$saveData->setValue($third_party_from_enabled);
			$saveData->create();

			$saveData->setQuizId($quiz_id);
			$saveData->setName('form_action');
			$saveData->setValue($form_action);
			$saveData->setType('hidden');
			$saveData->create();
	}
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	$form_data = SQB_QuizForm::loadArrByQuizId($quiz_id);
	echo json_encode($form_data);die;
	
}


add_action('wp_ajax_SqbQuizLoadFormDataAjax', 'SqbQuizLoadFormDataAjax');
add_action('wp_ajax_nopriv_SqbQuizLoadFormDataAjax', 'SqbQuizLoadFormDataAjax');

function SqbQuizLoadFormDataAjax(){

	$form_data = '';
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$form_data = SQB_QuizForm::loadArrByQuizId($quiz_id);
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	echo json_encode($form_data);die;
}


/* ----------------------------- */





add_action('wp_ajax_sqb_get_temp', 'sqb_get_temp');
add_action('wp_ajax_nopriv_sqb_get_temp', 'sqb_get_temp');

/* Save Answers  */
function sqb_get_temp(){
	$output="";
	if(isset($_POST)){			 
		$temp = $_POST['temp'];
		$quiz_temp = $_POST['quiz_temp'];
		if($quiz_temp == 'start'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../../templates/start/" . $temp . "/" . $temp . ".css";				 
		}else if($quiz_temp == 'qa'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/qa/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/start/" . $temp . "/" . $temp . ".css";			 
		}else if($quiz_temp == 'result'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/result/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/start/" . $temp . "/" . $temp . ".css";				 
		}
		 
		$file = file_get_contents($file);
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 
		$output = $cssfile.$file;		 
		
	}else{
		$output = "";
	}	
	
	echo json_encode($output);
	die;
}



add_action('wp_ajax_sqb_get_funnel_temp', 'sqb_get_funnel_temp');
add_action('wp_ajax_nopriv_sqb_get_funnel_temp', 'sqb_get_funnel_temp');

/* Save Answers  */
function sqb_get_funnel_temp(){
	$output="";
	if(isset($_POST)){			 
		$temp = $_POST['temp'];
		$quiz_temp = $_POST['quiz_temp'];
		if($quiz_temp == 'start'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/start/" . $temp . "/" . $temp . ".css";		
			$file = file_get_contents($file);		 
		}else if($quiz_temp == 'qa'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/qa/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/start/" . $temp . "/" . $temp . ".css";			 
			$file = file_get_contents($file);
		}else if($quiz_temp == 'opt-in'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/opt-in/" . $temp . "/" . $temp . ".css";				 
			ob_start();
			include_once($file);
			ob_get_clean();
			$file = $html;
		}else if($quiz_temp == 'result'){
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/result/" . $temp . "/" . $temp . ".php");			
			$csspath =  plugin_dir_url(__FILE__)."../templates/result/" . $temp . "/" . $temp . ".css";				 
			ob_start();
			include_once($file);
			ob_get_clean();
			$file = $html;
		}
		 
		
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 
		$output = $cssfile.$file;		 
		
	}else{
		$output = "";
	}	
	
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_save_matrix_background_options', 'sqb_save_matrix_background_options');
add_action('wp_ajax_nopriv_sqb_save_matrix_background_options', 'sqb_save_matrix_background_options');
function sqb_save_matrix_background_options(){
	if(isset($_POST['form_data'])){
		$data = $_POST['form_data'];
		$quiz_id = $data['quiz_id'];	
		$question_id = $data['question_id'];	
		$skip_mapping = $data['skip_mapping'];	
		$all_background_color = maybe_serialize($data['background_color']);	
		$date = date('Y-m-d H:i:s');	
		$screen_name = 'matrix_background_color';
		$strm_type = 'matrix';

		$new_obj_theme_data = new SQB_GlobalTheme();
		$new_obj_theme_data->setQuizId($quiz_id);
		$new_obj_theme_data->setName($screen_name);
		$new_obj_theme_data->setValue($all_background_color);
		$new_obj_theme_data->setStatus('Y');
		$new_obj_theme_data->setDate($date);
		$new_obj_theme_data->setType($strm_type);
		$new_obj_theme_data->setCustomValues('');
		$new_obj_theme_data->setOuterStyleStatus('Y');
		
		$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
		if(isset($theme_data_has)){
			$new_obj_theme_data->setId($theme_data_has->getId());
			$output = $new_obj_theme_data->update();
		}else{
			$output = $new_obj_theme_data->create();
		}


		if($skip_mapping){
			$load_question_bank = SQB_QuizQuestionBank::loadById($question_id);
			$obj_qbank = new SQB_QuizQuestionBank();
			$obj_qbank->setId($question_id);
			$obj_qbank->setQuestion($load_question_bank->question);
			$obj_qbank->setQuestionTitle($load_question_bank->question_title);
			$obj_qbank->setQuestionType($load_question_bank->question_type);
			$obj_qbank->setQuestionImage($load_question_bank->question_image);
			$obj_qbank->setQuestionOrder($load_question_bank->order_no);
			$obj_qbank->setAnsWithImg($load_question_bank->ans_with_img);
			$obj_qbank->setMultipleCorrectAns($load_question_bank->multiple_correct_ans);
			$obj_qbank->setAnsLayout($load_question_bank->ans_layout);
			$obj_qbank->setShowCorrectIncorrectAns($load_question_bank->show_correct_incorrect_ans);
			$obj_qbank->setTempCustomizer($load_question_bank->temp_customizer);
			$obj_qbank->setAllowSkipQues($load_question_bank->allow_skip_ques);
			$obj_qbank->setFileUploadSettings($load_question_bank->question_file_upload_settings);
			$obj_qbank->setQuestionsNextButtonHtml($load_question_bank->next_button_html);
			$obj_qbank->setQuestionsSkipButtonHtml($load_question_bank->skip_button_html);
			$obj_qbank->setEnableBackgroundImage($load_question_bank->enable_background_image);
			$obj_qbank->setSkipMapping($skip_mapping);
			$obj_qbank->setDate($load_question_bank->date);
			$obj_qbank->setMatrixLabelText($load_question_bank->matrix_label_text);
			$obj_qbank->setMatrixHtml($load_question_bank->matrix_html);
			$obj_qbank->setCategoryId($load_question_bank->category_id);
			$obj_qbank->update();
		}
		



		$matrix_outcome_mapping_data = $data['matrix_outcome_mapping_data'];
		if($matrix_outcome_mapping_data){

			SQB_OutComeMapping::DeleteByQuestionId($question_id);

			foreach($matrix_outcome_mapping_data as $matrix_outcome_mapping){
				foreach($matrix_outcome_mapping['ans_array'] as $ans_array){

					$ans_id = $ans_array['ans_id'];
					$matrix_mapping = maybe_serialize($ans_array['outcome_mapping']);

					$sqbData = new SQB_OutComeMapping();
					$sqbData->setQuizId($quiz_id);
					$sqbData->setQuestionId($question_id);
					$sqbData->setAnswerId($ans_id);
					$sqbData->setOutcomeId('');
					$sqbData->setOutcomeRange('');
					$sqbData->setMatrixMapping($matrix_mapping);

					$theme_data_has = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quiz_id,$question_id,$ans_id);
					if(isset($theme_data_has)){
						$sqbData->setId($theme_data_has->getId());
						$output = $sqbData->update();
					}else{
						$output = $sqbData->create();
					}

				}
			}
		}

		$tags_data = $data['tags_data'];
		if($tags_data){
			foreach($tags_data as $tag_data){
				foreach($tag_data['ans_array'] as $ans_array){
					$ans_id = $ans_array['ans_id'];
					$outcome_tags = maybe_serialize($ans_array['outcome_tags']);
					$answer_data_has = SQB_QuizAnswers::loadByIdAndQuestionId($ans_id,$question_id);
					if(!empty($answer_data_has)){
						$sqbData = new SQB_QuizAnswers();
						$sqbData->setQuestionId($question_id);
						$sqbData->setAnswer($answer_data_has->getAnswer());
						$sqbData->setAnswerTitle($answer_data_has->getAnswerTitle());
						$sqbData->setCorrectAnswer($answer_data_has->getCorrectAnswer());  
						$sqbData->setAnswerPoints($answer_data_has->getAnswerPoints); 
						$sqbData->setIncorrectAnswerInfo($answer_data_has->getIncorrectAnswerInfo()); 
						$sqbData->setCorrectAnswerInfo($answer_data_has->getCorrectAnswerInfo()); 
						$sqbData->setAnswerOrder($answer_data_has->getAnswerOrder()); 			 
						$sqbData->setDate($date);
						$sqbData->setMatrixValues($answer_data_has->getMatrixValues());								
						$sqbData->setRecommendationHtml($answer_data_has->getRecommendationHtml());							
						$sqbData->setTagIds($outcome_tags);	
						$sqbData->setExtraOptions($answer_data_has->getExtraOptions());
						$sqbData->setId($answer_data_has->getId());
						$output = $sqbData->update();
					}
				}
			}
		}
	}else{
		$output = "Not Saved";
	}

	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_quiz_settings', 'sqb_save_quiz_settings');
add_action('wp_ajax_nopriv_sqb_save_quiz_settings', 'sqb_save_quiz_settings');

/* Save Quiz  */
function sqb_save_quiz_settings(){
	
	if(isset($_POST['form_data'])){
		
		$data = $_POST['form_data'];
			
		$next_button_html = $data['next_button_html'];
		$back_button_html = $data['back_button_html'];
		$download_certificate_button_html = $data['download_certificate_button_html'];
		$category_customizer_values = $data['category_customizer_values'];
		$retake_button_html = $data['retake_button_html'];
		$quiz_timer = $data['quiz_timer'];
		$show_firstname_outcome = $data['show_firstname_outcome'];
		$quiz_timer_limit = !empty($data['quiz_timer_limit']) ? $data['quiz_timer_limit'] : '';
		$progress_bar = $data['progress_bar'];
		$grade_quiz = !empty($data['grade_quiz']) ? $data['grade_quiz'] : '';
		$quiz_passmark = !empty($data['quiz_passmark']) ? $data['quiz_passmark'] : '';
		$already_take_the_quiz = !empty($data['already_take_the_quiz']) ? $data['already_take_the_quiz'] : '';
		$quiz_attempts_allowed = !empty($data['quiz_attempts_allowed']) ? $data['quiz_attempts_allowed'] : '';
		$show_correct_ans = !empty($data['show_correct_ans']) ? $data['show_correct_ans'] : '';
		$questions_random = !empty($data['questions_random']) ? $data['questions_random'] : '';
		$answers_random = $data['answers_random'];
		$move_question = $data['move_question'];
		$show_for_notloggedin_user = $data['show_for_notloggedin_user'];		
		$total_attempts = $data['total_attempts'];		
		$progressActive = $data['progressActive'];		
		$progressInactive = $data['progressInactive'];	 
		$answer_text_color = $data['answer_text_color'];	 	
		$answer_background = $data['answer_background'];	 	
		$answer_background1 = $data['answer_background1'];	 	
		$correct_answer_msg = $data['correct_answer_msg'];		
		$incorrect_answer_msg = $data['incorrect_answer_msg'];		
		$pick_ans_msg = $data['pick_ans_msg'];		
		$sqb_question_cust = $data['sqb_question_cust'];		
		$sqb_answer_cust = $data['sqb_answer_cust'];		
		$sqb_incorrect_ans_exp = $data['sqb_incorrect_ans_exp'];		
		$username_empty_msg = $data['username_empty_msg'];		
		$required_field = !empty($data['required_field']) ? $data['required_field'] : '';		
		$gdpr_required_field = !empty($data['gdpr_required_field']) ? $data['gdpr_required_field'] : '';	
		$outcome_screen_answer = $data['outcome_screen_answer'];		
		$outcome_screen_result = $data['outcome_screen_result'];		
		$outcome_screen_correct_answer = $data['outcome_screen_correct_answer'];		
		$outcome_screen_incorrect_answer = $data['outcome_screen_incorrect_answer'];	
		$email_empty_msg = $data['email_empty_msg'];		
		$terms_condition_msg = $data['terms_condition_msg'];				
		$show_first_name_screen = $data['show_first_name_screen'];				
		$show_analyzing_result = $data['show_analyzing_result'];				
		$show_analyzing_result_time = $data['show_analyzing_result_time'];				
		$show_first_name_screen_temp = $data['show_first_name_screen_temp'];				
		$show_analyzing_result_temp = $data['show_analyzing_result_temp'];				
		$fb_share_thank_you_msg = $data['fb_share_thank_you_msg'];				
		$fb_share_error_msg = $data['fb_share_error_msg'];				
		$valid_email = $data['valid_email'];				
		$already_taken_quiz = $data['already_taken_quiz'];				
		$not_passed_quiz_msg = $data['not_passed_quiz_msg'];				
		$quizid = $data['quizid'];		
		$date = date('Y-m-d H:i:s');	
		$result_background_color = $data['result_background_color'];	 	
		$result_background_color1 = $data['result_background_color1'];	
		$progressSettings = $progressActive.'||'.$progressInactive;
		$answer_background = $answer_background.'||'.$answer_text_color."||".$answer_background1."||".$result_background_color."||".$result_background_color1;

		$select_quiz_bank = !empty($data['select_quiz_bank']) ? $data['select_quiz_bank'] : '';
		$limit_questions_displayed = !empty($data['limit_questions_displayed']) ? $data['limit_questions_displayed'] : '';
		$limit_input = !empty($data['limit_input']) ? $data['limit_input'] : '';

		$question_bank_all_data = $select_quiz_bank.'||'.$limit_questions_displayed.'||'.$limit_input;
		
		
		$skip_question_btn_html = $data['skip_question_btn_html'];	
		$skip_question_customizer = $data['skip_question_customizer'];	
		
		$file_upload_btn_html = $data['file_upload_btn_html'];	
		$change_vote_btn_html = !empty($data['change_vote_btn_html']) ? $data['change_vote_btn_html'] : '';	
		$vote_btn_html = !empty($data['vote_btn_html']) ? $data['vote_btn_html'] : '';	
		$file_upload_customizer = $data['file_upload_customizer'];
		$change_vote_customizer = !empty($data['change_vote_customizer']) ? $data['change_vote_customizer'] : '';
		$vote_customizer = !empty($data['vote_customizer']) ? $data['vote_customizer'] : '';
		
		$user_shortcode_not_login = $data['user_shortcode_not_login'];	
		
		$give_points = $data['give_points'];
		$points = $data['points'];
		$pass_criteria = $data['pass_criteria'];
		$pass_percent = $data['pass_percent'];
		$retake_pass_rule = $data['retake_pass_rule'];
		$display_quiz_points_message = urldecode($data['display_quiz_points_message']);
		
		$category_scoring_text1 = $data['category_scoring_text1'];
		$category_assessment_text1 = $data['category_assessment_text1'];
		$invalid_date_text = $data['invalid_date_text'];
		$pdf_download_success = $data['pdf_download_success'];
		$pdf_downloading_text = $data['pdf_downloading_text'];
		$logged_in_admin_msg = $data['logged_in_admin_msg'];
		$voting_closed = $data['voting_closed'];
		$quiz_details = $data['quiz_details'];
		$user_details = $data['user_details'];
		$user_answer = $data['user_answer'];
		$sqb_quiz_name = $data['sqb_quiz_name'];
		$sqb_date = $data['sqb_date'];
		$retake_count = $data['retake_count'];
		$time_spent = $data['time_spent'];
		$gdpr_terms = $data['gdpr_terms'];
		$quiz_result = $data['quiz_result'];
		$sqb_outcome = $data['sqb_outcome'];
		$sqb_name = $data['sqb_name'];
		$sqb_email = $data['sqb_email'];
		$user_email = !empty($data['user_email']) ? $data['user_email'] : '';
		$student_correct_answer = $data['student_correct_answer'];
		$points_scored = $data['points_scored'];
		$file_name = $data['file_name'];
		$student_incorrect = $data['student_incorrect'];
		$click_to_download = $data['click_to_download'];
		$file_upload_successfully = $data['file_upload_successfully'];
		$answer_no_longer = $data['answer_no_longer'];
		$sqb_weight = $data['sqb_weight'];
		$sqb_height = $data['sqb_height'];
		$sqb_certificate = $data['sqb_certificate'];
		$not_loggedin = $data['not_loggedin'];
		$dont_want_listed = $data['dont_want_listed'];
		$click_to_optout = $data['click_to_optout'];
		$logged_in_optout = $data['logged_in_optout'];
		$dont_want_listed_leaderboard = $data['dont_want_listed_leaderboard'];
		$limit_exceeded = $data['limit_exceeded'];
		$category_name_customize = $data['category_name_customize'];
		$click_to_play = $data['click_to_play'];
		$student_score = $data['student_score'];
		$sqb_total_points = $data['sqb_total_points'];
		$sqb_result = $data['sqb_result'];
		$sqb_score = $data['sqb_score'];
		$sqb_high = $data['sqb_high'];
		$sqb_medium = $data['sqb_medium'];
		$sqb_low = $data['sqb_low'];
		$sqb_valid_phonenumber = $data['sqb_valid_phonenumber'];
		$upload_button_text = $data['upload_button_text'];
		$file_uploaded_message = $data['file_uploaded_message'];
		$file_upload_failed_message = $data['file_upload_failed_message'];
		$upload_filesize_limit_exceeds_message = $data['upload_filesize_limit_exceeds_message'];
		$file_upload_validation = $data['file_upload_validation'];
		$uploaded_filename_text = $data['uploaded_filename_text'];
		$transparent_background_settings = !empty($data['transparent_background_settings']);
		$customizer_styles = !empty($data['customizer_styles']) ? $data['customizer_styles'] : '';
		
		/*
		$sqbData = new SQB_QuizSettings();		
		$sqbData->setNextButtonHtml($next_button_html);
		$sqbData->setRetakeButtonHtml($retake_button_html);
		$sqbData->setProgressbarColor($progressSettings);	
		$sqbData->setAnswerBackground($answer_background);	
		$sqbData->setCorrectAnswerMsg($correct_answer_msg);	
		$sqbData->setIncorrectAnswerMsg($incorrect_answer_msg);	
		$sqbData->setUsernameEmptyMsg($username_empty_msg);	
		$sqbData->setEmailEmptyMsg($email_empty_msg);	
		$sqbData->setTermsConditionMsg($terms_condition_msg);	
		$sqbData->setFBShareThankYouMsg($fb_share_thank_you_msg);	
		$sqbData->setPickAnswerMsg($pick_ans_msg);	
		$sqbData->setDate($date);
		
		$quiz_setting_obj = SQB_QuizSettings::load();  	 
		
		if($quiz_setting_obj != false ){
			$sqbData->setId($quiz_setting_obj->getId());
			$id = $sqbData->update();
		}else{
			$id = $sqbData->create();
		}
		
		*/

		
		 $valid_msgs = array();
		 $valid_msgs['correct_answer_msg'] = $correct_answer_msg;
		 $valid_msgs['incorrect_answer_msg'] = $incorrect_answer_msg;
		 $valid_msgs['username_empty_msg'] = $username_empty_msg;
		 $valid_msgs['required_field'] = $required_field;
		 $valid_msgs['gdpr_required_field'] = $gdpr_required_field;
		 $valid_msgs['outcome_screen_answer'] = $outcome_screen_answer;
		 $valid_msgs['outcome_screen_result'] = $outcome_screen_result;
		 $valid_msgs['outcome_screen_correct_answer'] = $outcome_screen_correct_answer;
		 $valid_msgs['outcome_screen_incorrect_answer'] = $outcome_screen_incorrect_answer;
		 $valid_msgs['email_empty_msg'] =  $email_empty_msg;
		 $valid_msgs['terms_condition_msg'] =  $terms_condition_msg;
		 $valid_msgs['progressbar_color'] =  $progressSettings;
		 $valid_msgs['answer_background'] =  $answer_background;
		 $valid_msgs['valid_email'] =  $valid_email;
		 $valid_msgs['already_taken_quiz'] =  $already_taken_quiz;
		 $valid_msgs['not_passed_quiz_msg'] =  $not_passed_quiz_msg; 
		 $valid_msgs['pick_ans_msg'] =  $pick_ans_msg;
		 $valid_msgs['sqb_question_cust'] =  $sqb_question_cust;
		 $valid_msgs['sqb_answer_cust'] =  $sqb_answer_cust;
		 $valid_msgs['sqb_incorrect_ans_exp'] =  $sqb_incorrect_ans_exp;
		 $valid_msgs['fb_share_thank_you_msg'] =  $fb_share_thank_you_msg;
		 $valid_msgs['fb_share_error_msg'] =  $fb_share_error_msg;
		 $valid_msgs['next_button_html'] =  $next_button_html;
		 $valid_msgs['back_button_html'] =  $back_button_html;
		 $valid_msgs['download_certificate_button_html'] =  $download_certificate_button_html;
		 $valid_msgs['retake_button_html'] =  $retake_button_html;
		 
		 $valid_msgs['skip_question_btn_html'] =  $skip_question_btn_html;
		 $valid_msgs['skip_question_customizer'] =  $skip_question_customizer;
		 
		 $valid_msgs['file_upload_btn_html'] =  $file_upload_btn_html;
		 $valid_msgs['change_vote_btn_html'] =  $change_vote_btn_html;
		 $valid_msgs['vote_btn_html'] =  $vote_btn_html;
		 $valid_msgs['file_upload_customizer'] =  $file_upload_customizer;
		 $valid_msgs['change_vote_customizer'] =  $change_vote_customizer;
		 $valid_msgs['vote_customizer'] =  $vote_customizer;		 
		 $valid_msgs['user_shortcode_not_login'] =  $user_shortcode_not_login;
		 
		 $valid_msgs['category_scoring_text1'] =  $category_scoring_text1;
		 $valid_msgs['category_assessment_text1'] =  $category_assessment_text1;
		 $valid_msgs['invalid_date_text'] =  $invalid_date_text;
		 $valid_msgs['pdf_download_success'] =  $pdf_download_success;
		 $valid_msgs['pdf_downloading_text'] =  $pdf_downloading_text;
		 $valid_msgs['logged_in_admin_msg'] =  $logged_in_admin_msg;
		 $valid_msgs['voting_closed'] =  $voting_closed;
		 $valid_msgs['user_details'] =  $user_details;
		 $valid_msgs['user_answer'] =  $user_answer;
		 $valid_msgs['sqb_quiz_name'] =  $sqb_quiz_name;
		 $valid_msgs['sqb_date'] =  $sqb_date;
		 $valid_msgs['retake_count'] =  $retake_count;
		 $valid_msgs['time_spent'] =  $time_spent;
		 $valid_msgs['gdpr_terms'] =  $gdpr_terms;
		 $valid_msgs['quiz_result'] =  $quiz_result;
		 $valid_msgs['sqb_outcome'] =  $sqb_outcome;
		 $valid_msgs['sqb_name'] =  $sqb_name;
		 $valid_msgs['sqb_email'] =  $sqb_email;
		 $valid_msgs['user_email'] =  $user_email;
		 $valid_msgs['student_correct_answer'] =  $student_correct_answer;
		 $valid_msgs['points_scored'] =  $points_scored;
		 $valid_msgs['file_name'] =  $file_name;
		 $valid_msgs['student_incorrect'] =  $student_incorrect;
		 $valid_msgs['click_to_download'] =  $click_to_download;
		 $valid_msgs['file_upload_successfully'] =  $file_upload_successfully;
		 $valid_msgs['answer_no_longer'] =  $answer_no_longer;
		 $valid_msgs['sqb_weight'] =  $sqb_weight;
		 $valid_msgs['sqb_height'] =  $sqb_height;
		 $valid_msgs['sqb_certificate'] =  $sqb_certificate;
		 $valid_msgs['quiz_details'] =  $quiz_details;
		 $valid_msgs['not_loggedin'] =  $not_loggedin;
		 $valid_msgs['dont_want_listed'] =  $dont_want_listed;
		 $valid_msgs['click_to_optout'] =  $click_to_optout;
		 $valid_msgs['logged_in_optout'] =  $logged_in_optout;
		 $valid_msgs['dont_want_listed_leaderboard'] =  $dont_want_listed_leaderboard;
		 $valid_msgs['limit_exceeded'] =  $limit_exceeded;
		 $valid_msgs['category_name_customize'] =  $category_name_customize;
		 $valid_msgs['click_to_play'] =  $click_to_play;
		 $valid_msgs['student_score'] =  $student_score;
		 $valid_msgs['sqb_total_points'] =  $sqb_total_points;
		 $valid_msgs['sqb_result'] =  $sqb_result;
		 $valid_msgs['sqb_score'] =  $sqb_score;
		 $valid_msgs['sqb_high'] =  $sqb_high;
		 $valid_msgs['sqb_medium'] =  $sqb_medium;
		 $valid_msgs['sqb_low'] =  $sqb_low;
		 $valid_msgs['sqb_valid_phonenumber'] =  $sqb_valid_phonenumber;
		 $valid_msgs['upload_button_text'] =  $upload_button_text;
		 $valid_msgs['file_uploaded_message'] =  $file_uploaded_message;
		 $valid_msgs['file_upload_failed_message'] =  $file_upload_failed_message;
		 $valid_msgs['upload_filesize_limit_exceeds_message'] =  $upload_filesize_limit_exceeds_message;
		 $valid_msgs['file_upload_validation'] =  $file_upload_validation;
		 $valid_msgs['uploaded_filename_text'] =  $uploaded_filename_text;	 
		 $valid_msgs['category_customizer_values'] =  $category_customizer_values;	 
		 
		 if(sqb_check_dap_exists() && class_exists('Dap_SQBQuizCourseLessons') ){  
			 if(isset( $data['dap_see_details_btn_html'])){  
				 $valid_msgs['dap_see_details_btn_html'] =  $data['dap_see_details_btn_html'];
			 }
			 
			 if(isset( $data['dap_see_details_btn_customizer'])){
				 $valid_msgs['dap_see_details_btn_customizer'] =  $data['dap_see_details_btn_customizer'];
			 }
			 
			 if(isset( $data['dap_questions_customizer'])){
				 $valid_msgs['dap_questions_customizer'] =  $data['dap_questions_customizer'];
			 }
			 
			 if(isset( $data['dap_answer_customizer'])){
				 $valid_msgs['dap_answer_customizer'] =  $data['dap_answer_customizer'];
			 }
			}
		 
		 
		 try {
				foreach($valid_msgs as $key=> $value){
						sqbSetValidSettings($key, $value);
				 }
			}
		catch (PDOException $e) {
			//logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
		} catch (Exception $e) {
			//logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
		}
 
		if($quizid !=0){
			$all_background_color = $data['all_background_color'];	

			$screen_name = 'settings_background_color';
			$strm_type = 'settings';

			$new_obj_theme_data = new SQB_GlobalTheme();
			$new_obj_theme_data->setQuizId($quizid);
			$new_obj_theme_data->setName($screen_name);
			
			$new_obj_theme_data->setStatus('Y');
			$new_obj_theme_data->setDate($date);
			$new_obj_theme_data->setType($strm_type);
			$new_obj_theme_data->setCustomValues('');
			$new_obj_theme_data->setOuterStyleStatus('Y');
			
			$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quizid,$screen_name,$strm_type);
			if(isset($theme_data_has)){
				$new_obj_theme_data->setId($theme_data_has->getId());
				//$new_obj_theme_data->update();


				$existing_all_background_color = $theme_data_has->getValue();
				if(!empty($existing_all_background_color)){
					$existing_all_background_color = preg_replace_callback('!s:\d+:"(.*?)";!s', function($m) {return "s:" . strlen($m[1]) . ':"'.$m[1].'";'; }, $existing_all_background_color );
					$existing_all_background_color_un = unserialize($existing_all_background_color);
					$after_replace_data = array_replace($existing_all_background_color_un, $all_background_color);
					$existing_all_background_color_se = maybe_serialize($after_replace_data);
				}else{
					$existing_all_background_color_se = maybe_serialize($all_background_color);
				}

				$new_obj_theme_data->setValue($existing_all_background_color_se);
				$new_obj_theme_data->update();


			}else{
				$all_background_color = maybe_serialize($data['all_background_color']);	
				$new_obj_theme_data->setValue($all_background_color);
				$new_obj_theme_data->create();
			}


			
			$row = SQB_Quiz::loadArrById($quizid);
		
			$sqbData = SQB_Quiz::loadById($quizid);	
			if($sqbData == false){
				return false;
			}

			$sqbData = SQB_Quiz::loadById($quizid);	
			if($sqbData == false){
				return false;
			}
			$auto_submit =  $sqbData->getAutoSubmitOptin();
			echo json_encode($auto_submit);
			
			if($show_analyzing_result == "N" && $auto_submit == "Y"){
				$show_analyzing_result = 'Y';
			}

			$redirect_after_complete='';			
			if(isset($row['redirect_after_complete'])){
				$redirect_after_complete = $row['redirect_after_complete'];
			}
			
			$sqbData->setId($quizid);
			$sqbData->setQuizName($row['quiz_name']);
			$sqbData->setQuizDesc($row['quiz_desc']);
			$sqbData->setQuizType($row['quiz_type']);
			$sqbData->setGradeQuiz($grade_quiz);
			
			$sqbData->setProgressBar($row['progress_bar']);				
			$sqbData->setQuizSliderAnimation($row['quiz_slider_animation']);	
							
			$sqbData->setQuizDisplay($row['quiz_display']);				

			$display_on_first_screen = !empty($row['display_on_first_screen']) ? $row['display_on_first_screen'] : '';	
			$sqbData->setDisplayOnFirstScreen($display_on_first_screen);

			$row['start_template'] = !empty($row['start_template']) ? $row['start_template'] : '';
			$sqbData->setStartTemplate($row['start_template']);
			$sqbData->setQuizPassmark($quiz_passmark);
			$quiz_showanswer = !empty($row['quiz_showanswer']) ? $row['quiz_showanswer'] : '';
			$sqbData->setQuizShowAnswer($quiz_showanswer);
			//$sqbData->setQuizShowResult($row['quiz_show_result']);
			$sqbData->setQuizAttemptsAllowed($quiz_attempts_allowed);				
			$sqbData->setQuizPagination($row['quiz_pagination']);
			$sqbData->setQuestionPerPage($row['question_per_page']);
			$sqbData->setQuizTimer($quiz_timer);
			$sqbData->setShowFirstnameOutcome($show_firstname_outcome);
			$sqbData->setQuizTimerLimit($quiz_timer_limit);
			$sqbData->setQuizScore($row['quiz_score']);
			$sqbData->setQuizPercentage($row['show_percentage']);	
			$sqbData->setShowForNotLoggedInUser($show_for_notloggedin_user);	
			//$sqbData->setResultTemp($row['result_temp']);	
			$sqbData->setRedirectAfterComplete($redirect_after_complete);	
			$sqbData->setQuestionDisplay($row['question_display']);	
			$sqbData->setNumberOfQuestion($row['number_of_question']);	
			$sqbData->setQuestionsRandom($questions_random);	
			$sqbData->setAnswersRandom($answers_random);	
			$sqbData->setMoveQuestion($move_question);	
			$sqbData->setShowStartScreen($row['show_start_screen']);	
			$sqbData->setShowOptinScreen($row['show_optin_screen']);	
			$sqbData->setShowShareScreen($row['show_share_screen']);	
			$sqbData->setShowResultScreen($row['show_result_screen']);	
			$sqbData->setQuizShowFirstNameTemp($show_first_name_screen);	
			$sqbData->setQuizShowAnalyzingResult($show_analyzing_result);	
			$sqbData->setQuizAnalyzingResultTime($show_analyzing_result_time);	
			$sqbData->setTemplateDisplaySequence($row['template_display_sequence']);	
			$sqbData->setUserAddedMyEmailPlatform($row['user_added_my_email_platform']);	
			$user_added_platform = !empty($row['user_added_platform']) ? $row['user_added_platform'] : '';
			$sqbData->setUserAddedPlatform($user_added_platform);
			$sqbData->setOutcomeType($row['outcome_type']);	

			$outcome_based = !empty($row['outcome_based']) ? $row['outcome_based'] : '';
			$sqbData->setOutcomeScreen_Display($outcome_based);	
			$sqbData->setOutcomePage($row['outcome_page']);	
			$sqbData->setDisplayScoreOnPage($row['display_score_on_page']);	
			$sqbData->setDisplayCorrectAnsOnPage($row['display_correctans_on_page']);	
			$sqbData->setDisplayAnswerOptions($row['display_correctans_options']);	
			$sqbData->setDisplayQuesansOnOutcome($row['display_quesans_on_outcome']);	
			$sqbData->setOutcomeRedirectUrl($row['outcome_redirect_url']);		
			$sqbData->setUserOptinRedirect($row['user_opt_in_redirect']);		
			$sqbData->setUserOptinRedirectUrl($row['user_opt_in_redirect_url']);		
			$sqbData->setDate($row['date']);		
			$sqbData->setEnableBranching($row['enable_branching']);	
			$sqbData->setOutcomeScreenChartsSettings($row['outcome_screen_charts_settings']);	
			$sqbData->setShowNextButton($row['show_next_button']);		
			$sqbData->setAlreadyTakeTheQuiz($already_take_the_quiz);		
			$sqbData->setTotalAttempts($total_attempts);		
			$sqbData->setQuizShowCorrectAnswer($show_correct_ans);	
			$sqbData->setTemplate($row['template']);	
	 		$sqbData->setTransparentBackgroundSettings($row['transparent_background_settings']);	
	 		$sqbData->setCustomizerStyles($row['customizer_styles']);	
	 		$sqbData->setPreBuilt($row['pre_built']);
							
			$last_id = $sqbData->update(); 		
			
			$sqbData = new SQB_QuizTemplate();
			
			$sqbData->setFirstNameTemplate($show_first_name_screen_temp); 
			$sqbData->setAnalyzingResultTemp($show_analyzing_result_temp); 
			$sqbData->setQuizId($quizid); 
			
			$sqbData->updateByQuizId(); 
			
			$sqbDataQuizPoints = SQB_QuizPoints::loadByQuizId($quizid);
			
			if(isset($sqbDataQuizPoints)){
				$sqbDataQuizPoints->setQuizId($quizid);
				$sqbDataQuizPoints->setGivePoints($give_points);
				$sqbDataQuizPoints->setPoints($points);
				$sqbDataQuizPoints->setPassCriteria($pass_criteria);
				$sqbDataQuizPoints->setPassPercent($pass_percent);
				$sqbDataQuizPoints->setRetakePassRule($retake_pass_rule);
				$sqbDataQuizPoints->setDisplayMessage($display_quiz_points_message);
				$sqbDataQuizPoints->updateByQuizId();
			} else {
				$sqbDataQuizPoints = new SQB_QuizPoints();
				$sqbDataQuizPoints->setQuizId($quizid);
				$sqbDataQuizPoints->setGivePoints($give_points);
				$sqbDataQuizPoints->setPoints($points);
				$sqbDataQuizPoints->setPassCriteria($pass_criteria);
				$sqbDataQuizPoints->setPassPercent($pass_percent);
				$sqbDataQuizPoints->setRetakePassRule($retake_pass_rule);
				$sqbDataQuizPoints->setDisplayMessage($display_quiz_points_message);
				$sqbDataQuizPoints->setDate(date('Y-m-d h:i:s'));
				$sqbDataQuizPoints->create();
			}
		}
	}
	die;
}


add_action('wp_ajax_sqb_getquiz_settings', 'sqb_getquiz_settings');
add_action('wp_ajax_nopriv_sqb_getquiz_settings', 'sqb_getquiz_settings');

/* Save Quiz  */
function sqb_getquiz_settings(){
	$output = array();
	$quiz_first_name_template="";
  
	if(isset($_POST['quizid'])){
 		
		$quizid = $_POST['quizid'];		 
		
		if($quizid !=0){
			$screen_name = 'settings_background_color';
			$strm_type = 'settings';

			$output['setting_tag_background_color'] = "rgba(255,255,255,1)";
			$output['next_button_settings_background_color'] = "rgb(79, 108, 191)";
			$output['skip_question_button_for_quiz'] = "rgb(79, 108, 191)";
			$output['setting_ans_ad_recommendation'] = "rgba(255,255,255,1)";
			$output['setting_category_background_color']  = "rgba(255,255,255,1)";
			$output['setting_question_ads_color'] = "rgba(255,255,255,1)";
			$output['setting_personalization_color'] = "rgba(255,255,255,1)";
			$output['setting_analyzing_screen_color'] = "rgba(255,255,255,1)";
			$output['setting_progress_color'] = "rgba(79,108,191,1)";
			$output['setting_progress_inactive_color'] = "rgba(255,255,255,1)";
			$output['charts_bar_background_color'] = "rgba(255,255,255,1)";
			$output['top_bar_background_color'] = "rgba(245, 102, 64, 1)";

			$output['setting_tag_width_input'] = "900";
			$output['nexttbtn_width_for_quiz'] = "100";
			$output['nexttbtn_height_for_quiz'] = "12";

			$output['skip_question_btn_width_for_quiz'] = "100";
			$output['skip_question_btn_height_for_quiz'] = "12";
			
			$output['next_btn_html'] = '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background-color: rgba(79,108,191,1); color: #fff; height: auto; padding: 12px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 100px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>';

			$output['skip_btn_html'] = '<div class="skipped_btn skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>';

			$output['setting_category_width_input'] = "900";
			$output['setting_recommendation_width_input'] = "900";
			$output['setting_question_width_input'] = "750";
			$output['setting_personalization_width_input'] = "640";
			$output['setting_analyzing_width_input'] = "700";
			$output['placeholder_button_color'] = "#000000";

			$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quizid,$screen_name,$strm_type);

			if($theme_data_has){
				$colorpickerdata = maybe_unserialize($theme_data_has->getValue());

				if(!empty($colorpickerdata["setting_tag_background_color"])){
					$output['setting_tag_background_color'] = $colorpickerdata["setting_tag_background_color"];
				}

				if(!empty($colorpickerdata["next_button_settings_background_color"])){
					$output['next_button_settings_background_color'] = $colorpickerdata["next_button_settings_background_color"];
				}

				if(!empty($colorpickerdata["nexttbtn_width_for_quiz"])){
					$output['nexttbtn_width_for_quiz'] = $colorpickerdata["nexttbtn_width_for_quiz"];
				}

				if(!empty($colorpickerdata["nexttbtn_height_for_quiz"])){
					$output['nexttbtn_height_for_quiz'] = $colorpickerdata["nexttbtn_height_for_quiz"];
				}

				if(!empty($colorpickerdata["next_btn_html"])){
					$output['next_btn_html'] = stripslashes($colorpickerdata["next_btn_html"]);
				}

				if(!empty($colorpickerdata["skip_question_button_for_quiz"])){
					$output['skip_question_button_for_quiz'] = $colorpickerdata["skip_question_button_for_quiz"];
				}
				
				if(!empty($colorpickerdata["skip_question_btn_width_for_quiz"])){
					$output['skip_question_btn_width_for_quiz'] = $colorpickerdata["skip_question_btn_width_for_quiz"];
				}

				if(!empty($colorpickerdata["skip_question_btn_height_for_quiz"])){
					$output['skip_question_btn_height_for_quiz'] = $colorpickerdata["skip_question_btn_height_for_quiz"];
				}

				if(!empty($colorpickerdata["skip_btn_html"])){
					$output['skip_btn_html'] = stripslashes($colorpickerdata["skip_btn_html"]);
				}

				if(!empty($colorpickerdata["setting_category_background_color"])){
					$output['setting_category_background_color'] = $colorpickerdata["setting_category_background_color"];
				}

				if(!empty($colorpickerdata["setting_ans_ad_recommendation"])){
					$output['setting_ans_ad_recommendation'] = $colorpickerdata["setting_ans_ad_recommendation"];
				}

				if(!empty($colorpickerdata["setting_question_ads_color"])){
					$output['setting_question_ads_color'] = $colorpickerdata["setting_question_ads_color"];
				}

				if(!empty($colorpickerdata["setting_personalization_color"])){
					$output['setting_personalization_color'] = $colorpickerdata["setting_personalization_color"];
				}

				if(!empty($colorpickerdata["setting_analyzing_screen_color"])){
					$output['setting_analyzing_screen_color'] = $colorpickerdata["setting_analyzing_screen_color"];
				}

				if(!empty($colorpickerdata["setting_progress_color"])){
					$output['setting_progress_color'] = $colorpickerdata["setting_progress_color"];
				}

				if(!empty($colorpickerdata["setting_progress_inactive_color"])){
					$output['setting_progress_inactive_color'] = $colorpickerdata["setting_progress_inactive_color"];
				}

				if(!empty($colorpickerdata["charts_bar_background_color"])){
					$output['charts_bar_background_color'] = $colorpickerdata["charts_bar_background_color"];
				}
				if(!empty($colorpickerdata["top_bar_background_color"])){
					$output['top_bar_background_color'] = $colorpickerdata["top_bar_background_color"];
				}

				if(!empty($colorpickerdata["setting_tag_width_input"])){
					$output['setting_tag_width_input'] = $colorpickerdata["setting_tag_width_input"];
				}

				if(!empty($colorpickerdata["setting_category_width_input"])){
					$output['setting_category_width_input'] = $colorpickerdata["setting_category_width_input"];
				}
				
				if(!empty($colorpickerdata["setting_recommendation_width_input"])){
					$output['setting_recommendation_width_input'] = $colorpickerdata["setting_recommendation_width_input"];
				}
				
				if(!empty($colorpickerdata["setting_question_width_input"])){
					$output['setting_question_width_input'] = $colorpickerdata["setting_question_width_input"];
				}
				
				if(!empty($colorpickerdata["setting_personalization_width_input"])){
					$output['setting_personalization_width_input'] = $colorpickerdata["setting_personalization_width_input"];
				}
				
				if(!empty($colorpickerdata["setting_analyzing_width_input"])){
					$output['setting_analyzing_width_input'] = $colorpickerdata["setting_analyzing_width_input"];
				}

				if(!empty($colorpickerdata["placeholder_button_color"])){
					$output['placeholder_button_color'] = $colorpickerdata["placeholder_button_color"];
				}

			}

			$sqbData =  SQB_Quiz::loadById($quizid);		
			$sqbDataTemp =  SQB_QuizTemplate::loadByQuizId($quizid);		
			$sqbDataQuizPoints = SQB_QuizPoints::loadByQuizId($quizid);		
			
			if(isset($sqbData)){
				 
				$output['success'] = "true"; 
				$output['quizid'] =  $quizid; 
				$output['grade_quiz'] = $sqbData->getGradeQuiz(); 				
				$output['grade_quiz_name'] = "Quiz Title: <span>".stripslashes($sqbData->getQuizName())."</span>" ; 				
				$output['already_take_the_quiz'] = $sqbData->getAlreadyTakeTheQuiz(); 			
				$output['quiz_attempts_allowed'] = $sqbData->getQuizAttemptsAllowed(); 			
				$output['quiz_passmark'] = $sqbData->getQuizPassmark(); 			
				$output['quiz_timer'] = $sqbData->getQuizTimer(); 			
				$output['quiz_timer_limit'] = $sqbData->getQuizTimerLimit(); 			
				$output['progress_bar'] = $sqbData->getProgressBar(); 			
				$output['show_for_notloggedin_user'] = $sqbData->getShowForNotLoggedInUser(); 			
				$output['show_correct_ans'] = $sqbData->getQuizShowCorrectAnswer(); 			
				$output['questions_random'] = $sqbData->getQuestionsRandom(); 			
				$output['answers_random'] = $sqbData->getAnswersRandom(); 			 
				$output['move_question'] = $sqbData->getMoveQuestion(); 			 
				$output['total_attempts'] = $sqbData->getTotalAttempts(); 	
				$output['show_first_name_screen'] = $sqbData->getQuizShowFirstNameTemp(); 	
				$output['show_analyzing_result'] = $sqbData->getQuizShowAnalyzingResult(); 	
				$output['show_analyzing_result_time'] = $sqbData->getQuizAnalyzingResultTime(); 	
				$output['quiz_type'] = $sqbData->getQuizType(); 	
				$output['show_firstname_outcome'] = $sqbData->getShowFirstnameOutcome(); 	
				$output['template_num'] = $sqbData->getTemplate(); 	
						 
			}
			$output['quiz_first_name_template'] = '';
			$output['quiz_start_template'] = '';
			$output['quiz_analyzing_result_template'] = '';
			 
			if($sqbDataTemp){
				$quiz_start_template = $sqbDataTemp->getQuizStartTemplateHtml();
				$quiz_analyzing_result_template = $sqbDataTemp->getAnalyzingResultTemp();
				$quiz_first_name_template = $sqbDataTemp->getFirstNameTemplate();			
				if($quiz_first_name_template != ''){
					$output['quiz_first_name_template'] = stripslashes($quiz_first_name_template);						
				} 

				if($quiz_analyzing_result_template != '' && $quiz_analyzing_result_template != 'NULL'){
					$output['quiz_analyzing_result_template'] = stripslashes($quiz_analyzing_result_template);						
				} 
				$output['quiz_start_template'] = stripslashes($quiz_start_template);
			}
			if(isset($sqbDataQuizPoints)){
				$output['quiz_points_id'] = $sqbDataQuizPoints->getId();
				$output['quiz_give_points'] = $sqbDataQuizPoints->getGivePoints();
				$output['quiz_points'] = $sqbDataQuizPoints->getPoints();
				$output['quiz_points_pass_criteria'] = $sqbDataQuizPoints->getPassCriteria();
				$output['quiz_points_pass_percent'] = $sqbDataQuizPoints->getPassPercent();
				$output['quiz_points_retake_pass_rule'] = $sqbDataQuizPoints->getRetakePassRule();
				$output['display_quiz_points_message'] = stripslashes($sqbDataQuizPoints->getDisplayMessage());
			}
		}	 
	}
	 
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_getpdf_settings', 'sqb_getpdf_settings');
add_action('wp_ajax_nopriv_sqb_getpdf_settings', 'sqb_getpdf_settings');

/* Save Quiz  */
function sqb_getpdf_settings(){
	$output = array();
	$quiz_first_name_template="";
	if(isset($_POST['quizid'])){
		$quizid = $_POST['quizid'];		 
		if($quizid !=0){
			$sqbData =  SQB_Quiz::loadById($quizid);					
			if(isset($sqbData)){
				$output['success'] = "true"; 
				$output['quizid'] =  $quizid; 
				$getPdfFrontLastImage = $sqbData->getPdfFrontLastImage(); 	
				$explodePdfFrontLastImage =  explode('|', $getPdfFrontLastImage);
				$output['first_page_image'] = !empty($explodePdfFrontLastImage[0]) ?$explodePdfFrontLastImage[0] : '';
				$output['last_page_image'] = !empty($explodePdfFrontLastImage[1]) ?$explodePdfFrontLastImage[1] : '';
				$output['quiz_firstpage_width'] = !empty($explodePdfFrontLastImage[2]) ?$explodePdfFrontLastImage[2] : '';
				$output['quiz_first_page_align'] = !empty($explodePdfFrontLastImage[3]) ?$explodePdfFrontLastImage[3] : '';
				$output['quiz_first_page_horizontal'] = !empty($explodePdfFrontLastImage[4]) ?$explodePdfFrontLastImage[4] : '';
				$output['quiz_lastpage_width'] = !empty($explodePdfFrontLastImage[5]) ?$explodePdfFrontLastImage[5] : '';
				$output['quiz_last_page_align'] = !empty($explodePdfFrontLastImage[6]) ?$explodePdfFrontLastImage[6] : '';
				$output['quiz_last_page_horizontal'] = !empty($explodePdfFrontLastImage[7]) ?$explodePdfFrontLastImage[7] : '';
			}
		}	 
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_filter_lead_data', 'sqb_filter_lead_data');
add_action('wp_ajax_nopriv_sqb_filter_lead_data', 'sqb_filter_lead_data');

function sqb_filter_lead_data(){
	$filter_by = $_REQUEST['filter_by'];		 
	$quiz_id = $_REQUEST['quiz_id'];		 
	$quiz_type = $_REQUEST['quiz_type'];		
	
	if($filter_by == 'quiz'){
		$quizData = SQB_ManageLeads::loadByQuizId($quiz_id);			
	}else if($filter_by == 'quiz_type'){
		$quizData = SQB_ManageLeads::loadByQuizType($quiz_type);			
	}
	
	$html = '';

	if($quizData != false){
		foreach($quizData as $quizObj){
			
			$user_id = $quizObj->getUserId();
			$date = $quizObj->getDate();
			$user_name = $quizObj->getUsername();
			$user_info = get_userdata($user_id);	
			if(isset($user_info)){
				$name =  $user_info->first_name." ". $user_info->last_name;
				$email =  $user_info->user_email ;	
				$img_url = get_avatar_url($user_id, ['size' => '51']);	
			}else{
				$name =  "";	
				$img_url = plugin_dir_url(__FILE__)."../../includes/images/nouser.png";	
			}		
			
			$quiz_id = $quizObj->getQuizId();
			
			$quiz_data_leads = SQB_Quiz::loadById($quiz_id);	
            $quiz_title = '';
			if($quiz_data_leads == false){
				//continue;
			}else{
				$quiz_title = $quiz_data_leads->getQuizName();	
			}
			
			if($name==""){
				$name= $user_name;
			}			 
			$html .= '<tr role="row" class="odd">';	
			$html .= '<td><div class="lead-personal-info">';	
			$html .= '<figure class="lead-img"><img src='.$img_url.'></figure> ';	
			$html .= '<h3 class="u_name_cls">'. $name. '</h3>';	
			$html .= '</div>';	
			$html .= '</td>';	
			$html .= '<td>'.$email.'</td>';	
			$html .= '<td>'.$quiz_title.'</td>';	
			$html .= '<td class="text-center">'.$date.'</td>';	
			$html .= '<td class="text-center"><a href="javascript:void(0)" data-date="'.$date.'" data-userId ="'.$user_id.'" data-quizid="'.$quiz_id.'"  data-key ="'.$name.'" data-email="'. $email .'" class="view-profile-link viewManageLeadUserDetails">View Details</a></td>';
			$html .= '</tr>';
		}			
	}
	
	echo json_encode($html);die;
	 
}


/*Ads Save*/

add_action('wp_ajax_sqb_adsdata', 'sqb_adsdata');
add_action('wp_ajax_nopriv_sqb_adsdata', 'sqb_adsdata');

/* Save Outcome  */
function sqb_adsdata(){
	if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}
	$output="";

	if(isset($_POST)){		
		$ads_action='';
		if(isset($_POST['ads_action'])){
			$ads_action = $_POST['ads_action'];			
		}	
		

		if(isset($_POST['ads_data'])){
			$ads_data = $_POST['ads_data'];

			foreach($ads_data as $data){
				
				$ques_id = $data['ques_id'];
				$quiz_id = $data['quiz_id'];
				$ads_val = $data['ads_val'];
				$content = $data['content'];

				$quizQuestionObj = new SQB_QuizQuestions();
				$quiz_question_obj = SQB_QuizQuestions::loadByQuestionIdNotArray($ques_id); 					
				
				if(isset($quiz_question_obj) && $quiz_question_obj !=false){
					$quizQuestionObj->setId($quiz_question_obj->getId());
					$quizQuestionObj->setQuestionOrder($quiz_question_obj->getQuestionOrder());
				}
				$quizQuestionObj->setQuizId($quiz_id);
				$quizQuestionObj->setQuestionId($ques_id);		
				$quizQuestionObj->setQuestionAdsHtml($content);
				$quizQuestionObj->setShowAds($ads_val);
				$quizQuestionObj->update();
				$output = "Updated";
			}
		}
	}else{
		$output = "Not Updated";
	}
	echo json_encode($output);
	die;
}

/*Ads Save end*/


/***********outcome save start*************/
add_action('wp_ajax_sqb_outcometemp', 'sqb_outcometemp');
add_action('wp_ajax_nopriv_sqb_outcometemp', 'sqb_outcometemp');

/* Save Outcome  */
function sqb_outcometemp($form_data = ''){

	/*if(!current_user_can('administrator')) {
	 	echo 'Invalid request';die;
	}*/
	$quiz_id = '';
	$output= array();
	 $send_by_browser = true;
	if($form_data !="" && is_array($form_data)){
		$_POST = $form_data;
		$send_by_browser = false;
	}
	
	if(isset($_POST)){			 
				
		$outcomeObj = new SQB_Outcome();
		$outcome_action='';
		if(isset($_POST['outcome_action'])){
			$outcome_action = $_POST['outcome_action'];			
		}	
		$id='';		
		if(isset($_POST['id'])){
			$id = $_POST['id'];			
		}
		if($outcome_action == "redirectsave"){
			 
			$redirect = !empty($_POST['outcome_redirect']) ? $_POST['outcome_redirect'] : '';
			$outcome_tag = !empty($_POST['outcome_tag']) ? $_POST['outcome_tag'] : '';
			$outcome_screen = !empty($_POST['outcome_screen']) ? $_POST['outcome_screen'] : '';	 

			$quiz_outcome_obj = SQB_Outcome::loadById($id); 
			if(isset($quiz_outcome_obj)){
				$outcomeObj->setId($quiz_outcome_obj->getId());	
				$outcomeObj->setQuizId($quiz_outcome_obj->getQuizId());	
				$outcomeObj->setOutcomeName(stripslashes($quiz_outcome_obj->getOutcomeName()));	
				$outcomeObj->setOutcomeHtml($quiz_outcome_obj->getOutcomeHtml());	
				$outcomeObj->setPoint($quiz_outcome_obj->getPoint());	
				$outcomeObj->setPointRange($quiz_outcome_obj->getPointRange());	
				$outcomeObj->setCorrectAnsNum($quiz_outcome_obj->getCorrectAnsNum());	
				$outcomeObj->setCorrectAnsRange($quiz_outcome_obj->getCorrectAnsRange());	
				$outcomeObj->setRedirect($redirect);	
				$outcomeObj->setTag($quiz_outcome_obj->getTag());	
				$outcomeObj->setOutcomeScreen($outcome_screen);	
				$outcomeObj->setPDFHtml($quiz_outcome_obj->getPDFHtml());
				$outcomeObj->setPDFId($quiz_outcome_obj->getPDFId());
				$outcomeObj->setDate(date('Y_m_d'));
				$id = $outcomeObj->update();
				$output = $id;	
				$quiz_id  = $quiz_outcome_obj->getQuizId();	
				$output = array();
				$output['id'] = $id;	
			}	
			
		}else if($outcome_action == "tagsave"){
			 $outcome_action = $_POST['outcome_action'];
			$redirect = !empty($_POST['outcome_redirect']) ? $_POST['outcome_redirect'] : '';
			$outcome_tag = $_POST['outcome_tag'];
			$outcome_screen = $_POST['outcome_screen'];	 

			if(isset($_POST['outcome_tag_id']) && $_POST['outcome_tag_id'] > 0){
					//update the outcome tag
					if($id > 0){
						$quiz_outcome_obj = SQB_Outcome::loadById($id); 
						if(isset($quiz_outcome_obj)){
							$outcomeObj->setId($quiz_outcome_obj->getId());
							$outcomeObj->setQuizId($quiz_outcome_obj->getQuizId());	
							$outcomeObj->setOutcomeName(stripslashes($quiz_outcome_obj->getOutcomeName()));	
							$outcomeObj->setOutcomeHtml($quiz_outcome_obj->getOutcomeHtml());	
							$outcomeObj->setPoint($quiz_outcome_obj->getPoint());	
							$outcomeObj->setPointRange($quiz_outcome_obj->getPointRange());	
							$outcomeObj->setCorrectAnsNum($quiz_outcome_obj->getCorrectAnsNum());	
							$outcomeObj->setCorrectAnsRange($quiz_outcome_obj->getCorrectAnsRange());	
							$outcomeObj->setRedirect($quiz_outcome_obj->getRedirect());	
							$outcomeObj->setTag($outcome_tag);	
							$outcomeObj->setPDFHtml($quiz_outcome_obj->getPDFHtml());
							$outcomeObj->setPDFId($quiz_outcome_obj->getPDFId());
							$outcomeObj->setOutcomeScreen($quiz_outcome_obj->getOutcomeScreen());
							$outcomeObj->setDate(date('Y_m_d'));
							$id = $outcomeObj->update();
							$output = $id;		
							$quiz_id  = $quiz_outcome_obj->getQuizId();
							$output = array();
							$output['id'] = $id;
						}
					}
				} else {
					$output = array();
				    //create a new tag in tags table
				    $date = date('Y-m-d H:i:s');	
					$tagname = $outcome_tag;
					$sqb_tag_contents = '<div class="tags_content_temp" style="text-align: center;"><div class="analyzing_result_content"><div class="tags_content_heading sqb_tiny_mce_editor"><div>Heading goes here</div></div><div class="tags_content_desc sqb_tiny_mce_editor">Please enter tag description here</div></div></div>';
					$tag_field_id = '';

					if($tag_field_id == ''){
					$tag_field_id = null;
					}
					$sqb_tag_obj = new SQB_Tags();
					$sqb_tag_obj->setName($tagname);
					$sqb_tag_obj->setContent($sqb_tag_contents);
					$sqb_tag_obj->setDate($date);

					if(is_numeric($tag_field_id)){
					$sqb_tag_exists = SQB_Tags::loadByName($tagname);
					}

					if(isset($sqb_tag_exists)){
						$sqb_tag_obj->setId($tag_field_id);
						$tag_field_id = $sqb_tag_obj->update();
						$output['update_tags'] = "update";
					} else {
						$sqb_tag_count = SQB_Tags::loadByName($tagname);
						if(!empty($sqb_tag_count)){
						} else {
						   $output['create_tags'] = "create";
						   $tag_field_id = $sqb_tag_obj->create();
						   if($tag_field_id == 'error' || $tag_field_id == ''){
								$output['error'] = 'Sorry there was an issue with save';
						   }
						}
					}	
				    //update the outcome tag
				    if($id > 0){
						$quiz_outcome_obj = SQB_Outcome::loadById($id); 
						if(isset($quiz_outcome_obj)){
							$outcomeObj->setId($quiz_outcome_obj->getId());
							$outcomeObj->setQuizId($quiz_outcome_obj->getQuizId());	
							$outcomeObj->setOutcomeName(stripslashes($quiz_outcome_obj->getOutcomeName()));	
							$outcomeObj->setOutcomeHtml($quiz_outcome_obj->getOutcomeHtml());	
							$outcomeObj->setPoint($quiz_outcome_obj->getPoint());	
							$outcomeObj->setPointRange($quiz_outcome_obj->getPointRange());	
							$outcomeObj->setCorrectAnsNum($quiz_outcome_obj->getCorrectAnsNum());	
							$outcomeObj->setCorrectAnsRange($quiz_outcome_obj->getCorrectAnsRange());	
							$outcomeObj->setRedirect($quiz_outcome_obj->getRedirect());	
							$outcomeObj->setTag($outcome_tag);	
							$outcomeObj->setPDFHtml($quiz_outcome_obj->getPDFHtml());
							$outcomeObj->setPDFId($quiz_outcome_obj->getPDFId());
							$outcomeObj->setOutcomeScreen($quiz_outcome_obj->getOutcomeScreen());
							$outcomeObj->setDate(date('Y_m_d'));
							$id = $outcomeObj->update();
							$output = $id;		
							$quiz_id  = $quiz_outcome_obj->getQuizId();
							$output = array();
							$output['id'] = $id;
						}
					}
				}
		}else if($outcome_action == "deleteOutcome"){
		 	$output = array();
			SQB_Outcome::delete($id);

			if(isset($_POST['quiz_id'])){
				$quiz_id = $_POST['quiz_id'];
				global $sqb_add_outcome_pagination_limit;
				$outputArray = SQB_Outcome::loadByQuizId($quiz_id);
				

				$outputArray_count = count($outputArray); 
				$get_count =  $outputArray_count/$sqb_add_outcome_pagination_limit; 
				/*if(is_float($get_count)){
					//$page = (int)$get_count+1;
					//$page = (int)$get_count;
				}else{
					$output['reload_page'] = 'Y';
				}*/
				//echo $get_count;die;
				if ($get_count >= 1) {
				    // If there are more pages
				    $output['reload_page'] = 'Y';
				} else {
				    // If everything fits on one page, do nothing
				    $output['reload_page'] = 'N'; // or simply leave this line out if no need for explicit "no reload"
				}


				/*if(is_array($outputArray) && count($outputArray)){
					if(count($outputArray) >= $sqb_add_outcome_pagination_limit){
						$output['reload_page'] = 'Y';	
					}
				}*/

			}
			
			$output['success'] = 'success';

		}else{  
			$output = array();
			$id = '';
			$quiz_id = '';

			if(isset($_POST['outcomes_data'])){
				$outcomesData = $_POST['outcomes_data'];
				foreach($outcomesData as $data){
					
					$id = !empty($data['id']) ? $data['id'] : '';
					
					$quiz_outcome_obj = SQB_Outcome::loadById($id); 	
					$outcome_div_id = $data['outcome_div_id'];
					
					$quiz_id = $data['quiz_id'];
					$outcome_name = stripslashes($data['outcome_name']);
					$outcome_html = $data['outcome_html'];
					
					$_POST['chatgpt'] = isset($_POST['chatgpt']) ? $_POST['chatgpt'] : '';
					if($send_by_browser || $_POST['chatgpt'] == 'chatgpt'){ 
						$outcome_html = urldecode($outcome_html);
					}else{ 
						$outcome_html = urldecode(base64_decode($outcome_html));
					}
					$point = !empty($data['number_val']) ? $data['number_val'] : 0;
					$outcome_setting = !empty($data['outcome_setting']) ? $data['outcome_setting'] : '';
					if(!empty($outcome_setting)){
						$outcome_setting = maybe_serialize($outcome_setting);
					}else{
						$outcome_setting = "";
					}
					$range_val = !empty($data['range_val']) ? $data['range_val'] : 0;
					$range_val1 = '';
					if(isset($data['range_val1'])){
						$range_val1 = $data['range_val1'];
					}
					$point_range = $range_val."-".$range_val1;
					$enable_outcome_background_image = $data['enable_outcome_background_image'];
					
					$outcomeObj->setQuizId($quiz_id);
					$outcomeObj->setOutcomeName($outcome_name);		
					$outcomeObj->setOutcomeHtml($outcome_html);
					$outcomeObj->setPoint($point);	 
					$outcomeObj->setPointRange($point_range);	 
					$outcomeObj->setCorrectAnsNum($point);	 
					$outcomeObj->setCorrectAnsRange($point_range);
					$outcomeObj->setCustomizerOptions($outcome_setting);
					if(isset($quiz_outcome_obj) && $quiz_outcome_obj !=false){
						$outcomeObj->setRedirect($quiz_outcome_obj->getRedirect());	
						$outcomeObj->setTag($quiz_outcome_obj->getTag());	
						$outcomeObj->setOutcomeScreen($quiz_outcome_obj->getOutcomeScreen());
						$outcomeObj->setPDFHtml($quiz_outcome_obj->getPDFHtml());
						$outcomeObj->setPDFId($quiz_outcome_obj->getPDFId());
					}					
					$outcomeObj->setEnableBackgroundImage($enable_outcome_background_image);	
					$outcomeObj->setDate(date('Y_m_d'));

					if($id !=""){
						$outcomeObj->setId($id);	
						$id = $outcomeObj->update();
					}else{
						$id = $outcomeObj->create();
					}	
					
					$output['ids'][$outcome_div_id] = $id;		
				}
			}
		}	
	}else{
		$output = array();  
		$output['id']  = "";
	}			
	
	$outcome_hmtl = '';	
	if($quiz_id != '' && $quiz_id != 0){
		$outcomes_list = SQB_Outcome::loadByQuizId($quiz_id);
	
		if(is_array($outcomes_list)){
			
			foreach($outcomes_list as $outcome_list){
				
				
				$outcome_hmtl .= '<li data-id="">
								<div class="checkbox-custom-style">
									<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'">
									<span class="custom--checkbox"></span>
								</div>
								<label>'.$outcome_list->getOutcomeName().'</label>
							</li>';
			
				}
		}
	}
	$output['outcome_hmtl'] = $outcome_hmtl;
	$output['quiz_id'] = $quiz_id;
	
	if($form_data !="" && is_array($form_data)){
		return $output;
	}	
	
	echo json_encode($output);
	die;
}

/***********outcome save end*************/

/******fb tracking start*******/

add_action('wp_ajax_sqb_save_update_fb_tracking_id', 'sqb_save_update_fb_tracking_id');
add_action('wp_ajax_nopriv_sqb_save_update_fb_tracking_id', 'sqb_save_update_fb_tracking_id');

function sqb_save_update_fb_tracking_id(){
	$sqb_fb_pixel_id = $_REQUEST['sqb_fb_pixel_id'];
	$name = 'facebook';
	$key = 'fb_tracking_id';
	$fb_tracking_details = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
	
	$fbTrackingObj = new SQB_AutoresponderSettings();
	$fbTrackingObj->setName($name);	
	$fbTrackingObj->setKeyName($key);	
	$fbTrackingObj->setValue($sqb_fb_pixel_id);	
	
	$fbTrackingObj->setDate(date('Y-m-d h:i:s'));	

	if($fb_tracking_details == false){
		$fbTrackingObj->create();
	}else{
		$fbTrackingObj->setId($fb_tracking_details->getId());	
		$fbTrackingObj->update();	
	}
}

add_action('wp_ajax_sqb_delete_customjs', 'sqb_delete_customjs');

function sqb_delete_customjs(){

	$id = $_REQUEST['id'];
	$savedData = SQB_QuizTracking::loadById($id);	
	
	if(!empty($savedData)){
		$savedData->delete();
	}
}

add_action('wp_ajax_sqb_update_custom_js', 'sqb_update_custom_js');

function sqb_update_custom_js(){

	$id = $_REQUEST['id'];
	$status = $_REQUEST['status'];
	$savedData = SQB_QuizTracking::loadById($id);	
	
	if(!empty($savedData)){
		$savedData->setId($id);
		$savedData->setStatus($status);
		$savedData->update();
	}
}

add_action('wp_ajax_sqb_save_customjs', 'sqb_save_customjs');

function sqb_save_customjs(){

	$trackObj = new SQB_QuizTracking();
			
	$id = $_REQUEST['id'];
	$event_name = $_REQUEST['cjs_name'];
	$cjs_desc = $_REQUEST['cjs_desc'];
	$cjs_trigger = $_REQUEST['cjs_trigger'];
	$quiz_id = $_REQUEST['quiz_id'];

	$trackObj->setQuizId($quiz_id);
	$trackObj->setEventName($event_name);
	
	$trackObj->setCustomActionName($cjs_trigger);
	
	if(@$custom_action_id != ''){
		$trackObj->setCustomActionId(@$custom_action_id);
	}

	$trackObj->setTag('');
	$trackObj->setValue($cjs_desc);
	$trackObj->setTrackType('cjs');
	$trackObj->setStatus('Y');
	
	$savedData = SQB_QuizTracking::loadById($id);	
	
	if(empty($savedData)){
		$trackObj->create();
	}else{
		$trackObj->setId($savedData->getId());
		$trackObj->update();	
	}
}

add_action('wp_ajax_sqb_load_custom_js_by_id', 'sqb_load_custom_js_by_id');

function sqb_load_custom_js_by_id(){

	
	$id = $_REQUEST['id'];
	$data = SQB_QuizTracking::loadById($id);

	$response = array('status' => '');
	if(!empty($data)){
		$response['status'] = 'ok';
		$response['id'] = $data->getId();
		$response['name'] = $data->getEventName();
		$response['type'] = $data->getCustomActionName();
		$response['code'] = $data->getValue();
	}

	echo json_encode($response);
	exit;
}

add_action('wp_ajax_sqb_load_custom_js', 'sqb_load_custom_js');

function sqb_load_custom_js(){
	$quiz_id = $_REQUEST['quiz_id'];
	$quiz_name = $_REQUEST['quiz_name'];
	global $wpdb;

	

	$saved_quiz_data = SQB_QuizTracking::loadByCustomJSType($quiz_id);


	$html = '
	
	<div class="quiz-content-wrapper sgb-first-table-v2" bis_skin_checked="1">
	<div class="standardEvent-header">    
	<h5 class="sqb--sub-title">Standard Events</h5>

	<a href="javascript:void(0)" class="customjs-add" data-toggle="modal" data-target="#customjs_add_model"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Custom Script</a>

	</div>
	<table class="sqb_customjs_table dataTable">
		<thead>
			<tr role="row">
				<th class="text-center">Name</th>
				<th class="text-center">Trigger</th>
				<th class="text-center">Status</th>
				<th class="text-center">Action</th>
			</tr>
		<thead>
	
	
	
	   ';

	   $html .='
	   <tbody class="sqb-customjs-tbody">';

	   if(!empty($saved_quiz_data)){

	   foreach ($saved_quiz_data as $key => $data) {
		
		$id = $data->getId();
		$name = $data->getEventName();
		$trigger = $data->getCustomActionName();
		$checked = ($data->getStatus() == 'Y') ? 'checked' : '';
		$trigger_label = '';
		if($trigger == 'load'){
			$trigger_label = 'On Load';
		}else if($trigger == 'sqb_startbutton_click'){
			$trigger_label = 'After Startbutton Click';
		}else if($trigger == 'sqb_optin_click'){
			$trigger_label = 'After Opt-in click';
		}else if($trigger == 'sqb_contine_click'){
			$trigger_label = 'After Continue';
		}

		$html .= '<tr id="sqb-custom-js-'.$id.'" class="cls-sqb-custom-js">';
		$html .= '<td>'.$name.'</td>';
		$html .= '<td>'.$trigger_label.'</td>';
		$html .= '<td><div class="square-switch_onoff">
		<input class="checkbox sqb_customjs_status"  data-id="'.$id.'" name="sqb_customjs_status" type="checkbox" id="sqb_customjs_status_'.$id.'" value="Y" '.$checked.' >
		<label for="sqb_customjs_status_'.$id.'"></label>
	 </div></td>';
	 	$html .= '<td><a title="Edit Quiz" href="javascript:void(0);" onClick="sqb_edit_customjs('.$id.')" class="quiz-edit-customjs item-edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
		 <a title="Edit Quiz" href="javascript:void(0);" onClick="sqb_delete_customjs('.$id.')" class="quiz-edit-customjs item-trash-btn"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a></td>';
		$html .= '</tr>';

		/*$html .= '<div class="fb-tracking-option-list" id="sqb-custom-js-'.$id.'">
		<div class="fb-tracking-option">
		   <h4 class="event-name">
			  '.$name.'
			  <div class="tool-tip">
				 <i class="fa fa-info-circle" aria-hidden="true"></i> 
				 <div class="toll-tip-desc">'.$trigger_label.'</div>
			  </div>
		   </h4>
		</div>
		<div class="fb-tracking-option fb-tag-option">
		'.$trigger_label.'
		</div>
		<div class="fb-tracking-option fb-value-option">
		   <div class="square-switch_onoff">
			  <input class="checkbox sqb_customjs_status"  data-id="'.$id.'" name="sqb_customjs_status" type="checkbox" id="sqb_customjs_status_'.$id.'" value="Y" '.$checked.' >
			  <label for="sqb_customjs_status_'.$id.'"></label>
		   </div>
		   <div class="customjs-action">
		   
		   </div>
		</div></div>';*/

	   }
	}else{
		$html .= '<tr id="sqb-custom-js-0" class="cls-sqb-custom-js">';
		$html .= '<td colspan="4" align="center">No data found</td>';
		$html .= '</tr>';

	}

	   $html .='
	   <tbody>';

	   $html .='
	   </table>
 </div>';
 echo json_encode(array('html' => $html));die;
}


add_action('wp_ajax_sqb_load_question_answers_by_order', 'sqb_load_question_answers_by_order');
add_action('wp_ajax_nopriv_sqb_load_question_answers_by_order', 'sqb_load_question_answers_by_order');

function sqb_load_question_answers_by_order(){
	$quiz_id = $_REQUEST['quiz_id'];
	$quiz_name = $_REQUEST['quiz_name'];
	
	$saved_quiz_data = SQB_QuizTracking::loadByQuizId($quiz_id, 'fb');
	
	if($saved_quiz_data != false){
		$html = sqbLoadSavedQuizTrackData($quiz_id, $quiz_name);	
	}else{
		$quiz_data = SQB_Quiz::loadQuizDataByIdAndOrder($quiz_id);
		$html = sqbLoadNewQuizTrackData($quiz_data);	
	}
		
	echo json_encode(array('html' => $html));die;
}


add_action('wp_ajax_sqb_save_quiz_tracking_details', 'sqb_save_quiz_tracking_details');
add_action('wp_ajax_nopriv_sqb_save_quiz_tracking_details', 'sqb_save_quiz_tracking_details');

function sqb_save_quiz_tracking_details(){
	$quiz_id = $_REQUEST['quiz_id'];	
	$tracking_arr = $_REQUEST['tracking_arr'];	
	
	if(isset($tracking_arr) && is_array($tracking_arr)){

		$trackObj = new SQB_QuizTracking();
		$trackObj->deleteByQuizId($quiz_id);
		
		foreach($tracking_arr as $track){
			$event_name = $track['event_name'];	
			$tag = $track['tag'];	
			$value = $track['value'];	
			$custom_action_name = $track['custom_action_name'];	
			$custom_action_id = $track['custom_action_id'];	
			$track_type = $track['track_type'];	
			$status = $track['status'];	
			$question_id = '';
			$answer_id = '';
			$trackObj = new SQB_QuizTracking();
			
			$trackObj->setQuizId($quiz_id);
			$trackObj->setEventName($event_name);
			if($custom_action_name != ''){
				$trackObj->setCustomActionName($custom_action_name);
			}
			if($custom_action_id != ''){
				$trackObj->setCustomActionId($custom_action_id);
			}
			if($custom_action_name == 'question' ){
				$question_id = $custom_action_id;	
				$answer_id = 0;	
			}else if($custom_action_name == 'answer' ){
				$answer_id = $custom_action_id;	
				$question_id = (int)$custom_action_id;
			}else if($custom_action_name == 'outcome' ){
				$outcome_id = (int)$custom_action_id;
			}
			$trackObj->setTag($tag);
			$trackObj->setValue($value);
			$trackObj->setTrackType($track_type);
			$trackObj->setStatus($status);
			
			$savedData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, $event_name, 'fb',$question_id, $answer_id,$outcome_id);	
			
			if($savedData == false){
				$trackObj->create();
			}else{
				$trackObj->setId($savedData->getId());
				$trackObj->update();	
			}
			
			
		}
	}
}

function sqbLoadNewQuizTrackData($quiz_data){
	$html = '';
	$i = 1;
	
	
	if(isset($quiz_data) && is_array($quiz_data)){
		$id = $quiz_data[0]["quiz_id"];
		$name = stripslashes($quiz_data[0]["quiz_name"]);
		$html .= '<div class="fb-tracking-setting quiz-content-accordion sqb-table-view-v2">';
		$html .= '<div class="quiz-title-wrapper"><h3 class="quiz-title-setting">Quiz Title: '.stripslashes($name).'</h3></div><div class="quiz-content-wrapper sgb-first-table-v2"><h5 class="sqb--sub-title">Standard Events</h5><div class="fb-tracking-card-outer"><div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option"><label>Event Name</label>	</div><div class="fb-tracking-option fb-tag-option"><label>Custom Value <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"> Give standard events a unique custom value. You can create a custom conversion event in Facebook and configure it to display content to different audience based on the custom value. </div>
									</div></label></div><div class="fb-tracking-option fb-value-option"><label>Status </label></div></div><div class="fb-tracking-card"><div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Page View <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"> Tracked when users visit the page where you have the quiz start button or screen</div>
									</div> </h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" value="'.$name.'  - View" id="pageViewTag" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden"  id="pageViewValue" value="'.$id.'" placeholder="" class="form-control"><div class="square-switch_onoff">
				<input class="checkbox" name="pageViewStatus" type="checkbox" id="pageViewStatus" value="Y">
				<label for="pageViewStatus"></label>
			</div></div></div>';	
		
		$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Landing CTA Clicked <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"> Tracked when users click on the start button to start the quiz</div>
									</div> </h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="landingClickTag" value="'.$name.'  - Start" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" value="'.$id.'" id="landingClickValue" placeholder="" class="form-control"><div class="square-switch_onoff">
										<input class="checkbox" name="landingClickStatus" type="checkbox" id="landingClickStatus" value="Y">
										<label for="landingClickStatus"></label>
									</div></div></div>';	
		
		$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Lead Form Submitted <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"> Tracked when users enter their name and email and opt-in</div>
									</div> </h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="leadSubmitTag" value="'.$name.'  - Lead" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="leadSubmitValue"  value="'.$id.'" placeholder="" class="form-control"><div class="square-switch_onoff">
										<input class="checkbox" name="leadSubmitStatus" type="checkbox" id="leadSubmitStatus" value="Y">
										<label for="leadSubmitStatus"></label>
									</div></div></div>';
		
		$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Result CTA Clicked <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"> Tracked when users click on the continue button on the outcome screen</div>
									</div> </h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" id="resultClickedTag"  placeholder="" value="'.$name.'  - Result CTA" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="resultClickedValue"   value="'.$id.'" placeholder="" class="form-control"><div class="square-switch_onoff">
										<input class="checkbox" name="resultClickedStatus" type="checkbox" id="resultClickedStatus" value="Y">
										<label for="resultClickedStatus"></label>
				</div></div></div>';

		$html .= '</div></div></div>';

		//OUTCOME FB TRACKING HTML
	
		$outcome_obj = SQB_Outcome::loadByQuizId($id);
		$outcome_html = '';
		if(isset($outcome_obj) && !empty($outcome_obj)) {
			$i = 1;
			$all_outcome = array();
			foreach($outcome_obj as $outcome_detail){
				$outcome_id = $outcome_detail->getid();
				$outcome_name = stripslashes($outcome_detail->getOutcomeName());
				//$all_outcome['OUTCOME '.$i] = $outcome_id; 
				$i++;
				$outcome_html .= '<div class="fb-tracking-option-list outcome_event" data-id="'.$outcome_id.'">
				<div class="fb-tracking-option">
					<h4 class="event-name">'.$outcome_name.'</h4>
					</div>
					<div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" value="'.$outcome_name.'" id="outcomeViewTag_'.$outcome_id.'" class="form-control"></div>
					<div class="fb-tracking-option fb-value-option">
					<input type="hidden" id="outcomeViewValue" value="'.$id.'" placeholder="" class="form-control">
					<div class="square-switch_onoff">
						<input class="checkbox" name="outcomeViewStatus[]" type="checkbox" id="outcomeViewStatus_'.$outcome_id.'" value="Y">
						<label for="outcomeViewStatus_'.$outcome_id.'"></label>
					</div>
					</div>
				</div>';


			}
		}

		$html .= '<div class="quiz-content-wrapper outcome-table-v2 sgb-first-table-v2">
		<h5 class="sqb--sub-title">Quiz Outcome Events</h5>
		<div class="fb-tracking-card-outer">
		   <div class="fb-tracking-option-list main-heading-wrapper">
			  <div class="fb-tracking-option"><label>Outcome Title</label>	</div>
			  <div class="fb-tracking-option fb-tag-option"><label>Custom Value <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the outcome title (or anything else you want). It\'ll be sent to Facebook with the custom event:  outcome_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div>
			  <div class="fb-tracking-option fb-value-option"><label>Status</label></div>
		   </div>
		   <div class="fb-tracking-card">
			  '.$outcome_html.'
		   </div>
		</div>
	 </div>';
				
		$html .= '<div class="quiz-content-wrapper"><h5 class="sqb--sub-title">Quiz Question / Answers Event <small style="float:left;width:100%; color:#555">Segment audience based on the selected answers.</small></h5><div class="fb-tracking-card-outer que-answer-layout-wrapper"><div class="fb-tracking-card que-answer-layout">';
		foreach($quiz_data as $data){
			$questionTitle = stripslashes($data['question_title']);
			$question_type = $data['question_type'];
			if($questionTitle == ''){
				$questionTitle = stripslashes($data['question']);
			}
			$qid = $data['id'];
			
			$html .= '<div class="fb-tracking-list quiz_event_outer" data-id="'.$qid.'"><span class="checkbox-custom-style"><input type="checkbox" name="add_user_quiz" data-id="'.$qid.'" value="DAP" class="custom-checkbox-input showHideSqbTrackData"><span class="custom--checkbox"></span></span><label>'.stripslashes($questionTitle).'</label></div>';
			$html .= '<div class="fb-tracking-card-outer quiz_ques_answer_common_class quiz_question_outer'.$qid.'" style="display:none"><div class="fb-tracking-card question-heading-in-table"><h3 class="fb-tracking_subtitle">Question '.$i.': <small style="width: 100%; color: #555; display: block;">This event is tracked when users view the question. </small></h3>

			<div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option"><label>Question Title</label>	</div><div class="fb-tracking-option fb-tag-option"><label>Custom Event <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the question title (or anything else you want). It\'ll be sent to Facebook with the custom event:  question_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div><div class="fb-tracking-option fb-value-option"><label>Status</label></div></div>

			<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">'.$questionTitle.'</h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="questionTag'.$qid.'" value="'.stripslashes($questionTitle).'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="questionValue'.$qid.'"   value="'.$i.'" placeholder="" class="form-control"><div class="square-switch_onoff"> <input class="checkbox" name="questionValueStatus'.$qid.'" type="checkbox" id="questionValueStatus'.$qid.'" value="Y"> <label for="questionValueStatus'.$qid.'"></label> </div></div></div></div>';
			
			$answerData = SQB_QuizAnswers::loadByQuestionId($qid);
			$j = 1;
			$html .= '<h3 class="fb-tracking_subtitle mt-3">Track when users select a specific answer:</h3>';
			$html .= '<div class="answerOddEvenClass">
			<div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option fb-answer-option"><label>Answer Title</label>	</div><div class="fb-tracking-option fb-value-option"><label>Custom Event <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the answer title (or anything else you want). It\'ll be sent to Facebook with the custom event:  answer_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div></div>';
			foreach($answerData as $answer){
				$aid = $answer->getId();
				$answer_title = stripslashes($answer->getAnswerTitle());

				$answer_title_heading = ($answer_title == '') ? $question_type : $answer_title;

				$html .= '<div class="fb-tracking-card quiz_answer_outer quiz_ques_answer_common_class quiz_answer_outer'.$qid.'" style="display:none"  data-id="'.$aid.'"><div class="fb-tracking-option-list"><div class="fb-tracking-option fb-answer-option"><h4 class="event-name">'.$answer_title_heading.'</h4>	</div><div class="fb-tracking-option"><input type="text" placeholder=""  id="answerTag'.$j.$qid.'"  value="'.$answer_title.'" class="form-control"></div><div class="fb-tracking-option fb-value-option" style="display:none;"><input type="hidden"  id="answerValue'.$j.$qid.'"    value="'.$j.'" placeholder="" class="form-control"></div></div></div>';
				$j++;
			}
			$html .= '</div>';
			$html .= '</div>';
			$i++	;
		}
		$html .= '</div></div></div>';
	}
	return $html;	
}

function sqbLoadSavedQuizTrackData($quiz_id, $quiz_name){
	$html = '';
	$i = 1;
	if($quiz_id != ''){
		$html .= '<div class="fb-tracking-setting quiz-content-accordion sqb-table-view-v2">';
		$pageViewData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Page View', 'fb',$question_id = 0, $answer_id = 0);	
		
		$landingClickData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Landing CTA Clicked', 'fb',$question_id = 0, $answer_id = 0);	
		
		$leadSubmittedData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Lead Form Submitted', 'fb',$question_id = 0, $answer_id = 0);	
		
		$resultClickData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Result CTA Clicked', 'fb',$question_id = 0, $answer_id = 0);	

		$resultOutcomeData = SQB_QuizTracking::loadByOutcomeType($quiz_id);	
	

		if($pageViewData != false){
			$tag = stripslashes($pageViewData->getTag());
			$value = stripslashes($pageViewData->getValue());
			$checked = ($pageViewData->getStatus() == 'Y') ? 'checked' : '';


			$html .= '<div class="quiz-title-wrapper"><h3 class="quiz-title-setting">Quiz Title: '.stripslashes($quiz_name).'</h3></div><div class="quiz-content-wrapper sgb-first-table-v2"><h5 class="sqb--sub-title">Standard Events</h5><div class="fb-tracking-card-outer"><div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option"><label>Event Name</label>	</div><div class="fb-tracking-option fb-tag-option"><label>Custom Value <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> Give standard events a unique custom value. You can create a custom conversion event in Facebook and configure it to display content to different audience based on the custom value. </div> </div></label></div><div class="fb-tracking-option fb-value-option"><label>Status</label></div></div><div class="fb-tracking-card"><div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Page View <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> Tracked when users visit the page where you have the quiz start button or screen</div> </div></h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" value="'.$tag.'" id="pageViewTag" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden"  id="pageViewValue" value="'.$value.'" placeholder="" class="form-control">
			<div class="square-switch_onoff">
				<input class="checkbox" name="pageViewStatus" type="checkbox" id="pageViewStatus" value="Y" '.$checked.'>
				<label for="pageViewStatus"></label>
			</div>
			</div></div>';	
		}
		if($landingClickData != false){
			$tag = stripslashes($landingClickData->getTag());
			$value = stripslashes($landingClickData->getValue());
			$checked = ($landingClickData->getStatus() == 'Y') ? 'checked' : '';
			$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Landing CTA Clicked <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> Tracked when users click on the start button to start the quiz</div> </div></h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="landingClickTag" value="'.$tag.'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" value="'.$value.'" id="landingClickValue" placeholder="" class="form-control">
				<div class="square-switch_onoff">
					<input class="checkbox" name="landingClickStatus" type="checkbox" id="landingClickStatus" value="Y" '.$checked.'>
					<label for="landingClickStatus"></label>
				</div></div></div>';	
		}
		if($leadSubmittedData != false){
			$tag = stripslashes($leadSubmittedData->getTag());
			$value = stripslashes($leadSubmittedData->getValue());
			$checked = ($leadSubmittedData->getStatus() == 'Y') ? 'checked' : '';
			$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Lead Form Submitted <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> Tracked when users enter their name and email and opt-in</div> </div></h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="leadSubmitTag" value="'.$tag.'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="leadSubmitValue"  value="'.$value.'" placeholder="" class="form-control"><div class="square-switch_onoff">
					<input class="checkbox" name="leadSubmitStatus" type="checkbox" id="leadSubmitStatus" value="Y" '.$checked.'>
					<label for="leadSubmitStatus"></label>
				</div></div></div>';
		}
		if($resultClickData != false){
			$tag = stripslashes($resultClickData->getTag());
			$value = stripslashes($resultClickData->getValue());
			$checked = ($resultClickData->getStatus() == 'Y') ? 'checked' : '';

			$html .= '<div class="fb-tracking-option-list"><div class="fb-tracking-option"><h4 class="event-name">Result CTA Clicked <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> Tracked when users click on the continue button on the outcome screen</div> </div></h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" id="resultClickedTag"  placeholder="" value="'.$tag.'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="resultClickedValue"   value="'.$value.'" placeholder="" class="form-control"><div class="square-switch_onoff">
					<input class="checkbox" name="resultClickedStatus" type="checkbox" id="resultClickedStatus" value="Y" '.$checked.'>
					<label for="resultClickedStatus"></label>
				</div></div></div>';
		}
		$html .= '</div></div></div>';



		//OUTCOME FB TRACKING HTML
		$outcome_html = '';
		foreach ($resultOutcomeData as $key => $outcome) {
			$outcome_id = $outcome->custom_action_id;
			$o_id = SQB_Outcome::loadById($outcome_id);
			$outcome_name = stripslashes($outcome->tag);
			$checked = ($outcome->status == 'Y') ? 'checked' : '';
			$outcome_html .= '
			<div class="fb-tracking-option-list outcome_event" data-id="'.$outcome_id.'">
				<div class="fb-tracking-option">
				<h4 class="event-name">'.$o_id->getOutcomeName().'</h4>
				</div>
				<div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" value="'.$outcome_name.'" id="outcomeViewTag_'.$outcome_id.'" class="form-control"></div>
				<div class="fb-tracking-option fb-value-option">
				<input type="hidden" id="outcomeViewValue" value="'.$id.'" placeholder="" class="form-control">
				<div class="square-switch_onoff">
					<input class="checkbox" name="outcomeViewStatus_'.$outcome_id.'" type="checkbox" id="outcomeViewStatus_'.$outcome_id.'" value="Y" '.$checked.'>
					<label for="outcomeViewStatus_'.$outcome_id.'"></label>
				</div>
				</div>
			</div>';
		}

		$html .= '<div class="quiz-content-wrapper outcome-table-v2 sgb-first-table-v2">
		<h5 class="sqb--sub-title">Quiz Outcome Events</h5>
		<div class="fb-tracking-card-outer">
		   <div class="fb-tracking-option-list main-heading-wrapper">
			  <div class="fb-tracking-option"><label>Outcome Title</label>	</div>
			  <div class="fb-tracking-option fb-tag-option"><label>Custom Value <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the outcome title (or anything else you want). It\'ll be sent to Facebook with the custom event:  outcome_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div>
			  <div class="fb-tracking-option fb-value-option"><label>Status</label></div>
		   </div>
		   <div class="fb-tracking-card">
			  '.$outcome_html.'
		   </div>
		</div>
	 </div>';



		$quiz_data = SQB_Quiz::loadQuizDataByIdAndOrder($quiz_id);
		if(isset($quiz_data) && is_array($quiz_data)){
			$id = $quiz_data[0]["quiz_id"];
			$name = stripslashes($quiz_data[0]["quiz_name"]);	
			$html .= '<div class="quiz-content-wrapper"><h5 class="sqb--sub-title">Quiz Question / Answers Event</h5><div class="fb-tracking-card-outer que-answer-layout-wrapper"><div class="fb-tracking-card que-answer-layout">';
			foreach($quiz_data as $data){
				$questionTitle = stripslashes($data['question_title']);
				$question_type = $data['question_type'];
				if($questionTitle == ''){
					$questionTitle = stripslashes($data['question']);
				}
				$qid = $data['id'];
				$questionData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Track Custom', 'fb',$qid, 0);	
				
				$html .= '<div class="fb-tracking-list quiz_event_outer" data-id="'.$qid.'"><span class="checkbox-custom-style"><input type="checkbox" name="add_user_quiz" data-id="'.$qid.'" value="DAP" class="custom-checkbox-input showHideSqbTrackData"><span class="custom--checkbox"></span></span><label>'.stripslashes($questionTitle).'</label></div>';
				
				if($questionData != false){
					$tag = stripslashes($questionData->getTag());
					$value = stripslashes($questionData->getValue());
					$checked = ($questionData->getStatus() == 'Y') ? 'checked' : '';
				}else{
					$tag = 'Viewed Question '.$i;
					$value = $i;	
				}	

				$html .= '<div class="fb-tracking-card-outer quiz_ques_answer_common_class quiz_question_outer'.$qid.'" style="display:none"><div class="fb-tracking-card question-heading-in-table"><h3 class="fb-tracking_subtitle">Question '.$i.' Tracking :</h3> <div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option"><label>Question Title</label>	</div><div class="fb-tracking-option fb-tag-option"><label>Custom Event <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the question title (or anything else you want). It\'ll be sent to Facebook with the custom event:  question_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div><div class="fb-tracking-option fb-value-option"><label>Status</label></div></div> <div class="fb-tracking-option-list"><div class="fb-tracking-option "><h4 class="event-name">'.$questionTitle.'</h4>	</div><div class="fb-tracking-option fb-tag-option"><input type="text" placeholder="" id="questionTag'.$qid.'" value="'.$tag.'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden" id="questionValue'.$qid.'"   value="'.$value.'" placeholder="" class="form-control"><div class="square-switch_onoff"> <input class="checkbox" name="questionValueStatus'.$qid.'" type="checkbox" id="questionValueStatus'.$qid.'" value="Y" '.$checked.'> <label for="questionValueStatus'.$qid.'"></label> </div></div></div></div>';
				
				$answerData = SQB_QuizAnswers::loadByQuestionId($qid);
				$j = 1;
				$html .= '<h3 class="fb-tracking_subtitle mt-3">Track when users select a specific answer:</h3>';
				$html .= '<div class="answerOddEvenClass"><div class="fb-tracking-option-list main-heading-wrapper"><div class="fb-tracking-option fb-answer-option"><label>Answer Title</label>	</div><div class="fb-tracking-option fb-value-option"><label>Custom Event <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc"> You can set it to the answer title (or anything else you want). It\'ll be sent to Facebook with the custom event:  answer_title <br><br> You can create a custom conversion in FB using the custom event name and values. </div> </div></label></div><div class="fb-tracking-option fb-value-option"></div></div>';
				foreach($answerData as $answer){
					$aid = $answer->getId();
					$answer_title = stripslashes($answer->getAnswerTitle());
					$answer_title_heading = ($answer_title == '')? $answer_title : $question_type;

					$answerData = SQB_QuizTracking::loadByQuizIdEventAndTrackType($quiz_id, 'Track Custom', 'fb',0, $aid);	
					if($answerData != false){
						$tag = stripslashes($answerData->getTag());
						$value = stripslashes($answerData->getValue());
					}else{
						$tag = 'Selected Answer '.$j;
						$value = $j;	
					}	
					
					$html .= '<div class="fb-tracking-card quiz_answer_outer quiz_ques_answer_common_class quiz_answer_outer'.$qid.'" style="display:none"  data-id="'.$aid.'"><div class="fb-tracking-option-list"><div class="fb-tracking-option fb-answer-option"><h4 class="event-name">'.$answer_title_heading.'</h4>	</div><div class="fb-tracking-option"><input type="text" placeholder=""  id="answerTag'.$j.$qid.'"  value="'.$tag.'" class="form-control"></div><div class="fb-tracking-option fb-value-option"><input type="hidden"  id="answerValue'.$j.$qid.'"    value="'.$value.'" placeholder="" class="form-control"></div></div></div>';
					$j++;
				}	
				$html .= '</div></div>';
				$i++	;		
			}

			$html .= '</div></div></div>';
		}
		
	}
	
	return $html;		
}
/******fb tracking end*******/



add_action('wp_ajax_sqb_get_temp1', 'sqb_get_temp1');
add_action('wp_ajax_nopriv_sqb_get_temp1', 'sqb_get_temp1');

/* Save Answers  */
function sqb_get_temp1(){
	$output="";
	$outcometitle="";
	$randval = rand(1,100);	
	$quiz_id = 0;
	$lowestRange  = '';
	$highstRange  = '';
	if(isset($_POST)){			 
		$temp = $_POST['temp'];
		$main_temp = !empty($_POST['main_temp']) ? $_POST['main_temp'] : '';
		$quiz_temp = !empty($_POST['quiz_temp']) ? $_POST['quiz_temp'] : '';
		$quiz_type = !empty($_POST['quiz_type']) ? $_POST['quiz_type'] : '';
		$outcome_type = !empty($_POST['outcome_type']) ? $_POST['outcome_type'] : '';
		$outcome_based = !empty($_POST['outcome_based']) ? $_POST['outcome_based'] : '';
		$quiz_outcome_num = !empty($_POST['quiz_outcome_num']) ? $_POST['quiz_outcome_num'] : '';
		$outcome_num = (int)$quiz_outcome_num + 1;
		if($quiz_temp == 'start'){
			if($main_temp == 'template8'){
				$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".php");			
				$csspath =  plugins_url()."/smartquizbuilder/includes/templates/start/" . $main_temp . "/" . $main_temp . ".css";	
			}else if($main_temp == 'template9' && $temp == 'template2'){
				$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $main_temp . "/" . $main_temp . ".php");			
				$csspath =  plugins_url()."/smartquizbuilder/includes/templates/start/" . $main_temp . "/" . $main_temp . ".css";	
			}else{
				$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".php");			
				$csspath =  plugins_url()."/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".css";	
			}

			
			$img_url = plugins_url()."/smartquizbuilder/includes/images/start_image1.jpg";				 
			$file = file_get_contents($file);
			if($temp == 'template5'){
			$plugin_dir_url = plugin_dir_url(__FILE__);	
			$file = str_replace("%%IMGURL%%" , $plugin_dir_url ,$file);
			} else {
			$file = str_replace("%%IMGURL%%" , $img_url ,$file);
			}
			$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 
			$output = $cssfile .$file; 				 
		}elseif($quiz_temp == 'question'){
			$csspath =  plugins_url()."/smartquizbuilder/includes/templates/quiz/" . $temp . "/" . $temp . ".css";
			$output = $csspath; 			 
		}elseif($quiz_temp == 'lead'){

			if($main_temp == 'template9'){
				$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/" . $main_temp . "/" . $main_temp . ".php");	
			}else{
				$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/template1/template1.php");
			}
			$file = file_get_contents($file);
			$output = $file; 			 
		
		}elseif($quiz_temp == 'result'){
			
			$ques_length = $_POST['ques_length'];
			$firstStartRange = 0;
			
			
			
			if($ques_length > 2){
				
				
				
				$addNum = $ques_length / 3;
				$addNum = round($addNum, 0); 
				
				$firstEndRange = 0 + $addNum;

				$secondStartRange = $firstEndRange + 1;
				$secondEndRange = $secondStartRange + $addNum;

				$thirdStartRange = $secondEndRange + 1;
				$thirdEndRange = $thirdStartRange + $addNum;
				if($thirdEndRange > $ques_length){
					$thirdEndRange = $ques_length;
				}
			}else if($ques_length == 2){
				$firstEndRange = 1;

				$secondStartRange = 2;
				$secondEndRange = 2;

				$thirdStartRange = 2;
				$thirdEndRange = 2;
			}else if($ques_length == 1){
				$firstEndRange = 1;

				$secondStartRange = 1;
				$secondEndRange = 1;

				$thirdStartRange = 1;
				$thirdEndRange = 1;

			}else if($ques_length == 0){
				$firstEndRange = 1;

				$secondStartRange = 2;
				$secondEndRange = 3;

				$thirdStartRange = 3;
				$thirdEndRange = 4;
			}
			
			/*$prevHigherRange = $_POST['prevHigherRange'];
			if($prevHigherRange < $ques_length){
				$lowestRange = $_POST['prevHigherRange'] + 1;
				$highstRange = $lowestRange + $addNum;
			}else{
				$lowestRange = $_POST['prevLowestRange'];
				$highstRange = $_POST['prevHigherRange'];
			}*/
			
			$output = array();	
			$image_not_found = plugins_url()."/smartquizbuilder/includes/images/image_not_found.png";	
			$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/result/" . $temp . "/" . $temp . ".php");			
			$img_url = plugins_url()."/smartquizbuilder/includes/images/outcome2.jpg";				 
			$form_img_url = plugins_url()."/smartquizbuilder/includes/images/formquiz-thankyou.jpg";				 
			$csspath =  plugins_url()."/smartquizbuilder/includes/templates/result/" . $temp . "/" . $temp . ".css";
			$file = file_get_contents($file);
			if($quiz_type == 'form'){
				$file = str_replace("%%IMGURL%%" , $form_img_url ,$file);
			}else{
				$file = str_replace("%%IMGURL%%" , $img_url ,$file);
			}
			$curernt_data_time_random =  date('y_m_d_h_m_s').rand(10,1000);
			$file = str_replace("%%CURRENTDATETIMERANDOMIMG%%" , $curernt_data_time_random ,$file);
			$file = str_replace("%%IMGNOTFOUND%%" , $image_not_found ,$file);
			$cssfile = '<link href="'.$csspath.'?v='.$randval.'" rel="stylesheet">'; 
 			$outcome_count_class = 'card_res'.$randval;		
 			$show_fist_outcome_class = ' active show ';		
 			
			$output['outcome_li'] = '<li><a data-toggle="pill" class="active show" href="#'.$outcome_count_class.'">Outcome '.$outcome_num.'</a></li>';
			$topheading ='<div class="card res_data_cont tab-pane fade '.$show_fist_outcome_class.'" id="'.$outcome_count_class.'"> 
				<div id="rescollapseOne'.$randval.'" class="sqb_res_collapse collapse show" aria-labelledby="resheadingOne'.$randval.'" data-parent="#RES-accordion" style="">
					<div class="card-body">
						<input type="hidden" id="outcome_id"/><input type="hidden" id="outcome_redirect" value=""/><input type="hidden" id="outcome_screen" value=""/>';
			$topheadingend ='</div></div></div>';
			
			$outcometitle = '<div class="quiz-content-card outcome_page_show">
									<label for="" class="quiz_label">Outcome Title</label>
									<div class="quiz_right-content">
										<input type="text" name="outcome_name" value="" class="outcome_name">
										<input type="hidden" name="enable_outcome_background_image" value="N">									 
									</div> <div class="delete-clone"><span class="sqb_backend_show top_remove sqb_remove_section sqb_delete_btn" data-id="result_temp_id" ><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Outcome"></i></span><span class="sqb_backend_show top_remove sqb_backend_show clone-outcome" data-id="result_temp_id" data-quizid="'.$quiz_id.'"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></span></div>
								</div>';
								
			//if($quiz_type =="assessment" || $quiz_type =="scoring"  ){ // if quiz_type is assessment or scoring
				$numberdata = '<div class="quiz-content-card assessment_number_div " >';	
							//if($quiz_type =="assessment"){
								$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text assessment_label_text">Create different results for students with different correct answers.</label>';
							//}else if($quiz_type =="scoring"){
								$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text scoring_label_text">Create different results for students with different scores.</label>';
							//}

							$numberdata .= '<label for="" class="quiz_label">Enter Number</label>
							<div class="quiz_right-content">										 										 
								<input name="number_val" class="number_val small_input" type="number"/> 
							</div>		
						</div>	
						<div class="quiz-content-card assessment_range_div">';
						
								//if($quiz_type =="assessment"){
									$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text assessment_label_text">Create different results for students with different correct answer range.</label>';
									
								//}else if($quiz_type =="scoring"){
									$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text scoring_label_text">Create different results for students with different scoring range.</label>';
								//}
							$numberdata .= '<label for="" class="quiz_label">Enter Range</label>
							<div class="quiz_right-content">										 										 
								<input name="range_val" class="range_val_start small_input" value="'.$lowestRange.'" type="number"/> <div class="text_bet">to</div>  <input name="range_val1" value="'.$highstRange.'"  class="range_val_end small_input" type="number"/> 
							</div>'	;
							$numberdata .= '<span data-id="'.$randval.'" class="whatIsRange" id="whatIsRange'.$randval.'">What is range?</span>';

						$numberdata .= '<div class="whatIsRangeShowHide'.$randval.' whatIsRangeCommonClass" style="display:none"><span class="closeWhatIsRange" data-id="'.$randval.'">x</span><p>There are a total of '.$ques_length.' questions in this quiz. You could create any number of outcomes. <br>For e.g: You can create 3 different outcomes to cover different scores/correct answers.<br><strong>Range 1 : </strong>'.$firstStartRange.' to '.$firstEndRange.'<br><strong>Range 2 : </strong>'.$secondStartRange.' to '.$secondEndRange.'<br><strong>Range 3 : </strong>'.$thirdStartRange.' to '.$thirdEndRange.'</p></div></div>';

				
			/*}else{
				$numberdata ="";					 
			}*/
			$addbr ='<div class="border_bottom"></div>';
			$addbtn ='<div class="add_new_result_outer">
						<a href="javascript:void(0)" class="add_new_result">Add A New Outcome</a>
						<a href="javascript:void(0)" class="save_new_result">Save Outcome</a>
						
					</div>';
			
			$output['outcome_html'] = $topheading.$cssfile.$outcometitle.$numberdata.$addbr.$file.$addbtn.$topheadingend; 				 		 
		}
	 
	}else{  
		$output = "";
	}	
	
	echo json_encode($output);
	die;
}




function sqbGetDataForQuiz_rename(){  

	$id = $_REQUEST['id'];
	$error_msg = '';
	
	$output_result = array();
	if($id != '' && $id != 0){
		
		if(!isset($_POST['reload_fresh'])){
			$obj_exist = SQB_Funnel::loadByQuizId($id);
			if(isset($obj_exist)){
				$quizIdData = SQB_Quiz::loadById($id);
				if($quizIdData){
					$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
				}
				
				$drawflowArr = json_decode(stripslashes($obj_exist->getFunnelData()));
				$output_result['success'] = 'no error';
				$output_result['drawflowArr'] = $drawflowArr;
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				$max_question = false;
				if(count($funnelQuestionObj) > 6){
						$max_question = ture;
						$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
				}
				$output_result['total_quesitons'] = count($funnelQuestionObj);  
				
			
				echo json_encode($output_result) ;
				die;
			}
		}
		
		if(isset($_POST['reload_fresh'])){
			$obj_exist = SQB_Funnel::loadByQuizId($id);
			if(isset($obj_exist)){
				$quizIdData = SQB_Quiz::loadById($id);
				if($quizIdData){
					$output_result['enable_branching'] =   $quizIdData->getEnableBranching();
				}
				
				$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
				$max_question = false;
				if(count($funnelQuestionObj) > 6){
						$max_question = ture;
						$output_result['max_funnel_questions_active'] = count($funnelQuestionObj);
				}
				$output_result['total_quesitons'] = count($funnelQuestionObj);
				
				
				// append new question 
				$pos_x = 0;
				$drawflowArr1['drawflow']['Home']['data'] = array();
				$drawflowArr = json_decode(stripslashes($obj_exist->getFunnelData()));
				$funnel_old_question_ids = array();
				$funnel_delete_question_ids = array();
				$funnel_new_question_ids = array();
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
								/*if(isset($drawflowArr1['drawflow']['Home']['data'][$key])){
									unset($drawflowArr1['drawflow']['Home']['data'][$key]);
								}*/
							}else{
							
								if(count($funnel_data_single_row->outputs)){
									// delete outputs node id question is deleted
									foreach($funnel_data_single_row->outputs as  $outputs_key=>$funnel_data_single_row_outputs){
										
										foreach($funnel_data_single_row_outputs->connections as $output_key=>$funnel_data_single_row_output){
											$question_id = $funnel_data_single_row_output->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->inputs->$outputs_key->connections[$output_key]);
												//break;
												
											}
										}
									}
									// delete inputs node id question is deleted
									foreach($funnel_data_single_row->inputs as $inputs_key=>$funnel_data_single_row_inputs){
										foreach($funnel_data_single_row_inputs->connections as $input_key=>$funnel_data_single_row_input){
											$question_id = $funnel_data_single_row_input->node;
											if(in_array($question_id,$funnel_delete_question_ids)){
												unset($funnel_data_single_row->inputs->$inputs_key->connections[$input_key]);
												//break;    
											}
										}
									}
									
								}
								$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
							}
						
							
						
						}else{ // if loop closed for funnel_delete_question_ids
							$drawflowArr1['drawflow']['Home']['data'][$key] = $funnel_data_single_row;
						}
						$pos_x    = $pos_x + $funnel_data_single_row->pos_x;
						
					}// closed for each loop 
				}
				
				
				
				
				
			
				
				
				// delete funnel notes if questions is deleted;
				
				if(count($funnel_delete_question_ids)){
					foreach($funnel_delete_question_ids as $funnel_delete_question_id){
						if(isset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id])){
							//unset($drawflowArr1['drawflow']['Home']['data'][$funnel_delete_question_id]);
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
							   $pos_y = 50;
							   $i = 1;
							   $j = 2;	
							   $b = 1;				
							   $quiz_question_answer_template_html .= '<div class="funnel_question_title"  data-question-id="'.$quesData->getId().'"><span title="'.$quesData->getQuestionTitle().'">'.$quesData->getQuestionTitle()."</span></div>";

								$nextInput['input_'.$b]['connections'] = array();
								if($answerData != false){
									$quiz_question_answer_template_html .= '<div class="funnel_answer_wrapper">';
									foreach($answerData as $ans){
										$ans_id = $ans->getId();	
										
										$quiz_question_answer_template_html .= '<div class="funnel_answer_title" data-answer-id="'.$ans->getId().'"><span  title="'.$ans->getAnswerTitle().'">'.$ans->getAnswerTitle()."</span></div>";
										$tempAnsArr['output_'.$i] =    array ('connections' => array ( 0 =>  array ( 'node' => $ans_id, 'output' => 'input_1', ), ), );
										
										$i++;
										$j++;
									}	
									$quiz_question_answer_template_html .= '</div>';
								}
							$drawflowArr1['drawflow']['Home']['data'][$quesId]  = array ( 'id' => $quesId,'name' => 'qatemplate', 'data' =>  array (),'class' => 'qatemplate', 'html' => $quiz_question_answer_template_html, 'typenode' => false, 'inputs' => $nextInput,  'outputs' => $tempAnsArr, 'pos_x' =>$pos_x , 'pos_y' =>$pos_y );
							
							if($max_question){
								$pos_x = $pos_x + 200;		
							}else{	
								$pos_x = $pos_x + 300;		
							}
							
						}
						
					}// foreach loop closed 
					
					
				}
				
				$output_result['success'] = 'no error';
				$output_result['drawflowArr'] = $drawflowArr1;			   
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
		
		$quizData = SQB_Quiz::load();
		$quizIdData = SQB_Quiz::loadById($id);
		$quizTemplateData = SQB_QuizTemplate::loadByQuizId($id);
		
		if($quizIdData != false && $quizTemplateData != false){
			
			$funnelQuestionObj =  SQB_QuizQuestions::loadByQuizId($id);
			$max_question = false;
			if(count($funnelQuestionObj) > 6){
					$max_question = ture;
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
			
		    $quesAnsTemp = $zoominout.$quesAnsTemp1;

			
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
						
						//$html .= $quesData->getQuestion();
						$html .= '<div class="funnel_question_title" data-question-id="'.$quesData->getId().'" ><span title="'.$quesData->getQuestionTitle().'">'.$quesData->getQuestionTitle()."</span></div>";
						
						$nextInput['input_'.$b]['connections'] = array();
						if($answerData != false){
							$html .= '<div class="funnel_answer_wrapper">';
							foreach($answerData as $ans){
								$ans_id = $ans->getId();	
								//$html .= $ans->getAnswer();	
								$html .= '<div class="funnel_answer_title" data-answer-id="'.$ans->getId().'"><span  title="'.$ans->getAnswerTitle().'">'.$ans->getAnswerTitle()."</span></div>";
								$tempAnsArr['output_'.$i] =    array ('connections' => array ( 0 =>  array ( 'node' => $ans_id, 'output' => 'input_1', ), ), );
								//array_push($nextInput['input_'.$b]['connections'],  array ( 'node' => $a, 'input' => 'output_'.$i,));		
								//array_push($nextInput['input_'.$b]['connections'],  array ( 'node' => $a, 'input' => 'output_'.$i,));		
								$i++;
								$j++;
							}
							$html .= '</div>';	
							//$b++;
						}
						
					}
					if($html != ''){
						$html = stripslashes($html);
						$html = str_replace("%%QUESTIONANSWERS%%" , $html, $quesAnsTemp);
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
							$drawflowArr['drawflow']['Home']['data'][$quesId] = array ( 'id' => $quesId,'name' => 'qatemplate', 'data' =>  array (),'class' => 'qatemplate', 'html' => $quiz_question_answer_template_html, 'typenode' => false, 'inputs' => $currentInput,  'outputs' => $tempAnsArr, 'pos_x' =>$pos_x , 'pos_y' =>$pos_y );
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
			}
		}
			
			$output_result['success'] = 'no error';
			$output_result['drawflowArr'] = $drawflowArr;
			echo json_encode($output_result) ;
			die;
		}
	}else{
		$error_msg = 'Something Went Wrong';	
		$output_result['error'] = $error_msg;
		echo json_encode($error_msg);die;
	}	
	
	
}


add_action('wp_ajax_sqb_save_quiz_notification', 'sqb_save_quiz_notification');
add_action('wp_ajax_nopriv_sqb_save_quiz_notification', 'sqb_save_quiz_notification'); 

function sqb_save_quiz_notification(){
	if(isset($_POST['form_data'])){
		
		$data = $_POST['form_data'];
		$admin_from_email = !empty($data['notification_from_email']) ? $data['notification_from_email'] : '';
		$admin_email_subject = !empty($data['notification_email_subject']) ? $data['notification_email_subject'] : '';
		$admin_email_body = !empty($data['notification_email_body']) ? $data['notification_email_body'] : '';
		$date = date('Y-m-d H:i:s');

		$sqb_quiz_notification = new SQB_QuizNotifications();

		$quiz_id = !empty($data['quiz_id']) ? $data['quiz_id'] : '';
		$outcome_id = !empty($data['outcome_id']) ? $data['outcome_id'] : '';

		$notification_send_copy = !empty($data['notification_send_copy']) ? $data['notification_send_copy'] : '';
		$email_ids = !empty($data['email_ids']) ? $data['email_ids'] : '';
		$copy_email_subject = !empty($data['copy_email_subject']) ? $data['copy_email_subject'] : '';
		$notification_answer_format = !empty($data['notification_answer_format']) ? $data['notification_answer_format'] : '';
		$quiz_settings = !empty($data['quiz_settings']) ? $data['quiz_settings'] : '';

		$sqb_quiz_notification->setFromEmail($data['notification_from_email']);
		$sqb_quiz_notification->setFromName(@$data['notification_from_name']);
		$sqb_quiz_notification->setSubject($data['notification_email_subject']);
		$sqb_quiz_notification->setBody($data['notification_email_body']);
		$sqb_quiz_notification->setType($data['notification_type']);
		$sqb_quiz_notification->setSendEmail($data['notification_send_email']);
		$sqb_quiz_notification->setQuizType($data['quiz_type']);
		$sqb_quiz_notification->setAnswerFormat($notification_answer_format);
		$sqb_quiz_notification->setDate($date);
		$sqb_quiz_notification->setQuizId($quiz_id);
		$sqb_quiz_notification->setOutcomeId($outcome_id);
		$sqb_quiz_notification->setQuizSettings($quiz_settings);
		$sqb_quiz_notification->setSendCopy($notification_send_copy);
		$sqb_quiz_notification->setEmailIds($email_ids);
		$sqb_quiz_notification->setCopyEmailSubject($copy_email_subject);
		$sqb_quiz_notification->setAdminFromEmail($admin_from_email);
		$sqb_quiz_notification->setAdminSubject($admin_email_subject);
		$sqb_quiz_notification->setAdminBody($admin_email_body);

		if($data['quiz_settings'] == 'quiz_level'){
			$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizId($data['notification_type'], $quiz_id);	
		}else if($data['quiz_settings'] == 'outcome'){
			$sqb_notifications = SQB_QuizNotifications::loadByTypeAndOutcomeId($data['notification_type'], $outcome_id);	
		}else{
			if($data['quiz_type'] == 'admin_email'){
				$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizId($data['notification_type'], $quiz_id);
			}else{
				$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType($data['notification_type'], $data['quiz_type']);	
			}
		}
		if($sqb_notifications != false){
			$id = $sqb_notifications->getId();

			$sqb_quiz_notification->setId($id);
			$sqb_quiz_notification->update();
		}else{
			$sqb_quiz_notification->create();	
		}		
	}	
}  

add_action('wp_ajax_sqb_save_pdf_html', 'sqb_save_pdf_html');
add_action('wp_ajax_nopriv_sqb_save_pdf_html', 'sqb_save_pdf_html'); 

function sqb_save_pdf_html(){

	if(isset($_POST['outcome_id'])){
		$outcome_id = $_POST['outcome_id'];
		$pdf_html_body = $_POST['pdf_html_body'];
		$pdf_id = $_POST['pdf_id'];
		$quiz_outcome_obj = SQB_Outcome::loadById($outcome_id); 
		if(isset($quiz_outcome_obj)){
			$outcomeObj = new SQB_Outcome();
			$outcomeObj->setId($quiz_outcome_obj->getId());
			$outcomeObj->setQuizId($quiz_outcome_obj->getQuizId());	
			$outcomeObj->setOutcomeName(stripslashes($quiz_outcome_obj->getOutcomeName()));	
			$outcomeObj->setOutcomeHtml($quiz_outcome_obj->getOutcomeHtml());	
			$outcomeObj->setPoint($quiz_outcome_obj->getPoint());	
			$outcomeObj->setPointRange($quiz_outcome_obj->getPointRange());	
			$outcomeObj->setCorrectAnsNum($quiz_outcome_obj->getCorrectAnsNum());	
			$outcomeObj->setCorrectAnsRange($quiz_outcome_obj->getCorrectAnsRange());	
			$outcomeObj->setRedirect($quiz_outcome_obj->getRedirect());	
			$outcomeObj->setTag($quiz_outcome_obj->getTag());	
			$outcomeObj->setOutcomeScreen($quiz_outcome_obj->getOutcomeScreen());
			if($_REQUEST['pdf_mode'] == 'standard'){
				$outcomeObj->setPDFHtml($pdf_html_body);
			}else{
				$outcomeObj->setPDFHtml($quiz_outcome_obj->getPDFHtml());
			}
			$outcomeObj->setPDFId($pdf_id);
			$outcomeObj->setDate(date('Y_m_d'));
			$id = $outcomeObj->update();
			$output = $id;		
			$quiz_id  = $quiz_outcome_obj->getQuizId();
			$output = array();
			$output['id'] = $id;
		}
	}else{
		$output['error'] = 'something wrong!';
	}

	if(isset($_POST['quiz_id'])){
		
		$sqbData = SQB_Quiz::loadById($quiz_id);

		if(!empty($sqbData)){
			$all_other_data = $sqbData->getAllOtherOptions();
			if(!empty($all_other_data) && $all_other_data != 'NULL'){
				$all_other_options = maybe_unserialize($all_other_data);
				if(!empty($all_other_options) && is_array($all_other_options)){
					if(array_key_exists('pdf_mode', $all_other_options)){
						$all_other_options['pdf_mode'] = $_REQUEST['pdf_mode'];
						$all_data = serialize($all_other_options);
					}else{
						$all_data = array_merge($all_other_options, array('pdf_mode' => $_REQUEST['pdf_mode']));
						$all_data = serialize($all_data);
					}
				}else{
					$all_data = array('pdf_mode' => $_REQUEST['pdf_mode']);
					$all_data = serialize($all_data);
				}
			}else{
				$all_data = array('pdf_mode' => $_REQUEST['pdf_mode']);
				$all_data = serialize($all_data);
			}

			$sqbData->setQuizName($sqbData->getQuizName());
			$sqbData->setQuizDesc($sqbData->getQuizDesc());
			$sqbData->setQuizType($sqbData->getQuizType());
			$sqbData->setGradeQuiz($sqbData->getGradeQuiz());
			$sqbData->setProgressBar($sqbData->getProgressBar());
			$sqbData->setQuizDisplay($sqbData->getQuizDisplay());
			$sqbData->setQuizBlocking($sqbData->getQuizBlocking());
			$sqbData->setQuizPassmark($sqbData->getQuizPassmark());
			$sqbData->setQuizAttemptsAllowed($sqbData->getQuizAttemptsAllowed());
			$sqbData->setQuizPagination($sqbData->getQuizPagination());
			$sqbData->setQuestionPerPage($sqbData->getQuestionPerPage());
			$sqbData->setQuizTimer($sqbData->getQuizTimer());
			$sqbData->setQuizTimerLimit($sqbData->getQuizTimerLimit());
			$sqbData->setQuizScore($sqbData->getQuizScore());
			$sqbData->setQuizPercentage($sqbData->getQuizPercentage());
			$sqbData->setShowForNotLoggedInUser($sqbData->getShowForNotLoggedInUser());
			$sqbData->setRedirectAfterComplete($sqbData->getRedirectAfterComplete());
			$sqbData->setQuestionDisplay($sqbData->getQuestionDisplay());
			$sqbData->setNumberOfQuestion($sqbData->getNumberOfQuestion());
			$sqbData->setQuestionBankOption($sqbData->getQuestionBankOption());
			$sqbData->setQuestionsRandom($sqbData->getQuestionsRandom());
			$sqbData->setAnswersRandom($sqbData->getAnswersRandom());
			$sqbData->setShowStartScreen($sqbData->getShowStartScreen());
			$sqbData->setShowOptinScreen($sqbData->getShowOptinScreen());
			$sqbData->setShowShareScreen($sqbData->getShowShareScreen());
			$sqbData->setShowResultScreen($sqbData->getShowResultScreen());
			$sqbData->setQuizShowFirstNameTemp($sqbData->getQuizShowFirstNameTemp());
			$sqbData->setQuizShowAnalyzingResult($sqbData->getQuizShowAnalyzingResult());
			$sqbData->setQuizAnalyzingResultTime($sqbData->getQuizAnalyzingResultTime());
			$sqbData->setTemplateDisplaySequence($sqbData->getTemplateDisplaySequence());
			$sqbData->setUserAddedMyEmailPlatform($sqbData->getUserAddedMyEmailPlatform());
			$sqbData->setUserAddedPlatform($sqbData->getUserAddedPlatform());
			$sqbData->setOutcomeType($sqbData->getOutcomeType());
			$sqbData->setOutcomePage($sqbData->getOutcomePage());
			$sqbData->setDisplayScoreOnPage($sqbData->getDisplayScoreOnPage());
			$sqbData->setDisplayCorrectAnsOnPage($sqbData->getDisplayCorrectAnsOnPage());
			$sqbData->setDisplayAnswerOptions($sqbData->getDisplayAnswerOptions());
			$sqbData->setDisplayQuesansOnOutcome($sqbData->getDisplayQuesansOnOutcome());
			$sqbData->setOutcomeRedirectUrl($sqbData->getOutcomeRedirectUrl());
			$sqbData->setUserOptinRedirect($sqbData->getUserOptinRedirect());
			$sqbData->setUserOptinRedirectUrl($sqbData->getUserOptinRedirectUrl());
			$sqbData->setDate($sqbData->getDate());
			$sqbData->setEnableBranching($sqbData->getEnableBranching());
			$sqbData->setShowNextButton($sqbData->getShowNextButton());
			$sqbData->setAlreadyTakeTheQuiz($sqbData->getAlreadyTakeTheQuiz());
			$sqbData->setTotalAttempts($sqbData->getTotalAttempts());
			$sqbData->setQuizShowCorrectAnswer($sqbData->getQuizShowCorrectAnswer());
			$sqbData->setTemplate($sqbData->getTemplate());
			$sqbData->setShowVideo($sqbData->getShowVideo());
			$sqbData->setVideoURL($sqbData->getVideoURL());
			$sqbData->setPassCriteria($sqbData->getPassCriteria());
			$sqbData->setStatus($sqbData->getStatus());
			$sqbData->setSqbInsertQuiz($sqbData->getSqbInsertQuiz());
			$sqbData->setAllowRetake($sqbData->getAllowRetake());
			$sqbData->setQuizDisplayUrls($sqbData->getQuizDisplayUrls());
			$sqbData->setQuizDisplayInUrls($sqbData->getQuizDisplayInUrls());
			$sqbData->setQuizPopupTimeDelay($sqbData->getQuizPopupTimeDelay());
			$sqbData->setQuizPopupFrequency($sqbData->getQuizPopupFrequency());
			$sqbData->setQuizPopupPosition($sqbData->getQuizPopupPosition());
			$sqbData->setEmailVerification($sqbData->getEmailVerification());
			$sqbData->setQuizSliderAnimation($sqbData->getQuizSliderAnimation());
			$sqbData->setQuizSliderAnimationOption($sqbData->getQuizSliderAnimationOption());
			$sqbData->setResultDisplayOption($sqbData->getResultDisplayOption());
			$sqbData->setQuestionsTopBorder($sqbData->getQuestionsTopBorder());
			$sqbData->setTimerHtml($sqbData->getTimerHtml());
			$sqbData->setTimerCustomizer($sqbData->getTimerCustomizer());
			$sqbData->setTimerExpiredMsg($sqbData->getTimerExpiredMsg());
			$sqbData->setEnableBackgroundImage($sqbData->getEnableBackgroundImage());
			$sqbData->setTransparentBackgroundSettings($sqbData->getTransparentBackgroundSettings());
			$sqbData->setCategory($sqbData->getCategory());
			$sqbData->setOptinScreenPosition($sqbData->getOptinScreenPosition());
			$sqbData->setWeightedScore($sqbData->getWeightedScore());
	        $sqbData->setEmailNotificationSettings($sqbData->getEmailNotificationSettings());
			$sqbData->setAnsRecommendation($sqbData->getAnsRecommendation());
			$sqbData->setAnsTags($sqbData->getAnsTags());
			$sqbData->setRecommendedNextButton($sqbData->getRecommendedNextButton());
			$sqbData->setCustomizerStyles($sqbData->getCustomizerStyles());
			$sqbData->setMoveQuestion($sqbData->getMoveQuestion());
			$sqbData->setOutcomeScreen_Display($sqbData->getOutcomeScreen_Display());
			$sqbData->setOutcomeScreenChartsSettings($sqbData->getOutcomeScreenChartsSettings());
			$sqbData->setCategoryOption($sqbData->getCategoryOption());
			$sqbData->setDoubleOptin($sqbData->getDoubleOptin());
			$sqbData->setCustomizerStyleSetting($sqbData->getCustomizerStyleSetting());
			$sqbData->setExitPopupValue($sqbData->getExitPopupValue());
			$sqbData->setShowFirstnameOutcome($sqbData->getShowFirstnameOutcome());
			$sqbData->setShowDownloadButton($sqbData->getShowDownloadButton());
			$sqbData->setDownloadPDFButtonHtml($sqbData->getDownloadPDFButtonHtml());
			$sqbData->setPdfFrontLastImage($sqbData->getPdfFrontLastImage());
			$sqbData->setPollSettings($sqbData->getPollSettings());
			$sqbData->setAutoSubmitOptin($sqbData->getAutoSubmitOptin());
			$sqbData->setQnsAds($sqbData->getQnsAds());
			$sqbData->setAdsNextButton($sqbData->getAdsNextButton());
			$sqbData->setAdminEmail($sqbData->getAdminEmail());
			$sqbData->setSendCopy($sqbData->getSendCopy());
			$sqbData->setGameAnimation($sqbData->getGameAnimation());
			$sqbData->setGameAnimationsOptions($sqbData->getGameAnimationsOptions());
			$sqbData->setShowBackButton($sqbData->getShowBackButton());
			$sqbData->setGlobalStyle($sqbData->getGlobalStyle());
			$sqbData->setSettingLevel($sqbData->getSettingLevel());
			$sqbData->setAllOtherOptions($all_data);
			$sqbData->setId($sqbData->getId());
			$sqbData->update();
		}
	}

	echo json_encode($output);
	die;
}  

add_action('wp_ajax_sqb_user_delete_all_info_by_id', 'SQBUserDeleteAllInfoById');
add_action('wp_ajax_nopriv_sqb_user_delete_all_info_by_id', 'SQBUserDeleteAllInfoById');

//manage leads load user details
function SQBUserDeleteAllInfoById(){
	$output= array();
	if(isset($_POST)){

		// Check if admin user	
		if ( !current_user_can( 'manage_options' ) ) {
		    echo 'invalid request';exit;
		}

		$user_id = $_POST['user_id'];
		$output['success'] = 'Deleted';
		
		SQB_ManageLeads::deleteByUserId($user_id);
		SQB_UserQuizDetails::deleteByUserId($user_id);
		SQB_Users::deleteByUserId($user_id);
		SQB_InternalUsers::deleteById($user_id);
		
		$output['user_id'] = $user_id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
	
	
}	

add_action('wp_ajax_sqb_load_users_by_filter', 'SQBLoadUsersByFilter');
add_action('wp_ajax_nopriv_sqb_load_users_by_filter', 'SQBLoadUsersByFilter');

//manage leads load user details
function SQBLoadUsersByFilter(){
	
	$output= array();
	if(isset($_POST)){ 	
		$quiz_id = $_POST['quiz_id'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$table_body_html = '';
		   
		$quizObjArray = SQB_ManageLeads::getByQuizidAndStartDateAndEndDate($quiz_id,sqb_get_date_fl($start_date),sqb_get_date_fl($end_date));			
		//load internal user in SQB
		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] =$sqbInternalUser->getId();
			}			
		}
		
		$user_name='';
		$quizObjArrayNew = array();
	 
		if(is_array($quizObjArray) && count($quizObjArray)){
			foreach($quizObjArray as $quizObj){
				$row_id = $quizObj->getId();
				$quiz_id = $quizObj->getQuizId();
				$user_id = $quizObj->getUserId();
				$date = $quizObj->getDate();
				$source = $quizObj->getSource();
				$course_id = $quizObj->getCourseId();
				$certificate_id = $quizObj->getCertificateId();
				$user_source = $quizObj->getUserSource();
				
				if($quizObj->getUsername() != ''){
					$user_name = $quizObj->getUsername();
				}
				
				
				$name =  '';	
				$email =  '';
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
						$name = $sqbUserObj->getFirstName(); 	
					}					 				
					
				}else{ // Users from WP or DAP
					
					//exclude users from sqb_internal_users table
					if(in_array($user_id, $sqbInternalUserarr)){
						continue;
					}
					if($source == 'DAP' && sqb_check_dap_exists()){ 
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
						
					}else{
					
						$user_info = get_userdata($user_id);	
						//echo "<pre>"; print_r($user_info ) ; die;
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}	
					}
				}*/


				if($source == "WP" && $user_source == "WP"){
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}else{
						$name =  "";	
					}
				}else if($source == "WP" && $user_source == "SQB"){
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}	
					
				}else if($source == "DAP" && !empty($user_source)){
					if(class_exists('Dap_Session')){
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
					}
					
				}
				
				
				$quiz_data_leads = SQB_Quiz::loadById($quiz_id);	
				if($quiz_data_leads->id == ''){
					continue;
				}else{
					$quiz_title = $quiz_data_leads->getQuizName();	
				}
				
				if($name=="" || $name==" "){
					$name= $user_name;
				}
				
				$quizObjArrayNew[$email][] = array('row_id'=>$row_id,'source'=>$source,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'date'=>$date,'name'=>$name,'email'=>$email,'user_id'=>$user_id,'quiz_title'=>$quiz_title,'course_id'=>$course_id,'user_name'=>$user_name,'certificate_id' => $certificate_id); 	
			}// for each loop closed
			
						
			$table_body_html = ''; 	
			foreach($quizObjArrayNew as $quizObjSingleUserArrayNew){
				$html_table_td = '';
				@$sqb_i++;
				 
				//$quizObjSingleUserArrayNew = array_reverse($quizObjSingleUserArrayNew);
				foreach($quizObjSingleUserArrayNew as $quizObjSingleUserNew){
				
						$row_id =  $quizObjSingleUserNew['row_id'];
						$quiz_id = $quizObjSingleUserNew['quiz_id'];
						$user_id = $quizObjSingleUserNew['user_id'];
						$date =    $quizObjSingleUserNew['date'];
						$datep =    sqb_get_date($quizObjSingleUserNew['date']);
						
						$name =    $quizObjSingleUserNew['name'];
						$user_id = $quizObjSingleUserNew['user_id'];
						$quiz_title = $quizObjSingleUserNew['quiz_title'];
						$email = $quizObjSingleUserNew['email'];
						$source = $quizObjSingleUserNew['source'];
						$course_id = $quizObjSingleUserNew['course_id'];
						$certificate_id = $quizObjSingleUserNew['certificate_id'];
						 
						$quiz_title_sub = substr($quiz_title,0,80);   
						if(strlen($quiz_title) > 80){
							$quiz_title_sub = $quiz_title_sub.'...';
						}
						
					
						$quiz_title = '<div title="'.stripslashes($quiz_title).'" >'.stripslashes($quiz_title_sub).'</div>';
						/*if(count($quiz_title) == $sqb_i){
							
						}else{
							//$quiz_title = $quiz_title.'<hr>';
						}*/
						$sqb_i++; 
					    
					    $date_new  = explode(' ',$date);
					    //$date_new = $date_new[0].'('.$date_new[1].')'; 
					    
					    $date_new = $date_new[0].' ('.substr($date_new[1],0,5).')';
					     
					$certificate_btn = '';
					if(!empty($certificate_id)){
						$certificate = SQB_QuizCertificate::loadById($certificate_id);

						if(!empty($certificate) && $certificate->getStatus() == 'Y'){
							$certificate_btn = '<a href="?sqb_cert_pdf_download=1&lead_id='.$row_id.'&quiz_id='.$quiz_id.'&browser=1" class="quizDateTransBtn" target="_BLANK">Certificate</a>';
							
						}
						
					}
					

					$html_table_td .= '<div class="quiz_details" >'.$quiz_title.' <div class="quiz_details-right"><p class="quizDateTransBtn">'.$datep.'</p>'.$certificate_btn.'<a href="javascript:void(0)"  data-row-id="'.$row_id.'" data-date="'.$date.'" data-quizid="'.$quiz_id.'" data-userId ="'.$user_id.'" data-source="'.$source.'" data-key ="'.$name.'" data-email="'.$email.'"  data-course_id="'.$course_id.'" class="view-profile-link viewManageLeadUserDetails">View Results</a></div></div>';
		 
		 
				} // closed foreach loop $quizObjSingleUserArrayNew
				
				
				$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center"><div class="quiz_details--list">'.$html_table_td.'</div></td>
					<td class="text-center"><span onclick="sqb_lead_user_delete_by_id('.$user_id.')" class="delete-user">Delete User</span></td>
					</tr>';
					
						
				} // closed foreach loop $quizObjArrayNew
						
							
		}
						
	
	
	$table_html = '<table class="sqb_manage_leads_table">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center" style="width:300px">Email</th>
						
						<th class="text-center" style="width:700px">Quiz Details</th>
						<th class="text-center">Action</th>
						
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
	$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table>';
		
		
		
		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}



add_action('wp_ajax_sqb_load_search_answers_data', 'sqbLoadSearchAnswersData');
add_action('wp_ajax_nopriv_sqb_load_search_answers_data', 'sqbLoadSearchAnswersData');
function sqbLoadSearchAnswersData(){
	$output= array();
	if(isset($_POST)){
		$quiz_id = $_POST['quiz_id'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$table_body_html = '';
		
		/*$qarObj = SQB_QuestionAnswerReport::loadByQuizIdAndStartDateAndEndDate($quiz_id,$start_date,$end_date);
		
		$question_id_arr = array();
		$question_title_arr = array();
		$select_question_options = '';
		if(isset($qarObj) && count($qarObj)){
			foreach($qarObj as $qarObjData){
				$question_id = $qarObjData->getQuestionId();
				$ques_quiz_obj = SQB_QuizQuestionBank::loadById($question_id);
				if(isset($ques_quiz_obj)){
					$ques_question_type = $ques_quiz_obj->getQuestionType();
					$ques_id = $ques_quiz_obj->getId();
					$question_id_arr[] = $ques_id;
					
					$ques_question_title = $ques_quiz_obj->getQuestionTitle();
					$question_title_arr[] = $ques_question_title;
					
					$select_question_options .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$ques_id.'">'.stripslashes($ques_question_title).'</a>';
				}
			}
		}*/
		
		/*$selected_question_id = $_POST['question_id'];
		if($selected_question_id != '' && $selected_question_id > 0){
			$selected_question_id = $selected_question_id;
			$ques_obj = SQB_QuizQuestionBank::loadById($selected_question_id);
			if(isset($ques_obj)){
				$selected_question_title = $ques_obj->getQuestionTitle();	
			}
		} else {
			$selected_question_id = $question_id_arr[0];
			$selected_question_title = $question_title_arr[0];
		}
		
		$quiz_selected = false;
		if(isset($quiz_id) && $quiz_id > 0){
		$quiz_selected = true;
		}
		
		$question_not_selected = true;
		$selected_question_text = 'Select a Question';
		$selected_question_value = 0;
		if(isset($_POST['question_id']) && $_POST['question_id'] > 0){
		$question_not_selected = false;
		$selected_question_text = $selected_question_title;
		$selected_question_value = $selected_question_id;
		}
		
		if($quiz_selected){
		$select_question_option = '<a class="dropdown-item" href="javascript:void(0)" data-value="0">Select a Question</a>'.$select_question_options;												
		$table_html .= '<div class="sql-select_outer_section mb-4">
				<div class="dropdown dropdown-custom-style selectStartQuizSearchQuestion">
					<button class="dropdown-toggle" id="selectStartQuizSearchQuestion-id" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="'.$selected_question_value.'">'.$selected_question_text.'</button>
					<div class="dropdown-menu" aria-labelledby="selectStartQuizSearchQuestion-id">
						'.$select_question_option.'
					</div>
				</div>
			</div>';
		}*/
		
		
		if(isset($_POST['answer_id']) && $_POST['answer_id'] != 'ALL'){
			$table_body_html = '<tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Nooo data available in table</td></tr>';
			$quizObjArray = array();
		} else {
		$quizObjArray = SQB_ManageLeads::getByQuizidAndStartDateAndEndDate($quiz_id,$start_date,$end_date);	
		//load internal user in SQB
		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] =$sqbInternalUser->getId();
			}			
		}
		
		$user_name='';
		$quizObjArrayNew = array();
	 
		if(is_array($quizObjArray) && count($quizObjArray)){
			foreach($quizObjArray as $quizObj){
				$row_id = $quizObj->getId();
				$quiz_id = $quizObj->getQuizId();
				$user_id = $quizObj->getUserId();
				$date = $quizObj->getDate();
				$source = $quizObj->getSource();
				$course_id = $quizObj->getCourseId();
				$user_source = $quizObj->getUserSource();
				if($quizObj->getUsername() != ''){
					$user_name = $quizObj->getUsername();
				}
				
				
				$name =  '';	
				$email =  '';
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
						$name = $sqbUserObj->getFirstName(); 	
					}					 				
					
				}else{ // Users from WP or DAP
					
					//exclude users from sqb_internal_users table
					if(in_array($user_id, $sqbInternalUserarr)){
						continue;
					}
					if($source == 'DAP' && sqb_check_dap_exists()){ 
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
						
					}else{
					
						$user_info = get_userdata($user_id);	
						//echo "<pre>"; print_r($user_info ) ; die;
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}	
					}
				}*/
				if($source == "WP" && $user_source == "WP"){
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}else{
						$name =  "";	
					}
				}else if($source == "WP" && $user_source == "SQB"){
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}	
					
				}else if($source == "DAP" && !empty($user_source)){
					$dapUserObj = Dap_User::loadUserById($user_id);
					if(isset($dapUserObj)){						
						
						$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
						$email =  $dapUserObj->getEmail();
						
					}
				}
				
				$quiz_data_leads = SQB_Quiz::loadById($quiz_id);	
				if($quiz_data_leads->id == ''){
					continue;
				}else{
					$quiz_title = $quiz_data_leads->getQuizName();	
				}
				
				if($name=="" || $name==" "){
					$name= $user_name;
				}
				
				$quizObjArrayNew[$email][] = array('row_id'=>$row_id,'source'=>$source,'quiz_id'=>$quiz_id,'user_id'=>$user_id,'date'=>$date,'name'=>$name,'email'=>$email,'user_id'=>$user_id,'quiz_title'=>$quiz_title,'course_id'=>$course_id,'user_name'=>$user_name); 	
			}// for each loop closed
			
						
			$table_body_html = ''; 	
			foreach($quizObjArrayNew as $quizObjSingleUserArrayNew){
				$html_table_td = '';
				$sqb_i++;
				 
				//$quizObjSingleUserArrayNew = array_reverse($quizObjSingleUserArrayNew);
				foreach($quizObjSingleUserArrayNew as $quizObjSingleUserNew){
				
						$row_id =  $quizObjSingleUserNew['row_id'];
						$quiz_id = $quizObjSingleUserNew['quiz_id'];
						$user_id = $quizObjSingleUserNew['user_id'];
						$date =    $quizObjSingleUserNew['date'];
						$name =    $quizObjSingleUserNew['name'];
						$user_id = $quizObjSingleUserNew['user_id'];
						$quiz_title = $quizObjSingleUserNew['quiz_title'];
						$email = $quizObjSingleUserNew['email'];
						$source = $quizObjSingleUserNew['source'];
						$course_id = $quizObjSingleUserNew['course_id'];
						 
						$quiz_title_sub = substr($quiz_title,0,60);   
						if(strlen($quiz_title) > 60){
							$quiz_title_sub = $quiz_title_sub.'...';
						}
						
					
						$quiz_title = '<div title="'.stripslashes($quiz_title).'" >'.stripslashes($quiz_title_sub).'</div>';
						/*if(count($quiz_title) == $sqb_i){
							
						}else{
							//$quiz_title = $quiz_title.'<hr>';
						}*/
						$sqb_i++; 
					    
					    $date_new  = explode(' ',$date);
					    //$date_new = $date_new[0].'('.$date_new[1].')'; 
				
					    $date_new = $date_new[0].' ('.substr($date_new[1],0,5).')';
					     
					//$html_table_td .= '<div class="quiz_details" >'.$quiz_title.' <div class="quiz_details-right"><p class="quizDateTransBtn">'.$date.'</p><a href="javascript:void(0)"  data-row-id="'.$row_id.'" data-date="'.$date.'" data-quizid="'.$quiz_id.'" data-userId ="'.$user_id.'" data-source="'.$source.'" data-key ="'.$name.'" data-email="'.$email.'"  data-course_id="'.$course_id.'" class="view-profile-link viewManageLeadUserDetails">View Results</a></div></div>';
					$html_table_td .= '<div class="quiz_details" >'.$quiz_title.'</div>';
					
		 
		 
		 
				} // closed foreach loop $quizObjSingleUserArrayNew
				
				
				$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center"><div class="quiz_details--list">'.$html_table_td.'</div></td>
					<td class="text-center">'.$user_id.'</td>
					</tr>';
					
						
				} // closed foreach loop $quizObjArrayNew	
		}
		/*$table_html .= '<div class="sqb-search-box_settings">
				<!--<label for="" class="quiz_label">Select Search Criteria</label>
					<div class="sqb-search-box_settings-content">
						<label for="optin-after-questions-screen" class="radio-btn--outer">
						<input type="radio" id="optin-after-questions-screen" name="optin-screen-position" value="optin-after-questions-screen" checked="checked"> Show me ALL Responses for this question
						</label>
						<label for="optin-before-questions-screen" class="radio-btn--outer">
						<input type="radio" id="optin-before-questions-screen" name="optin-screen-position" value="optin-before-questions-screen"> Show me responses just for the selected answer
						</label>
					</div>-->
					
					<div class="select_answer_outer" style="display:none;">
						<div class="dropdown dropdown-custom-style selectStartQuizSearch">
							<button class="dropdown-toggle" id="selectStartQuizSearch-id" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="0">Select a Answer</button>
							<div class="dropdown-menu" aria-labelledby="selectStartQuizSearch-id">
								'.$select_answer_options.'
							</div>
						</div>
						<!--label-->
						<div class="sqb-selected-data">
							<h5><label>Question Title:</label>Do you want to see specific answers</h5>
							<h5><label>Selected Answer:</label>answers or all answers for this question?</h5>
						</div>
					</div>
					<label class="mt-3"><strong>Question Title: </strong>'.$selected_question_title.'</label>
			</div>';*/
	 }
	 
	$table_html .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">Name</th>
						<th class="text-center" style="width:300px">Email</th>
						<th class="text-center" style="width:700px">Selected Answer</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
	$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table></div>';

		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
	
}

add_action('wp_ajax_sqb_load_search_answers', 'sqbLoadSearchAnswers');
add_action('wp_ajax_nopriv_sqb_load_search_answers', 'sqbLoadSearchAnswers');

function sqbLoadSearchAnswers(){
	$output= array();
	if(isset($_POST)){
		$quiz_id = $_POST['quiz_id'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$question_id = $_POST['question_id'];
		
		$question_answer_obj = SQB_QuizAnswers::loadByQuestionId($question_id);
		$answersOptions .= '<a class="dropdown-item" href="javascript:void(0)" data-value="">ALL</a>';
		if(isset($question_answer_obj)){
			foreach($question_answer_obj as $question_answer_data){	
			$answersOptions .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$question_answer_data->getId().'">'.stripslashes($question_answer_data->getAnswerTitle()).'</a>';
			}
		}
		
		$result_html = '<div class="sql-select_outer_section mb-3 sqb_select_answer_dropdown">
			<label class="quiz_label mt-0 mb-2"><strong>Answer Title: </strong></label>
				<div class="right-section">
					<div class="dropdown dropdown-custom-style selectStartQuizSearchAnswer">
					
					<button class="dropdown-toggle" id="selectStartQuizSearchAnswer-id" aria-haspopup="true" aria-expanded="false" data-value="">Select an Answer</button>
					<div class="dropdown-menu" aria-labelledby="selectStartQuizSearchQuestion-id" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);">
						'.$answersOptions.'
					</div>
				</div>
				</div></div>';
		$output['result_html'] = $result_html;
	}
	echo json_encode($output);
	die;
}


function load_quiz_tags($quiz_id){
	$tags_object = SQB_Tags::load();
	$tags_list = '';
	$tags_list .= '<option data-value="" data-id="">Select Tag Name</option>';
	if(isset($tags_object)){
		foreach($tags_object as $key=>$tags){
			$tag_name = $tags->getName();
			$tag_id = $tags->getId();
			$tags_list .= '<option data-value="'.$tag_name.'" data-id="'.$tag_id.'">'.stripslashes($tag_name).'</option>';
		}
	}

	$outcome_tags_object = SQB_Outcome::loadtags($quiz_id);
	if(isset($outcome_tags_object)){
		foreach($outcome_tags_object as $outcome_tags){
			if(!empty($outcome_tags)){
				$tags_list .= '<option data-value="'.@$outcome_tag_name.'" data-id="'.@$outcome_tag_id.'">'.$outcome_tags.'</option>';
			}
		}
	}
	return $tags_list;
}



add_action('wp_ajax_SQBLoadquestionsByFilter', 'SQBLoadquestionsByFilter');
add_action('wp_ajax_nopriv_SQBLoadquestionsByFilter', 'SQBLoadquestionsByFilter');
function SQBLoadquestionsByFilter(){
	$output= array();
	if(isset($_POST)){
		$table_html = '';
		$table_body_html = '';
		$table_data = '';
		$quiz_id = $_POST['quiz_id'];
		$type = $_POST['type'];
		$check_category = $_POST['check_category'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		
		$questiones_array_data = SQB_QuizQuestions::loadByQuizIdAndOrder($quiz_id);
		$select_question_option = '';
		$selected_question_value = '';
		if($type == 'scoring'){
			$table_html .= '<div class="quiz-content-card pl-0 pr-0">
				<label for="" class="quiz_label mt-0 mb-2">Select what you want to search:</label>
				<div class="quiz_right-content d-inline-block">
					<label class="radio-btn--outer"><input type="radio" name="question_search" value="all" checked="">I want to see all responses</label>
					<label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_question">I want to see responses for a specific question</label>
					<label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_tag">Show users that have a specific tag</label><div class="tags-section" style="display:none;"><div class="tags-inner-box"><label for="" class="quiz_label">Enter Tag: </label><input type="text" name="sqb_search_tags" id="sqb_search_tags" value="" placeholder="Search tags"><input type="hidden" value="" id="sqb_search_tags_hidden"></div><div class="or-divider"><span>OR</span></div><label for="" class="quiz_label">Select Tag: </label><select id="select_tag_for_search" name="select_tag_for_search" class="">'.load_quiz_tags($quiz_id).'</select></div>
					<label class="radio-btn--outer radio-option-score-over"><input type="radio" name="question_search" value="score_over">Show responses with score over:</label><input style="display:none" placeholder="Enter Number" type="number" name="score_value" value="" class="score-value">';

					if($check_category == 'Y'){
						$table_html .= '<label class="radio-btn--outer radio-option-score-over"><input type="radio" name="question_search" value="check_category">Show responses with Category Score over: </label>
						<div class="category-section" style="display:none">
						<div class="select-category"><label class="category-label">Select Category</label>
						<select class="category_name" name="category_name">
						'.SqbLoadCategoryName($quiz_id).'
						</select></div>
						<div class="enter-category-value"><label class="value-label">Enter Value</label>
						<input placeholder="Enter Number" type="number" name="category_value" value="" class="category-value"></div></div>';
					}
				$table_html .= '</div>
			</div>';
		}else if($type == 'assessment'){
			$table_html .= '<div class="quiz-content-card pl-0 pr-0">
				<label for="" class="quiz_label mt-0 mb-2">Select what you want to search:</label>
				<div class="quiz_right-content d-inline-block">
					<label class="radio-btn--outer"><input type="radio" name="question_search" value="all" checked="">I want to see all responses</label>
					<label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_question">I want to see responses for a specific question</label>
					<label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_tag">Show users that have a specific tag</label><div class="tags-section" style="display:none;"><div class="tags-inner-box"><label for="" class="quiz_label">Enter Tag: </label><input type="text" name="sqb_search_tags" id="sqb_search_tags" value="" placeholder="Search tags"><input type="hidden" value="" id="sqb_search_tags_hidden"></div><div class="or-divider"><span>OR</span></div><label for="" class="quiz_label">Select Tag: </label><select id="select_tag_for_search" name="select_tag_for_search" class="">'.load_quiz_tags($quiz_id).'</select></div>
					<label class="radio-btn--outer radio-option-score-over"><input type="radio" name="question_search" value="score_over">Show responses where total # of correct answers is</label><input style="display:none" placeholder="Enter Number" type="number" name="score_value" value="" class="score-value">
				</div>
			</div>';
		}else{
			$table_html .= '<div class="quiz-content-card pl-0 pr-0"><label for="" class="quiz_label mt-0 mb-2">Select what you want to search:</label><div class="quiz_right-content d-inline-block"><label class="radio-btn--outer"><input type="radio" name="question_search" value="all" checked="">I want to see all responses</label><label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_question">I want to see responses for a specific question</label><label class="radio-btn--outer radio-option-question-specific"><input type="radio" name="question_search" value="specific_tag">Show users that have a specific tag</label><div class="tags-section" style="display:none;"><div class="tags-inner-box"><label for="" class="quiz_label">Enter Tag: </label><input type="text" name="sqb_search_tags" id="sqb_search_tags" value="" placeholder="Search tags"><input type="hidden" value="" id="sqb_search_tags_hidden"></div><div class="or-divider"><span>OR</span></div><label for="" class="quiz_label">Select Tag: </label><select id="select_tag_for_search" name="select_tag_for_search" class="">'.load_quiz_tags($quiz_id).'</select></div></div></div>';
		}
		
		$table_html .= '<div class="sql-select_outer_section mt-3 mb-3 show-question-search" style="display:none;">
				<label class="quiz_label mt-0 mb-2"><strong>Question Title: </strong></label>
				<div class="right-section">
				<div class="dropdown dropdown-custom-style selectStartQuizSearchQuestion"><button class="dropdown-toggle" id="selectStartQuizSearchQuestion-id" aria-haspopup="true" aria-expanded="false" data-value="0">Select a Question</button>
					<div class="dropdown-menu" aria-labelledby="selectStartQuizSearchQuestion-id">';
		if(count($questiones_array_data)){
			foreach($questiones_array_data as $question_data){
				$question_id = $question_data->getQuestionId();
		    	$sqb_quest_bank_obj = SQB_QuizQuestionBank::loadById($question_id);
			    if($sqb_quest_bank_obj){
			    	$ques_question_title = $sqb_quest_bank_obj->getQuestionTitle();
			    	$question_type = $sqb_quest_bank_obj->getQuestionType();

			    	if($question_type == 'single'){
			    		$question_type_name = 'Single Choice';
			    	}else if($question_type == 'multi'){
			    		$question_type_name = 'Multiple Choice';
			    	}else if($question_type == 'yes_no'){
			    		$question_type_name = 'Yes/No';
			    	}else if($question_type == 'text'){
			    		$question_type_name = 'Text';
			    	}else if($question_type == 'numerical_text'){
			    		$question_type_name = 'Numerical Value';
			    	}else if($question_type == 'rating'){
			    		$question_type_name = 'Rating Scale';
			    	}else if($question_type == 'fill_in_blank'){
			    		$question_type_name = 'Fill In Blank';
			    	}else if($question_type == 'file_upload'){
			    		$question_type_name = 'File Upload';
			    	}else if($question_type == 'slider'){
			    		$question_type_name = 'Slider';
			    	}else if($question_type == 'matrix'){
			    		$question_type_name = 'Matrix';
			    	}else if($question_type == 'ranking_choices'){
			    		$question_type_name = 'Ranking / Choice';
			    	}else if($question_type == 'date'){
			    		$question_type_name = 'Date';
			    	}else if($question_type == 'weight_and_height'){
			    		$question_type_name = 'Weight and Height';
			    	}else if($question_type == 'name'){
			    		$question_type_name = 'Name';
			    	}else if($question_type == 'phone_number'){
			    		$question_type_name = 'Phone Number';
			    	}else if($question_type == 'email'){
			    		$question_type_name = 'Email';
			    	}

			    	$selected_question_id = $sqb_quest_bank_obj->getId();
			    	$table_html .= '<a class="dropdown-item" href="javascript:void(0)" data-question-type="'.$question_type.'" data-value="'.$selected_question_id.'">'.stripslashes($ques_question_title).' ('.$question_type_name.')</a>';	
			    }
			}
		}

		$table_html .= '</div></div></div>
			</div>';

		$qarObj = SQB_UserQuizDetails::loadByQuizIdStartDateEndDate($quiz_id, sqb_get_date_fl($start_date), sqb_get_date_fl($end_date));

		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] = $sqbInternalUser->getId();
			}			
		}
		
		if(isset($qarObj) && count($qarObj)){
			foreach($qarObj as $qarObjSingle){
				$user_id = $qarObjSingle->getUserId();
				$question_id = $qarObjSingle->getQuestionId();
				$question_detail = SQB_QuizQuestionBank::loadById($question_id);
				$question_title = "";
				if(!empty($question_detail)){
					$question_title = $question_detail->getQuestionTitle();
				}

				
				//$answer_id = $qarObjSingle->getAnswerGiven();
				$date = $qarObjSingle->getDate();

				$user_data = SQB_ManageLeads::loadByQuizIdAndUserIdDate($quiz_id, $user_id, $date);
				
				if(!empty($user_data)){
					$user_source = $user_data->getUserSource();
					$source = $user_data->getSource();
				}

				$date = new DateTime($date);
				$date = $date->format('Y-m-d');

				

				if(@$answer_id > 0){
					$answer_name = SQB_QuizAnswers::loadById($answer_id);
					if(isset($answer_name)){
						$answer_name = stripslashes($answer_name->getAnswerTitle());
					}
				}else{
					$question_type = SQB_QuizQuestionBank::loadById($question_id);
					if(!empty($question_type)){
						$get_question_type = $question_type->getQuestionType();
						if($get_question_type == 'multi'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							if(strpos($answer_id_tab, ',') !== false){
								$answer_id_explodes = explode(',',$answer_id_tab);
								$answers_name = array();
								foreach($answer_id_explodes as $answer_id_explode){
									$answer_name = SQB_QuizAnswers::loadById($answer_id_explode);
									$answers_name[] = stripslashes($answer_name->getAnswerTitle());
								}
								$answer_name = implode(', ', $answers_name);
							}else{
								$answer_name = stripslashes($qarObjSingle->getAnswerText());	
							}						
						}else if($get_question_type == 'matrix'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							$answer_id_explodes = explode(',',$answer_id_tab);
							$answers_name = array();
							foreach($answer_id_explodes as $answer_id_explode){
								if(strpos($answer_id_explode, '|') !== false){
									$ans_explodes = explode('|', $answer_id_explode);
									$answer_name = SQB_QuizAnswers::loadById($ans_explodes[0]);
									if(!empty($answer_name)){
										$answers_name[] = strip_tags(stripslashes($answer_name->getAnswerTitle()));	
										$answer_name = implode(', ', $answers_name);
									}else{
										$answer_name = '';
									}
								}else{
									$answer_name = stripslashes($qarObjSingle->getAnswerText());	
								}
							}
						}else if($get_question_type == 'weight_and_height'){
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
							$explode_ans = explode(',', $answer_name);
							if($explode_ans[1] > 12){
								$ans_divide = $explode_ans[1] / 12;
								$ans_divide = round($ans_divide,1);
							}else{
								$ans_divide = $explode_ans[1];
							}
							$answer_name = '<div class="ans_text1">Weight: '.$explode_ans[0].' <br> Height: '.$ans_divide.' </div>';
						}else{
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
						}
					}
				}
				$name =  '';	
				$email =  '';
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
						$name = $sqbUserObj->getFirstName(); 	
					}					 				
					
				}else{ // Users from WP or DAP
					
					//exclude users from sqb_internal_users table
					if(in_array($user_id, $sqbInternalUserarr)){
						continue;
					}
					if(@$source == 'DAP' && sqb_check_dap_exists()){ 
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
						
					}else{
					
						$user_info = get_userdata($user_id);	
						//echo "<pre>"; print_r($user_info ) ; die;
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}	
					}
				}*/

				if($source == "WP" && $user_source == "WP"){
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}else{
						$name =  "";	
					}
				}else if($source == "WP" && $user_source == "SQB"){
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}	
					
				}else if($source == "DAP" && !empty($user_source)){
					$dapUserObj = Dap_User::loadUserById($user_id);
					if(isset($dapUserObj)){						
						
						$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
						$email =  $dapUserObj->getEmail();
						
					}
				}

				if(!empty($question_detail)){
					$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center">'.stripslashes($question_title).'</td><td class="text-center"><div class="quiz_details--list">'.$answer_name.'</div></td>
						<td class="text-center">'.sqb_get_date($date,'Y-m-d').'</td>
						</tr>';
				}
				
			}
		}

		$table_data .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">First Name</th>
						<th class="text-center" style="width:300px">Email</th>
						<th class="text-center" style="width:300px">Question Title</th>
						<th class="text-center" style="width:400px">Selected Answer</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
		$table_data .= $table_body_html;			
		$table_data .= ' </tbody>
			</table></div>';

	}
	$output['table_data'] = $table_data;
	$output['table_html'] = $table_html;
	echo json_encode($output);
	die;
}

function SqbLoadCategoryName($quiz_id){
	$output = "";
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$questiones_array_data = SQB_QuizQuestionBank::loadAllByQuizId($quiz_id);
		if(isset($questiones_array_data)){
			$output .= '<option value="0">Select Category Name</option>';
			foreach($questiones_array_data as $question_data){
				$category_id = $question_data->getCategoryId();
				$category_detail = SQB_QuizCategory::loadById($category_id);
				if(!empty($category_detail)){
					$category_name = $category_detail->getName();
					$output .= '<option value="'.$category_id.'">'.$category_name.'</option>';
				}
			}
		}else{
			$output = '<option value="0">No Category Added</option>';
		}
	}
	return $output;
}



add_action('wp_ajax_SQBLoadSearchTags', 'SQBLoadSearchTags');	
add_action('wp_ajax_nopriv_SQBLoadSearchTags', 'SQBLoadSearchTags');
function SQBLoadSearchTags(){
		$output= array();
		if(isset($_POST)){
			$table_html = '';
			$quiz_id = $_POST['quiz_id'];
			$tags = $_POST['search_tags'];
			$quizObjArray = array();
			$start_date = $_POST['start_date'];
			$start_date =  date_create($start_date);
			$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
			
			$end_date = $_POST['end_date'];
			$end_date =  date_create($end_date);
			$end_date = date_format($end_date,"Y-m-d 23:59:59");
			$table_body_html = '';
			
			$qarObj = SQB_UserQuizDetails::loadByQuizIdTagsIdStartDateEndDate($quiz_id,$tags,$start_date,$end_date);
			
			$sqbInternalUserarr = array();
			$sqbInternalUserData = SQB_InternalUsers::load();		 
			if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
				foreach($sqbInternalUserData as $sqbInternalUser){
					$sqbInternalUserarr[] = $sqbInternalUser->getId();
				}			
			}
			
			if(isset($qarObj) && count($qarObj)){
				foreach($qarObj as $qarObjSingle){
					$user_id = $qarObjSingle->getUserId();
					$question_id = $qarObjSingle->getQuestionId();
					$date = $qarObjSingle->getDate();
					$question_detail = SQB_QuizQuestionBank::loadById($question_id);
					$question_title = $question_detail->getQuestionTitle();
					
					$user_data = SQB_ManageLeads::loadByQuizIdAndUserIdDate($quiz_id, $user_id, $date);
					$user_source = $user_data->getUserSource();
					$source = $user_data->getSource();

					//$answer_id = $qarObjSingle->getAnswerGiven();
					$date = $qarObjSingle->getDate();
					$date = new DateTime($date);
					$date = $date->format('Y-m-d');
					if($answer_id > 0){
						$answer_name = SQB_QuizAnswers::loadById($answer_id);
						if(isset($answer_name)){
							$answer_name = stripslashes($answer_name->getAnswerTitle());
						}

						if($question_detail->getQuestionType() == 'matching_text'){
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
						}
						
					}else{
						$question_type = SQB_QuizQuestionBank::loadById($question_id);
						if(isset($question_type)){
							$get_question_type = $question_type->getQuestionType();
							if($get_question_type == 'multi'){
								$answer_id_tab = $qarObjSingle->getAnswerGiven();
								if(strpos($answer_id_tab, ',') !== false){
									$answer_id_explodes = explode(',',$answer_id_tab);
									$answers_name = array();
									foreach($answer_id_explodes as $answer_id_explode){
										$answer_name = SQB_QuizAnswers::loadById($answer_id_explode);
										$answers_name[] = stripslashes($answer_name->getAnswerTitle());
									}
									$answer_name = implode(', ', $answers_name);
								}else{
									$answer_name = stripslashes($qarObjSingle->getAnswerText());	
								}						
							}else if($get_question_type == 'matrix'){
								$answer_id_tab = $qarObjSingle->getAnswerGiven();
								$answer_id_explodes = explode(',',$answer_id_tab);
								$answers_name = array();
								foreach($answer_id_explodes as $answer_id_explode){
									if(strpos($answer_id_explode, '|') !== false){
										$ans_explodes = explode('|', $answer_id_explode);
										$answer_name = SQB_QuizAnswers::loadById($ans_explodes[0]);
										$answers_name[] = strip_tags(stripslashes($answer_name->getAnswerTitle()));	
										$answer_name = implode(', ', $answers_name);
									}else{
										$answer_name = stripslashes($qarObjSingle->getAnswerText());	
									}
								}
							}else{
								$answer_name = stripslashes($qarObjSingle->getAnswerText());
							}
						}
					}
					$name =  '';	
					$email =  '';
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
							$name = $sqbUserObj->getFirstName(); 	
						}					 				
						
					}else{ // Users from WP or DAP
						
						//exclude users from sqb_internal_users table
						if(in_array($user_id, $sqbInternalUserarr)){
							continue;
						}
						if($source == 'DAP' && sqb_check_dap_exists()){ 
							$dapUserObj = Dap_User::loadUserById($user_id);
							if(isset($dapUserObj)){						
								
								$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
								$email =  $dapUserObj->getEmail();
								
							}
							
						}else{
						
							$user_info = get_userdata($user_id);	
							//echo "<pre>"; print_r($user_info ) ; die;
							if(isset($user_info)){
								$name =  $user_info->first_name." ". $user_info->last_name;	
								$email =  $user_info->user_email ;	
							}else{
								$name =  "";	
							}	
						}
					}*/

					if($source == "WP" && $user_source == "WP"){
						$user_info = get_userdata($user_id);	
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}
					}else if($source == "WP" && $user_source == "SQB"){
						$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
						if(isset($sqbUserObj)){
							$email = $sqbUserObj->getEmail(); 	
							$name = $sqbUserObj->getFirstName(); 	
						}	
						
					}else if($source == "DAP" && !empty($user_source)){
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
					}

					$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center">'.stripslashes($question_title).'</td><td class="text-center"><div class="quiz_details--list">'.$answer_name.'</div></td>
							<td class="text-center">'.$date.'</td>
							</tr>';
				}
			}
			$table_html .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">First Name</th>
						<th class="text-center" style="width:300px">Email</th>
						<th class="text-center" style="width:300px">Question Title</th>
						<th class="text-center" style="width:400px">Selected Answer</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
		$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table></div>';
		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_SQBLoadSearchByFilter', 'SQBLoadSearchByFilter');	
add_action('wp_ajax_nopriv_SQBLoadSearchByFilter', 'SQBLoadSearchByFilter');

//manage leads load user details
function SQBLoadSearchByFilter(){
	$output= array();
	if(isset($_POST)){
		$quiz_id = $_POST['quiz_id'];
		$question_id = $_POST['question_id'];
		$answer_id = $_POST['answer_id'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$table_body_html = '';
		
		$qarObj = SQB_UserQuizDetails::loadByQuizIdQuestionIdAnswerIdStartDateEndDate($quiz_id,$question_id,$answer_id,$start_date,$end_date);

		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] = $sqbInternalUser->getId();
			}			
		}
		if(isset($qarObj) && count($qarObj)){
			foreach($qarObj as $qarObjSingle){
				$user_id = $qarObjSingle->getUserId();
				$question_id = $qarObjSingle->getQuestionId();
				$question_detail = SQB_QuizQuestionBank::loadById($question_id);
				$question_title = $question_detail->getQuestionTitle();
				//$answer_id = $qarObjSingle->getAnswerGiven();
				$date = $qarObjSingle->getDate();

				$user_data = SQB_ManageLeads::loadByQuizIdAndUserIdDate($quiz_id, $user_id, $date);
				$user_source = $user_data->getUserSource();
				$source = $user_data->getSource();
				$date = new DateTime($date);
				$date = $date->format('Y-m-d');
				if($answer_id > 0){
					$answer_name = SQB_QuizAnswers::loadById($answer_id);

					if(isset($answer_name)){
						$answer_name = stripslashes($answer_name->getAnswerTitle());
					}

					if($question_detail->getQuestionType() == 'matching_text'){
						$answer_name = stripslashes($qarObjSingle->getAnswerText());
					}
					

				}else{
					$question_type = SQB_QuizQuestionBank::loadById($question_id);
					if(isset($question_type)){
						$get_question_type = $question_type->getQuestionType();
						if($get_question_type == 'multi'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							if(strpos($answer_id_tab, ',') !== false){
								$answer_id_explodes = explode(',',$answer_id_tab);
								$answers_name = array();
								foreach($answer_id_explodes as $answer_id_explode){
									$answer_name = SQB_QuizAnswers::loadById($answer_id_explode);
									$answers_name[] = stripslashes($answer_name->getAnswerTitle());
								}
								$answer_name = implode(', ', $answers_name);
							}else{
								$answer_name = stripslashes($qarObjSingle->getAnswerText());	
							}						
						}else if($get_question_type == 'matrix'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							$answer_id_explodes = explode(',',$answer_id_tab);
							$answers_name = array();
							foreach($answer_id_explodes as $answer_id_explode){
								if(strpos($answer_id_explode, '|') !== false){
									$ans_explodes = explode('|', $answer_id_explode);
									$answer_name = SQB_QuizAnswers::loadById($ans_explodes[0]);
									$answers_name[] = strip_tags(stripslashes($answer_name->getAnswerTitle()));	
									$answer_name = implode(', ', $answers_name);
								}else{
									$answer_name = stripslashes($qarObjSingle->getAnswerText());	
								}
							}
						}else if($get_question_type == 'weight_and_height'){
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
							$explode_ans = explode(',', $answer_name);
							if($explode_ans[1] > 12){
								$ans_divide = $explode_ans[1] / 12;
								$ans_divide = round($ans_divide,1);
							}else{
								$ans_divide = $explode_ans[1];
							}
							$answer_name = '<div class="ans_text1">Weight: '.$explode_ans[0].' <br> Height: '.$ans_divide.' </div>';
						}else{
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
						}
					}
				}
				$name =  '';	
				$email =  '';
				//check if syncing is enabled or disabled
				//$sqb_wp_syncing = get_option('sqb_wp_syncing');  

				/*if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){ //get from SQB internal user
					//include only users from sqb_internal_users table
					

					if(!in_array($user_id, $sqbInternalUserarr)){
						continue;
					}	 				 
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}					 				
					
				}else{ // Users from WP or DAP
					
					//exclude users from sqb_internal_users table
					if(in_array($user_id, $sqbInternalUserarr)){
						continue;
					}
					if($source == 'DAP' && sqb_check_dap_exists()){ 
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
						
					}else{
					
						$user_info = get_userdata($user_id);	
						//echo "<pre>"; print_r($user_info ) ; die;
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}	
					}
				}*/
				if($source == "WP" && $user_source == "WP"){
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}else{
						$name =  "";	
					}
				}else if($source == "WP" && $user_source == "SQB"){
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}	
					
				}else if($source == "DAP" && !empty($user_source)){
					$dapUserObj = Dap_User::loadUserById($user_id);
					if(isset($dapUserObj)){						
						
						$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
						$email =  $dapUserObj->getEmail();
						
					}
				}

				$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center">'.stripslashes($question_title).'</td><td class="text-center"><div class="quiz_details--list">'.$answer_name.'</div></td>
						<td class="text-center">'.$date.'</td>
						</tr>';
			}
		}

		$table_html .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">First Name</th>
						<th class="text-center" style="width:300px">Email</th>
						<th class="text-center" style="width:300px">Question Title</th>
						<th class="text-center" style="width:400px">Selected Answer</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
		$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table></div>';
		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}


add_action('wp_ajax_SQBLoadScorefilter', 'SQBLoadScorefilter');	
add_action('wp_ajax_nopriv_SQBLoadScorefilter', 'SQBLoadScorefilter');

//manage leads load user details
function SQBLoadScorefilter(){
	$output= array();
	if(isset($_POST)){
		$quiz_id = $_POST['quiz_id'];
		$type = $_POST['type'];
		$score_value = $_POST['score_value'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$table_body_html = '';
		
		$qarObj = SQB_UserQuizDetails::loadByQuizIdStartDateEndDateAndScore($quiz_id, $start_date, $end_date,$score_value,$type);

		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] = $sqbInternalUser->getId();
			}			
		}
		if(isset($qarObj) && count($qarObj)){
			foreach($qarObj as $qarObjSingle){
				$user_id = $qarObjSingle->getUserId();
				$question_id = $qarObjSingle->getQuestionId();
				$question_detail = SQB_QuizQuestionBank::loadById($question_id);
				$question_title = $question_detail->getQuestionTitle();
				//$answer_id = $qarObjSingle->getAnswerGiven();
				$date = $qarObjSingle->getDate();

				$user_data = SQB_ManageLeads::loadByQuizIdAndUserIdDate($quiz_id, $user_id, $date);
				$user_source = $user_data->getUserSource();
				$source = $user_data->getSource();
				$date = new DateTime($date);
				$date = $date->format('Y-m-d');
				if($answer_id > 0){
					$answer_name = SQB_QuizAnswers::loadById($answer_id);
					if(isset($answer_name)){
						$answer_name = stripslashes($answer_name->getAnswerTitle());
					}
				}else{
					$question_type = SQB_QuizQuestionBank::loadById($question_id);
					if(isset($question_type)){
						$get_question_type = $question_type->getQuestionType();
						if($get_question_type == 'multi'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							if(strpos($answer_id_tab, ',') !== false){
								$answer_id_explodes = explode(',',$answer_id_tab);
								$answers_name = array();
								foreach($answer_id_explodes as $answer_id_explode){
									$answer_name = SQB_QuizAnswers::loadById($answer_id_explode);
									$answers_name[] = stripslashes($answer_name->getAnswerTitle());
								}
								$answer_name = implode(', ', $answers_name);
							}else{
								$answer_name = stripslashes($qarObjSingle->getAnswerText());	
							}						
						}else if($get_question_type == 'matrix'){
							$answer_id_tab = $qarObjSingle->getAnswerGiven();
							$answer_id_explodes = explode(',',$answer_id_tab);
							$answers_name = array();
							foreach($answer_id_explodes as $answer_id_explode){
								if(strpos($answer_id_explode, '|') !== false){
									$ans_explodes = explode('|', $answer_id_explode);
									$answer_name = SQB_QuizAnswers::loadById($ans_explodes[0]);
									$answers_name[] = strip_tags(stripslashes($answer_name->getAnswerTitle()));	
									$answer_name = implode(', ', $answers_name);
								}else{
									$answer_name = stripslashes($qarObjSingle->getAnswerText());	
								}
							}
						}else{
							$answer_name = stripslashes($qarObjSingle->getAnswerText());
						}
					}
				}
				$name =  '';	
				$email =  '';
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
						$name = $sqbUserObj->getFirstName(); 	
					}					 				
					
				}else{ // Users from WP or DAP
					
					//exclude users from sqb_internal_users table
					if(in_array($user_id, $sqbInternalUserarr)){
						continue;
					}
					if($source == 'DAP' && sqb_check_dap_exists()){ 
						$dapUserObj = Dap_User::loadUserById($user_id);
						if(isset($dapUserObj)){						
							
							$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
							$email =  $dapUserObj->getEmail();
							
						}
						
					}else{
					
						$user_info = get_userdata($user_id);	
						//echo "<pre>"; print_r($user_info ) ; die;
						if(isset($user_info)){
							$name =  $user_info->first_name." ". $user_info->last_name;	
							$email =  $user_info->user_email ;	
						}else{
							$name =  "";	
						}	
					}
				}*/
				if($source == "WP" && $user_source == "WP"){
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}else{
						$name =  "";	
					}
				}else if($source == "WP" && $user_source == "SQB"){
					$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
					if(isset($sqbUserObj)){
						$email = $sqbUserObj->getEmail(); 	
						$name = $sqbUserObj->getFirstName(); 	
					}	
					
				}else if($source == "DAP" && !empty($user_source)){
					$dapUserObj = Dap_User::loadUserById($user_id);
					if(isset($dapUserObj)){						
						
						$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
						$email =  $dapUserObj->getEmail();
						
					}
				}
				$table_body_html  .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center">'.$qarObjSingle->getPointsScored() .'/'. $qarObjSingle->getTotalPoints().'</td>
						<td class="text-center">'.$date.'</td>
						</tr>';
			}
		}

		$table_html .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">First Name</th>
						<th class="text-center" style="width:300px">Email</th>';
						if($type=="assessment"){
							$table_html .= '<th class="text-center" style="width:400px">Correct Answer</th>';
						}else{
							$table_html .= '<th class="text-center" style="width:400px">Score</th>';
						}
						$table_html .= '<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
		$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table></div>';
		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_SQBLoadCategoryfilter', 'SQBLoadCategoryfilter');	
add_action('wp_ajax_nopriv_SQBLoadCategoryfilter', 'SQBLoadCategoryfilter');

//manage leads load user details
function SQBLoadCategoryfilter(){
	$output= array();
	if(isset($_POST)){
		$quiz_id = $_POST['quiz_id'];
		$type = $_POST['type'];
		$category_value = $_POST['category_value'];
		$selected_category = $_POST['selected_category'];
		$start_date = $_POST['start_date'];
		$start_date =  date_create($start_date);
		$start_date = date_format($start_date,"Y-m-d 00:00:00 ");
		
		$end_date = $_POST['end_date'];
		$end_date =  date_create($end_date);
		$end_date = date_format($end_date,"Y-m-d 23:59:59");
		$table_body_html = '';
		
		$qarObj = SQB_ManageLeads::loadByQuizIdStartDateEndDate($quiz_id, $start_date, $end_date);
		$sqbInternalUserarr =array();
		$sqbInternalUserData = SQB_InternalUsers::load();		 
		if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
			foreach($sqbInternalUserData as $sqbInternalUser){
				$sqbInternalUserarr[] = $sqbInternalUser->getId();
			}			
		}
		if(isset($qarObj) && count($qarObj)){
			foreach($qarObj as $qarObjSingle){
				$category_name ='';
				$category_details = $qarObjSingle->category_details;
				if($category_details != ''){
					$category_details = json_decode($category_details,true);
					if(is_array($category_details)){
						$cat_total = array();
						$i=0;
						foreach($category_details as $cat_id=>$cat_val){
							$cat_obj = SQB_QuizCategory::loadById($cat_id);
							if(isset($cat_obj)){
								$cat_total[$i]['id'] = $cat_id;
								$cat_total[$i]['name'] = $cat_obj->getName();
								$cat_total[$i]['total'] = $cat_val;
								$i++;
							}
						}
						$key = array_search($selected_category, array_column($cat_total, 'id'));
						
						if($key !== false){
							if($cat_total[$key]['total'] > $category_value){
								$category_name = $cat_total[$key]['name'];	
								$category_score = $cat_total[$key]['total'];	
								$user_id = $qarObjSingle->getUserId();
								$user_source = $qarObjSingle->getUserSource();
								$source = $qarObjSingle->getSource();
								$date = $qarObjSingle->getDate();
								$date = new DateTime($date);
								$date = $date->format('Y-m-d');
								
								$name =  '';	
								$email =  '';
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
										$name = $sqbUserObj->getFirstName(); 	
									}					 				
									
								}else{ // Users from WP or DAP
									//exclude users from sqb_internal_users table
									if(in_array($user_id, $sqbInternalUserarr)){
										continue;
									}
									if($source == 'DAP' && sqb_check_dap_exists()){ 
										$dapUserObj = Dap_User::loadUserById($user_id);
										if(isset($dapUserObj)){						
											
											$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
											$email =  $dapUserObj->getEmail();
											
										}
									}else{
										$user_info = get_userdata($user_id);	
										if(isset($user_info)){
											$name =  $user_info->first_name." ". $user_info->last_name;	
											$email =  $user_info->user_email ;	
										}else{
											$name =  "";	
										}	
									}
								}*/
								if($source == "WP" && $user_source == "WP"){
									$user_info = get_userdata($user_id);	
									if(isset($user_info)){
										$name =  $user_info->first_name." ". $user_info->last_name;	
										$email =  $user_info->user_email ;	
									}else{
										$name =  "";	
									}
								}else if($source == "WP" && $user_source == "SQB"){
									$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
									if(isset($sqbUserObj)){
										$email = $sqbUserObj->getEmail(); 	
										$name = $sqbUserObj->getFirstName(); 	
									}	
									
								}else if($source == "DAP" && !empty($user_source)){
									$dapUserObj = Dap_User::loadUserById($user_id);
									if(isset($dapUserObj)){						
										
										$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
										$email =  $dapUserObj->getEmail();
										
									}
								}

								$table_body_html .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td><td class="text-center">'.$category_name.'</td><td class="text-center">'.$category_score.'</td><td class="text-center">'.$date.'</td></tr>';
							}
						}
					}				
				}
			}
		}

		$table_html .= '<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<table class="sqb_manage_report_search_table">
				<thead>
					<tr>
						<th class="text-center">First Name</th>
						<th class="text-center" style="width:300px">Email</th>
						<th class="text-center" style="width:400px">Category Name</th>
						<th class="text-center" style="width:100px">Category Score</th>
						<th class="text-center">Date</th>
					</tr>
				</thead>
				<tbody class="manageLeadTableBody">';
				
		$table_html .= $table_body_html;			
		$table_html .= ' </tbody>
			</table></div>';
		$output['quizObjArray'] = $quizObjArray;
		$output['table_html'] = $table_html;
		$output['success'] = 'data load';
		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}


add_action('wp_ajax_sqb_clone_leaderboard_by_id', 'sqbCloneLeaderboardByIdAjax');
add_action('wp_ajax_nopriv_sqb_clone_leaderboard_by_id', 'sqbCloneLeaderboardByIdAjax');

function sqbCloneLeaderboardByIdAjax(){
	if(isset($_POST['leaderboard_id'])){
		$leaderboard_id  = $_POST['leaderboard_id'];
		$leaderboard_obj = SQB_LeaderboardPage::loadById($leaderboard_id);
		if($leaderboard_obj){
			$date = date('Y-m-d h:i:s');
			$sqbData = new SQB_LeaderboardPage();
			$sqbData->setQuizType($leaderboard_obj->getQuizType());
			$sqbData->setQuizIds($leaderboard_obj->getQuizIds());
			$sqbData->setName($leaderboard_obj->getName());
			$sqbData->setMaxRecords($leaderboard_obj->getMaxRecords());
			$sqbData->setRetakeOverwrites($leaderboard_obj->getRetakeOverwrites());
			$sqbData->setShowType($leaderboard_obj->getShowType());
			$sqbData->setStartDate($leaderboard_obj->getStartDate());
			$sqbData->setEndDate($leaderboard_obj->getEndDate());
			$sqbData->setNoDataText($leaderboard_obj->getNoDataText());
			$sqbData->setTemplate($leaderboard_obj->getTemplate());
			$sqbData->setLeaderboardOrder($leaderboard_obj->getLeaderboardOrder());
			$sqbData->setCustomizerHtml($leaderboard_obj->getCustomizerHtml());
			$sqbData->setCustomizerValues($leaderboard_obj->getCustomizerValues());
			$sqbData->setDate($date);
			$new_leaderboard_id = $leaderboard_obj->create();
			$output['new_leaderboard_id'] = $new_leaderboard_id;	
		}
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_clone_pdfContent_by_id', 'sqb_clone_pdfContent_by_id');
add_action('wp_ajax_nopriv_sqb_clone_pdfContent_by_id', 'sqb_clone_pdfContent_by_id');

function sqb_clone_pdfContent_by_id(){
	if(isset($_POST['pdf_content_id'])){
		$pdf_content_id  = $_POST['pdf_content_id'];
		
		$pdfContent_obj = SQB_PdfContent::loadById($pdf_content_id);
		if($pdfContent_obj){
			$date = date('Y-m-d h:i:s');
			$sqbData = new SQB_PdfContent();
			$sqbData->setName($pdfContent_obj->getName());
			$sqbData->setContent($pdfContent_obj->getContent());
			$sqbData->setOtherOptions($pdfContent_obj->getOtherOptions());
			$sqbData->setDate($date);
			$new_pdfContent_id = $pdfContent_obj->create();
			$output['new_pdfContent_id'] = $new_pdfContent_id;	
		}
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_clone_quiz_by_id', 'sqbCloneQuizByIdAjax');
add_action('wp_ajax_nopriv_sqb_clone_quiz_by_id', 'sqbCloneQuizByIdAjax');

function sqbCloneQuizByIdAjax(){
	if(isset($_POST['quiz_id'])){
		$quiz_id  = $_POST['quiz_id'];
		$quiz_obj = SQB_Quiz::loadById($quiz_id);
		if($quiz_obj){

			if($quiz_obj->getPreBuilt() != 'Y'){
				$quiz_obj->setGlobalStyle('Y');
			}

			if($quiz_obj->getPreBuilt() == ''){
				$quiz_obj->setGlobalStyle($quiz_obj->getGlobalStyle());
			}

			$quiz_obj->setPreBuilt('N');
			$quiz_obj->setPreBuiltDetails('');

			$quiz_obj->setShowShareScreen('N');

			$new_quiz_id = $quiz_obj->create();
			
			if(is_numeric($new_quiz_id) && $new_quiz_id != 0 ){
			    
			     $outcomes_new_mapping_array = array();
				// Get questions ids 
				$questiones_array_data = SQB_QuizQuestions::loadByQuizId($quiz_id);
			
				if(count($questiones_array_data)){
					foreach($questiones_array_data as $question_data){
						
						    $output['old_question_id'][] = $question_id = $question_data->getQuestionId();
						    $sqb_quest_bank_obj = SQB_QuizQuestionBank::loadById($question_id);
							
							
						    if($sqb_quest_bank_obj){
								// question bank cloning 
								$new_question_id = $sqb_quest_bank_obj->create();
								if(is_numeric($new_question_id) && $new_question_id != 0 ){
									$output['new_question_id'][]  =  $new_question_id;
									$new_obj_question = new SQB_QuizQuestions();
									$new_obj_question->setQuizId($new_quiz_id);
									$new_obj_question->setQuestionId($new_question_id);
									$new_obj_question->setQuestionOrder($question_data->getQuestionOrder());
									$new_obj_question->setShowAds($question_data->getShowAds());
									$new_obj_question->setQuestionAdsHtml($question_data->getQuestionAdsHtml());
									
									// question bloning
									$new_question_table_row_id = $new_obj_question->create();
									$output['new_question_table_row_id'][]  =  $new_question_table_row_id;
									// answer cloning 
									$sqb_answer_array_obj = SQB_QuizAnswers::loadByQuestionId($question_id);
									if(is_array($sqb_answer_array_obj) && count($sqb_answer_array_obj)){
										foreach($sqb_answer_array_obj as $sqb_answer_obj){
											
											$output['old_answer_id'][] = $sqb_answer_id = $sqb_answer_obj->getId();
											
											$sqb_answer_obj->setQuestionId($new_question_id);
											$new_answer_id = $sqb_answer_obj->create();
											$output['new_answer_id'][]  =  $new_answer_id;
											
											// outcome mapping cloning
											if(is_numeric($new_answer_id) && ($new_answer_id != 0)){
												
												// answer html data update
												$sqb_new_answer_array_obj = SQB_QuizAnswers::loadById($new_answer_id);
												if($sqb_new_answer_array_obj){
													$new_ans_html  = stripslashes($sqb_new_answer_array_obj->getAnswer());
													$new_ans_html = str_replace('data-id="'.$sqb_answer_id.'"','data-id="'.$new_answer_id.'"',$new_ans_html);
													$new_ans_html = str_replace("data-id='".$sqb_answer_id."'","data-id='".$new_answer_id."'",$new_ans_html);
													$new_ans_html = str_replace("data-id='%%ANSWERID%%'","data-id='".$new_answer_id."'",$new_ans_html);
													$new_ans_html = str_replace('data-id="%%ANSWERID%%"','data-id="'.$new_answer_id.'"',$new_ans_html);
													$sqb_new_answer_array_obj->setAnswer($new_ans_html);
													$sqb_new_answer_array_obj->update();
													
												}
												
												
												$outcome_mapping_obj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quiz_id,$question_id,$sqb_answer_id);
												if(isset($outcome_mapping_obj)){
												    $outcomes_new_mapping_array[$outcome_mapping_obj->getOutcomeId()][] = array('quiz_id'=>$new_quiz_id,'question_id'=>$new_question_id,'answer_id'=>$new_answer_id,'outcome_range'=>$outcome_mapping_obj->getOutcomeRange());
												}// if  loop closed 
											}// if  loop closed 
											
											
											
											
										} // for each loop closed 
									}// if  loop closed 
									
								}// if  loop closed 	
							}// if  loop  closed  of sqb_quest_bank_obj
					}// for each loop closed 	
				}// if  loop closed 	
				
				//calculator formula cloning
				if($quiz_obj->getQuizType() == 'calculator'){
					$CalculatorFormulaObj = SQB_CalculatorFormula::loadByQuizId($quiz_id);
					 if(isset($CalculatorFormulaObj) && !empty($CalculatorFormulaObj)) {
						$new_formula_array = array(); 
						$old_formula_array = array(); 
						foreach($CalculatorFormulaObj as $calculator_formulas){
							$old_formula_array[] = '[FORMULA id='.$calculator_formulas->id.']';
							$date = date('Y-m-d h:i:s');
							$calculator_formulas->setQuizId($new_quiz_id);
							$calculator_formulas->setDate($date);
							$formula_id = $calculator_formulas->create();
							$new_formula_array[] = '[FORMULA id='.$formula_id.']';
						}
					}
				}
					
				//outcome cloing
				$sqb_outcome_array_obj = SQB_Outcome::loadByQuizId($quiz_id);
				$outcomes_array_width_old__new_ids = array();
				if(count($sqb_outcome_array_obj)){
					foreach($sqb_outcome_array_obj as  $sqb_outcome_obj){
						
						$output['old_outcome_id'][] = $outcome_id = $sqb_outcome_obj->getId();
						if($quiz_obj->getQuizType() == 'calculator'){
							$outcome_html = $sqb_outcome_obj->getOutcomeHtml();
							$outcome_html = str_replace($old_formula_array, $new_formula_array, $outcome_html);
							$sqb_outcome_obj->setOutcomeHtml($outcome_html);
						}
						$sqb_outcome_obj->setQuizId($new_quiz_id);
						$new_outcome_id = $sqb_outcome_obj->create();
						$output['new_outcome_id'][]  =  $new_outcome_id;
						if(is_numeric($new_outcome_id)){
							$outcomes_array_width_old__new_ids[$outcome_id] = $new_outcome_id;
						}
						
					} // for each loop 
				}
				
				if(count($outcomes_array_width_old__new_ids) && count($outcomes_new_mapping_array)){
					//foreach($outcomes_array_width_old__new_ids as $outocme_old_id=>$outocme_new_id){
						//if(isset($outcomes_new_mapping_array[$outocme_old_id])){
							foreach($outcomes_new_mapping_array as $mapping_outocme_key=>$outcome_new_mapping_array){
								
							foreach($outcome_new_mapping_array as $key=>$outcome_new_mapping_data){
								
								$mapping_old_outocme_ids_array = explode(",",$mapping_outocme_key);
								$mapping_new_outocme_ids_array = array();
								
								foreach($mapping_old_outocme_ids_array as $mapping_old_outocme_id){
									
									if(isset($outcomes_array_width_old__new_ids[$mapping_old_outocme_id])){
										
										$mapping_new_outocme_ids_array[] = $outcomes_array_width_old__new_ids[$mapping_old_outocme_id]; 
									}
								}
								$mapping_new_outocme_ids = implode(',',$mapping_new_outocme_ids_array);
								
								$outcome_mapping_obj = new SQB_OutComeMapping();
								$outcome_mapping_obj->setQuizId($outcome_new_mapping_data['quiz_id']);
								$outcome_mapping_obj->setQuestionId($outcome_new_mapping_data['question_id']);
								$outcome_mapping_obj->setAnswerId($outcome_new_mapping_data['answer_id']);
								$outcome_mapping_obj->setOutcomeId($mapping_new_outocme_ids);
								$outcome_mapping_obj->setOutcomeRange($outcome_new_mapping_data['outcome_range']);
								$new_outcome_mapping_id = $outcome_mapping_obj->create();
								$output['new_outcome_mapping_id'][]  =  $new_outcome_mapping_id;
								$output['outcome_new_mapping_data'][]  =  $outcome_new_mapping_data;
							}// for each loop 
							}// for each loop 
							
						//}
					//}// for each loop 
				}
				
			
				
				// template cloning 
				$sqb_quiz_template_ojb = SQB_QuizTemplate::checkByQuizIdHas($quiz_id);
				if($sqb_quiz_template_ojb){
					$sqb_quiz_template_ojb->setQuizId($new_quiz_id);
					$new_template_id = $sqb_quiz_template_ojb->create();
					$output['new_template_id'][]  =  $new_template_id;
					
				}
				
				// autoeresponder cloning 
				$sqb_autoresponder_array_obj = SQB_QuizAutoresponder::loadByQuizId($quiz_id);
				if(is_array($sqb_autoresponder_array_obj) && count($sqb_autoresponder_array_obj)){
					foreach($sqb_autoresponder_array_obj as $sqb_autoresponder_obj){
						$sqb_autoresponder_obj->setQuizId($new_quiz_id);
						$new_autoresponder_id = $sqb_autoresponder_obj->create();
						$output['new_autoresponder_id'][]  =  $new_autoresponder_id;
					}
				}
				// Quiz Notification cloning 
				$sqb_quiz_notification_array_obj = SQB_QuizNotifications::loadByQuizId($quiz_id);
				if(is_array($sqb_quiz_notification_array_obj) && count($sqb_quiz_notification_array_obj)){
					foreach($sqb_quiz_notification_array_obj as $sqb_quiz_notification_obj){
						$date = date('Y-m-d h:i:s');
						$sqb_quiz_notification_obj->setQuizId($new_quiz_id);
						$sqb_quiz_notification_obj->setFromEmail($sqb_quiz_notification_obj->getFromEmail());
						$sqb_quiz_notification_obj->setSubject($sqb_quiz_notification_obj->getSubject());
						$sqb_quiz_notification_obj->setBody($sqb_quiz_notification_obj->getBody());
						$sqb_quiz_notification_obj->setType($sqb_quiz_notification_obj->getType());
						$sqb_quiz_notification_obj->setSendEmail($sqb_quiz_notification_obj->getSendEmail());
						$sqb_quiz_notification_obj->setQuizType($sqb_quiz_notification_obj->getQuizType());
						$sqb_quiz_notification_obj->setAnswerFormat($sqb_quiz_notification_obj->getAnswerFormat());
						$sqb_quiz_notification_obj->setDate($date);
						$sqb_quiz_notification_obj->setFromName($sqb_quiz_notification_obj->getFromName());
						$sqb_quiz_notification_obj->setQuizSettings($sqb_quiz_notification_obj->getQuizSettings());
						$sqb_quiz_notification_obj->setSendCopy($sqb_quiz_notification_obj->getSendCopy());
						$sqb_quiz_notification_obj->setEmailIds($sqb_quiz_notification_obj->getEmailIds());
						$sqb_quiz_notification_obj->setCopyEmailSubject($sqb_quiz_notification_obj->getCopyEmailSubject());
						$sqb_quiz_notification_obj->setAdminFromEmail($sqb_quiz_notification_obj->getAdminFromEmail());
						$sqb_quiz_notification_obj->setAdminSubject($sqb_quiz_notification_obj->getAdminSubject());
						$sqb_quiz_notification_obj->setAdminBody($sqb_quiz_notification_obj->getAdminBody());
						$new_quiz_notification_id = $sqb_quiz_notification_obj->create();
						$output['new_quiz_notification_id'][]  =  $new_quiz_notification_id;
					}
				}

				// Global Settings cloning 
				$sqb_globaltheme_array_obj = SQB_GlobalTheme::loadByQuizId($quiz_id);
				
				
				if(is_array($sqb_globaltheme_array_obj) && count($sqb_globaltheme_array_obj)){
					foreach($sqb_globaltheme_array_obj as $sqb_globaltheme_obj){
						$date = date('Y-m-d h:i:s');
						$sqb_globaltheme_obj->setQuizId($new_quiz_id);
						$sqb_globaltheme_obj->setName($sqb_globaltheme_obj->getName());
						$sqb_globaltheme_obj->setValue($sqb_globaltheme_obj->getValue());
						$sqb_globaltheme_obj->setStatus($sqb_globaltheme_obj->getStatus());
						$sqb_globaltheme_obj->setType($sqb_globaltheme_obj->getType());
						$sqb_globaltheme_obj->setCustomValues($sqb_globaltheme_obj->getCustomValues());
						$sqb_globaltheme_obj->setDate($date);
						$sqb_globaltheme_obj->setOuterStyleStatus($sqb_globaltheme_obj->getOuterStyleStatus());
						$new_globaltheme_id = $sqb_globaltheme_obj->create();
						$output['new_globaltheme_id'][] = $new_globaltheme_id;
					}
				}
			
				//funnel cloning
				$funnelExists = SQB_Funnel::loadByQuizId($quiz_id);

				if($funnelExists != false){

					$funnelData = $funnelExists->getFunnelData();
					$newFunnelData = sqbGetCloneFunnelData($funnelData, $output);
					
					$sqbData = new SQB_Funnel();
					
					$date = date('Y-m-d h:i:s');
					$sqbData->setFunnelName($funnelExists->getFunnelName());
					$sqbData->setFunnelData($newFunnelData);
					$sqbData->setQuizId($new_quiz_id);
					$sqbData->setDate($date);
					$sqbData->create();
				}
				
				//clone category advanced rules
				$old_question_id_array = $output['old_question_id'];
				$new_question_id_array = $output['new_question_id'];
				$old_answer_id_array = $output['old_answer_id'];
				$new_answer_id_array = $output['new_answer_id'];
				$old_outcome_id_array = $output['old_outcome_id'];
				$new_outcome_id_array = $output['new_outcome_id'];
				
				$rulesdata = SQB_AdvancedRule::loadByQuizId($quiz_id);
				if(is_array($rulesdata) && count($rulesdata)){
					foreach($rulesdata as $rules_data){
						$rules_data->setQuizId($new_quiz_id);
						$id = $rules_data->create();
						$advancedrulesdata = SQB_AdvancedRule::loadById($id);
						
						if ($advancedrulesdata->getQuestionId() == '' || $advancedrulesdata->getQuestionId() == 'NULL') {
						} else {
							$question_id_index = array_search($advancedrulesdata->getQuestionId(), $old_question_id_array);
							$advancedrulesdata->setQuestionId($new_question_id_array[$question_id_index]);
						}
						
						if ($advancedrulesdata->getAnswersId() == '' || $advancedrulesdata->getAnswersId() == 'NULL') {
						} else {
							$answer_id_index = array_search($advancedrulesdata->getAnswersId(), $old_answer_id_array);
							$advancedrulesdata->setAnswersId($new_answer_id_array[$answer_id_index]);
						}
						
						if ($advancedrulesdata->getOutcomeId() == '' || $advancedrulesdata->getOutcomeId() == 'NULL') {
						} else {
							$outcome_id_index = array_search($advancedrulesdata->getOutcomeId(), $old_outcome_id_array);
							$advancedrulesdata->setOutcomeId($new_outcome_id_array[$outcome_id_index]);
						}

						$advancedrulesdata->setId($advancedrulesdata->getId());
						$advancedrulesdata->update();
					}
				}
				//clone category advanced rules ends
				$sqb_globaltheme_array_obj = SQB_GlobalTheme::loadByQuizId($quiz_id);
				if(is_array($sqb_globaltheme_array_obj) && count($sqb_globaltheme_array_obj)){
					foreach($sqb_globaltheme_array_obj as $sqb_globaltheme_obj){
						$date = date('Y-m-d h:i:s');
						$sqb_globaltheme_obj->setQuizId($new_quiz_id);
						$sqb_globaltheme_obj->setName($sqb_globaltheme_obj->getName());
						$sqb_globaltheme_obj->setValue($sqb_globaltheme_obj->getValue());
						$sqb_globaltheme_obj->setStatus($sqb_globaltheme_obj->getStatus());
						$sqb_globaltheme_obj->setType($sqb_globaltheme_obj->getType());
						$sqb_globaltheme_obj->setCustomValues($sqb_globaltheme_obj->getCustomValues());
						$sqb_globaltheme_obj->setDate($date);
						$sqb_globaltheme_obj->setOuterStyleStatus($sqb_globaltheme_obj->getOuterStyleStatus());
						$new_globaltheme_id = $sqb_globaltheme_obj->create();
						$output['new_globaltheme_id'][] = $new_globaltheme_id;
					}
				}

				$rulesdata = SQB_AdvancedCategoryRule::loadByQuizId($quiz_id);
				if(is_array($rulesdata) && count($rulesdata)){
					foreach($rulesdata as $rules_data){
						$rules_data->setQuizId($new_quiz_id);
						$rules_data->setCategoryId($rules_data->getCategoryId());
						$rules_data->setStartRange($rules_data->getStartRange());
						$rules_data->setEndRange($rules_data->getEndRange());
						$rules_data->setCategoryDescription($rules_data->getCategoryDescription());
						$id = $rules_data->create();
					}
				}

				
				$output['outcomes_new_mapping_array'] = $outcomes_new_mapping_array;	
				$output['success'] = 'Clone successfully';	
				$output['quiz_id'] = $quiz_id;	
				$output['new_quiz_id'] = $new_quiz_id;	
			}else{
				
				$output['error'] = 'Something Went Wrong';	
			}
		}else{
			
			$output['error'] = 'Something Went Wrong';	
		}
		
		
	}else{
		
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

function sqbGetCloneFunnelData($funnelData, $output){
	$newData['drawflow']['Home']['data'] = array();
	$data = json_decode(stripslashes($funnelData));
	if($data == ''){
		$data = json_decode($funnelData);
	}

	$new_question_id = $output['new_question_id'];	
	$old_question_id = $output['old_question_id'];	
	$old_answer_id = $output['old_answer_id'];	
	$new_answer_id = $output['new_answer_id'];	

	$oldData = $data->drawflow->Home->data;
	
	$i = 0;
	foreach($oldData as $data){
        
        if(!isset($old_question_id[$i])){
			continue;
		}
		$qid = $new_question_id[$i];
		$oqid = $old_question_id[$i];

		
		if(empty($oldData->$oqid)){
			continue;
		}
		$newData['drawflow']['Home']['data'][$qid] = $oldData->$oqid;
		$newData['drawflow']['Home']['data'][$qid]->id = $qid;
		
		$newData['drawflow']['Home']['data'][$qid]->html = str_replace('data-question-id="'.$oqid.'"','data-question-id="'.$qid.'"',$newData['drawflow']['Home']['data'][$qid]->html);
		$input_connections = @$newData['drawflow']['Home']['data'][$qid]->inputs->input_1->connections;
		$output_connections = $newData['drawflow']['Home']['data'][$qid]->outputs;
		if(!empty($input_connections)){

			foreach ($input_connections as $inputs) {
				# code...
				$value = $inputs->node;
				$key = array_search($value, $old_question_id);
				$newId = $new_question_id[$key];
				$inputs->node = $newId;
			}
		}
		
		foreach($output_connections as $outputs){
			$j = 0;
			$connections = $outputs->connections;
			foreach ($connections as $outputValue) {
				//echo $j;
					# code...
					$value = $outputValue->node;
					if($j == 0){
						$key = array_search($value, $old_answer_id);
						$newId = $new_answer_id[$key];	
					}else if($j == 1){
						$key = array_search($value, $old_question_id);
						$newId = $new_question_id[$key];
					}
					//echo $newId;echo 's';
					
				$outputValue->node = $newId;
					$newData['drawflow']['Home']['data'][$qid]->html = str_replace('data-answer-id="'.$value.'"','data-answer-id="'.$newId.'"',$newData['drawflow']['Home']['data'][$qid]->html);
				$j++;
				
			}
		}
		
		$i++;
	}
	
	return json_encode($newData);

}

add_action ( 'wp_ajax_sqb_email_check_api_ajax', 'sqb_email_check_api_ajax' ); 
add_action ( 'wp_ajax_nopriv_sqb_email_check_api_ajax', 'sqb_email_check_api_ajax'); 
function sqb_email_check_api_ajax(){


	$api_platoform = get_option('email_verify_platform', 'quickemail');

	if($api_platoform == 'reoon'){
		$email = $_REQUEST['email'];
		if (empty($email)) {
			echo json_encode([
				'result' => false,
				'reason' => 'invalid_email'
			]);
			wp_die();
		}

		$api_key = get_option('reoon_api_key'); 
		$api_mode = get_option('reoon_api_mode','quick'); 

		// Build the API URL
		$api_url = add_query_arg(
			array(
				'email' => urlencode($email),
				'key' => $api_key,
				'mode' => $api_mode
			),
			'https://emailverifier.reoon.com/api/v1/verify'
		);

		// Make the API request
		$response = wp_remote_get($api_url, array(
			'timeout' => 15, // Reduced timeout for better user experience
			'sslverify' => true
		));

		// Check for errors in the API call
		if (is_wp_error($response)) {
			echo json_encode([
				'result' => false,
				'reason' => 'api_error',
				'message' => $response->get_error_message()
			]);
			wp_die();
		}

		// Get the response body
		$body = wp_remote_retrieve_body($response);
		$api_response = json_decode($body, true);

		// Check if the response is valid
		if (json_last_error() !== JSON_ERROR_NONE) {
			echo json_encode([
				'result' => false,
				'reason' => 'invalid_response'
			]);
			wp_die();
		}

		// Handle API timeout
		if (wp_remote_retrieve_response_code($response) === 408) {
			echo json_encode([
				'result' => true,
				'reason' => 'timeout'
			]);
			wp_die();
		}

		// Process the API response
		// Modify this according to your API's actual response structure
		$result = [
			'result' => isset($api_response['status']) && $api_response['status'] === 'valid' ? 'valid' : 'invalid',
			'reason' => isset($api_response['reason']) ? $api_response['reason'] : ''
		];

		echo json_encode($result);
		wp_die();
	}else{


	
		$email_check_data = SQB_EmailChecker::load();	
		if(isset($email_check_data) && $email_check_data != 'false'){
			if($email_check_data->getLimitReachedDate() == date('Y-m-d')){
				echo json_encode(array('result'=>'limit_reached'));die;	
			}	
		}
		
		$email = $_REQUEST['email'];
		//$api_key = '06ee9fec74bab6477d4b034a69729b4e7b57daa0a4ce578466d6f5506417';//get_payment_fields('quick_api_key', 'Live');
		
		$quick_email_verification = 'quick_email_verification';
		$quick_email_verification_api_key = 'quick_email_verification_api_key';
		$api_key = '';
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($quick_email_verification , $quick_email_verification_api_key);
		if($obj){
			$api_key = $obj->getValue();
		}
		
		$defaultTimeout = 10;
		$email_verification_timeout = 'email_verification_timeout';
		$email_verification_timeout_value = 'email_verification_timeout_value';
		$timeout = '';
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($email_verification_timeout , $email_verification_timeout_value);
		if($obj){
			$timeout = $obj->getValue();
		}
		
		if($timeout != 0 && $timeout != null && $timeout != ''){
			$defaultTimeout = $timeout;		
		}
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "http://api.quickemailverification.com/v1/verify?email=".$email."&apikey=".$api_key."",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => $defaultTimeout,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_SSL_VERIFYHOST => 0,
		CURLOPT_SSL_VERIFYPEER => 0,
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if($err) {
		$response['error'] = $err;
		//if($err == 'Operation timed out after 10001 milliseconds with 0 bytes received'){
			$response['result'] = 'valid';
			$response['msg'] = $err;
		//}
		echo json_encode($response);
		
		die;
		} else {
		
			$response = json_decode($response, true);
			if($response['message'] == 'Low credit. Payment required'){
				
				SQBSendAdminNotificationEmailCheker();
						
				$date = date("Y-m-d");
				$checkerData = new SQB_EmailChecker();
				$checkerData->setLimitReachedDate($date);	
				if($email_check_data == 'false'){
					$checkerData->create();	
				}else{
					$checkerData->setId($email_check_data->getId());	
					$checkerData->update();				
				}
				echo json_encode('limit_reached');
				die;
			}else{
				echo json_encode($response);
				die;
			}
		}	
	}
}


function SQBSendAdminNotificationEmailCheker(){


	$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('admin_email', '');
	if($sqb_notifications != false){
		
		$sendEmail = $sqb_notifications->getSendEmail();
		
		if($sendEmail != 'Y'){return;}
		$admin_emails = trim(stripslashes($sqb_notifications->getFromEmail()));
		$subject = "SmartQuizBuilder (SQB) Notification: Email Verification Max Limit Reached";
		$bodyText = "Just wanted to let you know that your checkout page email verification (powered by quickemailverification.com) has reached the max daily limit. 
			SQB will not be doing any more email verification checks today as the limit has reached. The email verification will resume tomorrow.
			Please login to quickemailverification.com to increase your daily limit.";
  
		add_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
		
		if($admin_emails != ''){
			
			$admin_emails = explode(',', $admin_emails); 
			
			foreach($admin_emails as $admin_email){
				
				$admin_email = trim($admin_email);
				$quiz_name = 'SQB Admin';
				$headers = array('From: '.$quiz_name.' <'.$admin_email.'>');
				wp_mail( $admin_email, $subject, $bodyText, $headers);
				
			}
		}
		
		remove_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
	}
	
}

add_action('wp_ajax_nopriv_sqb_quiz_lesson_migration', 'sqbQuizLessonMigrationAjax');
add_action('wp_ajax_sqb_quiz_lesson_migration', 'sqbQuizLessonMigrationAjax');

function sqbQuizLessonMigrationAjax(){
	dapSQBQuizMigration();
	$output = array();
	$output['result'] = "success";
	echo json_encode($output);die;
}

function dapSQBQuizMigration(){

	update_option('dap_quiz_migration','Y');
	$sqb_quiz_blocking_list = Dap_SQBQuizCourseLessons::load();
	if(is_array($sqb_quiz_blocking_list) && count($sqb_quiz_blocking_list)){
	
	  foreach($sqb_quiz_blocking_list as $sqb_quiz_blocking){
			$quiz_id = $sqb_quiz_blocking->getQuizId();
			$course_id = $sqb_quiz_blocking->getCourseId();
			$lesson_ids = $sqb_quiz_blocking->getLessonIds();	
			$lesson_date = $sqb_quiz_blocking->getDate();	
			$lesson_ids_array =  explode(',',$lesson_ids);
			if(count($lesson_ids_array )){
				foreach($lesson_ids_array  as $lesson_id){
					$hasLessonData = SQB_DAPLessonQuiz::loadByLessonId($lesson_id);
					if(!isset($hasLessonData)){
						$newLessonObj = new SQB_DAPLessonQuiz();
						$newLessonObj->setQuizId($quiz_id);
						$newLessonObj->setLessonId($lesson_id);
						$newLessonObj->setDate($lesson_date);
						$newLessonObj->create();
					}
				}
			}
	  }
	}
	
}
     
add_action('wp_ajax_nopriv_SqbGetQuizCourseData', 'SqbGetQuizCourseData');
add_action('wp_ajax_SqbGetQuizCourseData', 'SqbGetQuizCourseData');
function SqbGetQuizCourseData(){
	
				$courseId = $_POST['courseId'];
				$lessonurls  =  Dap_Product::displayFileResourcesWithCourseId($courseId);
				$html = '<table class="table cell-border">';
				$html .= '<thead>';
				$html .= '<tr>';
				$html .= '<th class="text-center">Lesson</th>';
				$html .= '<th class="text-center">Quiz</th>';
				$html .= '<th class="text-center" width="150px">Action</th>';
				$html .= '</tr>';
				$html .= '</thead>';
				$html .= '<tbody>';

				$html_inner = '';
				
				if(isset($lessonurls)){
					foreach($lessonurls  as $lessons){
						$html_inner .= SqbGetQuizLessonConnectionHtmlWithFolder($courseId,$lessons);
					}
				} 
				$html .= $html_inner;
				if($html_inner == ''){
					$html .= '<tr><td colspan="3" id="dap_table_no_recods"> No Data Found</td></tr>';
				}
				$html .= '</tbody>';
				$html .= '</table>';							
	echo json_encode(array('html' => $html));die;
}

function SqbGetQuizLessonConnectionHtmlWithFolder($course_id , $lesson){
	$quizName = '-';
	$viewDetailsShow = 'inline-block';
	$action = "Add";
	$lessons_id = $lesson['id'];
	$lessonsName = $lesson["name"];
	$lessonsUrl = $lesson["url"];
	
	$displayshortcode = 'none';
	$sqb_lesson_quiz_data = SQB_DAPLessonQuiz::loadByLessonId($lessons_id);
	$quiz_id = '';
	if(isset($sqb_lesson_quiz_data)){
		$quiz_id = $sqb_lesson_quiz_data->getQuizId();
		$quiz_data = SQB_Quiz::loadById($quiz_id);
		if($quiz_data && isset($quiz_data)){
			$quizName = $quiz_data->getQuizName();
			$action = "Edit";
			$displayshortcode = 'block';
		}
	}
	
	$quiz_type = ''; 
	$quizNameClass = 'text-left';
	
    $table_row_id = 'table_row_id_'.$course_id.'_'.$lessons_id.'_'.rand(10,1000);
	
	$html = '<tr class="'.$table_row_id.'">';
	$html .= '<td><a href="'.$lessonsUrl.'" title="'.$lessonsUrl.'" target="_blank">'.$lessonsName.'</a></td>';
	$html .= '<td class='.$quizNameClass.'><span id="sqb_quiz_name_'.$lessons_id.'">'.$quizName.'<span></td>';
	$html .= '<td class="text-center"><a style="display:'.$viewDetailsShow.'" href="javascript:void(0)" class="btn " onclick="dap_student_view_quiz_course(this)" data-row-id="'.$table_row_id.'" user_id="'.$lessons_id.'"><span id="sqb_lesson_action_'.$lessons_id.'">'.$action.'</a>';
	$html .= '</td>'; 
	$html .= '</tr>';
	
	
	$directory = new Dap_Product('.');
	if(method_exists($directory,'loadProductByProductType')){
		$dap_cdata = Dap_Product::loadProductByProductType("y");
	}
	
	$quizData = SQB_Quiz::load();
	$dap_edit_mode = false;
	$edit_blocking = '';
	$edit_quiz_id = '';
	$edit_blocking_quiz = '';
	$eddit_quiz_display_option = '';
	$edit_sqb_quiz_show_start_screen = '';
	$edit_sqb_quiz_allow_retake = '';
	$edit_sqb_quiz_max_attempts_limit = ''; 
	$edit_unlock_criteria = '';
	$edit_sqb_passing_criteria = '';
	$edit_quiz_type = '';
	$edit_sqb_quiz_show_correct_incorrect_ans = '';
	$edit_sqb_quiz_show_result_screen = '';
	$edit_quiz_attempts_allowed = '';
	$quiz_pagination = '';
	$quiz_attempts_allowed = '';
	
	if(isset($course_id)){
		if (class_exists('Dap_SQBQuizCourseLessons')) {
		//$data_exists = Dap_SQBQuizCourseLessons::loadByQuizIdCourseId($quiz_id,$course_id);
		$data_exists = SQB_DAPLessonQuiz::loadByLessonId($lessons_id);
		}
	
		if(!empty($data_exists)){
			$data_exists= $data_exists;
			$quiz_exists_obj =  SQB_Quiz::loadById($quiz_id);
			
			if($quiz_exists_obj){
				
				$dap_edit_mode = true;
				$edit_quiz_id = $quiz_id;
				$edit_lesson_ids = $data_exists->getLessonId();
				//$edit_lesson_ids = explode(',',$edit_lesson_ids);
				//$edit_course_id = $data_exists->getCourseId();
				
				$edit_blocking_quiz = $quiz_exists_obj->getQuizBlocking();
				$eddit_quiz_display_option = $quiz_exists_obj->getSqbInsertQuiz();
				$edit_sqb_quiz_show_start_screen = $quiz_exists_obj->getShowStartScreen();
				$edit_sqb_quiz_allow_retake = $quiz_exists_obj->getAllowRetake();
				$edit_sqb_quiz_max_attempts_limit = $quiz_exists_obj->getTotalAttempts();
				$edit_unlock_criteria = $quiz_exists_obj->getPassCriteria();
				$edit_sqb_passing_criteria = $quiz_exists_obj->getQuizPassmark();
				$edit_quiz_type = $quiz_exists_obj->getQuizType();
				$edit_sqb_quiz_show_result_screen = $quiz_exists_obj->getDisplayCorrectAnsOnPage();
				$edit_sqb_quiz_show_correct_incorrect_ans = $quiz_exists_obj->getDisplayAnswerOptions();
				
				$quiz_pagination = $quiz_exists_obj->getQuizPagination();
				$quiz_attempts_allowed = $quiz_exists_obj->getQuizAttemptsAllowed();
				
			}
			
		}
	}
	
	
	$course_name = '';
	$course_exists = Dap_Product::isExists($course_id);
	if($course_exists){
		$courseData = Dap_Product::loadProduct($course_id);
		if(isset($courseData)){
		$course_name = $courseData->getName();
		}
	}
	
	
	if($edit_blocking_quiz == 'N'){ 
	$selected_blocking_quiz_n = 'selected="selected"';
	} else {
	$selected_blocking_quiz_n = "";
	}
	
	if($edit_blocking_quiz == 'Y'){ 
	$selected_blocking_quiz_y = 'selected="selected"';
	} else {
	$selected_blocking_quiz_y = "";
	}
	
	if($edit_blocking_quiz == 'Y' && ($edit_quiz_type == 'scoring' || $edit_quiz_type == 'assessment')){
		$set_unblocking_criteria_view = '';
	}else{
		$set_unblocking_criteria_view = 'none';
	}

	if($edit_unlock_criteria == 'pass'){ 
		$edit_unlock_criteria_pass = 'selected="selected"';
	} else {
		$edit_unlock_criteria_pass = '';
	}
	
	if($edit_unlock_criteria == 'complete'){ 
	$edit_unlock_criteria_complete = 'selected="selected"';
	} else {
	$edit_unlock_criteria_complete = '';
	}
	
	if($edit_blocking_quiz == 'Y' && ($edit_quiz_type == 'scoring' || $edit_quiz_type == 'assessment') && ($edit_unlock_criteria != 'complete')){
		$what_passing_criteria_view = ''; 
	}else{ 
		$what_passing_criteria_view = 'none';
	}
	
	
	if($edit_sqb_quiz_allow_retake == 'N'){
		$edit_sqb_quiz_allow_retake_n = 'selected="selected"';
	} else {
		$edit_sqb_quiz_allow_retake_n = '';
	}
	
	if($edit_sqb_quiz_allow_retake == 'Y'){
		$edit_sqb_quiz_allow_retake_y = 'selected="selected"';
	} else {
		$edit_sqb_quiz_allow_retake_y = '';
	}
	
	if($edit_sqb_quiz_allow_retake == 'Y'){
		$allow_retake_view = '';
	} else {
		$allow_retake_view = 'none';
	}
	
	
	if($quiz_attempts_allowed == 'unlimited'){
		$allow_retake_u ='selected="selected"';
	} else {
		$allow_retake_u ='';
	}
	
	if($quiz_attempts_allowed == 'limited'){
		$allow_retake_l ='selected="selected"';
	} else {
		$allow_retake_l ='';
	}		
	
	
	if($quiz_attempts_allowed == 'limited'){
		$enter_max_limit_view = '';
	}else{ 
		$enter_max_limit_view = 'none';
	}
	
	if($eddit_quiz_display_option != 'manual' || $eddit_quiz_display_option == ''){
		$quiz_display_optionchecked = 'checked="checked"';
	} else {
		$quiz_display_optionchecked = '';
	}
	
	if($eddit_quiz_display_option == 'manual' ){
		$quiz_display_optionchecked_manual = 'checked="checked"';
	} else {
		$quiz_display_optionchecked_manual = '';
	}
	
	if($quiz_pagination == 'one_per_page' || $quiz_pagination == ''){
		$quiz_pagination_one = 'checked="checked"';
	} else {
		$quiz_pagination_one = '';
	}
	
	if($quiz_pagination == 'all'){
		$quiz_pagination_all = 'checked="checked"';
	} else {
		$quiz_pagination_all = '';
	}
	
	if($edit_sqb_quiz_show_start_screen == 'N'){
		$edit_sqb_quiz_show_start_screen_checked = '';
	} else {
		$edit_sqb_quiz_show_start_screen_checked = 'checked="checked"';
	}
	
	if($edit_sqb_quiz_show_result_screen == 'no'){
		$edit_sqb_quiz_show_result_screen_checked = '';
		$edit_sqb_quiz_show_result_screen_view = 'none';
		
	} else {
		$edit_sqb_quiz_show_result_screen_checked = 'checked="checked"';
		$edit_sqb_quiz_show_result_screen_view = '';
	}
	
	
	if($edit_sqb_quiz_show_correct_incorrect_ans == 'both'){
		$edit_sqb_quiz_show_correct_incorrect_ans_checked = 'checked="checked"';
	} else {
		$edit_sqb_quiz_show_correct_incorrect_ans_checked = '';
	}
	
	$quiz_obj = SQB_Quiz::load(); 
	$quiz_options ="";
	if(is_array($quiz_obj) && count($quiz_obj)){
	foreach($quiz_obj as $quiz_data_single_row) {
	    $quiz_type = trim($quiz_data_single_row->getQuizType());
	    $option_selected = '';
		if($quiz_data_single_row->getId() == $quiz_id){
			  $option_selected = 'selected="selected"'; 
		}
		$quiz_options .= '<option data-quiz-type="'.$quiz_type.'" value="'.$quiz_data_single_row->getId().'" '.$option_selected.'>'.$quiz_data_single_row->getQuizName().'</option>';
		}
	}
	
	$html .= '<tr class="viewDetailsCommon" id="viewDetails'.$lessons_id.'" style="display: none;">
	<td colspan="9">
	<div class="result-data-block">
	<button type="button" class="close closeViewDetails" data-dismiss="modal" aria-label="Close" onclick="closeViewDetails()">×</button>
	<div id="quiz-course-accordion">
	<div class="card">
	<div class="card-body">
	<!--form start-->
	<div class="add_edit_form" id="lesson_quiz_form_'.$lessons_id.'">
	<form>
			<div class="selected-course-info">
				<div class="form-group row">
				<label class=" " for=""><strong>Course Name:</strong></label>
				<div class="  selected-course-name">'.$course_name.'</div>
				</div>
				<input type="hidden" id="select_course_id" value="'.$course_id.'">
				<input type="hidden" id="select_lesson_id" value="'.$lessons_id.'">
				<div class="form-group row">
				<label class=" " for=""><strong>Lesson Name:</strong></label>
				<div class="  selected-course-name">'.$lessonsName.'</div>
				</div>
			</div><!---closed  spc-card_box -->
			
			<div class="spc-card_box">
				<h3 class="">Select the quiz that you want to display</h3>
				<div class="form-group row">
					<div class="col-sm-12">
					<select name="select_quiz_id" id="select_quiz_id" class="form-control">
						<option value="0">Select a Quiz</option>
						'.$quiz_options.'
					</select>
					</div>
				</div>
				
				<div class="form-group row sqb_quiz_shortcode_details" style="display:'.$displayshortcode.'">
					<div class="col-sm-6">
						<p><span class="shortcode_display" id="dynamic_copyable_text_sqb_dap_quiz">[SmartQuizBuilder id='.$quiz_id.'][/SmartQuizBuilder]</span><span data-id="dynamic_copyable_text_sqb_dap_quiz" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p>
					</div>
					<div class="sqb_dap_info_msg"><span >Please note:</span> That quiz in a lesson will always be displayed in-page and not in a popup. And it will show all of the questions on the same page. Pagination will not be used.</div>
				</div>
			</div><!---closed  spc-card_box -->
			
			
			<div class="spc-card_box">
				<h3 class="">Is this a Blocking Quiz?</h3>
				<div class="form-group row">
					
					<div class="col-sm-2">
						<select name="blocking_quiz" id="blocking_quiz" class="form-control">
							<option value="N" '.$selected_blocking_quiz_n.'>No</option>
							 <option value="Y" '.$selected_blocking_quiz_y.'>Yes</option>
						</select>
					</div>
				</div>
				
			
				<div class="form-group row blocking_quiz_yes_wrapper" style="display:'.$set_unblocking_criteria_view.'">
					<label class="col-sm-3" for="">Set Unblocking Criteria</label>
					<div class="col-sm-3">
						<select class="form-control" id="unlock_criteria" name="unlock_criteria">
						<option value="pass" '.$edit_unlock_criteria_pass.'>Users need to pass the quiz</option>
						<option value="complete" '.$edit_unlock_criteria_complete.'>Users need to just complete the quiz</option>
						</select>
					</div>
				</div>
				
				<div class="form-group row blocking_quiz_yes_wrapper sqb_passing_criteria_wrapper" style="display:'.$what_passing_criteria_view.'">
					<label class="col-sm-3" for="">What is the passing criteria?</label>
					<div class="col-sm-3">
						<div class="spc-input-outer">
							<input type="text" name="sqb_passing_criteria" value="'.$edit_sqb_passing_criteria.'" Placeholder="Enter Pass criteria" class="form-control" > 
						</div>
					</div>
					<div class="col-sm-1 mt-2 p-0 mr-0"><div class="spc-input-outer">%</div></div>
				</div>
			</div><!---closed  spc-card_box -->
			
			<div class="spc-card_box">
				<h3 class="">Do you want to allow users to retake the quiz?</h3>
				<div class="form-group row ">
					<div class="col-sm-2">
							<select name="sqb_quiz_allow_retake" id="sqb_quiz_allow_retake" class="form-control">
								<option value="N" '.$edit_sqb_quiz_allow_retake_n.'>No</option>
								<option value="Y" '.$edit_sqb_quiz_allow_retake_y.'>Yes</option>
							</select>
					</div>
				</div>
				<div class="form-group row retake_no_wrapper" style="display:'.$allow_retake_view.'">
					<label class="col-sm-3" for="">How many retake attempts are allowed</label>
					<div class="col-sm-3">
						<select name="sqb_quiz_many_attempts" id="sqb_quiz_many_attempts" class="form-control">
							<option value="unlimited" '.$allow_retake_u.'>Unlimited</option>
							<option value="limited" '.$allow_retake_l.'>Limited</option>
						</select>
					</div>
				</div>
				<div class="form-group row sqb_quiz_many_attempts_limit_wrapper" style="display:'.$enter_max_limit_view.'">
					<label class="col-sm-3" for="">Enter Max Attempt Limit</label>
					<div class="col-sm-3">
						<div class="spc-input-outer">
							<input type="number" name="sqb_quiz_max_attempts_limit" id="sqb_quiz_max_attempts_limit" max="100" class="form-control" value="'.$edit_sqb_quiz_max_attempts_limit.'" >
						</div>
					</div>
				</div>
			</div><!---closed  spc-card_box -->
			
			<div class="spc-card_box">
				<h3 class="">Do you want SQB to automatically insert the quiz on your lesson page?</h3>
				<div class="form-group row sqb_blocking_shortcode_acttion">
					
					<div class="col-sm-12 mt-2 mb-3">
							<input type="radio"  name="quiz_display_option" value="automatic"  class="form-control_1" '.$quiz_display_optionchecked.'>I want SQB to automatically insert the quiz on my lesson page above the "mark as complete" button <br>
					</div>		
					<div class="col-sm-12">		
							<input type="radio" name="quiz_display_option" value="manual" class="form-control_1" '.$quiz_display_optionchecked_manual.'>I want to manually add the quiz shortcode on my lesson page
					</div>
				</div>
			</div><!---closed  spc-card_box -->	
			<div class="spc-card_box">
				
				<h3 class="">Pagination Options</h3>
				<div class="form-group row sqb_blocking_shortcode_acttion">
					
					<div class="col-sm-12 mt-2 mb-3">
							<input type="radio"  name="quiz_pagination" value="all"  class="form-control_1" '.$quiz_pagination_all.'>All questions on the same page <br>
					</div>		
					<div class="col-sm-12">		
							<input type="radio" name="quiz_pagination" value="one_per_page" class="form-control_1" '.$quiz_pagination_one.'>One question per page
					</div>
				</div>
				
				 
			</div><!---closed  spc-card_box -->	
			
		    <div class="spc-card_box">
				<h3 class="">Configure Display Options</h3>		
				
				
				<div class="form-group row">
					<label class="col-sm-5" for="">Do you want to display a Start Screen before the Quiz (Questions)?</label>
						<div class="col-sm-2"> 
							<div class="square-switch_onoff">
									<input class="checkbox sqb_quiz_show_start_screen" name="sqb_quiz_show_start_screen_'.$lessons_id.'" type="checkbox" id="sqb_quiz_show_start_screen_'.$lessons_id.'" value="Y" '.$edit_sqb_quiz_show_start_screen_checked.'>
									<label for="sqb_quiz_show_start_screen_'.$lessons_id.'"></label>
							</div>
						</div>
				</div>
			    <div class="form-group row">
					<label class="col-sm-5" for="">Do you want to display the final results after the quiz?</label>
						<div class="col-sm-2"> 
							<div class="square-switch_onoff">
									<input class="checkbox sqb_quiz_show_result_screen" name="sqb_quiz_show_result_screen_'.$lessons_id.'" type="checkbox" id="sqb_quiz_show_result_screen_'.$lessons_id.'" value="Y" '.$edit_sqb_quiz_show_result_screen_checked.'>
									<label for="sqb_quiz_show_result_screen_'.$lessons_id.'"></label>
							</div>
						</div>
				</div>	
				 
				<div class="form-group row result_screen_yes_option_wrapper" style="display:'.$edit_sqb_quiz_show_result_screen_view.'">
					<label class="col-sm-5" for="">Do you want to display correct/incorrect answers?</label>
						<div class="col-sm-2"> 
							<div class="square-switch_onoff">
									<input class="checkbox sqb_quiz_show_correct_incorrect_ans" name="sqb_quiz_show_correct_incorrect_ans_'.$lessons_id.'" type="checkbox" id="sqb_quiz_show_correct_incorrect_ans_'.$lessons_id.'" value="Y" '.$edit_sqb_quiz_show_correct_incorrect_ans_checked.'>
									<label for="sqb_quiz_show_correct_incorrect_ans_'.$lessons_id.'"></label>
							</div>
						</div>
					</div>	
			</div><!---closed  spc-card_box -->
			<div class="question_error_msg_outer dap_quiz_error_msg_outer" style="display: none;">
			</div>
			<div class="saved_data_msg quiz-save-btn-msg" style="display: none;">Saved Sucessfully!</div>

			<div class="quiz-actions justify-content-center">
				<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_dap_integration(this)"> Save </a> 
			</div>
		</div>
	</form>
	
	<!--form end-->
	</div>
	</div>
	</div>
	</div>
	</td>
	</tr>';
	return $html;
}


add_action('wp_ajax_SQBChangeGdprStatus', 'SQBChangeGdprStatus');
add_action('wp_ajax_nopriv_SQBChangeGdprStatus', 'SQBChangeGdprStatus');
function SQBChangeGdprStatus(){
	$country_code = $_REQUEST['code'];
	$status = $_REQUEST['value'];
	$gdpr_status = SQB_GDPR::updateByCountyCode($country_code,$status);
	echo json_encode($gdpr_status);
	die;
}

add_action('wp_ajax_SQBDeleteCountryGdpr', 'SQBDeleteCountryGdpr');
add_action('wp_ajax_nopriv_SQBDeleteCountryGdpr', 'SQBDeleteCountryGdpr');
function SQBDeleteCountryGdpr(){
	$countryID = $_REQUEST['id'];
	$gdpr_status = SQB_GDPR::DeleteById($countryID);
	die;
}

add_action( 'wp_ajax_sqb_add_country_gdpr', 'sqb_add_country_gdpr' );
add_action( 'wp_ajax_nopriv_sqb_add_country_gdpr', 'sqb_add_country_gdpr' );
function sqb_add_country_gdpr(){
	parse_str($_POST['postdata'], $postdata);
	$country_name = $postdata['country_name'];
	$country_code = $postdata['country_code'];
	$result = SQB_GDPR::loadByCountryCode($country_code);

	if($result) {
		$msg = 'sqb-gdpr-error';
	}else{	
		$gdpr_data = new SQB_GDPR();
		$gdpr_data->setCountryName($country_name);
		$gdpr_data->setCountryCode($country_code);
		$gdpr_data->setStatus(1);
		$gdpr_data->create();
	}
	echo json_encode($msg);
	die();
}


add_action( 'wp_ajax_sqb_change_gdpr_status', 'sqb_change_gdpr_status' );
add_action( 'wp_ajax_nopriv_sqb_change_gdpr_status', 'sqb_change_gdpr_status' );
function sqb_change_gdpr_status(){
	$sqb_gdpr_checkbox = $_POST['value'];

	$sqb_google_font_option = !empty($_POST['google_font_enable']) ? $_POST['google_font_enable'] : '';	 
	$sqb_thirdParty_checkbox = !empty($_POST['sqb_thirdParty_checkbox']) ? $_POST['sqb_thirdParty_checkbox'] : '';	 
	$_SESSION['gdpr_set'] = 'yes';
	if($sqb_gdpr_checkbox==1){
		update_option( 'sqb_gdpr_checkbox', 0 );
	}else{
		update_option( 'sqb_gdpr_checkbox', 1 );
	}

	if($sqb_google_font_option=="N"){
		update_option( 'sqb_google_font_option', "N");
	}
	if($sqb_thirdParty_checkbox=="0"){
		update_option( 'sqb_thirdParty_checkbox', 0 );
	}
	die();
}

add_action( 'wp_ajax_sqb_change_thirdparty_status', 'sqb_change_thirdparty_status' );
add_action( 'wp_ajax_nopriv_sqb_change_thirdparty_status', 'sqb_change_thirdparty_status' );
function sqb_change_thirdparty_status(){
	$sqb_thirdparty_checkbox = $_POST['value'];
	
	if($sqb_thirdparty_checkbox==1){
		update_option( 'sqb_thirdParty_checkbox', 1 );
	}else{
		update_option( 'sqb_thirdParty_checkbox', 0 );
	}
	die();
}


/*add_action( 'wp_ajax_sqb_change_gdpr_notification_status', 'sqb_change_gdpr_notification_status' );
add_action( 'wp_ajax_nopriv_sqb_change_gdpr_notification_status', 'sqb_change_gdpr_notification_status' );
function sqb_change_gdpr_notification_status(){
	$sqb_gdpr_notifications = $_POST['value'];
	$_SESSION['gdpr_set'] = 'yes';
	if($sqb_gdpr_notifications ==1){
		update_option( 'sqb_gdpr_notifications', 0 );
	}else{
		update_option( 'sqb_gdpr_notifications', 1 );
	}
	die();
}*/


add_action( 'wp_ajax_sqb_clone_outcome', 'sqb_clone_outcome' );
add_action( 'wp_ajax_nopriv_sqb_clone_outcome', 'sqb_clone_outcome' );
function sqb_clone_outcome(){
	$randval = rand(1,100);	
	if(isset($_POST)){	
		$temp = $_POST['selected_template']; 
		$quiz_id = $_POST['quiz_id'];
		$outcomeId = $_POST['outcome_id'];
		$count_li = $_POST['count_li'];
		$quiz_type = $_POST['quiz_type'];
		$check_pdf = !empty($_POST['check_pdf']) ? $_POST['check_pdf'] : '';
		$output_html_result = SQB_Outcome::loadByQuizIdAndOutcomeId($quiz_id, $outcomeId);
		
		$output = array();	
		$img_url = plugin_dir_url(__FILE__)."../../includes/images/outcome2.jpg";				 
		$csspath =  plugin_dir_url(__FILE__)."../../includes/templates/result/" . $temp . "/" . $temp . ".css";
		$cssfile = '<link href="'.$csspath.'?v='.$randval.'" rel="stylesheet">'; 
		$curernt_data_time_random =  date('y_m_d_h_m_s').rand(10,1000);
		$file = rawurldecode($output_html_result->outcome_html);

		
		if($temp == 'template9'){
			$temp_layout = "sqb-template-bg-full-width";
			$video_data = '';
			$template_alignment = "";
			$video_class = "";
			$template_image = "";
			$bg_color = "";
			$outcome_template_image = "";
			$video_has_thumb = "";
			$template9_customizer_data = $output_html_result->getCustomizerOptions();
			if(!empty($template9_customizer_data)){
				$template9_customizer_data = maybe_unserialize($template9_customizer_data);
				if(!empty($template9_customizer_data['temp_layout'])){
					$temp_layout = $template9_customizer_data['temp_layout'];
				}
				if(!empty($template9_customizer_data['template_image'])){
					$template_image = $template9_customizer_data['template_image'];
					if(!empty($template_image) && $template_image != 'none'){
						$outcome_template_image = 'style="background-image:url('.$template_image.')"';
					}
				}
				if(!empty($template9_customizer_data['template_alignment'])){
					$template_alignment = $template9_customizer_data['template_alignment'];
				}
				if(!empty($template9_customizer_data['splash_image'])){
					$splash_image = $template9_customizer_data['splash_image'];
					$video_has_thumb = 'video-has-thumb';
				}
				if(!empty($template9_customizer_data['background_color'])){
					$background_color = $template9_customizer_data['background_color'];
					$bg_color = "background-color:".$background_color;
				}
				if(!empty($template9_customizer_data['video_url'])){
					$video_url = $template9_customizer_data['video_url'];

					if($temp_layout == "sqb-template-bg-video-left" || $temp_layout == "sqb-template-bg-video-right"){
						$video_class = "sqb-cover-video-enabled";
						$video_url = $template9_customizer_data['video_url'];
						$video_controls = !empty($template9_customizer_data['video_controls'])?$template9_customizer_data['video_controls']:'Y';
						$video_source = !empty($template9_customizer_data['video_source'])?$template9_customizer_data['video_source']:'';
						$video_play_btn_color = !empty($template9_customizer_data['video_play_btn_color'])?$template9_customizer_data['video_play_btn_color']:'#ffffff';
						$number = rand(10,100);

						$output['video_id'] = "my-player-".$number;

						$video_data = '<input type="hidden" class="video_source" name="video_source" value="'.$video_source.'"><input type="hidden" class="video_id'.$number.'" name="video_id" value="'.$video_url.'"><input type="hidden" class="video_controls" name="video_controls" value="'.$video_controls.'"><input type="hidden" class="video_play_btn_color" name="video_play_btn_color" value="'.$video_play_btn_color.'"><input type="hidden" class="splash_image" name="splash_image" value="'.$splash_image.'"><video id="my-player-'.$number.'" class="video-js '.$video_has_thumb.' play-slient" controls preload="none" muted poster="'.$splash_image.'"> <source src="'.$video_url.'" type="video/mp4"></source> <p class="vjs-no-js"> To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank"> supports HTML5 video </a> </p> </video>'; 
					}
				}
			}


			$file = '<div class="outcome-section Quiz-Template9-column-wrapper '.$sqb_start_screen_background_image.' '.$temp_layout.' '.$video_class.'" style="'.$bg_color.';'.$default_image.'"><div class="outcome-Screen-Quiz-Template9-left-side Quiz-Template9-left-column-wrapper" '.$outcome_template_image.'>'.$video_data.'</div><div class="outcome-Screen-Quiz-Template9-right-side Quiz-Template9-right-column-wrapper">'.stripslashes($file).'</div></div>';
		}else{
			$file = '<div class="outcome-section">'.stripslashes($file).'</div>';
		}




		$outcome_count_class = 'card_res'.$randval;	
		$show_fist_outcome_class = ' active show ';	
		$outcome_num = $count_li+1;
		$output['outcome_li'] = '<li><a data-toggle="pill" class="active show" href="#'.$outcome_count_class.'">Outcome '.$outcome_num.'</a></li>';



		$topheading ='<div class="card res_data_cont tab-pane fade '.$show_fist_outcome_class.'" id="'.$outcome_count_class.'">
				<div id="rescollapseOne'.$randval.'" class="sqb_res_collapse collapse show" aria-labelledby="resheadingOne'.$randval.'" data-parent="#RES-accordion" style="">
					<div class="card-body">
						<input type="hidden" id="outcome_id" value="'.@$id.'"/><input type="hidden" id="outcome_redirect" value=""/><input type="hidden" id="outcome_screen" value=""/>';
		$topheadingend ='</div></div></div>';

		$outcometitle = '<div class="quiz-content-card outcome_page_show">
									<label for="" class="quiz_label">Outcome Title</label>
									<div class="quiz_right-content">
										<input type="text" name="outcome_name" value="'.$output_html_result->outcome_name.'" class="outcome_name">
										<input type="hidden" name="enable_outcome_background_image" value="N">									 
									</div> 
									<div class="delete-clone"><span class="sqb_backend_show top_remove sqb_remove_section sqb_delete_btn" data-id="result_temp_id" ><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Outcome"></i></span><span class="sqb_backend_show top_remove sqb_backend_show clone-outcome" data-id="result_temp_id" data-quizid="'.$quiz_id.'"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></span></div> 
								</div>';


		//if($quiz_type =="assessment" || $quiz_type =="scoring"  ){ // if quiz_type is assessment or scoring

			$get_outcome_range = $output_html_result->point_range;
			$explode_range = explode("-",$get_outcome_range);

				$numberdata = '<div class="quiz-content-card assessment_number_div " >';	
							/*if($quiz_type =="assessment"){
								$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text">Create different results for students with different correct answers.</label>';
							}else if($quiz_type =="scoring"){
								$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text">Create different results for students with different scores.</label>';
							}
*/
							$numberdata .= '<label for="" class="quiz_label">Enter Number</label>
							<div class="quiz_right-content">										 										 
								<input name="number_val" class="number_val small_input" type="number"/ value="'.$get_outcome_range = $output_html_result->point.'"> 
							</div>		
						</div>	
						<div class="quiz-content-card assessment_range_div">';
						
								//if($quiz_type =="assessment"){
									$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text assessment_label_text">Create different results for students with different correct answer range.</label>';
									
								//}else if($quiz_type =="scoring"){
									$numberdata .= '<label for="" class="quiz_label quiz_outcome_diff_text scoring_label_text">Create different results for students with different scoring range.</label>';
								//}
							$numberdata .= '<label for="" class="quiz_label">Enter Range</label>
							<div class="quiz_right-content">										 										 
								<input name="range_val" class="range_val_start small_input" value="'.$explode_range[0].'" type="number"/> <div class="text_bet">to</div>  <input name="range_val1" value="'.$explode_range[1].'"  class="range_val_end small_input" type="number"/> 
							</div>'	;
							$numberdata .= '<span data-id="'.$randval.'" class="whatIsRange" id="whatIsRange'.$randval.'">What is range?</span>';

						$numberdata .= '<div class="whatIsRangeShowHide'.@$randval.' whatIsRangeCommonClass" style="display:none"><span class="closeWhatIsRange" data-id="'.@$randval.'">x</span><p>There are a total of '.@$ques_length.' questions in this quiz. You could create any number of outcomes. <br>For e.g: You can create 3 different outcomes to cover different scores/correct answers.<br><strong>Range 1 : </strong>'.@$firstStartRange.' to '.@$firstEndRange.'<br><strong>Range 2 : </strong>'.@$secondStartRange.' to '.@$secondEndRange.'<br><strong>Range 3 : </strong>'.@$thirdStartRange.' to '.@$thirdEndRange.'</p></div></div>';

				
			/*}else{
				$numberdata ="";					 
			}*/

			$addbr ='<div class="border_bottom"></div>';
			$addbtn ='<div class="add_new_result_outer">
						<a href="javascript:void(0)" class="add_new_result">Add A New Outcome</a>
						<a href="javascript:void(0)" class="save_new_result">Save Outcome</a>
						
					</div>';
			
			$output['outcome_html'] = $topheading.$cssfile.$outcometitle.$numberdata.$addbr.$file.$addbtn.$topheadingend; 

		}else{  
			$output = "";
		}	
	echo json_encode($output);
	die();
}


//Clone Question
add_action( 'wp_ajax_sqb_clone_question', 'sqb_clone_question' );
add_action( 'wp_ajax_nopriv_sqb_clone_question', 'sqb_clone_question' );
function sqb_clone_question(){
	if(isset($_POST)){	
		$output_html_result = array();
		$quiz_id = $_POST['quiz_id'];
		$question_id = $_POST['question_id'];
		$output_html_result['question_data'] = SQB_QuizQuestionBank::loadById($question_id);
		$output_html_result['answer_data'] = SQB_QuizAnswers::loadByQuestionId($question_id);

	}
	echo json_encode($output_html_result);
	die();
}


add_action('wp_ajax_sqb_save_quiz_category', 'SQBSaveQuizCategoryAjax');
add_action('wp_ajax_nopriv_sqb_save_quiz_category', 'SQBSaveQuizCategoryAjax');


function SQBSaveQuizCategoryAjax(){
	$output = array();
	if(isset($_POST['cat_name'])){
		
		$current_date = date('Y-m-d H:m:s');
		
		$cat_status = 'Y';
		$cat_name = $_POST['cat_name'];
		$cat_desc = $_POST['cat_desc'];
		$cat_id =   $_POST['cat_id'];
		$new_obj =  new SQB_QuizCategory();
		$new_obj->setName($cat_name);
		$new_obj->setDescription(stripslashes($cat_desc));
		$new_obj->setStatus($cat_status);
		$new_obj->setDate($current_date);
		
		$exist_Obj = SQB_QuizCategory::loadById($cat_id);  
		 
		if(isset($exist_Obj)){
			$new_obj->setId($exist_Obj->getId());
			$id = $new_obj->update();
			$output['table_action'] = 'update';
			
		}else{
			$id =  $new_obj->create();
			$output['table_action'] = 'create';
			
		}
		
		$output['id'] = $id;	
		$output['success'] = 'saved ';	
		$output['data'] = SQBGetQuizCategoryTableHtml();	
		
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_load_quiz_category_info', 'SQBLoadQuizCategoryInfoAjax');
add_action('wp_ajax_nopriv_sqb_load_quiz_category_info', 'SQBLoadQuizCategoryInfoAjax');


function SQBLoadQuizCategoryInfoAjax(){
	$output = array();
	if(isset($_POST['cat_id'])){
		$cat_id = $_POST['cat_id'];
		$exist_Obj = SQB_QuizCategory::loadById($cat_id);  
		if(isset($exist_Obj)){
			$output['name']=  $exist_Obj->getName();
			$output['description']=  $exist_Obj->getDescription();
			$output['id']=  $exist_Obj->getId();
			$output['success'] = 'data load';
			
		}else{
			$output['error'] = 'Something Went Wrong';	
		}
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_quiz_category_delete', 'SQBQuizCategoryDeleteAjax');
add_action('wp_ajax_nopriv_sqb_quiz_category_delete', 'SQBQuizCategoryDeleteAjax');


function SQBQuizCategoryDeleteAjax(){
	$output = array();
	if(isset($_POST['cat_id'])){
		$cat_id = $_POST['cat_id'];
		$exist_Obj = SQB_QuizCategory::delete($cat_id);  
		$output['success'] = 'delete';
		$output['data'] = SQBGetQuizCategoryTableHtml();	
		
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

function SQBGetQuizCategoryTableHtml(){
	$output = array();
	$html  = '';
	$quizCategorydata = SQB_QuizCategory::load();
	if(isset($quizCategorydata)){
			
		$html .= '<div class="quiz_category_head"> <h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Manage Quiz Category</h3>   </div>';
		$html .= '<div class="sqb_quiz_category_outer">';
		$html .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#quiz_category_add_model" class="create-new-btn"><i class="fa fa-plus-circle" aria-hidden="true" ></i>Add a New Quiz Category</a>';
		$html .= '<div class="sqb_quiz_category_table_wrapper">';
		
		$html .= '<table class="quiz_table" id="sqb_quiz_category_table" style="display:none;">';
		$html .= '<thead><tr><th>ID</th><th>Name</th><th class="text-center" width="100px">Date</th><th class="text-center">Action</th></tr></thead>';
		$html .= '<tbody>';	 
		$quiz_category_table = '';
		$category_coneected_list = SQB_QuizCategory::getConnectQuizDetails();
		foreach($quizCategorydata as $quizCategorydata_row) {
			    $delete_status = 'Y';
			    if(isset($category_coneected_list[$quizCategorydata_row->getId()])){
					$delete_status = 'N';
				}
				$quiz_category_table  .= '<tr class="Manage--Quiz-block cat_tr_'.$quizCategorydata_row->getId().'">';
				$quiz_category_table  .= '<td width="20px">'.$quizCategorydata_row->getId().'</td>';
				$quiz_category_table  .= '<td width="500px">'.$quizCategorydata_row->getName().'</td>';
				$quiz_category_table  .= '<td class="text-center" width="100px">'.$quizCategorydata_row->getDate().'</td>';
				$quiz_category_table  .= '<td class="text-center">';
				$quiz_category_table  .= '<div class="action-icon_btn">';
				$quiz_category_table  .= '<a title="Edit Quiz" href="javascript:void(0)" onclick="sqb_edit_quiz_categroy('.$quizCategorydata_row->getId().')" class="ManageQuiz-action-btn item-edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>';
				$quiz_category_table  .= '<a class="ManageQuiz-action-btn item-delete-btn" delete-status="'.$delete_status.'" title="Delete Quiz" href="javascript:void(0)"  onclick="sqb_quiz_cateogry_delete('.$quizCategorydata_row->getId().')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>';	
				$quiz_category_table  .= '</td>';
				$quiz_category_table  .= '</tr>';
		}
		$html .= $quiz_category_table;		 
		$html .= '</tbody>';		 
		$html .= ' </table>';
		$html .= '</div>';
		$html .= '</div>';		
	} else {
		$addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";
		$html .= '<div class="have-no-quiz">';
		
		$html .= '<img src="'.$addicon.'" alt="icon">';
		$html .= '<h3>You don\'t have any Quiz Category yet. </h3>';
		$html .= '<a href="javascript:void(0)" data-toggle="modal" data-target="#quiz_category_add_model"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first Quiz Category</a><p>Please create a new quiz Category to get started!</p>'
		 ;
		$html .= '</div> ';
		$output['no_data']	= 'empty';				
	}
	
	$output['html']	= $html;				
	
	return $output;
}


function sqbGetQuizCategoryListHtmlOfQuestionScreen($cat_select_id = 0, $show_wrapper = ''){
	$quiz_category_list='';
	$defalut_cat_name = 'Select Category';
	$selected_cat_name = $defalut_cat_name;
	$selected_cat_val = '';
	$quizCategorydata = SQB_QuizCategory::load();
	if(isset($quizCategorydata)){
		foreach($quizCategorydata as $quizCategorydata_row) {
				$cat_name = $quizCategorydata_row->getName();
				$cat_id = $quizCategorydata_row->getId();
				if($cat_select_id == $quizCategorydata_row->getId()){
					$selected_cat_name = $cat_name;
					$selected_cat_val = $cat_id;
				}
				$quiz_category_list  .= '<li data-title="'.$cat_name.'"><a href="javascript:void(0)" value="'.$cat_id.'">'.$cat_name.'</a></li>';
		}
	}
	$quiz_category_list = '<li><a href="javascript:void(0)" value="">'.$defalut_cat_name.'</a></li>'.$quiz_category_list;
	$display_wrapper = "none";
	if($selected_cat_val != ''){
		$display_wrapper = "flex";
	}
	if($show_wrapper == 'Y'){
		$display_wrapper = "flex";
	}
	if($show_wrapper == 'N'){
		$display_wrapper = "none";
	}
	
	$url = admin_url('/admin.php?page=sqb_settings#Quiz_setting_tab_2');
	$html = '<div class="quiz-content-card quiz_category-type-card quiz_category_type_wrapper" style="display:'.$display_wrapper.'">
									<div class="sqb-check-category-wrapper">
									<a href="#" class="sqb-show-category-mapping-lists" onclick="sqb_show_categories()">Check Categories</a>
									<div class="dropdown dropdown-custom-style">
										<button class="dropdown-toggle" type="button"   data-value="'.$selected_cat_val.'">'.$selected_cat_name.'</button> 
										<ul class="dropdown-menu quiz_category_type_list_ul">
										<input type="text" name="sqb_search_cat_names" id="sqb_search_cat_names" value="" style="max-width: 100%;" placeholder="Search Name">
										'.$quiz_category_list.'
										</ul>
									</div>
									</div>
									
									<span class="sqb_refresh_cat sqb_refresh_quiz_cat" style="display:none;"><i class="fa fa-refresh" aria-hidden="true"></i></span>
									<div class="tool-tip" style="margin-left:10px;display:none;">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc" style="max-width:350px;">You can create categories in the Settings Page under "Advanced Quiz Setting" >> Quiz Category tab. Click <a href="'.$url.'" target="_blank">here</a> to create.</div>
									</div>
								</div>';
	return $html; 
}


add_action('wp_ajax_sqb_refresh_quiz_category_drop_down', 'SQBRefreshQuizCategorydropdownAjax');
add_action('wp_ajax_nopriv_sqb_refresh_quiz_category_drop_down', 'SQBRefreshQuizCategorydropdownAjax');


function SQBRefreshQuizCategorydropdownAjax(){
	
	$output = array();
	$output['html'] = sqbGetQuizCategoryListHtmlOfQuestionScreen(0,'Y');
	echo json_encode($output);
	die;
}

add_action('wp_ajax_SqbFormulaQuestionData', 'SqbFormulaQuestionData');
add_action('wp_ajax_nopriv_SqbFormulaQuestionData', 'SqbFormulaQuestionData');
function SqbFormulaQuestionData(){
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$questionsObj = SQB_QuizQuestions::loadByQuizId($quiz_id);
		$questions_order_array = array();
		foreach($questionsObj as $questionObj){
			$question_id  = $questionObj->getQuestionId();
			$question_data = SQB_QuizQuestionBank::loadById($question_id);
			if($question_data){
			   $question_order =  $question_data->getQuestionOrder();
			   $matrix_html =  $question_data->getMatrixHtml();
			   if(isset($questions_order_array[$question_order])){
				$question_order = count($questions_order_array) + 1;
			   }
			   if(isset($questions_order_array[$question_order])){
				$questions_order_array[$questionsObj_count++] = $question_data;
				}else{
				$questions_order_array[$question_order] = $question_data;
				}
			  }
		}
	}else{
		$output['error'] = 'Something Went Wrong';
	}
	echo json_encode($questions_order_array);die;
}

/**/

add_action('wp_ajax_SqbCategoryData', 'SqbCategoryData');
add_action('wp_ajax_nopriv_SqbCategoryData', 'SqbCategoryData');
function SqbCategoryData(){
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$categoriesObj = SQB_QuizCategory::load();
		$output = array();
		$i = 0;
		foreach($categoriesObj as $categoryObj){
			$output[$i]['category_id']  = $categoryObj->getId();
			$output[$i]['category_name'] =  $categoryObj->getName();
			$i++;
		}
	}else{
		$output['error'] = 'Something Went Wrong';
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqbQuestionAnswerData', 'sqbQuestionAnswerData');
function sqbQuestionAnswerData(){
	if(isset($_POST['ques_ids'])){
		$ques_ids = $_POST['ques_ids'];
		$i=0;
		foreach($ques_ids as $ques_id){
			$answers_data = '';
			$answersdataobj =  SQB_QuizAnswers::loadByQuestionId($ques_id);	 
			foreach($answersdataobj as $answersobj){
				$ans_id = $answersobj->getId();
				$answer = stripslashes($answersobj->getAnswerTitle());
				$addselected_cls=' ' ;			 
				if($answers_id !=""){
					if(in_array($ans_id, $answers_id_arr)){					 
						$addselected_cls='selected_answers_cls' ;
					}				
				}			 
				$answers_data .= '<option class="option-answer '.$addselected_cls.' optionans'.$ans_id.' " value="'.$ans_id.'" data-answer-id="'.$ans_id.'">'.$answer.'</option>';
			}
			$newarray['q'.$i.'_'.$ques_id] = $answers_data;
			$i++;
		}
		echo json_encode($newarray);die;
	}
}
//added for advanced_rule
					
add_action('wp_ajax_sqbAnwerDataByQuesId', 'sqbAnwerDataByQuesId');
 
function sqbAnwerDataByQuesId(){
	if(isset($_POST['ques_id'])){
		$question_id = $_POST['ques_id'];
		$answers_id = $_POST['answers_id'];
		$answersdataobj =  SQB_QuizAnswers::loadByQuestionId($question_id);	 
		$answers_data = '';		
		if($_POST['answers_id'] !=""){			 
			$answers_id_arr = explode(",",$_POST['answers_id']);	
		}	 
		foreach($answersdataobj as $answersobj){
			$ans_id = $answersobj->getId();
			$answer = stripslashes($answersobj->getAnswerTitle());
			$addselected_cls=' ' ;			 
			if($answers_id !=""){
				if(in_array($ans_id, $answers_id_arr)){					 
					$addselected_cls='selected_answers_cls' ;
				}				
			}			 
			$answers_data .= '<option class="option-answer '.$addselected_cls.' optionans'.$ans_id.' " value="'.$ans_id.'" data-answer-id="'.$ans_id.'">'.$answer.'</option>';
		} 
	}else{
		$output['error'] = 'Something Went Wrong';
	}
	echo json_encode($answers_data);die;
}

add_action('wp_ajax_sqbSaveOutcomeGameAnimation', 'sqbSaveOutcomeGameAnimation');
 
function sqbSaveOutcomeGameAnimation(){

	$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : '';
	$outcome_id = !empty($_POST['outcome_id']) ? $_POST['outcome_id'] : ''; 
	$content = !empty($_POST['content']) ? $_POST['content'] : ''; 

	$obj = new SQB_Outcome();
	$obj->setQuizId($quiz_id);
	$obj->setId($outcome_id);
	$obj->setGameAnimationHtml($content);

	$obj->updateGameAnimationHtml();

	echo json_encode(array('data'=> '', 'msg'=>'success'));die;
}

add_action('wp_ajax_sqbLoadcomeGameAnimation', 'sqbLoadOutcomeGameAnimation');
 
function sqbLoadOutcomeGameAnimation(){

	$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : '';
	$outcome_id = !empty($_POST['outcome_id']) ? $_POST['outcome_id'] : ''; 
	$outcomeObj = SQB_Outcome::loadById($outcome_id);

	echo json_encode(array('data'=> stripslashes($outcomeObj->getGameAnimationHtml()), 'msg'=>'success'));die;
}

add_action('wp_ajax_sqbSaveAdvanced', 'sqbSaveAdvanced');
 
function sqbSaveAdvanced(){
 	/*if ( !current_user_can( 'manage_options' ) ) {
	    return json_encode(array('error' => 'Not allowed to access'));die;  
	}*/
	check_admin_referer('sqbSaveAdvanced', 'security');
	$enabled_advanced = !empty($_POST['enabled_advanced']) ? $_POST['enabled_advanced'] : '';
	$adv_rule_id = isset($_POST['adv_rule_id']) ? $_POST['adv_rule_id'] : 0;
	$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : '';
	$question_id = !empty($_POST['ques_id']) ? $_POST['ques_id'] : '';
	$answers_id = !empty($_POST['answers_id']) ? $_POST['answers_id'] : '';
	$outcome_id = !empty($_POST['outcome_id']) ? $_POST['outcome_id'] : ''; 
	$action_val = !empty($_POST['action_val']) ? $_POST['action_val'] : ''; 
	$skip_optin = !empty($_POST['skip_optin']) ? $_POST['skip_optin'] : '';
	$skip_quiz = !empty($_POST['skip_quiz']) ? $_POST['skip_quiz'] : '';
	$conditions = !empty($_POST['complex_advance_rules']) && is_array($_POST['complex_advance_rules']) 
    ? $_POST['complex_advance_rules'] 
    : [];
	$answer_title = '';
	if($action_val =="enabled_advanced_sett"){	
		$rulesdata = SQB_AdvancedRule::loadByQuizId($quiz_id);
		if(is_array($rulesdata)){
			foreach($rulesdata as $rulesdata1){
				$getQuestionid = $rulesdata1->getQuestionId();
				if($getQuestionid){
					$obj = new SQB_AdvancedRule();
					$obj->setId($rulesdata1->getId());
					$obj->setQuizId($rulesdata1->getQuizId());
					$obj->setQuestionId($rulesdata1->getQuestionId());
					$obj->setAnswersId($rulesdata1->getAnswersId());
					$obj->setOutcomeId($rulesdata1->getOutcomeId());
					$obj->setCategoryTotal($rulesdata1->getCategoryTotal());
					$obj->setCategoryId($rulesdata1->getCategoryId());
					$obj->setFormulaId($rulesdata1->getFormulaId());
					$obj->setFormulaPriority($rulesdata1->getFormulaPriority());
					$obj->setSkipOptin($rulesdata1->getSkipOptin());
					$obj->setSkipQuiz($rulesdata1->getSkipQuiz());
					$obj->setEnabledAdvanced($enabled_advanced);
					$obj->setConditions(maybe_serialize($conditions));
					$obj->update();
				}
			}
		}
		die;
	}
	 
	if($action_val =="delete"){	
		$id = $_POST['id']; 	
		SQB_AdvancedRule::deleteById($id);	 

		$categoriesObj = SQB_QuizCategory::load();
		$ids = [];
		$all_category_id = [];
		foreach($categoriesObj as $categoryObj){
			if($categoryObj->getStatus() == 'Y'){
				$ids[] = $categoryObj->getId();
			}
		}
		
		$rule_data_all = SQB_AdvancedRule::loadByQuizId($quiz_id);
		if(($rule_data_all) && count($rule_data_all)){
				foreach($rule_data_all as $rule_data){
					$category_id = $rule_data->getCategoryId();
					if($category_id){
						$all_category_id[] = $category_id;
					}
				}
			}

		$remaning_ids = array_diff($ids, $all_category_id);
		foreach($remaning_ids as $remaning_id){
			$cat_name = SQB_QuizCategory::loadById($remaning_id);
			$category_name = $cat_name->getName();
			$remaining_category .=  '<li>'.$category_name.'</li>';
		}

		echo json_encode(array('remaining_category'=>$remaining_category, 'msg'=>'success'));die;	
	}	 
	  
	$date = date('Y-m-d H:i:s');   
	$ruledata = SQB_AdvancedRule::loadByQIdAndOIdAndQuizId($question_id,$outcome_id,$quiz_id);
	$ruledata_obj = new SQB_AdvancedRule();
	$ruledata_obj->setQuizId($quiz_id);
	$ruledata_obj->setQuestionId($question_id);
	$ruledata_obj->setAnswersId($answers_id);
	$ruledata_obj->setOutcomeId($outcome_id);
	$ruledata_obj->setEnabledAdvanced($enabled_advanced);
	$ruledata_obj->setSkipOptin($skip_optin);
	$ruledata_obj->setSkipQuiz($skip_quiz);
	$ruledata_obj->setDate($date);
	$ruledata_obj->setConditions(maybe_serialize($conditions));
	
	$new_answer_ids = [];
	foreach ($conditions as $condition) {
	    if (!empty($condition['answer'][0])) {
	        $new_answer_ids[] = $condition['answer'][0];
	    }
	}

	// Retrieve current IDs based on advanced rule ID
	$current_ids = [];
	$adv_rule = SQB_AdvancedRule::loadById($adv_rule_id);
	if ($adv_rule) {
	    $get_conditions = $adv_rule->getConditions();
	    if (!empty($get_conditions)) {
	        $uns_conditions = @unserialize($get_conditions); // Add error suppression for safety
	        if (is_array($uns_conditions)) {
	            foreach ($uns_conditions as $uns_condition) {
	                if (!empty($uns_condition['answer']) && is_array($uns_condition['answer'])) {
	                    $current_ids = array_merge($current_ids, $uns_condition['answer']);
	                }
	            }
	        }
	    }
	}

	// Collect all answer IDs from all rules for the quiz
	$all_answer_ids = [];
	$rule_data_all = SQB_AdvancedRule::loadByQuizId($quiz_id);
	if (!empty($rule_data_all)) {
	    foreach ($rule_data_all as $rule_data) {
	        $conditions_data = $rule_data->getConditions();
	        if (!empty($conditions_data)) {
	            $uns_conditions = @unserialize($conditions_data);
	            if (is_array($uns_conditions)) {
	                foreach ($uns_conditions as $uns_condition) {
	                    if (!empty($uns_condition['answer']) && is_array($uns_condition['answer'])) {
	                        $all_answer_ids = array_merge($all_answer_ids, $uns_condition['answer']);
	                    }
	                }
	            }
	        }
	    }
	}

	// Calculate differences between current IDs and all answer IDs
	$output = array_merge(array_diff($current_ids, $all_answer_ids), array_diff($all_answer_ids, $current_ids));
	$difference = array_diff($new_answer_ids, $output);

	// Determine message based on comparison results
	if (count($difference) === 0) {
	    $message = "Exists";
	} else {
	    $message = "Not exists";
	}

	
	if($adv_rule_id){
		$ruledata_obj->setId($adv_rule_id);
		$id = $ruledata_obj->update();
	}else{
		if(($ruledata) && !empty($ruledata)){
			$ruledata_obj->setId($ruledata->getId());
			$id = $ruledata_obj->update();		 
		} else {	    
		   $id = $ruledata_obj->create();	   
	    }
	}
	
		 
	$rule_data_all = SQB_AdvancedRule::loadByQuizId($quiz_id);
	$rule_data_html ='';		
	if(($rule_data_all) && count($rule_data_all)){
		$i = 1;
		foreach($rule_data_all as $rule_data){
			$r_id = $rule_data->getId();
			$question_id = $rule_data->getQuestionId();
			if($question_id){
				$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
				if($sqbquestionobj){
					$question_title = $sqbquestionobj->getQuestionTitle();
					if (strlen($question_title) > 50){
						$question_title = substr($question_title, 0, 50) . '...';
					}
				}

				$answers_id = $rule_data->getAnswersId();
				if($answers_id){
					$answer_id_explode = explode(',', $answers_id);
					if(is_array($answer_id_explode)){
						$answer_title = "";
						$ans_counter = 0;
						foreach($answer_id_explode as $answerids){
							$sqbanswerobj = SQB_QuizAnswers::loadById($answerids);
							if($sqbanswerobj){
								$ans_counter++;
								$title = $sqbanswerobj->getAnswerTitle();
								$full_title = $sqbanswerobj->getAnswerTitle();
								if (strlen($title) > 30){
									$title = substr($title, 0, 30) . '...';
								}
								$answer_title .= '<p title="'.$full_title.'" class="mb-1">'.stripslashes($title).'</p>';
								
							}
						}
					}
				}
				
				$outcome_id = $rule_data->getOutcomeId();
				if($outcome_id){
					$outcome_names = SQB_Outcome::loadById($outcome_id);
					$outcome_name = '';
					$outcome_name_full = '';
					if($outcome_names){
						if (strlen($outcome_names->getOutcomeName()) <=15) {
						  $outcome_name = $outcome_names->getOutcomeName();
						  $outcome_name_full = $outcome_names->getOutcomeName();
						} else {
							$outcome_name = substr($outcome_names->getOutcomeName(), 0, 15) . '...';
							$outcome_name_full = $outcome_names->getOutcomeName();
						}
					}
				}
				$conditions = $rule_data->getConditions();
				$skip_optin = $rule_data->getSkipOptin();
				$skip_quiz = $rule_data->getSkipQuiz();
				$conditions_json = '{}';
				if(!empty($conditions)){
					$uns_conditions = unserialize($conditions);
					$conditions_json = json_encode($uns_conditions);
					
					$show_class = '';
					if($i == 1){
						$show_class = 'show';
					}
					$r_id = $rule_data->getId();
					$rule_data_html .='<div class="card"><div class="card-header" id="QA-accordion-'.$i.'"><div class="outcome-main"><h2>Rule #'.$i.' (ID: '.$r_id.')</h2><div class="QA-accordion-h-info-block"><div class="outcome-name"><strong>Show Outcome: </strong> </div><div class="quiz-outcome-title" title="'.stripslashes($outcome_name_full).'">'.stripslashes($outcome_name_full).'</div></div></div><div class="QA-accordion-header-right">
					
					<div class="QA-accordion-h-info-block"><div><div class="edit-advaced-rules-outer"><i data-id="'.$r_id.'" data-optin-id="'.$skip_optin.'" data-continue-quiz="'.$skip_quiz.'" data-outcome-id="'.$outcome_id.'" class="fas fa-edit sqb-edit-advanced"></i><span class="edit-btn">EDIT THIS RULE</span></div><i data-id="'.$r_id.'" class="fas fa-trash-alt sqb-delete-advanced"></i><script id="json-sqb-advance-id-'.$r_id.'" type="application/json">'.$conditions_json.'</script></div></div>
					<button class="QA-accordion-action collapsed" type="button" data-toggle="collapse" data-target="#qar_QA-collapseOne_'.$i.'" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-up" aria-hidden="false"></i></button>
					</div></div><div id="qar_QA-collapseOne_'.$i.'" class="collapse '.$show_class.' tr'.$r_id.'" data-id="ad_tr_'.$r_id.'" aria-labelledby="headingOne" data-parent="#QA-accordion">
					<div style="display:none;">'.$r_id.'</div>';
					$rule_data_html .= '<div class="question-ans-data-main"><div class="sqb-tabs-sub-heading"> <div class="sqb-tab-heading-question-title">Question</div> <div class="sqb-tab-heading-question-answer">If Answer Is...</div></div>';
					foreach($uns_conditions as $uns_condition){
						$question_id = $uns_condition['question'];
						$cond_op = $uns_condition['expression'];
						$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
						if($sqbquestionobj){
							$question_title = $sqbquestionobj->getQuestionTitle();
							$question_title_full = $sqbquestionobj->getQuestionTitle();
							if (strlen($question_title) > 50){
									$question_title = substr($question_title, 0, 50) . '...';
							}
						}
						$question_tab_url =  admin_url('admin.php?page=sqb_add_quiz')."&id=".$quiz_id."&question_tab=quiz-question-screen&quesId=".$question_id;
						
						$rule_data_html .= '<div class="question-answer-data"><div class="question-title-content"><p title="'.stripslashes($question_title_full).'"> <a target="_blank" href="'.$question_tab_url.'">'.stripslashes($question_title).'</a></p></div>';
						$rule_data_html .= '<div class="answer-data">';
						$answer_ids = !empty($uns_condition['answer']) ? $uns_condition['answer'] : array();
						if(!empty($answer_ids)){
							$ans_counter = 0;
							foreach($answer_ids as $answer_id){
								$ans_counter++;
								$sqbanswerobj = SQB_QuizAnswers::loadById($answer_id);
								if($sqbanswerobj){
									$title = $sqbanswerobj->getAnswerTitle();
									$full_title = $sqbanswerobj->getAnswerTitle();
									if (strlen($title) > 50){
										$title = substr($title, 0, 50) . '...';
									}
									$rule_data_html .= '<p title="'.stripslashes($full_title).'" class="mb-1">'.stripslashes($title).'</p>';
								}
							}
						}
						$rule_data_html .= '</div>';
						$rule_data_html .= '</div>';
					}
					$rule_data_html .= '<div class="advance-rule-options">Continue Quiz = '.$skip_quiz.', Skip Opt-in = '.$skip_optin.'</div></div>';
					$rule_data_html .='</div></div>';
				}else{

					if($answers_id){
						$answer_id_explode = explode(',', $answers_id);
						if(is_array($answer_id_explode)){
							$all_answer = [];
							foreach($answer_id_explode as $answerids){
								$all_answer[] = $answerids;
							}
						}
					}

					$conditions_json = '[{"question":"'.$question_id.'","answer":'.json_encode($all_answer).',"expression":"and"}]';
					$cond_op = 'and';
					$question_tab_url =  admin_url('admin.php?page=sqb_add_quiz')."&id=".$quiz_id."&question_tab=quiz-question-screen&quesId=".$question_id;		

					$rule_data_html .='<div class="card"><div class="card-header" id="QA-accordion-'.$i.'"><div class="outcome-main"><h2>Rule #'.$i.' (ID: '.$r_id.')</h2><div class="QA-accordion-h-info-block"><div class="outcome-name"><strong>Show Outcome: </strong> </div><div class="quiz-outcome-title" title="'.stripslashes($outcome_name_full).'">'.stripslashes($outcome_name_full).'</div></div></div><div class="QA-accordion-header-right">
					<div class="QA-accordion-h-info-block"><div><div class="edit-advaced-rules-outer"><i data-id="'.$r_id.'" data-optin-id="'.$skip_optin.'" data-outcome-id="'.$outcome_id.'" data-continue-quiz="'.$skip_quiz.'" class="fas fa-edit sqb-edit-advanced"></i><span class="edit-btn">EDIT THIS RULE</span></div><i data-id="'.$r_id.'" class="fas fa-trash-alt sqb-delete-advanced"></i><script id="json-sqb-advance-id-'.$r_id.'" type="application/json">'.$conditions_json.'</script></div></div>
					<button class="QA-accordion-action collapsed" type="button" data-toggle="collapse" data-target="#qar_QA-collapseOne_'.$i.'" aria-expanded="true" aria-controls="collapseOne"><i class="fa fa-angle-up" aria-hidden="false"></i></button>
					</div></div><div id="qar_QA-collapseOne_'.$i.'" class="collapse tr'.$r_id.'" data-id="ad_tr_'.$r_id.'" aria-labelledby="headingOne" data-parent="#QA-accordion">
					<div style="display:none;">'.$r_id.'</div>';
					$rule_data_html .= '<div class="question-ans-data-main"><div class="sqb-tabs-sub-heading"> <div class="sqb-tab-heading-question-title">Question</div> <div class="sqb-tab-heading-question-answer">If Answer Is...</div></div>';
					$rule_data_html .= '<div class="question-answer-data"><div class="question-title-content"><p title="'.stripslashes($question_title_full).'"> <a target="_blank" href="'.$question_tab_url.'">'.stripslashes($question_title).'</a></p></div>';
						$rule_data_html .= '<div class="answer-data">';

					$rule_data_html .= $answer_title;
					$rule_data_html .= '</div>';
					$rule_data_html .= '</div>';
					$rule_data_html .= '<div class="advance-rule-options">Continue Quiz = '.$skip_quiz.', Skip Opt-in = '.$skip_optin.'</div></div>';
					$rule_data_html .='</div></div>';
					
				}
			}
			$i++;
		}
	}else{
		$rule_data_html ='<tr><td colspan="5">No data Found</td></tr>	';
	}
	echo json_encode(array('rule_data_html'=>$rule_data_html, 'msg'=> 'Success'));die;	
}

add_action('wp_ajax_sqbSaveCategoryAdvancedRule', 'sqbSaveCategoryAdvancedRule');
function sqbSaveCategoryAdvancedRule(){
	/*if ( !current_user_can( 'manage_options' ) ) {
	    return json_encode(array('error' => 'Not allowed to access'));die;  
	}
	check_admin_referer('sqbSaveCategoryAdvancedRule', 'security');*/
	$category_id = $_POST['category_id'];
	$quiz_id = $_POST['quiz_id'];
	$start_range = $_POST['start_range']; 
	$end_range = $_POST['end_range']; 
	$category_description = $_POST['cat_description']; 
	$action_val = $_POST['action_val']; 
	$advance_edit_id = $_POST['advance_edit_id']; 

	if($action_val == 'delete'){
		$id = $_POST['id']; 	
		SQB_AdvancedCategoryRule::deleteById($id);	
		$rule_data__category_all = SQB_AdvancedCategoryRule::loadByQuizId($quiz_id);	
		$cat_rule_data_html ='';		
		if(($rule_data__category_all) && count($rule_data__category_all)){
			foreach($rule_data__category_all as $rule_data){
				$category_id = $rule_data->getCategoryId();
				$cat_name = SQB_QuizCategory::loadById($category_id);

				if(isset($cat_name)){
					if($category_id){
						$r_id = $rule_data->getId();
						$start_range = $rule_data->getStartRange();
						$end_range = $rule_data->getEndRange();
						
						if (strlen($cat_name->getName()) <=15) {
						  	$category_name = $cat_name->getName();
						 	$category_name_full = $cat_name->getName();
						} else {
						 	$category_name = substr($cat_name->getName(), 0, 15) . '...';
						 	 $category_name_full = $cat_name->getName();
						}

						$cat_rule_data_html .= '<li class="addtoeditor"><span class="cat_add_merge_tag_el" data-copyel="cat_add_merge_tag_'.$category_id.'_'.$r_id.'"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i> </span><span id="cat_add_merge_tag_'.$category_id.'_'.$r_id.'">[ShowCategoryScore name="'.$category_name_full.'" range="'.$start_range.','.$end_range.'" id="'.$r_id.'"] </span><a  href="javascript:void(0)" class="cat_add_merge_tag_el" data-copyel="cat_add_merge_tag_'.$category_id.'_'.$r_id.'">Copy</a></li>';
					}
				}				
			}
		}
		echo json_encode(array('cat_rule_data_html' => $cat_rule_data_html, 'msg'=>'Deleted'));die;
	}

	if(empty($advance_edit_id)){
		if($start_range != '' && $end_range != ''){
			$range_exists = SQB_AdvancedCategoryRule::isRangeExists($category_id,$quiz_id,$start_range,$end_range);
			if($range_exists){
				$output['error'] = 'Range already exists';
				echo json_encode($output);die;	
			}
		}
	}
	
	$ruledata_obj = new SQB_AdvancedCategoryRule();
	$ruledata_obj->setCategoryId($category_id);
	$ruledata_obj->setQuizId($quiz_id);
	$ruledata_obj->setStartRange($start_range);
	$ruledata_obj->setEndRange($end_range);
	$ruledata_obj->setCategoryDescription($category_description);
		
	if(!empty($advance_edit_id)){
		$ruledata_obj->setId($advance_edit_id);
		$id = $ruledata_obj->update();		 
	} else {	    
	   $id = $ruledata_obj->create();	   
    }

	$rule_data__category_all = SQB_AdvancedCategoryRule::loadByQuizId($quiz_id);
	$rule_data_html ='';		
	$cat_rule_data_html ='';		
	if(($rule_data__category_all) && count($rule_data__category_all)){
		foreach($rule_data__category_all as $rule_data){
			$category_id = $rule_data->getCategoryId();
			$cat_name = SQB_QuizCategory::loadById($category_id);

			if(isset($cat_name)){
			    if($category_id){
			        $r_id = $rule_data->getId();
			        $start_range = $rule_data->getStartRange();
			        $end_range = $rule_data->getEndRange();
			        
			        $cat_description_full = $rule_data->getCategoryDescription();
			        $cat_description_strip_tags = strip_tags($cat_description_full);    
			        $cat_description_full_strip = $cat_description_strip_tags;
			        
			        if (mb_strlen($cat_description_strip_tags, 'UTF-8') <= 100) {
			            $cat_description = $cat_description_strip_tags;
			        } else {
			            $cat_description = mb_substr($cat_description_strip_tags, 0, 100, 'UTF-8') . '...';
			        }
			        
			        $category_name_full = $cat_name->getName();
			        if (mb_strlen($category_name_full, 'UTF-8') <= 15) {
			            $category_name = $category_name_full;
			        } else {
			            $category_name = mb_substr($category_name_full, 0, 15, 'UTF-8') . '...';
			        }
			        
			        $rule_data_html .= '<tr class="tr'.htmlspecialchars($r_id).'" data-id="ad_tr_'.htmlspecialchars($r_id).'">
			            <td title="'.htmlspecialchars($category_name_full).'" data-name="'.htmlspecialchars($cat_name->getName()).'">'.htmlspecialchars($category_name).'</td>
			            <td>'.htmlspecialchars($start_range).' to '.htmlspecialchars($end_range).'</td>
			            <td title="'.htmlspecialchars($cat_description_full_strip).'">'.htmlspecialchars($cat_description).'</td>
			            <td><span id="dynamic_copyable_text_sqb_'.htmlspecialchars($r_id).'">[ShowCategoryScore name="'.htmlspecialchars($category_name_full).'" range="'.htmlspecialchars($start_range).','.htmlspecialchars($end_range).'" id="'.htmlspecialchars($r_id).'"]</span> <span data-id="dynamic_copyable_text_sqb_'.htmlspecialchars($r_id).'" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span></td>             
			            <td><div class="category_description" style="display:none;">'.htmlspecialchars($cat_description_full).'</div><i data-id="'.htmlspecialchars($r_id).'" data-category-id="'.htmlspecialchars($category_id).'"  data-start_range="'.htmlspecialchars($start_range).'" data-end_range="'.htmlspecialchars($end_range).'" class="fas fa-edit sqb-category-edit-advanced-rule"></i><i data-id="'.htmlspecialchars($r_id).'" class="fas fa-trash-alt sqb-delete-advanced-rule"></i></td>
			        </tr>';
			        
			        $cat_rule_data_html .= '<li class="addtoeditor"><span class="cat_add_merge_tag_el" data-copyel="cat_add_merge_tag_'.htmlspecialchars($category_id).'_'.htmlspecialchars($r_id).'"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i> </span><span id="cat_add_merge_tag_'.htmlspecialchars($category_id).'_'.htmlspecialchars($r_id).'">[ShowCategoryScore name="'.htmlspecialchars($category_name_full).'" range="'.htmlspecialchars($start_range).','.htmlspecialchars($end_range).'" id="'.htmlspecialchars($r_id).'"] </span><a class="cat_add_merge_tag_el" href="javascript:void(0)" data-copyel="cat_add_merge_tag_'.htmlspecialchars($category_id).'_'.htmlspecialchars($r_id).'">Copy</a></li>';
			    }
			}			
		}
	}else{
		$rule_data_html ='<tr><td colspan="5">No data Found</td></tr>	';
	}
	echo json_encode(array('rule_data_html'=>$rule_data_html,'cat_rule_data_html' => $cat_rule_data_html, 'msg'=>'success'));die;	
	
}

add_action('wp_ajax_sqbLoadOutcomeRank', 'sqbLoadOutcomeRank');
function sqbLoadOutcomeRank(){
	$outcome_id = $_POST['outcome_id'];
	$quiz_id = $_POST['quiz_id'];
	$outcome_rank_data_html ='';		

	if(!empty($quiz_id) && !empty($outcome_id)){
		$rule_data_outcome_quiz = SQB_QuizOutcomeDescription::loadByOutcomeidAndQuizId($outcome_id,$quiz_id);
		if($rule_data_outcome_quiz){
			$outcome_rank_data_html = $rule_data_outcome_quiz->getDescription();
			$msg = "Success";
		}else{
			$msg = "No Data";
		}
	}else{
			$msg = "Not Found";
	}
	echo json_encode(array('outcome_rank_data_html' => $outcome_rank_data_html, 'msg'=>'Success'));die;
}


add_action('wp_ajax_sqbSaveOutcomeRank', 'sqbSaveOutcomeRank');
function sqbSaveOutcomeRank(){
	
	$outcome_id = $_POST['outcome_id'];
	$quiz_id = $_POST['quiz_id'];
	$outcome_description = $_POST['outcome_description']; 	
	
	$ruledata_obj = new SQB_QuizOutcomeDescription();
	$ruledata_obj->setOutcomeId($outcome_id);
	$ruledata_obj->setQuizId($quiz_id);
	$ruledata_obj->setDescription($outcome_description);
		
	$check_existing = SQB_QuizOutcomeDescription::loadByOutcomeidAndQuizId($outcome_id, $quiz_id);
	if($check_existing){
		$ruledata_obj->setId($check_existing->getid());
		$id = $ruledata_obj->update();	
	}else {	    
	   $id = $ruledata_obj->create();	   
    }
	$rule_data_outcome_all = SQB_QuizOutcomeDescription::loadByQuizId($quiz_id);
	$rule_data_html ='';		
	$outcome_rank_data_html ='';		
	if(($rule_data_outcome_all) && count($rule_data_outcome_all)){
		foreach($rule_data_outcome_all as $rule_data){
			$outcome_id = $rule_data->getOutcomeId();
			$outcome_name = SQB_Outcome::loadById($outcome_id);

			if(!empty($outcome_name)){
				if($outcome_id){
					$r_id = $rule_data->getId();
					
					$outcome_description_strip_tags = strip_tags($rule_data->getDescription());	
				 	$outcome_description_full = $rule_data->getDescription();
				 	$outcome_description_full_stripslashes = stripslashes($rule_data->getDescription());

					if (strlen($outcome_description_strip_tags) <=100) {
					  	$outcome_description = $outcome_description_strip_tags;
					} else {
					 	$outcome_description = substr($outcome_description_strip_tags, 0, 100) . '...';
					}
					
					if (strlen($outcome_name->getOutcomeName()) <=15) {
					  	$outcome_name = $outcome_name->getOutcomeName();
					} else {
					 	$outcome_name = substr($outcome_name->getOutcomeName(), 0, 15) . '...';
					}
					
				}
			}				
		}
		$msg = "Success";
	}else{
		$msg ='Error';
	}
	echo json_encode(array('msg'=>$msg));die;	
	
}

add_action('wp_ajax_sqbSaveCategoryAdvanced', 'sqbSaveCategoryAdvanced');
function sqbSaveCategoryAdvanced(){
	 if ( !current_user_can( 'manage_options' ) ) {
	    return json_encode(array('error' => 'Not allowed to access'));die;  
	}
	check_admin_referer('sqbSaveCategoryAdvanced', 'security');
	$enabled_advanced_category = $_POST['enabled_advanced_category'];
	$quiz_id = $_POST['quiz_id'];
	$e_outcome_id = $_POST['outcome_id']; 
	$e_category_id = !empty($_POST['category_id']) ? $_POST['category_id'] : ''; 
	$action_val = $_POST['action_val']; 
	//$all_total_val = $_POST['all_total_val']; 
	$advance_edit_id = !empty($_POST['advance_edit_id']) ? $_POST['advance_edit_id'] : ''; 

	$start_range = @$_POST['start_range'];
	$end_range = @$_POST['end_range'];

	if($action_val == "enabled_advanced_category_sett"){	
		$all_data = SQB_AdvancedRule::loadByQuizId($quiz_id);
		foreach($all_data as $data){
			$category_id = $data->getCategoryId();
			if($category_id){
				$obj = new SQB_AdvancedRule();
				$obj->setId($data->getId());
				$obj->setQuizId($data->getQuizId());
				$obj->setCategoryId($data->getCategoryId());
				$obj->setOutcomeId($data->getOutcomeId());
				$obj->setCategoryTotal($data->getCategoryTotal());
				$obj->setEnabledAdvanced($enabled_advanced_category);
				$obj->update();	
			}
		}
		die;
	}
	 
	if($action_val =="delete"){	
		$id = $_POST['id']; 	
		SQB_AdvancedRule::deleteById($id);		 
		die;
	}	 
	  
	$date = date('Y-m-d H:i:s');   
	$ruledata_obj = new SQB_AdvancedRule();
	$ruledata_obj->setQuizId($quiz_id);
	$ruledata_obj->setCategoryId($e_category_id);
	$ruledata_obj->setStartRange($start_range);
	$ruledata_obj->setEndRange($end_range);
	$ruledata_obj->setOutcomeId($e_outcome_id);
	$ruledata_obj->setEnabledAdvanced($enabled_advanced_category);
	//$ruledata_obj->setCategoryTotal($all_total_val);
	$ruledata_obj->setDate($date);
	
	if(empty($advance_edit_id)){

		$rulesdata = SQB_AdvancedRule::loadByCategoryidAndQuizId($e_category_id,$quiz_id);
		if($rulesdata){
			$output['error'] = 'Already Exist';
			echo json_encode($output);die;	
		}

		if($start_range != '' && $end_range != ''){

			$range_exists = SQB_AdvancedRule::isRangeExists($e_category_id,$quiz_id,$start_range,$end_range);
			if($range_exists){
				$output['error'] = 'Range already exists';
				echo json_encode($output);die;	
			}
		}
	}

	if(($advance_edit_id) && count($advance_edit_id)){
		$ruledata_obj->setId($advance_edit_id);
		$id = $ruledata_obj->update();		 
	} else {	    
	   $id = $ruledata_obj->create();	   
    }
		 
	$rule_data_all = SQB_AdvancedRule::loadByQuizId($quiz_id);
	$rule_data_html ='';		
	if(is_array($rule_data_all) && count($rule_data_all)){
		foreach($rule_data_all as $rule_data){
			$r_id = $rule_data->getId();
			$category_id = $rule_data->getCategoryId();
			$outcome_id = $rule_data->getOutcomeId();


			if($category_id){
				$category_total = $rule_data->getCategoryTotal();
				$cat_explode = explode('|', $category_total);
				$outcome_id = $rule_data->getOutcomeId();

				$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
				if(isset($outcome_obj) && !empty($outcome_obj)) {
					$i = 1;
					$all_outcome = array();
					foreach($outcome_obj as $outcome_detail){
						$outcome_id = $outcome_detail->getid();
						$all_outcome['OUTCOME '.$i] = $outcome_id; 
						$i++;
					}
				} 
				$cat_name = SQB_QuizCategory::loadById($category_id);
				$get_outcome_id = $rule_data->getOutcomeId();

				$outcome_names = SQB_Outcome::loadById($get_outcome_id);

				if (strlen($outcome_names->getOutcomeName()) <=15) {
				  	$outcome_name = $outcome_names->getOutcomeName();
				  	$outcome_name_full = $outcome_names->getOutcomeName();
				} else {
				 	$outcome_name = substr($outcome_names->getOutcomeName(), 0, 15) . '...';
				  	$outcome_name_full = $outcome_names->getOutcomeName();
				}

				$get_outcome_name = array_search($get_outcome_id, $all_outcome);

				if (strlen($cat_name->getName()) <=15) {
				  	$category_name = $cat_name->getName();
				  	$category_name_full = $cat_name->getName();
				} else {
				 	$category_name = substr($cat_name->getName(), 0, 15) . '...';
				 	$category_name_full = $cat_name->getName();
				}

				$start_range = $rule_data->getStartRange();
				$end_range = $rule_data->getEndRange();

				$rule_data_html .='<tr class="tr'.$r_id.'" data-id="ad_tr_'.$r_id.'" >
					<td>'.$r_id.'</td>
					<td title="'.$category_name_full.'">'.$category_name.'</td>
					<td title="'.$start_range.'" data-start_range="'.$start_range.'" class="cat-range-cell">'.$start_range.'</td>
					<td title="'.$end_range.'" data-end_range="'.$end_range.'" class="cat-range-cell">'.$end_range.'</td>		 
					<td title="'.$outcome_name_full.'">'.$outcome_name.'</td>
					<td><i data-id="'.$r_id.'" data-outcome-id="'.$outcome_id.'" data-category-id="'.$category_id.'" data-totaleval="'.@$cat_explode[0].'" data-totalval="'.@$cat_explode[1].'" data-start_range="'.$start_range.'" data-end_range="'.$end_range.'" class="fas fa-edit sqb-category-edit-advanced"></i><i data-id="'.$r_id.'" class="fas fa-trash-alt sqb-delete-advanced"></i></td>
				</tr>';
			}
		}
		$categoriesObj = SQB_QuizCategory::load();
		$ids = [];
		$all_category_id = [];
		foreach($categoriesObj as $categoryObj){
			if($categoryObj->getStatus() == 'Y'){
				$ids[] = $categoryObj->getId();
			}
		}
		
		if(($rule_data_all) && count($rule_data_all)){
				foreach($rule_data_all as $rule_data){
					$category_id = $rule_data->getCategoryId();
					if($category_id){
						$all_category_id[] = $category_id;
					}
				}
			}

		$remaning_ids = array_diff($ids, $all_category_id);
		$remaining_category = '';
		if($remaning_ids){
			foreach($remaning_ids as $remaning_id){
				$cat_name = SQB_QuizCategory::loadById($remaning_id);
				$category_name = $cat_name->getName();
				$remaining_category .=  '<li>'.$category_name.'</li>';
			}
		}else{
			$remaining_category = '';
		}
		
	}else{
		$rule_data_html ='<tr><td colspan="5">No data Found</td></tr>	';
	}
	echo json_encode(array('rule_data_html'=>$rule_data_html, 'remaining_category'=>$remaining_category, 'msg'=>'success'));die;	
}



add_action('wp_ajax_sqb_save_formula', 'SqbSaveFormula');
add_action('wp_ajax_nopriv_sqb_save_formula', 'SqbSaveFormula');

function SqbSaveFormula($form_data = ''){
	$output = array();
	if($form_data !="" && is_array($form_data)){
		$_POST = $form_data;
	}
	
	if(isset($_POST['formula_data'])){//pre-built script
		$formulasData = $_POST['formula_data'];
		$formula_ids = array();
		foreach($formulasData as $data){
			$name = $data['formula_title'];
			$customizer_data = $data['formula_customizer'];
			$formula_html = $data['formula_html'];
			$quiz_id = $data['quiz_id'];
			$date = $data['date'];
			$calculatorformula_obj = new SQB_CalculatorFormula();
			$calculatorformula_obj->setName($name);
			$calculatorformula_obj->setQuizId($quiz_id);
			$calculatorformula_obj->setHtml($formula_html);
			$calculatorformula_obj->setCustomzierData($customizer_data);
			$calculatorformula_obj->setDate($date);
			$output['create_formula'] = "create";
			$calculator_formula_id = $calculatorformula_obj->create();
			$formula_ids[] = $calculator_formula_id;
		}
		$output['formula_id'] = $formula_ids;
	} else if(isset($_POST['quiz_id'])){
		$date = date('Y-m-d H:i:s');
		$quiz_id = $_POST['quiz_id'];		
		$formula_html = $_POST['formula_text'];
		$formula_id = $_POST['formula_id'];
		if($formula_id == ''){
		$formula_id = null;
		}
		$name = $_POST['formula_title'];
		if($name == ''){
			$name = "FORMULA";
		}
		$customizer_data = json_encode($_POST['customizer_data']);
		$calculatorformula_obj = new SQB_CalculatorFormula();
		$calculatorformula_obj->setName($name);
		$calculatorformula_obj->setQuizId($quiz_id);
		$calculatorformula_obj->setHtml($formula_html);
		$calculatorformula_obj->setCustomzierData($customizer_data);
		$calculatorformula_obj->setDate($date);
		if(is_numeric($quiz_id)){
		$calculator_exists = SQB_CalculatorFormula::loadByQuizIdAndFormulaId($quiz_id,$formula_id);
		}
		
		if(isset($calculator_exists)){
			$calculatorformula_obj->setId($formula_id);
			$calculator_formula_id = $calculatorformula_obj->update();
			$output['update_formula'] = "update";
		} else {
		   $output['create_formula'] = "create";
		   $calculator_formula_id = $calculatorformula_obj->create();
		   if($calculator_formula_id == 'error' || $calculator_formula_id == ''){
				$output['error'] = 'Sorry there was an issue with save';
		   }
		}
							
		$output['formula_list'] = sqb_get_formula_list($quiz_id);
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
		
	if($form_data !="" && is_array($form_data)){
		return $output;
		die;
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_get_formula_list', 'SqbGetFormulaList');
add_action('wp_ajax_nopriv_get_formula_list', 'SqbGetFormulaList');

function SqbGetFormulaList(){
	$output = array();
	if(isset($_POST['quiz_id'])){
	$quiz_id = $_POST['quiz_id'];
	$output['formula_list'] = sqb_get_formula_list($quiz_id);
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_delete_formula', 'SqbDeleteFormula');
add_action('wp_ajax_nopriv_sqb_delete_formula', 'SqbDeleteFormula');

function SqbDeleteFormula(){
	$output = array();
	if(isset($_POST['formula_id'])){
	$id = $_POST['formula_id'];
	$quiz_id = $_POST['quiz_id'];
	SQB_CalculatorFormula::deleteById($id);
	$output['formula_list'] = sqb_get_formula_list($quiz_id);
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_list_formula', 'SqbListFormula');
add_action('wp_ajax_nopriv_sqb_list_formula', 'SqbListFormula');

function SqbListFormula(){
	$output = array();
	if(isset($_POST['quiz_id'])){
	$quiz_id = $_POST['quiz_id'];
	$output['formula_list'] = sqb_get_formula_list_dropdown($quiz_id);
	}
	echo json_encode($output);die;
}

function sqb_get_formula_list_dropdown($quiz_id){
	$formula_list_html = '';
	
	$calculator_formulas_obj = SQB_CalculatorFormula::loadByQuizId($quiz_id);
	if(isset($calculator_formulas_obj) && !empty($calculator_formulas_obj)) {
		$formula_list_html .= '<p class="formula-list-text ">Copy/paste the formula you want in the outcome title or description.</p>
							<div class="outcome-screen-formula-list"><table class="table table-striped">
								<thead>
							  <tr>
								<th>Formula Title</th>
								<th>Formula</th>
								<th>Shortcode</th>
								<th class="text-center">Outcome Mapping</th>
								<th width="300px" class="text-center">Action</th>
							  </tr>
							</thead>
							<tbody>';
		$i=1;
		foreach($calculator_formulas_obj as $calculator_formulas){
			$formula_id = $calculator_formulas->id;
			if($calculator_formulas->name == 'FORMULA'){
				$formula_title = $calculator_formulas->name.' '.$i;
			}else{
				$formula_title = $calculator_formulas->name;
			}
			$formula_name = $calculator_formulas->html;
			$formula_prefix = '';
			$formula_suffix = '';
			
			if($calculator_formulas->customizer_data != ''){
				$formula_prefix_suffix = json_decode($calculator_formulas->customizer_data);	
				$formula_prefix = $formula_prefix_suffix->prefix;
				if($formula_prefix == ''){
				$formula_prefix = '';
				}
				$formula_suffix = $formula_prefix_suffix->sufix;
				if($formula_suffix == ''){
				$formula_suffix = '';
				}
			}
			
			$formula_list_html .= '<tr data-row-count="'.$i.'" data-formulaid='.$formula_id.'>
									<td class="data-formula-title-'.$formula_id.'">'.$formula_title.'</td>
									<td class="data-formula-name-'.$formula_id.'" >'.stripslashes(htmlspecialchars($formula_name)).'</td>
									<td class="data-formula-shortcode-'.$formula_id.'" >[FORMULA id='.$formula_id.']</td>
									<td class="text-center"><a href="javascript:void(0)" class="edit-formula-outcome" data-id="'.$formula_id.'">Add/Edit</a></td>
									<td class="text-center">
									<span title="Copy Shortcode" class="ManageQuiz-action-btn item-clone-btn sqb-copy-formula-shortcode" data-id="'.$formula_id.'" data-value="[FORMULA id='.$formula_id.']"><i class="fa fa-clipboard" aria-hidden="true" ></i> Copy</span>
									<span title="Edit Formula" class="ManageQuiz-action-btn item-edit-btn sqb-edit-formula" data-id="'.$formula_id.'"  data-prefix="'.$formula_prefix.'" data-sufix="'.$formula_suffix.'" data-name="'.stripslashes(htmlspecialchars($formula_name)).'"><i class="fas fa-edit"></i> Edit</span>
									</td>
								  </tr>';
			$i++;
		}
		$formula_list_html .= '</tbody></table><div>';
	}		  
	return $formula_list_html;
}

function sqb_get_formula_list($quiz_id){
		$formula_list_html = '';
		$formula_list_html .= '<table class="table table-striped">
								<thead>
							  <tr>
								<th>Title</th>
								<th>Formula</th>
								<th width="100px">Prefix</th>
								<th width="100px">Suffix</th>
								<th width="100px">Action</th>
							  </tr>
							</thead>
							<tbody>';
							
		$calculator_formulas_obj = SQB_CalculatorFormula::loadByQuizId($quiz_id);
		if(isset($calculator_formulas_obj) && !empty($calculator_formulas_obj)) {
			$i = 1;
			foreach($calculator_formulas_obj as $calculator_formulas){
				$formula_id = $calculator_formulas->id;
				$formula_name = $calculator_formulas->html;
				if($calculator_formulas->name == 'FORMULA'){
					$formula_title = $calculator_formulas->name.' '.$i;
				}else{
					$formula_title = $calculator_formulas->name;
				}
				$formula_prefix = 'NA';
				$formula_suffix = 'NA';
				
				if($calculator_formulas->customizer_data != ''){
					$formula_prefix_suffix = json_decode($calculator_formulas->customizer_data);	
					$formula_prefix = $formula_prefix_suffix->prefix;
					if($formula_prefix == ''){
					$formula_prefix = 'NA';
					}
					$formula_suffix = $formula_prefix_suffix->sufix;
					if($formula_suffix == ''){
					$formula_suffix = 'NA';
					}
				}
				
				$formula_list_html .= '<tr data-row-count="'.$i.'" data-formulaid='.$formula_id.'>
									<td class="data-formula-title-'.$formula_id.'">'.$formula_title.'</td>
									<td class="data-formula-name-'.$formula_id.'">'.stripslashes(htmlspecialchars($formula_name)).'</td>
									<td class="data-formula-prefix-'.$formula_id.'">'.$formula_prefix.'</td>
									<td class="data-formula-sufix-'.$formula_id.'">'.$formula_suffix.'</td>
									<td><div class="" style="width: 55px;"><i data-id="'.$formula_id.'" class="fas fa-edit sqb-edit-formula sqb-edit-formula-list"></i><i data-id="'.$formula_id.'" class="fas fa-trash-alt sqb-delete-formula" style="color:red;margin-left:20px;"></i><div></td>
								  </tr>';
								  $i++;
			}
		} else {
			$formula_list_html .= '<tr><td colspan="5" align="center">No Records Found</td></tr>';
		}		  
		$formula_list_html .= '</tbody></table>';
		return $formula_list_html;
}

add_action('wp_ajax_sqb_quiz_check_file_upload_server_config', 'SQBCheckFileUploadServerConfigAjax');
add_action('wp_ajax_nopriv_sqb_quiz_check_file_upload_server_config', 'SQBCheckFileUploadServerConfigAjax');
function SQBCheckFileUploadServerConfigAjax(){
	$output = array();
	if (function_exists('finfo_open')) {
		$output['status'] = true;
	} else {
		$output['status'] = false;
	}
	echo json_encode($output);
	die;
}




add_action('wp_ajax_sqb_preview_quiz', 'sqb_preview_quiz');

function sqb_preview_quiz(){
	$quiz_id = $_POST['quiz_id'];
	if($quiz_id >0 ){
		
		$random_var =  'quiz_id_'.$quiz_id.rand(10,1000);
		$output = '<iframe style="width: 100%; height:620px" src="'.get_site_url().'?quiz_id='.$quiz_id.'&SQBPreview=Y&'.$random_var.'" frameborder="0" scrolling="auto"></iframe>';
		echo json_encode($output);
		
		
	}
	die;
}

add_action( 'wp_ajax_sqb_wp_syncing_save', 'sqb_wp_syncing_save' );
function sqb_wp_syncing_save(){
	$sqb_wp_syncing = $_POST['sqb_wp_syncing'];	 
	if($sqb_wp_syncing=="Y"){
		update_option( 'sqb_wp_syncing', "Y" );
	}else{
		update_option( 'sqb_wp_syncing', "N");
	}
	die();
}

add_action( 'wp_ajax_google_font_option_save', 'google_font_option_save' );
function google_font_option_save(){
	$sqb_google_font_option = $_POST['sqb_google_font_option'];	 
	if($sqb_google_font_option=="Y"){
		update_option( 'sqb_google_font_option', "Y" );
	}else{
		update_option( 'sqb_google_font_option', "N");
	}
	die();
}

add_action( 'wp_ajax_sqb_optimized_js_css_option_save', 'sqb_optimized_js_css_option_save' );
function sqb_optimized_js_css_option_save(){
	$sqb_optimized_js_css = $_POST['sqb_optimized_js_css'];	 
	if($sqb_optimized_js_css=="Y"){
		update_option( 'sqb_newflow', "Y" );
	}else{
		update_option( 'sqb_newflow', "N");
	}
	die();
}

add_action( 'wp_ajax_sqb_wp_sqb_rtl_save', 'sqb_wp_sqb_rtl_save' );
function sqb_wp_sqb_rtl_save(){
	$sqb_rtl_mode = $_POST['sqb_rtl_mode'];	 
	if($sqb_rtl_mode=="Y"){
		update_option( 'sqb_rtl_mode', "Y" );
	}else{
		update_option( 'sqb_rtl_mode', "N");
	}
	die();
}

add_action( 'wp_ajax_sqb_exit_popup_timer_save', 'sqb_exit_popup_timer_save' );
function sqb_exit_popup_timer_save(){
	$exit_popup_val = $_POST['exit_popup_val'];	 
	if($exit_popup_val){
		$key = 'exit_popup_timer';
		sqbSetValidSettings($key, $exit_popup_val);
	}
	die();
}

add_action( 'wp_ajax_sqb_pdf_settings_save', 'sqb_pdf_settings_save' );
function sqb_pdf_settings_save(){
	$pdf_global_font = $_POST['pdf_global_font'];	 
	$header_background_color = $_POST['header_background_color'];	 
	$footer_background_color = $_POST['footer_background_color'];	 
	$footer_copyright_content = $_POST['footer_copyright_content'];	 
	$header_title = $_POST['header_title'];	 
	$add_pdf_icon = $_POST['add_pdf_icon'];	 
	$first_page_image = $_POST['first_page_image'];	 
	$last_page_image = $_POST['last_page_image'];	 
	$upload_first_image_option = $_POST['upload_first_image_option'];	 
	$pdf_display_option = !empty($_POST['pdf_display_option']) ? $_POST['pdf_display_option'] : '';
	$firstpage_width = $_POST['firstpage_width'];
	$first_page_align = $_POST['first_page_align'];
	$first_page_horizontal = $_POST['first_page_horizontal'];
	$lastpage_width = $_POST['lastpage_width'];
	$last_page_align = $_POST['last_page_align'];
	$last_page_horizontal = $_POST['last_page_horizontal'];

	if($header_background_color){
		$key = 'pdf_header_background_color';
		sqbSetValidSettings($key, $header_background_color);
	}else{
		$key = 'pdf_header_background_color';
		sqbDeleteValidSettingsByKey($key);
	}

	if($footer_background_color){
		$key = 'pdf_footer_background_color';
		sqbSetValidSettings($key, $footer_background_color);
	}else{
		$key = 'pdf_footer_background_color';
		sqbDeleteValidSettingsByKey($key);
	}
	if($pdf_global_font){
		$key = 'pdf_global_font';
		sqbSetValidSettings($key, $pdf_global_font);
	}else{
		$key = 'pdf_global_font';
		sqbDeleteValidSettingsByKey($key);
	}

	if($footer_copyright_content){
		$key = 'pdf_footer_copyright_content';
		sqbSetValidSettings($key, $footer_copyright_content);
	}else{
		$key = 'pdf_footer_copyright_content';
		sqbDeleteValidSettingsByKey($key);
	}
	
	if($header_title){
		$key = 'pdf_header_title';
		sqbSetValidSettings($key, $header_title);
	}else{
		$key = 'pdf_header_title';
		sqbDeleteValidSettingsByKey($key);
	}
	if($add_pdf_icon){
		$key = 'add_pdf_icon';
		sqbSetValidSettings($key, $add_pdf_icon);
	}else{
		$key = 'add_pdf_icon';
		sqbDeleteValidSettingsByKey($key);
	}
	if($first_page_image){
		$key = 'first_page_image';
		sqbSetValidSettings($key, $first_page_image);
	}else{
		$key = 'first_page_image';
		sqbDeleteValidSettingsByKey($key);
	}
	if($last_page_image){
		$key = 'last_page_image';
		sqbSetValidSettings($key, $last_page_image);
	}else{
		$key = 'last_page_image';
		sqbDeleteValidSettingsByKey($key);
	}
	if($upload_first_image_option){
		$key = 'upload_first_image_option';
		sqbSetValidSettings($key, $upload_first_image_option);
	}else{
		$key = 'upload_first_image_option';
		sqbDeleteValidSettingsByKey($key);
	}
	if($pdf_display_option){
		$key = 'pdf_display_option';
		sqbSetValidSettings($key, $pdf_display_option);
	}else{
		$key = 'pdf_display_option';
		sqbDeleteValidSettingsByKey($key);
	}

	if($firstpage_width){
		$key = 'firstpage_width';
		sqbSetValidSettings($key, $firstpage_width);
	}else{
		$key = 'firstpage_width';
		sqbDeleteValidSettingsByKey($key);
	}
	if($first_page_align){
		$key = 'first_page_align';
		sqbSetValidSettings($key, $first_page_align);
	}else{
		$key = 'first_page_align';
		sqbDeleteValidSettingsByKey($key);
	}
	if($first_page_horizontal){
		$key = 'first_page_horizontal';
		sqbSetValidSettings($key, $first_page_horizontal);
	}else{
		$key = 'first_page_horizontal';
		sqbDeleteValidSettingsByKey($key);
	}
	if($lastpage_width){
		$key = 'lastpage_width';
		sqbSetValidSettings($key, $lastpage_width);
	}else{
		$key = 'lastpage_width';
		sqbDeleteValidSettingsByKey($key);
	}
	if($last_page_align){
		$key = 'last_page_align';
		sqbSetValidSettings($key, $last_page_align);
	}else{
		$key = 'last_page_align';
		sqbDeleteValidSettingsByKey($key);
	}
	if($last_page_horizontal){
		$key = 'last_page_horizontal';
		sqbSetValidSettings($key, $last_page_horizontal);
	}else{
		$key = 'last_page_horizontal';
		sqbDeleteValidSettingsByKey($key);
	}
	die();
}


add_action('wp_ajax_sqb_save_custom_fields', 'SqbSaveCustomFields');
add_action('wp_ajax_nopriv_sqb_save_custom_fields', 'SqbSaveCustomFields');
function SqbSaveCustomFields(){
	$output = array();
	//if(isset($_POST['keyname']) && isset($_POST['description'])){
	if(isset($_POST['keyname'])){
		$date = date('Y-m-d H:i:s');	
		$keyname = $_POST['keyname'];
		$keylabel = !empty($_POST['keylabel']) ? $_POST['keylabel'] : '';
		$description = !empty($_POST['description']) ? $_POST['description'] : '';
		$field_type = $_POST['field_type'];
		$field_value = !empty($_POST['field_value']) ? $_POST['field_value'] : '';
		$showonlytoadmin = !empty($_POST['showonlytoadmin']) ? $_POST['showonlytoadmin'] : '';
		$dropdown_value = !empty($_POST['dropdown_value']) ? $_POST['dropdown_value'] : '';
		//$showonlytoadmin = $_POST['showonlytoadmin'];
		//$showonlytoadmin = $_POST['showonlytoadmin'];
		$required = $_POST['required'];
		$custom_field_id = $_POST['custom_field_id'];
		$cf_selected_country = $_POST['cf_selected_country'];
			
		if($field_type == 'dropdown'){
			$cf_selected_country = $dropdown_value;
		}
		

		if($custom_field_id == ''){
		$custom_field_id = null;
		}
		$customfields_obj = new SQB_CustomFields();
		$customfields_obj->setName(strtolower($keyname));
		$customfields_obj->setLabel($keylabel);
		$customfields_obj->setDescription($description);
		$customfields_obj->setFieldType($field_type);
		$customfields_obj->setFieldValue($field_value);
		$customfields_obj->setShowonlytoadmin($showonlytoadmin);
		$customfields_obj->setRequired($required);
		$customfields_obj->setDate($date);
		$customfields_obj->setSelectedCountry($cf_selected_country);
		
		if(is_numeric($custom_field_id)){
		$customfield_exists = SQB_CustomFields::loadById($custom_field_id);
		}
		
		if(isset($customfield_exists)){
			$customfields_obj->setId($custom_field_id);
			$custom_field_id = $customfields_obj->update();
			$output['update_custom_field'] = "update";
		} else {

			if($keyname){
				$customfield_name_exists = SQB_CustomFields::loadByName($keyname);
				if($customfield_name_exists){
					$output['custom_field_already_exist'] = "Already Exist";
					echo json_encode($output);die;
				}
			}
			
		   $output['create_custom_field'] = "create";
		   $custom_field_id = $customfields_obj->create();
		   if($custom_field_id == 'error' || $custom_field_id == ''){
				$output['error'] = 'Sorry there was an issue with save';
		   }
		}				
		$output['custom_field_list_table'] = sqb_get_custom_field_list();
		$output['custom_field_dropdown'] = sqb_get_custom_field_dropdown();
		$output['custom_field_optin'] = sqb_get_custom_field_optin($custom_field_id);
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

function sqb_get_custom_field_dropdown(){
	$i = 0;
	$list = '';
	//get quiz data
	$custom_fields_obj = SQB_CustomFields::load();									 
	if(isset($custom_fields_obj)){
		 foreach($custom_fields_obj as $custom_fields_obj_row) {
			$custom_fields_id = $custom_fields_obj_row->id;
			$custom_fields_name = $custom_fields_obj_row->name;
			$custom_fields_label = $custom_fields_obj_row->label;
			$custom_fields_description = $custom_fields_obj_row->description;
			$custom_fields_field_type = $custom_fields_obj_row->field_type;
			$custom_fields_field_value = $custom_fields_obj_row->field_value;
			$custom_fields_showonlytoadmin = $custom_fields_obj_row->showonlytoadmin;
			$custom_fields_required = $custom_fields_obj_row->required;
			$custom_selected_country = $custom_fields_obj_row->selected_country;
			$list .= '<li data-id="'.$custom_fields_id.'" data-name="'.$custom_fields_name.'" data-label="'.$custom_fields_label.'" data-name="'.$custom_fields_name.'" data-field-type="'.$custom_fields_field_type.'" data-field-value="'.$custom_fields_field_value.'" data-showonlytoadmin="'.$custom_fields_showonlytoadmin.'" data-desc="'.$custom_fields_description.'" data-required="'.$custom_fields_required.'" data-selected-country="'.$custom_selected_country.'" class=" nav-item sqb_custom_field_list_item" title=""><a class="nav-link" href="javascript:void(0);">'.$custom_fields_name.'</a></li>';
			$i++; 
		}
	}
	return $list;
}

function sqb_get_tag_list_dropdown(){
	$i = 0;
	$list = '';
	//get tag data
	$sqb_tags_obj = SQB_Tags::load();
	if(isset($sqb_tags_obj) && !empty($sqb_tags_obj)) {
		$i = 1;
		foreach($sqb_tags_obj as $sqb_tags){
		$sqb_tags_id = $sqb_tags->id;
		$sqb_tags_name = stripslashes($sqb_tags->name);
		$sqb_tags_content = $sqb_tags->tag_content;
		$list .= '<li data-id="'.$sqb_tags_id.'" data-name="'.$sqb_tags_name.'" data-content="" class=" nav-item sqb_tag_item" title=""><a class="nav-link" href="javascript:void(0);">'.$sqb_tags_name.'</a></li>';
			$i++; 
		}
	}
	return $list;
}

function sqb_get_custom_field_optin($custom_field_id){
	$custom_field_list_html = '';
		
							
		$custom_fields = SQB_CustomFields::loadById($custom_field_id);
		if(isset($custom_fields) && !empty($custom_fields)) {
			$i = 1;
			//foreach($custom_fields_obj as $custom_fields){
				
				$custom_fields_id = $custom_fields->id;
				$custom_fields_name = $custom_fields->name;
				$custom_fields_label = $custom_fields->label;
				$custom_fields_description = $custom_fields->description;
				$custom_fields_field_type = $custom_fields->field_type;
				$custom_fields_field_value = $custom_fields->field_value;
				$custom_fields_showonlytoadmin = $custom_fields->showonlytoadmin;
				$custom_fields_required = $custom_fields->required; 

				$custom_field_list_html .= '<div class="inner_template_style_box">
											<div class="d-flex justify-content-between align-items-center">
												<h4>'.$custom_fields_label.'</h4>
												<div class="quiz_right-content">
													<div class="square-switch_onoff">
														<input class="checkbox sqb_enable_disable_custom_fields" name="'.$custom_fields_name.'" type="checkbox" id="custom_fields_'.strtolower($custom_fields_name).'" value="'.$custom_fields_field_value.'" data-id="'.strtolower($custom_fields_name).'" data-type="'.$custom_fields_field_type.'" data-label-type="'.$custom_fields_label.'" data-custom-fieldsid ="'.$custom_fields_id.'" data-required="'.$custom_fields_required.'">
														<label for="custom_fields_'.strtolower($custom_fields_name).'"></label>
													</div>
												</div>
											</div>
										</div>';
								  $i++;
			//}
		} else {
			$custom_field_list_html .= 'No Custom Fields';
		}		  
		return $custom_field_list_html;
}

function sqb_get_custom_field_list(){
	$custom_field_list_html = '';
		$custom_field_list_html .= '<table class="table table-striped scrolldown">
								<thead>
							  <tr>
								<th width="125px">ID</th>
								<th>Name</th>
								<th>Label</th>
								<th>Description</th>
								<!--<th>Show Only To Admin?</th>-->
								<th>Required?</th>
								<th width="100px">Action</th>
							  </tr>
							</thead>
							<tbody>';
							
		$custom_fields_obj = SQB_CustomFields::load();
		if(isset($custom_fields_obj) && !empty($custom_fields_obj)) {
			$i = 1;
			foreach($custom_fields_obj as $custom_fields){
				
				$custom_fields_id = $custom_fields->id;
				$custom_fields_name = $custom_fields->name;
				$custom_fields_label = $custom_fields->label;
				$custom_fields_description = $custom_fields->description;
				$custom_fields_field_type = $custom_fields->field_type;
				$custom_fields_field_value = $custom_fields->field_value;
				$custom_fields_showonlytoadmin = $custom_fields->showonlytoadmin;
				$custom_fields_required = $custom_fields->required;
				$custom_selected_country = $custom_fields->selected_country;
				
				$custom_field_list_html .= '<tr data-row-count="'.$i.'">
									<td><div style="width: 100px;">'.$custom_fields_id.'</div></td>
									<td>'.$custom_fields_name.'</td>
									<td>'.$custom_fields_label.'</td>
									<td>'.$custom_fields_description.'</td>
									<!--<td>'.$custom_fields_showonlytoadmin.'</td>-->
									<td>'.$custom_fields_required.'</td>
									<td><i data-id="'.$custom_fields_id.'" data-name="'.$custom_fields_name.'" data-label="'.$custom_fields_label.'" data-name="'.$custom_fields_name.'" data-field-type="'.$custom_fields_field_type.'" data-field-value="'.$custom_fields_field_value.'" data-showonlytoadmin="'.$custom_fields_showonlytoadmin.'" data-desc="'.$custom_fields_description.'" data-required="'.$custom_fields_required.'" data-selected-country="'.$custom_selected_country.'" class="fas fa-edit sqb-edit-customfield"></i><i data-id="'.$custom_fields_id.'" class="fas fa-trash-alt sqb-delete-customfield"></i></td>
								  </tr>';
								  $i++;
			}
		} else {
			$custom_field_list_html .= '<tr><td colspan="7" align="center">No Records Found</td></tr>';
		}		  
		$custom_field_list_html .= '</tbody></table>';
		return $custom_field_list_html;
}

add_action('wp_ajax_sqb_customfields_list_table', 'SqbListCustomFieldsHtml');
add_action('wp_ajax_nopriv_sqb_customfields_list_table', 'SqbListCustomFieldsHtml');
function SqbListCustomFieldsHtml(){
$output = array();
$output['custom_field_list_table'] = sqb_get_custom_field_list();
echo json_encode($output);die;
}

add_action('wp_ajax_sqb_delete_custom_field', 'SqbDeleteCustomField');
add_action('wp_ajax_nopriv_sqb_delete_custom_field', 'SqbDeleteCustomField');
function SqbDeleteCustomField(){
	$output = array();
	if(isset($_POST['custom_field_id'])){
		$custom_field_id = $_POST['custom_field_id'];
		SQB_CustomFields::deleteById($custom_field_id);
	}
	$output['custom_field_list_table'] = sqb_get_custom_field_list();
	$output['custom_field_dropdown'] = sqb_get_custom_field_dropdown();
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_get_analyze_data', 'sqb_get_analyze_data');
add_action('wp_ajax_nopriv_sqb_get_analyze_data', 'sqb_get_analyze_data');
function sqb_get_analyze_data(){
	$quiz_id = $_POST['quiz_id'];

	$sqbData =  SQB_Quiz::loadById($quiz_id);
	if($sqbData){
		$result = $sqbData->getQuizShowAnalyzingResult(); 	
		if($result  == 'Y'){
			$sqbTempData =  SQB_QuizTemplate::loadByQuizId($quiz_id);
			$html = $sqbTempData->getAnalyzingResultTemp();
			if($html != ''){
				$output = stripslashes($html);
				$output = str_replace('contenteditable="true"','contenteditable="false"',$output);
			}else{
				$output = '<div class="analyzing_result_temp" style="text-align: center;"> <div class="analyzing_result_content"> <h3 class="analyzing_result_title sqb_tiny_mce_editor">Preparing Report...</h3> <p class="sqb_tiny_mce_editor">Please wait... we are calculating your results</p> </div> <div class="analyzing_result_progress"><div class="progress"> <div class="analyzing-progress-bar" role="progressbar" style="width: 100%;background-color:#007bff;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> </div> <p class="analyzing_result_note sqb_tiny_mce_editor">* Do not leave the page or reload the page *</p> </div> <input type="hidden" name="time-delay-hidden" class="time-delay-hidden" value="3"> </div>';
				$output = str_replace('contenteditable="true"','contenteditable="false"',$output);
			}
		}
		echo json_encode($output);
	}
	die();
}

add_action('wp_ajax_sqb_get_email_notification_settings', 'sqb_get_email_notification_settings');
add_action('wp_ajax_nopriv_sqb_get_email_notification_settings', 'sqb_get_email_notification_settings');
function sqb_get_email_notification_settings(){

	if ( !current_user_can( 'manage_options' ) ) {
	    return json_encode(array('error' => 'Not allowed to access'));die;  
	}
	check_admin_referer('sqbgetemailnotificationsettings', 'security');

	$output = array();
	if(isset($_POST['quizid'])){ 	
		$quizid = $_POST['quizid'];
		$quiztype = $_POST['quiztype'];
		//$quiz_settings = $_POST['quiz_settings'];

		$quiz_obj = SQB_Quiz::loadById($quizid);
		if($quiz_obj){
			$output['email_setting'] = $quiz_obj->getEmailNotificationSettings();
			$output['admin_email'] = $quiz_obj->getAdminEmail();
			$output['send_copy'] = $quiz_obj->getSendCopy();
		}else{
			$output['quiz_not_found'] = $quizid;
		}
		$output['email_data'] = SQB_QuizNotifications::loadByQuizidAndQuizType($quizid, $quiztype);

	}else if(isset($_POST['outcome_id'])){ 	
		$quizid = $_POST['quiz_id'];
		$quiz_obj = SQB_Quiz::loadById($quizid);
		if($quiz_obj){
			$output['email_setting'] = $quiz_obj->getEmailNotificationSettings();
			$output['admin_email'] = $quiz_obj->getAdminEmail();
			$output['send_copy'] = $quiz_obj->getSendCopy();
			// Added to fix the admin email issue
			$output['admin_email_data'] = SQB_QuizNotifications::loadByTypeAndQuizId('admin_email', $quizid);
		}else{
			$output['quiz_not_found'] = $quizid;
		}
		$outcome_id = $_POST['outcome_id'];
		$quiztype = $_POST['quiztype'];

		$output['email_data'] = SQB_QuizNotifications::loadByTypeAndOutcomeId('student_email', $outcome_id);

	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_get_email_notification_settings_by_quiztype', 'sqb_get_email_notification_settings_by_quiztype');
add_action('wp_ajax_nopriv_sqb_get_email_notification_settings_by_quiztype', 'sqb_get_email_notification_settings_by_quiztype');
function sqb_get_email_notification_settings_by_quiztype(){

	if ( !current_user_can( 'manage_options' ) ) {
            return json_encode(array('error' => 'Not allowed to access'));die;  
        }
    check_admin_referer('sqbgetemailnotificationsettingsbyquiztype', 'security');


	$output = array();
	if(isset($_POST['quiztype'])){ 	
		
		$type = $_POST['type'];
		$quiztype = $_POST['quiztype'];

		
		$output['email_data'] = SQB_QuizNotifications::loadByTypeAndQuizType($type, $quiztype);	

	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_get_all_questions', 'sqb_get_all_questions');
add_action('wp_ajax_nopriv_sqb_get_all_questions', 'sqb_get_all_questions');
function sqb_get_all_questions(){
	$output = array();
	if(isset($_POST['quiz_id'])){ 	
		$quiz_id = $_POST['quiz_id'];
		$allQuestions = SQB_QuizQuestions::loadByQuizIdOrderByQuestion($quiz_id);
		if(!empty($allQuestions)){

			foreach($allQuestions as $qkey => $single_question){
	
				$quesId = $single_question->getQuestionId();
				
				$quesDetails = SQB_QuizQuestionBank::loadById($quesId);
				if(!empty($quesDetails)){
					$output[$qkey]['question_id'] = $quesId;
					$output[$qkey]['question_title'] = stripslashes($quesDetails->getQuestionTitle());;
				}
			}

		}
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_get_pdf_settings', 'sqb_get_pdf_settings');
add_action('wp_ajax_nopriv_sqb_get_pdf_settings', 'sqb_get_pdf_settings');
function sqb_get_pdf_settings(){
	$output = array();
	if(isset($_POST['outcome_id'])){ 	
		$outcome_id = $_POST['outcome_id'];
		$outcome_data = SQB_Outcome::loadById($outcome_id);
		if($outcome_data){
			$output['pdf_html'] = stripslashes($outcome_data->getPDFHtml());
			$output['pdf_id'] = stripslashes($outcome_data->getPDFId());
		}
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_save_question_bank', 'SQBSaveQuestionBankAjax');
add_action('wp_ajax_nopriv_sqb_save_question_bank', 'SQBSaveQuestionBankAjax');

/* Save Quiz  */
function SQBSaveQuestionBankAjax($form_data = ''){

	if($form_data !="" && is_array($form_data)){
		$_POST['form_data'] = $form_data;
	}
	
	if(isset($_POST['form_data'])){
		
		$data = $_POST['form_data'];
		$date = date('Y-m-d H:i:s');

		$sqbData = new SQB_QuizQuestionBank();
		$sqbData->setQuestion($data['question_html']);
		$sqbData->setQuestionType($data['question_type']);
		$sqbData->setQuestionTitle($data['question_title']);
		$sqbData->setQuestionImage('image'); 			 
		$sqbData->setQuestionOrder('0'); 
		$sqbData->setAnsWithImg('Y'); 
		$sqbData->setMultipleCorrectAns('Y'); 
		$sqbData->setAnsLayout('Y');	 
		$sqbData->setShowCorrectIncorrectAns('Y'); 
		$sqbData->setTempCustomizer('700px'); 
		$sqbData->setAllowSkipQues('Y');
		$sqbData->setFileUploadSettings('Y');  
		$sqbData->setQuestionsNextButtonHtml('Y'); 
		$sqbData->setEnableBackgroundImage('Y'); 
		$sqbData->setSkipMapping('Y');
		$sqbData->setMatrixLabelText('Y');	
		$sqbData->setMatrixHtml('Y');	
		$sqbData->setCategoryId('0');
		$sqbData->setDate($date);	
		$sqbData->create();

		$output['id'] = $sqbData->create();

		$output['saved'] = "Saved";
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}



/*add_action('wp_ajax_sqb_show_question_by_type', 'sqb_show_question_by_type');
add_action('wp_ajax_nopriv_sqb_show_question_by_type', 'sqb_show_question_by_type');
function sqb_show_question_by_type($quiz_type = ''){
	if($quiz_type !="" && is_array($quiz_type)){
		$_POST['quiz_type'] = $quiz_type;
	}
	
	if(isset($_POST['quiz_type'])){
		$quiz_type = $_POST['quiz_type'];

		$all_questions = array();
		$quiz_details = SQB_Quiz::loadByType($quiz_type);
		foreach($quiz_details as $quiz_detail) {
			$quiz_id = $quiz_detail->getId();
			$question_ids = SQB_QuizQuestions::loadByQuizId($quiz_id);
			foreach($question_ids as $question_id){
				$question_id = $question_id->getQuestionId();
				$all_questions[] = $question_id;
			}
		}
		if(isset($all_questions)){
			$count = 1;
			foreach($all_questions as $question) {
				$question_details = SQB_QuizQuestionBank::loadById($question);
			}
		}		
	}
	echo json_encode($question_details);die;
}*/


add_action('wp_ajax_sqb_get_quiz_by_question_id', 'sqb_get_quiz_by_question_id');
add_action('wp_ajax_nopriv_sqb_get_quiz_by_question_id', 'sqb_get_quiz_by_question_id');
function sqb_get_quiz_by_question_id(){

	/*if($question_id !="" && is_array($question_id)){
		$_POST['question_id'] = $question_id;
	}*/
	
	if(isset($_POST['question_id'])){
		$output = array();
		$question_id = $_POST['question_id'];
		$question_detail = SQB_QuizQuestionBank::loadById($question_id);
		$output['question_title'] = $question_detail->getQuestionTitle();
		$quiz_ids = SQB_QuizQuestions::loadByQuestionId($question_id);
		foreach($quiz_ids as $quiz_id){
			$quiz_id = $quiz_id->getQuizId();
			$quiz_details = SQB_Quiz::loadById($quiz_id);			
			$output[] = array('id'=>$quiz_id, 'title'=>$quiz_details->getQuizName());
		}
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_quiz_question', 'sqb_quiz_question');
add_action('wp_ajax_nopriv_sqb_quiz_question', 'sqb_quiz_question');
function sqb_quiz_question(){	
	/*if($quiz_type !="" && is_array($quiz_type)){
		$_POST['quiz_type'] = $quiz_type;
	}*/
	
	if(isset($_POST['quiz_id'])){
		$current_quiz_id = $_POST['quiz_id'];
		$quiz_type = $_POST['quiz_type'];
		$quiz_details = SQB_Quiz::loadByGlobalStyle();
		$output = '';

		$first_array = array();
		$second_array = array();
		foreach($quiz_details as $quiz_detail) {
			$quiz_id = $quiz_detail->getId();
			$question_ids = SQB_QuizQuestions::loadByQuizId($quiz_id);
			foreach($question_ids as $question_id){
				$question_id = $question_id->getQuestionId();
				$first_array[] = $question_id;
			}
		} 

		$current_question_ids = SQB_QuizQuestions::loadByQuizId($current_quiz_id);
		foreach($current_question_ids as $current_question_id){
				$current_question_id = $current_question_id->getQuestionId();
				$second_array[] = $current_question_id;
			}

		$third_array = array();

		$globalThemeDataHas = SQB_GlobalTheme::load();
		if(!empty($globalThemeDataHas)){
			foreach($globalThemeDataHas as $globalThemeData){
				$quiz_id = $globalThemeData->getQuizId();
				//$globalThemes = SQB_GlobalTheme::loadByQuizIdAndType($quiz_id,'global');
				/*foreach($globalThemes as $globalTheme){
					$global_screen_name = $globalTheme->getName();
					if($globalTheme->getStatus() == 'Y' && $globalTheme->getName() != 'student_image_and_redirect_url'){
						$quiz_id = $globalTheme->getQuizId();*/
						$question_ids = SQB_QuizQuestions::loadByQuizId($quiz_id);
						foreach($question_ids as $question_id){
							$question_id = $question_id->getQuestionId();
							$third_array[] = $question_id;
						}
					/*}
				}*/
			}
		}

		$all_questions = array_diff($third_array, $second_array);
		
		
			$output .= '<div class="col-sm-12"> 
							<span class="checkbox-custom-style select-all-question">
								<input type="checkbox" name="select_all_question"  class="custom-checkbox-input">
								<span class="custom--checkbox"></span>
							</span>
							<label m-0 ml-2 style="font-weight:600;">Select All</span>
						</div>
						<div class="col-sm-6 mutliSelect-input-outer">							
							<input type="text" class="form-control" placeholder="Search..." id="mutliSelect-input-value">
							<div id="all_resources_data_outer" class="mutliSelect" style="width:100%;">
								';

			$all_questions = array_unique($all_questions);
			if($all_questions){
				$output .= '<ul class="all_resources_data form-control sqb_selected_post_list">';
				foreach($all_questions as $question) {
					$question_details = SQB_QuizQuestionBank::loadById($question);
					if($question_details){
						$question_type = $question_details->getQuestionType();
							$output .= '<li class="bold_cls_less active-multiple-select" data-question_id="'.$question_details->getId().'" data-value="'.stripslashes($question_details->getQuestionTitle()).'">'.stripslashes($question_details->getQuestionTitle()).'</li>';
					}
				}
				$output .= '</ul>';
			}
			$output .= ' </div></div><div class="col-sm-6 selected_question_outer selected_data_question" style="display:none;"> <div class="selected_question_list"> <h5>Selected Question(s)</h5> <ul class="allSelectedQuestionPreview"> </ul> </div> <div class="col-sm-12 text-right mt-2 pl-0 pr-0" style="display:none;"> <button type="button" class="btn save-btn existing_question_outer">Add</button> </div> </div>'; 
		}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}



/*Update Email Notification settings in Quiz table*/

add_action('wp_ajax_sqb_quiz_update_email_notification', 'sqb_quiz_update_email_notification');
add_action('wp_ajax_nopriv_sqb_quiz_update_email_notification', 'sqb_quiz_update_email_notification');
function sqb_quiz_update_email_notification(){
	$output= array();
	if(isset($_POST)){ 	
		$quiz_id = $_POST['quiz_id'];
		$quiz_notification = $_POST['quiz_notification'];
		$admin_email = $_POST['admin_email'];
		$send_copy = $_POST['send_copy'];
		$output['success'] = 'update';
		$quiz_obj = SQB_Quiz::loadById($quiz_id);
		if($quiz_obj){
			$quiz_obj->setEmailNotificationSettings($quiz_notification);
			$quiz_obj->setAdminEmail($admin_email);
			$quiz_obj->setSendCopy($send_copy);
			$quiz_obj->update();
		}else{
			$output['quiz_not_found'] = $quiz_id;
		}
		
		$output['quiz_id'] = $quiz_id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}



add_action('wp_ajax_sqb_check_outcome_notification', 'sqb_check_outcome_notification');
add_action('wp_ajax_nopriv_sqb_check_outcome_notification', 'sqb_check_outcome_notification');
function sqb_check_outcome_notification(){
	$output= array();
	if(isset($_POST)){ 	
		$outcome_id = $_POST['outcome_id'];
		
		$outcome_obj = SQB_QuizNotifications::loadByTypeAndOutcomeId('student_email',$outcome_id);
		if($outcome_obj){
			$output['send_email'] = $outcome_obj->getSendEmail();			
		}else{
			$output['quiz_not_found'] = $quiz_id;
		}		
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_add_question', 'sqb_add_question');
add_action('wp_ajax_nopriv_sqb_add_question', 'sqb_add_question');
function sqb_add_question(){
	if($question_ids !="" && is_array($question_ids)){
		$_POST['question_ids'] = $question_ids;
	}
	
	if(isset($_POST['question_ids'])){
		$question_ids = $_POST['question_ids'];
		$quiz_id = $_POST['quiz_id'];
		$i = 0;
		foreach($question_ids as $question_id){
			$quiz_qn =  SQB_QuizQuestions::loadByQuizIdAndQuestionId($quiz_id,$question_id);
			if($quiz_qn){
				$output[$i]['alreadyHas'] = "Already Added";
			}else{

				$sqbQuizQuesObj = new SQB_QuizQuestions();
			   	$sqbQuizQuesObj->setQuizId($quiz_id);
			   
			   	$question_already_exists = SQB_QuizQuestions::loadByQuestionId($question_id);
			   					   
			   	if(!empty($question_already_exists)){
			   		$sqbQuizQuesObj->setQuestionId($question_id);
			   		//$sqbQuizQuesObj->setQuestionOrder($order);
			   		$sqbQuizQuesObj->create();
			   	}

				
				$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
				$output[$i]['question_id'] = $question_id;
				$output[$i]['question'] = $sqbquestionobj->getQuestion();
				$output[$i]['question_title'] = stripslashes($sqbquestionobj->getQuestionTitle());
				$output[$i]['question_type'] = $sqbquestionobj->getQuestionType();

				$answerObj = SQB_QuizAnswers::loadByQuestionId($question_id);
				if($answerObj){
				   foreach($answerObj as $answerObj_value){
				   		$answer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000);
						$output[$i]['answer_html'] .=  stripslashes($answerObj_value->getAnswer());
						$output[$i]['answer_title'] .=  '<div class="sqb_ans_item ui-sortable-handle" data-id="'.$answerObj_value->getId().'" id="'.$answer_round_no_1.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.site_url().'/wp-content/plugins/smartquizbuilder/includes/images/sqb_empty.jpg" class="sbq_change_img '.$answer_round_no_1.' ui-draggable ui-draggable-handle" data-class="'.$answer_round_no_1.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor" contenteditable="true" style="position: relative;" spellcheck="false"><div>'.stripslashes($answerObj_value->getAnswerTitle()).'</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" %%sqbanswercorrect%%="" name="sqb_is_right_ans_'.$answer_round_no_1.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="'.$answerObj_value->getAnswerPoints().'"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$answer_round_no_1.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
					}
				}  
			}
			$i++;
		}
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_quiz_question_by_limit', 'sqb_quiz_question_by_limit');
add_action('wp_ajax_nopriv_sqb_quiz_question_by_limit', 'sqb_quiz_question_by_limit');
function sqb_quiz_question_by_limit(){
	$result = array();
	$output = array();
	$offset = 0;
	if($quiz_id !="" && is_array($quiz_id)){
		$_POST['quiz_id'] = $quiz_id;
	}
	$add_new_question_fe_call = 'N';
	$clone_existing_question_call_var = 'N';
	if(isset($_POST['add_new_question_fe_call']) && $_POST['add_new_question_fe_call'] == 'Y'){
		$add_new_question_fe_call = $_POST['add_new_question_fe_call'];
	}
	
	if(isset($_POST['clone_existing_question_call_var']) && $_POST['clone_existing_question_call_var'] == 'Y'){
		$clone_existing_question_call_var = $_POST['clone_existing_question_call_var'];
	}
	
	
	global $sqb_add_question_pagination_limit;
	if(isset($_POST['quiz_id']) && isset($_POST['page'])){
		 
		$quiz_id = $_POST['quiz_id'];
		$page = $_POST['page'];
		$quiz_type = $_POST['quiz_type'];
		
		if($add_new_question_fe_call == 'Y'){
			$questionsArray = SQB_QuizQuestions::loadByQuizId($quiz_id);
			if(is_array($questionsArray) && count($questionsArray)){
				$questionsArray_count = count($questionsArray); 
				$get_count =  $questionsArray_count/$sqb_add_question_pagination_limit; 
				if(is_float($get_count)){
					//$page = (int)$get_count+1;
					$page = (int)$get_count;
				}else{
					$page = $get_count;
				}
			}
		}
		
		$limit = $_POST['limit'];
		$offset = $limit * ($page-1);
		if($add_new_question_fe_call == 'Y'){
			$offset = $limit * $page;
		}
		//$finalPages= ($limit - $sqb_add_question_pagination_limit);
		$finalPage= $offset;
		
		
		
		$quiz_details = SQB_QuizQuestions::loadByQuizIdAndLimit($quiz_id,$offset, $limit);
			
		$question_ids = array();
		if(is_array($quiz_details) && count($quiz_details)){
			$finalPage= $offset+1;
			foreach($quiz_details as $quiz_detail){
				$question_ids[] = $quiz_detail->getQuestionId();
			}

			$i = 0;
				
			foreach($question_ids as $question_id){
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
			if($sqbquestionobj){
				$output[$i]['question_id'] = $question_id;
				$output[$i]['question'] = $sqbquestionobj->getQuestion();
				$output[$i]['question_type'] = $sqbquestionobj->getQuestionType();
				$output[$i]['category_id'] = $sqbquestionobj->getCategoryId();
				$output[$i]['ans_with_img'] = $sqbquestionobj->getAnsWithImg();
				$output[$i]['skip_mapping'] = $sqbquestionobj->getSkipMapping();

				$answerObj = SQB_QuizAnswers::loadByQuestionId($question_id);
				if($answerObj){
				   foreach($answerObj as $answerObj_value){						 
						$ans_id = $answerObj_value->getId();
						$output[$i]['answer_id'] .=  $answerObj_value->getId();
						$output[$i]['answer_html'] .=  $answerObj_value->getAnswer();
						$output_answer_html =  $answerObj_value->getAnswer();
						$outputanswer_html =  str_replace("%%ANSWERID%%",$ans_id,$output_answer_html); 
						$output[$i]['answer_html'] .= $outputanswer_html; 
						//added for outcome mapping checked
						if($quiz_type == 'personality'){						 
							$outcomeMappingObj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quiz_id ,$question_id,$ans_id);						 
							if(isset($outcomeMappingObj)){
								 $output[$i][$ans_id]['outcome_ids'] .=  $outcomeMappingObj->getOutcomeId(); 
								 $output[$i]['ans_id'][] =  $ans_id; 								  
							}  
						}
					}
				}  
				
				$i++;
			}
		}
			$result['no_more_question'] = 'N';
			$selected_page_id = $page;
		}else{
			$result['no_more_question'] = 'Y';
			$selected_page_id = $page;
		}
		
		
		 $questions_pagination_html = SQBQuestionsPaginationHtml($quiz_id,$selected_page_id, $add_new_question_fe_call, $clone_existing_question_call_var);
         $result['selected_page_id'] = $selected_page_id; 
         $result['html'] = $output; 
         $result['finalPage'] = $finalPage; 
         $result['questions_pagination_html'] = $questions_pagination_html; 
         $result['offset'] = $offset; 
	}else{
		$result['error'] = 'Something Went Wrong';	
	}
	
	echo json_encode($result);die;
}



add_action('wp_ajax_sqb_load_all_quiz_question', 'sqb_load_all_quiz_question');
add_action('wp_ajax_nopriv_sqb_load_all_quiz_question', 'sqb_load_all_quiz_question');
function sqb_load_all_quiz_question(){
	if($quiz_id !="" && is_array($quiz_id)){
		$_POST['quiz_id'] = $quiz_id;
	}
	


	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$quiz_details = SQB_QuizQuestions::loadByQuizIdOrderByQuestion($quiz_id);
		$question_ids = array();
		foreach($quiz_details as $quiz_detail){
			$question_ids[] = $quiz_detail->getQuestionId();
		}

		$i = 0;
		foreach($question_ids as $question_id){
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
			$output[$i]['question_id'] = $question_id;
			$output[$i]['question'] = $sqbquestionobj->getQuestion();
			$output[$i]['question_title'] = $sqbquestionobj->getQuestionTitle();
			$output[$i]['question_type'] = $sqbquestionobj->getQuestionType();

			$answerObj = SQB_QuizAnswers::loadByQuestionId($question_id);
			if($answerObj){
			   foreach($answerObj as $answerObj_value){
					$output[$i]['answer_html'] .=  $answerObj_value->getAnswer();
				}
			}  
			$i++;
		}


	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_get_pages_posts_url_list_html', 'sqbGetPagesPostsURLListHtmlAjax');
add_action('wp_ajax_nopriv_sqb_get_pages_posts_url_list_html', 'sqbGetPagesPostsURLListHtmlAjax');
function sqbGetPagesPostsURLListHtmlAjax(){
	$quiz_id  = 0;
	if(isset($_POST['quiz_id'])){
		$quiz_id =  $_POST['quiz_id'];	
		$tab_id =  !empty($_POST['tab_id']) ? $_POST['tab_id'] : '';	
	}
	$html = sqbGetPagesPostsURLListHtml($quiz_id, $tab_id);
	$output['html'] = $html;
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqbLoadAnswerStyle', 'sqbLoadAnswerStyle');
add_action('wp_ajax_nopriv_sqbLoadAnswerStyle', 'sqbLoadAnswerStyle');
function sqbLoadAnswerStyle(){
	$output = array();
	if(isset($_POST['quiz_id'])){
		$quiz_id =  $_POST['quiz_id'];
		$quiz_data = SQB_Quiz::loadById($quiz_id); 
		$output['quiz_type'] =  $quiz_data->getTemplate();
		if(isset($quiz_data)){
			$quiz_customizer_styles = $quiz_data->getCustomizerStyles();
			if($quiz_customizer_styles){
				$quiz_styles = explode('|',$quiz_customizer_styles); 

				$output['ans_bg'] = $quiz_styles[0];
				$output['ans_text_color'] = $quiz_styles[1];
			}
		}
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);
	die;
}

function sqbGetPagesPostsURLListHtml($quiz_id = 0, $tab_id = 0 ){
	
	$page_post_ids = array();
	if(is_numeric($quiz_id) && $quiz_id != 0){
		
		$quiz_data = SQB_Quiz::loadById($quiz_id); 
		if($quiz_data == false){
			$quiz_data = null;
		}
		if(isset($quiz_data) && ($quiz_data->getId() =='')){
			$quiz_data = null;
		}
	
		if(isset($quiz_data)){
			$quiz_type = $quiz_data->getQuizType();
			$quiz_display = $quiz_data->getQuizDisplay();
			
			/*if(($quiz_type == 'form' && $tab_id == '#Basic-Screen-Settings') || ($quiz_type == 'form' && $tab_id == '#Basic-Settings') || ($quiz_type == 'form' && $tab_id == '#create_quiz_advance')){
				$form_quiz = SQB_FormQuiz::loadByQuizId($quiz_id);
				$quiz_display_url = $form_quiz->getPageIds();
				if($quiz_display_url){
					$page_post_ids = explode(',',$quiz_display_url); 
				}
			}else{*/
				$quiz_display_url = $quiz_data->getQuizDisplayUrls();
				if(isset($quiz_display_url)){
					$page_post_ids = explode(',',$quiz_display_url); 
				}
			//}
		}
	}
	
	$html = '';						
		$active_page_posts_url = "";
		if(in_array(get_option('page_on_front'),$page_post_ids)){
			$active_page_posts_url = "active_page_posts_url";
		} 
		$html .= '<strong class="link_heading">-----------(Home Page)----------</strong>';
		
		$page_id = get_option('page_on_front');
		$page_name = get_post_field( 'post_name', get_option('page_on_front'));
		$page_url = get_post_field( 'post_name', get_option('page_on_front'));
		
		
		$html .= '<li data-id="'.$page_id.'" data-value="/'.$page_name.'" class="sqb_urls_list '.$active_page_posts_url.'">/'.$page_url.'</li>'; 
		
		
		$html .=  '<strong class="link_heading">----------- Pages----------</strong>';
		
		$page_id = get_option('page_on_front');

		$wpb_all_page = get_pages(array('exclude' => array($page_id),'post_type'=>'page', 'post_status'=>'publish', 'posts_per_page'=>500));
		foreach($wpb_all_page as $page){ // $pages is array of object
				$active_page_posts_url = "";
				if(in_array($page->ID,$page_post_ids)){
					$active_page_posts_url = "active_page_posts_url";
				}

			$page_id = get_option('page_on_front');
			$page_name = get_post_field( 'post_name', $page->ID );
			$page_url = get_post_field( 'post_name', $page->ID );
			
			$html .=  '<li data-id="'.$page->ID.'" data-value="/'.$page_name.'" class="sqb_urls_list '.$active_page_posts_url.'">/'.$page_url.'</li>';

		}
		
		
		$html .=	'<strong class="link_heading">----------- Post ----------</strong>';
		
		$wpb_all_posts = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>500));
		if ( $wpb_all_posts->have_posts() ) {
			while ( $wpb_all_posts->have_posts() ){ $wpb_all_posts->the_post();
				$active_page_posts_url = "";
				if(in_array(get_the_ID(),$page_post_ids)){
					$active_page_posts_url = "active_page_posts_url";
				}
			$page_id = get_the_ID();
			$page_name = get_post_field( 'post_name', get_the_ID() );
			$page_url = get_post_field( 'post_name', get_the_ID() );
			
			$html .= '<li data-id="'.$page_id.'" data-value="/'.$page_name.'" class="sqb_urls_list '.$active_page_posts_url.' ">/'.$page_url.'</li>';
		 } 
		wp_reset_postdata();
	}


	$args       = array(
		'public' => true,
		'_builtin' => false,
	);
	$post_types = get_post_types( $args, 'objects' );

	

	if(!empty($post_types)){
		
		foreach($post_types as $post_type){
	
			$post_type_name = $post_type->name;
			$html .=	'<strong class="link_heading">----------- Custom Post - '.$post_type->label.' ----------</strong>';
			$wpb_all_posts = new WP_Query(array('post_type'=> $post_type_name, 'post_status'=>'publish', 'posts_per_page'=>500));
			if ( $wpb_all_posts->have_posts() ) {
				while ( $wpb_all_posts->have_posts() ){ $wpb_all_posts->the_post();
					$active_page_posts_url = "";
					if(in_array(get_the_ID(),$page_post_ids)){
						$active_page_posts_url = "active_page_posts_url";
					}
					$page_id = get_the_ID();
					$page_name = get_post_field( 'post_name', get_the_ID() );
					$page_url = get_post_field( 'post_name', get_the_ID() );
					
					$html .= '<li data-id="'.$page_id.'" data-value="/'.$page_name.'" class="sqb_urls_list '.$active_page_posts_url.' ">/'.$page_url.'</li>';
				}
			} 

			wp_reset_postdata();

		}
	}
														
	return $html;						 
	
}


add_action('wp_ajax_sqb_get_formula_sidepopup', 'sqb_get_formula_sidepopup');
add_action('wp_ajax_nopriv_sqb_get_formula_sidepopup', 'sqb_get_formula_sidepopup');
function sqb_get_formula_sidepopup(){
	$output = array();
	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];

		$formula_list_html = '';	
		$formula_list_html = '<select class="form-control select-formula"><option value="">Select a Formula</option>';
		$calculator_formulas_obj = SQB_CalculatorFormula::loadByQuizId($quiz_id);
		if(isset($calculator_formulas_obj) && !empty($calculator_formulas_obj)) {
			$i = 1;
			foreach($calculator_formulas_obj as $calculator_formulas){
				$formula_id = $calculator_formulas->id;
				$formula_name = $calculator_formulas->html;
				$formula_title = $calculator_formulas->name;
				
				$formula_list_html .= '<option class="data-formula-title-'.$formula_id.'" value="'.$formula_id.'"><div style="width: 100px;">'.$formula_title.' '.$i.'</div></option>';
				$i++;
			}
		} else {
			$formula_list_html .= '<option value="no-formula">No formula</option>';
		}		  
		$formula_list_html.= '</select>';
		$output['formula_list'] = $formula_list_html;

		/* Outcome */
		$outcome_list_html = '<select class="form-control select-formula-outcome"><option value="">Please select</option>';	
		$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
		if(isset($outcome_obj) && !empty($outcome_obj)) {
			$i = 1;
			foreach($outcome_obj as $outcome_detail){
				$outcome_id = $outcome_detail->getid();
				$outcome_name = $outcome_detail->getOutcomeName();
				
				$outcome_list_html .= '<option value="'.$outcome_id.'"><div style="width: 100px;">OUTCOME '.$i.' ('.$outcome_name.')</div></option>';
				$i++;
			}
		} else {
			$outcome_list_html .= '<option value="no-formula">No formula</option>';
		}		  
		$outcome_list_html.= '</select>';
		$output['outcome_list'] = $outcome_list_html;



	}else {
		$output['error'] = 'Something Went Wrong';	
	}
		echo json_encode($output);die();
}

add_action('wp_ajax_sqb_save_calculator_mapping', 'sqb_save_calculator_mapping');
add_action('wp_ajax_nopriv_sqb_save_calculator_mapping', 'sqb_save_calculator_mapping');
function sqb_save_calculator_mapping(){
	 
	if(isset($_POST['form_data'])){		
		$data = $_POST['form_data'];
		
		$formula_id = $data['formula_id'];
		$quiz_id = $data['quiz_id'];
		$number_range = $data['number_range'];
		$formula_num = $data['formula_num'];
		$formula_range = !empty($data['formula_range']) ? $data['formula_range'] : '';
		$outcome_id = $data['outcome_id'];
		

		$data = SQB_CalculatorFormula::loadById($formula_id);

		if(isset($data) && !empty($data)) {
			$name = $data->getName();
			$html = $data->getHtml();
			$customizer_data = $data->getCustomzierData();
		}
		//Set variable of class file
		$dateTime = date('Y-m-d h:i:s');
		$sqbData = new SQB_AdvancedRule();
		//$sqbData->setName($name);
		//$sqbData->setHtml($html);
		//$sqbData->setCustomzierData($customizer_data);
		//$sqbData->setNumberRange($number_range);
		//$sqbData->setOutcomeId($outcome_id);
		if($number_range == 'number'){
			$total_range = $number_range.'|'.$formula_num;
		}else{
			$total_range = $number_range.'|'.$formula_range;
		}

		$sqbData->setQuizId($quiz_id);
		$sqbData->setOutcomeId($outcome_id);
		$sqbData->setCategoryTotal($total_range);
		$sqbData->setFormulaId($formula_id);
		$sqbData->setFormulaPriority('1');
		$sqbData->setEnabledAdvanced('Y');
		$sqbData->setDate($dateTime);
		$last_id = $sqbData->create();

		/*if($formula_num != ''){
			$sqbData->setFormulaValues($formula_num);		
		}else{
			$sqbData->setFormulaValues($formula_range);	
		}*/
		
		/*if($formula_id != '' || $formula_id != 0){			
			$sqbData->setId($formula_id);
			$sqbData->setQuizId($quiz_id);
			$last_id = $sqbData->update();			
		}	*/	
		$output['last_id'] = $last_id;
		$output['success'] = "Saved successfully.";		
	}else{
		$output['error'] = 'something wrong.';
	}	
	echo json_encode($output);
	die;
}

add_action('wp_ajax_sqb_get_formula_data', 'sqb_get_formula_data');
add_action('wp_ajax_nopriv_sqb_get_formula_data', 'sqb_get_formula_data');
function sqb_get_formula_data(){
	$output = array();
	if(isset($_POST['formula_id'])){
		$formula_id = $_POST['formula_id'];
		$quiz_id = $_POST['quiz_id'];
		/*$data = SQB_CalculatorFormula::loadById($formula_id);
		if(isset($data) && !empty($data)) {
			$output['number_range'] = $data->getNumberRange();
			$output['outcome_id'] = $data->getOutcomeId();
			$output['formula_values'] = $data->getFormulaValues();
		}*/

		$formulas_data = SQB_AdvancedRule::loadByFormulaId($formula_id);
		if(isset($formulas_data) && !empty($formulas_data)) {
			foreach($formulas_data as $formula_data){
				$explode_data = explode('|',$formula_data->getCategoryTotal());
				$formula_name = SQB_CalculatorFormula::loadById($formula_data->getFormulaId());
				
				$calculator_formulas_obj = SQB_CalculatorFormula::loadByQuizId($quiz_id);
				if(isset($calculator_formulas_obj) && !empty($calculator_formulas_obj)) {
					$all_name=array();
					$i = 1;
					foreach($calculator_formulas_obj as $calculator_formulas){
						$formula_id = $calculator_formulas->id;
						$formula_name = $calculator_formulas->html;
						$formula_title = $calculator_formulas->name;
						
						$all_name[$formula_title.' '.$i] = $formula_id;
						$i++;
					}
				}

				$get_formula_id = $formula_data->getFormulaId();
				$get_formula_name = array_search($get_formula_id, $all_name);

				$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
				if(isset($outcome_obj) && !empty($outcome_obj)) {
					$i = 1;
					$all_outcome = array();
					foreach($outcome_obj as $outcome_detail){
						$outcome_id = $outcome_detail->getid();
						$all_outcome['OUTCOME '.$i] = $outcome_id; 
						$i++;
					}
				} 
				$get_outcome_id = $formula_data->getOutcomeId();
				$get_outcome_name = array_search($get_outcome_id, $all_outcome);
				$html .= '<tr><td>'.$get_formula_name.'</td><td class="number-range-values" data-number-range="'.$explode_data[0].'">'.$explode_data[1].'</td><td class="outcome_ids" data-value="'.$formula_data->getOutcomeId().'">'.$get_outcome_name.'</td><td><input class="outcome-input-priority" type="number" data-advance-id="'.$formula_data->getId().'" name="save-priority" value="'.$formula_data->getFormulaPriority().'"> <a href="javascript:void(0)" class="save-priority-btn">Save</a></td><td><i data-id="'.$formula_data->getId().'" class="fas fa-trash-alt sqb-delete-advaced-formula" style="color:red;margin-left:20px;"></i></td></tr>';
			}
			$output['html'] = $html;
		}

	}else {
		$output['error'] = 'Something Went Wrong';	
	}
		echo json_encode($output);die();
}

add_action('wp_ajax_sqb_save_question_order', 'sqb_save_question_order'); 
function sqb_save_question_order(){	
	$output = array();
	
	if(isset($_POST['question_data'])){
		$formdata = $_POST['question_data'];

		$quiz_id = $formdata['quiz_id'];
		if($quiz_id !=""){
			$question_ids = $formdata['question_ids'];	
			$select_quiz_bank = $formdata['select_quiz_bank'];	
			
			if($question_ids !=""){
				foreach($question_ids as $question_info){ 
					    $order_no = $question_info['order_no'];
					    $question_id = $question_info['question_id'];
						$obj = new SQB_QuizQuestions();
						$obj->setQuizId($quiz_id);
						$obj->setQuestionId($question_id);
						$obj->setQuestionOrder($order_no);
						$obj->updateQuestionOrder();

						//if($select_quiz_bank == 'Y'){




					    	$skip_question = $question_info['skip_question'];
					    	$sqb_show_question_image = $question_info['sqb_show_question_image'];
							
							$load_question_bank = SQB_QuizQuestionBank::loadById($question_id);


							/*Spaninsh characters are not properly encoding*/
							//$dom->loadHTML($load_question_bank->question, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
							$question_html = $load_question_bank->question;

							// Use DOMDocument with proper encoding
							$dom = new DOMDocument('1.0', 'UTF-8');
							@$dom->loadHTML('<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $question_html . '</body></html>', LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

							// Create XPath object
							$xpath = new DOMXPath($dom);

							// Debug: Check if any divs exist
							$allDivs = $xpath->query("//div");

							// Debug: Check for divs with question_img_div class
							$imgDivs = $xpath->query("//div[contains(@class, 'question_img_div')]");

							// Try the simplified query first
							$imageDiv = $xpath->query("//div[contains(@class, 'question_img_div')]")->item(0);

							if ($imageDiv) {
							    // Your modification code here
							    $displayValue = ($sqb_show_question_image === 'Y') ? 'inline-block' : 'none';
							    
							    // Get current style attribute
							    $currentStyle = $imageDiv->getAttribute('style');
							    
							    // Remove existing display property and add new one
							    $newStyle = preg_replace('/display\s*:\s*[^;]+;?/', '', $currentStyle);
							    $newStyle .= ' display: ' . $displayValue . ';';
							    
							    $imageDiv->setAttribute('style', $newStyle);
							    
							    // Extract only the body content
							    $body = $dom->getElementsByTagName('body')->item(0);
							    $question_html = '';
							    foreach ($body->childNodes as $node) {
							        $question_html .= $dom->saveHTML($node);
							    }
							}

							$obj_qbank = new SQB_QuizQuestionBank();
							$obj_qbank->setId($question_id);
							$obj_qbank->setQuestion($question_html);
							$obj_qbank->setQuestionTitle($load_question_bank->question_title);
							$obj_qbank->setQuestionType($load_question_bank->question_type);
							$obj_qbank->setQuestionImage($load_question_bank->question_image);
							$obj_qbank->setQuestionOrder($order_no);
							$obj_qbank->setAnsWithImg($load_question_bank->ans_with_img);
							$obj_qbank->setMultipleCorrectAns($load_question_bank->multiple_correct_ans);
							$obj_qbank->setAnsLayout($load_question_bank->ans_layout);
							$obj_qbank->setShowCorrectIncorrectAns($load_question_bank->show_correct_incorrect_ans);
							$obj_qbank->setTempCustomizer($load_question_bank->temp_customizer);
							$obj_qbank->setAllowSkipQues($skip_question);
							$obj_qbank->setFileUploadSettings($load_question_bank->question_file_upload_settings);
							$obj_qbank->setQuestionsNextButtonHtml($load_question_bank->next_button_html);
							$obj_qbank->setQuestionsSkipButtonHtml($load_question_bank->skip_button_html);
							$obj_qbank->setEnableBackgroundImage($load_question_bank->enable_background_image);
							$obj_qbank->setSkipMapping($load_question_bank->skip_mapping);
							$obj_qbank->setDate($load_question_bank->date);
							$obj_qbank->setMatrixLabelText($load_question_bank->matrix_label_text);
							$obj_qbank->setMatrixHtml($load_question_bank->matrix_html);
							$obj_qbank->setCategoryId($load_question_bank->category_id);
							$obj_qbank->setQuestionSetting($load_question_bank->question_setting);
							$obj_qbank->update();
						//}
						

						$output['success'] 	="Updated";		 
					
				}
			}
		}
		 
	}else {
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die();
	
}

add_action('wp_ajax_SQBget_questions_with_category_mapping', 'SQBget_questions_with_category_mapping');
function SQBget_questions_with_category_mapping(){
	if (isset($_POST['quiz_id'])) {
    $quiz_id = $_POST['quiz_id'];
    $cat_data = sqb_get_questions_with_cat_mapping($quiz_id);
    $all_data = "";

    if (!empty($cat_data)) {
	    $all_data .= '<div class="sqb-category-question-container"><h5>Here you will find all the categories and the questions assigned to the categories for this quiz:</h5>'; 
	    
	    // First, handle categories with ID 0 (uncategorized questions)
	    foreach ($cat_data as $cat) {
	        if (isset($cat['category_id']) && $cat['category_id'] == 0) {
	            if (isset($cat['questions']) && !empty($cat['questions'])) {
	                $all_data .= '<div class="sqb-category-question-uncategorized">
	                                <h2 class="sqb-category-question-uncategorized-title">These questions do not have any categories assigned</h2>
	                                <ul class="sqb-category-question-list">';
	                foreach ($cat['questions'] as $question) {
	                    if (isset($question['question_title']) && !empty($question['question_title'])) {
	                        $question_title = $question['question_title'];
	                        $all_data .= '<li class="sqb-category-question-item">
	                                        <span class="sqb-category-question-title">' . stripslashes($question_title) . '</span>
	                                      </li>';
	                    }
	                }
	                $all_data .= '</ul></div>';
	            }
	        }
	    }

	    // Now handle the rest of the categories (ID != 0)
	    foreach ($cat_data as $cat) {
	        if (isset($cat['category_id']) && $cat['category_id'] != 0) {
	            $category_id = $cat['category_id'];
	            $category_data = SQB_QuizCategory::loadById($category_id);

	            $all_data .= '<div class="sqb-category-question-category">';

	            if (!empty($category_data)) {
	                $category_title = $category_data->getName();
	                $all_data .= '<h2 class="sqb-category-question-category-title">Category Name: ' . stripslashes($category_title) . '</h2>';
	            }

	            if (isset($cat['questions']) && !empty($cat['questions'])) {
	                $all_data .= '<h5>Questions Assigned to this Category:</h5><ul class="sqb-category-question-list">';
	                foreach ($cat['questions'] as $question) {
	                    if (isset($question['question_title']) && !empty($question['question_title'])) {
	                        $question_title = $question['question_title'];
	                        $all_data .= '<li class="sqb-category-question-item">
	                                        <span class="sqb-category-question-title">' . stripslashes($question_title) . '</span>
	                                      </li>';
	                    }
	                }
	                $all_data .= '</ul>';
	            } else {
	                $all_data .= "No questions found for this category.<br>";
	            }
	            $all_data .= '</div>';
	        }
	    }

	    $all_data .= '</div>';
	} else {
	    $all_data .= "No category data found.<br>";
	}


    echo json_encode(array('status' => 'success', 'data' => $all_data));  // Return the data as JSON
    die;
}

}

add_action('wp_ajax_sqb_load_all_quiz_question_ajax', 'SQBLoadAllQuizQuestionAjax');
add_action('wp_ajax_nopriv_sqb_load_all_quiz_question_ajax', 'SQBLoadAllQuizQuestionAjax'); 
function SQBLoadAllQuizQuestionAjax(){
	
	$output = array();

	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$quiz_details = SQB_QuizQuestions::loadByQuizIdOrderByQuestion($quiz_id);
		$question_ids = array();
		$has_data = 'N';
		foreach($quiz_details as $quiz_detail){
			$question_ids[] = $quiz_detail->getQuestionId();
		}

		$i = 0;
		$html = '';
		foreach($question_ids as $question_id){
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
			if($sqbquestionobj){
				$has_data = 'Y';
				
				$question_title = $sqbquestionobj->getQuestionTitle();
				$question_skip = $sqbquestionobj->getAllowSkipQues();
				$question_html = $sqbquestionobj->getQuestion();


				$dom = new DOMDocument();
				$dom->loadHTML($question_html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
				$xpath = new DOMXPath($dom);
				$imageDiv = $xpath->query("//*[contains(@class, 'sqb_question_drag_drop_item') and contains(@class, 'question_img_div')]")->item(0);
				$show_image = "";

								
				if ($imageDiv) {
				    $style = $imageDiv->getAttribute('style');
				    $imgElement = $xpath->query(".//img", $imageDiv)->item(0);
				    
				    // Normalize the style string by removing extra spaces
				    $style = trim(preg_replace('/\s+/', ' ', $style));
				    
				    if ((strpos($style, 'display: none') === false && strpos($style, 'display:none') === false) && $imgElement) {
					    $show_image = "checked";
					}
				}


				$show_checked = "";
				if($question_skip == 'N'){
					$show_checked = "checked";
				}

				$html .= '<div class="reArrange-list re_arrange_question_div" data-question-id="'.$question_id.'" >';
				$html .= '<i class="fa fa-arrows reArrange_sortable_icon" aria-hidden="true"></i>';
				$html .= '<h3>'.stripslashes($question_title).'</h3>';
				

				$html .= '<div class="question-options">
					            <div class="option-group">
					                <div class="option-toggle">
					                    <input type="checkbox" '.$show_checked.' id="required-'.$question_id.'" name="sqb_skip_question" class="toggle-checkbox">
					                    <label for="required-'.$question_id.'" class="toggle-label">
					                        <span class="toggle-text">Required</span>
					                        <div class="tool-tip">
					                            <i class="fa fa-info-circle" aria-hidden="true"></i>
					                            <div class="toll-tip-desc">
					                                If not required, SQB will show a skip button
					                            </div>
					                        </div>
					                    </label>
					                </div>
					                
					                <div class="option-toggle">
					                    <input type="checkbox" id="show-image-'.$question_id.'" name="sqb_show_question_image" '.$show_image.' class="toggle-checkbox">
					                    <label for="show-image-'.$question_id.'" class="toggle-label">
					                        <span class="toggle-text">Show Question Image</span>
					                    </label>
					                </div>
					            </div>
					        </div>';
				$html .= '</div>';
				
			}
		}
		
		$output['html'] = '<div class="sqb_questions_wrapper pl-3 pr-3 pt-2">'.$html.'</div>'; 
		$output['has_data'] = $has_data; 
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_load_all_quiz_question_ads_ajax', 'SQBLoadAllQuizQuestionAdsAjax');
add_action('wp_ajax_nopriv_sqb_load_all_quiz_question_ads_ajax', 'SQBLoadAllQuizQuestionAdsAjax'); 
function SQBLoadAllQuizQuestionAdsAjax(){
	
	$output = array();

	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$quiz_details = SQB_QuizQuestions::loadByQuizIdOrderByQuestion($quiz_id);
		$question_ids = array();
		$has_data = 'N';
		foreach($quiz_details as $quiz_detail){
			$question_ids[] = $quiz_detail->getQuestionId();
		}

		$i = 0;
		$html = '';
		foreach($question_ids as $question_id){
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
			if($sqbquestionobj){
				$has_data = 'Y';
				$quiz_question_obj = SQB_QuizQuestions::loadByQuestionIdNotArray($question_id); 					
				
				if(isset($quiz_question_obj) && $quiz_question_obj !=false){
					$showads = $quiz_question_obj->getShowAds();
					if($showads == 'Y'){
						$show_checked = "checked";
						$ads_diable = "";
					}else{
						$show_checked = "";
						$ads_diable = "disabled";
					}
					$ads_html = $quiz_question_obj->getQuestionAdsHtml();
					if($ads_html == 'NULL' || empty($ads_html)){
						$ads_html = sqbAddQuestionAdsHtml();
					}
				}
				$question_title = stripslashes($sqbquestionobj->getQuestionTitle());
				$html .= '<div class="card" data-question-id="'.$question_id.'">
							<div class="card-header" id="heading'.$i.'"><button '.$ads_diable.' class="btn btn-link ads-layout" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'"> '.$question_title.' </button>
								<div class="square-switch_onoff"> <input class="checkbox" name="ads_enable" type="checkbox" id="ads_enable_'.$i.'" value="Y" '.$show_checked.'> <label for="ads_enable_'.$i.'"></label> 
								</div><button '.$ads_diable.' class="btn btn-link" data-toggle="collapse" data-target="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'"><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
							</div>
							<div id="collapse'.$i.'" class="collapse" aria-labelledby="heading'.$i.'" data-parent="#accordion"><div class="card-body">
								'.stripslashes($ads_html).'
								</div>
							</div>
						</div>'; 
					$i++;
			}
		}

		$setting_question_ads_color = "rgba(255,255,255,1)";
		$screen_name = 'settings_background_color';
		$strm_type = 'settings';
		$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
		if($theme_data_has){
			$colorpickerdata = maybe_unserialize($theme_data_has->getValue());
			if(!empty($colorpickerdata["setting_question_ads_color"])){
				$setting_question_ads_color = $colorpickerdata["setting_question_ads_color"];
			}
		}

		$output['html'] = '<div class="sqb_questions_wrapper pl-3 pr-3 pt-2">'.$html.'</div>'; 
		$output['setting_question_ads_color'] = $setting_question_ads_color; 
		$output['has_data'] = $has_data; 
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}


function sqb_personality_quiz_import($quiz_id,$question_data_arr,$template,$question_order){
		$current_data_time =  date('Y-m-d H:i:s');
		$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
		// set variable for outcome table start
		$outcome_has = false;
		// set variable for question bank table start
		$question_bank_array = array();
		$qb_i = 0;
		
		foreach($question_data_arr as $question_data){//loop for Questions
		
		$multiple_correct_ans = 'N';
		if($question_data['question_type'] == 'multi'){
		$multiple_correct_ans = 'Y';
		}
		
			
		if($template == 'template5'){
			$sqb_img_folder_url_sample_folder = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/s1/";
			$question_data_html = '<div class="question_details" ><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body"><div><span style="font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">'.$question_data['question_title'].'</span></div></div></div>';
			$temp_customizer = '1406px||rgb(239, 217, 202)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-karolina-grabowska-5908822.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
		} else {
			$hide_image_button = '';
			if($template == 'template7'){
				$hide_image_button = 'style="display:none;"';
			}
			$question_data_html = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><div><strong>'.$question_data['question_title'].'</strong></div></div><span class="sqbHideQuesTemplateImageOuter" '.$hide_image_button.'><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627241409088_7698" style="display: none;"><span data-class="sbq_img_2021_6_1627241409088_7698" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style="display: none;"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;"><strong>'.$question_data['question_desc'].'</strong></span></div></div></div>';
			$temp_customizer = '822px';
		}

		$question_bank_array[$qb_i]['question_data'] = $question_data_html;
		
		$question_bank_array[$qb_i]['question_data'] = urlencode($question_bank_array[$qb_i]['question_data']);
		
		$question_bank_array[$qb_i]['question_title'] = $question_data['question_title'];//'How much do you want to charge?﻿';
		$question_bank_array[$qb_i]['question_type'] = $question_data['question_type'];//'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = $question_order;
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = $multiple_correct_ans;
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = $temp_customizer;
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		if($question_data['question_type'] == 'matrix'){
		$sqb_matrix_answer_html  = sqb_matrix_answer_html($sqb_datetime_rand);
		$question_bank_array[$qb_i]['matrix_labels_text'] = $sqb_matrix_answer_html['matrix_labels_text'];
		$question_bank_array[$qb_i]['matrix_html'] = $sqb_matrix_answer_html['matrix_html'];
		}
		// set answer for 4 index question start 
		
			$at_i = 0;
			$answer_table_array = array();
			foreach($question_data['question_answer_data'] as $answer_data){//loop for answer Choices
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
				if($question_data['question_type'] == 'text'){
					$answer_table_array[$at_i]['ans'] = sqb_textarea_answer_html($sqb_datetime_rand);
				}else if($question_data['question_type'] == 'numerical_text'){
					$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item ans_type_numeric_text" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sql_ans_text sqb_tiny_mce_editor"><div>'.urlencode($answer_data['answer_title']).'</div></div></div><div class="numeric-value-prefix"><div class="sqb_tiny_mce_editor numeric_value_prefix"><div></div></div><input type="number" min="0" max="100000" name="sqb_ans_'.$sqb_datetime_rand.'" title="Enter Value Here" class="form-control sqb_and_field"><div class="sqb_tiny_mce_editor numeric_value_sufix mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div></div></div></div></div>';
				} else if($question_data['question_type'] == 'slider'){
						$answer_table_array[$at_i]['ans'] = sqb_slider_answer_html($sqb_datetime_rand);
				} else if($question_data['question_type'] == 'file_upload'){
						$answer_table_array[$at_i]['ans'] = sqb_file_upload_answer_html($sqb_datetime_rand);
				} else if($question_data['question_type'] == 'matrix'){
						$answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(58, 103, 161);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor" style="color: rgb(33, 37, 41); position: relative;"><div style="color: #212529; position: relative;" data-mce-style="color: #212529; position: relative;">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
					  $answer_table_array[$at_i]['matrix_values'] = array(array('index' => 0,'answer_value' => 0),
																			array('index' => 1,'answer_value' => 0),
																			array('index' => 2,'answer_value' => 0),
																			array('index' => 3,'answer_value' => 0),
																			array('index' => 4,'answer_value' => 0));
				} else {
				$ans_type_rating_cls = '';	
				if($question_data['question_type'] == 'rating'){
				$ans_type_rating_cls = ' ans_type_rating ';
				}
				$ans_type_ranking_choices_cls = '';
				if($question_data['question_type'] == 'ranking_choices'){
				$ans_type_ranking_choices_cls = ' ans_type_ranking_choices ';
				}
				
				$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item '.$ans_type_rating_cls.' '.$ans_type_ranking_choices_cls.'" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">'.$answer_data['answer_title'].'</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
				}
			
			$answer_table_array[$at_i]['answer_title'] = $answer_data['answer_title'];//'I do not want to charge yet.';
			$answer_table_array[$at_i]['correct_ans'] = $answer_data['correct_ans'];//'N';
			$answer_table_array[$at_i]['ans_point'] = $answer_data['ans_point'];//'0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = !empty($answer_data['answer_order']) ? $answer_data['answer_order'] : '';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][0])){
					$coutcome_selected_ids[] = $outcome_output['ids'][0];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i++;
		}
		// set answer for 4 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		$qb_i++;
		$question_order++;
	}
	// set variable for question bank table end 
		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_id;
		$quiz_details_question['id'] =  $quiz_id;
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		$quiz_details_question['createType'] = 'csvimport';
		return $question_details = SQBSaveQuizAjax($quiz_details_question);
} 

function sqb_assessment_quiz_import($quiz_id,$question_data_arr,$template,$question_order){
	
		$current_data_time =  date('Y-m-d H:i:s');
		$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
		// set variable for outcome table start
		$outcome_has = false;
		// set variable for question bank table start
		$question_bank_array = array();
		$qb_i = 0;
		
		
		foreach($question_data_arr as $question_data){//loop for Questions
		
		$multiple_correct_ans = 'N';
		if($question_data['question_type'] == 'multi'){
		$multiple_correct_ans = 'Y';
		}
			
		if($template == 'template5'){
			$sqb_img_folder_url_sample_folder = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/s1/";
			$question_data_html = '<div class="question_details" ><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body"><div><span style="font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">'.$question_data['question_title'].'</span></div></div></div>';
			$temp_customizer = '1406px||rgb(239, 217, 202)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-karolina-grabowska-5908822.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
		} else {
				
			$question_data_html = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>'.$question_data['question_title'].'</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'includes/images/sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>'.$question_data['question_desc'].'</div></div> </div>';
			$temp_customizer = '822px';
		}
		
		$question_bank_array[$qb_i]['question_data'] = $question_data_html;
		$question_bank_array[$qb_i]['question_data'] = urlencode($question_bank_array[$qb_i]['question_data']);
		$question_bank_array[$qb_i]['question_title'] = $question_data['question_title'];//'You wake up in the middle of the night...'
		$question_bank_array[$qb_i]['question_type'] = $question_data['question_type'];//'single'
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = $question_order;
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = $multiple_correct_ans;
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = $temp_customizer;
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		if($question_data['question_type'] == 'matrix'){
		$sqb_matrix_answer_html  = sqb_matrix_answer_html($sqb_datetime_rand);
		$question_bank_array[$qb_i]['matrix_labels_text'] = $sqb_matrix_answer_html['matrix_labels_text'];
		$question_bank_array[$qb_i]['matrix_html'] = $sqb_matrix_answer_html['matrix_html'];
		}
		// set answer for 0 index question start
		    $at_i = 0;
		    $answer_table_array = array();
		    $flag = 0;
		    
		    foreach($question_data['question_answer_data'] as $answer_data){//loop for answer Choices
			
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$correct_ans = 'N';
			$checked_status = '';
			if($answer_data['correct_ans'] == 'Y' && $flag < 1){
				$correct_ans = 'true';
				$checked_status = 'checked="checked"';
				
				if($question_data['question_type'] == 'single'){
					$flag++;
				}
			}
			
			if($question_data['question_type'] == 'text'){
					$answer_table_array[$at_i]['ans'] = sqb_textarea_answer_html($sqb_datetime_rand);
			} else if($question_data['question_type'] == 'numerical_text'){
					$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item ans_type_numeric_text" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sql_ans_text sqb_tiny_mce_editor"><div>'.urlencode($answer_data['answer_title']).'</div></div></div><div class="numeric-value-prefix"><div class="sqb_tiny_mce_editor numeric_value_prefix"><div></div></div><input type="number" min="0" max="100000" name="sqb_ans_'.$sqb_datetime_rand.'" title="Enter Value Here" class="form-control sqb_and_field"><div class="sqb_tiny_mce_editor numeric_value_sufix mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div></div></div></div></div>';
			}else if($question_data['question_type'] == 'slider'){
					$answer_table_array[$at_i]['ans'] = sqb_slider_answer_html($sqb_datetime_rand);
			} else if($question_data['question_type'] == 'file_upload'){
					$answer_table_array[$at_i]['ans'] = sqb_file_upload_answer_html($sqb_datetime_rand);
			} else if($question_data['question_type'] == 'matrix'){
					$answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(58, 103, 161);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor" style="color: rgb(33, 37, 41); position: relative;"><div style="color: #212529; position: relative;" data-mce-style="color: #212529; position: relative;">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
					  $answer_table_array[$at_i]['matrix_values'] = array(array('index' => 0,'answer_value' => 0),
																			array('index' => 1,'answer_value' => 0),
																			array('index' => 2,'answer_value' => 0),
																			array('index' => 3,'answer_value' => 0),
																			array('index' => 4,'answer_value' => 0));
			} else {
			
			$ans_type_rating_cls = '';	
			if($question_data['question_type'] == 'rating'){
			$ans_type_rating_cls = ' ans_type_rating ';
			}
			$ans_type_ranking_choices_cls = '';
			if($question_data['question_type'] == 'ranking_choices'){
			$ans_type_ranking_choices_cls = ' ans_type_ranking_choices ';
			}
				
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item '.$ans_type_rating_cls.' '.$ans_type_ranking_choices_cls.'" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" ><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">'.$answer_data['answer_title'].'</span></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" checked name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1" '.$checked_status.'> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			}
			
			$answer_table_array[$at_i]['answer_title'] = $answer_data['answer_title'];//'You pick up your phone - watch videos, check social feed, text friends, etc. You don\'t think about work.';
			$answer_table_array[$at_i]['correct_ans'] = $correct_ans;//'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = $answer_data['answer_order'];//'0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$at_i++;
		}	
	// set answer for zero index question end
	$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
	$qb_i++;
	$question_order++;
	}
			
	// set variable for question bank table end 
		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_id;
		$quiz_details_question['id'] =  $quiz_id;
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		$quiz_details_question['createType'] = 'csvimport';
		return $question_details = SQBSaveQuizAjax($quiz_details_question);
} 

function sqb_survey_quiz_import($quiz_id,$question_data_arr,$template,$question_order){
		$current_data_time =  date('Y-m-d H:i:s');
		$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
		// set variable for outcome table start
		$outcome_has = false;
		// set variable for question bank table start
		$question_bank_array = array();
		$qb_i = 0;
		
		foreach($question_data_arr as $question_data){//loop for Questions
		
		$multiple_correct_ans = 'N';
		if($question_data['question_type'] == 'multi'){
		$multiple_correct_ans = 'Y';
		}
			
		if($template == 'template5'){
			$sqb_img_folder_url_sample_folder = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/s1/";
			$question_data_html = '<div class="question_details" ><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body"><div><span style="font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">'.$question_data['question_title'].'</span></div></div></div>';
			$temp_customizer = '1406px||rgb(239, 217, 202)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-karolina-grabowska-5908822.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
		} else {	
			$question_data_html = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><div><strong>'.$question_data['question_title'].'</strong></div></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627241409088_7698" style="display: none;"><span data-class="sbq_img_2021_6_1627241409088_7698" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style="display: none;"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;"><strong>'.$question_data['question_desc'].'</strong></span></div></div></div>';
			$temp_customizer = '822px';
		}
		
		$question_bank_array[$qb_i]['question_data'] = $question_data_html;
		$question_bank_array[$qb_i]['question_data'] = urlencode($question_bank_array[$qb_i]['question_data']);
		$question_bank_array[$qb_i]['question_title'] = $question_data['question_title'];//'How much do you want to charge?﻿';
		$question_bank_array[$qb_i]['question_type'] = $question_data['question_type'];//'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = $question_order;
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = $multiple_correct_ans;
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = $temp_customizer;
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		if($question_data['question_type'] == 'matrix'){
		$sqb_matrix_answer_html  = sqb_matrix_answer_html($sqb_datetime_rand);
		$question_bank_array[$qb_i]['matrix_labels_text'] = $sqb_matrix_answer_html['matrix_labels_text'];
		$question_bank_array[$qb_i]['matrix_html'] = $sqb_matrix_answer_html['matrix_html'];
		}
		// set answer for 4 index question start 
		
			$at_i = 0;
			$answer_table_array = array();
			foreach($question_data['question_answer_data'] as $answer_data){//loop for answer Choices
				$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
				$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
				
				if($question_data['question_type'] == 'text'){
				$answer_table_array[$at_i]['ans'] = sqb_textarea_answer_html($sqb_datetime_rand);
				}else if($question_data['question_type'] == 'numerical_text'){
					$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item ans_type_numeric_text" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sql_ans_text sqb_tiny_mce_editor"><div>'.urlencode($answer_data['answer_title']).'</div></div></div><div class="numeric-value-prefix"><div class="sqb_tiny_mce_editor numeric_value_prefix"><div></div></div><input type="number" min="0" max="100000" name="sqb_ans_'.$sqb_datetime_rand.'" title="Enter Value Here" class="form-control sqb_and_field"><div class="sqb_tiny_mce_editor numeric_value_sufix mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div></div></div></div></div>';
				} else if($question_data['question_type'] == 'slider'){
						$answer_table_array[$at_i]['ans'] = sqb_slider_answer_html($sqb_datetime_rand);
				} else if($question_data['question_type'] == 'file_upload'){
						$answer_table_array[$at_i]['ans'] = sqb_file_upload_answer_html($sqb_datetime_rand);
				} else if($question_data['question_type'] == 'matrix'){
					  $answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(58, 103, 161);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor" style="color: rgb(33, 37, 41); position: relative;"><div style="color: #212529; position: relative;" data-mce-style="color: #212529; position: relative;">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
					  $answer_table_array[$at_i]['matrix_values'] = array(array('index' => 0,'answer_value' => 0),
																			array('index' => 1,'answer_value' => 0),
																			array('index' => 2,'answer_value' => 0),
																			array('index' => 3,'answer_value' => 0),
																			array('index' => 4,'answer_value' => 0));
				} else {
				$ans_type_rating_cls = '';	
				if($question_data['question_type'] == 'rating'){
				$ans_type_rating_cls = ' ans_type_rating ';
				}
				$ans_type_ranking_choices_cls = '';
				if($question_data['question_type'] == 'ranking_choices'){
				$ans_type_ranking_choices_cls = ' ans_type_ranking_choices ';
				}
				$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item '.$ans_type_rating_cls.' '.$ans_type_ranking_choices_cls.'" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">'.$answer_data['answer_title'].'</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
				}
				
				$answer_table_array[$at_i]['answer_title'] = $answer_data['answer_title'];//'I do not want to charge yet.';
				$answer_table_array[$at_i]['correct_ans'] = $answer_data['correct_ans'];//'N';
				$answer_table_array[$at_i]['ans_point'] = $answer_data['ans_point'];//'0';
				$answer_table_array[$at_i]['ans_hint'] = '';
				$answer_table_array[$at_i]['ans_info'] = '';
				$answer_table_array[$at_i]['answer_order'] = !empty($answer_data['answer_order']) ? $answer_data['answer_order'] : '';
				$answer_table_array[$at_i]['date'] = $current_data_time;
				
				if($outcome_has){
					$coutcome_selected_ids = array();
					if(isset($outcome_output['ids']) && isset($outcome_output['ids'][0])){
						$coutcome_selected_ids[] = $outcome_output['ids'][0];
					}
					
					$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
					$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
					$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
					$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
					$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
				}
				$at_i++;
			}
			// set answer for 4 index question end 
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			$qb_i++;
			$question_order++;
		}
		// set variable for question bank table end 
		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_id;
		$quiz_details_question['id'] =  $quiz_id;
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		$quiz_details_question['createType'] = 'csvimport';
		return $question_details = SQBSaveQuizAjax($quiz_details_question);
}
 
function sqb_scorong_quiz_import($quiz_id,$question_data_arr,$template,$question_order){
		$current_data_time =  date('Y-m-d H:i:s');
		$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
		// set variable for outcome table start
		$outcome_has = false;
		// set variable for question bank table start
		$question_bank_array = array();
		$qb_i = 0;
		foreach($question_data_arr as $question_data){//loop for Questions
		
		$multiple_correct_ans = 'N';
		if($question_data['question_type'] == 'multi'){
		$multiple_correct_ans = 'Y';
		}
			
		if($template == 'template5'){
			$sqb_img_folder_url_sample_folder = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/s1/";
			$question_data_html = '<div class="question_details" ><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body"><div><span style="font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">'.$question_data['question_title'].'</span></div></div></div>';
			$temp_customizer = '1406px||rgb(239, 217, 202)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-karolina-grabowska-5908822.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
		} else {
			$question_data_html = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>'.$question_data['question_title'].'</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'includes/images/sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>'.$question_data['question_desc'].'</div></div> </div>'; 
			$temp_customizer = '822px';
		}
		
		$question_bank_array[$qb_i]['question_data'] = $question_data_html;
		$question_bank_array[$qb_i]['question_data'] = urlencode($question_bank_array[$qb_i]['question_data']);
		
		$question_bank_array[$qb_i]['question_title'] = $question_data['question_title'];//'You wake up in the middle of the night...'
		$question_bank_array[$qb_i]['question_type'] = $question_data['question_type'];//'single'
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = $question_order;
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = $multiple_correct_ans;
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = $temp_customizer;
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		if($question_data['question_type'] == 'matrix'){
		$sqb_matrix_answer_html  = sqb_matrix_answer_html($sqb_datetime_rand);
		$question_bank_array[$qb_i]['matrix_labels_text'] = $sqb_matrix_answer_html['matrix_labels_text'];
		$question_bank_array[$qb_i]['matrix_html'] = $sqb_matrix_answer_html['matrix_html'];
		}
		// set answer for 0 index question start
		    $at_i = 0;
		    $answer_table_array = array();
		    $flag = 0;
		    foreach($question_data['question_answer_data'] as $answer_data){//loop for answer Choices
			
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$correct_ans = 'N';
			$checked_status = '';
			if($answer_data['correct_ans'] == 'Y' && $flag < 1){
			$correct_ans = 'true';
			$checked_status = 'checked="checked"';
			if($question_data['question_type'] == 'single'){
					$flag++;
				}
			}
				
			if($question_data['question_type'] == 'text'){
					$answer_table_array[$at_i]['ans'] = sqb_textarea_answer_html($sqb_datetime_rand);
			}else if($question_data['question_type'] == 'numerical_text'){
					$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item ans_type_numeric_text" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sql_ans_text sqb_tiny_mce_editor"><div>'.urlencode($answer_data['answer_title']).'</div></div></div><div class="numeric-value-prefix"><div class="sqb_tiny_mce_editor numeric_value_prefix"><div></div></div><input type="number" min="0" max="100000" name="sqb_ans_'.$sqb_datetime_rand.'" title="Enter Value Here" class="form-control sqb_and_field"><div class="sqb_tiny_mce_editor numeric_value_sufix mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div><div class="answer_level_dot_button sqb_ans_disable_dds numeric-correct-outer"><div class="dropdown-link-style dropdown"> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel" x-placement="bottom-start"><div class="show-numeric-points"><strong><label class="mb-2">Points <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc">Users will be assigned points for correct answer. If there are no points, leave empty</div> </div></label></strong><input type="number" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="'.$answer_data['ans_point'].'"></div><div class="numeric-correct-answer mt-2"><label class="mb-2"><strong>Correct Answer Value <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc">The answer users enter will be matched against this value and only if it matches, they will be assigned points for the correct answer.</div> </div></strong></label><input type="number" name="numeric_correct_answer" title="Correct Answer Value" class="correct_answer" value="'.$answer_data['correct_ans'].'"></div></div></div></div></div></div></div></div>';
			} else if($question_data['question_type'] == 'slider'){
					$answer_table_array[$at_i]['ans'] = sqb_slider_answer_html($sqb_datetime_rand);
			} else if($question_data['question_type'] == 'file_upload'){
					$answer_table_array[$at_i]['ans'] = sqb_file_upload_answer_html($sqb_datetime_rand);
			} else if($question_data['question_type'] == 'matrix'){
					 $answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(58, 103, 161);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor" style="color: rgb(33, 37, 41); position: relative;"><div style="color: #212529; position: relative;" data-mce-style="color: #212529; position: relative;">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
					  $answer_table_array[$at_i]['matrix_values'] = array(array('index' => 0,'answer_value' => 0),
																			array('index' => 1,'answer_value' => 0),
																			array('index' => 2,'answer_value' => 0),
																			array('index' => 3,'answer_value' => 0),
																			array('index' => 4,'answer_value' => 0));
				} else { 	
					$ans_type_rating_cls = '';	
					if($question_data['question_type'] == 'rating'){
					$ans_type_rating_cls = ' ans_type_rating ';
					}
					$ans_type_ranking_choices_cls = '';
					if($question_data['question_type'] == 'ranking_choices'){
					$ans_type_ranking_choices_cls = ' ans_type_ranking_choices ';
					}
					
					$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item '.$ans_type_rating_cls.' '.$ans_type_ranking_choices_cls.'" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" ><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">'.$answer_data['answer_title'].'</span></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1" '.$checked_status.'> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="'.$answer_data['ans_point'].'"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
				}
			
			$answer_table_array[$at_i]['answer_title'] = $answer_data['answer_title'];//'You pick up your phone - watch videos, check social feed, text friends, etc. You don\'t think about work.';
			if($question_data['question_type'] == 'numerical_text'){
				$answer_table_array[$at_i]['numeric_correct_answer'] = $answer_data['correct_ans']; 
			}
			$answer_table_array[$at_i]['correct_ans'] = $correct_ans;//'N'; 
			$answer_table_array[$at_i]['ans_point'] = $answer_data['ans_point'];//'-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = $answer_data['answer_order'];//'0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$at_i++;
		}	
	// set answer for zero index question end

	$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
	$qb_i++;
	$question_order++;
	}
			
	// set variable for question bank table end 
		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_id;
		$quiz_details_question['id'] =  $quiz_id;
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		$quiz_details_question['createType'] = 'csvimport';
		
		return $question_details = SQBSaveQuizAjax($quiz_details_question);
}


function sqb_textarea_answer_html($sqb_datetime_rand){
$html = '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="Enter the text here"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
return $html;
}

function sqb_numerical_text_answer_html($sqb_datetime_rand){
$html = '<div class="sqb_ans_item ans_type_numeric_text" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_35" contenteditable="true" style="position: relative;" spellcheck="false"><div>'.$answer_data['answer_title'].'</div></div></div><div class="numeric-value-prefix"><div class="sqb_tiny_mce_editor numeric_value_prefix mce-content-body" id="mce_36" contenteditable="true" style="position: relative;" spellcheck="false"><div>$</div></div><input type="number" min="0" max="100000" name="sqb_ans_'.$sqb_datetime_rand.'" title="Enter Value Here" class="form-control sqb_and_field"><div class="sqb_tiny_mce_editor numeric_value_sufix mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div>%</div></div></div></div>';
return $html;
}

function sqb_slider_answer_html($sqb_datetime_rand){
$html = '<div class="sqb_ans_item sqb_ans_item_slider" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><span class="answer_slider_options_show sqb_backend_show ">Click to customize</span> <div class="type-slider-outer"><input name="sqb_ans_'.$sqb_datetime_rand.'" id="sqb_ans_slider_'.$sqb_datetime_rand.'" class="slider sqb_ans_slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="0" top_box_b_clr="#059e4b" suffix_text="" prefix_text="" complete_bar_b_clr="#263af0" slider_b_clr="#ffffff" style="display: none;" data-value="0" value="0"><div class="slider_label sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_39"><div class="slider_label_start" style="text-align: left;" data-mce-style="text-align: left;"><strong>0</strong></div><div class="slider_label_middle" style="text-align: center;" data-mce-style="text-align: center;"><strong>500</strong></div><div class="slider_label_end" style="text-align: right;" data-mce-style="text-align: right;"><strong>1000</strong></div></div></div><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
return $html;
}
					
function sqb_file_upload_answer_html($sqb_datetime_rand){
$html = '<div class="sqb_ans_item file-upload-wrapper" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="padding: 0px"><div class="file-upload"><div class="file-upload-message"><i class="fa fa-cloud-upload" aria-hidden="true"></i><div class="sqb_tiny_mce_editor">Drag and drop a file here or click</div><p class="file-upload-error">Ooops, something wrong happended.</p></div><input type="file" name="sqb_file_upload" class="sqb_file_upload"><div class="file-upload-preview"><span class="file-upload-render"><img class="file-upload-preview-img" src=""></span><div class="file-upload-infos"><div class="file-upload-infos-inner"><p class="file-upload-filename"><span class="file-upload-filename-inner">about.jpg</span></p><p class="file-upload-infos-message">Drag and drop or click to replace</p></div></div></div></div><label class="uploadedFileName1 uploadedFileNamePre" style="display:none"></label></div>';
return $html;
}

function sqb_matrix_answer_html($sqb_datetime_rand){
	$html = array();
	$html['matrix_html'] = '<!--<div class="sqb_ans_item_matrix"><span class="answer_matrix_options_show sqb_backend_show ">Click To Add/Edit Answer</span>--><div class="answer_matrix_save_table">
	<table class="SQB-main-table show_value_matrix_box">
					<thead>
					  <tr>
						<th class="SQB-fixed-side" scope="col">&nbsp;</th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor" ><div>Extremely satisfied</div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor" ><div>Somewhat satisfied</div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor" ><div>Neither satisfied nor dissatisfied</div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor" ><div>Somewhat dissatisfied</div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor" ><div>Extremely dissatisfied</div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col"></th>
					  </tr>
					</thead>
					<tbody>
					  	<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'_1" style="background: rgb(229, 241, 255);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); position: relative;" id="mce_62" contenteditable="true" spellcheck="false"><div style="position: relative; color: rgb(51, 51, 51);">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'_1"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'_2" style="background: rgb(229, 241, 255);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); position: relative;" id="mce_63" contenteditable="true" spellcheck="false"><div style="position: relative; color: rgb(51, 51, 51);">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'_2"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'_3" style="background: rgb(229, 241, 255);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); position: relative;" id="mce_64" contenteditable="true" spellcheck="false"><div style="position: relative; color: rgb(51, 51, 51);">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'_3"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'_4" style="background: rgb(229, 241, 255);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); position: relative;" id="mce_65" contenteditable="true" spellcheck="false"><div style="position: relative; color: rgb(51, 51, 51);">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'_5"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'_5" style="background: rgb(229, 241, 255);">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); position: relative;" id="mce_66" contenteditable="true" spellcheck="false"><div style="position: relative; color: rgb(51, 51, 51);">Type Answer Here</div></div></th>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="0" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'_5"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					</tbody>
			</table>
</div></div>';
$html['matrix_labels_text'] = array(
									array('index'=>0,'matrix_label_text'=>'<div class="sqb_tiny_mce_editor"><div class="sqb_tiny_mce_editor">Extremely satisfied</div></div>'),
									array('index'=>0,'matrix_label_text'=>'<div class="sqb_tiny_mce_editor"><div class="sqb_tiny_mce_editor">Somewhat satisfied</div></div>'),
									array('index'=>0,'matrix_label_text'=>'<div class="sqb_tiny_mce_editor"><div class="sqb_tiny_mce_editor">Neither satisfied nor dissatisfied</div></div>'),
									array('index'=>0,'matrix_label_text'=>'<div class="sqb_tiny_mce_editor"><div class="sqb_tiny_mce_editor">Somewhat dissatisfied</div></div>'),
									array('index'=>0,'matrix_label_text'=>'<div class="sqb_tiny_mce_editor"><div class="sqb_tiny_mce_editor">Extremely dissatisfied</div></div>'));
return $html;
}

function sqbclean($string) {
   $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function SQButoUTFConvert($s){
    // detect UTF-8
    if (preg_match('#[\x80-\x{1FF}\x{2000}-\x{3FFF}]#u', $s)){
        return $s;
	}
	if(function_exists('iconv')){
		// detect WINDOWS-1250
		if (preg_match('#[\x7F-\x9F\xBC]#', $s)){
			return iconv('WINDOWS-1250', 'UTF-8', $s);
		}
		// assume ISO-8859-2
		return iconv('ISO-8859-2', 'UTF-8', $s);	
	}
	return $s;
}

add_action('wp_ajax_sqb_import_csv', 'sqb_import_csv');
add_action('wp_ajax_nopriv_sqb_import_csv', 'sqb_import_csv');
function sqb_import_csv(){
	//header("Content-Type: text/html; charset=ISO-8859-1");
	// Allowed mime types
	if ( !current_user_can( 'manage_options' ) ) {
        return json_encode(array('error' => 'Not allowed to access'));die;  
    }
    check_admin_referer('sqb_import_csv', 'security');

	
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');	
	$fileName = $_FILES["file"]["tmp_name"];
	$question_data_arr = array();
	$question_answer_data = array();
	$notvalid = false;
	$question_type_arr = array('single_choice','multiple_choice','yes_no','text','rating','slider','ranking_choice','file_upload','matrix','numerical_text');
	$ignore_answer_title_arr = array('text','slider','file_upload','matrix');
	$allowed_correct_ans = array('Y','N');
	
	
	
	//matrix,file_upload,fill_in_blank
	$error_message = 'Your CSV format is invalid. <br>';
	$quiz_type = '';
	
	$quiz_id = $_POST['quiz_id'];
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	if(isset($quiz_obj)){
		$quiz_type = $quiz_obj->getQuizType();
		/*$personality_required_fields = array();
		$assessment_required_fields = array();
		$scoring_required_fields = array();
		$survey_required_fields = array();
		for($loop=1;$loop<=50;$loop++){
			$scoring_required_fields[] = 'Answer'.$loop;
			$scoring_required_fields[] = 'Correct Answer'.$loop;
			$scoring_required_fields[] = 'Points Answer'.$loop;
			
			$assessment_required_fields[] = 'Answer'.$loop;
			$assessment_required_fields[] = 'Correct Answer'.$loop;
			
			$personality_required_fields[] = 'Answer'.$loop;
			$survey_required_fields[] = 'Answer'.$loop;
		}*/
	}
	
	$authenticated = false;
	if ( is_user_logged_in() && current_user_can('administrator') ) {
	$authenticated = true;
	}
	if($authenticated){
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
			$file_header_row = fopen($fileName, "r");
			
			$csv_heading_names_static_scoring = array('QuestionType','QuestionText','Description','Answer1','Correct Answer1','Points Answer1');
			$csv_heading_names_static_assesment = array('QuestionType','QuestionText','Description','Answer1','Correct Answer1');
			$csv_heading_names_static_personality = array('QuestionType','QuestionText','Description','Answer1');
			$csv_heading_names_static_survey = array('QuestionType','QuestionText','Description','Answer1');
			$csv_heading_names_static_for_validation = array('questiontype','questiontext','description');
			$csv_names_static_actual_heading = array('questiontype' => 'QuestionType','questiontext' => 'QuestionText','description'=>'Description','answer1' => 'Answer1');
			
			
			$get_csv_heading_names_with_key_validation = array();
			$get_csv_heading_names_with_key = array();
			
			$heading_column_index = 0;
			$csv_total_no_of_ans = 0;
			$csv_ans_order_array = array();
			$csv_ans_order_array = array();
			$csv_ans_correct_order_array = array();
			$csv_ans_point_order_array = array();
			while (($columns_info = fgetcsv($file_header_row, 10000, ",")) !== FALSE) {
					foreach($columns_info as $column_name){
						
						$column_name = strtolower(sqbclean(trim($column_name)));
						
						if(in_array($column_name,$csv_heading_names_static_for_validation)){
							$get_csv_heading_names_with_key_validation[$heading_column_index] = $column_name;
						}
						$get_csv_heading_names_with_key[$column_name] = $heading_column_index;
						$answer_column_index_no = (int)substr($column_name, strpos($column_name, 'answer') + 6);  
						if (strpos($column_name, 'correctanswer') !== false && (strpos($column_name, 'correctanswer') == 0)) {
							$csv_ans_correct_order_array[$answer_column_index_no] = $heading_column_index;
						}else if (strpos($column_name, 'pointsanswer') !== false && (strpos($column_name, 'pointsanswer') == 0)) {
							$csv_ans_point_order_array[$answer_column_index_no] = $heading_column_index;
						}else if (strpos($column_name, 'correct answer') !== false && (strpos($column_name, 'correct answer') == 0)) {
							$csv_ans_correct_order_array[$answer_column_index_no] = $heading_column_index;
						}else if (strpos($column_name, 'points answer') !== false && (strpos($column_name, 'points answer') == 0)) {
							$csv_ans_point_order_array[$answer_column_index_no] = $heading_column_index;
							
						}else if (strpos($column_name, 'answer') !== false && (strpos($column_name, 'answer') == 0)) {
							
							$csv_total_no_of_ans = $csv_total_no_of_ans + 1;
							$csv_ans_order_array[$answer_column_index_no] = $heading_column_index;
						}
						
						$heading_column_index++;
					}
					break;
			}
			fclose($file_header_row);
			
			foreach($csv_heading_names_static_for_validation as $csv_heading_name_static){
				if(!in_array($csv_heading_name_static,$get_csv_heading_names_with_key_validation)){
					
					if($csv_names_static_actual_heading[$csv_heading_name_static]){
						$csv_heading_name_static = $csv_names_static_actual_heading[$csv_heading_name_static];
					}
										
					$error_message .= "Invalid data: Missing Column1: <strong>".$csv_heading_name_static.'<strong><br>';
					$notvalid = true;
				}
			}
			
			
			if(!$notvalid){
				$file = fopen($fileName, "r");
				
				$row = 1;
				$i = 0;
				$j = 0;
				
				while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
					
				        if($row == 1){ // skip first row of csv file
							$row++;
						   continue;
					    }
					    
					    $all_values_empty = true;
					    foreach($column as $columns){
							if($columns != ''){
								 $all_values_empty = false;
							}
						}
						
						if($all_values_empty){
							continue;
						}
						
						if($column[0] == '' || $column[1] == ''){
						continue;
						}
						
					    $question_type_index = $get_csv_heading_names_with_key['questiontype'];
					    $question_text_index = $get_csv_heading_names_with_key['questiontext'];
					    $question_description_index = $get_csv_heading_names_with_key['description'];
					    $question_answer1_index = '';
					    if(is_array($csv_ans_order_array) && count($csv_ans_order_array)){
							$question_answer1_index = $csv_ans_order_array[1];
						}
						
						$question_type =  $column[$question_type_index];
					   
						if(!in_array(trim($column[$question_type_index]),$question_type_arr) || trim($column[$question_type_index]) == ''){
							$error_message = "Invalid data. Missing question type for this quiz.";
							$notvalid = true;
							break;
						}
						if($column[$question_text_index] == ''){
							$error_message = "Invalid data. Missing question title for this quiz.";
							$notvalid = true;
							break;
						}
						
						if(($quiz_type == 'assessment' || $quiz_type == 'scoring') && ($column[$question_type_index] == 'rating' || $column[$question_type_index] == 'ranking_choice')){
						continue;//rating,ranking_choices is not allowed in assessment,scoring
						}
						
						if($column[$question_type_index] == 'multiple_choice'){ $question_type = 'multi'; }
						if($column[$question_type_index] == 'single_choice'){ $question_type = 'single'; }
						if($column[$question_type_index] == 'rating'){ $question_type = 'rating'; }
						if($column[$question_type_index] == 'ranking_choice'){ $question_type = 'ranking_choices'; }
						if($column[$question_type_index] == 'yes_no'){ $question_type = 'yes_no'; }
						if($column[$question_type_index] == 'text'){ $question_type = 'text'; }
						if($column[$question_type_index] == 'slider'){ $question_type = 'slider'; }
						if($column[$question_type_index] == 'numerical_text'){ $question_type = 'numerical_text'; }
						if($column[$question_type_index] == 'file_upload'){
							if (function_exists('finfo_open')) {
							} else {
								continue;
							}
							$question_type = 'file_upload'; 
						}
						
						if($column[$question_type_index] == 'matrix'){ $question_type = 'matrix'; continue; }
						
						if($column[$question_type_index] == 'multiple_choice' || $column[$question_type_index] == 'single_choice' || $column[$question_type_index] == 'rating' || $column[$question_type_index] == 'ranking_choice'){
							
							$question_data_arr[$i]['question_type'] = trim($question_type);
							$question_data_arr[$i]['question_title'] = SQButoUTFConvert($column[$question_text_index]);
							$question_data_arr[$i]['question_desc'] = $column[$question_description_index];
							
							if($column[$question_answer1_index] == ''){
								$error_message = "Please add answer text in the CSV for this question to proceed.";
								$notvalid = true;
								break;
							}
							
							$answer_title = '';$correct_ans = '';$ans_point = '';
							foreach($csv_ans_order_array as $csv_ans_order_single_key => $csv_ans_order_single){
								$answer_title = '';
								$correct_ans = '';
								$ans_point = '';
								
								if(isset($column[$csv_ans_order_single])){
									$answer_title = $column[$csv_ans_order_single];
								}
								
								
								if(isset($column[$csv_ans_correct_order_array[$csv_ans_order_single_key]])){
									$correct_ans = $column[$csv_ans_correct_order_array[$csv_ans_order_single_key]];
								}
								
								if(isset($column[$csv_ans_point_order_array[$csv_ans_order_single_key]])){
									$ans_point = $column[$csv_ans_point_order_array[$csv_ans_order_single_key]];
								}
								
							
								if($answer_title != ''){	
									$answer_and_points = sqb_get_correct_ans_and_points($allowed_correct_ans,$correct_ans,$ans_point);
									$correct_ans = $answer_and_points[0];
									$ans_point = $answer_and_points[1];	
										
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['answer_title'] = $answer_title;
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['correct_ans'] = $correct_ans;
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['ans_point'] = $ans_point;
								}
									
							}
						
							
							
							
						}
						
						if($column[$question_type_index] == 'yes_no'){
							if($column[$question_answer1_index] == ''){
								$error_message = "Please add answer text in the CSV for this question to proceed.";
								$notvalid = true;
								break;
							}
							
							if($column[$question_answer1_index] != ''){
								
							$question_data_arr[$i]['question_type'] = $question_type;
							$question_data_arr[$i]['question_title'] = SQButoUTFConvert($column[$question_text_index]);
							$question_data_arr[$i]['question_desc'] = $column[$question_description_index];
							$answer_title = '';$correct_ans = '';$ans_point = '';
							$question_type_yes_no_ans_limit_count = 0;
							foreach($csv_ans_order_array as $csv_ans_order_single_key => $csv_ans_order_single){
								if($question_type_yes_no_ans_limit_count == 2){
									break;
								}
								$answer_title = '';
								$correct_ans = '';
								$ans_point = '';
								
								if(isset($column[$csv_ans_order_single])){
									$answer_title = $column[$csv_ans_order_single];
								}
								
								
								if(@isset($column[$csv_ans_correct_order_array[$csv_ans_order_single_key]])){
									$correct_ans = $column[$csv_ans_correct_order_array[$csv_ans_order_single_key]];
								}
								
								if(@isset($column[$csv_ans_point_order_array[$csv_ans_order_single_key]])){
									$ans_point = $column[$csv_ans_point_order_array[$csv_ans_order_single_key]];
								}
								
							
								if($answer_title != ''){	
									$question_type_yes_no_ans_limit_count++;
									$answer_and_points = sqb_get_correct_ans_and_points($allowed_correct_ans,$correct_ans,$ans_point);
									$correct_ans = $answer_and_points[0];
									$ans_point = $answer_and_points[1];	
										
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['answer_title'] = $answer_title;
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['correct_ans'] = $correct_ans;
									$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['ans_point'] = $ans_point;
								}
									
							}
								
								
									
							
							}
						}
						
						if(trim($column[$question_type_index]) == 'text' || $column[$question_type_index] == 'slider' || $column[$question_type_index] == 'file_upload' || $column[$question_type_index] == 'matrix'){
							$question_data_arr[$i]['question_type'] =  trim($question_type);
							$question_data_arr[$i]['question_title'] = SQButoUTFConvert($column[$question_text_index]);
							$question_data_arr[$i]['question_desc'] = $column[$question_description_index];
								
							$question_data_arr[$i]['question_answer_data'][0]['answer_title'] = '';
							$question_data_arr[$i]['question_answer_data'][0]['correct_ans'] = '';
							$question_data_arr[$i]['question_answer_data'][0]['ans_point'] = '';
						}
						/*----------------------------------------------------------------------------------------------*/

						if(trim($column[$question_type_index]) == 'numerical_text'){
							if($column[$question_answer1_index] == ''){
								$error_message = "Please add answer text in the CSV for this question to proceed.";
								$notvalid = true;
								break;
							}
							
							if($column[$question_answer1_index] != ''){
								
								$question_data_arr[$i]['question_type'] = $question_type;
								$question_data_arr[$i]['question_title'] = SQButoUTFConvert($column[$question_text_index]);
								$question_data_arr[$i]['question_desc'] = $column[$question_description_index];
								$answer_title = '';$correct_ans = '';$ans_point = '';
								$question_type_yes_no_ans_limit_count = 0;
								foreach($csv_ans_order_array as $csv_ans_order_single_key => $csv_ans_order_single){
									if($question_type_yes_no_ans_limit_count == 1){
										break;
									}
									$answer_title = '';
									$correct_ans = '';
									$ans_point = '';
									
									if(isset($column[$csv_ans_order_single])){
										$answer_title = $column[$csv_ans_order_single];
									}
									
									
									if(@isset($column[$csv_ans_correct_order_array[$csv_ans_order_single_key]])){
										$correct_ans = $column[$csv_ans_correct_order_array[$csv_ans_order_single_key]];
									}
									
									if(@isset($column[$csv_ans_point_order_array[$csv_ans_order_single_key]])){
										$ans_point = $column[$csv_ans_point_order_array[$csv_ans_order_single_key]];
									}
									
								
									if($answer_title != ''){	
										$question_type_yes_no_ans_limit_count++;
										$answer_and_points = sqb_get_correct_ans_and_points($allowed_correct_ans,$correct_ans,$ans_point);
										$correct_ans = $answer_and_points[0];
										$ans_point = $answer_and_points[1];	
											
										$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['answer_title'] = $answer_title;
										$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['correct_ans'] = $correct_ans;
										$question_data_arr[$i]['question_answer_data'][$csv_ans_order_single_key-1]['ans_point'] = $ans_point;
									}
								}	
							}
						}
						/*----------------------------------------------------------------------------------------------*/
						
						$i++;
					$row++;
				}
				fclose($file);
                 
            }     
            
           
            
			   if(!$notvalid && isset($quiz_obj)){
				   $template = $quiz_obj->getTemplate();
				   $quiz_type = $quiz_obj->getQuizType();	
					$questionObj = SQB_QuizQuestionBank::loadByQuizId($quiz_id);
					$question_order = 0;
					if(isset($questionObj)){
						$question_order = SQB_QuizQuestionBank::getLatestQuestionOrder($quiz_id) + 1;
					}	 	    
					if($quiz_type == 'personality'){
						$outcomeObj = SQB_Outcome::loadByQuizId($quiz_id);
						if(isset($outcomeObj) && !empty($outcomeObj)){
							$result = sqb_personality_quiz_import($quiz_id,$question_data_arr,$template,$question_order);
							$total_questions_added = count($result['new_questions_ids_array']);
						} else {
							$error_message = "There are no outcomes in this quiz. This is a personality quiz so first please create one or more outcomes in the SQB >> quiz page and then you can import question/answers from here";
							$notvalid = true;
						}
					} else if($quiz_type == 'assessment'){
						$result = sqb_assessment_quiz_import($quiz_id,$question_data_arr,$template,$question_order);
						$total_questions_added = count($result['new_questions_ids_array']);
					} else if($quiz_type == 'scoring'){
						$result = sqb_scorong_quiz_import($quiz_id,$question_data_arr,$template,$question_order);
						$total_questions_added = count($result['new_questions_ids_array']);
					} else if($quiz_type == 'survey'){
						$result = sqb_survey_quiz_import($quiz_id,$question_data_arr,$template,$question_order);
						$total_questions_added = count($result['new_questions_ids_array']);
					} else if($quiz_type == 'calculator'){
						$notvalid = true;
					}else if($quiz_type == 'poll'){
						$notvalid = true;
					}else if($quiz_type == 'form'){
						$notvalid = true;
					}
				} else {
					$notvalid = true;
				}
				
			if($notvalid){
				$output['result'] = false;
				$output['message'] = $error_message;		
			} else {	
				$output['result'] = true;
				$output['message'] = 'Added '.$total_questions_added.' Questions Successfully.';		
			}
			
		}else{
			$output['result'] = false;	
			$output['message'] = $error_message;
		}
	} else {
		$output['result'] = false;	
		$output['message'] = 'Permission denied. You need to be logged-in to access this interface.';
	}
	echo json_encode($output);
    die();
}

function sqb_get_correct_ans_and_points($allowed_correct_ans,$column4,$column5){
	if(in_array(strtoupper($column4),$allowed_correct_ans) || $column4 != ''){
		$correct_ans = $column4;
	} else {
		$correct_ans = 'N';
	}
	if($column5 != '' && is_numeric($column5)){
		$ans_point = $column5;
	} else {
		$ans_point = 0;
	}
	return array($correct_ans,$ans_point);
}

add_action('wp_ajax_sqb_load_all_tags', 'sqb_load_all_tags');
add_action('wp_ajax_nopriv_sqb_load_all_tags', 'sqb_load_all_tags');
function sqb_load_all_tags(){
	$question_id = $_REQUEST['question_id'];
	$all_tag_datas = SQB_Tags::load();
	$answers_data = SQB_QuizAnswers::loadByQuestionId($question_id);
	if(!empty($answers_data)){
		$all_tags_data = "";
		foreach($answers_data as $answer_data){
			$answer_id = $answer_data->getId();
			$answer_title = $answer_data->getAnswerTitle();
			$tags_data = $answer_data->getTagIds();
			if(!empty($tags_data)){
				$tags_id = unserialize($tags_data);
				if($tags_id){
					$all_tags = "";
					$i=1;
					foreach($tags_id as $tag_id){
						$tag_names = "";
						foreach($all_tag_datas as $all_tag_data){

							$selected = '';
							foreach($tag_id['tag_ids'] as $outcome_id){
								if($outcome_id == $all_tag_data->getId()){
									$selected = 'selected';
								}
							}
							$tag_names .= '<option '.$selected.' value="'.$all_tag_data->getId().'" data-outcome-id="'.$all_tag_data->getId().'">'.$all_tag_data->getName().'</option>';
						}
						$all_tags .= '<li><div class="sqb-column-index-'.$i.' outcome-tags-layout"></div><div class="js-select2-multiple-wrapper"><select class="tag-select-box" multiple>'.$tag_names.'</select></div></li>';
						$i++;
					}
					$all_tags_data .= '<tr data-ans-id="'.$answer_id.'"><td class="question-title">'.stripslashes($answer_title).'</td><td class="answer-title"><ul>'.$all_tags.'</ul> </td>';
				}
			}
		}
	}

	if(!empty($all_tag_datas)){
		foreach($all_tag_datas as $all_tag_data){
			$all_listed_tags .= '<option value="'.$all_tag_data->getId().'" data-outcome-id="'.$all_tag_data->getId().'">'.$all_tag_data->getName().'</option>';
		}
	}else{
		$all_listed_tags = '<option value="" data-outcome-id="">No Tags</option>';
	}
	
	$output['all_listed_tags'] = $all_listed_tags;
	$output['all_tags_data'] = $all_tags_data;

	echo json_encode($output);die;
}
add_action('wp_ajax_sqb_save_ans_tags', 'sqb_save_ans_tags');
add_action('wp_ajax_nopriv_sqb_save_ans_tags', 'sqb_save_ans_tags');
function sqb_save_ans_tags(){

	$html = '';
	$existing_tags = '';
	$action_val = $_POST['action_val']; 
	$answer_id = !empty($_POST['answer_id']) ? $_POST['answer_id'] : '';
	
	if($action_val == "list_all_tags"){
		$all_ans_data = SQB_QuizAnswers::loadById($answer_id);
		
		$get_tag_ids = $all_ans_data->getTagIds();	

		

		if(isset($get_tag_ids) && !empty($get_tag_ids)){
			$get_tag_ids = explode(',', $get_tag_ids);
		
			foreach($get_tag_ids as $get_tag_id){

				if($get_tag_id != 'NULL'){
					

				$load_data = SQB_Tags::loadById($get_tag_id);			
				if(!empty($load_data)){
					$tag_name = $load_data->getName();
					$html .= '<tr><td>'.stripslashes($tag_name).'</td>		 
								<td><a href="javascript:void(0)" data-id="'.$load_data->getId().'" class="sqb-delete-tags">Delete</a></td></tr>';
					}
				}
				
			}

			$output['html'] = $html;

			$all_tag_datas = SQB_Tags::load();
			$tags = array();
			foreach($all_tag_datas as $all_tag_data){
				$tags[] = $all_tag_data->getId();
	 		}

			$remaining_tag_ids = array_diff($tags, $get_tag_ids);
				
			foreach($remaining_tag_ids as $remaining_tag_id){
				$tag_details = SQB_Tags::loadById($remaining_tag_id);
				$existing_tags .= '<li class="option-tag" data-tag-id="'.$tag_details->getId().'">'.stripslashes($tag_details->getName()).'</li>';		
			}
			$output['existing_tags'] = $existing_tags;
		}else{
			$all_tag_datas = SQB_Tags::load();
			foreach($all_tag_datas as $all_tag_data){
				$existing_tags .= '<li class="option-tag" data-tag-id="'.$all_tag_data->getId().'">'.$all_tag_data->getName().'</li>';		
			}
			$output['html'] = '';
			$output['existing_tags'] = $existing_tags;
		}
	}else if($action_val == "save_ans_tag" && isset($_POST['tag_name'])){
		$ans_id = $_POST['ans_id'];

		$current_date = date('Y-m-d H:m:s');
		$name = $_POST['tag_name'];
		$content = $_POST['tag_content'];
		$insertObj = new SQB_Tags();
		$insertObj->setName($name);
		$insertObj->setContent($content);
		$insertObj->setDate($current_date);
		
		$obj = SQB_Tags::loadByName($name);
		if(!empty($obj)){
			$output['already_added'] = 'Already Added';
		}else{
			$id =  $insertObj->create();
			$output['id'] = $id;	
			$output['success'] = 'saved ';	
			
			$obj = SQB_QuizAnswers::loadById($ans_id);
			if($obj){				
				$obj->setId($obj->getId());
				$obj->setQuestionId($obj->getQuestionId());
				$obj->setAnswer($obj->getAnswer());
				$obj->setAnswerTitle($obj->getAnswerTitle());
				$obj->setCorrectAnswer($obj->getCorrectAnswer());
				$obj->setAnswerPoints($obj->getAnswerPoints());
				$obj->setIncorrectAnswerInfo($obj->getIncorrectAnswerInfo());
				$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
				$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
				$obj->setAnswerOrder($obj->getAnswerOrder());
				$obj->setDate($obj->getDate());
				$obj->setMatrixValues($obj->getMatrixValues());
				$obj->setRecommendationHtml($obj->getRecommendationHtml());
				
				$existing_tags = $obj->getTagIds();
				$new_id = array();
				if($existing_tags){
					$new_id[] = $id;
					$existing_tags = explode(',', $existing_tags);
					$merge_tag_ids = array_merge($existing_tags, $new_id);
					$implode_tag_ids = implode(',', $merge_tag_ids);
					$obj->setTagIds($implode_tag_ids);
				}else{
					$obj->setTagIds($id);
				}
				$id = $obj->update();
				$output['table_action'] = 'update';
			}
		}
	}else if($action_val == "delete_ans_tag" && isset($_POST['tag_id'])){
		$tag_id = $_POST['tag_id'];
		$ans_id = $_POST['ans_id'];
		$obj = SQB_QuizAnswers::loadById($ans_id);

		if(isset($obj)){
			$tag_id_array = explode(',',$obj->getTagIds());

			if (($key = array_search($tag_id, $tag_id_array)) !== false) {
			    unset($tag_id_array[$key]);
			}
			$tag_ids = implode(',', $tag_id_array);
			
			$obj->setId($obj->getId());
			$obj->setQuestionId($obj->getQuestionId());
			$obj->setAnswer($obj->getAnswer());
			$obj->setAnswerTitle($obj->getAnswerTitle());
			$obj->setCorrectAnswer($obj->getCorrectAnswer());
			$obj->setAnswerPoints($obj->getAnswerPoints());
			$obj->setIncorrectAnswerInfo($obj->getIncorrectAnswerInfo());
			$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
			$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
			$obj->setAnswerOrder($obj->getAnswerOrder());
			$obj->setDate($obj->getDate());
			$obj->setMatrixValues($obj->getMatrixValues());
			$obj->setRecommendationHtml($obj->getRecommendationHtml());
			$obj->setTagIds($tag_ids);

			$id = $obj->update();
			$output['table_action'] = 'update';
		}
		//$exist_Obj = SQB_Tags::deleteById($tag_id);  
		//$output['success'] = 'delete';
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_save_ans_tags_in_ans_tb', 'sqb_save_ans_tags_in_ans_tb');
add_action('wp_ajax_nopriv_sqb_save_ans_tags_in_ans_tb', 'sqb_save_ans_tags_in_ans_tb');
function sqb_save_ans_tags_in_ans_tb(){

	if(isset($_POST['ans_id'])){
		$ans_id = $_POST['ans_id'];
		$tags_ids = $_POST['tags_ids'];
		$obj = SQB_QuizAnswers::loadById($ans_id);
		if($obj){
			$obj->setId($obj->getId());
			$obj->setQuestionId($obj->getQuestionId());
			$obj->setAnswer($obj->getAnswer());
			$obj->setAnswerTitle($obj->getAnswerTitle());
			$obj->setCorrectAnswer($obj->getCorrectAnswer());
			$obj->setAnswerPoints($obj->getAnswerPoints());
			$obj->setIncorrectAnswerInfo($obj->getIncorrectAnswerInfo());
			$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
			$obj->setCorrectAnswerInfo($obj->getCorrectAnswerInfo());
			$obj->setAnswerOrder($obj->getAnswerOrder());
			$obj->setDate($obj->getDate());
			$obj->setMatrixValues($obj->getMatrixValues());
			$obj->setRecommendationHtml($obj->getRecommendationHtml());

			$existing_tags = $obj->getTagIds();
			if($existing_tags){
				$existing_tags = explode(',', $existing_tags);
				$new_tags_ids = explode(',', $tags_ids);
				$merge_tag_ids = array_unique(array_merge($existing_tags, $new_tags_ids));
				$implode_tag_ids = implode(',', $merge_tag_ids);
				$obj->setTagIds($implode_tag_ids);
			}else{
				$obj->setTagIds($tags_ids);
			}
			$id = $obj->update();
			$output['table_action'] = 'update';
		}
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_save_quiz_pdf', 'sqb_save_quiz_pdf');
add_action('wp_ajax_nopriv_sqb_save_quiz_pdf', 'sqb_save_quiz_pdf');
function sqb_save_quiz_pdf(){

	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$different_first_image = $_POST['different_first_image'];
		$different_last_image = $_POST['different_last_image'];
		$quiz_firstpage_width = $_POST['quiz_firstpage_width'];
		$quiz_first_page_align = $_POST['quiz_first_page_align'];
		$quiz_first_page_horizontal = $_POST['quiz_first_page_horizontal'];
		$quiz_lastpage_width = $_POST['quiz_lastpage_width'];
		$quiz_last_page_align = $_POST['quiz_last_page_align'];
		$quiz_last_page_horizontal = $_POST['quiz_last_page_horizontal'];

		$frontlastimage = $different_first_image.'|'.$different_last_image.'|'.$quiz_firstpage_width.'|'.$quiz_first_page_align.'|'.$quiz_first_page_horizontal.'|'.$quiz_lastpage_width.'|'.$quiz_last_page_align.'|'.$quiz_last_page_horizontal;
		$obj = SQB_Quiz::loadById($quiz_id);
		if($obj){
			$obj->setId($obj->getId());
			$obj->setQuizName($obj->getQuizName());
			$obj->setQuizDesc($obj->getQuizDesc());
			$obj->setQuizType($obj->getQuizType());
			$obj->setGradeQuiz($obj->getGradeQuiz());
			$obj->setProgressBar($obj->getProgressBar());				
			$obj->setQuizDisplay($obj->getQuizDisplay());	
			$obj->setQuizBlocking($obj->getQuizBlocking());				
			$obj->setQuizPassmark($obj->getQuizPassmark());
			$obj->setQuizAttemptsAllowed($obj->getQuizAttemptsAllowed());				
			$obj->setQuizPagination($obj->getQuizPagination());
			$obj->setQuestionPerPage($obj->getQuestionPerPage());
			$obj->setQuizTimer($obj->getQuizTimer());
			$obj->setQuizTimerLimit($obj->getQuizTimerLimit());
			$obj->setQuizScore($obj->getQuizScore());
			$obj->setQuizPercentage($obj->getQuizPercentage());	
			$obj->setShowForNotLoggedInUser($obj->getShowForNotLoggedInUser());	
			$obj->setRedirectAfterComplete($obj->getRedirectAfterComplete());	
			$obj->setQuestionDisplay($obj->getQuestionDisplay());	
			$obj->setNumberOfQuestion($obj->getNumberOfQuestion());	
			$obj->setQuestionBankOption($obj->getQuestionBankOption());	
			$obj->setQuestionsRandom($obj->getQuestionsRandom());	
			$obj->setAnswersRandom($obj->getAnswersRandom());	
			$obj->setShowStartScreen($obj->getShowStartScreen());	
			$obj->setShowOptinScreen($obj->getShowOptinScreen());	
			$obj->setShowShareScreen($obj->getShowShareScreen());	
			$obj->setShowResultScreen($obj->getShowResultScreen());	
			$obj->setQuizShowFirstNameTemp($obj->getQuizShowFirstNameTemp());	
			$obj->setQuizShowAnalyzingResult($obj->getQuizShowAnalyzingResult());	
			$obj->setQuizAnalyzingResultTime($obj->getQuizAnalyzingResultTime());	
			$obj->setTemplateDisplaySequence($obj->getTemplateDisplaySequence());	
			$obj->setUserAddedMyEmailPlatform($obj->getUserAddedMyEmailPlatform());	
			$obj->setUserAddedPlatform($obj->getUserAddedPlatform());
			$obj->setOutcomeType($obj->getOutcomeType());	
			$obj->setOutcomePage($obj->getOutcomePage());	
			$obj->setDisplayScoreOnPage($obj->getDisplayScoreOnPage());	
			$obj->setDisplayCorrectAnsOnPage($obj->getDisplayCorrectAnsOnPage());	
			$obj->setDisplayAnswerOptions($obj->getDisplayAnswerOptions());	
			$obj->setDisplayQuesansOnOutcome($obj->getDisplayQuesansOnOutcome());	
			$obj->setOutcomeRedirectUrl($obj->getOutcomeRedirectUrl());		
			$obj->setUserOptinRedirect($obj->getUserOptinRedirect());		
			$obj->setUserOptinRedirectUrl($obj->getUserOptinRedirectUrl());		
			$obj->setDate($obj->getDate());		
			$obj->setEnableBranching($obj->getEnableBranching());		
			$obj->setShowNextButton($obj->getShowNextButton());		
			$obj->setAlreadyTakeTheQuiz($obj->getAlreadyTakeTheQuiz());		
			$obj->setTotalAttempts($obj->getTotalAttempts());		
			$obj->setQuizShowCorrectAnswer($obj->getQuizShowCorrectAnswer());	
			$obj->setTemplate($obj->getTemplate());				 	
			$obj->setShowVideo($obj->getShowVideo());				 	
			$obj->setVideoURL($obj->getVideoURL());
			$obj->setPassCriteria($obj->getPassCriteria()); 			 	
			$obj->setStatus($obj->getStatus());				 	
			$obj->setSqbInsertQuiz($obj->getSqbInsertQuiz());				 	
			$obj->setAllowRetake($obj->getAllowRetake());				 	
			$obj->setQuizDisplayUrls($obj->getQuizDisplayUrls());				 	
			$obj->setQuizDisplayInUrls($obj->getQuizDisplayInUrls());
			$obj->setQuizPopupTimeDelay($obj->getQuizPopupTimeDelay());
			$obj->setQuizPopupFrequency($obj->getQuizPopupFrequency());
			$obj->setQuizPopupPosition($obj->getQuizPopupPosition());				 	
			$obj->setEmailVerification($obj->getEmailVerification());	
			$obj->setQuizSliderAnimation($obj->getQuizSliderAnimation());	
			$obj->setQuizSliderAnimationOption($obj->getQuizSliderAnimationOption());	
			$obj->setResultDisplayOption($obj->getResultDisplayOption());   
			$obj->setQuestionsTopBorder($obj->getQuestionsTopBorder()); 
			$obj->setTimerHtml($obj->getTimerHtml());
			$obj->setTimerCustomizer($obj->getTimerCustomizer());
			$obj->setTimerExpiredMsg($obj->getTimerExpiredMsg());  
			$obj->setEnableBackgroundImage($obj->getEnableBackgroundImage());  
			$obj->setCategory($obj->getCategory()); 		
			$obj->setPreBuilt($obj->getPreBuilt()); 		
			$obj->setTransparentBackgroundSettings($obj->getTransparentBackgroundSettings());
			$obj->setMoveQuestion($obj->getMoveQuestion());
			$obj->setOutcomeScreen_Display($obj->getOutcomeScreen_Display());
			$obj->setOutcomeScreenChartsSettings($obj->getOutcomeScreenChartsSettings());
			$obj->setCategoryOption($obj->getCategoryOption());
			$obj->setCustomizerStyleSetting($obj->getCustomizerStyleSetting());
			$obj->setExitPopupValue($obj->getExitPopupValue());
			$obj->setShowDownloadButton($obj->getShowDownloadButton());
			$obj->setDownloadPDFButtonHtml($obj->getDownloadPDFButtonHtml());
			$obj->setPdfFrontLastImage($frontlastimage);
			$id = $obj->update();
			$output['save_action'] = 'update';
		}
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqbSavePriority', 'sqbSavePriority');
add_action('wp_ajax_nopriv_sqbSavePriority', 'sqbSavePriority');
function sqbSavePriority(){

	if(isset($_POST['advance_id'])){
		$advance_id = $_POST['advance_id'];
		$get_val = $_POST['get_val'];
		$obj = SQB_AdvancedRule::loadById($advance_id);
		if($obj){
			$obj->setId($obj->getId());
			$obj->setQuizId($obj->getQuizId());
			$obj->setQuestionId($obj->getQuestionId());
			$obj->setAnswersId($obj->getAnswersId());
			$obj->setOutcomeId($obj->getOutcomeId());
			$obj->setCategoryTotal($obj->getCategoryTotal());
			$obj->setCategoryId($obj->getCategoryId());
			$obj->setEnabledAdvanced($obj->getEnabledAdvanced());
			$obj->setFormulaId($obj->getFormulaId());
			$obj->setFormulaPriority($get_val);
			$obj->setSkipOptin($obj->getSkipOptin());
			$obj->setDate($obj->getDate());	
			$id = $obj->update();
			$output['table_action'] = 'update';
		}
	
	}else{
		$output['error'] = 'Something Went Wrong';	
	}	
	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqbdeleteadvacerule', 'sqbdeleteadvacerule');
add_action('wp_ajax_nopriv_sqbdeleteadvacerule', 'sqbdeleteadvacerule');
function sqbdeleteadvacerule(){
	if(isset($_POST['id'])){
		$id = $_POST['id']; 	
		SQB_AdvancedRule::deleteById($id);	
		$output['delete'] = 'delete';
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqbverifyemailvalidation', 'sqbverifyemailvalidation');
add_action('wp_ajax_nopriv_sqbverifyemailvalidation', 'sqbverifyemailvalidation');
function sqbverifyemailvalidation(){

	$email_verify_platform = get_option('email_verify_platform', 'quickemail');


	if($email_verify_platform == 'quickemail'){
		$quick_email_verification = 'quick_email_verification';
		$quick_email_verification_api_key = 'quick_email_verification_api_key';
		$api_key = '';
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($quick_email_verification , $quick_email_verification_api_key);
		if($obj->value){
			$output = 'set';
		}else{
			$output = 'notset';
		}
	}else{
		if(!empty(get_option('reoon_api_key', ''))){
			$output = 'set';
		}else{
			$output = 'notset';
		}

	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_export_quiz', 'SqbExportQuiz');
add_action('wp_ajax_nopriv_sqb_export_quiz', 'SqbExportQuiz');
function SqbExportQuiz(){
	$output = array();
	$quiz_ids = $_POST['quiz_ids'];
	global $wpdb;
	$prefix = $wpdb->prefix;
	$prefix2 = '%wpprefix%';
	
	$table_name1 = 'sqb_quiz';
	$table_name = $prefix.'sqb_quiz';
	$table_name2 = $prefix2.'sqb_quiz';

	$table_tag1 = 'sqb_tags';
	$table_tag = $prefix.'sqb_tags';
	$table_tag2 = $prefix2.'sqb_tags';
	
	$sqb_quiz_category1 = 'sqb_quiz_category';
	$sqb_quiz_category = $prefix.'sqb_quiz_category';
	$sqb_quiz_category2 = $prefix2.'sqb_quiz_category';

	$sqb_quiz_template_table1 = 'sqb_quiz_template';
	$sqb_quiz_template_table = $prefix.'sqb_quiz_template';
	$sqb_quiz_template_table2 = $prefix2.'sqb_quiz_template';
	
	$sqb_quiz_outcome_table1 = 'sqb_quiz_outcome';
	$sqb_quiz_outcome_table = $prefix.'sqb_quiz_outcome';
	$sqb_quiz_outcome_table2 = $prefix2.'sqb_quiz_outcome';
	
	$sqb_quiz_question_bank_table1 = 'sqb_quiz_question_bank';
	$sqb_quiz_question_bank_table = $prefix.'sqb_quiz_question_bank';
	$sqb_quiz_question_bank_table2 = $prefix2.'sqb_quiz_question_bank';
	
	$sqb_quiz_questions_table1 = 'sqb_quiz_questions';
	$sqb_quiz_questions_table = $prefix.'sqb_quiz_questions';
	$sqb_quiz_questions_table2 = $prefix2.'sqb_quiz_questions';
	
	$sqb_quiz_answers_table1 = 'sqb_quiz_answers';
	$sqb_quiz_answers_table = $prefix.'sqb_quiz_answers';
	$sqb_quiz_answers_table2 = $prefix2.'sqb_quiz_answers';
	
	$sqb_quiz_autoresponder_table1 = 'sqb_quiz_autoresponder';
	$sqb_quiz_autoresponder_table = $prefix.'sqb_quiz_autoresponder';
	$sqb_quiz_autoresponder_table2 = $prefix2.'sqb_quiz_autoresponder';
	
	$sqb_form_quiz_table = $prefix.'sqb_form_quiz';
	$sqb_form_quiz_table2 = $prefix2.'sqb_form_quiz';

	$sqb_quiz_global_theme_table = $prefix.'sqb_global_theme';
	$sqb_quiz_global_theme_table2 = $prefix2.'sqb_global_theme';
	
	$url = preg_replace("(^https?://)", "", site_url());
	$plugins_url = plugins_url();
	$replace_plugin_url = array($plugins_url => "%PLUGINURL%");//rplace a base url with merge tag.
	
	$upload_images_list = array();
	$image_merge_tags = array();
	 
	
	$results = $wpdb->get_results('DESCRIBE '.$table_name,ARRAY_A);
	$columns = array();
	foreach($results as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$result = $wpdb->get_results(( "SELECT * FROM $table_name WHERE id = $quiz_ids"));
	
	//$return.= 'DROP TABLE '.$table.';';
	$row3 = $wpdb->get_results(('SHOW CREATE TABLE '.$table_name));
	$row2 = array_values((array) $row3[0]);
	//$return.= "\n\n".$row2[1].";\n\n";
	$return = '';
	$return.= 'INSERT INTO `'.$table_name2.'` (';
			$i=0;
			foreach($results as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
				if ($i < ($num_fields-1)) { $return.= ','; }
				$i++;
			} 
	$return.= ") VALUES ";
	
	$replace_list = array(); 
	$is_cat_enabled = 0;
	foreach($result as $keys => $val){
		$row3 = array_values((array)$val); 
		$return.= "(";
		$j=0;
		foreach($results as $row) {
			if($j == 0){
			$j++;
			continue;
			}
			
			if (isset($row3[$j])) {
					if(is_numeric($row3[$j])){
					 $return.= $row3[$j]; 
					} elseif($row['Field'] == 'category'){
						
						if($row3[$j] == 'Y'){
							$return.= "'Y'";
							$is_cat_enabled = 1;
						}else{
							$return.= "'N'";
						}
					} elseif($row['Field'] == 'user_added_my_email_platform'){
						$return.= "'add_user_in_wp'"; 
					} elseif($row['Field'] == 'user_added_platform'){
						$return.= "''"; 
					} elseif($row['Field'] == 'ans_tags'){
						if($row3[$j] == 'Y'){
							$return.= "'Y'"; 
						}else{
							$return.= "'N'"; 
						}
					} elseif($row['Field'] == 'transparent_background_settings'){
						//preg_match_all('/https?\:\/\/[^\",]+/i', urldecode($row3[$j]), $matches);
						preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($row3[$j]), $matches);
						$elements = $matches;
						
						if(count($elements) > 0){
							foreach($elements as $key => $element){
								foreach($element as $elemente){
									
								if(strpos($elemente, $url) != true){
								continue;
								}
								
								$elemente = substr($elemente, 0, strpos($elemente, "|"));
									
								$ext = pathinfo($elemente, PATHINFO_EXTENSION);
								$filename = pathinfo($elemente, PATHINFO_FILENAME);
								if(($ext != '' && $ext != 'css') && $filename != ''){
								$merge_tag = '%PLUGIN_IMG_URLS%'.$table_name1.'/'.$filename.'/'.$ext;
								//$merge_tag = '%PLUGIN_IMG_URL||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
								$merge_tag_as_key = 'images/'.$table_name1.'/'.$filename.'/'.$ext;
								$replace_list[$elemente] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $elemente;
								}
								
								/*$ext = pathinfo($elemente, PATHINFO_EXTENSION);
								$filename = pathinfo($elemente, PATHINFO_FILENAME);
								$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
								$replace_list[$elemente] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $elemente;*/
									
								}
							}
						 }
						
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
						  //$return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
						  $return.= "'".addslashes($quiz_data)."'";
					} else {
						
						preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
						$elements = $matches;
						if(count($elements) > 0){
							foreach($elements[1] as $key => $element){
								if(strpos($element, $url) != true){
								continue;
								}
							
								$ext = pathinfo($element, PATHINFO_EXTENSION);
								$filename = pathinfo($element, PATHINFO_FILENAME);
								$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
								$replace_list[$element] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $element;
								
							}
						 }
						
					  //$return.= ''.urldecode($row3[$j]).'';
					  if($row['Field'] == 'all_other_options'){
						$quiz_data = strtr(($row3[$j]),$replace_list);
					  }else{
					  	$quiz_data = strtr(urldecode($row3[$j]),$replace_list);
					  }
					  $return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
					  
					}
					
				 } else { $return.= "'NULL'"; }
			if ($j < ($num_fields-1)) { $return.= ','; }
			$j++;
		}
		$return.= ");\n";
	}
	//quiz table ends




	$describe_sqb_quiz_gloalb_theme = $wpdb->get_results('DESCRIBE '.$sqb_quiz_global_theme_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_gloalb_theme as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);

	

	$quiz_template_global_result = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_global_theme_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	
	
	if(count($quiz_template_global_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_quiz_global_theme_table2.'` (';
				$i=0;
				foreach($describe_sqb_quiz_gloalb_theme as $row) {
					if($i == 0){
					$i++;	
					continue;
					}
					
					if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
					if ($i < ($num_fields-1)) { $return.= ','; }
					$i++;
				} 
				$return.= ") VALUES ";
				
			$replace_list = array(); 	
			$k=1;
			foreach($quiz_template_global_result as $keys => $val){
				$row3 = array_values((array)$val); 
				$return.= "(";
				$j=0;
				foreach($describe_sqb_quiz_gloalb_theme as $row) {
					if($j == 0){
					$j++;
					continue;
					}
					
					if (isset($row3[$j])) {
								if($row['Field'] == 'quiz_id'){
									$return.= '%quizid%';
								} else if(is_numeric($row3[$j])){
								 $return.= $row3[$j]; 
								} else {

									if ($data = unserialize($row3[$j])) {
										$return.= "'[sqbwp_serialize]".$row3[$j]."[/sqbwp_serialize]'"; 
									} else {
										$return.= "'".$row3[$j]."'"; 
									}
									
								}
						 } else { $return.= "'NULL'"; }
					if ($j < ($num_fields-1)) { $return.= ','; }
					$j++;
				}
				
				if($k < count($quiz_template_global_result)){
					$return.= "),\n";
				} else {
					$return.= ");\n";
				}
				$k++;
			}
			
		}


	// Category stuff
	
	if($is_cat_enabled){
		$sqb_quiz_questions_bank_result = $wpdb->get_results(( "SELECT category_id FROM $sqb_quiz_question_bank_table WHERE id IN (SELECT `question_id` FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids)"));

		$attached_cat = array();
		foreach ($sqb_quiz_questions_bank_result as $key => $category) {
			if(!empty($category->category_id)){
				$attached_cat[] = $category->category_id;
			}
		}
		
		if(!empty($attached_cat)){

			$attached_cat = array_unique($attached_cat);

			$cat_result = $wpdb->get_results("SELECT * FROM $sqb_quiz_category WHERE id IN(".implode(',',$attached_cat).")");

			$catresults = $wpdb->get_results('DESCRIBE '.$sqb_quiz_category,ARRAY_A);
			$columns = array();
			foreach($catresults as $row) {
				$columns[] = $row['Field'];
			}
			$num_fields = count($columns);

			if(!empty($cat_result)){
				$catarray = array();
				$row3 = $wpdb->get_results(('SHOW CREATE TABLE '.$sqb_quiz_category));
				$row2 = array_values((array) $row3[0]);
				
				$return.= 'INSERT IGNORE INTO `'.$sqb_quiz_category2.'` (';
						$i=0;
						foreach($catresults as $row) {
							if($i == 0){
							$i++;	
							continue;
							}
							
							if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
							if ($i < ($num_fields-1)) { $return.= ','; }
							$i++;
						} 
				$return.= ") VALUES ";
				$k=1;
				$replace_list = array(); 
				foreach($cat_result as $keys => $val){
					$row3 = array_values((array)$val); 
		
					$catarray[$val->id] = $val->name;
		
					$return.= "(";
					$j=0;
					foreach($catresults as $row) {
						if($j == 0){
						$j++;
						continue;
						}
						
						if (isset($row3[$j])) {
								if(is_numeric($row3[$j])){
								$return.= $row3[$j]; 
								} elseif($row['Field'] == 'category'){
									$return.= "'N'"; 
								} else {
								$return.= "'".addslashes($row3[$j])."'";
								}
								
							} else { $return.= "'NULL'"; }
						if ($j < ($num_fields-1)) { $return.= ','; }
						$j++;
					}
					
		
					if($k < count($cat_result)){
						$return.= "),\n";
					} else {
						$return.= ");\n";
					}
					$k++;
				}
		
			}
		}
	}




	// Tag stuff
	$tag_result = $wpdb->get_results("SELECT tag_ids FROM $sqb_quiz_answers_table WHERE question_id IN(SELECT question_id as question_ids FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids)");



	$tag_list = array();

	foreach($tag_result as $key => $tag) {
		if(!empty($tag->tag_ids) && $tag->tag_ids != 'NULL'){
			$tags = explode(',',$tag->tag_ids);
			foreach ($tags as $skey => $single) {
				if($single != 'NULL'){
					$tag_list[] = $single;	
				}
			}
		}
	}


	$tag_outcome = $wpdb->get_results("SELECT id FROM $table_tag WHERE name IN (SELECT tag FROM $sqb_quiz_outcome_table WHERE quiz_id = $quiz_ids)");



	if(!empty($tag_outcome)){
		foreach($tag_outcome as $singl) {
			$tag_list[] = $singl->id;
		}
	}

	$tagresults = $wpdb->get_results('DESCRIBE '.$table_tag,ARRAY_A);
	$columns = array();
	foreach($tagresults as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	if(!empty($tag_list)){
		$tagresult = $wpdb->get_results(( "SELECT * FROM $table_tag WHERE id IN(".implode(',',$tag_list).")"));
	}else{
		$tag_list = array();
	}

	

	if(!empty($tagresult)){
		$tagarray = array();
		//$return.= 'DROP TABLE '.$table.';';
		$row3 = $wpdb->get_results(('SHOW CREATE TABLE '.$table_tag));
		$row2 = array_values((array) $row3[0]);
		//$return.= "\n\n".$row2[1].";\n\n";
			


		$return.= 'INSERT IGNORE INTO `'.$table_tag2.'` (';
				$i=0;
				foreach($tagresults as $row) {
					if($i == 0){
					$i++;	
					continue;
					}
					
					if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
					if ($i < ($num_fields-1)) { $return.= ','; }
					$i++;
				} 
		$return.= ") VALUES ";
		$k=1;
		$replace_list = array(); 
		foreach($tagresult as $keys => $val){
			$row3 = array_values((array)$val); 

			$tagarray[$val->id] = $val->name;

			$return.= "(";
			$j=0;
			foreach($tagresults as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} elseif($row['Field'] == 'category'){
							$return.= "'N'"; 
						} else {
						  $return.= "'".addslashes($row3[$j])."'";
						}
						
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			

			if($k < count($tagresult)){
				$return.= "),\n";
			} else {
				$return.= ");\n";
			}
			$k++;
		}

	}
	
	$describe_sqb_quiz_template_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_template_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_template_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$quiz_template_result = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_template_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($quiz_template_result) > 0){
	$return.= 'INSERT INTO `'.$sqb_quiz_template_table2.'` (';
			$i=0;
			foreach($describe_sqb_quiz_template_table as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
				if ($i < ($num_fields-1)) { $return.= ','; }
				$i++;
			} 
			$return.= ") VALUES ";
			
		$replace_list = array(); 	
		foreach($quiz_template_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_template_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
							if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
							} else if(is_numeric($row3[$j])){
							 $return.= $row3[$j]; 
							} else if($row['Field'] == 'customizer_html'){
								$return.= "'".$row3[$j]."'";
							} else {
								//preg_match_all('/https?\:\/\/[^\",]+/i', urldecode($row3[$j]), $matches);
								preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($row3[$j]), $matches);
								$elements = $matches;
								
								
								if(count($elements) > 0){
									foreach($elements as $key => $element){
										
										
										
										foreach($element as $elemente){
											
										if(strpos($elemente, $url) != true){
										continue;
										}
										
										
										//$elemente = substr($elemente, 0, strpos($elemente, "&quot"));
										
											
											$ext = pathinfo($elemente, PATHINFO_EXTENSION);
											$filename = pathinfo($elemente, PATHINFO_FILENAME);
											if(($ext != '' && $ext != 'css') && $filename != ''){
											$merge_tag = '%PLUGIN_IMG_URLS%'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
											//$merge_tag = '%PLUGIN_IMG_URL||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
											$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
											$replace_list[$elemente] = $merge_tag;
											$image_merge_tags[$merge_tag] = $merge_tag_as_key;
											$upload_images_list[$merge_tag_as_key] = $elemente;
											}else if($ext == 'css'){
												
												$filename = str_replace(get_site_url(),'%SQB_SITE_URL%',$elemente);
												$merge_tag = $filename;
												$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
											$replace_list[$elemente] = $merge_tag;

											
											$image_merge_tags[$merge_tag] = $merge_tag_as_key;
											$upload_images_list[$merge_tag_as_key] = $elemente;
											}
											
										}
									}
								 }
								 
								 
								 
								  //$return.= ''.urldecode($row3[$j]).'';
								  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
								  
								  $quiz_data = preg_replace('/<!--\?php(.*?)\?-->/s', '', $quiz_data);
								  $quiz_data = preg_replace('/<\?php(.*?)\?>/s', '', $quiz_data);
								  //$return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
								  $return.= "'".addslashes($quiz_data)."'";
								  /*Comment due to duplicate the html */  
								/*preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
								$elements = $matches;
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements[1] as $key => $element){
										if(strpos($element, $url) != true){
										continue;
										}
										$ext = pathinfo($element, PATHINFO_EXTENSION);
										$filename = pathinfo($element, PATHINFO_FILENAME);
										$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
										$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
										
										$replace_list[$element] = $merge_tag;
										$image_merge_tags[$merge_tag] = $merge_tag_as_key;
										$upload_images_list[$merge_tag_as_key] = $element;
										
									}
								 }
							  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
							  $return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";*/
							}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			$return.= ");\n";
		}
	}
	
	$describe_sqb_quiz_outcome_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_outcome_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_outcome_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$quiz_outcome_result = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_outcome_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($quiz_outcome_result) > 0){
	$return.= 'INSERT INTO `'.$sqb_quiz_outcome_table2.'` (';
			$i=0;
			foreach($describe_sqb_quiz_outcome_table as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
				if ($i < ($num_fields-1)) { $return.= ','; }
				$i++;
			} 
			$return.= ") VALUES ";
			$k=1;	
			foreach($quiz_outcome_result as $keys => $val){
				$row3 = array_values((array)$val); 
				$return.= "(";
				$j=0;
				foreach($describe_sqb_quiz_outcome_table as $row) {
					if($j == 0){
					$j++;
					continue;
					}
					
					if (isset($row3[$j])) {
							if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
							} else if($row['Field'] == 'customizer_options'){
								$return.= "'".$row3[$j]."'"; 
							} else if(is_numeric($row3[$j])){
								$return.= $row3[$j]; 
							} else if($row['Field'] == 'tag'){
								if(!empty($row3[$j]) && $row3[$j] != 'NULL'){
									$return.= "'".'[tagname:'.$row3[$j].']'."'";
								}else{
									$return .= "'".$row3[$j]."'";
								}
								 
							} else if($row['Field'] == 'outcome_html'){
								//preg_match_all('/https?\:\/\/[^\",]+/i', urldecode($row3[$j]), $matches);
								preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($row3[$j]), $matches);
								$elements = $matches;
								
								
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements as $key => $element){
										
										foreach($element as $elemente){
											
										if(strpos($elemente, $url) != true){
										continue;
										}
										
										$elemente = substr($elemente, 0, strpos($elemente, "&quot"));
										
											
											$ext = pathinfo($elemente, PATHINFO_EXTENSION);
											$filename = pathinfo($elemente, PATHINFO_FILENAME);
											if($ext != '' && $filename != ''){
											$merge_tag = '%PLUGIN_IMG_URLS%'.$sqb_quiz_outcome_table1.'/'.$filename.'/'.$ext;
											//$merge_tag = '%PLUGIN_IMG_URL||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
											$merge_tag_as_key = 'images/'.$sqb_quiz_outcome_table1.'/'.$filename.'/'.$ext;
											$replace_list[$elemente] = $merge_tag;
											$image_merge_tags[$merge_tag] = $merge_tag_as_key;
											$upload_images_list[$merge_tag_as_key] = $elemente;
											}
										}
									}
								 }
								  //$return.= ''.urldecode($row3[$j]).'';
								  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
								  $return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
								  /*Comment due to duplicate the html */
								/*preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
								$elements = $matches;
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements[1] as $key => $element){
										if(strpos($element, $url) != true){
										continue;
										}
										$ext = pathinfo($element, PATHINFO_EXTENSION);
										$filename = pathinfo($element, PATHINFO_FILENAME);
										$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
										$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
										$replace_list[$element] = $merge_tag;
										$image_merge_tags[$merge_tag] = $merge_tag_as_key;
										$upload_images_list[$merge_tag_as_key] = $element;
									}
									
								 }
								
							  //$return.= ''.urldecode($row3[$j]).'';
							  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
							  $return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";*/
							}else {
								preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
								$elements = $matches;
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements[1] as $key => $element){
										if(strpos($element, $url) != true){
										continue;
										}
										$ext = pathinfo($element, PATHINFO_EXTENSION);
										$filename = pathinfo($element, PATHINFO_FILENAME);
										$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
										$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
										$replace_list[$element] = $merge_tag;
										$image_merge_tags[$merge_tag] = $merge_tag_as_key;
										$upload_images_list[$merge_tag_as_key] = $element;
									}
								 }
								
							  //$return.= ''.urldecode($row3[$j]).'';
							  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
							  $return.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
							}
						 } else { $return.= "'NULL'"; }
					if ($j < ($num_fields-1)) { $return.= ','; }
					$j++;
				}
				if($k < count($quiz_outcome_result)){
				$return.= "),\n";
				} else {
				$return.= ");\n";
				}
				$k++;
			}
		}
			
	//question bank table
	$quiz_quiz_questions = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids"));
	$question_id = array();
	foreach($quiz_quiz_questions as $quiz_quiz_questions_data){
		$question_id[] = $quiz_quiz_questions_data->question_id; 	
	}
	
	$describe_sqb_quiz_questions_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_questions_table,ARRAY_A);
	$columns2 = array();
	foreach($describe_sqb_quiz_questions_table as $row) {
		$columns2[] = $row['Field'];
	}
	$num_fields2 = count($columns2);
	
	$describe_sqb_quiz_question_bank_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_question_bank_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_question_bank_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	//quiz_answers_table	
	$describe_sqb_quiz_answers_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_answers_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_answers_table as $row) {
		$columns[] = $row['Field'];
	}
	$quiz_answers_num_fields = count($columns);
	
	$sqb_quiz_questions_bank_result = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_question_bank_table WHERE id IN (SELECT `question_id` FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids)"));
	
	foreach($sqb_quiz_questions_bank_result as $keys => $val){
		$insert_into_quiz_question_bank ='';
		$insert_into_quiz_question = '';
		$insert_into_sqb_quiz_answers = '';
		
		$insert_into_quiz_question_bank.= 'INSERT INTO `'.$sqb_quiz_question_bank_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_question_bank_table as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $insert_into_quiz_question_bank.= '`'.$row['Field'].'`' ; } else { $insert_into_quiz_question_bank.= ''; }
				if ($i < ($num_fields-1)) { $insert_into_quiz_question_bank.= ','; }
				$i++;
			}
		$insert_into_quiz_question_bank.= ") VALUES ";
		$row3 = array_values((array)$val);
		$insert_into_quiz_question_bank.= "(";	
		
		$j=0;
		foreach($describe_sqb_quiz_question_bank_table as $row) {
			if($j == 0){
			$j++;
			continue;
			}
			
			if (isset($row3[$j])) {
					if($row['Field'] == 'quiz_id'){
						$insert_into_quiz_question_bank.= '%quizid%';
					} else if($row['Field'] == 'category_id'){
					   // $insert_into_quiz_question_bank.= $row3[$j]; 
						$cat = $row3[$j];
						if(!empty($catarray[$cat])){
							$insert_into_quiz_question_bank.= "'[catname:".$catarray[$cat]."]'";
						}else{
							$insert_into_quiz_question_bank.= "0";
						}
						//$insert_into_quiz_question_bank.= "%category_id%"; 
					} else if($row['Field'] == 'matrix_label_text'){
					    $insert_into_quiz_question_bank.= "'".$row3[$j]."'"; 
					} else if(is_numeric($row3[$j])){
					    $insert_into_quiz_question_bank.= $row3[$j]; 
					} else if($row['Field'] == 'temp_customizer'){
						preg_match_all('/https?\:\/\/[^\",]+/i', urldecode($row3[$j]), $matches);
						
						$elements = $matches;
						
						$replace_list = array(); 
						if(count($elements[0]) > 0){
							foreach($elements[0] as $key => $element){
								if(strpos($element, $url) != true){
								continue;
								}
								$element = substr($element, 0, strpos($element, "||"));
								$ext = pathinfo($element, PATHINFO_EXTENSION);
								$filename = pathinfo($element, PATHINFO_FILENAME);
								$merge_tag = '%PLUGIN_IMG_URLS%'.$sqb_quiz_question_bank_table1.'/'.$filename.'/'.$ext;
								//$merge_tag = '%PLUGIN_IMG_URL||'.$sqb_quiz_question_bank_table1.'||'.$filename.'||'.$ext.'%';
								$merge_tag_as_key = 'images/'.$sqb_quiz_question_bank_table1.'/'.$filename.'/'.$ext;
								$replace_list[$element] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $element;
							}
						 }
						 
					  //$return.= ''.urldecode($row3[$j]).'';
					  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
					 // $insert_into_quiz_question_bank.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
					  $insert_into_quiz_question_bank.= "'".addslashes($quiz_data)."'";
					  
					} else {
						preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
						$elements = $matches;
						
						$replace_list = array(); 
						if(count($elements) > 0){
							foreach($elements[1] as $key => $element){
								if(strpos($element, $url) != true){
								continue;
								}
								
								$ext = pathinfo($element, PATHINFO_EXTENSION);
								$filename = pathinfo($element, PATHINFO_FILENAME);
								$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
								$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
								$replace_list[$element] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $element;
							}
						 }
					  //$return.= ''.urldecode($row3[$j]).'';
					  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
					 // $insert_into_quiz_question_bank.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
					  $insert_into_quiz_question_bank.= "'".addslashes($quiz_data)."'";
					}
				 } else { $insert_into_quiz_question_bank.= "'NULL'"; }
			if ($j < ($num_fields-1)) { $insert_into_quiz_question_bank.= ','; }
			$j++;
			
		}
		
		$insert_into_quiz_question_bank.= ");\n";
		
		$insert_into_quiz_question .= 'INSERT INTO `'.$sqb_quiz_questions_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_questions_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $insert_into_quiz_question.= '`'.$row['Field'].'`' ; } else { $insert_into_quiz_question.= ''; }
			if ($i < ($num_fields2-1)) { $insert_into_quiz_question.= ','; }
			$i++;
		}
		$insert_into_quiz_question.= ") VALUES ";

		$quiz_quiz_questionsk = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids AND question_id = '".$val->id."'"));

		$row3 = array_values((array)$quiz_quiz_questionsk[0]);

		$insert_into_quiz_question.= "(";
		$j=0;
		foreach($describe_sqb_quiz_questions_table as $row) {
			if($j == 0){
			$j++;
			continue;
			}
			
			if (isset($row3[$j])) {
					if($row['Field'] == 'quiz_id'){
							$insert_into_quiz_question.= '%quizid%';
					} else if($row['Field'] == 'question_id'){
							$insert_into_quiz_question.= '%questionid%';
					} else if($row['Field'] == 'show_ads'){
							$insert_into_quiz_question.= "'".$row3[$j]."'";	
					/*} else if($row['Field'] == 'question_ads_html'){
							$insert_into_quiz_question.= "'".$row3[$j]."'";		*/
					} else if(is_numeric($row3[$j])){
					    $insert_into_quiz_question.= $val->question_order;//$row3[$j]; 
					} else {
						preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
						$elements = $matches;
						
						$replace_list = array(); 
						if(count($elements) > 0){
							foreach($elements[1] as $key => $element){
								if(strpos($element, $url) != true){
								continue;
								}
								$ext = pathinfo($element, PATHINFO_EXTENSION);
								$filename = pathinfo($element, PATHINFO_FILENAME);
								$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
								$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
								$replace_list[$element] = $merge_tag;
								$image_merge_tags[$merge_tag] = $merge_tag_as_key;
								$upload_images_list[$merge_tag_as_key] = $element;
							}
						 }
						
					  //$return.= ''.urldecode($row3[$j]).'';
					  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
					  $insert_into_quiz_question.= "'".strtr($quiz_data,$replace_plugin_url)."'";
					  //$insert_into_quiz_question.= $val->question_order;
					}
				 } else { $insert_into_quiz_question.= "'NULL'"; }
			if ($j < ($num_fields2-1)) { $insert_into_quiz_question.= ','; }
			$j++;
			
		}
		$insert_into_quiz_question.= ");\n";
		
		
		
		$sqb_quiz_answers_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_answers_table WHERE question_id IN (SELECT `question_id` FROM $sqb_quiz_questions_table WHERE question_id = $val->id)"));
		
		$insert_into_sqb_quiz_answers.= 'INSERT INTO `'.$sqb_quiz_answers_table2.'` (';
			$i=0;
			foreach($describe_sqb_quiz_answers_table as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $insert_into_sqb_quiz_answers.= '`'.$row['Field'].'`' ; } else { $insert_into_sqb_quiz_answers.= ''; }
				if ($i < ($quiz_answers_num_fields-1)) { $insert_into_sqb_quiz_answers.= ','; }
				$i++;
			} 
			$insert_into_sqb_quiz_answers.= ") VALUES ";
		
			$k=1;
			foreach($sqb_quiz_answers_result as $keys => $val){
				$row3 = array_values((array)$val); 
				
				$insert_into_sqb_quiz_answers.= "(";
				$j=0;
				foreach($describe_sqb_quiz_answers_table as $row) {
					if($j == 0){
					$j++;
					continue;
					}
					
					if (isset($row3[$j])) {
							if($row['Field'] == 'quiz_id'){
							 $insert_into_sqb_quiz_answers.= '%quizid%';
							} else if($row['Field'] == 'question_id'){
							 $insert_into_sqb_quiz_answers.= '%questionid%';
							} else if($row['Field'] == 'tag_ids'){

								// tag set name
								$tags = explode(',',$row3[$j]);



								$tnamearray = array();
								foreach ($tags as $key => $tag) {
									if($tag != 'NULL'){
										if(!empty($tagarray[$tag])){
											$tnamearray[] = '[tagname:'.$tagarray[$tag].']';
										}
									}
								}

								

								$insert_into_sqb_quiz_answers.= "'".implode(',',$tnamearray)."'";;
							
							} else if($row['Field'] == 'date'){
								$time = date("Y-m-d H:i:s", time() + $val->id);
								$insert_into_sqb_quiz_answers.= "'".$time."'"; 
							} else if(is_numeric($row3[$j])){
							 $insert_into_sqb_quiz_answers.= $row3[$j]; 
							} else {
								$answer_id = $val->id;
								$data_id = 'data-id="'.$answer_id.'"';
								$data_answer = 'data-id="%%ANSWERID%%"';
								$replace_answer_id[$data_id] = $data_answer; 
								
								preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
								$elements = $matches;
								
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements[1] as $key => $element){
										if(strpos($element, $url) != true){
										continue;
										}
										$ext = pathinfo($element, PATHINFO_EXTENSION);
										$filename = pathinfo($element, PATHINFO_FILENAME);
										$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									    $merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
										$replace_list[$element] = $merge_tag;
										$image_merge_tags[$merge_tag] = $merge_tag_as_key;
										$upload_images_list[$merge_tag_as_key] = $element;
									}
								 }
								
							  //$return.= ''.urldecode($row3[$j]).'';
							  $quiz_data = strtr(urldecode($row3[$j]),$replace_list);
							  $quiz_data = strtr(urldecode($quiz_data),$replace_answer_id);
							  $insert_into_sqb_quiz_answers.= "'".addslashes(strtr($quiz_data,$replace_plugin_url))."'";
							  
							}
						 } else { $insert_into_sqb_quiz_answers.= "'NULL'"; }
					if ($j < ($quiz_answers_num_fields-1)) { $insert_into_sqb_quiz_answers.= ','; }
					$j++;
				}
				if($k < count($sqb_quiz_answers_result)){
				$insert_into_sqb_quiz_answers.= "),\n";
				} else {
				$insert_into_sqb_quiz_answers.= ");\n";
				}
				$k++;
			}

		$return.= $insert_into_quiz_question_bank;	
		$return.= $insert_into_quiz_question;	
		$return.= $insert_into_sqb_quiz_answers;	
	}
	
	//Quiz Autoresponser data
	$describe_sqb_quiz_autoresponder_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_autoresponder_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_autoresponder_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$quiz_autoresponder_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_autoresponder_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($quiz_autoresponder_result) > 0){

		$return.= 'INSERT INTO `'.$sqb_quiz_autoresponder_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_autoresponder_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($quiz_autoresponder_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_autoresponder_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($quiz_autoresponder_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}
		
	//sqb_form_quiz export
	
	$sqb_form_quiz_table1 = 'sqb_form_quiz';
	$sqb_form_quiz_table = $prefix.'sqb_form_quiz';
	$sqb_form_quiz_table2 = $prefix2.'sqb_form_quiz';
	$describe_sqb_form_quiz_table = $wpdb->get_results('DESCRIBE '.$sqb_form_quiz_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_form_quiz_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);	
	$sqb_form_quiz_result = $wpdb->get_results(("SELECT * FROM $sqb_form_quiz_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_form_quiz_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_form_quiz_table2.'` (';
		$i=0;
		foreach($describe_sqb_form_quiz_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_form_quiz_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_form_quiz_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_form_quiz_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}
	
	//sqb_quiz_notifications export
	$sqb_quiz_notifications_table1 = 'sqb_quiz_notifications';		
	$sqb_quiz_notifications_table = $prefix.'sqb_quiz_notifications';	
	$sqb_quiz_notifications_table2 = $prefix2.'sqb_quiz_notifications';
	$describe_sqb_quiz_notifications_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_notifications_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_notifications_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);	
	$sqb_quiz_notifications_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_notifications_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_quiz_notifications_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_quiz_notifications_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_notifications_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_quiz_notifications_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_notifications_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_quiz_notifications_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}
	
	//sqb_quiz_points export	
	$sqb_quiz_points_table1 = 'sqb_quiz_points';	
	$sqb_quiz_points_table = $prefix.'sqb_quiz_points';	
	$sqb_quiz_points_table2 = $prefix2.'sqb_quiz_points';
	$describe_sqb_quiz_points_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_points_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_points_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);	
	$sqb_quiz_points_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_points_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_quiz_points_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_quiz_points_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_points_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_quiz_points_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_points_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_quiz_points_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}

	//sqb_quiz_points export	
	$sqb_advanced_rule_table1 = 'sqb_advanced_rule';	
	$sqb_advanced_rule_table = $prefix.'sqb_advanced_rule';	
	$sqb_advanced_rule_table2 = $prefix2.'sqb_advanced_rule';
	$describe_sqb_advanced_rule_table = $wpdb->get_results('DESCRIBE '.$sqb_advanced_rule_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_advanced_rule_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);	
	$sqb_advanced_rule_result = $wpdb->get_results(("SELECT * FROM $sqb_advanced_rule_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_advanced_rule_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_advanced_rule_table2.'` (';
		$i=0;
		foreach($describe_sqb_advanced_rule_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_advanced_rule_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_advanced_rule_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if($row['Field'] == 'category_id'){
							$cat = $row3[$j];
							
							if(!empty($catarray[$cat])){
								$return.= "'[catname:".$catarray[$cat]."]'";
							}else{
								$return.= "'0'";
							}
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_advanced_rule_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}

	// sqb_advanced_category_rule

	if($is_cat_enabled){

		$sqb_advanced_category_rule = 'sqb_advanced_category_rule';	
		$sqb_advanced_category_rule = $prefix.'sqb_advanced_category_rule';	
		$sqb_advanced_category_rule2 = $prefix2.'sqb_advanced_category_rule';
		$describe_sqb_advanced_category_rule = $wpdb->get_results('DESCRIBE '.$sqb_advanced_category_rule,ARRAY_A);
		$columns = array();
		foreach($describe_sqb_advanced_category_rule as $row) {
			$columns[] = $row['Field'];
		}
		$num_fields = count($columns);
		
		$sqb_category_advanced_rule_result = $wpdb->get_results(("SELECT * FROM $sqb_advanced_category_rule WHERE quiz_id = $quiz_ids and category_id IN(".implode(',',$attached_cat).")"), ARRAY_A);
		if(count($sqb_category_advanced_rule_result) > 0){
			$return.= 'INSERT INTO `'.$sqb_advanced_category_rule2.'` (';
			$i=0;
			foreach($describe_sqb_advanced_category_rule as $row) {
				if($i == 0){
				$i++;	
				continue;
				}
				
				if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
				if ($i < ($num_fields-1)) { $return.= ','; }
				$i++;
			} 
			$return.= ") VALUES ";
			$k=1;	
			foreach($sqb_category_advanced_rule_result as $keys => $val){
				$row3 = array_values((array)$val); 
				$return.= "(";
				$j=0;
				foreach($describe_sqb_advanced_category_rule as $row) {
					if($j == 0){
					$j++;
					continue;
					}
					
					if (isset($row3[$j])) {
							if($row['Field'] == 'quiz_id'){
									$return.= '%quizid%';
							} else if($row['Field'] == 'category_id'){
								$cat = $row3[$j];
								if(!empty($catarray[$cat])){
									$return.= "'[catname:".$catarray[$cat]."]'";
								}
							} else if(is_numeric($row3[$j])){
							$return.= $row3[$j]; 
							} else {
								
								preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
								$elements = $matches;
								
								$replace_list = array(); 
								if(count($elements) > 0){
									foreach($elements[1] as $key => $element){
										if(strpos($element, $url) != true){
										continue;
										}
										$ext = pathinfo($element, PATHINFO_EXTENSION);
										$filename = pathinfo($element, PATHINFO_FILENAME);
										$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
										$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
										$replace_list[$element] = $merge_tag;
										$image_merge_tags[$merge_tag] = $merge_tag_as_key;
										$upload_images_list[$merge_tag_as_key] = $element;
									}
								}
								
							//$return.= ''.urldecode($row3[$j]).'';
							$quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
							$return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
							}
						} else { $return.= "'NULL'"; }
					if ($j < ($num_fields-1)) { $return.= ','; }
					$j++;
				}
				if($k < count($sqb_category_advanced_rule_result)){
				$return.= "),\n";
				} else {
				$return.= ");\n";
				}
				$k++;
			}
		}
	}
	//sqb_quiz_tracking export
	$sqb_quiz_tracking_table1 = 'sqb_quiz_tracking';
	$sqb_quiz_tracking_table = $prefix.'sqb_quiz_tracking';	
	$sqb_quiz_tracking_table2 = $prefix2.'sqb_quiz_tracking';
	$describe_sqb_quiz_tracking_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_tracking_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_tracking_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);	
	$sqb_quiz_tracking_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_tracking_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_quiz_tracking_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_quiz_tracking_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_tracking_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_quiz_tracking_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_tracking_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_quiz_tracking_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}

	//Outcome mapping export
	$quiz_outcome_results = $wpdb->get_results(( "SELECT * FROM $sqb_quiz_outcome_table WHERE quiz_id = $quiz_ids"));
	$outcome_id_array = array();
	foreach($quiz_outcome_results as $quiz_outcome_results_data) {
		$outcome_id_array[] = $quiz_outcome_results_data->id;
	}
	
	$select_answer_ids = $wpdb->get_results(("SELECT id FROM $sqb_quiz_answers_table WHERE question_id IN (SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids)"));
	$answer_id_array = array();
	foreach($select_answer_ids as $key => $select_answer_ids_data){
		$answer_id_array[] = $select_answer_ids_data->id;
	}
	
	$sqb_outcome_mapping_table1 = 'sqb_outcome_mapping';
	$sqb_outcome_mapping_table = $prefix.'sqb_outcome_mapping';
	$sqb_outcome_mapping_table2 = $prefix2.'sqb_outcome_mapping';
	
	$describe_sqb_outcome_mapping_table = $wpdb->get_results('DESCRIBE '.$sqb_outcome_mapping_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_outcome_mapping_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$sqb_outcome_mapping_result = $wpdb->get_results(("SELECT * FROM $sqb_outcome_mapping_table WHERE quiz_id = $quiz_ids AND answer_id IN (SELECT id FROM $sqb_quiz_answers_table WHERE question_id IN (SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_ids))"), ARRAY_A);
	if(count($sqb_outcome_mapping_result) > 0){
	$return.= 'INSERT INTO `'.$sqb_outcome_mapping_table2.'` (';
		$i=0;
		foreach($describe_sqb_outcome_mapping_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		
		$k=1;	
		foreach($sqb_outcome_mapping_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_outcome_mapping_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if($row['Field'] == 'question_id'){
								$question_id_index = array_search($row3[$j], $question_id); // index;
								$return.= '%question_id_'.$question_id_index.'%';
						} else if($row['Field'] == 'answer_id'){
								$answer_id_index = array_search($row3[$j], $answer_id_array); // index;
								$return.= '%answer_id_'.$answer_id_index.'%';
						} else if($row['Field'] == 'outcome_id'){
							$searchForValue = ',';
							if(strpos($row3[$j], $searchForValue) !== false){
								$outcome_ids = explode(',',$row3[$j]);
								$outcome_merge_tag = array();
								foreach($outcome_ids as $key=>$val){
								$outcome_id_index = array_search($val, $outcome_id_array); // index;
									if((string)$outcome_id_index != ''){
										$outcome_merge_tag[] = '%outcome_id_'.$outcome_id_index.'%';
									}
								}
								$return.= "'".implode(',',$outcome_merge_tag)."'";
							} else {
								$outcome_id_index = array_search($row3[$j], $outcome_id_array); // index;
								if((string)$outcome_id_index != ''){
									$return.= '%outcome_id_'.$outcome_id_index.'%';
								}else{
									$return.= "''";
								}
							}
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else {
							
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }

						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_outcome_mapping_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}
		
	//Quiz funnel data
	$sqb_quiz_funnel_table1 = 'sqb_quiz_funnel';
	$sqb_quiz_funnel_table = $prefix.'sqb_quiz_funnel';
	$sqb_quiz_funnel_table2 = $prefix2.'sqb_quiz_funnel';
	
	$describe_sqb_quiz_funnel_table = $wpdb->get_results('DESCRIBE '.$sqb_quiz_funnel_table,ARRAY_A);
	$columns = array();
	foreach($describe_sqb_quiz_funnel_table as $row) {
		$columns[] = $row['Field'];
	}
	$num_fields = count($columns);
	
	$sqb_quiz_funnel_result = $wpdb->get_results(("SELECT * FROM $sqb_quiz_funnel_table WHERE quiz_id = $quiz_ids"), ARRAY_A);
	if(count($sqb_quiz_funnel_result) > 0){
		$return.= 'INSERT INTO `'.$sqb_quiz_funnel_table2.'` (';
		$i=0;
		foreach($describe_sqb_quiz_funnel_table as $row) {
			if($i == 0){
			$i++;	
			continue;
			}
			
			if (isset($row['Field'])) { $return.= '`'.$row['Field'].'`' ; } else { $return.= ''; }
			if ($i < ($num_fields-1)) { $return.= ','; }
			$i++;
		} 
		$return.= ") VALUES ";
		$k=1;	
		foreach($sqb_quiz_funnel_result as $keys => $val){
			$row3 = array_values((array)$val); 
			$return.= "(";
			$j=0;
			foreach($describe_sqb_quiz_funnel_table as $row) {
				if($j == 0){
				$j++;
				continue;
				}
				
				if (isset($row3[$j])) {
						if($row['Field'] == 'quiz_id'){
								$return.= '%quizid%';
						} else if(is_numeric($row3[$j])){
						 $return.= $row3[$j]; 
						} else if($row['Field'] == 'funnel_data'){
							$old_question_ids = implode(',',$question_id);
							$old_answer_ids = implode(',',$answer_id_array);
							$question_answer_ids = '<img src="'.$old_question_ids.'"><img src="'.$old_answer_ids.'">';
							$return.= "'".$question_answer_ids.addslashes(urldecode($row3[$j]))."'"; 
						} else {
							preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', urldecode($row3[$j]), $matches);
							$elements = $matches;
							
							$replace_list = array(); 
							if(count($elements) > 0){
								foreach($elements[1] as $key => $element){
									if(strpos($element, $url) != true){
									continue;
									}
									$ext = pathinfo($element, PATHINFO_EXTENSION);
									$filename = pathinfo($element, PATHINFO_FILENAME);
									$merge_tag = '%images||'.$sqb_quiz_template_table1.'||'.$filename.'||'.$ext.'%';
									$merge_tag_as_key = 'images/'.$sqb_quiz_template_table1.'/'.$filename.'/'.$ext;
									$replace_list[$element] = $merge_tag;
									$image_merge_tags[$merge_tag] = $merge_tag_as_key;
									$upload_images_list[$merge_tag_as_key] = $element;
								}
							 }
							
						  //$return.= ''.urldecode($row3[$j]).'';
						  $quiz_data = strtr(addslashes(urldecode($row3[$j])),$replace_list);
						  $return.= "'".strtr($quiz_data,$replace_plugin_url)."'";
						}
					 } else { $return.= "'NULL'"; }
				if ($j < ($num_fields-1)) { $return.= ','; }
				$j++;
			}
			if($k < count($sqb_quiz_funnel_result)){
			$return.= "),\n";
			} else {
			$return.= ");\n";
			}
			$k++;
		}
	}
			
	$return.="\n\n\n"; 
	
	//ob_clean();
	//$export_directory = 'exports';
	$export_directory = plugin_dir_path( __FILE__ ).'export/';
	@rmdir($export_directory);
	@mkdir($export_directory);

	//$sql_file = 'db-backup-'.time().'-'.(md5(implode(',',$table_name))).'.sql';
	$sql_file = 'db-backup-'.time().'.sql';
	//$zip_file = 'db-backup-'.time().'-'.(md5(implode(',',$table_name))).'.zip';
	$zip_file = 'db-backup-'.time().'.zip';
	
	$handle = fopen($export_directory.'/'.$sql_file,'w+');
	fwrite($handle,$return);
	
	if(fclose($handle)){
		$files = array($sql_file);
		foreach($upload_images_list as $key => $images){
			$files[$key] = $images;
		}
		
		// Directory of files
		//$filesPath = plugin_dir_path( __FILE__ ).$export_directory.'/';
		$filesPath = $export_directory;
		$image_file_path = $export_directory;
		// Name of creating zip file
		$zipFileName = $zip_file;
		//createZipAndDownload($files, $filesPath, $zipName);

		// Create instance of ZipArchive. and open the zip folder.
		$zip = new \ZipArchive();
		if ($zip->open($export_directory.'/'.$zipFileName, \ZipArchive::CREATE) !== TRUE) {
			//exit("cannot open <$zipFileName>\n");
		}

		// Adding every attachments files into the ZIP.
		foreach ($files as $key => $file) {
			

			if(strpos($file, '.mp4') !== false || strpos($file, '.mkv') !== false || strpos($file, '.webm') !== false){
				continue;
			}

			if(filter_var($file, FILTER_VALIDATE_URL)) { 
				//file_put_contents($img, file_get_contents($url));
				$get_file = file_get_contents($file);
				$zip->addFromString($key.'/'.basename($file), $get_file);
			} else {
				$zip->addFile($filesPath.$file,$file);
			}
		}
		$zip->close();
	}
	
	$fileurl = plugin_dir_url( __FILE__ ).'export/'.$zipFileName;
	echo json_encode(array('fileurl' => $fileurl));die;
}


function sqb_get_mergetags_between($string, $start, $tablename){
	$url = preg_replace("(^https?://)", "", site_url());
	if($tablename == 'sqb_quiz'){
		$merge_tags_arr = array();
		
		$plugin_url = plugin_dir_url( __DIR__ ).'images/import/';
		$replace_destination_path = array('%PLUGIN_IMG_URLS%' => $plugin_url);
		$string = strtr($string, $replace_destination_path);
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($string), $matches1);
		$elements = $matches1;
			
		if(count($elements) > 0){
			foreach($elements as $key => $element){
				foreach($element as $elemente){
				if(strpos($elemente, $url) != true){
				continue;
				}
			
				$elemente = substr($elemente, 0, strpos($elemente, "|"));
				
				$fileinfo = explode('/',$elemente);
				$new_array = array_reverse($fileinfo);
					if (strpos($new_array[0], 'css') !== false) {
					} else {
					$img_path = 'images/sqb_quiz/'.$new_array[1].'/'.$new_array[0].'/'.$new_array[1].'.'.$new_array[0];
					$urls = '%PLUGIN_IMG_URLS%sqb_quiz/'.$new_array[1].'/'.$new_array[0];
					//$elements = $element.'/'.$new_array[1].'.'.$new_array[0];
					$merge_tags_arr[$img_path] = $urls;
					}
				}
			}
		 }
		
		preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', stripslashes($string), $matches);
		$merge_tags = $matches[1];
		foreach($merge_tags as $key => $value){
			if(strpos($value,'%images') !== false){	
			$str = str_replace("%","",$value);	
			$image_path_arr = explode('||',$str);
			$images_path = $image_path_arr[0].'/'.$image_path_arr[1].'/'.$image_path_arr[2].'/'.$image_path_arr[3].'/'.$image_path_arr[2].'.'.$image_path_arr[3];
			$merge_tags_arr[$images_path] = $value;
			}  
		}
		return $merge_tags_arr;
		
	} elseif($tablename == 'sqb_quiz_question_bank'){
		$merge_tags_arr = array(); 
		
		$plugin_url = plugin_dir_url( __DIR__ ).'images/import/';
		$replace_destination_path = array('%PLUGIN_IMG_URLS%' => $plugin_url);
		$string = strtr($string, $replace_destination_path);
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($string), $matches1);
		$elements = $matches1;
			
		if(count($elements) > 0){
			foreach($elements as $key => $element){
				foreach($element as $elemente){
				if(strpos($elemente, $url) != true){
				continue;
				}
			
				//$elemente = substr($elemente, 0, strpos($elemente, "|"));
				
				$fileinfo = explode('/',$elemente);
				$new_array = array_reverse($fileinfo);
					if (strpos($new_array[0], 'css') !== false) {
					} else {
					$img_path = 'images/sqb_quiz_question_bank/'.$new_array[1].'/'.$new_array[0].'/'.$new_array[1].'.'.$new_array[0];
					$urls = '%PLUGIN_IMG_URLS%sqb_quiz_question_bank/'.$new_array[1].'/'.$new_array[0];
					//$elements = $element.'/'.$new_array[1].'.'.$new_array[0];
					$merge_tags_arr[$img_path] = $urls;
					}
				}
			}
		 }
		
		preg_match_all('/https?\:\/\/[^\",]+/i', $string, $matches2);
		$elements = $matches2;
		if(count($elements[0]) > 0){
			foreach($elements[0] as $key => $element){
				$element = substr($element, 0, strpos($element, "||"));
				$fileinfo = explode('/',$element);
				$new_array = array_reverse($fileinfo);
				$img_path = 'images/sqb_quiz_question_bank/'.@$new_array[1].'/'.@$new_array[0].'/'.@$new_array[1].'.'.@$new_array[0];
				$urls = '%PLUGIN_IMG_URLS%sqb_quiz_question_bank/'.@$new_array[1].'/'.@$new_array[0];
				//$elements = $element.'/'.$new_array[1].'.'.$new_array[0];
				$merge_tags_arr[$img_path] = $urls;
			}
		}
		
		preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', stripslashes($string), $matches3);
		$merge_tags = $matches3[1];
		foreach($merge_tags as $key => $value){
			if(strpos($value,'%images') !== false){	
			$str = str_replace("%","",$value);	
			$image_path_arr = explode('||',$str);
			$images_path = $image_path_arr[0].'/'.$image_path_arr[1].'/'.$image_path_arr[2].'/'.$image_path_arr[3].'/'.$image_path_arr[2].'.'.$image_path_arr[3];
			$merge_tags_arr[$images_path] = $value;
			}  
		}
		
		return $merge_tags_arr;
	} elseif($tablename == 'sqb_quiz_template'){
		$plugin_url = plugin_dir_url( __DIR__ ).'images/import/';
		$replace_destination_path = array('%PLUGIN_IMG_URLS%' => $plugin_url);
		$string = strtr($string, $replace_destination_path);
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($string), $matches);
		$elements = $matches;
		
		$merge_tags_arr = array();		
		if(count($elements) > 0){
			foreach($elements as $key => $element){
				
				foreach($element as $elemente){
					
				if(strpos($elemente, $url) != true){
				continue;
				}
				
				//$elemente = substr($elemente, 0, strpos($elemente, "&quot"));
				
				$fileinfo = explode('/',$elemente);
				$new_array = array_reverse($fileinfo);
					if (strpos($new_array[0], 'css') !== false) {
					} else {
					$img_path = 'images/sqb_quiz_template/'.$new_array[1].'/'.$new_array[0].'/'.$new_array[1].'.'.$new_array[0];
					$urls = '%PLUGIN_IMG_URLS%sqb_quiz_template/'.$new_array[1].'/'.$new_array[0];
					//$elements = $element.'/'.$new_array[1].'.'.$new_array[0];
					$merge_tags_arr[$img_path] = $urls;
					}
				}
			}
		 }
		return $merge_tags_arr;
	} elseif($tablename == 'sqb_quiz_outcome'){
		$plugin_url = plugin_dir_url( __DIR__ ).'images/import/';
		$replace_destination_path = array('%PLUGIN_IMG_URLS%' => $plugin_url);
		$string = strtr($string, $replace_destination_path);
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', urldecode($string), $matches);
		$elements = $matches;
		$merge_tags_arr = array();		
		if(count($elements) > 0){
			foreach($elements as $key => $element){
				
				foreach($element as $elemente){
					
				if(strpos($elemente, $url) != true){
				continue;
				}
				
				$elemente = substr($elemente, 0, strpos($elemente, "&quot"));
				$fileinfo = explode('/',$elemente);
				$new_array = array_reverse($fileinfo);
				$img_path = 'images/sqb_quiz_outcome/'.$new_array[1].'/'.$new_array[0].'/'.$new_array[1].'.'.$new_array[0];
				$urls = '%PLUGIN_IMG_URLS%sqb_quiz_outcome/'.$new_array[1].'/'.$new_array[0];
				//$elements = $element.'/'.$new_array[1].'.'.$new_array[0];
				$merge_tags_arr[$img_path] = $urls;
				}
			}
		 }
		return $merge_tags_arr;
	} else {
		preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', stripslashes($string), $matches);
		$merge_tags = $matches[1];
		$merge_tags_arr = array();
		foreach($merge_tags as $key => $value){
			if(strpos($value,'%images') !== false){	
			$str = str_replace("%","",$value);	
			$image_path_arr = explode('||',$str);
			$images_path = $image_path_arr[0].'/'.$image_path_arr[1].'/'.$image_path_arr[2].'/'.$image_path_arr[3].'/'.$image_path_arr[2].'.'.$image_path_arr[3];
			$merge_tags_arr[$images_path] = $value;
			}  
		}
		return $merge_tags_arr;
	}	
}


function sqb_check_array_contains_array(array $array) {
  $result = false;
  foreach ($array as $key => $el) {
    if (is_array($el)) {
      $result = true;
      break;
    }
  }
  return $result;
}

add_action('wp_ajax_sqb_import_zip', 'SqbImportQuiz');
add_action('wp_ajax_nopriv_sqb_import_zip', 'SqbImportQuiz');
function SqbImportQuiz(){


 	if ( !current_user_can( 'manage_options' ) ) {
        return json_encode(array('error' => 'Not allowed to access'));die;  
    }
    //check_admin_referer('sqb_import', 'security');

	if($_FILES["zip_file"]["name"]) {
		$filename = $_FILES["zip_file"]["name"];
		$source = $_FILES["zip_file"]["tmp_name"];
		$type = $_FILES["zip_file"]["type"];
		$name = explode(".", $filename);
		$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			} 
		}
		
		$continue = strtolower($name[1]) == 'zip' ? true : false;
		if(!$continue) {
			$message = "The file you are trying to upload is not a .zip file. Please try again.";
		} else {
		
			$strtotime = strtotime("now");
			$target_path = plugin_dir_path( __FILE__ ).'export/';  // change this to the correct site path
			@mkdir($target_path);
			$target_path_name = plugin_dir_path( __FILE__ ).'export/'.$filename;  // change this to the correct site path
			if(move_uploaded_file($source, $target_path_name)) {
				$zip = new ZipArchive();
				$x = $zip->open($target_path_name);
				if ($x === true) {
					$zip->extractTo($target_path); // change this to the correct site path
					$zip->close();
					unlink($target_path_name);
				}
				//echo $message = "Your .zip file was uploaded and unpacked.";
				
				global $wpdb;
				$prefix = $wpdb->prefix;
				$import_directory_path = plugin_dir_path( __FILE__ ).'export';
				
				
				$files_list = scandir($import_directory_path);
				$import_directory = $import_directory_path.'/'.$files_list[2];
				$templine = '';
				
				$lines = file($import_directory);// Read in entire file
				
				// Loop through each line
				$quiz_id_arr = array();
				$i = 0; 
				foreach ($lines as $line)
				{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					$trans = array("%wpprefix%" => $prefix);//rplace a merge tag with base Url.
					$sql = strtr($templine, $trans);
					// Perform the query
					//mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
					
					$table = explode(' ',$sql);
					$table_name = str_replace($prefix,"",$table[2]);
					$table_name = preg_replace('/[^a-zA-Z0-9_.]/', '', $table_name);
					
					$images_array = sqb_get_mergetags_between($sql,'%images', $table_name);
					
					
					@mkdir(plugin_dir_path( __DIR__ ).'images/import/');
					$destination_path = plugin_dir_path( __DIR__ ).'images/import/';
					$source_path = plugin_dir_path( __FILE__ ).'export/';
					$plugin_url = plugin_dir_url( __DIR__ ).'images/import/';
					if(!empty($images_array)){
						$replace_mergetags = array();
						foreach($images_array as $image => $image_merge_tag){
							$filename = basename($image);
							$src_image = $source_path.$image;
							$dest_image = $destination_path.$filename;
							@rename($src_image,$dest_image);
							$image_url = $plugin_url.$filename;
							
							$replace_mergetags[$image_merge_tag] = $image_url;  
						}
						$sql = strtr($sql, $replace_mergetags);
					}
					
					
					$replace_destination_path = array('%PLUGIN_IMG_URLS%' => $plugin_url, '%SQB_SITE_URL%' => get_site_url());
					$sql = strtr($sql, $replace_destination_path);
					
					if(empty($quiz_id_arr)){
						$wpdb->query($sql);
						$quiz_id_arr[] = $wpdb->insert_id;
						//$quiz_id_arr[] = 43;
					} else {
						if ((strpos($sql, 'sqb_quiz_question_bank') !== false) || (strpos($sql, 'sqb_quiz_answers') !== false) || (strpos($sql, 'sqb_quiz_questions') !== false) || (strpos($sql, 'sqb_outcome_mapping') !== false) || (strpos($sql, 'sqb_quiz_funnel') !== false) || (strpos($sql, 'sqb_quiz_outcome') !== false) || (strpos($sql, 'sqb_global_theme') !== false) || (strpos($sql, 'sqb_advanced_rule') !== false) || (strpos($sql, 'sqb_advanced_category_rule') !== false)) {
							if((strpos($sql, 'sqb_quiz_question_bank') !== false)){
								$question_id_arr = array();

								$sqb_quiz_category_table = $prefix.'sqb_quiz_category';
								$pattern = '/\[catname:[^\]]*\]/';
								preg_match_all($pattern, $sql, $catmatch);

								//exit;
								foreach ($catmatch[0] as $key => $m) {

									$cat_name = str_replace(['[catname:',']'],'',$m);
									$dbcat = $wpdb->get_var("SELECT id FROM $sqb_quiz_category_table WHERE name ='".$cat_name."'");
									
									if(!empty($dbcat)){
										$sql = str_replace($m, $dbcat, $sql);
									}
								}
								
								$wpdb->query($sql);
								$question_id_arr[] = $wpdb->insert_id;
								
								//$question_id_arr[] = '222'.$i;
							} else if((strpos($sql, 'sqb_global_theme') !== false)) {
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sqlg = strtr($sql, $replace_quiz_id);

								$sqlg = do_shortcode($sqlg);
								
								$wpdb->query($sqlg);
								

							} else if((strpos($sql, 'sqb_quiz_questions') !== false)) {
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sql1 = strtr($sql, $replace_quiz_id);	
								$replace_question_id = array("%questionid%" => $question_id_arr[0]);//replace question_id merge tag.
								$sql1 = strtr($sql1, $replace_question_id);	
								$plugins_url = plugins_url();
								$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
								$sql1 = strtr($sql1, $replace_plugin_url);	
								$wpdb->query($sql1);
								
							} else if((strpos($sql, 'sqb_quiz_answers') !== false)) {
								$ans_id_arr = array();
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sql1 = strtr($sql, $replace_quiz_id);	
								$replace_question_id = array("%questionid%" => $question_id_arr[0]);//replace question_id merge tag.
								$sql1 = strtr($sql1, $replace_question_id);	
								$plugins_url = plugins_url();
								$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
								$sql1 = strtr($sql1, $replace_plugin_url);	

								//echo $sql1;

								// Tag Proccess

								$sqb_quiz_tags_table = $prefix.'sqb_tags'; 
								$pattern = '/\[tagname:[^\]]*\]/';
								preg_match_all($pattern, $sql1, $tagmatch);

								
								//exit;
								foreach ($tagmatch[0] as $key => $m) {

									$tag_name = str_replace(['[tagname:',']'],'',$m);
									$dbtag = $wpdb->get_var("SELECT id FROM $sqb_quiz_tags_table WHERE name ='".$tag_name."'");
									
									if(!empty($dbtag)){
										$sql1 = str_replace($m, $dbtag, $sql1);
									}
								}
								

								$wpdb->query($sql1);

							} else if((strpos($sql, 'sqb_advanced_rule') !== false) || (strpos($sql, 'sqb_advanced_category_rule') !== false)) {
								
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sql = strtr($sql, $replace_quiz_id);

								$sqb_quiz_category_table = $prefix.'sqb_quiz_category';
								$pattern = '/\[catname:[^\]]*\]/';
								preg_match_all($pattern, $sql, $catmatch);

								//exit;
								foreach ($catmatch[0] as $key => $m) {

									$cat_name = str_replace(['[catname:',']'],'',$m);
									$dbcat = $wpdb->get_var("SELECT id FROM $sqb_quiz_category_table WHERE name ='".$cat_name."'");
									
									if(!empty($dbcat)){
										$sql = str_replace($m, $dbcat, $sql);
									}
								}

								try{
									
									$wpdb->query($sql);
								}catch(Exception $e) {

								}
							} else if((strpos($sql, 'sqb_tags') !== false)) {
								$sqb_quiz_tags_table = $prefix.'sqb_tags'; 
								try{
									$wpdb->query($sql);
								}catch(Exception $e) {

								}
							} else if((strpos($sql, 'sqb_quiz_outcome') !== false)){

								$sqb_quiz_outcome_table = $prefix.'sqb_quiz_outcome'; 

								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag with last insert id.
								$sql = strtr($sql, $replace_quiz_id);	
								$plugins_url = plugins_url();
								$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
								$sql = strtr($sql, $replace_plugin_url);	


								// Tag Proccess

								$sqb_quiz_tags_table = $prefix.'sqb_tags'; 
								$pattern = '/\[tagname:[^\]]*\]/';
								preg_match($pattern, $sql, $tagmatch);

								$tag_name = str_replace(['[tagname:',']'],'',@$tagmatch[0] ?? '');
								$dbtag = $wpdb->get_var("SELECT id FROM $sqb_quiz_tags_table WHERE name ='".$tag_name."'");

								if(!empty($dbtag)){
									$sql = preg_replace($pattern, $tag_name, $sql);
								}

								$wpdb->query($sql);

							} else if((strpos($sql, 'sqb_outcome_mapping') !== false)){
								
								$sqb_quiz_questions_table = $prefix.'sqb_quiz_questions'; 
								$sqb_quiz_outcome_table = $prefix.'sqb_quiz_outcome'; 
								$sqb_quiz_answer_table = $prefix.'sqb_quiz_answers'; 
								
								$select_questions_ids = $wpdb->get_results($wpdb->prepare("SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_id_arr[0]"));
								$replace_question_id_array = array();
								if(isset($select_questions_ids)){
									foreach($select_questions_ids as $key => $select_questions_ids_data){
										$replace_question_id_array['%question_id_'.$key.'%'] = $select_questions_ids_data->question_id;
									}
								}
								
								$select_outcome_ids = $wpdb->get_results($wpdb->prepare("SELECT id FROM $sqb_quiz_outcome_table WHERE quiz_id = $quiz_id_arr[0]"));
								$replace_outcome_id_array = array();
								if(isset($select_outcome_ids)){
									foreach($select_outcome_ids as $key => $select_outcome_ids_data){
										$replace_outcome_id_array['%outcome_id_'.$key.'%'] = $select_outcome_ids_data->id;
									}
								}
								
								$select_answer_ids = $wpdb->get_results($wpdb->prepare("SELECT id FROM $sqb_quiz_answer_table WHERE question_id IN (SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_id_arr[0])"));
								$replace_answer_id_array = array();
								if(isset($select_answer_ids)){
									foreach($select_answer_ids as $key => $select_answer_ids_data){
										$replace_answer_id_array['%answer_id_'.$key.'%'] = $select_answer_ids_data->id;
									}
								}
								
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sql1 = strtr($sql, $replace_quiz_id);
								
								$replace_question_id = $replace_question_id_array;//replace question_id merge tag.
								$sql1 = strtr($sql1, $replace_question_id);	
								
								$replace_outcome_id = $replace_outcome_id_array;//replace outcome_id merge tag.
								$sql1 = strtr($sql1, $replace_outcome_id);
								
								$replace_answer_id = $replace_answer_id_array;//replace answer id merge tag.
								$sql1 = strtr($sql1, $replace_answer_id);
								
								$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
								$sql1 = strtr($sql1, $replace_plugin_url);
								
								$wpdb->query($sql1);
								
							} else if((strpos($sql, 'sqb_quiz_funnel') !== false)){
								
								$sqb_quiz_funnel_table = $prefix.'sqb_quiz_funnel';
								$sqb_quiz_questions_table = $prefix.'sqb_quiz_questions'; 
								$sqb_quiz_answer_table = $prefix.'sqb_quiz_answers'; 
								
								$select_questions_ids = $wpdb->get_results($wpdb->prepare("SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_id_arr[0]"));
								$new_question_id_array = array();
								if(isset($select_questions_ids)){
									foreach($select_questions_ids as $key => $select_questions_ids_data){
										$new_question_id_array[] = $select_questions_ids_data->question_id;
									}
								}
								
								$select_answer_ids = $wpdb->get_results($wpdb->prepare("SELECT id FROM $sqb_quiz_answer_table WHERE question_id IN (SELECT question_id FROM $sqb_quiz_questions_table WHERE quiz_id = $quiz_id_arr[0]) ORDER BY date ASC"));
								$new_answer_id_array = array();
								if(isset($select_answer_ids)){
									foreach($select_answer_ids as $key => $select_answer_ids_data){
										$new_answer_id_array[] = $select_answer_ids_data->id;
									}
								}
								
								preg_match_all('/<img.*?src=[\'"](.*?)[\'"].*?>/i', stripslashes($sql), $matches);
								$funnel_data = $matches[1];
								$output = array();
								
								$output['old_question_id'] = explode(',',$funnel_data[0]);
								$output['old_answer_id'] = explode(',',$funnel_data[1]);
								$output['new_question_id'] = $new_question_id_array;
								$output['new_answer_id'] = $new_answer_id_array;
								
								$sql1 = preg_replace("/<img[^>]+\>/i", "", $sql);
								
								$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag.
								$sql1 = strtr($sql1, $replace_quiz_id);
								$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
								$sql1 = strtr($sql1, $replace_plugin_url);
								$wpdb->query($sql1);
								
								$get_funnel_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $sqb_quiz_funnel_table WHERE quiz_id = $quiz_id_arr[0]"));
								if(isset($get_funnel_data)){
								$funnelData = $get_funnel_data->funnel_data;
								$funnelId = $get_funnel_data->id;
								$quizId = $get_funnel_data->quiz_id;
								$funneldate	 = $get_funnel_data->date;
								$funnelname = $get_funnel_data->funnel_name;
								$newFunnelData = sqbGetCloneFunnelData($funnelData, $output);
								$sqbData = new SQB_Funnel();
								$sqbData->setFunnelData($newFunnelData);
								$sqbData->setQuizId($quizId);
								$sqbData->setFunnelName($funnelname);
								$sqbData->setDate($funneldate);
								$sqbData->setId($funnelId);
								$sqbData->update();
								}
				
							}
						} else {
							$replace_quiz_id = array("%quizid%" => $quiz_id_arr[0]);//replace quiz_id merge tag with last insert id.
							$sql = strtr($sql, $replace_quiz_id);	
							$plugins_url = plugins_url();
							$replace_plugin_url = array("%PLUGINURL%" => $plugins_url);//rplace a base url with merge tag.
							$sql = strtr($sql, $replace_plugin_url);	
							$wpdb->query($sql);
						}
						
					}
					// Reset temp variable to empty
					$templine = '';
					$i++;
				}
				
				}
				
				sqb_deleteAll($import_directory_path);
				//exit;
				$message = "Quiz imported successfully";
			} else {	
				$message = "There was a problem with the import. Please try again.";
			}
		}
	} else {
		$message = "There is an error in file uploded";
	}
	echo json_encode(array('message' => $message));die;
}

function sqb_deleteAll($str) {
    // Check for files
    if (is_file($str)) {
        // If it is file then remove by
        // using unlink function
        return unlink($str);
    }
    // If it is a directory.
    elseif (is_dir($str)) {
        // Get the list of the files in this
        // directory
        $scan = glob(rtrim($str, '/').'/*');
        // Loop through the list of files
        foreach($scan as $index=>$path) {
            // Call recursive function
            sqb_deleteAll($path);
        }
        // Remove the directory itself
        return @rmdir($str);
    }
}


add_action('wp_ajax_SQBOutcomeSpiderchartAjax', 'SQBOutcomeSpiderchartAjax');
add_action('wp_ajax_nopriv_SQBOutcomeSpiderchartAjax', 'SQBOutcomeSpiderchartAjax');
function SQBOutcomeSpiderchartAjax(){
	$ignore_userids = '';
	$start_date = '';
	$end_date = '';
	$quiz_id = $_POST['sqb_quiz_id'];
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	
	if(isset($quiz_obj)){
		$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
		$result = explode('|',$getOutcomeScreenChartsSettings);
		
		$user_ids = array();
		$admins_ids = array();
		
		$result[3] = !empty($result[3]) ? $result[3] : '';
		if($result[3] == 'admin_users'){
		$admins_ids = get_users( array( 'fields' => 'role', 'role' => 'administrator' ) );
			foreach($admins_ids as $users_id){
				$the_user = get_userdata((int) $users_id);
				if(isset($the_user->data)){
					 $userdata = $the_user->data;
					if($userdata->user_email != ''){
					$user = SQB_InternalUsers::loadByEmail($userdata->user_email);
						if(!empty($user)){
						$user_ids[] = $user->getId();
						}
					}
				}
			}
		}
		
		$result[4] = !empty($result[4]) ? $result[4] : '';
		$result[5] = !empty($result[5]) ? $result[5] : '';
		if($result[4] == 'other_users'){
			$emails_array = explode(',',$result[5]);
			foreach($emails_array as $email){
				if($email != ''){
					$user = SQB_InternalUsers::loadByEmail($email);
					//$user = get_user_by('email', $email);	
					if(!empty($user)){
					$user_ids[] = $user->getId();
					}
				}
			}
		}
		
		
		$ignore_userids = array_unique(array_merge($user_ids,$admins_ids));
		
		$result[7] = !empty($result[7]) ? $result[7] : '';
		$result[8] = !empty($result[8]) ? $result[8] : '';
		if($result[7] == 'Y' && $result[8] != ''){
		$start_date = date("Y-m-d",strtotime($result[8]));
		$end_date = date("Y-m-d");
		}
	}
    
	$outcomes_data = SQB_Outcome::loadByQuizId($quiz_id);
	if(isset($outcomes_data)){
		$labels = array();
		$data = array();
		foreach($outcomes_data as $outcome){
			$outcome_name = $outcome->getOutcomeName();
			if (strlen($outcome_name) > 50)
			{
			$labels[] = substr($outcome_name, 0, 50) . '[...]';
			} else {
			$labels[] = $outcome_name;
			}
			//$quiz_outcome_data = SQB_ManageLeads::loadByQuizIdAndOutcomeId($quiz_id,$outcome->getId());
			$quiz_outcome_data = SQB_ManageLeads::loadByQuizIdOutcomeIdStartDateEndDateAcceptUserids($quiz_id,$outcome->getId(),$start_date,$end_date,$ignore_userids);
			$data[] = !empty($quiz_outcome_data) ? count($quiz_outcome_data) : 0;
		}
	}

	$result[17] = !empty($result[17]) ? $result[17] : '';
	$result[15] = !empty($result[15]) ? $result[15] : '';
	if(!empty($data) && $result[17] == 'Y' && $result[15] != 'category_based'){

		$total = array_sum($data);
		$datanew = array();
		foreach ($data as $value) {
			$percentage = ($value / $total) * 100;
			$datanew[] = round($percentage, 2);
		}

		$data = $datanew;

	}
	
	//$data = array(52,58,67,77);
	$outcomes_array = array('labels'=>$labels, 'data'=>$data);

	if(isset($_POST['is-v2']))
		return $outcomes_array;
	else
		echo json_encode($outcomes_array);die;
}


add_action('wp_ajax_SQBOutcomebarchartAjax', 'SQBOutcomebarchartAjax');
add_action('wp_ajax_nopriv_SQBOutcomebarchartAjax', 'SQBOutcomebarchartAjax');
function SQBOutcomebarchartAjax(){
	$quiz_id = $_POST['sqb_quiz_id'];
	$ignore_userids = '';
	$start_date = '';
	$end_date = '';
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	if(isset($quiz_obj)){
		$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
		$result = explode('|',$getOutcomeScreenChartsSettings);
		
		$user_ids = array();
		$admins_ids = array();
		if(isset($result[3]) && $result[3] == 'admin_users'){
		$admins_ids = get_users( array( 'fields' => 'role', 'role' => 'administrator' ) );
			foreach($admins_ids as $users_id){
				$the_user = get_userdata((int) $users_id);
				if(isset($the_user->data)){
					 $userdata = $the_user->data;
					if($userdata->user_email != ''){
					$user = SQB_InternalUsers::loadByEmail($userdata->user_email);
						if(!empty($user)){
						$user_ids[] = $user->getId();
						}
					}
				}
			}
		}
		
		if(isset($result[4]) && $result[4] == 'other_users'){
			$emails_array = explode(',',$result[5]);
			foreach($emails_array as $email){
				if($email != ''){
					$user = SQB_InternalUsers::loadByEmail($email);
					//$user = get_user_by('email', $email);	
					if(!empty($user)){
					$user_ids[] = $user->getId();
					}
				}
			}
		}
		$ignore_userids = array_unique(array_merge($user_ids,$admins_ids));
		
		$result[7] = !empty($result[7]) ? $result[7] : '';
		$result[8] = !empty($result[8]) ? $result[8] : '';
		if($result[7] == 'Y' && $result[8] != ''){
		$start_date = date("Y-m-d",strtotime($result[8]));
		$end_date = date("Y-m-d");
		}
	}
	
	$outcomes_data = SQB_Outcome::loadByQuizId($quiz_id);
	if(isset($outcomes_data)){
		$labels = array();
		$data = array();
		foreach($outcomes_data as $outcome){
			$outcome_name = $outcome->getOutcomeName();
			if (strlen($outcome_name) > 50)
			{
			$labels[] = substr($outcome_name, 0, 50) . '[...]';
			} else {
			$labels[] = $outcome_name;
			}
			
			//$quiz_outcome_data = SQB_ManageLeads::loadByQuizIdAndOutcomeId($quiz_id,$outcome->getId());
			$quiz_outcome_data = SQB_ManageLeads::loadByQuizIdOutcomeIdStartDateEndDateAcceptUserids($quiz_id,$outcome->getId(),$start_date,$end_date,$ignore_userids);
			
			$data[] = !empty($quiz_outcome_data) ? count($quiz_outcome_data) : 0;
		}
	}
	//$data = array(52,58,67,77);
	
	$result[17] = !empty($result[17]) ? $result[17] : '';
	$result[15] = !empty($result[15]) ? $result[15] : '';
	if(!empty($data) && $result[17] == 'Y' && $result[15] != 'category_based'){

		$total = array_sum($data);
		$datanew = array();
		foreach ($data as $value) {
			$percentage = ($value / $total) * 100;
			$datanew[] = round($percentage, 2);
		}

		$data = $datanew;

	}

	$outcomes_array = array('labels'=>$labels, 'data'=>$data);

	if(isset($_POST['is-v2']))
		return $outcomes_array;
	else
	echo json_encode($outcomes_array);die;
}

//SQBQuestionsbarchartAjax
add_action('wp_ajax_SQBQuestionsbarchartAjax', 'SQBQuestionsbarchartAjax');
add_action('wp_ajax_nopriv_SQBQuestionsbarchartAjax', 'SQBQuestionsbarchartAjax');

function SQBQuestionsbarchartAjax(){
	
	$start_date = '';
	$end_date = '';
	$quiz_id = $_POST['sqb_quiz_id'];
	$chart_type = isset($_POST['chart_type']) ? $_POST['chart_type'] : '';
	$user_id = $_POST['user_id'];
	
	$sqb_QA_charts_heading_message = 'Question / Answer Details:';
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	if(isset($quiz_obj)){
		
		$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
		$result = explode('|',$getOutcomeScreenChartsSettings);

		
		
		if(isset($_REQUEST['is-v2'])){
			$chart_type = @$result[15];
		}

		$result[7] = !empty($result[7]) ? $result[7] : '';
		$result[8] = !empty($result[8]) ? $result[8] : '';
		if($result[7] == 'Y' && $result[8] != ''){
		$start_date = date("Y-m-d",strtotime($result[8]));
		$end_date = date("Y-m-d");
		}

		$sqb_QA_charts_heading_message = @urldecode(@$result[16]);
	}

	if(isset($_POST['sqb_question_id']) && $_POST['sqb_question_id'] > 0){
		$questions_array = array();
		$questions_array[] = $_POST['sqb_question_id'];
	}
	
	if($start_date == ''){
		$start_date = date("Y-m-d",strtotime('-6 month'));
	}

	if($end_date == ''){
		$end_date = date("Y-m-d");
	}

	$select_question_html = '';
	$questions_data = SQB_QuizQuestions::loadByQuizIdAndOrder($quiz_id);
	
	$select_question_html .= '<div class="sqb_QA_chart_heading"><strong>'.$sqb_QA_charts_heading_message.'</strong></div><div class="sqb_select_questions"><label>Select Question:</label> <select name="select_question_id" id="select_question_id" data-quizid="'.$quiz_id.'">';
	if(isset($questions_data)){
		foreach($questions_data as $questions){
			$question_id = $questions->getQuestionId();
			$questions_array[] = $question_id;
			$quiz_question_data = SQB_QuizQuestionBank::loadById($question_id);
			
			$selected = '';
			if(isset($_POST['sqb_question_id']) && $_POST['sqb_question_id'] > 0){
				if($_POST['sqb_question_id'] == $question_id){
					$selected = "selected='selected'";
				}
			}
			
			$select_question_html .= '<option value="'.$quiz_question_data->id.'"  '.$selected.'>'.stripslashes($quiz_question_data->question_title).'</option>';
		}
	}
	$select_question_html .= '</select></div>';
	
	if($chart_type != 'outcome_based'){
	
	$ansdata="";
	$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizId($user_id, $quiz_id);
	$sqbQuizData = SQB_Quiz::loadById($user_id, $quiz_id);
	if($sqbQuizData != false){
		$quiz_type = $sqbQuizData->getQuizType();		
	}
	$randval = rand(1,100);	
	
	if(isset($sqbloadquestionsobj)){ 
		foreach($sqbloadquestionsobj as $quet_id => $questions) {
			
			$question_id = $questions->getQuestionId();
			if($question_id == $questions_array[0]){
			$answer_given = $questions->getAnswerGiven();			 	
			$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;			
			
			if(isset($sqbquestionobj)){	
					$question_type = $sqbquestionobj->getQuestionType();				 
					$ansdata1 = getAnswersById($answer_given, " active-item ",$question_type,$question_id);		
					if($ansdata1 == ''){
						$ansdata = '';
					}else{					 
						$ansdata = $ansdata1;
					}
					
					if($question_type == 'matrix'){
						$ansdata = stripslashes($ansdata);		 
					} else {
						$ansdata = "<strong>Your Answer: </strong>".stripslashes($ansdata);		 
					}

			}

			} 
		}	
	}
	$title_html = '<div class="sqb_question_answer_data_chart">'.$ansdata.'</div>';
	
	} else {
		
	$title_html = '<div class="answer-data-chart">';
	$questions_answer_data = SQB_QuizAnswers::loadByQuestionId($questions_array[0]);
	/*********************************/
	$qar_quiz_id = $quiz_id;
	$qar_html_outter = '';
	       $qar_output_array = array();
	       $qar_output_matrix_array = array();
			if($qar_quiz_id != '' && $qar_quiz_id != 0 ){
					
				$qarObj = SQB_QuestionAnswerReport::loadByQuizIdAndStartDateAndEndDate($qar_quiz_id,$start_date,$end_date);
				
				if(isset($qarObj)){
					
					
					foreach($qarObj as $qarObjSingle){
						$qar_answer_id = $qarObjSingle->getAnswerId();
						$qar_question_id = $qarObjSingle->getQuestionId();
						if($qar_question_id == 0 || $qar_question_id == ''){
							continue;
						}
						
						$inner_array = array();
						$qar_answer_ids = explode(',',$qar_answer_id);
						
						/********count for matrix start***********/
						$qar_question_type = '';
						$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
						if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
						$matrix_label_text = $repques_quiz_obj->getMatrixLabelText();
						$matrix_label_text_values = explode(',',$matrix_label_text);
						}
						
						if($qar_question_type == 'matrix'){
							
							foreach($qar_answer_ids as $qar_answer_id){
								if($qar_answer_id == ''){
									continue;
								}
								$matrix_response_id = explode('|',$qar_answer_id);
								$qar_answer_id = $matrix_response_id[0];
								$option_index = "";
								if(is_array($qar_answer_id)){
									if(array_key_exists('1', $qar_answer_id)){
										$option_index = $matrix_response_id[1];
									}
								}
								
								
								foreach($matrix_label_text_values as $matrix_label_text_value){
									$matrix_label = explode('|',$matrix_label_text_value);
									$matrix_index = $matrix_label[0];
									if($matrix_index == $option_index){
										if(isset($qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]) && array_key_exists('visited',$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index])){
											$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] = $qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] +1;
										} else {
											$qar_output_matrix_array[$qar_question_id][$qar_answer_id][$matrix_index]['visited'] = 1; 
										}
									}
								}
							}
							
						}/********count for matrix end***********/
						
						foreach($qar_answer_ids as $qar_answer_id){
							if($qar_answer_id == ''){
								continue;
							}
							if(isset($qar_output_array[$qar_question_id][$qar_answer_id]) &&  array_key_exists('visited',$qar_output_array[$qar_question_id][$qar_answer_id])){
								$qar_output_array[$qar_question_id][$qar_answer_id]['visited'] = $qar_output_array[$qar_question_id][$qar_answer_id]['visited'] +1;
							}else{  
								$qar_output_array[$qar_question_id][$qar_answer_id]['visited'] = 1;
							}
							
							if($qar_question_type == 'matrix'){
							break;
							}
						}
						
					}// foreach loop closed
				}
			}
			
					$qar_total_visited = 0;
					$qar_total_answer_picked = 0;
					$qar_html_inner = '';
					@$questioin_no++;			
					$qar_answer_no = 0;
					$qar_table_tr = '';
					
					$qar_question_id = $questions_array[0];
					$qar_question_type = '';
					$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
					if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
					}

					if(isset($qar_output_array[$qar_question_id])){
						$qar_output_array_single_values = $qar_output_array[$qar_question_id];
						foreach($qar_output_array_single_values as $qar_answer_id => $qar_output_array_single_value){
							if($qar_answer_id == 0){
								$qar_total_visited = $qar_total_visited + $qar_output_array_single_value['visited'];
								continue;
							}
							$qar_total_answer_picked = $qar_total_answer_picked + $qar_output_array_single_value['visited'];
						}// for each loop closed 
					}// if loop closed 
				
				 //$qar_answer_obj = SQB_QuizAnswers::loadById($id);
				 $qar_answer_obj = SQB_QuizAnswers::loadByQuestionId($qar_question_id);
				 $qar_answer_html = '';
			 	 $create_bar_chart = '';	

				 $matrix_answer_html = '';
				 if($qar_answer_obj){

				 	$backgroundColor = ["#959ef2", "#ff83a9", "#25d5f2", "#ffc750", "#2ec551", "#a484ff", "#ffa5c1","#CFEAEA ", "#c9e3d5", "#e7dadd", "#dde9eb", "#ecfac7", "#facba9", "#dfdbd3", "#f1fdc1","#cacdca", "#b2b4b2", "#969896", "#afb6af", "#ffff00"];
				 	$count = 0;
				 	$pecentage_array = array();
				 	$percentage_color_array = array();
				 	$answer_num_array = array();
				 	$answer_default_data_array = array();
				 	$answer_default_color_data_array = array();
				 	
				 	$not_show_chart = true;
					$question_type_rating = false;
					$anser_array_with_name = array();
					
					$qar_question_type = '';
					$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
					if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
					}
					
					if($qar_question_type == 'ranking_choices'){
						$question_type_rating = true;
						$not_show_chart = false;
					}
					
					foreach($qar_answer_obj as $qar_answer_obj_values){
						$qar_answer_no++;
						$qar_answer_id_new =  $qar_answer_obj_values->getId();
						//$qar_answer_html =  $qar_answer_obj_values->getAnswer();
						$qar_answer_html =  $qar_answer_obj_values->getAnswerTitle();
					
						$qar_answer_html = stripslashes($qar_answer_html);
						$anser_array_with_name[$qar_answer_id_new] = $qar_answer_html;
						/*$qar_answer_html = str_replace('sqb_tiny_mce_editor','sqb_tiny_mce_editor_rename',$qar_answer_html); 
						$qar_answer_html = str_replace('style','style_rename',$qar_answer_html); 
						$qar_answer_html = str_replace('contenteditable="true"','contenteditable="false"',$qar_answer_html); 
						
						$qar_answer_html = str_replace("contenteditable='true'","contenteditable='false'",$qar_answer_html); */
					
					
						//$qar_output_array_single_value['visited']
						$qar_ans_visited = 0;
						if(isset($qar_output_array[$qar_question_id][$qar_answer_id_new])){
							$qar_ans_visited = $qar_output_array[$qar_question_id][$qar_answer_id_new]['visited'];
						}
						
						$matrix_label_text = '';
						$qar_question_type = '';
						$repques_quiz_obj =SQB_QuizQuestionBank::loadById($qar_question_id);
						if($repques_quiz_obj){
						$qar_question_type   = $repques_quiz_obj->getQuestionType();
						$matrix_label_text = $repques_quiz_obj->getMatrixLabelText();
						$matrix_label_text_values = explode(',',$matrix_label_text);
						}
					
					
					
						if($qar_question_type == 'matrix') {
							//print_r($matrix_label_text_values);

								$matrix_table_data = '';
								$iteration = 1;
								foreach($matrix_label_text_values as $matrix_label_text_value){
									$matrix_label = explode('|',$matrix_label_text_value);
									$matrix_index = $matrix_label[0];
									$qar_matrix_ans_visited = 0;
									if(isset($qar_output_matrix_array[$qar_question_id][$qar_answer_id_new][$matrix_index])){
									$qar_matrix_ans_visited = $qar_output_matrix_array[$qar_question_id][$qar_answer_id_new][$matrix_index]['visited'];
									}
									
									//echo $qar_matrix_ans_visited;
									//echo "=====";
									//echo $qar_total_visited;
									//echo "+++++";
									
									if($qar_matrix_ans_visited == 0){
										$percentage = 0;
									}else{
										$percentage = $qar_matrix_ans_visited/$qar_total_visited*100;
										$percentage = round($percentage);
									}
									
									$pecentage_array[] = $percentage;
									$answer_num_array[] = 'A'.$qar_answer_no;
									$percentage_color_array[] = $backgroundColor[$iteration];
									$answer_default_data_array[] = '100';
									$answer_default_color_data_array[] = '#eeeff0';
									
									$ans_progress_bar_html = '<div class="progress-bar-outer">
																<label>'.$percentage.'%</label>
																<div class="sqb-progress-report">
																	<div class="sqb-progress-bar" style="width:'.$percentage.'%;">'.$percentage.'%</div>
																</div>
															</div>';
									
									$matrix_table_data .= '<tr>
												<!--<td class=" text-center">'.$iteration.'</td>-->
												<td class=" ">'.$matrix_label[1].'</td>
												<td class="percentage">
													'.$ans_progress_bar_html.'
												</td>
												<td class=" text-center">'.$qar_matrix_ans_visited.'</td>
											</tr>';
											$iteration++;
											$count++;
								}
														
								$matrix_answer_html .= '<div class="card">
								<div class="card-header" id="heading'.$qar_answer_id_new.'">
									<p>'.$qar_answer_no.': '.strip_tags($qar_answer_html).'</p>
									<!--<div class="QA-accordion-header-right">
										<button class="QA-accordion-action collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$qar_answer_id_new.'" aria-expanded="false" aria-controls="collapse'.$qar_answer_id_new.'"><i class="fa fa-angle-up" aria-hidden="false"></i></button>
									</div>-->
									
								</div>
								
								<div id="collapse'.$qar_answer_id_new.'" class="collapse" aria-labelledby="heading'.$qar_answer_id_new.'" data-parent="#matrix-accordion-'.$qar_question_id.'">
								  <div class="card-body">
								  
								  <div class="table-responsive Quiz-QA-Table">
										<table class="table table-fixed">
											<thead>
												<tr>
													<!--<th scope="col" class=" text-center">#</th>-->
													<th scope="col" class="">Selected Option</th>
													<th scope="col" class=" text-center">Value</th>
													<th scope="col" class=" text-center">This Option was Picked</th>
												</tr>
											</thead>
											<tbody>
											'.$matrix_table_data.'
											</tbody>
										</table>
								   </div>
								   
								  </div>
								</div>
							  </div>';
								$qar_table_tr .= '';
									
							if($qar_answer_no == count($qar_answer_obj)){
							$title_html .= $matrix_answer_html;	
							}
							
						} else {
							
							
							if($qar_ans_visited == 0){
								$percentage = 0;
							}else if($qar_total_visited == 0){
								$percentage = 0;
							}else{
								$percentage = $qar_ans_visited/$qar_total_answer_picked*100;
								$percentage = round($percentage);
							}
							
							$pecentage_array[] = $percentage;
							$answer_num_array[] = 'A'.$qar_answer_no;
							$percentage_color_array[] = $backgroundColor[$count];
							$answer_default_data_array[] = '100';
							$answer_default_color_data_array[] = '#eeeff0';
							
							$ans_progress_bar_html = '<div class="progress-bar-outer">
														<label>'.$percentage.'% </label>
														<div class="sqb-progress-report">
															<div class="sqb-progress-bar" style="width:'.$percentage.'%;"> '.$percentage.'%</div>
														</div>
													</div>';
													
							if($question_type_rating){
								$ans_progress_bar_html = '';
								$qar_ans_visited = '';
							}
							
							$qar_table_tr .= '<tr>
												<td class=" text-center">A'.$qar_answer_no.'</td>
												<td class="">'.$qar_answer_html.'</td>
												<td class="percentage">
													'.$ans_progress_bar_html.'
												</td>';

							$qar_table_tr .= '<td class=" text-center">'.$qar_ans_visited.'</td>
												</tr>';
												
							$title_html .= '<p>'.$qar_answer_html.'</p>';					
							$title_html .= $ans_progress_bar_html;					
						}
											
						$count++;
					}// for each loop closed 
				}
				$title_html .= '</div>';
			}
			
			$outcomes_array = array('select_question_html'=>$select_question_html,'title_html'=>$title_html);
				/*********************************/
	if(isset($_POST['is-v2']))
		return $outcomes_array;
	else			
	echo json_encode($outcomes_array);die;
}

add_action('wp_ajax_SQBQuizTotalUserParticipatedAjax', 'SQBQuizTotalUserParticipatedAjax');
add_action('wp_ajax_nopriv_SQBQuizTotalUserParticipatedAjax', 'SQBQuizTotalUserParticipatedAjax');
function SQBQuizTotalUserParticipatedAjax(){
	$quiz_id = $_POST['sqb_quiz_id'];
	$ignore_userids = '';
	$start_date = '';
	$end_date = '';
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	if(isset($quiz_obj)){
		$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
		$result = explode('|',$getOutcomeScreenChartsSettings);
		
		$user_ids = array();
		$admins_ids = array();
		$result[3] = !empty($result[3]) ? $result[3] : '';
		if($result[3] == 'admin_users'){
		$admins_ids = get_users( array( 'fields' => 'role', 'role' => 'administrator' ) );
			foreach($admins_ids as $users_id){
				$the_user = get_userdata((int) $users_id);
				if(isset($the_user->data)){
					 $userdata = $the_user->data;
					if($userdata->user_email != ''){
					$user = SQB_InternalUsers::loadByEmail($userdata->user_email);
					if(!empty($user)){
						$user_ids[] = $user->getId();
						}
					}
				}
			}
		}
		$result[4] = !empty($result[4]) ? $result[4] : '';
		
		if($result[4] == 'other_users'){
			$emails_array = explode(',',$result[5]);
			foreach($emails_array as $email){
				if($email != ''){
					$user = SQB_InternalUsers::loadByEmail($email);
					//$user = get_user_by('email', $email);	
					if(!empty($user)){
					$user_ids[] = $user->getId();
					}
				}
			}
		}
		$ignore_userids = array_unique(array_merge($user_ids,$admins_ids));
		$result[7] = !empty($result[7]) ? $result[7] : '';
		$result[8] = !empty($result[8]) ? $result[8] : '';
		if($result[7] == 'Y' && $result[8] != ''){
		$start_date = date("Y-m-d",strtotime($result[8]));
		$end_date = date("Y-m-d");
		}
	}
	
	$quiz_attempt_data = SQB_ManageLeads::loadByQuizIdStartDateEndDateAcceptUserids($quiz_id,$start_date,$end_date,$ignore_userids);
	
	$total_users = count($quiz_attempt_data);
		
	$result_array = array('total_users'=>$total_users);

	if(isset($_POST['is-v2']))
		return $result_array;
	else
		echo json_encode($result_array);die;
}

add_action('wp_ajax_SQBOutcomeTitleAjax', 'SQBOutcomeTitleAjax');
add_action('wp_ajax_nopriv_SQBOutcomeTitleAjax', 'SQBOutcomeTitleAjax');
function SQBOutcomeTitleAjax(){
	$quiz_id = $_POST['sqb_quiz_id'];
	$outcome_ids = $_POST['outcome_ids'];
	$outcome_count = $_POST['outcome_count'];
	/*$title_suffix = ' (%)';
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	if(isset($quiz_obj)){
		$quiz_category_enable = $quiz_obj->getCategory();
		$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
		$result = explode('|',$getOutcomeScreenChartsSettings);
		if($result['15'] == 'category_based' && $quiz_category_enable == 'Y'){
			$title_suffix = ' (%)';
		}
	}*/
	
	$labels = array();
	$data = array();
	$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
	if(isset($outcome_obj)){
		foreach($outcome_obj as $outcome_data){
			$outcome_id = $outcome_data->getID();
			$outcome_name = $outcome_data->getOutcomeName();
			if (strlen($outcome_name) > 50){
			$final_outcome = substr($outcome_name, 0, 50) . '[...]';
			} else {
			$final_outcome = $outcome_name;
			}
			
			$set_outcome_data = true;
			foreach($outcome_ids as $key => $outcomeId){
				if($outcome_ids[$key] > 0){
					if($outcome_ids[$key] == $outcome_id){
						$labels[] = $final_outcome;
						$data[] = $outcome_count[$key];
						$set_outcome_data = false;
					}
				}
			}
			if($set_outcome_data){
				$labels[] = $final_outcome;
				$data[] = 0;
				$set_outcome_data = false;
			}
		}
	}

	$quiz_id = !empty($_POST['sqb_quiz_id']) ? $_POST['sqb_quiz_id'] : $_POST['quiz_id'];
	$quiz_obj = SQB_Quiz::loadById($quiz_id);
	$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
	$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
	$chartsSettings = explode('|',$getOutcomeScreenChartsSettings);

	$chart_in_percent_checked = "N";
	if(isset($chartsSettings) && count($chartsSettings) > 0){
		if(!empty($chartsSettings[17])){
			$chart_in_percent_checked = urldecode($chartsSettings[17]);
			if($chart_in_percent_checked == "Y"){
				$chart_in_percent_checked = "Y";
			}
		}
	}

	if($chart_in_percent_checked == 'Y'){
		foreach ($labels as $key => $value) {
			$labels[$key] = $value.'';
		}
		$total = array_sum($data);
		foreach ($data as $key => $value) {
			try{
				if($value != 0 && $total != 0){
					$data[$key] = round($value*100/$total, 2);
				}
			} catch(DivisionByZeroError $e){
				$data[$key] = 0;
			}
		}
	}

	$result_array = array('labels'=>$labels,'data'=>$data);
	if(isset($_POST['is-v2']))
		return $result_array;
	else
		echo json_encode($result_array);die;
}


add_action('wp_ajax_sqb_check_category', 'sqb_check_category');
add_action('wp_ajax_nopriv_sqb_check_category', 'sqb_check_category');
function sqb_check_category(){
	$quiz_id = $_POST['quiz_id'];
	$rule_data_all = SQB_AdvancedRule::loadByQuizId($quiz_id);
	$category_id = [];		
	if(is_array($rule_data_all) && count($rule_data_all)){
		foreach($rule_data_all as $rule_data){
			$r_id = $rule_data->getId();
			$category_id[] = $rule_data->getCategoryId();
		}
	}
	if($category_id){
		$all_cat_id = [];
		$loadallcats = SQB_QuizCategory::load();  
		foreach($loadallcats as $loadallcat){
			$all_cat_id[] = $loadallcat->getId();
		}

		$remaining_category_ids = array_diff($all_cat_id, $category_id);

		if($remaining_category_ids){
			$rule_data_html ='';		
			if(($rule_data_all) && count($rule_data_all)){
				$rule_data_html .= '<div class="category-mapping"><div class="cat_title"><strong>Please Note: You have connected these categories to an outcome</strong></div><div class="cat_name">';
				foreach($rule_data_all as $rule_data){

					$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
					if(isset($outcome_obj) && !empty($outcome_obj)) {
						$i = 1;
						$all_outcome = array();
						foreach($outcome_obj as $outcome_detail){
							$outcome_id = $outcome_detail->getid();
							$all_outcome['OUTCOME '.$i] = $outcome_id; 
							$i++;
						}
					} 
					$get_outcome_id = $rule_data->getOutcomeId();
					$get_outcome_name = array_search($get_outcome_id, $all_outcome);
					$outcome_names = SQB_Outcome::loadById($get_outcome_id);
				  	$outcome_name = $outcome_names->getOutcomeName();
					$category_id = $rule_data->getCategoryId();
					$cat_name = SQB_QuizCategory::loadById($category_id);

					if($category_id){
						$r_id = $rule_data->getId();
						$category_total = $rule_data->getCategoryTotal();
						$cat_explode = explode('|',$category_total);
						$outcome_id = $rule_data->getOutcomeId();
						$question_tab_url =  admin_url('admin.php?page=sqb_add_quiz')."&id=".$quiz_id."&question_tab=quiz-question-screen&quesId=".$question_id;		
						$category_name = $cat_name->getName();
						$rule_data_html .='<div class="cat_in_title"><strong>'.$category_name.'</span></strong> : '.$outcome_name.'</div>';
					}					
				}
				$rule_data_html .='<a href="javascript:void(0)" class="update-mapping">Click to update mapping.</a></div></div>';
			}
			$output['output_data'] = $rule_data_html;
		}else{
			$output['output_data'] = 'has_data';
		}
	}else{
		$output['output'] = 'no_data';
	}	
	echo json_encode($output);die;	
}


add_action('wp_ajax_sqb_save_email_double_opt_info', 'sqb_save_email_double_opt_info_ajax');
add_action('wp_ajax_nopriv_sqb_save_email_double_opt_info', 'sqb_save_email_double_opt_info_ajax');

function sqb_save_email_double_opt_info_ajax(){
	
	if(isset($_POST)){
		
		$quiz_id = 0;
		if(isset($_POST['quiz_id'])){
			$quiz_id = $_POST['quiz_id'];
		}
		
		$double_opt_enable = 'N';
		if(isset($_POST['double_opt_enable'])){
			$double_opt_enable = $_POST['double_opt_enable'];
		}
		
		$redirect_url = '';
		if(isset($_POST['redirect_url'])){
			$redirect_url = $_POST['redirect_url'];
		}
		
		
		$template_no = '';
		if(isset($_POST['template_no'])){
			$template_no = $_POST['template_no'];
		}
		
		$double_optin = $double_opt_enable.'||'.$redirect_url.'||'.$template_no;
		
		$quiz_new_obj = new SQB_Quiz();
		$quiz_new_obj->updateDoubleOptinData($quiz_id, $double_optin );
		$output['success'] = 'Save Successfully';
	}else{
		
		$output['error'] = 'no_data';
		
	}	
	echo json_encode($output);die;	
}


add_action('wp_ajax_sqb_load_get_custom_field_name', 'sqb_load_get_custom_field_name');
add_action('wp_ajax_nopriv_sqb_load_get_custom_field_name', 'sqb_load_get_custom_field_name');
function sqb_load_get_custom_field_name(){
	$custom_field_list_html = [];							
		$custom_fields_obj = SQB_CustomFields::load();
		if(isset($custom_fields_obj) && !empty($custom_fields_obj)) {
			foreach($custom_fields_obj as $custom_fields){
				$custom_fields_name[] = $custom_fields->name;				
				
			}
		} else {
			$custom_fields_name[] = 'Nofields';
		}		
		
		$output['data'] = implode(', ', $custom_fields_name);
		echo json_encode($output);die;	
}


add_action('wp_ajax_sqb_tags_content_list_table', 'SqbListTagContentHtml');
add_action('wp_ajax_nopriv_sqb_tags_content_list_table', 'SqbListTagContentHtml');
function SqbListTagContentHtml(){
$output = array();
$output['tags_content_list_table'] = sqb_get_tag_content_list();
echo json_encode($output);die;
}

function sqb_get_tag_content_list(){
	$sqb_tag_content_html = '';
		$sqb_tag_content_html .= '<table class="table table-striped scrolldown">
								<thead>
							  <tr>
								<th width="125px">ID</th>
								<th>Name</th>
								<th>content</th>
								<th width="100px">Action</th>
							  </tr>
							</thead>
							<tbody>';
							
		$sqb_tags_obj = SQB_Tags::load();
		if(isset($sqb_tags_obj) && !empty($sqb_tags_obj)) {
			$i = 1;
			foreach($sqb_tags_obj as $sqb_tags){
				
				$sqb_tags_id = $sqb_tags->id;
				$sqb_tags_name = $sqb_tags->name;
				$sqb_tags_content = $sqb_tags->name;
				
				$sqb_tag_content_html .= '<tr data-row-count="'.$i.'">
									<td><div style="width: 100px;">'.$sqb_tags_id.'</div></td>
									<td>'.$sqb_tags_name.'</td>
									<td>'.$sqb_tags_content.'</td>
									<!--<td><i data-id="'.@$custom_fields_id.'" data-name="'.@$custom_fields_name.'" data-label="'.@$custom_fields_label.'" data-name="'.@$custom_fields_name.'" data-field-type="'.@$custom_fields_field_type.'" data-field-value="'.@$custom_fields_field_value.'" data-showonlytoadmin="'.@$custom_fields_showonlytoadmin.'" data-desc="'.@$custom_fields_description.'" data-required="'.@$sqb_tags_content.'" class="fas fa-edit sqb-edit-customfield"></i><i data-id="'.@$custom_fields_id.'" class="fas fa-trash-alt sqb-delete-customfield"></i></td>-->
									<td><i data-id="'.$sqb_tags_id.'" class="fas fa-edit sqb-edit-customfield"></i><i data-id="'.$sqb_tags_id.'" class="fas fa-trash-alt sqb-delete-customfield"></i></td>
								  </tr>';
								  $i++;
			}
		} else {
			$sqb_tag_content_html .= '<tr><td colspan="7" align="center">No Records Found</td></tr>';
		}		  
		$sqb_tag_content_html .= '</tbody></table>';
		return $sqb_tag_content_html;
}

add_action('wp_ajax_sqb_save_tag_content', 'SqbSaveTagContent');
add_action('wp_ajax_nopriv_sqb_save_tag_content', 'SqbSaveTagContent');
function SqbSaveTagContent(){
	$output = array();
	//if(isset($_POST['keyname']) && isset($_POST['description'])){
	if(isset($_POST['tagname'])){
		$date = date('Y-m-d H:i:s');	
		$tagname = $_POST['tagname'];
		$sqb_tag_contents = $_POST['sqb_tag_contents'];
		$sqb_tag_contents = str_replace('contenteditable="true"','contenteditable="false"',$sqb_tag_contents); 
		$tag_field_id = $_POST['tag_field_id'];
		
		
		
		if($tag_field_id == ''){
		$tag_field_id = null;
		}
		$sqb_tag_obj = new SQB_Tags();
		$sqb_tag_obj->setName($tagname);
		$sqb_tag_obj->setContent($sqb_tag_contents);
		$sqb_tag_obj->setDate($date);
		
		if(is_numeric($tag_field_id)){
		$sqb_tag_exists = SQB_Tags::loadById($tag_field_id);
		}
			if(isset($sqb_tag_exists)){
				$sqb_tag_obj->setId($tag_field_id);
				$tag_field_id = $sqb_tag_obj->update();
				$output['update_tags'] = "update";
			} else {
				 $sqb_tag_count = SQB_Tags::loadByName($tagname);
				if(!empty($sqb_tag_count)){
				$output['duplicate_tag'] = true;
				} else {				
				   $output['create_tags'] = "create";
				   $tag_field_id = $sqb_tag_obj->create();
				   if($tag_field_id == 'error' || $tag_field_id == ''){
						$output['error'] = 'Sorry there was an issue with save';
				   }
				   $output['duplicate_tag'] = false;
				}
			}			
		$output['tag_list_dropdown'] = sqb_get_tag_list_dropdown();
	}else{
		$output['error'] = 'Something Went Wrong';	
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_delete_tag', 'SqbDeleteTag');
add_action('wp_ajax_nopriv_sqb_delete_tag', 'SqbDeleteTag');
function SqbDeleteTag(){
	$output = array();
	if(isset($_POST['tag_field_id'])){
		$tag_field_id = $_POST['tag_field_id'];
		SQB_Tags::deleteById($tag_field_id);
	}
	$output['tag_list_dropdown'] = sqb_get_tag_list_dropdown();
	echo json_encode($output);die;
}



add_action('wp_ajax_sqbloadalltags', 'sqbloadalltags');
add_action('wp_ajax_nopriv_sqbloadalltags', 'sqbloadalltags');
function sqbloadalltags(){
	$output = array();
	$output['sqb_get_tags_dropdown_val'] = sqb_get_tag_list_dropdown_list();
	echo json_encode($output);die;
}


function sqb_get_tag_list_dropdown_list(){
	$i = 0;
	$select_html = '<select class="form-control outcome_tag_list" name="outcome_tag_list"><option value="0">--Select Tag--</option>';
	//get tag data
	$sqb_tags_obj = SQB_Tags::load();
	if(isset($sqb_tags_obj) && !empty($sqb_tags_obj)) {
		$i = 1;
		foreach($sqb_tags_obj as $sqb_tags){
		$sqb_tags_id = $sqb_tags->id;
		$sqb_tags_name = $sqb_tags->name;
		$sqb_tags_content = $sqb_tags->tag_content;
		//$select_html .= '<li data-id="'.$sqb_tags_id.'" data-name="'.$sqb_tags_name.'" data-content="'.$sqb_tags_content.'" class=" nav-item sqb_tag_item" title=""><a class="nav-link" href="javascript:void(0);">'.$sqb_tags_name.'</a></li>';
		$select_html .= '<option data-id="'.$sqb_tags_id.'" data-value="'.$sqb_tags_name.'" value="'.$sqb_tags_id.'">'.$sqb_tags_name.'</option>';
			$i++; 
		}
	}
	$select_html .= '</select>';
	return $select_html;
}

add_action('wp_ajax_SQBTagsContentAjax', 'SQBTagsContentAjax');
add_action('wp_ajax_nopriv_SQBTagsContentAjax', 'SQBTagsContentAjax');
function SQBTagsContentAjax(){
	$output = array();
	if(isset($_POST['answer_tags'])){
		$tag_ids = $_POST['answer_tags'];
	}else{
		$tag_ids = "";
	}
	$outcome_id = $_POST['outcome_id'];
	$outcome_tag_id = '';

	$outcome_tags_obj = SQB_Outcome::loadById($outcome_id);
	if(!empty($outcome_tags_obj)){

		$outcome_tag_name = $outcome_tags_obj->getTag();
		if(!empty($outcome_tag_name)){
			$tag_content_object = SQB_Tags::loadTagContentWithTagNames($outcome_tag_name);
		}else{
			$tag_content_object = array();
		}
		if(!empty($tag_content_object)){
			$outcome_tag_id = $tag_content_object->getId();
		}
	}
	
	$final_tag_ids = $tag_ids.','.$outcome_tag_id;
	$tag_id_array = array_unique(explode(',',$final_tag_ids));

	$tagss = array();
	$tagscontents_html = '<div class="sqb_tags_content_inner">';
	foreach($tag_id_array as $tag_id){
		if($tag_id > 0){	
		$tag_content_object = SQB_Tags::loadTagContentWithTagids($tag_id);


			if(!empty($tag_content_object)){
				$tagscontents_html .= '<div class="sqb_tags_content">';
				$tagscontents_html_saved = stripslashes($tag_content_object->getContent());

				if(!empty($tagscontents_html_saved)){
					$sqb_tag_contents = str_replace('contenteditable="true"','contenteditable="false"',$tagscontents_html_saved);
				}else{
					$sqb_tag_contents = '<div class="tags_content_temp" style="text-align: center;"><div class="analyzing_result_content"><div class="tags_content_heading sqb_tiny_mce_editor"><div>Heading goes here</div></div><div class="tags_content_desc sqb_tiny_mce_editor">Please enter tag description here</div></div></div>';
				}

				$tagscontents_html .= $sqb_tag_contents;
				$tagscontents_html .= '</div>';

				$tagss[$tag_id] = $sqb_tag_contents;
			}
		}
	}
	$tagscontents_html .= '</div>';
	$output['tags_content_html'] = $tagscontents_html;

	$output['tagss'] = $tagss;

	if(!empty($_REQUEST['noajax']) || isset($_REQUEST['is-v2'])){
		return $output;
	}else{
		echo json_encode($output);die;
	}
}


add_action('wp_ajax_SQBGetTagsContentAjax', 'SQBGetTagsContentAjax');
add_action('wp_ajax_nopriv_SQBGetTagsContentAjax', 'SQBGetTagsContentAjax');
function SQBGetTagsContentAjax(){
	$output = array();
	$tag_id = $_POST['tag_id'];
	if($tag_id > 0){	
	$tag_content_object = SQB_Tags::loadTagContentWithTagids($tag_id);
		if(!empty($tag_content_object)){
			$tagscontents_html = stripslashes($tag_content_object->getContent());
		}
	}
	$output['tags_content_html'] = $tagscontents_html;
	echo json_encode($output);die;
}



add_action('wp_ajax_SQBSendTestEmail', 'SQBSendTestEmail');
add_action('wp_ajax_nopriv_SQBSendTestEmail', 'SQBSendTestEmail');
function SQBSendTestEmail(){
	if(isset($_POST['admin_email'])){
		$admin_name = $_POST['admin_name'];
		$admin_email = $_POST['admin_email'];
		$email = $_POST['admin_email'];
		$subject = $_POST['subject'];
		$bodyText = $_POST['bodyText'];
		$quiz_name = $_POST['quiz_name'];
		$quiz_type = $_POST['quiz_type'];
		$outcome_name = $_POST['outcome_name'];
		$outcome_description = stripslashes($_POST['outcome_description']);
		
		$question_title = !empty($_POST['question_title']) ? $_POST['question_title'] : '';
		$answer_title = !empty($_POST['answer_title']) ? $_POST['answer_title'] : '';

		$question_title = stripslashes($question_title);
		$answer_title = stripslashes($answer_title);

		$question_answer = $question_title.$answer_title;

		$bodyText = trim($bodyText);
		$bodyText = str_replace("%%QUIZ_TYPE%%", strtoupper($quiz_type), $bodyText);
		$bodyText = str_replace("%%QUIZ_TITLE%%", strtoupper($quiz_name), $bodyText);
		$bodyText = str_replace("%%OUTCOME%%", $outcome_name, $bodyText);
		$bodyText = str_replace("%%OUTCOME_DESCRIPTION%%", $outcome_description, $bodyText);
		$bodyText = str_replace("%%ANSWERS%%", $question_answer, $bodyText);

		
		add_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
	        
	        if($admin_name == ''){
				$admin_name = $quiz_name;
			}
	        //added for email styling
			$bodyText1 = '<html>
			  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			  </head>
			  <body>
			  <div><strong>Please Note:</strong> This is just a TEST Email. The OUTCOME and ANSWERS merge tags below will be replaced by actual data when users complete the quiz.</div>
			  <div>Only 1 question / answer is included in this test email</div>
				<div>-----------------------------------------------------</div>
				'.stripslashes($bodyText).'
			  </body>
			</html>';	
			 $headers = array('From: '.$admin_name.' <'.$admin_email.'>'); 
			//$headers .= array('Content-Type: text/html; charset=UTF-8'); 	 

			wp_mail( $email, $subject, $bodyText1, $headers);
			$output = 'mailsent';

			remove_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
	}else{
		$output = 'notsent';
	}
	echo json_encode($output);die;
}

function sqbAddQuestionAdsHtml(){
	
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/ads_default.png';
	
	$html = '<div class="ans_recommendation_result_temp answer_recommendation_outer_wrapper" >
				<div class="ans_recommendation_result_content">
					<div class="ans_recommendation_result_title sqb_tiny_mce_editor "  ><div>Insert your Ad Title Here</div></div>
					
				</div>
			<div class="ans_recommendation_result_progress">
				<div class="answer_recommendation_img_action">
					<span class="sqbHideAnsRecommendationTemplateImageOuter" ><button class="sqbHideAnsRecommendationTemplateImage">Hide Image</button></span>
					<span class="sqbShowAnsRecommendationTemplateImageOuter" style="display:none"><button class="sqbShowAnsRecommendationTemplateImage">Show Image</button></span>
					<span class="sqbDeleteAnsRecommendationTemplateImageOuter"><button class="sqbDeleteAnsRecommendationTemplateImage">Delete Image</button></span>
					<span class="sqbAddAnsRecommendationTemplateImageOuter" style="display:none"><button class="sqbAddAnsRecommendationTemplateImage" attr-img-src="'.$img_url.'">Add Image</button></span>
				
				</div>
			
			<div class="ans_recommendation_img_div ans_recommendation_result-media mb-3" id="%%CURRENTDATETIMEIMAAOUTER%%" >
				<img class="sqb_ans_dot_item_img %%CURRENTDATETIMEIMG%% sbq_change_img" src="'.$img_url.'">
				<span data-class="%%CURRENTDATETIMEIMG%%" class="ans_recommendation_img_upload sqb_change_img question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
			</div>
			<div class="answer_recommendation_description_action">
				<span class="sqbHideAnsRecommendationDescriptionOuter"><button class="sqbHideAnsRecommendationDescription">Hide Description</button></span>
				<span class="sqbShowAnsRecommendationDescriptionOuter" style="display:none"><button class="sqbShowAnsRecommendationDescription">Show Description</button></span>
			</div>
			<div class="sqb_tiny_mce_editor ans_recommendation_description" ><div>Insert your Ad Content Here</div> </div>
		</div>
	</div>
	';
                      
	return $html;
}

add_action('wp_ajax_sqb_search_popup_page_enable', 'sqb_search_popup_page_enable');

function sqb_search_popup_page_enable(){
	
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}

	global $wpdb, $sqb_quiz;
	$quiz_id = $_POST['quiz_id'];
	$page_id  = $_POST['page_id'];
	$enable  = $_POST['enable'];
	$tableName = $wpdb->prefix . $sqb_quiz;
	$sql = "SELECT quiz_display_url FROM " . $tableName . " WHERE id = '".$quiz_id."'" ;

	$display_url = $wpdb->get_var($sql);
	if($enable == 'true'){
		if(!empty($display_url)){
			$all_pages = explode(',',$display_url);
			$tmp_pages = $all_pages;
			$tmp_pages[] = $page_id;
		}else{
			$tmp_pages[] = $page_id;
		}
	}else{
		
		if(!empty($display_url)){
			$all_pages = explode(',',$display_url);
			$tmp_pages = $all_pages;
			
			foreach ($all_pages as $key => $value) {
				if($value == $page_id){
					unset($tmp_pages[$key]);
				}
			}
		}
	}
	
	if(!empty($tmp_pages)){
		$tmp_pages = array_unique($tmp_pages);
	}else{
		$tmp_pages = array();
	}
	
	$wpdb->update( $tableName, array('quiz_display_url' => implode(',',$tmp_pages)), array('id' => $quiz_id) );

}

add_action('wp_ajax_sqb_search_popup_results', 'sqb_search_popup_results');

function sqb_search_popup_results(){
	
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}
	ob_start();
	if($_POST['search_by'] == 'quiz-name'){
		$quizzes = SQB_Quiz::loadByPopup($_POST['search_quiz']);
		$pages = array();
		if(!empty($quizzes)){
			foreach($quizzes as $quiz){
				$quiz_pages = $quiz->getQuizDisplayUrls();
				if(!empty($quiz_pages)){
					$q = explode(',',$quiz_pages);
					$pages = array_merge($q,$pages);
				}
			}
		}
		$args = array(
			'post_type' => 'page',
			'post__in' => $pages
		);

		$wp_pages = new WP_Query($args);
		if(!empty($wp_pages->posts) && !empty($pages)){
			?>
			<h4>List of Pages where this popup is active</h4>
			<table>
			<thead>
				<tr>
					<td>Name</td>
					<td>URL</td>
					<td>Deactivate Popup</td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($wp_pages->posts as $page){
				$page_id = $page->ID;
				$page_title = $page->post_title;
				$page_link = get_permalink($page_id);

				?>
				<tr>
					<td><?php echo $page_title; ?></td>
					<td><a href="<?php echo $page_link ?>"><?php echo $page_link; ?></a></td>
					<td>
						<div class="quiz_right-content mt-3" bis_skin_checked="1">
							<span style=" width: 100%; float: left;"></span>
							<div class="square-switch_onoff" bis_skin_checked="1">
								<input data-pageid="<?php echo $page_id ?>" class="checkbox page_enable" name="page_enable_<?php echo $page_id ?>" type="checkbox" id="page_enable_<?php echo $page_id ?>" value="Y" checked="checked">
								<label for="page_enable_<?php echo $page_id ?>"></label> 
							</div>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
			</table>
			<?php
		}
	}else if($_POST['search_by'] == 'page-url'){
		$quizzes = SQB_Quiz::loadByPopup($_POST['search_page'],'search_page');
		
		if(!empty($quizzes)){
			?>
			<h4>Current this page has these quizzes:</h4>
			<table>
			<thead>
				<tr>
					<td>Quiz Name</td>
					<td>Remove the popup from page</td>
				</tr>
			</thead>
			<tbody>
			<?php
			foreach($quizzes as $quiz){
				
				$quiz_id = $quiz->getId();
				$quiz_name = $quiz->getQuizName();
				$quiz_edit_link = admin_url('admin.php?page=sqb_add_quiz').'&id='.$quiz_id;
				?>
				<tr>
					<td><a href="<?php echo $quiz_edit_link ?>"><?php echo $quiz_name; ?></a></td>
					<td>
						<div class="quiz_right-content mt-3" bis_skin_checked="1">
							<span style=" width: 100%; float: left;"></span>
							<div class="square-switch_onoff" bis_skin_checked="1">
								<input data-quizid="<?php echo $quiz_id ?>" class="checkbox quiz_enable" name="quiz_enable_<?php echo $quiz_id ?>" type="checkbox" id="quiz_enable_<?php echo $quiz_id ?>" value="Y" checked="checked">
								<label for="quiz_enable_<?php echo $quiz_id ?>"></label>
							</div>
						</div>
					</td>
				</tr>
				<?php
			}
		}
		
	}

	echo ob_get_clean();
	exit;

}


add_action('wp_ajax_sqbMemberGenerateWpPage', 'sqbMemberGenerateWpPage');
add_action('wp_ajax_nopriv_sqbMemberGenerateWpPage', 'sqbMemberGenerateWpPage');
function sqbMemberGenerateWpPage(){
	$page_name = $_REQUEST['post_title'];
	$status = SQBMemberCheckPageTitleExist($page_name);
	
	if($status == "no"){
		$my_post = array(
				'post_title'    => wp_strip_all_tags( $_REQUEST['post_title'] ),
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type' =>'page',
				'post_category' => array( 8,39 )
				); 
		
		$post_id = wp_insert_post( $my_post );
		$output['post_id'] = $post_id;
		$output['page_url'] = get_permalink($post_id);
	}
	 $output['status'] =  $status;
	echo json_encode($output);
	die;
}

function SQBMemberCheckPageTitleExist($page_name = ''){
	
	$page = get_page_by_title( $page_name );
	if(is_object($page)){
		$status ='yes';
	}else{
		$status ='no';
	}
	return $status;
}

add_action('wp_ajax_sqbDeleteMemberEngagementByIdAjax', 'sqbDeleteMemberEngagementByIdAjax');

function sqbDeleteMemberEngagementByIdAjax(){
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}

	global $wpdb;
	$id = @$_POST['id'];
	$sqb_member_home = $wpdb->prefix .'sqb_member_home';
	$wpdb->delete( $sqb_member_home, array( 'id' => $id ) );
	echo 'Deleted';exit;
}

add_action('wp_ajax_sqbDeleteCertificateByIdAjax', 'sqbDeleteCertificateByIdAjax');
function sqbDeleteCertificateByIdAjax(){
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}

	global $wpdb;
	$id = @$_POST['id'];
	SQB_QuizCertificate::deleteById($id);
	echo 'Deleted';exit;
}

add_action('wp_ajax_sqb_save_member_data', 'sqb_save_member_data');
add_action('wp_ajax_nopriv_sqb_save_member_data', 'sqb_save_member_data');
function sqb_save_member_data(){

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

	if($_REQUEST['id']){
		$get_id = $_REQUEST['id'];
		$active_tab = $_REQUEST['active_tab'];
		$sqbdata_obj = new SQB_MemberHome();

		$load_data = SQB_MemberHome::loadById($get_id);
		if(isset($load_data)){
			$sqbdata_obj->setId($load_data->getId());
			if($active_tab == "general_settings"){
				$temp_name = $_REQUEST['temp_name'];
				$student_data = $_REQUEST['student_data'];

				$table_data = "";
				if(!empty($student_data)){
					if(array_key_exists('completed_quiz_array', $student_data) || array_key_exists('not_taken_quiz_array', $student_data)){
					$completed_quiz_array = [];
					if(!empty($student_data['completed_quiz_array'])){
						$completed_quiz_array = $student_data['completed_quiz_array'];
					}

					$not_taken_quiz_array = [];
					if(!empty($student_data['not_taken_quiz_array'])){
						$not_taken_quiz_array = $student_data['not_taken_quiz_array'];
					}
					$quiz_data_merged = array_merge($completed_quiz_array, $not_taken_quiz_array);
					$all_array_data = array_unique($quiz_data_merged);
					if(is_array($all_array_data) && count($all_array_data)){
						foreach($all_array_data as $array_data){
							$std_quiz = SQB_Quiz::loadById($array_data);
							if($std_quiz->getQuizDisplay() == "inpage" || $std_quiz->getQuizDisplay() == "popup"){
								$student_home_settings_redirecturl = "";
								$global_image = "";
								$quiz_id = $std_quiz->getId();
								$student_image_and_redirect_url = SQB_GlobalTheme::loadByQuizIdAndName($quiz_id, "student_image_and_redirect_url");
								if(isset($student_image_and_redirect_url)){
									$redirect_url_unserialize = unserialize($student_image_and_redirect_url->getValue());
									$redirect_url = $redirect_url_unserialize['redirect_url'];
									$global_image = $redirect_url_unserialize['image'];
									if($redirect_url){
										$student_home_settings_redirecturl = $redirect_url;
									}
								}

								$table_data .= '<tr data-quiz-id="'.$std_quiz->getId().'">
								      <td class="text-left quiz-name-field">
								        <a><strong>'.stripslashes($std_quiz->getQuizName()).' (ID: '.$std_quiz->getId().')</strong></a>
								      </td>
								      <td class="image-upload-on-member-profile-page text-left">';

									$questionTempData = SQB_QuizTemplate::loadByQuizId($std_quiz->getId());
								 	if($questionTempData != false){
									 	$addicon = $questionTempData->getStartImage();
								 	}else{
								 		$addicon = "";
								 	}

									if(isset($global_image) && !empty($global_image)){
										$student_image = $global_image;
									}else if(!empty($addicon)){
										$student_image = $questionTempData->getStartImage();
									}else{
										$student_image = "";
									}

									if(!empty($student_image)){
										$table_data .= '<a href="#" class="sqb-upload"><img src="'.esc_url( $student_image ).'" /></a>
														<a href="#" class="sqb-remove">Remove</a>
														<input type="hidden" name="sqb_img" value="">';
									}else{
										$table_data .= '<span class="no-image">No image found</span>
														<a href="#" class="button sqb-upload">Upload</a>
														<a href="#" class="sqb-remove" style="display:none">Remove</a>
														<input type="hidden" name="sqb_img" value="">';
									}
								      	$table_data .= '</td><td class="text-text-left"><input type="text" name="quiz_page_url" placeholder="Enter Quiz URL" value="'.$student_home_settings_redirecturl.'"></td></tr>';

				 					//echo $table_data;
								}	
							}
						}
					}	
				}
				

				$output['table_data'] = $table_data;

				$student_data = maybe_serialize($student_data);

				$sqbdata_obj->setName($temp_name);
				$sqbdata_obj->setOptions($student_data);
				
				$sqbdata_obj->setCustomizerHtml($load_data->getCustomizerHtml());
				$sqbdata_obj->setCustomizerOptions($load_data->getCustomizerOptions());
			
			}else if($active_tab == "customizer"){
				$customizer_data = $_REQUEST['customizer_data'];
				$customizer_data = maybe_serialize($customizer_data);
				$html_data = $_REQUEST['html_data'];
				$html_data = maybe_serialize($html_data);

				$sqbdata_obj->setName($load_data->getName());
				$sqbdata_obj->setOptions($load_data->getOptions());

				$sqbdata_obj->setCustomizerHtml($html_data);
				$sqbdata_obj->setCustomizerOptions($customizer_data);

			}else if($active_tab == "settings"){
				
			}
			$sqbdata_obj->setDate(date('Y-m-d H:i:s'));
			$id =  $sqbdata_obj->update();
		}
	}else{
		$active_tab = $_REQUEST['active_tab'];
		$temp_name = $_REQUEST['temp_name'];		
		if($temp_name){
			$temp_name = maybe_serialize($temp_name);
		}else{
			$temp_name = "";
		}

		$student_data = $_REQUEST['student_data'];
		$table_data = "";
				if(!empty($student_data)){
					if(array_key_exists('completed_quiz_array', $student_data) || array_key_exists('not_taken_quiz_array', $student_data)){
					$completed_quiz_array = [];
					if(!empty($student_data['completed_quiz_array'])){
						$completed_quiz_array = $student_data['completed_quiz_array'];
					}

					$not_taken_quiz_array = [];
					if(!empty($student_data['not_taken_quiz_array'])){
						$not_taken_quiz_array = $student_data['not_taken_quiz_array'];
					}
					$quiz_data_merged = array_merge($completed_quiz_array, $not_taken_quiz_array);
					$all_array_data = array_unique($quiz_data_merged);
					if(is_array($all_array_data) && count($all_array_data)){
						foreach($all_array_data as $array_data){
							$std_quiz = SQB_Quiz::loadById($array_data);
							if($std_quiz->getQuizDisplay() == "inpage" || $std_quiz->getQuizDisplay() == "popup"){
								$student_home_settings_redirecturl = "";
								$global_image = "";
								$quiz_id = $std_quiz->getId();
								$student_image_and_redirect_url = SQB_GlobalTheme::loadByQuizIdAndName($quiz_id, "student_image_and_redirect_url");
								if(isset($student_image_and_redirect_url)){
									$redirect_url_unserialize = unserialize($student_image_and_redirect_url->getValue());
									$redirect_url = $redirect_url_unserialize['redirect_url'];
									$global_image = $redirect_url_unserialize['image'];
									if($redirect_url){
										$student_home_settings_redirecturl = $redirect_url;
									}
								}

								$table_data .= '<tr data-quiz-id="'.$std_quiz->getId().'">
								      <td class="text-left quiz-name-field">
								        <a><strong>'.stripslashes($std_quiz->getQuizName()).' (ID: '.$std_quiz->getId().')</strong></a>
								      </td>
								      <td class="image-upload-on-member-profile-page text-left">';

									$questionTempData = SQB_QuizTemplate::loadByQuizId($std_quiz->getId());
								 	if($questionTempData != false){
									 	$addicon = $questionTempData->getStartImage();
								 	}else{
								 		$addicon = "";
								 	}

									if(isset($global_image) && !empty($global_image)){
										$student_image = $global_image;
									}else if(!empty($addicon)){
										$student_image = $questionTempData->getStartImage();
									}else{
										$student_image = "";
									}

									if(!empty($student_image)){
										$table_data .= '<a href="#" class="sqb-upload"><img src="'.esc_url( $student_image ).'" /></a>
														<a href="#" class="sqb-remove">Remove</a>
														<input type="hidden" name="sqb_img" value="">';
									}else{
										$table_data .= '<span class="no-image">No image found</span>
														<a href="#" class="button sqb-upload">Upload</a>
														<a href="#" class="sqb-remove" style="display:none">Remove</a>
														<input type="hidden" name="sqb_img" value="">';
									}
								      	$table_data .= '</td><td class="text-text-left"><input type="text" name="quiz_page_url" placeholder="Enter Quiz URL" value="'.$student_home_settings_redirecturl.'"></td></tr>';

				 					//echo $table_data;
								}	
							}
						}
					}	
				}else{
					$student_data = "";
				}
				$output['table_data'] = $table_data;

		$html_data = !empty($_REQUEST['html_data']) ? $_REQUEST['html_data'] : '';
		if($html_data){
			$html_data = maybe_serialize($html_data);
		}else{
			$html_data = "";
		}

		$customizer_data = !empty($_REQUEST['customizer_data']) ? $_REQUEST['customizer_data'] : '';
		if($customizer_data){
			$customizer_data = maybe_serialize($customizer_data);
		}else{
			$customizer_data = "";
		}

		$sqbdata_obj = new SQB_MemberHome();
		$sqbdata_obj->setName($temp_name);
		$sqbdata_obj->setOptions($student_data);
		$sqbdata_obj->setCustomizerHtml($html_data);
		$sqbdata_obj->setCustomizerOptions($customizer_data);
		$sqbdata_obj->setDate(date('Y-m-d H:i:s'));
		$id =  $sqbdata_obj->create();
	}

 	$output['status'] =  $id;
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_save_member_all_quiz_data', 'sqb_save_member_all_quiz_data');
add_action('wp_ajax_nopriv_sqb_save_member_all_quiz_data', 'sqb_save_member_all_quiz_data');
function sqb_save_member_all_quiz_data(){
	$quiz_array = $_REQUEST['quiz_array'];
	if(isset($quiz_array)){
		foreach($quiz_array as $quiz_id=>$quiz_data){
			$serialize_image_and_redirect_url = maybe_serialize($quiz_data);
			$screen_name = "student_image_and_redirect_url";
			$screen_status = "Y";
			$date = date('Y-m-d H:i:s');
			$strm_type = "global";
			$custom_values = "";
			$outer_style_status = "";

			$new_obj_theme_data = new SQB_GlobalTheme();
			$new_obj_theme_data->setQuizId($quiz_id);
			$new_obj_theme_data->setName($screen_name);
			$new_obj_theme_data->setValue($serialize_image_and_redirect_url);
			$new_obj_theme_data->setStatus($screen_status);
			$new_obj_theme_data->setDate($date);
			$new_obj_theme_data->setType($strm_type);
			$new_obj_theme_data->setCustomValues($custom_values);
			$new_obj_theme_data->setOuterStyleStatus($outer_style_status);
			
			$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
			if(isset($theme_data_has)){		
				$new_obj_theme_data->setId($theme_data_has->getId());
				$new_obj_theme_data->update();
			}else{
				$new_obj_theme_data->create();
			}
		}
	}else{
		$output = 'No Data';
	}
	echo json_encode($output);die;
}



add_action('wp_ajax_sqb_save_quiz_settings_from_quiz', 'sqb_save_quiz_settings_from_quiz');
add_action('wp_ajax_nopriv_sqb_save_quiz_settings_from_quiz', 'sqb_save_quiz_settings_from_quiz');

/* Save Quiz  */
function sqb_save_quiz_settings_from_quiz(){

	if(isset($_POST['quiz_id'])){
		$quiz_id = $_POST['quiz_id'];
		$charts_bar_background_color = $_POST['charts_bar_background_color'];



		$screen_name = 'settings_background_color';
		$strm_type = 'settings';
		$date = date('Y-m-d H:i:s');

		$new_obj_theme_data = new SQB_GlobalTheme();
		$new_obj_theme_data->setQuizId($quiz_id);
		$new_obj_theme_data->setName($screen_name);
		$new_obj_theme_data->setStatus('Y');
		$new_obj_theme_data->setDate($date);
		$new_obj_theme_data->setType($strm_type);
		$new_obj_theme_data->setCustomValues('');
		$new_obj_theme_data->setOuterStyleStatus('Y');
		
		$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
		if(isset($theme_data_has)){
			$all_background_color = $theme_data_has->getValue();
			$all_background_color_un = unserialize($all_background_color);
			$all_background_color_un['charts_bar_background_color'] = $charts_bar_background_color;
			$all_background_color_se = maybe_serialize($all_background_color_un);
			$new_obj_theme_data->setValue($all_background_color_se);
			$new_obj_theme_data->setId($theme_data_has->getId());
			$output = $new_obj_theme_data->update();
		}else{
			$all_background_color_un['charts_bar_background_color'] = $charts_bar_background_color;
			$all_background_color_se = maybe_serialize($all_background_color_un);
			$new_obj_theme_data->setValue($all_background_color_se);
			$output = $new_obj_theme_data->create();
		}
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_SQBLoadUserDataPagination', 'SQBLoadUserDataPagination');
function SQBLoadUserDataPagination(){
	$draw = $_POST['draw'];
	$row = $_POST['start'];
  	$rowperpage = $_POST['length']; // Rows display per page
  	$columnIndex = $_POST['order'][0]['column']; // Column index
  	$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
  	$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
  	$searchValue = $_POST['search']['value']; // Search value
  	$custom_search = isset($_POST['searchValue']) ? $_POST['searchValue'] : '';

	/*$dataPerPage = '10';
	$current_page = max(1, $page_id);
	$offset = ($current_page - 1) * $dataPerPage;*/
    $quizObjArray = SQB_ManageLeads::groupByUserIdAndOffset($row,$rowperpage);
    $totalRecords = SQB_ManageLeads::groupByUserIdAndOffsetCount('0', '0');
    
	$sqbInternalUserarr =array();
	$sqbInternalUserData = SQB_InternalUsers::load();		 
	if(is_array($sqbInternalUserData) && count($sqbInternalUserData)){
		foreach($sqbInternalUserData as $sqbInternalUser){
			$sqbInternalUserarr[] =$sqbInternalUser->getId();
		}			
	}
	
	$user_name='';
	$table_body_html = '';
	$quizObjArrayNew = array();
	$data = array();
	
	if(is_array($quizObjArray) && count($quizObjArray)){
		foreach($quizObjArray as $quizObj){
			$row_id = $quizObj->getId();
			$quiz_id = $quizObj->getQuizId();
			$user_id = $quizObj->getUserId();
			$date = $quizObj->getDate();
			$source = $quizObj->getSource();
			$course_id = $quizObj->getCourseId();
			$certificate_id = $quizObj->getCertificateId();
			$user_source = $quizObj->getUserSource();
			$get_date = $quizObj->getDate();
			$outcome = $quizObj->getOutcome();
			
			if($quizObj->getUsername() != ''){
				$user_name = $quizObj->getUsername();
			}
			
			
			$name =  '';	
			$email =  '';

			if($source == "WP" && $user_source == "WP"){
				$user_info = get_userdata($user_id);	
				if(isset($user_info)){
					$name =  $user_info->first_name." ". $user_info->last_name;	
					$email =  $user_info->user_email ;	
				}else{
					$name =  "";	
				}
			}else if($source == "WP" && $user_source == "SQB"){
				$sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
				if(isset($sqbUserObj)){
					$email = $sqbUserObj->getEmail(); 	
					$name = $sqbUserObj->getFirstName(); 	
				}	
				
			}else if($source == "DAP" && !empty($user_source)){
				if(class_exists('Dap_User')) {
				$dapUserObj = Dap_User::loadUserById($user_id);
					if(isset($dapUserObj)){						
						$name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
						$email =  $dapUserObj->getEmail();
					}
				}else{
					$user_info = get_userdata($user_id);	
					if(isset($user_info)){
						$name =  $user_info->first_name." ". $user_info->last_name;	
						$email =  $user_info->user_email ;	
					}
				}
			}
			
			
			$quiz_data_leads = SQB_Quiz::loadById($quiz_id);
			if(!empty($quiz_data_leads)){	
				if($quiz_data_leads->id == ''){
					continue;
				}else{
					$quiz_title = $quiz_data_leads->getQuizName();
				}
			}else{
				continue;
			}
			
			if($name=="" || $name==" "){
				$name= $user_name;
			}
			
			$quizObjArrayNew = SQB_ManageLeads::loadByUserIdGroupByQuizIdUserId($user_id);
			$html_table_td = "";
			foreach($quizObjArrayNew as $quizObjSingleUserArrayNew){
				$quiz_data_leads = SQB_Quiz::loadById($quizObjSingleUserArrayNew->getQuizId());	
				if(!empty($quiz_data_leads)){
					$quiz_title = $quiz_data_leads->getQuizName();
					$html_table_td .= '<div class="quiz_details" >'.stripslashes($quiz_title).' <a href="javascript:void(0)"  data-quizid="'.$quizObjSingleUserArrayNew->getQuizId().'" data-userid="'.$user_id.'" class="view-profile-link viewUserDetails" data-username="'.$name.'" data-useremail="'.$email.'">View Details</a></div>';
				}
				
			}

			$outcomes_data = SQB_ManageLeads::loadByOutcometagIds($user_id, $quiz_id);
			$outcomes_data = explode(',', $outcomes_data['outcome']);
			$outcomes_data = array_unique($outcomes_data);
			$outcome_tag_names = array();
			foreach($outcomes_data as $outcome_data){
				$outcomeObj = SQB_Outcome::loadById($outcome_data);	
				if(isset($outcomeObj) && !empty($outcomeObj)){
					$tag_name = $outcomeObj->getTag();
					if($tag_name && $tag_name != 'NULL' && $tag_name != ''){
						$outcome_tag_names[] = $outcomeObj->getTag();
					}
				}
			}

			$tags_names = "";
			$tags_data = SQB_ManageLeads::loadByAnswertagIds($user_id, $quiz_id);
			if(!empty($tags_data)){
				$tags_data = explode(',', $tags_data['answer_tag_ids']);
				$tags_data = array_unique($tags_data);
				$tags_title = array();
				foreach($tags_data as $tag_data){
					if($tag_data && $tag_data != 'NULL' && $tag_data != ''){
						$tags_details  = SQB_Tags::loadById($tag_data);
						if(!empty($tags_details)){
							$tags_title[] = $tags_details->getName();
						}
					}
				}
				
				$mergeTagName = array_unique(array_merge($outcome_tag_names, $tags_title));
				if($mergeTagName){
					$tags_names = implode(', ', $mergeTagName); 
				}
			}

			
			$table_body_html .= '<tr class="tr_user_id_'.$user_id.'"><td><div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div></td><td>'.$email.'</td>
				<td class="text-center"><div class="quiz_details--list">'.$html_table_td.'</div></td><td class="text-center">'.$tags_names.'</td>
				</tr>';

				$html_table_td = '<div class="quiz_details--list">'.$html_table_td.'</div>';
				$data[] = array(
		          "name"=>'<div class="lead-personal-info"><h3 class="u_name_cls">'.$name.'</h3></div>',
		          "email"=>$email,
		          "quiz_title"=> $html_table_td,
		          "tag_name"=>$tags_names,
		        );
			
		}		
	}
	$response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecords,
      "aaData" => $data
  );
  echo json_encode($response);die;
}

add_action('wp_ajax_SQBSaveCertificateData', 'SQBSaveCertificateData');
add_action('wp_ajax_nopriv_SQBSaveCertificateData', 'SQBSaveCertificateData');
function SQBSaveCertificateData(){
	if(isset($_POST['operation_name']) && ($_POST['operation_name'] == 'save_certificate')){
		if(isset($_POST['data'])){	
			$data = $_POST['data'];
			$cert_name = $data['cert_name'];
			$cert_status = $data['cert_status'];
			$template_no = $data['template'];
			$template_html = urldecode($data['template_html']);		
			$rand_n =  "cert_dynamic_".date("Y_d_m_H_i_s_").rand(10,1000);
			$rand_n =  ' cert_attr="';		
			$template_html =  str_replace("id='mce_",$rand_n,$template_html);
			$template_html =  str_replace('id="mce_',$rand_n,$template_html);		
			
			$admin_name = $data['admin_name'];
			$logo_img = $data['logo_img'];
			$signature_img = $data['signature_img'];
			$id = $data['id'];

			$options = "";
			$objnew =  new SQB_QuizCertificate();
			$objnew->setName($cert_name); 
			$objnew->setAdminName($admin_name); 		
			$objnew->setTemplate($template_no);
			$objnew->setTemplateHtml($template_html);
			$objnew->setDate(date('Y-m-d H:i:s'));
			$objnew->setStatus($cert_status); 
			$objnew->setLogoImg($logo_img); 
			$objnew->setSignatureImg($signature_img); 		
			$objnew->setOptions($options); 		
			
			$dataReturn = "";
			$dataReturn = SQB_QuizCertificate::loadById($id);
			
			if(isset($dataReturn) && !empty($dataReturn)){
				$edit_id =  $dataReturn->getId();
				$objnew->setId($edit_id);	
				$edit_id = $objnew->update();
				$output['action'] = "update";
			}else{
				$edit_id =  $objnew->create();			 
				$output['action'] = "create";			 
			}
	
			$output['success'] = "Save Successfully";
			$output['edit_id'] = $edit_id;		
		}
	}else if(isset($_POST['operation_name']) && ($_POST['operation_name'] == 'update_status_certificate')){
			if(isset($_POST['id'])){
				$id = $_POST['id'];
				$status = $_POST['status'];
				$dataReturn = SQB_QuizCertificate::loadById($id);
				if(isset($dataReturn) && !empty($dataReturn)){
					$objnew =  new SQB_QuizCertificate();
					$objnew->setName($dataReturn->getName()); 
					$objnew->setAdminName($dataReturn->getAdminName()); 		
					$objnew->setTemplate($dataReturn->getTemplate());
					$objnew->setTemplateHtml($dataReturn->getTemplateHtml());
					$objnew->setDate($dataReturn->getDate());
					$objnew->setStatus($status); 
					$objnew->setLogoImg($dataReturn->getLogoImg()); 
					$objnew->setSignatureImg($dataReturn->getSignatureImg()); 		
					$objnew->setOptions($dataReturn->getOptions()); 	
					$edit_id =  $dataReturn->getId();
					$objnew->setId($edit_id);	
					$edit_id = $objnew->update();
					$output = "update";
			}
		}
	}else{
		$output = "Error";
	}
	echo json_encode($output);die;

}


add_action('wp_ajax_sqbEditCertificateByIdAjax', 'sqbEditCertificateByIdAjax');
add_action('wp_ajax_nopriv_sqbEditCertificateByIdAjax', 'sqbEditCertificateByIdAjax');
function sqbEditCertificateByIdAjax(){
	$output = [];
	if(isset($_POST['id'])){	
			$id = $_POST['id'];
			$data = SQB_QuizCertificate::loadById($id);
			if(isset($data) && !empty($data)){
				$output['name'] = $data->getName();
				$output['admin_name'] = $data->getAdminName();
				$output['logo_img'] = $data->getLogoImg();
				$output['signature_img'] = $data->getSignatureImg();
				$output['template_html'] = $data->getTemplateHtml();
				$output['options'] = $data->getOptions();
				$output['status'] = $data->getStatus();
				$output['success'] = "Success";
			}
	}else{
		$output['error'] = "Error";
	}	
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_load_outcome_name', 'sqb_load_outcome_name');
add_action('wp_ajax_nopriv_sqb_load_outcome_name', 'sqb_load_outcome_name');
function sqb_load_outcome_name(){
	$quiz_id = $_POST['quiz_id'];
	$outcome_html = '';	
	$output = [];
	if($quiz_id != '' && $quiz_id != 0){
		$outcomes_list = SQB_Outcome::loadByQuizId($quiz_id);
		if(is_array($outcomes_list)){
			foreach($outcomes_list as $outcome_list){
				$outcome_html .= '<option value="'.$outcome_list->getId().'">'.$outcome_list->getOutcomeName().'</option>';
			}
		}
		$output['outcome_html'] = $outcome_html;
	}else{
		$output['error'] = 'No data';
	}
	echo json_encode($output);die();
}

add_action('wp_ajax_sqb_load_certifciate_data', 'sqb_load_certifciate_data');
add_action('wp_ajax_nopriv_sqb_load_certifciate_data', 'sqb_load_certifciate_data');
function sqb_load_certifciate_data(){
	$results = SQB_QuizCertificate::load();
	$cert_data = "";
	if(!empty($results)){
		$count = "1";
		foreach ($results as $result) {
			$id = $result->getId();
			$short_date = $result->getDate();
			if($short_date == '0000-00-00 00:00:00'){
				$shortcode_date = date('d-m-Y');
			}else{
				$shortcode_date = date('d-m-Y', strtotime($short_date));
			}
			$cert_data .= '<tr class="sqb_certificate_manage_page_row_id_'.$id.' odd" role="row">
				<td align="left">'.$result->getName().'</td>
				<td align="left">';
					 if($result->getStatus() == "Y"){
						$status_checked = "checked='checked'";
					}else{
						$status_checked = "";
					}
					$cert_data .= '<div class="square-switch_onoff">
						<input class="checkbox certificate_listing_btn" name="certificate_listing_btn_status_'.$count.'" '.$status_checked .' type="checkbox" data-id="'.$result->getId().'" value="Y" id="certificate_listing_btn_status_'.$count.'">
						<label for="certificate_listing_btn_status_'.$count.'"></label>
					</div>
				</td>
				<td align="center" class="sorting_1">'.$shortcode_date.'</td>
				<td align="center"><a class="btn btn-info btn-sm edit_certificate_by_id" data-id="'.$id.'" href="javascript:void(0)"><i class="fa fa-pencil"></i></a> <a class="btn btn-danger btn-sm delete_certificate_by_id" data-id="'.$id.'" href="javascript:void(0)"><i class="fa fa-trash"></i></a></td>
			</tr>';
		$count++; 
		}
		$output = $cert_data;
	}else{
		$output = "No data Found";
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqb_save_leaderboard_data', 'sqb_save_leaderboard_data');
add_action('wp_ajax_nopriv_sqb_save_leaderboard_data', 'sqb_save_leaderboard_data');
function sqb_save_leaderboard_data(){
	$leaderboard_name = $_REQUEST['leaderboard_name'];
	if(isset($leaderboard_name)){
		$quiz_option_selected = $_REQUEST['quiz_option_selected'];
		$selected_quiz_ids = $_REQUEST['selected_quiz_ids'];
		$number_of_entries = $_REQUEST['number_of_entries'];
		$retake_option = $_REQUEST['retake_option'];
		$select_date_range = $_REQUEST['select_date_range'];
		$sqb_start_date = $_REQUEST['sqb_start_date'];
		$sqb_end_date = $_REQUEST['sqb_end_date'];
		$leaderboard_nodata = $_REQUEST['leaderboard_nodata'];
		$selected_order = $_REQUEST['selected_order'];
		$customizer_array = $_REQUEST['customizer_array'];
		$leaderboard_table = $_REQUEST['leaderboard_table'];
		$customizer_array = maybe_serialize($customizer_array);

		$sqb_leaderboard_data = new SQB_LeaderboardPage();
		$sqb_leaderboard_data->setName($leaderboard_name);
		$sqb_leaderboard_data->setQuizType($quiz_option_selected);
		$sqb_leaderboard_data->setQuizIds($selected_quiz_ids);
		$sqb_leaderboard_data->setMaxRecords($number_of_entries);
		$sqb_leaderboard_data->setRetakeOverwrites($retake_option);
		$sqb_leaderboard_data->setShowType($select_date_range);
		$sqb_leaderboard_data->setStartDate($sqb_start_date);
		$sqb_leaderboard_data->setEndDate($sqb_end_date);
		$sqb_leaderboard_data->setNoDataText($leaderboard_nodata);
		$sqb_leaderboard_data->setTemplate('template1');
		$sqb_leaderboard_data->setLeaderboardOrder($selected_order);
		$sqb_leaderboard_data->setCustomizerHtml($leaderboard_table);
		$sqb_leaderboard_data->setCustomizerValues($customizer_array);
		$sqb_leaderboard_data->setDate(date('Y-m-d H:i:s'));
		
		$output = array();
		$leaderboard_id = $_REQUEST['leaderboard_id'];
		if($leaderboard_id){
			$id = $leaderboard_id;
		}else{
			$id= "";
		}
		$leaderboard_data = SQB_LeaderboardPage::loadById($id);
		if(isset($leaderboard_data)){		
			$sqb_leaderboard_data->setId($leaderboard_data->getId());
			$output['last_id'] = $sqb_leaderboard_data->update();
		}else{
			$output['last_id'] = $sqb_leaderboard_data->create();
		}
	}else{
		$output = 'No Data';
	}
	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_load_quiz_data', 'sqb_load_quiz_data');
add_action('wp_ajax_nopriv_sqb_load_quiz_data', 'sqb_load_quiz_data');
function sqb_load_quiz_data(){
	$quiz_type = $_REQUEST['quiz_type'];
	$output = "";
	if(isset($quiz_type)){
		$quiz_details = SQB_Quiz::loadByType($quiz_type);
		$output = '<li data-value="all" class="all_selected_ids">All Quizzes</li>';
		foreach($quiz_details as $quiz_detail) {
			$output .= '<li data-title="'.stripslashes($quiz_detail->getQuizName()).'" data-id="'.$quiz_detail->getId().'" data-value="'.stripslashes($quiz_detail->getQuizName()).'" class="user_taken_ids '.$selectedquiz_ids.'">'.stripslashes($quiz_detail->getQuizName()).' (ID:'.$quiz_detail->getId().')</li>';
		}
	}else{
		$output = '<li>No Quizzes Found</li>';
	}
	echo json_encode($output);die;
}


add_action('wp_ajax_sqbDeleteLeaderboardByIdAjax', 'sqbDeleteLeaderboardByIdAjax');
function sqbDeleteLeaderboardByIdAjax(){
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}

	$output= array();
	if(isset($_POST)){ 	
		$id = $_POST['id'];
		$output['success'] = 'Deleted';
		SQB_LeaderboardPage::DeleteById($id);
		$output['id'] = $id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}	

add_action('wp_ajax_sqbDeletePdfContentByIdAjax', 'sqbDeletePdfContentByIdAjax');
function sqbDeletePdfContentByIdAjax(){
	if ( !current_user_can( 'manage_options' ) ) {
		echo json_encode(array('error' => 'Not allowed to access'));die;  
	}

	$output= array();
	if(isset($_POST)){ 	
		$id = $_POST['id'];
		$output['success'] = 'Deleted';
		SQB_PdfContent::DeleteById($id);
		$output['id'] = $id;
	}else{
		$output['error'] = 'something wrong!';
	}
	echo json_encode($output);
	die;
}	


add_action( 'admin_post_sqb_report_csv_download', 'sqb_report_csv_download' );

function sqb_report_csv_download(){

	if ( !current_user_can( 'manage_options' ) ) {
		return 'invalid request';die;  
	}

	require(SQB_FILE."includes/admin/sqb_csv_download.php");
}


add_action('wp_ajax_sqb_optin_leaderboard_users', 'sqb_optin_leaderboard_users');
add_action('wp_ajax_nopriv_sqb_optin_leaderboard_users', 'sqb_optin_leaderboard_users');
function sqb_optin_leaderboard_users(){
	$output = sqb_leaderboard_data();
	echo json_encode(array("output" => $output));die;
}

add_action('wp_ajax_sqb_remove_user_leaderboard', 'sqb_remove_user_leaderboard');
add_action('wp_ajax_nopriv_sqb_remove_user_leaderboard', 'sqb_remove_user_leaderboard');
function sqb_remove_user_leaderboard(){
	global $wpdb,$sqb_global_theme;
    $table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;
	
	$user_id =  $_REQUEST['user_id'];
    $user_source = $_REQUEST['user_source'];

    if(isset($user_id) && isset($user_source)){
	    $exclude_users = sqb_get_lb_exclude_users();
	    $user_data = removeElementWithValue($exclude_users, $user_source, $user_id);
	    $data = array('name' => 'lb_exclude_users', 'value' => serialize($user_data));
	    $where = array('name' => 'lb_exclude_users');
	    $wpdb->update($table_sqb_global_theme,$data,$where);
	    $output = sqb_leaderboard_data();
    }else{
    	$output = "";
    }
    echo json_encode(array('status' => 'ok', 'output' => $output));exit;

}

add_action('wp_ajax_sqb_optout_leaderboard_users', 'sqb_optout_leaderboard_users');
add_action('wp_ajax_nopriv_sqb_optout_leaderboard_users', 'sqb_optout_leaderboard_users');
function sqb_optout_leaderboard_users(){
	global $wpdb,$sqb_global_theme;
    $table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;

	$email =  $_REQUEST['email'];
	if(isset($email)){
		$output = "";
		
		$dapuser = Dap_User::loadUserByEmail($email);
		if($dapuser){
			$userId = $dapuser->ID;
			$user_source = 'DAP';
			$exclude_users = sqb_get_lb_exclude_users();

			$found = "no";
			foreach($exclude_users as $subKey => $subArray){
				if($subKey == $user_source){
					$search_id = array_search($userId, $subArray);
					if (false !== $search_id) {
						$found = 'yes';
					}
				}
			}
			if($found == "yes"){
				$output = "Already Added";
			}else{
				$new_array = array_push($exclude_users['DAP'], $userId);
				$data = array('name' => 'lb_exclude_users', 'value' => serialize($exclude_users));
			    $where = array('name' => 'lb_exclude_users');
			    $wpdb->update($table_sqb_global_theme,$data,$where);
				$output = "Added";
			}
			echo json_encode(array('status' => 'ok', 'output' => $output));exit;
		}

		$user = get_user_by( 'email', $email );
		if($user){
			$userId = $user->ID;
			$user_source = 'WP';
			$exclude_users = sqb_get_lb_exclude_users();

			$found = "no";
			foreach($exclude_users as $subKey => $subArray){
				if($subKey == $user_source){
					$search_id = array_search($userId, $subArray);
					if (false !== $search_id) {
						$found = 'yes';
					}
				}
			}

			if($found == "yes"){
				$output = "Already Added";
			}else{
				$new_array = array_push($exclude_users['WP'], $userId);
				$data = array('name' => 'lb_exclude_users', 'value' => serialize($exclude_users));
			    $where = array('name' => 'lb_exclude_users');
			    $wpdb->update($table_sqb_global_theme,$data,$where);
				$output = "Added";
			}
    		echo json_encode(array('status' => 'ok', 'output' => $output));exit;
		}else{
			$output = "no_user";
    		echo json_encode(array('status' => 'error', 'output' => $output));exit;
		}
	}else{
		$output = 'error';
	}
	echo json_encode(array('status' => 'ok', 'output' => $output));exit;
}

function removeElementWithValue($array, $key, $value){
     foreach($array as $subKey => $subArray){
          if($subKey == $key){
           		$search_id = array_search($value, $subArray);
				if (false !== $search_id) {
				    unset($array[$key][$search_id]);
				}
          }
     }
     return $array;
}

function sqb_leaderboard_data(){
	$output = "";
	global $wpdb,$sqb_global_theme;;
    $exclude_users = sqb_get_lb_exclude_users();
 	$exclud_users_dap = !empty($exclude_users['DAP']) ? $exclude_users['DAP'] : array();
 	$exclud_users_wp = !empty($exclude_users['WP']) ? $exclude_users['WP'] : array();

 	foreach($exclud_users_dap as $exclud_user_dap){
 		$dapUserObj = Dap_User::loadUserById($exclud_user_dap);
        if(isset($dapUserObj)){						
            $name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();	
            $email =  $dapUserObj->getEmail();
          	$output .= '<tr><td>'.$name.'</td><td>'.$email.'</td><td><a href="javascript:void(0)" data-id="'.$exclud_user_dap.'"  data-source="DAP" class="remove_user">Click here to Opt-out this user</a></td></tr>'; 
        }

 	}

 	foreach($exclud_users_wp as $exclud_user_wp){
 		$name = get_user_meta( $exclud_user_wp, 'first_name', true );
 		$user_info = get_userdata($exclud_user_wp);
  		$email = $user_info->user_email;
		$output .= '<tr><td>'.$name.'</td><td>'.$email.'</td><td><a href="javascript:void(0)" data-id="'.$exclud_user_wp.'"  data-source="WP" class="remove_user">Click here to Opt-out this user</a></td></tr>'; 
 	}
 	return $output;
}


add_action('wp_ajax_sqb_load_category_data', 'sqb_load_category_data');
add_action('wp_ajax_nopriv_sqb_load_category_data', 'sqb_load_category_data');
function sqb_load_category_data(){
	$quiz_id =  $_REQUEST['quiz_id'];
	$all_cat_ids =  $_REQUEST['all_cat_ids'];
	$qns_category_order = "";
	if(isset($quiz_id)){
		 	$quiz_data =  SQB_Quiz::loadById($quiz_id);
		  	if($quiz_data){
				$getAllOtherOptions = $quiz_data->getAllOtherOptions();
				if(!empty($getAllOtherOptions) && $getAllOtherOptions != 'NULL'){
					$all_other_options = maybe_unserialize($getAllOtherOptions);
					if(!empty($all_other_options) && is_array($all_other_options)){
						if(array_key_exists('qns_category_order', $all_other_options)){
							if(!empty($all_other_options['qns_category_order'])){
								$qns_category_order = $all_other_options['qns_category_order'];
							}	
						}	
					}
				}
		  	}
		$quizCategorydata = SQB_QuizCategory::load();
		if($qns_category_order != ""){
			$selected_cat_ids = explode(', ', $qns_category_order); 
			if(isset($all_cat_ids)){
				$qns_category_order_array = array_unique(array_merge($selected_cat_ids, $all_cat_ids));
				foreach($qns_category_order_array as $quizCategorydata_row) {
					$quizCategorydata = SQB_QuizCategory::loadById($quizCategorydata_row);
					if(!empty($quizCategorydata)){
						$id = $quizCategorydata->getId();
						$name = $quizCategorydata->getName();
						$output .= '<li data-id="'.$id.'"><i class="fa fa-arrows question_cat_sortable_icon" aria-hidden="true"></i><h3>'.stripslashes($name).'</h3></li>';
					}
				}
			}else{
				foreach($selected_cat_ids as $quizCategorydata_row) {
					$quizCategorydata = SQB_QuizCategory::loadById($quizCategorydata_row);
					if(!empty($quizCategorydata)){
						$id = $quizCategorydata->getId();
						$name = $quizCategorydata->getName();
						$output .= '<li data-id="'.$id.'"><i class="fa fa-arrows question_cat_sortable_icon" aria-hidden="true"></i><h3>'.stripslashes($name).'</h3></li>';
					}
				}
			}

			
		}else{
			if(isset($all_cat_ids)){
				$all_cat_ids = array_unique($all_cat_ids);
				foreach($all_cat_ids as $all_cat_id){
					$quizCategorydata = SQB_QuizCategory::loadById($all_cat_id);
					$id = $quizCategorydata->getId();
					$name = $quizCategorydata->getName();
					$output .= '<li data-id="'.$id.'"><i class="fa fa-arrows question_cat_sortable_icon" aria-hidden="true"></i><h3>'.stripslashes($name).'</h3></li>';
				}
				$status = "Ok";
			}else{
				$status = "Not Selected";
			}
			
		}
	}else{
		$status = "error";
	}

	echo json_encode(array('status' => $status, 'output' => $output));exit;
}

add_action('wp_ajax_sqb_load_global_theme_butons_data', 'sqb_load_global_theme_butons_data');
add_action('wp_ajax_nopriv_sqb_load_global_theme_butons_data', 'sqb_load_global_theme_butons_data');
function sqb_load_global_theme_butons_data(){
	$quiz_id =  $_REQUEST['quiz_id'];
	$template =  !empty($_REQUEST['template']) ? $_REQUEST['template'] : '';
	$all_background_options = "";
	$output = array();
	if($quiz_id){
		$screen_name = 'settings_background_color';
		$strm_type = 'settings';
		$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
		if($theme_data_has){
			$all_background_options = maybe_unserialize($theme_data_has->getValue());

			/* Next Button */
			
			if($template == 'template8'){
				$output['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn"><div>Continue</div></div>';
			}else{
				if(array_key_exists('next_btn_html', $all_background_options) && $all_background_options["next_btn_html"] != 'undefined'){
					if(!empty($all_background_options["next_btn_html"])){
						$output['next_button_html'] = stripslashes($all_background_options["next_btn_html"]);
					}
				}else{
					$output['next_button_html'] = '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background-color: rgba(79,108,191,1); color: #fff; height: auto; padding: 12px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 100px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>';
				}
			}

			if(array_key_exists('nexttbtn_width_for_quiz', $all_background_options)){
				if(!empty($all_background_options["nexttbtn_width_for_quiz"])){
					$output['nexttbtn_width_for_quiz'] = $all_background_options["nexttbtn_width_for_quiz"];
				}
			}else{
				$output['nexttbtn_width_for_quiz'] = '100';
			}

			if(array_key_exists('nexttbtn_height_for_quiz', $all_background_options)){
				if(!empty($all_background_options["nexttbtn_height_for_quiz"])){
					$output['nexttbtn_height_for_quiz'] = $all_background_options["nexttbtn_height_for_quiz"];
				}
			}else{
				$output['nexttbtn_height_for_quiz'] = '12';
			}

			if(array_key_exists('nexttbtn_radius_for_quiz', $all_background_options)){
				if(!empty($all_background_options["nexttbtn_radius_for_quiz"])){
					$output['nexttbtn_radius_for_quiz'] = $all_background_options["nexttbtn_radius_for_quiz"];
				}
			}else{
				$output['nexttbtn_radius_for_quiz'] = '5';
			}

			if(array_key_exists('next_button_settings_background_color', $all_background_options)){
				if(!empty($all_background_options["next_button_settings_background_color"])){
					$output['next_button_settings_background_color'] = $all_background_options["next_button_settings_background_color"];
				}
			}else{
				$output['next_button_settings_background_color'] = 'rgb(79, 108, 191)';
			}

			if(array_key_exists('next_button_settings_background_hover_color', $all_background_options)){
				if(!empty($all_background_options["next_button_settings_background_hover_color"])){
					$output['next_button_settings_background_hover_color'] = $all_background_options["next_button_settings_background_hover_color"];
				}
			}else{
				$output['next_button_settings_background_hover_color'] = 'rgb(79, 108, 191)';
			}




			/*Skip Button*/
			if(array_key_exists('skip_btn_html', $all_background_options) && $all_background_options["skip_btn_html"] != 'undefined'){
				if(!empty($all_background_options["skip_btn_html"])){
					$output['skip_button_html'] = stripslashes($all_background_options["skip_btn_html"]);
				}
			}else{
				$output['skip_button_html'] = '<div class="skipped_btn skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>';
			}

			if(array_key_exists('skip_question_btn_width_for_quiz', $all_background_options)){
				if(!empty($all_background_options["skip_question_btn_width_for_quiz"])){
					$output['skip_question_btn_width_for_quiz'] = $all_background_options["skip_question_btn_width_for_quiz"];
				}
			}else{
				$output['skip_question_btn_width_for_quiz'] = '100';
			}

			if(array_key_exists('skip_question_btn_height_for_quiz', $all_background_options)){
				if(!empty($all_background_options["skip_question_btn_height_for_quiz"])){
					$output['skip_question_btn_height_for_quiz'] = $all_background_options["skip_question_btn_height_for_quiz"];
				}
			}else{
				$output['skip_question_btn_height_for_quiz'] = '12';
			}

			if(array_key_exists('skip_question_btn_radius_for_quiz', $all_background_options)){
				if(!empty($all_background_options["skip_question_btn_radius_for_quiz"])){
					$output['skip_question_btn_radius_for_quiz'] = $all_background_options["skip_question_btn_radius_for_quiz"];
				}
			}else{
				$output['skip_question_btn_radius_for_quiz'] = '5';
			}

			if(array_key_exists('skip_question_button_for_quiz', $all_background_options)){
				if(!empty($all_background_options["skip_question_button_for_quiz"])){
					$output['skip_question_button_for_quiz'] = $all_background_options["skip_question_button_for_quiz"];
				}
			}else{
				$output['skip_question_button_for_quiz'] = 'rgb(79, 108, 191)';
			}

			if(array_key_exists('skip_question_button_hover_for_quiz', $all_background_options)){
				if(!empty($all_background_options["skip_question_button_hover_for_quiz"])){
					$output['skip_question_button_hover_for_quiz'] = $all_background_options["skip_question_button_hover_for_quiz"];
				}
			}else{
				$output['skip_question_button_hover_for_quiz'] = 'rgb(79, 108, 191)';
			}
			/*Back Button*/
			if(array_key_exists('back_btn_html', $all_background_options) && $all_background_options["back_btn_html"] != 'undefined'){
				if(!empty($all_background_options["back_btn_html"])){
					$output['back_btn_html'] = stripslashes($all_background_options["back_btn_html"]);
				}
			}else{
				$output['back_btn_html'] = '<div class="single_back_btn sqb_back_btn sqb_tiny_mce_editor mce-content-body" style="display: inline-block;border-radius: 5px;background: #000000;color: #ffffff;height: auto;padding: 12px 15px;font-family:&#39;DM Sans&#39;, sans-serif;min-width: 90px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Back</div></div>';
			}

			if(array_key_exists('back_question_btn_width_for_quiz', $all_background_options)){
				if(!empty($all_background_options["back_question_btn_width_for_quiz"])){
					$output['back_question_btn_width_for_quiz'] = $all_background_options["back_question_btn_width_for_quiz"];
				}
			}else{
				$output['back_question_btn_width_for_quiz'] = '100';
			}

			if(array_key_exists('back_question_btn_height_for_quiz', $all_background_options)){
				if(!empty($all_background_options["back_question_btn_height_for_quiz"])){
					$output['back_question_btn_height_for_quiz'] = $all_background_options["back_question_btn_height_for_quiz"];
				}
			}else{
				$output['back_question_btn_height_for_quiz'] = '12';
			}

			if(array_key_exists('back_question_btn_radius_for_quiz', $all_background_options)){
				if(!empty($all_background_options["back_question_btn_radius_for_quiz"])){
					$output['back_question_btn_radius_for_quiz'] = $all_background_options["back_question_btn_radius_for_quiz"];
				}
			}else{
				$output['back_question_btn_radius_for_quiz'] = '5';
			}

			if(array_key_exists('back_question_button_for_quiz', $all_background_options)){
				if(!empty($all_background_options["back_question_button_for_quiz"])){
					$output['back_question_button_for_quiz'] = $all_background_options["back_question_button_for_quiz"];
				}
			}else{
				$output['back_question_button_for_quiz'] = 'rgb(0,0,0,0)';
			}

			if(array_key_exists('back_question_button_hover_for_quiz', $all_background_options)){
				if(!empty($all_background_options["back_question_button_hover_for_quiz"])){
					$output['back_question_button_hover_for_quiz'] = $all_background_options["back_question_button_hover_for_quiz"];
				}
			}else{
				$output['back_question_button_hover_for_quiz'] = 'rgb(0,0,0,0)';
			}

			$status = "success";
		}
	}else{
			$output = array();

			$output['next_button_html'] = '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background-color: rgba(79,108,191,1); color: #fff; height: auto; padding: 12px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 100px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>';
			$output['nexttbtn_width_for_quiz'] = '100';
			$output['nexttbtn_height_for_quiz'] = '12';
			$output['nexttbtn_radius_for_quiz'] = '5';
			$output['next_button_settings_background_color'] = 'rgb(79, 108, 191)';
			$output['next_button_settings_background_hover_color'] = 'rgb(79, 108, 191)';
			$output['skip_button_html'] = '<div class="skipped_btn skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>';
			$output['skip_question_btn_width_for_quiz'] = '100';
			$output['skip_question_btn_height_for_quiz'] = '12';
			$output['skip_question_btn_radius_for_quiz'] = '5';
			$output['skip_question_button_for_quiz'] = 'rgb(79, 108, 191)';
			$output['skip_question_button_hover_for_quiz'] = 'rgb(79, 108, 191)';
			$output['back_btn_html'] = '<div class="single_back_btn sqb_back_btn sqb_tiny_mce_editor mce-content-body" style="display: inline-block;border-radius: 5px;background: #000000;color: #ffffff;height: auto;padding: 12px 15px;font-family:&#39;DM Sans&#39;, sans-serif;min-width: 90px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Back</div></div>';
			$output['back_question_btn_width_for_quiz'] = '100';
			$output['back_question_btn_height_for_quiz'] = '12';
			$output['back_question_btn_radius_for_quiz'] = '5';
			$output['back_question_button_for_quiz'] = 'rgb(0,0,0,0)';
			$output['back_question_button_hover_for_quiz'] = 'rgb(0,0,0,0)';
	}
	echo json_encode(array('status' => $status, 'output' => $output));exit;
}


add_action('wp_ajax_SQBLaodAllTags', 'SQBLaodAllTags');
add_action('wp_ajax_nopriv_SQBLaodAllTags', 'SQBLaodAllTags');
function SQBLaodAllTags(){
	$quiz_id =  $_REQUEST['quiz_id'];
	if(isset($quiz_id)){
		$output = "";
		
		$allquestions = SQB_QuizQuestions::loadByQuizId($quiz_id);	
		$output = '<div class="Side_Popup_card_outer">';		
		if(isset($allquestions)){
			$questions_order_array = array();
			foreach($allquestions as $questionObj){
				$question_id  = $questionObj->getQuestionId();	
				$question_order  = $questionObj->getQuestionOrder();
				if(isset($questions_order_array[$question_order])){
					$question_order = count($questions_order_array) + 1;
				}	
				$question_data = SQB_QuizQuestionBank::loadById($question_id);
				$questions_order_array[$question_order] = $question_data; 
			}

			if(isset($questions_order_array)){
				ksort($questions_order_array);
				$c = 1;
			 	foreach($questions_order_array as $key => $question_data){  
			 		$question_id  = $question_data->getId();	
					$question_title = $question_data->getQuestionTitle();
					$question_type = $question_data->getQuestionType();
					$output .= '<div class="Side_Popup_card"><h4 class="full_wid small_heading mb-0 mt-2">Q'.$c.'. '.stripslashes($question_title)."</h4></div>";
					$answersObj = SQB_QuizAnswers::loadByQuestionId($question_id);

					if(isset($answersObj)){
						foreach($answersObj as $answerObj){
							$answer_id = $answerObj->getId();
							$answer_title = $answerObj->getAnswerTitle();
							$output .= "<div class='Side_Popup_card'><label>".strip_tags(stripslashes($answer_title))."</label>";
							$tag_ids = $answerObj->getTagIds();
							if($tag_ids && $tag_ids != 'NULL'){
								$all_tags = explode(',', $tag_ids);
								$tag_name  = array();
								foreach($all_tags as $tag_id){
									if($tag_id && $tag_id != 'NULL'){
										$tag_data = SQB_Tags::loadById($tag_id);
										if(!empty($tag_data)){
											$tag_name[] = stripslashes($tag_data->getName());
										}
									}
								}
								if($tag_name){
									$all_tag = implode(', ',$tag_name);
									$output .= "<div class='tag-outer-border'><span>Tag Name:&nbsp;".$all_tag."</span></div>";
								}
							}
							$output .= '</div>';
						}
					}
					$c++;
				}
			}
		}
		
		$output .= '</div>';
		echo json_encode(array('status' => 'ok', 'output' => $output));exit;
	}else{
		$output = 'error';
	}
	echo json_encode(array('status' => 'ok', 'output' => $output));exit;
}



add_action('wp_ajax_sqb_load_all_user_data', 'sqb_load_all_user_data');
add_action('wp_ajax_nopriv_sqb_load_all_user_data', 'sqb_load_all_user_data');

//manage leads load user details
function sqb_load_all_user_data(){
	$output="No Data Found";	 
	if(isset($_POST)){	 
		$user_id = $_POST['user_id'];
		$quiz_id = $_POST['quiz_id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$html = "";
		$quizObjArray = SQB_ManageLeads::loadByQuizIdAndUserId($quiz_id,$user_id);
		if($quizObjArray){
			$html = '<div class="quiz-data-content"><div class="acc-container">';
			foreach($quizObjArray as $quizObjArray1){
				$quiz_id = $quizObjArray1->getQuizId();
				$date = $quizObjArray1->getDate();
				$quizObj = SQB_Quiz::loadById($quiz_id);	
				$category_details_html = '';
				
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
					$html .= '<div class="acc"><div class="acc-head"><span class="acc-top-bar">'.stripslashes($quiz_name).'</span><span class="acc-top-bar left-column">'.sqb_get_date($date).'</span></div>
				            	<div class="acc-content" style="display: none;">
					           	<div class="quiz-data-single">';
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
								$tag_name[] = stripslashes($tagdataobj->getName());  
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

					$user_custom_fields_data = SQB_UserCustomFields::loadByUserIdQuizIdManageLeadsId($user_id,$quiz_id,$manage_leads_id);
					
					$html .= ' <div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
				<h4 class="full_wid small_heading">User Details </h4>
				<label>Name:</label>
				<p class="user_name1">'.$name.'</p>
		</div>
		<div class="Side_Popup_card">
				<label >Email:</label>
				<p class="user_email1">'.$email.'</p>
		</div>
		</div>
<div class="Side_Popup_card_outer">
		<div class="Side_Popup_card">
						<h4 class="full_wid small_heading">Quiz Details </h4>
						<label>Quiz Name  </label>
						<p>'.stripslashes($quiz_name).'</p>
					</div>
					<div class="Side_Popup_card">
						<label>Quiz Type  </label>
						<p class="capitalize_text">'.$quiz_type.'</p>
					</div>
					<div class="Side_Popup_card">
						<label>Date  </label>
						<p class="capitalize_text">'.sqb_get_date($date).'</p>
					</div>
					<div class="Side_Popup_card"  style="'.$allow_retake_display.'">
						<label>Retake Count  </label>
						<p class="capitalize_text">'.$retake_count.'</p>
					</div>
					<div class="Side_Popup_card" style="'.$timer_enable_display.'">
						<label>Time Spent  </label>
						<p class="capitalize_text">'.$time_spent.' </p>
					</div>
					<div class="Side_Popup_card" style="'.$gdpr_display.'">
						<label>GDPR Terms  </label>
						<p class="capitalize_text">'.$gdpr_value.' </p>
					</div>
					</div>';

					if(isset($user_custom_fields_data) && !empty($user_custom_fields_data)) {
						$html .= '<div class="Side_Popup_card_outer">'; 
						
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
							
							$html .= '<div class="Side_Popup_card">
									'.$heading_user_custom_fields_data.'
									<label>'.$custom_fields_label.'&nbsp;</label><p>'.$user_custom_fields->getValue().'</p>
								</div>';
							$i++;
						}
						$html.='</div>'; 
					} 


					$html .= '<div class="Side_Popup_card_outer"> 
						<div class="Side_Popup_card">
							<h4 class="full_wid small_heading">Quiz Result </h4> 
							<label>Outcome </label> 
							<p>'.$outcome_name.'</p>
							'.$total_htlm.'

					</div></div>

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
					</div>

					'.$category_details_html;	
				
					$ques_ans_data =  getQuestionsByQuizIdByDate($user_id, $quiz_id,$date, $quiz_type, $name);
					if($ques_ans_data ==""){
						$ques_ans_data ="No Data Found";	
					}else{
						
						if(isset($_POST['row_id']))	{
							$delete_btn_records_html= '<a href="javascript:void(0)" class="sqb_user_question_answer_reset_by_id" data-row-id="'.$row_id.'" data-user-id="'.$user_id.'"  data-quiz-id="'.$quiz_id.'"  data-date="'.$date.'" data-quiz-type="'.$quiz_type.'">Delete Record</a>';
						}
					}
					$html .= '<div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
							 <h4 class="small_heading">Question Answer Details  </h4>							 
								'.$ques_ans_data.'
							</div></div>';	
					}

				$userdata = '<div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
				<h4 class="full_wid small_heading">User Details </h4>
				<label>Name  </label>
				<p class="user_name1">'.$name.'</p>
		</div>
		<div class="Side_Popup_card">
				<label >Email  </label>
				<p class="user_email1">'.$email.$delete_btn_records_html.'</p>
		</div>
		'.$course_details.'
		</div>
		'.$custom_user_data.'
		<div class="Side_Popup_card_outer"> 
		';
		           	$html .= '</div></div>';
 			  	}
			$html .= '</div></div>';
			}
		}
		echo json_encode($html);
		die();
		
}

add_action('wp_ajax_sqb_load_video_url', 'sqb_load_video_url');
add_action('wp_ajax_nopriv_sqb_load_video_url', 'sqb_load_video_url');
function sqb_load_video_url(){
	$video_url =  $_REQUEST['video_url'];
	if(!empty($video_url)){
		$data_exist = SQB_QuizVideoCaption::loadByURL($video_url);
		if(!empty($data_exist)){
			$caption_data = $data_exist->getVideoCaption();
			$caption_data_explode = explode("\n\n", $caption_data);
			unset($caption_data_explode[0]);

			$html_data = '';
			foreach($caption_data_explode as $cd_data){
				$caption_main = explode("\n", $cd_data);
				$explode_time = explode('-->', $caption_main[1]);


				$start_time = substr($explode_time[0],3,strlen($explode_time[0]));
				$end_time = substr(trim($explode_time[1]),3,strlen(trim($explode_time[1])));
				$html_data .= '<div class="caption_wrapper caption-main" data-key="'.$caption_main[0].'"> <div class="video-caption-field-textarea video-caption-field"> <input type="text" name="caption_text" class="caption-text" placeholder="Insert caption here" value="'.$caption_main[2].'"> <a href="javascript:void(0)" class="delete-caption"> <i class="fas fa-trash"></i> </a> </div> <div class="start_caption video-caption-field"> <label>Start Time</label> <input type="text" name="start_time" class="caption-start-time" value="'.$start_time.'"> </div> <div class="end_caption video-caption-field"> <label>End Time</label> <input type="text" name="end_time" class="caption-end-time" value="'.$end_time.'"> </div> </div>';
			}
		}else{

		}
	}
    echo json_encode(array('status' => 'ok', 'output' => $html_data));exit;
}

add_action('wp_ajax_sqb_save_video_data', 'sqb_save_video_data');
add_action('wp_ajax_nopriv_sqb_save_video_data', 'sqb_save_video_data');
function sqb_save_video_data(){

	if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You are not allowed to access this part of the site' ) );
    }
	
	$video_url =  $_REQUEST['video_url'];
	$caption_data =  $_REQUEST['caption_data'];
	if(!empty($video_url)){
		$sqbvideodata = new SQB_QuizVideoCaption();
		$sqbvideodata->setVideoURL($video_url);
		$data_exist = SQB_QuizVideoCaption::loadByURL($video_url);
		if(!empty($data_exist)){
			$sqbvideodata->setId($data_exist->getId());
			$sqbvideodata->setVideoCaption($caption_data);
			$output = $sqbvideodata->update();
		}else{
			$sqbvideodata->setVideoCaption($caption_data);
			$output = $sqbvideodata->create();
		}
	}
    echo json_encode(array('status' => 'ok', 'output' => $output));exit;
}

add_action('wp_ajax_getCaptionfromFile', 'getCaptionfromFile');
function getCaptionfromFile(){
	if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
		// Read the contents of the uploaded file
		$caption_data = file_get_contents($_FILES['file']['tmp_name']);
		$caption_data_explode = preg_split('/\r?\n\r?\n/', $caption_data);
		unset($caption_data_explode[0]);

		$html_data = '';

		foreach($caption_data_explode as $cd_data){
			$caption_main = explode("\n", $cd_data);

			if (str_contains($caption_main[0], '-->')) {
				$time = $caption_main[0];
				$text =  $caption_main[1];
			}else{
				$time = $caption_main[1];
				$text =  $caption_main[2];
			}
		
			$explode_time = explode('-->', $time);

			$start_time = substr(trim($explode_time[0]),3,strlen(trim($explode_time[0])));
			$end_time = substr(trim($explode_time[1]),3,strlen(trim($explode_time[1])));
			$html_data .= '<div class="caption_wrapper caption-main" data-key="'.$caption_main[0].'"> <div class="video-caption-field-textarea video-caption-field"> <input type="text" name="caption_text" class="caption-text" placeholder="Insert caption here" value="'.$text.'"> <a href="javascript:void(0)" class="delete-caption"> <i class="fas fa-trash"></i> </a> </div> <div class="start_caption video-caption-field"> <label>Start Time</label> <input type="text" name="start_time" class="caption-start-time" value="'.$start_time.'"> </div> <div class="end_caption video-caption-field"> <label>End Time</label> <input type="text" name="end_time" class="caption-end-time" value="'.$end_time.'"> </div> </div>';
		}

		if(!empty($html_data)){
			echo json_encode(array('status' => 'ok', 'output' => $html_data));exit;
		}else{
			echo json_encode(array('status' => 'error', 'output' => ''));exit;
		}
	}
}

function my_plugin_body_class($classes) {


	if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'sqb_add_quiz' && (isset($_REQUEST['create']) || isset($_REQUEST['id']))){
		$classes .= ' sqb_add_edit_wrapper';
	}
	
    
    return $classes;
}

add_filter('admin_body_class', 'my_plugin_body_class');



function get_default_global_settings($key,$template = 'template1'){

	$settings = array(
			'next_button_settings_background_color' => 'rgba(79,108,191,1)',
            'next_button_settings_background_hover_color' => 'rgba(79,108,191,1)',
            'nexttbtn_width_for_quiz' => '100',
            'nexttbtn_height_for_quiz' => '12',
            'skip_question_button_for_quiz' => 'rgba(79,108,191,1)',
            'skip_question_btn_width_for_quiz' => '100',
            'skip_question_btn_height_for_quiz' => '12',
            'nexttbtn_radius_for_quiz' => '5',
            'skip_question_button_hover_for_quiz' => 'rgba(79,108,191,1)',
            'skip_question_btn_radius_for_quiz' => '5',
            'back_question_button_for_quiz' => 'rgba(0,0,0,1)',
            'back_question_button_hover_for_quiz' => 'rgba(0,0,0,1)',
            'back_question_btn_width_for_quiz' => '100',
            'back_question_btn_height_for_quiz' => '12',
            'back_btn_radius' => '5',
            'setting_progress_color' => 'rgba(79,108,191,1)',
            'setting_progress_inactive_color' => 'rgba(255,255,255,1)',
            'setting_tag_width_input' => '900',
            'setting_tag_background_color' => 'rgba(255,255,255,1)',
            'tag_title_font_family' => '\\',
            'tag_title_font_size' => '20',
            'tag_title_font_color' => '#000000',
            'tag_desc_font_family' => '\\',
            'tag_desc_font_size' => '16',
            'tag_desc_font_color' => '#000000',
            'tag_bottom_margin' => '20',
            'tag_padding' => '20',
            'sqb_global_outer_width' => '700',
            'sqb_global_inner_width' => '900',
            'sqb_selected_global_height' => 'px',
            'sqb_global_height_input' => '700',
            'sqb_global_background_color' => 'rgba(239,243,245,1)',
            'sqb_global_inner_background_color' => 'rgba(239,243,245,1)',
            'sqb_global_background_image' => '',
            'sqb_global_background_image_url' => '',
            'sqb_global_title_color_enable' => 'Y',
            'sqb_global_title_color' => '#000000',
            'sqb_global_title_font_family_enable' => 'Y',
            'sqb_global_title_font_family' => 'DM Sans',
            'sqb_global_title_line_height_enable' => 'Y',
            'sqb_global_title_line_height' => '1',
            'sqb_global_title_font_size_enable' => 'Y',
            'sqb_global_title_font_size' => '32',
            'sqb_global_title_font_weight' => '700',
            'sqb_global_description_color_enable' => 'Y',
            'sqb_global_description_color' => '#000000',
            'sqb_global_description_font_size_enable' => 'Y',
            'sqb_global_description_font_size' => '20',
            'sqb_global_description_font_weight' => '400',
            'sqb_global_description_font_family_enable' => 'Y',
            'sqb_global_description_font_family' => 'DM Sans',
            'sqb_global_question_ans_color_enable' => 'Y',
            'sqb_global_ans_background_color_enable' => 'N',
            'sqb_global_ans_border_width_enable' => 'N',
            'sqb_global_ans_text_hover_color_enable' => 'N',
            'sqb_global_ans_background_hover_color_enable' => 'Y',
            'sqb_global_selected_ans_color_enable' => 'Y',
            'sqb_global_question_ans_color' => '#000000',
            'sqb_global_ans_background_color' => '#e5f1ff',
            'sqb_global_ans_border_radius_color' => '#ffffff',
            'sqb_global_ans_border_radius_hover_color' => '#ffffff',
            'sqb_global_ans_text_hover_color' => '#ffffff',
            'sqb_global_ans_background_hover_color' => '#ff7777',
            'sqb_global_selected_ans_color' => '#ff7777',
            'sqb_global_question_ans_font_size_enable' => 'Y',
            'sqb_global_question_ans_font_size' => '19',
            'sqb_global_ans_border_width' => '2',
            'sqb_global_question_ans_font_family_enable' => 'Y',
            'sqb_global_button_font_family_enable' => 'Y',
            'sqb_global_question_ans_font_family' => 'DM Sans',
            'sqb_global_button_font_family' => 'DM Sans',
            'sqb_global_question_ans_font_weight' => '500',
            'sqb_global_ans_border_radius_color_enable' => 'Y',
            'sqb_global_ans_border_radius_hover_color_enable' => 'N',
            'sqb_global_background_enable' => 'N',
            'sqb_global_background' => '#ffffff',
            'sqb_global_border_color_enable' => 'Y',
            'sqb_global_border_color' => '#dddddd',
            'sqb_global_border_style_enable' => 'Y',
            'sqb_global_border_style' => 'solid',
            'sqb_global_border_width_enable' => 'Y',
            'sqb_global_border_width' => '1',
            'sqb_global_shadow_spread_radius_enable' => 'N',
            'sqb_global_shadow_spread_radius' => '1',
            'sqb_global_shadow_blur_radius_enable' => 'N',
            'sqb_global_shadow_blur_radius' => '1',
            'sqb_global_shadow_horizontal_length_enable' => 'N',
            'sqb_global_ans_background_color_enable' => 'N',
            'sqb_global_shadow_horizontal_length' => '1',
            'sqb_global_shadow_vertical_length_enable' => 'N',
            'sqb_global_shadow_vertical_length' => '1',
            'sqb_global_shadow_background_color_enable' => 'N',
            'sqb_global_shadow_background_color' => '#ffffff',
            'setting_category_background_color' => 'rgba(255,255,255,1)',
            'category_title_font_family' => '\\',
            'category_title_font_size' => '20',
            'category_title_font_color' => '#000000',
            'category_desc_font_family' => '\\',
            'category_desc_font_size' => '16',
            'category_desc_font_color' => '#000000',
            'category_bottom_margin' => '20',
            'category_padding' => '20',
            'top_bar_background_color' => 'rgba(245, 102, 64, 1)',
            'sqb_global_padding' => '200',
            'sqb_global_inner_background_color_template8' => 'rgba(255,249,249,1)',
            'sqb_enable_inner_customizer_template8' => 'Y',
            'sqb_global_inner_padding_template8' => '52',
            'sqb_global_inner_width_template8' => '836',

	);

	if($template == 'template3' || $template == 'template4'){
		$settings['sqb_global_border_color'] = '#ff634d';
	}

	if($template == 'template1' || $template == 'template2' || $template == 'template3' || $template == 'template4' ){
		$settings['setting_progress_color'] = 'rgba(255,218,92,1)';
		$settings['next_button_settings_background_hover_color'] = 'rgba(255,218,92,1)';
	}

	

	if($template == 'template8'){
		$settings['sqb_global_shadow_background_color_enable'] = 'N';
		$settings['sqb_global_shadow_spread_radius_enable'] = 'N';
		$settings['sqb_global_shadow_spread_radius'] = '1';
		$settings['sqb_global_shadow_blur_radius_enable'] = 'N';
		$settings['sqb_global_temp_shadow_horizontal_length_enable'] = 'N';
		$settings['sqb_global_shadow_horizontal_length_enable'] = 'N';
		$settings['sqb_global_shadow_horizontal_length'] = '1';
		$settings['sqb_global_shadow_blur_radius'] = '3';
		$settings['sqb_global_shadow_background_color'] = '#ffffff';
		$settings['startscreen_button_background_color'] = '#ff7777';

		$settings['sqb_global_outer_width'] = '1111';
		$settings['sqb_global_title_color'] = '#000000';
		$settings['sqb_selected_global_height'] = 'vh';
		$settings['sqb_global_height_input'] = '50';

		$settings['sqb_global_description_color'] = '#000000';
		
		$settings['sqb_global_question_ans_color'] = '#333333';
		$settings['sqb_global_padding'] = '84';
		$settings['sqb_global_title_font_weight'] = '500';
		$settings['sqb_global_background_color'] = 'rgba(239,243,245,0.1)';
		$settings['setting_progress_color'] = 'rgba(247,140,82,1)';
		$settings['sqb_global_background_image'] = 'linear-gradient(rgba(239, 243, 245, 0.1), rgba(239, 243, 245, 0.1)), url('.plugins_url('').'/smartquizbuilder/includes/images/template8_ai.jpg)';
		$settings['sqb_global_background_image_url'] = plugins_url('')."/smartquizbuilder/includes/images/template8_ai.jpg";
	}else if($template == 'template5'){
		$settings['sqb_global_outer_width'] = '2000';
		$settings['sqb_global_title_color'] = '#000000';
		$settings['sqb_global_title_line_height'] = '1.1';

		$settings['sqb_global_description_color'] = '#ffffff';

		$settings['sqb_global_question_ans_color'] = '#333333';
	}else if($template == 'template6'){
		$settings['sqb_global_outer_width'] = '1020';
		$settings['sqb_selected_global_height'] = 'vh';
		$settings['sqb_global_height_input'] = '37';
		$settings['sqb_global_padding'] = '69';
		$settings['sqb_global_title_line_height'] = '1.3';

		$settings['sqb_global_title_color'] = '#333333';

		$settings['sqb_global_description_color'] = '#333333';

		$settings['sqb_global_question_ans_color'] = '#333333';
		$settings['setting_progress_color'] = 'rgba(255,218,92,1)';
		$settings['next_button_settings_background_hover_color'] = 'rgba(255,218,92,1)';

		$settings['sqb_global_background_color'] = 'rgba(239,243,245,0.1)';
		$settings['sqb_global_inner_background_color'] = 'rgba(239,243,245,0.48)';

		$settings['sqb_global_ans_background_hover_color_enable'] = 'Y';
		$settings['sqb_global_selected_ans_color_enable'] = 'Y';
		$settings['sqb_global_ans_background_hover_color'] = '#ff7777';
		$settings['sqb_global_selected_ans_color'] = '#ff7777';
		$settings['sqb_global_ans_text_hover_color_enable'] = 'Y';

		$settings['sqb_global_ans_border_radius_hover_color_enable'] = 'Y';
		$settings['sqb_global_ans_border_radius_hover_color'] = '#000000';
		$settings['sqb_global_question_ans_font_weight'] = '400';

	}else if($template == 'template7'){
		$settings['sqb_global_outer_width'] = '2000';
		$settings['sqb_global_title_color'] = '#414b56';

		$settings['sqb_global_description_color'] = '#676f78';

		$settings['sqb_global_question_ans_color'] = '#333333';
	}else if($template == 'template9'){
		$settings['sqb_selected_global_height'] = 'vh';
		$settings['sqb_global_height_input'] = '100';

		$settings['sqb_global_outer_width'] = '2000';
		$settings['sqb_global_title_color'] = '#ffffff';

		$settings['sqb_global_description_color'] = '#ffffff';

		$settings['sqb_global_question_ans_color'] = '#333333';
	}

	if($template == 'template2' || $template == 'template3'){
		$settings['sqb_global_border_width'] = '8';
	}

	if(isset($settings[$key])){
		return $settings[$key];
	}

	return '';
}


/*To resolve with boddyboss theme issue*/
function overwrite_pagination_variable_params() {
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'show_pagination'){
		$_REQUEST['order'] = "";
		$_GET['order'] = "";
	}
}
add_action('parse_query', 'overwrite_pagination_variable_params');

add_action('wp_ajax_show_pagination', 'show_pagination');
function show_pagination(){

	
	// Reading value
   $draw = $_REQUEST['draw'];
   $row = $_REQUEST['start'];
   $rowperpage = $_REQUEST['length']; // Rows display per page
   //$columnIndex = $_REQUEST['order'][0]['column']; // Column index
   //$columnName = $_REQUEST['columns'][$columnIndex]['data']; // Column name
  // $columnSortOrder = $_REQUEST['order'][0]['dir']; // asc or desc
   $searchValue = $_REQUEST['search']['value']; // Search value

   $searchArray = array();

   // Search
   $searchQuery = " ";
   if($searchValue != ''){
      $searchQuery = " AND (quiz_name LIKE '%".$searchValue."%'";

	  if (is_numeric($searchValue)) {
		$searchQuery .= " OR id LIKE '".$searchValue."'";
	  }

	  $searchQuery .= ")";
      /*$searchArray = array( 
           'quiz_name'=>"%$searchValue%"
      );*/
   }

   	global $wpdb, $sqb_quiz;
	$tableName = $wpdb->prefix . $sqb_quiz;
   	// Total number of records without filtering
	
	$sql = "SELECT COUNT(*) AS allcount FROM " . $tableName." where `pre_built` = 'N' or `pre_built` is NULL";	
	$totalRecords = $wpdb->get_var($sql);
	

   	// Total number of records with filtering
   	$sql = "SELECT COUNT(*) AS allcount FROM " . $tableName." where (`pre_built` = 'N' or `pre_built` is NULL) ".$searchQuery. " ORDER BY id desc";	


   	$totalRecordwithFilter = $wpdb->get_var($sql);

   	$sql = "SELECT * FROM " . $tableName." WHERE (`pre_built` = 'N' or `pre_built` is NULL) ".$searchQuery. " ORDER BY id desc LIMIT $row,$rowperpage";
	$allRecords = $wpdb->get_results($sql, ARRAY_A);
	// echo $wpdb->last_query;
   	$data = array();
 	$quiz_display_name = '';
   	foreach ($allRecords as $row) {

		$quiz_id = $row['id'];
		$quiz_data_single_row = SQB_Quiz::loadById($quiz_id);

		$quiz_id = $quiz_data_single_row->getId(); 
		$questiondata = SQB_QuizQuestions::loadByQuizId($quiz_id);
		$questionTempData = SQB_QuizTemplate::loadByQuizId($quiz_id);
		$question_array = SQB_QuizQuestions::getQuestionsCountByQuizId($quiz_id);
		$question_count=0;
		if(isset($question_array) && is_countable($question_array) && count($question_array) > 0){ 
			$question_count = count($question_array);
		}

		if($questionTempData != false){
		$addicon = $questionTempData->getStartImage();
		}

		if(!isset($addicon) || $addicon == ''){
		$addicon = plugin_dir_url(__FILE__)."../../includes/images/sqb_emptycopy.png";	
		}

		$quiz_display = $quiz_data_single_row->getQuizDisplay();
		if($quiz_display == 'exit'){
		$quiz_display_name = 'Exit Popup';
		}else if($quiz_display == 'inpage'){
		$quiz_display_name = 'In-page';
		}else if($quiz_display == 'popup'){
		$quiz_display_name = 'Button Click Popup';
		}else if($quiz_display == 'time_based'){
		$quiz_display_name = 'Time Based Popup';
		}else if($quiz_display == 'percentage_based'){
		$quiz_display_name = 'Percentage Based Popup';
		}else if($quiz_display == 'corner_popup'){
		$quiz_display_name = 'Corner Popup';
		}

		ob_start();
		?>
	
		<div class="ManageQuiz-block-inner"> 
			<div class="quiz_img"><img src="<?php echo $addicon ?>"></div>
			<div class="quiz_data">
				<p><strong>Title:</strong> <?php echo stripslashes($quiz_data_single_row->getQuizName()); ?></p>
				<p><strong>Type:</strong> <?php if($quiz_data_single_row->getQuizType() == 'form'){echo "FORM"; }else{echo strtoupper($quiz_data_single_row->getQuizType()); } ?> / <?php echo $quiz_display_name; ?></p> <p><strong>Questions:</strong> <?php echo $question_count; ?> </p>
				<p><span class="shortcode_display" id="dynamic_copyable_text_sqb_<?= $quiz_id; ?>">[SmartQuizBuilder id=<?= $quiz_id; ?>][/SmartQuizBuilder]</span><span data-id="dynamic_copyable_text_sqb_<?= $quiz_id; ?>" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p>
				<div class="action-icon_btn">
					<a title="Edit Quiz" href="<?php echo admin_url('admin.php?page=sqb_add_quiz')."&id=".$quiz_id; ?>" class="ManageQuiz-action-btn item-edit-btn"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
					<a  href="<?php echo admin_url('admin.php?page=sqb_reports')."&stats_id=".$quiz_id; ?>" class="ManageQuiz-action-btn item-stats-btn"><i class="fa fa-bar-chart" aria-hidden="true"></i> Stats</a>
					<a title="Clone Quiz" href="javascript:void(0)" class="ManageQuiz-action-btn item-clone-btn" onclick="sqbCloneQuiz(<?= $quiz_id; ?>)"><i class="fa fa-clone" aria-hidden="true"></i> Clone</a>
					<a class="ManageQuiz-action-btn item-delete-btn" title="Delete Quiz" href="javascript:void(0)" onclick="sqbDeleteQuiz(<?= $quiz_id; ?>)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>	
					<?php if($quiz_data_single_row->getQuizDisplay() != 'exit'){ ?>
						<a class="ManageQuiz-action-btn item-embed-btn" title="Embed Code" href="javascript:void(0)" onclick="sqbEmbedCodeQuiz(<?= $quiz_id; ?>)"><i class="fa fa-code"></i> Embed</a>
					<?php } ?>
					<a class="ManageQuiz-action-btn item-export-btn" title="Export Quiz" href="javascript:void(0)" onclick="sqbExportQuiz(<?= $quiz_id; ?>)"><i class="fa fa-code"></i> Export</a>
					<a class="ManageQuiz-action-btn item-preview-btn" title="Export Quiz" href="javascript:void(0)" onclick="sqb_quiz_preview(<?= $quiz_id; ?>)"><i class="fa fa-eye"></i> Preview</a>						
				</div>
			</div>
		</div>

	<?php

	$h = ob_get_clean();

	$data[] = array(
		"quiz_name"=> $h
	);
   }

   // Response
   $response = array(
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $data
   );

   echo json_encode($response);exit;
}


function sqb_disconnect_aweber() {
	$current_date = date('Y-m-d H:m:s');
	$insertObj = new SQB_AutoresponderSettings();
	$insertObj->setName('AWEBER');
	$insertObj->setKeyName('aweber_refresh_token');
	$insertObj->setValue('');
	$insertObj->setDate($current_date);
	$id = $insertObj->update();

	$current_date = date('Y-m-d H:m:s');
	$insertObj = new SQB_AutoresponderSettings();
	$insertObj->setName('AWEBER');
	$insertObj->setKeyName('aweber_token');
	$insertObj->setValue('');
	$insertObj->setDate($current_date);
	$id = $insertObj->update();
}

add_action('wp_ajax_sqb_disconnect_aweber', 'sqb_disconnect_aweber');
add_action('wp_ajax_nopriv_sqb_disconnect_aweber', 'sqb_disconnect_aweber');

add_action('wp_ajax_sqb_save_global_email_template', 'sqb_save_global_email_template');
function sqb_save_global_email_template() {
    $sqb_signature_body = isset($_POST['sqb_signature_body']) ? wp_kses_post($_POST['sqb_signature_body']) : '';
    $sqb_signature_image = isset($_POST['sqb_signature_image']) ? sanitize_text_field($_POST['sqb_signature_image']) : '';
    $sqb_email_logo = isset($_POST['sqb_email_logo']) ? sanitize_text_field($_POST['sqb_email_logo']) : '';
    
    update_option('sqb_signature_body', $sqb_signature_body);
    update_option('sqb_signature_image', $sqb_signature_image);
    update_option('sqb_email_logo', $sqb_email_logo);
    wp_send_json_success('Email template saved successfully.');
    wp_die();
}

add_action('wp_ajax_sqb_save_email_template', 'sqb_save_email_template');
add_action('wp_ajax_nopriv_sqb_save_email_template', 'sqb_save_email_template');
function sqb_save_email_template() {
    $response = "";
    $responseArray = array();
    if (isset($_POST['get_data']) && $_POST['get_data'] == 'get_email_template_data') {
        $quiz_id = isset($_POST['quiz_id']) ? intval($_POST['quiz_id']) : 0;
        if ($quiz_id) {
            global $wpdb;
            $emailTemplate = SQB_EmailTemplate::loadByQuizIdAndType($quiz_id,'welcome-email');
            if ($emailTemplate) {
                $response = array(
                    'status' => 'success',
                    'type' => $emailTemplate->getType(),
                    'selected_template' => $emailTemplate->getTemplateData()
                );
            } else {
                $response = array('status' => 'error', 'message' => 'No email template found');
            }
        } else {
            $response = array('status' => 'error', 'message' => 'Invalid quiz ID');
        }

        echo json_encode($response);
        wp_die();
    } elseif (isset($_POST['quiz_id']) && isset($_POST['data']) && isset($_POST['type'])) {
        $quiz_id = intval($_POST['quiz_id']);
        $newTemplateData = sanitize_text_field($_POST['data']);
        $newTemplateData = stripslashes($newTemplateData);
        $type = sanitize_text_field($_POST['type']);
        $emailTemplate = SQB_EmailTemplate::loadByQuizIdAndType($quiz_id, 'welcome-email');

        $newEmailTemplate = new SQB_EmailTemplate();
        $newEmailTemplate->setQuizId($quiz_id);
        $newEmailTemplate->setType($type);
        $newEmailTemplate->setTemplateData($newTemplateData);
        if (isset($emailTemplate)) {
            $newEmailTemplate->setId($emailTemplate->getId());
            $newEmailTemplate->update();
        } else {
            $newEmailTemplate->create();
        }
        echo json_encode(['status' => 'success']);
        wp_die();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
        wp_die();
    }
}


add_action('wp_ajax_sqb_load_matrix_outcome_data', 'sqb_load_matrix_outcome_data');
add_action('wp_ajax_nopriv_sqb_load_matrix_outcome_data', 'sqb_load_matrix_outcome_data');
function sqb_load_matrix_outcome_data(){
	$question_id =  $_REQUEST['question_id'];
	$quiz_id =  $_REQUEST['quiz_id'];
	$column_length =  $_REQUEST['column_length'];
	$outcome_mapping_data = "";
	$matrix_mapping = "";
	if(isset($quiz_id) && isset($question_id)){
		$answersObj = SQB_QuizAnswers::loadByQuestionId($question_id);
		$matrix_outcome_mapping = "";
		$matrix_tags_data = "";
		if(is_array($answersObj) && count($answersObj)){

			$outcomes_list = SQB_Outcome::loadByQuizId($quiz_id);

			foreach($answersObj as $answerObj){
				$answer_id = $answerObj->getId();
				$answer_title = $answerObj->getAnswerTitle();

				$outcomeMappingObj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quiz_id,$question_id,$answer_id);
				if(isset($outcomeMappingObj)){
					$outcome_table_id = $outcomeMappingObj->getId();
					$mapping_ids = unserialize($outcomeMappingObj->getMatrixMapping());
					if($mapping_ids){
						$all_outcome = "";
						$i=1;
						foreach($mapping_ids as $mapping_id){
							$outcome_names = "";
							foreach($outcomes_list as $outcome_list){

								$selected = '';
								foreach($mapping_id['outcome_ids'] as $outcome_id){
									if($outcome_id == $outcome_list->getId()){
										$selected = 'selected';
									}
								}
								$outcome_names .= '<option '.$selected.' value="'.$outcome_list->getId().'" data-outcome-id="'.$outcome_list->getId().'">'.$outcome_list->getOutcomeName().'</option>';
							}
							$all_outcome .= '<li><div class="sqb-column-index-'.$i.' outcome-tags-layout"></div><div class="js-select2-multiple-wrapper"><select class="mapping-select-box" multiple>'.$outcome_names.'</select></div></li>';
							$i++;
						}
						$outcome_mapping_data .= '<tr data-ans-id="'.$answer_id.'"><td class="question-title">'.stripslashes($answer_title).'</td><td class="answer-title"><ul>'.$all_outcome.'</ul> </td>';
					}
				}else{

						$outcome_names = "";
						foreach($outcomes_list as $outcome_list){
							$outcome_names .= '<option value="'.$outcome_list->getId().'" data-outcome-id="'.$outcome_list->getId().'">'.$outcome_list->getOutcomeName().'</option>';
						}
						$all_outcome = "";
						for ($x = 1; $x <= $column_length; $x++) {
							$all_outcome .= '<li><div class="sqb-column-index-'.$x.' outcome-tags-layout"></div><div class="js-select2-multiple-wrapper"><select class="mapping-select-box" multiple>'.$outcome_names.'</select></div></li>';
						}

						$outcome_mapping_data .= '<tr data-ans-id="'.$answer_id.'"><td class="question-title">'.stripslashes($answer_title).'</td><td class="answer-title"><ul>'.$all_outcome.'</ul> </td>';
				}

			}
		}
		$question_data = SQB_QuizQuestionBank::loadById($question_id);
		$skip_outcome_mapping = '';
		if(!empty($question_data)){
			$skip_outcome_mapping =  $question_data->getSkipMapping();
		}

		$map_skip_class = ' outcome-option-active';
		$map_not_skip_class = '';
		if($skip_outcome_mapping == 'Y'){
			$map_skip_class = ' ';
			$map_not_skip_class = ' outcome-option-active';
		}

		$matrix_mapping = '
					<div class="matrix-type-outcome">
						<div class="sqb_add_more_question_section">
							<div class="question_add_answer_btn_div sqb_question_drag_drop_item" style="">
								<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn">
					                <div class="outcome-options">
					                    <span class="outcome-option-connect '.$map_skip_class.'">Connect to Outcome </span>
					                    <span class="outcome-option-skip '.$map_not_skip_class.'">Skip Mapping</span>
					                </div>
					            </div>
							</div>
						</div>
						<div class="matrix-outcome-table" style="display:none;">
							<table id="myTable">
							  	<thead>
							    	<tr>
							      		<th class="question-title">Question</th>
							      		<th class="answer-title">Answer</th>
							    	</tr>
							  	</thead>
							  	<tbody class="append-outcome-data">'.$outcome_mapping_data.'
							  	</tbody>
							</table>
						</div>
						<div class="matrix-tags-table" style="display:none;">
							<h2>Add Tags</h2>
					 		<a href="#" class="matrix-tag-wrapper-close"><i class="fa fa-times" aria-hidden="true"></i></a>
						 	<table id="myTable">
								  <thead>
								    <tr>
								      <th class="question-title">Question</th>
								      <th class="answer-title">Answer</th>
								    </tr>
								  </thead>
								  <tbody class="append-matrix-tags-data">
								  </tbody>
						  	</table>
					  	</div>
					<div>';
	}

	


	
	echo json_encode(array('status' => 'success', 'matrix_mapping' => $matrix_mapping));exit;
}



add_action('wp_ajax_sqb_save_pdf_content_data', 'sqb_save_pdf_content_data');
add_action('wp_ajax_nopriv_sqb_save_pdf_content_data', 'sqb_save_pdf_content_data');
function sqb_save_pdf_content_data() {
	$data =  $_REQUEST['data'];
	$name =  $_REQUEST['name'];
	$other_options =  $_REQUEST['other_options'];
	$current_date = date('Y-m-d H:m:s');

	$data_serialize = maybe_serialize($data);
	$other_options_serialize = maybe_serialize($other_options);
	

	$insertObj = new SQB_PdfContent();
	$insertObj->setName($name);
	$insertObj->setName($name);
	$insertObj->setOtherOptions($other_options_serialize);
	$insertObj->setContent($data_serialize);
	$insertObj->setDate($current_date);

	$pdf_id = $_REQUEST['pdf_id'];
		if($pdf_id){
			$id = $pdf_id;
		}else{
			$id= "";
		}

	$obj = SQB_PdfContent::loadById($id);
	if($obj){
		$insertObj->setId($obj->getId());
		$output['id'] = $obj->getId();
		$insertObj->update();
		$output['table_action'] = 'update';
	}else{
		$output['id'] =  $insertObj->create();
		$output['table_action'] = 'create';
	}

	echo json_encode($output);die;
}

add_action('wp_ajax_sqb_load_pdf_content', 'sqb_load_pdf_content');
add_action('wp_ajax_nopriv_sqb_load_pdf_content', 'sqb_load_pdf_content');
function sqb_load_pdf_content() {
	$pdf_contents = SQB_PdfContent::load();
	$pdf_name = "";
	if(!empty($pdf_contents)){
		$pdf_name = '<option value="0">Please Select</option>';
		foreach($pdf_contents as $pdf_content){
			$id = $pdf_content->getid();
			$name = $pdf_content->getName();
			$pdf_name .= '<option value="'.$id.'">'.$name.'</option>';
		}
		$output['pdf_name'] = $pdf_name; 
		$output['noContent'] = '';
	}else{
		$output['pdf_name'] = '<option>No PDF Created</option>';
		$output['noContent'] = 'noContent';
	}
	echo json_encode($output);die;
}

add_action('init', 'sqb_preview_pdf_download');

function sqb_preview_pdf_download(){

	if(isset($_REQUEST['sqb_pdf_preview_v2'])){
		require_once(SQB_FILE.'includes/frontend/preview-pdf-report.php');
	}

}

add_action('wp_ajax_load_pdf_mapping', 'load_pdf_mapping');
add_action('wp_ajax_nopriv_load_pdf_mapping', 'load_pdf_mapping');


function load_pdf_mapping() {
    global $wpdb;
    ob_start();

    // Your custom SQL query to retrieve the required data
    $query = "
        SELECT q.id AS quiz_id, q.quiz_name, o.outcome_name AS 'outcome_title', c.name AS 'pdf_title'
        FROM iqi_sqb_quiz_outcome AS o
        JOIN iqi_sqb_pdf_content AS c ON o.pdf_id = c.id
        JOIN iqi_sqb_quiz AS q ON o.quiz_id = q.id
        WHERE o.pdf_id > 0
        ORDER BY q.id DESC
    ";

    $results = $wpdb->get_results($query);
    if ($results) {
    ?>
    <div class="sqb-new-accordion">
        <?php
        $current_quiz = '';
        foreach ($results as $result) {
            if ($current_quiz !== $result->quiz_name) {
                if ($current_quiz !== '') {
                    echo '</table></div></div></div>';
                }
                $current_quiz = $result->quiz_name;
        ?>
        <div class="sqb-new-accordion-item">
            <div class="sqb-new-accordion-header"><?php echo esc_html($result->quiz_name); ?> (<?php echo 'ID:'.$result->quiz_id ?>)</div>
            <div class="sqb-new-accordion-content">
				<div class="sqb-table-pdf-mapping">
                <table>
                    <tr>
                        <th>Outcome Title</th>
                        <th>PDF Title</th>
                    </tr>
        <?php
            }
        ?>
                    <tr>
                        <td><?php echo esc_html($result->outcome_title); ?></td>
                        <td><?php echo esc_html($result->pdf_title); ?></td>
                    </tr>
        <?php
        } ?>
        <?php echo '</table></div></div></div>'; ?>
    </div>
    <?php
    }else{
		echo '<div class="sqb-pdf-error"><p>No records found.</p></div>';
	}

    $html_content = ob_get_clean();
    echo $html_content;
    wp_die();
}

add_action('wp_ajax_generate_outcome_dropdown', 'generate_outcome_dropdown');

function generate_outcome_dropdown() {
    if (isset($_GET['quiz_id'])) {
        $quiz_id = intval($_GET['quiz_id']);

        $options = '<option value="">Select Outcome</option>';
     
        global $wpdb;
		$outcome_table = $wpdb->prefix.'sqb_quiz_outcome';

        $query = "SELECT id, outcome_name FROM $outcome_table WHERE quiz_id = $quiz_id";
        $results = $wpdb->get_results($query);
		if(!empty($results)){
			foreach ($results as $result) {
				$options .= '<option value="' . esc_html($result->outcome_name) . '">' . esc_html($result->outcome_name) . '</option>';
			}
		}
        
        echo $options;
    }

    wp_die(); // Always include this line to terminate the AJAX call
}

add_action('wp_ajax_sqb_ai_powered_14_support', 'sqb_ai_powered_14_support');
add_action('wp_ajax_nopriv_sqb_ai_powered_14_support', 'sqb_ai_powered_14_support');
function sqb_ai_powered_14_support() {
	$plugin_version = get_current_AIPQ_version();
	if (version_compare($plugin_version, '1.4', '>=')) {
		echo '1';
	}else{
	  return '0';
	}
	exit;
}

add_action('wp_ajax_sqb_load_optin_template', 'sqb_load_optin_template');
add_action('wp_ajax_nopriv_sqb_load_optin_template', 'sqb_load_optin_template');
function sqb_load_optin_template() {
	$optin_template = $_REQUEST['optin_template'];
	if(isset($optin_template)){
		$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/".$optin_template."/".$optin_template.".php");



		$file = file_get_contents($file);
		if($quiz_type == 'form'){
			$file = str_replace("%%IMGURL%%" , $form_img_url ,$file);
		}else{
			$file = str_replace("%%IMGURL%%" , $img_url ,$file);
		}
		$curernt_data_time_random =  date('y_m_d_h_m_s').rand(10,1000);
		$file = str_replace("%%CURRENTDATETIMERANDOMIMG%%" , $curernt_data_time_random ,$file);
		$file = str_replace("%%IMGNOTFOUND%%" , $image_not_found ,$file);
		$file = str_replace("%%site_url%%" , plugins_url('') ,$file);
		$output = $file;
	}
	echo json_encode($output);die;
}


function SQBGenerateForm($name, $thankYouURL, $productId) {

	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = '';
		$pre_built_version ='';
		
		$quiz_details_array['quiz_name'] = $name; // urldecode 
		$quiz_details_array['quiz_desc'] = 'Lead Magnet Compelling'; // urldecode
		$quiz_details_array['quiz_type'] = 'form';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'N';
		$quiz_details_array['quiz_display'] = 'popup';
		$quiz_details_array['quiz_blocking'] = 'N';
		$quiz_details_array['quiz_passmark'] = '0';
		$quiz_details_array['sqb_quiz_many_attempts'] = 'Unlimited';
		$quiz_details_array['quiz_pagination'] = 'one_per_page';
		$quiz_details_array['question_per_page'] = '1';
		$quiz_details_array['quiz_move_question'] = 'Y';
		$quiz_details_array['show_share_screen'] = 'N';
		$quiz_details_array['category_option'] = 'category_lowest|0-0';
		$quiz_details_array['move_question'] = 'N';
		$quiz_details_array['show_back_btn_option'] = 'N|allow';
		$quiz_details_array['select_quiz_bank'] = 'N';
		$quiz_details_array['quiz_ans_tags'] = 'N';
		$quiz_details_array['limit_questions_displayed'] = 'N';
		$quiz_details_array['limit_input'] = '';
		$quiz_details_array['customizer_styles'] = 'rgba(255,255,255,0.85)|#000000';
		$quiz_details_array['quiz_recommendation_enable'] = 'N';	
		$quiz_details_array['quiz_ads_enable'] = 'N';
		$quiz_details_array['quiz_timmer_array']['timer_enable'] = 'N';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_limit'] = '0';
		$quiz_details_array['quiz_score'] = '0';
		$quiz_details_array['show_percentage'] = 'N';
		$quiz_details_array['show_for_notloggedin_user'] = 'Y';
		$quiz_details_array['redirect_after_complete'] = '';
		$quiz_details_array['question_display'] = 'all';
		$quiz_details_array['number_of_question'] = '9999';
		$quiz_details_array['questions_random'] = 'N';
		$quiz_details_array['answers_random'] = 'N';
		$quiz_details_array['show_start_screen'] = 'Y';
		$quiz_details_array['show_opt_screen'] = 'Y';
		$quiz_details_array['show_result_screen'] = 'Y';
		$quiz_details_array['show_firstname_template'] = 'N';
		$quiz_details_array['template_display_sequence'][] = 'start_temp';
		$quiz_details_array['template_display_sequence'][] = 'quesans_temp';
		$quiz_details_array['template_display_sequence'][] = 'optin_temp';
		$quiz_details_array['template_display_sequence'][] = 'result_temp';
		$quiz_details_array['user_added_platform'][] = 'DAP';
		$quiz_details_array['user_added_platform'][] = 'add_user_in_wp';

		//$quiz_details_array['user_added_my_email_platform'] = 'add_user_in_wp';
		$quiz_details_array['add_user_in_your_email_platform'] = '';
		$quiz_details_array['outcome_type'] = 'range';
		$quiz_details_array['outcome_page'] = 'outcome_page';
		$quiz_details_array['display_score_on_page'] = 'yes';
		$quiz_details_array['display_correctans_on_page'] = 'yes';
		$quiz_details_array['display_correctans_options'] = 'both';
		$quiz_details_array['display_quesans_on_outcome'] = 'yes';
		$quiz_details_array['outcome_redirect_url'] = 'outcome_redirect_url';
		$quiz_details_array['user_opt_in_redirect'] = 'opt_in_redirect_result_page';
		$quiz_details_array['user_opt_in_redirect_url'] = '';
		$quiz_details_array['date'] = $current_data_time;
		$quiz_details_array['enable_branching'] = 'Y';
		$quiz_details_array['show_next_button'] = 'N';
		$quiz_details_array['already_take_the_quiz'] = 'start_screen';
		$quiz_details_array['sqb_quiz_max_attempts_limit'] = '10';
		$quiz_details_array['show_correct_ans'] = 'N';
		$quiz_details_array['template'] = 'template1';
		$quiz_details_array['startshowHide_video'] = 'N';
		$quiz_details_array['video_url'] = '';
		$quiz_details_array['pass_criteria'] = '';
		$quiz_details_array['status'] = '';
		$quiz_details_array['sqb_insert_quiz'] = '';
		$quiz_details_array['sqb_quiz_allow_retake'] = 'N';
		$quiz_details_array['quiz_display_url'] = '';
		$quiz_details_array['quiz_display_in_url'] = 'N';
		$quiz_details_array['quiz_time_delay'] = '0';
		$quiz_details_array['quiz_popup_frequency'] = 'always';
		$quiz_details_array['quiz_popup_position'] = '';
		$quiz_details_array['quick_email_verification'] = 'N';
		$quiz_details_array['quiz_slider_animation'] = 'Y';
		$quiz_details_array['quiz_slider_animation_option'] = 'tb';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = '';
		$quiz_details_array['transparent_background_settings'] = 'px|1800|px|200|none|undefined|#9c9797|1|0% 0%|#fff7f0||0';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; 
		$quiz_details_array['quiz_timmer_array']['quiz_timer_expired_msg'] = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';   // urldecode 
		$quiz_details_array['enable_background_image'] = 'N';
		$quiz_details_array['show_correct_ans_option'] = 'N';
		$customizer_style_setting = array();
		$customizer_style_setting['background_height'] = '21px'; 
		$customizer_style_setting['background_width'] = '976px'; 
		$customizer_style_setting['background_color'] = '#fff7f0';
		$customizer_style_setting['answer_border_width'] = '2px';
		$customizer_style_setting['answer_border_style'] = 'solid';
		$customizer_style_setting['answer_border_color'] = '#ff6161';
		$customizer_style_setting['answer_border_shadow_color'] = '#fd1c1c';
		$customizer_style_setting['skip_button_width'] = '175px';
		$customizer_style_setting['skip_button_height'] = '50px';
		$customizer_style_setting['skip_button_background_color'] = '#00c1b7';
		$customizer_style_setting['continue_button_width'] = '200px';
		$customizer_style_setting['continue_button_height'] = '50px';
		$customizer_style_setting['continue_button_background_color'] = '#ff7777';
		$customizer_style_setting['continue_button_hover_background_color'] = '#ff7777';
		$customizer_style_setting['start_background_inner_width'] = '925px';
		$customizer_style_setting['result_background_inner_width'] = '1009px';
		$customizer_style_setting['opt_background_inner_width'] = '925px';
		$quiz_details_array['customizer_style_setting'] = $customizer_style_setting;
		
		$quiz_details_array['pre_built'] = 'N';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);
	// set variable for quiz table end 	
	
	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
	 	$start_temp_no = 'template8';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/sqb_bt_image1.jpg";			 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$registration_image =  plugins_url('')."/smartquizbuilder/includes/images/sqb-registration-img.jpg";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 
		
		$start_temp_html = 	$cssfile.'<div class="Quiz-Start-Template2 Start-template-withbutton"> <div class="Quiz-Template-content"> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" style="color: rgb(51, 51, 51); background-color: rgb(255, 218, 92); position: relative; max-width: 470px; background-position-y: -20px;" id="mce_101" contenteditable="true" spellcheck="false"><div style="cursor: grabbing; background-position-y: -4px;" data-mce-style="cursor: grab; background-position-y: -1px;">Get Instant Access</div></div> </div> </div>';
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template">
	<div class="skip_optin sqb_tiny_mce_editor mce-content-body" style="display:none; text-align: right;" id="mce_106" contenteditable="true" spellcheck="false"><div>Skip Opt-in</div></div>
	<div class="lead-image-video-section">
		
		<div class="lead_screen_img_div Quiz-Template-image ui-resizable" id="lead_screen_temp_id" style="display: none;">
			<img class="lead_screen_temp_img" src="'.$registration_image.'">
			<span data-class="lead_screen_temp_img" class="question_img_upload sbq_change_lead_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
		<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>
		
		<div class="video-element-outer leadScreenTemplateVideoOuter ui-resizable" data-type="leadScreen" style="display: none;">
			<div class="videoOverlay" data-toggle="modal" data-target="#leadScreen-video-insert"></div>
			<input type="hidden" class="leadScreen_video_url" value="">
			<input type="hidden" class="leadScreen_show_video" value="N">
			<input type="hidden" class="leadScreen_video_link_type" value="0">
			<input type="hidden" class="leadScreen_video_link_type_text" value="Source">
			<input type="hidden" class="leadScreen_video_aspect" value="1">

			<a href="javascript:void(0)" class="leadScreenTemplateVideoOuterLinkOver insertleadScreenVideo" data-type="leadScreen"></a>
			<div class="video-add-link leadScreenTemplateInsertVideoOuter" style="">
				<a href="javascript:void(0)" class="insertleadScreenVideo" data-type="leadScreen"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
			</div>
			<div class="leadScreenTemplateYoutubeVideoOuter" style="display:none">
				<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
			</div>
			<div class="external-videoWrapper leadScreenTemplateCommonVideoOuter" style="display:none">
				<video width="400" controls="">
				</video>
			</div>
		<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>
	</div>


	<div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_107" contenteditable="true" style="position: relative;" spellcheck="false"><div>Get Instant Access</div></div>
	<div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_108" contenteditable="true" style="position: relative;" spellcheck="false"><div>Where can we email you the download details?</div></div>
	<div class="Quiz-Template-content"> 	
		<form id="sqb_direct_signup" class="sqbform fields_reorder_enabled" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit="">
			<input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%">
			<input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%">
			<input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%">
			<div class="form_cls ui-sortable">
				<div id="elfirst_name" class="core-fields ui-sortable-handle">
					<input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name" style="pointer-events: auto;">	 
				</div>
				<div id="elemail" class="core-fields ui-sortable-handle">
					<input type="email" name="email" id="email" value="" placeholder="Your Email" style="pointer-events: auto;">
				</div>
				<div class="sqb-checkbox termsConditionOuter ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox" style="pointer-events: auto;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_109" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service</label><input type="hidden" name="mce_109" style="pointer-events: none;">
				</div>	

				<div class="sqb-gdpr-checkbox gdpr-Outer ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox" style="pointer-events: none;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_110" contenteditable="true" spellcheck="false" style="position: relative;">Unsubscribe anytime. For further details, review your Privacy Policy.</label><input type="hidden" name="mce_110" style="pointer-events: none;">
				</div>
			</div>
			<div class="continue_btn sqb_tiny_mce_editor background-color-one-to-four mce-content-body" style="width: 700px; color: rgb(51, 51, 51); position: relative; background-color: rgb(255, 208, 46);" id="mce_111" contenteditable="true" spellcheck="false"><div>Download Now &gt;&gt;&gt;</div></div><input type="hidden" name="mce_111">	
			<div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_116" contenteditable="true" style="position: relative;" spellcheck="false"><div>You can unsubscribe at any time.</div></div><input type="hidden" name="mce_116">		
		</form>  					
	</div>	 
</div>'; 
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 921px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.8); cursor: grabbing; background-position-y: -3px;'; 
		$select_temp_class = 'Quiz-Template-8';
		$select_temp = 'template8';	
		$question_temp_html = '<div class="Quiz-Template '.$select_temp_class.'" data-id="" style="'.$question_template_style.'">%%QUESTIONANSWERS%%</div>';	
		$enable_branching = 'Y';	 
	
	 	$quiz_details_array['start_temp_html'] = $start_temp_html; //urldecode
	 	$quiz_details_array['result_temp_html'] = 'quiz_result_template_html';  //urldecode
	 	$quiz_details_array['question_temp_html'] = $question_temp_html;   //urldecode
	 	$quiz_details_array['optin_temp_html'] = $optin_temp_html;    //urldecode
	 	$quiz_details_array['start_template_no'] = 'template1';      
	 	$quiz_details_array['start_image'] = $start_img_url;  //urldecode
	 	$quiz_details_array['result_template_no'] = 'template1';
	 	$quiz_details_array['optin_template_no'] = 'template1';
	 	$quiz_details_array['quiz_first_name_template'] = 'quiz_first_name_template';
	 	$quiz_details_array['template_no'] = 'template1';
	 	$quiz_details_array['common_style'] = '#f56640';
	// set variable for quiz template table end 	

	$quiz_details_array['actionType'] = 'save_quiz';
	$quiz_details_array['function_call_by'] = 'call_by_buil_theme';
	
	$quiz_data = SQBSaveQuizAjax($quiz_details_array);
	if(isset($quiz_data['quiz_id'])){

		$global_theme_data = 'a:104:{s:37:"next_button_settings_background_color";s:16:"rgba(37,37,37,1)";s:43:"next_button_settings_background_hover_color";s:18:"rgba(255,208,46,1)";s:23:"nexttbtn_width_for_quiz";s:3:"100";s:24:"nexttbtn_height_for_quiz";s:2:"12";s:29:"skip_question_button_for_quiz";s:18:"rgba(79,108,191,1)";s:32:"skip_question_btn_width_for_quiz";s:3:"100";s:33:"skip_question_btn_height_for_quiz";s:2:"12";s:24:"nexttbtn_radius_for_quiz";s:1:"5";s:35:"skip_question_button_hover_for_quiz";s:18:"rgba(79,108,191,1)";s:33:"skip_question_btn_radius_for_quiz";s:1:"5";s:29:"back_question_button_for_quiz";s:13:"rgba(0,0,0,1)";s:35:"back_question_button_hover_for_quiz";s:13:"rgba(0,0,0,1)";s:32:"back_question_btn_width_for_quiz";s:3:"100";s:33:"back_question_btn_height_for_quiz";s:2:"12";s:15:"back_btn_radius";s:1:"5";s:22:"setting_progress_color";s:18:"rgba(79,108,191,1)";s:31:"setting_progress_inactive_color";s:19:"rgba(255,255,255,1)";s:23:"setting_tag_width_input";s:3:"900";s:28:"setting_tag_background_color";s:19:"rgba(255,255,255,1)";s:21:"tag_title_font_family";s:18:"DM Sans,sans-serif";s:19:"tag_title_font_size";s:2:"20";s:21:"tag_title_font_weight";s:3:"700";s:20:"tag_title_font_color";s:7:"#000000";s:20:"tag_desc_font_family";s:18:"DM Sans,sans-serif";s:18:"tag_desc_font_size";s:2:"16";s:20:"tag_desc_font_weight";s:3:"400";s:19:"tag_desc_font_color";s:7:"#000000";s:17:"tag_bottom_margin";s:2:"20";s:11:"tag_padding";s:2:"20";s:22:"sqb_global_outer_width";s:3:"700";s:25:"sqb_selected_global_width";s:2:"px";s:22:"sqb_global_inner_width";s:3:"900";s:18:"sqb_global_padding";s:3:"200";s:26:"sqb_selected_global_height";s:2:"px";s:23:"sqb_global_height_input";s:3:"400";s:27:"sqb_global_background_color";s:19:"rgba(239,243,245,1)";s:33:"sqb_global_inner_background_color";s:19:"rgba(239,243,245,1)";s:27:"sqb_global_background_image";s:70:"linear-gradient(rgba(255,166,166,0),rgba(255,166,166,0)),url(\"none\")";s:31:"sqb_global_background_image_url";s:4:"none";s:29:"sqb_global_title_color_enable";s:1:"Y";s:22:"sqb_global_title_color";s:7:"#ffffff";s:35:"sqb_global_title_font_family_enable";s:1:"Y";s:28:"sqb_global_title_font_family";s:7:"DM Sans";s:35:"sqb_global_title_line_height_enable";s:1:"Y";s:28:"sqb_global_title_line_height";s:1:"1";s:33:"sqb_global_title_font_size_enable";s:1:"Y";s:26:"sqb_global_title_font_size";s:2:"32";s:28:"sqb_global_title_font_weight";s:3:"700";s:35:"sqb_global_description_color_enable";s:1:"Y";s:28:"sqb_global_description_color";s:7:"#ffffff";s:39:"sqb_global_description_font_size_enable";s:1:"Y";s:32:"sqb_global_description_font_size";s:2:"20";s:34:"sqb_global_description_font_weight";s:3:"400";s:41:"sqb_global_description_font_family_enable";s:1:"Y";s:34:"sqb_global_description_font_family";s:7:"DM Sans";s:36:"sqb_global_question_ans_color_enable";s:1:"Y";s:38:"sqb_global_ans_background_color_enable";s:1:"N";s:34:"sqb_global_ans_border_width_enable";s:1:"N";s:38:"sqb_global_ans_text_hover_color_enable";s:1:"N";s:44:"sqb_global_ans_background_hover_color_enable";s:1:"Y";s:29:"sqb_global_question_ans_color";s:7:"#ffffff";s:31:"sqb_global_ans_background_color";s:7:"#e5f1ff";s:34:"sqb_global_ans_border_radius_color";s:7:"#ffffff";s:40:"sqb_global_ans_border_radius_hover_color";s:7:"#ffffff";s:31:"sqb_global_ans_text_hover_color";s:7:"#ffffff";s:37:"sqb_global_ans_background_hover_color";s:7:"#ffda5c";s:40:"sqb_global_question_ans_font_size_enable";s:1:"Y";s:33:"sqb_global_question_ans_font_size";s:2:"19";s:27:"sqb_global_ans_border_width";s:1:"2";s:42:"sqb_global_question_ans_font_family_enable";s:1:"Y";s:36:"sqb_global_button_font_family_enable";s:1:"Y";s:35:"sqb_global_question_ans_font_family";s:7:"DM Sans";s:29:"sqb_global_button_font_family";s:7:"DM Sans";s:35:"sqb_global_question_ans_font_weight";s:3:"500";s:41:"sqb_global_ans_border_radius_color_enable";s:1:"N";s:47:"sqb_global_ans_border_radius_hover_color_enable";s:1:"N";s:28:"sqb_global_background_enable";s:1:"Y";s:21:"sqb_global_background";s:7:"#000000";s:30:"sqb_global_border_color_enable";s:1:"Y";s:23:"sqb_global_border_color";s:7:"#dddddd";s:30:"sqb_global_border_style_enable";s:1:"Y";s:23:"sqb_global_border_style";s:5:"solid";s:30:"sqb_global_border_width_enable";s:1:"Y";s:23:"sqb_global_border_width";s:1:"1";s:38:"sqb_global_shadow_spread_radius_enable";s:1:"N";s:31:"sqb_global_shadow_spread_radius";s:1:"1";s:36:"sqb_global_shadow_blur_radius_enable";s:1:"N";s:29:"sqb_global_shadow_blur_radius";s:1:"1";s:42:"sqb_global_shadow_horizontal_length_enable";s:1:"N";s:35:"sqb_global_shadow_horizontal_length";s:1:"1";s:40:"sqb_global_shadow_vertical_length_enable";s:1:"N";s:33:"sqb_global_shadow_vertical_length";s:1:"1";s:41:"sqb_global_shadow_background_color_enable";s:1:"N";s:34:"sqb_global_shadow_background_color";s:7:"#ffffff";s:33:"setting_category_background_color";s:19:"rgba(255,255,255,1)";s:26:"category_title_font_family";s:18:"DM Sans,sans-serif";s:24:"category_title_font_size";s:2:"20";s:25:"category_title_font_color";s:7:"#000000";s:25:"category_desc_font_family";s:18:"DM Sans,sans-serif";s:23:"category_desc_font_size";s:2:"16";s:24:"category_desc_font_color";s:7:"#000000";s:22:"category_bottom_margin";s:2:"20";s:16:"category_padding";s:2:"20";s:24:"top_bar_background_color";s:21:"rgba(245, 102, 64, 1)";}';

		$screen_name = 'settings_background_color';
		$strm_type = 'settings';
		$date = date('Y-m-d H:i:s');

		$new_obj_theme_data = new SQB_GlobalTheme();
		$new_obj_theme_data->setQuizId($quiz_data['quiz_id']);
		$new_obj_theme_data->setName($screen_name);
		
		$new_obj_theme_data->setStatus('Y');
		$new_obj_theme_data->setDate($date);
		$new_obj_theme_data->setType($strm_type);
		$new_obj_theme_data->setCustomValues('');
		$new_obj_theme_data->setOuterStyleStatus('Y');

		$new_obj_theme_data->setValue($global_theme_data);
		$new_obj_theme_data->create();

		$screen_name = 'global_screen_values';
		$strm_type = 'global';
		$new_obj_theme = new SQB_GlobalTheme();
		$new_obj_theme->setQuizId($quiz_data['quiz_id']);
		$new_obj_theme->setName($screen_name);
		
		$new_obj_theme->setStatus('Y');
		$new_obj_theme->setDate($date);
		$new_obj_theme->setType($strm_type);
		$new_obj_theme->setCustomValues('');
		$new_obj_theme->setOuterStyleStatus('Y');

		$new_obj_theme->setValue('');
		$new_obj_theme->create();


		/*Autoresponder Data*/

		$sqbData = new SQB_QuizAutoresponder();
		$sqbData->setName('dap');
		$sqbData->setQuizId($quiz_data['quiz_id']);
		$sqbData->setAction('add');
		$sqbData->setActionType('product');
		$sqbData->setActionId('NULL');
		$sqbData->setActionData($productId);
		$sqbData->setDate($date);
		$sqbData->create();

		/**/

		$thank_you_image = plugins_url('')."/smartquizbuilder/includes/images/formquiz-thankyou.jpg";
		$image_not_found = plugins_url('')."/smartquizbuilder/includes/images/image_not_found.png";
		$outcome_table_array = array();
		$oc_i = 0;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_data['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Thank You!';
		
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 700px; border-width: 1px; text-align: left; border-style: solid;"> 
		<div class="points_scored_result sqb_outcome_tiny_mce_editor    mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_18"><div>Your Result Type is [Outcome_Title]</div></div> 
		<span class="sqbHideTemplateImageOuter" style="display:none"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none; height: 275px;">
			
			<img class="23_09_16_09_09_2665 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$thank_you_image.'" style="position: relative; height: 275px;">
			<span data-class="23_09_16_09_09_2665" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span>
		<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>
		<div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none">
			<input type="hidden" class="outcome_video_url" value="">
			<input type="hidden" class="outcome_show_video" value="N">
			<input type="hidden" class="outcome_video_link_type" value="0">
			<input type="hidden" class="outcome_video_link_type_text" value="Source">
			<input type="hidden" class="outcome_video_aspect" value="1">

			<a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a>
			<div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none">
				<a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
			</div>
			<div class="outcomeTemplateYoutubeVideoOuter" style="display:none">
				<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
			</div>
			<div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none">
				<video width="400" controls="">
				</video>
			</div>
		<div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div>
		<div class="Quiz-Template-content">
			<span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid">
				<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span-->
				
				<div class="sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_19"><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</div></div><br>
			</div>
			<div class="outcome_products_section">
				<span class="sqbHideOutcomeProductsOuter sqb_backend_show" style="width:100%;"><button class="sqbHideOutcomeProducts">Hide Products</button></span>
				<span class="sqbShowOutcomeProductsOuter sqb_backend_show" style="display:none;width:100%;"><button class="sqbShowOutcomeProducts">Show Products</button></span>
				<div class="question_drop_down_wrapper">
					<div class="quiz-content-card question-type-card question_type_wrapper" style="">
						<label class="quiz_label">Choose Layout</label>
						<div class="dropdown dropdown-custom-style">
							<button class="dropdown-toggle outcome-select-layout" type="button" data-value="four">4 Columns</button>
							<ul class="dropdown-menu outcome_layout_type_list_ul">
								<li><a href="javascript:void(0)" value="one">1 Column</a></li>
								<li><a href="javascript:void(0)" value="two">2 Columns</a></li>
								<li><a href="javascript:void(0)" value="three">3 Columns</a></li>
								<li><a href="javascript:void(0)" value="four">4 Columns</a></li>
								<li><a href="javascript:void(0)" value="five">5 Columns</a></li>
								<li><a href="javascript:void(0)" value="six">6 Columns</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="question_add_answer_outer_div sqb_question_drag_drop_item ui-sortable grid-layout-active layout-four-in-row-active image_option_has">
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_20"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_21"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_22"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_23"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_24"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_25"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_26"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_27"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_28"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_29"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_30"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_31"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="'.$image_not_found.'" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_32"><div>Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_outcome_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_33"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
				</div>
				<span class="sqbAddOutcomeProductOuter" style="float:right;"><button class="sqbAddOutcomeProduct">Add Product</button></span>
			</div>
			<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid">
				<div class="d-inline-block pos_relative">
					<span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span>
					<div class="take-quiz-btn sqb_outcome_tiny_mce_editor mce-content-body" style="background-color: rgb(255, 218, 92); max-width: 700px; padding-top: 10px; padding-bottom: 10px; position: relative;" contenteditable="true" spellcheck="false" id="mce_34"><div style="color: #333;" data-mce-style="color: #333;">Continue</div></div>
				</div>				
			</div>	 
		</div>	 
	</div>';
	
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '';
		$outcome_table_array[$oc_i]['range_val1'] = '';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = 'maiansupport';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		// set variable for outcome table end
		$outcome_data_array = array();
		$outcome_data_array['outcomes_data'] = $outcome_table_array;
		
		
		$outcome_output =  sqb_outcometemp($outcome_data_array);
		$outcome_has = false;
		if(isset($outcome_output['ids']) and count($outcome_output['ids'])){

			$outcome_redirect = array();
			$outcome_redirect['outcome_redirect'] = $thankYouURL; 
			$outcome_redirect['outcome_screen'] = 'redirect'; 
			$outcome_redirect['outcome_action'] = 'redirectsave'; 
			$outcome_redirect['id'] = $outcome_output['ids'][0]; 

			sqb_outcometemp($outcome_redirect);
		}
		
	}
	$output = '[SmartQuizBuilder id='.$quiz_data['quiz_id'].'][/SmartQuizBuilder]';
    return $output;
}

