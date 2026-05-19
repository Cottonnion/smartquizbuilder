(function($) {
    $.fn.smartquizbuilder = function( options ) {
        var img = new Image();
        var canvas_pie_chart;
        var canvas_question_answer_chart;
        var chart_heading;
        var $this = $(this);
        var $_self = this;
        var wrapper = $this.attr('id');
        var $start_outer = $this.find('.quiz_start_template_outer');
        var QfirstName = '';
        if($this.hasClass('popup_popup_sqb')){
           $start_outer = jQuery('#start_'+wrapper);
        }
        var $quesans_outer = $this.find('.quiz_quesans_template_outer');
        var $optin_outer = $this.find('.quiz_optin_template_outer');
        var $outcome_outer = $this.find('.quiz_result_template_outer');
        var $analyzing_outer = $this.find('.quiz_analyzing_template_outer');
        
        var $fn_outer = $this.find('.quiz_firstname_template_outer');
        var $next_btn = $this.find('.single_next_btn_container .single_next_btn');
        var $start_btn = $start_outer.find('.take-quiz-btn');
        var $close_pop_btn = $this.find('.close_Side_Popup');
        var $optin_btn = $optin_outer.find('.continue_btn');
        var $optin_btn_html = $optin_outer.find('.continue_btn').html();
        var $answerItem = $this.find('.question_add_answer_outer_div .sqb_ans_item_outer');
        var $answerSingle = $this.find('.sqb_quiz_container .single_cls');

        var quiz_id = $this.find('#quiz_id').val();
        var quiz_type = $this.find('#sqb_quiz_type').val();
        var quiz_display = $this.find('#quiz_display').val();
        var show_start_screen = $this.find('#show_start_screen').val();
        var opt_screen_position = $this.find('#sqb_opt_screen_position').val();
        var opt_screen_automation = $this.find('#sqb_fire_optin_automation').val();
        var show_optin = $this.find('#show_optin').val();
        var show_next_button = $this.find('#show_next_button').val();
        var correct_ans_opt = $this.find('#display_correctans_options').val();
        var home_url = $this.find('#get_home_url').val();
        var template = $this.find('#template_num').val();
        var anim_effect = $this.find('.save-animation-effect').val();
        var slider_animation = $this.find('#quiz_slider_animation').val();
        var slider_animation_option = $this.find('#quiz_slider_animation_option').val();
        var show_fname_temp = $this.find('#show_firstname_temp').val();
        var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
        var auto_submit_optin = $this.find("#auto_submit_optin").val();
        var show_result_screen = $this.find("#show_result_screen").val();
        var show_firstname_outcome = $this.find("#show_firstname_outcome").val();
        var social_share_screen_value = $this.find("#social_share_screen_value").val();
        var quiz_pagination = $this.find('#quiz_pagination').val();
        var same_page_option = $this.find('#same_page_option').val();
        var current_page_id = $this.find("input[type='hidden'][id='sqb_quiz_current_page_id']").val();
        var enable_branching_quiz = $this.find('#sqb_quiz_builder').hasClass('enable_branching_quiz');
        var recommendation_option = $this.find('#quiz_recommendation_option').val();
        var show_analyzing_result = $this.find('#show_analyzing_result').val();
        var quick_email_verification = $this.find('#quick_email_verification').val();
        var allow_retake = $this.find('#allow_retake_new').val();
        var third_party = $this.find("#third_party_from_enabled").val();
        var required_field = $this.find("#sqb_required_field").val();
        var gdpr_required_field = $this.find("#sqb_gdpr_required_field").val();
        var gdpr_value = $this.find('#gdpr_compliance').val();
        var register_way = $this.find('#register_way').val();   
        var productId = $this.find(' #sqb_direct_signup #productId').val(); 
        var ajaxurl = $this.find('#sqb_ajaxurl').val(); 
        var optin_redirect = $this.find('#optin_redirect').val();   
        var optin_redirect_url = $this.find('#optin_redirect_url').val();   
        var outcome_final = $this.find('#outcome_final').val();     
        var email_empty_msg = $this.find('#email_empty_msg').val();         
        var valid_email =$this.find('#valid_email').val();          
        var username_empty_msg = $this.find('#username_empty_msg').val();           
        var terms_condition_msg = $this.find('#terms_condition_msg').val();         
        var terms_condition_req = $this.find('#sqb_direct_signup #sqbcheckbox').hasClass('required');   
        var first_name_visi = $optin_outer.find('input[name="first_name"]').css('display');
        var terms_cond_visi = $this.find('#sqb_direct_signup .sqb-checkbox').css('display');    
        var signup_way = $this.find('#signup_way').val();   
        var ori_text = $this.find('#sqb_quiz_builder  .Quiz-Optin-Template  .continue_btn').html();
        var optin_name = $this.find("#optin_name").val();
        var optin_email = $this.find("#optin_email").val();
        var sqb_save_report = $this.find('#sqb_save_report').val();
        var site_url = $this.find("#get_site_url").val();
        var user_id =  $this.find('#user_id').val();
        var show_back_button_change = $this.find('#show_back_button_change').val();
        var category_per =  $this.find('#sqb_quiz_category_per').val();
        var $optin_html = $optin_outer.html();
        var $outcome_html = $outcome_outer.html();
        var $quesans_html = $quesans_outer.html();
        // Lesson
        var lesson_id = $this.find('#lesson_id').val();
        var course_id = $this.find('#course_id').val();
        var course_type = $this.find('#course_type').val();
        var count_manage_lead_data = $this.find('#count_manage_lead_data').val();   

        var video_autoplay = $this.find('#interactive_video_autoplay').val();
        var video_umute_text = $this.find('#video_umute_text').val();
        var click_to_unmute = $this.find('#click_to_unmute').val();
        
        var certificate_id = $this.find('#certificate_id').val();
        // Global Variables
        var ques_ans_data = [];
        var outcome_ids_array = [];
        var outcome_ques_ids_array = [];
        var outcome_ids_points_array = [];
        var merge_tags = [];
        var fun_animation_main_clone = '';
        var cat_ids = {};
        var cat_ids_val = {};
        var eachcat_ids = {};
        var newcatarraylow = {};
        var newcatarrayhigh = {};

        var oc_id = 0; // Outcome id
        var iti = {};
        var itis;
        var cat_chart = {};
        cat_chart['labels'] = [];
        cat_chart['data'] = [];
        cat_chart['labels_spider'] = [];
        cat_chart['data_spider'] = [];
        var questions_points = {};
        var final_outcome = 0;
        var quizResponse = {};
        var outcome_anslist = [];
        var $corr_qa = {};
        var sqb_tw_timer = '';
        var  quiz_processed = false;
        var skip_optin = false;
        var lead_id = 0;
        var localReport = {};
        var is_loaded = false;
        var sqb_custom_event = {};
        var pageViewed = ["1"]; 
        var skipped_question = [];

        var prevQuestions = [];
        var prevQuestionsAns = {};

        var sqb_form_type_redirect_url = $this.find('#sqb_form_type_redirect_url').val();

        this.init = function(){
            
            this.beforeLoad();
            this.setDropdownCompablity();
            this.sqb_hideloader();
            $this.show();
            this.setNextButton();
            this.setBackButton();
            this.initThirdPartyPlugin();
            this.bindButtonEvent();
            this.setFirstScreen('N');
            this.initPopup();
            this.customFieldsAutoPopulate();
            this.coreFieldsAutoPopulate();
            this.setStyle();
            this.dapProcess();
            //this.dapLesson();

            if(this.isQuiz('poll')){
                this.renderPollResults();
            }

            this.saveReport('quiz_page_visit');
        };


        this.setDropdownCompablity = function() {
            try {

                all_custom_fields.forEach(function(field) {
                    if (
                        field &&
                        field.field_type === 'dropdown' &&
                        String(field.selected_country).toLowerCase() === 'y'
                    ) {
                        const fieldName = 'custom_' + field.name;
                        const $select = jQuery('[name="' + fieldName + '"]');

                        if ($select.length && $select.is('select')) {
                            $select.find('option').first().val('');
                        }
                    }
                });
            } catch (error) {
                console.error('Error in setDropdownCompablity:', error);
            }
        }


        this.beforeLoad = function(){

            if($this.hasClass('popup_popup_sqb')){
                jQuery('#'+$this.attr('id')).appendTo('body');
            }

            if(lesson_id > 0){
                jQuery('.custom-header-dap-course').addClass('dap-disable-scrollbar');
            }

            if(jQuery('body').find('.wrapper:first').length > 0){
                jQuery('body').find('.wrapper:first').addClass('sqb-quiz-wrapper');
            }

            var gdpr_value = $this.find('#gdpr_compliance').val();
            if(gdpr_value == 0){
                $this.find('.sqb-gdpr-checkbox').hide();
            }

            if (jQuery('#already_given_quiz_status').val() == 1) {
            
                if (typeof scp_on_complete_quiz === "function") {
                    var total_points = jQuery('#scp_total_points').val() || 0;
                    var points_scored = jQuery('#scp_points_scored').val() || 0;
                    var total_question = jQuery('#scp_total_question').val() || 0;
                    var correct_question = jQuery('#scp_correct_question').val() || 0;
                    scp_on_complete_quiz(quiz_id, quiz_type, total_question, correct_question, total_points, points_scored);
                }
            }
        }
        
        this.dapScreen = function(){
            var sqb_quiz_container_outer_id =  $this.attr('id');
            
            var leads_total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val(); 
            var sqb_retake =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_retake').val();  
            var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();   
            var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val(); 
            var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();   
            
            lesson_id = jQuery.isNumeric(lesson_id);                                    
            if( lesson_id !="" && lesson_id == true){
                if( count_manage_lead_data > 0  ){
                
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .already_taken_quiz_outer').css("display","inline-block"); 
                    var show_start_screen = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_start_screen').val(); 
                    if(show_start_screen == "Y"){
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  ').css("display","none"); 
                    }else{
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_start_template_outer ').css("display","none");  
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  ').css("display","block");  
                    }
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
                        $_self.lesson_quiz_pagination(sqb_quiz_container_outer_id ,quiz_pagination);
                    });

                    if( sqb_retake == "n"  ){    
                            //add disable tclass to answers, after they click  on button            
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
                                jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled");
                                $_self.lesson_quiz_pagination(sqb_quiz_container_outer_id , quiz_pagination);                                
                        });
                        
                    }else{  
                        jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_retake').val("y");
                        
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').each(function(){
                            
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled"); 
                            $_self.lesson_quiz_pagination(sqb_quiz_container_outer_id , quiz_pagination);  
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_item_outer').removeClass("sqb_ans_selected"); 
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .multiple_correct_checkbox .checkbox_fe').prop('checked', false);  
                        });
                        
                    }
                    if(quiz_pagination !="all"){
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').hide();    
                        $_self.lesson_quiz_pagination_show_result(sqb_quiz_container_outer_id , sqb_retake);
                    }
                }
            }
        }

        this.dapProcess = function(){

            if(lesson_id < 1){
                return false;
            }
            
            this.initFlatQuiz();

            var show_not_passed_msg = jQuery('.show_not_passed_msg').val();
            if(show_not_passed_msg == 'y'){
                jQuery(".markas_completed_btn").addClass("disableMarkBtn");
                jQuery(".dap-btn-mark-as-complate").addClass('disableMarkBtn');
            }

            if(lesson_id > 0 && count_manage_lead_data > 0){
                $this.find('.question_container').each(function(){
                    $this.find('.question_container').addClass("question_container_disabled"); 
                    $this.find('.question_container').first().removeClass("question_container_disabled");                   
                    //$this.find('.buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
                });
            }else{
                $this.find('.buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
                $this.find('.retake_button').addClass('btn_disabled');
            }
        }

        this.lesson_show_hide_retake = function(sqb_quiz_container_outer_id){
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .reake_data_outer ').hide(); 
            if(jQuery('#'+sqb_quiz_container_outer_id+' .quiz_result_template_outer .reake_data_outer ').length < 1){   
                var retakehtml = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .reake_data_outer ').html();     
                  
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .result_temp_outer ').append('<div class="reake_data_outer retake_data_outer_reload" style="display:block">'+retakehtml+'</div>');    
            } 
        }
        this.lesson_quiz_pagination = function(sqb_quiz_container_outer_id, quiz_pagination){
            if(quiz_pagination !="all"){         
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .reake_data_outer ').hide();          
                this.lesson_show_hide_retake(sqb_quiz_container_outer_id);      
            }else{
                jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass("question_container_disabled1"); 
            }
        }

        this.lesson_quiz_pagination_show_result = function(sqb_quiz_container_outer_id , sqb_retake){   
    
            var already_taken_quiz_outer = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .already_taken_quiz_outer ').html();       
            var already_taken_quiz_outer_css = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .already_taken_quiz_outer ').attr("style");        
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .result_temp_outer').prepend('<div class="already_taken_quiz_outer" style="'+already_taken_quiz_outer_css+'">'+already_taken_quiz_outer+'</div>');
            var retakehtmlstyle = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .reake_data_outer ').attr("style"); 
            jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .already_taken_quiz_outer ').hide(); 
            var displayretake = jQuery('#displayretake').val();     
            if(displayretake =="y"){
                var retakehtml = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_quesans_template_outer .reake_data_outer ').html();     
                if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .result_temp_outer ').length > 0){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .result_temp_outer ').append('<div class="reake_data_outer" style="display:block">'+retakehtml+'</div>');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .outcome_div_lesson ').append('<div class="reake_data_outer" style="display:block">'+retakehtml+'</div>');
                }
            }
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').hide();
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').removeClass('show_cls');
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 ').html(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 ').html().replace('[DOWNLOADPDF]',''));
            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 ').show();    
        }

        this.setPopupFrequency = function(){
            var cookie_name = "SQB_cp_display_frequency";
            var frequency = $this.find('#quiz_popup_frequency').val();
            var cookie_value = frequency;

            var frequency_arr = frequency.split('|');
            var frequency = frequency_arr[0];
            var frequency_value = frequency_arr[1];
            if(typeof jQuery.cookie('SQB_cp_display_frequency') === 'undefined'){
                if(frequency != 'always' && frequency != 'display_once'){
                    setCookie(cookie_name, frequency_value, frequency_value);
                }else{
                    if(frequency == 'display_once'){
                        setCookie(cookie_name, cookie_value, '36500');
                    }
                }
            }else{
                if(frequency == 'always'){
                    jQuery.cookie(cookie_name, null, { path: '/' }); 
                }else if(frequency == 'display_once'){
                    const d = new Date();
                    d.setTime(d.getTime() + (36500 * 24 * 60 * 60 * 1000));
                    let expires = "expires="+d.toUTCString();
                    document.cookie = cookie_name + "=" + frequency + ";" + expires + ";path=/";
                }else if(frequency == 'set_display_frequency'){
                    const d = new Date();
                    d.setTime(d.getTime() + (frequency_value * 24 * 60 * 60 * 1000));
                    let expires = "expires="+d.toUTCString();
                    document.cookie = cookie_name + "=" + frequency_value + ";" + expires + ";path=/";
                }
            }
        }

        this.navigateTo = function(page){
            
            var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 2000;
            
            if(quiz_pagination == 'question_on_category' || quiz_pagination == 'fixed_number'){
                $this.find('.quiz_quesans_template_outer  .Quiz-Template').addClass('hide_cls').removeClass('show_cls');
                $this.find('.quiz_quesans_template_outer  .Quiz-Template.page-'+page).addClass('show_cls').removeClass('hide_cls');
                                
                $this.find('.sqb-question-on-cat').addClass('hide_cls').removeClass('show_cls');
                $this.find('.sqb-question-on-cat.cat-page-'+page+'').addClass('show_cls').removeClass('hide_cls');

                $this.find('.sqb-page-number').removeClass('active');
                $this.find('.sqb-page-number.sqb-page-number-'+page).addClass('active');
                $this.find('.sqb-page-number.sqb-page-number-'+page).removeClass('not-allow');
                
                $this.find('.question_container_disabled .single_cls').css('pointer-events', 'none');
                $this.find('.question_container_disabled .single_next_btn').css('pointer-events', 'none');

                setTimeout(function() {
                    jQuery('html, body').animate({
                        scrollTop: $this.find('.Quiz-Template.page-'+page).offset().top - 160
                    }, "slow");
                }, timerValue);
            }else{
                if(jQuery.inArray( page, pageViewed ) > -1){
                    $this.find('.quiz_quesans_template_outer  .Quiz-Template').addClass('hide_cls').removeClass('show_cls');
                    $this.find('.quiz_quesans_template_outer  .Quiz-Template.page-'+page).addClass('show_cls').removeClass('hide_cls');
                                    
                    $this.find('.sqb-question-on-cat').addClass('hide_cls').removeClass('show_cls');
                    $this.find('.sqb-question-on-cat.cat-page-'+page+'').addClass('show_cls').removeClass('hide_cls');

                    $this.find('.sqb-page-number').removeClass('active');
                    $this.find('.sqb-page-number.sqb-page-number-'+page).addClass('active');
                    $this.find('.sqb-page-number.sqb-page-number-'+page).removeClass('not-allow');
                    
                    $this.find('.question_container_disabled .single_cls').css('pointer-events', 'none');
                    $this.find('.question_container_disabled .single_next_btn').css('pointer-events', 'none');

                    setTimeout(function() {
                        jQuery('html, body').animate({
                            scrollTop: $this.find('.Quiz-Template.page-'+page).offset().top - 160
                        }, "slow");
                    }, timerValue);
                }
            }

            
        }

        this.processMultiPageQuestion = function($question,skip_click=false){

            //$question.find(".sqb_quiz_next_button_click").val(0);
            $question.addClass("question_container_disabled");
            display_correctans_options = "no";
            parent_ques_div = 'question_id_'+$question.closest('.Quiz-Template').attr('data-question-id');
            $question.find('.answer_container').removeClass("answer_container_disabled");
            $next_question = $question.closest('.Quiz-Template').next().find('.question_container');
            //scroll to next question
            var next_questionid_outer =   $question.closest('.Quiz-Template').next().attr('data-question-id');           
            var next_questionid =   "question_id_"+next_questionid_outer;
            var display_lastchild =  $this.find('.Quiz-Template .question_container').last().attr('id');    
            
            var is_valid = this.validateQuestion($question,skip_click);

            if(!is_valid) return false;

            if(!skip_click){
                if(this.isQuiz('scoring')){
                    var isFirst = $question.find('.sqb_quiz_next_button_click').val();
                    if(!this.showCorrectAnswer($question)){
                        if(isFirst == 0){
                            return false;
                        }
                    }
                }
            }
                
            if(display_lastchild != parent_ques_div){
                this.multiPageNextQuestion($question,$next_question); 
            }else{
                if(lesson_id > 0){
                    sqb_quiz_container_outer_id = $this.attr('id');
                    this.dapEnableDetail(sqb_quiz_container_outer_id);
                }else{
                    this.questionsComplete($question);
                }
               
            }
        }
        
        this.processOnePageQuestion = function($question, skip_click = false){

            //$question.find(".sqb_quiz_next_button_click").val(0);
            $question.addClass("question_container_disabled");
            display_correctans_options = "no";
            parent_ques_div = 'question_id_'+$question.closest('.Quiz-Template').attr('data-question-id');
            $question.find('.answer_container').removeClass("answer_container_disabled");
            $next_question = $question.closest('.Quiz-Template').next().find('.question_container');
            //scroll to next question
            var next_questionid_outer =   $question.closest('.Quiz-Template').next().attr('data-question-id');           
            var next_questionid =   "question_id_"+next_questionid_outer;
            var display_lastchild =  $this.find('.Quiz-Template .question_container').last().attr('id');    
            
            var is_valid = this.validateQuestion($question,skip_click);

            if(!is_valid) return false;

            if(this.isQuiz('scoring')){
                var isFirst = $question.find('.sqb_quiz_next_button_click').val();
                if(!this.showCorrectAnswer($question)){
                    if(isFirst == 0){
                        return false;
                    }
                }
            }
            
            if(display_lastchild != parent_ques_div){
                this.onePageNextQuestion($question,$next_question); 
            }else{
                if(lesson_id > 0){
                    sqb_quiz_container_outer_id = $this.attr('id');
                    this.dapEnableDetail(sqb_quiz_container_outer_id);
                }else{
                    this.questionsComplete($question);
                }
               
            }

            /*var parent_hasClass = false;
            var matrix_cls = jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").hasClass('matrix_cls'); 
            var has_multiple_correct_cls =  jQuery(this).closest(".question_container").hasClass('multiple_correct_cls');
            var has_ranking_cls =  jQuery("#"+sqb_quiz_container_outer_id+ " #"+parent_ques_div+" .sqb_ans_item_outer").closest(".question_container").hasClass('question_type_ranking_choices');
            if(matrix_cls){
                parent_hasClass = true;
            }
            if(has_multiple_correct_cls){
                parent_hasClass = true;
            }
            if(has_ranking_cls){
                parent_hasClass = true;
            }
            
            var ans_select_obj = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_selected');
            var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();
            var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
            var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
            var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

            if (typeof sqb_question_id === "undefined" || (sqb_question_id == 0)){
                sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.single_cls').attr('data-question-id');
                sqb_answer_id = 0;
                sqb_outcome_id = 0;
                if(parent_hasClass == true){
                    sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected').attr('data-question-id');
                }
                if(matrix_cls == true){
                    sqb_question_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div).find('.sqb_ans_item_outer.matrix_cls').attr('data-question-id');
                }
            }
            if(parent_hasClass == true){
                var sqb_answer_id  = getMultipleAnswerIds(parent_ques_div, sqb_quiz_container_outer_id);    
            }*/
                
                /*sqb_advanced_rule(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
                sqb_save_question_answer_report(sqb_quiz_id,sqb_question_id, sqb_answer_id,sqb_outcome_id, sqb_quiz_container_outer_id);
                sqb_next_questions_view_count_store_for_none_branching(sqb_quiz_id,sqb_question_id, sqb_quiz_container_outer_id);*/
        }

        this.onePageNextQuestion = function($question, $next_question){ 
            
            $question.addClass("question_container_disabled");
            $next_question.removeClass("question_container_disabled");
            $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
            $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');
            this.showQuesAnsResults($question);
            this.progressBar($question);
            $_self.playSilentVideo($next_question.closest('.Quiz-Template'));
            jQuery('html, body').animate({
                scrollTop: $next_question.closest('.Quiz-Template').offset().top - 160
            }, "slow");
        }

        this.multiPageNextQuestion = function($question, $next_question){
            
            
            if($question.closest('.Quiz-Template').attr('data-page') != $next_question.closest('.Quiz-Template').attr('data-page')){
                
                var nextpage = $next_question.closest('.Quiz-Template').attr('data-page');
                $this.find('.quiz_quesans_template_outer  .Quiz-Template').addClass('hide_cls').removeClass('show_cls');
                $this.find('.quiz_quesans_template_outer  .Quiz-Template.page-'+nextpage).addClass('show_cls').removeClass('hide_cls');
                $this.find('.Quiz-Template.page-'+nextpage+' .question_container').addClass("question_container_disabled");
                $this.find('.Quiz-Template.page-'+nextpage+' .question_container').first().removeClass("question_container_disabled");

                $this.find('.sqb-question-on-cat').addClass('hide_cls').removeClass('show_cls');
                $this.find('.sqb-question-on-cat.cat-page-'+nextpage+'').addClass('show_cls').removeClass('hide_cls');
                
                $this.find('.sqb-page-number').removeClass('active');
                $this.find('.sqb-page-number.sqb-page-number-'+nextpage).addClass('active');
                $this.find('.sqb-page-number.sqb-page-number-'+nextpage).removeClass('not-allow');

                if(jQuery.inArray( nextpage, pageViewed ) == -1){
                    pageViewed.push(nextpage);
                }

                var timerValue = 0;
                if(slider_animation == 'Y') timerValue = 1100;
                setTimeout(function() {
                    jQuery('html, body').animate({
                        scrollTop: $next_question.closest('.Quiz-Template').offset().top - 160
                    }, "slow");
                }, timerValue);

            }else{
                var nextpage = $next_question.closest('.Quiz-Template').attr('data-page');
                var timerValue = 0;
                
                    jQuery('html, body').animate({
                        scrollTop: $next_question.closest('.Quiz-Template').offset().top - 160
                    }, "slow");
               
                
            }
            $question.addClass("question_container_disabled");
            $next_question.removeClass("question_container_disabled");
            $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
            $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');
            $this.find('.question_container_disabled .single_cls').css('pointer-events', 'none');
            $this.find('.question_container_disabled .single_next_btn').css('pointer-events', 'none');
            this.showQuesAnsResults($question);
            this.progressBar($question);
            $_self.playSilentVideo($next_question.closest('.Quiz-Template'));
            /*var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 1100;
            setTimeout(function() {
                jQuery('html, body').animate({
                    scrollTop: $next_question.closest('.Quiz-Template').offset().top - 160
                }, "slow");
            }, timerValue);*/
        
        }

        this.initPopup = function(){
            
            var popupshow = true;
            if(quiz_display == 'exit' || quiz_display == 'corner_popup' || quiz_display == 'time_based' || quiz_display == 'percentage_based' ){
                this.setPopupFrequency();
            }
            if(quiz_display == 'exit'){
                if(isMobile){
                    var exitp = $this.find('#exitpopup').val();
                    if(exitp < 1){
                        $this.find('#exitpopup').val('1');
                        if(isMobile){
                            var delay = $this.find('#exit_popup_timer').val();  
                            if(delay < 1){
                                delay ='5';
                            }
                        }else{
                            delay = '0';
                        }
                        setTimeout(function(){              
                            $_self.showPopup();
                        }, delay+'000');
                        
                    }
                }
                document.addEventListener("mouseout", function (e) {
                    if (e.pageY < jQuery(window).scrollTop()) {
                        var exitp = $this.find('#exitpopup').val();
                        if(exitp < 1){
                            $this.find('#exitpopup').val('1');
                            if(isMobile){
                                var delay = $this.find('#exit_popup_timer').val();  
                                if(delay < 1){
                                    delay ='5';
                                }
                            }else{
                                delay = '0';
                            }
                            setTimeout(function(){              
                                $_self.showPopup();
                            }, delay+'000');
                            
                        }
                    }
                });
            }else if(quiz_display == 'corner_popup'){
                var delay = $this.find('#quiz_popup_time_delay').val();
                setTimeout(function(){
                    $_self.showPopup();
                }, delay*500);
            }else if(quiz_display == 'time_based'){
                var delay = $this.find('#getExitPopupValue').val();

                setTimeout(function(){
                    $_self.showPopup();
                }, delay*500);
            }else if(quiz_display == 'percentage_based'){
                jQuery(window).on("scroll", function(){
                    var wh = jQuery(window).height();
                    var dh = jQuery(document).height();
                    var scrollTop = jQuery(window).scrollTop();
                    var trackLength = dh - wh;
                    var pctScrolled = Math.floor(scrollTop/trackLength * 100);
                    var delay = $this.find('#getExitPopupValue').val();
                    if(pctScrolled > delay){
                        var pp = $this.find('#per_popup').val();
                        if(pp < 1){
                            $this.find('#per_popup').val('1');
                            setTimeout(function(){
                                $_self.showPopup();
                            }, 0);
                        }
                    }
                });
            }
        }
        
        this.start_quiz = function(){
            
                if(anim_effect){
                    const element = document.querySelector('.take-quiz-btn');
                    element.classList.add(anim_effect);
                    setTimeout(function() {
                        element.classList.remove(anim_effect);
                    }, 1000);
                }

                var sqb_quiz_container_outer_id =  $this.attr('id');

                this.bindCustomEvent(document.querySelector('.take-quiz-btn'),'sqb_startbutton_click',{ id: sqb_quiz_container_outer_id,quiz_id:quiz_id });

                if (isMobile) {
                    $this.find('#quiz_slider_animation').val("N");  
                    $this.find('#quiz_slider_animation_option').val("");    
                }
                $this.find('.form_cls input, .form_cls textarea, .form_cls select').css('pointer-events','auto');
                if(template == 'template6'){
                    $start_outer.css('display','none');
                }
                var start_hgt = $start_outer.find('.quiz_comon_template').height();
                
                if(template == 'template5'){
                    var template5_width = $this.find('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width');
                    if(template5_width == 'none'){
                        var start_screen_height = $this.find('.Quiz-start-Template5 .Quiz-start-Template5-inner').css('min-height');
                        $quesans_outer.find('.Quiz-Template-5').css('max-width','');
                        $quesans_outer.find('.Quiz-Template-5 .Quiz-Template5-inner').css('min-height',start_screen_height);
                        $optin_outer.find('.Quiz-Optin-Template').css('max-width','');
                        $optin_outer.find('.Quiz-Optin-Template').css('min-height',start_screen_height);
                        $outcome_outer.find('.result_temp_outer').css('max-width','');
                        $outcome_outer.find('.Quiz-result-Template5-inner').css('min-height',start_screen_height);
                    } else {
                        var start_screen_width = $this.find('.Quiz-start-Template5').css('max-width');
                        var start_screen_height = $this.find('.Quiz-start-Template5 .Quiz-start-Template5-inner').css('min-height');
                        $quesans_outer.find('.Quiz-Template-5').css('max-width',start_screen_width);
                        $quesans_outer.find('.Quiz-Template-5 .Quiz-Template5-inner').css('min-height',start_screen_height);
                        $optin_outer.find('.Quiz-Optin-Template').css('max-width',start_screen_width);
                        $optin_outer.find('.quiz_optin_template_outer .Quiz-Optin-Template').css('min-height',start_screen_height);
                        $outcome_outer.find('.result_temp_outer').css('max-width',start_screen_width);
                        $outcome_outer.find('.Quiz-result-Template5-inner').css('min-height',start_screen_height);
                    }
                    
                    $_self.showFirstnameScreen();
                   
                    
                    if($this.find('.sqb_template5-fullWidth').hasClass('enable_branching_quiz')){
                        $this.find('.Quiz-Template5-left-side').find('.sqb_question_progress').hide();
                    }
                }
                
                if(quiz_display == "inpage"){
                    if(template == 'template1' || template == 'template2' || template == 'template3' || template == 'template4'){
                        var max_width_temp = $quesans_outer.find('.Quiz-Template.show_cls').find('.temp_wid').val();                 
                        $quesans_outer.find('.Quiz-Template.show_cls').css("max-width",max_width_temp);         
                    }
                }
                
                //if quiz type is popup 
                if(this.isPopup()){

                    if(quiz_display == 'popup'){
                        this.showPopup('Y');
                    }else{
                        this.setFirstScreen();
                    }
                    
                }else{
                    
                    this.apply_wid_css();
                    if($start_outer.find('.Quiz-Start-Template2').length){
                        
                        /*if (!isMobile) {
                            if(template == 'template6' && slider_animation != 'Y'){
                                if($quesans_outer.offset().top >0){
                                    jQuery('html, body').animate({    
                                    scrollTop: $quesans_outer.offset().top + 500               
                                    }, "slow");
                                }
                            }
                        }  */ 
                    }

                    this.setFirstScreen();
                    
                    if(show_firstname_temp == 'Y'){ 
                        gotoNextCheck= false;
                    }else{
                        $_self.displayMessageInScreens(sqb_quiz_container_outer_id);            
                        $_self.displayMessageSpeedInScreens(sqb_quiz_container_outer_id);            
                    }
                    
                    $_self.initSinglePage();
                    
                }

            setTimeout(function(){
                $this.find('.show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
                if(slider_animation == 'N'){
                    $this.find('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
                }
            },500);

            this.saveReport('quiz_start_btn_click');
            var question_id = $this.find('.question_container.show_cls').attr('data-question-id');
            this.saveQuesAnsReport(question_id);
        }

        this.initMultiPage = function(){
            
            if(quiz_pagination == 'fixed_number' || quiz_pagination == 'question_on_category'){
                $this.find('.quiz_quesans_template_outer  .Quiz-Template').addClass('hide_cls').removeClass('show_cls');
                $this.find('.quiz_quesans_template_outer  .Quiz-Template.page-1').addClass('show_cls').removeClass('hide_cls');
    
                if(quiz_pagination != 'question_on_category' && quiz_pagination != 'fixed_number'){
                    $this.find('.Quiz-Template.page-1 .question_container').addClass("question_container_disabled");
                    $this.find('.Quiz-Template.page-1 .question_container').first().removeClass("question_container_disabled");
                }else if(quiz_pagination == 'question_on_category' && show_next_button == 'Y'){
                    $this.find('.Quiz-Template.page-1 .question_container').addClass("question_container_disabled");
                    $this.find('.Quiz-Template.page-1 .question_container').first().removeClass("question_container_disabled");
                }

                $this.find('.sqb-question-on-cat').addClass('hide_cls').removeClass('show_cls');
                $this.find('.sqb-question-on-cat.cat-page-1').addClass('show_cls').removeClass('hide_cls');

                $this.find('.sqb-question-on-cat').attr('style', $this.find('.sqb-question-on-cat').attr('style')+';'+$this.find('.sqb_ans_item').attr('style')+';'+$this.find('.sql_ans_text').attr('style'));

                this.playSilentVideo($this.find('.quiz_quesans_template_outer  .Quiz-Template.page-1'));

                if(template == 'template8'){
                    $this.find('.sqb-question-on-cat').css('max-width',$this.find('.answer_container').css('width'));
                }
            }
        }

        this.initSinglePage = function(){
            if(quiz_pagination == 'all'){
                if(lesson_id == ''){
                    if(same_page_option != 'no_next_button' && same_page_option != 'category_names'){
                        $this.find('.Quiz-Template-outer').css('max-width','700px');
                    }
                    $this.find('.Quiz-Template-outer').css('margin','0 auto');
                }
                if(same_page_option != 'no_next_button' && same_page_option != 'category_names'){
                    $this.find('.question_container').addClass("question_container_disabled");
                    $this.find('.question_container').first().removeClass("question_container_disabled");
                }
            }
        }

        this.closePopup = function(event){
           
            var nearbyclass= jQuery(event).closest('.quiz_outer_fe').attr("class"); 
            var last_show_div = '<input type="hidden" class="last_show_div" value="'+nearbyclass+'">';   
            if($this.find('.sqb_quiz_container .last_show_div').length < 1 ){
                $this.find('.sqb_quiz_container').append(last_show_div);
            }else{
                $this.find('.last_show_div').val(nearbyclass); 
            }
            
            $this.find('.modal_popup_outer').removeClass('show');
            //$this.find('.quiz_outer_fe').removeClass('modal_popup');   
            //$this.find('.quiz_outer_fe').hide();
             
            if(quiz_display == "popup"){
                //$this.find(".quiz_outer_fe").removeClass("show_cls"); 
                $start_outer.show();
                $start_outer.find('.take-quiz-btn').show();
                $start_outer.addClass('show_cls ').removeClass('hide_cls');
                $start_outer.find('.take-quiz-btn').addClass('show_cls ').removeClass('hide_cls'); 
            }
            setTimeout(function(){
                $this.find('#exitpopup').val('1');
                $this.find('#per_popup').val('1');
            },100);
            if(quiz_display == "corner_popup"){
                $start_outer.removeClass('show_cls').addClass('hide_cls');
                $quesans_outer.removeClass('show_cls').addClass('hide_cls');
                $optin_outer.removeClass('show_cls').addClass('hide_cls');
                $outcome_outer.removeClass('show_cls').addClass('hide_cls');
            }
            
            jQuery('body').find('.tve-page-section-in').removeClass('sqb-popup-zindex');
            jQuery('body').find('.thrv-page-section').removeClass('sqb-popup-zindex');
            jQuery('html').removeClass('sqb-popup-zindex');
            //added for form type quiz
            this.hideScreensForForm();
        }

        this.hideScreensForForm = function(){    
            $this.find( '#exitpopup').val('0');
            var form_quiz_displayed = jQuery('#form_quiz_displayed').val();
            if(quiz_type =="form" && quiz_display == "popup" && form_quiz_displayed == "exit") {
                $outcome_outer.removeClass('show_cls').addClass('hide_cls');                
                $outcome_outer.hide();
            }  
        }  

        this.showPopup = function(hide_start = 'N'){
            var timerValue = 0;
            if(anim_effect) timerValue = 1000;

            setTimeout(function() {
                $this.find('.modal_popup_outer').addClass('show');
                $_self.addThemeSupport();
                $this.find('.quiz_outer_fe').hide();

                if($this.find('.sqb_prevent_submission_quiz').length > 0){
                    $this.find('.sqb_prevent_submission_quiz').show();
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    return false;
                }

                var $modal_inner = $this.find('.quiz_result_template_outer.quiz_outer_fe.modal_popup .modal_pop_inn');
                if($this.find('.last_show_div ').val() == "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {
                    
                    var temp_wid1= $outcome_outer.find(".quiz_comon_template ").css("max-width");       
                    if(template != 'template6'){
                        $modal_inner.css("max-width",temp_wid1);    
                        $modal_inner.css("width",temp_wid1);
                    }   
                }
        
                if(show_fname_temp == 'Y'){
                    $_self.apply_wid_css_popup("first_name"); 
                }else{
                    $_self.apply_wid_css_popup("question");
                    var temp_wid2 = $quesans_outer.find('.Quiz-Template.show_cls').find('.temp_wid').val();
                    if(template != 'template6'){
                        $this.find('.modal_pop_inn').css("max-width",temp_wid2); 
                        $this.find('.modal_pop_inn').css("width",temp_wid2);
                    }
                }
                
                if($this.find('.last_show_div').val()== "quiz_result_template_outer quiz_outer_fe modal_popup show_cls") {                       
                    var temp_wid1= $outcome_outer.find(".quiz_comon_template").css("max-width");        
                    if(template != 'template6'){
                        $modal_inner.css("max-width",temp_wid1);    
                        $modal_inner.css("width",temp_wid1);
                    }   
                }
                
                if($this.find('.last_show_div').length > 0){
                    
                    var nearbyclass = $this.find('.last_show_div').val();   
                    $start_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                    $start_outer.find('.take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');

                    $this.find('.quiz_outer_fe').each(function(){
                        var contianerclass = jQuery(this).attr("class");
                        contianerclass = contianerclass+" show_cls";
                        
                        if(contianerclass ==nearbyclass){
                            jQuery(this).show();
                            jQuery(this).addClass("show_cls");
                        }
                    });
                    
                }else{
                    $_self.setFirstScreen(hide_start);
                }
                $_self.sqbDatePicker();
            },anim_effect);

            if(anim_effect){
                setTimeout(function(){
                    $this.find('.sqb_mobile_view_layout_active').addClass('template_num_'+template);
                },1000);
            }
        }

        this.apply_wid_css_popup = function(screenname){

            var $modal_inner = $this.find(".modal_pop_inn .Quiz-Template");
            if(screenname =="first_name" ){ 
                var temp_wid = $fn_outer.find(".quiz_comon_template ").css("max-width");        
                var q_max_width =        $modal_inner.css('max-width');
                var q_background_color = $modal_inner.css('background-color');
                var q_border =           $modal_inner.css('border');
                    
            }else if(screenname =="optin" ){    
                var temp_wid = $optin_outer.find(".quiz_comon_template ").css("max-width");         
            }else if(screenname =="result" ){   
                var temp_wid = $outcome_outer.find(".quiz_comon_template ").css("max-width");           
            }else{
                var temp_wid = $this.find(".question_container.show_cls").find('.temp_wid').val();  
            }
             
            //for popup 
            var quiz_display = jQuery("#quiz_display").val();      
            if(this.isPopup()){
                if(template != 'template6'){             
                    $modal_inner.css("max-width",temp_wid); 
                    $modal_inner.css("width",temp_wid); 
                    $quesans_outer.find(".Quiz-Template.show_cls").css("max-width",temp_wid);   
                } 
                
                if(screenname =="first_name" ){ 
                
                    var $modal_pop_inn_fn = $this.find(".quiz_firstname_template_outer  .modal_pop_inn");
                    $modal_pop_inn_fn.css({
                        "padding" : '30px',
                        "padding-bottom" : '30px',
                        "border" : q_border,
                        "max-width" : q_max_width,
                        "width" : q_max_width,
                        "background-color" : q_background_color
                    });             
                }
                
                if(template == 'template5'){
                    var temp_width = $this.find(".Quiz-Template-5").find('.temp_wid').val();
                    $quesans_outer.find(".Quiz-Template.show_cls").css("max-width",temp_width);
                    $quesans_outer.find(".modal_pop_inn").css('max-width',temp_width);
                    $quesans_outer.find(".modal_pop_inn").css('width',temp_width);
                }
            }       
        }

        this.apply_wid_css = function(){

            if(template == 'template5' ){
            } else if(template == 'template8'){
            } else {
                var temp_wid = $this.find('.Quiz-Template.show_cls').find('.temp_wid').val();
                var temp_wid1 = $quesans_outer.find('.Quiz-Template.show_cls').next().find('.temp_wid').val();
                $quesans_outer.find('.Quiz-Template.show_cls').next().css("max-width",temp_wid1);
            }
            
            //for popup  
            if(quiz_display == "popup"){
                if(template != 'template6'){
                    $this.find('.modal_pop_inn').css("max-width",temp_wid);  
                    $this.find('.modal_pop_inn').css("width",temp_wid);
                }    
            }
        }

        this.saveQuesAnsReport = function(question_id,answer_id = 0,outcome_id = 0,other_field = '',answered = '',only_question=''){

            var SQBPreview = $this.find('#SQBPreview').val();
            if(SQBPreview =="Y")  return false;
            if((answer_id == 0) && (only_question == '') && lesson_id != '') return false;
            if($this.find('#already_given_quiz_status').val() == 1) return false;
            if(sqb_save_report == "n") return false;

            /*$q = $this.find('#question_id_'+question_id);
            if($q.hasClass('question_type_text')){
                answered = this.getSelectedAnswer(question_id,answer_id);
            }*/
            

            var report_id = 0;
            if(localReport[question_id] != undefined && localReport[question_id] != 0 && answer_id != 0){
                report_id = localReport[question_id];
            }

            jQuery.post(ajaxurl, {
                action: 'sqb_save_question_answer_report',
                quiz_id: quiz_id,
                question_id: question_id,
                answer_id: answer_id,
                other_field: other_field,
                outcome_id: outcome_id,
                answered: answered,
                report_id : report_id,
                async: true
            }, function(response) {
                response = JSON.parse(response);
                if(report_id == 0 && answer_id != 0){
                    localReport[question_id] = response.last_id;
                }
                $_self.FBEvent('N',response,'', outcome_id, question_id, answer_id);
            });
        }

        this.FBEvent = function(global,response,report_type = '',outcome_id = 0,question_id= 0, answer_id = 0){
            try {           
                if(response.returndata){
                    var returndata = response.returndata;
                    var returndata = response.returndata;
                    var event_name = returndata.event_name;
                    var event_name_new = returndata.event_name_new;
                    var tag = returndata.tag;
                    var value = returndata.value;
                    var action_name = returndata.action_name;
                    var tags = returndata.tags;
                    var status = returndata.status;
                    if(status == 'Y'){
                        if(global == 'Y'){
                            if(action_name != 'outcome'){
                                fbq('track', event_name, {
                                    content_name: event_name, 
                                    content_ids: tags,
                                    content_type: action_name,
                                    value: value
                                });
                            }else if(action_name == 'outcome'){
                                var outcome_title = $this.find('#outcome_id_'+outcome_id).find('#outcome_name').val();
                                var quiz_title = $this.find('#sqb_quiz_title').val();
                                fbq('trackCustom', 'Outcome', {
                                    quiz_title: quiz_title,
                                    outcome_title: outcome_title,
                                    tag: tag
                                });
                            }
                        }else{
                            var quiz_title = $this.find('#sqb_quiz_title').val();
                            var question_title = removeTags($this.find('#question_id_'+question_id+' .question_title').html());
                            if(action_name == 'question'){
                                fbq('trackCustom', 'Question', {
                                    quiz_title: quiz_title,
                                    question_title: question_title,
                                    tag : tag
                                });
                            }else if(action_name == 'answer'){
                                var answer_value = this.getSelectedAnswer(question_id,answer_id);
                                fbq('trackCustom', 'Answer Choice', {
                                    quiz_title: quiz_title,
                                    question_title: question_title,
                                    answer_title: answer_value
                                });
                            }
                        }
                    }
                }
            }catch(err) {console.log('Error : FB Tracking')}
        }

        this.saveReport = function(report_type,outcome_id = 0){
            var SQBPreview = $this.find('#SQBPreview').val();
            if(SQBPreview =="Y") return false;

            var external_url = '';
            if(isExternalLink(home_url)){
                external_url = document.referrer;
            }

            jQuery.post(ajaxurl, {
                    action: 'sqb_save_reports',
                    quiz_id: quiz_id,
                    report_type : report_type,
                    outcome_id : outcome_id,
                    current_page_id:current_page_id,
                    external_url:external_url
                }, function(response){
                    response = JSON.parse(response);
                    $_self.FBEvent('Y',response,outcome_id,report_type);
            });
        }

        this.setFirstScreen = function(hide_start = 'Y',screen = ''){

            var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 1000;

            //setTimeout(function() {
                $start_outer.addClass('hide_cls done_screen').removeClass('show_cls');      
                $start_outer.find('.take-quiz-btn').addClass('hide_cls done_screen').removeClass('show_cls');
                $fn_outer.addClass('hide_cls').removeClass('show_cls');

                if($this.find('.sqb_prevent_submission_quiz').length > 0 && quiz_display != 'popup'){
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    return false;
                }
                
                if(lesson_id > 0 && count_manage_lead_data > 0 && (screen == 'lesson_result' || screen == '')){
                    $_self.dapScreen();
                }else if(show_start_screen == 'Y' && hide_start != 'Y' && (screen == 'startscreen' || screen == '')){
                    $start_outer.addClass('show_cls').removeClass('hide_cls').removeClass('done_screen');
                    $start_btn.addClass('show_cls').removeClass('hide_cls').removeClass('done_screen');
                    $_self.playSilentVideoGlobal($start_outer);
                }else if(show_fname_temp == 'Y' && (screen == 'firstname' || screen == '')){
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    $fn_outer.addClass('show_cls').removeClass('hide_cls');
                    var start_hgt = $start_outer.find('.quiz_comon_template').height();
                    if(start_hgt > 700){
                            jQuery('html, body').animate({
                                scrollTop: $fn_outer.offset().top - 100
                            }, "slow");
                        }
                }else if(show_optin == 'Y' && opt_screen_position == 'optin-before-questions-screen' && (screen == 'before-optin' || screen == '')){
                    if(lesson_id > 0){
                        $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                    }else if(auto_submit_optin == 'Y'){
                        $_self.autoSubmitOptin();
                    }else{
                        $optin_outer.addClass('show_cls').removeClass('hide_cls');
                        this.playSilentVideoGlobal($optin_outer);
                        $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    }
                    
                    $_self.initMultiPage();
                    $_self.initFlatQuiz();
                }else if(quiz_type == 'form' && (screen == 'form' || screen == '')){
                    $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    this.playSilentVideoGlobal($optin_outer);
                }else{
                    $question = $this.find('.question_container.show_cls');
                    var parent_ques_div =  $question.attr('id');
                    var question_id = $this.find("#"+parent_ques_div).data("question-id");
                    this.saveQuesAnsReport(question_id);
                    $_self.initSinglePage();
                    $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                    this.playSilentVideo($question.closest('.Quiz-Template'));
                    $_self.initMultiPage();
                    $_self.initFlatQuiz();
                    $_self.displayMessageInScreens();
                     $_self.displayMessageSpeedInScreens();
                    if(is_loaded){
                        $_self.scrollToAnimate('ques_ans');
                    }
                }

                if(show_optin == 'Y' && opt_screen_position == 'optin-before-questions-screen'){
                    this.sqbIntlTelInput('custom');
                }
                if(quiz_type == 'form'){
                    this.sqbIntlTelInput('custom');
                }

                if(quiz_pagination == 'all'){
                    this.sqbIntlTelInput('custom');
                }

                //this.saveQuesAnsReport(question_id);

                if(is_loaded){
                    $_self.sqbScrollToNextScreen();
                }
                
            //},timerValue);
            is_loaded = true;
        }

        this.initFlatQuiz = function(){

            if(quiz_pagination == 'question_on_category' && show_next_button == 'N'){
                //show_next_button = 'Y';
               // $this.find('#show_next_button').val('Y');
                $quesans_outer.find('.single_next_btn').hide();
                $quesans_outer.find('.continue-question-action').hide();
                if(show_optin == 'Y' && opt_screen_position != 'optin-before-questions-screen'){
                    $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                }
                //$this.find('.sqb-page-number').removeClass('not-allow');
                $quesans_outer.find('.single_next_btn:last').show();
            }else if(quiz_pagination == 'all' && (same_page_option == 'no_next_button' || same_page_option == 'category_names')){
                show_next_button = 'Y';
                $this.find('#show_next_button').val('Y');
                $quesans_outer.find('.single_next_btn').hide();
                $quesans_outer.find('.continue-question-action').hide();
                if(lesson_id < 1){

                    if(show_optin == 'Y'){
                        $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    }else{
                        $quesans_outer.find('.continue-question-action:last').show();
                        $quesans_outer.find('.single_next_btn:last').show();
                    }
                }else{
                    $quesans_outer.find('.single_next_btn:last').show();
                }
                $quesans_outer.addClass('show_cls').removeClass('hide_cls');
            }
        }
        
        this.setLastScreen = function(){
            
            var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 1000;

            // show the optinform
            //setTimeout(function() {

                if(lesson_id > 0){
                     if(auto_submit_optin == 'Y'){
                        $_self.autoSubmitOptin();
                        return false;
                    }else{
                         $_self.submitQuiz();
                            return false;
                    }
                   
                }

                if(show_optin == 'Y' && opt_screen_position != 'optin-before-questions-screen'){

                    var sqb_points = $this.find('#sqb_points_ans').val();
                    var total_pt = $this.find('#points_count').val();
                    var outcome_names = jQuery('#outcome_id_'+final_outcome).find('#outcome_name').val();
                    var optinhtml =  $this.find(".quiz_optin_template_outer .quiz_comon_template ").html();

                    optinhtml = optinhtml.replace('%%YOURSCORE%%', '<div class="sqb_total_points">'+sqb_points+'</div>');
                    optinhtml = optinhtml.replace('%%TOTALSCORE%%', '<div class="sqb_total_points">'+total_pt+'</div>');
                    optinhtml = optinhtml.replace('%%SCOREINPERCENT%%', '<div class="sqb_total_points">'+this.calculate_percentage(total_pt,sqb_points)+'</div>');

                    var speed_time_spent1 = $this.find('#speed_time_spent1').val();
                    var timer_spent_text = sqbSpeedSecondsToDhms(speed_time_spent1, $this);
                    optinhtml = optinhtml.replace('[SQBTimeSpent]', timer_spent_text);

                    optinhtml = optinhtml.replace('%%OUTCOME_TITLE%%', outcome_names);
                    var first_name = this.getOptinField('first_name');
                    optinhtml = optinhtml.replace('%%FIRST%%', first_name);

                    $this.find(".quiz_optin_template_outer .quiz_comon_template ").html(optinhtml);

                    this.sqbDatePicker();
                    this.sqbIntlTelInput('custom');
                    var fname = jQuery('.sqb_first_name').val();
                    if(show_firstname_outcome == 'Y'){
                        if(fname != '' && fname != undefined){
                            jQuery('#first_name').val(fname);
                        }
                    }

                    if(QfirstName != ''){
                        $this.find('#first_name').val(QfirstName);
                    }
                    
                    this.coreFieldsAutoPopulate();
                    this.customFieldsAutoPopulate();
                    $this.find(".spinner").remove();
                    if(auto_submit_optin == 'Y'){
                        $_self.autoSubmitOptin();
                    }else{
                       
                        $quesans_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                        $optin_outer.addClass('show_cls').removeClass('hide_cls');
                        this.playSilentVideoGlobal($optin_outer);
                        $_self.scrollToAnimate('optin');
                    }
                }else{
                    //$quesans_outer.find('.answer_container').last().addClass('answer_container_disabled');
                    // redirect to outcome
                    $_self.submitQuiz();
                }
            //},timerValue);
        }

        this.showFirstnameScreen = function(){
            if(show_fname_temp == 'Y'){
                var is_fname_screen = $fn_outer.find('.start_temp_outer .Quiz-start-Template5-right .show_first_name_screen_temp ').length;
                if(is_fname_screen < 1){
                    var fname_screen = $this.find('.show_first_name_screen_temp').html();
                    var fname_screen_html = '<div class="show_first_name_screen_temp">'+fname_screen+'</div>';
                    $fn_outer.find('.Quiz-start-Template5-right').html(fname_screen_html);
                }
            }
        }

        this.bindButtonEvent = function(){

            $this.on('click','.single_next_btn_container .single_next_btn, .multi_next_btn_container .single_next_btn' ,function(evt){
                
                //var $iframe = jQuery('.questionTemplateYoutubeVideoOuter iframe');
                var $iframe = jQuery('.quiz_quesans_template_outer .Quiz-Template.show_cls .questionTemplateYoutubeVideoOuter iframe');
                var src = $iframe.attr('src');
                $iframe.attr('src', '');
                $iframe.attr('src', src); 

                var $iframe = jQuery('.quiz_quesans_template_outer .Quiz-Template.show_cls .question_description iframe');
                var src = $iframe.attr('src');
                $iframe.attr('src', '');
                $iframe.attr('src', src);

                if(jQuery(this).closest('.question_container').hasClass('question_type_name')){


                var firstName = jQuery(this).closest('.question_container').find('.sqb_input_ans_field').val();

                if(firstName != ''){
                  
                QfirstName = firstName;

                $quesans_outer.find('.question_container .sql_ans_text').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $quesans_outer.find('.question_container .question_title').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $quesans_outer.find('.question_container .question_description').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $optin_outer.find('.quiz_comon_template').each(function(){
                    var html = jQuery(this).html();
                    jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(html.replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(html.replaceAll('%%NAME%%', firstName));
                });

                $analyzing_outer.find('.analyzing_result_content').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });
                
                //if(show_firstname_outcome == 'Y'){
                    $optin_outer.find('#first_name').val(firstName);
                //}
                $_self.addMergTag('%%FIRST%%',firstName);
                $_self.addMergTag('%%FIRST_NAME%%',firstName); 
                $_self.addMergTag('%%NAME%%',firstName); 
                }               

            }
                if(quiz_pagination == 'all' && (same_page_option == 'no_next_button' || same_page_option == 'category_names')){
                    $_self.processFlatQuiz();
                }else{
                    var question = jQuery(this).closest(".question_container");
                    $_self.processQuestion(question);
                }
            });

            $this.on('click','.pagination-next-btn .single_next_btn' ,function(evt){

                console.log('Next button click');
                var current = $this.find('.sqb-page-numbers .sqb-page-number.active').attr('data-page');
                var total = $this.find('.sqb-page-numbers .sqb-page-number').length;
                var next_page = parseInt(current) + 1;

                if($_self.validatePaginationQuestion(current)){

                    if(current == total){

                        var optin_skip = false;
                        if(show_optin == 'Y' && opt_screen_position != 'optin-before-questions-screen'){
                            optin_skip = true;
                        }

                        $_self.processFlatQuiz(optin_skip);
                        $question = $this.find('.question_container:last');
                        $_self.questionsComplete($question);
                    }else{
                        jQuery('.sqb-page-numbers .sqb-page-number[data-page='+next_page+']').trigger('click');
                    }
    
                }

            });

            

            $this.on('click','.single_back_btn' ,function(evt){
                var question = jQuery(this).closest(".question_container");
                $_self.processBackQuestion(question);
            });

            $this.on('click','.skipped_btn' ,function(evt){
                var question = jQuery(this).closest(".question_container");

                if(jQuery(this).closest('.question_container').hasClass('question_type_name')){


                    var firstName = jQuery(this).closest('.question_container').find('.sqb_input_ans_field').val();
    
                    if(firstName == ''){
                      
                    QfirstName = firstName;
    
                    $quesans_outer.find('.question_container .sql_ans_text').each(function(){
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                    });
    
                    $quesans_outer.find('.question_container .question_title').each(function(){
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                    });
    
                    $quesans_outer.find('.question_container .question_description').each(function(){
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                    });
    
                    $optin_outer.find('.quiz_comon_template').each(function(){
                        var html = jQuery(this).html();
                        jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
                        jQuery(this).html(html.replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(html.replaceAll('%%NAME%%', firstName));
                    });
    
                    $analyzing_outer.find('.analyzing_result_content').each(function(){
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                        jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                    });
                    
                    //if(show_firstname_outcome == 'Y'){
                        $optin_outer.find('#first_name').val(firstName);
                    //}
                    $_self.addMergTag('%%FIRST%%',firstName);
                    $_self.addMergTag('%%FIRST_NAME%%',firstName);
                    $_self.addMergTag('%%NAME%%',firstName);
                }
            }

                $_self.processQuestion(question,'',true);
            });

            $this.on('click','.quiz_start_template_outer .take-quiz-btn' ,function(evt){

                if(anim_effect){
                    const element = $this.find('.quiz_start_template_outer .take-quiz-btn');
                    element.addClass(anim_effect);
                    setTimeout(function() {
                        element.removeClass(anim_effect);
                        $_self.start_quiz();
                    }, 1000);
                }else{
                    $_self.start_quiz();
                }

                var $iframe = jQuery('.startTemplateYoutubeVideoOuter iframe');
                var src = $iframe.attr('src');  // Get the current src
                $iframe.attr('src', '');        // Clear the src to stop the video
                $iframe.attr('src', src); 
                
            });

            if($this.hasClass('popup_popup_sqb')){
                $start_outer.on('click','.take-quiz-btn' ,function(evt){

                    if(anim_effect){
                        const element = $start_outer.find('.take-quiz-btn');
                        element.addClass(anim_effect);
                        setTimeout(function() {
                            element.removeClass(anim_effect);
                            $_self.start_quiz();
                        }, 1000);
                    }else{
                        $_self.start_quiz();
                    }
                    
                });
            }

            $this.on('click','.continue_btn' ,function(e){
                e.preventDefault();

                // Get redirect URL value
                var redirectUrl = jQuery('#sqb_form_type_redirect_url').val();

                // If redirect URL exists, redirect immediately
                if (redirectUrl && redirectUrl.trim() !== '') {
                    window.location.href = redirectUrl;
                    return; // stop further execution
                }
    
                if(quiz_pagination == 'all' && (same_page_option == 'no_next_button' || same_page_option == 'category_names')){
                    $_self.processFlatQuiz();
                }else{
                    $_self.submitOptin();
                }
                
            });

            $this.on('click','.close_Side_Popup' ,function(evt){
                $_self.closePopup(evt);
            });

            $this.on('click','.question_add_answer_outer_div .sqb_ans_item_outer' ,function(evt){
                $_self.setAnswerSelected(this,evt);
            });

            $this.on('focus','.question_add_answer_outer_div .sqb_ans_item_outer .sqb_and_field' ,function(evt){
                $mythis = jQuery(this).closest('.sqb_ans_item_outer');
                $_self.setAnswerSelected($mythis, evt);
            });

            $this.on('click','.outcome_button_pdf',function(evt){
                $_self.sqbQuizPdf();
            });

            $this.on('click','.download_certificate_button',function(evt){
                $_self.sqbQuizCertificatePdf();
            });

            $this.on('click','.sqb-change-vote',function(evt){
                $_self.changeVote();
            });

            $this.on('click','.sqb-view-result',function(evt){
                $_self.viewVoteResult();
            });

            $this.on('click','.sqb-return-poll',function(evt){
                $_self.backToPoll();
            });

            $this.on('click','.result_temp_outer .take-quiz-btn', function() {

                $_self.bindCustomEvent(
                    document.querySelector('.result_temp_outer .take-quiz-btn'),'sqb_contine_click', { 
                        id: $this.attr('id'),
                        quiz_id:quiz_id
                    });

                if (jQuery(this).data('continueurl')) {
                    var continue_url = jQuery(this).attr('data-continueurl');
                    const isIframe = window.top !== window.self;
                    if(isIframe){
                        let a= document.createElement('a');
                        a.target= '_blank';
                        a.href= continue_url;
                        a.click();
                    }else{
                        location.href = continue_url;
                    }
                    return false;
                }
            });

            $this.on('change', '.sqb_question_dropdown' ,function(e){
                if (jQuery(this).val() != ""){
                    jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');  
                } else {
                    jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected'); 
                }
            });

            $this.on('change', '.sqb_file_upload' ,function(e){
                e.stopImmediatePropagation();
            
                var num =  jQuery(this).closest('.file_upload_cls').data("id");  
                var elem = jQuery(this);
                var sqb_quiz_container_outer_id = jQuery(elem).closest('.sqb_quiz_container_outer').attr('id');
                var parent_ques_div =  jQuery(elem).closest('.question_container').attr('id');
                
                jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.correctincorrect_ans_div').hide();
                jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder #'+parent_ques_div).find('.sqb_uploded_filename').remove();
                var data =  jQuery(this).prop("files")[0]; 
                
                var ext = data.name.split('.').pop().toLowerCase();
                var size = data.size;
                var maximum_upload_size = jQuery(this).closest('.file_upload_cls').data("sqb-max-upload-size");
                var maxSize = parseInt(1000000) * parseInt(maximum_upload_size);                        
                var extensionErr = '';
                var sizeErr = '';

                var allowed_types_of_file = jQuery(this).closest('.file_upload_cls').data('allowed-types-of-file');
                if(typeof allowed_types_of_file != undefined && allowed_types_of_file != ''){
                    var newFileTypes = allowed_types_of_file.split(',');
                    if (jQuery.inArray(ext, newFileTypes) != -1){
                        
                    } else {
                        extensionErr = allowed_types_of_file;
                    }
                }else{
                    extensionErr = 'allowed_types_of_file'; 
                }

                if(extensionErr != ''){
                    jQuery(this).closest('.file_upload_cls').removeClass('sqb_ans_selected');
                    jQuery(this).val('');
                    jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<b><div class="in_correct_ans correctincorrect_ans_div">'+jQuery('#file_upload_failed_message').val()+'</b></div>');
                    return false;
                }
                
                if(size > maxSize){
                    jQuery(this).closest('.file_upload_cls').removeClass('sqb_ans_selected');
                    jQuery(this).val('');
                    jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#upload_filesize_limit_exceeds_message').val()+'</b></div>');
                    return false;
                }
                
                jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .sqb_uploded_filename').remove();
                var uploaded_filename_text = jQuery('#uploaded_filename_text').val();
                if(jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').parent('.back-next-btn').length > 0){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').parent('.back-next-btn').before('<div class="sqb_uploded_filename"><b>'+uploaded_filename_text+' '+data.name+'</b></div>');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' #'+parent_ques_div+' .file_upload_button ').before('<div class="sqb_uploded_filename"><b>'+uploaded_filename_text+' '+data.name+'</b></div>');
                }
                return;
                
            });
            
            
            $this.on('click','.sqb_quiz_container .single_cls' ,function(evt){
                if($_self.isQuiz('poll')) {
                    if($this.find('.sqb_ans_item_outer.sqb_ans_selected').length > 0){
                        $this.find('.btn-add-vote').removeAttr('disabled');
                        $this.find('.btn-add-vote').removeClass('sqb-btn-disable');
                    }
                }else{
                    if(show_next_button != 'Y' && quiz_pagination != 'question_on_category' && quiz_pagination != 'fixed_number'){
                        var question = jQuery(this).closest(".question_container");
                        if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
                            var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
                            jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
                            return false;
                        }else{
                            jQuery(this).closest('.question_type_single').find('.single_next_btn').hide();
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
                        }
                        //console.log(quiz_pagination);
                        if(quiz_pagination == 'one_per_page'){
                            var $iframe = jQuery('.quiz_quesans_template_outer .Quiz-Template.show_cls .questionTemplateYoutubeVideoOuter iframe');
                            var src = $iframe.attr('src');
                            $iframe.attr('src', '');
                            $iframe.attr('src', src);

                            var $iframe = jQuery('.quiz_quesans_template_outer .Quiz-Template.show_cls .question_description iframe');
                            var src = $iframe.attr('src');
                            $iframe.attr('src', '');
                            $iframe.attr('src', src);
                        }
                        
                        $_self.processQuestion(question);
                    }else{
                        if(jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').show();
                            var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').attr('placeholder', placeholder);
                            jQuery(this).closest('.question_type_single').find('.single_next_btn').show();
                        }else{
                            jQuery(this).closest('.question_type_single').find('.custom-other-box').hide();
                        }
                    }


                }
            });

            $this.on('click','.sqb_quiz_container .multiple_cls' ,function(evt){
                if($_self.isQuiz('poll')) {
                    $this.find(".sqb_ans_item_outer input.sqb_and_field:checked");
                    if($this.find('.sqb_ans_item_outer.sqb_ans_selected').length > 0 && $this.find(".sqb_ans_item_outer input.sqb_and_field:checked").length > 0){
                        $this.find('.btn-add-vote').removeAttr('disabled');
                        $this.find('.btn-add-vote').removeClass('sqb-btn-disable');
                    }else{
                        $this.find('.btn-add-vote').addClass('sqb-btn-disable');
                       // $this.find('.btn-add-vote').attr('disabled', true);
                    }
                }
                
                if(jQuery(this).find(".custom-checkbox-input").prop('checked') == true && jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
                    jQuery(this).closest('.question_type_multi').find('.custom-other-box').show();
                    var placeholder = jQuery(this).find('.please-elaborate').attr('placeholder');
                    jQuery(this).closest('.question_type_multi').find('.custom-other-box').attr('placeholder', placeholder);
                }else if(jQuery(this).find(".custom-checkbox-input").prop('checked') == false && jQuery(this).find('.custom-checkbox-input').hasClass('custom_other_box')){
                    jQuery(this).closest('.question_type_multi').find('.custom-other-box').hide();
                }
            });

            $this.on('keyup','.sqb_first_name',function(evt){
                if(jQuery(this).val() != ''){
                    $fn_outer.find('.firstname_ok_btn').show();
                }else{
                    $fn_outer.find('.firstname_ok_btn').hide();
                }
            });

            $this.on('click', '.firstname_ok_btn',function(evt){
                var firstName = $this.find('.sqb_first_name').val();
                if(firstName == '')
                    return false;
                
                $quesans_outer.find('.question_container .sql_ans_text').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $quesans_outer.find('.question_container .question_title').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $quesans_outer.find('.question_container .question_description').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });

                $optin_outer.find('.quiz_comon_template').each(function(){
                    var html = jQuery(this).html();
                    jQuery(this).html(html.replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(html.replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(html.replaceAll('%%NAME%%', firstName));
                });

                $analyzing_outer.find('.analyzing_result_content').each(function(){
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstName));
                    jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstName));
                });
                
                if(show_firstname_outcome == 'Y'){
                    $optin_outer.find('#first_name').val(firstName);
                }
                $_self.addMergTag('%%FIRST%%',firstName);
                $_self.addMergTag('%%FIRST_NAME%%',firstName);
                $_self.addMergTag('%%NAME%%',firstName);
                $_self.setFirstScreen('N','before-optin');
            });

            $this.on('click', '.quiz_ans_recommendation_html .sqb_cr_next_btn_div .sqb_next_btn',function(evt){
                var ans_attr_id = jQuery(this).closest('.sqb_cr_next_btn_div').attr('data-ans-attr-id');
                if(quiz_pagination != 'all'){
                    var $ans_recommend_outer = $this.find('.ans_recommendation_show');
                    var $answer_item = $ans_recommend_outer.find('.sqb_ans_item[id="'+ans_attr_id+'"]');
                    if($answer_item.length != 0){
                        //$answer_item.closest('.ans_recommendation_show').removeClass('sqb_ans_selected');
                        $answer_item.closest('.Quiz-Template-overflow').show();
                        jQuery(this).closest('.quiz_ans_recommendation_html').hide();
                        jQuery(this).closest('.quiz_ans_recommendation_html').closest('.Quiz-Template').removeClass('ans-recommendation-active');
                        var $question = jQuery(this).closest(".Quiz-Template").find(".question_container");
                        $_self.processQuestion($question,'yes');
                    }
                }
            });

            $this.on('click', '.quiz_ans_a_d_html_outer .sqb_next_btn',function(evt){
                var $question = jQuery(this).closest(".Quiz-Template").find(".question_container");
                $_self.processQuestion($question,'yes');
            });

            $this.on('click', '.sqb_player_audio', function(evt){
                if (this.paused == false) {
                    this.pause();
                } else {
                    this.play();
                }
            });

            $this.on('change', '#select_question_id' , function(evt){
                var question_id = jQuery(this).val();
                var chart_type = jQuery(this).closest('#question_answer_chart').attr('data-chart');
                $_self.refreshQuesitonBarChart(question_id, chart_type);
            });

            $this.on('click', '.retake_button' , function(evt){
                $_self.retakeQuiz();
            });

            $this.on('click', '.sqb_social_share_next_btn' , function(evt){
                $this.find('.quiz_social_share_template_outer').addClass('hide_cls').removeClass('show_cls');
                $_self.renderOutcome('');
            });

            $this.on('click', '.file_upload_button' , function(evt){
                $question = jQuery(this).closest(".question_container");
                $_self.fileUpload($question);
            });

            window.addEventListener('resize', function(event) {
                $_self.setFullwidth();
            });

            $this.on('click','.sqb-match-box', function () {

                if(jQuery(this).children('.sqb-match-item').length > 0){
                    var id = jQuery(this).children('.sqb-match-item').attr('data-index');
                    var html = jQuery(this).html();
                    jQuery(this).html('');
                    jQuery(this).closest('.question_type_matching_text').find('#sqb-match-'+id).html(html);
                    
                    jQuery(this).droppable( 'enable' );
                    var question_wrapper = jQuery(this).closest('.question_type_matching_text');
                    $_self.sqbDraggable();
                    var is_validate = true;
                    jQuery(question_wrapper).find('.sqb_input_ans_field .drag-container').each(function(){
                        
                        if(jQuery(this).find('.sqb-match-box .sqb-match-item').length < 1){
                            is_validate = false;
                        }
                    });
                
                    if(is_validate){
                        jQuery(question_wrapper).find('.sqb_ans_item_outer').addClass('sqb_ans_selected');
                        jQuery(question_wrapper).removeClass('disable_nextbutton');
                    }else{
                        jQuery(question_wrapper).find('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
                        jQuery(question_wrapper).addClass('disable_nextbutton');
                    }
                }
            });

            $this.on('click','.skip_optin', function () {
                skip_optin = true;
                if(opt_screen_position == 'optin-before-questions-screen'){
                    $optin_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                    $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                }else{
                    $_self.saveQuizData(true);
                }
                
            });

            $this.on('click','.quiz-Facebook-btn', function(evt){
                evt.stopImmediatePropagation();
                FB.init({ 
                    appId: jQuery("#social_share_fb_api_key").val(),
                    autoLogAppEvents : true,
                    xfbml            : true,
                    version          : 'v9.0'
                });
                evt.preventDefault();

                $_self.shareFacebook();
            });

            $this.on('click','.quiz-twitter-btn', function(evt){
                $_self.shareTwitter();
            });

            $this.on('click','.buttondata_outer.multiple_ques_true .dap_see_details_btn' ,   function(evt){
                
                var sqb_quiz_container_outer_id = $this.attr('id');
                var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val(); 
                

                var leads_total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val(); 
                var count_manage_lead_data = jQuery('#'+sqb_quiz_container_outer_id+ ' #count_manage_lead_data').val(); 
                var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();   
                var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val();
                var sqb_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_retake').val();
                var show_result_screen =jQuery('#'+sqb_quiz_container_outer_id+ ' #show_result_screen').val();
                var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
                var quiz_pagination =jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
                var quiz_attempts_allowed =jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_attempts_allowed').val();
                
                //add disable class to answers, after they click  on button         
                jQuery('#'+sqb_quiz_container_outer_id+ ' .answer_container').each(function(){
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .answer_container').addClass("answer_container_disabled"); 
                });
        
                if(quiz_pagination =="all"){         
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .Quiz-Template').last().removeClass('show_cls').addClass('hide_cls');
                }

                lesson_id = jQuery.isNumeric(lesson_id);    

                if( lesson_id !="" && lesson_id == true){   
                        
                    if( count_manage_lead_data > 0 && sqb_retake  == "n"  && quiz_attempts_allowed != "unlimited" ){
                        if(show_result_screen =="N"){
                        }else{
                            // display ques-ans in result page
                            if(display_correctans_options == "both" || display_correctans_options == "result_page"){
                                $this.find('.question_container').each(function(index){
                                    $question = jQuery(this);
                                    $_self.showQuesAnsResults($question);   
                                });
                                $_self.printAnswerResults();
                            }
                            var outcomedata = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer1 .outcome_div_lesson').html(); 
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .pagination_all_div .multiple_ques_true' ).after(outcomedata);
                            
                        } 
                    }else{
                        $question = $this.find('.question_container:last');
                        $_self.questionsComplete($question);
                    }
                         
                }

            });                         


            jQuery(document).on('keyup change', '  .sqb_quiz_container  input.sqb_and_field ,   .sqb_quiz_container  textarea.sqb_and_field  ' ,function(evt){
                var parent_ques_div =  jQuery(this).closest('.question_container').attr('id');
                var allow_skip_ques =   $this.find("#"+parent_ques_div+"  .allow_skip_ques").val();
                if(allow_skip_ques =="Y"){
                }else{
                    if(!jQuery(this).closest(".question_container").hasClass('question_type_phone_number')){
                        if(jQuery(this).val() != ""){
                            $this.find('#'+parent_ques_div).removeClass('disable_nextbutton');
                        }else{
                            $this.find('#'+parent_ques_div).addClass('disable_nextbutton');
                        }
                    }
                }
            });

            $this.on('click','.sqb-page-number' ,function(evt){

                var currentPage = jQuery(this).attr('data-page');
                $_self.navigateTo(currentPage);
            });

            $this.on('click','.sqb-cate-anchor-link' ,function(evt){
                var page = jQuery(this).attr('data-alink');
                var target = $this.find('.quiz_quesans_template_outer  .Quiz-Template.page-'+page+':first');
                jQuery('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
            });

            $this.on('click touchstart','.vjs-big-play-button',function(evt){
          
               var vid_id = jQuery(this).closest('.video-js').attr('id');
               jQuery(this).hide();
               jQuery(this).closest('.video-js').find('.btn-click-unmute').hide();
               videojs.getPlayer(vid_id).muted(0);
               
               jQuery(this).closest('.video-js').find('.vjs-loading-spinner').addClass('vjs-loading-spinner-hide');
               if(jQuery(this).closest('.video-js').hasClass('play-slient')){
                    video1 = document.getElementById(vid_id+"");
                    video1.currentTime = 0;
                    video1 = document.getElementById(vid_id+"_html5_api");
                    video1.currentTime = 0;
               }
              
               jQuery(this).closest('.video-js').removeClass('play-slient');
            });

            $this.on('click touchstart','.btn-click-unmute',function(evt){
                var vid_id = jQuery(this).closest('.video-js').attr('id');
                //videojs.getPlayer(vid_id).muted(0);
                setTimeout(() => {
                    videojs.getPlayer(vid_id).play();
                }, 200);
                
                jQuery(this).closest('.video-js').find('.vjs-big-play-button').trigger('click');
                jQuery(this).hide();
            });
        };

        this.getCustomMessage = function($question,type){

            var msg = $question.find('.'+type+'_answer_msg').val(); 
            if(msg == ""){
                var msg = $this.find('#common_'+type+'_msg').val();             
            }
            return msg;
        }

        this.showCorrectAnswer = function($question){

            var correct_ans_count = $this.find('#sqb_correct_ans').val();   
            var correct_answer_msg = this.getCustomMessage($question,'correct');
            var incorrect_answer_msg = this.getCustomMessage($question,'incorrect');
            var isShow = false;

            if(quiz_pagination == 'fixed_number' && quiz_pagination == 'fixed_number'){
                var hascorrect_ans = $question.find(".correct_ans_cls").hasClass('sqb_ans_selected');
            }else{
                var hascorrect_ans = $question.find(".correct_ans_cls").hasClass('addselected');
            }
           
            if(this.isQuiz('scoring') || this.isQuiz('assessment')){
                var correct = true;
                var skip = true;
                var isFirst = $question.find('.sqb_quiz_next_button_click').val();
                if(isFirst == 0){
                    if(correct_ans_opt == "each_page" || correct_ans_opt == "both"){
                        isCorrectShow = true;
                        if(this.isQuestionType('numeric_text_cls',$question)){
                            skip = false;
                            var data_correct_value = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
                            var input_text_num = $question.find(".sqb_ans_item_outer .sqb_and_field").val();
                            if(input_text_num == data_correct_value){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }else if(this.isQuestionType('name_cls',$question)){
                            correct = true;
                            
                        }else if(this.isQuestionType('matching_text',$question)){
                            this.isSentenceMatch($question);
                            skip = false;
                            if($question.find(".sqb_ans_item_outer .sqb_input_ans_field").find('.sentence-not-matched').length > 0){
                                correct = false;
                            }else{
                                correct = true;
                            }
                        }else if(this.isQuestionType('multiple_cls',$question)){
                            skip = false;
                            var hascorrect_count = $question.find(".sqb_ans_item_outer.correct_ans_cls").length;
                            var hascorrect_checkbox_count = $question.find(".sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
                            var total_checked = $question.find(".sqb_ans_item_outer .checkbox_fe:checked").length;
                                
                            if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }else if(this.isQuestionType('slider_cls',$question) || this.isQuestionType('text_cls',$question) || this.isQuestionType('matrix_cls',$question) || this.isQuestionType('date_cls',$question) || this.isQuestionType('dropdown_cls',$question) || this.isQuestionType('email_cls',$question) || this.isQuestionType('phone_number_text_cls',$question) || this.isQuestionType('weight_and_height_cls',$question)){
                            skip = true;
                        }else{
                            skip = false;
                            if(hascorrect_ans == true){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }

                        quest_id = $question.attr('data-question-id');
                        if(correct == true && skip == false){
                            var correct_ans_count = parseInt(correct_ans_count) + 1;
                            $this.find('#sqb_correct_ans').val(correct_ans_count);
                            $corr_qa[quest_id] = 1;
                            this.correctmsg_display(correct_answer_msg,$question);
                        }else if(correct == false && skip == false){
                            $corr_qa[quest_id] = 0;
                            this.incorrectmsg_display(incorrect_answer_msg,$question);
                        }else{
                            isCorrectShow = false;
                        }
                        $question.find('.sqb_quiz_next_button_click').val(1);
                    }else if(correct_ans_opt == "result_page" || correct_ans_opt == "no"){

                        if(this.isQuestionType('numeric_text_cls',$question)){
                            skip = true;
                            var data_correct_value = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
                            var input_text_num = $question.find(".sqb_ans_item_outer .sqb_and_field").val();
                            if(input_text_num == data_correct_value){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }else if(this.isQuestionType('matching_text',$question)){
                            this.isSentenceMatch($question);
                            skip = true;
                            if($question.find(".sqb_ans_item_outer .sqb_input_ans_field").find('.sentence-not-matched').length > 0){
                                correct = false;
                            }else{
                                correct = true;
                            }
                        }else if(this.isQuestionType('multiple_cls',$question)){
                            skip = true;
                            var hascorrect_count = $question.find(".sqb_ans_item_outer.correct_ans_cls").length;
                            var hascorrect_checkbox_count = $question.find(".sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
                            var total_checked = $question.find(".sqb_ans_item_outer .checkbox_fe:checked").length;
                                
                            if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }else if(this.isQuestionType('slider_cls',$question) || this.isQuestionType('name_cls',$question) || this.isQuestionType('text_cls',$question) || this.isQuestionType('matrix_cls',$question) || this.isQuestionType('date_cls',$question) || this.isQuestionType('dropdown_cls',$question) || this.isQuestionType('email_cls',$question) || this.isQuestionType('phone_number_text_cls',$question) || this.isQuestionType('weight_and_height_cls',$question)){
                            skip = true;
                        }else{
                            skip = true;
                            if(hascorrect_ans == true){
                                correct = true;
                            }else{
                                correct = false;
                            }
                        }

                        quest_id = $question.attr('data-question-id');
                        if(correct == true){
                            var correct_ans_count = parseInt(correct_ans_count) + 1;
                            $this.find('#sqb_correct_ans').val(correct_ans_count);
                            $corr_qa[quest_id] = 1;
                        }else if(correct == false){
                            $corr_qa[quest_id] = 0;
                        }else{
                            isCorrectShow = false;
                        }

                    }
                }
            }
            
            return skip;
        }
        this.fileUpload = function($question){
            
            var parent_ques_div =  $question.attr('id');
            var question_id = $this.find("#"+parent_ques_div).data("question-id");
            $fileuploadbtn = $question.find('.file_upload_button');
            var input_type = $this.find('.Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]');
            var data = $this.find('.Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').prop("files")[0];
            
            var fd = new FormData();
            var files = jQuery(input_type)[0].files;
            if(files.length > 0 ){

                $fileuploadbtn.css("pointer-events","none");
                var next_btn_text = $fileuploadbtn.html();
                $fileuploadbtn.html('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');
                
                fd.append('file',files[0]);
                fd.append('action','sqb_save_question_file_upload');
                fd.append('question_id',question_id);
                var ajaxurl = jQuery('#sqb_ajaxurl').val(); 
                jQuery.ajax({
                    url: ajaxurl,
                    method: 'POST',
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        var file_uploded = false;
                        var data = jQuery.parseJSON(response);
                        if(data.fileStatus){
                            $this.find('#'+parent_ques_div).find('.file_upload_cls').attr('data-fileurl',data.fileUrlArr[0]);
                            $this.find('#'+parent_ques_div).find('.file_upload_cls').css("pointer-events","none");

                            if($fileuploadbtn.parent('.back-next-btn').length > 0){
                                $fileuploadbtn.parent('.back-next-btn').before('<div class="correctincorrect_ans_div file_uploaded_message_div"><b>'+jQuery('#file_uploaded_message').val()+'</b></div>');
                            }else{
                                $fileuploadbtn.before('<div class="correctincorrect_ans_div file_uploaded_message_div"><b>'+jQuery('#file_uploaded_message').val()+'</b></div>');
                            }
                            
                            if($question.find('.file_uploaded_message_div').length > 1){
                                $question.find('.file_uploaded_message_div').hide();
                                $question.find('.file_uploaded_message_div').first().show();
                            }
                            $fileuploadbtn.html(next_btn_text);
                            $fileuploadbtn.hide().next().show();
                        } else {
                            if(data.error != ''){
                                if(data.error =='file_extension_err'){
                                    if($fileuploadbtn.parent('.back-next-btn').length > 0){
                                        $fileuploadbtn.parent('.back-next-btn').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#file_upload_failed_message').val()+'</b></div>');
                                    }else{
                                        $fileuploadbtn.before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#file_upload_failed_message').val()+'</b></div>');
                                    }
                                }
                                if(data.error =='file_size_err'){
                                    if($fileuploadbtn.parent('.back-next-btn').length > 0){
                                        $fileuploadbtn.parent('.back-next-btn').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#upload_filesize_limit_exceeds_message').val()+'</b></div>');
                                    }else{
                                        $fileuploadbtn.before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+jQuery('#upload_filesize_limit_exceeds_message').val()+'</b></div>');
                                    }
                                }
                            }
                            jQuery(input_type).val('');
                            $this.find('#'+parent_ques_div).find('.file_upload_cls').css("pointer-events","auto");
                            $fileuploadbtn.css("pointer-events","auto");
                            $fileuploadbtn.html(next_btn_text);
                            return false;
                        }
                    },
                    error: function (e) {
                    
                    }
                });
            } else {
                var allow_skip_ques =  $question.find(".allow_skip_ques").val();
                if(allow_skip_ques == 'Y'){
                    $fileuploadbtn.hide().next().show().trigger('click');
                } else {
                    $question.find('.sqb_uploded_filename').remove();
                    $question.find('.correctincorrect_ans_div').remove();
                    var incorrect_answer_msg = $this.find('#file_upload_validation').val();
                    var sqb_quiz_container_outer_id = $this.attr('id');
                    this.incorrectmsg_display(incorrect_answer_msg, sqb_quiz_container_outer_id, parent_ques_div);
                }
            }
        }

        this.replaceMergeTags = function(outcome_id){
            
            var outcome_names = jQuery('outcome_id'+outcome_id).find('#outcome_name').val();
            if(outcome_names == undefined){
                var outcome_name = '';
            }else{
                var outcome_name = outcome_names;
            }

            var sqb_points_ans = $this.find('#sqb_points_ans').val();
            var total_pt = $this.find('#points_count').val();
            var total_ques = $this.find('#ques_count').val();
            var sqb_correct_ans = $this.find('#sqb_correct_ans').val();
            var speed_time_spent1 = $this.find('#speed_time_spent1').val();
            var timer_spent_text = sqbSpeedSecondsToDhms(speed_time_spent1, $this);

            var sqb_points_ans_percent = (Math.round(sqb_points_ans * 100) / total_pt).toFixed(2);
            this.addMergTag('%%OUTCOME_TITLE%%',outcome_name);
            this.addMergTag('%%TOTALSCORE%%',total_pt);
            this.addMergTag('%%YOURSCORE%%',sqb_points_ans);
            this.addMergTag('%%SCOREINPERCENT%%',sqb_points_ans_percent);
            this.addMergTag('[SQBTimeSpent]',timer_spent_text);
            this.addMergTag('%%CORRECTANSWERS%%',sqb_correct_ans);
            this.addMergTag('%%TOTALQUESTIONS%%',total_ques);
            this.addMergTag('%%INCORRECTANSWERS%%',parseInt(total_ques) - parseInt(sqb_correct_ans));
            
            this.addMergTag('[SELECTEDANSWERS]',this.printSelectedAnswers());

            var avg = 0;
            var per = 0;
            var pern = 0;
            if(this.isQuiz('scoring')){
                avg = this.calculate_average(sqb_points_ans,total_ques);
                per = this.calculate_percentage(total_pt,sqb_points_ans);
            }else if(this.isQuiz('assessment')){
                avg = this.calculate_average(total_ques,total_pt);
                per = this.calculate_percentage(total_ques,total_pt);
                pern = this.calculate_percentage(total_ques,sqb_correct_ans);
            }

            this.addMergTag('[AVERAGE_SCORE]',avg);
            this.addMergTag('%%SCOREINPERCENT%%',per);
            this.addMergTag('%%SCORE%%',pern);


            var matrix_total_cheked_values = $this.find('.matrix_values_added .sqb_and_field.matrix_answer_value:checked').length;
            var sum_of_values = 0;
            $this.find('.matrix_values_added .sqb_and_field.matrix_answer_value:checked').each(function(index){
                sum_of_values += parseInt(jQuery(this).attr('data-assigned-value'));    
            });
            var average_matrix_values = sum_of_values/matrix_total_cheked_values;
            this.addMergTag('[AVGMATRIXVALUE]','<div class="sqb_average_matrix_value">'+average_matrix_values.toFixed(2)+'</div>');
            this.addMergTag('[TOTALMATRIXVALUE]','<div class="sqb_total_matrix_value">'+sum_of_values+'</div>');  

            if(show_fname_temp != 'Y'){
            var first_name = this.getOptinField('first_name');
                if(first_name != '' && first_name != undefined){
                    this.addMergTag('%%FIRST%%',first_name);
                    this.addMergTag('%%FIRST_NAME%%',first_name);
                    this.addMergTag('%%NAME%%',first_name);
                }
            }
            if(this.isCategory()){
                this.categoryMergeTag(outcome_id);
            }

            var tmp_html = $outcome_outer.html();
            if(merge_tags.length > 0){
                jQuery.each( merge_tags, function( key, el ) {
                   tmp_html = tmp_html.replaceAll(el['key'], el['value']);
                });
            }

            $outcome_outer.html(tmp_html);
        }

        this.categoryMergeTag = function(outcome_id){
            var cat_html = '';
            var cat_html1 = '';
            var cat_html2 = '';
            var cat_html3 = '';
            var cat_total_html = '';
            var cat_total_html2 = '';
            var cat_total_val = 0;
            var cat_total_per = 0;
            var maxcatval1 = 0;
            var cat_list = $this.find('input[name="category_list_json"]').val();
            if(cat_list != ''){
                cat_list = JSON.parse(cat_list);
                
                jQuery.each(cat_ids,function(index, value){                   
                    if(cat_list[index]){
                        var maxcatval = eachcat_ids[index];
                        var cat_get_value = cat_ids[index];

                        maxcatval1 = maxcatval1 + maxcatval ;
                        cat_total_per = (parseFloat(cat_get_value)/parseFloat(maxcatval)*100).toFixed(2);
                        
                        if(cat_total_per < 1){
                            cat_total_per =0;
                        }

                        if(typeof maxcatval  == 'undefined'){
                            maxcatval = 0;
                        }
                                              
                        if($_self.isInteger(maxcatval) ==true){
                            maxcatval = parseInt(maxcatval); 
                        }else{
                            maxcatval = 0;
                        }
                        if($_self.isInteger(cat_total_per) ==true){
                            cat_total_per = parseInt(cat_total_per); 
                        }

                        cat_total_val = parseFloat(cat_total_val)+parseFloat(cat_get_value);

                        if(cat_get_value > 0){
                            cat_html += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span>'+cat_get_value+' ('+cat_get_value+'/'+maxcatval+')</span></div>';
                            cat_html1 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span>'+cat_total_per+'%  ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
                            cat_html2 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span>'+cat_total_per+'% </span></div>'; 
                            cat_html3 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span>'+cat_total_per+'% </span></div>'; 
                            
                        }else{
                            cat_html += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span> '+cat_get_value+'  ('+cat_get_value+'/'+maxcatval+')</span></div>';
                            cat_html1 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span> 0% ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
                            cat_html2 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span> 0% </span></div>'; 
                            cat_html3 += '<div class="cat-details-row"><label><b>'+cat_list[index]+'</b> : </label><span> 0% </span></div>'; 
                        }

                        var lbl = cat_total_per+'%';
                        var lbl_per = cat_total_per;
                        if(category_per != 'Y'){
                            lbl = cat_get_value+' / '+ maxcatval;
                            lbl_per = cat_get_value;
                        }
                        
                        
                        cat_chart['labels'][index] = cat_list[index]+ ' ('+lbl+')';
                        cat_chart['data'][index]= lbl_per.toString();
                        if(category_per != 'Y'){
                            cat_chart['labels_spider'][index] = cat_list[index]+ ' ('+cat_get_value+')';
                            cat_chart['data_spider'][index]= cat_get_value.toString();
                        }else{
                            cat_chart['labels_spider'][index] = cat_list[index]+ '';
                            cat_chart['data_spider'][index]= cat_total_per.toString();
                            
                        }
                        
                    }
                });

               
                var total_text = $this.find('input[name="sqb_cat_total_text"]').val();
                if(cat_total_val > 0){
                    var get_percent = (Math.round(cat_total_val * 100) / maxcatval1).toFixed(2);
                    cat_total_html = '<div class="cat-details-row cat-details-total"><label><b>'+total_text+'</b></label><span>'+get_percent+'% ('+cat_total_val+'/'+maxcatval1+')</span></div>';
                    cat_total_html2 = '<div class="cat-details-row cat-details-total"><label><b>'+total_text+'</b></label><span>'+get_percent+'% </span></div>';
                }
                cat_html = cat_total_html+cat_html;
                cat_html1 = cat_total_html+cat_html1;
                cat_html2 = cat_total_html2+cat_html2;

                this.addMergTag('[SHOW_CATEGORY_TOTAL]', '<div class="sqb_category_details sqb_category_overall">'+cat_html+'</div>');
                this.addMergTag('[CATEGORY_TOTAL_NUMBER]', '<div class="sqb_category_details category_number_div">'+cat_html+'</div>');
                this.addMergTag('[CATEGORY_TOTAL_PERCENT]', '<div class="sqb_category_details category_number_percent">'+cat_html1+'</div>');
                this.addMergTag('[CATEGORY_ONLY_PERCENT]', '<div class="sqb_category_details category_only_percent">'+cat_html2+'</div>');
                this.addMergTag('[CATEGORY_SCORE_BREAKDOWN_INPERCENT]', '<div class="sqb_category_details category_score_breakdown_inpercent">'+cat_html3+'</div>');
                this.addMergTag('%%SHOW_CATEGORY_TOTAL%%', '<div class="sqb_category_details">'+cat_html+'</div>');
                $this.find(".category_number_percent_co").html(cat_html1);


                this.categoryRankShortcode();

                var $outcome = jQuery('#outcome_id_'+outcome_id);
                var outcome_html = $outcome.html();
                var catdesc = this.categoryScoreShortcode(outcome_html,cat_ids);
                $outcome.html(catdesc);

                $outcome.find('.ShowCategoryScore').each(function(){

                    var cattextNew = jQuery(this).html();
                    cattextNew = cattextNew.replaceAll( "&amp;",'&');
                    jQuery.each(eachcat_ids,function(index, value){
                        var cat_name = cat_list[index];
                        var cat_max_val = cat_ids[index];
                        cattextNew = cattextNew.replaceAll('–','-');
                        cattextNew = cattextNew.replaceAll( "%%YOUR_SCORE_CATEGORY_"+cat_name+"%%",cat_max_val);
                        cattextNew = cattextNew.replaceAll( "%%TOTAL_SCORE_CATEGORY_"+cat_name+"%%",value);
                    });
                    cattextNew = cattextNew.replaceAll( /%%YOUR_SCORE_CATEGORY_[a-zA-Z0-9_ ]{1,}%%/g,'<i>This is a invalid category</i>');
                    cattextNew = cattextNew.replaceAll( /%%TOTAL_SCORE_CATEGORY_[a-zA-Z0-9_ ]{1,}%%/g,'<i>This is a invalid category</i>');
                
                    jQuery(this).html(cattextNew);
                });
            }
        }

        this.isInteger = function(value){
            if ((undefined === value) || (null === value)) {
                return false;
            }
            return value % 1 == 0;
        }

        this.categoryScoreShortcode = function(co,cat_ids) {
            return co.replaceAll(/\[ShowCategoryScoreJS([^]*?)?\](?:([^]+?)?\[\/ShowCategoryScoreJS\])?/g, function(a,b,c) {               
                b = b.replaceAll('”','');
                b = b.replaceAll('″','');
                var arr = b.replace(/['"]/g,'').split(' ');
                var params = new Object();
                for (var i=0;i<arr.length;i++){
                    var p = arr[i].split('=');
                    params[p[0]] = p[1];
                }
                
                var id = params['id'];
                var value = cat_ids[id];
                var score = parseFloat(value);
            
                var range = params['range'].split(',');
                if ( score >= parseFloat(range[0]) && parseFloat(score) <= range[1]){
                    return '<div class="ShowCategoryScore" id="sss_content_'+id+'">'+c+'</div>';
                }
                return '<div class="ShowCategoryScore no-content" id="sss_content_'+id+'"></div>';
            });
            }

        this.showCategoryBreakdown = function(outcome_id,data){
            if(data.cat_breakdown != undefined && data.cat_breakdown.length > 0 && $this.find('#outcome_id_'+outcome_id+' .category-breakdown-append').length > 0){
                jQuery.each(data.cat_breakdown, function(index, value) {
                    value = value.replace(/\\/g, '');
                    $this.find('#outcome_id_'+outcome_id+' .category-breakdown-append').eq(index).html(value);
                    
                });
                //$this.find('.category-breakdown-append').html(data.cat_breakdown);
            }
        }

        this.showConditionalTags = function(outcome_id,data){
            if(data.conditional_tags.length > 0){
                jQuery.each(data.conditional_tags, function(index, value) {
                    value = value.replace(/\\/g, '');
                    $this.find('#outcome_id_'+outcome_id+' .contional-tags-breakdown-append').eq(index).html(value);
                    
                });

                $this.find('#outcome_id_'+outcome_id+' .contional-tags-breakdown-append').each(function(){
                    if(jQuery(this).html() == ''){
                        jQuery(this).addClass('sqb-empty-tab-box');
                    }
                });

                
            }else{
                $this.find('.contional-tags-breakdown-append').html('');
            }
              
            /*if(data.conditional_tags != undefined && $this.find('.contional-tags-breakdown-append').length > 0){
                $this.find('.contional-tags-breakdown-append').html(data.conditional_tags);
            }*/
        }

        this.showOutcomeChart = function(outcome_id,data){
            
            if($this.find('#outcome_screen_charts_settings').length > 0){
                var charts_settings = decodeURIComponent($this.find('#outcome_screen_charts_settings').val());
                var params = charts_settings.split('|');

                if(params[6] != 'Y'){
                    return;
                }

                var chart_type = params[15];

                if(params[15] != '' && params[15] == 'outcome_based'){
                    spider_chart_shortcode = '[OUTCOME_SPIDER_CHART]';
                    bar_chart_shortcode = '[OUTCOME_BAR_CHART]';
                    pie_chart_shortcode = '[OUTCOME_PIE_CHART]';
                }

                if(params[15] != '' && params[15] == 'category_based') {
                    spider_chart_shortcode = '[CATEGORY_SPIDER_CHART]';
                    bar_chart_shortcode = '[CATEGORY_BAR_CHART]';
                    pie_chart_shortcode = '[CATEGORY_PIE_CHART]';
                }

                if(params[15] != '' && params[15] == 'outcome_ranking') {
                    spider_chart_shortcode = '[PERSONALITY_SPIDER_CHART]';
                    bar_chart_shortcode = '[PERSONALITY_BAR_CHART]';
                    pie_chart_shortcode = '[PERSONALITY_PIE_CHART]';
                }
                
                var $outcome_container = $this.find('#outcome_id_'+outcome_id).find('#result_temp_btnid');
                
                var outcome_html = $this.find('#outcome_id_'+outcome_id).html();

                if(params[1] == 'outcome_bar_chart' && outcome_html.indexOf(bar_chart_shortcode) == -1){

                    var barChartHeading = '';

                    if(!this.isCategory() && (this.isQuiz('scoring') || this.isQuiz('assessment'))){
                        if(params[20] != ''){
                            barChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[20] + '</div>';
                        }
                    }else if(!this.isQuiz('personality') && !this.isQuiz('scoring') && !this.isQuiz('assessment')){
                        if(params[20] != ''){
                            barChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[20] + '</div>';
                        }
                    }else{

                        if(params[15] != '' && params[15] == 'outcome_based'){
                            if(params[23] != '' && params[23] != undefined){
                                barChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[23] + '</div>';
                            }else{
                                barChartHeading = '<div style="text-align: center;"><span style="font-size: 14pt;"><strong>Cumulative Quiz Results</strong></span><br><span style="font-size: 14pt;">The bar chart displays the aggregated results of all users who have taken this quiz.</span></div>';
                                /*if(params[20] != ''){
                                    barChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[20] + '</div>';
                                }*/
                            }
                        }else{
                            if(params[20] != ''){
                                barChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[20] + '</div>';
                            }
                        }
                    }

                    $outcome_container.before('<div class="bar-chart-wrap sqb-chart-wrap">'+barChartHeading+bar_chart_shortcode+'</div>');
                }
                
                if(params[0] == 'outcome_spider_chart' && outcome_html.indexOf(spider_chart_shortcode) == -1){

                    var spiderChartHeading = '';

                    if(!this.isCategory() && (this.isQuiz('scoring') || this.isQuiz('assessment'))){
                        if(params[21] != ''){
                            spiderChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[21] + '</div>';
                        }
                    }else if(!this.isQuiz('personality') && !this.isQuiz('scoring') && !this.isQuiz('assessment')){
                        if(params[21] != ''){
                            spiderChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[21] + '</div>';
                        }
                    }else{

                        if(params[15] != '' && params[15] == 'outcome_based'){
                            if(params[24] != ''  && params[24] != undefined){
                                spiderChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[24] + '</div>';
                            }else{
                                spiderChartHeading = '<div style="text-align: center;"><span style="font-size: 14pt;" ><strong>Cumulative Quiz Insights</strong></span><br><span style="font-size: 14pt;">The spider chart presents the results in a web-like layout, showcasing the aggregated outcomes of all quiz participants in the chart.</span></div>';
                                /*if(params[21] != ''){
                                    spiderChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[21] + '</div>';
                                }*/
                            }
                        }else{
                            if(params[21] != ''){
                                spiderChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[21] + '</div>';
                            }
                        }
                    }

                    $outcome_container.before('<div class="spider-chart-wrap sqb-chart-wrap">'+spiderChartHeading+spider_chart_shortcode+'</div>');
                }
                

                if(params[18] == 'outcome_pie_chart' && outcome_html.indexOf(pie_chart_shortcode) == -1){

                    var pieChartHeading = '';

                    if(!this.isCategory() && (this.isQuiz('scoring') || this.isQuiz('assessment'))){
                        if(params[22] != ''){
                            pieChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[22] + '</div>';
                        }
                    }else if(!this.isQuiz('personality') && !this.isQuiz('scoring') && !this.isQuiz('assessment')){
                        if(params[22] != ''){
                            pieChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[22] + '</div>';
                        }
                    }else{
                        if(params[15] != '' && params[15] == 'outcome_based'){
                            if(params[25] != ''  && params[25] != undefined){
                                pieChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[25] + '</div>';
                            }else{
                                /*if(params[22] != ''){
                                    pieChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[22] + '</div>';
                                }*/
                                pieChartHeading = '<div style="text-align: center;"><span style="font-size: 14pt;"><strong>Cumulative Results Breakdown</strong></span><br><span style="font-size: 14pt;">The pie chart provides a detailed visual breakdown of how the results of all quiz participants are distributed across each category.</span></div>';

                            }
                        }else{
                            if(params[22] != ''){
                                pieChartHeading = '<div class="bar-chart-heading common-outcome-chart">' + params[22] + '</div>';
                            }
                        }
                    }

                    $outcome_container.before('<div class="pie-chart-wrap sqb-chart-wrap">'+pieChartHeading+pie_chart_shortcode+'</div>');
                }

                var outcome_html = $this.find('#outcome_id_'+outcome_id).html();

                //if(params[0] == 'outcome_spider_chart'){
                    outcome_html = outcome_html.replace(spider_chart_shortcode,'<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container spiderChartOutcomeClass"><canvas id="spiderChartOutcome"></canvas></div></div>');
                //}

                //if(params[1] == 'outcome_bar_chart'){
                    outcome_html = outcome_html.replace(bar_chart_shortcode,'<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container"><canvas id="spiderChartOutcome1"></canvas></div></div>');
                //}

                outcome_html = outcome_html.replace(pie_chart_shortcode,'<div class="ans_in_resultpage_outer sqb_charts_outer_section"><div class="chart-container"><div id="spiderChartOutcome2"></div></div></div>');

                $this.find('#outcome_id_'+outcome_id).html(outcome_html);

                var style = [];
                style['font_weight'] = '500';   
                style['font_size'] = '14';
                style['font_color'] = '#12c9dd';
                style['font_family'] = "'DM Sans',sans-serif";
                style['label_text'] = 'Total Responses';

                if(params[9] != ''){
                    style['font_weight'] = params[9];
                }
                if(params[10] != ''){
                    style['font_size'] = params[10];
                }
                if(params[11] != ''){
                    style['font_color'] = params[11];
                }
                if(params[12] != ''){
                    style['font_family'] = params[12];
                }
                if(params[14] != ''){
                    style['label_text'] = params[14];
                    style['label_text'] = style['label_text'].replace("+"," ");
                    style['label_text'] = '';
                }
                if(isMobile) {
                    style['font_weight'] = '400';
                    style['font_size'] = '10';
                }
                
                if(params[13] != ''){
                    try {
                        var charts_heading = decodeURIComponent(params[13]);
                    } catch (error) {
                        var charts_heading = (params[13]);
                    }
                    
                    var chart_total = data.chart.OutcomeChartHeading;
                    var dataa = this.totalParticipatedUser($this.find('#outcome_id_'+outcome_id),chart_total,charts_heading,chart_type);
                    
                    if(outcome_html.indexOf('[CHART_HEADING]') == -1){
                        if(params[0] == 'outcome_spider_chart' || params[1] == 'outcome_bar_chart'){

                            var classss = "";
                            if(params[20] != ''){
                                dataa = '';
                                classss = "hide-chart-user-data";
                            }

                            if($this.find('.ans_in_resultpage_outer').length > 0){
                                $this.find('#outcome_id_'+outcome_id).find('.ans_in_resultpage_outer').after( "<div class='"+classss+" sqb_spider_charts_heading'>"+dataa+"</div>" );
                            }else{
                                $this.find('#outcome_id_'+outcome_id).find('#result_temp_contentid').after( "<div class='sqb_spider_charts_heading'>"+dataa+"</div>" );
                            }

                            if($this.find('.sqb_spider_charts_heading').length > 1){
                                $this.find('.sqb_spider_charts_heading').slice(1).remove();
                            }
                        }
                    }else{
                        outcome_html = outcome_html.replace('[CHART_HEADING]',"<div class='sqb_spider_charts_heading'>"+dataa+"</div>");
                        $this.find('#outcome_id_'+outcome_id).html(outcome_html);
                    }
                }

                var outcome_html = $this.find('#outcome_id_'+outcome_id).html();
                if(chart_type == 'outcome_ranking'){
                    var spider_chart = data.chart.OutcomeTitle;
                    var bar_chart = data.chart.OutcomeTitle;

                    var pie_chart_label = data.chart.OutcomeTitle['labels'];
                    var pie_chart_data = data.chart.OutcomeTitle['data'];
                    var pie_chart = pie_chart_label.map((e,i) => [e,parseInt(pie_chart_data[i])]);
                    pie_chart = pie_chart.filter(function (el) {
                        return el != null;
                      });
                }else if(chart_type == 'category_based'){
                    //console.log(cat_chart);
                    var labelsNew = cat_chart['labels'].filter(function (value) {
                        return value != null && value != "";
                    });
                    var dataNew = cat_chart['data'].filter(function (value) {
                        return value != null && value != "";
                    });

                    var labelsNewSpider = cat_chart['labels_spider'].filter(function (value) {
                        return value != null && value != "";
                    });
                    var dataNewSpider = cat_chart['data_spider'].filter(function (value) {
                        return value != null && value != "";
                    });

                    var response = {"labels":labelsNew,"data":dataNew}; 
                    var response1 = {"labels":labelsNewSpider,"data":dataNewSpider};    
                    var response2 = {labelsNewSpider,dataNewSpider};   
                    var spider_chart = response1;
                    var bar_chart = response;

                    var pie_chart_label = cat_chart['labels'];
                    var pie_chart_data = cat_chart['data'];
                    //var pie_chart = pie_chart_label.map((e,i) => [e+'('+parseInt(pie_chart_data[i])+')',parseInt(pie_chart_data[i])]);
                    var pie_chart = pie_chart_label.map((e,i) => [e,parseInt(pie_chart_data[i])]);
                    pie_chart = pie_chart.filter(function (el) {
                        return el != null;
                      });
                }else{
                    var labelsNew = data.chart.OutcomeBarChart['labels'];
                    var dataNew = data.chart.OutcomeBarChart['data'];
                    var pie_chart = labelsNew.map((e,i) => [e,parseInt(dataNew[i])]);

                    var spider_chart = data.chart.OutcomeSpiderChart;
                    var bar_chart = data.chart.OutcomeBarChart;
                }

                if(params[13] != ''){
                    quesbarchart = data.chart.QuestionBarChart;
                    var code = "<div id='question_answer_chart' data-chart='"+params[15]+"'>"+(quesbarchart.select_question_html.replace(/\\/g, ''))+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='spiderChartOutcome2'>"+quesbarchart.title_html+"</div></div></div>";
                    if(outcome_html.indexOf('[QUESTION_ANSWER_DATA_CHART]') == -1){
                        if(params[2] == 'question_answer_bar_chart'){
                            $this.find('#outcome_id_'+outcome_id).find('#result_temp_btnid').before(code);
                        }
                    }else{
                        outcome_html = outcome_html.replace('[QUESTION_ANSWER_DATA_CHART]',code);
                        $this.find('#outcome_id_'+outcome_id).html(outcome_html);
                    }
                }

                

                if(params[1] == 'outcome_bar_chart' || $this.find('#spiderChartOutcome1').length > 0){
                    jQuery('.sqb_charts_outer_section .chart-container').addClass('chat-loader-active');
                    setTimeout(function(){
                        $_self.generateBarChart(bar_chart,chart_type,style);
                    },1000);
                }

                if(params[0] == 'outcome_spider_chart' || $this.find('#spiderChartOutcome').length > 0){
                    jQuery('.sqb_charts_outer_section .chart-container').addClass('chat-loader-active');
                    setTimeout(function(){
                        $_self.generateSpiderChart(spider_chart,chart_type,style);
                    },1000);
                }                

                if(params[18] == 'outcome_pie_chart' || $this.find('#spiderChartOutcome2').length > 0){
                    jQuery('.sqb_charts_outer_section .chart-container').addClass('chat-loader-active');
                    setTimeout(function(){
                        $_self.generatePieChart(pie_chart,chart_type,style);
                    },1000);
                }

                setTimeout(function(){
                    jQuery('.sqb_charts_outer_section .chart-container').removeClass('chat-loader-active');
                },1500);
            }
        }

        this.refreshQuesitonBarChart = function(sqb_question_id,chart_type){
            var user_id =  $this.find('#user_id').val();
            jQuery.ajax({    
                url: ajaxurl,    
                type: "POST",
                data: {
                    action: 'SQBQuestionsbarchartAjax',
                    sqb_quiz_id: quiz_id,
                    sqb_question_id: sqb_question_id,
                    chart_type : chart_type,
                    user_id: user_id,
                },
                success: function (response) {  
                    response = JSON.parse(response);
                    var select_question_html = response.select_question_html;
                    $this.find('.sqb_select_questions').remove();
                    $this.find('.spiderChartOutcome2').closest('.ans_in_resultpage_outer').remove();
                    if($this.find('#question_answer_chart').length > 0){
                        $this.find('#outcome_id_'+final_outcome).find('#question_answer_chart').html('');
                        $this.find('#outcome_id_'+final_outcome).find('#question_answer_chart').html(""+select_question_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='spiderChartOutcome2'>"+response.title_html+"</div></div>");
                    } else {
                        $this.find('#outcome_id_'+final_outcome).find('#result_temp_btnid').before(""+select_question_html+"<div class='ans_in_resultpage_outer sqb_charts_outer_section'><div class='spiderChartOutcome2'>"+response.title_html+"</div></div>");
                    }
                }
            });
        }

        this.showOutcomeTags = function(outcome_id,response){

            var ans_tags =  $this.find('#sqb_ans_tags').val();
            var $outer = $this.find('#outcome_id_'+outcome_id);
            var outer_html = $outer.html();
            if(ans_tags != 'Y'){
                $this.find('#outcome_id_'+outcome_id+' custom_tag').remove();
                outer_html = outer_html.replaceAll('[SHOWALLUSERTAGS]','');
                $outer.html(outer_html);
                return false;
            }
            var tags_output = response.tags.tagss;
            jQuery.each( tags_output, function( key, value ){
                var str = key;
                if (typeof str !== "undefined") {
                    var final_str = str.replaceAll( "NULL,","");
                    if(/\d/.test(final_str)){
                        var content = tags_output[final_str];
                        outer_html = outer_html.replaceAll('<custom_tag>[showtaggcontent id="'+final_str+'"]</custom_tag>', '<div class="sqb_tags_content_details">'+content+'</div>');
                    }
                }
            });

            outer_html = outer_html.replaceAll('[SHOWALLUSERTAGS]', '<div class="sqb_tags_content_details">'+response.tags.
                tags_content_html+'</div>');
            var first_name = this.getOptinField('first_name');

            outer_html = outer_html.replaceAll('%%FIRST%%',first_name);
            outer_html = outer_html.replaceAll('%%FIRST_NAME%%',first_name);
            outer_html = outer_html.replaceAll('%%NAME%%',first_name);

            outer_html = outer_html.replaceAll(/\[showtaggcontent id="(.*?)"\]/gm, '');

            $outer.html(outer_html);
        }

        this.getOutcomeTags = function(){

            var ans_tags =  $this.find('#sqb_ans_tags').val();
            if(ans_tags != 'Y'){
                return '';
            }

            var answer_tags = '';
            var answer_tags_arr = [];
            jQuery.each( ques_ans_data, function( key, value ){
                var str = ques_ans_data[key]['answer_tags'];
                if (typeof str !== "undefined") {
                    var final_str = str.replaceAll( "NULL,","");
                    if(/\d/.test(final_str)){
                        answer_tags += final_str+',';
                    }
                }
            });

            return answer_tags;
        }

        this.getOutcomeCount = function(){

            var labels = [];
            var count_data = [];
            var sqbarray = outcome_ids_array;   
            if(sqbarray.length == 0){
                var outcome_id = $this.find('.outcome_div').attr('data-outcome-id');
                sqbarray.push(outcome_id); 
            }
            if(sqbarray.length == 0){
                var outcome_id = $this.find('.outcome_div').attr('data-outcome-id');
            }else{
                var outcome_ids_count = [];
                var modeMap = {};
                if(sqbarray[0] > 0){
                    var maxEl = sqbarray[0], maxCount = 1;
                }else{
                    var maxEl = sqbarray[1], maxCount = 1;
                }
                for(var i = 0; i < sqbarray.length; i++){
                    var el = sqbarray[i];
                    if(modeMap[el] == null)
                        modeMap[el] = 1;
                    else
                        modeMap[el]++;  
                    if(modeMap[el] > maxCount)
                    {
                        maxEl = el;
                        maxCount = modeMap[el];
                    }
                    outcome_ids_count[el] = modeMap[el];
                }
                
                var unique_arr = sqbarray.filter(function(element,index,self){
                    return index === self.indexOf(element); 
                });
                
                for(var j = 0; j < unique_arr.length; j++){
                    var outcome_id = unique_arr[j]; 
                    labels[j] = outcome_id;
                    count_data[j] = outcome_ids_count[outcome_id];
                }
            }

            var main = [];
            main['label'] = labels;
            main['count_data'] = count_data;
            return main;
        }

        this.replaceShortcode = function($string,$search,$replace){
           return $string.replace($search,$replace);
        }
        
        this.totalParticipatedUser = function($outer,response,chart_text,type){

            var sqb_quiz_title = $this.find('#sqb_quiz_title').val();
            var chart_text = chart_text.replace('%%QUIZ_NAME%%', '"'+sqb_quiz_title+'"');
            chart_text = chart_text.replace('%%TOTALUSERS%%', response.total_users);

            var sqb_points_ans = $this.find('#sqb_points_ans').val();
            var total_pt = $this.find('#points_count').val();
            chart_text = chart_text.replace('%%YOURSCORE%%', sqb_points_ans);
            chart_text = chart_text.replace('%%TOTALSCORE%%', total_pt);
            chart_text = chart_text.replace('%%SCOREINPERCENT%%', this.calculate_percentage(total_pt,sqb_points_ans));

            return chart_text;
        }

        this.generateBarChart1 = function(chart,chart_type,style){

            var dataArray = chart.data;
            var ctx = document.getElementById('spiderChartOutcome1').getContext('2d');
            var dis = true;
            if(this.isCategory()){
                dis = false;
            }
            var max_scale_vale = Math.max.apply(Math, dataArray);
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chart.labels,
                    datasets: [{
                        label: style['label_text'],
                        data: chart.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(255, 206, 86, 0.8)',
                            'rgba(75, 192, 192, 0.8)',
                            'rgba(153, 102, 255, 0.8)',
                            'rgba(255, 159, 64, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                    scales: {
                        y: {
                            stacked: true,
                            display: dis,
                            max: max_scale_vale,
                            },
                        x: {
                            ticks: {
                                
                                color: style['font_color'],
                                font:{
                                        family: style['font_family'],
                                        size: style['font_size'],
                                        weight: style['font_weight'],
                                    }
                            }
                        }
                        },
                responsive:true,
                maintainAspectRatio:true,
                }
            });
        }


        this.generateBarChart = function(chart, chart_type, style) {
            var charts_settings = decodeURIComponent($this.find('#outcome_screen_charts_settings').val());
            var params = charts_settings.split('|');
        
            var dataArray = chart.data.map(value => value === 0 ? 1 : value); // Ensure bars with 0 are visible
            var ctx = document.getElementById('spiderChartOutcome1').getContext('2d');
            var dis = true;
            if (this.isCategory()) {
                dis = false;
            }
            var max_scale_value = Math.max.apply(Math, dataArray);
            
            var isPercentage = params[17] == 'Y';
        
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chart.labels,
                    datasets: [{
                        data: dataArray,
                        backgroundColor: [
                            '#d9534f', '#f0ad4e', '#5bc0de', '#5cb85c'
                        ],
                        borderColor: [
                            '#c9302c', '#ec971f', '#46b8da', '#4cae4c'
                        ],
                        borderWidth: 2,
                        borderRadius: 10,
                        barPercentage: 0.7,
                        categoryPercentage: 0.7
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                title: function(tooltipItems) {
                                    return '';
                                },
                                label: function(context) {
                                    let value = context.raw === 1 && chart.data[context.dataIndex] === 0 ? 0 : context.raw;
                                    if($_self.isCategory() && params[15] == 'category_based') {
                                        return `${context.label}`;
                                    }else{
                                        return `${context.label}: ${value}${isPercentage ? '%' : ''}`;
                                    }
                                   
                                }
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            backgroundColor: '#4e4e4e',
                            borderRadius: 4,
                            color: 'white',
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            formatter: function(value, context) {
                                return `${value}${isPercentage ? '%' : ''}`;
                            }
                        }
                    },
                    scales: {
                        y: {
                            stacked: true,
                            display: dis,
                            max: isPercentage ? 100 : max_scale_value,
                            ticks: {
                                beginAtZero: true,
                                stepSize: isPercentage ? 25 : Math.ceil(max_scale_value / 4),
                                callback: function(value) {
                                    return `${value}${isPercentage ? '%' : ''}`;
                                }
                            },
                            grid: {
                                color: 'rgba(70, 70, 70, 0.2)',
                                lineWidth: 2
                            }
                        },
                        x: {
                            ticks: {
                                color: style['font_color'],
                                font: {
                                    family: style['font_family'],
                                    size: style['font_size'],
                                    weight: style['font_weight'],
                                },
                                maxRotation: 0,
                                minRotation: 0,
                                callback: function(value, index, values) {
                                    let label = chart.labels[index];
                                    return label.length > 10 ? label.substr(0, 10) + '...' : label;
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    layout: {
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10
                        }
                    },
                    borderWidth: 1,
                    borderColor: '#333',
                    elements: {
                        bar: {
                            borderRadius: 10
                        }
                    }
                }
            });
        };
        
             

        this.generatePieChart1 = function(charts,chart_type,style){
            Highcharts.setOptions({
                chart: {
                    style:{
                            fontFamily:'Arial, Helvetica, sans-serif', 
                            fontSize: '2em',
                            color:'#f00'
                        }
                }
            });

            jQuery('#spiderChartOutcome2').highcharts({
                chart: {
                    type: 'pie'
                },
                colors: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0,
                    backgroundColor: '#FFFFFF'
                },
                tooltip: {
                    shared: false,
                    valueSuffix: ''
                },
                credits: {
                    enabled: false
                },
                accessibility: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.1
                    },
                series: {
                    groupPadding: .15
                }
                },
                title: {
                    text: '',
                    style: {
                        display: 'none'
                    }
                },
                series: [{
                type: 'pie',
                name: style['label_text'],
                data: charts
                }]
            });
        }

        this.generatePieChart = function(charts, chart_type, style) {
            Highcharts.setOptions({
                chart: {
                    style:{
                        fontFamily: style['font_family'] || 'Arial, Helvetica, sans-serif', 
                        fontSize: style['font_size'] || '14px',
                        color: style['font_color'] || '#000'
                    }
                }
            });
        
            jQuery('#spiderChartOutcome2').highcharts({
                chart: {
                    type: 'pie',
                    backgroundColor: style['background_color'] || '#FFFFFF', 
                    borderRadius: 8, 
                    borderColor: '#ddd', 
                    borderWidth: 1 
                },
                colors: [
                    'rgba(255, 99, 132, 0.8)',   
                    'rgba(54, 162, 235, 0.8)',   
                    'rgba(255, 206, 86, 0.8)',   
                    'rgba(75, 192, 192, 0.8)',   
                    'rgba(153, 102, 255, 0.8)',  
                    'rgba(255, 159, 64, 0.8)'    
                ],
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    itemStyle: {
                        fontFamily: style['font_family'] || 'Arial, Helvetica, sans-serif',
                        fontSize: style['font_size'] || '12px',
                        color: style['font_color'] || '#000',
                        fontWeight: style['font_weight'] || 'normal'
                    },
                    borderWidth: 1, 
                    borderColor: '#ddd', 
                    backgroundColor: '#f9f9f9', 
                    padding: 10, 
                    borderRadius: 8 
                },
                tooltip: {
                    shared: false,
                    pointFormat: '', // Show label and percentage in the tooltip
                    backgroundColor: '#333', 
                    borderColor: '#666', 
                    style: {
                        color: '#fff' 
                    }
                },
                credits: {
                    enabled: false 
                },
                accessibility: {
                    enabled: false 
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.percentage:.1f}%', // Show only percentage inside the pie chart
                            distance: -30, 
                            color: '#fff', 
                            style: {
                                fontWeight: 'bold', 
                                textOutline: 'none' 
                            }
                        },
                        showInLegend: true,
                        innerSize: '50%', 
                        borderWidth: 0,  
                        borderColor: '#fff' 
                    },
                    series: {
                        groupPadding: 0, 
                        shadow: {
                            color: 'rgba(0, 0, 0, 0.15)', 
                            offsetX: 2,
                            offsetY: 2,
                            width: 5
                        }
                    }
                },
                title: {
                    text: '',
                    style: {
                        display: 'none' 
                    }
                },
                series: [{
                    type: 'pie',
                    name: '', 
                    data: charts.map(function(chart) {
                        return { 
                            name: chart[0], // Set the label for the tooltip
                            y: chart[1]     
                        };
                    })
                }]
            });
        };
        
        

        this.generatePieChart12 = function(charts, chart_type, style){
            Highcharts.setOptions({
                chart: {
                    style:{
                        fontFamily: style['font_family'] || 'Arial, Helvetica, sans-serif', 
                        fontSize: style['font_size'] || '14px',
                        color: style['font_color'] || '#000'
                    }
                }
            });
        
            jQuery('#spiderChartOutcome2').highcharts({
                chart: {
                    type: 'pie',
                    backgroundColor: style['background_color'] || '#FFFFFF', // Set background color
                    borderRadius: 8, // Rounded borders for the pie chart
                    borderColor: '#ddd', // Light border color for chart container
                    borderWidth: 1 // Border width
                },
                colors: [
                    'rgba(255, 99, 132, 0.8)',   // Red
                    'rgba(54, 162, 235, 0.8)',   // Blue
                    'rgba(255, 206, 86, 0.8)',   // Yellow
                    'rgba(75, 192, 192, 0.8)',   // Greenish
                    'rgba(153, 102, 255, 0.8)',  // Purple
                    'rgba(255, 159, 64, 0.8)'    // Orange
                ],
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    itemStyle: {
                        fontFamily: style['font_family'] || 'Arial, Helvetica, sans-serif',
                        fontSize: style['font_size'] || '12px',
                        color: style['font_color'] || '#000',
                        fontWeight: style['font_weight'] || 'normal'
                    },
                    borderWidth: 1, // Add border to the legend
                    borderColor: '#ddd', // Border color
                    backgroundColor: '#f9f9f9', // Light background for the legend
                    padding: 10, // Padding around the legend
                    borderRadius: 8 // Rounded borders for the legend box
                },
                tooltip: {
                    shared: false,
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>',
                    backgroundColor: '#333', // Darker background for the tooltip
                    borderColor: '#666', // Border color for tooltip
                    style: {
                        color: '#fff' // White text for better readability
                    }
                },
                credits: {
                    enabled: false // Disable Highcharts credits
                },
                accessibility: {
                    enabled: false // Disable accessibility for this chart
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '({point.y}) ({point.percentage:.1f}%)', // Show only value and percentage
                            distance: -30, // Place labels inside the pie
                            color: '#fff', // White color for better contrast
                            style: {
                                fontWeight: 'bold', // Bold font for labels
                                textOutline: 'none' // Remove the text outline
                            }
                        },
                        showInLegend: true,
                        innerSize: '50%', // Doughnut effect (optional)
                        borderWidth: 0,  // No border for pie slices
                        borderColor: '#fff' // White color for separation between slices
                    },
                    series: {
                        groupPadding: 0, // No padding between slices
                        shadow: {
                            color: 'rgba(0, 0, 0, 0.15)', // Soft shadow
                            offsetX: 2,
                            offsetY: 2,
                            width: 5
                        }
                    }
                },
                title: {
                    text: '',
                    style: {
                        display: 'none' // Hide title
                    }
                },
                series: [{
                    type: 'pie',
                    name: style['label_text'], // Set series name dynamically
                    data: charts.map(function(chart) {
                        return { 
                            name: chart[0], // Keep the label for the legend
                            y: chart[1]     // Only display value and percentage inside the pie chart
                        };
                    })
                }]
            });
        };
        
        

        this.generateSpiderChart1 = function(chart,chart_type,style){
            var dataArray = chart.data;
            var max_scale_value = Math.max.apply(Math, dataArray);
            var min_scale_value = Math.min.apply(Math, dataArray);
            
            if(chart_type == 'category_based'){
            var min_scale_value = 0;
                if(category_per == 'Y'){
                    var max_scale_value = 100;
                }
            }
            
            const data = {
                    labels: chart.labels,
                    datasets: [{
                    label: style['label_text'],
                    data: chart.data,
                    fill: true,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgb(255, 99, 132)',
                    pointBackgroundColor: 'rgb(255, 99, 132)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255, 99, 132)',
                    }]
                };

                const config = {
                    type: 'radar',
                    data: data,
                    options:{
                        plugins: {
                                legend: {
                                    display: false,
                                }
                            },
                            scales:{
                                    r: {
                                    pointLabels:{
                                        color: style['font_color'],
                                        font: {
                                                family: style['font_family'],
                                                size: style['font_size'],
                                                weight: style['font_weight'],
                                                }
                                    },
                                    suggestedMin:min_scale_value,
                                    suggestedMax:max_scale_value,
                                    
                                    },
                        },
                        responsive:true,
                        maintainAspectRatio:true,
                        aspectRatio:2,
                        layout:{
                            autoPadding:true,
                            padding: {
                                    left: 5,
                                    right: 5,
                                    top: 5,
                                    bottom: 5
                                }
                            }
                    }
                };
            var myChart = new Chart(document.getElementById('spiderChartOutcome'),config);
        }

        this.generateSpiderChart = function(chart, chart_type, style) {

            var charts_settings = decodeURIComponent($this.find('#outcome_screen_charts_settings').val());
            var params = charts_settings.split('|');
        
            var isPercentage = params[17] == 'Y';
            var dataArray = chart.data;
            var max_scale_value = Math.max.apply(Math, dataArray);
            var min_scale_value = Math.min.apply(Math, dataArray);
            
            // If chart_type is 'category_based', use percentage scaling if applicable
            if (chart_type == 'category_based') {
                min_scale_value = 0; // Ensure min scale is 0 for category-based charts
                if (category_per == 'Y') {
                    max_scale_value = 100; // Cap max value at 100 if percentages are used
                }
            }
        
            const data = {
                labels: chart.labels,
                datasets: [{
                    label: style['label_text'],
                    data: chart.data,
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                    pointRadius: 5,
                    pointHoverRadius: 8
                }]
            };
        
            // Determine stepSize dynamically based on max and min scale values
            stepSize = isPercentage ? 25 : Math.round((max_scale_value - min_scale_value) / 4);
        
            // Detect if the screen is mobile for responsive adjustments
            var isMobile = window.innerWidth <= 768;
        
            const config = {
                type: 'radar',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                title: function(tooltipItems) {
                                    return '';
                                },
                                label: function(context) {
                                    let value = context.raw === 1 && chart.data[context.dataIndex] === 0 ? 0 : context.raw;
                                    return `${context.label}: ${value}${isPercentage ? '%' : ''}`;
                                }
                            }
                        }
                    },
                    scales: {
                        r: {
                            pointLabels: {
                                color: style['font_color'],
                                font: {
                                    family: style['font_family'],
                                    size: isMobile ? 10 : style['font_size'], // Adjust font size for mobile
                                    weight: style['font_weight']
                                }
                            },
                            angleLines: {
                                color: 'rgba(70, 70, 70, 0.3)', // Darker angle lines
                                lineWidth: 2 // Increased line width
                            },
                            grid: {
                                color: 'rgba(70, 70, 70, 0.3)', // Darker grid lines
                                lineWidth: 2 // Increased line width
                            },
                            suggestedMin: min_scale_value,
                            suggestedMax: max_scale_value,
                            ticks: {
                                stepSize: stepSize,
                                showLabelBackdrop: false,
                                color: style['font_color'],
                                callback: function(value) {
                                    return (chart_type == 'category_based' && category_per == 'Y') || isPercentage == 'Y' ? value + '%' : value + '%';
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: !isMobile, // Adjust aspect ratio for mobile
                    aspectRatio: isMobile ? 1 : 1.5, // Mobile-friendly aspect ratio
                    layout: {
                        autoPadding: true,
                        padding: {
                            left: isMobile ? 5 : 10,
                            right: isMobile ? 5 : 10,
                            top: isMobile ? 5 : 10,
                            bottom: isMobile ? 5 : 10
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.2
                        }
                    }
                }
            };
        
            var myChart = new Chart(document.getElementById('spiderChartOutcome'), config);
        
            // Ensure Chart.js plugin for tooltips is registered
            //Chart.register(ChartDataLabels);
        };
        

        this.generateSpiderChart_noresponsive = function(chart, chart_type, style) {

            var charts_settings = decodeURIComponent($this.find('#outcome_screen_charts_settings').val());
            var params = charts_settings.split('|');

            var isPercentage = params[17] == 'Y';

            var dataArray = chart.data;
            var max_scale_value = Math.max.apply(Math, dataArray);
            var min_scale_value = Math.min.apply(Math, dataArray);
        
            // If chart_type is 'category_based', use percentage scaling if applicable
            if (chart_type == 'category_based') {
                min_scale_value = 0; // Ensure min scale is 0 for category-based charts
                if (category_per == 'Y') {
                    max_scale_value = 100; // Cap max value at 100 if percentages are used
                }
            }
        
            const data = {
                labels: chart.labels,
                datasets: [{
                    label: style['label_text'],
                    data: chart.data,
                    fill: true,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                    pointRadius: 5,
                    pointHoverRadius: 8
                }]
            };
        
            //let stepSize = (max_scale_value - min_scale_value) / 4;

            //stepSize = stepSize.toFixed(2); 

            stepSize = isPercentage ? 25 : Math.round((max_scale_value - min_scale_value) / 4)

            const config = {
                type: 'radar',
                data: data,
                options: {
                    plugins: {
                        legend: {
                            display: false,
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                title: function(tooltipItems) {
                                    return '';
                                },
                                label: function(context) {
                                    let value = context.raw === 1 && chart.data[context.dataIndex] === 0 ? 0 : context.raw;
                                    return `${context.label}: ${value}${isPercentage ? '%' : ''}`;
                                }
                            }
                        }
                    },
                    scales: {
                        r: {
                            pointLabels: {
                                color: style['font_color'],
                                font: {
                                    family: style['font_family'],
                                    size: style['font_size'],
                                    weight: style['font_weight']
                                }
                            },
                            angleLines: {
                                color: 'rgba(70, 70, 70, 0.3)', // Darker angle lines
                                lineWidth: 2 // Increased line width
                            },
                            grid: {
                                color: 'rgba(70, 70, 70, 0.3)', // Darker grid lines
                                lineWidth: 2 // Increased line width
                            },
                            suggestedMin: min_scale_value,
                            suggestedMax: max_scale_value,
                            ticks: {
                                stepSize: stepSize,
                                showLabelBackdrop: false,
                                color: style['font_color'],
                                callback: function(value) {
                                    return (chart_type == 'category_based' && category_per == 'Y') || isPercentage == 'Y' ? value + '%' : value + '%';
                                }
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    aspectRatio: 1.5,
                    layout: {
                        autoPadding: true,
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    elements: {
                        line: {
                            tension: 0.2
                        }
                    }
                }
            };
        
            var myChart = new Chart(document.getElementById('spiderChartOutcome'), config);
        
            // Ensure Chart.js plugin for tooltips is registered
            //Chart.register(ChartDataLabels);
        };
        
            

        this.setAnswerSelected = function($ans_item_outer,event){

            //console.log(jQuery(event.target).hasClass('checkbox_fe'));
            jQuery('.max-check-limit-message').remove();
            var ques_id =  jQuery($ans_item_outer).closest(".question_container").attr('data-question-id');

            var mls = jQuery($ans_item_outer).closest(".question_container").find('.max_limit_status').val();
            var max_limit = jQuery($ans_item_outer).closest(".question_container").find('.max_limit_check').val();
            //var max_limit = 3;
            var total_checkebox = jQuery('.question_type_multi#question_id_'+ques_id).find('.checkbox_fe').length;
            var total_checkbox_checked = jQuery('.question_type_multi#question_id_'+ques_id).find('.checkbox_fe:checked').length;
            
            if(mls == 'Y'){
                if(jQuery($ans_item_outer).find('.checkbox_fe.sqb_ans_selected').length < 1 && max_limit == total_checkbox_checked){
                    var em = jQuery($ans_item_outer).closest(".question_container").find('.limit_exceeded').val();
                    em = em.replace('%%answer_limit%%' ,max_limit);
                    jQuery('.question_type_multi#question_id_'+ques_id).find('.question_details').after('<div class="max-check-limit-message">'+em+'</div>');
                    return false;
                }
            }

            var sqb_quiz_container_outer_id = $this.attr('id');
            var m_outcome_ids = '';
            var matrix_points = 0;
            if(jQuery($ans_item_outer).hasClass('dropdown_cls')){
                var dropdown_value = jQuery($ans_item_outer).find('.sqb_question_dropdown').val();
                if(dropdown_value != ''){
                    jQuery($ans_item_outer).addClass('sqb_ans_selected');
                } else {
                    jQuery($ans_item_outer).removeClass('sqb_ans_selected');
                }

            } else if(jQuery($ans_item_outer).hasClass('matrix_cls')){
                
                $this.find($ans_item_outer).find('.sqb_and_field.checkbox_fe').each(function(){
                    if(jQuery(this).prop("checked") == true){

                        if(jQuery(event.target).hasClass('checkbox_fe')){
                            if(!jQuery(this).closest('.sqb_ans_rowcol').hasClass('outcome_counted')){

                                matrix_points = matrix_points + parseInt(jQuery(this).attr('data-assigned-value'));
                                jQuery(this).closest('.sqb_ans_rowcol').addClass('outcome_counted');
                                m_outcome_ids = jQuery(this).closest('.sqb_ans_rowcol').attr('data-outcome_ids');
                                if(m_outcome_ids != ''){
                                    m_outcome_ids = m_outcome_ids.split(',');
                                }
                            }
                        }
                        jQuery($ans_item_outer).addClass('sqb_ans_selected');
                    }else{
                        jQuery(this).closest('.sqb_ans_rowcol').removeClass('outcome_counted');
                    }
                });
                
                this.show_continue_button(jQuery($ans_item_outer));
               
            } else if(jQuery($ans_item_outer).hasClass('multiple_cls')){

                if(jQuery($ans_item_outer).hasClass("sqb_ans_selected")){
                    jQuery($ans_item_outer).removeClass("sqb_ans_selected");
                }else{
                    jQuery($ans_item_outer).addClass("sqb_ans_selected");
                }

                if(jQuery($ans_item_outer).hasClass("sqb_ans_selected") == true){
                    jQuery($ans_item_outer).find(".sqb_and_field.checkbox_fe").prop("checked" , true);          
                }else{
                    jQuery($ans_item_outer).find(".sqb_and_field.checkbox_fe").prop("checked" , false);         
                }
                
                $this.find('.sqb_and_field.checkbox_fe').each(function(){
                    if(jQuery(this).prop("checked") == true){
                        jQuery(this).closest('.sqb_ans_item_outer').addClass('sqb_ans_selected');            
                        jQuery(this).addClass('sqb_ans_selected');           
                    }else{
                        jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');             
                        jQuery(this).removeClass('sqb_ans_selected');            
                    }
                });
            }else{
                jQuery($ans_item_outer).closest('.question_container').find('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
                jQuery($ans_item_outer).closest('.question_container').find('.sqb_ans_item_outer').removeClass('addselected');
                $this.find('.single_cls').removeClass('addselected');
                jQuery($ans_item_outer).addClass('addselected');
                jQuery($ans_item_outer).addClass('sqb_ans_selected');
            }
            
            var input_checked = jQuery($ans_item_outer).find("input.sqb_and_field").prop("checked");
            var question_skipid =  jQuery($ans_item_outer).closest(".question_container").find('.skip_mapping_cls').val();   
            var parent_hasClass =  jQuery($ans_item_outer).closest(".question_container").hasClass('multiple_correct_cls'); 
            var matrix_hasClass =  jQuery($ans_item_outer).closest(".question_container").hasClass('question_type_matrix'); 
            var ques_id =  jQuery($ans_item_outer).closest(".question_container").attr('data-question-id');
            
            if(jQuery(event.target).hasClass('checkbox_fe') && jQuery($ans_item_outer).hasClass('matrix_cls')) {
                var data_outcome_ids = m_outcome_ids;
            }else{
                var data_outcome_ids = jQuery($ans_item_outer).attr('data-outcome-ids');
            }
            if(question_skipid !="Y"){
                if (typeof data_outcome_ids !== typeof undefined && data_outcome_ids !== false && data_outcome_ids != '') {

                    if(m_outcome_ids.length < 1) {
                        var data_outcome_ids = jQuery($ans_item_outer).attr('data-outcome-ids').split(",");
                    }else{
                        var data_outcome_ids = m_outcome_ids;
                    }

                    if(matrix_points > 0){
                        var data_outcome_point = matrix_points;
                    }else{
                        var data_outcome_point = parseInt(jQuery($ans_item_outer).attr('data-point'));
                    }

                    //console.log(data_outcome_point);

                    //var data_outcome_ids = jQuery($ans_item_outer).attr('data-outcome-ids').split(",");         
                    //var data_outcome_point = parseInt(jQuery($ans_item_outer).attr('data-point')); 

                    jQuery(data_outcome_ids).each(function(index,element){
                        //if multiple checkbox
                         if(parent_hasClass == true || matrix_hasClass == true){                    
                            if(input_checked == true || matrix_hasClass == true){
                                outcome_ids_array.push(element);
                                if(outcome_ques_ids_array[element] == undefined){
                                    outcome_ques_ids_array[element] = [];
                                }
                                
                                var answer_id = jQuery($ans_item_outer).attr('data-answer-id');

                                if(outcome_ques_ids_array[element][ques_id] == undefined){
                                    outcome_ques_ids_array[element][ques_id] = [];
                                }

                                outcome_ques_ids_array[element][ques_id][answer_id] = data_outcome_point;

                                
                                /*if(element in outcome_ids_points_array){
                                    outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
                                }else{
                                    outcome_ids_points_array[element] = data_outcome_point;
                                } */
                                
                            }else{
                                var index_outcome = outcome_ids_array.indexOf(element);                      
                                if (index_outcome !== -1){                           
                                    outcome_ids_array.splice(index_outcome, 1);  
                                } 
                                
                               /* var index_outcome_point = outcome_ids_points_array.indexOf(element);                         
                                if (index_outcome_point !== -1){                             
                                    outcome_ids_points_array.splice(index_outcome_point, 1);  
                                } */
                            }      
                        }else{
                            outcome_ids_array.push(element);
                            if(outcome_ques_ids_array[element] == undefined){
                                outcome_ques_ids_array[element] = [];
                            }
                            outcome_ques_ids_array[element][ques_id] = data_outcome_point;
                            /*if(element in outcome_ids_points_array){
                                    outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
                            }else{
                                outcome_ids_points_array[element] = data_outcome_point;
                            }*/
                        }
                    });
                } 
            }
            
            //console.log(outcome_ids_array);
        }

        this.calculateWeighedOutcome = function($question){

            var ques_id = $question.attr('data-question-id');
            var data_outcome_point = 0;
            var question_skipid =  $question.find('.skip_mapping_cls').val();   
            if(question_skipid !="Y"){
                //console.log(outcome_ids_array);

                if(this.isQuestionType('matrix_cls',$question)){

                    var data_outcome_point = 0;
    
                    $question.find(".matrix_cls .checkbox_fe:checked").each(function(){
                        if(jQuery(this).closest('td').attr('data-outcome_ids') != ''){
                        var multi_ans_given_points = jQuery(this).attr('data-assigned-value');      
                        data_outcome_point = parseInt(data_outcome_point) + parseInt(multi_ans_given_points);
                        }
                    });
                }else{
                    var data_outcome_point = parseInt($question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-point"));
                }

                //console.log(outcome_ques_ids_array);

                var parent_hasClass =  $question.hasClass('multiple_correct_cls');
                var qtype_matrix_hasClass =  $question.hasClass('question_type_matrix');
                //var input_checked = jQuery($ans_item_outer).find("input.sqb_and_field").prop("checked");
                //console.log(data_outcome_point);


                var outcome_ids_array1 = $.grep(outcome_ids_array, function (element) {
                    return element != "" && element != null;
                });
                  
               // outcome_ids_array1 = jQuery.unique(outcome_ids_array1);
                outcome_ids_array1 = Array.from(new Set(outcome_ids_array1));
                //console.log(outcome_ids_array1);

                if (typeof outcome_ids_array1 !== typeof undefined && outcome_ids_array1 !== false) {

                    // var parent_hasClass = false;
                    jQuery(outcome_ids_array1).each(function(index,element){
                        //if multiple checkbox
                         if(parent_hasClass == true || qtype_matrix_hasClass == true){    
                            var input_checked = true;              
                            if(input_checked == true){                       
                                //outcome_ids_array.push(element);
                                
                                var summ = 0;
                                /*if(outcome_ques_ids_array[element][ques_id] != undefined){
                                    outcome_ques_ids_array[element][ques_id].forEach((number, index) => {
                                        //console.log(`Element at index ${index} is ${number}`);
                                        summ = summ + parseInt(number);
                                    });
                                }*/

                                var arr = outcome_ques_ids_array[element]?.[ques_id];
                                if (Array.isArray(arr)) {
                                    arr.forEach((number, index) => {
                                        summ += parseInt(number);
                                    });
                                }

                                if( outcome_ids_points_array[element] == undefined){
                                    // outcome_ids_points_array[element] = 0
                                     if(outcome_ques_ids_array[element][ques_id] == undefined){
                                         outcome_ques_ids_array[element][ques_id] = 0;
                                     }
                                     outcome_ids_points_array[element] =  summ;
                                 }else{
                                     if(outcome_ques_ids_array[element][ques_id] == undefined){
                                         outcome_ques_ids_array[element][ques_id] = 0;
                                     }
                                     outcome_ids_points_array[element] = outcome_ids_points_array[element] + summ;
                                 }

                                /*if(element in outcome_ids_points_array){
                                    outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
                                }else{
                                    outcome_ids_points_array[element] = data_outcome_point;
                                }*/
                                
                            }else{
                                // var index_outcome = outcome_ids_array.indexOf(element);                      
                                // if (index_outcome !== -1){                           
                                //     outcome_ids_array.splice(index_outcome, 1);  
                                // } 
                                
                                var index_outcome_point = outcome_ids_points_array.indexOf(element);                         
                                if (index_outcome_point !== -1){                             
                                    outcome_ids_points_array.splice(index_outcome_point, 1);  
                                } 
                            }      
                        }else{
                            
                            //outcome_ids_array.push(element);
                            if( outcome_ids_points_array[element] == undefined){
                               // outcome_ids_points_array[element] = 0
                                if(outcome_ques_ids_array[element][ques_id] == undefined){
                                    outcome_ques_ids_array[element][ques_id] = 0;
                                }
                                outcome_ids_points_array[element] =  outcome_ques_ids_array[element][ques_id];
                            }else{
                                if(outcome_ques_ids_array[element][ques_id] == undefined){
                                    outcome_ques_ids_array[element][ques_id] = 0;
                                }
                                outcome_ids_points_array[element] = outcome_ids_points_array[element] + outcome_ques_ids_array[element][ques_id];
                            }
                           
                            /*if(element in outcome_ids_points_array){
                                    outcome_ids_points_array[element] = outcome_ids_points_array[element] + data_outcome_point;
                            }else{
                                outcome_ids_points_array[element] = data_outcome_point;
                            }*/
                        }
                    });
                } 

                //console.log(outcome_ids_points_array);
            }
        }

        this.show_continue_button = function(elemt){
            if(template == 'template7'){
                jQuery(elemt).closest('.question_container').find('.skip-question-action').hide();
                jQuery(elemt).closest('.question_container').find('.continue-question-action').show();
            }
        }

        this.animationVisiblityCheck = function(element_class){
            if (jQuery(element_class)[0]) {
                var elementBottom = jQuery(element_class).offset().top;
                var viewportTop = jQuery(window).scrollTop();
                var viewportBottom = viewportTop + jQuery(window).height();
                return (elementBottom > viewportTop && elementBottom < viewportBottom);
            }else{
                return false;
            }
        }

        this.scrollToAnimate = function(screen = ''){

            var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 2000;
            
            setTimeout(function() {
                if(quiz_display == "inpage"){            
                    var selector = '';
                    var $scrollto = '';
                    var isVideo = false;
                    var currVideoSel = '';
                    if(screen == 'ques_ans'){
                        selector = '.Quiz-Template.show_cls .question_title';
                        currVideoSel = '.Quiz-Template.show_cls';
                        $scrollto = $quesans_outer;
                    }else if(screen == 'optin'){
                        selector = '.Quiz-Optin-Template .Quiz-Template-title';
                        currVideoSel = '.Quiz-Optin-Template';
                        $scrollto = $quesans_outer;
                        
                        $scrollto = $optin_outer;
                    }else if(screen == 'outcome'){
                        if(lesson_id < 1){
                            selector = '.quiz_result_template_outer';
                            currVideoSel = '.quiz_result_template_outer';
                            $scrollto = $outcome_outer;
                        }else{
                            selector = '.outcome_data_cont';
                            $scrollto = $this.find('.outcome_data_cont');
                        }
                        
                    }

                    var quiz_scroll_allow = $_self.animationVisiblityCheck(selector);
                    var offset = 120;
                    if(isMobile){
                        var offset = 50;
                    }
                    
                    if(jQuery(currVideoSel).find('.sqb-template-bg-video-left').length > 0 || jQuery(currVideoSel).find('.sqb-template-bg-video-right').length > 0 || jQuery(currVideoSel).find('.sqb-template-bg-image-left').length > 0 || jQuery(currVideoSel).find('.sqb-template-bg-image-right').length > 0){
                        isVideo = true;
                    }

                    if(isVideo){
                        var quiz_scroll_allow = false;
                    }

                    if (!quiz_scroll_allow) {
                        jQuery('html, body').animate({
                            scrollTop: $scrollto.offset().top - offset
                        }, "slow"); 
                    }
                }
            },timerValue);
        }

        this.getCounterData = function(obj) {
            var hours = parseInt($this.find(' .sqb-hours', obj).text());
            var minutes = parseInt($this.find(' .sqb-minutes', obj).text());
            var seconds = parseInt($this.find(' .sqb-seconds', obj).text());
            return seconds + (minutes * 60) + (hours * 3600) ;
        }

        this.setCounterData = function(s, obj){
            var hours = Math.floor((s % (60 * 60 * 24)) / (3600));
            var minutes = Math.floor((s % (60 * 60)) / 60);
            var seconds = Math.floor(s % 60);
                
            $this.find('#timer_count').val(s);  
            if(hours < 10){
                hours = '0'+hours;
            }
            if(minutes < 10){
                minutes = '0'+minutes;
            }
            if(seconds < 10){
                seconds = '0'+seconds;
            }
            
            $this.find('.sqb-hours', obj).html(hours);
            $this.find('.sqb-minutes', obj).html(minutes);  
            $this.find('.sqb-seconds', obj).html(seconds);
            if(seconds <= 1){
                seconds='00';
                $this.find('.sqb-seconds', obj).html(seconds);
            }
            
            if(hours < 1 && minutes < 1 && seconds <= 1){
                var timer_stop = $this.find('#timer_stop').val();
                if(timer_stop < 1 && quiz_processed == false){      
                    this.sendToScreenTimeElapses();
                }   
            }
        } 

        
        this.setSpeedCounterData = function(s, obj){
            var hours = Math.floor((s % (60 * 60 * 24)) / (3600));
            var minutes = Math.floor((s % (60 * 60)) / 60);
            var seconds = Math.floor(s % 60);
                
            var hour_text = $this.find('#speed_timer_text_hour_html').html();  
            var minute_text = $this.find('#speed_timer_text_mint_html').html();  
            var sec_text = $this.find('#speed_timer_text_sec_html').html();  

            $this.find('#speed_timer_count').val(s);  
            if(hours < 10){
                hours = '0'+hours;
            }
            if(minutes < 10){
                minutes = '0'+minutes;
            }
            if(seconds < 10){
                seconds = '0'+seconds;
            }
            
            $this.find('.timer-Hours', obj).html(hours+'<span>'+hour_text+'</span>');
            $this.find('.timer-Minutes', obj).html(minutes+'<span>'+minute_text+'</span>');  
            $this.find('.timer-Seconds', obj).html(seconds+'<span>'+sec_text+'</span>');

            if(seconds <= 1){
                seconds='00';
                $this.find('.timer-seconds', obj).html(seconds+'<span>'+sec_text+'</span>');
            }
            
        } 
        
        this.sendToScreenTimeElapses = function(){
    
            var send_to_screen = $this.find('#send_to_screen').val();   
            if(send_to_screen == "disable_next_btn_show_msg") {
                $quesans_outer.find('.sqb_counter_expired_msg ').show();    
                $quesans_outer.find('.question_container').addClass('question_container_disabled'); 
            }else{
                var lesson_id = jQuery(' #lesson_id').val();        
                if(lesson_id > 0){
                    enable_see_detail(sqb_quiz_container_outer_id, 'notcount');
                }else{
                    this.gettimer_spent('notcount');
                    final_outcome =  this.getCurrentOutcome();
                    this.setLastScreen();
                }
            }
        }

        this.displayMessageInScreens = function(){

            if($this.find('.quiz_outer_fe .sqb_counter_outer1').length > 1){
                return false; 
            }  
            var timer_enable = $this.find('#timer_enable ').val();
            var time_hour= $this.find('#time_hour').val();
            var time_min= $this.find('#time_min').val();
            var time_sec= $this.find('#time_sec').val();
            if(timer_enable =="Y"){ 
                if(time_hour < 1 && time_min < 1 && time_sec <  1){
                }else{
                    //timer
                    var count = $_self.getCounterData($this.find('.sqb_counter'));
                    var timer_spent =2;     
                    var timer = setInterval(function() {
                        count--;
                        if (count == 0) {
                            clearInterval(timer);
                            return;
                        }
                        $this.find('#timer_spent').val(timer_spent);    
                        timer_spent++;
                        $_self.setCounterData(count,$this.find('.sqb_counter'));
                    }, 1000);  
                     
                    //Where should it be displayed:
                    var sqb_counter_outer_data1 = $this.find('.sqb_counter_outer').html();
                    var sqb_counter_outer_data = '<div class="sqb_counter_outer1">'+sqb_counter_outer_data1+'</div>';
                    var where_should_msg_display = $this.find('#wheretoshow').val();    
                    
                    if(template == 'template5' ){
                        $quesans_outer.find('.Quiz-Template5-left-side .sqb_question_progress').after(sqb_counter_outer_data);
                    }else if(template == 'template3' ){
                        $quesans_outer.find('.question_title ').after(sqb_counter_outer_data);
                    }else{
                        $quesans_outer.find('.progress').before(sqb_counter_outer_data);
                    }               
                    $outcome_outer.find('.quiz_timer_html_data ').hide(); 
                    $optin_outer.find('.quiz_timer_html_data ').hide(); 
                    if( $quesans_outer.find('.points_scored_result').length){        
                        $quesans_outer.find('.points_scored_result').before(sqb_counter_outer_data);    
                    }
                    if(show_optin =="Y"){
                        if(template == 'template3' ){
                            $optin_outer.find('.Quiz-Template-title').after(sqb_counter_outer_data);
                        }else{
                            $optin_outer.find('.Quiz-Template-title').before(sqb_counter_outer_data);
                        }   
                        $optin_outer.find('.sqb_counter_expired_msg ').hide();  
                    }else{
                        $outcome_outer.find('.sqb_counter_expired_msg').hide(); 
                        if(template == 'template3'){
                            $outcome_outer.find('.points_scored_result ').after(sqb_counter_outer_data);                
                        }else{
                            $outcome_outer.find('.points_scored_result ').before(sqb_counter_outer_data);               
                        }
                    }
                }
            }
        }

        this.displayMessageSpeedInScreens = function(){

            if($this.find('.quiz_outer_fe .sqb_speed_counter_outer1').length > 1){
                return false; 
            }  
            var speed_timer_enable = $this.find('#speed_timer_enable ').val();
            var speed_time_hour= $this.find('#speed_time_hour').val();
            var speed_time_min= $this.find('#speed_time_min').val();
            var speed_time_sec= $this.find('#speed_time_sec').val();
            if(speed_timer_enable =="Y"){
                    //timer
                    var count = 1;
                    var timer_spent = 2;     
                    var timer = setInterval(function() {
                        count++;
                        if (jQuery('#speed_time_spent1').val() != 0) {
                            clearInterval(timer);
                            return;
                        }
                        $this.find('#speed_timer_spent').val(timer_spent);    
                        timer_spent++;
                        $_self.setSpeedCounterData(count,$this.find('.sqb_speed_counter_outer'));
                    }, 1000);  
                     
                    //Where should it be displayed:
                    var sqb_speed_counter_outer_data1 = $this.find('.sqb_speed_counter_outer').html();
                    var sqb_speed_counter_outer_data = '<div class="sqb_speed_counter_outer1">'+sqb_speed_counter_outer_data1+'</div>';
                    var where_should_msg_display = $this.find('#wheretoshow').val();    
                    
                    if(template == 'template5' ){
                        $quesans_outer.find('.Quiz-Template5-left-side .sqb_question_progress').after(sqb_speed_counter_outer_data);
                    }else if(template == 'template3' ){
                        $quesans_outer.find('.question_title ').after(sqb_speed_counter_outer_data);
                    }else if(template == 'template9' ){
                        $quesans_outer.find('.question_title ').after(sqb_speed_counter_outer_data);
                    }else{
                        $quesans_outer.find('.progress').before(sqb_speed_counter_outer_data);
                    }               
                    $outcome_outer.find('.quiz_timer_html_data ').hide(); 
                    $optin_outer.find('.quiz_timer_html_data ').hide(); 
                    if( $quesans_outer.find('.points_scored_result').length){        
                        $quesans_outer.find('.points_scored_result').before(sqb_speed_counter_outer_data);    
                    }
                    if(show_optin =="Y"){
                        if(template == 'template3' ){
                            $optin_outer.find('.Quiz-Template-title').after(sqb_speed_counter_outer_data);
                        }else{
                            $optin_outer.find('.Quiz-Template-title').before(sqb_speed_counter_outer_data);
                        }   
                        $optin_outer.find('.sqb_counter_expired_msg ').hide();  
                    }else{
                        /*$outcome_outer.find('.sqb_counter_expired_msg').hide(); 
                        if(template == 'template3'){
                            $outcome_outer.find('.points_scored_result ').after(sqb_speed_counter_outer_data);
                        }else{
                            $outcome_outer.find('.points_scored_result ').before(sqb_speed_counter_outer_data);               
                        }*/
                    }
                
            }


        }

        this.sqb_hideloader = function(){
           $('.sqb_loader_outer').hide(); 
        };

        this.isPopup = function(){
            
            if(quiz_display != 'inpage')
                return true;
            else
                return false;
        };

        this.validateQuestion = function($question,skip_click = false){

            var is_valid = true;
            var parent_hasClass = false;
            var allow_skip_ques =  $question.find(".allow_skip_ques").val();
            var matrix_cls = $question.find(".sqb_ans_item_outer").hasClass('matrix_cls');
            var has_multiple_correct_cls =  $question.hasClass('multiple_correct_cls');
            var has_ranking_cls =  $question.hasClass('question_type_ranking_choices');
            var parent_ques_id =  $question.attr('data-question-id');
            var message = $this.find('#required_answer').val();
            if(matrix_cls || has_multiple_correct_cls || has_ranking_cls){
                parent_hasClass = true;
            }
            
            var sqb_ans_selected = 0;
            if($question.hasClass('question_type_file_upload')){
                var filename = $this.find('.Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
                
                if(filename != ''){
                    var sqb_ans_selected = 1;
                    
                }
            }else if($question.hasClass('question_type_matrix')){
                var total_class= $question.find(".sqb_ans_item_outer").length;
                var selected_class = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;
                
                if(total_class == selected_class){
                    sqb_ans_selected = 1;
                }
            }else if($question.hasClass('question_type_email')){

                sqb_ans_selected = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;
                var val = $question.find('.sqb_email_ans_field').val();
                var email_error_message = $question.find('.sqb_ans_item_outer').attr('data-emailmessage');
                var email_required = $question.find('.sqb_ans_item_outer').attr('data-isreq');
                
                if(email_required == 'Y'){
                    if(val == ''){
                        message = email_error_message;
                        sqb_ans_selected = 0;
                    }else if(!this.validateEmail(val)){
                        message = email_error_message;
                        sqb_ans_selected = 0;
                    }
                }

            }else if($question.hasClass('question_type_phone_number')){

                var val = $question.find('.sqb_phone_number_ans_field').val();
                var phone_error_message = $question.find('.sqb_ans_item_outer').attr('data-errormessage');
                var phone_required = $question.find('.sqb_ans_item_outer').attr('data-validation');

                sqb_ans_selected = 1;
                if(phone_required == 'Y'){
                    if(!iti[parent_ques_id].isValidNumber()){
                        message = phone_error_message;
                        sqb_ans_selected = 0;
                    }
                }
            }else if($question.hasClass('question_type_matching_text')){

                var validate = true;
                sqb_ans_selected = 0;
                $question.find('.sql_ans_text .drag-container').each(function(){
                    if(jQuery(this).find('.sqb-match-box .sqb-match-item').length < 1){
                        validate = false;
                    }
                });

                if(validate){
                    this.isSentenceMatch($question);
                    sqb_ans_selected = 1;
                }

            }else if($question.hasClass('question_type_date')){
                sqb_ans_selected = 1;
                var date_format = $question.find('.date-question-type').attr('data-date-format');
                var date_val = $question.find('.date-question-type').val();
                var invalid_date = $this.find('#invalid_date_text').val();
                if(date_val == ''){
                    message = invalid_date;
                    sqb_ans_selected = 0;
                }else if(!sqbisDate(date_format, date_val)){
                    message = invalid_date;
                    sqb_ans_selected = 0;
                }
            }else if($question.hasClass('question_type_numerical_text')){
                sqb_ans_selected = 1;
                var val = $question.find('.sqb_and_field').val();
                if(val == ''){
                    sqb_ans_selected = 0;
                }
            }else if($question.hasClass('question_type_name')){
                sqb_ans_selected = 1;
                var val = $question.find('.sqb_and_field').val();
                if(val == ''){
                    sqb_ans_selected = 0;
                }
            }else if($question.hasClass('question_type_weight_and_height')){
                sqb_ans_selected = 1;
                var weight = $question.find('.weight-input').val();
                var height_feet = $question.find('.height-feet').val();
                var height_inches = $question.find('.height-inches').val();
                var message = $question.find('.hw_incorrect_answer_msg').val();
                if(weight == '' || isSQBInteger(weight) != true){
                    sqb_ans_selected = 0;
                }else if(height_feet == '' || isSQBInteger(height_feet) != true){
                    sqb_ans_selected = 0;
                }
            }else{
                sqb_ans_selected = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;

            }

            if(allow_skip_ques == "Y" && skip_click == true){
                is_valid = true;
                return is_valid;
            }

            if(sqb_ans_selected < 1)
                is_valid = false;

            if(!is_valid){
                this.incorrectmsg_display( message, $question);
            }

            return is_valid;

        }

        this.is_advanced_rule = function(question_id, answer_id, outcome_id){
            var is_stop = false;
            var outcomerule_id = jQuery('#sqb_ans_id'+answer_id).attr('data-outcomerule-id');
            var continuequiz = $this.find('#sqb_ans_id'+answer_id).attr('data-continuequiz');
            var skipoptin = $this.find('#sqb_ans_id'+answer_id).attr('data-skipoptin-id');
            if(outcomerule_id > 0){
                if(skipoptin == "Y"){
                    $this.find("#show_optin").val("N");
                    show_optin = 'N';
                }
                if(continuequiz == 'N'){
                    is_stop = true;
                }else{
                    var $advrule = $this.find("#outcome_advanced_rule_id");
                    if($advrule.val() < 1){
                        $advrule.val(outcomerule_id);
                    }
                }
            }
            return is_stop;
        }
        
        this.isComplexRules = function(question_id,answer_id){
            prevQuestions.push(question_id);
            prevQuestionsAns[question_id] = answer_id;
           // console.log(prevQuestionsAns);
           
            var is_passed = false;
            var is_stop = false;
            $this.find('.complex_advanced_rules').each(function(){
                var outcome_id = jQuery(this).attr('data-outcome_id');
                var continuequiz = jQuery(this).attr('data-continuequiz');
                var skipoptin = jQuery(this).attr('data-skipoptin-id');
                let id = jQuery(this).attr('id');
                let scriptTag = document.querySelector('#'+id);

                let jsonData = null;

                try {
                    jsonData = JSON.parse(scriptTag.textContent);
                } catch (e) {
                    return;
                }

                if (!jsonData || jsonData == 'NULL') {
                    return;
                }

                //let jsonData = JSON.parse(scriptTag.textContent);
                //console.log(jsonData);

                var passed_question = true;
                var is_and_condition = false;

                // Check the first all questions
                jQuery.each(jsonData, function(index, value){
                    var qid = value['question'];
                    if(value['expression'] == 'and'){
                        is_and_condition = true;
                        if(jQuery.inArray(qid, prevQuestions) !== -1){
                            passed_question = true;
                            console.log('[AND] Question Passed : '+qid);
                        }else{
                            console.log('[AND]Question not Passed : '+qid);
                            passed_question = false;
                            return false;
                        }
                    }
                });

                // Check the first all answers
                if(passed_question){
                    var passed_answer = false;
                    var qa_status = [];
                    jQuery.each(jsonData, function(index, value){
                        
                        var qus_id = value['question'];
                        var qa_passed = false;
                
                        if(value['expression'] == 'and'){

                            if (jQuery.isArray(prevQuestionsAns[qus_id])) {
                                // Checked if multiple answers
                                var tmpcheck = false;
                                var isAnsFound = false;
                                jQuery.each(prevQuestionsAns[qus_id], function(index, val){
                                    var tmpcheck = false;
                                    if(jQuery.inArray(val,value['answer']) !== -1){
                                        //console.log('[AND] Question Matched : '+qus_id+' to '+val);
                                        passed_answer = true;
                                        tmpcheck = true;
                                        isAnsFound = true;
                                        return false;
                                    }else{
                                        tmpcheck = false;
                                        //console.log('[AND] Question not Matched : '+qus_id+' to '+val);
                                        passed_answer = false;
                                        isAnsFound = false;
                                    }
                                });

                                qa_status.push(isAnsFound);

                            }else{
                               
                                // Checked if single answers
                                if(jQuery.inArray(prevQuestionsAns[qus_id],value['answer']) !== -1){
                                    //console.log('[AND] Question Matched : '+qus_id+' to '+value['answer']);
                                    passed_answer = true;
                                    qa_status.push(true);
                                }else{
                                    //console.log('Not');
                                    //console.log('[AND] Question not Matched : '+qus_id+' to '+value['answer']);
                                    passed_answer = false;
                                    qa_status.push(false);
                                    return false;
                                }
                            } 
                        }
                    });
                }

                //console.log(qa_status);
                var passed_answer = false;
                if(qa_status != undefined){
                    jQuery.each(qa_status, function(index, value){
                        if(value == true){
                            passed_answer = true;
                        }else{
                            passed_answer = false;
                            return false;
                        }
                    });
                }
                
                

                // This process to check for OR condition
                var passed_or_condition = true;
                var is_or_condition = false;
                jQuery.each(jsonData, function(index, value){
                    var qid = value['question'];
                    if(value['expression'] == 'or'){
                        is_or_condition = true;
                        if(jQuery.inArray(qid, prevQuestions) !== -1){
                            passed_or_condition = true;
                            //console.log('[OR] Question Passed : '+qid);
                        }else{
                            //console.log('[OR] Question not Passed : '+qid);
                        }
                    }
                });

                if(passed_or_condition){
                    var passed_answer_or = false;
                    jQuery.each(jsonData, function(index, value){
                
                        var qus_id = value['question'];
                        if(value['expression'] == 'or'){

                            if (jQuery.isArray(prevQuestionsAns[qus_id])) {
                                // Checked if multiple answers
                                jQuery.each(prevQuestionsAns[qus_id], function(index, val){
                                    if(jQuery.inArray(val,value['answer']) !== -1){
                                        //console.log('[OR] Question Matched : '+qus_id+' to '+val);
                                        passed_answer_or = true;
                                    }
                                });
                            }else{
                                // Checked if single answers
                                if(jQuery.inArray(prevQuestionsAns[qus_id],value['answer']) !== -1){
                                    //console.log('[OR] Question Matched : '+qus_id+' to '+value['answer']);
                                    passed_answer_or = true;
                                }else{
                                    //console.log('[OR] Question not Matched : '+qus_id+' to '+value['answer']);
                                }
                            } 
                        }
                    });
                }

                var isValidate = false;
                if(is_or_condition && !is_and_condition){
                    //console.log('[OR] condition is required');
                    if(passed_answer_or){
                        isValidate = true;
                    }
                }else if(!is_or_condition && is_and_condition){
                    //console.log('[AND] condition is required');
                    //console.log('[AND] All Conditions are = '+passed_answer);

                    if(passed_answer){
                        isValidate = true;
                    }
                }else if(is_or_condition && is_and_condition){
                    //console.log('[AND - OR] conditions are required');
                    if(passed_answer && passed_answer_or){
                        isValidate = true;
                    }
                }else{
                    //console.log('Advanced Rules false');
                }

                if(isValidate){
                    //outcome_id
                    var $advrule = $this.find("#outcome_advanced_rule_id");
                    if($advrule.val() < 1){

                        if(skipoptin == "Y"){
                            $this.find("#show_optin").val("N");
                            show_optin = 'N';
                        }
                        if(continuequiz == 'N'){
                            is_stop = true;
                            var $advrule = $this.find("#outcome_advanced_rule_id");
                            if($advrule.val() < 1){
                                $advrule.val(outcome_id);
                            }
                        }else{
                            var $advrule = $this.find("#outcome_advanced_rule_id");
                            if($advrule.val() < 1){
                                $advrule.val(outcome_id);
                            }
                        }

                        is_passed = true;
                        //$advrule.val(outcome_id);
                    }
                }
            });
            

            return is_stop;

        }

        this.processFunnel = function($question){   
            
            var data_answer_id =   $question.find('.sqb_ans_selected').attr('data-answer-id');
            var data_question_id = $question.find('.sqb_ans_selected').attr('data-question-id');        
            var current_ques_div_hgt = $this.find('#quiz_temp_id'+data_question_id).height(); 
            if($question.hasClass('multiple_correct_cls')){
                var data_answer_id =   $question.find('.sqb_ans_selected.multiple_cls').attr('data-answer-id');
                var data_question_id = $question.find('.sqb_ans_selected.multiple_cls').attr('data-question-id');       
            }

            var funnel_json = $this.find('.sqb_funnel_ques_ans_connection_json').val();
            funnel_json = jQuery.parseJSON(funnel_json);
            
            if(data_question_id in funnel_json){
                // check next has or not
                if(funnel_json[data_question_id]['next_question'] == undefined || funnel_json[data_question_id]['next_question'][data_answer_id] == undefined){             
                    this.questionsComplete($question);
                }else{
                    var next_question_id = funnel_json[data_question_id]['next_question'][data_answer_id];
                    var quiz_temp_id = "quiz_temp_id"+data_question_id;
                    var quiz_temp_id_next = "quiz_temp_id"+next_question_id;
                    this.moveToNextQuestion($question,quiz_temp_id_next);
                    this.scrollToAnimate('ques_ans');
                    //if(correct_ans_opt == "result_page" || correct_ans_opt == "both"){
                        this.showQuesAnsResults($question);
                    //}
                    //sqb_save_question_answer_report(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_id').val(),next_question_id, 0,0, sqb_quiz_container_outer_id);
                    if(correct_ans_opt  ==""){
                        this.progressBar($question);
                    }
                }           
            }else{

            }
        }

        this.processAdvancedRule = function(question_id, answer_id, outcome_id){

            var outcomerule_id = $this.find('#sqb_ans_id'+answer_id).attr('data-outcomerule-id');
            var skipoptin = $this.find('#sqb_ans_id'+answer_id).attr('data-skipoptin-id');
            var continuequiz = $this.find('#sqb_ans_id'+answer_id).attr('data-continuequiz');

            if(outcomerule_id > 0){
                if(skipoptin=="Y"){                                     
                    $this.find("#show_optin").val("N"); 
                }
                var $advrule = $this.find("#outcome_advanced_rule_id");
                if(continuequiz == 'N'){
                    
                    if($this.find("#outcome_advanced_rule_id").val() < 1){
                        $advrule.val(outcomerule_id);
                    }
                }else{
                    if($advrule.val() < 1){
                        $advrule.val(outcomerule_id);
                    }
                }
            }
        }

        //get the outcome for personality
        this.sqb_mode = function(sqbarray){
            
            maxEl = 0;
            if(sqbarray.length == 0){
                var outcome_id = $this.find('.outcome_div').attr('data-outcome-id');
                return outcome_id;
            }else{
                sqbarray = sqbarray.filter(item => item);    
                var modeMap = {};
                if(sqbarray[0] > 0){
                    var maxEl = sqbarray[0], maxCount = 1;
                }else{
                    var maxEl = sqbarray[1], maxCount = 1;
                }
                for(var i = 0; i < sqbarray.length; i++)
                {
                    var el = sqbarray[i];
                    if(modeMap[el] == null)
                        modeMap[el] = 1;
                    else
                        modeMap[el]++;  
                    if(modeMap[el] > maxCount)
                    {
                        maxEl = el;
                        maxCount = modeMap[el];
                    }
                }
            }
            //replace Rank data
            
            if(sqbarray.length > 0){
                var numberArray = sqbarray.map(Number);
                var result = findMaxFrequencyAndSmallestValue(numberArray);
                maxEl = result.maxValue;
            }

            var max_outcome_points = 0;
            
            if(($this.find('input[name="weighted_score"]').length != 0) && ($this.find('input[name="weighted_score"]').val() == "Y")){
                if(outcome_ids_points_array.length != 0){
                    var max_outcome_points_id = 0;
                    var max_outcome_points = 0;
                    for (var outcome_id_new in outcome_ids_points_array) {
                        if(max_outcome_points < parseInt(outcome_ids_points_array[outcome_id_new])){
                            max_outcome_points = parseInt(outcome_ids_points_array[outcome_id_new]);
                            max_outcome_points_id = outcome_id_new;
                        }
                    }
                    if(max_outcome_points_id != 0){
                        maxEl = max_outcome_points_id;
                    }
                }
            }else{
                max_outcome_points = maxCount;
            }
            
            this.rankData(sqbarray, max_outcome_points, maxEl);
            return maxEl;

        }

        this.emailChecker = function(email){
            this.btnLoader($optin_outer.find('.continue_btn'));
            $optin_outer.find('.continue_btn').addClass('btn_disabled');
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: {
                    'action': 'sqb_email_check_api_ajax',
                    'email': email,
                },
                success: function (response) {
                    $this.find('.Quiz-Optin-Template .continue_btn').html(ori_text);
                    $optin_outer.find('.continue_btn').removeClass('btn_disabled');
                    response = JSON.parse(response);
                    var email_verify =  'invalid';
                    if(response.result){
                        if(response.reason == 'timeout'){
                            email_verify =  'valid';
                        }else if(response.result == 'valid'){
                            email_verify =  'valid';
                        }  
                    }
                    
                    if(email_verify == 'valid'){
                        if(opt_screen_position == 'optin-before-questions-screen'){
                            $_self.firstNameReplace();
                            $optin_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                            $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                        }else{
                            $_self.submitQuiz();
                        }
                    }else{
                        $_self.printOptinMessage(valid_email);
                    }
                }
            });
        }

        this.firstNameReplace = function(){

            var firstNamed = this.getOptinField('first_name');

            $quesans_outer.find('.question_container .sql_ans_text').each(function(){
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstNamed));
            });

            $quesans_outer.find('.question_container .question_title').each(function(){
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstNamed));
            });

            $quesans_outer.find('.question_container .question_description').each(function(){
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstNamed));
            });

            $analyzing_outer.find('.analyzing_result_content').each(function(){
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%FIRST_NAME%%', firstNamed));
                jQuery(this).html(jQuery(this).html().replaceAll('%%NAME%%', firstNamed));
            });
        }

        this.rankData = function(sqbarray, max_outcome_points, maxEl){
            
            if(maxEl < 1 || maxEl == undefined)
                maxEl = $this.find('.outcome_div').first().attr('data-outcome-id');

            var outcome_points_main = [];
            var outcome_ids_array = sqbarray;
            var sqb_rank_outcome_array_with_points = {};
            var sqb_outcome_index = '';
            for (sqb_outcome_index = 0; sqb_outcome_index < outcome_ids_array.length; sqb_outcome_index++) {
                var rank_outcome_id = outcome_ids_array[sqb_outcome_index];
                var outcome_points_default = 1;
                if(($this.find('input[name="weighted_score"]').length != 0) && ($this.find('input[name="weighted_score"]').val() == "Y") && outcome_ids_points_array.length != 0 ){
                    if(outcome_ids_points_array[rank_outcome_id]){
                        outcome_points_default = outcome_ids_points_array[rank_outcome_id];
                    }
                }
                    
                if(rank_outcome_id in sqb_rank_outcome_array_with_points){
                    sqb_rank_outcome_array_with_points[rank_outcome_id] = sqb_rank_outcome_array_with_points[rank_outcome_id] + outcome_points_default;
                }else{
                    sqb_rank_outcome_array_with_points[rank_outcome_id] = outcome_points_default;
                }
            }
            
            var sqb_rank_outcome_array_with_points_array = [];
            for (var sqb_rank_outcome_array_with_point in sqb_rank_outcome_array_with_points) {
                sqb_rank_outcome_array_with_points_array.push([sqb_rank_outcome_array_with_point, sqb_rank_outcome_array_with_points[sqb_rank_outcome_array_with_point]]);
            }

            sqb_rank_outcome_array_with_points_array.sort(function(a, b) {
                return b[1] - a[1];
            });
           
           console.log(sqb_rank_outcome_array_with_points_array);
            
            $outcome_outer.find('.outcome_div#outcome_id_'+maxEl).each(function(){
               
                var all_outcome_list_array = {};
                $outcome_outer.find('.outcome_div').each(function(){
                    all_outcome_list_array[parseInt(jQuery(this).find('input[name="outcome_id"]').val())] = jQuery(this).find('#outcome_name').val();
                });
                
                var all_outcome_list_array_clone = all_outcome_list_array;
                var sqb_rank_outcome_array_with_points_array_new = [];
                for (var k = 0; k < $this.find('.quiz_result_template_outer .outcome_div').length; k++) {
                    var outcome_points = '';
                    var outcome_name = '';
                    var kk = k+1;
                    
                    if(sqb_rank_outcome_array_with_points_array[k]){
                
                        var outcome_id = sqb_rank_outcome_array_with_points_array[k][0];
                        delete all_outcome_list_array_clone[outcome_id];
                        outcome_points = sqb_rank_outcome_array_with_points_array[k][1];
                        outcome_name = $this.find('#outcome_id_'+outcome_id).find('#outcome_name').val();
                        
                        if(($this.find('input[name="weighted_score"]').length != 0) && ($this.find('input[name="weighted_score"]').val() == "Y") && outcome_ids_points_array.length != 0 ){
                            if(jQuery.isNumeric(outcome_ids_points_array[outcome_id])){
                                outcome_points = outcome_ids_points_array[outcome_id];
                                sqb_rank_outcome_array_with_points_array_new.push([outcome_id, outcome_points]);
                            }
                        }
                    }else{
                        var sqb_keys = Object.keys(all_outcome_list_array_clone);
                        if(sqb_keys != ''){                 
                            var sqb_random_key = sqb_keys[Math.floor(Math.random() * sqb_keys.length)];
                            outcome_name = all_outcome_list_array_clone[sqb_random_key];
                            outcome_points = 0;
                            delete all_outcome_list_array_clone[sqb_random_key];
                        }
                    }
                }
            
                sqb_rank_outcome_array_with_points_array_new.sort(function(a, b) {
                    return b[1] - a[1];
                });
                
                var outcome_html = $outcome_outer.find('#outcome_id_'+maxEl).html();
                for (var j = 0; j < $this.find('.quiz_result_template_outer .outcome_div').length; j++) {
                    
                    var outcome_points = '';
                    var outcome_name = '';
                    var jj = j+1;
                        
                    if(sqb_rank_outcome_array_with_points_array_new[j]){
                        var outcome_id = sqb_rank_outcome_array_with_points_array_new[j][0];
                        delete all_outcome_list_array_clone[outcome_id];
                        outcome_points = sqb_rank_outcome_array_with_points_array_new[j][1];
                        outcome_name = $this.find('#outcome_id_'+outcome_id).find('#outcome_name').val();
                    }else{
                        var sqb_keys = Object.keys(all_outcome_list_array_clone);
                        if(sqb_keys != ''){                 
                            var sqb_random_key = sqb_keys[Math.floor(Math.random() * sqb_keys.length)];
                            
                            outcome_name = all_outcome_list_array_clone[sqb_random_key];
                            outcome_points = 0;
                            delete all_outcome_list_array_clone[sqb_random_key];
                        }
                    }

                    $_self.addMergTag('[WEIGHTED_SCORE]',max_outcome_points);
                    $_self.addMergTag('[RANK'+jj+'_OUTCOME_TITLE]','<div class="outcome_name_dt">'+outcome_name+'</div>');
                    $_self.addMergTag('[RANK'+jj+'_SCORE]','<div class="outcome_score_dt">'+outcome_points+'</div>');
                    outcome_points_main[jj] = outcome_points;
                    
                    if (sqb_rank_outcome_array_with_points_array.length > 0 && Object.keys(rank_outcome).length > 0) {
                        let existingIds = new Set(sqb_rank_outcome_array_with_points_array.map(item => item[0]));
                    
                        // Iterate through the rank_outcome object
                        for (let id in rank_outcome) {
                            if (!existingIds.has(id) && rank_outcome[id]) {
                                // Add it to the array if conditions are met
                                sqb_rank_outcome_array_with_points_array.push([id, 1]);
                            }
                        }
                    }
                                   

                    jQuery.each(sqb_rank_outcome_array_with_points_array, function(index, value){

                        var ot_id = value[0];
                        var id = index+1;
                        
                        if(rank_outcome[ot_id] != undefined && rank_outcome[ot_id] != ''){
                            var outcome_title = jQuery('#outcome_id_'+ot_id).find('#outcome_name').val();
                            console.log(ot_id);
                            console.log(outcome_title);
                            var content = rank_outcome[ot_id]['description'];
                            $_self.addMergTag('[ShowOutcomeDesc Rank="'+id+'"]','<span class="sod-inner">'+content+'</span>');
                            $_self.addMergTag('[ShowOutcomeTitle Rank="'+id+'"]','<span class="sot-inner">'+outcome_title+'</span>');
                        }
            
                    });
                }

                console.log(merge_tags);

                if(outcome_points_main.length > 0){

                    var sum = outcome_points_main.reduce(function (x, y) {
                        return x + y;
                    }, 0);

                    
                    jQuery.each(outcome_points_main, function(index, value){
                        try{
                            if(typeof value == 'undefined' || value == ''){
                                value = 0;
                            }
                            var ttotal = value*100/sum;
                        }catch(err) {
                            var ttotal = 0;
                        }
                        if(isNaN(ttotal)){
                            ttotal = 0;
                        }
                        $_self.addMergTag('[RANK'+index+'_PERCENT]','<div class="outcome_score_dt">'+parseFloat(ttotal).toFixed(2)+'</div>');
                    });
                }

            });

        }

        this.removeUnusedMergTag = function(outcome_id){

            if($this.find('.outcome_data_description').length > 0){
                $this.find('.outcome_data_description').each(function(){
                    if(jQuery(this).find('.sod-inner').length < 1){
                        jQuery(this).html('');
                    }
                    
                });
            }
        
            if($this.find('.outcome_data_title').length > 0){
                $this.find('.outcome_data_title').each(function(){
                    if(jQuery(this).find('.sot-inner').length < 1){
                        jQuery(this).html('');
                    }
                    
                });
            }
        }

        this.calculatorOutcomeCalc = function(){

            var final_outcome_id = 0;
            $this.find('.sqb_formula_data').each(function(){
                var sqb_formula_id = jQuery(this).attr('id');
                var sqb_formula_data = jQuery(this).text();
                var data_prefix = jQuery(this).attr('data-prefix');
                var data_sufix = jQuery(this).attr('data-sufix');
                var data_numtype = jQuery(this).attr('data-numtype');
                var data_range = jQuery(this).attr('data-range');
                var data_outcome = jQuery(this).attr('data-outcome');
                var sqb_formula_data = jQuery(this).attr('data-formula');
                var quesformula_value_reverse = [];
                var tmp = Object.values(questions_points);

                for (var i = tmp.length; i >= 1; i--) {
                    quesformula_value_reverse.push(tmp[i-1]);
                }

                jQuery.each(quesformula_value_reverse, function(index, value){
                    var length = Object.entries(questions_points).length;
                    var last_index = length - index;
                    var findstr = 'Q'+last_index;
                    if(sqb_formula_data.indexOf(findstr+'W') >= 0 || sqb_formula_data.indexOf(findstr+'H') >= 0){
        
                        if (sqb_formula_data.indexOf(findstr+'W') >= 0){
                            var jw = sqb_formula_data.split(findstr+'W');
                            count1w = jw.length - 1;
                            for(var i = 0 ; i <= count1w; i++){
                                sqb_formula_data = sqb_formula_data.replace(findstr+'W', value['w']);
                            }
                        }
                        if(sqb_formula_data.indexOf(findstr+'H') >= 0){
                            var jh = sqb_formula_data.split(findstr+'H');
                            count1h = jh.length - 1;
                            for(var i = 0 ; i <= count1h; i++){
                                sqb_formula_data = sqb_formula_data.replace(findstr+'H', value['h']);
                            }
                        }
        
                    }else if (sqb_formula_data.indexOf(findstr) >= 0){
                        var j = sqb_formula_data.split(findstr);
                        count1 = j.length - 1;    
                        for(var i = 0 ; i <= count1; i++){
                            sqb_formula_data = sqb_formula_data.replace(findstr, value);
                        }                
                    }else{
                        count1 = -1;
                    }
                    
                });

                
                try{
                    var parser = math.parser();
                    sqb_formula_data = sqb_formula_data.replace(/&&/g, 'and');
                    var final_res1 = parser.evaluate(sqb_formula_data);
                }catch(err) {
                    console.log('Invalid expression');
                    var final_res1 = 0;
                }
               
                if($_self.isNumeric(final_res1)){
                    var value = final_res1;
                }else{
                    var value = final_res1.toFixed(2);
                }

                var sqb_forid = jQuery(this).attr('data-formmulaid');
                $this.find('.formula_advanced_rules').each(function(){

                    if(sqb_forid == jQuery(this).attr('data-formulaid')){
                        var datatitle = jQuery(this).attr('data-title');
                        if(datatitle =="number"){
                            var datanum = jQuery(this).attr('data-range');
                            var formulaid = jQuery(this).attr('data-formulaid');                                 
                            if(datanum >0){              
                                if(value == datanum){
                                    founddata = true;
                                    $this.find('#final_formula_val').val(1);
                                    var outcome_id = jQuery(this).val();
                                    final_outcome_id = outcome_id;
                                    return false;
                                }
                            }
                        }else if(datatitle =="range"){
                            var datastart = jQuery(this).attr('data-start');
                            var dataend = jQuery(this).attr('data-end');                                              
                            if(value >= datastart ){
                                if( value <= dataend){                                  
                                    founddata = true;
                                    $this.find('#final_formula_val').val(1);
                                    var outcome_id = jQuery(this).val();
                                    final_outcome_id = outcome_id;
                                    return false;
                                }
                            }                      
                        }
                    }
                });

                if(typeof data_prefix != 'undefined' && data_prefix != '' ){
                    value = data_prefix+value;
                }
                if(typeof data_sufix != 'undefined' && data_sufix != '' ){
                    value = value+data_sufix;
                }

                jQuery(this).html(sqbCommaSeparateNumber(value));

            });

            var outcomerule_id = $this.find("#outcome_advanced_rule_id").val();
            if(outcomerule_id >0){
                outcome_final = outcomerule_id;
                return outcomerule_id;
            }
            
            if(!final_outcome_id){
                final_outcome_id = $this.find('.outcome_div').first().attr('data-outcome-id');
            }

            return final_outcome_id;
        }

        this.isNumeric = function(value) {
            return /^-?\d+$/.test(value);
        }

        this.assessmentOutcomeCalc = function(){
            var sqb_quiz_container_outer_id = $this.attr('id');
            var display_correctans_options = jQuery('#'+sqb_quiz_container_outer_id+ ' #display_correctans_options').val(); 
            var correct_ans_count = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
            var outcome_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_type').val();
            var outcome_div_id= "";
            //advanced rule 
            /*var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val(); 
            if(outcomerule_id >0){
                jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();    
                jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcomerule_id).show(); 
                return ;
            } */
            var final_outcome_id = 0;
            if(outcome_type == "correct_ans"){                    
                jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){                         
                        var data_points = jQuery(this).attr("data-point");  
                        var outcome_id = jQuery(this).attr('id');   
                        var max_outcome_obj ="#"+outcome_id;             
                        
                        var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val();   
                        var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val();
                        min_outcome_point = parseInt(min_outcome_point);
                        max_outcome_point = parseInt(max_outcome_point);    
                        data_points = parseInt(data_points) ;   
                        correct_ans_count = parseInt(correct_ans_count) ;   
                        if(data_points == correct_ans_count){   
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                            outcome_div_id= this;                
                        }else{                      
                            
                            if (jQuery(this).attr('data-point') == max_outcome_point ) {
                                if(sqb_points_ans > max_outcome_point){ 
                                    final_outcome_id = jQuery(this).attr('data-outcome-id');
                                    outcome_div_id= this;
                                } 
                            }
                            if (jQuery(this).attr('data-point') == min_outcome_point ) {
                                if(sqb_points_ans < min_outcome_point){ 
                                    final_outcome_id = jQuery(this).attr('data-outcome-id');
                                    outcome_div_id= this;
                                } 
                            }                        
                        }                
                });
                
            }else{
                var max_outcome_obj  = 'not_show_outcome';
                var sqb_correct_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();
                var min_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #min_outcome_point').val();  
                var max_outcome_point = jQuery('#'+sqb_quiz_container_outer_id+ ' #max_outcome_point').val(); 
                
                jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){                         
                    var data_point_min = jQuery(this).attr("data-point-min");   //1  //correct_ans_count =1              
                    var data_point_max = jQuery(this).attr("data-point-max");   //2 
                    var data_points = jQuery(this).attr("data-point");  
                    data_point_min = parseInt(data_point_min) ;      
                    data_point_max = parseInt(data_point_max) ;      
                    data_points = parseInt(data_points) ;        
                    sqb_correct_ans = parseInt(sqb_correct_ans) ;                            
                    if(data_point_min <= sqb_correct_ans){                                              
                        if(data_point_max >= sqb_correct_ans){                              
                            max_outcome_obj = this;     
                            final_outcome_id = jQuery(this).attr('data-outcome-id');                                 
                        }            
                    }
                });
        
                jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').hide();
                if(max_outcome_obj != 'not_show_outcome'){
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(){                         
                        var data_point_min = jQuery(this).attr("data-point-min");   //1   
                        var data_point_max = jQuery(this).attr("data-point-max");   //2 
                        if (data_point_min == min_outcome_point ) {
                            max_outcome_obj = this; 
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                        }else if (data_point_max == max_outcome_point ) {
                            max_outcome_obj = this; 
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                        }else if (sqb_correct_ans > max_outcome_point){
                            max_outcome_obj = this; 
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                        }else if (sqb_correct_ans < min_outcome_point){
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                            max_outcome_obj = this; 
                        }
                    });
                    //jQuery(max_outcome_obj).show();       

                    if(!final_outcome_id){
                        $this.find('.outcome_div').first().attr('data-outcome-id');
                    }
                }
            } //else end  

            return final_outcome_id;
        }

        this.surveyOutcomeCalc = function(){
            final_outcome_id = 0;
            var outcomerule_id = $this.find("#outcome_advanced_rule_id").val(); 
            if(outcomerule_id >0){
                $this.find(".outcome_div").hide();
                //jQuery("#outcome_id_"+outcomerule_id).show();
                final_outcome_id = outcomerule_id;
                return final_outcome_id;
            }

            return final_outcome_id;
        }

        this.scoringOutcomeCalc = function(){

            if(this.isCategory()){
                if(Object.keys(cat_ids).length != 0){
                    $this.find('input[name="category_result_list_json"]').val(JSON.stringify(cat_ids));
                }
            }

            if(this.isCategory() && $this.find('.cat_advanced_rules').length > 0){
                return this.getCategoryOutcome();
            }

            var display_correctans_options = $this.find('#display_correctans_options').val();   
            var correct_ans_count = $this.find('#sqb_correct_ans').val();   
            var outcome_type = $this.find('#outcome_type').val();   
            var sqb_points_ans = $this.find('#sqb_points_ans').val();
            var total_pt = $this.find('#points_count').val();   
            var min_outcome_point = $this.find('#min_outcome_point').val();
            var max_outcome_point = $this.find('#max_outcome_point').val();
            var outcome_div_id= "";
            var final_outcome_id = 0;
             //advanced rule    
            var outcomerule_id = $this.find("#outcome_advanced_rule_id").val(); 
            if(outcomerule_id >0){
                //$this.find(".outcome_div").hide();
                //$this.find("#outcome_id_"+outcomerule_id).show();
                return outcomerule_id;
            }

            //which outcome to show calculation here        
             if(outcome_type == "correct_ans"){
                   var get_outcome = false;
                    $this.find('.outcome_div').each(function(){
                        var data_points = jQuery(this).attr("data-point");
                        var outcome_id = jQuery(this).attr('id');
                        var max_outcome_obj ="#"+outcome_id;
                        
                        min_outcome_point = parseInt(min_outcome_point);
                        max_outcome_point = parseInt(max_outcome_point);
                        data_points = parseInt(data_points);
                        sqb_points_ans = parseInt(sqb_points_ans);
                                                    
                        if(data_points == sqb_points_ans){
                            final_outcome_id = jQuery(this).attr('data-outcome-id');
                            get_outcome = true;
                            if(get_outcome){
                                return false;
                            }
                        }else{
                            if (data_points == max_outcome_point ) {
                                if(sqb_points_ans > max_outcome_point){
                                    final_outcome_id = jQuery(this).attr('data-outcome-id');
                                }
                            }
                            if (data_points == min_outcome_point ) {
                                if(sqb_points_ans < min_outcome_point){
                                    final_outcome_id = jQuery(this).attr('data-outcome-id');
                                }
                            }
                        }
                    });
                }else{
                    var max_outcome_obj  = 'not_show_outcome';
                    $this.find('.outcome_div').each(function(){
                        var data_point_min = jQuery(this).attr("data-point-min");
                        var data_point_max = jQuery(this).attr("data-point-max");
                        var data_points = jQuery(this).attr("data-point");
                        var outcome_id = jQuery(this).attr('data-outcome-id');
                        data_point_min = parseInt(data_point_min);
                        data_point_max = parseInt(data_point_max);
                        sqb_points_ans = parseInt(sqb_points_ans);
                        data_points = parseInt(data_points);
                        if(data_point_min <= sqb_points_ans  ){                                             
                            if(data_point_max >= sqb_points_ans){
                                final_outcome_id = outcome_id;                          
                                max_outcome_obj = this;                             
                            }
                        }
                    });

                    if(max_outcome_obj != 'not_show_outcome'){                                      
                    }else{
                        var outcome_found = false;
                        $this.find('.outcome_div').each(function(i){                      
                            var data_point_min = jQuery(this).attr("data-point-min");
                            var data_point_max = jQuery(this).attr("data-point-max");
                            var outcome_id = jQuery(this).attr('data-outcome-id');
                            if(sqb_points_ans > 0){
                                if (data_point_min == min_outcome_point ) {                                   
                                    final_outcome_id = outcome_id;
                                }else if (data_point_max == max_outcome_point){ 
                                    final_outcome_id = outcome_id;
                                }else if (sqb_points_ans > max_outcome_point){
                                    final_outcome_id = outcome_id;
                                }else if (sqb_points_ans < min_outcome_point){
                                    final_outcome_id = outcome_id;
                                }
                            } else {
                                if(data_point_max < 0){
                                    var data_point_max_new = data_point_max * -1;
                                }
                                if(data_point_min < 0){
                                    var data_point_min_new = data_point_min * -1;
                                }
                                if(sqb_points_ans < 0){
                                    var sqb_points_ans_new = sqb_points_ans * -1;
                                }
                                if(sqb_points_ans_new <= data_point_max_new && sqb_points_ans_new >= data_point_min_new){
                                    final_outcome_id = outcome_id;
                                }
                            }
                        });
                        if(!final_outcome_id){
                            $this.find('.outcome_div').first().attr('data-outcome-id');
                        }
                    }
                } 
            
            // display ques-ans in result page               
            /*if(display_correctans_options == "both" || display_correctans_options == "result_page"){                  
                sqb_show_ques_ans_in_resultpage(sqb_quiz_container_outer_id);
            }*/

            // save report info
            //if(notcount != 'notcount'){ this.saveReport('quiz_last_question_btn_click'); }

            return final_outcome_id;
        }

        this.addMergTag = function(key,value){
            var item = {'key' : key,'value':value}
            merge_tags.push(item);
        }

        this.personalityOutcomeCalc = function(){

            var outcome_type = $this.find('#outcome_type').val();
            var outcomerule_id = $this.find("#outcome_advanced_rule_id").val(); 
            if(outcomerule_id >0){
                return outcomerule_id;
            }

            if(outcome_ids_array.length > 0){
                outcome_ids_array = outcome_ids_array.sort((a, b) => {
                    const countA = outcome_ids_array.filter(x => x === a).length;
                    const countB = outcome_ids_array.filter(x => x === b).length;
                    
                    if (countA !== countB) {
                        return countB - countA; // Sort by frequency (descending)
                    } else {
                        return parseInt(a) - parseInt(b); // If frequency is the same, sort ascending
                    }
                });
            }
            
            var sqb_outcome_max_key = this.sqb_mode(outcome_ids_array);      
            if(sqb_outcome_max_key > 0 ){
            }else{
                var outcome_id_val = $this.find('.outcome_div').first().attr("id"); 
                sqb_outcome_max_key = outcome_id_val.replace("outcome_id_","");          
            }
            
           
            return sqb_outcome_max_key;
        }

        this.getCurrentOutcome = function(){

            var outcome_id = 0;
            if(quiz_type == 'personality'){
                outcome_id = this.personalityOutcomeCalc();
            }else if(quiz_type == 'scoring'){
                outcome_id = this.scoringOutcomeCalc();
            }else if(quiz_type == 'survey'){
                outcome_id = this.surveyOutcomeCalc();
            }else if(quiz_type == 'assessment'){
                outcome_id = this.assessmentOutcomeCalc();
            }else if(this.isQuiz('calculator')){
                outcome_id = this.calculatorOutcomeCalc();
            }

            if(outcome_id < 1){
                outcome_id = this.getDefaultOutcome();
            }

            outcome_final = outcome_id;
            return outcome_id;
        }

        var outcomerule_id = $this.find("#outcome_advanced_rule_id").val();
        if(outcomerule_id >0){
            outcome_final = outcomerule_id;
            return outcomerule_id;
        }

        this.getDefaultOutcome = function(){
            return $outcome_outer.find('.outcome_div').first().attr('data-outcome-id'); 
        }

        this.submitOptin = function(){

            if(!this.validateOptin()){
                if(auto_submit_optin == 'Y'){
                    $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                }
                return false;
            }else if(quick_email_verification == 'Y'){
                var email = this.getOptinField('email');
                this.emailChecker(email);
            }else{
                if(opt_screen_position == 'optin-before-questions-screen'){

                    if(opt_screen_automation == 1){
                        this.backgroundOptinProcess();
                    }

                    $optin_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                    $quesans_outer.addClass('show_cls').removeClass('hide_cls');
                    this.initSinglePage();
                    this.playSilentVideo($quesans_outer.find('.Quiz-Template-outer div.Quiz-Template:first'));

                    this.firstNameReplace();
                    var sqb_quiz_container_outer_id = $this.attr('id');
                    this.displayMessageInScreens(sqb_quiz_container_outer_id);
                    this.displayMessageSpeedInScreens();
                }else{
                    //console.log('gtg');
                    this.submitQuiz();
                }
            } 
        }

        this.submitQuiz = function(){

            var continue_btn_text = $optin_btn.html();
            if(quiz_type == 'form'){
                $outcome_outer.find('.outcome_div').show();
            }
            var sqb_quiz_attempted = $this.find('#quiz_attempted').val();
            
            if((show_optin == 'Y' && opt_screen_position == 'optin-before-questions-screen') && sqb_quiz_attempted == 'N'){
                
                if(this.validateOptin()){
                    var resultdata = this.saveQuizData("", "" ,"", continue_btn_text);
                }
            } else {
            
                    if(quiz_type == 'poll'){
                        var resultdata = this.saveQuizData("", "" ,"", continue_btn_text);
                    }else{
                        var resultdata = this.saveQuizData("", "" ,"", continue_btn_text);
                    }

                if($this.find("#sqbgdprcheckbox").hasClass('required') && $this.find("#sqbgdprcheckbox").prop('checked') == false){
                    $this.find('.sqb-gdpr-checkbox .checkbox-custom-style').addClass('checkbox-focus');
                }

                var outcome_id= 0;
                if($this.find("#outcome_final").length != 0){
                    outcome_id =  $this.find("#outcome_final").val();
                }
                if(outcome_id != 0){
                    sqb_update_outcome_ranking_merge_tag(outcome_id);
                }
            }
        }

        this.thirdPartySubmit = function(){
            
        }

        this.processRecommendation = function($question){
            $question.find('.sqb_ans_selected').removeClass('ans_recommendation_enable');
            $question.find('.sqb_ans_selected').addClass('ans_recommendation_show'); 
            var cr_ans_id = $question.find('.sqb_ans_selected').find('.sqb_ans_item').attr('id');
            var $ans_rec_outer = $question.closest('.Quiz-Template').find('.quiz_ans_recommendation_html');
            if($ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).length != 0){
                var sqb_recommendation_enabled = $ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).attr('sqb_recommendation_enabled');
                if(sqb_recommendation_enabled == 'Y'){
                    $ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).closest('.quiz_ans_recommendation_html').show().find('.sqb_cr_next_btn_div').attr('data-ans-attr-id',cr_ans_id);
                    $ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).closest('.Quiz-Template').addClass('ans-recommendation-active');
                $question.find('.sqb_ans_selected').closest('.Quiz-Template-overflow').hide();
                }
            }
            $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
            $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');
        }

        this.processAds = function($question){
            var $quiz_template = $question.closest('.Quiz-Template');
            if($quiz_template.find('.quiz_ans_a_d_html_outer').length > 0){
                $quiz_template.find('.Quiz-Template-overflow').hide();
                $quiz_template.find('.quiz_ans_a_d_html_outer').show();
                $quiz_template.addClass('is_a_d_active');
            }
            $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
            $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');
        }

        this.processOutcomeAnimation = function(outcome_id){
            if($this.find('.quiz_fun_animation_main').length < 1){
                return false;
            }

            var timer = $this.find('#game_animation_timer').val();
            var is_outcome_level = $this.find('#game_animation_outcome_level').val();
            var template = $this.find('#game_animation_template').val();
            var audio_option = $this.find('#game_animation_audio_option').val();

            jQuery('html').addClass('sqb-celebration-animation-on').addClass('sqb-animation-'+template);
            $this.find('.quiz_fun_animation_main').show();

            if(fun_animation_main_clone != ''){
                var fun_animation_main = fun_animation_main_clone;
            }else{
                var fun_animation_main = $this.find('.quiz_fun_animation_main').html();
                fun_animation_main_clone = fun_animation_main;
            }

            var first_name = this.getOptinField('first_name');
            fun_animation_main = fun_animation_main.replaceAll('%%FIRST_NAME%%', first_name);
            fun_animation_main = fun_animation_main.replaceAll('%%FIRST%%', first_name);
            fun_animation_main = fun_animation_main.replaceAll('%%NAME%%', first_name);
            

            if(quiz_type == 'scoring' || quiz_type == 'personality'){
                var sqb_points_ans = $this.find('#sqb_points_ans').val();
                var total_pt = $this.find('#points_count').val();        
                if(sqb_points_ans =="NaN"   || sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
                    sqb_points_ans =0;
                }

                
                fun_animation_main = fun_animation_main.replaceAll('%%YOURSCORE%%', sqb_points_ans);
                fun_animation_main = fun_animation_main.replaceAll('%%TOTALSCORE%%', total_pt);
                fun_animation_main = fun_animation_main.replaceAll('%%SCOREINPERCENT%%', this.calculate_percentage(total_pt,sqb_points_ans));
            }

            var outcome_title = $this.find('#outcome_id_'+outcome_id).find('#outcome_name').val();
            fun_animation_main = fun_animation_main.replaceAll('%%OUTCOME_TITLE%%', outcome_title);
            $this.find('.quiz_fun_animation_main').html(fun_animation_main);

            if(is_outcome_level == 'Y'){
                $this.find('#fun-animation-outcome-'+outcome_id).show();
            }
            
            if(audio_option == 'Y'){
                  $this.find('.sqb_player_audio').trigger('click');
            }
            setTimeout(function(){
                if(audio_option == 'Y'){
                    $this.find('.sqb_player_audio').trigger('click');
                }
                jQuery('html').removeClass('sqb-celebration-animation-on').removeClass('sqb-animation-'+template);
                $this.find('.quiz_fun_animation_main').hide();
                if(is_outcome_level == 'Y'){
                    $this.find('#fun-animation-outcome').hide();
                }
                //is_animation_running = false;
            },timer);
        }

        this.validateOptin = function(){

            $this.find('.sqbwarning_div').remove();

            if(show_optin != 'Y'){
                is_valid = true;
            }

            if(skip_optin == true){
                return true;
            }

            if(third_party == "Y"){
                is_valid = true;
                inputBlankFound = false;
                $this.find('.Quiz-Template-content form input,.Quiz-Template-content form textarea, .Quiz-Template-content form select').each(function(){
                    var field_val = jQuery(this).val();
                    var field_name = jQuery(this).attr("name");
                    var field_type = jQuery(this).attr("type");
                    if(jQuery(this).hasClass('sqb_required_cls')){
                        if(field_type == 'checkbox' && !jQuery(this).prop('checked')){
                            inputBlankFound = true;
                        }else if((field_type != 'checkbox') && (field_val == "" || field_val == null || typeof field_val == "undefined")){
                            inputBlankFound =true;  
                        }else{
                            inputBlankFound =false;
                        }
                    }
                });
            
                if(inputBlankFound){
                    $this.find('.quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+required_field+'</b></div>');
                    is_valid = false;
                }

                var gdpr_required = '';
                if(gdpr_value == 1){
                     var gdpr_condition_req = $this.find('#sqb_direct_signup #sqbgdprcheckbox').hasClass('required');
                    var gdpr_cond_visi = $this.find('#sqb_direct_signup .sqb-gdpr-checkbox').css('display');
                    if(gdpr_condition_req == true && gdpr_cond_visi != 'none' && $this.find('#sqbgdprcheckbox').prop('checked') !=  true){
                        this.printOptinMessage(gdpr_required_field);
                        is_valid = false;
                    }else{
                        if($this.find("#sqbgdprcheckbox").hasClass('required') || $this.find('#sqbgdprcheckbox').prop('checked') ==  true){
                            var gdpr_required = 'Y';
                        }else{
                            var gdpr_required = 'N';
                        }
                    }
                }
                return is_valid;
            }

            var first_name = this.getOptinField('first_name');
            var email = this.getOptinField('email');
            if(gdpr_value == 1){
                var gdpr_condition_req = $this.find('#sqb_direct_signup #sqbgdprcheckbox').hasClass('required');
                var gdpr_cond_visi = $this.find('#sqb_direct_signup .sqb-gdpr-checkbox').css('display');
            }

            var firstname_temp = $this.find('.sqb_first_name').val();       
            if(first_name ==""){
                var first_name = $this.find('#sqb_direct_signup #first_name').val();    
            } else{
                //var terms_condition_req = false;
            }
            if(email ==""){     
                var email = $this.find('#sqb_direct_signup #email').val();      
            } else{     
                //var terms_condition_req = false;
            }
            
            var is_valid = true;
            if(first_name == "" && first_name_visi != 'none'){
                this.printOptinMessage(username_empty_msg);
                is_valid = false;
            }   
            if(email == ""){
                this.printOptinMessage(email_empty_msg);
                is_valid = false;
            } 
            if(!this.validateEmail(email)){
                this.printOptinMessage(valid_email);
                is_valid = false;
            } 
            if(terms_condition_req == true && terms_cond_visi != 'none' && $this.find('#sqbcheckbox').prop('checked') !=  true){
                this.printOptinMessage(terms_condition_msg);
                is_valid = false;
            }
            
            $this.find('.custom_add_fields').each(function(){
                
                if(jQuery(this).hasClass('required') == true && jQuery(this).find('input[type=text], textarea,select').val() == '' && jQuery(this).is(':visible')){
                    $_self.printCfieldsMessage(this);
                    is_valid = false;   
                }

                if(jQuery(this).hasClass('required') == true && jQuery(this).find('.custom-phone-number').length > 0 && jQuery(this).is(':visible')){
                    console.log(itis);
                    if(jQuery(this).find('.custom-phone-number').val() != '' && !itis.isValidNumber()){
                        var sqb_valid_phonenumber = jQuery('#sqb_valid_phonenumber').val();
                        $_self.printCfieldsMessage(this,sqb_valid_phonenumber);
                        is_valid = false;   
                    }
                }

                if(jQuery(this).hasClass('required') == true && (jQuery(this).find('input[type=radio]').length > 0)){
                    if(jQuery(this).find('input[type=radio]').is(':checked') == false){
                        $_self.printCfieldsMessage(this);
                        is_valid = false;
                    }
                }
                if(jQuery(this).hasClass('required') == true && jQuery(this).find('input[type=checkbox]').is(':checked') == false){
                    if(jQuery(this).find('input[type=checkbox]').length > 0){
                        if(jQuery(this).find('input[type=checkbox]').is(':checked') == false){
                            $_self.printCfieldsMessage(this);
                            is_valid = false;   
                        }
                    }
                }
            });

            

            //var gdpr_value = $this.find('#gdpr_compliance').val();
            var gdpr_required = '';
            if(gdpr_value == 1){
                if(gdpr_condition_req == true && gdpr_cond_visi != 'none' && $this.find('#sqbgdprcheckbox').prop('checked') !=  true){
                    this.printOptinMessage(gdpr_required_field);
                    is_valid = false;
                }else{
                    if($this.find("#sqbgdprcheckbox").hasClass('required') || $this.find('#sqbgdprcheckbox').prop('checked') ==  true){
                        var gdpr_required = 'Y';
                    }else{
                        var gdpr_required = 'N';
                    }
                }
            }
            return is_valid;
        }

        this.showLoaderonLastQuestion = function(){
            $question = $this.find('.question_container.show_cls');
            $question.addClass("question_container_disabled");
            $question.after('<div class="spinner spinner1"><div class="bounce1"></div><div class="bounce2"></div></div>');
        }
        this.saveQuizData = function(is_skip = false){

            $this.find('.sqb_custom_field_required_class').hide();
        
            if(this.isQuiz('form')){
                final_outcome =  this.getCurrentOutcome();
            }


            this.bindCustomEvent(
                document.querySelector('.continue_btn'),'sqb_optin_click', { 
                    id: $this.attr('id'),
                    quiz_id:quiz_id,
                    outcome_id: final_outcome
                });

            // Working
            /*if(btn_click =="no"){
                //check if Retake need to show on not for non-lesson
                var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();        
                if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){   
                    //for non-lesson context
                    setSQBCookieForRetake(sqb_quiz_container_outer_id);          
                }
            }*/
            
            var first_name = this.getOptinField('first_name');
            var email = this.getOptinField('email');
    
            $this.find('.sqbwarning_div').remove();
            //var gdpr_value = $this.find('#gdpr_compliance').val();
            if(gdpr_value == 1){
                var gdpr_condition_req = $this.find('#sqb_direct_signup #sqbgdprcheckbox').hasClass('required');
                var gdpr_cond_visi = $this.find('#sqb_direct_signup .sqb-gdpr-checkbox').css('display');
            }

            if(third_party != 'Y'){

                var firstname_temp = $this.find('.sqb_first_name').val();
                var email = $this.find('#sqb_direct_signup #email').val();          
                if(first_name ==""){
                    var first_name = $this.find('#sqb_direct_signup #first_name').val();    
                }

                if(email ==""){
                    var email = $this.find('#sqb_direct_signup #email').val();      
                } else{
                    var terms_condition_req = false;
                }

                // Skip Optin
                if(show_optin != 'Y'){

                    get_name = this.getOptinField('first_name');
                    if(get_name == ""){
                        first_name = 'SQBGuest';
                    }else{
                        first_name = get_name;
                    }

                    email =  "sqbguest@"+site_url;
                    this.showLoaderonLastQuestion();
                }else{

                    if(is_skip == true || skip_optin == true){
                        if($this.find('.skip_optin').is(":visible") || skip_optin == true){
                            get_name = this.getOptinField('first_name');
                            if(get_name == ""){
                                first_name = 'SQBGuest';
                            }else{
                                first_name = get_name;
                            }
                            email =  "sqbguest@"+site_url;
                        }
                    }else{
                        if(!this.validateOptin()){
                            return;
                        }
                    }
                    
                    if(opt_screen_position == 'optin-before-questions-screen' || auto_submit_optin == 'Y'){
                        this.showLoaderonLastQuestion();

                        $this.find('.pagination-next-btn .single_next_btn ').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                        $this.find('.pagination-next-btn .single_next_btn ').addClass('btn_disabled');

                    }

                    $optin_outer.find('.continue_btn').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
                    $optin_outer.find('.continue_btn').addClass('btn_disabled');

                }
            }else{
                var sqb_quiz_container_outer_id = $this.attr('id');
                jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form input, #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form textarea,  #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form select').each(function(){
                    var field_val = jQuery(this).val();
                    var field_name = jQuery(this).attr("name");
                    var field_type = jQuery(this).attr("type");
                
                    if(jQuery(this).hasClass('sqb_required_cls')){ 
                        if(field_type == 'checkbox' && !jQuery(this).prop('checked')){
                            
                            inputBlankFound = true;                      
                        }else if((field_type != 'checkbox') && (field_val == "" || field_val == null || typeof field_val == "undefined")){
                            inputBlankFound =true;  
                        }else{
                            inputBlankFound =false;
                        }
                    }
                }); 
                
                if(inputBlankFound){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+sqb_required_field+'</b></div>'); 
                    return false;
                }
                
                var first_name =   jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form input[name="'+optin_name+'"], #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form textarea[name="'+optin_name+'"],  #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form select[name="'+optin_name+'"]').val();
                var email =   jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form input[name="'+optin_email+'"], #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form textarea[name="'+optin_email+'"],  #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form select[name="'+optin_email+'"]').val();
                
                var opt_third_party_form_selector = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .Quiz-Template-content form");
                var new_third_party_form_acton_url = opt_third_party_form_selector.attr('action');
                var new_third_party_form_method = opt_third_party_form_selector.attr('method');              
                opt_third_party_form_selector.submit(
                    function(e){
                        var new_third_party_form_acton_url = opt_third_party_form_selector.attr('action');
                        var new_third_party_form_method = opt_third_party_form_selector.attr('method');                  
                        e.preventDefault();
                    jQuery.ajax({
                            url: new_third_party_form_acton_url,
                            type: new_third_party_form_method,
                            data:opt_third_party_form_selector.serialize(),
                            success:function(){
                                // Whatever you want to do after the form is successfully submitted
                                
                            }
                        });
                });
                opt_third_party_form_selector.submit();
            }

            if(gdpr_value && $this.find("#sqbgdprcheckbox").hasClass('required')) {
                var gdpr_required = 'Y';
            }else{
                var gdpr_required = 'N';
            }
            
            

            if(lesson_id < 1){
                if(auto_submit_optin == 'Y'){
                    
                    var r = 0;
                    if($optin_outer.hasClass('show_cls')){
                        r = 1;
                    }
                    $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    var optin_form_fields = $this.find("#sqb_direct_signup").find(":input:not(:hidden:not(.cfields-hidden-wrapper input))").serialize();

                    if(r == 0){
                        $optin_outer.addClass('hide_cls').removeClass('show_cls');
                    }
                }else{
                    if(show_optin == 'Y' && opt_screen_position == 'optin-before-questions-screen'){
                        $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    }
                    var optin_form_fields = $this.find("#sqb_direct_signup").find(":input:not(:hidden:not(.cfields-hidden-wrapper input))").serialize();
                    if(show_optin == 'Y' && opt_screen_position == 'optin-before-questions-screen'){
                        $optin_outer.addClass('hide_cls').removeClass('show_cls');
                    }
                }
                
            }else{
                var optin_form_fields = {};
            }

            var answerData = this.getAnswersData();
            var outcome_desc = $this.find('.quiz_result_hidden').html();
            var register_way = "WP";
            var sqb_custom_fields_array = [];
            $this.find('#sqb_direct_signup').find( "[id^='custom_']" ).each(function(){
                    var field_name = jQuery(this).attr('id').replace('custom_','');
                    sqb_custom_fields_array.push({field_name:field_name,field_value:jQuery(this).val()});
            });

            this.setSQBCookieForRetake();

            var outcome_id = final_outcome;
            
            var leaderboards_req = '';
            if($this.find('.sqb-outcome-leaderboard').length > 0){
                var leaderboards = [];
                $this.find('.sqb-outcome-leaderboard').each(function(){
                    leaderboards.push(jQuery(this).attr('data-id'));
                });
                leaderboards_req = leaderboards.join(",");

            }

            if(lesson_id > 0){
                signup_way = 'DAP';
            }else{
                signup_way = 'SQB';
            }

            var user_id = 0;
            if(lesson_id > 0){
                user_id = $this.find('#dap_id').val();
                var event = 'see_details_btn_clicked';
            }else{
                user_id = 0;
                var event = 'lead_optin_btn_click';
            }
            
            var outcomeCount = this.getOutcomeCount();
            var answer_tags = this.getOutcomeTags(outcome_id);

            this.beforeSubmitQuiz(outcome_id);

            var catdata = '';
            var category_number_percent = '';
            var category_only_percent = '';
            var category_score_breakdown_inpercent = '';
            var category_number_div = '';
            var category_list = '';
            if(this.isCategory()){
                var catdata = $this.find('#outcome_id_'+outcome_id+' .sqb_category_overall').html();
                var category_number_percent  = $this.find('#outcome_id_'+outcome_id+' .category_number_percent').html();
                var category_only_percent  = $this.find('#outcome_id_'+outcome_id+' .category_only_percent').html();
                var category_score_breakdown_inpercent  = $this.find('#outcome_id_'+outcome_id+' .category_score_breakdown_inpercent').html();
                var category_number_div= $this.find('#outcome_id_'+outcome_id+' .category_number_div').html();

                category_list = $this.find('input[name="category_result_list_json"]').val();  
                if(category_list != ''){ 
                    category_list = JSON.parse(category_list);
                }
            }
            
            temp_od = $this.find('#outcome_id_'+outcome_id+' #result_temp_contentid').html();
            outcome_desc = jQuery('<div>').append(temp_od).html();

            if(third_party == 'Y'){
                var namevisi = $optin_outer.find('.Quiz-Template-content form input[name="first_name"]').css('display');
                if(namevisi == 'none'){
                    first_name = '';
                }

                var namevisi = $optin_outer.find('.Quiz-Template-content form input[name="name"]').css('display');
                if(namevisi == 'none'){
                    first_name = '';
                }

            }else{
                if(first_name_visi == 'none'){
                    first_name = '';
                }
            }
            
            var speed_timer_enable = $this.find('#speed_timer_enable').val();
            if(speed_timer_enable == "Y"){
                var time_spent = $this.find('#speed_time_spent1').val();
            }else{
                var time_spent = $this.find('#time_spent1').val();
            }

            var how_many_answed = $this.find('.sqb_ans_selected').length;
            var is_poll = 0;
            var action = 'SQBSubmitQuizAjax';
            if(this.isQuiz('poll')){
                is_poll = 1;
                action = 'SQBSubmitVote';
            }
            quiz_processed = true;

            var sqb_correct_ans = $this.find('#sqb_correct_ans').val();
            var ques_count_ = $this.find('#ques_count').val();
            var total_pt = $this.find('#points_count').val();
            var yourpoints = $this.find('#sqb_points_ans').val();
            var data = {
                'is-v2' : '1',
                is_poll : is_poll,
                action: action,
                //nounce : nounce,
                first_name: first_name,
                // firstname_temp: firstname_temp,
                lesson_id : lesson_id,
                course_id : course_id,
                course_type : course_type,
                certificate_id : certificate_id,
                email: email,
                register_way: register_way,
                productId: productId,   
                signup_way: signup_way,
                quizId: quiz_id,
                quiz_id : quiz_id,  
                sqb_quiz_type: quiz_type,
                outcome_final: final_outcome,   
                sqb_question_answer_array: answerData,
                outcome_ids_array:outcome_ids_array,
                outcome_desc:outcome_desc,
                gdpr_required:gdpr_required,
                lead_type : event,
                category_result_list_array:category_list,
                optin_form_fields:optin_form_fields,
                sqb_custom_fields_array:sqb_custom_fields_array,
                catdata:catdata,
                category_number_percent:category_number_percent,
                category_only_percent:category_only_percent,
                category_score_breakdown_inpercent:category_score_breakdown_inpercent,
                category_number_div:category_number_div,
                show_optin:show_optin,
                outcome_id : final_outcome,
                outcome_ids: outcomeCount['label'],
                outcome_count : outcomeCount['count_data'],
                answer_tags : answer_tags,
                cat_ids : cat_ids,
                newcatarraylow : newcatarraylow,
                newcatarrayhigh : newcatarrayhigh,
                eachcat_ids : JSON.stringify(eachcat_ids),
                user_id : user_id,
                time_spent: time_spent,
                how_many_answed: how_many_answed,
                leaderboards_req : leaderboards_req,
                total_ques:ques_count_,
                correct_answers:sqb_correct_ans,
                total_pt : total_pt,
                yourpoints : yourpoints
                
                //double_optin:encodeURIComponent(double_optin), 
            };
            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: data,
                success: function (response) {

                    $_self.saveReport('quiz_opt_in_btn_click');
                    $optin_outer.find('.continue_btn').removeClass('btn_disabled');
                    var is_outcome_redirect =   $this.find('input#poll_redirect').val();
                    var sqb_quiz_container_outer_id = $this.attr('id');
                   
                    if($_self.isQuiz('poll') && is_outcome_redirect != 'Y'){

                        jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').removeClass("question_container_disabled");
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').next('.spinner').remove();
                        $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
                        $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');

                        $this.find('.sqb-vote-error').hide();
                        $this.find('.sqb-vote-error').html('');

                        if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
                        }else{
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
                        }

                        var response1 = JSON.parse(response);
                        var html = response1.html;
                        var count_vote = response1.count_vote;
                        var user_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();

                        jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls_poll').removeClass('hide_cls');


                        var show_optin = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val();
                        if(show_optin == 'Y'){
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls_poll_optin');
                        }

                        jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('hide_cls').removeClass('show_cls');
                        
                        $_self.setResultScreen(sqb_quiz_container_outer_id,response1.counts,response1.thankyou);
                        
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('show_cls').removeClass('hide_cls');
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote-count').html(count_vote);
                        jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_ans_item_outer").removeClass('sqb_ans_selected');
                        //jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').attr('disabled', true);
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('sqb-btn-disable');

                        jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('hide_cls').removeClass('show_cls');
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-return-poll').addClass('hide_cls').removeClass('show_cls');

                        if(jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_ans_item_outer input.sqb_and_field").length > 0){
                            jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_ans_item_outer input.sqb_and_field:checked").prop('checked', false); 
                        }

                        if(response1.allow_change_vote != 1){
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('hide_cls').removeClass('show_cls');
                        }
                            
                        if(jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').length > 0){
                            var show_optin = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val();
                            var allow_change_vote_class = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_change_vote').val();
                            /*if(show_optin == 'Y'){
                                jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('hide_cls').removeClass('show_cls');
                            }*/

                            jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
                        }
                    }else{

                        $optin_btn.html($optin_btn_html);
                        response = JSON.parse(response);
                        if(response.status == 'ok'){

                            quizResponse = response;

                            try {
                                lead_id = response.lead_save.data.lead_id;
                            } catch (error) {
                                
                            }

                            if (typeof scp_on_complete_quiz === "function") {
                                scp_on_complete_quiz(quiz_id, quiz_type, response.total_ques, response.correct_answers, response.total_pt, response.yourpoints);
                            }

                            if(jQuery('#quiz_submission_id_quiz_'+quiz_id).length){
                                jQuery('#quiz_submission_id_quiz_'+quiz_id).val(lead_id);
                            }

                            $this.find('#user_id').val(response.user_id);
                            var outcome_screen =  $this.find('#outcome_id_'+outcome_final).find("#outcome_screen").val();
                            var outcome_redirect =  $this.find('#outcome_id_'+outcome_final).find("#outcome_redirect").val();

                            if(outcome_screen == 'redirect' && show_analyzing_result != 'Y'){
                                $_self.redirectToUrl(outcome_redirect);
                                return false;
                            }

                            $_self.beforeRenderOutcome(response.data,data);
                            if(social_share_screen_value == 'Y' && $this.find('.sqb_social_share_next_btn').hasClass('disable_social_share_next_btn')){
                                $_self.showSocialShareScreen();
                            }else{
                                $_self.renderOutcome(response.data);
                                if($_self.isQuiz('poll') && is_outcome_redirect == 'Y'){
                                    $_self.pollChart(response.chart_data);
                                }
                            }
                        }else{
                            alert('Quiz submission error');
                        }
                    }
                }
            });
        }

        this.redirectToUrl = function(outcome_redirect){

            //var sqb_outcome_max_key = this.sqb_mode(outcome_ids_array);

            //console.log(outcome_ids_array);
            var sqb_rank_outcome_array_with_points = {};
            var sqb_outcome_index = '';
            for (sqb_outcome_index = 0; sqb_outcome_index < outcome_ids_array.length; sqb_outcome_index++) {
                var rank_outcome_id = outcome_ids_array[sqb_outcome_index];
                var outcome_points_default = 1;
                if(($this.find('input[name="weighted_score"]').length != 0) && ($this.find('input[name="weighted_score"]').val() == "Y") && outcome_ids_points_array.length != 0 ){
                    if(outcome_ids_points_array[rank_outcome_id]){
                        outcome_points_default = outcome_ids_points_array[rank_outcome_id];
                    }
                }
                    
                if(rank_outcome_id in sqb_rank_outcome_array_with_points){
                    sqb_rank_outcome_array_with_points[rank_outcome_id] = sqb_rank_outcome_array_with_points[rank_outcome_id] + outcome_points_default;
                }else{
                    sqb_rank_outcome_array_with_points[rank_outcome_id] = outcome_points_default;
                }
            }
            
            var sqb_rank_outcome_array_with_points_array = [];
            for (var sqb_rank_outcome_array_with_point in sqb_rank_outcome_array_with_points) {
                sqb_rank_outcome_array_with_points_array.push([sqb_rank_outcome_array_with_point, sqb_rank_outcome_array_with_points[sqb_rank_outcome_array_with_point]]);
            }

            sqb_rank_outcome_array_with_points_array.sort(function(a, b) {
                return b[1] - a[1];
            });
           
           console.log(sqb_rank_outcome_array_with_points_array);

            var sqb_redi_firstName = $this.find('.quiz_optin_template_outer #first_name').val();
            var sqb_redi_email = $this.find('#sqb_direct_signup #email').val();
            var sqb_quiz_id = $this.find('#quiz_id').val();
            var sqb_user_id = $this.find('#user_id').val();
            outcome_redirect = outcome_redirect.replace('%%USERID%%', sqb_user_id);
            outcome_redirect = outcome_redirect.replace('%%EMAILID%%', sqb_redi_email);
            outcome_redirect = outcome_redirect.replace('%%FIRSTNAME%%', encodeURIComponent(sqb_redi_firstName));
            //console.log(outcome_redirect);
            outcome_redirect = outcome_redirect.replace('%%QUIZID%%', sqb_quiz_id);
            

            if (sqb_rank_outcome_array_with_points_array.length > 0 && Object.keys(rank_outcome).length > 0) {
                let existingIds = new Set(sqb_rank_outcome_array_with_points_array.map(item => item[0]));
            
                // Iterate through the rank_outcome object
                for (let id in rank_outcome) {
                    if (!existingIds.has(id) && rank_outcome[id]) {
                        // Add it to the array if conditions are met
                        sqb_rank_outcome_array_with_points_array.push([id, 1]);
                    }
                }
            }
            
            jQuery.each(sqb_rank_outcome_array_with_points_array, function(index, value) {
                var rank = index + 1;
                outcome_redirect = outcome_redirect.replace('%%RANK' + rank + 'ID%%', value[0]);
            });
            //console.log(outcome_redirect);
            querString = window.location.href.split('?');
            if(querString[1] != undefined){
                querString[1] = querString[1].replace('SQBIframe=Y', '');
                querString[1] = querString[1].replace('SQBPreview=Y', '');
                if(outcome_redirect.indexOf('?') != -1){
                    outcome_redirect = outcome_redirect+'&'+querString[1];
                }else{
                    outcome_redirect = outcome_redirect+'?'+querString[1];
                }
            }
            
            var sqb = new RegExp("SQBIframe=Y");
            var sqbp = new RegExp("SQBPreview=Y");
            //var re = new RegExp("&quiz_id=\\d+");
            var pre = new RegExp("page_id=\\d+");

            var newurl = outcome_redirect.replace(sqb, '');
            newurl = newurl.replace(sqbp, '');
            newurl = newurl.replace(pre, '');
            //var newredirecturl = newurl.replace(re, '');
            //console.log(outcome_redirect);
            
            window.top.location.href  = newurl;
            return false;
        }

        this.setResultScreen = function(sqb_quiz_container_outer_id, rows, thankyou='') {

            jQuery('#'+sqb_quiz_container_outer_id+' .vote-data-element').remove();
            jQuery('#'+sqb_quiz_container_outer_id+' .quiz_type_poll .poll-quiz-main').addClass('quiz_poll_results');
                jQuery.each(rows, function (key, val) { 
        
                var inner_element = jQuery('#sqb_ans_id'+val.answer_given+'.sqb_ans_item_outer').find('.sqb_ans_item .sqb_ans_item_inner');
        
                if(val.ans_with_img == 'Y'){
                    inner_element.find('.sqb_ans_item_img').append(val.html_progress);
                    inner_element.find('.sqb_ans_item_img').append(val.html_per);
                    inner_element.find('.sql_ans_text').append(val.html_count);
                     //inner_element.append(val.html_count);
                }else{
                     inner_element.append(val.html);
                     //inner_element.append(val.html_per);
                }
                     
            });
        
            thankyou = decodeURIComponent(thankyou).replace(/\+/g, " ");
            if(thankyou != ''){
                jQuery('#'+sqb_quiz_container_outer_id+' .question_details').after(thankyou);
            }
        
            jQuery('#'+sqb_quiz_container_outer_id+ ' .voteRange-result-data').each(function(){
        
                jQuery(this).animate({
                     width: jQuery(this).data('per'),
                 },500);
        
            });
        }

        this.btnLoader = function($btn){
            $btn.html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');
        }
        this.showAnalyzeScreen = function(outcome_id){
            var timer = $this.find("#show_analyzing_time_delay").val();
            $analyzing_outer.addClass('show_cls').removeClass('hide_cls done_screen'); 
            var time_delay = $this.find('.time-delay-hidden').val();             
            $this.find('.analyzing_result_progress .progress').css('display','block');
            $this.find('.analyzing-progress-bar').css({
                'width':'0',
                'height' : '100%',
                '-webkit-animation' : 'progress_width '+time_delay+'s linear forwards',
                'animation' : 'progress_width '+time_delay+'s linear forwards',
            });
            setTimeout(function() {
                // Working
                var outcome_screen =  $this.find('#outcome_id_'+outcome_id).find("#outcome_screen").val();
                var outcome_redirect =  $this.find('#outcome_id_'+outcome_id).find("#outcome_redirect").val();

                if(outcome_screen == 'redirect'){
                    $_self.redirectToUrl(outcome_redirect);
                    return false;
                }

                $analyzing_outer.addClass('hide_cls done_screen').removeClass('show_cls');
                $_self.showOutcomeScreen(outcome_id);
            }, timer+'000');
        }

        this.showLessonOutcome = function(outcome_id){
            
            var lesson_id = $this.find('#lesson_id').val(); 

            if(lesson_id < 1){
                return false;
            }
            
            /*jQuery('.outcome_data_cont .outcome_div').each(function(){

            });*/

            $this.find('.pagination_all_div .multiple_ques_true' ).after($this.find('.outcome_data_cont').html());
            //$this.find('.quiz_quesans_template_outer').removeClass('hide_cls').addClass('show_cls');
            $this.find('.outcome_data_cont').show();

            var leads_total_attempts = $this.find('#leads_total_attempts').val();   
            var count_manage_lead_data = $this.find('#count_manage_lead_data').val();   
            
            var display_correctans_options = $this.find('#display_correctans_options').val();
            var sqb_retake = $this.find('#sqb_retake').val();
            var show_result_screen = $this.find('#show_result_screen').val();
            var sqb_quiz_type = $this.find('#sqb_quiz_type').val();
            var quiz_pagination = $this.find('#quiz_pagination').val();
            var quiz_attempts_allowed = $this.find('#quiz_attempts_allowed').val();
            
            $this.find('.answer_container').addClass("answer_container_disabled"); 

            if(quiz_pagination == 'question_on_category' || quiz_pagination == 'fixed_number'){
                $quesans_outer.find('.Quiz-Template').addClass('hide_cls').removeClass('show_cls');
                $quesans_outer.find('.sqb-page-numbers').hide();
                $quesans_outer.find('.sqb-question-on-cat').hide();
            }

            if(quiz_pagination =="all"){
                $this.find('.buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
            }else{
                $this.find('.quiz_quesans_template_outer  .Quiz-Template').last().removeClass('show_cls').addClass('hide_cls');
            }

            if( count_manage_lead_data > 0 && sqb_retake  == "n"  && quiz_attempts_allowed != "unlimited" ){    
                if(show_result_screen =="N"){
                }else{
                    var outcomedata = $this.find('.quiz_result_template_outer1 .outcome_div_lesson').html(); 
                    $this.find('.pagination_all_div .multiple_ques_true' ).after(outcomedata);
                }
            }else{
                if(show_result_screen == "Y"){
                    $this.find('.outcome_data_cont ').html('');
                    var outcomedata1 = $this.find('.quiz_result_template_outer').html(); 
                    $this.find('.outcome_data_cont').html(outcomedata1);
                }

                var total_attempts = $this.find('#total_attempts').val();
                var leads_total_attempts = $this.find('#leads_total_attempts').val();
                var allow_retake = $this.find('#allow_retake').val();

                var leadstotal_attempts_new = parseInt(leads_total_attempts) - 1;
                if(total_attempts == leadstotal_attempts_new){
                    $this.find('.retake_button').addClass('btn_disabled');
                }

                if( count_manage_lead_data == 0 ){
                    if(allow_retake == "Y"){
                        $this.find('.retake_button').removeClass('btn_disabled');
                    }
                }
                
                this.unlockMarkAsComplete();
            }

            if(quizResponse['lead_save'].display_msg == 'yes'){
                jQuery(".display_message-popup-outer").addClass("display_message-popup-active");
                jQuery(".dap-ponits-msg-container-xp-active").removeClass("hidden_sqb_quiz_credit_banner");
                var sqbpoint = parseInt(jQuery(".dap-ponits-msg-container-xp-active").data("sqbpoint"));
                var sqborgpoint = parseInt(jQuery(".dap-ponits-msg-container-xp-active .dap-xp-point-number span").text());
                var final_sqbpoint = sqbpoint + sqborgpoint;
                jQuery(".dap-ponits-msg-container-xp-active .dap-xp-point-number span").text(final_sqbpoint);
                jQuery(".dap-ponits-msg-container-xp-active .dap-xp-sticky").addClass("dap-xp-sticky-active");
                setTimeout(function() {
                    jQuery(".dap-ponits-msg-container-xp-active .dap-xp-sticky").removeClass("dap-xp-sticky-active");
                }, 5000);
            }

            if(count_manage_lead_data < 1){
                $this.find('#count_manage_lead_data').val(1);
                var allow_retake = $this.find('#allow_retake').val();
                var total_attempts = $this.find('#total_attempts').val();
                
                if(allow_retake =="Y"){
                    var retakehtml = $this.find('.quiz_quesans_template_outer .reake_data_outer ').html();      
                    $this.find('.outcome_div .result_temp_outer ').append('<div class="reake_data_outer retake_data_outer_reload" style="display:block">'+retakehtml+'</div>');
                }    
            }
        }

        this.resetLessonQuiz =  function(){

        }

        this.showOutcomeScreen = function(outcome_id){
            if(outcome_id > 0){
                $outcome_outer.find("#outcome_id_"+outcome_id).show();
            }else{
                $outcome_outer.find('.outcome_div').first().show();
            }
            $outcome_outer.addClass('show_cls').removeClass('hide_cls');
            this.saveReport('quiz_outcome_show',outcome_id);
            this.scrollToAnimate('outcome');
            this.processOutcomeAnimation(outcome_id);
            this.showLessonOutcome(outcome_id);

            $this.find('.video-js-outcome').each(function(i, obj) {
                var options = {};
                //console.log(jQuery(this).attr('id'));
                var player = videojs(jQuery(this).attr('id'), options, function onPlayerReady() {
                videojs.log('Your player is ready!');
                var t = jQuery(this).attr('id');
                $this.find('.vjs-big-play-button').attr('title','');
                this.on('pause', function(t) {
                    jQuery(t.target).find('.vjs-big-play-button').show();
                });

                this.on('playing', function(t) {
                    console.log('playing..');
                    if(jQuery(t.target).hasClass('play-slient')){
                        jQuery(t.target).find('.vjs-big-play-button').show();
                    }else{
                        jQuery(t.target).find('.vjs-big-play-button').hide();
                    }
                });
                
                this.on('ended', function() {
                    videojs.log('Awww...over so soon?!');
                });
                });

                if(click_to_unmute == 'Y'){
                    var myButton = player.addChild('button', {}, 0);
                    var myButtonDom = myButton.el();
                    jQuery(myButtonDom).addClass('btn-click-unmute');
                    myButtonDom.innerHTML = '<span class="vjs-icon-click-umute img10">'+video_umute_text+'</span>';
                }
            });
            $this.find('.vjs-big-play-button').attr('title','');
            this.playSilentVideoGlobal($this.find('#outcome_id_'+outcome_id));
        }

        this.beforeSubmitQuiz = function(outcome_id){
            if(correct_ans_opt == "result_page" || correct_ans_opt == "both"){
                this.printAnswerResults();
            }
            this.replaceMergeTags(outcome_id);
        }

        this.beforeRenderOutcome = function(data,obj){
            
            if(final_outcome < 1){
                final_outcome = this.getCurrentOutcome();
            }

            var outcome_id = final_outcome;

            $optin_outer.addClass('hide_cls').removeClass('show_cls');
            $quesans_outer.addClass('hide_cls').removeClass('show_cls');
            
            this.getShareDynamicParams(outcome_id);

            this.appendSocialSharonOC();

            // replace Chart data
            this.showOutcomeChart(outcome_id,data);

            this.showOutcomeTags(outcome_id,data);

            this.showCategoryBreakdown(outcome_id,data);

            this.showConditionalTags(outcome_id,data);

            this.printLeaderBoards(outcome_id,data);

            this.removeUnusedMergTag();
        }

        this.printLeaderBoards = function(outcome_id,data){
            jQuery.each(data.leaderboards, function(index, value){
                //console.log(index);
                if($outcome_outer.find('#sqb-outcome-leaderboard-'+index).length > 0){
                    $outcome_outer.find('#sqb-outcome-leaderboard-'+index).html(value);
                }
            });
        }

        this.convertHTMLtoCanvas = function(){
            setTimeout(() => {
                if(document.querySelector('#spiderChartOutcome2') !=null){
                    var container = document.querySelector('#spiderChartOutcome2');
                    html2canvas(container, { allowTaint: true }).then(function (canvas) {
                        //console.log('test');
                        canvas_pie_chart = canvas.toDataURL();
                    });
                }
                
                if(document.querySelector('#spiderChartOutcome1') !=null){
                    var container = document.querySelector('#spiderChartOutcome1');
                    html2canvas(container, { allowTaint: true }).then(function (canvas) {
                        //canvas_pie_chart = canvas.toDataURL();
                    });
                }
                
                if(document.querySelector('.spiderChartOutcome2') !=null){
                    var container = document.querySelector('.spiderChartOutcome2');
                    html2canvas(container, { allowTaint: true }).then(function (canvas) {
                        canvas_question_answer_chart = canvas.toDataURL();
                    });
                }

                if(document.querySelector('.sqb_spider_charts_heading') !=null){
                    var container = document.querySelector('.sqb_spider_charts_heading');
                    html2canvas(container, { allowTaint: true }).then(function (canvas) {
                        chart_heading = canvas.toDataURL();
                    });
                }

            }, 4000);
        }

        this.renderOutcome = function(data){

            var outcome_id = final_outcome; 
            $outcome_outer.find(".outcome_div").hide();

            if(show_analyzing_result == 'Y'){
                this.convertHTMLtoCanvas();
                this.showAnalyzeScreen(outcome_id);
            }else{
                this.showOutcomeScreen(outcome_id);
                this.convertHTMLtoCanvas();
            }

        }

        this.getOptinField = function(field_name){
            if($optin_outer.find('#'+field_name).val() != '' && $optin_outer.find('#'+field_name).val() != undefined){
                return $optin_outer.find('#'+field_name).val();
                //console.log($optin_outer.find('#'+field_name).val());
            }else if($optin_outer.find('input[name='+field_name+']').val() != ''){
                return $optin_outer.find('input[name='+field_name+']').val();
                console.log($optin_outer.find('input[name='+field_name+']').val());
            }
            return '';
        }

        this.validateEmail = function(email) {
            var emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return emailReg.test( email );
        }

        this.printCfieldsMessage = function($el, custom_message = ''){
            var message = $this.find('#sqb_required_field').val();
            if(message == ''){
                message = 'Required field cannot be empty.';
            }

            if(custom_message != ''){
                message = custom_message;
            }

            jQuery($el).find('.sqb_custom_field_required_class').show().text(message);
        }

        this.printOptinMessage = function(msg){
            $optin_outer.find('.form_cls').before('<div class="sqbwarning_div"><b>'+msg+'</b></div>'); 
        }

        this.questionsComplete = function($last_question, parent_ques_div='', notcount =''){
     
            var display_correctans_options = $this.find('#display_correctans_options').val();   
            var sqb_quiz_container_outer_id = $this.attr('id');
            this.gettimer_spent(sqb_quiz_container_outer_id, notcount);
            this.getspeedtimer_spent(sqb_quiz_container_outer_id, notcount);
            if(notcount == "notcount"){}else{
                this.progressBar($last_question);
            }
            final_outcome =  this.getCurrentOutcome();

            if(lesson_id > 0){
                this.processLessons();
            }
            //if(correct_ans_opt == "result_page" || correct_ans_opt == "both"){
                this.showQuesAnsResults($last_question);
            //}
            this.setLastScreen();
            this.saveReport('quiz_last_question_btn_click');
            //sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id,sqb_quiz_id,'personality',sqb_outcome_max_key);    
        }

        this.gettimer_spent = function(notcount=''){

            var timer_count = $this.find('#timer_count').val();
            $this.find('#timer_stop').val(1);
            var timer_spent = $this.find('#timer_spent').val();
            $this.find('#time_spent1').val(timer_spent);
            var sqb_seconds_text = $this.find('#timer_text_sec_html').text();
            var $time_spent_msg = $this.find('.quiz_timer_spent_msg');
            if($time_spent_msg.length){
                var timer_spent_text = sqbSecondsToDhms(timer_spent);
                $time_spent_msg.html($time_spent_msg.html().replace('%%TIMESPENT%%', '<b> '+timer_spent_text+'</b>'));
                $time_spent_msg.html($time_spent_msg.html().replace('%%TIMELEFT%%', '<b> '+timer_spent_text+'</b>'));
            }
            
            if(notcount != "notcount"){
                $optin_outer.find('.sqb_counter_expired_msg').hide();
                $outcome_outer.find('.sqb_counter_expired_msg').hide();
                $optin_outer.find('.quiz_timer_html_data').hide();

                if(lesson_id > 0){
                     $quesans_outer.find('.quiz_timer_spent_msg').show();
                }else{
                    if(show_optin =="Y"){
                        $optin_outer.find('.quiz_timer_spent_msg').show();
                    }else{
                        $outcome_outer.find('.quiz_timer_spent_msg').show();
                    }
                }
            }else{
                if(lesson_id > 0){
                    $quesans_outer.find('.sqb_counter_expired_msg').show();
                    $quesans_outer.find('.quiz_timer_spent_msg ').show();        
                }else{
                    if(show_optin =="Y"){   
                        $optin_outer.find('.sqb_counter_expired_msg').show();               
                        $optin_outer.find('.quiz_timer_spent_msg').show();
                    }else{
                        $outcome_outer.find('.sqb_counter_expired_msg').show();
                        $outcome_outer.find('.quiz_timer_spent_msg ').show();
                    }        
                }
            }
        }

        this.getspeedtimer_spent = function(notcount=''){

            var speed_timer_count = $this.find('#speed_timer_count').val();
            $this.find('#speed_timer_stop').val(1);
            var speed_timer_spent = $this.find('#speed_timer_spent').val();

            $this.find('#speed_timer_count').val(speed_timer_spent);
            $this.find('#speed_time_spent1').val(speed_timer_spent);
            var sqb_seconds_text = $this.find('#speed_timer_text_sec_html').text();
            var $time_spent_msg = $this.find('.quiz_speed_timer_spent_msg');
            if($time_spent_msg.length){
                var timer_spent_text = sqbSpeedSecondsToDhms(speed_timer_spent, $this);
                //$time_spent_msg.html($time_spent_msg.html().replace('[SQBTimeSpent]', '<b> '+timer_spent_text+'</b>'));
                this.addMergTag('[SQBTimeSpent]','<b> '+timer_spent_text+'</b>');
                
                setTimeout(function(){
                    jQuery('.quiz_speed_timer_spent_msg .timer-container').show();
                }, 100);
            }
            
            if(notcount != "notcount"){
                $optin_outer.find('.timer-container').hide();
                if(lesson_id > 0){
                     $quesans_outer.find('.quiz_speed_timer_spent_msg').show();
                }else{
                    if(show_optin =="Y"){
                        $optin_outer.find('.quiz_speed_timer_spent_msg').show();
                    }else{
                        $outcome_outer.find('.quiz_speed_timer_spent_msg').show();
                    }
                }
            }else{
                if(lesson_id > 0){
                    $quesans_outer.find('.quiz_speed_timer_spent_msg ').show();        
                }else{
                    if(show_optin =="Y"){            
                        $optin_outer.find('.quiz_speed_timer_spent_msg').show();
                    }else{
                        $outcome_outer.find('.quiz_speed_timer_spent_msg ').show();
                    }        
                }
            }
        }

        this.processLessons = function($question){

        }

        this.processQuestion = function($question,$force_screen = '',skip_click = false){

            $this.find('.custom-other-box').hide();
            var parent_ques_div =  $question.attr('id');
            var $answer_item =  $question.find('.sqb_ans_item_outer');
            var display_quesid = $this.find('.question_container.show_cls').attr('id');
            $question.find('.sqb_uploded_filename').remove();
            $question.find('.sqb_ans_item_outer .file-upload-error-message').hide();
            
            //if multiple correct ans
            var parent_hasClass = false;
            var matrix_cls = $question.find(".sqb_ans_item_outer").hasClass('matrix_cls');
            var has_multiple_correct_cls =  $question.hasClass('multiple_correct_cls');
            var has_ranking_cls =  $question.hasClass('question_type_ranking_choices');

            if(matrix_cls || has_multiple_correct_cls || has_ranking_cls){
                parent_hasClass = true;
            }
            
            var allow_skip_ques =  $question.find(".allow_skip_ques").val();
            $this.find(".correctincorrect_ans_div").remove();
            var count_manage_lead_data = $this.find('#count_manage_lead_data').val();   

            var lesson_quiz = "";
            if( lesson_id > 0 ){
                lesson_quiz ="all";
            }

            var is_valid = this.validateQuestion($question,skip_click);

            if(!is_valid) return false;

            if(!skip_click){
                if(this.isQuiz('scoring') || this.isQuiz('assessment')){
                    var isFirst = $question.find('.sqb_quiz_next_button_click').val();
                    if(!this.showCorrectAnswer($question)){
                        if(isFirst == 0){
                            return false;
                        }
                    }
                }
            }else{
                skipped_question.push($question.attr('data-question-id'));
            }
           
            $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'none');
            $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'none');

            // Scoring Calculation
            if(this.isQuiz('scoring') || this.isQuiz('calculator')){
            
                if($question.hasClass('question_type_file_upload')){
                    var filename = $this.find('.Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
                    var sqb_ans_selected = 0;
                    if(filename != ''){
                        var sqb_ans_selected = 1;
                    }
                } else {
                    var sqb_ans_selected = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;
                }

                var ponts_ans = this.calculatePoints($question);        
            }else{
                this.calculateWeighedOutcome($question);
            }

            var current_ques_div_hgt = $question.height(); 
            if($question.hasClass('question_type_matrix')){
                var ans_select_obj =  $question.find('.sqb_ans_item_outer.sqb_ans_selected');
            }else{
                var ans_select_obj =  $question.find('.sqb_ans_selected');          
            }

            var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
            var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
            var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

            // Set Rule for Multiple choice Questions, always get first outcome rule
            if($question.hasClass('question_type_multi')){
                $question.find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
                    if(jQuery(this).attr('data-outcomerule-id') > 0){
                        sqb_answer_id = jQuery(this).attr('data-answer-id');
                        sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
                        return false;
                    }
                });
            }


             // enter data in question and answer table
             var sqb_answer_id1 = jQuery(ans_select_obj).attr('data-answer-id');
             var sqb_question_id1 = jQuery(ans_select_obj).attr('data-question-id');
             var sqb_is_new_flow = jQuery(ans_select_obj).attr('data-isnewflow');
             var sqb_other_field = $question.find('.custom-other-box').val();
             if (typeof sqb_question_id1 === "undefined" || (sqb_question_id1 == 0)){
                sqb_question_id1 = $question.find('.single_cls').attr('data-question-id');
                sqb_answer_id1 = 0;
                //sqb_outcome_id = 0;
                if(parent_hasClass == true){
                    sqb_answer_id1 = $question.find('.sqb_ans_item_outer.sqb_ans_selected').attr('data-question-id');
                }
                if(matrix_cls == true){
                    sqb_question_id1 = $question.find('.sqb_ans_item_outer.matrix_cls').attr('data-question-id');
                }
             }
             
             var advruleanswers = sqb_answer_id;
             if(parent_hasClass == true){
                 var sqb_answer_id1  = this.getMultipleAnswerIds(parent_ques_div);  
                 advruleanswers = sqb_answer_id1.split(',');             
             }

             var only_question = '';
 
             this.setAnswerData(sqb_question_id1,sqb_answer_id1);
             this.saveQuesAnsReport(sqb_question_id1,sqb_answer_id1,0,sqb_other_field);

            var cr_ans_id = $question.find('.sqb_ans_selected').find('.sqb_ans_item').attr('id');
            var $ans_rec_outer = $question.closest('.Quiz-Template').find('.quiz_ans_recommendation_html');
            var sqb_recommendation_enabled = $ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).attr('sqb_recommendation_enabled');

            if((sqb_is_new_flow == 0) && this.is_advanced_rule(sqb_question_id, sqb_answer_id,sqb_outcome_id)){
                this.processAdvancedRule(sqb_question_id, sqb_answer_id,sqb_outcome_id);
                this.questionsComplete($question);
                this.progressBar($question);
            }else if((sqb_is_new_flow == 1) && this.isComplexRules(sqb_question_id, advruleanswers,sqb_outcome_id)){
                //this.processAdvancedRule(sqb_question_id, sqb_answer_id,sqb_outcome_id);
                this.questionsComplete($question);
                this.progressBar($question);
            }else if(quiz_pagination == 'all'){
                this.processOnePageQuestion($question,skip_click);
            }else if(quiz_pagination == 'fixed_number' || quiz_pagination == 'question_on_category'){
                this.processMultiPageQuestion($question,skip_click);
            }else if($question.closest('.Quiz-Template').find('.quiz_ans_a_d_html_outer').length > 0 && $force_screen == '' && quiz_pagination != 'all'){
                this.processAds($question);
            }else if(sqb_recommendation_enabled == 'Y' && $force_screen == '' && recommendation_option == 'Y' && quiz_pagination != 'all' && $ans_rec_outer.find('.sqb_ans_option_'+cr_ans_id).attr('sqb_recommendation_enabled')){
                this.processRecommendation($question);
            }else if(enable_branching_quiz){
                this.processFunnel($question);
            /*}else if(lesson_quiz =="all"){
                this.processLessonQuestion();*/
            }else{
                //check if last child
                var display_quesid_lastchild =  $this.find('.question_container').last().attr('id');
                if(display_quesid_lastchild == parent_ques_div){
                    this.questionsComplete($question);
                }else{

                    this.moveToNextQuestion($question);
                    this.showBackButton($question);
                    //if(correct_ans_opt == "result_page" || correct_ans_opt == "both"){
                        this.showQuesAnsResults($question);
                    //}
                    this.scrollToAnimate('ques_ans');
                    // progressbar
                    this.progressBar($question);
                }
            }
            
           

            this.apply_wid_css();

            setTimeout(function(){
                $this.find('.show_cls').find('.numeric_text_cls').addClass('sqb_ans_selected');
                if(slider_animation == 'N'){
                    $this.find('.numerical_text_cls.show_cls .numeric-value-prefix input').focus();
                }
            },500);

        }

        this.validatePaginationQuestion = function(page){
            var is_valid = true;
            
            $quesans_outer.find('.Quiz-Template.page-'+page).each(function(){
                var $question = jQuery(this).find('.question_container');
                $question.find('.correctincorrect_ans_div').remove();
                var parent_ques_div =  $question.attr('id');

                var allow_skip_ques =   $question.find(".allow_skip_ques").val();
                if(allow_skip_ques =="Y"){
                    var is_valid_ = true;
                }else{
                    var is_valid_ = $_self.validateQuestion($question);
                }

                if(!is_valid_){
                   
                    is_valid = false;
                    var target = $question;
                    jQuery('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }

            });

            return is_valid;

        }

        this.processFlatQuiz = function(optin_skip = false){
            
            var $question;
            var is_valid = true;
            cat_ids = {};
            eachcat_ids = {};
            $this.find('.sqb_question_answer_hidden').remove();
            $this.find('#ques_count').val('-1');
            $this.find('.question_container').each(function(){

                $question = jQuery(this);
                var parent_ques_div =  $question.attr('id');

                var parent_hasClass = false;
                var matrix_cls = $question.find(".sqb_ans_item_outer").hasClass('matrix_cls');
                var has_multiple_correct_cls =  $question.hasClass('multiple_correct_cls');
                var has_ranking_cls =  $question.hasClass('question_type_ranking_choices');

                if(matrix_cls || has_multiple_correct_cls || has_ranking_cls){
                    parent_hasClass = true;
                }

                $question.find('.correctincorrect_ans_div').remove();
                
                var allow_skip_ques =   $question.find(".allow_skip_ques").val();
                if(allow_skip_ques =="Y"){
                    var is_valid_ = true;
                }else{
                    var is_valid_ = $_self.validateQuestion($question);
                }


                if(!is_valid_){
                   
                    is_valid = false;
                    var target = $question;
                    jQuery('html, body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }

                // Scoring Calculation
                if($_self.isQuiz('scoring') || $_self.isQuiz('calculator')){
                
                    if($question.hasClass('question_type_file_upload')){
                        var filename = $this.find('.Quiz-Template.show_cls').find('.file_upload_cls').find('input[name="sqb_file_upload"]').val();
                        var sqb_ans_selected = 0;
                        if(filename != ''){
                            var sqb_ans_selected = 1;
                        }
                    } else {
                        var sqb_ans_selected = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;
                    }

                    var ponts_ans = $_self.calculatePoints($question);        
                }else if($_self.isQuiz('assessment')){
                    ques_count =  $this.find('#ques_count').val();
                    ques_count = parseInt(ques_count) + 1;
                    $this.find('#ques_count').val(ques_count);
                    $_self.showCorrectAnswer($question);
                }
                
                
                var current_ques_div_hgt = $question.height(); 
                if($question.hasClass('question_type_matrix')){
                    var ans_select_obj =  $question.find('.sqb_ans_item_outer.sqb_ans_selected');
                }else{
                    var ans_select_obj =  $question.find('.sqb_ans_selected');          
                }

                var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
                var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
                var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');

                // Set Rule for Multiple choice Questions, always get first outcome rule
                if($question.hasClass('question_type_multi')){
                    $question.find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
                        if(jQuery(this).attr('data-outcomerule-id') > 0){
                            sqb_answer_id = jQuery(this).attr('data-answer-id');
                            sqb_outcome_id = jQuery(this).attr('data-outcomerule-id');
                            return false;
                        }
                    });
                }
            
            // enter data in question and answer table
                var sqb_answer_id1 = jQuery(ans_select_obj).attr('data-answer-id');
                var sqb_question_id1 = jQuery(ans_select_obj).attr('data-question-id');
                var sqb_is_new_flow = jQuery(ans_select_obj).attr('data-isnewflow');
                var sqb_other_field = $question.find('.custom-other-box').val();
                if (typeof sqb_question_id1 === "undefined" || (sqb_question_id1 == 0)){
                sqb_question_id1 = $question.find('.single_cls').attr('data-question-id');
                sqb_answer_id1 = 0;
                //sqb_outcome_id = 0;
                if(parent_hasClass == true){
                    sqb_answer_id1 = $question.find('.sqb_ans_item_outer.sqb_ans_selected').attr('data-question-id');
                }
                if(matrix_cls == true){
                    sqb_question_id1 = $question.find('.sqb_ans_item_outer.matrix_cls').attr('data-question-id');
                }
                }
                
                var advruleanswers = sqb_answer_id;
                if(parent_hasClass == true){
                    var sqb_answer_id1  = $_self.getMultipleAnswerIds(parent_ques_div);  
                    advruleanswers = sqb_answer_id1.split(',');             
                }

                var only_question = '';

               
                $_self.setAnswerData(sqb_question_id1,sqb_answer_id1);
                $_self.showQuesAnsResults($question);
                
            });

            if(!is_valid){
                return false;
            }

            final_outcome =  this.getCurrentOutcome();

            /*if(lesson_id > 0){
                this.processLessons();
            }*/
            
            
            if(optin_skip == false){
                this.submitQuiz();
            }
            /*var continue_btn_text = $optin_btn.html();
            var resultdata = this.saveQuizData("", "" ,"", continue_btn_text);*/
        }

        this.isQuestionType = function($type,$question){
            return $question.find('.sqb_ans_item_outer').hasClass($type);
        }

        this.getCategoryOutcome = function(){

        
            var outcomerule_id = $this.find("#outcome_advanced_rule_id").val();
            var final_cate_val = $this.find("#final_cate_val").val();
            var founddata = false;
            var final_outcome_id = 0;
                                     
            if(outcomerule_id >0){
                return outcomerule_id;
            }
            
            /*if(final_cate_val >0){
                return;
            }*/

            jQuery.each(cat_ids, function(index, cat_get_value){

                $this.find('.cat_advanced_rules').each(function(){
                    var datatitle = jQuery(this).attr('data-title');
                    var categoryid = jQuery(this).attr('data-categoryid');
                                
                    if(datatitle =="number"){
                        var datanum = jQuery(this).attr('data-range');
                        if(datanum >= 0){
                            if(categoryid == index){
                                if(cat_get_value == datanum){
                                founddata = true; 
                                $this.find("#final_cate_val").val(1);   
                                var outcome_id = jQuery(this).val();
                                $this.find('#outcome_final').val(outcome_id);
                                final_outcome_id = outcome_id;
                                return false;
                                }
                            }
                        }
                    }else if(  datatitle =="category_highest" ){
                        
                        if(categoryid == $_self.getMaxCategory()){
                            founddata = true;
                            $this.find("#final_cate_val").val(1);
                            var outcome_id = jQuery(this).val();
                            $this.find('#outcome_final').val(outcome_id);
                            final_outcome_id = outcome_id;
                            return false;
                        }
                    }else if(  datatitle =="category_lowest" ){
                        
                        if(categoryid == $_self.getMinCategory()){
                            founddata = true;
                            $this.find("#final_cate_val").val(1);
                            var outcome_id = jQuery(this).val();
                            $this.find('#outcome_final').val(outcome_id);
                            final_outcome_id = outcome_id;
                            return false;
                        }
                    }else if(datatitle =="range" || datatitle =="category_total" ){
                        var datastart = jQuery(this).attr('data-start');
                        var dataend = jQuery(this).attr('data-end');
                        
                        if(categoryid == index){
                            if(cat_get_value >= datastart  ){
                                if(  cat_get_value <= dataend){
                                    founddata = true;
                                    $this.find("#final_cate_val").val(1);
                                    var outcome_id = jQuery(this).val();
                                    $this.find('#outcome_final').val(outcome_id);
                                    final_outcome_id = outcome_id;
                                    return false;
                                }
                            }
                        }
                    }
                });
            });

            return final_outcome_id;
            
        }

        this.categoryRankShortcode = function(){
            
            var cat_list = $this.find('input[name="category_list_json"]').val();
            if(cat_list != ''){
                cat_list = JSON.parse(cat_list);
            }
            var tempp = cat_ids;
          
            var newcatarraylow = {};

            jQuery.each(cat_ids, function(index, value) {
                //console.log(index);
                //console.log(value);
                var ccatid = index;
                var total = eachcat_ids[ccatid];
                var perce = parseInt(value)/total * 100;
                var catname = cat_list[ccatid];
            
                newcatarraylow[ccatid] = perce.toFixed(2);
            
            });

            let catArray = Object.entries(newcatarraylow).map(([key, value]) => ({ key, value }));

            catArray.sort((a, b) => a.value - b.value);


            let catArray1 = Object.entries(newcatarraylow).map(([key, value]) => ({ key, value }));

            catArray1.sort((a, b) => b.value - a.value);

            var i = 1;

            for (let item of catArray) {
                var ccatid = item.key;
                var total = eachcat_ids[ccatid];
                var perce = parseInt(item.value)/total * 100;
                var catname = cat_list[ccatid];
                this.addMergTag('%%low_rank'+i+'%%',catname);
                this.addMergTag('%%low_rank'+i+'_score%%',item.value+'%');
                //newcatarraylow[ccatid] = perce.toFixed(2);
                i++;
            }

            var i = 1;
            for (let item of catArray1) {
                var ccatid = item.key;
                var total = eachcat_ids[ccatid];
                var catname = cat_list[ccatid];
                var perce = parseInt(item.value)/total * 100;
                this.addMergTag('%%high_rank'+i+'%%',catname);
                this.addMergTag('%%high_rank'+i+'_score%%',item.value+'%');
                //newcatarrayhigh[ccatid] = perce.toFixed(2);
                i++;
            }

        }

        this.getMaxCategory = function(){
            var cat_points = Array();
            i = 0;
            jQuery.each(cat_ids, function(index, value){
                cat_points[i] = value;
                i++;
            });

            var max = Math.max.apply(Math,cat_points);
            var cat_id = 0;
            jQuery.each(cat_ids, function(index, value){
                if(value == max){
                    cat_id = index;
                }
            });
            return cat_id;
        }
        
        this.getMinCategory = function(){
            var cat_points = Array();
            i = 0;
            jQuery.each(cat_ids, function(index, value){
                cat_points[i] = value;
                i++;
            });

            var min = Math.min.apply(Math,cat_points);
            var cat_id = 0;
            jQuery.each(cat_ids, function(index, value){
                if(value == min){
                    cat_id = index;
                }
            });
            return cat_id;
        }


        this.calculatePoints = function($question,$isBack = false){
            
            var data_point = 0;
            var sqb_points_ans = $this.find("#sqb_points_ans").val();
            var points_count = $this.find("#points_count").val();
            
            if(sqb_points_ans == 'NaN' || sqb_points_ans == undefined){
                sqb_points_ans = 0;
            }

            if(points_count == 'NaN' || points_count == undefined){
                points_count = 0;
            }

            if(this.isQuestionType('matrix_cls',$question)){

                var data_point = 0;
                var points_count = 0;
                var points_count = $this.find("#points_count").val();
                sqb_points_ans = $this.find("#sqb_points_ans").val();
                var get_max_points_count = 0;

                $question.find("tr.matrix_cls").each(function(){
                    var heightnum = [];
                    jQuery(this).find(".checkbox_fe").each(function(){                                               
                        var multi_ans_points = jQuery(this).attr('data-assigned-value');
                        heightnum.push(multi_ans_points);
                    });
                    multi_ans_points = Math.max.apply(Math, heightnum);                                          
                    get_max_points_count = parseInt(get_max_points_count) + parseInt(multi_ans_points);
                });

                $question.find(".matrix_cls .checkbox_fe:checked").each(function(){
                    var multi_ans_given_points = jQuery(this).attr('data-assigned-value');      
                    data_point = parseInt(data_point) + parseInt(multi_ans_given_points);
                });

                /*if(this.isQuiz('scoring')){
                    data_point = 0;
                    get_max_points_count = 0;
                }*/

            }else if(this.isQuestionType('slider_cls',$question)){

                var data_point = $question.find('.sqb_ans_item_outer').find('.sqb_ans_slider').attr("data-value");
                var data_points_array = [];        
                $question.find('.sqb_ans_item_outer').each(function(){
                    var data_points = jQuery(this).find('.sqb_ans_slider').attr("data-slider-max");
                    data_points_array.push(data_points);     
                });      
                var get_max_points_count = Math.max.apply(Math,data_points_array);

                /*if(this.isQuiz('scoring')){
                    data_point = 0;
                    get_max_points_count = 0;
                }*/

            } else if(this.isQuestionType('numeric_text_cls',$question)){
                
                var data_point = 0;
                var data_correct_value = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
                var input_text_num = $question.find(".sqb_ans_item_outer .sqb_and_field").val();
                if(input_text_num == data_correct_value){
                    var data_point = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-point");
                }

                if(this.isQuiz('calculator')){
                    if(input_text_num != '' && input_text_num != 0){
                        var data_point = input_text_num;
                    }else{
                        var data_point = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-point");
                    }
                }


                var get_max_points_count = this.getmaxDataPoints($question);
            } else if(this.isQuestionType('matching_text',$question)){
                if(this.isQuiz('scoring')){
                    var data_point = this.matchPoints($question);
                    var get_max_points_count = this.getMatchingmaxPoints($question);
                }
            } else if(this.isQuestionType('weight_and_height_cls',$question)){
                if(this.isQuiz('calculator')){
                    var data_point = this.getHeightWeightValues($question);
                }
                var get_max_points_count = 0;
            
            } else if(this.isQuestionType('multiple_cls',$question)){
                if( $question.find('.sqb_ans_selected').length >0){
                    var sqb_loop_v_i = 1;
                    //var  sqb_points_ans = 0;
                    var dp = 0;
                    $question.find(".sqb_ans_item_outer .checkbox_fe:checked ").each(function(){     
                        var data_point = jQuery(this).closest('.sqb_ans_item_outer').attr('data-point');
                        if(typeof data_point != 'undefined' && data_point != '' ){                       
                        }else{
                            data_point =0;
                        }
                        dp = parseFloat(dp) + parseFloat(data_point);
                        //sqb_points_ans = parseFloat(data_point)+ parseFloat(sqb_points_ans);
                        sqb_loop_v_i++;
                    });

                    data_point = dp;

                    var mdp = 0;
                    $question.find(".sqb_ans_item_outer .checkbox_fe ").each(function(){
                        var mpoint = jQuery(this).closest('.sqb_ans_item_outer').attr('data-point');
                        if(typeof mpoint != 'undefined' && mpoint != '' ){
                        }else{
                            mpoint =0;
                        }

                        if (mpoint < 0) {
                            mpoint = 0;
                        }

                        mdp = parseFloat(mdp) + parseFloat(mpoint);     
                    });
                    
                    var get_max_points_count = mdp;
                    //quesformula_value[i] = sqb_points_ans;                                                 
                }
            }else{

                var data_point = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-point");
                var get_max_points_count = this.getmaxDataPoints($question);
            }

            // Categort Calculation
            if(this.isCategory()){
                var cat_id =  $question.closest('.Quiz-Template').attr('data-category-id');
                if(typeof cat_ids[cat_id] === 'undefined'){
                    cat_ids[cat_id] = 0;
                }

                if($isBack){
                    cat_val = parseFloat(cat_ids[cat_id]) - parseFloat(data_point);
                    cat_ids[cat_id] = cat_val;
                }else{
                    cat_val = parseFloat(cat_ids[cat_id])+parseFloat(data_point);
                    cat_ids[cat_id] = cat_val;
                }
                
                if(typeof eachcat_ids[cat_id] === 'undefined'){
                    eachcat_ids[cat_id] = 0;
                }

                if($isBack){
                    max_cat_val = parseFloat(eachcat_ids[cat_id]) - parseFloat(get_max_points_count);
                    eachcat_ids[cat_id] = max_cat_val;
                }else{
                    max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(get_max_points_count);
                    eachcat_ids[cat_id] = max_cat_val;
                }
                

            }
            if(this.isQuiz('calculator')){
                if (typeof data_point !== "object") {
                    if(data_point == 'NaN' || data_point == undefined || isNaN(data_point)){
                        data_point = 0;
                    }
                }
            }else{
                if(data_point == 'NaN' || data_point == undefined || isNaN(data_point)){
                    data_point = 0;
                }
            }

            if(get_max_points_count == 'NaN' || get_max_points_count == undefined || isNaN(get_max_points_count)){
                get_max_points_count = 0;
            }

            if(this.isQuiz('calculator')){

                var ques_id = '"'+$question.attr('data-question-id')+'"';;
                if(typeof questions_points[ques_id] === 'undefined'){
                    questions_points[ques_id] = 0;
                }
                if($isBack){
                    questions_points[ques_id] = questions_points[ques_id] - data_point;
                }else{
                    questions_points[ques_id] = data_point;
                }
            }

            

            if($isBack){
                sqb_points_ans = parseInt(sqb_points_ans) - parseInt(data_point);
                $this.find('#sqb_points_ans').val(sqb_points_ans);
                points_count = parseInt(points_count) - parseInt(get_max_points_count);
                $this.find('#points_count').val(points_count);
            }else{
                sqb_points_ans = parseInt(data_point)+ parseInt(sqb_points_ans);
                $this.find('#sqb_points_ans').val(sqb_points_ans);
                points_count = parseInt(get_max_points_count)+ parseInt(points_count);
                $this.find('#points_count').val(points_count);
            }

            return sqb_points_ans;
        }

        this.isQuiz = function(value){
            return quiz_type == value;
        }

        this.processBackQuestion = function($question){
            jQuery('.custom-other-box').hide();
            var sqb_quiz_container_outer_id = $this.attr('id');
            
            var parent_ques_div =  $question.attr('id');
            var display_quesid = $this.find('.question_container.show_cls').attr('id');
            var current_ques_div_hgt = $this.find('#'+parent_ques_div).height(); 
            
            if($question.hasClass('question_type_matrix')){
                var ans_select_obj =  $this.find('#'+parent_ques_div).find('.sqb_ans_item_outer.sqb_ans_selected');
            }else{
                var ans_select_obj =  $this.find('#'+parent_ques_div).find('.sqb_ans_selected');            
            }
            var sqb_question_id = jQuery(ans_select_obj).attr('data-question-id');
            var sqb_answer_id = jQuery(ans_select_obj).attr('data-answer-id');
            var sqb_outcome_id = jQuery(ans_select_obj).attr('data-outcome-ids');
            var quiz_temp_id = $question.closest('.Quiz-Template').attr('id'); 

            if(enable_branching_quiz){
                var prevdiv_id = this.getFunnelPreviousQuestion(parent_ques_div, sqb_quiz_container_outer_id);
                //prevdiv_id = Object.values(prevdiv_id);
                prevdiv_id = "quiz_temp_id"+prevdiv_id;
            }else{
                var prevdiv_id = $this.find('#'+quiz_temp_id).prev().attr('id');
            }

            var timerValue = 0;
            $b_question = $this.find("#"+prevdiv_id).find('.question_container');
            if(slider_animation == 'Y') timerValue = 500;
            setTimeout(function() {
                $this.find('.quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls').removeClass('show_cls');
                $this.find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');
                if(slider_animation =="Y"){
                    $this.find("#"+prevdiv_id).removeClass('done_question');
                }
                $this.find('.quiz_quesans_template_outer' ).find("#"+prevdiv_id).addClass('show_cls').removeClass('hide_cls');
               
                if($_self.isQuiz('scoring')){}
                var ponts_ans = $_self.calculatePoints($b_question,true);

                if($_self.isQuiz('assessment') || $_self.isQuiz('scoring')){
                    var bq_id = $b_question.attr('data-question-id');
                    if($corr_qa[bq_id] == 1){
                        var correct_ans_count = parseInt($this.find('#sqb_correct_ans').val()) - 1;
                        $this.find('#sqb_correct_ans').val(correct_ans_count);
                        $b_question.find('.sqb_quiz_next_button_click').val(0);
                    }
                }

                var ques_count = parseInt($this.find('#ques_count').val()) - 1;
                $this.find('#ques_count').val(ques_count);
                $_self.progressBar($b_question,true);
                
            }, timerValue);

            $this.find('.quiz_quesans_template_outer #'+quiz_temp_id ).prev().find('.answer_container').addClass('back-btn-enabled');
            if(show_back_button_change == 'notallow'){
                $b_question.find('.answer_container').addClass('disable_answer');
                $b_question.find('.sqb_next_btn').show();
                var question_id = $b_question.attr('data-question-id');
                $this.find('.sqb_question_answer_hidden[data-id="'+question_id+'"]').remove();
            }else{
                var question_id = $b_question.attr('data-question-id');
                $this.find('.sqb_question_answer_hidden[data-id="'+question_id+'"]').remove();
            }

            if(slider_animation != "Y"){
                this.apply_wid_css();
                if(quiz_temp_id != undefined){
                    this.scrollToAnimate('ques_ans');
                }
            }
        }

        this.getFunnelPreviousQuestion = function(parent_ques_div, sqb_quiz_container_outer_id){

            var data_answer_id =   $this.find('#'+parent_ques_div).find('.sqb_ans_selected').attr('data-answer-id');
            var data_question_id = $this.find('#'+parent_ques_div).attr('data-question-id');
            var current_ques_div_hgt = $this.find('#quiz_temp_id'+data_question_id).height();
                
            if($this.find('#'+parent_ques_div).hasClass('multiple_correct_cls')){
                var data_answer_id =   $this.find('#'+parent_ques_div).find('.sqb_ans_selected.multiple_cls').attr('data-answer-id');
                var data_question_id = $this.find('#'+parent_ques_div).attr('data-question-id');
            }   
    
            var sqb_funnel_back_ques_ans_connection_json = $this.find('.sqb_funnel_back_ques_ans_connection_json').val();
            var sqb_funnel_back_ques_ans_connection_json = jQuery.parseJSON(sqb_funnel_back_ques_ans_connection_json);
            var sqb_funnel_json = sqb_funnel_back_ques_ans_connection_json;
            var prev_question_id = sqb_funnel_json[data_question_id]['back_question'];
            return prev_question_id;
        }

        this.showBackButton = function($question){
            var quiz_temp_id = $question.closest('.Quiz-Template').attr('id');
            $quesans_outer.find('#'+quiz_temp_id ).prev().find('.answer_container').addClass('back-btn-enabled');   
            if(show_back_button_change == 'notallow'){
                $quesans_outer.find('#'+quiz_temp_id ).prev().find('.answer_container').addClass('disable_answer');
            }else{
                /*$quesans_outer.find('#'+quiz_temp_id ).prev().find('.sqb_ans_item_outer.sqb_ans_selected').each(function(){
                    var question_id = jQuery(this).attr('data-question-id');
                    $this.find('.sqb_question_answer_hidden[data-id="'+question_id+'"]').remove();
                    $this.find('.sqb_question_answer_hidden_report[data-id="'+question_id+'"]').remove();
                });*/
            }
        }

        this.isCategory = function(){
            return ($this.find('input[name="sqb_quiz_category_enable"]').val() == 'Y');
        }

        this.getmaxDataPoints = function($question) {
            var data_points_array = [];
             $question.find('.sqb_ans_item_outer').each(function(){
                var data_points = jQuery(this).attr("data-point");
                data_points_array.push(data_points);
            });
            var max_points = Math.max.apply(Math,data_points_array); 
            return max_points;  
        }

        this.getMultipleAnswerIds = function(parent_ques_div) {
            var ansid_array = [];
            jQuery.each( $this.find("#"+parent_ques_div+" .sqb_ans_item_outer input.sqb_and_field:checked"), function(){
                if (jQuery(this).attr("data-id") === undefined || jQuery(this).attr("data-id") === null) {
                } else {
                    if(jQuery(this).hasClass('matrix_answer_value')){
                    ansid_array.push(jQuery(this).attr("data-id")+'|'+jQuery(this).val());  
                    } else {
                    ansid_array.push(jQuery(this).attr("data-id"));
                    }
                }
            });
            var sqb_answer_id  =  ansid_array.join(",");
            return sqb_answer_id;   
        }

        this.calculate_average = function(total,count){
            try{
                var final = total / count;
                return final.toFixed(2);
            }catch(err) {return 0;}
        }

        this.calculate_percentage = function(total,count){
            try{
                var final = count*100/total;
                return final.toFixed(2);
            }catch(err) {return 0;}
        }

        this.moveToNextQuestion = function($current_ques, next_ques_id = 0){

            var timerValue = 0;
            if(slider_animation == 'Y') timerValue = 500;
            var quiz_temp_id = $current_ques.closest('.Quiz-Template').attr('id');

            if(next_ques_id < 1){
                $next_ques_outer = $quesans_outer.find('#'+quiz_temp_id ).next();
            }else{
                $next_ques_outer = $quesans_outer.find('#'+next_ques_id );
            }

            var question_id = $next_ques_outer.attr('data-question-id');
            this.saveQuesAnsReport(question_id);

            setTimeout(function() {
                $quesans_outer.find('#'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
                $next_ques_outer.addClass('show_cls').removeClass('hide_cls');
                $current_ques.addClass('hide_cls').removeClass('show_cls');
                $next_ques_outer.find('.question_container').addClass('show_cls').removeClass('hide_cls');

                $_self.playSilentVideo($next_ques_outer);

                $this.find('.sqb_quiz_container .single_cls').css('pointer-events', 'auto');
                $this.find('.sqb_quiz_container .single_next_btn').css('pointer-events', 'auto');

            }, timerValue);
        }

        this.playSilentVideo = function($question){
            this.stopAllvideo();
            if($question.find('.question_container .video-js video').length > 0){
                $player = $question.find('.question_container .video-js video').attr('id');

                var is_splash = $question.find('.question_container .video-js').hasClass('video-has-thumb');
                var autoplay = false;

                if(video_autoplay == 'Y' && is_splash){
                    autoplay = false;
                }else if(video_autoplay == 'Y' && !is_splash){
                    autoplay = true;
                }else if(video_autoplay != 'Y' && !is_splash){
                    autoplay = false;
                }

                if(autoplay){
                    setTimeout(function() {
                        videojs.getPlayer($player).play();
                    },200);
                }else{
                    $question.find('.question_container .video-js').find('.btn-click-unmute').hide();
                }
                setTimeout(function() {
                    $question.find('.question_container .video-js .vjs-big-play-button').show();
                },200);
            }
        }

        this.stopAllvideo = function(){
            $this.find('.video-js:not(.play-slient)').each(function(i, obj) {
                var $player = jQuery(this).attr('id');
                videojs.getPlayer($player).pause();
            });

            $this.find('.video-js.play-slient').each(function(i, obj) {
                var $player = jQuery(this).attr('id');
                try {
                    videojs.getPlayer($player).muted(1);
                } catch (error) {}
                
            });
        }

        this.playSilentVideoGlobal = function($wrapper){
            this.stopAllvideo();
            if($wrapper.find('.video-js video').length > 0){
                
                $player = $wrapper.find('.video-js video').attr('id');
                $player = $player.replace('_html5_api','');
                
                var is_splash = $wrapper.find('.video-js').hasClass('video-has-thumb');
                var autoplay = false;

                if(video_autoplay == 'Y' && is_splash){
                    autoplay = false;
                }else if(video_autoplay == 'Y' && !is_splash){
                    autoplay = true;
                }else if(video_autoplay != 'Y' && !is_splash){
                    autoplay = false;
                }

                if(autoplay){
                    setTimeout(function() {
                        videojs.getPlayer($player).play();
                    },500);
                }else{
                    jQuery('#'+$player).find('.btn-click-unmute').hide();
                }
                setTimeout(function() {
                    $wrapper.find('.video-js .vjs-big-play-button').show();
                },700);
            }
        }

        this.setAnswerData = function(question_id,answer_id){
            if($this.find('.sqb_question_answer_hidden[data-id="' + question_id + '"]').length < 1){
                jQuery('<input />').attr('type', 'hidden').attr('class', "sqb_question_answer_hidden").attr('data-id', question_id).attr('data-key', answer_id).attr('data-correct', 'N').appendTo($this.find('#sqb_quiz_builder'));
            }
        }

        this.getAnswersData = function(){

            var points_scored = 0;
            var total_points = 0 ;
            var ques_count = $this.find("#ques_count").val(); 
            var sqb_correct_ans = $this.find("#sqb_correct_ans").val(); 
            var points_count = $this.find("#points_count").val(); 
            var sqb_points_ans = $this.find("#sqb_points_ans").val(); 
            var sqb_quiz_type = $this.find("#sqb_quiz_type").val(); 
            if(sqb_quiz_type =="scoring"){
                points_scored = sqb_points_ans;
                total_points = points_count;
            }else{
                points_scored = sqb_correct_ans;
                total_points = ques_count;
            }
            var answer_type = '';   
            var answer_tags = ''; 
            var other_field = ''; 
            var answer_points_scored = 0;
            var sqb_question_answer_array = [];

            $this.find('.sqb_question_answer_hidden').each(function(){
                other_field = '';
                answer_tags = '';
                answer_points_scored = 0;
                var ques_id = jQuery(this).data('id');  
                var answer_id = jQuery(this).data('key');   
                var correct_ans = jQuery(this).data('correct'); 
                var matrix_cls = false;
                var answer_type = '';  
                var $answer_obj = $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer");
                var $question_obj = $this.find("#question_id_"+ques_id);
                var fill_in_blank_cls =  $answer_obj.hasClass('fill_in_blank_cls'); 
                var text_cls =  $answer_obj.hasClass('text_cls'); 
                var date_cls =  $answer_obj.hasClass('date_cls'); 
                var slider_cls =  $answer_obj.hasClass('slider_cls'); 
                var matching_text =  $answer_obj.hasClass('matching_text'); 
                var file_upload_cls =  $answer_obj.hasClass('file_upload_cls');
                var matrix_cls =  $answer_obj.hasClass('matrix_cls');
                var numeric_text_cls = $answer_obj.hasClass('numeric_text_cls');
                var dropdown_cls = $answer_obj.hasClass('dropdown_cls');
                var phone_number_text_cls = $answer_obj.hasClass('phone_number_text_cls');
                var email_cls = $answer_obj.hasClass('email_cls');
                var name_cls = $answer_obj.hasClass('name_cls');
                var weight_and_height_cls = $answer_obj.hasClass('weight_and_height_cls');
                var ranking_choices = $answer_obj.hasClass('ranking_choices');
                if(fill_in_blank_cls ==true){
                    var answer_text =  $question_obj.find(".sqb_fill_in_blank_ans_field").val();                        
                }else if(text_cls ==true){
                    var answer_text =  $question_obj.find(".sqb_textarea_ans_field").val(); 
                }else if(date_cls ==true){
                    var answer_text =  $question_obj.find(".date-question-type").val();
                    var answer_type = 'date';
                }else if(file_upload_cls == true){
                    var fileURl =  $question_obj.find(".file_upload_cls").attr('data-fileurl');
                    var answer_text = fileURl;
                }else if(matching_text == true){
                    var html = $question_obj.find('.sqb_input_ans_field').html();
                    var answer_text = html;
                    answer_type = 'matching_text';
                    //answer_points_scored = calculate_match_points($question_obj);
                }else if(weight_and_height_cls == true){    
                    var answer_text =  $_self.getHeightWeightValues($question_obj,false);
                }else if(slider_cls == true){
                    var prefix_text =  $question_obj.find(".slider.sqb_ans_slider").attr('prefix_text');    
                    var suffix_text =  $question_obj.find(".slider.sqb_ans_slider").attr('suffix_text');    
                    var slider_value =  $question_obj.find(".slider.sqb_ans_slider").val();
                    var answer_text = prefix_text+' '+slider_value+' '+suffix_text;
                }else if(phone_number_text_cls == true){
        
                    var country_code = $question_obj.find(".iti__country.iti__active .iti__dial-code").html();
                    var answer_text =  $question_obj.find(".sqb_and_field").val();
                    if(answer_text != ''){
                        answer_text =  country_code+' '+answer_text;
                    }else{
                        answer_text = '';
                    }
                }else if(email_cls == true){  
                    var answer_text =   $question_obj.find(".sqb_email_ans_field").val();      
                }else if(name_cls == true){  
                    var answer_text =   $question_obj.find(".sqb_name_ans_field").val();      
                }else if(matrix_cls == true){
                    answer_type = 'matrix'; 
                    $question_obj.find(".sqb_and_field.checkbox_fe").each(function(){
                        if(jQuery(this).prop('checked')){
                            var answer_tags_new = jQuery(this).closest('.sqb_ans_rowcol').attr('data-tags_ids');
                            answer_tags = answer_tags+answer_tags_new+',';
                            //var answer_points_scored_new = $question_obj.find(".sqb_ans_selected").attr('data-point');
                            //answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
                        }
                    });
                }else if(matrix_cls == true){
                    var answer_text =  this.getHeightWeightValues($question_obj,false);
                }else if(numeric_text_cls == true){
                    var prefix_text =  $question_obj.find(".numeric_value_prefix").text();  
                    var suffix_text =  $question_obj.find(".numeric_value_sufix").text();   
                    var numeric_value =  $question_obj.find(".sqb_and_field").val();
                    var pretext = '';
                    if (typeof prefix_text !== "undefined") {
                        pretext = prefix_text;
                    }
                    var suftext = '';
                    if (typeof suffix_text !== "undefined") {
                        suftext = suffix_text;
                    }
                    var answer_text = pretext+''+numeric_value+''+suftext;
                    answer_type = 'numerical_text';
                }else if(dropdown_cls == true){
                    var selected_answer_text =  $question_obj.find(".sqb_ans_selected .sqb_question_dropdown").val();
                    var answer_text = selected_answer_text.split('_').join(' ');
                }else{
                    var answer_text =  $question_obj.find(".sqb_ans_selected .sql_ans_text").text();
                    var multiple_or_single =  $question_obj.hasClass('multiple_correct_cls');
                    if(multiple_or_single){

                        answer_text = "";
                        $question_obj.find(".sqb_ans_selected .sql_ans_text").each(function(index) {
                            if(index == 0){
                                answer_text += jQuery(this).text();
                            }else{
                                answer_text +=  ", "+jQuery(this).text() ;
                            }
                            
                        });
                        
                        answer_type ="multiple";
                        var answer_points_scored_new  = 0;
                        var answer_tags_new = '';
                        $question_obj.find(".sqb_and_field.checkbox_fe").each(function(){
                            if(jQuery(this).prop('checked')){
                                var answer_tags_new = jQuery(this).closest('.multiple_correct_checkbox').attr('data-answer-tags');
                                answer_tags = answer_tags+answer_tags_new+',';
                                var answer_points_scored_new = $question_obj.find(".sqb_ans_selected").attr('data-point');
                                answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
                            }
                        });

                        if($question_obj.find(".sqb_ans_item_outer.sqb_ans_selected").length > 1){
                            if(typeof answer_id != undefined && answer_id != ''){
                                var answer_ids = answer_id.split(',');
    
                                if($question_obj.find(".sqb_ans_selected").find('.custom-checkbox-input').hasClass('custom_other_box')){
                                    var selected_id = $question_obj.find(".sqb_ans_selected").attr('data-answer-id');
                                }else{
                                    var selected_id = "";
                                }
                                if(jQuery.inArray(selected_id, answer_ids) !== -1){
                                    other_field = $question_obj.find('.custom-other-box').val();
                                }else{
                                    other_field = '';
                                }
                            }
                        }else{
                            if($question_obj.find(".sqb_ans_selected").find('.custom-checkbox-input').hasClass('custom_other_box')){
                                other_field = $question_obj.find('.custom-other-box').val();
                            }else{
                                other_field = '';
                            }
                        }
                        //console.log(other_field);
                        
                    }else{
                        if(ranking_choices == true){
                            answer_type = 'rank';
                        }else{
                            answer_type = 'single';
                        }
                        
                        answer_tags = $question_obj.find(".sqb_ans_selected").attr('data-answer-tags');
                        
                        if(answer_id == $question_obj.find(".sqb_ans_selected").attr('data-answer-id')){
                            other_field = $question_obj.find('.custom-other-box').val();
                        }else{
                            other_field = '';
                        }
                        answer_points_scored = $question_obj.find(".sqb_ans_selected").attr('data-point');
                    }
                }
                
                var incorrect_answer_msg_exp = $question_obj.find(".incorrect_answer_msg").val();
                var common_incorrect_answer_msg_exp = $this.find("#common_incorrect_msg").val();         
                if(incorrect_answer_msg_exp ==""){
                    incorrect_answer_msg_exp = common_incorrect_answer_msg_exp;
                }

                var correct_answer_msg_exp = $question_obj.find(".correct_answer_msg").val();
                var common_correct_answer_msg_exp = $this.find("#common_correct_msg").val();         
                if(correct_answer_msg_exp ==""){
                    correct_answer_msg_exp = common_correct_answer_msg_exp;
                }
                
                //sqb_save_user_quesans(user_id, quizId, ques_id,answer_id, correct_ans, answer_text, sqbdatetime, points_scored, total_points);
                sqb_question_answer_array.push({
                    //'user_id':user_id,
                    'quizId':quiz_id,
                    'ques_id':ques_id,
                    'answer_id':answer_id,
                    'correct_ans':correct_ans,
                    'answer_text':answer_text,               
                    'points_scored':points_scored,
                    'total_points':total_points,
                    'incorrect_answer_msg_exp':incorrect_answer_msg_exp,
                    'correct_answer_msg_exp':correct_answer_msg_exp,
                    'answer_type':answer_type,
                    'answer_tags':answer_tags,
                    'other_field':other_field,
                    'answer_points_scored':answer_points_scored,
                });
            });

            ques_ans_data = sqb_question_answer_array;

            return sqb_question_answer_array;
        }

        this.getHeightWeightValues = function($this,isarray = true){

            if( $this.find('.sqb_ans_selected').length > 0){  
                var weight = $this.find('.weight-input').val();
                var height_feet = $this.find('.height-feet').val();
                var height_inches = $this.find('.height-inches').val();
        
                if(height_inches == ''){
                    height_inches = 0;
                }
                var h = parseInt(height_feet * 12) + parseInt(height_inches);
                if(isarray)
                    var ob = {'w' : weight, 'h' : h, 'in' : height_inches};
                else
                    var ob = weight+','+h;

                return ob;
            }
        }

        this.getMatchingmaxPoints = function($question) {
            var data_points_array = [];
            var points = 0;
             $question.find('.sqb_ans_item_outer .sqb_input_ans_field .sqb-match-box').each(function(){
                var data_points = jQuery(this).attr("data-point");
                points = parseInt(points) + parseInt(data_points);
            });
            return points;
        }

        this.matchPoints = function($question){
            var matched = $question.find('.sqb_ans_item_outer .sqb_input_ans_field .sentence-matched');
            var points = 0;
            matched.each(function(){
                points = points + parseInt(jQuery(this).attr('data-point'));
            });
            return points;
        }

        this.progressBar = function($question,$isBack = false){
            
            var sqb_ans_selected = $question.find(".sqb_ans_item_outer.sqb_ans_selected").length;    
            var ques_count =$this.find('#ques_count').val(); 
            var fill_in_blank_cls = $question.find(".sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
            var text_cls =   $question.find(".sqb_ans_item_outer").hasClass('text_cls'); 
            var date_cls =   $question.find(".sqb_ans_item_outer").hasClass('date_cls'); 
            var slider_cls =   $question.find(".sqb_ans_item_outer").hasClass('slider_cls'); 
                                    
            if(fill_in_blank_cls ==true){   
            }else if(text_cls ==true){
            }else if(date_cls ==true){
            }else if(slider_cls ==true){
            }else{
                if(sqb_ans_selected >0 && $isBack == false){
                    var ques_count= parseInt(ques_count) + 1;       
                }
            }
                
            $this.find('#ques_count').val(ques_count);   
            var ques_count_progress = $this.find('#ques_count_progress').val(); 
            if(!$isBack){
                var ques_count_progress= parseInt(ques_count_progress) + 1;
            }else{
                var ques_count_progress= parseInt(ques_count_progress) - 1;
            }
            $this.find('#ques_count_progress').val(ques_count_progress);
                
            var total_ques = $this.find('#total_ques').val();
            var final_count = parseInt(total_ques, 10) / ques_count_progress;            
            var final_val = parseFloat(parseInt(ques_count_progress, 10) * 100) / parseInt(total_ques, 10);
                    
            final_val = (Math.round(final_val * 100) / 100).toFixed(0);  
            $this.find('.progress-bar').val(final_val);
            $this.find('.progress-bar').css("width",final_val+"%");
            $this.find('.progress_percent').text(final_val+"%");
            $outcome_outer.addClass('hide_cls').removeClass('show_cls');    
           
        }

        this.correctmsg_display = function(correct_answer_msg, $question){ 
           
           if(template == 'template8'){
                $question.find('.answer_container ').after('<div class="correctincorrect_ans_div"><b>'+correct_answer_msg+' </b></div>');
            }else{
                var m_wrapper = $question.find('.single_next_btn.sqb_next_btn, .single_next_btn ');
                if(m_wrapper.parent('.back-next-btn').length > 0){
                    m_wrapper = m_wrapper.parent('.back-next-btn');
                }
                m_wrapper.before('<div class="correctincorrect_ans_div"><b>'+correct_answer_msg+' </b></div>'); 
            }
        }
        
        this.incorrectmsg_display = function(incorrect_answer_msg, $question){

            if(template == 'template8' || template == 'template7'){
                var inner_max_width = $question.find('.answer_container').css('max-width');
                var inner_width_style = '';
                if(typeof inner_max_width != 'undefined' && inner_max_width != ''){
                    inner_width_style = 'style="max-width:'+inner_max_width+'"';
                }
                $question.find('.answer_container ').after('<div class="in_correct_ans correctincorrect_ans_div" '+inner_width_style+'><b>'+incorrect_answer_msg+'</b></div>');
            } else {
                if(this.isQuestionType('file_upload',$question)){
                    $question.find('.file_upload_button').before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+$this.find('#file_upload_validation').val()+'</b></div>');
                } else {
                    var m_wrapper = $question.find('.single_next_btn.sqb_next_btn, .single_next_btn ');
                    if(m_wrapper.parent('.back-next-btn').length > 0){
                        m_wrapper = m_wrapper.parent('.back-next-btn');
                    }

                    if(quiz_type == 'poll'){
                        $question.find('.answer_container ').after('<div class="in_correct_ans correctincorrect_ans_div" '+inner_width_style+'><b>'+incorrect_answer_msg+'</b></div>');
                    }else{
                        m_wrapper.before('<div class="in_correct_ans correctincorrect_ans_div"><b>'+incorrect_answer_msg+'</b></div>');
                    }

                    
                }
            }
        } 

        this.setBackButton = function(){
            $quesans_outer.find('.Quiz-Template-outer div.Quiz-Template:first').find('.single_back_btn').remove();
        }
        this.setNextButton = function(){

            if(template == 'template8'){

                $this.find('.skip-question-btn').removeClass('single_next_btn').removeClass('sqb_next_btn');
                $this.find('.skip-question-btn').addClass('skipped_btn ');

                $this.find('.skip-question-btn').hide();
                $this.find( "input.allow_skip_ques[value='Y']" ).each(function(){
                    var q = jQuery(this).closest('.question_container ').attr('data-question-id');
                    $this.find('#quiz_temp_id'+q+' .skip-question-btn').show();
                });
            }

            var ques_type_single = $this.find('.question_type_single').find('.single_next_btn');
            var ques_type_yesno = $this.find('.question_type_yes_no').find('.single_next_btn');

            if(quiz_type == 'personality' || quiz_type == 'survey' || quiz_type == 'calculator' || quiz_type == 'scoring' || quiz_type == 'assessment'){
            
                if(quiz_type == 'scoring' || quiz_type == 'assessment'){
                    var disp_correctans_opt = $this.find('#display_correctans_options').val();
                    if(disp_correctans_opt == 'both' || disp_correctans_opt == 'each_page'){
                        ques_type_single.show();
                        ques_type_yesno.show();
                    }else{
                         if(show_next_button == 'N'){
                            ques_type_single.hide();
                            ques_type_yesno.hide();
                        }
                    }
                }else if(show_next_button == 'N'){
                    ques_type_single.hide();
                    ques_type_yesno.hide();
                }
            }


        }

        this.setFullwidth = function(){
            var window_width = jQuery('html').width();
            jQuery('html').css("--window-width-full-screen", window_width+'px');
        }

        this.setStyle5 = function(){

            if($this.find('.Quiz-start-Template5-left').hasClass('sqb_start_screen_background_image')){
        
                var $quiz_template5_left = $this.find('.Quiz-start-Template5-left');
                var sqb_bg_img = $quiz_template5_left.css('background-image');
                var img_url_info = sqb_bg_img;
                if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
                var color1 = sqb_bg_img.split(/[, ]+/).slice(0, 1);
                var color2 = sqb_bg_img.split(/[, ]+/).slice(1, 2);
                var color3 = sqb_bg_img.split(/[, ]+/).slice(2, 3);
                var opacity = sqb_bg_img.split(/[, ]+/).slice(3, 4);
                }   
                var img_info = img_url_info.split(/[, ]+/).pop();
                var img_url = img_info.split('"');
            
                var color_one = color1[0].split("(").pop();
                var final_color = "rgba("+color_one+","+color2+","+color3+","+parseFloat(opacity)+")";
                var final_opacity = "";
                if(parseFloat(opacity) > 0){
                final_opacity = parseFloat(opacity);
                }
                $quiz_template5_left.attr('style','');
                var bg_img_tag = '<div class="quiz-bg-img" style="opacity:'+final_opacity+';"><img src="'+img_url[1]+'" alt="background"></div>';
                if($this.find('.Quiz-start-Template5-left .Quiz-Template5-title').length != 0){
                    $quiz_template5_left.find('.Quiz-Template5-title').before(bg_img_tag);
                }else{
                    $quiz_template5_left.append(bg_img_tag);

                }
                $quiz_template5_left.css('background-color',final_color);
                
            }

        };

        this.setStyle = function(){
            this.setFullwidth();
            var template5_width = $this.find('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width');
            if(template5_width == '1800px'){
                $this.find('.sqb_template5-fullWidth').find('.Quiz-start-Template5.start_temp_outer').css('max-width','');
            }

            $_self.setStyle5();

            $this.find('.startTemplateYoutubeVideoOuter iframe').css('max-height','100%');
            $this.find('.outcomeTemplateYoutubeVideoOuter iframe').css('max-height','100%');
            $this.find('.questionTemplateYoutubeVideoOuter iframe').css('max-height','100%');

            
            if(template == 'template6'){
                var qns_style = $this.find('.single_cls_div').attr("style");
                $this.find('.analyzing_result_temp').attr("style",qns_style);
                if($this.find('.Quiz-Start-Template2.Start-template-withbutton').length > 0){
                    $this.find('.Quiz-Start-Template2.Start-template-withbutton').closest('.quiz_start_template_outer').attr('style','');
                    $this.find('.Quiz-Start-Template2.Start-template-withbutton').closest('.quiz_start_template_outer').find('.background-image-template6').remove();
                }
            }

            var quiz_quesans_style = jQuery('.quiz_quesans_template1 .Quiz-Template').attr("style");
            $this.find('.quiz_quesans_template_outer .Quiz-Template').attr("style", quiz_quesans_style);    
    
        };
       
        this.sqbDatePicker = function(){
            var date_field = $this.find('#custom_date_field_data').val();
            if(date_field){
                
                $this.find('.input-group.date').removeClass('hasDatepicker').datepicker({dateFormat: date_format});

                var date_field = date_field.split('|');
                var month_name = date_field[0].split(",");
                var day_name = date_field[1].split(",");
                var date_format = $this.find('.custom-date-field').attr('data-date-format');

                $this.find('.input-group.date').datepicker({
                    dateFormat: date_format,
                    monthNames: month_name,
                    dayNamesMin: day_name,
                    showOn: "button",
                    firstDay: 1,
                    buttonImage: home_url + "/wp-content/plugins/smartquizbuilder/includes/images/calendar_icon.svg",
                    buttonImageOnly: true,
                    changeMonth: true,
                    changeYear: true
                });

                $this.find('.input-group.date').removeClass('hasDatepicker').datepicker({
                    dateFormat: date_format,
                    changeMonth: true, 
                    changeYear: true
                });
            }

            $this.find('.Quiz-Template .date-question-type').each(function(){
                var date_format = jQuery(this).attr('data-date-format');
                var month_data = jQuery(this).attr('data-month-name');
                var month_data = month_data.split(",");
                var day_data = jQuery(this).attr('data-day-name');
                var day_data = day_data.split(",");
                var home_url = jQuery('#get_home_url').val();
                jQuery(this).datepicker({
                    container:'.Quiz-Template-content',
                    dateFormat: date_format,
                    monthNames: month_data,
                    dayNamesMin: day_data,
                    showOn: "button",
                    firstDay:1,
                    buttonImage: home_url+"/wp-content/plugins/smartquizbuilder/includes/images/calendar_icon.svg",
                    buttonImageOnly: true});
            });

            $this.on('click','.date-question-type', function(){
                jQuery(this).parents('.date_cls').find('.ui-datepicker-trigger').trigger('click');
            });

        };

        this.tinyMce = function(){
            $this.find('.sqb_tiny_mce_editor').filter(function() {
                if(jQuery(this).find('iframe').length != 0){
                    return false;
                }
                if(jQuery(this).find('img').length != 0){
                    return false;
                }
              return jQuery(this).text().trim().length == 0;
            }).remove();
        };

        this.sqbScrollToNextScreen = function(){
            if(quiz_display == "inpage"){ 
                if(quiz_pagination =="all"){
                    if(show_fname_temp != 'Y'){ 
                        jQuery('html, body').animate({
                            scrollTop: $quesans_outer.offset().top-120
                        }, "slow");
                    
                    }
                }
            }       
        }

        this.getUrlVars = function(){
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
        this.customFieldsAutoPopulate = function(){
            var error = [];
            var exists_field = [];
            var allValues = this.getUrlVars();

            $this.find(".custom_add_fields").each(function(){
                    
                var field_name = jQuery(this).attr('id');
                var name = field_name.replace('id_custom_fields_','');
                if(all_custom_fields.length > 0){
                    var i =0;
                    jQuery.each( all_custom_fields, function( key, value ){
                        if(name == value.id || name == value.name){
                            exists_field.push(name);
                            return false;
                        }
                    });
                }
            });

            
            $this.find("#sqb_direct_signup").find("input[name^='custom_'],select[name^='custom_'], radio[name^='custom_'], textarea[name^='custom_'], checkbox[name^='custom_']").each(function(){
            
                var field = jQuery(this);
                var value = '';
                var type = field.prop('nodeName');
                var name =  field.attr('name');
            
                if(jQuery.inArray(name,exists_field) == -1){
                    if(type == 'INPUT'){
                        if(field.is(':radio')){
                            if(allValues[name] != undefined){
                                jQuery("input[name="+name+"][value=" + allValues[name] + "]").prop('checked', true);
                            }
                        }else if (field.is(':checkbox')) {
                            if(allValues[name] != undefined){
                                jQuery("input[name='"+name+"'][value=" + allValues[name] + "]").prop('checked', true);
                            }
                        }else{
                            if(allValues[name] != undefined){
                                field.val(allValues[name]);
                            }
                        }
                    }else if (type == 'SELECT') {
                        if(allValues[name] != undefined){
                            field.val(allValues[name]);
                        }
                    }else if (type == 'TEXTAREA') {
                        if(allValues[name] != undefined){
                            field.text(decodeURIComponent(allValues[name]));
                        }
                    }
                }

                var name_ = field.attr('name').replace('custom_','');
                if(jQuery.inArray(name_,exists_field) == -1){
                    if(type == 'INPUT'){
                        if(field.is(':radio')){
                            if(allValues[name_] != undefined){
                                jQuery("input[name="+name+"][value=" + allValues[name_] + "]").prop('checked', true);
                            }
                        }else if (field.is(':checkbox')) {
                            if(allValues[name_] != undefined){
                                jQuery("input[name='"+name+"'][value=" + allValues[name_] + "]").prop('checked', true);
                            }
                        }else{
                            if(allValues[name_] != undefined){
                                field.val(allValues[name_]);
                            }
                        }
                    }else if (type == 'SELECT') {
                        if(allValues[name_] != undefined){
                            field.val(allValues[name_]);
                        }
                    }else if (type == 'TEXTAREA') {
                        if(allValues[name_] != undefined){
                            field.text(decodeURIComponent(allValues[name_]));
                        }
                    }
                }
            });
        }

        this.coreFieldsAutoPopulate = function(){

            var inputVars = this.getUrlVars();
            var firstname = inputVars["firstname"];
            if(firstname == null){
                if(inputVars["first_name"] != undefined){
                    var firstname = decodeURIComponent(inputVars["first_name"]);
                }
            }
            var email = (inputVars["email"]);

            if(email != undefined && email != ''){
                email = decodeURIComponent(inputVars["email"]);
            }

            if(firstname != undefined || email != undefined){
                if($this.find('.sqb_first_name').val() != undefined ){
                }else{
                    if($optin_outer.find('#first_name').val() == ''){
                        $optin_outer.find('#first_name').val(firstname);
                    }
                }
                if($optin_outer.find('#email').val() == ''){
                    $optin_outer.find('#email').val(email);
                }

                if($this.find('.sqb_email_ans_field').length > 0){
                    $this.find('.sqb_email_ans_field').val(email);
                }
            }else{
                var dap_email = $this.find('#dap_login_email_id').val();
                if(dap_email != undefined){
                    var dap_first_name = $this.find('#dap_login_first_name').val();
                    if(dap_first_name != ''){
                        $optin_outer.find('#first_name').val(dap_first_name);
                        $this.find('.sqb_first_name').val(dap_first_name);
                    }

                    if(dap_email != ''){
                        $optin_outer.find('#email').val(dap_email);
                    }
                }
            }

            if($this.find('.sqb_email_ans_field').length > 0 && $this.find('.sqb_email_ans_field').val() != ''){

                try {
                    
                    var qemail = $this.find('.sqb_email_ans_field').val();
                    var qfirstname = qemail.split('@')[0];
                    if($this.find('.question_type_name').length < 1){
                        if(show_fname_temp != 'Y'){
                            if(firstname == '' || firstname == undefined){
                               $optin_outer.find('#first_name').val(qfirstname);
                            }
                        }
                    }else{
                        var ffname = $this.find('.question_type_name .sqb_name_ans_field').val();
                        $optin_outer.find('#first_name').val(ffname);
                    }
                    
                    $optin_outer.find('#email').val(qemail);
                } catch (error) {}
            }

            if($this.find('.sqb_first_name').val() != ''){
                $this.find('.sqb_first_name').trigger('keyup');
            }
            
        }

        this.autoSubmitOptin = function(){

            var isValid = false;
            
            this.coreFieldsAutoPopulate();
            this.customFieldsAutoPopulate();

            if(auto_submit_optin == 'Y' && show_result_screen == 'Y'){

                this.submitOptin();
                if($this.find('.sqbwarning_div').length > 0){
                    $this.find('.sqbwarning_div').remove();
                    $this.find('.sqb_custom_field_required_class').html('');
                    $this.find('.sqb_custom_field_required_class').hide();
                    $optin_outer.addClass('show_cls').removeClass('hide_cls');
                    $quesans_outer.addClass('hide_cls').removeClass('show_cls');
                    isValid = true;
                }else{
                    if(opt_screen_position == 'optin-before-questions-screen'){
                        
                    }else{
                        //jQuery(wrapper+ ' .quiz_analyzing_template_outer').addClass('show_cls').removeClass('hide_cls'); 
                    }
                }
            }
            return isValid;
        }

        this.backgroundOptinProcess = function(){
          
            var first_name = this.getOptinField('first_name');
            var email = this.getOptinField('email');
            var action = 'SQBSubmitBackgroundProcessAjax';

            var data = {
                'is-v2' : '1',
                action: action,
                first_name: first_name,
                email: email,
                quizId: quiz_id,
                quiz_id : quiz_id
            };

            jQuery.ajax({
                url: ajaxurl,
                type: "POST",
                data: data,
                success: function (response) {
                    
                }
            });
        }

        this.retakeQuiz = async function(){

            var $btn = $this.find('.retake_button');
            var $old_text = $btn.html();
            
            this.btnLoader($btn);

            $this.find('.quiz_result_template_outer').html($outcome_html);
            $this.find('.quiz_quesans_template_outer').html($quesans_html);
            $this.find('.quiz_result_template_outer').addClass('hide_cls').removeClass('show_cls');
            quiz_processed = false;
            this.setStyle();
            this.setNextButton();
            jQuery('#'+wrapper).css("cursor", "default");
            var is_retake = false;
            if(lesson_id > 0){
                
                var cookie = this.getCookieForRetake();
                var retake_cookie = cookie.split("||");
                var showRetake = retake_cookie[0];
                var cookieValueNew = retake_cookie[1];
                var quiz_attempts_allowed = retake_cookie[2];
                if(showRetake =='true'){
                    is_retake = true;
                    if(quiz_attempts_allowed =="Limited" ){
                        jQuery.cookie("SQBRetake_"+quiz_id, cookieValueNew);
                    }
                }

                $this.find('#sqb_retake').val("Y");
                $quesans_outer.find('.outcome_div').remove();
                $quesans_outer.find('.outcome_data_cont').remove();
                $this.find('.buttondata_outer.multiple_ques_true .dap_see_details_btn').addClass('btn_disabled');
                $this.find('.not_passed_quiz_msg_outer').remove();
                $this.find('.outcome_data_cont').html('');
                $this.find('#already_given_quiz_status').val(0);
                $this.find('.quiz_result_template_outer1').hide();
                $quesans_outer.find('.sqb-page-numbers').show();
                $quesans_outer.find('.sqb-question-on-cat').show();

                $this.find('.question_container').each(function(){
                    jQuery(this).find(" .sqb_ans_item_outer").removeClass("sqb_ans_selected");
                    jQuery(this).find(" .sqb_ans_item_outer").removeClass("addselected");
                });

                $this.find('.sqb_and_field.checkbox_fe').each(function(){       
                    jQuery(this).prop("checked" , false);
                    jQuery(this).closest('.sqb_ans_item_outer').removeClass('sqb_ans_selected');             
                });
                $_self.setFirstScreen('Y','ques_ans');
                is_retake = true;
            }else{
                $this.find('.quiz_optin_template_outer').html($optin_html);
                //$_self.setFirstScreen();
                var cookie = this.getCookieForRetake();
                var retake_cookie = cookie.split("||");
                var showRetake = retake_cookie[0];
                var cookieValueNew = retake_cookie[1];
                var quiz_attempts_allowed = retake_cookie[2];
                if(showRetake =='true'){
                    is_retake = true;
                    if(quiz_attempts_allowed =="Limited" ){
                        jQuery.cookie("SQBRetake_"+quiz_id, cookieValueNew);
                    }
                }
            }

            if(is_retake){
                pageViewed = ["1"];
                localReport = {};
                skip_optin = false;
                merge_tags = [];
                quizResponse = {};
                outcome_ids_array = [];
                outcome_ids_points_array = {};
                sqb_outcome_content_clone = {};
                outcome_anslist = [];
                QfirstName = '';
                newcatarraylow = {};
                newcatarrayhigh = {};

                jQuery('#'+wrapper).css("cursor", "progress");
    
                $this.find('.sqb_question_answer_hidden').remove();

                $this.find('.sqb_counter_outer1').remove();
                $this.find('#timer_count').val(0);
                $this.find('#time_spent1').val(0);
                $this.find('#timer_spent').val(0);
                $this.find('#timer_stop').val(0);
                var time_hour= $this.find('#time_hour').val();
                var time_min= $this.find('#time_min').val();
                var time_sec= $this.find('#time_sec').val();
                $this.find('.sqb-hours').text(time_hour);
                $this.find('.sqb-minutes').text(time_min);
                $this.find('.sqb-seconds').text(time_sec);
                $this.find('#quiz_attempted').val('N');

                $this.find('.sqb_speed_counter_outer1').remove();
                $this.find('#speed_timer_count').val(0);
                $this.find('#speed_time_spent1').val(0);
                $this.find('#speed_timer_spent').val(0);
                $this.find('#speed_timer_stop').val(0);

                $this.find('#sqb_correct_ans').val(0);
                $this.find('#sqb_points_ans').val(0);
                $this.find('#ques_count').val(0);
                $this.find('#points_count').val(0);
                $this.find('#ques_count_progress').val(0); 
                $this.find("#outcome_advanced_rule_id").val('');
                $this.find('.progress-bar').val(0);
                $this.find('.progress-bar').css("width", "0%");
                $this.find('.progress_percent').text("");
                $this.find('#final_formula_val').val(0);
                this.sqbDraggable();
                this.sqbSlider();
                this.sqbDatePicker();
                this.sqbIntlTelInput();
                this.sqbRankSortable();
                this.disposevideoPlayer();
                this.videoPlayer();
                jQuery('#'+wrapper).css("cursor", "default");

                $this.find('.question_container').first().find('.sqb_back_btn').hide();

                $_self.setFirstScreen('Y','ques_ans');
            }

            $btn.html($old_text);
        }

        this.appendSocialSharonOC = function(){
            outcome_id = 'outcome_id_'+final_outcome; 
            var share_html =  $this.find(" .sqb_social_share_html").html();
            if(share_html != ''){
                if( $this.find("  #"+outcome_id).find('.customize_social_share_wrapper').length == 0){
                     $this.find(" #"+outcome_id+" .result_temp_outer").append(share_html);              
                     $this.find(" .sqb_social_share_html").attr('data-outcome-id',outcome_id);          
                }
            }

        }

        this.showSocialShareScreen = function(){
            $this.find('.quiz_social_share_template_outer').addClass('show_cls').removeClass('hide_cls');
        }

        this.processSocialShare = function(outcome_id){
            
            var share_html =  $this.find(".sqb_social_share_html").html();
            if(share_html != ''){
                if( $this.find("#"+outcome_id).find('.customize_social_share_wrapper').length == 0){
                    $this.find("#"+outcome_id+" .result_temp_outer").append(share_html);        
                    $this.find("#.sqb_social_share_html").attr('data-outcome-id',outcome_id);           
                }
            }
        }
        
        this.setSQBCookieForRetake = function(){
            if(lesson_id > 0) return false;
            
            var retake_cookie = this.getCookieForRetake();
            var cookie = retake_cookie.split("||");
            var showRetake = cookie[0];
            var retake_html= jQuery('.retake_without_lesson_div').html();
            if(showRetake =='true' && allow_retake == 'Y'){
                $outcome_outer.find('.result_temp_outer').each(function(){
                    if (jQuery(this).find('.retake_without_lesson_div').length === 0) {
                        jQuery(this).append('<div class="vtg reake_data_outer retake_without_lesson_div disable_retakebutton">'+retake_html+'</div>');
                    }
                });
                $outcome_outer.find('.result_temp_outer').find('.retake_without_lesson_div').removeClass('disable_retakebutton');
            }
        }

        this.getCookieForRetake = function(){
            var total_attempts = $this.find('#total_attempts_new').val();
            var quiz_attempts_allowed = $this.find('#quiz_attempts_allowed_new').val();
            var showRetake = false;  
            if(allow_retake == "Y" && quiz_display !="corner_popup" ){
                if(quiz_attempts_allowed !="Limited" ){
                    showRetake = true;
                }else{
                    var cookieValue = jQuery.cookie("SQBRetake_"+quiz_id);
                    if(  typeof cookieValue != 'undefined' ){ 
                        if(parseInt(cookieValue) < parseInt(total_attempts)){    
                            var cookieValueNew = parseInt(cookieValue)+1;                                       
                            showRetake = true;
                        }
                    }else{
                        showRetake = true;
                        var cookieValueNew =1;
                    }   
                }       
            }
            return showRetake+"||"+cookieValueNew+"||"+quiz_attempts_allowed;
        }

        this.initThirdPartyPlugin = function(){ 
            this.tinyMce();
            this.sqbSlider();
            this.sqbDatePicker();
            this.sqbIntlTelInput();
            this.sqbDraggable();
            this.sqbRankSortable();
            this.googleFont();
            this.videoPlayer();
        };

        this.sqbSlider = function(){

            $this.find('.slider_cls').addClass('sqb_ans_selected');
            $this.find('.Quiz-Template .type-slider-outer').each(function(){
                if(jQuery(this).find('#ex1Slider').length == 0){

                    var slider_id = jQuery(this).find('.sqb_ans_slider').attr('id');
                    var $slider = $this.find("#"+slider_id);
                    var  slider_b_clr = $slider.attr('slider_b_clr');
                    var  complete_bar_b_clr =$slider.attr('complete_bar_b_clr');
                    var  top_box_b_clr = $slider.attr('top_box_b_clr');
                    var  prefix_text = $slider.attr('prefix_text');
                    var  suffix_text = $slider.attr('suffix_text');
                    if(prefix_text == undefined){
                        prefix_text = '';
                    }
                    
                    if(suffix_text == undefined){
                        suffix_text = '';
                    }
                    
                    $slider.bootstrapSlider().change(function(e) {
                        jQuery(this).trigger('click');
                    });
                    $slider.bootstrapSlider({formatter: function(value) {
                        return prefix_text+' '+ value +' '+suffix_text ;
                        }
                    });
                    
                    var slider_selector = $slider.closest('.type-slider-outer');
                    slider_selector.find('.slider.slider-horizontal .slider-track').css('background-color',slider_b_clr);
                    slider_selector.find('.slider.slider-horizontal .slider-handle').css('background-color',complete_bar_b_clr)
                    slider_selector.find('.slider.slider-horizontal .slider-track .slider-selection').css('background-color',complete_bar_b_clr)
                    slider_selector.find('.slider.slider-horizontal .tooltip .tooltip-inner').css('background-color',top_box_b_clr );     
                }
            });
        }

        this.sqbDraggable = function(){

            $this.find(".sqb-match-item").draggable({
                beforeStart: function() {
                  window.source_index = jQuery(this).attr("data-index");
                  window.source_html = jQuery(this).html();
                },
                "revert": "invalid"
              });
            
            if($this.find(".sqb-match-box").length > 0){
                $this.find(".sqb-match-box").droppable({
                    "accept": ".sqb-match-item",
                    classes: {
                        "ui-droppable-active": "ui-state-active",
                        "ui-droppable-hover": "ui-state-hover"
                    },
                    "drop": function(event, ui) {
                        window.dest_html = jQuery(this).html();
                        window.dest_index = jQuery(this).attr("data-index");
                        
                        question_wrapper = jQuery(this).closest('.question_type_matching_text');
                        if(typeof window.dest_html != 'undefined' && window.dest_html != '') {
                            return false;
                            switchContent(question_wrapper);
                        } else {
                            var $presentChild = jQuery(this).find(".sqb-match-item"),
                            currChildId = $presentChild.attr("id"),
                            $currChildContainer = jQuery("#" + currChildId + "-container");
                            $currChildContainer.append($presentChild);
                            $presentChild.removeAttr("style").removeClass("drag-center-in-droppable");
                            //makedraggable3();
                            jQuery(ui.draggable).clone().appendTo(this).removeAttr("style").addClass("drag-center-in-droppable");
                            jQuery(ui.draggable).remove();
                            jQuery(this).droppable( 'disable' );
                        }
                    
                        jQuery(question_wrapper).find('.sqb_input_ans_field .drag-container .sqb-match-item').each(function(){
                            jQuery(this).removeClass('ui-draggable');
                            jQuery(this).removeClass('ui-draggable-handle');
                            jQuery(this).removeClass('ui-draggable-dragging ');
                            jQuery(this).removeClass('drag-center-in-droppable');
                        });
                    
                        var is_validate = true;
                        jQuery(question_wrapper).find('.sqb_input_ans_field .drag-container').each(function(){
                            if(jQuery(this).find('.sqb-match-box .sqb-match-item').length < 1){
                                is_validate = false;
                            }
                        });
                    
                        if(is_validate){
                            jQuery(question_wrapper).find('.sqb_ans_item_outer').addClass('sqb_ans_selected');
                            jQuery(question_wrapper).removeClass('disable_nextbutton');
                        }else{
                            jQuery(question_wrapper).find('.sqb_ans_item_outer').removeClass('sqb_ans_selected');
                            jQuery(question_wrapper).addClass('disable_nextbutton');
                        }
                    }
                });
            }
        }

        this.isSentenceMatch = function($question){
            $question.find('.sqb_input_ans_field .drag-container').each(function(){
                if(jQuery(this).find('.sqb-match-box').attr('data-match') == jQuery(this).find('.sqb-match-box .sqb-match-item').attr('data-match')){
                    jQuery(this).find('.sqb-match-box').addClass('sentence-matched').removeClass('sentence-not-matched');
                }else{
                    jQuery(this).find('.sqb-match-box').addClass('sentence-not-matched').removeClass('sentence-matched');
                }
            });
        }

        this.sqbRankSortable = function(){
            $this.find('.Quiz-Template-overflow .single_next_btn_container').each(function(){
                if(jQuery(this).hasClass('question_type_ranking_choices')) {
                    jQuery(this).find('.question_add_answer_outer_div').sortable();
                    jQuery(this).find('.sqb_is_right_ans').removeClass('.sqb_and_field');                
                } 
            });
        }

        this.videoPlayer = function(){
            $this.find('.video-js-main').each(function(i, obj) {
                var options = {};
                //console.log(jQuery(this).attr('id'));
                var player = videojs(jQuery(this).attr('id'), options, function onPlayerReady() {
                    videojs.log('Your player is ready!');
                    var t = jQuery(this).attr('id');
                    var $t = jQuery(this);
                    $this.find('.vjs-big-play-button').attr('title','');
                    this.on('pause', function(t) {
                        jQuery(t.target).find('.vjs-big-play-button').show();
                    });

                    //if(jQuery(t.target).hasClass('play-slient')){
                        //jQuery(t.target).find('.vjs-loading-spinner').addClass('vjs-loading-spinner-hide');
                    //}
                    this.on('playing', function(t) {
                        if(jQuery(t.target).hasClass('play-slient')){
                            jQuery(t.target).find('.vjs-big-play-button').show();
                        }else{
                            jQuery(t.target).find('.vjs-big-play-button').hide();
                        }
                    });

                    this.on('pause', function(t) {
                        jQuery(t.target).find('.vjs-big-play-button').show();
                    });
                    
                    this.on('ended', function() {
                        //videojs.log('Awww...over so soon?!');
                    });

                    this.on('loadedmetadata',function(){
                        //console.log(jQuery(this));
                    });
                    
                });

                if(click_to_unmute == 'Y'){
                    var myButton = player.addChild('button', {}, 0);
                    var myButtonDom = myButton.el();
                    jQuery(myButtonDom).addClass('btn-click-unmute');
                    myButtonDom.innerHTML = '<span class="vjs-icon-click-umute img10">'+video_umute_text+'</span>';
                }


                //player.vhs.options_.externHls.GOAL_BUFFER_LENGTH = 60;
                $this.find('.vjs-big-play-button').attr('title','');
            });
        }

        this.disposevideoPlayer = function(){
            $this.find('.video-js-main').each(function(i, obj) {
                var player = videojs(jQuery(this).attr('id'));
                player.dispose();
            });
        }

        this.googleFont = function(){
            //var gdpr_value = $this.find('#gdpr_compliance').val();
            var is_googlefont = $this.find('#is_googlefont').val();
            if(gdpr_value == 0 && is_googlefont == 1){

                if($this.hasClass('sqb_global_theme_enable_each_template')){

                    if(template == 'template9'){
                        var outr = '.template9_start_temp_outer';
                    }else if(template == 'template5'){
                        var outr = '.Quiz-start-Template5.start_temp_outer';
                    }else{
                        var outr = '.Quiz-Template2.start_temp_outer';
                    }

                    if(template == 'template5'){
                        var global_font_family_title = $this.find(outr+' .Quiz-Template5-title').css('font-family');
                    }else{
                        var global_font_family_title = $this.find(outr+' .Quiz-Template-title').css('font-family');
                    }
                
                    if(quiz_display == 'popup' || quiz_display == 'exit' || quiz_display == 'corner_popup' || quiz_display == 'time_based' || quiz_display == 'percentage_based' ){
                        var global_font_family_title = $this.find('.Quiz-Template .question_title').css('font-family');
                    }


                    if(global_font_family_title){
                        global_font_family_title = global_font_family_title.replace(/^"(.*)"$/, '$1');

                        global_font_family_title = global_font_family_title.replaceAll(' ','+');
                        global_font_family_title = global_font_family_title.replaceAll('"','');
                        
                        if(global_font_family_title != ''){
                            global_font_family_title = global_font_family_title.split(',');
                            global_font_family_title = global_font_family_title[0];
                        }

                        var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_title;
                        var stylesheet = jQuery("<link>", {
                            rel: "stylesheet",
                            type: "text/css",
                            href: font_url
                        });
                        stylesheet.appendTo("head");
                    }


                    if(template == 'template5'){
                        var global_font_family_description = $this.find('.Quiz-Template5-description *').css('font-family');
                        
                    }else{
                        var global_font_family_description = $this.find('.Quiz-Template .question_details .question_description *').css('font-family');
                    }
                    
                    if(global_font_family_description){
                        global_font_family_description = global_font_family_description.replace(/^"(.*)"$/, '$1');
                        if(global_font_family_description != ''){
                            global_font_family_description = global_font_family_description.split(',');
                            global_font_family_description = global_font_family_description[0];
                        }

                        global_font_family_description = global_font_family_description.replace(' ','+');
                        global_font_family_description = global_font_family_description.replaceAll('"','');

                        var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_description;
                        var stylesheet = jQuery("<link>", {
                            rel: "stylesheet",
                            type: "text/css",
                            href: font_url
                        });
                        stylesheet.appendTo("head");
                    }

                    var global_font_family_answer_text = $this.find('.Quiz-Template .question_add_answer_outer_div .sql_ans_text *').css('font-family');
                    if(global_font_family_answer_text){
                        global_font_family_answer_text = global_font_family_answer_text.replace(/^"(.*)"$/, '$1');

                        global_font_family_answer_text = global_font_family_answer_text.replace(' ','+');
                        global_font_family_answer_text = global_font_family_answer_text.replaceAll('"','');
                        if(global_font_family_answer_text != ''){
                            global_font_family_answer_text = global_font_family_answer_text.split(',');
                            global_font_family_answer_text = global_font_family_answer_text[0];
                        }
                        
                        var font_url = 'https://fonts.googleapis.com/css2?family='+global_font_family_answer_text;
                        var stylesheet = jQuery("<link>", {
                            rel: "stylesheet",
                            type: "text/css",
                            href: font_url
                        });
                        stylesheet.appendTo("head");
                    }
                }
                
                
            }
        }

        this.sqbIntlTelInput = function (type = 'question') {

            /* ============================
             * QUESTION PHONE FIELDS
             * ============================ */
            if (type === 'question') {

                $this.find('.question_type_phone_number').each(function () {

                    var question_id = jQuery(this).attr('id');
                    var q_id = jQuery(this).attr('data-question-id');

                    var input = document.querySelector(
                        'body #' + question_id + ' .international-phone-number'
                    );

                    if (!input) return;

                    var default_val = jQuery('#' + question_id + ' .phone_number_text_cls')
                        .attr('data-country');

                    if (!default_val) {
                        default_val = 'us';
                    }

                    iti[q_id] = window.intlTelInput(input, {
                        autoPlaceholder: 'polite',
                        formatOnDisplay: true,
                        hiddenInput: "full_number",
                        preferredCountries: [default_val],
                        utilsScript:
                            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
                    });

                    jQuery(input).on("countrychange", function () {

                        var selectedCountryData = iti[q_id].getSelectedCountryData();
                        if (!selectedCountryData) return;

                        var iso = selectedCountryData.iso2.toLowerCase();

                        var newPlaceholder = intlTelInputUtils.getExampleNumber(
                            iso,
                            true,
                            intlTelInputUtils.numberFormat.INTERNATIONAL
                        );

                        iti[q_id].setNumber("");

                        if (!newPlaceholder) return;

                        // Base mask
                        var mask = newPlaceholder.replace(/[0-9]/g, "0");

                        // 🇮🇩 Indonesia & 🇩🇪 Germany → variable length
                        if (iso === 'id' || iso === 'de') {
                            mask = mask + ' 99999';
                        }

                        jQuery(this).unmask();

                        jQuery(this).mask(mask, {
                            placeholder: newPlaceholder,
                            clearIfNotMatch: false,
                            translation: {
                                '0': { pattern: /[0-9]/ },
                                '9': { pattern: /[0-9]/, optional: true }
                            }
                        });

                        // 🔥 prevent truncation
                        jQuery(this).removeAttr('maxlength');
                        jQuery(this).attr('placeholder', newPlaceholder);
                    });

                    iti[q_id].promise.then(function () {
                        jQuery(input).trigger("countrychange");
                    });

                });

                return;
            }

            /* ============================
             * DIRECT SIGNUP PHONE FIELD
             * ============================ */
            jQuery('#sqb_direct_signup input').each(function () {

                if (jQuery(this).attr('data-field-type') !== 'phone_number') return;

                var selected_country = jQuery(this).attr('data-selected-country');
                if (!selected_country) {
                    selected_country = 'us';
                }

                var phone_field_name = jQuery(this).attr('data-field-type');
                var phoneInputID = ".custom-phone-number";
                var input = document.querySelector(phoneInputID);
                if (!input) return;

                if (!jQuery('#custom_' + phone_field_name + '_country_code').length) {
                    jQuery(input).after(
                        '<input type="hidden" name="custom_' + phone_field_name +
                        '_country_code" id="custom_' + phone_field_name +
                        '_country_code" value="">'
                    );
                }

                itis = window.intlTelInput(input, {
                    autoPlaceholder: 'polite',
                    formatOnDisplay: true,
                    hiddenInput: "full_number",
                    preferredCountries: [selected_country],
                    utilsScript:
                        "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
                });

                jQuery(input).on("countrychange", function () {

                    var selectedCountryData = itis.getSelectedCountryData();
                    if (!selectedCountryData) return;

                    var iso = selectedCountryData.iso2.toLowerCase();

                    var newPlaceholder = intlTelInputUtils.getExampleNumber(
                        iso,
                        true,
                        intlTelInputUtils.numberFormat.INTERNATIONAL
                    );

                    itis.setNumber("");

                    if (!newPlaceholder) return;

                    var mask = newPlaceholder.replace(/[0-9]/g, "0");

                    // 🇮🇩 Indonesia & 🇩🇪 Germany
                    if (iso === 'id' || iso === 'de') {
                        mask = mask + ' 99999';
                    }

                    jQuery(this).unmask();

                    jQuery(this).mask(mask, {
                        placeholder: newPlaceholder,
                        clearIfNotMatch: false,
                        translation: {
                            '0': { pattern: /[0-9]/ },
                            '9': { pattern: /[0-9]/, optional: true }
                        }
                    });

                    jQuery(this).removeAttr('maxlength');
                    jQuery(this).attr('placeholder', newPlaceholder);

                    var country_code = '+' + selectedCountryData.dialCode;
                    jQuery('#custom_' + phone_field_name + '_country_code')
                        .val(country_code);
                });

                itis.promise.then(function () {
                    jQuery(input).trigger("countrychange");
                });

            });
        };


        this.sqbIntlTelInput_dep = function(type = 'question'){
            if(type == 'question'){
                $this.find('.question_type_phone_number').each(function(){
                    var question_id = jQuery(this).attr('id');
                    var q_id = jQuery(this).attr('data-question-id');
                    var input = document.querySelector('body #'+question_id+' .international-phone-number');
                    var default_val = jQuery('#'+question_id+' .phone_number_text_cls').attr('data-country');
                    if(default_val == ''){
                        default_val = 'us';
                    }
            
                    iti[q_id] = window.intlTelInput(input, {
                        autoFormat: true,
                        autoPlaceholder : 'polite',
                        formatOnDisplay: true,
                        hiddenInput: "full_number",
                        preferredCountries: [default_val],
                        // separateDialCode: true,
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
                    });
            
                    $this.find('#'+question_id+' .international-phone-number').on("countrychange", function(event) {
                        var question_id = jQuery(this).closest('.question_type_phone_number').attr('data-question-id');
                        var selectedCountryData = iti[q_id].getSelectedCountryData();
                        newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
                        iti[q_id].setNumber("");
                        mask = newPlaceholder.replace(/[1-9]/g, "0");
                        jQuery(this).mask(mask);
                        jQuery(this).attr('placeholder',newPlaceholder);
                    });
                        
                    iti[q_id].promise.then(function() {
                        $this.find('#'+question_id+' .international-phone-number').trigger("countrychange");
                    });
                });
            }else{

                jQuery('#sqb_direct_signup input').each(function(){
                    if(jQuery(this).attr('data-field-type') == 'phone_number'){
                        
                        var selected_country = jQuery(this).attr('data-selected-country');
                        if (typeof selected_country === 'undefined' || selected_country === null || selected_country === '') {
                            selected_country = 'us';
                        }

                        var phoneInput = jQuery('input[data-field-type="'+jQuery(this).attr('data-field-type')+'"]');
                        
                        var phone_field_name = jQuery(this).attr('data-field-type');
                        if (phoneInput.length > 0) {
                            phoneInput.after('<div class="cfields-hidden-wrapper"><input type="hidden" name="custom_'+jQuery(this).attr('data-field-type')+'_country_code'+'" id="custom_'+jQuery(this).attr('data-field-type')+'_country_code'+'" value=""></div>');
                        }


                        var phoneInputID = ".custom-phone-number";            
                        var input = document.querySelector(phoneInputID);
                        itis = window.intlTelInput(input, {
                            autoFormat: true,
                            autoPlaceholder : 'polite',
                            formatOnDisplay: true,
                            hiddenInput: "full_number",
                            preferredCountries: [selected_country],
                            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
                        });
            
            
            
                        jQuery(phoneInputID).on("countrychange", function(event) {
            
                        var selectedCountryData = itis.getSelectedCountryData();
                        newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
            
                        itis.setNumber("");
                            mask = newPlaceholder.replace(/[1-9]/g, "0");
                            jQuery(this).mask(mask);
                            jQuery(this).attr('placeholder',newPlaceholder);

                            var country_code = jQuery('#sqb_direct_signup').find(".iti__country.iti__active .iti__dial-code").html();
                            
                            if(country_code == '' || country_code == undefined){

                                var country_code = '+'+itis.getSelectedCountryData().dialCode;

                            }

                            jQuery('#custom_'+phone_field_name+'_country_code').val(country_code);

                        });
                        
                        

                        itis.promise.then(function() {
                            jQuery(phoneInputID).trigger("countrychange");
                        }); 
                    }
                });
            }

        }
        
        

        this.printSelectedAnswers = function(){
            //$this.find('.ans_in_resultpage_outer').remove(); 
            var ques_ans_html = '';
            var i = 1;
            var sqb_outcome_screen_question = $this.find('#sqb_outcome_screen_question').val();
            var sqb_outcome_screen_answer = $this.find('#sqb_outcome_screen_answer').val();
            if(outcome_anslist.length){
                ques_ans_html += '<div class="outcome-printselected-answer">';
                jQuery.each( outcome_anslist, function( key, el ) {
                    var question_title = el['question_title'];
                    var sqb_correct_ans_text = el['answer_text'];

                    sqb_correct_ans_text = sqb_correct_ans_text.replaceAll(", <br>",'<br>');
                    var type = el['type'];
                    ques_ans_html += '<div class="ans_in_resultpage sa-type-'+type+'">';
                    ques_ans_html += '<div class="sqb-question-heading"><strong>'+sqb_outcome_screen_question+': </strong> '+question_title+'</div>';
                     
                     if(type == "matrix"){
                         ques_ans_html += '<div class="sqb-question-content">'+sqb_correct_ans_text+'</div>';
                     }else{
                        ques_ans_html += '<div class="sqb-question-content"><strong>'+sqb_outcome_screen_answer+': </strong> '+sqb_correct_ans_text+'</div>';
                     }
                   
                    ques_ans_html += '</div>';
                    ques_ans_html += '<hr class="hr-hide" style="margin-top:10px;margin-bottom:10px;">';
                });
                ques_ans_html += '</div>';
            }
            return ques_ans_html;
        }
        this.printAnswerResults = function(){
            $this.find('.ans_in_resultpage_outer').remove(); 
            var ques_ans_html = '';
            var i = 1;
            if(outcome_anslist.length){
                jQuery.each( outcome_anslist, function( key, el ) {

                    var classname = '';
                    var status = el['status'];
                    var type = el['type'];
                    var question_title = el['question_title'];
                    var outcome_screen_answer = el['answer_text_exp'];
                    var outcome_screen_result = el['answer_sel_exp'];
                    var outcome_screen_correct_answer = el['correct_ans_exp'];
                    var outcome_screen_incorrect_answer = el['incorrect_ans_exp'];
                    var incorrect_answer_msg_exp = el['incorrect_ans_msg'];
                    var correct_answer_msg_exp = el['correct_ans_msg'];
                    var sqb_correct_ans_text = el['answer_text'];
                    var data_correct_value = el['correct_answer'];
                    var data_correct_answer_value = $this.find('#sqb_outcome_screen_correct_answer_field').val();
                    var common_correct_msg = $this.find('#common_correct_msg').val();
                    var sqb_outcome_screen_question = $this.find('#sqb_outcome_screen_question').val();

                    var sqb_incorrect_ans_exp = $this.find('#sqb_incorrect_ans_exp').val();
                    var common_incorrect_msg = $this.find('#common_incorrect_msg').val();
                    
                    var correct_ans_html = '<div class="result_text"><b>'+outcome_screen_result+' </b>'+common_correct_msg+'</div>';
                    if(jQuery.inArray( el['question_id'], skipped_question ) > -1){
                        ques_ans_html += '<div class="ans_in_resultpage freetext_div_ans_div"><div class="question_cls"><b>'+sqb_outcome_screen_question+' '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">Skipped</div></div></div>';
                    }else{
                    
                        if(type == 'text' || type == 'slider'){
                            ques_ans_html += '<div class="ans_in_resultpage freetext_div_ans_div"><div class="question_cls"><b>'+sqb_outcome_screen_question+' '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><br><div class="ans_text">'+sqb_correct_ans_text+'</div></div></div>';
                        }else if(type == 'matrix'){
                            ques_ans_html += '<div class="ans_in_resultpage freetext_div_ans_div"><div class="question_cls"><b>'+sqb_outcome_screen_question+' '+i+':</b>'+question_title+'</div><div class="answer_cls tgtgt"><br><div class="ans_text">'+sqb_correct_ans_text+'</div></div></div>';
                        }else if(status == 'correct'){
                            ques_ans_html += '<div class="ans_in_resultpage '+status+'_ans_div"><div class="question_cls"><b>'+sqb_outcome_screen_question+' '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div>'+correct_ans_html+'</div>';

                            if(correct_answer_msg_exp != ''){
                                ques_ans_html += '<div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_correct_answer+'</b><div clas="ans_text">'+correct_answer_msg_exp+'</div></div>';
                            }
                            ques_ans_html += '</div>';
                        }else{
                            ques_ans_html += '<div class="ans_in_resultpage '+status+'_ans_div"><div class="question_cls"><b>'+sqb_outcome_screen_question+' '+i+':</b>'+question_title+'</div><div class="answer_cls"><b>'+outcome_screen_answer+' </b><div class="ans_text">'+sqb_correct_ans_text+'</div><div class="answer_cls"><b>'+outcome_screen_correct_answer+' </b><div clas="ans_text">'+data_correct_value+'</div></div><div class="result_text"><b>'+outcome_screen_result+' </b>'+common_incorrect_msg+'</div></div>';
                            if(incorrect_answer_msg_exp != ''){
                                ques_ans_html += '<div class="incorrect_answer_exp_cls answer_cls"><b>'+outcome_screen_incorrect_answer+'</b><div clas="ans_text">'+incorrect_answer_msg_exp+'</div></div>';
                            }
                             ques_ans_html += '</div>';
                            
                        }
                    }
                    i++;

                });

                $this.find('.quiz_result_template_outer #result_temp_btnid').before('<div class="ans_in_resultpage_outer">'+ques_ans_html+'</div>');    
                $this.find('.quiz_result_template_outer1 #result_temp_btnid').before('<div class="ans_in_resultpage_outer">'+ques_ans_html+'</div>');
            }
        }

        this.showQuesAnsResults = function($question){

            if(enable_branching_quiz){
                if( $question.find('.sqb_ans_selected').length == 0){   
                    return true;
                }
            }

            var data = {};
            var question_title = $question.find(".question_title").text();  
            var sqb_correct_ans_text = $question.find(".correct_ans_cls .sql_ans_text").text();                      
            var sqb_selected_ans_text = $question.find(".sqb_ans_selected .sql_ans_text").text();                        
            var sqb_ans_correct_cls = $question.find(".sqb_ans_item_outer").hasClass("correct_ans_cls");                         
            var sqb_ans_selected_cls = $question.find(".sqb_ans_item_outer.correct_ans_cls").hasClass("sqb_ans_selected");
            var outcome_screen_answer = $this.find('#sqb_outcome_screen_answer_field').val();
            var outcome_screen_result = $this.find('#sqb_outcome_screen_result_field').val();
            var outcome_screen_correct_answer = $this.find('#sqb_outcome_screen_correct_answer_field').val();
            var outcome_screen_incorrect_answer = $this.find('#sqb_outcome_screen_incorrect_answer_field').val();
            
            var correct_answer_msg = $question.find('.correct_answer_msg').val(); 
            var incorrect_answer_msg = $question.find('.incorrect_answer_msg').val(); 
            var question_id = $question.attr('data-question-id');

            data['question_title'] = question_title;
            data['question_id'] = question_id;
            data['answer_text_exp'] = outcome_screen_answer;
            data['answer_sel_exp'] = outcome_screen_result;
            data['correct_ans_exp'] = outcome_screen_correct_answer;
            data['incorrect_ans_exp'] = outcome_screen_incorrect_answer;
            data['incorrect_ans_msg'] = incorrect_answer_msg;
            data['correct_ans_msg'] = correct_answer_msg;
            data['correct_answer'] = '';

            if(this.isQuestionType('text_cls',$question) || this.isQuestionType('date_cls',$question) || this.isQuestionType('phone_number_text_cls',$question) || this.isQuestionType('email_cls',$question) || this.isQuestionType('name_cls',$question) || this.isQuestionType('fill_in_blank_cls',$question) || this.isQuestionType('dropdown',$question)){
                data['answer_text'] = $question.find(".sqb_input_ans_field").val();
                data['class'] = 'freetext_div';
                data['type'] = 'text';

            }else if(this.isQuestionType('numeric_text_cls',$question)){
                data['answer_text'] = $question.find('.sqb_and_field').val();
                data['class'] = 'freetext_div';
                data['type'] = 'numeric';
                var data_correct_value = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
                var input_text_num = $question.find(".sqb_ans_item_outer .sqb_and_field").val();
                if(input_text_num == data_correct_value){
                    data['status'] = 'correct';
                }else{
                    data['status'] = 'incorrect';
                }

            }else if(this.isQuestionType('slider_cls',$question)){
                data['answer_text'] = $question.find('.sqb_ans_slider').attr("data-value");
                data['class'] = 'freetext_div';
                data['type'] = 'slider';
            }else if(this.isQuestionType('matching_text',$question)){
                var mhtml = $question.find(".sqb_input_ans_field").html();
                var div = document.createElement("div");
                div.innerHTML = mhtml;
                data['answer_text'] = div.textContent || div.innerText || "";
                data['class'] = 'freetext_div';
                data['type'] = 'matching';
                var data_correct_value = $question.find(".sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
                var input_text_num = $question.find(".sqb_ans_item_outer .sqb_and_field").val();
                var invalid =  $question.find(".sqb_ans_item_outer .sqb_and_field .sentence-not-matched").length;

                if(invalid < 1){
                    data['status'] = 'correct';
                }else{
                    data['status'] = 'incorrect';
                }


            }else if(this.isQuestionType('matrix_cls',$question)){
                /*$question.find(".matrix_cls .checkbox_fe").each(function(){
                    if(jQuery(this).prop('checked') == true){
                        sqb_correct_ans_text += jQuery(this).attr('data-assigned-value');   
                        sqb_correct_ans_text += ", ";
                    }
                });*/

                $question.find(".matrix_cls").each(function(){
                    var title= jQuery(this).find('.sql_ans_text').html();
                    sqb_correct_ans_text += '<div class="matrix-label">'+title;
                    jQuery(this).find('.checkbox_fe').each(function(){
                        if(jQuery(this).prop('checked') == true){   
                            var count = jQuery(this).val();
                            var count_val = parseInt(count)+1;
                            var label = jQuery('.SQB-main-table tr th:eq('+count_val+')').find(".matrix_label_text").text();
                            sqb_correct_ans_text += '<br><strong>Answer : '+label+'</strong></div><br>';
                        }
                    });
                });

                data['answer_text'] = sqb_correct_ans_text;
                data['class'] = 'freetext_div';
                data['type'] = 'matrix';

            }else if(this.isQuestionType('file_upload_cls',$question)){
                var sqb_item = jQuery(this).find(".sqb_file_upload").val();
                data['class'] = 'freetext_div';
                data['type'] = 'file';
                if(sqb_item !="")
                    data['answer_text'] = sqb_item.split("\\").pop();
                else
                    data['answer_text'] = '';

            }else if(this.isQuestionType('multiple_cls',$question)){
                data['answer_text'] = jQuery(this).find(".correct_ans_cls .sql_ans_text").text();
                data['class'] = 'freetext_div';
                data['type'] = 'multiple';
                var hascorrect_count = $question.find(".sqb_ans_item_outer.correct_ans_cls").length;
                var hascorrect_checkbox_count =  $question.find(".sqb_ans_item_outer.correct_ans_cls .checkbox_fe:checked").length;
                var total_checked =  $question.find(".sqb_ans_item_outer .checkbox_fe:checked").length;

                var ansid_text = [];
                var sqb_loop_v_i = 1;
                $question.find(".sqb_ans_item_outer .checkbox_fe:checked ").each(function(){
                    ansid_text.push(sqb_loop_v_i+') '+jQuery(this).closest(".multiple_correct_checkbox").find(".sql_ans_text").text());
                        sqb_loop_v_i++;  
                });
                data['answer_text'] = ansid_text.join(", <br>");
                if(hascorrect_count == hascorrect_checkbox_count && total_checked == hascorrect_checkbox_count){
                    var sqb_loop_v_i = 1;
                    var ansid_correcttext = [];
                    $question.find(".sqb_ans_item_outer .sqb_ans_item_outer.correct_ans_cls").each(function(){                
                        ansid_correcttext.push(sqb_loop_v_i+') '+jQuery(this).closest(".multiple_correct_checkbox").find(".sql_ans_text").text());
                         sqb_loop_v_i++;
                    });

                    data['correct_answer'] = ansid_correcttext.join(", <br>");
                    data['status'] = 'correct';
                }else{
                    data['status'] = 'incorrect';
                }
                
            }else{

                data['type'] = 'general';
                
                if(sqb_ans_correct_cls == sqb_ans_selected_cls){
                    data['status'] = 'correct';
                }else{
                    data['status'] = 'incorrect';
                }
                data['answer_text'] = $question.find(".sqb_ans_selected .sql_ans_text").text();
                data['correct_answer'] = $question.find(".correct_ans_cls .sql_ans_text").text();   
                data['class'] = 'freetext_div';
            }

            var quesIndex = findIndexByProperty(outcome_anslist, 'question_id', question_id);
            if (quesIndex > -1) {
                outcome_anslist[quesIndex] = data;
            } else {
                outcome_anslist.push(data);
            }
            //outcome_anslist.push(data);
        }

        this.pollChart = function(chart_data){

            const labels = chart_data['label'];

            chart_type = '';
            if(chart_data.type == 'bar_chart'){
                chart_type = 'bar';
            }else if(chart_data.type == 'pie_chart'){
                chart_type = 'pie';
            }else{
                return false;
            }

            const data = {
                labels: labels,
                datasets: [{
                axis: 'y',
                label: '',
                backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                data: chart_data['data'],
                }]
            };

            const config = {
                type: chart_type,
                data: data,
                options: {
                    indexAxis: 'y',
                    legend: {
                        display: false
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    tooltips: {
                        callbacks: {
                        label: function(tooltipItem) {

                            return tooltipItem.yLabel;
                        }
                    }
                    }
                }
            };

            var $chtml = $this.find('#outcome_id_'+final_outcome+'');
            $chtml.html($chtml.html().replace('[ShowPollResults]', '<h3>'+chart_data.question+'</h3><div><canvas id="poll_chart" width="400" height="150"></canvas></div>'));

            if(jQuery('#poll_chart').length > 0){
        
                const myChart = new Chart(
                document.getElementById('poll_chart').getContext('2d'),
                config
                );
            }

            $this.find('.quiz_result_template_outer .outcome_div .ShowPollResultsChart').addClass(chart_data.type);
            $this.find('.quiz_result_template_outer .outcome_div .ShowPollResultsChart').addClass('show_cls').removeClass('hide_cls');
        }

        this.dapEnableDetail = function(sqb_quiz_container_outer_id, notcount=''){
     
            jQuery('#'+sqb_quiz_container_outer_id+ ' .buttondata_outer.multiple_ques_true .dap_see_details_btn').removeClass('btn_disabled');
            if(notcount =="notcount"){
                jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').trigger("click");     
                jQuery('.lesson_container_outer .quiz_quesans_template_outer .single_next_btn  ').addClass("btn_disabled");
            }else{
                if(quiz_pagination != "all"){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .dap_see_details_btn ').trigger("click");     
                }
            } 
            
            var dap_login_email_id = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_email_id').val();
            if(dap_login_email_id != undefined){
              var dap_login_first_name = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_first_name').val();
              //sqbUserSendMail(sqb_quiz_container_outer_id, dap_login_first_name , dap_login_email_id , '')
            }
            
            //time spent
            var timer_enable = jQuery('#'+sqb_quiz_container_outer_id).find('#timer_enable').val();
            if(timer_enable =="Y"){
                gettimer_spent(sqb_quiz_container_outer_id, notcount);
                var sqb_counter_outer_data1 = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_counter_outer ').html();
                var sqb_counter_outer_data = '<div class="sqb_counter_outer1">'+sqb_counter_outer_data1+'</div>';
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer  .sqb_counter_expired_msg').hide();  
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .quiz_timer_spent_msg').hide();  
                  
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .points_scored_result').before(sqb_counter_outer_data);  
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .result_temp_outer   .quiz_timer_html_data').hide(); 
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .result_temp_outer   .quiz_timer_spent_msg').show(); 
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .result_temp_outer   .quiz_timer_spent_msg').show(); 
            }
            if(notcount =="notcount"){  
                jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer .result_temp_outer  .sqb_counter_expired_msg').show();   
                
            }else{
                // last question click
                var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
                
                var sqb_quiz_current_page_id =jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
                //sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_last_question_btn_click');
            }
        }

        this.unlockMarkAsComplete = function(){
            var showquiz = false; 
            var quiz_blocking = $this.find('#quiz_blocking').val();
            var quiz_passmark =$this.find('#quiz_passmark').val();
            var pass_criteria =$this.find('#pass_criteria').val();
            var sqb_quiz_type =$this.find('#sqb_quiz_type').val();
            if(quiz_blocking == "Y"){
                if(pass_criteria == "pass"){
                    
                    if(sqb_quiz_type == "assessment" || sqb_quiz_type == "scoring" ){
                        if(sqb_quiz_type == "assessment"){
                            var sqb_correct_ans = $this.find('#sqb_correct_ans').val();
                            var total_ques = $this.find('#ques_count').val();    
                            var final_val = parseFloat(parseInt(sqb_correct_ans, 10) * 100) / parseInt(total_ques, 10);                  
                        }
                        if(sqb_quiz_type == "scoring"){
                            var sqb_points_ans = $this.find('#sqb_points_ans').val();
                            var points_count = $this.find('#points_count').val();
                            var final_val = parseFloat(parseInt(sqb_points_ans, 10) * 100) / parseInt(points_count, 10);
                        }
                        var gotmarks_percentage = (Math.round(final_val * 100) / 100).toFixed(0);
                        if(parseInt(quiz_passmark) <= parseInt(gotmarks_percentage)){                
                            var showquiz = true;
                        }else{
                            var showquiz = false;
                        }
                    }else{ //else    pass_criteria
                        var showquiz = true;    
                    }
                }else{   //else  pass_criteria
                    var showquiz = true;
                }
            }else{  //else   quiz_blocking
                var showquiz = true;
            } 
             
            if(showquiz == true){
                jQuery(".markas_completed_btn").removeClass('disableMarkBtn');
                jQuery(".dap-btn-mark-as-complate").removeClass('disableMarkBtn');
                
            }else{
                jQuery(".not_passed_quiz_msg_outer").remove();
                jQuery(".markas_completed_btn").addClass('disableMarkBtn');
                jQuery(".dap-btn-mark-as-complate").addClass('disableMarkBtn');
                var markedAsCompleted = jQuery(".markedAsCompleted").val();
                if(markedAsCompleted != 'Y'){
                    var not_passed_quiz_msg = $this.find('#not_passed_quiz_msg').val();         
                    $quesans_outer.find(".Quiz-Template-overflow").after('<div class="not_passed_quiz_msg_outer" style="display: inline-block;">'+not_passed_quiz_msg+'</div>');
                }
            }
        }

        this.changeVote = function(){
            var sqb_quiz_container_outer_id = $this.attr('id');
            if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
                jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
            }else{
                jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
            }
            var ajaxurl = jQuery('#sqb_ajaxurl').val();
            jQuery.post(ajaxurl, {
                    action: 'sqb_change_vote',
                    quiz_id: quiz_id,
            
            }, function(response) {
                jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
                    jQuery(this).remove();  
                });
                if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
                }

                jQuery('#'+sqb_quiz_container_outer_id+ ' .vote_thank-you').addClass('hide_cls').removeClass('show_cls');
                response = JSON.parse(response);
                if(response.status == 'ok'){

                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').hide();
                    var count_vote = response.count_vote;
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote-count').html(count_vote);
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('show_cls').removeClass('hide_cls');
                    $_self.setQuestionScreen(sqb_quiz_container_outer_id);

                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('hide_cls').removeClass('show_cls');
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('sqb-btn-disable');

                    if(jQuery('#'+sqb_quiz_container_outer_id+ ' .js-is-poll-view-result').val() == 'Y'){
                        jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('show_cls').removeClass('hide_cls');
                    }
                    
                }else{

                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').show();
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').html(response.message);
                }
            });
        }

        this.renderPollResults = function() {

            var sqb_quiz_container_outer_id = $this.attr('id');
            var json = jQuery('#'+sqb_quiz_container_outer_id+' .js-vote-list').val();
            var is_voted = jQuery('#'+sqb_quiz_container_outer_id+' .js-is-vote').val();
            var thankyou = jQuery('#'+sqb_quiz_container_outer_id+' .js-thankyou').val();
            var data = JSON.parse(decodeURIComponent(json).replace(/\+/g, " "));
            if(is_voted > 0){   
                this.setResultScreen(sqb_quiz_container_outer_id,data,thankyou);
            }
        }

        this.setQuestionScreen = function(sqb_quiz_container_outer_id){
            jQuery('#'+sqb_quiz_container_outer_id+' .quiz_type_poll .poll-quiz-main').removeClass('quiz_poll_results');
            jQuery('#'+sqb_quiz_container_outer_id+' .vote-data-element').remove();
        }
        this.backToPoll = function(){
            var sqb_quiz_container_outer_id = $this.attr('id');
            //jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('show_cls').removeClass('hide_cls');
            jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('show_cls').removeClass('hide_cls');
            jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-return-poll').addClass('hide_cls').removeClass('show_cls');

            this.setQuestionScreen(sqb_quiz_container_outer_id);
        }
        this.viewVoteResult = function(){
            var sqb_quiz_container_outer_id = $this.attr('id');
            if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
                }
            var sqb_quiz_id = jQuery('#'+sqb_quiz_container_outer_id+  ' input#quiz_id').val();
            var ajaxurl = jQuery('#sqb_ajaxurl').val();
            jQuery.post(ajaxurl, {
                    action: 'sqb_view_result_poll',
                    quiz_id: sqb_quiz_id,
            
            }, function(response) {
                if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
                }else{
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
                }

                response = JSON.parse(response);
                var html = response.html;
                var count_vote = response.count_vote;

                if(response.status == 'ok'){    
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('hide_cls').removeClass('show_cls');
                    $_self.setResultScreen(sqb_quiz_container_outer_id,response.counts,'');
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-return-poll').addClass('show_cls').removeClass('hide_cls');
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote-count').html(count_vote);
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-view-result').addClass('hide_cls').removeClass('show_cls');
                }
            });
        }

        this.getSelectedAnswer = function(ques_id,answer_id){
           
            var fill_in_blank_cls =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls');
                var text_cls =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('text_cls'); 
                var date_cls =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('date_cls'); 
                var slider_cls =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('slider_cls'); 
                var matching_text =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matching_text'); 
                var file_upload_cls =  $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls');
                var numeric_text_cls = $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
                var dropdown_cls = $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('dropdown_cls');
                var phone_number_text_cls = $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('phone_number_text_cls');
                var weight_and_height_cls = $this.find("#question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('weight_and_height_cls');
                if(fill_in_blank_cls ==true){
                    var answer_text =  $this.find("#question_id_"+ques_id+" .sqb_fill_in_blank_ans_field").val();                       
                }else if(text_cls ==true){
                    var answer_text =  $this.find("#question_id_"+ques_id+" .sqb_textarea_ans_field").val();
                }else if(date_cls ==true){
                    var answer_text =  $this.find("#question_id_"+ques_id+" .date-question-type").val();    
                }else if(phone_number_text_cls == true){
                    var country_code =  $this.find("#question_id_"+ques_id).find(".iti__country.iti__active .iti__dial-code").html();
                    var answer_text =  $this.find("#question_id_"+ques_id).find(".sqb_and_field").val();
                    if(answer_text != ''){
                        answer_text =  country_code+' '+answer_text;
                    }else{
                        answer_text = '';
                    }
                }else if(matching_text == true){
                    var html = $this.find("#question_id_"+ques_id).find('.sqb_input_ans_field').html();
                    var answer_text = html; 
                    answer_type = 'matching_text';
                    answer_points_scored = calculate_match_points($this.find("#question_id_"+ques_id));
                }else if(slider_cls ==true){
                    var slider_value =  $this.find("#question_id_"+ques_id).find(".slider.sqb_ans_slider").val();
                    var prefix_text =  $this.find("#question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('prefix_text');  
                    var suffix_text =  $this.find("#question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('suffix_text');  
                    var answer_text = prefix_text+' '+slider_value+' '+suffix_text; 
                }else if(numeric_text_cls == true){
                    var prefix_text =  $this.find("#question_id_"+ques_id).find(".numeric_value_prefix").text();    
                    var suffix_text =  $this.find("#question_id_"+ques_id).find(".numeric_value_sufix").text(); 
                    var numeric_value =  $this.find("#question_id_"+ques_id).find(".sqb_and_field").val();
                    var pretext = '';
                    if (typeof sqb_quiz_id !== "undefined") {
                        pretext = prefix_text;
                    }
                    var suftext = '';
                    if (typeof sqb_quiz_id !== "undefined") {
                        suftext = suffix_text;
                    }
                    var answer_text = pretext+''+numeric_value+''+suftext;
                }else if(weight_and_height_cls == true){
                    var answer_text =  this.getHeightWeightValues($this.find("#question_id_"+ques_id),false);
                }else if(file_upload_cls == true){
                    var fileURl =  $this.find("#question_id_"+ques_id).find(".sqb_file_upload").data('fileurl');
                    var answer_text = fileURl;
                }else if(dropdown_cls == true){
                    var selected_answer_text =  $this.find("#question_id_"+ques_id+" .sqb_ans_selected .sqb_question_dropdown").val();
                    var answer_text = selected_answer_text.split('_').join(' ');
                }else{
                    var answer_text =  $this.find("#question_id_"+ques_id+" .sqb_ans_selected .sql_ans_text").text();
                    var multiple_or_single =  $this.find("#question_id_"+ques_id).hasClass('multiple_correct_cls');
                     if(multiple_or_single){
                         answer_type ="multiple";
                          var answer_points_scored_new  = 0;
                          var answer_tags_new = '';
                          $this.find("#question_id_"+ques_id+" .sqb_and_field.checkbox_fe").each(function(){
                                if(jQuery(this).prop('checked')){
                                    var answer_tags_new = jQuery(this).closest('.multiple_correct_checkbox').attr('data-answer-tags');
                                
                                    answer_tags = answer_tags+answer_tags_new+',';
                                    
                                    var answer_points_scored_new = $this.find("#question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
                                    answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
                                }
                          });
                         
                     }else{
                        answer_type = 'single';
                        answer_tags = $this.find("#question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-tags');
                        //other_field = $this.find("#question_id_"+ques_id).find('.custom-other-box').val();
    
                        if(answer_id == $this.find("#question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-id')){
                            other_field = $this.find("#question_id_"+ques_id+".question_type_single").find('.custom-other-box').val();
                        }else{
                            other_field = '';
                        }
                        answer_points_scored = $this.find("#question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
                     }
                }
            return answer_text;
        }

        this.getShareDynamicParams = function(outcome_id){
            var SQBPreview = jQuery('#SQBPreview').val();
            if(SQBPreview =="Y"){
                return false;
            }

            if(this.isQuiz('assessment')){
                var variable1 = $this.find('#ques_count').val();
                var variable2 = jQuery('#sqb_correct_ans').val();
            }else if(this.isQuiz('scoring')){
                var variable1 = $this.find('#points_count').val();
                var variable2 = jQuery('#sqb_points_ans').val();
            }else{
                var variable1 = 0;
                var variable2 = 0;
            }
            var sqb_ajaxurl = jQuery('#sqb_ajaxurl').val();
            jQuery.post(sqb_ajaxurl, {  
                action: 'sqb_generate_share_variable_dynamic',
                quiz_id: quiz_id,
                quiz_type: quiz_type,
                outcome_id: outcome_id,
                variable1: variable1,
                variable2: variable2,
            }, function(response){
                response = JSON.parse(response);
                if(response.success){
                    $this.find('#share_paremets_quiz').val(response.share_paremets);
                    $this.find('#tw_share_description').val(response.tw_share_description);
                }
            });
        }

        this.shareFacebook = function(){
            
            var sqb_quiz_container_outer_id = $this.attr('id');
            var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val(); 
            
            var social_share_fb_api_key =jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_fb_api_key').val();
            if(social_share_fb_api_key == ''){
                alert("Facebook APP key is missing.");
                return false;
            }
            var outcome_final = final_outcome;
            
            var url_data = jQuery('#share_params_'+outcome_final).val();
            
            var sqb_plugns_folder_url = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_share_url_generate').val();
            if (sqb_plugns_folder_url.indexOf("http://") == 0 || sqb_plugns_folder_url.indexOf("https://") == 0) {
            }else{
                sqb_plugns_folder_url = jQuery('#'+sqb_quiz_container_outer_id+ ' #get_home_url').val()+sqb_plugns_folder_url; 
            }
            var sqb_share_url_generate = sqb_plugns_folder_url+url_data;
            
            var sqb_quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
            if(sqb_quiz_type == 'assessment'){
                var total_ques = jQuery('#'+sqb_quiz_container_outer_id+ ' #ques_count').val();
                var sqb_correct_ans =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_correct_ans').val();                
                sqb_share_url_generate += '|||'+total_ques+'|||'+sqb_correct_ans+'|||'+Math.floor(Math.random() * 10000);
            }else if(sqb_quiz_type == 'scoring'){
                var total_pt= 0;
                var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val();                 
                var sqb_points_ans =  jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();                
                sqb_share_url_generate += '|||'+total_pt+'|||'+sqb_points_ans+'|||'+Math.floor(Math.random() * 10000);
            }
                 
            FB.ui({
                method: "share",
                href:sqb_share_url_generate,
                },  function(response){
                    if ((typeof(response) == "undefined") || (response === null) || (typeof(response.error_code) != "undefined" && response.error_code != "")) {
                    } else {
                        var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+' #social_share_screen_value').val();
                        var response_type = Array.isArray(response);
                        if(response_type){
                            var fb_share_thank_you_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' input#fb_share_thank_you_msg').val();
                            if(social_share_screen_value == 'Y'){
                                jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_next_btn').removeClass('disable_social_share_next_btn');//enable next button
                                jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_message').text(fb_share_thank_you_msg).addClass('sqbShareSuccess');
                            } else {
                                jQuery('#'+sqb_quiz_container_outer_id+ ' .customize_social_share_wrapper label').text(fb_share_thank_you_msg);
                            }
                        } else {
                            if(social_share_screen_value == 'Y'){
                            var fb_share_error_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' input#fb_share_error_msg').val();
                            jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_message').text(fb_share_error_msg).addClass('sqbSharefailed');
                            }
                        }
                    }
                }
            );
        }

        this.shareTwitter = function(){
            var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
            var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val(); 
            
            var outcome_id = jQuery(this).closest('.outcome_div').find('input[name="outcome_id"]').val();
            var sqb_twitter_url = 'https://twitter.com/intent/tweet?text='+jQuery('#tw_share_description').val()+'&url=';
            var url_data =  jQuery("#"+sqb_quiz_container_outer_id+  " input[name='share_paremets_quiz']").val();
            
            var sqb_share_url_generate =  jQuery('#'+sqb_quiz_container_outer_id+ ' input[name="sqb_social_share_url"]').val()+'?sqbtw='+url_data;;
            
            sqb_share_url_generate += '&'+Math.floor(Math.random() * 10000);
            var sqb_share_url_generate = sqb_twitter_url+encodeURIComponent(sqb_share_url_generate);
            // Load the SDK Asynchronously
            this.sqb_twitter_share(sqb_share_url_generate,sqb_quiz_container_outer_id);
        }

        this.sqb_twitter_share = function(share_url = '',sqb_quiz_container_outer_id){
            sqb_child_window = window.open(share_url, 'twitter', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
            sqb_tw_timer = setInterval(function() { $_self.sqbTwCheckChild(sqb_quiz_container_outer_id); }, 1000);
        }

        this.sqbTwCheckChild = function(sqb_quiz_container_outer_id) {
            if (sqb_child_window.closed) {
                //var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
                var fb_share_thank_you_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' input#fb_share_thank_you_msg').val();
                var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+' #social_share_screen_value').val();
                if(social_share_screen_value == 'Y'){
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_message').text(fb_share_thank_you_msg).addClass('sqbShareSuccess');
                } else {
                    jQuery('#'+sqb_quiz_container_outer_id+ ' .customize_social_share_wrapper label').text(fb_share_thank_you_msg);
                }
                
                jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_social_share_next_btn').removeClass('disable_social_share_next_btn'); 
                clearInterval(sqb_tw_timer);
            }
        }

        this.sqbQuizCertificatePdf = function(){

            var pdf_downloadingText = 'Please Wait..';
            var orig_text = $this.find('.download_certificate_button  div').html();
            $this.find('.download_certificate_button  div').html(pdf_downloadingText);
            $this.find('.download_certificate_button').addClass('downloading-pdf');
            var user_id =  $this.find('#user_id').val();
            var formdata = [];
            formdata.push({name: "quiz_id", value: quiz_id});
            formdata.push({name: "outcome_id", value: final_outcome});
            formdata.push({name: "lead_id", value: lead_id});

            jQuery.ajax({
                type: "POST",
                url: '?sqb_cert_pdf_download=1',
                data: formdata,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(blob, status, xhr) {
                    $this.find('.download_certificate_button  div').html(orig_text);
                    $this.find('.download_certificate_button').removeClass('downloading-pdf');
                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);
                        if (filename) {
                            var a = document.createElement("a");
                            if (typeof a.download === 'undefined') {
                                window.location.href = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.click();
                            }
                        } else {
                            window.location.href = downloadUrl;
                        }
                        setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100);
                    }
                    
                }
            });
        }

        this.addThemeSupport = function(){
            
            // Fix the Z-index issue for popup
            if($this.closest('.tve-page-section-in').length > 0 && this.isPopup()){
                $this.closest('.tve-page-section-in').addClass('sqb-popup-zindex');
            }

            if($this.closest('.thrv-page-section').length > 0 && this.isPopup()){
                $this.closest('.thrv-page-section').addClass('sqb-popup-zindex');
            }

            if(this.isPopup()){
                jQuery('html').addClass('sqb-popup-zindex');
            }
        }

        this.sqbQuizPdf = function(){

            var tags = this.getOutcomeTags();
            var stringList = JSON.stringify(ques_ans_data);
            stringList = stringList.replaceAll("'",'&lsquo;');
            var downloadText = $this.find('.outcome_button_pdf div').html();
            var pdf_download_success_text = $this.find('#pdf_download_success').val();
            var pdf_downloadingText = $this.find('#pdf_downloading_text').val();
            $this.find('.outcome_button_pdf div').html(pdf_downloadingText);
            $this.find('.outcome_button_pdf').addClass('downloading-pdf');
            $this.find('.outcome_button_pdf').css('downloading-pdf');

            var user_id =  $this.find('#user_id').val();
            var fname =  this.getOptinField('first_name');
            var email =  this.getOptinField('email');
            var category_number_percent  = $this.find('.category_number_percent_co').html();
            var category_only_percent  = $this.find('.category_only_percent').html();
            var category_score_breakdown_inpercent  = $this.find('.category_score_breakdown_inpercent').html();
            var category_number_div= $this.find('#outcome_id_'+final_outcome+' .category_number_div').html();
            var optin_form_fields = $this.find("#sqb_direct_signup").serialize();
            var category_list = $this.find('input[name="category_result_list_json"]').val();

            if($this.find('.outcome_div:visible .Quiz-result-Template5').length  > 0){
                var outcome_content = $this.find('.outcome_div:visible .Quiz-result-Template5 .Quiz-result-Template5-right').html();
            }else{
                var outcome_content = $this.find('.outcome_div:visible .result_temp_outer .Quiz-Template-content').html();
            }

            var canvas_spider_chart = '';
            if(document.getElementById('spiderChartOutcome') !=null){
                canvas_spider_chart = document.getElementById('spiderChartOutcome');
                canvas_spider_chart = canvas_spider_chart.toDataURL();
            }else{
                var canvas_spider_chart = '';
            }
            
            var canvas_bar_chart = '';
            if(document.getElementById('spiderChartOutcome1') !=null){
                
                canvas_bar_chart = document.getElementById('spiderChartOutcome1');
                canvas_bar_chart = canvas_bar_chart.toDataURL();
            }

            var formdata = [];
            formdata.push({name: "quiz_id", value: quiz_id});
            formdata.push({name: "outcome_id", value: final_outcome});
            var stringList = JSON.stringify(ques_ans_data);
            stringList = stringList.replaceAll("'",'&lsquo;');
            formdata.push({name: "sqb_question_answer_array", value: stringList});

            var outcome_anslistString = JSON.stringify(outcome_anslist);
            formdata.push({name: "outcome_anslist", value: outcome_anslistString});

            formdata.push({name: "user_id", value: user_id});
            formdata.push({name: "email", value: email});
            formdata.push({name: "fname", value: fname});
            formdata.push({name: "canvas_spider_chart", value: canvas_spider_chart});
            formdata.push({name: "canvas_bar_chart", value: canvas_bar_chart});
            formdata.push({name: "canvas_question_answer_chart", value: canvas_question_answer_chart});
            formdata.push({name: "chart_heading", value: chart_heading});
            formdata.push({name: "canvas_pie_chart", value: canvas_pie_chart});
            formdata.push({name: "category_number_percent", value: category_number_percent});
            formdata.push({name: "category_only_percent", value: category_only_percent});
            formdata.push({name: "category_score_breakdown_inpercent", value: category_score_breakdown_inpercent});
            formdata.push({name: "optin_form_fields", value: optin_form_fields});
            formdata.push({name: "category_number_div", value: category_number_div});
            formdata.push({name: "category_result_list_array", value: category_list});
            formdata.push({name: "answer_tags", value: tags});
            formdata.push({name: "outcome_content", value: encodeURIComponent(outcome_content)});
            formdata.push({name: "eachcat_ids", value: JSON.stringify(eachcat_ids)});
            formdata.push({name: "outcome_ids_array", value: JSON.stringify(outcome_ids_array)});

            var sqb_correct_ans = $this.find('#sqb_correct_ans').val();
            var ques_count_ = $this.find('#ques_count').val();
            formdata.push({name: "total_ques", value:ques_count_});
            formdata.push({name: "correct_answers", value:sqb_correct_ans});
            formdata.push({name: "lesson_id", value:lesson_id});
            formdata.push({name: "course_id", value:course_id});
            formdata.push({name: "course_type", value:course_type});

            jQuery.ajax({
                type: "POST",
                url: '?sqb_pdf_download_v2=1',
                data: formdata,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(blob, status, xhr) {
                    $this.find('.outcome_button_pdf div').html(downloadText);
                    $this.find('.outcome_button_pdf').removeClass('downloading-pdf');
                    $this.find('.generate_pdf_form').after('<div class="pdf-success">'+pdf_download_success_text+'</div>');

                    setTimeout(function(){
                        $this.find('.pdf-success').remove();
                    },10000);

                    var filename = "";
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                    }

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);
                        if (filename) {
                            var a = document.createElement("a");
                            if (typeof a.download === 'undefined') {
                                window.location.href = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.click();
                            }
                        } else {
                            window.location.href = downloadUrl;
                        }
                        setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100);
                    }
                },error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    jQuery('.outcome_button_pdf div').html(downloadText);
                    jQuery('.outcome_button_pdf').removeClass('downloading-pdf');
                }   
            });
            return false;
        }

        this.bindCustomEvent = function(a,name,data){
            sqb_custom_event[name] = new CustomEvent(name, {
                bubbles: true, detail: data
            });
            
            try {
                a.dispatchEvent(sqb_custom_event[name]);
            } catch (error) {
                
            }
        }

        return this.init();
    };

}( jQuery ));

function isExternalLink(url){
    const tmp = document.createElement('a');
    tmp.href = url;
    return tmp.host !== document.referrer;
};

function sqb_confetti_animation(){for(i=0;100>i;i++){var a=Math.floor(360*Math.random()),b=1*Math.random(),c=Math.floor(Math.random()*Math.max(document.documentElement.clientWidth,window.innerWidth||0)),d=Math.floor(Math.random()*Math.max(document.documentElement.clientHeight,window.innerHeight||500)),e=Math.floor(15*Math.random()),f=["#0CD977","#FF1C1C","#FF93DE","#5767ED","#FFC61C","#8497B0"],g=f[Math.floor(Math.random()*f.length)],h=document.createElement("div");h.className="sqb-modal-animation-confetti",h.style.top=d+"px",h.style.right=c+"px",h.style.backgroundColor=g,h.style.obacity=b,h.style.transform="skew(15deg) rotate("+a+"deg)",h.style.animationDelay=e+"s";var j=document.getElementById("sqb-modal-animation-confetti-wrapper");j&&j.appendChild(h)}}

jQuery(document).ready(function(){var oldMouseStart = jQuery.ui.draggable.prototype._mouseStart;jQuery.ui.draggable.prototype._mouseStart = function(event, overrideHandle, noActivation) {this._trigger("beforeStart", event, this._uiHash());oldMouseStart.apply(this, [event, overrideHandle, noActivation]);};});
function sqbCommaSeparateNumber(val){while (/(\d+)(\d{3})/.test(val.toString())){val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');}return val;}
function sqbSecondsToDhms(a){a=+a;var b=Math.floor(a/86400),c=Math.floor(a%86400/3600),d=Math.floor(a%3600/60),e=Math.floor(a%60),f=0<d?d+(1==d?"m ":"m "):"",g=0<e?e+(1==e?"s":"s"):"";return f+g}

function sqbSpeedSecondsToDhms(a, $this){
    var hour_text = $this.find('#speed_timer_text_hour_html').text();  
    hour_text = jQuery.trim(hour_text);
    var minute_text = $this.find('#speed_timer_text_mint_html').text();  
    minute_text = jQuery.trim(minute_text);
    var sec_text = $this.find('#speed_timer_text_sec_html').text();  
    sec_text = jQuery.trim(sec_text);
    /*a=+a;
    var b=Math.floor(a/86400),
    c=Math.floor(a%86400/3600),
    d=Math.floor(a%3600/60),
    e=Math.floor(a%60),
    f=0<d?d+(1==d?'<span>'+minute_text+'</span>':'<span>'+minute_text+'</span>'): '00 <span>'+minute_text+'</span>',
    g=0<e?e+(1==e?'<span>'+sec_text+'</span>':'<span>'+sec_text+'</span>'):'00 <span>'+sec_text+'</span>';*/
    a = Number(a);
    var h = Math.floor(a / 3600);
    var m = Math.floor(a % 3600 / 60);
    var s = Math.floor(a % 3600 % 60);
    var hDisplay = h > 0 ? h + (h == 1 ? '<span>'+hour_text+'</span>': '<span>'+hour_text+'</span>') : '00 <span>'+hour_text+'</span>';
    var mDisplay = m > 0 ? m + (m == 1 ? '<span>'+minute_text+'</span>': '<span>'+minute_text+'</span>') : '00 <span>'+minute_text+'</span>';
    var sDisplay = s > 0 ? s + (s == 1 ? '<span>'+sec_text+'</span>':'<span>'+sec_text+'</span>'):'00 <span>'+sec_text+'</span>';
    var html = '<div class="timer-container"><div class="timer-Sec"><div class="timer-Hours"> '+hDisplay+' </div> <div class="timer-Minutes"> '+mDisplay+' </div> <div class="timer-Seconds"> '+sDisplay+'  </div> </div></div>';
    return html;
}

function sqbisDate(a,b){if("yy-mm-dd"==a){var c=b.split("-");dtYear=c[0],dtMonth=c[1],dtDay=c[2]}else if("yy-dd-mm"==a){var c=b.split("-");dtYear=c[0],dtDay=c[1],dtMonth=c[2]}else if("dd-mm-yy"==a){var c=b.split("-");dtDay=c[0],dtMonth=c[1],dtYear=c[2]}else if("mm-dd-yy"==a){var c=b.split("-");dtMonth=c[0],dtDay=c[1],dtYear=c[2]}else if("yy/mm/dd"==a){var c=b.split("/");dtYear=c[0],dtMonth=c[1],dtDay=c[2]}else if("yy/dd/mm"==a){var c=b.split("/");dtYear=c[0],dtDay=c[1],dtMonth=c[2]}else if("dd/mm/yy"==a){var c=b.split("/");dtDay=c[0],dtMonth=c[1],dtYear=c[2]}else if("mm/dd/yy"==a){var c=b.split("/");dtMonth=c[0],dtDay=c[1],dtYear=c[2]}else if("yy.mm.dd"==a){var c=b.split(".");dtYear=c[0],dtMonth=c[1],dtDay=c[2]}else if("yy.dd.mm"==a){var c=b.split(".");dtYear=c[0],dtDay=c[1],dtMonth=c[2]}else if("dd.mm.yy"==a){var c=b.split(".");dtDay=c[0],dtMonth=c[1],dtYear=c[2]}else if("mm.dd.yy"==a){var c=b.split(".");dtMonth=c[0],dtDay=c[1],dtYear=c[2]}if(1>dtMonth||12<dtMonth)return!1;if(1>dtDay||31<dtDay)return!1;if((4==dtMonth||6==dtMonth||9==dtMonth||11==dtMonth)&&31==dtDay)return!1;if(2==dtMonth){var d=0==dtYear%4&&(0!=dtYear%100||0==dtYear%400);if(29<dtDay||29==dtDay&&!d)return!1}return!0}

function setCookie(cname, cvalue, exdays) {
  const d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  let expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let ca = document.cookie.split(';');
  for(let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function removeTags(str) {
    if ((str===null) || (str===''))
    return false;
    else
    str = str.toString();  
    return str.replace( /(<([^>]+)>)/ig, '');
}
function isSQBInteger(value) {
if ((undefined === value) || (null === value)) {
    return false;
}
return value % 1 == 0;
}
function findIndexByProperty(data, key, value) {
    for (var i = 0; i < data.length; i++) {
        if (data[i][key] == value) {
            return i;
        }
    }
    return -1;
}

function loadvideo(video_url, video_type, element_id ) {

    var xhr = new XMLHttpRequest();
    xhr.responseType = "blob";
    
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            var byteCharacters = atob(reader.result.slice(reader.result.indexOf(',') + 1));
            var byteNumbers = new Array(byteCharacters.length);
            
            for (var i = 0; i < byteCharacters.length; i++) {
                byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            
            var byteArray = new Uint8Array(byteNumbers);
            var blob = new Blob([byteArray], {type: video_type});
            var bloburl = URL.createObjectURL(blob);
            
            var video_player = videojs(element_id);
            video_player.src({ src: bloburl , type: video_type });

            videojs.getPlayer(element_id).play();
            jQuery(element_id).closest('.video-js').removeClass('vjs-seeking vjs-waiting');
            
            //alert('Video is buffered');
        
        }
        reader.readAsDataURL(xhr.response);
    };
    
    xhr.open('GET', video_url);
    xhr.send();
    
}

function sourceOpen(src) {
    URL.revokeObjectURL(video.src);
    const sourceBuffer = mediaSource.addSourceBuffer('video/mp4; codecs="vp09.00.10.08"');

    // If video is preloaded already, fetch will return immediately a response
    // from the browser cache (memory cache). Otherwise, it will perform a
    // regular network fetch.
    fetch(src)
    .then(response => response.arrayBuffer())
    .then(data => {
      // Append the data into the new sourceBuffer.
      sourceBuffer.appendBuffer(data);
      // TODO: Fetch file_2.webm when user starts playing video.
    })
    .catch(error => {
      // TODO: Show "Video is not available" message to user.
    });
  }

  function findMaxFrequencyAndSmallestValue(arr) {
    // Create an object to store the count of each number
    var countMap = {};
    let maxCount = 0;
    let maxValues = [];

    // Count occurrences of each number
    for (var num of arr) {
        countMap[num] = (countMap[num] || 0) + 1;
        if (countMap[num] > maxCount) {
            maxCount = countMap[num];
            maxValues = [num];
        } else if (countMap[num] === maxCount) {
            maxValues.push(num);
        }
    }

    // Find the smallest value among the most frequent numbers
    var smallestMaxValue = Math.min(...maxValues);

    return { maxValue: smallestMaxValue, count: maxCount };
}



jQuery(document).ready(function(){
    //jQuery('.Quiz-Optin-Template').css('border', '');
    jQuery('.quiz_start_template_outer link').remove();
    if(jQuery('.sqb_quiz_container_outer').length > 0){
        jQuery( ".sqb_quiz_container_outer" ).each(function( index,element ) {
            if(!jQuery(this).hasClass('sqb-js-render')){
                var id = jQuery(this).attr('id');
                jQuery(this).addClass('sqb-js-render');
                jQuery('#'+id).smartquizbuilder();
            }
        });
    }

    jQuery('.sqb_popup_main_wrapper').find( "[id^='mce_']" ).each(function(){
        jQuery(this).removeAttr('id');
    });
    jQuery('.sqb_quiz_container_outer').find( "[id^='mce_']" ).each(function(){
        jQuery(this).removeAttr('id');
    });
});
