<?php

add_shortcode('SQBStudentDashboard', 'sqb_studentdashboad_content');

function sqb_studentdashboad_content($atts){
    
    if(is_admin())
        return '';

    extract(shortcode_atts(array( 
        'id' => 0,
        'title'=>''
    ), $atts));

    if(empty($id)){
        return '';
    }

    $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
    if(file_exists($lldocroot . "/dap/dap-config.php")){ 
        include_once ($lldocroot . "/dap/dap-config.php");
        if( Dap_Session::isLoggedIn() ) { 
            $session = Dap_Session::getSession();
            $user = $session->getUser();
            $user_id = $user->getId();
            $source = 'DAP';
        }else if(get_current_user_id()){
            $user_id = get_current_user_id();
            $source = 'WP';
        }
    }else if(get_current_user_id()){
        $user_id = get_current_user_id();
        $source = 'WP';
    }

    if(empty($user_id)){
        $not_loggedin = sqbGetValidSettingsByKey('not_loggedin');
        if(isset($not_loggedin) && $not_loggedin != ''){
        }else{
            $not_loggedin = '<div>Sorry you need to be logged-in to access this page. <a href="#">Click HERE</a> to login.</div>';
        }

        return stripslashes($not_loggedin);
    }

    global $wpdb;
    $sqb_member_home = $wpdb->prefix .'sqb_member_home';
    $sqb_manage_leads = $wpdb->prefix .'sqb_manage_leads';
    $sqb_global_theme = $wpdb->prefix .'sqb_global_theme';
    $sqb_quiz_template = $wpdb->prefix .'sqb_quiz_template';
    $sql = "SELECT * FROM ".$sqb_member_home." WHERE id = '".$id."'";
    $quizzes = $wpdb->get_row($sql);
    
    $template_completed_quiz = '
        <div class="completed-quiz-block first_sectio sqb-quiz-listing-single">
                        <div class="sqb-quiz-listing-inner-wrapper">
                            <div class="completed-quiz-icon ui-resizable">
                                <span class="dme_backend_show"><img src="'.plugin_dir_url(__DIR__).'/images/sqb-member-home.png"></span>
                                <span class="dme_backend_hide">%%QUIZ_IMAGE%%</span>
                            </div>
                            <div class="sqb-quiz-content ">
                                <div class="sqb_tiny_mce_editor sqb_quiz_name mce-content-body" id="mce_2" contenteditable="true" style="position: relative;" spellcheck="false"><div>%%QUIZ_TITLE%%</div></div>
                                <div class="sqb_btn_container" style="display: flex ; gap: 10px; align-items: center">
                                    <a href="%%QUIZ_URL%%" data-target="#Manage_Side_Popup_Lesson_Release_Settings"  data-quiz-id="%%QUIZ_ID%%" target="%%QUIZ_TARGET%%" class="sqb_sale_page_url sqb-member-view-quiz-result">
                                        <div class="btn access_content access_content_btn sqb_tiny_mce_editor">
                                            <div>View Result</div>
                                        </div>
                                    </a>

                                    <a href="%%QUIZ_URL_RETAKE%%" data-quiz-id="%%QUIZ_ID%%" target="_blank" class="sqb_sale_page_url sqb-member-view-quiz-result">
                                        <div class="btn access_content retake_access_content_btn sqb_tiny_mce_editor">
                                            <div>Retake</div>
                                        </div>
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
            ';
    
    $template_not_completed_quiz = '
        <div class="completed-quiz-block first_sectio sqb-quiz-listing-single">
        <div class="sqb-quiz-listing-inner-wrapper">
            <div class="completed-quiz-icon ui-resizable">
                <span class="dme_backend_show"><img src="'.plugin_dir_url(__DIR__).'/images/sqb-member-home.png"></span>
                <span class="dme_backend_hide">%%QUIZ_IMAGE%%</span>
            </div>
            <div class="sqb-quiz-content ">
                <div class="sqb_tiny_mce_editor sqb_quiz_name mce-content-body" id="mce_2" contenteditable="true" style="position: relative;" spellcheck="false"><div>%%QUIZ_TITLE%%</div></div>
                <div class="sqb_btn_container  ">
                    <a href="%%QUIZ_URL%%" data-quiz-id="%%QUIZ_ID%%" target="%%QUIZ_TARGET%%" class="sqb_sale_page_url sqb-member-view-quiz-result">
                        <div class="btn access_content access_content_btn sqb_tiny_mce_editor mce-content-body" id="mce_3" contenteditable="true" style="position: relative;" spellcheck="false"><div>View Result</div></div>
                    </a>
                </div>
            </div>
        </div>
    </div>';

   
    

    if(!empty($quizzes)){

        $options = maybe_unserialize($quizzes->options);
        $customizer_html = maybe_unserialize($quizzes->customizer_html);
        $customizer_options = maybe_unserialize($quizzes->customizer_options);
        $def_image = plugin_dir_url( __DIR__ ).'images/sqb-member-home.png';

        if(!empty($customizer_html['completed_title'])){
            $completed_title = stripslashes($customizer_html['completed_title']);
        }

        if(!empty($customizer_html['notstarted_title'])){
            $notstarted_title = stripslashes($customizer_html['notstarted_title']);
        }

        $completed_quiz_array = $customizer_options;

        if(!empty($completed_quiz_array)){
            $show_completed_quiz_array = "display:block;";
        }

        if(!empty($completed_hidden_quiz_array)){
            $show_completed_hidden_quiz_array = "display:block;";
        }

        if(!empty($not_taken_quiz_array)){
            $show_not_taken_quiz_array = "display:block;";
        }

        if(!empty($not_taken_hidden_quiz_array)){
            $show_not_taken_hidden_quiz_array = "display:block;";
        }


        /*Customizer Data*/

        $customizer_data_unserialize = $customizer_options;

        
        
        $dm_engagement_enable_certificate = 'N';
        if(!empty($customizer_data_unserialize)){
            $un_dm_engagement_temp_wid = $customizer_data_unserialize['dm_engagement_temp_wid'];
            if(!empty($un_dm_engagement_temp_wid)){
                $dm_engagement_temp_wid = $un_dm_engagement_temp_wid;
            }
            $un_dm_engagement_temp_border_width = $customizer_data_unserialize['dm_engagement_temp_border_width'];
            if(!empty($un_dm_engagement_temp_border_width)){
                $dm_engagement_temp_border_width = $un_dm_engagement_temp_border_width;
            }
            $un_dm_engagement_temp_border_radius = $customizer_data_unserialize['dm_engagement_temp_border_radius'];
            if(!empty($un_dm_engagement_temp_border_radius)){
                $dm_engagement_temp_border_radius = $un_dm_engagement_temp_border_radius;
            }
            $un_dm_engagement_temp_shadow_spread_radius = $customizer_data_unserialize['dm_engagement_temp_shadow_spread_radius'];
            if(!empty($un_dm_engagement_temp_shadow_spread_radius)){
                $dm_engagement_temp_shadow_spread_radius = $un_dm_engagement_temp_shadow_spread_radius;
            }
            $un_dm_engagement_temp_shadow_blur_radius = $customizer_data_unserialize['dm_engagement_temp_shadow_blur_radius'];
            if(!empty($un_dm_engagement_temp_shadow_blur_radius)){
                $dm_engagement_temp_shadow_blur_radius = $un_dm_engagement_temp_shadow_blur_radius;
            }
            $un_dm_engagement_temp_shadow_horizontal_length = $customizer_data_unserialize['dm_engagement_temp_shadow_horizontal_length'];
            if(!empty($un_dm_engagement_temp_shadow_horizontal_length)){
                $dm_engagement_temp_shadow_horizontal_length = $un_dm_engagement_temp_shadow_horizontal_length;
            }
            $un_dm_engagement_temp_shadow_vertical_length = $customizer_data_unserialize['dm_engagement_temp_shadow_vertical_length'];
            if(!empty($un_dm_engagement_temp_shadow_vertical_length)){
                $dm_engagement_temp_shadow_vertical_length = $un_dm_engagement_temp_shadow_vertical_length;
            }
            $un_dm_engagement_temp_left_side_background_color = $customizer_data_unserialize['dm_engagement_temp_left_side_background_color'];
            if(!empty($un_dm_engagement_temp_left_side_background_color)){
                $dm_engagement_temp_left_side_background_color = $un_dm_engagement_temp_left_side_background_color;
            }
            $un_dm_engagement_temp_border_color = $customizer_data_unserialize['dm_engagement_temp_border_color'];
            if(!empty($un_dm_engagement_temp_border_color)){
                $dm_engagement_temp_border_color = $un_dm_engagement_temp_border_color;
            }
            $un_completed_quiz_background_color = $customizer_data_unserialize['completed_quiz_background_color'];
            if(!empty($un_completed_quiz_background_color)){
                $completed_quiz_background_color = $un_completed_quiz_background_color;
            }
            $un_retake_quiz_background_color = $customizer_data_unserialize['retake_quiz_background_color'];
            if(!empty($un_retake_quiz_background_color)){
                $retake_quiz_background_color = $un_retake_quiz_background_color;
            }
            $un_not_started_background_color = $customizer_data_unserialize['not_started_background_color'];
            if(!empty($un_not_started_background_color)){
                $not_started_background_color = $un_not_started_background_color;
            }
            $un_dm_engagement_temp_aligment = $customizer_data_unserialize['dm_engagement_temp_aligment'];
            if(!empty($un_dm_engagement_temp_aligment)){
                $dm_engagement_temp_aligment = $un_dm_engagement_temp_aligment;
            }
            $un_dm_engagement_temp_border_style = $customizer_data_unserialize['dm_engagement_temp_border_style'];
            if(!empty($un_dm_engagement_temp_border_style)){
                $dm_engagement_temp_border_style = $un_dm_engagement_temp_border_style;
            }
            $un_dm_engagement_completed_image_height_type = $customizer_data_unserialize['dm_engagement_completed_image_height_type'];
            if(!empty($un_dm_engagement_completed_image_height_type)){
                $dm_engagement_completed_image_height_type = $un_dm_engagement_completed_image_height_type;
                if($dm_engagement_completed_image_height_type == "Y"){
                    $dm_engagement_completed_image_height_type_show = "display:none";
                }
            }
            $un_dm_engagement_completed_template_width = $customizer_data_unserialize['dm_engagement_completed_template_width'];
            if(!empty($un_dm_engagement_completed_template_width)){
                $dm_engagement_completed_template_width = $un_dm_engagement_completed_template_width;
                $dm_engagement_completed_template_width_val = $un_dm_engagement_completed_template_width;
            }
            $un_dm_engagement_completed_image_height = @$customizer_data_unserialize['dm_engagement_completed_image_height'];
            if(!empty($un_dm_engagement_completed_image_height)){
                $dm_engagement_completed_image_height = $un_dm_engagement_completed_image_height;
            }
            $un_dm_engagement_temp_shadow_color = $customizer_data_unserialize['dm_engagement_temp_shadow_color'];
            if(!empty($un_dm_engagement_temp_shadow_color)){
                $dm_engagement_temp_shadow_color = $un_dm_engagement_temp_shadow_color;
            }
            $un_dm_engagement_completed_template_width_in_px = @$customizer_data_unserialize['dm_engagement_completed_template_width_in_px'];
            if(!empty($un_dm_engagement_completed_template_width_in_px)){
                $dm_engagement_completed_template_width_in_px = $un_dm_engagement_completed_template_width_in_px;
                $dm_engagement_completed_template_width_val = $un_dm_engagement_completed_template_width_in_px;
            }
            $un_template_percentage_selection = $customizer_data_unserialize['template_percentage_selection'];
            if(!empty($un_template_percentage_selection)){
                $template_percentage_selection = $un_template_percentage_selection;
            }

            if($template_percentage_selection == "percentage"){
                $temp_sign = "%";
            }else{
                $temp_sign = "px";
            }

            
            if(!empty($customizer_data_unserialize['dm_engagement_enable_certificate'])){
                $dm_engagement_enable_certificate = $customizer_data_unserialize['dm_engagement_enable_certificate'];
            }

        }

        $customizer_html_unserialize = $customizer_options;
        if(!empty($customizer_html_unserialize)){
            $un_completed_html = !empty($customizer_data_unserialize['completed_html']) ? $customizer_data_unserialize['completed_html'] : '';
            if(!empty($un_completed_html)){
                $completed_html = stripslashes($un_completed_html);
            }
            $un_not_started_html = !empty($customizer_data_unserialize['not_started_html']) ? $customizer_data_unserialize['not_started_html'] : '' ;
            if(!empty($un_not_started_html)){
                $not_started_html = stripslashes($un_not_started_html);
            }
        }
        
        if(!empty($customizer_html['completed_html'])){
            $template_completed_quiz = stripslashes($customizer_html['completed_html']);
            
        }
       
        if(!empty($customizer_html['not_started_html'])){
            $template_not_completed_quiz = stripslashes($customizer_html['not_started_html']);  
        }

        $quiz_ids = array();
        $quiz_array = array();

        $c_quiz_array = array();
        $c_quiz_ids = !empty($options['completed_quiz_array']) ? $options['completed_quiz_array'] : array();
        $c_exclude_quiz_ids = !empty($options['completed_hidden_quiz_array']) ? $options['completed_hidden_quiz_array'] : array();
        $c_final_quiz_ids = array();
        if(!empty($c_quiz_ids)){
            foreach ($c_quiz_ids as $key => $c_quiz) {
                if(!in_array($c_quiz, $c_exclude_quiz_ids)){
                    $c_final_quiz_ids[] = $c_quiz;
                    $c_quiz_array[$c_quiz] = $c_quiz;
                }
            }
        }

        $n_quiz_array = array();
        $n_quiz_ids = !empty($options['not_taken_quiz_array']) ? $options['not_taken_quiz_array'] : array();
        $n_exclude_quiz_ids = !empty($options['not_taken_hidden_quiz_array']) ? $options['not_taken_hidden_quiz_array'] : array();
        $n_final_quiz_ids = array();
        if(!empty($n_quiz_ids)){
            foreach ($n_quiz_ids as $key => $n_quiz) {
                if(!in_array($n_quiz, $n_exclude_quiz_ids)){
                    $n_final_quiz_ids[] = $n_quiz;
                    $n_quiz_array[$n_quiz] = $n_quiz;
                }
            }
        }

        /*foreach ($quizzes as $key => $quizz) {
            $quiz_array[$quizz->quiz_id] = $quizz;
            $quiz_ids[] = $quizz->quiz_id;
        }*/

        $main_final_quiz_array = array_merge($c_final_quiz_ids, $n_final_quiz_ids);
  

        if(empty($main_final_quiz_array)){
            return '';
        }


        $sql_g = "SELECT * FROM ".$sqb_global_theme." WHERE quiz_id IN(".implode(',',$main_final_quiz_array).") AND name = 'student_image_and_redirect_url'";
        $global_theme = $wpdb->get_results($sql_g);
        
        $quizData = array();
        foreach($global_theme as $key => $gt){
            $quizData[$gt->quiz_id] = maybe_unserialize($gt->value);
        }

        $sql_t = "SELECT start_image,quiz_id FROM ".$sqb_quiz_template." WHERE quiz_id IN(".implode(',',$main_final_quiz_array).")";
        $start_images = $wpdb->get_results($sql_t);
       
        $all_start_images = array();
        if(!empty($start_images)){
            foreach ($start_images as $key => $start_image) {
                $all_start_images[$start_image->quiz_id] = $start_image->start_image;
            }
        }
        
        $is_dap_checked = false;
        // Completed quiz
        $completed_quizzes = array();
        if(!empty($c_final_quiz_ids)){
            $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE quiz_id IN(".implode(',',$c_final_quiz_ids).") AND user_id = '".$user_id."' AND source = '".$source."' GROUP BY quiz_id";
            $user_leads = $wpdb->get_results($sql);


            if(empty($user_leads)){
                $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
                if(file_exists($lldocroot . "/dap/dap-config.php")){ 
                    include_once ($lldocroot . "/dap/dap-config.php");
                    if( Dap_Session::isLoggedIn() ) {
                        if($source == 'DAP'){
                            $is_dap_checked = true;
                            $wuser_id = get_current_user_id();
                            $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE quiz_id IN(".implode(',',$c_final_quiz_ids).") AND user_id = '".$wuser_id."' AND source = 'WP' GROUP BY quiz_id";
                            $user_leads = $wpdb->get_results($sql);
                        }
                    }
                }
            }

            if(!empty($user_leads)){
                foreach ($user_leads as $key => $lead) {
                    $completed_quizzes[] = $c_quiz_array[$lead->quiz_id];
                }
            }
        }
        

        $wuser_leads = array();
        // Not completed Quiz
        $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE user_id = '".$user_id."' AND source = '".$source."' GROUP BY quiz_id";
        $not_completed_quizzes = array();
        $user_leads = $wpdb->get_results($sql);

        if(empty($user_leads)){
            $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
            if(file_exists($lldocroot . "/dap/dap-config.php")){ 
                include_once ($lldocroot . "/dap/dap-config.php");
                if( Dap_Session::isLoggedIn() ) {
                    if($source == 'DAP'){

                        $wuser_id = get_current_user_id();
                        $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE user_id = '".$wuser_id."' AND source = 'WP' GROUP BY quiz_id";
                        $not_completed_quizzes = array();
                        $user_leads = $wpdb->get_results($sql);

                    }
                }
            }
        }else{

            if($is_dap_checked){

                $wuser_id = get_current_user_id();
                $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE user_id = '".$wuser_id."' AND source = 'WP' GROUP BY quiz_id";
                $wuser_leads = $wpdb->get_results($sql);
               
            }

        }

        $quiz_nc_ids = array();
        if(!empty($user_leads)){
            
            foreach($user_leads as $quiz){
                $quiz_nc_ids[] = $quiz->quiz_id;
            }
        }


        if(!empty($wuser_leads)){
            
            foreach($wuser_leads as $quiz){
                $quiz_nc_ids[] = $quiz->quiz_id;
            }
        }

        foreach($n_quiz_ids as $qid){
            if(!in_array($qid,$quiz_nc_ids)){
                $not_completed_quizzes[] = $n_quiz_array[$qid];
            }
        }
        $assets_version = '1.0.2';
        wp_enqueue_script("sqb_member_frontend",SQB_URL.'includes/js/sqb_member_frontend.js', array('jquery'), $assets_version);
        wp_localize_script( 'sqb_member_frontend', 'sqbMember', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));  

        wp_enqueue_style("sqb_member_frontend",SQB_URL.'includes/css/sqb_member_frontend.css', false,$assets_version );

        $height_auto_cls = ($dm_engagement_completed_image_height_type == 'Y') ? 'image-height-auto' : '';

        if(empty(@$dm_engagement_temp_left_side_background_color) || @$dm_engagement_temp_left_side_background_color == 'false'){
            $nobackground_clsas = 'sqb-sd-nobackground';
        }else{
            $nobackground_clsas = '';
        }

        $main = '
        <div class="sqb_member_engagement-inner sqb_member_engagement_full_width_temp '.$height_auto_cls.' '.$nobackground_clsas.'" id="sqb_member_dashboard_'.$id.'" data-certificate="'.$dm_engagement_enable_certificate.'">
            <div class="sqb_member_engagement-left sqb_member_drap_drop_parent_class">
        ';
        $main_completed_quiz = '';
        if(!empty($completed_quizzes)){
            $main_completed_quiz = '
                <div class="sqb_m_engagement-card sqb_m_engagement-inner-item sqb_member_template_drag_drop_item sqb_member_temp_quiz_completed_section">';

            $main_completed_quiz.= '
                <div class="completed-quiz-title sqb_m_title_outer  quiz-section-heading-wrapper">
                    '.$completed_title.'
                </div>
                ';
            $main_completed_quiz .= '<div class="completed-quizs-list sqb-quiz-listing verticle_temp quiz-per-row-3" id="quiz_completed_section">';
            
            foreach ($completed_quizzes as $key => $quiz) {
                
                $quiz_id = $quiz;
                $sqbObj =  SQB_Quiz::loadById($quiz_id); 

                if(!empty($sqbObj)){
                    $quiz_title =  $sqbObj->getQuizName();

                    $allow_retake_option = $sqbObj->getAllowRetake();


                    $quiz_url_retake = !empty($quizData[$quiz_id]['redirect_url']) ? $quizData[$quiz_id]['redirect_url'] : '#';
                    $image = !empty($all_start_images[$quiz_id]) ? $all_start_images[$quiz_id] : $def_image;
                    $image = !empty($quizData[$quiz_id]['image']) ? $quizData[$quiz_id]['image'] : $image;
                    $template_completed_quiz1 = str_replace('%%QUIZ_TITLE%%',$quiz_title,$template_completed_quiz);
                    $template_completed_quiz1 = str_replace('%%QUIZ_IMAGE%%','<img src="'.$image.'" />',$template_completed_quiz1);
                    $template_completed_quiz1 = str_replace('%%QUIZ_URL_RETAKE%%',$quiz_url_retake,$template_completed_quiz1);
                    $template_completed_quiz1 = str_replace('%%quiz_button%%',$quiz_title,$template_completed_quiz1);
                    $template_completed_quiz1 = str_replace('%%QUIZ_ID%%',$quiz_id,$template_completed_quiz1);
                    $template_completed_quiz1 = str_replace('%%QUIZ_URL%%','javascript:void(0);',$template_completed_quiz1);
                    $template_completed_quiz1 = str_replace('%%QUIZ_TARGET%%','',$template_completed_quiz1);
                    if($allow_retake_option == "Y"){
                        $template_completed_quiz1 = str_replace('%%is_retake%%','',$template_completed_quiz1);
                    }else{
                        $template_completed_quiz1 = str_replace('%%is_retake%%','display:none;',$template_completed_quiz1);
                    }

                    $main_completed_quiz .= '<div class="completed-quiz-block first_sectio sqb-quiz-listing-single">'.$template_completed_quiz1.'</div>';
                }
            }

            $main_completed_quiz .= '</div></div>';
        }
        
        $main_not_completed_quiz = '';
    
        $seperator = '';
        if(!empty($not_completed_quizzes) && !empty($completed_quizzes)){
            $seperator .= '<div class="sqb-member-separator"></div>';
        }

        if(!empty($not_completed_quizzes)){
           
            $main_not_completed_quiz = '
                <div class="sqb_m_engagement-card sqb_m_engagement-inner-item sqb_member_template_drag_drop_item sqb_member_temp_quiz_not_started_section">';

            $main_not_completed_quiz.= '
                <div class="not-started-title sqb_m_title_outer  quiz-section-heading-wrapper">
                    '.$notstarted_title.'
                </div>
                    ';
            $main_not_completed_quiz .= '<div class="not-started-quizs-list sqb-quiz-listing verticle_temp quiz-per-row-3" id="quiz_not_started_section">';
        
            foreach ($not_completed_quizzes as $key => $quiz) {
                
                $quiz_id = $quiz;
                $sqbObj =  SQB_Quiz::loadById($quiz_id); 
               
                if(!empty($sqbObj)){
                    $quiz_title =  $sqbObj->getQuizName();
                    $image = !empty($all_start_images[$quiz_id]) ? $all_start_images[$quiz_id] : $def_image;
                    $image = !empty($quizData[$quiz_id]['image']) ? $quizData[$quiz_id]['image'] : $image;
                    $quiz_url = !empty($quizData[$quiz_id]['redirect_url']) ? $quizData[$quiz_id]['redirect_url'] : '#';
                    $template_not_completed_quiz1 = str_replace('%%QUIZ_TITLE%%',$quiz_title,$template_not_completed_quiz);
                    $template_not_completed_quiz1 = str_replace('%%QUIZ_IMAGE%%','<img src="'.$image.'" />',$template_not_completed_quiz1);
                    $template_not_completed_quiz1 = str_replace('%%QUIZ_URL%%',$quiz_url,$template_not_completed_quiz1);
                    $template_not_completed_quiz1 = str_replace('%%quiz_button%%',$quiz_title,$template_not_completed_quiz1);
                    $template_not_completed_quiz1 = str_replace('%%QUIZ_ID%%',$quiz_id,$template_not_completed_quiz1);
                    $template_not_completed_quiz1 = str_replace('%%QUIZ_TARGET%%','',$template_not_completed_quiz1);
                    $main_not_completed_quiz .= '<div class="not-started-quiz-block first_sectio sqb-quiz-listing-single">'.$template_not_completed_quiz1.'</div>';
                }
            }
            $main_not_completed_quiz .= '</div></div>';
        }
    }else{

    }

    //$main_not_completed_quiz .= '</div></div>';
    
    $view_result_html = "

        <style>
        :root{
            --dm-engagement-temp-wid: ".@$dm_engagement_temp_wid."px;
            --dm-engagement-temp-border-width: ".@$dm_engagement_temp_border_width."px;
            --dm-engagement-temp-border-radius: ".@$dm_engagement_temp_border_radius."px;
            --dm-engagement-temp-shadow-spread-radius: ".@$dm_engagement_temp_shadow_spread_radius."px;
            --dm-engagement-temp-shadow-blur-radius: ".@$dm_engagement_temp_shadow_blur_radius."px;
            --dm-engagement-temp-shadow-horizontal-length: ".@$dm_engagement_temp_shadow_horizontal_length."px;
            --dm-engagement-temp-shadow-vertical-length: ".@$dm_engagement_temp_shadow_vertical_length."px;
            --dm-engagement-temp-left-side-background-color: ".$dm_engagement_temp_left_side_background_color.";
            --dm-engagement-temp-border-color: ".$dm_engagement_temp_border_color.";
            --completed-quiz-background-color: ".$completed_quiz_background_color.";
            --retake-quiz-background-color: ".$retake_quiz_background_color.";
            --not-started-background: ".$not_started_background_color.";
            --dm-engagement-temp-aligment:  ".$dm_engagement_temp_aligment.";
            --dm-engagement-temp-border-style: ".$dm_engagement_temp_border_style.";
            --dm-engagement-completed-image-height: ".@$dm_engagement_completed_image_height."px;
            --dm-engagement-completed-template-width: ".$dm_engagement_completed_template_width."".$temp_sign.";
            --dm-engagement_temp-shadow-color: ".$dm_engagement_temp_shadow_color.";
        }
        </style>
    ";

    $quiz_details = sqbGetValidSettingsByKey('quiz_details');
            if(isset($quiz_details) && $quiz_details != ''){
                
            }else{
                $quiz_details = 'Quiz Detail';
            }
$view_result_html .= '
        <div class="Manage_Side_Popup_ErrorPage active_Side_Popup1 sqb_sidebar_popup sqb-view-result-popup" id="Manage_Side_Popup_Lesson_Release_Settings" style="display: none;">
        <div class="sqb_sidebar_popup-inner">
            <a href="#" class="close_Side_Popup"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"/></svg></a>
            <h2>'.$quiz_details.'</h2>
            <div class="sqb-center-loader-popup"><span class="sqb-quiz-detail-loader"> </span></div>
            <div class="sqb_sidebar_popup_content edit-member-wrapper">
            
            </div>
        </div>
    </div>';


    // Certificate List
    $sql = "SELECT * FROM ".$sqb_manage_leads." WHERE user_id = '".$user_id."' AND source = '".$source."' and certificate_id <> 0 GROUP BY quiz_id";
    $user_leads = $wpdb->get_results($sql);
    
    $main_certificate_html = '
                <div class="sqb_m_engagement-card sqb_m_engagement-inner-item sqb_member_template_drag_drop_item sqb_member_temp_quiz_not_started_section">';

    $main_certificate_html.= '
        <div class="not-started-title sqb_m_title_outer  quiz-section-heading-wrapper">
            <h3 class="sqb_m_engagement-card-title ">
                <div class="sqb_tiny_mce_editor completed-quiz-data mce-content-body" id="mce_0" style="position: relative;" spellcheck="false">
                    <div>'.$notstarted_title.'</div>
                </div>
            </h3>
        </div>
            ';
    $main_certificate_html .= '<div class="not-started-quizs-list sqb-quiz-listing verticle_temp quiz-per-row-3" id="quiz_not_started_section">';

    $certificate_html = '
    <div class="sqb-quiz-listing-inner-wrapper" bis_skin_checked="1">
        <div class="completed-quiz-icon ui-resizable" bis_skin_checked="1">
            <span class="dme_backend_show"><img src="https://demo.membershipsitechallenge.com/wp-content/plugins/smartquizbuilder/includes//images/sqb-member-home.png"></span>
            <span class="dme_backend_hide">%%QUIZ_IMAGE%%</span>
        </div>
        <div class="sqb-quiz-content " bis_skin_checked="1">
            <div class="sqb_tiny_mce_editor sqb_quiz_name mce-content-body" id="mce_2" bis_skin_checked="1" contenteditable="true" spellcheck="false" style="position: relative;"><div bis_skin_checked="1">%%QUIZ_TITLE%%</div></div>
            <div class="sqb_btn_container  " bis_skin_checked="1">
                <a href="javascript:void(0);" data-quiz-id="%%QUIZ_ID%%" data-lead-id="%%LEAD_ID%%" class="sqb_sale_page_url download-certificate-pdf">
                    <div class="btn access_content access_content_btn sqb_tiny_mce_editor mce-content-body" id="mce_3" bis_skin_checked="1" contenteditable="true" spellcheck="false" style="position: relative;"><div bis_skin_checked="1">Download Certificate</div></div>
                </a>
            </div>
        </div>
    </div>              ';

    //$certificate_html = '<div><p>%%user_id%%</p><p>%%CERTIFICATE_BUTTON%%</p></div>';
    $certificate_final_html = '';
    if(!empty($user_leads)){
        foreach ($user_leads as $key => $lead) {

            $certificate = SQB_QuizCertificate::loadById($lead->certificate_id);
            $quiz = SQB_Quiz::loadById($lead->quiz_id);

            $quiz_title = '';
            if(!empty($quiz)){
                $quiz_title = $quiz->getQuizName();
            }

            if(!empty($certificate)){
                $certificate_html1 = str_replace('%%CERTIFICATE_BUTTON%%','<a href="javascript:void();" class="download-certificate-pdf">Download</a>',$certificate_html);
                $certificate_html1 = str_replace('%%QUIZ_IMAGE%%','',$certificate_html1);
                $certificate_html1 = str_replace('%%QUIZ_TITLE%%',$quiz_title,$certificate_html1);
                $certificate_html1 = str_replace('%%QUIZ_ID%%',$lead->quiz_id,$certificate_html1);
                $certificate_html1 = str_replace('%%LEAD_ID%%',$lead->id,$certificate_html1);
                $certificate_final_html .= $certificate_html1;
            }
        }
        $main_certificate_html .= $certificate_final_html;
    }

    $main_certificate_html .= '</div></div>';
    $main_close = '</div></div>';

    $html = $main.$main_completed_quiz.$seperator.$main_not_completed_quiz.$main_close.$view_result_html;

    $html = str_replace('contenteditable="true"','',$html);

    return stripslashes($html);
}

add_action("wp_ajax_sqb_certificate_pdf", "sqb_certificate_pdf");

function sqb_certificate_pdf(){
    
}

add_action("wp_ajax_sqb_view_quiz_result", "sqb_view_quiz_result");
add_action("wp_ajax_nopriv_sqb_view_quiz_result", "sqb_view_quiz_result");

function sqb_view_quiz_result(){

    
    //if(isset($_REQUEST['is-frontend'])){
        $quiz_is_frontend = false;
        if (isset($_REQUEST['is_frontend']) && $_REQUEST['is_frontend'] == true) {
            $quiz_is_frontend = true;
        }
        $txt_quiz_details = sqbGetValidSettingsByKey('quiz_details');
        if(isset($txt_quiz_details) && $txt_quiz_details != ''){
            
        }else{
            $txt_quiz_details = 'Quiz Detail';
        }

        $txt_user_details = sqbGetValidSettingsByKey('user_details');
        if(isset($txt_user_details) && $txt_user_details != ''){
            
        }else{
            $txt_user_details = 'User Details';
        }

        $sqb_name = sqbGetValidSettingsByKey('sqb_name');
        if(isset($sqb_name) && $sqb_name != ''){
            
        }else{
            $sqb_name = 'Name';
        }

        $sqb_email = sqbGetValidSettingsByKey('sqb_email');
        if(isset($sqb_email) && $sqb_email != ''){
            
        }else{
            $sqb_email = 'Email';
        }

        $txt_sqb_quiz_name = sqbGetValidSettingsByKey('sqb_quiz_name');
        if(isset($txt_sqb_quiz_name) && $txt_sqb_quiz_name != ''){
            
        }else{
            $txt_sqb_quiz_name = 'Quiz Name';
        }

        $txt_sqb_quiz_type = sqbGetValidSettingsByKey('sqb_quiz_type');
        if(isset($txt_sqb_quiz_type) && $txt_sqb_quiz_type != ''){
            
        }else{
            $txt_sqb_quiz_type = 'Quiz Type';
        }

        $txt_sqb_date = sqbGetValidSettingsByKey('sqb_date');
        if(isset($txt_sqb_date) && $txt_sqb_date != ''){
            
        }else{
            $txt_sqb_date = 'Date';
        }

        $txt_retake_count = sqbGetValidSettingsByKey('retake_count');
        if(isset($txt_retake_count) && $txt_retake_count != ''){
            
        }else{
            $txt_retake_count = 'Retake Count';
        }

        $txt_time_spent = sqbGetValidSettingsByKey('time_spent');
        if(isset($txt_time_spent) && $txt_time_spent != ''){
            
        }else{
            $txt_time_spent = 'Time Spent';
        }

        $txt_gdpr_terms = sqbGetValidSettingsByKey('gdpr_terms');
        if(isset($txt_gdpr_terms) && $txt_gdpr_terms != ''){
            
        }else{
            $txt_gdpr_terms = 'GDPR Terms';
        }

        $txt_quiz_result = sqbGetValidSettingsByKey('quiz_result');
        if(isset($txt_quiz_result) && $txt_quiz_result != ''){
            
        }else{
            $txt_quiz_result = 'Quiz Result';
        }

        $txt_sqb_outcome = sqbGetValidSettingsByKey('sqb_outcome');
        if(isset($txt_sqb_outcome) && $txt_sqb_outcome != ''){
            
        }else{
            $txt_sqb_outcome = 'Outcome';
        }

        $txt_sqb_certificate = sqbGetValidSettingsByKey('sqb_certificate');
        if(isset($txt_sqb_certificate) && $txt_sqb_certificate != ''){
            
        }else{
            $txt_sqb_certificate = 'Certificate';
        }

    /*}else{
        $txt_quiz_details = 'Quiz Detail';
        $txt_user_details = 'User Details';
        $txt_sqb_quiz_name = 'Quiz Name';
        $txt_sqb_quiz_type = 'Quiz Type';
        $txt_sqb_date = 'Date';
        $txt_retake_count = 'Retake Count';
        $txt_time_spent = 'Time Spent';
        $txt_gdpr_terms = 'GDPR Terms';
        $txt_quiz_result = 'Quiz Result';
        $txt_sqb_outcome = 'Outcome';
    }*/

    //$user_id = get_current_user_id();

    $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
    if(file_exists($lldocroot . "/dap/dap-config.php")){ 
        include_once ($lldocroot . "/dap/dap-config.php");
        if( Dap_Session::isLoggedIn() ) { 
            $session = Dap_Session::getSession();
            $user = $session->getUser();
            $user_id = $user->getId();
            $source = 'DAP';
        }else if(get_current_user_id()){
            $user_id = get_current_user_id();
            $source = 'WP';
        }
    }else if(get_current_user_id()){
        $user_id = get_current_user_id();
        $source = 'WP';
    }

    $quiz_id = $_POST['quiz_id'];

    $quizObjArray = SQB_ManageLeads::loadByUserIdAndQuizAndBySource($quiz_id,$user_id,$source);
  
    if(empty($quizObjArray)){
        $lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
        if(file_exists($lldocroot . "/dap/dap-config.php")){ 
            include_once ($lldocroot . "/dap/dap-config.php");
            if( Dap_Session::isLoggedIn() ) {
                if($source == 'DAP'){
                    $user_id = get_current_user_id();
                    $quizObjArray = SQB_ManageLeads::loadByUserIdAndQuizAndBySource($quiz_id,$user_id,'WP');
                    
                    
                }
            }
        }
    }

    ob_start();
    if(!empty($quizObjArray)){
        ?>
        <div class="quiz-data-content">
        <div class="acc-container">
        
        <?php


        foreach ($quizObjArray as $key => $lead) {
            
            
            $manage_leads_id = $lead->id;
            $date = $lead->date;
            $userDetail = SQB_UserQuizDetails::loadByUserIdAndQuizIdDate($user_id,$quiz_id,$date);
            $quiz_id = $lead->quiz_id;
            $quiz_data = SQB_Quiz::loadById($quiz_id);
            $source = $lead->getSource();
            $course_id = $lead->getCourseId();
            $user_source = $lead->getUserSource();
            $certificate_id = $lead->getCertificateId();

            if(empty($quiz_data)) continue;

           $quiz_name = $quiz_data->getQuizName();
           
           ?>
           <div class="acc">
            <div class="acc-head">
            <p><span class="scp-leaderboard-span-main"><span class="scp-leaderboard-span-inner"><?php echo $quiz_name; ?></span> <span class="sqb-acc-date"><?php echo $date; ?></span></span></p>
            </div>
            <div class="acc-content">
           <div class="quiz-data-single">
           

            <?php /*<div class="Side_Popup_card_outer" bis_skin_checked="1"> 
                <div class="Side_Popup_card" bis_skin_checked="1">
                    <h4 class="full_wid small_heading">Quiz Details </h4>
                </div>
                <div class="Side_Popup_card quiz-info-div" bis_skin_checked="1">
                    <label>Quiz Name: </label>
                    <p><?php echo $quiz_name; ?></p>
                </div>
                <div class="Side_Popup_card quiz-info-div" bis_skin_checked="1">
                    <label>Date: </label>
                    <p class="capitalize_text"><?php echo $quiz_data->getDate(); ?></p>
                </div>
            </div> */ ?>


           <?php
           $index = 1;

            $quiz_type = $quiz_data->getQuizType();
            $ques_ans_data =  getQuestionsByQuizIdByDate($user_id, $quiz_id,$date, $quiz_type, $name);

            $user_custom_fields_data = SQB_UserCustomFields::loadByUserIdQuizIdManageLeadsId($user_id,$quiz_id,$manage_leads_id);
            $custom_user_data = '';

            $user_name='';
            if($lead->getUsername() != ''){
                $user_name = $lead->getUsername();
            }

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
            
            if(isset($user_custom_fields_data) && !empty($user_custom_fields_data)) {
                $custom_user_data = '<div class="Side_Popup_card_outer">'; 
                
                $i=1;
                
                foreach($user_custom_fields_data as $user_custom_fields){
                    
                    $fields_name = explode('_',$user_custom_fields->getName());
                    $custom_field = $fields_name[1];
                    $field_name_obj = SQB_CustomFields::loadByName($custom_field);
                    
                    $custom_fields_label = '';
                    if(isset($field_name_obj)){
                     $custom_fields_label = $field_name_obj->getLabel();
                    }
                    
                    $heading_user_custom_fields_data  = '';
                    if($i == 1){
                    $heading_user_custom_fields_data = '<h4 class="full_wid small_heading">User Custom fields data </h4> ';
                    }
                    
                    $custom_user_data .= '<div class="Side_Popup_card">
                            '.$heading_user_custom_fields_data.'
                            <label>'.$custom_fields_label.'</label><p>'.$user_custom_fields->getValue().'</p>
                        </div>';
                    $i++;
                }
                $custom_user_data.='</div>'; 
            }

            $gdpr_req = $lead->getGDPROptedIn();
            $shown_outcome = $lead->getShownOutcome();
            $outcome = $lead->getOutcome(); 
            $outcomeObj = SQB_Outcome::loadById($outcome);
            if(isset($outcomeObj) && !empty($outcomeObj)){
                $outcome_name = stripslashes($outcomeObj->getOutcomeName());
            }

            if($gdpr_req == 'Y'){
                $gdpr_value = 'Accepted';
            }else{
                $gdpr_value = 'Declined';
            }

            $total_htlm = getQuestionsTotalInfoByQuizIdByDate($user_id, $quiz_id ,$date,$quiz_type, $quiz_is_frontend);
            $retake_count = getQuizRetakeCountByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type);
            $time = getQuizTimeSpentByQuizIdUserID($user_id, $quiz_id, $date,$quiz_type);               
            $minutes = floor($time / 60);
            $time -= $minutes * 60;
            $seconds = floor($time);
            $time -= $seconds;
            $time_spent = $minutes.'m '.$seconds.'s'; 

            if($retake_count > 0){
                $time_spent_html = '
                <div class="Side_Popup_card"  style="'.$allow_retake_display.'">
                <label>'.$txt_retake_count.'  </label>
                <p class="capitalize_text">'.$retake_count.'</p>
                </div>';
            }else{
                $time_spent_html = '';
            }

            if($minutes > 0 || $seconds > 0){
                $time_spent_html = '
                <div class="Side_Popup_card" style="'.$timer_enable_display.'">
                <label>'.$txt_time_spent.'  </label>
                <p class="capitalize_text">'.$time_spent.' </p>
                </div>';
            }else{
                $time_spent_html = '';
            }
            
            $quiz_details = sqbGetValidSettingsByKey('quiz_details');
            if(isset($quiz_details) && $quiz_details != ''){
                
            }else{
                $quiz_details = 'Quiz Detail';
            }
            $htmldata = ' <div class="Side_Popup_card">
                <h4 class="full_wid small_heading">'.$quiz_details.'</h4>
                <label>'.$txt_sqb_quiz_name.'  </label>
                <p>'.$quiz_name.'</p>
            </div>
            
            <div class="Side_Popup_card">
                <label>'.$txt_sqb_date.'  </label>
                <p class="capitalize_text">'.$date.'</p>
            </div>
            '.$retake_count_html.'
            '.$time_spent_html.'
            </div><div class="Side_Popup_card_outer"> 
            <div class="Side_Popup_card">
                <h4 class="full_wid small_heading">'.$txt_quiz_result.' </h4> 
                <label>'.$txt_sqb_outcome.' </label> 
                <p>'.$outcome_name.'</p>
                '.$total_htlm.'
            </div></div>';

            $certificate_btn = '';
            if(!empty($_REQUEST['certificate_status']) && $_REQUEST['certificate_status'] == 'Y'){
                $certificate = SQB_QuizCertificate::loadById($certificate_id);

                if(!empty($certificate) && $certificate->getStatus() == 'Y'){
                    $downloadCertificateHtml = sqbGetValidSettingsByKey('download_certificate_button_html');

                    if(empty($downloadCertificateHtml)){
                        $downloadCertificateHtml = '<div class="download-certificate-pdf sqb_download_certificate_btn sqb_tiny_mce_editor"  data-quiz-id="%%QUIZ_ID%%" data-lead-id="%%LEAD_ID%%" style="display: inline-block;border-radius: 5px;background: #f29341;color: #ffffff;height: auto;padding: 12px 15px;font-family: \'DM Sans\', sans-serif;min-width: 210px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;width: 100px;max-width: 100%;cursor: pointer;float: none;position: relative;"><div>Download Certificate</div></div>';
                    }

                    $downloadCertificateHtml = str_replace('%%QUIZ_ID%%',$quiz_id,$downloadCertificateHtml);
                    $downloadCertificateHtml = str_replace('%%LEAD_ID%%',$manage_leads_id,$downloadCertificateHtml);

                    $downloadCertificateHtml = stripslashes($downloadCertificateHtml);
                    $downloadCertificateHtml = str_replace('contenteditable="true"','',$downloadCertificateHtml);
                    
                    $certificate_btn = '
                    <div class="Side_Popup_card">
                        <label >'.$txt_sqb_certificate.'  </label>
                        <p class="user_email1">
                            '.$downloadCertificateHtml.'
                    </p>
                </div>
                    ';
                }
            }
            $course_details = '';
            $userdata = '<div class="Side_Popup_card_outer"> <div class="Side_Popup_card">
                <h4 class="full_wid small_heading">'.$txt_user_details.' </h4>
                <label>'.$sqb_name.'   </label>
                <p class="user_name1">'.$name.'</p>
            </div>  
            <div class="Side_Popup_card">
                    <label >'.$sqb_email.'  </label>
                    <p class="user_email1">'.$email.'</p>
            </div>

            '.$certificate_btn.'

            '.$course_details.'
            </div>
            '.$custom_user_data.'
            <div class="Side_Popup_card_outer"> 
            <!--div class="Side_Popup_card">
            <label style="margin-top: 10px;">Select a Quiz </label>
            <div class="dropdown dropdown-custom-style dropdown-overflow">
                <button class="dropdown-toggle" type="button" id="share_select_quiz" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-value="'.@$qid.'">'.$quiz_name.'</button>
                <div class="dropdown-menu share_select_quiz_list" aria-labelledby="SelectQuizNo">
                </div>
            </div></div-->';

           $output = stripslashes($userdata.$htmldata.$ques_ans_data);
           echo $output;

           ?>
           </div>
           </div>
        </div>
           <?php
        }
        ?>
        </div>
    </div>
        <?php
    }
   echo ob_get_clean();
   exit;
}