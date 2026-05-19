<?php 

$updateSql = array();
global $sqb_manage_leads;

$table_sqb_manage_leads = $wpdb->prefix . $sqb_manage_leads;

if(!sqb_check_column_exist($table_sqb_manage_leads,'category_total_details')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_manage_leads."` ADD `category_total_details` varchar(255) DEFAULT '';";
}