<?php

$updateSql = array();
global $sqb_quiz;
$table_sqb_quiz = $wpdb->prefix.'sqb_quiz';

if(!sqb_check_column_exist($table_sqb_quiz,'show_back_button')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `show_back_button` VARCHAR(255) DEFAULT NULL;";
}
