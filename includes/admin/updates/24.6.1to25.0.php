<?php

$updateSql = array();
global $sqb_quiz;
global $sqb_quiz_questions;
global $sqb_quiz_outcome;

$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;
$table_sqb_quiz_outcome = $wpdb->prefix.'sqb_quiz_outcome';

if(!sqb_check_column_exist($table_sqb_quiz,'game_animations')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `game_animations` CHAR(1) NULL DEFAULT 'N';";
}

if(!sqb_check_column_exist($table_sqb_quiz,'game_animations_options')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` ADD `game_animations_options` TEXT NULL;";
}

if(!sqb_check_column_exist($table_sqb_quiz_outcome,'game_animation_html')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_outcome."` ADD `game_animation_html` TEXT NULL;";
}