<?php
	$current_data_time =  date('Y-m-d H:i:s');
	$quiz_details_array = array();
	// set variable for quiz table start 
		$pre_built_name = $theme_name;
		$pre_built_version = $theme_version;
		
		$quiz_details_array['quiz_name'] = 'What Type of Online Course Should You Create?'; // urldecode 
		$quiz_details_array['quiz_desc'] = 'Take this quiz to find out exactly what type of online course is  right for you!'; // urldecode
		$quiz_details_array['quiz_type'] = 'personality';
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
		$quiz_details_array['quick_email_verification'] = '';
		$quiz_details_array['quiz_slider_animation'] = 'N';
		$quiz_details_array['quiz_slider_animation_option'] = '';
		$quiz_details_array['result_display_option'] = 'different_page';
		$quiz_details_array['questions_top_border'] = 'different_page';
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
		$start_temp_html = 	$cssfile.' <div class="Quiz-Template2 start_temp_outer quiz_comon_template" style="max-width: 727px;"><h3 class="Quiz-Template-title sqb_tiny_mce_editor"><span style="font-size: 19pt;" data-mce-style="font-size: 19pt;"><strong>What Type of Online Course Should You Create?</strong></span></h3><span class="sqbHideStartTemplateImageOuter"><button class="sqbHideStartTemplateImage">Hide Image</button></span><span class="sqbShowStartTemplateImageOuter" style="display:none"><button class="sqbShowStartTemplateImage">Show Image</button></span><div class="question_img_div " id="start_img_temp2"> <img class="start_img sqb_img_draggable" src="'.$start_img_url.'" ><span data-class="start_img" class="question_img_upload sbq_change_img" ><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer startTemplateVideoOuter" style="display:none"><a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a><div class="video-add-link startTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="startTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div><div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none"><video width="400" controls></video></div></div><div class="Quiz-Template-content"><div class="sqb_tiny_mce_editor sqb_content"><div style="text-align: center;" data-mce-style="text-align: center;"><span style="font-size: 17pt;" data-mce-style="font-size: 17pt;">Take this short quiz to find out EXACTLY what TYPE</span></div><div style="text-align: center;" data-mce-style="text-align: center;"><span style="font-size: 17pt;" data-mce-style="font-size: 17pt;">of Digital Course you should be Creating!</span></div></div><div class="take-quiz-btn sqb_tiny_mce_editor "><div>TAKE THIS QUIZ</div></div></div></div>';
	
		 //optin template  
		$optin_temp_html = '<div class="Quiz-Optin-Template quiz_comon_template"><div class="Quiz-Template-title sqb_tiny_mce_editor sqb_opt_in_h4"><div>Almost there...</div></div><div class="sqb_tiny_mce_editor sqb_opt_in_h6" ><div>Where can we email you the results with a full assessment of the type of course you should be creating and why? Please enter details below.</div></div><div class="Quiz-Template-content"> <form id="sqb_direct_signup" class="sqbform" name="sqb_direct_signup" method="post" action="%%FORM_ACTION%%" onsubmit=""><input type="hidden" id="productId" name="productId" value="%%PRODUCTID%%"/><input type="hidden" id="signup_way" name="signup_way" value="%%SIGNUPWAY%%"/><input type="hidden" id="current_page" name="current_page" value="%%CURRENTPAGE%%"/><div class="form_cls"><input type="text" class="required" name="first_name" id="first_name" value="" placeholder="Your Name"> <input type="email" name="email" id="email" value="" placeholder="Your Email"><div class="sqb-checkbox termsConditionOuter" style="display:none"><span class="checkbox-custom-style"><input class="required custom-checkbox-input" id="sqbcheckbox" type="checkbox" name="sqbcheckbox" value="sqbcheckbox"><span class="custom--checkbox"></span></span><label class="sqbcontrol-label sqb_tiny_mce_editor" > <div>By joining, you agree to the terms of service and privacy policy.</div></label></div></div><div class="continue_btn sqb_tiny_mce_editor "><div>Get Started</div></div><div class="sqb_tiny_mce_editor text_privacy_policy" > <div style="text-align: center;" data-mce-style="text-align: center;">You can unsubscribe at any time.</div></div></form> </div></div>';
		
		// result  template 
		$result_temp_html = 'result_temp';
		
		// Question template 	 
		$question_template_style = 'max-width: 822px; background-color: rgb(255, 255, 255)'; 
		$select_temp_class = '';
		$select_temp = 'template1';	
		$question_temp_html = '<div class="Quiz-Template '.$select_temp_class.'" data-id="" style="'.$question_template_style.'">%%QUESTIONANSWERS%%</div>';	
		$enable_branching  = 'Y';	 
	
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
		$outcome_table_array[$oc_i]['outcome_name'] = 'Transformation Course';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 750px; border-width: 0px; text-align: left; border-style: solid; box-shadow: rgb(218, 217, 217) 0px 0px 5px 0px;"> <div class="points_scored_result sqb_tiny_mce_editor " ><div>You should create a [Outcome_Title]</div></div><span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 263px;"><img class="21_07_25_12_07_0182 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'installfromsample/transformation-course.jpg" style="position: relative; height: 263px; width: 690px;"><span data-class="21_07_25_12_07_0182" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'installfromsample/transformation-course.jpg"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor " ><p><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">A transformation course is typically a main offer in a sales funnel. </span></p><p><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">So if you already have a funnel with a lead magnet and an introductory course (or a low-cost product), a course that costs anywhere from $99-$499 (mid-range) will be a great fit as the main offer in your funnel!</span></p><p><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">A transformation course is where you deep dive into a specific topic in a step-by-step way, and help your students implement and get results. You are there with them throughout the process keeping them engaged, answering questions and helping them make progress.&nbsp;</span></p><div><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">This type of course will help you replace your one-to-one work and help you move towards a membership offer.&nbsp;&nbsp;</span></div><div><br></div><div><ul><li><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">Keep in mind this type of course will take more time (2-3 months) to create than an introductory course. And if it\'s a course that you launch and then shutdown (not an evergreen course), then you need to be prepared to spend a lot of time with your students answering questions and help them with implementation during the 4-6 weeks duration when students are taking the course.</span></li></ul></div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '';
		$outcome_table_array[$oc_i]['range_val1'] = '';
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
		$outcome_table_array[$oc_i]['outcome_name'] = 'FREE Lead Magnet Course';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 750px; border-width: 0px; text-align: left; border-style: solid; box-shadow: rgb(218, 217, 217) 0px 0px 5px 0px;"> <div class="points_scored_result sqb_tiny_mce_editor " ><div>You should create a [Outcome_Title]</div></div><span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 267.844px; width: 698px;"><img class="21_07_24_03_07_10915 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'installfromsample/lead-magnet-1.jpg" style="position: relative; height: 267.844px; width: 690px; left: 1px; top: -1px;"><span data-class="21_07_24_03_07_10915" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'installfromsample/lead-magnet-1.jpg"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor "  ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">As you currently don\'t have an audience, the best place to start is with a short course that you can offer as a lead magnet! It\'ll help you build your list and grow your audience.</span></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">And it\'s very easy to create a lead magnet course. Just a short course (3-5 videos) that you can put together in say less than a week. Teach one thing from start to finish but keep the videos short (5-6 mins long) so the entire course can be completed in 20 mins or less!</span></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You\'ll find my lead magnet course here:</span></div><div><a data-mce-href="https://MembershipSiteLab.com" href="https://MembershipSiteLab.com"><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">https://MembershipSiteLab.com</span></a></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">In fact, even the course signup is actually a lead magnet quiz. Users answer a bunch of questions to signup for my FREE lead magnet course. It gives me valuable data and insights about my prospects and their specific needs and challenges.</span></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">You can do the same for your lead magnet course. It\'ll help you learn more about your audience, build trust and a deeper connection, and then use the insights to create paid courses.&nbsp;</span></div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '-';
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
		$outcome_table_array[$oc_i]['outcome_name'] = 'Introductory Course';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 750px; border-width: 0px; text-align: left; border-style: solid; box-shadow: rgb(218, 217, 217) 0px 0px 5px 0px;"> <div class="points_scored_result sqb_tiny_mce_editor " ><div>You should create an [Outcome_Title]</div></div><span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 267.766px; width: 694px;"><img class="21_07_24_10_07_33551 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'installfromsample/introductorycourse.jpg" style="position: relative; height: 267.766px; width: 690px; left: 2px; top: -3px;"><span data-class="21_07_24_10_07_33551" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'installfromsample/introductorycourse.jpg"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor " ><div><p><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">An introductory course is paid course that\'s designed convert your free users into paying customers! It should deliver a quick win for your students and help build trust. You can charge anywhere from $29 to $99 for this course.&nbsp;</span></p></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">This will allow you to give your students a taste of your content, your teaching style, etc. It\'ll help them figure out if they want to purchase your higher-priced courses or signup for your coaching program.</span></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">The main thing is to nail down the content for your introductory course because the goal is to lead your students to your next level offer.&nbsp;</span></div><div><br></div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Say the main course is "<strong>How to Build and Launch a Digital Course" </strong>where you go into step-by-step details of building a digital course , then your introductory course could be "<strong>How to Build an Audience for your Course</strong>" .<strong>&nbsp;</strong>This is related to your main course and will help you move people into your deeper work.&nbsp;</span></div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '';
		$outcome_table_array[$oc_i]['range_val1'] = '';
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
		$outcome_table_array[$oc_i]['outcome_name'] = 'Signature Course';
		$outcome_table_array[$oc_i]['outcome_html'] = '<div class="Quiz-Template result_temp_outer personality_temp quiz_comon_template" style="max-width: 750px; border-width: 0px; text-align: left; border-style: solid; box-shadow: rgb(218, 217, 217) 0px 0px 5px 0px;"> <div class="points_scored_result sqb_tiny_mce_editor " ><div>You should create a [Outcome_Title]</div></div><span class="sqbHideTemplateImageOuter"><button class="sqbHideTemplateImage">Hide Image</button></span><span class="sqbShowTemplateImageOuter" style="display:none"><button class="sqbShowTemplateImage">Show Image</button></span><div class="question_img_div Quiz-Template-image img_outer ui-resizable" id="result_temp_id" style="height: 262px; width: 693px;"><img class="21_07_25_11_07_05439 sqb_img_draggable ui-draggable ui-draggable-handle" src="'.$sqb_img_folder_url.'installfromsample/singature-course.jpg" style="position: relative; height: 262px; left: 0px; top: -3px; width: 690px;"><span data-class="21_07_25_11_07_05439" class="question_img_upload sbq_change_img " src="'.$sqb_img_folder_url.'installfromsample/singature-course.jpg"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer outcomeTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="outcome_video_url" value=""><input type="hidden" class="outcome_show_video" value="N"><input type="hidden" class="outcome_video_link_type" value="0"><input type="hidden" class="outcome_video_link_type_text" value="Source"><input type="hidden" class="outcome_video_aspect" value="1"><a href="javascript:void(0)" class="outcomeTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="outcome">1</a><div class="video-add-link outcomeTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertOutcomeVideo" data-type="outcome"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="outcomeTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper outcomeTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><div class="Quiz-Template-content"><span class="sqbHideOutcomeDescriptionOuter"><button class="sqbHideOutcomeDescription">Hide Description</button></span><span class="sqbShowOutcomeDescriptionOuter" style="display:none"><button class="sqbShowOutcomeDescription">Show Description</button></span><div class="Quiz-Template-content-inn pos_relative " id="result_temp_contentid"><div class="sqb_tiny_mce_editor " ><div><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">A signature course provides highest transformation and comes with access to live calls, community/private group etc for additional support during the implementation phase. This type of course typically averages between 6-8 weeks and can take you 3-4 months or even longer to create.&nbsp;</span></div><div><br></div><div><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">This is the type of course you can sell for anywhere from $999-$1999! For e.g., the List Building Course or the Digital Course Academy type of courses from Amy Porterfield.&nbsp;</span></div><div><br></div><div><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">If you are just starting out, this is not the type of course you should be creating. This type of course is a natural progression for someone with experience creating other types of shorter paid courses and already has an audience.&nbsp;</span></div><div><br></div><div><span style="font-size: 13pt; color: rgb(0, 0, 0);" data-mce-style="font-size: 13pt; color: #000000;">The course will provide a step-by-step blueprint but the course will have to deliver on it\'s promise and you will have to be more involved into this type of course to keep your students engaged otherwise you\'ll have a very high refund rate.&nbsp;</span></div></div><br></div><div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid"></div></div></div>';
		$outcome_table_array[$oc_i]['outcome_html'] = base64_encode(urlencode($outcome_table_array[$oc_i]['outcome_html']));
		$outcome_table_array[$oc_i]['number_val'] = '0';
		$outcome_table_array[$oc_i]['range_val'] = '';
		$outcome_table_array[$oc_i]['range_val1'] = '';
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
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title  mce-edit-focus"  ><h1 class="main__question-title___98G9V"><strong>What is your main goal at this point?</strong></h1></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627244659425_1630" style="display: none;"><span data-class="sbq_img_2021_6_1627244659425_1630" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style="display: none;"><div>Enter any additional information about the quiz</div></div></div>'; //urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'What is your main goal at this point?';
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
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		// set answer for 0 index question start
		    
		    
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array = array(); 	
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor  mce-edit-focus" ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Build an audience and grow my email list.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox"=""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div><span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Build an audience and grow my email list.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I have a small audience. I want to quit my job and use my business to replace my income.&nbsp;</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I have a small audience. I want to quit my job and use my business to replace my income.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I want to replace my one-to-one work.&nbsp;</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I want to replace my one-to-one work.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Automate everything and create passive revenue streams.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Automate everything and create passive revenue streams.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor "><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Become well-known in my niche!</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Become well-known in my niche!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			// set answer for zero index question end
			$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
			
			
		$qb_i = 1;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><h1 class="main__question-title___98G9V"><strong>How much time can you dedicate to helping your students after your launch?</strong></h1></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627244659425_1630" style="display: none;"><span data-class="sbq_img_2021_6_1627244659425_1630" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style="display: none;"><div>Enter any additional information about the quiz</div></div></div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'How much time can you dedicate to helping your students after your launch?';
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
		$question_bank_array[$qb_i]['skip_outcome_mapping'] = 'Y';
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 1 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">At this time, I\'m focused on building my list and don\'t want to spend too much time helping people with implementation. That\'s for my paid courses.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = ' At this time, I\'m focused on building my list and don\'t want to spend too much time helping people with implementation. That\'s for my paid courses.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Not much time. Maybe 2-3 weeks as I want to continue to add more courses and products.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Not much time. Maybe 2-3 weeks as I want to continue to add more courses and products.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'m happy to spend 4-5 weeks helping my students with any questions and implementation after I launch it.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'m happy to spend 4-5 weeks helping my students with any questions and implementation after I launch it.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor "><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'m happy to spend 6-8 weeks helping my students get results!</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'m happy to spend 6-8 weeks helping my students get results!';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'m in it for the long term! I\'ll be available not just during the course launch but also after to continue to help and support them.&nbsp;</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'m in it for the long term! I\'ll be available not just during the course launch but also after to continue to help and support them. ';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
		// set answer for 1 index question end
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 2;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><div><strong>Are you new to online business?</strong></div></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627240479560_4707" style="display: none;"><span data-class="sbq_img_2021_6_1627240479560_4707" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style=" display: none;"><div>Enter any additional information about the quiz</div></div></div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Are you new to online business?﻿';
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
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 2 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor "><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Yes, I\'m just starting out.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Yes, I\'m just starting out.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
					$coutcome_selected_ids[] = $outcome_output['ids'][1];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Relatively new. I started a few months ago.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'Relatively new. I started a few months ago.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
					$coutcome_selected_ids[] = $outcome_output['ids'][1];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'ve been doing this from a few years and but no paid courses yet.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'ve been doing this from a few years and but no paid courses yet.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][2])){
					$coutcome_selected_ids[] = $outcome_output['ids'][2];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'ve done a few courses already but time to get to the next level.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'ve done a few courses already but time to get to the next level.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
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
			
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I\'m an expert and doing well.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I\'m an expert and doing well.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][3])){
					$coutcome_selected_ids[] = $outcome_output['ids'][3];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
		
		// set answer for 2 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 3;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title "><h1 class="main__question-title___98G9V"><strong>Do you have an email list yet?</strong></h1></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627241119052_1039" style="display: none;"><span data-class="sbq_img_2021_6_1627241119052_1039" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor " style=" display: none;"><div>Enter any additional information about the quiz</div></div></div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'Do you have an email list yet?﻿';
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
		$question_bank_array[$qb_i]['question_next_button_html'] = '';// urldecode
		$question_bank_array[$qb_i]['date'] = $current_data_time;
		
		// set answer for 3 index question start 
			$answer_table_array = array(); 	
			$at_i = 0;
			$aqt_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">No audience / list yet.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'No audience / list yet.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
					$coutcome_selected_ids[] = $outcome_output['ids'][1];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">A small list ( 0 - 200)&nbsp;</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A small list ( 0 - 200) ';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
					$coutcome_selected_ids[] = $outcome_output['ids'][1];
				}
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][2])){
					$coutcome_selected_ids[] = $outcome_output['ids'][2];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">A medium-size list (200 - 1000)</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A medium-size list (200 - 1000)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][0])){
					$coutcome_selected_ids[] = $outcome_output['ids'][0];
				}
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][2])){
					$coutcome_selected_ids[] = $outcome_output['ids'][2];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">A big list (1001 - 10000)</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A big list (1001 - 10000)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][0])){
					$coutcome_selected_ids[] = $outcome_output['ids'][0];
				}
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][3])){
					$coutcome_selected_ids[] = $outcome_output['ids'][3];
				}
				
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			$at_i = 4;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">A massive list (&gt; 10000)</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'A massive list (> 10000)';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '4';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][3])){
					$coutcome_selected_ids[] = $outcome_output['ids'][3];
				}
				
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
		// set answer for 3 index question end 
		$question_bank_array[$qb_i]['answer_array'] = $answer_table_array;
		
		$qb_i = 4;
		$question_bank_array[$qb_i]['question_data'] = '<div class="question_details"> <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title " ><div><strong>How much do you want to charge?</strong></div></div><span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span><span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span><span class="sqbDeleteQuesTemplateImageOuter" style="display: none;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span><span class="sqbAddQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$sqb_img_folder_url.'sqb_quiz.png">Add Image</button></span><div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_2021_6_1627241409088_7698" style="display: none;"><span data-class="sbq_img_2021_6_1627241409088_7698" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span></div><div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none"><input type="hidden" class="question_video_url" value=""><input type="hidden" class="question_show_video" value="N"><input type="hidden" class="question_video_link_type" value="0"><input type="hidden" class="question_video_link_type_text" value="Source"><input type="hidden" class="question_video_aspect" value="1"><a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a><div class="video-add-link questionTemplateInsertVideoOuter" style="display:none"><a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a></div><div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none"><iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe></div><div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none"><video width="400" controls=""></video></div></div><span class="sqbHideQuesDescriptionOuter" style="display: none;"><button class="sqbHideQuesDescription">Hide Description</button></span><span class="sqbShowQuesDescriptionOuter" style=""><button class="sqbShowQuesDescription">Show Description</button></span><div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor "  style="display: none;"><div><span style="font-size: 14pt;" data-mce-style="font-size: 14pt;"><strong>Have you thought about the price?</strong></span></div></div></div>';//urldecode
		$question_bank_array[$qb_i]['question_data'] = base64_encode(urlencode($question_bank_array[$qb_i]['question_data']));
		$question_bank_array[$qb_i]['question_title'] = 'How much do you want to charge?﻿';
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
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I don\'t want to charge yet.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I don\'t want to charge yet.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '0';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][1])){
					$coutcome_selected_ids[] = $outcome_output['ids'][1];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 1;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'" style="position: relative; opacity: 1; left: 0px; top: 0px;"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I want to charge anywhere from $49 - $299.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I want to charge anywhere from $49 - $299.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '1';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][2])){
					$coutcome_selected_ids[] = $outcome_output['ids'][2];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
			
			$at_i = 2;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">I want to charge anywhere from $299 - $499.</span></div></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'I want to charge anywhere from $299 - $499.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '2';
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
			
			$at_i = 3;
			$sqb_datetime_rand = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.$at_i;
			$sqb_datetime_rand_img = date('Y_m_d_h_i_s').rand(10,100).'_'.rand(10,100).'_'.rand(10,100).'_'.$at_i;
			
			$answer_table_array[$at_i]['ans']  =  '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_datetime_rand.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img ui-resizable"><img src="'.$sqb_img_folder_url.'sqb_empty.jpg" class="sbq_change_img img_'.$sqb_datetime_rand_img.' ui-draggable ui-draggable-handle" data-class="img_'.$sqb_datetime_rand_img.'" style="position: relative;"></figure><div class="sql_ans_text sqb_tiny_mce_editor " ><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">In the $499-$1999 range.</span></div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" =""="" name="sqb_is_right_ans_'.$sqb_datetime_rand_img.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_drag_drop_sortable1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_drag_drop_sortable" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_drag_drop_sortable1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_datetime_rand.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			$answer_table_array[$at_i]['answer_title'] = 'In the $499-$1999 range.';
			$answer_table_array[$at_i]['correct_ans'] = 'N';
			$answer_table_array[$at_i]['ans_point'] = '0';
			$answer_table_array[$at_i]['ans_hint'] = '';
			$answer_table_array[$at_i]['ans_info'] = '';
			$answer_table_array[$at_i]['answer_order'] = '3';
			$answer_table_array[$at_i]['date'] = $current_data_time;
			if($outcome_has){
				$coutcome_selected_ids = array();
				if(isset($outcome_output['ids']) && isset($outcome_output['ids'][3])){
					$coutcome_selected_ids[] = $outcome_output['ids'][3];
				}
				
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['coutcome_selected_id'] = $coutcome_selected_ids;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_mapping_id']  = 0;
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_wrapper_id']  = '';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_id']  = '%%ANSWERID%%';
				$question_bank_array[$qb_i]['outcome_results_checkbox'][$at_i]['outcome_answer_index_id']  = $at_i + 1;
			}
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
	
	// set funnel data start
	$funnel_details_array =  array();
	$funnel_details_array['quiz_id'] =  $quiz_details['quiz_id'];
	$funnel_details_array['funnel_enable_branching'] =  'Y';
	$funnel_details_array['data_export'] = '{"drawflow":{"Home":{"data":{"311":{"id":311,"name":"qatemplate","data":[],"class":"multiple","html":"<div class=\"funnel_question_title \" data-question-id=\"311\" ><span title=\"Q4:&nbsp;What is your main goal at this point?\">What is your main goal at this point?<\/span><\/div><div class=\"funnel_answer_wrapper\"><div class=\"funnel_answer_title\" ><span title=\"Build an audience and grow my email list.\">Build an audience and grow my email list.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I have a small audience. I want to quit my job and use my business to replace my income.\">I have a small audience. I want to quit my job and use my business to replace my income.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I want to replace my one-to-one work.\">I want to replace my one-to-one work.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"Automate everything and create passive revenue streams.\">Automate everything and create passive revenue streams.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"Become well-known in my niche!\">Become well-known in my niche!<\/span><\/div><\/div>","typenode":false,"inputs":{"input_1":{"connections":[{"node":314,"input":"output_1"},{"node":314,"input":"output_2"}]}},"outputs":{"output_1":{"connections":[{"node":1458,"output":"input_1"}]},"output_2":{"connections":[{"node":1459,"output":"input_1"}]},"output_3":{"connections":[{"node":1460,"output":"input_1"}]},"output_4":{"connections":[{"node":1461,"output":"input_1"}]},"output_5":{"connections":[{"node":1462,"output":"input_1"}]}},"pos_x":1590,"pos_y":59},"312":{"id":312,"name":"qatemplate","data":[],"class":"multiple","html":"<div class=\"funnel_question_title \" data-question-id=\"312\" ><span title=\"Q5:&nbsp;How much time can you dedicate to helping your students after your launch?\">How much time can you dedicate to helping your students after your launch?<\/span><\/div><div class=\"funnel_answer_wrapper\"><div class=\"funnel_answer_title\" ><span title=\" At this time, I\'m focused on building my list and don\'t want to spend too much time helping people with implementation. That\'s for my paid courses.\"> At this time, I\'m focused on building my list and don\'t want to spend too much time helping people with implementation. That\'s for my paid courses.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"Not much time. Maybe 2-3 weeks as I want to continue to add more courses and products.\">Not much time. Maybe 2-3 weeks as I want to continue to add more courses and products.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'m happy to spend 4-5 weeks helping my students with any questions and implementation after I launch it.\">I\'m happy to spend 4-5 weeks helping my students with any questions and implementation after I launch it.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'m happy to spend 6-8 weeks helping my students get results!\">I\'m happy to spend 6-8 weeks helping my students get results!<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'m in it for the long term! I\'ll be available not just during the course launch but also after to continue to help and support them. \">I\'m in it for the long term! I\'ll be available not just during the course launch but also after to continue to help and support them. <\/span><\/div><\/div>","typenode":false,"inputs":{"input_1":{"connections":[{"node":313,"input":"output_1"},{"node":313,"input":"output_2"},{"node":313,"input":"output_3"},{"node":313,"input":"output_4"},{"node":313,"input":"output_5"}]}},"outputs":{"output_1":{"connections":[{"node":1463,"output":"input_1"},{"node":314,"output":"input_1"}]},"output_2":{"connections":[{"node":1464,"output":"input_1"},{"node":314,"output":"input_1"}]},"output_3":{"connections":[{"node":1465,"output":"input_1"},{"node":314,"output":"input_1"}]},"output_4":{"connections":[{"node":1466,"output":"input_1"},{"node":314,"output":"input_1"}]},"output_5":{"connections":[{"node":1467,"output":"input_1"},{"node":314,"output":"input_1"}]}},"pos_x":425,"pos_y":119},"313":{"id":313,"name":"qatemplate","data":[],"class":"multiple","html":"<div class=\"funnel_question_title \" data-question-id=\"313\" ><span title=\"Q1:&nbsp;Are you new to online business?\ufeff\">Are you new to online business?\ufeff<\/span><\/div><div class=\"funnel_answer_wrapper\"><div class=\"funnel_answer_title\" ><span title=\"Yes, I\'m just starting out.\">Yes, I\'m just starting out.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"Relatively new. I started a few months ago.\">Relatively new. I started a few months ago.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'ve been doing this from a few years and but no paid courses yet.\">I\'ve been doing this from a few years and but no paid courses yet.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'ve done a few courses already but time to get to the next level.\">I\'ve done a few courses already but time to get to the next level.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I\'m an expert and doing well.\">I\'m an expert and doing well.<\/span><\/div><\/div>","typenode":false,"inputs":[],"outputs":{"output_1":{"connections":[{"node":1468,"output":"input_1"},{"node":312,"output":"input_1"}]},"output_2":{"connections":[{"node":1469,"output":"input_1"},{"node":312,"output":"input_1"}]},"output_3":{"connections":[{"node":1470,"output":"input_1"},{"node":312,"output":"input_1"}]},"output_4":{"connections":[{"node":1471,"output":"input_1"},{"node":312,"output":"input_1"}]},"output_5":{"connections":[{"node":1472,"output":"input_1"},{"node":312,"output":"input_1"}]}},"pos_x":10,"pos_y":50},"314":{"id":314,"name":"qatemplate","data":[],"class":"multiple","html":"<div class=\"funnel_question_title \" data-question-id=\"314\" ><span title=\"Q2:&nbsp;Do you have an email list yet?\ufeff\">Do you have an email list yet?\ufeff<\/span><\/div><div class=\"funnel_answer_wrapper\"><div class=\"funnel_answer_title\" ><span title=\"No audience \/ list yet.\">No audience \/ list yet.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"A small list ( 0 - 200) \">A small list ( 0 - 200) <\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"A medium-size list (200 - 1000)\">A medium-size list (200 - 1000)<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"A big list (1001 - 10000)\">A big list (1001 - 10000)<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"A massive list (> 10000)\">A massive list (> 10000)<\/span><\/div><\/div>","typenode":false,"inputs":{"input_1":{"connections":[{"node":312,"input":"output_1"},{"node":312,"input":"output_2"},{"node":312,"input":"output_3"},{"node":312,"input":"output_4"},{"node":312,"input":"output_5"}]}},"outputs":{"output_1":{"connections":[{"node":1473,"output":"input_1"},{"node":311,"output":"input_1"}]},"output_2":{"connections":[{"node":1474,"output":"input_1"},{"node":311,"output":"input_1"}]},"output_3":{"connections":[{"node":1475,"output":"input_1"},{"node":315,"output":"input_1"}]},"output_4":{"connections":[{"node":1476,"output":"input_1"},{"node":315,"output":"input_1"}]},"output_5":{"connections":[{"node":1477,"output":"input_1"},{"node":315,"output":"input_1"}]}},"pos_x":870,"pos_y":167},"315":{"id":315,"name":"qatemplate","data":[],"class":"multiple","html":"<div class=\"funnel_question_title \" data-question-id=\"315\" ><span title=\"Q3:&nbsp;How much do you want to charge?\ufeff\">How much do you want to charge?\ufeff<\/span><\/div><div class=\"funnel_answer_wrapper\"><div class=\"funnel_answer_title\" ><span title=\"I don\'t want to charge yet.\">I don\'t want to charge yet.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I want to charge anywhere from $49 - $299.\">I want to charge anywhere from $49 - $299.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"I want to charge anywhere from $299 - $499.\">I want to charge anywhere from $299 - $499.<\/span><\/div><div class=\"funnel_answer_title\" ><span title=\"In the $499-$1999 range.\">In the $499-$1999 range.<\/span><\/div><\/div>","typenode":false,"inputs":{"input_1":{"connections":[{"node":314,"input":"output_4"},{"node":314,"input":"output_5"},{"node":314,"input":"output_3"}]}},"outputs":{"output_1":{"connections":[{"node":1478,"output":"input_1"}]},"output_2":{"connections":[{"node":1479,"output":"input_1"}]},"output_3":{"connections":[{"node":1480,"output":"input_1"}]},"output_4":{"connections":[{"node":1481,"output":"input_1"}]}},"pos_x":1275,"pos_y":350}}}}}';
	
	$funeel_array['old_question_id']=  array(311,312,313,314,315);
	$funeel_array['old_answer_id']  =  array(1458,1459,1460,1461,1462,1463,1464,1465,1466,1467,1468,1469,1470,1471,1472,1473,1474,1475,1476,1477,1478,1479,1480,1481);
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
	
	
