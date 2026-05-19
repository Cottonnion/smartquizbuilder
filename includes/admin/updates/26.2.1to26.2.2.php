<?php 

$updateSql = array();
global $wpdb;

$table_sqb_quiz_form = $wpdb->prefix . 'sqb_quiz_form';

$charset_collate = $wpdb->get_charset_collate();

$updateSql[] = "CREATE TABLE IF NOT EXISTS " . $table_sqb_quiz_form . " (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quiz_id` int(11) NOT NULL,
			`name` varchar(255) ,
			`form_id` varchar(255) ,
			`value` longtext,
			`required` varchar(255) ,
			`type` varchar(255),
			`placeholder` varchar(255),
		  	PRIMARY KEY (id) ) $charset_collate;";