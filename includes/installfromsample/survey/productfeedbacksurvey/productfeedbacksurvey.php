<?php
		$current_data_time =  date('Y-m-d H:i:s');
		$quiz_details_array = array();
		// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Product Feedback Survey'; // urldecode 
		$quiz_details_array['quiz_desc'] = 'Your feedback matters to us! We\'d love to know a bit more about [PRODUCT] experience!'; // urldecode
		$quiz_details_array['quiz_type'] = 'survey';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'N';
		$quiz_details_array['quiz_display'] = 'inpage';
		
		$quiz_details_array['quiz_move_question'] = 'N';
		$quiz_details_array['show_share_screen'] = 'N';
		$quiz_details_array['category_option'] = 'category_option';
		$quiz_details_array['move_question'] = 'N';
		$quiz_details_array['show_back_btn_option'] = 'show_back_btn_option';
		$quiz_details_array['select_quiz_bank'] = 'select_quiz_bank';
		$quiz_details_array['quiz_ans_tags'] = 'N';
		$quiz_details_array['limit_questions_displayed'] = 'limit_questions_displayed';
		$quiz_details_array['limit_input'] = 'limit_input';
		$quiz_details_array['customizer_styles'] = 'customizer_styles';
		$quiz_details_array['quiz_recommendation_enable'] = 'N';	
		$quiz_details_array['quiz_ads_enable'] = 'N';


		$quiz_details_array['quiz_blocking'] = 'N';
		$quiz_details_array['quiz_passmark'] = '0';
		$quiz_details_array['sqb_quiz_many_attempts'] = 'Unlimited';
		$quiz_details_array['quiz_pagination'] = 'one_per_page';
		$quiz_details_array['question_per_page'] = '1';
		
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
		$quiz_details_array['show_result_screen'] = '';
		$quiz_details_array['show_firstname_template'] = 'Y';
		$quiz_details_array['template_display_sequence'] = 'start_temp,quesans_temp,optin_temp,result_temp';
		$quiz_details_array['user_added_my_email_platform'] = 'add_user_in_wp';
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
		$quiz_details_array['template'] = 'template5';
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
		$quiz_details_array['quick_email_verification'] = '';
		$quiz_details_array['quiz_slider_animation'] = 'N';
		$quiz_details_array['quiz_slider_animation_option'] = 'r1';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = '';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; // urldecode 
		//$quiz_details_array['quiz_timmer_array']['timer_customizer'] = 'N||00||00||00||show_last_screen||question';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_expired_msg'] = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';   // urldecode 
		$quiz_details_array['enable_background_image'] = 'Y';
		$quiz_details_array['show_correct_ans_option'] = '';
		
		$quiz_details_array['pre_built'] = 'Y';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);
	// set variable for quiz table end 	

	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
	 	$sqb_img_folder_url_sample_folder = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/s1/";
	 	$start_temp_no = 'template5';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/sqb_bt_image1.jpg";				 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 	 
		$start_temp_html = 	$cssfile.'<div class="Quiz-start-Template5 start_temp_outer" style="border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; max-width: 1407px; background-color: transparent;"><div class="Quiz-start-Template5-inner" style="min-height: 735px;"><div class="Quiz-start-Template5-left sqb_start_screen_background_image" style="background-color: rgb(239, 217, 202); object-fit: contain; background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(&quot;'.$sqb_img_folder_url_sample_folder.'pexels-daria-shevtsova-1467435-1.jpg&quot;); background-size: 640px; background-repeat: no-repeat; background-position: center center;"><div class="Quiz-Template5-title sqb_tiny_mce_editor mce-content-body" id="mce_23" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgba(80, 0, 0, 0.82);"><div><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;">Product Feedback Survey</span></div></div></div><div class="Quiz-start-Template5-right" style="background-color: rgb(20, 28, 58);"><div class="Quiz-Template5-description sqb_tiny_mce_editor mce-content-body" id="mce_24" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">Your feedback matters to us</span><span style="font-size: 18pt;" data-mce-style="font-size: 18pt;">&nbsp;We\'d love to know a bit more about [PRODUCT] experience!</span></div></div><div class="quiz-Template5-btn take-quiz-btn sqb_tiny_mce_editor mce-content-body" id="mce_25" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgb(255, 213, 0); width: 339px; padding-top: 15px; padding-bottom: 15px;"><div><span style="font-size: 17pt;" data-mce-style="font-size: 17pt;">Tell us what you think &gt;&gt;&gt;</span></div></div></div></div></div>';
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template" style="max-width: 1402px; background-color: rgb(0, 0, 0); border: none; border-radius: 0px; min-height: 760px;"><div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_10" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Almost there...</span></div></div><div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_11" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Where can we email you the results? Please enter details below.</span></div></div><div class="Quiz-Template-content"><form id="sqb_direct_signup" class="sqbform" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit=""><input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%"><input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%"><input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%"><div class="form_cls"><input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name"><input type="email" name="email" id="email" value="" placeholder="Your Email"><div class="sqb-checkbox termsConditionOuter" style="display:none"><span class="checkbox-custom-style"><input class="required custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox"><span class="custom--checkbox"></span></span><label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_12" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_12"><input type="hidden" name="mce_12"></div></div><div class="continue_btn sqb_tiny_mce_editor  mce-content-body" id="mce_13" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgb(255, 99, 77);"><div>Get Started</div></div><input type="hidden" name="mce_13"><input type="hidden" name="mce_13"><input type="hidden" name="mce_13"><input type="hidden" name="mce_13"><div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative;"><div style="text-align: center;" data-mce-style="text-align: center;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">You can unsubscribe at any time.</span></div></div><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"></form></div></div>';
		
		$quiz_result_template_html = '<div class="Quiz-result-Template5-inner" style="min-height: 760px;"><div class="Quiz-result-Template5-left sqb_start_screen_background_image" style="background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(&quot;'.$sqb_img_folder_url_sample_folder.'pexels-polina-zimmerman-3747446.jpg&quot;); background-size: 640px; background-repeat: no-repeat; background-position: center center; object-fit: contain; background-color: rgb(239, 217, 202);"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; padding: 30px 20px; background-color: rgba(124, 0, 0, 0.8);" spellcheck="false" id="mce_29"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">Thank you so much for your time <img draggable="false" role="img" class="emoji" alt="🙌" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64c.svg" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64c.svg"></span></div></div></div><div class="Quiz-result-Template5-right" id="result_temp_contentid" style="background-color: rgb(20, 28, 58);"><div class="Quiz-Template5-description sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_30"><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;">We truly appreciate your feedback</span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;">Your feedback will allow us to make [PRODUCT] even better! Thank you&nbsp;<br></span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;"><strong><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64f.svg" alt="🙏" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64f.svg"></strong></span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(51, 51, 51);" data-mce-style="font-size: 19pt; color: #333333;"><br></span></h2></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 1406px; background-color: rgb(255, 255, 255)'; 
		$select_temp_class = '';
		$select_temp = 'template1';	
		$question_temp_html = '<div class="Quiz-Template Quiz-Template-5" data-id="" style="background-color: rgb(255, 255, 255); max-width: 1406px;">%%QUESTIONANSWERS%%</div>';	
		$enable_branching  = 'Y';	 
	
	 	$quiz_details_array['start_temp_html'] = $start_temp_html; //urldecode
	 	$quiz_details_array['result_temp_html'] = $quiz_result_template_html;  //urldecode
	 	$quiz_details_array['question_temp_html'] = $question_temp_html;   //urldecode
	 	$quiz_details_array['optin_temp_html'] = $optin_temp_html;    //urldecode
	 	$quiz_details_array['start_template_no'] = 'template1';      
	 	$quiz_details_array['start_image'] = '';  //urldecode
	 	$quiz_details_array['result_template_no'] = 'template1';
	 	$quiz_details_array['optin_template_no'] = 'template1';
	 	$quiz_details_array['quiz_first_name_template'] = '';
	 	$quiz_details_array['template_no'] = 'template1';
	 	$quiz_details_array['common_style'] = '#f56640';
	// set variable for quiz template table end 	
	
	
		
	
		
	
	$quiz_details_array['actionType'] = 'save_quiz';
	$quiz_details_array['function_call_by'] = 'call_by_buil_theme';
	
	if(isset($_GET['sqb_theme_built_install_call']) && $_GET['sqb_theme_built_install_call']){
		$quiz_details = SQBSaveQuizAjax($quiz_details_array);
		if(is_array($quiz_details) && isset($quiz_details['quiz_id'])){
			// set variable for outcome table start
			$outcome_table_array = array();
			$oc_i = 0;
			$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
			$outcome_table_array[$oc_i]['outcome_name'] = 'Thanks';
			$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-result-Template5 Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 1410px; text-align: left;"><div class="Quiz-result-Template5-inner" style="min-height: 760px;"><div class="Quiz-result-Template5-left sqb_start_screen_background_image" style="background-image: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)), url(&quot;'.$sqb_img_folder_url_sample_folder.'pexels-polina-zimmerman-3747446.jpg&quot;); background-size: 640px; background-repeat: no-repeat; background-position: center center; object-fit: contain; background-color: rgb(239, 217, 202);"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; padding: 30px 20px; background-color: rgba(124, 0, 0, 0.8);" spellcheck="false" id="mce_29"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">Thank you so much for your time <img draggable="false" role="img" class="emoji" alt="🙌" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64c.svg" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64c.svg"></span></div></div></div><div class="Quiz-result-Template5-right" id="result_temp_contentid" style="background-color: rgb(20, 28, 58);"><div class="Quiz-Template5-description sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_30"><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;">We truly appreciate your feedback</span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;">Your feedback will allow us to make [PRODUCT] even better! Thank you&nbsp;<br></span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 19pt; color: #ffffff;"><strong><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64f.svg" alt="🙏" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f64f.svg"></strong></span></h2><h2 class="" data-css="tve-u-60ef3b390734d5"><span style="font-size: 19pt; color: rgb(51, 51, 51);" data-mce-style="font-size: 19pt; color: #333333;"><br></span></h2></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div></div>';
			
			$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
			$outcome_table_array[$oc_i]['number_val'] = '0';
			$outcome_table_array[$oc_i]['range_val'] = '';
			$outcome_table_array[$oc_i]['range_val1'] = '';
			$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
			$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
			$outcome_table_array[$oc_i]['outcome_screen'] = '';
			$outcome_table_array[$oc_i]['redirect'] = '';
			$outcome_table_array[$oc_i]['tag'] = '';
			$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'Y';
			$outcome_table_array[$oc_i]['date'] = $current_data_time;
			$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
			
			
			// set variable for outcome table end
			$outcome_data_array = array();
			$outcome_data_array['outcomes_data'] = $outcome_table_array;
			// save outcome function call
			$outcome_output =  sqb_outcometemp($outcome_data_array);
			$outcome_has = false;
			if(isset($outcome_output['ids']) and count($outcome_output['ids'])){
				$outcome_has = true;
			}
			
			// set variable for question bank table start
				$question_bank_array = array();
				// set variable of index 0 question start 
				$qb_i = 0;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.77);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">… and what would you like to see us improve?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = ' … and what would you like to see us improve?';
				$question_bank_array[$qb_i]['question_type'] = 'text';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '2';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||rgb(255, 213, 0)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-karolina-grabowska-5908822.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				
					// set  0 index for answer start
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array = array(); 	
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand_img.'" placeholder="Enter the text here"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						
						$answer_table_array[$at_i]['answer_title'] = '';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set  0 index for answer end
				
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 1 question start 
				$qb_i = 1;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.77);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">&nbsp;What did you like the most about [PRODUCT] <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f60a.svg" alt="😊" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f60a.svg">?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'What did you like the most about [PRODUCT] ?';
				$question_bank_array[$qb_i]['question_type'] = 'text';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '1';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||rgb(255, 136, 29)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-flo-dahm-699459.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				
					// set  0 index for answer start
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array = array(); 	
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand_img.'" placeholder="Enter the text here"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set  0 index for answer end
				
				
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 1 question end 
				
				
				// set variable of index 2 question start 
				$qb_i = 2;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.73);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_12" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">What was your overall impression of [PRODUCT] when you first used it?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'What was your overall impression of [PRODUCT] when you first used it?';
				$question_bank_array[$qb_i]['question_type'] = 'single';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '0';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||rgb(145, 126, 242)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-kaboompics-com-q1.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.73)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				$answer_table_array = array(); 
				// set  0 index for answer start
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_17" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Loved it</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Loved it';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set  0 index for answer end 
					
					// set  1 index for answer start
						$at_i = 1;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_19" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Liked it</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Liked it';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '1';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable 1 index for answer end
					
					// set variable 2 index for answer start
						$at_i = 2;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_19" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Liked it</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'It was alright';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '2';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable 2 index for answer end 
					
					// set variable 3 index for answer start
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_22" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Didn\'t like it</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Didn\'t like it';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '3';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable 3 index for answer end
					
					// set variable 4 index for answer start
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_24" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Hated it</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Hated it';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '4';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable 4 index for answer end
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 2 question end
				
				// set variable of index 3 question start 
				$qb_i = 3;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.77);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">… and what would you like to see us improve?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = '… and what would you like to see us improve?';
				$question_bank_array[$qb_i]['question_type'] = 'text';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '4';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||rgb(255, 213, 0)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'10.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.77)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				
				$answer_table_array = array(); 
				// set variable of index 0 for answer start 
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand_img.'" placeholder="Enter the text here"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 0 for answer end 
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 3 question end 
				
				// set variable of index 4 question start 
				$qb_i = 4;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.85);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_25" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">Overall quality — How would you rate [PRODUCT]?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'Overall quality — How would you rate [PRODUCT]?';
				$question_bank_array[$qb_i]['question_type'] = 'rating';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '3';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||<div><span style="color: rgb(0, 51, 0); font-size: 15pt;" data-mce-style="color: #003300; font-size: 15pt;"><strong>Terrible</strong></span></div>||<div><span style="color: rgb(153, 51, 102); font-size: 15pt;" data-mce-style="color: #993366; font-size: 15pt;"><strong>Amazing</strong></span></div>||rgb(253, 77, 63)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-thirdman-5052287.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.85)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				$answer_table_array = array(); 
				// set variable of index 0 for answer start 
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_35" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">1</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '1';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 0 for answer end 
					// set variable of index 1 for answer start 
						$at_i = 1;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_36" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">2</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '2';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '1';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 1 for answer end 
					// set variable of index 2 for answer start 
						$at_i = 2;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_37" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">3</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '3';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '2';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 2 for answer end 
					// set variable of index 3 for answer start 
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_38" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">4</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '4';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '3';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 3 for answer end 
					
					// set variable of index 4 for answer start 
						$at_i = 4;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_39" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">5</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '5';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '4';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 4 for answer end
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				// set variable of index 4 question end 
				// set variable of index 5 question start 
				$qb_i = 5;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 90, 59, 0.84);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_42" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: #ffffff;" data-mce-style="color: #ffffff;"><span style="font-size: 22pt;" data-mce-style="font-size: 22pt;"><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;">How would you rate it\'s value for money?</span><br></span> <span style="font-size: 17pt;" data-mce-style="font-size: 17pt;">1 means total waste, 5 means totally worth it</span></span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'How would you rate it\'s value for money? 1 means total waste, 5 means totally worth it';
				$question_bank_array[$qb_i]['question_type'] = 'rating';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '6';//'44';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||<div><span style="font-size: 14pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 14pt; color: #ffffff;">Strongly Disagree</span></div>||<div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Strongly Agree</span></div>||rgb(71, 204, 160)||rgb(20, 28, 58)||750px||'.$sqb_img_folder_url_sample_folder.'pexels-polina-zimmerman-3746932.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 90, 59, 0.84)||rgba(0, 0, 0, 0.5)||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				$answer_table_array = array(); 
				// set variable of index 0 for answer start 
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_51" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">1</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '1';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 0 for answer end 
					// set variable of index 1 for answer start 
						$at_i = 1;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_52" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">2</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '2';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '1';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 1 for answer end 
					// set variable of index 2 for answer start 
						$at_i = 2;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_53" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">3</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '3';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '2';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 2 for answer end 
					// set variable of index 3 for answer start 
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_54" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">4</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '4';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '3';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 3 for answer end 
					
					// set variable of index 4 for answer start 
						$at_i = 4;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_55" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">5</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '5';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '4';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 4 for answer end
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				
				
				// set variable of index 5 question end 
				
				// set variable of index 6 question start 
				$qb_i = 6;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.79);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_58" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">How likely are you to recommend [PRODUCT] to someone you know?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'How likely are you to recommend [PRODUCT] to someone you know?';
				$question_bank_array[$qb_i]['question_type'] = 'rating';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '5';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||<div><span style="font-size: 14pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 14pt; color: #ffffff;">Not likely</span></div>||<div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Very likely</span></div>||rgb(145, 126, 242)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'pexels-linkedin-sales-navigator-1251862-2.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.79)||false||#000000';
				
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				$answer_table_array = array(); 
				// set variable of index 0 for answer start 
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_51" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">1</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '1';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 0 for answer end 
					// set variable of index 1 for answer start 
						$at_i = 1;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_52" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">2</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '2';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '1';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 1 for answer end 
					// set variable of index 2 for answer start 
						$at_i = 2;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_53" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">3</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '3';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '2';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 2 for answer end 
					// set variable of index 3 for answer start 
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_54" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">4</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '4';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '3';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 3 for answer end 
					
					// set variable of index 4 for answer start 
						$at_i = 4;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_55" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">5</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = '5';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '4';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 4 for answer end
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 6 question end 
				
				// set variable of index 7 question start 
				$qb_i = 7;
				$question_bank_array[$qb_i]['question_data'] = '<div class="question_details" style="background-color: rgba(0, 55, 218, 0.73);"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" id="mce_74" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255); font-size: 19pt;" data-mce-style="color: #ffffff; font-size: 19pt;">Thanks <img draggable="false" role="img" class="emoji" alt="😊" src="https://s.w.org/images/core/emoji/13.0.1/svg/1f60a.svg" data-mce-src="https://s.w.org/images/core/emoji/13.0.1/svg/1f60a.svg"> ... and the main reason for recommendation is?</span></div></div></div>'; //urldecode
				$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
				$question_bank_array[$qb_i]['question_title'] = 'Thanks  ... and the main reason for recommendation is?';
				$question_bank_array[$qb_i]['question_type'] = 'multi';
				$question_bank_array[$qb_i]['question_image'] = 'image';
				$question_bank_array[$qb_i]['order'] = '7';
				$question_bank_array[$qb_i]['ans_with_img'] = 'N';
				$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
				$question_bank_array[$qb_i]['ans_layout'] = 'standard';
				$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
				$question_bank_array[$qb_i]['temp_customizer'] = '1406px||rgb(255, 136, 29)||rgb(20, 28, 58)||740px||'.$sqb_img_folder_url_sample_folder.'background_image.jpg||640px, 640px||no-repeat, no-repeat||50% 50%, 50% 50%||rgba(0, 55, 218, 0.73)||false||#000000';
				$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
				$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
				$question_bank_array[$qb_i]['next_button_html'] = '';
				$question_bank_array[$qb_i]['enable_question_background_image'] = 'Y';
				$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
				$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
				$question_bank_array[$qb_i]['date'] = $current_data_time;
				$answer_table_array = array(); 
				// set variable of index 0 for answer start 
						$at_i = 0;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_87" contenteditable="true" style="position: relative;" spellcheck="false"><div>Ease-of-use</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Ease-of-use';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '0';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 0 for answer end 
					// set variable of index 1 for answer start 
						$at_i = 1;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_89" contenteditable="true" style="position: relative;" spellcheck="false"><div>Design</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Design';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '1';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 1 for answer end 
					// set variable of index 2 for answer start 
						$at_i = 2;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_91" contenteditable="true" style="position: relative;" spellcheck="false"><div>Features</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Features';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '2';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 2 for answer end 
					// set variable of index 3 for answer start 
						$at_i = 3;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_93" contenteditable="true" style="position: relative;" spellcheck="false"><div>Support</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Support';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = '';
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '3';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 3 for answer end 
					
					// set variable of index 4 for answer start 
						$at_i = 4;
						$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
						$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" id="mce_95" contenteditable="true" style="position: relative;" spellcheck="false"><div>Other</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						$answer_table_array[$at_i]['answer_title'] = 'Other';
						$answer_table_array[$at_i]['correct_ans'] = 'N';
						$answer_table_array[$at_i]['ans_point'] = '0';
						$answer_table_array[$at_i]['ans_hint'] = ''; 
						$answer_table_array[$at_i]['ans_info'] = '';
						$answer_table_array[$at_i]['answer_order'] = '4';
						$answer_table_array[$at_i]['date'] = $current_data_time;
					// set variable of index 4 for answer end
					
					$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
				
				// set variable of index 7 question end 
				
			// set variable for question bank table end 
			
			// call quiz save questions function
			$quiz_details_question =  array();
			$quiz_details_question['quiz_id'] =  $quiz_details['quiz_id']; 
			$quiz_details_question['id'] =  $quiz_details['quiz_id'];
			
			$quiz_details_question['questions_data'] =  $question_bank_array;
			$quiz_details_question['actionType'] = 'save_ques';
			
			$question_details = SQBSaveQuizAjax($quiz_details_question);
			// save quiz question end 
			if($quiz_details_array['enable_branching'] == 'Y'){
				
				// set variable for funnel start 
				$funnel_details_array =  array();
				$funnel_details_array['quiz_id'] =  $quiz_details['quiz_id'];
				$funnel_details_array['funnel_enable_branching'] =  'Y';
				$funnel_details_array['data_export'] =stripslashes('{\"drawflow\":{\"Home\":{\"data\":{\"259\":{\"id\":259,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"259\\\" ><span title=\\\"Q3:&nbsp;… and what would you like to see us improve?\\\">… and what would you like to see us improve?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"861\\\"><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":260,\"input\":\"output_1\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":861,\"output\":\"input_1\"},{\"node\":265,\"output\":\"input_1\"}]}},\"pos_x\":515,\"pos_y\":-108},\"260\":{\"id\":260,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"260\\\" ><span title=\\\"Q2:&nbsp; What did you like the most about [PRODUCT] ?\\\"> What did you like the most about [PRODUCT] ?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"862\\\"><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":261,\"input\":\"output_1\"},{\"node\":261,\"input\":\"output_2\"},{\"node\":261,\"input\":\"output_3\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":862,\"output\":\"input_1\"},{\"node\":259,\"output\":\"input_1\"}]}},\"pos_x\":193,\"pos_y\":-167},\"261\":{\"id\":261,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"261\\\" ><span title=\\\"Q1:&nbsp;What was your overall impression of [PRODUCT] when you first used it?\\\">What was your overall impression of [PRODUCT] when you first used it?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"863\\\"><span title=\\\"Loved it\\\">Loved it</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"864\\\"><span title=\\\"Liked it\\\">Liked it</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"865\\\"><span title=\\\"Liked it\\\">Liked it</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"866\\\"><span title=\\\"Hated it\\\">Hated it</span></div></div>\",\"typenode\":false,\"inputs\":[],\"outputs\":{\"output_1\":{\"connections\":[{\"node\":863,\"output\":\"input_1\"},{\"node\":260,\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":864,\"output\":\"input_1\"},{\"node\":260,\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":865,\"output\":\"input_1\"},{\"node\":260,\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":866,\"output\":\"input_1\"},{\"node\":262,\"output\":\"input_1\"}]}},\"pos_x\":-84,\"pos_y\":-48},\"262\":{\"id\":262,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"262\\\" ><span title=\\\"Q5:&nbsp;… and what would you like to see us improve?\\\">… and what would you like to see us improve?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"867\\\"><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":261,\"input\":\"output_4\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"867\",\"output\":\"input_1\"},{\"node\":\"263\",\"output\":\"input_1\"}]}},\"pos_x\":1098,\"pos_y\":592.5714285714286},\"263\":{\"id\":263,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"263\\\" ><span title=\\\"Q4:&nbsp;Overall quality — How would you rate [PRODUCT]?\\\">Overall quality — How would you rate [PRODUCT]?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"868\\\"><span title=\\\"1\\\">1</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"869\\\"><span title=\\\"2\\\">2</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"870\\\"><span title=\\\"3\\\">3</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"871\\\"><span title=\\\"4\\\">4</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"872\\\"><span title=\\\"5\\\">5</span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":265,\"input\":\"output_1\"},{\"node\":265,\"input\":\"output_2\"},{\"node\":265,\"input\":\"output_3\"},{\"node\":266,\"input\":\"output_1\"},{\"node\":266,\"input\":\"output_2\"},{\"node\":266,\"input\":\"output_3\"},{\"node\":266,\"input\":\"output_4\"},{\"node\":\"262\",\"input\":\"output_1\"},{\"node\":\"266\",\"input\":\"output_5\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":869,\"output\":\"input_1\"},{\"node\":264,\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":870,\"output\":\"input_1\"},{\"node\":264,\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":871,\"output\":\"input_1\"},{\"node\":264,\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":872,\"output\":\"input_1\"},{\"node\":264,\"output\":\"input_1\"}]},\"output_5\":{\"connections\":[{\"node\":\"868\",\"output\":\"input_1\"},{\"node\":\"264\",\"output\":\"input_1\"}]}},\"pos_x\":1790,\"pos_y\":-23},\"264\":{\"id\":264,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"264\\\" ><span title=\\\"Q7:&nbsp;How would you rate it\'s value for money? 1 means total waste, 5 means totally worth it\\\">How would you rate it\'s value for money? 1 means total waste, 5 means totally worth it</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"873\\\"><span title=\\\"1\\\">1</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"874\\\"><span title=\\\"2\\\">2</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"875\\\"><span title=\\\"3\\\">3</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"876\\\"><span title=\\\"4\\\">4</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"877\\\"><span title=\\\"5\\\">5</span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":263,\"input\":\"output_1\"},{\"node\":263,\"input\":\"output_2\"},{\"node\":263,\"input\":\"output_3\"},{\"node\":263,\"input\":\"output_4\"},{\"node\":\"263\",\"input\":\"output_5\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":874,\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":875,\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":876,\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":877,\"output\":\"input_1\"}]},\"output_5\":{\"connections\":[{\"node\":\"873\",\"output\":\"input_1\"}]}},\"pos_x\":2401,\"pos_y\":-22},\"265\":{\"id\":265,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"265\\\" ><span title=\\\"Q6:&nbsp;How likely are you to recommend [PRODUCT] to someone you know?\\\">How likely are you to recommend [PRODUCT] to someone you know?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"878\\\"><span title=\\\"1\\\">1</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"879\\\"><span title=\\\"2\\\">2</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"880\\\"><span title=\\\"3\\\">3</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"881\\\"><span title=\\\"4\\\">4</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"882\\\"><span title=\\\"5\\\">5</span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":259,\"input\":\"output_1\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":879,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":880,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":881,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":882,\"output\":\"input_1\"},{\"node\":266,\"output\":\"input_1\"}]},\"output_5\":{\"connections\":[{\"node\":\"878\",\"output\":\"input_1\"},{\"node\":\"266\",\"output\":\"input_1\"}]}},\"pos_x\":728,\"pos_y\":-73},\"266\":{\"id\":266,\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"266\\\" ><span title=\\\"Q8:&nbsp;Thanks ... and the main reason for recommendation is?\\\">Thanks ... and the main reason for recommendation is?</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"883\\\"><span title=\\\"Ease-of-use\\\">Ease-of-use</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"884\\\"><span title=\\\"Design\\\">Design</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"885\\\"><span title=\\\"Features\\\">Features</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"886\\\"><span title=\\\"Support\\\">Support</span></div><div class=\\\"funnel_answer_title\\\" data-answer-id=\\\"887\\\"><span title=\\\"Other\\\">Other</span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":265,\"input\":\"output_4\"},{\"node\":\"265\",\"input\":\"output_5\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":884,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":885,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":886,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":887,\"output\":\"input_1\"},{\"node\":263,\"output\":\"input_1\"}]},\"output_5\":{\"connections\":[{\"node\":\"883\",\"output\":\"input_1\"},{\"node\":\"263\",\"output\":\"input_1\"}]}},\"pos_x\":1241,\"pos_y\":132}}}}}');

				$funeel_array['old_question_id'] =  array(259,260,261,262,263,264,265,266);
				

				$funeel_array['old_answer_id']  =  array("861","862","863","864","865","866","867","868","869","870","871","872","873","874","875","876","877","878","879","880","881","882","883","884","885","886","887");
				
				
				
				$new_answers_ids_array = array();
				$new_questions_ids_array = array();
				if(isset($question_details) && isset($question_details['new_questions_ids_array'])){
					$new_questions_ids_array = $question_details['new_questions_ids_array'];
					$funeel_array['new_question_id'] = $new_questions_ids_array;
				}
				if(isset($question_details) && isset($question_details['new_answers_ids_array'])){
					$new_answers_ids_array = $question_details['new_answers_ids_array'];
					$funeel_array['new_answer_id'] = $new_answers_ids_array;
				}


			$newFunnelData = sqbGetCloneFunnelData($funnel_details_array['data_export'], $funeel_array);
			$funnel_details_array['data_export'] = $newFunnelData;
			$funnel_output = sqbSaveFunnelQuizData($funnel_details_array);

			// set variable for funnel end
		 }
			
		}
}
	
	
