<?php
use Dompdf\Dompdf;


if(isset($_REQUEST['sqb_pdf_download_v2'])){
    
    if(!empty($_POST['manage_id'])){
        
        

        global $wpdb;
        $manage_id = $_POST['manage_id'];
        $table_name = $wpdb->prefix . 'sqb_manage_leads';
        $query = $wpdb->prepare(
            "SELECT * FROM $table_name WHERE id = %d",
            $manage_id
        );
        $lead = $wpdb->get_row($query, ARRAY_A);

        $table_quiz_details = $wpdb->prefix . 'sqb_users_quiz_details';
        $query = $wpdb->prepare(
            "SELECT * FROM $table_quiz_details WHERE date = %s",
            $lead['date']
        );

        global $wpdb;

    $table_name = $wpdb->prefix . 'sqb_user_custom_fields';

    $query = $wpdb->prepare(
        "SELECT `name`, `value` FROM $table_name WHERE `manage_lead_id` = %d",
        $$manage_id
    );

    $results = $wpdb->get_results($query, ARRAY_A);

    

    // Now $array contains the desired structure

        
        $lead_details = $wpdb->get_results($query);

        $sqb_question_answer_array = array();

        $wp_total_ques = 0;
        $wp_correct_ans = 0;
        foreach ($lead_details as $item) {
            $wp_total_ques++;
            $newObject = new stdClass();
            $newObject->quizId = $item->quiz_id;
            $newObject->ques_id = $item->question_id;
            $newObject->answer_id = $item->answer_given;
            $newObject->correct_ans = $item->correct_answer;
            $newObject->answer_text = $item->answer_text;
            $newObject->points_scored = $item->points_scored;
            $newObject->total_points = $item->total_points;
            $newObject->incorrect_answer_msg_exp = "This answer is incorrect.";
            $newObject->answer_type = "single";
            $newObject->answer_tags = $item->answer_tag_ids;
            $newObject->other_field = $item->other_field;
            $newObject->answer_points_scored = $item->points_scored;

            if($item->correct_answer == 'Y'){
                $wp_correct_ans++;
            }

            $sqb_question_answer_array[] = $newObject;
        }

        
        
        
        $user_id = $lead['user_id'];
        if($lead['source'] == 'WP'){
            $user = get_user_by('ID', $user_id);
        }

        $outcomeObj = new SQB_Outcome();
        $outcome_id = $lead['outcome'];
        $outcome = $outcomeObj->loadById($outcome_id);
        $outcome_content = urlencode($outcome_content);

        $post = array();

        $post['quiz_id'] = $lead['quiz_id'];
        $post['outcome_id'] = $lead['outcome'];
        $post['sqb_question_answer_array'] = json_encode($sqb_question_answer_array);
        $post['user_id'] = $lead['user_id'];

        $source = $lead['source'];
        $user_source = $lead['user_source'];
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
            
        }else if($source == "DAP" && !empty($user_source)){
            $dapUserObj = Dap_User::loadUserById($user_id);
            if(isset($dapUserObj)){						
                
                $name =  $dapUserObj->getFirst_name()." ". $dapUserObj->getLast_name();							
                $email =  $dapUserObj->getEmail();
                
            }
        }

        $post['email'] = $email;
        $post['fname'] = $name;
        

        $array = array();

        if(!empty($array)){
            foreach ($results as $row) {
                $array[] = array($row['name'] => $row['value']);
            }
            
            if(!empty($array)){
                $post['optin_form_fields'] = http_build_query($array);

            }
        }

        $category_details =  $lead['category_details'];
					
        $category_total_details =  $lead['category_total_details'];
					
        if($category_total_details != ''){
            $category_total_details = json_decode($category_total_details,true);
        }

      
        if($category_details != ''){
            $category_details = json_decode($category_details,true);
            if(is_array($category_details)){
                $category_details_html = SQBCategoryResultDetailsHtml($category_details, '', $quiz_type);
                $category_details_html_per = SQBCategoryResultDetailsPerHtml($category_details, '', $quiz_type, $category_total_details);
            }						
        }

        

       
        $post['category_result_list_array'] = $lead['category_details'];
        $post['eachcat_ids'] = $lead['category_total_details'];
        $post['category_number_percent'] = $category_details_html_per;
        $post['category_only_percent'] = $category_details_html_per;
        $post['category_number_div'] = $category_details_html;
        $post['answer_tags'] = '';
        $post['outcome_content'] = $outcome_content;
        //$post['eachcat_ids'] = $category_total_details;
        $post['outcome_ids_array'] = '';
        
        $post['total_ques'] = $wp_total_ques;
        $post['correct_answers'] = $wp_correct_ans;
        $post['lesson_id'] = '';
        $post['course_id'] = '';
        
        $_REQUEST = array_merge($_REQUEST,$post);
        $_POST = array_merge($_POST,$post);

    }
    
    if(isset($_REQUEST['is-attachment'])){
        $isDownload = false;
    }else{
        $isDownload = true;
    }
    
    $sqb_plugins_url = plugins_url().'/smartquizbuilder';
   
    $quiz_name = '';    
    $quiz_type = '';
    $quiz_desc = '';
    $outcomeTitle ='';
    $outcomeDescription = '';
    $ansData = ''; 
    $first_name = '';
    $email = '';
    $name = '';
    $answerFormat ='';

    
    
    if($isDownload){
        $sqb_question_answer_array = json_decode(stripslashes($_REQUEST['sqb_question_answer_array']));

        if(empty($sqb_question_answer_array)){
            $sqb_question_answer_array = json_decode(($_REQUEST['sqb_question_answer_array']));
        }
       
    }else{
        
        $sqb_question_answer_array = $_REQUEST['sqb_question_answer_array'];
    }

    if(isset($_REQUEST['outcome_anslist'])){
        $outcome_anslist = json_decode(stripslashes($_REQUEST['outcome_anslist']),true);
    }else{
        $outcome_anslist = array();
    }
    

    $answer_number_array = array();


    $user_id = $_REQUEST['user_id'];
    $email = $_REQUEST['email'];
    $name = $_REQUEST['fname'];
    if(empty($name)){
        if(!empty($_REQUEST['first_name'])){
            $name = $_REQUEST['first_name'];
        }
    }
    
    $canvas_bar_chart = !empty($_REQUEST['canvas_bar_chart']) ? $_REQUEST['canvas_bar_chart'] : '';
    if(!empty($canvas_bar_chart)){
        $canvas_bar_chart = '<div class="canvas_image"><img src="'.$canvas_bar_chart.'"></div>';
    }else{
        $canvas_bar_chart = '';
    }

    $canvas_spider_chart = !empty($_REQUEST['canvas_spider_chart']) ? $_REQUEST['canvas_spider_chart'] : '';
    if(!empty($canvas_spider_chart)){
        $canvas_spider_chart = '<div class="canvas_image"><img src="'.$canvas_spider_chart.'"></div>';
    }else{
        $canvas_spider_chart = '';
    }

    $canvas_question_answer_chart = !empty($_REQUEST['canvas_question_answer_chart']) ? $_REQUEST['canvas_question_answer_chart'] : '';
    if(!empty($canvas_question_answer_chart)){
        $canvas_question_answer_chart = '<div class="canvas_image"><img src="'.$canvas_question_answer_chart.'"></div>';
    }else{
        $canvas_question_answer_chart = '';
    }

    $chart_heading = !empty($_REQUEST['chart_heading']) ? $_REQUEST['chart_heading'] : '';
    if(!empty($chart_heading)){
        $chart_heading = '<div class="canvas_image"><img src="'.$chart_heading.'"></div>';
    }else{
        $chart_heading = '';
    }

    $canvas_pie_chart = !empty($_REQUEST['canvas_pie_chart']) ? $_REQUEST['canvas_pie_chart'] : '';
    if(!empty($canvas_pie_chart)){
        $canvas_pie_chart = '<div class="canvas_image"><img src="'.$canvas_pie_chart.'"></div>';
    }else{
        $canvas_pie_chart = '';
    }
    $outcome_id = $_REQUEST['outcome_id'];
    $quiz_id = $_REQUEST['quiz_id'];

    if(empty($quiz_id)){
        $quiz_id = $_REQUEST['quizId'];
    }

    if(empty($outcome_id)){
        $outcome_id = $_REQUEST['outcome_final'];
    }

    $category_number_percent = $_REQUEST['category_number_percent'];
    $category_only_percent = $_REQUEST['category_only_percent'];
    $category_number_div = $_REQUEST['category_number_div'];
    $category_number_div = str_replace('cat-details-row','',$category_number_div);
    $optin_form_fields = $_REQUEST['optin_form_fields'];

    if(isset($_REQUEST['outcome_content'])){
        $outcome_content = urldecode($_REQUEST['outcome_content']);
    }else{
        $outcome_content = urldecode($_REQUEST['outcome_desc']);
    }
    


    if($optin_form_fields){
        $custom_fields_array = '';
        $custom_fields_data = array();
        parse_str($_POST['optin_form_fields'],$custom_fields_array);
        $cusom_items = array();
        $prevent_fields = array('first_name','email');
        $i = 1;

     

        foreach($custom_fields_array as $key=> $value){
            if(is_array($value)){
                $selected_key = $key;
                $selected_value = implode(',',$value);
            } else {
                $selected_key = $key;
                $selected_value = $value;
            }
            
            if(!in_array($selected_key,$prevent_fields)){
                $custom_field_id = explode('_',$selected_key);
                if($custom_field_id[0] == 'custom'){
                    $custom_fields_data[$i]['key'] =  $selected_key;
                    $custom_fields_data[$i]['value'] =  $selected_value;
                }
                $i++;
            }
        }
    }

    if($isDownload){
        $category_result_list_array = json_decode(stripslashes($_REQUEST['category_result_list_array']));
    }else{
        $category_result_list_array = (object) $_REQUEST['category_result_list_array'];
        
    }

  

    if(!empty($category_result_list_array)){
        $category_result_list_array = get_object_vars($category_result_list_array);
    }

    if($quiz_id =="" ||  $quiz_id  ==0){
        return;
    }

    if($outcome_id =="" ||  $outcome_id  ==0){
        return;
    }

    //load quiz details
    $quizDetails =  SQB_Quiz::loadById($quiz_id);
    $pdf_mode = 'standard';
    if(isset($quizDetails)){     
        $quiz_name = stripslashes($quizDetails->getQuizName());         
        $quiz_type = $quizDetails->getQuizType();
        $quiz_desc = $quizDetails->getQuizDesc();           
        $show_download_btn = $quizDetails->getShowDownloadButton();         
        $pdfFrontLastImage = $quizDetails->getPdfFrontLastImage();  
        $show_correct_ans = $quizDetails->getDisplayCorrectAnsOnPage();
        $getAllOtherOptions = $quizDetails->getAllOtherOptions();         
        if(!empty($getAllOtherOptions)){
            $all_other_options = maybe_unserialize($getAllOtherOptions);
            $pdf_mode = isset($all_other_options['pdf_mode']) ? $all_other_options['pdf_mode'] : 'standard';
            
        }
    }



    //load outcome details 
    $outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quiz_id, $outcome_id);
    
    $page_view = 'portrait';
    $pdf_file_name = 'outcomepdffile';
    if(isset($quizDetails)){
        $outcomeTitle = $outcomeDetails->getOutcomeName();  
        //$outcomeHtml = $outcomeDetails->getOutcomeHtml(); 
        $outcomeHtml = $outcome_content;    

        if($outcomeDetails->getPDFId() > 0){

        $pdfRecords = SQB_PdfContent::loadById($outcomeDetails->getPDFId());

        if(!empty($pdfRecords) && $pdf_mode == 'advance'){

            $pdfRowData = $pdfRecords->getContent();
            $pdf_file_name = sanitize_title($pdfRecords->getName());
            $pdfArray = maybe_unserialize($pdfRowData);

            $other_options = $pdfRecords->getOtherOptions();
            $page_view = 'portrait';
            if(!empty($other_options)){
                $other_options_unserialize = unserialize($other_options);

                if(!empty($other_options_unserialize["page_view"])){
                    $page_view = $other_options_unserialize["page_view"];
                }
            }

            if(!empty($pdfArray)){

                foreach ($pdfArray as $index => $page) {

                    $type = $page['type'];
                    $data = $page['data'];

                    $pageHtml .= '<div class="pdf-pageview-'.$page_view.' pdf-pageimage-'.$type.' pdf-page pdf-page-'.($index+1).'">';

                    if($type == 'text'){
                        $pageHtml .=  '<div class="sqb-pdf-page-content">'.stripcslashes($data).'</div>';
                    }else if($type == 'image'){
                         $pageHtml .= '<div class="inside-pdf-img-wrapper" style="background-image: url('.$data.');"><img src="" /></div>';
                    }

                    $pageHtml .= '</div>';
                    //$pageHtml .= '<div class="page-break"></div>';
                    
                }
               $pdf_data = $pageHtml;
            }else{
                $pdf_data = '';
            }
        }


        }else{
            $pdf_data = $outcomeDetails->getPDFHtml();  
            if($pdf_data == '' || $pdf_data == 'NULL'){
                $pdf_data = "<p>Thank you for completing the quiz titled: %%QUIZ_TITLE%%.</p>
                                <p>This is a %%QUIZ_TYPE%% quiz.</p>
                                <p><strong>Here's your result details:</strong></p>
                                <p>Your Outcome - %%OUTCOME%%.</p>
                                <p>Quiz Title: %%QUIZ_TITLE%%</p>
                                <p><strong>Your Answers</strong>: %%ANSWERS%%</p>";
            }
        }

        

        //$outcomeDescription = rawurldecode($outcomeHtml); 
        $outcomeDescription = stripslashes($outcomeHtml);
        $outcomeDescription =  str_replace('contenteditable="true"','',$outcomeDescription); 
        $outcomeDescription =  str_replace('[PDFGENERATE]','',$outcomeDescription); 
        if($pdf_data ==""){ 
            $pdf_data = stripslashes($pdf_data);
            $pdf_data = stripslashes($pdf_data);
            $pdf_data = stripslashes_deep($pdf_data);
            $pdf_data =  str_replace('contenteditable="true"','',$pdf_data);        
        }
    }

    $sqb_incorrect_ans_exp = sqbGetValidSettingsByKey('sqb_incorrect_ans_exp');
    if(isset($sqb_incorrect_ans_exp)){
        $sqb_incorrect_ans_exp = $sqb_incorrect_ans_exp;
    }else{
        $sqb_incorrect_ans_exp = 'Incorrect Answer Explanation';
    }
  
    
    if($sqb_question_answer_array != ''){ 
        
        $incorrect_answer_msg_exp = ''; 
        foreach($sqb_question_answer_array as $question_number => $sqb_question_answer){
            $sqb_question_answer = (array) $sqb_question_answer ;
            $currentAnsFormat = $answerFormat;  
            
            $quesId = $sqb_question_answer['ques_id'];  
            $answer_ids = $sqb_question_answer['answer_id'];    
            $all_answer_ids = $sqb_question_answer['answer_id'];    
            $points_scored = $sqb_question_answer['points_scored']; 
            $total_points = $sqb_question_answer['total_points'];   
            $incorrect_answer_msg_exp = $sqb_question_answer['incorrect_answer_msg_exp'];   
            //$correct_ans = $sqb_question_answer['correct_ans'];   
            $answer_type = $sqb_question_answer['answer_type'];

            $key = array_search($quesId, array_column($outcome_anslist, 'question_id'));

            $ans_status = '';
            if ($key !== false) {
                $foundQuestion = $outcome_anslist[$key];
                $ans_status = isset($outcome_anslist[$key]['status']) ? $outcome_anslist[$key]['status'] : '';
            }
            
            $correct_ans = array();
            if($quesId < 1){
                continue;
            }
            $answersdataobj =  SQB_QuizAnswers::loadByQuestionId($quesId);  
            
            $answer_ids_new = $answer_ids;
            $answer_ids_arr = explode(',' ,$answer_ids_new);
            $correct_ans_ids =array();
            
            //added for multiple answer
            if($answer_type =="multiple"){
                $multipleans=false;
                if($quiz_type == "assessment" || $quiz_type == "scoring"){
                    if(isset($answersdataobj)){
                        foreach($answersdataobj as $answerdataobj) {
                            $ans_id = $answerdataobj->getId();
                            $correct_answer = $answerdataobj->getCorrectAnswer();                    
                            if($correct_answer == 'true'){
                                $correct_ans_ids[]= $ans_id;
                            }   
                        }
                    }
                    if(is_array($correct_ansids)){
                        @sort($correct_ansids);
                    }

                    $correct_ansids = implode(',' ,$correct_ans_ids);

                    if(is_array($answer_ids)){
                        @sort($answer_ids);
                    }                    
                    if ($correct_ansids===$answer_ids) {                         
                        $multipleans=true;
                    }else{                       
                        $multipleans=false;
                    }            
                }
            }
            
            $incorrect_answer_msg_exp_text='';
            if(isset($answersdataobj)){
                foreach($answersdataobj as $answerdataobj) {
                    $ans_id = $answerdataobj->getId();                       
                    $correct_answer = $answerdataobj->getCorrectAnswer();   
                    
                    if($answer_type =="multiple"){
                        if($correct_answer == 'true'){
                            $correct_ans[] = $answerdataobj->getAnswerTitle();                          
                        }
                        if($quiz_type == "assessment" || $quiz_type == "scoring"){                           
                            if ($multipleans) {                                          
                                $incorrect_answer_msg_exp_text ='';
                            }else{
                                $incorrect_answer_msg_exp_text ='<br><b>'.$sqb_incorrect_ans_exp.':</b> ' .stripslashes($incorrect_answer_msg_exp).'<br>';
                            }
                        }
                        
                    }else{               
                        if($correct_answer == 'true'){
                            $correct_ans[] = $answerdataobj->getAnswerTitle();                      
                            if($answer_ids ==$ans_id){                       
                                if($quiz_type == "assessment" || $quiz_type == "scoring"){
                                    $incorrect_answer_msg_exp_text ='<br><b>'.$sqb_incorrect_ans_exp.':</b> ' .stripslashes($incorrect_answer_msg_exp).'<br>';                           
                                }                
                            }else{                          
                                $incorrect_answer_msg_exp_text ='<br><b>'.$sqb_incorrect_ans_exp.':</b> ' .stripslashes($incorrect_answer_msg_exp).'<br>';  
                            }            
                        }else{
                            if($answer_ids ==$ans_id){                           
                                if($quiz_type == "assessment" || $quiz_type == "scoring"){
                                    if($incorrect_answer_msg_exp_text){
                                        
                                    $incorrect_answer_msg_exp_text ='<br><b>'.$sqb_incorrect_ans_exp.':</b> ' .stripslashes($incorrect_answer_msg_exp).'<br>';                           
                                    }
                                }                
                            }else{                           
                                $incorrect_answer_msg_exp_text='';
                            }   
                        }
                    }           
                }           
            } 
            
            $correct_ans = implode(',' ,$correct_ans);
            
            $correct_ans = $correct_ans.$incorrect_answer_msg_exp_text;

            $answer_ids = explode(',' ,$answer_ids);
            $answer_text = '';
            
            $i = 1;
            if(count($answer_ids)){
                foreach($answer_ids as $answer_id){
                    $answersObj = SQB_QuizAnswers::loadById($answer_id);
                    if($answersObj){
                        $ans_id = $answerdataobj->getId();  
                        if($answersObj->getAnswerTitle() != ''){
                            if($i > 1){
                                $answer_text .= '<br>';
                            }

                            if($sqb_question_answer['answer_type'] == 'rank'){
                                $answer_text .= stripslashes($answersObj->getAnswerTitle());
                            }else if($sqb_question_answer['answer_text'] != 'numerical_text' && $sqb_question_answer['answer_type'] != 'multiple'){
                                $answer_text .= stripslashes($sqb_question_answer['answer_text']);
                            }else{
                                $answer_text .= stripslashes($answersObj->getAnswerTitle());
                            }
                            
                        $i++;
                        }else{
                            $answer_text .= stripslashes(''.$sqb_question_answer['answer_text']);
                        }
                    }
                }
            }else{
                $answer_text = stripslashes($sqb_question_answer['answer_text']);   
            }

            if($answer_type == 'matching_text'){
                $answer_text = strip_tags(stripslashes($sqb_question_answer['answer_text']),['p','br']);    
            }

            $ans_result = '';
            if($answer_type == 'matrix'){
            $ans_data = '';
            $id = $answer_ids_new;
            $question_id = $quesId;
                if($id != 0){
                $sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id) ;   
                $matrix_label_text_arr = '';        
                if($sqbquestionobj){                 
                    $matrix_label_text = $sqbquestionobj->getMatrixLabelText();
                    $matrix_label_text_arr = explode(',',$matrix_label_text);
                } else {
                    $matrix_label_text_arr = '';
                }

                $answer_given_array = explode(',',$id);


                //$answer_given_array_key = explode('|',$answer_given_array);
                $ansdata1 = ''; 
                $i = 1;
                $ans_data = '<br>';

                $sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');
                if(isset($sqb_answer_cust)){
                    $sqb_answer_cust = $sqb_answer_cust;
                }else{
                    $sqb_answer_cust = 'Answer';
                }

                foreach($answer_given_array as $id){
                    if($id == ''){
                        continue; 
                    }
                    $answer_given_array_key = explode('|',$answer_given_array[$i-1]);   
                    $answersdataobj =  SQB_QuizAnswers::loadById($id);    
                
                    if(isset($answersdataobj) && $answersdataobj != false){         
                        $answer = $answersdataobj->getAnswerTitle();                    
                        if($answer_type == 'matrix' && $answersdataobj->getMatrixValues() != ''){
                            $matrix_values = $answersdataobj->getMatrixValues();
                            $matrix_values_arr = explode(',',$matrix_values);
                            $matrix_values_item = $matrix_values_arr[$answer_given_array_key[1]];
                            $matrix_values_item_value = explode('|',$matrix_values_item);
                            
                            $matrix_label_text = explode('|',$matrix_label_text_arr[$matrix_values_item_value[0]]);
                            $final_matrix_label_text = urldecode($matrix_label_text[1]);
                            $ans_data .=  $answer.'<br><div><strong> '.$sqb_answer_cust.'</strong> : '.strip_tags($final_matrix_label_text).'</div><br>';
                            $i++;
                        } else {
                            if(count($answer_given_array) > 1){
                                $ans_data .=  '<br>'.$i++.')&nbsp;'.$answer;
                            }else{
                                $ans_data =  $answer;
                            }
                        }               
                    }
                }//foreach loop closed  

            }
            
            
            $answer_text = $ans_data;
        }
            
            if($correct_ans == ''){
                $correct_ans = 'N/A';
            }
            $quesDetails = SQB_QuizQuestionBank::loadById($quesId);
            
            if($quesDetails != false){
                $quesText = stripslashes($quesDetails->getQuestionTitle());
            }
            $quesText = str_replace("%%FIRST%%", $first_name, $quesText);

            //$pdf_data = str_replace("%%QUESTION_".($question_number+1)."%%", $quesText, $pdf_data);

            //$answer_text = stripslashes($sqb_question_answer['answer_text']); 
            if($answer_type == 'matrix' || $answer_type == 'multiple'){
                $answer_text = $answer_text;
            } else {
                $answer_text = $answer_text;
            }

            $answer_number_array[$quesId] = $answer_text;

            $sqb_question_cust = sqbGetValidSettingsByKey('sqb_question_cust');
            $sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');
            $correct_answer_msg = sqbGetValidSettingsByKey('correct_answer_msg');
            $outcome_screen_correct_answer = sqbGetValidSettingsByKey('outcome_screen_correct_answer');
            $incorrect_answer_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
            $outcome_screen_result = sqbGetValidSettingsByKey('outcome_screen_result');
           
            $common_correct_msg = sqbGetValidSettingsByKey('correct_answer_msg');
            $common_incorrect_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
            
            if(!$common_correct_msg){
                $common_correct_msg = 'This is the correct answer.';
            }

            if(!$common_incorrect_msg){
                $common_incorrect_msg = 'This answer is incorrect.';
            }

            if(!$outcome_screen_result){
                $outcome_screen_result = 'Your Result:';
            }
            
            if(isset($sqb_question_cust)){
                $sqb_question_cust = $sqb_question_cust;
            }else{
                $sqb_question_cust = 'Question';
            }

            if(isset($sqb_answer_cust)){
                $sqb_answer_cust = $sqb_answer_cust;
            }else{
                $sqb_answer_cust = 'Answer';
            }

            if(!empty($outcome_screen_correct_answer)){
                $correct_answer_msg = $outcome_screen_correct_answer;
            }else{
                $correct_answer_msg = 'Correct Answer';
            }
            if($quiz_type == "assessment" || $quiz_type == "scoring"){
                 if($answer_type == 'matrix'){
                     $ansData .= '<br>--------------------------------------------------<br>';
                 }

                $ansData .= '<br><span><strong>'.$sqb_question_cust.': </strong>' .$quesText .'</span><span>'.$ans_result;
                if($answer_type == 'matrix'){
                    $ansData .= $answer_text .'</span>';
                }else{
                     $ansData .= '<strong>'.$sqb_answer_cust.': </strong>' .$answer_text .'</span>';
                }
                
                if($answer_type == 'matrix'){

                }else{
                    if($show_correct_ans == 'yes'){
                       
                        if($ans_status == 'correct'){
                            $correct_ans_t = $common_correct_msg;
                        }else if($ans_status == 'incorrect'){
                            $correct_ans_t = $common_incorrect_msg;
                        }
                        
                        if($correct_ans_t){
                            $yourRes = '<span><strong>'.$outcome_screen_result.'</strong> '.$correct_ans_t.'</span>';
                        }else{
                            
                        }

                        if($ans_status == 'correct'){
                            $ansData .= $yourRes.'';
                        }else if($ans_status == 'incorrect'){
                            $ansData .= '<span><strong>'.$correct_answer_msg.'</strong> '.$correct_ans.'</span>'.$yourRes.'';
                        }
                        
                    }
                }
               
            }else{
                $ansData .= '<br><span><strong>'.$sqb_question_cust.': </strong>' .$quesText .'</span><span>'.$ans_result.'<strong>'.$sqb_answer_cust.': </strong>' .$answer_text .'</span>';
            }

            if($ans_status == 'correct') {

            }else{

            }

        }

        $ansData =  str_replace('<span','<div class="nopaddingdiv"',$ansData); 
        $ansData =  str_replace('</span>','</div>',$ansData); 

        $ansData =  str_replace('<p','<div class="pmaster"',$ansData); 
        $ansData =  str_replace('</p>','</div>',$ansData); 

        $ansData = '<div class="sqb-answer-data-wrapper">'.$ansData.'</div>';

        $pdf_data = str_replace("%%ANSWERS%%", $ansData, $pdf_data);    
        $pdf_data = str_replace("%%POINTS%%", $points_scored .'/'. $total_points, $pdf_data);   
        //$pdf_data = str_replace("%%SCORE%%", $points_scored .'/'. $total_points, $pdf_data);    
        
    }else{  
        $pdf_data = str_replace("%%ANSWERS%%", " User didn't answer any questions and time expired.", $pdf_data);   
        $pdf_data = str_replace("%%POINTS%%", 0, $pdf_data);    
        $pdf_data = str_replace("%%SCORE%%", 0, $pdf_data); 
    } 


    $allQuestions = SQB_QuizQuestions::loadByQuizIdOrderByQuestion($quiz_id);

    if(!empty($allQuestions)){
        foreach($allQuestions as $qkey => $single_question){
            
            $quesId = $single_question->getQuestionId();
            
            $quesDetails = SQB_QuizQuestionBank::loadById($quesId);
            if(!empty($quesDetails)){
                $quesText = stripslashes($quesDetails->getQuestionTitle());
                $pdf_data = str_replace("%%QUESTION_".($qkey+1)."%%", $quesText, $pdf_data);

                if(!empty($answer_number_array[$quesId])){
                    $pdf_data = str_replace("%%QUESTION_".($qkey+1)."_SELECTED_ANSWERS%%", $answer_number_array[$quesId], $pdf_data);
                }else{
                    $pdf_data = str_replace("%%QUESTION_".($qkey+1)."_SELECTED_ANSWERS%%", '', $pdf_data);
                }
            }
        }
    }


    $cat_html = '';
    if($category_result_list_array != ''){ 
        $cat_html = SQBCategoryResultDetailsHtml($category_result_list_array, 'email', $quiz_type); 
    }

    if(!empty($custom_fields_data) && is_array($custom_fields_data)){   
        foreach($custom_fields_data as $custom_field_data){

            $pdf_data = str_ireplace("%%".$custom_field_data['key']."%%", $custom_field_data['value'], $pdf_data);
        }
    }


    $outcome_tag_name = '';
    if($outcomeId != ''){
        $outcome_tag_name = SQBGetOutcomeTagsName($outcome_id);
    }

    $pdf_data = stripslashes($pdf_data);
    $tags_html = '';
    $answer_tags = $_REQUEST['answer_tags'];

    $outcome_ids_array = $_REQUEST['outcome_ids_array'];

    if(!empty($outcome_ids_array)){
        if(is_array($outcome_ids_array)){
            $outcome_ids_array = $outcome_ids_array;
        }else{
           $outcome_ids_array =  json_decode(stripslashes($outcome_ids_array));
        }
                
        $outcome_counts = array_count_values($outcome_ids_array);
        //uasort($outcome_counts, 'compareValuesDesc');
        $index = 1;

        foreach ($outcome_counts as $outcome_id => $outcome_count) {
            $outcome_title = "";
            $outcome_content = "";
            $outcome_name = SQB_Outcome::loadById($outcome_id);
            if(!empty($outcome_name)){
                $outcome_title = $outcome_name->getOutcomeName();
            }
            
            $outcome_data = SQB_QuizOutcomeDescription::loadByOutcomeidAndQuizId($outcome_id, $quiz_id);
            if(!empty($outcome_data)){
                $outcome_content =  $outcome_data->getDescription();
            }
            
            $pdf_data = str_replace('[ShowOutcomeTitle Rank="'.$index.'"]',  stripslashes($outcome_title) , $pdf_data); 
            $pdf_data = str_replace('[ShowOutcomeDesc Rank="'.$index.'"]',  stripslashes($outcome_content) , $pdf_data); 
            $index++;
        }
    }
    
    if(!empty($answer_tags)){
        $answer_tags = explode(',' ,$answer_tags);
        if(!empty($answer_tags) || $outcome_tag_name != ''){ 
            $tags_html = SQBGetTagsContentByIds($answer_tags, $outcome_tag_name);
            $tags_html = str_replace("text-align: center","",$tags_html);

            foreach($answer_tags as $answer_tag_id){
                $tags_array = SQB_Tags::loadById($answer_tag_id);
                if(!empty($tags_array)){
                    $tags_name = $tags_array->getName();
                    $tag_html = stripslashes($tags_array->getContent());
                    $pdf_data = str_replace('[SHOWTAGCONTENT Name="'.$tags_name.'"]', $tag_html, $pdf_data);
                }
            }

            $load_all_tags = SQB_Tags::load();
            foreach($load_all_tags as $load_all_tag){
                $tags_name = $load_all_tag->getName();
                $pdf_data = str_replace('[SHOWTAGCONTENT Name="'.$tags_name.'"]', '', $pdf_data);
            }
        }
    }

    $pdf_data = str_replace("%%SHOW_CATEGORY_TOTAL%%", $cat_html, $pdf_data);
    $pdf_data = str_replace("[SHOW_CATEGORY_TOTAL]", $cat_html, $pdf_data);
    $pdf_data = str_replace("%%QUIZ_TITLE%%", $quiz_name , $pdf_data);
    $pdf_data = str_replace("%%QUIZ_TYPE%%", strtoupper($quiz_type), $pdf_data);
    $pdf_data = str_replace("%%QUIZ_DESCRIPTION%%", $quiz_desc, $pdf_data);
    $pdf_data = str_replace("%%OUTCOME%%", $outcomeTitle, $pdf_data);
    $pdf_data = str_replace("%%OUTCOME_DESCRIPTION%%",  $outcomeDescription , $pdf_data); 
    $pdf_data = str_replace("%%CATEGORY_TOTAL_PERCENT%%",  $category_number_percent , $pdf_data); 
    $pdf_data = str_replace("[CATEGORY_TOTAL_PERCENT]",  $category_number_percent , $pdf_data); 
    $pdf_data = str_replace("[CATEGORY_ONLY_PERCENT]",  $category_only_percent , $pdf_data); 
    $pdf_data = str_replace("%%CATEGORY_TOTAL_NUMBER%%",  $category_number_div , $pdf_data); 
    $pdf_data = str_replace("[CATEGORY_TOTAL_NUMBER]",  $category_number_div , $pdf_data); 
    $pdf_data = str_replace("[Outcome_Title]", $outcomeTitle, $pdf_data);
    $pdf_data = str_replace("%%NAME%%",  $name , $pdf_data); 
    $pdf_data = str_replace("[OUTCOME_BAR_CHART]",  $canvas_bar_chart , $pdf_data); 
    $pdf_data = str_replace("[OUTCOME_SPIDER_CHART]",  $canvas_spider_chart , $pdf_data); 
    $pdf_data = str_replace("[OUTCOME_PIE_CHART]",  $canvas_pie_chart , $pdf_data); 
    $pdf_data = str_replace("[QUESTION_ANSWER_DATA_CHART]",  $canvas_question_answer_chart , $pdf_data); 
    $pdf_data = str_replace("[CHART_HEADING]",  $chart_heading , $pdf_data); 
    $pdf_data = str_replace("[SHOWALLUSERTAGS]",  $tags_html , $pdf_data); 
    $pdf_data = str_replace("%%EMAIL%%",  $email , $pdf_data); 
    $pdf_data = str_replace("%%FIRST%%",  $name , $pdf_data); 

    $course_id = !empty($_REQUEST['course_id']) ? $_REQUEST['course_id'] : 0;
    $lesson_id = !empty($_REQUEST['lesson_id']) ? $_REQUEST['lesson_id'] : 0;
    $points_got = sqb_user_point_details($quiz_id, $user_id, $course_id, $lesson_id);
    $points_got_array = explode("||",$points_got);
    
    $points_scored  =  $points_got_array[0];
    $total_points=  $points_got_array[1];
    if($quiz_type == "scoring" ) {
        
        $points_scored_percent = number_format(round($points_scored * 100 / $total_points, 2), 2);
        $pdf_data =  str_replace('%%SCOREINPERCENT%%',$points_scored_percent,$pdf_data); 
        $pdf_data =  str_replace('%%YOURSCORE%%',$points_scored,$pdf_data); 
        $pdf_data =  str_replace('%%TOTALSCORE%%',$total_points,$pdf_data);  

        $correct_answers = !empty($_REQUEST['correct_answers']) ? $_REQUEST['correct_answers'] : 0;
        $total_ques = !empty($_REQUEST['total_ques']) ? $_REQUEST['total_ques'] : 0;
        $incorect_answers = $total_ques - $correct_answers;
        $pdf_data =  str_replace('%%INCORRECTANSWERS%%',$incorect_answers,$pdf_data); 
        $pdf_data =  str_replace('%%CORRECTANSWERS%%',$correct_answers,$pdf_data);
        $pdf_data =  str_replace('%%TOTALQUESTIONS%%',$total_ques,$pdf_data);

        try {
            $score_per = ($points_scored / $total_points) * 100;
            $score_per = number_format($score_per, 2) . '%';
            
        }catch(Exception $e){
            $score_per = '';
        }

        $pdf_data =  str_replace('%%SCORE%%',$score_per,$pdf_data); 
    }
    if( $quiz_type == "assessment") {
        $pdf_data =  str_replace('%%CORRECTANSWERS%%',$points_scored,$pdf_data); 
        $pdf_data =  str_replace('%%TOTALQUESTIONS%%',$total_points,$pdf_data);  
        $incorect_answers = $total_points - $points_scored;
        $pdf_data =  str_replace('%%INCORRECTANSWERS%%',$incorect_answers,$pdf_data); 

        try {
            $score_per = ($points_scored / $total_points) * 100;
            $score_per = number_format($score_per, 2) . '%';
        }catch(DivisionByZeroError  $e){
            $score_per = '';
        }
        $pdf_data =  str_replace('%%SCORE%%',$score_per,$pdf_data); 
    }
    

    $pdf_data =  str_replace('[DOWNLOADPDF]','',$pdf_data);  

    $pdf_header_background_color = sqbGetValidSettingsByKey('pdf_header_background_color');
    $pdf_footer_background_color =  sqbGetValidSettingsByKey('pdf_footer_background_color');
    $add_pdf_icon = sqbGetValidSettingsByKey('add_pdf_icon');

    $pdf_display_option = sqbGetValidSettingsByKey('pdf_display_option');

    $first_page_image = sqbGetValidSettingsByKey('first_page_image');
    $last_page_image = sqbGetValidSettingsByKey('last_page_image');
    $pdf_header_title = sqbGetValidSettingsByKey('pdf_header_title');

    $pdf_header_title = str_replace('%%HEADERTITLE%%', $quiz_name, $pdf_header_title);

    if($pdf_header_title == '<div><br data-mce-bogus=\"1\"></div>'){
        $pdf_header_title = '';
    }

    $pdf_footer_copyright_content = sqbGetValidSettingsByKey('pdf_footer_copyright_content');
    $pdf_footer_copyright_content = str_replace("%%YEAR%%",date("Y"),$pdf_footer_copyright_content);
    $home_url = home_url();
    $parse = parse_url($home_url);
    $pdf_footer_copyright_content = str_replace('%%DOMAIN%%', $parse['host'], $pdf_footer_copyright_content);

    if($pdf_header_title == '<div><br data-mce-bogus=\"1\"></div>'){
        $pdf_header_title = '';
    }

    if($pdf_footer_copyright_content == '<div><br data-mce-bogus=\"1\"></div>'){
        $pdf_footer_copyright_content = '';
    }

    $first_page = '';
    $last_page = '';

    if($show_download_btn == 'Y'){
        $pdf_global_font = sqbGetValidSettingsByKey('pdf_global_font');
        $pdf_global_font = (!empty($pdf_global_font) && $pdf_global_font != '')? $pdf_global_font : 'sans-serif';
        
         $pdf_mgenplus_bolf = ($pdf_global_font == 'mgenplus') ? '* #sqb_quiz_builder .quiz_outer_fe strong, * b, strong, strong *, b *, * h1,* h2, * h3, * h4, * h5, * h6{ font-weight : 600 !important;}' : '';


        $pdf_viatname_bolf = ($pdf_global_font == 'BeVietnamPro, sans-serif') ? '* #sqb_quiz_builder .quiz_outer_fe strong, * b, * h1,* h2, * h3, * h4, * h5, * h6{ font-weight : 400 !important;}' : '';

        if(!empty($pdf_display_option)){
            if($pdf_display_option == 'same'){

                /* Global Styles for first and last image */
                $firstpage_width = sqbGetValidSettingsByKey('firstpage_width');
                $first_page_align = sqbGetValidSettingsByKey('first_page_align');
                $first_page_horizontal = sqbGetValidSettingsByKey('first_page_horizontal');
                $lastpage_width = sqbGetValidSettingsByKey('lastpage_width');
                $last_page_align = sqbGetValidSettingsByKey('last_page_align');
                $last_page_horizontal = sqbGetValidSettingsByKey('last_page_horizontal');


                /* END */
                if(!empty($first_page_image) && strtolower($first_page_image) != 'null'){
                    $first_page = '<div id="certificates_outer1" class="first-screen"><img src="'.$first_page_image.'" height="100%" width="100%"></div>';
                }
                if(!empty($last_page_image) && strtolower($last_page_image) != 'null'){
                    $last_page = '<div id="certificates_outer2" class="last-screen"><img src="'.$last_page_image.'" height="100%" width="100%"></div>';
                }
            }else if($pdf_display_option == 'different'){
                $explodepdfFrontLastImage = explode('|',$pdfFrontLastImage);
                $first_page_image = $explodepdfFrontLastImage[0];
                $last_page_image = $explodepdfFrontLastImage[1];


                $firstpage_width = $explodepdfFrontLastImage[2];
                $first_page_align = $explodepdfFrontLastImage[3];
                $first_page_horizontal = $explodepdfFrontLastImage[4];
                $lastpage_width = $explodepdfFrontLastImage[5];
                $last_page_align = $explodepdfFrontLastImage[6];
                $last_page_horizontal = $explodepdfFrontLastImage[7];



                if(!empty($first_page_image)  && strtolower($first_page_image) != 'null'){
                    $first_page = '<div id="certificates_outer1" class="first-screen"><img src="'.$first_page_image.'" height="100%" width="100%"></div>';
                }
                if(!empty($last_page_image)  && strtolower($last_page_image) != 'null'){
                    $last_page = '<div id="certificates_outer2" class="last-screen"><img src="'.$last_page_image.'" height="100%" width="100%"></div>';
                }
            }
        }
    }

    $pdf_header = '';
    $pdf_footer = '';
    $paged_based_css = '';

    
    $pdf_header = '<table id="table-header" style="width: 100%;margin: 0;padding: 0;text-align: left;background-color:'.$pdf_header_background_color.';border: none;border-collapse: collapse;"><tr style="vertical-align: middle;"><th style="width:30%;padding:10px 20px;text-align:left; "><img style="max-width: 100px;max-height:60px;width:auto;height:auto;" src="'.$add_pdf_icon.'"></th><th style="width:70%;padding:10px 20px;color:#171717;"><div style="vertical-align: middle;font-size: 19px;line-height: 1;margin: 0;padding: 0;text-align:right;width:100%;">'.$pdf_header_title.'</div></th></tr></table>';

    if(empty($pdf_header_title) && empty($add_pdf_icon)){
        $pdf_header = '';
    }

    if(!empty($pdf_footer_copyright_content)){
        $pdf_footer = '<table id="table-footer" style="width: 100%;margin: 0;padding: 0;text-align: center;background-color:'.$pdf_footer_background_color.';border: none;border-collapse: collapse;"><tr><th style="width:100%;padding:10px 20px;">'.$pdf_footer_copyright_content.'</th></tr></table>';
    }

    if(empty($pdfArray)){
        
    $pdf_data_final =  $pdf_header.$pdf_footer.'<div class="sqb_quiz_container_outer  template_num_template1 inpage_popup_sqb  sqb_mobile_view_layout_active " id="sqbquizouter_333"> <div class="sqb_counter_outer"  ><div class="sqb_quiz_container normal_quiz quiz_type_personality" id="sqb_quiz_builder"><div class="quiz_result_template_outer1 quiz_outer_fe "  > '.$first_page.'<div class="pdf-content-part">'.$pdf_data.'</div>'.$last_page.' </div></div></div></div>';
        $paged_based_css = '@page  {margin:2.5cm 0; size: letter; }';

    }else{
        $pdf_data_final =  $pdf_header.$pdf_footer.'<div class="sqb_pdf_page_based sqb_quiz_container_outer  template_num_template1 inpage_popup_sqb  sqb_mobile_view_layout_active " id="sqbquizouter_333"> <div class="sqb_counter_outer"  ><div class="pdf-content-part">'.$pdf_data.'</div></div></div>';


        if ($page_view == 'landscape') {
            $a4_size = '@page { margin-left: 0; margin-right: 0; }';
        }else{
             $a4_size = '@page { margin-left: 0; margin-right: 0; margin-top: 0; size: A4; }';
        }

        $conditional_css = '';

        if(!empty($pdf_footer_copyright_content)){
            $conditional_css.= '@page {margin-bottom: 1.5cm;}
            #table-footer{ bottom: -1.5cm;}
            .inside-pdf-img-wrapper { top: 0; }';
        }
        
        if(!empty($pdf_header_title) || !empty($add_pdf_icon)){
            $conditional_css.= '@page { margin-top: 2.5cm; }
            #table-header{ top: -2.5cm;}
            .inside-pdf-img-wrapper { top: -2.5cm; }';
        }

        

        $paged_based_css = $a4_size.'
            .sqb_pdf_page_based .pdf-page { page-break-after: always; }
            .inside-pdf-img-wrapper { page-break-after: always;  position:absolute; left:0; right:0; bottom:0; top:0; width: 595pt; height:842pt; margin: 0!important; background-size: cover; background-position: center;}
            .sqb-pdf-page-content{ padding: 20px 0;}
            .pdf-pageview-landscape .inside-pdf-img-wrapper{width: 842pt; height:595pt;}
            
            .sqb-pdf-page-content{padding-bottom: 0; }'.$conditional_css;
    }
    
    $pdf_data_final = str_replace("%%DAY%%",date("d"),$pdf_data_final);
    $pdf_data_final = str_replace("%%MONTH%%",date("m"),$pdf_data_final);
    $pdf_data_final = str_replace("%%YEAR%%",date("Y"),$pdf_data_final);
    $pdf_data_final = str_replace("%%FULL_DATE%%",date("Y/m/d"),$pdf_data_final);

    $pdf_data_final =  str_replace('<span','<div class="nopaddingdiv"',$pdf_data_final); 
    $pdf_data_final =  str_replace('</span>','</div>',$pdf_data_final); 

    $pdf_data_final =  str_replace('<label','<div class="nopaddingdiv"',$pdf_data_final); 
    $pdf_data_final =  str_replace('</label>','</div>',$pdf_data_final); 

    $pdf_data_final =  str_replace('<p','<div class="pmaster"',$pdf_data_final); 
    $pdf_data_final =  str_replace('</p>','</div>',$pdf_data_final); 
    
    $pdf_data_final = str_replace("ShowCategoryScore",'ShowCategoryScoreServer',$pdf_data_final);
    $pdf_data_final = str_replace("[CategoryRank",'[CategoryRankFinal',$pdf_data_final);
    $pdf_data_final = str_replace("[ConditionalTAGS",'[ConditionalTAGSFinal',$pdf_data_final);
    $pdf_data_final = str_replace("[/ConditionalTAGS",'[/ConditionalTAGSFinal',$pdf_data_final);

    $pdf_data_final = do_shortcode(stripslashes($pdf_data_final));
    $pdf_data_final = str_replace("%%FIRST%%",  $name , $pdf_data_final); 

    $pdf_data_final =  str_replace('<p','<div class=""',$pdf_data_final); 
    $pdf_data_final =  str_replace('</p>','</div>',$pdf_data_final); 
    
    $pdf_data_final =  str_replace('[CHART_HEADING]','',$pdf_data_final); 
    $pdf_data_final =  str_replace('[CATEGORY_SPIDER_CHART]','',$pdf_data_final); 
    $pdf_data_final =  str_replace('[CATEGORY_BAR_CHART]','',$pdf_data_final); 
    $pdf_data_final =  str_replace('[QUESTION_ANSWER_DATA_CHART]','',$pdf_data_final); 

    $cssurl =  ' 
    <link href="'.$sqb_plugins_url.'/includes/templates/result/template2/template2.css?v='.rand(1,1000).'" rel="stylesheet">  
    <link href="'.$sqb_plugins_url.'/includes/css/sqb_frontend.css?v='.rand(1,1000).'" rel="stylesheet">';
    $temp_content = ob_get_clean();   
    $temp_content =  $cssurl.stripslashes($pdf_data_final);  
    
    
    $filename = $pdf_file_name;
    //for the width
    if(@$first_page_align == 'center'){
        $first_img_top= '50%;';
        $first_img_tranform_top= '-50%';
    }else if(@$first_page_align == 'bottom'){
        $first_img_top= '100%;';
        $first_img_tranform_top= '-100%';
    }else{
        $first_img_top= '0;';
        $first_img_tranform_top= '0';
    }

    if(@$first_page_horizontal == 'center'){
        $first_img_left= '50%;';
        $first_img_tranform_left= '-50%';
    }else if(@$first_page_horizontal == 'right'){
        $first_img_left= '100%;';
        $first_img_tranform_left= '-100%';
    }else{
        $first_img_left= '0;';
        $first_img_tranform_left= '0';
    }

    /*Last Page*/
    
    if(@$last_page_align == 'center'){
        $last_img_top= '50%;';
        $last_img_tranform_top= '-50%';
    }else if(@$last_page_align == 'bottom'){
        $last_img_top= '100%;';
        $last_img_tranform_top= '-100%';
    }else{
        $last_img_top= '0;';
        $last_img_tranform_top= '0';
    }

    if(@$last_page_horizontal == 'center'){
        $last_img_left= '50%;';
        $last_img_tranform_left= '-50%';
    }else if(@$last_page_horizontal == 'right'){
        $last_img_left= '100%;';
        $last_img_tranform_left= '-100%';
    }else{
        $last_img_left= '0;';
        $last_img_tranform_left= '0';
    }

    $font_url = site_url().'/wp-content/plugins/smartquizbuilder/includes/frontend/';
    $gdpr_font_url = site_url().'/wp-content/plugins/gdprlibrary/assets/';

    $screen_name = 'settings_background_color';
    $strm_type = 'settings';
    $pdf_global_text_color = '#000';
    $pdf_global_bg = '#f0f0f0';
    $theme_data_has = SQB_GlobalTheme::loadByQuizIdAndNameAndType($quiz_id,$screen_name,$strm_type);
    if($theme_data_has){
        $colorpickerdata = maybe_unserialize($theme_data_has->getValue());
        if($colorpickerdata){
            if(isset($colorpickerdata['category_desc_font_color'])){
                $pdf_global_text_color = $colorpickerdata['category_desc_font_color'];
            }

            if(isset($colorpickerdata['setting_category_background_color'])){
                $pdf_global_bg = $colorpickerdata['setting_category_background_color'];
            }
        }
    }

    if($quizDetails->getSettingLevel() == 'global'){
        $sqb_gl_style_settings = SQB_GlobalTheme::loadByQuizIdAndNameAndType(0,'sqb_gl_style_settings','global');
        if(!empty($sqb_gl_style_settings)){
            $sqb_gl_style_settings = (array) json_decode($sqb_gl_style_settings->value);

            if(isset($sqb_gl_style_settings['gl_category_desc_font_color'])){
                $pdf_global_text_color = $sqb_gl_style_settings['gl_category_desc_font_color'];
            }

            if(isset($sqb_gl_style_settings['gl_category_background'])){
                $pdf_global_bg = $sqb_gl_style_settings['gl_category_background'];
            }
        }
    }

    
    $demo = '
    <html>
        <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
            <style> 

            @font-face {
                font-family: "BeVietnamPro";
                src: url("'.$font_url.'fonts/BeVietnamPro.ttf");
            }

            @font-face {
                font-family: "mgenplus";
                src: url("'.$gdpr_font_url.'fonts/mgenplus-1c-medium.ttf");
                font-weight: 400;
            }

             @font-face {
                font-family: "mgenplus";
                src: url("'.$gdpr_font_url.'fonts/mgenplus-1c-bold.ttf");
                font-weight: 600;
            }

                body { background-color: #FFFFFF; color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; line-height: 1.3; scrollbar-3dlight-color: #F0F0EE; scrollbar-arrow-color: #676662; scrollbar-base-color: #F0F0EE; scrollbar-darkshadow-color: #DDDDDD; scrollbar-face-color: #E0E0DD; scrollbar-highlight-color: #F0F0EE; scrollbar-shadow-color: #F0F0EE; scrollbar-track-color: #F5F5F5; }
                
                .page-break {
                            page-break-before: always;
                        }
                .sqb_spider_charts_heading, #question_answer_chart,.ans_in_resultpage_outer,.question_answer_chart ,.take-quiz-btn{display:none !important;} 
                #certificates_outer1, #certificates_outer2{position: relative; bottom: 0; top: 0; left: 0; height:780px;  width:100%; text-align:center; }
                #certificates_outer1.first-screen{ page-break-after: always; }
                #certificates_outer1.first-screen img, #certificates_outer2.first-screen img{position: absolute; object-fit: cover; width: '.@$firstpage_width.'px; max-width: 100%; height: auto; top: '.@$first_img_top.'; left: '.@$first_img_left.'; transform: translate('.$first_img_tranform_left.', '.$first_img_tranform_top.'); text-align: center; }
                #certificates_outer1.last-screen img, #certificates_outer2.last-screen img{position: absolute; object-fit: cover; width: '.@$lastpage_width.'px; max-width: 100%; height: auto;  top: '.$last_img_top.'; left: '.$last_img_left.'; transform: translate('.$last_img_tranform_left.', '.$last_img_tranform_top.'); text-align: center; }

                .pdf-content-part{ padding: 0 20px; margin: 10px!important; text-align: left;}
                .pmaster{margin-top: 1em; margin-bottom: 1em;}
                .nopaddingdiv{margin-top: 0; margin-bottom: 0; display: inline;}
                .sqb-answer-data-wrapper .nopaddingdiv { display: block; }
                .pmaster > strong { line-height: 1; }
                .assessment_outcome_connect .sqb_ans_item_img,.assessment_outcome_connect .sqb_backend_show {display:none}
                .sqb_ans_item.ans_type_rating  .answer-options{display:none !important;} 
                .sqb_answer_bot_option_wrapper_outer {display:none;}
                .sqb_template7_selected .ans_layout_div .sqb_ans_add_image .dropdown-link-style.dropdown { display:none;}  
                .sqb_template7_selected #Start-Screen-Settings .start_temp_static_div .sqb_edit_template { display:none !important; }
                .sqb_template8_selected .sqb-ans-image-options .sqb-custom-size-cover .sqb-que-img-width { display:none; }
                .outer-style8 .sqbHideQuesTemplateImageOuter { display:none !important; }
                .outcome_products_section{display:none;} 

                .Quiz-Template.result_temp_outer  {display: block!important;width: 100%!important; max-width: 100%!important;}

                .Quiz-Template .Quiz-Template-title, .Quiz-Template .Quiz-Template-image, 
                .Quiz-Template .Quiz-Template-content , .Quiz-Template-content p , 
                .Quiz-Template-content ul.Quiz-question-points {display:block!important;width: 100%!important;  }

                #sqb_quiz_builder  .Quiz-Template .Quiz-Template-title,   
                #sqb_quiz_builder .Quiz-Template .Quiz-Template-content , #sqb_quiz_builder .Quiz-Template-content p , 
                #sqb_quiz_builder .Quiz-Template-content ul.Quiz-question-points {display: block!important;width: 100%!important;  max-width: 100%!important;}
                .result_temp_outer img{display:none!important;}
                .sqb_img_draggable, .Quiz-Template .Quiz-Template-image img, #sqb_quiz_builder .Quiz-Template .Quiz-Template-image img, #sqb_quiz_builder .quiz_comon_template .sqb_img_draggable{ width: 100%!important; object-fit: unset!important; margin: 0!important;}

                #sqb_quiz_builder.sqb_quiz_container .outcome_div .question_img_div{ width: 100%!important;  }
                .Quiz-Template .take-quiz-btn, #sqb_quiz_builder .Quiz-Template .take-quiz-btn{ display: none!important;}
                .outcomeTemplateYoutubeVideoOuter{ display: none;}
                .result_temp_outer  img{display:none!important; height:0}
                .result_temp_outer #result_temp_id {  height:0!important;}

                .sqb_quiz_container_outer {text-align:left}
                .Quiz-Template.result_temp_outer, .result_temp_outer{ border: 0 !important; padding: 0 !important;margin: 0 !important;border-width: 0 !important;}
                sqb_quiz_builder .points_scored_result {padding: 0 !important;} 
                #table-header {position: fixed; top: -2.5cm; left: 0cm; right: 0cm; height: 2cm; color: white; text-align: center; line-height: normal; }
                .result_temp_outer .sqbHideTemplateImageOuter .sqbHideTemplateImage, .result_temp_outer .sqbHideOutcomeDescriptionOuter .sqbHideOutcomeDescription,.result_temp_outer .sqbShowTemplateImageOuter .sqbShowTemplateImage {display:none;}
                #table-footer {position: fixed; bottom: -2.5cm; left: 0cm; right: 0cm; height: 1.5cm; color: white; text-align: center; line-height: normal; }
                
                *{ font-family: '.$pdf_global_font.'!important;}
                table *, 
                table td span{ font-family: '.$pdf_global_font.'!important;}
                
                '.$pdf_viatname_bolf.'
                '.$pdf_mgenplus_bolf.'
                .sqbHideOutcomeDescriptionOuter, .sqbShowTemplateImageOuter, .generate_pdf_form{display:none!important;}
                .sqb_quiz_container_outer td div { display: inline; }
                .sqb_quiz_container_outer .mce-item-table tr{ margin-bottom: 10px;}
                .sqb_quiz_container_outer .mce-item-table table{ display:block; }
                .result_temp_outer{ position: unset; display:block!important; }
                table.mce-item-table tr{ display:table-row;}
                table.mce-item-table td{ width: auto;}
                table.mce-item-table {width: 100%; background-color: #ffffff; border-collapse: collapse; border-width: 2px; border-color: #000; border-style: solid; color: #000000; }

                table.mce-item-table td, table.mce-item-table th {border-width: 2px; border-color: #000; border-style: solid; padding: 3px; }
                .sqb_category_details{display: block !important;}
                .cat-details-row{display: block !important;}
                .cat-details-row .nopaddingdiv{display: inline-block;padding-right: 20px;  font-weight: 400 !important;}
                .cat-details-row .nopaddingdiv b{font-weight: 600 !important;}
                .sqbHideOutcomeDescription{display: none;}
                .outcome-printselected-answer{display:none !important;}
                .pdf-content-part img{ margin-left: 0 !important; margin-right: 0 !important;}
                .canvas_image {display: block !important;text-align: center !important;}
                .canvas_image img { max-width: 100%;  height: auto;}
                
                /* .sqb-category-breakdown { display: table; width: 100%; }
                .sqb-category-breakdown .sqb-col-2 { display: table-cell; width: 48%; border-left: 0.5% solid #fff; border-right: 0.5%  solid #fff; }
                .sqb-category-breakdown .sqb-col-3 { display: table-cell; width: 30%; border-left: 0.5% solid #fff; border-right: 0.5%  solid #fff; } */
                
                .sqb-categoy-bd-inner{ margin-top: 10px; page-break-inside: avoid!important; }
                .sqb-category-card h3 { font-size: 16px; color: '.$pdf_global_text_color.'; margin-bottom: 10px; padding-top: 20px; }
                .sqb-category-card > div { font-size: 15px; color:  '.$pdf_global_text_color.'!important; }
                .sqb-category-card { padding: 0px 10px 20px; border-radius: 6px; position: relative; background-color: '.$pdf_global_bg.'; }
                .sqb-categoy-progress-bar { height: 10px; background-color: gray; border-radius: 5px; position: relative; margin-top: 10px; }
                .sqb-categoy-progress { height: 10px; border-radius: 5px; }
                .sqb-categoy-progress-info { display: table; width: 100%; margin-top: 5px; }
                .sqb-categoy-score { width: 50%; display: inline-block; text-align: right!important; font-weight: 400 !important; }
                .sqb-categoy-range { font-weight: 400 !important; width: 50%; display: inline-block; color:  '.$pdf_global_text_color.'; }
                .sqb-categoy-progress-info > span { font-size: 14px; font-weight: 400; color:  '.$pdf_global_text_color.'; }
                .sqb-categoy-progress-info span strong { font-weight: 400 !important; }
                /*.sqb_quiz_container_outer div[style="text-align: center;"] * { text-align: center; }*/

                  
                '.$paged_based_css.'
            </style>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        <body>
            '.$temp_content.'
            <style> body{margin: 0;} </style>
        </body>
    </html>';
    //print_r($demo); exit;
    // include autoloader
    require_once SQB_PD_DIR.'/inc/dompdf/autoload.inc.php';
    // reference the Dompdf namespace  

    // instantiate and use the dompdf class
    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf->loadHtml($demo); 
    // (Optional) Setup the paper size and orientation
    if ($page_view == 'landscape') {
        $dompdf->setPaper('A4', 'landscape');
    }else{
        $dompdf->setPaper('A4', 'portrait');
    }
    
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    //$dompdf->stream($filename,array("Attachment"=>0));
  
    if($isDownload){
        $dompdf->stream($filename);
        exit;
    }else{
        $upload_dir   = wp_upload_dir();
        $random = 'sqb-pdf-'.rand(0,100).time();
        $sqb_dir = $upload_dir['basedir'].'/smartquizbuilder/';
        if (!file_exists($sqb_dir)) {
            mkdir($sqb_dir, 0777);
        }

        $pdffile = $upload_dir['basedir'].'/smartquizbuilder/'.$random.'.pdf';
        $output = $dompdf->output();
        file_put_contents($pdffile, $output);
        return $pdffile;
    }
}

function compareValuesDesc($a, $b) {
    return $b - $a; // Descending order
  }
?>