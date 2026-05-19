<?php 

$updateSql = array();

$table_sqb_quiz_video_captions = $wpdb->prefix . 'sqb_quiz_video_captions';
global $sqb_quiz;
$table_sqb_quiz = $wpdb->prefix . $sqb_quiz;

$updateSql[] = "CREATE TABLE IF NOT EXISTS `".$table_sqb_quiz_video_captions."` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `video_url` text NOT NULL,
    `video_caption` blob
  )";


if(sqb_check_column_exist($table_sqb_quiz,'transparent_background_settings')){
    $updateSql[] =  "ALTER TABLE " . $table_sqb_quiz . " CHANGE `transparent_background_settings` `transparent_background_settings` text  DEFAULT NULL";
}