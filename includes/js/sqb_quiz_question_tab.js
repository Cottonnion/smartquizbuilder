jQuery(document).ready(function(){
	if (jQuery('#vote_btn_width').length) {
		sqb_vote_button_customizer();
	}

	jQuery(document).on('click','input[name="sqb_skip_question"]',function(){
		if(jQuery(this).prop('checked') == false){
			if(jQuery('input[name="enable_branching"]').prop('checked') == true){
				swal('','Sorry, can\'t enable skip button as  branching (quiz funnel) is enabled for this quiz.','');
				jQuery(this).prop('checked',true);
			}
		}
		
	});

	var url = window.location.href; // Get the current URL

    if (url.indexOf('sqb_add_quiz') !== -1 && url.indexOf('create') !== -1) {
    	jQuery('input[name="select_temp"][value="template8"]').trigger('click');
    }

	if(jQuery('input[name="select_temp"]:checked').val() == 'template8' && jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == true){
		jQuery('.sqb_global_shadow_customizer').show();
	}else if(jQuery('input[name="select_temp"]:checked').val() == 'template8' && jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == false){
		jQuery('.sqb_global_shadow_customizer').hide();
	}

	jQuery('#sqb_enable_inner_customizer_template8').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.template8_selected').addClass('sqb-inner-box-activated');
			jQuery('.sqb-inner-customizer-options').show('slow');
			jQuery('.sqbv2-template8-start').hide();
			jQuery('.sqbv2-template8-outcome').hide();
			jQuery('.sqbv2-template8-question').hide();
			jQuery('.sqbv2-template8-lead').hide();
			jQuery('.sqb_global_shadow_customizer').show();
		}else{
			jQuery('.sqb_global_shadow_customizer').hide();
			jQuery('.template8_selected').removeClass('sqb-inner-box-activated');
			jQuery('.sqb-inner-customizer-options').hide('slow');
		}
	});

	

	jQuery('input[name="email-based-subscribers"]').on('change', function(){
		jQuery('.sqb-no-outcome-error').hide();
		if(jQuery(this).val() == 'outcome_based'){
			if(jQuery('.left_side_outcome_list li').length == 0){
				jQuery('.sqb-no-outcome-error').show();
				jQuery('input[name="email-based-subscribers"][value="subscriber_based"]').prop('checked', true);
				return false;
			}

			if(jQuery('.activecampaign_save_outer_div .add-all-outcomes select').length == 0){
				var quiz_id = jQuery('#edit_id').val();
				jQuery.post(ajaxurl, {
					quiz_id:quiz_id,
					action:'sqb_load_outcome_name',
					}, function(response) {	
					response = JSON.parse(response);
					if(response.outcome_html){
						jQuery('.add-all-outcomes').html('<select class="form-control sqb_outcome_autoresponder sqb_auto_action " name="sqb_outcome_autoresponder" ><option value="">Select an Outcome</option>'+response.outcome_html+'</select>');
					}
				})
			}

			jQuery('.autoresponder_outcome_data').show();
		}else{
			jQuery('.autoresponder_outcome_data').hide();
		}
	});

	jQuery(document).mouseup(function(e) 
	{
    var container = jQuery(".question_type_list_ul");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.removeClass('newshowcls show');
	    }

    var container = jQuery(".quiz_category_type_list_ul");
    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.removeClass('newshowcls show');
	    }
	});


	if (jQuery('#start_img_temp2 .start_img').length) {
		var img_src = jQuery('#start_img_temp2 .start_img').attr('src');
		sqb_checkIfImageExists(img_src, (exists) => {
	  		if (exists) {
		    
			} else {
			    jQuery('#start_img_temp2 .start_img').attr('src', sqb_plugin_url+'/smartquizbuilder/includes/images/start_image1.jpg');
			}
		});
	}
	var start_screen_button_color  = jQuery('.take-quiz-btn').css('background-color');
	if(start_screen_button_color){
		var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').val();
		if(sqb_button_template == 'default'){
			jQuery('#startbutton_backgroud_color').colorpicker('setValue', start_screen_button_color);
		}
	}
	
	var select_temp = jQuery('input[name="select_temp"]:checked').val();
	if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
		var get_height = jQuery('.start_temp_outer').css('min-height');
		setTimeout(function(){
			if(jQuery('.start_temp_outer').hasClass('vh-height-apply-v2')){
				jQuery('.background-height-px_v2').hide();
				jQuery('.background-height-vh_v2').show();
				jQuery('.select-background-height_v2').val('vh');
				if(get_height){
					jQuery('input[name="select_background_height_vh_v2"]').val(parseInt(get_height));
					jQuery('.background_height_vh_question_v2').bootstrapSlider('setValue', parseInt(get_height));
				}
			}else{
				jQuery('.background-height-px_v2').show();
				jQuery('.background-height-vh_v2').hide();
				jQuery('.select-background-height_v2').val('px');
				if(get_height){
					jQuery('input[name="select_background_height_v2"]').val(parseInt(get_height));
					jQuery('.background_height_question_v2').bootstrapSlider('setValue', parseInt(get_height));
				}
			}
		},500);
		

	}


	var start_img_height = jQuery('.start_template_html_preview_outer .start_img').css('height');
	if(start_img_height != undefined){
		jQuery("#img_size").bootstrapSlider('setValue', parseInt(start_img_height));
	}

	jQuery('.save-caption-btn').on('click', function(){
		var flag = 0;
		jQuery('.caption_wrapper_outer').find('.caption-error').remove();
		//var player = videojs('video_caption_player');
		//var duration = player.duration();
		
		jQuery('.caption_wrapper').each(function(i){
			var start_time = jQuery(this).find('.caption-start-time').val();
			var end_time = jQuery(this).find('.caption-end-time').val();
			var caption_text = jQuery(this).find('.caption-text').val();

			if(start_time == ''){
				jQuery('.caption_wrapper_outer').append('<div class="caption-error">Please enter start time</div>');
				flag = 1;
			}else if(end_time == 'end_time'){
				jQuery('.caption_wrapper_outer').append('<div class="caption-error">Please enter end time</div>');
				flag = 1;
			}else if(caption_text == ''){
				jQuery('.caption_wrapper_outer').append('<div class="caption-error">Please enter all Caption Text</div>');
				flag = 1;
			}

			/*var s_second = sqbTimeToSecond('00:'+start_time);
			var e_second = sqbTimeToSecond('00:'+end_time);

			if(s_second > duration || e_second > duration){
				jQuery('.caption_wrapper_outer').append('<div class="caption-error">The entered video duration should not be longer than the original video duration.</div>');
				flag = 1;
			}*/

		});

		if(flag == 1){
			setTimeout(function(){
				jQuery('.caption-error').remove();
			}, 5000);
			return false;
		}


		SQBShowLoader();
		var caption_data = generateBlob();
		var video_url = jQuery('.video_caption_hidden_url').val();
		jQuery.post(ajaxurl, {
			video_url:video_url,
			caption_data:caption_data,
			action:'sqb_save_video_data',
			}, function(response) {	
			SQBHideLoader();
			response = JSON.parse(response);
			if(response){
				jQuery('.save-caption-btn').html('Saved Sucessfully<i class="fa fa-save"></i>');
				setTimeout(function(){
					jQuery('.save-caption-btn').html('Save<i class="fa fa-save"></i>');
				},1000);
			}
		})
	});

	var edit_id = jQuery("#edit_id").val();	

	jQuery(".matching_answer_sortable").sortable();

	if(typeof edit_id == undefined || typeof edit_id == "undefined"){

	}else{
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type == "scoring" || quiz_type == "calculator" || 'assessment'){
			jQuery('.sqb_question_no').each(function(){
				var question_type = jQuery(this).find('.question_type_wrapper .dropdown-toggle').attr('data-value');
				if(question_type == 'numerical_text'){
					var check_length = jQuery(this).find('.ans_type_numeric_text .answer_level_dot_button').length;
					if(check_length == 0){
						
						var points_ans_checkbox_show = 'style="display:none;';
						var correct_ans_show = 'style="display:none;';
						if(quiz_type == "scoring" || quiz_type == "calculator"){
							points_ans_checkbox_show = "";
						}
						if(quiz_type == "calculator"){
							correct_ans_show = "";
						}
						var numeric_option = "<div class='answer_level_dot_button sqb_ans_disable_dds numeric-correct-outer'><div class='dropdown-link-style dropdown'> <button class='dropdown-toggle' type='button' id='dropdownMenuButtonAnslevel' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span> ...</span></button><div class='dropdown-menu' aria-labelledby='dropdownMenuButtonAnslevel' x-placement='bottom-start'><div class='show-numeric-points' "+points_ans_checkbox_show+"><strong><label class='mb-2'>Points <div class='tool-tip'> <i class='fa fa-info-circle' aria-hidden='true'></i> <div class='toll-tip-desc'>Users will be assigned points for correct answer. If there are no points, leave empty</div> </div></label></strong><input type='number' name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1'></div><div class='numeric-correct-answer mt-2' "+correct_ans_show+"><label class='mb-2'><strong>Correct Answer Value <div class='tool-tip'> <i class='fa fa-info-circle' aria-hidden='true'></i> <div class='toll-tip-desc'>The answer users enter will be matched against this value and only if it matches, they will be assigned points for the correct answer.</div> </div></strong></label><input type='number' name='numeric_correct_answer' title='Correct Answer Value' class='correct_answer'></div></div></div></div>";

						jQuery(this).find('.ans_type_numeric_text').append(numeric_option);
					}
				}
			});
		}
	}

	jQuery('#template9_question_video_captions').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			var video_url = jQuery('.sqb_question_no.active .Quiz-Template9-left-side input[name="video_id"]').val();
			if(video_url == undefined || video_url == ''){
				swal('Please add video');
				jQuery(this).prop('checked', false);
				return false;
			}
			jQuery('.template9_question_add_caption').show();
			jQuery('.sqb_question_no.active .Quiz-Template9-left-side .video_caption').val('Y');
		}else{
			jQuery('.template9_question_add_caption').hide();
			jQuery('.sqb_question_no.active .Quiz-Template9-left-side .video_caption').val('N');
		}
	});

	jQuery(document).on('click', '.close-word', function(){
		jQuery(this).parents('.custom-word').remove();
	});

	jQuery(document).on('change', '#select_certificate', function(){
		jQuery(this).css('border','1px solid #ddd');
	});

	jQuery(document).on('click', '#email_pdf_attachment', function (){
		if(jQuery(this).prop('checked')== true){
			jQuery('.sqb_pdf_attachment_message').show();
		}else{
			jQuery('.sqb_pdf_attachment_message').hide();
		}
	});

	jQuery('#template9_lead_video_captions').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			var video_url = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_id"]').val();
			if(video_url == undefined || video_url == ''){
				swal('Please add video');
				jQuery(this).prop('checked', false);
				return false;
			}
			jQuery('.template9_lead_add_caption').show();
			jQuery('.lead-Screen-Quiz-Template9-left-side .video_caption').val('Y');
		}else{
			jQuery('.lead-Screen-Quiz-Template9-left-side .video_caption').val('N');
			jQuery('.template9_lead_add_caption').hide();
		}
	});

	jQuery('.sqb_question_no').each(function(){
		if(jQuery(this).find('.question_add_answer_outer_div .file-upload .file-upload-message .sqb_tiny_mce_editor').length == 0){
			jQuery(this).find('.question_add_answer_outer_div .file-upload .file-upload-message p').addClass('sqb_tiny_mce_editor');
			sqb_tiny_mce_editor();
		}
	});
	
	jQuery('.outcome-rank-shortcode').on("click", function(){
		jQuery('.category-copy-paste').show('slow');
	});
	jQuery('.closeoutcomerank').on("click", function(){
		jQuery('.category-copy-paste').hide('slow');
	});

	jQuery(document).on('click', '.add-additional-words', function(){
		if(jQuery('.sqb_question_no.active .input-additional-word').val() == ''){
			swal('','Please enter the word in the textbox','');
			return false;
		}
		var show_points = 'style="display:none"';
		var additional_word = jQuery('.sqb_question_no.active').find('.input-additional-word').val();
		var outer_length = jQuery('.sqb_question_no.active .show-generated-data .matching_answer_sortable').length;
		if(outer_length == 1){
			var index = jQuery('.sqb_question_no.active .show-generated-data .matching_answer_sortable .generated-content').length;
			if(index == 1){
			}else{
				index = index + 1;
			}
			jQuery('.sqb_question_no.active .show-generated-data .matching_answer_sortable').append('<li class="ui-state-default generated-content custom-word" data-word="custom" data-id="'+index+'"><span class="close-word"><i class="fa fa-trash"></i></span><i class="fa fa-arrows reArrange_sortable_icon" aria-hidden="true"></i><span class="generated-content-text"><strong>'+additional_word+'</strong></span><div class="show-matching-text-points" '+show_points+'><input type="number" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div></li>');
		}else{
			var matching_content = '<li class="ui-state-default generated-content custom-word" data-word="custom" data-id="0"><span class="close-word"><i class="fa fa-trash"></i></span><i class="fa fa-arrows reArrange_sortable_icon" aria-hidden="true"></i><span class="generated-content-text"><strong>'+additional_word+'</strong></span><div class="show-matching-text-points" '+show_points+'><input type="number" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div></li>';
			jQuery('.sqb_question_no.active .show-generated-data').append('<ul class="matching_answer_sortable">'+matching_content+'</ul>');
		}
		jQuery('.sqb_question_no.active .input-additional-word').val('');
		jQuery(".matching_answer_sortable").sortable();

		
	});



	jQuery('.sqb_question_no').each(function(){
		var question_type = jQuery(this).find('.question_type_wrapper .dropdown-toggle').attr('data-value');
		if(question_type = "matching_text"){
			var check_class = jQuery(this).find('.generated-data-outer .generate-btn-outer').length;

			if(check_class == 0){
				jQuery(this).find('.generate-answer-text').remove();
				jQuery(this).find('.generated-data-outer').prepend('<div class="generate-answer-text"><div class="generate-btn-outer"><a href="javascript:void(0)" class="generate-btn">Generate</a></div><div class="additional-words-outer"><input type="text" placeholder="Enter additional word" class="input-additional-word"><a href="javascript:void(0)" class="add-additional-words">Add Additional Words</a></div></div>');
			}
		}
	});


	jQuery(document).on('click', '.generate-btn', function(){

		
		//jQuery('.sqb_question_no.active .show-generated-data').html('');
		jQuery('.sqb_question_no.active .core-word').remove();
		//var matching_text = tinymce.get("matching_answer_text").getContent();
		var matching_text = jQuery('.sqb_question_no.active .matching_answer_text').text();
		if(matching_text == ''){
			swal('','Please enter the content in the textbox','');
			return false;
		}

		var matches = matching_text.match(/\[(.*?)\]/g);
		var matching_content = ''; 
		var show_points = 'style="display:none"';
		if(jQuery('input[name="quiz_type"]:checked').val() == "scoring" || jQuery('input[name="quiz_type"]:checked').val() == "calculator"){
			show_points = 'style="display:block"';
		}

		var outer_length = jQuery('.sqb_question_no.active .show-generated-data .matching_answer_sortable').length;
		
		if(outer_length == 1){
			jQuery.each(matches , function(index, val) { 
				var content = val.replace(/[[\]]/g,'' );
				matching_content += '<li class="ui-state-default generated-content core-word" data-word="core" data-id="'+index+'"><i class="fa fa-arrows reArrange_sortable_icon" aria-hidden="true"></i><span class="generated-content-text"><strong>'+content+'</strong></span><div class="show-matching-text-points" '+show_points+'><input type="number" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div></li>';
			});
			
			jQuery('.sqb_question_no.active .show-generated-data .matching_answer_sortable').prepend(matching_content);
			
		}else{
			jQuery.each(matches , function(index, val) { 
				var content = val.replace(/[[\]]/g,'' );
				matching_content += '<li class="ui-state-default generated-content core-word" data-word="core" data-id="'+index+'"><i class="fa fa-arrows reArrange_sortable_icon" aria-hidden="true"></i><span class="generated-content-text"><strong>'+content+'</strong></span><div class="show-matching-text-points" '+show_points+'><input type="number" name="ans_poins" title="Enter Ans Points" placeholder="Points" class="sqb_ans_disable_dds1"></div></li>';
			});
			jQuery('.sqb_question_no.active .show-generated-data').append('<ul class="matching_answer_sortable">'+matching_content+'</ul>');
		}
		
		var index = 0;
		jQuery('.sqb_question_no.active .generated-content').each(function(){
			jQuery(this).attr('data-id', index);
			index++;
		});
		jQuery(".matching_answer_sortable").sortable();
	});

	jQuery(document).on('click','.numerical-sidepopup',function(){
		jQuery('.numerical-sidepopup-manage').addClass('active_Side_Popup');
		jQuery('.numerical-sidepopup-manage').show();
		jQuery('body').addClass('sidepopup-active');

	});

	jQuery('#poll_start_date').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.start-poll-datetime').show();
			jQuery('.start_time_editor_main').show();
		}else{
			jQuery('.start-poll-datetime').hide();
			jQuery('.start_time_editor_main').hide();
		}
	});
    
    var iti = {};
	jQuery('.sqb_question_no').each(function(){
		if(jQuery(this).find('.sqb_and_field').hasClass('international-phone-number')){
			var question_id = jQuery(this).attr('id');
			var selected_country = jQuery(this).find('.selected_country').val();
			var q_id = jQuery(this).find('.question-screen .quiz_comon_template').attr('data-id');
			var input = document.querySelector('#'+question_id+' .international-phone-number');
			iti[q_id] = window.intlTelInput(input, {
				formatOnDisplay: true,
				hiddenInput: "full_number",
				preferredCountries: [selected_country],
				// separateDialCode: true,
				utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
			  });

		  	jQuery('#'+question_id+' .international-phone-number').on("countrychange", function(event) {
				var question_id = jQuery(this).closest('.question_type_phone_number').attr('data-question-id');			
				var selectedCountryData = iti[q_id].getSelectedCountryData();
				newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),
				iti[q_id].setNumber("");
				mask = newPlaceholder.replace(/[1-9]/g, "0");
			 	jQuery(this).mask(mask);
		   	});
			
		   	iti[q_id].promise.then(function() {
			   jQuery('#'+question_id+' .international-phone-number').trigger("countrychange");
		  	});
	   	}
	});

	jQuery(document).on('click','.question-type-email-validation-outer span',function(){
		jQuery('.sqb-email-type-options').show();
	});

	jQuery(document).on('click','.question-type-phone-validation-outer span',function(){
		jQuery('.sqb-phone-type-options').show();
	});

	jQuery(document).on('click','.question-type-hw-validation-outer span',function(){
		jQuery('.sqb-hw-type-options').show();
	});

	jQuery(document).on('input','.validation-email-type', function(){
		var get_val = jQuery(this).val();
		jQuery(this).attr('placeholder', get_val);
	});

	jQuery(document).on('input','.validation-phone-type', function(){
		var get_val = jQuery(this).val();
		jQuery(this).attr('placeholder', get_val);
	});
	jQuery(document).on('input','.validation-hw-type', function(){
		var get_val = jQuery(this).val();
		jQuery(this).attr('placeholder', get_val);
	});

	jQuery(document).on('change','input[name="email_type_required"]', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery(this).attr('checked', 'checked');			
		}else{
			jQuery(this).removeAttr('checked');			
		}
	});

	jQuery(document).on('change','input[name="phone_type_required"]', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery(this).attr('checked', 'checked');			
		}else{
			jQuery(this).removeAttr('checked');			
		}
	});

	jQuery(document).mouseup(function(e){
	    var container = jQuery(".sqb-email-type-options");
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	        container.hide();
	    }
	});
	jQuery(document).mouseup(function(e){
	    var container = jQuery(".sqb-phone-type-options");
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	        container.hide();
	    }
	});
	jQuery(document).mouseup(function(e){
	    var container = jQuery(".sqb-hw-type-options");
	    if (!container.is(e.target) && container.has(e.target).length === 0){
	        container.hide();
	    }
	});

	jQuery('#close_specific_time').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.close-poll-datetime').show();
			jQuery('.close_time_editor_main').show();
		}else{
			jQuery('.close-poll-datetime').hide();
			jQuery('.close_time_editor_main').hide();
		}
	});

	jQuery('#display_message').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.display-message-content-showhide').show();
		}else{
			jQuery('.display-message-content-showhide').hide();
		}
	});

	jQuery('#hide_number').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.show_vote_count_content').show();
		}else{
			jQuery('.show_vote_count_content').hide();
		}
	});

	jQuery(document).on('click',"#autoSubmitOptIn",function(){
		if(jQuery(this).prop('checked')){
			sqb_sweet_message('',"<div>Please note: when this option is enabled, a \"please wait... analyzing results\" screen will be displayed after users complete the last question (and before they are sent to outcome screen).<br /><br /> For e.g.<br /><br /> https://yoursite.com/quiz?first_name=joe&email=joe@example.com <br /><br /> This will allow SQB to process the calls to external systems and auto-submit the form. You can customize the contents of this screen for this quiz in SQB >> Settings page >> Quiz Settings tab.</div>",'');
		}else{
			
		}
	});

	jQuery(document).on("change", 'input[name="repeat-voting"]', function(){
		if(jQuery(this).val() == 'browser-based'){
			jQuery('.show-voting-again').show('slow');
			if(jQuery('input[name="show_opt_screen"]:checked').val() != 'Y'){
				jQuery('.change-vote').show('slow');
			}
		}else if(jQuery(this).val() == 'repeated-voting'){
			jQuery('.show-voting-again').hide('slow');
			jQuery('.change-vote').hide('slow');
			jQuery('.change-vote-content').hide();
			jQuery('#change_vote').prop('checked', false);
		}else{
			if(jQuery('input[name="show_opt_screen"]:checked').val() != 'Y'){
				jQuery('.change-vote').show('slow');
			}
			jQuery('.show-voting-again').hide('slow');

		}
	});

	jQuery(document).on("change", 'input[name="show_results"]', function(){
		if(jQuery(this).val() == 'redirect-to-outcome'){
			jQuery('.result_tab').show();
			var chart_display = jQuery('input[type="radio"][name="chart_display"]:checked').val();
			if(chart_display == 'bar_chart' || chart_display == 'pie_chart'){
				jQuery('.sqb_select_chart_message').show();
			}
			jQuery('.chart-disaply-outer').show();
			jQuery('.question-screen-next').show();
			jQuery('.outcome-screen-next').hide();
		}else{
			jQuery('.result_tab').hide();
			jQuery('.sqb_select_chart_message').hide();
			jQuery('.chart-disaply-outer').hide();
			jQuery('.question-screen-next').hide();
			jQuery('.outcome-screen-next').show();
		}
	});

	jQuery(document).on("change", 'input[name="chart_display"]', function(){
			if(jQuery(this).val() == 'bar_chart' || jQuery(this).val() == 'pie_chart'){
				jQuery('.sqb_select_chart_message').show();
			}else{
				jQuery('.sqb_select_chart_message').hide();
			}
	});

	jQuery('#allow_viewing_result').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.view-result-content').show();
		}else{
			jQuery('.view-result-content').hide();
		}
	});
	jQuery('#hide_results').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('#allow_viewing_result').removeAttr("disabled");
			jQuery('.see-results').show();

			if(jQuery('#show_opt_screen').prop('checked') == false){
				jQuery('#change_vote').removeAttr("disabled");
				jQuery('.change-vote').show();
			}
			
			//jQuery('.change-vote-content').show();
		}else{
			jQuery('#allow_viewing_result').prop('checked', false);
			jQuery('#change_vote').prop('checked', false);
			jQuery('#allow_viewing_result').attr("disabled", true);
			jQuery('#change_vote').attr("disabled", true);
			jQuery('.see-results').hide();
			jQuery('.change-vote').hide();			
			jQuery('.change-vote-content').hide();
			jQuery('.view-result-content').hide();
			
		}
	});

	jQuery('#change_vote').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.change-vote-content').show();
		}else{
			jQuery('.change-vote-content').hide();
		}
	});
	
	var add_new_question_action = jQuery('input[name="add_new_question_action"]').length;
  	if(add_new_question_action != 0 ){
		add_new_question_action = jQuery('input[name="add_new_question_action"]').val();
		if(typeof add_new_question_action == undefined || typeof add_new_question_action == "undefined"){
		}else if(add_new_question_action == "add"){
			var selected_page = jQuery('select.selected-question').val();

			window.history.replaceState('', '', sqb_get_url_without_edit_quiz_query_string()+"&sqb_page="+selected_page);			 
			add_new_question('pagination');
			
			
		}
	}
	
	var add_new_outcome_action = jQuery('input[name="add_new_outcome_action"]').length;
  	if(add_new_outcome_action != 0 ){
		add_new_outcome_action = jQuery('input[name="add_new_outcome_action"]').val();
		if(typeof add_new_outcome_action == undefined || typeof add_new_outcome_action == "undefined"){
		}else if(add_new_outcome_action == "add"){
			var selected_page = jQuery('select.selected-outcome').val();
			window.history.replaceState('', '', sqb_get_url_without_edit_quiz_query_string()+"&sqb_outcome_page="+selected_page); 
			add_new_outcome('pagination');			
		}
	}

    jQuery('#quiz_allow_pdf_download_outcome_screen').on('click', function(){
		if(jQuery(this).prop('checked') == true){

			if(jQuery('.check_pdf_plugin').val() == 'N'){
				jQuery(this).prop('checked', false);
				jQuery('.pdf-plugin-error').show();
				return false;
			}

			jQuery('.download-pdf-child').show();
			jQuery('.pdf_shortcode').css('display', 'inline-block');
			jQuery('.pdf_download_icon').show();
			if(jQuery('#email_pdf_attachment').prop('checked') == true){
				jQuery('.sqb_pdf_attachment_message').show();
			}
		}else{
			jQuery('.sqb_pdf_attachment_message').hide();
			jQuery('.download-pdf-child').hide();
			jQuery('.pdf_shortcode').hide();
			jQuery('.pdf_download_icon').hide();
			jQuery('.enable-pdf-section .alert-danger').hide();
		}
	});

	jQuery('#quiz_allow_certificate').on('click', function(){
		if(jQuery(this).prop('checked') == true){
			if(jQuery('.check_pdf_plugin').val() == 'N'){
				jQuery(this).prop('checked', false);
				jQuery('.certificate-pdf-plugin-error').show();
				return false;
			}

			jQuery('.download-certificate-child').show();
		}else{
			jQuery('.download-certificate-child').hide();
		}
	});
    
	jQuery(document).on('keyup', '.time-based-input', function(){
		var time_val = jQuery(this).val();
		jQuery('.time-value').html(time_val);
	});

	jQuery(document).on('keyup', '.form-time-based-input', function(){
		var time_val = jQuery(this).val();
		jQuery('.time-value').html(time_val);
	});

	jQuery(document).on('keyup', '.form-percenatge-based-input', function(){
		var time_val = jQuery(this).val();
		jQuery('.percentage-value').html(time_val);
	});

	jQuery(document).on('keyup', '.percenatge-based-input', function(){
		var time_val = jQuery(this).val();
		jQuery('.percentage-value').html(time_val);
	});

	jQuery('.spreadsheet-how-it-work').on('click',function(){
		jQuery.post(ajaxurl, {
			action: 'sqb_load_get_custom_field_name',
			}, function(response) {	
				response = JSON.parse(response);
				jQuery('.custom-field-name').empty();
				if(response['data'] == 'Nofields'){
					jQuery('.gs-custom-field-outer').hide();
				}else{
					jQuery('.gs-custom-field-outer').show();
					jQuery('.custom-field-name').append(response['data']);
				}
			});
	});

	jQuery('#user_add_my_email_plateform_googlespreadsheet').on('click', function(){
		var url_param = SQB_GetURLParameter('id');
		if(url_param){
			jQuery('#user_add_my_email_plateform_googlespreadsheet_modal').modal('show');
		}else{
			jQuery('#google-sheet-notid').modal('show');
		}
	});


	jQuery('.google-sheet-img').on('click',function(){
		var image_detail = jQuery(this).attr('data-img');
		jQuery('#google-sheet-img-popup').modal('show');
		jQuery('.get_googlesheet_image').attr('src', image_detail);
	});

	setTimeout(function(){
		if(jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').css('display') == 'block'){
			jQuery('#showHide_skipbtn').prop('checked', true);
			jQuery('.show-hide-skip-btn').show();
		}else{
			jQuery('.show-hide-skip-btn').hide();
			jQuery('.skip-button-element-option').hide();
			jQuery('#showHide_skipbtn').prop('checked', false);
		}
	},500);
    
	jQuery('body').on('click', '.update-mapping', function(){
		jQuery('.quiz_advanced_rule').trigger('click');
	});	

	jQuery('body').on('change', 'input[name="show_other_checkbox"]', function() {
		if(jQuery(this).prop('checked') == true){
			var parents_id = jQuery(this).closest('.question_div_outer').attr('id');
			var parent_obj = jQuery('#'+parents_id);
			jQuery(this).closest('.dropdown-menu').find('.customize-text').show();
			jQuery(this).addClass("custom_other_box");
			jQuery(parent_obj).find('input[name="show_other_checkbox"]').not(this).prop('checked', false);  
			jQuery(parent_obj).find('input[name="show_other_checkbox"]').not(this).closest('.dropdown-menu').find('.customize-text').hide(); 
			jQuery(parent_obj).find('input[name="show_other_checkbox"]').not(this).closest('.dropdown-menu').find('.custom-checkbox-input').removeClass("custom_other_box");
			var question_type = jQuery(parent_obj).find('.question_type_wrapper .dropdown-toggle').attr('data-value');
			if(question_type == 'single'){
				jQuery(parent_obj).find('.continue-question-action').show();
			}
		} else{
			var question_type = jQuery(parent_obj).find('.question_type_wrapper .dropdown-toggle').attr('data-value');
			if(question_type == 'single'){
				jQuery(parent_obj).find('.continue-question-action').hide();
			}
			var parents_id = jQuery(this).closest('.question_div_outer').attr('id');
			var parent_obj = jQuery('#'+parents_id);
			jQuery(this).closest('.dropdown-menu').find('.customize-text').hide();
			jQuery(this).removeClass("custom_other_box");
		}
	});

	if(jQuery('.custom-checkbox-input').hasClass('custom_other_box')){
		jQuery('.custom_other_box').prop('checked', true);
	}

	jQuery('body').on('input', '.please-elaborate', function() {
		jQuery(this).attr("placeholder", jQuery(this).val());	
		jQuery(this).html(jQuery(this).val());	
	});

	jQuery('body').on('click', '.show-datepicker-popup i', function(){
		jQuery('#myDatepickerModal').modal('show');

		var array_month = jQuery('.sqb_question_no.active .date-question-type').attr('data-month-name').split(",");
		jQuery.each(array_month, function(i, keyword){
			jQuery( "input[name='month_names']" ).each(function( index ) {
				if(index == i){
					jQuery(this).val(keyword);
				}
			});
		});

		var array_day = jQuery('.sqb_question_no.active .date-question-type').attr('data-day-name').split(",");
		jQuery.each(array_day, function(i, keyword){
			jQuery( "input[name='day_names']" ).each(function( index ) {
				if(index == i){
					jQuery(this).val(keyword);
				}
			});
		});

	});

	jQuery('body').on('click', '.save-month-day-names', function(){
		var month_names = jQuery("input[name='month_names']").map(function() {
			    return jQuery(this).val();
			}).get().join(',');

		jQuery('.sqb_question_no.active .date-question-type').attr('data-month-name', month_names);

		var day_names = jQuery("input[name='day_names']").map(function() {
			    return jQuery(this).val();
			}).get().join(',');

		jQuery('.sqb_question_no.active .date-question-type').attr('data-day-name', day_names);

		sqb_save_quiz();
		
	});


	if(jQuery('#Basic-Screen-Settings #quiz_ans_tags').prop('checked')){
		//jQuery('#Quiz-Screen-Settings .answer_level_dot_button').show();
		if(jQuery('#Basic-Screen-Settings #quiz_ans_tags').prop('checked')){
			jQuery('.add_ans_level_recommendation').show();
			jQuery('.add_ans_level_recommendation').show();
		}else{
			jQuery('.add_ans_level_recommendation').hide();
		}
		jQuery('.add_ans_level_recommendation').show();
	}else{
		//jQuery('#Quiz-Screen-Settings .answer_level_dot_button').hide();
	}
    
	var quiz_type =jQuery('input[name="quiz_type"]:checked').val();
	if(quiz_type == 'form'){
		var popup_type =jQuery('input[name="popup_type"]:checked').val();
		if(popup_type == 'entry' || popup_type == 'exit'){
			jQuery('.form_quiz_shortcode').show();
			jQuery('.form-quiz-message').show();
		}
	}
        

    sqbShowProgressBarValidationMsgEvent();	
    sqb_add_answer_level_dot_option();
	sbq_question_add_more_ans();
	sbq_question_add_more_rating_btn();
	sbq_question_delete_add_image_btn();
	sqb_text_tiny_mce_editor();
	sqb_tiny_mce_editor();
	sqb_mediauploader_question_tab();
	sqb_mediauploader_lead_tab();
	sbq_quiz_any_element_remvoe_by_id();
	sqb_delete_question();
	sqb_re_order_answer();
	sqb_re_order_question();
	sbq_tinymce_focus();
	//sqb_enable_drag_drop_init();
    sqb_drag_drop_cutomizer_init();	
    if(typeof edit_id == undefined || typeof edit_id == "undefined"){
	}else{
    	sqb_question_template_customizer();	

	}
    sbq_question_ans_type_change();
    sbq_correct_ans_change();
    
    sqb_click_on_Question_no_heading();
    
    sqb_show_correct_incorrect_ans_wrapper();
    sqb_answer_correct_checkbox_one_checked();
    sqb_question_fil_style_in_edit_mode();
    sqbButtonsSetDefaultValues(); 
    sqbincorrect_correctdisplay(); 

    sqbsetansweridstooutcome();
    sqbhideshowpaginationoption();
    sqb_answer_type_slider_event();
	sqb_add_remove_matrix_elements();
	sqb_add_placehoder_to_fill_in_blank_field();

   /* 
    jQuery('inut[type="checkbox"][name="add_user_in_your_email_platform"]').on('click',function(){
		if(jQuery(this).prop('checked')){
			//jQuery(this).closest('li').find('.autoresonder_details_fields_outer').show('slow');
		}else{
			//jQuery(this).closest('li').find('.autoresonder_details_fields_outer').hide('slow');
		}	
	});
    */
    
	sqb_search_multiple_select_url();
	 
    sqb_template5_background_image_enable_disable();
	sqb_game_animation();
	sqb_game_animation_template_upload();
	sqb_game_animation_audio_upload();
    sqb_mediauploader_startscreen_tab();
	
	var quiz_type = jQuery('#quiz_type_switch').val();
    if(quiz_type == 'calculator'){
    	jQuery('.answer-options').show();
    	jQuery('.ans_poins_outer_wrapper').show();
    	jQuery('.ans_type_ranking_choices .answer-options').hide();
    }
    
    jQuery('.sqb_questions_wrapper .sqb_question_no .question_type_wrapper').find('button.dropdown-toggle').each(function(){
			var selected_question_type = jQuery(this).attr('data-value');
			if(selected_question_type == 'text' || selected_question_type == 'email' || selected_question_type == 'phone_number' ||  selected_question_type == 'date' || selected_question_type == 'value' || selected_question_type == 'slider' || selected_question_type == 'matrix' || selected_question_type == 'rating' || selected_question_type == 'yes_no' || selected_question_type == 'numerical_text' || selected_question_type == 'weight_and_height' || selected_question_type == 'name'){

				jQuery(this).closest('.question_div_inner').find('.question_add_more_ans_btn').addClass('hide-add-answer');
				
			}else{
				jQuery(this).closest('.question_div_inner').find('.question_add_more_ans_btn').show();
			}

			if(selected_question_type == 'single' || selected_question_type == 'multi'){
				
				jQuery('#Quiz-Screen-Settings .sqb_ans_item .answer-options').each(function(index, value) {
					var count = jQuery(this).find('.answer_level_dot_button').length;
					var ans_count = jQuery(this).find('.answer_level_dot_button .add-answer-tag').length;
					if(count < 1){
						jQuery(this).append('<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="display:none;"><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style="display:none;"><strong>View All Assigned Tags</strong></a></div></div></div>');
					}

					var check_other = jQuery(this).find('.answer_level_dot_button .add-other-option').length;
					
					if(check_other == 0){
						jQuery(this).find('.answer_level_dot_button').remove();
						jQuery(this).append('<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="display:none;"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)"><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags"><strong>View All Assigned Tags</strong></a></div></div></div>');
					}
				});
			}
		});
    jQuery(document).on('keyup','.Quiz-Template .question_add_answer_outer_div .sqb_ans_item input.numeric_value_prefix',function(){
		var prefix_value = jQuery(this).val();
		jQuery('#Quiz-Screen-Settings .sqb_question_no.active .sqb_ans_item input.hidden_numeric_value_prefix').val(prefix_value);
	});
	jQuery(document).on('keyup','.Quiz-Template .question_add_answer_outer_div .sqb_ans_item input.numeric_value_sufix',function(){
		var sufix_value = jQuery(this).val();
		jQuery('#Quiz-Screen-Settings .sqb_question_no.active .sqb_ans_item input.hidden_numeric_value_sufix').val(sufix_value);
	});
    
	function show_ans_tag_sidepopup(answer_id){
		jQuery.post(ajaxurl, {
			action: 'sqb_save_ans_tags',
			answer_id:answer_id,
			action_val: 'list_all_tags',
			}, function(response) {	
			response = JSON.parse(response);
			SQBHideLoader();
			
			if(response['html'] == ''){
				jQuery('.show_ans_tags').empty();
				jQuery('.show_ans_tags').append('<tr><td colspan="2">No tag assigned</td></tr>');
				//jQuery('.custom_fields_table_tag').hide();
				jQuery('.sqb_ans_item').each(function(){
				if(jQuery(this).attr('data-id') == answer_id){
					jQuery(this).find('.add-answer-tag').html('<strong>Add Tags</strong>');
					}
				});
			}else{
				jQuery('.show_ans_tags').empty();
				jQuery('.custom_fields_table_tag').show();
				jQuery('.sqb_ans_item').each(function(){
					if(jQuery(this).attr('data-id') == answer_id){
						jQuery(this).find('.add-answer-tag').html('<strong>Edit Tags</strong>');
					}
				});
			}

			jQuery('.show_ans_tags').append(response['html']);
			if(response['existing_tags'] == '' || response['existing_tags'] == 'null'){
				//jQuery('.answer_tags_wrapper .or-divider').hide();
				//jQuery('.answer_tags_wrapper .existing-div-show-hide').hide();
			}else{
				jQuery('.answer_tags_wrapper .or-divider').show();
				//jQuery('.answer_tags_wrapper .existing-div-show-hide').show();
				jQuery('.all_tag_data').empty();
				jQuery('.all_tag_data').append(response['existing_tags']);
			}
		});	
	}
    
	function sqb_add_placehoder_to_fill_in_blank_field(){
		jQuery(document).on('click','.Quiz-Template .question_add_answer_outer_div .sqb_ans_item input.sqb_and_field',function(){
			jQuery(this).addClass('sqb_disable_tiny_mce_editor');		
		});
		jQuery(document).on('keyup','.Quiz-Template .question_add_answer_outer_div .sqb_ans_item input.sqb_and_field',function(){
			if(!jQuery(this).closest('.sqb_ans_item').hasClass('ans_type_numeric_text')){//sqb_numerical_ans_field
				if(jQuery(this).val() != ''){
					jQuery(this).attr("placeholder", jQuery(this).val());	
				} else {
					jQuery(this).attr("placeholder", 'Enter the text here');
				}
			}
			jQuery(this).removeClass('sqb_disable_tiny_mce_editor');
		});
	}
	
		function sqb_add_remove_matrix_elements(){
		
		jQuery(document).on('click','.add_answer_matrix',function(){
			var display_radio_style = 'display:none';
			if(jQuery(this).closest('.answer_matrix_options_wrapper').find('input[type="checkbox"]:checked').prop('checked')){
			display_radio_style = '';
			}
			var internal_elements = ''; 
			jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table thead tr th').each(function(index, value) {
				if(index > 1){	
				internal_elements += '<td><input type="radio"><input type="text" value="0" style="'+display_radio_style+'" class="answer_value"></td>';
				}
			});
			
			var sqb_datetime = new Date();
			var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
			var start_elements = '<tr class="sqb_ans_item" data-id="%%ANSWERID%%" id="'+sqb_round_no+'"><th class="SQB-fixed-side"><div class="sql_ans_text sqb_tiny_mce_editor"> Type Answer Here</div></th>';
			var end_elements = '<td><span class="sqb-matrix-delete-row sqb_backend_show sqb_remove_section sqb_ans_delete_btn" data-id="'+sqb_round_no+'"><i class="fa fa-trash-o" aria-hidden="true"></i></span></td></tr>';
			
			var answer_html = start_elements+internal_elements+end_elements;
			jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tbody').append(answer_html);
			sqb_tiny_mce_editor();
		});
		
		jQuery(document).on('click','.add_option_matrix',function(){
			
			var display_radio_style = 'display:none';
			if(jQuery(this).closest('.answer_matrix_options_wrapper').find('input[type="checkbox"]:checked').prop('checked')){
			display_radio_style = '';
			}
			
			var count_th = jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table thead tr th').length;
			var th_count = count_th - 1;
		
			jQuery('<th scope="col" width="150px"><div class="matrix_label_text"><div class="sqb_tiny_mce_editor mce-content-body" id="mce_20" contenteditable="true" spellcheck="false" style="position: relative;">'+th_count+'</div></div><div class="sqb-matrix-col-remove"><i class="fa fa-close" aria-hidden="true"></i></div></th>').insertBefore('#sqb-answer-matrix-table-scroll .SQB-main-table thead tr th:last');
			
			jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table > tbody  > tr').each(function(index, tr) { 
				var secondLast = jQuery(this).find('td:last').prev();
				var newItemHTML = '<td><input type="radio"><input type="text" value="0" style="'+display_radio_style+'" class="answer_value"></td>';
				jQuery( newItemHTML ).insertAfter( secondLast );
			});
		});
		
		jQuery(document).on('keypress','.answer_value',function (e) {    
				var charCode = (e.which) ? e.which : event.keyCode;    
				if (String.fromCharCode(charCode).match(/[^0-9]/g)) {    
					return false;
				}
			}); 
		
		jQuery(document).on('click','.sqb-matrix-col-remove',function(){
			var current_obj = this;
			swal({
			title: "Are you sure you want to delete ?",
			text: "You cannot recover the settings.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			
			}).then((result) => {
					if (result.value) {
						var clicked_element_index = jQuery(current_obj).closest('th').index();
						jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tbody tr').each(function(index, value) {
							  jQuery(this).find('td').eq(clicked_element_index-1).remove();
						});
						jQuery(this).closest('th').remove();
						
						/*var data_length = jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table thead tr th').length;
						jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table thead tr th').each(function(index, value) {
							if (index > 0 && index < data_length-1) {
							jQuery(this).find('.sqb_tiny_mce_editor').html(index);	
							}
						});*/
					}
				});
			});	
	}
	
	jQuery(document).on('click','input[name="popup_type"]',function(){
		var popup_display = jQuery(this).val();
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if((popup_display == 'entry')){
			jQuery('.form-percentage-based-outer').hide();
			jQuery('.form-time-based-outer').hide();

			jQuery('.percentage-based-popup').hide();
			jQuery('.timed-based-popup').hide();
			jQuery('.exit-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();
			jQuery('#Start-Screen-Settings-tab').hide();
			jQuery('.show-lead-page-for-form-quiz-type').show();
			jQuery('.show-start-screen-settings').hide();
			jQuery('.form_quiz_shortcode').show();
			jQuery('.form-quiz-message').show();
			if(quiz_type == 'form'){
				jQuery('.show-quiz-screen-setting').hide();
				jQuery('.sqb_multiple_url_select').show('slow');
				jQuery('.sqb_multiple_url_select_time').show('slow');
			}else{
				jQuery('.entry_exit_page_urls').show();
			}

			sqb_get_pages_posts_url_list_html();
		}else if(popup_display == 'exit'){
			jQuery('.form-percentage-based-outer').hide();
			jQuery('.form-time-based-outer').hide();

			jQuery('.percentage-based-popup').hide();
			jQuery('.timed-based-popup').hide();
			jQuery('.exit-based-popup').show();
			jQuery('.sqb_show_selected_page_popup').show();
			jQuery('#Start-Screen-Settings-tab').hide();
			jQuery('.show-lead-page-for-form-quiz-type').show();
			jQuery('.show-start-screen-settings').hide();
			jQuery('.form_quiz_shortcode').show();
			jQuery('.form-quiz-message').show();
			if(quiz_type == 'form'){
				jQuery('.show-quiz-screen-setting').hide();
				jQuery('.sqb_multiple_url_select').show('slow');
				jQuery('.sqb_multiple_url_select_time').show('slow');
			}else{
				jQuery('.entry_exit_page_urls').show();
			}
			sqb_get_pages_posts_url_list_html();
		}else if(popup_display == 'time_based'){
			jQuery('.form-percentage-based-outer').hide();
			jQuery('.form-time-based-outer').show();

			jQuery('.percentage-based-popup').hide();
			jQuery('.timed-based-popup').show();
			jQuery('.exit-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();
			jQuery('#Start-Screen-Settings-tab').hide();
			jQuery('.show-lead-page-for-form-quiz-type').show();
			jQuery('.show-start-screen-settings').hide();
			jQuery('.form_quiz_shortcode').show();
			jQuery('.form-quiz-message').show();
			if(quiz_type == 'form'){
				jQuery('.show-quiz-screen-setting').hide();
				jQuery('.sqb_multiple_url_select').show('slow');
				jQuery('.sqb_multiple_url_select_time').show('slow');
			}else{
				jQuery('.entry_exit_page_urls').show();
			}
			sqb_get_pages_posts_url_list_html();
		}else if(popup_display == 'percentage_based'){
			jQuery('.form-percentage-based-outer').show();
			jQuery('.form-time-based-outer').hide();

			jQuery('.percentage-based-popup').show();
			jQuery('.timed-based-popup').hide();
			jQuery('.exit-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();

			jQuery('#Start-Screen-Settings-tab').hide();
			jQuery('.show-lead-page-for-form-quiz-type').show();
			jQuery('.show-start-screen-settings').hide();
			jQuery('.form_quiz_shortcode').show();
			jQuery('.form-quiz-message').show();
			if(quiz_type == 'form'){
				jQuery('.show-quiz-screen-setting').hide();
				jQuery('.sqb_multiple_url_select').show('slow');
				jQuery('.sqb_multiple_url_select_time').show('slow');
			}else{
				jQuery('.entry_exit_page_urls').show();
			}
			sqb_get_pages_posts_url_list_html();
		}else{
			jQuery('.form-percentage-based-outer').hide();
			jQuery('.form-time-based-outer').hide();

			jQuery('.percentage-based-popup').hide();
			jQuery('.timed-based-popup').hide();
			jQuery('.exit-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').hide();

			jQuery('.form_quiz_shortcode').hide();
			jQuery('.form-quiz-message').hide();
			jQuery('.entry_exit_page_urls').hide();
			jQuery('#Start-Screen-Settings-tab').show();
			jQuery('.show-lead-page-for-form-quiz-type').hide();
			jQuery('.show-start-screen-settings').show();
			jQuery('.sqb_multiple_url_select').hide('slow');
			jQuery('.sqb_multiple_url_select_time').hide('slow');
		}
	});


	jQuery(document).on('click','input[name="defaultpopup_type"]',function(){
		var defaultpopup_type = jQuery(this).val();

		jQuery('#show_start_screen').prop("checked", false);
		jQuery('.tab-show-start-screen-settings').hide();
		
		var checked_template = jQuery('input[name="select_temp"]:checked').val();
		if(defaultpopup_type == 'corner_popup'){
				if(checked_template == 'template9'){
					swal("","Sorry, can't use corner popup with this template.",""); 
					return false;
				}else if(checked_template == 'template5' || checked_template == 'template7'){
					swal("","Sorry, this template can only be used in-page and in popup format",""); 
					return false;
				} else {
					jQuery('.quiz_slider_animation_div_display').hide('slow');
					jQuery('.sqb_popup_position_outer').show('slow');
					jQuery('#container_template5').closest('li').hide();
					jQuery('#container_template7').closest('li').hide();
					jQuery('.allow_retake_quiz_outer, .sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
				}
				
				jQuery('.responsive-screen-link').hide();
				jQuery('.sqb_desktop_view').trigger('click');
				jQuery('.tab-pane').removeClass('sqb_mobile_view_layout_active');
				jQuery('.show_start_screen').show();
				jQuery('.show-form-quiz-option').hide();
				jQuery('.entry_exit_page_urls').hide();
				jQuery('.sqb_multiple_url_select').show('slow');
				jQuery('.popup-option-message').show();
				
				jQuery('.shortocde_details .timed-based-popup').hide();
				jQuery('.shortocde_details .exit-based-popup').hide();
				jQuery('.shortocde_details .percentage-based-popup').hide();
				jQuery('.sqb_show_selected_page_popup').show();

				jQuery('.sqb_multiple_url_select_time').show();
				jQuery('.time-delay').show();
				//jQuery('.tab-show-start-screen-settings').hide();
				//jQuery('.show-start-screen-settings').hide();
				//jQuery('.show-quiz-screen-setting').show();
				//jQuery('.show_start_screen').hide();
				jQuery('.time-based-outer').hide();
				jQuery('.percentage-based-outer').hide();
				jQuery('.popup-error-msg-time').hide();
				jQuery('.popup-error-msg-percentage').hide();
				jQuery('input[name="show_start_screen"]').trigger('change');

				jQuery('.embed-code-hide').show();
				jQuery('.embed-code-exit-show').hide();
			sqb_get_pages_posts_url_list_html();
		}else if(defaultpopup_type == 'popup'){
			jQuery('.sqb_multiple_url_select').hide('slow');
			jQuery('.sqb_popup_position_outer').hide('slow');
			jQuery('.popup-option-message').hide();
			
			jQuery('.shortocde_details .timed-based-popup').hide();
			jQuery('.shortocde_details .exit-based-popup').hide();
			jQuery('.shortocde_details .percentage-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').hide();

			jQuery('.sqb_multiple_url_select_time').hide();
			jQuery('.time-delay').hide();

			jQuery('#show_start_screen').prop("checked", true);

			//jQuery('.show_start_screen').hide();
			var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
			if(show_start_screen){
				jQuery('.tab-show-start-screen-settings').show();
				
			}else{
				jQuery('.tab-show-start-screen-settings').hide();
				
			}
			jQuery('.show-start-screen-settings').show();
			jQuery('.show-quiz-screen-setting').hide();
			jQuery('.time-based-outer').hide();
			jQuery('.percentage-based-outer').hide();
			jQuery('.popup-error-msg-time').hide();
			jQuery('.popup-error-msg-percentage').hide();

			if(checked_template == 'template5'){
				sqb_get_start_temp('template5', 'start');
			}else{
				sqb_get_start_temp('template1', 'start');
			}
			jQuery('.embed-code-hide').show();
			jQuery('.embed-code-exit-show').hide();
		}else if(defaultpopup_type == 'time_based'){
			jQuery('.time-based-outer').show();
			jQuery('.percentage-based-outer').hide();
			jQuery('.popup-option-message').show();
			jQuery('.sqb_popup_position_outer').hide('slow');
			jQuery('.shortocde_details .timed-based-popup').show();
			jQuery('.shortocde_details .exit-based-popup').hide();
			jQuery('.shortocde_details .percentage-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();

			//jQuery('.entry_exit_page_urls').show('slow');
			jQuery('.sqb_multiple_url_select').show('slow');
			//jQuery('.sqb_multiple_url_select_time').hide();
			jQuery('.time-delay').hide();
			//jQuery('.tab-show-start-screen-settings').hide();
			//jQuery('.show-start-screen-settings').hide();
			//jQuery('.show-quiz-screen-setting').show();
			//jQuery('.show_start_screen').hide();
			jQuery('.popup-error-msg-time').hide();
			jQuery('.popup-error-msg-percentage').hide();
			sqb_get_pages_posts_url_list_html();

			var new_flow = jQuery("#new_flow").val();
			if(new_flow == "Y"){
				jQuery('.sqb_multiple_url_select_time').show();
			}else{
				jQuery('.sqb_multiple_url_select_time').hide();
			}

			var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
			if(show_start_screen){
				jQuery('.tab-show-start-screen-settings').show();
				jQuery('.show-start-screen-settings').show();
				jQuery('.show-quiz-screen-setting').hide();
			}else{
				jQuery('.tab-show-start-screen-settings').hide();
				jQuery('.show-start-screen-settings').hide();
				jQuery('.show-quiz-screen-setting').show();
			}
			jQuery('.embed-code-hide').show();
			jQuery('.embed-code-exit-show').hide();
		}else if(defaultpopup_type == 'percentage_based'){
			jQuery('.percentage-based-outer').show();
			jQuery('.time-based-outer').hide();
			jQuery('.popup-option-message').show();
			jQuery('.sqb_popup_position_outer').hide('slow');
			
			jQuery('.shortocde_details .timed-based-popup').hide();
			jQuery('.shortocde_details .exit-based-popup').hide();
			jQuery('.shortocde_details .percentage-based-popup').show();
			jQuery('.sqb_show_selected_page_popup').show();
			
			//jQuery('.entry_exit_page_urls').show('slow');
			jQuery('.sqb_multiple_url_select').show('slow');
			jQuery('.sqb_multiple_url_select_time').hide();
			jQuery('.time-delay').hide();
			//jQuery('.tab-show-start-screen-settings').hide();
			//jQuery('.show-start-screen-settings').hide();
			//jQuery('.show-quiz-screen-setting').show();
			//jQuery('.show_start_screen').hide();
			jQuery('.popup-error-msg-time').hide();
			jQuery('.popup-error-msg-percentage').hide();
			sqb_get_pages_posts_url_list_html();
			var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
			if(show_start_screen){
				jQuery('.tab-show-start-screen-settings').show();
				jQuery('.show-start-screen-settings').show();
				jQuery('.show-quiz-screen-setting').hide();
			}else{
				jQuery('.tab-show-start-screen-settings').hide();
				jQuery('.show-start-screen-settings').hide();
				jQuery('.show-quiz-screen-setting').show();
			}
			jQuery('.embed-code-hide').show();
			jQuery('.embed-code-exit-show').hide();
		}else if(defaultpopup_type == 'exit'){
			jQuery('.time-based-outer').hide();
			jQuery('.percentage-based-outer').hide();
			jQuery('.popup-option-message').show();
			jQuery('.sqb_popup_position_outer').hide('slow');
			
			jQuery('.shortocde_details .timed-based-popup').hide();
			jQuery('.shortocde_details .exit-based-popup').show();
			jQuery('.shortocde_details .percentage-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();
			//jQuery('.entry_exit_page_urls').show('slow');
			jQuery('.sqb_multiple_url_select').show('slow');
			jQuery('.sqb_multiple_url_select_time').show();
			jQuery('.time-delay').hide();
			jQuery('.tab-show-start-screen-settings').hide();
			//jQuery('.show-start-screen-settings').hide();
			//jQuery('.show-quiz-screen-setting').show();
			//jQuery('.show_start_screen').hide();
			jQuery('.popup-error-msg-time').hide();
			jQuery('.popup-error-msg-percentage').hide();
			sqb_get_pages_posts_url_list_html();
			var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
			if(show_start_screen){
				jQuery('.tab-show-start-screen-settings').show();
				jQuery('.show-start-screen-settings').show();
				jQuery('.show-quiz-screen-setting').hide();
			}else{
				jQuery('.tab-show-start-screen-settings').hide();
				jQuery('.show-start-screen-settings').hide();
				jQuery('.show-quiz-screen-setting').show();
			}
			jQuery('.embed-code-hide').hide();
			jQuery('.embed-code-exit-show').show();
		}else{
			jQuery('.time-based-outer').hide();
			jQuery('.percentage-based-outer').hide();
			jQuery('.popup-option-message').show();
			jQuery('.sqb_popup_position_outer').hide('slow');
			
			jQuery('.shortocde_details .timed-based-popup').hide();
			jQuery('.shortocde_details .exit-based-popup').hide();
			jQuery('.shortocde_details .percentage-based-popup').hide();
			jQuery('.sqb_show_selected_page_popup').show();
			//jQuery('.entry_exit_page_urls').show('slow');
			jQuery('.sqb_multiple_url_select').show('slow');
			jQuery('.sqb_multiple_url_select_time').hide();
			jQuery('.time-delay').hide();
			jQuery('.tab-show-start-screen-settings').hide();
			jQuery('.show-start-screen-settings').hide();
			jQuery('.show-quiz-screen-setting').show();
			jQuery('.show_start_screen').hide();
			jQuery('.popup-error-msg-time').hide();
			jQuery('.popup-error-msg-percentage').hide();
			jQuery('.embed-code-hide').show();
			jQuery('.embed-code-exit-show').hide();
			sqb_get_pages_posts_url_list_html();
		}
	});

    jQuery(document).on('click','input[name="quiz_display"]',function(){
		var quiz_display = jQuery(this).val();
		jQuery('.responsive-screen-link').show();
		jQuery('.sqb_popup_position_outer').hide('slow');

		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type != 'poll'){
			jQuery('#container_template5').closest('li').show();
			jQuery('#container_template7').closest('li').show();
		}
		if((quiz_display == 'popup')){
			var template = jQuery('input[name="select_temp"]:checked').val();
			if(template == 'template6' && jQuery('#focus_mode').prop('checked') == true){
				swal('',"We notice that focus mode is enabled for this quiz - which means it's set to display full screen. Can't switch to popup in this mode. You can disable popup mode in the question screen and reduce width/height and then switch to popup.",'');
				return false;
			}

			var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
			jQuery("input[name='defaultpopup_type']:radio:first").prop("checked", true).trigger("click");
			jQuery('#show_start_screen').prop("checked", false);
			if(jQuery(this).val() == 'popup'){
				jQuery('#starttemplate1').trigger('click');
				jQuery('#startbtn_width').bootstrapSlider('setValue', 370);
				jQuery('#startbtn_height').bootstrapSlider('setValue', 20);
				setTimeout(function(){
					jQuery('#startbutton_backgroud_color_div, #startbutton_backgroud_color').colorpicker('setValue','rgba(255,208,46,1)');
				},500);
				jQuery('.show_start_screen').hide();
				if(quiz_type == 'form'){
					var popup_type =jQuery('input[name="popup_type"]:checked').val();
					if(popup_type == 'entry' || popup_type == 'exit'){
						jQuery('.form_quiz_shortcode').show();
						jQuery('.form-quiz-message').show();
						jQuery('input[name="popup_type"][value="popup"]').trigger('click');
					}
				}else{
					jQuery('.popup-options').show();
				}

				if(quiz_type == 'form'){

					jQuery('.show-form-quiz-option').show();
					jQuery('.template-ecommerce').hide();
					jQuery('.sqb_multiple_url_select_time').hide();
					jQuery('.sqb_multiple_url_select').hide();
					if(jQuery('#show_start_screen').prop('checked') == false){
						jQuery('#show_start_screen').trigger('click')
					}
				}else if(quiz_type == 'poll'){

				}else{
					jQuery('.quiz_slider_animation_div_display').hide('slow');
					
					jQuery('.allow_retake_quiz_outer').show('slow');
					if(jQuery('#allow_retake_quiz').prop('checked') == true){
						jQuery('.sqb_retak_option_outer').show('slow');
						if(jQuery('#sqb_retak_option').val() == 'Limited'){
							jQuery('.sqb_retak_max_attempt_outer').show('slow');
						} else {
							jQuery('.sqb_retak_max_attempt_outer').hide('slow');
						}
					} else {
						jQuery('.sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
					}
				}
				
			}
			jQuery('.quiz_pagination_outer').hide('slow');
			jQuery('.show_start_screen').show('slow');

			jQuery('.embed-code-hide').hide();
			jQuery('.embed-code-exit-show').show();
		}else{

			var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
			if(quiz_type == 'form'){
				jQuery('.show-lead-page-for-form-quiz-type').hide();
			}
			jQuery('#show_start_screen').prop("checked", true);
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
				if(selected_template == 'template8'){
					sqb_get_start_temp('template2', "start");
				}else if(selected_template == 'template5'){
					sqb_get_start_temp(selected_template, "start");
				}else{
					jQuery('#starttemplate2').trigger('click');
				}

			
			var selected_template = jQuery('input[name="select_temp"]:checked').val();


			if(selected_template == 'template6'){
				setTimeout(function(){
					jQuery('#startbutton_backgroud_color_div').colorpicker('setValue', '#ffda5c');
				},500);
			}else{
				setTimeout(function(){
					jQuery('#startbtn_width').bootstrapSlider('setValue', 700);
					jQuery('#startbtn_height').bootstrapSlider('setValue', 20);
					jQuery('#startbutton_backgroud_color_div, #startbutton_backgroud_color').colorpicker('setValue','rgba(255,208,46,1)');
				},500);
			}

			jQuery('.show-start-screen-settings').show();
			jQuery('.show-quiz-screen-setting').hide();

			var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
			if(show_start_screen){
				jQuery('.tab-show-start-screen-settings').show();
			}else{
				jQuery('.tab-show-start-screen-settings').hide();
			}

			jQuery('.sqb_multiple_url_select_time').hide();
			jQuery('.popup-options').hide();
			jQuery('.sqb_multiple_url_select').hide();
			jQuery('.popup-option-message').hide();
			jQuery('#Start-Screen-Settings-tab').show();
			jQuery('.entry_exit_page_urls').hide();
			jQuery('.show-form-quiz-option').hide();
			jQuery('.sqb_show_selected_page_popup').hide();
			var quiz_type =jQuery('input[name="quiz_type"]:checked').val();
			jQuery('.show_start_screen').show();
			if(quiz_type != 'form'){
				jQuery('.quiz_slider_animation_div_display').hide('slow');
				if(quiz_type == 'poll'){

				}else{
					jQuery('.allow_retake_quiz_outer').show('slow');
				}
				if(jQuery('#allow_retake_quiz').prop('checked') == true){
					jQuery('.sqb_retak_option_outer').show('slow');
					if(jQuery('#sqb_retak_option').val() == 'Limited'){
						jQuery('.sqb_retak_max_attempt_outer').show('slow');
					} else {
						jQuery('.sqb_retak_max_attempt_outer').hide('slow');
					}
				} else {
					jQuery('.sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
				}
				//jQuery('.allow_retake_quiz_outer, .sqb_retak_option_outer, .sqb_retak_max_attempt_outer').show('slow');
				if(quiz_type == 'poll'){

				}else{
					jQuery('.quiz_slider_animation_div_display').show('slow');
				}
				if(jQuery('input[name="select_temp"]:checked').val() == 'template7' || jQuery('input[name="select_temp"]:checked').val() == 'template5'){
					jQuery('.quiz_pagination_outer').hide('slow');
				} else {
					if(quiz_type == 'poll'){

					}else{
						jQuery('.quiz_pagination_outer').show('slow');
					}
				}

			}else{
				jQuery('.template-ecommerce').hide();
			}
			jQuery('.embed-code-hide').show();
			jQuery('.embed-code-exit-show').hide();
		}
		sqbhideshowpaginationoption();
	});
	
	jQuery(document).on('click','input[name="allow_retake_quiz"]',function(){
		if(jQuery(this).prop('checked') == true){
			jQuery('.sqb_retak_option_outer').show('slow');
		} else {
			jQuery('.sqb_retak_option_outer').hide('slow');
			jQuery('#sqb_retak_option option:first').prop('selected',true);
			jQuery('.sqb_retak_max_attempt_outer').hide('slow');	
		}
	});
	
	jQuery(document).on('change','#sqb_retak_option',function(){
		if(jQuery(this).val() == 'Limited'){
			jQuery('.sqb_retak_max_attempt_outer').show('slow');
		} else {
			jQuery('.sqb_retak_max_attempt_outer').hide('slow');
		}
	});
	
	
	
    jQuery(document).on('click','.sqb_save_global_template_setting',function(){
		jQuery('#use_global_style').val(jQuery(this).attr('data-value'));
		jQuery('#global_template_setting').find('.close').trigger('click');
	});
	
	if(jQuery('input[name="quiz_display"]:checked').val() == 'corner_popup') {
		jQuery('.allow_retake_quiz_outer, .sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
		jQuery('.quiz_pagination_outer').hide('slow');
		jQuery('.sqb_popup_position_outer').show('slow');
		jQuery('#container_template5').closest('li').hide();
		jQuery('#container_template7').closest('li').hide();
	}
	if(jQuery('input[name="quiz_display"]:checked').val() == 'popup') {
		jQuery('.quiz_slider_animation_div_display').hide('slow');
		var quiz_type =jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type != 'poll'){
			jQuery('.allow_retake_quiz_outer').show('slow');
		}
		if(jQuery('#allow_retake_quiz').prop('checked') == true){
			jQuery('.sqb_retak_option_outer').show('slow');
			if(jQuery('#sqb_retak_option').val() == 'Limited'){
				jQuery('.sqb_retak_max_attempt_outer').show('slow');
			} else {
				jQuery('.sqb_retak_max_attempt_outer').hide('slow');
			}
		} else {
			jQuery('.sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
		}
		//jQuery('.allow_retake_quiz_outer, .sqb_retak_option_outer, .sqb_retak_max_attempt_outer').hide('slow');
		jQuery('.quiz_pagination_outer').hide('slow');
	}
	
	if(jQuery('input[name="select_temp"]:checked').val() == 'template7'){
		jQuery('.quiz_pagination_outer').hide('slow');
	}
	
	if(jQuery("input[name='quiz_pagination']:checked").val() == 'all' || jQuery('input[name="quiz_display"]:checked').val() == 'corner_popup'){
		jQuery('#container_template5').closest('li').hide();
		jQuery('#container_template7').closest('li').hide();
	} else {
		jQuery('#container_template5').closest('li').show();
		jQuery('#container_template7').closest('li').show();
	}
	/*jQuery(document).on('change','input[name="quiz_display"]',function(){
		if(jQuery(this).val() == 'corner_popup'){
			jQuery('.sqb_popup_position_outer').show('slow');
		} else {
			jQuery('.sqb_popup_position_outer').hide('slow');
		}
	});*/ 
	
    jQuery(document).on('click',"input[name='quiz_pagination']",function(){
		if(jQuery(this).val() == 'all') {
			var checked_template = jQuery('input[name="select_temp"]:checked').val();
			if(checked_template == 'template5' || checked_template == 'template7'){
				swal("","Sorry, this template can only be used One question per page format",""); 
				return false;
			} else {
			jQuery('#container_template5').closest('li').hide();
			jQuery('#container_template7').closest('li').hide();
			jQuery('.interactive_video_template').hide();
			jQuery('.change_template_name').text('Template6');
			}
		} else {
			jQuery('.change_template_name').text('Template7');
			jQuery('.interactive_video_template').show();
			jQuery('#container_template5').closest('li').show();
			jQuery('#container_template7').closest('li').show();
		}
		sqbhideshowpaginationoption();
	});
	
	
	/*jQuery(document).on('change',"#quiz_slider_animation",function(){
		if(jQuery('#quiz_slider_animation').prop('checked') == true){
			var checked_template = jQuery('input[name="select_temp"]:checked').val();
			if(checked_template == 'template5'){
				swal("","Sorry, slide-in animation can not be used for this template",""); 
				jQuery('#quiz_slider_animation').prop('checked',false);
				return false;
			} else {
			jQuery('#container_template5').closest('li').hide();
			}
		} else {
			jQuery('#container_template5').closest('li').show();
		}
	});*/
	
 	jQuery(document).on('click','.save-ans-tags',function(){
 		var tag_name = jQuery('input[name="tag_name"]').val();
 		var tag_content = '';
 		if(tag_name == ''){
 			return false;
 		}
 		var ans_id = jQuery('.ans_id_in_tag').val();
 		SQBShowLoader();
 		jQuery.post(ajaxurl, {
			action: 'sqb_save_ans_tags',
			tag_name:tag_name,
			tag_content:tag_content,
			ans_id:ans_id,
			action_val:'save_ans_tag',
			}, function(response) {	
			response = JSON.parse(response);
			if(response['already_added']){
				swal("","This tag is already added","");
			}else{
				jQuery('#tag_name').val('');
				//tinymce.get('sqb_ans_tag_contents').setContent('');
			}
			jQuery('.answer_tags_wrapper .add_tag_form').hide();
			jQuery('.answer_tags_wrapper .existing-div-show-hide').hide();
 			show_ans_tag_sidepopup(ans_id);	
		});			
 	});

 	jQuery(document).on('click','.sqb-delete-tags',function(){
 		var tag_id = jQuery(this).attr('data-id');
 		var ans_id = jQuery('.ans_id_in_tag').val();
		
		SQBShowLoader();
 		jQuery.post(ajaxurl, {
			action: 'sqb_save_ans_tags',
			tag_id:tag_id,
			ans_id:ans_id,
			action_val:'delete_ans_tag',
			}, function(response) {	
			response = JSON.parse(response);
			show_ans_tag_sidepopup(ans_id);	
		});		

 	
 	});

 	jQuery(document).on('click', '.all_tag_data li', function(){ 		 
		jQuery(this).toggleClass('selected_tag_cls');
	});

 	jQuery(document).on('click','#quiz_recommendation_option',function(){
		if(jQuery(this).prop('checked')){
			if(jQuery('input[name="quiz_pagination"]:checked').val() == 'all' && jQuery('#Basic-Screen-Settings .quiz_pagination_outer').is(':visible')){
				swal("","Sorry, Content recommendation is not supported with pagination options","");
				return false;
			} else {

				jQuery('#Quiz-Screen-Settings .answer-options').each(function(index, value) {
				var count = jQuery(this).find('.answer_level_dot_button').length;
				if(count < 1){
					jQuery(this).append('<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "><button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation "><strong>Add Recommendation</strong></a></div></div></div>');
				}
			});

			jQuery('#Quiz-Screen-Settings .answer_level_dot_button').show();
			jQuery('#Quiz-Screen-Settings .add_ans_level_recommendation').show();
			
			jQuery('#Quiz-Screen-Settings.tab-pane').addClass('quiz_recommendation_enable');
			jQuery('#Basic-Screen-Settings .content-recommendation-child').show('slow');
			}
		}else{
			jQuery('#Quiz-Screen-Settings.tab-pane').removeClass('quiz_recommendation_enable');
			jQuery('#Basic-Screen-Settings .content-recommendation-child').hide('slow');
		}
 	});
	 
	/*---------------------------------------------------------------*/

	jQuery(document).on('click','#quiz_ads_option',function(){
		if(jQuery(this).prop('checked')){
			jQuery('#Basic-Screen-Settings .content-ads-child').show('slow');
			jQuery('.sqb-insert-ads').show();
			
		}else{
			jQuery('#Quiz-Screen-Settings.tab-pane').removeClass('quiz_recommendation_enable');
			jQuery('#Basic-Screen-Settings .content-ads-child').hide('slow');
			jQuery('.sqb-insert-ads').hide();
		}
 	});
	 
	/*---------------------------------------------------------------*/
	
	jQuery(document).on('click','#quiz_ans_tags',function(){
		if(jQuery(this).prop('checked')){
			if(jQuery('input[name="quiz_pagination"]:checked').val() == 'all' && jQuery('#Basic-Screen-Settings .quiz_pagination_outer').is(':visible')){
			swal("","Sorry, Content recommendation is not supported if this pagination options","");
				return false;
			} else {
				jQuery('#Quiz-Screen-Settings .answer-options').each(function(index, value) {
					var count = jQuery(this).find('.answer_level_dot_button').length;
					var ans_count = jQuery(this).find('.answer_level_dot_button .add-answer-tag').length;
					if(count < 1){
						jQuery(this).append('<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "><button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation "><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)"><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags"><strong>View All Assigned Tags</strong></a></div></div></div>');
					}else if(ans_count < 1){
						jQuery(this).find('.dropdown-menu').append('<a class="dropdown-item add-answer-tag" href=" javascript:void(0)"><strong>Add Tags</strong></a>');
					}
				});

				if(jQuery('#Basic-Screen-Settings #quiz_recommendation_option').prop('checked')){
					jQuery('.add_ans_level_recommendation').show();
				}else{
					jQuery('.add_ans_level_recommendation').hide();
				}

				jQuery('#Quiz-Screen-Settings.tab-pane').addClass('quiz_recommendation_enable');
				
				jQuery('#Quiz-Screen-Settings .answer_level_dot_button').show();
				jQuery('.add-answer-tag').show();
				}
				jQuery('.tags-width').show();
				jQuery('.view-all-tags').show();
		}else{
			jQuery('.tags-width').hide();
			jQuery('.add-answer-tag').hide();
			jQuery('.view-all-tags').hide();
		}
	});
	/*----------------------------------------------------------*/

	jQuery(document).on('click','.add-answer-tag',function(){
	 	

	 	var answer_id = jQuery(this).closest('.sqb_ans_item').attr('data-id');
		if(Math.floor(answer_id) == answer_id && jQuery.isNumeric(answer_id)) {
			jQuery('.answer_tags_wrapper').addClass('active_Side_Popup');
		 	jQuery('.answer_tags_wrapper').show();
		 	jQuery('body').addClass('sidepopup-active');

			jQuery('.ans_id_in_tag').val(answer_id);
			jQuery('.answer_tags_wrapper .add_tag_form').hide();
			jQuery('.answer_tags_wrapper .existing-div-show-hide').hide();
			
			var answer_choice = jQuery(this).closest('.sqb_ans_item').find('.sql_ans_text').text();
			setTimeout(function(){
			jQuery('.answer_tags_wrapper .cr_question_title').html('<strong>Answer Title:</strong> '+answer_choice);
			}, 500);
			
			SQBShowLoader();
			show_ans_tag_sidepopup(answer_id);
		}else{
			swal("","Please save Question.","");
			return false;
		}
 	});



	 /*------------*/
	jQuery(document).on('click','.popup_answer_tags_save_btn',function(){
		var tags_ids =  jQuery('.selected_tag_cls').map(function(i,n) {
			return jQuery(n).attr('data-tag-id');
		}).get().join(',');
		
		if(tags_ids == ''){
		return false;
		}
		
		SQBShowLoader();
		var ans_id = jQuery('.ans_id_in_tag').val();
		jQuery.post(ajaxurl, {
			action: 'sqb_save_ans_tags_in_ans_tb',
			ans_id:ans_id,
			tags_ids:tags_ids,			
			}, function(response) {
				response = JSON.parse(response);
				jQuery('.answer_tags_wrapper .add_tag_form').hide();
				jQuery('.answer_tags_wrapper .existing-div-show-hide').hide();
				show_ans_tag_sidepopup(ans_id);
		});

	});
	 /*------------------------------------------------------*/

	jQuery(document).on('click','#show_next_button',function(){
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type == "scoring" || quiz_type == "assessment"){
			var display_correctans_on_page = jQuery('input[name="display_correctans_on_page"]:checked').val();
			if(display_correctans_on_page == "yes"){
				var correct_answer = jQuery("select[name='display_correctans_options'] option:selected").val();
				if(correct_answer == 'both'){
					jQuery('.show_next_answer_correct_message').text('You cannot turn off the next button because you have selected to display correct answer on each page and on the final page');
					jQuery('.show_next_answer_correct_message').show('slow');
					return false;
				}else if(correct_answer == 'each_page'){
					jQuery('.show_next_answer_correct_message').text('You cannot turn off the next button because you have selected to display correct answer on each page');
					jQuery('.show_next_answer_correct_message').show('slow');
					return false;
				}
			}
			
		}

		jQuery('.show_next_answer_correct_message').hide('slow');

		var template = jQuery('input[name="select_temp"]:checked').val();
		if(jQuery(this).prop('checked')){
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.continue-question-action').show();
		} else {

			if(jQuery("#show_back_button").prop('checked') == true && jQuery("input[name='back-button-change']:checked").val() == 'notallow'){
				jQuery(this).prop('checked',true);
			}
			//if(template == 'template7'){
				jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.continue-question-action').hide();
				jQuery('#Quiz-Screen-Settings .sqb_question_no').each(function( index ) {
				var question_type = jQuery(this).find('.question_type_wrapper').find('.dropdown-custom-style .dropdown-toggle').attr('data-value'); 
					if(question_type == 'single' || question_type == 'yes_no'){
						jQuery(this).find('.continue-question-action').hide();
					} else {
						jQuery(this).find('.continue-question-action').show();
					}
				});
			//}
		}
	});
	 
	jQuery(document).on('click', '#Start-Screen-Settings-tab', function(){
		sqbv2_start_screen_customizers();
	});

	jQuery(document).on('click', '#Result-Screen-Settings-tab', function(){
		sqbv2_result_screen_customizers();
	});

	jQuery(document).on('click', '#Quiz-Screen-Settings-tab', function(){
		sqbv2_question_screen_customizers();
	});

	jQuery(document).on('click', '#Opt-Screen-Settings-tab', function(){
		sqbv2_lead_screen_customizers();
	});

	

    jQuery(document).on('click','.question_type_list_ul li a',function(){
    	var selected_template = jQuery('input[name="select_temp"]:checked').val();
    	if(selected_template == 'template6' || selected_template == 'template7' || selected_template == 'template8' || selected_template == 'template9'){
    		var already_selected_question_type = jQuery('.sqb_question_no.active').find('.template8_question_screen_setting_options_wrapper .question-type-card .dropdown-toggle').attr('data-value');
    	}else{
 			var already_selected_question_type = jQuery('.sqb_question_no.active').find('.dropdown-toggle').attr('data-value');
    	}

		var this_obj_main = this;
		
		var already_added_answer = jQuery(this).closest('.question_div_inner').find('.sqb_ans_item').length;
		var question_id = jQuery(this).closest('.question_div_inner').find('.sqb_question_enable_drag_drop').attr('data-id');
		var question_outer_selector_id  = jQuery(this).closest('.question_div_outer').attr('id');
		
		var get_ques_type = jQuery(this).attr('value');
		var flag = '';
		jQuery('.card.sqb_question_no').each(function(){
			if(selected_template == 'template1' || selected_template == 'template2' || selected_template == 'template3' || selected_template == 'template4'){
				var ques_type_number = jQuery(this).find('.question-screen .question_drop_down_wrapper .question-type-card.question_type_wrapper .dropdown-toggle').attr('data-value');
			}else{
				var ques_type_number = jQuery(this).find('.question_drop_down_wrapper .question-type-card.question_type_wrapper .dropdown-toggle').attr('data-value');
			}
			if(ques_type_number == 'name' && get_ques_type == 'name'){
				swal('You already have a name quesiton type. You can add the "name" question type only once in the quiz.');
				flag = 1;
			}
		});

		if(flag == 1){
			return false;			
		}

		var already_added_answer = jQuery(this).closest('.question_div_inner').find('.sqb_ans_item').length;
		if(jQuery(this).attr('value') == 'weight_and_height' || jQuery(this).attr('value') == 'name' || jQuery(this).attr('value') == 'text' || jQuery(this).attr('value') == 'matching_text' || jQuery(this).attr('value') == 'date' || jQuery(this).attr('value') == 'slider' || jQuery(this).attr('value') == 'matrix' || jQuery(this).attr('value') == 'rating' || jQuery(this).attr('value') == 'yes_no' || jQuery(this).attr('value') == 'numerical_text' || jQuery(this).attr('value') == 'dropdown'){
			
				jQuery(this).closest('.question_div_inner').find('.question_add_more_ans_btn').hide(''); 
			
		}else{
			jQuery(this).closest('.question_div_inner').find('.question_add_more_ans_btn').css('display','inline-block'); 
			jQuery(this).closest('.question_div_inner').find('.question_add_more_ans_btn').removeClass('hide-add-answer'); 
		}
		
		if((jQuery(this).attr('value') == 'matrix') && jQuery(this).closest('.question_type_wrapper').hasClass('answer-type-matrix-selected')){
			already_added_answer = 1;
		}
		
		if(jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').hasClass('answer_type_email')){
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').html('');	
		}

		if(jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').hasClass('answer_type_phone')){
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').html('');	
		}

		if(jQuery(this).attr('value') == 'email'){
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').addClass('answer_type_email');
		} else if(jQuery(this).attr('value') == 'phone_number'){
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').addClass('answer_type_phone');
		}else{
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').removeClass('answer_type_phone');
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').removeClass('answer_type_email');
		}

		if((already_selected_question_type == 'single' && jQuery(this).attr('value') == 'multi') || (already_selected_question_type == 'multi' && jQuery(this).attr('value') == 'single') ){
			already_added_answer = 0;
			if(selected_template == 'template9'){
				jQuery('.Quiz-Template9-right-inner').attr('class', 'Quiz-Template9-right-inner');
				jQuery('.Quiz-Template9-right-inner').addClass('answer_type_'+jQuery(this).attr('value'));
			}
		}
		
		if(already_added_answer == 1){  
			jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').html('');
			jQuery("#"+question_outer_selector_id).find('.assessment_outcome_connect').html('');
			if(!isNaN(question_id)){
				if(jQuery(this).attr('value') != 'file_upload' && jQuery(this).attr('value') != 'matrix'){
				sqb_answer_delete_by_question_id(question_id, question_outer_selector_id);
				}
			}	
		}

		if(already_added_answer > 1){

			var branching_message = '';
			if(jQuery('input[name="enable_branching"]').prop('checked')){
				branching_message = ' You also need to update your funnel settings in the SQB >> Quiz Funnels page';
			}
			var this_obj = this;
			swal({
				text: "Are you sure you want to switch to a different type? If you do, you'll lose the other answers you have already added for this question. "+branching_message,
				
				title: "",
				//type: "warning",
				showCancelButton: true,
				showCloseButton: true,
				confirmButtonColor: "#24bd92",
				confirmButtonText: "Yes!",
				customClass: '',		
				}).then((result) => {  
					if (result.value) {

						if(selected_template == 'template9'){
							jQuery('.Quiz-Template9-right-inner').attr('class', 'Quiz-Template9-right-inner');
							jQuery('.Quiz-Template9-right-inner').addClass('answer_type_'+jQuery(this).attr('value'));
						}

						jQuery("#"+question_outer_selector_id).find('.question_add_answer_outer_div').html('');
						jQuery("#"+question_outer_selector_id).find('.assessment_outcome_connect').html('');
						jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hide();
						jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').removeClass('answer_edit_text');
						
						jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper .outcome-option-connect').trigger('click');
						if(!isNaN(question_id)){
								
								sqb_answer_delete_by_question_id(question_id, question_outer_selector_id);
                          }// if loop closed 	 
							var value = jQuery(this_obj).attr('value');
							var text = jQuery(this_obj).text();
							var question_icon = jQuery(this_obj).parent('li').find('img').attr('src');
							if(question_icon){
								var question_icon_text = '<img src="'+question_icon+'">'+text;
							}else{
								var question_icon_text = text;
							}

							if(value == 'multi'){
								jQuery('.sqb_question_no.active').find('.sqb_ans_multiple').show();
							}else{
								jQuery('.sqb_question_no.active').find('.sqb_ans_multiple').hide();
							}
							var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
							jQuery(this_obj).closest('ul').find('a').removeClass('active');
							jQuery(this_obj).addClass('active');
							jQuery(this_obj).closest('.question_type_wrapper').find('.dropdown-custom-style button.dropdown-toggle').html(question_icon_text).attr('data-value',value);
							jQuery(this_obj).parents('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').html(question_icon_text).attr('data-value',value);

							if((quiz_type == 'personality') && ((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating'))){
								jQuery(this_obj_main).closest('.question_div_inner').find('.personality_outcome_connect_btn').show();
							}else if(quiz_type == 'survey'){
								jQuery(this_obj).closest('.personality_outcome_connect_btn').hide();
							}else{
								jQuery(this_obj).closest('.personality_outcome_connect_btn').show();
							}

							if((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating') || (value == 'text') || (value == 'matching_text') || (value == 'email') || (value == 'phone_number')|| (value == 'weight_and_height') || (value == 'name') || (value == 'date') || (value == 'file_upload') || (value == 'slider') || (value == 'matrix')  || (value == 'ranking_choices') || (value == 'fill_in_blank') || (value == 'numerical_text')){
								
								if(value == 'single' || value == 'multi'){
									jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
									
									if(jQuery('[name="select_temp"]:checked').val() == 'template7'){
										jQuery('.sqb_question_no.active').find('ul.question_layout_type_list_ul').find("[value='four_column']").trigger('click');
										jQuery('.sqb_question_no.active').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked',true);
										jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').addClass('image_option_has');
									}
									
									if(jQuery('.sqb_question_no.active').find('[name=sqb_ans_with_img_checkbox]').prop('checked') && jQuery('[name="select_temp"]:checked').val() == 'template7'){
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
									}
									if(jQuery('[name="select_temp"]:checked').val() == 'template8'){
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
										jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
									}
								}
								if(value == 'matching_text'){
									if(jQuery('[name="select_temp"]:checked').val() == 'template7'){
										jQuery('.sqb_question_no.active').find('ul.question_layout_type_list_ul').find("[value='one_column']").trigger('click');
									}
								}
						
							}
							
							if((value == 'yes_no' || value == 'text' || value == 'matching_text' || (value == 'email') || (value == 'phone_number') || (value == 'weight_and_height') || (value == 'name') || value == 'date' || value == 'slider' || value == 'matrix' || value == 'fill_in_blank' || value == 'numerical_text' || value == 'ranking_choices' || value == 'rating') && jQuery('[name="select_temp"]:checked').val() == 'template7'){
									jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
										setTimeout(function(){
											if(value == 'rating'){	 
												jQuery('.sqb_question_no.active').find('ul.question_layout_type_list_ul').find("[value='one_column']").trigger('click');
												jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').removeClass('image_option_has');
												jQuery('.sqb_question_no.active').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked',false);
											}
											if(value == 'slider' || value == 'text' || (value == 'email') || (value == 'phone_number') || (value == 'weight_and_height')
												|| (value == 'name') ||  value == 'date' || value == 'matrix' || value == 'numerical_text' || value == 'fill_in_blank'){	
												jQuery('.sqb_question_no.active').find('ul.question_layout_type_list_ul').find("[value='two_column']").trigger('click');
											}
											
										}, 50);
							}
								
							if(value == 'yes_no' || value == 'text' || (value == 'email') || (value == 'phone_number') || (value == 'weight_and_height') || (value == 'name') || value == 'matching_text' || value == 'date' || value == 'slider' || value == 'matrix' || value == 'fill_in_blank' || value == 'numerical_text' || value == 'ranking_choices' || value == 'dropdown'){
								jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
							}
							if(value == 'file_upload'){
								jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
							}	
							if(value == 'rating'){
								jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
								jQuery(this_obj).closest('.question_div_inner').find('.add_more_rating_btn').show(); 
								jQuery(this_obj).closest('.question_div_inner').find('.question_rating_lable_div').show();
								
								if(jQuery('[name="select_temp"]:checked').val() == 'template8'){
								jQuery(this).closest('.question_div_inner').find('.Quiz-Template').find('.question_add_answer_outer_div').addClass('grid-layout-active layout-five-in-row-active').css('max-width','1200px');
								jQuery(this).closest('.question_div_inner').find('.Quiz-Template').find('.question_rating_lable_div').css('max-width','1200px'); 
								jQuery('.template8_question_screen_setting_options_wrapper').find('.question-select-layout').attr('data-value','five_column').text('5 Columns');
								jQuery("#question_temp_inner_width").bootstrapSlider('setValue', 1200);
								jQuery('.question_temp_inner_width_val').val(1200);
								}

							}else{
								jQuery(this_obj).closest('.question_div_inner').find('.add_more_rating_btn').hide(); 
								jQuery(this_obj).closest('.question_div_inner').find('.question_rating_lable_div').hide(); 
							}

							if(value == 'matrix' && jQuery('[name="select_temp"]:checked').val() == 'template8'){
								jQuery("#question_temp_inner_width").bootstrapSlider('setValue', 1200);
								jQuery("#question_temp_inner_width").change();
								jQuery('.question_temp_inner_width_val').val(1200);
							}
							
							if(value == 'slider'){
								jQuery(this_obj).closest('.question_div_inner').find('.ans_layout_div').hide(); 
							}
							
							if(jQuery('input[name="select_temp"]:checked').val() == 'template7'){
								if((value == 'single' || value == 'yes_no') && jQuery('#show_next_button').prop('checked') == false){
									jQuery('.sqb_question_no.active').find('.continue-question-action').hide();
								} else {
									jQuery('.sqb_question_no.active').find('.continue-question-action').show();
								}
							}

							if((quiz_type == 'personality') && ((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating'))){
								jQuery(this_obj_main).closest('.question_div_inner').find('.personality_outcome_connect_btn').show();
							}
							var select_temp = jQuery('input[name="select_temp"]:checked').val();	
							var selected_ques_type = jQuery(this).attr('value');
							if((select_temp == "template1" || select_temp == "template2" || select_temp == "template3" || select_temp == "template4") && (selected_ques_type != 'email' && selected_ques_type != 'phone_number')){
								var background_color = jQuery('#temp_one_to_four_answer_backgroud_color').val();
								jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div .sqb_ans_item').css('background', background_color);	
							}

					}else{
						jQuery(this_obj_main).closest('.question_div_inner').find('.personality_outcome_connect_btn').hide();
					}
			});	
			
		}else{
		var value = jQuery(this).attr('value');
			
		if(jQuery(this).attr('value') == 'multi'){
			jQuery('.sqb_question_no.active').find('.sqb_ans_multiple').show();
		}else{
			jQuery('.sqb_question_no.active').find('.sqb_ans_multiple').hide();
		}

		var text = jQuery(this).text();
		var question_icon = jQuery(this).parent('li').find('img').attr('src');
		if(question_icon){
			var question_icon_text = '<img src="'+question_icon+'">'+text;
		}else{
			var question_icon_text = text;
		}
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		jQuery(this).closest('ul').find('a').removeClass('active');
		jQuery(this).addClass('active');
		jQuery(this).closest('.question_type_wrapper').find('.dropdown-custom-style button.dropdown-toggle').html(question_icon_text).attr('data-value',value);


		jQuery(this).parents('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').html(question_icon_text).attr('data-value',value);

		if(quiz_type == 'personality' && ((value != 'multi') || (value != 'single') || (value != 'yes_no') || (ques_type == 'rating') || (value == 'file_upload') || (value == 'matrix'))){
			jQuery(this).closest('.personality_outcome_connect_btn').show();
		}else if(quiz_type == 'survey'){
			jQuery(this).closest('.personality_outcome_connect_btn').hide();
		}else{
			jQuery(this).closest('.personality_outcome_connect_btn').show();
		}

		if((value != 'multi') || (value != 'single') || (value != 'yes_no') || (ques_type == 'rating') || (value == 'file_upload')){
			if(value == 'file_upload'){
			jQuery.post(ajaxurl, {
						action: 'sqb_quiz_check_file_upload_server_config',
						async:false,
						}, function(response) {	
						response = JSON.parse(response);
						if(response.status){
							jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
							jQuery('.sqb_question_no.active').find('.question_add_more_ans_btn').text('Add Supported File Types');
						} else {
							jQuery(".sqb_question_no.active .question_type_list_ul li a").first().trigger('click');
							swal("","File upload will not work on your server as requires extentions (fileinfo.so and php_fileinfo.dll) are not activated on your server. If you want to use this feature, please contact your webhost and have them enable it in the php.ini settings.","");
							return false;
						}
					});
			} else {

				if(value == 'single' || value == 'multi'){
					jQuery('.sqb_question_no.active .sqb_ans_item').each(function(){
						var check_exist = jQuery(this).find('.answer_level_dot_button .add-other-option').length;
						if(check_exist == 0){
							jQuery(this).find('.dropdown-menu').prepend('<span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div>');
						}
					});
				}
				var already_added_answer = jQuery(this).closest('.question_div_inner').find('.sqb_ans_item').length;
				if(already_added_answer == 0){
					jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
					jQuery('.sqb_question_no.active').find('.question_add_more_ans_btn').text('Add New Answer');
				}
			}
		}
		
		if(value == 'yes_no' || value == 'text' ||  value == 'matching_text' || (value == 'email') || (value == 'phone_number') || (value == 'weight_and_height') || (value == 'name')  || value == 'date' || value == 'slider' || value == 'matrix' || value == 'fill_in_blank' || value == 'numerical_text' || value == 'ranking_choices' || value == 'dropdown'){
					jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
		}
		
		if(value == 'rating'){
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			//jQuery(this).closest('.question_div_inner').find('.ans_layout_div').hide(); 
			jQuery(this).closest('.question_div_inner').find('.add_more_rating_btn').show(); 
			jQuery(this).closest('.question_div_inner').find('.question_rating_lable_div').show(); 
			
			if(jQuery('[name="select_temp"]:checked').val() == 'template8'){
			jQuery(this).closest('.question_div_inner').find('.Quiz-Template').find('.question_add_answer_outer_div').addClass('grid-layout-active layout-five-in-row-active').css('max-width','1200px'); 
			jQuery(this).closest('.question_div_inner').find('.Quiz-Template').find('.question_rating_lable_div').css('max-width','1200px');
			jQuery('.template8_question_screen_setting_options_wrapper').find('.question-select-layout').attr('data-value','five_column').text('5 Columns');
			jQuery("#question_temp_inner_width").bootstrapSlider('setValue', 1200);
			jQuery('.question_temp_inner_width_val').val(1200);
			}
								
		}else{
			//jQuery(this).closest('.question_div_inner').find('.ans_layout_div').show();
			jQuery(this).closest('.question_div_inner').find('.add_more_rating_btn').hide(); 
			jQuery(this).closest('.question_div_inner').find('.question_rating_lable_div').hide(); 
		}
		if((quiz_type == 'personality') && ((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating'))){
			if((jQuery('.sqb_question_no.active .personality_outcome_connect_btn').find('.outcome-option-active').hasClass('outcome-option-connect')) && (jQuery('.sqb_question_no.active assessment_outcome_connect_wrapper').hasClass('answer_edit_text'))){
				
				jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').show();
				jQuery('.sqb_question_no.active').find('.personality_outcome_connect_btn .outcome-option-connect').trigger('click');
			}else{
				jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hide();
			}
		}else{
			jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hide()
		}
	}
	var value = jQuery(this).attr('value');	
	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
	if((quiz_type == 'scoring') || (quiz_type == 'assessment')){
		if(jQuery('input[name="quiz_category_enable"]:checked').val() == 'Y'){
			if((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating') || (value == 'matrix') || (value == 'slider')){
				jQuery('.sqb_question_no.active .quiz_category_type_wrapper').css('display','flex');
			} else {
				jQuery('.sqb_question_no.active .quiz_category_type_wrapper').css('display','none');
			}
		} else {
			jQuery('.sqb_question_no.active .quiz_category_type_wrapper').css('display','none');
		}
	}
	
	if(value == 'file_upload'){
		jQuery('.sqb_question_no.active').find('.question_add_more_ans_btn').text('Add Supported File Types');
	} else {
		jQuery('.sqb_question_no.active').find('.question_add_more_ans_btn').text('Add New Answer');
	}
	
	if(value == 'ranking_choices'){
		jQuery('.sqb_question_no.active').find('.dropdown.dropdown-custom-style').css('position','relative');
		var tool_tip_content = '<div class="tool-tip answer_type_tool_tip"><i class="fa fa-info-circle" aria-hidden="true"></i><div class="toll-tip-desc">Your users can re-order the answers choices based on their preference using a drag/drop interface in the frontend.</div></div>';
		jQuery(tool_tip_content).insertAfter(".sqb_question_no.active .question_type_list_ul");
	} else {
		jQuery('.sqb_question_no.active').find('.dropdown.dropdown-custom-style').attr('style','');
		jQuery('.sqb_question_no.active').find('.answer_type_tool_tip').remove();
	}
	//for matrix type question set the width more
	if(value == 'matrix'){
		jQuery('.ques_ans_contain  #question_temp_width').bootstrapSlider('setValue', 800);
		//jQuery('.sqb_question_no.active').css('max-width', '800px');
	}

	if(value == 'fill_in_blank' || value == 'dropdown'){
		jQuery('.sqb_question_no.active .question_add_more_ans_btn').hide();
	}
	
	var selected_template = jQuery('input[name="select_temp"]:checked').val();

	if(value == 'matching_text' && selected_template == "template8"){
		jQuery('.sqb_question_no.active .question_add_answer_outer_div').css('max-width', '740px');
		jQuery('#question_temp_inner_width').bootstrapSlider('setValue', 740);
		jQuery('.question_temp_inner_width_val').val(1200);
	}

	jQuery('.sqb_question_no.active').find('.personality_outcome_connect_btn .outcome-option-skip').click();

	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
	if((quiz_type == 'personality') && ((value == 'single') || (value == 'multi') || (value == 'yes_no') || (value == 'rating'))){
		setTimeout(function(){
			jQuery(this_obj_main).closest('.question_div_inner').find('.personality_outcome_connect_btn').show();
			},100);
	}else{
		setTimeout(function(){
			jQuery(this_obj_main).closest('.question_div_inner').find('.personality_outcome_connect_btn').hide();
		},100);
	}

		var select_temp = jQuery('input[name="select_temp"]:checked').val();	
		var selected_ques_type = jQuery(this).attr('value');
		if((select_temp == "template1" || select_temp == "template2" || select_temp == "template3" || select_temp == "template4") && (selected_ques_type != 'email' && selected_ques_type != 'phone_number')){
			var background_color = jQuery('#temp_one_to_four_answer_backgroud_color').val();
			jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div .sqb_ans_item').css('background', background_color);	
		}

	if(jQuery('#show_next_button').prop('checked') == true){
		jQuery('.sqb_question_no.active').find('.continue-question-action').show();
	}else if(value == 'multi' || value == 'text' || value == 'numerical_text' || value == 'date' || value == 'file_upload' || value == 'slider'|| value == 'dropdown' || value == 'complete-the-sentence' || value == 'email' || value == 'phone_number' || value == 'weight_and_height' || value == 'name'){
		jQuery('.sqb_question_no.active').find('.continue-question-action').show();
	}else{
		jQuery('.sqb_question_no.active').find('.continue-question-action').hide();
	}

});   
	
      
	
     jQuery('input[name="quiz_scoring_enable_personality"]').on('click',function(){
		var quiz_types = jQuery('input[name="quiz_type"]:checked').val();
		if(jQuery(this).prop('checked') && (quiz_types == 'assessment' || quiz_types == 'scoring' || quiz_types == 'personality')){
			jQuery('.Quiz-Template.quiz_comon_template.outer-style8').addClass('scoring-fields-visible');
		}else{
			jQuery('.Quiz-Template.quiz_comon_template.outer-style8').removeClass('scoring-fields-visible');
		}

		 if(jQuery(this).prop('checked')){
			 jQuery('.tab-pane#Quiz-Screen-Settings').addClass('personality_scoring_show');
		 }else{
			 jQuery('.tab-pane#Quiz-Screen-Settings').removeClass('personality_scoring_show');
		 	 
		 }
	 });
     jQuery('input[name="quiz_type"]').on('click',function(){
     	
		jQuery('.question_add_answer_outer_div.sqb_question_drag_drop_item').removeClass('sqb_points_active');
		jQuery('.send_top_outcomes_btn').hide('slow');
		jQuery('.showHideQueTypeOption_assessment_scoring').show();
		jQuery('.quiz_type_personality_show_div').hide();
		if(jQuery(this).prop('checked') && (jQuery(this).val() == "assessment")){
			jQuery('.showHideQueTypeOption').hide('slow');
			jQuery('.question_type_wrapper').show('slow');
			jQuery('.ans_poins_outer_wrapper').hide('slow');
			jQuery('.personality_outcome_connect_btn').hide('slow');
			jQuery('.assessment_outcome_connect_wrapper').hide('slow');
			if(jQuery('input[name="display_correctans_on_page"]:checked').val() == 'yes'){  
				jQuery('.sqb_is_right_ans_checkbox_outer').show('slow');	
			}else{
				jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');	
			}
			jQuery('.showHideQueTypeOption_assessment_scoring').hide('slow');
			jQuery('.show_back_button_outer').hide();
			jQuery('.outcome_rank_rules').hide();
			jQuery('#show_next_button').prop('checked', true);
			jQuery('.sqb-correct-answer-text').text('Correct Answer');
		}else if(jQuery(this).prop('checked') && (jQuery(this).val() == "scoring")){	
			jQuery('.showHideQueTypeOption').hide('slow');
			jQuery('.question_type_wrapper').show('slow');
			jQuery('.ans_poins_outer_wrapper').show('slow');
			if(jQuery('input[name="display_correctans_on_page"]:checked').val() == 'yes'){  
				jQuery('.sqb_is_right_ans_checkbox_outer').show('slow');	
			}else{
				jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');	
			}
			jQuery('.personality_outcome_connect_btn').hide('slow');
			jQuery('.question_add_answer_outer_div.sqb_question_drag_drop_item').addClass('sqb_points_active');
			jQuery('.showHideQueTypeOption_assessment_scoring').hide('slow')
			jQuery('.show_back_button_outer').show();
			jQuery('.outcome_rank_rules').hide();
			jQuery('#show_next_button').prop('checked', true);
			jQuery('.sqb-correct-answer-text').text('Number');
		}else if(jQuery(this).prop('checked') && (jQuery(this).val() == "personality")){
			jQuery('.quiz_type_personality_show_div').show();
			jQuery('.question_type_wrapper').show('slow');
			jQuery('.showHideQueTypeOption').hide('slow');
			jQuery('.personality_outcome_connect_btn').show('slow');	
			jQuery('.ans_poins_outer_wrapper').hide('slow');
			jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');
			jQuery('.show_back_button_outer').show();
			if(jQuery('input[name="add_user_in_your_email_platform"][value="ACTIVECAMPAIGN"]').prop('checked')){
				jQuery('.send_top_outcomes_btn').show('slow');
			}
			jQuery('.outcome_rank_rules').css('display', 'inline-block');
		}else if(jQuery(this).prop('checked') && (jQuery(this).val() == "survey")){
			jQuery('.question_type_wrapper').show('slow');
			jQuery('.showHideQueTypeOption').show('slow');
			jQuery('.ans_poins_outer_wrapper').hide('slow');
			jQuery('.personality_outcome_connect_btn').hide('slow');	
			jQuery('.assessment_outcome_connect_wrapper').hide('slow');	
			jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');
			setTimeout(function(){
				jQuery('.quiz_cate_rule').hide();
				jQuery('.show-quiz-screen-setting').hide();
			},3000);
			jQuery('.show_back_button_outer').hide();
			jQuery('.outcome_rank_rules').hide();
		}else if(jQuery(this).val() == "calculator"){
			setTimeout(function(){
				jQuery('.show-quiz-screen-setting').hide();
			},3000);
			jQuery('.showHideQueTypeOption').hide('slow');
			jQuery('.ans_poins_outer_wrapper').show('slow');
			jQuery('.personality_outcome_connect_btn').hide('slow');	
			jQuery('.assessment_outcome_connect_wrapper').hide('slow');	
			jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');
			jQuery('.showHideQueTypeOption_assessment_scoring').hide('slow');
			jQuery('.show_back_button_outer').hide();
			jQuery('.outcome_rank_rules').hide();
		}else{
			jQuery('.showHideQueTypeOption').hide('slow');
			//jQuery('.question_type_wrapper').hide('slow');
			jQuery('.ans_poins_outer_wrapper').hide('slow');
			jQuery('.personality_outcome_connect_btn').hide('slow');	
			jQuery('.assessment_outcome_connect_wrapper').hide('slow');	
			jQuery('.sqb_is_right_ans_checkbox_outer').hide('slow');
			jQuery('.show_back_button_outer').hide();
			jQuery('.outcome_rank_rules').hide();
		}
	}); 
	 
	jQuery(document).on('click','.select_outcome_result_list',function(){
		
		jQuery(this).closest('.select_outcome_result_wrapper').find('.outcome_result_list').toggle('slow');
	});
		
	jQuery(document).on('click','.ans_layout_typw',function(){
		jQuery(this).closest('.question_div_inner').find('.ans_layout_typw').removeClass('selected-op');
		jQuery(this).addClass('selected-op');
		if(jQuery(this).hasClass('sqb_ans_layout_mulitple')){
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('layout-three-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('standard');
			var sqb_ans_with_img_checkbox = jQuery(this).closest('.question_div_outer').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
			if(sqb_ans_with_img_checkbox){
				jQuery(this).closest('.question_div_outer').find('.sqb-ans-image-options').find('.sqb-image-text-on-off').show();
				jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('.sql_ans_text').show();
				if(jQuery(this).closest('.question_div_inner').find('input[name="sqb_ans_show_label"]').prop("checked")){
					jQuery(this).closest('.question_div_inner').find('input[name="sqb_ans_show_label"]').trigger("click");
				}
			}
		}else if(jQuery(this).hasClass('sqb_ans_layout_three_in_row')){
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-three-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-three-in-row');
			var sqb_ans_with_img_checkbox = jQuery(this).closest('.question_div_outer').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
			
			if(sqb_ans_with_img_checkbox){
				jQuery(this).closest('.question_div_outer').find('.sqb-ans-image-options').find('.sqb-image-text-on-off').show();
				jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('.sql_ans_text').show();
			}
		}else{
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('grid-layout-active');
			}
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('layout-three-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('multiple');
			var sqb_ans_with_img_checkbox = jQuery(this).closest('.question_div_outer').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
			
			if(sqb_ans_with_img_checkbox){
				jQuery(this).closest('.question_div_outer').find('.sqb-ans-image-options').find('.sqb-image-text-on-off').hide();
			}
		}
			
	});
	
	jQuery(document).on('click','.outcome_layout_type_list_ul li a',function(){
		
		if(jQuery(this).attr('value') == 'one'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').removeClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').removeClass('layout-three-in-row-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('multiple');
		} else if(jQuery(this).attr('value') == 'two'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('standard');
		} else if(jQuery(this).attr('value') == 'three'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('layout-three-in-row-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-three-in-row');
		} else if(jQuery(this).attr('value') == 'four'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('layout-four-in-row-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-four-in-row');
		} else if(jQuery(this).attr('value') == 'five'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('layout-five-in-row-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-five-in-row');
		} else if(jQuery(this).attr('value') == 'six'){
			jQuery(this).closest('.Quiz-Template-content').find(".question_add_answer_outer_div").removeClass(function (index, css) { return (css.match (/(^|\s)layout-\S+/g) || []).join(' '); });
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').addClass('layout-six-in-row-active');
			jQuery(this).closest('.Quiz-Template-content').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-six-in-row');
		}
		var value = jQuery(this).attr('value');
		var text = jQuery(this).text();
		jQuery(this).closest('.Quiz-Template-content').find('.outcome-select-layout').text(text).attr('data-value',value);
	});
	
	jQuery(document).on('click','.question_layout_type_list_ul li a',function(){
		
		if(jQuery(this).attr('value') == 'one_column'){

			if(jQuery('#sqb_template_selected').val() == 'template6'){
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_standard').addClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_mulitple').removeClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_three_in_row').removeClass('selected-op');
			}


			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('layout-three-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('multiple');
		} else if(jQuery(this).attr('value') == 'two_column'){
			if(jQuery('#sqb_template_selected').val() == 'template6'){
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_standard').removeClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_mulitple').addClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_three_in_row').removeClass('selected-op');
			}

			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-two-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('standard');

			
			var sqb_ans_image_size = jQuery(this).closest('.question_div_inner').find('select[name="ans-image-size-options"]').val();
			if(sqb_ans_image_size == 'custom'){
				jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').show();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').show();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').show();
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').addClass('sqb_ans_image_custom_size');
				
				var width = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_width').val();
				var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'px');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
				
			} else if(jQuery(this).val() == 'contain') {
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').addClass('sqb_ans_image_contain');
				var width = 100;
				var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'%');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
				jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').hide();
			}else if(sqb_ans_image_size == 'cover') {
				jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').show();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').hide();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').show();
				
				var width = 100;
				var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'%');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
				
			} else {
				jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').hide();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').hide();
				jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').hide();

				var width = jQuery(this).closest('.question_div_inner').find('select[name="ans-image-size-options"]').find('option:selected').attr('data-width');
				var height = jQuery(this).closest('.question_div_inner').find('select[name="ans-image-size-options"]').find('option:selected').attr('data-height');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'px');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
			}


		} else if(jQuery(this).attr('value') == 'three_column'){
			if(jQuery('#sqb_template_selected').val() == 'template6'){
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_standard').removeClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_mulitple').removeClass('selected-op');
				jQuery('.sqb_question_no.active .quiz_comon_template .sqb_ans_layout_three_in_row').addClass('selected-op');
			}

			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-three-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-three-in-row');
		} else if(jQuery(this).attr('value') == 'four_column'){
			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-four-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-four-in-row');
		} else if(jQuery(this).attr('value') == 'five_column'){
			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-five-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-five-in-row');
		} else if(jQuery(this).attr('value') == 'six_column'){
			jQuery(this).closest('.question_div_inner').find(".question_add_answer_outer_div").removeClass(function (index, css) {
			  return (css.match (/(^|\s)layout-\S+/g) || []).join(' ');
			});
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('layout-six-in-row-active');
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').find('input[name="question_temp_name"]').val('layout-six-in-row');
		}
		
		var value = jQuery(this).attr('value');
		var text = jQuery(this).text();
		jQuery(this).closest('.question_div_inner').find('.question-select-layout').text(text).attr('data-value',value);
		
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template = 'template8'){
			if(jQuery(this).attr('value') == 'one_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 600);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(600);
			} else if(jQuery(this).attr('value') == 'two_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 600);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(600);
			} else if(jQuery(this).attr('value') == 'three_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 800);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(800);
			} else if(jQuery(this).attr('value') == 'four_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 1000);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(1000);
			} else if(jQuery(this).attr('value') == 'five_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 1200);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(1200);
			} else if(jQuery(this).attr('value') == 'six_column'){
				var question_temp_width = jQuery("#question_temp_inner_width");
				question_temp_width.bootstrapSlider('setValue', 1400);//700
				question_temp_width.trigger('change');
				jQuery('.question_temp_inner_width_val').val(1400);
			}
		}
		
	});
	
	
	jQuery(document).on('click','.sqbAddOutcomeProduct',function(){
		var image_path = jQuery('#question_ans_empty_img_for_template7').val();
		jQuery('#Result-Screen-Settings .res_data_cont.active .question_add_answer_outer_div').append('<div class="sqb_ans_item" ><div class="sqb_ans_item_inner"><figure class="sqb_ans_item_img"><img src="'+image_path+'" class="sbq_change_img"></figure><div class="sql_ans_text sqb_tiny_mce_editor" ><div>Product Title</div></div><div class="buy-now-btn-outer"><span class="sqb_backend_show sqb_close_buy_now"><i class="fa fa-close" aria-hidden="true"></i></span><div class="buy-now-btn sqb_tiny_mce_editor"><div>Buy Now</div></div></div></div><span class="sqb_backend_show sqb_remove_outcome_product sqb_remove_section sqb_ans_delete_btn"><i class="fa fa-times" aria-hidden="true"></i></span></div>');
		jQuery(".outcome_products_section .sqb_ans_item_img .sbq_change_img").draggable(); 
		sqb_ans_resizeable();
		sqb_tiny_mce_editor();
		sqb_text_tiny_mce_editor();
	});
	
	jQuery(document).on('click','.sqb_close_buy_now',function(){
		jQuery(this).closest('.buy-now-btn-outer').hide();
	});

	jQuery(document).on('click','.Quiz--tabs-outer li.collapse-menu-item',function(){
		jQuery('.Quiz--tabs-outer').toggleClass('sqb_collapse_left_menu');
		jQuery('.Quiz--tabs-outer').toggleClass('sqb_collapse_left_menu_v2');
		jQuery('body').toggleClass('sqb_collapse_left_menu_body');
	});
	
	/*jQuery(document).on('click','.Quiz--tabs-outer.sqb_template7_selected li.collapse-menu-item',function(){
		if(jQuery('.Quiz--tabs-outer.sqb_template7_selected').hasClass('sqb_collapse_left_menu')){
			jQuery('.Quiz--tabs-outer.sqb_template7_selected').removeClass('sqb_collapse_left_menu');
			jQuery('.sqb_template7_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>');
		} else {
			jQuery('.Quiz--tabs-outer.sqb_template7_selected').addClass('sqb_collapse_left_menu');
			jQuery('.sqb_template7_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
		}
	});
	
	jQuery(document).on('click','.Quiz--tabs-outer.sqb_template6_selected li.collapse-menu-item',function(){
		if(jQuery('.Quiz--tabs-outer.sqb_template6_selected').hasClass('sqb_collapse_left_menu')){
			jQuery('.Quiz--tabs-outer.sqb_template6_selected').removeClass('sqb_collapse_left_menu');
			jQuery('.sqb_template6_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>');
		} else {
			jQuery('.Quiz--tabs-outer.sqb_template6_selected').addClass('sqb_collapse_left_menu');
			jQuery('.sqb_template6_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
		}
	});

	jQuery(document).on('click','.Quiz--tabs-outer.sqb_template8_selected li.collapse-menu-item',function(){
		if(jQuery('.Quiz--tabs-outer.sqb_template8_selected').hasClass('sqb_collapse_left_menu')){
			jQuery('.Quiz--tabs-outer.sqb_template8_selected').removeClass('sqb_collapse_left_menu');
			jQuery('.sqb_template8_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>');
		} else {
			jQuery('.Quiz--tabs-outer.sqb_template8_selected').addClass('sqb_collapse_left_menu');
			jQuery('.sqb_template8_selected .collapse-menu-item').html('<a class="nav-link" href="javascript:void(0)"><label>Collapse Menu</label><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>');
		}
	});*/
	
	
	jQuery(document).on('change','#sqb_image_custom_width',function(){
		var width = jQuery(this).val();
		var height = jQuery(this).val();
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'px');
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
	});
	
	jQuery(document).on('change','#sqb_image_custom_height',function(){
		var height = jQuery(this).val();
		var sqb_ans_image_size = jQuery(this).closest('.question_div_inner').find('select[name="ans-image-size-options"]').val();
		if(sqb_ans_image_size == 'cover'){
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
		//jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-height','');
		} else {
		//jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height','');
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
		}
	});
	
	jQuery(document).on('change','select[name="ans-image-size-options"]',function(){
		jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').removeClass(function (index, css) {
			return (css.match (/\bsqb-custom-size-\S+/g) || []).join(' ');
		});
		jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').addClass('sqb-custom-size-'+jQuery(this).val());
		
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').removeClass('sqb_ans_image_contain');
		jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').removeClass('sqb_ans_image_custom_size');
		if(jQuery(this).val() == 'custom'){
			jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').show();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').show();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').show();
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').addClass('sqb_ans_image_custom_size');
			
			var width = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_width').val();
			var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'px');
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
			
		} else if(jQuery(this).val() == 'contain') {
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').addClass('sqb_ans_image_contain');
			var width = 100;
			var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'%');
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
			jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').hide();
		} else if(jQuery(this).val() == 'cover') {
			jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').show();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').hide();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').show();
			
			var width = 100;
			var height = jQuery(this).closest('.question_div_inner').find('#sqb_image_custom_height').val();
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'%');
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
			//jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height','');
			
		} else {
			jQuery(this).closest('.question_div_inner').find('.sqb-image-custom-size-option').hide();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-width').hide();
			jQuery(this).closest('.question_div_inner').find('.sqb-que-img-height').hide();
			var width = jQuery('option:selected', this).attr('data-width');
			var height = jQuery('option:selected', this).attr('data-height');
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('max-width',width+'px');
			jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').css('height',height+'px');
		}
	});
	
	jQuery(document).mouseup(function(e) 
	{
	    var container = jQuery(".sqb-multiple-ans-options");
	    if (!container.is(e.target) && container.has(e.target).length === 0) 
	    {
	        container.hide('slow');
	    }
	});

	jQuery(document).on('click','#dropdownMenuQuestionLimit',function(){
		if(jQuery(this).closest('.question_div_inner').find('.sqb-multiple-ans-options').is(":hidden")){
			jQuery(this).closest('.question_div_inner').find('.sqb-multiple-ans-options').show('slow');
		}
	});
	jQuery(document).on('click','input[name="sqb_ans_with_img_checkbox"]',function(){
		if(jQuery(this).prop('checked')){
			if(jQuery('.sqb_question_no.active').find('.question_type_wrapper').find('.dropdown-toggle').attr('data-value') == 'dropdown'){
			return false;
			}
			
			jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('image_option_has');
			if(jQuery('#sqb_template_selected').val() == 'template7' || jQuery('#sqb_template_selected').val() == 'template9' || jQuery('#sqb_template_selected').val() == 'template8'){
			
			}else if(jQuery('#sqb_template_selected').val() == 'template6'){
				jQuery('.sqb_question_no.active .quiz_comon_template input[name="sqb_ans_with_img_checkbox"]').prop('checked', true);
			}else{
				jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('grid-layout-active');
				jQuery(this).closest('.question_div_inner').find('.ans_layout_typw ').removeClass('selected-op');
				jQuery(this).closest('.question_div_inner').find('.sqb_ans_layout_mulitple ').addClass('selected-op');
				
				//jQuery('#Quiz-Screen-Settings .Template-Customize-setting-outer .customizer_innner_sections').hide();
				jQuery('#Quiz-Screen-Settings .Template-Customize-setting-outer .customize_close').show();
				jQuery('#Quiz-Screen-Settings .Template-Customize-setting-outer .customize_open').hide();
			}
			
			jQuery(this).closest('.question_div_inner').find('.sqb-ans-image-options').show();
			jQuery(this).closest('.question_div_inner').find('.sqb-image-text-on-off').show();
		}else{
			//if(jQuery('#sqb_template_selected').val() != 'template7'){
				jQuery(this).closest('.question_div_inner').find('.question_add_answer_outer_div').removeClass('image_option_has');
			//}
			if(jQuery('#sqb_template_selected').val() == 'template6'){
				jQuery('.sqb_question_no.active .quiz_comon_template input[name="sqb_ans_with_img_checkbox"]').prop('checked', false);
			}
			jQuery(this).closest('.question_div_inner').find('.sqb-ans-image-options').hide();
		}
	});

	jQuery(document).on('click','.quizList li a',function(){
		jQuery(".quizList li a").removeClass(" active");
		jQuery(".quizList li").removeClass(" activeli");
		jQuery(this).addClass(" active");
		jQuery(this).closest("li").addClass(" activeli");
		sqb_getquiz_settings();
	});

	jQuery('a.add_ques').click(function(){
		jQuery('.Quiz-Question-Answer-outer .left_side_question_list').show();
		//set_question_template_width();
	});
      
    jQuery(document).on('click','input[name="display_correctans_on_page"]',function(){
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		 if(jQuery(this).val() == 'yes'){  
			 jQuery('.outcome_display_correct_ans').show('slow');
			 jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "inline-block");

		 	var correct_option = jQuery('select[name="display_correctans_options"]').val();
			if(quiz_type == 'assessment' || quiz_type == 'scoring'){
				var correct_option = jQuery('select[name="display_correctans_options"]').val();
				if(correct_option == 'both' || correct_option == 'each_page'){
					jQuery('#show_next_button').prop('checked', true);
				}
				jQuery('.sqb_is_right_ans_checkbox_outer').show();
			}

		 }else{
			jQuery('.outcome_display_correct_ans').hide('slow');
			jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "none");
			
			jQuery('.sqb_is_right_ans_checkbox_outer').hide();
		 }
		 
	 }); 
    
    if(jQuery('input[name="quiz_type"]:checked').val() == "assessment" || jQuery('input[name="quiz_type"]:checked').val() == "scoring"){
		if(jQuery('input[name="display_correctans_on_page"]:checked').val() == 'yes'){  
				 jQuery('.outcome_display_correct_ans').show('slow');
				 jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "inline-block");
				 jQuery('.sqb_is_right_ans_checkbox_outer').show();
		}else{
				 jQuery('.outcome_display_correct_ans').hide('slow');
				 jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "none");
				 jQuery('.sqb_is_right_ans_checkbox_outer').hide();
		}
	 }
    

	/* Show calculator work button for quiz type Calculator */
 	var quiz_type = jQuery("#quiz_type_switch").val();
    if(quiz_type == 'calculator'){
        jQuery('.HowCalculatorWork').show();
    }else{
        jQuery('.HowCalculatorWork').hide();
    }

    jQuery('.sqb_add_question').on('click',function(){
    	var quiz_type = jQuery("#quiz_type_switch").val();
		    if(quiz_type == 'calculator'){
		        jQuery('.HowCalculatorWork').show();
		    }else{
		        jQuery('.HowCalculatorWork').hide();
		    }
		sqb_add_more_question();
	});

	jQuery('.add_more_link').on('click',function(){
    	var quiz_type = jQuery("#quiz_type_switch").val();
	    if(quiz_type == 'calculator'){
	        jQuery('.HowCalculatorWork').show();
	    }else{
	        jQuery('.HowCalculatorWork').hide();
	    }
	});
    
});

function sqbhideshowpaginationoption(){
	var quiz_pagination = jQuery("input[name='quiz_pagination']:checked").val();
	var quiz_display = jQuery("input[name='quiz_display']:checked").val();
	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();

	if(quiz_type == 'form' || quiz_type == 'poll'){
		
	}else{

		if(quiz_display == 'inpage'){
			if(quiz_pagination == 'all' || quiz_pagination == "fixed_number" || quiz_pagination == "question_on_category"){
				jQuery('.show_progress_bar_section').hide('slow');
				jQuery('.quiz_slider_animation_div_display').hide('slow');
				jQuery('.show_back_button_outer').hide('slow');
			} else {
				jQuery('.show_progress_bar_section').show('slow');
				jQuery('.quiz_slider_animation_div_display').show('slow');
				var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
				if(quiz_type == 'personality' || quiz_type =='survey'){
				}
				jQuery('#container_template5').closest('li').show();
				jQuery('#container_template7').closest('li').show();
				jQuery('.show_back_button_outer').show('slow');

			}
		} else {
				jQuery('.show_progress_bar_section').show('slow');
				var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
				if(quiz_type == 'personality' || quiz_type =='survey'){
				}
		}
	}
	
	if(quiz_pagination == 'all'){
		if(jQuery('#Basic-Screen-Settings #quiz_recommendation_option').prop('checked')){
			jQuery('#Basic-Screen-Settings #quiz_recommendation_option').trigger('click');
			jQuery('#Quiz-Screen-Settings .content-recommendation-child').hide('slow');
		}
	}
}

function sqbincorrect_correctdisplay(){
	if(jQuery('input[name="quiz_type"]:checked').val() == "assessment" || jQuery('input[name="quiz_type"]:checked').val() == "scoring"){
		if(jQuery('input[name="display_correctans_on_page"]:checked').val() == "yes"  ){
			jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "inline-block");
		}else  {
			jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "none");
		}
	}
}
function sqbButtonsSetDefaultValues(){
	
	/*****Next btn start*******/
	
	var height = jQuery('.next_template_html_preview_outer .sqb_next_btn').css('padding-top');
	if(typeof height != 'undefined' && height != ''){
		height = height.split("px");
		var height = height[0];
		height = parseInt(height);
		jQuery("#nexttbtn_height").bootstrapSlider('setValue', height);
	}
	
	var width = jQuery('.next_template_html_preview_outer .sqb_next_btn').css('width');
	if(typeof width != 'undefined' && width != ''){
		width = width.split("px");
		var width = width[0];
		width = parseInt(width);
		jQuery("#nexttbtn_width").bootstrapSlider('setValue', width);
	}
	
	var bgcolor = jQuery('.next_template_html_preview_outer .sqb_next_btn').css('background-color');
	
	
	
	jQuery('#nextbutton_backgroud_color_div').colorpicker('setValue', bgcolor);
	
	
	/*****Next btn end*******/
	
	/*****Retake btn start*******/
	
	var height = jQuery('.retake_template_html_preview_outer .retake_button').css('padding-top');
	if(typeof height != 'undefined' && height != ''){
		height = height.split("px");
		var height = height[0];
		height = parseInt(height);
		jQuery("#retakebtn_height").bootstrapSlider('setValue', height);
	}
	
	var width = jQuery('.retake_template_html_preview_outer .retake_button').css('width');
	if(typeof width != 'undefined' && width != ''){
		width = width.split("px");
		var width = width[0];
		width = parseInt(width);
		jQuery("#retakebtn_width").bootstrapSlider('setValue', width);
	}
	
	var bgcolor = jQuery('.retake_template_html_preview_outer .retake_button').css('background-color');
	jQuery('#retakebutton_backgroud_color_div').colorpicker('setValue', bgcolor);
	/*****Retake btn end*******/
}

function sqb_question_fil_style_in_edit_mode(){
	if(jQuery('.quiz_question_answer_template_html').length >  0){
		var question_temp_old_style = jQuery('.quiz_question_answer_template_html').find('.Quiz-Template').attr('style');
		var template_no = jQuery('input[name="select_temp"]:checked');
		if(template_no == 'template4'){
			var question_temp_old_style = question_temp_old_style.replace("width", "width_rename");
		  jQuery('.sqb_questions_wrapper .question_div_inner .outer-style3').each(function(){
			 var question_max_width =  jQuery(this).css('max-width');
			 jQuery(this).attr('style',question_temp_old_style);
			 jQuery(this).css('max-width',question_max_width);
		  });
		}else{
			jQuery('.sqb_questions_wrapper .question_div_inner .sqb_question_enable_drag_drop').each(function(){
				 var question_max_width =  jQuery(this).css('max-width');
				 jQuery(this).attr('style',question_temp_old_style);
				 jQuery(this).css('max-width',question_max_width);
		  });
		}
	}
	
	// set question max width and image height in customizer section 
	jQuery('.left_side_question_list').on('click','ul a',function(){
		setTimeout(function(){
			if(jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.skip-question-action').css('display') == 'block'){
				jQuery('#showHide_skipbtn').prop('checked', true);
				jQuery('.show-hide-skip-btn').show();
			}else{
				jQuery('.show-hide-skip-btn').hide();
				jQuery('.skip-button-element-option').hide();
				jQuery('#showHide_skipbtn').prop('checked', false);
			}

			

		},500);
		
		var question_tab_id = jQuery(this).attr('href');  
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template9'){
			setTimeout(function(){
				question_video_delete_action();
				
				template9_question_screen_data();

				if(jQuery('.sqb_question_no.active .Quiz-Template9-inner').hasClass('sqb-template-bg-video-left') || jQuery('.sqb_question_no.active .Quiz-Template9-inner').hasClass('sqb-template-bg-video-right')){
					playSilentVideo(jQuery('.sqb_question_no.active .Quiz-Template9-left-side'));
				}

			},100);
		}

		var question_tab_id = jQuery(this).attr('href');  
		
		
		var qestion_max_width  = '700px';
		if( template_no == 'template4'){
			if(typeof  jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style3').css('max-width') != 'undefined'){
				var qestion_max_width  = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style3').css('max-width');
			}
		}else{
			if(typeof jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template').css('max-width') != 'undefined'){   
				var qestion_max_width  = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template').css('max-width');
			}
		}  
		
		if(qestion_max_width == '100%'){
			qestion_max_width  = '700px';
		}
		
		setTimeout(function(){
			var question_img_heigth = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.question_div_inner .sqb_question_enable_drag_drop').find('.question_img_div').css('height') 
			question_img_heigth = parseInt(question_img_heigth);
			qestion_max_width = parseInt(qestion_max_width);
			jQuery("#img_size1").bootstrapSlider('setValue', question_img_heigth);
			jQuery("#question_temp_width").bootstrapSlider('setValue', qestion_max_width);
			jQuery('.question_temp_width_input').val(qestion_max_width);
		}, 500);
		

		var qestion_inner_width  = '700px';
		if( template_no == 'template8'){
			if(typeof  jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style8').find('.question_add_answer_outer_div').css('width') != 'undefined'){
				var qestion_inner_width  = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style8').find('.question_add_answer_outer_div').css('max-width');
			}
		}
		
		qestion_inner_width = parseInt(qestion_inner_width);
		jQuery("#question_temp_inner_width").bootstrapSlider('setValue', qestion_inner_width);
		jQuery('.question_temp_inner_width_val').val(qestion_inner_width);
		var question_show_video = jQuery('.sqb_question_no.active').find('.question_show_video').val();

		if(question_show_video == 'Y'){
			jQuery('#questionshowHide_video').prop('checked' , true);
		}else{
			jQuery('#questionshowHide_video').prop('checked' , false);		
		}
		if( template_no == 'template5'){
			setTimeout(function(){
				
			var question_temp_left_sction_clr = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template5-left-side').css('background-color');
			if(typeof question_temp_left_sction_clr != 'undefined'){
				jQuery('#question_temp_left_sction_clr,#question_temp_left_sction_clr_div').colorpicker('setValue', question_temp_left_sction_clr);
			}
			var question_temp_right_sction_clr = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template5-right-side').css('background-color');
			if(typeof question_temp_right_sction_clr != 'undefined'){
				jQuery('#question_temp_right_sction_clr,#question_temp_right_sction_clr_div').colorpicker('setValue', question_temp_right_sction_clr);
			}
			var question_next_button_clr = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.question_div_outer').find('.sqb_quiz_template5.sqb_next_btn').css('background-color');
			if(typeof question_next_button_clr != 'undefined'){
				jQuery('#question_next_button_clr,#question_next_button_clr_div').colorpicker('setValue', question_next_button_clr);
			}
			
			sqb_load_question_background_image_customizer_values();
			
			}, 100);
		}

		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		var current_tab = jQuery(this).attr('href');
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
			var get_current_selected_option = jQuery(current_tab).find('.question_div_outer').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}else{
			var get_current_selected_option = jQuery(current_tab).find('.quiz_comon_template').find('.question_drop_down_wrapper').find('button.dropdown-toggle').attr('data-value');
		}

		if((quiz_type == 'personality') && ((get_current_selected_option == 'single') || (get_current_selected_option == 'multi') || (get_current_selected_option == 'yes_no') || (get_current_selected_option == 'rating'))){
			jQuery(current_tab).find('.personality_outcome_connect_btn').show();
		}else{
            jQuery(current_tab).find('.personality_outcome_connect_btn').hide();
        }	

        jQuery(current_tab).find('input[name="show_other_checkbox"]').each(function(){
        	if(jQuery(this).prop('checked') == true){
        		jQuery(current_tab).find('.continue-question-action').show();
        	}
        })
	});
	
	jQuery('ul.sqb_top_menu_list li').click(function(e) 
    { 
     var template_no = jQuery('input[name="select_temp"]:checked').val();
		if(template_no == 'template8'){
			template8_background_color_customizer();
			var selected_tab_id = jQuery(this).find('.nav-link').attr('id');
			if(selected_tab_id == 'Start-Screen-Settings-tab' || selected_tab_id == 'Result-Screen-Settings-tab' || selected_tab_id =='Quiz-Screen-Settings-tab' || selected_tab_id == 'Opt-Screen-Settings-tab'){
				var template8_background_height = jQuery("#template8_background_height_value").val();
				jQuery(".template8_temp_height").bootstrapSlider('setValue', parseInt(template8_background_height));
				jQuery(".template8_result_temp_height").bootstrapSlider('setValue', parseInt(template8_background_height));
				jQuery(".template8_question_temp_height").bootstrapSlider('setValue', parseInt(template8_background_height));
				jQuery(".template8_opt_temp_height").bootstrapSlider('setValue', parseInt(template8_background_height));
				
				var template8_background_width = jQuery("#template8_background_width_value").val();
				jQuery(".template8_temp_width").bootstrapSlider('setValue', parseInt(template8_background_width));
				jQuery(".template8_tesult_temp_width").bootstrapSlider('setValue', parseInt(template8_background_width));
				jQuery(".template8_question_temp_width").bootstrapSlider('setValue', parseInt(template8_background_width));
				jQuery(".template8_opt_temp_width").bootstrapSlider('setValue', parseInt(template8_background_width));
				
				var template8_background_start_inner_width = jQuery("#template8_background_start_inner_width_value").val();
				var template8_background_result_inner_width = jQuery("#template8_background_outcome_inner_width_value").val();
				var template8_background_opt_inner_width = jQuery("#template8_background_opt_inner_width_value").val();
				
				jQuery(".template8_temp_inner_width").bootstrapSlider('setValue', parseInt(template8_background_start_inner_width));
				jQuery(".template8_tesult_temp_inner_width").bootstrapSlider('setValue', parseInt(template8_background_result_inner_width));
				jQuery(".template8_opt_temp_inner_width").bootstrapSlider('setValue', parseInt(template8_background_opt_inner_width));
				var template8_background_color = jQuery("#template8_background_color_value").val();
			}
		}
    });
	
	jQuery('ul#Quiz-setting-Tabs li.questions_tab').on('click',function(){
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		if( template_no == 'template4' || template_no == 'template3'){
			jQuery('#Quiz-Screen-Settings .for_template_4_customizer').show();
		} else {
			jQuery('#Quiz-Screen-Settings .for_template_4_customizer').hide();
		}		
	});
	
		
	jQuery('a#Quiz-Screen-Settings-tab').on('click',function(){
		
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			sqb_load_question_background_image_customizer_values();
		}

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template6'){
			
			var bg_image = jQuery('.start_temp_static_div').css('background-image');
			if(bg_image == 'none'){				
				var get_outer_style = jQuery('#bg_imge_style').val();
				var get_inner_style = jQuery('#bg_imge_style_inner').val();
			} else {
				var get_outer_style = jQuery('.start_temp_static_div').attr('style');
				var get_inner_style = jQuery('.start_temp_outer').attr('style');
			}
			
			jQuery('.optin_template_html_preview_outer').attr('style',get_outer_style);
            jQuery('.quiz_comon_template').attr('style',get_inner_style);
            jQuery('.quiz_comon_template .Quiz-Template-title').css('background','none');
		}
		
		var question_tab_id = jQuery('.left_side_question_list ul a.active ').attr('href');
		if( question_tab_id != undefined){			
			var template_no = jQuery('input[name="select_temp"]:checked');
			if(template_no == 'template4'){
				var qestion_max_width = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.question_div_inner .outer-style3').css('max-width');
			}else{
				var qestion_max_width =  jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.question_div_inner .sqb_question_enable_drag_drop').css('max-width');
			}
			var question_img_heigth = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.question_div_inner .sqb_question_enable_drag_drop').find('.question_img_div').css('height') 
			question_img_heigth = parseInt(question_img_heigth);
			
			jQuery("#img_size1").bootstrapSlider('setValue', question_img_heigth);
			
			var template_no = jQuery('input[name="select_temp"]:checked').val();
			var qestion_max_width  = '900px';
			if( template_no == 'template4'){
				if(typeof  jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style3').css('max-width') != 'undefined'){
					var qestion_max_width  = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.outer-style3').css('max-width');
				}
			}else{
				if(typeof jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template').css('max-width') != 'undefined'){   
					var qestion_max_width  = jQuery('.sqb_questions_wrapper').find(question_tab_id).find('.Quiz-Template').css('max-width');
				}
			}  
			
			qestion_max_width = parseInt(qestion_max_width);
			
			jQuery("#question_temp_width").bootstrapSlider('setValue', qestion_max_width);
			var question_show_video = jQuery('.sqb_question_no.active').find('.question_show_video').val();
			if(question_show_video == 'Y'){
			jQuery('#questionshowHide_video').prop('checked' , true);
			}else{
			jQuery('#questionshowHide_video').prop('checked' , false);
			}
		}
	});


	jQuery('#question_temp_br_style').on('change',function() {
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		var selected_value = jQuery(this).find(":selected").val();
		jQuery('.sqb_questions_wrapper').find('.Quiz-Template').css('border-style',selected_value);
		jQuery('.quiz_question_answer_template_html').find('.Quiz-Template').css('border-style',selected_value);
	});   
}

function sqb_click_on_Question_no_heading(){
	jQuery(document).on('click','.left_side_question_list li a',function(){
		    var question_no_attr_id = jQuery(this).attr('href');
			sqb_rearrange_question_desiable();
			jQuery(question_no_attr_id).addClass(' active show ');
			
	});
	
}
	



function sqb_answer_correct_checkbox_one_checked(){	 
	 	
	jQuery(document).on('click','.sqb_ans_item input[type="checkbox"].sqb_is_right_ans',function(){
		var selected_template = jQuery('input[name="select_temp"]:checked').val();

		if(selected_template == 'template8' || selected_template == 'template6'){
			var ques_type = jQuery(this).closest('.question_div_outer').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}else{
			var ques_type = jQuery(this).parents('.quiz_comon_template').find('.question_drop_down_wrapper').find('button.dropdown-toggle').attr('data-value');
		}
		
		 if(ques_type == 'multi'){
		 }else{
			jQuery(this).attr('checked','checked');
			jQuery(this).closest('.sqb_ans_item').siblings('.sqb_ans_item').each(function() {
				jQuery(this).find('input[type="checkbox"].sqb_is_right_ans').prop('checked',false);
				jQuery(this).find('input[type="checkbox"].sqb_is_right_ans').removeAttr('checked');
			});
		}
	});
 
}

function sqb_show_correct_incorrect_ans_wrapper(){
	
	/*jQuery(document).on('click','input[name="show_correct_inccorect_ans_checkbox"]',function(){  
		if(jQuery(this).prop('checked')){
			jQuery(this).closest('.QA-advance-option').find('.sqb_incorrect_correct_ans_wrapper').show('slow');
		}else{
			jQuery(this).closest('.QA-advance-option').find('.sqb_incorrect_correct_ans_wrapper').hide('slow');
		}
	});*/
	
}



function sqb_rearrange_question_desiable(){
	
	jQuery('.sqb_questions_wrapper .sqb_question_no').each(function(){
			jQuery(this).removeClass('active show');
			jQuery(this).find('.card-header').hide();
			jQuery(this).find('.sqb_question_collapse').show();
			
		});
	
}

function sqb_show_categories(){
	jQuery('.sqb_loading_wrapper').show();
	var quiz_id = jQuery('#edit_id').val();
	
	jQuery.post(ajaxurl, {
		action: 'SQBget_questions_with_category_mapping',
		quiz_id: quiz_id,
		
	}, function(response) {	
		jQuery('.sqb_loading_wrapper').hide();
		
		response = JSON.parse(response);
		if(response.status == 'success'){
			var side_popup_selector = jQuery('.sqb_quiz_type_show_category_mapping_wrapper');
			side_popup_selector.addClass('active_Side_Popup').show(); 
			jQuery('body').addClass('sidepopup-active');

			side_popup_selector.find('.Manage_Side_Popup_content .Manage_Side_Popup_content_innner').html(response.data);
		}
		
		
	});
}
function sqb_rearrange_question(){
		
	jQuery('.sqb_loading_wrapper').show();
	var quiz_id = jQuery('#edit_id').val();
	
	jQuery.post(ajaxurl, {
		action: 'sqb_load_all_quiz_question_ajax',
		quiz_id: quiz_id,
		
	}, function(response) {	
		jQuery('.sqb_loading_wrapper').hide();
		
		response = JSON.parse(response);
		if(response.error){
			swal("",response.error,""); 
			return false;
		}else if(response.has_data && response.has_data == 'Y'){
			var side_popup_selector = jQuery('.sqb_quiz_type_re_arrange_questions_wrapper');
			side_popup_selector.addClass('active_Side_Popup').show(); 
			jQuery('body').addClass('sidepopup-active');

			side_popup_selector.find('.Manage_Side_Popup_content .Manage_Side_Popup_content_innner').html(response.html);
			side_popup_selector.find('.save_re_order_questions_quiz_id').val(quiz_id);
			sqb_re_order_question();
		}
		
	});
			
}

function sqb_question_insert_ads(){
		
	jQuery('.sqb_loading_wrapper').show();
	var quiz_id = jQuery('#edit_id').val();
	
	jQuery.post(ajaxurl, {
		action: 'sqb_load_all_quiz_question_ads_ajax',
		quiz_id: quiz_id,
		
	}, function(response) {	
		jQuery('.sqb_loading_wrapper').hide();
		
		response = JSON.parse(response);
		if(response.has_data && response.has_data == 'N'){
			swal("","Please add or Save Questions",""); 
			return false;
		}else if(response.has_data && response.has_data == 'Y'){
			var side_popup_selector = jQuery('.sqb_quiz_type_insert_ads_questions_wrapper');
			side_popup_selector.addClass('active_Side_Popup').show(); 
			jQuery('body').addClass('sidepopup-active');

			side_popup_selector.find('.Manage_Side_Popup_content .Manage_Side_Popup_content_innner').html(response.html);
			side_popup_selector.find('.save_re_order_questions_quiz_id').val(quiz_id);
			sqb_re_order_question();
			side_popup_selector.find('.ans_recommendation_result_title').each(function(){
				jQuery(this).removeAttr('id');
			});
			side_popup_selector.find('.ans_recommendation_description').each(function(){
				jQuery(this).removeAttr('id');
			});
			sqb_tiny_mce_editor();
		}
		if(response.setting_question_ads_color){
			jQuery('.sqb_quiz_type_insert_ads_questions_wrapper .answer_recommendation_outer_wrapper').css('background-color', response.setting_question_ads_color);
		}
		
	});
			
}

function sqb_save_re_arrange_questions(obj){

	if(jQuery('input[name="add_user_quiz"][value="googlespreadsheet"]').prop('checked') == true){
		swal({
			title: "We notice you currently have google sheets integration enabled.",
			text: "If you re-order questions, you'll have to re-add the columns in the right order in your google sheets or the integration will not work right. Are you sure you want to proceed?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			customClass: '',
			}).then(function(isConfirm){
				if (isConfirm.value) {
					sqb_rearrange_all_question(obj);
				}
			});
	}else if(jQuery('input[name="enable_branching"]').prop('checked') == true){
		swal({
			title: "We notice you currently have branching logic enabled.",
			text: "If you re-order questions, you'll have to reset all the connections and re-do the branching logic in the quiz funnels page, otherwise it'll not work right. Are you sure you want to proceed?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			customClass: '',
			}).then(function(isConfirm){
				if (isConfirm.value) {
					sqb_rearrange_all_question(obj);
				}
			});
	}else{
		sqb_rearrange_all_question(obj);
	}
}

function sqb_rearrange_all_question(obj){
	var current_obj = obj;
	var side_popup_selector = jQuery('.sqb_quiz_type_re_arrange_questions_wrapper.active_Side_Popup');
	var questions_detail =  [];
	var quiz_id = side_popup_selector.find('.save_re_order_questions_quiz_id').val();
	side_popup_selector.find('.sqb_questions_wrapper').find('.re_arrange_question_div').each(function(index){
		var question_id = jQuery(this).attr('data-question-id');
		if(jQuery(this).find('input[name="sqb_skip_question"]').prop('checked') == true){
			var skip_question = 'N';
		}else{
			var skip_question = 'Y';
		}

		var question_id = jQuery(this).attr('data-question-id');
		if(jQuery(this).find('input[name="sqb_show_question_image"]').prop('checked') == true){
			var sqb_show_question_image = 'Y';
		}else{
			var sqb_show_question_image = 'N';
		}

		var question_reorder_no = index;
		questions_detail.push({
								'order_no':question_reorder_no,
								'question_id':question_id,
								'skip_question':skip_question,
								'sqb_show_question_image':sqb_show_question_image,
								});
		
	});
	var button_text = jQuery(obj).text();
	jQuery('.sqb_loading_wrapper').show();
	jQuery(obj).text('Please wait..');

	var select_quiz_bank = jQuery('input[name="select_quiz_bank"]').prop('checked');
	if(select_quiz_bank){
		select_quiz_bank = 'Y';
	}else{
		select_quiz_bank = 'N';
	} 
	var question_data = {quiz_id:quiz_id,question_ids:questions_detail,select_quiz_bank: select_quiz_bank};  

	// console.log(question_data);
	// return false;
	jQuery.post(ajaxurl, {
		action: 'sqb_save_question_order',
		question_data: question_data,
		
	}, function(response) {	
		jQuery('.sqb_loading_wrapper').hide();
		
		response = JSON.parse(response);
		if(response.error){
			swal("",response.error,""); 
			return false;
		}
		jQuery(current_obj).text(button_text);
		if(!jQuery('.reorder_questions_btn.sqb_rearrange_question').hasClass('sqb_rearrange_question_trigger')){
			jQuery('.reorder_questions_btn.sqb_rearrange_question').addClass('sqb_rearrange_question_trigger');	
		}
		window.location.href = sqb_get_url_without_edit_quiz_query_string()+"&sqb_page="+1;
		//sqb_showPage(1, sqb_add_question_pagination_limit);
		var side_popup_selector = jQuery('.sqb_quiz_type_re_arrange_questions_wrapper');
			side_popup_selector.removeClass('active_Side_Popup').hide(); 
	});	
}


function sqb_templates_BoxShadow( template_name = '',temp_obj = '') {
	
	if((template_name == '') || (temp_obj == '') ){
		return true;
	}else if(template_name == 'start_temp'){
		var hor_lnth = parseFloat(jQuery('#start_temp_hor_lnth').val());
		var ver_lnth = parseFloat(jQuery('#start_temp_ver_lnth').val());
		var blur_radius = parseFloat(jQuery('#start_temp_blur_radius').val());
		var sprd_radius = parseFloat(jQuery('#start_temp_spread_radius').val());
		var shad_clr =    jQuery('#start_temp_shad_clr').val();
		var temp_obj = temp_obj.find('.start_temp_outer');
	}else if(template_name == 'question_temp'){
		var hor_lnth = parseFloat(jQuery('#question_temp_hor_lnth').val());
		var ver_lnth = parseFloat(jQuery('#question_temp_ver_lnth').val());
		var blur_radius = parseFloat(jQuery('#question_temp_blur_radius').val());
		var sprd_radius = parseFloat(jQuery('#question_temp_spread_radius').val());
		var shad_clr =    jQuery('#question_temp_shad_clr').val();
		var template_no = jQuery('input[name="select_temp"]:checked').val();
		var temp_obj = temp_obj.find('.Quiz-Template');
	}else if(template_name == 'opt_in_temp'){
		var hor_lnth = parseFloat(jQuery('#opt_in_temp_hor_lnth').val());
		var ver_lnth = parseFloat(jQuery('#opt_in_temp_ver_lnth').val());
		var blur_radius = parseFloat(jQuery('#opt_in_temp_blur_radius').val());
		var sprd_radius = parseFloat(jQuery('#opt_in_temp_spread_radius').val());
		var shad_clr =    jQuery('#opt_in_temp_shad_clr').val();
		var temp_obj = temp_obj.find('.Quiz-Optin-Template');
	}else if(template_name == 'result_temp'){
		var hor_lnth = parseFloat(jQuery('#result_temp_hor_lnth').val());
		var ver_lnth = parseFloat(jQuery('#result_temp_ver_lnth').val());
		var blur_radius = parseFloat(jQuery('#result_temp_blur_radius').val());
		var sprd_radius = parseFloat(jQuery('#result_temp_spread_radius').val());
		var shad_clr =    jQuery('#result_temp_shad_clr').val();
		var temp_obj = temp_obj.find('.result_temp_outer');
	}
	
	
	hor_lnth = hor_lnth + 'px';
	ver_lnth = ver_lnth + 'px';
	blur_radius = blur_radius + 'px';
	sprd_radius = sprd_radius + 'px';
	var box_shadow = hor_lnth + ' ' + ver_lnth + ' ' + blur_radius + ' ' + sprd_radius + ' ' + shad_clr;
	temp_obj.css('-webkit-box-shadow', box_shadow);
	temp_obj.css('-moz-box-shadow', box_shadow);
	temp_obj.css('box-shadow', box_shadow);
}

function sqb_enable_drag_drop_init(){
	return false;
	var enable_drag_and_drop_class = "sqb_question_enable_drag_drop";
	jQuery( "."+enable_drag_and_drop_class ).sortable({
			connectWith: "."+enable_drag_and_drop_class,
			//opacity: 0.5, 
			cursor: "move",
			disabled: false,
			cancel: ".disable_drag_drop_sortable",
			classes: {"ui-state-default": "sqb_question_drag_drop_item" },
			placeholder: "element_drop_here",
			start: function (event, ui) {
				jQuery('.element_drop_here').text('Drop Element Here');
				
				jQuery(ui.helper).addClass("ui_helper_my_custom_dynamic_droppable_start_element_class");
				
			},
			change: function(event, ui) {
				
				jQuery(ui.helper).addClass("ui_helper_my_custom_dynamic_droppable_start_element_class");
				
				
			},
			
			stop: function(event, ui) {				
				jQuery(ui.item).removeClass("ui_helper_my_custom_dynamic_droppable_start_element_class");
			}
	});
	
	
	jQuery(".draggableElement_wrapper .draggableElement_outer").draggable({
				disabled:false,
				connectToSortable: '.'+enable_drag_and_drop_class,
				helper: 'clone',
				revert: 'invalid',
	});
	
	sqb_enable_drag_drop_for_item(enable_drag_and_drop_class);
	
}




function sqb_enable_drag_drop_for_item(enable_drag_and_drop_class = ''){
	
		

		jQuery("."+enable_drag_and_drop_class).droppable({
						
						out: function( event, ui ) { 
							},
						over: function( event, ui ) {
														var data_type = jQuery(ui.helper).attr('data-type');
							if( data_type != 'undefined' &&  jQuery(ui.helper).hasClass("inner_section_side_bar")){
							
								jQuery(ui.helper).addClass("ui_helper_my_custom_droppable_start_element");
							}
						},
						accept: function(dropElem) {
							return true;
							//dropElem was the dropped element, return true or false to accept/refuse it
						},
						drop: function( event, ui ) {
							
							jQuery(ui.helper).addClass("ui_helper_my_custom_element");
							jQuery(ui.helper).addClass("sqb_question_drag_drop_item"); 
							jQuery(ui.helper).removeClass("ui_helper_my_custom_droppable_start_element");
							var data_type = jQuery(ui.helper).attr('data-type');
							   
							if( data_type != 'undefined' &&  jQuery(ui.helper).hasClass("inner_section_side_bar")){
								jQuery(ui.helper).removeClass("inner_section_side_bar");
								
								var sqb_dt = new Date();
								var sqb_current_datetime = sqb_dt.getDate()+'_'+sqb_dt.getMonth()+'_'+sqb_dt.getDay()+'_'+sqb_dt.getHours()+'_'+sqb_dt.getMinutes()+'_'+sqb_dt.getSeconds()+'_'+sqb_dt.getYear();
									
							    
								var action_html  = '<div class="hover_close_btn"><i class="fa fa-edit element_edit" aria-hidden="true"></i><i class="fa fa-trash element_delete" aria-hidden="true"></i></div>';

								var action_only_delete  = '<div class="hover_close_btn"><i class="fa fa-trash element_delete" aria-hidden="true"></i></div>';
								action_html = action_only_delete;

								var html = '';
								var sqb_plugin_folder_url = jQuery('#sqb_plugin_folder_url').val();
							   if(data_type == 'product_info'){
									
								   
								   
							   }else if(data_type == 'heading'){
								  html = action_html+'<div data-action="heading" class="dragdrop_inner_section dragdrop_heading_elements"  style="font-size:17px;font-weight:700;color:#333; color: #0f2e47;font-size: 21px;font-weight: 600;font-family: DM Sans,sans-serif"><div class="sqb_tiny_mce_editor"><div>  Enter Heading... </div></div></div>';
								  
								  
							   }else if(data_type == 'subheading'){
								  html = action_html+'<div data-action="subheading" class="dragdrop_inner_section dragdrop_subheading_elements"  style="font-size:17px;font-weight:500;color:#333;"><div class="sqb_tiny_mce_editor"><div>  Enter Subheading Here...</div></div></div>';
								 
							   }else if(data_type == 'text'){
								  html = action_html+'<div data-action="text" class="dragdrop_inner_section dragdrop_text_elements "  style="font-size:14px;font-weight:300;color:#333;" > <span class="sqb_tiny_mce_editor">Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document </span></div>';
								  
								}else if(data_type == 'image'){
									
								
									
								}else if(data_type == 'video'){
									jQuery(ui.draggable).css('text-align','center');
									if(jQuery('.sqb_mobile_view').hasClass('active')){
										html = action_html+'<div class="dragdrop_video_elements dragdrop_inner_section" data-action="video"><iframe id="iframe_video" width="300" height="200" src="https://www.youtube.com/embed/pCvkpM_XoYA"></iframe></div>';
									}else {
										html = action_html+'<div class="dragdrop_video_elements dragdrop_inner_section" data-action="video"><iframe id="iframe_video" width="665" height="370" src="https://www.youtube.com/embed/pCvkpM_XoYA"></iframe></div>';
									}	
									
									
								}else if(data_type == 'add_more_tick_text'){
									html = action_html+'<div class="dragdrop_add_more_tick_text dragdrop_inner_section" data-action="add_more_tick_text"> <div class="sqb_tiny_mce_editor" ><h3 >What You Get: </h3> </div><ul class="list-check-style"> <li ><div class="sqb_tiny_mce_editor">Contrary to popular belief, Lorem Ipsum is not simply random</div><div class="sqb_remove_li_text"><i class="fa fa-trash" aria-hidden="true"></i></div></li><li><div class="sqb_tiny_mce_editor">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which do not look even slightly believable. If you are going to use a passage of Lorem Ipsum.</div><div class="sqb_remove_li_text"><i class="fa fa-trash" aria-hidden="true"></i></div></li><li><div class="sqb_tiny_mce_editor">The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.</div><div class="sqb_remove_li_text"><i class="fa fa-trash" aria-hidden="true"></i></div></li><li><div class="sqb_tiny_mce_editor">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to</div><div class="sqb_remove_li_text"><i class="fa fa-trash" aria-hidden="true"></i></div></li></ul> <div class="showin_backend"><div class="sqb_add_more_li_text"> <span onclick="sqb_add_more_li_left_side()"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add more text</span></div></div></div>';
								}   
								   
							   if(html != ''){
								// open element customize option   
								sqb_edit_element(ui.draggable,data_type);  
								jQuery(ui.draggable).css('background-color','rgba(255, 255, 255,0)').html(html);
							   }
								  sqb_tiny_mce_editor();
								  
							   }
						   
								
								
								
							}
				
					});
			
				
}


function sqb_edit_element(obj,data_action){
		  
		jQuery('.sqb_question_drag_drop_item').removeClass('element_customizer_active'); 
		if(typeof data_action !== 'undefined'){
			jQuery(obj).closest('.sqb_question_drag_drop_item').addClass('element_customizer_active');
			jQuery('.element_customizer_wrapper .element_wrapper').hide();
			jQuery('.element_customizer_wrapper .element_'+data_action+'_wrapper').show();
			jQuery('.element_customizer_wrapper_list .customize_open').trigger('click');	
			jQuery('.element_customizer_wrapper_list').show('show');
			
		}else{
			jQuery('.element_customizer_wrapper_list').hide('show');
		}
}




function sbq_tinymce_focus(){
	
	jQuery(document).on('click','.sqb_tiny_mce_editor',function(){
		jQuery(this).focus();
		jQuery(this).addClass('sqb_disable_tiny_mce_editor');
	});
	 
	jQuery(document).on('blur','.sqb_tiny_mce_editor',function() {  
		
		jQuery(this).removeClass('sqb_disable_tiny_mce_editor');
		
	});
	
	jQuery(document).on('keyup','.sql_ans_text.sqb_disable_tiny_mce_editor',function(){
		// change text connect to outocme 
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		var ques_type = jQuery(this).closest('.question_div_outer').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		if(jQuery('.outcome-mapping-error').length >= 1 ){
			jQuery('.outcome-mapping-error').remove();
		}
		
		if((quiz_type == 'personality') && ((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating'))){
			jQuery('.sqb_question_no.active .personality_outcome_connect_btn').show();
			if(jQuery('.sqb_question_no.active .personality_outcome_connect_btn').find('.outcome-option-active').hasClass('outcome-option-connect')){
				
				jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').show();
				jQuery('.sqb_question_no.active').find('.personality_outcome_connect_btn .outcome-option-connect').trigger('click');
			}
		}
		jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').addClass('answer_edit_text');
		if(jQuery('input[name="quiz_type"][value="personality"]').prop('checked')){
			var answer_id = jQuery(this).closest('.sqb_ans_item').attr('data-id');
			
			if(isNaN(answer_id)){
					var answer_attr_id =  jQuery(this).closest('.sqb_ans_item').attr('id');
				     jQuery('.ans_id_attr_'+answer_attr_id).find('.quiz_label').text(jQuery(this).text());
			}else{
				 jQuery('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').find('.sql_ans_text').text(jQuery(this).text());
				 jQuery('.assessment_outcome_connect').find('.quiz-content-card[data-answer-id="'+answer_id+'"]').find('.quiz_label').text(jQuery(this).text());
			}
			
			
		}
		  
		
	});
	
	
	
	
}
//for multiplecorrect answer
function sbq_correct_ans_change(){
	
	jQuery(document).on('change','input[name="multiple_correct_ans"]',function(){ 
		var parent_id = jQuery(this).closest(".question_div_outer").attr('id');				 
		if(jQuery(this).prop('checked') == true){						 
		}else{
			if(jQuery(this).closest('.question_div_outer').find(".sqb_is_right_ans_checkbox_outer .sqb_is_right_ans:checked").length > 1){
				jQuery(this).closest('.question_div_outer').find(".sqb_is_right_ans_checkbox_outer .sqb_is_right_ans").prop('checked',false);
			}
		}				
	});
	
}

function sbq_question_ans_type_change(){
}  

jQuery(document).on('click','.sqb_save_question_dropdown',function(){
	
var keylabel = jQuery(this).closest('.answer_dropdown_options_wrapper').find('.sqb_dropdown_type_default_label').html();
var defaultdropdownvalue = jQuery(this).closest('.answer_dropdown_options_wrapper').find('#defaultdropdownvalue').val();
var field_value = jQuery(this).closest('.answer_dropdown_options_wrapper').find('#field_value').val();
var final_field_value = field_value.split(' ').join('_');
jQuery('.sqb_question_no.active').find('#dropdown-label').val(keylabel);
jQuery('.sqb_question_no.active').find('#dropdown-default-value').val(defaultdropdownvalue);
jQuery('.sqb_question_no.active').find('#dropdown-fields-value').val(final_field_value);
jQuery('.answer_dropdown_options_show').trigger('click');

sqb_save_quiz('Quiz-Screen-Settings');
});

jQuery(document).on('keyup','.sqb_dropdown_type_default_label',function(){
	var element = this;
	make_dropdown_preview(element);
});

jQuery(document).on('keyup','#defaultdropdownvalue',function(){
	var element = this;
	make_dropdown_preview(element);
});

jQuery(document).on('keyup','#field_value',function(){
	var element = this;
	make_dropdown_preview(element);
});

function make_dropdown_preview(element){
var dropdown_label = jQuery(element).closest('.answer_dropdown_options_wrapper').find('.sqb_dropdown_type_default_label').html();
var dropdown_default_value = jQuery(element).closest('.answer_dropdown_options_wrapper').find('#defaultdropdownvalue').val();
var field_value = jQuery(element).closest('.answer_dropdown_options_wrapper').find('#field_value').val();
var final_field_value = field_value.split(',').join('\n');
var final_dropdown_field_value_option = final_field_value.split('\n');
var options_html = '';
jQuery.each(final_dropdown_field_value_option, function(){
  options_html += '<option>'+this+'</option>';
});
var preview_section_html = '<label class="quiz_label p-0 mb-1 preview_dropdown_label">'+dropdown_label+'</label><div class="quiz_right-content p-0 preview_dropdown_select"><select name="select_answers" class="sqb_question_dropdown" id="sqb_question_dropdown_2051"><option value="">'+dropdown_default_value+'</option>'+options_html+'</select></div>';
jQuery('.answer_dropdown_options_wrapper').find('.preview_section').find('.quiz-content-card').html(preview_section_html);
}

function sbq_question_add_more_ans(){
	
	jQuery(document).on('keyup','.question_add_answer_outer_div  input[name="ans_poins"]',function(){
		jQuery(this).attr('value',jQuery(this).val());
	});

	jQuery(document).on('keyup','.question_add_answer_outer_div  input[name="numeric_correct_answer"]',function(){
		jQuery(this).attr('value',jQuery(this).val());
	});
	
	
	jQuery(document).on('click','.question_add_more_ans_btn',function(){
			
		var ans_tag_display = 'display:none';
		var ans_recommendation_display = 'display:none';
		
		if(jQuery('#quiz_recommendation_option').prop('checked') == true){
			ans_recommendation_display = '';		
		}

		if(jQuery('#quiz_ans_tags').prop('checked') == true){
			ans_tag_display = '';	
		}
		
		var answer_level_dot_option_html = '<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="'+ans_recommendation_display+'"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="'+ans_tag_display+'"><strong>Add Tags</strong></a><a style="'+ans_tag_display+'" href="javascript:void(0)" class="dropdown-item view-all-tags"><strong>View All Assigned Tags</strong></a></div></div></div>';

		var answer_level_dot_option_html_single = '<div class="answer_level_dot_button sqb_ans_disable_dds"><div class="dropdown-link-style dropdown "> <button class="dropdown-toggle" type="button" id="dropdownMenuButtonAnslevel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <span> ...</span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButtonAnslevel"><span class="dropdown-item add-other-option" href=" javascript:void(0)"><span class="checkbox-custom-style"><input type="checkbox" name="show_other_checkbox" class="custom-checkbox-input"><span class="custom--checkbox"></span></span> <strong><label style="margin: 0; "> Show Other</label></strong></span><div class="show-othermsg">A text area will be displayed in the frontend when users select this answer.</div><div class="customize-text" style="display:none;"><textarea class="please-elaborate" name="elaborate-text" placeholder="Please enter your other input"></textarea></div><a class="dropdown-item  add_ans_level_recommendation " href="javascript:void(0)" data-type="recommendation " style="'+ans_recommendation_display+'"><strong>Add Recommendation</strong></a><a class="dropdown-item add-answer-tag" href=" javascript:void(0)" style="'+ans_tag_display+'"><strong>Add Tags</strong></a><a href="javascript:void(0)" class="dropdown-item view-all-tags" style="'+ans_tag_display+'"><strong>View All Assigned Tags</strong></a></div></div></div>';

		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		
		var parents_id = jQuery(this).closest('.question_div_outer').attr('id');
		var already_added_answer = jQuery(this).closest('.question_div_inner').find('.sqb_ans_item').length;
		var sqb_ans_image_custom_size_cls = '';
		var sqb_ans_image_custom_style = '';
		
		if(jQuery('input[name="select_temp"]:checked').val() == 'template8'){
			sqb_ans_image_custom_style = 'max-width: 100px; height: 100px;';
		}

		if(already_added_answer){
		sqb_ans_image_custom_size_cls =  jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').attr('class');
		sqb_ans_image_custom_style = jQuery(this).closest('.question_div_inner').find('.sqb_ans_item_img').attr('style');
		}
		
		var ans_img_show = jQuery(this).closest('.question_div_outer').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
		if(ans_img_show){
			ans_img_show = "image_option_has"; 
		}else{
			ans_img_show = ""; 
		}
		
		var currect_ans_checkbox_show = "style='display:none'"; 
		var points_ans_checkbox_show = "style='display:none'"; 
		var show_ans_box_for_scroing_and_assessment  = "style='display:none'"; 
		show_ans_box_for_scroing_and_assessment = "";
		
		if(quiz_type  == 'scoring'){
			points_ans_checkbox_show = ""; 
			show_ans_box_for_scroing_and_assessment = "";
			 currect_ans_checkbox_show = "";
		 }else if(quiz_type  == 'assessment'){
			 currect_ans_checkbox_show = "";
			 show_ans_box_for_scroing_and_assessment = "";
		}else if(quiz_type  == 'calculator'){
			 show_ans_box_for_scroing_and_assessment = "";
			 points_ans_checkbox_show = ""; 
		}
		
		var parent_obj = jQuery('#'+parents_id);
		
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
			var ques_type = jQuery(this).closest('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}else{
			var ques_type = jQuery(this).closest('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}
		


		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type  == 'survey' || quiz_type  == 'personality'){
			if(((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating')) && (quiz_type  == 'personality')){
				jQuery(parent_obj).find('.personality_outcome_connect_btn').show();
			}else if(ques_type == 'text' && quiz_type  == 'personality'){
				jQuery(parent_obj).find('.personality_outcome_connect_btn').hide();
			}else if(ques_type == 'date' && quiz_type  == 'personality'){
				jQuery(parent_obj).find('.personality_outcome_connect_btn').hide();
			}else{
				jQuery(parent_obj).find('.personality_outcome_connect_btn').hide();
			}
		}else{
			jQuery(parent_obj).find('.personality_outcome_connect_btn').hide();
			//var ques_type = "multi";
		}
		if( ques_type == ''){
			sqb_sweet_message('','Please select Question type','');
			return false;
		}
		
		var sqb_datetime = new Date();
		var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
		 
		var sqb_ans_empty_img = jQuery('input[name="question_ans_empty_img"]').val();
		parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
		parent_obj.find('.question_add_answer_outer_div').removeClass('answer-type-matrix-selected'); 
		parent_obj.find('.question-type-card.question_type_wrapper').removeClass('answer-type-matrix-selected');
		if(ques_type == "single"){
			
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div><span class='sqbOpitionSelected'></span></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div>"+answer_level_dot_option_html_single+"</div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "multi"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div><span class='sqbOpitionSelected'></span></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div>"+answer_level_dot_option_html_single+"</div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		
		}else if(ques_type == "yes_no"){
			
 			
			if(selected_template == 'template8'){
				jQuery('.sqbHideQuesTemplateImage').trigger('click')
			}else{
			/*	if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display') == 'none'){
					jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
				}*/
			}

			if(already_added_answer > 1 ){
				return false;
			}
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Yes</div></div><span class='sqbOpitionSelected'></span></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div>"+answer_level_dot_option_html+"</div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
			 ans_box += "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>No</div></div><span class='sqbOpitionSelected'></span></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div>"+answer_level_dot_option_html+"</div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
		
		}else if(ques_type == "rating"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ranting_alignment_text = ' style="text-align: center;"';
			parent_obj.find('.question_add_answer_outer_div').removeClass('ranting_level_1 ranting_level_2 ranting_level_3 ranting_level_4 ranting_level_5 ranting_level_6 ranting_level_7 ranting_level_8 ranting_level_9');   
			
			if(already_added_answer >= 1 ){
				var answer_rating_no = already_added_answer+1;
				var ans_box = "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+" >"+(already_added_answer+1)+"</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				if(answer_rating_no < 10){
					parent_obj.find('.question_add_answer_outer_div').addClass('ranting_level_'+answer_rating_no);   
				}
				
			}else if(already_added_answer == 0){
				var ans_box = "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">1</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">2</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">3</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">4</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				ans_box += "<div class='sqb_ans_item ans_type_rating' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div "+ranting_alignment_text+">5</div></div></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
				parent_obj.find('.question_add_answer_outer_div').addClass('ranting_level_5');   
			}
			
			
		}else if(ques_type == "text"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><textarea class='sqb_and_field sqb_input_ans_field sqb_textarea_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='Enter the text here' ></textarea><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			//sqb_placeholder_editable();
			
		}else if(ques_type == "matching_text"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='numerical-message'><span class='full-text'>In the text area below, enter the full text and whatever text you want users to fill out, enclose it with square brackets.</span><span class='see-details'> <a href='javascript:void(0)' class='numerical-sidepopup'>See this for details. </a></span><div>Points are only assigned for correct answers</div></div><div class='sqb_ans_item matching-answer-outer' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_input_ans_field sqb_and_field sqb_tiny_mce_editor matching_answer_text' name='sqb_ans_"+sqb_round_no+"' style='min-height: 150px;'></div><div class='generated-data-outer'><div class='generate-answer-text'><div class='generate-btn-outer'><a href='javascript:void(0)' class='generate-btn'>Generate</a></div><div class='additional-words-outer'><input type='text' placeholder='Enter additional word' class='input-additional-word'><a href='javascript:void(0)' class='add-additional-words'>Add Additional Words</a></div></div><div class='show-generated-data'></div></div>";
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			//sqb_placeholder_editable();
			setTimeout(function(){
				sqb_notification_text_tiny_mce_editor();
				
			},100);
		}else if(ques_type == "name"){

			var ans_box = "<div class='sqb_ans_item sqb_name_type' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input autocomplete='off' type='text' class='sqb_and_field sqb_input_ans_field sqb_name_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='Enter Name' ></div>";
 			jQuery('.sqb_question_no.active').find('.question_details .question_title').html('<div><label>Before we begin, what should we call you?</label></div><div><label>This question is required. *</label></div>');
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "email"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var extra_options = '<div class="question-type-email-validation-outer"> <span> ... </span> <div class="sqb-email-type-options" style="display: none;"> <div class="sqb-email-type-dropdown"> <label class="setup-validation pb-1">Setup Validation</label></div> <div class="sqb-email-type-validation-required-option"> <div class="d-flex justify-content-between align-items-center"> <label>Required</label> <div class="quiz-right-content"> <div class="square-switch_onoff"> <input class="checkbox" name="email_type_required" checked="checked" type="checkbox" id="email-type-required'+sqb_round_no+'" value=""> <label for="email-type-required'+sqb_round_no+'"></label> </div> </div> </div> </div> <div class="sqb-email-type-validation-option"> <div class="email-val-label"> <label class="mb-2">Enter Validation Message</label> <input type="text" class="validation-email-type" name="validation-email-type" value="" placeholder="Please Enter Valid Email"> </div> </div> </div> </div>';

			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='email' class='sqb_and_field sqb_input_ans_field sqb_email_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='name@example.com' >"+extra_options+"</div>";

			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "phone_number"){

			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var extra_options = '<div class="question-type-phone-validation-outer"> <span> ... </span> <div class="sqb-phone-type-options" style="display: none;"> <div class="sqb-phone-type"> <label class="setup-validation pb-1">Setup Validation</label></div> <div class="sqb-phone-type-validation-required-option"> <div class="d-flex justify-content-between align-items-center"> <label>Required</label> <div class="quiz-right-content"> <div class="square-switch_onoff"> <input class="checkbox" name="phone_type_required" checked="checked" type="checkbox" id="phone-type-required'+sqb_round_no+'" value=""> <label for="phone-type-required'+sqb_round_no+'"></label> </div> </div> </div> </div> <div class="sqb-phone-type-validation-option"> <div class=""> <label class="mb-2">Enter Validation Message</label> <input type="text" class="validation-phone-type" name="validation-phone-type" value="" placeholder="Please Enter Valid Phone Number"> </div> </div> </div> </div>';

			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='hidden' value='us' class='selected_country' name='selected_country'><input class='international-phone-number sqb_and_field sqb_input_ans_field sqb_phone_number_ans_field' id='international-phone-number' name='sqb_ans_"+sqb_round_no+"' placeholder='' >"+extra_options+"</div>";
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "weight_and_height"){

			var extra_options = '<div class="question-type-hw-validation-outer"> <span> ... </span> <div class="sqb-hw-type-options" style="display: none;"> <div class="sqb-hw-type"> <label class="setup-validation pb-1">Setup Validation</label></div> <div class="sqb-hw-type-validation-required-option"> <div class="d-flex justify-content-between align-items-center"></div> </div> <div class="sqb-hw-type-validation-option"> <div class=""> <label class="mb-2">Enter Validation Message</label> <input type="text" class="validation-hw-type" name="validation-hw-type" value="" placeholder="Please Enter Values"> </div> </div> </div> </div>';

			var ans_box = "<div class='sqb_ans_item ans_type_height_weight' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'> <div class='weight-options-outer'> <div class='weight-options-inner sqb_ans_weight'> <div class='sqb_tiny_mce_editor'> <div> <span style='font-weight: bold; font-size: 12pt;'>Weight</span> </div> </div> <div class='weight-options'> <input class='weight-input' type='text' name='weight' placeholder='lbs'> </div> </div> <div class='weight-options-inner sqb_ans_feet_inches'> <div class='sqb_tiny_mce_editor mce-content-body'> <div> <span style='font-weight: bold; font-size: 12pt;'>Height</span> </div> </div> <div class='weight-options-inner-wrapper'> <div class='weight-options sqb_ans_feet'> <input class='height-feet' type='text' name='feet' placeholder='feet'> </div> <div class='weight-options sqb_ans_inches'> <input class='height-inches' type='text' name='inches' placeholder='inches'> </div> </div> </div>"+extra_options+"</div>";

			sqb_tiny_mce_editor();
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');

			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbHideQuesTemplateImage').trigger('click');
			}*/
			
		}else if(ques_type == "date"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item sqb-time-option' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='text' class='input-group date-question-type sqb_and_field sqb_input_ans_field' name='sqb_ans_"+sqb_round_no+"' data-month-name='January,February,March,April,May,June,July,August,September,October,November,December' data-day-name='Su,Mo,Tu,We,Th,Fr,Sa' data-date-format='yy-mm-dd' data-field-type='date' placeholder='Enter Date'><div class='show-datepicker-popup'><i class='fa fa-calendar' aria-hidden='true'></i></div><div class='quiz-content-card question-type-card show-date-options'><label>Select Format</label><div class='dropdown dropdown-custom-style' style=''><button class='dropdown-toggle select-date-format' type='button' data-value='yy-mm-dd'>YYYY-MM-DD</button><ul class='dropdown-menu select_date_type'> <li><a href='javascript:void(0)' value='yy-mm-dd' class='active'>YYYY-MM-DD</a></li> <li><a href='javascript:void(0)' value='yy-dd-mm'>YYYY-DD-MM</a></li> <li><a href='javascript:void(0)' value='dd-mm-yy'>DD-MM-YYYY</a></li> <li><a href='javascript:void(0)' value='mm-dd-yy'>MM-DD-YYYY</a></li> <li><a href='javascript:void(0)' value='yy/mm/dd'>YYYY/MM/DD</a></li> <li><a href='javascript:void(0)' value='yy/dd/mm'>YYYY/DD/MM</a></li> <li><a href='javascript:void(0)' value='dd/mm/yy'>DD/MM/YYYY</a></li> <li><a href='javascript:void(0)' value='mm/dd/yy'>MM/DD/YYYY</a></li> <li><a href='javascript:void(0)' value='yy.mm.dd'>YYYY.MM.DD</a></li> <li><a href='javascript:void(0)' value='yy.dd.mm'>YYYY.DD.MM</a></li> <li><a href='javascript:void(0)' value='dd.mm.yy'>DD.MM.YYYY</a></li> <li><a href='javascript:void(0)' value='mm.dd.yy'>MM.DD.YYYY</a></li> </ul></div></div></div>";
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			
			
		}else if(ques_type == "numerical_text"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var numeric_option_extra = "";
			var correct_ans_show = "";
			if(quiz_type  == 'scoring' || quiz_type  == 'calculator' || 'assessment'){
				if(quiz_type  == 'calculator'){
					correct_ans_show = 'style="display:none;"';
				}
				numeric_option_extra = "<div class='answer_level_dot_button sqb_ans_disable_dds numeric-correct-outer'><div class='dropdown-link-style dropdown'> <button class='dropdown-toggle' type='button' id='dropdownMenuButtonAnslevel' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'> <span> ...</span></button><div class='dropdown-menu' aria-labelledby='dropdownMenuButtonAnslevel' x-placement='bottom-start'><div class='show-numeric-points' "+points_ans_checkbox_show+"><strong><label class='mb-2'>Points <div class='tool-tip'> <i class='fa fa-info-circle' aria-hidden='true'></i> <div class='toll-tip-desc'>Users will be assigned points for correct answer. If there are no points, leave empty</div> </div></label></strong><input type='number' name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1'></div><div class='numeric-correct-answer mt-2' "+correct_ans_show+"><label class='mb-2'><strong>Correct Answer Value <div class='tool-tip'> <i class='fa fa-info-circle' aria-hidden='true'></i> <div class='toll-tip-desc'>The answer users enter will be matched against this value and only if it matches, they will be assigned points for the correct answer.</div> </div></strong></label><input type='number' name='numeric_correct_answer' title='Correct Answer Value' class='correct_answer'></div></div></div></div>";
			}

			var ans_box = "<div class='sqb_ans_item ans_type_numeric_text' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><div class='sql_ans_text sqb_tiny_mce_editor'><div>Enter Value Here</div></div></div><div class='numeric-value-prefix'><div class='sqb_tiny_mce_editor numeric_value_prefix'><div>$</div></div><input type='number' min='0' max='100000' name='sqb_ans_"+sqb_round_no+"' title='Enter Value Here' class='form-control sqb_and_field' ><div class='sqb_tiny_mce_editor numeric_value_sufix'><div>%</div></div></div>"+numeric_option_extra+"</div>";
			sqb_tiny_mce_editor();
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			
		}else if(ques_type == "fill_in_blank"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input type='text' class='sqb_and_field sqb_input_ans_field sqb_fill_in_blank_ans_field' name='sqb_ans_"+sqb_round_no+"' placeholder='Enter the text here' ><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
		}else if(ques_type == "slider"){
			var ans_box = "<div class='sqb_ans_item sqb_ans_item_slider' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><span class='answer_slider_options_show sqb_backend_show '>Click to customize</span> <div class='type-slider-outer'><input name='sqb_ans_"+sqb_round_no+"' id='sqb_ans_slider_"+sqb_round_no+"' class='slider sqb_ans_slider' data-slider-id='ex1Slider' type='text' data-slider-min='0' data-slider-max='100' data-slider-step='1' data-slider-value='0' top_box_b_clr='#333'  suffix_text='%' prefix_text ='' complete_bar_b_clr='#333' slider_b_clr= '#fff'><div class='slider_label sqb_tiny_mce_editor '><div class='slider_label_start' style='text-align: left;'>start</div> <div class='slider_label_middle' style='text-align: center;'>middle</div><div class='slider_label_end' style='text-align: right;'>end</div></div></div><span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
			
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
		
		}else if(ques_type == "matrix"){
			
			var parent_selector = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table');
			if(parent_selector.find('.SQB-main-table').length == 0){
				var ans_box = "<div class='sqb_ans_item_matrix' ><span class='answer_matrix_options_show sqb_backend_show '>Click To Add/Edit Answer</span><div class='answer_matrix_save_table'></div><input type='hidden' name='matrix-column-width' value=''></div>";
				parent_obj.find('.question_add_answer_outer_div').html('');
			}
			
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			parent_obj.find('.question_add_answer_outer_div').addClass('answer-type-matrix-selected');
			parent_obj.find('.question-type-card.question_type_wrapper').addClass('answer-type-matrix-selected');
			
		}else if(ques_type == "dropdown"){
			
			var ans_box = "<div class='sqb_ans_item sqb_ans_item_dropdown' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_dropdown' ><span class='answer_dropdown_options_show sqb_backend_show '>Click To Add/Edit Dropdown</span><input type='hidden' name='dropdown-label' id='dropdown-label' value='Enter Dropdown Heading Here'><input type='hidden' name='dropdown-default-value' id='dropdown-default-value' value='----Select----'><input type='hidden' name='dropdown-fields-value' id='dropdown-fields-value' value=''></div></div>";
			
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').addClass('sqb_disable_tiny_mce_editor');
			//parent_obj.find('.question_add_answer_btn_div').hide();
			
		}else if(ques_type == "file_upload"){
			/*if(jQuery(parent_obj).find('.sqbShowQuesTemplateImageOuter').css('display','none')){
				jQuery(parent_obj).find('.sqbShowQuesTemplateImage').trigger('click');
			}*/
			var ans_box = "<div class='sqb_ans_item file-upload-wrapper' data-id='%%ANSWERID%%' id='"+sqb_round_no+"' style='padding: 0px'><div class='file-upload'><div class='file-upload-message'><i class='fa fa-cloud-upload' aria-hidden='true'></i><div class='sqb_tiny_mce_editor'>Drag and drop a file here or click</div><p class='file-upload-error'>Ooops, something wrong happended.</p></div><input type='file' name='sqb_file_upload' class='sqb_file_upload'><div class='file-upload-preview'><span class='file-upload-render'><img class='file-upload-preview-img' src=''></span><div class='file-upload-infos'><div class='file-upload-infos-inner'><p class='file-upload-filename'><span class='file-upload-filename-inner'>about.jpg</span></p><p class='file-upload-infos-message'>Drag and drop or click to replace</p></div></div></div></div><label class='uploadedFileName1 uploadedFileNamePre' style='display:none'></label></div>";
			sqb_tiny_mce_editor();
			parent_obj.find('.question_add_answer_outer_div').html('');
			parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
			
			
			jQuery('#question_file_upload').modal('show');
			if(jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val() == ''){
			jQuery('#question_file_upload').find('input[type="checkbox"]').prop('checked',false);
			}//question_file_upload_settings db column in questions_bank

			var file_setting_value = jQuery('.sqb_question_no.active').find('input[name="question_file_upload_settings"]').val();
			if (file_setting_value != '') {
				var file_settings = file_setting_value.split('|');
				var documents_arr = file_settings[0];
				jQuery.each(documents_arr.split(','), function(index, item) {
					if(jQuery('.file_type_doc:eq('+index+')').val() == item){
					jQuery('.file_type_doc:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_doc:eq('+index+')').prop('checked',false);
					}
				});
				
				var images_arr = file_settings[1];
				jQuery.each(images_arr.split(','), function(index, item) {
					if(jQuery('.file_type_img:eq('+index+')').val() == item){
					jQuery('.file_type_img:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_img:eq('+index+')').prop('checked',false);
					}
				});
				
				
				var video_arr = file_settings[2];
				jQuery.each(video_arr.split(','), function(index, item) {
					if(jQuery('.file_type_video:eq('+index+')').val() == item){
					jQuery('.file_type_video:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_video:eq('+index+')').prop('checked',false);
					}
				});
				
				
				var audio_arr = file_settings[3];
				jQuery.each(audio_arr.split(','), function(index, item) {
					if(jQuery('.file_type_audio:eq('+index+')').val() == item){
					jQuery('.file_type_audio:eq('+index+')').prop('checked',true);
					} else {
					jQuery('.file_type_audio:eq('+index+')').prop('checked',false);
					}
				});
				jQuery('#maxFileUploadSize').val(file_settings[4]);
			}
			
		}else if(ques_type == "ranking_choices"){

			if(quiz_type  == 'calculator'){
				show_ans_box_for_scroing_and_assessment = 'style="display:none"';
			}
		var ans_box = "<div class='sqb_ans_item ans_type_ranking_choices' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><div class='sqb_ans_item_inner'><figure class='sqb_ans_item_img "+sqb_ans_image_custom_size_cls+"' style='"+sqb_ans_image_custom_style+"'><img src='"+sqb_ans_empty_img+"' class='sbq_change_img img_"+sqb_round_no+"' data-class='img_"+sqb_round_no+"'></figure><div class='sql_ans_text sqb_tiny_mce_editor'><div>Type Answer Here</div></div><span class='sqbOpitionSelected'></span></div><div class='answer-options' "+show_ans_box_for_scroing_and_assessment+"><div class='answer-option-item sqb_is_right_ans_checkbox_outer sqb_ans_disable_dds' "+currect_ans_checkbox_show+"><label>Correct Answer</label><div class='checkbox-custom-style'><input title='Correct Answer' type='checkbox' %%SQBANSWERCORRECT%% name='sqb_is_right_ans_"+sqb_round_no+"' class='sqb_and_field sqb_is_right_ans custom-checkbox-input sqb_ans_disable_dds1'> <span class='custom--checkbox'></span></div></div><div class='answer-option-item ans_poins_outer_wrapper sqb_ans_disable_dds' "+points_ans_checkbox_show+"><label>Enter Points</label><input type='text'  name='ans_poins' title='Enter Ans Points' placeholder='Points' class='sqb_ans_disable_dds1' ></div></div> <span class='sqb_backend_show sqb_remove_section sqb_ans_delete_btn' data-id='"+sqb_round_no+"'><i class='fa fa-times' aria-hidden='true'></i></span></div>";
		parent_obj.find('.question_add_answer_outer_div').removeClass('sqb_disable_tiny_mce_editor');
		//parent_obj.find('.Quiz-Template-content.question_description').html('<div>Your users can re-order the answers choices based on their preference using a drag/drop interface in the frontend.</div>').show();
		}else{
			sqb_sweet_message('','Question type is wrong!','');
			return false;
		}

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template5'){
			if(ques_type == "file_upload"){
				jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').html('');
			} else {
				jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').html('<div class="sqb_quiz_template5 sqb_next_btn single_next_btn sqb_tiny_mce_editor" style="display: inline-block;border-radius: 5px;background: #917ef2;color: rgb(255, 255, 255);height: auto;padding: 13px 15px;font-family: &quot;DM Sans&quot;, sans-serif;min-width: 90px;box-shadow: none;margin: 0px;text-decoration: none;line-height: normal;border: none;text-align: center;text-transform: initial;font-size: 16px;font-weight: 600;max-width: 100%;float: right;position: relative;"><div>Next</div></div>');
				sqb_tiny_mce_editor();
			}
		}else if(selected_template == 'template6'){
			jQuery('.sqbHideQuesTemplateImage').trigger('click');
			
		}
		 
		if((ques_type == "multi") || (ques_type == "single") || (ques_type == "yes_no") || (ques_type == "rating")){
			//if((quiz_type  == 'survey') && (ques_type == "multi")){
			
			parent_obj.find('.question_add_answer_outer_div').find('.sqb_ans_item .sqb_textarea_ans_field').closest('.sqb_ans_item').remove();
			parent_obj.find('.question_add_answer_outer_div').find('.sqb_ans_item .sqb_fill_in_blank_ans_field').closest('.sqb_ans_item').remove();
		}
		
		parent_obj.find('.question_add_answer_outer_div').append(ans_box);
		if(ques_type == "slider"){
			sqb_question_type_slider_init('sqb_ans_slider_'+sqb_round_no);
			
			parent_obj.find('.question_details .sqbHideQuesTemplateImage').trigger('click');
			parent_obj.find('.question_details .sqbHideQuesDescription').trigger('click');
			
		}

		if(ques_type == "email" || ques_type == "phone_number"){
			parent_obj.find('.question_add_more_ans_btn').hide();

			if(selected_template == "template8"){
				parent_obj.find('.question_add_answer_outer_div').css('max-width', '615px');
				jQuery('#question_temp_inner_width').bootstrapSlider('setValue', '615');	
				jQuery('.question_temp_inner_width_val').val(615);
			}

		}
		if(ques_type == "phone_number"){
			parent_obj.find('.question_details .sqbHideQuesTemplateImage').trigger('click');
			var phoneInputID = ".sqb_question_no.active .international-phone-number";
			var input = document.querySelector(phoneInputID);
			var iti = window.intlTelInput(input, {
				formatOnDisplay: true,
				hiddenInput: "full_number",
				preferredCountries: ['us'],
				utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
			});

			jQuery(phoneInputID).on("countrychange", function(event) {

			var selectedCountryData = iti.getSelectedCountryData();
			newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL),

			iti.setNumber("");
				mask = newPlaceholder.replace(/[1-9]/g, "0");
				jQuery(this).mask(mask);
			});

			iti.promise.then(function() {
				jQuery(phoneInputID).trigger("countrychange");
			});
		}

		if(ques_type == "matrix"){
			parent_obj.find('.answer_matrix_options_show').trigger('click');
			parent_obj.find('.question_details .sqbHideQuesTemplateImage').trigger('click');
		}
		if(ques_type == "matching_text"){
			parent_obj.find('.question_details .sqbHideQuesTemplateImage').trigger('click');
		}
		
		sqb_tiny_mce_editor();
		sqb_re_order_answer();
		sqb_text_tiny_mce_editor();
		sqb_ans_resizeable();
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2' || selected_template == 'template3' || selected_template == 'template4'){
			var answer_color = jQuery('#temp_one_to_four_answer_backgroud_color').val();
	 		jQuery('.sqb_ans_item').css('background', answer_color);
	 	}

		if((quiz_type == 'personality') && ((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating'))){
			if(!(jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hasClass('answer_edit_text')) && ((ques_type == 'single') || (ques_type == 'multi')) ){
				jQuery(parent_obj).find('.personality_outcome_connect_btn').hide();
			}else{
				if(jQuery('.sqb_question_no.active .personality_outcome_connect_btn').find('.outcome-option-active').hasClass('outcome-option-connect')){
					jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').show();
					jQuery(parent_obj).find('.personality_outcome_connect_btn .outcome-option-connect').trigger('click');
					if(jQuery('.outcome-mapping-error').length == 0 ){
						jQuery(parent_obj).find('.question_div_inner .assessment_outcome_connect_wrapper').prepend('<div class="outcome-mapping-error">To "connect to outcome", make sure to enter answer text for all answer choices.</div>')
					}
				}else{
					jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hide();
				}
			}
			
		}else{
			jQuery('.sqb_question_no.active .assessment_outcome_connect_wrapper').hide();
		}		
		
 		if(selected_template == 'template6' || quiz_type == 'poll' || selected_template == 'template9'){

 			var get_global_val = jQuery("#global_style_css").val();
			if(get_global_val == 'Y'){
				return false;
			}

			var get_answer_bg = jQuery('.getclone_ans').find('.sqb_ans_item').css('background-color');			 
			var data_style = jQuery('.getclone_ans').find('.sql_ans_text div').attr('data-mce-style');				 
			if(typeof get_answer_bg !="undefined"){					 
				jQuery('#Quiz-Screen-Settings .sqb_questions_wrapper .sqb_ans_item').css('background-color', get_answer_bg );
				 jQuery('#ques_temp_ans_color').val(get_answer_bg);
				 var color =get_answer_bg;
			 }else{
				var color = jQuery('#ques_temp_ans_color').val(); 
			 }
			 var text_color = jQuery('.sql_ans_text span,.sql_ans_text').attr('style');
			if(typeof data_style !="undefined"){	
				text_color = data_style;			
			}
			jQuery('.sqb_questions_wrapper .sql_ans_text div').attr('style',text_color);
			var get_opacity = jQuery('input[name="select_answer_background"]').val();
			var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
		    + ',' + parseInt(color.slice(-4,-2),16)
		    + ',' + parseInt(color.slice(-2),16)
		    +','+get_opacity+')';
		    jQuery('.sqb_ans_item').css('background',rgbaCol);
 
		    //jQuery('.sql_ans_text div').css('font-weight','bold');


		    if(ques_type == "slider"){
		    	jQuery('.sqb_ans_item_slider').css('background','transparent');
		    	jQuery('.type-slider-outer .slider_label .slider_label_start, .type-slider-outer .slider_label .slider_label_middle, .type-slider-outer .slider_label .slider_label_end').css('color','#333333');
		    }
		}
		if(selected_template == 'template7' || selected_template == 'template8'){
			jQuery('.sqbHideQuesTemplateImage').trigger('click');
		}

		

	 	setTimeout(function(){
	 		if(ques_type == 'name'){
		 		jQuery('.sqb_question_no.active .sqb_ans_item').css('background', '');
		 	}
	 	}, 500);
	 	
	});
	
}

function sqb_question_type_slider_init(slider_id = ''){
			var  slider_b_clr = jQuery("#"+slider_id).attr('slider_b_clr');
			var  complete_bar_b_clr =jQuery("#"+slider_id).attr('complete_bar_b_clr');
			var  top_box_b_clr = jQuery("#"+slider_id).attr('top_box_b_clr');
			var  max_value = jQuery("#"+slider_id).attr('data-slider-max');
			var  step_value = jQuery("#"+slider_id).attr('data-slider-step');
			var  min_value = jQuery("#"+slider_id).attr('data-slider-min');
			var  prefix_text = jQuery("#"+slider_id).attr('prefix_text');
			var  suffix_text = jQuery("#"+slider_id).attr('suffix_text');
			if(prefix_text == undefined){
				prefix_text = '';
			}
			
			if(suffix_text == undefined){
				suffix_text = '';
			}
			jQuery("#"+slider_id).bootstrapSlider({formatter: function(value) {
				
				return prefix_text+''+ value +''+suffix_text ;
			}
			});
			
			
		    
			jQuery('#'+slider_id).bootstrapSlider('setAttribute', 'max', max_value);
			jQuery('#'+slider_id).bootstrapSlider('setAttribute', 'min', min_value);
			jQuery('#'+slider_id).bootstrapSlider('setAttribute', 'step', step_value);
			jQuery('#'+slider_id).attr('data-value', min_value);
			jQuery('#'+slider_id).attr('value', min_value);
			//jQuery('#'+slider_id).bootstrapSlider('setValue', min_value);
			jQuery("#"+slider_id).bootstrapSlider('refresh');
			var slider_selector = jQuery("#"+slider_id).closest('.type-slider-outer');
			slider_selector.find('.slider.slider-horizontal .slider-track').css('background-color',slider_b_clr);
			slider_selector.find('.slider.slider-horizontal .slider-handle').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .slider-track .slider-selection').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .tooltip .tooltip-inner').css('background-color',top_box_b_clr );
			
}
 

function sqb_drag_drop_cutomizer_init(){
	
	jQuery('.Template-Customize-element-btn').click(function(){
		var id = jQuery(this).attr('data-id');
		jQuery('.'+id).toggle("slow");
	});
	
	/*jQuery('.customize_close  ').on('click',function(){
		jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').hide('slow');
		jQuery('.sqb_checkout_template_drag_drop_item').removeClass('customizer_active');
		//jQuery(this).closest('.Template-Customize-Setting').find('.drop_down_content').hide('slow');
		jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
		jQuery(this).hide();
	});
	 
	jQuery('.customize_open  ').on('click',function(){
		jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		//jQuery(this).closest('.Template-Customize-Setting').find('.drop_down_content').show('slow');
		jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').show();
		jQuery(this).hide();
	});*/
	jQuery('.Template-Customize_heading').on('click',function(){
		// Check if the parent tab is active
	    var parentTab = jQuery(this).closest('.tab-content').find('.tab-pane.active');
	    
	    if (parentTab.length) {
	        var parent = jQuery(this).closest('.Template-Customize-Setting');

	        // Close any other open tabs (except the current one)
	        parentTab.find('.Template-Customize-Setting').not(parent).find('.customizer_innner_sections').slideUp('slow');
		    parentTab.find('.Template-Customize-Setting').not(parent).find('.customize_open').show();
		    parentTab.find('.Template-Customize-Setting').not(parent).find('.customize_close').hide();

	        // Toggle the clicked tab's icons and content, only for the active tab
	        parent.find('.customize_open').toggle();
	        parent.find('.customize_close').toggle();
	        parent.find('.customizer_innner_sections').slideToggle('slow');
	    }
		/*if(jQuery(this).closest('#Opt-Screen-Settings').hasClass('active')){
			jQuery(this).closest('#Opt-Screen-Settings').find('.customize_open').hide();
			jQuery(this).closest('#Opt-Screen-Settings').find('.customize_close').show();
			jQuery(this).closest('#Opt-Screen-Settings').find('.customizer_innner_sections').hide('slow');
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		}else if(jQuery(this).closest('#Quiz-Screen-Settings').hasClass('active')){
			jQuery(this).closest('#Quiz-Screen-Settings').find('.customize_open').hide();
			jQuery(this).closest('#Quiz-Screen-Settings').find('.customize_close').show();
			jQuery(this).closest('#Quiz-Screen-Settings').find('.customizer_innner_sections').hide('slow');
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		}else if(jQuery(this).closest('#Result-Screen-Settings').hasClass('active')){
			jQuery(this).closest('#Result-Screen-Settings').find('.customize_open').hide();
			jQuery(this).closest('#Result-Screen-Settings').find('.customize_close').show();
			jQuery(this).closest('#Result-Screen-Settings').find('.customizer_innner_sections').hide('slow');
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		}else if(jQuery(this).closest('#Start-Screen-Settings').hasClass('active')){
			jQuery(this).closest('#Start-Screen-Settings').find('.customize_open').hide();
			jQuery(this).closest('#Start-Screen-Settings').find('.customize_close').show();
			jQuery(this).closest('#Start-Screen-Settings').find('.customizer_innner_sections').hide('slow');
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
			jQuery(this).closest('.Template-Customize-Setting').find('.customizer_innner_sections').show('slow');
		}else{		 
			if(jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').css('display') =="none"){	
				jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').show();
				jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').hide();
			}else{			 	
				jQuery(this).closest('.Template-Customize-Setting').find('.customize_close').hide();
				jQuery(this).closest('.Template-Customize-Setting').find('.customize_open').show();
			}
		}*/
	});
	
	
	
	
}

function sqb_delete_question(){
	
	jQuery(document).on('click','.sqb_question_no .delete-qa-row',function(){
		
		
		var current_obj = this;
		swal({
		title: "Are you sure you want to delete ?",
		text: "You cannot recover the settings.",
		//type: "warning",
		showCancelButton: true,
		showCloseButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, Delete!",
		customClass: '',
		
		}).then((result) => {
			if (result.value) {
				var all_qns_count = jQuery("#get_all_qns_count").val();
				jQuery('#get_all_qns_count').val(parseInt(all_qns_count) - 1);

			 	jQuery('.left_side_question_list ul li').eq(jQuery(current_obj).closest('.sqb_question_no').index()).remove();
				 jQuery(current_obj).closest('.sqb_question_no').remove();
				 jQuery('.left_side_question_list ul .active').remove();
				
				 
				var question_id = jQuery(current_obj).closest('.sqb_question_no').find('.sqb_question_enable_drag_drop').attr('data-id');
				jQuery('.question-list .dropdown-item[data-value="'+question_id+'"]').remove();

				var quiz_id = jQuery('#edit_id').val();
				if (typeof question_id === "undefined") {
				}else{
					
					jQuery.post(ajaxurl, {
						action: 'sqb_quiz_question_delete_single',
						quiz_id: quiz_id,
						question_id: question_id,   
						}, function(response) {	
							
							response = JSON.parse(response);
							
							if((response.reload_page) && (response.reload_page == 'Y')){
								window.location.href = sqb_get_url_without_edit_quiz_query_string()+"&sqb_page="+1;
								return false;
							}
							
							var sqb_question_no = jQuery('.left_side_question_list ul li').first().find('a').attr('data-questionno');
							if(sqb_question_no == ''|| sqb_question_no == 'undefined'|| sqb_question_no == null ){
							  var page = jQuery('select.selected-question').val();
							  if(typeof page == undefined || typeof page == "undefined"){
									 page = 1;
							  }else{
									 page = page-1;
							  }
								 
							  //sqb_showPage(page, sqb_add_question_pagination_limit , add_new_question_fe_call = 'N');
							  window.location.href = sqb_get_url_without_edit_quiz_query_string()+"&sqb_page="+page;
							}
						
					});
					
					
				}
				 
				if(jQuery('.left_side_question_list ul li').length > 0){
					jQuery('.left_side_question_list ul li').last().find('a').trigger('click');
					var question_show_div_id = jQuery('.left_side_question_list ul li').last().find('a').attr('href');
					jQuery(question_show_div_id).addClass(' show active ');
				}
				sqbDeledteAllQuestionShowHideDiv();
				
				
			}
		});		
		
		
		
		
		
	});
}

function sqb_mediauploader_question_tab(){
	
	jQuery(document).on('click','.sbq_change_img',function() {
		var data = jQuery(this);
	   	var sqb_mediauploader;
	   	window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery(data).parent().find('.sqb_img_draggable').attr('src', attachment.url);
			jQuery(data).parent().find('.sqb_img_draggable').attr('alt', attachment.alt);
			jQuery(data).parent().find('.sbq_change_img').attr('src', attachment.url);
			jQuery(data).parent().find('.sbq_change_img').attr('alt', attachment.alt);
			
		});
		sqb_mediauploader.open();
	});
} 

function sqb_mediauploader_lead_tab(){
	
	jQuery(document).on('click','.sbq_change_lead_img',function() {
		var data = jQuery(this);
	   	var sqb_mediauploader;
	  	window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery(data).parent().find('.lead_screen_temp_img').attr('src', attachment.url);
			jQuery(data).parent().find('.sbq_change_lead_img').attr('src', attachment.url);
			
		});
		sqb_mediauploader.open();
	});
} 

function sqb_game_animation_audio_upload(){
	jQuery(document).on('click','#game_animation_audio_button',function() {
		
		
		var sqb_mediauploader;
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Audio',
			button: {
				text: 'Choose Audio'
			},
			library: {
				type: [ 'video', 'audio' ]
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery('#game_animation_audio_url').val(attachment.url);
			jQuery('.sqb_gameanimation_player_audio').attr('src',attachment.url);
			jQuery('.sqb_gameanimation_player_audio').attr('alt',attachment.alt);
			jQuery('.audioPreview').show();
		});
		
		sqb_mediauploader.open();
	});
}

function sqb_game_animation(){
	jQuery('#sqb_game_animation_background_color_div').colorpicker().on('changeColor', function() {
		jQuery('#game_animation_background_color').val(jQuery(this).colorpicker('getValue'));
	}); 

	jQuery(document).on('change','#game_animation',function() {

		if(jQuery(this).prop('checked') == true){
			jQuery('.game-animation-wrapper').show();
		}else{
			jQuery('.game-animation-wrapper').hide();
		}

	});

	jQuery('.gameanimation_cutomizer_show_option').on('click',function(){
		if(jQuery(this).hasClass('gameanimation_cutomizer_show_option_cutomize')){
		}else{
			jQuery(this).addClass('gameanimation_cutomizer_show_option_cutomize');
			
		}
		
		if(jQuery(this).hasClass('gameanimation_cutomizer_show_option_cutomize_open')){
			jQuery(this).removeClass('gameanimation_cutomizer_show_option_cutomize_open');
			jQuery('.gameanimation_cutomizer_show_div').hide('slow');
		}else{
			jQuery(this).addClass('gameanimation_cutomizer_show_option_cutomize_open');
			jQuery('.gameanimation_cutomizer_show_div').show('slow');
		
		}
		
		
	});

	jQuery(document).on('change','#different_message_outcome',function() {
		var quiz_type  = jQuery('input[name="quiz_type"]:checked').val();
		if(jQuery("#different_message_outcome").prop('checked') == true){
			jQuery('.game_animation_outcome').show();
			jQuery('.sqb_showhide_anim_enable_outcome').show();

			if(quiz_type == 'scoring'){
				jQuery('.show-for-scoring').show();
			}
		}else{
			jQuery('.game_animation_outcome').hide();
			jQuery('.sqb_showhide_anim_enable_outcome').hide();
			if(quiz_type == 'scoring'){
				jQuery('.show-for-scoring').hide();
			}
		}

	});

		jQuery(document).on('click', '.sqb_gameanimation_audio_play_pause', function(){
		
		var current_obj = jQuery(this);
		jQuery(current_obj).closest('.sqb_gameanimation_player_audio_div').find('.sqb_gameanimation_player_audio').trigger('click');
		
	});

	jQuery(document).on('click', '.sqb_gameanimation_player_audio', function(){
	if (this.paused == false) {
			this.pause();
		} else {
			this.play();
		}
	});
	
	jQuery(document).on('keyup', 'input[name="game_animation_audio_url"]', function(){
		var current_obj = jQuery(this);
		var audio_src = jQuery(this).val();
		if(audio_src == ''){
			jQuery(current_obj).closest('.quiz_gameanimation_wrapper').find('.audioPreview').html('');
		}else{
			jQuery(current_obj).closest('.quiz_gameanimation_wrapper').find('.audioPreview').html('<div class="sqb_gameanimation_player_audio_div"><audio class="sqb_gameanimation_player_audio" src="'+audio_src+'"></audio><button type="button"  class="sqb_gameanimation_audio_play_pause">Play/Pause</button></div>');
		}
	});


	jQuery(document).on('change','input[name="game_animation_template"]',function() {

		jQuery('input[name="game_animation_custom_template"]').val("");
		jQuery('.animation-listing-block').removeClass('active');
		jQuery(this).closest('.animation-listing-block').addClass('active');
		jQuery('.c_ta_select_animation_template1').hide();

		if(jQuery(this).val() == 'template1' || jQuery(this).val() == 'template2' ){
			tinymce.get("game_animation_text").setContent('<p><span style="font-size: 24pt;" data-mce-style="font-size: 24pt;"><strong><span style="color: #18514a;" data-mce-style="color: #18514a;">%%FIRST_NAME%% Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>');	
		}else if(jQuery(this).val() == 'template3'){
			tinymce.get("game_animation_text").setContent('<p><span style="font-size: 24pt; color: #333300;"><strong>Great Job, %%FIRST_NAME%%! 🏆</strong></span></p>');	
		}else if(jQuery(this).val() == 'template4'){
			tinymce.get("game_animation_text").setContent('<p><span style="font-size: 15pt; color: #333300;"><strong>Awesome %%FIRST_NAME%% 🎉 Keep going! 💪</strong></span></p>');	
		}

		
		if(jQuery(this).val() == 'template2' || jQuery(this).val() == 'template3' || jQuery(this).val() == 'template4'){
			jQuery('.game_animation_background_color_div').show();
		}else{
			jQuery('.game_animation_background_color_div').hide();
		}

		if(default_background_color[jQuery(this).val()] != undefined){
			jQuery('#game_animation_background_color').val(default_background_color[jQuery(this).val()]);
		}

	});

	jQuery(document).on('click','.custom-template-remove',function() {
		jQuery('input[name="game_animation_custom_template"]').val("");
		jQuery('.imagePreview img').attr('src','');
		jQuery('.imagePreview').hide();
		jQuery(this).hide();
	});

	jQuery('.game_animation_outcome').on('click', function(){

		var outcome_html = '';
		var i= 1; 			
		jQuery( ".res_data_cont" ).each(function( index ) {
			
			var outcome_id = jQuery( this ).find('#outcome_id').val() ;
			var outcome_name = jQuery( this ).find('.outcome_name').val() ;
			if(jQuery.isNumeric(outcome_id)){
				outcome_html += '<option class="option-outcome" value="'+outcome_id+'" data-outcome-id="'+outcome_id+'">'+outcome_name+'</option>'
				i++;
			}
		});
		
		jQuery('.all_outcome_div').html('<option value="0">Select an Outcome</option>'+outcome_html); 
		jQuery('#quiz_game_animation_outer_group').modal('show');

	});

	jQuery(document).on('change','#outcome_id_ga',function() {

		var outcome_id = jQuery('#outcome_id_ga option:selected').val();
		if(outcome_id){
			jQuery('.game-animation-body-option').css('opacity', '0.3');
			jQuery.post(ajaxurl, {
				action: 'sqbLoadcomeGameAnimation',
				action_val: 'load',
				outcome_id: outcome_id,
				}, function(response) {
					jQuery('.game-animation-body-option').css('opacity', '1');
					response = JSON.parse(response);		
					if(response.msg =='success'){
						jQuery('#quiz_game_animation_outer_group .align-items-start').show();
						jQuery('#quiz_game_animation_outer_group .quiz-popup-actions').show();
						if(response.data){
							tinymce.get("game_animation_html_body").setContent(response.data);	
						}else{

							var anim_template = jQuery('input[name="game_animation_template"]:checked').val();
							if(anim_template == 'template1' || anim_template == 'template2' ){
								tinymce.get("game_animation_html_body").setContent('<p><span style="font-size: 24pt;" data-mce-style="font-size: 24pt;"><strong><span style="color: #18514a;" data-mce-style="color: #18514a;">%%FIRST_NAME%% Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>');	
							}else if(anim_template == 'template3'){
								tinymce.get("game_animation_html_body").setContent('<p><span style="font-size: 24pt; color: #333300;"><strong>Great Job, %%FIRST_NAME%%! 🏆</strong></span></p>');	
							}else if(anim_template == 'template4'){
								tinymce.get("game_animation_html_body").setContent('<p><span style="font-size: 15pt; color: #333300;"><strong>Awesome %%FIRST_NAME%% 🎉 Keep going! 💪</strong></span></p>');	
							}else{
								tinymce.get("game_animation_html_body").setContent('<p><span style="font-size: 24pt;" data-mce-style="font-size: 24pt;"><strong><span style="color: #18514a;" data-mce-style="color: #18514a;">Way to go 🎉! Keep going! 💪🏆</span></strong></span></p>');	
							}
						}
					}
			});
		}else{
			jQuery('#quiz_game_animation_outer_group .align-items-start').hide();
			jQuery('#quiz_game_animation_outer_group .quiz-popup-actions').hide();
		}
		

	});
	jQuery(document).on('click', '.save_outcome_game_animation', function(){		 	
		
		var enabled_game_animation = "N";
		if(jQuery('#game_animation').prop('checked') == true){
			var enabled_game_animation = 	"Y";		
		}	
		var answers_id = '';		
		var quiz_id = jQuery('#edit_id').val();
		var outcome_id = jQuery('#outcome_id_ga option:selected').val();
		var content = tinymce.get("game_animation_html_body").getContent();

		if(enabled_game_animation =="Y"){
			if(outcome_id ==0 ){
				swal("Please select an outcome");
				jQuery('#outcome_id_ga').focus();
				return false;
			}
		}
		
		jQuery('.save_outcome_game_animation').text("Saving...");
		jQuery.post(ajaxurl, {
			action: 'sqbSaveOutcomeGameAnimation',
			action_val: 'save',
			content : content,
			outcome_id: outcome_id,
			quiz_id: quiz_id,
			}, function(response) {
				if(enabled_game_animation =="Y"){
					response = JSON.parse(response);							
					if(response.msg =='success'){
						
					}else{
										
					}
				}
				jQuery('.save_outcome_game_animation').text("Save");
		});
 
	});

}
function sqb_game_animation_template_upload(){
	jQuery(document).on('click','.animation_upload_button',function() {
		
		
		var sqb_mediauploader;
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			
			jQuery('#game_animation_custom_template').val(attachment.url);
			jQuery('input[name="game_animation_template').prop("checked", false);
			jQuery('.custom-template-remove').show();
			jQuery('.imagePreview img').attr('src',attachment.url);
			jQuery('.imagePreview img').attr('alt',attachment.alt);
			jQuery('.animation-listing-block').removeClass('active');
			jQuery('.imagePreview').show();
			jQuery('.image-buttons').show();
			jQuery('.c_ta_select_animation_template1').show();

		});
		
		sqb_mediauploader.open();
	});
}

function sqb_mediauploader_startscreen_tab(){

	jQuery(document).on('click','.sqb_change_start_screen_bg_image',function() {
		
		var data = jQuery(this);
	   var sqb_mediauploader;
	   window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			
			jQuery('.Quiz-start-Template5-left').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+attachment.url+')');
			jQuery('.Quiz-start-Template5-left').css('background-size','640px');
			jQuery('.Quiz-start-Template5-left').css('background-repeat','no-repeat');
			jQuery('.Quiz-start-Template5-left').css('background-position','center center');
			jQuery('.Quiz-start-Template5-left').addClass('sqb_start_screen_background_image');
		});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_remove_global_image',function() {
		jQuery("body").get(0).style.setProperty("--sqb_global_background_image", '');
		jQuery("body").get(0).style.setProperty("--template8-background-image", '');
		jQuery('#sqb_global_background_image').text('');
		jQuery('#sqb_global_background_image_url').val('');

		jQuery('#template8_background_image_url').val('');
		jQuery('#template8_background_image').val('');
		jQuery('#sqb_global_temp_gl_background_image').val('');

		jQuery('.start_temp_static_div, .outcome-section, .question-screen, .optin_template_html_preview_outer').removeClass('sqb_start_screen_background_image');

		if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){
			jQuery('#Start-Screen-Settings .start_temp_static_div').css('background-image','none').addClass('removebgimage');
			jQuery('#Outcome-Display .outcome-section').css('background-image','none').addClass('removebgimage');
			jQuery('#Quiz-Screen-Settings .question-screen').css('background-image','none').addClass('removebgimage');
			jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-image','none').addClass('removebgimage');
			var sqb_remaining_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(sqb_remaining_style);
		}
	});

	jQuery(document).on('click','.sqb_change_global_image',function() {
		
		var data = jQuery(this);
	   var sqb_mediauploader;
	   window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery('#sqb_global_background_color').colorpicker('setValue', 'rgba(239,243,245,0.10)');
			var rgbaCol = 'rgba(239,243,245,0.10)';
			var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url('+attachment.url+')';
			jQuery("body").get(0).style.setProperty("--sqb_global_background_image", 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url("'+attachment.url+'")');
			jQuery('#sqb_global_background_image').text(sqb_linear_gradient);
			jQuery('#sqb_global_background_image_url').val(attachment.url);

			jQuery('#template8_background_image').val(sqb_linear_gradient);
			jQuery('#template8_background_image_url').val(attachment.url);
			
			jQuery('.start_temp_static_div, .outcome-section, .question-screen, .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');

			jQuery('.start_temp_static_div').attr('style', '');
			jQuery('.outcome-section').attr('style', '');
			jQuery('.question-screen').attr('style', '');
			jQuery('#bg_imge_style').val('');
		});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_change_global_setting_image',function() {
		
		var data = jQuery(this);
		var sqb_mediauploader;
		window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery('#sqb_global_background_color').colorpicker('setValue', 'rgba(239,243,245,0.10)');
			var rgbaCol = 'rgba(239,243,245,0.10)';
			var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url('+attachment.url+')';
			jQuery("body").get(0).style.setProperty("--sqb_global_background_image", 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url("'+attachment.url+'")');
			jQuery('#sqb_gl_background_image').val(sqb_linear_gradient);
			jQuery('#sqb_global_temp_gl_background_image').val(attachment.url);

			jQuery('.start_temp_static_div, .outcome-section, .question-screen, .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');
		});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_change_start_screen_bg_image_template6',function() {
		var data = jQuery(this);
	   var sqb_mediauploader;
	   window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			if(jQuery('input[name="select_temp"]:checked').val() == 'template7'){
				
				var color = jQuery('#sqb_global_temp_background').val();
				var opacity = jQuery('#sqb_global_temp_bg_opacity').val();
				var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
					+ ',' + parseInt(color.slice(-4,-2),16)
					+ ',' + parseInt(color.slice(-2),16)
					+','+opacity +')';
				var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url('+attachment.url+')';
				
				var global_start_screen_style = '.sqb_global_theme_enable_each_template .start_temp_static_div { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
				
				jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');

				var global_outcome_screen_style = '.sqb_global_theme_enable_each_template .outcome-section { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
				jQuery('.outcome-section').addClass('sqb_start_screen_background_image');
				
				var global_question_screen_style = '.sqb_global_theme_enable_each_template .question-screen { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
				jQuery('.question-screen').addClass('sqb_start_screen_background_image');
				
				var global_optin_screen_style = '.sqb_global_theme_enable_each_template .optin_template_html_preview_outer { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');
				
				global_start_screen_style = global_start_screen_style+" .sqb_global_theme_enable_each_template .quiz_start_template_outer {background-image: "+sqb_linear_gradient+" !important;}	";	
				global_question_screen_style = global_question_screen_style+" .sqb_global_theme_enable_each_template .quiz_quesans_template_outer, .quiz_quesans_template_outer .modal_pop_inn  {background-image: "+sqb_linear_gradient+" !important;}	";
				global_optin_screen_style = global_optin_screen_style+" .sqb_global_theme_enable_each_template .quiz_optin_template_outer,  .quiz_optin_template_outer .modal_pop_inn {background-image: "+sqb_linear_gradient+" !important;}	";
				global_outcome_screen_style = global_outcome_screen_style+" .sqb_global_theme_enable_each_template .quiz_result_template_outer,  .quiz_result_template_outer .modal_pop_inn {background-image: "+sqb_linear_gradient+" !important;}	";
				
				var temp_values_global_style_dynamic = '#temp_values_global_style_dynamic_div { background-image: '+sqb_linear_gradient+' !important;}';
				jQuery('#start_screen_global_style_dynamic').append(global_start_screen_style);
				jQuery('#outcome_screen_global_style_dynamic').append(global_outcome_screen_style);
				jQuery('#question_screen_global_style_dynamic').append(global_question_screen_style);
				jQuery('#opt_screen_global_style_dynamic').append(global_optin_screen_style);
				jQuery('#temp_values_global_style_dynamic').append(temp_values_global_style_dynamic);
				
				jQuery("#sqb_global_temp_bg_opacity").bootstrapSlider('setValue', 0.8);
				jQuery("#sqb_global_temp_bg_opacity").trigger('change');
				
			}else if(jQuery('input[name="select_temp"]:checked').val() == 'template8'){
				jQuery('#template8_background_color_value').val('rgba(255,255,255,0.5)');
				jQuery('.temp8_backgroud_color').val('rgba(255,255,255,0.5)');

				var color = jQuery('#template8_background_color_value').val();
				if(color.match("^rgba")){	
					var rgbaCol = color;
				}else{
					// var opacity = jQuery('#template8_bg_img_opacity').val();
					var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
						+ ',' + parseInt(color.slice(-4,-2),16)
						+ ',' + parseInt(color.slice(-2),16)
						+',0.1)';
				}

				
				var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url('+attachment.url+')';
				
				jQuery("#template8_background_image").val(sqb_linear_gradient);
				jQuery("#template8_background_image_url").val(attachment.url);

				jQuery("body").get(0).style.setProperty("--template8-background-image", sqb_linear_gradient);
				
				jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
				jQuery('.outcome-section').addClass('sqb_start_screen_background_image');
				jQuery('.question-screen').addClass('sqb_start_screen_background_image');
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');
				//jQuery('.temp8_bgcolor').hide();
			}else if(jQuery('input[name="select_temp"]:checked').val() == 'template9'){
				jQuery('#template9_background_color_value').val('rgba(255,255,255,0.5)');
				jQuery('.temp8_backgroud_color').val('rgba(255,255,255,0.5)');

				//var color = jQuery('#template9_background_color_value').val();
				var color = '#ffffff';
				if(color.match("^rgba")){	
					var rgbaCol = color;
				}else{
					// var opacity = jQuery('#template9_bg_img_opacity').val();
					var rgbaCol = 'rgba(' + parseInt(color.slice(-6,-4),16)
						+ ',' + parseInt(color.slice(-4,-2),16)
						+ ',' + parseInt(color.slice(-2),16)
						+',0.1)';
				}

				
				var sqb_linear_gradient = 'linear-gradient('+rgbaCol+','+ rgbaCol+'),url('+attachment.url+')';
				
				jQuery("#template9_background_image").val(sqb_linear_gradient);
				jQuery("#template9_background_image_url").val(attachment.url);

				jQuery("body").get(0).style.setProperty("--template9-background-image", sqb_linear_gradient);
				
				jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
				jQuery('.outcome-section').addClass('sqb_start_screen_background_image');
				jQuery('.question-screen').addClass('sqb_start_screen_background_image');
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');
				//jQuery('.temp8_bgcolor').hide();
			} else {

				if(jQuery('input[name="select_temp"]:checked').val() == 'template6'){

					jQuery('.start_temp_static_div').css('background-image','url('+attachment.url+')');
					jQuery('.start_temp_static_div').css('background-repeat','no-repeat');
					jQuery('.start_temp_static_div').css('background-position','center center');
					jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
					var opacity = jQuery('#sqb_global_temp_bg_opacity').val();
					if(opacity == 0){
						jQuery('#sqb_global_temp_bg_opacity').bootstrapSlider('setValue', 0.8);
					}
					jQuery('.template6-background-color-outer').hide();
					/*if (jQuery(".outcome-screen-background-customizer").css('display') !== 'none'){
					} else {
						jQuery('.start_temp_static_div').css('background-image','url('+attachment.url+')');
						jQuery('.start_temp_static_div').css('background-repeat','no-repeat');
						jQuery('.start_temp_static_div').css('background-position','center center');
						jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
					}*/
				} else {
					var bg_image = jQuery('.start_temp_static_div').css('background-image');
					if(bg_image != 'none'){
						jQuery('.start_temp_static_div').css('background-image','url('+attachment.url+')');
						jQuery('.start_temp_static_div').css('background-repeat','no-repeat');
						jQuery('.start_temp_static_div').css('background-position','center center');
						jQuery('.start_temp_static_div').addClass('sqb_start_screen_background_image');
					}
				}
		    
				jQuery('.outcome-section').css('background-image','url('+attachment.url+')');
				jQuery('.outcome-section').css('background-repeat','no-repeat');
				jQuery('.outcome-section').css('background-position','center center');
				jQuery('.outcome-section').addClass('sqb_start_screen_background_image');

				jQuery('.question-screen').css('background-image','url('+attachment.url+')');
				jQuery('.question-screen').css('background-repeat','no-repeat');
				jQuery('.question-screen').css('background-position','center center');
				jQuery('.question-screen').addClass('sqb_start_screen_background_image');

				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-image','url('+attachment.url+')');
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-repeat','no-repeat');
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-position','center center');
				jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').addClass('sqb_start_screen_background_image');
				
				var opt_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
				jQuery('#bg_imge_style').val(opt_style);
			}	
			
			});
		
		sqb_mediauploader.open();
	});

	jQuery(document).on('click','.sqb_remove_bg_image_template6',function() {
		if(jQuery('input[name="select_temp"]:checked').val() == 'template8'){
			jQuery('#template8_background_color_value').val('#eff3f5');
			jQuery('.temp8_backgroud_color').val('#eff3f5');
			jQuery('.start_temp_static_div').removeClass('sqb_start_screen_background_image');
			jQuery('.outcome-section').removeClass('sqb_start_screen_background_image');
			jQuery('.question-screen').removeClass('sqb_start_screen_background_image');
			jQuery('.optin_template_html_preview_outer').removeClass('sqb_start_screen_background_image');
			jQuery("#template8_background_image").val('');
			jQuery("#template8_background_image_url").val('');
			//jQuery('.temp8_bgcolor').show();
		}else{
			jQuery('#Start-Screen-Settings .start_temp_static_div').css('background-image','none').addClass('removebgimage');
			jQuery('#Outcome-Display .outcome-section').css('background-image','none').addClass('removebgimage');
			jQuery('#Quiz-Screen-Settings .question-screen').css('background-image','none').addClass('removebgimage');
			jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').css('background-image','none').addClass('removebgimage');
			var sqb_remaining_style = jQuery('#Opt-Screen-Settings .optin_template_html_preview_outer').attr('style');
			jQuery('#bg_imge_style').val(sqb_remaining_style);
			jQuery('.template6-background-color-outer').show();
		}
	});
	
	jQuery(document).on('click','.sqb_change_question_screen_bg_image',function() {
		
		var data = jQuery(this);
	   var sqb_mediauploader;
	   window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+attachment.url+')');
			jQuery('.sqb_question_no.active').find('input[name="question_background_image"]').val(attachment.url);
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size','640px');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-repeat','no-repeat');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-position','center center');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').addClass('sqb_start_screen_background_image');
			jQuery('.sqb_question_no.active').find('input[name="enable_question_background_image"]').val('Y');
		});
		sqb_mediauploader.open();
	});
	
	jQuery(document).on('click','.sqb_change_outcome_screen_bg_image',function() {
		
	   var data = jQuery(this);
	   var sqb_mediauploader;
	   window.sqb_img_class = jQuery(this).attr('data-class');	 
		if (sqb_mediauploader) {
			sqb_mediauploader.open();
			return;
		}
		sqb_mediauploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});
		sqb_mediauploader.on('select', function() {
			attachment = sqb_mediauploader.state().get('selection').first().toJSON();
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+attachment.url+')');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size','640px');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-repeat','no-repeat');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-position','center center');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').addClass('sqb_start_screen_background_image');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('padding','30px 20px');
		});
		sqb_mediauploader.open();
	});	
} 


function sqb_tiny_mce_editor_rename() {
	 tinymce.init({
        selector: '.sqb_tiny_mce_editor',
        inline: true,
        height: 500,
        theme: 'modern',
        force_br_newlines: true,
        force_p_newlines: false,
        resize: "both",
        object_resizing: "img",
        forced_root_block: '', 
        fontsize_formats: "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 22pt 24pt 26pt 30pt",
        theme_advanced_fonts: "Andale Mono=andale mono,times;" + "Arial=arial,helvetica,sans-serif;" + "Arial Black=arial black,avant garde;" + "Book Antiqua=book antiqua,palatino;" + "Comic Sans MS=comic sans ms,sans-serif;" + "Courier New=courier new,courier;" + "Georgia=georgia,palatino;" + "Helvetica=helvetica;" + "Impact=impact,chicago;" + "Symbol=symbol;" + "Tahoma=tahoma,arial,helvetica,sans-serif;" + "Terminal=terminal,monaco;" + "Times New Roman=times new roman,times;" + "Trebuchet MS=trebuchet ms,geneva;" + "Verdana=verdana,geneva;" + "Webdings=webdings;" + "Wingdings=wingdings,zapf dingbats",
        plugins: ['advlist autolink lists link image charmap print preview hr anchor pagebreak', 'searchreplace wordcount visualblocks visualchars code fullscreen', 'insertdatetime media nonbreaking save table contextmenu directionality', 'emoticons template paste textcolor colorpicker textpattern imagetools'],
        toolbar1: 'insertfile undo redo | styleselect | bold italic |  fontselect | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }]
    });
}
 
function sqb_add_more_question(){
	
	if(jQuery('.left_side_question_list ul li').length >= (sqb_add_question_pagination_limit)){
		var check_question = jQuery('.sqb_question_no .question-screen .quiz_comon_template[data-id="%%SQBQUESTIONID%%"]').length;
		if(check_question != 0){
				swal("","Please save the question first.","");
				return false;
		}
		var page = jQuery('select.selected-question').val();
		 if(typeof page == undefined || typeof page == "undefined"){
			 page = 1;
		 }
		 
		 window.location.href = sqb_get_url_without_edit_quiz_query_string()+"&q_action=add";
 		//sqb_showPage(page, sqb_add_question_pagination_limit , add_new_question_fe_call = 'Y');
		
	}else{
		add_new_question();
	}

} 

function add_new_outcome(add_new_action_type = 'N'){
	jQuery('.no_result').hide(); 
	jQuery('.sqb_res_collapse').removeClass('show');
	var selected_template = jQuery('input[name="select_temp"]:checked').val();
	if(selected_template == 'template8'){
		selected_template = 'template8'
	}else if(selected_template == 'template9'){
		selected_template = 'template9'
	} else if(selected_template != 'template5'){
		selected_template = 'template2';
	}

	sqb_get_result_temp(selected_template, "result","");	
			
	jQuery('html, body').animate({
		scrollTop: jQuery(".create_quiz_top_tabs_div").offset().top
	}, 2000);

	
	var template_no = jQuery('input[name="select_temp"]:checked').val();
	var outcome_based = jQuery('input[name="outcome_based"]:checked').val();
}

function add_new_question(add_new_action_type = 'N'){

	var all_qns_count = jQuery("#get_all_qns_count").val();
 	jQuery('.total-qns').text(parseInt(all_qns_count)+ 1);
	jQuery('#Quiz-Screen-Settings').addClass(' active show');
	jQuery('#Quiz-Screen-Settings').show();

 	jQuery('.sqb_template_selection_option_section_question').hide('slow');
	var sqb_datetime = new Date();
	var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
	var current_date_time_img = "sbq_img_"+sqb_round_no;
	var current_date_time_img_outer = "sbq_img_outer_"+sqb_round_no;
	var current_date_time_main = "sbq_main_div_"+sqb_round_no;
	var check_template = jQuery('input[name="select_temp"]:checked').val();
	
	if(check_template == 'template5'){
	var sqb_question_html = jQuery('.sqb_question_clone_html_template5').html();	
	}else if(check_template == 'template9'){
	var sqb_question_html = jQuery('.sqb_question_clone_html_template9').html();	
	} else {
	var sqb_question_html = jQuery('.sqb_question_clone_html').html();
	}
	
	if(check_template == 'template9'){
		setTimeout(function(){
			jQuery('input[name="template9_question_screen_layout_option"][value="split_screen"]').prop('checked', true);
			jQuery('input[name="template9_question_screen_split_option"][value="video_left"]').prop('checked', true);
			jQuery('.video-settings-show-hide').show();
			jQuery('.template9_split_screen_options').show();
			if(jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('.video_controls').val() == 'Y'){
				jQuery('#template9_video_controls_question').prop('checked', true);
			}else{
				jQuery('#template9_video_controls_question').prop('checked', false);
			}

			jQuery(".template9-video-dropdown").val("upload").change();
			jQuery('.template9-upload-option').show();
			jQuery('.template9-link-option').hide();
			jQuery('.splash_image_option').hide();

			var btn_color = '#ffffff';
			if(jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('.video_play_btn_color').length != 0){
				var question_screen_play_btn_clr = jQuery('.sqb_question_no.active .Quiz-Template9-left-side').find('.video_play_btn_color').val();
				if(question_screen_play_btn_clr){
					btn_color = question_screen_play_btn_clr;
				}
			}
			jQuery('#template9-play-button-background-color').colorpicker('setValue', btn_color);
			jQuery('input[name="template9_question_screen_layout_option"][value="split_screen"]').trigger('click');

			jQuery('input[name="question_screen_video_hidden"]').val('');
			jQuery('input[name="question_screen_splash_image_hidden"]').val('');
		},1000);
	}
	if(check_template == 'template8'){
		SQBShowLoader();
	}

	
	
	sqb_question_html = sqb_question_html.replace("%%CURRENTDATETIMEIMAAOUTER%%", current_date_time_img_outer);
	sqb_question_html = sqb_question_html.replace("%%CURRENTDATETIMEIMAAOUTER%%", current_date_time_img_outer);
	sqb_question_html = sqb_question_html.replace("%%CURRENTDATETIMEIMG%%", current_date_time_img);
	sqb_question_html = sqb_question_html.replace("%%CURRENTDATETIMEIMG%%", current_date_time_img);
	sqb_question_html = sqb_question_html.replace("%%CURRENTDATETIMEMAINDIV%%", current_date_time_main);
	sqb_question_html = sqb_question_html.replace("%%SQBRANDOMNO%%", sqb_round_no);
	sqb_question_html = sqb_question_html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_text_tiny_mce_editor_rename", 'sqb_text_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("sqb_text_tiny_mce_editor_rename", 'sqb_text_tiny_mce_editor');
	sqb_question_html = sqb_question_html.replace("%%SQBRANDOMNO%%", sqb_round_no);
	

	var get_all_qns_count = jQuery("#get_all_qns_count").val();
	if(get_all_qns_count > sqb_add_question_pagination_limit){
		var sqb_question_no = parseInt(get_all_qns_count) + parseInt(1);
	}else{
		var sqb_question_no = jQuery('.ques_ans_contain .sqb_question_no').length;
		var sqb_question_no = sqb_question_no+1;
	}
	
	var sqb_question_no = jQuery('.left_side_question_list ul li').last().find('a').attr('data-questionno');

	if(add_new_action_type == 'pagination'){
		sqb_question_no = jQuery('#get_all_qns_count').val();
	}
	if(sqb_question_no == ''|| sqb_question_no == 'undefined'|| sqb_question_no == null ){
		var sqb_question_no = 1;
	}else{
		
		var sqb_question_no = parseInt(sqb_question_no)+1;
	}
	
	
	
	var html  = '<div class="card sqb_question_no tab-pane fade" id="sbs_collapseOne_'+sqb_round_no+'">';
		html += '<div class="card-header" id="headingOne" style="display:none">';
		html += '<i class="fa fa-arrows question_sortable_icon" aria-hidden="true"></i> <a >Question '+sqb_question_no+'</a>';
		html += '<div class="delete-qa-row"> <i class="fa fa-trash" aria-hidden="true"></i></div>';
		html += '</div>';
		html += '<div  class=" sqb_question_collapse">';
		html += '<div class="question-delete-clone"><div class="delete-qa-row sqb_delete_btn"><i class="fa fa-trash-o" aria-hidden="true" title="Delete this Question"></i></div><div class="clone-qa-btn"><i class="fa fa-clone" aria-hidden="true" title="Clone this Question"></i></div></div>';
		html += '<div class="card-body">';
		html += sqb_question_html;
		html += '</div>';
		html += '</div>';
		html += '</div>';
	
	jQuery('.sqb_question_collapse').removeClass('show');
	jQuery('.ques_ans_contain .sqb_questions_wrapper').append(html);



	var select_temp = jQuery('input[name="select_temp"]:checked').val();
	if(select_temp == 'template7'){
		setTimeout(function(){
			jQuery('.sqb_question_no.active ul.question_layout_type_list_ul').find("[value='four_column']").trigger('click');
			jQuery('.sqb_question_no.active input[name="sqb_ans_with_img_checkbox"]').prop("checked", true).trigger("change");
			jQuery('.sqb_question_no.active input[name="allow_skip_ques"]').prop("checked", true).trigger("change");
			jQuery('.sqb_question_no.active input[name="sqb_ans_with_img_checkbox"]').closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('image_option_has');
			jQuery('.sqb_question_no.active input[name="sqb_ans_with_img_checkbox"]').closest('.question_div_inner').find('.sqb-ans-image-options').show();
			
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
	   }, 5);
	}
	
	if(select_temp == 'template8' || select_temp == 'template9'){
		setTimeout(function(){
			jQuery('.sqb_question_no.active ul.question_layout_type_list_ul').find("[value='one_column']").trigger('click');
			jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').css('max-width','400px');
			var quiz_type  = jQuery('input[name="quiz_type"]:checked').val();
			if(quiz_type == 'scoring'){
				jQuery('.sqb_question_no.active input[name="sqb_ans_with_img_checkbox"]').closest('.question_div_inner').find('.question_add_answer_outer_div').addClass('sqb_points_active');
			}
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			SQBHideLoader();
	   }, 1);
	}
	
	var quiz_type  = jQuery('input[name="quiz_type"]:checked').val();
	jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.question_type_wrapper').hide();
	
	if(quiz_type == 'personality'){
		jQuery('#sbs_collapseOne_'+sqb_round_no).find('.personality_outcome_connect_btn').show();
		jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.question_type_wrapper').show();
		jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.showHideQueTypeOption').hide();
		
	}else{
		
		if(quiz_type == 'assessment' || quiz_type == 'scoring'){
			jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.showHideQueTypeOption_assessment_scoring').hide();
		}
		
		jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.personality_outcome_connect_btn').hide();
		 if(quiz_type == 'survey'){
			 jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.showHideQueTypeOption').show();
		 }else{
			 jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.showHideQueTypeOption').hide();
		 }
		jQuery('.ques_ans_contain .sqb_questions_wrapper').find('.question_type_wrapper').show();
	}

	var question_order = sqb_question_no;
	var  left_side_question_list = ' <li><a data-questionno="'+question_order+'" data-toggle="pill" href="#sbs_collapseOne_'+sqb_round_no+'">Question '+sqb_question_no+'</a></li>';
	
	jQuery('.left_side_question_list ul').append(left_side_question_list);
	var template_no = jQuery('input[name="select_temp"]:checked');
	if(template_no == 'template4'){
		var question_previous_style = jQuery('.sqb_questions_wrapper .outer-style3').attr('style');
	}else{
	
		var question_previous_style = jQuery('.sqb_questions_wrapper .sqb_question_enable_drag_drop').attr('style');
	}
	
	jQuery('.sqb_questions_wrapper #sbs_collapseOne_'+sqb_round_no+' .sqb_question_enable_drag_drop').attr('style',question_previous_style);
	
	sqb_re_order_question();
	sqb_tiny_mce_editor();
	sqb_text_tiny_mce_editor();
	sqb_enable_drag_drop_init();
	
	//select template
	var select_temp = jQuery('input[name="select_temp"]:checked').val();		 
	if(select_temp =="template2"){
		//select_temp_template2(); 
		jQuery('.quiz_comon_template').addClass('outer-style1');
		jQuery('.quiz_comon_template').removeClass('outer-style2');
		jQuery('.quiz_comon_template').removeClass('outer-style7');
		jQuery('.customizer_for_template_top_frame').hide();
		jQuery('.template6-opacity-section').hide();
		jQuery('.outer_style3_span_second,.outer_style3_span_first').remove();
		jQuery('.Quiz-Template-title').css('background-color' , '');
		jQuery('.points_scored_result').css('background-color' , '');
		jQuery('.question_title').css('background-color' , '');
	}else if(select_temp =="template3"){
		//select_temp_template3('add_question'); 
		jQuery('.quiz_comon_template').addClass('outer-style2');
		jQuery('.quiz_comon_template').removeClass('outer-style1');
		jQuery('.quiz_comon_template').removeClass('outer-style7');
		jQuery('.template6-opacity-section').hide();
		jQuery('.start_temp_static_div_id').css('background-color', '');
		jQuery('.outer_style3_span_second,.outer_style3_span_first').remove();
		jQuery('.for_template_4_customizer').show();
		jQuery('.customizer_for_template_top_frame').show();
		
		jQuery('#outcome_temp_top_frame_backgroud_color').trigger('change');
		jQuery('#optin_temp_top_frame_backgroud_color').trigger('change');
		jQuery('#question_temp_top_backgroud_color').trigger('change');
		jQuery('.Quiz-Template-title, .sqb_question_drag_drop_item, .sqb_opt_in_h4').css('background','#ff634d');
		jQuery('#question_temp_top_backgroud_color').trigger('change');
	}else if(select_temp =="template4"){
		jQuery( "#Quiz-Screen-Settings .sqb_questions_wrapper  .sqb_question_no").last().find(".quiz_comon_template" ).wrap( "<div class='outer-style3'></div>" );	  
		jQuery( "#Quiz-Screen-Settings .sqb_questions_wrapper  .sqb_question_no").last().find(".outer-style3" ).prepend('<span class="outer_style3_span_first" style="border-color: rgb(245, 102, 64) transparent transparent;"></span><span style="border-color: rgb(245, 102, 64) transparent transparent;" class="outer_style3_span_second"></span>');	  
		jQuery('#question_temp_top_backgroud_color').trigger('change');
		
	} else if(select_temp =="template6"){
	 	jQuery('.sqbHideQuesTemplateImage').trigger('click');
	 	jQuery('.question_details .sqbHideQuesDescriptionOuter').hide();

	 	setTimeout(function(){
 			jQuery('.sqb_question_no.active .question-select-layout').attr('data-value', 'one_column');
	 		jQuery('.sqb_question_no.active .question-select-layout').text('1 Column');
	 	}, 500);



	 	var bg_image = jQuery('.start_temp_static_div').css('background-image');
		if(bg_image == 'none'){
		var  get_style = jQuery('#bg_imge_style').val();
		var get_inner_style = jQuery('#bg_imge_style_inner').val();
		} else {
		var  get_style = jQuery('.start_temp_static_div').attr('style');
		var get_inner_style = jQuery('.start_temp_outer').attr('style');
		}
		
		jQuery('#ques_temp_ans_color_div').colorpicker('setValue', '#ffffff');
		jQuery('#ques_temp_ans_text_color').colorpicker('setValue', '#343434');
		jQuery('#ques_temp_ans_hover_color_select').colorpicker('setValue', '#ffda5c');
		jQuery('#ques_temp_ans_hover_text_color_select').colorpicker('setValue', '#343434');
		jQuery('#template6_answer_border_color_select').colorpicker('setValue', '#ffda5c');
		jQuery('#template6_answer_border_hover_color_select').colorpicker('setValue', '#ffda5c');

		jQuery('.question_div_inner .question_description').css('font-size', '18pt');
		jQuery('.question_div_inner .question_description').css('font-family', "open sans");
		jQuery('.question_div_inner .question_description').css('text-align', "center");
	    jQuery('.question-screen').attr('style',get_style);
		 jQuery('.question-screen').find('.sqb_question_enable_drag_drop').attr('style',get_inner_style);
	}else if(select_temp =="template7"){
	 	jQuery('.sqb_question_no.active .sqbHideQuesTemplateImage').trigger('click');
	 	if(jQuery('input[name="show_next_button"]').prop('checked')){
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.continue-question-action').show();
		} else {
			jQuery('#Quiz-Screen-Settings .sqb_question_no').find('.continue-question-action').hide();
		}
	}else if(select_temp =="template8"){
	 	jQuery('.sqb_question_no.active .sqbHideQuesTemplateImage').trigger('click');
	 	if(jQuery('input[name="show_next_button"]').prop('checked')){
			jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.continue-question-action').show();
		} else {
			jQuery('#Quiz-Screen-Settings .sqb_question_no.active').find('.continue-question-action').hide();
		}
	}else{
		//select_temp_template1();
		jQuery('.quiz_comon_template').removeClass('outer-style1');
		jQuery('.quiz_comon_template').removeClass('outer-style2');	
		jQuery('.quiz_comon_template').removeClass('outer-style7');
		jQuery('.customizer_for_template_top_frame').hide();
		jQuery('.template6-opacity-section').hide();
		jQuery('.start_temp_static_div_id').css('background-color', '');
		jQuery('.outer_style3_span_second,.outer_style3_span_first').remove();
		jQuery('.Quiz-Template-title').css('background-color' , '');
		jQuery('.points_scored_result').css('background-color' , '');
		jQuery('.question_title').css('background-color' , '');
		jQuery('#start_temp__br_clr').val('#dddddd').trigger('change');
		jQuery('#start_temp_shad_clr').val('#fff').trigger('change');
		jQuery('.start_temp_outer').addClass('Quiz-Template2');
		if(select_temp =="template5"){
			
			jQuery('.Quiz-Template.Quiz-Template-5').removeAttr('style');
			jQuery('#question_temp_width').trigger('change');
			jQuery('#question_temp_height').trigger('change');
			
			var sqb_question_no = jQuery('.ques_ans_contain .sqb_question_no').length;
			if(sqb_question_no < 11){
				setTimeout(function(){
				var sqb_left_side_colors_list = sqb_left_side_bg_color.split(",");
				var sqb_right_side_colors_list = sqb_right_side_bg_color.split(",");
				var question_temp_preview_obj = jQuery('.sqb_questions_wrapper'); 
				question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side ').css('background-color',sqb_left_side_colors_list[sqb_question_no]);
				question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-right-side ').css('background-color',sqb_right_side_colors_list[sqb_question_no]);
				jQuery('#question_temp_left_sction_clr,#question_temp_left_sction_clr_div').colorpicker('setValue',sqb_left_side_colors_list[sqb_question_no]);
				jQuery('#question_temp_right_sction_clr,#question_temp_right_sction_clr_div').colorpicker('setValue',sqb_right_side_colors_list[sqb_question_no]);
				}, 500);
			}
		}
	}
	
	jQuery(".sqb_img_draggable").draggable(); 
	
	 
	sqb_resizeable();
	sqb_ans_resizeable();
	
	
   // active last added question 
	jQuery('.left_side_question_list ul li').last().find('a').trigger('click');
	var question_tab_id = jQuery('.left_side_question_list ul li').last().find('a').attr('href');		  
	jQuery(question_tab_id+'.sqb_question_no').addClass(' active show ');
	
	
	// hide empty question div 
	jQuery('.Question_temp_static_div .have-no-quiz').hide();
	jQuery('.Question_temp_static_div .left_side_question_list').show();
	jQuery('.Question_temp_static_div .ques_ans_contain').show();
	
	if(jQuery('input[name="quiz_type"]:checked').val() == "assessment" || jQuery('input[name="quiz_type"]:checked').val() == "scoring"){
		if(jQuery('input[name="display_correctans_on_page"]:checked').val() == "yes"  ){
			jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "inline-block");
		}else  {
			jQuery('.sqb_incorrect_correct_ans_wrapper').css("display", "none");
		}
		
		if(jQuery('#quiz_category_enable').prop('checked')){
			jQuery('.quiz_category_type_wrapper').css("display", "flex");
		}
	}

	jQuery('#questionshowHide_video').prop('checked' , false);
	set_question_template_width();
	jQuery('#Quiz-Screen-Settings .responsive-screen-link').show();


	if(check_template == 'template6'){
		if(jQuery('.sqb_question_no.active .question_add_answer_outer_div .sqb_ans_item').length == 0){
			setTimeout(function(){
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			var global_style_css = jQuery('#global_style_css').val();
			if(global_style_css == 'Y'){
				jQuery('.sqb_question_no.active').find('.question-screen').addClass('sqb_start_screen_background_image');
				jQuery('.question-screen').attr('style', '');
			}
			}, 500);
		}
		var get_answer_bg = jQuery('.getclone_ans').find('.sqb_ans_item').css('background-color');			 
		if(typeof get_answer_bg !="undefined"){					 
			jQuery('#Quiz-Screen-Settings .sqb_questions_wrapper .sqb_ans_item').css('background-color', get_answer_bg );
			 jQuery('#ques_temp_ans_color').val(get_answer_bg);
		 }
		 
		var ans_text_color = jQuery('#ques_temp_ans_text_color').val();
		jQuery('.sql_ans_text').css('color',ans_text_color);
		
		var bg_image = jQuery('.start_temp_static_div').css('background-image');
		if(bg_image == 'none'){
			var get_inner_style = jQuery('#bg_imge_style_inner').val();
		} else {
			var get_inner_style = jQuery('.start_temp_outer').attr('style');
		}
	    jQuery('.question-screen').find('.sqb_question_enable_drag_drop').attr('style',get_inner_style);
		jQuery('.sqb_question_no.active .sqbShowQuesDescriptionOuter').hide();   
		setTimeout(function(){
			jQuery('.sqb_question_no.active .sqbHideQuesDescriptionOuter').show();   
		}, 500);
	}else{
		if(jQuery('.sqb_question_no.active .question_add_answer_outer_div .sqb_ans_item').length == 0){
			setTimeout(function(){
			jQuery('.sqb_question_no.active .question_add_more_ans_btn').trigger('click');
			}, 500);
		}
	}

	if (0 && jQuery('.left_side_question_list .nav li').length > 24 ) {
 		jQuery(".left_side_question_list .nav li a").text(function () {
		    return jQuery(this).text().replace("Question", "Q"); 
		}); 
 	}

 	if(jQuery('.left_side_question_list ul li').length > 24){
 		sqb_question_select();
 	}

 	var qns_count = jQuery('.left_side_question_list ul li').length;
    if(qns_count == 1){
        qns_count = 1;
    }else{
        qns_count = parseInt(qns_count) + 1
    }
    jQuery('#get_all_qns_count').val(qns_count);
    
    if(jQuery('#Basic-Screen-Settings #quiz_recommendation_option').prop('checked')){
	    jQuery('.add_ans_level_recommendation').show();
	}else{
	    jQuery('.add_ans_level_recommendation').hide();
	}

	if(jQuery('#Basic-Screen-Settings #quiz_ans_tags').prop('checked')){
	    jQuery('.add-answer-tag').show();
	    jQuery('.view-all-tags').show();
	}else{
	    jQuery('.add-answer-tag').hide();
	    jQuery('.view-all-tags').hide();
	}
    
    if(quiz_type == 'poll'){
    	jQuery('.showHideQueTypeOption_assessment_scoring').hide();
    	jQuery('.showHideQueTypeOption').hide();
    	jQuery('.hide_for_poll').hide();
    }
    

	if(check_template == 'template8'){
		if(jQuery('.optin_template_html_preview_outer').hasClass('sqb_start_screen_background_image')){
			jQuery('.question-screen').addClass('sqb_start_screen_background_image');
		}

		jQuery('.continue-question-action').find( "[id^='mce_']" ).each(function(){
			jQuery(this).removeAttr('id');
		});
		sqb_tiny_mce_editor('.continue-question-btn');
	}

	var selected_ques_type = jQuery('.sqb_question_no.active').find('.question-screen .question-type-card .dropdown-toggle').attr('data-value');
		if((check_template == "template1" || check_template == "template2" || check_template == "template3" || check_template == "template4") && (selected_ques_type != 'email' && selected_ques_type != 'phone_number')){
			var background_color = jQuery('#temp_one_to_four_answer_backgroud_color').val();
			jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div .sqb_ans_item').css('background', background_color);	
		}
	var quiz_id = jQuery('#edit_id').val();
	jQuery.post(ajaxurl, {
		action: 'sqb_load_global_theme_butons_data',
		quiz_id: quiz_id,   
		template: check_template,   
	}, function(response) {	
		response = JSON.parse(response);
		if(response.output){
			/*Back Button*/

			var check_template = jQuery('input[name="select_temp"]:checked').val();
			if(check_template == 'template5'){
				if(jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer .back-question-action').length == 0){
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').append('<div class="back-question-action" style="display:none;">'+response.output['back_btn_html']+'</div>');
				}else{
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').html(response.output['back_btn_html']);
				}
			}else{
				if(jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .back-question-action').length == 0){
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper').append('<div class="back-question-action" style="display:none;">'+response.output['back_btn_html']+'</div>');
				}else{
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .back-question-action').html(response.output['back_btn_html']);
				}
			}

			jQuery('#all_temp_back_btn_width').bootstrapSlider('setValue', response.output['back_question_btn_width_for_quiz']);
			jQuery('#all_temp_back_btn_height').bootstrapSlider('setValue', response.output['back_question_btn_height_for_quiz']);
			jQuery('#all_temp_back_btn_radius').bootstrapSlider('setValue', response.output['back_question_btn_radius_for_quiz']);
			jQuery('#all_back_button_clr').colorpicker('setValue', response.output['back_question_button_for_quiz']);
			jQuery('#all_back_button_hover_clr').colorpicker('setValue', response.output['back_question_button_hover_for_quiz']);


			/*Skip Button*/

			if(check_template == 'template5'){
				if(jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer .skip-question-action').length == 0){
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').append('<div class="skip-question-action" style="display:none;">'+response.output['skip_button_html']+'</div>');
				}else{
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').html(response.output['skip_button_html']);
				}
			}else{
				if(jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .skip-question-action').length == 0){
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper').append('<div class="skip-question-action"  style="display:none;">'+response.output['skip_button_html']+'</div>');
				}else{
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .skip-question-action').html(response.output['skip_button_html']);
				}
			}

			

			jQuery('#all_temp_skip_btn_width').bootstrapSlider('setValue', response.output['skip_question_btn_width_for_quiz']);
			jQuery('#all_temp_skip_btn_height').bootstrapSlider('setValue', response.output['skip_question_btn_height_for_quiz']);
			jQuery('#all_temp_skip_btn_radius').bootstrapSlider('setValue', response.output['skip_question_btn_radius_for_quiz']);
			jQuery('#all_skip_button_clr').colorpicker('setValue', response.output['skip_question_button_for_quiz']);
			jQuery('#all_skip_button_hover_clr').colorpicker('setValue', response.output['skip_question_button_hover_for_quiz']);

			/*Next Button*/


			if(check_template == 'template5'){
				if(jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer .continue-question-action').length == 0){
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').append('<div class="continue-question-action" style="display:none;">'+response.output['next_button_html']+'</div>');
					setTimeout(() => {
						jQuery('.sqb_question_no.active').find('.continue-question-action ').hide();
					}, 500);
					
				}else{
					jQuery('.sqb_question_no.active').find('.sqb_quiz_template5_next_button_outer').html(response.output['next_button_html']);
				}
				
			}else{
				if(jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .continue-question-action .single_next_btn').length == 0){
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper').append('<div class="continue-question-action"  style="display:none;">'+response.output['next_button_html']+'</div>');
				}else{
					jQuery('.sqb_question_no.active').find('.skip_continue_button_wrapper .continue-question-action').html(response.output['next_button_html']);
				}
			}
			
			

			jQuery('#all_temp_continue_btn_width').bootstrapSlider('setValue', response.output['nexttbtn_width_for_quiz']);
			jQuery('#all_temp_continue_btn_height').bootstrapSlider('setValue', response.output['nexttbtn_height_for_quiz']);
			jQuery('#all_temp_continue_btn_radius').bootstrapSlider('setValue', response.output['nexttbtn_radius_for_quiz']);
			jQuery('#all_temp_continue_button_clr').colorpicker('setValue', response.output['next_button_settings_background_color']);
			jQuery('#all_temp_continue_button_hover_clr').colorpicker('setValue', response.output['next_button_settings_background_hover_color']);

			if(check_template == 'template8'){
				jQuery('.continue-question-btn').css('background-color','');
				var question_width = jQuery('#question_temp_inner_width').bootstrapSlider('getValue');
				jQuery('.question_add_answer_outer_div').css('max-width', question_width);
				var btn_bg_color = jQuery('#continue_button_clr').colorpicker('getValue');
				jQuery('.single_next_btn').css('background-color', btn_bg_color);
			}
		}

		if(jQuery('#show_next_button').prop('checked') == true){
			jQuery('.continue-question-action').show();
		}else{
			jQuery('.continue-question-action').hide();
		}

		if(jQuery('#show_back_button').prop('checked') == true){
			jQuery('.back-question-action').show();
		}else{
			jQuery('.back-question-action').hide();
		}

		jQuery('.sqb_question_no').each(function(){
			if(jQuery(this).find('.skip_continue_button_wrapper .continue-question-action .single_next_btn').length > 1){
				jQuery(this).find('.skip_continue_button_wrapper .continue-question-action .single_next_btn').not(':first').remove();
			}
		});

		jQuery('.single_next_btn').removeAttr('id');
		jQuery('.skip_question_button').removeAttr('id');
		jQuery('.single_back_btn').removeAttr('id');
		sqb_tiny_mce_editor();

	});

	if(jQuery('#Basic-Screen-Settings').hasClass('active')){
		jQuery('#Quiz-Screen-Settings').removeClass('active show');
	}

	jQuery('.sqbHideQuesTemplateImage').trigger('click');
}

function sqb_isFloat(n){
    return Number(n) === n && n % 1 !== 0;
}

function sqb_question_select(){
	var get_count = jQuery('.left_side_question_list ul li').length/sqb_add_question_pagination_limit;
	if(sqb_isFloat(get_count) == true){
		get_count = get_count+1;
	}else{
		get_count = get_count;
	}
    var  limit = sqb_add_question_pagination_limit;
	var selected_html = '<select class="selected-question">';
	for(x = 1; x <= get_count; x++){
    	var start_ind = 1;
        var end_ind = sqb_add_question_pagination_limit;
        
        if(x != 1){
           start_ind = ((x-1)*sqb_add_question_pagination_limit)+1;
           limit = sqb_add_question_pagination_limit;
           end_ind = x*sqb_add_question_pagination_limit;
        }
		selected_html += '<option data-page="'+x+'" value='+x+'>'+start_ind+'-'+end_ind+'</option>';
	}
		selected_html +='</select>';
}


function sqb_re_order_answer(){
	jQuery( ".question_add_answer_outer_div" ).sortable({
		connectWith: ".sqb_ans_item",
		opacity: 0.5,
		cursor: "move",
		disabled: false,
		cancel: ".sqb_ans_disable_dds,.sqb_disable_tiny_mce_editor,.sqb_ans_disable_drag_drop_sortable",
		classes: {"ui-state-default": "sqb_ans_template_drag_drop_item" },
	});
}

function sqb_re_order_question(){
	jQuery( ".sqb_quiz_type_re_arrange_questions_wrapper .sqb_questions_wrapper" ).sortable({	
		connectWith: ".sqb_questions_wrapper",
		opacity: 0.5,
		cursor: "move",
		disabled: false,
		cancel: ".sqb_question_disable_drag_drop_sortable,.sqb_disable_tiny_mce_editor,.sqb_question_collapse ",
		classes: {"ui-state-default": "sqb_question_template_drag_drop_item" },
  	});
}

function sqb_getquiz_settings_rename(){ 	
	var quizid = jQuery('.quizList li.activeli').attr("data-value"); 
	if(jQuery('.quizList li.activeli').length < 1){
		quizid = 0;
		return false;
	}
	sqb_show_loader();
 
	jQuery.post(ajaxurl, {
		action: 'sqb_getquiz_settings',
		quizid: quizid,   
	}, function(response) {	
		response = JSON.parse(response);
		if(response.success){
			jQuery('input[name="quiz_passmark"]').val(response.quiz_passmark);
			jQuery('.quiz_attempts_allowed').val(response.quiz_attempts_allowed);
			jQuery('.already_take_the_quiz').val(response.already_take_the_quiz);
			jQuery('input[name="quiz_timer_limit"]').val(response.quiz_timer_limit);
			
			if(response.grade_quiz =="Y"){
				jQuery('input[name="grade_quiz"]').attr('checked' , true);
				jQuery('.quiz_passmark_div').css('display' , 'inline-block');
			}else{
				jQuery('input[name="grade_quiz"]').attr('checked' , false);
				jQuery('.quiz_passmark_div').css('display' , 'none');
			}
			if(response.quiz_timer =="Y"){
				jQuery('input[name="quiz_timer"]').attr('checked' , true);
			}else{
				jQuery('input[name="quiz_timer"]').attr('checked' , false);
			}
			if(response.questions_random =="Y"){
				jQuery('input[name="questions_random"]').attr('checked' , true);
			}else{
				jQuery('input[name="questions_random"]').attr('checked' , false);
			}
			
			if(response.answers_random =="Y"){
				jQuery('input[name="answers_random"]').attr('checked' , true);
			}else{
				jQuery('input[name="answers_random"]').attr('checked' , false);
			}
			if(response.move_question =="Y"){
				jQuery('input[name="move_question"]').attr('checked' , true);
			}else{
				jQuery('input[name="move_question"]').attr('checked' , false);
			}
			if(response.show_for_notloggedin_user =="Y"){
				jQuery('input[name="show_for_notloggedin_user"]').attr('checked' , true);
			}else{
				jQuery('input[name="show_for_notloggedin_user"]').attr('checked' , false);
			}
			
			if(response.show_first_name_screen =="Y"){
				jQuery('input[name="show_first_name_screen"]').prop('checked' , true);
				jQuery('.show_first_name_screen_temp_outer').show();
			}else{
				jQuery('input[name="show_first_name_screen"]').prop('checked' , false);
				jQuery('.show_first_name_screen_temp_outer').hide();
			}
			jQuery('.startTemplateHidden').html(response.quiz_start_template);
			if(response.quiz_first_name_template != ''){
				jQuery('.startTemplateHidden').find('.start_temp_outer').html(response.quiz_first_name_template);
			}else{
				jQuery('.startTemplateHidden').find('.start_temp_outer').html(' <div class="Quiz-Template-content"><div class="show_first_name_screen_temp"><h3 class="Quiz-Template-title sqb_tiny_mce_editor">Before you begin - let me ask you for your name ? This question is required. * its nicer to be personal to people even online, isnt it?</h3><input type="text" value="" class="sqb_first_name" name="sqb_first_name" placeholder="Enter Name"><div class="sqb_first_name_ok_btn sqb_tiny_mce_editor"><div class="firstname_ok_btn">OK</div></div></div></div>');		
			}
			
			jQuery('.show_first_name_screen_temp_inner').html(jQuery('.startTemplateHidden').html());
			sqb_tiny_mce_editor();
			
		}	 
		sqb_hide_loader();			  
	});
	 			    		
			 
	
}
function sqb_save_quiz_setting(){ 	
	SQBShowLoader();
	var next_button_html = jQuery('.next_temp_container ').html();
	var back_button_html = jQuery('.back_temp_container ').html();
	var download_certificate_button_html = jQuery('.download_certificate_temp_container ').html();
	var retake_button_html = jQuery('.retake_temp_container ').html();
	var quizid = jQuery('.quizList li.activeli').attr("data-value");
	if(jQuery('.quizList li.activeli').length < 1){
		quizid = 0;
	}
	 
	var quiz_timer  = jQuery('input[name="quiz_timer"]').prop('checked');
	if(quiz_timer){
		quiz_timer = 'Y';
	}else{
		quiz_timer = 'N';
	}
 
	var quiz_timer_limit =jQuery('input[name="quiz_timer_limit"]').val();
	 
	var progress_bar  = jQuery('input[name="progress_bar"]').prop('checked');
	if(progress_bar){
		progress_bar = 'Y';
	}else{
		progress_bar = 'N';
	}
	
	var grade_quiz = jQuery('input[name="grade_quiz"]').val();
	var quiz_passmark = jQuery('input[name="quiz_passmark"]').val();
	var total_attempts = jQuery('input[name="total_attempts"]').val();
	var quiz_attempts_allowed = jQuery('.quiz_attempts_allowed option:selected').val();
	var already_take_the_quiz = jQuery('.already_take_the_quiz option:selected').val();
 
	var show_correct_ans  = jQuery('input[name="show_correct_ans"]').prop('checked');
	if(show_correct_ans){
		show_correct_ans = 'Y';
	}else{
		show_correct_ans = 'N';
	}
	var questions_random  = jQuery('input[name="questions_random"]').prop('checked');
	if(questions_random){
		questions_random = 'Y';
	}else{
		questions_random = 'N';
	}
	var answers_random  = jQuery('input[name="answers_random"]').prop('checked');
	if(answers_random){
		answers_random = 'Y';
	}else{
		answers_random = 'N';
	}

	var move_question  = jQuery('input[name="move_question"]').prop('checked');
	if(move_question){
		move_question = 'Y';
	}else{
		move_question = 'N';
	}
	var show_for_notloggedin_user  = jQuery('input[name="show_for_notloggedin_user"]').prop('checked');
	if(show_for_notloggedin_user){
		show_for_notloggedin_user = 'Y';
	}else{
		show_for_notloggedin_user = 'N';
	}
	
	var progressActive = jQuery('#progressactive_backgroud_color').val();
	var progressInactive = jQuery('#progressinactive_backgroud_color').val();
	var answer_background = jQuery('#answer_background_color').val();
	var answer_background1 = jQuery('#answer_background_color1').val();
	var answer_text_color = jQuery('#answer_text_color').val();
	var correct_answer_msg = jQuery('#correct_answer_msg').val();
	var incorrect_answer_msg = jQuery('#incorrect_answer_msg').val();
	var username_empty_msg = jQuery('#username_empty_msg').val();
	var required_field = jQuery('#required_field').val();
	var email_empty_msg = jQuery('#email_empty_msg').val();
	var terms_condition_msg = jQuery('#terms_condition_msg').val();
	var show_first_name_screen = jQuery('#show_first_name_screen').prop('checked');
	var show_first_name_screen_temp = jQuery('.show_first_name_screen_temp_outer').find('.quiz_comon_template').html();
	
	if(show_first_name_screen){
		show_first_name_screen = 'Y';
	}else{
		show_first_name_screen = 'N';
	}
	var result_background_color = jQuery('#result_background_color').val();
	var result_background_color1 = jQuery('#result_background_color1').val();
	var fb_share_thank_you_msg = jQuery('#fb_share_thank_you_msg').val();

	var form_data = {
		quizid: quizid,
		next_button_html: next_button_html,
		back_button_html: back_button_html,
		download_certificate_button_html: download_certificate_button_html,
		retake_button_html: retake_button_html ,
		quiz_timer: quiz_timer ,
		quiz_timer_limit: quiz_timer_limit ,
		progress_bar: progress_bar ,
		grade_quiz: grade_quiz ,
		quiz_passmark: quiz_passmark ,
		already_take_the_quiz: already_take_the_quiz ,
		quiz_attempts_allowed: quiz_attempts_allowed ,
		show_correct_ans: show_correct_ans ,
		questions_random: questions_random ,
		answers_random: answers_random ,
		move_question: move_question ,
		show_for_notloggedin_user: show_for_notloggedin_user ,
		total_attempts: total_attempts ,
		progressActive: progressActive ,
		progressInactive: progressInactive ,
		answer_text_color: answer_text_color ,
		answer_background: answer_background ,
		answer_background1: answer_background1 ,
		correct_answer_msg: correct_answer_msg ,
		incorrect_answer_msg: incorrect_answer_msg ,
		username_empty_msg: username_empty_msg ,
		required_field: required_field ,
		email_empty_msg: email_empty_msg ,
		terms_condition_msg: terms_condition_msg ,
		show_first_name_screen: show_first_name_screen ,
		show_first_name_screen_temp: show_first_name_screen_temp ,
		result_background_color: result_background_color ,
		result_background_color1: result_background_color1 ,
		fb_share_thank_you_msg: fb_share_thank_you_msg ,
		}
	jQuery.post(ajaxurl, {
			action: 'sqb_save_quiz_settings',
			form_data: form_data,   
	}, function(response) {		 
		SQBHideLoader();			  
	});
}


function save_single_question(){

		if(single_question_validation()){
			return false;
		}

		if(jQuery('#quiz_category_enable').prop('checked') == true){
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
			if (selected_template == 'template1' || selected_template == 'template2' || selected_template == "template3" || selected_template == 'template4' || selected_template == 'template5' || selected_template == 'template7') {
				var category_id = jQuery('.sqb_questions_wrapper .sqb_question_no.active').find('.question_drop_down_wrapper .quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
				if(category_id == ''){
					swal('Please assign a category.');
					return false;
				}
			}else{
				var category_id = jQuery('.sqb_questions_wrapper .sqb_question_no.active').find(' .quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
				if(category_id == ''){
					swal('Please assign a category.');
					return false;
				}
			}
		}

		jQuery('.sqb_closed_global_customizer_opiton').trigger('click');
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		var all_questions_data = [];
		var id = jQuery('input[name="edit_id"]').val();
		var ques_index = jQuery('.left_side_question_list .nav li').find('.active').data('questionno');
		var quiz_category_id = '';
		var quiz_type_new_var = jQuery('input[name="quiz_type"]:checked').val();
		if((quiz_type_new_var == 'assessment') || (quiz_type_new_var == 'scoring')){
			if(selected_template == "template1" || selected_template == "template2" || selected_template == 'template3' || selected_template == 'template4'){
				quiz_category_id = jQuery('.sqb_question_no.active').find('.question-screen .quiz_category_type_wrapper .dropdown-toggle').attr('data-value')
			}else{
				quiz_category_id = jQuery('.sqb_question_no.active').find('.quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
			}
		}
			
		var question_id = jQuery('.sqb_question_no.active').find('.sqb_question_enable_drag_drop').attr('data-id');
		var question_wrapper_id = jQuery('.sqb_question_no.active').find('.question_div_outer').attr('id');
		var ans_hint = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.QA-advance-option .sqb_incorrect_ans ').val();
		var ans_info = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.QA-advance-option .sqb_correct_ans').val();
		var question_skip_button_html = '';
		var select_temp = jQuery('input[name="select_temp"]:checked').val();	
		if(select_temp == 'template7'){
			if(select_temp == 'template7'){
				var allow_skip_ques = jQuery('.sqb_question_no.active').find('.question_div_outer .template7-skip-question-button').find('input[name="skipquestion"]').prop('checked');	
				if(allow_skip_ques){
					allow_skip_ques = 'Y';
				}else{
					allow_skip_ques = 'N';
				}
			} else {
				var allow_skip_ques_status = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.skip-question-action').css('display');
				if(allow_skip_ques_status != 'none'){
				allow_skip_ques = 'Y';
				} else {
				allow_skip_ques = 'N';
				}
			}
			question_skip_button_html = encodeURIComponent(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.skip-question-action').html());
			if(typeof question_skip_button_html == 'undefined'){
			question_skip_button_html = '';
			}
		
		} else if(select_temp == 'template6' || select_temp == 'template8' || select_temp == 'template9'){
			var allow_skip_ques = jQuery('.sqb_question_no.active').find('.question_div_outer .template8_question_screen_setting_right-side').find('.skip-btn-temp-8 input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
		}else if(select_temp == 'template5'){
			var allow_skip_ques = jQuery('.sqb_question_no.active').find('.question_div_outer .Quiz-Template5-right-side').find('input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
		}else {
			var allow_skip_ques = jQuery('.sqb_question_no.active').find('.ans_layout_div').find('input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
			question_skip_button_html = '';
		}
		
		var skip_outcome_mapping = 'N';
		
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		var ques_type = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');

		jQuery('.question_error_msg_outer').remove();
	   	var error = '';	
		//validations
		if(quiz_type == "personality"){
			error = sqb_personality_validations();
			var  error_msg = '<div class="question_error_msg">We found that some of your answers are not connected to any outcome. <br>Please click on the blue "CONNECT TO OUTCOME" button above and connect your answers to an outcome.</div>';
		}else if(quiz_type == "assessment"){
			error = sqb_assessment_validations();
			var error_msg = '<div class="question_error_msg">Sorry, it looks like you have not checked "correct answer" checkbox for these questions. Please check the box next to the correct answer.</div>';
		}else if(quiz_type == "scoring"){
			error = sqb_scoring_validations();
			var error_msg = '<div class="question_error_msg">No points have been assigned to the answers in these questions:</div>';
		}

		if(error != ''){
			jQuery(".quiz-actions").before('<div class="question_error_msg_outer">'+error_msg+'<div class=" question_validations">'+error+'</div></div>');	
			jQuery('html, body').animate({
		        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
		    }, 2000);
		}

		if((quiz_type == 'personality') && ((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating') || (ques_type == 'matrix'))){
				if(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.assessment_outcome_connect_btn .outcome-option-connect').hasClass('outcome-option-active')){				
					skip_outcome_mapping = 'N';
				} else {
					skip_outcome_mapping = 'Y';
				}
		}
		
		var multiple_correct_ans = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="multiple_correct_ans"]').prop('checked');
		
		if(multiple_correct_ans){
			multiple_correct_ans = 'Y';
		}else{
			multiple_correct_ans = 'N';
		}
		
		var question_type = '';
		if(1){
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
			if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
				var question_type = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
			}else{
				var question_type = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
			}
		}else{
			
			var question_type = "";
		}
		
		if(question_type == 'multi'){
			multiple_correct_ans = 'Y';
		}
		
		var question_temp_name = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="question_temp_name"]').val();
		var question_temp_no = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="question_temp_no"]').val();
		
		if(select_temp =="template1"){
		}else if(select_temp =="template2"){
			select_temp_class = 'outer-style1';

		}else if(select_temp =="template3"){
			select_temp_class = 'outer-style2';
		}else if(select_temp =="template4"){
		}else if(select_temp =="template7"){
			select_temp_class = 'outer-style7';
		}else if(select_temp =="template8"){
			select_temp_class = 'outer-style8';
		}else if(select_temp =="template9"){
			select_temp_class = 'outer-style9';
		}else{	
		}    
		
		var show_correct_inccorect_ans_checkbox = "Y";
		var question_data = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_details').wrap('<p/>').parent().html();
        jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_details').unwrap();

		var question_temp_max_width  = '700px';
        if( select_temp == 'template4'){
			if(typeof  jQuery('.sqb_question_no.active').find('.outer-style3').css('max-width') != 'undefined'){
				var question_temp_max_width  = jQuery('.sqb_question_no.active').find('.outer-style3').css('max-width');
			}
		}else{
			if(typeof jQuery('.sqb_question_no.active').find('.Quiz-Template').css('max-width') != 'undefined'){
				var question_temp_max_width  = jQuery('.sqb_question_no.active').find('.Quiz-Template').css('max-width');
			}
		}  

		var question_title = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_details').find('.question_title').text();
		var question_desc = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_details').find('.question_description').text();
		
        var answer_array = [];
		if(select_temp == 'template8' || select_temp == 'template6' || select_temp == 'template9'){
		var sqb_ans_with_img_checkbox = jQuery('.sqb_question_no.active').find('.template8_question_screen_setting_options_wrapper').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');

		var sqb_multiple_ans_limited = jQuery('.sqb_question_no.active').find('.template8_question_screen_setting_options_wrapper').find('input[name="sqb_multiple_ans_limited"]').prop('checked');

		} else {
		var sqb_ans_with_img_checkbox = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.Quiz-Template').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');

		var sqb_multiple_ans_limited = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.Quiz-Template').find('input[name="sqb_multiple_ans_limited"]').prop('checked');

		}
		if(select_temp == 'template7' || select_temp == 'template8' || select_temp == 'template6' || select_temp == 'template9'){
			if(jQuery('.sqb_question_no.active').find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-two-in-row-active')){
				 var ans_layout  = "multiple";
			}else if(jQuery('.sqb_question_no.active').find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-three-in-row-active')){ 
				 var ans_layout  = "layout-three-in-row";
			}else if(jQuery('.sqb_question_no.active').find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-four-in-row-active')){ 
				 var ans_layout  = "layout-four-in-row";
			}else if(jQuery('.sqb_question_no.active').find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-five-in-row-active')){ 
				 var ans_layout  = "layout-five-in-row";
			}else if(jQuery('.sqb_question_no.active').find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-six-in-row-active')){ 
				 var ans_layout  = "layout-six-in-row";
			} else {
				var ans_layout = 'standard';
			}
		} else {
			var ans_layout = 'standard';
			if(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.ans_layout_typw.selected-op').hasClass('sqb_ans_layout_mulitple')){
				 ans_layout  = "multiple";
			}else if(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.ans_layout_typw.selected-op').hasClass('sqb_ans_layout_three_in_row')){ 
				 ans_layout  = "layout-three-in-row";
			}
		}
		
		var ans_img_setting = {};
		if(sqb_ans_with_img_checkbox){
				sqb_ans_with_img_checkbox = 'Y';
				
				var ans_image_size_option = jQuery('.sqb_question_no.active').find('.question_div_inner').find('.ans-image-size-options').val();
				var ans_image_height = jQuery('.sqb_question_no.active').find('.question_div_inner').find('#sqb_image_custom_height').val();
				var ans_image_width = jQuery('.sqb_question_no.active').find('.question_div_inner').find('#sqb_image_custom_width').val();
				var sqb_ans_show_label = 'N';
				//var sqb_ans_show_label_checkbox = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="sqb_ans_show_label"]').prop('checked');

				if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
					var sqb_ans_show_label_checkbox = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.ans_layout_div input[name="sqb_ans_show_label"]').prop('checked');
				}else{
					var sqb_ans_show_label_checkbox = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="sqb_ans_show_label"]').prop('checked');
				}

				if(sqb_ans_show_label_checkbox){
					var sqb_ans_show_label = 'Y';
				}
				ans_img_setting = { 'ans_image_size_option': ans_image_size_option,'ans_image_width':ans_image_width,'ans_image_height':ans_image_height, 'sqb_ans_show_label': sqb_ans_show_label};
				
		}else{
			sqb_ans_with_img_checkbox = 'N';
		}
		
		var multiple_ans_checked = 'N';
		var sqb_multiple_ans_input_limit = "";
		if(sqb_multiple_ans_limited){
			multiple_ans_checked = 'Y';
			sqb_multiple_ans_input_limit = jQuery('.sqb_question_no.active').find('input[name="sqb_multiple_ans_input_limit"]').val();
		}

		var dropdown_label = encodeURIComponent(jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div #dropdown-label').val());
		var dropdown_default_value = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div #dropdown-default-value').val();
		var dropdown_values = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div #dropdown-fields-value').val();
		
		var select_temp = jQuery('input[name="select_temp"]:checked').val();
		if(select_temp == 'template9'){
			var temp_layout = 'sqb-template-bg-full-width';
			var video_url = "";
			var video_controls = "Y";
			var video_source = "";
			var splash_image = "";
			var video_play_btn_color = "#ffffff";
			if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('sqb-template-bg-full-width')){
				temp_layout = 'sqb-template-bg-full-width';
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('sqb-template-bg-image-left')){
				temp_layout = 'sqb-template-bg-image-left';
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('sqb-template-bg-image-right')){
				temp_layout = 'sqb-template-bg-image-right';
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('sqb-template-bg-video-left')){
				temp_layout = 'sqb-template-bg-video-left';
				video_url = jQuery('.sqb_question_no.active').find('input[name="video_id"]').val();
				video_controls = jQuery('.sqb_question_no.active').find('input[name="video_controls"]').val();
				video_source = jQuery('.sqb_question_no.active').find('input[name="video_source"]').val();
				splash_image = jQuery('.sqb_question_no.active').find('input[name="splash_image"]').val();
				video_caption = jQuery('.sqb_question_no.active').find('input[name="video_caption"]').val();
				video_play_btn_color = jQuery('.sqb_question_no.active').find('input[name="video_play_btn_color"]').val();
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('sqb-template-bg-video-right')){
				temp_layout = 'sqb-template-bg-video-right';
				video_url = jQuery('.sqb_question_no.active').find('input[name="video_id"]').val();
				video_controls = jQuery('.sqb_question_no.active').find('input[name="video_controls"]').val();
				video_source = jQuery('.sqb_question_no.active').find('input[name="video_source"]').val();
				splash_image = jQuery('.sqb_question_no.active').find('input[name="splash_image"]').val();
				video_caption = jQuery('.sqb_question_no.active').find('input[name="video_caption"]').val();
				video_play_btn_color = jQuery('.sqb_question_no.active').find('input[name="video_play_btn_color"]').val();
			}

			var template_alignment = 'template9-inner-left';
			if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('template9-inner-left')){
				template_alignment = 'template9-inner-left';
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('template9-inner-right')){
				template_alignment = 'template9-inner-right';
			}else if(jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').hasClass('template9-inner-center')){
				template_alignment = 'template9-inner-center';
			}

			var template_image = jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner .Quiz-Template9-left-side').css('background-image');
			if(template_image != 'none'){
				template_image = template_image.replace('url(','').replace(')','').replace(/\"/gi, "");
			}else{
				template_image = '';
			}

			var background_color = jQuery('.sqb_question_no.active').find('.Quiz-Template9-inner').css('background-color')
			
			var question_video_source = jQuery('.sqb_question_no.active').find('.video_source').val();

			var question_setting = { 'dropdown_label': dropdown_label,'dropdown_default_value':dropdown_default_value,'dropdown_values':dropdown_values, 'temp_layout': temp_layout, 'template_alignment': template_alignment, 'template_image': template_image, 'background_color': background_color, 'video_url': video_url, 'video_controls': video_controls,'video_source': video_source,'splash_image':splash_image, 'video_play_btn_color': video_play_btn_color, 'question_video_source': question_video_source, 'video_caption': video_caption, 'multiple_ans_checked': multiple_ans_checked, 'sqb_multiple_ans_input_limit': sqb_multiple_ans_input_limit};
		}else{
			var question_setting = { 'dropdown_label': dropdown_label,'dropdown_default_value':dropdown_default_value,'dropdown_values':dropdown_values, 'multiple_ans_checked': multiple_ans_checked, 'sqb_multiple_ans_input_limit': sqb_multiple_ans_input_limit};

		}
		var matrix_add_value = false;
		if(jQuery('.sqb_question_no.active').find('.SQB-main-table').hasClass('show_value_matrix_box')){
			matrix_add_value = true;
		}
		
		if(jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div  .sqb_ans_item').length > 0){
		jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div  .sqb_ans_item').each(function(index){
			var matrix_values = [];
			var matching_text = [];
			var extra_options = {};

			var answer_id = jQuery(this).attr('data-id');
			var answer_wrapper_id = jQuery(this).attr('id');
			
			var answer_title = jQuery(this).find('.sql_ans_text').text();
			
			
			var sqb_is_right_ans = 'N';
			var ans_html =  '';
			if(question_type == 'text'){
				ans_html = jQuery(this).find('.sqb_textarea_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_textarea_ans_field').unwrap();
				var answer_title = jQuery(this).find('.sql_ans_text').text();
				
			}else if(question_type == 'email'){
				ans_html = jQuery(this).find('.sqb_email_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_email_ans_field').unwrap();
				var answer_title = jQuery(this).find('.sql_ans_text').text();
				
				if(jQuery(this).find('input[name="email_type_required"]').prop('checked') == true){
					extra_options["required_field"] = 'Y';
				}else{
					extra_options["required_field"] = 'N';
				}
				extra_options["validation_message"] = jQuery(this).find('.validation-email-type').attr('placeholder');
			}else if(question_type == 'weight_and_height'){
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();
			    
			    
				extra_options["validation_message"] = jQuery(this).find('.validation-hw-type').attr('placeholder');
			}else if(question_type == 'name'){
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();
			    
			    
				extra_options["validation_message"] = jQuery(this).find('.validation-hw-type').attr('placeholder');
			}else if(question_type == 'phone_number'){
				var sqb_datetime = new Date();
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);

				ans_html = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input class='international-phone-number sqb_and_field sqb_input_ans_field sqb_phone_number_ans_field' id='international-phone-number' name='sqb_ans_"+sqb_round_no+"' placeholder='' ></textarea></div>";
				// jQuery(this).find('.sqb_textarea_ans_field').unwrap();
				var answer_title = jQuery(this).find('.sql_ans_text').text();
				var selected_country = jQuery(this).find('.selected_country').val();
				
				if(jQuery(this).find('input[name="phone_type_required"]').prop('checked') == true){
					extra_options["required_field"] = 'Y';
				}else{
					extra_options["required_field"] = 'N';
				}
				extra_options["validation_message"] = jQuery(this).find('.validation-phone-type').attr('placeholder');
				extra_options["selected_country"] = jQuery(this).find('.selected_country').val();

			}else if(question_type == 'fill_in_blank'){
				ans_html = jQuery(this).find('.sqb_fill_in_blank_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_fill_in_blank_ans_field').unwrap();
			var answer_title = jQuery(this).find('.sql_ans_text').text();

			}else if(question_type == 'matrix'){
				var answer_title = jQuery(this).find('.sql_ans_text').html();

				 var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
				 jQuery(this).find('.sql_ans_text').unwrap();
			      var ans_img  = '';
			     
				jQuery(this).find('.answer_value').each(function(index){
					var matrix_value = jQuery(this).val();
					matrix_values.push({
								'index':index,
								'answer_value':matrix_value,
								});
				});
			} else if(question_type == "matching_text"){
				var answer_title = jQuery(this).find('.matching_answer_text').text();
				ans_html = jQuery(this).find('.matching_answer_text').wrap('<p/>').parent().html();
				jQuery(this).find('.matching_answer_text').unwrap();
				jQuery(this).find('.matching_answer_sortable li').each(function(index){
					var name = jQuery(this).find('.generated-content-text').text();
					var correct_display = jQuery(this).attr('data-id');
					var data_word = jQuery(this).attr('data-word');
					var point = jQuery(this).find('input[name="ans_poins"]').val();
					matching_text.push({
						'name':name,
						'point':point,
						'ordering': index, 
						'correct_display': correct_display,
						'data_word': data_word
						});
				});		
			}else{
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();
			    
				if(sqb_is_right_ans){
					sqb_is_right_ans = 'true';
				}else{
					sqb_is_right_ans = 'N';
				}
			}
			ans_html  = jQuery(this).wrap('<p/>').parent().html();
			jQuery(this).unwrap();
			
			var ans_poins =  jQuery(this).find('input[name="ans_poins"]').val();  
			if (typeof ans_poins === "undefined") {
				ans_poins = 0;
			}
			var numeric_correct_answer = "";
			if(question_type == 'numerical_text'){
				var numeric_correct_answer_val =  jQuery(this).find('input[name="numeric_correct_answer"]').val();  
				if (typeof numeric_correct_answer_val === "undefined") {
					numeric_correct_answer = 0;
				}else{
					numeric_correct_answer = numeric_correct_answer_val;
				}
			}
			
			//ans_html
			var ans_html1 = ans_html; 
			jQuery('.answer_data_hidden').html(ans_html1) ;
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
			jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
			if(question_type == 'phone_number'){
				jQuery('.answer_data_hidden .iti--allow-dropdown').remove();
				var sqb_round_no = jQuery('.answer_data_hidden').find('.sqb_ans_item').attr('id');
				jQuery('.answer_data_hidden .sqb_ans_item').prepend("<input class='international-phone-number sqb_and_field sqb_input_ans_field sqb_phone_number_ans_field' id='international-phone-number' name='sqb_ans_"+sqb_round_no+"' placeholder='' >");
			}
			var ans_html2 =  encodeURIComponent(jQuery('.answer_data_hidden').html());
            
            var recommendation_html  = '';
			
            if(jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.sqb_ans_option_'+answer_wrapper_id).length != 0){
				recommendation_html = jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.sqb_ans_option_'+answer_wrapper_id).closest('.sqb_ans_item_dot_option').html();
				
				jQuery('.questions_data_hidden').html(recommendation_html) ;
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
				jQuery('.questions_data_hidden .ui-wrapper').contents().unwrap();
				jQuery('.questions_data_hidden .sbq_change_img').removeClass('ui-resizable');
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
				jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
				recommendation_html =  jQuery('.questions_data_hidden').html();
				recommendation_html = encodeURIComponent(recommendation_html);
			}
            
			answer_array.push({
				'ans':ans_html2,
				'order' : index,
				'correct_ans' : sqb_is_right_ans,
				'ans_point' : ans_poins,
				'ans_hint' : ans_hint,
				'ans_info' : ans_info,
				'answer_id' : answer_id,  
				'answer_title' : answer_title,  
				'answer_wrapper_id' : answer_wrapper_id,
				'matrix_values' : matrix_values,   
				'extra_options' : extra_options,  
				'matching_text' : matching_text,  
				'recommendation_html' : recommendation_html, 
				'numeric_correct_answer' : numeric_correct_answer, 
			});
		});
		
		var outcome_results_checkbox = [];
		var outcome_result_checkbox = [];
		jQuery('.sqb_question_no.active').find('.assessment_outcome_connect .quiz-content-card').each(function(index){ 
			var outcome_mapping_id = jQuery(this).attr('data-id');
			var outcome_wrapper_id = jQuery(this).attr('id');
			var outcome_answer_id = jQuery(this).attr('data-answer-id');
			var outcome_answer_index_id = jQuery(this).attr('data-answer-index-id');
			var outcome_result_checkbox = [];
			jQuery(this).find("input[name='outcome_result_checkbox']:checked").each(function(){
				outcome_result_checkbox.push(jQuery(this).val());
			});
			outcome_results_checkbox.push({'coutcome_selected_id':outcome_result_checkbox,'outcome_mapping_id':outcome_mapping_id,'outcome_wrapper_id':outcome_wrapper_id,'outcome_answer_id':outcome_answer_id,'outcome_answer_index_id':outcome_answer_index_id});
		});		
		}

		//questions_data sqb_question_enable_drag_drop
		var questions_data1 = question_data; 
		jQuery('.questions_data_hidden').html(questions_data1) ;
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
		jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
		
		if(question_desc == 'Enter any additional information about the quiz'){
			jQuery('.questions_data_hidden').find('.question_description').hide();
		}
		var questions_data2 =  encodeURIComponent(jQuery('.questions_data_hidden').html());
		
		var question_temp_inner_width = '';
		if(select_temp == 'template8'){
			if(typeof  jQuery('.sqb_question_no.active').find('.outer-style8').find('.question_add_answer_outer_div').css('width') != 'undefined'){
				question_temp_inner_width  = jQuery('.sqb_question_no.active').find('.outer-style8').find('.question_add_answer_outer_div').css('max-width');
			}
		}else if(select_temp == 'template9'){
			if(typeof  jQuery('.sqb_question_no.active').find('.outer-style9').find('.question_add_answer_outer_div').css('width') != 'undefined'){
				question_temp_inner_width  = jQuery('.sqb_question_no.active').find('.outer-style9').find('.question_add_answer_outer_div').css('max-width');
			}
		}
		
		temp_customizer = question_temp_max_width;
		var matrix_labels_text = [];
		var matrix_html = '';
		if(question_type == 'rating'){
			var question_rating_lable_low_text = jQuery('.sqb_question_no.active').find('.question_rating_lable_low_text').html();
			var question_rating_lable_high_text = jQuery('.sqb_question_no.active').find('.question_rating_lable_high_text').html();
			if(select_temp == 'template8'){
			temp_customizer = temp_customizer+'||'+question_rating_lable_low_text+'||'+question_rating_lable_high_text+'||'+question_temp_inner_width;
			} else {
			temp_customizer = temp_customizer+'||'+question_rating_lable_low_text+'||'+question_rating_lable_high_text;
			}
		}else if(question_type == 'matrix'){
			jQuery('.sqb_question_no.active').find('.matrix_label_text').each(function(index){
				   var matrix_label_text = jQuery(this).html();
					matrix_labels_text.push({
						'index':index,
						'matrix_label_text':encodeURIComponent(matrix_label_text),
					});
				});
				matrix_html = encodeURIComponent(jQuery('.sqb_question_no.active').find('.answer_matrix_save_table').html());
				var matrix_column_width = jQuery('.sqb_question_no.active').find('input[name="matrix-column-width"]').val();
				if(select_temp == 'template8'){
					temp_customizer = temp_customizer+'||'+question_temp_inner_width;
				}
		} else {
			if(select_temp == 'template8' || select_temp == 'template9'){
				temp_customizer = temp_customizer+'||'+question_temp_inner_width;
			} else {
			    temp_customizer = temp_customizer;
			}
		}
		
		var question_next_button_html = '';
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			quiz_temp_left_bgcolor = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-color');
			quiz_temp_right_bgcolor = jQuery('.sqb_question_no.active').find('.Quiz-Template5-right-side').css('background-color');
			quiz_temp_height = jQuery('.sqb_question_no.active').find('.Quiz-Template5-inner').css('min-height');
			
			var background_image_url = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="question_background_image"]').val();
			var background_image_size = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size');
			var background_image_repeat = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-repeat');
			var background_image_position = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-position');
			var background_image_style = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').attr('style');
			var title_background_color = jQuery('.sqb_question_no.active').find('.question_details').css('background-color');
			
			var bg_img_opacity = '';
			var sqb_question_screen_bg_image_opacity_clr = jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image');
			if (typeof sqb_question_screen_bg_image_opacity_clr != "undefined" && sqb_question_screen_bg_image_opacity_clr != "none" && sqb_question_screen_bg_image_opacity_clr.search("linear-gradient") != -1) {
				bg_img_opacity = get_background_image_opacity(sqb_question_screen_bg_image_opacity_clr);
			}
			
			var progress_bar_color = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="progress_bar_color"]').val();
			
			temp_customizer = temp_customizer+'||'+quiz_temp_left_bgcolor+'||'+quiz_temp_right_bgcolor+'||'+quiz_temp_height+'||'+background_image_url+'||'+background_image_size+'||'+background_image_repeat+'||'+background_image_position+'||'+title_background_color+'||'+bg_img_opacity+'||'+progress_bar_color;
			
			question_next_button_html = encodeURIComponent(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.sqb_quiz_template5_next_button_outer').html());
			if(typeof question_next_button_html == 'undefined'){
			question_next_button_html = '';
			}
		}
		
		if(jQuery('input[name="select_temp"]:checked').val() == 'template7' || jQuery('input[name="select_temp"]:checked').val() == 'template8'){
			question_next_button_html = encodeURIComponent(jQuery('.sqb_question_no.active').find('.question_div_outer').find('.continue-question-action').html());
			if(typeof question_next_button_html == 'undefined'){
			question_next_button_html = '';
			}
		}
		
		if(question_type == 'file_upload'){
		 var question_file_upload_settings = jQuery('.sqb_question_no.active').find('.question_div_outer').find('input[name="question_file_upload_settings"]').val();
		}
		
		var enable_question_background_image = 'N';
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			enable_question_background_image = jQuery(this).find('.question_div_outer').find('input[name="enable_question_background_image"]').val();
			if(enable_question_background_image == ''){
				enable_question_background_image = 'N';
			}
		}
		
		var enable_recommendation = 'Y';
		
		all_questions_data.push({
		'question_data':questions_data2,
		'answer_array':answer_array, 
		'order':ques_index, 
		'question_type':question_type, 
		'question_temp_name':question_temp_name, 
		'question_temp_no':question_temp_no,
		'ans_with_img': sqb_ans_with_img_checkbox,
		'ans_layout' : ans_layout,
		'outcome_results_checkbox': outcome_results_checkbox,  
		'multiple_correct_ans': multiple_correct_ans,  
		'question_id': question_id,  
		'question_title': question_title,  
		'question_wrapper_id': question_wrapper_id,    
		'show_correct_inccorect_ans_checkbox': show_correct_inccorect_ans_checkbox,  
		'temp_customizer': temp_customizer,  
		'question_file_upload_settings':question_file_upload_settings,  
		'allow_skip_ques': allow_skip_ques,    
		'question_skip_button_html': question_skip_button_html,    
		'skip_outcome_mapping': skip_outcome_mapping,    
		'question_next_button_html': question_next_button_html,  
		'enable_question_background_image': enable_question_background_image,  
		'matrix_labels_text': matrix_labels_text,  
		'matrix_html': matrix_html,  
		'quiz_category_id':quiz_category_id,
		'matrix_column_width':matrix_column_width,
		'ans_img_setting':ans_img_setting,
		'question_setting':question_setting,
		});
		
		var form_data = {
				id: id,
				questions_data : all_questions_data,
				actionType : 'save_ques',
				showArr : 'yes',
			}
			
			callSaveQuestionAnswers(form_data, 0, '', '','');

}



function sqb_save_questions_and_answers(error, error_msg,next_tab,tab_id){
	
	var select_temp_class = '';
	var select_temp = jQuery('input[name="select_temp"]:checked').val();
	var id = jQuery('input[name="edit_id"]').val();
	var quiz_name = jQuery('.sqb_detail_quiz_name').text();
	var quiz_type = jQuery('.sqb_detail_quiz_type').text();
	

	var ids = {}; // Object to store counts of IDs and content
	var duplicates = []; // Array to store duplicate IDs

	jQuery(".sqb_questions_wrapper .sqb_ans_item").each(function () {
	    var id = jQuery(this).attr("id");
	    var content = jQuery(this).find(".sql_ans_text").text().trim();
	    if (id && content) {
	        if (ids[id]) {
	            if (ids[id] === content) {
	                duplicates.push({ id: id, content: content });
	                jQuery(this).remove();
	            }
	        } else {
	            ids[id] = content;
	        }
	    }
	});

	sqbShowskipbuttonValidationMsg();
	var j = 0;
	var k = 1;
	
	var all_questions_data = [];
	var questions_data_array = {};

	var ques_index = jQuery('.left_side_question_list ul li').first().find('a').attr('data-questionno');
	if(ques_index == ''|| ques_index == 'undefined'|| ques_index == null ){
		var ques_index = 1;
	}
	var questionsMax = jQuery('.ques_ans_contain .sqb_questions_wrapper  .sqb_question_no').length;
	if(jQuery('.ques_ans_contain .sqb_questions_wrapper  .sqb_question_no').length > 0){
		jQuery('.ques_ans_contain .sqb_questions_wrapper  .sqb_question_no').each(function(index_question){
			
		 var quiz_category_id = '';
		 var quiz_type_new_var = jQuery('input[name="quiz_type"]:checked').val();
		 if((quiz_type_new_var == 'assessment') || (quiz_type_new_var == 'scoring')){
		 	if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
		 		quiz_category_id = jQuery(this).find('.question-screen .quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
		 	}else if(select_temp == 'template7'){
				quiz_category_id = jQuery(this).find('.question-screen .quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
		 	}else{
				quiz_category_id = jQuery(this).find('.quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
		 	}
		  }
			console.log(quiz_category_id);
		
		var question_id = jQuery(this).find('.sqb_question_enable_drag_drop').attr('data-id');
		var question_wrapper_id = jQuery(this).find('.question_div_outer').attr('id');
		var ans_hint = jQuery(this).find('.question_div_outer').find('.QA-advance-option .sqb_incorrect_ans ').val();
		var ans_info = jQuery(this).find('.question_div_outer').find('.QA-advance-option .sqb_correct_ans').val();
		var question_skip_button_html = '';
		
		if(select_temp == 'template7'){
			if(select_temp == 'template7'){
				var allow_skip_ques = jQuery(this).find('.question_div_outer .template7-skip-question-button').find('input[name="skipquestion"]').prop('checked');	
				if(allow_skip_ques){
					allow_skip_ques = 'Y';
				}else{
					allow_skip_ques = 'N';
				}
			} else {
				var allow_skip_ques_status = jQuery(this).find('.question_div_outer').find('.skip-question-action').css('display');
				if(allow_skip_ques_status != 'none'){
				allow_skip_ques = 'Y';
				} else {
				allow_skip_ques = 'N';
				}
			}
			question_skip_button_html = encodeURIComponent(jQuery(this).find('.question_div_outer').find('.skip-question-action').html());
			if(typeof question_skip_button_html == 'undefined'){
			question_skip_button_html = '';
			}
		
		} else if(select_temp == 'template6' || select_temp == 'template8' || select_temp == 'template9'){
			var allow_skip_ques = jQuery(this).find('.question_div_outer .template8_question_screen_setting_right-side').find('.skip-btn-temp-8 input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
		}else if(select_temp == 'template5'){
			var allow_skip_ques = jQuery(this).find('.question_div_outer .Quiz-Template5-right-side').find('input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
		}else {
			var allow_skip_ques = jQuery(this).find('.ans_layout_div').find('input[name="allow_skip_ques"]').prop('checked');
			if(allow_skip_ques){
				allow_skip_ques = 'Y';
			}else{
				allow_skip_ques = 'N';
			}
			question_skip_button_html = '';
		}
		

		var skip_outcome_mapping = 'N';
		
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		var ques_type = jQuery(this).find('.question_div_outer').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');


		if((quiz_type == 'personality') && ((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating') || (ques_type == 'matrix'))){
				if(jQuery(this).find('.question_div_outer').find('.assessment_outcome_connect_btn .outcome-option-connect').hasClass('outcome-option-active')){				
					skip_outcome_mapping = 'N';
				} else {
					skip_outcome_mapping = 'Y';
				}
		}
		
		var multiple_correct_ans = jQuery(this).find('.question_div_outer').find('input[name="multiple_correct_ans"]').prop('checked');
		
		if(multiple_correct_ans){
			multiple_correct_ans = 'Y';
		}else{
			multiple_correct_ans = 'N';
		}
		
		
		var question_type = '';
		
		if(1){
			var selected_template = jQuery('input[name="select_temp"]:checked').val();
			if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
				var question_type = jQuery(this).find('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
			}else{
				var question_type = jQuery(this).find('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
			}
		}else{
			
			var question_type = "";
		}
		
		if(question_type == 'multi'){
			multiple_correct_ans = 'Y';
		}
		
		var question_temp_name = jQuery(this).find('.question_div_outer').find('input[name="question_temp_name"]').val();
		var question_temp_no = jQuery(this).find('.question_div_outer').find('input[name="question_temp_no"]').val();
		
		if(select_temp =="template1"){
		}else if(select_temp =="template2"){
			select_temp_class = 'outer-style1';

		}else if(select_temp =="template3"){
			select_temp_class = 'outer-style2';
		}else if(select_temp =="template4"){
		}else if(select_temp =="template7"){
			select_temp_class = 'outer-style7';
		}else if(select_temp =="template8"){
			select_temp_class = 'outer-style8';
		}else{	
		}    
		
		var show_correct_inccorect_ans_checkbox = "Y";
		var question_data = jQuery(this).find('.question_div_outer').find('.question_details').wrap('<p/>').parent().html();
        jQuery(this).find('.question_div_outer').find('.question_details').unwrap();

		var question_temp_max_width  = '700px';
        if( select_temp == 'template4'){
			if(typeof  jQuery(this).find('.outer-style3').css('max-width') != 'undefined'){
				var question_temp_max_width  = jQuery(this).find('.outer-style3').css('max-width');
			}
		}else{
			if(typeof jQuery(this).find('.Quiz-Template').css('max-width') != 'undefined'){
				var question_temp_max_width  = jQuery(this).find('.Quiz-Template').css('max-width');
			}
		}  
		
		var question_title = jQuery(this).find('.question_div_outer').find('.question_details').find('.question_title').text();
		var question_desc = jQuery(this).find('.question_div_outer').find('.question_details').find('.question_description').text();
		
        var answer_array = [];
		if(select_temp == 'template8' || select_temp == 'template9' || select_temp == 'template6'){
		var sqb_ans_with_img_checkbox = jQuery(this).find('.template8_question_screen_setting_options_wrapper').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
		var sqb_multiple_ans_limited = jQuery(this).find('.template8_question_screen_setting_options_wrapper').find('input[name="sqb_multiple_ans_limited"]').prop('checked');
		} else {
		var sqb_ans_with_img_checkbox = jQuery(this).find('.question_div_outer').find('.Quiz-Template').find('input[name="sqb_ans_with_img_checkbox"]').prop('checked');
		var sqb_multiple_ans_limited = jQuery(this).find('.question_div_outer').find('.Quiz-Template').find('input[name="sqb_multiple_ans_limited"]').prop('checked');
		}

		if(select_temp == 'template6' || select_temp == 'template7' || select_temp == 'template8' || select_temp == 'template9'){
			if(jQuery(this).find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-two-in-row-active')){
				 var ans_layout  = "multiple";
			}else if(jQuery(this).find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-three-in-row-active')){ 
				 var ans_layout  = "layout-three-in-row";
			}else if(jQuery(this).find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-four-in-row-active')){ 
				 var ans_layout  = "layout-four-in-row";
			}else if(jQuery(this).find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-five-in-row-active')){ 
				 var ans_layout  = "layout-five-in-row";
			}else if(jQuery(this).find('.question_div_inner').find('.question_add_answer_outer_div').hasClass('layout-six-in-row-active')){ 
				 var ans_layout  = "layout-six-in-row";
			} else {
				var ans_layout = 'standard';
			}
		} else {
			var ans_layout = 'standard';
			if(jQuery(this).find('.question_div_outer').find('.ans_layout_typw.selected-op').hasClass('sqb_ans_layout_mulitple')){
				 ans_layout  = "multiple";
			}else if(jQuery(this).find('.question_div_outer').find('.ans_layout_typw.selected-op').hasClass('sqb_ans_layout_three_in_row')){ 
				 ans_layout  = "layout-three-in-row";
			}
		}
		
		var ans_img_setting = {};
		if(sqb_ans_with_img_checkbox){
			sqb_ans_with_img_checkbox = 'Y';
			var ans_image_size_option = jQuery(this).find('.question_div_inner').find('.ans-image-size-options').val();
			var ans_image_height = jQuery(this).find('.question_div_inner').find('#sqb_image_custom_height').val();
			var ans_image_width = jQuery(this).find('.question_div_inner').find('#sqb_image_custom_width').val();
			var sqb_ans_show_label = 'N';

			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				var sqb_ans_show_label_checkbox = jQuery(this).find('.question_div_outer').find('.ans_layout_div input[name="sqb_ans_show_label"]').prop('checked');
			}else{
				var sqb_ans_show_label_checkbox = jQuery(this).find('.question_div_outer').find('input[name="sqb_ans_show_label"]').prop('checked');
			}

			if(sqb_ans_show_label_checkbox){
				var sqb_ans_show_label = 'Y';
			}
			ans_img_setting = { 'ans_image_size_option': ans_image_size_option,'ans_image_width':ans_image_width,'ans_image_height':ans_image_height, 'sqb_ans_show_label': sqb_ans_show_label};
		}else{
			sqb_ans_with_img_checkbox = 'N';
		}

		var multiple_ans_checked = 'N';
		var sqb_multiple_ans_input_limit = "";
		if(sqb_multiple_ans_limited){
			multiple_ans_checked = 'Y';
			if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
				sqb_multiple_ans_input_limit = jQuery(this).find('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('input[name="sqb_multiple_ans_input_limit"]').val();
			}else{
				sqb_multiple_ans_input_limit = jQuery(this).find('input[name="sqb_multiple_ans_input_limit"]').val();
			}
		}
		
		var dropdown_label = encodeURIComponent(jQuery(this).find('.question_add_answer_outer_div #dropdown-label').val());
		var dropdown_default_value = jQuery(this).find('.question_add_answer_outer_div #dropdown-default-value').val();
		var dropdown_values = jQuery(this).find('.question_add_answer_outer_div #dropdown-fields-value').val();
		

		if(select_temp == 'template9'){
			var temp_layout = 'sqb-template-bg-full-width';
			var video_url = "";
			var video_controls = "Y";
			var video_source = "";
			var splash_image = "";
			var video_caption = '';
			var video_play_btn_color = "#ffffff";
			if(jQuery(this).find('.Quiz-Template9-inner').hasClass('sqb-template-bg-full-width')){
				temp_layout = 'sqb-template-bg-full-width';
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('sqb-template-bg-image-left')){
				temp_layout = 'sqb-template-bg-image-left';
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('sqb-template-bg-image-right')){
				temp_layout = 'sqb-template-bg-image-right';
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('sqb-template-bg-video-left')){
				temp_layout = 'sqb-template-bg-video-left';
				video_url = jQuery(this).find('input[name="video_id"]').val();
				video_controls = jQuery(this).find('input[name="video_controls"]').val();
				video_source = jQuery(this).find('input[name="video_source"]').val();
				splash_image = jQuery(this).find('input[name="splash_image"]').val();
				video_caption = jQuery(this).find('input[name="video_caption"]').val();
				video_play_btn_color = jQuery(this).find('input[name="video_play_btn_color"]').val();
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('sqb-template-bg-video-right')){
				temp_layout = 'sqb-template-bg-video-right';
				video_url = jQuery(this).find('input[name="video_id"]').val();
				video_controls = jQuery(this).find('input[name="video_controls"]').val();
				video_source = jQuery(this).find('input[name="video_source"]').val();
				splash_image = jQuery(this).find('input[name="splash_image"]').val();
				video_caption = jQuery(this).find('input[name="video_caption"]').val();
				video_play_btn_color = jQuery(this).find('input[name="video_play_btn_color"]').val();
			}

			var template_alignment = 'template9-inner-left';
			if(jQuery(this).find('.Quiz-Template9-inner').hasClass('template9-inner-left')){
				template_alignment = 'template9-inner-left';
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('template9-inner-right')){
				template_alignment = 'template9-inner-right';
			}else if(jQuery(this).find('.Quiz-Template9-inner').hasClass('template9-inner-center')){
				template_alignment = 'template9-inner-center';
			}

			var template_image = jQuery(this).find('.Quiz-Template9-inner .Quiz-Template9-left-side').css('background-image');
			if(template_image != 'none'){
				template_image = template_image.replace('url(','').replace(')','').replace(/\"/gi, "");
			}else{
				template_image = '';
			}

			var background_color = jQuery(this).find('.Quiz-Template9-inner').css('background-color')
			
			var question_video_source = jQuery(this).find('.video_source').val();

			var question_setting = { 'dropdown_label': dropdown_label,'dropdown_default_value':dropdown_default_value,'dropdown_values':dropdown_values, 'temp_layout': temp_layout, 'template_alignment': template_alignment, 'template_image': template_image, 'background_color': background_color, 'video_url': video_url, 'video_controls': video_controls,'video_source': video_source, 'splash_image':splash_image, 'video_play_btn_color': video_play_btn_color, 'question_video_source': question_video_source, 'video_caption': video_caption, 'multiple_ans_checked': multiple_ans_checked, 'sqb_multiple_ans_input_limit': sqb_multiple_ans_input_limit};
		}else{
			var question_setting = { 'dropdown_label': dropdown_label,'dropdown_default_value':dropdown_default_value,'dropdown_values':dropdown_values, 'multiple_ans_checked': multiple_ans_checked, 'sqb_multiple_ans_input_limit': sqb_multiple_ans_input_limit};
		}
		
		var matrix_add_value = false;
		if(jQuery(this).find('.SQB-main-table').hasClass('show_value_matrix_box')){
			matrix_add_value = true;
		}
		
		if(jQuery(this).find('.question_add_answer_outer_div  .sqb_ans_item').length > 0){
		jQuery(this).find('.question_add_answer_outer_div  .sqb_ans_item').each(function(index){
			var matrix_values = [];
			var matching_text = [];
			var extra_options = {};

			var answer_id = jQuery(this).attr('data-id');
			var answer_wrapper_id = jQuery(this).attr('id');
			
			var answer_title = jQuery(this).find('.sql_ans_text').text();
			var sqb_is_right_ans = 'N';
			var ans_html =  '';
			if(question_type == 'text'){
				ans_html = jQuery(this).find('.sqb_textarea_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_textarea_ans_field').unwrap();
			var answer_title = jQuery(this).find('.sql_ans_text').text();
				
			}else if(question_type == 'fill_in_blank'){
				ans_html = jQuery(this).find('.sqb_fill_in_blank_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_fill_in_blank_ans_field').unwrap();
				var answer_title = jQuery(this).find('.sql_ans_text').text();

			}else if(question_type == 'matrix'){
				var answer_title = jQuery(this).find('.sql_ans_text').html();

				 var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
				 jQuery(this).find('.sql_ans_text').unwrap();
			      var ans_img  = '';
			     
				jQuery(this).find('.answer_value').each(function(index){
					var matrix_value = jQuery(this).val();
					matrix_values.push({
						'index':index,
						'answer_value':matrix_value,
					});
				});
			}else if(question_type == 'matching_text'){
				var answer_title = jQuery(this).find('.matching_answer_text').text();
				ans_html = jQuery(this).find('.matching_answer_text').wrap('<p/>').parent().html();
				jQuery(this).find('.matching_answer_text').unwrap();
				jQuery(this).find('.matching_answer_sortable li').each(function(index){
					var name = jQuery(this).find('.generated-content-text').text();
					var correct_display = jQuery(this).attr('data-id');
					var data_word = jQuery(this).attr('data-word');
					var point = jQuery(this).find('input[name="ans_poins"]').val();
					matching_text.push({
						'name':name,
						'point':point,
						'ordering': index, 
						'correct_display': correct_display,
						'data_word': data_word
						});
				});
			}else if(question_type == 'email'){
				ans_html = jQuery(this).find('.sqb_email_ans_field').wrap('<p/>').parent().html();
				jQuery(this).find('.sqb_email_ans_field').unwrap();
				var answer_title = jQuery(this).find('.sql_ans_text').text();
				
				if(jQuery(this).find('input[name="email_type_required"]').prop('checked') == true){
					extra_options["required_field"] = 'Y';
				}else{
					extra_options["required_field"] = 'N';
				}
				extra_options["validation_message"] = jQuery(this).find('.validation-email-type').attr('placeholder');
			}else if(question_type == 'weight_and_height'){
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();

				extra_options["validation_message"] = jQuery(this).find('.validation-hw-type').attr('placeholder');
			}else if(question_type == 'name'){
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();

				extra_options["validation_message"] = jQuery(this).find('.validation-hw-type').attr('placeholder');
			}else if(question_type == 'phone_number'){
				var sqb_datetime = new Date();
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);

				ans_html = "<div class='sqb_ans_item' data-id='%%ANSWERID%%' id='"+sqb_round_no+"'><input class='international-phone-number sqb_and_field sqb_input_ans_field sqb_phone_number_ans_field' id='international-phone-number' name='sqb_ans_"+sqb_round_no+"' placeholder='' ></textarea></div>";
				var answer_title = jQuery(this).find('.sql_ans_text').text();
				var selected_country = jQuery(this).find('.selected_country').val();
				
				if(jQuery(this).find('input[name="phone_type_required"]').prop('checked') == true){
					extra_options["required_field"] = 'Y';
				}else{
					extra_options["required_field"] = 'N';
				}
				extra_options["validation_message"] = jQuery(this).find('.validation-phone-type').attr('placeholder');
				extra_options["selected_country"] = jQuery(this).find('.selected_country').val();
			}else{
				var answer_title = jQuery(this).find('.sql_ans_text').text();

				var sqb_is_right_ans = jQuery(this).find('.sqb_is_right_ans').prop('checked');
			    var ans_html  = jQuery(this).find('.sql_ans_text').wrap('<p/>').parent().html();
			    jQuery(this).find('.sql_ans_text').unwrap();
			    
			    var ans_img  = jQuery(this).find('.sqb_ans_item_img').wrap('<p/>').parent().html();
			    jQuery(this).find('.sqb_ans_item_img').unwrap();
			    
				if(sqb_is_right_ans){
					sqb_is_right_ans = 'true';
				}else{
					sqb_is_right_ans = 'N';
				}
			}
			
			
			ans_html  = jQuery(this).wrap('<p/>').parent().html();
			jQuery(this).unwrap();
			
			var ans_poins =  jQuery(this).find('input[name="ans_poins"]').val();  
			if (typeof ans_poins === "undefined") {
				ans_poins = 0;
			}

			var numeric_correct_answer = "";
			if(question_type == 'numerical_text'){
				var numeric_correct_answer_val =  jQuery(this).find('input[name="numeric_correct_answer"]').val();  
				if (typeof numeric_correct_answer_val === "undefined") {
					numeric_correct_answer = 0;
				}else{
					numeric_correct_answer = numeric_correct_answer_val;
				}
			}
			
			//ans_html
			var ans_html1 = ans_html; 
			jQuery('.answer_data_hidden').html(ans_html1) ;
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
			jQuery('.answer_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
			jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
			if(question_type == 'phone_number'){
				jQuery('.answer_data_hidden .iti--allow-dropdown').remove();
				var sqb_round_no = jQuery('.answer_data_hidden').find('.sqb_ans_item').attr('id');
				jQuery('.answer_data_hidden .sqb_ans_item').prepend("<input class='international-phone-number sqb_and_field sqb_input_ans_field sqb_phone_number_ans_field' id='international-phone-number' name='sqb_ans_"+sqb_round_no+"' placeholder='' >");
			}
			
			var ans_html2 =  encodeURIComponent(jQuery('.answer_data_hidden').html());
            
            var recommendation_html  = '';
            if(jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.sqb_ans_option_'+answer_wrapper_id).length != 0){
				recommendation_html = jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.sqb_ans_option_'+answer_wrapper_id).closest('.sqb_ans_item_dot_option').html();
				
				jQuery('.questions_data_hidden').html(recommendation_html) ;
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
				jQuery('.questions_data_hidden .ui-wrapper').contents().unwrap();
				jQuery('.questions_data_hidden .sbq_change_img').removeClass('ui-resizable');
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
				jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
				jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
				recommendation_html =  jQuery('.questions_data_hidden').html();
				recommendation_html = encodeURIComponent(recommendation_html);
			}
           
            
			answer_array.push({
				'ans':ans_html2,
				'order' : index,
				'correct_ans' : sqb_is_right_ans,
				'ans_point' : ans_poins,
				'ans_hint' : ans_hint,
				'ans_info' : ans_info,
				'answer_id' : answer_id,  
				'answer_title' : answer_title,  
				'answer_wrapper_id' : answer_wrapper_id,
				'matrix_values' : matrix_values,  
				'recommendation_html' : recommendation_html,   
				'extra_options' : extra_options,   
				'matching_text' : matching_text,   
				'numeric_correct_answer' : numeric_correct_answer,   
			});
		});
		
		var outcome_results_checkbox = [];
		var outcome_result_checkbox = [];

		if(question_type != 'matrix'){
			jQuery(this).find('.assessment_outcome_connect .quiz-content-card').each(function(index){ 
				var outcome_mapping_id = jQuery(this).attr('data-id');
				var outcome_wrapper_id = jQuery(this).attr('id');
				var outcome_answer_id = jQuery(this).attr('data-answer-id');
				var outcome_answer_index_id = jQuery(this).attr('data-answer-index-id');
				var outcome_result_checkbox = [];
				jQuery(this).find("input[name='outcome_result_checkbox']:checked").each(function(){
					outcome_result_checkbox.push(jQuery(this).val());
				
				});
				outcome_results_checkbox.push({'coutcome_selected_id':outcome_result_checkbox,'outcome_mapping_id':outcome_mapping_id,'outcome_wrapper_id':outcome_wrapper_id,'outcome_answer_id':outcome_answer_id,'outcome_answer_index_id':outcome_answer_index_id});
				
			});		
		}
		
		}

		//questions_data sqb_question_enable_drag_drop
		var questions_data1 = question_data; 
		jQuery('.questions_data_hidden').html(questions_data1) ;
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-e').remove();
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-se').remove();
		jQuery('.questions_data_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
		jQuery('.answer_data_hidden .type-slider-outer #ex1Slider').remove();
		
		if(question_desc == 'Enter any additional information about the quiz'){
			jQuery('.questions_data_hidden').find('.question_description').hide();
		}
		var questions_data2 =  encodeURIComponent(jQuery('.questions_data_hidden').html());
		
		var question_temp_inner_width = '';
		if(select_temp == 'template8'){
			if(typeof  jQuery(this).find('.outer-style8').find('.question_add_answer_outer_div').css('width') != 'undefined'){
				question_temp_inner_width  = jQuery(this).find('.outer-style8').find('.question_add_answer_outer_div').css('max-width');
			}
		}else if(select_temp == 'template9'){
			if(typeof  jQuery(this).find('.outer-style9').find('.question_add_answer_outer_div').css('width') != 'undefined'){
				question_temp_inner_width  = jQuery(this).find('.outer-style9').find('.question_add_answer_outer_div').css('max-width');
			}
		}
		
		temp_customizer = question_temp_max_width;
		var matrix_labels_text = [];
		var matrix_html = '';
		if(question_type == 'rating'){
			var question_rating_lable_low_text = jQuery(this).find('.question_rating_lable_low_text').html();
			var question_rating_lable_high_text = jQuery(this).find('.question_rating_lable_high_text').html();
			if(select_temp == 'template8'){
			temp_customizer = temp_customizer+'||'+question_rating_lable_low_text+'||'+question_rating_lable_high_text+'||'+question_temp_inner_width;
			} else {
			temp_customizer = temp_customizer+'||'+question_rating_lable_low_text+'||'+question_rating_lable_high_text;
			}
		}else if(question_type == 'matrix'){
			jQuery(this).find('.matrix_label_text').each(function(index){
				   var matrix_label_text = jQuery(this).html();
					matrix_labels_text.push({
								'index':index,
								'matrix_label_text':encodeURIComponent(matrix_label_text),
								});
				});
				matrix_html = encodeURIComponent(jQuery(this).find('.answer_matrix_save_table').html());

				var matrix_column_width = jQuery(this).find('input[name="matrix-column-width"]').val();
				if(select_temp == 'template8'){
					temp_customizer = temp_customizer+'||'+question_temp_inner_width;
				}
		} else {
			if(select_temp == 'template8' || select_temp == 'template9'){
				temp_customizer = temp_customizer+'||'+question_temp_inner_width;
			} else {
			    temp_customizer = temp_customizer;
			}
		}
		
		var question_next_button_html = '';
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			quiz_temp_left_bgcolor = jQuery(this).find('.Quiz-Template5-left-side').css('background-color');
			quiz_temp_right_bgcolor = jQuery(this).find('.Quiz-Template5-right-side').css('background-color');
			quiz_temp_height = jQuery(this).find('.Quiz-Template5-inner').css('min-height');
			
			var background_image_url = jQuery(this).find('.question_div_outer').find('input[name="question_background_image"]').val();
			var background_image_size = jQuery(this).find('.Quiz-Template5-left-side').css('background-size');
			var background_image_repeat = jQuery(this).find('.Quiz-Template5-left-side').css('background-repeat');
			var background_image_position = jQuery(this).find('.Quiz-Template5-left-side').css('background-position');
			var background_image_style = jQuery(this).find('.Quiz-Template5-left-side').attr('style');
			var title_background_color = jQuery(this).find('.question_details').css('background-color');
			
			var bg_img_opacity = '';
			var sqb_question_screen_bg_image_opacity_clr = jQuery(this).find('.Quiz-Template5-left-side').css('background-image');
			if (typeof sqb_question_screen_bg_image_opacity_clr != "undefined" && sqb_question_screen_bg_image_opacity_clr != "none" && sqb_question_screen_bg_image_opacity_clr.search("linear-gradient") != -1) {
				bg_img_opacity = get_background_image_opacity(sqb_question_screen_bg_image_opacity_clr);
			}
			
			var progress_bar_color = jQuery(this).find('.question_div_outer').find('input[name="progress_bar_color"]').val();
			
			temp_customizer = temp_customizer+'||'+quiz_temp_left_bgcolor+'||'+quiz_temp_right_bgcolor+'||'+quiz_temp_height+'||'+background_image_url+'||'+background_image_size+'||'+background_image_repeat+'||'+background_image_position+'||'+title_background_color+'||'+bg_img_opacity+'||'+progress_bar_color;
			
			question_next_button_html = encodeURIComponent(jQuery(this).find('.question_div_outer').find('.sqb_quiz_template5_next_button_outer').html());
			if(typeof question_next_button_html == 'undefined'){
			question_next_button_html = '';
			}
		}
		
		if(jQuery('input[name="select_temp"]:checked').val() == 'template7' || jQuery('input[name="select_temp"]:checked').val() == 'template8'){
			question_next_button_html = encodeURIComponent(jQuery(this).find('.question_div_outer').find('.continue-question-action').html());
			if(typeof question_next_button_html == 'undefined'){
			question_next_button_html = '';
			}
		}
		
		if(question_type == 'file_upload'){
		 var question_file_upload_settings = jQuery(this).find('.question_div_outer').find('input[name="question_file_upload_settings"]').val();
		}
		
		var enable_question_background_image = 'N';
		if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
			enable_question_background_image = jQuery(this).find('.question_div_outer').find('input[name="enable_question_background_image"]').val();
			if(enable_question_background_image == ''){
				enable_question_background_image = 'N';
			}
		}
		
		var enable_recommendation = 'Y';
				
		all_questions_data.push({
		'question_data':questions_data2,
		'answer_array':answer_array, 
		'order':ques_index, 
		'question_type':question_type, 
		'question_temp_name':question_temp_name, 
		'question_temp_no':question_temp_no,
		'ans_with_img': sqb_ans_with_img_checkbox,
		'ans_layout' : ans_layout,
		'outcome_results_checkbox': outcome_results_checkbox,  
		'multiple_correct_ans': multiple_correct_ans,  
		'question_id': question_id,  
		'question_title': question_title,  
		'question_wrapper_id': question_wrapper_id,    
		'show_correct_inccorect_ans_checkbox': show_correct_inccorect_ans_checkbox,  
		'temp_customizer': temp_customizer,  
		'question_file_upload_settings':question_file_upload_settings,  
		'allow_skip_ques': allow_skip_ques,    
		'question_skip_button_html': question_skip_button_html,    
		'skip_outcome_mapping': skip_outcome_mapping,    
		'question_next_button_html': question_next_button_html,  
		'enable_question_background_image': enable_question_background_image,  
		'matrix_labels_text': matrix_labels_text,  
		'matrix_html': matrix_html,  
		'quiz_category_id':quiz_category_id,
		'matrix_column_width':matrix_column_width,
		'ans_img_setting':ans_img_setting,
		'question_setting':question_setting,
		});
		
		ques_index++;
	
		if(j == 5){
			var form_data = {
				id: id,
				questions_data : all_questions_data,
				actionType : 'save_ques',
			}	
			callSaveQuestionAnswers(form_data, 0, next_tab, error,tab_id);
			
			all_questions_data = [];
			j = 0;

		}else if(questionsMax == k){
			var form_data = {
				id: id,
				questions_data : all_questions_data,
				actionType : 'save_ques',
				showArr : 'yes',
			}
			
			callSaveQuestionAnswers(form_data, 0, next_tab, error,tab_id);
		}
		j++;
		k++;

		
	});
	
	}else{
		SQBHideLoader();
		if(tab_id == 'Formula-Screen'){
		setTimeout(function(){ jQuery('#Formula-Screen-tab').trigger('click'); }, 100);
		}
		if(next_tab != 'next' && error == ''){
			setTimeout(function() {
			jQuery(".quiz-save-btn-msg").remove();
			}, 3000);
			
		}
	}



	

	if(error != ''){
		jQuery(".quiz-actions").before('<div class="question_error_msg_outer">'+error_msg+'<div class=" question_validations">'+error+'</div></div>');	
		jQuery('html, body').animate({
	        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
	    }, 2000);

	}
	sqbShowProgressBarValidationMsg();
	sqbShowFunnelWithPaginationValidationMsg();
	
	sqbShowReorderQuestionsFunnelValidationMsg();
	jQuery('.quiz-save-btn').text('Save');
}

function sqbShowProgressBarValidationMsg(){
	jQuery('.progress_bar_error_msg_div').remove();
	var progress_bar_error_msg = '';
	var progress_bar_var1 = jQuery("input[name='progress_bar']").prop('checked');
	var enable_branching_var1 = jQuery("input[name='enable_branching']").prop('checked');
	if(progress_bar_var1 && enable_branching_var1){
		progress_bar_error_msg = '<div class="question_error_msg" ><b style="font-size: 22px;font-weight: 600;">Please note:</b> We notice that you\'ve enabled the progress bar for this quiz. </div><div class=" question_validations"><div class="ques_title">Progress won\'t be displayed as you have enabled branching logic in the SQB >> Quiz Funnels page.<br/>In a quiz where branching logic is enabled, progress bar is not displayed because SQB won\'t know how many questions the users will see beforehand. The number of questions they see depends on the path they take in the branching-logic activated funnel.</div></div>';
		jQuery(".quiz-actions").before('<div class="question_error_msg_outer progress_bar_error_msg_div" style="margin-top: 10px;">'+progress_bar_error_msg+'</div>');
		jQuery('html, body').animate({
	        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
	    }, 2000);	
	}
}

function sqbShowFunnelWithPaginationValidationMsg(){
	jQuery('.funnel_pagination_error_msg_div').remove();
	var funnel_pagination_error_msg = '';
	var quiz_pagination = jQuery('input[name="quiz_pagination"][value="all"]').prop('checked');
	var enable_branching_var1 = jQuery("input[name='enable_branching']").prop('checked');
	if(quiz_pagination && enable_branching_var1){
		funnel_pagination_error_msg = '<div class="question_validations"><div class="ques_title"> As you have selected "All questions on the same page" option in the display settings, branching logic won\'t work in this type of setting. Please switch to the one question per page option in the display settings tab.</div></div>';
		jQuery(".quiz-actions").before('<div class="question_error_msg_outer funnel_pagination_error_msg_div" style="margin-top: 10px;">'+funnel_pagination_error_msg+'</div>');
		jQuery('html, body').animate({
	        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
	    }, 2000);	
	}
}

function sqbShowskipbuttonValidationMsg(){
	jQuery('.skip_button_error_msg_div').remove();
	var skip_button_error_msg = '';
	var skip_button_var1 = '';
	var select_temp = jQuery('input[name="select_temp"]:checked').val();


	if(jQuery('.ques_ans_contain .sqb_questions_wrapper .sqb_question_no').length > 0){
		jQuery('.ques_ans_contain .sqb_questions_wrapper .sqb_question_no').each(function(index_question){
			if(select_temp == 'template7'){
				var allow_skip_ques = jQuery(this).find('.question_div_outer .template7-skip-question-button').find('input[name="skipquestion"]').prop('checked');	
				if(allow_skip_ques == true){
			        skip_button_var1 = '1';
			        return false;
			    }else{
			    	skip_button_var1 = '0';
			    }			
			}else if(select_temp == 'template8'){
				if(jQuery(this).find('.skip_continue_button_wrapper .skip-question-action').css('display') == 'block'){
			        skip_button_var1 = '1';
			        return false;
			    }else{
			    	skip_button_var1 = '0';
			    }			
			} else {
				if(jQuery(this).find('input[name="allow_skip_ques"]').prop('checked') == true){
			        skip_button_var1 = '1';
			        return false;
			    }else{
			    	skip_button_var1 = '0';
		  	  }
			}
		});
	}
	
	var enable_branching_var1 = jQuery("input[name='enable_branching']").prop('checked');
	if((skip_button_var1 ==1) && enable_branching_var1){
		if(select_temp == 'template8'){
			jQuery('input[name="allow_skip_ques"]').prop('checked', false);
			jQuery('.skip-question-action').hide();
		}else if(select_temp == 'template7'){
			jQuery('input[name="skipquestion"]').prop('checked', false);
		}else{
			jQuery('input[name="allow_skip_ques"]').prop('checked', false);
		}
		skip_button_error_msg = '<div class="question_error_msg" ><b style="font-size: 22px;font-weight: 600;">Please note:</b> We notice you have enabled "skip question" </div><div class=" question_validations"><div class="ques_title">Sorry, can\'t enable skip button as  branching (quiz funnel) is enabled for this quiz.</div></div>';
		jQuery(".quiz-actions").before('<div class="question_error_msg_outer skip_button_error_msg_div" style="margin-top: 10px;">'+skip_button_error_msg+'</div>');
		jQuery('html, body').animate({
	        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
	    }, 2000);	
	}
}

function sqbShowReorderQuestionsFunnelValidationMsg(){
	jQuery('.reorder_questions_funnel_error_msg_div').remove();
	var rqf_error_msg = '';
	var enable_branching = jQuery('input[name="enable_branching"]').prop('checked');
	var enable_re_arrange_question = false;
	if(jQuery('.reorder_questions_btn.sqb_rearrange_question').hasClass('sqb_rearrange_question_trigger')){
		enable_re_arrange_question = true;
	}
	if(enable_branching && enable_re_arrange_question){
		rqf_error_msg = '<div class="question_error_msg" ><b style="font-size: 22px;font-weight: 600;">Please note: </b>Make sure to update your Funnel Settings / Branching Logic as you have re-ordered the questions. </div></div>';
		jQuery(".quiz-actions").before('<div class="question_error_msg_outer reorder_questions_funnel_error_msg_div" style="margin-top: 10px;">'+rqf_error_msg+'</div>');
		jQuery('html, body').animate({
	        scrollTop: jQuery("#Quiz-Settings-TabContent .active .question_error_msg_outer").offset().top
	    }, 2000);	
	}
}


function sqbShowProgressBarValidationMsgEvent(){
	jQuery(document).on('click',"input[name='progress_bar']",function(){
		if(jQuery(this).prop('checked')){
		}else{
			jQuery('.progress_bar_error_msg_div').hide();
		}
	});
	jQuery(document).on('click',"input[name='enable_branching']",function(){
		if(jQuery(this).prop('checked')){
			var skip_button_var1 = '';
			var select_temp = jQuery('input[name="select_temp"]:checked').val();
			var quiz_pagination = jQuery('input[name="quiz_pagination"]:checked').val();
			if(quiz_pagination == "fixed_number" || quiz_pagination == "all" || quiz_pagination == "question_on_category"){
				swal({
						title: "Please note: You have enabled pagniation in this quiz. The pagination option won't work if quiz funnel is enabled. SQB will use the 1 question per page setting if branching is enabled.",
						text: "",
						showCancelButton: true,
						showCloseButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "OK!",
						customClass: '',
						}).then((result) => {
								if (result.value) {
								}else{
									jQuery('input[name="enable_branching"]').prop('checked', false);
								}
							});
						
			}

			if(jQuery('.ques_ans_contain .sqb_questions_wrapper .sqb_question_no').length > 0){
				jQuery('.ques_ans_contain .sqb_questions_wrapper .sqb_question_no').each(function(index_question){
					if(select_temp == 'template7'){
						var allow_skip_ques = jQuery(this).find('.question_div_outer .template7-skip-question-button').find('input[name="skipquestion"]').prop('checked');	
						if(allow_skip_ques == true){
					        skip_button_var1 = '1';
					        return false;
					    }else{
					    	skip_button_var1 = '0';
					    }			
					}else if(select_temp == 'template8'){
						if(jQuery(this).find('.skip_continue_button_wrapper .skip-question-action').css('display') == 'block'){
					        skip_button_var1 = '1';
					        return false;
					    }else{
					    	skip_button_var1 = '0';
					    }			
					} else {
						if(jQuery(this).find('input[name="allow_skip_ques"]').prop('checked') == true){
					        skip_button_var1 = '1';
					        return false;
					    }else{
					    	skip_button_var1 = '0';
				  	  }
					}
				});
				if(skip_button_var1 == 1){
					swal({
						title: "Please note: You have added skip button for some questions. The skip button won't show as you have enabled branching logic.",
						text: "",
						showCancelButton: true,
						showCloseButton: true,
						confirmButtonColor: "#DD6B55",
						confirmButtonText: "OK!",
						customClass: '',
						}).then((result) => {
								if (result.value) {
								}else{
									jQuery('input[name="enable_branching"]').prop('checked', false);
								}
							});
						}
			}
		}else{
			jQuery('.progress_bar_error_msg_div').hide();
		}
	})
	
}


function callSaveQuestionAnswers(form_data, timeout, next_tab, error,tab_id){
	setTimeout(function() {
		SQBShowLoader();
		jQuery.post(ajaxurl, {
		action: 'sqb_save_quiz',
		security: SQBSaveQuiz.sqbsavequiz,
		form_data: form_data,   
		async:false,
		}, function(response) {
			 
			SQBHideLoader();
			//save_outcome_data();
			response = JSON.parse(response);
			if(typeof response.error != 'undefined' && response.error != ''){
				swal("" , response.error, "");jQuery(".quiz-save-btn-msg").remove();return false;
			}else{
				if(next_tab != 'next' && error == ''){
					if(jQuery('.tab-pane').find('.quiz-save-btn-msg').length == 0){
						jQuery('<div class="saved_data_msg quiz-save-btn-msg">Saved Sucessfully!</div>').insertBefore('.quiz-actions');
					}
					
					setTimeout(function() {
					jQuery(".quiz-save-btn-msg").remove();
					}, 3000);
					
				}
			}

			if(response.new_questions_ids_array){
				jQuery(".question-list").empty();
				var count = 1;
				jQuery.each(response.new_questions_ids_array, function (key, value) {
					jQuery(".question-list").append('<a class="dropdown-item" href="javascript:void(0)" data-value="'+value+'">QUESTION '+count+'</a>');
					count++;
				});
			}

			if(response.question_ans_bank_ids_array){
				jQuery.each( response.question_bank_ids_array, function(question_wrapper_id, question_id){
					// add questions id
					jQuery('#'+question_wrapper_id).find('.sqb_question_enable_drag_drop').attr('data-id',question_id);
					if(response.question_ans_bank_ids_array[question_id]){
						var ans_array = response.question_ans_bank_ids_array[question_id];
						jQuery.each( ans_array, function(answer_wrapper_id, ans_id){
							// add answer id
							jQuery('#'+answer_wrapper_id).attr('data-id',ans_id);
						});
					}

					if(response.outcome_mapping_id_array[question_id]){
						var outcome_array = response.outcome_mapping_id_array[question_id];

						jQuery.each( outcome_array, function(key, ans_ids){
							jQuery.each( ans_ids, function(outcome_wrapper_id, outcome_id){
								// add outcome id
							
								jQuery('#'+outcome_wrapper_id).attr('data-id',outcome_id);
								jQuery('#'+outcome_wrapper_id).attr('data-answer-id',key);
							});

						});
					}

				});
			}
		//}
		var matrix_table = jQuery('.sqb_question_no.active').find('.answer_matrix_save_table').html();
			
		jQuery('.answer_matrix_options_wrapper .SQB-table-wrap').html(matrix_table);

		if(tab_id == 'Formula-Screen'){
		setTimeout(function(){ jQuery('#Formula-Screen-tab').trigger('click'); }, 100);
		}
		});
	}, timeout);	
}

function sqb_save_global_settings_popup(){
	var temp_name = jQuery('input[name="select_temp"]:checked').val();
	if(jQuery('input[name="quiz_display"]:checked').val() == 'corner_popup'){
		if(jQuery('#edit_mode').val() == 'N'){
			if(jQuery('#Start-Screen-Settings').hasClass('active')){
				jQuery('#edit_mode').val('Y');
			}
		}
		var edit_id = jQuery('#edit_id').val();
		var start_template = jQuery('#start_template').val();
		if(start_template == 'N' && temp_name != 'template4'){
			if(jQuery('#Start-Screen-Settings').hasClass('active')){
				jQuery('#global_template_setting').modal('show');
				jQuery('#start_template').val('Y');
			}	
		}
	}
}


function save_email_notifications(){
	var quiz_notification = '';
	var quiz_id = jQuery('#edit_id').val();
	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
	var email_notification = jQuery('input[name=email_notification_settings]:checked').val();
		
	if(jQuery('#notification_admin_email').prop('checked') == true){
		var notification_type = 'admin_email';
		var notification_send_email = 'Y';
		var notification_from_name = jQuery('#admin_notification_from_name').val();
		var notification_from_email = jQuery('#admin_notification_from_email').val();
		var notification_email_subject = jQuery('#admin_notification_email_subject').val();
		var notification_email_body = tinymce.get('admin_notification_email_body').getContent();
		var notification_answer_format = tinymce.get('notification_answer_format').getContent();
		var quiz_settings = 'global';
		var form_data = {
			quiz_id: quiz_id,
			notification_from_name: notification_from_name,
			notification_from_email: notification_from_email,
			notification_email_subject: notification_email_subject,
			notification_email_body: notification_email_body,
			notification_answer_format: notification_answer_format,
			notification_type: notification_type,
			notification_send_email: notification_send_email,
			quiz_settings: quiz_settings,
			quiz_type: 'admin_email',
		}	
		
		SQBShowLoader();
		jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_notification',
				security: SQBSaveQuiz.sqbSaveQuizNotification,
				form_data: form_data,
		}, function(response) {		 
					  
		});
	}else{
		var notification_type = 'admin_email';
		var notification_send_email = 'N';
		var notification_from_name = jQuery('#admin_notification_from_name').val();
		var notification_from_email = jQuery('#admin_notification_from_email').val();
		var notification_email_subject = jQuery('#admin_notification_email_subject').val();
		var notification_email_body = tinymce.get('admin_notification_email_body').getContent();
		var notification_answer_format = tinymce.get('notification_answer_format').getContent();
		var quiz_settings = 'global';

		var form_data = {
			notification_from_name: notification_from_name,
			notification_from_email: notification_from_email,
			notification_email_subject: notification_email_subject,
			notification_email_body: notification_email_body ,
			notification_answer_format: notification_answer_format ,
			notification_type: notification_type ,
			notification_send_email: notification_send_email ,
			quiz_settings: quiz_settings ,
			quiz_type: '' ,
		}	
		jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_notification',
				security: SQBSaveQuiz.sqbSaveQuizNotification,
				form_data: form_data,   
		}, function(response) {			  
		});
	}


	if(jQuery('#notification_send_email').prop('checked') == true){
		if(quiz_type != '' && quiz_id != ''){
			var notification_type = 'student_email';
			var notification_from_name = jQuery('#from_name').val();
			var notification_from_email = jQuery('#from_email').val();
			var notification_email_subject = jQuery('#email_subject').val();
			var notification_email_body = tinymce.get('email_body').getContent();
			var notification_answer_format = tinymce.get('notification_answer_format').getContent();
			var email_ids = jQuery('#email_ids').val();
			var copy_email_subject = jQuery('#copy_email_subject').val();
			var outcome_id = jQuery( ".studet_email_settings .outcome-count option:selected" ).val();
			var question_text = jQuery('#question_translate_text').val();
			var answer_text = jQuery('#answer_translate_text').val();
			var translate_text = question_text+'|'+answer_text;
			var notification_send_email = 'Y';
			
		}
		if(jQuery('#copy_admin_email_address').prop('checked') == true){
			var notification_send_copy = 'Y';
		}else{
			var notification_send_copy = 'N';
		}

		var quiz_email_notification = jQuery('input[name="quiz_email_notification"]:checked').val();
		if(quiz_email_notification == 'global-email'){
			quiz_notification = '2';
			var quiz_settings = 'global';
			var form_data = {
				quiz_id: quiz_id,
				notification_from_name: notification_from_name,
				notification_from_email: notification_from_email,
				notification_email_subject: notification_email_subject,
				notification_email_body: notification_email_body,
				notification_answer_format: notification_answer_format,
				notification_type: notification_type,
				notification_send_email: notification_send_email,
				quiz_settings: quiz_settings,
				email_ids: email_ids,
				copy_email_subject: copy_email_subject,
				translate_text: translate_text,
				notification_send_copy: notification_send_copy,
				quiz_type: quiz_type,
			}	
		}else if(quiz_email_notification == 'quiz-email'){
			var quiz_notification = '1';
			var quiz_settings = 'quiz_level';
			var form_data = {
				quiz_id:quiz_id,
				notification_from_name: notification_from_name,
				notification_from_email: notification_from_email,
				notification_email_subject: notification_email_subject,
				notification_email_body: notification_email_body,
				notification_answer_format: notification_answer_format,
				notification_type: notification_type,
				notification_send_email: notification_send_email,
				quiz_settings: quiz_settings,
				email_ids: email_ids,
				copy_email_subject: copy_email_subject,
				translate_text: translate_text,
				notification_send_copy: notification_send_copy,
				quiz_type: quiz_type,
			}	
		}else if(quiz_email_notification == 'outcome-level'){
			var quiz_settings = 'outcome';
			var quiz_notification = '4';
			var form_data = {
				quiz_id:quiz_id,
				notification_from_name: notification_from_name,
				notification_from_email: notification_from_email,
				notification_email_subject: notification_email_subject,
				notification_email_body: notification_email_body,
				notification_answer_format: notification_answer_format,
				notification_type: notification_type,
				notification_send_email: notification_send_email,
				quiz_settings: quiz_settings,
				email_ids: email_ids,
				copy_email_subject: copy_email_subject,
				translate_text: translate_text,
				notification_send_copy: notification_send_copy,
				quiz_type: quiz_type,
				outcome_id: outcome_id,
			}	
		}		


		if(jQuery('#notification_admin_email').prop('checked') == true){
			var admin_from_email = jQuery('#admin_notification_from_email').val();
			var admin_email_subject = jQuery('#admin_notification_email_subject').val();
			var admin_email_body = tinymce.get('admin_notification_email_body').getContent();
		}

		jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_notification',
				security: SQBSaveQuiz.sqbSaveQuizNotification,
				form_data: form_data,
				admin_from_email: admin_from_email,
				admin_email_subject: admin_email_subject,
				admin_email_body: admin_email_body,
		}, function(response) {			  
		
		});

	}else{
		if(quiz_type != '' && quiz_id != ''){
			var notification_type = 'student_email';
			var notification_from_name = jQuery('#from_name').val();
			var notification_from_email = jQuery('#from_email').val();
			var notification_email_subject = jQuery('#email_subject').val();
			var notification_email_body = tinymce.get('email_body').getContent();
			var notification_answer_format = tinymce.get('notification_answer_format').getContent();
			var email_ids = jQuery('#email_ids').val();
			var copy_email_subject = jQuery('#copy_email_subject').val();
			var outcome_id = jQuery( ".studet_email_settings .outcome-count option:selected" ).val();
			var question_text = jQuery('#question_translate_text').val();
			var answer_text = jQuery('#answer_translate_text').val();
			var translate_text = question_text+'|'+answer_text;			
		}
		var quiz_settings = 'global';
		var form_data = {
			notification_from_name: notification_from_name,
			notification_from_email: notification_from_email,
			notification_email_subject: notification_email_subject,
			notification_email_body: notification_email_body,
			notification_answer_format: notification_answer_format,
			notification_type: notification_type,
			notification_send_email: 'N',
			quiz_settings: quiz_settings,
			email_ids: email_ids,
			copy_email_subject: copy_email_subject,
			translate_text: translate_text,
			notification_send_copy: notification_send_copy,
			quiz_type: quiz_type,
			quiz_id: quiz_id,
		}	

		quiz_notification = '3';

		if(jQuery('#notification_admin_email').prop('checked') == true){
			var admin_from_email = jQuery('#admin_notification_from_email').val();
			var admin_email_subject = jQuery('#admin_notification_email_subject').val();
			var admin_email_body = tinymce.get('admin_notification_email_body').getContent();
		}


		jQuery.post(ajaxurl, {
				action: 'sqb_save_quiz_notification',
				security: SQBSaveQuiz.sqbSaveQuizNotification,
				form_data: form_data,   
				admin_from_email: admin_from_email,
				admin_email_subject: admin_email_subject,
				admin_email_body: admin_email_body,
		}, function(response) {			  
		
		});
	}
	

	if(jQuery('#notification_admin_email').prop('checked') == true){
		var admin_email = 'Y';
	}else{
		var admin_email = 'N';
	}

	if(jQuery('#copy_admin_email_address').prop('checked') == true){
		var send_copy = 'Y';
	}else{
		var send_copy = 'N';
	}


	jQuery.post(ajaxurl, {
			action: 'sqb_quiz_update_email_notification',
			security: SQBSaveQuiz.sqbUpdateEmailNotification,
			quiz_id: quiz_id,  
			admin_email: admin_email,  
			send_copy: send_copy,  
			quiz_notification: quiz_notification, 
	}, function(response) {		 
		sqb_hide_loader();
	});
}

function SQB_IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}

function sqb_save_quiz(tab_id,next_tab = 'no',current_tab_name = '', static_action = ''){
		
	if(jQuery('input[name="select_temp"]:checked').val() == 'template8'){
		template8_background_color_customizer();
	}
	jQuery('.back-question-action').find( "[id^='mce_']" ).each(function(){
	    jQuery(this).removeAttr('id');
	});
	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();

	if(jQuery('.questions_tab .nav-link').hasClass('active') && jQuery('#show_share_screen').prop('checked') == true){
		sqb_social_share_check_row_exists_lead_generation();
	}

	jQuery('.sqb_closed_global_customizer_opiton').trigger('click');


	var show_results = jQuery('input[type="radio"][name="show_results"]:checked').val();
	if(quiz_type == 'poll' && show_results == 'redirect-to-outcome' && jQuery('.left_side_outcome_list ul li').length == 0){
		swal('','Please create an outcome.','');
		return false;
	}

	var quiz_pagination = jQuery('input[type="radio"][name="quiz_pagination"]:checked').val();
	var question_pagination_count = jQuery('#question_pagination_count').val();
	if(quiz_pagination == 'fixed_number' && question_pagination_count == ""){
		swal('','Please enter number.','');
		jQuery('html, body').animate({
		        scrollTop: jQuery(".quiz_pagination_outer").offset().top
		    }, 1000);
		return false;
	}

	if(jQuery('#quiz_allow_certificate').prop('checked') == true){
		if(jQuery('#select_certificate').val() == "Please select"){
			swal('','Please select Certificate','');
			jQuery('select#select_certificate').css('border', '1px solid #ff000063');
		 	jQuery('html, body').animate({
		        scrollTop: jQuery(".download-certificate-child").offset().top
		    }, 1000);
			return false;		
		}
	}else{
		jQuery('select#select_certificate').css('border', '1px solid #ddd');
	}

	jQuery('grammarly-extension').remove();

	if(jQuery('#quiz_category_enable').prop('checked') == true && quiz_type == 'scoring'){
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if (selected_template == 'template1' || selected_template == 'template2' || selected_template == "template3" || selected_template == 'template4' || selected_template == 'template5' || selected_template == 'template7') {
		    var unassignedQuestions = [];
		    jQuery('.sqb_questions_wrapper .sqb_question_no').each(function (index) {
		        var category_id = jQuery(this).find('.question_drop_down_wrapper .quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
		        if (category_id == '') {
		            var questionNumber = 'Question ' + (index + 1); // Prefix with "Question"
		            unassignedQuestions.push(questionNumber);
		        }
		    });
		    if (unassignedQuestions.length > 0) {
		        swal('We noticed that these questions do not have any categories assigned: ' + unassignedQuestions.join(', ') + '. Please assign a category.');
		        //return false;
		    }
		} else {
		    var unassignedQuestions = [];
		    jQuery('.sqb_questions_wrapper .sqb_question_no').each(function (index) {
		        var category_id = jQuery(this).find('.quiz_category_type_wrapper .dropdown-toggle').attr('data-value');
		        if (category_id == '') {
		            var questionNumber = 'Question ' + (index + 1); // Prefix with "Question"
		            unassignedQuestions.push(questionNumber);
		        }
		    });
		    if (unassignedQuestions.length > 0) {
		        swal('We noticed that these questions do not have any categories assigned: ' + unassignedQuestions.join(', ') + '. Please assign a category.');
		        //return false;
		    }
		}
	}
	
	

	if(tab_id == 'Result-Screen-Settings' || current_tab_name == 'outcome_tab'){
		var quiz_id =jQuery('#edit_id').val(); 
		var quiz_type =jQuery('input[name="quiz_type"]:checked').val();
		var outcome_redirect="";
		var outcome_screen="";
		var range_validation_start = [];
		var range_validation_end = [];
		var outcomes_data = [];
		
	    var validate_outcome_status =  false;
		
	    var outcome_based = jQuery('input[name="outcome_based"]:checked').val();
	    var outcome_type = jQuery('input[name="outcome_type"]:checked').val();

		    
    	jQuery("."+quiz_type+"_outcome_div .quiz_result_inn .res_data_cont").each(function(index, val){	
		
		jQuery('.res_data_cont').find( "[id^='mce_']" ).each(function(){
			jQuery(this).removeAttr('id');
		});

		var outcome_index_no  = index;
		var flag = false;	
		var outcome_div_id = jQuery(this).attr("id"); 		
		var id = jQuery("#"+outcome_div_id+" #outcome_id").val();			 
		jQuery(".validation_cls").remove();
	
		var outcome_name = jQuery("#"+outcome_div_id+" .outcome_name").val();		 
		var number_val = jQuery("#"+outcome_div_id+" .number_val").val();
		var range_val = jQuery("#"+outcome_div_id+" .range_val_start").val(); 
		var range_val1 = jQuery("#"+outcome_div_id+" .range_val_end").val();
		var outcome_video_url = jQuery("#"+outcome_div_id+" .outcome_video_url").val();
		var outcome_show_video = jQuery("#"+outcome_div_id+" .outcome_show_video").val();
		var outcome_video_aspect = jQuery("#"+outcome_div_id+" .outcome_video_aspect").val();
		
		if(outcome_based == 'outcome' && outcome_type =='range'){
			if(outcome_index_no != 0){
				jQuery.each(range_validation_end, function (range_key, range_value){
					 if((parseInt(range_val) >= parseInt(range_validation_start[range_key])) && (parseInt(range_val) < parseInt(range_value))){
							var range_key_add_one = range_key +1;
							swal("Range is already defined for outcome "+range_key_add_one);
							jQuery('.left_side_outcome_list li').eq(outcome_index_no).find('a').trigger('click')
							flag = true;
							return false;
						
					}else{
					}
				});
			}
		}
	
		if(flag){
			return false;
		}
		   
		range_validation_end.push(range_val1);
		range_validation_start.push(range_val);
		var outcomehtml1 = jQuery("<div />").append(jQuery("#"+outcome_div_id+" .Quiz-Template").clone()).html();
		jQuery('.result_temp_hidden').html(outcomehtml1) ;
		jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-e').remove();
		jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-se').remove();
		jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-s').remove();
		var outcomehtml = jQuery('.result_temp_hidden').html();
		var get_classes =  jQuery(" .quiz_result_inn .Quiz-Template").attr("class");
		var get_style =  jQuery(" .quiz_result_inn .Quiz-Template").attr("style");
		
		var outcome_html = outcomehtml;
		if(outcome_name ==""){		 
			jQuery(this).find(" .outcome_name").after('<span class="validation_cls">Please Enter Outcome Title</span>');
			jQuery(this).find(" .outcome_name").focus();

			jQuery(".left_side_outcome_list .nav li a").removeClass("active show");
			jQuery(".left_side_outcome_list .nav li:eq("+index+") a").addClass("active show");
			
			jQuery(".quiz_result_inn .res_data_cont").hide();
			jQuery(".quiz_result_inn .res_data_cont").removeClass("active show");
			jQuery(".quiz_result_inn .res_data_cont").addClass("fade");
			
			jQuery(".quiz_result_inn .res_data_cont:eq("+index+")").show();
			jQuery(".quiz_result_inn .res_data_cont:eq("+index+")").removeClass("fade");
			jQuery(".quiz_result_inn .res_data_cont:eq("+index+")").addClass("active show");

			jQuery("html, body").animate({ scrollTop: 0 }, "slow");
			
			validate_outcome_status =  true;
			return false;
		}		
 	
 		var outcome_based = jQuery('input[name="outcome_based"]:checked').val();
		if(quiz_type=="assessment" || quiz_type=="scoring"){	
	  			if(outcome_based == 'category'){

	  			}else{
	  				if(jQuery('input[name="outcome_type"]:checked').val() == "correct_ans"){
						if(number_val ==""){
							jQuery(" .number_val").after('<span class="validation_cls">Please Enter Number</span>');
							jQuery(" .number_val").focus();
							validate_outcome_status =  true;
							return false;					 
						}	
					}else{
						 
						if(range_val ==""){
							jQuery(".range_val_start").after('<span class="validation_cls">Please Enter Start Range</span>');
							jQuery(".range_val_start").focus();
							validate_outcome_status =  true;
							return false;			 
						}		
						if(range_val1 ==""){
							jQuery(" .range_val_end").after('<span class="validation_cls">Please Enter End Range</span>');
							jQuery(" .range_val_end").focus();
							validate_outcome_status =  true;
							return false;					 
						}

						jQuery('.res_data_cont').each(function(){
							if(jQuery(this).hasClass('active')){

							}else{
								var currentStart = jQuery(this).find('.range_val_start').val();
								var currentEnd = jQuery(this).find('.range_val_end').val();
							}

						})
						
					}
	  			}
		}else{
			 
		}
	});
	    
		
		if(validate_outcome_status){
			return false;
		}

		save_outcome_data();	
		var i = 1;
		jQuery('.studet_email_settings .outcome-count').empty();


		jQuery.post(ajaxurl, {
			action: 'sqb_load_outcome_name',
			quiz_id: quiz_id,
		}, function(response) {
			response = JSON.parse(response);
			if(response.outcome_html){
				jQuery('.studet_email_settings .outcome-count').append(response.outcome_html);
			}
			
		});
	}else{
		if(jQuery('.result_template_html_preview_outer .card.res_data_cont').length >= 1){
			save_outcome_data();
		}
		if(tab_id == 'Start-Screen-Settings'){
			if(jQuery('input[name="quiz_display"]:checked').val() == 'popup'){
				jQuery('.sqb_edit_template').hide();
			}else{
				jQuery('.sqb_edit_template').show();
			}
		}
	}
	if(current_tab_name == 'quiz_notification'){

		/* Student Email */
		if(jQuery('#notification_send_email').prop('checked') == true){
			var from_name = jQuery('#from_name').val();
			if(from_name == ''){
				jQuery('.student-from-error-msg').show();
				jQuery('html, body').animate({
			        scrollTop: jQuery(".email-settings-customize").offset().top
			    }, 1000);
				return false;
			}else{
				jQuery('.student-from-error-msg').hide();
			}

			var get_emails = jQuery('#from_email').val();
			if(SQB_IsEmail(get_emails)==false){
				jQuery('.email-error-msg').show();
				jQuery('html, body').animate({
			        scrollTop: jQuery("#from_name").offset().top
			    }, 1000);
				return false;
			}
			
			var email_subject = jQuery('#email_subject').val();
			if(email_subject == ''){
				jQuery('.student-subject-error-msg').show();
				return false;
			}else{
				jQuery('.student-subject-error-msg').hide();
			}

		}

		
		/*Admin Email */
		if((jQuery('#notification_admin_email').prop('checked') == true) && (jQuery('#copy_admin_email_address').prop('checked') == false)){
			var admin_notification_from_emails = jQuery('#admin_notification_from_email').val();
			var admin_notification_from_emails = admin_notification_from_emails.replace(/ /g,'');
			var admin_notification_from_email = admin_notification_from_emails.split(',');
			var i;
			for (i = 0; i < admin_notification_from_email.length; ++i) {
				if(SQB_IsEmail(admin_notification_from_email[i])==false){
					jQuery('.admin-email-error-msg').show();
					jQuery('html, body').animate({
				        scrollTop: jQuery("#admin_notification_from_email").offset().top
			  	 	}, 1000);
					return false;
				}else{
					jQuery('.admin-email-error-msg').hide();
				}
			}

			var admin_notification_email_subject = jQuery('#admin_notification_email_subject').val();
			if(admin_notification_email_subject == ''){
				jQuery('.admin-subject-error-msg').show();
				return false;
			}else{
				jQuery('.admin-subject-error-msg').hide();
			}
		}

		/*Send Copy Email */
		if(jQuery('#copy_admin_email_address').prop('checked') == true){
			var copy_email_ids = jQuery('#email_ids').val();

			var copy_get_email_split = copy_email_ids.split(',');
			var i;
			for (i = 0; i < copy_get_email_split.length; ++i) {
				if(SQB_IsEmail(copy_get_email_split[i])==false){
					jQuery('.copy-email-error-msg').show();
					jQuery('html, body').animate({
				        scrollTop: jQuery("#email_ids").offset().top
				    }, 1000);
					return false;
				}
			}

			var copy_email_subject = jQuery('#copy_email_subject').val();
			if(copy_email_subject == ''){
				jQuery('.copy-admin-subject-error-msg').show();
				return false;
			}else{
				jQuery('.copy-admin-subject-error-msg').hide();
			}

			
		}	


		if(jQuery('.result_template_html_preview_outer .res_data_cont').length == 0 && jQuery('input[name=quiz_type]:checked').val() != 'poll'){
			jQuery('.scoring-outcome-empty-message').show();
		}else{
			jQuery('.scoring-outcome-empty-message').hide();
		}

		if(jQuery('.Question_temp_static_div .sqb_question_no').length == 0 && jQuery('input[name=quiz_type]:checked').val() != 'form'){
			jQuery('.scoring-question-empty-message').show();
		}else{
			jQuery('.scoring-question-empty-message').hide();
		}
	}

	if(quiz_type == 'poll'){
		var start_poll = jQuery('input[name="start_poll"]').val();
		if(jQuery('#poll_start_date').prop('checked') == true && start_poll == ''){
			swal('','Please Enter Start Poll Time','');
			return false;
		}
		var close_poll = jQuery('input[name="close_poll"]').val();
		if(jQuery('#close_specific_time').prop('checked') == true && close_poll == ''){
			swal('','Please Enter Close Poll Time','');
			return false;
		}
	}

	if(current_tab_name == 'outcome_tab'){
		var quiz_id = jQuery('#edit_id').val();
		sqb_check_category_rules(quiz_id);
	}

	

	jQuery('.outcome_pdf_next_temp_container').find( "[id^='mce_']" ).removeAttr('id');
	jQuery('.recommended_next_temp_container').find( "[id^='mce_']" ).removeAttr('id');
	jQuery('.ads_next_temp_container').find( "[id^='mce_']" ).removeAttr('id');

	if(quiz_type == 'form' || quiz_type == 'poll'){
		jQuery('.game-animation-admin-main').hide();
	}else{
		jQuery('.game-animation-admin-main').show();
	}

	if(quiz_type == 'form'){
		var time_based = jQuery('input[name="popup_type"]:checked').val();
		if(time_based == 'time_based'){
			var time_val = jQuery('.form-time-based-input').val();
			if(time_val == "" || time_val == 0){
				jQuery('.popup-error-msg-time').show();
				jQuery('html, body').animate({scrollTop: jQuery("#Basic-Screen-Settings").offset().top}, 2000);
				jQuery('.time-based-input');
				return false;
			}
		}else if(time_based == 'percentage_based'){
			var percent_val = jQuery('.form-percenatge-based-input').val();
			if(percent_val == "" || percent_val == 0){
				jQuery('.popup-error-msg-percentage').show();
				jQuery('html, body').animate({scrollTop: jQuery("#Basic-Screen-Settings").offset().top}, 2000);
				return false;
			}
		}
	}else{
		var time_based = jQuery('input[name="defaultpopup_type"]:checked').val();
		if(time_based == 'time_based'){
			var time_val = jQuery('.time-based-input').val();
			if(time_val == "" || time_val == 0){
				jQuery('.popup-error-msg-time').show();
				jQuery('html, body').animate({scrollTop: jQuery("#Basic-Screen-Settings").offset().top}, 2000);
				return false;
			}
		}else if(time_based == 'percentage_based'){
			var percent_val = jQuery('.percenatge-based-input').val();
			if(percent_val == "" || percent_val == 0){
				jQuery('.popup-error-msg-percentage').show();
				jQuery('html, body').animate({scrollTop: jQuery("#Basic-Screen-Settings").offset().top}, 2000);
				return false;
			}
		}
	}

	jQuery('.popup-error-msg-time').hide();
	jQuery('.popup-error-msg-percentage').hide();

	if(jQuery('.opt_screen_after_questions .nav-link').hasClass('active') && jQuery('#show_share_screen').prop('checked') == true){
		var quiz_id = jQuery('#edit_id').val();
		if(quiz_id == '' || quiz_id == 0){
			swal("","Please select a Quiz");
			return false;
		}
		
		var share_text = jQuery("#share_text").val();
		if(share_text	 == '' ){
			swal("","Enter Share Title");
			return false;
		}

		var fb_share_details =   jQuery('#fb_share_details').val();
		if(fb_share_details	 == '' ){
			swal("","Enter Facebook Details");
			return false;
		}
		var tw_share_details =  jQuery('#tw_share_details').val(); 
		if(tw_share_details	 == '' ){
			swal("","Enter Twitter Details");
			return false;
		}
		
		var share_image_value = jQuery('#share_image_value').val();
		
		if(share_image_value == ''){
			swal("","Please upload Image");
			return false;
		}
		
		var show_social_share_btn = jQuery('#show_social_share_btn').prop('checked');
		if(show_social_share_btn){
			show_social_share_btn = 1;
		}else{
			show_social_share_btn = 0;
		}
		
		var share_url = jQuery("#share_url").val();
		
		if(share_url == ''){
			swal("",'Please enter URL to be shared in the "SHARE" tab above.');
			return false;
		}

		if (share_url.indexOf("http://") == 0 || share_url.indexOf("https://") == 0) {
			swal("",'Please enter just the domain. For e.g.  test.com');
			return false;
		}
		
		var html = jQuery(".customize_social_share_wrapper_html").html();
		html  = encodeURIComponent(html);
		fb_share_details  = encodeURIComponent(fb_share_details);
		tw_share_details  = encodeURIComponent(tw_share_details);
		
		var social_share_fb_api_key = jQuery('#fb_api_key').val();
		if(social_share_fb_api_key == ''){
			swal("","We noticed that you have not entered a Facebook App ID in the settings page.","");
			jQuery("#fb_api_key").focus();	
			return false;
		}
		var share_image_value_extension = share_image_value.substring(share_image_value.lastIndexOf('.') + 1); 
		if(share_image_value_extension == 'gif'){
			swal("","Sorry, can't share gifs. Please upload a different image","");
			return false;
		}
		sqb_save_social_share_from_lead_screen();
	}

	if(current_tab_name == 'formula_tab'){
		sqb_list_formula_shortcodes();
		var formula_text = jQuery('#Formula-Screen #name_formula').val();
		if(formula_text != ''){
		swal("","Please click on Save Formula to save the formula","");
		return false;
		}
	}
	
	if(jQuery('.skip_optin').css('display') == 'none')
	{
		jQuery('#skipOptIn').prop('checked' , false);
	}else{
		jQuery('#skipOptIn').prop('checked' , true);
	}
	
	sqb_save_global_settings_popup();
	if(jQuery('input[name="select_temp"]:checked').val() == 'template5'){
		sqb_check_if_template5_selected(tab_id);
	} else {
		jQuery('.Template5_customizer').hide();
		jQuery('.Template5_customizer.sqb_common_customizer').show();
		jQuery('.template5_message').hide();
	}
	// return false;
	showHideOutcomesPersonalizeSection();
	sqb_remove_optin_remove_class();
	
	if(sqb_create_quiz_basic_tab_validation()){
		current_tab_id = 'Basic-Settings';
		sqb_next_tab(current_tab_id);
		return false;
	}
   	
   	if(tab_id != 'Basic-Settings'){
		if(sqb_create_quiz_display_tab_validation()){
			current_tab_id = 'Basic-Screen-Settings';
			sqb_next_tab(current_tab_id);
			return false;
				
		}
	}

	if(tab_id == 'Result-Screen-Settings' || current_tab_name == 'outcome_tab'){
		if(jQuery('.result_template_html_preview_outer .res_data_cont').length == 0 && jQuery('input[name=quiz_type]:checked').val() == 'personality'){
			validation_status = true;
			var msg = "You need to create at least one outcome / result";
			sqb_sweet_message('',msg,'');
			return false;
			
		}	else if(jQuery('.result_template_html_preview_outer .res_data_cont').length == 0 && jQuery('input[name=quiz_type]:checked').val() == 'poll' && jQuery('input[name="show_results"]').val() == 'redirect-to-outcome'){
			validation_status = true;
			var msg = "You need to create at least one outcome / result";
			sqb_sweet_message('',msg,'');
			
		}	

		var quiz_type =jQuery('input[name="quiz_type"]:checked').val();
		var validate_outcome_status =  false;
		jQuery("."+quiz_type+"_outcome_div .quiz_result_inn .res_data_cont").each(function(index, val){	
			var outcome_div_id = jQuery(this).attr("id"); 		
			var outcome_name = jQuery("#"+outcome_div_id+" .outcome_name").val();		
			if(outcome_name ==""){		 
				jQuery(this).find(" .outcome_name").after('<span class="validation_cls">Please Enter Outcome Title</span>');
				jQuery(this).find(" .outcome_name").focus();
				validate_outcome_status =  true;
				return false;
			}		
		});	
		if(validate_outcome_status){
			return false;
		}	
	}
	
	var quiz_name = jQuery('input[name="quiz_name"]').val();
	var quiz_desc = jQuery('textarea[name="quiz_desc"]').val();
	var quiz_type = jQuery('input[name="quiz_type"]:checked').val();

	if(jQuery('input[name="defaultpopup_type"]:checked').val() == 'popup'){
		var background_url = jQuery('.optin_template_html_preview_outer').css('background-image');
	}else{
		var background_url = jQuery('.start_temp_static_div').css('background-image');
	}

	if(background_url != undefined && background_url != 'none'){
		if(jQuery('input[name="select_temp"]:checked').val() == 'template7'){
			background_url = background_url.split(/[, ]+/).pop().replace('url(','').replace(')','').replace(/\"/gi, "");
		} else {
			background_url = background_url.replace('url(','').replace(')','').replace(/\"/gi, "");
		}			
	}else if(jQuery('.outcome-section').css('background-image') != 'none'){
		
		var background_url = jQuery('.outcome-section').css('background-image');
		if(typeof background_url == undefined || typeof background_url == "undefined"){
		} else {
			if(jQuery('input[name="select_temp"]:checked').val() == 'template7'){
				background_url = background_url.split(/[, ]+/).pop().replace('url(','').replace(')','').replace(/\"/gi, "");
			} else {
				background_url = background_url.replace('url(','').replace(')','').replace(/\"/gi, "");
			}
		}
	}
	var get_selected_width = jQuery('.start_screen_background_customizer .select-background-width-option').find(':selected').val();
	if(get_selected_width == 'px'){
		var background_width = jQuery('#Start-Screen-Settings input[name=select_background_width]').val();
		background_width = background_width;
		var width_sign = 'px';
	}else if(get_selected_width == 'percentage'){
		var background_width = jQuery('#Start-Screen-Settings input[name=background_width_percentage]').val();
		background_width = background_width;
		var width_sign = '%';
	}

	var get_selected_height = jQuery('.select-background-height').find(':selected').val();
	if(get_selected_height == 'px'){
		var background_height = jQuery('input[name=select_background_height]').val();
		background_height = background_height;
		var height_sign = 'px';
	}else if(get_selected_height == 'vh'){
		var background_height = jQuery('input[name=select_background_height_vh]').val();
		background_height = background_height;
		var min_height = jQuery('.optin_template_html_preview_outer').css('min-height');
		var height_sign = 'vh';
	}

	var answer_hover_color = jQuery('#ques_temp_ans_hover_color_select').val();
	if(answer_hover_color){
		answer_hover_color = sqbrgba2hex(answer_hover_color);
		if(answer_hover_color == '#aNaNaN'){
			var answer_hover_color = jQuery('#ques_temp_ans_hover_color_select').val();
		}
	}
	

	var answer_hover_text_color = jQuery('#ques_temp_ans_hover_text_color_select').val();
	if(answer_hover_text_color){
		answer_hover_text_color = sqbrgba2hex(answer_hover_text_color);
		if(answer_hover_text_color == '#aNaNaN'){
			var answer_hover_text_color = jQuery('#ques_temp_ans_hover_text_color_select').val();
		}
	}
	

	var template6_answer_border_color = jQuery('#template6_answer_border_color_select').val();
	if(template6_answer_border_color){
		template6_answer_border_color = sqbrgba2hex(template6_answer_border_color);
		if(template6_answer_border_color == '#aNaNaN'){
			var template6_answer_border_color = jQuery('#template6_answer_border_color_select').val();
		}
	}
	

	var template6_answer_border_hover_color = jQuery('#template6_answer_border_hover_color_select').val();
	if(template6_answer_border_hover_color){
		template6_answer_border_hover_color = sqbrgba2hex(template6_answer_border_hover_color);
		if(template6_answer_border_hover_color == '#aNaNaN'){
			var template6_answer_border_hover_color = jQuery('#template6_answer_border_hover_color_select').val();
		}
	}
	
	var answer_hover_opacity = jQuery('#answer_hover_background').val();
	var bw_background_image_position = jQuery('.start_temp_static_div').css('background-position');
	if (jQuery(".outcome-screen-background-customizer").css('display') !== 'none'){
	var bw_background_color = jQuery('#start_temp_outer_backgroud_color_outcome').val();	
	} else {
	var bw_background_color = jQuery('#start_temp_outer_backgroud_color_bw_customizer').val();	
	}
	
	var inner_section_style = jQuery('#bg_imge_style_inner').val();
	var background_height_main = jQuery('#start_temp_static_div_id').css('min-height');
	background_height_main = parseInt(background_height_main);

	var input_padding_option_v2 = jQuery('.input_padding_option_v2').val();
	var template6_background_image_opacity = jQuery('.template6_background_image_opacity').val();
	var template6_answer_border_width = jQuery('#template6_answer_border_width').val();
	var template6_focus_mode = jQuery('.check_focus_mode').val();

	var selected_template = jQuery('input[name="select_temp"]:checked').val();
	if(selected_template == 'template9'){
		var focus_mode = jQuery('#template9_focus_mode').val();

		var selected_val = jQuery('.template9-start-screen-select-background-height_v2').val();
		if(selected_val == 'px'){
			var temp_height = jQuery('.template9-start-screen-select_background_height_v2').val();
		}else{
			var temp_height = jQuery('.template9-start-screen-select_background_height_vh_v2').val();
		}
		var temp_width = jQuery('.template9_start_screen_temp_width_input').val();


		
		var transparent_background_settings = {'focus_mode': focus_mode, 'selected_val': selected_val, 'temp_height': temp_height, 'temp_width': temp_width, 'template6_answer_border_width': template6_answer_border_width, 'template6_answer_border_hover_color': template6_answer_border_hover_color, 'template6_answer_border_color': template6_answer_border_color, 'answer_hover_color': answer_hover_color, 'answer_hover_text_color': answer_hover_text_color, 'answer_hover_opacity' : answer_hover_opacity};
	}else{

		if(selected_template == 'template6'){
			if(jQuery('input[name="sqb_global_ans_background_hover_color_enable"]').prop('checked') == true){
				answer_hover_color = jQuery('#sqb_global_ans_background_hover_color').val();
			}
			if(jQuery('input[name="sqb_global_ans_text_hover_color_enable"]').prop('checked') == true){
				answer_hover_text_color = jQuery('#sqb_global_ans_text_hover_color').val();
			}
			if(jQuery('input[name="sqb_global_ans_border_color_enable"]').prop('checked') == true){
				template6_answer_border_color = jQuery('#sqb_global_ans_border_color').val();
			}
			if(jQuery('input[name="sqb_global_ans_border_hover_color_enable"]').prop('checked') == true){
				template6_answer_border_hover_color = jQuery('#sqb_global_ans_border_hover_color').val();
			}
			if(jQuery('input[name="sqb_global_ans_border_width_enable"]').prop('checked') == true){
				template6_answer_border_width = jQuery('#sqb_global_answer_border_width').val();
			}
		}
		var transparent_background_settings = width_sign+'|'+background_width+'|'+height_sign+'|'+background_height+'|'+background_url+'|'+min_height+'|'+answer_hover_color+'|'+answer_hover_opacity+'|'+ bw_background_image_position+'|'+bw_background_color+'|'+inner_section_style+'|'+background_height_main+'|'+input_padding_option_v2+'|'+answer_hover_text_color+'|'+template6_background_image_opacity+'|'+template6_focus_mode+'|'+template6_answer_border_color+'|'+template6_answer_border_hover_color+'|'+template6_answer_border_width;

	}

	var color = jQuery('#ques_temp_ans_color').val();
	var get_opacity = jQuery('input[name="select_answer_background"]').val();
	if(color){
		var ans_background = 'rgba(' + parseInt(color.slice(-6,-4),16)
	    + ',' + parseInt(color.slice(-4,-2),16)
	    + ',' + parseInt(color.slice(-2),16)
	    +','+get_opacity+')';
	}
	

	var ans_text_color = jQuery('#ques_temp_ans_text_color').val();
	var customizer_styles = ans_background+'|'+ans_text_color;

	//Show quiz in a popup or in-page?
	var quiz_display = jQuery('input[name="quiz_display"]:checked').val();
	if(quiz_display == 'popup'){
		if(quiz_type == 'form'){
			quiz_display = jQuery('input[name="popup_type"]:checked').val();
			if(quiz_display == 'time_based'){
				var time_based_input = jQuery('.form-time-based-input').val();
			}else if(quiz_display == 'percentage_based'){
				var time_based_input = jQuery('.form-percenatge-based-input').val();
			}
		}else{
			quiz_display = jQuery('input[name="defaultpopup_type"]:checked').val();
			if(quiz_display == 'time_based'){
				var time_based_input = jQuery('.time-based-input').val();
			}else if(quiz_display == 'percentage_based'){
				var time_based_input = jQuery('.percenatge-based-input').val();
			}
		}
		
	}

	// How many questions to display
	var question_display = jQuery('input[name="question_display"]:checked').val();
	var number_of_question = jQuery('input[name="number_of_question"]').val();
    
    //quiz Pagination Options
	var quiz_pagination = jQuery('input[type="radio"][name="quiz_pagination"]:checked').val();
	var question_per_page = jQuery('#question_per_page').val(); 

	if(quiz_pagination == 'one_per_page'){
		question_per_page = 1;
	}else if(quiz_pagination == 'all'){
		question_per_page = 999;
	}
	
    var result_display_option = jQuery("select[name='result_display_option'] option:selected").val();
    var display_correctans_options = jQuery("select[name='display_correctans_options'] option:selected").val();
    var show_next_button = jQuery('input[name="show_next_button"]').prop('checked');
	if(show_next_button){
		show_next_button = 'Y';
	}else{
		show_next_button = 'N';
	} 

	var show_back_button = jQuery('input[name="show_back_button"]').prop('checked');
	if(show_back_button){
		show_back_button = 'Y';
		quiz_allow_certificate = 'Y';
		jQuery.post(ajaxurl, {
			action: 'sqb_optimized_js_css_option_save',
			sqb_optimized_js_css: quiz_allow_certificate,   
			}, function(response) {		 
		});
	}else{
		show_back_button = 'N';
	} 
	var back_btn_change = jQuery('input[name="back-button-change"]:checked').val();
	var show_back_btn_option = show_back_button+'|'+back_btn_change;


	var limit_questions_displayed = 'N';
	var limit_input = "";

	var select_quiz_bank = jQuery('input[name="select_quiz_bank"]').prop('checked');
	if(select_quiz_bank){
		select_quiz_bank = 'Y';
		var limit_questions_displayed = jQuery('input[name="limit_questions_displayed"]').prop('checked');
		if(limit_questions_displayed){
			limit_questions_displayed = 'Y';
		}
		var limit_input = jQuery('input[name="limit_input"]').val();

	}else{
		select_quiz_bank = 'N';
	} 

	var quiz_ans_tags = jQuery('input[name="quiz_ans_tags"]').prop('checked');
	if(quiz_ans_tags){
		quiz_ans_tags = 'Y';
	}else{
		quiz_ans_tags = 'N';
	} 

	

	

	var sqb_quiz_allow_retake = jQuery('input[name="allow_retake_quiz"]').prop('checked');
	if(sqb_quiz_allow_retake){
		sqb_quiz_allow_retake = 'Y';
	}else{
		sqb_quiz_allow_retake = 'N';
	}
	
	var sqb_quiz_many_attempts = jQuery('#sqb_retak_option').val();
	var sqb_quiz_max_attempts_limit = jQuery('#sqb_retak_max_attempt').val();
	
	if((sqb_quiz_allow_retake == 'Y') && (sqb_quiz_many_attempts == 'Limited') && ((sqb_quiz_max_attempts_limit == 0) || (sqb_quiz_max_attempts_limit == ''))){
		swal("","Enter Max Attempt Limit","");
		return false;
	}
    
    // Do you want to display start screen?
	var show_start_screen = jQuery('input[name="show_start_screen"]').prop('checked');
	if(show_start_screen){
		show_start_screen = 'Y';
	}else{
		show_start_screen = 'N';
	}
	
	// Do you want to display result screen?
    var show_result_screen = jQuery('input[name="show_result_screen"]').prop('checked');
	if(show_result_screen){
		show_result_screen = 'Y';
	}else{
		show_result_screen = 'N';
	}
	
	//Registration Screen
	var show_opt_screen = jQuery('#show_opt_screen').prop('checked');
	if(show_opt_screen){
		show_opt_screen = 'Y';
	}else{
		show_opt_screen = 'N';
	}

	var show_share_screen = jQuery('#show_share_screen').prop('checked');
	if(show_share_screen){
		show_share_screen = 'Y';
	}else{
		show_share_screen = 'N';
	}
	
	var weighted_score = 'N';
	if(quiz_type == 'personality'){
		if(jQuery("#quiz_scoring_enable_personality").prop('checked')){
			weighted_score = 'Y';
		}
	}

	var email_pdf_attachment = 'N';
	if(jQuery("#email_pdf_attachment").prop('checked')){
		email_pdf_attachment = 'Y';
	}
	
	var quiz_allow_certificate = 'N';
	if(jQuery("#quiz_allow_certificate").prop('checked')){
		quiz_allow_certificate = 'Y';

		 jQuery.post(ajaxurl, {
			action: 'sqb_optimized_js_css_option_save',
			sqb_optimized_js_css: quiz_allow_certificate,   
			}, function(response) {		 
			});

	}



	var quiz_allow_pdf_download_outcome_screen = 'N';
	if(jQuery("#quiz_allow_pdf_download_outcome_screen").prop('checked')){
		quiz_allow_pdf_download_outcome_screen = 'Y';
	}

	var game_animation = 'N';
	if(jQuery("#game_animation").prop('checked')){
		game_animation = 'Y';
	}

	var different_message_outcome = 'N';
	if(jQuery("#different_message_outcome").prop('checked')){
		different_message_outcome = 'Y';
	}
	
	var game_animation_template = jQuery('input[name="game_animation_template"]:checked').val();
	var game_animation_custom_template = jQuery('#game_animation_custom_template').val();

	var game_animation_background_color = jQuery('#game_animation_background_color').val();
	var game_animation_audio_url = jQuery('#game_animation_audio_url').val();
	var game_animation_timer = jQuery('#game_animation_timer').val();
	var game_animation_text = tinymce.get("game_animation_text").getContent();
	var opt_screen_position = jQuery("[name='optin-screen-position']:checked").val();

	var autosubmit_optin = jQuery('#autoSubmitOptIn').prop('checked');
	if(autosubmit_optin){
		autosubmit_optin = 'Y';
	}else{
		autosubmit_optin = 'N';
	}


	var user_opt_in_redirect = jQuery('#user_opt_in_redirect option:selected').val();
	var user_opt_in_redirect_url = jQuery("#user_opt_in_redirect_url").val();
   
   // Where should the users be added?
   	var user_added_platform = [];
	jQuery('input[name="add_user_quiz"]:checked').each(function(){
		user_added_platform.push(jQuery(this).val());
	});
	
	var add_user_in_your_email_platform = [];
	jQuery('input[name="add_user_in_your_email_platform"]:checked').each(function(){
		add_user_in_your_email_platform.push(jQuery(this).val());
	});
	// Select Order:
	 var template_display_sequence = [];
	jQuery('#sortable_screen li').each(function() {
		  template_display_sequence.push(jQuery(this).attr('id'));
	});
	
	// start tab
	var selected_template = jQuery('input[name="select_temp"]:checked').val();

	var start_lead_customizer_styles = "";

	var start_template_no = jQuery('input[name="starttemplate"]:checked').val();
	if(selected_template == 'template9'){
		if(start_template_no == 'template2'){
			var start_temp_html1 = jQuery('.start_temp_static_div .start_temp_container').find('.Start-Screen-Quiz-Template9-right-side').html(); 
		}else{
			var start_temp_html1 = jQuery('.start_temp_static_div .start_temp_container').html(); 
		}
		
		var temp_layout = "sqb-template-bg-full-width";
		var image_url = "";
		var start_splash_image = "";
		if(jQuery('.template9_start_temp_outer').hasClass('sqb-template-bg-full-width')){
			temp_layout = 'sqb-template-bg-full-width';
		}else if(jQuery('.template9_start_temp_outer').hasClass('sqb-template-bg-image-left')){
			temp_layout = 'sqb-template-bg-image-left';

		}else if(jQuery('.template9_start_temp_outer').hasClass('sqb-template-bg-image-right')){
			temp_layout = 'sqb-template-bg-image-right';
		}else if(jQuery('.template9_start_temp_outer').hasClass('sqb-template-bg-video-left')){
			temp_layout = 'sqb-template-bg-video-left';
			var start_video_play_btn_color = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_play_btn_color"]').val();
			var start_video_controls = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_controls"]').val();
			var start_video_source = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_source"]').val();
			var start_splash_image = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="splash_image"]').val();
			var start_video_caption = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_caption"]').val();
			if(start_video_source == "embed" || start_video_source == "shortcode"){
				var start_video_url = jQuery('.Start-Screen-Quiz-Template9-left-side .video_html').html();
			}else{
				var start_video_url = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_id"]').val();
			}
		}else if(jQuery('.template9_start_temp_outer').hasClass('sqb-template-bg-video-right')){
			temp_layout = 'sqb-template-bg-video-right';
			var start_video_play_btn_color = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_play_btn_color"]').val();
			var start_video_controls = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_controls"]').val();
			var start_splash_image = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="splash_image"]').val();
			var start_video_source = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_source"]').val();
			var start_video_caption = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_caption"]').val();
			if(start_video_source == "embed" || start_video_source == "shortcode"){
				var start_video_url = jQuery('.Start-Screen-Quiz-Template9-left-side .video_html').html();
			}else{
				var start_video_url = jQuery('.Start-Screen-Quiz-Template9-left-side input[name="video_id"]').val();
			}
		}
		start_image_url = jQuery('.Start-Screen-Quiz-Template9-left-side').css('background-image');
		if(start_image_url && start_image_url != 'none'){
			start_image_url = start_image_url.replace('url(','').replace(')','').replace(/\"/gi, "");
		}else{
			start_image_url = "";
		}

		var start_background_color = jQuery('.template9_start_temp_outer').css('background-color');




		var optin_temp_html1 = jQuery('.optin_temp_static_div .optin_template_html_preview_outer').find('.lead-Screen-Quiz-Template9-right-side').html();
		
		var lead_temp_layout = "sqb-template-bg-full-width";
		var image_url = "";
		var lead_splash_image = "";
		if(jQuery('.template9_lead_temp_outer').hasClass('sqb-template-bg-full-width')){
			lead_temp_layout = 'sqb-template-bg-full-width';
		}else if(jQuery('.template9_lead_temp_outer').hasClass('sqb-template-bg-image-left')){
			lead_temp_layout = 'sqb-template-bg-image-left';

		}else if(jQuery('.template9_lead_temp_outer').hasClass('sqb-template-bg-image-right')){
			lead_temp_layout = 'sqb-template-bg-image-right';
		}else if(jQuery('.template9_lead_temp_outer').hasClass('sqb-template-bg-video-left')){
			lead_temp_layout = 'sqb-template-bg-video-left';
			var lead_video_url = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_id"]').val();
			var lead_splash_image = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="splash_image"]').val();
			var lead_video_play_btn_color = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_play_btn_color"]').val();
			var lead_video_controls = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_controls"]').val();
			var lead_video_source = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_source"]').val();
			var lead_video_caption = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_caption"]').val();
		}else if(jQuery('.template9_lead_temp_outer').hasClass('sqb-template-bg-video-right')){
			lead_temp_layout = 'sqb-template-bg-video-right';
			var lead_video_url = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_id"]').val();
			var lead_splash_image = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="splash_image"]').val();
			var lead_video_play_btn_color = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_play_btn_color"]').val();
			var lead_video_controls = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_controls"]').val();
			var lead_video_source = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_source"]').val();
			var lead_video_caption = jQuery('.lead-Screen-Quiz-Template9-left-side input[name="video_caption"]').val();
		}
		lead_image_url = jQuery('.lead-Screen-Quiz-Template9-left-side').css('background-image');
		if(lead_image_url && lead_image_url != 'none'){
			lead_image_url = lead_image_url.replace('url(','').replace(')','').replace(/\"/gi, "");
		}else{
			lead_image_url = "";
		}

		var lead_background_color = jQuery('.template9_lead_temp_outer').css('background-color');
		start_lead_customizer_styles = {'temp_layout': temp_layout, 'start_video_url': start_video_url, 'start_video_play_btn_color': start_video_play_btn_color,'start_splash_image': start_splash_image, 'start_video_controls': start_video_controls, 'start_video_source': start_video_source, 'start_image_url': start_image_url, 'lead_temp_layout': lead_temp_layout, 'lead_video_url': lead_video_url, 'lead_video_play_btn_color': lead_video_play_btn_color, 'lead_video_controls': lead_video_controls,'lead_video_source': lead_video_source, 'lead_image_url': lead_image_url, 'start_background_color': start_background_color, 'lead_background_color': lead_background_color, 'lead_splash_image': lead_splash_image, 'start_video_caption': start_video_caption, 'lead_video_caption': lead_video_caption};
	}else{
		var start_temp_html1 = jQuery('.start_temp_static_div .start_temp_container').html(); 
		var optin_temp_html1 = jQuery('.optin_temp_static_div .optin_template_html_preview_outer').html();
	}
	jQuery('.start_temp_hidden').html(start_temp_html1) ;
	jQuery('.start_temp_hidden .ui-resizable-handle.ui-resizable-e').remove();
	jQuery('.start_temp_hidden .ui-resizable-handle.ui-resizable-se').remove();
	jQuery('.start_temp_hidden .ui-resizable-handle.ui-resizable-s').remove();	
	jQuery(".start_temp_hidden .sqb_edit_template").remove();
	

	var start_temp_html = encodeURIComponent(jQuery('.start_temp_hidden').html());
	// questions  data array 
	if(sqb_question_title_validatin()){
		return false;
	}
	jQuery('.optin_temp_hidden').html(optin_temp_html1) ;
	jQuery('.optin_temp_hidden .ui-resizable-handle.ui-resizable-e').remove();
	jQuery('.optin_temp_hidden .ui-resizable-handle.ui-resizable-se').remove();
	jQuery('.optin_temp_hidden .ui-resizable-handle.ui-resizable-s').remove();	

	var updatedHTML = jQuery('.optin_temp_hidden').html().replace(
	    '<img class="lead_screen_temp_img" src="/smartquizbuilder/includes/images/sqb-registration-img.jpg">',
	    '<img class="lead_screen_temp_img" src="'+sqb_site_url+'/wp-content/plugins/smartquizbuilder/includes/images/sqb-registration-img.jpg">'
	);

	var optin_temp_html = encodeURIComponent(updatedHTML);  
	//var optin_temp_html = encodeURIComponent(jQuery('.optin_temp_hidden').html());
	
	// result  template
	var result_temp_html1 = jQuery('.result_temp_static_div .result_temp_outer').html(); 	 
	jQuery('.result_temp_hidden').html(result_temp_html1) ;
	jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-e').remove();
	jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-se').remove();
	jQuery('.result_temp_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
	var result_temp_html = encodeURIComponent(jQuery('.result_temp_hidden').html());
	
	// Question template 
	var question_template_style = jQuery('.Quiz-Template.sqb_question_enable_drag_drop').attr('style');
	
	var select_temp_class = '';
	var select_temp = jQuery('input[name="select_temp"]:checked').val();

	if(select_temp =="template1"){
	}else if(select_temp =="template2"){
		select_temp_class = 'outer-style1';

	}else if(select_temp =="template3"){
		select_temp_class = 'outer-style2';
		
	
	}else if(select_temp =="template4"){
	}else if(select_temp == 'template5'){
		select_temp_class = 'Quiz-Template-5';
	}else if(select_temp == 'template6'){
		select_temp_class = 'Quiz-Template-6';
		
		var bg_image = jQuery('.start_temp_static_div').css('background-image');
		if(bg_image == 'none'){
			var get_outer_style = jQuery('#bg_imge_style').val();
			var get_inner_style = jQuery('#bg_imge_style_inner').val();
		} else {
			var get_outer_style = jQuery('.start_temp_static_div').attr('style');
			var get_inner_style = jQuery('.start_temp_outer').attr('style');
		}
		
		jQuery('.optin_template_html_preview_outer').attr('style',get_outer_style);
 		 jQuery('.quiz_comon_template').attr('style',get_inner_style);

	    jQuery('.quiz_comon_template .Quiz-Template-title').css('background','none');
	
	}
	var question_temp_html = '<div class="Quiz-Template '+select_temp_class+'" data-id="" style="'+question_template_style+'">%%QUESTIONANSWERS%%</div>';
	if(select_temp =="template4"){
		var top_bg_color = jQuery('#question_temp_top_backgroud_color').val();
		var question_temp_html = '<div class="outer-style3 outer_style3_new" style="border-top-color:'+top_bg_color+'"><span class="outer_style3_span_first" style="border-color:'+top_bg_color+' transparent transparent"></span><span style="border-color:'+top_bg_color+' transparent transparent" class="outer_style3_span_second"></span><div class="Quiz-Template " data-id="" style="'+question_template_style+'">%%QUESTIONANSWERS%%</div></div>';
	}
	if(select_temp =="template5"){
		var question_temp_html = '<div class="Quiz-Template '+select_temp_class+'" data-id="" style="'+question_template_style+'">%%QUESTIONANSWERS%%</div>';
	}
	
	if(select_temp =="template7"){
		jQuery('.globalInnerOptions').hide();
	}
	
	var question_temp_html1 = question_temp_html; 	 	 
	jQuery('.question_temp_hidden').html(question_temp_html1) ;
	jQuery('.question_temp_hidden .ui-resizable-handle.ui-resizable-e').remove();
	jQuery('.question_temp_hidden .ui-resizable-handle.ui-resizable-se').remove();
	jQuery('.question_temp_hidden .ui-resizable-handle.ui-resizable-s').remove();	 
		 
	var question_temp_html = encodeURIComponent(jQuery('.question_temp_hidden').html());
	var enable_branching  = jQuery('input[name="enable_branching"]').prop('checked');
	if(enable_branching){
		enable_branching = 'Y';
	}else{
		enable_branching = 'N';
	}
	
	var id = jQuery('input[name="edit_id"]').val();	

	// set default 
	var quiz_timer = 'N';
	var quiz_timer_limit = 0;
	
	var progress_bar = jQuery('#progress_bar').prop('checked');
	
	if(progress_bar){
		progress_bar = 'Y';
	}else{
		progress_bar = 'N';
	}
	
	var quiz_slider_animation = jQuery('#quiz_slider_animation').prop('checked');
	
	if(quiz_slider_animation){
		quiz_slider_animation = 'Y';
	}else{
		quiz_slider_animation = 'N';
	}
	
	var quiz_slider_animation_option = jQuery(".radio-slide-option input[type='radio'][name='quiz_slider_animation_option']:checked").val();
	
	if(quiz_display == 'inpage' && quiz_pagination == 'all'){
		quiz_slider_animation = 'N';
	}
	
	var quiz_category = 'N';
	
	 var quiz_type_new_var = jQuery('input[name="quiz_type"]:checked').val();
	 if((quiz_type_new_var == 'assessment') || (quiz_type_new_var == 'scoring')){
		if(jQuery('#quiz_category_enable').prop('checked')){	
				quiz_category = 'Y';
		}
	  }
	
	var grade_quiz = 'N';
	var quiz_passmark = 0;
	
	
	var quiz_attempts_allowed = jQuery('#quiz_attempts_allowed').val()
	var total_attempts = 10;
	var already_take_the_quiz = 'start_screen';
	
	if(quiz_attempts_allowed == 'Y'){
		already_take_the_quiz = jQuery("#already_take_the_quiz").val();
		total_attempts = jQuery("#total_attempts").val();
	}
	var show_correct_ans = "N";
	
	var show_correct_ans_option = "last_page";
	
	var show_correct_ans  = jQuery('input[name="show_correct_ans"]').prop('checked');
	if(show_correct_ans){
		show_correct_ans = 'Y';
	}else{
		show_correct_ans = 'N';
	}
	var questions_random = 'Y';
	var answers_random = 'Y';
	var move_question = 'N';
	var show_for_notloggedin_user = 'Y';

	result_template_no = 'template1';
	optin_template_no = 'template1';
	template_no = 'template1';
	
	var outcome_type = jQuery('input[name="outcome_type"]:checked').val();
	var outcome_val = jQuery('input[name="outcome_based"]:checked').val();
	var outcome_screen = jQuery('input[name="category_total_enable"]').val();
	if(jQuery('input[name="category_total_enable"]').prop('checked') == true){
		var outcome_screen = 'Y';
	}else{
		var outcome_screen = 'N';
	}

	var outcome_based = outcome_val+'|'+outcome_screen;

	var category_type = jQuery('input[name="category_type"]:checked').val();
	var start_cat_val = jQuery('input[name="start_range"]').val();
	var end_cat_val = jQuery('input[name="end_range"]').val();
	var category_option = category_type+'|'+start_cat_val+'-'+end_cat_val;
	
	var show_spider_bar_charts = jQuery('input[name="show_spider_bar_charts"]:checked').val();
	if(show_spider_bar_charts == 'Y'){
		var show_spider_bar_charts = 'Y';
	} else {
		var show_spider_bar_charts = 'N';
	}
	var outcome_spider_chart = jQuery('input[name="outcome_spider_chart"]:checked').val();
	var outcome_bar_chart = jQuery('input[name="outcome_bar_chart"]:checked').val();
	var outcome_pie_chart = jQuery('input[name="outcome_pie_chart"]:checked').val();
	var question_answer_bar_chart = jQuery('input[name="question_answer_bar_chart"]:checked').val();
	var admin_users = jQuery('input[name="admin_users"]:checked').val();
	var other_users = jQuery('input[name="other_users"]:checked').val();
	var enter_email_id = jQuery('textarea[name="enter_email_id"]').val();
	
	var chart_in_percent = jQuery('input[name="chart_in_percent"]:checked').val();
	if(chart_in_percent == 'Y'){
		var chart_in_percent = 'Y';
	} else {
		var chart_in_percent = 'N';
	}


	var start_from_specific_date = jQuery('input[name="start_from_specific_date"]:checked').val();
	var show_spider_bar_chart_from = jQuery('input[name="show_spider_bar_chart_from"]').val();
	
	var sqb_spider_bar_chart_font_weight = jQuery('#sqb_spider_bar_chart_font_weight').val();	
	var sqb_spider_bar_chart_font_size = jQuery('#sqb_spider_bar_chart_font_size').val();
	var sqb_pie_chart_width = jQuery('#sqb_pie_chart_width').val();
	var sqb_spider_bar_chart_font_color = jQuery('#sqb_spider_bar_chart_font_color').val();
	var sqb_spider_bar_chart_font_family = jQuery('#sqb_spider_bar_chart_font_family').val();
	
	if(jQuery('.show_spider_bar_chart_message').text() == ''){
	var show_spider_bar_chart_message = '';
	} else {
	var show_spider_bar_chart_message = jQuery('.show_spider_bar_chart_message').html();
	}

	if(jQuery('.show_bar_chart_message').text() == ''){
	var show_bar_chart_message = '';
	} else {
	var show_bar_chart_message = jQuery('.show_bar_chart_message').html();
	}

	if(jQuery('.show_spider_chart_message').text() == ''){
	var show_spider_chart_message = '';
	} else {
	var show_spider_chart_message = jQuery('.show_spider_chart_message').html();
	}

	if(jQuery('.show_pie_chart_message').text() == ''){
	var show_pie_chart_message = '';
	} else {
	var show_pie_chart_message = jQuery('.show_pie_chart_message').html();
	}

	if(jQuery('.cumulative_show_bar_chart_message').text() == ''){
	var cumulative_show_bar_chart_message = '';
	} else {
	var cumulative_show_bar_chart_message = jQuery('.cumulative_show_bar_chart_message').html();
	}

	if(jQuery('.cumulative_show_spider_chart_message').text() == ''){
	var cumulative_show_spider_chart_message = '';
	} else {
	var cumulative_show_spider_chart_message = jQuery('.cumulative_show_spider_chart_message').html();
	}

	if(jQuery('.cumulative_show_pie_chart_message').text() == ''){
	var cumulative_show_pie_chart_message = '';
	} else {
	var cumulative_show_pie_chart_message = jQuery('.cumulative_show_pie_chart_message').html();
	}

	var sqb_spider_charts_total_response_text = jQuery('#sqb_spider_charts_total_response_text').val();
	
	var sqb_display_charts_type = 'outcome_based';
	var quiz_type = jQuery('[name="quiz_type"]:checked').val();
	if(quiz_type == 'personality' || quiz_type == 'scoring'){
	var sqb_display_charts_type = jQuery('[name="sqb_display_charts_type"]:checked').val();
	}
	
	if(jQuery('.show_spider_bar_chart_message').text() == ''){
	var sqb_display_QA_text_message = '';
	} else {
	var sqb_display_QA_text_message = encodeURIComponent(jQuery('.show_QA_chart_message').html());
	}
	
	var outcome_display_charts = outcome_spider_chart+'|'+outcome_bar_chart+'|'+question_answer_bar_chart+'|'+admin_users+'|'+other_users+'|'+enter_email_id+'|'+show_spider_bar_charts+'|'+start_from_specific_date+'|'+show_spider_bar_chart_from+'|'+sqb_spider_bar_chart_font_weight+'|'+sqb_spider_bar_chart_font_size+'|'+sqb_spider_bar_chart_font_color+'|'+sqb_spider_bar_chart_font_family+'|'+show_spider_bar_chart_message+'|'+sqb_spider_charts_total_response_text+'|'+sqb_display_charts_type+'|'+sqb_display_QA_text_message+'|'+chart_in_percent+'|'+outcome_pie_chart+'|'+sqb_pie_chart_width+'|'+show_bar_chart_message+'|'+show_spider_chart_message+'|'+show_pie_chart_message+'|'+cumulative_show_bar_chart_message+'|'+cumulative_show_spider_chart_message+'|'+cumulative_show_pie_chart_message;

	var customizer_style_setting = {};
	var outcome_tag_width = jQuery("#outcome_tag_width").val();
	var vote_selected_bg_color = jQuery('#vote_selected_bg_color').val();
	if(select_temp == 'template8'){
			
			var background_height = jQuery("#template8_background_height_value").val();
			var template8_background_image = jQuery("#template8_background_image").val();
			var template8_background_image_url = jQuery("#template8_background_image_url").val();
			var template8_bg_img_opacity = jQuery("#template8_bg_img_opacity").val();
			var background_width = jQuery("#template8_background_width_value").val();
			var background_color = jQuery("#template8_background_color_value").val();		
			var start_background_inner_width = jQuery("#template8_background_start_inner_width_value").val();
			var result_background_inner_width = jQuery("#template8_background_outcome_inner_width_value").val();
			var opt_background_inner_width = jQuery("#template8_background_opt_inner_width_value").val();
			var answer_border_width = jQuery('#answer_choice_temp_br_wid').val()+'px';
			var answer_border_hover_width = jQuery('#answer_choice_temp_hover_br_wid').val()+'px';
			var answer_border_style = jQuery('#answer_temp_br_style').val();
			var answer_border_color = jQuery('#answer_temp_br_clr').val();
			var answer_border_shadow_color = jQuery('#answer_temp_shadow_clr').val();
			var progress_background_color = jQuery('#progress_background_color').val();
			var progress_text_color = jQuery('#progress_text_color').val();
			
			var skip_button_width = jQuery('#skip_btn_width').val()+'px';
			var skip_button_height = jQuery('#skip_btn_height').val()+'px';
			var skip_button_background_color = jQuery('#skip_button_clr').val();
			
			var continue_button_width = jQuery('#continue_btn_width').val()+'px';
			var continue_button_height = jQuery('#continue_btn_height').val()+'px';
			var continue_button_radius = jQuery('#continue_btn_radius').val()+'px';
			var continue_button_background_color = jQuery('#continue_button_clr').val();
			var continue_button_hover_background_color = jQuery('#continue_button_hover_clr').val();
			var startbutton_backgroud_color = jQuery('#startbutton_backgroud_color').val();

			var background_height_unit_v2 = jQuery('.select-background-height_v2').val();
			if(background_height_unit_v2 == 'px'){
				var background_height_v2 = jQuery(".background_height_question_v2").val();
			}else{
				var background_height_v2 = jQuery(".background_height_vh_question_v2").val();
			}
		
			customizer_style_setting = {'background_height': background_height,'background_height_v2':background_height_v2, 'background_height_unit_v2':background_height_unit_v2,  'background_width':background_width,'background_color':background_color, 'answer_border_width': answer_border_width, 'answer_border_style':answer_border_style, 'answer_border_color':answer_border_color,'answer_border_shadow_color':answer_border_shadow_color,'skip_button_width':skip_button_width,'skip_button_height':skip_button_height,'skip_button_background_color':skip_button_background_color,'continue_button_width':continue_button_width,'continue_button_height':continue_button_height,'continue_button_radius':continue_button_radius,'continue_button_background_color':continue_button_background_color,'continue_button_hover_background_color':continue_button_hover_background_color,'start_background_inner_width':start_background_inner_width,'result_background_inner_width':result_background_inner_width,'opt_background_inner_width':opt_background_inner_width,'startscreen_button_background_color' : startbutton_backgroud_color,'progress_background_color' : progress_background_color,'progress_text_color' : progress_text_color,'answer_border_hover_width':answer_border_hover_width,'outcome_tag_width' : outcome_tag_width,'template8_background_image' : template8_background_image,'template8_background_image_url' : template8_background_image_url,'template8_bg_img_opacity' : template8_bg_img_opacity,'vote_selected_bg_color' : vote_selected_bg_color};
	}else if(select_temp == 'template1' || select_temp == 'template2' || select_temp == 'template3' || select_temp == 'template4'){
		var answer_background = jQuery('#temp_one_to_four_answer_backgroud_color').colorpicker('getValue');
		var answer_background_hover = jQuery('#temp_one_to_four_answer_hover_backgroud_color').colorpicker('getValue');
		var answer_text_color = jQuery('#temp_one_to_four_answer_text_color').colorpicker('getValue');
		customizer_style_setting = {'answer_background':answer_background, 'answer_background_hover':answer_background_hover,'answer_text_color':answer_text_color, 'outcome_tag_width' : outcome_tag_width,'vote_selected_bg_color' : vote_selected_bg_color};
	}else{
		customizer_style_setting = {'outcome_tag_width' : outcome_tag_width,'vote_selected_bg_color' : vote_selected_bg_color};
	}

				
    var outcome_page = jQuery('input[name="outcome_page"]:checked').val();
    var display_score_on_page = jQuery('input[name="display_score_on_page"]:checked').val();
    var display_correctans_on_page = jQuery('input[name="display_correctans_on_page"]:checked').val();	
    var display_quesans_on_outcome = jQuery('input[name="display_quesans_on_outcome"]:checked').val();	
    var template = jQuery('input[name="select_temp"]:checked').val();	
    var outcome_redirect_url = jQuery('select[name="outcome_redirect_url"]').val();	


    var startshowHide_video = 'N';
    var video_url = '';

    if(jQuery('#startshowHide_video').prop('checked') == true){
		startshowHide_video = 'Y';    	

		video_url = jQuery('#startTemplateVideoUrl').val();
    }
   
   if(typeof quiz_attempts_allowed == 'undefined' || quiz_attempts_allowed == ''){
   		quiz_attempts_allowed = 'N';
   }
    
    var showNoAnswer_q_id = '';
   	var showNoAnswer = 'N';
   	jQuery(".ques_ans_contain .question_div_outer").each(function(){
		var q_id =jQuery(this).attr('id');
		var answer_type = '';
		if(jQuery(this).find('.question_type_wrapper').hasClass('answer-type-matrix-selected')){
			answer_type = 'matrix';
		}
		var answerLength = jQuery("#"+q_id+" .sqb_ans_item").length;
		if(answerLength == 0 && answer_type != 'matrix'){
			showNoAnswer = 'Y';
			showNoAnswer_q_id  = q_id;
			return false;
			
		}
	});	

	if(showNoAnswer == 'Y'){
		swal("", "Sorry, you need to add at least one answer choice. It appears that you've not added an answer choice for one of the questions.", "");
		if(showNoAnswer_q_id != ''){
			var  question_tab_id = jQuery(".question_div_outer#"+showNoAnswer_q_id).closest('.card.sqb_question_no').attr('id');
			
			if(jQuery('.left_side_question_list a[href="#'+question_tab_id+'"]').length != 0){
				jQuery('.left_side_question_list a[href="#'+question_tab_id+'"]').trigger('click');
			}
		}
		return false;
	}

   jQuery('.question_error_msg_outer').remove();
   	var error = '';	
	//validations
	if(quiz_type == "personality"){
		error = sqb_personality_validations();
		var  error_msg = '<div class="question_error_msg">We found that some of your answers are not connected to any outcome. <br>Please click on the blue "CONNECT TO OUTCOME" button above and connect your answers to an outcome.</div>';
	}else if(quiz_type == "assessment"){
		error = sqb_assessment_validations();
		var error_msg = '<div class="question_error_msg">Sorry, it looks like you have not checked "correct answer" checkbox for these questions. Please check the box next to the correct answer.</div>';
	}else if(quiz_type == "scoring"){
		error = sqb_scoring_validations();
		var error_msg = '<div class="question_error_msg">No points have been assigned to the answers in these questions:</div>';
	}else{
		
	}

	

	var start_img_length = jQuery('.start_img').length;
	var start_image = '';

	if(start_img_length > 0 && jQuery('#start_img_temp2').css('display') != 'none'){
		start_image = jQuery('.start_img').attr('src');
	}
	
	var common_style = jQuery('#outcome_temp_top_frame_backgroud_color').val();
	var template_no = jQuery('input[name="select_temp"]:checked').val();
	if( template_no == 'template4'){
		var top_backgroud_color = jQuery('#question_temp_top_backgroud_color').val();
		var question_temp_br_style = jQuery('#question_temp_br_style option:selected').val();
		var question_temp_br_clr = jQuery('#question_temp_br_clr').val();
		var question_temp_br_wid = jQuery('#question_temp_br_wid').val();
		var ques_common_style = top_backgroud_color+"|"+question_temp_br_style+"|"+question_temp_br_clr+"|"+question_temp_br_wid
		common_style = common_style+"|"+ques_common_style;
	}
	
	var quiz_display_url = '';
	var quiz_display_in_url = 'N';
	
	
	var quiz_popup_frequency = '';
		var url_ids = [];
		
		jQuery('ul.sqb_select_urls li.active_page_posts_url').each(function(){
			url_ids.push(jQuery(this).attr('data-id'));		
		});
		
		quiz_display_url = url_ids.join(",");
		quiz_display_in_url = jQuery('select[name="activate_quiz_urls"]').val();
		
		var quiz_time_delay = jQuery('#sqb_cp_time_delay').val();
		if(quiz_time_delay == ''){
			var quiz_time_delay = 0;
		}
		
		var sqb_cp_display_frequency = jQuery('input[name="sqb_cp_display_frequency"]:checked').val();
		if(sqb_cp_display_frequency == ''){
			sqb_cp_display_frequency = 'always';
		}
		
		var sqb_cp_set_display_frequency = jQuery('#sqb_cp_set_display_frequency').val();
		if(sqb_cp_set_display_frequency < 1){
			sqb_cp_set_display_frequency = 1;
		}
		
		if(sqb_cp_display_frequency == 'set_display_frequency'){
			quiz_popup_frequency = "set_display_frequency|"+sqb_cp_set_display_frequency;
		} else {
			quiz_popup_frequency = sqb_cp_display_frequency;
		}
		
		var quiz_popup_position = '';
		if(jQuery('input[name="defaultpopup_type"]:checked').val() == 'corner_popup'){
		quiz_popup_position = jQuery('select[name="sqb_popup_position"]').val();
		} 
	var quick_email_verification = jQuery('#sqb_verify_email').val();
	// timer 
	var quiz_recommendation_enable = jQuery('#quiz_recommendation_option').prop('checked');
	if(quiz_recommendation_enable){
		quiz_recommendation_enable = 'Y';
	}else{
		quiz_recommendation_enable = 'N';
	}
	
	var quiz_recommendation_next_button_html = encodeURIComponent(jQuery('#Basic-Screen-Settings .recommended_next_template_html_preview_outer').html());

	var quiz_ads_enable = jQuery('#quiz_ads_option').prop('checked');
	if(quiz_ads_enable){
		quiz_ads_enable = 'Y';
	}else{
		quiz_ads_enable = 'N';
	}
	var quiz_ads_next_button_html = encodeURIComponent(jQuery('#Basic-Screen-Settings .ads_next_template_html_preview_outer').html());

	var quiz_outcome_pdf_button_html = encodeURIComponent(jQuery('#Basic-Screen-Settings .outcome_pdf_template_html_preview_outer').html());
	var quiz_certificate_button_html = encodeURIComponent(jQuery('#Basic-Screen-Settings .certificate_template_html_preview_outer').html());
	
	var select_certificate = jQuery("#select_certificate").val();
	
	var timer_enable = jQuery('#quiz_timer_option').prop('checked');
	if(timer_enable){
		timer_enable = 'Y';
		if(!jQuery('.timer_cutomizer_show_option').hasClass('timer_cutomizer_show_option_cutomize')){
				swal("", "Please Configure Timer Settings", "");
				
				sqb_next_tab('Basic-Screen-Settings');
				jQuery('html, body').animate({scrollTop: jQuery("#quiz_timer_option").offset().top}, 2000);
				return false;
		}
	}else{
		timer_enable = 'N';
	}
    
    var quiz_timer_hours = jQuery('#quiz_timer_hours').val();	
    var quiz_timer_mint = jQuery('#quiz_timer_mint').val();	
    var quiz_timer_sec = jQuery('#quiz_timer_sec').val();	
    if((timer_enable == 'Y') && ((quiz_timer_hours == '00') && (quiz_timer_mint == '00') && (quiz_timer_sec == '00'))){
		swal("", "You've enabled the timer but you have not set the time in the total time field. Please enter the timer value.", "");
		jQuery('.timer_cutomizer_show_div').show();
		jQuery('.timer_cutomizer_show_option').addClass('timer_cutomizer_show_option_cutomize_open');
		sqb_next_tab('Basic-Screen-Settings');
		jQuery('html, body').animate({scrollTop: jQuery("#quiz_timer_option").offset().top}, 2000);
		return false;
	}
    
    var quiz_timer_html = jQuery('.quiz_timer_html').html();	
    var quiz_timer_spent_html = jQuery('.quiz_timer_spent_html').html();	
    var quiz_timer_elapses_option = jQuery('input[name="quiz_timer_elapses"]:checked').val();
    var quiz_timer_display_in_screen = jQuery('input[name="quiz_timer_display_in_screen"]:checked').val();
    var quiz_timer_expired_msg = jQuery('.quiz_timer_expired_msg').html();
    
     var quiz_timer_hour_html = jQuery('.timer_text_hour_html').html();	
     var quiz_timer_mint_html = jQuery('.timer_text_mint_html').html();	
     var quiz_timer_sec_html = jQuery('.timer_text_sec_html').html();
     
       // set global theme start 
     var sqb_set_global_theme_style_values = '' 
     var temp_global_theme_enable = jQuery("#sqb_enable_global_setting_each_screen").prop('checked');
     if(temp_global_theme_enable){
		 temp_global_theme_enable = 'Y';
		 sqb_set_global_theme_style_values = sqb_get_global_theme_style_values(temp_global_theme_enable);
	 }else{
		 temp_global_theme_enable = 'N';
		  sqb_set_global_theme_style_values = sqb_get_global_theme_style_values(temp_global_theme_enable);
	 }

	var global_setting_style = jQuery("#sqb_enable_global_setting_style").prop('checked');
	if(global_setting_style){
		global_setting_style = 'global';
	}else{
		global_setting_style = 'quiz';
	}
	 
	var outer_style_status = jQuery("#sqb_background_status").val();
	 	
    var all_mobile_view_layout = [];
    
    jQuery('.mobile_layout_customizer_click .mobile_view_enable_button').each(function(){
		var screen_name =  jQuery(this).attr('data-action');
		var screen_status =  'N';
		var custom_values = [];
		
		if(jQuery(this).prop('checked')){
			var screen_status =  'Y';
		}
		var mobile_css_style_html = '';
		if(screen_name == 'start_screen'){
			mobile_css_style_html = jQuery('#start_screen_style_dynamic').html();
			var template_mobile_popup = jQuery('.sqb_start_screen_mobile_view_options_wrapper');
			if(template_mobile_popup.find('#sqb_stsm_font_style').prop('checked')){
				custom_values.push('font_style');
			}
			
			if(template_mobile_popup.find('#sqb_stsm_background_style').prop('checked')){
				custom_values.push('background_style');
			}
			
			if(template_mobile_popup.find('#sqb_stsm_broder_style').prop('checked')){
				custom_values.push('broder_style');
			}
			
			if(template_mobile_popup.find('#sqb_stsm_image_style').prop('checked')){
				custom_values.push('image_style');
			}
			if(template_mobile_popup.find('#sqb_stsm_button_style').prop('checked')){
				custom_values.push('button_style');
			}
		}else if(screen_name == 'outcome_screen'){
			mobile_css_style_html = jQuery('#ocm_screen_mobile_css_style').html();
			var template_mobile_popup = jQuery('.sqb_outcome_screen_mobile_view_options_wrapper');
			if(template_mobile_popup.find('#sqb_ocm_font_style').prop('checked')){
				custom_values.push('font_style');
			}
			
			if(template_mobile_popup.find('#sqb_ocm_background_style').prop('checked')){
				custom_values.push('background_style');
			}
			
			if(template_mobile_popup.find('#sqb_ocm_broder_style').prop('checked')){
				custom_values.push('broder_style');
			}
			
			if(template_mobile_popup.find('#sqb_ocm_image_style').prop('checked')){
				custom_values.push('image_style');
			}
			if(template_mobile_popup.find('#sqb_ocm_button_style').prop('checked')){
				custom_values.push('button_style');
			}
			
		}else if(screen_name == 'opt_screen'){
			mobile_css_style_html = jQuery('#optm_screen_style_dynamic').html();
			var template_mobile_popup = jQuery('.sqb_opt_screen_mobile_view_options_wrapper');
			if(template_mobile_popup.find('#sqb_optm_font_style').prop('checked')){
				custom_values.push('font_style');
			}
			
			if(template_mobile_popup.find('#sqb_optm_background_style').prop('checked')){
				custom_values.push('background_style');
			}
			
			if(template_mobile_popup.find('#sqb_optm_broder_style').prop('checked')){
				custom_values.push('broder_style');
			}
			
			if(template_mobile_popup.find('#sqb_optm_image_style').prop('checked')){
				custom_values.push('image_style');
			}
			if(template_mobile_popup.find('#sqb_optm_button_style').prop('checked')){
				custom_values.push('button_style');
			}			
			
		}else if(screen_name == 'quesm_screen'){
			mobile_css_style_html = jQuery('#quesm_screen_style_dynamic').html();
			var template_mobile_popup = jQuery('.sqb_quesm_screen_mobile_view_options_wrapper');
			if(template_mobile_popup.find('#sqb_quesm_font_style').prop('checked')){
				custom_values.push('font_style');
			}
			
			if(template_mobile_popup.find('#sqb_quesm_background_style').prop('checked')){
				custom_values.push('background_style');
			}
			
			if(template_mobile_popup.find('#sqb_quesm_broder_style').prop('checked')){
				custom_values.push('broder_style');
			}
			
			if(template_mobile_popup.find('#sqb_quesm_image_style').prop('checked')){
				custom_values.push('image_style');
			}
			if(template_mobile_popup.find('#sqb_quesm_button_style').prop('checked')){
				custom_values.push('button_style');
			}
			
			if(template_mobile_popup.find('#sqb_quesm_ans_font_style').prop('checked')){
				custom_values.push('quesm_ans_font_style');
			}
			if(template_mobile_popup.find('#sqb_quesm_ans_image_style').prop('checked')){
				custom_values.push('quesm_ans_image_style');
			}
			
		}
		
		
		
		all_mobile_view_layout.push({
		'screen_name':screen_name,
		'mobile_css_style':encodeURIComponent(mobile_css_style_html),
		'screen_status':screen_status,
		'custom_values':custom_values,
		'type':'mobile',
		});
		
		
	});
    var quiz_timmer_array = {
		timer_enable:timer_enable,
		quiz_timer_hours:quiz_timer_hours,
		quiz_timer_mint:quiz_timer_mint,
		quiz_timer_sec:quiz_timer_sec,
		quiz_timer_html:encodeURIComponent(quiz_timer_html),
		quiz_timer_spent_html:encodeURIComponent(quiz_timer_spent_html),
		quiz_timer_elapses_option:quiz_timer_elapses_option,
		quiz_timer_display_in_screen:quiz_timer_display_in_screen,
		quiz_timer_expired_msg:encodeURIComponent(quiz_timer_expired_msg),
		quiz_timer_hour_html:encodeURIComponent(quiz_timer_hour_html),
		quiz_timer_mint_html:encodeURIComponent(quiz_timer_mint_html),
		quiz_timer_sec_html:encodeURIComponent(quiz_timer_sec_html),
 	}
					 
	var enable_background_image = 'N';	
	if(select_temp =="template5"){		 
		if(jQuery('#enable_start_screen_background_image').prop('checked')){
			enable_background_image = 'Y';
		}
	}

	if(quiz_type == "poll"){
		var repeat_voting = jQuery('input[type="radio"][name="repeat-voting"]:checked').val();
		var allow_voting = jQuery('select[name="allow-voting"]').val();

		var hide_results = jQuery('input[name="hide_results"]').prop('checked');
		if(hide_results){
			hide_results = 'N';
		}else{
			hide_results = 'Y';
		}

		var allow_viewing_result = jQuery('input[name="allow_viewing_result"]').prop('checked');
		if(jQuery('#allow_viewing_result').prop('checked') == true){
			var allow_viewing_result = 'Y';
		}else{
			var allow_viewing_result = 'N';
		}

		
		var change_vote = jQuery('input[name="change_vote"]').prop('checked');
		if(jQuery('#change_vote').prop('checked') == true){
			var change_vote = 'Y';
		}else{
			var change_vote = 'N';
		}

		var answer_order = jQuery('input[type="radio"][name="answer-order"]:checked').val();

		if(jQuery('#hide_number').prop('checked') == true){
			var hide_number = 'N';
		}else{
			var hide_number = 'Y';
		}

		if(jQuery('#poll_start_date').prop('checked') == true){
			var poll_start_date = 'Y';			
			var start_poll = jQuery('input[name="start_poll"]').val();
		}else{
			var poll_start_date = 'N';
		}
		var start_poll_html = jQuery('.start_time_editor').html();

		if(jQuery('#close_specific_time').prop('checked') == true){
			var close_specific_time = 'Y';
			var close_poll = jQuery('input[name="close_poll"]').val();
		}else{
			var close_specific_time = 'N';
		}
		var close_poll_html = jQuery('.close_time_editor').html();
		var change_vote_content = jQuery('.change_vote_content').html();
		var view_result_content = jQuery('.view_result_content').html();
		var return_poll_content = jQuery('.return_poll_content').html();
		var show_vote_count = jQuery('.show_vote_count').html();

		if(jQuery('#display_message').prop('checked') == true){
			var display_message = 'Y';
			var display_message_content = jQuery('.display_message_content').html();
		}else{
			var display_message = 'N';
		}

		var show_results = jQuery('input[type="radio"][name="show_results"]:checked').val();
		var chart_display = jQuery('input[type="radio"][name="chart_display"]:checked').val();

		
		var vote_btn_html = jQuery('.vote_temp_container').html();
    	var vote_btn_width = jQuery('#vote_btn_width').val();
    	var vote_btn_radius = jQuery('#vote_btn_radius').val();
		var vote_btn_height = jQuery('#vote_btn_height').val();
		var vote_btn_backgroud_color = jQuery('#vote_button_backgroud_color').val();
		var vote_style = jQuery('.vote_button').attr('style');
		var vote_customizer = [];

		vote_customizer.push({
			'vote_btn_width': vote_btn_width,
			'vote_btn_height': vote_btn_height,
			'vote_btn_radius': vote_btn_radius,
			'vote_btn_backgroud_color': vote_btn_backgroud_color,
			'vote_style': vote_style,
		})
		
		var poll_settings = [];
		poll_settings.push({
			'repeat_voting':repeat_voting,
			'allow_voting':allow_voting,
			'hide_results':hide_results,
			'allow_viewing_result':allow_viewing_result,
			'change_vote':change_vote,
			'answer_order':answer_order,
			'hide_number':hide_number,
			'poll_start_date':poll_start_date,
			'start_poll':start_poll,
			'start_poll_html':start_poll_html,
			'close_specific_time':close_specific_time,
			'close_poll':close_poll,
			'close_poll_html':close_poll_html,
			'display_message':display_message,
			'display_message_content':display_message_content,
			'show_results':show_results,
			'chart_display':chart_display,
			'change_vote_content':change_vote_content,
			'view_result_content':view_result_content,
			'return_poll_content':return_poll_content,
			'show_vote_count':show_vote_count,
			'vote_btn_html':vote_btn_html,
			'vote_customizer':vote_customizer,
		});
	}
	
	var quiz_move_question = jQuery('#quiz_move_question').val();

	var url_select_popup = 'Y';
	if(jQuery('.sqb_multiple_url_select').css('display') == 'none' && jQuery('.sqb_multiple_url_select').css('display') == 'none'){
		url_select_popup = 'N';
	}

	var download_certificate_backgroud_color = jQuery('.download_certificate_button div span').css('color');
	if(download_certificate_backgroud_color == undefined || download_certificate_backgroud_color == ''){
		var download_certificate_backgroud_color = jQuery('.download_certificate_button').css('color');
	}

	var speed_timer_enable = jQuery('#quiz_speed_timer_option').prop('checked');
	if(speed_timer_enable){
		speed_timer_enable = 'Y';
		if(!jQuery('.speed_timer_cutomizer_show_option').hasClass('speed_timer_cutomizer_show_option_cutomize')){
				swal("", "Please Configure Timer Settings", "");
				
				sqb_next_tab('Basic-Screen-Settings');
				jQuery('html, body').animate({scrollTop: jQuery("#quiz_speed_timer_option").offset().top}, 2000);
				return false;
		}
	}else{
		speed_timer_enable = 'N';
	}

	var quiz_display_heading_html = jQuery(".quiz_display_heading_html").html();
	var quiz_display_totaltime_html = jQuery(".quiz_display_totaltime_html").html();
	
	var speed_timer_text_hour_html = jQuery(".speed_timer_text_hour_html").html();
	var speed_timer_text_mint_html = jQuery(".speed_timer_text_mint_html").html();
	var speed_timer_text_sec_html = jQuery(".speed_timer_text_sec_html").html();

    var st_background_color = jQuery('#st_background_color').val();	
    var st_background_color_second = jQuery('#st_background_color_second').val();	
    var st_shadow_background_color = jQuery('#st_shadow_background_color').val();	
    var st_spread_radius = jQuery('#st_spread_radius').val();	
    var st_blur_radius = jQuery('#st_blur_radius').val();	
    var st_horizontal_length = jQuery('#st_horizontal_length').val();	
    var st_vertical_length = jQuery('#st_vertical_length').val();	

    if(jQuery('#prevent-resubmission').prop('checked') == true){
    	var prevent_resubmission = 'Y';
    }else{
    	var prevent_resubmission = 'N';
    }

    var sqb_block_quiz = jQuery('input[name="sqb_block_quiz"]:checked').val();

    if(jQuery('#show_image_block_quiz').prop('checked') == true){
    	var show_image_block_quiz = 'Y';
    }else{
    	var show_image_block_quiz = 'N';
    }

	var add_quiz_block_icon = jQuery('input[name="add_quiz_block_icon"]').val();

	if(jQuery('.block-edit-message').text() == ''){
		var block_edit_message = '';
	} else {
		var block_edit_message = jQuery('.block-edit-message').html();
	}


	var question_pagination_count = jQuery("#question_pagination_count").val();

	var qns_category_order = jQuery('.qns-list-cat li').map(function(i, opt) {
	  	return jQuery(opt).attr('data-id');
	}).toArray().join(', ');

	if(jQuery('#interactive_video_autoplay').prop('checked') == true){
		var interactive_video_autoplay = 'Y';
	}else{
		var interactive_video_autoplay = 'N';
	}

	if(jQuery('#buffer_on_load').prop('checked') == true){
		var buffer_on_load = 'Y';
	}else{
		var buffer_on_load = 'N';
	}

	if(jQuery('#click_to_unmute').prop('checked') == true){
		var click_to_unmute = 'Y';
	}else{
		var click_to_unmute = 'N';
	}
	var same_page_option = jQuery('input[name="question_same_page"]:checked').val();
	if(jQuery('#show_category_link').prop('checked') == true){
		var show_category_link = 'Y';
	}else{
		var show_category_link = 'N';
	}
	var show_category_link_color = jQuery('#show_category_link_color').val();
	var pdf_mode = jQuery('.pdf-customize-value').val();
	var send_user_details = jQuery('.send_user_details_value').val();

	var email_based_subscriber = jQuery('input[name="email-based-subscribers"]:checked').val();
	if(jQuery('#question_width_apply_to_all').prop('checked') == true){
		var question_width_apply_to_all = 'Y';
	}else{
		var question_width_apply_to_all = 'N';
	}

	var sqb_button_template = jQuery('input[name="sqb_button_template"]:checked').data('template');
	var startbutton_backgroud_color = jQuery('#startbutton_backgroud_color').val();
	var startbutton_backgroud_color_hover = jQuery('#startbutton_backgroud_color_hover').val();

	var opt_button_backgroud_color = jQuery('#opt_button_backgroud_color').val();
	var optinbutton_backgroud_color_hover = jQuery('#optinbutton_backgroud_color_hover').val();
	var opt_in_temp_inner_width_optin_input = jQuery('.opt_in_temp_inner_width_optin_input').val();
	var sqb_button_template_optin = jQuery('input[name="sqb_button_template_optin"]:checked').data('template');

	var outcome_button_backgroud_color = jQuery('#outcome_button_backgroud_color').val();
	var outcomebutton_backgroud_color_hover = jQuery('#outcomebutton_backgroud_color_hover').val();
	var sqb_button_template_outcome = jQuery('input[name="sqb_button_template_outcome"]:checked').data('template');

	var form_view_option = jQuery('input[name=form_view_option]:checked').val();
	var sqb_form_type_redirect_url = jQuery('input[name=sqb_form_type_redirect_url]').val();

	if(tab_id == 'Opt-Screen-Settings'){
		if(quiz_type == 'form' && form_view_option == 'just_button'){
			if(sqb_form_type_redirect_url == ''){
				jQuery('.sqbv2-template-type.Template-Customize-Setting.element_customizer_wrapper_list.btn_customizer .customizer_innner_sections').show();
				sqb_sweet_message('','Please enter redirect URL','');
				return false;
			}
		}
	}
	
	if(tab_id == 'create_quiz_advance' && current_tab_name == 'lead_generation_tab' && next_tab == 'next'){
		if(quiz_type == 'form' && form_view_option == 'just_button'){
			if(sqb_form_type_redirect_url == ''){
				jQuery('.sqbv2-template-type.Template-Customize-Setting.element_customizer_wrapper_list.btn_customizer .customizer_innner_sections').show();
				sqb_sweet_message('','Please enter redirect URL','');
				jQuery('#Opt-Screen-Settings-tab').trigger('click');
				return false;
			}
		}
	}
	
	

	var all_other_options = {"email_pdf_attachment": email_pdf_attachment, "quiz_allow_certificate": quiz_allow_certificate, "quiz_certificate_button_html": quiz_certificate_button_html, "select_certificate": select_certificate, 'download_certificate_backgroud_color': download_certificate_backgroud_color, 'speed_timer_enable': speed_timer_enable, 'quiz_display_totaltime_html': quiz_display_totaltime_html, 'quiz_display_heading_html': quiz_display_heading_html, 'speed_timer_text_hour_html': speed_timer_text_hour_html, 'speed_timer_text_mint_html': speed_timer_text_mint_html, 'speed_timer_text_sec_html': speed_timer_text_sec_html, 'st_background_color': st_background_color, 'st_background_color_second': st_background_color_second, 'st_shadow_background_color': st_shadow_background_color, 'st_spread_radius': st_spread_radius, 'st_blur_radius': st_blur_radius, 'st_horizontal_length': st_horizontal_length, 'st_vertical_length': st_vertical_length, 'prevent_resubmission': prevent_resubmission, 'sqb_block_quiz': sqb_block_quiz, 'show_image_block_quiz': show_image_block_quiz, 'add_quiz_block_icon': add_quiz_block_icon, 'block_edit_message': block_edit_message, 'question_pagination_count': question_pagination_count, 'qns_category_order': qns_category_order, 'buffer_on_load': buffer_on_load, 'interactive_video_autoplay': interactive_video_autoplay, 'click_to_unmute': click_to_unmute, 'same_page_option': same_page_option, 'show_category_link': show_category_link, 'show_category_link_color': show_category_link_color, 'pdf_mode': pdf_mode, 'send_user_details': send_user_details, 'email_based_subscriber': email_based_subscriber, 'question_width_apply_to_all':question_width_apply_to_all,'sqb_button_template':sqb_button_template,'startbutton_backgroud_color':startbutton_backgroud_color,'startbutton_backgroud_color_hover':startbutton_backgroud_color_hover,'optinbutton_backgroud_color_hover':optinbutton_backgroud_color_hover,'opt_button_backgroud_color':opt_button_backgroud_color,'sqb_button_template_optin':sqb_button_template_optin,'outcome_button_backgroud_color':outcome_button_backgroud_color,'outcomebutton_backgroud_color_hover':outcomebutton_backgroud_color_hover,'sqb_button_template_outcome':sqb_button_template_outcome,'opt_in_temp_inner_width_optin_input':opt_in_temp_inner_width_optin_input,'sqb_form_type_redirect_url':sqb_form_type_redirect_url };
	

	var next_button_settings_background_color = jQuery('#all_temp_continue_button_clr').val();
	var next_button_settings_background_hover_color = jQuery('#all_temp_continue_button_hover_clr').val();
   	var nexttbtn_width_for_quiz = jQuery('#all_temp_continue_btn_width').val();
   	var nexttbtn_height_for_quiz = jQuery('#all_temp_continue_btn_height').val();
   	var nexttbtn_radius_for_quiz = jQuery('#all_temp_continue_btn_radius').val();
   	var next_btn_html = jQuery('.skip_continue_button_wrapper .continue-question-action').html();

   	var skip_question_button_for_quiz = jQuery('#all_skip_button_clr').val();
   	var skip_question_button_hover_for_quiz = jQuery('#all_skip_button_hover_clr').val();
   	var skip_question_btn_width_for_quiz = jQuery('#all_temp_skip_btn_width').val();
   	var skip_question_btn_height_for_quiz = jQuery('#all_temp_skip_btn_height').val();
   	var skip_question_btn_radius_for_quiz = jQuery('#all_temp_skip_btn_radius').val();
   	var skip_btn_html = jQuery('.skip_continue_button_wrapper .skip-question-action').html();

   	var back_question_button_for_quiz = jQuery('#all_back_button_clr').val();
   	var back_question_button_hover_for_quiz = jQuery('#all_back_button_hover_clr').val();
   	var back_question_btn_width_for_quiz = jQuery('#all_temp_back_btn_width').val();
   	var back_question_btn_height_for_quiz = jQuery('#all_temp_back_btn_height').val();
   	var back_btn_radius = jQuery('#all_temp_back_btn_radius').val();
   	var back_btn_html = jQuery('.skip_continue_button_wrapper .back-question-action').html();
   	var all_temp_progress_bar_active_color = jQuery('#all_temp_progress_bar_active_color').val();
   	var all_temp_progress_bar_inactive_color = jQuery('#all_temp_progress_bar_inactive_color').val();

	var tag_width = jQuery('#sqb_global_temp_tag_width').val();
	var tag_background = jQuery('#sqb_global_temp_tag_background').val();
	var tag_title_font_family = jQuery('#sqb_global_temp_tag_title_font_family').val();
	var tag_title_font_size = jQuery('#sqb_global_temp_tag_title_font_size').val();
	var tag_title_font_weight = jQuery('#sqb_global_temp_tag_title_font_weight').val();
	var tag_title_font_color = jQuery('#sqb_global_temp_tag_title_font_color').val();
	var tag_desc_font_family = jQuery('#sqb_global_temp_tag_desc_font_family').val();
	var tag_desc_font_size = jQuery('#sqb_global_temp_tag_desc_font_size').val();
	var tag_desc_font_weight = jQuery('#sqb_global_temp_tag_desc_font_weight').val();
	var tag_desc_font_color = jQuery('#sqb_global_temp_tag_desc_font_color').val();
	var tag_bottom_margin = jQuery('#sqb_global_temp_tag_bottom_margin').val();
	var tag_padding = jQuery('#sqb_global_temp_tag_padding').val();

	var category_title_font_family = jQuery('#sqb_global_temp_category_title_font_family').val();
	var category_background = jQuery('#sqb_global_temp_category_background').val();
	var category_title_font_size = jQuery('#sqb_global_temp_category_title_font_size').val();
	var category_title_font_color = jQuery('#sqb_global_temp_category_title_font_color').val();
	var category_desc_font_family = jQuery('#sqb_global_temp_category_desc_font_family').val();
	var category_desc_font_size = jQuery('#sqb_global_temp_category_desc_font_size').val();
	var category_desc_font_color = jQuery('#sqb_global_temp_category_desc_font_color').val();
	var category_bottom_margin = jQuery('#sqb_global_temp_category_bottom_margin').val();
	var category_padding = jQuery('#sqb_global_temp_category_padding').val();

	/* Global theme title Start */
	if(jQuery("#sqb_global_temp_title_color_enable").prop('checked') == true){
		var sqb_global_temp_title_color_enable = 'Y';
	}else{
		var sqb_global_temp_title_color_enable = 'N';
	}

	var sqb_global_temp_title_color = jQuery('#sqb_global_temp_title_color').val();

	if(jQuery("#sqb_global_temp_title_font_family_enable").prop('checked') == true){
		var sqb_global_temp_title_font_family_enable = 'Y';
	}else{
		var sqb_global_temp_title_font_family_enable = 'N';
	}

	//var sqb_global_temp_title_font_family = jQuery('#select2-sqb_global_temp_title_font_family-container').attr('title');
	var sqb_global_temp_title_font_family = jQuery('#sqb_global_temp_title_font_family').val();

	if(jQuery("#sqb_global_temp_title_line_height_enable").prop('checked') == true){
		var sqb_global_temp_title_line_height_enable = 'Y';
	}else{
		var sqb_global_temp_title_line_height_enable = 'N';
	}

	var sqb_global_temp_title_line_height = jQuery('#sqb_global_temp_title_line_height').val();

	if(jQuery("#sqb_global_temp_title_font_size_enable").prop('checked') == true){
		var sqb_global_temp_title_font_size_enable = 'Y';
	}else{
		var sqb_global_temp_title_font_size_enable = 'N';
	}

	var sqb_global_temp_title_font_size = jQuery('#sqb_global_temp_title_font_size').val();
	var sqb_global_temp_title_font_weight = jQuery('#sqb_global_temp_title_font_weight').val();

	/* Global theme title End */
	
	/* Global theme description Start */

	if(jQuery("#sqb_global_temp_description_color_enable").prop('checked') == true){
		var sqb_global_temp_description_color_enable = 'Y';
	}else{
		var sqb_global_temp_description_color_enable = 'N';
	}

	var sqb_global_temp_description_color = jQuery('#sqb_global_temp_description_color').val();

	if(jQuery("#sqb_global_temp_description_font_size_enable").prop('checked') == true){
		var sqb_global_temp_description_font_size_enable = 'Y';
	}else{
		var sqb_global_temp_description_font_size_enable = 'N';
	}
	var sqb_global_temp_description_font_size = jQuery('#sqb_global_temp_description_font_size').val();
	var sqb_global_temp_description_font_weight = jQuery('#sqb_global_temp_description_font_weight').val();

	if(jQuery("#sqb_global_temp_description_font_family_enable").prop('checked') == true){
		var sqb_global_temp_description_font_family_enable = 'Y';
	}else{
		var sqb_global_temp_description_font_family_enable = 'N';
	}

	var sqb_global_temp_description_font_family = jQuery('#sqb_global_temp_description_font_family').val();

	
	/* Global theme description End */

	/* Global theme answer Start */

	if(jQuery("#sqb_global_ans_background_color_enable").prop('checked') == true){
		var sqb_global_ans_background_color_enable = 'Y';
	}else{
		var sqb_global_ans_background_color_enable = 'N';
	}
	if(jQuery("#sqb_global_ans_border_width_enable").prop('checked') == true){
		var sqb_global_ans_border_width_enable = 'Y';
	}else{
		var sqb_global_ans_border_width_enable = 'N';
	}
	if(jQuery("#sqb_global_selected_ans_color_enable").prop('checked') == true){
		var sqb_global_selected_ans_color_enable = 'Y';
	}else{
		var sqb_global_selected_ans_color_enable = 'N';
	}
	if(jQuery("#sqb_global_ans_text_hover_color_enable").prop('checked') == true){
		var sqb_global_ans_text_hover_color_enable = 'Y';
	}else{
		var sqb_global_ans_text_hover_color_enable = 'N';
	}
	if(jQuery("#sqb_global_ans_background_hover_color_enable").prop('checked') == true){
		var sqb_global_ans_background_hover_color_enable = 'Y';
	}else{
		var sqb_global_ans_background_hover_color_enable = 'N';
	}

	if(jQuery("#sqb_global_temp_question_ans_color_enable").prop('checked') == true){
		var sqb_global_temp_question_ans_color_enable = 'Y';
	}else{
		var sqb_global_temp_question_ans_color_enable = 'N';
	}
	var sqb_global_temp_question_ans_color = jQuery("#sqb_global_temp_question_ans_color").val();
	var sqb_global_ans_background_color = jQuery("#sqb_global_ans_background_color").val();
	var sqb_global_ans_text_hover_color = jQuery("#sqb_global_ans_text_hover_color").val();
	var sqb_global_ans_border_color = jQuery("#sqb_global_ans_border_color").val();
	var sqb_global_ans_border_hover_color = jQuery("#sqb_global_ans_border_hover_color").val();
	var sqb_global_ans_background_hover_color = jQuery("#sqb_global_ans_background_hover_color").val();

	if(jQuery("#sqb_global_temp_question_ans_font_size_enable").prop('checked') == true){
		var sqb_global_temp_question_ans_font_size_enable = 'Y';
	}else{
		var sqb_global_temp_question_ans_font_size_enable = 'N';
	}
	var sqb_global_temp_question_ans_font_size = jQuery("#sqb_global_temp_question_ans_font_size").val();
	var sqb_global_answer_border_width = jQuery("#sqb_global_answer_border_width").val();
	var sqb_global_selected_ans_color = jQuery("#sqb_global_selected_ans_color").val();

	if(jQuery("#sqb_global_temp_question_ans_font_family_enable").prop('checked') == true){
		var sqb_global_temp_question_ans_font_family_enable = 'Y';
	}else{
		var sqb_global_temp_question_ans_font_family_enable = 'N';
	}
	if(jQuery("#sqb_global_temp_button_font_family_enable").prop('checked') == true){
		var sqb_global_temp_button_font_family_enable = 'Y';
	}else{
		var sqb_global_temp_button_font_family_enable = 'N';
	}

	var sqb_global_temp_question_ans_font_family = jQuery('#sqb_global_temp_question_ans_font_family').val();
	var sqb_global_temp_button_font_family = jQuery('#sqb_global_temp_button_font_family').val();
	var sqb_global_temp_question_ans_font_weight = jQuery("#sqb_global_temp_question_ans_font_weight").val();


	
	/* Global theme answer End */


	/* Global theme : Border Style */

	if(jQuery("#sqb_global_temp_border_color_enable").prop('checked') == true){
		var sqb_global_temp_border_color_enable = 'Y';
	}else{
		var sqb_global_temp_border_color_enable = 'N';
	}
	var sqb_global_temp_border_color = jQuery("#sqb_global_temp_border_color").val();


	if(jQuery("#sqb_global_temp_border_style_enable").prop('checked') == true){
		var sqb_global_temp_border_style_enable = 'Y';
	}else{
		var sqb_global_temp_border_style_enable = 'N';
	}
	var sqb_global_temp_border_style = jQuery("#sqb_global_temp_border_style").val();

	if(jQuery("#sqb_global_temp_border_width_enable").prop('checked') == true){
		var sqb_global_temp_border_width_enable = 'Y';
	}else{
		var sqb_global_temp_border_width_enable = 'N';
	}
	var sqb_global_temp_border_width = jQuery("#sqb_global_temp_border_width").val();

	
	
	/*  */

	/* Global theme background Start */

	

	if(jQuery("#sqb_global_temp_background_enable").prop('checked') == true){
		var sqb_global_temp_background_enable = 'Y';
	}else{
		var sqb_global_temp_background_enable = 'N';
	}
	if(jQuery("#sqb_global_ans_border_color_enable").prop('checked') == true){
		var sqb_global_ans_border_color_enable = 'Y';
	}else{
		var sqb_global_ans_border_color_enable = 'N';
	}
	if(jQuery("#sqb_global_ans_border_hover_color_enable").prop('checked') == true){
		var sqb_global_ans_border_hover_color_enable = 'Y';
	}else{
		var sqb_global_ans_border_hover_color_enable = 'N';
	}
	var sqb_global_temp_background = jQuery("#sqb_global_temp_background").val();
	/* Global theme background End */

	/* Global theme shadow Start */

	if(jQuery("#sqb_global_temp_shadow_spread_radius_enable").prop('checked') == true){
		var sqb_global_temp_shadow_spread_radius_enable = 'Y';
	}else{
		var sqb_global_temp_shadow_spread_radius_enable = 'N';
	}

	var sqb_global_temp_shadow_spread_radius = jQuery("#sqb_global_temp_shadow_spread_radius").val();


	if(jQuery("#sqb_global_temp_shadow_blur_radius_enable").prop('checked') == true){
		var sqb_global_temp_shadow_blur_radius_enable = 'Y';
	}else{
		var sqb_global_temp_shadow_blur_radius_enable = 'N';
	}
	var sqb_global_temp_shadow_blur_radius = jQuery("#sqb_global_temp_shadow_blur_radius").val();

	if(jQuery("#sqb_global_temp_shadow_horizontal_length_enable").prop('checked') == true){
		var sqb_global_temp_shadow_horizontal_length_enable = 'Y';
	}else{
		var sqb_global_temp_shadow_horizontal_length_enable = 'N';
	}

	var sqb_global_temp_shadow_horizontal_length = jQuery("#sqb_global_temp_shadow_horizontal_length").val();

	if(jQuery("#sqb_global_temp_shadow_vertical_length_enable").prop('checked') == true){
		var sqb_global_temp_shadow_vertical_length_enable = 'Y';
	}else{
		var sqb_global_temp_shadow_vertical_length_enable = 'N';
	}
	var sqb_global_temp_shadow_vertical_length = jQuery("#sqb_global_temp_shadow_vertical_length").val();

	if(jQuery("#sqb_global_temp_shadow_background_color_enable").prop('checked') == true){
		var sqb_global_temp_shadow_background_color_enable = 'Y';
	}else{
		var sqb_global_temp_shadow_background_color_enable = 'N';
	}
	var sqb_global_temp_shadow_background_color = jQuery("#sqb_global_temp_shadow_background_color").val();

	/* Global theme shadow End */

	var top_bar_background_color = jQuery('body').css('--top_bar_background_color');

	/* Global Width Height Start */

	var sqb_global_outer_width_input = jQuery('.sqb_global_outer_width_input').val();
	var sqb_global_inner_width_input = jQuery('.sqb_global_inner_width_input').val();
	var sqb_global_padding = jQuery('.sqb_global_padding_input').val();
	var sqb_global_inner_padding_template8 = jQuery('.sqb_global_inner_padding_template8_input').val();
	var sqb_global_inner_width_template8 = jQuery('.sqb_global_inner_width_template8_input').val();
	if(jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == true){
		var sqb_enable_inner_customizer_template8 = "Y";
	}else{
		var sqb_enable_inner_customizer_template8 = "N";
	}
	var sqb_selected_global_height = jQuery('.sqb_select_global_height').find(":selected").val();
	if(jQuery('.sqb_select_global_height').find(":selected").val() == 'px'){
		var sqb_global_height_input = jQuery('.sqb_global_height_input').val();
	}else{
		var sqb_global_height_input = jQuery('.sqb_global_height_vh_input').val();
	}

	var sqb_selected_global_width_type = jQuery('.global-width-percentage').css('display');

	if(sqb_selected_global_width_type == 'none'){
		var sqb_selected_global_width = 'px';
	}else{
		var sqb_selected_global_width = '%';
	}

	var sqb_global_background_color = jQuery('#sqb_global_background_color').val();
	var sqb_global_inner_background_color = jQuery('#sqb_global_inner_background_color').val();
	var sqb_global_inner_background_color_template8 = jQuery('#sqb_global_inner_background_color_template8').val();
	var sqb_global_background_image = jQuery('#sqb_global_background_image').text();
	var sqb_global_background_image_url = jQuery('#sqb_global_background_image_url').val();

	var repeat_background = 'N';
	if(jQuery('#repeat_background').prop('checked') == true){
		var repeat_background = 'Y';
	}
	/* Global Width Height End */

   	var all_background_color = {'next_button_settings_background_color': next_button_settings_background_color,'next_button_settings_background_hover_color':next_button_settings_background_hover_color, 'nexttbtn_width_for_quiz': nexttbtn_width_for_quiz, 'nexttbtn_height_for_quiz': nexttbtn_height_for_quiz, 'next_btn_html': next_btn_html, 'skip_question_button_for_quiz': skip_question_button_for_quiz,'skip_question_btn_width_for_quiz': skip_question_btn_width_for_quiz, 'skip_question_btn_height_for_quiz': skip_question_btn_height_for_quiz, 'skip_btn_html': skip_btn_html, 'nexttbtn_radius_for_quiz': nexttbtn_radius_for_quiz, 'skip_question_button_hover_for_quiz': skip_question_button_hover_for_quiz, 'skip_question_btn_radius_for_quiz': skip_question_btn_radius_for_quiz, 'back_question_button_for_quiz': back_question_button_for_quiz, 'back_question_button_hover_for_quiz': back_question_button_hover_for_quiz, 'back_question_btn_width_for_quiz': back_question_btn_width_for_quiz, 'back_question_btn_height_for_quiz': back_question_btn_height_for_quiz, 'back_btn_radius': back_btn_radius, 'back_btn_html': back_btn_html, 'setting_progress_color': all_temp_progress_bar_active_color, 'setting_progress_inactive_color': all_temp_progress_bar_inactive_color,

	   	setting_tag_width_input : tag_width,
	   	setting_tag_background_color : tag_background,
	   	tag_title_font_family : tag_title_font_family,
	   	tag_title_font_size : tag_title_font_size,
	   	tag_title_font_weight : tag_title_font_weight,
	   	tag_title_font_color : tag_title_font_color,
	   	tag_desc_font_family : tag_desc_font_family,
	   	tag_desc_font_size : tag_desc_font_size,
	   	tag_desc_font_weight : tag_desc_font_weight,
	   	tag_desc_font_color : tag_desc_font_color,
	   	tag_bottom_margin : tag_bottom_margin,
	   	tag_padding : tag_padding,

	   	sqb_global_outer_width : sqb_global_outer_width_input,
		sqb_selected_global_width : sqb_selected_global_width,
	   	sqb_global_inner_width : sqb_global_inner_width_input,
	   	sqb_global_padding : sqb_global_padding,
	   	sqb_global_inner_padding_template8 : sqb_global_inner_padding_template8,
	   	sqb_global_inner_width_template8 : sqb_global_inner_width_template8,
	   	sqb_enable_inner_customizer_template8 : sqb_enable_inner_customizer_template8,
	   	sqb_selected_global_height : sqb_selected_global_height,
	   	sqb_global_height_input : sqb_global_height_input,
	   	sqb_global_background_color : sqb_global_background_color,
	   	sqb_global_inner_background_color : sqb_global_inner_background_color,
	   	sqb_global_inner_background_color_template8 : sqb_global_inner_background_color_template8,
	   	repeat_background : repeat_background,
	   	sqb_global_background_image : sqb_global_background_image,
	   	sqb_global_background_image_url : sqb_global_background_image_url,

	   	sqb_global_title_color_enable: sqb_global_temp_title_color_enable,
	   	sqb_global_title_color: sqb_global_temp_title_color,
	   	sqb_global_title_font_family_enable: sqb_global_temp_title_font_family_enable,
	   	sqb_global_title_font_family: sqb_global_temp_title_font_family,
	   	sqb_global_title_line_height_enable: sqb_global_temp_title_line_height_enable,
	   	sqb_global_title_line_height: sqb_global_temp_title_line_height,
	   	sqb_global_title_font_size_enable: sqb_global_temp_title_font_size_enable,
	   	sqb_global_title_font_size: sqb_global_temp_title_font_size,
	   	sqb_global_title_font_weight: sqb_global_temp_title_font_weight,

	   	sqb_global_description_color_enable: sqb_global_temp_description_color_enable,
	   	sqb_global_description_color: sqb_global_temp_description_color,
	   	sqb_global_description_font_size_enable: sqb_global_temp_description_font_size_enable,
	   	sqb_global_description_font_size: sqb_global_temp_description_font_size,
	   	sqb_global_description_font_weight: sqb_global_temp_description_font_weight,
	   	sqb_global_description_font_family_enable: sqb_global_temp_description_font_family_enable,
	   	sqb_global_description_font_family: sqb_global_temp_description_font_family,

	   	sqb_global_question_ans_color_enable: sqb_global_temp_question_ans_color_enable,
	   	sqb_global_ans_background_color_enable: sqb_global_ans_background_color_enable,
	   	sqb_global_ans_border_width_enable: sqb_global_ans_border_width_enable,
	   	sqb_global_selected_ans_color_enable: sqb_global_selected_ans_color_enable,
	   	sqb_global_ans_text_hover_color_enable: sqb_global_ans_text_hover_color_enable,
	   	sqb_global_ans_background_hover_color_enable: sqb_global_ans_background_hover_color_enable,
	   	sqb_global_question_ans_color: sqb_global_temp_question_ans_color,
	   	sqb_global_ans_background_color: sqb_global_ans_background_color,
	   	sqb_global_ans_border_radius_color: sqb_global_ans_border_color,
	   	sqb_global_ans_border_radius_hover_color: sqb_global_ans_border_hover_color,
	   	sqb_global_ans_text_hover_color: sqb_global_ans_text_hover_color,
	   	sqb_global_ans_background_hover_color: sqb_global_ans_background_hover_color,
	   	sqb_global_question_ans_font_size_enable: sqb_global_temp_question_ans_font_size_enable,
	   	sqb_global_question_ans_font_size: sqb_global_temp_question_ans_font_size,
	   	sqb_global_ans_border_width: sqb_global_answer_border_width,
	   	sqb_global_selected_ans_color: sqb_global_selected_ans_color,
	   	sqb_global_question_ans_font_family_enable: sqb_global_temp_question_ans_font_family_enable,
	   	sqb_global_button_font_family_enable: sqb_global_temp_button_font_family_enable,
	   	sqb_global_question_ans_font_family: sqb_global_temp_question_ans_font_family,
	   	sqb_global_button_font_family: sqb_global_temp_button_font_family,
	   	sqb_global_question_ans_font_weight: sqb_global_temp_question_ans_font_weight,
	   	sqb_global_ans_border_radius_color_enable: sqb_global_ans_border_color_enable,
	   	sqb_global_ans_border_radius_hover_color_enable: sqb_global_ans_border_hover_color_enable,

	   	sqb_global_background_enable: sqb_global_temp_background_enable,
	   	sqb_global_background: sqb_global_temp_background,

		sqb_global_border_color_enable : sqb_global_temp_border_color_enable,
		sqb_global_border_color : sqb_global_temp_border_color,

		sqb_global_border_style_enable : sqb_global_temp_border_style_enable,
		sqb_global_border_style : sqb_global_temp_border_style,

		sqb_global_border_width_enable : sqb_global_temp_border_width_enable,
		sqb_global_border_width : sqb_global_temp_border_width,

	   	sqb_global_shadow_spread_radius_enable: sqb_global_temp_shadow_spread_radius_enable,
		sqb_global_shadow_spread_radius: sqb_global_temp_shadow_spread_radius,
		sqb_global_shadow_blur_radius_enable: sqb_global_temp_shadow_blur_radius_enable,
		sqb_global_shadow_blur_radius: sqb_global_temp_shadow_blur_radius,
		sqb_global_shadow_horizontal_length_enable: sqb_global_temp_shadow_horizontal_length_enable,
		sqb_global_shadow_horizontal_length: sqb_global_temp_shadow_horizontal_length,
		sqb_global_shadow_vertical_length_enable: sqb_global_temp_shadow_vertical_length_enable,
		sqb_global_shadow_vertical_length: sqb_global_temp_shadow_vertical_length,
		sqb_global_shadow_background_color_enable: sqb_global_temp_shadow_background_color_enable,
		sqb_global_shadow_background_color: sqb_global_temp_shadow_background_color,


	   	setting_category_background_color : category_background,
	   	category_title_font_family : category_title_font_family,
	   	category_title_font_size : category_title_font_size,
	   	category_title_font_color : category_title_font_color,
	   	category_desc_font_family : category_desc_font_family,
	   	category_desc_font_size : category_desc_font_size,
	   	category_desc_font_color : category_desc_font_color,
	   	category_bottom_margin : category_bottom_margin,
	   	category_padding : category_padding,
	   	top_bar_background_color : top_bar_background_color

	};

	sqb_gl_style_settings = getGlobalSettingLevelValues();
	var form_data = {
					id: id,
					quiz_name: encodeURIComponent(quiz_name) ,
					quiz_desc: encodeURIComponent(quiz_desc),
					quiz_type:  quiz_type,
					quiz_display: quiz_display,
					quiz_move_question: quiz_move_question,
					grade_quiz:  grade_quiz,
					question_display: question_display,
					number_of_question: number_of_question,
					url_select_popup : url_select_popup,
					quiz_pagination: quiz_pagination,
					question_per_page: question_per_page,
					result_display_option: result_display_option,
					show_start_screen: show_start_screen,
					show_result_screen: show_result_screen,
					show_opt_screen: show_opt_screen,
					show_share_screen: show_share_screen,
					autosubmit_optin: autosubmit_optin,
					opt_screen_position: opt_screen_position,
					user_opt_in_redirect: user_opt_in_redirect,
					user_added_platform:user_added_platform,
					add_user_in_your_email_platform:add_user_in_your_email_platform,
					template_display_sequence: template_display_sequence,
					start_temp_html: encodeURIComponent(start_temp_html),
					start_lead_customizer_styles: start_lead_customizer_styles,
					start_image: start_image,
					optin_temp_html: encodeURIComponent(optin_temp_html),
					result_temp_html: encodeURIComponent(result_temp_html),
					question_temp_html: encodeURIComponent(question_temp_html),
					quiz_timer: quiz_timer, 
					quiz_timer_limit: quiz_timer_limit,
					progress_bar:progress_bar,
					quiz_passmark: quiz_passmark,
					quiz_attempts_allowed: quiz_attempts_allowed,
					show_correct_ans: show_correct_ans,
					show_correct_ans_option: show_correct_ans_option,
					questions_random: questions_random,
					answers_random: answers_random,
					move_question: move_question,
					show_for_notloggedin_user: show_for_notloggedin_user,
					start_template_no: start_template_no,
					result_template_no: result_template_no,
					optin_template_no: optin_template_no,
					template_no: template_no,
					outcome_type:outcome_type,
					outcome_based:outcome_based,
					outcome_page:outcome_page,
					display_score_on_page:display_score_on_page,
					display_correctans_on_page:display_correctans_on_page,
					display_quesans_on_outcome:display_quesans_on_outcome,
					outcome_redirect_url:outcome_redirect_url,
					outcome_display_charts:outcome_display_charts,	
					enable_branching:enable_branching,		
					display_correctans_options:display_correctans_options,		
					show_next_button:show_next_button,
					show_back_btn_option:show_back_btn_option,
					select_quiz_bank:select_quiz_bank,
					limit_questions_displayed:limit_questions_displayed,
					limit_input:limit_input,
					already_take_the_quiz:already_take_the_quiz,
					total_attempts:total_attempts,
					template:template,
					startshowHide_video:startshowHide_video,
					video_url:video_url,
					common_style:common_style,
					quiz_display_url:quiz_display_url,
					quiz_display_in_url:quiz_display_in_url,
					quiz_time_delay:quiz_time_delay,
					quiz_popup_frequency:quiz_popup_frequency,
					quiz_popup_position:quiz_popup_position,
					quick_email_verification:quick_email_verification,
					quiz_slider_animation:quiz_slider_animation,
					quiz_slider_animation_option:quiz_slider_animation_option,
					sqb_quiz_allow_retake:sqb_quiz_allow_retake,
					sqb_quiz_many_attempts:sqb_quiz_many_attempts,
					sqb_quiz_max_attempts_limit:sqb_quiz_max_attempts_limit,
					quiz_timmer_array:quiz_timmer_array,
					enable_background_image:enable_background_image,
					all_mobile_view_layout:all_mobile_view_layout,
					quiz_category:quiz_category, 
					transparent_background_settings:transparent_background_settings,
					customizer_styles:customizer_styles,
					weighted_score:weighted_score,
					quiz_allow_pdf_download_outcome_screen:quiz_allow_pdf_download_outcome_screen,
					game_animation:game_animation,
					game_animation_template:game_animation_template,
					game_animation_custom_template:game_animation_custom_template,
					
					game_animation_background_color:game_animation_background_color,
					game_animation_audio_url:game_animation_audio_url,
					game_animation_timer:game_animation_timer,
					game_animation_text:game_animation_text,
					different_message_outcome:different_message_outcome,
					
					quiz_recommendation_enable:quiz_recommendation_enable,
					quiz_ads_enable:quiz_ads_enable,
					quiz_recommendation_next_button_html:quiz_recommendation_next_button_html,
					quiz_ads_next_button_html:quiz_ads_next_button_html,
					quiz_outcome_pdf_button_html:quiz_outcome_pdf_button_html,
					temp_global_theme_enable:temp_global_theme_enable,
					global_setting_style_status : global_setting_style,
					sqb_set_global_theme_style_values:sqb_set_global_theme_style_values,
					outer_style_status:outer_style_status,
					quiz_ans_tags:quiz_ans_tags,
					/*popup_type:popup_type,
					form_url_ids:form_url_ids,*/
					category_option:category_option,
					customizer_style_setting:customizer_style_setting,
					time_based_input:time_based_input,
					poll_settings:poll_settings,
					all_other_options:all_other_options,
					all_background_color:all_background_color,
					sqb_gl_style_settings : sqb_gl_style_settings,
					actionType:'save_quiz',
			}
			
		   var optin_screen_position = jQuery('input[name="optin-screen-position"]:checked').val()
		   var show_opt_screen = jQuery('input[name="show_opt_screen"]').prop('checked');
		   
		   if(next_tab != 'next'){
				jQuery('.quiz-save-btn').text('Please Wait...');
		   }else{
			  
			   if((quiz_type == "personality") || (quiz_type == "survey") ){
				   if( current_tab_name == 'start_tab' ){
					   tab_id = 'Result-Screen-Settings';
				   }else if( current_tab_name == 'outcome_tab' ){
					   if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Opt-Screen-Settings';
					   } else {
						tab_id = 'Quiz-Screen-Settings';
						}
				   }else if( current_tab_name == 'lead_generation_tab' ){
					   if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Quiz-Screen-Settings';
					   } else {
						tab_id = 'quiz_notification';
						var i = 1;
						jQuery('.studet_email_settings .outcome-count').empty();
						jQuery('.res_data_cont').each(function() {
							var outcome_id = jQuery(this).find("#outcome_id").val();
							if(outcome_id){
								jQuery('.studet_email_settings .outcome-count').append('<option value="'+outcome_id+'">OUTCOME '+i+'</option>');
								i++;
							}
						});
					}
				   }else if( current_tab_name == 'questions_tab' ){
					   if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'quiz_notification';
						var i = 1;
						jQuery('.studet_email_settings .outcome-count').empty();
						jQuery('.res_data_cont').each(function() {
							var outcome_id = jQuery(this).find("#outcome_id").val();
							if(outcome_id){
								jQuery('.studet_email_settings .outcome-count').append('<option value="'+outcome_id+'">OUTCOME '+i+'</option>');
								i++;
							}
						});
					   } else {
							if(show_opt_screen){
							tab_id = 'Opt-Screen-Settings';
							} else {
							tab_id = 'quiz_notification';
							var i = 1;
							jQuery('.studet_email_settings .outcome-count').empty();
							jQuery('.res_data_cont').each(function() {
								var outcome_id = jQuery(this).find("#outcome_id").val();
								if(outcome_id){
									jQuery('.studet_email_settings .outcome-count').append('<option value="'+outcome_id+'">OUTCOME '+i+'</option>');
									i++;
								}
							});
							}   
						}
				   }
				   
			   }else if(quiz_type == "poll"){

				   
				   if( current_tab_name == 'start_tab' ){
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Opt-Screen-Settings';
					  } else {
					   tab_id = 'Quiz-Screen-Settings';
					  }
				   }else if( current_tab_name == 'lead_generation_tab' ){
					   
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Quiz-Screen-Settings';
					  } else {
						tab_id = 'quiz_notification';
					  }
					  
				   }else if( current_tab_name == 'outcome_tab' ){
				   	if(show_opt_screen){
				   		if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						   	tab_id = 'quiz_notification';
						  } else {
							tab_id = 'Opt-Screen-Settings';
						  }
						}else{
							tab_id = 'create_quiz_advance';
						}
				   		 

				   }else if( current_tab_name == 'questions_tab' ){ 
						if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
							if(quiz_type == 'calculator'){
								tab_id = 'Formula-Screen';
								
							} else {
								tab_id = 'Result-Screen-Settings';
							}
						} else {	
							if(quiz_type == 'calculator'){
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Formula-Screen';
								}
							} else {
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Result-Screen-Settings';
								}
							}
						}	
				   } else if(current_tab_name == 'formula_tab'){
					   tab_id = 'Result-Screen-Settings';
				   }
			   
			   }else if(quiz_type == 'form'){

				   
				   if( current_tab_name == 'start_tab' ){
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Opt-Screen-Settings';
					  } else {
					   tab_id = 'Opt-Screen-Settings';
					  }
				   }else if( current_tab_name == 'lead_generation_tab' ){
					   
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Quiz-Screen-Settings';
					  } else {
						  
						 if(quiz_type == 'calculator'){
						   tab_id = 'Formula-Screen';
					     }else{
							 tab_id = 'Result-Screen-Settings';
						 }
						  
					   
					  }
					  
				   }else if( current_tab_name == 'outcome_tab' ){
						tab_id = 'quiz_notification';
				   }else if( current_tab_name == 'questions_tab' ){ 
						if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
							if(quiz_type == 'calculator'){
								tab_id = 'Formula-Screen';
								
							} else {
								tab_id = 'Result-Screen-Settings';
							}
						} else {	
							if(quiz_type == 'calculator'){
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Formula-Screen';
								}
							} else {
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Result-Screen-Settings';
								}
							}
						}	
				   } else if(current_tab_name == 'formula_tab'){
					   tab_id = 'Result-Screen-Settings';
				   }
			   
			   } else{
				   
				   if( current_tab_name == 'start_tab' ){
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Opt-Screen-Settings';
					  } else {
					   tab_id = 'Quiz-Screen-Settings';
					  }
				   }else if( current_tab_name == 'lead_generation_tab' ){
					   
					  if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
						tab_id = 'Quiz-Screen-Settings';
					  } else {
						  
						 if(quiz_type == 'calculator'){
						   tab_id = 'Formula-Screen';
					     }else{
							 tab_id = 'Result-Screen-Settings';
						 }
						  
					   
					  }
					  
				   }else if( current_tab_name == 'outcome_tab' ){
						tab_id = 'quiz_notification';
				   }else if( current_tab_name == 'questions_tab' ){ 
						if(optin_screen_position == 'optin-before-questions-screen' && show_opt_screen){
							if(quiz_type == 'calculator'){
								tab_id = 'Formula-Screen';
								
							} else {
								tab_id = 'Result-Screen-Settings';
							}
						} else {	
							if(quiz_type == 'calculator'){
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Formula-Screen';
								}
							} else {
								if(show_opt_screen){
									tab_id = 'Opt-Screen-Settings';
								} else {
									tab_id = 'Result-Screen-Settings';
								}
							}
						}	
				   } else if(current_tab_name == 'formula_tab'){
					   tab_id = 'Result-Screen-Settings';
				   }
			   }
			    sqb_next_tab(tab_id);
		   }
		   
			if(tab_id == 'Start-Screen-Settings'){
				sqbv2_start_screen_customizers();
			}else if(tab_id == 'Opt-Screen-Settings'){
				sqbv2_lead_screen_customizers();
			}else if(tab_id == 'Quiz-Screen-Settings'){
				sqbv2_question_screen_customizers();
			}else if(tab_id == 'Result-Screen-Settings'){
				sqbv2_result_screen_customizers();
			}else{
				sqbv2_other_screen_customizers();
			}
			SQBShowLoader();
  		
			
			jQuery.post(ajaxurl, {
					action: 'sqb_save_quiz',
					security: SQBSaveQuiz.sqbsavequiz,
					form_data: form_data,   
			}, function(response) {
				if(jQuery('#myDatepickerModal').hasClass('show')){
					jQuery(".month-day-save-msg").show().delay(5000).fadeOut();
				}

				response = JSON.parse(response);
				if(typeof response.error != 'undefined' && response.error != ''){
					swal(response.error);
					jQuery('.quiz-save-btn').text('Save');
					return false;
				}
				
				if(response.page_title != '' && typeof response.page_title != 'undefined'){
					jQuery('.show-page-title').empty();
					jQuery('.show-page-title').append(response.page_title);

					var substr = response.page_id_exist;
					if(substr){
						jQuery.each(substr , function(index, val) {
							jQuery('.sqb_form_selected_urls li[data-id="'+val+'"]').remove();
							jQuery('.sqb_form_pages_posts_list li[data-id="'+val+'"]').removeClass('active_page_posts_url');
						});

						jQuery('#showpagetitle').modal('show');
						jQuery('#Basic-Screen-Settings-tab').trigger('click');
					}
					
					//jQuery('.sqb_form_selected_urls li[data-id="236"]').remove();
				}
				
				if(tab_id == "Basic-Screen-Settings"){
					jQuery('#Basic-Screen-Settings-tab').trigger('click');
				}
				
					// save outcome data
				
			//resizable
			
			//eanble the resize
			//jQuery("#Start-Screen-Settings .question_img_div,#Opt-Screen-Settings .question_img_div, #Result-Screen-Settings .question_img_div,.sqb_questions_wrapper  .question_img_div").resizable('enable');
			//jQuery(".sqb_ans_item_img ").resizable('enable'); 
		   //sqb_resizeable();
		  // sqb_ans_resizeable();
		  
				jQuery('.start_temp_hidden').html('') ;
				jQuery('.optin_temp_hidden').html('') ;
				jQuery('.result_temp_hidden').html('') ;
				//jQuery('.question_temp_hidden').html('') ;
				//jQuery('.questions_data_hidden').html('') ;
				//jQuery('.answer_data_hidden').html('');
				
				
					//response = JSON.parse(response);
					if(response.success){
						jQuery('input[name="edit_id"]').val(response.last_id);
						//sqb_sweet_message('',response.success,'')
						
						
						if(response.quiz_name){
							jQuery('.sqb_detail_quiz_name').text(response.quiz_name);
						}
						
						
						if(response.quiz_type){
							jQuery('.sqb_detail_quiz_type').text(response.quiz_type);
						}
						if(response.shortcode){
							jQuery('.shortcode_display').text(response.shortcode);
						}
						if(response.embedCode){
							jQuery('.embedCodeOuterMain').html(response.embedCode);
						}
						
						if(response.quiz_add_branching_link){
							jQuery('#quiz_add_branching_link').attr('href',response.quiz_add_branching_link);
						}
						
					}  
					var quiz_id = response.last_id;
					
					//if(saveQues != 'no'){
						sqb_save_questions_and_answers(error, error_msg, next_tab,tab_id);
					//}
					
				if(response.success){  
					
					// save automation action
					jQuery('table.autoresponder_table_class').each(function(){
						jQuery(this).find('.add_new_automation_tr').each(function(){
							jQuery(this).removeClass('add_new_automation_tr');
							var data_info = jQuery(this).find('input[name="data_info"]').val();
							
							var data_info = JSON.parse(data_info);
							sqb_save_whole_automation_action(data_info,quiz_id);
						});
					});
					
					
					
					// dap store ifno 
					if(jQuery('input[name="add_user_quiz"][value="DAP"]').prop('checked')){
						sqb_save_dap_externel_data(quiz_id);
					}else{
						sqb_save_dap_externel_data(quiz_id, 'delete' );
					}

					if(jQuery('input[name="add_user_quiz"][value="SCP"]').prop('checked')){
						sqb_save_scp_externel_data(quiz_id);
					}else{
						sqb_save_scp_externel_data(quiz_id, 'delete' );
					}
					
					// Zapier store ifno 
					if(jQuery('input[name="add_user_quiz"][value="Zapier"]').prop('checked')){
						sqb_save_zapier_externel_data(quiz_id);
					}

					if(jQuery('input[name="add_user_quiz"][value="googlespreadsheet"]').prop('checked')){
						sqb_save_googlespreadsheet_externel_data(quiz_id);
					}

					// webhook store ifno 
					if(jQuery('input[name="add_user_quiz"][value="Webhook"]').prop('checked')){
						sqb_save_webhook_external_data(quiz_id, 'add');
					}else{
						sqb_save_webhook_external_data(quiz_id, 'delete');	
					}
					
					
					if(static_action == 'sqb_send_top_outcomes_save'){
						sqb_send_top_outcomes_save_inner();
					}
					
				}

				if(quiz_type == "form"){
					jQuery('.save_new_result').trigger('click');
				}
			});

	
	if(current_tab_name == 'quiz_notification'){
		save_email_notifications();
	}
	jQuery('.copy-email-error-msg').hide();
	jQuery('.email-error-msg').hide();


	setTimeout(function(){
		sqb_check_category_rules(id);
	}, 2000);
	
	if(current_tab_name == 'lead_generation_tab'){
		sqb_list_formula_shortcodes();
	}
}

function sqb_vote_button_customizer(){
	
	jQuery('#vote_btn_width').bootstrapSlider().change(function() {
		jQuery('.vote_button').css('width', +this.value + 'px');
	});

	jQuery('#vote_btn_radius').bootstrapSlider().change(function() {
		jQuery('.vote_button').css('border-radius', +this.value + 'px');
	});
	 
	jQuery('#vote_btn_height').bootstrapSlider().change(function() {
		jQuery('.vote_button').css('padding-top', +this.value + 'px');
		jQuery('.vote_button').css('padding-bottom', +this.value + 'px');
	});
	
	jQuery('#vote_button_backgroud_color_div,#vote_button_backgroud_color').colorpicker().on('changeColor', function() {
		jQuery('.vote_button').css('background-color', jQuery(this).colorpicker('getValue'));
	}); 
	
}

function sqbv2_other_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();
		jQuery('.sqbv2-template8-question').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();
	}

function sqbv2_start_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();
		jQuery('.sqb-inside-tempalte6').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();
		jQuery('.sqbv2-template8-question').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2'|| selected_template == 'template3'|| selected_template == 'template4'){
			jQuery('.sqb-start-screen-tempalte1').show();
			jQuery('.sqb-outcome-screen-tempalte1').hide();
			jQuery('.sqb-question-screen-tempalte1').hide();
			jQuery('.sqb-lead-screen-tempalte1').hide();

			jQuery('.sqb-template-customizer').show();
			jQuery('.sqb-element-customizer').show();

			jQuery('.sqbv2-template1').hide();

			if(selected_template == 'template3' || selected_template == 'template4'){
				jQuery('.sqb-start-screen-tempalte4').show();
			}else{
				jQuery('.sqb-start-screen-tempalte4').hide();
			}

			if(jQuery('#Start-Screen-Settings .element_customizer_wrapper_list.btn_customizer').find('.customizer_innner_sections').is(':hidden')){
				jQuery('#Start-Screen-Settings .element_customizer_wrapper_list.btn_customizer .Template-Customize_heading').trigger('click');
			}

		}else if(selected_template == 'template8'){
			jQuery('#Start-Screen-Settings .sqbv2-template1.Element-Customizer-Section').hide();
			if(jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == false){
				jQuery('.sqbv2-template8-start').show();
			}

			jQuery('#Start-Screen-Settings .sqbv2-template1.sqbv2-template5').hide();
			jQuery('#Start-Screen-Settings .sqb-start-screen-btn-customizers .customizer_innner_sections').show();

		}else if(selected_template == 'template5'){
			if(jQuery('.sqbv2-template5.Template-Customize-Setting').find('.customizer_innner_sections').is(':hidden')){
				jQuery('.sqbv2-template5 .Template-Customize_heading').trigger('click');
			}
			jQuery('#Start-Screen-Settings .template_5_background_img_customizer.Template-Customizer-Section .customizer_innner_sections').hide();
			jQuery('#Start-Screen-Settings .element_customizer_wrapper_list.btn_customizer .customizer_innner_sections').hide();
		}else if(selected_template == 'template6'){
			jQuery('#Start-Screen-Settings .sqb-start-screen-btn-customizers .customizer_innner_sections').show();

			jQuery('#Start-Screen-Settings .sqbv2-template1.Template-Customize-Setting').hide();
			jQuery('#Start-Screen-Settings .start_screen_background_customizer.template6_customizer').hide();
			jQuery('#Start-Screen-Settings .sqbv2-template6-start-screen.template6_customizer ').hide();

			jQuery('.sqbv2-template6-start').show();


		}else if(selected_template == 'template7'){
			jQuery('#Start-Screen-Settings .sqbv2-template1.button-template-hide').hide();
			jQuery('#Start-Screen-Settings .sqb-start-screen-btn-customizers .customizer_innner_sections').show();
		}
		jQuery('.sqb-start-screen-common').show();
		jQuery('.sqb-outcome-screen-common').hide();
		jQuery('.sqb-question-screen-common').hide();
	}

	function sqbv2_other_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();
		jQuery('.sqbv2-template8-question').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();
	}

	function sqbv2_result_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();
		jQuery('.sqbv2-template8-question').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2'|| selected_template == 'template3'|| selected_template == 'template4'){
			jQuery('.sqb-start-screen-tempalte1').hide();
			jQuery('.sqb-outcome-screen-tempalte1').show();
			jQuery('.sqb-question-screen-tempalte1').hide();
			jQuery('.sqb-lead-screen-tempalte1').hide();

			jQuery('.sqb-template-customizer').show();
			jQuery('.sqb-element-customizer').show();

			jQuery('.sqbv2-template1').hide();

			jQuery('#Outcome-Display .element_customizer_wrapper_list.btn_customizer .customizer_innner_sections').show('slow');
		}else if(selected_template == 'template8'){
			jQuery('.sqbv2-template1.Element-Customizer-Section').hide();

			jQuery('#Outcome-Display .sqbv2-template1.Template-Customize-Setting.hide_for_template6').hide();

			jQuery('#Outcome-Display .sqb-result-screen-btn-customizers .customizer_innner_sections').show();
			if(jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == false){
				jQuery('.sqbv2-template8-outcome').show();
			}
		}else if(selected_template == 'template6'){
			jQuery('#Outcome-Display .outcome-screen-background-customizer.sqbv2-template6-result-screen').hide();
			jQuery('#Outcome-Display .sqbv2-template1.Template-Customize-Setting').hide();
			jQuery('#Outcome-Display .outcome-screen-background-customizer').hide();
			jQuery('#Outcome-Display .sqb-result-screen-btn-customizers .customizer_innner_sections').show();

			jQuery('.sqbv2-template6-outcome').show();
		}else if(selected_template == 'template5'){
			jQuery('#Outcome-Display .sqbv2-template1.hide_for_template6 .customizer_innner_sections').show();
		}else if(selected_template == 'template7'){
			jQuery('#Outcome-Display .sqbv2-template1.Element-Customizer-Section').hide();
			jQuery('#Outcome-Display .sqb-result-screen-btn-customizers .customizer_innner_sections').show();
			
		}

		jQuery('.sqb-start-screen-common').hide();
		jQuery('.sqb-outcome-screen-common').show();
		jQuery('.sqb-question-screen-common').hide();
	}

	function sqbv2_question_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();
		jQuery('.sqbv2-template8-question').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();

		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2'|| selected_template == 'template3'|| selected_template == 'template4'){
			jQuery('.sqb-start-screen-tempalte1').hide();
			jQuery('.sqb-outcome-screen-tempalte1').hide();
			jQuery('.sqb-question-screen-tempalte1').show();
			jQuery('.sqb-lead-screen-tempalte1').hide();

			jQuery('.sqb-template-customizer').show();
			jQuery('.sqb-element-customizer').show();

			jQuery('.sqbv2-template1').hide();
			jQuery('.sqbv2-temlate1to4-button').show();

			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section').hide();
			jQuery('#Quiz-Screen-Settings .answer-template6-customizer.template9-customizer-options').hide();
		}else if(selected_template == 'template8'){
			jQuery('#Quiz-Screen-Settings .sqbv2-template1.Element-Customizer-Section').hide();
			jQuery('#Quiz-Screen-Settings .sqbv2-template6-question-screen.outcome-screen-background-customizer').hide();
			if(jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == false){
				jQuery('.sqbv2-template8-question').show();
			}

			jQuery('#Quiz-Screen-Settings .sqbv2-template1.Template-Customize-Setting.Template-Customizer-Section.hide_for_template6').hide();

			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section').hide();
			if(jQuery('#Quiz-Screen-Settings .continue-button-element-option').css('display') == 'none'){
				jQuery('.sqb-question-screen-btn-customizers .Template-Customize_heading').trigger('click');
			}
		}else if(selected_template == 'template5'){
			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section.Template-Customize-Setting').hide();
			jQuery('#Quiz-Screen-Settings .sqbv2-template1.hide_for_template6 .customizer_innner_sections').show();

		}else if(selected_template == 'template6'){
			jQuery('#Quiz-Screen-Settings .outcome-screen-background-customizer.sqbv2-template6-question-screen').hide();
			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section.Template-Customize-Setting').hide();
			jQuery('#Quiz-Screen-Settings .outcome-screen-background-customizer').hide();
			jQuery('#Quiz-Screen-Settings .answer-template6-customizer.template9-customizer-options').hide();
			jQuery('#Quiz-Screen-Settings .sqb-question-screen-btn-customizers .customizer_innner_sections').show();

			jQuery('.sqbv2-template6-question').show();
		}else if(selected_template == 'template7'){
			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section.Template-Customize-Setting').hide();
			jQuery('#Quiz-Screen-Settings .sqb-question-screen-btn-customizers .customizer_innner_sections').show();
		}else if(selected_template == 'template9'){
			jQuery('#Quiz-Screen-Settings .template8-Answer-Customizer-Section.Template-Customize-Setting').hide();
		}

		jQuery('.sqb-start-screen-common').hide();
		jQuery('.sqb-outcome-screen-common').hide();
		jQuery('.sqb-question-screen-common').show();
	}

	function sqbv2_lead_screen_customizers(){
		jQuery('.sqb-template-customizer').hide();
		jQuery('.sqb-element-customizer').hide();

		jQuery('.sqbv2-template8-start').hide();
		jQuery('.sqbv2-template8-outcome').hide();
		jQuery('.sqbv2-template8-lead').hide();

		jQuery('.sqbv2-template6-question').hide();
		jQuery('.sqbv2-template6-outcome').hide();
		jQuery('.sqbv2-template6-start').hide();
		
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2'|| selected_template == 'template3'|| selected_template == 'template4'){
			jQuery('.sqb-start-screen-tempalte1').hide();
			jQuery('.sqb-outcome-screen-tempalte1').hide();
			jQuery('.sqb-question-screen-tempalte1').hide();
			jQuery('.sqb-lead-screen-tempalte1').show();

			jQuery('.sqb-template-customizer').show();
			jQuery('.sqb-element-customizer').hide();
			jQuery('.sqbv2-template1').hide();
			jQuery('#sqb_lead_generation .sqbv2-template-type.btn_customizer .customizer_innner_sections').show();
		}else if(selected_template == 'template6'){
			jQuery('#sqb_lead_generation .sqbv2-template1.Template-Customize-Setting').hide();
			jQuery('#sqb_lead_generation .sqbv2-template-type.btn_customizer .customizer_innner_sections').show();
			jQuery('#sqb_lead_generation .sqbv2-template1.hide_for_global_theme_enabled1').hide();
		}else if(selected_template == 'template8'){
			jQuery('#sqb_lead_generation .sqbv2-template-type.btn_customizer .customizer_innner_sections').show();
			jQuery('#sqb_lead_generation .sqbv2-template1.hide_for_global_theme_enabled1 .customizer_innner_sections').hide();
			if(jQuery('#sqb_enable_inner_customizer_template8').prop('checked') == false){
				jQuery('.sqbv2-template8-lead').show();
			}
			jQuery('#sqb_lead_generation .sqbv2-template1.Template-Customize-Setting.hide_for_global_theme_enabled1.hide_for_template9').hide();
		}else if(selected_template == 'template9'){
			jQuery('#sqb_lead_generation .template9-optin-custimzer-settings .customizer_innner_sections').hide();
			jQuery('#sqb_lead_generation .sqbv2-template-type.btn_customizer .customizer_innner_sections').show();
		}else if(selected_template == 'template5'){
			jQuery('#sqb_lead_generation .sqbv2-template-type.element_customizer_wrapper_list .customizer_innner_sections').show();
			jQuery('#sqb_lead_generation .sqbv2-template1.hide_for_template9').hide();
			jQuery('#sqb_lead_generation .element_customizer_wrapper_list.assessmentScoringOuter').hide();
		}else if(selected_template == 'template7'){
			jQuery('#sqb_lead_generation .sqbv2-template-type .customizer_innner_sections').show();
			jQuery('.sqbv2-template1.hide_for_global_theme_enabled1.hide_for_template9').hide();
		}
	}

function sqb_check_category_rules(id){
	if(jQuery('#Result-Screen-Settings-tab').hasClass('active') && jQuery('#quiz_category_enable').prop('checked') == true && (jQuery('input[name="outcome_based"]:checked').val() == 'category')){
		jQuery.post(ajaxurl, {
		action: 'sqb_check_category',
		quiz_id: id,
		
		}, function(response) {
			response = JSON.parse(response);
			if(response.output == 'no_data'){
				jQuery('#Result-Screen-Settings-tab').trigger('click');
				jQuery("html, body").animate({ scrollTop: 0 }, "slow");
				jQuery('.show-category-message').show();
				jQuery('.quiz_advanced_rule').trigger('click');
			}else{
				jQuery('.show-category-message').hide();
			}

			if(response.output_data == 'has_data'){
				jQuery('.listing-category-mapping').html('');
			}else{
				jQuery('.listing-category-mapping').html(response.output_data);
			}
		});		
	}
}

function sqbrgba2hex(color){
 var values = color
    .replace(/rgba?\(/, '')
    .replace(/\)/, '')
    .replace(/[\s+]/g, '')
    .split(',');
  var a = parseFloat(values[3] || 1),
      r = Math.floor(a * parseInt(values[0]) + (1 - a) * 255),
      g = Math.floor(a * parseInt(values[1]) + (1 - a) * 255),
      b = Math.floor(a * parseInt(values[2]) + (1 - a) * 255);
  return "#" +
    ("0" + r.toString(16)).slice(-2) +
    ("0" + g.toString(16)).slice(-2) +
    ("0" + b.toString(16)).slice(-2);
}

function sqb_save_webhook_external_data(quiz_id = 0, type){
	var secret_key = jQuery('#webhook_secret_key').val();
	var webhook_url = jQuery('#webhook_url').val();
    jQuery('.webhook_url_validations').remove();
	var error_msg = '';
	if(type == 'add'){
		/*if(secret_key == ''){
			error_msg += '<div class="question_validations webhook_url_validations">Webhook Secret Key cannot be empty</div>';
		}*/
		if(webhook_url == ''){
			error_msg += '<div class="question_validations webhook_url_validations">Webhook URL cannot be blank</div>';
		}

		/*if((webhook_url != '') &&  webhook_url.indexOf(".php") == -1){
			error_msg += '<div class="question_validations webhook_url_validations">Webhook URL is not correct</div>';
		}*/

		if(error_msg != ''){
			
			if(type == 'add'){
				jQuery('.question_error_msg_outer').append(error_msg);
				return false;
			}
		}
	}

	jQuery.post(ajaxurl, {
		action: 'sqb_save_webhook_url',
		security: SQBSaveQuiz.sqbSaveWebhookUrl,
		webhook_url:webhook_url,
		secret_key:secret_key,
		quiz_id:quiz_id,
		type:type,
		
	}, function(response) {
		//response = JSON.parse(response);	
	});	
}


function sqb_save_zapier_externel_data(quiz_id = 0){
	
	var product_id = jQuery('select[name="sel_dap_prods1"]').val();
	var zapier_url = jQuery('#zapier_url').val();
	jQuery.post(ajaxurl, {
				action: 'sqb_save_zapier_url',
				zapier_url:zapier_url,
				quiz_id:quiz_id,
				
			}, function(response) {
				//response = JSON.parse(response);	
			});
	
}

function sqb_save_googlespreadsheet_externel_data(quiz_id = 0){
	var googlespreadsheet_url = jQuery('#googlespreadsheet_url').val();
	jQuery.post(ajaxurl, {
				action: 'sqb_save_googlespreadsheet_url',
				googlespreadsheet_url:googlespreadsheet_url,
				quiz_id:quiz_id,
				
			}, function(response) {
				//response = JSON.parse(response);	
			});
	
}

function sqb_save_dap_externel_data(quiz_id = 0,type = 'add'){
	
	var product_id = jQuery('select[name="sel_dap_prods1"]').val();
	jQuery.post(ajaxurl, {
				action: 'sqb_save_dap_external_plateform',
				security: SQBSaveQuiz.sqbSavedapPlatform,
				product_id:product_id,
				quiz_id:quiz_id,
				type:type,
				
			}, function(response) {
				//response = JSON.parse(response);	
				
			});
	
}

function sqb_save_scp_externel_data(quiz_id = 0,type = 'add'){
	
	var product_id = jQuery('select[name="sel_scp_prods1"]').val();
	jQuery.post(ajaxurl, {
				action: 'sqb_save_scp_external_plateform',
				security: SQBSaveQuiz.sqbSavescpPlatform,
				product_id:product_id,
				quiz_id:quiz_id,
				type:type,
				
			}, function(response) {
				//response = JSON.parse(response);	
				
			});
	
}

function sqb_question_title_validatin(){
	var flag = false;
	if(jQuery('.ques_ans_contain .sqb_question_enable_drag_drop').length > 0){
		jQuery('.ques_ans_contain .sqb_question_enable_drag_drop').each(function(index_question){
			var question_title = jQuery(this).closest('.question_div_outer').find('.question_details').find('.question_title').text();
			
			if(question_title == "Enter Your Question Here"){
			   var question_tab_id = jQuery(this).closest('.sqb_question_no').attr('id');
			  
			   jQuery('.left_side_question_list').find('a[href="#'+question_tab_id+'"]').trigger('click');	
			    var question_tab_id = jQuery(this).closest('.sqb_question_no').addClass(' active show ');
				flag = true;	
				sqb_next_tab('Quiz-Screen-Settings');
				swal("","Please enter a question title","");
				jQuery('.Question_temp_static_div .have-no-quiz').hide();
				jQuery('.Question_temp_static_div .left_side_question_list').show();
				jQuery('.Question_temp_static_div .ques_ans_contain').show();
				return false;
			}
			
			if((jQuery('input[name="quiz_type"]:checked').val() == "assessment") || (jQuery('input[name="quiz_type"]:checked').val() == "scoring")){
				var selected_template = jQuery('input[name="select_temp"]:checked').val();
				if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
					var ques_type = jQuery(this).closest('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
				}else{
					var ques_type = jQuery(this).closest('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
				}
		
				if(ques_type == 'multi' || ques_type == 'single' || ques_type == 'yes_no'){
					 var correct_ans_not_checked = true;
					 jQuery(this).closest('.question_div_outer').find('.sqb_ans_item').each(function() {
					
						var sqb_is_right_ans = jQuery(this).find('input[type="checkbox"].sqb_is_right_ans').prop('checked');
						if(sqb_is_right_ans){
							correct_ans_not_checked = false;
						}
						if(jQuery(this).hasClass('sqb_ans_item_dropdown')){
							correct_ans_not_checked = false;
						}
					});
					
					if(jQuery('input[name="quiz_type"]:checked').val() == "scoring"){
						if(jQuery('.correct_ans_display input:checked').val() =='no'){	
							correct_ans_not_checked = false;
						}
					}
					 
					if(correct_ans_not_checked){
						 var question_tab_id = jQuery(this).closest('.sqb_question_no').attr('id');
						   jQuery('.left_side_question_list').find('a[href="#'+question_tab_id+'"]').trigger('click');	
							var question_tab_id = jQuery(this).closest('.sqb_question_no').addClass(' active show ');
							flag = true;	  
							sqb_next_tab('Quiz-Screen-Settings');
							swal("","Please check the box next to the correct answer.","");
							jQuery('.Question_temp_static_div .have-no-quiz').hide();
							jQuery('.Question_temp_static_div .left_side_question_list').show();
							jQuery('.Question_temp_static_div .ques_ans_contain').show();
							return false;
					}
					 
			  }
			}
			
			
		});
		
	}
	return flag;
	
}

function single_question_validation(){
	var flag = false;
	var question_title = jQuery('.sqb_question_no.active').find('.question_title').text();
	
	if(question_title == "Enter Your Question Here" || question_title == ''){
	   var question_tab_id = jQuery('.sqb_question_no.active').closest('.sqb_question_no').attr('id');
	  
	   jQuery('.left_side_question_list').find('a[href="#'+question_tab_id+'"]').trigger('click');	
	    var question_tab_id = jQuery('.sqb_question_no.active').closest('.sqb_question_no').addClass(' active show ');
		flag = true;	
		sqb_next_tab('Quiz-Screen-Settings');
		swal("","Please enter a question title","");
		jQuery('.Question_temp_static_div .have-no-quiz').hide();
		jQuery('.Question_temp_static_div .left_side_question_list').show();
		jQuery('.Question_temp_static_div .ques_ans_contain').show();
		return flag;
	}
	
	if((jQuery('input[name="quiz_type"]:checked').val() == "assessment") || (jQuery('input[name="quiz_type"]:checked').val() == "scoring")){
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
			var ques_type = jQuery('.sqb_question_no.active').closest('.question_div_outer').find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}else{
			var ques_type = jQuery('.sqb_question_no.active').closest('.question_div_outer').find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}

		if(ques_type == 'multi' || ques_type == 'single' || ques_type == 'yes_no'){
			 var correct_ans_not_checked = true;
			 jQuery('.sqb_question_no.active').closest('.question_div_outer').find('.sqb_ans_item').each(function() {
			
				var sqb_is_right_ans = jQuery('.sqb_question_no.active').find('input[type="checkbox"].sqb_is_right_ans').prop('checked');
				if(sqb_is_right_ans){
					correct_ans_not_checked = false;
				}
				if(jQuery('.sqb_question_no.active').hasClass('sqb_ans_item_dropdown')){
					correct_ans_not_checked = false;
				}
			});
			
			if(jQuery('input[name="quiz_type"]:checked').val() == "scoring"){
				if(jQuery('.correct_ans_display input:checked').val() =='no'){	
					correct_ans_not_checked = false;
				}
			}
			 
			if(correct_ans_not_checked){
				 var question_tab_id = jQuery('.sqb_question_no.active').closest('.sqb_question_no').attr('id');
				   jQuery('.left_side_question_list').find('a[href="#'+question_tab_id+'"]').trigger('click');	
					var question_tab_id = jQuery('.sqb_question_no.active').closest('.sqb_question_no').addClass(' active show ');
					flag = true;	  
					sqb_next_tab('Quiz-Screen-Settings');
					swal("","Please check the box next to the correct answer.","");
					jQuery('.Question_temp_static_div .have-no-quiz').hide();
					jQuery('.Question_temp_static_div .left_side_question_list').show();
					jQuery('.Question_temp_static_div .ques_ans_contain').show();
					return flag;
			}
			 
	  }
	}		
	return flag;
}

function sqb_copy_to_clipboard(obj) {
	jQuery(obj).text('Copied');
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy"); 
	document.body.removeChild(aux);

	setTimeout(function() {
		jQuery(obj).html('<i class="fa fa-files-o" aria-hidden="true"></i> Copy');
	}, 2000);
}

function sqb_copy_to_clipboard_merge_tags(obj) {
	jQuery(obj).text('Copied');
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	aux.setAttribute("value", document.getElementById(elementId).innerHTML);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy"); 
	document.body.removeChild(aux);

	setTimeout(function() {
		jQuery(obj).html('<i class="fa fa-files-o" aria-hidden="true"></i>');
	}, 2000);
}


function sqb_copy_data(containerid) {
	var range = document.createRange();
	range.selectNode(containerid); //changed here
	window.getSelection().removeAllRanges(); 
	window.getSelection().addRange(range); 
	document.execCommand("copy");
	window.getSelection().removeAllRanges();
	
}


function SQBCopyToClipboard(containerid) {
 
    var range = document.createRange();
    document.getElementById(containerid).style.display = "block";
    range.selectNode(document.getElementById(containerid));
    window.getSelection().addRange(range);
   	// document.execCommand("Copy");
	console.log(document.execCommand("Copy"));
    document.getElementById(containerid).style.display = "none";
    var existing =  document.getElementById("replace-code");
    jQuery(existing).text('Copied');
  
}

function sqb_external_copy_to_clipboard(obj) {
	
	jQuery(obj).text('Copied');
	//jQuery('#embedCodeModal').modal('hide')
	var elementId = jQuery(obj).attr("data-id");
	var aux = document.createElement("input");
	var externalScript = jQuery('#copyEmbedCodeOuter').text();
	aux.setAttribute("value", externalScript);
	document.body.appendChild(aux);
	aux.select();
	aux.focus({preventScroll: true});
	document.execCommand("copy"); 
	document.body.removeChild(aux);
}

function sqb_personality_validations() {
	var contected_var ="";
	
	var question_html ="";
	var i = 1;
	jQuery(".ques_ans_contain .question_div_outer").each(function(){
		var parent_selector = jQuery(this);
		var q_id =jQuery(this).attr('id');
		var showError = false;
		var question_title =jQuery(this).find(".question_title").text();
		var answer_html ="";

		var ques_type = jQuery(this).find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		
		var skip_outcome_mapping = 'N';
		
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template8' || selected_template == 'template6' || selected_template == 'template9'){
			var ques_type = jQuery(this).find('.template8_question_screen_setting_options_wrapper').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}else{
			var ques_type = jQuery(this).find('.quiz_comon_template').find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');
		}

		if((quiz_type == 'personality') && ((ques_type == 'single') || (ques_type == 'multi') || (ques_type == 'yes_no') || (ques_type == 'rating') || (ques_type == 'matrix'))){
			if(jQuery(this).find('.assessment_outcome_connect_btn .outcome-option-skip').hasClass('outcome-option-active')){
				skip_outcome_mapping = 'Y';
			}
		}

		if(ques_type != 'text' && ques_type != 'date' && ques_type != 'phone_number' && ques_type != 'email' && ques_type != 'date' && ques_type != 'file_upload' && ques_type != 'slider' && (skip_outcome_mapping != 'Y') && ques_type != 'matrix' && ques_type != 'ranking_choices' && ques_type != 'numerical_text' && ques_type != 'matching_text' && ques_type != 'dropdown' && ques_type != 'weight_and_height' && ques_type != 'name'){
  
			 jQuery(this).find(".sqb_ans_item").each(function(){
				var a_id =jQuery(this).attr('id');
				var ans_title =jQuery(parent_selector).find("#"+a_id+" .sql_ans_text").text();
				if(jQuery("#"+q_id+" .ans_id_attr_"+a_id+ " .custom-checkbox-input:checked").length > 0){
					 contected_var = "Connected"; 
				}else{
					contected_var = "Not Connected"; 
				}
				if(contected_var == 'Not Connected'){
					showError = true;
					answer_html += '<div class="ans_title"><strong><span style="color: #e81111;">'+ ans_title+" </span></strong> : "+contected_var+'</div>';
				}
			   //custom-checkbox-input
			});
		}

		if(showError){
			question_html += '<div class="ques_title"><strong>Question '+i+' : </strong>'+question_title+'</div><div class="ans_validations">'+answer_html+'</div>';
		}
		i++;
	});
	return question_html;
}



function sqb_assessment_validations(){
	var contected_var ="";
	var answer_html ="";
	var question_html ="";
	var i = 1;
	jQuery(".ques_ans_contain .question_div_outer").each(function(){
		
		var ques_type = jQuery(this).find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');

		if(ques_type == 'multi'){
			var q_id =jQuery(this).attr('id');
			var question_title =jQuery("#"+q_id+" .question_title").text();
			var showError = true;
			var showErrorQues = question_title;
			jQuery("#"+q_id+" .sqb_ans_item").each(function(){
				if(jQuery(this).find('.sqb_is_right_ans').prop('checked') == true){
					showError = false;
				}
			});
			if(showError){
				question_html += '<div class="ques_title"><strong>Question '+i+' : </strong>'+question_title+'</div><div class="ans_validations"><strong><span style="color: #e81111;">No correct answer checked</span></strong></div>';
			}
			i++;
		}
	});
	
	//jQuery(".quiz-actions").before('<div class=" question_validations">'+question_html+'</div>');
	return question_html;
}

function sqb_scoring_validations(){
	var contected_var ="";
	var answer_html ="";
	var question_html ="";
	var i = 1;
	jQuery(".ques_ans_contain .question_div_outer").each(function(){
		
		var ques_type = jQuery(this).find('.question_type_wrapper').find('button.dropdown-toggle').attr('data-value');

		if(ques_type == 'multi' || ques_type == 'single' || ques_type == 'yes_no' || ques_type == 'numerical_text'){
			var q_id =jQuery(this).attr('id');
			var question_title =jQuery("#"+q_id+" .question_title").text();
			var showError = true;
			var showErrorQues = question_title;
			jQuery("#"+q_id+" .sqb_ans_item").each(function(){
				var ans_poins = jQuery(this).find('input[name=ans_poins]').val();
				if(ans_poins != ''){
					showError = false;
				}
			});
			if(showError){
				question_html += '<div class="ques_title"><strong>Question '+i+' : </strong>'+question_title+'</div><div class="ans_validations"><strong><span style="color: #e81111;">No points assigned</span></strong></div>';
			}
		}
		i++;
	});
	
	//jQuery(".quiz-actions").before('<div class=" question_validations">'+question_html+'</div>');
	return question_html;
}

function sqb_range_validations(){
	var contected_var ="";
	var answer_html ="";
	var question_html ="";
	var i = 1;
	jQuery(".ques_ans_contain .question_div_outer").each(function(){
		var q_id =jQuery(this).attr('id');
		var question_title =jQuery("#"+q_id+" .question_title").text();
		var showError = true;
		var showErrorQues = question_title;
		jQuery("#"+q_id+" .sqb_ans_item").each(function(){
			var ans_poins = jQuery(this).find('input[name=ans_poins]').val();
			if(jQuery(this).find('.sqb_is_right_ans').prop('checked') == true && ans_poins != ''){
				showError = false;
			}
		});
		if(showError){
			question_html += '<div class="ques_title"><strong>Question '+i+': </strong>'+question_title+'</div><div class="ans_validations">'+answer_html+'</div>';
		}
		i++;
	});
	
	//jQuery(".quiz-actions").before('<div class=" question_validations">'+question_html+'</div>');
	return question_html;
}


function sqbsetansweridstooutcome(){
	var edit_id = jQuery('#edit_id').val();
	var quiz_type = jQuery('input[name=quiz_type]:checked').val();

	if(edit_id != '' && edit_id != 0 && quiz_type == 'personality'){
		SQBShowLoader();
		// This code creating issue with the Edit Recommendation not showing content with prebuilt
		/*jQuery('.question_div_inner .question_add_answer_outer_div .sqb_ans_item').each(function(){
			var sqb_datetime = new Date();
			var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);

			jQuery(this).attr('id', sqb_round_no);
			jQuery(this).find( "[class*='img_']").removeClass();
			jQuery(this).find('img').addClass('sbq_change_img img_'+sqb_round_no);
			jQuery(this).find('img').attr('data-class', 'img_'+sqb_round_no);
			jQuery(this).find('.sqb_is_right_ans_checkbox_outer .checkbox-custom-style input').attr('name', 'sqb_is_right_ans_'+sqb_round_no);
			jQuery(this).find('.sqb_ans_delete_btn').attr('data-id', sqb_round_no);
		});*/

		jQuery('.question_div_inner .question_add_answer_outer_div .sqb_ans_item').each(function(){
			var dataId = jQuery(this).data('id');
			var id = jQuery(this).attr('id');
           jQuery(this).closest('.question_div_inner').find('.assessment_outcome_connect').find('.quiz-content-card').each(function(){
					
					if(jQuery(this).attr('data-answer-id') == dataId){
						jQuery(this).addClass('ans_id_attr_'+id);
					}
				});
		});
		SQBHideLoader();
	}
}

function sqb_text_tiny_mce_editor(){}

function sqb_answer_delete_by_question_id(question_id = 0,question_outer_selector_id = ''){    
	jQuery.post(ajaxurl, {
		action: 'sqb_quiz_answer_delete_by_question_id',
		question_id: question_id,   
		}, function(response) {	
			response = JSON.parse(response);
	});
	
}


function sbq_question_add_more_rating_btn(){
		
	jQuery(document).on('click','.add_more_rating_btn',function(){    
		jQuery(this).closest('.question_div_outer').find('.question_add_more_ans_btn').trigger('click')

	});
		
}


function sbq_question_delete_add_image_btn(){
	
	jQuery(document).on('click' , '.sqbDeleteQuesTemplateImage' , function(e){
		e.preventDefault();
        jQuery('.sqb_question_no.active .question_img_div').hide();
		jQuery('.sqb_question_no.active .question_img_div img').remove();
		jQuery('.sqb_question_no.active .sqbAddQuesTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
	});
	
	jQuery(document).on('click' , '.sqbAddQuesTemplateImage' , function(e){
		e.preventDefault();
		//var sqb_datetime = new Date();
		//var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
		//var current_date_time_img_outer = "sbq_img_outer_"+sqb_round_no;
		
        var img_src = jQuery(this).attr('attr-img-src');
        jQuery('.sqb_question_no.active .question_img_div').show();
		jQuery('.sqb_question_no.active .question_img_div').prepend('<img  src="'+img_src+'">');
		jQuery('.sqb_question_no.active .question_img_div img').addClass('sqb_img_draggable'); 
		jQuery('.sqb_question_no.active .sqbDeleteQuesTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
		sqb_ans_resizeable();

	});
	
}

function set_question_template_width(){
	var start_template = jQuery('#start_template').val();
	var use_global_style = jQuery('#use_global_style').val();
	if(start_template == 'Y' && use_global_style == 'Y'){
		var display_type = jQuery('input[name="quiz_display"]:checked').val();
		var temp_name = jQuery('input[name="select_temp"]:checked').val();
		if(display_type == 'corner_popup' && temp_name != 'template4'){
		var template_width = jQuery('#start_temp_width').val();
		var start_template_alignment = jQuery('#start_temp_alignment').val();
		var start_temp_backgroud_color = jQuery('#start_temp_backgroud_color').val();
		var start_temp_br_wid = jQuery('#start_temp_br_wid').val();
		var start_temp_br_style = jQuery('#start_temp_br_style').val();
		var start_temp__br_clr = jQuery('#start_temp__br_clr').val();
		
		var start_temp_spread_radius = jQuery('#start_temp_spread_radius').val();
		var start_temp_blur_radius = jQuery('#start_temp_blur_radius').val();
		var start_temp_hor_lnth = jQuery('#start_temp_hor_lnth').val();
		var start_temp_ver_lnth = jQuery('#start_temp_ver_lnth').val();
		var start_temp_shad_clr = jQuery('#start_temp_shad_clr').val();
		
		var startbtn_width = jQuery('#startbtn_width').val();
		var startbtn_height = jQuery('#startbtn_height').val();
		var startbutton_backgroud_color = jQuery('#startbutton_backgroud_color').val();
		
		var question_temp_width = jQuery("#question_temp_width");
		question_temp_width.bootstrapSlider('setValue', template_width);//700
		var question_template_outer = jQuery('.Template-Customize-content_question').find('.Quiz-Template');
			question_template_outer.css('max-width',template_width+'px');
		
		jQuery('#question_temp_alignment').val(start_template_alignment);
		question_template_outer.css('text-align', start_template_alignment);
		jQuery('#question_temp_backgroud_color').colorpicker('setValue', start_temp_backgroud_color);
		
		jQuery('#question_temp_br_clr').colorpicker('setValue', start_temp__br_clr);
		jQuery('#question_temp_br_wid').bootstrapSlider('setValue', start_temp_br_wid);
		jQuery('#question_temp_br_style').val(start_temp_br_style);
		
		question_template_outer.css('border-width',start_temp_br_wid+'px');
		question_template_outer.css('border-style',start_temp_br_style);
		
		jQuery('#question_temp_spread_radius').bootstrapSlider('setValue', start_temp_spread_radius);
		jQuery('#question_temp_blur_radius').bootstrapSlider('setValue', start_temp_blur_radius);
		jQuery('#question_temp_hor_lnth').bootstrapSlider('setValue', start_temp_hor_lnth);
		jQuery('#question_temp_ver_lnth').bootstrapSlider('setValue', start_temp_ver_lnth);
		question_template_outer.css('box-shadow', start_temp_shad_clr+' '+start_temp_hor_lnth+'px '+start_temp_ver_lnth+'px '+start_temp_blur_radius+'px '+start_temp_spread_radius+'px');
		jQuery('#question_temp_shad_clr').colorpicker('setValue', start_temp_shad_clr);
		
		question_template_outer.find('div.question_title').css('font-size','18px');
		question_template_outer.find('div.question_title div').css('font-size','18px');
		question_template_outer.find('span.sqbHideQuesDescriptionOuter').hide();
		question_template_outer.find('span.sqbShowQuesDescriptionOuter').show();
		question_template_outer.find('.Quiz-Template-content').hide();
		
		}
		
	} else {
		var display_type = jQuery('input[name="quiz_display"]:checked').val();
		
		if(display_type == 'corner_popup'){
			
			var temp_name = jQuery('input[name="select_temp"]:checked').val();
			if(temp_name == 'template4'){
				jQuery('.Template-Customize-content_question .sqb_question_no.active .question_div_inner .outer-style3').css('max-width','400px');
			} else {
				jQuery('.Template-Customize-content_question .sqb_question_no.active .question_div_inner .Quiz-Template').css('max-width','400px');
			}
			jQuery('.ques_ans_contain  #question_temp_width').bootstrapSlider('setValue', 400);
			var question_template_outer = jQuery('.Template-Customize-content_question .sqb_question_no.active .question_div_inner .Quiz-Template');
			question_template_outer.find('div.question_title').css('font-size','18px');
			question_template_outer.find('div.question_title div').css('font-size','18px');
			question_template_outer.find('span.sqbHideQuesDescriptionOuter').hide();
			question_template_outer.find('span.sqbShowQuesDescriptionOuter').show();
			question_template_outer.find('.Quiz-Template-content').hide();
		}
	}
	jQuery('.Template-Customize-content_question .sqb_question_no.active .question_div_inner .Quiz-Template .question_add_more_ans_btn').trigger('click');
}

function sqb_search_multiple_select_url(){
jQuery("#sqb_search_multiple_select").keyup(function() {
	var allpostlist = [];
	var str2 = jQuery(this).val().toLowerCase();	 
	var i = 0;
	jQuery("ul.sqb_select_urls li").each(function() {
		var str1 = jQuery(this).text().toLowerCase();
		if (str1.indexOf(str2) != -1) {
			allpostlist[i++] = jQuery(this).attr("data-value");
		}
	});

	jQuery("ul.sqb_select_urls li").each(function() {
		if (jQuery.inArray(jQuery(this).attr("data-value"), allpostlist) !== -1) {
			jQuery(this).show();
		} else {
			jQuery(this).hide();
		}
	});

});

jQuery("#sqb_form_search_multiple_select").keyup(function() {
	var allpostlist = [];
	var str2 = jQuery(this).val().toLowerCase();	 
	var i = 0;
	jQuery("ul.sqb_select_urls li").each(function() {
		var str1 = jQuery(this).text().toLowerCase();
		if (str1.indexOf(str2) != -1) {
			allpostlist[i++] = jQuery(this).attr("data-value");
		}
	});

	jQuery("#Basic-Screen-Settings ul.sqb_form_select_urls li").each(function() {
		if (jQuery.inArray(jQuery(this).attr("data-value"), allpostlist) !== -1) {
			jQuery(this).show();
		} else {
			jQuery(this).hide();
		}
	});

});

}

function sqb_answer_type_slider_event(){
	
	// edit mode create slider
	jQuery(document).find('.Question-Answer-accordion .sqb_question_no .type-slider-outer').each(function(){
   
		if(jQuery(this).find('#ex1Slider').length == 0){
			var slider_id = jQuery(this).find('.sqb_ans_slider').attr('id');
			//jQuery("#"+slider_id).bootstrapSlider();
			var  slider_b_clr = jQuery("#"+slider_id).attr('slider_b_clr');
			var  complete_bar_b_clr =jQuery("#"+slider_id).attr('complete_bar_b_clr');
			var  top_box_b_clr = jQuery("#"+slider_id).attr('top_box_b_clr');
			var  prefix_text = jQuery("#"+slider_id).attr('prefix_text');
			var  suffix_text = jQuery("#"+slider_id).attr('suffix_text');
			if(prefix_text == undefined){
				prefix_text = '';
			}
			
			if(suffix_text == undefined){
				suffix_text = '';
			}
			jQuery("#"+slider_id).bootstrapSlider({formatter: function(value) {
				return prefix_text+ value+suffix_text ;
			}});
			
			
			var slider_selector = jQuery("#"+slider_id).closest('.type-slider-outer');
			slider_selector.find('.slider.slider-horizontal .slider-track').css('background-color',slider_b_clr);
			slider_selector.find('.slider.slider-horizontal .slider-handle').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .slider-track .slider-selection').css('background-color',complete_bar_b_clr)
			slider_selector.find('.slider.slider-horizontal .tooltip .tooltip-inner').css('background-color',top_box_b_clr );
			
		
		}
	})
	jQuery(document).on('keyup, change','#ans_slider_max_value',function(){
		var max_value = jQuery(this).val();
		var slider_ans_id = jQuery('.sqb_question_no.active .sqb_ans_item .sqb_ans_slider').attr('id');
		
		jQuery('#'+slider_ans_id).attr('data-slider-max', max_value);
		sqb_question_type_slider_init(slider_ans_id);
	});
	jQuery(document).on('keyup, change','#ans_slider_min_value',function(){
		var min_value = jQuery(this).val();
		var slider_ans_id = jQuery('.sqb_question_no.active .sqb_ans_item .sqb_ans_slider').attr('id');
		jQuery('#'+slider_ans_id).attr('data-slider-min', min_value);
	
		sqb_question_type_slider_init(slider_ans_id);
			
	});
	jQuery(document).on('keyup, change','#ans_slider_step_value',function(){
		var step_value = jQuery(this).val();
		var slider_ans_id = jQuery('.sqb_question_no.active .sqb_ans_item .sqb_ans_slider').attr('id');
		jQuery('#'+slider_ans_id).attr('data-slider-step', step_value);
		sqb_question_type_slider_init(slider_ans_id);
	});
	
	jQuery('#ans_slider_background_color,#ans_slider_background_color_div').colorpicker().on('changeColor', function() {
		var quest_outer_selector = jQuery('.sqb_question_no.active');
		var slider_ans_id = quest_outer_selector.find('.sqb_ans_item .sqb_ans_slider').attr('id');
		//quest_outer_selector.find('.type-slider-outer .slider.slider-horizontal .slider-track').css('background-color', jQuery(this).colorpicker('getValue'));
		jQuery('#'+slider_ans_id).attr('slider_b_clr',  jQuery(this).colorpicker('getValue'));  
		sqb_question_type_slider_init(slider_ans_id); 
	});
	
	jQuery('#ans_slider_complete_bar_background_color,#ans_slider_complete_bar_background_color_div').colorpicker().on('changeColor', function() {
		var quest_outer_selector = jQuery('.sqb_question_no.active');
		var slider_ans_id = quest_outer_selector.find('.sqb_ans_item .sqb_ans_slider').attr('id');
		//quest_outer_selector.find('.type-slider-outer .slider.slider-horizontal .slider-track .slider-selection').css('background-color', jQuery(this).colorpicker('getValue'));
		//quest_outer_selector.find('.type-slider-outer .slider.slider-horizontal .slider-handle').css('background-color', jQuery(this).colorpicker('getValue'));
		jQuery('#'+slider_ans_id).attr('complete_bar_b_clr',  jQuery(this).colorpicker('getValue')); 
		sqb_question_type_slider_init(slider_ans_id);  
	});
	jQuery('#ans_slider_top_box_background_color,#ans_slider_top_box_background_color_div').colorpicker().on('changeColor', function() {
		var quest_outer_selector = jQuery('.sqb_question_no.active');
		var slider_ans_id = quest_outer_selector.find('.sqb_ans_item .sqb_ans_slider').attr('id');
		//quest_outer_selector.find('.type-slider-outer .slider.slider-horizontal .tooltip .tooltip-inner').css('background-color', jQuery(this).colorpicker('getValue'));
		jQuery('#'+slider_ans_id).attr('top_box_b_clr',  jQuery(this).colorpicker('getValue'));  
		sqb_question_type_slider_init(slider_ans_id);
	});
	
	jQuery(document).on('keyup','#ans_slider_prefix_text',function(){
		var prefix_text = jQuery(this).val();
		var slider_ans_id = jQuery('.sqb_question_no.active .sqb_ans_item .sqb_ans_slider').attr('id');
		jQuery('#'+slider_ans_id).attr('prefix_text', prefix_text);
		sqb_question_type_slider_init(slider_ans_id);
	});
	
	jQuery(document).on('keyup','#ans_slider_suffix_text',function(){
		var suffix_text = jQuery(this).val();
		var slider_ans_id = jQuery('.sqb_question_no.active .sqb_ans_item .sqb_ans_slider').attr('id');
		jQuery('#'+slider_ans_id).attr('suffix_text', suffix_text);
		sqb_question_type_slider_init(slider_ans_id);
	});
	
	jQuery(document).on('click','.answer_matrix_options_show',function(e){
		jQuery('.answer_matrix_options_wrapper').show();
		e.preventDefault();
		var parent_selector = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table');
		var matrix_outcome_mapping = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.matrix_outcome_mapping');
		var matrix_column_width = jQuery('.sqb_question_no.active').find('input[name="matrix-column-width"]').val();
		jQuery('.matrix-top-left').find('input[name="matrix_column_width"]').val('');
		if(matrix_column_width != 0){
			jQuery('.matrix-top-left').find('input[name="matrix_column_width"]').val(matrix_column_width);
			setTimeout(function(){
			jQuery('.sqb-answer-matrix-table-scroll').find('table.SQB-main-table tbody th.SQB-fixed-side').css('width', matrix_column_width+'%');
			},500);
		}

		if(parent_selector.find('.SQB-main-table').length == 0){
			var default_answer_matrix_html = jQuery('.answer_matrix_default_data').html();
			for(m_i = 0; m_i < 11; m_i++){
				default_answer_matrix_html = default_answer_matrix_html.replace("sqb_tiny_mce_editor_disabled", 'sqb_tiny_mce_editor');
			}


			jQuery('.answer_matrix_options_wrapper .SQB-table-wrap').html(default_answer_matrix_html);
			jQuery('.answer_matrix_options_wrapper .SQB-table-wrap .sqb_ans_item').each(function(i){
				if(jQuery(this).attr('id') == '%%sqb_random_number%%'){
					var sqb_datetime = new Date();
					var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
					jQuery(this).attr('id', sqb_round_no);
					jQuery(this).find('.sqb_ans_delete_btn').attr('data-id', sqb_round_no);
				}
			})

			var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
			if(quiz_type == 'personality'){
				jQuery('.answer_matrix_options_wrapper .matrix-outcome-mapping').html('<div class="matrix-type-outcome"><div class="sqb_add_more_question_section"><div class="question_add_answer_btn_div sqb_question_drag_drop_item" style=""> <div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style=""> <div class="outcome-options"> <span class="outcome-option-connect ">Connect to Outcome </span> <span class="outcome-option-skip  outcome-option-active">Skip Mapping</span> </div></div> </div> </div><div class="matrix-outcome-table" style="display:none;"><table id="myTable"> <thead> <tr> <th>Question</th> <th>Answer</th> </tr> </thead> <tbody class="append-outcome-data"> </tbody> </table></div></div>');
			}
		}else{
			var question_id = jQuery('.sqb_question_no.active').find('.question-screen .quiz_comon_template').attr('data-id');

			/*if(question_id != '%%SQBQUESTIONID%%'){
				jQuery('.sqb_question_no.active').find('.question-screen .quiz_comon_template .sqb_ans_item').each(function(){
					if(jQuery(this).attr('data-id') == '%%ANSWERID%%'){
						
					}
				});
			}*/


			jQuery('.answer_matrix_options_wrapper .SQB-table-wrap').html(parent_selector.html());
			jQuery('.Manage_Side_Popup_content').find( "[id^='mce_']" ).each(function(){
				jQuery(this).removeAttr('id');
			});

			var column_length = jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table .SQB-main-table thead th').length;
			column_length = column_length-2;
			var quiz_id = jQuery('#edit_id').val();
			var question_id = jQuery('.sqb_question_no.active').find('.sqb_question_enable_drag_drop').attr('data-id');
			var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
			if(question_id == '%%SQBQUESTIONID%%' && quiz_type == 'personality'){
				jQuery('.answer_matrix_options_wrapper .matrix-outcome-mapping').html('<div class="matrix-type-outcome"><div class="sqb_add_more_question_section"><div class="question_add_answer_btn_div sqb_question_drag_drop_item" style=""> <div class="assessment_outcome_connect_btn  personality_outcome_connect_btn" style=""> <div class="outcome-options"> <span class="outcome-option-connect ">Connect to Outcome </span> <span class="outcome-option-skip  outcome-option-active">Skip Mapping</span> </div></div> </div> </div><div class="matrix-outcome-table" style="display:none;"><table id="myTable"> <thead> <tr> <th>Question</th> <th>Answer</th> </tr> </thead> <tbody class="append-outcome-data"> </tbody> </table></div></div>');
			}

			if(question_id != '%%SQBQUESTIONID%%'){
				SQBShowLoader();
				jQuery.post(ajaxurl, {
				action: 'sqb_load_matrix_outcome_data',
				question_id: question_id,
				quiz_id: quiz_id,
				column_length: column_length,
			}, function(response) {		 
				SQBHideLoader();
				response = JSON.parse(response);
				if(response.matrix_mapping){
					jQuery('.answer_matrix_options_wrapper .matrix-outcome-mapping').html(response.matrix_mapping);

					jQuery('#sqb-answer-matrix-table-scroll .SQB-main-table tr').find('th').each(function(index){
					    var ans_top_headings =jQuery(this).find('.matrix_label_text').text();
					    if(ans_top_headings != ''){
					        jQuery('.sqb-column-index-'+index).text(ans_top_headings);
					    }
					});

					jQuery('.answer_matrix_options_wrapper .mapping-select-box').select2({
				    placeholder: 'Select options',
				    theme: 'default',
				    width: '100%'
				  });
				}

				if(jQuery('.answer_matrix_options_wrapper').find('.matrix-type-outcome .outcome-option-connect').hasClass('outcome-option-active')){
					jQuery('.matrix-outcome-table').show();
				}else{
					jQuery('.matrix-outcome-table').hide();
				}

				var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
				if(quiz_type == 'personality'){
					jQuery('.answer_matrix_options_wrapper .sqb_add_more_question_section').show();
				}else{
					jQuery('.answer_matrix_options_wrapper .sqb_add_more_question_section').hide();
					jQuery('.answer_matrix_options_wrapper .matrix-outcome-table').hide();
				}

				if(quiz_type == 'personality' || quiz_type == 'assessment'){
					jQuery('.answer_matrix_options_wrapper .add-matrix-tags').show();
				}else{
					jQuery('.answer_matrix_options_wrapper .add-matrix-tags').hide();
				}

			});
			}
		}

		if(jQuery('.sqb_question_no.active').find('.matrix_outcome_mapping .outcome-option-connect').hasClass('outcome-option-active')){
			jQuery('.matrix-outcome-table').show();
		}else{
			jQuery('.matrix-outcome-table').hide();
		}
		
		var add_value_matrix_show =  false;
		if(jQuery('.answer_matrix_options_wrapper .SQB-table-wrap .SQB-main-table').hasClass('show_value_matrix_box')){
			add_value_matrix_show =  true;
		}
		
		if(add_value_matrix_show){
			jQuery('.answer_matrix_options_wrapper .add_value_matrix').prop('checked',true); 
			
		}else{
			jQuery('.answer_matrix_options_wrapper .add_value_matrix').prop('checked',false); 
		}
		
		
		var question_title = jQuery('.sqb_question_no.active').find('.question_div_outer').find('.question_details').find('.question_title').text();
		jQuery('.answer_matrix_options_wrapper').find('.matrix-question-title').text('Question: '+question_title);
		
		jQuery('.answer_matrix_options_wrapper .SQB-table-wrap th.SQB-fixed-side').find('.sql_ans_text').removeClass('sqb_tiny_mce_editor_disabled').addClass('sqb_tiny_mce_editor');
		jQuery('.answer_matrix_options_wrapper .SQB-table-wrap th').find('.matrix_label_text div').removeClass('sqb_tiny_mce_editor_disabled').addClass('sqb_tiny_mce_editor');
		
		setTimeout(function() {
			sqb_tiny_mce_editor('.answer_matrix_options_wrapper');
		}, 50);

		var matrix_background_color = jQuery('#matrix_background_color').val();
		jQuery('.sqb-answer-matrix-table-scroll .sqb_ans_item').css('background', '');
		setTimeout(function(){
			jQuery('.sqb-answer-matrix-table-scroll .sqb_ans_item').css('background', '');
		}, 1000);
		jQuery('.sqb-answer-matrix-table-scroll').css('background', matrix_background_color);


	});
	
	jQuery(document).on('click','.answer_dropdown_options_show',function(){
		jQuery('.answer_dropdown_options_wrapper').show();
		var quest_outer_selector = jQuery('.sqb_question_no.active');
		var dropdown_label = quest_outer_selector.find('#dropdown-label').val();
		var dropdown_default_value = quest_outer_selector.find('#dropdown-default-value').val();
		var dropdown_field_value = quest_outer_selector.find('#dropdown-fields-value').val();
		
		var final_dropdown_field_value = dropdown_field_value.split('_').join(' ');
		/*jQuery('.answer_dropdown_options_wrapper').find('#keylabel').val(dropdown_label);
		jQuery('.answer_dropdown_options_wrapper').find('#field_value').val(dropdown_field_value);*/
		
		
		jQuery('.answer_dropdown_options_wrapper').find('.sqb_dropdown_type_default_label').html(dropdown_label);
		//jQuery('.answer_dropdown_options_wrapper').find('.sqb_dropdown_type_default_value').html(dropdown_default_value);
		jQuery('.answer_dropdown_options_wrapper').find('#defaultdropdownvalue').val(dropdown_default_value);
		jQuery('.answer_dropdown_options_wrapper').find('#field_value').val(final_dropdown_field_value);
		
		var final_field_value = final_dropdown_field_value.split(',').join('\n');
		var final_dropdown_field_value_option = final_field_value.split('\n');
		var options_html = '';
		jQuery.each(final_dropdown_field_value_option, function(){
		  options_html += '<option>'+this+'</option>';
		});
		
		var preview_section_html = '<label class="quiz_label p-0 mb-1 preview_dropdown_label">'+dropdown_label+'</label><div class="quiz_right-content p-0 preview_dropdown_select"><select name="select_answers" class="sqb_question_dropdown" id="sqb_question_dropdown_2051"><option value="">'+dropdown_default_value+'</option>'+options_html+'</select></div>';
		jQuery('.answer_dropdown_options_wrapper').find('.preview_section').find('.quiz-content-card').html(preview_section_html);

	});
	
	
	
	jQuery(document).on('keyup','.Manage_Side_Popup .answer_value',function(){
		
		jQuery(this).attr('value',jQuery(this).val())
	});
	
	jQuery(document).on('click','.save_matrix_answer',function(){
		var matrix_column_width = jQuery('input[name="matrix_column_width"]').val();
		var min = 0;
 		var max = 70;
 		if(!(matrix_column_width >= min && matrix_column_width <= max)){
 			swal('',"Sorry, it needs to be 70% or less so the right column has enough space.",'');
 			jQuery('.sqb_question_no.active').find('input[name="matrix-column-width"]').val('');
 			return false;
 		}

		var table_html = jQuery(this).closest('.Manage_Side_Popup').find('.SQB-table-wrap').html();
		jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table').html(table_html);

		var quiz_id = jQuery('#edit_id').val();
		var question_id = jQuery('.sqb_question_no.active').find('.sqb_question_enable_drag_drop').attr('data-id');
		var matrix_background_color = jQuery('#matrix_background_color').val();
		var radio_button_border_color = jQuery('#radio_button_border_color').val();
		var radio_button_color = jQuery('#radio_button_color').val();
		var background_color = {'matrix_background_color': matrix_background_color,'radio_button_border_color': radio_button_border_color,'radio_button_color': radio_button_color, }

		var matrix_outcome_mapping_data = new Array();
		var skip_mapping = 'Y';
		var quiz_type = jQuery('input[name="quiz_type"]:checked').val();
		if(quiz_type == 'personality'){
			if(jQuery('.answer_matrix_options_wrapper .outcome-option-connect').hasClass('outcome-option-active')){
				var skip_mapping = 'N';
			}
			if(skip_mapping == 'N'){
				jQuery('.append-outcome-data tr').each(function(){
					var ans_array = new Array();
					var ans_id = jQuery(this).attr('data-ans-id');
					
					
					var selectedValues = new Array();
					var outcome_mapping = new Array();
					jQuery(this).find('.mapping-select-box').each(function(){
				    	var selected_data = jQuery(this).select2('val', selectedValues);
				    	if(selected_data == ''){
				    		selected_data = '';
				    	}
				    	outcome_mapping.push({
				    		'outcome_ids': selected_data
				    	});
					});

					ans_array.push({
						'ans_id':ans_id,
						'outcome_mapping':outcome_mapping,
					});

					matrix_outcome_mapping_data.push({
						ans_array
					});

				});
			}
		}

		/*Matrix Tags Start*/
		var tags_data = new Array();

		jQuery('.append-matrix-tags-data tr').each(function(){
			var ans_array = new Array();
			var ans_id = jQuery(this).attr('data-ans-id');
			
			
			var selectedValues = new Array();
			var outcome_tags = new Array();
			jQuery(this).find('.tag-select-box').each(function(){
		    	var selected_data = jQuery(this).select2('val', selectedValues);
		    	if(selected_data == ''){
		    		selected_data = '';
		    	}
		    	outcome_tags.push({
		    		'tag_ids': selected_data
		    	});
			});

			ans_array.push({
				'ans_id':ans_id,
				'outcome_tags':outcome_tags,
			});

			tags_data.push({
				ans_array
			});

		});

		/*Matrix Tags End*/
		

		var form_data =  {
			quiz_id: quiz_id,
			question_id: question_id,
			background_color: background_color,
			skip_mapping: skip_mapping,
			matrix_outcome_mapping_data: matrix_outcome_mapping_data,
			tags_data: tags_data,
		}
		SQBShowLoader();
		jQuery.post(ajaxurl, {
			action: 'sqb_save_matrix_background_options',
			form_data: form_data,   
		}, function(response) {		 
			SQBHideLoader();
			//sqb_save_quiz('Quiz-Screen-Settings');
			jQuery('.close_matrix_answer_type_side_popup').trigger('click');

			//save_single_question()
			sqb_save_quiz();
			//var matrix_table = jQuery('.sqb_question_no.active').find('.answer_matrix_save_table').html();
			//console.log(matrix_table);

		});

	});


	 jQuery(document).on('keyup', 'input[name="matrix_column_width"]' ,function(){
 		var matrix_column_width = jQuery(this).val();
 		jQuery('.sqb_question_no.active').find('input[name="matrix-column-width"]').val(matrix_column_width);
 		jQuery('.sqb-answer-matrix-table-scroll').find('table.SQB-main-table tbody th.SQB-fixed-side').css('width', matrix_column_width+'%');
 	});
	
	jQuery(document).on('click','.close_matrix_answer_type_side_popup',function(){
		var table_html = jQuery(this).closest('.Manage_Side_Popup').find('.SQB-table-wrap').html();
		jQuery('.sqb_question_no.active').find('.question_add_answer_outer_div').find('.answer_matrix_save_table').html(table_html);
	});
	
	jQuery(document).on('click','.add_value_matrix',function(){
		if(jQuery(this).prop('checked')){
			jQuery(this).closest('.Manage_Side_Popup').find('.SQB-main-table .answer_value').show();
			jQuery(this).closest('.Manage_Side_Popup').find('.SQB-main-table').addClass('show_value_matrix_box');
		}else{
			jQuery(this).closest('.Manage_Side_Popup').find('.SQB-main-table .answer_value').hide();
			jQuery(this).closest('.Manage_Side_Popup').find('.SQB-main-table').removeClass('show_value_matrix_box');
		}
	});
	
	jQuery(document).on('click','.answer_slider_options_show',function(){
		jQuery('.answer_slider_options_wrapper').show();
		var quest_outer_selector = jQuery('.sqb_question_no.active');
		var slider_ans_id = quest_outer_selector.find('.sqb_ans_item .sqb_ans_slider').attr('id');
		var setp_value = jQuery('#'+slider_ans_id).attr('data-slider-step');
		var max_value = jQuery('#'+slider_ans_id).attr('data-slider-max');
		var min_value = jQuery('#'+slider_ans_id).attr('data-slider-min');
		var top_box_b_clr = jQuery('#'+slider_ans_id).attr('top_box_b_clr');
		var complete_bar_b_clr = jQuery('#'+slider_ans_id).attr('complete_bar_b_clr');
		var slider_b_clr = jQuery('#'+slider_ans_id).attr('slider_b_clr');
		
		var  prefix_text = jQuery("#"+slider_ans_id).attr('prefix_text');
		var  suffix_text = jQuery("#"+slider_ans_id).attr('suffix_text');
		if(prefix_text == undefined){
			prefix_text = '';
		}
			
		if(suffix_text == undefined){
			suffix_text = '';
		}
		
		jQuery('#ans_slider_min_value').val(min_value);
		jQuery('#ans_slider_max_value').val(max_value); 
		jQuery('#ans_slider_step_value').val(setp_value);
		jQuery('#ans_slider_prefix_text').val(prefix_text);
		jQuery('#ans_slider_suffix_text').val(suffix_text);
		
		jQuery('#ans_slider_background_color').colorpicker('setValue', slider_b_clr);
		jQuery('#ans_slider_complete_bar_background_color').colorpicker('setValue', complete_bar_b_clr);
		jQuery('#ans_slider_top_box_background_color').colorpicker('setValue', top_box_b_clr);
	});
	jQuery(document).on('click','.close_Side_Popup',function(){
		jQuery('.answer_slider_options_wrapper').hide();
		jQuery(this).closest('.Manage_Side_Popup').hide();
		jQuery('body').removeClass('sidepopup-active');
	});
	
}

function sqb_template5_background_image_enable_disable(){
	
	jQuery('#enable_start_screen_background_image').change(function(){
		if(jQuery(this).prop('checked')){
			jQuery('.Quiz-start-Template5-left').addClass('sqb_start_screen_background_image');
			jQuery('.start_screen_title_bg_color').parent().show('slow');
			jQuery('.start_screen_change_bg_image').parent().show('slow');
			jQuery('.start_screen_bg_image_size').parent().show('slow');
			var template5_start_screen_bg_image = jQuery('#template5_start_screen_bg_image').val();
			jQuery('.Quiz-start-Template5-left').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+template5_start_screen_bg_image+')');
			jQuery('.Quiz-start-Template5-left').css('background-size','640px');
			jQuery('.Quiz-start-Template5-left').css('background-repeat','no-repeat');
			jQuery('.Quiz-start-Template5-left').css('background-position','center center');
			
		}else{
			
			jQuery('.Quiz-start-Template5-left').removeClass('sqb_start_screen_background_image');
			jQuery('.Quiz-Template5-title').css('background-color','');
			jQuery('.start_screen_title_bg_color').parent().hide('slow');
			jQuery('.start_screen_change_bg_image').parent().hide('slow');
			jQuery('.start_screen_bg_image_size').parent().hide('slow');
			jQuery('.Quiz-start-Template5-left').css('background-image','');
			jQuery('.Quiz-start-Template5-left').css('background-size','');
			jQuery('.Quiz-start-Template5-left').css('background-repeat','');
			jQuery('.Quiz-start-Template5-left').css('background-position','');
			
		}
	});
	
	jQuery('#enable_question_screen_background_image').change(function(){
		if(jQuery(this).prop('checked')){
			jQuery('.sqb_question_no.active').find('input[name="enable_question_background_image"]').val('Y');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').addClass('sqb_start_screen_background_image');
			jQuery('.question_screen_title_bg_color').parent().show('slow');
			jQuery('.question_screen_change_bg_image').parent().show('slow');
			jQuery('.question_screen_bg_image_size').parent().show('slow');
			var template5_start_screen_bg_image = jQuery('#template5_start_screen_bg_image').val();
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+template5_start_screen_bg_image+')');
			jQuery('.sqb_question_no.active').find('input[name="question_background_image"]').val(template5_start_screen_bg_image);
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size','640px');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-repeat','no-repeat');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-position','center center');
			jQuery('.sqb_question_no.active').find('.Quiz-start-Template5-left').css('object-fit','contain');
			
		}else{
			jQuery('.sqb_question_no.active').find('input[name="enable_question_background_image"]').val('N');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').removeClass('sqb_start_screen_background_image');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side .question_title').css('background-color','');
			jQuery('.question_screen_title_bg_color').parent().hide('slow');
			jQuery('.question_screen_change_bg_image').parent().hide('slow');
			jQuery('.question_screen_bg_image_size').parent().hide('slow');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image','');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size','');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-repeat','');
			jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-position','');
			jQuery('.sqb_question_no.active').find('.Quiz-start-Template5-left').css('object-fit','');
			jQuery('.sqb_question_no.active').find('.question_details').css('background-color','');
		}
	});
	
	jQuery('#enable_outcome_screen_background_image').change(function(){
		if(jQuery(this).prop('checked')){
			jQuery('.res_data_cont.active').find('input[name="enable_outcome_background_image"]').val('Y');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').addClass('sqb_start_screen_background_image');
			jQuery('.outcome_screen_title_bg_color').parent().show('slow');
			jQuery('.outcome_screen_change_bg_image').parent().show('slow');
			jQuery('.outcome_screen_bg_image_size').parent().show('slow');
			var template5_start_screen_bg_image = jQuery('#template5_start_screen_bg_image').val();
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image','linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0)),url('+template5_start_screen_bg_image+')');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size','640px');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-repeat','no-repeat');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-position','center center');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('padding','30px 20px');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('object-fit','contain');
		}else{
			jQuery('.res_data_cont.active').find('input[name="enable_outcome_background_image"]').val('N');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').removeClass('sqb_start_screen_background_image');
			jQuery('.res_data_cont.active').find('.points_scored_result').css('background-color','');
			jQuery('.outcome_screen_title_bg_color').parent().hide('slow');
			jQuery('.outcome_screen_change_bg_image').parent().hide('slow');
			jQuery('.outcome_screen_bg_image_size').parent().hide('slow');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image','');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size','');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-repeat','');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-position','');
			jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('padding','');
			jQuery('.sqb_question_no.active').find('.Quiz-start-Template5-left').css('object-fit','');
		}
	});
	
	jQuery('.sqb_remove_start_screen_bg_image_template7').on('click',function(){
		/*jQuery('#start_temp_static_div_id,.outcome-section,.question-screen,.optin_template_html_preview_outer').css('background-image','');
		jQuery('#start_temp_static_div_id,.outcome-section,.question-screen,.optin_template_html_preview_outer').css('background-size','');
		jQuery('#start_temp_static_div_id,.outcome-section,.question-screen,.optin_template_html_preview_outer').css('background-repeat','');
		jQuery('#start_temp_static_div_id,.outcome-section,.question-screen,.optin_template_html_preview_outer').css('background-position','');
		*/
		var sqb_linear_gradient = 'none';
		var global_start_screen_style = '.sqb_global_theme_enable_each_template .start_temp_static_div { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
		var global_outcome_screen_style = '.sqb_global_theme_enable_each_template .outcome-section { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
		var global_question_screen_style = '.sqb_global_theme_enable_each_template .question-screen { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
		var global_optin_screen_style = '.sqb_global_theme_enable_each_template .optin_template_html_preview_outer { background-image:'+sqb_linear_gradient+' !important; background-repeat: no-repeat !important;background-position:center center !important; background-size:cover !important;}';
		var temp_values_global_style_dynamic = '#temp_values_global_style_dynamic_div { background-image: '+sqb_linear_gradient+' !important;}';
		jQuery('#start_screen_global_style_dynamic').append(global_start_screen_style);
		jQuery('#outcome_screen_global_style_dynamic').append(global_outcome_screen_style);
		jQuery('#question_screen_global_style_dynamic').append(global_question_screen_style);
		jQuery('#opt_screen_global_style_dynamic').append(global_optin_screen_style);
		jQuery('#temp_values_global_style_dynamic').append(temp_values_global_style_dynamic);
	});
	
	jQuery('.sqb_remove_start_screen_bg_image').on('click',function(){
		jQuery('.Quiz-start-Template5-left').removeClass('sqb_start_screen_background_image');
		jQuery('.Quiz-Template5-title').css('background-color','');
		jQuery('.Quiz-start-Template5-left').css('background-image','');
		jQuery('.Quiz-start-Template5-left').css('background-size','');
		jQuery('.Quiz-start-Template5-left').css('background-repeat','');
		jQuery('.Quiz-start-Template5-left').css('background-position','');
	});
	
	jQuery('.sqb_remove_question_screen_bg_image').on('click',function(){
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').removeClass('sqb_start_screen_background_image');
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side .question_title').css('background-color','');
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image','');
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size','');
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-repeat','');
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-position','');
		jQuery('.sqb_question_no.active').find('input[name="question_background_image"]').val('');
		jQuery('.sqb_question_no.active').find('input[name="enable_question_background_image"]').val('N');
		
		jQuery('.sqb_question_no.active').find('.Quiz-Template5-left-side .question_details').css('background-color','');
		
	});
	
	jQuery('.sqb_remove_outcome_screen_bg_image').on('click',function(){
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').removeClass('sqb_start_screen_background_image');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('background-color','');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('padding','');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image','');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size','');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-repeat','');
		jQuery('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-position','');
		jQuery('.res_data_cont.active').find('input[name="enable_outcome_background_image"]').val('N');
		
	});
	
	jQuery('.sqb_remove_start_screen_bg_image_opacity').on('click',function(){
		var sqb_bg_img = jQuery('.start_template_html_preview_outer').find('.Quiz-start-Template5-left').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			jQuery('#start_screen_bg_image_opacity_clr,#start_screen_bg_image_opacity_clr_divs').colorpicker('setValue', 'rgba(255,255,255,0.5)');
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0)),'+sqb_bg_img;
			jQuery('.start_template_html_preview_outer').find('.Quiz-start-Template5-left').css('background-image', sqb_linear_gradient);
		}
	});
	
	jQuery('.sqb_remove_outcome_screen_bg_image_opacity').on('click',function(){
		var result_temp_preview_obj = jQuery('.result_template_html_preview_outer');
		var sqb_bg_img = result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			jQuery('#outcome_screen_bg_image_opacity_clr,#outcome_screen_bg_image_opacity_clr_div').colorpicker('setValue', 'rgba(255,255,255,0.5)');
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0)),'+sqb_bg_img;
			result_temp_preview_obj.find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image', sqb_linear_gradient);
		}
	});
	
	jQuery('.sqb_remove_question_screen_bg_image_opacity').on('click',function(){
		var question_temp_preview_obj = jQuery('.sqb_questions_wrapper');
		var sqb_bg_img = question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image');
		if (sqb_bg_img != 'none' && sqb_bg_img.search("linear-gradient") != -1){
			jQuery('#question_screen_bg_image_opacity_clr,#question_screen_bg_image_opacity_clr_div').colorpicker('setValue', 'rgba(255,255,255,0.5)');
			var sqb_bg_img = sqb_bg_img.split(/[, ]+/).pop();
			var sqb_linear_gradient = 'linear-gradient(rgba(0,0,0,0),rgba(0,0,0,0)),'+sqb_bg_img;
			question_temp_preview_obj.find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image', sqb_linear_gradient);
		}
	});
}

function sqb_load_question_background_image_customizer_values(){	
	var enable_question_background_image = jQuery('.sqb_question_no.active').find('input[name="enable_question_background_image"]').val();
	if(enable_question_background_image == 'Y'){
		jQuery('#enable_question_screen_background_image').prop('checked',true);
		jQuery('.question_screen_title_bg_color').parent().show();
		jQuery('.question_screen_bg_image_size').parent().show();
		jQuery('.question_screen_change_bg_image').parent().show();
		
		var sqb_question_title_background_color = jQuery('.sqb_questions_wrapper').find('.sqb_question_no.active').find('.Quiz-Template5-left-side .question_details').css('background-color');
		if(typeof sqb_question_title_background_color != 'undefined'){
			jQuery('#question_screen_title_bg_clr,#question_screen_title_bg_clr_div').colorpicker('setValue', sqb_question_title_background_color);
		}
		
		var sqb_question_background_image_size = jQuery('.sqb_questions_wrapper').find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-size');
		if(typeof sqb_question_background_image_size != 'undefined'){
			sqb_question_background_image_sizes = parseFloat(sqb_question_background_image_size); 
			jQuery("#question_screen_background_image_size").bootstrapSlider('setValue', sqb_question_background_image_sizes);
		}
		
		var sqb_question_screen_bg_image_opacity_clr = jQuery('.sqb_questions_wrapper').find('.sqb_question_no.active').find('.Quiz-Template5-left-side').css('background-image');
		if (typeof sqb_question_screen_bg_image_opacity_clr != "undefined" && sqb_question_screen_bg_image_opacity_clr != "none" && sqb_question_screen_bg_image_opacity_clr.search("linear-gradient") != -1) {
			var bg_img_opacity = get_background_image_opacity(sqb_question_screen_bg_image_opacity_clr);
			if(bg_img_opacity){
			jQuery('#question_screen_bg_image_opacity_clr,#question_screen_bg_image_opacity_clr_div').colorpicker('setValue', bg_img_opacity);
			} else {
			jQuery('.sqb_remove_question_screen_bg_image_opacity').trigger('click');
			}
		}
		
	} else {
		jQuery('#enable_question_screen_background_image').prop('checked',false);
		jQuery('.question_screen_title_bg_color').parent().hide();
		jQuery('.question_screen_bg_image_size').parent().hide();
		jQuery('.question_screen_change_bg_image').parent().hide();
	}
	
	var progress_bar_color = jQuery('.sqb_question_no.active').find('input[name="progress_bar_color"]').val();
	if(progress_bar_color !='' || progress_bar_color !='none'){
		jQuery('#question_progress_bar_clr,#question_progress_bar_clr_div').colorpicker('setValue', progress_bar_color);
	}
	
}

function sqb_load_outcomes_background_image_customizer_values(){	
	var enable_outcome_background_image = jQuery('.result_template_html_preview_outer').find('.res_data_cont.active').find('input[name="enable_outcome_background_image"]').val();
	if(enable_outcome_background_image == 'Y'){
		jQuery('#enable_outcome_screen_background_image').prop('checked',true);
		jQuery('.outcome_screen_title_bg_color').parent().show();
		jQuery('.outcome_screen_bg_image_size').parent().show();
		jQuery('.outcome_screen_change_bg_image').parent().show();
		var sqb_outcome_title_background_color = jQuery('.result_template_html_preview_outer').find('.res_data_cont.active').find('.Quiz-result-Template5-left .points_scored_result').css('background-color');
		if(typeof sqb_outcome_title_background_color != 'undefined'){
		jQuery('#outcome_screen_title_bg_clr,#outcome_screen_title_bg_clr_div').colorpicker('setValue', sqb_outcome_title_background_color);
		}
		
		var outcome_screen_bg_image_opacity_clr = jQuery('.result_template_html_preview_outer').find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-image');
		if(typeof outcome_screen_bg_image_opacity_clr != 'undefined' && outcome_screen_bg_image_opacity_clr != 'none' && outcome_screen_bg_image_opacity_clr.search("linear-gradient") != -1){
		var bg_img_opacity = get_background_image_opacity(outcome_screen_bg_image_opacity_clr);	
			if(bg_img_opacity) {
			jQuery('#outcome_screen_bg_image_opacity_clr,#outcome_screen_bg_image_opacity_clr_div').colorpicker('setValue', bg_img_opacity);
			} else {
			jQuery('.sqb_remove_outcome_screen_bg_image_opacity').trigger('click');
			}
		}
		
		var sqb_outcome_background_image_size = jQuery('.result_template_html_preview_outer').find('.res_data_cont.active').find('.Quiz-result-Template5-left').css('background-size');
		if(typeof sqb_outcome_background_image_size != 'undefined'){
			sqb_outcome_background_image_sizes = parseFloat(sqb_outcome_background_image_size); 
			jQuery("#outcome_screen_background_image_size").bootstrapSlider('setValue', sqb_outcome_background_image_sizes);
		}

	} else {
		jQuery('#enable_outcome_screen_background_image').prop('checked',false);
		jQuery('.outcome_screen_title_bg_color').parent().hide();
		jQuery('.outcome_screen_bg_image_size').parent().hide();
		jQuery('.outcome_screen_change_bg_image').parent().hide();
		
	}
}

function sqb_remove_optin_remove_class(){
	if(jQuery('#sqb_direct_signup').hasClass('fields_reorder_enabled')){
		jQuery('.sqb_enable_disable_custom_fields_reorder').trigger('click');
	}
}

function sqb_save_recommendation(element){
	var answer_attr_id = element.closest('.Manage_Side_Popup').find('.sqb_ans_item_inner_dot_option').attr('answer_attr_id');
	var html = element.closest('.Manage_Side_Popup').find('.sqb_ans_item_inner_dot_option').html();
	var ans_class = 'sqb_ans_option_'+answer_attr_id;
	var selected_question = jQuery('.sqb_question_no.active');
	if(jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).length != 0){
		html = jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).html(html);
	}
	if(element.hasClass('save_and_close') || element.hasClass('close_cr_popup_button')){
		element.closest('.Manage_Side_Popup').hide();
	}
	jQuery('.answer_recommendation_options_wrapper .cr_success_msg').show();
	setTimeout(function(){ jQuery('.answer_recommendation_options_wrapper .cr_success_msg').hide('slow'); }, 5000);
	jQuery('#'+answer_attr_id).find('#dropdownMenuButtonAnslevel').html('<span><i class="fas fa-pencil-alt" style="font-size: 12px; margin-top:5px;" title="Edit Recommendation"></i></span>');
	jQuery('#'+answer_attr_id).find('.add_ans_level_recommendation').html('<strong>Edit Recommendation</strong>');
	sqb_save_quiz('Quiz-Screen-Settings');
}
function sqb_add_answer_level_dot_option(){
	
	jQuery(document).on('click' , '.sqbHideAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
		parent_selector.find('.ans_recommendation_img_div').hide();
		parent_selector.find('.sqbShowAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
	});

	jQuery(document).on('click' , '.sqbShowAnsRecommendationTemplateImage' , function(e){
		e.preventDefault(); 
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
		parent_selector.find('.ans_recommendation_img_div').css('display' , 'inline-block');
		parent_selector.find('.sqbHideAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
		
	});
	
	jQuery(document).on('click' , '.sqbDeleteAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
        parent_selector.find('.ans_recommendation_img_div').hide();
		parent_selector.find('.ans_recommendation_img_div img').remove();
		parent_selector.find('.sqbAddAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
		parent_selector.find('.sqbHideAnsRecommendationTemplateImageOuter').hide();
		parent_selector.find('.sqbShowAnsRecommendationTemplateImageOuter').hide();
		
	});
	
	jQuery(document).on('click' , '.sqbAddAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
		//var sqb_datetime = new Date();
		//var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
		//var current_date_time_img_outer = "sbq_img_outer_"+sqb_round_no;
		
        var img_src = jQuery(this).attr('attr-img-src');
        parent_selector.find('.ans_recommendation_img_div').show();
		parent_selector.find('.ans_recommendation_img_div').prepend('<img  src="'+img_src+'">');
		parent_selector.find('.ans_recommendation_img_div img').addClass('sqb_img_draggable'); 
		parent_selector.find('.sqbDeleteAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
		sqb_ans_dot_options_resizeable();
		parent_selector.find('.sqbHideAnsRecommendationTemplateImageOuter').hide();
		parent_selector.find('.sqbShowAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');

	});
	
	jQuery(document).on('click' ,'.sqbHideAnsRecommendationDescription', function(e){
		e.preventDefault();
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
		parent_selector.find('.ans_recommendation_description , .sqbHideAnsRecommendationDescriptionOuter').hide();
		parent_selector.find('.sqbShowAnsRecommendationDescriptionOuter').show();
		
	});


	jQuery('body').on('click' , '.Manage_Side_Popup_content_innner .sqbAddAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
        var img_src = jQuery(this).attr('attr-img-src');
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').show();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').prepend('<img  src="'+img_src+'">');
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').addClass('sqb_img_draggable');
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbDeleteAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		
		jQuery(this).parent().hide();
		sqb_ans_dot_options_resizeable();

		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbHideAnsRecommendationTemplateImageOuter').show();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbShowAnsRecommendationTemplateImageOuter').hide();
		

	});

	jQuery('body').on('click' , '.Manage_Side_Popup_content_innner .sqbShowAnsRecommendationTemplateImage' , function(e){
		e.preventDefault(); 
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').css('display' , 'inline-block');
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbHideAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
	});

	jQuery('body').on('click' , '.Manage_Side_Popup_content_innner .sqbDeleteAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').hide();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div img').remove();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbAddAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbHideAnsRecommendationTemplateImageOuter').hide();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbShowAnsRecommendationTemplateImageOuter').hide();
	});

	jQuery('body').on('click' , '.Manage_Side_Popup_content_innner .sqbHideAnsRecommendationTemplateImage' , function(e){
		e.preventDefault();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_img_div').hide();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbShowAnsRecommendationTemplateImageOuter').css('display' , 'inline-block');
		jQuery(this).parent().hide();
	});

	jQuery('body').on('click' ,'.Manage_Side_Popup_content_innner .sqbHideAnsRecommendationDescription', function(e){
		e.preventDefault();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_description,.sqbHideAnsRecommendationDescriptionOuter').hide();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbShowAnsRecommendationDescriptionOuter').show();
	});

	jQuery('body').on('click' ,'.Manage_Side_Popup_content_innner .sqbShowAnsRecommendationDescription' , function(e){
		e.preventDefault();

		jQuery(this).parents('.ans_recommendation_result_progress').find('.ans_recommendation_description,.sqbHideAnsRecommendationDescriptionOuter').show();
		jQuery(this).parents('.ans_recommendation_result_progress').find('.sqbShowAnsRecommendationDescriptionOuter').hide();
		
	});
	
	jQuery(document).on('click' ,'.sqbShowAnsRecommendationDescription' , function(e){
		e.preventDefault();
		var parent_selector = jQuery('.answer_recommendation_options_wrapper.active_Side_Popup');
		parent_selector.find('.ans_recommendation_description , .sqbHideAnsRecommendationDescriptionOuter').show();
		parent_selector.find('.sqbShowAnsRecommendationDescriptionOuter').hide();
	});


	
	jQuery(document).on('click','.popup_answer_recommendation_save_btn',function(){
		
		var element = jQuery(this);
		if(!jQuery('#recommendation-switch').prop('checked')){
			swal({
			title: "The content recommendation for this answer is not active currently.",
			text: "Do you want to activate it?",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes",
			cancelButtonText: "No",
			customClass: '',
			}).then((result) => {
					if (result.value) {
						jQuery('#recommendation-switch').trigger('click');
					}
					sqb_save_recommendation(element);
				});
			} else {
				sqb_save_recommendation(element);
			}
	});
	
	
	
	
	
	jQuery(document).on('click','.recommendation-delete--btn',function(){
		swal({
			title: "Are you sure you want to delete the recommendation ?",
			text: "You cannot recover the settings.",
			//type: "warning",
			showCancelButton: true,
			showCloseButton: true,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Yes, Delete!",
			customClass: '',
			
			}).then((result) => {
					if (result.value) {
						var answer_attr_id = jQuery('.answer_recommendation_popup_html_wrapper').find('.sqb_ans_item_inner_dot_option').attr('answer_attr_id');
						var ans_class = 'sqb_ans_option_'+answer_attr_id;
						var selected_question = jQuery('.sqb_question_no.active');
						if(jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).length != 0){
							jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).remove();
						}
						jQuery('.answer_recommendation_popup_html_wrapper').find('.'+ans_class).html('');
						jQuery('.recommendation-delete--btn').hide('');
						jQuery('.answer_recommendation_options_wrapper .sqb-recommendationInfo').hide();
						jQuery('.answer_recommendation_options_wrapper .enable_disable_reccomendation').hide();
						jQuery('.answer_recommendation_options_wrapper .recommendationInfoSection').hide();
						jQuery('.answer_recommendation_options_wrapper .save-popup-bottom').hide();
						jQuery('.answer_recommendation_options_wrapper .save-popup-bottom.close_cr_popup_button').show();
						
						jQuery('.answer_recommendation_options_wrapper .cr_delete_msg').show();
						setTimeout(function(){ jQuery('.answer_recommendation_options_wrapper .cr_delete_msg').hide('slow'); }, 5000);
						
						jQuery('#'+answer_attr_id).find('#dropdownMenuButtonAnslevel').html('<span>...</span>');
						jQuery('#'+answer_attr_id).find('.add_ans_level_recommendation').html('<strong>Add Recommendation</strong>');
						sqb_save_quiz('Quiz-Screen-Settings');
					}
				});
	});
	
	jQuery(document).on('change', '#recommendation-switch' , function(){
		var answer_attr_id = jQuery('.answer_recommendation_popup_html_wrapper').find('.sqb_ans_item_inner_dot_option').attr('answer_attr_id');
		var ans_class = 'sqb_ans_option_'+answer_attr_id;
		var selected_question = jQuery('.sqb_question_no.active');
		if(jQuery(this).prop('checked') == true){
			jQuery('.answer_recommendation_popup_html_wrapper').find('.'+ans_class).attr('sqb_recommendation_enabled','Y');
			if(jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).length != 0){
				jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).attr('sqb_recommendation_enabled','Y');
			}
		}else{
			jQuery('.answer_recommendation_popup_html_wrapper').find('.'+ans_class).attr('sqb_recommendation_enabled','N');
			if(jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).length != 0){
				jQuery(selected_question).find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).attr('sqb_recommendation_enabled','N');
			}
		}
	});

	jQuery(document).on('click','.save-popup-bottom.cancel, .save-popup-bottom.close_cr_popup_button',function(){
		jQuery('.answer_recommendation_options_wrapper').removeClass('active_Side_Popup').hide();
	});
	
	jQuery(document).on('click','.add_ans_level_recommendation',function(){
		
		jQuery('.recommendation-delete--btn').show();
		jQuery('.answer_recommendation_options_wrapper .sqb-recommendationInfo').show();
		jQuery('.answer_recommendation_options_wrapper .enable_disable_reccomendation').show();
		jQuery('.answer_recommendation_options_wrapper .save-popup-bottom').show();
		jQuery('.answer_recommendation_options_wrapper .recommendationInfoSection').show();
		jQuery('.answer_recommendation_options_wrapper .save-popup-bottom.close_cr_popup_button').hide();
		jQuery('.answer_recommendation_options_wrapper .cr_success_msg').hide();
		jQuery('.answer_recommendation_options_wrapper .cr_delete_msg').hide();
		
		var selected_template = jQuery('input[name="select_temp"]:checked').val();
		if(selected_template == 'template1' || selected_template == 'template2' || selected_template == 'template3' || selected_template == 'template4' || selected_template == 'template7'){
			var question_type = jQuery('.sqb_question_no.active').find('.question-screen .question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}else if(selected_template == 'template5'){
			var question_type = jQuery('.sqb_question_no.active').find('.question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}else{
			var question_type = jQuery('.sqb_question_no.active').find('.template8_question_screen_setting_options_wrapper .question_type_wrapper .dropdown-custom-style').find('button').attr('data-value');
		}

		if(question_type == 'multi') {
			swal("","Sorry, can't setup answer recommendation for multiple choice question as users can pick more than one answer. It'll only work with single choice and yes/no question type.","");
			return false;
		}
		
		if(jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').length == 0){
			jQuery(this).closest('.question_div_inner').after('<div class="sqb_answer_bot_option_wrapper_outer"></div');		
		}
		
		if(jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').length != 0){
			
			var answer_db_id = jQuery(this).closest('.sqb_ans_item').attr('data-id');
			var answer_attr_id = jQuery(this).closest('.sqb_ans_item').attr('id');
			var html = '';
			var ans_class = 'sqb_ans_option_'+answer_attr_id;
			if(jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).length != 0){
				jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().find('.ui-wrapper').contents().unwrap();
				 jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().find('.ui-resizable-handle.ui-resizable-e').remove();
				 jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().find('.sbq_change_img').removeClass('ui-resizable');
				 jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().find('.ui-resizable-handle.ui-resizable-se').remove();
				 jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().find('.ui-resizable-handle.ui-resizable-s').remove();
				
				html = jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).parent().html();
				
				var sqb_recommendation_enabled = jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').find('.'+ans_class).attr('sqb_recommendation_enabled');
				if(sqb_recommendation_enabled == 'Y'){
					jQuery('#recommendation-switch').prop('checked', true);
				} else {
					jQuery('#recommendation-switch').prop('checked', false);
				}
			}else{
			
				var html = jQuery('.sqb_answer_bot_option_clone_html').html();
				html = '<div class="sqb_ans_item_dot_option" ><div class="sqb_ans_item_inner_dot_option '+ans_class+'" answer_db_id="'+answer_db_id+'" answer_attr_id="'+answer_attr_id+'" sqb_recommendation_enabled="N">'+html+'</div></div>';
				
				var sqb_datetime = new Date();
				var sqb_round_no = sqb_datetime.getFullYear()+'_'+sqb_datetime.getMonth()+'_'+sqb_datetime.getTime()+'_'+Math.floor(Math.random() * 10000);
				var current_date_time_img = "sbq_ans_bot_img_"+sqb_round_no;
				var current_date_time_img_outer = "sbq_ans_bot_img_outer_"+sqb_round_no;
				var current_date_time_main = "sbq_ans_bot_main_div_"+sqb_round_no;
					
				html = html.replace("%%CURRENTDATETIMEIMAAOUTER%%", current_date_time_img_outer);
				html = html.replace("%%CURRENTDATETIMEIMG%%", current_date_time_img);
				html = html.replace("%%CURRENTDATETIMEIMG%%", current_date_time_img);
				html = html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
				html = html.replace("sqb_tiny_mce_editor_rename", 'sqb_tiny_mce_editor');
				jQuery(this).closest('.question_div_outer').find('.sqb_answer_bot_option_wrapper_outer').append(html);
				sqb_resizeable();
				
				jQuery('#recommendation-switch').prop('checked', false);
			}
			var question_title = jQuery('.sqb_question_no.active').find('.Quiz-Template-title.question_title').text();
			var answer_choice = jQuery(this).closest('.sqb_ans_item').find('.sql_ans_text').text();
			jQuery('.answer_recommendation_options_wrapper .cr_question_title').html('<strong>Question Title:</strong> '+question_title);
			jQuery('.answer_recommendation_options_wrapper .cr_answer_choice').html('<strong>Answer Choice:</strong> '+answer_choice);
			
			jQuery('.answer_recommendation_options_wrapper').addClass('active_Side_Popup').css("display","block");
			jQuery('body').addClass('sidepopup-active');

			jQuery('.answer_recommendation_options_wrapper').find('.answer_recommendation_popup_html_wrapper').html(html);
			jQuery('.answer_recommendation_options_wrapper').find('.answer_recommendation_popup_html_wrapper').find( "[id^='mce_']" ).each(function(){
				jQuery(this).removeAttr('id');
			});
			sqb_tiny_mce_editor();
			sqb_ans_dot_options_resizeable();
		}
		
	});
}

function sqb_ans_dot_options_resizeable(){
	jQuery(".answer_recommendation_options_wrapper .sqb_ans_dot_item_img ").resizable({		
		resize: function(e, ui) {			 
			var img_wid = jQuery(this).css("width");			
			jQuery(this).find("img").css("width", img_wid);
			var img_height = jQuery(this).css("height");
			jQuery(this).find("img").css("height", img_height);
		}
	}); 
}

function generateBlob(){
	var blob_data = 'WEBVTT';
	jQuery('.caption_wrapper').each(function(i){
		var start_time = jQuery(this).find('.caption-start-time').val();
		var end_time = jQuery(this).find('.caption-end-time').val();
		var caption_text = jQuery(this).find('.caption-text').val();

		blob_data += '\n\nkey-'+i+'\n00:'+start_time+' --> 00:'+end_time+'\n'+caption_text;
	});
	return blob_data;
}

function load_video_url_data(video_url){
	SQBShowLoader();
		jQuery.post(ajaxurl, {
			action: 'sqb_load_video_url',
			video_url: video_url,
		}, function(response) {
			SQBHideLoader();
			response = JSON.parse(response);

			jQuery('#add_caption_popup').modal('show');
			var number = Math.floor(1000 + Math.random() * 9000);
			jQuery('.caption_video_url').html('<input type="hidden" name="video_caption_hidden_url" class="video_caption_hidden_url" value="'+video_url+'"><video id="video_caption_player" class="video-js" controls preload="auto"><source src="'+video_url+'" type="video/mp4"><track kind="subtitles" src="" srclang="en" label="English" default><p class="vjs-no-js"></video>');
			var options = {};
			var player = videojs('video_caption_player', options, function onPlayerReady() {

				var data = generateBlob();
				var newBlob = new Blob([data], { type: 'text/plain' });
				var url = URL.createObjectURL(newBlob);
				updateTracks(url);
			});

			videojs.getPlayer('video_caption_player').on('timeupdate', function () {
			   	var sec = videojs.getPlayer('video_caption_player').currentTime();
			    var caption_time = fancyTimeFormat(sec);
			    jQuery('.video_timer').html(caption_time);
			});

			if(response.output){
				var data = response.output.replace(/\\/g, '');
				jQuery('.caption_wrapper_outer').html(data);
			}else{
				jQuery('.caption_wrapper_outer').html('');
				jQuery('.add-caption-btn').trigger('click');
			}
		});
}


function sqb_checkIfImageExists(url, callback) {
  const img = new Image();
  img.src = url;
  
  if (img.complete) {
    callback(true);
  } else {
    img.onload = () => {
      callback(true);
    };
    
    img.onerror = () => {
      callback(false);
    };
  }
}