<?php 

$updateSql = array();
global $wpdb;

global $sqb_quiz;
$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;

if(!sqb_check_column_exist($table_sqb_quiz,'all_other_options')){
      $updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `all_other_options` longtext;";
}