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
global $sqb_advanced_category_rule;
global $sqb_form_quiz;
global $sqb_tags;
global $sqb_quiz_outcome_description;
global $sqb_quiz_certificate;
global $sqb_leaderboard;
global $sqb_quiz_video_captions;

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
$sqb_advanced_category_rule = 'sqb_advanced_category_rule';
$sqb_form_quiz = 'sqb_form_quiz';
$sqb_tags = 'sqb_tags';
$sqb_quiz_outcome_description = 'sqb_quiz_outcome_description';
$sqb_quiz_certificate = 'sqb_quiz_certificate';
$sqb_leaderboard = 'sqb_leaderboard';
$sqb_quiz_video_captions = 'sqb_quiz_video_captions';



function SQBDoInstall(){

	global $is_come_from_activate_hook;
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
	global $sqb_advanced_category_rule;
	global $sqb_form_quiz;
	global $sqb_tags;
	global $sqb_quiz_outcome_description;
	global $sqb_quiz_certificate;
	global $sqb_leaderboard;
	global $sqb_quiz_video_captions;
	
	$is_come_from_activate_hook = true;
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
	$table_sqb_advanced_category_rule = $wpdb->prefix . $sqb_advanced_category_rule;
	$table_sqb_form_quiz = $wpdb->prefix . $sqb_form_quiz;
	$table_sqb_tags = $wpdb->prefix . $sqb_tags;
	$table_sqb_quiz_outcome_description = $wpdb->prefix . $sqb_quiz_outcome_description;
	$table_sqb_quiz_certificate = $wpdb->prefix . $sqb_quiz_certificate;
	$table_sqb_leaderboard = $wpdb->prefix . $sqb_leaderboard;
	$table_sqb_quiz_video_captions = $wpdb->prefix . $sqb_quiz_video_captions;
 
    $charset_collate = $wpdb->get_charset_collate();

   	global $sqb_db_version;
   	

   	if( ! function_exists('get_plugin_data') ){
        require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    $plugin_data = get_plugin_data(  SQB_FILE.'smartquizbuilder.php');
 
    $sqb_version = $plugin_data['Version'];

    if($wpdb->get_var("SHOW TABLES LIKE '$table_sqb_quiz'") == $table_sqb_quiz) {
	    
    	if(version_compare($sqb_version,'23.1', '<=') ){
			// Logic for older install.php
			installOlderSQB();
    	}else{
    		// Update SQB
    		require_once SQB_FILE.'includes/admin/installSQB.php';

    		$old_version = get_site_option( 'sqb_db_version' );
    		if(version_compare($old_version,'23.1', '<=') ){
    			installSQB();
    			updateSQB();
    		}else if (version_compare($old_version,'24.3', '<=')) {
    			updateSQB();
			}
    		
			if (version_compare($sqb_version,'24.6', '<=')){
				sqb_upgrade_older_fix();
			}

    		sqb_upgrade();
    		SQBPreBuiltThemeInstall();
    	}

	}else{

		// Only for new install
    	installSQB();
    	updateSQB();
    	sqb_upgrade();
    	SQBPreBuiltThemeInstall();
	}

}

function sqb_check_column_exist($tablename,$columnname){
	global $wpdb;

	$value = $wpdb->get_var("SELECT * 
    FROM INFORMATION_SCHEMA.COLUMNS 
	WHERE table_schema = '".DB_NAME."' 
    AND table_name = '".$tablename."'
    AND column_name = '".$columnname."'");

   // echo $wpdb->last_query;exit;
	return $value;
}

//add_action( 'plugins_loaded', 'sqb_upgrade',10, 2 );

function sqb_upgrade_older_fix()	
{
	global $wpdb;
	$plugin_data = get_plugin_data(  SQB_FILE.'smartquizbuilder.php');
	require SQB_FILE.'includes/admin/version.php';
	
	$charset_collate = $wpdb->get_charset_collate();
	
	$update_file_path = SQB_FILE.'includes/admin/updates/';
	if(!empty($versions)){
		foreach ($versions as $ver_key => $version) {
			
			if(file_exists($update_file_path.$version)){
				include($update_file_path.$version);
				if(!empty($updateSql)){
					foreach ($updateSql as $key => $sql) {
						try {
							$wpdb->query($sql);	
						}
						catch (PDOException $e) {
							logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
						} catch (Exception $e) {
							logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
						}
					}
				}
			}
		}
	}
	
	//SQBDoInstall();
}

function sqb_upgrade()	
{
	global $wpdb;
	$plugin_data = get_plugin_data(  SQB_FILE.'smartquizbuilder.php');

	require SQB_FILE.'includes/admin/version.php';
	
	$old_version = get_site_option( 'sqb_db_version' );
	$current_version = $plugin_data['Version'];
	$charset_collate = $wpdb->get_charset_collate();
	
	$update_file_path = SQB_FILE.'includes/admin/updates/';
	if(!empty($versions)){
		foreach ($versions as $ver_key => $version) {
			if(version_compare($ver_key,$old_version, '>') && version_compare($ver_key,$current_version, '<=') ){
				//echo "New Version : $version <br />";
				
				if(file_exists($update_file_path.$version)){
					
					include($update_file_path.$version);
					if(!empty($updateSql)){
						foreach ($updateSql as $key => $sql) {
							try {
								$wpdb->query($sql);	
							}
							catch (PDOException $e) {
								logToFile("install.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
							} catch (Exception $e) {
								logToFile("install.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
							}
						}
					}
				}
			}else{
				//echo "Old Version : $version<br />";
			}

		}

		update_option('sqb_db_version',$current_version);
	}
	
	//SQBDoInstall();
}

function installSQB(){

	require_once SQB_FILE.'includes/admin/installSQB.php';
	install_smartquizbuilder();
}

function updateSQB(){

	require_once SQB_FILE.'includes/admin/updateSQB.php';
	SQB_alterqueries();
}

function installOlderSQB(){
	require_once SQB_FILE.'install.php';
	smartquizbuilder_install();
}

add_action('wp_ajax_SqbRepairTable', 'SqbRepairTable');

function SqbRepairTable(){
	global $wpdb;
	$current_user = wp_get_current_user();
	if (user_can( $current_user, 'administrator' )) {
		updateSQB();
		// Pass the true for repaire
		sqb_upgrade_older_fix();
		echo json_encode(array('status' => 'ok', 'message' => 'Repaired Successfully')); exit;
	}else{
		echo json_encode(array('status' => 'erorr', 'message' => 'Invalid Request')); exit;
	}
}