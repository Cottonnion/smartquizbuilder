<?php

function sqb_get_param($quiz_id,$key, $default=''){
	global $wpdb;
	$sqb_quiz = $wpdb->prefix .'sqb_quiz';
	$sql = "SELECT poll_settings FROM ".$sqb_quiz." WHERE id = '".$quiz_id."'";
	$param = $wpdb->get_var($sql);
	

	if(!empty($param)){
		$param = maybe_unserialize($param);
		if(!empty($param[0][$key])){
			return $param[0][$key];
		}
	}

	return $default;
}

function sqb_is_voted($quiz_id){


	//echo "string";exit;
	global $wpdb;
	$repeat_voting = sqb_get_param($quiz_id,'repeat_voting');
	$allow_voting = sqb_get_param($quiz_id,'allow_voting');

	if($repeat_voting == 'browser-based'){

		if(!empty($_COOKIE['vote_'.$quiz_id])){

			$sqb_manage_leads = $wpdb->prefix .'sqb_manage_leads';

			// Repeat vote
			if(!empty($allow_voting)){

				//date('Y-m-d h:i:s', strtotime('+1 hour'));
				$cookie_data = !empty($_COOKIE['vote_'.$quiz_id]) ? $_COOKIE['vote_'.$quiz_id] : array();
				$data = json_decode(stripslashes($cookie_data));
				$uid = $data->lead_rel;
				$sql = "SELECT count(id) FROM ".$sqb_manage_leads." WHERE quiz_id = '".$quiz_id."' AND date = '".$uid."' and DATE_ADD(date, INTERVAL ".$allow_voting." HOUR) < '".date('Y-m-d h:i:s')."' LIMIT 1";
				//echo $sql;exit;
				$id = $wpdb->get_var($sql);

				return !empty($id) ? 0 : 1;
			}

			return 1;
		}else{
			return 0;
		}

	}elseif($repeat_voting == 'browser-ip-based'){

		$ip = $_SERVER['REMOTE_ADDR'];
		$sqb_manage_leads = $wpdb->prefix .'sqb_manage_leads';
		$sql = "SELECT unique_id FROM ".$sqb_manage_leads." WHERE quiz_id = '".$quiz_id."' AND unique_id = '".$ip."' LIMIT 1";
		$unique_id = $wpdb->get_var($sql);
		//echo $wpdb->last_query;exit;
		
		if($unique_id == $ip){
			
			return 1;
		}else{
			return 0;
		}

	}elseif($repeat_voting == 'repeated-voting'){
		return 0;
	}

	/*if(!empty($_COOKIE['vote_'.$quiz_id])){
		return 1;
	}else{
		return 0;
	}*/
}

add_action('wp_ajax_sqb_view_result_poll', 'SQBViewResultPoll');
add_action('wp_ajax_nopriv_sqb_view_result_poll', 'SQBViewResultPoll');
function SQBViewResultPoll()
{

	$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : 0;
	
	$allow_viewing_result = sqb_get_param($quiz_id,'allow_viewing_result');

	if($allow_viewing_result != 'Y'){
		echo json_encode(array('count_vote' => 0,'html' => '','status' => 'error'));die;
	}

	$rows = get_poll_results($quiz_id);
	$total = array_reduce($rows, function($carry, $item) {
		    $carry += $item['cnt'];
		    return $carry;
		});
	$html = getVoteResultsFormated($quiz_id,$rows);
	//getVoteResultsFormated
	echo json_encode(array('count_vote' => $total,'counts' => $html,'status' => 'ok'));die;
}

add_action('wp_ajax_sqb_validate_poll', 'SQBValidatePoll');
add_action('wp_ajax_nopriv_sqb_validate_poll', 'SQBValidatePoll');
function SQBValidatePoll()
{
	$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : 0;


	$is_voting_open = is_voting_open($quiz_id);
	$is_poll_open = is_poll_open($quiz_id);
	$response = array();
	if(!$is_poll_open){
		$start_poll_html = sqb_get_param($quiz_id,'start_poll_html');
		$response = array('status' => 'error', 'message' => $start_poll_html);
	}else if(!$is_voting_open){
		$close_poll_html = sqb_get_param($quiz_id,'close_poll_html');
		$response = array('status' => 'error', 'message' => $close_poll_html);
	}else{
		$response = array('status' => 'ok', 'message' => 'Voting Open');
	}

	if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
		return $response;
	}else{
		echo json_encode($response);exit;
	}
}

add_action('wp_ajax_sqb_change_vote', 'SQBChangeVote');
add_action('wp_ajax_nopriv_sqb_change_vote', 'SQBChangeVote');
function SQBChangeVote(){

	global $wpdb;
	$sqb_manage_leads = $wpdb->prefix .'sqb_manage_leads';
	$sqb_users_quiz_details = $wpdb->prefix .'sqb_users_quiz_details';
	$quiz_id = $_POST['quiz_id'];

	$is_voting_open = is_voting_open($quiz_id);

	if(!$is_voting_open){
		echo json_encode(array('status' => 'error', 'message' => 'Voting Closed'));exit;
	}

	$repeat_voting = sqb_get_param($quiz_id,'repeat_voting');

	if($repeat_voting == 'browser-based'){
		$cookie_data = !empty($_COOKIE['vote_'.$quiz_id]) ? $_COOKIE['vote_'.$quiz_id] : array();
		$data = json_decode(stripslashes($cookie_data));
		$uid = $data->lead_rel;
	}elseif($repeat_voting == 'browser-ip-based'){

		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = "SELECT date FROM ".$sqb_manage_leads." WHERE unique_id = '".$ip."' AND quiz_id = '".$quiz_id."'";
		$uid = $wpdb->get_var($sql);
		//echo $uid;exit;

	}elseif($repeat_voting == 'repeated-voting'){

	}

	if(!empty($uid)){
		
		$sql = "SELECT date FROM ".$sqb_manage_leads." WHERE date = '".$uid."' AND quiz_id = '".$quiz_id."'";
		$row_id = $wpdb->get_var($sql);


		if(!empty($row_id))	{

			if($repeat_voting == 'browser-based'){
				unset($_COOKIE['vote_'.$quiz_id]);
	    		setcookie('vote_'.$quiz_id, '', time() - 3600, '/');
	    	}

    		//print_r(array( 'date' => $row_id, 'quiz_id' => $quiz_id));exit;
			$wpdb->delete( $sqb_manage_leads, array( 'date' => $row_id, 'quiz_id' => $quiz_id) );
			$wpdb->delete( $sqb_users_quiz_details, array( 'date' => $row_id, 'quiz_id' => $quiz_id ) );

    		echo json_encode(array('status' => 'ok', 'count_vote' => get_poll_vote_count($quiz_id)));exit;
		}
	}
	echo json_encode(array('status' => 'error', 'count_vote' => get_poll_vote_count($quiz_id)));exit;
}

add_action('wp_ajax_sqb_vote', 'SQBVote');
add_action('wp_ajax_nopriv_sqb_vote', 'SQBVote');

function get_poll_vote_count($quiz_id){

	$result = get_poll_results($quiz_id);

	$total = array_reduce($result, function($carry, $item) {
	    $carry += $item['cnt'];
	    return $carry;
	});
	return $total;
}


function getVoteResultsFormated($quiz_id,$counts){

	$sqbObj =  SQB_Quiz::loadById($quiz_id);  
	$show_vote_count_content = sqb_get_param($quiz_id,'show_vote_count','Vote(s)');
	$hide_results = sqb_get_param($quiz_id,'hide_results');

	$total = array_reduce($counts, function($carry, $item) {
			    $carry += $item['cnt'];
			    return $carry;
			});

	$template_num = $sqbObj->getTemplate();	
	$bg_color = '#5269e9';
	$text_color = '#000000';
	if($template_num == 'template8'){
		$style = 'style="max-width:'.$temp_customizer[1].'"';
		$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
		if(!empty($customizer_style_settings["vote_selected_bg_color"])){
			$bg_color = $customizer_style_settings["vote_selected_bg_color"];
		}
	}else{

		if($sqbObj->getTransparentBackgroundSettings() != ''){

			$get_settings = $sqbObj->getTransparentBackgroundSettings();
			$get_details = explode("|",$get_settings);
			$bg_color = $get_details[6];
			$text_color = $get_details[13];
			
		}

		$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());
		if(!empty($customizer_style_settings["vote_selected_bg_color"])){
			$bg_color = $customizer_style_settings["vote_selected_bg_color"];
		}
	}

	foreach ($counts as $key => $answer) {
		
		$counts[$key]['per'] = ($total > 0) ? round((100*$answer['cnt']) / $total,2) : 0;

		$per = $counts[$key]['per'].'%';
		$cnt = $answer['cnt'].' '.$show_vote_count_content;
		$class = 'voteRange-result-data';

		$hide_number = sqb_get_param($quiz_id,'hide_number');
		
		if($hide_number == 'Y'){
			$cnt = stripslashes($answer['answer_title']);
		}

		if($hide_results == 'Y'){
			$per = '&nbsp;';
			$cnt = stripslashes($answer['answer_title']);
			$class = 'voteRange-result-data-img';
		}

		$pclass = ($per >= 98) ? 'completed-100' : '';

		if($answer['ans_with_img'] == 'Y'){	

			$counts[$key]['html_progress'] = '<div class="voteRange-result-data-img '.$pclass.' vote-data-element" data-per="'.$per.'" style="background: '.$bg_color.'!important;height:'.$per.'"></div>';
			$counts[$key]['html_per'] = '<span class="percentz-result-data-img vote-data-element">'.$per.'</span>';
			$counts[$key]['html_count'] = '<span class="voteRangehover-text-result-data-img vote-hover-text-img vote-data-element">'.$cnt.'</span>';
			$counts[$key]['html'] = '<div class="qa-listing-result-data-img vote-data-element"></div>';

		}else{

			

			$counts[$key]['html_progress'] = '<div class="voteRange-result-data '.$pclass.' vote-data-element" data-per="'.$per.'" style="background: '.$bg_color.'!important;"></div>';
			$counts[$key]['html_count'] = '<span class="voteRangehover-text-result-data vote-hover-text vote-data-element">'.$cnt.'</span>';
			$counts[$key]['html_per'] = '<span class="percentz-result-data vote-data-element">'.$per.'</span>';
			$counts[$key]['html'] = '<div class="qa-listing-result-data vote-data-element">'.$counts[$key]['html_progress'].$counts[$key]['html_count'].$counts[$key]['html_per'].'</div>';
		}
		
		//$counts[$key]['$ans_with_img'] = '<div class="qa-listing-result-data"></div>';


	}

	return $counts;
}

add_action('wp_ajax_sqb_vote_results', 'SQBVoteResults');
add_action('wp_ajax_nopriv_sqb_vote_results', 'SQBVoteResults');


function SQBVoteResults(){

	$quiz_id = $_POST['quiz_id'];

	$rows = get_poll_results($quiz_id);

	$show_vote_count_content = sqb_get_param($quizid,'show_vote_count','Vote(s)');

	$counts = getVoteResultsFormated($quiz_id,$rows);
	/*$total = array_reduce($counts, function($carry, $item) {
			    $carry += $item['cnt'];
			    return $carry;
			});


	foreach ($counts as $key => $answer) {
		
		$counts[$key]['per'] = ($total > 0) ? round((100*$answer['cnt']) / $total,2) : 0;

		$per = $counts[$key]['per'].'%';
		$cnt = $answer['cnt'].' '.$show_vote_count_content;

		if($hide_results == 'Y'){
			$per = '';
			$cnt = stripslashes($answer['answer_title']);
		}

		$counts[$key]['html'] = '<div class="qa-listing-result-data">
			<div class="voteRange-result-data" style="background: #5269e9!important;width:'.$per.'"></div>
			<span class="voteRangehover-text-result-data vote-hover-text">'.$cnt.'</span>
			<span class="percentz-result-data vote-hover-text">'.$per.'</span>
		</div>';

	}*/

	$is_voted = sqb_is_voted($quiz_id);

	$response = array('counts' => $counts, 'is_votes' => 0);


	if(!empty($is_voted)){
		$response['is_votes'] = $is_voted;
	}

	echo json_encode($response);exit;

} 

function get_poll_results($quiz_id){

	
	global $wpdb, $sqb_question_answer_report;

	$tableName = $wpdb->prefix . 'sqb_quiz_answers';
	$tableName1 = $wpdb->prefix .'sqb_users_quiz_details';


	//$sql = "SELECT * FROM ".$tableName." WHERE quiz_id = ";

	// New
	$sqlq  = "SELECT question_id FROM `".$wpdb->prefix."sqb_quiz_questions` WHERE quiz_id = ".$quiz_id." LIMIT 1";
	$question_id = $wpdb->get_var($sqlq);

	// Get All Ansers
	$answersdataobj =  SQB_QuizAnswers::loadByQuestionId($question_id);
	if(isset($answersdataobj)){
		foreach($answersdataobj as $answerdataobj) {
			$ans_id_array[] = $answerdataobj->getId();
		}
	}

	$question_data = SQB_QuizQuestionBank::loadById($question_id);

	$ans_with_img =  $question_data->getAnsWithImg();


	$sql = "SELECT answer_given, count(answer_given) AS cnt FROM ".$tableName1." WHERE quiz_id = ".$quiz_id." GROUP BY answer_given";
	$rows = $wpdb->get_results($sql, ARRAY_A);
	
	/*echo "<pre>";
	print_r($rows);
	exit;*/
	
	// Setup logic for multiple answers
	$final = array();
	foreach ($rows as $key => $single) {
		$multi = explode(',',$single['answer_given']);
		if(count($multi) > 1){
			foreach ($multi as $tkey => $t) {
				
				$old_count = !empty($final[$t]['cnt']) ? $final[$t]['cnt'] : 0;

				$final[$t]['answer_given'] = $t;
				$final[$t]['cnt'] = $single['cnt']+$old_count;


			}
		}else{
			$old_count = !empty($final[$single['answer_given']]['cnt']) ? $final[$single['answer_given']]['cnt'] : 0;
			$final[$single['answer_given']]['answer_given'] = $single['answer_given'];
			$final[$single['answer_given']]['cnt'] = $single['cnt']+$old_count;
		}
	}

	/*echo "<pre>";
	print_r($final);
	exit;*/

	$rows = array_values($final);
	// End the Multiple answers	


	$newArray = array();
	foreach ($rows as $key => $value) {
		$id = $value['answer_given'];
		$newArray[$id] = $value;
	}

	/*$cnt  = array_column($newArray, 'cnt');
	array_multisort($cnt, SORT_DESC, $newArray);*/


	if(isset($answersdataobj)){
		foreach($answersdataobj as $key=> $answerdataobj) {

			$answers[$key]['answer_given'] = $answerdataobj->getId();
			$answers[$key]['answer_title'] = $answerdataobj->getAnswerTitle();
			$answers[$key]['ans_with_img'] = $ans_with_img;
			$answers[$key]['cnt'] = 0;

			if(!empty($newArray[$answerdataobj->getId()])){
				$answers[$key]['cnt'] = $newArray[$answerdataobj->getId()]['cnt'];
			}

			$ans_id_array[] = $answerdataobj->getId();
		}
	}

	/*echo "<pre>";
	print_r($answers);
	exit;*/

	$answer_order = sqb_get_param($quiz_id,'answer_order');
	
	if($answer_order == 'order-most-votes-on-top'){
		$cnt  = array_column($answers, 'cnt');
		array_multisort($cnt, SORT_DESC, $answers);
	}elseif($answer_order == 'order-random'){
		shuffle($answers);
	}



	// End New



	/*$sql = "SELECT ".$tableName.".answer_title, answer_given,  count(answer_given) AS cnt FROM ".$tableName." LEFT JOIN `".$tableName1."` ON ".$tableName.".id = ".$tableName1.".answer_given WHERE quiz_id = ".$quiz_id." GROUP BY answer_given";
	$rows = $wpdb->get_results($sql, ARRAY_A);*/

	//echo $wpdb->last_query;exit;
	if(!empty($answers)){
		return $answers;
	}

	return array();
}

function generate_vote_results($rows,$quiz_id){

	global $wpdb;

	//echo sqb_time_left(strtotime('2022-05-20 10:00:00'));exit;
	ob_start();

	$hide_number = sqb_get_param($quiz_id,'hide_number');
	$hide_results = sqb_get_param($quiz_id,'hide_results');
	$display_message = sqb_get_param($quiz_id,'display_message');
	$thank_message = sqb_get_param($quiz_id,'display_message_content');
	$action = (!empty($_POST['action']) && $_POST['action'] == 'sqb_vote') ? 'sqb_vote' : '';


	$sqbObj =  SQB_Quiz::loadById($quiz_id);  

	$sqlq  = "SELECT question_id FROM `".$wpdb->prefix."sqb_quiz_questions` WHERE quiz_id = ".$quiz_id." LIMIT 1";
	$question_id = $wpdb->get_var($sqlq);

	$template_num = $sqbObj->getTemplate();	
	$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
	$temp_customizer = $sqbquestionobj->getTempCustomizer();
	$temp_customizer = explode("||",$temp_customizer);	
	
	$show_vote_count_content = sqb_get_param($quizid,'show_vote_count','Vote(s)');
	$bg_color = '#5269e9';
	$text_color = '#000000';
	if($template_num == 'template8'){
		$style = 'style="max-width:'.$temp_customizer[1].'"';

		$customizer_style_settings = maybe_unserialize($sqbObj->getCustomizerStyleSetting());

		if(!empty($customizer_style_settings["progress_background_color"])){
			$bg_color = $customizer_style_settings["progress_background_color"];
		}
		if(!empty($customizer_style_settings["progress_text_color"])){
			$text_color = $customizer_style_settings["progress_text_color"];
		}

	}else{

		if($sqbObj->getTransparentBackgroundSettings() != ''){

			$get_settings = $sqbObj->getTransparentBackgroundSettings();
			$get_details = explode("|",$get_settings);
			$bg_color = $get_details[6];
			$text_color = $get_details[13];
			
		}

	}
	?>

	<style type="text/css">
			.question_add_answer_outer_div-result .voteRange {
			    background: <?php echo $bg_color; ?>;
			}

			.qa-listing-data label, .qa-listing-data span{color: <?php echo $text_color ?>;}
		
		</style>
	<?php

	//echo 'T: '.$hide_results;exit;
	/*if($hide_results == 'Y'){
		?>
			<div class="vote_thank-you">
			   <?php echo !empty($thank_message) ? stripslashes($thank_message) : 'Thank you for the vote!'; ?>
			</div>
		<?php
		return ob_get_clean();
	}*/
	?>

	<div class="question_add_answer_outer_div-result" <?php echo $style; ?>>

	<?php if(($display_message == 'Y' && !empty($action)) || $hide_results == 'Y'){ ?>

		<div class="vote_thank-you vote_thank-you-with-result">
		    <?php echo stripslashes($thank_message); ?>
		</div>

	<?php } ?>

	<?php if(!empty($rows)){

		$total = array_reduce($rows, function($carry, $item) {
						    $carry += $item['cnt'];
						    return $carry;
						});

	
		?>
		<div class="qa-container">
		    <div class="qa-listing">
			<?php
		
			foreach ($rows as $key => $value) {
				$rows[$key]['per'] = ($total > 0) ? round((100*$value['cnt']) / $total,2) : 0;

				$per = $rows[$key]['per'].'%';
				$cnt = $value['cnt'].' '.$show_vote_count_content;

				if($hide_results == 'Y'){
					$per = '';
					$cnt = stripslashes($value['answer_title']);
				}

				?>
				<div class="qa-listing-data">
		            <div class="voteRange" style="width:<?php echo $per; ?>"></div>
		            <?php $vr = ($hide_number != 'Y') ? 'voteRangetext' : ''; ?>
		            <label class="z-index <?php echo $vr; ?>"><?php echo stripslashes($value['answer_title']); ?></label>
		            <?php if($hide_number != 'Y'){ ?>
		            	<label class="z-index voteRangehover-text"><?php echo $cnt; ?></label>
		            <?php } ?>
		            	<span class="percentz z-index"><?php echo $per; ?></span>
		        </div>
				<?php
				//echo '<p><strong>'.$value['answer_title'].': </strong>'.$rows[$key]['per'].'%</p>';
			}
			?>
			</div>
		</div>
		<?php
	} ?>
	</div>
	<?php
	return ob_get_clean();
}

function is_voting_open($quiz_id){

	$is_close_specific_time = sqb_get_param($quiz_id,'close_specific_time');
	$close_date = sqb_get_param($quiz_id,'close_poll');

	if($is_close_specific_time != 'Y') return 1;

	$current_date = date('Y-m-d h:i:s');
	if(strtotime($current_date) < strtotime($close_date)){
		return 1;
	}else{
		return 0;
	}

}

function is_poll_open($quiz_id){

	//$is_close_specific_time = sqb_get_param($quiz_id,'close_specific_time');
	//$close_date = sqb_get_param($quiz_id,'close_poll');
	$is_open_specific_time = sqb_get_param($quiz_id,'poll_start_date');
	$open_date = sqb_get_param($quiz_id,'start_poll');
	
	if($is_open_specific_time != 'Y') return 1;

	$current_date = date('Y-m-d h:i:s');

	if(strtotime($current_date) > strtotime($open_date)){
		return 1;
	}else{
		return 0;
	}

}


function sqb_get_quiz_closetime($quiz_id){

	$close_date = '2022-05-20 09:50:00';
	$current_date = date('Y-m-d h:i:s');

}

function getPollThankyou($quiz_id){

	$display_message = sqb_get_param($quiz_id,'display_message');
	$thank_message = sqb_get_param($quiz_id,'display_message_content','<span>Thank you for voting!</span>');
	$action = (!empty($_POST['action']) && $_POST['action'] == 'SQBSubmitVote') ? 'sqb_vote' : '';
	$hide_results = sqb_get_param($quiz_id,'hide_results');

	if(($display_message == 'Y' && !empty($action)) || $hide_results == 'Y'){

		$thank_message = '<div class="vote_thank-you vote_thank-you-with-result vote-data-element">
		    '.stripslashes($thank_message).'
		</div>';

	}else{
		$thank_message = '';
	}

	return $thank_message;
}

function SQBVote(){

	$quiz_id = $_POST['quizId'];
	$question_id = $_POST['sqb_question_answer_array'][0]['ques_id'];
	$sqbquestionobj =  SQB_QuizQuestionBank::loadById($question_id);
	/*if(!is_voting_open($quiz_id)){
		echo json_encode(array('count_vote' => 0,'html' => $html,'status' => 'error'));
	}*/

	$allow_change_vote = 1;
	$lead = $_POST['sqb_question_answer_array'][0];
	$rows = get_poll_results($quiz_id);
	$repeat_voting = sqb_get_param($quiz_id,'repeat_voting');
	$hide_results = sqb_get_param($quiz_id,'hide_results');

	if($repeat_voting == 'browser-based'){

		$cookie_name = "vote_".$quiz_id;
		$cookie_value = array('lead_rel' => $lead['sqbdatetime'],'time' => time());
		setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 365), "/");

		$allow_voting = sqb_get_param($quiz_id,'allow_voting');
		if(empty($allow_voting)){
			$allow_change_vote = 1;
		}

	}elseif($repeat_voting == 'browser-ip-based'){
		$allow_change_vote = 1;
	}elseif($repeat_voting == 'repeated-voting'){
		$allow_change_vote = 0;
	}
	

	$total = array_reduce($rows, function($carry, $item) {
	    $carry += $item['cnt'];
	    return $carry;
	});

	$per = array();

	$label = array();
	$data = array();
	foreach ($rows as $key => $value) {
		$label[] = stripslashes($value['answer_title']);
		$data[] = $value['cnt'];
	}	

	$chart_display = sqb_get_param($quiz_id,'chart_display');

	$html = generate_vote_results($rows,$quiz_id);

	$counts = getVoteResultsFormated($quiz_id, $rows);


	$display_message = sqb_get_param($quiz_id,'display_message');
	$thank_message = sqb_get_param($quiz_id,'display_message_content');
	$action = (!empty($_POST['action']) && $_POST['action'] == 'SQBSubmitVote') ? 'sqb_vote' : '';
	
	if(($display_message == 'Y' && !empty($action)) || $hide_results == 'Y'){

		$thank_message = '<div class="vote_thank-you vote_thank-you-with-result vote-data-element">
		    '.stripslashes($thank_message).'
		</div>';

	}else{
		$thank_message = '';
	}

	$question = str_replace('contenteditable="true"','',$sqbquestionobj->getQuestion());

	$res = array('counts' => $counts,'thankyou' => $thank_message, 'is_votes' => sqb_is_voted($quiz_id), 'count_vote' => $total,'allow_change_vote' => $allow_change_vote,'html' => $html,'status' => 'ok','chart_data' => array('type' => $chart_display,'question' => $question,'label' => $label,'data' => $data));
	if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
		return $res;
	}else{
		echo json_encode($res);
		exit;
	}
	
}


add_action('wp_ajax_sqb_lead_save', 'SQBLeadSaveAjax');
add_action('wp_ajax_nopriv_sqb_lead_save', 'SQBLeadSaveAjax');

function SQBLeadSaveAjax(){
	
	
	if(isset($_POST['user_id']) && ($_POST['user_id'] != '') && ($_POST['user_id'] != 0)){
		
		$user_id = $_POST['user_id'];		
		$quizId = $_POST['quizId'];
		$outcome_final = !empty($_POST['outcome_final']) ? $_POST['outcome_final'] : 0;
		$how_many_answed = @$_POST['how_many_answed'];
		$lead_type = @$_POST['lead_type'];
		$total_attempts = @$_POST['total_attempts'];
		$course_id = @$_POST['course_id'];
		$lesson_id = @$_POST['lesson_id'];
		$show_retake = @$_POST['show_retake'];
		$page_id = @$_POST['page_id'];
		$quiz_type = @$_POST['quiz_type'];
		$points_scored = @$_POST['points_scored'];
		$total_points = @$_POST['total_points'];	
		$time_spent = @$_POST['time_spent'];			
		$gdpr_required = @$_POST['gdpr_required'];		
		$first_name = @$_POST['first_name'];		
		$certificate_id = !empty($_POST['certificate_id']) ? $_POST['certificate_id'] : 0;

		$category_result_list_array = '';
		if(isset($_POST['category_result_list_array']) && is_array($_POST['category_result_list_array'])){
			$category_result_list_array = json_encode($_POST['category_result_list_array']);
		}

		if(isset($_POST['eachcat_ids'])){
			$category_total_details = stripslashes($_POST['eachcat_ids']);
		}
		
		//check for sqb_wp_syncing 
		$user_source = "WP";
		$sqb_wp_syncing = get_option('sqb_wp_syncing');    
		if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){
			$user_source = "SQB";
		}	
			
		$output['data'] = $_POST;
		$output['success'] = "save ";
		$datetime = date('Y-m-d H:i:s');
		$output['display_msg'] = "";
		$leadtObj = new SQB_ManageLeads();		
		$SQBdata = false ;	
		if(class_exists('SQB_DAPLessonQuiz')){	//Get data from SQB	
			if($lesson_id !="" || $lesson_id !=null){
				$courseQuizData2 = SQB_DAPLessonQuiz::loadQuizByLessonId($lesson_id);	 			
				if(isset($courseQuizData2) && is_array($courseQuizData2)  && count($courseQuizData2)){		 
					$SQBdata = true ;
				}				
			}				
		}	
		
		$course_type = isset($_REQUEST['course_type']) ? $_REQUEST['course_type'] : '';
		if($course_type == 'SCP'){
			$course_array[] = $_REQUEST['course_id'];
		}else{
			if($SQBdata){	
				$course_data = Dap_Product::getProductsDetailsByResourceId($lesson_id);		 
				if(isset($course_data)) {				 
					foreach($course_data as $coursearray1){	 
						//$module_id = $coursearray1['module_id'];				
						$session = Dap_Session::getSession();
						$user = $session->getUser();					
						if(isset($user)){					
							$hasAccess = $user->hasAccessTo($coursearray1['id']);
							if($hasAccess){
								$course_array[] = $coursearray1['id'];
							}  	 
						}
					}
				}else{				
					$course_array[] = $course_id;
				}
			} else{			 
				$course_array[] = $course_id;
			}
		}
		 
		foreach($course_array as $coursearray){
			 
			$leadtObj->setUserId($user_id);			
			$leadtObj->setQuizId($quizId);
			$leadtObj->setOutcome($outcome_final);
			$leadtObj->setHowManyAnswered(0);
			$leadtObj->setCompleted(0);		
			$leadtObj->setOptedIn('N');
			$leadtObj->setShownOutcome('N');
			$leadtObj->setClickedOnCta('N');		
			$leadtObj->setTotalAttempts($total_attempts);		
			$leadtObj->setSource("WP");
			$leadtObj->setCourseId($coursearray);
			$leadtObj->setLessonId($lesson_id);	
			$leadtObj->setTimeSpent($time_spent);			
			$leadtObj->setGDPROptedIn($gdpr_required);
			$leadtObj->setCategoryDetails($category_result_list_array);	
			$leadtObj->setCategoryTotalDetails($category_total_details	);
			$leadtObj->setUsername($first_name); 			
			$leadtObj->setCertificateId($certificate_id);		
			if($lead_type == "lead_optin_btn_click"){
				$leadtObj->setHowManyAnswered($how_many_answed);
				$leadtObj->setCompleted(1);
				$leadtObj->setClicked(0);
				$leadtObj->setOptedIn('Y');				 
			}else if($lead_type == "lead_outcome_show"){
				$leadtObj->setShownOutcome('Y');			 
			}else if($lead_type == "lead_outcome_btn_click"){
				$leadtObj->setClickedOnCta('Y');				 
			}else if($lead_type == "see_details_btn_clicked"){
				$leadtObj->setHowManyAnswered($how_many_answed);
				$leadtObj->setCompleted(1);
				$leadtObj->setClicked(0);
				$leadtObj->setOptedIn('Y');
				if($course_type == 'SCP'){
					$leadtObj->setSource("SCP");
				}else{
					$leadtObj->setSource("DAP");	 
				}
			}else{
				/*$output['error'] = "something Wrong";
				echo json_encode($output); 
				die;*/
			}

			if($course_type == 'SCP'){
				$leadtObj->setSource("SCP");
			}else{
				if(class_exists( 'Dap_Session' )){
					$session = Dap_Session::getSession();
					if (!empty($session) && Dap_Session::isLoggedIn()) {
						$leadtObj->setSource("DAP");
					}
				}
			}		
			
			$leadtObj->setUserSource($user_source);
			$leadtObj->setDate($datetime);

			$repeat_voting = sqb_get_param($quizId,'repeat_voting');

				if($repeat_voting == 'browser-ip-based'){
					$leadtObj->setUniqueId($_SERVER['REMOTE_ADDR']);
				}

			$quiz_data =  SQB_Quiz::loadById($quizId);
			$getAllOtherOptions = $quiz_data->getAllOtherOptions();
			$all_other_options = maybe_unserialize($getAllOtherOptions);
			
			
			$prevent_resubmission = !empty($all_other_options['prevent_resubmission']) ? $all_other_options['prevent_resubmission'] : '';
			$sqb_block_quiz = !empty($all_other_options['sqb_block_quiz']) ? $all_other_options['sqb_block_quiz'] : '';
			if($prevent_resubmission == 'Y'){
				if($sqb_block_quiz == 'browser'){
					
					//$leadtObj->setUniqueId($_SERVER['REMOTE_ADDR']);
					$cookie_name = "sqb_prevent_submission_".$quizId;
					$cookie_value = (time()+ rand(1,1000));
					$leadtObj->setUniqueId($cookie_value);
					setcookie($cookie_name, $cookie_value, time() + (86400 * 30*300), "/"); // 86400 = 1 day
					
					
				}else if($sqb_block_quiz == 'browser_ip'){
					$leadtObj->setUniqueId($_SERVER['REMOTE_ADDR']);
				}
			}

			$manage_leads_id = $leadtObj->create();
			$output['data']['lead_id'] = $manage_leads_id;
			
			//save custom fields values
			if(isset($_POST['optin_form_fields'])){
				$custom_fields_array = '';
				parse_str($_POST['optin_form_fields'],$custom_fields_array);
				$cusom_items = array();
				$prevent_fields = array('first_name','email');
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
						$customfieldstObj = new SQB_UserCustomFields();
						$customfieldstObj->setUserId($user_id);	
						$customfieldstObj->setQuizId($quizId);	
						$customfieldstObj->setManageLeadId($manage_leads_id);	
						$customfieldstObj->setName($selected_key);
						$customfieldstObj->setValue($selected_value);
						$customfieldstObj->setDate($datetime);
						$customfieldstObj->create();
						}
					}
				}
			}	
		}		
		$output['sqbdatetime'] = $datetime;
		if($course_type == 'SCP'){

		}else{
			if($lesson_id !="" || $lesson_id !=null){
				$getresult=assignQuizPoints($user_id, $page_id, $course_id, $quizId, $quiz_type,$points_scored ,$total_points);
				$output['display_msg'] = $getresult;
			}
		}
	}else{
		$output['error'] = "something Wrong";
	}	
	


	if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
		return $output;
	}else{
		echo json_encode($output);
		die;
	}
	//echo json_encode($output); 
	//die;
		
}

function sqb_time_left($time) {

	$time = strtotime($time);
  
    // Calculate difference between current
    // time and given timestamp in seconds
    $diff     = $time - time();
      
    // Time difference in seconds
    $sec     = $diff;
      
    // Convert time difference in minutes
    $min     = round($diff / 60 );
      
    // Convert time difference in hours
    $hrs     = round($diff / 3600);
      
    // Convert time difference in days
    $days     = round($diff / 86400 );
      
    // Convert time difference in weeks
    $weeks     = round($diff / 604800);
      
    // Convert time difference in months
    $mnths     = round($diff / 2600640 );
      
    // Convert time difference in years
    $yrs     = round($diff / 31207680 );
      

    $string = '';
    // Check for seconds
    if($sec <= 0){
    	 $string = "Voting Closed";
    }
	else if($sec <= 60) {
        $string = "$sec seconds left";
    }
      
    // Check for minutes
    else if($min <= 60) {
        if($min==1) {
            $string = "one minute left";
        }
        else {
            $string = "$min minutes left";
        }
    }
      
    // Check for hours
    else if($hrs <= 24) {
        if($hrs == 1) { 
            $string = "an hour left";
        }
        else {
            $string = "$hrs hours left";
        }
    }
      
    // Check for days
    else if($days <= 7) {
        if($days == 1) {
            $string = "Yesterday";
        }
        else {
            $string = "$days days left";
        }
    }
      
    // Check for weeks
    else if($weeks <= 4.3) {
        if($weeks == 1) {
            $string = "a week left";
        }
        else {
            $string = "$weeks weeks left";
        }
    }
      
    // Check for months
    else if($mnths <= 12) {
        if($mnths == 1) {
            $string = "a month left";
        }
        else {
            $string = "$mnths months left";
        }
    }
      
    // Check for years
    else {
        if($yrs == 1) {
            $string = "one year left";
        }
        else {
            $string = "$yrs years left";
        }
    }

    return $string;
}


function assignQuizPoints($userId, $pageId, $course_id, $quiz_id, $quiz_type,$points_scored ,$total_points, $course_data=''){
	return;
	$comment="Quiz complete points.";
	$points=0;
	$assign_credits =false;
	$action = 'sqb_quiz_completed';
	$date= date("Y-m-d H:i:s"); 
	$display_message ="";
  		
	//now get the points and check if points give or not
	if(class_exists('SQB_QuizPoints')){	//Get data from SQB	
		$result = DAP_UserCreditsLimit::loadByUserIdAndActionAndValue($userId, $action,$quiz_id);
		if(isset($result) && count($result)>0){
			$assign_credits = false;			 
		}else{			 
			$getpointsdata = SQB_QuizPoints::loadByQuizId($quiz_id);
			
			if(isset($getpointsdata) && $getpointsdata != null){ 	 
				$give_points = $getpointsdata->getGivePoints();
				$points = $getpointsdata->getPoints();
				$pass_criteria = $getpointsdata->getPassCriteria();
				$pass_percent = $getpointsdata->getPassPercent();
				$retake_pass_rule = $getpointsdata->getRetakePassRule();
				$display_message = $getpointsdata->getDisplayMessage();
				//check in db , if quiz already got the credits, then don't give credits
				// need to add check
				  
				if($give_points =="Y"){
					if($quiz_type == "personality" || $quiz_type == "survey"){//for personality and survey
						$assign_credits = true;
					}elseif($quiz_type == "assessment" || $quiz_type == "scoring"){
						//for assessment and scoring check the passing criteria
						 
						if($pass_criteria =="pass"){
							//if pass then $assign_credits = true; else false
							if($quiz_type == "scoring"){
								$percent_scored = round($points_scored / ($total_points / 100),0);	
							}else{
								$percent_scored = $points_scored;
							} 								
							if($percent_scored >= $pass_percent){
								$assign_credits = true;
							}else{
								$assign_credits = false;
							}
						}else{
							$assign_credits = true;
						}
					}				 	
				}
			}
		}
	}
	 
	//if true only then assign the credits
	if($assign_credits){
				
		//add in User Credits Limit
		$obj = new DAP_UserCreditsLimit(); 
		$obj->setUserId($userId);						
		$obj->setValue($quiz_id);
		$obj->setCreditsEarned( $points ); 
		$obj->setTotalCredits( $points ); 
		$obj->setComments( $comment ); 
		$obj->setStartCreditsDate( $date ); 
		$obj->setLastCreditsDate( $date ); 
		$obj->setAction($action); 
		$obj->create();		
		 
		//add in credit history
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$country = "-";
		$history_data = array(
			'user_id'=>$userId,
			'action'=>$action,
			'credit_earned'=>$points,
			'credit_spent'=>'0',
			'ip'=>$ipaddress,
			'country'=>$country,
			'page_id'=>$pageId,
			'product_id'=>$course_id,
			'value'=>$quiz_id,
			'comments'=>$comment,
			'course_id'=>$course_id,
			'course_data'=>$course_data,
		);										
		 
		createCreditHistory($history_data);	
		$user = Dap_User::loadUserById($userId);				
		if (isset($user)) {
			$creditsAvailable = $user->getCredits_available();					 
			$creditsAvailableUpdated = $creditsAvailable + $points;				 
			$user->setCredits_available($creditsAvailableUpdated);
			$user->update(); 									
		}
		//display message if not null
		if($display_message !="" || $display_message != null){
			return "yes";
		}
		
	}
	
}
 
add_action('wp_ajax_sqb_save_user_ques_ans_array', 'sqb_save_user_ques_ans_array');
add_action('wp_ajax_nopriv_sqb_save_user_ques_ans_array', 'sqb_save_user_ques_ans_array');

function sqb_save_user_ques_ans_array(){
	
	
	if(isset($_POST['sqb_question_answer_array']) && is_array($_POST['sqb_question_answer_array'])){
		
		$sqb_question_answer_array = $_POST['sqb_question_answer_array'];
		foreach($sqb_question_answer_array as $sqb_question_answer){
			if(isset($sqb_question_answer['user_id']) && ($sqb_question_answer['user_id'] != '') && ($sqb_question_answer['user_id'] != 0)){
			
					$user_id = $sqb_question_answer['user_id'];
					$quizId = $sqb_question_answer['quizId'];
					$ques_id = @$sqb_question_answer['ques_id'];
					$answer_id = @$sqb_question_answer['answer_id'];
					$correct_ans = @$sqb_question_answer['correct_ans'];
					
					$correct_ans_id =!empty($sqb_question_answer['correct_ans_id']) ? $sqb_question_answer['correct_ans_id'] : '';

					$answer_text = !empty($sqb_question_answer['answer_text']) ? $sqb_question_answer['answer_text'] : '';
					$other_field = !empty($sqb_question_answer['other_field']) ? $sqb_question_answer['other_field'] : '';
					//$other_field = $sqb_question_answer['other_field'];
					$sqbdatetime = $sqb_question_answer['sqbdatetime'];
					$points_scored = $sqb_question_answer['points_scored'];
					$total_points = $sqb_question_answer['total_points'];
					$sqbdatetime = $sqb_question_answer['sqbdatetime'];
					$answer_tags = '';
					if(isset($sqb_question_answer['answer_tags'])){
						$answer_tags = $sqb_question_answer['answer_tags']; 
					}
					if($sqbdatetime){
						$datetime =$sqbdatetime;
					}else{
						$datetime = date('Y-m-d H:i:s');
					}
					$correct_ans_id =0;
					$sqbDataObj = new SQB_UserQuizDetails();
					$sqbDataObj->setUserId($user_id);
					$sqbDataObj->setQuizId($quizId);
					$sqbDataObj->setAnswerTagIds($answer_tags);
					$sqbDataObj->setQuestionId($ques_id);
					$sqbDataObj->setAnswerGiven($answer_id);  
					$sqbDataObj->setCorrectAnswer($correct_ans); 
					$sqbDataObj->setCorrectAnswerId($correct_ans_id); 
					$sqbDataObj->setAnswerText($answer_text); 
					$sqbDataObj->setOtherField($other_field); 
					$sqbDataObj->setPointsScored($points_scored); 
					$sqbDataObj->setTotalPoints($total_points); 
					$sqbDataObj->setDate($datetime);

					$repeat_voting = sqb_get_param($quizId,'repeat_voting');

					if($repeat_voting == 'browser-ip-based'){
						$sqbDataObj->setUniqueId($_SERVER['REMOTE_ADDR']);
					}
						
					$output['ids'][] = $sqbDataObj->create();						
					
				}else{
					$output['error'] = "something Wrong";
				}	
			}
		}
	
		if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
			return $output;
		}else{
			echo json_encode($output);  
			die;
	}
	//echo json_encode($output); 
	//die;
		
}





add_action('wp_ajax_sqb_save_user_ques_ans', 'sqb_save_user_ques_ans');
add_action('wp_ajax_nopriv_sqb_save_user_ques_ans', 'sqb_save_user_ques_ans');

function sqb_save_user_ques_ans(){
	
	if(isset($_POST['user_id']) && ($_POST['user_id'] != '') && ($_POST['user_id'] != 0)){
		
		$user_id = $_POST['user_id'];
		$quizId = $_POST['quizId'];
		$ques_id = $_POST['ques_id'];
		$answer_id = $_POST['answer_id'];
		$correct_ans = $_POST['correct_ans'];
		$correct_ans_id = $_POST['correct_ans_id'];
		$answer_text = $_POST['answer_text'];
		$sqbdatetime = $_POST['sqbdatetime'];
		$points_scored = $_POST['points_scored'];
		$total_points = $_POST['total_points'];
		$sqbdatetime = $_POST['sqbdatetime'];
		if($sqbdatetime){
			$datetime =$sqbdatetime;
		}else{
			$datetime = date('Y-m-d H:i:s');
		}
		$correct_ans_id =0;
		$sqbDataObj = new SQB_UserQuizDetails();
		$sqbDataObj->setUserId($user_id);
		$sqbDataObj->setQuizId($quizId);
		$sqbDataObj->setQuestionId($ques_id);
		$sqbDataObj->setAnswerGiven($answer_id);  
		$sqbDataObj->setCorrectAnswer($correct_ans); 
		$sqbDataObj->setCorrectAnswerId($correct_ans_id); 
		$sqbDataObj->setAnswerText($answer_text); 
		$sqbDataObj->setPointsScored($points_scored); 
		$sqbDataObj->setTotalPoints($total_points); 
		$sqbDataObj->setDate($datetime);
			
		$sqbDataObj->create();						
		
	}else{
		$output['error'] = "something Wrong";
	}	
	
	echo json_encode($output); 
	die;
		
}



add_action('wp_ajax_sqb_save_reports', 'SQBSaveReportAjax');
add_action('wp_ajax_nopriv_sqb_save_reports', 'SQBSaveReportAjax');

function SQBSaveReportAjax(){
    
    if(isset($_POST['quiz_id']) && ($_POST['quiz_id'] != '') && ($_POST['quiz_id'] != 0)){
		
		$quiz_id  = $_POST['quiz_id'];
		$current_page_id  = $_POST['current_page_id'];
		$report_type  = $_POST['report_type'];
		
		
		$reportObj = new SQB_Reports();
		$reportObj->setPageId($current_page_id);

		if(empty($current_page_id)){
			$external_url  = $_POST['external_url'];
			$reportObj->setExternalURL($external_url);
		}else{
			$reportObj->setExternalURL('');
		}



		$reportObj->setQuizId($quiz_id);
		
		$reportObj->setVisits(0);
		$reportObj->setCompleted(0);
		$reportObj->setClicks(0);
		$reportObj->setOptedIn('N');
		$reportObj->setReachedOutcome('N');
		$reportObj->setClickedOnOutcomeCTA('N');
		
		$event_name = 'product';
		if($report_type == 'quiz_page_visit'){
			$event_name = 'Page View';
			$reportObj->setVisits(1);  
		}else if($report_type == 'quiz_start_btn_click'){	
				$reportObj->setClicks(1);
				$event_name = 'Landing CTA Clicked';
		}else if($report_type == 'quiz_last_question_btn_click'){	
			$reportObj->setCompleted(1);
		}else if($report_type == 'quiz_opt_in_btn_click'){	
			$event_name = 'Lead Form Submitted';
			$reportObj->setOptedIn('Y'); //if he click on optin in form button 
		}else if($report_type == 'quiz_outcome_show'){	
			$reportObj->setReachedOutcome('Y');  // if he reached outcome page 
			$event_name = 'View Outcome';
		}else if($report_type == 'quiz_outcome_form_btn_click'){	
			$event_name = 'Landing CTA Clicked';
			$reportObj->setClickedOnOutcomeCTA('Y');// if he click on button on outcome from
		}else{
			$output['error'] = "Something Wrong Report Type";
			echo json_encode($output); die;
		}	
			
		$datetime = date('Y-m-d H:i:s');
		$ip_address = sqbGetUsertIp();
		$reportObj->setIpAddress($ip_address);
		$reportObj->setDate($datetime);
		$insert_id = $reportObj->create();
		
		$output['success']    = "save";
		$output['insert_id'] = $insert_id;
		$output['report_type'] = $report_type;
		$output['event_name'] = $event_name;
		$output['reportObj'] = $reportObj;
		
		if($event_name != ''){
			$outcome_id = 0;
			if(isset($_POST['outcome_id'])){
				$outcome_id = $_POST['outcome_id'];
			}
			
			$returndata = sqbFbTrackData($quiz_id , 0, 0, $event_name, 'fb',$outcome_id);
			$output['returndata'] =$returndata ;
		}
		
	}else{
		$output['error'] = "something Wrong";
	}	
	//ob_clean();
	echo json_encode($output); 

	
	die;
}


// Function to get the client IP address
function sqbGetUsertIp() {
    $ipaddress = '';
    if (!empty($_SERVER['HTTP_CLIENT_IP']))		
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(!empty($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(!empty($_SERVER['HTTP_FORWARDED']))
       $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(!empty($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
                
    return $ipaddress;
}


add_action('wp_ajax_SQBSendNotificationAjax', 'SQBSendNotificationAjax');
add_action('wp_ajax_nopriv_SQBSendNotificationAjax', 'SQBSendNotificationAjax');
function SQBSendNotificationAjax(){
 
	global $wpdb;
	$user_id="";
	$msg = "";
	$password = '';
	$catdata = '';
	$category_number_percent = '';
	$category_only_percent = '';
	$category_score_breakdown_inpercent = '';
	if(isset($_POST)){



		$sqb_custom_fields_array = array();
		if(isset($_POST['sqb_custom_fields_array']) && is_array($_POST['sqb_custom_fields_array'])){
			$sqb_custom_fields_array = $_POST['sqb_custom_fields_array'];

			if(!empty($_POST['optin_form_fields'])){
				// Set Selected value for custom fields
				parse_str($_POST['optin_form_fields'], $form_fields);

				$form_fields = array_filter($form_fields, function($key) {
			       return strpos($key, 'custom_') === 0;
			    }, ARRAY_FILTER_USE_KEY);

				

				if(!empty($form_fields)){

					if(!empty($sqb_custom_fields_array)){
						foreach($sqb_custom_fields_array as $key => $sqb_custom_field){

							$fieldname = strtolower($sqb_custom_field['field_name']);
							
							if(isset($form_fields['custom_'.$fieldname])){
								if($sqb_custom_field['field_value'] == $form_fields['custom_'.$fieldname]){
									$sqb_custom_fields_array[$key]['selected_value'] = $form_fields['custom_'.$fieldname];
								}else if(is_array($form_fields['custom_'.$fieldname])){
									if(!empty($form_fields['custom_'.$fieldname])){
										$sqb_custom_fields_array[$key]['selected_value'] = implode(',',$form_fields['custom_'.$fieldname]);
									}
								}
							}

						}
					}
				}
			}
		}
		
		
		if(isset($_POST['catdata'])){
			$catdata = $_POST['catdata'];
		}
		
		if(isset($_POST['category_number_percent']) ){
			$category_number_percent = $_POST['category_number_percent'];
		}

		if(isset($_POST['category_only_percent']) ){
			$category_only_percent = $_POST['category_only_percent'];
		}

		if(isset($_POST['category_score_breakdown_inpercent']) ){
			$category_score_breakdown_inpercent = $_POST['category_score_breakdown_inpercent'];
		}
		
		if(isset($_POST['category_number_div'])){
			$category_number_div = $_POST['category_number_div'];
		}

		if(isset($_POST['show_optin'])){
			$show_optin = $_POST['show_optin'];
		}

		
		$firstname_temp = !empty($_POST['firstname_temp']) ? $_POST['firstname_temp'] : '';
		
		$sqb_question_answer_array = isset($_POST['sqb_question_answer_array']) ? $_POST['sqb_question_answer_array'] : '';
		$category_result_list_array = $_POST['category_result_list_array'];
		if(isset($_POST['category_result_list_array']) && is_array($_POST['category_result_list_array'])){
			$category_result_list_array = $_POST['category_result_list_array'];
		}else{
			$category_result_list_array = '';
		}
		
		$first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : '';
		$email = $_POST['email'];		 
		$register_way = $_POST['register_way'];		
		$signup_way = $_POST['signup_way'];		
		$quizId = $_POST['quizId'];		
		$user_id =  !empty($_POST['user_id']) ? $_POST['user_id'] : '';
		
				 	
		$outcomeId = $_POST['outcome_final'];	
		$outcome_ids_array = !empty($_POST['outcome_ids_array']) ? $_POST['outcome_ids_array'] : '';
		$quiz_type = $_POST['sqb_quiz_type'];	
		$outcome_desc = stripslashes($_POST['outcome_desc']);	
		$gdpr_required = $_POST['gdpr_required'];	
		$double_optin = '';
		if(isset($_POST['double_optin'])){
			$double_optin = urldecode(@$_POST['double_optin']);	
		}
	 
		if(isset($_POST['optin_form_fields'])){
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
		/*if($gdpr_required == 'N'){			 
		}else{	*/		 

			$pdf_file = array();
			$isAttachment = 'N';

			$quiz_data =  SQB_Quiz::loadById($quizId);
			$getAllOtherOptions = $quiz_data->getAllOtherOptions();
			$pdf_enable = $quiz_data->getShowDownloadButton();
			if(!empty(maybe_unserialize($getAllOtherOptions))){
				$all_other_options = maybe_unserialize($getAllOtherOptions);
				
				if(!empty($all_other_options['email_pdf_attachment'])){
					$isAttachment = $all_other_options['email_pdf_attachment'];
				}
			}

			if($isAttachment == 'Y' && $pdf_enable == 'Y'){
				$pdf_file = getSqbPDF();
				if(!empty($pdf_file)){
					$pdf_file = array($pdf_file);
				}
			}
			

			SQBSendAdminNotificationEmail($first_name,$email,$quizId, $outcomeId,$sqb_question_answer_array,$quiz_type, $pdf_file ,$outcome_desc,$category_result_list_array,@$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp, $category_only_percent,$category_score_breakdown_inpercent);
			if($show_optin == 'Y'){
				SQBSendStudentNotificationEmail($first_name,$email,$quizId, $outcomeId,$sqb_question_answer_array,$pdf_file,$outcome_desc,$category_result_list_array,$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp, $category_only_percent,$category_score_breakdown_inpercent);
			}

			deleteSqbPDF($pdf_file);
			SQBGetAutoresponderActionDataForQuiz($quizId ,$email,$first_name, $outcomeId, $password,$sqb_question_answer_array, $outcome_ids_array, $sqb_custom_fields_array, $double_optin); 	
		//}	
		
	}
}


function sqb_email_template_layout($quiz_id, $type, $bodyText){





	$global_sqb_email_logo = get_option( 'sqb_email_logo', '' );
	$global_sqb_signature_image = get_option( 'sqb_signature_image', '' );
	$global_signature_body = get_option( 'sqb_signature_body', '' );

	if ($global_sqb_signature_image != '') {
		$signature_img = '<div class="signature-image">
            <img src="'.$global_sqb_signature_image.'">
        </div>';
	}
	

	$emailTemplate = SQB_EmailTemplate::loadByQuizIdAndType($quiz_id,'welcome-email');

	$signature_html = '';
	if (!empty($emailTemplate) && isset($emailTemplate->template_data)) {
		$template_data_json = $emailTemplate->template_data;
		$template_data = json_decode($template_data_json, true);
		if (isset($template_data['useTemplate']) && $template_data['useTemplate'] != 'default') {
			$bgColor = isset($template_data['bgColor'])? $template_data['bgColor'] : '#f0f0f0';
			$sign = isset($template_data['sign'])? $template_data['sign'] : '';

			if (isset($template_data['logo_option']) && $template_data['logo_option'] == 'custom') {
				$logo = isset($template_data['logo'])? $template_data['logo'] : '';
				$logo = str_replace(" ", '%20', $logo);
			}else if (isset($template_data['logo_option']) && $template_data['logo_option'] == 'global') {
				$logo = ($global_sqb_email_logo != '')? $global_sqb_email_logo : '';
				$logo = str_replace(" ", '%20', $logo);
			}else{
				$logo = '';
			}


			if (isset($template_data['sign']) && $template_data['sign'] == 'yes') {
				$removepadding = ($global_sqb_signature_image == '')?'sqb-remove-pl': '';
				$signature_html = '<div class="signature '.$removepadding.'">
			        '.$signature_img.'
			        <div class="signature-info">
			            '.$global_signature_body.'
			        </div>
			    </div>';
			}
			
			$banner = isset($template_data['banner'])? $template_data['banner'] : '';
			$banner = str_replace(" ", '%20', $banner);


			
			
			if ($logo != '') {
				$logo_html = '<div class="logo">
	                <img src="'.$logo.'">
	            </div>';
			}

			if ($banner != '') {
				$banner_html = '<div class="banner">
	                <img src="'.$banner.'" alt="Banner Image">
	            </div>';
			}
			
			$bodyText = str_replace("[HTML_START]", '', $bodyText);

			if ($template_data['selectedTemplate'] == 'template2') {

				//show logo on top no banner image
				$message_html = '
					    <html>
					    <head>
					        <style>
					            body {
					                background-color: '.$bgColor.';
					                font-family: Arial, sans-serif;
					            }
					            .footer-content p,
					            .footer-content{ font-size: 15px; color: gray; }
					            .footer-content{ margin-top: 20px;  text-align: center; }
					            .email-container {
					                max-width: 600px;
					                margin: 0 auto;
					                padding: 20px;
					                background-color: #ffffff;
					                border-radius: 10px;
					                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					            }
					            .logo {
					                text-align: center;
					                margin-bottom: 20px;
					            }
					            .logo img {
					                max-width: 150px;
					            }
					            .banner img {
					                max-width: 100%;
					                height: auto;
					                display: block;
					                margin: 0 auto;
					            }
					            .content {
					                padding: 20px;
					                text-align: left;
					                color: #333333;
					                font-size: 17px;
					            }

					            .signature {
								    font-family: Arial, sans-serif;
								    max-width: 600px;
								    display: table;
								    width: 100%;
								    margin-top: 40px;
								    border-top: 1px solid gainsboro;
								    padding-top: 30px;
								}
								.signature-image {
								    display: table-cell;
								    vertical-align: middle;
								    width: 50px;
								    padding-right: 10px;
								    border-right: 2px solid gray
								}
								.signature-image img {
								    width: 50px;
								    height: auto;
								    border-radius: 50%;
								}
								.signature-info {
								    display: table-cell;
								    vertical-align: middle;
								    padding-left: 10px;
								}
								.signature-info p{ margin-top: 0; margin-bottom: 0;}
								.signature-info.sqb-remove-pl{
									padding-left: 0;
								}
					        </style>
					    </head>
					    <body>
					        <!-- Full background -->
					        
					        <div style="background-color: '.$bgColor.'; padding: 40px 0;">
					            '.$logo_html.'
					            <!-- Email container with white background -->
					            <div class="email-container">					                

					                <!-- Main content section -->
					                <div class="content">
					                    ' . $bodyText . '
					                    ' . $signature_html . '
					                </div>
					            </div>
					        </div>
					    </body>
					    </html>';
			}else if ($template_data['selectedTemplate'] == 'template3') {
				//show logo and banner inside whitebox and padding
				$message_html = '<html>
					    <head>
					        <style>
					            body {
					                background-color: '.$bgColor.';
					                font-family: Arial, sans-serif;
					            }
					            .email-container {
					                max-width: 600px;
					                margin: 0 auto;
					                padding: 20px;
					                background-color: #ffffff;
					                border-radius: 10px;
					                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					            }
					            .footer-content p,
					            .footer-content{ font-size: 15px; color: gray; }
					            .footer-content{ margin-top: 20px;  text-align: center;}
					            .content {
					                padding: 20px;
					                text-align: left;
					                color: #333333;
					                font-size: 17px;
					            }
					            .logo {
					                text-align: center;
					                margin-bottom: 20px;
					            }
					            .logo img {
					                max-width: 150px;
					            }
					            .banner img {
					                max-width: 100%;
					                height: auto;
					                display: block;
					                margin: 0 auto;
					            }

					            .signature {
								    font-family: Arial, sans-serif;
								    max-width: 600px;
								    display: table;
								    width: 100%;
								    margin-top: 40px;
								    border-top: 1px solid gainsboro;
								    padding-top: 30px;
								}
								.signature-image {
								    display: table-cell;
								    vertical-align: middle;
								    width: 50px;
								    padding-right: 10px;
								    border-right: 2px solid gray
								}
								.signature-image img {
								    width: 50px;
								    height: auto;
								    border-radius: 50%;
								}
								.signature-info {
								    display: table-cell;
								    vertical-align: middle;
								    padding-left: 10px;
								}
								.signature-info p{ margin-top: 0; margin-bottom: 0;}
								.signature-info.sqb-remove-pl{
									padding-left: 0;
								}
					        </style>
					    </head>
					    <body>
					        <!-- Full background -->
					        <div style="background-color: '.$bgColor.'; padding: 40px 0;">
					            <!-- Email container with white background -->
					            <div class="email-container">
					                <!-- Centered Logo -->
					                '.$logo_html.'
					                <!-- Banner inside white box -->
					                '.$banner_html.'
					                <!-- Main content section -->
					                <div class="content">
					                    ' . $bodyText . '
					                    ' . $signature_html . '
					                </div>
					            </div>
					        </div>
					    </body>
					    </html>';
			}else if ($template_data['selectedTemplate'] == 'template4') {
				//logo outside and bannerinside box no padding
				$message_html = '<html>
					    <head>
					        <style>
					            body {
					                background-color: '.$bgColor.';
					                font-family: Arial, sans-serif;
					            }
					            .email-container {
					                max-width: 600px;
					                margin: 0 auto;
					                padding: 0;
					                background-color: #ffffff;
					                border-radius: 10px;
					                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					            }
					            .footer-content p,
					            .footer-content{ font-size: 15px; color: gray; }
					            .footer-content{ margin-top: 20px; text-align: center; }
					            .logo {
					                text-align: center;
					                margin-bottom: 20px;
					            }
					            .logo img {
					                max-width: 150px;
					            }
					            .banner img {
					                max-width: 100%;
					                height: auto;
					                display: block;
					                margin: 0 auto;
					            }
					            .content {
					                padding: 20px;
					                text-align: left;
					                color: #333333;
					                font-size: 17px;
					            }

					            .signature {
								    font-family: Arial, sans-serif;
								    max-width: 600px;
								    display: table;
								    width: 100%;
								    margin-top: 40px;
								    border-top: 1px solid gainsboro;
								    padding-top: 30px;
								}
								.signature-image {
								    display: table-cell;
								    vertical-align: middle;
								    width: 50px;
								    padding-right: 10px;
								    border-right: 2px solid gray
								}
								.signature-image img {
								    width: 50px;
								    height: auto;
								    border-radius: 50%;
								}
								.signature-info {
								    display: table-cell;
								    vertical-align: middle;
								    padding-left: 10px;
								}
								.signature-info p{ margin-top: 0; margin-bottom: 0;}
								.signature-info.sqb-remove-pl{
									padding-left: 0;
								}
					        </style>
					    </head>
					    <body>
					        <!-- Full background -->
					        <div style="background-color: '.$bgColor.'; padding: 40px 0;">
					        	<!-- Centered Logo -->
				                '.$logo_html.'
					            <!-- Email container with white background -->
					            <div class="email-container">
					                <!-- Banner inside white box -->
					                '.$banner_html.'
					                <!-- Main content section -->
					                <div class="content">
					                    ' . $bodyText . '
					                    ' . $signature_html . '
					                </div>
					            </div>
					        </div>
					    </body>
					    </html>';
			}else{
				$message_html = '<html>
					    <head>
					        <style>
					            body {
					                background-color: '.$bgColor.';
					                font-family: Arial, sans-serif;
					            }
					            .footer-content p,
					            .footer-content{ font-size: 15px; color: gray; }
					            .footer-content{ margin-top: 20px; text-align: center; }
					            .email-container {
					                max-width: 600px;
					                margin: 0 auto;
					                padding: 20px;
					                background-color: #ffffff;
					                border-radius: 10px;
					                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
					            }
					            .content {
					                padding: 20px;
					                text-align: left;
					                color: #333333;
					                font-size: 17px;
					            }

					            .signature {
								    font-family: Arial, sans-serif;
								    max-width: 600px;
								    display: table;
								    width: 100%;
								    margin-top: 40px;
								    border-top: 1px solid gainsboro;
								    padding-top: 30px;
								}
								.signature-image {
								    display: table-cell;
								    vertical-align: middle;
								    width: 50px;
								    padding-right: 10px;
								    border-right: 2px solid gray
								}
								.signature-image img {
								    width: 50px;
								    height: auto;
								    border-radius: 50%;
								}
								.signature-info {
								    display: table-cell;
								    vertical-align: middle;
								    padding-left: 10px;
								}
								.signature-info p{ margin-top: 0; margin-bottom: 0;}
								.signature-info.sqb-remove-pl{
									padding-left: 0;
								}
					        </style>
					    </head>
					    <body>
					        <!-- Full background -->
					        <div style="background-color: '.$bgColor.'; padding: 40px 0;">
					        	
					            <!-- Email container with white background -->
					            <div class="email-container">
					                <!-- Main content section -->
					                <div class="content">
					                    ' . $bodyText . '
					                    ' . $signature_html . '
					                </div>
					            </div>
					        </div>
					    </body>
					    </html>';
			}

			//$message_html = sqb_process_text_with_shortcode($message_html);


			return $message_html;

		}else{
			return $bodyText;
		}
		
	}else{
		return $bodyText;
	}
	
}

add_action('wp_ajax_SQBSubmitVote', 'SQBSubmitVote');
add_action('wp_ajax_nopriv_SQBSubmitVote', 'SQBSubmitVote');
function SQBSubmitVote(){


	$time_start = microtime(true); 
	$validate = SQBValidatePoll();

	if($validate['status'] == 'error'){
		echo json_encode($validate);exit;
	}

	$user = SQBAddUserAjax();

	if(!empty($user['user_id'])){
		$_POST['user_id'] = $user['user_id'];
		if(empty($_POST['lesson_id'])){
			$euser = SQBSaveUserAjax();
		}

		$lead = SQBLeadSaveAjax();

		if(!empty($lead['sqbdatetime'])){

			foreach($_POST['sqb_question_answer_array'] as $key => $val){
				$_POST['sqb_question_answer_array'][$key]['user_id'] = $_POST['user_id'];
				$_POST['sqb_question_answer_array'][$key]['sqbdatetime'] = $lead['sqbdatetime'];
			}

			$ques_ans = sqb_save_user_ques_ans_array();

			try{
				SQBSendNotificationAjax();
			}catch(Exception $e){}
			
			$final = SQBVote();

			$final['lead_save'] = $lead;
			$final['data']['tags'] = SQBTagsContentAjax();
			//$final['execute_time'] = (microtime(true) - $time_start);
			echo json_encode($final);exit;
		}
	}

}

add_action('wp_ajax_SQBSubmitQuizAjax', 'SQBSubmitQuizAjax');
add_action('wp_ajax_nopriv_SQBSubmitQuizAjax', 'SQBSubmitQuizAjax');
add_action('SQBSubmitQuizAjax', 'SQBSubmitQuizAjax');

function SQBSubmitQuizAjax(){

	if(!empty($_POST['user_id'])){
		$user['user_id'] = $_POST['user_id'];
	}else{
		$user = SQBAddUserAjax();
	}

	if(class_exists( 'Dap_Session' )){
		$session = Dap_Session::getSession();
		if (!empty($session) && Dap_Session::isLoggedIn()) {
			$session = Dap_Session::getSession();
			$userd = $session->getUser();
			$user['user_id'] = $userd->getId();
		}
	}

	$response = array('status' => 'error');

	if(!empty($user['user_id'])){

		$_POST['user_id'] = $user['user_id'];
		$_REQUEST['user_id'] = $user['user_id'];
		$euser = SQBSaveUserAjax();
		$lead = SQBLeadSaveAjax();
		
		if(!empty($lead['sqbdatetime'])){

			//if(function_exists('scp_on_complete_quiz')){

				$quiz_id = $_POST['quiz_id'];
				$quiz_type = $_POST['sqb_quiz_type'];
				$total_ques = isset($_POST['total_ques']) ? $_POST['total_ques'] : 0;
				$correct_answers = isset($_POST['correct_answers']) ? $_POST['correct_answers'] : 0;
				$total_pt = isset($_POST['total_pt']) ? $_POST['total_pt'] : 0;
				$yourpoints = isset($_POST['yourpoints']) ? $_POST['yourpoints'] : 0;


				//scp_on_complete_quiz($quiz_id, $quiz_type, $total_ques, $correct_answers, $total_pt, $yourpoints);
				$response['total_ques'] = $total_ques;
				$response['correct_answers'] = $correct_answers;

				$response['total_pt'] = $total_pt;
				$response['yourpoints'] = $yourpoints;
				
			//}

			$response['lead_save'] = $lead;

			if(isset($_POST['sqb_question_answer_array'])) {
				foreach($_POST['sqb_question_answer_array'] as $key => $val){
					$_POST['sqb_question_answer_array'][$key]['user_id'] = $_POST['user_id'];
					$_POST['sqb_question_answer_array'][$key]['sqbdatetime'] = $lead['sqbdatetime'];
				}
				$ques_ans = sqb_save_user_ques_ans_array();
			}
			
			if(function_exists('sqb_quiz_submission_scp_handler')){
				$first_name = $_REQUEST['first_name'];
				$email = $_REQUEST['email'];
				$quiz_id = $_REQUEST['quiz_id'];
				$outcome_id = $_REQUEST['outcome_id'];
				sqb_quiz_submission_scp_handler($first_name, $email, $quiz_id, $outcome_id, @$ids);
			}

			try{
				SQBSendNotificationAjax();
			}catch(Exception $e){}

			// GamiPress / third-party integration hooks
			$wp_user_id = get_current_user_id();

			// If not logged in, try to find WP user by the email entered in optin screen
			if($wp_user_id == 0 && !empty($_REQUEST['email'])){
				$sqb_wp_user = get_user_by('email', sanitize_email($_REQUEST['email']));
				if($sqb_wp_user){
					$wp_user_id = $sqb_wp_user->ID;
				}
			}

			if($wp_user_id > 0 && function_exists('gamipress_trigger_event')){
				// GamiPress internally checks get_current_user_id() — we must set it
				// so GamiPress processes triggers for non-logged-in users (email lookup)
				$sqb_original_user = get_current_user_id();
				if($sqb_original_user == 0){
					wp_set_current_user($wp_user_id);
				}
				$sqb_quiz_id    = intval($_POST['quiz_id']);
				$sqb_quiz_type  = sanitize_text_field($_POST['sqb_quiz_type']);
				$sqb_total_pt   = floatval($total_pt);
				$sqb_yourpoints = floatval($yourpoints);
				$sqb_score_pct  = ($sqb_total_pt > 0) ? round(($sqb_yourpoints / $sqb_total_pt) * 100, 2) : 0;

				// Load quiz to get passmark
				$sqb_quiz_obj   = SQB_Quiz::loadById($sqb_quiz_id);
				$sqb_passmark   = 0;
				$sqb_passed     = false;
				if(!empty($sqb_quiz_obj)){
					$sqb_passmark = floatval($sqb_quiz_obj->getQuizPassmark());
					$sqb_passed   = ($sqb_score_pct >= $sqb_passmark);
				}

				// Quiz types without scoring — score/pass/fail triggers should NOT fire for these
				$sqb_has_scoring = ($sqb_total_pt > 0);

				// Helper: fire a GamiPress trigger using the proper gamipress_trigger_event() API
				if(!function_exists('sqb_gp_fire_trigger')){
					function sqb_gp_fire_trigger($event, $user_id, $quiz_id){
						gamipress_trigger_event(array(
							'event'       => $event,
							'user_id'     => $user_id,
							'post_id'     => $quiz_id,
						));
					}
				}

				// Helper: check if any GamiPress requirement for a trigger matches this quiz.
				// Condition checking is done here (before firing) because we need per-requirement
				// custom field filtering (quiz ID, quiz type, score range, min score).
				if(!function_exists('sqb_gp_has_matching_requirement')){
					function sqb_gp_has_matching_requirement($trigger, $quiz_id, $quiz_type, $score_pct){
						global $wpdb;
						$req_ids = $wpdb->get_col( $wpdb->prepare(
							"SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_gamipress_trigger_type' AND meta_value = %s",
							$trigger
						));
						if(empty($req_ids)) return false;
						foreach($req_ids as $rid){
							// Specific quiz check
							if(strpos($trigger, '_specific_quiz') !== false){
								$saved_qid = get_post_meta($rid, '_sqb_quiz_id', true);
								if(!$saved_qid || intval($saved_qid) !== intval($quiz_id)) continue;
							}
							// Quiz type check
							if(strpos($trigger, '_quiz_type') !== false){
								$saved_type = get_post_meta($rid, '_sqb_quiz_type', true);
								if(!$saved_type || $saved_type !== $quiz_type) continue;
							}
							// Score range check
							if(strpos($trigger, '_score_range') !== false){
								$min = get_post_meta($rid, '_sqb_min_score', true);
								$max = get_post_meta($rid, '_sqb_max_score', true);
								$min = ($min !== '') ? floatval($min) : 0;
								$max = ($max !== '') ? floatval($max) : 100;
								if($score_pct < $min || $score_pct > $max) continue;
							}
							// Min score check (not score_range)
							if(strpos($trigger, '_min_score') !== false && strpos($trigger, '_score_range') === false){
								$min = get_post_meta($rid, '_sqb_min_score', true);
								$min = ($min !== '') ? floatval($min) : 0;
								if($score_pct < $min) continue;
							}
							return true;
						}
						return false;
					}
				}

				// 1. Complete any quiz — always fires
				sqb_gp_fire_trigger('sqb_gamipress_complete_quiz', $wp_user_id, $sqb_quiz_id);

				// 2. Complete a specific quiz
				if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_specific_quiz', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
					sqb_gp_fire_trigger('sqb_gamipress_complete_specific_quiz', $wp_user_id, $sqb_quiz_id);
				}

				// 3. Complete a quiz of a specific type
				if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_quiz_type', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
					sqb_gp_fire_trigger('sqb_gamipress_complete_quiz_type', $wp_user_id, $sqb_quiz_id);
				}

				// 4-15. Score-based triggers — only fire when the quiz actually has scoring (total_pt > 0)
				// Quiz types like personality, survey, and poll have no scoring, so these are skipped for them.
				if($sqb_has_scoring){

					// 4-6. Score range triggers
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_quiz_score_range', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_quiz_score_range', $wp_user_id, $sqb_quiz_id);
					}
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_specific_quiz_score_range', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_specific_quiz_score_range', $wp_user_id, $sqb_quiz_id);
					}
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_quiz_type_score_range', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_quiz_type_score_range', $wp_user_id, $sqb_quiz_id);
					}

					// 7-9. Minimum score triggers
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_quiz_min_score', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_quiz_min_score', $wp_user_id, $sqb_quiz_id);
					}
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_specific_quiz_min_score', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_specific_quiz_min_score', $wp_user_id, $sqb_quiz_id);
					}
					if(sqb_gp_has_matching_requirement('sqb_gamipress_complete_quiz_type_min_score', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
						sqb_gp_fire_trigger('sqb_gamipress_complete_quiz_type_min_score', $wp_user_id, $sqb_quiz_id);
					}

					// 10-12. Pass triggers (only if score >= passmark)
					if($sqb_passed){
						sqb_gp_fire_trigger('sqb_gamipress_pass_quiz', $wp_user_id, $sqb_quiz_id);
						if(sqb_gp_has_matching_requirement('sqb_gamipress_pass_specific_quiz', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
							sqb_gp_fire_trigger('sqb_gamipress_pass_specific_quiz', $wp_user_id, $sqb_quiz_id);
						}
						if(sqb_gp_has_matching_requirement('sqb_gamipress_pass_quiz_type', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
							sqb_gp_fire_trigger('sqb_gamipress_pass_quiz_type', $wp_user_id, $sqb_quiz_id);
						}
					}

					// 13-15. Fail triggers (only if score < passmark and passmark is set)
					if(!$sqb_passed && !empty($sqb_quiz_obj) && $sqb_passmark > 0){
						sqb_gp_fire_trigger('sqb_gamipress_fail_quiz', $wp_user_id, $sqb_quiz_id);
						if(sqb_gp_has_matching_requirement('sqb_gamipress_fail_specific_quiz', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
							sqb_gp_fire_trigger('sqb_gamipress_fail_specific_quiz', $wp_user_id, $sqb_quiz_id);
						}
						if(sqb_gp_has_matching_requirement('sqb_gamipress_fail_quiz_type', $sqb_quiz_id, $sqb_quiz_type, $sqb_score_pct)){
							sqb_gp_fire_trigger('sqb_gamipress_fail_quiz_type', $wp_user_id, $sqb_quiz_id);
						}
					}

				} // end $sqb_has_scoring

				// Restore original user context
				if($sqb_original_user == 0){
					wp_set_current_user(0);
				}
			}

			$response['status'] = 'ok';
			$response['user_id'] = $user['user_id'];

			$_POST['sqb_quiz_id'] = $_POST['quiz_id'];
			
			
			$response['data']['leaderboards'] = SQBLeaderBoardAjax();
			$response['data']['chart'] = array();
			$response['data']['cat_breakdown'] = SQBCategoryBreakdown();
			$response['data']['conditional_tags'] = SQBConditionalTagsBreakdown();
			$quiz_id = $_POST['sqb_quiz_id'];
			$quiz_obj = SQB_Quiz::loadById($quiz_id);
			if(!empty($quiz_obj)){
				$getOutcomeScreenChartsSettings = $quiz_obj->getOutcomeScreenChartsSettings();
				$getOutcomeScreenChartsSettings = str_replace("undefined","",$getOutcomeScreenChartsSettings);
				$result = explode('|',$getOutcomeScreenChartsSettings);
				if (!empty($result) && is_array($result) && array_key_exists(6, $result)) {
					if($result[6] == 'Y'){

						$response['data']['chart']['OutcomeBarChart'] = SQBOutcomebarchartAjax();
						$response['data']['chart']['QuestionBarChart'] = SQBQuestionsbarchartAjax();
						$response['data']['chart']['OutcomeSpiderChart'] = SQBOutcomeSpiderchartAjax();
						$response['data']['chart']['OutcomeChartHeading'] = SQBQuizTotalUserParticipatedAjax();
						$response['data']['chart']['OutcomeTitle'] = SQBOutcomeTitleAjax();
					}
				}
				
			}
			
			$response['data']['tags'] = SQBTagsContentAjax();
			
		}
	}
	
	echo json_encode($response);die;

}


add_action('wp_ajax_SQBSubmitBackgroundProcessAjax', 'SQBSubmitBackgroundProcessAjax');
add_action('wp_ajax_nopriv_SQBSubmitBackgroundProcessAjax', 'SQBSubmitBackgroundProcessAjax');

function SQBSubmitBackgroundProcessAjax(){

	/*if(!empty($_POST['user_id'])){
		$user['user_id'] = $_POST['user_id'];
	}else{
		$user = SQBAddUserAjax();
	}*/

	/*if(class_exists( 'Dap_Session' )){
		$session = Dap_Session::getSession();
		if (!empty($session) && Dap_Session::isLoggedIn()) {
			$session = Dap_Session::getSession();
			$userd = $session->getUser();
			$user['user_id'] = $userd->getId();
		}
	}*/

	$response = array('status' => 'error');

	$first_name = !empty($_POST['first_name']) ? $_POST['first_name'] : '';
	$email = $_POST['email'];        
	$register_way = $_POST['register_way'];     
	$signup_way = $_POST['signup_way'];     
	$quizId = $_POST['quizId'];     
	$user_id =  !empty($_POST['user_id']) ? $_POST['user_id'] : '';
	$outcomeId = 0;
	$password = '';
	$sqb_question_answer_array = array();
	$outcome_ids_array = array();
	$sqb_custom_fields_array = array();
	$double_optin = '';

	SQBGetAutoresponderActionDataForQuiz($quizId ,$email,$first_name, $outcomeId, $password,$sqb_question_answer_array, $outcome_ids_array, $sqb_custom_fields_array, $double_optin);
	
	echo json_encode(array('message' => 'processed'));die;

}


add_shortcode('ConditionalTAGSFinal', 'SQBConditionalTAGSFinal');

function SQBConditionalTAGSFinal($atts, $content = null){
	extract(shortcode_atts(array( 
		'name'=>'',
		'operator' => 'AND'
	), $atts));	

	$output = array();
	if(isset($_POST['answer_tags'])){
		$tag_ids = $_POST['answer_tags'];
	}else{
		$tag_ids = "";
	}

	$conditions_tag_names = explode(',',$name);

	$conditions_tag_search = array();
	foreach($conditions_tag_names as $cts){

		$cts = str_replace('&lt;','<',$cts);
		$cts = str_replace('&gt;','>',$cts);
		$tag_content_object = SQB_Tags::loadTagContentWithTagNames(trim($cts));
		
		if(!empty($tag_content_object)){
			$conditions_tag_search[] = $tag_content_object->getId();
		}
	}
	

	$conditions_tag_ids = explode(',',$tag_ids);

	$conditions_tag_ids = array_filter($conditions_tag_ids);

	if($operator == 'AND'){
		$common_tags = array_intersect($conditions_tag_search, $conditions_tag_ids);


		$found_match = false;
		foreach ($conditions_tag_search as $tag) {
			if (in_array($tag, $conditions_tag_ids)) {
				$found_match = true;
			}else{
				$found_match = false;
				break;
			}
		}


		if ($found_match) {
			$html = '<div class="conditional-tags ctmowith-and">'.$content.'</div>';
		} else {
			$html = '';
		}
	}else{
		$common_tags = array_intersect($conditions_tag_search, $conditions_tag_ids);

		// Check if at least one of the tags to check is present in the common_tags array
		$found_match = false;
		foreach ($conditions_tag_search as $tag) {
			if (in_array($tag, $common_tags)) {
				$found_match = true;
				break;
			}
		}

		if ($found_match) {
			$html = '<div class="conditional-tags ctmowith-or">'.$content.'</div>';
		}else{
			$html = '';
		}
	}
	

	return $html;

}

add_shortcode('CategoryRankFinal', 'CategoryRankFinal');

function CategoryRankFinal($atts){

	extract(shortcode_atts(array( 
		'columns'=>'3',
		'order'=>'lowtohigh',	
		'high'=>'red',
		'medium'=>'yellow',
		'low'=>'green',
		'high_range'=>'80-100',
		'medium_range'=>'50-80',
		'low_range'=>'0-50',
		'score_text' => '',
		'high_text' => '',
		'medium_text' => '',
		'low_text' => '',
		'limitto' => 5,
		'margin' => 20,
		

	), $atts));	


	if(empty($score_text)){

			$score_text = sqbGetValidSettingsByKey('sqb_score');
			if(empty($score_text)){
				$score_text = 'Score';
			}
		}

	if(empty($high_text)){

		$high_text = sqbGetValidSettingsByKey('sqb_high');
		if(empty($high_text)){
			$high_text = 'High';
		}
	}

	if(empty($medium_text)){

		$medium_text = sqbGetValidSettingsByKey('sqb_medium');
		if(empty($medium_text)){
			$medium_text = 'Medium';
		}
	}

	if(empty($low_text)){

		$low_text = sqbGetValidSettingsByKey('sqb_low');
		if(empty($low_text)){
			$low_text = 'Low';
		}
	}



	$category_result_list_array = $_POST['category_result_list_array'];
	if(isset($_POST['category_result_list_array']) && is_array($_POST['category_result_list_array'])){
		$category_result_list_array = $_POST['category_result_list_array'];
	}else{
		$category_result_list_array = json_decode(stripslashes($_REQUEST['category_result_list_array']), true);
	}

	
	
	if(empty($category_result_list_array)) return '';
	

	if($order == 'lowtohigh'){
		asort($category_result_list_array);
	}else{
		arsort($category_result_list_array);	
	}
	

	$maxCatTotal = json_decode(wp_kses_stripslashes($_POST['eachcat_ids']), true);
	if(empty($maxCatTotal)) return '';


	foreach ($category_result_list_array as $cat_id => $cat_val) {
	    $total = $maxCatTotal[$cat_id];

	    // Check if total is zero to avoid division by zero error
	    if ($total != 0) {
	        $percentage = ($cat_val / $total) * 100;
	        $percentage = round($percentage, 2);
	    } else {
	        $percentage = 0; // Set to 0 or handle as needed when total is zero
	    }

	    $new_cat_per_array[$cat_id] = $percentage;
	}


	if($order == 'lowtohigh'){
		asort($new_cat_per_array);
	}else{
		arsort($new_cat_per_array);	
	}



	$html = '<div class="sqb-category-breakdown" style="gap: ' . esc_attr($margin) . 'px;">';
	$i = 1;


	
	
	

	

	foreach ($new_cat_per_array as $cat_id => $percentage) {

		if($i > $limitto){
			break;
		}
		$i++;

		$category = SQB_QuizCategory::loadById($cat_id);

		if(empty($category)){
			continue;
		}
		
		
		$title = $category->getName();
		$description = $category->getDescription();
		$total = $maxCatTotal[$cat_id];
		//$percentage = ($cat_val / $total) * 100;
		//$percentage = round($percentage, 2);

		// Extract lower and upper values from the range strings
		$high_range_values = explode('-', $high_range);
		$medium_range_values = explode('-', $medium_range);
		$low_range_values = explode('-', $low_range);

		$low_value = $low_range_values[0];
		$low_upper_value = $low_range_values[1];
		$medium_lower_value = $medium_range_values[0];
		$medium_upper_value = $medium_range_values[1];
		$high_value = $high_range_values[1];

		// Determine the range based on the percentage
		if ($percentage >= $low_value && $percentage <= $low_upper_value) {
			$range = $low_text;
			$color = $low;
		} elseif ($percentage >= $medium_lower_value && $percentage <= $medium_upper_value) {
			$range = $medium_text;
			$color = $medium;
		} else {
			$range = $high_text;
			$color = $high;
		}

		$html .= '<div class="sqb-categoy-bd-inner sqb-col-'.$columns.'">';
		$html .= '<div class="sqb-category-card">';
		$html .= '<h3>'.$title.'</h3>';
		if(!empty($description)){
			$description = nl2br($description);
			$html .= '<p>'.$description.'</p>';
		}
		$html .= '<div class="sqb-outcome-progressbar-wrapper">
					<div class="sqb-categoy-progress-bar">
						<div class="sqb-categoy-progress" style="width: '.$percentage.'%; background-color:'.$color.';"></div>
					</div>
					<div class="sqb-categoy-progress-info">
						<span class="sqb-categoy-score">'.$score_text.' <strong>'.number_format($percentage,2).'%</strong></span>
						<span class="sqb-categoy-range">'.$range.'</span>
					</div>
				</div>';
		$html .= '';
		$html .= '</div>';
		$html .= '</div>';
	}
	$html .= '</div>';

	return $html;
}

function SQBCategoryBreakdown(){
	$string = $_POST['outcome_desc'];

	$pattern = '/\[CategoryRank\b[^]]*]/';
	preg_match_all($pattern, $string, $matches);
	
	
	$shortcode_outputs = array();

	if (!empty($matches[0])) {
        foreach ($matches[0] as $shortcode) {
            $shortcode_cleaned = wp_kses_stripslashes($shortcode);
            $processed_shortcode = str_replace('CategoryRank', 'CategoryRankFinal', $shortcode_cleaned);
            $shortcode_outputs[] = do_shortcode($processed_shortcode);
        }
    }

	/*if (!empty($matches)) {
		$shortcode = wp_kses_stripslashes($matches[0]);
		$f = str_replace('CategoryRank','CategoryRankFinal',$shortcode);
		$final[] = do_shortcode($f);
		
	}*/
	
	
	return $shortcode_outputs;
}


function SQBConditionalTagsBreakdown(){
	$string = wp_kses_stripslashes($_POST['outcome_desc']);

	//$pattern = '/\[ConditionalTAGS\s*Name="([^"]+)"\](.*?)\[\/ConditionalTAGS\]/s';
	$pattern = '/\[ConditionalTAGS\s*Name="([^"]+)"\s*Operator="([^"]+)"\](.*?)\[\/ConditionalTAGS\]/s';

	preg_match_all($pattern, $string, $matches);

	$final = array();
	if (!empty($matches)) {
		foreach ($matches[0] as $index => $match) {
			
			$shortcode = wp_kses_stripslashes($match);
			$f = str_replace('ConditionalTAGS','ConditionalTAGSFinal',$shortcode);
			$final[] = do_shortcode($f);

		}
		return $final;
	}

	return array();

}



function SQBLeaderBoardAjax(){

	$data = array();
	if(!empty($_REQUEST['leaderboards_req'])){
		$leadeboard_ids = explode(',',$_REQUEST['leaderboards_req']);

		foreach ($leadeboard_ids as $key => $li) {
			$data[$li] = do_shortcode('[SQBLeaderboard id="'.$li.'"][/SQBLeaderboard]');
		}
	}

	return $data;
}

add_action('wp_ajax_SQBAddUserAjax', 'SQBAddUserAjax');
add_action('wp_ajax_nopriv_SQBAddUserAjax', 'SQBAddUserAjax');
/* Save User in Wp/DAP ad in other platform  */
function SQBAddUserAjax(){

	//check_ajax_referer('opt-nounce', 'nounce');

	global $wpdb;
	$user_id="";
	$msg = "";
	if(isset($_POST)){
			
		$first_name = $_POST['first_name'];
		$email = $_POST['email'];
		$remove_char_http = array("https://", "http://", "/");
		$get_site_name = str_replace($remove_char_http, "", site_url());
		
		if(($first_name == 'SQBGuest') &&  ($email == 'sqbguest@'.$get_site_name)){ 
			$lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
			if(file_exists($lldocroot . "/dap/dap-config.php")){ 
				 include_once ($lldocroot . "/dap/dap-config.php");   
				 $dap_session = Dap_Session::getSession();
				 $dap_user = $dap_session->getUser(); 
				 if( Dap_Session::isLoggedIn() && isset($dap_user) ) {
					
					 $email = $dap_user->getEmail();
					 $first_name = $dap_user->getFirst_name(); 
					 $_POST['email'] = $email;
					 $_POST['first_name'] = $first_name;
					 

				 }
			}
		}
		$register_way = $_POST['register_way'];		
		$signup_way = $_POST['signup_way'];		
		$quizId = $_POST['quizId'];		
		$username1 = explode("@", $email);
		$username = $username1[0];		
		if($first_name == ''){
			$first_name = $username1[0];			
		}
		$register_way ="WP";
		
		//check if syncing is enabled or disabled
		$create_user = sqbCheckSyncing($email, $first_name);
		if(isset($create_user) && $create_user !=""){  // added in SQB
			$user_id = $create_user;
			
		}else{ // add user in WP
			
			$password = wp_generate_password();				 
			//register user
			//added for :- in some sites if username already exist then it throws the error. We are making username unique (guest user)
			$username = $username."_".rand(10,1000); 
			$email_exists = email_exists( $email ) ;
			$sqb_wp_syncing = get_option('sqb_wp_syncing');   
			if( !$email_exists ){		
				$userData = array(
							'user_login' => $username,
							'first_name' => $first_name,
							'last_name' => '',
							'user_pass' => $password,
							'user_email' => $email,
							'role' => 'subscriber'
						);
				$_SESSION["SQBUSER"] = "Y";
				$user_id = wp_insert_user( $userData );
				update_user_meta( $user_id, "first_name",  $first_name) ;
				
				if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){
				}else{
					update_user_meta( $user_id, "sqb_quiz_id_".$quizId,  1) ;
					update_user_meta( $user_id, "sqb_quiz_complete_id_".$quizId,  rand()) ;
				}

				$msg = "Created Successfully";
			}else{
				$userId="";
				$user = get_user_by( 'email', $email );
				if(isset($user)){
					$userId = $user->ID;
				}
				$user_id = $userId;
					
				if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){
				}else{
					update_user_meta( $user_id, "sqb_quiz_id_".$quizId,  1) ;
					update_user_meta( $user_id, "sqb_quiz_complete_id_".$quizId,  rand()) ;
				}
				
				$msg = "User already exists.";
			}

			$checkAddToDAP = SQB_QuizAutoresponder::loadByQuizIdAndAutoresponderName($quizId, "DAP");

			if (!empty($checkAddToDAP)) {
				$user = Dap_User::loadUserByEmail($email);

				if(!isset($user)){
					$user = SQBcreateNewDAPUser($first_name,$email, $password );
				}
			}
		}
	}

	if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
		return array("user_id"=>$user_id, "msg"=>$msg);
	}else{

		echo json_encode(array("user_id"=>$user_id, "msg"=>$msg) );  
		die;
	}
	//echo json_encode(array("user_id"=>$user_id, "msg"=>$msg) );  
	//die;
}
 
 
add_action('wp_ajax_sqb_generate_share_variable_dynamic', 'SQBGenerateShareVariableDynamic');
add_action('wp_ajax_nopriv_sqb_generate_share_variable_dynamic', 'SQBGenerateShareVariableDynamic'); 

function SQBGenerateShareVariableDynamic(){
	$output = array();
	
	if(isset($_POST)){
		$output['success'] = 'Y';
		$quiz_id = $_POST['quiz_id'];
		$quiz_type = $_POST['quiz_type'];
		$outcome_id = $_POST['outcome_id'];
		$variable1 = $_POST['variable1'];
		$variable2 = $_POST['variable2'];
	  
	     $quiz_obj = SQB_Quiz::loadById($quiz_id);
		 $quiz_title = '';
	
		if($quiz_obj){
			$quiz_title =  $quiz_obj->getQuizName();
		}    
		
	    $outcome_title = '';
	    $outcome_obj  = SQB_Outcome::loadById($outcome_id);
	    if($outcome_obj){
			 $outcome_title = $outcome_obj->getOutcomeName();
	    }
	    
		$social_share_obj = SQB_Social_Share:: loadByQuizId($quiz_id);
	    $tw_share_description = '';
	    
		if(isset($social_share_obj)){
			 $tw_share_description = $social_share_obj->getTwDescription();
			 $tw_share_description =  str_replace("%%OUTCOMETITLE%%",$outcome_title,$tw_share_description);
			 $tw_share_description =  str_replace("%%QUIZTITLE%%",$quiz_title,$tw_share_description);
		 }
		 
		 if($quiz_type == 'assessment'){
	     
				$crrect_ans = $variable2; 
				$total_question = $variable1;
				$tw_share_description =  str_replace("%%CORRECTANSWERS%%",$crrect_ans,$tw_share_description);
				$tw_share_description =  str_replace("%%TOTALQUESTIONS%%",$total_question,$tw_share_description);
	 
		 }else if($quiz_type == 'scoring'){
			$total_pt = $variable1;
			$sqb_points_ans = $variable2;

			$points_scored_percent = number_format(round($sqb_points_ans * 100 / $total_pt, 2), 2);

			$tw_share_description =  str_replace("%%SCOREINPERCENT%%",$points_scored_percent,$tw_share_description);
			$tw_share_description =  str_replace("%%YOURSCORE%%",$sqb_points_ans,$tw_share_description);
			$tw_share_description =  str_replace("%%TOTALSCORE%%",$total_pt,$tw_share_description);
			
		}else{
			
			//$points_scored_percent = number_format(round($sqb_points_ans * 100 / $total_pt, 2), 2);
			
			$tw_share_description =  str_replace("%%SCOREINPERCENT%%",0,$tw_share_description);
			$tw_share_description =  str_replace("%%CORRECTANSWERS%%",0,$tw_share_description);
			$tw_share_description =  str_replace("%%TOTALQUESTIONS%%",0,$tw_share_description);
			$tw_share_description =  str_replace("%%YOURSCORE%%",0,$tw_share_description);
			$tw_share_description =  str_replace("%%TOTALSCORE%%",0,$tw_share_description);
		}
		
		
		$share_paremets = base64_encode('quiz_id='.$quiz_id.'&outcome_id='.$outcome_id.'&v1='.$variable1.'&v2='.$variable2.'&r='.rand(10,10000));
		$output['share_paremets'] = $share_paremets;
		$output['tw_share_description'] = $tw_share_description;
	}else{
		$output['error'] = 'N';
		
	}
	
	echo json_encode($output); 
	die;
	
} 
 
add_action('wp_ajax_SQBSaveUserAjax', 'SQBSaveUserAjax');
add_action('wp_ajax_nopriv_SQBSaveUserAjax', 'SQBSaveUserAjax');

/* Save User in sqb_users  */
function SQBSaveUserAjax(){
	global $wpdb;
	$id="";
	$msg="";
	if(isset($_POST)){
		$id = !empty($_POST['id']) ? $_POST['id'] : '';
		$quiz_id = @$_POST['quiz_id'];
		$user_id = @$_POST['user_id'];
		$platform = @$_POST['platform'];		
		$total_ques = !empty($_POST['total_ques']) ? $_POST['total_ques'] : '';		
		$correct_answer = !empty($_POST['correct_answer']) ? $_POST['correct_answer'] : '';		
		$incorrect_answer = !empty($_POST['incorrect_answer']) ? $_POST['incorrect_answer'] : '';		
		$answer_points = !empty($_POST['answer_points']) ? $_POST['answer_points'] : '';
		$percentage = !empty($_POST['percentage']) ? $_POST['percentage'] : '';		
		$question_ids = !empty($_POST['question_ids']) ? $_POST['question_ids'] : '';
		$question_id_array = explode(",",$question_ids);			 
		$answer_given = !empty($_POST['answer_given']) ? $_POST['answer_given'] : '';
		$correct_answer = !empty($_POST['correct_answer']) ? $_POST['correct_answer'] : '';			 
		$dateTime = date('Y-m-d h:i:s');
		
		//Save user in sqb_user table
		$userObj = new SQB_Users();	
		$userObj->setQuizId($quiz_id);
		$userObj->setUserId($user_id);
		$userObj->setPlatform($platform);
		$userObj->setTotalQues($total_ques);
		$userObj->setCorrectAnswer($correct_answer);
		$userObj->setInCorrectAnswer($incorrect_answer);
		$userObj->setAnswerPoints($answer_points);
		$userObj->setPercentage($percentage); 
		$userObj->setDate($dateTime);
		$id = $userObj->create();
		$msg = "Successfully Saved";	
		
		//Save user in sqb_user_quiz_details table
		
		if(isset($_POST['question_ids']) && isset($question_id_array) && is_array($question_id_array) && count($question_id_array) ){
			$userDetailsObj = new SQB_UserQuizDetails();
			foreach($question_id_array as $question_id){
				$userDetailsObj->getUserId($user_id);
				$userDetailsObj->getQuizId($quiz_id);
				$userDetailsObj->getQuestionId($question_id);
				$userDetailsObj->getAnswerGiven($answer_given);
				$userDetailsObj->getCorrectAnswer($correct_answer);
				$userDetailsObj->setDate($dateTime);
				$userDetailsObj->create();
			 }
		 }
			
		/*if($id != '' && $id != 0){	
			$userObj->getId($id);		
			$id = $userObj->update();	
			$msg = "Successfully Updated";	
		}else{
			$id = $userObj->create();
			$msg = "Successfully Saved";	
		}*/
	}

	if(!empty($_POST['is_poll']) || !empty($_POST['is-v2'])){
		return array('id' => $id , 'msg' => $msg );
	}else{
		echo json_encode(array('id' => $id , 'msg' => $msg ));  
		die;
	}
	
	//echo json_encode(array('id' => $id , 'msg' => $msg )); 
	//die;
}




add_shortcode('SmartQuizBuilderFunnel', 'SmartQuizBuilderFunnel');

function SmartQuizBuilderFunnel($atts, $content=null){ 
	
	// do shortcode
	$content = do_shortcode($content);  
	extract(shortcode_atts(array( 
		'id'=>''
	), $atts));	
	
	
	
	$quizid = 5;
    $sqbFunnelObj =  SQB_Funnel::loadByQuizId(5);
    
    $sqbObj =  SQB_Quiz::loadById(5);
    
    
    if(isset($sqbFunnelObj)){
			
			$funnel_data = $sqbFunnelObj->getFunnelData();
			$funnel_data = stripslashes($funnel_data);
			$funnel_data = json_decode($funnel_data,true);
			
			$sqb_funnel_ques_ans_connection_array = array();
			
			if(isset($funnel_data['drawflow']['Home']['data'])){
				$data = $funnel_data['drawflow']['Home']['data'];
				
				foreach($data as $single_data){
					
					$inputs = $single_data['inputs'];
					$outputs = $single_data['outputs'];
					$sqb_funnel_ques_ans_connection_array[$single_data['id']]['question_id'] = $single_data['id'];
					
					foreach($outputs as $output){
						// Get ans details
						if(isset($output['connections'][0])){
							$sqb_funnel_ques_ans_connection_array[$single_data['id']]['answer_ids'][] = $output['connections'][0]['node'];
						}
						// Get next question details
						if(isset($output['connections'][1])){
							$sqb_funnel_ques_ans_connection_array[$single_data['id']]['next_question'][$output['connections'][0]['node']] = $output['connections'][1]['node'];
						}
					}// foreach loop close for outputs variable
					
				}// foreach loop close for data variable
				
			}
			
			$quiz_pagination     =  '';
			$question_per_page   =  '1';
			$question_display    =  'all';
			$number_of_question  =  'all';
			$ques_template       =  '';
			
	
	
	        //$starttempdata = getStartTemplateData($quizid);
			//$optintempdata = getOptinTemplateData($quizid);	  
			//$resulttempdata = getResultTemplateData($quizid);
			  
			
			$quesanstempdata  = sqbGetQuestions($quizid, $quiz_pagination, $question_per_page, $question_display, $number_of_question,  $ques_template);
			$quesanstempdata  = stripslashes($quesanstempdata); 
			$quesanstempdata  = str_replace('contenteditable="true"','contenteditable="false"',$quesanstempdata); 	
			
			$question_html = $quesanstempdata;	
	}
	
	$includejscss = sqbGetStyleAndScript();
    
    
    $funnel_html = "<div class='quiz_outer_fe quiz_outer_funnel'>";  
    $funnel_html .= $html.$includejscss.'<link href="'.plugin_dir_url(__FILE__).'../css/sqb_frontend.css?'.rand(10,1000).'" rel="stylesheet">';
    $funnel_html .= '<link href="'.plugin_dir_url(__FILE__).'../css/question_ans_layout.css?'.rand(10,1000).'" rel="stylesheet">';
    $funnel_html .= '<script  src="'.plugin_dir_url(__FILE__).'../js/sqb_frontend_funnel.js?'.rand(10,1000).'"></script>';
    $funnel_html .= $question_html;
    $funnel_html .= '<script>
                     var sqb_funnel_ques_ans_connection_json = '.json_encode($sqb_funnel_ques_ans_connection_array).';
                     console.log(sqb_funnel_ques_ans_connection_json);
					</script>';
    $funnel_html .= "</div>";
    
    
    return $funnel_html; 
    
    
    
}



/*****temp moved start********/

function SQBSendAdminNotificationEmail($first_name,$email,$quizId, $outcomeId,$sqb_question_answer_array,$quiz_type,$pdf_file,$outcome_desc='', $category_result_list_array = '',$custom_fields_data='',$catdata='', $category_number_percent='', $category_number_div='', $firstname_temp ='', $category_only_percent='', $category_score_breakdown_inpercent=''){
	$getQuizDesc ='';
	
	$quizDetails =  SQB_Quiz::loadById($quizId);

	$getAdminEmail='';
	if($quizDetails != false){
		//$quiz_name = stripslashes($quizDetails->getQuizName());			
		//$quiz_type = $quizDetails->getQuizType();
		//$getQuizDesc = $quizDetails->getQuizDesc();			
		$getAdminEmail = $quizDetails->getAdminEmail();			
		$getSendCopy = $quizDetails->getSendCopy();			
	}else{
		return;
	}

	

	if($getAdminEmail == 'Y' && $getSendCopy == 'N'){

		$getQuizDesc ='';
		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizId('admin_email', $quizId);

		if(!empty($sqb_notifications)){

			$bodyText = stripslashes($sqb_notifications->getAdminBody());

			$admin_emails = trim(stripslashes($sqb_notifications->getAdminFromEmail()));

			

			$admin_name = trim(stripslashes($sqb_notifications->getFromName() ?? ''));

			$subject = trim(stripslashes($sqb_notifications->getAdminSubject()));
			//$subject = 	mb_convert_encoding($subject, "UTF-8", "auto");
			$encoding = mb_detect_encoding($subject, 'auto', true);
			$subject = mb_convert_encoding($subject, 'UTF-8', $encoding);
			$bodyText = trim($bodyText);

			$quizDetails =  SQB_Quiz::loadById($quizId);
			$outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quizId, $outcomeId);

			if($outcomeDetails != false){
				$outcomeTitle = $outcomeDetails->getOutcomeName();			
			}
			$outcomeTitle = !empty($outcomeTitle) ? $outcomeTitle : '';

			if($quizDetails != false){
				$quiz_name = stripslashes($quizDetails->getQuizName());			
				$quiz_type = $quizDetails->getQuizType();			
				$getQuizDesc = stripslashes($quizDetails->getQuizDesc());			
			}


			$subject = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type, $outcomeTitle, $subject, '', '', $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$outcomeId);
			$bodyText = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type,$outcomeTitle, $bodyText,$sqb_question_answer_array, '', $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp,$outcomeId, $category_only_percent,$category_score_breakdown_inpercent);
			 
			$bodyText = str_replace("ShowCategoryScore",'ShowCategoryScoreServer',$bodyText);
    		$bodyText = do_shortcode(stripslashes($bodyText));

			$bodyText = str_replace("%%NAME%%", $first_name, $bodyText);
			$bodyText = str_replace("%%FIRST_NAME%%", $first_name, $bodyText);

			
			
			if($quiz_type == 'poll'){
				$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : 0;
				$pollresult = get_poll_results($quiz_id);
				if(!empty($pollresult)){
					$totalCount = 0;
	
					// Calculate total count
					foreach ($pollresult as $item) {
						$totalCount += $item['cnt'];
					}
	
					// Calculate and display percentage for each answer title
					$poll_stuff = '';
					foreach ($pollresult as $item) {
						$percentage = ($item['cnt'] / $totalCount) * 100;
						$formattedPercentage = number_format($percentage, 2); // Limit precision to 2 decimal places
						$poll_stuff .= '<div>'.$item['answer_title'] . ': ' . $formattedPercentage . '%' . '</div>';
					}
				}else{
					$bodyText = str_replace("%%POLLRESULT%%", '', $bodyText);
				}
	
				$bodyText = str_replace("%%POLLRESULT%%", $poll_stuff, $bodyText);
			}
			
			if($firstname_temp){
				$bodyText = str_replace("%%FIRST%%", $firstname_temp, $bodyText);
			}else{
				$bodyText = str_replace("%%FIRST%%", $first_name, $bodyText);
			}


			$bodyText = preg_replace(
			    '/<span[^>]*class="outcome_data_title_clone"[^>]*>.*?<\/span>/is',
			    '',
			    $bodyText
			);

			$bodyText = preg_replace(
			    '/<div[^>]*class="outcome_data_description_clone"[^>]*>.*?<\/div>/is',
			    '',
			    $bodyText
			);

			add_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
			if($admin_emails != ''){
				$admin_emails = explode(',', $admin_emails);
				
				if(defined('SQB_USE_ADMIN_EMAIL_TO_SEND') && SQB_USE_ADMIN_EMAIL_TO_SEND == 'Y'){
					$tmp_ae = $admin_emails;
					if(isset($tmp_ae[0])){
						$email = $tmp_ae[0];
					}
				}

				if (strpos($email, 'sqbguest@') !== false) {
				    $tmp_ae = $admin_emails;
				    if (isset($tmp_ae[0])) {
				        $email = $tmp_ae[0];
				    }
				}


				foreach($admin_emails as $admin_email){
					$admin_email = trim($admin_email);
					$quizData = SQB_Quiz::loadById($quizId);
					if(isset($quizData)){

						$quizName = $quizData->getQuizName();	
					}
					if($admin_name == ''){
						$admin_name = $quiz_name;
					}
					//added for email styling
					$bodyText1 = '<html>
					  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
						<style>.generate_pdf_form{display:none !important;}.outcome_data_title_clone { display:none !important; }outcome_data_description_clone { display:none !important; }</style>
					  </head>
					  <body>
						'.$bodyText.'
					  </body>
					</html>';	
					$headers = array('From: '.$first_name.' <'.$email.'>');
					//$headers .= array('Content-Type: text/html; charset=UTF-8'); 
				 	//echo $bodyText;exit;
					wp_mail( $admin_email, $subject, $bodyText1, $headers, $pdf_file);				 
				}
			}
			
			remove_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
		}
	}else{
		
		if($getAdminEmail == 'N' || $getAdminEmail == '' || $getSendCopy == 'Y'){

		}else{
			$sqb_notifications = SQB_QuizNotifications::loadByType('admin_email');
		 	if(!empty($sqb_notifications)){
				$sendEmail = $sqb_notifications->getSendEmail();
				if($sendEmail != 'Y'){return;}

				$bodyText = stripslashes($sqb_notifications->getBody());

				$admin_emails = trim(stripslashes($sqb_notifications->getFromEmail()));
				$admin_name = trim(stripslashes($sqb_notifications->getFromName()));

				$subject = trim(stripslashes($sqb_notifications->getSubject()));
				//$subject = 	mb_convert_encoding($subject, "UTF-8", "auto");
				$encoding = mb_detect_encoding($subject, 'auto', true);
				$subject = mb_convert_encoding($subject, 'UTF-8', $encoding);
				$bodyText = trim($bodyText);

				$quizDetails =  SQB_Quiz::loadById($quizId);
				$outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quizId, $outcomeId);

				if($outcomeDetails != false){
					$outcomeTitle = $outcomeDetails->getOutcomeName();			
				}
				$outcomeTitle = !empty($outcomeTitle) ? $outcomeTitle : '';

				if($quizDetails != false){
					$quiz_name = stripslashes($quizDetails->getQuizName());			
					$quiz_type = $quizDetails->getQuizType();			
					$getQuizDesc = stripslashes($quizDetails->getQuizDesc());			
				}


				$subject = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type, $outcomeTitle, $subject, '', '', $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$outcomeId);
				$bodyText = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type,$outcomeTitle, $bodyText,$sqb_question_answer_array, '', $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp,$outcomeId, $category_only_percent,$category_score_breakdown_inpercent);

				$bodyText = preg_replace(
				    '/<span[^>]*class="outcome_data_title_clone"[^>]*>.*?<\/span>/is',
				    '',
				    $bodyText
				);

				$bodyText = preg_replace(
				    '/<div[^>]*class="outcome_data_description_clone"[^>]*>.*?<\/div>/is',
				    '',
				    $bodyText
				);

				 
				add_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
				if($admin_emails != ''){
					$admin_emails = explode(',', $admin_emails);
					
					if(defined('SQB_USE_ADMIN_EMAIL_TO_SEND') && SQB_USE_ADMIN_EMAIL_TO_SEND == 'Y'){
						$tmp_ae = $admin_emails;
						if(isset($tmp_ae[0])){
							$email = $tmp_ae[0];
						}
					}
					

					if (strpos($email, 'sqbguest@') !== false) {
					    $tmp_ae = $admin_emails;
					    if (isset($tmp_ae[0])) {
					        $email = $tmp_ae[0];
					    }
					}

					
					foreach($admin_emails as $admin_email){
						$admin_email = trim($admin_email);
						$quizData = SQB_Quiz::loadById($quizId);
						if(isset($quizData)){

							$quizName = $quizData->getQuizName();	
						}
						if($admin_name == ''){
							$admin_name = $quiz_name;
						}
						//added for email styling
						$bodyText1 = '<html>
						  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
							<style>.generate_pdf_form{display:none !important;}.outcome_data_title_clone { display:none !important; }outcome_data_description_clone { display:none !important; }</style>
						  </head>
						  <body>
							'.$bodyText.'
						  </body>
						</html>';	
						$headers = array('From: '.$first_name.' <'.$email.'>');
						//$headers .= array('Content-Type: text/html; charset=UTF-8'); 
					 	//echo $bodyText;exit;
						wp_mail( $admin_email, $subject, $bodyText1, $headers, $pdf_file);				 
					}
				}
				
				remove_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
			}
		}
	}
	
}

add_shortcode('ShowCategoryScoreServer', 'ShowCategoryScoreContentServer');
function ShowCategoryScoreContentServer($atts, $content=null){
	extract(shortcode_atts(array( 
		'id'=>'',
		'range'=>'',
		'name' => ''
	), $atts));	
	
	$html = '';
	if(!empty($_REQUEST['category_result_list_array']) && is_array($_REQUEST['category_result_list_array'])){
		$category_result_list_array = $_REQUEST['category_result_list_array'];
	}else if(!empty($_REQUEST['category_result_list_array'])){
		$category_result_list_array = (array) json_decode(stripslashes($_REQUEST['category_result_list_array']));
	}else{
		$category_result_list_array = array();
	}
	
	if(!empty($_REQUEST['eachcat_ids'])){
		$eachcat_ids = (array) json_decode(stripslashes($_REQUEST['eachcat_ids']));
	}
	
	if(isset($id) && $id !=""){
		$category = SQB_AdvancedCategoryRule::loadById($id);
		if(!empty($category)){
			
			$category_id = $category->getcategoryId();
			
			if(!empty($category_result_list_array[$category_id])){
				$score = $category_result_list_array[$category_id];
				$range_ = explode(',',$range);
				if ( $score >= $range_[0] && $score <= $range_[1]){

					$category_obj = SQB_QuizCategory::loadById($category_id);
					$catname = $category_obj->getName();
					$desc = stripslashes($category->getCategoryDescription());
					$desc = str_replace('&amp;','&',$desc);
					$desc =  str_replace('%%YOUR_SCORE_CATEGORY_'.$catname.'%%',$category_result_list_array[$category_id],$desc);
					$desc =  str_replace('%%TOTAL_SCORE_CATEGORY_'.$catname.'%%',$eachcat_ids[$category_id],$desc);
					
					$html .= '<div class="ShowCategoryScoreContent" id="sss_'.$category_id.'" data-id="'.$category_id.'">';
					$html .= $desc;
					$html .= '</div>';
				}
			}
		}else{
			$html = '';
		}
	}
	return $html;
}

function SQBSendStudentNotificationEmail($first_name,$email,$quizId, $outcomeId,$sqb_question_answer_array,$pdf_file,$outcome_desc='', $category_result_list_array = '',$custom_fields_data='',$catdata='', $category_number_percent='', $category_number_div='', $firstname_temp='', $category_only_percent='', $category_score_breakdown_inpercent=''){
	
	$quizDetails =  SQB_Quiz::loadById($quizId);
	$getQuizDesc='';
	$outcomeTitle='';
	if($quizDetails != false){
		$quiz_name = stripslashes($quizDetails->getQuizName());			
		$quiz_type = $quizDetails->getQuizType();
		$getQuizDesc = $quizDetails->getQuizDesc();			
		$getQuiznotification = $quizDetails->getEmailNotificationSettings();			
	}else{
		return;
	}
	$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', $quiz_type);

	if($getQuiznotification == '4'){
		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndOutcomeId('student_email', $outcomeId);
	}else if($getQuiznotification == '1'){
		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizId('student_email', $quizId);
	}else if($getQuiznotification == '2'){
		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', $quiz_type);
		if(!empty($sqb_notifications)){
			$sendEmail = $sqb_notifications->getSendEmail();
			if($sendEmail != 'Y'){
				$sqb_notifications = false;
			}
		}else{
			$sqb_notifications = false;
		}
	}else if($getQuiznotification == '3'){
		$sqb_notifications = false;
	}else{
		$sqb_notifications = SQB_QuizNotifications::loadByTypeAndQuizType('student_email', $quiz_type);
		if(!empty($sqb_notifications) && $sqb_notifications->getSendEmail() == 'N'){
			$sqb_notifications = false;
		}
	}

	if($sqb_notifications != false){
		$bodyText = stripslashes($sqb_notifications->getBody());

		$admin_email = trim(stripslashes($sqb_notifications->getFromEmail()));
		$admin_name = trim(stripslashes($sqb_notifications->getFromName()));
		$answerFormat = trim(stripslashes($sqb_notifications->getAnswerFormat()));

		$subject = trim(stripslashes($sqb_notifications->getSubject()));

		$encoding = mb_detect_encoding($subject, 'auto', true);
		$subject = mb_convert_encoding($subject, 'UTF-8', $encoding);
		//$subject = 	mb_convert_encoding($subject, "UTF-8", "auto");

		$bodyText = trim($bodyText);
		
		$outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quizId, $outcomeId);
		
		if($outcomeDetails != false){
			$outcomeTitle = $outcomeDetails->getOutcomeName();	
			//$outcomeHtml = $outcomeDetails->getOutcomeHtml();	
			//$outcomeDescription = rawurldecode($outcomeHtml);	
			//$outcomeDescription = stripslashes($outcome_desc);	

		}
		$subject = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type, $outcomeTitle, $subject, '', '' ,$getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$outcomeId);
		
		$bodyText = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type,$outcomeTitle, $bodyText,$sqb_question_answer_array,$answerFormat, $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp,$outcomeId, $category_only_percent, $category_score_breakdown_inpercent);
		
		$bodyText = str_replace("ShowCategoryScore",'ShowCategoryScoreServer',$bodyText);
    	$bodyText = do_shortcode(stripslashes($bodyText));

		$bodyText = str_replace("%%NAME%%", $first_name, $bodyText);
		$bodyText = str_replace("%%FIRST_NAME%%", $first_name, $bodyText);

		if($quiz_type == 'poll'){
			$quiz_id = !empty($_POST['quiz_id']) ? $_POST['quiz_id'] : 0;
			$pollresult = get_poll_results($quiz_id);
			if(!empty($pollresult)){
				$totalCount = 0;

				// Calculate total count
				foreach ($pollresult as $item) {
					$totalCount += $item['cnt'];
				}

				// Calculate and display percentage for each answer title
				$poll_stuff = '';
				foreach ($pollresult as $item) {
					$percentage = ($item['cnt'] / $totalCount) * 100;
					$formattedPercentage = number_format($percentage, 2); // Limit precision to 2 decimal places
					$poll_stuff .= '<div>'.$item['answer_title'] . ': ' . $formattedPercentage . '%' . '</div>';
				}
			}else{
				$bodyText = str_replace("%%POLLRESULT%%", '', $bodyText);
			}

			$bodyText = str_replace("%%POLLRESULT%%", $poll_stuff, $bodyText);
		}

		if($firstname_temp){
			$bodyText = str_replace("%%FIRST%%", $firstname_temp, $bodyText);
		}else{
			$bodyText = str_replace("%%FIRST%%", $first_name, $bodyText);
		}
		

		$bodyText = preg_replace(
		    '/<span[^>]*class="outcome_data_title_clone"[^>]*>.*?<\/span>/is',
		    '',
		    $bodyText
		);

		$bodyText = preg_replace(
		    '/<div[^>]*class="outcome_data_description_clone"[^>]*>.*?<\/div>/is',
		    '',
		    $bodyText
		);

		add_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );
        
        if($admin_name == ''){
			$admin_name = $quiz_name;
		}
        //added for email styling
		$bodyText1 = '<html>
		  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<style>.generate_pdf_form{display:none !important;}.outcome-printselected-answer{display:none !important;}.outcome_data_title_clone { display:none !important; }outcome_data_description_clone { display:none !important; }</style>
		  </head>
		  <body>
			'.$bodyText.'
		  </body>
		</html>';	
		 $headers = array('From: '.$admin_name.' <'.$admin_email.'>'); 
		//$headers .= array('Content-Type: text/html; charset=UTF-8'); 	 

		// Attachment
		
		$bodyText1 = sqb_email_template_layout($quizId, 'welcome-email', $bodyText1); 
		wp_mail( $email, $subject, $bodyText1, $headers, $pdf_file);
		

		if($sqb_notifications->getSendCopy() == 'Y'){
			$email_ids = $sqb_notifications->getEmailIds();
			$copy_email_subject = $sqb_notifications->getCopyEmailSubject();

			$explode_emailids = explode(",",$email_ids);

			foreach($explode_emailids as $explode_emailid){
				$copy_subject = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type, $outcomeTitle, $copy_email_subject, '', '' ,$getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$outcomeId);
		
				$bodyText = sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type,$outcomeTitle, $bodyText,$sqb_question_answer_array,$answerFormat, $getQuizDesc,$outcome_desc, $category_result_list_array,$custom_fields_data,$catdata, $category_number_percent , $category_number_div, $firstname_temp,$outcomeId, $category_only_percent, $category_score_breakdown_inpercent);

				$bodyText = str_replace("ShowCategoryScore",'ShowCategoryScoreServer',$bodyText);
    			$bodyText = do_shortcode(stripslashes($bodyText));

    			$bodyText = preg_replace(
				    '/<span[^>]*class="outcome_data_title_clone"[^>]*>.*?<\/span>/is',
				    '',
				    $bodyText
				);

				$bodyText = preg_replace(
				    '/<div[^>]*class="outcome_data_description_clone"[^>]*>.*?<\/div>/is',
				    '',
				    $bodyText
				);

				if($admin_name == ''){
					$admin_name = $quiz_name;
				}
		        
				$headers = array('From: '.$admin_name.' <'.$admin_email.'>');
				wp_mail( $explode_emailid, $copy_subject, $bodyText, $headers, $pdf_file);

			}
		}



		

		remove_filter( 'wp_mail_content_type', 'sqb_set_html_content_type' );

	}
}

function deleteSqbPDF($file){
	if(!empty($file[0])){
		@unlink($file[0]);
	}
}

function getSqbPDF(){

	if(!defined('SQB_PD_FILE')){
		return '';
	}

	$_REQUEST['sqb_pdf_download_v2'] = 1;
	$_REQUEST['is-attachment'] = 1;
	//$file = sqb_pdf_download(false);
	require(SQB_FILE.'includes/frontend/pdf-report.php');
	$_REQUEST['sqb_pdf_download_v2'] = 0;
	$_REQUEST['is-attachment'] = 0;

	return $pdffile;
}

function sqbPersonalizeMessage($first_name,$email, $quiz_name ,$quiz_type,$outcomeTitle, $message,$sqb_question_answer_array = '',$answerFormat = '', $quiz_desc='',$outcomeDescription='', $category_result_list_array = '',$custom_fields_data='',$catdata='', $category_number_percent='', $category_number_div='', $firstname_temp ='',$outcomeId='', $category_only_percent = "",$category_score_breakdown_inpercent = ""){         
	
	$outcomeDescription = str_replace("color: rgb(255, 255, 255);","color: #000;",$outcomeDescription);
	$message = str_replace("%%QUIZ_TITLE%%", $quiz_name, $message);
	$message = str_replace("%%QUIZ_DESCRIPTION%%", $quiz_desc, $message);
	$message = str_replace("%%QUIZ_TYPE%%", strtoupper($quiz_type), $message);
	$message = str_replace("%%OUTCOME%%", $outcomeTitle, $message);
	$message = str_replace("%%NAME%%", $first_name, $message);
	$message = str_replace("%%EMAIL%%", $email, $message);
	$message = str_replace("%%OUTCOME_DESCRIPTION%%", $outcomeDescription, $message);
	$message = str_replace('<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid">', '<div class="Quiz-Template-content-inn pos_relative" id="result_temp_btnid" style="display:none;">', $message);
	
	//$message = str_replace("%%SHOW_CATEGORY_TOTAL%%", $catdata, $message);
	$message = str_replace("%%CATEGORY_TOTAL_PERCENT%%", $category_number_percent, $message);
	$message = str_replace("%%CATEGORY_TOTAL_NUMBER%%", $category_number_div, $message);
	$message = str_replace("[CATEGORY_TOTAL_PERCENT]", $category_number_percent, $message);
	$message = str_replace("[CATEGORY_ONLY_PERCENT]", $category_only_percent, $message);
	$message = str_replace("[CATEGORY_SCORE_BREAKDOWN_INPERCENT]", $category_score_breakdown_inpercent, $message);
	$message = str_replace("[CATEGORY_TOTAL_NUMBER]", $category_number_div, $message);
	
	$message = str_replace("[CATEGORY_TOTAL_NUMBER]", $category_number_div, $message);

	if( $quiz_type == "assessment" || $quiz_type == "scoring") {

		$correct_answers = !empty($_REQUEST['correct_answers']) ? $_REQUEST['correct_answers'] : 0;
        $total_ques = !empty($_REQUEST['total_ques']) ? $_REQUEST['total_ques'] : 0;
        $incorect_answers = $total_ques - $correct_answers;

		$message =  str_replace('%%CORRECTANSWERS%%',$correct_answers,$message); 
        $message =  str_replace('%%TOTALQUESTIONS%%',$total_ques,$message);  
        $incorect_answers = $total_ques - $correct_answers;
        $message =  str_replace('%%INCORRECTANSWERS%%',$incorect_answers,$message); 

		if($quiz_type == 'scoring'){
			$total_points = $_REQUEST['total_pt'];
			$points_scored = $_REQUEST['yourpoints'];
		}else{
			$total_points = $total_ques;
			$points_scored = $_REQUEST['correct_answers'];
		}

        try {
            $score_per = ($points_scored / $total_points) * 100;
            $score_per = number_format($score_per, 2) . '%';
        }catch(DivisionByZeroError $e){
            $score_per = '';
        }

		$message =  str_replace('%%SCORE%%',$score_per,$message); 
	}
	
	// 
	if(!empty($category_result_list_array)){
		$CATEGORY_SCORES = SQBCategoryResultDetailsHtml($category_result_list_array,'', $quiz_type);
		$message = str_replace("%%CATEGORY_SCORES%%", $CATEGORY_SCORES, $message);
	}

	if($firstname_temp){
		$message = str_replace("%%FIRST%%", $firstname_temp, $message);
	}else{
		$message = str_replace("%%FIRST%%", $first_name, $message);
	}

	foreach($custom_fields_data as $custom_field_data){
		$message = str_ireplace("%%".$custom_field_data['key']."%%", $custom_field_data['value'], $message);

	}
	
	$ansData = '';

	$sqb_incorrect_ans_exp = sqbGetValidSettingsByKey('sqb_incorrect_ans_exp');
	if(isset($sqb_incorrect_ans_exp)){
		$sqb_incorrect_ans_exp = $sqb_incorrect_ans_exp;
	}else{
		$sqb_incorrect_ans_exp = 'Incorrect Answer Explanation';
	}
	
	if($sqb_question_answer_array != ''){ 
		$answer_tags_ids = array();
		foreach($sqb_question_answer_array as $sqb_question_answer){
			$currentAnsFormat = $answerFormat;
			$quesId = @$sqb_question_answer['ques_id'];	
			$answer_ids = $sqb_question_answer['answer_id'];	
			$points_scored = $sqb_question_answer['points_scored'];	
			$total_points = $sqb_question_answer['total_points'];	
			//$correct_ans = $sqb_question_answer['correct_ans'];	
			$correct_answer_msg_exp = @$sqb_question_answer['correct_answer_msg_exp'];	
			$incorrect_answer_msg_exp = @$sqb_question_answer['incorrect_answer_msg_exp'];	
			$answer_type = $sqb_question_answer['answer_type'];	
			$other_field = !empty($sqb_question_answer['other_field']) ? $sqb_question_answer['other_field'] : '';

			if(!empty($sqb_question_answer['answer_tags'])){
				$answer_tags_ids[] = $sqb_question_answer['answer_tags'];
			}
			$correct_ans = array();
			$data = array();
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
					$correct_ansids = implode(',' ,$correct_ans_ids);
					if(is_array($correct_ansids)){
						sort($correct_ansids);
					}
					if(is_array($answer_ids)){
						sort($answer_ids);
					}
										 
					if ($correct_ansids===$answer_ids) {						 
						$multipleans=true;
					}else{						 
						$multipleans=false;
					}			 
				}
			}

			
			 
			$incorrect_answer_msg_exp_text='';

			$outcome_screen_result = sqbGetValidSettingsByKey('outcome_screen_result');
			if($outcome_screen_result == ""){
				$outcome_screen_result = 'Your Result';
			} 

			$outcome_screen_correct_answer = sqbGetValidSettingsByKey('outcome_screen_correct_answer');
			if($outcome_screen_correct_answer == ""){
				$outcome_screen_correct_answer = 'Correct Answer';
			} 

			$incorrect_answer_msg = sqbGetValidSettingsByKey('incorrect_answer_msg');
			if($incorrect_answer_msg == ""){
				$incorrect_answer_msg = 'Incorrect Answer';
			} 

			if($correct_answer_msg_exp == ''){
				$correct_answer_msg_exp = $outcome_screen_correct_answer;
			}

			if(isset($answersdataobj)){
				foreach($answersdataobj as $answerdataobj) {
					$ans_id = $answerdataobj->getId();  					 
					$correct_answer = $answerdataobj->getCorrectAnswer();  	
					
					if($answer_type == "text"){
						/*if($correct_answer == 'true'){
							$correct_ans[] = $answerdataobj->getAnswerTitle();							
						}*/
						if($quiz_type == "assessment" || $quiz_type == "scoring"){							 
							$incorrect_answer_msg_exp_text = "";
						}
					}else if($answer_type =="multiple"){
						if($correct_answer == 'true'){
							$correct_ans[] = $answerdataobj->getAnswerTitle();							
						}
						if($quiz_type == "assessment" || $quiz_type == "scoring"){							 
							if ($multipleans) {								   			 
								$incorrect_answer_msg_exp_text ='';
							}else{
								$incorrect_answer_msg_exp_text ='<br><b>'.$outcome_screen_result.'</b>: '.$outcome_screen_correct_answer.'<br> ' .stripslashes($correct_answer_msg_exp).'<br>';		
							}
						}	
					}else{				 
						if($correct_answer == 'true'){
							$correct_ans[] = $answerdataobj->getAnswerTitle();						
							if($answer_ids == $ans_id){	
								if($quiz_type == "assessment" || $quiz_type == "scoring"){
									 $incorrect_answer_msg_exp_text ='<br><b>'.$outcome_screen_result.'</b>: '.$outcome_screen_correct_answer.'<br> ' .stripslashes($correct_answer_msg_exp).'<br>';	
									 break;						 
								}				 
							}else{							
								$incorrect_answer_msg_exp_text ='';	
							}			 
						}else{
							if($answer_ids ==$ans_id){							 
								if($quiz_type == "assessment" || $quiz_type == "scoring"){
										$incorrect_answer_msg_exp_text ='<br><b>'.$outcome_screen_result.'</b>: '.$incorrect_answer_msg.'<br><b>'.$sqb_incorrect_ans_exp.':</b> ' .stripslashes($incorrect_answer_msg_exp).'<br>';		
										break;					 
								}				 
							}else{							 
								$incorrect_answer_msg_exp_text='';
							}	
						}
					}				
				}	
				$data[] = $incorrect_answer_msg_exp_text;		

			} 
			
			
			$correct_ans = implode(',' ,$correct_ans);
			$data = implode('' ,$data);
			$correct_ans = $correct_ans.$data;
			$answer_ids = explode(',' ,$answer_ids);
			$answer_text = '';
			
			$i = 1;
			if(count($answer_ids)){
				foreach($answer_ids as $answer_id){
					$answersObj = SQB_QuizAnswers::loadById($answer_id);
					if($answersObj){
						$ans_id = $answerdataobj->getId();  
						if($answersObj->getAnswerTitle() != '' && $answer_type !="numerical_text"){
							$answer_text .='<br>' .stripslashes($answersObj->getAnswerTitle());
						}else{
							$answer_text .='<br>' .stripslashes($sqb_question_answer['answer_text']);
						}
						$i++;
					}
				}
			}else{
				$answer_text = stripslashes($sqb_question_answer['answer_text']);	
			}
			
			if($answer_type == 'matrix'){

				$sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');

				if(isset($sqb_answer_cust)){
					$sqb_answer_cust = $sqb_answer_cust;
				}else{
					$sqb_answer_cust = 'Answer';
				}

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
					foreach($answer_given_array as $id){
						if($id == ''){
							continue; 
						}
						$answer_given_array_key = explode('|',$answer_given_array[$i-1]);	
						$answersdataobj =  SQB_QuizAnswers::loadById($id);	  
						//$ans_data =  'No Title';
						if(isset($answersdataobj) && $answersdataobj != false){		 	
							$answer = $answersdataobj->getAnswerTitle();			 		
							if($answer_type == 'matrix' && $answersdataobj->getMatrixValues() != ''){
								$matrix_values = $answersdataobj->getMatrixValues();
								$matrix_values_arr = explode(',',$matrix_values);
								$matrix_values_item = $matrix_values_arr[$answer_given_array_key[1]];
								$matrix_values_item_value = explode('|',$matrix_values_item);
								
								$matrix_label_text = explode('|',$matrix_label_text_arr[$matrix_values_item_value[0]]);
								$final_matrix_label_text = urldecode(strip_tags($matrix_label_text[1]));
								$ans_data .=  '<div>'.$answer;
								$ans_data .=  '<br><strong>'.$sqb_answer_cust.' : </strong> '.$matrix_values_item_value[1].'</div><br>';
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
			//$answer_text = stripslashes($sqb_question_answer['answer_text']);	
			if($answer_type == 'matrix' || $answer_type == 'multiple'){
				$answer_text = $answer_text;
			} else {

				if(!empty($other_field)){
					$answer_text = '<span class="sqb-answer-inner">'.strip_tags($other_field).'</span>';
				}else{
					$answer_text = '<span class="sqb-answer-inner">'.strip_tags($answer_text,'<br>').'</span>';
				}

			}
			
			$sqb_question_cust = sqbGetValidSettingsByKey('sqb_question_cust');
			$sqb_answer_cust = sqbGetValidSettingsByKey('sqb_answer_cust');

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

			if($currentAnsFormat != ''){
				if($answer_type == 'matrix' ){
					$currentAnsFormat = '<br>--------------------------------------------------'.$currentAnsFormat;
				}
				//$currentAnsFormat = '<br>'.$currentAnsFormat;
				$currentAnsFormat = str_replace("%%QUESTION%%", $quesText.'<br>', $currentAnsFormat);
				$currentAnsFormat = str_replace("%%ANSWER%%", $answer_text.'<br>', $currentAnsFormat);
				$currentAnsFormat = str_replace("%%CORRECTANSWERMSG%%", $correct_ans.'<br>', $currentAnsFormat);
			
				$ansData .= $currentAnsFormat;
			}else{

				$ansData .= '<div class="answer-merge-tag"><br><span class="sqb-question-heading"><strong>'.$sqb_question_cust.': </strong>' .$quesText .'</span><br><span class="sqb-question-content"><strong>'.$sqb_answer_cust.': </strong>' .$answer_text .'</span><br></div>';
			}
		}
		$message = str_replace("%%ANSWERS%%", $ansData, $message);	
		
		if($quiz_type == "assessment"){
			$message = str_replace("%%CORRECTANSWERS%%", $points_scored, $message);	
			$message = str_replace("%%TOTALQUESTIONS%%", $total_points, $message);	
		}else if($quiz_type == "scoring"){
			$points_scored_percent = number_format(round($points_scored * 100 / $total_points, 2), 2);
			
			$message = str_replace("%%YOURSCORE%%", $points_scored, $message);	
			$message = str_replace("%%SCOREINPERCENT%%", $points_scored_percent, $message);	
			$message = str_replace("%%TOTALSCORE%%", $total_points, $message);	
		}

		$message = str_replace("%%POINTS%%", $points_scored .'/'. $total_points, $message);	
		//$message = str_replace("%%SCORE%%", $points_scored .'/'. $total_points, $message);	
		
	}else{  
		$message = str_replace("%%ANSWERS%%", "", $message);	
		$message = str_replace("%%POINTS%%", 0, $message);	
		$message = str_replace("%%SCORE%%", 0, $message);	
	} 
	
	$cat_html = '';
	if($category_result_list_array != ''){ 
		$cat_html = SQBCategoryResultDetailsHtml($category_result_list_array, 'email', $quiz_type);
		
		
	}
	
	$outcome_tag_name = '';
	if($outcomeId != ''){
	$outcome_tag_name = SQBGetOutcomeTagsName($outcomeId);
	}
	
	$tags_html = '';
	if(!empty($answer_tags_ids) || $outcome_tag_name != ''){ 
	$tags_html = SQBGetTagsContentByIds($answer_tags_ids, $outcome_tag_name);

	

	$tags_html = str_replace("text-align: center","",$tags_html);
	}
	
	$message = str_replace("%%SHOW_CATEGORY_TOTAL%%", $cat_html, $message);
	$message = str_replace("[SHOW_CATEGORY_TOTAL]", $cat_html, $message);
	$message = str_replace("[SHOWALLUSERTAGS]", $tags_html, $message);


	$message =  str_replace('[CategoryRank','[CategoryRankFinal',$message); 
	$message =  str_replace('[ConditionalTAGS','[ConditionalTAGSFinal',$message); 
	$message =  str_replace('[/ConditionalTAGS','[/ConditionalTAGSFinal',$message); 

	add_shortcode('SHOWTAGCONTENT', 'sqbShowTagsContent');
	$message = do_shortcode($message);

	// Replace showtaggcontent shortcode
	if(!empty($answer_tags_ids) || $outcome_tag_name != ''){ 
		$message = SQBGetTagsContentByShortcode($answer_tags_ids,$message,$outcome_tag_name);
	}

	$message =  str_replace('[CHART_HEADING]','',$message); 
    $message =  str_replace('[CATEGORY_SPIDER_CHART]','',$message); 
    $message =  str_replace('[CATEGORY_BAR_CHART]','',$message); 
    $message =  str_replace('[QUESTION_ANSWER_DATA_CHART]','',$message); 

	//echo $message;exit;
	//$message = $tags_custom_html;
	return $message;
}

function sqb_set_html_content_type(){
	return 'text/html';
}

function  SQBGetAutoresponderActionDataForQuiz($quiz_id,$email,$name, $outcomdeId, $password ,$sqb_question_answer_array, $outcome_ids_array , $sqb_custom_fields_array, $double_optin=''){
	     
	    
	    $user_added_plateform_array = array();
	    $quizData = SQB_Quiz::loadById($quiz_id);
	    if($quizData == false){
				$quizData = null;
		} 
		
		if(isset($quizData)){
			$show_optin_screen = $quizData->getShowOptinScreen();
			if($show_optin_screen == 'N'){
			return;
			}
			
			$user_added_plateform_array = explode(",",$quizData->getUserAddedPlatform());
			$user_added_my_email_platform = explode(",",$quizData->getUserAddedMyEmailPlatform());
			if(!in_array('add_user_in_your_email_platform',$user_added_my_email_platform)){
				$user_added_plateform_array = array();
			}
			if(is_array($user_added_my_email_platform) && count($user_added_my_email_platform)){
				foreach($user_added_my_email_platform as $user_added_my_email_platform_item){
					$user_added_plateform_array[] = strtoupper($user_added_my_email_platform_item);
				}
			}

			$user_added_plateform_array_new = $user_added_plateform_array;
		
		}
		 
	    $quizAutoRespondersObj =  SQB_QuizAutoresponder::loadByQuizId($quiz_id);

		$extra_param = $quizData->getAllOtherOptions();
		$extra_op = maybe_unserialize($extra_param);
		
		if(!empty($extra_op)){
			$extra_op['email_based_subscriber'] = isset($extra_op['email_based_subscriber']) ? $extra_op['email_based_subscriber'] : 'subscriber_based';
			if(isset($extra_op['email_based_subscriber']) && $extra_op['email_based_subscriber'] == 'outcome_based') {
				if(!empty($quizAutoRespondersObj)){
					foreach ($quizAutoRespondersObj as $key => $qar) {
						if($qar->getOutcomeId() > 0 && $qar->getOutcomeId() != $outcomdeId){
							unset($quizAutoRespondersObj[$key]);
						}
					}

					$quizAutoRespondersObj = array_values($quizAutoRespondersObj);
				}
			}
		}
		
		

	    $outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quiz_id, $outcomdeId);

    	$outcome_tag_name = '';
	    $tag = '';
	    $customFields = '';
	    if($outcomeDetails != false){
			
			$tag = ($outcomeDetails->getTag() == 'NULL') ? '' : $outcomeDetails->getTag();	
			 $outcome_tag_name = $outcomeDetails->getTag();	
			
		}
		
		if(isset($quizData)){			
			$all_answer_tags_name_array =  array();
			if(is_array($sqb_question_answer_array) && count($sqb_question_answer_array)){
				foreach($sqb_question_answer_array as $sqb_question_answer){
					if(isset($sqb_question_answer['ques_id'])){
						
						$answer_tags_text_array = array();
						if(isset($sqb_question_answer['answer_tags'])){
							$answer_tag_ids = $sqb_question_answer['answer_tags'];
							$answer_tags_text_array = SQBGetTagsNameByIds($answer_tag_ids);
						}
						$all_answer_tags_name_array = array_merge($all_answer_tags_name_array,$answer_tags_text_array);
						$answer_tags_text = implode(',',$answer_tags_text_array);
					}
					
				}
				
				if($tag != ''){
					$all_answer_tags_name_array[] = $tag;
				}
				if(is_array($all_answer_tags_name_array) && count($all_answer_tags_name_array)){
					$tag = implode(',', $all_answer_tags_name_array);
				}
			}
		}


	
		
		
		if(in_array('GROUNDHOGG',$user_added_plateform_array)){
			if(!isset($quizAutoRespondersObj) || !is_array($quizAutoRespondersObj)){
				$quizAutoRespondersObj =  array();
			}
			
			$sqbGroundhoggDataEmpty = new SQB_QuizAutoresponder();
			$sqbGroundhoggDataEmpty->setId('');
			$sqbGroundhoggDataEmpty->setName('groundhogg');
			$sqbGroundhoggDataEmpty->setQuizId($quiz_id);
			$sqbGroundhoggDataEmpty->setAction('');
			$sqbGroundhoggDataEmpty->setActionType('');
			$sqbGroundhoggDataEmpty->setActionId('');
			
			$sqbGroundhoggDataEmpty->setActionData('');
			$sqbGroundhoggDataEmpty->setDate('');
			$quizAutoRespondersObj[] = $sqbGroundhoggDataEmpty;
		}else if(in_array('DRIP',$user_added_plateform_array)){
			$sqbdripDataEmpty = new SQB_QuizAutoresponder();
			$sqbdripDataEmpty->setId('');
			$sqbdripDataEmpty->setName('drip');
			$sqbdripDataEmpty->setQuizId($quiz_id);
			$sqbdripDataEmpty->setAction('add');
			$sqbdripDataEmpty->setActionType('');
			$sqbdripDataEmpty->setActionId('');
			
			$sqbdripDataEmpty->setActionData('');
			$sqbdripDataEmpty->setDate('');
			$quizAutoRespondersObj[] = $sqbdripDataEmpty;
		}
		
	

		if(isset($quizAutoRespondersObj) && is_array($quizAutoRespondersObj)){
			 $count = count($quizAutoRespondersObj);
			 foreach($quizAutoRespondersObj as $quizAutoResponderObj){
				 $destination = $quizAutoResponderObj->getName();
				 
				 if(!in_array(strtoupper($destination),$user_added_plateform_array_new)){ 
					 continue;
				 }
				 
				

				 $className = $param = $destination.'SQB';
				if($destination == 'activecampaign'){
					$param .= activecampaignGetParams($quizAutoResponderObj, $tag);

					$outcomeRanking = SQB_OutcomeRankMapping::loadByQuizId($quiz_id);
					
				    if($outcomeRanking != false){
				    	$sqbarray = array_count_values($outcome_ids_array);
						arsort($sqbarray);

				    	$customFields = sqbOutcomeRankingDetails($outcomeRanking, $sqbarray, $quiz_id);

				    }
	  
				}else if($destination == 'convertkit'){
					$param .= convertkitGetParams($quizAutoResponderObj, $tag);
				}else if($destination == 'mailchimp'){
					$param .= mailchimpGetParams($quizAutoResponderObj, $tag);	
						
				}else if($destination == 'drip'){
					$param .= dripGetParams($quizAutoResponderObj, $tag);	
				}else if($destination == 'aweber'){
					$param .= aweberGetParams($quizAutoResponderObj, $tag);	
				}else if($destination == 'zapier'){
					$param .= zapierGetParams($quizAutoResponderObj,$outcome_tag_name);	
				}else if($destination == 'googlespreadsheet'){
					$param .= googlespreadsheetGetParams($quizAutoResponderObj,$outcome_tag_name);	
				}else if($destination == 'sendinblue'){
					$param = SQBSendinblueGetParams($quizAutoResponderObj,$tag );
				}else if($destination == 'kartra'){
					$param = SQBKartraGetParams($quizAutoResponderObj,$tag );	
					/*echo "<pre>";
					print_r($param);
					exit;*/
				}else if($destination == 'getresponse'){
					$param = SQBGetresponseGetParams($quizAutoResponderObj,$tag);	
					
				}else if($destination == 'mailerlite'){
					$param = SQBMailerliteGetParams($quizAutoResponderObj,$tag);	
					
				}else if($destination == 'sendfox'){
					$param = SQBSendfoxGetParams($quizAutoResponderObj,$tag);	
					
				}else if($destination == 'moosend'){
					$param = SQBMoosendGetParams($quizAutoResponderObj,$tag);				
							
				}else if(($destination == 'vbout') || ($destination == 'klaviyo') || ($destination == 'acumbamail') || ($destination == 'hubspot')){
					$param = SQBCommonGetParams($quizAutoResponderObj,$tag, strtoupper($destination));			
				}
				
				
				
				
				$action = $quizAutoResponderObj->getAction();
			    $destination_common_array = array('vbout','getresponse','mailerlite','sendfox','moosend', 'klaviyo', 'acumbamail','hubspot');
			    
				 if(!in_array($destination,$destination_common_array) && $destination != "dap" && $destination != "zapier" && $destination != "googlespreadsheet" && $destination != "scp" && $destination != "facebook" && $action == 'add' &&  $destination != 'webhook' && $destination != 'fluentcrm' && $destination != 'mailpoet' && $destination != 'groundhogg'){
					
						$dir = plugin_dir_path( __DIR__ );
						$filename = $dir . "/plugins/" . $className . "/" . $className . ".class.php";
						include_once ($filename);
						$plugin=new $className();
						if($destination == 'mailchimp'){
							$errmsg = $plugin->register($email, $name, $param, $sqb_custom_fields_array,$double_optin);
						}else{
							$errmsg = $plugin->register($email, $name, $param, $customFields,$double_optin);
							
						}
						
				}else if(in_array($destination,$destination_common_array)){ 
							$dir = plugin_dir_path( __DIR__ );
							$filename = $dir . "/plugins/" . $className . "/" . $className . ".class.php";
							$param_details = explode ( ":", $param );	
							
							include_once ($filename); 
							$plugin= new $className($param_details[1]);
							$errmsg = $plugin->register($email, $name, $param, $customFields);	
								
				}else if($destination == 'googlespreadsheet'){
					//$quizData = SQB_Quiz::loadById($quiz_id);
					$dir = plugin_dir_path( __DIR__ );
					$filename = $dir . "/plugins/SQBconnect/SQBconnect.class.php";
					if (file_exists($filename)) {
						include_once($filename);
					}
					else{
						continue;
					}

					try{
						
						if(isset($quizData)){
							$total_points = 0;
							$sqb_question_answer_array_new =  array();
							$sqb_question_answer_array_new_with_qid =  array();
							$all_answer_tags_name_array =  array();
							if(is_array($sqb_question_answer_array) && count($sqb_question_answer_array)){
								$counter = 1;
								$question_list_for_formula = array();
								foreach($sqb_question_answer_array as $sqb_question_answer){
									if(isset($sqb_question_answer['ques_id'])){
										$ques_id = $sqb_question_answer['ques_id'];
										$correct_ans = $sqb_question_answer['correct_ans'];
										$answer_text = $sqb_question_answer['answer_text'];

										if($sqb_question_answer['answer_type'] == 'matching_text'){
											$answer_text = strip_tags($sqb_question_answer['answer_text']);
										}

										$points_scored = $sqb_question_answer['points_scored'];
										
										$answer_tags_text_array = array();
										if(isset($sqb_question_answer['answer_tags'])){
											$answer_tag_ids = $sqb_question_answer['answer_tags'];
											$answer_tags_text_array = SQBGetTagsNameByIds($answer_tag_ids);
										}
										
										$all_answer_tags_name_array = array_merge($all_answer_tags_name_array,$answer_tags_text_array);
										$answer_tags_text = implode(',',$answer_tags_text_array);
										
										if(isset($sqb_question_answer['answer_points_scored'])){
											$points_scored = $sqb_question_answer['answer_points_scored'];
										}
										
										$total_points = $sqb_question_answer['total_points']; 
										$question_type = '';
										$question_title = '';
										$questionObj = SQB_QuizQuestionBank::loadById($ques_id);
										if($questionObj){ 
											$question_title = $questionObj->getQuestionTitle();
											$question_type = $questionObj->getQuestionType();
										}
										if($quizData->getQuizType() == 'personality'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'scoring' || $quizData->getQuizType() == 'calculator'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans,'points_scored'=>$points_scored, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'assessment'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'survey' ){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
										}
										if($quizData->getQuizType() == 'calculator'){
											if($question_type == 'multi'){
											$answer_points = $sqb_question_answer['answer_points_scored'];
											}else if($question_type == 'slider'){
											$num = preg_replace('/[^0-9.]+/', '', $sqb_question_answer['answer_text']);
											$answer_points = $num;
											}else if($question_type == 'numerical_text'){
											$answer_points = (int) $sqb_question_answer['answer_text'];
											}else{
											$answer_points = (int) $sqb_question_answer['answer_points_scored'];
											}
											$question_list_for_formula[$counter] = $answer_points;
										} 
									}
									$counter++;
								}
							}
							
							$questiones_array_data = SQB_QuizQuestions::loadByQuizId($quiz_id);
							if(is_array($questiones_array_data) && count($questiones_array_data)){
								foreach($questiones_array_data as $question_data){
									 $question_id = $question_data->getQuestionId();
									  $questionObj = SQB_QuizQuestionBank::loadById($question_id);			
									  if($questionObj){
										  if(isset($sqb_question_answer_array_new_with_qid[$question_id])){
											  $sqb_question_answer_array_new[] = $sqb_question_answer_array_new_with_qid[$question_id];
										  }else{
											$question_title = $questionObj->getQuestionTitle();
											$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer' => '','correct_answer'=>'','points_scored'=>'');
										}
									  }
									
								}	
							}
							
							$formula_details = array();
							$formula_object = SQB_CalculatorFormula::loadByQuizId($quiz_id);
							if(is_array($formula_object) && count($formula_object)){
								foreach($formula_object as $formula_object_data){
									$formula_id = $formula_object_data->getId();
									$formula_html = $formula_object_data->getHtml();
									$orignal_formula_html = $formula_object_data->getHtml();
									
									$count=0;
									while ($formula_html[$count] != '') {
									  $count++;
									}
									
									foreach(array_reverse($question_list_for_formula,true) as $key=>$value){
										$findstr = 'Q'.$key;
										for($i=0;$i<=$count;$i++){
										$formula_html = str_replace($findstr,$value,$formula_html);
										}
										
									}
									$formula_value = eval('return '.$formula_html.';');
									
									$formula_details[] = array('formula'=>$orignal_formula_html,'value'=> $formula_value);
								}
							}
							//$formula_details[] = array('formula_id'=>'Q1+Q2','id'=>18, 'value'=>'777');	
							
							
							$fields_array = array('quizData'=>$quizData,'outcomeDetails'=>$outcomeDetails,'sqb_question_answer_array_new'=>$sqb_question_answer_array_new,'total_points'=>$total_points, 'sqb_custom_fields_array'=>$sqb_custom_fields_array, 'all_answer_tags_name_array'=> $all_answer_tags_name_array, 'formula_details'=>$formula_details);
														
							$quizName = $quizData->getQuizName();	
							$param .= ':'.$quiz_id.':'.$quizName;
						}
						
						$obj = new SQBconnect();
						$obj->register($email,$name,$param,$fields_array);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}	
				}else if($destination == 'zapier'){
					//$quizData = SQB_Quiz::loadById($quiz_id);
					$dir = plugin_dir_path( __DIR__ );
					$filename = $dir . "/plugins/SQBconnect/SQBconnect.class.php";
					if (file_exists($filename)) {
						include_once($filename);
					}
					else{
						continue;
					}

					try{
						
						if(isset($quizData)){
							$total_points = 0;
							$sqb_question_answer_array_new =  array();
							$sqb_question_answer_array_new_with_qid =  array();
							$all_answer_tags_name_array =  array();
							if(is_array($sqb_question_answer_array) && count($sqb_question_answer_array)){
								$counter = 1;
								$question_list_for_formula = array();
								foreach($sqb_question_answer_array as $sqb_question_answer){
									if(isset($sqb_question_answer['ques_id'])){
										$ques_id = $sqb_question_answer['ques_id'];
										$correct_ans = @$sqb_question_answer['correct_ans'];
										$answer_text = @$sqb_question_answer['answer_text'];
										$points_scored = $sqb_question_answer['points_scored'];
										
										if($sqb_question_answer['answer_type'] == 'matching_text'){
											$answer_text = strip_tags(@$sqb_question_answer['answer_text']);
										}

										$answer_tags_text_array = array();
										if(isset($sqb_question_answer['answer_tags'])){
											$answer_tag_ids = $sqb_question_answer['answer_tags'];
											$answer_tags_text_array = SQBGetTagsNameByIds($answer_tag_ids);
										}
										
										$all_answer_tags_name_array = array_merge($all_answer_tags_name_array,$answer_tags_text_array);
										$answer_tags_text = implode(',',$answer_tags_text_array);
										
										if(isset($sqb_question_answer['answer_points_scored'])){
											$points_scored = $sqb_question_answer['answer_points_scored'];
										}
										
										$total_points = $sqb_question_answer['total_points']; 
										$question_type = '';
										$question_title = '';
										$questionObj = SQB_QuizQuestionBank::loadById($ques_id);
										if($questionObj){ 
											$question_title = $questionObj->getQuestionTitle();
											$question_type = $questionObj->getQuestionType();
										}
										if($quizData->getQuizType() == 'personality'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'scoring' || $quizData->getQuizType() == 'calculator'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans,'points_scored'=>$points_scored, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'assessment'){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans, 'answer_tags' => $answer_tags_text);
										}else if($quizData->getQuizType() == 'survey' ){
											$sqb_question_answer_array_new_with_qid[$ques_id] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
										}
										if($quizData->getQuizType() == 'calculator'){
											if($question_type == 'multi'){
											$answer_points = $sqb_question_answer['answer_points_scored'];
											}else if($question_type == 'slider'){
											$num = preg_replace('/[^0-9.]+/', '', $sqb_question_answer['answer_text']);
											$answer_points = $num;
											}else if($question_type == 'numerical_text'){
											$answer_points = (int) $sqb_question_answer['answer_text'];
											}else if($question_type == 'weight_and_height'){
											$answer_points = $sqb_question_answer['answer_text'];
											}else{
											$answer_points = (int) $sqb_question_answer['answer_points_scored'];
											}
											$question_list_for_formula[$counter] = $answer_points;
										} 
									}
									$counter++;
								}
							}
							
							$questiones_array_data = SQB_QuizQuestions::loadByQuizId($quiz_id);
							if(is_array($questiones_array_data) && count($questiones_array_data)){
								foreach($questiones_array_data as $question_data){
									 $question_id = $question_data->getQuestionId();
									  $questionObj = SQB_QuizQuestionBank::loadById($question_id);			
									  if($questionObj){
										  if(isset($sqb_question_answer_array_new_with_qid[$question_id])){
											  $sqb_question_answer_array_new[] = $sqb_question_answer_array_new_with_qid[$question_id];
										  }else{
											$question_title = $questionObj->getQuestionTitle();
											$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer' => '','correct_answer'=>'','points_scored'=>'');
										}
									  }
									
								}	
							}
							
							$formula_details = array();
							$formula_object = SQB_CalculatorFormula::loadByQuizId($quiz_id);
							if(is_array($formula_object) && count($formula_object)){
								foreach($formula_object as $formula_object_data){
									$formula_id = $formula_object_data->getId();
									$formula_html = $formula_object_data->getHtml();
									$orignal_formula_html = $formula_object_data->getHtml();
									
									$count=0;
									while ($formula_html[$count] != '') {
									  $count++;
									}
									
									foreach(array_reverse($question_list_for_formula,true) as $key=>$value){
										$findstr = 'Q'.$key;

										$val = explode(',',$value);
										if(count($val) == 2){
											for($i=0;$i<=$count;$i++){
												$formula_html = str_replace($findstr.'W',$val[0],$formula_html);
												$formula_html = str_replace($findstr.'H',$val[1],$formula_html);
											}
										}

										for($i=0;$i<=$count;$i++){
										$formula_html = str_replace($findstr,$value,$formula_html);
										}
										
									}

									$formula_value = eval('return '.$formula_html.';');

									
									$formula_details[] = array('formula'=>$orignal_formula_html,'value'=> $formula_value);
								}
							}
							//$formula_details[] = array('formula_id'=>'Q1+Q2','id'=>18, 'value'=>'777');	
							

							if($quizData->getQuizType() == 'scoring'){

	$category_result_list_array = $_POST['category_result_list_array'];
    if(isset($_POST['category_result_list_array']) && is_array($_POST['category_result_list_array'])){
        $category_result_list_array = $_POST['category_result_list_array'];
    }else{
        $category_result_list_array = json_decode(stripslashes($_REQUEST['category_result_list_array']));
    }

  
  	if(!empty($category_result_list_array)){

    $maxCatTotal = json_decode(wp_kses_stripslashes($_POST['eachcat_ids']), true);


    $temparray = array();
    foreach ($category_result_list_array as $cat_id => $cat_val) {

        $total = $maxCatTotal[$cat_id];
        //$percentage = ($cat_val / $total) * 100;
		if ($total > 0 && $cat_val > 0) {
			$percentage = ($cat_val / $total) * 100;
		}else{
			$percentage = 0;
		}
			
        $temparray[$cat_id] = round($percentage,2);
   
    }

    asort($temparray);    
    
    $category_high_rank = array();
	$category_low_rank = array();
	$category_high_rank_category = array();
	$category_low_rank_category = array();

    foreach ($temparray as $cat_id => $cat_val) {

        $category = SQB_QuizCategory::loadById($cat_id);
		$title = '';
		$description = '';
		if(!empty($category)){
			$title = $category->getName();
			$description = $category->getDescription();
		}
        $total = $maxCatTotal[$cat_id];
        $category_low_rank[] = $cat_val.'%';
        $category_low_rank_category[] = $title;
    }

    arsort($temparray);
   
    foreach ($temparray as $cat_id => $cat_val) {

        $category = SQB_QuizCategory::loadById($cat_id);
		$title = '';
		$description = '';
		if(!empty($category)){
			$title = $category->getName();
			$description = $category->getDescription();
		}
        $total = $maxCatTotal[$cat_id];
        $category_high_rank[] = $cat_val.'%';
        $category_high_rank_category[] = $title;
    }

								
							}
						}

							
							$fields_array = array('quizData'=>$quizData,'outcomeDetails'=>$outcomeDetails,'sqb_question_answer_array_new'=>$sqb_question_answer_array_new,'total_points'=>$total_points, 'sqb_custom_fields_array'=>$sqb_custom_fields_array, 'all_answer_tags_name_array'=> $all_answer_tags_name_array, 'formula_details'=>$formula_details,
								'category_high_rank' => $category_high_rank, 
								'category_low_rank' => $category_low_rank,
								'category_name_high_rank' => $category_high_rank_category, 
								'category_name_low_rank' => $category_low_rank_category
							);


							$quizName = $quizData->getQuizName();	
							$param .= ':'.$quiz_id.':'.$quizName;
						}
						
						$obj = new SQBconnect();
						$obj->register($email,$name,$param,$fields_array);
					}
					catch(Exception $e){
						echo $e->getMessage();
					}	
				}else if($destination == 'webhook'){
					       $webhookQuiz   = SQB_Quiz::loadById($quiz_id);
					       
						   if($webhookQuiz){
						   $user_added_my_email_platform =  $webhookQuiz->getUserAddedMyEmailPlatform();
						   $show_optin_screen =  $webhookQuiz->getShowOptinScreen();
						   $user_added_my_email_platform_array = explode(",",$user_added_my_email_platform);
						
						   if(($show_optin_screen == 'Y') && in_array('Webhook',$user_added_my_email_platform_array)){
					
									$web_hook_url = $quizAutoResponderObj->getActionData();
									$quizData = SQB_Quiz::loadById($quiz_id);
									$dir = plugin_dir_path( __DIR__ );
									
									
									$filename = $dir . "/plugins/SQBwebhook/SQBwebhook.class.php";
									if (file_exists($filename)) {
										include_once($filename);
									}
									else{
										continue;
									}
								   
									try{
										
										if(isset($quizData)){
											$secret_key = '';
											$autoSettingObj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('WEBHOOK' , 'secret_key');
											if($autoSettingObj){
													$secret_key = $autoSettingObj->getValue();
											}
											$total_points = 0;
											$sqb_question_answer_array_new =  array();
											$all_answer_tags_name_array =  array();
											$question_list_for_formula = array();
											$counter = 1;
											if(is_array($sqb_question_answer_array) && count($sqb_question_answer_array)){
												foreach($sqb_question_answer_array as $sqb_question_answer){
													if(isset($sqb_question_answer['ques_id'])){
														$ques_id = $sqb_question_answer['ques_id'];
														$correct_ans = $sqb_question_answer['correct_ans'];
														$answer_text = $sqb_question_answer['answer_text'];

														if($sqb_question_answer['answer_type'] == 'matching_text'){
															$answer_text = strip_tags($sqb_question_answer['answer_text']);
														}
														
														$points_scored = $sqb_question_answer['points_scored'];
														$total_points = $sqb_question_answer['total_points'];
														if(isset($sqb_question_answer['answer_points_scored'])){
																$points_scored = $sqb_question_answer['answer_points_scored'];
														}
														
														$answer_tags_text_array = array();
														if(isset($sqb_question_answer['answer_tags'])){
															$answer_tag_ids = $sqb_question_answer['answer_tags'];
															$answer_tags_text_array = SQBGetTagsNameByIds($answer_tag_ids);
														}
														
														$all_answer_tags_name_array = array_merge($all_answer_tags_name_array,$answer_tags_text_array);
														$answer_tags_text = implode(',',$answer_tags_text_array);
														
														$question_title = '';
														$question_type = '';
														$questionObj = SQB_QuizQuestionBank::loadById($ques_id);
														if($questionObj){ 
															$question_title = $questionObj->getQuestionTitle();
															$question_type = $questionObj->getQuestionType();
														}
														if($quizData->getQuizType() == 'personality'){
															$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
														}else if($quizData->getQuizType() == 'scoring' || $quizData->getQuizType() == 'calculator'){
															$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans,'points_scored'=>$points_scored, 'answer_tags' => $answer_tags_text);

															if($quizData->getQuizType() == 'calculator'){
																if($question_type == 'multi'){
																	$answer_points = $sqb_question_answer['answer_points_scored'];
																}else if($question_type == 'slider'){
																	$num = preg_replace('/[^0-9.]+/', '', $sqb_question_answer['answer_text']);
																	$answer_points = $num;
																}else if($question_type == 'numerical_text'){
																	$answer_points = (int) $sqb_question_answer['answer_text'];
																}else if($question_type == 'weight_and_height'){
																	$answer_points = $sqb_question_answer['answer_text'];
																}else{
																	$answer_points = (int) $sqb_question_answer['answer_points_scored'];
																}
																$question_list_for_formula[$counter] = $answer_points;
															}

														}else if($quizData->getQuizType() == 'assessment'){
															$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer'=>$answer_text,'correct_answer'=>$correct_ans, 'answer_tags' => $answer_tags_text);
														}else if($quizData->getQuizType() == 'survey'){
															$sqb_question_answer_array_new[] = array('question_title'=>$question_title,'selected_answer'=>$answer_text, 'answer_tags' => $answer_tags_text);
														}else if($quizData->getQuizType() == 'calculator'){
															
														}
													}
													$counter++;
												}
											}	
											

											$formula_details = array();
											$formula_object = SQB_CalculatorFormula::loadByQuizId($quiz_id);
											if(is_array($formula_object) && count($formula_object)){
												foreach($formula_object as $formula_object_data){
													$formula_id = $formula_object_data->getId();
													$formula_html = $formula_object_data->getHtml();
													$orignal_formula_html = $formula_object_data->getHtml();
													
													$count=0;
													while ($formula_html[$count] != '') {
													$count++;
													}
													
													
													foreach(array_reverse($question_list_for_formula,true) as $key=>$value){
														$findstr = 'Q'.$key;

														$val = explode(',',$value);
														if(count($val) == 2){
															for($i=0;$i<=$count;$i++){
																$formula_html = str_replace($findstr.'W',$val[0],$formula_html);
																$formula_html = str_replace($findstr.'H',$val[1],$formula_html);
															}
														}

														for($i=0;$i<=$count;$i++){
														$formula_html = str_replace($findstr,$value,$formula_html);
														}
														
													}

													$formula_value = eval('return '.$formula_html.';');
													$formula_details[] = array('formula'=>$orignal_formula_html,'value'=> $formula_value);
												}
											}
						
											$params = array('web_hook_url'=>$web_hook_url,'secret_key'=>$secret_key,'quizData'=>$quizData,'outcomeDetails'=>$outcomeDetails,'sqb_question_answer_array_new'=>$sqb_question_answer_array_new,'total_points'=>$total_points, 'all_answer_tags_name_array'=> $all_answer_tags_name_array,'formula_details'=>$formula_details,'sqb_custom_fields_array'=>$sqb_custom_fields_array);
											$quizName = $quizData->getQuizName();	
											$param .= ':'.$quiz_id.':'.$quizName;
										
										
										$obj = new SQBwebhook();
										$obj->register($email,$name,$params);
										}
									}
									catch(Exception $e){
										echo $e->getMessage();
									}	
								}
							}


				}else if(($destination == 'fluentcrm') && function_exists('FluentCrmApi')){
					
					$fluentcrmQuiz   = SQB_Quiz::loadById($quiz_id);
					       
					if($fluentcrmQuiz){
					
					 $user_added_plateform_array = explode(",",$fluentcrmQuiz->getUserAddedPlatform());
					    
						if(in_array('FLUENTCRM',$user_added_plateform_array)){
							 $fluentcrm_list_id =  $quizAutoResponderObj->getActionId();
                             $contactApi = FluentCrmApi('contacts');
                             /*
								* Update/Insert a contact
								* You can create or update a contact in a single call
							*/
							$add_user_to_tag_id = null;
							$add_user_to_tag_ids = array();
						
							if(isset($tag) && ($tag != '')){
								$fluentcrm_tag = FluentCrmApi('tags');
								$fluentcrm_tags = $fluentcrm_tag->all();
								
								
								$tags_arr = explode(',', $tag);
				
								if(is_array($tags_arr) && count($tags_arr)){
									foreach($tags_arr as $tag){
									
										if(isset($fluentcrm_tags)){
											foreach($fluentcrm_tags  as $fluentcrm_single_tag){
												if(trim($tag) == trim($fluentcrm_single_tag->title)){
													$add_user_to_tag_id = $fluentcrm_single_tag->id;
													$add_user_to_tag_ids[] = $add_user_to_tag_id;
												}
											}
										}
									}
								}
							}
							
							$fluentcrm_user_data = array(
									'full_name' => $name,
									'last_name' => '',
									'email' => $email, // requied
									//'status' => 'pending',
									//'tags' => [1,2,3], // tag ids as an array
									//'lists' => array($fluentcrm_list_id) // list ids as an array
							);
							
							if (defined('FLUENT_CRM_DOUBLE_OPTIN') && (defined('FLUENT_CRM_DOUBLE_OPTIN') == 'Y')) {
									$fluentcrm_user_data['status'] = 'pending';
							}
							
							
							if(is_array($add_user_to_tag_ids) && count($add_user_to_tag_ids)){
								$fluentcrm_user_data['tags'] = $add_user_to_tag_ids;
							}
                            if(is_numeric($fluentcrm_list_id) && ( $fluentcrm_list_id != 0 )){
								$fluentcrm_user_data['lists'] = array($fluentcrm_list_id);
							}
							
							
								$contact = $contactApi->createOrUpdate($fluentcrm_user_data);

								// send a double opt-in email if the status is pending
								if (defined('FLUENT_CRM_DOUBLE_OPTIN') && (defined('FLUENT_CRM_DOUBLE_OPTIN') == 'Y')) {
									if($contact->status == 'pending') {
										
										$contact->sendDoubleOptinEmail();
										
									}
								}
								
								

						}
					}
				}else if(($destination == 'groundhogg') && class_exists(\Groundhogg\Contact::class)){ 
					
					$groundhoggQuiz   = SQB_Quiz::loadById($quiz_id);

					if($groundhoggQuiz){
						   $user_added_plateform_array = explode(",",$groundhoggQuiz->getUserAddedPlatform());
							if(in_array('GROUNDHOGG',$user_added_plateform_array)){
								$tags_arr = explode(',', $tag);
								try{
									$Groundhogg_contact = new \Groundhogg\Contact(['first_name' => $name,'email'=> $email]);
									if(is_object($Groundhogg_contact)){
										$Groundhogg_contact->apply_tag($tags_arr );
									}	
									
								}catch(Exception $e){
											
										
								}		
							}
					}	
						
				}else if(($destination == 'mailpoet') && class_exists(\MailPoet\API\API::class)){ 
						$mailpoetQuiz   = SQB_Quiz::loadById($quiz_id);

						if($mailpoetQuiz){
						   $user_added_plateform_array = explode(",",$mailpoetQuiz->getUserAddedPlatform());
							if(in_array('MAILPOET',$user_added_plateform_array)){
								 $mailpoet_list_id =  $quizAutoResponderObj->getActionId();
								 
								 $subscriber_array = array('email'=>$email,'first_name'=>$name,'last_name'=>'');
								 $lsit_ids = array();
								 if(is_numeric($mailpoet_list_id) && ( $mailpoet_list_id != 0 )){
									$lsit_ids = array($mailpoet_list_id);
									$subscribe_exist = false;
									try{
										$mailpoet_api = \MailPoet\API\API::MP('v1');
										$subscribe_has = $mailpoet_api->getSubscriber($email);
										if(is_array($subscribe_has) && count($subscribe_has) && isset($subscribe_has['id']) ){
											$subscribe_exist = true;
											try{
												
												$mailpoet_output = $mailpoet_api->subscribeToLists((string)$subscribe_has['id'],array($mailpoet_list_id),array('send_confirmation_email'=>true));
											}catch(Exception $e){
												
											}
										}
									}catch(Exception $e){
											
										$subscribe_has = false;
									}	
									try{
										if(!$subscribe_exist){
											$mailpoet_output = $mailpoet_api->addSubscriber($subscriber_array,$lsit_ids,array('send_confirmation_email'=>true));
										}
									}catch(Exception $e){
										
									}
										
									
								
								}
							}
					}	
				
				}else if($destination == 'dap'){
					$lldocroot = defined('SITEROOT') ? SITEROOT : $_SERVER['DOCUMENT_ROOT'];
				
					if(file_exists($lldocroot . "/dap/dap-config.php")){ 
					   include_once ($lldocroot . "/dap/dap-config.php");   
					}else{
						continue;	
					}
					
					$user = Dap_User::loadUserByEmail($email); /* get user's details from DAP */
					
					if(!isset($user)){
						$user = SQBcreateNewDAPUser($name,$email, $password );
					}	
					
					if (isset($user)) { /* check if user's account is created in DAP */
						$user_id = $user->getId();
						$productId = $quizAutoResponderObj->getActionData();
						$userProduct = Dap_UsersProducts::load($user_id, $productId);

						if (!isset($userProduct)) {
							$product = Dap_Product::loadProduct($productId);
							
							//$access_id = Dap_UsersProducts::addProductToUser($user_id,$product, $productId, '-3', date('Y-m-d'));
							
							$email=$user->getEmail();
							$dappwd=$user->getPassword();
							$first_name=$user->getFirst_name();
							$last_name=$user->getLast_name();
							$username=$user->getUser_name();
							$isPaid="Y";
							$coupon_id="";
							$blogfolder="";
							
							$_SESSION["bulkadduser"] = 'sqb_test';

							$uid = Dap_UsersProducts::addNewUserToProduct($email, $first_name, $last_name, $username, $productId, $isPaid, "A", $coupon_id, '','', '', $blogfolder,'SQB');
							unset($_SESSION["bulkadduser"]);
						
							if($uid!="") {
								if (defined("DONOTLOGINTODAP") && DONOTLOGINTODAP) {
									logToFile("SQB: functions_fe.php: could not login the user=" . $email );
								}else{
									$ret = authUser($email,$dappwd);

									if($ret==0) {
										logToFile("SQB: functions_fe.php: logged in the user=" . $email . " successfully" );
									}
									else {
									  logToFile("SQB: functions_fe.php: could not login the user=" . $email );
									}
								}

							}
						} 
						
						$tag_ids = array();
						if(!empty($tag)){
							$tags = explode(',',$tag);
							foreach ($tags as $key => $t) {
								$tagDetails = Dap_MasterTags::loadByTagName($t);
								if(empty($tagDetails)){
									$createTag = new Dap_MasterTags();
									$createTag->setTagName($t);
									$tagId = $createTag->create();
									$tag_ids[] = $tagId;
								}else{
									$tagId = $tagDetails->getId();
									$tag_ids[] = $tagId;
								}
							}
						}
						

	

						if(!empty($tag_ids)){
							
							/*$tagDetails = Dap_MasterTags::loadByTagName($tag);	
							
							if($tagDetails == ''){
								$createTag = new Dap_MasterTags();
								$createTag->setTagName($tag);
								$tagId = $createTag->create();
							}else{
								$tagId = $tagDetails->getId();	
							}*/


						foreach ($tag_ids as $key => $tagId) {								
							$userTag = new Dap_UserTags();
							$userTag->setUserId($user_id);
							$userTag->setTagId($tagId);
							$userTag->setType('Opt In');
							$userTag->setProductId($productId);

							$tagDetails = Dap_UserTags::loadByUserIdAndTagIdAndType($tagId,$user_id, 'Opt In', $productId );
							
							if(empty($tagDetails)){
								$userTag->create();
							}

							$_SESSION["bulkadduser"] = 'sqb_test';
							$data = Dap_UsersProducts::DAPApplyAutomationRules($productId,$user_id,$product,'add', $tagId, 'tag');	
							unset($_SESSION["bulkadduser"]);  
						}
							
						}
					}	
				
				}else if($destination == 'scp'){

					if(defined('SCP_ABS_URL')){

						
						$user = get_user_by('email', $email);
						
					

						$user_id = $user->ID;
						update_user_meta($user_id,'is_scp_user',true);
						$productId = $quizAutoResponderObj->getActionData();
						$plan_id = get_post_meta(  $productId, 'scp_default_pricing_plan', true );
						$plan = scp_get_pricing_plan($plan_id);

						$access_start_date = gmdate('Y-m-d H:i:s');
						
						$course_pricing = get_post_meta(  $productId, 'course_pricing', true );

						if($course_pricing == 'paid'){
							$access_duration = ($plan['access_duration'] != 9999) ? 'limited_time' : '';
							$days_to_add = $plan['access_duration'];
						}else{
							$access_duration = get_post_meta($productId, 'access_duration', true);
							$days_to_add = get_post_meta($productId, 'scp_access_duration_days', true);
						}
						
						if($access_duration == 'limited_time'){
							
							$access_end_date = gmdate('Y-m-d H:i:s', strtotime("+$days_to_add days", strtotime($access_start_date)));
						}else{
							$access_end_date = '2200-12-31 23:59:59';
						}

						scp_grant_user_course_access($user_id, $productId, $access_start_date, $access_end_date, 1,1);

						scp_add_update_affiliate($user_id, $is_new_user, $productId);
						
						if(!empty($tag)){
							$tags_arr = explode(',', $tag);
						}else{
							$tags_arr = array();
						}

						/*$existingTags = $wpdb->get_col("SELECT id FROM {$wpdb->prefix}scp_tags WHERE id IN (" . implode(',', array_map('intval', $ids)) . ")");
						$newTags = array_diff($ids, $existingTags);*/
						
						global $wpdb;
						$existingTags = get_user_meta($user_id, 'scp_tags', true);
						if (!is_array($existingTags)) {
							$existingTags = []; // Ensure it's an array
						}


						if(!empty($tags_arr)){
							foreach ($tags_arr as $tagId) {
								$tagl = SQB_Tags::loadByName($tagId);
								
								if (!$tagl) {
									continue; // Skip if tag doesn't exist in FluentCRM
								}
							
								$tagName = $tagl->getName();
								$slug = sanitize_title($tagName);
							
								
								// Check if tag already exists in custom table
								$existingTagId = $wpdb->get_var($wpdb->prepare(
									"SELECT id FROM {$wpdb->prefix}scp_tags WHERE name = %s",
									$tagName
								));
								
							
								if (!$existingTagId) {
									// Insert tag into custom table
									$wpdb->insert("{$wpdb->prefix}scp_tags", [
										'id' => $tagId,
										'name' => $tagName,
										'slug' => $slug,
										'created_at' => current_time('mysql', true)
									]);
									$existingTagId = $wpdb->insert_id; // Get newly inserted tag ID
								}
							
								if (!in_array($existingTagId, $existingTags)) {
									$existingTags[] = $existingTagId;
								}

							}
						
							
						}
						

					
						// Update user meta
						update_user_meta($user_id, 'scp_tags', $existingTags);



					}

				}
			 }
		 }
}

function sqbOutcomeRankingDetails($outcomeRanking, $outcomeArray, $quiz_id){
	$customFields = array();
	$i = 0;

	foreach($outcomeArray as $key => $value){
		if(isset($outcomeRanking[$i])){
			$id = $outcomeRanking[$i]->getCustomFieldName();
			if($key !='' && $key!= 0){
				$outcomeDetails =  SQB_Outcome::loadByQuizIdAndOutcomeId($quiz_id, $key);
				if($outcomeDetails != false){
					 $name = $outcomeDetails->getOutcomeName();	
					 $customFields['field['.$id.', 0]'] = $name;
				}
			}
		}
		
		$i++;
	}

	return $customFields;
}

function activecampaignGetParams($quizAutoResponderObj, $tag){
	$api_key_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('ACTIVECAMPAIGN', 'api_key');	
	$api_url_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('ACTIVECAMPAIGN', 'api_url');	
	if(isset($api_key_data)){
		$api_key = $api_key_data->getValue();	
	}
	if(isset($api_url_data)){
		$api_url = $api_url_data->getValue();	
	}
	
	$param = ':'.$api_url.':'.$api_key;
	
	 $action = $quizAutoResponderObj->getAction();
	 $data = $quizAutoResponderObj->getActionData();
	 $actionType = $quizAutoResponderObj->getActionType();
	 
	$data = explode('||' , $data);
	return $param .= ':'.$data[0].':'.$tag;		
}

function convertkitGetParams($quizAutoResponderObj, $tag){
	$api_key_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('CONVERTKIT', 'api_key');	
	$api_secret_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('CONVERTKIT', 'api_secret');	
	if(isset($api_key_data)){
		$api_key = $api_key_data->getValue();	
	}
	if(isset($api_secret_data)){
		$api_secret = $api_secret_data->getValue();	
	}
	
	$param = ':'.$api_key;	
	
	 $action = $quizAutoResponderObj->getAction();
	 $data = $quizAutoResponderObj->getActionData();
	 $actionType = $quizAutoResponderObj->getActionType();
	 $data = explode('||' , $data);
	if($actionType == 'sequence'){
		$param .= '::'.$data[0].':'.$tag;
	}else if($actionType == 'form'){
		$param .= ':'.$data[0].'::'.$tag;	
	}
	return $param .= ':'.$api_secret;
}

function mailchimpGetParams($quizAutoResponderObj, $tag){
	$api_key_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('MAILCHIMP', 'api_key');	
	if(isset($api_key_data)){
		$api_key = $api_key_data->getValue();	
	}
	 $param .= ':'.$api_key;
	 $action = $quizAutoResponderObj->getAction();
	 $data = $quizAutoResponderObj->getActionData();
	 $actionType = $quizAutoResponderObj->getActionType();
	 $data = explode('||' , $data);
	//return $param .= ':'.$data[0];	
	return $param .= ':'.$data[0].':'.$tag;		 
	
}

function dripGetParams($quizAutoResponderObj, $tag){
//drip:1382143:f7aeba1a01c3df4a95d7472a5031ee54:581670675:fgh

	$client_id_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('DRIP', 'client_id');	
	$api_token_data = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('DRIP', 'api_token');	
	if(isset($client_id_data)){
		$client_id = $client_id_data->getValue();	
	}
	if(isset($api_token_data)){
		$api_token = $api_token_data->getValue();	
	}
	
	$param = ':'.$client_id.':'.$api_token;
	$action = $quizAutoResponderObj->getAction();
	$data = $quizAutoResponderObj->getActionData();
	$actionType = $quizAutoResponderObj->getActionType();
	 
	$data = explode('||' , $data);
	return $param .= ':'.$data[0].':'.$tag;		

}

function aweberGetParams($quizAutoResponderObj, $tag){

	//aweber:5546812:no:fgh:Y
	$action = $quizAutoResponderObj->getAction();
	$data = $quizAutoResponderObj->getActionData();
	$actionType = $quizAutoResponderObj->getActionType();
	 
	$data = explode('||' , $data);
	return $param .= ':'.$data[0].':no:'.$tag.':Y';		
}

function zapierGetParams($quizAutoResponderObj ,$tag = ''){
	$data = $quizAutoResponderObj->getActionData();
	$value = explode("||",$data);
	$url = $value[0];
	
	$url1 = parse_url($url);

	$url = $url1['host']."".$url1['path'];	

	if(strpos($value[0], 'autonami') !== false){
		$url .= '?'.$url1['query'];
	}

	if(strpos($value[0], 'ssp') !== false){
		$url .= '?'.$url1['query'];
	}


	return $param = ":".$url1['scheme'].":".$url.":Y:".$tag;
	
}

function googlespreadsheetGetParams($quizAutoResponderObj ,$tag = ''){
	$data = $quizAutoResponderObj->getActionData();
	$value = explode("||",$data);
	$url = $value[0];
	
	$url1 = parse_url($url);
	$url = $url1['host']."".$url1['path'];
	
	return $param = ":".$url1['scheme'].":".$url.":Y:".$tag;
	
}

function SQBSendinblueGetParams($quizAutoResponderObj,  $tag = '' ){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('SENDINBLUE', 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag ;
	
	return $param;
	
}

function SQBKartraGetParams($quizAutoResponderObj,  $tag = '' ){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_id_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('KARTRA', 'api_id');	
	$api_password_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('KARTRA', 'api_password');	
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('KARTRA', 'api_key');	

	$api_id = '';
	if(isset($api_id_obj)){
		$api_id = $api_id_obj->getValue();	
	}

	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}

	$api_password = '';
	if(isset($api_password_obj)){
		$api_password = $api_password_obj->getValue();	
	}

	
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag.':'.$api_id.':'.$api_password;
	
	return $param;
	
}


function SQBMailerliteGetParams($quizAutoResponderObj,  $tag = ''){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('MAILERLITE', 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag;
	
	return $param;
	
}


function SQBSendfoxGetParams($quizAutoResponderObj,  $tag = ''){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('SENDFOX', 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag;
	
	return $param;
	
}


function SQBCommonGetParams($quizAutoResponderObj,  $tag = '', $autoresponder_name_cap = ''){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey($autoresponder_name_cap, 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag;
	
	return $param;
	
}

function SQBMoosendGetParams($quizAutoResponderObj,  $tag = ''){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('MOOSEND', 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag;
	
	return $param;
	
}

function SQBGetresponseGetParams($quizAutoResponderObj,  $tag = ''){
	
	$list_id = $quizAutoResponderObj->getActionId();
	$api_key_obj = SQB_AutoresponderSettings::loadAutoresponderByNameAndKey('GETRESPONSE', 'api_key');	
	$api_key = '';
	if(isset($api_key_obj)){
		$api_key = $api_key_obj->getValue();	
	}
	
	$param = ':'.$api_key.':'.$list_id.':'.$tag;
	
	return $param;
	
}


function SQBcreateNewDAPUser($firstname,$email, $password ){
	try{
		$user = new Dap_User();
		$user->setFirst_name($firstname);
		$user->setEmail($email);
		$user->setPassword($password );
		$user->setStatus("A");
		$user->create();
		return $user;
	}
	catch(Exception $e){
		//fblm_log_to_file('','',"functions.php:FBLMcreateNewDAPUser(),cant create user ".$e->getMessage(),FBLM_ERROR);
	}
}
/*****temp moved end********/

/******for course quiz start*********/

function sqb_show_quiz_by_id($id){
 	return SQBDisplayQuizById($id);
}


/******for course quiz end*********/

function getOptinValue($quizid,$name){
	$get_value='';
	$dataarray = SQB_QuizForm::loadValueByQuizIdAndName($quizid, $name);
	  
	if(is_array($dataarray) && count($dataarray) == 0){
		
	}else if(isset($dataarray)){
		$get_value = $dataarray->getValue();
	}
	return $get_value;
}


/*GDPR Country Status start*/
function sqbGetGDPRStatus($ip){

    global $sqb_gdpr, $wpdb;
    $gdprStatus = get_option('sqb_gdpr_checkbox');
    $keyqry = '';
    if(isset($gdprStatus) && $gdprStatus == 1){
		
    	$load_gdpr_Data = SQB_GDPR::load();
    	$data = array();
    	$country_details = sqbgetCountryNameByIp($ip);
		if(!empty($country_details)){
			$data['country_code'] = !empty($country_details['country_code']) ? $country_details['country_code'] : '';
			$data['country_name'] = !empty($country_details['country_name']) ? $country_details['country_name'] : '';
			$data['region_state'] = !empty($country_details['region_state']) ? $country_details['region_state'] : '';
		}

		$load_gdpr_Data = SQB_GDPR::loadByCountryCode($data['country_code']);
		if($load_gdpr_Data && $load_gdpr_Data->status == 1){

			$keyqry = '1';
		}
		
	}
    return $keyqry;
}

/*GDPR Country Status end*/


function sqbgetCountryNameByIp($ip){ /*get country name by IP*/
	$return_data = array('country_code' => '', 'country_name' => '');
		
	$url = "http://www.geoplugin.net/json.gp?ip=" . $ip;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);
	$data = curl_exec($curl);
	curl_close($curl);
	$data = @json_decode($data);
	
	
	if (!empty($data) && !empty($data->geoplugin_countryName)) {
		$return_data['country_code'] = $data->geoplugin_countryCode;
		$return_data['region_state'] = $data->geoplugin_regionName;
		$return_data['country_name'] = $data->geoplugin_countryName;
	}
	$ipaddress = $_SERVER['REMOTE_ADDR'];
	if($return_data['country_name'] == ''){
		$ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ipaddress));
		if ($ip_data && $ip_data->geoplugin_countryName != null) {
			$return_data['country_code'] = $ip_data->geoplugin_countryCode;
			$return_data['region_state'] = $ip_data->geoplugin_regionName;
			$return_data['country_name'] = $ip_data->geoplugin_countryName;
		}else{
			$ip_data = @json_decode(file_get_contents("https://ipfind.co?ip=" . $ipaddress));
		
			if ($ip_data && $ip_data->country != null) {
				$return_data['country_code'] = $ip_data->country_code;
				$return_data['region_state'] = $ip_data->city;
				$return_data['country_name'] = $ip_data->country;
			}
		}
		
	}
	
	return $return_data;
}


//check for Wp Syncing is enabled or disabled
function sqbCheckSyncing($email, $first_name){
	global  $wpdb;
	$user_id ='';
    $sqb_wp_syncing = get_option('sqb_wp_syncing');    
    if(isset($sqb_wp_syncing) && $sqb_wp_syncing == "Y"){
		//create user in SQB, not in WP
		$sqbInternalUserObj = new SQB_InternalUsers();		
		$sqbInternalUserObj->setEmail($email);
		$sqbInternalUserObj->setFirstName($first_name);
		$sqbInternalUserObj->setDate( date('Y-m-d H:i:s'));
		$sqbUserObj = SQB_InternalUsers::loadByEmailNew($email);		 
		if(isset($sqbUserObj) ){
			$user_id = $sqbUserObj->getId(); 	
		} else{			
			$user_id = $sqbInternalUserObj->create();	
		}		 
		
	}else{
		//create user in WP		 
	}

	return $user_id;
}	

add_action('init', 'sqb_certificate_pdf_download');

function sqb_certificate_pdf_download(){
	if(isset($_REQUEST['sqb_cert_pdf_download'])){
		require_once(SQB_FILE.'includes/frontend/certificate.php');
	}

	if(isset($_REQUEST['sqb_pdf_download_v2'])){
		require_once(SQB_FILE.'includes/frontend/pdf-report.php');
	}
}

function sqbTPStyleRender($arr,$gdpr_status, $force_local = false){
	
	if($force_local){
		return $arr['local'];
	}else{

		if($gdpr_status && defined('WCGD_ASSESTS')){
			return $arr['local'];
		}else{
			return $arr['cdn'];
		}
	}
	

}

function getVideoCaption($video_url){

	global $wpdb;
	$result = $wpdb->get_var(
		"SELECT video_caption FROM {$wpdb->prefix}sqb_quiz_video_captions WHERE video_url = '".$video_url."'"
	);
	
	if(!empty($result)){

		$base64_text = base64_encode(stripslashes($result));
		$data_uri = "data:text/plain;base64," . urlencode($base64_text);
	}else{
		$data_uri = '';
	}

	return $data_uri;
}

function sqb_sf_auto_login_redirect($atts) {

    $atts = shortcode_atts(array(
        'redirect' => '',
		'text'=> '',
    ), $atts, 'AUTO_LOGIN');
	
	$sqb_wp_syncing = get_option('sqb_wp_syncing'); 

	$redirect_url = (filter_var($atts['redirect'], FILTER_VALIDATE_URL)) ? $atts['redirect'] : '';

	if (defined('SF_ABS_URL') && $sqb_wp_syncing != 'Y') {
		
		$email = $_POST['email'];
		$user = get_user_by('email', $email);

		if(!empty($user)){
			$user_id = $user->ID;

			$main_forum_slug = get_option( 'sf_slug', 'sf-forums');
			$login_slug = get_option( 'sf_login_slug', 'login');
			$pagelink = site_url().'/'.$main_forum_slug.'/'.$login_slug;
			$magic_link = sf_generate_magic_link($pagelink, $user_id, $redirect_url,'Y');

			$magic_text = !empty($atts['text']) ? $atts['text'] : $magic_link;

			return '<a href="'.$magic_link.'">'.$magic_text.'</a>';
		}

	}else{
		return '';
	}

}
add_shortcode('AUTO_LOGIN', 'sqb_sf_auto_login_redirect');

function download_pdf_shortcode_wp($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(array(
        'quizid' => '',
        'label' => 'Download PDF',
        'background' => '',  // Background color
        'textcolor' => '#ffffff',  // Text color
        'loading_text' => 'Please wait...', 
    ), $atts, 'downloadpdf');

    global $wpdb;
    $user_id = get_current_user_id();
    $table_name = $wpdb->prefix . 'sqb_manage_leads';
    $query = $wpdb->prepare(
        "SELECT id FROM $table_name WHERE user_id = %d and quiz_id = %d ORDER BY date DESC LIMIT 1",
        $user_id, $atts['quizid']
    );
    $manage_id = $wpdb->get_var($query);

    add_action('wp_footer', 'download_pdf_shortcode_wp_inline_js');

    if (!empty($manage_id)) {
        // Build the URL to the PDF
        $quizid = $atts['quizid'];
        $pdf_url = get_site_url() . '/path-to-your-pdfs/' . $quizid . '.pdf';

        // Initialize styles with text color
	    $styles = 'padding: 10px 20px !important; border-radius: 5px; color: ' . esc_attr($atts['textcolor']) . ' !important; text-decoration: none; display: block; width: max-content; max-width: 100%;';

	    // If a background color is provided, add padding and the background color
	    if (!empty($atts['background'])) {
	        $styles .= 'background-color: ' . esc_attr($atts['background']) . ' !important;';
	    } else {
	        $styles .= 'background-color: #000; color: #fff;';
	    }

	    // Add a unique class for CSS styling
	    $unique_class = 'sqb-wp-download-pdf-button-' . $manage_id;

	    // Return the HTML for the button with inline styles
	    $html = '<a href="javascript:void(0);" class="button ' . $unique_class . '" data-origtext="'.esc_attr($atts['label']).'" data-loadingtext="'.esc_attr($atts['loading_text']).'" manage_id="' . esc_attr($manage_id) . '" class="' . $unique_class . '">' . esc_html($atts['label']) . '</a>';

	    // Append CSS for hover effect
	    $css = '
	    <style>
	        .' . $unique_class . ':hover {
	            opacity: 0.8;
	            text-decoration:none;
	            transform: scale(1.02);
            	transition: transform 0.5s ease;
	        }

	        .' . $unique_class . ' {
	            '.$styles.'
	        }
	    </style>';

	    // Return the HTML and CSS together
	    return $html . $css;
    }
}


// Register the shortcode
add_shortcode('DOWNLOADPDFWP', 'download_pdf_shortcode_wp');


function download_pdf_shortcode_wp_inline_js() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
			jQuery(document).on('click','.sqb-wp-download-pdf-button', function(){

				var manage_id = jQuery(this).attr('manage_id');
				var loading_text = jQuery(this).attr('data-loadingtext');
				var orign_text = jQuery(this).attr('data-origtext');
				var formdata = [];
				formdata.push({name: "manage_id", value: manage_id});

				jQuery(this).text(loading_text);
				$.ajax({
					type: "POST",
					url: '?sqb_pdf_download_v2=1',
					data: formdata,
					xhrFields: {
						responseType: 'blob'
					},
					success: function(blob, status, xhr) {

						var filename = ""; // Define the filename here if needed

						jQuery(this).text(orign_text);
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
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						// Handle error
					}
				});

			});
        });
    </script>
    <?php
}