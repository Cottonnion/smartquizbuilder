<?php 
$updateSql = array();
global $wpdb;
global $sqb_quiz_tracking,$sqb_reports;
$table_sqb_quiz_tracking = $wpdb->prefix . $sqb_quiz_tracking;
if(sqb_check_column_exist($table_sqb_quiz_tracking,'value')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_quiz_tracking."` CHANGE `value` `value` TEXT";
}

$table_sqb_reports = $wpdb->prefix . $sqb_reports;
if(!sqb_check_column_exist($table_sqb_reports,'external_url')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_reports."` ADD `external_url` TEXT NOT NULL";
}

if(!sqb_check_column_exist($table_sqb_quiz_tracking,'status')){
	$updateSql[] = "ALTER TABLE ".$table_sqb_quiz_tracking." ADD `status` CHAR(1) NOT NULL DEFAULT 'Y'";
}

if(get_option('sqb_newflow') == ''){
  update_option('sqb_newflow', 'Y');
}