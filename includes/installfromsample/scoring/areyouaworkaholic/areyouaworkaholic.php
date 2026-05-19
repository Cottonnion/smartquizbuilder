<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'Are you a workaholic?'; // urldecode 
		$quiz_details_array['quiz_desc'] = "Don't Think You're a Workaholic? Prove it by Taking This Short Lil' Quiz!"; // urldecode
		$quiz_details_array['quiz_type'] = 'scoring';
		$quiz_details_array['grade_quiz'] = 'N';
		$quiz_details_array['progress_bar'] = 'N';
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
		$quiz_details_array['show_firstname_template'] = 'Y';
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
		$quiz_details_array['quick_email_verification'] = '';
		$quiz_details_array['quiz_slider_animation'] = 'N';
		$quiz_details_array['quiz_slider_animation_option'] = '';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = 'different_page';
		$quiz_details_array['transparent_background_settings'] = '%|100|px|211|'.plugins_url('').'/smartquizbuilder/includes/installfromsample/scoring/areyouaworkaholic/images/pexels-karolina-grabowska-5239879-scaled.jpg|undefined|#c75d00|0.62|50% 50%';
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
	 	$start_temp_no = 'template2';
		$start_img_url = plugins_url('')."/smartquizbuilder/includes/images/installfromsample/sqb_bt_image1.jpg";				 
		$csspath =  plugins_url('')."/smartquizbuilder/includes/templates/start/" . $start_temp_no . "/" . $start_temp_no . ".css";	 
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 	 	 
		$start_temp_html = 	$cssfile.' <div class="Quiz-Template2 start_temp_outer quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221);"> <h3 class="Quiz-Template-title sqb_tiny_mce_editor mce-content-body mce-edit-focus" id="mce_7" contenteditable="true" spellcheck="false" style="position: relative; background: none; cursor: grab;"><span style="font-size: 19pt; cursor: grabbing;" data-mce-style="font-size: 19pt;">Are you a workaholic?</span></h3> <span class="sqbHideStartTemplateImageOuter" style="display: none;"><button class="sqbHideStartTemplateImage" style="cursor: grab;">Hide Image</button></span> <span class="sqbShowStartTemplateImageOuter" style="display: inline-block;"><button class="sqbShowStartTemplateImage" style="cursor: grab;">Show Image</button></span> <div class="question_img_div ui-resizable" id="start_img_temp2" style="display: none;"> <!--span class="sqb_backend_show sqb_remove_section" data-id="start_img_temp2" ><i class="fa fa-trash-o" aria-hidden="true"></i></span--> <img class="start_img sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$start_img_url.'" style="position: relative; cursor: grab;"> <span data-class="start_img" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer startTemplateVideoOuter ui-resizable" style="display:none"> <a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a> <div class="video-add-link startTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="startTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="Quiz-Template-content"> <div class="sqb_tiny_mce_editor sqb_content mce-content-body" id="mce_8" contenteditable="true" spellcheck="false" style="position: relative; cursor: grab;"><div style="cursor: grab; text-align: center;" data-mce-style="cursor: grab; text-align: center;"><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;"><strong>Don\'t Think You\'re a Workaholic? Prove it by Taking This Short Lil\' Quiz!</strong></span></div></div> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" id="mce_9" style="background-color: rgb(141, 70, 0); position: relative; width: 334px; padding-top: 21px; padding-bottom: 21px;" contenteditable="true" spellcheck="false"><div style="cursor: grab;" data-mce-style="cursor: grab;">Let\'s Find Out &gt;&gt;&gt;</div></div> </div> </div>';
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221);"> <div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4 mce-content-body" id="mce_10" contenteditable="true" spellcheck="false" style="position: relative; background: none;"><div>Almost there...</div></div> <div class="sqb_tiny_mce_editor sqb_opt_in_h6 mce-content-body" id="mce_11" contenteditable="true" spellcheck="false" style="position: relative;"><div>Where can we email you the results? Please enter details below.</div></div> <div class="Quiz-Template-content"> <form id="sqb_direct_signup" class="sqbform" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit=""> <input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%"> <input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%"> <input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%"> <div class="form_cls"> <input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name"> <input type="email" name="email" id="email" value="" placeholder="Your Email"> <div class="sqb-checkbox termsConditionOuter" style="display:none"> <span class="checkbox-custom-style"> <input class="custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox"> <span class="custom--checkbox"></span> </span> <label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_12" contenteditable="true" spellcheck="false" style="position: relative;">By joining, you agree to the terms of service and privacy policy.</label><input type="hidden" name="mce_12"> </div> <div class="sqb-gdpr-checkbox gdpr-Outer" style="display:none"> <span class="checkbox-custom-style"> <input class="custom-checkbox-input" id="sqbgdprcheckbox" type="checkbox" name="sqbgdprcheckbox" value="sqbgdprcheckbox"> <span class="custom--checkbox"></span> </span> <label class="sqbcontrol-label sqb_tiny_mce_editor mce-content-body" id="mce_13" contenteditable="true" spellcheck="false" style="position: relative;">By checking this box, I agree I want to receive latest news, tips and occasional promotional offers.</label><input type="hidden" name="mce_13"> </div> </div> <div class="continue_btn sqb_tiny_mce_editor  mce-content-body" id="mce_14" style="background-color: rgb(255, 99, 77); position: relative;" contenteditable="true" spellcheck="false"><div>Get Started</div></div><input type="hidden" name="mce_14"> <div class="sqb_tiny_mce_editor text_privacy_policy mce-content-body" id="mce_15" contenteditable="true" spellcheck="false" style="position: relative;"><div style="text-align: center;" data-mce-style="text-align: center;">You can unsubscribe at any time.</div></div><input type="hidden" name="mce_15"> </form> </div> </div>';
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 822px; background-color: rgb(255, 255, 255)'; 
		$select_temp_class = '';
		$select_temp = 'template6';	
		$question_temp_html = '<div class="Quiz-Template '.$select_temp_class.'" data-id="" style="'.$question_template_style.'">%%QUESTIONANSWERS%%</div>';	
		$enable_branching  = 'N';	 
	
	 	$quiz_details_array['start_temp_html'] = $start_temp_html; //urldecode
	 	$quiz_details_array['result_temp_html'] = 'quiz_result_template_html';  //urldecode
	 	$quiz_details_array['question_temp_html'] = $question_temp_html;   //urldecode
	 	$quiz_details_array['optin_temp_html'] = $optin_temp_html;    //urldecode
	 	$quiz_details_array['start_template_no'] = 'template6';      
	 	$quiz_details_array['start_image'] = $start_img_url;  //urldecode
	 	$quiz_details_array['result_template_no'] = 'template6';
	 	$quiz_details_array['optin_template_no'] = 'template6';
	 	$quiz_details_array['quiz_first_name_template'] = 'quiz_first_name_template';
	 	$quiz_details_array['template_no'] = 'template6';
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
		$outcome_table_array[$oc_i]['outcome_name'] = 'hmm... looks like you don\'t like you work! ';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221); cursor: grabbing;"> <div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_245"><div><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div><div><br></div></div><div>Hey... looks like you don\'t like you work!!!</div></div> <span class="sqbHideTemplateImageOuter" style="display: inline-block;"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter" style="display: none;"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: inline-block; height: 275px;"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span--> <img class="21_09_10_05_09_14309 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'outcome2.jpg" style="position: relative; height: 275px;"> <span data-class="21_09_10_05_09_14309" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span--> <div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_246"><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Hate your work? Your job doesn\'t inspire you? </span></div><div><br></div><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Feeling stuck <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f614.svg" alt="😔" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f614.svg">?</span></div><div><br></div><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Sounds like you are doing things that you don\'t care about. Time to rethink your career startegy! </span><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">It\'s time for a change! Figure out what drives you, what motivates, what you are passionate about. You can do this <img draggable="false" role="img" class="emoji" alt="✋" src="https://s.w.org/images/core/emoji/13.1.0/svg/270b.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/270b.svg">&nbsp;</span></div></div><br> </div> <div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 700px; padding-top: 10px; padding-bottom: 10px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_247"><div><a data-mce-href="https://smartquizbuilder.com/" href="https://smartquizbuilder.com/">Continue</a></div></div> </div> </div> </div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '-1';
		$outcome_table_array[$oc_i]['range_val1'] = '-100';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		$oc_i = 1;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'You are a borderline workaholic! ';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221);"> <div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_239"><div><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div><div><br></div>You are a borderline workaholic!</div></div> <span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none; height: 275px;"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span--> <img class="21_09_10_05_09_14309 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'outcome2.jpg" style="position: relative; height: 275px;"> <span data-class="21_09_10_05_09_14309" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span--> <div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_240"><div><span style="font-size: 20px;" data-mce-style="font-size: 20px;"><span style="font-size: 20px;" data-mce-style="font-size: 20px;">Sounds like you prioritize work over other things often but you are not hopeless</span></span><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg" alt="🤔" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg" style="font-size: 15pt; background-color: rgba(255, 255, 255, 0.8);" data-mce-style="font-size: 15pt; background-color: rgba(255, 255, 255, 0.8);"><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">&nbsp;</span><div><br></div><span style="font-size: 20px;" data-mce-style="font-size: 20px;">You just have to find a little more balance between work and life. </span></div><div><br></div><div><span style="font-size: 20px;" data-mce-style="font-size: 20px;">Make time for things outside of work <span style="font-size: 15pt;" data-mce-style="font-size: 15pt;"><img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg" alt="🏖️" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg"></span></span></div><div><br></div><div><span style="font-size: 20px;" data-mce-style="font-size: 20px;">Invest in your hobbies. Make a little more time for your friends and family.&nbsp;</span></div></div><br> </div> <div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 700px; padding-top: 10px; padding-bottom: 10px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_241"><div><a data-mce-href="https://smartquizbuilder.com/" href="https://smartquizbuilder.com/">Continue</a></div></div> </div> </div> </div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '5';
		$outcome_table_array[$oc_i]['range_val1'] = '9';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		$oc_i = 2;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'You are good!';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221);"> <div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_242"><div><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div><div><br></div></div><div>Well done! You are good!</div></div> <span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none; height: 275px;"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span--> <img class="21_09_10_05_09_14309 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'outcome2.jpg" style="position: relative; height: 275px;"> <span data-class="21_09_10_05_09_14309" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span--> <div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_243"><div><span style="font-size: 20px;" data-mce-style="font-size: 20px;">Yay! Looks like you have found the perfect work-life balance, my friend <img draggable="false" role="img" class="emoji" alt="🏖️" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg"> <img draggable="false" role="img" class="emoji" alt="👨&zwj;💻" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f468-200d-1f4bb.svg" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f468-200d-1f4bb.svg">! </span></div><div><br></div><div><span style="font-size: 20px;" data-mce-style="font-size: 20px;">You love your work but not at the cost of other things. </span><span style="font-size: 20px;" data-mce-style="font-size: 20px;">Work is important to you but only as one of the activities!&nbsp;</span></div></div><br> </div> <div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 700px; padding-top: 10px; padding-bottom: 10px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_244"><div><a data-mce-href="https://smartquizbuilder.com/" href="https://smartquizbuilder.com/">Continue</a></div></div> </div> </div> </div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '0';
		$outcome_table_array[$oc_i]['range_val1'] = '4';
		$outcome_table_array[$oc_i]['correct_ans_num'] = '0';
		$outcome_table_array[$oc_i]['correct_ans_range'] = '-';
		$outcome_table_array[$oc_i]['outcome_screen'] = '';
		$outcome_table_array[$oc_i]['redirect'] = '';
		$outcome_table_array[$oc_i]['tag'] = '';
		$outcome_table_array[$oc_i]['enable_outcome_background_image'] = 'N';
		$outcome_table_array[$oc_i]['date'] = $current_data_time;
		$outcome_table_array[$oc_i]['outcome_div_id'] = $oc_i;
		
		$oc_i = 3;
		$outcome_table_array[$oc_i]['quiz_id'] = $quiz_details['quiz_id'];
		$outcome_table_array[$oc_i]['outcome_name'] = 'Yes, you are a workaholic! ';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 970px; box-shadow: rgb(255, 255, 255) 0px 0px 0px 0px; background-color: rgba(255, 255, 255, 0.96); border-color: rgb(221, 221, 221);"> <div class="points_scored_result sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_236"><div>You got a score of %%YOURSCORE%% out of %%TOTALSCORE%%</div></div> <span class="sqbHideTemplateImageOuter" style="display: none;"><button class="sqbHideTemplateImage">Hide Image</button></span> <span class="sqbShowTemplateImageOuter" style="display: inline-block;"><button class="sqbShowTemplateImage">Show Image</button></span> <div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="display: none; height: 275px;"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_id"><i class="fa fa-close" aria-hidden="true"></i></span--> <img class="21_09_10_05_09_14309 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'outcome2.jpg" style="position: relative; height: 275px;"> <span data-class="21_09_10_05_09_14309" class="question_img_upload sbq_change_img "><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="outcome_video_url" value=""> <input type="hidden" class="outcome_show_video" value="N"> <input type="hidden" class="outcome_video_link_type" value="0"> <input type="hidden" class="outcome_video_link_type_text" value="Source"> <input type="hidden" class="outcome_video_aspect" value="1"> <a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a> <div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="outcomeTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="Quiz-Template-content"> <span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span> <span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span> <div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"> <!--span class="sqb_backend_show sqb_remove_section" data-id="result_temp_contentid"><i class="fa fa-close" aria-hidden="true"></i></span--> <div class="sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false" id="mce_237"><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Uh oh! You are a workaholic <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg" alt="🤔" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f914.svg">&nbsp;</span></div><div><br></div><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">You’ve been told by others to cut down on work without listening to them. You become stressed if you’re prohibited from working. You deprioritize hobbies, leisure activities, and exercise because of your work.</span></div><div><br></div><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Time to take a little break, my friend! Plan a vacation <img class="emoji" role="img" draggable="false" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg" alt="🏖️" data-mce-src="https://s.w.org/images/core/emoji/13.1.0/svg/1f3d6.svg">&nbsp;</span></div><div><br></div><div><span style="font-size: 15pt;" data-mce-style="font-size: 15pt;">Step away for a little. It\'ll all be there when you get back!&nbsp;</span></div></div><br> </div> <div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"> <span class="sqb_backend_show sqb_remove_section" data-id="result_temp_btnid"><i class="fa fa-close" aria-hidden="true"></i></span> <div class="take-quiz-btn sqb_tiny_mce_editor mce-content-body" contenteditable="true" style="position: relative; width: 700px; padding-top: 10px; padding-bottom: 10px; background-color: rgb(255, 99, 77);" spellcheck="false" id="mce_238"><div><a data-mce-href="https://smartquizbuilder.com/" href="https://smartquizbuilder.com/">Continue</a></div></div> </div> </div> </div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '10';
		$outcome_table_array[$oc_i]['range_val1'] = '100';
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
		
		$question_bank_array = array();
		$qb_i = 0;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>You wake up in the middle of the night...</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>'; //urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'You wake up in the middle of the night...
';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '7';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
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
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You pick up your phone - watch videos, check social feed, text friends, etc. You don\'t think about work.</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You pick up your phone - watch videos, check social feed, text friends, etc. You don\'t think about work.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Time to get some more work done! You open your laptop and start working again!</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Time to get some more work done! You open your laptop and start working again!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You try to fall asleep</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You try to fall asleep';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			// set answer for zero index question end
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
			
		$qb_i = 1;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>You wake up with a fever...</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'You wake up with a fever...';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '6';
		$question_bank_array[$qb_i]['ans_with_img'] = 'N';
		$question_bank_array[$qb_i]['multiple_correct_ans'] = 'N';
		$question_bank_array[$qb_i]['ans_layout'] = 'standard';
		$question_bank_array[$qb_i]['show_correct_inccorect_ans_checkbox'] = 'Y';
		$question_bank_array[$qb_i]['temp_customizer'] = '822px';
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
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Stay home and rest</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Stay home and rest';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Tell your boss you\'ll work from home</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Tell your boss you\'ll work from home';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You take a fever med and go to work! How else will work get done... Right?</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'You take a fever med and go to work! How else will work get done... Right?';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
		// set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 2;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>Your favorite hobby is...</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Your favorite hobby is...';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '5';
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
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Working</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Working';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
					
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Working out</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Working out';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Watching Netflix</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Watching Netflix';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Several hobbies</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Several hobbies';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			

		
		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 3;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title mce-content-body" style="background: none; position: relative;" contenteditable="true" spellcheck="false" id="mce_169"><div><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>When was your last real vacation where you took a week off from work and didn\'t work at all?</strong></span></div></div> <span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span> <span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span> <span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span> <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'images/sqb_quiz.png">Add Image</button></span> <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_8_1631318058002_6887" style="display: none;"> <img class="sqb_img_draggable sbq_img_2021_8_1631318058002_6887 ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'sqb_quiz.png" style="position: relative;"> <span data-class="sbq_img_2021_8_1631318058002_6887" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"> <input type="hidden" class="question_video_url" value=""> <input type="hidden" class="question_show_video" value="N"> <input type="hidden" class="question_video_link_type" value="0"> <input type="hidden" class="question_video_link_type_text" value="Source"> <input type="hidden" class="question_video_aspect" value="1"> <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a> <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"> <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a> </div> <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"> <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe> </div> <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"> <video width="400" controls=""> </video> </div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span> <span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span> <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" contenteditable="true" spellcheck="false" style="position: relative; display: none;" id="mce_170"><div>Enter any additional information about the quiz.</div></div> </div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'When was your last real vacation where you took a week off from work and didn\'t work at all?';
		$question_bank_array[$qb_i]['question_type'] = 'single';
		$question_bank_array[$qb_i]['question_image'] = 'image';
		$question_bank_array[$qb_i]['order'] = '4';
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
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 3 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$aqt_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">2-3 months ago</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="-1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = '2-3 months ago';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '-1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">6 months ago</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="0"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = '6 months ago';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Around a year ago</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Around a year ago';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '1';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			

			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">More than a year ago</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="2"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'More than a year ago';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '2';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			

			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="background: rgb(141, 70, 0); position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90; display: block;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body mce-edit-focus" contenteditable="true" style="position: relative; color: rgb(255, 255, 255);" spellcheck="false" id="mce_215"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: rgb(255, 255, 255);" data-mce-style="position: relative; color: #ffffff;"><div style="position: relative; color: #ffffff;" data-mce-style="position: relative; color: #ffffff;"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I don\'t believe in vacations</span></div></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="3"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I don\'t believe in vacations';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '3';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
		// set answer for 3 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 4;
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
			
			
			
			
		// set answer for 4 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		


		/*--------------------*/
		$qb_i = 5;
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


		/*--------------------------*/
		$qb_i = 6;
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

		/*----------------*/

		$qb_i = 7;
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
			
		// set answer for 4 index question end 
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
	
	
