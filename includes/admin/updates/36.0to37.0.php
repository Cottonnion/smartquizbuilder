<?php 

$updateSql = array();
global $sqb_quiz_autoresponder;

$table_sqb_quiz_autoresponder = $wpdb->prefix . $sqb_quiz_autoresponder;

if(!sqb_check_column_exist($table_sqb_quiz_autoresponder,'outcome_id')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_quiz_autoresponder."` ADD `outcome_id` int(11) DEFAULT 0;";
}