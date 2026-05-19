<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Online Course Revenue Calculator'; // urldecode 
		$quiz_details_array['quiz_desc'] = 'Answer a few questions and we\'ll let you know how much much revenueyou could make from your online course or digital product.'; // urldecode
		$quiz_details_array['quiz_type'] = 'calculator';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'N';
		$quiz_details_array['quiz_display'] = 'inpage';
		$quiz_details_array['quiz_blocking'] = 'N';
		$quiz_details_array['quiz_passmark'] = '0';
		$quiz_details_array['sqb_quiz_many_attempts'] = 'Unlimited';
		$quiz_details_array['quiz_pagination'] = 'one_per_page';
		$quiz_details_array['question_per_page'] = '1';
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
		$quiz_details_array['enable_branching'] = 'N';
		$quiz_details_array['show_next_button'] = 'N';
		$quiz_details_array['already_take_the_quiz'] = 'start_screen';
		$quiz_details_array['sqb_quiz_max_attempts_limit'] = '10';///
		$quiz_details_array['show_correct_ans'] = 'N';
		$quiz_details_array['template'] = 'template1';
		$quiz_details_array['startshowHide_video'] = 'N';///
		$quiz_details_array['video_url'] = '';
		$quiz_details_array['pass_criteria'] = '';
		$quiz_details_array['status'] = '';
		$quiz_details_array['sqb_insert_quiz'] = '';
		$quiz_details_array['sqb_quiz_allow_retake'] = 'N';//
		$quiz_details_array['quiz_display_url'] = '';
		$quiz_details_array['quiz_display_in_url'] = 'N';
		$quiz_details_array['quiz_time_delay'] = '0';
		$quiz_details_array['quiz_popup_frequency'] = 'always';
		$quiz_details_array['quiz_popup_position'] = '';
		$quiz_details_array['quick_email_verification'] = 'N';
		$quiz_details_array['quiz_slider_animation'] = 'Y';
		$quiz_details_array['quiz_slider_animation_option'] = 'rl';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = '';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '   <div class="sqb_tiny_mce_editor  mce-content-body" id="mce_4" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>||||<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong>Time Spent: %%TIMESPENT%%</strong></span></div></div>||||<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_0" contenteditable="true" spellcheck="false" style="position: relative;"><div>HRS</div></div>||||<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_2" contenteditable="true" spellcheck="false" style="position: relative;"><div>MIN</div></div>||||<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_3" contenteditable="true" spellcheck="false" style="position: relative;"><div>SEC</div></div>'; // urldecode 
		$quiz_details_array['quiz_timmer_array']['timer_customizer'] = 'N||00||00||00||show_last_screen||question';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_expired_msg'] = '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';   // urldecode 
		$quiz_details_array['enable_background_image'] = 'N';
		$quiz_details_array['show_correct_ans_option'] = '';
		
		
		$quiz_details_array['pre_built'] = 'Y';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);
	// set variable for quiz table end 	

	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
	 	$start_temp_no = 'template2';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/c1/calculator-428294_640.jpg";				 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 	 
		
		$start_temp_html = 	$cssfile.' <div class="Quiz-Template2 start_temp_outer quiz_comon_template" style="max-width: 750px; background-color: rgb(255, 255, 255); border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px;"><h3 class="Quiz-Template-title sqb_tiny_mce_editor mce-content-body" id="mce_7" contenteditable="true" spellcheck="false" style="position: relative;">Online Course Revenue Calculator</h3><span class="sqbHideStartTemplateImageOuter"><button class="sqbHideStartTemplateImage">Hide Image</button></span><span class="sqbShowStartTemplateImageOuter" style="display:none"><button class="sqbShowStartTemplateImage">Show Image</button></span><div class="question_img_div ui-resizable" id="start_img_temp2"><img class="start_img sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$start_img_url.'" style="position: relative;"><span data-class="start_img" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><div class="video-element-outer startTemplateVideoOuter ui-resizable" style="display:none"><a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a><div class="video-add-link startTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="startTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><div class="Quiz-Template-content"><div class="sqb_tiny_mce_editor sqb_content mce-content-body" id="mce_8" contenteditable="true" spellcheck="false" style="position: relative;"><div style="text-align: center;" data-mce-style="text-align: center;">Answer a few questions and we\'ll let you know how much much revenueyou could make from your online course or digital product.</div></div><div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" id="mce_9" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgb(255, 99, 77);"><div>Estimate your Online Course Revenue &gt;&gt;&gt;</div></div></div></div>';
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template" style="max-width: 750px; background-color: rgb(0, 0, 0);"><div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_10" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Almost there...</span></div></div><div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_11" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Where can we email you the results? Please enter details below.</span></div></div><div class="Quiz-Template-content"><form id="sqb_direct_signup" class="sqbform" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit=""><input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%"><input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%"><input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%"><div class="form_cls"><input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name"><input type="email" name="email" id="email" value="" placeholder="Your Email"><div class="sqb-checkbox termsConditionOuter" style="display:none"><span class="checkbox-custom-style"><input class="custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox"><span class="custom--checkbox"></span></span><label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_12" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_12"><input type="hidden" name="mce_12"><input type="hidden" name="mce_12" value="By joining, you agree to the terms of service and privacy policy."><input type="hidden" name="mce_12"></div><div class="sqb-gdpr-checkbox gdpr-Outer" style="display:none"><span class="checkbox-custom-style"><input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox"><span class="custom--checkbox"></span></span><label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_13" contenteditable="true" spellcheck="false" style="position: relative;">By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.</label><input type="hidden" name="mce_13"><input type="hidden" name="mce_13"><input type="hidden" name="mce_13" value="By checking this box, I agree I want to receive latest news, tips and occasional promotional offers."><input type="hidden" name="mce_13"></div></div><div class="continue_btn sqb_tiny_mce_editor mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgb(10, 226, 0);"><div>Your Revenue Estimate is HERE &gt;&gt;&gt;</div></div><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14" value="<div>Get Started</div>"><input type="hidden" name="mce_14"><div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div style="text-align: center;" data-mce-style="text-align: center;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">You can unsubscribe at any time.</span></div></div><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15" value="<div>You can unsubscribe at any time.</div>"><input type="hidden" name="mce_15"></form></div></div>';
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'border-color: rgb(255, 255, 255); border-width_rename: 3px; box-shadow: rgb(218, 218, 218) 0px 0px 10px 0px; max-width: 793px; background-color: rgb(255, 255, 255);'; 
		$select_temp_class = '';
		$select_temp = 'template1';	
		$question_temp_html = '<div class="Quiz-Template '.$select_temp_class.'" data-id="" style="'.$question_template_style.'">%%QUESTIONANSWERS%%</div>';	
		$enable_branching  = 'Y';///	 
	
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
	
	if(isset($_GET['sqb_theme_built_install_call']) && $_GET['sqb_theme_built_install_call']){
		
	
	
	$quiz_details = SQBSaveQuizAjax($quiz_details_array);
	
	if(is_array($quiz_details) && isset($quiz_details['quiz_id'])){
		
		// set variable for formula table start
		$formula_table_array = array();
		$oc_i = 0;
		$formula_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$formula_table_array[$oc_i]['formula_name'] = 'FORMULA';
		$formula_table_array[$oc_i]['formula_html'] = 'Q1*Q2';
		$formula_table_array[$oc_i]['formula_customizer'] = '{"prefix":"","sufix":""}';
		$formula_table_array[$oc_i]['formula_id'] = '';
		$formula_table_array[$oc_i]['date'] = $current_data_time;
		
		$oc_i = 1;
		$formula_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$formula_table_array[$oc_i]['formula_name'] = 'FORMULA';
		$formula_table_array[$oc_i]['formula_html'] = 'Q1*Q2*12';
		$formula_table_array[$oc_i]['formula_customizer'] = '{"prefix":"","sufix":""}';
		$formula_table_array[$oc_i]['formula_id'] = '';
		$formula_table_array[$oc_i]['date'] = $current_data_time;
		
		$oc_i = 2;
		$formula_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$formula_table_array[$oc_i]['formula_name'] = 'FORMULA';
		$formula_table_array[$oc_i]['formula_html'] = 'Q1*Q2*24';
		$formula_table_array[$oc_i]['formula_customizer'] = '{"prefix":"","sufix":""}';
		$formula_table_array[$oc_i]['formula_id'] = '';
		$formula_table_array[$oc_i]['date'] = $current_data_time;
		
		$oc_i = 3;
		$formula_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$formula_table_array[$oc_i]['formula_name'] = 'FORMULA';
		$formula_table_array[$oc_i]['formula_html'] = 'Q1*Q2*36';
		$formula_table_array[$oc_i]['formula_customizer'] = '{"prefix":"","sufix":""}';
		$formula_table_array[$oc_i]['formula_id'] = '';
		$formula_table_array[$oc_i]['date'] = $current_data_time;
		
		// set variable for outcome table end
		$formula_data_array = array();
		$formula_data_array['formula_data'] = $formula_table_array;
		$formula_output =  SqbSaveFormula($formula_data_array);
		
		
		$formula_has = false;
		if(isset($formula_output['ids']) and count($formula_output['ids'])){
			$formula_has = true;
		}
		// set variable for formula table end 	
		
		
		// set variable for outcome table start
		$outcome_table_array = array();
		$oc_i = 0;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Revenue Estimate';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 750px; border-width: 1px; text-align: left; border-style: solid;"><div class="points_scored_result sqb_tiny_mce_editor mce-content-body" id="mce_43" contenteditable="true" style="position: relative;" spellcheck="false"><div>Revenue Estimate!&nbsp;</div></div><span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 275px; display: none;"><img class="21_08_25_01_08_05350 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'installfromsample/c1/outcome2.jpg" style="position: relative; height: 275px;"><span data-class="21_08_25_01_08_05350" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor mce-content-body" id="mce_44" contenteditable="true" style="position: relative;" spellcheck="false"><div><h5 class="aligncenter"><span style="text-decoration: underline;" data-mce-style="text-decoration: underline;"><span style="font-size: 14pt; color: rgb(51, 102, 255); text-decoration: underline;" data-mce-style="font-size: 14pt; color: #3366ff; text-decoration: underline;">Revenue estimate based on the numbers you entered</span></span></h5></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong><label class="gfield_label" for="input_12_3">Your Sales Revenue</label></strong></span></div><div class="ginput_container ginput_container_calculations">[FORMULA id='.$formula_output['formula_id'][0].']</div><div class="ginput_container ginput_container_calculations"><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong><label class="gfield_label" for="input_12_8">Sales Revenue After 1 Year</label></strong></span></div><div class="ginput_container ginput_container_calculations">[FORMULA id='.$formula_output['formula_id'][1].']</div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong><label class="gfield_label" for="input_12_9">Sales Revenue After 2 Years</label></strong></span></div><div class="ginput_container ginput_container_calculations">[FORMULA id='.$formula_output['formula_id'][2].']</div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong><label class="gfield_label" for="input_12_11">Sales Revenue After 3 Years</label></strong></span></div><div class="ginput_container ginput_container_calculations">[FORMULA id='.$formula_output['formula_id'][3].']</div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '';///
		$outcome_table_array[$oc_i]['range_val1'] = '';//
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		// set variable for outcome table end
		$outcome_data_array = array();
		$outcome_data_array['outcomes_data'] = $outcome_table_array;
		
		
		$outcome_output =  sqb_outcometemp($outcome_data_array);
		$outcome_has = false;
		if(isset($outcome_output['ids']) and count($outcome_output['ids'])){
			$outcome_has = true;
		}
		
		// set variable for question bank table start
		$question_bank_array = array();//862,863
		$qb_i = 0;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_35"><div><span style="color: rgb(51, 102, 255);" data-mce-style="color: #3366ff;"><strong><label class="gfield_label" for="input_12_1">Enter Number of Course Sales Per Month</label></strong></span></div></div><span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_7_1629920041071_1656" style="display: none;"><img class="sqb_img_draggable sbq_img_2021_7_1629920041071_1656 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"><span data-class="sbq_img_2021_7_1629920041071_1656" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style=""><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style="display: none;"><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_36"><div style="text-align: center;" data-mce-style="text-align: center;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">This calculator will estimate revenue</span><br><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">&nbsp;based on the numbers you enter here...</span></div></div></div>'; //urldecode
		
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Enter Number of Course Sales Per Month';
		$question_bank_array[$qb_i]['question_type'] = 'slider';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '0';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '793px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = 'N';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';//
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 0 index question start
		    
		    
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array = array(); 	
		
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item sqb_ans_item_slider" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><span class="answer_slider_options_show sqb_backend_show ">Click to customize</span> <div class="type-slider-outer"><input name="sqb_ans_'.$sqb_datetime_rand.'" id="sqb_ans_slider_'.$sqb_datetime_rand.'" class="slider sqb_ans_slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="1000" data-slider-step="1" data-slider-value="0" top_box_b_clr="#059e4b" suffix_text="" prefix_text="" complete_bar_b_clr="#263af0" slider_b_clr="#ffffff" style="display: none;" data-value="0" value="0"><div class="slider_label sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_39"><div class="slider_label_start" style="text-align: left;" data-mce-style="text-align: left;"><strong>0</strong></div><div class="slider_label_middle" style="text-align: center;" data-mce-style="text-align: center;"><strong>500</strong></div><div class="slider_label_end" style="text-align: right;" data-mce-style="text-align: right;"><strong>1000</strong></div></div></div><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;
		
		// set answer for zero index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
		$qb_i = 1;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_40"><div><span style="color: rgb(51, 102, 255);" data-mce-style="color: #3366ff;"><strong><label class="gfield_label" for="input_12_1">Enter your Course Price</label></strong></span></div></div><span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_7_1629920041071_1656" style="display: none;"><img class="sqb_img_draggable sbq_img_2021_7_1629920041071_1656 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"><span data-class="sbq_img_2021_7_1629920041071_1656" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style=""><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style="display: none;"><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_41"><div style="text-align: center;" data-mce-style="text-align: center;"><strong>How much do you plan on charging for the course?</strong></div></div></div>';//urldecode
		
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Enter your Course Price';
		$question_bank_array[$qb_i]['question_type'] = 'slider';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '1';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '793px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 1 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item sqb_ans_item_slider" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><span class="answer_slider_options_show sqb_backend_show">Click to customize</span><div class="type-slider-outer"><input name="sqb_ans_'.$sqb_datetime_rand.'" id="sqb_ans_slider_'.$sqb_datetime_rand.'" class="slider sqb_ans_slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="2000" data-slider-step="1" data-slider-value="0" top_box_b_clr="#059e4b" suffix_text="" prefix_text="$" complete_bar_b_clr="#263af0" slider_b_clr="#ffffff" style="display: none;" data-value="0" value="0"><div class="slider_label sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_42"><div class="slider_label_start" style="text-align: left;" data-mce-style="text-align: left;"><strong>0</strong></div><div class="slider_label_middle" style="text-align: center;" data-mce-style="text-align: center;"><strong>1000</strong></div><div class="slider_label_end" style="text-align: right;" data-mce-style="text-align: right;"><strong>2000</strong></div></div></div><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = '';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;

		//set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		//set variable for question bank table end 

		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_details['quiz_id'];
		$quiz_details_question['id'] =  $quiz_details['quiz_id'];
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		
		$question_details = SQBSaveQuizAjax($quiz_details_question);
	}
}
	
	
