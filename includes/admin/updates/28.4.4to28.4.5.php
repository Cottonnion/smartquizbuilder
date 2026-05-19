<?php 
$updateSql = array();
global $wpdb;
global $sqb_custom_fields;
$table_sqb_custom_fields = $wpdb->prefix . $sqb_custom_fields;
if(sqb_check_column_exist($table_sqb_custom_fields,'field_value')){
  $updateSql[] = "ALTER TABLE `".$table_sqb_custom_fields."` CHANGE `field_value` `field_value` text";
}
