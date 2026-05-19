<?php 

$updateSql = array();
global $wpdb;

$table_sqb_quiz_category = $wpdb->prefix . 'sqb_quiz_category';

$updateSql[] = "ALTER TABLE ".$table_sqb_quiz_category." CHANGE `name` `name` VARCHAR(50);";

$cat_table = "SHOW COLUMNS FROM `".$table_sqb_quiz_category."` LIKE 'name'";
$record = $wpdb->get_row($cat_table,ARRAY_A);

if(isset($record['Key']) && $record['Key'] != 'UNI'){
    $updateSql[] = "ALTER TABLE ".$table_sqb_quiz_category." ADD CONSTRAINT name UNIQUE(`name`)";
}