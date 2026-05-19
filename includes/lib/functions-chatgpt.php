<?php

use Dompdf\Dompdf;

add_action('wp_ajax_sqb_save_chatgpt_api_key', 'SqbSaveChatGPTApiKeyAjax');

function SqbSaveChatGPTApiKeyAjax(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $output['message'] = 'It looks like the call timed out. Please try again!';
    if(isset($_POST['api_key'])){
        update_option('sqb_chat_gpt_api_key', $_POST['api_key']);
        update_option('sqb_chat_gpt_api_model', $_POST['api_model']);
        $output['message'] = 'saved ';
    }
    echo json_encode($output);die;
}

add_action('wp_ajax_sqb_ai_generate_quiz_create', 'SqbCreateQuizFromChatGPT');

function SqbCreateQuizFromChatGPT(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    if(!empty($_POST['object'])){
        $object = $_POST['object'];
        $title = $_POST['quiz_title'];
        $quiz_description = $_POST['quiz_description'];
        $template = $_POST['template'];
        $quiz_type = $object['quiz_type'];

        if(empty($quiz_description)){
            $quiz_description = $title;
        }

        $quizArray = array(
            'title' => $title,
            'quiz_description' => $quiz_description,
            'template' => $template,
            'quiz_type' => $quiz_type
        );

        $coor_ans = @$_REQUEST['coor_ans'];
        if($coor_ans == 'no'){
            $quizArray['display_correctans_on_page'] = 'no';
        }else{
            $quizArray['display_correctans_on_page'] = 'yes';
        }

        
        

        $quiz_id = createAIQuiz($quizArray);


        $final['outcomes'] = array();
        $outcomeData = array(
            'action' => 'sqb_outcometemp',
            'outcome_action' => 'save',
            'chatgpt' => 'chatgpt',
            'outcomes_data' => array()
        );

        
        $f_outcomes = array();
        if(!empty($object['sel_outcomes'])){
            foreach ($object['sel_outcomes'] as $qkey => $outcome) {
                $randval = rand(1,100);
                $outcome_html = outcome_data($outcome['description'],$template,$quiz_type);

                $outcome_settings = array();
                if($template == 'template9'){
                    $outcome_settings = array(
                        'temp_layout' => 'sqb-template-bg-video-left',
                        'template_alignment' => 'template9-inner-center',
                        'template_image' => '',
                        'background_color' => 'rgb(214, 153, 92)',
                    );
                }

                $f_outcomes[] = array(
                    'id' => '',
                    'quiz_id' => $quiz_id,
                    'range_val' => $outcome['range']['min'],
                    'range_val1' => $outcome['range']['max'],
                    'quiz_type' => $quiz_type,
                    'outcome_name' => $outcome['title'],
                    'outcome_html' => $outcome_html,
                    'outcome_redirect' => '',
                    'outcome_screen' => '',
                    'outcome_div_id' => 'card_res'.$randval,
                    'outcome_show_video' => '',
                    'outcome_video_url' => 'N',
                    'outcome_video_aspect' => '1',
                    'enable_outcome_background_image' => 'N',
                    'outcome_setting' => $outcome_settings
                );
            }

            $outcomeData['outcomes_data'] = $f_outcomes;
                      
            $outcome = create_outcome($outcomeData);

            $newoutcome = array();
          
            $i=0;
            foreach ($outcome['ids'] as $key => $value) {
                $index = $object['sel_outcomes'][$i]['title'];
                $i++;
                $newoutcome[$index] = $value;
            }
        }

        $questionsData = array(
            'id' => $quiz_id,
            'actionType' => 'save_ques',
            'chatgpt' => 'chatgpt',
            'questions_data' => array()
        );

        $f_questions = array();

        if(!empty($object['sel_questions'])){
            foreach ($object['sel_questions'] as $qkey => $question) {


                $map_array = array();
                $main_index = 1;
                $answers = $question['answers'];
                if($question['type'] == 'single' || $question['type'] == 'multi' || $question['type'] == 'rating'){
                    if(!empty($answers)){
                        foreach ($answers as $key => $answer) {

                            if(empty($answer['outcome'])){
                                continue;
                            }

                            $otitle = $answer['outcome'];
                            $outcome_id = $newoutcome[$otitle];

                            $r = ''.date('Y').'_'.date('m').'_'.time().'_cotcome_item_'.rand(0,9999)*10000;
                            $map_array[] = array(
                                'coutcome_selected_id' => array($outcome_id),
                                'outcome_mapping_id' => '%%OUTCOMEMAPPINGID%%',
                                'outcome_wrapper_id' => $r,
                                'outcome_answer_id' => '%%ANSWERID%%',
                                'outcome_answer_index_id' => $main_index,
                            );

                            $main_index++;
                            
                        }
                       
                    }
                }


                $f_answers = array();
                if(!empty($question['answers']) && $question['type'] != 'text'){
                    foreach ($question['answers'] as $akey => $answer) {
                        $ans_wrapper_id = 'sbq_main_div_'.date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999)*10000;

                        $answer_point = !empty($answer['points']) ? $answer['points'] : 0;
                        $correct_ans = !empty($answer['correct']) ? $answer['correct'] : 'false';

                        $coor_ans = @$_REQUEST['coor_ans'];
                        if($coor_ans == 'no'){
                            $correct_ans = 'false';
                        }

                        $f_answers[] = array(
                            'ans' => sqb_get_answer_data($answer['answer'],$question['type'], $answer_point, $correct_ans),
                            'order' => $akey,
                            'corrent_ans' => 'sqb_is_right_ans',
                            'correct_ans' => $correct_ans,
                            'ans_point' => $answer_point,
                            'ans_hint' => '',
                            'ans_info' => '',
                            'answer_id' => '%%ANSWERID%%',
                            'answer_title' => $answer['answer'],
                            'answer_wrapper_id' => $ans_wrapper_id,
                            'recommendation_html' => '',
                            'numeric_correct_answer' => '',
                        );
                    }
                }else{
                    if($question['type'] == 'text'){
                        $ans_wrapper_id = 'sbq_main_div_'.date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999)*10000;
                        $f_answers[] = array(
                            'ans' => sqb_get_answer_data('',$question['type']),
                            'order' => 0,
                            'corrent_ans' => 'sqb_is_right_ans',
                            'ans_point' => '0',
                            'ans_hint' => '',
                            'ans_info' => '',
                            'answer_id' => '%%ANSWERID%%',
                            'answer_title' => '',
                            'answer_wrapper_id' => $ans_wrapper_id,
                            'recommendation_html' => '',
                            'numeric_correct_answer' => '',
                        );
                    }
                }

                $question_settings = array();
                if($template == 'template9'){
                    $question_settings = array(
                        'dropdown_label' => '',
                        'temp_layout' => 'sqb-template-bg-video-left',
                        'template_alignment' => 'template9-inner-center',
                        'template_image' => '',
                        'background_color' => 'rgb(214, 153, 92)',
                    );
                }

                $multiple_correct_ans = 'N';
                if($question['type'] == 'multi'){
                    $multiple_correct_ans = 'Y';

                    $coor_ans = @$_REQUEST['coor_ans'];
                    if($coor_ans == 'no'){
                        $multiple_correct_ans = 'N';
                    }
                }

                $question_wrapper_id = 'sbq_main_div_'.date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999)*10000;

                $question_next_button_html = "";

                if($question['type'] == 'rating'){
                    $rating_data = $question['min-max-text'];
                    if($rating_data){
                        $temp_customizer = "640px||<div>".$rating_data[0]."</div>||<div>".$rating_data[1]."</div>";
                    }else{
                        $temp_customizer = "640px||<div>Strongly Disagree</div>||<div>Strongly Agree</div>";
                    }
                }else{
                    $temp_customizer = '640px';
                }
                $ans_layout = 'standard';

                if($template == 'template6'){
                    if($question['type'] == 'rating'){
                        $rating_data = $question['min-max-text'];
                        if($rating_data){
                            $temp_customizer = "940px||<div>".$rating_data[0]."</div>||<div>".$rating_data[1]."</div>";
                        }else{
                            $temp_customizer = "940px||<div>Strongly Disagree</div>||<div>Strongly Agree</div>";
                        }
                    }else{
                        $temp_customizer = '940px';
                    }
                }else if($template == 'template8'){
                    if($question['type'] == 'rating'){
                        $rating_data = $question['min-max-text'];
                        if($rating_data){
                            $temp_customizer = "2000px||<div>".$rating_data[0]."</div>||<div>".$rating_data[1]."</div>||600px";
                        }else{
                            $temp_customizer = "2000px||<div>Strongly Disagree</div>||<div>Strongly Agree</div>||600px";
                        }
                        $ans_layout = "layout-five-in-row";
                    }else{
                        $temp_customizer = '2000px||600px';
                    }

                    $question_next_button_html = '<div class="continue-question-btn sqb_tiny_mce_editor single_next_btn sqb_next_btn mce-content-body" id="mce_70" contenteditable="true" spellcheck="false" style="position: relative;"><div>Continue</div></div>';
                }else if($template == 'template5'){

                    if($question['type'] == 'rating'){
                        $rating_data = $question['min-max-text'];
                        if($rating_data){
                            $temp_customizer = "1400px||<div>".$rating_data[0]."</div>||<div>".$rating_data[1]."</div>||rgb(145, 126, 242)||rgb(20, 28, 58)||760px||||auto||repeat||0% 0%||rgba(0, 0, 0, 0)||||#000000";
                        }else{
                            $temp_customizer = "1400px||<div>Strongly Disagree</div>||<div>Strongly Agree</div>||rgb(145, 126, 242)||rgb(20, 28, 58)||760px||||auto||repeat||0% 0%||rgba(0, 0, 0, 0)||||#000000";
                        }
                    }else{
                        $temp_customizer = '1400px||rgb(145, 126, 242)||rgb(20, 28, 58)||760px||||auto||repeat||0% 0%||rgba(0, 0, 0, 0)||||#000000';
                    }
                }

                $f_questions[] = array(
                    'question_data' => sqb_get_question_data($question['question'], $template, $question),
                    'answer_array' => $f_answers,
                    'order' => $qkey,
                    'question_type' => $question['type'],
                    'question_temp_name' => 'standard',
                    'question_temp_no' => 'template1',
                    'ans_with_img' => 'N',
                    'ans_layout' => $ans_layout,
                    'multiple_correct_ans' => $multiple_correct_ans,
                    'question_id' => '%%SQBQUESTIONID%%',
                    'question_title' => $question['question'],
                    'question_wrapper_id' => $question_wrapper_id,
                    'show_correct_inccorect_ans_checkbox' => 'Y',
                    'temp_customizer' => $temp_customizer,
                    'allow_skip_ques' => 'N',
                    'question_skip_button_html' => 'N',
                    'skip_outcome_mapping' => 'N',
                    'question_next_button_html' => $question_next_button_html,
                    'enable_question_background_image' => 'N',
                    'matrix_html' => '',
                    'quiz_category_id' => '',
                    'question_setting'=> $question_settings,
                    'outcome_results_checkbox' => $map_array
                    );

                    
            }
        }

       
        $questionsData['questions_data'] = $f_questions;
        create_questions($questionsData);

        //echo '<pre>';print_r($questionsData);echo '<pre>';

        $ajaxResponse = array(
            'quiz_id' => $quiz_id,
            'status' => 'ok',
        );
    
        echo json_encode($ajaxResponse);die;
    }
}

function grabJsonFromChatGPT($message,$pattern){

    $jsonArray = array();
    $message = str_replace(array("\n","\r"), '', $message);
    $message = str_replace(array("```json","```"), '', $message);
    $message = str_replace(array("\n","\r","\t"), '', $message);
    $message = str_replace(array("[ {"), '[{', $message);
    $message = str_replace(array("[    {"), '[{', $message);
    if (preg_match($pattern, $message, $matches)) {
        
        $capturedString = $matches[0];

        $data = json_decode($capturedString,true);

        if ($data !== null && json_last_error() === JSON_ERROR_NONE) {
            $jsonArray = $data;
        }
    }

    return $jsonArray;
}

add_action('wp_ajax_sqb_ai_generate_quiz_outcome', 'SQBAIGenerateQuizOutcome');

function SQBAIGenerateQuizOutcome(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $title = $_REQUEST['quiz_title'];
    $chatgpt_goal = $_REQUEST['chatgpt_goal'];
    $outcome_limit = $_REQUEST['outcome_limit'];
    $outcome_ideal = $_REQUEST['outcome_ideal'];

    if($outcome_ideal == 'ai_outcome'){
        $outcome_limit = '';
    }else{
        $outcome_limit = '\n\n4) Total # of outcomes: '.$outcome_limit.'';
    }

    $questions = $_REQUEST['object']['sel_questions'];
    $quiz_type = $_REQUEST['object']['quiz_type'];
    $quiz_lang = !empty($_REQUEST['quiz_lang']) ? $_REQUEST['quiz_lang'] : 'English';
    $append = isset($_REQUEST['append']) ? 1 : 0;

    $appendMessage = !empty($append) ? '\nGive me different set of responses than previous one' : '';

    $questions_list = '';
    foreach ($questions as $key => $question) {
        $questions_list .= $question['title']."\n";
    }


    $chatgpt_outcome_prompt = $_POST['chatgpt_outcome_prompt'];

    $prompt_type = $_POST['prompty_type'];

    if($prompt_type == 'prompt'){
        if($quiz_type == 'scoring'){
            $prompt_message = $chatgpt_outcome_prompt.'\n';
        }else{
            $prompt_message = $chatgpt_outcome_prompt.'\nOutcome based mapping to determine result';
        }
    }else{

        if(isset($_REQUEST['add_more'])){
            $prompt_p = 'I need some additional quiz outcomes for my quiz titled';
        }else{
            $prompt_p = 'I need detailed and relevant quiz results for my quiz titled';
        }

        $chatgpt_goal = !empty($chatgpt_goal) ? '\n'.$chatgpt_goal.'\n\n' : '';
        
        $quiz_lang_m = 'Language: Response in '.$quiz_lang.'\n';
        $quiz_quiz_title = 'Quiz Title : '.$title.'\n';
        $goal = 'Goal: '.$chatgpt_goal;
        $prompt_message = $prompt_p.' - "'.$title.'" \n\nCriteria:\n\n
        '.$quiz_lang_m.$goal.'\n\nDesired Outcomes:\n
        1) Outcome Titles: Provide descriptive outcome titles based on quiz title and goal.\n\n2) Outcome Descriptions: Each outcome should have at least 800 words formatted in HTML, explaining the outcome, including strengths and suggestions for improvement.\n\n3) Call to Action: Include a call to action for each outcome that encourages the user to take specific steps based on their outcome.'.$outcome_limit.'\n\n';

        //$prompt_message .= '\nGive me descriptive outcome titles and at least 800 word with html block formatted description for each outcome.\n';
        
        if($quiz_type == 'scoring'){
            $prompt_message .='';
        }else{
            $prompt_message .='Outcome based mapping to determine result\n\n';
        }
    }




    $ajaxResponse = array();
    $prompt = '
    
    '.$prompt_message.'

    Give me the quiz results in JSON format like this with single code quote 

    '.$appendMessage.'

    [
          {
            "title": "title 1",
            "description": "",
            "call_to_action": ""
          },
          {
            "title": "title 2",
            "description": "",
            "call_to_action": ""
          },
          {
            "title": "title 3",
            "description": "",
            "call_to_action": ""
          },
          ...
          ...
        ]

       

    ';

    $response = sendChatGPTRequest($prompt);
    
    if(isset($response['error'])){
        $ajaxResponse = array(
            'status' => 'error',
            'code' => $response['error']['code'],
            'message' => $response['error']['message']
        );
        echo json_encode($ajaxResponse);die;
    }

    $reply = $response['choices'][0]['message']['content'];
    $orignal = $reply;
    $pattern = '/\[.*?\]/s';

    $jsonArray = grabJsonFromChatGPT($reply,$pattern);

    $html = '';
    if(!empty($jsonArray)){
        //$html .= '<div class="chatgpt-results-main">';
        foreach ($jsonArray as $key => $value) {
            $html .= '<div class="chatgpt-results-inner">
            <input class="quiz_checkbox" name="chatgpt_outcome_list[]" type="checkbox" value="1">
            <div class="chagpt-single_quiz_card">
            ';
            $html .= '<h3>'.$value['title'].'</h3>';
            $html .= '<div class="chatgpt-content-part">';
            $html .= '<p>'.$value['description'].'</p>';
            $html .= '</div>';
            $html .= '</div></div>';
        }

        //$html .= '</div>';
        $ajaxResponse = array(
            'status' => 'ok',
            'html' => $html,
            'object' => $jsonArray,
            'orginal' => $orignal,
            'prompt' => $prompt
        );
    }else{
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'It looks like the call timed out. Please try again!',
            'orginal' => $orignal,
            'prompt' => $prompt
        );
    }

    echo json_encode($ajaxResponse);die;
}

add_action('wp_ajax_sqb_ai_generate_quiz_ideas', 'SQBAIGenerateQuizIdeas');

function SQBAIGenerateQuizIdeas(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $prompt = $_REQUEST['prompt'];

    $response = sendChatGPTRequest($prompt);

    if(isset($response['error'])){
        $ajaxResponse = array(
            'status' => 'error',
            'code' => $response['error']['code'],
            'message' => $response['error']['message']
        );
        echo json_encode($ajaxResponse);die;
    }
    

    $reply = $response['choices'][0]['message']['content'];

   
    
    $orignal = $reply;
    $reply = str_replace(array("\n","\r"), '', $reply);
    $reply = str_replace(array("```json","```"), '', $reply);

    //echo $reply;exit;

    //$pattern = "/```(.*?)```/";
    $pattern = '/\[.*?\]/s';
    

    // Perform the regular expression match
    if (preg_match($pattern, $reply, $matches)) {
        
        $capturedString = $matches[0];

        $data = json_decode($capturedString,true);

        if ($data !== null && json_last_error() === JSON_ERROR_NONE) {

            $html = '<ul>';
           
            foreach ($data as $key => $value) {
                
               $html .= '<li>'.$value.'</li>';
            }
            $html .= '</ul>';

            $ajaxResponse = array(
                'status' => 'ok',
                'html' => $html,
                'object' => $data,
                'orginal' => $orignal,
                'prompt' => $prompt
            );
        } else {
            $ajaxResponse = array(
                'status' => 'error',
                'prompt' => $prompt,
                'html' => 'It looks like the call timed out. Please try again!'
            );
        }
    }else{
        $ajaxResponse = array(
            'status' => 'error',
            'prompt' => $prompt,
            'html' => 'It looks like the call timed out. Please try again!'
        );
    }

    echo json_encode($ajaxResponse);
    exit;

}
add_action('wp_ajax_sqb_ai_generate_quiz_title', 'SQBAIGenerateQuizTitle');

function SQBAIGenerateQuizTitle(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $title = $_POST['quiz_title'];
    $quiz_goal = $_POST['quiz_goal'];
    $quiz_lang = !empty($_REQUEST['quiz_lang']) ? $_REQUEST['quiz_lang'] : 'English';
    $chatgpt_survay_goal = !empty($_REQUEST['chatgpt_survay_goal']) ? $_REQUEST['chatgpt_survay_goal'] : '';
    $chatgpt_survaycontent = !empty($_REQUEST['chatgpt_survaycontent']) ? $_REQUEST['chatgpt_survaycontent'] : '';
    
    $quiz_title_prompt = $_POST['quiz_title_prompt'];

    $prompt_type = $_POST['prompty_type'];
    $quiz_type = $_POST['quiz_type'];

    $ajaxResponse = array();

    $data_ai_prompt = get_openAI_prompts_array();

    if($prompt_type == 'prompt'){
        $prompt_message = $quiz_title_prompt;
    }else{

        if($quiz_type == 'scoring'){
            $title_prompt = $data_ai_prompt['title_prompt_scoring'];
        }elseif($quiz_type == 'survey'){
            $title_prompt = $data_ai_prompt['title_prompt_survey'];
        }else{
            $title_prompt = $data_ai_prompt['title_prompt_personality'];
        }

        $title_prompt = str_replace('%%LANG_MSG%%','\n Response in '.$quiz_lang,$title_prompt);
        if($quiz_type == 'survey'){
            $title_prompt = str_replace('[topic]',$chatgpt_survay_goal,$title_prompt);
            $title_prompt = str_replace('%%PRODUCT_DETAIL%%',$chatgpt_survaycontent,$title_prompt);
            
        }else{
            $title_prompt = str_replace('[topic]',$quiz_goal,$title_prompt);
        }
        
        $prompt_message = $title_prompt;

        /*$quiz_lang_m = 'Response in '.$quiz_lang.'\n\n';
        $prompt_message = '
        I would like to create a personality quiz on the topic of '.$title.'.\n\n

        '.$quiz_lang_m.'

        Help me generate 10 engaging quiz titles.\n\n
        Draw inspiration from the following examples:\n\n
    
        What type of (topic) is right for you?\n
        How much do you know about (topic)\n
        Which (topic) are you?\n
        What is your (topic) style?\n
        What kind of (topic) are you?\n
        What type of (topic) should you create?\n';*/
    }

    $prompt = '
    
    '.$prompt_message.'

    Give me the quiz titles and short description in JSON format specific format like this \n
    
    [{"title":"title 1", "description" : "description 1"}, {"title":"title 2", "description" : "description 2"}...] ';
    
    
    $response = sendChatGPTRequest($prompt);


    if(isset($response['error'])){
        $ajaxResponse = array(
            'status' => 'error',
            'code' => $response['error']['code'],
            'message' => $response['error']['message']
        );
        echo json_encode($ajaxResponse);die;
    }
    

    $reply = $response['choices'][0]['message']['content'];
    $orignal = $reply;
    $reply = str_replace(array("\n","\r"), '', $reply);
    $reply = str_replace(array("```json","```"), '', $reply);

    //echo $reply;exit;

    //$pattern = "/```(.*?)```/";
    $pattern = '/\[.*?\]/s';


    // Perform the regular expression match
    if (preg_match($pattern, $reply, $matches)) {
        
        $capturedString = $matches[0];

        $data = json_decode($capturedString,true);

        if ($data !== null && json_last_error() === JSON_ERROR_NONE) {

            $html = '<ul>';
           
            foreach ($data as $key => $value) {
                
               $html .= '<li data-desc="'.$value['description'].'">'.$value['title'].'</li>';
            }
            $html .= '</ul>';

            $ajaxResponse = array(
                'status' => 'ok',
                'html' => $html,
                'object' => $data,
                'orginal' => $orignal,
                'prompt' => $prompt
            );
        } else {
            $ajaxResponse = array(
                'status' => 'error',
                'prompt' => $prompt,
                'html' => 'It looks like the call timed out. Please try again!'
            );
        }
    }else{
        $ajaxResponse = array(
            'status' => 'error',
            'prompt' => $prompt,
            'html' => 'It looks like the call timed out. Please try again!'
        );
    }

    echo json_encode($ajaxResponse);
    exit;

}

add_action('wp_ajax_sqb_ai_generate_quiz_questions', 'SQBAIGenerateQuizQuestion');

function SQBAIGenerateQuizQuestion(){
    
    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }


    $title = $_POST['quiz_title'];
    $quiz_type = $_POST['object']['quiz_type'];
    $question_single_limit = $_POST['question_single_limit'];
    $question_multi_limit = $_POST['question_multi_limit'];
    $question_open_limit = $_POST['question_open_limit'];
    $question_ratingscale_limit = $_POST['question_ratingscale_limit'];
    $quiz_lang = !empty($_REQUEST['quiz_lang']) ? $_REQUEST['quiz_lang'] : 'English';
    $chatgpt_survay_goal = !empty($_REQUEST['chatgpt_survay_goal']) ? $_REQUEST['chatgpt_survay_goal'] : '';
    $chatgpt_survaycontent = !empty($_REQUEST['chatgpt_survaycontent']) ? $_REQUEST['chatgpt_survaycontent'] : '';

    $question_limit = $question_single_limit + $question_multi_limit + $question_open_limit + $question_ratingscale_limit;

    $array = array();

    $q_ideal = $_POST['q_ideal'];

    if($q_ideal == 'ai_question'){

        $array[] = ($question_single_limit > 0) ? 'single choice question(s)' : '';
    $array[] = ($question_multi_limit > 0) ? '['.$question_multi_limit.'] multiple choice question(s)' : '';
    $array[] = ($question_open_limit > 0) ? '['.$question_open_limit.'] open ended question(s)' : '';
    $array[] = ($question_ratingscale_limit > 0 && $quiz_type != 'scoring') ? '['.$question_ratingscale_limit.'] Rating-Scale question(s) (scale of 5) with min and max text' : '';

    }else{

    $array[] = ($question_single_limit > 0) ? 'single choice question(s)' : '';
    $array[] = ($question_multi_limit > 0) ? 'multiple choice question(s)' : '';
    $array[] = ($question_open_limit > 0) ? 'open ended question(s)' : '';
    $array[] = ($question_ratingscale_limit > 0 && $quiz_type != 'scoring') ? 'Rating-Scale question(s) (scale of 5) with min and max text' : '';
    }

    if($quiz_type == 'survey'){
        foreach ($array as $key => $av) {
            $array[$key] = ''.$array[$key];
            $array[$key] = str_replace('[','',$array[$key]);
            $array[$key] = str_replace(']','',$array[$key]);
        }
    }

    $question_limit_p = implode('\n',$array);

    $type_array = array();

    if($question_single_limit > 0){
        $type_array[] = 'single';
    }
    if($question_multi_limit > 0){
        $type_array[] = 'multiple';
    }
    if($question_open_limit > 0){
        $type_array[] = 'open';
    }
    if($question_ratingscale_limit > 0 && $quiz_type != 'scoring'){
        $type_array[] = 'rating';
    }


    $type_array_p = implode(', ',$type_array);

    $additional = isset($_POST['chatgpt_question_additional']) ? ' In addition, '.$_POST['chatgpt_question_additional'] : '';

    $ajaxResponse = array();

    $data_ai_prompt = get_openAI_prompts_array();

    if($quiz_type == 'scoring'){
        $question_red_message = $data_ai_prompt['question_prompt_scoring'];
        $question_red_message = str_replace('%%JSON_CODE%%','```json'.$data_ai_prompt['questions_scoring_prompt_json'].'```',$question_red_message);
        $question_red_message = str_replace('{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","answer" : "2"...,"answer" : "5"}','{\n"question": "",\n"type": "",\n"answers": [{"answer" : "","points":"","correct":"true"}]}',$question_red_message);
        
    }elseif($quiz_type == 'survey'){
        $question_red_message = $data_ai_prompt['question_prompt_survey'];
        $question_red_message = str_replace('%%JSON_CODE%%','```json'.$data_ai_prompt['questions_survey_prompt_json'].'```',$question_red_message);

        if($question_ratingscale_limit < 1){
            $question_red_message = str_replace('{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","answer" : "2"...,"answer" : "5"}','{\n"question": "",\n"type": "",\n"answers": [{"answer" : ""}]}',$question_red_message);
        }
        
    }else{
        $question_red_message = $data_ai_prompt['question_prompt'];
        $question_red_message = str_replace('%%JSON_CODE%%','```json'.$data_ai_prompt['questions_personality_prompt_json'].'```',$question_red_message);

        if($question_ratingscale_limit < 1){
            $question_red_message = str_replace('{\n"question": "",\n"type": "rating",\n"min-max-text" :[] \n"answers": [{"answer" : "1","outcome":""},...,{"answer" : "5","outcome":""}]','{\n"question": "",\n"type": "single/multiple/open",\n"answers": [{"answer" : "","outcome":""}]',$question_red_message);
        }

    }

    $question_red_message = str_replace('%%SELECTED_TYPE%%',$type_array_p, $question_red_message);

    $prompt_type = $_POST['prompt_type'];
    $chatgpt_question_prompt = $_POST['chatgpt_question_prompt'];

    $ptitle = array();
    
    foreach ($_POST['object']['sel_outcomes'] as $key => $value) {
        $ptitle[] = $value['title'];
    }

    $ptitle_t = implode('\n',$ptitle);

    $ajaxResponse = array();


    $q_ideal = $_POST['q_ideal'];
    if($q_ideal == 'ai_question'){

        if($prompt_type == 'prompt'){
            
            if($quiz_type == 'scoring'){

                $coor_ans = @$_REQUEST['coor_ans'];

                if($coor_ans == 'yes'){
                    $prompt_message = $chatgpt_question_prompt.'\n\nOutcome Titles:\n'.$ptitle_t.'\n\nCorrect answer should be 1 point.\n\n';
                }else{
                    $prompt_message = $chatgpt_question_prompt.'\n\nOutcome Titles:\n'.$ptitle_t.'\n\n';
                }
            
            }else if($quiz_type == 'survey'){
                $prompt_message = $chatgpt_question_prompt.'\n\n';
            }else{
                $prompt_message = $chatgpt_question_prompt.'\n\nI want answer mapped to an outcome with these outcome title\n'.$ptitle_t.'\n\n';
            }
            $prompt_message = str_replace('%%SELECTED_TYPE%%',$type_array_p, $prompt_message);
        }else{

            if($quiz_type == 'survey'){
                $prompt_message = $data_ai_prompt['question_prompt_survey_editable'];
                $prompt_message = str_replace(' %%ADDITIONAL%%',$chatgpt_survay_goal, $prompt_message);
                $prompt_message = str_replace('%%SURVEYDESCRIBE%%',$chatgpt_survaycontent, $prompt_message);
                $prompt_message = str_replace('%%TITLE%%',$title, $prompt_message);
                $prompt_message = str_replace('%%QUIZ_LANG%%',$quiz_lang, $prompt_message);
                $prompt_message = str_replace('%%OUTCOME_CONTENT%%','', $prompt_message);
                $prompt_message = str_replace('%%QTYPE%%','', $prompt_message);
                $prompt_message = str_replace('<span>%%HARDCODE_TEXT%%</span>','', $prompt_message);
                $prompt_message = str_replace('%%TOTAL%%',$question_limit, $prompt_message);
                $prompt_message = str_replace('%%TYPE%%',' \n'.$question_limit_p.'\n\n', $prompt_message);
            
            }else{

                if(isset($_REQUEST['more_question'])){
                    $title_p = "I need some additional questions and answers for my quiz titled - ".$title;
                }else{
                    $title_p = 'Need quiz questions and answers for my quiz titled';
                }
            
                $chatgpt_goal = !empty($_REQUEST['chatgpt_goal']) ? ''.$_REQUEST['chatgpt_goal'].'' : '';
                $prompt_message = $title_p."\nGive me back ideal number of questions and relevant answers for this keeping in mind these criteria / rules:\n\n";

                $prompt_message .=  "Here\'s the quiz title and rules:\n";
                $prompt_message .=  "Quiz Title:\n".$title."\n";
                $prompt_message .=  "Rule 1: I want only these types of questions:\n".$question_limit_p."\n\n";
                $prompt_message .=  "Rule 2:\nMax limit of questions: 15 \n\n";
                $prompt_message .=  "Rule 3:\nLanguage: Response in ".$quiz_lang."\n\n";
                $prompt_message .=  "Rule 4:\nKeep in mind these are my outcomes\n\n";


                if($quiz_type == 'personality'){
                    $prompt_message .= "I want answer mapped to an outcome with those outcome title\n".$ptitle_t."\n\n";
                }else if($quiz_type == 'survey'){
                    $prompt_message .= "Outcome Titles:\n".$ptitle_t."\n\n";
                }else{
                    $prompt_message .= "Outcome Titles:\n".$ptitle_t."\n\n";
                    $prompt_message .= "Correct answer should be 1 point.\n\n";
                }
                
                //$prompt_message .= 'Language: Response in '.$quiz_lang.'\n';
                $prompt_message .= "Goal: ".$chatgpt_goal."\n";
            }
            
        }

    }else{

        if($prompt_type == 'prompt'){
            
            if($quiz_type == 'scoring'){
                
                $coor_ans = @$_REQUEST['coor_ans'];

                if($coor_ans == 'yes'){
                    $prompt_message = $chatgpt_question_prompt."\n\nOutcome Titles:\n".$ptitle_t."\n\nCorrect answer should be 1 point.\n\n";
                }else{
                    $prompt_message = $chatgpt_question_prompt."\n\nOutcome Titles:\n".$ptitle_t."\n\n";
                }
            
            }else if($quiz_type == 'survey'){
                $prompt_message = $chatgpt_question_prompt."\n\n";
            }else{
                $prompt_message = $chatgpt_question_prompt."\n\nI want answer mapped to an outcome with these outcome title\n".$ptitle_t."\n\n";
            }
            $prompt_message = str_replace('%%SELECTED_TYPE%%',$type_array_p, $prompt_message);
        }else{

            if($quiz_type == 'survey'){
                $prompt_message = $data_ai_prompt['question_prompt_survey_editable'];
                $prompt_message = str_replace(' %%ADDITIONAL%%',$chatgpt_survay_goal, $prompt_message);
                $prompt_message = str_replace('%%SURVEYDESCRIBE%%',$chatgpt_survaycontent, $prompt_message);
                $prompt_message = str_replace('%%TITLE%%',$title, $prompt_message);
                $prompt_message = str_replace('%%QUIZ_LANG%%',$quiz_lang, $prompt_message);
                $prompt_message = str_replace('%%OUTCOME_CONTENT%%','', $prompt_message);
                $prompt_message = str_replace('%%QTYPE%%','', $prompt_message);
                $prompt_message = str_replace('<span>%%HARDCODE_TEXT%%</span>','', $prompt_message);
                $prompt_message = str_replace('%%TOTAL%%',$question_limit, $prompt_message);
                $prompt_message = str_replace('%%TYPE%%',' \n'.$question_limit_p.'\n\n', $prompt_message);
            
            }else{

                if(isset($_REQUEST['more_question'])){
                    $title_p = "I need some additional questions and answers for my quiz titled - ".$title;
                }else{
                    $title_p = "Need quiz questions and answers for my quiz titled - ".$title;
                }
            
                $chatgpt_goal = !empty($_REQUEST['chatgpt_goal']) ? ''.$_REQUEST['chatgpt_goal'].'' : '';
                $prompt_message = $title_p."\n
                Total questions: [".$question_limit."]\n\nOnly these question types:\n".$question_limit_p."\n\nOnly give back relevant questions and answers.\n\n";

                if($quiz_type == 'personality'){
                    $prompt_message .= "I want answer mapped to an outcome with those outcome title\n".$ptitle_t."\n\n";
                }else if($quiz_type == 'survey'){
                    $prompt_message .= "Outcome Titles:\n".$ptitle_t."\n\n";
                }else{
                    $prompt_message .= "Outcome Titles:\n".$ptitle_t."\n\n";
                    $prompt_message .= "Correct answer should be 1 point.\n\n";
                }
                
                $prompt_message .= "Language: Response in ".$quiz_lang."\n";
                $prompt_message .= "Goal: ".$chatgpt_goal."\n";
            }
            
        }

    }

    $prompt_message .= $question_red_message;

    $qmessage = '';
    if($quiz_type == 'scoring'){

        $qmessage = ',"points":"","correct":"true"';
    
    }else{
        $qmessage = ',"outcome":""';
    }

    $prompt = '
    
    '.$prompt_message.'';


    

    $response = sendChatGPTRequest($prompt);
    


    if(isset($response['error'])){
        $ajaxResponse = array(
            'status' => 'error',
            'code' => $response['error']['code'],
            'message' => $response['error']['message'],
            'prompt' => $prompt
        );
        echo json_encode($ajaxResponse);die;
    }

    $reply = $response['choices'][0]['message']['content'];
    $orignal = $reply;

    $reply = $response['choices'][0]['message']['content'];
    $orignal = $reply;
    $reply = str_replace(array("\n","\r","\t"), '', $reply);

    $reply = str_replace('\n','',$reply);
	$reply = str_replace('\t','',$reply);
	$reply = str_replace('\r','',$reply);
	$reply = stripslashes($reply);

    $reply = str_replace("```json","```", $reply);
    $reply = str_replace("```JSON","```", $reply);
    $reply = str_replace("[ {", '[{', $reply);
    $reply = str_replace("[    {", '[{', $reply);
   
    $reply = trim($reply);
    $reply = stripslashes($reply);
   
    if(strpos($reply, "```json") !== false){
        $pattern = "/```json(.*?)```/";
    }else if(strpos($reply, "```") !== false){
        $pattern = "/```(.*?)```/";
    }else{
        $pattern = '/(\[{.*?}\])/s';
    }

    //echo $reply;exit;

    /*preg_match($pattern, $reply, $matches);

    echo '<pre>';
    print_r($matches[1]);
    exit;*/
    

   //echo $reply;exit;

   // echo $reply;
    //$pattern = "/```(.*?)```/";
    //$pattern = '/\[{.*?\}]/s';

    // Perform the regular expression match
    if (preg_match($pattern, $reply, $matches)) {
    
        $capturedString = $matches[1];

        $data = json_decode($capturedString,true); 

        if ($data !== null && json_last_error() === JSON_ERROR_NONE) {

            $html = '';

            if($quiz_type == 'scoring'){
                $questions = $data['questions'];
            }else{
                $questions = $data;
            }

            foreach ($questions as $key => $question) {

                $index = $key+1;
                $typslug = 'single';
                
                if($question['type'] == 'single'){
                    $type = 'Single';
                    $typslug = 'single';
                }else if($question['type'] == 'multiple'){
                    $type = 'Multiple';
                    $typslug = 'multi';
                }else if($question['type'] == 'open'){
                    $type = 'Open';
                    $typslug = 'text';
                }else if($question['type'] == 'rating'){
                    $type = 'Rating';
                    $typslug = 'rating';
                }

                if($quiz_type == 'scoring'){
                    $data['questions'][$key]['type'] = $typslug;
                }else{
                    $data[$key]['type'] = $typslug;
                }
                

                $answer_html = '';
                if(!empty($question['answers'])){
                    
                    if($typslug != 'rating'){
                    shuffle($question['answers']);
                    }

                    foreach ($question['answers'] as $key => $answer) {
                        if(!empty($answer['answer'])){
                            $answer_html .= '<div class="sqb-cg-qa-item">'.$answer['answer'].'</div>';
                        }
                    }
                }

                $head = '';
                if(!empty($answer_html)){
                    $head = '<div class="sqb-cg-qa-lbl">Answers : </div>';
                }

                $html .= '<li class="gpt-questiontype-'.$typslug.'">
                <input class="quiz_checkbox" name="chatgpt_question_list[]" type="checkbox" value="1">
                <div class="chagpt-single_quiz_card">
                <div class="sqb-gpt-qt-wrapper"><div class="sqb-gpt-qt-lbl">'.$type.'</div></div>
                <div class="sqb-cg-question">'.$question['question'].' <i>('.$type.')</i></div>
                <div class="sqb-cg-qa">'.$head.'<div class="sqb-cg-qa-data">'.$answer_html.'</div></div>
                </div>
                </li>';
            }
            $html .= '';

            $ajaxResponse = array(
                'status' => 'ok',
                'html' => $html,
                'object' => $data,
                'orginal' => $orignal,
                'prompt' => $prompt
            );
        } else {
            $ajaxResponse = array(
                'status' => 'error',
                'message' => 'It looks like the call timed out. Please try again!',
                'html' => '',
                'orginal' => $orignal,
                'prompt' => $prompt
            );
        }
    }else{
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'It looks like the call timed out. Please try again!',
            'html' => '',
            'orginal' => $orignal,
            'prompt' => $prompt
        );
    }

    echo json_encode($ajaxResponse);
    exit;

}


function sendChatGPTRequest($message) {
    $openaiToken = get_option('sqb_chat_gpt_api_key', '');
    $openaiModel = get_option('sqb_chat_gpt_api_model', 'gpt-3.5-turbo-16k');
    $model = $openaiModel;
    $url = 'https://api.openai.com/v1/chat/completions';

    $data = array(
        'model' => $model,
        'messages' => array(
            array('role' => 'system', 'content' => 'You are a helpful assistant.'),
            array('role' => 'user', 'content' => $message)
        )
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $openaiToken
    );

    $dataString = json_encode($data);

    try {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, 180); // 180 seconds timeout

        $response = curl_exec($ch);


        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);

        if ($status_code === 200) {
            $responseData = json_decode($response, true);
        } else if($status_code === 504){
            throw new Exception("Gateway Timeout Error: " . $status_code);
        }else{
            $responseData = json_decode($response, true);
           
            if(isset($responseData['error'])){
                return $responseData;
            }else{
                throw new Exception("Something went to wrong: " . $status_code);
            }
        }
    } catch (Exception $e) {
        // Handle the exception or log the error
        $errorMessage = $e->getMessage();
        $responseData = array();
        $responseData['error'] = array(
            'status' => 'error',
            'code' => $status_code,
            'message' => $errorMessage
        );
    }

    return $responseData;
}


/*function sendChatGPTRequest($message) {
    $openaiToken = get_option('sqb_chat_gpt_api_key', '');
    $model = 'gpt-3.5-turbo';
    $url = 'https://api.openai.com/v1/chat/completions';

    $data = array(
        'model' => $model,
        "max_tokens" => 3000,
        'messages' => array(
            array('role' => 'system', 'content' => 'You are a helpful assistant.'),
            array('role' => 'user', 'content' => $message)
        )
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $openaiToken
    );

    $responseData = array();
    $pageToken = null;

    do {
        $data['messages'][0]['content'] = $message; // Update message content

        if ($pageToken) {
            $data['messages'][] = array('role' => 'assistant', 'content' => '');
            $data['pagination_token'] = $pageToken;
        }

        $dataString = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            // Handle error
            return null;
        }

        $responseData[] = json_decode($response, true);
        $pageToken = $responseData[count($responseData) - 1]['choices'][0]['message']['pagination_token'];

    } while ($pageToken);


    if(!empty($responseData)){
        $responseData = $responseData[0];
    }
    

    return $responseData;
}
*/


add_action('wp_ajax_sqb_ai_generate_quiz_pdf', 'SQBAIGenerateQuizPDF');

function SQBAIGenerateQuizPDF(){

    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $html = '';

    require_once SQB_PD_DIR.'/inc/dompdf/autoload.inc.php';
    // reference the Dompdf namespace  

    $titles = !empty($_POST['titles']) ? $_POST['titles'] : '';
    if(!empty($titles)){
        $titles_html = '<h1>Here is the quiz titles</h1>';
        $titles_html .= '<ul>';
        foreach ($titles as $key => $title) {
            $titles_html .= '<li>'.$title.'</li>';
        }
        $titles_html .= '</ul>';
    }

    $questions = !empty($_POST['sel_questions']) ? $_POST['sel_questions'] : '';

    if(!empty($questions)){
        $questions_html = '<h1>Here are the quiz questions</h1>';

        $questions_html .= '<div>';
        foreach ($questions as $key => $question) {
            $questions_html .= '<p><strong>'.$question['question'].'</strong></p>';
            $questions_html .= '<ul>';
            foreach ($question['answers'] as $key => $answer) {
                if(!empty($answer['answer'])){
                    $questions_html .= '<li>'.$answer['answer'].'</li>';
                }
            }
            $questions_html .= '</ul>';
        }
        $questions_html .= '</div>';

    }

    $outcomes = !empty($_POST['sel_outcomes']) ? $_POST['sel_outcomes'] : '';

    if(!empty($outcomes)){
        $outcomes_html = '<h1>Here are the quiz Outcomes</h1>';

        $outcomes_html .= '<div>';
        foreach ($outcomes as $key => $outcomes) {
            $outcomes_html .= '<p><strong>'.$outcomes['title'].'</strong></p>';
            $outcomes_html .= '<p>'.$outcomes['description'].'</p>';
            $outcomes_html .= '<p>'.$outcomes['call_to_action'].'</p>';
            $outcomes_html .= '<p></p>';
        }
        $outcomes_html .= '</div>';

    }

    $body = $titles_html.$questions_html.$outcomes_html;

    $body = $str = preg_replace('/\\\\(.?)/', '$1', $body);

    $font_url = site_url().'/wp-content/plugins/smartquizbuilder/includes/frontend/';
    $html = '
    <html>
        <head>  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        </head>
        ';

    $html .= '
        <body>
            '.$body.'
            <style> body{margin: 0;} </style>
        </body>
    </html>';  

    // instantiate and use the dompdf class
    $dompdf = new Dompdf(array('enable_remote' => true));
    $dompdf->loadHtml($html); 
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    //$dompdf->stream($filename,array("Attachment"=>0));
  
    $filename = "chatgpt-content";
    $dompdf->stream($filename);
    exit;
      
}


add_action('wp_ajax_generate_ai_pdf_content_api', 'SQBGenerateAIPDFContent');

function SQBGenerateAIPDFContent(){
    
    if (!current_user_can( 'manage_options' ) ) {
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'Not authorized'
        );
        echo json_encode($ajaxResponse);exit;
    }

    $prompt = $_REQUEST['prompt'];
    
    $response = sendChatGPTRequest($prompt);

    if(isset($response['error'])){
        $ajaxResponse = array(
            'status' => 'error',
            'code' => $response['error']['code'],
            'message' => $response['error']['message']
        );
        echo json_encode($ajaxResponse);die;
    }

    $reply = $response['choices'][0]['message']['content'];
    $orignal = $reply;
    $reply = str_replace(array("```HTML",""), '', $reply);
    $reply = str_replace(array("```",""), '', $reply);


    //$pattern = "/```HTML(.*?)```/";
    
    $ajaxResponse = array(
        'status' => 'ok',
        'html' => '',
        'object' => $reply,
        'orginal' => $orignal,
        'prompt' => $prompt
    );

    // Perform the regular expression match
    /*if (preg_match($pattern, $reply, $matches)) {
        
        $capturedString = $matches[0];

        $data = ($capturedString);

        $ajaxResponse = array(
            'status' => 'ok',
            'html' => '',
            'object' => $data,
            'orginal' => $orignal,
            'prompt' => $prompt
        );
    }else{
        $ajaxResponse = array(
            'status' => 'error',
            'message' => 'It looks like the call timed out. Please try again!',
            'html' => '',
            'orginal' => $orignal,
            'prompt' => $prompt
        );
    }*/
    echo json_encode($ajaxResponse);
    exit;

}
function sqb_get_question_data($title, $template, $question_data){

    //if($template == 'template6' || $template == 'template8' || $template == 'template7' || $template == 'template9' || $template == 'template5'){
        $hide_class = 'style="display:none;"';
    //}
    $hide_description = "";
    if($template == 'template5'){
        $hide_description = 'style="display:none;"';
    }

    $rating_data = $question_data['min-max-text'];

    $u_wrapper_id = 'sbq_img_'.date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999);
    $rand_number = date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999);

    $html = '<div class="question_details">
					  	
    <div class="sqb_question_drag_drop_item question_title sqb_tiny_mce_editor Quiz-Template-title"><div>Enter Your Question Here</div></div>
        <span class="sqbHideQuesTemplateImageOuter" '.$hide_class.'><button class="sqbHideQuesTemplateImage">Hide Image</button></span>
        <span class="sqbShowQuesTemplateImageOuter"><button class="sqbShowQuesTemplateImage">Show Image</button></span>
        <span class="sqbDeleteQuesTemplateImageOuter" '.$hide_class.'><button class="sqbDeleteQuesTemplateImage">Delete Image</button></span>
        <span class="sqbAddQuesTemplateImageOuter" style="display:none"><button class="sqbAddQuesTemplateImage" attr-img-src="'.SQB_URL.'/includes/images/sqb_quiz.png">Add Image</button></span>
        
    <div class="sqb_question_drag_drop_item question_img_div Quiz-Template-image ui-resizable" id="sbq_img_outer_'.$rand_number.'" '.$hide_class.'>
    
        <img class="sqb_img_draggable '.$u_wrapper_id.' ui-draggable ui-draggable-handle" src="'.SQB_URL.'/includes/images/sqb_quiz.png" style="position: relative;">
        <span data-class="'.$u_wrapper_id.'" class="question_img_upload sbq_change_img"><i class="fa fa-camera" aria-hidden="true"></i></span>
    </div>
    <div class="video-element-outer questionTemplateVideoOuter ui-resizable" data-type="outcome" style="display:none">
        <input type="hidden" class="question_video_url" value="">
        <input type="hidden" class="question_show_video" value="N">
        <input type="hidden" class="question_video_link_type" value="0">
        <input type="hidden" class="question_video_link_type_text" value="Source">
        <input type="hidden" class="question_video_aspect" value="1">

        <a href="javascript:void(0)" class="questionTemplateVideoOuterLinkOver insertOutcomeVideo" data-type="question">1</a>
        <div class="video-add-link questionTemplateInsertVideoOuter" style="display:none">
            <a href="javascript:void(0)" class="insertQuestionVideo" data-type="question"><i class="fa fa-file-video-o" aria-hidden="true"></i> Insert Video</a>
        </div>
        <div class="yt-videoWrapper questionTemplateYoutubeVideoOuter" style="display:none">
            <iframe width="560" height="315" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
        </div>
        <div class="external-videoWrapper questionTemplateCommonVideoOuter" style="display:none">
            <video width="400" controls="">
            </video>
        </div>
    </div>
    <span class="sqbHideQuesDescriptionOuter" '.$hide_description.'><button class="sqbHideQuesDescription">Hide Description</button></span>
    <span class="sqbShowQuesDescriptionOuter" style="display:none"><button class="sqbShowQuesDescription">Show Description</button></span>
    <div class="sqb_question_drag_drop_item Quiz-Template-content question_description sqb_tiny_mce_editor mce-content-body" id="mce_89" contenteditable="true" spellcheck="false" style="position: relative; display: none;"><div>Enter any additional information about the quiz</div></div>
                            
   </div>';

   $html = str_replace('Enter Your Question Here',$title,$html);
   return $html;
}

function sqb_get_answer_data($title,$type = 'single', $answer_point='0', $correct_ans = ''){

    $sqb_round_no = ''.date('Y').'_'.date('F').'_'.time().'_'.rand(0,9999)*10000;

    $sqb_ans_empty_img = SQB_URL.'/includes/images/sqb_empty.jpg';
	
	$currect_ans_checkbox_show = 'style="display:none"';
	$points_ans_checkbox_show = 'style="display:none"';
	$ans_recommendation_display = "display:none";
	$ans_tag_display = "display:none";

    if($correct_ans == 'true'){
        $show_checked = "checked='checked'";
    }else{
        $show_checked = "";
    }

	$answer_level_dot_option_html_single = '<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="'.$ans_recommendation_display.'"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="'.$ans_tag_display.'"><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style="'.$ans_tag_display.'"><strong>View All Assigned Tags</strong></a></div></div></div>';

    if($type == 'single'){

        $html = '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_round_no.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style=""><img src="'.$sqb_ans_empty_img.'" class="sbq_change_img img_'.$sqb_round_no.'" data-class="img_'.$sqb_round_no.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_77" contenteditable="true" style="position: relative;" spellcheck="false"><div>Type Answer Here</div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" %%sqbanswercorrect%%="" name="sqb_is_right_ans_'.$sqb_round_no.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1" '.$show_checked.'> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="'.$answer_point.'"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style=""><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style=""><strong>View All Assigned Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_round_no.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
    }else if($type == 'multi'){
        $html = '<div class="sqb_ans_item" data-id="%%ANSWERID%%" id="'.$sqb_round_no.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style=""><img src="'.$sqb_ans_empty_img.'" class="sbq_change_img img_'.$sqb_round_no.'" data-class="img_'.$sqb_round_no.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_77" contenteditable="true" style="position: relative;" spellcheck="false"><div>Type Answer Here</div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" %%sqbanswercorrect%%="" name="sqb_is_right_ans_'.$sqb_round_no.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1" '.$show_checked.'> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1" value="'.$answer_point.'"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style=""><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style=""><strong>View All Assigned Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_round_no.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
    }else if($type == 'text'){
        $html = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='".$sqb_round_no."'><textarea class='sqb_and_field sqb_input_ans_field sqb_textarea_ans_field' name='sqb_ans_".$sqb_round_no."' placeholder='Enter the text here' ></textarea><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='".$sqb_round_no."'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
    }else if($type == 'rating'){
        $html = '<div class="sqb_ans_item ans_type_rating" data-id="%%ANSWERID%%" id="'.$sqb_round_no.'"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style=""><img src="'.$sqb_ans_empty_img.'" class="sbq_change_img img"'.$sqb_round_no.'" data-class="img"'.$sqb_round_no.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_50" contenteditable="true" style="position: relative;" spellcheck="false"><div style="text-align: center;" data-mce-style="text-align: center;">Type Answer Here</div></div></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds" style="display:none"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" %%sqbanswercorrect%%="" name="sqb_is_right_ans"'.$sqb_round_no.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds" style="display:none"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$sqb_round_no.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
    }
	

    /*$html = '<div class="sqb_ans_item ui-sortable-handle" data-id="%%ANSWERID%%" id="'.$u_wrapper_id.'" style="background: rgb(247, 247, 247);"><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img " style=""><img src="'.SQB_URL.'/includes/images/sqb_empty.jpg" class="sbq_change_img img_'.$u_wrapper_id.'" data-class="img_'.$u_wrapper_id.'"></figure><div class="sql_ans_text sqb_tiny_mce_editor mce-content-body" id="mce_92" contenteditable="true" style="position: relative;" spellcheck="false"><div>Type Answer Here</div></div><span class="sqbOpitionSelected"></span></div><div class="answer-options"><div class="answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds"><label>Correct Answer</label><div class="checkbox-custom-style"><input title="Correct Answer" type="checkbox" %%sqbanswercorrect%%="" name="sqb_is_right_ans_'.$u_wrapper_id.'" class="sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1 sqb_disable_tiny_mce_editor" sqbanswercorrect="" checked="checked"> <span class="custom--checkbox"></span></div></div><div class="answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds"><label>Enter Points</label><input type="text" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div><div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style=""><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style=""><strong>View All Assigned Tags</strong></a></div></div></div></div> <span class="sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'.$u_wrapper_id.'"><i class="fa fa-times" aria-hidden="true"></i></span></div>';*/

    $html = str_replace('Type Answer Here',$title,$html);
   return $html;
}