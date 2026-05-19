<?php 

$updateSql = array();
global $sqb_quiz;
global $sqb_quiz_notifications;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;
$table_sqb_quiz_notifications = $wpdb->prefix . $sqb_quiz_notifications;

if(!sqb_check_column_exist($table_sqb_quiz,'admin_email')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `admin_email` CHAR(1)  DEFAULT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz,'send_copy')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `send_copy` CHAR(1)  DEFAULT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz_notifications,'admin_from_email')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `admin_from_email` text DEFAULT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz_notifications,'admin_subject')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `admin_subject` text DEFAULT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz_notifications,'admin_body')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_notifications."` ADD `admin_body` longtext DEFAULT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz,'auto_submit_opt')){
// For Auto submit Optin
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `auto_submit_opt` CHAR(1) NOT NULL DEFAULT 'N'";
}