<?php

add_shortcode('SQBLeaderboard', 'SQBLeaderboardContent');

function SQBLeaderboardContent($atts){

    extract(shortcode_atts(array( 
        'id' => 0,
        'optout' => 1
	), $atts));

    if(empty($id)){
        return '';
    }

    $leaderboard = SQB_LeaderboardPage::loadById($id);


    // Messages

    $lbl_dont_want_listed = stripslashes(sqbGetValidSettingsByKey('dont_want_listed'));
    if(empty($lbl_dont_want_listed)){
        $lbl_dont_want_listed = "Don't want to be listed?";
    }

    $lbl_click_to_optout = stripslashes(sqbGetValidSettingsByKey('click_to_optout'));
    if(empty($lbl_click_to_optout)){
        $lbl_click_to_optout = 'Click to Opt-out';
    }

    $lbl_logged_in_optout = stripslashes(sqbGetValidSettingsByKey('logged_in_optout'));
    if(empty($lbl_logged_in_optout)){
        $lbl_logged_in_optout = 'You need to be logged-in to opt-out';
    }

    $lbl_dont_want_listed_leaderboard = stripslashes(sqbGetValidSettingsByKey('dont_want_listed_leaderboard'));
    if(empty($lbl_dont_want_listed_leaderboard)){
        $lbl_dont_want_listed_leaderboard = "Are you sure you don't want to be listed in the leaderboard?";
    }

    $assets_version = time();

    wp_enqueue_style("sqb_datatables" , "//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css",  false,  $assets_version);
     wp_enqueue_style("sqb_datatables-buttons" , "//cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css",  false,  $assets_version);
     wp_enqueue_script("sqb_datatables" , "//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js",  array('jquery'),  $assets_version);
     wp_enqueue_script("sqb_datatables-button" , "//cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js",  array('jquery'),  $assets_version);
     wp_enqueue_script("sqb_datatables-html" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js",  array('jquery'),  $assets_version);
     wp_enqueue_script("sqb_datatables-print" , "//cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js",  array('jquery'),  $assets_version);
    wp_enqueue_script("sqb_leaderboard_frontend",SQB_URL.'includes/js/sqb_leaderboard_fe.js', array('jquery'), $assets_version);
    wp_localize_script( 'sqb_leaderboard_frontend', 'sqbLeaderboard', 
        array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'confirm_optout' => $lbl_dont_want_listed_leaderboard
        )
    );
  
    if(!empty($leaderboard)){
        

        $quiz_ids = $leaderboard->getQuizIds();
        $lb_name = $leaderboard->getName();

        $settings = maybe_unserialize($leaderboard->getCustomizerValues());
        
        $lb_select_background_width_option = !empty($settings['lb_select_background_width_option']) ? $settings['lb_select_background_width_option'] : 'px';
        $lb_select_background_internal_width_option = !empty($settings['lb_select_background_internal_width_option']) ? $settings['lb_select_background_internal_width_option'] : 'px';
        $lb_select_background_height_option = !empty($settings['lb_select_background_height_option']) ? $settings['lb_select_background_height_option'] : 'px';

        $lb_template_width = !empty($settings['lb_template_width']) ? $settings['lb_template_width'] : '';
        $lb_temp_internal_width = !empty($settings['lb_temp_internal_width']) ? $settings['lb_temp_internal_width'] : '';
        $lb_template_height = !empty($settings['lb_template_height']) ? $settings['lb_template_height'] : '';


        $lb_temp_aligment = !empty($settings['lb_temp_aligment']) ? $settings['lb_temp_aligment'] : 'none';
        $lb_temp_background_color = !empty($settings['lb_temp_background_color']) ? $settings['lb_temp_background_color'] : '';
        $lb_temp_border_width = !empty($settings['lb_temp_border_width']) ? $settings['lb_temp_border_width'] : '';
        $lb_temp_border_style = !empty($settings['lb_temp_border_style']) ? $settings['lb_temp_border_style'] : '';
        $lb_optout_background_color = !empty($settings['lb_optout_background_color']) ? $settings['lb_optout_background_color'] : '';
        $lb_temp_vertical_length = !empty($settings['lb_temp_vertical_length']) ? $settings['lb_temp_vertical_length'] : '';
        $lb_temp_border_color = !empty($settings['lb_temp_border_color']) ? $settings['lb_temp_border_color'] : '';
        $lb_temp_border_radius = !empty($settings['lb_temp_border_radius']) ? $settings['lb_temp_border_radius'] : '';
        $lb_temp_shadow_color = !empty($settings['lb_temp_shadow_color']) ? $settings['lb_temp_shadow_color'] : '';
        $lb_temp_spread_radius = !empty($settings['lb_temp_spread_radius']) ? $settings['lb_temp_spread_radius'] : '';
        $lb_temp_blur_radius = !empty($settings['lb_temp_blur_radius']) ? $settings['lb_temp_blur_radius'] : '';
        $lb_temp_horizontal_length = !empty($settings['lb_temp_horizontal_length']) ? $settings['lb_temp_horizontal_length'] : '';
        $lb_temp_background_opacity = !empty($settings['lb_temp_background_opacity']) ? $settings['lb_temp_background_opacity'] : '';
        $lb_leaderboard_background_color = !empty($settings['lb_leaderboard_background_color']) ? $settings['lb_leaderboard_background_color'] : '';
        $lb_description_background_color = !empty($settings['lb_description_background_color']) ? $settings['lb_description_background_color'] : '';
        $lb_heading_background_color = !empty($settings['lb_heading_background_color']) ? $settings['lb_heading_background_color'] : '';
        $lb_alternate_background_color = !empty($settings['lb_alternate_background_color']) ? $settings['lb_alternate_background_color'] : '';
        $lb_pagination = !empty($settings['lb_pagination']) ? $settings['lb_pagination'] : '10';

        $lb_alternate_second_background_color = !empty($settings['lb_alternate_second_background_color']) ? $settings['lb_alternate_second_background_color'] : '';
        $lb_leaderboardimage = !empty($settings['lb_leaderboardimage']) ? '<img src="'.$settings['lb_leaderboardimage'].'">' : '';

        $leaderboard_content = !empty($settings['leaderboard_content']) ? stripslashes($settings['leaderboard_content']) : '';
        $leaderboard_title = !empty($settings['leaderboard_title']) ? stripslashes($settings['leaderboard_title']) : '';
        $display_name = !empty($settings['display_options']) ? $settings['display_options'] : 'fullname';
        $score_format = !empty($settings['score_format']) ? $settings['score_format'] : 'score_with_total';

        $options['limit'] = $leaderboard->getMaxRecords();
        $options['show_type'] = $leaderboard->getShowType();
        $options['order_by'] = $leaderboard->getLeaderboardOrder();
        $options['retake_quiz'] = $leaderboard->getRetakeOverwrites();
        $options['exclude_users'] = sqb_get_lb_exclude_users();

        $rank_title = !empty($settings['rank_title']) ? $settings['rank_title'] : 'Rank';
        $first_name_title = !empty($settings['first_name']) ? $settings['first_name'] : 'Name';
        $score_title = !empty($settings['score']) ? $settings['score'] : 'Score';

        if(sqb_admin_report_view()){
            //$lb_leaderboard_background_color = '';
            $lb_temp_background_color = '';
            $lb_temp_border_color= '';
            $lb_temp_border_style= '';
            $lb_optout_background_color= '';
            $lb_temp_border_radius= '';
            $lb_temp_shadow_color= '';
            $lb_temp_horizontal_length = '';
            $lb_temp_vertical_length = '';
            $lb_temp_internal_width = '';
            $lb_select_background_internal_width_option = '';
            $lb_template_height = '';
            $lb_select_background_height_option = '';

        }
        $css_variables = "
        <link rel='stylesheet' id='sqb_leaderboard_frontend-css' href='".SQB_URL."includes/css/sqb_leaderboard_fe.css?".$assets_version."' media='all' />
        <style>
        :root{
            --lb-template-width: ".$lb_template_width.$lb_select_background_width_option.";
            --lb-template-height: ".$lb_template_height.$lb_select_background_height_option.";
            --lb-temp-internal-width: ".$lb_temp_internal_width.$lb_select_background_internal_width_option.";
            --lb-template-background-opacity: ".$lb_temp_background_opacity.";
            --lb-temp-border-width: ".$lb_temp_border_width."px;
            --lb-temp-spread-radius: ".$lb_temp_spread_radius."px;
            --lb-temp-blur-radius: ".$lb_temp_blur_radius."px;
            --lb-temp-horizontal-length: ".$lb_temp_horizontal_length."px;
            --lb-temp-vertical-length: ".$lb_temp_vertical_length."px;
            --lb-leaderboard-background-color: ".$lb_leaderboard_background_color.";
            --lb-temp-background-color: ".$lb_temp_background_color.";
            --lb-description-background-color: ".$lb_description_background_color.";
            --lb-heading-background-color: ".$lb_heading_background_color.";
            --lb-alternate-background-color: ".$lb_alternate_background_color.";
            --lb-alternate-second-background-color: ".$lb_alternate_second_background_color.";
            --lb-temp-border-color: ".$lb_temp_border_color.";
            --lb-temp-border-style: ".$lb_temp_border_style.";
            --lb-optout-background-color: ".$lb_optout_background_color.";
            --lb-temp-border-radius: ".$lb_temp_border_radius."px;
            --lb-temp-shadow-color: ".$lb_temp_shadow_color.";
            
        }
        </style>
        ";

        if(sqb_admin_report_view()){
            $colspan = '4';
            $action_heading = '<th>Action</th>';
        }else{
            $colspan = '3';
            $action_heading = '';
        }

        if(sqb_admin_report_view()){
            $lb_leaderboardimage = '';
            $leaderboard_title = '';
            $leaderboard_content = '';
        }

        $html = '
        <input type="hidden" value="'.$lb_pagination.'" id="lb_pagination"> 
        <div class="sqb_leaderboard_engagement-inner sqb_leaderboard_engagement_full_width_temp template-align-'.$lb_temp_aligment.'">
        <div class="sqb_leaderboard_engagement-left sqb_leaderboard_drap_drop_parent_class focus-mode-enable">
            <div class="leaderboard-main">
                <div class="leaderboard-bg">
                '.$lb_leaderboardimage.'
                </div>
                <div class="leaderboard-content-main">
                    <div class="leaderboard-header">
                       '.$leaderboard_title.'
                        
                    </div>
                    <div class="leader-content">
                            '.$leaderboard_content.'
                        </div>
                    <div class="leaderboard-table">
                        <table>
                        <thead><tr><th><div class="rank_title sqb_tiny_mce_editor mce-content-body"><div>'.stripslashes($rank_title).'</div></div></th><th><div class="first_name sqb_tiny_mce_editor"><div>'.stripslashes($first_name_title).'</div></div></th><th><div class="score sqb_tiny_mce_editor mce-content-body"><div>'.stripslashes($score_title).'</div></div></th>'.stripslashes($action_heading).'</tr></thead>
                            <tbody>
                            %%DATA%%
                        </tbody></table>
                    </div>
                    <div class="optiout-wrapper">
                        %%OPTOUT%%
                    </div>
                </div>
                
            </div>
           
        </div>
        </div>';


        /*if(!empty($quiz_ids)){
            $quiz_ids = explode(',',$quiz_ids);
            foreach ($quiz_ids as $key => $quiz_id) {
                $quizObj = SQB_Quiz::loadById($quiz_id);
            }
        }*/


        $start_date = $leaderboard->getStartDate();
        $end_date = $leaderboard->getEndDate();
        
        

        $leads = SQB_ManageLeads::loadByLeaderboard($quiz_ids,$options,$start_date,$end_date);
      
        
        if(!empty($leads)){
            $tr = '';
            foreach ($leads as $key => $lead) {
                $manage_leads_id = $lead->id;
                $date = $lead->date;
                $quiz_id = $lead->quiz_id;
                $user_id = $lead->user_id;
                
                $userDetail = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id,$quiz_id,$date);
                $source = $lead->source;
                $user_source = $lead->user_source;
                $rank = $key+1;
                $user_name='';
                $name = '';
                if($lead->user_name != ''){
                    $user_name = $lead->user_name;
                }
               
                $points = $lead->points;
                $total_points = $lead->total_points;

                if($source == "WP" && $user_source == "WP"){
                    $user_info = get_userdata($user_id);
                    
                    if(isset($user_info)){
                        $name =  $user_info->first_name." ". $user_info->last_name;	
                        $email =  $user_info->user_email ;	
                    }else{
                        $name =  "";	
                    }
                }else if($source == "WP" && $user_source == "SQB"){
                    $sqbUserObj = SQB_InternalUsers::loadByIdNew($user_id);					 
                    if(isset($sqbUserObj)){
                        $email = $sqbUserObj->getEmail(); 	
                        $name = $sqbUserObj->getFirstName(); 	
                    }	
                    
                }else if($source == "DAP"){
                    
                    $dapUserObj = Dap_User::loadUserById($user_id);
                    if(isset($dapUserObj)){						
                        
                        $name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();	

                        $email =  $dapUserObj->getEmail();
                        
                    }
                }

                if($name=="" || $name==" "){
                    $name= $user_name;
                }

                $displayname = $name;
                
                if(!empty($name)){
                    $name = explode(' ',$name);
                    if($display_name == 'firstname'){
                        $displayname = $name[0];
                    }else if($display_name == 'lastname_initial'){
                        
                        if(!empty($name[1])){
                            $displayname = $name[0].' '.substr($name[1], 0, 1);
                        }
                    }
                }

                $tr .= '<tr>';
                $tr .= '<td>'.$rank.'</td>';
                $tr .= '<td>'.$displayname.'</td>';

                $score = '';
                if($score_format == 'score_with_total'){
                    $score = $points.'/'.$total_points;
                }else if($score_format == 'score_only'){
                    $score = $points;
                }else if($score_format == 'score_in_percent'){
                    try{
                        $score = floor(($points*100)/$total_points).'%';
                    }catch(DivisionByZeroError $e){
                        $score = 0;
                    }
                }
                $tr .= '<td>'.$score.'</td>';

                if(sqb_admin_report_view()){
                    $tr .= '<td><a href="javascript:void(0);" class="sqb-remove-user-from-leaderboar" data-userid="'.$user_id.'" data-source="'.$user_source.'">Remove</a></td>';
                }

                $tr .= '</tr>';

            }

            //$internal_user_id = get_sqb_internal_users();
            $action = '';
            $first_name = '';
            if($optout == 1){
                $dapUser  = is_dap_leaderboard_login();
                $user_type = '';
                if(is_user_logged_in()){
                    $internal_user_id = get_current_user_id();
                    $new_user = get_userdata($internal_user_id);
                    if(!empty($new_user)){
                        $first_name = get_user_meta( $internal_user_id, 'first_name', true );
                    }
                    $user_type = 'WP';
                }else if(!empty($dapUser)){
                    $internal_user_id  = $dapUser->getId();
                    $first_name = $dapUser->getFirst_name();
                    $user_type = 'DAP';
                }

                $exclud_users = !empty($options['exclude_users'][$user_type]) ? $options['exclude_users'][$user_type] : array();
                
                $isAllow = false;
                if(!empty($dapUser) && (!in_array($internal_user_id,$exclud_users))){
                    $isAllow = true;
                }else if(is_user_logged_in() && (!in_array($internal_user_id,$exclud_users))){
                    $isAllow = true;
                }

                if($isAllow == true){
                    $action = '<div class="optout-wrapper" data-usertype="'.$user_type.'">
                    <h3>'.$lbl_dont_want_listed.'</h2>
                    <a href="javascript:void(0);" class="remove-from-leaderboard">'.$lbl_click_to_optout.'</a>
                    </div>';
                }
            }

            global $quiz_inside;
            $final_html = str_replace('%%DATA%%',$tr,$html);
           
            if(!$quiz_inside){
                $final_html = str_replace('%%FIRST%%',$first_name,$final_html);
                $final_html = str_replace('%%FIRST_NAME%%',$first_name,$final_html);
                $final_html = str_replace('%%NAME%%',$first_name,$final_html);

            }

            $final_html = str_replace('%%OPTOUT%%',$action,$final_html);
            
            $final_html = str_replace('contenteditable="true"','',$final_html);


            return $css_variables.$final_html;
        }else{
            $nodata = $leaderboard->getNoDataText();
            $tr = '<tr><td colspan="'.$colspan.'">'.$nodata.'</td></tr>';
            $final_html = str_replace('%%DATA%%',$tr,$html);
            $final_html = str_replace('%%OPTOUT%%','',$final_html);
            $final_html = str_replace('contenteditable="true"','',$final_html);

            $dapUser  = is_dap_leaderboard_login();
            $first_name = '';
            if(is_user_logged_in()){
                $internal_user_id = get_current_user_id();
                $new_user = get_userdata($internal_user_id);
                if(!empty($new_user)){
                    $first_name = $new_user->user_firstname;
                }
            }else if(!empty($dapUser)){
                $internal_user_id  = $dapUser->getId();
                $first_name = $dapUser->getFirst_name();
            }

            $final_html = str_replace('%%FIRST_NAME%%',$firstname,$final_html);
            $final_html = str_replace('%%NAME%%',$firstname,$final_html);

            return $css_variables.$final_html;
        }
    }
}

function sqb_admin_report_view(){

    if(!empty($_REQUEST['action']) && $_REQUEST['action'] == 'sqb_load_leaderboard'){
        return true;
    }else{
        return false;
    }
}

function sqb_get_lb_exclude_users(){
 
    global $wpdb,$sqb_global_theme;;
    $table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;

    $sql = "SELECT value from $table_sqb_global_theme WHERE name = 'lb_exclude_users'";
    $user_ids = $wpdb->get_var($sql);

    if(!empty($user_ids)){
        return maybe_unserialize($user_ids);
    }else{
        return array();
    }
}

add_action("wp_ajax_sqb_lb_exclude_users", "sqb_lb_exclude_users");

function sqb_lb_exclude_users(){
    
    global $wpdb,$sqb_global_theme, $sqb_internal_users;
    $table_sqb_global_theme = $wpdb->prefix . $sqb_global_theme;
    $table_sqb_internal_users = $wpdb->prefix . $sqb_internal_users;

    $sql = "SELECT * from $table_sqb_global_theme WHERE name = 'lb_exclude_users'";
    $exclude_users = $wpdb->get_row($sql);


    if(!empty($exclude_users)){

        $user_type = 'WP';
        $user_id = 0;

        $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
        if(is_user_logged_in()){
            $user_id =  get_current_user_id();
            $user_type = 'WP';
        }else if(file_exists($lldocroot . "/dap/dap-config.php")){
            include_once ($lldocroot . "/dap/dap-config.php");
            if( Dap_Session::isLoggedIn() ) {
                $session = Dap_Session::getSession();
                $user = $session->getUser();
                $user_id = $user->getId();
                $user_type = 'DAP';
            }else if(is_user_logged_in()){
                $user_id =  get_current_user_id();
                $user_type = 'WP';
            }
        }

        if(!empty($_REQUEST['action']) && $_REQUEST['is_admin'] == true){
            $user_id =  $_REQUEST['userid'];
            $user_type = $_REQUEST['source'];
        }

        $user_source = !empty($exclude_users->value) ? unserialize($exclude_users->value) : array();

        if(!empty($user_source[$user_type])){
            $userData = $user_source[$user_type];
            //$final_user_ids = array_merge($userData,$new_user_id);
            $user_source[$user_type][] = $user_id;
            
        }else{
            $user_source[$user_type] = array($user_id);
        }
        
        /*$final_user_ids = array_merge($user_ids,$new_user_id);
        $final_user_ids = array_unique($final_user_ids);*/

        $data = array('name' => 'lb_exclude_users', 'value' => serialize($user_source));
        $where = array('name' => 'lb_exclude_users');
        $wpdb->update($table_sqb_global_theme,$data,$where);

        echo json_encode(array('status' => 'ok'));exit;
        
    }else{

    }
    
    echo json_encode(array('status' => 'error'));exit;
}

function is_dap_leaderboard_login(){

    $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
    if(file_exists($lldocroot . "/dap/dap-config.php")){
        include_once ($lldocroot . "/dap/dap-config.php");
        if( Dap_Session::isLoggedIn() ) {
            $session = Dap_Session::getSession();
            $user = $session->getUser();
            return $user;
        }
    }

    return array();
}

function get_sqb_internal_users(){

    global $wpdb,$sqb_internal_users;
    $table_sqb_internal_users = $wpdb->prefix . $sqb_internal_users;

    $user_id = get_current_user_id();
    $current_user = wp_get_current_user();
    $email = $current_user->user_email;

    $sql = "SELECT id from $table_sqb_internal_users WHERE email = '".$email."'";
    $new_user_id = $wpdb->get_var($sql);

    return $new_user_id;
}


add_action("wp_ajax_sqb_load_leaderboard", "sqb_load_leaderboard");

function sqb_load_leaderboard(){

    $lb_ld = !empty($_REQUEST['lb_id']) ? $_REQUEST['lb_id'] : 0;
    
    $return = SQBLeaderboardContent(array('id' => $lb_ld,'optout' => 0));

    echo $return;exit;

}

add_filter('template_include', function ($template) {

    if(isset($_GET['lb-embed'])){
        $template = SQB_FILE.'includes/frontend/leaderboard.php';
    }
    return $template;
});