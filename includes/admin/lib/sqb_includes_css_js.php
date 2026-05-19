<?php

add_action( "admin_enqueue_scripts", "sqbCommonScripts", 100 );
//add_action( "admin_footer", "csCommonScriptsHead" ,1 );

function sqbCommonScripts(){	
	$current_version_plugin = rand(10,1000);	
	
	$include_common_js_css_on_page = array(
										"smartquizbuilder",
										"sqb_add_quiz",
										"sqb_manage_funnel",
										"sqb_add_funnel",
										"sqb_reports",
										"sqb_manage_leads",
										"sqb_settings",
										"sqb_social_share",
										"sqb_question_answer_report",
										"sqb_settings",
										"sqb_fb_tracking",
										"sqb_gdpr",
										"sqb_question_bank",
										"sqb_student_home",
										"sqb_leaderboard_page",
										"sqb_pdf_content",
										"sqb_create_student_page",
										"sqb_create_leaderboard_page",
										"sqb_create_pdf_content_page",
									);
	
  if(isset($_GET["page"])){
	if(in_array($_GET["page"], $include_common_js_css_on_page)){
		
		//include fonts
		$is_googlefont = get_option('sqb_google_font_option', true);
		if($is_googlefont != 'N' || $is_googlefont == '1'){
			wp_enqueue_style( 'fonts.googleapis-family-Open-sans-css','//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Open+Sans:wght@300;400;600;700;800', false );
			wp_enqueue_style( 'fonts.googleapis-family-Raleway-css','//fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap', false );
			wp_enqueue_style( 'fonts.googleapis-family-DM-Sans-css','//fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap', false );
		}
		wp_enqueue_style( 'font-awesome-latest-css','//use.fontawesome.com/releases/v5.3.1/css/all.css', false );
		wp_enqueue_style( 'font-awesome-css','//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css', false );

		//include css
		wp_enqueue_style( "sqb_bootstrap.min","//stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css", false, "4.1.0" );

		wp_enqueue_style( "sqb_bootstrap_animation","//cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css", false, "3.7.0" );
		
		wp_enqueue_style("sqb_header",plugin_dir_url(__FILE__)."../../css/sqb_header.css", false, SQBFLOW_VER );
		wp_enqueue_style("sqb_manage_quiz",plugin_dir_url(__FILE__)."../../css/sqb_manage_quiz.css", false, SQBFLOW_VER );
		wp_enqueue_style("sqb_quiz",plugin_dir_url(__FILE__)."../../css/sqb_quiz.css", false, $current_version_plugin );
		
		wp_dequeue_script('bootstrap');
		wp_dequeue_script('wpil_popper');
		wp_dequeue_script('wpil_admin_script');
		wp_dequeue_script('wp-reset');
		wp_dequeue_script('cs-framework');
		wp_dequeue_script('cs-plugins');
		wp_dequeue_style('cs-framework');
		wp_dequeue_style('bootstrap');
		wp_dequeue_script('wp-color-picker');
		wp_dequeue_script('wp-color-picker-alpha');
		wp_dequeue_script('bs_cache_sweetalert_js');
		wp_deregister_script('bs_cache_sweetalert_js');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-resizable');
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-draggable');
		wp_enqueue_script('jquery-ui-droppable');

		//includes js
		//wp_enqueue_script( "sqbjquery","//code.jquery.com/jquery-3.3.1.min.js", false, "3.3.1" );		
		wp_enqueue_script( "sqb_popper","https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js", false, '1.16.0' );		
		//wp_enqueue_script( "ui_jquery","https://code.jquery.com/ui/1.12.1/jquery-ui.js", false, '1.16.0' );		
		wp_enqueue_script("sqb_bootstrap.min.js","//stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js", false, "4.1.0",true );	
		wp_enqueue_script("sqb_bootstrap_slider.min.js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/bootstrap-slider.min.js", false, "10.0.2" );		
		wp_enqueue_style("sqb_bootstrap_slider_min-css","//cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.2/css/bootstrap-slider.min.css", false,'10.0.2' );

		wp_enqueue_script("sqb_vide_js","//cdnjs.cloudflare.com/ajax/libs/video.js/8.0.4/video.min.js", false,'10.0.2' );
		wp_enqueue_style("sqb_vide_css","//cdnjs.cloudflare.com/ajax/libs/video.js/8.0.4/video-js.min.css", false, "2.5.2" );	
			
		/*echo '<link href="https://unpkg.com/video.js/dist/video-js.min.css" rel="stylesheet">
		<script src="https://unpkg.com/video.js/dist/video.min.js"></script>';*/
		
		wp_enqueue_script("sqb_bootstrap_colorpicker.min.js","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/js/bootstrap-colorpicker.min.js", false, "2.5.2" );	
		wp_enqueue_style("sqb_bootstrap_colorpicker_min-css","//cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.2/css/bootstrap-colorpicker.min.css", false,'2.5.2' );
		
		
		//if($_GET["page"] != 'sqb_add_funnel'){
			wp_enqueue_script("sqb_sweetalert2-min-js", "//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.16.0/sweetalert2.all.js", false, "7.16.0", true); 
		wp_enqueue_style( "select","//cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css", false, "4.1.0" );
		wp_enqueue_script( "select","//cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" );
		//}
		     
		$include_tinymce_js_on_page = array('sqb_add_quiz', 'sqb_add_funnel','sqb_question_bank','sqb_reports');
		
		if(in_array($_GET['page'], $include_tinymce_js_on_page)){
			//wp_enqueue_script("sqb_tinymce-min-js", "//cdn.tinymce.com/4/tinymce.min.js?ver=4.9.4", array("jquery"));
			if(file_exists(plugin_dir_path(__FILE__)."../../../../../../wp-includes/js/tinymce/tinymce.min.js")){
				wp_enqueue_script("sqb_tinymce_min_js", plugin_dir_url(__FILE__)."../../../../../../wp-includes/js/tinymce/tinymce.min.js", array("jquery"));
			}else{
				wp_enqueue_script("sqb_tinymce_min_js", site_url('')."/wp-includes/js/tinymce/tinymce.min.js", array("jquery"));
			}
			wp_enqueue_script("sqb_tinymce_plugin_min_js",plugin_dir_url(__FILE__)."../../js/tinymce_plugin.min.js", array("jquery"));
			
	   }
	   
	   $include_datatable_on_page = array('smartquizbuilder', 'sqb_add_quiz', 'sqb_manage_leads', 'sqb_question_bank','sqb_reports');
		if(in_array($_GET['page'], $include_datatable_on_page)){
			 wp_enqueue_style("sqb_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false, "1.10.19");
			 wp_enqueue_style("sqb_datatables-buttons" , "//cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css",  false, "1.10.19");
			 wp_enqueue_script("sqb_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",  false, "1.10.19");
			 wp_enqueue_script("sqb_datatables-button" , "//cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js",  false, "1.10.19");
			 wp_enqueue_script("sqb_datatables-html" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js",  false, "1.10.19");
			 wp_enqueue_script("sqb_datatables-print" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js",  false, "1.10.19");
		}
	   
        wp_enqueue_style("sqb_common_backend",plugin_dir_url(__FILE__)."../../css/sqb_common_backend.css?v=".rand(1,1000), false, SQBFLOW_VER );
        wp_enqueue_script("sqb_common",plugin_dir_url(__FILE__)."../../js/sqb_common.js", false, SQBFLOW_VER );
	}
	
	if(($_GET["page"] == "sqb_add_quiz") || ($_GET["page"] == "sqb_reports") || ($_GET["page"] == "sqb_manage_leads") || ($_GET["page"] == "sqb_social_share") || ($_GET["page"] == "sqb_settings") || ($_GET["page"] == "sqb_student_home") || ($_GET["page"] == "sqb_leaderboard_page") || ($_GET["page"] == "sqb_pdf_content") || ($_GET["page"] == "sqb_create_student_page") || ($_GET["page"] == "sqb_create_leaderboard_page") || ($_GET["page"] == "sqb_create_pdf_content_page") || ($_GET["page"] == "sqb_question_answer_report") ){       
		
		 
		 wp_enqueue_style("sqb_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false, "1.10.19");
		 wp_enqueue_style("sqb_datatables-buttons" , "//cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css",  false, "1.10.19");
		 wp_enqueue_script("sqb_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",  false, "1.10.19");
		 wp_enqueue_script("sqb_datatables-button" , "//cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js",  false, "1.10.19");
		 wp_enqueue_script("sqb_datatables-html" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js",  false, "1.10.19");
		 wp_enqueue_script("sqb_datatables-print" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js",  false, "1.10.19");
	
		wp_enqueue_style("sqb_datepicker-_ui" , "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css",  false, "1.12.1");
		wp_enqueue_style("sqb_datepicker" , "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css",  false, "1.9.0");
		
		
		wp_enqueue_script("sqb_datepicker" , "//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js",  false, "1.9.0",true); 

		wp_enqueue_script("sqb_moment" , "//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js",  false, "2.22.2"); 
		wp_enqueue_script("sqb_tempusdominus" , "//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js",  false, "5.0.1"); 
	  	wp_enqueue_style("sqb_tempusdominus_css" , "//cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css",  false, "5.0.1");
		
		
		
		//wp_enqueue_script("sqb_tinymce-min-js", "//cdn.tinymce.com/4/tinymce.min.js?ver=4.9.4", array("jquery"));
		if(file_exists(plugin_dir_path(__FILE__)."../../../../../../wp-includes/js/tinymce/tinymce.min.js")){
				wp_enqueue_script("sqb_tinymce_min_js", plugin_dir_url(__FILE__)."../../../../../../wp-includes/js/tinymce/tinymce.min.js", array("jquery"));
		}else{
				wp_enqueue_script("sqb_tinymce_min_js", site_url('')."/wp-includes/js/tinymce/tinymce.min.js", array("jquery"));
		}
		wp_enqueue_script("sqb_tinymce_plugin_min_js",plugin_dir_url(__FILE__)."../../js/tinymce_plugin.min.js", array("jquery"));
			
		
		 wp_enqueue_style("sqb_reports",plugin_dir_url(__FILE__)."../../css/sqb_reports.css", false, SQBFLOW_VER );	
		 wp_enqueue_style("sqb_social_share",plugin_dir_url(__FILE__)."../../css/sqb_social_share.css", false, SQBFLOW_VER );	
		 wp_enqueue_style("sqb_manage_leads",plugin_dir_url(__FILE__)."../../css/sqb_manage_leads.css", false, SQBFLOW_VER );
	 
		if($_GET["page"] == "sqb_add_quiz"){
			wp_enqueue_script("sqb_quiz",plugin_dir_url(__FILE__)."../../js/sqb_quiz.js?v=".rand(1,1000), false, $current_version_plugin );

			$data_ai_prompt = get_openAI_prompts_array();
			 wp_localize_script('sqb_quiz', 'openaiprompts', $data_ai_prompt);
			 
			wp_enqueue_script("sqb_questions",plugin_dir_url(__FILE__)."../../js/sqb_questions.js?v=".rand(1,1000), false, SQBFLOW_VER );
			wp_enqueue_script("sqb_quiz_question_tab",plugin_dir_url(__FILE__)."../../js/sqb_quiz_question_tab.js?v=".rand(1,1000), false, SQBFLOW_VER );

			wp_localize_script('sqb_quiz', 'SQBVar', array(
				    'url' => admin_url('admin-ajax.php'),
				    'sqb_import' => wp_create_nonce('sqb_import'),
				    'sqbSaveOutcomeTag' => wp_create_nonce('sqbSaveOutcomeTag'),
				    'sqbSaveAdvanced' => wp_create_nonce('sqbSaveAdvanced'),
				    'sqbSaveCategoryAdvancedRule' => wp_create_nonce('sqbSaveCategoryAdvancedRule'),
				    'sqbSaveCategoryAdvanced' => wp_create_nonce('sqbSaveCategoryAdvanced'),
				    'sqbgetemailnotificationsettingsbyquiztype' => wp_create_nonce('sqbgetemailnotificationsettingsbyquiztype'),
				    'sqbgetemailnotificationsettings' => wp_create_nonce('sqbgetemailnotificationsettings'),
				));

			wp_localize_script('sqb_quiz_question_tab', 'SQBSaveQuiz', array(
			    'url' => admin_url('admin-ajax.php'),
			    'sqbsavequiz' => wp_create_nonce('sqbsavequiz'),
			    'sqbSavedapPlatform' => wp_create_nonce('sqbSavedapPlatform'),
			    'sqbSavescpPlatform' => wp_create_nonce('sqbSavescpPlatform'),
			    'sqbSaveWebhookUrl' => wp_create_nonce('sqbSaveWebhookUrl'),
			    'sqbSaveQuizNotification' => wp_create_nonce('sqbSaveQuizNotification'),
			    'sqbUpdateEmailNotification' => wp_create_nonce('sqbUpdateEmailNotification'),
			));
		}	
		wp_enqueue_script("intlTelInput","//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/intlTelInput.js?v=".rand(1,1000), false, SQBFLOW_VER );
		wp_enqueue_script("mask","//cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.js?v=".rand(1,1000), false, SQBFLOW_VER );
		wp_enqueue_style("intlTelInput","//cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/css/intlTelInput.css", false, SQBFLOW_VER );

		wp_enqueue_style("sqb_manage_quiz",plugin_dir_url(__FILE__)."../../css/sqb_manage_quiz.css", false, SQBFLOW_VER );
		wp_enqueue_style("sqb_questions",plugin_dir_url(__FILE__)."../../css/sqb_questions.css", false, SQBFLOW_VER );
		wp_enqueue_style("sqb_question_drag_drop_elements",plugin_dir_url(__FILE__)."../../css/sqb_question_drag_drop_elements.css", false, SQBFLOW_VER );
		wp_enqueue_style("sqb_questions_answers",plugin_dir_url(__FILE__)."../../css/sqb_questions_answers.css", false, SQBFLOW_VER );
		wp_enqueue_script("chart",plugin_dir_url(__FILE__)."../../js/chart.js", false, SQBFLOW_VER );
		wp_enqueue_script("chart-plugin","//cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0", false, SQBFLOW_VER );
			
		if($_GET['page'] == 'sqb_reports' || $_GET['page'] == 'sqb_question_answer_report' || $_GET['page'] == 'sqb_manage_leads'){
			wp_enqueue_script("sqb_sqb_reports",plugin_dir_url(__FILE__)."../../js/sqb_reports.js", false, SQBFLOW_VER );
		}
		
		if($_GET["page"] == "sqb_social_share"){	
			wp_enqueue_script("sqb_social_share",plugin_dir_url(__FILE__)."../../js/sqb_social_share.js", false, SQBFLOW_VER );
		}
		
	}
	if($_GET["page"] == "sqb_manage_funnel" ){
		 wp_enqueue_script("sqb_manage_funnel",plugin_dir_url(__FILE__)."../../js/sqb_manage_funnel.js", false, $current_version_plugin );
		 wp_enqueue_style("sqb_manage_funnel",plugin_dir_url(__FILE__)."../../css/sqb_manage_funnel.css", false, $current_version_plugin );
	
	} 
	
	if($_GET["page"] == "sqb_add_funnel" ){
		//wp_enqueue_script("sqb_sortable_jquery_ui", "//unpkg.com/@popperjs/core@2", array('jquery')); 
	//	wp_enqueue_script("sqb_add_funnel",plugin_dir_url(__FILE__)."../../js/sqb_add_funnel.js", false, $current_version_plugin );
	///	wp_enqueue_style("sqb_add_funnel",plugin_dir_url(__FILE__)."../../css/sqb_add_funnel.css", false, $current_version_plugin );
		//wp_enqueue_style("sqb_add_funnel_drag_drop_css",plugin_dir_url(__FILE__)."../assets/css/sqb_funnel_drag_drop_elements.css", false, $current_version_plugin );
	}
	
	if($_GET["page"] == "sqb_settings"){
		
		wp_enqueue_script("sqb_settings",plugin_dir_url(__FILE__)."../../js/sqb_settings.js", false, $current_version_plugin );
		wp_enqueue_style("sqb_settings",plugin_dir_url(__FILE__)."../../css/sqb_settings.css", false, $current_version_plugin );

		wp_localize_script('sqb_settings', 'SQBSettings', array(
		    'url' => admin_url('admin-ajax.php'),
		    'sqb_import_csv' => wp_create_nonce('sqb_import_csv'),
		));
	}

	if($_GET["page"] == "sqb_student_home" || $_GET["page"] == "sqb_create_student_page"){
		wp_enqueue_script("sqb_settings",plugin_dir_url(__FILE__)."../../js/sqb_student_home.js", false, $current_version_plugin );
		wp_enqueue_style("sqb_settings",plugin_dir_url(__FILE__)."../../css/sqb_settings.css", false, $current_version_plugin );
	}


	if($_GET["page"] == "sqb_leaderboard_page" || $_GET["page"] == "sqb_create_leaderboard_page" ){
		wp_enqueue_script("sqb_settings",plugin_dir_url(__FILE__)."../../js/sqb_leaderboard.js", false, $current_version_plugin );
		wp_enqueue_style("sqb_settings",plugin_dir_url(__FILE__)."../../css/sqb_settings.css", false, $current_version_plugin );
	}

	if($_GET["page"] == "sqb_pdf_content" || $_GET["page"] == "sqb_create_pdf_content_page"){
		wp_enqueue_script("sqb_settings",plugin_dir_url(__FILE__)."../../js/sqb_pdf_content.js", false, $current_version_plugin );
		wp_enqueue_style("sqb_settings",plugin_dir_url(__FILE__)."../../css/sqb_pdf_content.css", false, $current_version_plugin );
	}

	if($_GET["page"] == "sqb_question_bank" ){
		
		wp_enqueue_script("sqb_question_bank",plugin_dir_url(__FILE__)."../../js/sqb_question_bank.js", false, $current_version_plugin );
		wp_enqueue_style("sqb_question_bank",plugin_dir_url(__FILE__)."../../css/sqb_question_bank.css", false, $current_version_plugin );
		wp_enqueue_style("sqb_question_bank_layout",plugin_dir_url(__FILE__)."../../css/question_ans_layout.css", false, $current_version_plugin );
		wp_enqueue_style("sqb_question_bank_question",plugin_dir_url(__FILE__)."../../css/sqb_questions.css", false, $current_version_plugin );
		wp_enqueue_style("sqb_question_quiz",plugin_dir_url(__FILE__)."../../css/sqb_quiz.css", false, $current_version_plugin );
		wp_enqueue_style("sqb_manage_leads",plugin_dir_url(__FILE__)."../../css/sqb_manage_leads.css", false, $current_version_plugin );
	}
	
	if($_GET["page"] == "smartquizbuilder" ){
		 wp_enqueue_script("sqb_manage_builder",plugin_dir_url(__FILE__)."../assets/js/sqb_manage_builder.js", false, $current_version_plugin );
		 wp_enqueue_style("sqb_manage_builder",plugin_dir_url(__FILE__)."../assets/css/sqb_manage_builder.css", false, $current_version_plugin );
	
	}
   
	}	
}
