<?php

global $sqb_gdpr;
$sqb_gdpr = 'sqb_gdpr';

function sqb_gdpr_data(){
global $wpdb;
global $sqb_gdpr;
$sqb_gdpr = 'sqb_gdpr';
$sqb_gdpr = $wpdb->prefix . $sqb_gdpr;

try{
		
	  $wpdb->query("INSERT IGNORE  INTO `$sqb_gdpr` (`id`, `country_name`, `country_code`, `status`) VALUES 
						  (1, 'Belgium', 'BE', 1),(2, 'Bulgaria', 'BG', 1),(3, 'Czech Republic', 'CZ', 1),(4, 'Denmark', 'DK', 1),(5, 'Germany', 'DE', 1),(6, 'Estonia', 'EE', 1),(7, 'Ireland', 'IE', 1),(8, 'Greece', 'EL', 1),(9, 'Spain', 'ES', 1),(10, 'France', 'FR', 1), (11, 'Croatia', 'HR', 1), (12, 'Italy', 'IT', 1), (13, 'Cyprus', 'CY', 1), (14, 'Latvia', 'LV', 1), (15, 'Lithuania', 'LT',  1), (16, 'Luxembourg', 'LU', 1),(17, 'Hungary', 'HU', 1),  (18, 'Malta', 'MT', 1), (19, 'Netherlands', 'NL',  1), (20, 'Austria', 'AT', 1), (21, 'Poland', 'PL', 1), (22, 'Portugal', 'PT',  1),  (23, 'Romania', 'RO', 1), (24, 'Slovakia', 'SK', 1), (25, 'Slovenia', 'SI', 1), (26, 'Finland', 'FI', 1), (27, 'Sweden', 'SE', 1), (28, 'United Kingdom', 'GB', 1)");
			   
	}
	catch (PDOException $e) {
		logToFile("sqb_data_sql.php: table exists: ".$e->getMessage(), LOG_DEBUG_DAP);
	} catch (Exception $e) {
		logToFile("sqb_data_sql.php: exception(), Error is".$e->getMessage(), LOG_DEBUG_DAP);
	}
}