<?php 

$updateSql = array();
global $wpdb;

$sqb_quiz_tracking = $wpdb->prefix . 'sqb_quiz_tracking';
if(!sqb_check_column_exist($sqb_quiz_tracking,'track_type')){
	$updateSql[] = "ALTER TABLE ".$sqb_quiz_tracking." ADD `status` CHAR(1) NOT NULL DEFAULT 'Y' AFTER `track_type`;";
}