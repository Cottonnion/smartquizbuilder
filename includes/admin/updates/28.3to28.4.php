<?php

$updateSql = array();

global $wpdb;
global $sqb_leaderboard,$sqb_global_theme;
$table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;
$charset_collate = $wpdb->get_charset_collate();

$sqb_leaderboard = $wpdb->prefix . 'sqb_leaderboard';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$sqb_leaderboard." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_type` varchar(10) NOT NULL,
  `quiz_ids` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `max_records` varchar(10) NOT NULL,
  `retake_overwrites` char(1) NOT NULL DEFAULT 'N',
  `show_type` varchar(10) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `no_data_text` text NOT NULL,
  `template` varchar(10) NOT NULL,
  `leaderboard_order` varchar(50) NOT NULL,
  `customizer_html` text NOT NULL,
  `customizer_values` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
)  $charset_collate";


  $sql = "SELECT * from $table_sqb_global_theme WHERE name = 'lb_exclude_users'";
  $exclude_users = $wpdb->get_row($sql);

  if(empty($exclude_users)){
    $updateSql[] ="INSERT INTO `".$table_sqb_global_theme."` (`quiz_id`, `name`, `value`, `status`, `type`, `custom_values`, `outer_style_status`) VALUES ('0', 'lb_exclude_users', '', 'Y', 'global', '', 'Y');";
  }