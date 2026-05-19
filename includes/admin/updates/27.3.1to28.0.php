<?php

$updateSql = array();


global $wpdb;
global $sqb_quiz_certificate;
$charset_collate = $wpdb->get_charset_collate();

$table_sqb_quiz_certificate = $wpdb->prefix . 'sqb_quiz_certificate';
$table_manage_leads = $wpdb->prefix . 'sqb_manage_leads';

$updateSql[] = "CREATE TABLE IF NOT EXISTS ".$table_sqb_quiz_certificate." (
        `id` int(11) NOT NULL AUTO_INCREMENT primary key,   
        `name` varchar(255) NOT NULL,
        `admin_name` varchar(255) NOT NULL,
        `logo_img` varchar(255) NOT NULL,
        `signature_img` varchar(255) NOT NULL,
        `template` varchar(255) NOT NULL,
        `template_html` longtext NOT NULL,
        `options` longtext NOT NULL,
        `status` varchar(2) NOT NULL,
        `date` timestamp
      )  $charset_collate";

if(!sqb_check_column_exist($table_manage_leads,'certificate_id')){
  $updateSql[] = "ALTER TABLE ".$table_manage_leads." ADD `certificate_id` INT(11) NOT NULL;";
}