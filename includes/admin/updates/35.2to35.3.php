<?php 

$updateSql = array();
global $sqb_outcome_mapping;
global $sqb_quiz_answers;
global $sqb_quiz;

$table_sqb_outcome_mapping = $wpdb->prefix . $sqb_outcome_mapping;
$table_sqb_quiz_answers = $wpdb->prefix . $sqb_quiz_answers;
$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;


if(!sqb_check_column_exist($table_sqb_outcome_mapping,'matrix_mapping')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_outcome_mapping."` ADD `matrix_mapping` longtext  DEFAULT ''";
}

if(sqb_check_column_exist($table_sqb_quiz_answers,'tag_ids')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_answers."` CHANGE `tag_ids` `tag_ids` longtext DEFAULT ''";
}

if(sqb_check_column_exist($table_sqb_quiz,'game_animation_options')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz."` CHANGE `game_animation_options` `game_animation_options` BLOB NULL DEFAULT NULL";
}