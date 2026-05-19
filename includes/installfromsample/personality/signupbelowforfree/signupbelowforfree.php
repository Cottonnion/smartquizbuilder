<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Signup Below for FREE!'; // urldecode 
		$quiz_details_array['quiz_desc'] = 'A Step-by-Step Course that will show you you can quickly setup this free, simple helpdesk on your membership or course website!'; // urldecode
		$quiz_details_array['quiz_type'] = 'personality';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'Y';
		$quiz_details_array['quiz_display'] = 'popup';
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
		$quiz_details_array['show_firstname_template'] = 'NULL';
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
		$quiz_details_array['sqb_quiz_max_attempts_limit'] = '10';
		$quiz_details_array['show_correct_ans'] = 'N';
		$quiz_details_array['template'] = 'template6';
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
		$quiz_details_array['quiz_slider_animation'] = 'N';
		$quiz_details_array['quiz_slider_animation_option'] = '';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = 'different_page';
		$quiz_details_array['transparent_background_settings'] = 'px|1027|px|48|none|undefined|#bb7ed9|0.6|0% 0%|#ffeded|max-width: 921px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.8); cursor: grabbing; background-position-y: -3px;';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; // urldecode 
		//$quiz_details_array['quiz_timmer_array']['timer_customizer'] = 'N||00||00||00||show_last_screen||question';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_expired_msg'] = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';   // urldecode 
		$quiz_details_array['enable_background_image'] = 'N';
		$quiz_details_array['show_correct_ans_option'] = '';
		
		
		$quiz_details_array['pre_built'] = 'Y';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);
	// set variable for quiz table end 	
	
	
	
	
	
	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
	 	$start_temp_no = 'template1';
		//$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/sqb_bt_image1.jpg";				 
		$start_img_url = '';				 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 
		
		$start_temp_html = 	$cssfile.' <div class="Quiz-Start-Template2 Start-template-withbutton"><div class="Quiz-Template-content"><div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body done_screen show_cls" id="mce_26" contenteditable="false" style="position: relative; background-color: rgb(182, 93, 222); padding-top: 27px; padding-bottom: 27px; width: 570px; cursor: grab;" spellcheck="false"><div style="cursor: grab;" data-mce-style="cursor: grab;"><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;">FREE Course: Get INSTANT ACCESS &gt;&gt;&gt;</span></div></div></div></div><span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>';	 
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template" style="max-width: 921px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.8); cursor: grabbing; background-position-y: -3px;">
	<div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_10" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><div><span style="color: rgb(0, 0, 0); font-size: 19pt;" data-mce-style="color: #000000; font-size: 19pt;">Almost there...</span></div></div>
	<div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_11" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Where can we email you the results? Please enter details below.</span></div></div>
	<div class="Quiz-Template-content"> 	
		<form id="sqb_direct_signup" class="sqbform fields_reorder_enabled" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit="" _lpchecked="1">
			<input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%">
			<input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%">
			<input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%">
			<div class="form_cls ui-sortable">
				<input type="text" class="required ui-sortable-handle" name="first_name" id="first_name" value="" placeholder="Your Name" style="pointer-events: auto;">		 
				<input type="email" name="email" id="email" value="" placeholder="Your Email" class="ui-sortable-handle" style="pointer-events: auto;">
				<div class="sqb-checkbox termsConditionOuter ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox" style="pointer-events: auto;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_12" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_12" style="pointer-events: none;"><input type="hidden" name="mce_12" style="pointer-events: none;">
				</div>	

				<div class="sqb-gdpr-checkbox gdpr-Outer ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox" style="pointer-events: none;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_13" contenteditable="true" spellcheck="false" style="position: relative;">By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.</label><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;"><input type="hidden" name="mce_13" style="pointer-events: none;">
				</div>	

			</div>
			<div class="continue_btn sqb_tiny_mce_editor mce-content-body" id="mce_14" style="background-color: rgb(187, 126, 217); position: relative; padding-top: 23px; padding-bottom: 23px;" contenteditable="true" spellcheck="false"><div>Get Started &gt;&gt;&gt;</div></div><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14"><input type="hidden" name="mce_14">	
			<div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>You can unsubscribe at any time.</div></div><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15"><input type="hidden" name="mce_15">		
		</form>  					
	</div>		 
<div class="skip_optin sqb_tiny_mce_editor mce-content-body" style="display:none;text-align:right;" id="mce_27" contenteditable="true" spellcheck="false"><div>Skip Opt-in</div></div></div>'; 
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 921px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.8); cursor: grabbing; background-position-y: -3px;'; 
		$select_temp_class = 'Quiz-Template-6';
		$select_temp = 'template6';	
		$question_temp_html = '<div class="Quiz-Template '.$select_temp_class.'" data-id="" style="'.$question_template_style.'">%%QUESTIONANSWERS%%</div>';	
		$enable_branching  = 'N';	 
	
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
		
		// set variable for outcome table start
		$outcome_table_array = array();
		$oc_i = 0;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Thank you for Signing up! ';
		
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 921px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.8); cursor: grabbing; background-position-y: -3px;"><div class="points_scored_result sqb_tiny_mce_editor mce-content-body" id="mce_11" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 24pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 24pt; color: #000000;"><span style="font-size: 30pt;" data-mce-style="font-size: 30pt;"><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg" alt="🎉" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg"> Welcome to the Lab!</span></span></div></div><span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none; height: 275px;">
			<img class="21_09_18_05_09_3723 sqb_img_draggable ui-draggable ui-draggable-handle" src="https://memberdemo.com/contentblog/wp-content/plugins/smartquizbuilder/includes/images/outcome2.jpg" style="position: relative; height: 275px;">
			<span data-class="21_09_18_05_09_3723" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span>
		</div>
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
		</div>
		<div class="Quiz-Template-content">
			<span class="sqbHideOutcomeDescriptionOuter" style=""><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display: none;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid" style="">
				<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span-->
				<div class="sqb_tiny_mce_editor mce-content-body" id="mce_12" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="font-size: 14pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 14pt; color: #000000;">Congrats! You\'re in! <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg" alt="🎉" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg"><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/270c.svg" alt="✌️" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/270c.svg"></span></div><div><br></div><div><span style="font-size: 14pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 14pt; color: #000000;">You\'ll soon receive an email with your login credentials. Please use the details in the email to login and access this course.</span></div><div><br></div><div><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">The lessons are short, concise and won\'t take more than 5-7 minutes to consume.&nbsp;</span></span></div><div><br></div><div><span style="font-size: 14pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 14pt; color: #000000;">Please join my Facebook Group here and let me know your thoughts about this course!&nbsp;</span></div><div><br></div><div><span style="font-size: 14pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 14pt; color: #000000;">Enjoy the course <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f607.svg" alt="😇" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f607.svg"></span></div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
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
			$outcome_has = true;
		}
		
		// set variable for question bank table start
		
		$question_bank_array = array();
		$qb_i = 0;
		
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_15"><div><span style="color: rgb(0, 0, 0); font-size: 22pt;" data-mce-style="color: #000000; font-size: 22pt;"><strong>How did you hear about us?</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1632010426232_4815" style="display: none;">
						<span data-class="sbq_img_2021_8_1632010426232_4815" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
						</div>
						<div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none">
							<input type="hidden" class="question_video_url" value="">
							<input type="hidden" class="question_show_video" value="N">
							<input type="hidden" class="question_video_link_type" value="0">
							<input type="hidden" class="question_video_link_type_text" value="Source">
							<input type="hidden" class="question_video_aspect" value="1">
							<a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a>
							<div class="video-add-link questionTemplateInsertVideoOuter" style="display:none">
								<a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
							</div>
							<div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none">
								<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							</div>
							<div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none">
								<video width="400" controls="">
								</video>
							</div>
						</div>
						<span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_16"><div>Enter any additional information about the quiz.</div></div>
                       </div>';
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'How did you hear about us?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '1';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '921px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 0 index question start
		    
		    
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array = array(); 	
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img  ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_19"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Google</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Google.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Recommended by Someone</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'Recommended by Someone';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Email</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Email';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">YouTube</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'YouTube';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Facebook</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Facebook';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 5;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Other</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input custom_other_box" checked><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style=""><textarea class="please-elaborate" name="elaborate-text" placeholder="How did you hear about us"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Other';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '5';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			// set answer for zero index question end
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
			
		$qb_i = 1;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"><div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_15"><div><span style="color: rgb(0, 0, 0); font-size: 22pt;" data-mce-style="color: #000000; font-size: 22pt;"><strong>What\'s your Single Biggest Challenge?</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1632010426232_4815" style="display: none;">
						<span data-class="sbq_img_2021_8_1632010426232_4815" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
						</div>
						<div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none">
							<input type="hidden" class="question_video_url" value="">
							<input type="hidden" class="question_show_video" value="N">
							<input type="hidden" class="question_video_link_type" value="0">
							<input type="hidden" class="question_video_link_type_text" value="Source">
							<input type="hidden" class="question_video_aspect" value="1">
							<a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a>
							<div class="video-add-link questionTemplateInsertVideoOuter" style="display:none">
								<a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
							</div>
							<div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none">
								<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							</div>
							<div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none">
								<video width="400" controls="">
								</video>
							</div>
						</div>
						<span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_16"><div>Enter any additional information about the quiz.</div></div>
                       </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'What\'s your Single Biggest Challenge?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '2';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '921px';
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
			
			//$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">At this time, I\'m focused on building my list and don\'t want to spend too much time helping people with implementation. That\'s for my paid courses.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Generating Traffic to my Site</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'Generating Traffic to my Site';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Building my Audience</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Building my Audience';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Converting Leads into Customers</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Converting Leads into Customers';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Tech Overwhelm - find it hard to setup / manage different tools for my business</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Tech Overwhelm - find it hard to setup / manage different tools for my business';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; color: rgb(182, 93, 222);" spellcheck="false" id="mce_20"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><div style="position: relative; color: rgb(0, 0, 0);" data-mce-style="position: relative; color: #212529;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Other</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input custom_other_box" checked><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style=""><textarea class="please-elaborate" name="elaborate-text" placeholder="Your Biggest Challenge..."></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Other';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
		// set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 2;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><div><span style="color: rgb(0, 0, 0); font-size: 22pt;" data-mce-style="color: #000000; font-size: 22pt;"><strong>Is there anything specific you would love our help with?</strong></span></div></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627240479560_4707" style="display: none;"><span data-class="sbq_img_2021_6_1627240479560_4707" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style=" display: none;"><div>Enter any additional information about the quiz</div></div></div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Is there anything specific you would love our help with?';
		$question_bank_array[$qb_i]['question_type'] = 'text';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '3';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '921px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
		$answer_table_array = array(); 	
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(255, 237, 237);"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="Enter the text here"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;
		
		/*if($outcome_has){
			$coutcome_selected_ids = array();
			if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
				$coutcome_selected_ids[] = $outcome_output['ids'][1];
			}
			
			$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
			$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
			$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
			$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
			$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
		}*/

		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		// set variable for question bank table end 
		$quiz_details_question =  array();
		$quiz_details_question['quiz_id'] =  $quiz_details['quiz_id'];
		$quiz_details_question['id'] =  $quiz_details['quiz_id'];
		
		$quiz_details_question['questions_data'] =  $question_bank_array;
		$quiz_details_question['actionType'] = 'save_ques';
		$question_details = SQBSaveQuizAjax($quiz_details_question);
		
	// set variable for answer bank table start
	// set variable for answer bank table end 	
	}
}
