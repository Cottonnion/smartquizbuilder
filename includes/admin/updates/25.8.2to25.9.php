<?php

$updateSql = array();
global $sqb_quiz;
global $sqb_quiz_answers;

$table_sqb_quiz_answers = $wpdb->prefix.'sqb_quiz_answers';

if(!sqb_check_column_exist($table_sqb_quiz_answers,'extra_options')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_answers."` ADD `extra_options` text DEFAULT NULL;";
}
