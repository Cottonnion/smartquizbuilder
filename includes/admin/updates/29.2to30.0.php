<?php 

$updateSql = array();
global $sqb_quiz_template;
global $sqb_quiz_outcome;

$table_sqb_quiz_template = $wpdb->prefix . $sqb_quiz_template;

$table_sqb_quiz_template = $wpdb->prefix . $sqb_quiz_template;
if(!sqb_check_column_exist($table_sqb_quiz_template,'customizer_html')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_quiz_template."` ADD `customizer_html` TEXT NOT NULL";
}

$table_sqb_quiz_outcome = $wpdb->prefix . $sqb_quiz_outcome;
if(!sqb_check_column_exist($table_sqb_quiz_outcome,'customizer_options')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_quiz_outcome."` ADD `customizer_options` LONGTEXT NOT NULL";
}