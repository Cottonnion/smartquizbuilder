<?php

function createAIQuiz($jsonArray) {

	if($jsonArray['template'] == 'template1' ||$jsonArray['template'] == 'template3' || $jsonArray['template'] == 'template4' || $jsonArray['template'] == 'template6' || $jsonArray['template'] == 'template7' || $jsonArray['template'] == 'template9'){
		$temp = 'template2';
	}else{
		$temp = $jsonArray['template'];
	}

	$start_screen = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/start/" . $temp . "/" . $temp . ".php");		
	$start_screen_html = file_get_contents($start_screen);
	$img_url = plugins_url()."/smartquizbuilder/includes/images/start_image1.jpg";	

	$start_screen_html = str_replace("<?php echo plugins_url('');?>/smartquizbuilder/includes/images/start_image1.jpg" , $img_url ,$start_screen_html);
	$start_screen_html = str_replace("%%IMGURL%%" , $img_url ,$start_screen_html);
	if($jsonArray['template'] == 'template2'){
		$start_screen_html = str_replace("start_temp_outer quiz_comon_template" , 'start_temp_outer quiz_comon_template outer-style1' ,$start_screen_html);
		
	}else if($jsonArray['template'] == 'template3'){
		$start_screen_html = str_replace("start_temp_outer quiz_comon_template" , 'start_temp_outer quiz_comon_template outer-style2' ,$start_screen_html);
	}else if($jsonArray['template'] == 'template6'){
		$start_screen_html = str_replace('<div class="question_img_div " id="start_img_temp2">' , '<div class="question_img_div ui-resizable" id="start_img_temp2" style="display: none;">' ,$start_screen_html);
		$start_screen_html = str_replace('<div class="take-quiz-btn sqb_tiny_mce_editor "><div>TAKE THIS QUIZ</div></div>' , '<div class="take-quiz-btn sqb_tiny_mce_editor"  style="background-color: rgb(255, 218, 92); position: relative; color: rgb(52, 52, 52); font-family: &quot;open sans&quot;; width: 170px; padding-top: 15px; padding-bottom: 15px;" ><div style="cursor: grab;">Start Quiz</div></div>' ,$start_screen_html);
	}else if($jsonArray['template'] == 'template4'){
		$start_screen_html = str_replace($start_screen_html , '<div class="outer-style3 outer_style3_new" style="border-top-color: rgb(255, 99, 77);"><span class="outer_style3_span_first" style="border-color: rgb(255, 99, 77) transparent transparent;"></span><span class="outer_style3_span_second" style="border-color: rgb(255, 99, 77) transparent transparent;"></span>'.$start_screen_html.'</div>' ,$start_screen_html);
	}else if($jsonArray['template'] == 'template7'){
		$start_screen_html = str_replace("start_temp_outer quiz_comon_template" , 'start_temp_outer quiz_comon_template outer-style7' ,$start_screen_html);
		$start_screen_html = str_replace('<span class="sqbHideStartTemplateImageOuter">' , '<span class="sqbHideStartTemplateImageOuter" style="display:none;">' ,$start_screen_html);
		$start_screen_html = str_replace('<div class="question_img_div " id="start_img_temp2">' , '<div class="question_img_div " id="start_img_temp2" style="display:none;">' ,$start_screen_html);
	}else if($jsonArray['template'] == 'template9'){
		$start_screen_html = '<div class="Quiz-Template-title sqb_tiny_mce_editor"><div>Enter the Quiz Title</div></div> <div class="question_img_div " id="start_img_temp2" style="display: none;"> <img class="start_img sqb_img_draggable"  src="'.$img_url.'" > <span data-class="start_img" class="question_img_upload sbq_change_img" ><i class="fa fa-camera" aria-hidden="true"></i></span> </div> <div class="Quiz-Template-content"> <div class="sqb_tiny_mce_editor sqb_content"><div> Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it.</div></div> <div class="take-quiz-btn sqb_tiny_mce_editor " style="background-color: rgb(0, 0, 0); color: rgb(255, 255, 255); width: 272px; padding-top: 16px; padding-bottom: 16px;"><div>TAKE THIS QUIZ</div></div> </div>';
		
	}else if($jsonArray['template'] == 'template5'){
		$start_screen_html = str_replace("Enter Quiz Title Here" , $jsonArray['title'] ,$start_screen_html);
		$start_screen_html = str_replace("Enter Quiz Description Here" , $jsonArray['quiz_description'] ,$start_screen_html);
	}else if($jsonArray['template'] == 'template8'){
		$start_screen_html = str_replace("Enter the Quiz Title" , $jsonArray['title'] ,$start_screen_html);
		$start_screen_html = str_replace('<div class="take-quiz-btn sqb_tiny_mce_editor "><div>Continue</div></div>		', '<div class="take-quiz-btn sqb_tiny_mce_editor " style="max-width: 356px; position: relative; padding-top: 19px; padding-bottom: 19px; cursor: grabbing; background-position-y: -42px;"><div>Continue</div></div>',$start_screen_html);
		$start_screen_html = str_replace("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book." , $jsonArray['quiz_description'] ,$start_screen_html);
	}


	if($jsonArray['quiz_type'] == 'survey'){
		$start_screen_html = str_replace("TAKE THIS QUIZ" , 'Take this Survey' ,$start_screen_html);
	}


	$start_screen_html = str_replace("Enter the Quiz Title" , $jsonArray['title'] ,$start_screen_html);
	$start_screen_html = str_replace("Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it." , $jsonArray['quiz_description'] ,$start_screen_html);


	if($jsonArray['template'] == 'template9'){
		$optin_temp = $jsonArray['template'];
	}else{
		$optin_temp = 'template1';
	}

	$optin_screen = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/opt-in/".$optin_temp."/".$optin_temp.".php");		
	$optin_screen_html = file_get_contents($optin_screen);

	$regist_img_url = plugins_url()."/smartquizbuilder/includes/images/sqb-registration-img.jpg";
	$optin_screen_html = str_replace("<?php echo plugins_url('');?>/smartquizbuilder/includes/images/sqb-registration-img.jpg" , $regist_img_url ,$optin_screen_html);

	if($jsonArray['template'] == 'template2'){
		$optin_screen_html = str_replace("Quiz-Optin-Template quiz_comon_template" , 'Quiz-Optin-Template quiz_comon_template outer-style1' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template3'){
		$optin_screen_html = str_replace("Quiz-Optin-Template quiz_comon_template" , 'Quiz-Optin-Template quiz_comon_template outer-style2' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template4'){
		$optin_screen_html = str_replace($optin_screen_html , '<div class="outer-style3 outer_style3_new" style="border-top-color: rgb(255, 99, 77);"><span class="outer_style3_span_first" style="border-color: rgb(255, 99, 77) transparent transparent;"></span><span class="outer_style3_span_second" style="border-color: rgb(255, 99, 77) transparent transparent;"></span>'.$optin_screen_html.'</div>' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template8'){
		$optin_screen_html = str_replace("Quiz-Optin-Template quiz_comon_template" , 'Quiz-Optin-Template quiz_comon_template outer-style8' ,$optin_screen_html);
		$optin_screen_html = str_replace('<div class="continue_btn sqb_tiny_mce_editor background-color-one-to-four" style="width: 700px; color: #333;"><div>Get Started</div></div>' , '<div class="continue_btn sqb_tiny_mce_editor background-color-one-to-four" style="width: 700px; color: #fff;"><div>Get Started</div></div>' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template5'){
		$optin_screen_html = str_replace('<div class="Quiz-Optin-Template quiz_comon_template">' , '<div class="Quiz-Optin-Template quiz_comon_template" style="max-width: 1400px; background-color: rgb(0, 0, 0); text-align: center; border: none; border-radius: 0px; min-height: 760px;">' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template7'){
		$optin_screen_html = str_replace("Quiz-Optin-Template quiz_comon_template" , 'Quiz-Optin-Template quiz_comon_template outer-style7' ,$optin_screen_html);
	}else if($jsonArray['template'] == 'template9'){
		$optin_screen_html = '<div class="Quiz-Optin-Template quiz_comon_template"> <div class="skip_optin sqb_tiny_mce_editor" style="display:none; text-align: right;">Skip Opt-in</div> <div class="lead-image-video-section"> <div class="lead_screen_img_div Quiz-Template-image" id="lead_screen_temp_id" style="display: none;"> <img class="lead_screen_temp_img" src="'.home_url().'/wp-content/plugins/smartquizbuilder/includes/images/sqb-registration-img.jpg"> <span data-class="lead_screen_temp_img" class="question_img_upload sbq_change_lead_img"><i class="fa fa-camera" aria-hidden="true"></i></span> </div> <div class="video-element-outer leadScreenTemplateVideoOuter" data-type="leadScreen" style="display: none;"> <div class="videoOverlay" data-toggle="modal" data-target="#leadScreen-video-insert"></div> <input type="hidden" class="leadScreen_video_url" value=""> <input type="hidden" class="leadScreen_show_video" value="N"> <input type="hidden" class="leadScreen_video_link_type" value="0"> <input type="hidden" class="leadScreen_video_link_type_text" value="Source"> <input type="hidden" class="leadScreen_video_aspect" value="1"> <a href="javascript:void(0)" class="leadScreenTemplateVideoOuterLinkOver insertleadScreenVideo" data-type="leadScreen"></a> <div class="video-add-link leadScreenTemplateInsertVideoOuter" style=""> <a href="javascript:void(0)" class="insertleadScreenVideo" data-type="leadScreen"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="leadScreenTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper leadScreenTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> </div> </div> <div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4"><div>Almost there...</div></div> <div class="sqb_tiny_mce_editor sqb_opt_in_h6" > <div>Where can we email you the results? Please enter details below.</div> </div> <div class="Quiz-Template-content"> <form id="sqb_direct_signup" class="sqbform" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%"  onsubmit=""> <input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%" /> <input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%" /> <input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%" /> <div class="form_cls"> <input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name"> <input type="email"  name="email" id="email" value="" placeholder="Your Email"> <div class="sqb-checkbox termsConditionOuter"  style="display:none"> <span class="checkbox-custom-style"> <input class="custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox"> <span class="custom--checkbox"></span> </span> <label class="sqbcontrol-label sqb_tiny_mce_editor" > <div>By joining, you agree to the terms of service</div></label> </div> <div class="sqb-gdpr-checkbox gdpr-Outer"  style="display:none"> <span class="checkbox-custom-style"> <input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox"> <span class="custom--checkbox"></span> </span> <label class="sqbcontrol-label sqb_tiny_mce_editor" > <div>Unsubscribe anytime. For further details, review your Privacy Policy.</div></label> </div> </div> <div class="continue_btn sqb_tiny_mce_editor "><div>Get Started</div></div> <div class="sqb_tiny_mce_editor text_privacy_policy" > <div>You can unsubscribe at any time.</div> </div> </form> </div> </div>';
	}



	if($jsonArray['template'] == 'template3' || $jsonArray['template'] == 'template4'){
		$sqb_global_border_color = '#ff634d';
	}else{
		$sqb_global_border_color = '#dddddd';
	}

$start_lead_customizer_styles = "";
$transparent_background_settings = "";
$template6_question_data = "";

$customizer_style_setting = array(
										'answer_background' => 'rgba(247,247,247,1)',
										'answer_background_hover' => 'rgba(79,108,191,1)',
										'answer_text_color' => 'rgba(255,255,255,1)',
										'outcome_tag_width' => '800px',
										
									);

if($jsonArray['template'] == 'template9'){
	$start_lead_customizer_styles = array(
            'temp_layout' => 'sqb-template-bg-video-left',
            'start_image_url' => '',
            'lead_temp_layout' => 'sqb-template-bg-video-left',
            'lead_image_url' => '',
            'start_background_color' => 'rgb(214, 153, 92)',
            'lead_background_color' => 'rgb(214, 153, 92)',
        );

	$transparent_background_settings = array(
		'focus_mode' => 'Y',
		'selected_val' => 'vh',
		'temp_height' => '100',
		'temp_width' => '2000',
		'template6_answer_border_width' => '2',
		'answer_hover_color' => '#9c9797',
		'answer_hover_text_color' => '#ffffff',
		'template6_answer_border_hover_color' => '#ffffff',
		'template6_answer_border_color' => '#ffffff',
		'answer_hover_opacity' => '1',
	);
}else if($jsonArray['template'] == 'template8'){
	$transparent_background_settings = 'px|2000|px|200|undefined|undefined|#9c9797|1|0% 0%|#fff7f0||400|0|#ffffff|0.7|N|#ffffff|#ffffff|2';

	$customizer_style_setting = array(
										
										'template8_background_image' => '',
										'template8_bg_img_opacity' => '0.6',
										'template8_background_image_url' => '',
										'answer_border_hover_width' => '',
										'answer_border_width' => '2px',
										'answer_border_style' => 'solid',
										'answer_border_hover_width' => '4px',
										'answer_border_color' => 'rgb(255, 119, 119)',
										'answer_border_shadow_color' => 'rgb(255, 119, 119)',
										'startscreen_button_background_color' => '#ff8745',
										'continue_button_background_color' => '#ff7777',
										'continue_button_hover_background_color' => '#ff7777',
									);

	}else if($jsonArray['template'] == 'template6'){

		$transparent_background_settings = 'px|2000|px|200|'.SQB_URL.'includes/images/template6-latest.jpeg|undefined|#ffda5c|1|50% 50%|#fff7f0|background-color:rgba(255, 255, 255, 0.3); max-width:873px|685|0|#343434|0.7|N|#ffda5c|#ffda5c|2';

		$template6_question_data = '<div class="Quiz-Template '.$jsonArray['template'].'" data-id="" style="background-color:rgba(255, 255, 255, 0.3); max-width:873px">%%QUESTIONANSWERS%%</div>';
		$customizer_style_setting = array(
										'outcome_tag_width' => '800px'
									);
	}

	if($jsonArray['template'] == 'template1' || $jsonArray['template'] == 'template2' || $jsonArray['template'] == 'template3' || $jsonArray['template'] == 'template4'){
		$customizer_style_setting = array(
										'answer_background_hover' => 'rgb(255, 119, 119)',
									);
	}


	if($jsonArray['quiz_type'] == 'scoring'){
		$next_btn = 'Y';
		$result_page = "result_page";
	}else{
		$next_btn = 'N';
		$result_page = "both";
	}

	$form_data = array(
		'quiz_name' => $jsonArray['title'],
		'quiz_desc' => $jsonArray['quiz_description'],
		'quiz_type' => $jsonArray['quiz_type'],
		'quiz_display' => 'inpage',
		'quiz_move_question' => 'Y',
		'grade_quiz' => 'N',
		'question_display' => 'all',
		'number_of_question' => '9999',
		'url_select_popup' => 'N',
		'quiz_pagination' => 'one_per_page',
		'question_per_page' => '1',
		'result_display_option' => 'different_page',
		'show_start_screen' => 'Y',
		'show_result_screen' => 'Y',
		'show_opt_screen' => 'Y',
		'show_share_screen' => 'N',
		'autosubmit_optin' => 'N',
		'opt_screen_position' => 'optin-after-questions-screen',
		'user_opt_in_redirect' => 'opt_in_redirect_result_page',
		'user_added_platform' => 'add_user_in_wp',
		'template_display_sequence' => 'start_temp',
		'template_display_sequence' => 'quesans_temp',
		'template_display_sequence' => 'optin_temp',
		'template_display_sequence' => 'result_temp',
		'start_temp_html' => $start_screen_html,
		'start_lead_customizer_styles' => $start_lead_customizer_styles,
		'start_image' => SQB_URL. 'includes/images/start_image1.jpg',
		'optin_temp_html' => $optin_screen_html,
		'result_temp_html' => '',
		'question_temp_html' => $template6_question_data,
		'quiz_timer' => '',
		'quiz_timer_limit' => '0',
		'progress_bar' => 'N',
		'quiz_passmark' => '0',
		'quiz_attempts_allowed' => 'N',
		'show_correct_ans' => 'N',
		'show_correct_ans_option' => 'last_page',
		'questions_random' => 'N',
		'answers_random' => 'N',
		'move_question' => 'N',
		'show_for_notloggedin_user' => 'Y',
		'start_template_no' => 'template2',
		'result_template_no' => 'template1',
		'optin_template_no' => $optin_temp,
		'template_no' => $jsonArray['template'],
		'outcome_type' => 'range',
		'outcome_based' => 'outcome|N',
		'outcome_page' => 'outcome_page',
		'display_score_on_page' => 'yes',
		'display_correctans_on_page' => $jsonArray['display_correctans_on_page'],
		'display_quesans_on_outcome' => 'yes',
		'transparent_background_settings' => $transparent_background_settings,
		'outcome_redirect_url' => 'outcome_redirect_url',
		'outcome_display_charts' => 'undefined|undefined|undefined|undefined|undefined||N|N||600|16|#12c9dd|"DM Sans",sans-serif|<div style="text-align: left;" data-mce-style="text-align: left;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">%%TOTALUSERS%% user(s) participated in the %%QUIZ_NAME%% quiz.</span></div><div style="text-align: left;" data-mce-style="text-align: left;"><br><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;">Here are the detailed results:</span></div>|Total Response|outcome_based|%3Cdiv%20style%3D%22text-align%3A%20left%3B%22%20data-mce-style%3D%22text-align%3A%20left%3B%22%3EQuestion%20%2F%20Answer%20Details%3A%3C%2Fdiv%3E|Y|undefined|500|<div style="text-align: center;"><span style="font-size: 14pt;"><strong>Your Personalized Quiz Results</strong></span><br><span style="font-size: 14pt;">The bar chart shows your score across each category</span></div>|<div style="text-align: center;"><span style="font-size: 14pt;" ><strong>Your Personalized Quiz Insights</strong></span><br><span style="font-size: 14pt;">The spider chart presents your results in a web-like format.<br> Each point represents a specific area, helping you identify<br> where you excel and where you may want to focus more attention.</span></div>|<div style="text-align: center;"><span style="font-size: 14pt;"><strong>Your Personality Breakdown</strong></span><br><span style="font-size: 14pt;">The pie chart offers a clear visual representation of how your<br> results are distributed across each category.</span></div>',
		'enable_branching' => 'N',
		'display_correctans_options' => $result_page,
		'show_next_button' => $next_btn,
		'show_back_btn_option' => 'N|allow',
		'select_quiz_bank' => 'N',
		'limit_questions_displayed' => 'N',
		'already_take_the_quiz' => 'start_screen',
		'total_attempts' => '10',
		'template' => $jsonArray['template'],
		'startshowHide_video' => 'N',
		'quiz_time_delay' => '0',
		'quiz_popup_frequency' => 'always',
		'quick_email_verification' => 'N',
		'quiz_slider_animation' => 'N',
		'quiz_slider_animation_option' => 'rl',
		'sqb_quiz_allow_retake' => 'N',
		'limit_input' => '',
		'video_url' => '',
		'quiz_display_url' => '',
		'quiz_popup_position' => '',
		'customizer_styles' => '',
		'common_style' => '',
		'sqb_quiz_many_attempts' => 'Unlimited',
		'sqb_quiz_max_attempts_limit' => 'Unlimited',
		'quiz_mode' => '',
		'quiz_blocking' => 'N',
		'quiz_show_correct_answer' => 'Y',
		'question_per_page' => 'y',
		'quiz_score' => 'Y',
		'show_percentage' => 'Y',
		'auto_submit_opt' => 'N',
		'actionType' => 'save_quiz',
		'quiz_timmer_array' => array(
								'timer_enable'=> 'N',
								'quiz_timer_hours'=> '00',
								'quiz_timer_mint'=> '00',
								'quiz_timer_sec'=> '00',
								'quiz_timer_html'=> '%20%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_18%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3E%3Cspan%20style%3D%22font-size%3A%2013pt%3B%22%20data-mce-style%3D%22font-size%3A%2013pt%3B%22%3E%3Cstrong%3ETime%20Left%3A%20%25%25TIMELEFT%25%25%3C%2Fstrong%3E%3C%2Fspan%3E%3C%2Fdiv%3E%3C%2Fdiv%3E',
								'quiz_timer_spent_html'=> '%20%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_19%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3E%3Cspan%20style%3D%22font-size%3A%2013pt%3B%22%20data-mce-style%3D%22font-size%3A%2013pt%3B%22%3E%3Cstrong%3ETime%20Spent%3A%20%25%25TIMESPENT%25%25%3C%2Fstrong%3E%3C%2Fspan%3E%3C%2Fdiv%3E%3C%2Fdiv%3E',
								'quiz_timer_elapses_option' => 'show_last_screen',
								'quiz_timer_display_in_screen' => 'question',
								'quiz_timer_expired_msg' => '%0A%09%09%09%09%09%09%09%09%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_20%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3ETime%20expired.%20Sorry%2C%20you%20will%20not%20be%20able%20to%20continue%20with%20this%20quiz.%20Please%20opt-in%20to%20see%20the%20result.%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09',
								'quiz_timer_hour_html' => '%0A%09%09%09%09%09%09%09%09%09%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_15%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3EHRS%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09',
								'quiz_timer_mint_html' => '%0A%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09%09%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_16%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3EMIN%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09%09%09',
								'quiz_timer_sec_html' => '%20%0A%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09%09%3Cdiv%20class%3D%22sqb_tiny_mce_editor%20%20mce-content-body%22%20id%3D%22mce_17%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%20style%3D%22position%3A%20relative%3B%22%3E%3Cdiv%3ESEC%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09%09%09%09%0A%09%09%09%09%09%09%09%09',
							),
		'enable_background_image'=> 'N',
		'quiz_category'=> 'N',
		'weighted_score'=> 'N',
		'quiz_allow_pdf_download_outcome_screen'=> 'N',
		'game_animation'=> 'N',
		'game_animation_template'=> 'template1',
		'game_animation_background_color'=> '#d6e3ff',
		'game_animation_timer'=> '5',
		'game_animation_text'=> '<p><span style="font-size: 24pt;"><strong><span style="color: #18514a;">%%FIRST_NAME%% Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>',
		'different_message_outcome'=> 'N',
		'quiz_recommendation_enable'=> 'N',
		'quiz_ads_enable'=> 'N',
		'quiz_recommendation_next_button_html'=> '%0A%09%09%09%09%09%09%09%3Cdiv%20class%3D%22single_next_btn%20sqb_next_btn%20sqb_tiny_mce_editor%20mce-content-body%22%20style%3D%22display%3A%20inline-block%3B%20border-radius%3A%205px%3B%20background%3A%20rgb(37%2C%2037%2C%2037)%3B%20color%3A%20rgb(255%2C%20255%2C%20255)%3B%20height%3A%20auto%3B%20padding%3A%2013px%2015px%3B%20font-family%3A%20%26quot%3BDM%20Sans%26quot%3B%2C%20sans-serif%3B%20min-width%3A%2090px%3B%20box-shadow%3A%20none%3B%20margin%3A%200px%3B%20text-decoration%3A%20none%3B%20line-height%3A%20normal%3B%20border%3A%20none%3B%20text-align%3A%20center%3B%20text-transform%3A%20initial%3B%20font-size%3A%2016px%3B%20font-weight%3A%20600%3B%20width%3A%20128px%3B%20max-width%3A%20100%25%3B%20cursor%3A%20pointer%3B%20float%3A%20none%3B%20position%3A%20relative%3B%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%3E%3Cdiv%3ENext%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09',
		'quiz_ads_next_button_html'=> '%0A%09%09%09%09%09%09%09%3Cdiv%20class%3D%22single_next_btn%20sqb_next_btn%20sqb_tiny_mce_editor%20mce-content-body%22%20style%3D%22display%3A%20inline-block%3B%20border-radius%3A%205px%3B%20background%3A%20%23ad4fe1%3B%20color%3A%20rgb(255%2C%20255%2C%20255)%3B%20height%3A%20auto%3B%20padding%3A%2013px%2015px%3B%20font-family%3A%20%26quot%3BDM%20Sans%26quot%3B%2C%20sans-serif%3B%20min-width%3A%2090px%3B%20box-shadow%3A%20none%3B%20margin%3A%200px%3B%20text-decoration%3A%20none%3B%20line-height%3A%20normal%3B%20border%3A%20none%3B%20text-align%3A%20center%3B%20text-transform%3A%20initial%3B%20font-size%3A%2016px%3B%20font-weight%3A%20600%3B%20width%3A%20128px%3B%20max-width%3A%20100%25%3B%20cursor%3A%20pointer%3B%20float%3A%20none%3B%20position%3A%20relative%3B%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%3E%3Cdiv%3ENext%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09',
		'quiz_outcome_pdf_button_html'=> '%0A%09%09%09%09%09%09%09%3Cdiv%20class%3D%22outcome_button_pdf%20sqb_tiny_mce_editor%20mce-content-body%22%20style%3D%22display%3A%20inline-block%3B%20border-radius%3A%205px%3B%20background%3A%20rgb(37%2C%2037%2C%2037)%3B%20color%3A%20rgb(255%2C%20255%2C%20255)%3B%20height%3A%20auto%3B%20padding%3A%2013px%2015px%3B%20font-family%3A%20%26quot%3BDM%20Sans%26quot%3B%2C%20sans-serif%3B%20min-width%3A%2090px%3B%20box-shadow%3A%20none%3B%20margin%3A%200px%3B%20text-decoration%3A%20none%3B%20line-height%3A%20normal%3B%20border%3A%20none%3B%20text-align%3A%20center%3B%20text-transform%3A%20initial%3B%20font-size%3A%2016px%3B%20font-weight%3A%20600%3B%20width%3A%20128px%3B%20max-width%3A%20100%25%3B%20cursor%3A%20pointer%3B%20float%3A%20none%3B%20position%3A%20relative%3B%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%3E%3Cdiv%3EDownload%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09',
		'temp_global_theme_enable' => 'Y',
		'sqb_set_global_theme_style_values' => array(
											"0" => array(
													'screen_name'=> 'global_screen_values',
													'mobile_css_style'=> 'undefined',
													'screen_status'=> 'Y',
													'custom_values'=> '',
													'type'=> 'global',
												),
												
											),
		'outer_style_status' => 'Y',
		'quiz_ans_tags' => 'Y',
		'category_option' => 'category_highest|-',
		'customizer_style_setting' => $customizer_style_setting,
		'all_other_options' => array(
									'email_pdf_attachment' => 'N',
									'quiz_allow_certificate' => 'N',
									'quiz_certificate_button_html' => '%0A%09%09%09%09%09%09%09%3Cdiv%20class%3D%22download_certificate_button%20sqb_tiny_mce_editor%20mce-content-body%22%20style%3D%22display%3A%20inline-block%3B%20border-radius%3A%205px%3B%20background%3A%20rgb(37%2C%2037%2C%2037)%3B%20color%3A%20rgb(255%2C%20255%2C%20255)%3B%20height%3A%20auto%3B%20padding%3A%2013px%2015px%3B%20font-family%3A%20%26quot%3BDM%20Sans%26quot%3B%2C%20sans-serif%3B%20min-width%3A%2090px%3B%20box-shadow%3A%20none%3B%20margin%3A%200px%3B%20text-decoration%3A%20none%3B%20line-height%3A%20normal%3B%20border%3A%20none%3B%20text-align%3A%20center%3B%20text-transform%3A%20initial%3B%20font-size%3A%2016px%3B%20font-weight%3A%20600%3B%20width%3A%20250px%3B%20max-width%3A%20100%25%3B%20cursor%3A%20pointer%3B%20float%3A%20none%3B%20position%3A%20relative%3B%22%20contenteditable%3D%22true%22%20spellcheck%3D%22false%22%3E%3Cdiv%3EDownload%20Certificate%3C%2Fdiv%3E%3C%2Fdiv%3E%09%09%09%09%09%09',
									'select_certificate' => 'No Certificate created',
									'download_certificate_backgroud_color' => 'rgb(255, 255, 255)',
									'speed_timer_enable' => 'N',
									'quiz_display_totaltime_html' => '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_25" contenteditable="true" spellcheck="false" style="position: relative;"><div><div style="text-align: center;" data-mce-style="text-align: center;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong>Total Time</strong></span></div><div style="text-align: center;" data-mce-style="text-align: center;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong> [SQBTimeSpent]</strong></span></div></div></div>',
									'quiz_display_heading_html' => '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_24" contenteditable="true" spellcheck="false" style="position: relative;"><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;"><strong>Display Heading</strong></span></div></div>',
									'speed_timer_text_hour_html' => '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_21" contenteditable="true" spellcheck="false" style="position: relative;"><div>HRS</div></div>',
									'speed_timer_text_mint_html' => '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_22" contenteditable="true" spellcheck="false" style="position: relative;"><div>MIN</div></div>',
									'speed_timer_text_sec_html' => '<div class="sqb_tiny_mce_editor  mce-content-body" id="mce_23" contenteditable="true" spellcheck="false" style="position: relative;"><div>SEC</div></div>',
									'st_background_color' => '#6594ad',
									'st_background_color_second' => '#6bb2af',
									'st_shadow_background_color' => '#d6caca',
									'st_spread_radius' => '15',
									'st_blur_radius' => '15',
									'st_horizontal_length' => '1',
									'st_vertical_length' => '1',
									'prevent_resubmission' => 'N',
									'sqb_block_quiz' => 'browser',
									'show_image_block_quiz' => 'N',
									'add_quiz_block_icon' => '',
									'block_edit_message' => '<div>Thanks! You have already submitted this quiz.</div>',
									'question_pagination_count' => '5',
									'qns_category_order' => '5',
									'buffer_on_load' => 'N',
									'interactive_video_autoplay' => 'Y',
									'click_to_unmute' => 'N',
									'same_page_option' => 'no_next_button',
									'show_category_link' => 'Y',
									'show_category_link_color' => '#000000',
									'sqb_button_template' => 'sqb-btn-template-3',
									'sqb_button_template_optin' => 'sqb-btn-template-3',
									'startbutton_backgroud_color' => '#ff7777',
									'opt_button_backgroud_color' => '#ff7777',
								),

		 'all_background_color' => array(
            'next_button_settings_background_color' => 'rgba(79,108,191,1)',
            'sqb_global_inner_background_color_template8' => 'rgba(255,249,249,1)',
            'sqb_enable_inner_customizer_template8' => 'Y',
            'sqb_global_inner_padding_template8' => '52',
            'sqb_global_inner_width_template8' => '836',

            'sqb_global_shadow_background_color_enable' => get_default_global_settings('sqb_global_shadow_background_color_enable',$jsonArray['template']),
            'sqb_global_shadow_spread_radius_enable' => get_default_global_settings('sqb_global_shadow_spread_radius_enable',$jsonArray['template']),
            'sqb_global_shadow_spread_radius' => get_default_global_settings('sqb_global_shadow_spread_radius',$jsonArray['template']),
            'sqb_global_shadow_blur_radius_enable' => get_default_global_settings('sqb_global_shadow_blur_radius_enable',$jsonArray['template']),
            'sqb_global_temp_shadow_horizontal_length_enable' => get_default_global_settings('sqb_global_temp_shadow_horizontal_length_enable',$jsonArray['template']),
            'sqb_global_shadow_horizontal_length_enable' => get_default_global_settings('sqb_global_shadow_horizontal_length_enable',$jsonArray['template']),
            'sqb_global_shadow_horizontal_length' => get_default_global_settings('sqb_global_shadow_horizontal_length',$jsonArray['template']),
            'sqb_global_shadow_background_color' => get_default_global_settings('sqb_global_shadow_background_color',$jsonArray['template']),
            'sqb_global_shadow_blur_radius' => get_default_global_settings('sqb_global_shadow_blur_radius',$jsonArray['template']),

            'next_button_settings_background_hover_color' => get_default_global_settings('next_button_settings_background_hover_color',$jsonArray['template']),
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
            'setting_progress_color' => get_default_global_settings('setting_progress_color',$jsonArray['template']),
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
            'sqb_global_outer_width' => get_default_global_settings('sqb_global_outer_width',$jsonArray['template']),
            'sqb_global_inner_width' => '900',
            'sqb_selected_global_height' => get_default_global_settings('sqb_selected_global_height',$jsonArray['template']),
            'sqb_global_height_input' => get_default_global_settings('sqb_global_height_input',$jsonArray['template']),
            'sqb_global_background_color' => get_default_global_settings('sqb_global_background_color',$jsonArray['template']),
            'sqb_global_inner_background_color' => get_default_global_settings('sqb_global_inner_background_color',$jsonArray['template']),
            'sqb_global_background_image' => get_default_global_settings('sqb_global_background_image',$jsonArray['template']),
            'sqb_global_background_image_url' => get_default_global_settings('sqb_global_background_image_url',$jsonArray['template']),
            'sqb_global_title_color_enable' => 'Y',
            'sqb_global_title_color' => get_default_global_settings('sqb_global_title_color',$jsonArray['template']),
            'sqb_global_title_font_family_enable' => 'Y',
            'sqb_global_title_font_family' => 'DM Sans',
            'sqb_global_title_line_height_enable' => 'Y',
            'sqb_global_title_line_height' => get_default_global_settings('sqb_global_title_line_height',$jsonArray['template']),
            'sqb_global_title_font_size_enable' => 'Y',
            'sqb_global_title_font_size' => get_default_global_settings('sqb_global_title_font_size',$jsonArray['template']),
            'sqb_global_title_font_weight' => get_default_global_settings('sqb_global_title_font_weight',$jsonArray['template']),
            'sqb_global_description_color_enable' => 'Y',
            'sqb_global_description_color' => get_default_global_settings('sqb_global_description_color',$jsonArray['template']),
            'sqb_global_description_font_size_enable' => 'Y',
            'sqb_global_description_font_size' => get_default_global_settings('sqb_global_description_font_size',$jsonArray['template']),
            'sqb_global_description_font_weight' => get_default_global_settings('sqb_global_description_font_weight',$jsonArray['template']),
            'sqb_global_description_font_family_enable' => 'Y',
            'sqb_global_description_font_family' => 'DM Sans',
            'sqb_global_question_ans_color_enable' => 'Y',
            'sqb_global_ans_background_color_enable' => get_default_global_settings('sqb_global_ans_background_color_enable',$jsonArray['template']),
            'sqb_global_ans_border_width_enable' => get_default_global_settings('sqb_global_ans_background_color_enable',$jsonArray['template']),
            'sqb_global_ans_text_hover_color_enable' => get_default_global_settings('sqb_global_ans_text_hover_color_enable',$jsonArray['template']),
            'sqb_global_ans_background_hover_color_enable' => get_default_global_settings('sqb_global_ans_background_hover_color_enable',$jsonArray['template']),
            'sqb_global_selected_ans_color' => get_default_global_settings('sqb_global_selected_ans_color',$jsonArray['template']),
            'sqb_global_question_ans_color' => get_default_global_settings('sqb_global_question_ans_color',$jsonArray['template']),
            'sqb_global_ans_background_color' => '#e5f1ff',
            'sqb_global_ans_border_radius_color' => '#ffffff',
            'sqb_global_ans_border_radius_hover_color' => get_default_global_settings('sqb_global_ans_border_radius_hover_color',$jsonArray['template']),
            'sqb_global_ans_text_hover_color' => '#ffffff',
            'sqb_global_ans_background_hover_color' => get_default_global_settings('sqb_global_ans_background_hover_color',$jsonArray['template']),
            'sqb_global_question_ans_font_size_enable' => 'Y',
            'sqb_global_question_ans_font_size' => get_default_global_settings('sqb_global_question_ans_font_size',$jsonArray['template']),
            'sqb_global_ans_border_width' => '2',
            'sqb_global_question_ans_font_family_enable' => 'Y',
            'sqb_global_button_font_family_enable' => 'Y',
            'sqb_global_question_ans_font_family' => 'DM Sans',
            'sqb_global_button_font_family' => 'DM Sans',
            'sqb_global_question_ans_font_weight' => get_default_global_settings('sqb_global_question_ans_font_weight',$jsonArray['template']),
            'sqb_global_ans_border_radius_color_enable' => 'Y',
            'sqb_global_ans_border_radius_hover_color_enable' => get_default_global_settings('sqb_global_ans_border_radius_hover_color_enable',$jsonArray['template']),
            'sqb_global_background_enable' => 'N',
            'sqb_global_background' => '#ffffff',
            'sqb_global_border_color_enable' => 'Y',
            'sqb_global_border_color' => get_default_global_settings('sqb_global_border_color',$jsonArray['template']),
            'sqb_global_border_style_enable' => 'Y',
            'sqb_global_border_style' => 'solid',
            'sqb_global_border_width_enable' => 'Y',
            'sqb_global_border_width' => get_default_global_settings('sqb_global_border_width',$jsonArray['template']),
            'startscreen_button_background_color' => get_default_global_settings('startscreen_button_background_color',$jsonArray['template']),
            'setting_category_background_color' => 'rgba(255,255,255,1)',
            'category_title_font_family' => '\\',
            'category_title_font_size' => '20',
            'category_title_font_color' => '#000000',
            'category_desc_font_family' => '\\',
            'category_desc_font_size' => '16',
            'category_desc_font_color' => '#000000',
            'category_bottom_margin' => '20',
            'category_padding' => '20',
            'sqb_global_padding' => get_default_global_settings('sqb_global_padding',$jsonArray['template']),
            'top_bar_background_color' => 'rgba(245, 102, 64, 1)',
            'next_btn_html' => '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background-color: #252525; color: #fff; height: auto; padding: 12px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 100px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>',
            'skip_btn_html' => '<div class="skipped_btn skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: &#39;DM Sans&#39;,sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>',
            'back_btn_html' => '<div class="single_back_btn sqb_back_btn sqb_tiny_mce_editor mce-content-body" style="display: inline-block;border-radius: 5px;background: #000000;color: #ffffff;height: auto;padding: 12px 15px;font-family: &#39;DM Sans&#39;, sans-serif;min-width: 90px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Back</div></div>',
        ),
	);
	
	//echo '<pre>';print_r($form_data);
   	$response = SQBSaveQuizAjax($form_data);
   	$quiz_id = $response['quiz_id'];
   	return $quiz_id;
}

function create_questions($questions){
	SQBSaveQuizAjax($questions);
}

function create_outcome($outcome){
	return sqb_outcometemp($outcome);
}

function outcome_data($content, $template, $quiz_type){
	if($template == 'template5'){
		$temp = $template;
		$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/result/" . $temp . "/" . $temp . ".php");			
	}else{
		$temp = 'template2';
		$file = (WP_PLUGIN_DIR . "/smartquizbuilder/includes/templates/result/" . $temp . "/tempaiquiz.php");			
	}
	
	$outcome_title = $outcome_html['outcome_title'];
	$randval = rand(1,100);
	$image_not_found = plugins_url()."/smartquizbuilder/includes/images/image_not_found.png";	
	$img_url = plugins_url()."/smartquizbuilder/includes/images/outcome2.jpg";
	$file = file_get_contents($file);
	$file = str_replace("%%IMGURL%%" , $img_url ,$file);
	$curernt_data_time_random =  date('y_m_d_h_m_s').rand(10,1000);
	$file = str_replace("%%CURRENTDATETIMERANDOMIMG%%" , $curernt_data_time_random ,$file);
	$file = str_replace("%%IMGNOTFOUND%%" , $image_not_found ,$file);

	if($template == 'template1'){
		$file = str_replace('<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgba(255,208,46,1);"><div>Continue</div></div>' , '<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgb(255, 119, 119)"><div>Continue</div></div>' ,$file);
	}else if($template == 'template2'){
		$file = str_replace("Quiz-Template result_temp_outer personality_temp quiz_comon_template" , 'Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style1' ,$file);
		$file = str_replace('<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgba(255,208,46,1);"><div>Continue</div></div>' , '<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgb(255, 119, 119)"><div>Continue</div></div>' ,$file);
	}else if($template == 'template3'){
		$file = str_replace("Quiz-Template result_temp_outer personality_temp quiz_comon_template" , 'Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style2' ,$file);
		$file = str_replace('<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgba(255,208,46,1);"><div>Continue</div></div>' , '<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgb(255, 119, 119)"><div>Continue</div></div>' ,$file);
	}else if($template == 'template4'){
		$file = str_replace('<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgba(255,208,46,1);"><div>Continue</div></div>' , '<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgb(255, 119, 119)"><div>Continue</div></div>' ,$file);
	}else if($template == 'template8'){
		$file = str_replace("Quiz-Template result_temp_outer personality_temp quiz_comon_template" , 'Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style8' ,$file);
		$file = str_replace('<span class="sqbHideTemplateImageOuter">' , '<span class="sqbHideTemplateImageOuter" style="display:none;">' ,$file);
		$file = str_replace('<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgba(255,208,46,1);"><div>Continue</div></div>' , '<div class="take-quiz-btn sqb_outcome_tiny_mce_editor" style="max-width:700px;background-color: rgb(255, 119, 119)"><div>Continue</div></div>' ,$file);
		//$file = str_replace('<span class="sqbShowTemplateImageOuter">' , '<span class="sqbShowTemplateImageOuter" style="display:none">' ,$file);
		$file = str_replace('<div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id">' , '<div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id" style="display:none;">' ,$file);
		//$file = str_replace('<span class="sqbHideOutcomeDescriptionOuter">' , '<span class="sqbHideOutcomeDescriptionOuter" style="display:none;">' ,$file);
	}else if($template == 'template7'){
		$file = str_replace("Quiz-Template result_temp_outer personality_temp quiz_comon_template" , 'Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style7' ,$file);
		$file = str_replace('<div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id">' , '<div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id" style="display:none;">' ,$file);
		$file = str_replace('<span class="sqbHideTemplateImageOuter">' , '<span class="sqbHideTemplateImageOuter" style="display:none;">' ,$file);
		$file = str_replace('<span class="sqbShowTemplateImageOuter" style="display:none">' , '<span class="sqbShowTemplateImageOuter">' ,$file);
	}else if($template == 'template6'){
		$file = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template"> <div class="points_scored_result sqb_tiny_mce_editor   " ><div>Your Result Type is [Outcome_Title]</div> </div> <span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id"> <img class="'.$curernt_data_time_random.' sqb_img_draggable" src="'.$img_url.'" style="display:none;"> <span data-class="'.$curernt_data_time_random.'" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> </div> <div class="video-element-outer outcomeTemplateVideoOuter" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo"  data-type="outcome" >1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo"  data-type="outcome" ><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls> </video> </div> </div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <div class="sqb_tiny_mce_editor" ><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</div></div><br><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid" style="display:none;"> <div class="d-inline-block pos_relative"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor" style="background-color:rgba(255,208,46,1);"><div>Continue</div></div> </div> </div>	 </div> </div> </div>'; 
	}else if($template == 'template9'){
		$file = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template outer-style9"> <div class="points_scored_result sqb_tiny_mce_editor   " ><div>Your Result Type is [Outcome_Title]</div> </div> <span class="sqbHideTemplateImageOuter" style="display:none"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer" id="result_temp_id" style="display:none;"><img class="'.$curernt_data_time_random.' sqb_img_draggable" src="'.$img_url.'" style="display:none;"> <span data-class="'.$curernt_data_time_random.'" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> </div> <div class="video-element-outer outcomeTemplateVideoOuter" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo"  data-type="outcome" >1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo"  data-type="outcome" ><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls> </video> </div> </div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none;width:100%;"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <div class="sqb_tiny_mce_editor" ><div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s.</div></div><br> </div> <div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid" style="display:none;"> <div class="d-inline-block pos_relative"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor" style="max-width: 272px; padding-top: 16px; padding-bottom: 16px; background-color: rgb(0, 0, 0); color: rgb(255, 255, 255);"><div>Continue</div></div> </div> </div> </div> </div>';
	}

	if($quiz_type == "scoring"){
		$file = str_replace("Your Result Type is [Outcome_Title]" , 'You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%' ,$file);
	}else if($quiz_type == "survey"){
		$file = str_replace("Your Result Type is" , '' ,$file);
	}

	$content = '<div class="sqb-ai-content-formater">'.$content.'</div>';
	$file = str_replace("<div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>" , $content ,$file);

	$file = str_replace("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s." , $content ,$file);

	$output = $file;
	return $output;
}


function getSQbLang(){
	$languages = [
		'aa' => 'Afar',
		'ab' => 'Abkhazian',
		'ae' => 'Avestan',
		'af' => 'Afrikaans',
		'ak' => 'Akan',
		'am' => 'Amharic',
		'an' => 'Aragonese',
		'ar' => 'Arabic',
		'as' => 'Assamese',
		'av' => 'Avaric',
		'ay' => 'Aymara',
		'az' => 'Azerbaijani',
		'ba' => 'Bashkir',
		'be' => 'Belarusian',
		'bg' => 'Bulgarian',
		'bh' => 'Bihari languages',
		'bi' => 'Bislama',
		'bm' => 'Bambara',
		'bn' => 'Bengali',
		'bo' => 'Tibetan',
		'br' => 'Breton',
		'bs' => 'Bosnian',
		'ca' => 'Catalan',
		'ce' => 'Chechen',
		'ch' => 'Chamorro',
		'co' => 'Corsican',
		'cr' => 'Cree',
		'cs' => 'Czech',
		'cu' => 'Church Slavic',
		'cv' => 'Chuvash',
		'cy' => 'Welsh',
		'da' => 'Danish',
		'de' => 'German',
		'dv' => 'Divehi',
		'dz' => 'Dzongkha',
		'ee' => 'Ewe',
		'el' => 'Greek',
		'en' => 'English',
		'eo' => 'Esperanto',
		'es' => 'Spanish',
		'et' => 'Estonian',
		'eu' => 'Basque',
		'fa' => 'Persian',
		'ff' => 'Fulah',
		'fi' => 'Finnish',
		'fj' => 'Fijian',
		'fo' => 'Faroese',
		'fr' => 'French',
		'fy' => 'Western Frisian',
		'ga' => 'Irish',
		'gd' => 'Scottish Gaelic',
		'gl' => 'Galician',
		'gn' => 'Guarani',
		'gu' => 'Gujarati',
		'gv' => 'Manx',
		'ha' => 'Hausa',
		'he' => 'Hebrew',
		'hi' => 'Hindi',
		'ho' => 'Hiri Motu',
		'hr' => 'Croatian',
		'ht' => 'Haitian',
		'hu' => 'Hungarian',
		'hy' => 'Armenian',
		'hz' => 'Herero',
		'ia' => 'Interlingua',
		'id' => 'Indonesian',
		'ie' => 'Interlingue',
		'ig' => 'Igbo',
		'ii' => 'Sichuan Yi',
		'ik' => 'Inupiaq',
		'io' => 'Ido',
		'is' => 'Icelandic',
		'it' => 'Italian',
		'iu' => 'Inuktitut',
		'ja' => 'Japanese',
		'jv' => 'Javanese',
		'ka' => 'Georgian',
		'kg' => 'Kongo',
		'ki' => 'Kikuyu',
		'kj' => 'Kuanyama',
		'kk' => 'Kazakh',
		'kl' => 'Kalaallisut',
		'km' => 'Central Khmer',
		'kn' => 'Kannada',
		'ko' => 'Korean',
		'kr' => 'Kanuri',
		'ks' => 'Kashmiri',
		'ku' => 'Kurdish',
		'kv' => 'Komi',
		'kw' => 'Cornish',
		'ky' => 'Kirghiz',
		'la' => 'Latin',
		'lb' => 'Luxembourgish',
		'lg' => 'Ganda',
		'li' => 'Limburgish',
		'ln' => 'Lingala',
		'lo' => 'Lao',
		'lt' => 'Lithuanian',
		'lu' => 'Luba-Katanga',
		'lv' => 'Latvian',
		'mg' => 'Malagasy',
		'mh' => 'Marshallese',
		'mi' => 'Maori',
		'mk' => 'Macedonian',
		'ml' => 'Malayalam',
		'mn' => 'Mongolian',
		'mr' => 'Marathi',
		'ms' => 'Malay',
		'mt' => 'Maltese',
		'my' => 'Burmese',
		'na' => 'Nauru',
		'nb' => 'Norwegian Bokmål',
		'nd' => 'North Ndebele',
		'ne' => 'Nepali',
		'ng' => 'Ndonga',
		'nl' => 'Dutch',
		'nn' => 'Norwegian Nynorsk',
		'no' => 'Norwegian',
		'nr' => 'South Ndebele',
		'nv' => 'Navajo',
		'ny' => 'Chichewa',
		'oc' => 'Occitan',
		'oj' => 'Ojibwa',
		'om' => 'Oromo',
		'or' => 'Oriya',
		'os' => 'Ossetian',
		'pa' => 'Panjabi',
		'pi' => 'Pali',
		'pl' => 'Polish',
		'ps' => 'Pushto',
		'pt' => 'Portuguese',
		'qu' => 'Quechua',
		'rm' => 'Romansh',
		'rn' => 'Rundi',
		'ro' => 'Romanian',
		'ru' => 'Russian',
		'rw' => 'Kinyarwanda',
		'sa' => 'Sanskrit',
		'sc' => 'Sardinian',
		'sd' => 'Sindhi',
		'se' => 'Northern Sami',
		'sg' => 'Sango',
		'si' => 'Sinhala',
		'sk' => 'Slovak',
		'sl' => 'Slovenian',
		'sm' => 'Samoan',
		'sn' => 'Shona',
		'so' => 'Somali',
		'sq' => 'Albanian',
		'sr' => 'Serbian',
		'ss' => 'Swati',
		'st' => 'Sotho, Southern',
		'su' => 'Sundanese',
		'sv' => 'Swedish',
		'sw' => 'Swahili',
		'ta' => 'Tamil',
		'te' => 'Telugu',
		'tg' => 'Tajik',
		'th' => 'Thai',
		'ti' => 'Tigrinya',
		'tk' => 'Turkmen',
		'tl' => 'Tagalog',
		'tn' => 'Tswana',
		'to' => 'Tonga (Tonga Islands)',
		'tr' => 'Turkish',
		'ts' => 'Tsonga',
		'tt' => 'Tatar',
		'tw' => 'Twi',
		'ty' => 'Tahitian',
		'ug' => 'Uighur',
		'uk' => 'Ukrainian',
		'ur' => 'Urdu',
		'uz' => 'Uzbek',
		've' => 'Venda',
		'vi' => 'Vietnamese',
		'vo' => 'Volapük',
		'wa' => 'Walloon',
		'wo' => 'Wolof',
		'xh' => 'Xhosa',
		'yi' => 'Yiddish',
		'yo' => 'Yoruba',
		'za' => 'Zhuang',
		'zh' => 'Chinese',
		'zu' => 'Zulu'
	];
	
	return $languages;
}