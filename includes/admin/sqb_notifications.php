<h3 class="  quiz--title quiz_settings_head pb-0"  ><i class="fa fa-cog" aria-hidden="true"></i><div class="smalltext_outer" >Admin/Student Email Notification <small style="color:#555;font-size: 15px;padding: 12px 0;margin: 0;display: inline-block;width: 100%;vertical-align: top;">When a user completes the quiz and opts-in, send an email notification to the admin (with lead & quiz details) and the user (with quiz results) </small></div> </h3>


<div class="quiz-card-outer-gray p-0">
	<div class="quiz-content-card">
		<div class="sqb-email-notification-selection">
			<h4 style="text-align:center;">Want to send an email notification to the quiz takers (and yourself) when they complete the quiz?</h4>
			<div class="sqb-email-notification-selection-options" style="display:none;">
				<div class="sqb-email-notification-selection-item" data-value="global"> 
					<img src="https://memberdemo.com/playground/wp-content/plugins/smartquizbuilder/includes/admin/../../includes/images/sqb_scratch_icon.png"> 
					<span>Global Notification Settings</span>
				</div>
				<div class="sqb-email-notification-selection-item " data-value="quiz_level"> 
					<img src="https://memberdemo.com/playground/wp-content/plugins/smartquizbuilder/includes/admin/../../includes/images/sqb_built_in.png"> 
					<span>Quiz Level Notification Settings</span>
				</div>
			</div>

			<div class="notification-info-text">

				<p>You can configure email notifications for students and admin in SQB Quiz Notifications tab. Just edit your quiz and setup the emails in the "Notifications" tab of the quiz.</p>
			</div>
		</div>


		<!-- Global Settings -->
		<div id="global-settings-outer" style="display: none;">
			<h5 class="quiz--sub-title">Global Notification Settings</h5>
			<span class="sqb-email-notification-selection-close" onclick="sqb_hide_global_notification()">x</span>
			<ul class="nav nav-tabs" id="Quiz-reportsTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" data-toggle="tab" href="#dap_admin_notification_tab" role="tab" aria-controls="dap_admin_notification_tab" aria-selected="false">Admin Notification</a>
				</li>
				<li class="nav-item">
					<a class="nav-link student-notification" data-toggle="tab" href="#dap_students_notification_tab" role="tab" aria-controls="dap_students_notification_tab" aria-selected="false">Student Notification</a>
				</li>		
			</ul>

		<div class="tab-content " id="reports-tab-content">
			<div class="tab-pane fade active show" id="dap_admin_notification_tab" role="tabpanel" aria-labelledby="dap_admin_notification_tab">	
			<?php 
			$notification_from_email = '';
			$notification_from_name = '';
			$notification_email_subject = 'New User Signup';



			$notification_email_body = '<p>A new user has signed up to this quiz %%QUIZ_TITLE%%.</p>
			 							<p>This is a "%%QUIZ_TYPE%% quiz". This user got the outcome - %%OUTCOME%%.</p>
			 							<strong>  Here are the user details: </strong><br>
										<label>Name:</label> <span>%%NAME%%</span><br>
										<label>Email:</label> <span>%%EMAIL%%</span><br>
										<label>Quiz Title:</label> <span>%%QUIZ_TITLE%%</span><br>
										<label>Outcome:</label> <span>%%OUTCOME%%</span>									 
										<label><strong>Question/Answers:</strong></label><span>%%ANSWERS%%</span>';
										
			$sendEmail = 'N';	
			$display = 'display:none';

			$sqb_notifications =SQB_QuizNotifications::loadByTypeAndQuizType('admin_email', '');

			if($sqb_notifications != false){
				$sendEmail = stripslashes($sqb_notifications->getSendEmail());
				if($sendEmail == 'Y'){$display = 'display:block';}
				$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
				$notification_from_name = stripslashes($sqb_notifications->getFromName());
				$notification_email_subject = stripslashes($sqb_notifications->getSubject());
				$notification_email_body = stripslashes($sqb_notifications->getBody());
				$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
			}

		?>

		<div class="quiz-card-outer-gray" style="background: #f9fafb;">
			<div class="quiz-content-card">
				<label for="" class="quiz_label">Do you (admin) want to receive an email with the quiz results and other details when a user completes the quiz and signs up?</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input type="checkbox" name="notification_send_email" id="notification_send_email" <?= isset($sendEmail) && $sendEmail == 'Y' ? 'checked': ''?>>
						<label for="notification_send_email"></label>
					</div>
					
				</div>
			</div>
			<div class="quiz-content-card commonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">This email should be sent from</label>
				<div class="quiz_right-content">
					<input type="text" name="notification_from_name" id="notification_from_name" value="<?= $notification_from_name ?>">
				</div>
			</div>
			<div class="quiz-content-card commonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">This email should be sent to <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width: 401px;">You can add comma separated list of email</div></div></label>
				<div class="quiz_right-content">
					<input type="text" name="notification_from_email" id="notification_from_email" value="<?= $notification_from_email ?>">
				</div>
			</div>
			
			

			<div class="quiz-content-card commonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">Subject</label>
				<div class="quiz_right-content">
					<input type="text" name="notification_email_subject" id="notification_email_subject" value="<?= $notification_email_subject ?>">
					<div class="personalize_options">
					<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
					<!--merge tags  Modal  -->
					<div class=" addmerget-content addmergetagspreview1" style="display: none;">

					<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->    
					<div class=" mergetags_cont">
					<div class="notification_sidebar">
					<ul class="notification_email_fields">
					<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
					<li class="addtoeditor">%%QUIZ_TITLE%%</li>
					<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
					<li class="addtoeditor">%%QUIZ_TYPE%%</li>
					<li class="addtoeditor">%%OUTCOME%%</li>
					<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
					<li class="addtoeditor">%%NAME%%</li>
					<li class="addtoeditor">%%EMAIL%%</li>
					<li class="addtoeditor">%%ANSWERS%%</li>
					<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
					<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
					<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
					<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
					<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
					<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
					</ul>

					</div>

					</div>
					</div>
					</div>
				</div>
			</div>

			<div class="quiz-content-card commonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">Body</label>
				<div class="quiz_right-content">
					<textarea class="sqb_text_editor" id="notification_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
				</div>
			</div>
		</div>
		<div class="quiz-actions justify-content-center">
			<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_quiz_notification" onclick="sqb_save_quiz_notification()"> Save </a>
		</div>
	</div>
	<div class="tab-pane fade" id="dap_students_notification_tab" role="tabpanel" aria-labelledby="dap_students_notification_tab">
		<ul class="nav nav-tabs" id="notification_inner_tab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active show" data-toggle="tab" href="#dap_personality_notification_tab" role="tab" aria-controls="dap_personality_notification_tab" aria-selected="false">Personality</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#dap_scoring_notification_tab" role="tab" aria-controls="dap_scoring_notification_tab" aria-selected="false">Scoring</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#dap_assessments_notification_tab" role="tab" aria-controls="dap_assessments_notification_tab" aria-selected="false">Assessments</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#dap_survey_notification_tab" role="tab" aria-controls="dap_survey_notification_tab" aria-selected="false">Survey</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#dap_calculator_notification_tab" role="tab" aria-controls="dap_calculator_notification_tab" aria-selected="false">Calculator</a>
			</li>


		</ul>	
<div class="tab-content " id="notification_inner_tab">
			<div class="tab-pane fade active show" id="dap_personality_notification_tab" role="tabpanel" aria-labelledby="dap_personality_notification_tab">	
 
	<?php 
		$notification_from_email = '';
		$notification_from_name = '';
		$notification_email_subject = 'Your Quiz Results';



		$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
									<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 
									<p><strong>Here's your result details:</strong></p>
									<p>Your Outcome - %%OUTCOME%%.</p>
									<p>Quiz Title: %%QUIZ_TITLE%%</p>
									<p>Outcome: %%OUTCOME%%</p> 
									<strong>Your Answers</strong>:  %%ANSWERS%%";

		$notification_answer_format = 	'<p><strong>Question</strong>: %%QUESTION%%</p>
											<p><strong>Your Answer</strong>: %%ANSWER%%</p>';
		$sendEmail = 'N';	
		$display = 'display:none';

		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'personality');

		if($sqb_notifications != false){
			$sendEmail = stripslashes($sqb_notifications->getSendEmail());
			if($sendEmail == 'Y'){$display = 'display:block';}
			$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
			$notification_email_subject = stripslashes($sqb_notifications->getSubject());
			$notification_email_body = stripslashes($sqb_notifications->getBody());
			$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
			$notification_from_name = stripslashes($sqb_notifications->getFromName());
		}

	?>

	<div class="quiz-card-outer-gray" style="background: #f9fafb;">
		<div class="quiz-content-card">
			<label for="" class="quiz_label">Do you want your students to receive an email with the quiz results and other details when they complete it and signup?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input type="checkbox" class="student_send_email" data-type="personality"  name="personality_send_email" id="personality_send_email" <?= isset($sendEmail) && $sendEmail == 'Y' ? 'checked': ''?>>
					<label for="personality_send_email"></label>
				</div>
				
			</div>
		</div>
		<div class="quiz-content-card personalityCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Name <small>(Sender/Admin Name)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="personality_from_name" id="personality_from_name" value="<?= $notification_from_name ?>">
			</div>
		</div>
		<div class="quiz-content-card personalityCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="personality_from_email" id="personality_from_email" value="<?= $notification_from_email ?>">
			</div>
		</div>

		<div class="quiz-content-card personalityCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Subject</label>
			<div class="quiz_right-content">
				<input type="text" name="personality_email_subject" id="personality_email_subject" value="<?= $notification_email_subject ?>">
				<div class="personalize_options">
				<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
				<!--merge tags  Modal  -->
				<div class=" addmerget-content addmergetagspreview1"  style="display: none;">

				<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
				<div class=" mergetags_cont">
				<div class="notification_sidebar">
				<ul class="notification_email_fields">
				<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
				<li class="addtoeditor">%%QUIZ_TITLE%%</li>
				<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
				<li class="addtoeditor">%%QUIZ_TYPE%%</li>
				<li class="addtoeditor">%%OUTCOME%%</li>
				<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
				<li class="addtoeditor">%%NAME%%</li>
				<li class="addtoeditor">%%EMAIL%%</li>
				<li class="addtoeditor">%%ANSWERS%%</li>
				<li class="addtoeditor">%%QUESTION%%</li>
				<li class="addtoeditor">%%ANSWER%%</li>
				<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
				<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
				<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
				<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
				</ul>

				</div>

				</div>
				</div>
				</div>
			</div>
		</div>

		<div class="quiz-content-card personalityCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Body</label>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="personality_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
			</div>
		</div>
		<div class="quiz-content-card personalityCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
			<p>The following will be displayed multiple times based on the total number of questions.</p>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="personality_answer_format">
					<?php echo $notification_answer_format; ?>
				</textarea> 
			</div>
		</div>
	</div>
	
	<div class="quiz-actions justify-content-center">
		<a href="javascript:void(0)" data-type="personality" class="quiz--btn quiz-save-btn sqb_save_student_quiz_notification"> Save </a>
		
	</div>
	</div>

	<div class="tab-pane fade" id="dap_scoring_notification_tab" role="tabpanel" aria-labelledby="dap_scoring_notification_tab">	
 
	<?php 
		$notification_from_email = '';
		$notification_from_name = '';
		$notification_email_subject = 'Your Quiz Results';



		$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
									<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 

									<p><strong>Here's your result details:</strong></p>

									<p>Quiz Title: %%QUIZ_TITLE%%</p>
									<p>Score:  %%SCORE%%</p>
									<strong>Your Answers</strong>:  %%ANSWERS%%";

		$notification_answer_format = 	'<p><strong>Question:</strong> %%QUESTION%%</p>
										<p><strong>Your Answer:</strong> %%ANSWER%%</p>
										<p><strong>Correct Answer:</strong> %%CORRECTANSWER%%</p>';						
		$sendEmail = 'N';	
		$display = 'display:none';

		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'scoring');

		if($sqb_notifications != false){
			$quiz_id = stripslashes($sqb_notifications->getQuizId());

			if(empty($quiz_id)){
			$sendEmail = stripslashes($sqb_notifications->getSendEmail());
			if($sendEmail == 'Y'){$display = 'display:block';}
				$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
				$notification_email_subject = stripslashes($sqb_notifications->getSubject());
				$notification_email_body = stripslashes($sqb_notifications->getBody());
				$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
				$notification_from_name = stripslashes($sqb_notifications->getFromName());
			}
		}

	?>

	<div class="quiz-card-outer-gray" style="background: #f9fafb;">
		<div class="quiz-content-card">
			<label for="" class="quiz_label">Do you want your students to receive an email with the quiz results and other details when they complete it and signup?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input type="checkbox" class="student_send_email" data-type="scoring"  name="scoring_send_email" id="scoring_send_email" <?php if(isset($sendEmail) && $sendEmail == 'Y' && empty($quiz_id)){ echo 'checked';}else{ echo '';}  ?>>
					<label for="scoring_send_email"></label>
				</div>
				
			</div>
		</div>
		<div class="quiz-content-card scoringCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Name <small>(Sender/Admin Name)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="scoring_from_name" id="scoring_from_name" value="<?= $notification_from_name ?>">
			</div>
		</div>
		<div class="quiz-content-card scoringCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="scoring_from_email" id="scoring_from_email" value="<?= $notification_from_email ?>">
			</div>
		</div>

		<div class="quiz-content-card scoringCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Subject</label>
			<div class="quiz_right-content">
				<input type="text" name="scoring_email_subject" id="scoring_email_subject" value="<?= $notification_email_subject ?>">
				<div class="personalize_options">
				<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
				<!--merge tags  Modal  -->
				<div class=" addmerget-content addmergetagspreview1" style="display: none;">

				<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
				<div class=" mergetags_cont">
				<div class="notification_sidebar">
				<ul class="notification_email_fields">
				<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
				<li class="addtoeditor">%%QUIZ_TITLE%%</li>
				<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
				<li class="addtoeditor">%%QUIZ_TYPE%%</li>
				<li class="addtoeditor">%%OUTCOME%%</li>
				<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
				<li class="addtoeditor">%%NAME%%</li>
				<li class="addtoeditor">%%EMAIL%%</li>
				<li class="addtoeditor">%%ANSWERS%%</li>
				<li class="addtoeditor">%%QUESTION%%</li>
				<li class="addtoeditor">%%ANSWER%%</li>
				<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
				<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
				<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
				<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
				</ul>

				</div>

				</div>
				</div>
				</div>
			</div>
		</div>

		<div class="quiz-content-card scoringCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Body</label>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="scoring_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
			</div>
		</div>

		<div class="quiz-content-card scoringCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
			<p>The following will be displayed multiple times based on the total number of questions.</p>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="scoring_answer_format">
					<?php echo $notification_answer_format ?>
				</textarea> 
			</div>
		</div>
	</div>
	
	<div class="quiz-actions justify-content-center">
		<a href="javascript:void(0)" data-type="scoring" class="quiz--btn quiz-save-btn sqb_save_student_quiz_notification"> Save </a>
		
	</div>
	</div>

	<div class="tab-pane fade" id="dap_assessments_notification_tab" role="tabpanel" aria-labelledby="dap_assessments_notification_tab">	
 
	<?php 
		$notification_from_email = '';
		$notification_from_name = '';
		$notification_email_subject = 'Your Quiz Results';



		$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
									<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 

									<p><strong>Here's your result details:</strong></p>

									<p>Quiz Title: %%QUIZ_TITLE%%</p>
									<p>Points:  %%POINTS%%</p>

									<strong>Your Answers:</strong>  %%ANSWERS%%";

		$notification_answer_format = 	'<p><strong>Question:</strong> %%QUESTION%%</p>
										<p><strong>Your Answer:</strong> %%ANSWER%%</p>
										<p><strong>Correct Answer:</strong> %%CORRECTANSWER%%</p>';						
		$sendEmail = 'N';	
		$display = 'display:none';

		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'assessment');

		if($sqb_notifications != false){
			$sendEmail = stripslashes($sqb_notifications->getSendEmail());
			if($sendEmail == 'Y'){$display = 'display:block';}
			$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
			$notification_email_subject = stripslashes($sqb_notifications->getSubject());
			$notification_email_body = stripslashes($sqb_notifications->getBody());
			$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
			$notification_from_name = stripslashes($sqb_notifications->getFromName());
		}

	?>

	<div class="quiz-card-outer-gray" style="background: #f9fafb;">
		<div class="quiz-content-card">
			<label for="" class="quiz_label">Do you want your students to receive an email with the quiz results and other details when they complete it and signup?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input type="checkbox" class="student_send_email" data-type="assessment"  name="assessment_send_email" id="assessment_send_email" <?= isset($sendEmail) && $sendEmail == 'Y' ? 'checked': ''?>>
					<label for="assessment_send_email"></label>
				</div>
				
			</div>
		</div>
		<div class="quiz-content-card assessmentCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Name <small>(Sender/Admin Name)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="assessment_from_name" id="assessment_from_name" value="<?= $notification_from_name ?>">
			</div>
		</div>
		<div class="quiz-content-card assessmentCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="assessment_from_email" id="assessment_from_email" value="<?= $notification_from_email ?>">
			</div>
		</div>

		<div class="quiz-content-card assessmentCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Subject</label>
			<div class="quiz_right-content">
				<input type="text" name="assessment_email_subject" id="assessment_email_subject" value="<?= $notification_email_subject ?>">
				<div class="personalize_options">
				<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
				<!--merge tags  Modal  -->
				<div class=" addmerget-content addmergetagspreview1" style="display: none;">

				<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
				<div class=" mergetags_cont">
				<div class="notification_sidebar">
				<ul class="notification_email_fields">
				<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
				<li class="addtoeditor">%%QUIZ_TITLE%%</li>
				<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
				<li class="addtoeditor">%%QUIZ_TYPE%%</li>
				<li class="addtoeditor">%%OUTCOME%%</li>
				<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
				<li class="addtoeditor">%%NAME%%</li>
				<li class="addtoeditor">%%EMAIL%%</li>
				<li class="addtoeditor">%%ANSWERS%%</li>
				<li class="addtoeditor">%%QUESTION%%</li>
				<li class="addtoeditor">%%ANSWER%%</li>
				<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
				<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
				<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
				<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
				</ul>

				</div>

				</div>
				</div>
				</div>
			</div>
		</div>

		<div class="quiz-content-card assessmentCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Body</label>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="assessment_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
			</div>
		</div>

		<div class="quiz-content-card assessmentCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
			<p>The following will be displayed multiple times based on the total number of questions.</p>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="assessment_answer_format">
					<?php echo $notification_answer_format ?>
				</textarea> 
			</div>
		</div>
	</div>
	
	<div class="quiz-actions justify-content-center">
		<a href="javascript:void(0)" data-type="assessment" class="quiz--btn quiz-save-btn sqb_save_student_quiz_notification"> Save </a>
		
	</div>
	</div>

	<div class="tab-pane fade" id="dap_survey_notification_tab" role="tabpanel" aria-labelledby="dap_survey_notification_tab">	

 
	<?php 
		$notification_from_email = '';
		$notification_from_name = '';
		$notification_email_subject = 'Your Quiz Results';



		$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
									<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 

									<p><strong>Here's your result details:</strong></p>

									<p>Quiz Title: %%QUIZ_TITLE%%</p>
							
									<strong>Your Answers:</strong>  %%ANSWERS%%";

		$notification_answer_format = 	'<p><strong>Question:</strong> %%QUESTION%%</p>
										<p><strong>Your Answer:</strong> %%ANSWER%%</p>';					
		$sendEmail = 'N';	
		$display = 'display:none';

		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'survey');		

		if($sqb_notifications != false){
			$sendEmail = stripslashes($sqb_notifications->getSendEmail());
			if($sendEmail == 'Y'){$display = 'display:block';}
			$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
			$notification_email_subject = stripslashes($sqb_notifications->getSubject());
			$notification_email_body = stripslashes($sqb_notifications->getBody());
			$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
			$notification_from_name = stripslashes($sqb_notifications->getFromName());
		}

	?>

	<div class="quiz-card-outer-gray" style="background: #f9fafb;">
		<div class="quiz-content-card">
			<label for="" class="quiz_label">Do you want your students to receive an email with the quiz results and other details when they complete it and signup?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input type="checkbox" class="student_send_email" data-type="survey" name="survey_send_email" id="survey_send_email" <?= isset($sendEmail) && $sendEmail == 'Y' ? 'checked': ''?>>
					<label for="survey_send_email"></label>
				</div>
				
			</div>
		</div>
		
		<div class="quiz-content-card surveyCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Name <small>(Sender/Admin Name)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="survey_from_name" id="survey_from_name" value="<?= $notification_from_name ?>">
			</div>
		</div>
		<div class="quiz-content-card surveyCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
			<div class="quiz_right-content">
				<input type="text" name="survey_from_email" id="survey_from_email" value="<?= $notification_from_email ?>">
			</div>
		</div>

		<div class="quiz-content-card surveyCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Subject</label>
			<div class="quiz_right-content">
				<input type="text" name="survey_email_subject" id="survey_email_subject" value="<?= $notification_email_subject ?>">
				<div class="personalize_options">
				<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
				<!--merge tags  Modal  -->
				<div class=" addmerget-content addmergetagspreview1" style="display: none;">

				<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
				<div class=" mergetags_cont">
				<div class="notification_sidebar">
				<ul class="notification_email_fields">
				<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
				<li class="addtoeditor">%%QUIZ_TITLE%%</li>
				<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
				<li class="addtoeditor">%%QUIZ_TYPE%%</li>
				<li class="addtoeditor">%%OUTCOME%%</li>
				<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
				<li class="addtoeditor">%%NAME%%</li>
				<li class="addtoeditor">%%EMAIL%%</li>
				<li class="addtoeditor">%%ANSWERS%%</li>
				<li class="addtoeditor">%%QUESTION%%</li>
				<li class="addtoeditor">%%ANSWER%%</li>
				<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
				<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
				<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
				<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
				<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
				</ul>

				</div>

				</div>
				</div>
				</div>
			</div>
		</div>

		<div class="quiz-content-card surveyCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Body</label>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="survey_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
			</div>
		</div>

		<div class="quiz-content-card surveyCommonNotification" style="<?= $display ?>">
			<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
			<p>The following will be displayed multiple times based on the total number of questions.</p>
			<div class="quiz_right-content">
				<textarea class="sqb_text_editor" id="survey_answer_format">
					<?php echo $notification_answer_format ?>
				</textarea> 
			</div>
		</div>
	</div>
	
	<div class="quiz-actions justify-content-center">
		<a href="javascript:void(0)" data-type="survey" class="quiz--btn quiz-save-btn sqb_save_student_quiz_notification"> Save </a>
		
	</div>
	</div>
	
	<div class="tab-pane fade" id="dap_calculator_notification_tab" role="tabpanel" aria-labelledby="dap_calculator_notification_tab">	
		<?php 
			$notification_from_email = '';
			$notification_from_name = '';
			
			$notification_email_subject = 'Your Quiz Results';



			$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
										<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 

										<p><strong>Here's your result details:</strong></p>

										<p>Quiz Title: %%QUIZ_TITLE%%</p>
								
										<strong>Your Answers:</strong>  %%ANSWERS%%";

			$notification_answer_format = 	'<p><strong>Question</strong>: %%QUESTION%%</p>
											<p><strong>Your Answer</strong>: %%ANSWER%%</p>';					
			$sendEmail = 'N';	
			$display = 'display:none';

			$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'calculator');		

			if($sqb_notifications != false){
				$sendEmail = stripslashes($sqb_notifications->getSendEmail());
				if($sendEmail == 'Y'){$display = 'display:block';}
				$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
				$notification_email_subject = stripslashes($sqb_notifications->getSubject());
				$notification_email_body = stripslashes($sqb_notifications->getBody());
				$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
				$notification_from_name = stripslashes($sqb_notifications->getFromName());
			}

		?>
		<div class="quiz-card-outer-gray" style="background: #f9fafb;">
			<div class="quiz-content-card">
				<label for="" class="quiz_label">Do you want your students to receive an email with the quiz results and other details when they complete it and signup?</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input type="checkbox" class="student_send_email" data-type="calculator" name="calculator_send_email" id="calculator_send_email" <?= isset($sendEmail) && $sendEmail == 'Y' ? 'checked': ''?>>
						<label for="calculator_send_email"></label>
					</div>
					
				</div>
			</div>
			<div class="quiz-content-card calculatorCommonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">From Name <small>(Sender/Admin Name)</small></label>
				<div class="quiz_right-content">
					<input type="text" name="calculator_from_name" id="calculator_from_name" value="<?= $notification_from_name ?>">
				</div>
			</div>
			<div class="quiz-content-card calculatorCommonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
				<div class="quiz_right-content">
					<input type="text" name="calculator_from_email" id="calculator_from_email" value="<?= $notification_from_email ?>">
				</div>
			</div>

			<div class="quiz-content-card calculatorCommonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">Subject</label>
				<div class="quiz_right-content">
					<input type="text" name="calculator_email_subject" id="calculator_email_subject" value="<?= $notification_email_subject ?>">
					<div class="personalize_options">
					<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
					<!--merge tags  Modal  -->
					<div class=" addmerget-content addmergetagspreview1" style="display: none;">

					<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
					<div class=" mergetags_cont">
					<div class="notification_sidebar">
					<ul class="notification_email_fields">
					<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
					<li class="addtoeditor">%%QUIZ_TITLE%%</li>
					<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
					<li class="addtoeditor">%%QUIZ_TYPE%%</li>
					<li class="addtoeditor">%%OUTCOME%%</li>
					<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
					<li class="addtoeditor">%%NAME%%</li>
					<li class="addtoeditor">%%EMAIL%%</li>
					<li class="addtoeditor">%%ANSWERS%%</li>
					<li class="addtoeditor">%%QUESTION%%</li>
					<li class="addtoeditor">%%ANSWER%%</li>
					<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
					<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
					<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
					<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
					<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
					<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
					</ul>

					</div>

					</div>
					</div>
					</div>
				</div>
			</div>

			<div class="quiz-content-card calculatorCommonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">Body</label>
				<div class="quiz_right-content">
					<textarea class="sqb_text_editor" id="calculator_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
				</div>
			</div>

			<div class="quiz-content-card calculatorCommonNotification" style="<?= $display ?>">
				<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
				<p>The following will be displayed multiple times based on the total number of questions.</p>
				<div class="quiz_right-content">
					<textarea class="sqb_text_editor" id="calculator_answer_format">
						<?php echo $notification_answer_format ?>
					</textarea> 
				</div>
			</div>
		</div>
		
		<div class="quiz-actions justify-content-center">
			<a href="javascript:void(0)" data-type="calculator" class="quiz--btn quiz-save-btn sqb_save_student_quiz_notification"> Save </a>
		</div>
	</div>
	
	</div>
	</div>
	</div>
	</div>

	<!-- Quiz Level Notification -->

	<div id="different-settings-outer" style="display: none;">
		<h5 class="quiz--sub-title">Quiz Level Notification Settings</h5>
		<span class="sqb-email-notification-selection-close" onclick="sqb_hide_global_notification()">x</span>
		<div class="tab-content " id="quiz-level-tab-content">
			<div class="Restriction-Settings-content">	
				<div class="Restriction-Settings-leftside">
					<h3>Select a Quiz</h3>
					<ul name="quizList" class="Quiz-Restriction-list nav nav-tabs quizListing">
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
						<li data-value="<?php echo $quiz_id; ?>"  data-type="<?php echo $quiz_type; ?>" class=" nav-item <?= isset($i) && $i == 0 ? 'activeli' : '' ?>" title="<?php echo stripslashes($quiz_name); ?>">
							<a class=" nav-link <?= isset($i) && $i == 0 ? 'active' : '' ?>" href="javascript:void(0);"><?php echo stripslashes($quiz_name).' (id: '.$quiz_id.')'; ?></a>
						</li>	
						<?php $i++; }
						} ?>							 
					  
					</ul>
				</div>
				<div class="quiz-card-outer-gray">
					<div class="import-content-card">
						<?php 
						$notification_from_email = '';
						$notification_from_name = '';
						$notification_email_subject = 'Your Quiz Results';



						$notification_email_body = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
													<p>This is a '%%QUIZ_TYPE%% quiz'.</p> 
													<p><strong>Here's your result details:</strong></p>
													<p>Your Outcome - %%OUTCOME%%.</p>
													<p>Quiz Title: %%QUIZ_TITLE%%</p>
													<p>Outcome: %%OUTCOME%%</p> 
													<strong>Your Answers</strong>:  %%ANSWERS%%";

						$notification_answer_format = 	'<p><strong>edededeQuestion</strong>: %%QUESTION%%</p>
											<p><strong>Your Answer</strong>: %%ANSWER%%</p>';
						$sendEmail = 'N';	
						$notification_copy_email_subject = 'N';
						$notification_get_email_ids = '';
						$display = 'display:none';

						$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', 'personality');

						if($sqb_notifications != false){
							$sendEmail = stripslashes($sqb_notifications->getSendEmail());
							if($sendEmail == 'Y'){$display = 'display:block';}
							$notification_from_email = stripslashes($sqb_notifications->getFromEmail());
							$notification_email_subject = stripslashes($sqb_notifications->getSubject());
							$notification_email_body = stripslashes($sqb_notifications->getBody());
							$notification_answer_format = stripslashes($sqb_notifications->getAnswerFormat());
							$notification_from_name = stripslashes($sqb_notifications->getFromName());

							$notification_send_copy = stripslashes($sqb_notifications->getSendCopy());
							$notification_get_email_ids = stripslashes($sqb_notifications->getEmailIds());
							$notification_copy_email_subject = stripslashes($sqb_notifications->getCopyEmailSubject());
						}
						$display = 'display:block';
					?>

					<div class="quiz-card-outer-gray">
						<h5 class="quiz--sub-title">Select Email Notification Option</h5>
						<div class="quiz-content-card" style="<?= $display ?>">
							<div class="quiz_right-content">
								<label for="send-customized-email" class="radio-btn--outer">
									<input type="radio" id="send-customized-email" name="email_notification_settings" value="send-customized-email" checked="checked"> Send a customized email
									</label>
								<label for="global-email-option" class="radio-btn--outer">
									<input type="radio" id="global-email-option" name="email_notification_settings" value="global-email-option"> Use global email settings <a href="javascript:void(0);" class="configure-email">(click here to configure email)</a>
								</label>
								<label for="dont-send-email" class="radio-btn--outer">
									<input type="radio" id="dont-send-email" name="email_notification_settings" value="dont-send-email"> Do no send any emails to quiz takers
								</label>							
							</div>
						</div>

						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>">
							<label for="" class="quiz_label">From Name <small> (Sender/Admin Name)</small></label>
							<div class="quiz_right-content">
								<input type="text" name="quizlevel_from_name" id="quizlevel_from_name" value="<?= $notification_from_name ?>">
							</div>
						</div>
						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>">
							<label for="" class="quiz_label">From Email <small>(sender/admin email)</small></label>
							<div class="quiz_right-content">
								<input type="text" name="quizlevel_from_email" id="quizlevel_from_email" value="<?= $notification_from_email ?>">
							</div>
						</div>
						<!--  -->
						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>;border-bottom:none;">
							<label for="" class="quiz_label">Send a copy to these email addresses:</label>
							<div class="quiz_right-content">
								<div class="square-switch_onoff">
									<input type="checkbox" name="notification_send_copy" id="notification_send_copy" <?= isset($notification_send_copy) && $notification_send_copy == 'Y' ? 'checked': ''?>>
									<label for="notification_send_copy"></label>
								</div>
								
							</div>
						</div>
						<div class="notification-copy-fields-outer" style="display:none;">
							<div class="quiz-content-card quizLevelCommonNotification noti_email_ids" style="display: none;">
								<label for="" class="quiz_label">Email IDs<small> (You can enter comma-separated list of email ids here)</small></label>
								<div class="quiz_right-content">
									<input type="text" name="email_ids" id="email_ids" value="<?= $notification_get_email_ids ?>">
								</div>
							</div>

							<div class="quiz-content-card quizLevelCommonNotification noti_copy_email" style="display: none;">
								<label for="" class="quiz_label">Enter subject line for the copy:</label>
								<div class="quiz_right-content">
									<input type="text" name="copy_email_subject" id="copy_email_subject" value="<?php if($notification_copy_email_subject){ echo $notification_copy_email_subject; }else{ echo 'User %%EMAIL%% has completed the quiz';} ?>">
								</div>
							</div>
						</div>	
						<!--  -->

						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>">
							<label for="" class="quiz_label">Subject</label>
							<div class="quiz_right-content">
								<input type="text" name="quizlevel_email_subject" id="quizlevel_email_subject" value="<?= $notification_email_subject ?>">
								<div class="personalize_options">
								<a class=" notification-header show_merge_tags show_merge_tags1"> Personalize  <i class="fa fa-angle-down"></i></a>
								<!--merge tags  Modal  -->
								<div class=" addmerget-content addmergetagspreview1"  style="display: none;">

								<!--h4 class="modal-title mergetags_formheading" id="addmergetagsModalLabel1"> Personalization Tags </h4-->
								<div class=" mergetags_cont">
								<div class="notification_sidebar">
								<ul class="notification_email_fields">
								<li class="notification-header">Available Tags <i class="Personalize_close fa fa-times" aria-hidden="true"></i></li>
								<li class="addtoeditor">%%QUIZ_TITLE%%</li>
								<li class="addtoeditor">%%QUIZ_DESCRIPTION%%</li>
								<li class="addtoeditor">%%QUIZ_TYPE%%</li>
								<li class="addtoeditor">%%OUTCOME%%</li>
								<li class="addtoeditor">%%OUTCOME_DESCRIPTION%%</li>
								<li class="addtoeditor">%%NAME%%</li>
								<li class="addtoeditor">%%EMAIL%%</li>
								<li class="addtoeditor">%%ANSWERS%%</li>
								<li class="addtoeditor">%%QUESTION%%</li>
								<li class="addtoeditor">%%ANSWER%%</li>
								<li class="addtoeditor">%%SHOW_CATEGORY_TOTAL%%</li>
								<li class="addtoeditor">%%CATEGORY_TOTAL_PERCENT%%</li>
								<li class="addtoeditor">[CATEGORY_ONLY_PERCENT]</li>
								<li class="addtoeditor">%%CATEGORY_TOTAL_NUMBER%%</li>
								<li class="addtoeditor">%%CATEGORY_SCORES%%</li>
								<li class="addtoeditor">%%custom_[ENTER CUSTOM FIELD NAME]%% <div class="tool-tip custom-field-personalize"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc ">Say the name of the custom field is "tax_id".
Then you can use this merge tag to send the tax_id value in the email
%%custom_tax_id%%</div>
				</div></li>
								</ul>

								</div>

								</div>
								</div>
								</div>
							</div>
						</div>

						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>">
							<label for="" class="quiz_label">Body</label>
							<div class="quiz_right-content">
								<textarea class="sqb_text_editor" id="quizlevel_email_body" style="height: 200px;"><?php echo $notification_email_body ?></textarea> 
							</div>
						</div>
						<div class="quiz-content-card quizLevelCommonNotification" style="<?= $display ?>">
							<label for="" class="quiz_label">Select Answer Format <small>(this will be used to replace %%ANSWERS%%)</small></label>
							<p>The following will be displayed multiple times based on the total number of questions.</p>
							<div class="quiz_right-content">
								<textarea class="sqb_text_editor" id="quizlevel_answer_format">
									<?php echo $notification_answer_format; ?>
								</textarea> 
							</div>
						</div>
					</div>
					
					<div class="saved_data_msg  sqb-notification-save-btn-msg" style="display: none;">Saved Sucessfully!</div>

					<div class="quiz-actions justify-content-center">
						<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_quiz_level_notification"> Save </a>
					</div>
						
					</div>	
				</div>
			</div>
		</div>
	</div>
	<!-- end -->
	</div>	
</div>
