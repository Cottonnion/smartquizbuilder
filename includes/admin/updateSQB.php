<?php 

function SQB_alterqueries(){
	global $wpdb;
	global $wpdb;
	global $sqb_quiz;
	global $sqb_quiz_form;
	global $sqb_quiz_questions;
	global $sqb_quiz_answers;
	global $sqb_quiz_question_bank;
	global $sqb_quiz_template;
	global $sqb_quiz_funnel_nodes;
	global $sqb_quiz_funnel;
	global $sqb_autoresponder_settings;
	global $sqb_quiz_autoresponder;
	global $sqb_users;
	global $sqb_outcome_mapping;
	global $sqb_quiz_outcome;
	global $sqb_reports;
	global $sqb_manage_leads;
	global $sqb_users_quiz_details;
	global $sqb_social_share;
	global $sqb_quiz_settings;
	global $sqb_question_answer_report;
	global $sqb_quiz_tracking;
	global $sqb_user_quiz;
	global $sqb_quiz_notifications;
	global $sqb_outcome_rank_mapping;
	global $sqb_student_shortcode;
	global $sqb_pdf_content;
	global $sqb_emailchecker;
	global $sqb_quiz_points;
	global $sqb_dap_lesson_quiz;
	global $sqb_gdpr;
	global $sqb_global_theme;
	global $sqb_quiz_category;
	global $sqb_calculator_formula;
	global $sqb_internal_users;
	global $sqb_custom_fields;
	global $sqb_email_template;
	global $sqb_user_custom_fields;
	global $sqb_advanced_rule;
	global $sqb_form_quiz;
	global $sqb_tags;

	$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;
    $table_sqb_quiz_form = $wpdb->prefix . $sqb_quiz_form;
    $table_sqb_quiz_questions = $wpdb->prefix . $sqb_quiz_questions;
    $table_sqb_quiz_answers = $wpdb->prefix . $sqb_quiz_answers;
    $table_sqb_quiz_question_bank = $wpdb->prefix . $sqb_quiz_question_bank;
    $table_sqb_quiz_template = $wpdb->prefix . $sqb_quiz_template;
    $table_sqb_quiz_funnel_nodes = $wpdb->prefix . $sqb_quiz_funnel_nodes;
    $table_sqb_quiz_funnel = $wpdb->prefix . $sqb_quiz_funnel;
    $table_sqb_autoresponder_settings = $wpdb->prefix . $sqb_autoresponder_settings;
    $table_sqb_quiz_autoresponder = $wpdb->prefix . $sqb_quiz_autoresponder;
    $table_sqb_users = $wpdb->prefix . $sqb_users;
    $table_sqb_outcome_mapping = $wpdb->prefix . $sqb_outcome_mapping;
    $table_sqb_quiz_outcome = $wpdb->prefix . $sqb_quiz_outcome;
    $table_sqb_reports = $wpdb->prefix . $sqb_reports;
    $table_sqb_manage_leads = $wpdb->prefix . $sqb_manage_leads;
    $table_sqb_users_quiz_details = $wpdb->prefix . $sqb_users_quiz_details;
    $table_sqb_social_share = $wpdb->prefix . $sqb_social_share;
    $table_sqb_quiz_settings = $wpdb->prefix . $sqb_quiz_settings;
    $table_sqb_question_answer_report = $wpdb->prefix . $sqb_question_answer_report;
    $table_sqb_quiz_tracking = $wpdb->prefix . $sqb_quiz_tracking;
    $table_sqb_user_quiz = $wpdb->prefix . $sqb_user_quiz;
    $table_sqb_quiz_notifications = $wpdb->prefix . $sqb_quiz_notifications;
    $table_sqb_outcome_rank_mapping = $wpdb->prefix . $sqb_outcome_rank_mapping;
    $table_sqb_student_shortcode = $wpdb->prefix . $sqb_student_shortcode;
    $table_sqb_pdf_content = $wpdb->prefix . $sqb_pdf_content;
    $table_sqb_emailchecker = $wpdb->prefix . $sqb_emailchecker;
    $table_sqb_quiz_points = $wpdb->prefix . $sqb_quiz_points;
    $table_sqb_dap_lesson_quiz = $wpdb->prefix . $sqb_dap_lesson_quiz;
    $table_sqb_gdpr = $wpdb->prefix . $sqb_gdpr;
    $table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;
    $table_sqb_quiz_category = $wpdb->prefix . $sqb_quiz_category;
	$table_sqb_calculator_formula = $wpdb->prefix . $sqb_calculator_formula;
	$table_sqb_internal_users = $wpdb->prefix . $sqb_internal_users;
	$table_sqb_custom_fields = $wpdb->prefix . $sqb_custom_fields;
	$table_sqb_email_template = $wpdb->prefix . $sqb_email_template;
	$table_sqb_user_custom_fields = $wpdb->prefix . $sqb_user_custom_fields;
	$table_sqb_advanced_rule = $wpdb->prefix . $sqb_advanced_rule;
	$table_sqb_form_quiz = $wpdb->prefix . $sqb_form_quiz;
	$table_sqb_tags = $wpdb->prefix . $sqb_tags;
	
try {
		$add_categoryid_sql = "SHOW COLUMNS FROM `" . $table_sqb_advanced_rule . "` WHERE Field='category_id'";
		$result = $wpdb->get_var($add_categoryid_sql); 
		if($result == ''){
			$add_categoryid_sql = "ALTER TABLE `".$table_sqb_advanced_rule."` ADD `category_id` int(11) DEFAULT NULL;";
			$wpdb->query($add_categoryid_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$category_total_sql = "SHOW COLUMNS FROM `" . $table_sqb_advanced_rule . "` WHERE Field='category_total'";
		$result = $wpdb->get_var($category_total_sql); 
		if($result == ''){
			$category_total_sql = "ALTER TABLE `".$table_sqb_advanced_rule."` ADD `category_total` varchar(255) DEFAULT NULL;";
			$wpdb->query($category_total_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$formula_id_sql = "SHOW COLUMNS FROM `" . $table_sqb_advanced_rule . "` WHERE Field='formula_id'";
		$result = $wpdb->get_var($formula_id_sql); 
		if($result == ''){
			$formula_id_sql = "ALTER TABLE `".$table_sqb_advanced_rule."` ADD `formula_id` integer(11) DEFAULT NULL;";
			$wpdb->query($formula_id_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$formula_priority_sql = "SHOW COLUMNS FROM `" . $table_sqb_advanced_rule . "` WHERE Field='formula_priority'";
		$result = $wpdb->get_var($formula_priority_sql); 
		if($result == ''){
			$formula_priority_sql = "ALTER TABLE `".$table_sqb_advanced_rule."` ADD `formula_priority` integer(11) DEFAULT NULL;";
			$wpdb->query($formula_priority_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$advanced_rules_sql = "SHOW COLUMNS FROM `" . $table_sqb_advanced_rule . "` WHERE Field='skip_quiz'";
		$result = $wpdb->get_var($advanced_rules_sql); 
		if($result == ''){
			$advanced_rules_sql = "ALTER TABLE `".$table_sqb_advanced_rule."` ADD `skip_quiz` char(2) DEFAULT NULL";
			$wpdb->query($advanced_rules_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$from_email_sql = "ALTER TABLE " . $table_sqb_quiz_notifications . " CHANGE `from_email` `from_email` TEXT NOT NULL ";
		$wpdb->query($from_email_sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	
	try {
		$from_name_email_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='from_name'";
		$result = $wpdb->get_var($from_name_email_sql); 
		if($result == ''){
			$from_name_email_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `from_name` varchar(255) DEFAULT NULL;";
			$wpdb->query($from_name_email_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$add_quizid_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='quiz_id'";
		$result = $wpdb->get_var($add_quizid_sql); 
		if($result == ''){
			$add_quizid_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `quiz_id` int(11) DEFAULT NULL;";
			$wpdb->query($add_quizid_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$add_outcomeid_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='outcome_id'";
		$result = $wpdb->get_var($add_outcomeid_sql); 
		if($result == ''){
			$add_outcomeid_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `outcome_id` int(11) DEFAULT NULL;";
			$wpdb->query($add_outcomeid_sql); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$add_quizsetting_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='quiz_settings'";
		$result = $wpdb->get_var($add_quizsetting_sql); 
		if($result == ''){
			$add_quizsetting_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `quiz_settings` varchar(255) DEFAULT NULL;";
			$wpdb->query($add_quizsetting_sql); 
		}	
	}

	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		$add_send_copy_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='send_copy'";
		$result = $wpdb->get_var($add_send_copy_sql); 
		if($result == ''){
			$add_send_copy_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `send_copy` varchar(11) DEFAULT NULL;";
			$wpdb->query($add_send_copy_sql); 
		}	
	}

	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$add_email_ids_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='email_ids'";
		$result = $wpdb->get_var($add_email_ids_sql); 
		if($result == ''){
			$add_email_ids_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `email_ids` varchar(255) DEFAULT NULL;";
			$wpdb->query($add_email_ids_sql); 
		}	
	}

	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$add_copy_email_subject_sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='copy_email_subject'";
		$result = $wpdb->get_var($add_copy_email_subject_sql); 
		if($result == ''){
			$add_copy_email_subject_sql = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `copy_email_subject` varchar(255) DEFAULT NULL;";
			$wpdb->query($add_copy_email_subject_sql); 
		}	
	}

	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_users_quiz_details . "` WHERE Field='other_field'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_other_field = "ALTER TABLE `".$table_sqb_users_quiz_details."` ADD `other_field` varchar(255)  DEFAULT NULL;";
			$wpdb->query($sql_other_field); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 

    try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_users_quiz_details . "` WHERE Field='answer_tag_ids'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_answer_tag_ids = "ALTER TABLE `".$table_sqb_users_quiz_details."` ADD `answer_tag_ids` varchar(255)  DEFAULT NULL;";
			$wpdb->query($sql_answer_tag_ids); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 


	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_users_quiz_details . "` WHERE Field='unique_id'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_other_field = "ALTER TABLE `".$table_sqb_users_quiz_details."` ADD `unique_id` varchar(255)  DEFAULT NULL;";
			$wpdb->query($sql_other_field); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_template . "` WHERE Field='quiz_analyzing_result_template'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_sqb_quiz_template_first_name = "ALTER TABLE `".$table_sqb_quiz_template."` ADD `quiz_analyzing_result_template` longtext DEFAULT NULL AFTER `quiz_first_name_template`;";
			$wpdb->query($sql_sqb_quiz_template_first_name);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	 try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_template . "` WHERE Field='common_style'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_common_style = "ALTER TABLE `".$table_sqb_quiz_template."` ADD `common_style` varchar(255)  DEFAULT NULL AFTER `optin_template`;";
			$wpdb->query($sql_common_style); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='matrix_label_text'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_matrix_label_text = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `matrix_label_text` TEXT DEFAULT NULL AFTER `date`;";
			$wpdb->query($sql_question_bank_matrix_label_text);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='matrix_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_matrix_html = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `matrix_html` TEXT DEFAULT NULL AFTER `matrix_label_text`;";
			$wpdb->query($sql_question_bank_matrix_html);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='skip_mapping'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `skip_mapping` char(2) DEFAULT NULL;";
			$wpdb->query($sql_question_bank_skip);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='question_file_upload_settings'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `question_file_upload_settings` TEXT DEFAULT NULL AFTER `temp_customizer`;";
			$wpdb->query($sql_question_bank_skip);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='allow_skip_ques'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `allow_skip_ques` varchar(10) NULL DEFAULT 'N' AFTER `question_file_upload_settings`;";
			$wpdb->query($sql_question_bank_skip);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='next_button_html'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `next_button_html` TEXT DEFAULT NULL AFTER `allow_skip_ques`;";			
		$wpdb->query($sql_question_bank_skip);		
		}		
	}	
	catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='skip_button_html'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_skip_button = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `skip_button_html` TEXT DEFAULT NULL;";			
		$wpdb->query($sql_question_bank_skip_button);		
		}		
	}	
	catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='ans_image_setting'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_ans_image_setting = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `ans_image_setting` TEXT DEFAULT NULL;";			
		$wpdb->query($sql_question_bank_ans_image_setting);		
		}		
	}	
	catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='question_setting'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_ans_image_setting = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `question_setting` TEXT DEFAULT NULL;";			
		$wpdb->query($sql_question_bank_ans_image_setting);		
		}		
	}	
	catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='enable_background_image'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_background_image = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `enable_background_image` text DEFAULT NULL AFTER `next_button_html`;";			
		$wpdb->query($sql_question_bank_background_image);		
		}		
	} catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='category_id'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_background_image = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `category_id` INT(11) DEFAULT NULL AFTER `enable_background_image`;";			
		$wpdb->query($sql_question_bank_background_image);		
		}		
	} catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='matrix_column_width'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_matrix_width = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `matrix_column_width` INT(11) DEFAULT NULL";			
		$wpdb->query($sql_question_bank_matrix_width);		
		}		
	} catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}
	
	try {		
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_question_bank . "` WHERE Field='status'";		
		$result = $wpdb->get_var($sql); 		
		if($result == ''){			
		$sql_question_bank_status = "ALTER TABLE `".$table_sqb_quiz_question_bank."` ADD `status` varchar(255) NULL DEFAULT 'Y'";			
		$wpdb->query($sql_question_bank_status);		
		}		
	} catch (PDOException $e) {		
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);	
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_questions . "` WHERE Field='question_order'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_quiz_question_order = "ALTER TABLE `".$table_sqb_quiz_questions."` ADD `question_order` int(11) NULL DEFAULT NULL";

			$wpdb->query($sql_quiz_question_order); 
		}	
	} catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_questions . "` WHERE Field='show_ads'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_quiz_show_ads = "ALTER TABLE `".$table_sqb_quiz_questions."` ADD `show_ads`  CHAR(1)  DEFAULT 'N'";

			$wpdb->query($sql_quiz_show_ads); 
		}	
	} catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_questions . "` WHERE Field='question_ads_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_ads_html = "ALTER TABLE `".$table_sqb_quiz_questions."` ADD `question_ads_html` text NULL;";
			$wpdb->query($sql_question_ads_html); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_outcome . "` WHERE Field='enable_background_image'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_background_image_values = "ALTER TABLE `".$table_sqb_quiz_outcome."` ADD `enable_background_image` text  DEFAULT NULL AFTER `tag`;";
			$wpdb->query($sql_background_image_values); 
		}	
	} catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_outcome . "` WHERE Field='pdf_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_default_html = "ALTER TABLE `".$table_sqb_quiz_outcome."` ADD `pdf_html` text  DEFAULT NULL ;";
			$wpdb->query($sql_default_html); 
		}	
	} catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_answers . "` WHERE Field='matrix_values'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_quiz_answers_alter_sql = "ALTER TABLE `".$table_sqb_quiz_answers."` ADD `matrix_values` varchar(255) NULL DEFAULT NULL AFTER `date`;";
			$wpdb->query($table_sqb_quiz_answers_alter_sql);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$table_sqb_quiz_answers_alter_sql = "ALTER TABLE `".$table_sqb_quiz_answers."` CHANGE `answer_points` `answer_points` FLOAT NOT NULL;";
		$wpdb->query($table_sqb_quiz_answers_alter_sql);
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$table_sqb_quiz_answers_alter_sql = "ALTER TABLE `".$table_sqb_quiz_answers."` CHANGE `answer_order` `answer_order` INT(11) NOT NULL;";
		$wpdb->query($table_sqb_quiz_answers_alter_sql);
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='show_firstname_outcome'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_firstname_outcome` CHAR(1)  DEFAULT 'Y'"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='double_optin'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `double_optin` varchar(255) DEFAULT NULL "; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='exit_popup_value'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `exit_popup_value` int(11) DEFAULT NULL "; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_slider_animation'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_slider_animation` CHAR(1)  DEFAULT NULL AFTER `date`"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='category_option'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `category_option` varchar(255)  DEFAULT NULL"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='show_share_screen'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_share_screen` varchar(50) DEFAULT NULL"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='outcome_screen_display'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_screen_display_sqb_quiz = "ALTER TABLE `".$table_sqb_quiz."` ADD `outcome_screen_display` VARCHAR(255)  DEFAULT NULL"; 
			$wpdb->query($table_screen_display_sqb_quiz);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='customizer_style_setting'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_customizer_style_setting_sqb_quiz = "ALTER TABLE `".$table_sqb_quiz."` ADD `customizer_style_setting` text  DEFAULT NULL"; 
			$wpdb->query($table_customizer_style_setting_sqb_quiz);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='outcome_screen_charts_settings'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_outcome_screen_charts_settings_sqb_quiz = "ALTER TABLE `".$table_sqb_quiz."` ADD `outcome_screen_charts_settings` text  DEFAULT NULL"; 
			$wpdb->query($table_outcome_screen_charts_settings_sqb_quiz);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "ALTER TABLE " . $table_sqb_quiz . " CHANGE `outcome_screen_charts_settings` `outcome_screen_charts_settings` text  DEFAULT NULL";
		$wpdb->query($sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "ALTER TABLE " . $table_sqb_quiz . " CHANGE `transparent_background_settings` `transparent_background_settings` text  DEFAULT NULL";
		$wpdb->query($sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "ALTER TABLE " . $table_sqb_quiz . " CHANGE `move_question` `move_question` CHAR(1)  DEFAULT 'Y'";
		$wpdb->query($sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='show_analyzing_result'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_analyzing_result` VARCHAR(20)  DEFAULT NULL AFTER `show_firstname_template`"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='show_analyzing_result_time'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_analyzing_result_time` VARCHAR(20)  DEFAULT NULL AFTER `show_analyzing_result`"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_slider_animation_option'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_slider_animation_option` CHAR(2)  DEFAULT NULL AFTER `quiz_slider_animation`"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='transparent_background_settings'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `transparent_background_settings` varchar(255)  DEFAULT NULL"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='email_notification_settings'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `email_notification_settings` varchar(255)  DEFAULT NULL"; 
			$wpdb->query($sqlq);
		}	
	}

	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='customizer_styles'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `customizer_styles` VARCHAR(255)  DEFAULT NULL"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {

		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='questions_top_border'";

		$result = $wpdb->get_var($sql); 

		if($result == ''){

			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `questions_top_border` varchar(255) DEFAULT NULL AFTER `quiz_slider_animation`"; 

			$wpdb->query($sqlq);

		}	

	}

	catch (PDOException $e) {

		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);

	} catch (Exception $e) {

		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);

	}
	
	// timer field add query start 
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='timer_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_timer_values = "ALTER TABLE `".$table_sqb_quiz."` ADD `timer_html` text  DEFAULT NULL AFTER `questions_top_border`;";
			$wpdb->query($sql_timer_values); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='timer_customizer'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_timer_values1 = "ALTER TABLE `".$table_sqb_quiz."` ADD `timer_customizer` text  DEFAULT NULL AFTER `timer_html`;";
			$wpdb->query($sql_timer_values1); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='timer_expired_msg'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_timer_values1 = "ALTER TABLE `".$table_sqb_quiz."` ADD `timer_expired_msg` text  DEFAULT NULL AFTER `timer_customizer`;";
			$wpdb->query($sql_timer_values1); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	// timer field add query end
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='enable_background_image'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_background_images_values = "ALTER TABLE `".$table_sqb_quiz."` ADD `enable_background_image` text  DEFAULT NULL;";
			$wpdb->query($sql_background_images_values); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='question_bank_options'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$question_bank_options = "ALTER TABLE `".$table_sqb_quiz."` ADD `question_bank_options` varchar(255)  DEFAULT NULL";
			$wpdb->query($question_bank_options); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='move_question'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `move_question` CHAR(1)  DEFAULT 'N'"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='show_download_button'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqlq = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_download_button` CHAR(1)  DEFAULT 'N'"; 
			$wpdb->query($sqlq);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_tags . "` WHERE Field='tag_content'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_tag_content_sqb_quiz_tag = "ALTER TABLE `".$table_sqb_tags."` ADD `tag_content` text  DEFAULT NULL"; 
			$wpdb->query($table_tag_content_sqb_quiz_tag);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_tags . "` WHERE Field='name'";
		$result = $wpdb->get_var($sql);
		if(!empty($result)){
			$table_name_sqb_quiz_tag = "ALTER TABLE `".$table_sqb_tags."` CHANGE `name` `name` VARCHAR(50)"; 
			$wpdb->query($table_name_sqb_quiz_tag);

			$table_uname_sqb_quiz_tag_q = "SHOW COLUMNS FROM `".$table_sqb_tags."` LIKE 'name'";
			$record = $wpdb->get_row($table_uname_sqb_quiz_tag_q,ARRAY_A);
			
			if(isset($record['Key']) && $record['Key'] != 'UNI'){
				$table_uname_sqb_quiz_tag = "ALTER TABLE `".$table_sqb_tags."` ADD CONSTRAINT name UNIQUE(`name`)"; 
				$wpdb->query($table_uname_sqb_quiz_tag);
			}
			
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='quiz_type'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `quiz_type` varchar(255)  DEFAULT ''";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_notifications . "` WHERE Field='answer_format'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `answer_format` text  DEFAULT '' AFTER `quiz_type`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	
    try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='sqb_insert_quiz'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `sqb_insert_quiz` varchar(255)  DEFAULT NULL AFTER `status`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='user_name'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `user_name` varchar(255)  DEFAULT NULL AFTER `category_details`;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='gdpr_opted_in'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `gdpr_opted_in` varchar(255)  DEFAULT NULL AFTER `opted_in`;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='user_source'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `user_source` varchar(20)  DEFAULT NULL AFTER `user_name`;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='unique_id'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `unique_id` varchar(255)  DEFAULT NULL;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='time_spent'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `time_spent` int(11) NULL DEFAULT NULL AFTER `lesson_id`;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='source'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads_source = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `source` varchar(10) NULL DEFAULT 'WP' AFTER `total_attempts`;";
			$wpdb->query($table_sqb_manage_leads_source);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='course_id'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads_source = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `course_id` int(11) NULL DEFAULT NULL AFTER `source`;";
			$wpdb->query($table_sqb_manage_leads_source);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='lesson_id'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads_source = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `lesson_id` int(11) NULL DEFAULT NULL AFTER `course_id`;";
			$wpdb->query($table_sqb_manage_leads_source);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_manage_leads . "` WHERE Field='category_details'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$table_sqb_manage_leads1 = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `category_details` VARCHAR(255) DEFAULT NULL AFTER `date`;";
			$wpdb->query($table_sqb_manage_leads1);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_question_answer_report . "` WHERE Field='other_field'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_other_answer = "ALTER TABLE `".$table_sqb_question_answer_report."` ADD `other_field` varchar(255)  DEFAULT NULL;";
			$wpdb->query($sql_other_answer); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 



	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_display_url'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_display_url` varchar(255)  DEFAULT NULL AFTER `sqb_insert_quiz`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_display_in_url'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_display_in_url` varchar(10)  DEFAULT 'Y' AFTER `quiz_display_url`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_popup_time_delay'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_popup_time_delay` int(11)  DEFAULT 0 AFTER `quiz_display_in_url`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_popup_frequency'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_popup_frequency` varchar(255) DEFAULT NULL AFTER `quiz_popup_time_delay`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quiz_popup_position'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quiz_popup_position` varchar(100) DEFAULT NULL AFTER `quiz_popup_frequency`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='quick_email_verification'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `quick_email_verification` varchar(10) DEFAULT 'N' AFTER `quiz_popup_position`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='category'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `category` CHAR(1) DEFAULT NULL AFTER `quick_email_verification`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='pre_built'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_question_bank_skip = "ALTER TABLE `".$table_sqb_quiz."` ADD `pre_built` CHAR(1) DEFAULT 'N' AFTER `category`;";
			$wpdb->query($sql_question_bank_skip); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	 
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='pre_built_details'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_built_in_type = "ALTER TABLE `".$table_sqb_quiz."` ADD `pre_built_details` varchar(255) DEFAULT NULL AFTER `pre_built`;";
			$wpdb->query($sql_built_in_type); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='opt_screen_position'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_opt_screen_position = "ALTER TABLE `".$table_sqb_quiz."` ADD `opt_screen_position` varchar(100) DEFAULT 'after_question_screen';";
			$wpdb->query($sql_opt_screen_position); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='weighted_score'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_weighted_score = "ALTER TABLE `".$table_sqb_quiz."` ADD `weighted_score` CHAR(1) NULL;";
			$wpdb->query($sql_weighted_score); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
    
    try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='recommended_next_button'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_recommended_next_button = "ALTER TABLE `".$table_sqb_quiz."` ADD `recommended_next_button` text  DEFAULT NULL;";
			$wpdb->query($sql_recommended_next_button); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='ads_next_button'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_ads_next_button = "ALTER TABLE `".$table_sqb_quiz."` ADD `ads_next_button` text  DEFAULT NULL;";
			$wpdb->query($sql_ads_next_button); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='download_pdf_button_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_download_pdf_button_html = "ALTER TABLE `".$table_sqb_quiz."` ADD `download_pdf_button_html` text  DEFAULT NULL;";
			$wpdb->query($sql_download_pdf_button_html); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='poll_settings'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_poll_settings = "ALTER TABLE `".$table_sqb_quiz."` ADD `poll_settings` text  DEFAULT NULL;";
			$wpdb->query($sql_poll_settings); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='pdf_front_last_image'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_pdf_front_last_image = "ALTER TABLE `".$table_sqb_quiz."` ADD `pdf_front_last_image` TEXT DEFAULT NULL;";
			$wpdb->query($sql_pdf_front_last_image); 
		}else{

			$sql2 = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '".$table_sqb_quiz."' AND COLUMN_NAME = 'pdf_front_last_image'";
			$result2 = $wpdb->get_var($sql2); 

			if($result2 == 'varchar'){
				$sql_pdf_front_last_image2 = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `pdf_front_last_image` `pdf_front_last_image` TEXT DEFAULT NULL;";
				$wpdb->query($sql_pdf_front_last_image2); 
			}

		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='ans_recommendation'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_ans_recommendation = "ALTER TABLE `".$table_sqb_quiz."` ADD `ans_recommendation` CHAR(1) DEFAULT NULL;";
			$wpdb->query($sql_ans_recommendation); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='qns_ads'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_qns_ads = "ALTER TABLE `".$table_sqb_quiz."` ADD `qns_ads` CHAR(1) DEFAULT NULL;";
			$wpdb->query($sql_qns_ads); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz . "` WHERE Field='ans_tags'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_ans_tags = "ALTER TABLE `".$table_sqb_quiz."` ADD `ans_tags` CHAR(1) DEFAULT NULL;";
			$wpdb->query($sql_ans_tags); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_answers . "` WHERE Field='recommendation_html'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_recommendation_html = "ALTER TABLE `".$table_sqb_quiz_answers."` ADD `recommendation_html` text;";
			$wpdb->query($sql_recommendation_html); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_quiz_answers . "` WHERE Field='tag_ids'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sql_tag_ids = "ALTER TABLE `".$table_sqb_quiz_answers."` ADD `tag_ids` varchar(255) NULL DEFAULT NULL";
			$wpdb->query($sql_tag_ids); 
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_global_theme . "` WHERE Field='outer_style_status'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqb_outer_style_status = "ALTER TABLE `".$table_sqb_global_theme."` ADD `outer_style_status` char(1) NOT NULL DEFAULT 'Y'";
			$wpdb->query($sqb_outer_style_status);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_calculator_formula . "` WHERE Field='formula_values'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqb_formula_values = "ALTER TABLE `".$table_sqb_calculator_formula."` ADD `formula_values` varchar(255)  DEFAULT NULL";
			$wpdb->query($sqb_formula_values);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_calculator_formula . "` WHERE Field='number_range'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqb_number_range = "ALTER TABLE `".$table_sqb_calculator_formula."` ADD `number_range` varchar(255)  DEFAULT NULL";
			$wpdb->query($sqb_number_range);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql = "SHOW COLUMNS FROM `" . $table_sqb_calculator_formula . "` WHERE Field='outcome_id'";
		$result = $wpdb->get_var($sql); 
		if($result == ''){
			$sqb_outcome_id = "ALTER TABLE `".$table_sqb_calculator_formula."` ADD `outcome_id` int(11)  DEFAULT NULL";
			$wpdb->query($sqb_outcome_id);
		}	
	}
	catch (PDOException $e) {
		logToFile("install.php: coloumn exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} 
	catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$from_email_sql = "ALTER TABLE " . $table_sqb_user_custom_fields . " CHANGE `name` `name` varchar(255) NOT NULL ";
		$wpdb->query($from_email_sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$from_email_sql = "ALTER TABLE " . $table_sqb_user_custom_fields . " CHANGE `value` `value` varchar(255) DEFAULT NULL ";
		$wpdb->query($from_email_sql); 
	}catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

}