<?php

$updateSql = array();
global $sqb_quiz;

$tbl_sqb_advanced_rule = $wpdb->prefix . 'sqb_advanced_rule';

if(!sqb_check_column_exist($tbl_sqb_advanced_rule,'start_range')){
	$updateSql[] = "ALTER TABLE `".$tbl_sqb_advanced_rule."` ADD `start_range` VARCHAR(10) NOT NULL DEFAULT '';";
}

if(!sqb_check_column_exist($tbl_sqb_advanced_rule,'end_range')){
	$updateSql[] = "ALTER TABLE `".$tbl_sqb_advanced_rule."` ADD `end_range` VARCHAR(10) NOT NULL DEFAULT '';";
}