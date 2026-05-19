




function sqb_send_email_notifications(first_name,email,register_way,productId,signup_way,quizId,sqb_quiz_type,outcome_final,sqb_question_answer_array,outcome_ids_array,outcome_desc,gdpr_required,category_result_list_array,optin_form_fields,	sqb_custom_fields_array,catdata,category_number_percent,category_number_div,show_optin,double_optin,firstname_temp){
	var sqb_ajaxurl = jQuery('#sqb_ajaxurl').val();	
	jQuery.post(sqb_ajaxurl, {  	  
			action: 'SQBSendNotificationAjax', 
			first_name: first_name,
			firstname_temp: firstname_temp,
			email: email,		 
			register_way: register_way,		 
			productId: productId,	
			signup_way: signup_way,	
			quizId: quizId,	
			sqb_quiz_type: sqb_quiz_type,
			outcome_final: outcome_final,	
			sqb_question_answer_array: sqb_question_answer_array,	
			outcome_ids_array:outcome_ids_array,
			outcome_desc:outcome_desc,
			gdpr_required:gdpr_required,
			category_result_list_array:category_result_list_array,
			optin_form_fields:optin_form_fields,				
			sqb_custom_fields_array:sqb_custom_fields_array,
			catdata:catdata,
			category_number_percent:category_number_percent,
			category_number_div:category_number_div,
			show_optin:show_optin,
			double_optin:encodeURIComponent(double_optin),		
		}, function(response){
			
		});	 
}


function sqb_lead_save(user_id = 0,how_many_answed = 0, lead_type = '', sqb_quiz_container_outer_id=0,course_id ='', lesson_id='',show_outcome_again='',gdpr_required='', first_name='',optin_form_fields=''){ 
//added for the backend preview	
var SQBPreview = jQuery('#SQBPreview').val();
if(SQBPreview =="Y"){
	return false;
}

var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val();  
var category_result_list_array = '';
if(sqb_quiz_category_enable == 'Y'){
	category_result_list_json = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="category_result_list_json"]').val(); 
	if(category_result_list_json != ''){ 
		category_result_list_array = JSON.parse(category_result_list_json);
	}
}  
  
var quizId =jQuery('#'+sqb_quiz_container_outer_id+ ' #quizId').val();

var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
if(sqb_quiz_type == 'form'){
	var outcome_final = jQuery('input[name=outcome_id]').val();
}else{
	var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val();
}

var sqb_ajaxurl =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_ajaxurl').val();
var how_many_answed = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_selected').length;
var show_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
var total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val();
var quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
if(show_retake == "Y"){
	var leadstotal_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val();	
	var leads_total_attempts = parseInt(leadstotal_attempts) + 1;		 
	total_attempts =  leads_total_attempts;	
	jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val(total_attempts);
	total_attempts =  total_attempts-1;
}
var page_id = jQuery( '#get_page_id').val();  
var points_scored = 0;
var	total_points = 0 ;
var ques_count = jQuery("#"+sqb_quiz_container_outer_id+ " #ques_count").val(); 
var sqb_correct_ans =  jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_correct_ans").val(); 
var points_count =  jQuery("#"+sqb_quiz_container_outer_id+ " #points_count").val(); 
var sqb_points_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_points_ans").val(); 
var time_spent = jQuery('#'+sqb_quiz_container_outer_id+ ' #time_spent1').val();

if(quiz_type =="scoring"){
	points_scored = sqb_points_ans;
	total_points = points_count;
}else if(quiz_type =="assessment"){
	points_scored = sqb_correct_ans;
	total_points = ques_count;
}
		 
jQuery.post(sqb_ajaxurl, {  
				action: 'sqb_lead_save',
				user_id: user_id,   
				quizId: quizId,   
				outcome_final: outcome_final,   
				how_many_answed : how_many_answed,
				lead_type : lead_type,
				total_attempts : total_attempts,
				course_id : course_id,
				lesson_id : lesson_id,
				show_retake : show_retake,
				page_id : page_id,
				quiz_type : quiz_type,
				points_scored : points_scored,
				total_points : total_points,
				time_spent : time_spent,
				gdpr_required : gdpr_required,
				category_result_list_array : category_result_list_array,
				first_name : first_name,
				optin_form_fields : optin_form_fields,
	}, function(response){
		response = JSON.parse(response);  
		 
		var quesAnsData = new Array();
		var sqbdatetime = response.sqbdatetime; 
		var display_msg = response.display_msg; 
		if( lesson_id !=""  ){
			lesson_id = jQuery.isNumeric(lesson_id);
			if(lesson_id == true){				
				if(display_msg=="yes"){
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
			}
		}
		var points_scored = 0;
		var	total_points = 0 ;
		var ques_count = jQuery("#"+sqb_quiz_container_outer_id+ " #ques_count").val(); 
		var sqb_correct_ans =  jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_correct_ans").val(); 
		var points_count =  jQuery("#"+sqb_quiz_container_outer_id+ " #points_count").val(); 
		var sqb_points_ans = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_points_ans").val(); 
		var sqb_quiz_type =  jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val(); 
		if(sqb_quiz_type =="scoring"){
			points_scored = sqb_points_ans;
			total_points = points_count;
		}else{
			points_scored = sqb_correct_ans;
			total_points = ques_count;
		}
		
		var sqb_question_answer_array = []; 
		var answer_points_scored = 0;
		var answer_tags = ''; 
		jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_question_answer_hidden").each(function(){
			answer_tags = '';
			answer_points_scored = 0;
			var ques_id = jQuery(this).data('id');	
			var answer_id = jQuery(this).data('key'); 	
			var correct_ans = jQuery(this).data('correct');	
			 
			var fill_in_blank_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
			var text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('text_cls'); 
			var slider_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('slider_cls'); 
			var file_upload_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls'); 
			var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
			var date_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('date_cls'); 
			var dropdown_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('dropdown_cls');
			var matching_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matching_text'); 
			var email_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('email_cls'); 
			var phone_number_text_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('phone_number_text_cls'); 

			var other_field = '';
			if(fill_in_blank_cls ==true){
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_fill_in_blank_ans_field").val();						
			}else if(text_cls ==true){
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_textarea_ans_field").val();	
			}else if(email_cls ==true){
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_email_ans_field").val();	
			}else if(phone_number_text_cls == true){
				var country_code =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".iti__country.iti__active .iti__dial-code").html();
				var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
				if(answer_text != ''){
					answer_text =  country_code+' '+answer_text;
				}else{
					answer_text = '';
				}				 
			}else if(date_cls ==true){
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .date-question-type").val();	
					 
			}else if(slider_cls ==true){
				
				var prefix_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .slider.sqb_ans_slider").attr('prefix_text');	
				var suffix_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .slider.sqb_ans_slider").attr('suffix_text');	
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .slider.sqb_ans_slider").val();	
				answer_text = prefix_text+''+answer_text+''+suffix_text;
			}else if(matching_text == true){
				var html = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find('.sqb_input_ans_field').html();
				var answer_text = html;	
				answer_type = 'matching_text';
				answer_points_scored = calculate_match_points(jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id));
			}else if(numeric_text_cls == true){

				var data_correct_value = jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer.sqb_ans_selected").attr("data-correct-value");
				var input_text_num = jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer .sqb_and_field").val();
				if(input_text_num == data_correct_value){
					correct_ans = 'Y';
				}


				var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_prefix").text();	
				var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_sufix").text();	
				var numeric_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
				var pretext = '';
				if (typeof prefix_text !== "undefined") {
					pretext = prefix_text;
				}
				var suftext = '';
				if (typeof suffix_text !== "undefined") {
					suftext = suffix_text;
				}
				var answer_text = pretext+''+numeric_value+''+suftext;
			}else if(file_upload_cls == true){
				var fileURl =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".file_upload_cls").attr('data-fileurl');
				var answer_text = fileURl;
			}else if(dropdown_cls == true){
				var selected_answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected .sqb_question_dropdown").val();
				var answer_text = selected_answer_text.split('_').join(' ');
			}else{
				var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_selected .sql_ans_text").text();
				var multiple_or_single =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).hasClass('multiple_correct_cls');
				if(multiple_or_single){
					
					var answer_points_scored_new  = 0;
					var answer_tags_new = '';
					 jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_and_field.checkbox_fe").each(function(){
							if(jQuery(this).prop('checked')){
								 var answer_tags_new = jQuery(this).closest('.multiple_correct_checkbox').attr('data-answer-tags');
								 answer_tags = answer_tags+answer_tags_new+',';
								 var answer_points_scored_new = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
								 answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
							}
					});
				}else{
				 answer_type = 'single';
				 answer_tags = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-tags');
				 other_field = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+".question_type_single").find('.custom-other-box').val();
				 answer_points_scored = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
			 
				}
				
				
			}
			
			//sqb_save_user_quesans(user_id, quizId, ques_id,answer_id, correct_ans, answer_text, sqbdatetime, points_scored, total_points);
			sqb_question_answer_array.push({
					'user_id':user_id,
					'quizId':quizId,
					'ques_id':ques_id,
					'answer_id':answer_id,
					'correct_ans':correct_ans,
					'answer_text':answer_text,
					'sqbdatetime':sqbdatetime,
					'points_scored':points_scored,
					'total_points':total_points,
					'answer_tags':answer_tags,
					'other_field':other_field,
					'answer_points_scored':answer_points_scored,
			}); 
		});
		sqb_save_user_quesans_array(sqb_question_answer_array , sqb_quiz_container_outer_id, show_outcome_again);
		sqb_show_outcome_tags(sqb_quiz_container_outer_id,sqb_question_answer_array);
		//jQuery('.outcome_div').html(jQuery('.outcome_div').html().replaceAll('[SHOWTAGS]', '<div class="sqb_tags_content_details_outer" style="display:none;">[SHOWTAGS]</div>'));
		jQuery('#'+sqb_quiz_container_outer_id+ ' .close_Side_Popup').css("pointer-events","auto");
		/*****************charts starts**********************/
		var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
		var final_charts_settings = charts_settings.split('|');
		console.log(final_charts_settings);
		var chart_heading_show = false;
		jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			if(jQuery(this).css('display') != 'none'){
				var outcome_final_id = jQuery(this).attr('id');
				if(typeof outcome_final_id != 'undefined' && outcome_final_id != '' ){
					if(final_charts_settings[6] == 'Y'){
						var loader_html= '<div class="sqb_loader_outer_chart" style="display: none;"><div class="sqb_loader_inner"></div></div>';
						if(jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div:visible #result_temp_contentid').find('.sqb_loader_outer_chart').length != 0){
							loader_html = ''
						}
						chart_heading_show = true;
						jQuery(this).html(jQuery(this).html().replace('[CHART_HEADING]', loader_html+'<div class="sqb_char_heading_class"></div>'));
						if(jQuery(this).find('.sqb_char_heading_class').length == 0){
							chart_heading_show = false;
						}
						if(final_charts_settings[13] != ''){
							var sqb_charts_heading_text =  (final_charts_settings[13]);
							sqb_replace_spider_charts_merge_tags(sqb_quiz_container_outer_id,quizId,sqb_charts_heading_text,'only_merge_tag');
						}
					}
				}
			}
			hideLoaderForOutcome(sqb_quiz_container_outer_id);
		});
		
		if(final_charts_settings[6] == 'Y'){ 
			if(final_charts_settings[0] == 'outcome_spider_chart' || final_charts_settings[1] == 'outcome_bar_chart' || final_charts_settings[2] == 'question_answer_bar_chart'){
				if(final_charts_settings[13] != ''){
				var sqb_charts_heading_text =  (final_charts_settings[13]);
				if(chart_heading_show){
				}else{
					sqb_replace_spider_charts_merge_tags(sqb_quiz_container_outer_id,quizId,sqb_charts_heading_text);
				}
				}
			}
			
			var sqb_quiz_id = quizId;
			var sqb_question_id = 0;
			sqb_display_data_in_charts(sqb_quiz_container_outer_id, sqb_quiz_id,sqb_question_id,user_id);
			sqb_display_questions_data_in_bar_charts_with_question(sqb_quiz_container_outer_id, sqb_quiz_id,user_id);
		}
		/*****************charts ends**********************/
});
}

function sqb_show_outcome_tags(sqb_quiz_container_outer_id,sqb_question_answer_array){

if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_ans_tags').val() == 'N'){
	jQuery('#'+sqb_quiz_container_outer_id+ ' custom_tag').remove();
	return false;
}	
	
jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
			if(jQuery(this).css('display') != 'none'){

				var outcome_div_id = jQuery(this).attr('id');
				var str = jQuery('#'+outcome_div_id).html();
				var make_tag_request = false;
				var sqb_ans_tags =  jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ans_tags').val();
				if(typeof str != 'undefined' && str != '' && sqb_ans_tags == 'Y'){
					if(str.match(/(^|\W)SHOWALLUSERTAGS($|\W)/) || str.match(/(^|\W)showtaggcontent($|\W)/)){
						make_tag_request = true;
					}
				}

				
				
				if(outcome_div_id != '' && make_tag_request == true){
					
					var outcome_id = '';
					if(jQuery('#'+outcome_div_id).css('display') == 'none'){
					} else {
					var outcome_id = jQuery('#'+outcome_div_id).attr('data-outcome-id');
					}
					
					var answer_tags = '';
					var answer_tags_arr = [];
					jQuery.each( sqb_question_answer_array, function( key, value ){
						var str = sqb_question_answer_array[key]['answer_tags'];
						if (typeof str !== "undefined") {
							var final_str = str.replaceAll( "NULL,","");
							if(/\d/.test(final_str)){
							 answer_tags += final_str+',';

							}
						}
					});

					
					
					var sqb_ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();
					jQuery.post(sqb_ajaxurl, {  
								action: 'SQBTagsContentAjax',
								outcome_id: outcome_id,
								answer_tags: answer_tags,
						}, function(response){
						response = JSON.parse(response);  
						jQuery('custom_tag').addClass('custom_hide_loader');
						jQuery('#'+outcome_div_id).find('.sqb_tags_content_details_outer').show();
						var tags_content = response.tags_content_html;
						jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll('[SHOWALLUSERTAGS]', '<div class="sqb_tags_content_details">'+tags_content+'</div>'));
						
						var sqb_redi_firstName = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val();

						jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll('%%FIRST%%', sqb_redi_firstName));
						//jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll('%%FIRSTNAME%%', sqb_redi_firstName));
						
						
						// Tag custom
						jQuery.each( sqb_question_answer_array, function( key, value ){
							var str = sqb_question_answer_array[key]['answer_tags'];
							
							if (typeof str !== "undefined") {
								var final_str = str.replaceAll( "NULL,","");
								if(/\d/.test(final_str)){
									var content = response.tagss[final_str];
									jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll('<custom_tag class="custom_hide_loader">[showtaggcontent id="'+final_str+'"]</custom_tag>', '<div class="sqb_tags_content_details">'+content+'</div>'));
								}
							}
						});

						//if(response.tagss.length > 0){

							jQuery.each( response.tagss, function( key, value ){
								var str = key;
								if (typeof str !== "undefined") {
									var final_str = str.replaceAll( "NULL,","");
									if(/\d/.test(final_str)){
										var content = response.tagss[final_str];
										jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll('<custom_tag class="custom_hide_loader">[showtaggcontent id="'+final_str+'"]</custom_tag>', '<div class="sqb_tags_content_details">'+content+'</div>'));
									}
								}

							});
						//}	

						jQuery('#'+outcome_div_id).html(jQuery('#'+outcome_div_id).html().replaceAll(/\[showtaggcontent id="(.*?)"\]/gm, ''));
						//jQuery('custom_tag').remove();
						//jQuery('custom_tag').remove();

					});		
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' custom_tag').remove();
				}
			}
	});
}


function sqb_replace_spider_charts_merge_tags(sqb_quiz_container_outer_id,sqb_quiz_id,sqb_charts_heading_text,only_merge_tag = ''){
var charts_settings = decodeURIComponent(jQuery('#'+sqb_quiz_container_outer_id+' #outcome_screen_charts_settings').val());
var final_charts_settings = charts_settings.split('|');

var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_ajaxurl').val();
jQuery.ajax({	 
		url: ajaxurl,	 
		type: "POST",
		//	async: true,
		//async: false,
		data: {
			action: 'SQBQuizTotalUserParticipatedAjax',
			sqb_quiz_id: sqb_quiz_id,
		},
		success: function (response) {	
			response = JSON.parse(response);
			console.log(sqb_charts_heading_text);
			var sqb_quiz_title = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_quiz_title').val();
			//var sqb_replaced_heading_text = sqb_charts_heading_text.replace('%%QUIZ_NAME%%', '"'+sqb_quiz_title+'"');
			var sqb_replaced_heading_text = sqb_charts_heading_text.replace('%%QUIZ_NAME%%', '"'+sqb_quiz_title+'"');
			var sqb_final_heading_text = sqb_replaced_heading_text.replace('%%TOTALUSERS%%', response.total_users);
			
			var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
			
			if(sqb_quiz_type == 'scoring' || sqb_quiz_type == 'personality'){
				if(final_charts_settings[15] != '' && final_charts_settings[15] == 'outcome_based'){
				} else {
				var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
				var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 		 
				if(sqb_points_ans =="NaN"	|| sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
					sqb_points_ans =0;
				}
				sqb_final_heading_text = sqb_charts_heading_text.replace('%%YOURSCORE%%', sqb_points_ans);
				sqb_final_heading_text = sqb_final_heading_text.replace('%%TOTALSCORE%%', total_pt);
				}
			}
			
			
			if(only_merge_tag == 'only_merge_tag'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_char_heading_class').html( "<div class='sqb_spider_charts_heading'>"+sqb_final_heading_text+"</div>" );
			}else{
				var template_num = jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val();
				if(template_num == 'template5'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' #result_temp_contentid').append( "<div class='sqb_spider_charts_heading'>"+sqb_final_heading_text+"</div>" );
				} else {
				jQuery('#'+sqb_quiz_container_outer_id+ ' #result_temp_contentid').after( "<div class='sqb_spider_charts_heading'>"+sqb_final_heading_text+"</div>" );
				}
			}
			
			
			}
	});
}

function calculate_average(total,count){

try{
	var final = total / count;
	return final.toFixed(2);
}catch(err) {
	return 0;
}

}

function sqb_save_user_quesans_array(sqb_question_answer_array, sqb_quiz_container_outer_id = '' , show_outcome_again =''){
var sqb_ajaxurl = jQuery('#sqb_ajaxurl').val();
jQuery.post(sqb_ajaxurl, {  
	action: 'sqb_save_user_ques_ans_array',
	sqb_question_answer_array: sqb_question_answer_array,   
	
}, function(response){
	response = JSON.parse(response);   
	if(sqb_quiz_container_outer_id != ''){

		var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
		/*if(sqb_quiz_type == 'poll'){
			// Add poll condition

			var quiz_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #quizId').val();
			var user_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();	
			var question_title =  jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').data('questiontitle');	

			jQuery.post(sqb_ajaxurl, {
				action: 'sqb_vote',
				quiz_id: quiz_id,
				user_id : user_id,
				sqb_question_answer_array : sqb_question_answer_array,
				question_title : question_title
				
			}, function(response1){

				response1 = JSON.parse(response1); 
				var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();

				  
				  if(is_outcome_redirect != 'Y'){

					  

					  if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
					  }else{
						jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
					  }
					
					var html = response1.html;
					var count_vote = response1.count_vote;
					var user_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls_poll').removeClass('hide_cls');	

					var show_optin = jQuery('#'+sqb_quiz_container_outer_id+ ' #show_optin').val();
					if(show_optin == 'Y'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls_poll_optin');
					}

					jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').addClass('hide_cls').removeClass('show_cls');
					//console.log(jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div'));
					jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').after('<div class="question_add_answer_outer_div-result">'+html+'</div>');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('show_cls').removeClass('hide_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote-count').html(count_vote);
					jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_ans_item_outer").removeClass('sqb_ans_selected');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .btn-add-vote').attr('disabled', true);


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
						if(show_optin == 'Y'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-change-vote').addClass('hide_cls').removeClass('show_cls');
						}

						jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
					}
				}else{


					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
						jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
					  }else{
						jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
					  }
					outcomeRedirectCall(sqb_quiz_container_outer_id, show_outcome_again);
					//console.log(response1);
					poll_chart(sqb_quiz_container_outer_id,response1.chart_data);
					
				}

			});


			
			// End
		}*/

		if(sqb_quiz_type != 'poll'){
			outcomeRedirectCall(sqb_quiz_container_outer_id, show_outcome_again);
		}



		//sqb_show_outcome_tags(sqb_quiz_container_outer_id,sqb_question_answer_array);
	}
});		
}

function sqb_save_user_quesans(user_id,quizId,  ques_id,answer_id, correct_ans, answer_text, sqbdatetime, points_scored, total_points){

//added for the backend preview	
var SQBPreview = jQuery('#SQBPreview').val();
if(SQBPreview =="Y"){
	return false;
}

var sqb_ajaxurl = jQuery('#sqb_ajaxurl').val();
jQuery.post(sqb_ajaxurl, {  
	action: 'sqb_save_user_ques_ans',
	user_id: user_id,   
	quizId: quizId,   
	ques_id: ques_id,   
	answer_id: answer_id,   
	correct_ans : correct_ans,
	answer_text : answer_text,
	sqbdatetime : sqbdatetime,
	points_scored : points_scored,
	total_points : total_points,
}, function(response){
	response = JSON.parse(response);   
});		
}

function sqb_append_share_btn(outcome_id = ''){

var sqb_quiz_container_outer_id = jQuery('#'+outcome_id).closest('.sqb_quiz_container_outer').attr('id');
var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
if(quiz_display =="popup" ){
	sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
}
var share_html =  jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_social_share_html").html();

if(share_html != ''){
	if( jQuery("#"+sqb_quiz_container_outer_id+ "  #"+outcome_id).find('.customize_social_share_wrapper').length == 0){
		 jQuery("#"+sqb_quiz_container_outer_id+ " #"+outcome_id+" .result_temp_outer").append(share_html);				
		 jQuery("#"+sqb_quiz_container_outer_id+ " .sqb_social_share_html").attr('data-outcome-id',outcome_id);			
	}
}
}





var sqb_tw_timer = ''; 
function sqb_twitter_share(share_url = '',sqb_quiz_container_outer_id){
	//window.open(url, 'twitter', opts);
	sqb_child_window = window.open(share_url, 'twitter', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');	
	sqb_tw_timer = setInterval(function() { sqbTwCheckChild(sqb_quiz_container_outer_id); }, 1000);
}


function sqbTwCheckChild(sqb_quiz_container_outer_id) {
if (sqb_child_window.closed) {
	//var sqb_quiz_container_outer_id = jQuery(this).closest('.sqb_quiz_container_outer').attr('id');
	var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
	/*if(quiz_display =="popup" ){
		sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
	}*/ 
			//jQuery('#'+sqb_quiz_container_outer_id+ ' .customize_social_share_wrapper .quiz-social-links').hide();
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



function sqb_generate_share_variable_dynamic(sqb_quiz_container_outer_id = '',quiz_id = 0,quiz_type = '', outcome_id = 0,variable1 = 0,variable2 = 0 ){

//added for the backend preview	
var SQBPreview = jQuery('#SQBPreview').val();
if(SQBPreview =="Y"){
	return false;
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
		
		var quiz_display = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_display').val();	
		if(quiz_display =="popup" ){
			sqb_quiz_container_outer_id = "pop"+sqb_quiz_container_outer_id;
		} 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #share_paremets_quiz').val(response.share_paremets); 
		jQuery('#'+sqb_quiz_container_outer_id+ ' #tw_share_description').val(response.tw_share_description); 
	}
});		
 

}
//which answer has max points matrix
//which answer has max points matrix
function getmaxDataPointsMatrix(ques_id, sqb_quiz_container_outer_id) {

var max_points_new = 0;
var data_points_array = [];		   
 jQuery('#'+sqb_quiz_container_outer_id+ ' #'+ques_id+ ' .matrix_cls').each(function(){
	//max_points = parseInt(max_points) + parseInt(jQuery(this).attr('data-assigned-value'));
	var max_points = 0;
	 jQuery(this).find('.checkbox_fe').each(function(){ 
		 var data_points = jQuery(this).attr('data-assigned-value');			 
		data_points_array.push(data_points);	
	 });
	
	 
	max_points = Math.max.apply(Math,data_points_array); // Math.max(data_points_array);
	 
	max_points_new = parseInt(max_points) + parseInt(max_points_new);		
});		    
// console.log(data_points_array); 
return max_points_new;	
 
}
//which answer has max points multiplechoice
function getmaxDataPointsMultipleChoice(ques_id, sqb_quiz_container_outer_id) {
var max_points = 0;		   
 jQuery('#'+sqb_quiz_container_outer_id+ ' #'+ques_id+ ' .multiple_correct_checkbox .checkbox_fe').each(function(){
	var multi_ans_given_points1 = jQuery(this).closest('.multiple_correct_checkbox').attr('data-point');
	var max_points = max_points + parseInt(multi_ans_given_points1);
});		 
return max_points;	
 
}

function sort_catgory_name(a, b){
var aText = jQuery(a).attr('title'), bText =jQuery(b).attr('title');
return aText > bText ? -1 : aText > bText ? 1 : 0;
}

function sqb_show_category_details(sqb_quiz_container_outer_id = '', obj = '', quiz_type = '' ){
 
if(quiz_type == 'scoring' || quiz_type == 'assessment'){
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer .outcome_div').each(function(){
		var clone_outcome_id = jQuery(this).attr('data-outcome-id');
		var clone_outcome_html = jQuery(this).html();
		if (clone_outcome_id in sqb_outcome_content_clone === false) { 
			
			sqb_outcome_content_clone[clone_outcome_id] = clone_outcome_html;
		}
		
	});
}

var total_text = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_cat_total_text"]').val();
		var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val();
		
		var cat_html = '';
		var maxcatval = '';
		var maxcatval1 = '';
		if(sqb_quiz_category_enable == 'Y'){
			var sqb_category_details = '';
			var cat_ids = {};
			var eachcat_ids = {};
			var max_cat_val =0;
			var maxcatval1 =0;
			jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_quesans_template_outer .Quiz-Template').each(function(){
				 
				if(quiz_type == 'scoring'){ 						
					var parent_hasClass =  jQuery(this).find(".question_container").hasClass('multiple_correct_cls');
					var ques_id =  jQuery(this).find(".question_container").attr('id');
					var matrix_cls =   jQuery(this).find(" .sqb_ans_item_outer").hasClass('matrix_cls'); 
					var question_type_slider_cls =   jQuery(this).find(" .question_container").hasClass('question_type_slider'); 
					var matching_text =   jQuery(this).find(" .question_container").hasClass('question_type_matching_text'); 
					
					if(parent_hasClass== true){
						var cat_id =  jQuery(this).attr('data-category-id');
						 
						if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
							
						}else{							
							 
							jQuery(this).find(".question_container .checkbox_fe").each(function(){						 
								
								max_cat_val = jQuery(this).closest('.multiple_correct_checkbox').attr('data-point');
								if(jQuery(this).prop("checked") == true){
									cat_val = jQuery(this).closest('.multiple_correct_checkbox').attr('data-point');	
										if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
											cat_val =0;
											max_cat_val =0;
										}

									if(cat_ids[cat_id]){										
										cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
										
									}
									cat_ids[cat_id] = cat_val;
								}
								 
								if(eachcat_ids[cat_id]){
									max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
								}
								eachcat_ids[cat_id] = max_cat_val;			
							});								
							  
						}
						
					}else{
						
						if(matrix_cls== true){	 //matrix question type							
							 
							 var cat_id =  jQuery(this).attr('data-category-id');	 
							if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
								
							}else{							
								
								
								jQuery(this).find(".question_container  .matrix_cls ").each(function(){				 
									cat_val =  jQuery(this).find('.checkbox_fe:checked').attr('data-assigned-value');
									 
									if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
											cat_val =0;
									 }
									if(cat_ids[cat_id]){
										cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
									}
									cat_ids[cat_id] = cat_val;
									
									max_cat_val = getmaxDataPointsMatrix(ques_id, sqb_quiz_container_outer_id);
									
									if(eachcat_ids[cat_id]){
										//max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
									}
									eachcat_ids[cat_id] = max_cat_val;							
									  
								});
									
								
							}
							 
						}else if(question_type_slider_cls == true){	 //slider question type
							var cat_id =  jQuery(this).attr('data-category-id');	 
							if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
								
							}else{	
								
													 
								if(quiz_type == 'scoring'){
									cat_val = jQuery(this).find('.sqb_ans_slider').val();
									max_cat_val = jQuery(this).find('.sqb_ans_slider').attr('data-slider-max');
									 
									 if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
											cat_val =0;
									 }
								}else{
									return false;
								}	
								if(cat_ids[cat_id]){
									cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
								}
								cat_ids[cat_id] = cat_val;
								
								if(eachcat_ids[cat_id]){
									max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
								}
								eachcat_ids[cat_id] = max_cat_val;
								 
							} 
						}else if(matching_text == true){

							var cat_id =  jQuery(this).attr('data-category-id');	 
							if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
								
							}else{
								if(quiz_type == 'scoring'){

									var parent_ques_div = jQuery(this).find(".question_container").attr('id');
									cat_val = calculate_match_points(jQuery(this).find(".question_container"));
									max_cat_val = getmaxDataPointsForMatchingType(parent_ques_div, sqb_quiz_container_outer_id) ;

									if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
										cat_val =0;
									 }
								}else{
									return false;
								}

								if(cat_ids[cat_id]){
									cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
								}
								cat_ids[cat_id] = cat_val;
								
								if(eachcat_ids[cat_id]){
									max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
								}
								eachcat_ids[cat_id] = max_cat_val;
							}

						}else{
						
							if(jQuery(this).find('.sqb_ans_selected')){
								var cat_id =  jQuery(this).attr('data-category-id');
								if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
									
								}else{
									if(quiz_type == 'scoring'){
										cat_val = jQuery(this).find('.sqb_ans_selected').attr('data-point');
										
										max_cat_val = getmaxDataPoints(ques_id, sqb_quiz_container_outer_id);
										
										 if(cat_val =="NaN"	|| cat_val =="nan" || cat_val =="NAN" || typeof cat_val =="undefined"){
												cat_val =0;
										 }
									}else{
										return false;
									}	
									if(cat_ids[cat_id]){
										cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
									}
									cat_ids[cat_id] = cat_val;
									
									if(eachcat_ids[cat_id]){
										max_cat_val = parseFloat(eachcat_ids[cat_id])+parseFloat(max_cat_val);
									}
									eachcat_ids[cat_id] = max_cat_val;
								}
							}
						}
					}
					
				}else{
					
					
					if(jQuery(this).find('.sqb_ans_selected').hasClass('correct_ans_cls')){
						var cat_id =  jQuery(this).attr('data-category-id');
						if((cat_id == undefined) || (cat_id == '') || (cat_id == 0)){
							
						}else{
							if(quiz_type == 'assessment'){
								cat_val = 1;
								
							}else{
								return false;
							}	
							if(cat_ids[cat_id]){
								cat_val = parseFloat(cat_ids[cat_id])+parseFloat(cat_val);
							}
							cat_ids[cat_id] = cat_val;
						}
					}
				}
				
			});
			
			var category_list_total_info = [];
			var category_with_max_points = [];
			
			var category_list_json = jQuery('input[name="category_list_json"]').val();
			var cat_html = '';
			var cat_html1 = '';
			var cat_total_html = '';
			var cat_total_val = 0;
			var cat_total_per = 0;
			cat_ids_with_value  = {};
			
			if(category_list_json != ''){
				category_list_json = JSON.parse(category_list_json);
				  
				jQuery.each(cat_ids,function(index, value){
				  
					if(category_list_json[index]){
						var cat_get_value = value;
						if(cat_get_value =="NaN"	|| cat_get_value =="nan" || cat_get_value =="NAN" || typeof cat_get_value =="undefined"){
								cat_get_value =0;
						}
						category_with_max_points.push(cat_get_value);
						
						cat_ids_with_value[cat_get_value] = index;
												
						cat_total_val = parseFloat(cat_total_val)+parseFloat(cat_get_value);
					}
				});
				
				jQuery.each(cat_ids,function(index, value){					  
					if(category_list_json[index]){							
						 
						var cat_get_value = value;
						if(cat_get_value =="NaN"	|| cat_get_value =="nan" || cat_get_value =="NAN" || typeof cat_get_value =="undefined"){
								cat_get_value =0;
						}
						var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	 
						var final_cate_val = jQuery("#"+sqb_quiz_container_outer_id+ " #final_cate_val").val();	 
						 
						//if advanced rules for answer exist						 
						if(outcomerule_id >0){
						}else{								 
							if(final_cate_val >0){
								//return;
							}else{ 
								//added for the category mapping									 
								var category_with_max_points1 =  Math.max.apply(Math,category_with_max_points) ;									 
								categoryOutcomeMapping(sqb_quiz_container_outer_id, index, cat_get_value, cat_ids_with_value[category_with_max_points1]);
								
							}
						}
						
						//if(cat_total_val > 0){ 
							var maxcatval = eachcat_ids[index];	
							maxcatval1 = maxcatval1 + maxcatval ;	 						
							//var cat_total_per = (parseFloat(cat_get_value)/parseFloat(cat_total_val)*100).toFixed(2); 
							var cat_total_per = (parseFloat(cat_get_value)/parseFloat(maxcatval)*100).toFixed(2); 
						//}
						if(cat_total_per < 1){
							cat_total_per =0;
						}
						if(typeof maxcatval  == 'undefined'){
							maxcatval =0;
						}
											  
						if(isSQBInteger(maxcatval) ==true){
							maxcatval = parseInt(maxcatval); 
						}else{
							maxcatval =0;
						}
						if(isSQBInteger(cat_total_per) ==true){
							cat_total_per = parseInt(cat_total_per); 
						}
						if(cat_get_value > 0){
							cat_html += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span>'+cat_get_value+' ('+cat_get_value+'/'+maxcatval+')</span></div>';
							cat_html1 += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span>'+cat_total_per+'%  ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
						}else{
								cat_html += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span> '+cat_get_value+'  ('+cat_get_value+'/'+maxcatval+')</span></div>';
							cat_html1 += '<div class="cat-details-row"><label><b>'+category_list_json[index]+'</b> : </label><span> 0% ('+cat_get_value+'/'+maxcatval+')</span></div>'; 
						}							
					}
				});

				ShowCategoryScoreHTML(category_list_json,sqb_quiz_container_outer_id,cat_ids,obj,eachcat_ids);
				
			}
			if(cat_total_val > 0){ 
				cat_total_html = '<div class="cat-details-row cat-details-total"><label><b>'+total_text+'</b></label><span>'+cat_total_val+' ('+cat_total_val+'/'+maxcatval1+')</span></div>';
			}					
				  
			
			cat_html = cat_total_html+cat_html; 
			cat_html1 = cat_total_html+cat_html1; 
			if(Object.keys(cat_ids).length != 0){
				jQuery('#'+sqb_quiz_container_outer_id).find('input[name="category_result_list_json"]').val(JSON.stringify(cat_ids));
			}				
		}
		if(obj != ''){
				jQuery(obj).html(jQuery(obj).html().replace('[SHOW_CATEGORY_TOTAL]', '<div class="sqb_category_details sqb_category_overall">'+cat_html+'</div>'));
				jQuery(obj).html(jQuery(obj).html().replace('[CATEGORY_TOTAL_NUMBER]', '<div class="sqb_category_details category_number_div">'+cat_html+'</div>'));
				jQuery(obj).html(jQuery(obj).html().replace('[CATEGORY_TOTAL_PERCENT]', '<div class="sqb_category_details category_number_percent">'+cat_html1+'</div>'));
				jQuery(obj).html(jQuery(obj).html().replace('%%SHOW_CATEGORY_TOTAL%%', '<div class="sqb_category_details">'+cat_html+'</div>'));	
				jQuery(".category_number_percent_co").html(cat_html1); 			
		}else{
			jQuery(obj).html(jQuery(obj).html().replace('[SHOW_CATEGORY_TOTAL]', ''));
			jQuery(obj).html(jQuery(obj).html().replace('[CATEGORY_TOTAL_NUMBER]', ''));
			jQuery(obj).html(jQuery(obj).html().replace('[CATEGORY_TOTAL_PERCENT]', ''));
			jQuery(obj).html(jQuery(obj).html().replace('%%SHOW_CATEGORY_TOTAL%%', ''));	
			jQuery(".category_number_percent_co").html('');
		}
		
}

function isSQBInteger(value) {
if ((undefined === value) || (null === value)) {
	return false;
}
return value % 1 == 0;
}

function categoryOutcomeMapping(sqb_quiz_container_outer_id, index, cat_get_value, category_with_max_points) {
	
var outcomerule_id = jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_advanced_rule_id").val();	 
var final_cate_val = jQuery("#"+sqb_quiz_container_outer_id+ " #final_cate_val").val();	 
var founddata = false;
//if advanced rules for answer exist						 
if(outcomerule_id >0){
	return;
}
 
if(final_cate_val >0){
	return;
}

if(founddata) {									 
}else{
	jQuery('#'+sqb_quiz_container_outer_id+ ' .cat_advanced_rules').each(function(){									 
		  var datatitle = jQuery(this).attr('data-title');
		  var categoryid = jQuery(this).attr('data-categoryid');
					  
		  if(datatitle =="number"){
			   var datanum = jQuery(this).attr('data-range');										    									 
			   if(datanum >= 0){								 
				   if(categoryid == index){
					   if(cat_get_value == datanum){
							founddata = true; 
							jQuery("#"+sqb_quiz_container_outer_id+ " #final_cate_val").val(1);	 
							var outcome_id = jQuery(this).val();
							jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
							jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcome_id).show();	
							jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);	
							return false;
					   }
				   }
			   }
		  }else if(  datatitle =="category_highest" ){
			  
			  if(categoryid == category_with_max_points){				   
					founddata = true; 
					jQuery("#"+sqb_quiz_container_outer_id+ " #final_cate_val").val(1);	 
					var outcome_id = jQuery(this).val();						  
					jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
					jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcome_id).show();	
					jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);	
					return false;
					
			   }
		  }else if(datatitle =="range" || datatitle =="category_total" ){
			   var datastart = jQuery(this).attr('data-start');
			   var dataend = jQuery(this).attr('data-end');
			   
			   if(categoryid == index){
				   if(cat_get_value >= datastart  ){
					   if(  cat_get_value <= dataend){
						   founddata = true; 
						   jQuery("#"+sqb_quiz_container_outer_id+ " #final_cate_val").val(1);	 
							var outcome_id = jQuery(this).val();
							jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
							jQuery("#"+sqb_quiz_container_outer_id+ " #outcome_id_"+outcome_id).show();		
							jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);	
							return false;
					   }
				   }
			   }
			 
		  }
	});	 
	 
}	
		
//if advanced rules for answer exist						 
if(outcomerule_id >0){
}else{
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .cat_advanced_rules').length > 0){
		if(!founddata) {
			jQuery("#"+sqb_quiz_container_outer_id+ " .outcome_div").hide();	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().show();  
			var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().attr("data-outcome-id");  
			jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val(outcome_id);	
		}
	}
}			
}

function replaceAll(str, find, replace) {
return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}


function sqb_update_outcome_ranking_merge_tag(sqb_quiz_container_outer_id = '', show_outcome_id = 0){
// adding outcome ranking number start 	
var sqb_rank_outcome_array_with_points = {};
var sqb_outcome_index = '';
for (sqb_outcome_index = 0; sqb_outcome_index < outcome_ids_array.length; sqb_outcome_index++) {
	var rank_outcome_id = outcome_ids_array[sqb_outcome_index];
	if(rank_outcome_id in sqb_rank_outcome_array_with_points){
		sqb_rank_outcome_array_with_points[rank_outcome_id] = sqb_rank_outcome_array_with_points[rank_outcome_id] + 1;
	}else{
		sqb_rank_outcome_array_with_points[rank_outcome_id] = 1;
		
	}
}



	var sqb_rank_outcome_array_with_points_array = [];
	for (var sqb_rank_outcome_array_with_point in sqb_rank_outcome_array_with_points) {
		sqb_rank_outcome_array_with_points_array.push([sqb_rank_outcome_array_with_point, sqb_rank_outcome_array_with_points[sqb_rank_outcome_array_with_point]]);
	}

	sqb_rank_outcome_array_with_points_array.sort(function(a, b) {
		return b[1] - a[1];
	});
	
	
	
	var sqb_rank_currect_obj = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+show_outcome_id);

	jQuery.each( sqb_rank_outcome_array_with_points_array, function( key, value ) {
		
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+show_outcome_id).length != 0){
				
					
				 var ranking_sqb_outcome_index = 0;
				 jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(sqb_outcome_index){
					 
					var sqb_rank_outcome_name = jQuery(this).find("#outcome_name").val();
					ranking_sqb_outcome_index++;
					var ranking_key = '';
					var ranking_value = '';
					var no_ranking = true;
					
					if(sqb_rank_outcome_array_with_points_array[sqb_outcome_index] != undefined){
						
						var no_ranking = false;
						var ranking_key =  sqb_rank_outcome_array_with_points_array[sqb_outcome_index][0];
						var ranking_value = sqb_rank_outcome_array_with_points_array[sqb_outcome_index][1];
						
					}

					
					if(jQuery(this).is(":visible")){
						if(no_ranking){
							jQuery(sqb_rank_currect_obj).html(jQuery(sqb_rank_currect_obj).html().replace('[OUTCOME_RANK_'+ranking_sqb_outcome_index+']', ''));
							
						}else if(ranking_value > 1){
							jQuery(sqb_rank_currect_obj).html(jQuery(sqb_rank_currect_obj).html().replace('[OUTCOME_RANK_'+ranking_sqb_outcome_index+']', sqb_rank_outcome_name+' ('+ranking_value+' points)'));
							
						}else{
							jQuery(sqb_rank_currect_obj).html(jQuery(sqb_rank_currect_obj).html().replace('[OUTCOME_RANK_'+ranking_sqb_outcome_index+']', sqb_rank_outcome_name+' ('+ranking_value+' point)'));
						}
					}
				});
				
				
			}
	});
	var ranking_sqb_outcome_index = 0;
	jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').each(function(sqb_outcome_index){
		ranking_sqb_outcome_index++;

		if(jQuery(this).is(":visible")){
			console.log('test');
			jQuery(sqb_rank_currect_obj).html(jQuery(sqb_rank_currect_obj).html());
		}

		
	});

// adding outcome ranking number end 
}

function sqbQuizPdf(sqbQuizForm,quizId, outcome_id, pathtopdf, ){

var form_id ="#sqbQuizForm"+quizId+outcome_id;
var sqb_quiz_container_outer_id = jQuery(form_id).closest('.sqb_quiz_container_outer').attr('id');

 var user_id =  jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();			 
 var fname =  jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val();			 
 var email =  jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #email').val();	
	   
var sqb_question_answer_array = [];  
var answer_type = '';   
var answer_tags = ''; 
var other_field = ''; 
var points_scored = 0; 
var answer_points_scored = 0; 
var total_points = 0; 
jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
	answer_tags = '';
	answer_points_scored = 0;
	var ques_id = jQuery(this).data('id');	
	var answer_id = jQuery(this).data('key'); 	
	var correct_ans = jQuery(this).data('correct');	
	
	var matrix_cls = false;
	var answer_type = '';  

	var single_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('single_cls'); 
	var fill_in_blank_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
	var text_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('text_cls'); 
	var date_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('date_cls'); 
	var slider_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('slider_cls'); 
	var file_upload_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls');
	var matrix_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matrix_cls');
	var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
	var matching_text = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matching_text');
	var phone_number_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('phone_number_text_cls');
	var email_cls =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('email_cls'); 

	if(fill_in_blank_cls ==true){
		var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_fill_in_blank_ans_field").val();	
		var answer_type = 'fill_in_blank';				
	}else if(text_cls ==true){
		var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_textarea_ans_field").val();	
		var answer_type = 'text';
	}else if(email_cls ==true){
		var answer_text =   jQuery("#"+sqb_quiz_container_outer_id+ " #question_id_"+ques_id+" .sqb_email_ans_field").val();	
				 
	}else if(date_cls ==true){
		var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .date-question-type").val();
		var answer_type = 'date';
	}else if(phone_number_text_cls == true){

		var country_code =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".iti__country.iti__active .iti__dial-code").html();
		var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
		if(answer_text != ''){
			answer_text =  country_code+' '+answer_text;
		}else{
			answer_text = '';
		}
	}else if(file_upload_cls == true){
		var fileURl =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".file_upload_cls").attr('data-fileurl');
		var answer_text = fileURl;
		var answer_type = 'file_upload';
	}else if(matching_text == true){
		var html = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find('.sqb_input_ans_field').html();
		var answer_text = html;	
		answer_type = 'matching_text';
		answer_points_scored = calculate_match_points(jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id));
	}else if(slider_cls == true){
		var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('prefix_text');	
		var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('suffix_text');	
		var slider_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").val();
		var answer_text = prefix_text+' '+slider_value+' '+suffix_text;
		var answer_type = 'slider';
	}else if(matrix_cls == true){
		answer_type = 'matrix';
	}else if(numeric_text_cls == true){
		var answer_type = 'numeric';
		var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_prefix").text();	
		var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_sufix").text();	
		var numeric_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
		var pretext = '';
		if (typeof prefix_text !== "undefined") {
			pretext = prefix_text;
		}
		var suftext = '';
		if (typeof suffix_text !== "undefined") {
			suftext = suffix_text;
		}
		var answer_text = pretext+''+numeric_value+''+suftext;
	}else{
		var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected .sql_ans_text").text();
		var multiple_or_single =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).hasClass('multiple_correct_cls');
		 if(multiple_or_single){
			 answer_type ="multiple";
			  var answer_points_scored_new  = 0;
			  var answer_tags_new = '';
			  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_and_field.checkbox_fe").each(function(){
					if(jQuery(this).prop('checked')){
						 var answer_tags_new = jQuery(this).closest('.multiple_correct_checkbox').attr('data-answer-tags');
						 //if(){
						 answer_tags = answer_tags+answer_tags_new+',';
						 //}
						 var answer_points_scored_new = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
						 answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
					}
			  });
			 
			 
		 }else{
			 answer_type = 'single';
			  console.log("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected");
			 answer_tags = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-tags');
			 other_field = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find('.custom-other-box').val();
			 answer_points_scored = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
			 
		 }
	}
	
	
	
	var incorrect_answer_msg_exp = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .incorrect_answer_msg").val();
	var common_incorrect_answer_msg_exp = jQuery("#common_incorrect_msg").val();		 
	if(incorrect_answer_msg_exp ==""){
		incorrect_answer_msg_exp = common_incorrect_answer_msg_exp;
	}
	
	//sqb_save_user_quesans(user_id, quizId, ques_id,answer_id, correct_ans, answer_text, sqbdatetime, points_scored, total_points);
	sqb_question_answer_array.push({
			//'user_id':user_id,
			'quizId':quizId,
			'ques_id':ques_id,
			'answer_id':answer_id,
			'correct_ans':correct_ans,
			'answer_text':answer_text,				 
			'points_scored':points_scored,
			'total_points':total_points,
			'incorrect_answer_msg_exp':incorrect_answer_msg_exp,
			'answer_type':answer_type,
			'answer_tags':answer_tags,
			'other_field':other_field,
			'answer_points_scored':answer_points_scored,
			
	});			
	
}); 

var category_result_list_array = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="category_result_list_json"]').val();  
/*if(category_result_list_json != ''){ 
	category_result_list_array = JSON.parse(category_result_list_json);
}*/

var category_number_percent	 = jQuery('#'+sqb_quiz_container_outer_id+ '  .category_number_percent_co').html();
var outcomeid = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().attr('id');	
var category_number_div= jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_div').html();
var optin_form_fields = jQuery('#'+sqb_quiz_container_outer_id).find("#sqb_direct_signup").find(":input:not(:hidden)").serialize();


var stringList = JSON.stringify(sqb_question_answer_array);

if(jQuery('.outcome_div:visible .Quiz-result-Template5').length  > 0){
	var outcome_content = jQuery('.outcome_div:visible .Quiz-result-Template5 .Quiz-result-Template5-right').html();
}else{
	var outcome_content = jQuery('.outcome_div:visible .result_temp_outer .Quiz-Template-content').html();
}


//console.log(outcome_content);
jQuery('body').append('<div style="display:none;" class="tmp_html_generate">'+outcome_content+'</div>');
jQuery('.tmp_html_generate').find('.outcome_products_section').remove();

jQuery('.tmp_html_generate').find('form').remove();

var temp_outcome_content = jQuery('.tmp_html_generate').html();

jQuery('.tmp_html_generate').remove();


var answer_tags = '';
var answer_tags_arr = [];
jQuery.each( sqb_question_answer_array, function( key, value ){
	var str = sqb_question_answer_array[key]['answer_tags'];
	if (typeof str !== "undefined") {
		var final_str = str.replaceAll( "NULL,","");
		if(/\d/.test(final_str)){
		 answer_tags += final_str+',';

		}
	}
});

stringList = stringList.replaceAll("'",'&lsquo;');
//jQuery(form_id).append('<textarea name="outcome_content" style="display:none !important;">'+outcome_content+'</textarea>'  );
 //jQuery("body").append("<form action='"+pathtopdf+"' method='post' name='sqbQuizForm' id='sqbQuizForm"+quizId+"' target='_blank'>");					  
jQuery(form_id).append('<input type="hidden" name="quiz_id" value="1" >'  );
jQuery(form_id).append("<input type='hidden' name='quiz_id' value='"+quizId+"'>"  );
jQuery(form_id).append("<input type='hidden' name='outcome_id' value='"+outcome_id+"'>");
jQuery(form_id).append("<input type='hidden' name='user_id' value='"+user_id+"'>");						 
jQuery(form_id).append("<input type='hidden' name='email' value='"+email+"'>");						 
jQuery(form_id).append("<input type='hidden' name='fname' value='"+fname+"'>");						 
jQuery(form_id).append("<input type='hidden' name='category_number_percent' value='"+category_number_percent+"'>");		
jQuery(form_id).append("<input type='hidden' name='optin_form_fields' value='"+optin_form_fields+"'>");		
jQuery(form_id).append("<input type='hidden' name='category_number_div' value='"+category_number_div+"'>");	
jQuery(form_id).append("<input type='hidden' name='category_result_list_array' value='"+category_result_list_array+"'>");						 
jQuery(form_id).append("<input type='hidden' name='sqb_question_answer_array' value='"+stringList+"'>");
jQuery(form_id).append("<input type='hidden' name='answer_tags' value='"+answer_tags+"'>");
var formdata = jQuery(form_id).serializeArray();

formdata.push({name: "outcome_content", value: temp_outcome_content});

//jQuery(form_id).html('');

var get_url = jQuery('#get_home_url').val();
var downloadText = jQuery('.outcome_button_pdf div').html();
var pdf_download_success_text = jQuery('#pdf_download_success').val();
var pdf_downloadingText = jQuery('#pdf_downloading_text').val();
jQuery('.outcome_button_pdf div').html(pdf_downloadingText);
jQuery('.outcome_button_pdf').addClass('downloading-pdf');
jQuery('.outcome_button_pdf').css('downloading-pdf');

jQuery.ajax({
	type: "POST",
	url: '?sqb_pdf_download=1',
	data: formdata,
	xhrFields: {
		responseType: 'blob' // to avoid binary data being mangled on charset conversion
	},
	success: function(blob, status, xhr) {
		jQuery('.outcome_button_pdf div').html(downloadText);
		jQuery('.outcome_button_pdf').removeClass('downloading-pdf');

		jQuery('.generate_pdf_form').after('<div class="pdf-success">'+pdf_download_success_text+'</div>');

		setTimeout(function(){
			jQuery('.pdf-success').remove();
		},10000);

		// check for a filename
		var filename = "";
		var disposition = xhr.getResponseHeader('Content-Disposition');
		if (disposition && disposition.indexOf('attachment') !== -1) {
			var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
			var matches = filenameRegex.exec(disposition);
			if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
		}

		if (typeof window.navigator.msSaveBlob !== 'undefined') {
			// IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
			window.navigator.msSaveBlob(blob, filename);
		} else {
			var URL = window.URL || window.webkitURL;
			var downloadUrl = URL.createObjectURL(blob);

			if (filename) {
				// use HTML5 a[download] attribute to specify filename
				var a = document.createElement("a");
				// safari doesn't support this yet
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

			setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
		}
	},error: function(XMLHttpRequest, textStatus, errorThrown) { 
		jQuery('.outcome_button_pdf div').html(downloadText);
		jQuery('.outcome_button_pdf').removeClass('downloading-pdf');
	}   
});



//jQuery(form_id).submit();							
//jQuery("form[name='sqbQuizForm']").remove();

return false;							 
window.open(url);		 
return;
}


function autoSubmitOptin(sqb_quiz_container_outer_id = ''){
//console.log('autoSubmitOptin');

var wrapper = '';
var wrapper1 = '';
if(sqb_quiz_container_outer_id == ''){
	wrapper = '.sqb_quiz_container_outer';
}else{
	wrapper = '#'+sqb_quiz_container_outer_id;
}

if(sqb_quiz_container_outer_id == ''){
	wrapper1 = jQuery('.sqb_quiz_container_outer').attr('id');
}else{
	wrapper1 = ''+sqb_quiz_container_outer_id;
}

var social_share_screen_value = jQuery(wrapper+ " #social_share_screen_value").val();
if(social_share_screen_value == 'Y'){
	jQuery(wrapper+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
	return false;
}

var firstname = sqbgetUrlVars()["firstname"];
if(firstname == null){
	 var firstname = sqbgetUrlVars()["first_name"];
 }
var email = sqbgetUrlVars()["email"];



if(firstname != undefined || email != undefined){
	if(jQuery('.sqb_first_name').val() != undefined ){
	}else{
		if(jQuery(wrapper+ ' .quiz_optin_template_outer').find('#first_name').val() == ''){
			jQuery(wrapper+ ' .quiz_optin_template_outer').find('#first_name').val(firstname);
		}
	}
	if(jQuery(wrapper+ ' .quiz_optin_template_outer').find('#email').val() == ''){
		jQuery(wrapper+ ' .quiz_optin_template_outer').find('#email').val(email);
	}

}

CustomFieldsAutoPopulate();

var auto_submit_optin = jQuery(wrapper+ " #auto_submit_optin").val();
var show_result_screen = jQuery(wrapper+ " #show_result_screen").val();
var social_share_screen_value = jQuery(wrapper+ " #social_share_screen_value").val();

if(auto_submit_optin == 'Y' && show_result_screen == 'Y'){

	// Set email question type

	if(jQuery('.sqb_email_ans_field').length > 0 && jQuery('.sqb_email_ans_field').val() != ''){

		try {
			var qemail = jQuery(wrapper+ ' .sqb_email_ans_field').val();
			var qfirstname = qemail.split('@')[0];

			var show_firstname_temp = jQuery(wrapper+ ' #show_firstname_temp').val(); 
			if(show_firstname_temp != 'Y'){
				if(firstname == '' || firstname == undefined){
					jQuery(wrapper+ ' .quiz_optin_template_outer').find('#first_name').val(qfirstname);
				}
			}
			jQuery(wrapper+ ' .quiz_optin_template_outer').find('#email').val(qemail);
		} catch (error) {}

	}

	jQuery(wrapper+' .continue_btn').trigger('click');
	if(jQuery(wrapper+ ' .sqbwarning_div').length > 0){
		
		jQuery(wrapper+' .sqbwarning_div').remove();
		jQuery(wrapper+' .sqb_custom_field_required_class').html('');
		jQuery(wrapper+' .sqb_custom_field_required_class').hide();

		jQuery(wrapper+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
	}else{
		if(jQuery(wrapper+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen'){

		}else{
			
			jQuery(wrapper+ ' .quiz_analyzing_template_outer').addClass('show_cls').removeClass('hide_cls'); 
		}

	}
}else{
	jQuery(wrapper+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');

	if((jQuery(wrapper+ ' #quiz_slider_animation').val() == 'Y') && (jQuery(wrapper+ ' #quiz_slider_animation_option').val() == 'tb')){ 
							
	}else{	
		quizScrollToDivTop(wrapper+ ' .quiz_optin_template_outer');
	}
}
}

function CustomFieldsAutoPopulate(){

var error = [];
var exists_field = [];
var allValues = sqbgetUrlVars();

jQuery(".custom_add_fields").each(function(){
		
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


jQuery("#sqb_direct_signup").find("input[name^='custom_'],select[name^='custom_'], radio[name^='custom_'], textarea[name^='custom_'], checkbox[name^='custom_']").each(function(){

	var field = jQuery(this);
	var value = '';
	var type = field.prop('nodeName');
	var name =  field.attr('name');;
	

	if(jQuery.inArray(name,exists_field) == -1){

		if(type == 'INPUT'){

			console.log(name+' '+type+' '+allValues[name]);
			
			if(field.is(':radio')){
				
				if(allValues[name] != undefined){
					//field.val(allValues[name]);
					jQuery("input[name="+name+"][value=" + allValues[name] + "]").prop('checked', true);
				}
			}else if (field.is(':checkbox')) {
				
				if(allValues[name] != undefined){
					//field.val(allValues[name]);
					
					jQuery("input[name='"+name+"'][value=" + allValues[name] + "]").prop('checked', true);
				}
			}else{
				if(allValues[name] != undefined){
					console.log(allValues[name]);
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

});

}

function make_full_width_of_section(){
var window_width = jQuery('html').width();
jQuery('html').css("--window-width-full-screen", window_width+'px');
}

window.addEventListener('resize', function(event) {
make_full_width_of_section();
}, true);
make_full_width_of_section();

function sqb_confetti_animation(){
for(i=0; i<100; i++) {
	// Random rotation
	var randomRotation = Math.floor(Math.random() * 360);
	  // Random Scale
	var randomScale = Math.random() * 1;
	// Random width & height between 0 and viewport
	var randomWidth = Math.floor(Math.random() * Math.max(document.documentElement.clientWidth, window.innerWidth || 0));
	var randomHeight =  Math.floor(Math.random() * Math.max(document.documentElement.clientHeight, window.innerHeight || 500));

	// Random animation-delay
	var randomAnimationDelay = Math.floor(Math.random() * 15);
	//console.log(randomAnimationDelay);

	// Random colors
	var colors = ['#0CD977', '#FF1C1C', '#FF93DE', '#5767ED', '#FFC61C', '#8497B0']
	var randomColor = colors[Math.floor(Math.random() * colors.length)];

	// Create confetti piece
	var confetti = document.createElement('div');
	confetti.className = 'sqb-modal-animation-confetti';
	confetti.style.top=randomHeight + 'px';
	confetti.style.right=randomWidth + 'px';
	confetti.style.backgroundColor=randomColor;
	// confetti.style.transform='scale(' + randomScale + ')';
	confetti.style.obacity=randomScale;
	confetti.style.transform='skew(15deg) rotate(' + randomRotation + 'deg)';
	confetti.style.animationDelay=randomAnimationDelay + 's';

	var confettiWrapper = document.getElementById("sqb-modal-animation-confetti-wrapper");
	if(confettiWrapper){
		confettiWrapper.appendChild(confetti);
	}
}
}

var is_animation_running = false;
var fun_animation_main_clone = '';
function sqb_fun_animation_show(sqb_quiz_container_outer_id){

//var timer = 500000;
//var is_outcome_level = 'Y';

if(!is_animation_running){
	is_animation_running = true;
}else{
	return false;
}

if(jQuery('#'+sqb_quiz_container_outer_id+' .quiz_fun_animation_main').length < 1){
	return false;
}

var timer = jQuery('#'+sqb_quiz_container_outer_id+' #game_animation_timer').val();
var is_outcome_level = jQuery('#'+sqb_quiz_container_outer_id+' #game_animation_outcome_level').val();
var template = jQuery('#'+sqb_quiz_container_outer_id+' #game_animation_template').val();
var audio_option = jQuery('#'+sqb_quiz_container_outer_id+' #game_animation_audio_option').val();

jQuery('html').addClass('sqb-celebration-animation-on').addClass('sqb-animation-'+template);

jQuery('#'+sqb_quiz_container_outer_id+' .quiz_fun_animation_main').show();

if(fun_animation_main_clone != ''){
	var fun_animation_main = fun_animation_main_clone;
}else{
	var fun_animation_main = jQuery('#'+sqb_quiz_container_outer_id+' .quiz_fun_animation_main').html();
	fun_animation_main_clone = fun_animation_main;
}

var first_name = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer #first_name').val();

fun_animation_main = fun_animation_main.replaceAll('%%FIRST_NAME%%', first_name);

var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
			
if(sqb_quiz_type == 'scoring' || sqb_quiz_type == 'personality'){
	var sqb_points_ans = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_points_ans').val();
	var total_pt = jQuery('#'+sqb_quiz_container_outer_id+ ' #points_count').val(); 		 
	if(sqb_points_ans =="NaN"	|| sqb_points_ans =="nan" || sqb_points_ans =="NAN"){
		sqb_points_ans =0;
	}
	fun_animation_main = fun_animation_main.replaceAll('%%YOURSCORE%%', sqb_points_ans);
	fun_animation_main = fun_animation_main.replaceAll('%%TOTALSCORE%%', total_pt);
}



//console.log(outcome_id);
var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+' .outcome_div:visible').attr('data-outcome-id');
var outcome_title = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_id_'+outcome_id).find('#outcome_name').val();
fun_animation_main = fun_animation_main.replaceAll('%%OUTCOME_TITLE%%', outcome_title);
jQuery('#'+sqb_quiz_container_outer_id+' .quiz_fun_animation_main').html(fun_animation_main);

if(is_outcome_level == 'Y'){
	var outcome_id = jQuery('#'+sqb_quiz_container_outer_id+' .outcome_div:visible').attr('data-outcome-id');
	jQuery('#'+sqb_quiz_container_outer_id+' #fun-animation-outcome-'+outcome_id).show();
}

if(audio_option == 'Y'){
	  jQuery('#'+sqb_quiz_container_outer_id+' .sqb_player_audio').trigger('click');
}
setTimeout(function(){
	if(audio_option == 'Y'){

		jQuery('#'+sqb_quiz_container_outer_id+' .sqb_player_audio').trigger('click');
	}
	jQuery('html').removeClass('sqb-celebration-animation-on').removeClass('sqb-animation-'+template);
	jQuery('#'+sqb_quiz_container_outer_id+' .quiz_fun_animation_main').hide();
	if(is_outcome_level == 'Y'){
		jQuery('#'+sqb_quiz_container_outer_id+' #fun-animation-outcome').hide();
	}

	is_animation_running = false;
},timer);


}

function ShowCategoryScoreShortcode(co,category_json,cat_ids) {
return co.replaceAll(/\[ShowCategoryScore([^]*?)?\](?:([^]+?)?\[\/ShowCategoryScore\])?/g, function(a,b,c) {               
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

function ShowCategoryScoreHTML(category_json,sqb_quiz_container_outer_id,cat_ids,obj,eachcat_ids){

var cattext = ShowCategoryScoreShortcode(jQuery(obj).html(),category_json,cat_ids);

jQuery(obj).html(cattext);

jQuery(obj).find('.ShowCategoryScore').each(function(){

	var cattextNew = jQuery(this).html(); 
	jQuery.each(eachcat_ids,function(index, value){
		var cat_name = category_json[index];
		var cat_max_val = cat_ids[index];
		var tmp_cat_name = cat_name.replaceAll('&','&amp;');
		cattextNew = cattextNew.replaceAll( "%%YOUR_SCORE_CATEGORY_"+cat_name+"%%",cat_max_val);
		cattextNew = cattextNew.replaceAll( "%%YOUR_SCORE_CATEGORY_"+tmp_cat_name+"%%",cat_max_val);
		cattextNew = cattextNew.replaceAll( "%%TOTAL_SCORE_CATEGORY_"+cat_name+"%%",value);
		cattextNew = cattextNew.replaceAll( "%%TOTAL_SCORE_CATEGORY_"+tmp_cat_name+"%%",value);
	});

	cattextNew = cattextNew.replaceAll( /%%YOUR_SCORE_CATEGORY_[a-zA-Z0-9_ ]{1,}%%/g,'<i>This is a invalid category</i>');
	cattextNew = cattextNew.replaceAll( /%%TOTAL_SCORE_CATEGORY_[a-zA-Z0-9_ ]{1,}%%/g,'<i>This is a invalid category</i>');

	jQuery(this).html(cattextNew);
});
}

jQuery(document).on('click','.sqb-match-box', function () {

if(jQuery(this).children('.sqb-match-item').length > 0){
	var id = jQuery(this).children('.sqb-match-item').attr('data-index');
	var html = jQuery(this).html();
	jQuery(this).html('');
	jQuery(this).closest('.question_type_matching_text').find('#sqb-match-'+id).html(html);
	makedraggable3();
	jQuery(this).droppable( 'enable' );
	var question_wrapper = jQuery(this).closest('.question_type_matching_text');

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

function makedraggable3() {
jQuery(".sqb-match-item").draggable({
  beforeStart: function() {
	
	window.source_index = jQuery(this).attr("data-index");
	
	window.source_html = jQuery(this).html();
  },
  "revert": "invalid"
});
jQuery(".sqb-match-box").droppable({
  "accept": ".sqb-match-item",
  classes: {
	"ui-droppable-active": "ui-state-active",
	"ui-droppable-hover": "ui-state-hover"
  },
  "drop": function(event, ui) {
	window.dest_html = jQuery(this).html();
	window.dest_index = jQuery(this).attr("data-index");
	
	question_wrapper = jQuery(this).closest('.question_type_matching_text');

	if (typeof window.dest_html != 'undefined' && window.dest_html != '') {
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

jQuery(document).ready(function(){
var oldMouseStart = jQuery.ui.draggable.prototype._mouseStart;
jQuery.ui.draggable.prototype._mouseStart = function(event, overrideHandle, noActivation) {
  this._trigger("beforeStart", event, this._uiHash());
  oldMouseStart.apply(this, [event, overrideHandle, noActivation]);
};	
makedraggable3();

});

function calculate_match_points(question_wrapper){
var matched = jQuery(question_wrapper).find('.sqb_ans_item_outer .sqb_input_ans_field .sentence-matched');
var points = 0;
matched.each(function(){
	points = points + parseInt(jQuery(this).attr('data-point'));
});
return points;

}

function isSentenceMatch(question_wrapper){
jQuery(question_wrapper).find('.sqb_input_ans_field .drag-container').each(function(){
	if(jQuery(this).find('.sqb-match-box').attr('data-match') == jQuery(this).find('.sqb-match-box .sqb-match-item').attr('data-match')){
		jQuery(this).find('.sqb-match-box').addClass('sentence-matched').removeClass('sentence-not-matched');
	}else{
		jQuery(this).find('.sqb-match-box').addClass('sentence-not-matched').removeClass('sentence-matched');
	}
});
}
function switchContent(question_wrapper) {	
	
//var source_html = jQuery("<div>").addClass("ui-widget-header").addClass("sqb-match-box").attr("data-index", window.dest_index).append(window.source_html);
//var dest_html = jQuery("<div>").addClass("sqb-match-item").addClass("di1").attr("data-index", window.source_index).append(window.dest_html);
jQuery(question_wrapper).find("[data-index=" + window.dest_index + "]").closest(".drag-container").html(source_html);
jQuery(question_wrapper).find("[data-index=" + window.source_index + "]").closest(".drag-container").html(dest_html);

jQuery(":ui-draggable").draggable("destroy");
makedraggable3();
}

var iti = {};

jQuery(document).ready(function() {
	initPhoneNumberLib();
});

  function initPhoneNumberLib(){
	
	jQuery('body .question_type_phone_number').each(function(){
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

		  jQuery('body #'+question_id+' .international-phone-number').on("countrychange", function(event) {
			
			
			var question_id = jQuery(this).closest('.question_type_phone_number').attr('data-question-id');
			
			var selectedCountryData = iti[q_id].getSelectedCountryData();
			
			newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
		
			iti[q_id].setNumber("");
			mask = newPlaceholder.replace(/[1-9]/g, "0");
			jQuery(this).mask(mask);
			jQuery(this).attr('placeholder',newPlaceholder);
		   });
		 
		   iti[q_id].promise.then(function() {
			   jQuery('body #'+question_id+' .international-phone-number').trigger("countrychange");
		   });
	});
  }

  function getHeightWeightValues($this,isarray = true){

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
  function removeTags(str) {
    if ((str===null) || (str===''))
        return false;
    else
        str = str.toString();
        
    return str.replace( /(<([^>]+)>)/ig, '');
}

function getSelectedAnswer(ques_id,answer_id,sqb_quiz_container_outer_id){
	var fill_in_blank_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
		var text_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('text_cls'); 
		var date_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('date_cls'); 
		var slider_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('slider_cls'); 
		var matching_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matching_text'); 
		var file_upload_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls');
		var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
		var dropdown_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('dropdown_cls');
		var phone_number_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('phone_number_text_cls');
		var weight_and_height_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('weight_and_height_cls');
		if(fill_in_blank_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_fill_in_blank_ans_field").val();						
		}else if(text_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_textarea_ans_field").val();	
			
		}else if(date_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .date-question-type").val();	
		}else if(phone_number_text_cls == true){
			var country_code =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".iti__country.iti__active .iti__dial-code").html();
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
			if(answer_text != ''){
				answer_text =  country_code+' '+answer_text;
			}else{
				answer_text = '';
			}
		}else if(matching_text == true){
			var html = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find('.sqb_input_ans_field').html();
			var answer_text = html;	
			answer_type = 'matching_text';
			answer_points_scored = calculate_match_points(jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id));
		}else if(slider_cls ==true){
			var slider_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").val();
			var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('prefix_text');	
			var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('suffix_text');	
			var answer_text = prefix_text+' '+slider_value+' '+suffix_text;	
		}else if(numeric_text_cls == true){
			var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_prefix").text();	
			var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".numeric_value_sufix").text();	
			var numeric_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_and_field").val();
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
			var answer_text =  getHeightWeightValues(jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id),false);
		}else if(file_upload_cls == true){
			var fileURl =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".sqb_file_upload").data('fileurl');
			var answer_text = fileURl;
		}else if(dropdown_cls == true){
			var selected_answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected .sqb_question_dropdown").val();
			var answer_text = selected_answer_text.split('_').join(' ');
		}else{
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected .sql_ans_text").text();
			var multiple_or_single =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).hasClass('multiple_correct_cls');
			 if(multiple_or_single){
				 answer_type ="multiple";
				  var answer_points_scored_new  = 0;
				  var answer_tags_new = '';
				  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_and_field.checkbox_fe").each(function(){
						if(jQuery(this).prop('checked')){
							 var answer_tags_new = jQuery(this).closest('.multiple_correct_checkbox').attr('data-answer-tags');
							
							 answer_tags = answer_tags+answer_tags_new+',';
							 
							 var answer_points_scored_new = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
							 answer_points_scored = parseInt(answer_points_scored) + parseInt(answer_points_scored_new);
						}
				  });
				 
				 
			 }else{
				 answer_type = 'single';
				 answer_tags = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-tags');
				 //other_field = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find('.custom-other-box').val();

				 if(answer_id == jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-answer-id')){
				 	other_field = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+".question_type_single").find('.custom-other-box').val();
				 }else{
				 	other_field = '';
				 }
				 answer_points_scored = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_selected").attr('data-point');
				 
			 }
		}
	return answer_text;
}
