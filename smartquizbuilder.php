<?php 
/*
Plugin Name: Smart Quiz Builder
Plugin URI: http://www.WickedCoolPlugins.com
Description: The Most Powerful, Easy-to-Use and Customizable Quiz & Survey Plugin for WordPress!
Version: 47.0
Author: Veena Prashanth
Author URI: https://SmartQuizBuilder.com
*/

$sqbVersion = '47.0';

define( 'SQB_VERSION', $sqbVersion );
define('SQB_PLUGIN_FILE', __FILE__);


$smartquizbuilder_base_dir = WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__), "" ,plugin_basename(__FILE__));
require_once (plugin_dir_path(__FILE__)."includes/admin/lib/sqb_includes_css_js.php");
//require_once(WP_PLUGIN_DIR . "/smartquizbuilder/install.php");
define('SQB_FILE', plugin_dir_path(__FILE__));
define('SQB_URL', plugin_dir_url(__FILE__));
//define('SQBFLOW_VER',rand(10,100));
define('SQBFLOW_VER','47.0');
require_once(WP_PLUGIN_DIR . "/smartquizbuilder/includes/admin/doInstall.php");

require_once(WP_PLUGIN_DIR . "/smartquizbuilder/sqb_data_sql.php");
//if($GLOBALS['pagenow'] === 'plugins.php'){
//	require_once(WP_PLUGIN_DIR . "/smartquizbuilder/smartquizbuilder-update/smartquizbuilder.php");
//}

if ( file_exists( plugin_dir_path( __FILE__ ) . '/smartquizbuilder-update/plugin-update-checker/plugin-update-checker.php' ) ) {
  if (!class_exists('Puc_v4_Factory')) {
    require_once dirname( __FILE__ ).'/smartquizbuilder-update/plugin-update-checker/plugin-update-checker.php';
  }
  
  require_once(plugin_dir_path(__FILE__)."smartquizbuilder-update/smartquizbuilder.php");
}


require_once (plugin_dir_path(__FILE__)."smartquizbuilder_classes.php");

function isSQBOptimized(){
	if(isset($_REQUEST['sqb-force-v2']))
		return 1;
	else if(isset($_REQUEST['sqb-force-v1']))
		return 0;
	else if(get_option('sqb_newflow', '') == 'Y')
		return 1;
	else
		return 0;
}




if(isSQBOptimized()){
	require_once (plugin_dir_path(__FILE__)."smartquizbuilder_fe_v2.php");
}else{
	require_once (plugin_dir_path(__FILE__)."smartquizbuilder_fe.php");
}

function disable_emojis() {
	if(isset($_GET['page'])  &&  $_GET['page'] == 'sqb_add_quiz'){
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );	
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'sqb_disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
	}
	
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function sqb_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	}

	return array();
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param  array  $urls          URLs to print for resource hints.
 * @param  string $relation_type The relation type the URLs are printed for.
 * @return array                 Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {

	if ( 'dns-prefetch' == $relation_type ) {

		// Strip out any URLs referencing the WordPress.org emoji location
		$emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
		foreach ( $urls as $key => $url ) {
			if ( strpos( $url, $emoji_svg_url_bit ) !== false ) {
				unset( $urls[$key] );
			}
		}

	}

	return $urls;
}

require_once(WP_PLUGIN_DIR . "/smartquizbuilder/_smartquizbuilder.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions.php");
register_activation_hook(__FILE__,'SQBDoInstall');
register_activation_hook(__FILE__,'sqb_gdpr_data');

global $wpdb;
global $smartquizbuilder_db_version;
$ssmartquizbuilder_db_version = "2.0";

// include admin lib ajax function file
require_once (plugin_dir_path(__FILE__)."includes/lib/functions-ajax.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions_fe.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions-member.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions-leaderboard.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/function_new.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions-chatgpt.php");
require_once (plugin_dir_path(__FILE__)."includes/lib/functions-quiz.php");
require_once (plugin_dir_path(__FILE__)."includes/admin/openAIPrompts.php");

// GamiPress integration - load only when GamiPress is active
add_action('plugins_loaded', function(){
	if( class_exists('GamiPress') ){
		require_once (plugin_dir_path(__FILE__)."includes/plugins/gamipress/sqb-gamipress.php");
	}
});

/*Added for the embed code*/
function sqb_add_cors_http_header(){ 
	
	//added for elementor where 'X-Frame-Options':"ALLOWALL" conflicting with server 'X-Frame-Options':"SAMEORIGIN"
	if(isset($_REQUEST['action']) && ($_REQUEST['action']  == "elementor" || isset($_REQUEST['elementor-preview']))){
		return ;
	} 
	 $actions = array("elementor");	
	if ( isset( $_GET['action'] ) && in_array( $_GET['action'], $actions ) || isset($_GET['elementor-preview'])  || isset($_GET['elementor']) ) {
		return ;
	}
	   
	//added for the iframe not working in thrid party
	header('X-Frame-Options: ALLOWALL');
	
	$origin = get_http_origin();

	if ( is_allowed_http_origin( $origin ) ) {
		header( 'Access-Control-Allow-Origin: ' . $origin );
		header('Content-Type: text/html; charset=UTF-8');
		if ( 'OPTIONS' === $_SERVER['REQUEST_METHOD'] ) {
			exit;
		}
		return $origin;
	}

	if ( 'OPTIONS' === $_SERVER['REQUEST_METHOD'] ) {
		status_header( 403 );
		exit;
	}

	return false;

	//header("Access-Control-Allow-Origin: *");
}
if(isset($_GET['SQBIframe'])){
	add_action('init','sqb_add_cors_http_header');
}

// Media uploader
add_action('admin_enqueue_scripts', 'sqb_uploader_enqueue');
function sqb_uploader_enqueue() {
	wp_enqueue_media();
	wp_register_script( 'media-lib-uploader', plugins_url( 'media-lib-uploader.js' , __FILE__ ), array('jquery') );
	wp_enqueue_script( 'media-lib-uploader' );
}

$a3 = "SQB.php";
 // for external script using iframe
add_action( 'init', 'SQBIframe' );
function SQBIframe(){
	ob_start();    
	if(! is_admin() && $GLOBALS['pagenow'] !== 'post.php'){
		global $post; 
		$jquerymain = '';
		if (isset($_GET['SQBIframe']) && $_GET['SQBIframe']=="Y") { 		 
			if (isset($_GET['quiz_id']) && $_GET['quiz_id'] > 0 ) { 				
				$quiz_id = $_GET['quiz_id'];	
				//added for remove cache in iframe 	
				wp_cache_flush();
				if(!isSQBOptimized()){
					$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
				}
				$jquerymain .="<script type='text/javascript' src='".plugin_dir_url(__FILE__)."includes/js/jquery.cookie.min.js"."'></script>";		
				$start_tag = '<html><head><meta charset="UTF-8"><body>';
				$end_tag = '</head></body>';
				
				echo $start_tag.SQBDisplayQuizById($quiz_id).$jquerymain.$end_tag;die;		  
			}	
		}	

		if (isset($_GET['SQBPreview']) && $_GET['SQBPreview']=="Y") { 		 
			if (isset($_GET['quiz_id']) && $_GET['quiz_id'] > 0 ) { 				
				$quiz_id = $_GET['quiz_id'];		
				$jquerymain ="<script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";							  
				echo $jquerymain.SQBDisplayQuizById($quiz_id, $_GET['SQBPreview']);die;				  
			}	
		}
		
	}
	ob_get_clean(); 
}

$a4 = ".php";
// add_action( 'wp', 'getPageId' );
add_action( 'wp_footer', 'getPageId', 100 );

function getPageId() {
    if ( ! is_admin() && $GLOBALS['pagenow'] !== 'post.php' ) {
        global $post;

        if ( isset( $post ) && is_object( $post ) ) {
            $page_id = $post->ID;

            getFormQuizForPageId( $page_id );
        }
    }
}


function getFormQuizForPageId($page_id){
	$form_data = SQB_FormQuiz::loadQuizIdByPageId($page_id);
	if($form_data){
		$quiz_id = $form_data->getQuizId();		 					  
		echo SQBDisplayQuizById($quiz_id);
		//die;			
	}
}