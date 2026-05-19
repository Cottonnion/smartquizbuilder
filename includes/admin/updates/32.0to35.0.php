<?php 

$updateSql = array();
global $sqb_quiz;
global $sqb_quiz_category;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;

if(!sqb_check_column_exist($table_sqb_quiz,'setting_level')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `setting_level` VARCHAR(10)  NULL DEFAULT 'quiz'";
}


$table_sqb_quiz_category = $wpdb->prefix . $sqb_quiz_category;
if(sqb_check_column_exist($table_sqb_quiz_category,'description')){
    $updateSql[] =  "ALTER TABLE ".$table_sqb_quiz_category." CHANGE `description` `description` longtext NULL DEFAULT NULL";
}

if(sqb_check_column_exist($table_sqb_quiz,'quiz_mode')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `quiz_mode` `quiz_mode` VARCHAR(50) NOT NULL DEFAULT ''";
}