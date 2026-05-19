<?php

$updateSql = array();
global $sqb_quiz;

$tbl_sqb_advanced_rule = $wpdb->prefix . 'sqb_advanced_rule';

if(sqb_check_column_exist($tbl_sqb_advanced_rule,'start_range')){
	$updateSql[] = "ALTER TABLE `".$tbl_sqb_advanced_rule."` CHANGE `start_range` `start_range` VARCHAR(10) NULL DEFAULT '';";
}

if(sqb_check_column_exist($tbl_sqb_advanced_rule,'end_range')){
	$updateSql[] = "ALTER TABLE `".$tbl_sqb_advanced_rule."` CHANGE `end_range` `end_range` VARCHAR(10) NULL DEFAULT '';";
}