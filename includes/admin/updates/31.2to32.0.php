<?php 

$updateSql = array();
global $sqb_quiz;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;

if(!sqb_check_column_exist($table_sqb_quiz,'global_style')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `global_style` VARCHAR(1)  DEFAULT 'N'";
}