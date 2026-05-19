<?php

$updateSql = array();


global $wpdb;
global $sqb_advanced_category_rule;
$charset_collate = $wpdb->get_charset_collate();

$table_sqb_advanced_rule = $wpdb->prefix . 'sqb_advanced_category_rule';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_advanced_rule." (
	  `id` int(11) NOT NULL AUTO_INCREMENT primary key,	
	  `category_id` int(11) NOT NULL,
	  `quiz_id` int(11) NOT NULL,
	  `start_range` int(11) NOT NULL,
	  `end_range` int(11) NOT NULL,
	  `category_description` text 
	)  $charset_collate";