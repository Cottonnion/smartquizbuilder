<?php 

$updateSql = array();
global $wpdb;

global $sqb_member_home;
$charset_collate = $wpdb->get_charset_collate();

$table_sqb_member_home = $wpdb->prefix . 'sqb_member_home';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_member_home." (
      `id` int(11) NOT NULL AUTO_INCREMENT primary key, 
      `name` varchar(255) NOT NULL,
      `options` text NOT NULL,
      `customizer_html` longtext,
      `customizer_options` longtext,
      `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    )  $charset_collate";