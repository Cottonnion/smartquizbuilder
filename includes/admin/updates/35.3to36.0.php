<?php 

$updateSql = array();
global $sqb_quiz_outcome;
global $sqb_pdf_content;


$table_sqb_quiz_outcome = $wpdb->prefix . $sqb_quiz_outcome;
if(!sqb_check_column_exist($table_sqb_quiz_outcome,'pdf_id')){
	$updateSql[] = "ALTER TABLE `".$table_sqb_quiz_outcome."` ADD `pdf_id` int(11) DEFAULT NULL";
}

$charset_collate = $wpdb->get_charset_collate();
$table_sqb_pdf_content = $wpdb->prefix . 'sqb_pdf_content';
$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_pdf_content." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` longtext DEFAULT NULL,
  `other_options` longtext DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)  $charset_collate";