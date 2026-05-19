<?php 
$updateSql = array();
global $wpdb;

global $sqb_quiz;
$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;
if(sqb_check_column_exist($table_sqb_quiz,'ads_next_button')){
      $updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `ads_next_button` `ads_next_button` BLOB NULL";
}

if(sqb_check_column_exist($table_sqb_quiz,'timer_html')){
      $updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `timer_html` `timer_html` BLOB NULL";
}

if(sqb_check_column_exist($table_sqb_quiz,'timer_customizer')){
      $updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `timer_customizer` `timer_customizer` BLOB NULL";
}


