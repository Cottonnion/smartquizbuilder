<?php 


$lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
if(file_exists($lldocroot . "/dap/dap-config.php")) include_once ($lldocroot . "/dap/dap-config.php");  
                
// ALLOW_UNFILTERED_UPLOADS removed: permitted PHP file uploads via WP media uploader
add_action('wp_head', 'add_file');
global $sqb_add_question_pagination_limit;
$sqb_add_question_pagination_limit = 25;

global $sqb_add_outcome_pagination_limit;
$sqb_add_outcome_pagination_limit = 10;

function add_file(){
  if(isset($_GET['sqbtw'])){
    include_once(plugin_dir_path(__FILE__) . '/tw.php');
  }
}

if (is_admin()) {
  add_action('admin_menu', 'register_sqb_menupage');
}

function register_sqb_menupage() {
  add_menu_page('SmartQuizBuilder', 'SmartQuizBuilder', 'manage_options', 'smartquizbuilder', 'smartquizbuilder');
  
  add_submenu_page('smartquizbuilder', 'Manage Quizzes', 'Manage Quizzes', 'manage_options', 'sqb_add_quiz', 'sqb_add_quiz');
 // add_submenu_page('sqb_add_quiz', 'Manage Quizzes', 'Manage Quizzes', 'manage_options', 'sqb_add_quiz', 'sqb_add_quiz');
  //add_submenu_page('smartquizbuilder', 'Manage Funnel', 'Manage Funnel', 'manage_options', 'sqb_manage_funnel', 'sqb_manage_funnel');
  add_submenu_page('smartquizbuilder', 'Quiz Funnels', 'Quiz Funnels', 'manage_options', 'sqb_add_funnel', 'sqb_add_funnel');
  add_submenu_page('smartquizbuilder', 'Student Dashboard', 'Student Dashboard', 'manage_options', 'sqb_student_home', 'sqb_student_home');
  add_submenu_page('', 'Create Student', 'Create Student', 'manage_options', 'sqb_create_student_page', 'sqb_create_student_page');
  add_submenu_page('smartquizbuilder', 'Leaderboard', 'Leaderboard', 'manage_options', 'sqb_leaderboard_page', 'sqb_leaderboard_page');
  add_submenu_page('smartquizbuilder', 'PDF Content', 'PDF Content', 'manage_options', 'sqb_pdf_content', 'sqb_pdf_content');
  add_submenu_page('', 'Create Leaderboard', 'Create Leaderboard', 'manage_options', 'sqb_create_leaderboard_page', 'sqb_create_leaderboard_page');
  add_submenu_page('', 'Create PDF Content', 'Create PDF Content', 'manage_options', 'sqb_create_pdf_content_page', 'sqb_create_pdf_content_page');
  add_submenu_page('smartquizbuilder', 'Reports', 'Reports', 'manage_options', 'sqb_reports', 'sqb_reports');
  add_submenu_page('smartquizbuilder', 'Manage Leads', 'Manage Leads', 'manage_options', 'sqb_manage_leads', 'sqb_manage_leads');
  add_submenu_page('smartquizbuilder', 'Social Share', 'Social Share', 'manage_options', 'sqb_social_share', 'sqb_social_share');
  add_submenu_page('smartquizbuilder', 'Question Bank', 'Question Bank', 'manage_options', 'sqb_question_bank', 'sqb_question_bank');
  add_submenu_page('smartquizbuilder', 'Settings', 'Settings', 'manage_options', 'sqb_settings', 'sqb_settings');
  add_submenu_page('smartquizbuilder', 'Documentation', 'Documentation', 'manage_options', 'sqb_documentation', 'sqb_documentation');
  //add_submenu_page('smartquizbuilder', 'Fb Tracking', 'Fb Tracking', 'manage_options', 'sqb_fb_tracking', 'sqb_fb_tracking');
 
  //add_submenu_page('', '', '', 'administrator', 'sqb_add_quiz', 'sqb_add_quiz');
 // add_submenu_page('', '', '', 'administrator', 'sqb_add_funnel', 'sqb_add_funnel');
  //add_submenu_page('', '', '', 'administrator', 'sqb_settings', 'sqb_settings');
  add_submenu_page('', '', '', 'administrator', 'sqb_question_answer_report', 'sqb_question_answer_report');
  
  remove_submenu_page('smartquizbuilder','smartquizbuilder');
}

 function sqb_question_bank(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_question_bank.php';  
}

 
function sqb_documentation(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_documentation.php';
  
}
 
function sqb_question_answer_report(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
  
}

function sqb_settings(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
} 

function sqb_fb_tracking(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
} 

function sqb_social_share(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
} 
function sqb_reports(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
} 

function sqb_manage_leads(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
} 
 
function smartquizbuilder(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}
$wcpDomain="www.wickedcoolplugins.com";

function sqb_add_quiz(){
  //require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_add_quiz.php';
 
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

function sqb_manage_funnel(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_manage_funnel.php';
}
function sqb_add_funnel(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_add_funnel.php';
}

function sqb_student_home(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

$a2 = "ValidateLicense";

function sqb_create_student_page(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

function sqb_leaderboard_page(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

function sqb_pdf_content(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

function sqb_create_leaderboard_page(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}

function sqb_create_pdf_content_page(){
  require_once plugin_dir_path(__FILE__) . 'includes/admin/sqb_layout.php';
}



global $sqb_db_version;
require_once(ABSPATH . 'wp-admin/includes/plugin.php');
$get_all_active_plugins_slug = get_option('active_plugins');
$get_all_plugins_details = get_plugins();
$activated_plugins=array();
foreach ($get_all_active_plugins_slug as $get_all_active_plugin_slug){    
  if($get_all_active_plugin_slug == 'smartquizbuilder/smartquizbuilder.php'){   
    if(isset($get_all_plugins_details[$get_all_active_plugin_slug])){
       $sqb_db_version = $get_all_plugins_details[$get_all_active_plugin_slug]['Version'];
    }           
  }
}

$a1 = "wcp";


function sqb_update_db_check() {
  global $sqb_db_version; // sqb current version
 
  $plugin_data = get_plugin_data(  SQB_FILE.'smartquizbuilder.php');
  $sqb_db_version = $plugin_data['Version'];
  
  $sqb_custom_version = get_site_option( 'sqb_db_version' );
  if($sqb_custom_version == "") {
    SQBDoInstall();
  }
  else {
    if ( $sqb_custom_version  != $sqb_db_version ) {
      SQBDoInstall();
    }
  }
}
add_action( 'init', 'sqb_update_db_check',0 );

if(isset($_GET['page']) && $_GET['page'] == 'sqb_add_quiz'){
    add_action( 'wp_print_scripts', 'wp_dequeue_script_admin', 100 );
}
function wp_dequeue_script_admin() {
    wp_dequeue_script('sweetalert');
    wp_dequeue_script('bs_cache_sweetalert_js');
    wp_dequeue_script('bs-sweetalert-script');

    wp_deregister_script('sweetalert');
    wp_deregister_script('bs_cache_sweetalert_js');
    wp_deregister_script('bs-sweetalert-script');
}

function get_current_AIPQ_version() {

  $plugin_path = 'ai-powered-quiz/ai-powered-quiz.php';

  if(file_exists(WP_PLUGIN_DIR . '/' . $plugin_path)){
    // Get the plugin data
    $plugin_data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_path);

    if ($plugin_data) {
      $plugin_version = $plugin_data['Version'];
    }else{
      $plugin_version = 0;
    }
    return $plugin_version;
  }else{
    return 0;
  }

}

function ai_is_allow_quiz_ideas(){
  $plugin_version = get_current_AIPQ_version();
  if (version_compare($plugin_version, '1.4', '>=')) {
      return 1;
  }else{
    return 0;
  }
}