<?php

global $sqb_quiz;
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
global $sqb_member_home;
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
global $sqb_leaderboard;
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
global $sqb_student_login;
global $sqb_quiz_outcome_description;
global $sqb_quiz_certificate;

$sqb_quiz = 'sqb_quiz';
$sqb_quiz_form = 'sqb_quiz_form';
$sqb_quiz_questions = 'sqb_quiz_questions';
$sqb_quiz_answers = 'sqb_quiz_answers';
$sqb_quiz_question_bank = 'sqb_quiz_question_bank';
$sqb_quiz_template = 'sqb_quiz_template';
$sqb_quiz_funnel_nodes = 'sqb_quiz_funnel_nodes';
$sqb_quiz_funnel = 'sqb_quiz_funnel';
$sqb_autoresponder_settings = 'sqb_autoresponder_settings';
$sqb_quiz_autoresponder = 'sqb_quiz_autoresponder';
$sqb_users = 'sqb_users';
$sqb_outcome_mapping = 'sqb_outcome_mapping';
$sqb_quiz_outcome = 'sqb_quiz_outcome';
$sqb_member_home = 'sqb_member_home';
$sqb_manage_leads = 'sqb_manage_leads';
$sqb_reports = 'sqb_reports';
$sqb_users_quiz_details = 'sqb_users_quiz_details';
$sqb_social_share = 'sqb_social_share';
$sqb_quiz_settings = 'sqb_quiz_settings';
$sqb_question_answer_report = 'sqb_question_answer_report';
$sqb_quiz_tracking = 'sqb_quiz_tracking';
$sqb_user_quiz = 'sqb_user_quiz';
$sqb_quiz_notifications = 'sqb_quiz_notifications';
$sqb_outcome_rank_mapping = 'sqb_outcome_rank_mapping';
$sqb_student_shortcode = 'sqb_student_shortcode';
$sqb_pdf_content = 'sqb_pdf_content';
$sqb_leaderboard = 'sqb_leaderboard';
$sqb_emailchecker = 'sqb_emailchecker';
$sqb_quiz_points = 'sqb_quiz_points';
$sqb_dap_lesson_quiz = 'sqb_dap_lesson_quiz';
$sqb_gdpr = 'sqb_gdpr';
$sqb_global_theme = 'sqb_global_theme';
$sqb_quiz_category = 'sqb_quiz_category';
$sqb_calculator_formula = 'sqb_calculator_formula';
$sqb_internal_users = 'sqb_internal_users';
$sqb_custom_fields = 'sqb_custom_fields';
$sqb_email_template = 'sqb_email_template';
$sqb_user_custom_fields = 'sqb_user_custom_fields';
$sqb_advanced_rule = 'sqb_advanced_rule';
$sqb_form_quiz = 'sqb_form_quiz';
$sqb_tags = 'sqb_tags';
$sqb_student_login = 'sqb_student_login';
$sqb_quiz_outcome_description = 'sqb_quiz_outcome_description';
$sqb_quiz_certificate = 'sqb_quiz_certificate';

//install tables
function install_smartquizbuilder() {
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
	global $sqb_member_home;
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
	global $sqb_leaderboard;
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
	global $sqb_student_login;
	global $sqb_quiz_outcome_description;
	global $sqb_quiz_certificate;
	
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
    $table_sqb_member_home = $wpdb->prefix . $sqb_member_home;
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
    $table_sqb_leaderboard = $wpdb->prefix . $sqb_leaderboard;
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
	$table_sqb_student_login = $wpdb->prefix . $sqb_student_login;
	$table_sqb_quiz_outcome_description = $wpdb->prefix . $sqb_quiz_outcome_description;
	$table_sqb_quiz_certificate = $wpdb->prefix . $sqb_quiz_certificate;
 
    $charset_collate = $wpdb->get_charset_collate();

    try {
		//table_sqb_advanced_rule
		$sql_sqb_advanced_rule = "CREATE TABLE IF NOT EXISTS " . $table_sqb_advanced_rule . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,			 
			`quiz_id` integer(11) DEFAULT NULL,
			`question_id` integer(11) DEFAULT NULL,
			`answers_id` varchar(255) DEFAULT NULL,
			`outcome_id` integer(11) DEFAULT NULL,			 
			`enabled_advanced` char(2) DEFAULT NULL,			 
			`skip_optin` char(2) DEFAULT NULL,			 
			`category_id` integer(11) DEFAULT NULL,
			`category_total` varchar(255) DEFAULT NULL,
			`formula_priority` integer(11) DEFAULT NULL,
			`formula_id` integer(11) DEFAULT NULL,
			`skip_quiz` char(2) DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_advanced_rule); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	/*--------------------------------*/
	try {
		//table_sqb_form_quiz
		$sql_sqb_form_quiz = "CREATE TABLE IF NOT EXISTS " . $table_sqb_form_quiz . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,			 
			`quiz_id` integer(11) DEFAULT NULL,
			`display_type` varchar(50) DEFAULT NULL,
			`page_ids` varchar(255) DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_form_quiz); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql_sqb_tags = "CREATE TABLE IF NOT EXISTS " . $table_sqb_tags . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,			 
			`name` varchar(255) DEFAULT NULL,
			`tag_content` text DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_tags); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql_sqb_student_login = "CREATE TABLE IF NOT EXISTS " . $table_sqb_student_login . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,			 
			`page_id` int(11) NOT NULL,
			`type` varchar(255) DEFAULT NULL,
			`template` varchar(255) DEFAULT NULL,
			`template_html` text DEFAULT NULL,
			`settings` text DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_student_login); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

    try {
		//table_sqb_quiz_notifications
		$sql_sqb_quiz_notifications = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_notifications . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`from_email` text NOT NULL,
			`from_name` varchar(255) DEFAULT NULL,
			`subject` text NOT NULL,
			`body` longtext NOT NULL,
			`type` varchar(255) NOT NULL,
			`send_email` varchar(10) NOT NULL,
			`quiz_type` varchar(255) DEFAULT '',
			`quiz_id` integer(11) DEFAULT NULL,
			`outcome_id` integer(11) DEFAULT NULL,
			`quiz_settings` varchar(255) DEFAULT NULL,
			`send_copy` varchar(11) DEFAULT NULL,
			`email_ids` varchar(255) DEFAULT NULL,
			`copy_email_subject` varchar(255) DEFAULT NULL,
			`answer_format` text DEFAULT '',
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_notifications); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table_sqb_student_shortcode
		$sql_sqb_student_shortcode = "CREATE TABLE IF NOT EXISTS " . $table_sqb_student_shortcode . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_ids` varchar(255) DEFAULT NULL,
			`show_course_details` varchar(255)  DEFAULT NULL,
			`html` longtext DEFAULT NULL,
			`customzier` text DEFAULT NULL,
			`date` datetime DEFAULT CURRENT_TIMESTAMP,
			`result_btn_text` varchar(255) DEFAULT NULL,
			
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_student_shortcode); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table_sqb_student_shortcode
		$sql_sqb_pdf_content = "CREATE TABLE IF NOT EXISTS " . $table_sqb_pdf_content . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`name` varchar(255) DEFAULT NULL,
			`content` longtext DEFAULT NULL,
			`other_options` longtext DEFAULT NULL,
			`date` datetime DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_pdf_content); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table_sqb_student_shortcode
		$sql_sqb_leaderboard = "CREATE TABLE IF NOT EXISTS " . $table_sqb_leaderboard . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_type` varchar(10),
			`quiz_ids` text,
			`name` varchar(255),
			`max_records` varchar(10),
			`retake_overwrites` char(1) DEFAULT 'N',
			`show_type` varchar(10),
			`start_date` datetime,
			`end_date` datetime,
			`no_data_text` text,
			`template` varchar(10),
			`leaderboard_order` varchar(50),
			`customizer_html` text,
			`customizer_values` text,
			`date` datetime,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_leaderboard); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		//table_sqb_quiz_notifications
		$sql_sqb_outcome_rank_mapping = "CREATE TABLE IF NOT EXISTS " . $table_sqb_outcome_rank_mapping . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`rank_number` varchar(255) NOT NULL,
			`custom_field_name` longtext NOT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_outcome_rank_mapping); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	

    try {
		//table table_sqb_user_quiz
		$sql_sqb_user_quiz = "CREATE TABLE IF NOT EXISTS " . $table_sqb_user_quiz . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`user_id` int(11) NOT NULL,
			`quiz_id` int(11) NOT NULL,
			`completed` varchar(255) NOT NULL,
			`score` int(11) NOT NULL,
			`correct_answers` int(11) NOT NULL,
			`retake_count` int(11) NOT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_user_quiz); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


    try {
		//table table_sqb_users_quiz_details
		$sql_sqb_users_quiz_details = "CREATE TABLE IF NOT EXISTS " . $table_sqb_users_quiz_details . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`user_id` int(11) NOT NULL,
			`quiz_id` int(11) NOT NULL,
			`question_id` int(11) NOT NULL,
			`answer_given` varchar(250)  NOT NULL,
			`correct_answer` varchar(250)  NOT NULL,
			`correct_ans_id` int(11)  NULL,
			`answer_text`  text NULL,
			`points_scored` int(11) DEFAULT NULL, 
			`total_points` int(11) DEFAULT NULL,
			`other_field` varchar(255) DEFAULT NULL,
			`answer_tag_ids` varchar(255) DEFAULT NULL,
			`unique_id` varchar(255) DEFAULT NULL,
			`date` datetime NOT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_users_quiz_details); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table table_sqb_users
		$sql_sqb_users = "CREATE TABLE IF NOT EXISTS " . $table_sqb_users . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`user_id` varchar(255)  NOT NULL,
			`platform` text ,
			`total_ques` int(11) DEFAULT NULL,
			`correct_answer` int(11) DEFAULT NULL,
			`incorrect_answer` int(11) DEFAULT NULL,
			`answer_points` int(11) DEFAULT NULL,
			`percentage` varchar(50)  DEFAULT NULL,
			`date` datetime NOT NULL ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_users); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

    try {
		//table table_sqb_social_share
		$sql_sqb_social_share = "CREATE TABLE IF NOT EXISTS " . $table_sqb_social_share . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`title` text ,
			`fb_description` longtext ,
			`tw_description` longtext ,
			`html` longtext ,
			`share_link` text ,
			`show_social_share` varchar(255)  DEFAULT NULL,
			`image` text ,
			`date` date NOT NULL ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_social_share); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

    try {
		//table table_sqb_reports
		$sql_sqb_reports = "CREATE TABLE IF NOT EXISTS " . $table_sqb_reports . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`page_id` int(11) NOT NULL,
			`quiz_id` int(11) NOT NULL,
			`visits` int(11) DEFAULT NULL,
			`clicks` int(11) DEFAULT NULL,
			`completed` int(11) DEFAULT NULL,
			`reached_outcome` varchar(255)  DEFAULT NULL,
			`opted_in` varchar(255)  DEFAULT NULL,
			`clicked_on_outcome_CTA` varchar(255)  DEFAULT NULL,
			`ip_address` varchar(255)  DEFAULT NULL,
			`date` date DEFAULT NULL ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_reports); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

    try {
		//table table_sqb_quiz_tracking
		$sql_sqb_quiz_tracking = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_tracking . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`event_name` varchar(255)  NOT NULL,
			`custom_action_name` varchar(255)  DEFAULT NULL,
			`custom_action_id` int(11) DEFAULT NULL,
			`tag` varchar(255)  NOT NULL,
			`value` varchar(255)  NOT NULL,
			`track_type` varchar(255)  NOT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_tracking); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

    try {
		//table table_sqb_quiz_template
		$sql_sqb_quiz_template = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_template . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`quiz_start_template_html` longtext ,
			`quiz_first_name_template` longtext ,
			`quiz_analyzing_result_template` longtext ,
			`quiz_result_template_html` longtext ,
			`quiz_question_answer_template_html` longtext ,
			`quiz_optin_template_html` longtext ,
			`ques_template` varchar(255)  NOT NULL,
			`result_template` varchar(255)  DEFAULT NULL,
			`start_template` varchar(225)  DEFAULT NULL,
			`start_image` text  DEFAULT NULL,
			`optin_template` varchar(255)  DEFAULT NULL ,
			`common_style` text DEFAULT NULL ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_template); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table table_sqb_quiz_template
		$sql_sqb_quiz_form = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_form . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`name` varchar(255) ,
			`form_id` varchar(255) ,
			`value` longtext,
			`required` varchar(255) ,
			`type` varchar(255),
			`placeholder` varchar(255),
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_form); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try{
		$sql_sqb_quiz_settings = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_settings . "(
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`key` text NOT NULL,
			`value` text NOT NULL,
			`last_updated` timestamp NULL DEFAULT NULL,
			   PRIMARY KEY (`id`) 
			) $charset_collate;";
		$wpdb->query($sql_sqb_quiz_settings);
	}
	catch (PDOException $e) {
		
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
		
	} catch (Exception $e) {
		
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	$valid_msgs = array();
	 $valid_msgs['correct_answer_msg'] = 'This is the correct answer.';
	 $valid_msgs['incorrect_answer_msg'] = 'This answer is incorrect.';
	 $valid_msgs['username_empty_msg'] = 'Name is a required field. ';
	 $valid_msgs['email_empty_msg'] =  'Email is a required field.';
	 $valid_msgs['terms_condition_msg'] =  'Please accept the terms to proceed.';
	 $valid_msgs['progressbar_color'] =  '#4f6cbf||#e9ecef';
	 $valid_msgs['answer_background'] =  '#4f6cbf||#ffffff||#e5f1ff';
	 $valid_msgs['valid_email'] =  'Please enter a valid email address.';
	 $valid_msgs['pick_ans_msg'] =  'Please pick an answer.';
	 $valid_msgs['sqb_question_cust'] =  'Question';
	 $valid_msgs['sqb_answer_cust'] =  'Answer';
	 $valid_msgs['sqb_incorrect_ans_exp'] =  'Incorrect Answer Explanation';
	 $valid_msgs['fb_share_thank_you_msg'] =  'Thanks for sharing!';
	 $valid_msgs['already_taken_quiz'] =  'You have already taken this quiz. See results below.';
	 $valid_msgs['not_passed_quiz_msg'] =  'Sorry, you need to pass the quiz to proceed to the next lesson.';
	 $valid_msgs['next_button_html'] =  '<div class="single_next_btn sqb_next_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #252525; color: #fff; height: auto; padding: 13px 15px;font-family: DM Sans,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Next</div></div>';
	 $valid_msgs['retake_button_html'] =  '<div class="retake_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: DM Sans,sans-serif;  min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 128px;  max-width: 100%; cursor: pointer;float: none;"><div>Retake</div></div>';
	 $valid_msgs['dap_see_details_btn_html'] =  '<div class="dap_see_details_btn sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #252525; color: #fff; height: auto; padding: 12px 15px;font-family: DM Sans,sans-serif;  min-width: 90px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;  width: 140px;  max-width: 100%; cursor: pointer;float: none;"><div>See Results</div></div>';
	 $valid_msgs['dap_see_details_btn_customizer'] =  '140||12||#252525';
	 $valid_msgs['dap_questions_customizer'] =  '17';
	 $valid_msgs['dap_answer_customizer'] =  '14||500||#f7f7f7||#4f6cbf';	 
	 
	 // skip question but
	 $valid_msgs['skip_question_btn_html'] =  '<div class="skipped_btn skip_question_button sqb_tiny_mce_editor" style=" display: inline-block; border-radius: 5px; background: #4f6cbf; color: #fff; height: auto; padding: 13px 15px;font-family: DM Sans,sans-serif; min-width: 130px; box-shadow: none; margin: 0; text-decoration: none; line-height: normal; border: none; text-align: center;text-transform: initial;font-size: 14px;font-weight: 600; width: 128px; max-width: 100%; cursor: pointer;float: none;"><div>Skip</div></div>';
	 $valid_msgs['skip_question_customizer'] =  '128||13||#4f6cbf';
	 $valid_msgs['user_shortcode_not_login'] =  'Sorry you need to be logged-in to view the quiz results';
	  // category text 
	 $valid_msgs['category_scoring_text1'] =  'Total Score: ';
	 $valid_msgs['category_assessment_text1'] =  'Total Correct Answers: ';
	 $valid_msgs['invalid_date_text'] =  'Invalid Date: ';
	 $valid_msgs['pdf_download_success'] =  'PDF downloaded successfully';
	 $valid_msgs['pdf_downloading_text'] =  'Please wait... Generating Report...';
	 $valid_msgs['logged_in_admin_msg'] =  'You are seeing this message only because you are logged-in as admin. Looks like there is no quiz data for this user. So there\'s nothing to show here.';
	 $valid_msgs['voting_closed'] =  'Voting is closed';
	 $valid_msgs['quiz_details'] =  'Quiz Details';
	 $valid_msgs['user_details'] =  'User Details';
	 $valid_msgs['user_answer'] =  'User Answer';
	 $valid_msgs['sqb_quiz_name'] =  'Quiz Name';
	 $valid_msgs['sqb_date'] =  'Date';
	 $valid_msgs['retake_count'] =  'Retake Count';
	 $valid_msgs['time_spent'] =  'Time Spent';
	 $valid_msgs['gdpr_terms'] =  'GDPR Terms';
	 $valid_msgs['quiz_result'] =  'Quiz Result';
	 $valid_msgs['sqb_outcome'] =  'Outcome';
	 $valid_msgs['sqb_name'] =  'Name';
	 $valid_msgs['sqb_email'] =  'Email';
	 $valid_msgs['user_email'] =  'User Answer';
	 $valid_msgs['student_correct_answer'] =  'Correct Answer';
	 $valid_msgs['points_scored'] =  'Points Scored';
	 $valid_msgs['file_name'] =  'File Name';
	 $valid_msgs['student_incorrect'] =  'Incorrect';
	 $valid_msgs['click_to_download'] =  'Click to download';
	 $valid_msgs['file_upload_successfully'] =  'File Uploaded Successfully';
	 $valid_msgs['answer_no_longer'] =  'This answer is no longer present in the quiz';
	 $valid_msgs['sqb_weight'] =  'Weight';
	 $valid_msgs['sqb_height'] =  'Height';
	 $valid_msgs['not_loggedin'] =  '<div>Sorry you need to be logged-in to access this page. <a href="#">Click HERE</a> to login.</div>';
	 $valid_msgs['dont_want_listed'] =  "Don't want to be listed?";
	 $valid_msgs['click_to_optout'] =  'Click to Opt-out';
	 $valid_msgs['category_name_customize'] =  'Category Name:';
	 $valid_msgs['click_to_play'] =  'Click to unmute';
	 $valid_msgs['student_score'] =  'Score';
	 $valid_msgs['sqb_total_points'] =  'Total Points';
	 $valid_msgs['sqb_result'] =  'Result';
	 $valid_msgs['sqb_score'] =  'Score';
	 $valid_msgs['sqb_high'] =  'High';
	 $valid_msgs['sqb_medium'] =  'Medium';
	 $valid_msgs['sqb_low'] =  'Low';
	 $valid_msgs['logged_in_optout'] =  'You need to be logged-in to opt-out';
	 $valid_msgs['dont_want_listed_leaderboard'] =  "Are you sure you don't want to be listed in the leaderboard?";
	 $valid_msgs['limit_exceeded'] =  "Limit reached! You can only select %%answer_limit%% answer choices.";
	 $valid_msgs['sqb_valid_phonenumber'] =  'Please Enter Valid Phone Number';
	 
     try {
            foreach($valid_msgs as $key=> $value){
				$checkKeyExist = SQB_QuizSettings::checkKeyExist($key);
					if(!isset($checkKeyExist)){
						sqbSetValidSettings($key, $value);
					}
             }
        }
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table table_sqb_quiz_question_bank
		$sql_sqb_quiz_question_bank = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_question_bank . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`question` text  NOT NULL,
			`question_type` varchar(255) NULL,
			`question_title` text ,
			`question_image` text  NOT NULL,
			`question_order` varchar(50)  NOT NULL,
			`ans_with_img` varchar(255)  NOT NULL,
			`multiple_correct_ans` varchar(255)  NOT NULL,
			`ans_layout` varchar(255)  NOT NULL,
			`show_correct_incorrect_ans` varchar(255)  DEFAULT NULL,
			`temp_customizer` TEXT DEFAULT NULL,
			`question_file_upload_settings` TEXT DEFAULT NULL,
			`allow_skip_ques` varchar(10) DEFAULT 'N',
			`next_button_html` TEXT DEFAULT NULL,
			`enable_background_image` text DEFAULT NULL,
			`skip_mapping` char(2) DEFAULT NULL,
			`status` varchar(255) NULL DEFAULT 'Y',
			`date` datetime NOT NULL ,
			`matrix_label_text` TEXT DEFAULT NULL,
			`matrix_html` TEXT DEFAULT NULL,
			`category_id` int(11) DEFAULT NULL ,
			`skip_button_html` TEXT DEFAULT NULL,
			`matrix_column_width` int(11) DEFAULT NULL ,
			`ans_image_setting` TEXT DEFAULT NULL,
			`question_setting` TEXT DEFAULT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_question_bank); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table table_sqb_quiz_questions
		$sql_sqb_quiz_questions = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_questions . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`question_id` int(11) NOT NULL,
			`template_type` varchar(255)  DEFAULT NULL ,
			`question_order` int(11) NULL DEFAULT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_questions); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}	

	try {
		//table table_sqb_quiz_outcome
		$sql_sqb_quiz_outcome = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_outcome . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`outcome_name` text ,
			`outcome_html` longtext ,
			`point` int(11) DEFAULT NULL,
			`point_range` varchar(50)  DEFAULT NULL,
			`correct_ans_num` int(11) DEFAULT NULL,
			`correct_ans_range` varchar(50)  DEFAULT NULL,
			`outcome_screen` varchar(50)  DEFAULT NULL,
			`redirect` varchar(255)  DEFAULT NULL,
			`tag` varchar(255)  DEFAULT NULL,
			`enable_background_image` text DEFAULT NULL,
			`pdf_html` text DEFAULT NULL,
			`status` varchar(255) NULL DEFAULT 'Y',
			`date` datetime NOT NULL ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_outcome); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table_sqb_emailchecker
		$sql_sqb_emailchecker = "CREATE TABLE IF NOT EXISTS " . $table_sqb_emailchecker . " (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`limit_reached_date` DATE NULL DEFAULT NULL,
		 PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_emailchecker); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		//table_sqb_quiz_points
		$sql_sqb_quiz_points = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_points . " (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		`give_points` varchar(255) NOT NULL DEFAULT 'N',
		`quiz_id` int(11) NOT NULL,
		`points` int(11) NOT NULL,
		`pass_criteria` varchar(255) NOT NULL,
		`pass_percent` int(11) NOT NULL,
		`retake_pass_rule` varchar(255) NOT NULL DEFAULT 'N',
		`display_message` text NULL ,
		`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		 PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_points); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
    try {
		//table table_sqb_quiz_funnel
		$sql_sqb_quiz_funnel = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_funnel . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`funnel_name` varchar(255) DEFAULT NULL,
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			`quiz_id` int(11) NOT NULL,
			`funnel_data` longtext ,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_funnel); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table table_sqb_quiz_autoresponder
		$sql_sqb_quiz_autoresponder = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_autoresponder . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`name` varchar(255) NOT NULL,
			`action` varchar(255) NOT NULL,
			`action_type` varchar(255) NOT NULL,
			`action_id` varchar(255) DEFAULT NULL,
			`action_data` varchar(255) NOT NULL,
			`date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_autoresponder); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}


	try {
		//table table_sqb_quiz_answers
		$sql_sqb_quiz_answers = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_answers . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
		  	`question_id` int(11) NOT NULL,
			`answer` text NOT NULL,
			`answer_title` text,
			`correct_answer` text,
			`incorrect_answer_info` text NOT NULL,
			`answer_points` FLOAT NOT NULL,
			`correct_answer_info` text NOT NULL,
			`answer_order` varchar(50) NOT NULL,
			`date` datetime NOT NULL,
			`matrix_values` varchar(255) NULL DEFAULT NULL,
			`recommendation_html` text,
			`tag_ids` varchar(255) NULL DEFAULT NULL,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz_answers); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table sqb_quiz
		$sql_sqb_quiz = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_name` text NOT NULL,
			`quiz_desc` text NOT NULL,
			`quiz_type` varchar(50) NOT NULL,
			`quiz_mode` varchar(50) NOT NULL,
			`quiz_blocking` varchar(50) NOT NULL,
			`quiz_display` varchar(50) NOT NULL,
			`quiz_passmark` varchar(50) NOT NULL,
			`grade_quiz` varchar(50) NOT NULL,
			`quiz_show_correct_answer` varchar(50) NOT NULL,
			`correct_answer_page` varchar(50) DEFAULT NULL,
			`question_display` varchar(50) NOT NULL,
			`redirect_after_complete` varchar(255) DEFAULT NULL,
			`answers_random` varchar(50) DEFAULT NULL,
			`questions_random` varchar(50) DEFAULT NULL,
			`number_of_question` varchar(50) DEFAULT NULL,
			`quiz_attempts_allowed` varchar(50) NOT NULL,
			`quiz_pagination` varchar(50) NOT NULL,
			`question_per_page` varchar(50) NOT NULL,
			`progress_bar` varchar(50) NOT NULL,
			`quiz_timer` varchar(50) DEFAULT NULL,
			`quiz_timer_limit` varchar(50) DEFAULT NULL,
			`quiz_score` varchar(50) NOT NULL,
			`show_percentage` varchar(50)  NOT NULL,
			`show_for_notloggedin_user` varchar(255) NOT NULL,
			`show_start_screen` varchar(50)  DEFAULT NULL,
			`show_optin_screen` varchar(50) DEFAULT NULL,
			`show_share_screen` varchar(50) DEFAULT NULL,
			`show_result_screen` varchar(50) DEFAULT NULL,
			`show_firstname_template` varchar(20) DEFAULT NULL,
			`show_analyzing_result` varchar(20) DEFAULT NULL,
			`show_analyzing_result_time` varchar(20) DEFAULT NULL,
			`template_display_sequence` text,
			`user_added_platform` varchar(255) DEFAULT NULL,
			`user_added_my_email_platform` varchar(255) DEFAULT NULL,
			`already_take_the_quiz` varchar(255) DEFAULT NULL,
			`result_display_option` varchar(255) DEFAULT NULL,
			`outcome_type` varchar(50) DEFAULT NULL,
			`category_option` varchar(255) DEFAULT NULL,
			`user_opt_in_redirect` varchar(50) DEFAULT NULL,
			`user_opt_in_redirect_url` varchar(255) DEFAULT NULL,
			`outcome_page` varchar(50) DEFAULT NULL,
			`display_score_on_page` varchar(50) DEFAULT NULL,
			`display_correctans_options` varchar(250) DEFAULT NULL,
			`display_correctans_on_page` varchar(50) DEFAULT NULL,
			`display_quesans_on_outcome` varchar(50) DEFAULT NULL,
			`outcome_redirect_url` varchar(255) DEFAULT NULL,
			`show_next_button` varchar(20) DEFAULT NULL,
			`total_attempts` int(11) DEFAULT NULL,
			`template` varchar(50) DEFAULT NULL,
			`enable_branching` varchar(255) DEFAULT NULL,
			`pass_criteria` varchar(255) NULL DEFAULT NULL,			
			`allow_retake` varchar(255) NULL DEFAULT NULL,
			`show_video` varchar(10) NULL DEFAULT 'N',
			`video_url` varchar(255) NULL DEFAULT NULL,
			`status` varchar(255) NULL DEFAULT 'Y',
			`sqb_insert_quiz` varchar(255) DEFAULT NULL,
			`quiz_display_url` varchar(255) DEFAULT NULL,
			`quiz_display_in_url` varchar(10) DEFAULT 'Y',
			`quiz_popup_time_delay` int(11) DEFAULT 0,
			`quiz_popup_frequency` varchar(255) DEFAULT NULL,
			`quiz_popup_position` varchar(100) DEFAULT NULL,
			`quick_email_verification` varchar(10) DEFAULT 'N',
			`date` datetime NOT NULL,
			`quiz_slider_animation` CHAR(1) DEFAULT NULL, 
			`quiz_slider_animation_option` CHAR(2) DEFAULT NULL, 
			`questions_top_border` varchar(255) DEFAULT NULL,
			`timer_html` text DEFAULT NULL,
			`timer_customizer` text DEFAULT NULL,
			`timer_expired_msg` text DEFAULT NULL,
			`enable_background_image` text DEFAULT NULL,
			`transparent_background_settings` varchar(255) DEFAULT NULL,
			`category` CHAR(1) DEFAULT NULL,
			`pre_built` CHAR(1) DEFAULT 'N',
			`pre_built_details` varchar(255) DEFAULT NULL,
			`opt_screen_position` varchar(100) DEFAULT NULL,
			`weighted_score` CHAR(1) NULL, 
			`email_notification_settings` varchar(255) DEFAULT NULL,
			`question_bank_options` varchar(255) DEFAULT NULL,
			`recommended_next_button` text DEFAULT NULL, 
			`ans_recommendation` CHAR(1) DEFAULT NULL, 
			`ans_tags` CHAR(1) DEFAULT NULL, 
			`customizer_styles` varchar(255) DEFAULT NULL,
			`move_question` CHAR(1) DEFAULT 'Y',
			`outcome_screen_display` varchar(255) DEFAULT 'NULL',
			`outcome_screen_charts_settings` text DEFAULT NULL,
			`double_optin`  varchar(255) DEFAULT 'NULL',
			`customizer_style_setting` text DEFAULT NULL,
            `exit_popup_value` int(11) DEFAULT NULL,
            `show_firstname_outcome` CHAR(1)  DEFAULT 'Y',
            `show_download_button` CHAR(1) DEFAULT 'N',
			`download_pdf_button_html` text DEFAULT NULL,             
			`pdf_front_last_image` varchar(255) DEFAULT NULL,
			`poll_settings` text DEFAULT NULL,
			PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_quiz); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table sqb_autoresponder_settings
		$sql_sqb_autoresponder_settings = "CREATE TABLE IF NOT EXISTS " . $table_sqb_autoresponder_settings . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
		  	`name` varchar(255) NOT NULL,
		  	`key_name` varchar(255) DEFAULT NULL,
		  	`value` text NOT NULL,
		  	`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_autoresponder_settings); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table sqb_manage_leads
		$sql_sqb_manage_leads = "CREATE TABLE IF NOT EXISTS " . $table_sqb_manage_leads . " (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `user_id` int(11) DEFAULT NULL,
			  `quiz_id` int(11) NOT NULL,
			  `clicked` int(11) DEFAULT NULL,
			  `how_many_answered` int(11) DEFAULT NULL,
			  `completed` int(11) DEFAULT NULL,
			  `opted_in` varchar(255)  DEFAULT NULL,
			  `gdpr_opted_in` varchar(255)  DEFAULT NULL,
			  `shown_outcome` varchar(255)  DEFAULT NULL,
			  `outcome` int(11) NOT NULL,
			  `clicked_on_cta` varchar(255)  DEFAULT NULL,
			  `total_attempts` int(11) DEFAULT NULL,
			  `source` varchar(255)  DEFAULT 'WP',
			  `course_id` int(11)  DEFAULT NULL,
			  `lesson_id` int(11)  DEFAULT NULL,
			  `time_spent` int(11)  DEFAULT NULL,
			  `date` varchar(255) DEFAULT NULL,
			  `category_details` varchar(255) DEFAULT NULL,
			  `user_name` varchar(255) DEFAULT NULL,
			   `user_source` varchar(20) DEFAULT NULL,
			   `unique_id` varchar(255) DEFAULT NULL,
			  PRIMARY KEY (id) ) $charset_collate;";

			$wpdb->query($sql_sqb_manage_leads); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table sqb_outcome_mapping
		$sql_sqb_outcome_mapping = "CREATE TABLE IF NOT EXISTS " . $table_sqb_outcome_mapping . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
  			`question_id` int(11) NOT NULL,
  			`answer_id` int(11) NOT NULL,
  			`outcome_id` varchar(255) DEFAULT NULL,
  			`outcome_range` varchar(255) DEFAULT NULL,
			PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_outcome_mapping); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		//table sqb_question_answer_report
		$sql_sqb_question_answer_report = "CREATE TABLE IF NOT EXISTS " . $table_sqb_question_answer_report . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`question_id` int(11) NOT NULL,
			`visited` varchar(50) NOT NULL,
			`answered` varchar(50) DEFAULT NULL,
			`answer_id` varchar(50) NOT NULL,
			`outcome_id` int(11) DEFAULT NULL,
			`other_field` varchar(255) DEFAULT NULL,
			`date` datetime NOT NULL,
			PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_question_answer_report); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	/* Create table SQB GDPR Start */

	try {

		$sqb_gdpr_sql = "CREATE TABLE IF NOT EXISTS " . $table_sqb_gdpr . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`country_name` varchar(100) NOT NULL,
			`country_code` varchar(10) NOT NULL,
			`status` int(11) NOT NULL DEFAULT 1,
			PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sqb_gdpr_sql); 

	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	

	/* SQB GDPR End */
	
	try {
	//sqb_dap_lesson_quiz
	$sql_sqb_dap_lesson_quiz = "CREATE TABLE IF NOT EXISTS " . $table_sqb_dap_lesson_quiz . " (
		`id` int(11) NOT NULL AUTO_INCREMENT,
		 `lesson_id` int(11) DEFAULT NULL,
		 `quiz_id` int(11) DEFAULT NULL,  
		`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id) ) $charset_collate;";
		$wpdb->query($sql_sqb_dap_lesson_quiz); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
		$sql_sqb_email_template = "CREATE TABLE IF NOT EXISTS " . $table_sqb_email_template . " (
			`id` int(11) NOT NULL AUTO_INCREMENT , 
		    `quiz_id` int(11) NOT NULL,
		    `type` varchar(255) NOT NULL,
		    `template_data` text 
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_email_template); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
		//table_sqb_global_theme 
		$sql_sqb_global_theme = "CREATE TABLE IF NOT EXISTS " . $table_sqb_global_theme . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`name` varchar(255) DEFAULT NULL, 
			`value` text DEFAULT NULL,
			`status` char(1) NOT NULL DEFAULT 'N',
			`type` varchar(50)  DEFAULT NULL,
			`custom_values` varchar(255)  DEFAULT NULL,
			`outer_style_status` char(1) NOT NULL DEFAULT 'Y',
			`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		  	PRIMARY KEY (id) ) $charset_collate;";
			$wpdb->query($sql_sqb_global_theme); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
			$sql_sqb_quiz_category = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_category . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) DEFAULT NULL, 
				`description` varchar(255) DEFAULT NULL, 
				`status` char(1) NOT NULL DEFAULT 'N',
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id) ) $charset_collate;";
				$wpdb->query($sql_sqb_quiz_category); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	/*-----------------Calculator Formula-----------------------*/
	
	try {
			$sql_sqb_calculator_formula = "CREATE TABLE IF NOT EXISTS " . $table_sqb_calculator_formula . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(255) DEFAULT NULL, 
				`quiz_id` int(11) NOT NULL,
				`html` longtext DEFAULT NULL,
				`customizer_data` longtext DEFAULT NULL,
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				`number_range` varchar(255) DEFAULT NULL, 
				`formula_values` varchar(255) DEFAULT NULL, 
				`outcome_id` int(11) DEFAULT NULL,
				PRIMARY KEY (id) ) $charset_collate;";
				$wpdb->query($sql_sqb_calculator_formula); 
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	try {
			$sql_sqb_internal_users = "CREATE TABLE IF NOT EXISTS " . $table_sqb_internal_users . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`email` varchar(255) DEFAULT NULL, 
				`first_name` varchar(255) DEFAULT NULL, 
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id) ) $charset_collate;";
				$wpdb->query($sql_sqb_internal_users); 
				
				$sql_set_auto_inc = "ALTER TABLE `".$table_sqb_internal_users."` AUTO_INCREMENT = 200000;";
				$wpdb->query($sql_set_auto_inc); 
				
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
			$sql_sqb_custom_fields = "CREATE TABLE IF NOT EXISTS " . $table_sqb_custom_fields . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`name` varchar(20) DEFAULT NULL, 
				`label` varchar(200) DEFAULT NULL, 
				`description` text DEFAULT NULL, 
				`field_type` varchar(255) DEFAULT NULL, 
				`field_value` varchar(255) DEFAULT 'N', 
				`showonlytoadmin` char(1) NOT NULL DEFAULT 'N', 
				`allow_delete` char(1) NOT NULL DEFAULT 'Y', 
				`required` char(1) NOT NULL DEFAULT 'N', 
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id) ) $charset_collate;";
				$wpdb->query($sql_sqb_custom_fields); 
				
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
	
	try {
			$sql_sqb_user_custom_fields = "CREATE TABLE IF NOT EXISTS " . $table_sqb_user_custom_fields . " (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`user_id` int(11) NOT NULL,
				`quiz_id` int(11) NOT NULL,
				`manage_lead_id` int(11) NOT NULL,
				`name` varchar(255) NOT NULL, 
				`value` varchar(255) DEFAULT NULL,
				`date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY (id) ) $charset_collate;";
				$wpdb->query($sql_sqb_user_custom_fields); 
				
	}
	catch (PDOException $e) {
		logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}

	if (class_exists('Dap_SQBQuizCourseLessons')) {
		$sqb_quiz_blocking_list = Dap_SQBQuizCourseLessons::load();
		if(count($sqb_quiz_blocking_list) == 0){
			update_option('dap_quiz_migration','Y');
		}
	}
	
	global $sqb_db_version;
	update_option('sqb_db_version',$sqb_db_version);
	
	//SQBPreBuiltThemeInstall();

}



function SQBPreBuiltThemeInstall(){
	
	$new_theme_creation_details[] = array('name'=>'whatcourseshouldyoucreate','quiz_type'=>'personality','version'=>'13.1.1');
	$new_theme_creation_details[] = array('name'=>'content-marketing','quiz_type'=>'scoring','version'=>'20.9');
	$new_theme_creation_details[] = array('name'=>'exitintentsurvey','quiz_type'=>'personality','version'=>'21.9');
	$new_theme_creation_details[] = array('name'=>'productfeedbacksurvey','quiz_type'=>'survey','version'=>'14.3');
	$new_theme_creation_details[] = array('name'=>'onlinecourserevenuecalculator','quiz_type'=>'calculator','version'=>'14.3');
	$new_theme_creation_details[] = array('name'=>'areyouaworkaholic','quiz_type'=>'scoring','version'=>'15.6');
	$new_theme_creation_details[] = array('name'=>'signupbelowforfree','quiz_type'=>'personality','version'=>'18.6');
	
	$alreadyBuiltThemeListArray = array();
	$alreadyBuiltThemeListOjb = SQB_Quiz::loadPreBuiltTheme();
	if(isset($alreadyBuiltThemeListOjb)){
		foreach($alreadyBuiltThemeListOjb as $data_theme){
			$quiz_id = $data_theme->getId();
			$quiz_type = $data_theme->getQuizType();
			$pre_built = $data_theme->getPreBuilt();
			$pre_built_details = trim($data_theme->getPreBuiltDetails());
			$pre_built_details = explode('||',$pre_built_details);
			$theme_ver = '';
			$theme_name = '';
			if(isset($pre_built_details[0])){
				$theme_name =  trim($pre_built_details[0]);
			}
			if(isset($pre_built_details[1])){
				$theme_ver = $pre_built_details[1];
			}
			
			$alreadyBuiltThemeListArray[$quiz_type][$theme_name]['theme_ver'] = $theme_ver;
			$alreadyBuiltThemeListArray[$quiz_type][$theme_name]['quiz_id'] = $quiz_id;
			
		}
	}
	
	if(is_array($new_theme_creation_details)){
		foreach($new_theme_creation_details as $theme_detail){
			$_GET['sqb_theme_built_install_call'] = false;
			$theme_name = $theme_detail['name'];
			$quiz_type = $theme_detail['quiz_type'];
			$theme_version = $theme_detail['version'];
			$new_theme_creation_status = false;
			$alredy_exist_theme_status = false;
			if(is_array($alreadyBuiltThemeListArray) && isset($alreadyBuiltThemeListArray[$quiz_type][$theme_name])){
				
				 if(isset($alreadyBuiltThemeListArray[$quiz_type][$theme_name]['theme_ver'])){
						if (version_compare($theme_version,$alreadyBuiltThemeListArray[$quiz_type][$theme_name]['theme_ver'])){
							$alredy_exist_theme_status = true;
							$new_theme_creation_status = true;
						}
				 }
			}else{
				$new_theme_creation_status = true;
			}
			if($alredy_exist_theme_status){
				 $quiz_id = $alreadyBuiltThemeListArray[$quiz_type][$theme_name]['quiz_id'];
				
				 sqbDeleteQuizByIdAjax(array('quiz_id'=>$quiz_id));
			}
			if($new_theme_creation_status){
				
				$file_path = SQB_FILE."includes/installfromsample/".$quiz_type."/".$theme_name."/".$theme_name.".php";
				if(file_exists($file_path)){
					
					$_GET['sqb_theme_built_install_call'] = true;
					require_once ($file_path);
					$_GET['sqb_theme_built_install_call'] = false;
				}	
			}
			
		}
	}
	
}