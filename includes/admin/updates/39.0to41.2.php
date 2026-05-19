<?php 

$updateSql = array();

global $wpdb;
global $sqb_email_template;
$charset_collate = $wpdb->get_charset_collate();

$table_sqb_email_template = $wpdb->prefix . 'sqb_email_template';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_email_template." (
    `id` int(11) NOT NULL AUTO_INCREMENT primary key, 
    `quiz_id` int(11) NOT NULL,
    `type` varchar(255) NOT NULL,
    `template_data` text 
  )  $charset_collate";