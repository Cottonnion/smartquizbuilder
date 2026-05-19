<h3 class="  quiz--title quiz_settings_head pb-0"  ><i class="fa fa-exchange" aria-hidden="true"></i><div class="smalltext_outer" >Export/Import Quiz data <!--<small style="color:#555;font-size: 15px;padding: 12px 0;margin: 0;display: inline-block;width: 100%;vertical-align: top;">When a user completes the quiz and opts-in, send an email notification to the admin (with lead & quiz details) and the user (with quiz results) </small>--></div> </h3>


<div class="quiz-card-outer-gray p-0">
	<div class="quiz-content-card">
		<div class="sqb-export-import-quiz-selection">
			<div class="sqb-export-import-quiz-options">
				<div class="sqb-export-import-quiz-item" data-value="all_quiz"> 
					<img src="<?php echo plugin_dir_url( __DIR__ ); ?>/images/import-export.png"> 
					<span>Export/import Quiz</span>
				</div>
				<div class="sqb-export-import-quiz-item " data-value="question_answers"> 
					<img src="<?php echo plugin_dir_url( __DIR__ ); ?>/images/import-csv.png"> 
					<span>Import Questions/Answers with CSV</span>
				</div>
				<div class="sqb-export-import-quiz-item " data-value="search_popup"> 
					<img src="<?php echo plugin_dir_url( __DIR__ ); ?>/images/search.png"> 
					<span>Search Popup</span>
				</div>
			</div>
		</div>

		<!-- Global Settings -->
		<div id="export-import-quiz-outer" style="display: none;">
			<h5 class="quiz--sub-title">Export/Import Quiz</h5>
			<span class="sqb-email-notification-selection-close" onclick="sqb_hide_sqb_quiz_export_import()">x</span>
			<ul class="nav nav-tabs" id="Quiz-reportsTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link active show" data-toggle="tab" href="#sqb_export_quiz_tab" role="tab" aria-controls="sqb_export_quiz_tab" aria-selected="false">Export Quiz</a>
				</li>
				<li class="nav-item">
					<a class="nav-link student-notification" data-toggle="tab" href="#sqb_import_quiz_tab" role="tab" aria-controls="sqb_import_quiz_tab" aria-selected="false">Import Quiz</a>
				</li>		
			</ul>
			
			<div class="tab-content " id="reports-tab-content">			
				<div class="tab-pane fade active show" id="sqb_export_quiz_tab" role="tabpanel" aria-labelledby="sqb_export_quiz_tab">
					<div class="tab-content pt-0" id="reports-tab-content1">
						<div class="tab-pane fade show active" id="Quiz_setting_tab_import" role="tabpanel" aria-labelledby="Quiz_setting_tab_import">
							<div class="">	
								<?php 
								$authenticated = false;
								if ( is_user_logged_in() && current_user_can('administrator') ) {
								$authenticated = true;
								}
								if($authenticated){
								?>
								<div class="fb-tracking-gray-outer">
									<div class="fb-tracking-content-card" style="display:block">
										<label for="" class="fb-tracking_label" style="max-width: 100%;width: 100%; flex-basis: 100%; margin-bottom:8px; color:#f56640;">Select Quiz that you want to EXPORT 
											<div class="tool-tip" style="color:#444444;">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc">When you export, a zip file will be downloaded. You can import the zip file wherever you want to import this quiz</div>
											</div>
										</label>
										
										<div class="fb-tracking_right-content" style="max-width: 100%;  padding: 0;">
											<div class="dropdown dropdown-custom-style" id="sqb_export_select_quiz_id">
												<button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-value="0" id="sqb_export_select_quiz">Select a Quiz</button>
												<div class="dropdown-menu" aria-labelledby="sqb_export_select_quiz">
													<a class="dropdown-item" href="javascript:void(0)" data-value="0" data-quiztype="">Select a Quiz</a>
													<?php 
													$i = 0;
													//get quiz data
													$quizdata = SQB_Quiz::load();									 
													if(isset($quizdata)){ 
														foreach($quizdata as $quiz_data_single_row) {
															$quiz_id = $quiz_data_single_row->getId(); 
															$quiz_type = $quiz_data_single_row->getQuizType(); 
															$quiz_name = $quiz_data_single_row->getQuizName(); 
															if($quiz_type == 'form'){
															} else {
														?>
															<a class="dropdown-item" href="javascript:void(0)" data-value="<?php echo $quiz_id; ?>" data-quiztype="<?php echo $quiz_type; ?>"><?php echo stripslashes($quiz_name); ?></a>
															<?php 
															$i++;
															}
														}
													}
													?>				
												</div>
											</div>
										</div>
										<!--<div class="quiz_type_selected_section" style="display:none;">Personality type of quiz selected.</div>-->
									</div>
													
									<div class="csvFileUpload">
										<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
											<div class="fb-tracking-actions sqbFbTrackingCommon" style="justify-content: space-around;">
												<a href="javascript:void(0);" class="fb-tracking--btn" onclick="sqb_export_quiz()" >Click HERE To Export </a>
											</div>
										</form>
									</div>			
								</div>
								<?php } ?>
							</div>
							
						</div>
					</div>
				</div>
				
				<div class="tab-pane fade" id="sqb_import_quiz_tab" role="tabpanel" aria-labelledby="sqb_import_quiz_tab">
					<div class="tab-content pt-0" id="reports-tab-content1">
						<div class="tab-pane fade show active" id="Quiz_setting_tab_import" role="tabpanel" aria-labelledby="Quiz_setting_tab_import">
							<div class="">	
								<?php 
								$authenticated = false;
								if ( is_user_logged_in() && current_user_can('administrator') ) {
								$authenticated = true;
								}
								if($authenticated){
								?>
								<div class="fb-tracking-gray-outer">
									<div class="csvFileUpload">
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
												<div class="fb-tracking-actions sqbFbTrackingCommon" style="justify-content: space-around;">
													<a href="javascript:void(0);" class="fb-tracking--btn" onclick="sqb_import_quiz()">Click HERE To Import </a>
												</div>
											</form>
										</div>	
								 </div>
								<?php } ?>
							</div>
						</div>
					</div><!----end-->
					
				</div>
			</div>
	</div>

	<!-- Quiz Level Notification -->

	<div id="import-question-answers-outer" style="display: none;">
		<h5 class="quiz--sub-title">Import Question/Answers with CSV</h5>
		<span class="sqb-email-notification-selection-close" onclick="sqb_hide_sqb_quiz_export_import()">x</span>
		

	<div class="tab-content pt-0" id="reports-tab-content1">
		<div class="tab-pane fade show active" id="Quiz_setting_tab_import" role="tabpanel" aria-labelledby="Quiz_setting_tab_import">
			<div class="Restriction-Settings-content">	
				<?php 
				$authenticated = false;
				if ( is_user_logged_in() && current_user_can('administrator') ) {
				$authenticated = true;
				}
				if($authenticated){
				?>
				<div class="fb-tracking-gray-outer">
									<div class="fb-tracking-content-card" style="display:block">
										<label for="" class="fb-tracking_label" style="max-width: 100%;width: 100%; flex-basis: 100%; margin-bottom:8px; color:#f56640;">Select Quiz</label>
										<div class="fb-tracking_right-content" style="max-width: 100%;  padding: 0;">
											<div class="dropdown dropdown-custom-style" id="sqb_import_select_quiz_id">
												<button class="dropdown-toggle" type="button" aria-haspopup="true" aria-expanded="false" data-value="0" id="sqb_import_select_quiz">Select a Quiz</button>
												<div class="dropdown-menu" aria-labelledby="sqb_import_select_quiz_id">
													<a class="dropdown-item" href="javascript:void(0)" data-value="0" data-quiztype="">Select a Quiz</a>
													<?php 
													$i = 0;
													//get quiz data
													$quizdata = SQB_Quiz::load();									 
													if(isset($quizdata)){ 
														foreach($quizdata as $quiz_data_single_row) {
															$quiz_id = $quiz_data_single_row->getId(); 
															$quiz_type = $quiz_data_single_row->getQuizType(); 
															$quiz_name = $quiz_data_single_row->getQuizName(); 
															if($quiz_type == 'form'){
															} else {
														?>
															<a class="dropdown-item" href="javascript:void(0)" data-value="<?php echo $quiz_id; ?>" data-quiztype="<?php echo $quiz_type; ?>"><?php echo stripslashes($quiz_name); ?></a>
															<?php 
															$i++;
															}
														}
													}
													?>				
												</div>
											</div>
										</div>
										<div class="quiz_type_selected_section" style="display:none;">Personality type of quiz selected.</div>
									</div>
									
										<div class="csvFileUpload">
											<form class="form-horizontal" action="#" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
												<div class="input-row">
													<label class="control-label">Upload File</label>
													<input type="file" name="file" id="file" accept=".csv">
													<a class="sqb_download_sample_csv" data-id="instructions_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB CSV Import Instructions.xlsx" href="javascript:void(0);">Instructions</a>
													
													<a data-toggle="modal" data-target="#download-sample-csv" class="sqb_download_sample_csv_popup" data-id="sample_csv" data-url="<?php echo plugins_url(); ?>/smartquizbuilder/includes/samplecsv/SQB_SampleQuestionAnswer.xlsx" href="javascript:void(0);">Download Sample CSV</a>
													
												</div>
												<div class="sqb_import_msg csv_validation_message" style="display:none;">There is something wrong.</div>
												<div class="sqb_import_msg csv_sucess_message" style="display:none;">Imported Successfully</div>
												<div class="fb-tracking-actions sqbFbTrackingCommon" style="justify-content: space-around;">
													<a href="javascript:void(0);" class="fb-tracking--btn" id="import-btn">Click HERE To Import </a>
												</div>
											</form>
										</div>	
								</div>
								<?php } ?>
			</div>
		</div>
	</div>
		
		
	</div>
	<div id="search-popup-quiz-outer" style="display: none;">
		<h5 class="quiz--sub-title">Search Popup</h5>
		<span class="sqb-email-notification-selection-close" onclick="sqb_hide_sqb_quiz_export_import()">x</span>

		<div class="fb-tracking-gray-outer search-popup-quiz-list" bis_skin_checked="1">
									<div class="fb-tracking-content-card" style="display:block" bis_skin_checked="1">
										<label for="" class="fb-tracking_label" style="max-width: 100%;width: 100%; flex-basis: 100%; margin-bottom:8px; color:#f56640;">Want to find out all the pages where you quiz (popup) is active?
											<div class="tool-tip" style="color:#444444;" bis_skin_checked="1">
												<i class="fa fa-info-circle" aria-hidden="true"></i>
												<div class="toll-tip-desc" bis_skin_checked="1">Here is an easy way to find all the pages where the popup quiz is active.</div>
											</div>
										</label>
										
										<div class="fb-tracking_right-content">
											<select id="sqb-search-by" class="simple-select">
												<option value="quiz-name">Search by quiz name</option>
												<option value="page-url">Search by page URL</option>
											</select>
										</div>
										<div class="search-by-quiz-wrapper">
												<label for="" class="fb-tracking_label">Select popup quiz 
													<div class="tool-tip" style="color:#444444;" bis_skin_checked="1">
														<i class="fa fa-info-circle" aria-hidden="true"></i>
														<div class="toll-tip-desc" bis_skin_checked="1">List of Pages where this popup is active</div>
													</div>
												</label>

												<?php 
													$quizzes = SQB_Quiz::loadByPopup();
												?>
												<div class="fb-tracking_right-content"  bis_skin_checked="1">
													<select class="search-quiz" id="search-quiz">
														
														<?php 
														$pages = array();
														if(!empty($quizzes)){
															foreach($quizzes as $quiz){
																$quiz_pages = $quiz->getQuizDisplayUrls();
																if(!empty($quiz_pages)){
																	$q = explode(',',$quiz_pages);
																	$pages = array_merge($q,$pages);
																}
																?>
																<option value="<?php echo $quiz->getId(); ?>"><?php echo $quiz->getQuizName(); ?></option>
															<?php } 
														} ?>
													</select>
												</div>
											</div>
										</div>

										<div class="search-by-page-wrapper" style="display:none">
												<label for="" class="fb-tracking_label">Select page URL 
													<div class="tool-tip" style="color:#444444;" bis_skin_checked="1">
														<i class="fa fa-info-circle" aria-hidden="true"></i>
														<div class="toll-tip-desc" bis_skin_checked="1">Current this page has these quizzes:</div>
													</div>
												</label>

												<?php 
													/*echo '<pre>';
													print_r($pages);
													exit;*/
													
													$args = array(
														'post_type' => 'page',
														'post__in' => $pages
													);

													$wp_pages = new WP_Query($args);
												?>
												<div class="fb-tracking_right-content"  bis_skin_checked="1">
													<select class="search-quiz" id="search-page">
														
														<?php 
														$pages = array();
														if(!empty($wp_pages->posts)){
															foreach($wp_pages->posts as $page){
																$page_id = $page->ID;
																$page_title = $page->post_title;
																
																?>
																<option value="<?php echo $page_id; ?>"><?php echo $page_title; ?></option>
															<?php } 
														} ?>
													</select>
												</div>
										</div>

									<div class="search_popup_result" style="display:none">

									</div>
													
									<div class="csvFileUpload" bis_skin_checked="1">
										
										<div class="fb-tracking-actions sqbFbTrackingCommon" style="justify-content: space-around;" bis_skin_checked="1">
											<a href="javascript:void(0);" class="fb-tracking--btn" id="btn-search-popup">Click HERE To Search </a>
										</div>
										
									</div>			
								</div>
	</div>
	<!-- end -->
	</div>	
</div>
