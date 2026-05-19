<?php 

$updateSql = array();
global $sqb_custom_fields;

$table_sqb_custom_fields = $wpdb->prefix . $sqb_custom_fields;

if(!sqb_check_column_exist($table_sqb_custom_fields,'selected_country')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_custom_fields."` ADD `selected_country` varchar(11) DEFAULT NULL;";
}