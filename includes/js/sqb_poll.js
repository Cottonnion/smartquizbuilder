
jQuery(document).ready(function(){

	jQuery('.sqb_quiz_container_outer').each(function(){

		var sqb_quiz_container_outer_id = jQuery(this).attr('id');
		var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();

		if(sqb_quiz_type == 'poll'){
		renderPollResults(sqb_quiz_container_outer_id);

			/*var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_ajaxurl').val();
			var quizId = jQuery('#'+sqb_quiz_container_outer_id+ ' #quizId').val();	

			jQuery.ajax({
				url: ajaxurl,	 
				type: "POST",
				//	async: true,
				//async: false,
				data: {
					action: 'sqb_vote_results',
					quiz_id : quizId
				},
				success: function (response) {

					response = JSON.parse(response); 

					if(response.is_votes > 0){
					   // setResultScreen(sqb_quiz_container_outer_id,response.counts);
					}
				}	
			});*/
		}
	});
});

function renderPollResults(sqb_quiz_container_outer_id) {
	
	//jQuery('.sqb_quiz_container_outer').each(function(){

	var json = jQuery('#'+sqb_quiz_container_outer_id+' .js-vote-list').val();
	var is_voted = jQuery('#'+sqb_quiz_container_outer_id+' .js-is-vote').val();
	var thankyou = jQuery('#'+sqb_quiz_container_outer_id+' .js-thankyou').val();
	var data = JSON.parse(decodeURIComponent(json).replace(/\+/g, " "));

	if(is_voted > 0){	
	    setResultScreen(sqb_quiz_container_outer_id,data,thankyou);
	}

	//console.log(data);
}

function setResultScreen(sqb_quiz_container_outer_id, rows, thankyou='') {

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

function setQuestionScreen(sqb_quiz_container_outer_id){
	jQuery('#'+sqb_quiz_container_outer_id+' .quiz_type_poll .poll-quiz-main').removeClass('quiz_poll_results');
	//jQuery('#'+sqb_quiz_container_outer_id+' .qa-listing-result-data').remove();
	jQuery('#'+sqb_quiz_container_outer_id+' .vote-data-element').remove();
}

function sqbSubmitVote(sqb_quiz_container_outer_id, first_name , email , btn_click, continue_btn_text=''){

	//console.log('regiser_call');

	if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
	}else{
		jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
	}

	jQuery('.sqb_custom_field_required_class').hide();
	var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ "  input[type='hidden'][id='quiz_id']").val();
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();	
	
	
	if(btn_click =="no"){
		//check if Retake need to show on not for non-lesson
		var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();		 
		if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){	
			//for non-lesson context
			setSQBCookieForRetake(sqb_quiz_container_outer_id);			 
		}
	}
	 

	var register_way = jQuery('#'+sqb_quiz_container_outer_id+ ' #register_way').val();	
	var productId = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #productId').val();	
	var ajaxurl = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_ajaxurl').val();	
	var optin_redirect = jQuery('#'+sqb_quiz_container_outer_id+ ' #optin_redirect').val();	
	var optin_redirect_url = jQuery('#'+sqb_quiz_container_outer_id+ ' #optin_redirect_url').val();	
	var quizId = jQuery('#'+sqb_quiz_container_outer_id+ ' #quizId').val();	
	var productId = jQuery('#'+sqb_quiz_container_outer_id+ ' #productId').val();			
	var outcome_final = jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val();		
	var email_empty_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #email_empty_msg').val();			
	var valid_email = jQuery('#'+sqb_quiz_container_outer_id+ ' #valid_email').val();			
	var username_empty_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #username_empty_msg').val();			
	var terms_condition_msg = jQuery('#'+sqb_quiz_container_outer_id+ ' #terms_condition_msg').val();			
	var terms_condition_req = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #sqbcheckbox').hasClass('required');	
	var first_name_visi = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #first_name').css('display');
	var terms_cond_visi = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup .sqb-checkbox').css('display');
	var valid_email = jQuery('#valid_email').val();
	var register_way = jQuery('#'+sqb_quiz_container_outer_id+ ' #register_way').val();	
	var signup_way = jQuery('#'+sqb_quiz_container_outer_id+ ' #signup_way').val();	
	var ori_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder  .Quiz-Optin-Template  .continue_btn').html();
	var third_party_from_enabled = jQuery("#"+sqb_quiz_container_outer_id+ " #third_party_from_enabled").val();
	var optin_name = jQuery("#"+sqb_quiz_container_outer_id+ " #optin_name").val();
	var optin_email = jQuery("#"+sqb_quiz_container_outer_id+ " #optin_email").val();
	var sqb_required_field = jQuery("#sqb_required_field").val();
	var sqb_gdpr_required_field = jQuery("#sqb_gdpr_required_field").val();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .sqbwarning_div').remove();
		

	//GDPR

	var gdpr_value = jQuery('#gdpr_compliance').val();

 	if(gdpr_value == 1){
 		var gdpr_condition_req = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #sqbgdprcheckbox').hasClass('required');

 		var gdpr_cond_visi = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup .sqb-gdpr-checkbox').css('display');
 	}

	//validations starts
	var inputBlankFound= false;	 
	if(third_party_from_enabled =="Y"){
		jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form input, #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form textarea,  #'+sqb_quiz_container_outer_id+ ' .Quiz-Template-content form select').each(function(){			
				var field_val = jQuery(this).val();	
				var field_name = jQuery(this).attr("name");	
				var field_type = jQuery(this).attr("type");	
				
				if(field_type == 'checkbox'){
					//console.log(jQuery(this).prop('checked'));
				}
				
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
		 

		// commented third-party form selector
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
	 		
	}else{ //not third party
		

		var firstname_temp = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_first_name').val();		
		if(first_name ==""){
			var first_name = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #first_name').val();	
		} else{
			var terms_condition_req = false;
		}
		if(email ==""){		
			var email = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_direct_signup #email').val();		
		} else{		
			var terms_condition_req = false;
		}
		
		 
		if(first_name == "" && first_name_visi != 'none'){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+username_empty_msg+'</b></div>'); 
			return false;
		}	
		if(email == ""){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+email_empty_msg+'</b></div>'); 
			return false;
		} 
		if(!sqbValidateEmail(email)){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+valid_email+'</b></div>'); 
			return false;
		} 
		if(terms_condition_req == true && terms_cond_visi != 'none' && jQuery('#'+sqb_quiz_container_outer_id+ ' #sqbcheckbox').prop('checked') !=  true){
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+terms_condition_msg+'</b></div>'); 
			return false;
		} 
		var returnFalse = false;
		jQuery('.custom_add_fields').each(function(){
			
			if(jQuery(this).hasClass('required') == true && jQuery(this).find('input[type=text], textarea').val() == '' && jQuery(this).is(':visible')){
				//jQuery(this).before('<div class="sqbwarning_div"><b>'+terms_condition_msg+'</b></div>');
				var required_message_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_required_field').val();
				if(required_message_text == ''){
				required_message_text = 'Required field cannot be empty.';
				}
				jQuery(this).find('.sqb_custom_field_required_class').show().text(required_message_text); 
				returnFalse = true;		
			}
			if((jQuery(this).find('input[type=radio]').length > 0)){
			if(jQuery(this).find('input[type=radio]').is(':checked') == false){
				
				var required_message_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_required_field').val();
				if(required_message_text == ''){
					required_message_text = 'Required field cannot be empty.';
				}
				jQuery(this).find('.sqb_custom_field_required_class').show().text(required_message_text); 
				returnFalse = true;		
				
			 }
		 }

			if(jQuery(this).hasClass('required') == true && jQuery(this).find('input[type=checkbox]').is(':checked') == false){
				if(jQuery(this).find('input[type=checkbox]').length > 0){
					if(jQuery(this).find('input[type=checkbox]').is(':checked') == false){
						var required_message_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_required_field').val();
						if(required_message_text == ''){
							required_message_text = 'Required field cannot be empty.';
						}
						jQuery(this).find('.sqb_custom_field_required_class').show().text(required_message_text); 
						returnFalse = true;		
					}
				}
			}
		});

		if(returnFalse == true){
			return false;	
		}

		if(jQuery('#'+sqb_quiz_container_outer_id+' .skip_optin').is(":visible")){
		 returnFalse = false;
		}
		
		

		var gdpr_value = jQuery('#gdpr_compliance').val();
		var gdpr_required = '';
	 	if(gdpr_value == 1){
	 		if(gdpr_condition_req == true && gdpr_cond_visi != 'none' && jQuery('#'+sqb_quiz_container_outer_id+ ' #sqbgdprcheckbox').prop('checked') !=  true){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .form_cls').before('<div class="sqbwarning_div"><b>'+sqb_gdpr_required_field+'</b></div>'); 
				return false;
			}else{
				if(jQuery("#sqbgdprcheckbox").hasClass('required') || jQuery('#'+sqb_quiz_container_outer_id+ ' #sqbgdprcheckbox').prop('checked') ==  true){
					var gdpr_required = 'Y';
				}else{
					var gdpr_required = 'N';
				}
			}
	 	} 

	} 	 
	
	jQuery('#'+sqb_quiz_container_outer_id+ ' .close_Side_Popup').css("pointer-events","none");
	
	var ori_text = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder  .Quiz-Optin-Template  .continue_btn').html();


	var show_analyzing_result = jQuery("#"+sqb_quiz_container_outer_id+ " #show_analyzing_result").val();
 

	jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

	
	//return false;
	var show_analyzing_result_time = jQuery('#show_analyzing_time_delay').val();
	var register_way = "WP";
	
	
	//added for the  user for webhook starts
	var points_scored = 0;
	var	total_points = 0 ;
	var ques_count = jQuery("#"+sqb_quiz_container_outer_id+ "  #ques_count").val(); 
	var sqb_correct_ans = jQuery("#"+sqb_quiz_container_outer_id+ "  #sqb_correct_ans").val(); 
	var points_count = jQuery("#"+sqb_quiz_container_outer_id+ "  #points_count").val(); 
	var sqb_points_ans = jQuery("#"+sqb_quiz_container_outer_id+ "  #sqb_points_ans").val(); 
	var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ "  #sqb_quiz_type").val(); 
	if(sqb_quiz_type =="scoring"){
		points_scored = sqb_points_ans;
		total_points = points_count;
	}else{
		points_scored = sqb_correct_ans;
		total_points = ques_count;
	}
	var sqb_question_answer_array = [];
	var answer_type = '';   
	var answer_tags = ''; 
	var other_field = ''; 
	var answer_points_scored = 0; 
	jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_question_answer_hidden').each(function(){
		other_field = '';
		answer_tags = '';
		answer_points_scored = 0;
		var ques_id = jQuery(this).data('id');	
		var answer_id = jQuery(this).data('key'); 	
		var correct_ans = jQuery(this).data('correct');	
		
		var matrix_cls = false;
		var answer_type = '';  
		var fill_in_blank_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('fill_in_blank_cls'); 
		var text_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('text_cls'); 
		var date_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('date_cls'); 
		var slider_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('slider_cls'); 
		var file_upload_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('file_upload_cls');
		var matrix_cls =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('matrix_cls');
		var numeric_text_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('numeric_text_cls');
		var dropdown_cls = jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_ans_item_outer").hasClass('dropdown_cls');
		
		if(fill_in_blank_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_fill_in_blank_ans_field").val();						
		}else if(text_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .sqb_textarea_ans_field").val();	
		}else if(date_cls ==true){
			var answer_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id+" .date-question-type").val();
			var answer_type = 'date';
		}else if(file_upload_cls == true){
			var fileURl =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".file_upload_cls").attr('data-fileurl');
			var answer_text = fileURl;
		}else if(slider_cls == true){
			var prefix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('prefix_text');	
			var suffix_text =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").attr('suffix_text');	
			var slider_value =  jQuery("#"+sqb_quiz_container_outer_id+ "  #question_id_"+ques_id).find(".slider.sqb_ans_slider").val();
			var answer_text = prefix_text+' '+slider_value+' '+suffix_text;
		}else if(matrix_cls == true){
			answer_type = 'matrix';
		}else if(numeric_text_cls == true){
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
 	var social_share_screen_value = jQuery('#'+sqb_quiz_container_outer_id+ ' #social_share_screen_value').val();  
	  

 	 setTimeout(function() {
		if(btn_click =="no"){
		} else{
			//redirect calculations	
			sqb_apply_wid_css_popup("result", sqb_quiz_container_outer_id); 
			// temp hide
			console.log('outcome redirect');
			//outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);  

			//check if Retake need to show on not for non-lesson
			var lesson_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #lesson_id').val();		 
			if(lesson_id ==null || lesson_id =="" || typeof lesson_id =="undefined"){	
				//for non-lesson context
				setSQBCookieForRetake(sqb_quiz_container_outer_id);			 
			}
			 
		}	
		if(continue_btn_text !=""){				
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(continue_btn_text);
		}else{
			jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(ori_text);
		}
		//redirect calculations	
		//outcomeRedirectCall(sqb_quiz_container_outer_id); // it comment because of it redirect the page without store data of user in database.			 		 
	}, 1000); 
	
	
	var sqb_quiz_category_enable = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="sqb_quiz_category_enable"]').val(); 
	if(jQuery('#'+sqb_quiz_container_outer_id+ ' .category_number_percent_co').html() !=""){		
		jQuery('#'+sqb_quiz_container_outer_id+ ' .category_number_percent_co .cat-details-row').sort(sort_catgory_name).appendTo('#'+sqb_quiz_container_outer_id+ ' .category_number_percent_co');  
	}
	var category_result_list_array = '';
	var catdata = '';	 
	var category_number_div= '';
	var category_number_percent= '';
	if(sqb_quiz_category_enable == 'Y'){
		 category_result_list_json = jQuery('#'+sqb_quiz_container_outer_id).find('input[name="category_result_list_json"]').val();  
		 if(category_result_list_json != ''){ 
			category_result_list_array = JSON.parse(category_result_list_json);
		 }
	
		var outcomeid = jQuery('#'+sqb_quiz_container_outer_id+ ' .outcome_div').first().attr('id');		
		var catdata = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .sqb_category_overall').html();
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_percent .cat-details-total').remove();
		jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_div .cat-details-total').remove();
		//var category_number_percent	 = jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_percent').html();
		var category_number_percent	 = jQuery('#'+sqb_quiz_container_outer_id+ '  .category_number_percent_co').html();
		var category_number_div= jQuery('#'+sqb_quiz_container_outer_id+ ' #'+outcomeid+' .category_number_div').html();
	}
	 
	var outcome_final=  jQuery('#'+sqb_quiz_container_outer_id+ ' #outcome_final').val();
	var outcome_desc_old =  jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer #outcome_id_'+outcome_final+' #result_temp_contentid').html();
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden').html(outcome_desc_old);
	jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden img').each(function(){
			jQuery(this).remove() ;
	});
	var outcome_desc = jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_hidden').html();
		//added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}
	
	var optin_position = jQuery('#'+sqb_quiz_container_outer_id+' #sqb_opt_screen_position').val();
	if(optin_position == 'optin-before-questions-screen'){
		jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_optin_template_outer').removeClass('hide_cls').addClass('show_cls');
		var optin_form_fields = jQuery('#'+sqb_quiz_container_outer_id).find("#sqb_direct_signup").find(":input:not(:hidden)").serialize();
		jQuery('#'+sqb_quiz_container_outer_id).find('.quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
	} else {
		var optin_form_fields = jQuery('#'+sqb_quiz_container_outer_id).find("#sqb_direct_signup").find(":input:not(:hidden)").serialize();
	}
	
	var sqb_custom_fields_array = [];
	jQuery('#'+sqb_quiz_container_outer_id).find('#sqb_direct_signup').find( "[id^='custom_']" ).each(function(){
            var field_name = jQuery(this).attr('id').replace('custom_','');
			sqb_custom_fields_array.push({field_name:field_name,field_value:jQuery(this).val()});
	});
	
	var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
	var double_optin  = jQuery('#'+sqb_quiz_container_outer_id).find("#double_optin").val();
	var nounce = jQuery('#'+sqb_quiz_container_outer_id).find('#sqb_nounce').val();

	//save load
	var how_many_answed = jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb_ans_selected').length;
	var lead_type = 'lead_optin_btn_click';

	var show_retake = jQuery('#'+sqb_quiz_container_outer_id+ ' #allow_retake').val();
	var total_attempts = jQuery('#'+sqb_quiz_container_outer_id+ ' #leads_total_attempts').val();
	var quiz_type = jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();


	console.log('regiser_ajax_call');

	//return false;

		//register   user ajax  
		jQuery.ajax({
			url: ajaxurl,	 
			type: "POST",
			//	async: true,
			//async: false,
			data: {
				action: 'SQBSubmitVote',
				is_poll : 1,
				nounce : nounce,
				//form_data : form_data
				first_name: first_name,
				firstname_temp: firstname_temp,
				email: email ,		 
				register_way: register_way ,		 
				productId: productId ,	
				signup_way: signup_way ,	
				quizId: quizId ,	
				sqb_quiz_type: sqb_quiz_type,
				outcome_final: outcome_final ,	
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

				// Save lead
				how_many_answed : how_many_answed,
				lead_type : lead_type,
				total_attempts : 0,
				course_id: '',
				lesson_id: '',
				page_id : '',
				show_retake:'N',
				quiz_type: sqb_quiz_type,
				total_attempts : total_attempts,
				points_scored : 0,
				total_points : 0,
				time_spent : 0,
				quiz_id: quizId ,
				platform : 'WP'

			},
			success: function (response) {


				 
				//response = JSON.parse(response);
				 
				//console.log(response);

				//jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val(response.user_id);
				//jQuery('#'+sqb_quiz_container_outer_id+ ' #platform').val(register_way);

				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
		  		}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
		  		}

		  		response1 = JSON.parse(response); 

				if(response1.status == "ok"){
						
					//save the data in sqb_users table
					//sqbSaveUser(ori_text, sqb_quiz_container_outer_id);
					// save report info
					var sqb_quiz_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='quiz_id']").val();
					var sqb_quiz_current_page_id = jQuery("#"+sqb_quiz_container_outer_id+ " input[type='hidden'][id='sqb_quiz_current_page_id']").val();
					
					// Commented on Poll only
					//sqb_report_save(sqb_quiz_id,sqb_quiz_current_page_id,'quiz_opt_in_btn_click');
					
					// save lead info
					var user_id = jQuery('#'+sqb_quiz_container_outer_id+ ' #user_id').val();
					var how_many_answed = 0;	
					var getshowRetakeAndCookie = checkifsetSQBCookieForRetake(sqb_quiz_container_outer_id);
					var getRetakeAndCookie = getshowRetakeAndCookie.split("||");
					var showRetake = getRetakeAndCookie[0];
					var show_outcome_again ="";
					if(showRetake =='true'){
						show_outcome_again ="N";
					}


					sqb_send_email_notifications(first_name ,email ,register_way ,productId ,signup_way,quizId ,sqb_quiz_type ,	outcome_final,sqb_question_answer_array ,outcome_ids_array,	outcome_desc,gdpr_required,	category_result_list_array, optin_form_fields ,	sqb_custom_fields_array ,catdata ,category_number_percent ,category_number_div ,show_optin,double_optin,firstname_temp);


					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').hide();
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').html('');
					
					var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();

				  	/* Poll T */
				  	if(is_outcome_redirect != 'Y'){
	
						
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

						//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').after('<div class="question_add_answer_outer_div-result">'+html+'</div>');
						//jQuery('#'+sqb_quiz_container_outer_id+ ' .question_add_answer_outer_div').addClass('hide_cls').removeClass('show_cls');

						setResultScreen(sqb_quiz_container_outer_id,response1.counts,response1.thankyou);
						

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

						//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');

						show_poll_outcome(sqb_quiz_container_outer_id);

						/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').removeClass('is-loading');
				  		}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').removeClass('is-loading');
				  		}*/
				  		//setTimeout(function() {
							outcomeRedirectCall(sqb_quiz_container_outer_id, show_outcome_again);
						//},5000);
						//console.log(response1);
						poll_chart(sqb_quiz_container_outer_id,response1.chart_data);
						
					}

                    
					//sqb_lead_save_poll(user_id,how_many_answed, 'lead_optin_btn_click', sqb_quiz_container_outer_id,'','',show_outcome_again,gdpr_required, first_name,optin_form_fields);
					//send email notification and send data in external system
					//sqb_send_email_notifications(first_name ,email ,register_way ,productId ,signup_way,quizId ,sqb_quiz_type ,	outcome_final,sqb_question_answer_array ,outcome_ids_array,	outcome_desc,gdpr_required,	category_result_list_array, optin_form_fields ,	sqb_custom_fields_array ,catdata ,category_number_percent ,category_number_div ,show_optin,double_optin,firstname_temp);
				}else{

					// show error message
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').show();
					jQuery('#'+sqb_quiz_container_outer_id+ ' .sqb-vote-error').html(response.message);

				}
				
				if(continue_btn_text !=""){				
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(continue_btn_text);
				}else{
					jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder .Quiz-Optin-Template .continue_btn').html(ori_text);
				}
				
				if(social_share_screen_value == 'Y'){
				showSocialShareCall(sqb_quiz_container_outer_id);
				}				
				//redirect calculations	
				//outcomeRedirectCall(sqb_quiz_container_outer_id);
				
			}
		});
		// }, show_analyzing_result_time+'000');
	
}


function show_optin_form_poll(sqb_quiz_container_outer_id) {
		
	console.log('optin-form-poll');
	 var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
	 var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	 if(show_optin =="N"){ 	

	 	var show_analyzing_result_time = jQuery("#"+sqb_quiz_container_outer_id+ "  #show_analyzing_time_delay").val();
	 	 
		
		//setTimeout(function(){ 
	 
		//setTimeout(function() {
			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
			var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
			/*if(quiz_slider_animation =="Y")	{	
				
				 setTimeout(function() {
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls done_question').removeClass('show_cls');
					
				}, 500); 
			}else{
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');					
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls done_question').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
				}
			}*/
	
			// jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');		
			
			var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();

			/*if(sqb_quiz_type == 'poll'){

				var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();
				
				if(is_outcome_redirect != 'Y'){
					// Add Poll condition
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');		
					// End	
				}else{
					outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);
				}
			}*/
				
			jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();   
			 //redirect calculations	
			
			var site_url = jQuery("#"+sqb_quiz_container_outer_id+ " #get_site_url").val();  
			var email =  "sqbguest@"+site_url;
			// register guest user		
			if(sqb_quiz_type == 'poll'){
				sqbSubmitVote(sqb_quiz_container_outer_id, "SQBGuest", email, 'no');
			}else{
				sqbRegisterUser(sqb_quiz_container_outer_id, "SQBGuest", email, 'no');
			}
			/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all'){
				jQuery('html, body').animate({
				   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').offset().top - 120
				}, "slow");
			}*/
			
			 
		//}, 900); 

		//}, show_analyzing_result_time+'000');
		 /* var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}	*/
		 
		//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer', sqb_quiz_container_outer_id); 
		
		 		
	 }else{
			
		var firstname = sqbgetUrlVars()["firstname"];
		if(firstname == null){
	 		var firstname = sqbgetUrlVars()["first_name"];
	 	}
		var email = sqbgetUrlVars()["email"];
		
		if(firstname != undefined || email != undefined){
			if(jQuery('.sqb_first_name').val() != undefined ){

			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#first_name').val(firstname);
			}
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#email').val(email);
		}else {
	  		var dap_login_email_id = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_email_id').val();
			if(dap_login_email_id != undefined){
				var dap_login_first_name = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_first_name').val();
				if(dap_login_first_name != ''){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#first_name').val(dap_login_first_name);

					jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
						var html = jQuery(this).html();
						jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
					});	
				}

				if(dap_login_email_id != ''){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#email').val(dap_login_email_id);
				}
			}		 
	 	}
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');
		 setTimeout(function() {
			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
			var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
			if(quiz_slider_animation =="Y")	{				
				 setTimeout(function() {
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					// jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').hide();
					
				}, 500);  
			}else{
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').hide();
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
				}
			}
			
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen'){
				setTimeout(function() {
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');
				}, 1000);  
				jQuery('#'+sqb_quiz_container_outer_id+' #quiz_attempted').val('Y');
				jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .continue_btn').trigger('click');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('show_cls').removeClass('hide_cls');
				//show_analyzing_result_screen(sqb_quiz_container_outer_id) ;
				
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');	

				var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
				if(sqb_quiz_type == 'poll'){
					
					// Add Poll condition
					//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');	
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
				  		}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
				  		}
					// End	
				}


				jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();  
				 sqb_apply_wid_css_popup("optin", sqb_quiz_container_outer_id);				
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');
				var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
				if(quiz_pagination == 'all'){
				jQuery('html, body').animate({
					   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').offset().top - 120
					}, "slow");
				}
			}
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all'){
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){
					jQuery('html, body').animate({
					   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').offset().top - 100
					}, "slow");
				}
			}else{
				
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #move_question').val() == 'Y'){
						
						if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){ 
							
						}else{	
							quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
						} 	
						/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y'){ 	
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() != 'tb'){ 	
								quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
							}
						}*/
					}
				}
			}

			var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}
			
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() == 'template7'){
			var template_width = '90%';
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",template_width); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",template_width);
			}
						
		}, 500); 		
		
	 }
}

function show_poll_outcome(sqb_quiz_container_outer_id){
	console.log('optin-form-poll');
	 var show_optin = jQuery("#"+sqb_quiz_container_outer_id+ " #show_optin").val();
	 var sqb_quiz_type = jQuery("#"+sqb_quiz_container_outer_id+ " #sqb_quiz_type").val();
	 if(show_optin =="N"){ 	

	 	var show_analyzing_result_time = jQuery("#"+sqb_quiz_container_outer_id+ "  #show_analyzing_time_delay").val();
	 	 
		
		//setTimeout(function(){ 
	 
		setTimeout(function() {
			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
			var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
			if(quiz_slider_animation =="Y")	{	
				
				 setTimeout(function() {
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls done_question').removeClass('show_cls');
					
				}, 500); 
			}else{
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');					
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls done_question').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
				}
			}
	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');		
			
			var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();

			if(sqb_quiz_type == 'poll'){

				var is_outcome_redirect =   jQuery('#'+sqb_quiz_container_outer_id+ ' input#poll_redirect').val();
				
				if(is_outcome_redirect != 'Y'){
					// Add Poll condition
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');		
					// End	
				}else{
					outcomeRedirectCallBeforeReister(sqb_quiz_container_outer_id);
				}
			}
				
			jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();   
			 //redirect calculations	
			
			var site_url = jQuery("#"+sqb_quiz_container_outer_id+ " #get_site_url").val();  
			var email =  "sqbguest@"+site_url;
			// register guest user		
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all'){
				jQuery('html, body').animate({
				   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer').offset().top - 120
				}, "slow");
			}
			
			 
		}, 900); 

		//}, show_analyzing_result_time+'000');
		  var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_result_template_outer  .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}	
		 
		//quizScrollToDivCenter('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer', sqb_quiz_container_outer_id); 
		
		 		
	 }else{
			
		var firstname = sqbgetUrlVars()["firstname"];
		if(firstname == null){
	 		var firstname = sqbgetUrlVars()["first_name"];
	 	}
		var email = sqbgetUrlVars()["email"];
		
		if(firstname != undefined || email != undefined){
			if(jQuery('.sqb_first_name').val() != undefined ){

			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#first_name').val(firstname);
			}
			jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#email').val(email);
		}else {
	  		var dap_login_email_id = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_email_id').val();
			if(dap_login_email_id != undefined){
				var dap_login_first_name = jQuery('#'+sqb_quiz_container_outer_id).find('#dap_login_first_name').val();
				if(dap_login_first_name != ''){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#first_name').val(dap_login_first_name);

					jQuery('.quiz_start_template_outer .start_temp_outer').each(function(){
						var html = jQuery(this).html();
						jQuery(this).html(html.replaceAll('%%FIRST%%', dap_login_first_name));
					});	
				}

				if(dap_login_email_id != ''){
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').find('#email').val(dap_login_email_id);
				}
			}		 
	 	}
		//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');
		 //setTimeout(function() {
			var quiz_temp_id = jQuery(this).closest('.Quiz-Template').attr('id'); 
			var quiz_slider_animation = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation' ).val();
			if(quiz_slider_animation =="Y")	{				
				 setTimeout(function() {
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
					// jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
					 jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls').removeClass('show_cls');
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').hide();
					
				}, 500);  
			}else{
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() != 'all'){
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).addClass('hide_cls done_question').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .question_container').addClass('hide_cls').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer').hide();
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer #'+quiz_temp_id ).next().addClass('show_cls').removeClass('hide_cls');
				}
			}
			
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() == 'optin-before-questions-screen'){
				setTimeout(function() {
					jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');
				}, 1000);  
				jQuery('#'+sqb_quiz_container_outer_id+' #quiz_attempted').val('Y');
				jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('show_cls').removeClass('hide_cls');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer .continue_btn').trigger('click');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
				//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('show_cls').removeClass('hide_cls');
				//show_analyzing_result_screen(sqb_quiz_container_outer_id) ;
				
			}else{
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('hide_cls done_screen').removeClass('show_cls');	

				var sqb_quiz_type =jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_type').val();
				if(sqb_quiz_type == 'poll'){
					
					// Add Poll condition
					//jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_quesans_template_outer ').addClass('show_cls').removeClass('hide_cls');	
					/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #template_num').val() == 'template8'){
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template .poll-quiz-main').addClass('is-loading');
				  		}else{
							jQuery('#'+sqb_quiz_container_outer_id+ ' .Quiz-Template').addClass('is-loading');
				  		}*/
					// End	
				}


				jQuery("#"+sqb_quiz_container_outer_id+ " .spinner").remove();  
				 sqb_apply_wid_css_popup("optin", sqb_quiz_container_outer_id);	
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').addClass('hide_cls').removeClass('show_cls');
				jQuery('#'+sqb_quiz_container_outer_id+ ' .quiz_result_template_outer ').addClass('hide_cls').removeClass('show_cls');
				var quiz_pagination = jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val();
				if(quiz_pagination == 'all'){
				jQuery('html, body').animate({
					   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').offset().top - 120
					}, "slow");
				}
			}
			
			if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_pagination').val() == 'all'){
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){
					jQuery('html, body').animate({
					   scrollTop: jQuery( '#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer').offset().top - 100
					}, "slow");
				}
			}else{
				
				if(jQuery('#'+sqb_quiz_container_outer_id+ ' #sqb_opt_screen_position').val() != 'optin-before-questions-screen'){
					if(jQuery('#'+sqb_quiz_container_outer_id+ ' #move_question').val() == 'Y'){
						
						if((jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y') && (jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() == 'tb')){ 
							
						}else{	
							quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
						} 	
						/*if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation').val() == 'Y'){ 	
							if(jQuery('#'+sqb_quiz_container_outer_id+ ' #quiz_slider_animation_option').val() != 'tb'){ 	
								quizScrollToDivTop('#'+sqb_quiz_container_outer_id+ ' .quiz_optin_template_outer');
							}
						}*/
					}
				}
			}

			var temp_wid2 = jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .quiz_comon_template ").css("max-width");
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() != 'template6'){		
			jQuery("#"+sqb_quiz_container_outer_id+ " .quiz_optin_template_outer .Quiz-Template.show_cls").css("max-width",temp_wid2);	
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",temp_wid2); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",temp_wid2);
			}
			
			if(jQuery("#"+sqb_quiz_container_outer_id+ " #template_num").val() == 'template7'){
			var template_width = '90%';
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("max-width",template_width); 
			jQuery('#'+sqb_quiz_container_outer_id+ ' .modal_pop_inn').css("width",template_width);
			}
						
		//}, 500); 		
		
	 }
}

function sqb_save_question_answer_report_poll(quiz_id = 0,question_id = 0, answer_id = 0, outcome_id = 0, sqb_quiz_container_outer_id = '',only_question = '',answered='',other_field = ''){
	 //added for the backend preview	
	var SQBPreview = jQuery('#SQBPreview').val();
	if(SQBPreview =="Y"){
		return false;
	}
	
	 //if all questions show
	if((answer_id == 0) && (only_question == '')){
		if(sqb_quiz_container_outer_id != '' && jQuery('#'+sqb_quiz_container_outer_id).find('#lesson_id').val() != ''){
			return false;
		}
	} 
	
	//if quiz already given
	
	if(sqb_quiz_container_outer_id != '' && jQuery('#'+sqb_quiz_container_outer_id).find('#already_given_quiz_status').val() == 1){
		return false;
	}
	if(answer_id != 0){ 	
		jQuery('<input />').attr('type', 'hidden').attr('class', "sqb_question_answer_hidden").attr('data-id', question_id).attr('data-key', answer_id).attr('data-correct', 'N').appendTo('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder');
	}
	var sqb_save_report = jQuery('#sqb_save_report').val();
	if(sqb_save_report =="n"){
	}else{	
		/*var ajaxurl = jQuery('#sqb_ajaxurl').val();	
		jQuery.post(ajaxurl, {
				action: 'sqb_save_question_answer_report',
				quiz_id: quiz_id,
				question_id: question_id,
				answer_id: answer_id,
				other_field: other_field,
				outcome_id: outcome_id,
				answered: answered,
				async: true,
		
		}, function(response) {
			if(answer_id != 0){ 
			
				jQuery('<input />').attr('type', 'hidden').attr('class', "sqb_question_answer_hidden_report").attr('data-id', question_id).attr('data-key', answer_id).attr('data-correct', 'N').appendTo('#'+sqb_quiz_container_outer_id+ ' #sqb_quiz_builder');
			} 
			
			response = JSON.parse(response);
			if(response.returndata){
				var returndata = response.returndata;
				var event_name = returndata.event_name;	
				var event_name_new = returndata.event_name_new;	
				var tag = returndata.tag;	
				var value = returndata.value;	
				var action_name = returndata.action_name;	
				var tags = returndata.tags;	
				  fbq('track', event_name, {
					content_name: event_name, 
					content_ids: tags,
					content_type: action_name,
					value: value
				  });       
			}

		});	*/	
	}	
}