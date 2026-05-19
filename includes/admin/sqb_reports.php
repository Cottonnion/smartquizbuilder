<?php


include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
	$start_date = date('m/d/Y');		
	$end_date = date('m/d/Y');		
?>

<div class="Quiz-reports-tab-inner">
	<ul class="nav nav-tabs" id="Quiz-reportsTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link  <?php if($_GET['page'] != 'sqb_question_answer_report' && $_GET['page'] != 'sqb_manage_leads'){ echo 'active';} ?>"  data-toggle="tab" href="#Report" role="tab" aria-controls="Report" aria-selected="true">Reports</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if($_GET['page'] == 'sqb_manage_leads'){ echo 'active';} ?>"  data-toggle="tab" href="#reports_manage_leads" role="tab" aria-controls="reports_manage_leads" aria-selected="false">Manage Leads</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if($_GET['page'] == 'sqb_search_reports'){ echo 'active';} ?>"  data-toggle="tab" href="#reports_manage_leads_search" role="tab" aria-controls="reports_manage_leads_search" aria-selected="false">Search / Analytics</a>
		</li>
		<?php 
		if(defined("SAVEQUESTIONANSWERREPORT") && (SAVEQUESTIONANSWERREPORT == "N")){}else{ ?>
		<li class="nav-item">
			<a class="nav-link <?php if($_GET['page'] == 'sqb_question_answer_report'){ echo 'active';} ?>"  data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Questions & Answers Data</a>
		</li>
		<?php } ?>
		
		<li class="nav-item">
			<a class="nav-link <?php if($_GET['page'] == 'sqb_leaderboard'){ echo 'active';} ?>"  data-toggle="tab" href="#leaderboard" role="tab" aria-controls="leaderboard" aria-selected="false">Leaderboard</a>
		</li>
		
		
		  
		
	</ul>
</div>

<div class="tab-content" id="reports-tab-content">
	<div class="tab-pane fade <?php if($_GET['page'] != 'sqb_question_answer_report' && $_GET['page'] != 'sqb_manage_leads'){ echo 'active show';} ?> " id="Report" role="tabpanel" aria-labelledby="Report-tab">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		

		<div class="stats_filter_outer">
			<div class="filter_dropdown">
				<div class="dropdown dropdown-custom-style">
					<?php 
					$startQuiz_name = 'All Quizzes';
					$startQuiz_id  = 'all_quiz';
					if(($_GET['page'] == 'sqb_reports') && isset($_GET['stats_id'])){
						$startQuiz_obj = SQB_Quiz::loadById($_GET['stats_id']); 
						
						
						if($startQuiz_obj){
							$startQuiz_name = $startQuiz_obj->getQuizName();
							$startQuiz_id = $_GET['stats_id'];
						}
						
						
					}
					?>
					<button class="dropdown-toggle" type="button" id="SelectQuizNo"  aria-haspopup="true" aria-expanded="false" data-value="<?php echo $startQuiz_id; ?>"><?php echo $startQuiz_name;?></button>
					<div class="dropdown-menu SelectQuizNo_list" aria-labelledby="SelectQuizNo">
						<?php 
							$quiz_list  = '';
							$quiz_list .= '<a class="dropdown-item" href="javascript:void(0)" data-value="all_quiz">All Quizzes</a>';
								$quizObjArray = SQB_Quiz::load();
								if(is_array($quizObjArray) && count($quizObjArray)){
									foreach($quizObjArray as $quizObj){
										
										$quiz_list .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$quizObj->getId().'">'.$quizObj->getQuizName().' (ID: '.$quizObj->getId().')</a>';
									}
								}
							echo $quiz_list;

						?>
						
					</div>
				</div>

				<div class="dropdown dropdown-custom-style">
					<button class="dropdown-toggle" type="button" id="SelectTimeButton"   aria-haspopup="true" aria-expanded="false" data-value="all_time">All Time</button>
					<div class="dropdown-menu select_report_time_option" aria-labelledby="SelectTimeButton">
						<a class="dropdown-item" href="javascript:void(0)" data-value="today">Date: Today</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="yesterday">Yesterday</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="last_seven_days">Last 7 days</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="last_three_month">Last 3 Months</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="last_six_month">Last 6 Months</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="last_year">Last Year</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="all_time">All Time</a>
						<a class="dropdown-item" href="javascript:void(0)" data-value="custom_range">Custom Range</a>
					</div>
					<div class= "custom_range_wrapper" style="display:none">
						<div class="QA-Start-date">
							<input type="text" class="form-control" placeholder="Start Date" id="reports_start_date">
						</div>
						<div class="QA-End-date">
							<input type="text" class="form-control" placeholder="End Date" id="reports_end_date">
						</div>
					</div>
					
					
				</div>
				
				
				

				<!--<div class="sqb-reports-action">
					<!--button type="button" class="btn btn-info sqb_transprent_btn" onclick="sqb_load_reports()">Load Reports</button-->
					<!--<button type="button" class="btn btn-danger sqb_empty_stats_table">Empty Stats</button>
				</div>-->
			</div>
			<div class="IP-track-option d-none">
				<label>Don't track these IPs:</label>
				<input type="text" class="form-control" placeholder="Enter IP Address">
				<button type="button" class="btn btn-success save_ip_address">Save</button>
			</div>
		</div>

		<div class="top_member_detail_outer">
			<div class="top_member_detail_box">
				<h5>Total Views</h5>
				<h1 title1="Click to view details">
					<span class="total_visit">0</span>
				</h1>
			</div>
			<div class="top_member_detail_box">
				<h5>Total Clicks</h5>
				<h1 title1="Click to view details">
					<span class="total_click">0</span>
			   </h1>
			</div>
			<div class="top_member_detail_box"> 
				<h5>Total Completed</h5>
				<h1 title1="Click to view details">
					<span class="total_completed">0</span>
				</h1>
			</div>
			
			<div class="top_member_detail_box">
				<h5>Total Opted In</h5>
				<h1 title1="Click to view details">
					<span class="total_opted_in">0</span>
				</h1>
			</div>
			<div class="top_member_detail_box">
				<h5>Reached Outcome</h5>
				<h1 class="total_reached_outcome">0</h1>
			</div>
			
			<div class="top_member_detail_box">
				<h5>Outcome CTA Clicks</h5>
				<h1 title1="Click to view details">
					<span class="total_clicked_on_outcome_CTA">0</span>
				</h1>
			</div>
		</div>

		<div class="stats_left_tabbar_outer"> 
			<div class="top-info-block">
				<a class="view_video-btn" data-toggle="modal" id="view_video_report" data-target="#sqb_video_report">Watch Video</a>
				<a href="javascript:void(0)" class="sqb_reports_empty_stats sqb_empty_stats_table">Empty Stats</a>
				<div class="filter-table-group">
					<label>Group By:</label> 
					<div class="dropdown dropdown-custom-style">
						<button class="dropdown-toggle" type="button" id="Select_report_group_action_button"   aria-haspopup="true" aria-expanded="false" data-value='all'>All</button>
						<div class="dropdown-menu Select_report_group_action" aria-labelledby="SelectdateButton">
							<a class="dropdown-item report_group_action_day" href="javascript:void(0)" data-value="day" style="display:none">Day</a>
							<a class="dropdown-item report_group_action_month" href="javascript:void(0)" data-value="month" style="display:none">Month</a>
							<a class="dropdown-item report_group_action_year" href="javascript:void(0)" data-value="year" style="display:none">Year</a>
							<a class="dropdown-item report_group_action_all" href="javascript:void(0)" data-value="all"  >All</a>
							
						</div>
					</div>
				</div>
			</div>
			<div class="table-responsive overall_total_table" id="overall_totals_table_outer_wrapper">
				
			</div>
		</div>
	</div>

	
	<?php  include_once('sqb_manage_leads.php'); ?>
	
		<?php 
		if(defined("SAVEQUESTIONANSWERREPORT") && (SAVEQUESTIONANSWERREPORT == "N")){}else{ ?>
   
	<div class="tab-pane fade reports_tab_question_answer  <?php if($_GET['page'] == 'sqb_question_answer_report'){ echo ' show active';} ?>" id="contact" role="tabpanel" aria-labelledby="contact-tab">
		<div class="date-filter_dropdown">
			<div class="QA-date-feilds">
				<div class="dropdown dropdown-custom-style select-quiz-dropdown">
					
					<?php 
					
							
					        $qar_quiz_name = '';
						    $qar_quiz_id = '';
						    $quiz_list  = '';
							$quizObjArray = SQB_Quiz::load();
							if(is_array($quizObjArray) && count($quizObjArray)){
								$qar_quiz_name = $quizObjArray[0]->getQuizName(); 
								$qar_quiz_id = $quizObjArray[0]->getId(); 
								$qar_quiz_type = $quizObjArray[0]->getQuizType(); 
								foreach($quizObjArray as $quizObj){
									$quiz_list .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$quizObj->getId().'">'.$quizObj->getQuizName().'  ('.ucwords($quizObj->getQuizType()).')</a>';
									
									
								}
							}
							
						    $qar_selected = '';
						    $quiz_type = '';
							if(isset($_GET['quiz_id'])){
								  $qar_quiz_id = $_GET['quiz_id'];
								  $qar_quiz_obj =  SQB_Quiz::loadById($qar_quiz_id);
								  if($qar_quiz_obj){
										$qar_quiz_name = $qar_quiz_obj->getQuizName(); 
										$qar_quiz_id = $qar_quiz_obj->getId(); 
										$quiz_type = $qar_quiz_obj->getQuizType(); 

								  }
							 }
							 
							 	
					?>		 
					
					<button class="dropdown-toggle question_answer_report_quiz_id" type="button" id="QA-Select"   aria-haspopup="true" aria-expanded="false" data-value="<?php echo $qar_quiz_id;?>"><?php echo $qar_quiz_name.'  ('.ucwords($qar_quiz_type).')';?></button>
					<div class="dropdown-menu question_answer_report_quiz_list" aria-labelledby="QA-Select">						
						<?php 
						    
							
							echo $quiz_list;

						?>	
					</div>
				</div>

				<div class="QA-Start-date">
					<input type='text' class="form-control" placeholder="Start Date" value="<?= $start_date; ?>" id="sqb_qanr_start_date" />
				</div>
				<div class="QA-End-date">
					<input type='text' class="form-control" value="<?= $end_date; ?>"  placeholder="End Date" id="sqb_qanr_end_date" />   
				</div>
			</div>
			<div class="sqb-QA-action">
				<button type="button" class="btn sqb_transprent_btn" onclick="sqb_question_answer_report()" >Search</button>
			</div>
		</div>

		<div class="accordion question_answer_report_wrapper admintester" id="QA-accordion">
		 <?php 	
		   
		   if($quiz_type != 'poll'){

		   	echo  SqbLoadQuestionAnswerReport($qar_quiz_id, $start_date, $end_date);
		   }else{
		   	echo "Poll content";
		   }
			
			
			
			?>
			
			
			
		</div>

	</div>
	<?php  } ?> 


	
	<?php 
	$assets_version = time();
	wp_enqueue_style("sqb_leaderboard_frontend",SQB_URL.'includes/css/sqb_leaderboard_fe.css', false,$assets_version ); ?>
	<div class="tab-pane fade reports_tab_leaderboard  <?php if($_GET['page'] == 'sqb_leaderboard'){ echo ' show active';} ?>" id="leaderboard" role="tabpanel" aria-labelledby="leaderboard-tab">
		<div class="date-filter_dropdown">
			<div class="QA-date-feilds">
				<div class="dropdown dropdown-custom-style">

						<?php 
						$leaderboards = SQB_LeaderboardPage::load();
						$default_id = 0;
						$lb_list = '';
						$default_name = '';
						$lb_list = '<a class="dropdown-item" href="javascript:void(0)" >Select Leaderboard Page</a>';
						foreach ($leaderboards as $key => $leaderboard) {

							if($key == 0){
								$default_id = $leaderboard->getId();
								$default_name = $leaderboard->getName();
							}

							$lb_list .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$leaderboard->getId().'">'.$leaderboard->getName().'  (ID : '.ucwords($leaderboard->getId()).')</a>';
						}
						?>

					<button class="dropdown-toggle leaderboard_list leaderboard_list_id" type="button" id="QA-Select"   aria-haspopup="true" aria-expanded="false" data-value="0">Select Leaderboard Page</button>
					<div class="dropdown-menu leaderboard_list leaderboard_list-dd" aria-labelledby="QA-Select">	

						<?php echo $lb_list ?>
					</div>
				</div>

			</div>
			<div class="sqb-QA-action">
				<button type="button" class="btn sqb_transprent_btn" onclick="sqb_print_leaderboard()" >Search</button>
			</div>
			<div class="sqb-QA-action opt-in-out">
				<button type="button" class="btn sqb_transprent_btn mr-2" onclick="sqb_optin_leaderboard()" >Opt-in</button>
				<button type="button" class="btn sqb_transprent_btn show_optout_leaderboard" >Opt-out </button>
			</div>
		</div>

		<div class="accordion leaderboard_list_wrapper">
			
		</div>
	</div>


</div>
<script>
	var start_date = '<?= $start_date ?>';		
	var end_date = '<?= $end_date; ?>';			
</script>



<div class="modal fade quiz-popup-style" id="sqb_video_report" tabindex="-1" role="dialog" aria-labelledby="sqb_video_report">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i> </button>
				<div class="youtube-video-wrapper">
					<iframe width="100%" height="600" src="https://www.youtube.com/embed/4yksrkZpguk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal quiz-popup-style" id="leaderboard_optin" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Opt-in</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<div class="modal-body">				 
				<div class="d-inline-block w-100 mt-3">
					<div class="leaderboard_optin_table">
						<div class="leaderboard_optin_message mb-4">
							<strong>What does opt-in mean?</strong>
							<div class="tool-tip"><i class="fa fa-info-circle" aria-hidden="true"></i>
								<div class="toll-tip-desc" style="max-width:400px;">
									This will show a list of users that have opted-out of leaderboard display. If you want to manually opt them in again, select the user to opt them back in. Also, opt-in does not mean users will be automatically added to the top of the leaderboard. It just means they agree to participate in the leaderboard
								</div>
							</div>

							
						</div>
						<table class="table table-striped scrolldown ad_table">
							<thead>
								<tr>
									<th>Name</th>											 
									<th>Email</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody class="ad_tbody show-optin-users">
																	 							 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal quiz-popup-style" id="leaderboard_optout" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Opt-out</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
			</div>
			<div class="modal-body">				 
				<div class="d-inline-block w-100 mt-3">
					<div class="leaderboard_optin_table">
						<div class="leaderboard_optin_message mb-4">
							<strong>Enter Email of the user who needs to be opted out of the leaderboard. These users will not be displayed in the leaderboard. </strong>
						</div>
						<div class="leaderboard-optout-outer">
							<input type="text" name="get_email" class="leaderboard-getemail" placeholder="Enter Email">
							<button class="optout-user btn sqb_transprent_btn" onclick="sqb_optout_leaderboard()">Click here to Opt-out this user</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>