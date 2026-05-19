<?php 

$updateSql = array();
global $sqb_advanced_rule;
global $sqb_quiz_template;

$table_sqb_advanced_rule = $wpdb->prefix . $sqb_advanced_rule;
if(!sqb_check_column_exist($table_sqb_advanced_rule,'conditions')){
    $updateSql[] =  "ALTER TABLE ".$table_sqb_advanced_rule." ADD `conditions` text DEFAULT NULL";
}

$table_sqb_quiz_template = $wpdb->prefix . $sqb_quiz_template;
if(sqb_check_column_exist($table_sqb_quiz_template,'quiz_start_template_html')){
    $updateSql[] =  "ALTER TABLE ".$table_sqb_quiz_template." CHANGE `quiz_start_template_html` `quiz_start_template_html` BLOB NULL DEFAULT NULL";
}