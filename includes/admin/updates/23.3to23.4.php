<?php

$updateSql = array();
global $sqb_quiz;
global $sqb_quiz_questions;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;
$table_sqb_quiz_questions = $wpdb->prefix . $sqb_quiz_questions;
if(!sqb_check_column_exist($table_sqb_quiz,'qns_ads')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `qns_ads` CHAR(1) DEFAULT NULL;";
}

if(!sqb_check_column_exist($table_sqb_quiz,'ads_next_button')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `ads_next_button` text  DEFAULT NULL;";
}

if(!sqb_check_column_exist($table_sqb_quiz_questions,'question_ads_html')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_questions."` ADD `question_ads_html` text NULL;";
}

if(!sqb_check_column_exist($table_sqb_quiz_questions,'show_ads')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_questions."` ADD `show_ads`  CHAR(1)  DEFAULT 'N';";
}