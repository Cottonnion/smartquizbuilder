<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Content Marketing'; // urldecode 
		$quiz_details_array['quiz_desc'] = "Take this assessment to determine your content’s effectiveness."; // urldecode
		$quiz_details_array['quiz_type'] = 'scoring';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'Y';
		$quiz_details_array['quiz_display'] = 'inpage';
		$quiz_details_array['quiz_blocking'] = '';
		$quiz_details_array['quiz_passmark'] = '';
		$quiz_details_array['sqb_quiz_many_attempts'] = 'Unlimited';
		$quiz_details_array['quiz_pagination'] = 'one_per_page';
		$quiz_details_array['question_per_page'] = 'question_per_page';
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
		$quiz_details_array['quiz_timmer_array']['quiz_timer_limit'] = '';
		
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
		$quiz_details_array['show_firstname_template'] = '';
		$quiz_details_array['template_display_sequence'] = 'start_temp,quesans_temp,optin_temp,result_temp';
		$quiz_details_array['user_added_my_email_platform'] = 'add_user_in_wp';
		$quiz_details_array['add_user_in_your_email_platform'] = '';
		$quiz_details_array['outcome_type'] = 'range';
		$quiz_details_array['outcome_page'] = 'outcome_page';
		$quiz_details_array['display_score_on_page'] = 'yes';
		$quiz_details_array['display_correctans_on_page'] = 'no';
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
		$quiz_details_array['template'] = 'template8';
		$quiz_details_array['startshowHide_video'] = 'N';
		$quiz_details_array['video_url'] = '';
		$quiz_details_array['pass_criteria'] = '';
		$quiz_details_array['status'] = '';
		$quiz_details_array['sqb_insert_quiz'] = '';
		$quiz_details_array['sqb_quiz_allow_retake'] = 'N';
		$quiz_details_array['quiz_display_url'] = '';
		$quiz_details_array['quiz_display_in_url'] = '';
		$quiz_details_array['quiz_time_delay'] = '0';
		$quiz_details_array['quiz_popup_frequency'] = 'always';
		$quiz_details_array['quiz_popup_position'] = '';
		$quiz_details_array['quick_email_verification'] = 'N';
		$quiz_details_array['quiz_slider_animation'] = 'Y';
		$quiz_details_array['quiz_slider_animation_option'] = 'tb';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = '';
		$quiz_details_array['transparent_background_settings'] = 'px|1800|px|200|none|undefined|#9c9797|1|0% 0%|#fff7f0||0';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; // urldecode 
		//$quiz_details_array['quiz_timmer_array']['timer_customizer'] = 'N||00||00||00||show_last_screen||question';
		$quiz_details_array['quiz_timmer_array']['quiz_timer_expired_msg'] = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';   // urldecode 
		$quiz_details_array['enable_background_image'] = 'N';
		$quiz_details_array['show_correct_ans_option'] = '';
		
		
		
		$quiz_details_array['pre_built'] = 'Y';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);

		$quiz_details_array['customizer_style_setting'] = array(
		    'background_height' => '',
		    'background_width' => '',
		    'background_color' => '#000000',
		    'answer_border_width' => '5px',
		    'answer_border_style' => 'solid',
		    'answer_border_color' => '#00c1b7',
		    'answer_border_shadow_color' => '#00c1b7',
		    'skip_button_width' => '175px',
		    'skip_button_height' => '50px',
		    'skip_button_background_color' => '#00c1b7',
		    'continue_button_width' => '200px',
		    'continue_button_height' => '50px',
		    'continue_button_background_color' => '#00c1b7',
		    'background_inner_width' => '985px'
		);
	// set variable for quiz table end 	
	
	
	
	
	
	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/";
	 	$start_temp_no = 'template8';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/installfromsample/scoring/content-marketing/images/writer.png";				 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 

		$start_temp_html = $cssfile.'<div class="Quiz-Template2 start_temp_outer quiz_comon_template outer-style8" style="max-width: 985px; border-color: rgb(221, 221, 221); box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-position-y: -27px;">
	<div class="Quiz-Template-title sqb_tiny_mce_editor mce-content-body" id="mce_35" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><div style="cursor: grab; background-position-y: -1px;" data-mce-style="cursor: grab; background-position-y: -1px;"><span style="font-family: &quot;comic sans ms&quot;, sans-serif;" data-mce-style="font-family: \'comic sans ms\', sans-serif;">Content Marketing Assessment</span></div></div>	
	<span class="sqbHideStartTemplateImageOuter" style="display: inline-block;"><button class="sqbHideStartTemplateImage">Hide Image</button></span>
	<span class="sqbShowStartTemplateImageOuter" style="display: none;"><button class="sqbShowStartTemplateImage" style="cursor: grab; background-position-y: -1px;">Show Image</button></span>
	<div class="question_img_div ui-resizable" id="start_img_temp2" style="display: inline-block; background-position-y: -70px; cursor: grab; height: 178px;">	 
		<!--span class="sqb_backend_show sqb_remove_section" data-id="start_img_temp2" ><i class="fa fa-trash-o" aria-hidden="true"></i></span-->
		<img class="start_img sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$start_img_url.'" style="display: inline-block; width: 300px; height: 178px; position: relative; cursor: grab; background-position-y: -1px; left: 0px; top: -2px;">
		<span data-class="start_img" class="question_img_upload sbq_change_img" src="'.$start_img_url.'"><i class="fa fa-camera" aria-hidden="true" style="cursor: grab;"></i></span>
	</div>
	
	<div class="video-element-outer startTemplateVideoOuter ui-resizable" style="display:none">
		<a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a>
		<div class="video-add-link startTemplateInsertVideoOuter" style="display:none">
			<a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
		</div>
		<div class="startTemplateYoutubeVideoOuter" style="display:none">
			<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
		</div>
		<div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none">
			<video width="400" controls="">
			</video>
		</div>
	</div>
	<div class="Quiz-Template-content">
		<div class="sqb_tiny_mce_editor sqb_content mce-content-body" id="mce_36" contenteditable="true" spellcheck="false" style="position: relative;"><div><div style="text-align: left; cursor: grabbing;" data-mce-style="text-align: left;"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;"><span style="color: rgb(255, 255, 255); cursor: grab;" data-mce-style="color: #ffffff; cursor: grab;">Struggling to engage your audience and keep them longer on your site? It\'s time to identify h</span><span style="color: rgb(255, 255, 255); cursor: grab;" data-mce-style="color: #ffffff; cursor: grab;">ow much of your content gets your audience to engage and interact with your brand?</span></span></div><div style="cursor: grab; text-align: left;" data-mce-style="cursor: grab; text-align: left;"><br></div><div style="background-position-y: -1px; text-align: center;" data-mce-style="background-position-y: -1px; text-align: center;"><span style="color: rgb(255, 255, 255); font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; cursor: grabbing;" data-mce-style="color: #ffffff; font-size: 16pt; font-family: \'comic sans ms\', sans-serif; cursor: grabbing;">Take this assessment to determine your content’s effectiveness.&nbsp;</span></div></div></div>  
		<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" id="mce_37" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>		 								
	</div>	 
</div>
<span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template" style="display: inline;"><b>...</b></span>										<span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>';

		
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template outer-style8" style="max-width: 985px;">
	<div class="skip_optin sqb_tiny_mce_editor mce-content-body" style="display:none; text-align: right;" id="mce_16" contenteditable="true" spellcheck="false"><div>Skip Opt-in</div></div>
	<div class="lead-image-video-section">
		<!-- Show Image  -->
		<div class="lead_screen_img_div Quiz-Template-image ui-resizable" id="lead_screen_temp_id" style="display: none;">
			<img class="lead_screen_temp_img" src="'.home_url().'/select/wp-content/plugins/smartquizbuilder/includes/images/sqb-registration-img.jpg">
			<span data-class="lead_screen_temp_img" class="question_img_upload sbq_change_lead_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
		</div>
		<!-- Show Video -->
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
		</div>
	</div>


	<div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_17" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Awesome <img draggable="false" role="img" class="emoji" alt="👍" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f44d.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f44d.svg"> You\'ve completed this assessment!&nbsp;</span></div></div>
	<div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_18" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">Where can we email you the results? Please enter details below.</span></div></div>
	<div class="Quiz-Template-content"> 	
		<form id="sqb_direct_signup" class="sqbform fields_reorder_enabled" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit="">
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
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_19" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_19" style="pointer-events: none;">
				</div>	

				<div class="sqb-gdpr-checkbox gdpr-Outer ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox" style="pointer-events: none;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;">By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.</label><input type="hidden" name="mce_20" style="pointer-events: none;">
				</div>
			</div>
			<div class="continue_btn sqb_tiny_mce_editor mce-content-body" id="mce_21" style="background-color: rgb(0, 193, 183); position: relative; width: 447px; padding-top: 16px; padding-bottom: 16px;" contenteditable="true" spellcheck="false"><div>Content Effectiveness Results &gt;&gt;&gt;</div></div><input type="hidden" name="mce_21">	
			<div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_22" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">You can unsubscribe at any time.</span></div></div><input type="hidden" name="mce_22">		
		</form>  					
	</div>	 
</div>';
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 822px; background-color: rgb(255, 255, 255)'; 
		$select_temp_class = '';
		$select_temp = 'template8';	

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
	 	$quiz_details_array['template_no'] = 'template8';
	 	$quiz_details_array['common_style'] = '#f56640';
	// set variable for quiz template table end 	
	
	
		
	
		
	
	$quiz_details_array['actionType'] = 'save_quiz';
	$quiz_details_array['function_call_by'] = 'call_by_buil_theme';
	
	if(isset($_GET['sqb_theme_built_install_call']) && $_GET['sqb_theme_built_install_call']){
		
	
	
	$quiz_details = SQBSaveQuizAjax($quiz_details_array);
	
	if(is_array($quiz_details) && isset($quiz_details['quiz_id'])){
		
		// set variable for outcome table start
		$outcome_table_array = array();

		// Outcome 1
		$oc_i = 0;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Passive Content';

		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8 scoring-fields-visible" style="max-width: 985px; border-width: 1px; text-align: left;"> 
		<div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_367"><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div></div> 
		<span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: none;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: inline-block; width: 907px; height: 112px;">
			<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span-->
			
			<img class="22_04_10_01_04_3731 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/surprise.png" style="display: inline-block; width: 907px; height: 112px; position: relative;">
			<span data-class="22_04_10_01_04_3731" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/surprise.png"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
			<span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid">
				<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_368"><div style="text-align: center;" data-mce-style="text-align: center;"><span style="color: rgb(255, 255, 255); font-size: 16pt;" data-mce-style="color: #ffffff; font-size: 16pt;">Whoa <img draggable="false" role="img" class="emoji" alt="🤔" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg"> &nbsp;You\'ve got a lot of work to do!</span></div><div style="text-align: center;" data-mce-style="text-align: center;"><br></div><div style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Taking this assessment and answering the questions honestly is a great first step! Now it\'s time to step it up when it comes to creating the right type of content!</span></div><div style="text-align: left;" data-mce-style="text-align: left;"><br></div><div style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">No more content for content\'s sake. Ok?</span></div><div style="text-align: left;" data-mce-style="text-align: left;"><br></div><div style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Interactive content is almost twice as effective as static content at converting visitors so do not waste one more minute on more static content. Take a look at all of your existing content and figure out ways to take what you have and make it fun and interactive via quizzes, surveys, polls, calculators, infographics, etc.!<br><br></span></div><div style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Need inspiration? This assessment quiz that you just took is a great example of fun, interactive content that will help you get your audience engaged! So create fun tests that helps your audience discover a little bit more about themselves. Signup for <a data-mce-href="https://smartquizbuilder.com/" href="https://smartquizbuilder.com/">Smart Quiz Builder﻿</a> below to get started!</span></div></div><br>
			</div>
			<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid">
				<div class="d-inline-block pos_relative">
					<span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span>
					<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 786px; padding-top: 25px; padding-bottom: 25px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_369" data-continueurl="https://smartquizbuilder.com/"><div><span style="font-size: 16pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 16pt; color: #ffffff;">Get Started with Smart Quiz Builder to Create Quizzes Like This &gt;&gt;&gt;</span></div></div>
				</div>				
			</div>	 
		</div>	 
	</div>';

	
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '-100';
		$outcome_table_array[$oc_i]['range_val1'] = '12';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-100-12';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		// Outcome 2
		$oc_i = 1;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Mostly Passive';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8 scoring-fields-visible" style="max-width: 985px; border-width: 1px; text-align: left;"> 
		<div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_370"><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div></div> 
		<span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none;">
			<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span-->
			
			<img class="22_04_10_02_04_06899 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'/images/outcome2.jpg" style="position: relative;">
			<span data-class="22_04_10_02_04_06899" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span>
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
			<span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid">
				<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_371"><p style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Your content is mostly passive—but you are still ahead of your marketing peers. Per Content Marketing Institute’s Interactive Content Research Study, the percentage of marketers using interactive content is still pretty low (less than 50%).</span></p><p style="text-align: left;" data-mce-style="text-align: left;"><br></p><p style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">You\'ve an incredible opportunity to get your content performing at a higher level.&nbsp; </span></p><p style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Interactive content is almost twice as effective as static content at converting visitors so do not waste one more minute on more static content. Take a look at all of your existing content and figure out ways to take what you have and make it fun and interactive via quizzes, surveys, polls, calculators, infographics, etc.!<br><br></span></p><div style="text-align: left;" data-mce-style="text-align: left;"><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">Need inspiration? This assessment quiz that you just took is a great example of fun, interactive content that will help you get your audience engaged! So create fun tests that helps your audience discover a little bit more about themselves. Signup for <a href="https://smartquizbuilder.com/" data-mce-href="https://smartquizbuilder.com/">Smart Quiz Builder</a> below to get started!</span></div></div><br>
			</div>
			<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid">
				<div class="d-inline-block pos_relative">
					<span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span>
					<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 786px; padding-top: 25px; padding-bottom: 25px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_372" data-continueurl="https://smartquizbuilder.com/"><div><span style="font-size: 16pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 16pt; color: #ffffff;">Get Started with Smart Quiz Builder to Create Quizzes Like This &gt;&gt;&gt;</span></div></div>
				</div>				
			</div>	 
		</div>	 
	</div>';
		
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '12';
		$outcome_table_array[$oc_i]['range_val1'] = '24';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '12-24';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		// Outcome 3
		$oc_i = 2;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Somewhat Interactive';
		$outcome_table_array[$oc_i]['outcome_html'] = '';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8 scoring-fields-visible" style="max-width: 985px; border-width: 1px; text-align: left;"> 
		<div class="points_scored_result sqb_tiny_mce_editor    mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_373"><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div></div> 
		<span class="sqbHideTemplateImageOuter" style="display: inline-block;"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: none;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: inline-block; height: 100px; width: 715px;">
			<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span-->
			
			<img class="22_04_10_02_04_21362 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/thumbs-up.png" style="display: inline-block; height: 100px; width: 715px; position: relative;">
			<span data-class="22_04_10_02_04_21362" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/thumbs-up.png"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
			<span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid">
				<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_374"><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">You’re doing great! But there is room for improvement! There\'s a lot more to content performance than opens, page views and downloads. </span></div><div><br></div><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">With interactive content you can measure consumption,&nbsp; engagement, interaction and outcomes. You can know and understand your visitor challenges, pains, needs, motiviations and much more.&nbsp; You can use this data to create content that better serves them and solves their specific problems!</span></div><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;"><br data-mce-bogus="1"></span></span></div><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">This assessment quiz that you just took is a great example of fun, interactive content that will help you get your audience engaged! So create fun tests that helps your audience discover a little bit more about themselves. Signup for <span style="text-decoration: underline;" data-mce-style="text-decoration: underline;"><a href="https://smartquizbuilder.com/" data-mce-href="https://smartquizbuilder.com/">Smart Quiz Builder</a></span> below to get started!</span></span></div></div><br>
			</div>
			<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid" style="">
				<div class="d-inline-block pos_relative">
					<span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span>
					<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 786px; padding-top: 25px; padding-bottom: 25px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_375" data-continueurl="https://smartquizbuilder.com/"><div><span style="font-size: 16pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 16pt; color: #ffffff;">Get Started with Smart Quiz Builder to Create Quizzes Like This &gt;&gt;&gt;</span></div></div>
				</div>				
			</div>	 
		</div>	 
	</div>';

	
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '24';
		$outcome_table_array[$oc_i]['range_val1'] = '36';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '24-36';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		// Outcome 4
		$oc_i = 3;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Interactive';

		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8 scoring-fields-visible" style="max-width: 985px; border-width: 1px; text-align: left;"> 
		<div class="points_scored_result sqb_tiny_mce_editor    mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_376"><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div></div> 
		<span class="sqbHideTemplateImageOuter" style="display: inline-block;"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: none;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: inline-block; height: 241px; width: 657px;">
			<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span-->
			
			<img class="22_04_10_02_04_21362 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/brain.png" style="display: inline-block; height: 241px; width: 657px; position: relative;">
			<span data-class="22_04_10_02_04_21362" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/brain.png"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
			<span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span>
			<span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span>
			<div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid">
				<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_377"><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;"><img draggable="false" role="img" class="emoji" alt="🎉" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg"> Whoa! </span><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;"><img draggable="false" role="img" class="emoji" alt="🎉" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f389.svg"> Time to celebrate!&nbsp;</span></span></div><div><br></div><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">You are doing great! Maybe you could teach me and others on </span></span></div><div><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">how you are doing this by creating a quiz using Smart Quiz Builder <img draggable="false" role="img" class="emoji" alt="😊" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f60a.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f60a.svg">!</span></span></div><div><p><br></p><p><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;">You are indeed among the few who really \'get it\' when it comes to the interactive content experience. Content Marketing Institute’s 2017 Interactive Content Research Study puts the percentage of marketers using interactive content at 46%! Keep up the good work and continue to scale your static content into useful and engaging interactive content experiences! </span></p><p><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;"><br data-mce-bogus="1"></span></span></p><p><span style="color: rgb(255, 255, 255); font-size: 15pt;" data-mce-style="color: #ffffff; font-size: 15pt;"><span style="color: rgb(255, 255, 255);" data-mce-style="color: #ffffff;">This assessment quiz that you just took is a great example of fun, interactive content that will help you get your audience engaged! So create fun tests that helps your audience discover a little bit more about themselves. Signup for <span style="text-decoration: underline;" data-mce-style="text-decoration: underline;"><a href="https://smartquizbuilder.com/" data-mce-href="https://smartquizbuilder.com/" data-mce-selected="inline-boundary">Smart Quiz Builder</a></span> below to get started!</span></span></p></div></div><br>
			</div>
			<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid">
				<div class="d-inline-block pos_relative">
					<span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span>
					<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 786px; padding-top: 25px; padding-bottom: 25px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_378" data-continueurl="https://smartquizbuilder.com/"><div><span style="font-size: 16pt; color: rgb(255, 255, 255);" data-mce-style="font-size: 16pt; color: #ffffff;">Get Started with Smart Quiz Builder to Create Quizzes Like This &gt;&gt;&gt;</span></div></div>
				</div>				
			</div>	 
		</div>	 
	</div>';


		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '36';
		$outcome_table_array[$oc_i]['range_val1'] = '100';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '36-100';
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
		
		$question_bank_array = array();
		$qb_i = 0;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_120" contenteditable="true" spellcheck="false"><div><strong>Your thoughts on these content marketing statements</strong></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'/images/sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1649623121192_5661" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1649623121192_5661 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'/images/sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1649623121192_5661" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbShowQuesDescriptionOuter" style="display: inline;"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_121" contenteditable="true" spellcheck="false" style="position: relative; display: none;"><div>Enter any additional information about the quiz.</div></div>
                       </div>';

		//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Your thoughts on these content marketing statements';
		$question_bank_array[$qb_i]['question_type'] = 'matrix';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '4';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1800px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['question_skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['date'] = $current_data_time;

		// Matrix
		$question_bank_array[$qb_i]['matrix_column_width'] = '60';
		$question_bank_array[$qb_i]['matrix_labels_text'] = array(

			array(
				'index' => 0,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_50"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body sqb_disable_tiny_mce_editor" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor">Disagree</div></div></div></div>')
			),
			array(
				'index' => 1,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_54"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor"><br></div></div></div></div>')
			),
			array(
				'index' => 2,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_58"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor">Neutral</div></div></div></div>')
			),
			array(
				'index' => 3,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_62"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor"><br></div></div></div></div>')
			),
			array(
				'index' => 4,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_66"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body sqb_disable_tiny_mce_editor" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor">Agree</div></div></div></div>')
			),

		);

		$question_bank_array[$qb_i]['matrix_html'] = '	<table class="SQB-main-table show_value_matrix_box">
					<thead>
					  <tr>
						<th class="SQB-fixed-side" scope="col">&nbsp;</th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_50"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body sqb_disable_tiny_mce_editor" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor">Disagree</div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_54"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor"><br></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_58"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor">Neutral</div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_62"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor"><br></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_66"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor mce-content-body sqb_disable_tiny_mce_editor" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor">Agree</div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						
						<th scope="col"></th>
						
					  </tr>
					</thead>
					<tbody>
					  	<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="2022_04_10_01_05_45_853_640">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_70"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">I have the time to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_853_640"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  

					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="2022_04_10_01_05_45_740_343">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_71"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I can quickly bring interactive content to market.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_740_343"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>

					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="2022_04_10_01_05_45_586_491">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_72"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I know how to make my content interactive.&nbsp;</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_586_491"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="2022_04_10_01_05_45_901_924">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_73"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">I have the resources to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_901_924"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  

					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="2022_04_10_01_05_45_620_270">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_74"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I have budget to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_620_270"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  
					</tbody>
				  </table>

';

		// set answer for 0 index question start
		    
		    $answer_table_array = array();


		    $at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;

			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_70"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">I have the time to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);\" data-mce-style=\"font-family: \'comic sans ms\', sans-serif; font-size: 16pt;\">I have the time to create interactive content.</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 1),
				array('index' => 1, 'answer_value' => 2),
				array('index' => 2, 'answer_value' => 3),
				array('index' => 3, 'answer_value' => 4),
				array('index' => 4, 'answer_value' => 5),
			);

			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;


			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_71"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I can quickly bring interactive content to market.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';


			
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">I can quickly bring interactive content to market.</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 1),
				array('index' => 1, 'answer_value' => 2),
				array('index' => 2, 'answer_value' => 3),
				array('index' => 3, 'answer_value' => 4),
				array('index' => 4, 'answer_value' => 5),
			);
			//$answer_table_array[$at_i]['matrix_values'] = '0|1,1|2,2|3,3|4,4|5';
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;



			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_72"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I know how to make my content interactive.&nbsp;</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">I know how to make my content interactive.&nbsp;</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 1),
				array('index' => 1, 'answer_value' => 2),
				array('index' => 2, 'answer_value' => 3),
				array('index' => 3, 'answer_value' => 4),
				array('index' => 4, 'answer_value' => 5),
			);

			
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;



			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_73"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">I have the resources to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);\" data-mce-style=\"font-family: \'comic sans ms\', sans-serif; font-size: 16pt;\">I have the resources to create interactive content.</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 1),
				array('index' => 1, 'answer_value' => 2),
				array('index' => 2, 'answer_value' => 3),
				array('index' => 3, 'answer_value' => 4),
				array('index' => 4, 'answer_value' => 5),
			);

			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 60%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_74"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">I have budget to create interactive content.</span></h4></div></th>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="5" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">I have budget to create interactive content.</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 1),
				array('index' => 1, 'answer_value' => 2),
				array('index' => 2, 'answer_value' => 3),
				array('index' => 3, 'answer_value' => 4),
				array('index' => 4, 'answer_value' => 5),
			);

			

			// set answer for zero index question end
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
			
		$qb_i = 1;

		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_49" contenteditable="true" spellcheck="false"><h1>How effective is your content at each of the following?</h1></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1649621562059_2169" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1649621562059_2169 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1649621562059_2169" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbShowQuesDescriptionOuter" style="display: inline;"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_50" contenteditable="true" spellcheck="false" style="position: relative; display: none;"><div>Enter any additional information about the quiz.</div></div>
                       </div>';
		//urldecode


		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'How effective is your content at each of the following?';
		$question_bank_array[$qb_i]['question_type'] = 'matrix';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '2';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1800px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['question_skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;

		$question_bank_array[$qb_i]['matrix_labels_text'] = array(
			array(
				'index' => 0,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_565"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_588"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_8"><div class="sqb_tiny_mce_editor" id="mce_9"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Very Effective</span></div></div></div></div>')
			),
			array(
				'index' => 1,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_569"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_591"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_10"><div class="sqb_tiny_mce_editor" id="mce_11"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Somewhat Effective</span></div></div></div></div>')
			),
			array(
				'index' => 2,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_573"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_594"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_12"><div class="sqb_tiny_mce_editor" id="mce_13"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Slightly Effective</span></div></div></div></div>')
			),
			array(
				'index' => 3,
				'matrix_label_text' => urlencode('<div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_577"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_597"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_14"><div class="sqb_tiny_mce_editor" id="mce_15"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Not Effective</span></div></div></div></div>')
			),

		);
	
		$question_bank_array[$qb_i]['matrix_html'] = '	<table class="SQB-main-table show_value_matrix_box">
					<thead>
					  <tr>
						<th class="SQB-fixed-side" scope="col">&nbsp;</th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_565"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_588"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_8"><div class="sqb_tiny_mce_editor" id="mce_9"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Very Effective</span></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_569"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_591"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_10"><div class="sqb_tiny_mce_editor" id="mce_11"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Somewhat Effective</span></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_573"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_594"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_12"><div class="sqb_tiny_mce_editor" id="mce_13"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Slightly Effective</span></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_577"><div class="sqb_tiny_mce_editor sqb_disable_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_597"><div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" data-mce-style="position: relative;" id="mce_14"><div class="sqb_tiny_mce_editor" id="mce_15"><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 13pt;" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 13pt;">Not Effective</span></div></div></div></div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						
						<th scope="col"></th>
						
					  </tr>
					</thead>
					<tbody>
					  					  <tr class="sqb_ans_item" data-id="9170" id="2022_04_10_01_05_45_853_640">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_581"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">Educating your buyer</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_853_640"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  					  <tr class="sqb_ans_item" data-id="9171" id="2022_04_10_01_05_45_740_343">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_582"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Differentiating from your competitors</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_740_343"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  					  <tr class="sqb_ans_item" data-id="9172" id="2022_04_10_01_05_45_586_491">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_583"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Getting shared socially</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_586_491"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  					  <tr class="sqb_ans_item" data-id="9173" id="2022_04_10_01_05_45_901_924">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_584"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Converting buyers to a desired action</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_901_924"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  					  <tr class="sqb_ans_item" data-id="9174" id="2022_04_10_01_05_45_620_270">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_585"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Generating organic/SEO traffic</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="2022_04_10_01_05_45_620_270"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  
					</tbody>
				  </table>';

		$question_bank_array[$qb_i]['matrix_column_width'] = '40';


			// set answer for 1 index question start 


			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;


			$answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id=""%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_101"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">Educating your buyer</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';

			
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);\" data-mce-style=\"font-family: \'comic sans ms\', sans-serif; font-size: 16pt;\">Educating your buyer</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;


			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_582"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Differentiating from your competitors</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">Differentiating from your competitors</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			//$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;




			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_583"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Getting shared socially</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">Getting shared socially</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			//$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_584"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Converting buyers to a desired action</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">Converting buyers to a desired action</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			//$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;


			//$answer_table_array = array(); 	
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;

			$answer_table_array[$at_i]['ans'] = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_585"><h4><span style="font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; font-family: \'comic sans ms\', sans-serif;">Generating organic/SEO traffic</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';

			
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-size: 16pt; font-family: &quot;comic sans ms&quot;, sans-serif; color: rgb(68, 68, 68);\" data-mce-style=\"font-size: 16pt; font-family: \'comic sans ms\', sans-serif;\">Generating organic/SEO traffic</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			//$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;


			/*$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'">
						<th class="SQB-fixed-side" style="width: 40%;"><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" style="color: rgb(68, 68, 68); position: relative;" contenteditable="true" spellcheck="false" id="mce_581"><h4><span style="font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-family: \'comic sans ms\', sans-serif; font-size: 16pt;">Educating your buyer</span></h4></div></th>
						<td><input type="radio"><input type="text" value="4" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="3" style="" class="answer_value"></td>
						
						<td><input type="radio"><input type="text" value="2" style="" class="answer_value"></td>
						<td><input type="radio"><input type="text" value="1" style="" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>';
			$answer_table_array[$at_i]['answer_title'] = '<h4><span style=\"font-family: &quot;comic sans ms&quot;, sans-serif; font-size: 16pt; color: rgb(68, 68, 68);\" data-mce-style=\"font-family: \'comic sans ms\', sans-serif; font-size: 16pt;\">Educating your buyer</span></h4>';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			//$answer_table_array[$at_i]['matrix_values'] = '0|4,1|3,2|2,3|1';
			$answer_table_array[$at_i]['matrix_values'] = array(
				array('index' => 0, 'answer_value' => 4),
				array('index' => 1, 'answer_value' => 3),
				array('index' => 2, 'answer_value' => 2),
				array('index' => 3, 'answer_value' => 1),
			);
			$answer_table_array[$at_i]['date'] = $current_data_time;
			*/

			






			
		// set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 2;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_107" contenteditable="true" spellcheck="false"><div>How do you measure your content\'s effectiveness?</div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1649622717103_5248" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1649622717103_5248 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'images/sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1649622717103_5248" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbShowQuesDescriptionOuter" style="display: inline;"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_108" contenteditable="true" spellcheck="false" style="position: relative; display: none;"><div>Enter any additional information about the quiz.</div></div>
                       </div>';



		//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'How do you measure your content\'s effectiveness?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '3';
		$question_bank_array[$qb_i]['ans_with_img'] = 'Y';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'layout-three-in-row';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1800px||901px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';

		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['question_skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';

		$question_bank_array[$qb_i]['ans_img_setting'] = array(
			    'ans_image_size_option' => '100_100',
			    'ans_image_width' => '150',
			    'ans_image_height' => '80',
			    'sqb_ans_show_label' => 'N',
		);

		// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 



			// Ans 4
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/disagree.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_115" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">I don\'t track</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1 sqb_disable_tiny_mce_editor"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';

			$answer_table_array[$at_i]['answer_title'] = 'I don\'t track';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;


			// Ans 5
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/report.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_2022_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_116" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Views, Clicks, Downloads</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';

			$answer_table_array[$at_i]['answer_title'] = 'Views, Clicks, Downloads';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;


			// Ans 3
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/clipboard.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_117" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Content Consumption</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="3"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';

			$answer_table_array[$at_i]['answer_title'] = 'Content Consumption';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '3';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;


			// Ans 2
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/engagement.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_118" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Engagement/Interaction</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="4"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Engagement/Interaction';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '4';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;

			// Ans 1
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;

			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/installfromsample/scoring/content-marketing/images/conversion.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_119" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Conversion (free to paid)</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="5"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';

			
			$answer_table_array[$at_i]['answer_title'] = 'Conversion (free to paid)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '5';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
				

		
		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		// Question 4
		$qb_i = 3;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_38" contenteditable="true" spellcheck="false"><h1>What type of content do you have?</h1></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1649621273290_4869" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1649621273290_4869 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'images/sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1649621273290_4869" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbShowQuesDescriptionOuter" style="display: inline;"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_39" contenteditable="true" spellcheck="false" style="position: relative; display: none;"><div>Enter any additional information about the quiz.</div></div>
                       </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'What type of content do you have?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '1';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1800px||718px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['question_skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_14" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';

		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 3 index question start 
			$answer_table_array = array(); 	

			// Ans 1
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans'] = '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/images/template8_image_not_found.png" class="sbq_change_img '.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_42" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: #444444;" data-mce-style="color: #444444;"><span style="font-family: arial, helvetica, sans-serif; color: rgb(0, 0, 0);" data-mce-style="font-family: arial, helvetica, sans-serif; color: #000000;">All Passive<span style="font-size: 12pt; color: rgb(51, 51, 51);" data-mce-style="font-size: 12pt; color: #333333;"> (blog posts, videos, webinars, etc.)</span></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-10"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';

			
			$answer_table_array[$at_i]['answer_title'] = 'All Passive (blog posts, videos, webinars, etc.)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-10';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			// Ans 2
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/images/template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_43" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Mostly Passive</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Mostly Passive';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			// Ans 4
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/images/template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_45" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">Mostly Interactive</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="4"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Mostly Interactive';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '4';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;

			
			// Ans 3
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/images/template8_image_not_found.png" class="sbq_change_img img_2022_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_44" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">A Mix of Passive &amp; Interactive</span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="3"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A Mix of Passive & Interactive';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '3';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			

			// Ans 5
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'/images/template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_46" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="color: rgb(68, 68, 68);" data-mce-style="color: #444444;"><span style="color: rgb(0, 0, 0);" data-mce-style="color: #000000;">All Interactive <span style="font-size: 12pt;" data-mce-style="font-size: 12pt;">(quizzes, surveys, calculators, assessments)</span></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1 sqb_disable_tiny_mce_editor"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="5"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'All Interactive (quizzes, surveys, calculators, assessments)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '5';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
		// set answer for 3 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		/*$qb_i = 4;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>It\'s 10:30 pm and your boss sends a work-related text!</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'It\'s 10:30 pm and your boss sends a work-related text!';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '3';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 4 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You ignore it!</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You ignore it!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You immediately respond and let him know you\'ll work on it first thing in the morning</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You immediately respond and let him know you\'ll work on it first thing in the morning';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You work on it right away!</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You work on it right away!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			*/
			
			
			
		// set answer for 4 index question end 
		//$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		


		/*--------------------*/
		/*$qb_i = 5;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>And when do you end your work day?</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'And when do you end your work day?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '2';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 4 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">As soon as I can slip away...</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'As soon as I can slip away...';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">At 5:00 PM</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'At 5:00 PM';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">A few hours after everyone else is done</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A few hours after everyone else is done';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">No set time. I keep going until I\'m done with all my work for the day.</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'No set time. I keep going until I\'m done with all my work for the day.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
		// set answer for 4 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
*/

		/*--------------------------*/
		/*$qb_i = 6;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>When do you start your work day?</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'When do you start your work day?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '1';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 4 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">10 minutes after I wake up</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = '10 minutes after I wake up';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">At 8:00 AM</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'At 8:00 AM';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Never in a rush to start my work :-)</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Never in a rush to start my work :-)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I hate my work :-(. I delay starting my work as long as I can.</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-2"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I hate my work :-(. I delay starting my work as long as I can.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
		// set answer for 4 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
*/
		/*----------------*/

		/*$qb_i = 7;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>Where do you eat lunch?</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Where do you eat lunch?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '0';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = ''; // urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 4 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">On my desk while working</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'On my desk while working';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I go out for lunch and eat with my friends</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I go out for lunch and eat with my friends';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I try to extend my lunch :-). I\'m late by 10-15 minutes to work after lunch!</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I try to extend my lunch :-). I\'m late by 10-15 minutes to work after lunch!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;		
			*/
		// set answer for 4 index question end 
		//$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
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
	
	
