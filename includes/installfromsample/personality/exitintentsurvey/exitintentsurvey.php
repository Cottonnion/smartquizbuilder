<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Exit Intent Survey'; // urldecode 
		$quiz_details_array['quiz_desc'] = 'This will show up when people are leaving your site.'; // urldecode
		$quiz_details_array['quiz_type'] = 'personality';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'Y';
		$quiz_details_array['quiz_display'] = 'exit';
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
		$quiz_details_array['show_start_screen'] = 'N';
		$quiz_details_array['show_opt_screen'] = 'Y';
		$quiz_details_array['show_result_screen'] = 'Y';
		$quiz_details_array['show_firstname_template'] = 'N';
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
		$quiz_details_array['template'] = 'template8';
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
		$quiz_details_array['quiz_timmer_array']['quiz_timer_html'] = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; // urldecode 
		//$quiz_details_array['quiz_timmer_array']['timer_customizer'] = 'N||00||00||00||show_last_screen||question';
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
		$customizer_style_setting['continue_button_background_color'] = '#c10000';
		$customizer_style_setting['start_background_inner_width'] = '925px';
		$customizer_style_setting['result_background_inner_width'] = '1009px';
		$customizer_style_setting['opt_background_inner_width'] = '925px';
		$quiz_details_array['customizer_style_setting'] = $customizer_style_setting;
		
		$quiz_details_array['pre_built'] = 'Y';
		$quiz_details_array['pre_built_details'] = trim($pre_built_name.'||'.$pre_built_version);
	// set variable for quiz table end 	
	
	// set variable for quiz template table start
	 	$sqb_img_folder_url = plugins_url('')."/smartquizbuilder/includes/images/";
	 	$start_temp_no = 'template8';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/sqb_bt_image1.jpg";			 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 
		
		$start_temp_html = 	$cssfile.' <div class="Quiz-Template2 start_temp_outer quiz_comon_template outer-style8" style="background-color: transparent; border-color: rgb(51, 51, 51);"><div class="Quiz-Template-title sqb_tiny_mce_editor mce-content-body" id="mce_50" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><div>Enter the Quiz Title.</div></div><span class="sqbHideStartTemplateImageOuter" style="display:none;"><button class="sqbHideStartTemplateImage">Hide Image</button></span><span class="sqbShowStartTemplateImageOuter" style="display: inline-block;"><button class="sqbShowStartTemplateImage">Show Image</button></span><div class="question_img_div ui-resizable" id="start_img_temp2" style="display: none;"><img class="start_img sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$start_img_url.'" style="display: inline-block; width: 300px; height: auto; position: relative;"><span data-class="start_img" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer startTemplateVideoOuter ui-resizable" style="display:none"><a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a><div class="video-add-link startTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="startTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><div class="Quiz-Template-content"><div class="sqb_tiny_mce_editor sqb_content mce-content-body" id="mce_51" contenteditable="true" spellcheck="false" style="position: relative;"><div><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p></div></div><div class="take-quiz-btn sqb_tiny_mce_editor  mce-content-body" id="mce_52" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div></div></div><span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>'; 
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template outer-style8" style="max-width: 750px;">
	<div class="skip_optin sqb_tiny_mce_editor mce-content-body" style="text-align: right;" id="mce_16" contenteditable="true" spellcheck="false"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;">Skip Opt-in</span></div></div>
	<div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_17" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><h1><strong><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;">Thank you so much!&nbsp;</span></strong></h1></div>
	<div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_18" contenteditable="true" spellcheck="false" style="position: relative;"><div>We would love to help you! Let us know how we can reach you.</div><div>We are happy to setup a one-on-one call with you to</div><div>answer any questions and help solve the problems you have!</div></div>
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
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_19" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;"><input type="hidden" name="mce_19" style="pointer-events: none;" value="By joining, you agree to the terms of service and privacy policy.">
				</div>	

				<div class="sqb-gdpr-checkbox gdpr-Outer ui-sortable-handle" style="display: none;">
					<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox" style="pointer-events: none;">
						<span class="custom--checkbox"></span>
					</span>
					<label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;">By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.</label><input type="hidden" name="mce_20" style="pointer-events: none;"><input type="hidden" name="mce_20" style="pointer-events: none;" value="By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.">
				</div>
			</div>
			<div class="continue_btn sqb_tiny_mce_editor  mce-content-body" id="mce_21" style="background-color: rgb(193, 0, 0); position: relative;" contenteditable="true" spellcheck="false"><div>Get Started</div></div><input type="hidden" name="mce_21"><input type="hidden" name="mce_21" value="<div>Get Started</div>">	
			<div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_22" contenteditable="true" spellcheck="false" style="position: relative;"><div>You can unsubscribe at any time.</div></div><input type="hidden" name="mce_22"><input type="hidden" name="mce_22" value="<div>You can unsubscribe at any time.</div>">		
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
	
	if(isset($_GET['sqb_theme_built_install_call']) && $_GET['sqb_theme_built_install_call']){
		
	
	
	$quiz_details = SQBSaveQuizAjax($quiz_details_array);
	
	if(is_array($quiz_details) && isset($quiz_details['quiz_id'])){
		
		// set variable for outcome table start
		$outcome_table_array = array();
		$oc_i = 0;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Thank You!';
		
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8 scoring-fields-visible" style="max-width: 1009px;"> 
		<div class="points_scored_result sqb_tiny_mce_editor mce-content-body" id="mce_33" contenteditable="true" style="position: relative;" spellcheck="false"><h2><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;">We Appreciate You!</span></h2></div> 
		<span class="sqbHideTemplateImageOuter" style="display: inline-block;"><button class="sqbHideTemplateImage">Hide Image</button></span>
			<span class="sqbShowTemplateImageOuter" style="display: none;"><button class="sqbShowTemplateImage">Show Image</button></span>
		<div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 275px; display: inline-block;">
			<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span-->
			
			<img class="22_04_22_02_04_00185 sqb_img_draggable ui-draggable ui-draggable-handle" src="https://smartquizbuilder.com/wp-content/uploads/2022/02/thank-you-140227_640.jpg" style="position: relative; height: 275px;">
			<span data-class="22_04_22_02_04_00185" class="question_img_upload sbq_change_img " src="https://smartquizbuilder.com/wp-content/uploads/2022/02/thank-you-140227_640.jpg"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
				<!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span-->
				
				<div class="sqb_tiny_mce_editor mce-content-body" id="mce_34" contenteditable="true" style="position: relative;" spellcheck="false"><div><span style="color: #000000;" data-mce-style="color: #000000;">Thank you so much for completing this brief survey! </span><span style="color: #000000;" data-mce-style="color: #000000;">We take </span></div><div><span style="color: #000000;" data-mce-style="color: #000000;">your </span><span style="color: #000000;" data-mce-style="color: #000000;">feedback seriously!&nbsp; </span><span style="color: #000000;" data-mce-style="color: #000000;">We are happy to do a quick call </span></div><div><span style="color: #000000;" data-mce-style="color: #000000;">with you to answer any questions you may have.&nbsp;</span></div></div><br>
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
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_35" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_36" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_37" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_38" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_39" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_40" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_41" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_42" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>	
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_43" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_44" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_45" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_46" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
							</div>
						</div>
						<span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<div class="sqb_ans_item ui-sortable-handle">
						<div class="sqb_ans_item_inner">
							<figure class="sqb_ans_item_img"><img src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/image_not_found.png" class="sbq_change_img">
							</figure>
							<div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_47" contenteditable="true" spellcheck="false" style="position: relative; color: rgb(68, 68, 68);"><div style="color: #444444;" data-mce-style="color: #444444;">Product Title</div></div>
							<div class="buy-now-btn-outer">
								<span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span>
								<div class="buy-now-btn sqb_tiny_mce_editor mce-content-body" id="mce_48" contenteditable="true" spellcheck="false" style="position: relative;"><div>Buy Now</div></div>
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
					<div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" id="mce_49" contenteditable="true" style="position: relative; width: 572px; padding-top: 21px; padding-bottom: 21px; background-color: rgb(193, 0, 0);" spellcheck="false" data-continueurl="https://smartquizbuilder.com/"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;">Schedule a FREE call with us &gt;&gt;&gt;</span></div></div>
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
			$outcome_has = true;
		}
		
		// set variable for question bank table start
		
		$question_bank_array = array();
		$qb_i = 0;
		
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_16" contenteditable="true" spellcheck="false"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;"><strong>Before you go...</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1650663154351_8999" style="display: none;">

							<img class="sqb_img_draggable sbq_img_2022_3_1650663154351_8999 ui-draggable ui-draggable-handle" src="https://memberdemo.com/select/wp-content/plugins/smartquizbuilder/includes/images/import/sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1650663154351_8999" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_17" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: #333300;" data-mce-style="color: #333300;">Could you please tell us why you decided to leave?</span></div></div>
						</div>';
                       
                       
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Before you go...';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '1';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'multiple';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1076px||915px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 0 index question start
		    
		    
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array = array(); 	
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="text-align: center; color: rgb(68, 68, 68);" data-mce-style="text-align: center;"><span style="font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; color: #c10000;"><strong>I couldn\'t find enough information</strong></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'I couldn\'t find enough information.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="text-align: center; color: rgb(68, 68, 68);" data-mce-style="text-align: center;"><span style="font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; color: #c10000;"><strong>I was just browsing</strong></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'I was just browsing.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="text-align: center; color: rgb(68, 68, 68);" data-mce-style="text-align: center;"><span style="font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; color: #c10000;"><strong>The price is too high</strong></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'The price is too high';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="text-align: center; color: rgb(68, 68, 68);" data-mce-style="text-align: center;"><span style="font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; color: #c10000;"><strong>Missing Features</strong></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'Missing Features';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style="max-width: 100px; height: 100px;"><img src="'.$sqb_img_folder_url.'template8_image_not_found.png" class="sbq_change_img img_'.$sqb_datetime_rand_img.'" data-class="img_'.$sqb_datetime_rand_img.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" style="position: relative; color: rgb(68, 68, 68);" spellcheck="false"><div style="text-align: center; color: rgb(68, 68, 68);" data-mce-style="text-align: center;"><span style="font-size: 16pt; color: rgb(68, 68, 68);" data-mce-style="font-size: 16pt; color: #c10000;"><strong>Something Else</strong></span></div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none"><strong>Add Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			
			$answer_table_array[$at_i]['answer_title'] = 'Something Else';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			// set answer for zero index question end
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
			
		$qb_i = 1;               
        $question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" id="mce_25" contenteditable="true" spellcheck="false"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;"><strong>Looking for anything specific?</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1650663437511_3629" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1650663437511_3629 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1650663437511_3629" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_26" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="color: #333300;" data-mce-style="color: #333300;">Your feedback will help us make our product better!</span></div></div>
                       </div>';//urldecode              
                       
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Looking for anything specific?';
		$question_bank_array[$qb_i]['question_type'] = 'text';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '2';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1076px||839px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 1 index question start 
		$answer_table_array = array(); 	
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="13062" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="What are we missing?"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div></div></div></div>';
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;
			
		// set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 2;
		//urldecode
		
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_26"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;"><strong>Is there a specific price range you are looking for?</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1650663437511_3629" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1650663437511_3629 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1650663437511_3629" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_27"><div><span style="color: #333300;" data-mce-style="color: #333300;">Your feedback will help us make our product better!</span></div></div>
                       </div>';//urldecode
		
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Is there a specific price range you are looking for?';
		$question_bank_array[$qb_i]['question_type'] = 'text';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '3';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1076px||839px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
		$answer_table_array = array(); 	
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="13062" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="What are we missing?"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div></div></div></div>';
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;

		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		
		$qb_i = 3;
		//urldecode
		
	    $question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_30"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;"><strong>Is there a specific feature you are interested in?</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1650663437511_3629" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1650663437511_3629 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1650663437511_3629" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_31"><div><span style="color: #333300;" data-mce-style="color: #333300;">We would love to know more...</span></div></div>
                       </div>';
		
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Is there a specific feature you are interested in?';
		$question_bank_array[$qb_i]['question_type'] = 'text';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '4';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1076px||839px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
		$answer_table_array = array(); 	
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="13062" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="What are we missing?"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div></div></div></div>';
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;


		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		
		$qb_i = 4;
		//urldecode               
        $question_bank_array[$qb_i]['question_data'] = '<div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_34"><div><span style="color: rgb(193, 0, 0);" data-mce-style="color: #c10000;"><strong>We would love to what we are missing!</strong></span></div></div>
							<span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2022_3_1650663437511_3629" style="display: none;">
						
							<img class="sqb_img_draggable sbq_img_2022_3_1650663437511_3629 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;">
							<span data-class="sbq_img_2022_3_1650663437511_3629" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
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
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative;" id="mce_35"><div><span style="color: #333300;" data-mce-style="color: #333300;">Your feedback will help us make our product better!</span></div></div>
                       </div>';               
		
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'We would love to what we are missing!';
		$question_bank_array[$qb_i]['question_type'] = 'text';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '5';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '1076px||839px';
		$question_bank_array[$qb_i]['allow_skip_ques'] = 'N';
		$question_bank_array[$qb_i]['question_file_upload_settings'] = '';
		$question_bank_array[$qb_i]['next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
		$question_bank_array[$qb_i]['skip_button_html'] = '<div class="skip-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_5" contenteditable="true" spellcheck="false" style="position: relative;"><div>Skip Question</div></div>';
		$question_bank_array[$qb_i]['enable_question_background_image'] = 'N';
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'N';
		$question_bank_array[$qb_i]['question_next_button_html'] = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_6" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
		$answer_table_array = array(); 	
		$at_i = 0;
		$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
		$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item ui-sortable-handle" data-id="13062" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><div class="sqb_ans_item_inner"><textarea class="sqb_and_field sqb_input_ans_field sqb_textarea_ans_field" name="sqb_ans_'.$sqb_datetime_rand.'" placeholder="What are we missing?"></textarea><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div></div></div></div>';
		
		$answer_table_array[$at_i]['answer_title'] = '';
		$answer_table_array[$at_i]['correct_ans'] = 'N';
		$answer_table_array[$at_i]['ans_point'] = '0';
		$answer_table_array[$at_i]['ans_hint'] = '';
		$answer_table_array[$at_i]['ans_info'] = '';
		$answer_table_array[$at_i]['answer_order'] = '0';
		$answer_table_array[$at_i]['date'] = $current_data_time;

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
	
	// set funnel data start
	$funnel_details_array =  array();
	$funnel_details_array['quiz_id'] =  $quiz_details['quiz_id'];
	$funnel_details_array['funnel_enable_branching'] =  'Y';
	 	
	$funnel_details_array['data_export'] = '{\"drawflow\":{\"Home\":{\"data\":{\"351\":{\"id\":\"351\",\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"351\\\" ><span title=\\\"Q2:&nbsp;Before you go...\\\">Before you go...</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" ><span title=\\\"I couldn\'t find enough information\\\">I couldn\'t find enough information</span></div><div class=\\\"funnel_answer_title\\\" ><span title=\\\"I was just browsing\\\">I was just browsing</span></div><div class=\\\"funnel_answer_title\\\" ><span title=\\\"The price is too high\\\">The price is too high</span></div><div class=\\\"funnel_answer_title\\\" ><span title=\\\"Missing Features\\\">Missing Features</span></div><div class=\\\"funnel_answer_title\\\" ><span title=\\\"Something Else\\\">Something Else</span></div></div>\",\"typenode\":false,\"inputs\":[],\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"1492\",\"output\":\"input_1\"},{\"node\":\"352\",\"output\":\"input_1\"}]},\"output_2\":{\"connections\":[{\"node\":\"1493\",\"output\":\"input_1\"}]},\"output_3\":{\"connections\":[{\"node\":\"1494\",\"output\":\"input_1\"},{\"node\":\"353\",\"output\":\"input_1\"}]},\"output_4\":{\"connections\":[{\"node\":\"1495\",\"output\":\"input_1\"},{\"node\":\"354\",\"output\":\"input_1\"}]},\"output_5\":{\"connections\":[{\"node\":\"1496\",\"output\":\"input_1\"},{\"node\":\"355\",\"output\":\"input_1\"}]}},\"pos_x\":10,\"pos_y\":50},\"352\":{\"id\":\"352\",\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"352\\\" ><span title=\\\"Q3:&nbsp;2 One last question...\\\">2 One last question...</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" ><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":\"351\",\"input\":\"output_1\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"1501\",\"output\":\"input_1\"}]}},\"pos_x\":459,\"pos_y\":29},\"353\":{\"id\":\"353\",\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"353\\\" ><span title=\\\"Q4:&nbsp;3 One last question...\\\">3 One last question...</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" ><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":\"351\",\"input\":\"output_3\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"1502\",\"output\":\"input_1\"}]}},\"pos_x\":335,\"pos_y\":180},\"354\":{\"id\":\"354\",\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"354\\\" ><span title=\\\"Q5:&nbsp;4 One last question...\\\">4 One last question...</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" ><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":\"351\",\"input\":\"output_4\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"1503\",\"output\":\"input_1\"}]}},\"pos_x\":426,\"pos_y\":329},\"355\":{\"id\":\"355\",\"name\":\"qatemplate\",\"data\":[],\"class\":\"multiple\",\"html\":\"<div class=\\\"funnel_question_title \\\" data-question-id=\\\"355\\\" ><span title=\\\"Q6:&nbsp;5 One last question...\\\">5 One last question...</span></div><div class=\\\"funnel_answer_wrapper\\\"><div class=\\\"funnel_answer_title\\\" ><span title=\\\"\\\"></span></div></div>\",\"typenode\":false,\"inputs\":{\"input_1\":{\"connections\":[{\"node\":\"351\",\"input\":\"output_5\"}]}},\"outputs\":{\"output_1\":{\"connections\":[{\"node\":\"1504\",\"output\":\"input_1\"}]}},\"pos_x\":443,\"pos_y\":531}}}}}';
	
	$funeel_array['old_question_id']=  array(351,352,353,354,355);
	$funeel_array['old_answer_id']  =  array(1492,1493,1494,1495,1496,1501,1502,1503,1504);
	
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
	
	// set funnel data end
	
	}
}
