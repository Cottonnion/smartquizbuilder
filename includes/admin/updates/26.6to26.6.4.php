<?php 

$updateSql = array();
global $wpdb;

global $sqb_quiz_outcome_description;
$charset_collate = $wpdb->get_charset_collate();

$table_sqb_quiz_outcome_description = $wpdb->prefix . 'sqb_quiz_outcome_description';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_quiz_outcome_description." (
      `id` int(11) NOT NULL AUTO_INCREMENT primary key, 
      `quiz_id` int(11) NOT NULL,
      `outcome_id` int(11) NOT NULL,
      `description` text 
    )  $charset_collate";