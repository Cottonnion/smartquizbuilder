<?php 

$updateSql = array();
global $sqb_quiz;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;

if(sqb_check_column_exist($table_sqb_quiz,'game_animations_options')){
	$updateSql[] = "ALTER TABLE ".$table_sqb_quiz." CHANGE `game_animations_options` `game_animations_options` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL";
}