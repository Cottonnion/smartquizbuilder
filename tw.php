<?php 

if(isset($_GET['sqbtw'])){

   //include_once(dirname(__FILE__).'../../../../wp-load.php');
     
     
    parse_str(base64_decode($_GET['sqbtw']), $output);
  
 //print_r( $output);
 
 if(isset($_GET['sqbtw']) && (strpos($_SERVER['HTTP_USER_AGENT'] , 'Twitterbot') !== false)){
   
	 $quiz_id = $output['quiz_id'];
	 $outcome_id = $output['outcome_id'];
	 $v1 = $output['v1'];
	 $v2 = $output['v2'];
	 $outcome_title = '';
	 //print_r($output);
	 
	 
	 $quiz_obj = SQB_Quiz::loadById($quiz_id);
	 $quiz_title = '';
	
	 if($quiz_obj){
		$quiz_title =  $quiz_obj->getQuizName();
	    $quiz_type = $quiz_obj->getQuizType();
	    $outcome_obj  = SQB_Outcome::loadById($outcome_id);
	    if($outcome_obj){
			 $outcome_title = $outcome_obj->getOutcomeName();
	    }
	 
	 
	 
	   $share_name = "";
	   $share_description = "";
	   $share_pictureurl = "";
	 
	   $social_share_obj = SQB_Social_Share:: loadByQuizId($quiz_id);
	
	
	 if(isset($social_share_obj)){
		 $share_name = $social_share_obj->getTitle();
		 $share_description = $social_share_obj->getTwDescription();
		 $share_pictureurl = $social_share_obj->getImage();
		 
	 }
	
	 
	 $share_description =  str_replace("%%OUTCOMETITLE%%",$outcome_title,$share_description);
	 $share_description =  str_replace("%%QUIZTITLE%%",$quiz_title,$share_description);
	 
	 
	 if($quiz_type == 'assessment'){
	    
	    $crrect_ans = $v2;
	    $total_question = $v1;
		$share_description =  str_replace("%%CORRECTANSWERS%%",$crrect_ans,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",$total_question,$share_description);
	 
	 }else if($quiz_type == 'scoring'){
	    $total_pt = $v1;
		$sqb_points_ans = $v2;
		$share_description =  str_replace("%%YOURSCORE%%",$sqb_points_ans,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",$total_pt,$share_description);
	}else{
		
		$share_description =  str_replace("%%CORRECTANSWERS%%",0,$share_description);
		$share_description =  str_replace("%%TOTALQUESTIONS%%",0,$share_description);
		$share_description =  str_replace("%%YOURSCORE%%",0,$share_description);
		$share_description =  str_replace("%%TOTALSCORE%%",0,$share_description);
	}
    
     

 
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
   $share_description =  htmlentities($share_description).' '.htmlentities($share_name);
		

?>
<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:title" content="<?php echo  htmlentities($share_description); ?>">   
			
		
			<meta name="twitter:description" content="<?php  //echo htmlentities($share_description); ?>">
			<meta name="twitter:image" content="<?php echo htmlentities($share_pictureurl); ?>">
			
			
			<meta property="og:type"               content="article" />
			<meta property="og:url"               content="<?php echo $actual_link;?>" />
			
			<meta property="og:title"              content="<?php echo htmlentities($share_description);?>" />
			<meta property="og:description"        content="<?php //echo htmlentities($share_description);?>" />
			<meta property="og:image"              content="<?php echo htmlentities($share_pictureurl);?>" />
			<meta property="og:image:width"        content="620" />
			<meta property="og:image:height"       content="541" />
			<?php  } 

  }else{
	  
	  $quiz_id = $output['quiz_id'];
	     $social_share_obj = SQB_Social_Share:: loadByQuizId($quiz_id);
	     $share_url = get_site_url('');
		 if(isset($social_share_obj)){
			// print_r($social_share_obj);
			 $share_url = $social_share_obj->getShareLink();
			 if($share_url == ''){
				 $share_url = get_site_url('');
			 }else{
				 $share_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$share_url;
				 
			}
		 }
		
		
		
		
		
		header('Location: '.$share_url);
		echo "<script>window.location.href='".$share_url."';</script>";
		exit();
  }

}
