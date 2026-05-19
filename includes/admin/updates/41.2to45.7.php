<?php 
$updateSql = array();
global $wpdb;
global $sqb_quiz_outcome;
$table_sqb_quiz_outcome = $wpdb->prefix . $sqb_quiz_outcome;

if (sqb_check_column_exist($table_sqb_quiz_outcome, 'redirect')) {
    $updateSql[] = "ALTER TABLE `{$table_sqb_quiz_outcome}` 
                    CHANGE `redirect` `redirect` TEXT 
                    NULL DEFAULT NULL";
}